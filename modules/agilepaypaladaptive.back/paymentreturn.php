<?php
///-build_id: 2016030721.4219
/// This source file is subject to the Software License Agreement that is bundled with this 
/// package in the file license.txt, or you can get it here
/// http://addons-modules.com/en/content/3-terms-and-conditions-of-use
///
/// @copyright  2009-2012 Addons-Modules.com
///  If you need open code to customize or merge code with othe modules, please contact us.
include_once(dirname(__FILE__).'/../../config/config.inc.php');
require_once(_PS_ROOT_DIR_ .'/modules/agilepaypaladaptive/agilepaypaladaptive.php');

$controller = new FrontController();
$controller->init();
$controller->displayHeader();

$smarty->display(_PS_ROOT_DIR_.'/modules/agilepaypaladaptive/views/templates/front/return.tpl');

$controller->displayFooter();
