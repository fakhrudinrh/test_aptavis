-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2023 at 04:38 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `klasemen_liga`
--

-- --------------------------------------------------------

--
-- Table structure for table `clubs`
--

CREATE TABLE `clubs` (
  `club_id` int(5) UNSIGNED NOT NULL,
  `club_name` varchar(100) NOT NULL,
  `club_city` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clubs`
--

INSERT INTO `clubs` (`club_id`, `club_name`, `club_city`) VALUES
(1, 'Persib', 'Bandung'),
(12, 'Persebaya', 'Surabaya'),
(13, 'Arema', 'Malang'),
(14, 'Bali United', 'Bali'),
(15, 'persema', 'malang'),
(16, 'PBR', 'bandung'),
(17, 'persis', 'solo'),
(23, 'persik', 'kediri'),
(28, 'Persija', 'Jakarta'),
(33, 'Persipura', 'Jayapura');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(18, '2023-03-10-085108', 'App\\Database\\Migrations\\CreateClubsTable', 'default', 'App', 1678441738, 1),
(19, '2023-03-10-085157', 'App\\Database\\Migrations\\CreateStandingsTable', 'default', 'App', 1678441738, 1);

-- --------------------------------------------------------

--
-- Table structure for table `standings`
--

CREATE TABLE `standings` (
  `standing_id` int(5) UNSIGNED NOT NULL,
  `club_id` int(5) UNSIGNED NOT NULL,
  `played` int(2) NOT NULL DEFAULT 0,
  `won` int(2) NOT NULL DEFAULT 0,
  `draw` int(2) NOT NULL DEFAULT 0,
  `lost` int(2) NOT NULL DEFAULT 0,
  `goals_for` int(3) NOT NULL DEFAULT 0,
  `goals_againts` int(3) NOT NULL DEFAULT 0,
  `points` int(3) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `standings`
--

INSERT INTO `standings` (`standing_id`, `club_id`, `played`, `won`, `draw`, `lost`, `goals_for`, `goals_againts`, `points`) VALUES
(1, 1, 4, 4, 0, 0, 18, 5, 12),
(4, 12, 4, 1, 2, 1, 3, 9, 5),
(5, 13, 5, 1, 1, 3, 5, 8, 4),
(6, 14, 4, 1, 3, 0, 8, 6, 6),
(7, 15, 3, 0, 3, 0, 2, 2, 3),
(8, 16, 4, 1, 1, 2, 5, 8, 4),
(9, 17, 3, 0, 3, 0, 3, 3, 3),
(15, 23, 4, 0, 1, 3, 7, 10, 1),
(20, 28, 4, 2, 2, 0, 10, 8, 8),
(29, 33, 3, 0, 2, 1, 3, 5, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clubs`
--
ALTER TABLE `clubs`
  ADD PRIMARY KEY (`club_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `standings`
--
ALTER TABLE `standings`
  ADD PRIMARY KEY (`standing_id`),
  ADD KEY `standings_club_id_foreign` (`club_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clubs`
--
ALTER TABLE `clubs`
  MODIFY `club_id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `standings`
--
ALTER TABLE `standings`
  MODIFY `standing_id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `standings`
--
ALTER TABLE `standings`
  ADD CONSTRAINT `standings_club_id_foreign` FOREIGN KEY (`club_id`) REFERENCES `clubs` (`club_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
