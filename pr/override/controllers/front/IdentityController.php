<?php
class IdentityController extends IdentityControllerCore
{	
	/*
    * module: agilemultipleseller
    * date: 2017-04-25 12:22:07
    * version: 3.0.6.2
    */
    public function postProcess()
	{
		parent::postProcess();
		if (Module::isInstalled('agilemultipleseller') && Tools::getValue('passwd'))
		{
			include_once(_PS_ROOT_DIR_ . "/modules/agilemultipleseller/SellerInfo.php");
			$id_seller = SellerInfo::getSellerIdByCustomerId(Context::getContext()->customer->id);
			AgileSellerManager::syncSellerCredentials('f2b', $id_seller);				
		}		
	}
}
