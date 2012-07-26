-- phpMyAdmin SQL Dump
-- version 3.1.1
-- http://www.phpmyadmin.net
--
-- Anamakine: localhost
-- Üretim Zamanı: 04 Şubat 2012 saat 06:30:22
-- Sunucu sürümü: 5.1.30
-- PHP Sürümü: 5.2.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Veritabanı: `ci`
--

-- --------------------------------------------------------

--
-- Tablo yapısı: `sys_config`
--

CREATE TABLE IF NOT EXISTS `sys_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option_name` varchar(255) DEFAULT NULL,
  `option_value` text,
  `option_type` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Tablo döküm verisi `sys_config`
--

INSERT INTO `sys_config` (`id`, `option_name`, `option_value`, `option_type`) VALUES
(1, 'site_title', 'BaloonAdmin Yönetim Paneli', 'site'),
(4, 'site_description', 'Yönetim Paneli', 'site'),
(5, 'site_link', 'www.iyibirfiyat.com', 'site'),
(6, 'site_author', 'Osman Ali Seyir', 'site'),
(7, 'site_keywords', 'yönetim, panel', 'site'),
(8, 'site_footer', 'Tüm Hakları Saklıdır. Siteden izinsiz içerik veya resim alınamaz..', 'site'),
(9, 'yonetim_name', 'Osman Ali Seyir', 'yonetim'),
(10, 'yonetim_email', 'info@baloondesign.com', 'yonetim'),
(13, 'site_theme', 'default', 'site'),
(14, 'site_language', 'turkish', 'site'),
(15, 'yonetim_language', 'turkish', 'yonetim');

-- --------------------------------------------------------

--
-- Tablo yapısı: `sys_groups`
--

CREATE TABLE IF NOT EXISTS `sys_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groupname` varchar(100) NOT NULL,
  `create_date` datetime NOT NULL,
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `groupname` (`groupname`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Tablo döküm verisi `sys_groups`
--

INSERT INTO `sys_groups` (`id`, `groupname`, `create_date`, `update_date`) VALUES
(4, 'Site Adminleri', '2012-02-04 01:26:00', '2012-02-04 01:35:28'),
(11, 'Deneme Grup', '2012-02-04 04:35:27', '2012-02-04 04:35:27'),
(12, 'Deneme Grup2', '2012-02-04 05:27:14', '2012-02-04 05:27:14');

-- --------------------------------------------------------

--
-- Tablo yapısı: `sys_hits`
--

CREATE TABLE IF NOT EXISTS `sys_hits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) DEFAULT NULL,
  `hit` int(11) DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Tablo döküm verisi `sys_hits`
--

INSERT INTO `sys_hits` (`id`, `ip`, `hit`, `tarih`) VALUES
(1, '127.0.0.1', 10, '2012-01-29'),
(2, '127.0.0.1', 36, '2012-01-30'),
(3, '127.0.0.1', 1334, '2012-02-04');

-- --------------------------------------------------------

--
-- Tablo yapısı: `sys_langs`
--

CREATE TABLE IF NOT EXISTS `sys_langs` (
  `lang_short` varchar(3) NOT NULL,
  `lang_name` varchar(100) DEFAULT NULL,
  `lang_description` varchar(100) DEFAULT NULL,
  `lang_icon` varchar(255) DEFAULT NULL,
  `lang_endian` varchar(3) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  PRIMARY KEY (`lang_short`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `sys_langs`
--

INSERT INTO `sys_langs` (`lang_short`, `lang_name`, `lang_description`, `lang_icon`, `lang_endian`, `order`) VALUES
('en', 'english', 'English', 'en.png', 'ltr', 2),
('tr', 'turkish', 'Türkçe', 'tr.png', 'ltr', 1);

-- --------------------------------------------------------

--
-- Tablo yapısı: `sys_onlineusers`
--

CREATE TABLE IF NOT EXISTS `sys_onlineusers` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `time` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `type` int(2) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1381 ;

--
-- Tablo döküm verisi `sys_onlineusers`
--

INSERT INTO `sys_onlineusers` (`id`, `time`, `ip`, `type`, `user_id`) VALUES
(692, '1328390379', '127.0.0.1', 0, 3),
(691, '1328390379', '127.0.0.1', 0, 3),
(690, '1328390375', '127.0.0.1', 0, 3),
(689, '1328390375', '127.0.0.1', 0, 3),
(1379, '1328329613', '127.0.0.1', 0, 3),
(1380, '1328329613', '127.0.0.1', 0, 3),
(1377, '1328329596', '127.0.0.1', 0, 3),
(1378, '1328329596', '127.0.0.1', 0, 3);

-- --------------------------------------------------------

--
-- Tablo yapısı: `sys_subscriptions`
--

CREATE TABLE IF NOT EXISTS `sys_subscriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groupid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `groupid` (`groupid`,`userid`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Tablo döküm verisi `sys_subscriptions`
--

INSERT INTO `sys_subscriptions` (`id`, `groupid`, `userid`, `create_date`) VALUES
(9, 11, 3, '2012-02-04 04:35:27'),
(10, 4, 3, '2012-02-04 05:26:50'),
(11, 4, 89, '2012-02-04 05:26:50'),
(12, 12, 89, '2012-02-04 05:27:14');

-- --------------------------------------------------------

--
-- Tablo yapısı: `sys_users`
--

CREATE TABLE IF NOT EXISTS `sys_users` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `level` int(2) DEFAULT NULL,
  `adsoyad` varchar(255) DEFAULT NULL,
  `uyeliktarihi` date DEFAULT NULL,
  `songiristarihi` date DEFAULT NULL,
  `belonggroup` varchar(40) DEFAULT NULL,
  `type` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `level` (`level`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=90 ;

--
-- Tablo döküm verisi `sys_users`
--

INSERT INTO `sys_users` (`id`, `username`, `password`, `level`, `adsoyad`, `uyeliktarihi`, `songiristarihi`, `belonggroup`, `type`) VALUES
(3, 'Administrator', '81dc9bdb52d04dc20036dbd8313ed055', 1, 'Admin Soyad', '2011-08-16', '2012-02-04', '1', '1'),
(89, 'guest1', '81dc9bdb52d04dc20036dbd8313ed055', 1, 'guest user', '2012-02-04', '2012-02-04', NULL, '1');

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `sys_subscriptions`
--
ALTER TABLE `sys_subscriptions`
  ADD CONSTRAINT `sys_subscriptions_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `sys_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sys_subscriptions_ibfk_3` FOREIGN KEY (`groupid`) REFERENCES `sys_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
