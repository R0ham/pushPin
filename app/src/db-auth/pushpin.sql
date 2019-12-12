CREATE DATABASE pushpin;
USE pushpin;

-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 11, 2019 at 07:00 PM
-- Server version: 5.7.20
-- PHP Version: 7.1.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pushpin`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `account_id` int(10) UNSIGNED NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `account_passwd` varchar(255) NOT NULL,
  `account_reg_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `account_enabled` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `organization` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`account_id`, `account_name`, `account_passwd`, `account_reg_time`, `account_enabled`, `organization`) VALUES
(2, 'test@rpi.edu', '$2y$10$RNM4Z/Sr.o.Z3sELEJwmkOpzlkv7EAOIvdYySxv7vOGK3qOrSzjb.', '2019-12-05 04:14:27', 1, NULL),
(3, 'berlir@rpi.edu', '$2y$10$AqWq3jT/DwnP7Oe0VR.pNu4nhKYNGR5qtzW7XtLB9iekmZN6xaGc2', '2019-12-06 00:17:42', 1, NULL),
(4, 'asdf@rpi.edu', '$2y$10$QQPA9p6WoPo7v8pxaply.ODVjP9SZ0Ul4ziQTEUBck5.nlqkDe2qG', '2019-12-06 00:17:59', 1, NULL),
(5, 'bbbb@rpi.edu', '$2y$10$ZljwcBzYVLI9v12BgTYXXOGi4CnpFpOfTW9LnTXi/reRzyV8HF3bS', '2019-12-06 00:18:13', 1, NULL),
(6, 'ryan@rpi.edu', '$2y$10$zZ/vXDgr.DoLsqjmceiWH.a6d2n4yx5/ljRZrdd0Cx80UZ9df8TVq', '2019-12-06 00:18:25', 1, NULL),
(7, 'berlin@rpi.edu', '$2y$10$/ftLY65suqecnm6wsEWmM.osEPMBSVdHrwwp2JnulsjXJihLA6RMa', '2019-12-06 00:19:22', 1, NULL),
(8, 'a@rpi.edu', '$2y$10$UR6DENmxWEi8WxeHx0pVgupxCccbugXz5I568..wtWf55iw5BaxbS', '2019-12-06 00:20:27', 1, NULL),
(10, 'demotest@rpi.edu', '$2y$10$KVIaDm39MFeGKt0eXFguJOldUCHyovR7W2kQOoOrg5nnNqq1Wg4jK', '2019-12-06 16:05:04', 1, NULL),
(12, 'b@rpi.edu', '$2y$10$NaN220sOXYUzc8K6rCG9VeEl0Bcj/Q4wOgfaA4//sSSDHQHcIUaQC', '2019-12-06 17:17:48', 1, NULL),
(13, 'v@rpi.edu', '$2y$10$QEDbjhbjiJy6KpoV.cg1c.rJ1LU29pVyjTMI7ZwXzqKW24TH6p9Wq', '2019-12-06 17:19:28', 1, NULL),
(14, 's@rpi.edu', '$2y$10$TLTTSgnJbWrEZ9vTgus6Y.2HYIuCyK9q6i.lrrptFEW.BFA2a/6NG', '2019-12-06 17:19:46', 1, NULL),
(15, 'ra@rpi.edu', '$2y$10$fVGyTN6iF6q9Y.zMo18JK.3E3xjGVvvX1pMUXoQzcsoe1xrGoKkIa', '2019-12-06 17:21:53', 1, NULL),
(17, 'demo@rpi.edu', '$2y$10$NkaVset0Mg9NI8g22ecl0O1uIhT9kBsuuUO4h3cPZLiPLGfdyXWqm', '2019-12-06 18:31:57', 1, NULL),
(18, 'p@rpi.edu', '$2y$10$pSmZ7Qn4ZxC82xWALuArwuqyOA5KeIfscrc8zDJOuHVAbSDS2uhse', '2019-12-07 21:52:11', 1, NULL),
(19, 'berrli@rpi.edu', '$2y$10$tiYh.sEnJRhfWJavPl.KROi.3OL/yAJHxihW4c2fMVW2V/XBRdYj.', '2019-12-07 21:54:08', 1, NULL),
(20, 'asf@rpi.edu', '$2y$10$/vgM7MOBsgzvsO5hw34E6u4/Yqr6tVk34XzOQOZK4kEGoS.Lx7sRq', '2019-12-07 21:55:59', 1, NULL),
(21, 'f@rpi.edu', '$2y$10$9RiesOgWJB.zjWfmsdJ.pefiQjkpghZchugVwsJhU/2gf0soOjeOu', '2019-12-07 21:56:26', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `account_sessions`
--

CREATE TABLE `account_sessions` (
  `session_id` varchar(255) NOT NULL,
  `account_id` int(10) UNSIGNED NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `account_sessions`
--

INSERT INTO `account_sessions` (`session_id`, `account_id`, `login_time`) VALUES
('0d343fd24496d413c6843597b1478f47', 16, '2019-12-06 17:38:29'),
('2394ff40e318b775200ef9ac72952d84', 3, '2019-12-11 19:00:05'),
('4d2a512f50d4d1e65c3df4a5c9e1b4b2', 3, '2019-12-06 16:02:40'),
('543a544094a9e77e35b44ad55390759c', 9, '2019-12-06 16:05:32'),
('5cb972eb9bf3140fc6d3180c7351ed8c', 3, '2019-12-06 01:26:39'),
('80459c94265fdee2171190640a7893cc', 11, '2019-12-06 17:22:05'),
('cc9132b6f2ad783b61ff955b4c92721d', 11, '2019-12-06 17:06:49'),
('e62e87c0c06f18cc4956c96e65c12074', 11, '2019-12-06 17:07:52'),
('so38s2n892bdmoffto4k3jrskh', 3, '2019-12-10 01:21:34');

-- --------------------------------------------------------

--
-- Table structure for table `posters`
--

CREATE TABLE `posters` (
  `poster_id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `image_file` varchar(32) NOT NULL,
  `description` text,
  `event_date` date NOT NULL,
  `takedown_date` date NOT NULL,
  `account_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posters`
--

INSERT INTO `posters` (`poster_id`, `title`, `image_file`, `description`, `event_date`, `takedown_date`, `account_id`) VALUES
(53, 'Arts Series', 'poster 1.jpg', 'Come visit us at the Troy Music Hall', '2019-12-12', '2019-12-25', 2),
(54, 'Dumpling Party!', 'poster 2.jpg', 'Come make and eat a ton of Chinese pork and tofu dumplings!', '2019-12-12', '2019-12-25', 2),
(55, 'Student Relief Fund', 'poster 3.jpg', 'Support the 2020 class gift by aiding RPI students in times of personal crisis', '2019-12-12', '2019-12-25', 2),
(56, 'Fall Events', 'poster 4.jpg', 'The Clubhouse Pub opens for the Fall Semester', '2019-12-12', '2019-12-25', 3),
(57, 'Thanksgiving Dinner', 'poster 5.jpg', 'Pre-registration required.', '2019-12-12', '2019-12-25', 3),
(58, 'Real World: Technical Interviewing', 'poster 6.jpg', 'Hear from recruiters from Zones, Datto, James McGuinness & Associates, and more! Lunch provided!', '2019-12-12', '2019-12-25', 3),
(59, 'Join Mediterranean Student Club', 'poster 7.jpg', 'Come share your favorite recipes and foods!', '2019-12-12', '2019-12-25', 4),
(60, 'Drop-In Meditation', 'poster 8.jpg', 'Free distressing event at the Mueller Center.', '2019-12-12', '2019-12-25', 4),
(61, 'Writing Contest', 'poster 9.jpg', 'Submit now through March 17, 4 P.M. cash prizes for each category.', '2019-12-12', '2019-12-25', 4),
(62, 'Artist Survey', 'poster 10.jpg', 'Help decide who plays in the Spring!', '2019-12-12', '2019-12-25', 5),
(63, 'Falling in Reverse', 'poster 11.jpg', 'Discounted tickets sold in the Union.', '2019-12-12', '2019-12-25', 5),
(64, 'Sheer Idiocy', 'poster 12.jpg', 'Free improv show with a very special guest: the Pub.', '2019-12-12', '2019-12-25', 5),
(65, 'Ethics', 'poster 13.jpg', 'Rensselaer for Ethics in Science, Engineering, and Technology', '2019-12-12', '2019-12-25', 6),
(66, 'Drop or Swap', 'poster 14.jpg', 'Today in the 87 Gym!', '2019-12-12', '2019-12-25', 6),
(67, 'Healthy Cooking', 'poster 15.jpg', 'Come join APO as we prepare healthy foods that are great dietary options for diabetics!', '2019-12-12', '2019-12-25', 6),
(68, 'RPI Art Club', 'poster 16.jpg', 'Hang out with us this weekend and draw!', '2019-12-12', '2019-12-25', 7),
(69, 'Reunion & Homecoming', 'poster 17.jpg', 'Join our alumni/ae for a full weekend of events!', '2019-12-12', '2019-12-25', 7),
(70, 'Union After Dark', 'poster 18.jpg', 'Minecraft Battle Royale', '2019-12-12', '2019-12-25', 7),
(71, 'RPI Podcast', 'poster 19.jpg', 'Why not change the world? Season 1 now available!', '2019-12-12', '2019-12-25', 8),
(72, 'Lyric Awards', 'poster 20.jpg', 'Location: Chapel & Cultural Center', '2019-12-12', '2019-12-25', 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `account_sessions`
--
ALTER TABLE `account_sessions`
  ADD PRIMARY KEY (`session_id`);

--
-- Indexes for table `posters`
--
ALTER TABLE `posters`
  ADD PRIMARY KEY (`poster_id`),
  ADD KEY `account_id` (`account_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `account_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `posters`
--
ALTER TABLE `posters`
  MODIFY `poster_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posters`
--
ALTER TABLE `posters`
  ADD CONSTRAINT `posters_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
