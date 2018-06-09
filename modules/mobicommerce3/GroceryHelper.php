<?php
$GLOBALS["sWCONYouUszQosYnw"]=base64_decode("b3JkZXJfaXRlbXM=");$GLOBALS["YDcyXeFShlzkYFseILIE"]=base64_decode("Z3JvY2VyeV9pdGVtcw==");$GLOBALS["dqQDBZDadhIuRliGvbmw"]=base64_decode("cm93X3RvdGFsX2luY2xfdGF4");$GLOBALS["TLOkvTfNXSCrzIxyhrCE"]=base64_decode("cm93X3RvdGFs");$GLOBALS["njLidmcEqTYJagQxbHZH"]=base64_decode("cXR5X2luY3JlbWVudHM=");$GLOBALS["klBPFxupPIvHrNcNScRh"]=base64_decode("cHJpY2VfaW5jbF90YXg=");$GLOBALS["UxpaPbRXERSOLPwRbRqc"]=base64_decode("bWF4X3F0eQ==");$GLOBALS["aqUqrJfwLwDOVmldngyE"]=base64_decode("ZXJyb3JEZXNjcmlwdGlvbg==");$GLOBALS["KBqBiaEsxDDHtdysZMBq"]=base64_decode("aGFzRXJyb3I=");$GLOBALS["AdSKntICBqGkMHNEzGDl"]=base64_decode("aXRlbV9pZA==");$GLOBALS["ktwCrReEJlzuBUIjBcCk"]=base64_decode("Og==");$GLOBALS["WNObBJvjlfgbtytIZfTq"]=base64_decode("b3B0aW9uX3ZhbHVl");$GLOBALS["usEHohMWxVrEeDLpdojY"]=base64_decode("b3B0aW9uX2RldGFpbHM=");$GLOBALS["eDweEljdhKWRGKvEnM"]=base64_decode("Z3JvY2VyeV9vcHRpb25z");$GLOBALS["uVuEDCLjTSQjNtEpPTGN"]=base64_decode("aXRlbXM=");$GLOBALS["QcnvhCDTXuaYUSlVhWWt"]=base64_decode("b3B0aW9uX3R5cGVfaWQ=");$GLOBALS["MyGfQYdQGWFabnAhbjGR"]=base64_decode("b3B0aW9uX2lk");$GLOBALS["rHWvGnajLMrEqmZHfqbC"]=base64_decode("cGVyY2VudA==");$GLOBALS["gWCAuTgTAORTzilAnBMb"]=base64_decode("Zml4ZWQ=");$GLOBALS["FmcHoLewPGYTTNwZWyku"]=base64_decode("cHJpY2VfdHlwZQ==");$GLOBALS["FtaoUjQYZIwYCvcntNjy"]=base64_decode("c3BlY2lhbF9wcmljZQ==");$GLOBALS["irCwZnlUmpzbYeDrQlmI"]=base64_decode("cHJvZHVjdF9vcHRpb25z");$GLOBALS["qcAqdRoXyOjMSzAvwpOV"]=base64_decode("b3B0aW9ucw==");$GLOBALS["mtniJtSfBUifnYAdTgNC"]=base64_decode("c3RvY2tfc3RhdHVz");$GLOBALS["KEIaVoEwhIoBCMBsuRaf"]=base64_decode("cXVhbnRpdHk=");$GLOBALS["iovnsSfSfLlsBlMvREvS"]=base64_decode("cXR5");$GLOBALS["xEuNZucKDqLNdbfNfI"]=base64_decode("b3VyX3ByaWNl");$GLOBALS["wKBdEguMoAWWAnUKUSiN"]=base64_decode("cHJpY2luZw==");$GLOBALS["IXCfKzsjlitrRiMXFvE"]=base64_decode("cHJpY2U=");$GLOBALS["UAkfTDtQAocYzXZkOs"]=base64_decode("YXR0cmlidXRlc192YWx1ZXM=");$GLOBALS["UErXESVgiXETbMaUsAvm"]=base64_decode("LCA=");$GLOBALS["FKJJSrcKfNlcouSwAAmL"]=base64_decode("dGl0bGU=");$GLOBALS["SqgfHzRoQePauMC"]=base64_decode("XzE=");$GLOBALS["rojWvnbZNAUBRjTQLXdg"]=base64_decode("Xw==");$GLOBALS["BODVXTlCZfXhaFUDBjAW"]=base64_decode("c2ltcGxlX3dpdGhfb3B0aW9ucw==");$GLOBALS["MSKgDnjqGggSrEvmtZQO"]=base64_decode("Y29tYmluYXRpb25z");$GLOBALS["eECQbZOORtIgeNYsLPzg"]=base64_decode("XzBfMQ==");$GLOBALS["ksmBVCTZnuQUbdBtBigo"]=base64_decode("cHJvZHVjdF9pZA==");$GLOBALS["pPZCYftvbIcfKktDOYOo"]=base64_decode("Y29tYmluYXRpb25faWQ=");$GLOBALS["dJLWnUZqJJMnpFGrjgZA"]=base64_decode("c2ltcGxl");$GLOBALS["XZqOYpcRtpUygRwELsRH"]=base64_decode("Z3JvY2VyeV90eXBl");
?><?php

