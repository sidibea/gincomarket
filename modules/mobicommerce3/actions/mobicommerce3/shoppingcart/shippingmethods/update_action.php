<?php
$GLOBALS["clDBUEZYNUFAaVDeeJcN"]=base64_decode("U2hvcHBpbmdDYXJ0");$GLOBALS["ioiNpBIJqdbdxztuPQbp"]=base64_decode("Q2hlY2tvdXQ=");$GLOBALS["krcTTbNMVVHYidqObhgR"]=base64_decode("c2hpcHBpbmdfbWV0aG9k");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");$GLOBALS["MFlPPBWXQThfIlghoqUM"]=base64_decode("Y2FydF9kZXRhaWxz");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"])) {
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}

class mobicommerce3_shoppingcart_shippingmethods_update_action extends BaseAction
{
    public function execute()
    {
        $shippingMethodId = $this->getParam($GLOBALS["krcTTbNMVVHYidqObhgR"]);
        $checkoutService = ServiceFactory::factory($GLOBALS["ioiNpBIJqdbdxztuPQbp"]);
        if ($shippingMethodId) {
            $checkoutService->updateShippingMethod($shippingMethodId);
        }
        $result = $checkoutService->detail();
        $result[$GLOBALS["MFlPPBWXQThfIlghoqUM"]] = ServiceFactory::factory($GLOBALS["clDBUEZYNUFAaVDeeJcN"])->get();
        $this->setSuccess($result);
    }
}
 ?>