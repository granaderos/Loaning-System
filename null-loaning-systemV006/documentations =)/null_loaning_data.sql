-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2016 at 11:04 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `null_loaning_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `client_id` int(11) NOT NULL,
  `firstname` varchar(20) DEFAULT NULL,
  `lastname` varchar(200) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `contact` varchar(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `job` varchar(50) DEFAULT NULL,
  `income` varchar(25) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `firstname`, `lastname`, `address`, `contact`, `email`, `job`, `income`) VALUES
(9, 'Perpinosa', 'Jean', 'Cubao, Quezon City', '09268873127', 'marejeanperpinosa@gm', 'Programmer', 'P500,000 above'),
(10, 'Derwin', 'Salud', 'Proj. 4 Quezon City', '09267461134', 'salder@gmail.com', 'Eater', 'P200,000 - P500,000'),
(11, 'De Castro', 'Kim', 'Cubao, Quezon City', '09283434982', 'kim@yahoo.com', 'designer', 'P200,000 - P500,000'),
(13, 'Salud', 'John', 'Manila', '09267461134', 'john.sanje@gmail.com', 'Developer', 'P200,000 - P500,000'),
(14, 'Azurin', 'Matthew', 'Anonas, Quezon City', '09786356789', 'azu_lal@gmail.com', 'Game Developer', 'P500,000 above'),
(15, 'Vin', 'Mel', 'Cainta', '09234567892', 'mel@yahoo.com', 'Gamer', 'P10,000 below'),
(16, 'Bravo', 'Johnny', 'Manila', '09267461134', 'brave.@ymail.com', 'Manager', 'P10,000 below'),
(17, 'This', 'Saved', 'Anywhere', '09267461134', 'anymail@there.com', 'not applicable', 'P10,000 below'),
(19, 'Salud', 'Kim', 'Pinagkaisahan', '09283434982', 'salKim@gmail.com', 'Eater', 'P10,000 below'),
(20, 'Wiws', 'Jans', 'Manila Metro', '09283453789', 'wiw@gmail.com', 'Programmer', 'P10,000 below');

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE IF NOT EXISTS `loan` (
  `loan_id` int(11) NOT NULL,
  `loan_title` varchar(30) DEFAULT NULL,
  `loan_limit` double DEFAULT NULL,
  `interest` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `system_accounts`
--

CREATE TABLE IF NOT EXISTS `system_accounts` (
  `acc_id` int(11) NOT NULL,
  `user_name` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `type` varchar(6) DEFAULT 'client'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_accounts`
--

INSERT INTO `system_accounts` (`acc_id`, `user_name`, `password`, `type`) VALUES
(1, 'nullpointer', '15963', 'admin'),
(2, 'NULLVin', '09234567892', 'client'),
(3, 'NULLBravo', '09267461134', 'client'),
(5, 'NULLSalud', '09283434982', 'client'),
(6, 'NULLWiws', '09283453789', 'client');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `trans_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `loan_id` int(11) DEFAULT NULL,
  `date_of_loan` date DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `balance` double DEFAULT NULL,
  `collateral` varchar(50) DEFAULT NULL,
  `mode_of_payment` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`trans_id`, `client_id`, `loan_id`, `date_of_loan`, `amount`, `balance`, `collateral`, `mode_of_payment`, `remarks`) VALUES
(1, 20, 0, '0000-00-00', 90000, 90000, 'none', 'Quarterly', '---');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`loan_id`);

--
-- Indexes for table `system_accounts`
--
ALTER TABLE `system_accounts`
  ADD PRIMARY KEY (`acc_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`trans_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `loan`
--
ALTER TABLE `loan`
  MODIFY `loan_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `system_accounts`
--
ALTER TABLE `system_accounts`
  MODIFY `acc_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