function isGroceryEnabled()
{
    
    return false;
}

function bindProductListingGrocery(&$_product)
{
    if(isGroceryEnabled())
    {
        
        $_product[$GLOBALS["XZqOYpcRtpUygRwELsRH"]] = $GLOBALS["dJLWnUZqJJMnpFGrjgZA"];
        $_product[$GLOBALS["pPZCYftvbIcfKktDOYOo"]] = $_product[$GLOBALS["ksmBVCTZnuQUbdBtBigo"]].$GLOBALS["eECQbZOORtIgeNYsLPzg"];
        if($_product[$GLOBALS["MSKgDnjqGggSrEvmtZQO"]])
        {
            $_product[$GLOBALS["XZqOYpcRtpUygRwELsRH"]] = $GLOBALS["BODVXTlCZfXhaFUDBjAW"];
            $mobi_combination = array();
            foreach($_product['combinations'] as $_combination_key => $_combination)
            {
                $mobi_combination[] = array(
                    'combination_id' => $_product['product_id'].'_'.$_combination_key.'_1',
                    'title'          => implode(', ', $_combination['attributes_values']),
                    $GLOBALS["IXCfKzsjlitrRiMXFvE"]          => $_combination[$GLOBALS["wKBdEguMoAWWAnUKUSiN"]][$GLOBALS["xEuNZucKDqLNdbfNfI"]],
                    $GLOBALS["iovnsSfSfLlsBlMvREvS"]            => $_combination[$GLOBALS["KEIaVoEwhIoBCMBsuRaf"]],
                    $GLOBALS["mtniJtSfBUifnYAdTgNC"]   => $_combination[$GLOBALS["KEIaVoEwhIoBCMBsuRaf"]] ? true : false,
                    );
                

                
            }
        }
        $_product[$GLOBALS["qcAqdRoXyOjMSzAvwpOV"]][$GLOBALS["irCwZnlUmpzbYeDrQlmI"]][0] = array(
            'options' => $mobi_combination
            );
        
        
    }
    return;
}

function bindProductPriceIfZero(&$_product)
{
    if(isGroceryEnabled())
    {
        
        if($_product[$GLOBALS["XZqOYpcRtpUygRwELsRH"]] == $GLOBALS["BODVXTlCZfXhaFUDBjAW"])
        {
            $_base_price = $_product[$GLOBALS["FtaoUjQYZIwYCvcntNjy"]];
            if(!$_base_price) {
                $_base_price = $_product[$GLOBALS["IXCfKzsjlitrRiMXFvE"]];
            }

            $_price_array = array();
            foreach($_product['options']['product_options'] as $options_key => $options)
            {
                foreach($options[$GLOBALS["qcAqdRoXyOjMSzAvwpOV"]] as $_option_key => $_option)
                {
                    $_price = 0;
                    $_option_price = 0;
                    if($_option[$GLOBALS["FmcHoLewPGYTTNwZWyku"]] == $GLOBALS["gWCAuTgTAORTzilAnBMb"])
                    {
                        $_option_price = $_base_price + $_option[$GLOBALS["IXCfKzsjlitrRiMXFvE"]];
                    }
                    else if($_option[$GLOBALS["FmcHoLewPGYTTNwZWyku"]] == $GLOBALS["rHWvGnajLMrEqmZHfqbC"])
                    {
                        $_option_price = $_base_price + ($_base_price * $_option[$GLOBALS["IXCfKzsjlitrRiMXFvE"]] / 100);
                    }

                    $_product[$GLOBALS["qcAqdRoXyOjMSzAvwpOV"]][$GLOBALS["irCwZnlUmpzbYeDrQlmI"]][$options_key][$GLOBALS["qcAqdRoXyOjMSzAvwpOV"]][$_option_key][$GLOBALS["IXCfKzsjlitrRiMXFvE"]] = $_option_price;
                    $_price_array[] = $_option_price;
                }
            }

            $_product[$GLOBALS["IXCfKzsjlitrRiMXFvE"]] = min($_price_array);
            $_product[$GLOBALS["FtaoUjQYZIwYCvcntNjy"]] = $_product[$GLOBALS["IXCfKzsjlitrRiMXFvE"]];
        }
    }
    return;
}

