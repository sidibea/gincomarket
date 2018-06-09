<?php
class AdminAddressesController extends AdminAddressesControllerCore
{
	/*
    * module: agilemultipleseller
    * date: 2017-04-25 12:22:06
    * version: 3.0.6.2
    */
    public function __construct()
	{
		parent::__construct();
		
		if(Module::isInstalled('agilemultipleseller'))
		{
			$this->agilemultipleseller_list_override();
		}
	}
	
	/*
    * module: agilemultipleseller
    * date: 2017-04-25 12:22:06
    * version: 3.0.6.2
    */
    public function initToolbar()
	{
		parent::initToolbar();
				if($this->is_seller)
		{
			unset($this->toolbar_btn['new']);
			unset($this->toolbar_btn['save']);
		}
	}
	
	/*
    * module: agilemultipleseller
    * date: 2017-04-25 12:22:06
    * version: 3.0.6.2
    */
    protected function agilemultipleseller_list_override()
	{
		if(!Module::isInstalled('agilemultipleseller'))return;
				if(!$this->is_seller)return;
		parent::agilemultipleseller_list_override();
				$this->fields_list['address1']['filter_key'] = 'a!address1';
		$this->fields_list['postcode']['filter_key'] = 'a!postcode';
		$this->fields_list['city']['filter_key'] = 'a!city';		
	}
}
