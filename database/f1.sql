-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2023 at 09:34 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `f1`
--

-- --------------------------------------------------------

--
-- Table structure for table `myacc`
--

CREATE TABLE `myacc` (
  `id` int(6) UNSIGNED NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `myacc`
--

INSERT INTO `myacc` (`id`, `username`, `email`, `password`) VALUES
(1, 'mehran', 'mmehran292@gmail.com', '3c26ccd1fb986ce4597417ad0bd107f8');

-- --------------------------------------------------------

--
-- Table structure for table `myposts`
--

CREATE TABLE `myposts` (
  `id` int(6) UNSIGNED NOT NULL,
  `title` varchar(30) DEFAULT NULL,
  `article` longtext NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `banner_img` varchar(255) DEFAULT NULL,
  `date_published` datetime DEFAULT NULL,
  `enabled` tinyint(1) DEFAULT 1,
  `comments_enabled` tinyint(1) DEFAULT 1,
  `shower` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `myposts`
--

INSERT INTO `myposts` (`id`, `title`, `article`, `file`, `banner_img`, `date_published`, `enabled`, `comments_enabled`, `shower`) VALUES
(1, 'GOD OF WAR', 'god of war is a video game for Play Station', 'pngwing.com.png', 'download.jpg', '2023-02-18 19:23:58', 1, 1, 1),
(2, 'SPIDER-MAN', 'spiderman is a video game for all platforms', 'pngaaa.com-2065508.png', 'snh_online_6072x9000_hero_03_opt-1812d7c.jpeg', '2023-02-18 19:24:33', 1, 0, 1),
(3, 'BATMAN', 'BATMAN is one the darkest character in DC universe', 'pngegg.png', 'eb5fe1d1-74e9-4076-969e-59212727451a.sized-1000x1000.jpg', '2023-02-18 19:25:42', 0, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `myacc`
--
ALTER TABLE `myacc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `myposts`
--
ALTER TABLE `myposts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `myacc`
--
ALTER TABLE `myacc`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `myposts`
--
ALTER TABLE `myposts`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
