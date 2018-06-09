<?php
$GLOBALS["OkBNHdwlWvqJiaHWwyhg"]=base64_decode("aW52YWxpZF91cmw=");$GLOBALS["JiFlhXHURbvpibIxnFcT"]=base64_decode("VXJsc2Nhbg==");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"])) {
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}

class mobicommerce3_urlscan_scan_action extends BaseAction {
    
    public function execute()
    {
        $info = ServiceFactory::factory($GLOBALS["JiFlhXHURbvpibIxnFcT"])->getScanInfo();
        if ($info)
        {
            $this->setSuccess($info);
        }
        else
        {
            $this->setError(MobicommerceResult::ERROR_ITEM_INPUT_PARAMETER,$GLOBALS["OkBNHdwlWvqJiaHWwyhg"]);
        }
    }

}
 ?>