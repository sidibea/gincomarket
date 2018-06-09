<?php
$GLOBALS["NaOCnpLqzUyskMYplDTo"]=base64_decode("Y2NhdmVudWU=");$GLOBALS["alHKmGFEojxrfKbyyvEp"]=base64_decode("Y2FydA==");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"]))
{
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}

class mobicommerce3_payments_ccavenue_redirect_action extends BaseAction
{
    public function execute()
    {
    	$cart = new Cart($this->context->cookie->id_cart);
    	$params = array(
    		'cart' => $cart
    		);
        $html = Module::getInstanceByName($GLOBALS["NaOCnpLqzUyskMYplDTo"])->hookPayment($params);
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