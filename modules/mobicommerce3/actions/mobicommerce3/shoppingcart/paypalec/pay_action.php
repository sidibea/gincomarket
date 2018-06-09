<?php
$GLOBALS["MNMzzWTrQouLiRDzPMAS"]=base64_decode("PGJyLz4=");$GLOBALS["tugkmwKQmrdyfghQnRJj"]=base64_decode("");$GLOBALS["fpaeRtqabgxVrxakwgft"]=base64_decode("T3JkZXI=");$GLOBALS["nUehvKTIgLJeoZeSjLBE"]=base64_decode("UGF5cGFsRXhwcmVzc0NoZWNrb3V0");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"]))
{
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}

class mobicommerce3_shoppingcart_paypalec_pay_action extends BaseAction
{
    public function execute()
    {
        $expressCheckoutService = ServiceFactory::factory($GLOBALS["nUehvKTIgLJeoZeSjLBE"]);
        $paypal_express = new PaypalExpressCheckout();
        
        $paypal_express->payer_id || $expressCheckoutService->returnFromPaypal($paypal_express);

        $order = $expressCheckoutService->pay($paypal_express);
        if ($order)
        {
            $orderService = ServiceFactory::factory($GLOBALS["fpaeRtqabgxVrxakwgft"]);
            $info = $orderService->getPaymentOrderInfo($order);
            $this->setSuccess($info);
        }
        else
        {
            $this->setError($GLOBALS["tugkmwKQmrdyfghQnRJj"], join($GLOBALS["MNMzzWTrQouLiRDzPMAS"], $paypal_express->logs));
        }
    }
}
 ?>