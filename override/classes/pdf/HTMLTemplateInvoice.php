<?php
class HTMLTemplateInvoice extends HTMLTemplateInvoiceCore
{
	/*
    * module: agilemultipleseller
    * date: 2017-04-25 12:22:05
    * version: 3.0.6.2
    */
    public function getContent()
	{
		if(isset($this->order) AND Validate::isLoadedObject($this->order) AND Module::isInstalled('agilemultipleseller'))
		{
			$carrier = new Carrier($this->order->id_carrier);
			$this->smarty->assign(array(
				'order_number_text' => sprintf('%06d', $this->order->id),
				'carrier_name' => $carrier->name
				));
		}		
		$content = parent::getContent();
		
		if(isset($this->order) AND Validate::isLoadedObject($this->order) AND Module::isInstalled('agilepickupcenter'))
		{
			$country = new Country((int)$this->order->id_address_invoice);
			$invoice_address = new Address((int)$this->order->id_address_invoice);
			$formatted_invoice_address = AddressFormat::generateAddress($invoice_address, array(), '<br />', ' ');
			$formatted_delivery_address = $formatted_invoice_address;
			if ($this->order->id_address_delivery != $this->order->id_address_invoice)
			{
				$delivery_address = new Address((int)$this->order->id_address_delivery);
				$formatted_delivery_address = AddressFormat::generateAddress($delivery_address, array(), '<br />', ' ');
			}
						require_once(_PS_ROOT_DIR_ . "/modules/agilepickupcenter/agilepickupcenter.php");
			$pickupcenter = new AgilePickupCenter();
			$delivery_address = $formatted_delivery_address . "<BR>" . $pickupcenter->displayInfoByCart($this->order->id_cart);
			
			$this->smarty->assign(array(
				'delivery_address' => $delivery_address
				));
		
						$content = $this->smarty->fetch($this->getTemplateByCountry($country->iso_code));
		}		
		
		return $content;
	}
}
