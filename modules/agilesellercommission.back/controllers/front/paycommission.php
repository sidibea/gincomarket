<?php
///-build_id: 2017010213.5255
/// This source file is subject to the Software License Agreement that is bundled with this 
/// package in the file license.txt, or you can get it here
/// http://addons-modules.com/en/content/3-terms-and-conditions-of-use
///
/// @copyright  2009-2016 Addons-Modules.com
///  If you need open code to customize or merge code with othe modules, please contact us.
include_once(_PS_ROOT_DIR_ . '/modules/agilesellercommission/agilesellercommission.php');
include_once(_PS_ROOT_DIR_ . '/modules/agilesellercommission/SellerCommission.php');
include_once(_PS_ROOT_DIR_ .'/modules/agilemultipleseller/agilemultipleseller.php');
include_once(_PS_ROOT_DIR_ .'/modules/agilemultipleseller/SellerInfo.php');
class AgileSellerCommissionPayCommissionModuleFrontController extends ModuleFrontController
{
		public $display_column_left = true;
	public $ssl = true;

	public function initContent()   {    parent::initContent();      $R01787CB5A57D47DC8A648998E4A6512C = new AgileSellerCommission();        $RC580CF4D4E001BBB41F9BA5B20131425 = $R01787CB5A57D47DC8A648998E4A6512C->process_paycommission();    if(!empty($RC580CF4D4E001BBB41F9BA5B20131425))     $this->errors[] = $RC580CF4D4E001BBB41F9BA5B20131425;      $this->context->smarty->assign(array(     'errors' => $this->errors     ));         $this->setTemplate('module:agilesellercommission/views/templates/front/paycommission.tpl');     }  }    