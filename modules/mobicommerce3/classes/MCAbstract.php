<?php
$GLOBALS["DWmsYJsvcfBZEyObOnZU"]=base64_decode("aHR0cHM6Ly8=");$GLOBALS["JMxuLHVopMBOTWBgwTul"]=base64_decode("aHR0cDovLw==");$GLOBALS["POWdsDYcgiVnFFDSbMHA"]=base64_decode("UFNfU1NMX0VOQUJMRURfRVZFUllXSEVSRQ==");$GLOBALS["tYnFWBeUsqckcNNWjtX"]=base64_decode("UFNfU1NMX0VOQUJMRUQ=");$GLOBALS["sAQEXilAsHTxRRtWAHnp"]=base64_decode("X1BTX1ZFUlNJT05f");
?><?php


if (!defined($GLOBALS["sAQEXilAsHTxRRtWAHnp"]))
	exit;

class MCAbstractObject extends ObjectModel {
	
	public function getBaseUrl()
	{
		$base_url = _PS_BASE_URL_.__PS_BASE_URI__;
		if(Configuration::get($GLOBALS["tYnFWBeUsqckcNNWjtX"]) && Configuration::get($GLOBALS["POWdsDYcgiVnFFDSbMHA"]))
		{
			$base_url = str_replace($GLOBALS["JMxuLHVopMBOTWBgwTul"], $GLOBALS["DWmsYJsvcfBZEyObOnZU"], $base_url);
		}

		return $base_url;
	}
}
 ?>