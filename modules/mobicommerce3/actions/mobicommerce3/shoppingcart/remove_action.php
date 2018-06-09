<?php
$GLOBALS["FeNylpHCwQIWjEGLfuSb"]=base64_decode("dmVyc2lvbl9zdXBwb3J0");$GLOBALS["zyCDQPaTqgmxkQFUGvGF"]=base64_decode("Y2FydF9kZXRhaWxz");$GLOBALS["ksmBVCTZnuQUbdBtBigo"]=base64_decode("cHJvZHVjdF9pZA==");$GLOBALS["GtOgKXexOHjqDLTWvQjV"]=base64_decode("bWluaW1hbF9xdWFudGl0eQ==");$GLOBALS["ahSttejFzcuTRHYoOtXb"]=base64_decode("aWRfcHJvZHVjdF9hdHRyaWJ1dGU=");$GLOBALS["ktwCrReEJlzuBUIjBcCk"]=base64_decode("Og==");$GLOBALS["hqzNeHAWOwqfUZHIwuEa"]=base64_decode("aWRfcHJvZHVjdA==");$GLOBALS["clDBUEZYNUFAaVDeeJcN"]=base64_decode("U2hvcHBpbmdDYXJ0");$GLOBALS["RFmqqIQVOtzXdusNLvhq"]=base64_decode("Y2FydCBpdGVtIGlkIGlzIG5vdCBzcGVjaWZpZWQgLg==");$GLOBALS["uVuEDCLjTSQjNtEpPTGN"]=base64_decode("aXRlbXM=");$GLOBALS["AdSKntICBqGkMHNEzGDl"]=base64_decode("aXRlbV9pZA==");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"]))
{
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}

class mobicommerce3_shoppingcart_remove_action extends BaseAction
{
    public function validate()
    {
        if (!parent::validate()) {
            return false;
        }

        $item_id = $this->getParam($GLOBALS["AdSKntICBqGkMHNEzGDl"]);
        $items = $this->getParam($GLOBALS["uVuEDCLjTSQjNtEpPTGN"]);
        if (empty($item_id) && empty($items))
        {
            $this->setError(MobicommerceResult::ERROR_CART_INPUT_PARAMETER, $GLOBALS["RFmqqIQVOtzXdusNLvhq"]);
            return false;
        }
        return true;
    }

    public function execute()
    {
        $items = Tools::getValue($GLOBALS["uVuEDCLjTSQjNtEpPTGN"]);
        $cartService = ServiceFactory::factory($GLOBALS["clDBUEZYNUFAaVDeeJcN"]);
        if($items)
        {
            foreach($items as $_item)
            {
                $cartService->remove($_item);
            }
        }
        else
        {
            $item_id = $this->getParam($GLOBALS["AdSKntICBqGkMHNEzGDl"]);
            $products = $this->context->cart->getProducts();
            foreach($products as $_product)
            {
                $_item_id = $_product[$GLOBALS["hqzNeHAWOwqfUZHIwuEa"]] . $GLOBALS["ktwCrReEJlzuBUIjBcCk"] . $_product[$GLOBALS["ahSttejFzcuTRHYoOtXb"]] . $GLOBALS["ktwCrReEJlzuBUIjBcCk"] . $_product[$GLOBALS["GtOgKXexOHjqDLTWvQjV"]];
                if($_item_id == $_item_id)
                {
                    $info[$GLOBALS["ksmBVCTZnuQUbdBtBigo"]] = $_product[$GLOBALS["hqzNeHAWOwqfUZHIwuEa"]];
                }
            }
            $cartService->remove($item_id);
        }
        $info = array();

        $info['cart_details'] = ServiceFactory::factory('ShoppingCart')->get();
        $info[$GLOBALS["FeNylpHCwQIWjEGLfuSb"]] = true;
        $this->setSuccess($info);
    }
}
 ?>