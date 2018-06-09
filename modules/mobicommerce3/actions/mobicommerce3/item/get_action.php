<?php
$GLOBALS["rXGEGyhZsqBKYmYtFYzX"]=base64_decode("UFJPRFVDVFNfVklFV0VEX05CUg==");$GLOBALS["lRBzvzBSEQkJxdBItbg"]=base64_decode("LA==");$GLOBALS["BilLmzyrsRvVywvbcbaY"]=base64_decode("cHJvZHVjdF9ub3RfYXZhaWxhYmxl");$GLOBALS["dZflgWRBqhDGhXArjEvY"]=base64_decode("cHJvZHVjdF9kZXRhaWxz");$GLOBALS["qXKFiqnhJPaOZFDNYEMo"]=base64_decode("UHJvZHVjdFRyYW5zbGF0b3I=");$GLOBALS["ksmBVCTZnuQUbdBtBigo"]=base64_decode("cHJvZHVjdF9pZA==");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"]))
{
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}

class mobicommerce3_item_get_action extends BaseAction
{
    public function execute()
    {
        $productId = (int)$this->getParam($GLOBALS["ksmBVCTZnuQUbdBtBigo"]);
        if($productId)
        {            
            $productTranslator = ServiceFactory::factory($GLOBALS["qXKFiqnhJPaOZFDNYEMo"]);
            $productTranslator->loadProductById($productId);
            $product = $productTranslator->getFullItemInfo();

            if ($product)
            {
                $this->_setProductInCookie($productId);
                $this->setSuccess(array($GLOBALS["dZflgWRBqhDGhXArjEvY"] => $product));
            }
            else
            {
                $this->setError(MobicommerceResult::ERROR_ITEM_INPUT_PARAMETER);
            }
        }
        else
        {
            $this->setError(MobicommerceResult::ERROR_ITEM_INPUT_PARAMETER, $GLOBALS["BilLmzyrsRvVywvbcbaY"]);
        }
    }

    
    protected function _setProductInCookie($id_product)
    {
        $productsViewed = (isset($this->context->cookie->viewed) && !empty($this->context->cookie->viewed)) ? array_slice(array_reverse(explode(',', $this->context->cookie->viewed)), 0, Configuration::get($GLOBALS["rXGEGyhZsqBKYmYtFYzX"])) : array();

        if ($id_product && !in_array($id_product, $productsViewed))
        {
            $product = new Product((int)$id_product);
            if ($product->checkAccess((int)$this->context->customer->id))
            {
                if (isset($this->context->cookie->viewed) && !empty($this->context->cookie->viewed))
                    $this->context->cookie->viewed .= $GLOBALS["lRBzvzBSEQkJxdBItbg"].(int)$id_product;
                else
                    $this->context->cookie->viewed = (int)$id_product;
            }
        }
    }
}
 ?>