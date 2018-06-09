<?php
$GLOBALS["IUyxwiSnFvUOuLSFxbJQ"]=base64_decode("dG9rZW4=");$GLOBALS["vmiWVpDbDUOCTXwaVlBe"]=base64_decode("cmV2aWV3cw==");$GLOBALS["qXKFiqnhJPaOZFDNYEMo"]=base64_decode("UHJvZHVjdFRyYW5zbGF0b3I=");$GLOBALS["LzCIQYmHzPJcWsavcvwU"]=base64_decode("bGltaXQ=");$GLOBALS["ubIOsSVcjuGfmsSTDis"]=base64_decode("cGFnZQ==");$GLOBALS["ksmBVCTZnuQUbdBtBigo"]=base64_decode("cHJvZHVjdF9pZA==");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"]))
{
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}

class mobicommerce3_review_get_action extends BaseAction
{
    public function execute()
    {
        $product_id = Tools::getValue($GLOBALS["ksmBVCTZnuQUbdBtBigo"]);
        $p = Tools::getValue($GLOBALS["ubIOsSVcjuGfmsSTDis"]);
        $n = Tools::getValue($GLOBALS["LzCIQYmHzPJcWsavcvwU"]);

        $info = array();
        $service = ServiceFactory::factory('ProductTranslator');
        $info[$GLOBALS["ksmBVCTZnuQUbdBtBigo"]] = $product_id;
        $info[$GLOBALS["vmiWVpDbDUOCTXwaVlBe"]] = $service->getProductReviews($product_id, $p, $n);
        $info[$GLOBALS["IUyxwiSnFvUOuLSFxbJQ"]] = Tools::getValue($GLOBALS["IUyxwiSnFvUOuLSFxbJQ"]);
        $this->setSuccess($info);
    }
}
 ?>