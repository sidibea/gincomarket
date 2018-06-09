<?php


try{

require_once $currentFolder . "/unitegallery_admin.php";
require_once $currentFolder . "/inc_php/framework/provider/provider_admin.class.php";
$UGproductAdmin = new UniteProviderAdminUG();

}catch (Exception $e){
	dmp($e->getMessage());
	dmp($e->getTraceAsString());
}

class UniteGallery extends Module
{
	
	private $arrFrontGalleries = array();
	
	private $wasInitError = false;
	private $initMessage = "";
	private $initTrace = "";
	private $isInited = false;
	
	public function __construct()
	{
		global $uniteGalleryVersion;
		
		
		try{
			$this->name = 'unitegallery';
			$this->tab = 'slideshows';
			$this->version = $uniteGalleryVersion;
			$this->author = 'Valiano';	
			$this->need_instance = 0;
			$this->bootstrap = true;
			
			parent::__construct();
			
			$this->displayName = $this->l('Unite Gallery');
			$this->description = $this->l('Premuim responsive gallery module');
						
			if($this->isAdmin() == false)
				$this->initFrontEnd();

			$this->isInited = true;
			
		}catch(Exception $e){
			$this->wasInitError = true;
			$this->initMessage = $e->getMessage();
			$this->initTrace = $e->getTraceAsString();
			
			dmp($this->initMessage);
			exit();
			
		}
	}
	
	
	/**
	 * install function
	 */
	public function install()
	{
		
		if (Shop::isFeatureActive())
			Shop::setContext(Shop::CONTEXT_ALL);		
		
		$this->createDBTables();
		
		if (!parent::install())
			return false;
		
		$arrHooks = UniteProviderAdminUG::getArrHooks();
				
		$this->registerHook('displayBackOfficeHeader');
		$this->registerHook('displayBackOfficeFooter');
		
		foreach($arrHooks as $hook){
			if($this->registerHook($hook) == false)
				return(false);
		}
		
		return true;
	}	

	
	/**
	 * check if it's admin or front
	 */
	private function isAdmin(){
		
		$type = $this->context->controller->controller_type;
		if($type == "admin")
			return(true);
		
		return(false);
	}
	
	
	/**
	 * init front end - prepare set of galleries
	 */
	private function initFrontEnd(){
		
		$galleries = new UniteGalleryGalleries();
		$arrGalleries = $galleries->getArrGalleries();
		
		foreach($arrGalleries as $gallery){
						
			$addToPosition = $gallery->getParam("add_to_position");
			
			//check if this gallery needed to add to some position
			if(!empty($addToPosition)){
				$addToPosition = UniteFunctionsUG::strToBool($addToPosition);
				if($addToPosition == false)
					continue;
			}
			
			$hook = $gallery->getParam("front_hook");
			
			//check filters:
			$filterPageType = $gallery->getParam("front_pages");
			$filterPageType = strtolower($filterPageType);
			
			$pageType = $this->context->controller->php_self;
							
			switch($filterPageType){
				case "product":
					if($pageType != "product")
						continue(2);
				break;
				case "category":
										
					if($pageType != "category")
						continue(2);
				break;
				case "product_category":
					if($pageType != "product" && $pageType != "category")
						continue(2);
				break;
				case "cms":
					if($pageType != "cms")						
						continue(2);
				break;
				default:		//filter by other names
					
					if($filterPageType != "none" && $filterPageType != "hr" && $filterPageType != $pageType)
						continue(2);
					
				break;
			}
			
			//filter by id's
			$filterPageID = $gallery->getParam("front_pageid");			
			$filterPageID = trim($filterPageID);
			
			if(!empty($filterPageID) && in_array($pageType, array("product","cms","category")) ){
				$arrIDs = array($filterPageID);
				
				if(strpos($filterPageID, ",") !== false)
					$arrIDs = explode(",",$filterPageID);
				
				foreach($arrIDs as $key=>$id)
					$arrIDs[$key] = trim($id);
				
				$pageID = "";
				switch($pageType){
					case "product":
						$pageID = UniteFunctionsUG::getGetVar("id_product");
					break;
					case "category":
						$pageID = UniteFunctionsUG::getGetVar("id_category");						
					break;
					case "cms":
						$pageID = UniteFunctionsUG::getGetVar("id_cms");						
					break;
				}
				
				if(in_array($pageID, $arrIDs) == false)
					continue;
			}			
			
						
			$this->arrFrontGalleries[$hook] = $gallery;
			HelperUG::putGalleryScripts($gallery);
		}
		
		//$self = $this->context->controller->php_self;
		//dmp($id_product);
		
	}
	
