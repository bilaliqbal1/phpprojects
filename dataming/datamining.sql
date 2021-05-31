-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2020 at 05:30 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `datamining`
--

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE `data` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `gender` varchar(30) NOT NULL,
  `cnic` varchar(30) NOT NULL,
  `age` varchar(30) NOT NULL,
  `address` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`id`, `name`, `fname`, `email`, `phone`, `gender`, `cnic`, `age`, `address`) VALUES
(1, 'John Due', 'Due', 'Due@gmail.com', '0320-2323922', 'male', '2938292900101010', '21', 'Los Angels'),
(2, 'Kamran', 'razzak', 'Ashir12@gmail.com', '028290101033', 'male', '8399210234455', '23', 'Pakistan'),
(3, 'Raza', 'qazi', 'raza12@gmail.com', '028290101033', 'male', '8399210234455', '20', 'Pakistan'),
(4, 'Rabail', 'ali', 'rabail12@gmail.com', '028290101033', 'female', '8399210234455', '25', 'Pakistan'),
(5, 'Areeb', 'khan', 'areeb12@gmail.com', '028290101033', 'female', '8399210234455', '27', 'Pakistan'),
(6, 'Babu', 'bhaiya', 'babu12@gmail.com', '028290101033', 'male', '8399210234455', '23', 'India'),
(7, 'Kaleen', 'bhaiya', 'kaleen12@gmail.com', '028290101033', 'male', '8399210234455', '26', 'India'),
(8, 'Akshay', 'kumar', 'akshay12@gmail.com', '028290101033', '', '8399210234455', '', 'Pakistan'),
(9, 'Shahrukh', 'khan', 'shahrukh12@gmail.com', '028290101033', 'male', '8399210234455', '43', 'India'),
(10, 'Salman', 'khan', 'salman12@gmail.com', '028290101033', 'male', '8399210234455', '32', 'India'),
(11, 'Varun', 'dhawan', 'dhawan12@gmail.com', '028290101033', 'male', '8399210234455', '25', 'India'),
(12, 'Kat', 'rina', 'katrina12@gmail.com', '028290101033', 'female', '', '25', 'India'),
(13, 'Alia', 'ali', 'aliza12@gmail.com', '028290101033', 'female', '8399210234455', '37', 'Pakistan'),
(14, 'Flora', 'gucci', 'flora12@gmail.com', '028290101033', 'female', '8399210234455', '36', 'Francee'),
(15, 'Vidia', 'kumari', 'kumari12@gmail.com', '028290101033', 'female', '8399210234455', '21', 'California'),
(16, 'Nadia', 'kamran', 'nadia12@gmail.com', '028290101033', 'female', '8399210234455', '17', 'Pakistan'),
(17, 'Razaq', 'khan', 'razzaq12@gmail.com', '028290101033', 'male', '', '19', 'Pakistan'),
(18, 'Yousaf', 'ali', 'yousaf12@gmail.com', '028290101033', 'male', '8399210234455', '37', 'Pakistan'),
(19, 'Imran', 'ali', 'imran12@gmail.com', '028290101033', 'male', '8399210234455', '29', 'Pakistan'),
(20, 'Anand', 'kumar', 'anand12@gmail.com', '028290101033', 'male', '8399210234455', '18', 'Pakistan'),
(21, 'Naveen', 'kumar', 'naveen12@gmail.com', '028290101033', 'male', '8399210234455', '29', 'Pakistan'),
(22, 'Vajanti', 'mala', 'vajanti12@gmail.com', '028290101033', 'female', '8399210234455', '39', 'Pakistan'),
(23, 'Sapna', 'kumari', 'sapna12@gmail.com', '028290101033', 'female', '8399210234455', '28', 'Pakistan'),
(24, 'Jon', 'the don', 'johndon12@gmail.com', '028290101033', 'male', '8399210234455', '17', 'Pakistan'),
(25, 'Ela', 'lopez', 'ela12@gmail.com', '028290101033', 'female', '8399210234455', '39', 'Los Angels'),
(26, 'Lucifer', 'morningstar', 'lucifer@gmail.com', '028290101033', 'male', '8399210234455', '38', 'Los Angels'),
(27, 'Tony', 'stark', 'stark12@gmail.com', '028290101033', 'male', '8399210234455', '29', 'Marvels'),
(28, 'Can', 'adam', 'can12@gmail.com', '028290101033', 'male', '8399210234455', '19', 'California'),
(29, 'Adam', 'josaf', 'adam12@gmail.com', '028290101033', 'male', '8399210234455', '30', 'Pakistan'),
(30, 'Kishore', 'kumar', 'kishore26@gmail.com', '028290101033', 'male', '8399210234455', '20', 'Pakistan'),
(31, 'Shaam', 'raj', 'sham12@gmail.com', '028290101033', 'male', '8399210234455', '45', 'Pakistan'),
(32, 'Anaya', 'ali', 'anaya12@gmail.com', '028290101033', 'female', '8399210234455', '34', 'Dubai'),
(33, 'Samad', 'Ali', 'samad12@gmail.com', '028290101033', 'male', '8399210234455', '23', 'Pakistan'),
(34, 'Bilal', 'Khan', 'bilal@gmail.com', '028290101033', 'male', '8399210234455', '23', 'Pakistan'),
(35, 'Adnan', 'ali', 'Adnan12@gmail.com', '028290101033', 'male', '8399210234455', '56', 'Pakistan'),
(36, 'Govinda', 'malhi', 'govinda12@gmail.com', '028290101033', 'male', '8399210234455', '24', 'Pakistan'),
(37, 'Shahfahad', 'memon', 'memon12@gmail.com', '028290101033', 'male', '8399210234455', '14', 'Pakistan'),
(38, 'Haleem', 'khan', 'haleem12@gmail.com', '028290101033', 'male', '8399210234455', '34', 'Pakistan'),
(39, 'Afzal', 'ali', 'afzal12@gmail.com', '028290101033', 'male', '8399210234455', '39', 'Pakistan'),
(40, 'Anwar', 'sathio', 'anwar12@gmail.com', '028290101033', 'male', '8399210234455', '39', 'Pakistan'),
(41, 'Mazhar', 'ali', 'mazhar12@gmail.com', '028290101033', 'male', '8399210234455', '28', 'Pakistan'),
(42, 'Kamran', 'ali', 'alikamran12@gmail.com', '028290101033', 'male', '8399210234455', '25', 'Pakistan'),
(43, 'Abdullah', 'khan', 'Abdullah12@gmail.com', '028290101033', 'male', '8399210234455', '37', 'Pakistan'),
(44, 'Shareef', 'razzak', 'shareef12@gmail.com', '028290101033', 'male', '8399210234455', '26', 'Pakistan'),
(45, 'Amber', 'khan', 'amberkhan12@gmail.com', '028290101033', 'male', '8399210234455', '28', 'Pakistan'),
(46, 'Mariam', 'khan', 'mariam12@gmail.com', '028290101033', 'female', '8399210234455', '28', 'Pakistan'),
(47, 'Rabia', 'ali', 'rabia12@gmail.com', '028290101033', 'female', '8399210234455', '24', 'Pakistan'),
(48, 'Espanoza', 'doe', 'espanoza12@gmail.com', '028290101033', 'male', '8399210234455', '23', 'Los Angels'),
(49, 'Mukesh', 'kumar', 'mukesh12@gmail.com', '028290101033', 'male', '8399210234455', '27', 'Pakistan'),
(50, 'Niranjan', 'kumar', 'niranjan12@gmail.com', '028290101033', 'male', '8399210234455', '39', 'Pakistan'),
(51, 'Neel', 'raj', 'neelraj12@gmail.com', '028290101033', 'male', '8399210234455', '9', 'India'),
(52, 'Beena', 'kumari', 'beena13@gmail.com', '028290101033', 'female', '8399210234455', '23', 'Pakistan'),
(53, 'Nomi', 'khan', 'nomi1234@gmail.com', '028290101033', 'male', '8399210234455', '17', 'Pakistan'),
(54, 'Haseeb', 'nawaz', 'haseeb1342@gmail.com', '028290101033', 'male', '8399210234455', '28', 'Pakistan'),
(55, 'Bheem', 'Chotta', 'bheem123@gmail.com', '028290101033', 'male', '8399210234455', '27', 'Dholakpur'),
(56, 'Chutki', 'Kumari', 'chutki132@gmail.com', '028290101033', 'female', '8399210234455', '39', 'Dholakpur'),
(57, 'Raju', 'samad', 'raju653@gmail.com', '028290101033', 'male', '8399210234455', '29', 'Dholakpur'),
(58, 'Tiger', 'Shrof', 'tiger12@gmail.com', '028290101033', 'male', '8399210234455', '18', 'India'),
(59, 'Alanidial', 'angel', 'amanidial25@gmail.com', '028290101033', 'male', '8399210234455', '19', 'Los Angels'),
(60, 'Ananya', 'panday', 'ananya@gmail.com', '028290101033', 'female', '8399210234455', '20', 'India'),
(61, 'Fahad', 'ali', 'fahad12@gmail.com', '028290101033', 'male', '8399210234455', '39', 'Pakistan'),
(62, 'Simran', 'raj', 'Simran12@gmail.com', '028290101033', 'female', '8399210234455', '35', 'India'),
(63, 'Ubaib', 'khan', 'ubaid12@gmail.com', '028290101033', 'male', '8399210234455', '36', 'Pakistan'),
(64, 'Saif', 'samo', 'saif12@gmail.com', '028290101033', 'male', '8399210234455', '26', 'Pakistan'),
(65, 'Dileep', 'kumar', 'dileep12@gmail.com', '028290101033', 'male', '8399210234455', '16', 'Pakisan'),
(66, 'Lakesh', 'kumar', 'lakesh35@gmail.com', '028290101033', 'male', '8399210234455', '27', 'Pakistan'),
(67, 'Mohit', 'raj', 'mohit12@gmail.com', '028290101033', 'male', '8399210234455', '37', 'Pakistan'),
(68, 'Lavaniya', 'bai', 'lavaniya12@gmail.com', '028290101033', 'female', '8399210234455', '27', 'Paris'),
(69, 'Nasir', 'ali', 'nasir12@gmail.com', '028290101033', 'male', '8399210234455', '17', 'Pakistan'),
(70, 'Saddam', 'ali', 'saddam12@gmail.com', '028290101033', 'male', '8399210234455', '28', 'Pakistan'),
(71, 'Disha', 'kumari', 'disha12@gmail.com', '028290101033', 'female', '8399210234455', '38', 'Pakistan'),
(72, 'Diksha', 'kumar', 'diksha12@gmail.com', '028290101033', 'female', '8399210234455', '35', 'Pakistan'),
(73, 'Hina', 'khan', 'hina12@gmail.com', '028290101033', 'female', '8399210234455', '26', 'Saudi Arabia'),
(74, 'Nikita', 'bai', 'nikita12@gmail.com', '028290101033', 'female', '8399210234455', '29', 'Pakistan'),
(75, 'Mujeeb', 'khan', 'mujeeb12@gmail.com', '028290101033', 'male', '8399210234455', '27', 'Pakistan'),
(76, 'Bhawan', 'perkash', 'bhawan12@gmail.com', '028290101033', 'male', '8399210234455', '36', 'Pakistan'),
(77, 'Kabul', 'Oman', 'Kabul12@gmail.com', '028290101033', 'male', '8399210234455', '37', 'Pakistan'),
(78, 'Rahul', 'kumar', 'rahul12@gmail.com', '028290101033', 'male', '8399210234455', '26', 'Pakistan'),
(79, 'Neeraj', 'kumar', 'neeraj12@gmail.com', '028290101033', 'male', '8399210234455', '14', 'Pakistan'),
(80, 'Sunil', 'kumar', 'sunil12@gmail.com', '028290101033', 'male', '8399210234455', '18', 'Pakistan'),
(81, 'Pardeep', 'raj', 'pardeep12@gmail.com', '028290101033', 'male', '8399210234455', '17', 'Pakistan'),
(82, 'Chander', 'perkash', 'chander12@gmail.com', '028290101033', 'male', '8399210234455', '14', 'Pakistan'),
(83, 'Rekha', 'kumari', 'rekha12@gmail.com', '028290101033', 'female', '8399210234455', '19', 'Pakistan'),
(84, 'Akhtar', 'baloch', 'akhtar12@gmail.com', '028290101033', 'male', '8399210234455', '38', 'Pakistan'),
(85, 'Jai', 'kumar', 'kumarjai12@gmail.com', '028290101033', 'male', '8399210234455', '31', 'Pakistan'),
(86, 'Arti', 'kumari', 'Arti12@gmail.com', '028290101033', 'female', '8399210234455', '20', 'Pakistan'),
(87, 'Pawan', 'kumar', 'pawan12@gmail.com', '028290101033', 'male', '8399210234455', '22', 'India'),
(88, 'Kaveri', 'kumari', 'kaveri12@gmail.com', '028290101033', 'female', '8399210234455', '21', 'Pakistan'),
(89, 'Shiv', 'kumar', 'shiv12@gmail.com', '028290101033', 'male', '8399210234455', '27', 'India'),
(90, 'Kirshan', 'kumar', 'kirshan12@gmail.com', '028290101033', 'male', '8399210234455', '25', 'India'),
(91, 'Hassan', 'razzak', 'hassan12@gmail.com', '028290101033', 'male', '8399210234455', '49', 'Pakistan'),
(92, 'Haroon', 'rasheed', 'haroon12@gmail.com', '028290101033', 'male', '8399210234455', '37', 'Pakistan'),
(93, 'Iqbal', 'khan', 'iqbal12@gmail.com', '028290101033', 'male', '8399210234455', '25', 'Pakistan'),
(94, 'Wakar', 'zaka', 'wakar12@gmail.com', '028290101033', 'male', '8399210234455', '32', 'Pakistan'),
(95, 'Jeewat', 'kumar', 'jeewat12@gmail.com', '028290101033', 'male', '8399210234455', '43', 'Pakistan'),
(96, 'Kaweeta', 'kumari', 'kaweeta12@gmail.com', '028290101033', 'female', '8399210234455', '33', 'Pakistan'),
(97, 'Aneeta', 'kumari', 'Aneeta12@gmail.com', '028290101033', 'female', '8399210234455', '43', 'Pakistan'),
(98, 'Lajpat', 'amrat', 'lajpat12@gmail.com', '028290101033', 'male', '8399210234455', '21', 'Pakistan'),
(99, 'Noman', 'ali', 'noman12@gmail.com', '028290101033', 'male', '8399210234455', '11', 'Pakistan'),
(100, 'Anil', 'kapoor', 'anil12@gmail.com', '028290101033', 'male', '8399210234455', '18', 'India'),
(101, 'Arjun', 'kapoor', 'arjun12@gmail.com', '028290101033', 'male', '8399210234455', '17', 'India'),
(102, 'Amitabh', 'bachan', 'amitabh12@gmail.com', '028290101033', 'male', '8399210234455', '26', 'India'),
(103, 'Kajol', 'devgun', 'kajol12@gmail.com', '028290101033', 'female', '8399210234455', '23', 'India');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `email`, `password`) VALUES
(1, 'samad0182@gmail.com', '123'),
(2, 'bilal@yahoo.com', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data`
--
ALTER TABLE `data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
