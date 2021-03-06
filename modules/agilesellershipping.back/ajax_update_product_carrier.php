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
require_once(dirname(__FILE__).'/agilesellershipping.php');
require_once(dirname(__FILE__).'/SellerShipping.php');
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

$mymodule = new AgileSellerShipping();


$id_cart = intval(Tools::getValue('id_cart'));
$id_product = intval(Tools::getValue('id_product'));
$id_product_attribute = intval(Tools::getValue('id_product_attribute'));
$id_carrier = intval(Tools::getValue('id_carrier'));
$id_location = intval(Tools::getValue('id_location'));


SellerShipping::updateCartCarrierForProduct($id_cart,$id_product,$id_product_attribute,$id_carrier,$id_location);
if(Module::isInstalled('agilepickupcenter') 
	&& $id_carrier == intval(Configuration::getGlobalValue('AGILE_PICKUPCENTER_CARRIER_ID')) 
	&& intval($id_location) == 0)
{
	echo $mymodule->hookPickupLocations(
		array('id_cart'=>$id_cart, 'id_product'=>$id_product,'id_carrier'=>$id_carrier,'id_location'=>$id_location,'id_product_attribute' => $id_product_attribute)
	);

}
die('');
