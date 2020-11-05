-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2020 at 10:49 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bloodbank`
--

-- --------------------------------------------------------

--
-- Table structure for table `available_samples`
--

CREATE TABLE `available_samples` (
  `id` int(11) NOT NULL,
  `registration_no` varchar(20) NOT NULL,
  `blood_group` varchar(5) NOT NULL,
  `quantity` int(7) NOT NULL,
  `last_updated_at` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `available_samples`
--

INSERT INTO `available_samples` (`id`, `registration_no`, `blood_group`, `quantity`, `last_updated_at`) VALUES
(40, 'HS123456', 'A+', 47, '2020-10-26'),
(41, 'HS123456', 'AB+', 4, '2020-10-26'),
(42, 'HS123456', 'B-', 12, '2020-10-26'),
(43, 'HS987654', 'O+', 85, '2020-10-26'),
(44, 'HS987654', 'A-', 51, '2020-10-26'),
(45, 'HS987654', 'AB-', 2, '2020-10-26');

-- --------------------------------------------------------

--
-- Table structure for table `hospitals`
--

CREATE TABLE `hospitals` (
  `id` int(11) NOT NULL,
  `hospital_name` varchar(50) NOT NULL,
  `registration_no` varchar(15) NOT NULL,
  `email` varchar(20) NOT NULL,
  `phn_no` varchar(13) NOT NULL,
  `password` varchar(70) NOT NULL,
  `address` varchar(30) NOT NULL,
  `state` varchar(15) NOT NULL,
  `city` varchar(15) NOT NULL,
  `zip` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hospitals`
--

INSERT INTO `hospitals` (`id`, `hospital_name`, `registration_no`, `email`, `phn_no`, `password`, `address`, `state`, `city`, `zip`) VALUES
(13, 'Apollo Hospitals', 'HS123456', 'info@apollo.com', '9852147852', '$2y$10$ziSoBgPrwlNipbnyp6nmueWAONGBNiV1IOXvxGWmzYb38.90SjdPa', '224/ C Salimar Cross', 'Tamil Nadu', 'Chennai', 7896541),
(14, 'Fortis', 'HS987654', 'info@fortis.com', '9874563214', '$2y$10$aMR1SfezduUX9hynbHiXO.mSAyI2w7zItNvR9I6i.Iguv7iuqvk06', 'Ruby, Kolkata', 'West Bengal', 'Kolkata', 700125);

-- --------------------------------------------------------

--
-- Table structure for table `receivers`
--

CREATE TABLE `receivers` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `blood_group` varchar(5) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `phn_no` varchar(13) NOT NULL,
  `password` varchar(100) NOT NULL,
  `address` varchar(60) NOT NULL,
  `state` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `zip` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `receivers`
--

INSERT INTO `receivers` (`id`, `name`, `blood_group`, `dob`, `email`, `phn_no`, `password`, `address`, `state`, `city`, `zip`) VALUES
(14, 'Souvik Sarkar', 'AB+', '1996-06-13', 'souviksarkar1396@gmail.com', '9804191249', '$2y$10$SyRMtk8qF2MNaHUhZokUq.5WTTwL.FDlpTDydoJMqxxUk3maXtx7y', '94/A Anandamath,', 'West Bengal', 'Kolkata', 743144);

-- --------------------------------------------------------

--
-- Table structure for table `requested_samples`
--

CREATE TABLE `requested_samples` (
  `id` int(20) NOT NULL,
  `hospital_name` varchar(30) NOT NULL,
  `registration_no` varchar(20) NOT NULL,
  `blood_group` varchar(5) NOT NULL,
  `requested_by` varchar(30) NOT NULL,
  `request_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `requested_samples`
--

INSERT INTO `requested_samples` (`id`, `hospital_name`, `registration_no`, `blood_group`, `requested_by`, `request_date`) VALUES
(22, 'Apollo Hospitals', 'HS123456', 'A+', 'souviksarkar1396@gmail.com', '2020-10-26'),
(23, 'Apollo Hospitals', 'HS123456', 'A+', 'souviksarkar1396@gmail.com', '2020-10-26'),
(24, 'Apollo Hospitals', 'HS123456', 'A+', 'souviksarkar1396@gmail.com', '2020-10-26'),
(25, 'Fortis', 'HS987654', 'A-', 'souviksarkar1396@gmail.com', '2020-10-26'),
(26, 'Apollo Hospitals', 'HS123456', 'AB+', 'souviksarkar1396@gmail.com', '2020-10-26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `available_samples`
--
ALTER TABLE `available_samples`
  ADD PRIMARY KEY (`id`),
  ADD KEY `registration_no_to_hospital_reg_no` (`registration_no`);

--
-- Indexes for table `hospitals`
--
ALTER TABLE `hospitals`
  ADD PRIMARY KEY (`registration_no`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `receivers`
--
ALTER TABLE `receivers`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `requested_samples`
--
ALTER TABLE `requested_samples`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `available_samples`
--
ALTER TABLE `available_samples`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `hospitals`
--
ALTER TABLE `hospitals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `receivers`
--
ALTER TABLE `receivers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `requested_samples`
--
ALTER TABLE `requested_samples`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `available_samples`
--
ALTER TABLE `available_samples`
  ADD CONSTRAINT `registration_no_to_hospital_reg_no` FOREIGN KEY (`registration_no`) REFERENCES `hospitals` (`registration_no`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
