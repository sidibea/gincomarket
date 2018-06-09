<?php
$GLOBALS["bJVDJcBfjwWDhPgYNynR"]=base64_decode("aWRfY2FydF9ydWxl");$GLOBALS["ZlfUsvgNsPidSWtLfdis"]=base64_decode("YWxsb3dfcmVmcmVzaA==");$GLOBALS["sZRAcUoqHGXbJrmuprel"]=base64_decode("aWRfY291bnRyeQ==");$GLOBALS["LgxTcvBcnMJTQqSXGfAL"]=base64_decode("QW4gZXJyb3Igb2NjdXJyZWQgd2hpbGUgdXBkYXRpbmcgeW91ciBjYXJ0Lg==");$GLOBALS["bwbrnLyQPlRnNWGyaBrx"]=base64_decode("VGhpcyBhZGRyZXNzIGlzIGludmFsaWQu");$GLOBALS["JfYteYYWrrIKDdpaToiI"]=base64_decode("VGhpcyBhZGRyZXNzIGlzIG5vdCBpbiBhIHZhbGlkIGFyZWEu");$GLOBALS["sjmoIvLwfFfvyTlSbvZR"]=base64_decode("VGhpcyBhZGRyZXNzIGlzIG5vdCB5b3Vycy4=");$GLOBALS["VdvyzWKZLzgDUsAczrsY"]=base64_decode("aXNWaXJ0dWFsQ2FydA==");$GLOBALS["lRBzvzBSEQkJxdBItbg"]=base64_decode("LA==");$GLOBALS["oMkdWAtFeBgRZvVSpTCa"]=base64_decode("MHhFRkZG");$GLOBALS["clDBUEZYNUFAaVDeeJcN"]=base64_decode("U2hvcHBpbmdDYXJ0");$GLOBALS["hxrnlTlynpqSTNWfhuAL"]=base64_decode("c2hpcHBpbmdfYWRkcmVzc19pZA==");$GLOBALS["SHlRCNLzGtCGyHhhetLl"]=base64_decode("MQ==");$GLOBALS["ufFkKYDytmmwPcPaodbz"]=base64_decode("dXNlX2Zvcl9zaGlwcGluZw==");$GLOBALS["VWpznMtONzRFEUAUvgQ"]=base64_decode("YmlsbGluZw==");$GLOBALS["eVFgjlKJHoNvjuEaHgPX"]=base64_decode("YmlsbGluZ19hZGRyZXNzX2lk");$GLOBALS["ioiNpBIJqdbdxztuPQbp"]=base64_decode("Q2hlY2tvdXQ=");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");$GLOBALS["MFlPPBWXQThfIlghoqUM"]=base64_decode("Y2FydF9kZXRhaWxz");$GLOBALS["SxKXpUBNrgBKJlqIKGVc"]=base64_decode("c2hpcHBpbmdfbWV0aG9kcw==");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"]))
{
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}

class mobicommerce3_shoppingcart_addresses_update_action extends BaseAction {

    private function updateAddress($shippingAddressId, $address)
    {
        ServiceFactory::factory($GLOBALS["ioiNpBIJqdbdxztuPQbp"])->updateAddress($shippingAddressId, $address);
    }

    private function addAddress($shippingAddress)
    {
        ServiceFactory::factory($GLOBALS["ioiNpBIJqdbdxztuPQbp"])->addAddress($shippingAddress);
    }

