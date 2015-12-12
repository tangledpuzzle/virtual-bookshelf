DROP DATABASE IF EXISTS r2pdb;
CREATE DATABASE r2pdb;
USE r2pdb;

--
-- Community Auth - MySQL table install
--
-- Community Auth is an open source authentication application for CodeIgniter 3
--
-- @package     Community Auth
-- @author      Robert B Gottier
-- @copyright   Copyright (c) 2011 - 2015, Robert B Gottier. (http://brianswebdesign.com/)
-- @license     BSD - http://www.opensource.org/licenses/BSD-3-Clause
-- @link        http://community-auth.com
--

--
-- Table structure for table `ci_session`
--


CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `ai` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  
  PRIMARY KEY (`ai`),
  UNIQUE KEY `ci_sessions_id_ip` (`id`,`ip_address`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ips_on_hold`
--


CREATE TABLE IF NOT EXISTS `ips_on_hold` (
  `ai` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `IP_address` varchar(45) NOT NULL,
  `time` datetime NOT NULL,
  
  PRIMARY KEY (`ai`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `login_errors`
--


CREATE TABLE IF NOT EXISTS `login_errors` (
  `ai` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username_or_email` varchar(255) NOT NULL,
  `IP_address` varchar(45) NOT NULL,
  `time` datetime NOT NULL,
  
  PRIMARY KEY (`ai`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `denied_access`
--


CREATE TABLE IF NOT EXISTS `denied_access` (
  `ai` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `IP_address` varchar(45) NOT NULL,
  `time` datetime NOT NULL,
  `reason_code` tinyint(2) DEFAULT 0,
  
  PRIMARY KEY (`ai`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `username_or_email_on_hold`
--


CREATE TABLE IF NOT EXISTS `username_or_email_on_hold` (
  `ai` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username_or_email` varchar(255) NOT NULL,
  `time` datetime NOT NULL,
  
  PRIMARY KEY (`ai`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------


CREATE TABLE IF NOT EXISTS countries
(
	CountryID SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	CountrySymbol VARCHAR(6) NOT NULL,
	CountryName VARCHAR(128) NOT NULL,
	FlagPath VARCHAR(128)
) ENGINE=INNODB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS genders
(
	GenderID TINYINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	GenderName VARCHAR(128) NOT NULL
) ENGINE=INNODB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS publishers
(
	PublisherID MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	PublisherName VARCHAR(128) NOT NULL
) ENGINE=INNODB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS languages
(
	LanguageID MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	LanguageName VARCHAR(128) NOT NULL
) ENGINE=INNODB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS genres
(
	GenreID MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	GenreName VARCHAR(128) NOT NULL
) ENGINE=INNODB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
	`user_id` int(10) unsigned NOT NULL,
	`user_name` varchar(255) DEFAULT NULL,
	`user_email` varchar(255) NOT NULL,
	`user_pass` varchar(60) NOT NULL,
	`user_salt` varchar(32) NOT NULL,
	`user_last_login` datetime DEFAULT NULL,
	`user_login_time` datetime DEFAULT NULL,
	`user_session_id` varchar(40) DEFAULT NULL,
	`user_date` datetime NOT NULL,
	`user_modified` datetime NOT NULL,
	`user_agent_string` varchar(32) DEFAULT NULL,
	`user_level` tinyint(2) unsigned NOT NULL,
	`user_banned` enum('0','1') NOT NULL DEFAULT '0',
	`passwd_recovery_code` varchar(60) DEFAULT NULL,
	`passwd_recovery_date` datetime DEFAULT NULL,

	FirstName VARCHAR(128) DEFAULT NULL,
	LastName VARCHAR(128) DEFAULT NULL,
	Age INT UNSIGNED DEFAULT NULL,
	GenderID TINYINT UNSIGNED DEFAULT NULL,
	CountryID SMALLINT UNSIGNED DEFAULT NULL,
	ScreenName VARCHAR(128) NOT NULL,
	AvatarPath VARCHAR(128) DEFAULT NULL,
	Bio TEXT DEFAULT NULL,

	PRIMARY KEY (`user_id`),
	UNIQUE KEY `user_name` (`user_name`),
	UNIQUE KEY `user_email` (`user_email`),
	FOREIGN KEY (CountryID) REFERENCES countries(CountryID),
	FOREIGN KEY (GenderID) REFERENCES genders(GenderID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------


CREATE TABLE IF NOT EXISTS comments
(
	CommentID INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	PostDate DATETIME NOT NULL,
	`user_id` INT UNSIGNED NOT NULL,
	Text TEXT NOT NULL,
	
	FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS userComments
(
	`user_id` INT UNSIGNED NOT NULL,
	CommentID INT UNSIGNED NOT NULL,
	
	PRIMARY KEY (`user_id`, CommentID),
	FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`),
	FOREIGN KEY (CommentID) REFERENCES comments(CommentID)
) ENGINE=INNODB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS products
(
	ProductID INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	Name VARCHAR(512) NOT NULL,
	ReleaseDate date DEFAULT NULL,
	ImagePath VARCHAR(128) DEFAULT NULL,
	LanguageID MEDIUMINT UNSIGNED DEFAULT NULL,
	Brief VARCHAR(256) DEFAULT NULL,
	Description TEXT DEFAULT NULL,
	EAN13 BIGINT(13) UNSIGNED ZEROFILL DEFAULT 0,
	PublisherID MEDIUMINT UNSIGNED,
	
	FOREIGN KEY (LanguageID) REFERENCES languages(LanguageID),
	FOREIGN KEY (PublisherID) REFERENCES publishers(PublisherID)
) ENGINE=INNODB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS productComments
(
	ProductID INT UNSIGNED NOT NULL,
	CommentID INT UNSIGNED NOT NULL,
	
	PRIMARY KEY (ProductID, CommentID),
	FOREIGN KEY (ProductID) REFERENCES products(ProductID),
	FOREIGN KEY (CommentID) REFERENCES comments(CommentID)
) ENGINE=INNODB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS productGenres
(
	ProductID INT UNSIGNED NOT NULL,
	GenreID MEDIUMINT UNSIGNED NOT NULL,
	
	PRIMARY KEY (ProductID, GenreID),
	FOREIGN KEY (ProductID) REFERENCES products(ProductID),
	FOREIGN KEY (GenreID) REFERENCES genres(GenreID)
) ENGINE=INNODB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS reviews
(
	ReviewID INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	ReviewDate DATETIME NOT NULL,
	ProductID INT UNSIGNED NOT NULL,
	`user_id` INT UNSIGNED NOT NULL,
	Text TEXT NOT NULL,
	Pros TEXT DEFAULT NULL,
	Cons TEXT DEFAULT NULL,
	Rating TINYINT NOT NULL,
	
	FOREIGN KEY (ProductID) REFERENCES products(ProductID),
	FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS reviewComments
(
	ReviewID INT UNSIGNED NOT NULL,
	CommentID INT UNSIGNED NOT NULL,
	
	PRIMARY KEY (ReviewID, CommentID),
	FOREIGN KEY (ReviewID) REFERENCES reviews(ReviewID),
	FOREIGN KEY (CommentID) REFERENCES comments(CommentID)
) ENGINE=INNODB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS collections
(
	CollectionID INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	CollectionName VARCHAR(128) NOT NULL
) ENGINE=INNODB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS userCollections
(
	`user_id` INT UNSIGNED NOT NULL,
	CollectionID INT UNSIGNED NOT NULL,
	
	PRIMARY KEY (`user_id`, CollectionID),
	FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`),
	FOREIGN KEY (CollectionID) REFERENCES collections(CollectionID)
) ENGINE=INNODB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS collectionProducts
(
	CollectionID INT UNSIGNED NOT NULL,
	ProductID INT UNSIGNED NOT NULL,
	
	PRIMARY KEY (CollectionID, ProductID),
	FOREIGN KEY (CollectionID) REFERENCES collections(CollectionID),
	FOREIGN KEY (ProductID) REFERENCES products(ProductID)
) ENGINE=INNODB DEFAULT CHARSET=utf8;