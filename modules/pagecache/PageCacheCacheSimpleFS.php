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

class PageCacheCacheSimpleFS extends PageCacheCache
{

    private $dir;

    private $log;

    public function __construct($dir, $log = false)
    {
        $this->dir = $dir;
        $this->log = $log;
    }

    public static function isCompatible()
    {
        // Always compatible
        return true;
    }

    private function getFilePath($key)
    {
        $subdir = $this->dir;
        for ($i = 0; $i < min(3, Tools::strlen($key)); $i ++) {
            $subdir .= '/' . $key[$i];
        }
        $cache_file = $subdir . '/' . $key . '.htm';
        return $cache_file;
    }

    public function get($key, $ttl = -1)
    {
        $cache_file = $this->getFilePath($key);
        $filemtime = @filemtime($cache_file);
        if ($filemtime && ($ttl < 0 or (microtime(true) - $filemtime < $ttl))) {
            return Tools::file_get_contents($cache_file);
        }
        return false;
    }

    public function set($key, $value)
    {
        $cache_file = $this->getFilePath($key);
        $cache_dir = dirname($cache_file);

        if (! file_exists($cache_dir)) {
            // Creates subdirectory with 777 to be sure it will work
            $grants = 0777;
            if (! @mkdir($cache_dir, $grants, true)) {
                $mkdirErrorArray = error_get_last();
                if (! file_exists($cache_dir)) {
                    if ($mkdirErrorArray !== null) {
                        Logger::addLog("PageCache | Cannot create directory " . $cache_dir . " with grants $grants: " . $mkdirErrorArray['message'], 4);
                    }
                    else {
                        Logger::addLog("PageCache | Cannot create directory " . $cache_dir . " with grants $grants", 4);
                    }
                }
            }
        }

        $write_ok = file_put_contents($cache_file, $value);
        if ($write_ok === false) {
            $mkdirErrorArray = error_get_last();
            if ($mkdirErrorArray !== null) {
                Logger::addLog("PageCache | Cannot write file $cache_file: " . $mkdirErrorArray['message'], 4);
            }
            else {
                Logger::addLog("PageCache | Cannot write file $cache_file", 4);
            }
        } else
            if ($this->log) {
                // Log debug
                $exists = file_exists($cache_file) ? 'true' : 'false';
                $date_infos = '';
                if (file_exists($cache_file)) {
                    $now = date("d/m/Y H:i:s", microtime(true));
                    $last_date = date("d/m/Y H:i:s", filemtime($cache_file));
                    $date_infos = "now=$now file=$last_date";
                }
                Logger::addLog("PageCache | cached | cache_file=$cache_file exists=$exists $date_infos", 1, null, null, null, true);
            }
        if ($write_ok !== false) {
            @chmod($cache_file, 0666);
        }
    }

    public function delete($key)
    {
        $cache_file = $this->getFilePath($key);
        if (file_exists($cache_file)) {
            @unlink($cache_file);
        }
    }

    public function flush()
    {
        if ($this->dir && file_exists($this->dir)) {
            Tools::deleteDirectory($this->dir, true);
        }
    }
}