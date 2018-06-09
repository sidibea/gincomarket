<?php
$GLOBALS["clDBUEZYNUFAaVDeeJcN"]=base64_decode("U2hvcHBpbmdDYXJ0");$GLOBALS["zyCDQPaTqgmxkQFUGvGF"]=base64_decode("Y2FydF9kZXRhaWxz");$GLOBALS["EATCzQlwIticdwizFpuU"]=base64_decode("c2hpcHBpbmdfbWV0aG9kcw==");$GLOBALS["djUHgAUBPKdarJcYpGng"]=base64_decode("Mg==");$GLOBALS["zalvkBtccpMvwhoLQLWg"]=base64_decode("Y2Fycmllcl9pbmRleA==");$GLOBALS["dLjYwJEMKEadGctIXhMQ"]=base64_decode("aW5zdHJ1Y3Rpb25z");$GLOBALS["cZkwkPLDyMymURQTbgjs"]=base64_decode("bG9nbw==");$GLOBALS["GCGFbJCidDfsPuCoAHNX"]=base64_decode("cHJpY2VfdGF4X2V4Yw==");$GLOBALS["IXCfKzsjlitrRiMXFvE"]=base64_decode("cHJpY2U=");$GLOBALS["FKJJSrcKfNlcouSwAAmL"]=base64_decode("dGl0bGU=");$GLOBALS["AZEKlQNRaLTVUTezVIEK"]=base64_decode("bWV0aG9kX3RpdGxl");$GLOBALS["mRZXdIWqnmuSweCtWWzK"]=base64_decode("Y2Fycmllcg==");$GLOBALS["NVfQfcfEMlbuxzbpTZKL"]=base64_decode("c21faWQ=");$GLOBALS["fcoPzIuYMjbtOJqsdHcU"]=base64_decode("Y29kZQ==");$GLOBALS["ioiNpBIJqdbdxztuPQbp"]=base64_decode("Q2hlY2tvdXQ=");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"])) {
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}

class mobicommerce3_shoppingcart_shippingmethods_get_action extends BaseAction
{
    public function execute()
    {
        $carriers = array();
        $checkoutService = ServiceFactory::factory('Checkout');
        $shippingMethodes =  $checkoutService->getOrderShippingMethods($carriers);
        $methods = array();
        if(!empty($shippingMethodes)){
        	foreach ($shippingMethodes as $value) {
        		$_method = array(
                    'code'          => $value['sm_id'],
                    'carrier'       => $value['sm_id'],
                    'method_title'  => $value['title'],
                    'price'         => $value['price'],
                    'price_tax_exc' => $value['price_tax_exc'],
                    'logo'          => $value['logo'],
                    'instructions'  => $value['instructions'],
                    'carrier_index' => '2'
        			);
        		$methods[] = $_method;
        	}
        }

        $info = array();
        $info['shipping_methods'] = $methods;
        $info['cart_details'] = ServiceFactory::factory('ShoppingCart')->get();
        $this->setSuccess($info);
    }
}
 ?>