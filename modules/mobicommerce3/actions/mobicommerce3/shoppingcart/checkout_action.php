<?php
$GLOBALS["BfGWNPxPdUGSjWuCvmXz"]=base64_decode("PGJyPg==");$GLOBALS["fpaeRtqabgxVrxakwgft"]=base64_decode("T3JkZXI=");$GLOBALS["GDRrLneapceRZeqzXRAs"]=base64_decode("TW9iaWNvbW1lcmNlUGF5bWVudA==");$GLOBALS["PLrNnUVtQqMkPUueMguY"]=base64_decode("bW9iaWNvbW1lcmNl");$GLOBALS["DSzImqcMyunikQcFnKBa"]=base64_decode("RXJyb3I6IFNob3BwaW5nQ2FydCBpcyBlbXB0eS4=");$GLOBALS["MwgPjuhqsMPjhppaxvBF"]=base64_decode("RXJyb3I6IHBheW1lbnRfbWV0aG9kX2lkIGlzIGVtcHR5Lg==");$GLOBALS["zgqvuSduBkCrQvoNAmfm"]=base64_decode("UGF5cGFsIGlzIFVuYXZhaWxhYmxlLg==");$GLOBALS["zZgvgAASdUtHFFLQDVxW"]=base64_decode("cGF5cGFsX3BhcmFtcw==");$GLOBALS["talIVCLoJvCwHEulQoGd"]=base64_decode("MHhGRkZG");$GLOBALS["pkMhXLbHgTmNzRnqBdbI"]=base64_decode("UGF5cGFsV3Bz");$GLOBALS["yBStskatZFBcleieKciX"]=base64_decode("UEFZUEFMX0JVU0lORVNT");$GLOBALS["AvpWRgjbjjVvBFnFfcdK"]=base64_decode("cGF5cGFs");$GLOBALS["MNMzzWTrQouLiRDzPMAS"]=base64_decode("PGJyLz4=");$GLOBALS["tugkmwKQmrdyfghQnRJj"]=base64_decode("");$GLOBALS["IUyxwiSnFvUOuLSFxbJQ"]=base64_decode("dG9rZW4=");$GLOBALS["HWFHoYVtrOPPBLGhDnSN"]=base64_decode("Y29tbWl0");$GLOBALS["OBjCjbJjxmPEIyEMrYfQ"]=base64_decode("Y29udGludWU=");$GLOBALS["JEJPniOyoXmllWuJGMeA"]=base64_decode("cGF5cGFsX3JlZGlyZWN0X3VybA==");$GLOBALS["eZIBzDIeYsvXjEnVCghF"]=base64_decode("cGF5bWVudF9jYXJ0");$GLOBALS["ZLByMtYcQvHULAgSVbHs"]=base64_decode("Y2FuY2VsX3VybA==");$GLOBALS["hKPYVNgYuEySTzMShfwQ"]=base64_decode("cmV0dXJuX3VybA==");$GLOBALS["nUehvKTIgLJeoZeSjLBE"]=base64_decode("UGF5cGFsRXhwcmVzc0NoZWNrb3V0");$GLOBALS["vjxTxFtVDyxeUZVqIHxx"]=base64_decode("cGF5cGFsd3Bw");$GLOBALS["lfZwhCoVRiYhvVPBQbEe"]=base64_decode("bWVzc2FnZQ==");$GLOBALS["kILHyWrKplYlLeXaggxX"]=base64_decode("bWV0aG9k");$GLOBALS["WPPkEPzYXVPhTEkDCqUm"]=base64_decode("cGF5bWVudA==");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"]))
{
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}

class mobicommerce3_shoppingcart_checkout_action extends UserAuthorizedAction
{
    public function execute()
    {
        $payment = trim($_REQUEST[$GLOBALS["WPPkEPzYXVPhTEkDCqUm"]][$GLOBALS["kILHyWrKplYlLeXaggxX"]]);
        $message = Tools::getValue($GLOBALS["lfZwhCoVRiYhvVPBQbEe"]);
        switch ($payment)
        {
            case $GLOBALS["vjxTxFtVDyxeUZVqIHxx"]:
                $this->paypalwpp();
                break;
            
            default:
                $this->payorder($payment, $message);
                break;
        }
    }

