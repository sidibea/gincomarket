<?php
class AdminOrdersController extends AdminOrdersControllerCore
{
	/*
    * module: agilemultipleseller
    * date: 2017-05-22 04:42:09
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
    * date: 2017-05-22 04:42:09
    * version: 3.0.6.2
    */
    public function initToolbar()
	{
		parent::initToolbar();
		if(!Module::isInstalled('agilemultipleseller'))return;
				if($this->is_seller)
		{
			unset($this->toolbar_btn['new']);
		}
	}
	
	/*
    * module: agilemultipleseller
    * date: 2017-05-22 04:42:09
    * version: 3.0.6.2
    */
    public function renderView()
	{
		global $cookie;
		if(Module::isInstalled('agilemultipleseller') && !intval(Tools::getValue('id_product')) AND $this->is_seller AND AgileSellerManager::limited_by_membership($cookie->id_employee))
		{
			$this->errors[] = Tools::displayError('You have not purchased membership yet or you have registered products more than limit allowed by your membership.');
			return;
		}
		
		return parent::renderView();
	}	
}
