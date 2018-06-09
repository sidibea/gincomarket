<?php
$GLOBALS["EKgfhpvQnjvyxdnwNsFs"]=base64_decode("TW9iaWNvbW1lcmNl");$GLOBALS["CkTbYfxEYUrJmvlnQFUA"]=base64_decode("cGFnZV9pZA==");$GLOBALS["SiRSACHoXsTIZeRmGmwq"]=base64_decode("aWQ=");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"]))
{
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}

class mobicommerce3_cms_get_action extends BaseAction
{
    public function execute()
    {
        $id = Tools::getValue($GLOBALS["SiRSACHoXsTIZeRmGmwq"]);
        if(!$id)
        {
            $id = Tools::getValue($GLOBALS["CkTbYfxEYUrJmvlnQFUA"]);
        }
        
        $info = ServiceFactory::factory($GLOBALS["EKgfhpvQnjvyxdnwNsFs"])->getCMSDetail($id);
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