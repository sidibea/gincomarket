<?php
$GLOBALS["rXGEGyhZsqBKYmYtFYzX"]=base64_decode("UFJPRFVDVFNfVklFV0VEX05CUg==");$GLOBALS["lRBzvzBSEQkJxdBItbg"]=base64_decode("LA==");$GLOBALS["JCJQzsgzRRWKPRXkzvcI"]=base64_decode("ZXh0ZXJuYWxfdXJs");$GLOBALS["EKgfhpvQnjvyxdnwNsFs"]=base64_decode("TW9iaWNvbW1lcmNl");$GLOBALS["yDRHjxSUlPDFRNWNVRSO"]=base64_decode("ZGV0YWls");$GLOBALS["PajHvetMlMXmuKnYAiEz"]=base64_decode("Y21z");$GLOBALS["JsFYeyFOxOwdZGwabyVb"]=base64_decode("aWRfY21z");$GLOBALS["gMAGOuAPSosnlhAsWixi"]=base64_decode("Q2F0ZWdvcnk=");$GLOBALS["nDEJLLgmYTqibpsduIYl"]=base64_decode("Y2F0ZWdvcmllcw==");$GLOBALS["sxVALmpUOyAaYsrTXikR"]=base64_decode("Y2F0ZWdvcnk=");$GLOBALS["QVWFuLyKVyGmMRnfrqPG"]=base64_decode("aWRfY2F0ZWdvcnk=");$GLOBALS["BudoyvNoPXXiWWzhYbHM"]=base64_decode("UHJvZHVjdA==");$GLOBALS["dZflgWRBqhDGhXArjEvY"]=base64_decode("cHJvZHVjdF9kZXRhaWxz");$GLOBALS["hqzNeHAWOwqfUZHIwuEa"]=base64_decode("aWRfcHJvZHVjdA==");$GLOBALS["SiRSACHoXsTIZeRmGmwq"]=base64_decode("aWQ=");$GLOBALS["CAOACLMUkrZqQKOxxqTw"]=base64_decode("cHJvZHVjdA==");$GLOBALS["kqpjokinrNKzMlmecrBs"]=base64_decode("dHlwZQ==");$GLOBALS["kZnTCBdSHDvtMTIgANFV"]=base64_decode("QVND");$GLOBALS["BoWuBfavKqJxeLgCuLA"]=base64_decode("bmFtZQ==");$GLOBALS["UXgAcnNwhAfUPEofirlQ"]=base64_decode("c2Nhbl92YWx1ZQ==");$GLOBALS["vnikmTnwHXDcKJBQNHoK"]=base64_decode("TW9iaWNvbW1lcmNlaGVscGVy");
?><?php




class UrlscanService extends BaseService {

    public function __construct() {
        parent::__construct();
        ServiceFactory::factory($GLOBALS["vnikmTnwHXDcKJBQNHoK"])->autoLoginMobileUser();
    }

    public function getScanInfo() {
        $url = trim(Tools::getValue($GLOBALS["UXgAcnNwhAfUPEofirlQ"]));
        $found = false;
        if (empty($url)) {
            return false;
        }
        $info = array();
        $products = Product::getProducts($this->context->language->id, 1, 5000, 'name', 'ASC');
        foreach ($products as $_product) {
            $link = new Link();
            if ($url == $link->getProductLink($_product)) {
                $info = array(
                    'type' => 'product',
                    'id' => $_product['id_product'],
                    'product_details' => ServiceFactory::factory('Product')->getProduct($_product[$GLOBALS["hqzNeHAWOwqfUZHIwuEa"]])
                );
                
                $this->_setProductInCookie($_product[$GLOBALS["hqzNeHAWOwqfUZHIwuEa"]]);
                $found = true;
                break;
            }
        }

        if (!$found) {
            $categories = Category::getCategories((int) ($this->context->cookie->id_lang), true, false);
            foreach ($categories as $_category) {
                $link = new Link();
                if ($url == $link->getCategoryLink($_category[$GLOBALS["QVWFuLyKVyGmMRnfrqPG"]])) {
                    $info = array(
                        'type' => 'category',
                        'id' => $_category['id_category'],
                        'categories' => ServiceFactory::factory('Category')->getCategory($_product[$GLOBALS["QVWFuLyKVyGmMRnfrqPG"]])
                    );
                    
                    $found = true;
                    break;
                }
            }
        }

        if (!$found) {
            $cms = CMS::getCMSPages((int) ($this->context->cookie->id_lang), true, false);

            foreach ($cms as $_cms) {
                $link = new Link();
                
                if ($url == $link->getCMSLink($_cms[$GLOBALS["JsFYeyFOxOwdZGwabyVb"]])) {
                    $info = array(
                        'type' => 'cms',
                        'id' => $_cms['id_cms'],
                        'detail' => ServiceFactory::factory('Mobicommerce')->getCMS($_cms[$GLOBALS["JsFYeyFOxOwdZGwabyVb"]])
                    );
                    
                    $found = true;
                    break;
                }
            }
        }
        
        if (!$found) {
            $isValid = ServiceFactory::factory($GLOBALS["EKgfhpvQnjvyxdnwNsFs"])->validUrl($url);
            if ($isValid) {
                $info = array(
                    'type' => 'external_url',
                    'id' => $url
                );
            }
        }

        return $info;
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