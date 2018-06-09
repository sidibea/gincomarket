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
class HsPayPalCountry extends Country
{
    /**
     *
     * @param int $id_country
     * @return string
     */
    public static function generateDefaultZipCode($id_country)
    {
        $zipcode = HsPayPalConstants::DEFAULT_POSTCODE;
        $zip_code_format = self::getZipCodeFormat($id_country);
        if ($zip_code_format) {
            $zipcode = str_replace(array('L', 'N'), array('A', '0'), $zip_code_format);
        }
        return $zipcode;
    }
}
