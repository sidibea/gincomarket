<?php
class PaymentModule extends PaymentModuleCore
{	
	/*
    * module: agilemultipleseller
    * date: 2017-04-25 12:22:05
    * version: 3.0.6.2
    */
    public function validateOrder($id_cart, $id_order_state, $amountPaid, $paymentMethod = 'Unknown',   $message = NULL, $extraVars = array(),   $currency_special = NULL, $dont_touch_amount = false,     $secure_key = false, Shop $shop = null)
	{
		@session_start();
		@set_time_limit(120);
		$_SESSION['id_cart_validating'] = (int)$id_cart;
		
		if(Module::isInstalled('agileprepaidcredit'))
		{
			require_once(_PS_ROOT_DIR_ . "/modules/agileprepaidcredit/agileprepaidcredit.php");	
			AgilePrepaidCredit::set_token_payment_processing_marker($id_cart, true);
		}
		
	    if(!Module::isInstalled('agilemultipleseller'))
	    {
			$ret = parent::validateOrder($id_cart, $id_order_state, $amountPaid, $paymentMethod, $message, $extraVars, $currency_special, $dont_touch_amount, $secure_key);
			if(Module::isInstalled('agileprepaidcredit'))
			{	
				AgilePrepaidCredit::adjustOrderForTokens($this->currentOrder);
				if($this->name == 'agilepaypalparallel' || $this->name = 'agilepaypaladaptive')
					AgilePrepaidCredit::checkOrderInvoicePayment($this->currentOrder);
			}
			return $ret;
		}
        require_once(_PS_ROOT_DIR_ . "/modules/agilemultipleseller/agilemultipleseller.php");
		$paymode = (int)Configuration::get('AGILE_MS_PAYMENT_MODE');		
        $sellers = AgileMultipleSeller::getSellersByCart($id_cart);
        if(count($sellers)<=1)
		{
			$id_cart_patent = AgileMultipleSeller::get_subcart_parentid($id_cart);
			$ordervalided =  parent::validateOrder($id_cart, $id_order_state, $amountPaid, $paymentMethod, $message, $extraVars, $currency_special, $dont_touch_amount, $secure_key);
			$this->updateSellerCommissionRecordType($paymode, $message);
			if($ordervalided AND $id_cart_patent > 0)
			{
								AgileMultipleSeller::remove_subcart_items_from_maincart($id_cart, $this->currentOrder);
			}
			if(Module::isInstalled('agileprepaidcredit'))
			{	
				AgilePrepaidCredit::adjustOrderForTokens($this->currentOrder);
				if($this->name == 'agilepaypalparallel' || $this->name = 'agilepaypaladaptive')
					AgilePrepaidCredit::checkOrderInvoicePayment($this->currentOrder);
			}
			return $ordervalided;
		}
				        $cartinfos = AgileMultipleSeller::split_shopping_cart($id_cart, $sellers);
        if(empty($cartinfos))
        {
			$ret = parent::validateOrder($id_cart, $id_order_state, $amountPaid, $paymentMethod, $message, $extraVars, $currency_special, $dont_touch_amount, $secure_key);
			$this->updateSellerCommissionRecordType($paymode, $message);
			if(Module::isInstalled('agileprepaidcredit'))
			{	
				AgilePrepaidCredit::adjustOrderForTokens($this->currentOrder);
				if($this->name == 'agilepaypalparallel' || $this->name = 'agilepaypaladaptive')
					AgilePrepaidCredit::checkOrderInvoicePayment($this->currentOrder);
			}
			return $ret;
		}
        $ret = true;
        foreach($cartinfos AS $cartinfo)
        {
						$_SESSION['id_cart_validating'] = (int)$cartinfo['id_cart'];
			
			$this->context->cart = new Cart(intval($cartinfo['id_cart']));
			$this->context->cart->getPackageList(true);
						$filter = CartRule::FILTER_ACTION_ALL;	
			$cache_key = 'Cart::getCartRules'.$cartinfo['id_cart'].'-'.$filter;
			if (Cache::isStored($cache_key))Cache::clean($cache_key);
			
			if(Module::isInstalled('agileprepaidcredit'))
			{
				AgilePrepaidCredit::set_token_payment_processing_marker($cartinfo['id_cart'], true);
			}
			
            $ret = $ret AND  parent::validateOrder($cartinfo['id_cart'], $id_order_state, $cartinfo['amountPaid'], $paymentMethod, $message, $extraVars, $currency_special, $dont_touch_amount, $secure_key);
			$this->updateSellerCommissionRecordType($paymode, $message);
			if($this->name == 'agilepaypalparallel')$this->updateTxnDetailCartID($message, $this->currentOrder, $cartinfo['id_cart']);
			if(Module::isInstalled('agileprepaidcredit'))
			{	
				AgilePrepaidCredit::adjustOrderForTokens($this->currentOrder);
				if($this->name == 'agilepaypalparallel' || $this->name = 'agilepaypaladaptive')
				{
					AgilePrepaidCredit::adjustOrderPaymentAmount($this->currentOrder, $this->name);
					AgilePrepaidCredit::checkOrderInvoicePayment($this->currentOrder);
				}
			}
		}
        return $ret;
    }	
	/*
    * module: agilemultipleseller
    * date: 2017-04-25 12:22:05
    * version: 3.0.6.2
    */
    public static function getInstalledPaymentModules()
	{
		if(Module::isInstalled('agilemultipleseller'))
		{
						$sql = "DELETE FROM " . _DB_PREFIX_ ."hook_module  WHERE id_shop > 1";
			Db::getInstance()->Execute($sql);
		}
		return parent::getInstalledPaymentModules();
	}
	
	/*
    * module: agilemultipleseller
    * date: 2017-04-25 12:22:05
    * version: 3.0.6.2
    */
    protected function updateSellerCommissionRecordType($record_type, $txn_id)
	{
		if(Module::isInstalled('agilesellercommission'))
		{
			require_once(_PS_ROOT_DIR_ . "/modules/agilesellercommission/SellerCommission.php");
			if($this->currentOrder>0)
			{
				SellerCommission::updateRecordType($this->currentOrder, $record_type, $txn_id);
			}
		}		
	}	
}
