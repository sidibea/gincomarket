<?php
///-build_id: 2015031920.2559
/// This source file is subject to the Software License Agreement that is bundled with this 
/// package in the file license.txt, or you can get it here
/// http://addons-modules.com/en/content/3-terms-and-conditions-of-use
///
/// @copyright  2009-2012 Addons-Modules.com
///  If you need open code to customize or merge code with othe modules, please contact us.

class Dispatcher extends DispatcherCore
{
	protected function __construct()
	{
		if(Module::isInstalled('agilemultipleshop'))
		{
			include_once(_PS_ROOT_DIR_ ."/modules/agilemultipleshop/agilemultipleshop.php");
			$this->default_routes = array_merge($this->default_routes, AgileMultipleShop::get_rewrite_rules());			
		}
		if(Module::isInstalled('agileshowcasemanager'))
		{
			include_once(_PS_ROOT_DIR_ ."/modules/agileshowcasemanager/agileshowcasemanager.php");
			$this->default_routes = array_merge($this->default_routes, AgileShowcaseManager::get_rewrite_rules());			
		}
		
		parent::__construct();

	}	
	
	
	public function createUrl($route_id, $id_lang = null, array $params = array(), $force_routes = false, $anchor = '', $id_shop = null)
	{
		
		global $link;
		if($route_id =="agilesellers")
		{
			return $link->getAgileSellersLink(Tools::getValue('filter'),$id_lang, Tools::getValue('loclevel'), Tools::getValue('parentid'));
		}
		if($route_id =="sellerlocation")
		{
			return $link->getSellerLocationLink(Tools::getValue('$id_location'), Tools::getValue('location_level'), NULL, $id_lang);
		}
		if($route_id =="sellercountry")
		{
						return $link->getSellerCountryLink(Tools::getValue('id_seller_country'), NULL, $id_lang);
		}		
		
		return parent::createUrl($route_id, $id_lang, $params, $force_routes, $anchor);
	}
}

