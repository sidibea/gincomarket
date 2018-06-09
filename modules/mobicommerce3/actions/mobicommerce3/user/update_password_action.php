<?php
$GLOBALS["SJMQQHzjLEdLVmUkMEza"]=base64_decode("VXNlcg==");$GLOBALS["JPeHjhYPagTDvLhPQOFn"]=base64_decode("dXNlcmRhdGE=");$GLOBALS["clDBUEZYNUFAaVDeeJcN"]=base64_decode("U2hvcHBpbmdDYXJ0");$GLOBALS["zyCDQPaTqgmxkQFUGvGF"]=base64_decode("Y2FydF9kZXRhaWxz");$GLOBALS["GBKciMrtiTKdJdgdYfEA"]=base64_decode("VGhlIHBhc3N3b3JkIGFuZCBjb25maXJtYXRpb24gZG8gbm90IG1hdGNoLg==");$GLOBALS["ouuParUbvXMqpgPjKCEV"]=base64_decode("VGhlIHBhc3N3b3JkIHlvdSBlbnRlcmVkIGlzIGluY29ycmVjdC4=");$GLOBALS["GzbvbuHaIszTRTEzXOZn"]=base64_decode("cGFzc3dvcmRfcmVxdWlyZWRfZXJyb3I=");$GLOBALS["fCapZzTzBjRUyLsaLABF"]=base64_decode("Y29uZmlybWF0aW9u");$GLOBALS["qhJymdWpyVJoFTtbyogs"]=base64_decode("cGFzc3dvcmQ=");$GLOBALS["jRzQKVITYAdFQOSLjaiB"]=base64_decode("Y3VycmVudF9wYXNzd29yZA==");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"]))
{
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}

class mobicommerce3_user_update_password_action extends UserAuthorizedAction
{
    public function execute()
    {
        $currentPassword = Tools::getValue($GLOBALS["jRzQKVITYAdFQOSLjaiB"]);   
        $NewPassword = Tools::getValue($GLOBALS["qhJymdWpyVJoFTtbyogs"]);
        $confirmPassword = Tools::getValue($GLOBALS["fCapZzTzBjRUyLsaLABF"]);

        if(empty($NewPassword))
        {
            $this->setError(MobicommerceResult::ERROR_USER_INVALID_USER_DATA, array('password_required_error'));
            return;
        }
        else if (Tools::encrypt($currentPassword) != $this->context->cookie->passwd)
        {
            $this->setError(MobicommerceResult::ERROR_USER_INVALID_USER_DATA, array(Tools::displayError('The password you entered is incorrect.')));
            return;
        }
        elseif ($NewPassword != $confirmPassword)
        {
            $this->setError(MobicommerceResult::ERROR_USER_INVALID_USER_DATA, array(Tools::displayError('The password and confirmation do not match.')));
            return;
        }
        else
        {
        	$customer = new Customer((int)$this->context->cookie->id_customer);
        	$customer->passwd = md5(_COOKIE_KEY_.$NewPassword);
        	$customer->update();

        	$this->context->cookie->passwd = $customer->passwd;
        }

        $info = array();
        $info['cart_details'] = ServiceFactory::factory('ShoppingCart')->get();
        $info[$GLOBALS["JPeHjhYPagTDvLhPQOFn"]] = ServiceFactory::factory($GLOBALS["SJMQQHzjLEdLVmUkMEza"])->getUserInfo($this->context->cookie->email);
        $this->setSuccess($info);
    }
}
 ?>