CREATE TABLE IF NOT EXISTS `PREFIX_sellertype` (
  `id_sellertype` int(10) unsigned NOT NULL auto_increment,
  `date_add` datetime NOT NULL,
  PRIMARY KEY (`id_sellertype`)
)  DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `PREFIX_sellertype_lang` (
  `id_sellertype_lang` int(10) unsigned NOT NULL auto_increment,
  `id_sellertype` int(10),
  `id_lang` int(10) NOT NULL,
  `name` varchar(256) NOT NULL,
  PRIMARY KEY (`id_sellertype_lang`)
)  DEFAULT CHARSET=utf8;
