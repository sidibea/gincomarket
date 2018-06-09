<?php
class AdminLanguagesController extends AdminLanguagesControllerCore
{
	/*
    * module: agilemultipleseller
    * date: 2017-04-25 12:22:06
    * version: 3.0.6.2
    */
    public function processAdd()
	{
		$ret = parent::processAdd();
		if(!Module::isInstalled('agilemultipleseller'))return $ret;
		ObjectModel::cleear_unnecessary_lang_data();
		return $ret;
	}
	/*
    * module: agilemultipleseller
    * date: 2017-04-25 12:22:06
    * version: 3.0.6.2
    */
    public function processUpdate()
	{
		$ret = parent::processUpdate();
		if(!Module::isInstalled('agilemultipleseller'))return $ret;
		ObjectModel::cleear_unnecessary_lang_data();
		return $ret;
	}
}