<?php
class OrderController extends OrderControllerCore
{
	/*
    * module: agilemultipleseller
    * date: 2017-04-25 12:22:07
    * version: 3.0.6.2
    */
    public function process()
	{
		parent::process();
        if(Module::isInstalled('agilesellershipping'))
        {
            include_once(_PS_ROOT_DIR_  . "/modules/agilesellershipping/agilesellershipping.php");
            if (intval($this->step) ==2)AgileSellerShipping::override_carriers();
        }
    }
    
}
