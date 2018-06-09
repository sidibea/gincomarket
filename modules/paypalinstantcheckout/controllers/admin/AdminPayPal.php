<?php
/**
 * Paypal Instant Checkout for PrestaShop.
 *
 * @author    PrestaMonster
 * @copyright PrestaMonster
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */

class AdminPayPalController extends ModuleAdminController
{
    /**
     * add to $this->content the result of Customer::SearchByName
     * (encoded in json).
     */
    public function ajaxProcessSearchCustomers()
    {
        $key_searchs = array_unique(explode(' ', Tools::getValue('key_search')));
        $customers = array();
        foreach ($key_searchs as $key_search) {
            if (!empty($key_search) && $results = Customer::searchByName($key_search)) {
                foreach ($results as &$result) {
                    $result['link'] = $this->context->link->getAdminLink('AdminCustomers').'&viewcustomer&id_customer='.$result['id_customer'];
                    $customers[$result['id_customer']] = $result;
                }
            }
        }
        if (count($customers)) {
            $to_return = array(
                'customers' => $customers,
                'found' => true
            );
        } else {
            $to_return = array('found' => false);
        }

        $this->content = Tools::jsonEncode($to_return);
    }

    /**
     * add to $this->content the result address of customer
     * (encoded in json).
     */
    public function ajaxProcessGetAddresses()
    {
        $id_customer = Tools::getValue('id_customer', 0);
        $to_return = array('found' => false);
        if ($id_customer) {
            $customer = new Customer($id_customer);
            if (Validate::isLoadedObject($customer)) {
                Configuration::updateValue('PAYPAL_DUMMY_CUSTOMER', $id_customer);
                $addresses = $customer->getAddresses((int) $this->context->language->id);
                if (!empty($addresses)) {
                    $to_return = array(
                        'addresses' => $addresses,
                        'found' => true,
                    );
                }
            }
        }

        $this->content = Tools::jsonEncode($to_return);
    }
}
