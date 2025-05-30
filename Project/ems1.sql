-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2025 at 08:52 AM
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
-- Database: `ems1`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `dept_id` int(11) NOT NULL,
  `dept_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `color_code` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`dept_id`, `dept_name`, `description`, `color_code`) VALUES
(1, 'art & design', 'ui designer', ' #f78fb3'),
(2, 'development', 'developer', '  #70a1ff');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `type` enum('employee','admin','manager','hr') DEFAULT 'employee'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `username`, `email`, `phone`, `address`, `gender`, `dob`, `password`, `type`) VALUES
(1, 'niloy gomes', 'n@example.com', '01712188215', 'Bashundhara', 'Male', '2025-05-01', 'Abcdefgh12@', 'employee'),
(3, 'sabiha eitu', NULL, NULL, NULL, NULL, NULL, NULL, 'employee'),
(5, 'sam', NULL, NULL, NULL, NULL, NULL, '123', 'hr'),
(6, 'mithila', NULL, NULL, NULL, NULL, NULL, '111', 'manager');

-- --------------------------------------------------------

--
-- Table structure for table `employee_department`
--

CREATE TABLE `employee_department` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `dept_id` int(11) DEFAULT NULL,
  `join_date` date DEFAULT NULL,
  `designation` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_department`
--

INSERT INTO `employee_department` (`id`, `employee_id`, `dept_id`, `join_date`, `designation`) VALUES
(4, 5, 1, NULL, NULL),
(5, 6, 2, NULL, NULL),
(6, 1, 1, '2025-05-26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employee_training`
--

CREATE TABLE `employee_training` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `training_id` int(11) DEFAULT NULL,
  `assigned_by` int(11) DEFAULT NULL,
  `assign_date` date DEFAULT curdate(),
  `training_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_training`
--

INSERT INTO `employee_training` (`id`, `employee_id`, `training_id`, `assigned_by`, `assign_date`, `training_date`) VALUES
(1, 1, 1, 6, '2025-05-25', '0000-00-00'),
(2, 3, 2, 6, '2025-05-25', '0000-00-00'),
(3, 1, 2, 6, '2025-05-25', '0000-00-00'),
(4, 1, 2, 6, '2025-05-25', '0000-00-00'),
(5, 1, 2, 6, '2025-05-25', '0000-00-00'),
(6, 1, 3, 6, '2025-05-25', '0000-00-00'),
(7, 1, 3, 6, '2025-05-25', '0000-00-00'),
(8, 1, 3, 6, '2025-05-25', '0000-00-00'),
(9, 1, 4, 6, '2025-05-25', '0000-00-00'),
(10, 3, 5, 6, '2025-05-25', '0000-00-00'),
(11, 1, 6, 6, '2025-05-26', '0000-00-00'),
(12, 1, 6, 6, '2025-05-26', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `feature_id` int(11) NOT NULL,
  `feature_name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_feature_access`
--

CREATE TABLE `role_feature_access` (
  `id` int(11) NOT NULL,
  `role` enum('employee','admin','manager','hr') DEFAULT NULL,
  `feature_id` int(11) DEFAULT NULL,
  `access` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `training_programs`
--

CREATE TABLE `training_programs` (
  `training_id` int(11) NOT NULL,
  `training_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `training_programs`
--

INSERT INTO `training_programs` (`training_id`, `training_name`, `description`) VALUES
(1, 'learnign101', NULL),
(2, 'something', NULL),
(3, 'sdgadhazg', NULL),
(4, 'learnign102', NULL),
(5, 'web', NULL),
(6, 'dotnet2.0', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_department`
--
ALTER TABLE `employee_department`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `dept_id` (`dept_id`);

--
-- Indexes for table `employee_training`
--
ALTER TABLE `employee_training`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `training_id` (`training_id`),
  ADD KEY `assigned_by` (`assigned_by`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`feature_id`);

--
-- Indexes for table `role_feature_access`
--
ALTER TABLE `role_feature_access`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feature_id` (`feature_id`);

--
-- Indexes for table `training_programs`
--
ALTER TABLE `training_programs`
  ADD PRIMARY KEY (`training_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `employee_department`
--
ALTER TABLE `employee_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `employee_training`
--
ALTER TABLE `employee_training`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `feature_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role_feature_access`
--
ALTER TABLE `role_feature_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `training_programs`
--
ALTER TABLE `training_programs`
  MODIFY `training_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee_department`
--
ALTER TABLE `employee_department`
  ADD CONSTRAINT `employee_department_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`),
  ADD CONSTRAINT `employee_department_ibfk_2` FOREIGN KEY (`dept_id`) REFERENCES `departments` (`dept_id`);

--
-- Constraints for table `employee_training`
--
ALTER TABLE `employee_training`
  ADD CONSTRAINT `employee_training_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`),
  ADD CONSTRAINT `employee_training_ibfk_2` FOREIGN KEY (`training_id`) REFERENCES `training_programs` (`training_id`),
  ADD CONSTRAINT `employee_training_ibfk_3` FOREIGN KEY (`assigned_by`) REFERENCES `employee` (`id`);

--
-- Constraints for table `role_feature_access`
--
ALTER TABLE `role_feature_access`
  ADD CONSTRAINT `role_feature_access_ibfk_1` FOREIGN KEY (`feature_id`) REFERENCES `features` (`feature_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
