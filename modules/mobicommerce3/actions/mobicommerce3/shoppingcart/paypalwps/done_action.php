<?php
$GLOBALS["fpaeRtqabgxVrxakwgft"]=base64_decode("T3JkZXI=");$GLOBALS["DRFASdWnbMVUSWLBGBCS"]=base64_decode("dHg=");$GLOBALS["OHRrnGIvmUcyOndyvaGQ"]=base64_decode("b3JkZXJz");$GLOBALS["RebOSfKjxLaHWlwWPQMS"]=base64_decode("b3JkZXJfaWQ=");$GLOBALS["asxETQgoYgCVOHXhnboY"]=base64_decode("Y3VycmVuY3k=");$GLOBALS["YqyolcmCAiIfgRPfCTNy"]=base64_decode("cGF5bWVudF90b3RhbA==");$GLOBALS["wFrKrtPavlSfgOUZyFEh"]=base64_decode("dHhuX2lk");$GLOBALS["pvwtKwdFTwopxtIFnsiY"]=base64_decode("dHJhbnNhY3Rpb25faWQ=");$GLOBALS["thhUBOuUPnqmjNnLogCq"]=base64_decode("bWNfZ3Jvc3M=");$GLOBALS["sWCONYouUszQosYnw"]=base64_decode("b3JkZXJfaXRlbXM=");$GLOBALS["VdVzZmgPZuXwDwiTrzI"]=base64_decode("cHJpY2VfaW5mb3M=");$GLOBALS["rUVLMDNCwQuomgyFgSRa"]=base64_decode("c2hpcHBpbmdfYWRkcmVzcw==");$GLOBALS["OuMOWOuHTSJeStLxpPzy"]=base64_decode("ZGlzcGxheV9pZA==");$GLOBALS["kBVqwgUCWFvxVAdcfHQ"]=base64_decode("Y2FydF9xdWFudGl0eQ==");$GLOBALS["iovnsSfSfLlsBlMvREvS"]=base64_decode("cXR5");$GLOBALS["IXCfKzsjlitrRiMXFvE"]=base64_decode("cHJpY2U=");$GLOBALS["eNmsUERaOkuDaKikPutW"]=base64_decode("aG9tZV9jdXJyZW5jeV9wcmljZQ==");$GLOBALS["tugkmwKQmrdyfghQnRJj"]=base64_decode("");$GLOBALS["ZHcipcqtxZZjnxLnUcGB"]=base64_decode("Y2F0ZWdvcnlfbmFtZQ==");$GLOBALS["BoWuBfavKqJxeLgCuLA"]=base64_decode("bmFtZQ==");$GLOBALS["cezLRxVGpwnyDVhOFzqd"]=base64_decode("aXRlbV90aXRsZQ==");$GLOBALS["fzPHrkFxgRoWCJQkNlge"]=base64_decode("b3JkZXJfaXRlbV9rZXk=");$GLOBALS["hqzNeHAWOwqfUZHIwuEa"]=base64_decode("aWRfcHJvZHVjdA==");$GLOBALS["AdSKntICBqGkMHNEzGDl"]=base64_decode("aXRlbV9pZA==");$GLOBALS["AvpWRgjbjjVvBFnFfcdK"]=base64_decode("cGF5cGFs");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"]))
{
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}

class mobicommerce3_shoppingcart_paypalwps_done_action extends BaseAction
{
    public function execute()
    {
        $paypal = Module::getInstanceByName($GLOBALS["AvpWRgjbjjVvBFnFfcdK"]);
        $id_cart = $this->context->cookie->id_cart;
        $id_module = $paypal->id;
        $id_order = Order::getOrderByCartId((int)$id_cart);
        $order = new Order((int)$id_order);

        if (!$id_order OR !$id_module OR !Validate::isLoadedObject($order) OR $order->id_customer != $this->context->cookie->id_customer)
        {
            $items = array();
            foreach ($this->context->cart->getProducts() as $product)
            {
                $items[] = array(
                    'item_id' => $product['id_product'],
                    'order_item_key' => $product['id_product'],
                    'item_title' => $product['name'],
                    'category_name' => '',
                    'home_currency_price' => $product['price'],
                    'qty' => $product['cart_quantity']
                );
            }
            $orderItem = array(
                'display_id'       => $id_order,
                'shipping_address' => array(),
                'price_infos'      => array(),
                'order_items'      => $items
            );

            $currency = isset($this->context->cookie->pay_currency) ? $this->context->cookie->pay_currency : $this->context->cookie->currency;
            if (isset($_REQUEST[$GLOBALS["thhUBOuUPnqmjNnLogCq"]]) && $_REQUEST[$GLOBALS["thhUBOuUPnqmjNnLogCq"]])
            {
                $total = $_REQUEST[$GLOBALS["thhUBOuUPnqmjNnLogCq"]];
            }
            else
            {
                $cart = new Cart($id_cart);
                $costtotal = $cart->getOrderTotal();
                $from = Currency::getCurrent();
                $to = new Currency(Currency::getIdByIsoCode($currency));
                $total = $costtotal / $from->conversion_rate * $to->conversion_rate;
            }

            $info = array(
                'transaction_id' => $_REQUEST['txn_id'],
                'payment_total'  => $total,
                'currency'       => $currency,
                'order_id'       => $id_order,
                'orders'         => array($orderItem)
            );
            $this->setSuccess($info);
        }
        else
        {
            $tx = max($_REQUEST[$GLOBALS["DRFASdWnbMVUSWLBGBCS"]], $_REQUEST[$GLOBALS["wFrKrtPavlSfgOUZyFEh"]]);
            $orderService = ServiceFactory::factory($GLOBALS["fpaeRtqabgxVrxakwgft"]);
            $info = $orderService->getPaymentOrderInfo($order, $tx);
            $this->setSuccess($info);
        }

        unset($this->context->cookie->pay_currency);
    }
}
 ?>