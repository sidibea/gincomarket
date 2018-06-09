<?php
$GLOBALS["GhpnuZzxfHFyhwoiNGgP"]=base64_decode("bm90bG9nZ2Vk");$GLOBALS["alHKmGFEojxrfKbyyvEp"]=base64_decode("Y2FydA==");$GLOBALS["OKCXGUfXJaPBevzxCVDd"]=base64_decode("aW5jbHVkZXMvY2xhc3MtcHdhcHJlc3RhLnBocA==");$GLOBALS["JxnebyjdFidXdVzNqnEb"]=base64_decode("Lw==");$GLOBALS["aZIHsUFGTJssaQVrLHJP"]=base64_decode("L3B3YXByZXN0YS5waHA=");$GLOBALS["mThQqurtkiAXseWDXydh"]=base64_decode("UFdBX01PRFVMRV9ESVI=");$GLOBALS["dfJOBcbGFSiTDSjAEhmC"]=base64_decode("bG9nZ2VlZA==");$GLOBALS["FuwKxWRVfLkBuAtJmLpa"]=base64_decode("UFdBUFJFU1RBX1BXQVBSRVNUQV9CVE5fU0hPVw==");$GLOBALS["lGqHdRJFfGguNjIuOAZl"]=base64_decode("UFdBUFJFU1RBX1BXQVBSRVNUQV9TSE9XX0NBUlRfQlVUVE9O");$GLOBALS["KWaOERQdMpWmuscXdagn"]=base64_decode("UFdBUFJFU1RBX1BXQVBSRVNUQV9FTkFCTEU=");$GLOBALS["FFIIXJrqGHnFeoTrOo"]=base64_decode("L21vZHVsZXMvcHdhcHJlc3Rh");$GLOBALS["tugkmwKQmrdyfghQnRJj"]=base64_decode("");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"]))
{
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}

class mobicommerce3_payments_paywithamazon_redirect_action extends BaseAction
{
    public function execute()
    {
    	$this->hookDisplayShoppingCart();
        exit;
    }

    public function hookDisplayShoppingCart()
    {
        $str = $GLOBALS["tugkmwKQmrdyfghQnRJj"];
        $_dir = _PS_ROOT_DIR_.$GLOBALS["FFIIXJrqGHnFeoTrOo"];
        
        $context = Context::getContext();
        
        if ( Configuration::get($GLOBALS["KWaOERQdMpWmuscXdagn"]) )
        { 
            if( Configuration::get($GLOBALS["lGqHdRJFfGguNjIuOAZl"]) )            
            {
                if( Configuration::get($GLOBALS["FuwKxWRVfLkBuAtJmLpa"]) == $GLOBALS["dfJOBcbGFSiTDSjAEhmC"] && $context->customer->isLogged())
                {
                    if ( ! defined( $GLOBALS["mThQqurtkiAXseWDXydh"] ) ) {
                        define( $GLOBALS["mThQqurtkiAXseWDXydh"] , dirname($_dir.$GLOBALS["aZIHsUFGTJssaQVrLHJP"]));
                    }
                    include_once( $_dir.$GLOBALS["JxnebyjdFidXdVzNqnEb"].$GLOBALS["OKCXGUfXJaPBevzxCVDd"] );
                    $cba = new PWA_Cba();   
                    $str = $cba->pay_with_amazon_button($GLOBALS["alHKmGFEojxrfKbyyvEp"]);
                }
        
                if( Configuration::get($GLOBALS["FuwKxWRVfLkBuAtJmLpa"]) == $GLOBALS["GhpnuZzxfHFyhwoiNGgP"])
                {
                    if ( ! defined( $GLOBALS["mThQqurtkiAXseWDXydh"] ) ) {
                        define( $GLOBALS["mThQqurtkiAXseWDXydh"] , dirname($_dir.$GLOBALS["aZIHsUFGTJssaQVrLHJP"]));
                    }
                    include_once( $_dir.$GLOBALS["JxnebyjdFidXdVzNqnEb"].$GLOBALS["OKCXGUfXJaPBevzxCVDd"] );
                    $cba = new PWA_Cba();   
                    $str = $cba->pay_with_amazon_button($GLOBALS["alHKmGFEojxrfKbyyvEp"]);
                }
            }
        }
        ?>
        <div style="display:none">
            <?php
            echo $str;
            ?>
        </div>
        <script>
        setTimeout(function(){
            document.images[0].click();
        }, 1000);
        </script>
        <?php
    }
}
 ?>