<?php
$GLOBALS["JPeHjhYPagTDvLhPQOFn"]=base64_decode("dXNlcmRhdGE=");$GLOBALS["clDBUEZYNUFAaVDeeJcN"]=base64_decode("U2hvcHBpbmdDYXJ0");$GLOBALS["zyCDQPaTqgmxkQFUGvGF"]=base64_decode("Y2FydF9kZXRhaWxz");$GLOBALS["jRoLhsfsiAeUhJKrALNg"]=base64_decode("Y3VzdG9tQXR0cmlidXRlcw==");$GLOBALS["ZZPaGsZjDLhIHgDkJTaW"]=base64_decode("ICA=");$GLOBALS["FhzXsRsmAttmXNINpnhh"]=base64_decode("Zmlyc3RuYW1l");$GLOBALS["aSUcuRxxYGDxeyhLbbVE"]=base64_decode("bGFzdG5hbWU=");$GLOBALS["MvIenhmKJLSJKpsdQFM"]=base64_decode("WW91IGNhbm5vdCBjcmVhdGUgYSBndWVzdCBhY2NvdW50Lg==");$GLOBALS["XAWfJyqLjoMmFLPlvpDE"]=base64_decode("UFNfR1VFU1RfQ0hFQ0tPVVRfRU5BQkxFRA==");$GLOBALS["fwqOYQwBxQYEqBuorPJI"]=base64_decode("aXNfbmV3X2N1c3RvbWVy");$GLOBALS["uJQWIWmXYxAqoinBvafY"]=base64_decode("UGFzc3dvcmQgaXMgcmVxdWlyZWQ=");$GLOBALS["diNxAEoTPnVKqcexkE"]=base64_decode("QW4gYWNjb3VudCBhbHJlYWR5IGV4aXN0cyBmb3IgdGhpcyBlbWFpbCBhZGRyZXNzOg==");$GLOBALS["lxJuPRqZoSfNgzJOudsg"]=base64_decode("SW52YWxpZCBlLW1haWwgYWRkcmVzcw==");$GLOBALS["qhJymdWpyVJoFTtbyogs"]=base64_decode("cGFzc3dvcmQ=");$GLOBALS["tugkmwKQmrdyfghQnRJj"]=base64_decode("");$GLOBALS["VwCGqpUwTcGsnqOFNfAB"]=base64_decode("ZW1haWw=");$GLOBALS["SJMQQHzjLEdLVmUkMEza"]=base64_decode("VXNlcg==");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"]))
{
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}

class mobicommerce3_user_register_action extends BaseAction
{
    public function execute()
    {
        $userService = ServiceFactory::factory($GLOBALS["SJMQQHzjLEdLVmUkMEza"]);
        $username = is_null($this->getParam($GLOBALS["VwCGqpUwTcGsnqOFNfAB"])) ? $GLOBALS["tugkmwKQmrdyfghQnRJj"] : trim($this->getParam($GLOBALS["VwCGqpUwTcGsnqOFNfAB"]));
        $enCryptedPassword = is_null($this->getParam($GLOBALS["qhJymdWpyVJoFTtbyogs"])) ? $GLOBALS["tugkmwKQmrdyfghQnRJj"] : trim($this->getParam($GLOBALS["qhJymdWpyVJoFTtbyogs"]));
        $password = $enCryptedPassword;

        $customer = new Customer();
        
        if (empty($username) || !Validate::isEmail($username))
        {
            $this->setError(MobicommerceResult::ERROR_USER_INVALID_USER_DATA, array(Tools::displayError('Invalid e-mail address')));
            return;
        }

        $customer->getByEmail($username);

        if ($customer->id)
        {
            $this->setError(MobicommerceResult::ERROR_USER_INVALID_USER_DATA, array(Tools::displayError('An account already exists for this email address:')));
            return;
        }

        if (empty($password))
        {
            $this->setError(MobicommerceResult::ERROR_USER_INVALID_USER_DATA, array(Tools::displayError('Password is required')));
            return;
        }
        if (!Tools::getValue($GLOBALS["fwqOYQwBxQYEqBuorPJI"], 1) && !Configuration::get($GLOBALS["XAWfJyqLjoMmFLPlvpDE"]))
        {
             $this->setError(MobicommerceResult::ERROR_USER_AUTHENTICATION_PROBLEM, array(Tools::displayError('You cannot create a guest account.')));
             return;
        }
        $name = trim($this->getParam($GLOBALS["aSUcuRxxYGDxeyhLbbVE"]));
        $firstname = is_null($this->getParam($GLOBALS["FhzXsRsmAttmXNINpnhh"])) ? $GLOBALS["ZZPaGsZjDLhIHgDkJTaW"] : trim($this->getParam($GLOBALS["FhzXsRsmAttmXNINpnhh"]));
        $customAttributes = $this->getParam($GLOBALS["jRoLhsfsiAeUhJKrALNg"]);
        $lastname = empty($name) ? $GLOBALS["ZZPaGsZjDLhIHgDkJTaW"] : $name;
        $regisetInfo = array(
            'firstname'        => $firstname,
            'lastname'         => $lastname,
            'email'            => $username,
            'password'         => $password,
            'customAttributes' => $customAttributes
        );
        $result = $userService->register($regisetInfo);
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
 ?>