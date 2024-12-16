-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2024 at 03:13 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pies`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `email`, `password`, `date_created`) VALUES
(1, 'admin@gmail.com', '1', '2024-10-29 11:11:21');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notification_id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` varchar(5000) NOT NULL,
  `send_to` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notification_id`, `title`, `message`, `send_to`, `date_created`) VALUES
(1, 'Upcoming Health Check Reminder', 'This is a health reminder please', '0', '2024-10-29 17:55:27'),
(5, 'Change In Pension Rate', 'Employers Contribution is now 10% while Employees Contribution is 5%', 'PIES1111', '2024-10-30 02:35:31'),
(6, 'Update Of Pension Rate', 'Employers Contribution is now 15% while Employees Contribution is 8%', 'PIES0001', '2024-10-30 02:36:29');

-- --------------------------------------------------------

--
-- Table structure for table `pensioner`
--

CREATE TABLE `pensioner` (
  `pensioner_id` varchar(255) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 1,
  `salary` int(255) DEFAULT NULL,
  `allowance` int(255) DEFAULT NULL,
  `years_of_service` varchar(255) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pensioner`
--

INSERT INTO `pensioner` (`pensioner_id`, `fullname`, `email`, `password`, `status`, `salary`, `allowance`, `years_of_service`, `date_created`) VALUES
('PIES0001', 'Suleiman Abdullateef Suleiman', 'sule@gmail.com', '12345', 1, 50000, 30000, '25', '2024-10-29 12:22:15'),
('PIES1111', 'Ibrahim Nurudeen Shehu', 'nur@gmail.com', '12345', 1, NULL, NULL, NULL, '2024-10-29 12:03:19'),
('PIES2222', 'Jibrin Abdullahi Jibrin', 'jb@gmail.com', '12345', 0, NULL, NULL, NULL, '2024-10-29 12:07:25'),
('PIES3332', 'JOHNNNU', 'SABDU@GMAIL.COM', '12345', 1, NULL, NULL, NULL, '2024-10-30 12:14:44');

-- --------------------------------------------------------

--
-- Table structure for table `pension_rate`
--

CREATE TABLE `pension_rate` (
  `employer_contribution` int(255) DEFAULT NULL,
  `employee_contribution` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pension_rate`
--

INSERT INTO `pension_rate` (`employer_contribution`, `employee_contribution`) VALUES
(10, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `pensioner`
--
ALTER TABLE `pensioner`
  ADD PRIMARY KEY (`pensioner_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notification_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
