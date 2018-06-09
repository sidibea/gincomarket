CREATE TABLE IF NOT EXISTS `PREFIX_agilepaypaladaptive_txn` (
      `id_agilepaypaladaptive_txn` bigint(11) AUTO_INCREMENT NOT NULL,
      `id_cart` bigint(11) NULL,
      `id_order` bigint(11) NULL,
      `id_currency` bigint(11) NULL,
      `payer_email` varchar(256) NULL,
      `paykey` varchar(256) NULL,
      `paymode` tinyint(2) NULL,
      `amount` float(16,2) NULL,
      `status` varchar(128) NULL,
      `remark` varchar(1024) NULL,      
      `date_add` datetime NOT NULL,
      `date_upd` datetime NOT NULL,
      PRIMARY KEY (`id_agilepaypaladaptive_txn`)
    ) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `PREFIX_agilepaypaladaptive_txndetail` (
      `id_agilepaypaladaptive_txndetail` bigint(11) AUTO_INCREMENT NOT NULL,
      `id_cart` bigint(11) NULL,
      `id_seller` bigint(11) NULL,
      `paykey` varchar(256) NULL,
      `receiver_email` varchar(256) NULL,
      `amount` float(16,2) NULL,
      `id_currency` int(11) NULL,
      `record_type` bigint(11) NULL,
      `is_primary` tinyint(1) NULL,
      `paypal_txnid` varchar(128) NULL,
      `status` varchar(128) NULL,
      `date_add` datetime NOT NULL,
      `date_upd` datetime NOT NULL,
      PRIMARY KEY (`id_agilepaypaladaptive_txndetail`)
    ) DEFAULT CHARSET=utf8;