function bindProductDetailGrocery(&$_product, $product)
{
    if(isGroceryEnabled())
    {
        $this->bindProductPriceIfZero($_product);
    }
    return;
}

function arrangeProductOptions($product, $options)
{
    if(isGroceryEnabled())
    {
        $product_id = $product->getId();
        $type = $product->getTypeId();
        switch ($type) {
            case Mage_Catalog_Model_Product_Type::TYPE_SIMPLE:
                if($options[$GLOBALS["irCwZnlUmpzbYeDrQlmI"]])
                {
                    foreach($options[$GLOBALS["irCwZnlUmpzbYeDrQlmI"]] as $simple_option_key => $simple_option)
                    {
                        foreach($simple_option[$GLOBALS["qcAqdRoXyOjMSzAvwpOV"]] as $option_key => $option)
                        {
                            $options[$GLOBALS["irCwZnlUmpzbYeDrQlmI"]][$simple_option_key][$GLOBALS["qcAqdRoXyOjMSzAvwpOV"]][$option_key][$GLOBALS["pPZCYftvbIcfKktDOYOo"]] = $product_id.$GLOBALS["rojWvnbZNAUBRjTQLXdg"].$option[$GLOBALS["MyGfQYdQGWFabnAhbjGR"]].$GLOBALS["rojWvnbZNAUBRjTQLXdg"].$option[$GLOBALS["QcnvhCDTXuaYUSlVhWWt"]];
                        }
                    }
                }
                break;
        }
    }
    return $options;
}

