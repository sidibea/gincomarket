<?php
$GLOBALS["clDBUEZYNUFAaVDeeJcN"]=base64_decode("U2hvcHBpbmdDYXJ0");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");$GLOBALS["aNGnNgLXNWhZDmdvmbXe"]=base64_decode("dmVyc2lvbl9zdXBwb3J0");$GLOBALS["MFlPPBWXQThfIlghoqUM"]=base64_decode("Y2FydF9kZXRhaWxz");$GLOBALS["uZqmqgEmuexEoGMoL"]=base64_decode("cGF5bWVudF9tZXRob2Rz");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"]))
{
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}

class mobicommerce3_shoppingcart_paymentmethods_action extends BaseAction
{
    public function execute()
    {
    	$info = array(
    		"payment_methods" => ServiceFactory::factory('ShoppingCart')->getPaymentMethods(),
            $GLOBALS["MFlPPBWXQThfIlghoqUM"]    => ServiceFactory::factory($GLOBALS["clDBUEZYNUFAaVDeeJcN"])->get(),
            $GLOBALS["aNGnNgLXNWhZDmdvmbXe"] => true
    		);
        $this->setSuccess($info);
    }
}
 ?>