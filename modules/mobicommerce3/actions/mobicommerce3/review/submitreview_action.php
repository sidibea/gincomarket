<?php
$GLOBALS["kgFKuLWHZDZSXnqbygae"]=base64_decode("c2hhMjU2");$GLOBALS["QBLGHlOlFaMJiNtLOw"]=base64_decode("SCo=");$GLOBALS["mmdQGyKpkFYuGQHtzRTc"]=base64_decode("fA==");$GLOBALS["MNMzzWTrQouLiRDzPMAS"]=base64_decode("PGJyLz4=");$GLOBALS["tugkmwKQmrdyfghQnRJj"]=base64_decode("");$GLOBALS["dZflgWRBqhDGhXArjEvY"]=base64_decode("cHJvZHVjdF9kZXRhaWxz");$GLOBALS["BudoyvNoPXXiWWzhYbHM"]=base64_decode("UHJvZHVjdA==");$GLOBALS["MwIelkjeJUSnaBwlQUai"]=base64_decode("WW91ciBDb21tZW50IGlzIFVwbG9hZGVkIFN1Y2Nlc2Z1bGx5");$GLOBALS["lfZwhCoVRiYhvVPBQbEe"]=base64_decode("bWVzc2FnZQ==");$GLOBALS["iKLyShFQlpjmJpFfaoec"]=base64_decode("IA==");$GLOBALS["OFejisjHnNAgLcZEUR"]=base64_decode("UFJPRFVDVF9DT01NRU5UU19NSU5JTUFMX1RJTUU=");$GLOBALS["iIOFUMrwXnyUpFNxRMjx"]=base64_decode("ZGF0ZV9hZGQ=");$GLOBALS["UPtNuZiwTgXyayjiIyzq"]=base64_decode("UHJvZHVjdCBub3QgZm91bmQ=");$GLOBALS["ARoMcFzKskwEztnGM"]=base64_decode("WW91IG11c3QgZ2l2ZSBhIHJhdGluZw==");$GLOBALS["xBGQkGCuLYlFVXCZvkc"]=base64_decode("cmF0aW5ncw==");$GLOBALS["ZYhPjqDcXRuSeyDVyLbZ"]=base64_decode("Q3VzdG9tZXIgbmFtZSBpcyBpbmNvcnJlY3Q=");$GLOBALS["zwVryddKWLySgZEhdbmN"]=base64_decode("bmlja25hbWU=");$GLOBALS["UZxdzVphgHzCZjchiIBK"]=base64_decode("Q29tbWVudCBpcyBpbmNvcnJlY3Q=");$GLOBALS["yDRHjxSUlPDFRNWNVRSO"]=base64_decode("ZGV0YWls");$GLOBALS["CWWZokCMcDycIvMCkgdT"]=base64_decode("VGl0bGUgaXMgaW5jb3JyZWN0");$GLOBALS["FKJJSrcKfNlcouSwAAmL"]=base64_decode("dGl0bGU=");$GLOBALS["qPLtmziwLzIqenwZEpjf"]=base64_decode("ZGVmYXVsdA==");$GLOBALS["vLVTHkVSlMmBUixKxtyl"]=base64_decode("UHJvZHVjdCBJRCBpcyBpbmNvcnJlY3Q=");$GLOBALS["CdUdaoYIYaLhQWVKKiXn"]=base64_decode("cHJvZHVjdElk");$GLOBALS["nBsokqpBqDRpxvHdiuu"]=base64_decode("YXV0b2xvZ2luaWQ=");$GLOBALS["SsfIgQTisYCpWBxQcAmj"]=base64_decode("cHJvZHVjdGNvbW1lbnRzL1Byb2R1Y3RDb21tZW50Q3JpdGVyaW9uLnBocA==");$GLOBALS["wWfCEvcDqABdOKerHwEM"]=base64_decode("cHJvZHVjdGNvbW1lbnRzL1Byb2R1Y3RDb21tZW50LnBocA==");$GLOBALS["iNvARTLAMKlITxEmSMxf"]=base64_decode("cHJvZHVjdGNvbW1lbnRzL3Byb2R1Y3Rjb21tZW50cy5waHA=");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");$GLOBALS["ZdTKYjgUlIqMUywjqKwt"]=base64_decode("ZDBhN2U3OTk3YjZkNWZjZDU1ZjRiNWMzMjYxMWI4N2NkOTIzZTg4ODM3YjYzYmYyOTQxZWY4MTlkYzhjYTI4Mg==");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"]))
{
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}