function arrangeCartData($cart_array)
{
    if(isGroceryEnabled())
    {
        $grocery_items = array();
        if($cart_array['items'])
        {
            foreach($cart_array[$GLOBALS["uVuEDCLjTSQjNtEpPTGN"]] as $_item_key => $_item)
            {
                if(!array_key_exists($_item[$GLOBALS["ksmBVCTZnuQUbdBtBigo"]], $grocery_items))
                {
                    $grocery_items[$_item[$GLOBALS["ksmBVCTZnuQUbdBtBigo"]]] = $_item;
                    $grocery_items[$_item[$GLOBALS["ksmBVCTZnuQUbdBtBigo"]]][$GLOBALS["eDweEljdhKWRGKvEnM"]] = array();
                }

                $_grocery_option = array();
                
                if($_item['options'])
                {
                    $_grocery_option[$GLOBALS["XZqOYpcRtpUygRwELsRH"]] = $GLOBALS["BODVXTlCZfXhaFUDBjAW"];
                    $_grocery_option[$GLOBALS["usEHohMWxVrEeDLpdojY"]][$GLOBALS["WNObBJvjlfgbtytIZfTq"]] = implode($GLOBALS["UErXESVgiXETbMaUsAvm"], $_item[$GLOBALS["qcAqdRoXyOjMSzAvwpOV"]]);
                    $_grocery_option[$GLOBALS["pPZCYftvbIcfKktDOYOo"]] = str_replace($GLOBALS["ktwCrReEJlzuBUIjBcCk"], $GLOBALS["rojWvnbZNAUBRjTQLXdg"], $_item[$GLOBALS["AdSKntICBqGkMHNEzGDl"]]);
                }
                
                else
                {
                    $_grocery_option[$GLOBALS["XZqOYpcRtpUygRwELsRH"]] = $GLOBALS["dJLWnUZqJJMnpFGrjgZA"];
                    $_grocery_option[$GLOBALS["pPZCYftvbIcfKktDOYOo"]] = $_item[$GLOBALS["AdSKntICBqGkMHNEzGDl"]];
                }
                
                $_grocery_option[$GLOBALS["AdSKntICBqGkMHNEzGDl"]]            = $_item[$GLOBALS["AdSKntICBqGkMHNEzGDl"]];
                $_grocery_option[$GLOBALS["KBqBiaEsxDDHtdysZMBq"]]           = $_item[$GLOBALS["KBqBiaEsxDDHtdysZMBq"]];
                $_grocery_option[$GLOBALS["aqUqrJfwLwDOVmldngyE"]]   = $_item[$GLOBALS["aqUqrJfwLwDOVmldngyE"]];
                $_grocery_option[$GLOBALS["UxpaPbRXERSOLPwRbRqc"]]            = $_item[$GLOBALS["UxpaPbRXERSOLPwRbRqc"]];
                $_grocery_option[$GLOBALS["IXCfKzsjlitrRiMXFvE"]]              = $_item[$GLOBALS["IXCfKzsjlitrRiMXFvE"]];
                $_grocery_option[$GLOBALS["klBPFxupPIvHrNcNScRh"]]     = $_item[$GLOBALS["klBPFxupPIvHrNcNScRh"]];
                $_grocery_option[$GLOBALS["iovnsSfSfLlsBlMvREvS"]]                = $_item[$GLOBALS["iovnsSfSfLlsBlMvREvS"]];
                $_grocery_option[$GLOBALS["njLidmcEqTYJagQxbHZH"]]     = $_item[$GLOBALS["njLidmcEqTYJagQxbHZH"]];
                $_grocery_option[$GLOBALS["TLOkvTfNXSCrzIxyhrCE"]]          = $_item[$GLOBALS["TLOkvTfNXSCrzIxyhrCE"]];
                $_grocery_option[$GLOBALS["dqQDBZDadhIuRliGvbmw"]] = $_item[$GLOBALS["dqQDBZDadhIuRliGvbmw"]];

                $grocery_items[$_item[$GLOBALS["ksmBVCTZnuQUbdBtBigo"]]][$GLOBALS["eDweEljdhKWRGKvEnM"]][] = $_grocery_option;
            }
        }

        $cart_array[$GLOBALS["YDcyXeFShlzkYFseILIE"]] = array_values($grocery_items);
    }
    return $cart_array;
}

function arrangeOrderDetailData($order)
{
    if(isGroceryEnabled())
    {
        $grocery_items = array();
        foreach($order['order_items'] as $_item) {
            if(!array_key_exists($_item[$GLOBALS["ksmBVCTZnuQUbdBtBigo"]], $grocery_items)) {
                $grocery_items[$_item[$GLOBALS["ksmBVCTZnuQUbdBtBigo"]]] = $_item;
                $grocery_items[$_item[$GLOBALS["ksmBVCTZnuQUbdBtBigo"]]][$GLOBALS["eDweEljdhKWRGKvEnM"]] = array();
            }

            if($_item['options'])
            {
                $option_value = array();
                foreach($_item['options'] as $_option)
                {
                    $option_value[] = $_option[$GLOBALS["WNObBJvjlfgbtytIZfTq"]];
                }
                $_item[$GLOBALS["qcAqdRoXyOjMSzAvwpOV"]][0][$GLOBALS["WNObBJvjlfgbtytIZfTq"]] = implode($GLOBALS["UErXESVgiXETbMaUsAvm"], $option_value);   
            }

            $grocery_items[$_item[$GLOBALS["ksmBVCTZnuQUbdBtBigo"]]][$GLOBALS["eDweEljdhKWRGKvEnM"]][] = $_item;
        }

        $grocery_items = array_values($grocery_items);
        $order[$GLOBALS["YDcyXeFShlzkYFseILIE"]] = $grocery_items;
    }
    
    return $order;
}
 ?>