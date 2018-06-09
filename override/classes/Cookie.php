<?php
class Cookie extends CookieCore
{
	/*
    * module: agilemultipleseller
    * date: 2017-05-22 04:42:06
    * version: 3.0.6.2
    */
    protected function _setcookie($cookie = null)
	{
		if(Module::isInstalled('agilemultipleshop'))
		{
			$_SESSION[$this->_name] = $this->_cipherTool->encrypt($cookie);
		}
		return parent::_setcookie($cookie);
	}
	
	/*
    * module: agilemultipleseller
    * date: 2017-05-22 04:42:06
    * version: 3.0.6.2
    */
    public function update($nullValues = false)
	{
		if(Module::isInstalled('agilemultipleshop'))
		{
			if(isset($_SESSION[$this->_name]))
			{
				$_COOKIE[$this->_name] = $_SESSION[$this->_name];
			}
		}		
		parent::update($nullValues);
	}	
	
}
