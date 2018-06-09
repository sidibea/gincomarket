<?php
class ProductDownload extends ProductDownloadCore
{
	/*
    * module: agilemultipleseller
    * date: 2017-05-22 04:42:07
    * version: 3.0.6.2
    */
    public function getHtmlLinkFrontSeller()
	{
		$link = $this->getTextLink(false,false) . "&is_seller=1";
		$html = '<a href="'.$link.'" title=""';
		$html .= '>'.$this->display_filename.'</a>';
		return $html;
	}
}
