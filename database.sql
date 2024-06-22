-- Bảng products

CREATE TABLE IF NOT EXISTS `products`(
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `description` varchar(255) NOT NULL,
    `price` int(11) NOT NULL,
    `category_id`int(11) NOT NULL,
    `created` datetime NOT NULL,
    `modified` datetime NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=myISAM DEFAULT CHARSET=latin1; AUTO_INCREMENT=38 ;

-- bảng categories 

CREATE TABLE IF NOT EXISTS `categories`(
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `created` datetime NOT NULL,
    `modified` datetime NOT NULL,
    PRIMARY KEY (`id`)
)ENGINE=myISAM DEFAULT CHARSET=utf8; AUTO_INCREMENT=4;

-- BẢNG HISTORY ACCTIONS --------------------------------

CREATE TABLE IF NOT EXISTS `history_actions`(
    `id` int(11) NOT NULL,
    `action` varchar(255) NOT NULL,
    `created` datetime NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=myISAM CHARSET=latin1;