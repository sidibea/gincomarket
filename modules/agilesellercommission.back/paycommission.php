<?php
///-build_id: 2017010213.5255
/// This source file is subject to the Software License Agreement that is bundled with this 
/// package in the file license.txt, or you can get it here
/// http://addons-modules.com/en/content/3-terms-and-conditions-of-use
///
/// @copyright  2009-2016 Addons-Modules.com
///  If you need open code to customize or merge code with othe modules, please contact us.
include_once(dirname(__FILE__).'/../../config/config.inc.php');
include_once(_PS_ROOT_DIR_ . '/modules/agilesellercommission/agilesellercommission.php');
include_once(_PS_ROOT_DIR_ . '/modules/agilesellercommission/SellerCommission.php');
include_once(_PS_ROOT_DIR_ .'/modules/agilemultipleseller/agilemultipleseller.php');
include_once(_PS_ROOT_DIR_ .'/modules/agilemultipleseller/SellerInfo.php');
$controller = new FrontController();
$controller->init();
$controller->displayHeader();

$module = new AgileSellerCommission();

$error_msg = $module->process_paycommission();
if(!empty($error_msg))
	$controller->errors[] = $error_msg;

$controller->displayContent();
$smarty->display(_PS_ROOT_DIR_. '/modules/agilesellercommission/views/templates/front/paycommission.tpl');

$controller->displayFooter();

