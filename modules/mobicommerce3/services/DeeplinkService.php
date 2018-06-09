<?php
$GLOBALS["hLirtXHcIyglOKPRXPIY"]=base64_decode("dW5rbm93bg==");$GLOBALS["PajHvetMlMXmuKnYAiEz"]=base64_decode("Y21z");$GLOBALS["JsFYeyFOxOwdZGwabyVb"]=base64_decode("aWRfY21z");$GLOBALS["sxVALmpUOyAaYsrTXikR"]=base64_decode("Y2F0ZWdvcnk=");$GLOBALS["QVWFuLyKVyGmMRnfrqPG"]=base64_decode("aWRfY2F0ZWdvcnk=");$GLOBALS["hqzNeHAWOwqfUZHIwuEa"]=base64_decode("aWRfcHJvZHVjdA==");$GLOBALS["SiRSACHoXsTIZeRmGmwq"]=base64_decode("aWQ=");$GLOBALS["CAOACLMUkrZqQKOxxqTw"]=base64_decode("cHJvZHVjdA==");$GLOBALS["kqpjokinrNKzMlmecrBs"]=base64_decode("dHlwZQ==");$GLOBALS["dOysSGnOOHoIQKJgUOYa"]=base64_decode("cmVzcG9uc2U=");$GLOBALS["kZnTCBdSHDvtMTIgANFV"]=base64_decode("QVND");$GLOBALS["BoWuBfavKqJxeLgCuLA"]=base64_decode("bmFtZQ==");$GLOBALS["XKyBYBvMxlbmlzlaRKQ"]=base64_decode("MTkyLjE2OC4wLjEzNw==");$GLOBALS["KEBGDwwizDIjbFRZEXat"]=base64_decode("bG9jYWxob3N0LmNvbQ==");$GLOBALS["TOKCYBEaPbdBQKiAAEYr"]=base64_decode("dXJs");$GLOBALS["vnikmTnwHXDcKJBQNHoK"]=base64_decode("TW9iaWNvbW1lcmNlaGVscGVy");
?><?php




class DeeplinkService extends BaseService
{
    public function __construct()
    {
        parent::__construct();
        ServiceFactory::factory($GLOBALS["vnikmTnwHXDcKJBQNHoK"])->autoLoginMobileUser();
    }

    public function getDeeplinkData()
    {
        $result = array();
        $found = false;
        $url = Tools::getValue('url');
        $url = str_replace($GLOBALS["KEBGDwwizDIjbFRZEXat"], $GLOBALS["XKyBYBvMxlbmlzlaRKQ"], $url);

        $products = Product::getProducts($this->context->language->id, 1, 5000, $GLOBALS["BoWuBfavKqJxeLgCuLA"], $GLOBALS["kZnTCBdSHDvtMTIgANFV"]);
        foreach($products as $_product) {
            
            
            $link = new Link();
            if($url == $link->getProductLink($_product))
            {
                $result[$GLOBALS["dOysSGnOOHoIQKJgUOYa"]] = array(
                    'type' => 'product',
                    'id' => $_product['id_product']
                    );
                $found = true;
                break;
            }
        }

        if(!$found)
        {
            $categories = Category::getCategories((int)($this->context->cookie->id_lang), true, false);
            ;
            
            foreach($categories as $_category) {
                $link = new Link();
                if($url == $link->getCategoryLink($_category[$GLOBALS["QVWFuLyKVyGmMRnfrqPG"]]))
                {
                    $result[$GLOBALS["dOysSGnOOHoIQKJgUOYa"]] = array(
                        'type' => 'category',
                        'id' => $_category['id_category']
                        );
                    $found = true;
                    break;
                }
            }
            
        }

        if(!$found)
        {
            $cms = CMS::getCMSPages((int)($this->context->cookie->id_lang), true, false);
            ;
            
            foreach($cms as $_cms) {
                $link = new Link();
                
                if($url == $link->getCMSLink($_cms[$GLOBALS["JsFYeyFOxOwdZGwabyVb"]]))
                {
                    $result[$GLOBALS["dOysSGnOOHoIQKJgUOYa"]] = array(
                        'type' => 'cms',
                        'id' => $_cms['id_cms']
                        );
                    $found = true;
                    break;
                }
            }
            
        }

        if(!$found)
        {
            $result[$GLOBALS["dOysSGnOOHoIQKJgUOYa"]] = array(
                'type' => 'unknown',
                'id' => false
                );
        }
        
        return $result;
        
    }
}
 ?>