	/**
	 * get script html
	 */
	private function getScriptsHtml(){
		
		$html = "\n";
		
		foreach (UniteProviderAdminUG::$arrScripts as $script){
			$html .= "<script type='text/javascript' src='{$script}'></script>\n";
		
		}
		
		foreach (UniteProviderAdminUG::$arrStyles as $style){
			$html .= "<link href='$style' rel='stylesheet' type='text/css'/>\n";
		
		}
		
		return $html;
	}
	
	/**
	 * hook headr, put scripts, empty scripts arrays
	 */
	public function hookdisplayBackOfficeHeader($params){

		if(UniteProviderAdminUG::isInsidePlugin() == false)
			return(false);
		
		$html = $this->getScriptsHtml();
		
		//empty scripts array
		UniteProviderAdminUG::$arrScripts = array();
		UniteProviderAdminUG::$arrStyles = array();
		
		
		return($html);
	}
	
	
	/**
	 * add scripts to footer
	 */
	public function hookdisplayBackOfficeFooter(){
		
		if(UniteProviderAdminUG::isInsidePlugin() == false)
			return(false);
		
		$html = $this->getScriptsHtml();
		
		return $html;
	}
	
	
	/**
	 * uninstall override
	 */
	public function uninstall()
	{
		if (!parent::uninstall())
			return false;
		return true;
	}
	
	/**
	 * get content
	 */
	public function getContent(){
		
		if($this->isAdmin() == false)
			return("");
		
		$action = UniteFunctionsUG::getPostVariable("action");
		if($action == "unitegallery_ajax_action")
			UniteGalleryAdmin::onAjaxAction();
		
		
		ob_start();
		
		if($this->wasInitError){
			dmp($this->initMessage);
			dmp($this->initTrace);
		}
				
		try{
			
			UniteProviderAdminUG::adminPages();
			
		}catch(Exception $e){
			dmp($this->initMessage);
			dmp($this->initTrace);
		}
		
		$content = ob_get_contents();
		
		ob_clean();		
		ob_end_clean();
		
		return $content;
	}	
	
		
	
	/**
	 * create database tables
	 */
	private function createDBTables(){

			
			$db = Db::getInstance();

			$query = "CREATE TABLE IF NOT EXISTS " .GlobalsUG::$table_categories ." (
					id int(9) NOT NULL AUTO_INCREMENT,
					title varchar(255) NOT NULL,
					alias varchar(255),
					ordering int not NULL,
					params text NOT NULL,
					type tinytext,
					parent_id int(9),
					PRIMARY KEY (id)
					) ENGINE="._MYSQL_ENGINE_." DEFAULT CHARSET=utf8";
			
			$db->Execute($query);
			
			$error = $db->getMsgError();
			if(!empty($error))
				UniteFunctionsUG::throwError($error);
						
