<?php
///-build_id: 2015031920.2559
/// This source file is subject to the Software License Agreement that is bundled with this 
/// package in the file license.txt, or you can get it here
/// http://addons-modules.com/en/content/3-terms-and-conditions-of-use
///
/// @copyright  2009-2012 Addons-Modules.com
///  If you need open code to customize or merge code with othe modules, please contact us.

abstract class HTMLTemplate extends HTMLTemplateCore
{

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

