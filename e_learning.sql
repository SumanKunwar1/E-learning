-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2023 at 04:25 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_learning`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `a_id` int(11) NOT NULL,
  `a_Name` varchar(255) NOT NULL,
  `a_Email` varchar(255) NOT NULL,
  `a_Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`a_id`, `a_Name`, `a_Email`, `a_Password`) VALUES
(4, 'Dinesh Rana', 'ranad4508@gmail.com', 'e1582de9b12e2805343f435e5efe781726ae64e0'),
(6, 'Bibek Tamang', 'bibek@gmail.com', '8cd9df67b309ade4ac565ce8ac73e3a9e56b09ae');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contact_id` int(10) NOT NULL,
  `contact_name` varchar(255) NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  `contact_message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contact_id`, `contact_name`, `contact_email`, `contact_message`) VALUES
(1, 'Dinesh Rana', 'ranad4508@gmail.com', 'Is this popular website?'),
(3, 'Jyoti Koirala', 'jyoti@gmail.com', 'Wow this is awesome, i like this website very much'),
(4, 'Pain', 'pain@gmail.com', 'Do you have course like cyber security and Machine Learning?');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL,
  `course_name` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `course_desc` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `course_author` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `course_img` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `course_duration` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `course_price` int(11) NOT NULL,
  `course_original_price` int(11) NOT NULL,
  `t_Email` varchar(40) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_name`, `course_desc`, `course_author`, `course_img`, `course_duration`, `course_price`, `course_original_price`, `t_Email`, `status`) VALUES
