<?php
$GLOBALS["pTUOYHbwbHCGWVJNMlii"]=base64_decode("UHVzaG5vdGlmaWNhdGlvbg==");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"]))
{
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}

class mobicommerce3_push_save_action extends BaseAction
{
    public function execute()
    {
        $info = ServiceFactory::factory($GLOBALS["pTUOYHbwbHCGWVJNMlii"])->saveDeviceToken($_REQUEST);
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