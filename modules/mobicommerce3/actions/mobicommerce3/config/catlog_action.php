<?php
$GLOBALS["EKgfhpvQnjvyxdnwNsFs"]=base64_decode("TW9iaWNvbW1lcmNl");$GLOBALS["PiAcIEATXlQdiYGIyCLU"]=base64_decode("Y2F0ZWdvcnlfaWQ=");$GLOBALS["jvXBGGoDvflqvWkbujKP"]=base64_decode("YXBwX2tleQ==");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"]))
{
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}

class mobicommerce3_config_catlog_action extends BaseAction
{
    public function execute()
    {
        $app_key = $this->getParam($GLOBALS["jvXBGGoDvflqvWkbujKP"]);
        $cid = (int)$this->getParam($GLOBALS["PiAcIEATXlQdiYGIyCLU"]);
        $info = ServiceFactory::factory($GLOBALS["EKgfhpvQnjvyxdnwNsFs"])->getCatlogData($app_key, $cid);
        if ($info)
        {
            $this->setSuccess($info);
        }
        else
        {
            $this->setError(MobicommerceResult::ERROR_ITEM_INPUT_PARAMETER);
        }
    }
}
 ?>