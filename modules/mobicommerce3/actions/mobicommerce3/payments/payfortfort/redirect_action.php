<?php
$GLOBALS["KUZAfyzuVkFVlXzSvhAk"]=base64_decode("Y2FyZF9zZWN1cml0eV9jb2Rl");$GLOBALS["ICOPGIHvZyLJvEpwxIyj"]=base64_decode("ZXhwaXJ5X3llYXI=");$GLOBALS["xFUqPSXlOkIjXcWFfoBT"]=base64_decode("ZXhwaXJ5X2RhdGU=");$GLOBALS["FjQyHPSThmLaetnOcMve"]=base64_decode("Y2FyZF9udW1iZXI=");$GLOBALS["IbNvAWduPotsnOErlrxO"]=base64_decode("Y2FyZF9ob2xkZXJfbmFtZQ==");$GLOBALS["iaYyKRLSQEMMVXOuYDgb"]=base64_decode("c2lnbmF0dXJl");$GLOBALS["hKPYVNgYuEySTzMShfwQ"]=base64_decode("cmV0dXJuX3VybA==");$GLOBALS["WgVjGFlSBfPugFytyuny"]=base64_decode("c2VydmljZV9jb21tYW5k");$GLOBALS["xtWPYDCsrFrJhduFQcNU"]=base64_decode("bGFuZ3VhZ2U=");$GLOBALS["csFmltRkwWXDwDxULLUt"]=base64_decode("bWVyY2hhbnRfcmVmZXJlbmNl");$GLOBALS["iKfakCzgeAEYQmCUiiSg"]=base64_decode("YWNjZXNzX2NvZGU=");$GLOBALS["NNOVKBuDFixninYXkZjs"]=base64_decode("bWVyY2hhbnRfaWRlbnRpZmllcg==");$GLOBALS["VSvOUBmzjINSQLJKfrWn"]=base64_decode("cGFyYW1z");$GLOBALS["TOKCYBEaPbdBQKiAAEYr"]=base64_decode("dXJs");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");$GLOBALS["vGxhsXgPjRgrOGAOTsGi"]=base64_decode("aHR0cHM6Ly93d3cuam9zb29xLmNvbS9pbmRleC5waHA/ZmM9bW9kdWxlJm1vZHVsZT1wYXlmb3J0Zm9ydCZjb250cm9sbGVyPXBheW1lbnQmYWN0aW9uPW1lcmNoYW50UGFnZVJlc3BvbnNl");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"]))
{
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}

class mobicommerce3_payments_payfortfort_redirect_action extends BaseAction
{
    public function execute()
    {
        $url = Tools::getValue($GLOBALS["TOKCYBEaPbdBQKiAAEYr"]);
        $params = Tools::getValue($GLOBALS["VSvOUBmzjINSQLJKfrWn"]);

        $merchant_identifier = Tools::getValue($GLOBALS["NNOVKBuDFixninYXkZjs"]);
        $access_code         = Tools::getValue($GLOBALS["iKfakCzgeAEYQmCUiiSg"]);
        $merchant_reference  = Tools::getValue($GLOBALS["csFmltRkwWXDwDxULLUt"]);
        $language            = Tools::getValue($GLOBALS["xtWPYDCsrFrJhduFQcNU"]);
        $service_command     = Tools::getValue($GLOBALS["WgVjGFlSBfPugFytyuny"]);
        $return_url          = Tools::getValue($GLOBALS["hKPYVNgYuEySTzMShfwQ"]);
        $return_url          = $GLOBALS["vGxhsXgPjRgrOGAOTsGi"];
        $signature           = Tools::getValue($GLOBALS["iaYyKRLSQEMMVXOuYDgb"]);

        $card_holder_name = Tools::getValue($GLOBALS["IbNvAWduPotsnOErlrxO"]);
        $card_number = Tools::getValue($GLOBALS["FjQyHPSThmLaetnOcMve"]);
        $expiry_date = Tools::getValue($GLOBALS["xFUqPSXlOkIjXcWFfoBT"]);
        $expiry_year = Tools::getValue($GLOBALS["ICOPGIHvZyLJvEpwxIyj"]);
        $card_security_code = Tools::getValue($GLOBALS["KUZAfyzuVkFVlXzSvhAk"]);

        $expiry_date = $expiry_year.$expiry_date;
    	?>

        <form method="post" action="<?php echo $url; ?>">
            <input type="hidden" name="merchant_identifier" value="<?php echo $merchant_identifier; ?>" />
            <input type="hidden" name="access_code" value="<?php echo $access_code; ?>" />
            <input type="hidden" name="merchant_reference" value="<?php echo $merchant_reference; ?>" />
            <input type="hidden" name="language" value="<?php echo $language; ?>" />
            <input type="hidden" name="service_command" value="<?php echo $service_command; ?>" />
            <input type="hidden" name="return_url" value="<?php echo $return_url; ?>" />
            <input type="hidden" name="signature" value="<?php echo $signature; ?>" />

            <input type="hidden" name="card_holder_name" value="<?php echo $card_holder_name; ?>" />
            <input type="hidden" name="card_number" value="<?php echo $card_number; ?>" />
            <input type="hidden" name="expiry_date" value="<?php echo $expiry_date; ?>" />
            <input type="hidden" name="card_security_code" value="<?php echo $card_security_code; ?>" />
        </form>
		<script>
			document.forms[0].submit();
		</script>
		<?php
		exit;
    }
}
 ?>