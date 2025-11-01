-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 01, 2025 at 07:47 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `posts`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `eventid` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `divisionalname` varchar(100) DEFAULT NULL,
  `eventname` varchar(100) NOT NULL,
  `eventdate` date NOT NULL,
  `eventphoto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`eventid`, `user_id`, `divisionalname`, `eventname`, `eventdate`, `eventphoto`) VALUES
(8, 4, 'Mumbai Central Division', 'Community Clean-Up', '2024-08-20', 'Community Clean-Up.jpeg'),
(9, 4, 'Mumbai Central Division', 'Tree Plantation Drive', '2024-04-10', 'Tree Plantation Drive.jpeg'),
(10, 4, 'Mumbai Central Division', 'Blood Donation Camp', '2024-11-15', 'Blood Donation Camp.jpeg'),
(11, 4, 'Mumbai Central Division', 'Speed Post Delivery Awareness', '2024-11-18', 'Speed Post Delivery Awareness.jpeg'),
(12, 5, 'Mumbai Central Division', 'Tree Plantation Drive', '2024-06-10', 'Tree Plantation Drive 1.jpeg'),
(13, 5, 'Mumbai Central Division', 'Speed Post Delivery Awareness', '2024-11-18', 'Speed Post Delivery Awareness1.jpeg'),
(14, 6, 'Mumbai Central Division', 'Community Clean-Up', '2024-03-13', 'Community Clean-Up 3.jpeg'),
(15, 6, 'Mumbai Central Division', 'Community Clean-Up', '2024-10-14', 'Aadhaar Enrollment Drive.jpeg'),
(16, 7, 'Mumbai Central Division', 'Speed Post Delivery Awareness', '2024-11-18', 'Speed Post Delivery Awareness2.jpeg'),
(17, 7, 'Mumbai Central Division', 'Tree Plantation Drive', '2024-06-17', 'Tree Plantation Drive 1.jpeg'),
(18, 7, 'Mumbai Central Division', 'Aadhaar Enrollment Drive', '2024-10-01', 'Aadhaar Enrollment Drive1.jpeg'),
(19, 7, 'Mumbai Central Division', 'Community Clean-Up', '2024-11-01', 'Community Clean-Up.jpeg'),
(20, 12, 'Pune Division', 'Tree Plantation Drive', '2024-06-09', 'Tree Plantation Drive 2.jpg'),
(21, 13, 'Pune Division', 'Community Clean-Up', '2024-11-18', 'Community Clean-Up 1.jpeg'),
(22, 13, 'Pune Division', 'Blood Donation Camp', '2024-09-02', 'Blood Donation Camp2.jpeg'),
(23, 14, 'Pune Division', 'Speed Post Delivery Awareness', '2024-11-07', 'Speed Post Delivery Awareness2.jpeg'),
(24, 14, 'Pune Division', 'Aadhaar Enrollment Drive', '2024-11-18', 'Aadhaar Enrollment Drive2.jpeg'),
(25, 15, 'Pune Division', 'Blood Donation Camp', '2024-11-18', 'Blood Donation Camp3.jpeg'),
(26, 16, 'Nagpur Division', 'Tree Plantation Drive', '2024-06-19', 'Tree Plantation Drive 3.jpeg'),
(27, 16, 'Nagpur Division', 'Blood Donation Camp', '2024-11-18', 'Blood Donation Camp3.jpeg'),
(28, 17, 'Nagpur Division', 'Community Clean-Up', '2024-11-18', 'Community Clean-Up.jpeg'),
(29, 17, 'Nagpur Division', 'Speed Post Delivery Awareness', '2024-10-14', 'Speed Post Delivery Awareness3.png'),
(30, 18, 'Nagpur Division', 'Tree Plantation Drive', '2024-06-12', 'Tree Plantation Drive 4.jpeg'),
(31, 19, 'Nagpur Division', 'Aadhaar Enrollment Drive', '2024-11-18', 'Aadhaar Enrollment Drive3.jpeg'),
(32, 20, 'Nashik Division', 'Community Clean-Up', '2024-03-21', 'Community Clean-Up 1.jpeg'),
(33, 20, 'Nashik Division', 'Tree Plantation Drive', '2024-06-19', 'Tree Plantation Drive 5.jpeg'),
(34, 20, 'Nashik Division', 'Blood Donation Camp', '2024-08-30', 'Blood Donation Camp4.jpeg'),
(35, 21, 'Nashik Division', 'Blood Donation Camp', '2024-09-08', 'Blood Donation Camp4.jpeg'),
(36, 22, 'Nashik Division', 'Aadhaar Enrollment Drive', '2024-11-18', 'Aadhaar Enrollment Drive4.jpeg'),
(37, 22, 'Nashik Division', 'Tree Plantation Drive', '2024-06-11', 'Tree Plantation Drive.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `events2`
--

CREATE TABLE `events2` (
  `event_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `event_name` varchar(100) NOT NULL,
  `event_date` date NOT NULL,
  `description` text DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `event_photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events2`
