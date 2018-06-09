<?php
$GLOBALS["gdQXMTFfFCXjEMDkNIbi"]=base64_decode("cHVzaHByZWZlcmVuY2U=");$GLOBALS["zRerAbIJbJmpfsBcyDez"]=base64_decode("bWRfZW5hYmxlX3B1c2g=");$GLOBALS["oDSdgwKfYAqFvhjezhIF"]=base64_decode("bWRfc3RvcmVfaWQ=");$GLOBALS["CbXKtHjQMuurwQdOKVvz"]=base64_decode("IgogICAgICAgICAgICA=");$GLOBALS["jgGlUPBdAErTRBDMKTkv"]=base64_decode("bW9iaWNvbW1lcmNlX2RldmljZXRva2Vuc2AKICAgICAgICAgICAgV0hFUkUgYG1kX2FwcGNvZGVgID0gIg==");$GLOBALS["claNysYGLQhVsHiKTvgU"]=base64_decode("CiAgICAgICAgICAgIFNFTEVDVCAqCiAgICAgICAgICAgIEZST00gYA==");$GLOBALS["kkthtzTzpAJMHyzlJqfZ"]=base64_decode("dXNlcmlk");$GLOBALS["bnCUgEryxxzsrRJFowKH"]=base64_decode("bWRfaWQ=");$GLOBALS["cjdFyRkwzdlEsSjIzzc"]=base64_decode("bW9iaWNvbW1lcmNlX2RldmljZXRva2Vucw==");$GLOBALS["mYMJgNVvvEDWgMoODUAA"]=base64_decode("bWRfdXNlcmlk");$GLOBALS["FssdfjvVXybScftcZwry"]=base64_decode("bWRfZGV2aWNldG9rZW4=");$GLOBALS["zUXozvkKOXzZDMesKByH"]=base64_decode("bWRfZGV2aWNldHlwZQ==");$GLOBALS["YBAwLuCheitDWxRvCbjX"]=base64_decode("bWRfYXBwY29kZQ==");$GLOBALS["mcUIrtKjJGYKVaiXHNZF"]=base64_decode("IgogICAgICAgICAgICAgICAg");$GLOBALS["HLYuQicwNBwApkqJldPw"]=base64_decode("IiBhbmQgYG1kX2RldmljZXRva2VuYCA9ICI=");$GLOBALS["OkBakCkSOyCRCIISkJkO"]=base64_decode("IiBhbmQgYG1kX2RldmljZXR5cGVgID0gIg==");$GLOBALS["NbCpQYmfdNlJzjRjE"]=base64_decode("bW9iaWNvbW1lcmNlX2RldmljZXRva2Vuc2AKICAgICAgICAgICAgICAgIFdIRVJFIGBtZF9hcHBjb2RlYCA9ICI=");$GLOBALS["kUfglmYQfhOmZmPNdabk"]=base64_decode("CiAgICAgICAgICAgICAgICBTRUxFQ1QgKgogICAgICAgICAgICAgICAgRlJPTSBg");$GLOBALS["CNxdZqWtbEUodCNEYxhA"]=base64_decode("ZGV2aWNldG9rZW4=");$GLOBALS["VleCnkvKIYrZfptPiSKI"]=base64_decode("cGxhdGZvcm0=");$GLOBALS["ZwKRIxWDGPzjIERcTNUh"]=base64_decode("YXBwY29kZQ==");$GLOBALS["CGbFgRIFcNnyLvvmfknU"]=base64_decode("Jw==");$GLOBALS["BYhJSuEnsrVopPWlIPtY"]=base64_decode("bWRfaWQgPSAn");
?><?php




class PushnotificationService extends BaseService
{
    public function __construct()
    {
        parent::__construct();
            }

