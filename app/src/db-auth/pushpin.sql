-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2019 at 01:51 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- Create pushpin DB
CREATE DATABASE IF NOT EXISTS `pushpin` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `pushpin`;

--
-- Database: `pushpin`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `pushpin`.`accounts` (
  `account_id` int(10) UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
  `account_name` varchar(255) NOT NULL,
  `account_passwd` varchar(255) NOT NULL,
  `account_reg_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `account_enabled` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `organization` VARCHAR(150) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts`
-- Test account: test@rpi.edu / 1234567890
--

INSERT INTO `pushpin`.`accounts` (`account_id`, `account_name`, `account_passwd`, `account_reg_time`, `account_enabled`, `organization`) VALUES
(2, 'test@rpi.edu', '$2y$10$RNM4Z/Sr.o.Z3sELEJwmkOpzlkv7EAOIvdYySxv7vOGK3qOrSzjb.', '2019-12-05 04:14:27', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `account_sessions`
--

CREATE TABLE IF NOT EXISTS `pushpin`.`account_sessions` (
  `session_id` varchar(255) NOT NULL PRIMARY KEY,
  `account_id` int(10) UNSIGNED NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- -----------------------------------------------------
-- Table `pushpin`.`posters`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pushpin`.`posters` (
  `poster_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(150) NOT NULL,
  `image_file` varchar(32) not null,
  `description` TEXT NULL,
  `event_date` DATE NOT NULL,
  `takedown_date` DATE NOT NULL,
  `account_id` int(10) UNSIGNED NOT NULL,
  FOREIGN KEY (account_id) REFERENCES pushpin.accounts(account_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posters`
--

INSERT INTO `pushpin`.`posters` (`poster_id`, `title`, `description`, `event_date`, `takedown_date`, `account_id`) VALUES
(NULL, 'test1', NULL, '2019-12-03', '2019-12-27', 2),
(NULL, 'test2', NULL, '2019-12-24', '2019-12-17', 2),
(NULL, 'test3', NULL, '2019-12-26', '2019-12-20', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
