-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2023 at 11:31 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `planet`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `attendance_id` int(11) NOT NULL,
  `attenrollment_id` int(11) DEFAULT NULL,
  `attendance_date` date DEFAULT NULL,
  `status` enum('Present','Absent','Tardy','') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`attendance_id`, `attenrollment_id`, `attendance_date`, `status`) VALUES
(34, 4, '2023-08-23', 'Present'),
(35, 9, '2023-08-24', 'Tardy'),
(36, 8, '2023-08-24', 'Absent'),
(37, 2, '2023-08-24', 'Present'),
(38, 4, '2023-08-27', 'Absent'),
(39, 4, '2023-08-27', 'Tardy'),
(40, 10, '2023-09-04', 'Present'),
(41, 8, '2023-09-05', 'Present'),
(42, 2, '2023-09-04', 'Tardy'),
(43, 9, '2023-09-03', 'Tardy'),
(44, 10, '2023-09-03', 'Absent'),
(45, 11, '2023-09-06', 'Tardy'),
(46, 10, '2023-09-06', 'Absent'),
(47, 10, '2023-09-06', 'Absent'),
(48, 9, '2023-09-06', 'Present'),
(49, 9, '2023-09-07', 'Present'),
(50, 11, '2023-09-07', 'Present'),
(51, 4, '2023-09-07', 'Tardy'),
(52, 4, '2023-09-08', 'Present'),
(53, 4, '2023-09-08', 'Present'),
(54, 4, '2023-09-09', 'Present'),
(55, 9, '2023-09-10', 'Present'),
(56, 10, '2023-09-10', 'Absent');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(100) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `instructor` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`, `start_date`, `end_date`, `instructor`) VALUES
(4, 'English - Group 1', '2023-07-31', '2023-08-06', 'Erlinda S. Edreneli'),
(5, 'English - Group 2', '2023-07-22', '2023-08-06', 'Erlinda S. Edreneli'),
(6, 'Maths 1', '2023-09-04', '2023-10-04', 'D.Edreneli'),
(7, 'Elementary 1', '2022-09-01', '0000-00-00', 'Erlinda S. Edreneli');

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `enrollment_id` int(11) NOT NULL,
  `enstudent_id` int(11) DEFAULT NULL,
  `encourse_id` int(11) DEFAULT NULL,
  `enrollment_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enrollments`
--

INSERT INTO `enrollments` (`enrollment_id`, `enstudent_id`, `encourse_id`, `enrollment_date`) VALUES
(2, 2, 5, '2023-08-11'),
(4, 3, 4, '2023-08-06'),
(8, 4, 5, '0000-00-00'),
(9, 5, 5, '2023-08-21'),
(10, 6, 6, '2023-09-04'),
(11, 7, 7, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `expense_id` int(11) NOT NULL,
  `expense_description` varchar(200) DEFAULT NULL,
  `amount` decimal(5,2) DEFAULT NULL,
  `expense_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`expense_id`, `expense_description`, `amount`, `expense_date`) VALUES
(2, 'Fatura e rrymes', '17.45', '2023-08-25'),
(3, 'Fatura e ujit', '8.00', '2023-08-26'),
(4, 'Fatura e rrymes', '25.00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `grade_id` int(11) NOT NULL,
  `grenrollment_id` int(11) DEFAULT NULL,
  `grade` decimal(4,2) DEFAULT NULL,
  `grade_description` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`grade_id`, `grenrollment_id`, `grade`, `grade_description`) VALUES
(15, 4, '19.99', 'updated score'),
(26, 4, '87.42', 'student grade update because of a technical mistake'),
(27, 9, '97.00', 'test grade'),
(28, 10, '41.90', 'tesssstttt'),
(29, 10, '45.55', 'aha'),
(30, 4, '22.20', 'ok');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `payenrollment_id` int(11) DEFAULT NULL,
  `amount` decimal(4,2) DEFAULT NULL,
  `payment_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `payenrollment_id`, `amount`, `payment_date`) VALUES
(100, 9, '75.00', '2023-09-06'),
(103, 2, '24.00', '2023-09-06');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `first_name`, `last_name`, `email`, `phone`, `address`) VALUES
(2, 'Filan', 'Fisteku', 'filani@fisteku.com', '44123456', 'Prizren'),
(3, 'John', 'Doe', 'j.doe@gmail.com', '041996556', 'Arbane, Prizren'),
(4, 'Armando', 'Maradona', 'armando@gmail.com', '045987456', 'Zhur, Prizren'),
(5, 'Albert', 'Einstein', 'albert@stein.de', '49116458', 'Lubizhde'),
(6, 'Shero', 'Liebe', 'shero@liebe.de', '045678945', 'Dojchland'),
(7, 'Arall ', 'Hoxhallar', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`attendance_id`),
  ADD KEY `enrollment_id` (`attenrollment_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`enrollment_id`),
  ADD KEY `student_id` (`enstudent_id`),
  ADD KEY `course_id` (`encourse_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`expense_id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`grade_id`),
  ADD KEY `enrollment_id` (`grenrollment_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `enrollment_id` (`payenrollment_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `enrollment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `expense_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `grade_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_ibfk_1` FOREIGN KEY (`attenrollment_id`) REFERENCES `enrollments` (`enrollment_id`);

--
-- Constraints for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `enrollments_ibfk_1` FOREIGN KEY (`enstudent_id`) REFERENCES `students` (`student_id`),
  ADD CONSTRAINT `enrollments_ibfk_2` FOREIGN KEY (`encourse_id`) REFERENCES `courses` (`course_id`);

--
-- Constraints for table `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_ibfk_1` FOREIGN KEY (`grenrollment_id`) REFERENCES `enrollments` (`enrollment_id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`payenrollment_id`) REFERENCES `enrollments` (`enrollment_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
