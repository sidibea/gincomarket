<?php
/**
 * Paypal Instant Checkout for PrestaShop.
 *
 * @author    PrestaMonster
 * @copyright PrestaMonster
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */

class HsPaypalInstantCheckOut
{
    /**
     * https://developer.paypal.com/docs/classic/api/currency_codes
     * <pre>
     * array(
     *  string,// 3-character ISO-4217 code
     *  string,// 3-character ISO-4217 code
     *  ...
     * )
     */
    protected static $support_currencies = array(
        'AUD',
        'BRL',
        'CAD',
        'CHF',
        'CZK',
        'DKK',
        'EUR',
        'GBP',
        'HKD',
        'HUF',
        'ILS',
        'JPY',
        'MXN',
        'MYR',
        'NOK',
        'NZD',
        'PHP',
        'PLN',
        'RUB',
        'SEK',
        'SGD',
        'THB',
        'TRY',
        'TWD',
        'USD'
    );
    
    protected static $separator = '::';

    /**
     * Contain paypal account.
     *
     * @var string
     */
    protected static $cache_account;

    /**
     * function set extra cover.
     *
     * @param int $id_product
     *
     * @return int boolean
     */
    public static function setCart($id_product, $id_cart)
    {
        $paypal_product_carts = self::getAllPaypalProductCart();
        $paypal_product_carts[(int) $id_product] = $id_cart;
        Context::getContext()->cookie->paypal_product_cart = self::encode($paypal_product_carts);

        return true;
    }

    /**
     * function get Product Cart.
     *
     * @param int $id_product
     *
     * @return int id_cart
     */
    public static function getCart($id_product)
    {
        $paypal_product_carts = self::getAllPaypalProductCart();

        return !empty($paypal_product_carts[$id_product]) ? $paypal_product_carts[$id_product] : null;
    }

    /**
     * delete a product out of $this->context->cookie->paypal_product_cart.
     *
     * @param int $id_product
     *
     * @return bool
     * */
    public static function deleteCart($id_product)
    {
        $paypal_product_carts = self::getAllPaypalProductCart();
        if (!empty($paypal_product_carts[$id_product])) {
            unset($paypal_product_carts[$id_product]);
        }
        Context::getContext()->cookie->paypal_product_cart = self::encode($paypal_product_carts);

        return true;
    }

    /**
     * function get all paypal product cart in cookie.
     *
     * @return string paypal product cart haver form id_product1::id_cart1,id_product2::id_cart2
     */
    protected static function getAllPaypalProductCart()
    {
        $context = Context::getContext();
        $paypal_product_cart_cookie = !empty($context->cookie->paypal_product_cart) ? $context->cookie->paypal_product_cart : '';

        return self::decode($paypal_product_cart_cookie);
    }

    /**
     * Convert an array into a form of "key::value,key::value".
     *
     * @param array $input
     *                     array(
     *                     key => value,
     *                     key => value
     *                     ...
     *                     )
     *                     return string in format of "key::value,key::value"
     */
    protected static function encode(array $input)
    {
        $output = '';
        if (!empty($input)) {
            $tmp = array();
            foreach ($input as $key => $value) {
                $tmp[] = ($key . self::$separator . $value);
            }
            $output = implode(',', $tmp);
        }

        return $output;
    }

    /**
     * Convert a string into an array. String should be in format of "key::value,key::value".
     *
     * @param string $input
     *
     * @return array decoded array
     *               array(
     *               key => value,
     *               key => value
     *               ...
     *               )
     */
    protected static function decode($input)
    {
        $tmp = explode(',', $input);
        $output = array();
        foreach ($tmp as $record) {
            $key_value = explode(self::$separator, $record);
            if (!empty($key_value[0]) && !empty($key_value[1])) {
                $output[$key_value[0]] = $key_value[1];
            }
        }

        return $output;
    }

    /**
     * Get paypal's account.
     *
     * @return string
     */
    public static function getPaypalAccount()
    {
        return Configuration::get('HS_PAYPAL_ACCOUNT');
    }

    /**
     * clone Prestashop cart, empty cart and then add the current product to cart; this cart will provide a stardard cart and server any stardard request
     * in this case, we just get shipping fee.
     *
     * @param Cart $cart
     * @param int  $id_product
     * @param int  $id_product_attribute
     *
     * @return Cart
     */
    public static function getPaypalCart(Cart $cart, $id_product = 0, $id_product_attribute = 0, $quantity = 1)
    {
        $paypal_cart = null;
        if ((int) $id_product === 0) {
            $paypal_cart = $cart;
        } else {
            if ($id_product > 0) {
                $id_cart = self::getCart($id_product);
                if (empty($id_cart)) {
                    $paypal_cart = static::cloneCart($cart, $id_product);
                } else {
                    $paypal_cart = new Cart((int) $id_cart);
                    if (!Validate::isLoadedObject($paypal_cart) || $paypal_cart->orderExists()) {
                        $paypal_cart = static::cloneCart($cart, $id_product);
                    }

                    $products = $paypal_cart->getProducts();
                    if (count($products)) {
                        foreach ($products as $product) {
                            $paypal_cart->deleteProduct($product['id_product'], $product['id_product_attribute']);
                        }
                    }
                }
                $paypal_cart->updateQty($quantity, (int) $id_product, $id_product_attribute);
            }
        }

        return $paypal_cart;
    }

    /**
     * Clone current cart.
     *
     * @param Cart $cart
     * @param int  $id_product
     */
    protected static function cloneCart($cart, $id_product)
    {
        $paypal_cart = clone $cart;
        $paypal_cart->id = null;
        $paypal_cart->id_carrier = null;
        $paypal_cart->add();
        if ($paypal_cart->id) {
            self::setCart($id_product, $paypal_cart->id);
        }
        return $paypal_cart;
    }
    
    /**
     *
     * @param string $currency_code a 3-character ISO-4217 codes (https://en.wikipedia.org/wiki/ISO_4217#Active_codes)
     * @return boolean
     */
    public static function isSupportedCurrency($currency_code)
    {
        return in_array($currency_code, self::$support_currencies);
    }
    
    /**
     *
     * @return array
     * <pre>
     * array(
     *  string,// 3-character ISO-4217 code
     *  string,// 3-character ISO-4217 code
     *  ...
     * )
     */
    public static function getSupportedCurrencies()
    {
        return self::$support_currencies;
    }
}
