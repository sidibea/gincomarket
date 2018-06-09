<?php
/**
 * Paypal Instant Checkout for PrestaShop.
 *
 * @author    PrestaMonster
 * @copyright PrestaMonster
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */

class HsPayPalAddress extends Address
{
    /**
     *
     * @param boolean $autodate
     * @param boolean $null_values
     * @return boolean
     */
    public function add($autodate = true, $null_values = false)
    {
        $default_instance = self::generateDefaultInstance($this->id_country);
        foreach (get_object_vars($default_instance) as $field => $value) {
            if (empty($this->$field)) {
                $this->$field = $value;
            }
        }
        return parent::add($autodate, $null_values);
    }
    
    /**
     *
     * @param array $address1
     * <pre>
     * array (
     *  ['id_address'] => int
     *  ['id_customer'] => int
     *  ['id_manufacturer'] => int
     *  ['id_supplier'] => string
     *  ['id_warehouse'] => string
     *  ['alias'] => string
     *  ['company'] => string
     *  ['firstname'] => string
     *  ['lastname'] => string
     *  ['id_country'] => int
     *  ['id_state'] => int
     *  ['address1'] => string
     *  ['address2'] => string
     *  ['city'] => string
     *  ['postcode'] => string
     *  ['other'] => string
     *  ['phone'] => string
     *  ['phone_mobile'] => string
     *  ['vat_number'] => string
     *  ['dni'] => string
     *  ['date_add'] => date time
     *  ['date_upd'] => date time
     *  ['active'] => bolean
     *  ['deleted'] => bolean
     * )
     * @param array $address2 @see $address1
     * @return bolean
     */
    public static function compareAddresses(array $address1, array $address2)
    {
        $array_to_compare    = array(
            'firstname',
            'lastname',
            'id_country',
            'id_state',
            'address1',
            'city',
            'postcode'
        );
        $is_the_same_address = true;
        foreach ($array_to_compare as $field) {
            $is_the_same_address &= $address1[$field] == $address2[$field];
        }

        return $is_the_same_address;
    }

