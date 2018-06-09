<?php
$GLOBALS["alHKmGFEojxrfKbyyvEp"]=base64_decode("Y2FydA==");$GLOBALS["tugkmwKQmrdyfghQnRJj"]=base64_decode("");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"]))
{
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}

class mobicommerce3_payments_hookredirect_action extends BaseAction
{
    public function execute()
    {
        $payment_module_name = $GLOBALS["tugkmwKQmrdyfghQnRJj"];
        $params = array();
    	$params['cart'] = $this->context->cart;
        $html = Module::getInstanceByName($payment_module_name)->hookPayment($params);
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