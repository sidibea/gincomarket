<?php
///-build_id: 2015031920.2559
/// This source file is subject to the Software License Agreement that is bundled with this 
/// package in the file license.txt, or you can get it here
/// http://addons-modules.com/en/content/3-terms-and-conditions-of-use
///
/// @copyright  2009-2012 Addons-Modules.com
///  If you need open code to customize or merge code with othe modules, please contact us.

abstract class ModuleAdminController extends ModuleAdminControllerCore
{
	protected function l($string, $class = 'AdminTab', $addslashes = false, $htmlentities = true)
	{
		return Translate::getModuleTranslation($this->module, $string, Tools::getValue('controller'));
	}

}