    public function execute()
    {
        $same = false;
        if(isset($_REQUEST[$GLOBALS["eVFgjlKJHoNvjuEaHgPX"]]) && !empty($_REQUEST[$GLOBALS["eVFgjlKJHoNvjuEaHgPX"]]))
        {
            $id_address_invoice = $_REQUEST[$GLOBALS["eVFgjlKJHoNvjuEaHgPX"]];
        }

        if(isset($_REQUEST[$GLOBALS["VWpznMtONzRFEUAUvgQ"]][$GLOBALS["ufFkKYDytmmwPcPaodbz"]]) && $_REQUEST[$GLOBALS["VWpznMtONzRFEUAUvgQ"]][$GLOBALS["ufFkKYDytmmwPcPaodbz"]] == $GLOBALS["SHlRCNLzGtCGyHhhetLl"])
        {
            $same = true;
            $id_address_delivery = $id_address_invoice;
        }
        else if(isset($_REQUEST[$GLOBALS["hxrnlTlynpqSTNWfhuAL"]]) && !empty($_REQUEST[$GLOBALS["hxrnlTlynpqSTNWfhuAL"]]))
        {
            $id_address_delivery = $_REQUEST[$GLOBALS["hxrnlTlynpqSTNWfhuAL"]];
        }

        
        $this->errors = array();
        $this->saveAddressAndGetShippingMethods($id_address_invoice, $id_address_delivery, $same);

        if(empty($this->errors))
        {
            $result = ServiceFactory::factory($GLOBALS["ioiNpBIJqdbdxztuPQbp"])->detail();
            $result[$GLOBALS["SxKXpUBNrgBKJlqIKGVc"]] = array();
            $result["cart_details"] = ServiceFactory::factory('ShoppingCart')->get();
            $this->setSuccess($result);
        }
        else
        {
            $this->setError($GLOBALS["oMkdWAtFeBgRZvVSpTCa"], implode($GLOBALS["lRBzvzBSEQkJxdBItbg"], $this->errors));
        }
    }

    private function exportAddressToRequest($address)
    {
        foreach ($address as $key => $val)
        {
            $_REQUEST[$key] = $val;
        }
    }

    protected function saveAddressAndGetShippingMethods($id_address_invoice, $id_address_delivery, $same)
    {
        if ($this->context->customer->isLogged(true))
        {
            $address_delivery = new Address((int)$id_address_delivery);
            $this->context->smarty->assign($GLOBALS["VdvyzWKZLzgDUsAczrsY"], $this->context->cart->isVirtualCart());
            $address_invoice = ((int)$id_address_delivery == (int)$id_address_invoice ? $address_delivery : new Address((int)$id_address_invoice));
            if ($address_delivery->id_customer != $this->context->customer->id || $address_invoice->id_customer != $this->context->customer->id)
                $this->errors[] = Tools::displayError($GLOBALS["sjmoIvLwfFfvyTlSbvZR"]);
            elseif (!Address::isCountryActiveById((int)$id_address_delivery))
                $this->errors[] = Tools::displayError($GLOBALS["JfYteYYWrrIKDdpaToiI"]);
            elseif (!Validate::isLoadedObject($address_delivery) || !Validate::isLoadedObject($address_invoice) || $address_invoice->deleted || $address_delivery->deleted)
                $this->errors[] = Tools::displayError($GLOBALS["bwbrnLyQPlRnNWGyaBrx"]);
            else
            {
                $this->context->cart->id_address_delivery = (int)$id_address_delivery;
                $this->context->cart->id_address_invoice = $same ? $this->context->cart->id_address_delivery : (int)$id_address_invoice;
                if (!$this->context->cart->update())
                    $this->errors[] = Tools::displayError($GLOBALS["LgxTcvBcnMJTQqSXGfAL"]);

                $infos = Address::getCountryAndState((int)$this->context->cart->id_address_delivery);
                if (isset($infos[$GLOBALS["sZRAcUoqHGXbJrmuprel"]]) && $infos[$GLOBALS["sZRAcUoqHGXbJrmuprel"]])
                {
                    $country = new Country((int)$infos[$GLOBALS["sZRAcUoqHGXbJrmuprel"]]);
                    $this->context->country = $country;
                }

                                $cart_rules = $this->context->cart->getCartRules();
                CartRule::autoRemoveFromCart($this->context);
                CartRule::autoAddToCart($this->context);
                if ((int)Tools::getValue($GLOBALS["ZlfUsvgNsPidSWtLfdis"]))
                {
                                        $cart_rules2 = $this->context->cart->getCartRules();
                    if (count($cart_rules2) != count($cart_rules))
                        $this->ajax_refresh = true;
                    else
                    {
                        $rule_list = array();
                        foreach ($cart_rules2 as $rule)
                            $rule_list[] = $rule[$GLOBALS["bJVDJcBfjwWDhPgYNynR"]];
                        foreach ($cart_rules as $rule)
                            if (!in_array($rule[$GLOBALS["bJVDJcBfjwWDhPgYNynR"]], $rule_list))
                            {
                                $this->ajax_refresh = true;
                                break;
                            }
                    }
                }

                if (!$this->context->cart->isMultiAddressDelivery())
                    $this->context->cart->setNoMultishipping();                 
            }
            
        }
    }
}
 ?>