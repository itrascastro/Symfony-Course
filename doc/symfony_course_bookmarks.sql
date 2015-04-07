-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 07, 2015 at 04:19 PM
-- Server version: 5.5.29
-- PHP Version: 5.4.30

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `symfony_course_bookmarks`
--

-- --------------------------------------------------------

--
-- Table structure for table `Bookmark`
--

CREATE TABLE IF NOT EXISTS `Bookmark` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `createdAt` datetime NOT NULL,
  `modifiedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=46 ;

--
-- Dumping data for table `Bookmark`
--

INSERT INTO `Bookmark` (`id`, `url`, `title`, `description`, `createdAt`, `modifiedAt`) VALUES
(40, 'http://www.google.com', 'Google Inc', 'Search Engine', '2015-03-31 18:38:03', '2015-03-31 16:38:03'),
(41, 'http://reddit.com', 'reddit', 'the front page of the internet', '2015-03-31 18:38:03', '2015-03-31 16:38:03'),
(42, 'http://twitter.com', 'Twitter', 'Social Network', '2015-03-31 18:38:03', '2015-03-31 16:38:03'),
(43, 'http://www.linkedin.com', 'LinkedIn', 'Connecting the world''s professionals', '2015-03-31 18:38:03', '2015-03-31 16:38:03');

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:json_array)',
  `is_active` tinyint(1) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=25 ;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`id`, `username`, `password`, `roles`, `is_active`, `email`) VALUES
(13, 'bird', '$2y$13$FIH.CHmPo/Qy5S0nq0PkdehhIh0wbzVExibdM442X8xkoHiqu/3AC', '["ROLE_ADMIN"]', 1, 'bird@bostonceltics.com'),
(14, 'mchale', '$2y$13$5EJav3g7CZK0.z/.lcyN1uyOhMzvpViGF2BZVF/4LRS0Iq8yYBsKm', '[]', 1, 'mchale@bostonceltics.com'),
(15, 'parish', '$2y$13$JgMWUnbi8vJfuyEnNHKyHuZYVM0mr5MXF87ldXl7HKilX9.zhX6tK', '[]', 0, 'parish@bostonceltics.com'),
(16, 'ismael', '$2y$13$8igvyuNtGlwJHLFihKEcCOi9yGNsaOqr1xyylaHwPZywpPixLxZri', '[]', 1, 'i.trascastro@gmail.com'),
(17, 'user', '$2y$13$8V307f5LKeQ4ZDwU6Y/33ePyal2IGIiMqJKnT0c64DcBI501j7fnq', '[]', 1, 'eds@ea.com'),
(18, 'user2', '$2y$13$qC/EVAT1Ux.teS2uvntKieu9i2zuXRT5Iv/FZiq1ceg.LFtoawQ.i', '[]', 1, 'dsds@df.com'),
(19, 'user3', '$2y$13$MkjKTzZ71YeBVCcx/7mxLexCO7aYgbKKFcYOuuG1oumYgx0avWtKe', '[]', 1, 'fdsf@daf.com'),
(20, 'user10', '$2y$13$E5.tG0wC1OmJkFHlIK4aZOZ.002fqsuMrwI.MIMThRB9dw/6okBbe', '[]', 1, 'refe@fdf.com'),
(21, 'sasa', '$2y$13$8XwqbvRuwtNAjzAfEedNOe31yBuPTQsmwWowPk8FjurPrcdxz72nW', '[]', 1, 'sadas'),
(22, 'sasad', '$2y$13$k4j1ejIaPUa3XIpr4LTP6eATtrx6zRhK92Orx.Mvh9CZhifh/St2S', '[]', 1, 'sadas'),
(23, 'bird', '$2y$13$k1SOcm8newOXB4O4f2/SbutLZPmWfbHtx5VH0Q0D0IvVnlvcByaMG', '[]', 1, 'bird2@bostonceltics.com'),
(24, 'user33', '$2y$13$xnrEf2q24PSPdayHLFK5h.uL8C7MFYGRsuxuCckLTttqgBx/Gp1ti', '[]', 1, '33@email.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
