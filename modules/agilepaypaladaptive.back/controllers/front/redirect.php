<?php
///-build_id: 2016030721.4219
/// This source file is subject to the Software License Agreement that is bundled with this 
/// package in the file license.txt, or you can get it here
/// http://addons-modules.com/en/content/3-terms-and-conditions-of-use
///
/// @copyright  2009-2012 Addons-Modules.com
///  If you need open code to customize or merge code with othe modules, please contact us.
require_once(_PS_ROOT_DIR_ .'/modules/agilepaypaladaptive/agilepaypaladaptive.php');
require_once(_PS_ROOT_DIR_ .'/modules/agilepaypaladaptive/AgilePaypalAdaptiveTxn.php');
require_once(_PS_ROOT_DIR_ .'/modules/agilepaypaladaptive/AgilePaypalAdaptiveTxnDetail.php');
require_once(_PS_ROOT_DIR_ .'/modules/agilepaypaladaptive/Lib/Config/Config.php');
require_once(_PS_ROOT_DIR_ .'/modules/agilepaypaladaptive/Lib/CallerService.php');
require_once(_PS_ROOT_DIR_ .'/modules/agilepaypaladaptive/Lib/NVP_SampleConstants.php');
class AgilePaypalAdaptiveRedirectModuleFrontController extends ModuleFrontController
{
	public $ssl = true;

	public function initContent()   {    global $paykey;        $this->display_column_left = false;        parent::initContent();      $R01787CB5A57D47DC8A648998E4A6512C = new AgilePaypalAdaptive();    $R41718C5BEC3C5571414B13A5B401195C = $R01787CB5A57D47DC8A648998E4A6512C->process_payments();    $this->context->smarty->assign(array(     'doSubmit' => (empty($R41718C5BEC3C5571414B13A5B401195C)?1:0),     'payment_errors' => $R41718C5BEC3C5571414B13A5B401195C,     'paypal_url' => $R01787CB5A57D47DC8A648998E4A6512C->getPaypalUrl() . '&cmd=_ap-payment&paykey='.$paykey ,     'redirect_text' => $R01787CB5A57D47DC8A648998E4A6512C->getL('redirect_text'),     'cancel_text' => $R01787CB5A57D47DC8A648998E4A6512C->getL('cancel_text'),     'error_title' => $R01787CB5A57D47DC8A648998E4A6512C->getL('error title'),    ));        $this->setTemplate('redirect.tpl');   }  }  