			$query = "CREATE TABLE IF NOT EXISTS " .GlobalsUG::$table_items ." (
				id int(9) NOT NULL AUTO_INCREMENT,
				published int(2) NOT NULL,
				title tinytext NOT NULL,
				alias tinytext,
				type varchar(60),
				url_image tinytext,
				url_thumb tinytext,
				ordering int not NULL,
				catid int(9) NOT NULL,
				imageid int(9),
				params text,
				content text,
				contentid varchar(60),
				parent_id int(9),
			PRIMARY KEY (id)
			) ENGINE="._MYSQL_ENGINE_." DEFAULT CHARSET=utf8";
										
			$db->Execute($query);
			$error = $db->getMsgError();
			if(!empty($error))
				UniteFunctionsUG::throwError($error);
			
			$query = "CREATE TABLE IF NOT EXISTS " .GlobalsUG::$table_galleries ." (
				id int(9) NOT NULL AUTO_INCREMENT,
				type varchar(60) NOT NULL,
				title tinytext NOT NULL,
				alias tinytext,
				ordering int not NULL,
				params text,
				PRIMARY KEY (id)
				) ENGINE="._MYSQL_ENGINE_." DEFAULT CHARSET=utf8";
			
			$db->Execute($query);
			
			$error = $db->getMsgError();
			if(!empty($error))
				UniteFunctionsUG::throwError($error);			
	}
	
	
	/**
	 * check and put gallery
	 */
	function checkAndPutGallery($hook){
				
		if(!array_key_exists($hook, $this->arrFrontGalleries))
			return("");
			
		$gallery = $this->arrFrontGalleries[$hook];
		
		$content = HelperUG::outputGallery($gallery);
		
		return($content);
	}
 	
	
	/**
	 * 
	 * shortcode unite gallery
	 */
	public function smarty_modifier_unitegallery($content) {
		
		return("maxim");
		
		return($content);
		
		//return preg_replace_callback('/\[b\](.*?)\[\/b\]/ism',
			//	array($this, 'render_b'), $content);
	}	
	
	
	/**
	 * display header hook
	 */
	public function hookdisplayHeader(){
	
		$htmlScripts = $this->getScriptsHtml();
	
		return($htmlScripts);
	}
	
	
	/**
	 * FRONT END POSITIONS HANDLE
	 */
	
	public function hookdisplayBanner(){				
		return $this->checkAndPutGallery("displayBanner");
	}	
	public function hookDisplayFooter(){
		return $this->checkAndPutGallery("displayFooter");						
	}
	public function hookDisplayTop(){
		return $this->checkAndPutGallery("displayTop");
	}
	public function hookDisplayHome(){
		return $this->checkAndPutGallery("displayHome");
	}
	public function hookDisplayLeftColumn(){
		return $this->checkAndPutGallery("displayLeftColumn");
	}
	public function hookDisplayRightColumn(){
		return $this->checkAndPutGallery("displayRightColumn");
	}
	public function hookDisplayTopColumn(){
		return $this->checkAndPutGallery("displayTopColumn");
	}
	public function hookDisplayLeftColumnProduct(){
		return $this->checkAndPutGallery("displayLeftColumnProduct");
	}
	public function hookDisplayRightColumnProduct(){
		return $this->checkAndPutGallery("displayRightColumnProduct");
	}
	public function hookDisplayProductButtonss(){
		return $this->checkAndPutGallery("displayProductButtons");
	}
	public function hookDisplayFooterProduct(){
		return $this->checkAndPutGallery("displayFooterProduct");
	}
	public function hookDisplayCarrierList(){
		return $this->checkAndPutGallery("displayCarrierList");
	}
	public function hookDisplayBeforeCarrier(){
		return $this->checkAndPutGallery("displayBeforeCarrier");
	}
	public function hookDisplayPaymentTop(){
		return $this->checkAndPutGallery("displayPaymentTop");
	}
	public function hookDisplayPaymentReturn(){
		return $this->checkAndPutGallery("displayPaymentReturn");
	}
	public function hookDisplayOrderConfirmation(){
		return $this->checkAndPutGallery("displayOrderConfirmation");
	}
	public function hookDisplayShoppingCart(){
		return $this->checkAndPutGallery("displayShoppingCart");
	}
	public function hookDisplayShoppingCartFooter(){
		return $this->checkAndPutGallery("displayShoppingCartFooter");
	}
	public function hookDislayMyAccountBlock(){
		return $this->checkAndPutGallery("dislayMyAccountBlock");
	}
	public function hookDisplayCustomerAccountFormTop(){
		return $this->checkAndPutGallery("displayCustomerAccountFormTop");
	}
	public function hookDisplayCustomerAccountForm(){
		return $this->checkAndPutGallery("displayCustomerAccountForm");
	}
	public function hookDisplayMyAccountBlock(){
		return $this->checkAndPutGallery("displayMyAccountBlock");
	}
	public function hookDisplayMyAccountBlockfooter(){
		return $this->checkAndPutGallery("displayMyAccountBlockfooter");
	}
	
}


?>