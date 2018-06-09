<?php
class AdminSuppliersController extends AdminSuppliersControllerCore
{
	/*
    * module: agilemultipleseller
    * date: 2017-04-25 12:22:06
    * version: 3.0.6.2
    */
    public function __construct()
	{
		parent::__construct();
		
		if(!$this->is_seller)
		{
			$this->fields_list['seller'] = array('title' => $this->l('Seller'), 'width' => 20, 'filter_key' => 'amsl!company');
		}
	}
	
	/*
    * module: agilemultipleseller
    * date: 2017-04-25 12:22:06
    * version: 3.0.6.2
    */
    public function getList($id_lang, $orderBy = NULL,  $orderWay = NULL,  $start = 0, $limit = NULL, $id_lang_shop = false)
	{
		global $cookie;
		if(Module::isInstalled('agilemultipleseller'))
			$this->agilemultipleseller_list_override();
		parent::getList($id_lang, $orderBy , $orderWay, $start, $limit);
	}
	
	/*
    * module: agilemultipleseller
    * date: 2017-04-25 12:22:06
    * version: 3.0.6.2
    */
    protected function agilemultipleseller_list_override()
	{
		global $cookie;
		
		if(!Module::isInstalled('agilemultipleseller'))return;
		parent::agilemultipleseller_list_override();
		if($this->is_seller)
		{
			$this->_where = $this->_where . ' AND IFNULL(ao.`id_owner`,0) > 0';
		}
		else
		{
			if(empty($this->_select) OR substr(trim($this->_select),-1,1) == ",")
			{
				$this->_select = $this->_select . 'amsl.company AS seller';
			}
			else
			{
				$this->_select = $this->_select . ',amsl.company AS seller';
			}
		}
	}
	
}
