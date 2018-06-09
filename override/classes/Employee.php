<?php
class Employee extends EmployeeCore
{
	/*
    * module: agilemultipleseller
    * date: 2017-04-25 12:22:04
    * version: 3.0.6.2
    */
    public function toggleStatus()
	{
	    $ret = parent::toggleStatus();
				if(_PS_VERSION_>'1.5')return $ret;
		if(! Module::isInstalled('agilemultipleseller'))return $ret;
	    if(!$this->active)
	    {
	        AgileSellerManager::disableSellerProducts($this->id);
		}
		else
		{
			if (intval(Configuration::get('AGILE_MS_SELLER_APPROVAL')) == 1)
			{
				require_once(_PS_ROOT_DIR_ . "/modules/agilemultipleseller/agilemultipleseller.php");
				AgileMultipleSeller::sendSellerAccountApprovalEmail($this->id);
			}
		}			
	    return $ret;
	}
	
	/*
    * module: agilemultipleseller
    * date: 2017-04-25 12:22:04
    * version: 3.0.6.2
    */
    public function update($null_values = false)
	{
				$empInDb = new Employee($this->id);
				$result = parent::update($null_values);
				if(!$result)return $result;
				if(!Module::isInstalled('agilemultipleseller'))return $result;
				if($empInDb->active == $this->active)return $result;
		if(!$this->active)
		{
	        AgileSellerManager::disableSellerProducts($this->id);
		}
		else 
		{
	        if (intval(Configuration::get('AGILE_MS_SELLER_APPROVAL')) == 1)
	        {
				require_once(_PS_ROOT_DIR_ . "/modules/agilemultipleseller/agilemultipleseller.php");
				AgileMultipleSeller::sendSellerAccountApprovalEmail($this->id);
			}
		}
		return $result;
	}
    /*
    * module: agilemultipleseller
    * date: 2017-04-25 12:22:04
    * version: 3.0.6.2
    */
    public function delete()
	{
	    $ret = parent::delete();
	    if(Module::isInstalled('agilemultipleseller'))
	    {
    	    AgileSellerManager::disableSellerProducts($this->id);
			AgileSellerManager::deleteSellerInfo($this->id);
	    }
	    return $ret;
	}
}
