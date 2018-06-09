<?php
/**
 * MobiCommerce
 *
 * @author    MobiCommerce
 * @copyright Copyright (c) MobiCommerce 2017
 * @license   Free license
 */

$sql = array();
$sql[] = "
	DROP TABLE IF EXISTS `"._DB_PREFIX_."mobicommerce_licence`;
	DROP TABLE IF EXISTS `"._DB_PREFIX_."mobicommerce_applications3`;
	DROP TABLE IF EXISTS `"._DB_PREFIX_."mobicommerce_applications_settings3`;
	DROP TABLE IF EXISTS `"._DB_PREFIX_."mobicommerce_category_icon3`;
	DROP TABLE IF EXISTS `"._DB_PREFIX_."mobicommerce_widget3`;
	DROP TABLE IF EXISTS `"._DB_PREFIX_."mobicommerce_category_widget3`;
	DROP TABLE IF EXISTS `"._DB_PREFIX_."mobicommerce_notification`;
	DROP TABLE IF EXISTS `"._DB_PREFIX_."mobicommerce_devicetokens`;
	DROP TABLE IF EXISTS `"._DB_PREFIX_."mobicommerce_pushhistory`;";
