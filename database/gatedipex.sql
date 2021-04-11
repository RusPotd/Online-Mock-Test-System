-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2020 at 05:54 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gatedipex`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `exam` varchar(50) NOT NULL,
  `quesId` int(11) NOT NULL,
  `quesType` varchar(10) NOT NULL,
  `ans` varchar(10) NOT NULL,
  `review` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `name`, `exam`, `quesId`, `quesType`, `ans`, `review`) VALUES
(17, 'rus', 'fgh', 1, 'MCQ', '1,', 2),
(18, 'rus', 'fgh', 2, 'MSQ', '1,2,', 2),
(19, 'rus', 'fgh', 3, 'MCQ', '', 2),
(20, 'ajay', 'fgh', 1, 'MCQ', '3,', 2),
(21, 'ajay', 'fgh', 2, 'MSQ', '1,2,', 2),
(22, 'ajay', 'fgh', 3, 'MCQ', '2,', 2),
(23, 'rus', 'pica', 4, 'MCQ', '2,', 1),
(24, 'ajay', 'pica', 4, 'MCQ', '1,', 2),
(25, 'ajay', 'pica', 5, 'MCQ', '4,', 2),
(27, 'ajay', 'Mock 3', 12, 'MSQ', '1,4,', 2),
(28, 'ajay', 'Mock 3', 11, 'MCQ', '1,', 2),
(29, 'pratik', 'fgh', 1, 'MCQ', '2,', 2),
(30, 'pratik', 'fgh', 2, 'MSQ', '4,', 2),
(31, 'pratik', 'fgh', 3, 'MCQ', '1,', 2),
(34, 'pratik', 'pica', 4, 'MCQ', '1,', 1),
(35, 'pratik', 'pica', 5, 'MCQ', '', 0),
(36, 'pratik', 'Mock 3', 12, 'MSQ', '4,', 2),
(37, 'pratik', 'Mock 3', 11, 'MCQ', '1,', 2),
(38, 'rus', 'Mock 3', 11, 'MCQ', '', 1),
(39, 'rus', 'Mock 3', 12, 'MSQ', '', 0),
(40, 'asd', 'fgh', 1, 'MCQ', '1,', 2),
(41, 'asd', 'fgh', 2, 'MSQ', '2,4,', 2),
(42, 'asd', 'fgh', 3, 'MCQ', '1,', 2),
(43, 'asd', 'pica', 4, 'MCQ', '1,', 2),
(44, 'asd', 'pica', 5, 'MCQ', '4,', 2),
(45, 'asd', 'Mock 3', 11, 'MCQ', '3,', 2),
(46, 'asd', 'Mock 3', 12, 'MSQ', '1,3,', 2);

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `time` int(11) NOT NULL,
  `marks` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `result` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `name`, `time`, `marks`, `active`, `result`) VALUES
(15, 'fgh', 2, 54, 1, 1),
(17, 'pica', 412, 412, 1, 1),
(24, 'Mock 3', 80, 10, 1, 1),
(33, 'mock test 1', 120, 120, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `examName` varchar(20) NOT NULL,
  `type` varchar(10) NOT NULL,
  `marks` int(11) NOT NULL,
  `negative` int(11) NOT NULL,
  `question` varchar(500) NOT NULL,
  `image` varchar(200) DEFAULT NULL,
  `option1` varchar(500) DEFAULT NULL,
  `option2` varchar(500) DEFAULT NULL,
  `option3` varchar(500) DEFAULT NULL,
  `option4` varchar(500) DEFAULT NULL,
  `original` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `examName`, `type`, `marks`, `negative`, `question`, `image`, `option1`, `option2`, `option3`, `option4`, `original`) VALUES
(1, 'fgh', 'MCQ', 4, 1, 'Im best', NULL, 'yes', 'no', 'cant say', '50-50', '3,'),
(2, 'fgh', 'MSQ', 5, 1, 'what is right?', NULL, 'you', 'me', 'not me but you', 'we both', '1,2,'),
(3, 'fgh', 'MCQ', 5, 4, 'fgh?', NULL, 'a', 'a', 'a', 'a', '2,'),
(4, 'pica', 'MCQ', 4, 1, 'asd', NULL, 'a', 's', 'd', 's', '3'),
(5, 'pica', 'MCQ', 5, 2, 'how are you', NULL, 'fine', 'ok', 'best', 'good', '2'),
(11, 'Mock 3', 'MCQ', 5, 5, 'answer is 2?', NULL, '0', '1', '2', '3', '3'),
(12, 'Mock 3', 'MSQ', 4, 1, 'MSQ dummy question?', NULL, 'option 1', 'option 2', 'option 3', 'option 4', '1,4'),
(13, 'gate1', 'MCQ', 4, 1, 'asd?', NULL, 'a', 's', 'd', 'a', '1'),
(14, 'gate1', 'MCQ', 5, 2, 'ajshdkagasd?', NULL, 'fg', 'gh', 'gh', 'df', '2'),
(15, 'GATE MOCK 3', 'MCQ', 4, 1, 'What is your name?', NULL, 'Rushiehs', 'Rajkumar', 'potdar', 'i dont know', '1'),
(16, 'GATE MOCK 3', 'MCQ', 4, 1, 'what is your problem?', NULL, 'me', 'you', 'anyone', 'no one', '1'),
(17, 'GATE MOCK 3', 'MSQ', 4, 1, 'What is your responsibility?', NULL, 'a', 'b', 'c', 'd', '1'),
(18, 'GATE MOCK 3', 'MSQ', 4, 1, 'your surname?', NULL, 'aasd', 'asd', 'sda', 'dsa', '2,4'),
(19, 'GATE MOCK 2', 'MCQ', 4, 1, 'My favoraite?', NULL, '1', '2', '3', '4', '1'),
(20, 'Laro de rusom', 'MSQ', 4, 1, 'asd asd asda', NULL, 'asd', 'asd', 'asd', 'asd', '1,2'),
(21, 'mock test 1', 'MCQ', 4, 1, 'asd', NULL, 'asd', 'asd', 'asd', 'asd', '1'),
(22, 'mock test 1', 'MCQ', 4, 1, 'test q 1', '12.png', 'a', 's', 'd', 'f', '1'),
(23, 'mock test 1', 'MCQ', 4, 1, 'test q 2', '', 'q', 'w', 'e', 'r', '1'),
(24, 'mock test 1', 'MCQ', 4, 1, 'test q 3', '', 'd', 'f', 'g', 'h', '1'),
(25, 'mock test 1', 'MCQ', 4, 1, 'test q 5', '', 'q', 'w', 'e', 'r', '3');

-- --------------------------------------------------------

--
-- Table structure for table `rank`
--

CREATE TABLE `rank` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `exam` varchar(50) NOT NULL,
  `score` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rank`
