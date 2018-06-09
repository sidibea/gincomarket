<?php
$GLOBALS["sxFGfVahUokWVmwHRxNc"]=base64_decode("VGhpcyBzeXN0ZW0gZG9lcyBub3Qgc3VwcG9ydCBjb21tZW50cy4=");$GLOBALS["AdSKntICBqGkMHNEzGDl"]=base64_decode("aXRlbV9pZA==");$GLOBALS["tugkmwKQmrdyfghQnRJj"]=base64_decode("");$GLOBALS["xjYOkrnNiShqzGuGOkKM"]=base64_decode("Y29udGVudA==");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"]))
{
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}

class mobicommerce3_review_add_action extends BaseAction
{
    public function validate()
    {
        if (parent::validate())
        {
            $content = $this->getParam($GLOBALS["xjYOkrnNiShqzGuGOkKM"]);
            if (!isset($content) || $content == $GLOBALS["tugkmwKQmrdyfghQnRJj"])
            {
                $this->setError(MobicommerceResult::ERROR_USER_INPUT_PARAMETER);
                return false;
            }
            $item_id = $this->getParam($GLOBALS["AdSKntICBqGkMHNEzGDl"]);
            if (!isset($item_id) || $item_id == $GLOBALS["tugkmwKQmrdyfghQnRJj"])
            {
                $this->setError(MobicommerceResult::ERROR_USER_INPUT_PARAMETER);
                return false;
            }
        }
        return true;
    }

    public function execute()
    {
        $this->setError (array(array($GLOBALS["sxFGfVahUokWVmwHRxNc"])));   
    }
}
 ?>