<?php
/**
 * @package Unite Gallery for Prestashop
 * @author UniteCMS.net / Valiano
 * @copyright (C) 2012 Unite CMS, All Rights Reserved. 
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * */
defined('_JEXEC') or die('Restricted access');

define("UNITEGALLERY_TEXTDOMAIN","unitegallery");

class UniteProviderFunctionsUG{

	
	/**
	 * init base variables of the globals
	 */
	public static function initGlobalsBase(){

		$tablePrefix = _DB_PREFIX_;
		
		GlobalsUG::$table_galleries = $tablePrefix.GlobalsUG::TABLE_GALLERIES_NAME;
		GlobalsUG::$table_categories = $tablePrefix.GlobalsUG::TABLE_CATEGORIES_NAME;
		GlobalsUG::$table_items = $tablePrefix.GlobalsUG::TABLE_ITEMS_NAME;
		
		$pluginName = "unitegallery";
				
		GlobalsUG::$pathPlugin = realpath(_PS_MODULE_DIR_.$pluginName)."/";
		
		GlobalsUG::$path_media_ug = GlobalsUG::$pathPlugin."unitegallery-plugin/";

		GlobalsUG::$path_base = _PS_ROOT_DIR_."/";
		
		GlobalsUG::$path_images = GlobalsUG::$path_base."img/";
		GlobalsUG::$path_cache = GlobalsUG::$pathPlugin."cache/";
		
		//$urlBase = _PS_BASE_URL_.__PS_BASE_URI__;
		
		$urlBase = tools::getCurrentUrlProtocolPrefix().Tools::getShopDomain(false).__PS_BASE_URI__;
		
		GlobalsUG::$urlPlugin = $urlBase."modules/{$pluginName}/";
				
		GlobalsUG::$url_component_client = "";
		
		$context = Context::getContext();
		$adminLink = @$context->link->getAdminLink('AdminModules');
		$adminLink .= "&configure={$pluginName}&tab_module=slideshows&module_name=unitegallery";
		
		GlobalsUG::$url_component_admin = $adminLink;
				
		GlobalsUG::$url_base = $urlBase;
		
		GlobalsUG::$url_media_ug = GlobalsUG::$urlPlugin."unitegallery-plugin/";

		GlobalsUG::$url_images = GlobalsUG::$url_base."img/";
		
		GlobalsUG::$url_ajax = $adminLink;
		
	}
	
	
	/**
	 * add scripts and styles framework
	 */
	public static function addScriptsFramework(){
		
		HelperUG::addScriptCommon("jquery-ui.min","jquery-ui");
		HelperUG::addStyle("jquery-ui.structure.min","jui-smoothness-structure","css/jui/new");
		HelperUG::addStyle("jquery-ui.theme.min","jui-smoothness-theme","css/jui/new");
		
	}
	
	
	/**
	 * 
	 * register script
	 */
	public static function addScript($handle, $url){
		
		if(empty($url))
			UniteFunctionsUG::throwError("empty script url, handle: $handle");
		
		if(!isset(UniteProviderAdminUG::$arrScripts[$handle]))
			UniteProviderAdminUG::$arrScripts[$handle] = $url;
				
	}
	
	
	/**
	 *
	 * register script
	 */
	public static function addStyle($handle, $url){
	
		if(empty($url))
			UniteFunctionsUG::throwError("empty style url, handle: $handle");
		
		if(!isset(UniteProviderAdminUG::$arrStyles[$handle]))		
			UniteProviderAdminUG::$arrStyles[$handle] = $url;
		
	}

	
	/**
	 *
	 * sanitize data, in joomla no need to sanitize
	 */
	public static function normalizeAjaxInputData($arrData){
		
		return $arrData;
	}
	
	
	/**
	 * put footer text line
	 */
	public static function putFooterTextLine(){
		?>
			&copy; <?php _e("All rights reserved",UNITEGALLERY_TEXTDOMAIN)?>, <a href="http://codecanyon.net/user/valiano" target="_blank">Valiano</a>. &nbsp;&nbsp;
		<?php
	}
	
	
	/**
	 * add jquery include
	 */
	public static function addjQueryInclude($app, $urljQuery = null){
		
		if(class_exists("UniteProviderAdminUG") && UniteProviderAdminUG::isInsidePlugin())
			return(false);
		
		self::addScript("jquery", $urljQuery."?app=$app");
		
	}
	
	
	/**
	 * modify default values of troubleshooter settings
	 */
	public static function modifyTroubleshooterSettings($settings){
		
		$settings->updateSettingValue("include_jquery", "false");
		
		return($settings);
	}
	
	
	/**
	 * add position settings (like shortcode) based on the platform
	 */
	public static function addPositionToMainSettings($settingsMain){
		
		//$settingsMain = new UniteSettingsAdvancedUG();
				
		$settingsMain->addHr();
		
		$description = __("Put the gallery to some position on the page",UNITEGALLERY_TEXTDOMAIN);
		$settingsMain->addRadioBoolean("add_to_position", "Put To Page Position",false, "Yes", "No",array("description"=>$description));
		
		//add hooks		
		$arrHooks = UniteProviderAdminUG::getArrHooks();
		$arrHooks = UniteFunctionsUG::arrayToAssoc($arrHooks);
		
		$settingsMain->startBulkControl("add_to_position", "show", "true");
		
		$description = __("Choose a front end position",UNITEGALLERY_TEXTDOMAIN);
		$settingsMain->addSelect("front_hook", $arrHooks, "Gallery Position","",array("description"=>$description));
		
		$arrPages = array();
		$arrPages["none"] = "[No Page Filters]";
		$arrPages["product"] = "On Product Pages Only";
		$arrPages["category"] = "On Category Pages Only";
		$arrPages["product_category"] = "On Category and Product Pages";
		$arrPages["cms"] = "On CMS Pages Only";
		$arrPages["hr"] = "----Other Pages Types------";
		$arrPages["address"] = "Address Pages";
		$arrPages["addresses"] = "Addresses Pages";
		$arrPages["best-sales"] = "BestSales Pages";
		$arrPages["cart"] = "Cart Pages";
		$arrPages["compare"] = "Compare Pages";
		$arrPages["contact"] = "Contact Pages";
		$arrPages["discount"] = "Discount Pages";
		$arrPages["guest-tracking"] = "GuestTracking Pages";
		$arrPages["history"] = "History Pages";
		$arrPages["identity"] = "Identity Pages";
		$arrPages["index"] = "Index Pages";
		$arrPages["manufacturer"] = "Manufacturer Pages";
		$arrPages["myaccount"] = "MyAccount Pages";
		$arrPages["new-products"] = "NewProducts Pages";
		$arrPages["pagenotfound"] = "PageNotFound Pages";
		$arrPages["prices-drop"] = "PricesDrop Pages";
		$arrPages["search"] = "Search Pages";
		$arrPages["sitemap"] = "Sitemap Pages";
		$arrPages["stores"] = "Stores Pages";
		$arrPages["supplier"] = "Supplier Pages";
		$arrPages["order"] = "Order Pages";
		$arrPages["authentication"] = "Authentication Pages";
		
		$description = __("Choose a pages filter to put on",UNITEGALLERY_TEXTDOMAIN);
		$settingsMain->addSelect("front_pages", $arrPages, "Put On Pages","none",array("description"=>$description));
		
		$description = __("Choose page id's coma saparated. Leave empty for all pages of a type. example: 23,12,32",UNITEGALLERY_TEXTDOMAIN);
		$settingsMain->addTextBox("front_pageid","","Page ID's",array("description"=>$description));
		
		$settingsMain->endBulkControl();
		
		$settingsMain->addControl("front_pages", "front_pageid", "enable", "product,category,product_category,cms");
		
		$settingsMain->addHr();
		
		$textGenerate = __("Generate Shortcode",UNITEGALLERY_TEXTDOMAIN);
		$descShortcode = __("Copy this shortcode into cms page content",UNITEGALLERY_TEXTDOMAIN);
		$settingsMain->addTextBox("shortcode", "",__("Gallery Shortcode",UNITEGALLERY_TEXTDOMAIN),array("description"=>$descShortcode, "readonly"=>true, "class"=>"input-alias input-readonly", "addtext"=>"&nbsp;&nbsp; <a id='button_generate_shortcode' class='unite-button-secondary' >{$textGenerate}</a>"));
		
		return($settingsMain);
	}
	
	
	/**
	 * print some script at some place in the page
	 */
	public static function printCustomScript($script, $hardCoded = false){
	
		echo "<script type='text/javascript'>{$script}</script>";
	
	}
	
	
}
?>