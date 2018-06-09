<?php
/**
 * Page Cache powered by Jpresta (jpresta . com)
 *
 *    @author    Jpresta
 *    @copyright Jpresta
 *    @license   You are just allowed to modify this copy for your own use. You must not redistribute it. License
 *               is permitted for one Prestashop instance only but you can install it on your test instances.
 */
class Media extends MediaCore
{
    /*
    * module: pagecache
    * date: 2018-05-31 11:39:45
    * version: 4.22
    */
    public static function clearCache()
    {
        if (Module::isEnabled('pagecache')) {
            foreach (array(_PS_THEME_DIR_ . 'cache') as $dir) {
                if (file_exists($dir) && count(array_diff(scandir($dir), array('..', '.', 'index.php'))) > 0) {
                    PageCache::clearCache();
                    break;
                }
            }
        }
        return parent::clearCache();
    }
}
