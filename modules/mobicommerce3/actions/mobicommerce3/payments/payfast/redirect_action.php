<?php
$GLOBALS["VEanVKYwoCQTAjCaCRaK"]=base64_decode("cGF5ZmFzdA==");$GLOBALS["alHKmGFEojxrfKbyyvEp"]=base64_decode("Y2FydA==");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"]))
{
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}

class mobicommerce3_payments_payfast_redirect_action extends BaseAction
{
    public function execute()
    {
        $params = array();
        $params['cart'] = $this->context->cart;
        $html = Module::getInstanceByName('payfast')->hookPayment($params);
        echo $html;
        ?>
        <script>
            document.forms[0].submit();
        </script>
        <?php
        exit;
    }
}
 ?>