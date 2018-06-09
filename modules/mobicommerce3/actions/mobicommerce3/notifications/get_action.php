<?php
$GLOBALS["TfIqXBCgTuhHaCJORHhC"]=base64_decode("bm90aWZpY2F0aW9ucw==");$GLOBALS["liCfeXRYaJkYssKDloHs"]=base64_decode("c2VuZF90aW1l");$GLOBALS["jyObMGpPUjJncLSMZBcQ"]=base64_decode("aW1hZ2U=");$GLOBALS["fqmNRQDiPSDlolhEWcsd"]=base64_decode("aW1hZ2VfdXJs");$GLOBALS["oTOYEPbiumdOgFwcVVhC"]=base64_decode("ZGVlcGxpbms=");$GLOBALS["lfZwhCoVRiYhvVPBQbEe"]=base64_decode("bWVzc2FnZQ==");$GLOBALS["dTgTlqxkJVxCEotaParH"]=base64_decode("aGVhZGluZw==");$GLOBALS["SiRSACHoXsTIZeRmGmwq"]=base64_decode("aWQ=");$GLOBALS["ZVKNFtyTTzOBNUuwlXkr"]=base64_decode("ZGF0ZV9zdWJtaXR0ZWQ=");$GLOBALS["PwJOiwyCpcKySEGvcgyD"]=base64_decode("ZGV2aWNl");$GLOBALS["HLRfIBMCSDQyIxGxUEw"]=base64_decode("bW9iaWNvbW1lcmNlX3B1c2hoaXN0b3J5");$GLOBALS["ZwKRIxWDGPzjIERcTNUh"]=base64_decode("YXBwY29kZQ==");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");$GLOBALS["LhEvzvMERfdORGZmcdCF"]=base64_decode("JykgT1JERVIgQlkgaWQgREVTQw==");$GLOBALS["sfYgXWWkdceScOxpVECJ"]=base64_decode("JykgQU5EIHNlbmRfdG9fdHlwZSA9J2FsbCcgQU5EIGRldmljZV90eXBlIElOICgnYm90aCcsICc=");$GLOBALS["LAsZYTweTMyfscdNyshq"]=base64_decode("IFdIRVJFIGFwcGNvZGUgPSAn");$GLOBALS["gzIUQEcZVPZgAHQYAGgh"]=base64_decode("IExJTUlUIA==");$GLOBALS["sAPDZpozFDJbiEZMENJv"]=base64_decode("Jywgc2VuZF90bykpKSBPUkRFUiBCWSBgaWRgIERFU0M=");$GLOBALS["jcBmvVfvDzXEKAvsUIHL"]=base64_decode("KHNlbmRfdG9fdHlwZSA9ICdjdXN0b21lcl9ncm91cCcgQU5EIEZJTkRfSU5fU0VUKCAn");$GLOBALS["viLduARIdhslsJXbbyFm"]=base64_decode("Jywgc2VuZF90bykpIE9SIA==");$GLOBALS["qipcOfQhEHtNvRDUSnhb"]=base64_decode("KHNlbmRfdG9fdHlwZSA9ICdzcGVjaWZpY19jdXN0b21lcicgQU5EIEZJTkRfSU5fU0VUKCAn");$GLOBALS["EQOtoyZQnQCIhXoxajr"]=base64_decode("JykgQU5EIChzZW5kX3RvX3R5cGUgPSdhbGwnIE9SIA==");$GLOBALS["QfLCtwlOKKjjBcenTIyQ"]=base64_decode("JyBBTkQgc3RvcmVfaWQgSU4gKCcwJywgJw==");$GLOBALS["GRVDccBnQMhzsCNbfOxF"]=base64_decode("IFdIRVJFIA0KICAgICAgICAgICAgICAgIGFwcGNvZGUgPSAn");$GLOBALS["nrhwShLzxrgmJFXGdfFd"]=base64_decode("U0VMRUNUICogRlJPTSA=");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"]))
{
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}


class mobicommerce3_notifications_get_action extends BaseAction
{
    protected $limit = 50;
    
    public function execute()
    {
        $customer_id = (int) $this->context->cookie->id_customer;
        $appcode = Tools::getValue($GLOBALS["ZwKRIxWDGPzjIERcTNUh"]);
        $_table = $GLOBALS["HLRfIBMCSDQyIxGxUEw"];

        if ($customer_id)
        {
            $store = $this->context->cookie->id_lang;
            $customer = new Customer($customer_id);
            $customer_group_id = $customer->id_default_group;

            $sql = $GLOBALS["nrhwShLzxrgmJFXGdfFd"]._DB_PREFIX_ . $_table . $GLOBALS["GRVDccBnQMhzsCNbfOxF"].$appcode.$GLOBALS["QfLCtwlOKKjjBcenTIyQ"].$store.$GLOBALS["EQOtoyZQnQCIhXoxajr"];
            $sql .= $GLOBALS["qipcOfQhEHtNvRDUSnhb"] . $customer_id . $GLOBALS["viLduARIdhslsJXbbyFm"];
            $sql .= $GLOBALS["jcBmvVfvDzXEKAvsUIHL"] . $customer_group_id . $GLOBALS["sAPDZpozFDJbiEZMENJv"];
            $sql .= $GLOBALS["gzIUQEcZVPZgAHQYAGgh"] . ($this->limit);
        }
        else
        {
            $sql = $GLOBALS["nrhwShLzxrgmJFXGdfFd"]._DB_PREFIX_ . $_table . $GLOBALS["LAsZYTweTMyfscdNyshq"].$appcode.$GLOBALS["QfLCtwlOKKjjBcenTIyQ"].$store.$GLOBALS["sfYgXWWkdceScOxpVECJ"].Tools::getValue($GLOBALS["PwJOiwyCpcKySEGvcgyD"]).$GLOBALS["LhEvzvMERfdORGZmcdCF"];
            $sql .= $GLOBALS["gzIUQEcZVPZgAHQYAGgh"] . ($this->limit);
        }
        $collection = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);

        $notifications = array();
        if ($collection) {
            foreach ($collection as $_collection) {
                $send_time = $_collection[$GLOBALS["ZVKNFtyTTzOBNUuwlXkr"]];
                $_notification = array(
                    'id'        => $_collection['id'],
                    'heading'   => $_collection['heading'],
                    'message'   => $_collection['message'],
                    'deeplink'  => $_collection['deeplink'],
                    'image_url' => $_collection['image'],
                    'send_time' => $send_time
                    );
                addImageRatio($_notification);
                $notifications[] = $_notification;
            }
        }

        $info = $array;
        $info[$GLOBALS["TfIqXBCgTuhHaCJORHhC"]] = $notifications;
        $this->setSuccess($info);
    }
}
 ?>