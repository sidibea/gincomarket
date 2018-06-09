<?php
$GLOBALS["AfTzytjMsPtKZRkEUPYY"]=base64_decode("b3JkZXI=");$GLOBALS["SjvSaWvGTbJGKacRYovI"]=base64_decode("S2FuQ2FydC5TaG9wcGluZ0NhcnQuQ2hlY2tvdXQ=");$GLOBALS["fsKVjksAUVohhOXVygVd"]=base64_decode("S2FuQ2FydC5TaG9wcGluZ0NhcnQuUGF5cGFsRUMuU3RhcnQ=");$GLOBALS["NlFPmYCXhYgkwLpqCfN"]=base64_decode("UGF5bWVudF9tZXRob2RfaWQgaXMgZW1wdHku");$GLOBALS["tugkmwKQmrdyfghQnRJj"]=base64_decode("");$GLOBALS["alHKmGFEojxrfKbyyvEp"]=base64_decode("Y2FydA==");$GLOBALS["gDLbLYklpCTcTEwyCxpN"]=base64_decode("Y2hlY2tvdXRfdHlwZQ==");$GLOBALS["dUIxpcoANRsEWKkKkSCv"]=base64_decode("cGF5cGFsZWM=");$GLOBALS["IbXKddgXWInlrdJnVRni"]=base64_decode("cGF5bWVudF9tZXRob2RfaWQ=");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"]))
{
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}

class mobicommerce3_checkout_start_action extends UserAuthorizedAction
{
    public function validate()
    {
        if ($this->getParam($GLOBALS["IbXKddgXWInlrdJnVRni"]) == $GLOBALS["dUIxpcoANRsEWKkKkSCv"])
        {
            return true;
        }
        else
        {
            return parent::validate();
        }
    }

    public function execute()
    {
        switch (Tools::getValue($GLOBALS["gDLbLYklpCTcTEwyCxpN"]))
        {
            case $GLOBALS["alHKmGFEojxrfKbyyvEp"]:
                $paymentMethodID = $this->getParam($GLOBALS["IbXKddgXWInlrdJnVRni"]);
                if(!$paymentMethodID)
                {
                    $this->setError($GLOBALS["tugkmwKQmrdyfghQnRJj"], $GLOBALS["NlFPmYCXhYgkwLpqCfN"]);
                }
                else if($paymentMethodID == $GLOBALS["dUIxpcoANRsEWKkKkSCv"])
                {
                    $actionInstance = ActionFactory::factory($GLOBALS["fsKVjksAUVohhOXVygVd"]);
                    $actionInstance->init();
                    $actionInstance->execute();
                    $this->result = $actionInstance->getResult();
                }
                else
                {
                    $actionInstance = ActionFactory::factory($GLOBALS["SjvSaWvGTbJGKacRYovI"]);
                    $actionInstance->init();
                    $actionInstance->execute();
                    $this->result = $actionInstance->getResult();
                }
                break;
            case $GLOBALS["AfTzytjMsPtKZRkEUPYY"]:
                break;
            default:
                break;
        }
    }
}
 ?>