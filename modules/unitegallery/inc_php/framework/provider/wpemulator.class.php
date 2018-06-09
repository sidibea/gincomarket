<?php
/**
 * @package Unite Gallery for Prestashop
 * @author UniteCMS.net / Valiano
 * @copyright (C) 2012 Unite CMS, All Rights Reserved. 
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * */
defined('_JEXEC') or die('Restricted access');

	
	if(class_exists("UniteTranslateUG")){
		global $wpTranslate;
		$wpTranslate = new UniteTranslateUG("unitegallery");
	}
	
	
	/**
	 * 
	 * _e() emulator
	 */
	if(function_exists("_e") == false){
	
		function _e($string, $textdomain = null){
			
			if(GlobalsUG::ENABLE_TRANSLATIONS == false){
				echo $string;
				return(false);
			}
			
			global $wpTranslate;
			$str = $wpTranslate->translate($string);
			echo $str;
		}
	}
	
	
	/**
	 * 
	 * __() emulator
	 */	
	if(function_exists("__") == false){
	 
		function __($string, $textdomain = null){
			
			if(GlobalsUG::ENABLE_TRANSLATIONS == false)
				return($string);
			
			global $wpTranslate;
			$str = $wpTranslate->translate($string);
			return($str);
		}
	}
	

	
?>