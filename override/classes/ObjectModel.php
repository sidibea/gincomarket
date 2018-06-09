<?php
abstract class ObjectModel extends ObjectModelCore
{
	/*
    * module: agilemultipleseller
    * date: 2017-04-25 12:22:05
    * version: 3.0.6.2
    */
    public function __construct($id = null, $id_lang = null, $id_shop = null)
	{
		parent::__construct($id, $id_lang, $id_shop);
    }
	
	/*
    * module: agilemultipleseller
    * date: 2017-04-25 12:22:05
    * version: 3.0.6.2
    */
    public function add($autodate = true, $nullValues = false)
	{
		if(!Module::isInstalled('agilemultipleseller'))return parent::add($autodate, $nullValues);
						
		if (!parent::add($autodate, $nullValues))return false;
						if(Module::isInstalled('agilemultipleseller') AND $this->table != 'orders')$this->assign_entity_owner();
						if($this->table =='product' OR $this->table =='category' OR $this->table =='lang')
		{
			ObjectModel::cleear_unnecessary_lang_data();
		}	
        return true;   
    }
	
	/*
    * module: agilemultipleseller
    * date: 2017-04-25 12:22:05
    * version: 3.0.6.2
    */
    public static function cleear_unnecessary_lang_data()
	{
		Db::getInstance()->Execute('DELETE FROM ' . _DB_PREFIX_ . 'product_lang WHERE id_shop!=' . Shop::getContextShopID());
		Db::getInstance()->Execute('DELETE FROM ' . _DB_PREFIX_ . 'category_lang WHERE id_shop!=' . Shop::getContextShopID());
		Db::getInstance()->Execute('DELETE FROM ' . _DB_PREFIX_ . 'category_shop WHERE id_shop!=' . Shop::getContextShopID());		
	}
	/*
    * module: agilemultipleseller
    * date: 2017-04-25 12:22:05
    * version: 3.0.6.2
    */
    public function update($null_values = false)
	{
		global $cookie;
		if(!Module::isInstalled('agilemultipleseller'))return parent::update($null_values);
				if(!$this->can_edit())return false;
		if (!parent::update($null_values))return false;
				if(Module::isInstalled('agilemultipleseller'))
		{
			$is_seller = ($cookie->profile == (int)Configuration::get('AGILE_MS_PROFILE_ID'));
			if(!$is_seller AND $this->table!='orders')$this->assign_entity_owner();
		}
		if($this->table =='product' OR $this->table =='category' OR $this->table =='lang')
		{
			ObjectModel::cleear_unnecessary_lang_data();
		}	
		return true;
	}
	
	/*
    * module: agilemultipleseller
    * date: 2017-04-25 12:22:05
    * version: 3.0.6.2
    */
    public function delete()
	{
		if(!Module::isInstalled('agilemultipleseller'))return parent::delete();
				if(!$this->can_edit())return false;
		if (!parent::delete())return false;
		AgileSellerManager::deleteObjectOwner($this->table, $this->id);
		
		return true;
	}
			/*
    * module: agilemultipleseller
    * date: 2017-04-25 12:22:05
    * version: 3.0.6.2
    */
    private function can_edit()
	{
		global $cookie;
		if(!Module::isInstalled('agilemultipleseller'))return true;
				if($this->table =='image' OR $this->table=='product_attribute')return true;
						if(intval($cookie->profile) == 0) 
			return true;
				
				if($cookie->profile > 0 AND $cookie->profile != (int)Configuration::get('AGILE_MS_PROFILE_ID'))
			return true;
		
		$eaccess = AgileSellerManager::get_entity_access($this->table);
		$xr_table = $eaccess['owner_xr_table'];
		if(empty($xr_table))
		{
			if(intval($this->id)<=0)return true; 
						if($this->id == $cookie->id_employee AND $this->table == 'employee')return true;
			if(!AgileSellerManager::hasOwnership($this->table,$this->id))return false;
		}
		else
		{
			$xr_objid = intval($this->{'id_' . $xr_table});
			if(intval($xr_objid)<=0)return true; 			if(!AgileSellerManager::hasOwnership($xr_table,$xr_objid))return false;
			
		}
		return true;
	}
	/*
    * module: agilemultipleseller
    * date: 2017-04-25 12:22:05
    * version: 3.0.6.2
    */
    private function assign_entity_owner()
	{
		global $cookie;
	    if(!Module::isInstalled('agilemultipleseller'))return true;
				if(isset($_GET['status' . $this->table]))return true;
				$eaccess = AgileSellerManager::get_entity_access($this->table);
				if($eaccess['owner_table_type'] == AgileSellerManager::OWNER_TABLE_UNKNOWN)return true;
        include_once(_PS_ROOT_DIR_  . "/modules/agilemultipleseller/agilemultipleseller.php");
		global $cookie;
								if(empty($eaccess['owner_xr_table']))
		{
			$is_seller = ($cookie->profile == (int)Configuration::get('AGILE_MS_PROFILE_ID'));
						if($is_seller AND (Tools::getValue('controller') == 'AdminCarrierWizard' OR  isset($_GET['submitAdd' . $this->table]) OR isset($_POST['submitAdd' . $this->table]) OR isset($_POST['submitAdd' . $this->table . 'AndStay']) OR (isset($_POST['import']) AND $_POST['import']=1 AND  isset($_POST['csv']) ) ))
			{	
				$id_seller = $cookie->id_employee;
			}
						elseif(isset($_POST['id_seller']))
			{
				$id_seller = intval($_POST['id_seller']);
			}
						else
			{
				$id_seller = 0;
			}
			AgileSellerManager::assignObjectOwner($this->table, $this->id, $id_seller);
		}
		return true;
	}
}
