<?php
abstract class ModuleAdminController extends ModuleAdminControllerCore
{
	/*
    * module: agilemultipleseller
    * date: 2017-04-25 12:22:05
    * version: 3.0.6.2
    */
    protected function l($string, $class = 'AdminTab', $addslashes = false, $htmlentities = true)
	{
		return Translate::getModuleTranslation($this->module, $string, Tools::getValue('controller'));
	}
}
