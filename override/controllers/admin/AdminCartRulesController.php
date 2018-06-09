<?php
class AdminCartRulesController extends AdminCartRulesControllerCore
{
	/*
    * module: agilemultipleseller
    * date: 2017-04-25 12:22:06
    * version: 3.0.6.2
    */
    public function initToolbar()
	{
		if(Module::isInstalled('agilemultipleseller') AND $this->is_seller)return;
		parent::initToolbar();
	}
}
