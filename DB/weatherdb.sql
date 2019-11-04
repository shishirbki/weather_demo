-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2019 at 01:47 PM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `weatherdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `city_weather_details`
--

CREATE TABLE `city_weather_details` (
  `id` int(11) NOT NULL,
  `city` varchar(200) NOT NULL,
  `weather_date` datetime DEFAULT NULL,
  `weather` varchar(200) DEFAULT NULL,
  `temprature` varchar(200) DEFAULT NULL,
  `temp_min` varchar(100) DEFAULT NULL,
  `temp_max` varchar(100) DEFAULT NULL,
  `humidity` varchar(100) DEFAULT NULL,
  `air_speed` varchar(100) DEFAULT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city_weather_details`
--

INSERT INTO `city_weather_details` (`id`, `city`, `weather_date`, `weather`, `temprature`, `temp_min`, `temp_max`, `humidity`, `air_speed`, `created`) VALUES
(21, 'Jaipur', '2019-11-04 11:36:02', 'Haze', '304.15', '304.15', '304.15', '35', '3.6', '2019-11-04 11:38:43'),
(22, 'Mumbai', '2019-11-04 11:38:04', 'Haze', '304.71', '304.15', '305.15', '70', '6.7', '2019-11-04 11:39:13'),
(23, 'America', '2019-11-04 11:44:15', 'Clouds', '295.28', '295.28', '295.28', '50', '0.46', '2019-11-04 11:53:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `city_weather_details`
--
ALTER TABLE `city_weather_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `city_weather_details`
--
ALTER TABLE `city_weather_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
