<?php
/**
 * @author    G2A Team
 * @copyright Copyright (c) 2016 G2A.COM
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
require_once dirname(__FILE__) . '/../../classes/G2APayIpn.php';

/**
 * @property G2APay $module
 */
class G2APayIpnModuleFrontController extends ModuleFrontController
{
    /**
     * @var G2APayIpn
     */
    protected $ipn;

    public function __construct()
    {
        parent::__construct();

        $this->ipn = new G2APayIpn($this->module->getConfig(), $this->module);
    }

    public function postProcess()
    {
        $data = [
            'transactionId'   => Tools::getValue('transactionId'),
            'userOrderId'     => Tools::getValue('userOrderId'),
            'amount'          => Tools::getValue('amount'),
            'status'          => Tools::getValue('status'),
            'currency'        => Tools::getValue('currency'),
            'orderCreatedAt'  => Tools::getValue('orderCreatedAt'),
            'orderCompleteAt' => Tools::getValue('orderCompleteAt'),
            'refundedAmount'  => Tools::getValue('refundedAmount'),
            'hash'            => Tools::getValue('hash'),
        ];

        try {
            $this->ipn->validateIpnSecret(Tools::getValue('secret'));
            $order = $this->module->getOrderById($data['userOrderId']);
            $this->ipn->processData($order, $data);
            die('ok');
        } catch (Exception $e) {
            G2APayLog::saveException($e);
            die($this->module->l('Something went wrong.'));
        }
    }
}
