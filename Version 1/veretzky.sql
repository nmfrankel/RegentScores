-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 03, 2020 at 12:38 AM
-- Server version: 5.7.24
-- PHP Version: 7.1.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `veretzky`
--

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE `scores` (
  `id` int(11) NOT NULL,
  `student_id` text NOT NULL,
  `date` text NOT NULL,
  `subject` text NOT NULL,
  `grade` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scores`
--

INSERT INTO `scores` (`id`, `student_id`, `date`, `subject`, `grade`) VALUES
(1, '201500003', '6/13/2017', 'U.S. History', '93'),
(3, '020150001', '', 'OWES BOOKS', ''),
(4, '021300048', '', 'OWES BOOKS', ''),
(5, '021300103', '6/14/2017', 'English', '66'),
(6, '021300141', '6/14/2017', 'English', '66'),
(7, '100303861', '6/14/2017', 'English', '72'),
(8, '100422217', '', 'OWES BOOKS', ''),
(9, '100438957', '', 'OWES BOOKS', ''),
(10, '100489454', '', 'OWES BOOKS', ''),
(11, '100548501', '', 'OWES BOOKS', ''),
(12, '100683017', '', 'OWES BOOKS', ''),
(13, '100838902', '', 'OWES BOOKS', ''),
(14, '100853712', '', 'OWES BOOKS', ''),
(15, '200804001', '6/14/2017', 'English', '80'),
(16, '200804002', '6/14/2017', 'English', '86'),
(17, '200804005', '6/14/2017', 'English', '69'),
(18, '200804006', '6/14/2017', 'English', '74'),
(19, '200804010', '6/13/2017', 'U.S. History', '98'),
(20, '200804010', '6/14/2017', 'English', '83'),
(21, '200804017', '', 'OWES BOOKS', ''),
(22, '200804018', '6/14/2017', 'English', '95'),
(23, '200804019', '6/14/2017', 'English', '85'),
(24, '201104005', '', 'OWES BOOKS', ''),
(25, '201104007', '', 'OWES BOOKS', ''),
(26, '201104009', '', 'OWES BOOKS', ''),
(27, '201104015', '', 'OWES BOOKS', ''),
(28, '201104016', '', 'OWES BOOKS', ''),
(29, '201104017', '', 'OWES BOOKS', ''),
(30, '201307412', '6/14/2017', 'English', '66'),
(31, '201500002', '6/13/2017', 'U.S. History', '99'),
(33, '201500004', '', 'OWES BOOKS', ''),
(34, '201500005', '6/13/2017', 'U.S. History', '88'),
(35, '201500006', '', 'OWES BOOKS', ''),
(36, '201600002', '', 'OWES BOOKS', ''),
(37, '613000001', '', 'OWES BOOKS', ''),
(38, '613000006', '', 'OWES BOOKS', ''),
(39, '613000011', '', 'OWES BOOKS', ''),
(41, '613000019', '', 'OWES BOOKS', ''),
(42, '613000021', '', 'OWES BOOKS', ''),
(43, '613000027', '6/13/2017', 'U.S. History', '95'),
(44, '613000030', '6/13/2017', 'U.S. History', '92'),
(45, '613000031', '6/13/2017', 'U.S. History', '94'),
(46, '613000032', '', 'OWES BOOKS', ''),
(47, '613000033', '6/13/2017', 'U.S. History', '97'),
(48, '613000036', '6/13/2017', 'U.S. History', '98'),
(49, '613000038', '', 'OWES BOOKS', ''),
(50, '613000046', '6/13/2017', 'U.S. History', '97'),
(51, '613000048', '', 'OWES BOOKS', ''),
(52, '613000049', '', 'OWES BOOKS', ''),
(53, '613000050', '', 'OWES BOOKS', ''),
(54, '613000052', '6/13/2017', 'U.S. History', '88'),
(55, '613000054', '', 'OWES BOOKS', ''),
(56, '613000005', '6/13/2017', 'Algebra I', '69'),
(57, '613000008', '6/13/2017', 'Algebra I', '80'),
(58, '613000012', '6/13/2017', 'Algebra I', '75'),
(59, '613000013', '6/13/2017', 'Algebra I', '79'),
(60, '613000017', '6/13/2017', 'Algebra I', '78'),
(61, '613000025', '6/13/2017', 'Algebra I', '80'),
(62, '201104002', '6/13/2017', 'Algebra I', '79'),
(63, '201104004', '6/13/2017', 'Algebra I', '69'),
(64, '201104013', '6/13/2017', 'Algebra I', '80'),
(65, '201600001', '6/14/2017', 'Biololgy', '83'),
(66, '613000002', '6/14/2017', 'Biololgy', '76'),
(67, '613000004', '6/14/2017', 'Biololgy', '88'),
(68, '613000005', '6/14/2017', 'Biololgy', '80'),
(69, '613000008', '6/14/2017', 'Biololgy', '86'),
(70, '613000012', '6/14/2017', 'Biololgy', '78'),
(71, '613000013', '6/14/2017', 'Biololgy', '72'),
(72, '613000017', '6/14/2017', 'Biololgy', '85'),
(73, '613000022', '6/14/2017', 'Biololgy', '90'),
(74, '613000024', '6/14/2017', 'Biololgy', '88'),
(75, '613000025', '6/14/2017', 'Biololgy', '68'),
(76, '100838900', '6/14/2017', 'Biololgy', '70'),
(77, '100619485', '6/14/2017', 'Biololgy', '70'),
(78, '201600001', '6/13/2017', 'Algebra I', '69');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `first` text NOT NULL,
  `last` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `first`, `last`) VALUES
(201500003, 'Nosson', 'Frankel');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
