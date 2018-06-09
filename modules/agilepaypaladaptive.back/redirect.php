<?php
///-build_id: 2016030721.4219
/// This source file is subject to the Software License Agreement that is bundled with this 
/// package in the file license.txt, or you can get it here
/// http://addons-modules.com/en/content/3-terms-and-conditions-of-use
///
/// @copyright  2009-2012 Addons-Modules.com
///  If you need open code to customize or merge code with othe modules, please contact us.
session_start();

include_once(dirname(__FILE__).'/../../config/config.inc.php');
require_once(_PS_ROOT_DIR_ .'/modules/agilepaypaladaptive/agilepaypaladaptive.php');
require_once(_PS_ROOT_DIR_ .'/modules/agilepaypaladaptive/AgilePaypalAdaptiveTxn.php');
require_once(_PS_ROOT_DIR_ .'/modules/agilepaypaladaptive/AgilePaypalAdaptiveTxnDetail.php');
require_once(_PS_ROOT_DIR_ .'/modules/agilepaypaladaptive/Lib/Config/Config.php');
require_once(_PS_ROOT_DIR_ .'/modules/agilepaypaladaptive/Lib/CallerService.php');
require_once(_PS_ROOT_DIR_ .'/modules/agilepaypaladaptive/Lib/NVP_SampleConstants.php');

$controller = new FrontController();
$controller->init();
$controller->displayHeader();

$errors = array();
$module = new AgilePaypalAdaptive();
$paykey = $module->process_payments();
    

$smarty->assign(array(
	'doSubmit' => (empty($errors)?1:0),
	'errors' => $errors,
	'paypal_url' => $module->getPaypalUrl() . '&cmd=_ap-payment&paykey='.$paykey ,
	'redirect_text' => $module->getL('redirect_text'),
	'cancel_text' => $module->getL('cancel_text'),
	'error_title' => $module->getL('error title'),
));


$smarty->display(_PS_ROOT_DIR_.'/modules/agilepaypaladaptive/views/templates/front/redirect.tpl');

$controller->displayFooter();
