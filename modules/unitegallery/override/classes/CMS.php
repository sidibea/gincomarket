<?php

class CMS extends CMSCore
{

	
	/**
	 * modify shortcode
	 * @param $content
	 */
	function uniteGalleryModify($text){
			
		if(is_array($text))
			return($text);
		
		if (strpos($text, 'unitegallery') === false)
			return $text;
		
		$regex = '/\[unitegallery\s+(.*?)\]/i';
		preg_match_all($regex, $text, $arrMatches, PREG_SET_ORDER);
				
		if(empty($arrMatches))
			return($text);
		
        if(!defined("_JEXEC"))
        	define("_JEXEC", true);
        
 		$filepathUG = _PS_MODULE_DIR_ ."unitegallery/includes.php";
        
    	require_once($filepathUG);
    	require_once _PS_MODULE_DIR_."unitegallery/inc_php/framework/provider/provider_main_file.php";
    	
		foreach($arrMatches as $match){
			if(!isset($match[1]))
				continue;
		
			$arguments = $match[1];
		
			$keywords = preg_split("/\s+/", $arguments);
			$galleryID = $keywords[0];
		
			$catID = null;
			if(count($keywords) > 1){
				$strcat = $keywords[1];
				$strcat = str_replace("catid=", "", $strcat);
				$strcat = str_replace("catid =", "", $strcat);
				$strcat = str_replace("catid = ", "", $strcat);
				$catID = trim($strcat);
			}
		
			$content = HelperUG::outputGallery($galleryID, $catID, "alias");
		
			$match = $match[0];
		
			//replace only first occurance
		
			$pos = strpos($text, $match);
			if($pos === false)
				continue;
			$text = substr_replace($text, $content, $pos, strlen($match));
		
		}
		
		
		return($text);
	}
	
	
	/**
	 * override constructor
	 */
    public function __construct($id = null, $id_lang = null, $id_shop = null)
    {
    	parent::__construct($id, $id_lang, $id_shop);
    	
        if(file_exists(_PS_MODULE_DIR_ ."unitegallery/includes.php") && Module::isInstalled("unitegallery") && Module::isEnabled("unitegallery"))
        	$this->content = $this->uniteGalleryModify($this->content);
        
    }
    
    
}
