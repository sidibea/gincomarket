<?php
class CategoryController extends CategoryControllerCore
{
	/*
    * module: agilemultipleseller
    * date: 2017-04-25 12:22:07
    * version: 3.0.6.2
    */
    public function init()
	{
		global $smarty;
		
		parent::init();
		if(Module::isInstalled('agilesellerratings'))
		{
			include_once(_PS_ROOT_DIR_ . "/modules/agilesellerratings/agilesellerratings.php");
			$smarty->assign(array(
				'cate_seller_ratting' => AgileSellerRatings::getAverageRating4Category($this->category->id)
			));			
		}
	}
}