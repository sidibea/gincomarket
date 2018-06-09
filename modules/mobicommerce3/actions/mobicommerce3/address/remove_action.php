<?php
$GLOBALS["PevIZvobKAOSmjyMnhyy"]=base64_decode("QWRkcmVzcyBib29rIGlzIGVtcHR5");$GLOBALS["lRBzvzBSEQkJxdBItbg"]=base64_decode("LA==");$GLOBALS["JPeHjhYPagTDvLhPQOFn"]=base64_decode("dXNlcmRhdGE=");$GLOBALS["clDBUEZYNUFAaVDeeJcN"]=base64_decode("U2hvcHBpbmdDYXJ0");$GLOBALS["zyCDQPaTqgmxkQFUGvGF"]=base64_decode("Y2FydF9kZXRhaWxz");$GLOBALS["SJMQQHzjLEdLVmUkMEza"]=base64_decode("VXNlcg==");$GLOBALS["SiRSACHoXsTIZeRmGmwq"]=base64_decode("aWQ=");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"])) {
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}

class mobicommerce3_address_remove_action extends UserAuthorizedAction
{
    public function execute()
    {
        $address_id = (int) Tools::getValue($GLOBALS["SiRSACHoXsTIZeRmGmwq"]);
        if ($address_id) {
            $result = ServiceFactory::factory($GLOBALS["SJMQQHzjLEdLVmUkMEza"])->deleteAddress($address_id);
            if (true === $result)
            {
                $this->setSuccess(
                    array(
                        'cart_details' => ServiceFactory::factory('ShoppingCart')->get(),
                        $GLOBALS["JPeHjhYPagTDvLhPQOFn"]     => ServiceFactory::factory($GLOBALS["SJMQQHzjLEdLVmUkMEza"])->getUserInfo($this->context->cookie->email),
                        )
                    );
                return;
            }
            $this->setError(MobicommerceResult::ERROR_USER_INPUT_PARAMETER, join($GLOBALS["lRBzvzBSEQkJxdBItbg"], $result));
        }
        $this->setError(MobicommerceResult::ERROR_USER_INPUT_PARAMETER, $GLOBALS["PevIZvobKAOSmjyMnhyy"]);
    }
}
 ?>