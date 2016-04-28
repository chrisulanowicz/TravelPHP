-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Apr 21, 2016 at 08:48 PM
-- Server version: 5.5.42
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `travel_buddy`
--

-- --------------------------------------------------------

--
-- Table structure for table `destinations`
--

CREATE TABLE `destinations` (
  `id` int(11) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `destinations`
--

INSERT INTO `destinations` (`id`, `destination`, `user_id`, `description`, `date_from`, `date_to`, `created_at`, `updated_at`) VALUES
(7, 'detroit', 2, 'something', '2016-04-29', '2016-04-30', '2016-04-21 13:00:05', '2016-04-21 13:00:05'),
(8, 'san fran', 3, 'drive', '2016-04-22', '2016-04-29', '2016-04-21 13:01:47', '2016-04-21 13:01:47'),
(9, 'denver', 1, 'speed', '2016-04-23', '2016-04-30', '2016-04-21 13:03:39', '2016-04-21 13:03:39'),
(10, 'florida', 4, 'sun', '2016-04-23', '2016-04-30', '2016-04-21 13:32:10', '2016-04-21 13:32:10');

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `destination_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Barry Newman', 'Kozlowski', '$2y$10$Ij/f3KQy0yRU/UzxKq/KEOGxpbIUtamip1MH5IkhGrIsPcN1HJB0e', '2016-04-21 09:52:02', '2016-04-21 09:52:02'),
(2, 'Cleavon Little', 'Super Soul', '$2y$10$BxCyjvgDyXiU.YDZBflYiO1.sL5lI2sBR0fPkgCu0hyV.Y2m04b0C', '2016-04-21 11:45:37', '2016-04-21 11:45:37'),
(3, 'Dean Jagger', 'Prospector', '$2y$10$6Hz0gHaTKmvucosKq96RnuU7pbKFah40ze6QRr3qtsM7RkJxxE4K.', '2016-04-21 11:46:29', '2016-04-21 11:46:29'),
(4, 'Paul', 'Koslo', '$2y$10$huhqYcB/sdvxpNSiiJHkOOViPmRCrCd8Juy/5hkZBGZ8pdWhrWHhK', '2016-04-21 13:29:45', '2016-04-21 13:29:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `destinations`
--
ALTER TABLE `destinations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users.id` (`user_id`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users.id` (`user_id`),
  ADD KEY `destinations.id` (`destination_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `destinations`
--
ALTER TABLE `destinations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `destinations`
--
ALTER TABLE `destinations`
  ADD CONSTRAINT `destinations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `participants`
--
ALTER TABLE `participants`
  ADD CONSTRAINT `participants_ibfk_2` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`id`),
  ADD CONSTRAINT `participants_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
