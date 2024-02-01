-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2024 at 06:34 AM
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
-- Database: `mydatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(64) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_login` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `email`, `phone`, `address`, `photo`, `username`, `password`, `creation_date`, `last_login`) VALUES
(1, 'thomasraj@gmail.com', '9886735112', 'No 87 Gandhi Nagar, KK Colony, Nanmagalam, Chennai - 600067', 'admins/1.jpg', 'Thomas Rajan', 'thomas@12', '2024-01-29 05:44:10', '2024-02-01 05:06:05');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `CourseID` int(11) NOT NULL,
  `UniversityID` int(11) DEFAULT NULL,
  `CourseType` varchar(2) DEFAULT NULL,
  `CourseName` varchar(255) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `Country` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`CourseID`, `UniversityID`, `CourseType`, `CourseName`, `Description`, `Country`) VALUES
(40, 7, 'UG', 'BAa (Hons)', ' Business Studies and Human Resource Management', ' Manchester'),
(41, 7, 'UG', 'BA (Hons) ', 'Business Studies and Management', ' Manchester'),
(42, 7, 'UG', 'BA (Hons) ', 'Business Studies and Marketing', ' Manchester'),
(43, 7, 'UG', 'BA (Hons)', ' Digital Media', ' Manchester'),
(44, 7, 'UG', 'BA (Hons)', ' Events Management', ' Manchester'),
(45, 7, 'UG', 'BAcc (Hons)', ' Accountancy and Finance', ' Manchester'),
(46, 7, 'UG', 'BSc (Hons) ', 'Applied Biological Sciences', ' Manchester'),
(47, 7, 'UG', 'BSc (Hons) ', 'Software Development with Cyber Security', ' Manchester'),
(48, 7, 'UG', 'BSc (Hons)', ' Sport and Exercise Science', ' Manchester'),
(49, 7, 'UG', 'BSc Nursing - ', 'Adult', ' Manchester'),
(50, 7, 'UG', 'BSc Nursing -', ' Mental Health', ' Manchester'),
(51, 7, 'UG', 'LLB (Hons) ', 'Law', ' Manchester'),
(52, 7, 'UG', 'LLB Law: ', 'Accelerated Graduate', ' Manchester'),
(54, 8, 'UG', 'BAA ', 'Modern Languages and International Politics', ' North Shore'),
(55, 8, 'UG', 'BAcc (Hons)', ' Accountancy', ' North Shore'),
(56, 8, 'UG', 'BACc (Hons) ', 'Accountancy and Finance', ' North Shore'),
(57, 8, 'UG', 'BSc (Hons)', ' Applied Biological Sciences', ' North Shore'),
(58, 8, 'UG', 'BSc (Hons) ', 'Applied Mathematics', ' North Shore'),
(59, 8, 'UG', 'BSc (Hons) ', 'Professional Education (Secondary, Chemistry or Physics)', ' North Shore'),
(60, 8, 'UG', 'BSc (Hons)', ' Ecology and Conservation', ' North Shore'),
(61, 8, 'UG', 'BSc (Hons) ', 'Environmental Geography and Outdoor Education', ' North Shore'),
(62, 8, 'UG', 'BSc (Hons) ', 'Environmental Science and Outdoor Education', ' North Shore'),
(63, 8, 'UG', 'BSc (Hons) ', 'Mathematics', ' North Shore'),
(64, 8, 'UG', 'BSc (Hons)', ' Mathematics and Psychology', ' North Shore'),
(65, 8, 'UG', 'BSc (Hons) ', 'Nursing - Mental Health', ' North Shore'),
(66, 8, 'UG', 'BSc (Hons) ', 'Nursing – Adult', ' North Shore'),
(67, 8, 'UG', 'BSc (Hons) ', 'Psychology', ' North Shore'),
(68, 8, 'UG', 'BSc (Hons)', ' Software Development with Cyber Security', ' North Shore'),
(69, 8, 'UG', 'BSc (Hons) ', 'Sport and Exercise Science', ' North Shore'),
(70, 8, 'UG', NULL, NULL, ' North Shore'),
(71, 8, 'UG', 'BA ', 'Modern Languages and International Politics', ' North Shore'),
(72, 8, 'UG', 'BAcc (Hons)', ' Accountancy', ' North Shore'),
(73, 8, 'UG', 'BAcc (Hons) ', 'Accountancy and Finance', ' North Shore'),
(74, 8, 'UG', 'BSc (Hons)', ' Applied Biological Sciences', ' North Shore'),
(75, 8, 'UG', 'BSc (Hons) ', 'Applied Mathematics', ' North Shore'),
(76, 8, 'UG', 'BSc (Hons) ', 'Professional Education (Secondary, Chemistry or Physics)', ' North Shore'),
(77, 8, 'UG', 'BSc (Hons)', ' Ecology and Conservation', ' North Shore'),
(78, 8, 'UG', 'BSc (Hons) ', 'Environmental Geography and Outdoor Education', ' North Shore'),
(79, 8, 'UG', 'BSc (Hons) ', 'Environmental Science and Outdoor Education', ' North Shore'),
(80, 8, 'UG', 'BSc (Hons) ', 'Mathematics', ' North Shore'),
(81, 8, 'UG', 'BSc (Hons)', ' Mathematics and Psychology', ' North Shore'),
(82, 8, 'UG', 'BSc (Hons) ', 'Nursing - Mental Health', ' North Shore'),
(83, 8, 'UG', 'BSc (Hons) ', 'Nursing – Adult', ' North Shore'),
(84, 8, 'UG', 'BSc (Hons) ', 'Psychology', ' North Shore'),
(85, 8, 'UG', 'BSc (Hons)', ' Software Development with Cyber Security', ' North Shore'),
(86, 8, 'UG', 'BSc (Hons) ', 'Sport and Exercise Science', ' North Shore'),
(87, 8, 'UG', NULL, NULL, ' North Shore'),
(88, 8, 'UG', 'BA ', 'Modern Languages and International Politics', ' North Shore'),
(89, 8, 'UG', 'BAcc (Hons)', ' Accountancy', ' North Shore'),
(90, 8, 'UG', 'BAcc (Hons) ', 'Accountancy and Finance', ' North Shore'),
(91, 8, 'UG', 'BSc (Hons)', ' Applied Biological Sciences', ' North Shore'),
(92, 8, 'UG', 'BSc (Hons) ', 'Applied Mathematics', ' North Shore'),
(93, 8, 'UG', 'BSc (Hons) ', 'Professional Education (Secondary, Chemistry or Physics)', ' North Shore'),
(94, 8, 'UG', 'BSc (Hons)', ' Ecology and Conservation', ' North Shore'),
(95, 8, 'UG', 'BSc (Hons) ', 'Environmental Geography and Outdoor Education', ' North Shore'),
(96, 8, 'UG', 'BSc (Hons) ', 'Environmental Science and Outdoor Education', ' North Shore'),
(97, 8, 'UG', 'BSc (Hons) ', 'Mathematics', ' North Shore'),
(98, 8, 'UG', 'BSc (Hons)', ' Mathematics and Psychology', ' North Shore'),
(99, 8, 'UG', 'BSc (Hons) ', 'Nursing - Mental Health', ' North Shore'),
(100, 8, 'UG', 'BSc (Hons) ', 'Nursing – Adult', ' North Shore'),
(101, 8, 'UG', 'BSc (Hons) ', 'Psychology', ' North Shore'),
(102, 8, 'UG', 'BSc (Hons)', ' Software Development with Cyber Security', ' North Shore'),
(103, 8, 'UG', 'BSc (Hons) ', 'Sport and Exercise Science', ' North Shore');

