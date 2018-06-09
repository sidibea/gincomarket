<?php
$GLOBALS["ioiNpBIJqdbdxztuPQbp"]=base64_decode("Q2hlY2tvdXQ=");$GLOBALS["FACpIgSkaRogIlVgbHEI"]=base64_decode("U2hvcHBpbmcgQ2FydCBpcyBlbXB0eS4=");$GLOBALS["VJrqUxlwESnFpVzufJds"]=base64_decode("bWVzc2FnZXM=");$GLOBALS["SZeIobaJLvQzSbqPeirY"]=base64_decode("c2hvcHBpbmdfY2FydA==");$GLOBALS["GDqluTkbdULlEeRyMvDb"]=base64_decode("cmVkaXJlY3RfdG9fcGFnZQ==");$GLOBALS["ZLByMtYcQvHULAgSVbHs"]=base64_decode("Y2FuY2VsX3VybA==");$GLOBALS["hKPYVNgYuEySTzMShfwQ"]=base64_decode("cmV0dXJuX3VybA==");$GLOBALS["nUehvKTIgLJeoZeSjLBE"]=base64_decode("UGF5cGFsRXhwcmVzc0NoZWNrb3V0");$GLOBALS["vjxTxFtVDyxeUZVqIHxx"]=base64_decode("cGF5cGFsd3Bw");$GLOBALS["IbXKddgXWInlrdJnVRni"]=base64_decode("cGF5bWVudF9tZXRob2RfaWQ=");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"]))
{
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}

class mobicommerce3_shoppingcart_checkout_detail_action extends UserAuthorizedAction
{
    public function validate()
    {
        if ($this->getParam($GLOBALS["IbXKddgXWInlrdJnVRni"]) == $GLOBALS["vjxTxFtVDyxeUZVqIHxx"])
        {
            $expressCheckout = ServiceFactory::factory($GLOBALS["nUehvKTIgLJeoZeSjLBE"]);
            $paypal_express = new PaypalExpressCheckout($_REQUEST[$GLOBALS["hKPYVNgYuEySTzMShfwQ"]], $_REQUEST[$GLOBALS["ZLByMtYcQvHULAgSVbHs"]]);
            $expressCheckout->returnFromPaypal($paypal_express);
            return true;
        }
        else
        {
            return parent::validate();
        }
    }

    public function execute()
    {
        if (!$this->context->cart->id || $this->context->cart->nbProducts() < 1) {
            $this->setSuccess(array(
                $GLOBALS["GDqluTkbdULlEeRyMvDb"] => $GLOBALS["SZeIobaJLvQzSbqPeirY"],
                $GLOBALS["VJrqUxlwESnFpVzufJds"] => array('Shopping Cart is empty.')
            ));
        }
        else
        {
            $this->setSuccess(ServiceFactory::factory($GLOBALS["ioiNpBIJqdbdxztuPQbp"])->detail());
        }
    }
}
 ?>