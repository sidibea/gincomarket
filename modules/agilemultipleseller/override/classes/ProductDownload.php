<?php
///-build_id: 2015031920.2559
/// This source file is subject to the Software License Agreement that is bundled with this 
/// package in the file license.txt, or you can get it here
/// http://addons-modules.com/en/content/3-terms-and-conditions-of-use
///
/// @copyright  2009-2012 Addons-Modules.com
///  If you need open code to customize or merge code with othe modules, please contact us.

class ProductDownload extends ProductDownloadCore
{
	public function getHtmlLinkFrontSeller()
	{
		$link = $this->getTextLink(false,false) . "&is_seller=1";
		$html = '<a href="'.$link.'" title=""';
		$html .= '>'.$this->display_filename.'</a>';
		return $html;
	}

}

