<?php
$GLOBALS["SiRSACHoXsTIZeRmGmwq"]=base64_decode("aWQ=");$GLOBALS["aaVSngfyKHLQgxZvwrY"]=base64_decode("MA==");$GLOBALS["MvYkQFiAIDsPLBLZIXSI"]=base64_decode("IgkKICAgIAkJ");$GLOBALS["tRKaCxhTkvSfIlTHKovP"]=base64_decode("bW9iaWNvbW1lcmNlX2FwcGxpY2F0aW9uczNgIGMgCiAgICAJCVdIRVJFIGMuYGFwcF9jb2RlYCA9ICI=");$GLOBALS["qgCAHbCrCbHDJmkhekBr"]=base64_decode("CiAgICAJCVNFTEVDVCBjLioKICAgIAkJRlJPTSBg");$GLOBALS["oCmlFYwbaNvjEByvDVPC"]=base64_decode("LiBQcmVzdGFzaG9wIFBsdWdpbiB2");$GLOBALS["qgdnOlwClLVcZXAbDjIU"]=base64_decode("IGlzIGluc3RhbGxlZCBvbiBQcmVzdGFzaG9wIHY=");$GLOBALS["jUJaPfKGtfMnVvTZRClP"]=base64_decode("TW9iaUNvbW1lcmNlIE9wZW5BUEkgdg==");$GLOBALS["ZwKRIxWDGPzjIERcTNUh"]=base64_decode("YXBwY29kZQ==");$GLOBALS["ULKNINtXjqVOjzISwNDn"]=base64_decode("S0NfREVCVUdfTU9ERQ==");$GLOBALS["zjjGvpKthtLRQruITsnU"]=base64_decode("XQ==");$GLOBALS["DlKBOmJASibTsGJZPdsv"]=base64_decode("Ww==");$GLOBALS["NaIWyKRpZPzxDOBbTLUE"]=base64_decode("WERFQlVHX1NFU1NJT05fU1RBUlQ=");$GLOBALS["tugkmwKQmrdyfghQnRJj"]=base64_decode("");$GLOBALS["bygOgJugkWuUgiFGVLom"]=base64_decode("c2lnbg==");$GLOBALS["GtHFZMNtWhRXHljTYTcT"]=base64_decode("VVRD");$GLOBALS["kDRvPlChrWfxyRjsARhe"]=base64_decode("dGltZXN0YW1w");$GLOBALS["dcgsBFCIMCVtdwgGqazI"]=base64_decode("X1BPU1Q=");$GLOBALS["pTDAhHYQBfpgRSobquug"]=base64_decode("X0dFVA==");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");$GLOBALS["SnsSSwMKZSYeMFnEirnh"]=base64_decode("");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"]))
{
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}

class BaseAction
{
    protected $params = array();
    protected $paramSources = array('_GET', '_POST');
    protected $result = null;
    protected $context;

    public function getParamSources()
    {
        return $this->paramSources;
    }

    public function init()
    {
        $this->context = Context::getContext();
        $this->result = new MobicommerceResult();

        if (!is_long($_REQUEST[$GLOBALS["kDRvPlChrWfxyRjsARhe"]]))
        {
            $timezone = date_default_timezone_get();
            date_default_timezone_set($GLOBALS["GtHFZMNtWhRXHljTYTcT"]);
            $_REQUEST[$GLOBALS["kDRvPlChrWfxyRjsARhe"]] = strtotime($_REQUEST[$GLOBALS["kDRvPlChrWfxyRjsARhe"]]);
            date_default_timezone_set($timezone);
        }
    }

    public function getParam($keyName)
    {
        $this->getParamSources();
        if (isset($this->_params[$keyName]))
        {
            return $this->_params[$keyName];
        } 
        return Tools::getValue($keyName, null);
    }

    public function setParam($key, $val)
    {
        if (isset($key)) {
            $this->params[$key] = $val;
        }
    }

    public function setSuccess($info = null)
    {
        if (!is_null($this->result))
        {
            $this->result->setSuccess($info);
        }
    }

    public function setError($code, $msg = null, $info = array())
    {
        if (!is_null($this->result))
        {
            $this->result->setError($code, $msg, $info);
        }
    }

    public function getResult()
    {
        return $this->result;
    }

    public function execute()
    {
        
    }

    private function validateRequestSign(array $requestParams)
    {
        if (!isset($requestParams[$GLOBALS["bygOgJugkWuUgiFGVLom"]]) || $requestParams[$GLOBALS["bygOgJugkWuUgiFGVLom"]] == $GLOBALS["tugkmwKQmrdyfghQnRJj"])
        {
            return false;
        }
        $sign = $requestParams[$GLOBALS["bygOgJugkWuUgiFGVLom"]];
        unset($requestParams[$GLOBALS["bygOgJugkWuUgiFGVLom"]]);
        unset($requestParams[$GLOBALS["NaIWyKRpZPzxDOBbTLUE"]]);
        ksort($requestParams);
        reset($requestParams);
        $tempStr = $GLOBALS["SnsSSwMKZSYeMFnEirnh"];
        foreach ($requestParams as $key => $value)
        {
            if(is_array($value))
            {
				foreach($value as $k => $v)
                {
					$tempStr = $tempStr . $key. $GLOBALS["DlKBOmJASibTsGJZPdsv"] . $k . $GLOBALS["zjjGvpKthtLRQruITsnU"] . Tools::stripslashes($v);
				}
			}
            else
            {
				$tempStr = $tempStr . $key . Tools::stripslashes($value);
			}
        }
        $tempStr = $tempStr . MOBICOMMERCE_APP_SECRET;
        return strtoupper(md5($tempStr)) === $sign;
    }

    public function validate()
    {
        if (defined($GLOBALS["ULKNINtXjqVOjzISwNDn"]) && KC_DEBUG_MODE)
        {
            return true;
        }

        if (!$this->checkAPIKey($this->getParam($GLOBALS["ZwKRIxWDGPzjIERcTNUh"])))
        {
            die($GLOBALS["jUJaPfKGtfMnVvTZRClP"] . API_VERSION . $GLOBALS["qgdnOlwClLVcZXAbDjIU"] . _PS_VERSION_ . $GLOBALS["oCmlFYwbaNvjEByvDVPC"] . MOBICOMMERCE_PLUGIN_VERSION);
        }
        
        return true;
    }
    
    public function checkAPIKey($appcode)
    {
        $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($GLOBALS["qgCAHbCrCbHDJmkhekBr"]._DB_PREFIX_.$GLOBALS["tRKaCxhTkvSfIlTHKovP"].$appcode.$GLOBALS["MvYkQFiAIDsPLBLZIXSI"]);
        
        if(isset($result[$GLOBALS["aaVSngfyKHLQgxZvwrY"]][$GLOBALS["SiRSACHoXsTIZeRmGmwq"]]))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
 ?>