    /**
     *
     * @param array $paypal_response
     * <pre>
     * Array (
     *  [mc_gross] => float
     *  [protection_eligibility] => string
     *  [address_status] => string
     *  [item_number1] => string
     *  [tax] => float
     *  [item_number2] =>string
     *  [payer_id] =>  string
     *  [address_street] => string
     *  [payment_date] => string
     *  [payment_status] => string
     *  [charset] => string
     *  [address_zip] => int
     *  [mc_shipping] => float
     *  [mc_handling] => float
     *  [first_name] => string
     *  [mc_fee] => float
     *  [address_country_code] => string
     *  [address_name] => string
     *  [custom] => string
     *  [payer_status] => string
     *  [business] => string
     *  [address_country] => string
     *  [num_cart_items] => int
     *  [mc_handling1] => float
     *  [mc_handling2] => float
     *  [address_city] => string
     *  [payer_email] => string
     *  [mc_shipping1] => float
     *  [mc_shipping2] => float
     *  [tax1] => float
     *  [tax2] => float
     *  [txn_id] => string
     *  [payment_type] => string
     *  [last_name] => string
     *  [address_state] => string
     *  [item_name1] => string
     *  [receiver_email] => string
     *  [item_name2] => string
     *  [payment_fee] => float
     *  [quantity1] => int
     *  [quantity2] => int
     *  [receiver_id] => string
     *  [txn_type] => string
     *  [mc_gross_1] => float
     *  [mc_currency] => string
     *  [mc_gross_2] => float
     *  [residence_country] => string
     *  [transaction_subject] => string
     *  [payment_gross] => float
     * )
     * @param Customer $customer
     * @return array address
     * <pre>
     * Array (
     *  ['id_address'] => int
     *  ['id_customer'] => int
     *  ['id_manufacturer'] => int
     *  ['id_supplier'] => string
     *  ['id_warehouse'] => string
     *  ['alias'] => string
     *  ['company'] => string
     *  ['firstname'] => string
     *  ['lastname'] => string
     *  ['id_country'] => int
     *  ['id_state'] => int
     *  ['address1'] => string
     *  ['address2'] => string
     *  ['city'] => string
     *  ['postcode'] => string
     *  ['other'] => string
     *  ['phone'] => string
     *  ['phone_mobile'] => string
     *  ['vat_number'] => string
     *  ['dni'] => string
     *  ['date_add'] => date time
     *  ['date_upd'] => date time
     *  ['active'] => bolean
     *  ['deleted'] => bolean
     * )
     */
    public static function initPaypalAddress(array $paypal_response, Customer $customer)
    {
        $address            = new Address();
        $address->firstname = $paypal_response['first_name'];
        $address->lastname  = $paypal_response['last_name'];

        $id_country = Country::getByIso($paypal_response['address_country_code']);
        if (empty($id_country)) {
            $id_country = Configuration::get('PS_COUNTRY_DEFAULT');
        }
        $address->id_country = $id_country;

        $id_state = State::getIdByName($paypal_response['address_state']);
        if (empty($id_state)) {
            $id_state = State::getIdByIso($paypal_response['address_state']);
        }

        $address->id_state    = $id_state;
        $address->address1    = $paypal_response['address_street'];
        $address->city        = $paypal_response['address_city'];
        $address->id_customer = (int)$customer->id;
        $address->postcode    = $paypal_response['address_zip'];

        $order_address_fields  = AddressFormat::getOrderedAddressFields($id_country);
        $required_phone_number = false;
        foreach ($order_address_fields as $address_field) {
            if ($address_field == 'company') {
                $address->company = 'N/A';
            } elseif ($address_field == 'address2') {
                $address->address2 = $paypal_response['address_street'];
            } elseif ($address_field == 'other') {
                $address->other = 'N/A';
            } elseif ($address_field == 'phone_mobile' || $address_field == 'phone') {
                $required_phone_number = true;
            }
        }

        if ($required_phone_number) {
            $address->phone_mobile = '000000000';
            $address->phone        = '000000000';
        }

        if (!empty($paypal_response['contact_phone'])) {
            $address->phone_mobile = $paypal_response['contact_phone'];
            $address->phone        = $paypal_response['contact_phone'];
        }
        $address->alias = 'Paypal_'.Tools::passwdGen(4);

        return get_object_vars($address);
    }
    
    /**
     *
     * @param int $id_country
     * @return \stdClass
     */
    public static function generateDefaultInstance($id_country = null)
    {
        $address = new stdClass();
        $address->id_country = !empty($id_country) ? $id_country : Configuration::get('PS_COUNTRY_DEFAULT');
        $required_address_fields = array_diff(HsPayPalAddressFormat::getFieldsRequired(), array('id_country'));
        foreach ($required_address_fields as $required_field) {
            if (!isset(self::$definition['fields'][$required_field])) {
                continue;
            }
            switch (self::$definition['fields'][$required_field]['validate']) {
                case 'isPhoneNumber':
                    $address->$required_field = HsPayPalConstants::DEFAULT_PHONE_NUMBER;
                    break;
                
                case 'isPostCode':
                    $address->$required_field = HsPayPalCountry::generateDefaultZipCode($address->id_country);
                    break;
                
                default:
                    $address->$required_field = HsPayPalConstants::NOT_AVAILABLE;
                    break;
            }
        }
        return $address;
    }
    
    /**
     * Be compatible with PS 1.6.0.11 or older
     *
     * @return array
     * <pre>
     * array(
     *  string,// field name
     *  string,
     *  ...
     * )
     */
    public function getFieldsRequiredDB()
    {
        $this->cacheFieldsRequiredDatabase(false);
        $native_required_fields = array();
        foreach (self::$definition['fields'] as $field => $definition) {
            if (isset($definition['required']) && $definition['required']) {
                $native_required_fields[] = $field;
            }
        }
        $required_fields_in_database = isset(self::$fieldsRequiredDatabase['Address']) ? self::$fieldsRequiredDatabase['Address'] : array();
        return array_merge($native_required_fields, $required_fields_in_database);
    }
}
