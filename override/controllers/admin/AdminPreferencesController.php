<?php
class AdminPreferencesController extends AdminPreferencesControllerCore
{
	/*
    * module: agilemultipleseller
    * date: 2017-05-22 04:42:09
    * version: 3.0.6.2
    */
    public function __construct()
	{
		parent::__construct();
				if(Module::isInstalled('agilemultipleseller') OR Module::isInstalled('agilemultipleshop'))
			unset($this->fields_options['general']['fields']['PS_MULTISHOP_FEATURE_ACTIVE']);	
	}
}