-- --------------------------------------------------------

--
-- Table structure for table `latest_updates`
--

CREATE TABLE `latest_updates` (
  `update_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `latest_updates`
--

INSERT INTO `latest_updates` (`update_id`, `title`, `image_path`) VALUES
(1, 'SDSD', 'latestupdates/university3.PNG'),
(2, 'Maxico University', 'latestupdates/university2.PNG');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `StaffID` int(11) NOT NULL,
  `StaffName` varchar(255) NOT NULL,
  `Designation` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `EmailID` varchar(100) NOT NULL,
  `PhoneNumber` varchar(20) NOT NULL,
  `ImagePath` varchar(255) DEFAULT NULL,
  `permission_country` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`StaffID`, `StaffName`, `Designation`, `Address`, `Username`, `Password`, `EmailID`, `PhoneNumber`, `ImagePath`, `permission_country`) VALUES
(3, 'angel jansi', 'developer', 'No 86 nehru road b,v nagar , nanganallur', 'angel672', 'angel@123', 'angel12@gmail.com', '9887367789', 'staff_images/408806785_870703158038066_27297696697746243_n.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `staff_permission`
--

CREATE TABLE `staff_permission` (
  `permissionID` int(11) NOT NULL,
  `staffID` int(11) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff_permission`
--

INSERT INTO `staff_permission` (`permissionID`, `staffID`, `country`) VALUES
(5, 3, 'Birmingham'),
(6, 3, 'Palmerston North');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `StudentID` int(11) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Course` varchar(100) DEFAULT NULL,
  `CourseType` varchar(50) DEFAULT NULL,
  `Duration` varchar(50) DEFAULT NULL,
  `University` varchar(100) DEFAULT NULL,
  `XMarksheet` varchar(255) DEFAULT NULL,
  `XIIMarksheet` varchar(255) DEFAULT NULL,
  `GraduationMarksheets` varchar(255) DEFAULT NULL,
  `VisaRefusalLetters` text DEFAULT NULL,
  `PassportFront` varchar(255) DEFAULT NULL,
  `PassportBack` varchar(255) DEFAULT NULL,
  `PassportNo` varchar(20) DEFAULT NULL,
  `StudentEmail` varchar(100) DEFAULT NULL,
  `StudentWhatsApp` varchar(20) DEFAULT NULL,
  `CommunicationContactNo` varchar(20) DEFAULT NULL,
  `CommunicationEmail` varchar(100) DEFAULT NULL,
  `MaritalStatus` varchar(20) DEFAULT NULL,
  `PreviousVisaRefusal` text DEFAULT NULL,
  `registration_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`StudentID`, `FirstName`, `LastName`, `Course`, `CourseType`, `Duration`, `University`, `XMarksheet`, `XIIMarksheet`, `GraduationMarksheets`, `VisaRefusalLetters`, `PassportFront`, `PassportBack`, `PassportNo`, `StudentEmail`, `StudentWhatsApp`, `CommunicationContactNo`, `CommunicationEmail`, `MaritalStatus`, `PreviousVisaRefusal`, `registration_date`) VALUES
