<?php
class AdminShopUrlController extends AdminShopUrlControllerCore
{
	/*
    * module: agilemultipleseller
    * date: 2017-05-22 04:42:09
    * version: 3.0.6.2
    */
    public function viewAccess($disable = false)
	{
		if(Module::isInstalled('agilemultipleshop'))return true;
		return parent::viewAccess($disable);
	}
}
