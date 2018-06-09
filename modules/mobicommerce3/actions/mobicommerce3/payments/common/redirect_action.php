<?php
$GLOBALS["alHKmGFEojxrfKbyyvEp"]=base64_decode("Y2FydA==");$GLOBALS["tugkmwKQmrdyfghQnRJj"]=base64_decode("");$GLOBALS["xTcREswwoneEcPrMnRIV"]=base64_decode("cGF5bWVudF9tZXRob2Q=");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"]))
{
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}

class mobicommerce3_payments_common_redirect_action extends BaseAction
{
    public function execute()
    {
        $payment_method = Tools::getValue($GLOBALS["xTcREswwoneEcPrMnRIV"]);
        $method = $GLOBALS["tugkmwKQmrdyfghQnRJj"];
        switch ($payment_method) {            
            default:
                $method = $payment_method;
                break;
        }
        
        $params = array();
        $params['cart'] = $this->context->cart;
        $html = Module::getInstanceByName($method)->hookPayment($params);
        echo $html;
        ?>
        <script>
            if(document.forms.length > 0) {
                document.forms[0].submit();
            }
            else if(document.getElementsByTagName('a').length == 1) {
                document.getElementsByTagName('a')[0].click();
            }
        </script>
        <?php
        exit;
    }
}
 ?>