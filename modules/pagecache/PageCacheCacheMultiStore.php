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

class PageCacheCacheMultiStore extends PageCacheCache
{
    private $caches = array();

    public function addCache($cache) {
        $this->caches[] = $cache;
    }

    public function get($key, $ttl = 0) {
        // Should not be called
        foreach ($this->caches as $cache){
            $value = $cache->get($key, $ttl);
            if ($value !== false) {
                return $value;
            }
        }
        return false;
    }

    public function set($key, $value) {
        // Should not be called
        foreach ($this->caches as $cache){
            $cache->set($key, $value);
        }
    }

    public function delete($key) {
        foreach ($this->caches as $cache){
            $cache->delete($key);
        }
    }

    public function flush() {
        foreach ($this->caches as $cache){
            $cache->flush();
        }
    }
}