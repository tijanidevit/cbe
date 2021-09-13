-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2019 at 05:13 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cbe_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(99) NOT NULL,
  `access_pin` varchar(99) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `access_pin`, `active`, `date_inserted`) VALUES
(1, 'Admin', 'MFZ5VVhoaGFBQVV0MjJ6SDJzM0lEZz09', 1, '2019-08-08 12:44:26');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(150) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_name`, `active`, `date_inserted`) VALUES
(1, 'MTH 101', 1, '2019-08-19 10:28:26'),
(2, 'COM 212', 1, '2019-08-08 17:02:30');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `department_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `department_name` varchar(150) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `faculty_id`, `department_name`, `active`, `date_inserted`) VALUES
(1, 0, 'CS', 1, '2019-08-08 16:19:29'),
(2, 0, 'CTE', 1, '2019-08-08 16:19:29'),
(3, 2, 'SLT', 1, '2019-08-20 09:08:59');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `exam_id` int(11) NOT NULL,
  `session` varchar(30) NOT NULL,
  `department_id` varchar(200) NOT NULL,
  `level_id` smallint(4) NOT NULL,
  `studentship_type` varchar(10) NOT NULL DEFAULT 'Full Time',
  `course_id` mediumint(6) NOT NULL,
  `total_questions` smallint(4) NOT NULL,
  `duration` time NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'not active',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`exam_id`, `session`, `department_id`, `level_id`, `studentship_type`, `course_id`, `total_questions`, `duration`, `status`, `active`, `date_inserted`) VALUES
(1, '2018/2019', '', 1, '', 1, 10, '02:00:00', 'not active', 0, '2019-08-19 11:41:18'),
(2, '2018/2019', '1;2;3;', 1, 'full time;', 1, 10, '00:04:00', 'active', 1, '2019-08-20 16:12:47');

-- --------------------------------------------------------

--
-- Table structure for table `exam_log`
--

CREATE TABLE `exam_log` (
  `exam_log_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_ip` varchar(10) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `exam_result`
--

CREATE TABLE `exam_result` (
  `exam_result_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `score` mediumint(6) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam_result`
--

INSERT INTO `exam_result` (`exam_result_id`, `exam_id`, `student_id`, `score`, `active`, `date_inserted`) VALUES
(1, 2, 0, 2, 1, '2019-08-20 15:17:56'),
(2, 2, 8, 2, 1, '2019-08-20 15:32:42');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `faculty_id` int(11) NOT NULL,
  `faculty_name` varchar(500) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`faculty_id`, `faculty_name`, `active`, `date_inserted`) VALUES
(1, 'ewseee', 1, '2019-08-19 16:46:47'),
(2, 'School of Pure and Applied Science', 1, '2019-08-19 16:14:29');

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE `levels` (
  `level_id` mediumint(9) NOT NULL,
  `level_name` varchar(20) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`level_id`, `level_name`, `active`, `date_inserted`) VALUES
(1, '100L', 1, '2019-08-08 17:02:01'),
(2, '200L', 1, '2019-08-08 17:02:01');

-- --------------------------------------------------------

--
-- Table structure for table `ongoing_exam`
--

CREATE TABLE `ongoing_exam` (
  `ongoing_exam_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `centre` varchar(90) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ongoing_exam`
--

INSERT INTO `ongoing_exam` (`ongoing_exam_id`, `exam_id`, `centre`, `active`) VALUES
(1, 1, 'AUD', 0),
(2, 2, 'Lab', 0);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `question_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `question_description` text NOT NULL,
  `options` varchar(500) NOT NULL,
  `answer` varchar(300) NOT NULL,
  `answer_type` varchar(15) NOT NULL,
  `attachment` varchar(99) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question_id`, `exam_id`, `question_description`, `options`, `answer`, `answer_type`, `attachment`, `active`, `date_inserted`) VALUES
(1, 2, 'A group of market women sell at least one of yam, plantain and maize. 12 of them sell maize, 10 sell yam and 14 sell plantain. 5 sell plantain and maize, 4 sell yam and maize, 2 sell yam and plantain only while 3 sell all the three items. How many women are in the group?', '25&&19&&18&&17&&77&&', '25', 'single', '', 1, '2019-08-20 14:46:46'),
(2, 2, 'The sum of two numbers is twice their difference. If the difference of the numbers is P, find the larger of the two numbers', 'p/2&&3p/2&&5p/2&&3p&&', '3p/2', 'single', '', 1, '2019-08-19 14:09:02');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `setting_id` smallint(4) NOT NULL,
  `school_logo` varchar(100) NOT NULL,
  `school_name` varchar(100) NOT NULL,
  `school_type` varchar(50) NOT NULL DEFAULT 'university',
  `studentship_mode` varchar(90) NOT NULL DEFAULT 'both',
  `ongoing_exam` tinyint(1) NOT NULL DEFAULT '0',
  `activation_key` varchar(100) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`setting_id`, `school_logo`, `school_name`, `school_type`, `studentship_mode`, `ongoing_exam`, `activation_key`, `active`, `date_inserted`) VALUES
(1, 'school-logo.png', 'XYZ School', 'university', 'full time;part time;pre degree;post degree;', 0, '', 1, '2019-08-08 17:01:37');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `matric_number` varchar(30) NOT NULL,
  `profile_picture` varchar(30) NOT NULL,
  `department_id` int(11) NOT NULL,
  `level_id` tinyint(4) NOT NULL,
  `studentship_type` varchar(15) NOT NULL DEFAULT 'Full Time',
  `fullname` varchar(99) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `matric_number`, `profile_picture`, `department_id`, `level_id`, `studentship_type`, `fullname`, `active`, `date_inserted`) VALUES
(8, 'PN/CS/16/04763', 'student_1566296379.jpg', 3, 1, 'full time', 'Eva Holmes', 1, '2019-08-20 10:19:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`exam_id`);

--
-- Indexes for table `exam_log`
--
ALTER TABLE `exam_log`
  ADD PRIMARY KEY (`exam_log_id`);

--
-- Indexes for table `exam_result`
--
ALTER TABLE `exam_result`
  ADD PRIMARY KEY (`exam_result_id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`faculty_id`);

--
-- Indexes for table `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`level_id`);

--
-- Indexes for table `ongoing_exam`
--
ALTER TABLE `ongoing_exam`
  ADD PRIMARY KEY (`ongoing_exam_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `exam_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `exam_log`
--
ALTER TABLE `exam_log`
  MODIFY `exam_log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_result`
--
ALTER TABLE `exam_result`
  MODIFY `exam_result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `faculty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `levels`
--
ALTER TABLE `levels`
  MODIFY `level_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ongoing_exam`
--
ALTER TABLE `ongoing_exam`
  MODIFY `ongoing_exam_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `setting_id` smallint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
