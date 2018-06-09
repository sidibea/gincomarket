<?php
$GLOBALS["lfZwhCoVRiYhvVPBQbEe"]=base64_decode("bWVzc2FnZQ==");$GLOBALS["jvNUZuArDlDbVsDKKNjT"]=base64_decode("c3RhdHVz");$GLOBALS["EpXguBwBQakdIXktnVDM"]=base64_decode("UHVzaA==");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"]))
{
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}

class mobicommerce3_pushservice_updatebuild_action extends BaseAction
{
    public function execute()
    {
        $info = ServiceFactory::factory($GLOBALS["EpXguBwBQakdIXktnVDM"])->updateBuild($_REQUEST);
        if ($info[$GLOBALS["jvNUZuArDlDbVsDKKNjT"]])
        {
            $this->setSuccess($info);
        }
        else
        {
            $this->setError(MobicommerceResult::ERROR_ITEM_INPUT_PARAMETER, $info[$GLOBALS["lfZwhCoVRiYhvVPBQbEe"]]);
        }
    }
}
 ?>