(1, 'Angel', 'Jansi', 'MCA', 'Postgraduate', '3yrs', 'Anna University', '100', '200', '2000', 'No', 'yes', 'yes', 'PYU76785', 'jansijo5756@gmail.com', '9008392009', '9223789009', 'jansijo5756@gmail.com', 'Married', 'yes', '2024-01-23');

-- --------------------------------------------------------

--
-- Table structure for table `universities`
--

CREATE TABLE `universities` (
  `UniversityID` int(11) NOT NULL,
  `UniversityName` varchar(255) NOT NULL,
  `TutionFees` decimal(10,2) NOT NULL,
  `Discount` varchar(50) NOT NULL,
  `UniversityDescription` text NOT NULL,
  `Locations` text NOT NULL,
  `CourseDuration` varchar(50) NOT NULL,
  `ImagePath` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `universities`
--

INSERT INTO `universities` (`UniversityID`, `UniversityName`, `TutionFees`, `Discount`, `UniversityDescription`, `Locations`, `CourseDuration`, `ImagePath`) VALUES
(7, 'Arden University', 34455656.00, '20%', 'Arden University is a private, for-profit teaching university in the United Kingdom. It offers a variety of undergraduate and post-graduate programmes with both blended and online distance learning delivery options. Its head office is in Coventry with study centres in Birmingham, Manchester, London and Berlin. Originally established as Resource Development International (RDI) in 1990, it was later bought by Capella Education and awarded university status by the British government in 2015. Since August 2016, it has been owned by Global University Systems. It is named after the Arden area of England, where its Coventry headquarters are situated.', ' United Kingdom', '3yrs', 'image/arden.png'),
(8, 'Unitec Institute of Technology', 6789546.00, '10%', 'Unitec was founded as Carrington Technical Institute in 1976 on the Mt Albert site on Carrington road, which has 55 hectares of grounds. The area on which Unitec\'s main campus is located was formerly home to the Whau Lunatic Asylum, later known as Carrington Hospital. The hospital building (Building 1) is an imposing brick Italianate-Romanesque structure, located at the northern end of the Unitec Campus. The hospital building was the largest in New Zealand when it was built in the 1860s. The hospital was decommissioned during the early 1990s, and the building is now part of Unitec.\r\n\r\nThe name changed to Carrington Polytechnic in 1987 and then to \"Unitec Institute of Technology\" in 1994. Unitec applied for University status in 1999, but the Government ruled, somewhat controversially, in 2005 that Unitec did not meet the academic criteria of a university and would remain an Institute of Technology.[2]', ' New Zealand', '3yrs', 'image/uni.png'),
(9, 'Anzsdix University', 6789596.00, '20%', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable.', 'ffg,utyt', '2yrs', 'image/logo-1.jpg'),
(10, 'Arden University', 589000.00, '10%', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable.', 'india,chennai', '2yrs', 'image/shopping (1).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `university_countries`
--

CREATE TABLE `university_countries` (
  `CountryID` int(11) NOT NULL,
  `UniversityID` int(11) DEFAULT NULL,
  `UniversityName` varchar(255) DEFAULT NULL,
  `Country` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `university_countries`
--

INSERT INTO `university_countries` (`CountryID`, `UniversityID`, `UniversityName`, `Country`) VALUES
(1, 10, 'Arden University', ' Whau Lunatic Asylum'),
(2, 10, 'Arden University', 'Palmerston North'),
(3, 10, 'Arden University', ' North Shore'),
(4, 10, 'Arden University', 'Birmingham');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`CourseID`),
  ADD KEY `UniversityID` (`UniversityID`);

--
-- Indexes for table `latest_updates`
--
ALTER TABLE `latest_updates`
  ADD PRIMARY KEY (`update_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`StaffID`);

--
-- Indexes for table `staff_permission`
--
ALTER TABLE `staff_permission`
  ADD PRIMARY KEY (`permissionID`),
  ADD KEY `staffID` (`staffID`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`StudentID`);

--
-- Indexes for table `universities`
--
ALTER TABLE `universities`
  ADD PRIMARY KEY (`UniversityID`);

--
-- Indexes for table `university_countries`
--
ALTER TABLE `university_countries`
  ADD PRIMARY KEY (`CountryID`),
  ADD KEY `UniversityID` (`UniversityID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `CourseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `latest_updates`
--
ALTER TABLE `latest_updates`
  MODIFY `update_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `StaffID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `staff_permission`
--
ALTER TABLE `staff_permission`
  MODIFY `permissionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `StudentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `universities`
--
ALTER TABLE `universities`
  MODIFY `UniversityID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `university_countries`
--
ALTER TABLE `university_countries`
  MODIFY `CountryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`UniversityID`) REFERENCES `universities` (`UniversityID`);

--
-- Constraints for table `staff_permission`
--
ALTER TABLE `staff_permission`
  ADD CONSTRAINT `staff_permission_ibfk_1` FOREIGN KEY (`staffID`) REFERENCES `staff` (`StaffID`) ON DELETE CASCADE;

--
-- Constraints for table `university_countries`
--
ALTER TABLE `university_countries`
  ADD CONSTRAINT `university_countries_ibfk_1` FOREIGN KEY (`UniversityID`) REFERENCES `universities` (`UniversityID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
