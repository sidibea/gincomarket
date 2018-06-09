<?php
$GLOBALS["ypItkxCqzlCQacBOCPvL"]=base64_decode("aW5pdA==");$GLOBALS["hbIKLvFAaKCDbQpAjiBu"]=base64_decode("Y29uZmlnLmluYw==");$GLOBALS["FLIovxVepvrPFelUHGgg"]=base64_decode("LnBocA==");$GLOBALS["HUiKUMxYhEBgxCViwWCY"]=base64_decode("Y2FuY2VsX3JldHVybg==");$GLOBALS["yFcTjDwvibzbjcsXUgcg"]=base64_decode("cmV0dXJu");$GLOBALS["EGXZznsdSOtUOfhhMQEH"]=base64_decode("TW9iaWNvbW1lcmNlX1NQX1dQUw==");$GLOBALS["DMXuuTwfLuIsfOFUOKth"]=base64_decode("Ym4=");$GLOBALS["PSJoyUNPUKHRTqCoeGqA"]=base64_decode("Y3VycmVuY3lfY29kZQ==");$GLOBALS["dPSxxlYhFXFWlvDxEOuA"]=base64_decode("L25hbWVccyo9XHMqIihbXiJdKykiXHMqdmFsdWVccyo9XHMqIihbXiJdKykiLw==");$GLOBALS["sYSmLlnbpFPkBpEVJkcV"]=base64_decode("Pz4=");$GLOBALS["HKOgIrorgOlGrpqRVrdn"]=base64_decode("PD9QSFA=");$GLOBALS["tugkmwKQmrdyfghQnRJj"]=base64_decode("");$GLOBALS["LdTcWnpreFDrWvJIqCtC"]=base64_decode("PD9waHA=");$GLOBALS["dilLquGXGjSRTFveDVWO"]=base64_decode("JHRoaXMtPmluY2x1ZGVGaWxl");$GLOBALS["uaoERejsXQyZkDcAORqD"]=base64_decode("aW5jbHVkZQ==");$GLOBALS["AvpWRgjbjjVvBFnFfcdK"]=base64_decode("cGF5cGFs");$GLOBALS["VxneRdFkmOIBmdJzMqiq"]=base64_decode("L2hyZWZccyo9IihbXiJdKykv");$GLOBALS["fPyRhoPAqohOHDxPXezE"]=base64_decode("aGlkZGVu");$GLOBALS["alHKmGFEojxrfKbyyvEp"]=base64_decode("Y2FydA==");$GLOBALS["yVpkfvVDXVPSoLLGvUJK"]=base64_decode("Y29va2ll");$GLOBALS["vsbDmYzEyYrgojpiKrrY"]=base64_decode("cGF5cGFsL3BheXBhbC5waHA=");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"])) {
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}


require _PS_MODULE_DIR_ . $GLOBALS["vsbDmYzEyYrgojpiKrrY"];

class PaypalWpsService
{
    private $paypal;

    public function __construct()
    {
        $this->paypal = new Paypal();
    }

    public function getPaypalUrl()
    {
        return $this->paypal->getPaypalUrl();
    }

    public function buildWpsRedirectParams($return_url, $cancel_url)
    {
        $params = array('cookie' => $this->context->cookie, 'cart' => $this->context->cart);
        $matches = array();

        $output = $this->paypal->hookPayment($params);
        if (strpos($output, $GLOBALS["fPyRhoPAqohOHDxPXezE"]) === FALSE) {
            if (preg_match($GLOBALS["VxneRdFkmOIBmdJzMqiq"], $output, $matches)) {
                $fileName = Tools::substr($matches[1], strpos($matches[1], $GLOBALS["AvpWRgjbjjVvBFnFfcdK"]));
                $context = Tools::file_get_contents(_PS_MODULE_DIR_ . $fileName);
                $context = str_replace($GLOBALS["uaoERejsXQyZkDcAORqD"], $GLOBALS["dilLquGXGjSRTFveDVWO"], $context);
                $context = str_replace($GLOBALS["LdTcWnpreFDrWvJIqCtC"], $GLOBALS["tugkmwKQmrdyfghQnRJj"], $context);
                $context = str_replace($GLOBALS["HKOgIrorgOlGrpqRVrdn"], $GLOBALS["tugkmwKQmrdyfghQnRJj"], $context);
                $context = str_replace($GLOBALS["sYSmLlnbpFPkBpEVJkcV"], $GLOBALS["tugkmwKQmrdyfghQnRJj"], $context);
                ob_start();
                eval($context);
                $output = ob_get_clean();
            }
        }

        if (preg_match_all($GLOBALS["dPSxxlYhFXFWlvDxEOuA"], $output, $matches)) {
            $options = array_combine($matches[1], $matches[2]);
        } else {
            $options = array($output);
        }
        
        $this->context->cookie->pay_currency = $options[$GLOBALS["PSJoyUNPUKHRTqCoeGqA"]];

        $options[$GLOBALS["DMXuuTwfLuIsfOFUOKth"]] = $GLOBALS["EGXZznsdSOtUOfhhMQEH"];
        $options[$GLOBALS["yFcTjDwvibzbjcsXUgcg"]] = $return_url;
        $options[$GLOBALS["HUiKUMxYhEBgxCViwWCY"]] = $cancel_url;

        return array(true, $options);
    }

    private function includeFile($fileName)
    {
        $name = basename($fileName, $GLOBALS["FLIovxVepvrPFelUHGgg"]);
        $skip = array('config.inc', 'init', 'paypal');
        if (!in_array($name, $skip)) {
            include $fileName;
        }
    }
}
 ?>