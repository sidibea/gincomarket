<?php
$GLOBALS["wVKYtSekBkByuUakcbkv"]=base64_decode("RGVlcGxpbms=");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"]))
{
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}

class mobicommerce3_deeplink_get_action extends BaseAction
{
    public function execute()
    {
        $info = ServiceFactory::factory($GLOBALS["wVKYtSekBkByuUakcbkv"])->getDeeplinkData();
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