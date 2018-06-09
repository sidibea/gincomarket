<?php
/**
* 2007-2015 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    Magic Toolbox <support@magictoolbox.com>
*  @copyright Copyright (c) 2015 Magic Toolbox <support@magictoolbox.com>. All rights reserved
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

chdir(dirname(__FILE__).'/../blocklayered');

include(dirname(__FILE__).'/../../config/config.inc.php');
include(dirname(__FILE__).'/../../init.php');

/* NOTE: spike for prestashop validator */
if (false) {
    $smarty = $GLOBALS['smarty'];
}

$magicscrollInstance = Module::getInstanceByName('magicscroll');

if ($magicscrollInstance && $magicscrollInstance->active) {
    $magicscrollTool = $magicscrollInstance->loadTool();
    $magicscrollFilter = 'parseTemplate'.($magicscrollTool->type == 'standard' ? 'Standard' : 'Category');
    if ($magicscrollInstance->isSmarty3) {
        /* Smarty v3 template engine */
        $smarty->registerFilter('output', array($magicscrollInstance, $magicscrollFilter));
    } else {
        /* Smarty v2 template engine */
        $smarty->register_outputfilter(array($magicscrollInstance, $magicscrollFilter));
    }
    if (!isset($GLOBALS['magictoolbox']['filters'])) {
        $GLOBALS['magictoolbox']['filters'] = array();
    }
    $GLOBALS['magictoolbox']['filters']['magicscroll'] = $magicscrollFilter;
}

include(dirname(__FILE__).'/../blocklayered/blocklayered.php');

Context::getContext()->controller->php_self = 'category';
$blockLayered = new BlockLayered();
echo $blockLayered->ajaxCall();