--

INSERT INTO `events2` (`event_id`, `user_id`, `event_name`, `event_date`, `description`, `location`, `status`, `created_at`, `event_photo`) VALUES
(7, 7, 'Divisional Office Training Program', '2024-01-15', NULL, NULL, 'submitted', '2024-11-17 13:52:41', 'Divisional Office Training Program 15jan.jpeg'),
(8, 7, 'Postal Network Expansion Meeting', '2024-02-10', NULL, NULL, 'submitted', '2024-11-17 13:54:05', 'Postal Network Expansion Meeting 10feb.jpeg'),
(9, 7, 'Technology Upgradation Drive', '2024-07-12', NULL, NULL, 'submitted', '2024-11-17 13:54:47', 'Financial Inclusion Awareness Drive 20 april.png'),
(10, 3, 'Divisional Office Training Program', '2024-01-15', NULL, NULL, 'submitted', '2024-11-17 14:11:56', 'Divisional Office Training Program 15jan 1.jpeg'),
(11, 3, 'Postal Network Expansion Meeting', '2024-02-10', NULL, NULL, 'submitted', '2024-11-17 14:12:25', 'Postal Network Expansion Meeting 10feb 2.jpeg'),
(12, 3, 'Financial Inclusion Awareness Drive', '2024-07-12', NULL, NULL, 'submitted', '2024-11-17 14:13:41', 'Financial Inclusion Awareness Drive 20 april 1.jpeg'),
(13, 5, 'Divisional Office Training Program', '2024-01-26', NULL, NULL, 'submitted', '2024-11-17 14:21:28', 'Divisional Office Training Program 15jan 2.jpeg'),
(14, 5, 'Annual Performance Review Meet', '2024-09-18', NULL, NULL, 'submitted', '2024-11-17 14:22:16', 'Financial Inclusion Awareness Drive 20 april 2.jpeg'),
(15, 5, 'Financial Inclusion Awareness Drive', '2024-11-05', NULL, NULL, 'submitted', '2024-11-17 14:22:52', 'Postal Network Expansion Meeting 10feb 3.jpeg'),
(16, 6, 'Divisional Office Training Program', '2024-08-20', NULL, NULL, 'submitted', '2024-11-17 14:24:18', 'Postal Network Expansion Meeting 10feb 4.jpeg'),
(17, 6, 'Technology Upgradation Drive', '2024-11-06', NULL, NULL, 'submitted', '2024-11-17 14:25:04', 'Divisional Office Training Program 15jan 3.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `events3`
--

CREATE TABLE `events3` (
  `event_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `event_name` varchar(100) NOT NULL,
  `event_date` date NOT NULL,
  `description` text DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `postname` varchar(100) NOT NULL,
  `divisionalname` varchar(100) NOT NULL,
  `ministryname` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `postname`, `divisionalname`, `ministryname`, `email`, `password`, `created_at`, `updated_at`) VALUES
(4, 'Mumbai GPO', 'Mumbai Central Division', 'Mumbai', 'mumbaigpo@gmail.com', '$2y$10$3je281Pr775j.f7upCLb3.T0VuREJk5P9E4gcNdLE6HdFkb5I0U7C', '2024-11-17 13:15:14', '2024-11-17 13:15:14'),
(5, 'Byculla', 'Mumbai Central Division', 'Mumbai', 'byculla@gmail.com', '$2y$10$rZSNRrydq4ikBFmtePyVz.QsWqHsozDF3X548S0luxtdQZ6LmIvsq', '2024-11-17 13:16:33', '2024-11-17 13:16:33'),
(6, 'Tardeo', 'Mumbai Central Division', 'Mumbai', 'tardeo@gmail.com', '$2y$10$dH0qfxy9TwfrBC0lPXZ4NeqdPzuEOgIOdXC7BXoqeDQiTmTKWCLia', '2024-11-17 13:17:25', '2024-11-17 13:17:25'),
(7, 'Mahalaxmi', 'Mumbai Central Division', 'Mumbai', 'mahalaxmi@gmail.com', '$2y$10$NdkELYKW6nAKQs015akISOmQt0e9Guw1sq04b1X4MlUEW83i8vfKe', '2024-11-17 13:18:25', '2024-11-17 13:18:25'),
(12, 'Pune City H.O.', 'Pune Division', 'Mumbai', 'punecityho@gmail.com', '$2y$10$0HqGrcCBFLJ6eBx3dLMYt.OXQroWl0Le7p2kTQGMeFVLstOm10fpy', '2024-11-17 13:22:35', '2024-11-17 13:22:35'),
(13, 'Sadashiv Peth', 'Pune Division', 'Mumbai', 'sadashivpeth@gmail.com', '$2y$10$g4bTcl1FU/ZCqNZgtEAdTu5NRvxB9Rswjxvry8hM/MlLKGKTASbF.', '2024-11-17 13:23:17', '2024-11-17 13:23:17'),
(14, 'Kothrud', 'Pune Division', 'Mumbai', 'kothrud@gmail.com', '$2y$10$fNqGA7c6y6hYHXj5AlicSu5O11e3cw2rr4AmnTZA6hInoA8A/MkOO', '2024-11-17 13:24:02', '2024-11-17 13:24:02'),
(15, 'Sinhgad Road', 'Pune Division', 'Mumbai', 'sinhgadroad@gmail.com', '$2y$10$mY9Ne3kBA1e.uImRrgKTfOtzdMG1U31jkh7GcZVkwtlfn0J9d/Wki', '2024-11-17 13:24:50', '2024-11-17 13:24:50'),
(16, 'Nagpur GPO', 'Nagpur Division', 'Mumbai', 'nagpurgpo@gmail.com', '$2y$10$5sLkVY1bW0cdWFWeul8ZL.D6gRyZL8oLSzfGUmV0dRPrlGkHj8LWa', '2024-11-17 13:25:37', '2024-11-17 13:25:37'),
(17, 'Dhantoli', 'Nagpur Division', 'Mumbai', 'dhantoli@gmail.com', '$2y$10$png1P8pwoFDHcHaLagUcvuf3eeidB905XWCYlg4BPaZQUwqmJHPbi', '2024-11-17 13:26:30', '2024-11-17 13:26:30'),
(18, 'Sadar', 'Nagpur Division', 'Mumbai', 'sadar@gmail.com', '$2y$10$3hZ4O6mOEbHHODwID8nRhecM.hQfJ/35B9DclIfG.2h7dtUsGx8oS', '2024-11-17 13:27:24', '2024-11-17 13:27:24'),
(19, 'Sitabuldi', 'Nagpur Division', 'Mumbai', 'sitabuldi@gmail.com', '$2y$10$xy0k.fp/PK1G70Q8ZEI/xO6VUONOIbcPeOBcd066XLALKwNuO.Z4W', '2024-11-17 13:28:04', '2024-11-17 13:28:04'),
(20, 'Nashik H.O.', 'Nashik Division', 'Mumbai', 'nashikho@gmail.com', '$2y$10$oPOaP6ePHOjfkmBQRcBFPuuR4kboNkVW5rJhj0ReiBnwEy4u666qm', '2024-11-17 13:28:46', '2024-11-17 13:28:46'),
(21, 'Panchavati', 'Nashik Division', 'Mumbai', 'panchavati@gmail.com', '$2y$10$6X2S//IIkyJwpwWKEPJ33OqE79y1J7iECEbqQWNnI3AYNQB3dem9y', '2024-11-17 13:29:26', '2024-11-17 13:29:26'),
(22, 'Satpur', 'Nashik Division', 'Mumbai', 'satpur@gmail.com', '$2y$10$fE8ptEN3BByMNhyqpNbreuOxSKTxEQ4YXtKCKwiGLAk32mGPmEZ8u', '2024-11-17 13:30:15', '2024-11-17 13:30:15'),
(23, 'Deolali', 'Nashik Division', 'Mumbai', 'deolali@gmail.com', '$2y$10$2qCZTOxyebuZkaKQEW3A2.M8Y/s6B4JA21FTTmp.hk2Y.4ygssH6K', '2024-11-17 13:30:48', '2024-11-17 13:30:48'),
(24, 'digawade', 'kolhapur', 'delhi', 'sounhard284@gmail.com', '$2y$10$OCTjs.lnbIwqlI2MPKYaweg0my8orkbqD5gP9eODEGtTV4c8OwGXK', '2025-11-01 18:40:39', '2025-11-01 18:40:39');

-- --------------------------------------------------------

--
-- Table structure for table `users2`
--

CREATE TABLE `users2` (
  `id` int(11) NOT NULL,
  `divisionalname` varchar(100) NOT NULL,
  `ministryname` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users2`
--

INSERT INTO `users2` (`id`, `divisionalname`, `ministryname`, `email`, `password`, `created_at`, `updated_at`) VALUES
(3, 'Mumbai Central Division', 'Mumbai', 'mumbaicentraldivision@gmail.com', '$2y$10$IRROsYQO1ktwWQevv7ezAubtAoF/tTcCG8WXWhJyEVqmV4BpIeLqq', '2024-11-17 13:33:35', '2024-11-17 13:33:35'),
(5, 'Pune Division', 'Mumbai', 'punedivision@gmail.com', '$2y$10$8sBCec7DDfbyAW.amG5LNenFHGAE5taWhCrdhsg0FEpZ3jlXJibCK', '2024-11-17 13:34:51', '2024-11-17 13:34:51'),
(6, 'Nagpur Division', 'Mumbai', 'nagpurdivision@gmail.com', '$2y$10$6GDtkEHSL6xzqbXjKXakH.5wyYhm2GDVBdJyYE6ScHkQqcO6ARIhu', '2024-11-17 13:35:20', '2024-11-17 13:35:20'),
(7, 'Nashik Division', 'Mumbai', 'nashikdivision@gmail.com', '$2y$10$ju1l8PMf7itfjRYsLX2RHO5rqpmhZ0tLfBss0NNdPrhKH.y.OFIim', '2024-11-17 13:35:55', '2024-11-17 13:35:55'),
(8, 'kolhapur', 'delhi', 'sounhard3339@gmail.com', '$2y$10$ZOBUzPmWYndYwwTDqfX.xusuadU5dhhHeCvYylJ/.d0LbqHNNCZlW', '2025-11-01 18:42:53', '2025-11-01 18:42:53');

-- --------------------------------------------------------

--
-- Table structure for table `users3`
--

CREATE TABLE `users3` (
  `id` int(11) NOT NULL,
  `ministryname` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users3`
--

INSERT INTO `users3` (`id`, `ministryname`, `email`, `password`, `created_at`, `updated_at`) VALUES
(2, 'Mumbai', 'mumbai@gmail.com', '$2y$10$IjUNtyJw90exGIVIaMOqnuMiVR.UiYyFuXWmwamSmJ.MMAbnN/oOe', '2024-11-17 13:37:19', '2024-11-17 13:37:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`eventid`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `events2`
--
ALTER TABLE `events2`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `events3`
--
ALTER TABLE `events3`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users2`
--
ALTER TABLE `users2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users3`
--
ALTER TABLE `users3`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `eventid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `events2`
--
ALTER TABLE `events2`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `events3`
--
ALTER TABLE `events3`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users2`
--
ALTER TABLE `users2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users3`
--
ALTER TABLE `users3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `events2`
--
ALTER TABLE `events2`
  ADD CONSTRAINT `events2_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users2` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `events3`
--
ALTER TABLE `events3`
  ADD CONSTRAINT `events3_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users3` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
