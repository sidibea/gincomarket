<?php
class AuthController extends AuthControllerCore
{	
	/*
    * module: agilemultipleseller
    * date: 2017-05-22 04:42:09
    * version: 3.0.6.2
    */
    protected function processSubmitAccount()
	{
		$PS_REGISTRATION_PROCESS_TYPE = (int)Configuration::get('PS_REGISTRATION_PROCESS_TYPE');
		if(Module::isInstalled('agilemultipleseller') && isset($_POST['seller_account_signup']) && intval($_POST['seller_account_signup'])==1 && $PS_REGISTRATION_PROCESS_TYPE != 1)
		{
			global $cookie;
			
			$default_lang = new Language(intval(Configuration::get('PS_LANG_DEFAULT')));
			if(!isset($_POST['company_' . $default_lang->id]) || empty($_POST['company_' . $default_lang->id]))$_POST['company_' . $default_lang->id] = Tools::getValue('company_' . $cookie->id_lang);
			$company = Tools::getValue('company_' . $default_lang->id);	
			$id_country = (int)Tools::getValue('id_country');	
			if($company == "")$this->errors[] = Tools::displayError('Company in default language is required');		
			if(!$id_country)$this->errors[] = Tools::displayError('Country is required');	
		}
		parent::processSubmitAccount();
	}
	
}
