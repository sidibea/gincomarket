<?php
class Module extends ModuleCore
{	
	/*
    * module: agilemultipleseller
    * date: 2017-04-25 12:22:05
    * version: 3.0.6.2
    */
    public static function getInstanceByName($module_name)
	{
				$modules2skip = array('agilebankwire','agilepaybycheque');
		if(in_array($module_name, $modules2skip)) 
		{
			include_once(_PS_MODULE_DIR_.$module_name.'/'.$module_name.'.php');
			$module = new $module_name;
			return $module;
		}
		return parent::getInstanceByName($module_name);
	}	
}
