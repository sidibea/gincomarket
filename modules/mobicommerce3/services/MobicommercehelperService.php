<?php
$GLOBALS["SJMQQHzjLEdLVmUkMEza"]=base64_decode("VXNlcg==");$GLOBALS["nBsokqpBqDRpxvHdiuu"]=base64_decode("YXV0b2xvZ2luaWQ=");$GLOBALS["tugkmwKQmrdyfghQnRJj"]=base64_decode("");$GLOBALS["ZdTKYjgUlIqMUywjqKwt"]=base64_decode("ZDBhN2U3OTk3YjZkNWZjZDU1ZjRiNWMzMjYxMWI4N2NkOTIzZTg4ODM3YjYzYmYyOTQxZWY4MTlkYzhjYTI4Mg==");
?><?php


class MobicommercehelperService extends BaseService
{
    protected $key = "d0a7e7997b6d5fcd55f4b5c32611b87cd923e88837b63bf2941ef819dc8ca282";

    public function encrypt($string)
    {
        $key = _COOKIE_KEY_;
        $result = $GLOBALS["tugkmwKQmrdyfghQnRJj"];
        for($i=0, $k= strlen($string); $i<$k; $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key))-1, 1);
            $char = chr(ord($char)+ord($keychar));
            $result .= $char;
        }
        return base64_encode($result);
                
    }

    public function decrypt($string)
    {
        $key = _COOKIE_KEY_;
        $result = $GLOBALS["tugkmwKQmrdyfghQnRJj"];
        $string = base64_decode($string);
        for($i=0,$k=strlen($string); $i< $k ; $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key))-1, 1);
            $char = chr(ord($char)-ord($keychar));
            $result.=$char;
        }
        return $result;
                
    }

    
    public function autoLoginMobileUser()
    {
        if(isset($_REQUEST[$GLOBALS["nBsokqpBqDRpxvHdiuu"]]) && !empty($_REQUEST[$GLOBALS["nBsokqpBqDRpxvHdiuu"]])){
            $autologinid = $this->decrypt($_REQUEST[$GLOBALS["nBsokqpBqDRpxvHdiuu"]]);
            $customer = $this->context->cookie->id_customer;
            if(!empty($autologinid) && empty($this->context->cookie->id_customer)){
                ServiceFactory::factory($GLOBALS["SJMQQHzjLEdLVmUkMEza"])->login(null, $autologinid);
            }
            $_REQUEST[$GLOBALS["nBsokqpBqDRpxvHdiuu"]] = false;
        }
    }
}
 ?>