<?php
/**
 * Paypal Instant Checkout for PrestaShop.
 *
 * @author    PrestaMonster
 * @copyright PrestaMonster
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */

/**
 * Callback: upgrade module to 1.9.0
 *
 * @param string $module
 *
 * @return bool
 */

function upgrade_module_1_9_0($module)
{
    return $module->upgrade('1.9.0');
}