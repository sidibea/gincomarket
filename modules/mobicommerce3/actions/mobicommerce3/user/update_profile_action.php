<?php
$GLOBALS["JPeHjhYPagTDvLhPQOFn"]=base64_decode("dXNlcmRhdGE=");$GLOBALS["clDBUEZYNUFAaVDeeJcN"]=base64_decode("U2hvcHBpbmdDYXJ0");$GLOBALS["zyCDQPaTqgmxkQFUGvGF"]=base64_decode("Y2FydF9kZXRhaWxz");$GLOBALS["lfZwhCoVRiYhvVPBQbEe"]=base64_decode("bWVzc2FnZQ==");$GLOBALS["jvNUZuArDlDbVsDKKNjT"]=base64_decode("c3RhdHVz");$GLOBALS["VwCGqpUwTcGsnqOFNfAB"]=base64_decode("ZW1haWw=");$GLOBALS["aSUcuRxxYGDxeyhLbbVE"]=base64_decode("bGFzdG5hbWU=");$GLOBALS["FhzXsRsmAttmXNINpnhh"]=base64_decode("Zmlyc3RuYW1l");$GLOBALS["SJMQQHzjLEdLVmUkMEza"]=base64_decode("VXNlcg==");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"])) {
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}

class mobicommerce3_user_update_profile_action extends UserAuthorizedAction
{
    public function execute()
    {
        $userService = ServiceFactory::factory($GLOBALS["SJMQQHzjLEdLVmUkMEza"]);
        $data = array(
            'firstname' => Tools::getValue('firstname'),
            $GLOBALS["aSUcuRxxYGDxeyhLbbVE"]  => Tools::getValue($GLOBALS["aSUcuRxxYGDxeyhLbbVE"]),
            $GLOBALS["VwCGqpUwTcGsnqOFNfAB"]     => Tools::getValue($GLOBALS["VwCGqpUwTcGsnqOFNfAB"]),
        );
        
        try
        {
            $result = $userService->update($data);
        }
        catch(Exception $e)
        {
            $this->setError(MobicommerceResult::ERROR_USER_INVALID_USER_DATA, $e->getMessage());
            return;
        }

        if (!$result[$GLOBALS["jvNUZuArDlDbVsDKKNjT"]])
        {
            $this->setError(MobicommerceResult::ERROR_USER_INVALID_USER_DATA, $result[$GLOBALS["lfZwhCoVRiYhvVPBQbEe"]]);
            return;
        }

        $info = array();
        $info['cart_details'] = ServiceFactory::factory('ShoppingCart')->get();
        $info[$GLOBALS["JPeHjhYPagTDvLhPQOFn"]] = ServiceFactory::factory($GLOBALS["SJMQQHzjLEdLVmUkMEza"])->getUserInfo();
        $info[$GLOBALS["lfZwhCoVRiYhvVPBQbEe"]] = $result[$GLOBALS["lfZwhCoVRiYhvVPBQbEe"]];
        $this->setSuccess($info);
    }
}
 ?>