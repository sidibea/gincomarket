<?php
///-build_id: 2016030721.4219
/// This source file is subject to the Software License Agreement that is bundled with this 
/// package in the file license.txt, or you can get it here
/// http://addons-modules.com/en/content/3-terms-and-conditions-of-use
///
/// @copyright  2009-2012 Addons-Modules.com
///  If you need open code to customize or merge code with othe modules, please contact us.
include_once(_PS_ADMIN_DIR_.'/../modules/agilepaypaladaptive/AgilePaypalAdaptiveTxn.php');
include_once(_PS_ADMIN_DIR_.'/../modules/agilepaypaladaptive/AgilePaypalAdaptiveTxnDetail.php');

class AgileAdaptiveLogs  extends ModuleAdminController
{
	public function __construct()   {    $this->table = 'agilepaypaladaptive_txn';    $this->className = 'AgilePaypalAdaptiveTxn';    parent::__construct();      $this->bootstrap = true;   $this->lang = false;       $this->addRowAction('view');      $this->fields_list = array(     'id_agilepaypaladaptive_txn' => array('title' => $this->l('Log ID'), 'align' => 'center', 'width' => 25),        'id_cart' => array('title' => $this->l('Cart ID'), 'align' => 'center', 'width' => 60),        'id_order' => array('title' => $this->l('Order ID'), 'align' => 'center', 'width' => 60),        'payer_email' => array('title' => $this->l('Payer Paypal Email'), 'align' => 'center', 'width' => 60),        'paykey' => array('title' => $this->l('Pay Key'), 'width' => 120),        'amount' => array('title' => $this->l('Amount'), 'width' => 60, 'align'=>'right', 'price' => true, 'currency' => true),        'status' => array('title' => $this->l('Status'), 'width' => 60),     'paymode' => array('title' => $this->l('Paymode'), 'width' => 60),     'date_add' => array('title' => $this->l('Date'), 'width' => 70, 'type' => 'datetime','align'=>'right', 'filter_key' => 'a!date_add'),    );   }      public function initToolbar()   {    parent::initToolbar();    unset($this->toolbar_btn['new']);   }      public function renderView()   {    if (!($R602BAA072843820A45861C75C510C77E = $this->loadObject()))return;      $RD551BD4ADB00B19BC636FDF2576AD853 = AgilePaypalAdaptiveTxnDetail::getTxnDetailsByPaykey($R602BAA072843820A45861C75C510C77E->paykey);          $this->tpl_view_vars = array(     'txn_details' => $RD551BD4ADB00B19BC636FDF2576AD853,     );      return parent::renderView();   }   }  