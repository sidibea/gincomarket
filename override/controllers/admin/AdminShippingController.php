<?php
class AdminShippingController extends AdminShippingControllerCore
{
	/*
    * module: agilemultipleseller
    * date: 2017-04-25 12:22:06
    * version: 3.0.6.2
    */
    public function renderOptions()
	{
		if($this->is_seller)return;
		
		return parent::renderOptions();
	}
}
