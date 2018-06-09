<?php
class Order extends OrderCore
{
	/*
    * module: agilemultipleseller
    * date: 2017-04-25 12:22:05
    * version: 3.0.6.2
    */
    public static function getCustomerOrders($id_customer, $showHiddenStatus = false, Context $context = null)
	{
		$res = parent::getCustomerOrders($id_customer, $showHiddenStatus,  $context);
		if(!Module::isInstalled('agilemultipleseller'))return $res;
		if($context == null)$context = Context::getContext();
		if($context->cookie->id_employee == 0 || ($context->cookie->profile != (int)Configuration::get('AGILE_MS_PROFILE_ID')))return $res;  
		$ret = array();
		foreach($res as $data)
		{
			$id_owner = AgileSellerManager::getObjectOwnerID('order',$data['id_order']);
			if($id_owner != $context->cookie->id_employee)continue;
			$ret[] = $data;
		}
		return $ret;
	}
	
	/*
    * module: agilemultipleseller
    * date: 2017-04-25 12:22:05
    * version: 3.0.6.2
    */
    public function getProductsDetail()
	{
	    global $cookie;
	    if(!Module::isInstalled('agilemultipleseller'))return parent::getProductsDetail(); 	    if(intval($cookie->id_employee)==0)return parent::getProductsDetail(); 	    if(intval($cookie->profile) != intval(Configuration::get('AGILE_MS_PROFILE_ID')))return parent::getProductsDetail(); 
		$sql = 'SELECT *
		FROM `'._DB_PREFIX_.'order_detail` od
		    LEFT JOIN `'._DB_PREFIX_.'product_owner` po ON od.product_id = po.id_product
		WHERE od.`id_order` = '.(int)($this->id) . ' AND po.id_owner = ' . $cookie->id_employee;
		return Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS($sql);
	}
}
