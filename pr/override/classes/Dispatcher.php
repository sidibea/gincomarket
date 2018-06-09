<?php
class Dispatcher extends DispatcherCore
{
	/*
    * module: agilemultipleseller
    * date: 2017-04-25 12:22:04
    * version: 3.0.6.2
    */
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
	
	
	/*
    * module: agilemultipleseller
    * date: 2017-04-25 12:22:04
    * version: 3.0.6.2
    */
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
