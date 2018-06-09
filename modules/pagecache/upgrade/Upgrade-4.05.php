<?php
/**
 * Page Cache powered by Jpresta (jpresta . com)
 *
 *    @author    Jpresta
 *    @copyright Jpresta
 *    @license   You are just allowed to modify this copy for your own use. You must not redistribute it. License
 *               is permitted for one Prestashop instance only but you can install it on your test instances.
 */

/*
 * Remove Media override file
 */
function upgrade_module_4_05($module)
{
    $mediaFile = _PS_MODULE_DIR_ . '/' . $module->name . '/override/classes/Media.php';
    if (file_exists($mediaFile)) {
        unlink($mediaFile);
    }

    return true;
}
