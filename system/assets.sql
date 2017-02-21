DROP TABLE IF EXISTS `assets`;
CREATE TABLE `assets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) NOT NULL,
  `installed` date NOT NULL,
  `removed` date DEFAULT NULL,
  `seriel_no` varchar(50) NOT NULL,
  `vendor` varchar(45) DEFAULT NULL,
  `voltages` varchar(45) DEFAULT NULL,
  `feedback` varchar(500) DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `assets_grid_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`,`assets_grid_id`),
  KEY `fk_assets_assets_grid_idx` (`assets_grid_id`),
  CONSTRAINT `fk_assets_assets_grid`
  FOREIGN KEY (`assets_grid_id`)
  REFERENCES `assets_grid` (`id`)
  ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `assets_grid`;
CREATE TABLE `assets_grid` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `block_number` double NOT NULL,
  `row_number` double NOT NULL,
  `table_number` double NOT NULL,
  `panel_number` double NOT NULL,
  `panel_position` double NOT NULL,
  `vacent` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `username_UNIQUE` (`password`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
