<?php
class Language extends LanguageCore
{
	/*
    * module: agilemultipleseller
    * date: 2017-04-25 12:22:05
    * version: 3.0.6.2
    */
    public static function checkAndAddLanguage($iso_code, $lang_pack = false, $only_add = false, $params_lang = null)
	{
		$ret = parent::checkAndAddLanguage($iso_code, $lang_pack = false, $only_add = false, $params_lang = null);
		if(!Module::isInstalled('agilemultipleseller'))return $ret;
		ObjectModel::cleear_unnecessary_lang_data();
		return $ret;
	}
}
