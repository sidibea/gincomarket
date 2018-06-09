<?php
class AdminCustomersController extends AdminCustomersControllerCore
{
    /*
    * module: agilemultipleseller
    * date: 2017-04-25 12:22:06
    * version: 3.0.6.2
    */
    public function __construct()
	{
		parent::__construct();	
		
		if($this->is_seller)
		{
						unset($this->fields_list['optin']);
			unset($this->fields_list['newsletter']);
		}
			
		if(Module::isInstalled('agilemultipleseller'))
		{
			$this->agilemultipleseller_list_override();
		}
	}
	
	/*
    * module: agilemultipleseller
    * date: 2017-04-25 12:22:06
    * version: 3.0.6.2
    */
    public function initToolbar()
	{
		parent::initToolbar();
				if($this->is_seller)
		{
			unset($this->toolbar_btn['new']);
			unset($this->toolbar_btn['save']);
		}
	}
	
	
	
	/*
    * module: agilemultipleseller
    * date: 2017-04-25 12:22:06
    * version: 3.0.6.2
    */
    public function initContent()
	{
        $this->check_seller_account();
        
        parent::initContent();
    }
    
	/*
    * module: agilemultipleseller
    * date: 2017-04-25 12:22:06
    * version: 3.0.6.2
    */
    protected function afterAdd($object)
	{
	    $this->create_seller_account($object);
		Mail::Send(
			$this->context->language->id,
			'account',
			Mail::l('Welcome!'),
				array(
					'{firstname}' => $object->firstname,
					'{lastname}' => $object->lastname,
					'{email}' => $object->email,
					'{passwd}' => Tools::getValue('passwd')),
				$object->email,
				$object->firstname.' '.$object->lastname
			);
		
		return parent::afterAdd($object);
	}
	
	/*
    * module: agilemultipleseller
    * date: 2017-04-25 12:22:06
    * version: 3.0.6.2
    */
    protected function afterUpdate($object)
	{
		$res = parent::afterUpdate($object);
		if ($res && Module::isInstalled('agilemultipleseller'))
		{
			if(Tools::getValue('id_customer') && Tools::getValue('passwd'))
			{
				include_once(_PS_ROOT_DIR_ . "/modules/agilemultipleseller/SellerInfo.php");
				$id_seller = SellerInfo::getSellerIdByCustomerId(Tools::getValue('id_customer'));
				AgileSellerManager::syncSellerCredentials('f2b', $id_seller);				
			}			
			$this->create_seller_account($object);
		}
		return $res;
	}
    /*
    * module: agilemultipleseller
    * date: 2017-04-25 12:22:06
    * version: 3.0.6.2
    */
    private function create_seller_account($object)
    {
				if($this->is_seller OR Tools::getValue('create_seller_account') <=0)return;
		if(!Module::isInstalled('agilemultipleseller'))return;
        include_once(_PS_ROOT_DIR_ . "/modules/agilemultipleseller/SellerInfo.php");
		$id_sellerinfo = SellerInfo::getIdByCustomerId($object->id);
		if($id_sellerinfo >0)return;
		include_once(_PS_ROOT_DIR_ . "/modules/agilemultipleseller/agilemultipleseller.php");
		AgileMultipleSeller::createSellerAccount($object);
    }
    
    /*
    * module: agilemultipleseller
    * date: 2017-04-25 12:22:06
    * version: 3.0.6.2
    */
    private function check_seller_account()
    {
        if(!Module::isInstalled('agilemultipleseller'))return;
        include_once(_PS_ROOT_DIR_ . "/modules/agilemultipleseller/SellerInfo.php");
        $id_customer = intval(Tools::getValue('id_customer',0));
        $id_sellerinfo = SellerInfo::getIdByCustomerId($id_customer);
		$tokenSellerinfo = '';
		if($id_sellerinfo>0)
		    $tokenSellerinfo = Tools::getAdminToken('AdminSellerinfos'.(int)(Tab::getIdFromClassName('AdminSellerinfos')).(int)$this->context->employee->id);
		$tokenSellerEmployee = '';
		$sellerinfo = new SellerInfo($id_sellerinfo);
		if(Validate::isLoadedObject($sellerinfo))
			$tokenSellerEmployee = Tools::getAdminToken('AdminEmployees'.(int)(Tab::getIdFromClassName('AdminEmployees')).(int)$this->context->employee->id);
		$this->context->smarty->assign(array(
			'id_sellerinfo' => $id_sellerinfo
			,'tokenSellerinfo' => $tokenSellerinfo
			,'id_seller_empployee' => $sellerinfo->id_seller
			,'tokenSellerEmployee' => $tokenSellerEmployee
			,'show_seller_options' => ($this->is_seller? 0:1) 
			));
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
						$this->_join = $this->_join . '	LEFT JOIN `'._DB_PREFIX_. 'customer_owner` ao ON (a.`id_customer`=ao.`id_customer`)';
	    $this->_join = $this->_join . ' LEFT JOIN `'._DB_PREFIX_.'sellerinfo` ams ON (ao.`id_owner` = ams.`id_seller`)';
		$this->_join = $this->_join . ' LEFT JOIN `'._DB_PREFIX_.'sellerinfo_lang` amsl ON (amsl.`id_sellerinfo` = ams.`id_sellerinfo` AND amsl.id_lang=' . intval($cookie->id_lang) . ')';
		$this->_join = $this->_join . '	LEFT JOIN `'._DB_PREFIX_.'sellerinfo` ls ON (a.id_customer=ls.id_customer)';
		$this->_join = $this->_join . ' INNER JOIN (
					SELECT c1.id_customer, Max(IFNULL(id_customer_owner,0)) AS id_customer_owner 
					FROM `'._DB_PREFIX_.'customer` c1
					left join `'._DB_PREFIX_.'customer_owner` o1 on c1.id_customer=o1.id_customer
					Group BY c1.id_customer
					) AS T1 ON ao.id_customer_owner = T1.id_customer_owner
			';
					
		$this->_select = $this->_select . ',amsl.company AS seller';
	        ;
		if($this->is_seller)
		{
			$cond_for_shared = 'OR IFNULL(ao.id_owner,0)=0';
			$this->_where = $this->_where . ' AND (IFNULL(ao.id_owner,0)=' . intval($cookie->id_employee) . ')';
		}
		else
		{	    
			$this->fields_list['seller'] = array('title' => $this->l('Seller'), 'width' => 20, 'filter_key' => 'amsl!company');
		}
		
        $this->_select = $this->_select 
                . ',ls.id_seller'
                ;		
		if(!$this->is_seller)
			$this->fields_list['id_seller'] = array('title' => $this->l('Seller ID'), 'filter_key' => 'ls!id_seller', 'width' => 40);
		$this->fields_list['date_add']['filter_key'] = 'a!date_add';    }
}