--

INSERT INTO `rank` (`id`, `name`, `exam`, `score`, `total`) VALUES
(5, 'rus', 'fgh', 4, 14),
(9, 'ajay', 'fgh', 14, 14),
(11, 'rus', 'pica', -1, 4),
(13, 'ajay', 'pica', -3, 9),
(21, 'ajay', 'Mock 3', -1, 9),
(35, 'pratik', 'fgh', -6, 14),
(37, 'pratik', 'Mock 3', -6, 9),
(39, 'rus', 'Mock 3', 0, 9),
(41, 'asd', 'pica', -3, 9),
(42, 'asd', 'Mock 3', 4, 9),
(43, 'pratik', 'pica', -1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `report` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `username`, `name`, `email`, `report`) VALUES
(2, 'rus', 'Ruhsikeskh kposodf', 'rushjikeshpiudra@gauil;.xom', 'im ahappu to announce rhat i wiukk ne completing this wenbsite as soon as posinle '),
(3, 'rus', 'lalalalala', 'rajkuarpoydat299@gmall.com', 'this is my 2nd id whovh iwa tt t ise for pc ionlu'),
(4, 'ajay', 'ajay gidd', 'asd@asd.com', 'This is new feedback');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `username` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact` varchar(11) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`username`, `name`, `email`, `contact`, `password`) VALUES
('ajay', 'ajay annaso gidd', 'ajay@ajay.com', '5625983654', 'ajay'),
('pratik', 'pratik patil', 'pratik@patil.com', '1231231232', 'asd'),
('rus', 'rushikesh rajkumar potdar', 'asd@asd.com', '7719811174', 'rus');

-- --------------------------------------------------------

--
-- Table structure for table `time`
--

CREATE TABLE `time` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `exam` varchar(50) NOT NULL,
  `start` timestamp NOT NULL DEFAULT current_timestamp(),
  `end` timestamp NOT NULL DEFAULT current_timestamp(),
  `finish` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `time`
--

INSERT INTO `time` (`id`, `name`, `exam`, `start`, `end`, `finish`) VALUES
(13, 'rus', 'fgh', '2020-12-12 22:36:41', '2020-12-12 23:21:41', 1),
(18, 'ajay', 'fgh', '2020-12-13 01:28:17', '2020-12-13 02:13:17', 1),
(19, 'rus', 'pica', '2020-12-13 05:54:09', '2020-12-13 13:26:09', 1),
(23, 'ajay', 'pica', '2020-12-13 07:16:43', '2020-12-13 14:48:43', 1),
(38, 'ajay', 'Mock 3', '2020-12-13 11:04:44', '2020-12-13 11:24:44', 1),
(59, 'pratik', 'fgh', '2020-12-14 03:31:26', '2020-12-14 03:33:26', 1),
(61, 'pratik', 'Mock 3', '2020-12-14 03:32:14', '2020-12-14 04:52:14', 1),
(63, 'rus', 'Mock 3', '2020-12-14 03:51:21', '2020-12-14 05:11:21', 1),
(65, 'asd', 'fgh', '2020-12-15 01:06:38', '2020-12-15 01:08:38', 1),
(66, 'asd', 'pica', '2020-12-15 01:08:48', '2020-12-15 02:08:48', 1),
(67, 'asd', 'Mock 3', '2020-12-15 01:09:15', '2020-12-15 02:29:15', 1),
(69, 'pratik', 'pica', '2020-12-15 02:44:34', '2020-12-15 09:36:34', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rank`
--
ALTER TABLE `rank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD UNIQUE KEY `name` (`username`);

--
-- Indexes for table `time`
--
ALTER TABLE `time`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `rank`
--
ALTER TABLE `rank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `time`
--
ALTER TABLE `time`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
