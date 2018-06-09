<?php
$GLOBALS["lRBzvzBSEQkJxdBItbg"]=base64_decode("LA==");$GLOBALS["VJrqUxlwESnFpVzufJds"]=base64_decode("bWVzc2FnZXM=");$GLOBALS["zyCDQPaTqgmxkQFUGvGF"]=base64_decode("Y2FydF9kZXRhaWxz");$GLOBALS["eUylfkwBEWhOVckStqUE"]=base64_decode("TWluaW11bSBxdWFudGl0eQ==");$GLOBALS["iKLyShFQlpjmJpFfaoec"]=base64_decode("IA==");$GLOBALS["UwrkWUMETaJnSGqaEXiM"]=base64_decode("WW91IG11c3QgYWRk");$GLOBALS["zuxMYwjEDeCbtNrRMbQU"]=base64_decode("VGhlcmUgaXNuJ3QgZW5vdWdoIHByb2R1Y3QgaW4gc3RvY2su");$GLOBALS["IrBxOfiEhkqrYQzjbJZa"]=base64_decode("VGhpcyBwcm9kdWN0IGlzIG5vIGxvbmdlciBhdmFpbGFibGUu");$GLOBALS["clDBUEZYNUFAaVDeeJcN"]=base64_decode("U2hvcHBpbmdDYXJ0");$GLOBALS["ldPLCYFzuGbSrEaUxqLc"]=base64_decode("aXBh");$GLOBALS["qXKFiqnhJPaOZFDNYEMo"]=base64_decode("UHJvZHVjdFRyYW5zbGF0b3I=");$GLOBALS["EcaVCaBpiURiLvayrnmh"]=base64_decode("YXR0cmlidXRlcw==");$GLOBALS["DyNctKMKCTXIUdvBtWna"]=base64_decode("SW5jb3JyZWN0IG51bWJlciBvZiBwcm9kdWN0Lg==");$GLOBALS["CYPeIDBbRAnzHwqcRjyR"]=base64_decode("SXRlbSBpZCBpcyBub3Qgc3BlY2lmaWVkIC4=");$GLOBALS["iovnsSfSfLlsBlMvREvS"]=base64_decode("cXR5");$GLOBALS["CAOACLMUkrZqQKOxxqTw"]=base64_decode("cHJvZHVjdA==");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"]))
{
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}

class mobicommerce3_shoppingcart_add_action extends BaseAction
{
    public function validate()
    {
        if (!parent::validate())
        {
            return false;
        }
        $itemId = $this->getParam($GLOBALS["CAOACLMUkrZqQKOxxqTw"]);
        $qty = $this->getParam($GLOBALS["iovnsSfSfLlsBlMvREvS"]);

        if (!isset($itemId))
        {
            $errMesg = $GLOBALS["CYPeIDBbRAnzHwqcRjyR"];
        }
        if (!is_numeric($qty) || (int)$qty <= 0)
        {
            $errMesg = $GLOBALS["DyNctKMKCTXIUdvBtWna"];
        }

        if ($errMesg)
        {
            $this->setError(MobicommerceResult::ERROR_CART_INPUT_PARAMETER, $errMesg);
            return false;
        }
        return true;
    }

    public function execute()
    {
        $itemId = $this->getParam($GLOBALS["CAOACLMUkrZqQKOxxqTw"]);
        $qty = $this->getParam($GLOBALS["iovnsSfSfLlsBlMvREvS"]);
      
        $attributes = $_REQUEST[$GLOBALS["EcaVCaBpiURiLvayrnmh"]];
        $option = array();
        $errMesg = array();
        if ($attributes) {
            foreach ($attributes as $attribute_id => $attribute_value) {
                $optionId = $attribute_id;
                $option[$optionId] = $attribute_value;
            }
        }
        
        $producToAdd = new Product($itemId, true, $this->context->cookie->id_lang);
        $productTranslator = ServiceFactory::factory($GLOBALS["qXKFiqnhJPaOZFDNYEMo"]);
        $ipa = Tools::getValue($GLOBALS["ldPLCYFzuGbSrEaUxqLc"]);
        if($ipa)
        {
            $idProductAttribute = $ipa;
        }
        else
        {
            $idProductAttribute = $productTranslator->getIdProductAttribut($option, $itemId);
        }

                $cartService = ServiceFactory::factory($GLOBALS["clDBUEZYNUFAaVDeeJcN"]);

        if(!$producToAdd->id OR !$producToAdd->active)
        {
            $errMesg[] = Tools::displayError($GLOBALS["IrBxOfiEhkqrYQzjbJZa"], false);
        }
        else
        {
            if (!$producToAdd->isAvailableWhenOutOfStock($producToAdd->out_of_stock) && $producToAdd->hasAttributes() && !Attribute::checkAttributeQty($idProductAttribute, $qty))
            {
                $errMesg[] = Tools::displayError($GLOBALS["zuxMYwjEDeCbtNrRMbQU"], false);
            }
            
            $addResult = $cartService->add($itemId, $idProductAttribute, (int)$qty);
            if ($addResult < 0 && empty($errMesg))
            {
                $errMesg[] = Tools::displayError($GLOBALS["UwrkWUMETaJnSGqaEXiM"], false) . $GLOBALS["iKLyShFQlpjmJpFfaoec"] . $producToAdd->minimal_quantity . $GLOBALS["iKLyShFQlpjmJpFfaoec"] . Tools::displayError($GLOBALS["eUylfkwBEWhOVckStqUE"], false);
            }
            if (!$addResult && empty($errMesg))
            {
                                $errMesg[] = Tools::displayError($GLOBALS["zuxMYwjEDeCbtNrRMbQU"], false);
            }
        }

        $info = array();
        $info['cart_details'] = $cartService->get();
        $info['messages'] = $errMesg;
        if(empty($errMesg))
        {
            $this->setSuccess($info);
        }
        else
        {
            $this->setError(MobicommerceResult::ERROR_ITEM_INPUT_PARAMETER, implode($GLOBALS["lRBzvzBSEQkJxdBItbg"], $errMesg));
        }
    }
}
 ?>