<?php
$GLOBALS["FeNylpHCwQIWjEGLfuSb"]=base64_decode("dmVyc2lvbl9zdXBwb3J0");$GLOBALS["zyCDQPaTqgmxkQFUGvGF"]=base64_decode("Y2FydF9kZXRhaWxz");$GLOBALS["SOgAIvbEFLgLiTffEgXU"]=base64_decode("IiBpcyBub3QgdmFsaWQu");$GLOBALS["gejdIivmglnCrvJmCCGN"]=base64_decode("Q291cG9uIGNvZGUgIg==");$GLOBALS["clDBUEZYNUFAaVDeeJcN"]=base64_decode("U2hvcHBpbmdDYXJ0");$GLOBALS["IllxivRAsHwmadZmnjPz"]=base64_decode("Y291cG9uX2NvZGU=");$GLOBALS["ioiNpBIJqdbdxztuPQbp"]=base64_decode("Q2hlY2tvdXQ=");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");$GLOBALS["aNGnNgLXNWhZDmdvmbXe"]=base64_decode("dmVyc2lvbl9zdXBwb3J0");$GLOBALS["MFlPPBWXQThfIlghoqUM"]=base64_decode("Y2FydF9kZXRhaWxz");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"]))
{
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}

class mobicommerce3_shoppingcart_coupons_update_action extends BaseAction
{
    public function execute()
    {
        $checkoutService = ServiceFactory::factory($GLOBALS["ioiNpBIJqdbdxztuPQbp"]);
        $couponCode = $_REQUEST[$GLOBALS["IllxivRAsHwmadZmnjPz"]];
        $error = $checkoutService->updateCoupon($couponCode);
        $shoppingCartInfo = ServiceFactory::factory($GLOBALS["clDBUEZYNUFAaVDeeJcN"])->get();
        if(count($error))
        {
            $this->setError(MobicommerceResult::ERROR_CART_INPUT_PARAMETER, $GLOBALS["gejdIivmglnCrvJmCCGN"].$couponCode.$GLOBALS["SOgAIvbEFLgLiTffEgXU"],array($GLOBALS["MFlPPBWXQThfIlghoqUM"]=>$shoppingCartInfo,$GLOBALS["aNGnNgLXNWhZDmdvmbXe"]=>true));
            return;
        }
        
        $info = array();
        $info['cart_details'] = $shoppingCartInfo;
        $info['version_support'] = true;

        $this->setSuccess($info);
    }
}
 ?>