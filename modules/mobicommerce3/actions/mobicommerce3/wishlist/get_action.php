<?php
$GLOBALS["seOINWtCkkdfNKliivwt"]=base64_decode("d2lzaGxpc3Q=");$GLOBALS["clDBUEZYNUFAaVDeeJcN"]=base64_decode("U2hvcHBpbmdDYXJ0");$GLOBALS["zyCDQPaTqgmxkQFUGvGF"]=base64_decode("Y2FydF9kZXRhaWxz");$GLOBALS["iovnsSfSfLlsBlMvREvS"]=base64_decode("cXR5");$GLOBALS["ksmBVCTZnuQUbdBtBigo"]=base64_decode("cHJvZHVjdF9pZA==");$GLOBALS["QneGYTxdSJLrPFYSspJC"]=base64_decode("d2lzaGxpc3RfaXRlbV9pZA==");$GLOBALS["qXKFiqnhJPaOZFDNYEMo"]=base64_decode("UHJvZHVjdFRyYW5zbGF0b3I=");$GLOBALS["lRBzvzBSEQkJxdBItbg"]=base64_decode("LA==");$GLOBALS["tugkmwKQmrdyfghQnRJj"]=base64_decode("");$GLOBALS["jlzbPBaNoJyhKfLDckJK"]=base64_decode("aWRz");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"])) {
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}

class mobicommerce3_wishlist_get_action extends BaseAction
{
    public function execute()
    {    
        $ids = is_null($this->getParam($GLOBALS["jlzbPBaNoJyhKfLDckJK"])) ? $GLOBALS["tugkmwKQmrdyfghQnRJj"] : trim($this->getParam($GLOBALS["jlzbPBaNoJyhKfLDckJK"]));
        $ids = array_filter(explode(',', $ids));
        $finalProductArray = array();
        if(!empty($ids))
        {
            foreach($ids as $_id)
            {
                $productTranslator = ServiceFactory::factory($GLOBALS["qXKFiqnhJPaOZFDNYEMo"]);
                $productTranslator->loadProductById($_id);
                                $_product = $productTranslator->getFullItemInfo();
                $_product[$GLOBALS["QneGYTxdSJLrPFYSspJC"]] = $_product[$GLOBALS["ksmBVCTZnuQUbdBtBigo"]];
                $_product[$GLOBALS["iovnsSfSfLlsBlMvREvS"]] = 1;
                $finalProductArray[$_id] = $_product;
            }
        }
        $finalProductArray = array_values($finalProductArray);
		$this->setSuccess(array(
            $GLOBALS["zyCDQPaTqgmxkQFUGvGF"] => ServiceFactory::factory($GLOBALS["clDBUEZYNUFAaVDeeJcN"])->get(),
            $GLOBALS["seOINWtCkkdfNKliivwt"] => $finalProductArray
            ));
    }
}
 ?>