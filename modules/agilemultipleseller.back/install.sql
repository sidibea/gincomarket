CREATE TABLE IF NOT EXISTS `PREFIX_category_owner` (
  `id_category_owner` bigint(11) AUTO_INCREMENT NOT NULL,
  `id_category` bigint(11) NULL,
  `id_owner` bigint(11) NULL,
  `date_add` datetime NOT NULL,
  PRIMARY KEY (`id_category_owner`)
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `PREFIX_product_owner` (
  `id_product_owner` bigint(11) AUTO_INCREMENT NOT NULL,
  `id_product` bigint(11) NULL,
  `id_owner` bigint(11) NULL,
  `date_add` datetime NOT NULL,
  PRIMARY KEY (`id_product_owner`)
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `PREFIX_order_owner` (
  `id_order_owner` bigint(11) AUTO_INCREMENT NOT NULL,
  `id_order` bigint(11) NULL,
  `id_owner` bigint(11) NULL,
  `date_add` datetime NOT NULL,
  PRIMARY KEY (`id_order_owner`)
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `PREFIX_customer_owner` (
  `id_customer_owner` bigint(11) AUTO_INCREMENT NOT NULL,
  `id_customer` bigint(11) NULL,
  `id_owner` bigint(11) NULL,
  `date_add` datetime NOT NULL,
  PRIMARY KEY (`id_customer_owner`)
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `PREFIX_agile_seller_paymentinfo` (
  `id_agile_seller_paymentinfo` bigint(11) AUTO_INCREMENT NOT NULL,
  `id_seller` bigint(11) NULL,
  `module_name` varchar(256) NULL,
  `id_currency` int(10) NULL,
  `info1` varchar(1024) NULL,
  `info2` varchar(1024) NULL,
  `info3` varchar(1024) NULL,
  `info4` varchar(1024) NULL,
  `info5` varchar(1024) NULL,
  `info6` varchar(1024) NULL,
  `info7` varchar(1024) NULL,
  `info8` varchar(1024) NULL,
  `date_add` datetime NOT NULL,
  PRIMARY KEY (`id_agile_seller_paymentinfo`)
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `PREFIX_cms_owner` (
  `id_cms_owner` bigint(11) AUTO_INCREMENT NOT NULL,
  `id_cms` bigint(11) NULL,
  `id_owner` bigint(11) NULL,
  `date_add` datetime NOT NULL,
  PRIMARY KEY (`id_cms_owner`)
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `PREFIX_sellerinfo` (
  `id_sellerinfo` bigint(11) AUTO_INCREMENT NOT NULL,
  `id_seller` bigint(11) NULL,
  `company` varchar(256) NULL,
  `id_country` int(10) unsigned NOT NULL,
  `id_state` int(10) unsigned DEFAULT NULL,
  `address1` varchar(128) DEFAULT NULL,
  `address2` varchar(128) DEFAULT NULL,
  `postcode` varchar(12) DEFAULT NULL,
  `city` varchar(64) DEFAULT NULL,
  `description` text,
  `phone` varchar(16) DEFAULT NULL,
  `fax` varchar(16) DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `date_add` datetime NOT NULL,
  `date_upd` datetime NOT NULL,
  PRIMARY KEY (`id_sellerinfo`),
  KEY `id_country` (`id_country`),
  KEY `id_state` (`id_state`)
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `PREFIX_sellerinfo_lang` (
  `id_sellerinfo_lang` int(10) AUTO_INCREMENT NOT NULL,
  `id_sellerinfo` bigint(11),
  `id_lang` int(10) NULL,
  `company` varchar(256) NULL,
  `description` text,
  `address1` varchar(128) NULL,
  `address2` varchar(128) NULL,
  `city` varchar(64) NULL,
  PRIMARY KEY (`id_sellerinfo_lang`)
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `PREFIX_carrier_owner` (
  `id_carrier_owner` bigint(11) AUTO_INCREMENT NOT NULL,
  `id_carrier` bigint(11) NULL,
  `id_owner` bigint(11) NULL,
  PRIMARY KEY (`id_carrier_owner`)
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `PREFIX_agile_subcart` (
  `id_cart` bigint(11) NOT NULL,
  `id_cart_parent` bigint(11) NULL,
  `id_seller` bigint(11) NULL,
  `id_order` bigint(11) NULL,
  `progress` int(10) NULL,
  `date_add` datetime NOT NULL,
  PRIMARY KEY (`id_cart_parent`,`id_seller`)
)  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `PREFIX_object_owner` (
  `id_object_owner` bigint(11) AUTO_INCREMENT NOT NULL,
  `entity` varchar(256) NULL,
  `id_object` bigint(11) NULL,
  `id_owner` bigint(11) NULL,
  `string1` varchar(256) NULL,
  `string2` varchar(256) NULL,
  `float1` float NULL,
  `float2` float NULL,
  `text1` varchar(256) NULL,
  `datetime1` datetime NOT NULL,
  `date_add` datetime NOT NULL,
  PRIMARY KEY (`id_object_owner`)
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `PREFIX_agile_pageconfig` (
  `id_agile_pageconfig` bigint(11) AUTO_INCREMENT NOT NULL,
  `page_name` varchar(256) NULL,
  `field_name` varchar(256) NULL,
  `allow_level` int(10) NULL,
  PRIMARY KEY (`id_agile_pageconfig`)
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `PREFIX_agileconnection` (
  `id_agileconnection` bigint(11) AUTO_INCREMENT NOT NULL,
  `email` varchar(256) NULL,
  `data` varchar(4000) NULL,
  `date_add` datetime NOT NULL,
  PRIMARY KEY (`id_agileconnection`)
) DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `PREFIX_agile_session` (
  `id` varchar(255) NOT NULL,
  `data` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `time` (`time`)
) DEFAULT CHARSET=utf8;


INSERT INTO PREFIX_object_owner (id_object, entity, id_owner,datetime1, date_add)
SELECT s.id_supplier,'supplier',0,CURDATE(),CURDATE() 
FROM PREFIX_supplier s
left join PREFIX_object_owner oo on s.id_supplier = oo.id_object and oo.entity = 'supplier' 
WHERE oo.id_owner is null;
