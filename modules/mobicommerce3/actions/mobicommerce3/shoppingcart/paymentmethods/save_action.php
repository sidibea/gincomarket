<?php
$GLOBALS["FKJJSrcKfNlcouSwAAmL"]=base64_decode("dGl0bGU=");$GLOBALS["lLgHLxSaYAJPygsyGMTS"]=base64_decode("cGF5bWVudGluZm8=");$GLOBALS["zyCDQPaTqgmxkQFUGvGF"]=base64_decode("Y2FydF9kZXRhaWxz");$GLOBALS["kILHyWrKplYlLeXaggxX"]=base64_decode("bWV0aG9k");$GLOBALS["mHNNrwTAykFJCdWvpBOs"]=base64_decode("X2NvZGU=");$GLOBALS["WPPkEPzYXVPhTEkDCqUm"]=base64_decode("cGF5bWVudA==");$GLOBALS["clDBUEZYNUFAaVDeeJcN"]=base64_decode("U2hvcHBpbmdDYXJ0");$GLOBALS["PLrNnUVtQqMkPUueMguY"]=base64_decode("bW9iaWNvbW1lcmNl");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");$GLOBALS["MFlPPBWXQThfIlghoqUM"]=base64_decode("Y2FydF9kZXRhaWxz");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"]))
{
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}

class mobicommerce3_shoppingcart_paymentmethods_save_action extends BaseAction
{
    public function execute()
    {
        $this->context->cookie->__order_from_platform = $GLOBALS["PLrNnUVtQqMkPUueMguY"];
        
        $result = array();
        $result["cart_details"] = ServiceFactory::factory('ShoppingCart')->get();

        $payment = Tools::getValue($GLOBALS["WPPkEPzYXVPhTEkDCqUm"]);
    	$methods = ServiceFactory::factory($GLOBALS["clDBUEZYNUFAaVDeeJcN"])->getPaymentMethods();
    	foreach($methods as $_method)
    	{
    		if($_method[$GLOBALS["mHNNrwTAykFJCdWvpBOs"]] == $payment[$GLOBALS["kILHyWrKplYlLeXaggxX"]])
    		{
    			$result[$GLOBALS["zyCDQPaTqgmxkQFUGvGF"]][$GLOBALS["lLgHLxSaYAJPygsyGMTS"]] = array(
    				'title' => $_method['title']
    				);
    		}
    	}

        $this->setSuccess($result);
    }
}
 ?>