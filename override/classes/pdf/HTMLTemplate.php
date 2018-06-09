<?php
abstract class HTMLTemplate extends HTMLTemplateCore
{
	/*
    * module: agilemultipleseller
    * date: 2017-05-22 04:42:08
    * version: 3.0.6.2
    */
    public function getHeader()
	{
		$parent_header = parent::getHeader();
		if(!isset($this->order) OR !Validate::isLoadedObject($this->order))return $parent_header;
		if(!Module::isInstalled('agilemultipleseller'))return $parent_header;
		
        require_once(_PS_ROOT_DIR_ . "/modules/agilemultipleseller/SellerInfo.php");
		$id_seller = AgileSellerManager::getObjectOwnerID('order', $this->order->id);
		$sellerinfo = new SellerInfo(SellerInfo::getIdBSellerId($id_seller), $this->order->id_lang);
		
		$seller_logo_path = SellerInfo::seller_logo_physical_path($sellerinfo->id);
		if(!file_exists($seller_logo_path))$seller_logo_path = false;
				$this->smarty->assign(array(
			'seller_name' => $sellerinfo->company,
			'seller_logo_path' => $seller_logo_path,
			'seller_logo_url' => SellerInfo::get_seller_logo_url_static($sellerinfo->id),
			'sellerinfo' => $sellerinfo
			));
		
		return $this->smarty->fetch($this->getTemplate('header'));
	}
	/*
    * module: agilemultipleseller
    * date: 2017-05-22 04:42:08
    * version: 3.0.6.2
    */
    public function getFooter()
	{
		$parent_footer = parent::getFooter();
		if(!isset($this->order) OR !Validate::isLoadedObject($this->order))return $parent_footer;
		if(!Module::isInstalled('agilemultipleseller'))return $parent_footer;
		
        require_once(_PS_ROOT_DIR_ . "/modules/agilemultipleseller/SellerInfo.php");
		$id_seller = AgileSellerManager::getObjectOwnerID('order', $this->order->id);
		$sellerinfo = new SellerInfo(SellerInfo::getIdBSellerId($id_seller), $this->order->id_lang);
		$id_lang = intval(Configuration::get('PS_COUNTRY_DEFAULT'));
	
		$this->smarty->assign(array(
			'seller_name' => $sellerinfo->company,
			'seller_address' => $sellerinfo->fulladdress($id_lang),
			'seller_fax' => $sellerinfo->fax,
			'seller_phone' => $sellerinfo->phone,
			'sellerinfo' => $sellerinfo
			));
		return $this->smarty->fetch($this->getTemplate('footer'));
	}	
}