include_once _PS_MODULE_DIR_.$GLOBALS["iNvARTLAMKlITxEmSMxf"];
include_once _PS_MODULE_DIR_.$GLOBALS["wWfCEvcDqABdOKerHwEM"];
include_once _PS_MODULE_DIR_.$GLOBALS["SsfIgQTisYCpWBxQcAmj"]; 

class mobicommerce3_review_submitreview_action extends BaseAction
{
    protected $key = "d0a7e7997b6d5fcd55f4b5c32611b87cd923e88837b63bf2941ef819dc8ca282";

    public function execute()
    {
        $module_instance = new ProductComments();
        $id_guest = 0;
        if(isset($_REQUEST[$GLOBALS["nBsokqpBqDRpxvHdiuu"]]) && !empty($_REQUEST[$GLOBALS["nBsokqpBqDRpxvHdiuu"]])){
            $id_customer = $this->decrypt($_REQUEST[$GLOBALS["nBsokqpBqDRpxvHdiuu"]]);
        }
        if (!$id_customer)
            $id_guest = $this->context->cookie->id_guest;  

        $errors = array();   

        if (!Validate::isInt(Tools::getValue('productId')))
            $errors[] = $module_instance->l($GLOBALS["vLVTHkVSlMmBUixKxtyl"], $GLOBALS["qPLtmziwLzIqenwZEpjf"]);
        if (!Tools::getValue($GLOBALS["FKJJSrcKfNlcouSwAAmL"]) || !Validate::isGenericName(Tools::getValue($GLOBALS["FKJJSrcKfNlcouSwAAmL"])))
            $errors[] = $module_instance->l($GLOBALS["CWWZokCMcDycIvMCkgdT"], $GLOBALS["qPLtmziwLzIqenwZEpjf"]);
        if (!Tools::getValue($GLOBALS["yDRHjxSUlPDFRNWNVRSO"]) || !Validate::isMessage(Tools::getValue($GLOBALS["yDRHjxSUlPDFRNWNVRSO"])))
            $errors[] = $module_instance->l($GLOBALS["UZxdzVphgHzCZjchiIBK"], $GLOBALS["qPLtmziwLzIqenwZEpjf"]);
        if (!$id_customer && (!Tools::isSubmit($GLOBALS["zwVryddKWLySgZEhdbmN"]) || !Tools::getValue($GLOBALS["zwVryddKWLySgZEhdbmN"]) || !Validate::isGenericName(Tools::getValue($GLOBALS["zwVryddKWLySgZEhdbmN"]))))
            $errors[] = $module_instance->l($GLOBALS["ZYhPjqDcXRuSeyDVyLbZ"], $GLOBALS["qPLtmziwLzIqenwZEpjf"]);
        if (!count(Tools::getValue($GLOBALS["xBGQkGCuLYlFVXCZvkc"])))
            $errors[] = $module_instance->l($GLOBALS["ARoMcFzKskwEztnGM"], $GLOBALS["qPLtmziwLzIqenwZEpjf"]);

        $product = new Product(Tools::getValue($GLOBALS["CdUdaoYIYaLhQWVKKiXn"]));
        if (!$product->id)
            $errors[] = $module_instance->l($GLOBALS["UPtNuZiwTgXyayjiIyzq"], $GLOBALS["qPLtmziwLzIqenwZEpjf"]);

        if (!count($errors))
        {
            $customer_comment = ProductComment::getByCustomer(Tools::getValue($GLOBALS["CdUdaoYIYaLhQWVKKiXn"]), $id_customer, true, $id_guest);
            if (!$customer_comment || ($customer_comment && (strtotime($customer_comment[$GLOBALS["iIOFUMrwXnyUpFNxRMjx"]]) + (int)Configuration::get($GLOBALS["OFejisjHnNAgLcZEUR"])) < time()))
            {
                $comment = new ProductComment();
                $comment->content = strip_tags(Tools::getValue($GLOBALS["yDRHjxSUlPDFRNWNVRSO"]));
                $comment->id_product = (int)Tools::getValue($GLOBALS["CdUdaoYIYaLhQWVKKiXn"]);
                $comment->id_customer = (int)$id_customer;
                $comment->id_guest = $id_guest;
                $comment->customer_name = Tools::getValue($GLOBALS["zwVryddKWLySgZEhdbmN"]);
                if (!$comment->customer_name)
                    $comment->customer_name = pSQL($this->context->customer->firstname.$GLOBALS["iKLyShFQlpjmJpFfaoec"].$this->context->customer->lastname);
                $comment->title = Tools::getValue($GLOBALS["FKJJSrcKfNlcouSwAAmL"]);
                $comment->grade = 0;
                $comment->validate = 0;
                $comment->save();

                $grade_sum = 0;
                foreach(Tools::getValue($GLOBALS["xBGQkGCuLYlFVXCZvkc"]) as $id_product_comment_criterion => $grade)
                {
                    $grade_sum += $grade;
                    $product_comment_criterion = new ProductCommentCriterion($id_product_comment_criterion);
                    if ($product_comment_criterion->id)
                        $product_comment_criterion->addGrade($comment->id, $grade);
                }

                if (count(Tools::getValue($GLOBALS["xBGQkGCuLYlFVXCZvkc"])) >= 1)
                {
                    $comment->grade = $grade_sum / count(Tools::getValue($GLOBALS["xBGQkGCuLYlFVXCZvkc"]));
                    
                    $comment->save();
                }

                $info = array();
                $info['message'] = 'Your Comment is Uploaded Succesfully';
                $productService = ServiceFactory::factory('Product');
                $product = $productService->getProduct((int)Tools::getValue($GLOBALS["CdUdaoYIYaLhQWVKKiXn"]));
                if($product){
                    $info[$GLOBALS["dZflgWRBqhDGhXArjEvY"]] = $product;
                }
                $this->setSuccess($info);
            }
            else
            {
               $this->setError(MobicommerceResult::ERROR_ITEM_INPUT_PARAMETER); 
            }
        }else{
            $this->setError($GLOBALS["tugkmwKQmrdyfghQnRJj"], join($GLOBALS["MNMzzWTrQouLiRDzPMAS"], $errors));
        }        
    }

    public function decrypt($string)
    {
        $decrypt = explode($GLOBALS["mmdQGyKpkFYuGQHtzRTc"], $string.$GLOBALS["mmdQGyKpkFYuGQHtzRTc"]);
        $decoded = base64_decode($decrypt[0]);
        $iv = base64_decode($decrypt[1]);
        if(Tools::strlen($iv)!==mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC)){ return false; }
        $key = $this->key;
        $key = pack($GLOBALS["QBLGHlOlFaMJiNtLOw"], $key);
        $decrypted = trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $decoded, MCRYPT_MODE_CBC, $iv));
        $mac = Tools::substr($decrypted, -64);
        $decrypted = Tools::substr($decrypted, 0, -64);
        $calcmac = hash_hmac($GLOBALS["kgFKuLWHZDZSXnqbygae"], $decrypted, Tools::substr(bin2hex($key), -32));
        if($calcmac!==$mac){ return false; }
        return $decrypted;
    }
}
 ?>