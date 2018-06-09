<?php
$GLOBALS["JPeHjhYPagTDvLhPQOFn"]=base64_decode("dXNlcmRhdGE=");$GLOBALS["clDBUEZYNUFAaVDeeJcN"]=base64_decode("U2hvcHBpbmdDYXJ0");$GLOBALS["zyCDQPaTqgmxkQFUGvGF"]=base64_decode("Y2FydF9kZXRhaWxz");$GLOBALS["eDBBbOgJuUogOHNuDEDF"]=base64_decode("QXV0aGVudGljYXRpb24gZmFpbGVk");$GLOBALS["VwCGqpUwTcGsnqOFNfAB"]=base64_decode("ZW1haWw=");$GLOBALS["TpnrGOjhtLSTRosKltKa"]=base64_decode("SW52YWxpZCBwYXNzd29yZA==");$GLOBALS["MHMAcjyMMCpekWzcWthj"]=base64_decode("UGFzc3dvcmQgaXMgdG9vIGxvbmc=");$GLOBALS["uJQWIWmXYxAqoinBvafY"]=base64_decode("UGFzc3dvcmQgaXMgcmVxdWlyZWQ=");$GLOBALS["qhJymdWpyVJoFTtbyogs"]=base64_decode("cGFzc3dvcmQ=");$GLOBALS["lxJuPRqZoSfNgzJOudsg"]=base64_decode("SW52YWxpZCBlLW1haWwgYWRkcmVzcw==");$GLOBALS["QXNVAmcuVigZTsXROylc"]=base64_decode("RS1tYWlsIGFkZHJlc3MgcmVxdWlyZWQ=");$GLOBALS["tugkmwKQmrdyfghQnRJj"]=base64_decode("");$GLOBALS["KguGeViJiKmFdoKytXVA"]=base64_decode("dXNlcm5hbWU=");$GLOBALS["SJMQQHzjLEdLVmUkMEza"]=base64_decode("VXNlcg==");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"]))
{
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}

class mobicommerce3_user_login_action extends BaseAction
{
    public function execute()
    {
        $errors = array();
        $userService = ServiceFactory::factory('User');
        if (!$this->context->cookie->logged)
        {
            $username = is_null($this->getParam($GLOBALS["KguGeViJiKmFdoKytXVA"])) ? $GLOBALS["tugkmwKQmrdyfghQnRJj"] : trim($this->getParam($GLOBALS["KguGeViJiKmFdoKytXVA"]));
            if (empty($username))
            {
                $errors[] = Tools::displayError($GLOBALS["QXNVAmcuVigZTsXROylc"]);
            }
            else if (!Validate::isEmail($username))
            {
                $errors[] = Tools::displayError($GLOBALS["lxJuPRqZoSfNgzJOudsg"]);
            }

            $encryptedPassword = is_null($this->getParam($GLOBALS["qhJymdWpyVJoFTtbyogs"])) ? $GLOBALS["tugkmwKQmrdyfghQnRJj"] : trim($this->getParam($GLOBALS["qhJymdWpyVJoFTtbyogs"]));
            $password = $encryptedPassword;
            
            if (empty($password))
            {
                $errors[] = Tools::displayError($GLOBALS["uJQWIWmXYxAqoinBvafY"]);
            }
            else if (Tools::strlen($password) > 32)
            {
                $errors[] = Tools::displayError($GLOBALS["MHMAcjyMMCpekWzcWthj"]);
            }
            else if (!Validate::isPasswd($password))
            {
                $errors[] = Tools::displayError($GLOBALS["TpnrGOjhtLSTRosKltKa"]);
            }
          
            if (sizeof($errors))
            {
                $this->setError(MobicommerceResult::ERROR_USER_INPUT_PARAMETER, $errors);
                return;
            }

            $loginInfo = array(
                'email' => $username,
                'password' => $password
            );

            if (!$userService->login($loginInfo))
            {
                $this->setError(MobicommerceResult::ERROR_USER_INPUT_PARAMETER, array(Tools::displayError('Authentication failed')));
                return;
            }
        }

        $info = array();
        $info['cart_details'] = ServiceFactory::factory('ShoppingCart')->get();
        $info[$GLOBALS["JPeHjhYPagTDvLhPQOFn"]] = ServiceFactory::factory($GLOBALS["SJMQQHzjLEdLVmUkMEza"])->getUserInfo();
        
        $this->setSuccess($info);
    }
}
 ?>