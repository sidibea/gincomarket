<?php
class AdminReturnController extends AdminReturnControllerCore
{
	/*
    * module: agilemultipleseller
    * date: 2017-05-22 04:42:09
    * version: 3.0.6.2
    */
    public function __construct()
	{
		parent::__construct();
		if($this->is_seller)
			$this->fields_options = array();
	}
}
