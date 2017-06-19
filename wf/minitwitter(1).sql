-- phpMyAdmin SQL Dump
-- version 4.4.14.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 08, 2015 at 02:39 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `minitwitter`
--

-- --------------------------------------------------------

--
-- Table structure for table `follows`
--

CREATE TABLE IF NOT EXISTS `follows` (
  `follows_id` int(11) NOT NULL,
  `follows_follower` int(11) NOT NULL,
  `follows_user` int(11) NOT NULL,
  `follows_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `follows_active` enum('yes','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tweets`
--

CREATE TABLE IF NOT EXISTS `tweets` (
  `tweets_id` int(11) NOT NULL,
  `tweets_user` int(11) NOT NULL,
  `tweets_text` char(160) NOT NULL,
  `tweets_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tweets_active` enum('yes','no') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tweets`
--

INSERT INTO `tweets` (`tweets_id`, `tweets_user`, `tweets_text`, `tweets_created`, `tweets_active`) VALUES
(1, 1, 'Примерен текст.', '2015-09-18 13:34:29', 'yes');

-- --------------------------------------------------------
