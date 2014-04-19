-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 19, 2014 at 01:39 PM
-- Server version: 5.6.16-log
-- PHP Version: 5.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `description` varchar(250) NOT NULL,
  `user` varchar(50) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `flag` tinyint(1) NOT NULL DEFAULT '0',
  `location` varchar(250) NOT NULL,
  `comments` varchar(250) NOT NULL DEFAULT 'Not flagged',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `description`, `user`, `date`, `flag`, `location`, `comments`) VALUES
(1, 'tharrell enabled account: 343 Test', 'tharrell', '2014-04-16 13:16:10', 0, 'Account Status', 'Not flagged'),
(2, 'mmollica tharrell userlevel''s account. Reason: admin', 'mmollica', '2014-04-18 13:27:53', 0, 'Users', 'Not flagged'),
(3, '$user has changed user level of $user_changed to $var', 'tharrell', '2014-04-18 13:29:36', 0, 'Users', 'Not flagged'),
(4, 'tharrell has changed user level of mmollica to admin', 'tharrell', '2014-04-18 13:30:27', 0, 'Users', 'Not flagged'),
(5, 'terrible_accountant created a transaction for test in the amount of $100,000', 'terrible_accountant', '2014-04-19 10:53:34', 0, 'test', 'Not flagged'),
(6, 'testacc1 created a new account: 100000037  with starting balance $900', 'testacc1', '2014-04-19 12:33:56', 0, 'Accounts', 'Not flagged'),
(7, 'testacc1 created a new account: 100000038  with starting balance $700', 'testacc1', '2014-04-19 12:36:34', 0, 'Accounts', 'Not flagged'),
(8, 'testacc1 created a new account 200000000 :BLOW IT UP with starting balance $900', 'testacc1', '2014-04-19 12:38:49', 0, 'Accounts', 'Not flagged'),
(9, 'testacc1 created a transaction for 300000004 in the amount of $10', 'testacc1', '2014-04-19 12:44:58', 0, '300000004', 'Not flagged'),
(10, 'testacc1 created a transaction for 700000005 in the amount of $10', 'testacc1', '2014-04-19 12:44:58', 0, '700000005', 'Not flagged'),
(11, 'testacc1  account 100000004: ', 'testacc1', '2014-04-19 13:25:28', 0, 'Account Status', 'Not flagged'),
(12, 'testacc1  account 100000000: ', 'testacc1', '2014-04-19 13:27:00', 0, 'Account Status', 'Not flagged'),
(13, 'testacc1 disabled account 100000000: PettyCash', 'testacc1', '2014-04-19 13:28:30', 0, 'Account Status', 'Not flagged');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
