<?php
$GLOBALS["xlhZIDgKOCIUhPpCPieU"]=base64_decode("aWRfY3VycmVuY3k=");$GLOBALS["EKgfhpvQnjvyxdnwNsFs"]=base64_decode("TW9iaWNvbW1lcmNl");$GLOBALS["asxETQgoYgCVOHXhnboY"]=base64_decode("Y3VycmVuY3k=");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"]))
{
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}

class mobicommerce3_currency_change_action extends BaseAction
{
    public function execute()
    {
        if(isset($_REQUEST[$GLOBALS["asxETQgoYgCVOHXhnboY"]]) && !empty($_REQUEST[$GLOBALS["asxETQgoYgCVOHXhnboY"]]))
        {
            $currency = ServiceFactory::factory($GLOBALS["EKgfhpvQnjvyxdnwNsFs"])->getCurrencyByCode($_REQUEST[$GLOBALS["asxETQgoYgCVOHXhnboY"]]);
            if(!empty($currency))
            {
                $this->context->cookie->id_currency = (int) $currency[$GLOBALS["xlhZIDgKOCIUhPpCPieU"]];
            }
        }

        $this->setSuccess();
    }
}
 ?>