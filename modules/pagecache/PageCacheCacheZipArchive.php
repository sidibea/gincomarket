<?php
/**
 * Page Cache powered by Jpresta (jpresta . com)
 *
 *    @author    Jpresta
 *    @copyright Jpresta
 *    @license   You are just allowed to modify this copy for your own use. You must not redistribute it. License
 *               is permitted for one Prestashop instance only but you can install it on your test instances.
 */

if (! defined('_CAN_LOAD_FILES_'))
    exit();

class PageCacheCacheZipArchive extends PageCacheCache
{

    private $dir;

    private $log;

    public function __construct($dir, $log = false)
    {
        $this->dir = $dir;
        $this->log = $log;

        if (! file_exists($this->dir)) {
            // Creates subdirectory with 777 to be sure it will work
            $grants = 0777;
            if (! @mkdir($this->dir, $grants, true)) {
                $mkdirErrorArray = error_get_last();
                if (! file_exists($this->dir)) {
                    if ($mkdirErrorArray !== null) {
                        Logger::addLog("PageCache | Cannot create directory " . $this->dir . " with grants $grants: " . $mkdirErrorArray['message'], 4);
                    }
                    else {
                        Logger::addLog("PageCache | Cannot create directory " . $this->dir . " with grants $grants", 4);
                    }
                }
            }
        }
    }

    public static function isCompatible()
    {
        return class_exists('ZipArchive');
    }

    private function getArchive($key, $modify = false)
    {
        $subdir = $this->dir;
        for ($i = 0; $i < min(2, Tools::strlen($key)); $i ++) {
            $subdir .= '/' . $key[$i];
        }

        if ($modify && ! file_exists($subdir)) {
            // Creates subdirectory with 777 to be sure it will work
            $grants = 0777;
            if (! @mkdir($subdir, $grants, true)) {
                $mkdirErrorArray = error_get_last();
                if (! file_exists($subdir)) {
                    if ($mkdirErrorArray !== null) {
                        Logger::addLog("PageCache | Cannot create directory $subdir with grants $grants: " . $mkdirErrorArray['message'], 4);
                    }
                    else {
                        Logger::addLog("PageCache | Cannot create directory $subdir with grants $grants", 4);
                    }
                }
            }
        }

        $zip_file = $subdir . '/' . $key[0] . '.zip';

        $res = false;
        $zip = new ZipArchive();
        if ($modify) {
            $res = $zip->open($zip_file, ZipArchive::CREATE | ZipArchive::CHECKCONS);
            if ($res !== true) {
                Logger::addLog("PageCache | Cannot create file $zip_file : " . $res, 4);
                return false;
            }
            $zip->addFromString('empty.txt','');
        } else {
            if (file_exists($zip_file)) {
                $res = $zip->open($zip_file);
                if ($res !== true) {
                    Logger::addLog("PageCache | Cannot open file $zip_file : " . $res, 4);
                    return false;
                }
            } else {
                return false;
            }
        }
        return $zip;
    }

    public function get($key, $ttl = -1)
    {
        $value = false;
        $zip = $this->getArchive($key);
        if ($zip !== false) {
            $timestamp = $zip->getCommentName($key);
            if ($timestamp !== false) {
                if ($ttl < 0 or (time() - $timestamp < $ttl)) {
                    $value = $zip->getFromName($key);
                }
            }
            if (! @$zip->close()) {
                $error = '';
                if (is_resource($zip)) {
                    $error = $zip->getStatusString();
                }
                Logger::addLog("PageCache | Cannot close zip archive for key $key: " . $error, 4);
            }
        }
        return $value;
    }

    public function set($key, $value)
    {
        $zip = $this->getArchive($key, true);
        if ($zip !== false) {
            $zip->addFromString($key, $value);
            $zip->setCommentName($key, time());
            if (! @$zip->close()) {
                $error = '';
                if (is_resource($zip)) {
                    $error = $zip->getStatusString();
                }
                Logger::addLog("PageCache | Cannot close zip archive for key $key: " . $error, 4);
            }
        }
    }

    public function delete($key)
    {
        $zip = $this->getArchive($key, true);
        if ($zip !== false) {
            // don't check returned code because the key may not exists
            $zip->deleteName($key);
            if (! @$zip->close()) {
                $error = '';
                if (is_resource($zip)) {
                    $error = $zip->getStatusString();
                }
                Logger::addLog("PageCache | Cannot close zip archive for key $key: " . $error, 4);
            }
        }
    }

    public function flush()
    {
        if ($this->dir && file_exists($this->dir)) {
            Tools::deleteDirectory($this->dir, true);
        }
    }
}