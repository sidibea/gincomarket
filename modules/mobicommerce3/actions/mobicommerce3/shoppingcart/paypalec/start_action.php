<?php
$GLOBALS["MNMzzWTrQouLiRDzPMAS"]=base64_decode("PGJyLz4=");$GLOBALS["tugkmwKQmrdyfghQnRJj"]=base64_decode("");$GLOBALS["IUyxwiSnFvUOuLSFxbJQ"]=base64_decode("dG9rZW4=");$GLOBALS["eZIBzDIeYsvXjEnVCghF"]=base64_decode("cGF5bWVudF9jYXJ0");$GLOBALS["ZLByMtYcQvHULAgSVbHs"]=base64_decode("Y2FuY2VsX3VybA==");$GLOBALS["hKPYVNgYuEySTzMShfwQ"]=base64_decode("cmV0dXJuX3VybA==");$GLOBALS["nUehvKTIgLJeoZeSjLBE"]=base64_decode("UGF5cGFsRXhwcmVzc0NoZWNrb3V0");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"]))
{
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}

class mobicommerce3_shoppingcart_paypalec_start_action extends BaseAction
{
    public function execute()
    {
        $expressCheckout = ServiceFactory::factory($GLOBALS["nUehvKTIgLJeoZeSjLBE"]);
        $paypal_express = new PaypalExpressCheckout($_REQUEST[$GLOBALS["hKPYVNgYuEySTzMShfwQ"]], $_REQUEST[$GLOBALS["ZLByMtYcQvHULAgSVbHs"]], $GLOBALS["eZIBzDIeYsvXjEnVCghF"]);
        $result = $expressCheckout->startExpressCheckout($paypal_express);
        if (is_array($result) && isset($result[$GLOBALS["IUyxwiSnFvUOuLSFxbJQ"]]))
        {
            $this->setSuccess($result);
        }
        else
        {
            $this->setError($GLOBALS["tugkmwKQmrdyfghQnRJj"], (join($GLOBALS["MNMzzWTrQouLiRDzPMAS"], $paypal_express->logs)));
        }
    }
}
 ?>