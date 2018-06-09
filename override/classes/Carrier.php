<?php
class Carrier extends CarrierCore
{
    /*
    * module: agilemultipleseller
    * date: 2017-05-22 04:42:06
    * version: 3.0.6.2
    */
    public $is_default = false;
    
	/*
    * module: agilemultipleseller
    * date: 2017-05-22 04:42:06
    * version: 3.0.6.2
    */
    public function __construct($id = NULL, $id_lang = NULL)
	{
		parent::__construct($id, $id_lang);
		if(Module::isInstalled('agilemultipleseller') AND intval($id)>0)
		{
		    $sql = 'SELECT IFNULL(is_default,0) AS is_default FROM ' . _DB_PREFIX_ . 'carrier_owner WHERE id_carrier=' . intval($id);
		    $this->is_default = intval(Db::getInstance()->getValue($sql));
		}
	}
	
						/*
    * module: agilemultipleseller
    * date: 2017-05-22 04:42:06
    * version: 3.0.6.2
    */
    public static function getAvailableCarrierList(Product $product, $id_warehouse, $id_address_delivery = null, $id_shop = null, $cart = null)
	{
		$carriers = parent::getAvailableCarrierList($product, $id_warehouse, $id_address_delivery, $id_shop, $cart);
		if(!Module::isInstalled('agilesellershipping'))
			return $carriers;
		
		if(empty($carriers))
		{
			$carriers = array();
			$carriers[]  = (int)Configuration::get('AGILE_SS_CARRIER_ID');
		}
		
		return $carriers;
	}
	
						/*
    * module: agilemultipleseller
    * date: 2017-05-22 04:42:06
    * version: 3.0.6.2
    */
    public static function getCarriers($id_lang, $active = false, $delete = false, $id_zone = false, $ids_group = NULL, $modules_filters = 1)
	{
		global $cookie, $cart;
		$carriers = parent::getCarriers($id_lang, $active, $delete, $id_zone, $ids_group, $modules_filters);
		if(!Module::isInstalled('agilemultipleseller'))return $carriers;
		
		$id_seller_for_filter = AgileSellerManager::get_id_seller_for_filter();
		
		if((int)$id_seller_for_filter <=0)return $carriers;
						$retCarriers = array();
		foreach($carriers AS $carrier)
		{
			$id_owner = AgileSellerManager::getObjectOwnerID('carrier', $carrier['id_carrier']);
			if($id_seller_for_filter == $id_owner || $id_owner == 0)
			{
				$retCarriers[] = $carrier;
			}
		}
		
		return $retCarriers;
	}
	
		/*
    * module: agilemultipleseller
    * date: 2017-05-22 04:42:06
    * version: 3.0.6.2
    */
    public function addDeliveryPrice($price_list, $delete = false)
	{
		if (!$price_list)
			return false;
		$keys = array_keys($price_list[0]);
		if (!in_array('id_shop', $keys))
			$keys[] = 'id_shop';
		if (!in_array('id_shop_group', $keys))
			$keys[] = 'id_shop_group';
		$sql = 'INSERT INTO `'._DB_PREFIX_.'delivery` ('.implode(', ', $keys).') VALUES ';
		foreach ($price_list as $values)
		{
			if (!isset($values['id_shop']))
				$values['id_shop'] =  null;  			if (!isset($values['id_shop_group']))
				$values['id_shop_group'] = null;  
			if ($delete)
				Db::getInstance()->execute('
					DELETE FROM `'._DB_PREFIX_.'delivery` 
					WHERE '.(is_null($values['id_shop']) ? 'ISNULL(`id_shop`) ' : 'id_shop = '.(int)$values['id_shop']).' 
					AND '.(is_null($values['id_shop_group']) ? 'ISNULL(`id_shop`) ' : 'id_shop_group='.(int)$values['id_shop_group']).'
					AND id_carrier='.(int)$values['id_carrier'].
					($values['id_range_price'] !== null ? ' AND id_range_price='.(int)$values['id_range_price'] : ' AND (ISNULL(`id_range_price`) OR `id_range_price` = 0)').
					($values['id_range_weight'] !== null ? ' AND id_range_weight='.(int)$values['id_range_weight'] : ' AND (ISNULL(`id_range_weight`) OR `id_range_weight` = 0)').'
					AND id_zone='.(int)$values['id_zone']
					);
			$sql .= '(';
			foreach ($values as $v)
			{
				if (is_null($v))
					$sql .= 'NULL';
				else if (is_int($v) || is_float($v))
					$sql .= $v;
				else
					$sql .= '\''.$v.'\'';
				$sql .= ', ';
			}
			$sql = rtrim($sql, ', ').'), ';
		}
		$sql = rtrim($sql, ', ');
		return Db::getInstance()->execute($sql);
	}
	
        	/*
    * module: agilemultipleseller
    * date: 2017-05-22 04:42:06
    * version: 3.0.6.2
    */
    public static function getCarriersForOrder($id_zone, $groups = NULL, $theCart = NULL)
	{
		global $cookie, $cart;
		if( is_null($theCart))$theCart = $cart;
		if(!Module::isInstalled('agilesellershipping'))return parent::getCarriersForOrder($id_zone, $groups,$theCart);
				if($cookie->id_employee >0)return  parent::getCarriersForOrder($id_zone, $groups, $theCart);
        include_once(_PS_ROOT_DIR_  . "/modules/agilesellershipping/agilesellershipping.php");
		include_once(_PS_ROOT_DIR_  . "/modules/agilesellershipping/SellerShipping.php");
		$id_carrier = (int)Configuration::get('AGILE_SS_CARRIER_ID');
        $id_zone = SellerShipping::getZoneID($theCart->id_address_delivery, $theCart->id_customer);
				$use_default_carrier = intval(Configuration::get('AGILE_SS_AS_DEFAULT_CARRIER'));
		$products_without_carrier = SellerShipping::products_without_carrier($id_zone, $theCart->id, $cookie->id_lang);
		if(!empty($products_without_carrier))			
		{
			return array();
		} 
		
		return SellerShipping::getLinkedCarriersForOrder($id_carrier, $id_zone);
    }
    
    		/*
    * module: agilemultipleseller
    * date: 2017-05-22 04:42:06
    * version: 3.0.6.2
    */
    public function add($autodate = true, $nullValues = false)
	{
		if(_PS_VERSION_ >= '1.5')return parent::add($autodate, $nullValues); 				if (!parent::add($autodate, $nullValues))
			return false;
	    
        include_once(dirname(__FILE__) . "/../../modules/agilemultipleseller/agilemultipleseller.php");
	    $sql = 'INSERT INTO `'._DB_PREFIX_. 'carrier_owner` (id_owner,id_carrier,is_default) values(' . intval(Tools::getValue('id_seller')) . ',' . $this->id . ','. intval(Tools::getValue('is_default')) . ')';
	    Db::getInstance()->Execute($sql);
        return true;    
    }
	
	/*
    * module: agilemultipleseller
    * date: 2017-05-22 04:42:06
    * version: 3.0.6.2
    */
    public static function getActiveIDByID($id_carrier)
	{
		$sql = 'SELECT id_carrier  
				FROM `' . _DB_PREFIX_ . 'carrier` 
				WHERE deleted = 0 and id_reference in (select id_reference FROM ' . _DB_PREFIX_ . 'carrier where id_carrier = ' . (int)$id_carrier. ')	
				';
		return (int)Db::getInstance()->getValue($sql);
	}
}
