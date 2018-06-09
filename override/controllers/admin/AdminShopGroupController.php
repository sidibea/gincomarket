<?php
class AdminShopGroupController extends AdminShopGroupControllerCore
{
	
	/*
    * module: agilemultipleseller
    * date: 2017-04-25 12:22:06
    * version: 3.0.6.2
    */
    public function viewAccess($disable = false)
	{
		if(Module::isInstalled('agilemultipleshop'))return true;
		return parent::viewAccess($disable);
	}
}
