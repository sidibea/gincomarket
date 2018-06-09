CREATE TABLE IF NOT EXISTS `PREFIX_commission_rate` (
      `id_commission_rate` bigint(11) AUTO_INCREMENT NOT NULL,
      `id_seller` bigint(11) NOT NULL,
      `from_amount` float (16,2) NULL,  -- 0 - 0 for base 
      `to_amount` float (16,2) NULL,
      `commission` float (16,2) NULL,
      `date_add` datetime NOT NULL,
      PRIMARY KEY (`id_commission_rate`)
    ) DEFAULT_CHARSET_COLLATION;

CREATE TABLE IF NOT EXISTS `PREFIX_category_commission` (
      `id_category_commission` bigint(11) AUTO_INCREMENT NOT NULL,
      `id_seller` bigint(11) NOT NULL,
      `id_category` bigint(11) NULL, 
      `commission` float (16,2) NULL,
      `date_add` datetime NOT NULL,
      PRIMARY KEY (`id_category_commission`)
    ) DEFAULT_CHARSET_COLLATION;



CREATE TABLE IF NOT EXISTS `PREFIX_base_commission` (
      `id_base_commission` bigint(11) AUTO_INCREMENT NOT NULL,
      `id_seller` bigint(11) NOT NULL,
      `base_commission` float (16,2) NULL,
      `date_add` datetime NOT NULL,
      PRIMARY KEY (`id_base_commission`)
    ) DEFAULT_CHARSET_COLLATION;

CREATE TABLE IF NOT EXISTS `PREFIX_seller_commission` (
      `id_seller_commission` bigint(11) AUTO_INCREMENT NOT NULL,
      `id_seller` bigint(11) NOT NULL,
      `id_order` bigint(11) NULL,
      `id_currency` bigint(11) NULL,
      `sales_amount` float (16,2) NULL,
      `base_commission` float (16,2) NULL,
      `range_commission` float (16,2) NULL,
      `seller_sales` float (16,2) NULL,
      `record_balance` float (16,2) NULL,
      `payment_txn_id` varchar(256) NULL,
      `record_type` int (10) NULL,
      `balance` float (16,2) NULL,
      `memo` varchar(2000) NULL,
      `date_add` datetime NOT NULL,
      PRIMARY KEY (`id_seller_commission`)
    ) DEFAULT_CHARSET_COLLATION;