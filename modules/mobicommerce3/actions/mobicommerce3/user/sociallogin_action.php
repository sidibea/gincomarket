<?php
$GLOBALS["qhJymdWpyVJoFTtbyogs"]=base64_decode("cGFzc3dvcmQ=");$GLOBALS["JPeHjhYPagTDvLhPQOFn"]=base64_decode("dXNlcmRhdGE=");$GLOBALS["clDBUEZYNUFAaVDeeJcN"]=base64_decode("U2hvcHBpbmdDYXJ0");$GLOBALS["zyCDQPaTqgmxkQFUGvGF"]=base64_decode("Y2FydF9kZXRhaWxz");$GLOBALS["eDBBbOgJuUogOHNuDEDF"]=base64_decode("QXV0aGVudGljYXRpb24gZmFpbGVk");$GLOBALS["SJMQQHzjLEdLVmUkMEza"]=base64_decode("VXNlcg==");$GLOBALS["iVFDvUoWhiZjmoNxBFPl"]=base64_decode("ZmFtaWx5TmFtZQ==");$GLOBALS["cGCTlQrYXDkmTQiACEMM"]=base64_decode("Z2l2ZW5OYW1l");$GLOBALS["dmoVBpgmTQZlMhMbPas"]=base64_decode("YWN0aW9uQWZ0ZXJMb2dpbg==");$GLOBALS["VwCGqpUwTcGsnqOFNfAB"]=base64_decode("ZW1haWw=");$GLOBALS["pajspBTVtwKyXSuEhXpg"]=base64_decode("bGFzdF9uYW1l");$GLOBALS["aSUcuRxxYGDxeyhLbbVE"]=base64_decode("bGFzdG5hbWU=");$GLOBALS["yrRGGmuvoIjuzQzlXLWQ"]=base64_decode("Zmlyc3RfbmFtZQ==");$GLOBALS["FhzXsRsmAttmXNINpnhh"]=base64_decode("Zmlyc3RuYW1l");$GLOBALS["PAFMvaiVXkruXzFwDqaY"]=base64_decode("Z29vZ2xl");$GLOBALS["kWMNtvEksSzqeepAusos"]=base64_decode("ZmFjZWJvb2s=");$GLOBALS["kqpjokinrNKzMlmecrBs"]=base64_decode("dHlwZQ==");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");$GLOBALS["ucaweQNIqKhaUOkstHjs"]=base64_decode("b29wcw==");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"])) {
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}

class mobicommerce3_user_sociallogin_action extends BaseAction
{
    public function execute()
    {
        $type = Tools::getValue($GLOBALS["kqpjokinrNKzMlmecrBs"]);
        switch ($type)
        {
            case $GLOBALS["kWMNtvEksSzqeepAusos"]:
                $result = $this->doFacebookLogin();
                break;

            case $GLOBALS["PAFMvaiVXkruXzFwDqaY"]:
                $result = $this->doGoogleLogin();
                break;

            default:
                $result = $this->errorStatus($GLOBALS["ucaweQNIqKhaUOkstHjs"]);
                break;
        }

        return $result;
    }

    public function doFacebookLogin($data)
    {
        $user_data = array(
            'firstname' => Tools::getValue('first_name'),
            $GLOBALS["aSUcuRxxYGDxeyhLbbVE"]  => Tools::getValue($GLOBALS["pajspBTVtwKyXSuEhXpg"]),
            $GLOBALS["VwCGqpUwTcGsnqOFNfAB"]     => Tools::getValue($GLOBALS["VwCGqpUwTcGsnqOFNfAB"])
            );

        $actionAfterLogin = array();
        if(isset($data['actionAfterLogin']))
        {
            $actionAfterLogin = $data[$GLOBALS["dmoVBpgmTQZlMhMbPas"]];
        }

        return $this->loginProcess($user_data, $actionAfterLogin);
    }

    public function doGoogleLogin($data)
    {
        $user_data = array(
            'firstname' => Tools::getValue('givenName'),
            $GLOBALS["aSUcuRxxYGDxeyhLbbVE"]  => Tools::getValue($GLOBALS["iVFDvUoWhiZjmoNxBFPl"]),
            $GLOBALS["VwCGqpUwTcGsnqOFNfAB"]     => Tools::getValue($GLOBALS["VwCGqpUwTcGsnqOFNfAB"])
            );

        $actionAfterLogin = array();
        if(isset($data['actionAfterLogin']))
        {
            $actionAfterLogin = $data[$GLOBALS["dmoVBpgmTQZlMhMbPas"]];
        }

        return $this->loginProcess($user_data, $actionAfterLogin);
    }

    public function loginProcess($data, $actionAfterLogin)
    {
        $userService = ServiceFactory::factory($GLOBALS["SJMQQHzjLEdLVmUkMEza"]);
        $customer = new Customer();
        if($customer->getByEmail($data[$GLOBALS["VwCGqpUwTcGsnqOFNfAB"]]))
        {
            if (!$userService->login(null, $customer->id))
            {
                $this->setError(MobicommerceResult::ERROR_USER_INPUT_PARAMETER, array(Tools::displayError('Authentication failed')));
                return;
            }
            else
            {
                $info = array();
                $info['cart_details'] = ServiceFactory::factory('ShoppingCart')->get();
                $info[$GLOBALS["JPeHjhYPagTDvLhPQOFn"]] = ServiceFactory::factory($GLOBALS["SJMQQHzjLEdLVmUkMEza"])->getUserInfo();
                $this->setSuccess($info);
            }
        }
        else
        {
            $data[$GLOBALS["qhJymdWpyVJoFTtbyogs"]] = uniqid();
            $result = $userService->register($data);

            if ($result!==true)
            {
                $this->setError(MobicommerceResult::ERROR_USER_INVALID_USER_DATA, $result);
                return;
            }

            $this->setSuccess(
                array(
                    'cart_details' => ServiceFactory::factory('ShoppingCart')->get(),
                    $GLOBALS["JPeHjhYPagTDvLhPQOFn"] => ServiceFactory::factory($GLOBALS["SJMQQHzjLEdLVmUkMEza"])->getUserInfo()
                    )
                );
        }
    }
}
 ?>