<?php
///-build_id: 2016071823.0745
/// This source file is subject to the Software License Agreement that is bundled with this 
/// package in the file license.txt, or you can get it here
/// http://addons-modules.com/en/content/3-terms-and-conditions-of-use
///
/// @copyright  2009-2012 Addons-Modules.com
///  If you need open code to customize or merge code with othe modules, please contact us.
require_once(dirname(__FILE__).'/../../config/config.inc.php');
require_once(dirname(__FILE__).'/../../init.php');
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

if($cookie->id_customer)
{
    $customer = new Customer($cookie->id_customer);
    $taxCalculationMethod = Group::getPriceDisplayMethod((int)($customer->id_default_group));
}
else
{
    $taxCalculationMethod = Group::getDefaultPriceDisplayMethod();
}

if($taxCalculationMethod == PS_TAX_EXC)
{
    $shipping_price = $cart->getOrderShippingCost(NULL,false); 
    die('<span class="price">' . Tools::displayPrice($shipping_price) . '</span>(tax excl.)');
}
else
{
    $shipping_price = $cart->getOrderShippingCost(); 
    die('<span class="price">' . Tools::displayPrice($shipping_price) . '</span>(tax incl.)');
}

