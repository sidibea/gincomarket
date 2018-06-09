CREATE TABLE IF NOT EXISTS `PREFIX_agile_sellershipping` (
      `id_agile_sellershipping` bigint(11) unsigned NOT NULL auto_increment,
      `id_seller` bigint(11) NULL,
      `shipping_method` tinyint(1) NULL,
      `shipping_free_price` float NULL,
      `shipping_free_weight` float NULL,
      `status` int NOT NULL default 0,
      `date_end` datetime NULL,
      PRIMARY KEY (`id_agile_sellershipping`)
    ) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `PREFIX_agile_cartcarrier` (
      `id_cart` bigint(11) NOT NULL,
      `id_product` bigint(11) NOT NULL,
      `id_product_attribute` bigint(11) NULL,
      `id_carrier` bigint(11) NULL,
      `date_add` datetime NULL,
      PRIMARY KEY (`id_cart`,`id_product`)
    ) DEFAULT CHARSET=utf8;

ALTER TABLE `PREFIX_agile_cartcarrier` DROP PRIMARY KEY, ADD PRIMARY KEY(`id_cart`,`id_product`,`id_product_attribute`);
