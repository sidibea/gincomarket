<?php
class AdminReturnController extends AdminReturnControllerCore
{
	/*
    * module: agilemultipleseller
    * date: 2017-04-25 12:22:06
    * version: 3.0.6.2
    */
    public function __construct()
	{
		parent::__construct();
		if($this->is_seller)
			$this->fields_options = array();
	}
}
