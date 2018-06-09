<?php
/**
 * Paypal Instant Checkout for PrestaShop.
 *
 * @author    PrestaMonster
 * @copyright PrestaMonster
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */

if (!class_exists('HsPaymentModule')) {
    class HsPaymentModule extends PaymentModule
    {
        /**
         * Current order reference
         * @var string
         */
        protected $currentOrderReference;

        /**
         * Similar to PaymentModule::currentOrder, but:<br/>
         * - This is an array<br/>
         * - This contains Order instances instead of Order ID<br/>
         * And this is equivalent to $order_list within PaymentModule::validateOrder() <br/>
         * @var array
         */
        public $current_orders;

        /**
         * Payment method
         * @var string
         */
        protected $payment_method;

        /**
         *
         * @var string
         */
        protected $secure_key;

        /**
         * Amount paid
         * @var float
         */
        protected $paid_amount;

        /**
         * A list of OrderDetail instances, each instance for 1 order
         * @var array
         * <pre>
         * array(
         *  index => OrderDetail,
         *  index => OrderDetail
         * )
         */
        protected $order_details = array();

        /**
         * Extra variables of the current shopping cart / orders
         * @var array
         */
        protected $extra_vars = array();

        /**
         *
         * @var array
         * <pre>
         * array(
         *  CartRule,
         *  CartRule
         *  ...
         * )
         */
        protected static $used_cart_rules = array();

        /**
         *
         * @var OrderState
         */
        protected $order_state;

        /**
         * Current country based on context. This can be changed during processing orders
         * @var Country
         */
        protected $context_country;

        /**
         * Current id_order_state, this can be changed by each order
         * @var int
         */
        protected static $id_order_state;

        /**
         * @var array // {key} => value
         */
        protected static $order_confirmation_email_variables = array();

        /**
         *
         * @param array $params
         * <pre>
         * array(
         *  'id_cart' => int,
         *  'id_order_state' => int,
         *  'paid_amount' => float,
         *  'special_currency' => float,
         *  'payment_method' => string,
         *  'secure_key' => string,
         *  'shop' => Shop,
         *  'extra_vars' => array
         * )
         */
        public function init(array $params)
        {
            $this->initContext($params['id_cart'], $params['special_currency'], $params['shop']);
            $this->context_country = $this->context->country;
            $this->payment_method = $params['payment_method'];
            $this->secure_key = $params['secure_key'];
            $paid_amount = $params['dont_touch_amount'] ? $params['paid_amount'] : Tools::ps_round((float) $params['paid_amount'], 2);
            $this->paid_amount = $paid_amount;
            $this->extra_vars = $params['extra_vars'];
            $this->order_state = new OrderState((int) $params['id_order_state'], (int) $this->context->language->id);
            $this->currentOrderReference = $this->generateReference();
        }

        /**
         *
         * @param int $id_cart
         * @param int $id_order_state
         * @param float $paid_amount
         * @param string $payment_method
         * @param string $message
         * @param array $extra_vars
         * @param int $special_currency Specify just in case we want to force to use this currency instead of utilizing Context
         * @param boolean $dont_touch_amount Ask to don't format or round the paid amount
         * @param string $secure_key
         * @param Shop $shop current shop
         */
        public function validateOrder($id_cart, $id_order_state, $paid_amount, $payment_method = 'Unknown', $message = null, $extra_vars = array(), $special_currency = null, $dont_touch_amount = false, $secure_key = false, Shop $shop = null)
        {
            $params = array(
                'id_cart' => $id_cart,
                'id_order_state' => $id_order_state,
                'paid_amount' => $paid_amount,
                'special_currency' => $special_currency,
                'payment_method' => $payment_method,
                'secure_key' => $secure_key,
                'shop' => $shop,
                'extra_vars' => $extra_vars,
                'dont_touch_amount' => $dont_touch_amount
            );
            $this->init($params);
            $this->beforeAddOrder();
            $delivery_packages = $this->getDeliveryPackages();
            foreach ($delivery_packages as $id_delivery_address => $packages_by_address) {
                foreach ($packages_by_address as $package) {
                    $address = new Address($id_delivery_address);
                    $this->verifyCountry($address->id_country);
                    $order = $this->createOrder($id_delivery_address, $package);
                    $this->current_orders[] = $order;
                }
            }
            $this->afterAddOrder($order, $message);
        }

        public function beforeAddOrder()
        {
            $this->verifyCartStatus();
            $this->verifyOrderState();
            $this->verifyModuleStatus();
            $this->verifySecureKey();
            $this->cleanUpCartRules();
        }

        /**
         *
         * @param Order $order current order
         * @param array $package
         * <pre>
         * array(
         *  'product_list' => array(...),// id_roduct
         *  'carrier_list' => array(...),// id_carrier
         *  'warehouse_list' => array(...), // id_warehouse
         *  'id_warehouse' => int,// int,
         *  'id_carrier' => int
         * )
         */
        protected function addOrderCarrier(Order $order, array $package)
        {
            $carrier = $this->getPackageCarrier($package);
            if (Validate::isLoadedObject($carrier)) {
                $order_carrier = new OrderCarrier();
                $order_carrier->id_order = (int) $order->id;
                $order_carrier->id_carrier = (int) $carrier->id;
                $order_carrier->weight = (float) $order->getTotalWeight();
                $order_carrier->shipping_cost_tax_excl = (float) $order->total_shipping_tax_excl;
                $order_carrier->shipping_cost_tax_incl = (float) $order->total_shipping_tax_incl;
                $order_carrier->add();
            }
        }

        /**
         *
         * @param Order $order current order
         * @param array $package
         * <pre>
         * array(
         *  'product_list' => array(...),// id_roduct
         *  'carrier_list' => array(...),// id_carrier
         *  'warehouse_list' => array(...), // id_warehouse
         *  'id_warehouse' => int,// int,
         *  'id_carrier' => int
         * )
         */
        protected function addOrderDetails(Order $order, array $package)
        {
            $order_detail = new OrderDetail(null, null, $this->context);
            $order_detail->createList($order, $this->context->cart, $this->order_state->id, $order->product_list, 0, true, $package['id_warehouse']);
            $this->order_details[] = $order_detail;
        }

        protected function addProductSale()
        {
            foreach ($this->context->cart->getProducts() as $product) {
                ProductSale::addProductSale((int) $product['id_product'], (int) $product['cart_quantity']);
            }
        }

        /**
         *
         * @param int $id_order_state
         * @param Order $order
         * @param OrderDetail $order_detail
         */
        protected function addOrderHistory($id_order_state, Order $order, OrderDetail $order_detail)
        {
            $new_history = new OrderHistory();
            $new_history->id_order = (int) $order->id;
            $new_history->changeIdOrderState((int) $id_order_state, $order, true);
            $new_history->addWithemail(true, $this->extra_vars);

            // Switch to back order if needed
            if (Configuration::get('PS_STOCK_MANAGEMENT') && ($order_detail->getStockState() || $order_detail->product_quantity_in_stock <= 0)) {
                $history = new OrderHistory();
                $history->id_order = (int) $order->id;
                $history->changeIdOrderState(Configuration::get($order->valid ? 'PS_OS_OUTOFSTOCK_PAID' : 'PS_OS_OUTOFSTOCK_UNPAID'), $order, true);
                $history->addWithemail();
            }
        }

        /**
         *
         * @param Order $order
         * @param string $message
         */
        public function afterAddOrder(Order $order, $message)
        {
            $id_order_state = $this->getIdOrderStateBasedOnPaidAmount();
            $this->resetCountryAfterCreateOrders();
            $this->registerPayment($order);
            CartRule::cleanCache();
            foreach ($this->order_details as $key => $order_detail) {
                $order = $this->current_orders[$key];
                $this->addOrderMessage($order, $message);
                $this->validateCartRulesAfterUse($order);
                $this->addCustomerMessage($order);
                $this->executeHookActionValidateOrder($order);
                if ($this->order_state->logable) {
                    $this->addProductSale();
                }
                $this->addOrderHistory($id_order_state, $order, $order_detail);
                unset($this->order_details[$key]);
                // make sure product list in new order to send email.
                $reload_order = $this->reloadOrder($order);
                $this->current_orders[$key] = $reload_order;
                if ($id_order_state != Configuration::get('PS_OS_ERROR') && $id_order_state != Configuration::get('PS_OS_CANCELED')) {
                    if ($this->context->customer->id) {
                        $this->sendConfirmationEmail($reload_order);
                    }
                }

                if (Configuration::get('PS_ADVANCED_STOCK_MANAGEMENT')) {
                    $this->updateShopStock($reload_order);
                }
                if (is_callable(array($reload_order, 'updateOrderDetailTax'))) {
                    $reload_order->updateOrderDetailTax();
                }
            }
            if (isset($reload_order) && $reload_order->id) {
                // Use the last order as currentOrder
                $this->currentOrder = (int) $reload_order->id;
            }
        }
        
        /**
         *
         * @param Order $order
         * @return Order
         */
        protected function reloadOrder(Order $order)
        {
            $reloaded_order = new Order($order->id);
            $reloaded_order->product_list = $order->product_list;
            return $reloaded_order;
        }

        protected function resetCountryAfterCreateOrders()
        {
            if (Configuration::get('PS_TAX_ADDRESS_TYPE') == 'id_address_delivery') {
                $this->context->country = $this->context_country;
            }
            if (!$this->context->country->active) {
                PrestaShopLogger::addLog('PaymentModule::validateOrder - Country is not active', 3, null, 'Cart', (int) $this->context->cart->id, true);
                throw new PrestaShopException('The order address country is not active.');
            }
        }

        /**
         *
         * @param Order $order
         * @throws PrestaShopException
         */
        protected function registerPayment(Order $order)
        {
            if ($this->order_state->logable) {
                if (isset($this->extra_vars['transaction_id'])) {
                    $transaction_id = $this->extra_vars['transaction_id'];
                } else {
                    $transaction_id = null;
                }
                if (!$order->addOrderPayment($this->paid_amount, null, $transaction_id)) {
                    PrestaShopLogger::addLog('PaymentModule::validateOrder - Cannot save Order Payment', 3, null, 'Cart', (int) $this->context->cart->id, true);
                    throw new PrestaShopException('Can\'t save Order Payment');
                }
            }
        }

        /**
         *
         * @param Order $order
         * @param string $message
         */
        protected function addOrderMessage(Order $order, $message)
        {
            if (isset($message) & !empty($message)) {
                $msg = new Message();
                $message = strip_tags($message, '<br>');
                if (Validate::isCleanHtml($message)) {
                    $msg->message = $message;
                    $msg->id_cart = (int) $order->id_cart;
                    $msg->id_customer = (int) ($order->id_customer);
                    $msg->id_order = (int) $order->id;
                    $msg->private = 1;
                    $msg->add();
                }
            }
        }

        /**
         *
         * @param Order $order
         */
        protected function validateCartRulesAfterUse(Order $order)
        {
            $cart_rules = $this->context->cart->getCartRules();
            $cart_rules_list = array();
            $total_reduction_value_ti = 0;
            $total_reduction_value_tex = 0;
            foreach ($cart_rules as $cart_rule) {
                $package = $this->rebuildDeliveryPackageFromOrder($order);
                $reduction_tax_excl = $cart_rule['obj']->getContextualValue(false, $this->context, CartRule::FILTER_ACTION_ALL_NOCAP, $package);
                if (!$reduction_tax_excl) {
                    // If the reduction is not applicable to this order, then continue with the next one
                    continue;
                }
                $reduction_tax_incl = $cart_rule['obj']->getContextualValue(true, $this->context, CartRule::FILTER_ACTION_ALL_NOCAP, $package);
                if (count($this->current_orders) == 1 && $reduction_tax_incl > ($order->total_products_wt - $total_reduction_value_ti)) {
                    if ($cart_rule['obj']->partial_use == 1 && $cart_rule['obj']->reduction_amount > 0) {
                        $reduction_amount = 0;
                        if ($cart_rule['obj']->reduction_tax) {
                            $reduction_amount = ($total_reduction_value_ti + $reduction_tax_incl) - $order->total_products_wt;
                            // Add total shipping amout only if reduction amount > total shipping
                            if ($cart_rule['obj']->free_shipping == 1 && $cart_rule['obj']->reduction_amount >= $order->total_shipping_tax_incl) {
                                $reduction_amount -= $order->total_shipping_tax_incl;
                            }
                        } else {
                            $reduction_amount = ($total_reduction_value_tex + $reduction_tax_excl) - $order->total_products;
                            // Add total shipping amout only if reduction amount > total shipping
                            if ($cart_rule['obj']->free_shipping == 1 && $cart_rule['obj']->reduction_amount >= $order->total_shipping_tax_excl) {
                                $reduction_amount -= $order->total_shipping_tax_excl;
                            }
                        }
                        if ($reduction_amount <= 0) {
                            continue;
                        }
                        $this->createNewCartRuleIfPartialUse($order, $cart_rule['obj'], $reduction_amount);
                        $reduction_tax_incl = $order->total_products_wt - $total_reduction_value_ti;
                        $reduction_tax_excl = $order->total_products - $total_reduction_value_tex;
                    }
                }
                $total_reduction_value_ti += $reduction_tax_incl;
                $total_reduction_value_tex += $reduction_tax_excl;
                $used_voucher_values = array(
                    'tax_incl' => $reduction_tax_incl,
                    'tax_excl' => $reduction_tax_excl
                );
                $this->attachCartRuleToOrder($order, $cart_rule['obj'], $used_voucher_values);
                $cart_rules_list[] = array(
                    'voucher_name' => $cart_rule['obj']->name,
                    'voucher_reduction' => ($reduction_tax_incl != 0.00 ? '-' : '') . Tools::displayPrice($reduction_tax_incl, $this->context->currency, false)
                );
            }
            $cart_rules_list_txt = '';
            $cart_rules_list_html = '';
            if (count($cart_rules_list) > 0) {
                $cart_rules_list_txt = $this->getEmailTemplateContent('order_conf_cart_rules.txt', Mail::TYPE_TEXT, $cart_rules_list);
                $cart_rules_list_html = $this->getEmailTemplateContent('order_conf_cart_rules.tpl', Mail::TYPE_HTML, $cart_rules_list);
            }
            self::$order_confirmation_email_variables['discounts'] = $cart_rules_list_html;
            self::$order_confirmation_email_variables['discounts_txt'] = $cart_rules_list_txt;
        }

        /**
         *
         * @param Order $order
         */
        protected function addCustomerMessage(Order $order)
        {
            $old_message = Message::getMessageByCartId((int) $this->context->cart->id);
            if ($old_message && !$old_message['private']) {
                $update_message = new Message((int) $old_message['id_message']);
                $update_message->id_order = (int) $order->id;
                $update_message->update();
                $customer_thread = new CustomerThread();
                $customer_thread->id_contact = 0;
                $customer_thread->id_customer = (int) $order->id_customer;
                $customer_thread->id_shop = (int) $this->context->shop->id;
                $customer_thread->id_order = (int) $order->id;
                $customer_thread->id_lang = (int) $this->context->language->id;
                $customer_thread->email = $this->context->customer->email;
                $customer_thread->status = 'open';
                $customer_thread->token = Tools::passwdGen(12);
                $customer_thread->add();
                $customer_message = new CustomerMessage();
                $customer_message->id_customer_thread = $customer_thread->id;
                $customer_message->id_employee = 0;
                $customer_message->message = $update_message->message;
                $customer_message->private = 0;
                if (!$customer_message->add()) {
                    $this->errors[] = Tools::displayError('An error occurred while saving message');
                }
            }
        }

        /**
         *
         * @return boolean
         */
        protected function isPrestashop16()
        {
            return version_compare(_PS_VERSION_, '1.6') === 1;
        }

        /**
         *
         * @param Order $order
         */
        protected function sendConfirmationEmail(Order $order)
        {
            $this->prepareProductListTemplateVariables($order);
            $invoice = new Address((int) $order->id_address_invoice);
            $delivery = new Address((int) $order->id_address_delivery);
            $carrier = new Carrier((int) $order->id, (int) $this->context->language->id);
            $delivery_state = $delivery->id_state ? new State((int) $delivery->id_state) : false;
            $invoice_state = $invoice->id_state ? new State((int) $invoice->id_state) : false;
            $data = array(
                '{firstname}' => $this->context->customer->firstname,
                '{lastname}' => $this->context->customer->lastname,
                '{email}' => $this->context->customer->email,
                '{delivery_block_txt}' => $this->_getFormatedAddress($delivery, "\n"),
                '{invoice_block_txt}' => $this->_getFormatedAddress($invoice, "\n"),
                '{delivery_block_html}' => $this->_getFormatedAddress($delivery, '<br />', array(
                    'firstname' => '<span style="font-weight:bold;">%s</span>',
                    'lastname' => '<span style="font-weight:bold;">%s</span>'
                )),
                '{invoice_block_html}' => $this->_getFormatedAddress($invoice, '<br />', array(
                    'firstname' => '<span style="font-weight:bold;">%s</span>',
                    'lastname' => '<span style="font-weight:bold;">%s</span>'
                )),
                '{delivery_company}' => $delivery->company,
                '{delivery_firstname}' => $delivery->firstname,
                '{delivery_lastname}' => $delivery->lastname,
                '{delivery_address1}' => $delivery->address1,
                '{delivery_address2}' => $delivery->address2,
                '{delivery_city}' => $delivery->city,
                '{delivery_postal_code}' => $delivery->postcode,
                '{delivery_country}' => $delivery->country,
                '{delivery_state}' => $delivery->id_state ? $delivery_state->name : '',
                '{delivery_phone}' => ($delivery->phone) ? $delivery->phone : $delivery->phone_mobile,
                '{delivery_other}' => $delivery->other,
                '{invoice_company}' => $invoice->company,
                '{invoice_vat_number}' => $invoice->vat_number,
                '{invoice_firstname}' => $invoice->firstname,
                '{invoice_lastname}' => $invoice->lastname,
                '{invoice_address2}' => $invoice->address2,
                '{invoice_address1}' => $invoice->address1,
                '{invoice_city}' => $invoice->city,
                '{invoice_postal_code}' => $invoice->postcode,
                '{invoice_country}' => $invoice->country,
                '{invoice_state}' => $invoice->id_state ? $invoice_state->name : '',
                '{invoice_phone}' => ($invoice->phone) ? $invoice->phone : $invoice->phone_mobile,
                '{invoice_other}' => $invoice->other,
                '{order_name}' => $order->getUniqReference(),
                '{date}' => Tools::displayDate(date('Y-m-d H:i:s'), null, 1),
                '{carrier}' => $this->getOrderCarrierName($order, $carrier),
                '{payment}' => Tools::substr($order->payment, 0, 32),
                '{products}' => self::$order_confirmation_email_variables['products'],
                '{products_txt}' => self::$order_confirmation_email_variables['products_txt'],
                '{discounts}' => self::$order_confirmation_email_variables['discounts'],
                '{discounts_txt}' => self::$order_confirmation_email_variables['discounts_txt'],
                '{total_paid}' => Tools::displayPrice($order->total_paid, $this->context->currency, false),
                '{total_products}' => Tools::displayPrice(Product::getTaxCalculationMethod() == PS_TAX_EXC ? $order->total_products : $order->total_products_wt, $this->context->currency, false),
                '{total_discounts}' => Tools::displayPrice($order->total_discounts, $this->context->currency, false),
                '{total_shipping}' => Tools::displayPrice($order->total_shipping, $this->context->currency, false),
                '{total_wrapping}' => Tools::displayPrice($order->total_wrapping, $this->context->currency, false),
                '{total_tax_paid}' => Tools::displayPrice(($order->total_products_wt - $order->total_products) + ($order->total_shipping_tax_incl - $order->total_shipping_tax_excl), $this->context->currency, false));
            if (is_array($this->extra_vars)) {
                $data = array_merge($data, $this->extra_vars);
            }
            $file_attachement = $this->getFileAttachement($this->order_state, $order);
            if (Validate::isEmail($this->context->customer->email)) {
                Mail::Send((int) $order->id_lang, 'order_conf', Mail::l('Order confirmation', (int) $order->id_lang), $data, $this->context->customer->email, $this->context->customer->firstname . ' ' . $this->context->customer->lastname, null, null, $file_attachement, null, _PS_MAIL_DIR_, false, (int) $order->id_shop);
            }
        }

        /**
         * @param OrderState $order_state
         * @param Order $order
         * @return array
         * <pre>
         *  array(
         *   'content' => string,
         *   'name' => string,
         *   'mine' => string
         *  )
         */
        protected function getFileAttachement(OrderState $order_state, Order $order)
        {
            $file_attachement = array();
            if ((int) Configuration::get('PS_INVOICE') && $order_state->invoice && $order->invoice_number) {
                $order_invoice_list = $order->getInvoicesCollection();
                Hook::exec('actionPDFInvoiceRender', array('order_invoice_list' => $order_invoice_list));
                $pdf = new PDF($order_invoice_list, PDF::TEMPLATE_INVOICE, $this->context->smarty);
                $file_attachement['content'] = $pdf->render(false);
                $file_attachement['name'] = Configuration::get('PS_INVOICE_PREFIX', (int) $order->id_lang, null, $order->id_shop) . sprintf('%06d', $order->invoice_number) . '.pdf';
                $file_attachement['mime'] = 'application/pdf';
            }

            return $file_attachement;
        }

        /**
         *
         * @param Carrier $carrier
         */
        protected function getOrderCarrierName(Order $order, Carrier $carrier)
        {
            $virtual_product = $this->isVirtualOrder($order);
            return ($virtual_product || !isset($carrier->name)) ? Tools::displayError('No carrier') : $carrier->name;
        }

        /**
         *
         * @param Order $order
         */
        protected function prepareProductListTemplateVariables(Order $order)
        {
            $product_var_tpl_list = array();
            foreach ($order->product_list as $product) {
                $price = Product::getPriceStatic((int) $product['id_product'], false, ($product['id_product_attribute'] ? (int) $product['id_product_attribute'] : null), 6, null, false, true, $product['cart_quantity'], false, (int) $order->id_customer, (int) $order->id_cart, (int) $order->{Configuration::get('PS_TAX_ADDRESS_TYPE')});
                $price_wt = Product::getPriceStatic((int) $product['id_product'], true, ($product['id_product_attribute'] ? (int) $product['id_product_attribute'] : null), 2, null, false, true, $product['cart_quantity'], false, (int) $order->id_customer, (int) $order->id_cart, (int) $order->{Configuration::get('PS_TAX_ADDRESS_TYPE')});
                $product_price = Product::getTaxCalculationMethod() == PS_TAX_EXC ? Tools::ps_round($price, 2) : $price_wt;
                $product_var_tpl = array(
                    'reference' => $product['reference'],
                    'name' => $product['name'] . (isset($product['attributes']) ? ' - ' . $product['attributes'] : ''),
                    'unit_price' => Tools::displayPrice($product_price, $this->context->currency, false),
                    'price' => Tools::displayPrice($product_price * $product['quantity'], $this->context->currency, false),
                    'quantity' => $product['quantity'],
                    'customization' => array()
                );
                $customized_datas = Product::getAllCustomizedDatas((int) $order->id_cart);
                if (isset($customized_datas[$product['id_product']][$product['id_product_attribute']])) {
                    $product_var_tpl['customization'] = array();
                    foreach ($customized_datas[$product['id_product']][$product['id_product_attribute']][$order->id_address_delivery] as $customization) {
                        $customization_text = '';
                        if (isset($customization['datas'][Product::CUSTOMIZE_TEXTFIELD])) {
                            foreach ($customization['datas'][Product::CUSTOMIZE_TEXTFIELD] as $text) {
                                $customization_text .= $text['name'] . ': ' . $text['value'] . '<br />';
                            }
                        }
                        if (isset($customization['datas'][Product::CUSTOMIZE_FILE])) {
                            $customization_text .= sprintf(Tools::displayError('%d image(s)'), count($customization['datas'][Product::CUSTOMIZE_FILE])) . '<br />';
                        }
                        $customization_quantity = (int) $product['customization_quantity'];
                        $product_var_tpl['customization'][] = array(
                            'customization_text' => $customization_text,
                            'customization_quantity' => $customization_quantity,
                            'quantity' => Tools::displayPrice($customization_quantity * $product_price, $this->context->currency, false)
                        );
                    }
                }
                $product_var_tpl_list[] = $product_var_tpl;
            }
            $product_list_txt = '';
            $product_list_html = '';
            if (count($product_var_tpl_list) > 0) {
                $product_list_txt = $this->getEmailTemplateContent('order_conf_product_list.txt', Mail::TYPE_TEXT, $product_var_tpl_list);
                $product_list_html = $this->getEmailTemplateContent('order_conf_product_list.tpl', Mail::TYPE_HTML, $product_var_tpl_list);
            }
            self::$order_confirmation_email_variables['products'] = $product_list_html;
            self::$order_confirmation_email_variables['products_txt'] = $product_list_txt;
        }

        /**
         *
         * @param Order $order
         */
        protected function updateShopStock(Order $order)
        {
            $product_list = $order->getProducts();
            foreach ($product_list as $product) {
                // if the available quantities depends on the physical stock
                if (StockAvailable::dependsOnStock($product['product_id'])) {
                    // synchronizes
                    StockAvailable::synchronize($product['product_id'], $order->id_shop);
                }
            }
        }

        /**
         * This is similar to Cart::isVirtualCart(), Order::isVirtual(), but we can't override Order::isVirtual()
         * Order::isVirtual() bases on product_download
         * But when validateOrder(), we just need to check $product->is_virtual
         */
        protected function isVirtualOrder(Order $order)
        {
            $virtual_product = true;
            foreach ($order->product_list as $product) {
                $virtual_product &= $product['is_virtual'];
            }
            return $virtual_product;
        }

        /**
         *
         * @param int $id_delivery_address delivery address
         * @param array $package
         * <pre>
         * array(
         *  'product_list' => array(...),// id_product
         *  'carrier_list' => array(...),// id_carrier
         *  'warehouse_list' => array(...), // id_warehouse
         *  'id_warehouse' => int,// int,
         *  'id_carrier' => int
         * )
         * @return Order
         */
        protected function createOrder($id_delivery_address, array $package)
        {
            $order = new Order();
            $order->product_list = $package['product_list'];
            $carrier = $this->getPackageCarrier($package);
            $id_carrier = (int) $carrier->id;
            $order->id_carrier = $id_carrier;
            $order->id_customer = (int) $this->context->cart->id_customer;
            $order->id_address_invoice = (int) $this->context->cart->id_address_invoice;
            $order->id_address_delivery = (int) $id_delivery_address;
            $order->id_currency = $this->context->currency->id;
            $order->id_lang = (int) $this->context->cart->id_lang;
            $order->id_cart = (int) $this->context->cart->id;
            $order->reference = $this->currentOrderReference;
            $order->id_shop = (int) $this->context->shop->id;
            $order->id_shop_group = (int) $this->context->shop->id_shop_group;

            $order->secure_key = ($this->secure_key ? pSQL($this->secure_key) : pSQL($this->context->customer->secure_key));
            $order->payment = $this->payment_method;
            if (isset($this->name)) {
                $order->module = $this->name;
            }
            $order->recyclable = $this->context->cart->recyclable;
            $order->gift = (int) $this->context->cart->gift;
            $order->gift_message = $this->context->cart->gift_message;
            $order->mobile_theme = $this->context->cart->mobile_theme;
            $order->conversion_rate = $this->context->currency->conversion_rate;
            $order->total_paid_real = 0;

            $order->total_products = (float) $this->context->cart->getOrderTotal(false, Cart::ONLY_PRODUCTS, $order->product_list, $id_carrier);
            $order->total_products_wt = (float) $this->context->cart->getOrderTotal(true, Cart::ONLY_PRODUCTS, $order->product_list, $id_carrier);
            $order->total_discounts_tax_excl = (float) abs($this->context->cart->getOrderTotal(false, Cart::ONLY_DISCOUNTS, $order->product_list, $id_carrier));
            $order->total_discounts_tax_incl = (float) abs($this->context->cart->getOrderTotal(true, Cart::ONLY_DISCOUNTS, $order->product_list, $id_carrier));
            $order->total_discounts = $order->total_discounts_tax_incl;

            $order->total_shipping_tax_excl = (float) $this->context->cart->getPackageShippingCost((int) $id_carrier, false, null, $order->product_list);
            $order->total_shipping_tax_incl = (float) $this->context->cart->getPackageShippingCost((int) $id_carrier, true, null, $order->product_list);
            $order->total_shipping = $order->total_shipping_tax_incl;

            if (!is_null($carrier) && Validate::isLoadedObject($carrier)) {
                $order->carrier_tax_rate = $carrier->getTaxesRate(new Address((int) $this->context->cart->{Configuration::get('PS_TAX_ADDRESS_TYPE')}));
            }

            $order->total_wrapping_tax_excl = (float) abs($this->context->cart->getOrderTotal(false, Cart::ONLY_WRAPPING, $order->product_list, $id_carrier));
            $order->total_wrapping_tax_incl = (float) abs($this->context->cart->getOrderTotal(true, Cart::ONLY_WRAPPING, $order->product_list, $id_carrier));
            $order->total_wrapping = $order->total_wrapping_tax_incl;

            $order->total_paid_tax_excl = (float) Tools::ps_round((float) $this->context->cart->getOrderTotal(false, Cart::BOTH, $order->product_list, $id_carrier), _PS_PRICE_COMPUTE_PRECISION_);
            $order->total_paid_tax_incl = (float) Tools::ps_round((float) $this->context->cart->getOrderTotal(true, Cart::BOTH, $order->product_list, $id_carrier), _PS_PRICE_COMPUTE_PRECISION_);
            $order->total_paid = $order->total_paid_tax_incl;
            $order->round_mode = Configuration::get('PS_PRICE_ROUND_MODE');
            $order->round_type = Configuration::get('PS_ROUND_TYPE');
            $order->invoice_date = '0000-00-00 00:00:00';
            $order->delivery_date = '0000-00-00 00:00:00';
            $order->add();
            if (!Validate::isLoadedObject($order)) {
                PrestaShopLogger::addLog('PaymentModule::validateOrder - Order cannot be created', 3, null, 'Cart', (int) $this->context->cart->id, true);
                throw new PrestaShopException('Can\'t save Order');
            }
            $this->addOrderDetails($order, $package);
            $this->addOrderCarrier($order, $package);

            return $order;
        }

        /**
         *
         * @param Order $order
         */
        protected function executeHookActionValidateOrder(Order $order)
        {
            Hook::exec('actionValidateOrder', array(
                'cart' => $this->context->cart,
                'order' => $order,
                'customer' => $this->context->customer,
                'currency' => $this->context->currency,
                'orderStatus' => $this->order_state
            ));
        }

        /**
         *
         * @param int $id_cart
         * @param int $special_currency
         * @param boolean $shop
         */
        protected function initContext($id_cart, $special_currency = null, Shop $shop = null)
        {
            if (!isset($this->context)) {
                $this->context = Context::getContext();
            }
            $this->context->cart = new Cart((int) $id_cart);
            $this->context->customer = new Customer((int) $this->context->cart->id_customer);
            // The tax cart is loaded before the customer so re-cache the tax calculation method
            $this->context->cart->setTaxCalculationMethod();

            $this->context->language = new Language((int) $this->context->cart->id_lang);
            $this->context->shop = ($shop ? $shop : new Shop((int) $this->context->cart->id_shop));
            ShopUrl::resetMainDomainCache();
            $id_currency = $special_currency ? (int) $special_currency : (int) $this->context->cart->id_currency;
            $this->context->currency = new Currency((int) $id_currency, null, (int) $this->context->shop->id);
        }

        protected function verifyOrderState()
        {
            if (!Validate::isLoadedObject($this->order_state)) {
                PrestaShopLogger::addLog('PaymentModule::validateOrder - Order Status cannot be loaded', 3, null, 'Cart', (int) $this->context->cart->id, true);
                die(Tools::displayError('Order Status cannot be loaded'));
            }
        }

        /**
         * Verify if a country is active or not
         * @param int $id_country
         * @throws PrestaShopException
         */
        protected function verifyCountry($id_country)
        {
            if (Configuration::get('PS_TAX_ADDRESS_TYPE') == 'id_address_delivery') {
                $this->context->country = new Country((int) $id_country, (int) $this->context->cart->id_lang);
                if (!$this->context->country->active) {
                    throw new PrestaShopException('The delivery address country is not active.');
                }
            }
        }

        /**
         *
         * @return string
         */
        protected function generateReference()
        {
            do {
                $reference = Order::generateReference();
            } while (Order::getByReference($reference)->count());
            return $reference;
        }

        /**
         * If a cart rules is not valid, remove them from shopping cart
         */
        protected function cleanUpCartRules()
        {
            // Make sure CartRule caches are empty
            CartRule::cleanCache();
            $cart_rules = $this->context->cart->getCartRules();
            foreach ($cart_rules as $cart_rule) {
                if (($rule = new CartRule((int) $cart_rule['obj']->id)) && Validate::isLoadedObject($rule)) {
                    if ($error = $rule->checkValidity($this->context, true, true)) {
                        $this->context->cart->removeCartRule((int) $rule->id);
                        if (isset($this->context->cookie) && isset($this->context->cookie->id_customer) && $this->context->cookie->id_customer && !empty($rule->code)) {
                            if (Configuration::get('PS_ORDER_PROCESS_TYPE') == 1) {
                                Tools::redirect('index.php?controller=order-opc&submitAddDiscount=1&discount_name=' . urlencode($rule->code));
                            }
                            Tools::redirect('index.php?controller=order&submitAddDiscount=1&discount_name=' . urlencode($rule->code));
                        } else {
                            $rule_name = isset($rule->name[(int) $this->context->cart->id_lang]) ? $rule->name[(int) $this->context->cart->id_lang] : $rule->code;
                            $error = sprintf(Tools::displayError('CartRule ID %1s (%2s) used in this cart is not valid and has been withdrawn from cart'), (int) $rule->id, $rule_name);
                            PrestaShopLogger::addLog($error, 3, '0000002', 'Cart', (int) $this->context->cart->id);
                        }
                    }
                }
            }
        }

        /**
         *
         * @param array $package
         * <pre>
         * array(
         *  'product_list' => array(...),// id_roduct
         *  'carrier_list' => array(...),// id_carrier
         *  'warehouse_list' => array(...), // id_warehouse
         *  'id_warehouse' => int,// int,
         *  'id_carrier' => int
         * )
         * @return Carrier
         */
        protected function getPackageCarrier(array $package)
        {
            $carrier = new Carrier();
            if (!$this->context->cart->isVirtualCart() && isset($package['id_carrier'])) {
                $carrier = new Carrier((int) $package['id_carrier'], (int) $this->context->cart->id_lang);
            }
            return $carrier;
        }

        /**
         *
         * @return array // see Cart::getPackageList()
         */
        protected function getDeliveryPackages()
        {
            $delivery_option_list = $this->context->cart->getDeliveryOptionList();
            $packages = $this->context->cart->getPackageList();
            $selected_delivery_option = $this->context->cart->getDeliveryOption();

            // If some delivery options are not defined, or not valid, use the first valid option
            foreach ($delivery_option_list as $id_address => $packages_by_address) {
                if (!isset($selected_delivery_option[$id_address]) || !array_key_exists($selected_delivery_option[$id_address], $packages_by_address)) {
                    $packages_by_id_address = array_keys($packages_by_address);
                    foreach ($packages_by_id_address as $key) {
                        $selected_delivery_option[$id_address] = $key;
                        break;
                    }
                }
            }
            foreach ($selected_delivery_option as $id_address => $key_carriers) {
                foreach ($delivery_option_list[$id_address][$key_carriers]['carrier_list'] as $id_carrier => $data) {
                    foreach ($data['package_list'] as $id_package) {
                        // Rewrite the id_warehouse
                        $packages[$id_address][$id_package]['id_warehouse'] = (int) $this->context->cart->getPackageIdWarehouse($packages[$id_address][$id_package], (int) $id_carrier);
                        $packages[$id_address][$id_package]['id_carrier'] = $id_carrier;
                    }
                }
            }
            return $packages;
        }

        protected function verifyModuleStatus()
        {
            if (!$this->active) {
                PrestaShopLogger::addLog('PaymentModule::validateOrder - Module is not active', 3, null, 'Cart', (int) $this->context->cart->id, true);
                die(Tools::displayError());
            }
        }

        protected function verifyCartStatus()
        {
            if (!Validate::isLoadedObject($this->context->cart) || $this->context->cart->OrderExists()) {
                $error = Tools::displayError('Cart cannot be loaded or an order has already been placed using this cart');
                PrestaShopLogger::addLog($error, 4, '0000001', 'Cart', (int) $this->context->cart->id);
                die($error);
            }
        }

        protected function verifySecureKey()
        {
            if ($this->secure_key !== false && $this->secure_key != $this->context->cart->secure_key) {
                PrestaShopLogger::addLog('PaymentModule::validateOrder - Secure key does not match', 3, null, 'Cart', (int) $this->context->cart->id, true);
                die(Tools::displayError());
            }
        }

        /**
         * If the paid amount is different from the cart total, an order is considered as ERROR
         * @return int
         */
        protected function getIdOrderStateBasedOnPaidAmount()
        {
            $id_order_state = $this->order_state->id;
            $paid_cart_total = (float) Tools::ps_round((float) $this->context->cart->getOrderTotal(true, Cart::BOTH), 2);
            if ($this->order_state->logable && number_format($paid_cart_total, _PS_PRICE_COMPUTE_PRECISION_) != number_format($this->paid_amount, _PS_PRICE_COMPUTE_PRECISION_)) {
                $id_order_state = (int) Configuration::get('PS_OS_ERROR');
            }
            return $id_order_state;
        }

        /**
         *
         * @param Order $order
         * @return array
         * <pre>
         * array(
         *  'id_carrier' => int,
         *  'id_address' => int,
         *  'products' => array
         * )
         */
        protected function rebuildDeliveryPackageFromOrder(Order $order)
        {
            return array(
                'id_carrier' => $order->id_carrier,
                'id_address' => $order->id_address_delivery,
                'products' => $order->product_list
            );
        }

        /**
         *
         * @param Order $order
         * @param CartRule $cart_rule
         * @param float $reduction_amount
         */
        protected function createNewCartRuleIfPartialUse(Order $order, CartRule $cart_rule, $reduction_amount)
        {
            $voucher = new CartRule((int) $cart_rule->id); // We need to instantiate the CartRule without lang parameter to allow saving it
            unset($voucher->id);
            $voucher->code = empty($voucher->code) ? Tools::substr(md5($order->id . '-' . $order->id_customer . '-' . $cart_rule->id), 0, 16) : $voucher->code . '-2';
            if (preg_match('/\-([0-9]{1,2})\-([0-9]{1,2})$/', $voucher->code, $matches) && $matches[1] == $matches[2]) {
                $voucher->code = preg_replace('/' . $matches[0] . '$/', '-' . ((int) $matches[1] + 1), $voucher->code);
            }
            $voucher->reduction_amount = $reduction_amount;
            if ($this->context->customer->isGuest()) {
                $voucher->id_customer = 0;
            } else {
                $voucher->id_customer = $order->id_customer;
            }
            $voucher->quantity = 1;
            $voucher->reduction_currency = $order->id_currency;
            $voucher->quantity_per_user = 1;
            $voucher->free_shipping = 0;
            if ($voucher->add()) {
                // If the voucher has conditions, they are now copied to the new voucher
                CartRule::copyConditions($cart_rule->id, $voucher->id);
                $params = array(
                    '{voucher_amount}' => Tools::displayPrice($voucher->reduction_amount, $this->context->currency, false),
                    '{voucher_num}' => $voucher->code,
                    '{firstname}' => $this->context->customer->firstname,
                    '{lastname}' => $this->context->customer->lastname,
                    '{id_order}' => $order->reference,
                    '{order_name}' => $order->getUniqReference()
                );
                Mail::Send((int) $order->id_lang, 'voucher', sprintf(Mail::l('New voucher for your order %s', (int) $order->id_lang), $order->reference), $params, $this->context->customer->email, $this->context->customer->firstname . ' ' . $this->context->customer->lastname, null, null, null, null, _PS_MAIL_DIR_, false, (int) $order->id_shop);
            }
        }

        /**
         *
         * @param Order $order
         * @param CartRule $cart_rule
         * @param array $used_voucher_values
         * <pre>
         * array(
         *  'tax_incl' => float,
         *  'tax_excl' => float
         * )
         */
        protected function attachCartRuleToOrder(Order $order, CartRule $cart_rule, array $used_voucher_values)
        {
            $order->addCartRule($cart_rule->id, $cart_rule->name, $used_voucher_values, 0, $cart_rule->free_shipping);
            if (self::$id_order_state != Configuration::get('PS_OS_ERROR') && self::$id_order_state != Configuration::get('PS_OS_CANCELED') && !in_array($cart_rule->id, self::$used_cart_rules)) {
                self::$used_cart_rules[] = $cart_rule->id;
                // Create a new instance of Cart Rule without id_lang, in order to update its quantity
                $cart_rule_to_update = new CartRule((int) $cart_rule->id);
                $cart_rule_to_update->quantity = max(0, $cart_rule_to_update->quantity - 1);
                $cart_rule_to_update->update();
            }
        }
    }
}
