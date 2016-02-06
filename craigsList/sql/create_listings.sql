CREATE TABLE `listings` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `url` varchar(256) NOT NULL,
  `title` varchar(256) NOT NULL,
  `price` int(11) DEFAULT NULL,
  `date_posted` varchar(20) DEFAULT NULL,
  `location` varchar(50) DEFAULT NULL,
  `pictures` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
 UNIQUE KEY `url` (`url`)
) 