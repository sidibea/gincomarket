<?php
///-build_id: 2016071823.0745
/// This source file is subject to the Software License Agreement that is bundled with this 
/// package in the file license.txt, or you can get it here
/// http://addons-modules.com/en/content/3-terms-and-conditions-of-use
///
/// @copyright  2009-2012 Addons-Modules.com
///  If you need open code to customize or merge code with othe modules, please contact us.
include_once(_PS_ROOT_DIR_ .'/modules/agilesellershipping/agilesellershipping.php');

class AgileSellerShippingSellerCarriersModuleFrontController extends AgileModuleFrontController
{
	public function init()   {    parent::init();   }      public function postProcess()   {    if(Tools::getValue('process') == 'delete' AND $R7758044F291E56EF1C05384E5BC64056=Tools::getValue('id_carrier'))    {     $R1B8AE585FCBE16464BB4673988D498E2 = AgileSellerManager::getObjectOwnerID('carrier', $R7758044F291E56EF1C05384E5BC64056);        $R17580FDEFC33F6F2D6227DC3791548D7 = ($R1B8AE585FCBE16464BB4673988D498E2 > 0 && $R1B8AE585FCBE16464BB4673988D498E2 == $this->sellerinfo->id_seller);     if(!$R17580FDEFC33F6F2D6227DC3791548D7)     {      $this->errors[] = Tools::displayError('You do not have permission to delete this carrier. ');     }     if(empty($this->errors))     {      $R7E774ED878B5E9C433BBD2BDB1E6B803 = new Carrier((int)$R7758044F291E56EF1C05384E5BC64056);      $this->beforeDelete($R7E774ED878B5E9C433BBD2BDB1E6B803);      $R7E774ED878B5E9C433BBD2BDB1E6B803->delete();      $this->afterDelete($R7E774ED878B5E9C433BBD2BDB1E6B803,$R7E774ED878B5E9C433BBD2BDB1E6B803->id);     }    }        parent::postProcess();   }      public function initContent()   {       parent::initContent();                    $R9AB433A467E2C30E21FA208513B3B5B9 = (int)Configuration::get('PS_CURRENCY_DEFAULT');    $RE1B2B3167E624F30E44FB480AE7FA500 = AgileSellerManager::getCarriersBySellerId($this->sellerinfo->id_seller, $this->context->language->id);         self::$smarty->assign(array(              'seller_tab_id' => 6     ,'carriers' => $RE1B2B3167E624F30E44FB480AE7FA500     ));      $this->setTemplate('sellercarriers.tpl');   }  }  