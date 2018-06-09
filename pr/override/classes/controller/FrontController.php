<?php
class FrontController extends FrontControllerCore
{
	/*
    * module: agilemultipleseller
    * date: 2017-04-25 12:22:05
    * version: 3.0.6.2
    */
    public function initHeader()
	{
		parent::initHeader();
		
		if(Module::isInstalled('agilemultipleshop'))
		{
			include_once(_PS_ROOT_DIR_  . "/modules/agilemultipleshop/agilemultipleshop.php");
			AgileMultipleShop::init_shop_header();
			AgileMultipleShop::clear_blockcategory_cache();
		}
	}	
}
