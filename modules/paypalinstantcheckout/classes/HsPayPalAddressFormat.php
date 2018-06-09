<?php
/**
 * Paypal Instant Checkout for Prestashop
 *
 * @author    PrestaMonster
 * @copyright PrestaMonster
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */

/**
 *
 */
class HsPayPalAddressFormat extends AddressFormat
{

    /**
     * Be compatible with PS 1.6.0.11 or older
     * @return array
     * <pre>
     * array(
     *  string,// field name
     *  string,
     *  ...
     * )
     */
    public static function getFieldsRequired()
    {
        $address = new HsPaypalAddress();
        return array_unique(array_merge($address->getFieldsRequiredDB(), AddressFormat::$requireFormFieldsList));
    }
}
