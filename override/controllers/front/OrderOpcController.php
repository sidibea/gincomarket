<?php
class OrderOpcController extends OrderOpcControllerCore
{
	/*
    * module: agilemultipleseller
    * date: 2017-05-22 04:42:09
    * version: 3.0.6.2
    */
    public function process()
	{
		parent::process();
        if(Module::isInstalled('agilesellershipping'))
        {
            include_once(_PS_ROOT_DIR_  . "/modules/agilesellershipping/agilesellershipping.php");
            AgileSellerShipping::override_carriers();
        }
    }
}
