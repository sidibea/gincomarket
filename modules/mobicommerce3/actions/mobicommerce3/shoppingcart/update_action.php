<?php
$GLOBALS["VJrqUxlwESnFpVzufJds"]=base64_decode("bWVzc2FnZXM=");$GLOBALS["wOKCKXtaNcRsbfflQBCy"]=base64_decode("WW91IGFscmVhZHkgaGF2ZSB0aGUgbWF4aW11bSBxdWFudGl0eSBhdmFpbGFibGUgZm9yIHRoaXMgcHJvZHVjdC4=");$GLOBALS["eUylfkwBEWhOVckStqUE"]=base64_decode("TWluaW11bSBxdWFudGl0eQ==");$GLOBALS["iKLyShFQlpjmJpFfaoec"]=base64_decode("IA==");$GLOBALS["UwrkWUMETaJnSGqaEXiM"]=base64_decode("WW91IG11c3QgYWRk");$GLOBALS["MAnbxYNDXRZrwbOxlvMq"]=base64_decode("VGhlcmUgaXMgbm90IGVub3VnaCBwcm9kdWN0IGluIHN0b2NrLg==");$GLOBALS["clDBUEZYNUFAaVDeeJcN"]=base64_decode("U2hvcHBpbmdDYXJ0");$GLOBALS["XESMLcHgDFIiRMDxNHBT"]=base64_decode("UXR5IGlzIG5vdCB2YWxpZC4=");$GLOBALS["ptCFMzrzamcQNddOihvu"]=base64_decode("Q2FydCBpdGVtIGlkIGlzIG5vdCBzcGVjaWZpZWQgLg==");$GLOBALS["iovnsSfSfLlsBlMvREvS"]=base64_decode("cXR5");$GLOBALS["EVJGDYSswetAxQhqEHXu"]=base64_decode("Y2FydF9pdGVtX2lk");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");$GLOBALS["aNGnNgLXNWhZDmdvmbXe"]=base64_decode("dmVyc2lvbl9zdXBwb3J0");$GLOBALS["MFlPPBWXQThfIlghoqUM"]=base64_decode("Y2FydF9kZXRhaWxz");$GLOBALS["JYNtVdTfHlgJkTOjMvtL"]=base64_decode("Og==");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"]))
{
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}

class mobicommerce3_shoppingcart_update_action extends BaseAction
{
    public function validate()
    {
        if (!parent::validate())
        {
            return false;
        }

        $cartItemId = $this->getParam($GLOBALS["EVJGDYSswetAxQhqEHXu"]);
        $qty = $this->getParam($GLOBALS["iovnsSfSfLlsBlMvREvS"]);
        $validateInfo = array();
        if (!isset($cartItemId))
        {
            $validateInfo[] = $GLOBALS["ptCFMzrzamcQNddOihvu"];
        }
        if (!isset($qty) || !is_numeric($qty) || $qty < 0)
        {
            $validateInfo[] = $GLOBALS["XESMLcHgDFIiRMDxNHBT"];
        }
        if ($validateInfo)
        {
            $this->setError(MobicommerceResult::ERROR_CART_INPUT_PARAMETER, $validateInfo);
            return false;
        }
        return true;
    }

    public function execute()
    {
        $errMesg = array();
        $cartService = ServiceFactory::factory('ShoppingCart');
        $cartItemId = $this->getParam($GLOBALS["EVJGDYSswetAxQhqEHXu"]);
        $qty = (int)$this->getParam($GLOBALS["iovnsSfSfLlsBlMvREvS"]);
        $newCartItemId = explode($GLOBALS["JYNtVdTfHlgJkTOjMvtL"], $cartItemId);
        $itemId = $newCartItemId[0];
        $itemAttr = $newCartItemId[1];
        $minQty = $newCartItemId[2];
        $producToAdd = new Product($itemId, true, $this->context->cookie->id_lang);
        if (!$producToAdd->isAvailableWhenOutOfStock($producToAdd->out_of_stock) && $producToAdd->hasAttributes() && !Attribute::checkAttributeQty($itemAttr, $qty))
        {
            $errMesg[] = Tools::displayError($GLOBALS["MAnbxYNDXRZrwbOxlvMq"]);
        }
        if ($qty < $minQty)
        {
            $errMesg[] = Tools::displayError($GLOBALS["UwrkWUMETaJnSGqaEXiM"], false) . $GLOBALS["iKLyShFQlpjmJpFfaoec"] . $minQty . $GLOBALS["iKLyShFQlpjmJpFfaoec"] . Tools::displayError($GLOBALS["eUylfkwBEWhOVckStqUE"], false);
        }
        
        $updateResult = $cartService->update($cartItemId, $qty);
   
        if (!$updateResult && empty($errMesg))
        {
            $errMesg[] = Tools::displayError($GLOBALS["wOKCKXtaNcRsbfflQBCy"], false);
        }

        $info = $cartService->get();
        $info[$GLOBALS["VJrqUxlwESnFpVzufJds"]] = $errMesg;
        
        $shoppingCartInfo = ServiceFactory::factory($GLOBALS["clDBUEZYNUFAaVDeeJcN"])->get();
        $this->setSuccess(array($GLOBALS["MFlPPBWXQThfIlghoqUM"]=>$shoppingCartInfo,$GLOBALS["aNGnNgLXNWhZDmdvmbXe"]=>true));
    }
}
 ?>