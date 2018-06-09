<?php
///-build_id: 2015031920.2559
/// This source file is subject to the Software License Agreement that is bundled with this 
/// package in the file license.txt, or you can get it here
/// http://addons-modules.com/en/content/3-terms-and-conditions-of-use
///
/// @copyright  2009-2012 Addons-Modules.com
///  If you need open code to customize or merge code with othe modules, please contact us.

class Employee extends EmployeeCore
{
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
