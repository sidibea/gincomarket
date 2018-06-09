<?php
$GLOBALS["sxFGfVahUokWVmwHRxNc"]=base64_decode("VGhpcyBzeXN0ZW0gZG9lcyBub3Qgc3VwcG9ydCBjb21tZW50cy4=");$GLOBALS["tugkmwKQmrdyfghQnRJj"]=base64_decode("");$GLOBALS["AdSKntICBqGkMHNEzGDl"]=base64_decode("aXRlbV9pZA==");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"]))
{
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}

class mobicommerce3_reviews_get_action extends BaseAction
{
    public function validate()
    {
        if (parent::validate())
        {
            $itemId = $this->getParam($GLOBALS["AdSKntICBqGkMHNEzGDl"]);
            if (!isset($itemId) || $itemId == $GLOBALS["tugkmwKQmrdyfghQnRJj"])
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