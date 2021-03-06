<?php
/**
 * Paypal Instant Checkout for PrestaShop.
 *
 * @author    PrestaMonster
 * @copyright PrestaMonster
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */

/**
 * Callback: upgrade module to 1.5.
 *
 * @param string $module
 *
 * @return bool
 */

function upgrade_module_1_5($module)
{
    return $module->upgrade('1.5');
}
