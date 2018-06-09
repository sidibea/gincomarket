<?php
/**
 * Page Cache powered by Jpresta (jpresta . com)
 *
 *    @author    Jpresta
 *    @copyright Jpresta
 *    @license   You are just allowed to modify this copy for your own use. You must not redistribute it. License
 *               is permitted for one Prestashop instance only but you can install it on your test instances.
 */

if (!defined('_CAN_LOAD_FILES_'))
    exit;

abstract class PageCacheCache
{
    abstract public function get($key, $ttl = 0);
    abstract public function set($key, $value);
    abstract public function delete($key);
    abstract public function flush();
}