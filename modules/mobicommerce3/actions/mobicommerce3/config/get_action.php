<?php
$GLOBALS["EKgfhpvQnjvyxdnwNsFs"]=base64_decode("TW9iaWNvbW1lcmNl");$GLOBALS["jvXBGGoDvflqvWkbujKP"]=base64_decode("YXBwX2tleQ==");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"]))
{
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}

class mobicommerce3_config_get_action extends BaseAction
{
    public function execute()
    {
        $app_key = $this->getParam($GLOBALS["jvXBGGoDvflqvWkbujKP"]);
        $info = ServiceFactory::factory($GLOBALS["EKgfhpvQnjvyxdnwNsFs"])->getConfig($app_key);
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