(9, 'Complete PHP Bootcamp', 'This course will help you get all the Object Oriented PHP, MYSQLi and ending the course by building a CMS system.', 'Rajesh Kumar', '../image/courseimg/react.jpg', '3 Months', 79, 100, '0', ''),
(10, 'Learn Python A-Z', 'This is the most comprehensive, yet straight-forward, course for the Python programming language.', 'Rahul Kumar', '../image/courseimg/Python.jpg', '4 Months', 80, 99, '0', 'Approved'),
(11, 'Java Advanced', 'Learn and Master how AI works and how it is changing our lives in this Course.\r\nlives in this Course.', 'Jay Veeru', '../image/courseimg/images.jpg', '6 Months', 900, 1900, '0', ''),
(12, 'Learn Vue JS', 'The skills you will learn from this course is applicable to the real world, so you can go ahead and build similar app.', 'Bruce Banner', '../image/courseimg/vue.png', '7 hours', 90, 100, '0', ''),
(13, 'Angular JS', 'Angular is one of the most popular frameworks for building client apps with HTML, CSS and TypeScript.', 'Sonam Gupta', '../image/courseimg/angular.jpg', '4 Month', 800, 1600, '0', ''),
(16, 'Python Complete', 'This is complete Python COurse', 'RK', '../image/courseimg/Python.jpg', '4 hours', 500, 4000, '0', ''),
(17, 'Learn React Native', 'THis is react native for android and iso app development', 'Orchid', '../image/courseimg/react.jpg', '2 months', 200, 3000, '0', ''),
(18, 'Java', 'Full course on Java. Basic level to advanced level', 'Dinesh Rana', '../image/courseimg/images.jpg', '10 hours', 400, 500, '0', 'Approved'),
(19, 'SCripting Language', 'This is full course on scripting language', 'Bibek Tamang', '../image/courseimg/mern.png', '8 hours', 400, 600, '0', 'Approved'),
(20, 'Cooking', 'this is new course', 'Jyoti', '../image/courseimg/images.jpg', '20', 800, 1200, '0', 'Approved'),
(21, 'New Course', 'For new course ', 'Pain', '../image/courseimg/anya-3.webp', '200', 1500, 2000, 'pain@gmail.com', 'Approved'),
(22, 'Learn MERN Stack in easy way', 'Full course on MERN Stack development', 'Krypton', '../image/courseimg/mern.png', '10 hours', 800, 1200, 'ranad4508@gmail.com', 'Approved'),
(23, 'React Native', 'This is about react native and its advantage over the other courses', 'James Bond', '../image/courseimg/react.jpg', '7 Hours', 88, 99, 'ranad4508@gmail.com', 'Approved'),
(24, 'Java', 'Java for beginners', 'W Brothers', '../image/courseimg/images.jpg', '11 Hours', 50, 90, 'ranad4508@gmail.com', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `courseorder`
--

CREATE TABLE `courseorder` (
  `co_id` int(11) NOT NULL,
  `order_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `l_Email` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `course_id` int(11) NOT NULL,
  `status` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `respmsg` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `amount` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courseorder`
--

INSERT INTO `courseorder` (`co_id`, `order_id`, `l_Email`, `course_id`, `status`, `respmsg`, `amount`, `order_date`) VALUES
(3, 'ORDS98956453', 'ant@example.com', 3, 'TXN_SUCCESS', 'Txn Success', 800, '2019-09-11 18:15:00'),
(7, 'ORDS57717951', 'jay@ischool.com', 7, 'TXN_SUCCESS', 'Txn Success', 400, '2019-09-12 18:15:00'),
(8, 'ORDS22968322', 'mario@ischool.com', 8, 'TXN_SUCCESS', 'Txn Success', 800, '2019-09-12 18:15:00'),
(9, 'ORDS78666589', 'ignou@ischool.com', 9, 'TXN_SUCCESS', 'Txn Success', 800, '2019-09-18 18:15:00'),
(10, 'ORDS59885531', 'sonam@gmail.com', 10, 'TXN_SUCCESS', 'Txn Success', 800, '2020-07-03 18:15:00'),
(11, 'ORDS60500434', 'ranad4508@gmail.com', 10, 'Success', 'Done', 800, '2008-06-22 18:15:00'),
(12, 'ORDS49506515', 'ranad4508@gmail.com', 11, 'Success', 'Done', 900, '2008-06-22 18:15:00'),
(13, 'ORDS87297449', 'ranad4508@gmail.com', 16, 'Success', 'Done', 500, '2012-06-22 18:15:00'),
(14, 'ORDS4730985', 'ranad4508@gmail.com', 18, 'Success', 'Done', 400, '2012-06-22 21:24:54'),
(16, 'ORDS27568561', 'ranad4508@gmail.com', 12, 'Success', 'Done', 100, '2023-06-12 14:21:29'),
(17, 'ORDS33293419', 'ranad4508@gmail.com', 13, 'Success', 'Done', 0, '2023-06-13 14:26:14'),
(18, 'ORDS85771529', 'ranad4508@gmail.com', 13, 'Success', 'Done', 0, '2023-06-13 14:26:19'),
(19, 'ORDS75633214', 'ranad4508@gmail.com', 16, 'Success', 'Done', 500, '2023-06-16 02:20:30'),
(20, 'ORDS49024354', 'pain@gmail.com', 9, 'Success', 'Done', 79, '2023-06-16 09:55:39'),
(21, 'ORDS70630011', 'pain@gmail.com', 10, 'Success', 'Done', 80, '2023-06-16 10:15:19');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `f_id` int(11) NOT NULL,
  `f_content` text NOT NULL,
  `l_Id` int(11) NOT NULL,
  `f_ratings` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`f_id`, `f_content`, `l_Id`, `f_ratings`, `course_id`, `status`) VALUES
(18, 'This course is good', 194, 5, 9, '0'),
(19, 'This course is awesome. You will love it', 194, 5, 10, 'Approved'),
(20, 'This course is awesome. You will love it', 194, 5, 10, 'Approved'),
(21, 'Good course', 193, 3, 10, 'Approved'),
(22, 'Course is good', 193, 3, 11, 'Approved'),
(23, 'Wow, amazing course', 193, 4, 12, '0'),
(24, 'Course is good but you have to practice enough', 193, 4, 13, 'Approved'),
(25, 'Amazing course in amazing way', 193, 4, 16, 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `learner`
--

CREATE TABLE `learner` (
  `l_Id` int(11) NOT NULL,
  `l_Name` varchar(255) NOT NULL,
  `l_Email` varchar(255) NOT NULL,
  `l_Password` varchar(255) NOT NULL,
  `l_occ` varchar(255) NOT NULL,
  `l_img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `learner`
--

INSERT INTO `learner` (`l_Id`, `l_Name`, `l_Email`, `l_Password`, `l_occ`, `l_img`) VALUES
(171, 'Captain Marvel', 'cap@example.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', ' Web Designer', '../image/stu/student2.jpg'),
(172, 'Ant Man', 'ant@example.com', '123456', ' Web Developer', '../image/stu/student4.jpg'),
(173, ' Dr Strange', 'doc@example.com', '123456', ' Web Developer', '../image/stu/student1.jpg'),
(174, 'Scarlet Witch', 'witch@example.com', '123456', 'Web Designer', '../image/stu/student3.jpg'),
(176, ' Shaktiman', 'shaktiman@ischool.com', '123456', 'Software ENgg', '../image/stu/shaktiman.jpg'),
(178, ' Mario', 'mario@ischool.com', '1234567', ' Web Dev', '../image/stu/super-mario-2690254_1280.jpg'),
(182, ' sonam', 'sonam@gmail.com', '123456', ' Web Dev', '../image/stu/student2.jpg'),
(183, 'Bibek Tamang', 'bibeks337@gmail.com', '560de5c7a9c04f821fa3b0a70b4b0b65243b4ede', '', ''),
(193, '       Dinesh Rana', 'ranad4508@gmail.com', 'e1582de9b12e2805343f435e5efe781726ae64e0', '       Student', '../image/stu/profile.jpg'),
(194, ' Pain', 'pain@gmail.com', '48a2746399ddc8ef6f29c180c73bb242ac10e0a4', ' Student', '../image/stu/20511143.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `lesson`
--

CREATE TABLE `lesson` (
  `lesson_id` int(11) NOT NULL,
  `lesson_name` text NOT NULL,
  `lesson_desc` text NOT NULL,
  `lesson_link` text NOT NULL,
  `course_id` int(11) NOT NULL,
  `course_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `lesson`
--

INSERT INTO `lesson` (`lesson_id`, `lesson_name`, `lesson_desc`, `lesson_link`, `course_id`, `course_name`) VALUES
(32, 'Introduction to Python ', 'Introduction to Python Desc', '../lessonvid/video2.mp4', 10, 'Learn Python A-Z'),
(33, 'How Python Works', 'How Python Works Descc', '../lessonvid/video3.mp4', 10, 'Learn Python A-Z'),
(34, 'Why Python is powerful', 'Why Python is powerful Desc', '../lessonvid/video9.mp4', 10, 'Learn Python A-Z'),
(35, 'Everyone should learn Python ', 'Everyone should learn Python  Desccc', '../lessonvid/video1.mp4', 10, 'Learn Python A-Z'),
(36, 'Introduction to PHP', 'Introduction to PHP Desc', '../lessonvid/video4.mp4', 9, 'Complete PHP Bootcamp'),
(37, 'How PHP works', 'How PHP works Desc', '../lessonvid/video5.mp4', 9, 'Complete PHP Bootcamp'),
(38, 'PHP is easy or difficult?', 'In this section you will know about how easy or difficult php is', '../lessonvid/Screenrecorder-2022-01-03-20-20-23-895.mp4', 9, 'Complete PHP Bootcamp'),
(39, 'Introduction to Guitar44', 'Introduction to Guitar desc1', '../lessonvid/video7.mp4', 8, 'Learn Guitar The Easy Way'),
(40, 'Type of Guitar', 'Type of Guitar Desc2', '../lessonvid/video8.mp4', 8, 'Learn Guitar The Easy Way'),
(41, 'Intro Hands-on Artificial Intelligence', 'Intro Hands-on Artificial Intelligence desc', '../lessonvid/video10.mp4', 11, 'Hands-on Artificial Intelligence'),
(42, 'How it works', 'How it works descccccc', '../lessonvid/video11.mp4', 11, 'Hands-on Artificial Intelligence'),
(43, 'Inro Learn Vue JS', 'Inro Learn Vue JS desc', '../lessonvid/video12.mp4', 12, 'Learn Vue JS'),
(44, 'intro Angular JS', 'intro Angular JS desc', '../lessonvid/video13.mp4', 13, 'Angular JS'),
(48, 'Intro to Python Complete', 'This is lesson number 1', '../lessonvid/video11.mp4', 16, 'Python Complete'),
(49, 'Introduction to React Native', 'This intro video of React native', '../lessonvid/video11.mp4', 17, 'Learn React Native'),
(50, 'Lesson - 1: Intro', 'Learn basic about PHP', '../lessonvid/20211009_1080p.mp4', 9, 'Complete PHP Bootcamp'),
(51, 'Lession -1: Intro', 'Introduction about MEAN stack', '../lessonvid/video1.mp4', 22, 'Learn MEAN Stack in easy way');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `l_Id` int(11) NOT NULL,
  `Problem_Type` varchar(50) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `solution` varchar(255) NOT NULL,
  `Assign` varchar(100) NOT NULL,
  `report_Id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`l_Id`, `Problem_Type`, `Title`, `solution`, `Assign`, `report_Id`) VALUES
(194, 'cyber security', 'Need Tony', 'Why you need tony?', 'bibek@gmail.com', 1),
(193, 'java', 'I have problem', 'You can ask', 'smriti@gmail.com', 2),
(193, 'Python Complete', 'Do you have extra notes?', 'What is your problem?', 'smriti@gmail.com', 4);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(10) NOT NULL,
  `service_title` varchar(255) NOT NULL,
  `service_desc` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `service_title`, `service_desc`) VALUES
(1, 'We Provide best tutors', 'Our online academy provides the best teachers who are\r\nhighly qualified, experienced, and passionate about their\r\nsubjects. We carefully select and train our teachers to deliver\r\nengaging and effective lessons using the latest e-learning\r\ntechnologies. With our best teachers, students receive a\r\nhigh-quality education tailored to their learning style and\r\npace.'),
(2, 'We provide problem solving skills', 'Our online academy provides courses and resources to help individuals develop their\r\n                                problem solving skills. Our courses focus on critical thinking, creativity, decision\r\n                                making, and effective communication, providing learners with the tools they need to\r\n                                identify and solve problems effectively. By developing problem solving skills, learners\r\n                                are better equipped to succ'),
(3, 'We provide best career paths', 'Our online academy provides guidance and resources to help individuals explore different\r\n                                career paths and develop the skills and knowledge needed to succeed in their chosen\r\n                                field. Our goal is to equip learners with the tools they need to achieve their\r\n                                career goals and thrive in their profession.'),
(4, ' Provide best team effort', 'Our online academy offers courses and resources to help individuals develop their\r\n                                teamwork skills. Our courses focus on effective communication, collaboration, and\r\n                                conflict resolution, equipping learners to contribute to a positive and productive team\r\n                                dynamic.'),
(5, 'Cost Friendly Courses', 'Our courses are course friendly. We, offer our valuable course in less amount of money. We want share the courses in low cost and with good quality knowledge.');

-- --------------------------------------------------------

--
-- Table structure for table `tutor`
--

CREATE TABLE `tutor` (
  `t_Id` int(11) NOT NULL,
  `t_Name` varchar(40) NOT NULL,
  `t_Email` varchar(50) NOT NULL,
  `t_Password` varchar(40) NOT NULL,
  `t_Img` varchar(50) NOT NULL,
  `t-Profession` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tutor`
--

INSERT INTO `tutor` (`t_Id`, `t_Name`, `t_Email`, `t_Password`, `t_Img`, `t-Profession`) VALUES
(1, ' Dinesh Rana', 'ranad4508@gmail.com', 'e1582de9b12e2805343f435e5efe781726ae64e0', '../image/tutor/neymar-2.webp', 'Java Developer'),
(4, ' Pain', 'pain@gmail.com', 'af0bf502223964dd9a2cea59562339bee3546677', '../image/tutor/anya-1.jpeg', 'Scripting master'),
(5, 'Bibek Tamang', 'bibek@gmail.com', '8cd9df67b309ade4ac565ce8ac73e3a9e56b09ae', '', 'Database Administrator'),
(7, ' Jyoti Koirala', 'jyoti@gmail.com', '44834f5df689a59a9b8f43697902b54630a7c027', '../image/tutor/profile.jpg', 'Full stack delveloper'),
(8, 'Smriti Khadka', 'smriti@gmail.com', '8d4f78fede18495d7d3190555fb1bb5dcf144d1b', '', 'Data Scientist');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `courseorder`
--
ALTER TABLE `courseorder`
  ADD PRIMARY KEY (`co_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `learner`
--
ALTER TABLE `learner`
  ADD PRIMARY KEY (`l_Id`);

--
-- Indexes for table `lesson`
--
ALTER TABLE `lesson`
  ADD PRIMARY KEY (`lesson_id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`report_Id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `tutor`
--
ALTER TABLE `tutor`
  ADD PRIMARY KEY (`t_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `courseorder`
--
ALTER TABLE `courseorder`
  MODIFY `co_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `learner`
--
ALTER TABLE `learner`
  MODIFY `l_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;

--
-- AUTO_INCREMENT for table `lesson`
--
ALTER TABLE `lesson`
  MODIFY `lesson_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `report_Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tutor`
--
ALTER TABLE `tutor`
  MODIFY `t_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