    public function saveDeviceToken($data = array())
    {
        $appcode     = isset($data[$GLOBALS["ZwKRIxWDGPzjIERcTNUh"]]) ? $data[$GLOBALS["ZwKRIxWDGPzjIERcTNUh"]] : NULL;
        $platform    = isset($data[$GLOBALS["VleCnkvKIYrZfptPiSKI"]]) ? $data[$GLOBALS["VleCnkvKIYrZfptPiSKI"]] : NULL;
        $devicetoken = isset($data[$GLOBALS["CNxdZqWtbEUodCNEYxhA"]]) ? $data[$GLOBALS["CNxdZqWtbEUodCNEYxhA"]] : NULL;

        if(empty($appcode) || empty($platform) || empty($devicetoken)){
            return false;
        }
        else{
            $sql = $GLOBALS["kUfglmYQfhOmZmPNdabk"]._DB_PREFIX_.$GLOBALS["NbCpQYmfdNlJzjRjE"].$appcode.$GLOBALS["OkBakCkSOyCRCIISkJkO"].$platform.$GLOBALS["HLYuQicwNBwApkqJldPw"].$devicetoken.$GLOBALS["mcUIrtKjJGYKVaiXHNZF"];
            $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
            if(!$result){
                $_data = array(
                    'md_appcode'     => $appcode,
                    'md_devicetype'  => $platform,
                    'md_devicetoken' => $devicetoken
                    );
                if($this->context->customer->isLogged()){
                    $_data[$GLOBALS["mYMJgNVvvEDWgMoODUAA"]] = $this->context->cookie->id_customer;
                }

                Db::getInstance()->insert($GLOBALS["cjdFyRkwzdlEsSjIzzc"], $_data, false, false);
            }
            else{
                if($this->context->customer->isLogged()){
                    $userid = $this->context->cookie->id_customer;
                    
                    foreach($result as $_collection){
                        $_data = array(
                            'md_userid' => $userid
                            );
                        Db::getInstance()->update($GLOBALS["cjdFyRkwzdlEsSjIzzc"], $_data, $GLOBALS["BYhJSuEnsrVopPWlIPtY"].$_collection[$GLOBALS["bnCUgEryxxzsrRJFowKH"]].$GLOBALS["CGbFgRIFcNnyLvvmfknU"], false);
                    }
                }
            }
            return true;
        }
    }

    public function updateDeviceTokenUser($data)
    {
        $appcode = $data[$GLOBALS["ZwKRIxWDGPzjIERcTNUh"]];
        $devicetoken = $data[$GLOBALS["CNxdZqWtbEUodCNEYxhA"]];
        $userid = $data[$GLOBALS["kkthtzTzpAJMHyzlJqfZ"]];
        $sql = $GLOBALS["claNysYGLQhVsHiKTvgU"]._DB_PREFIX_.$GLOBALS["jgGlUPBdAErTRBDMKTkv"].$appcode.$GLOBALS["HLYuQicwNBwApkqJldPw"].$devicetoken.$GLOBALS["CbXKtHjQMuurwQdOKVvz"];
        $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
        if($result){
            foreach($result as $_collection){
                $_data = array(
                    'md_userid' => $userid
                    );
                
                Db::getInstance()->update($GLOBALS["cjdFyRkwzdlEsSjIzzc"], $_data, $GLOBALS["BYhJSuEnsrVopPWlIPtY"].$_collection[$GLOBALS["bnCUgEryxxzsrRJFowKH"]].$GLOBALS["CGbFgRIFcNnyLvvmfknU"], false);
            }
        }
    }

    public function updatePreference()
    {
        $appcode = Tools::getValue($GLOBALS["ZwKRIxWDGPzjIERcTNUh"]);
        $devicetoken = Tools::getValue($GLOBALS["CNxdZqWtbEUodCNEYxhA"]);

        if($appcode && $devicetoken)
        {
            $id_customer = (int) $this->context->cookie->id_customer;
            if(!$id_customer)
                $id_customer = NULL;

            $sql = $GLOBALS["kUfglmYQfhOmZmPNdabk"]._DB_PREFIX_.$GLOBALS["NbCpQYmfdNlJzjRjE"].$appcode.$GLOBALS["HLYuQicwNBwApkqJldPw"].$devicetoken.$GLOBALS["mcUIrtKjJGYKVaiXHNZF"];
            $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
            if($result)
            {
                $_data = array(
                    'md_userid'      => $id_customer,
                    'md_store_id'    => $this->context->cookie->id_lang,
                    'md_enable_push' => (int) Tools::getValue($GLOBALS["gdQXMTFfFCXjEMDkNIbi"]),
                    );
                Db::getInstance()->update($GLOBALS["cjdFyRkwzdlEsSjIzzc"], $_data, $GLOBALS["BYhJSuEnsrVopPWlIPtY"].$result[0][$GLOBALS["bnCUgEryxxzsrRJFowKH"]].$GLOBALS["CGbFgRIFcNnyLvvmfknU"], false);
            }
        }
    }
}
 ?>