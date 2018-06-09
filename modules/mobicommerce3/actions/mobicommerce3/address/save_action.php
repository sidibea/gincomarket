<?php
$GLOBALS["lRBzvzBSEQkJxdBItbg"]=base64_decode("LA==");$GLOBALS["lfZwhCoVRiYhvVPBQbEe"]=base64_decode("bWVzc2FnZQ==");$GLOBALS["JPeHjhYPagTDvLhPQOFn"]=base64_decode("dXNlcmRhdGE=");$GLOBALS["clDBUEZYNUFAaVDeeJcN"]=base64_decode("U2hvcHBpbmdDYXJ0");$GLOBALS["zyCDQPaTqgmxkQFUGvGF"]=base64_decode("Y2FydF9kZXRhaWxz");$GLOBALS["jUJlFKAHJtuCBOaXqLAA"]=base64_decode("cGhvbmVfbW9iaWxl");$GLOBALS["LDaCknwxASaApkDZdzqc"]=base64_decode("cGhvbmU=");$GLOBALS["eXzPUWlNwFsHWkMUnYUR"]=base64_decode("cG9zdGNvZGU=");$GLOBALS["KiOzLfZJBPkKLVwZhBnm"]=base64_decode("YWRkcmVzc18y");$GLOBALS["mUMIWkNxHVmuOiAKTnBv"]=base64_decode("YWRkcmVzc18x");$GLOBALS["WKBChtIeVLMffdOLPBQn"]=base64_decode("Y2l0eQ==");$GLOBALS["TQzEeGckpfylSIYwClUI"]=base64_decode("cmVnaW9uX2lk");$GLOBALS["hisQaHmNwnXuxDABlXZJ"]=base64_decode("aWRfc3RhdGU=");$GLOBALS["GNgmbRbejfRAIZpcZGBR"]=base64_decode("Y291bnRyeV9pZA==");$GLOBALS["ZpUDbwPQocJrSAPpBgbL"]=base64_decode("Y29tcGFueQ==");$GLOBALS["FhzXsRsmAttmXNINpnhh"]=base64_decode("Zmlyc3RuYW1l");$GLOBALS["aSUcuRxxYGDxeyhLbbVE"]=base64_decode("bGFzdG5hbWU=");$GLOBALS["yFoLRCpCxqJNidAOTqTt"]=base64_decode("YWxpYXM=");$GLOBALS["SiRSACHoXsTIZeRmGmwq"]=base64_decode("aWQ=");$GLOBALS["KweijIUSAnkiqrUsUlHq"]=base64_decode("YWRkcmVzc19pZA==");$GLOBALS["tugkmwKQmrdyfghQnRJj"]=base64_decode("");$GLOBALS["rYlIPOBrKjdNxIKNcBXZ"]=base64_decode("c3RyZWV0");$GLOBALS["SJMQQHzjLEdLVmUkMEza"]=base64_decode("VXNlcg==");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"])) {
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}

class mobicommerce3_address_save_action extends BaseAction
{
    public function execute()
    {
        $userService = ServiceFactory::factory($GLOBALS["SJMQQHzjLEdLVmUkMEza"]);
        
        $street = Tools::getValue($GLOBALS["rYlIPOBrKjdNxIKNcBXZ"], array('', ''));
        $address = array(
            'address_id'   => Tools::getValue('id', null),
            $GLOBALS["yFoLRCpCxqJNidAOTqTt"]        => Tools::getValue($GLOBALS["yFoLRCpCxqJNidAOTqTt"], $GLOBALS["tugkmwKQmrdyfghQnRJj"]),
            $GLOBALS["aSUcuRxxYGDxeyhLbbVE"]     => Tools::getValue($GLOBALS["aSUcuRxxYGDxeyhLbbVE"], $GLOBALS["tugkmwKQmrdyfghQnRJj"]),
            $GLOBALS["FhzXsRsmAttmXNINpnhh"]    => Tools::getValue($GLOBALS["FhzXsRsmAttmXNINpnhh"], $GLOBALS["tugkmwKQmrdyfghQnRJj"]),
            $GLOBALS["ZpUDbwPQocJrSAPpBgbL"]      => Tools::getValue($GLOBALS["ZpUDbwPQocJrSAPpBgbL"], $GLOBALS["tugkmwKQmrdyfghQnRJj"]),
            $GLOBALS["GNgmbRbejfRAIZpcZGBR"]   => Tools::getValue($GLOBALS["GNgmbRbejfRAIZpcZGBR"], $GLOBALS["tugkmwKQmrdyfghQnRJj"]),
            $GLOBALS["hisQaHmNwnXuxDABlXZJ"]     => Tools::getValue($GLOBALS["TQzEeGckpfylSIYwClUI"], $GLOBALS["tugkmwKQmrdyfghQnRJj"]),
            $GLOBALS["WKBChtIeVLMffdOLPBQn"]         => Tools::getValue($GLOBALS["WKBChtIeVLMffdOLPBQn"], $GLOBALS["tugkmwKQmrdyfghQnRJj"]),
            $GLOBALS["mUMIWkNxHVmuOiAKTnBv"]    => $street[0],
            $GLOBALS["KiOzLfZJBPkKLVwZhBnm"]    => $street[1],
            $GLOBALS["eXzPUWlNwFsHWkMUnYUR"]     => Tools::getValue($GLOBALS["eXzPUWlNwFsHWkMUnYUR"], $GLOBALS["tugkmwKQmrdyfghQnRJj"]),
            $GLOBALS["LDaCknwxASaApkDZdzqc"]        => Tools::getValue($GLOBALS["LDaCknwxASaApkDZdzqc"], $GLOBALS["tugkmwKQmrdyfghQnRJj"]),
            $GLOBALS["jUJlFKAHJtuCBOaXqLAA"] => Tools::getValue($GLOBALS["jUJlFKAHJtuCBOaXqLAA"], $GLOBALS["tugkmwKQmrdyfghQnRJj"]),
        );

        $updateResult = $userService->updateAddress($address);
        if (!is_array($updateResult))
        {
            $this->setSuccess(array(
                $GLOBALS["zyCDQPaTqgmxkQFUGvGF"] => ServiceFactory::factory($GLOBALS["clDBUEZYNUFAaVDeeJcN"])->get(),
                $GLOBALS["JPeHjhYPagTDvLhPQOFn"]     => ServiceFactory::factory($GLOBALS["SJMQQHzjLEdLVmUkMEza"])->getUserInfo($this->context->cookie->email),
                $GLOBALS["lfZwhCoVRiYhvVPBQbEe"]      => $updateResult
                ));
            return;
        }
        $this->setError(MobicommerceResult::ERROR_USER_INPUT_PARAMETER, implode($GLOBALS["lRBzvzBSEQkJxdBItbg"], $updateResult));
    }
}
 ?>