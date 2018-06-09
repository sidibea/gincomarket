<?php
/**
 * Paypal Instant Checkout for PrestaShop.
 *
 * @author    PrestaMonster
 * @copyright PrestaMonster
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */

class HsPayPalSpecificPrice extends SpecificPrice
{
    /**
     * Add specific price for product.
     *
     * @param int   $id_product
     * @param int   $id_currency
     * @param int   $id_customer
     * @param int   $id_cart
     * @param float $price
     *
     * @return bool
     */
    public static function addSpecificPrice($id_product, $price, $id_currency)
    {
        SpecificPrice::deleteByProductId($id_product);
        $specificPrice = new SpecificPrice();
        $specificPrice->id_product = (int) $id_product;
        $specificPrice->id_currency = (int) $id_currency;
        $specificPrice->id_country = 0;
        $specificPrice->id_group = 0;
        $specificPrice->id_shop = 0;
        $specificPrice->id_customer = 0;
        $specificPrice->price = (float) $price;
        $specificPrice->from_quantity = 1;
        $specificPrice->reduction = 0;
        $specificPrice->id_cart = 0;
        $specificPrice->reduction_type = 'amount';
        $specificPrice->from = '0000-00-00 00:00:00';
        $specificPrice->to = '0000-00-00 00:00:00';

        return $specificPrice->add();
    }
}
