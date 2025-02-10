-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2025 at 09:43 PM
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
-- Database: `employee`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee_department`
--

CREATE TABLE `employee_department` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `department` varchar(25) NOT NULL,
  `target` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_department`
--

INSERT INTO `employee_department` (`id`, `name`, `department`, `target`) VALUES
(1, 'Sumit', 'HR', '1'),
(2, 'Rani', 'HR', '1'),
(3, 'Raj', 'Development', '1'),
(4, 'Amit', 'DM', '1'),
(5, 'Sandeep', 'CRM', '1'),
(6, 'Neeraj', 'Support', '1'),
(7, 'John', 'HR', '0'),
(8, 'Alice', 'Development', '0'),
(9, 'Mary', 'DM', '0'),
(10, 'Paul', 'CRM', '0'),
(11, 'James', 'Support', '0'),
(12, 'Ravi', 'HR', '1'),
(13, 'Priya', 'Development', '1'),
(14, 'Anil', 'DM', '1'),
(15, 'Pooja', 'CRM', '1'),
(16, 'Karan', 'Support', '1'),
(17, 'Michael', 'HR', '0'),
(18, 'Sophia', 'Development', '0'),
(19, 'Daniel', 'DM', '0'),
(20, 'Jessica', 'CRM', '0'),
(21, 'George', 'Support', '0'),
(22, 'Vijay', 'HR', '1'),
(23, 'Kavita', 'Development', '1'),
(24, 'Deepak', 'DM', '1'),
(25, 'Shalini', 'CRM', '1'),
(26, 'Sushil', 'Support', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee_department`
--
ALTER TABLE `employee_department`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee_department`
--
ALTER TABLE `employee_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