    public function paypalwpp()
    {
                $expressCheckout = ServiceFactory::factory($GLOBALS["nUehvKTIgLJeoZeSjLBE"]);
        $paypal_express = new PaypalExpressCheckout(Tools::getValue($GLOBALS["hKPYVNgYuEySTzMShfwQ"]), Tools::getValue($GLOBALS["ZLByMtYcQvHULAgSVbHs"]), $GLOBALS["eZIBzDIeYsvXjEnVCghF"]);
        $result = $expressCheckout->startExpressCheckout($paypal_express);
        $result[$GLOBALS["JEJPniOyoXmllWuJGMeA"]] = str_replace($GLOBALS["OBjCjbJjxmPEIyEMrYfQ"], $GLOBALS["HWFHoYVtrOPPBLGhDnSN"], $result[$GLOBALS["JEJPniOyoXmllWuJGMeA"]]);

        if (is_array($result) && isset($result[$GLOBALS["IUyxwiSnFvUOuLSFxbJQ"]]))
        {
            $this->setSuccess($result);
        }
        else
        {
            $this->setError($GLOBALS["tugkmwKQmrdyfghQnRJj"], (join($GLOBALS["MNMzzWTrQouLiRDzPMAS"], $paypal_express->logs)));
        }
    }

    public function paypal()
    {
                if (Module::isInstalled($GLOBALS["AvpWRgjbjjVvBFnFfcdK"]) && Configuration::get($GLOBALS["yBStskatZFBcleieKciX"]))
        {
            $paypal = ServiceFactory::factory($GLOBALS["pkMhXLbHgTmNzRnqBdbI"]);
            list($result, $response) = $paypal->buildWpsRedirectParams(Tools::getValue($GLOBALS["hKPYVNgYuEySTzMShfwQ"]), Tools::getValue($GLOBALS["ZLByMtYcQvHULAgSVbHs"]));
            if ($result == false)
            {
                $this->setError($GLOBALS["talIVCLoJvCwHEulQoGd"], $response);
            }
            else
            {
                $this->setSuccess(array(
                    $GLOBALS["JEJPniOyoXmllWuJGMeA"] => $paypal->getPaypalUrl(),
                    $GLOBALS["zZgvgAASdUtHFFLQDVxW"] => $response
                ));
            }
        }
        else
        {
            $this->setError($GLOBALS["talIVCLoJvCwHEulQoGd"], $GLOBALS["zgqvuSduBkCrQvoNAmfm"]);
        }
    }

    public function payorder($method, $order_message = '')
    {
        if (empty($method))
        {
            $this->setError($GLOBALS["tugkmwKQmrdyfghQnRJj"], $GLOBALS["MwgPjuhqsMPjhppaxvBF"]);
        }
        elseif (!$this->context->cart->id || $this->context->cart->nbProducts() < 1)
        {
            $this->setError($GLOBALS["tugkmwKQmrdyfghQnRJj"], $GLOBALS["DSzImqcMyunikQcFnKBa"]);
        }
        else
        {
            $this->context->cookie->__order_from_platform = $GLOBALS["PLrNnUVtQqMkPUueMguY"];

            $payment = ServiceFactory::factory($GLOBALS["GDRrLneapceRZeqzXRAs"]);
            $external_payments = $payment->getExternalPaymentMethods();
            
            if ($this->context->cart->getOrderTotal() <= 0){
                $payment = ServiceFactory::factory($GLOBALS["GDRrLneapceRZeqzXRAs"]); 
                $payment->placeOrder($method, $order_message);
                $orderService = ServiceFactory::factory($GLOBALS["fpaeRtqabgxVrxakwgft"]);
                $info = $orderService->getPaymentOrderInfo($order);
                $info[$GLOBALS["lfZwhCoVRiYhvVPBQbEe"]] = $GLOBALS["tugkmwKQmrdyfghQnRJj"];
                $this->setSuccess($info);
            }

            else if(!in_array(Tools::strtolower($method), $external_payments))
            {
                list($result, $order, $message) = $payment->placeOrder($method, $order_message);
                if ($result === true)
                {
                    $orderService = ServiceFactory::factory($GLOBALS["fpaeRtqabgxVrxakwgft"]);
                    $info = $orderService->getPaymentOrderInfo($order);
                    $info[$GLOBALS["lfZwhCoVRiYhvVPBQbEe"]] = $message;
                    $this->setSuccess($info);
                }
                else
                {
                    is_array($message) && $message = join($GLOBALS["BfGWNPxPdUGSjWuCvmXz"], $message);
                    $this->setError($GLOBALS["tugkmwKQmrdyfghQnRJj"], $message);
                }
            }
            else
            {
                $info = array();
                $info['message'] = $message;
                $this->setSuccess($info);
            }
        }
    }
}
 ?>