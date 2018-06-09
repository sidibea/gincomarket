<?php
///-build_id: 2015031920.2559
/// This source file is subject to the Software License Agreement that is bundled with this 
/// package in the file license.txt, or you can get it here
/// http://addons-modules.com/en/content/3-terms-and-conditions-of-use
///
/// @copyright  2009-2012 Addons-Modules.com
///  If you need open code to customize or merge code with othe modules, please contact us.
class Module extends ModuleCore
{	

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
