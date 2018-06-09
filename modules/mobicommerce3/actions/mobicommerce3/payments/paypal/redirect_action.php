<?php
$GLOBALS["AvpWRgjbjjVvBFnFfcdK"]=base64_decode("cGF5cGFs");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"]))
{
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}

class mobicommerce3_payments_paypal_redirect_action extends BaseAction
{
    public function execute()
    {
        $html = Module::getInstanceByName($GLOBALS["AvpWRgjbjjVvBFnFfcdK"])->hookPayment();
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