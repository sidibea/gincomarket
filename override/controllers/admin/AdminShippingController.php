<?php
class AdminShippingController extends AdminShippingControllerCore
{
	/*
    * module: agilemultipleseller
    * date: 2017-05-22 04:42:09
    * version: 3.0.6.2
    */
    public function renderOptions()
	{
		if($this->is_seller)return;
		
		return parent::renderOptions();
	}
}
