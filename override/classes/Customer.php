<?php
class Customer extends CustomerCore
{
	/*
    * module: agilemultipleseller
    * date: 2017-05-22 04:42:06
    * version: 3.0.6.2
    */
    public function getBoughtProducts()
	{
		if(!Module::isInstalled('agilemultipleseller'))return parent::getBoughtProducts();
		$context = Context::getContext();
		if($context->cookie->id_employee == 0 || ($context->cookie->profile != (int)Configuration::get('AGILE_MS_PROFILE_ID')))return parent::getBoughtProducts();  
		
		$sql = 'SELECT * 
				FROM `'._DB_PREFIX_.'orders` o
					LEFT JOIN `'._DB_PREFIX_.'order_detail` od ON o.id_order = od.id_order
					LEFT JOIN `'._DB_PREFIX_.'product_owner` po ON od.product_id = po.id_product
				WHERE o.valid = 1 
					AND o.`id_customer` = '.(int)$this->id . '
					AND po.`id_owner` = '.(int)$context->cookie->id_employee . '
				';
			return Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
	}
	
	/*
    * module: agilemultipleseller
    * date: 2017-05-22 04:42:06
    * version: 3.0.6.2
    */
    public function mylogout()
	{
		if(Module::isInstalled('agilemultipleshop'))
		{	
			unset($_SESSION[Context::getContext()->cookie->getName()]);
		}
		parent::mylogout();
	}
	
	/*
    * module: agilemultipleseller
    * date: 2017-05-22 04:42:06
    * version: 3.0.6.2
    */
    public function logout()
	{
		if(Module::isInstalled('agilemultipleshop'))
		{	
			unset($_SESSION[Context::getContext()->cookie->getName()]);
		}
		
		parent::logout();
	}
	
	/*
    * module: agilemultipleseller
    * date: 2017-05-22 04:42:06
    * version: 3.0.6.2
    */
    public function delete()
	{
		$ret = parent::delete();
		if(Module::isInstalled('agilemultipleseller'))
		{
			include_once(_PS_ROOT_DIR_ . "/modules/agilemultipleseller/SellerInfo.php");
			$id_seller = SellerInfo::getSellerIdByCustomerId($this->id);
			$emp = new Employee($id_seller);
			if(Validate::isLoadedObject($emp))
			{
				$emp->delete();
			}
		}
		
		return $ret;
	}
	
    /*
    * module: pagecache
    * date: 2018-05-31 11:39:45
    * version: 4.22
    */
    public static function getDefaultGroupId($id_customer)
    {
        $context = Context::getContext();
        if (!$id_customer
            && isset($context->cookie)
            && isset($context->cookie->pc_group_default)) {
            $id_group = (int) $context->cookie->pc_group_default;
            if ($id_group > 0) {
                return $context->cookie->pc_group_default;
            }
        }
        return parent::getDefaultGroupId($id_customer);
    }
    /*
    * module: pagecache
    * date: 2018-05-31 11:39:45
    * version: 4.22
    */
    public static function getGroupsStatic($id_customer)
    {
        $context = Context::getContext();
        if (!$id_customer
            && isset($context->cookie)
            && isset($context->cookie->pc_groups)) {
            $groups = explode(',', $context->cookie->pc_groups);
            if ($groups !== false && count($groups) > 0) {
                return $groups;
            }
        }
        return parent::getGroupsStatic($id_customer);
    }
    /*
    * module: pagecache
    * date: 2018-05-31 11:39:45
    * version: 4.22
    */
    public function isLogged($with_guest = false)
    {
        $context = Context::getContext();
        $caller = $this->getCallerMethod();
        if (strcmp($caller,'getHookModuleExecList') === 0
            || strcmp($caller,'privateProcess') === 0
            || ((bool)Module::isEnabled('deluxeprivateshop') && strcmp($caller,'init') === 0)
            || ((bool)Module::isEnabled('extendedregistration') && strcmp($caller,'hookDisplayHeader') === 0)
            ) {
            if ((!isset($context->customer) || !$context->customer->id)
                && isset($context->cookie)
                && isset($context->cookie->pc_is_logged)) {
                if ($with_guest) {
                    return $context->cookie->pc_is_logged;
                } else {
                    return $context->cookie->pc_is_logged_guest;
                }
            }
        }
        return parent::isLogged($with_guest);
    }
    /*
    * module: pagecache
    * date: 2018-05-31 11:39:45
    * version: 4.22
    */
    private function getCallerMethod()
    {
        $traces = debug_backtrace();
        if (isset($traces[2])) {
            return $traces[2]['function'];
        }
        return null;
    }
}
