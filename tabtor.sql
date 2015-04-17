-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 17, 2015 at 01:17 PM
-- Server version: 5.5.42-log
-- PHP Version: 5.3.29

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tabtor`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_file`
--

CREATE TABLE IF NOT EXISTS `user_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `file` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `user_file`
--

INSERT INTO `user_file` (`id`, `user_id`, `file`) VALUES
(2, 1, 'BlindMatrix_Logo.jpg'),
(3, 1, 'user1.json'),
(4, 1, 'http://upload.wikimedia.org/wikipedia/commons/1/1e/Stonehenge.jpg'),
(5, 2, 'BlindMatrix_Logo.jpg'),
(6, 2, 'user1.json'),
(7, 2, 'http://upload.wikimedia.org/wikipedia/commons/1/1e/Stonehenge.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
