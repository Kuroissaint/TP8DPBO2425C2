-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2025 at 01:36 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tp_mvc25`
--

-- --------------------------------------------------------

--
-- Table structure for table `lecturers`
--

CREATE TABLE `lecturers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `nidn` varchar(20) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `join_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `subject_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lecturers`
--

INSERT INTO `lecturers` (`id`, `name`, `nidn`, `phone`, `join_date`, `created_at`, `subject_id`) VALUES
(1, 'Dr. Ahmad Wijaya, M.Kom', '0123456701', '081234567801', '2018-03-15', '2025-11-17 18:12:59', 1),
(2, 'Prof. Siti Rahayu, M.Sc., Ph.D', '0123456702', '081234567802', '2015-08-22', '2025-11-17 18:12:59', 2),
(3, 'Diana Puspita, S.Kom., M.T', '0123456703', '081234567803', '2019-11-05', '2025-11-17 18:12:59', 3),
(4, 'Budi Santoso, S.Si., M.Kom', '0123456704', '081234567804', '2017-06-30', '2025-11-17 18:12:59', 4),
(5, 'Dr. Rina Melati, M.Eng', '0123456705', '081234567805', '2016-01-10', '2025-11-17 18:12:59', 5),
(6, 'Ir. Joko Prasetyo, M.T', '0123456706', '081234567806', '2020-09-18', '2025-11-17 18:12:59', NULL),
(7, 'Lisa Permata, S.Kom., M.Sc', '0123456707', '081234567807', '2019-04-25', '2025-11-17 18:12:59', NULL),
(8, 'Dr. Andi Rahman, M.Kom', '0123456708', '081234567808', '2014-12-08', '2025-11-17 18:12:59', NULL),
(9, 'Maya Sari, S.T., M.Kom', '0123456709', '081234567809', '2021-02-14', '2025-11-17 18:12:59', NULL),
(10, 'Prof. Hendra Gunawan, Ph.D', '0123456710', '081234567810', '2013-07-20', '2025-11-17 18:12:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `majors`
--

CREATE TABLE `majors` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `established_year` year(4) NOT NULL,
  `student_count` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `majors`
--

INSERT INTO `majors` (`id`, `name`, `established_year`, `student_count`, `created_at`) VALUES
(1, 'Computer Science', '2005', 350, '2025-11-18 10:27:15'),
(2, 'Information Systems', '2008', 280, '2025-11-18 10:27:15'),
(3, 'Software Engineering', '2010', 200, '2025-11-18 10:27:15'),
(4, 'Data Science', '2015', 150, '2025-11-18 10:27:15');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `credits` int(11) NOT NULL,
  `subject_code` varchar(20) NOT NULL,
  `major_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `credits`, `subject_code`, `major_id`, `created_at`) VALUES
(1, 'Web Programming', 3, 'CS001', 1, '2025-11-18 10:27:15'),
(2, 'Database Systems', 3, 'CS002', 1, '2025-11-18 10:27:15'),
(3, 'Algorithms and Data Structures', 4, 'CS003', 1, '2025-11-18 10:27:15'),
(4, 'Computer Networks', 3, 'CS004', 1, '2025-11-18 10:27:15'),
(5, 'IT Project Management', 3, 'IS001', 2, '2025-11-18 10:27:15'),
(6, 'Enterprise Systems', 4, 'IS002', 2, '2025-11-18 10:27:15'),
(7, 'System Analysis and Design', 3, 'IS003', 2, '2025-11-18 10:27:15'),
(8, 'Artificial Intelligence', 3, 'SE001', 3, '2025-11-18 10:27:15'),
(9, 'Machine Learning', 4, 'SE002', 3, '2025-11-18 10:27:15'),
(10, 'Data Mining', 3, 'SE003', 3, '2025-11-18 10:27:15'),
(11, 'Cloud Computing', 3, 'DS001', 4, '2025-11-18 10:27:15'),
(12, 'Internet of Things', 3, 'DS002', 4, '2025-11-18 10:27:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lecturers`
--
ALTER TABLE `lecturers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nidn` (`nidn`),
  ADD UNIQUE KEY `nidn_2` (`nidn`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `majors`
--
ALTER TABLE `majors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subject_code` (`subject_code`),
  ADD UNIQUE KEY `subject_code_2` (`subject_code`),
  ADD KEY `major_id` (`major_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lecturers`
--
ALTER TABLE `lecturers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `majors`
--
ALTER TABLE `majors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lecturers`
--
ALTER TABLE `lecturers`
  ADD CONSTRAINT `lecturers_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects_ibfk_1` FOREIGN KEY (`major_id`) REFERENCES `majors` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
