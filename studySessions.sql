-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 26, 2018 at 02:20 PM
-- Server version: 5.7.21
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studySessions`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `header` text NOT NULL,
  `announcement` text NOT NULL,
  `likes` int(11) NOT NULL,
  `disLikes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `header`, `announcement`, `likes`, `disLikes`) VALUES
(1, 'now able to edit user profile', 'users can now edit user profile, click to expand header and click on \"edit profile\"', 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `universityId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `name`, `universityId`) VALUES
(1, 'CS 4400', 1),
(2, 'Cs 2100', 1),
(3, 'cs 4530', 2);

-- --------------------------------------------------------

--
-- Table structure for table `contactAdmin`
--

CREATE TABLE `contactAdmin` (
  `id` int(11) NOT NULL,
  `issue` text NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `joinedSession`
--

CREATE TABLE `joinedSession` (
  `id` int(11) NOT NULL,
  `studySessionId` int(11) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `joinedSession`
--

INSERT INTO `joinedSession` (`id`, `studySessionId`, `userId`) VALUES
(7, 1, 10),
(6, 2, 1),
(9, 7, 11),
(8, 3, 11),
(5, 15, 1),
(10, 22, 6),
(11, 1, 9),
(12, 7, 9);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `messageId` int(11) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `studySessionId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`messageId`, `title`, `content`, `studySessionId`) VALUES
(1, 'test title', 'test message', 1),
(2, '4A', 'test', 10),
(3, 'mohit', 'test', 10),
(4, 'another one', 'test again', 10),
(5, 'braden', 'hello', 10),
(6, 'cynthia', 'test', 10),
(7, 'hopefully', 'this works', 10),
(8, 'test last', 'tset last', 10),
(9, 'test last', 'tset last', 10),
(10, 'test last', 'tset last', 10),
(11, 'test last', 'tset last', 10),
(12, 'test last', 'tset last', 10),
(13, 'test last', 'tset last', 10),
(14, 'test last', 'tset last', 10),
(15, 'test last', 'tset last', 10),
(16, 'test last', 'tset last', 10),
(17, 'test last', 'tset last', 10),
(18, 'test last', 'tset last', 10),
(19, 'test last', 'tset last', 10),
(20, 'can we work on the practice midterm', 'i think we should work on the practice midterm', 3),
(21, 'message 2 test', 'message 2 test', 3),
(22, 'message 2 test', 'message 2 test', 3),
(23, 'test', 'message test', 7);

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `id` int(11) NOT NULL,
  `messageId` int(11) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `replies`
--

INSERT INTO `replies` (`id`, `messageId`, `title`, `content`) VALUES
(1, 2, 'reply', 'one'),
(2, 2, 'reply', 'two'),
(3, 2, 'reply', 'two'),
(4, 2, 'reply', 'two'),
(5, 20, 'sure', 'yeah sure'),
(6, 20, 'reply 2', 'reply again baby'),
(7, 20, 'reply 2', 'reply again baby'),
(8, 20, 'reply 2', 'reply again baby'),
(9, 20, 'reply 2', 'reply again baby'),
(10, 20, 'reply 2', 'reply again baby'),
(11, 20, 'reply 2', 'reply again baby'),
(12, 20, 'reply 2', 'reply again baby'),
(13, 21, 'reply', 'replying to you boi'),
(14, 21, 'test', 'really boi'),
(15, 21, 'test', 'really boi'),
(16, 21, 'test', 'really boi'),
(17, 21, 'test', 'really boi'),
(18, 21, 'test', 'really boi'),
(19, 21, 'test', 'really boi'),
(20, 23, 'david', 'blue blue');

-- --------------------------------------------------------

--
-- Table structure for table `studySession`
--

CREATE TABLE `studySession` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `owner` text,
  `class` text NOT NULL,
  `subject` text NOT NULL,
  `university` text NOT NULL,
  `timeStart` date NOT NULL,
  `Location` text NOT NULL,
  `isPublic` tinyint(1) NOT NULL,
  `password` text,
  `zip` int(11) NOT NULL,
  `ownerId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `studySession`
--

INSERT INTO `studySession` (`id`, `name`, `owner`, `class`, `subject`, `university`, `timeStart`, `Location`, `isPublic`, `password`, `zip`, `ownerId`) VALUES
(1, 'test study session name', 'Mohit', 'Cs 4400', 'System Architecture', 'University of Utah', '2018-11-16', 'salt lake city utah', 0, 'abcd', 0, 0),
(2, 'test study session name', 'Mohit', 'Cs 4400', 'System Architecture', 'University of Utah', '2018-11-16', 'salt lake city utah', 0, 'abcd', 0, 0),
(3, 'another test study session', 'Chong', '2100', 'math', 'university of utah', '2018-11-15', '4500 south 900 east', 0, '', 84088, 0),
(4, 'New Study session', 'Mohit Chaudhary', '2250', 'Math', 'University of Utah', '2018-11-24', '123 400 south salt lake city', 1, '', 84088, 0),
(5, 'New Study session', 'Mohit Chaudhary', '2250', 'Math', 'University of Utah', '2018-11-24', '123 400 south salt lake city', 1, '', 84088, 0),
(6, 'haha', 'Mohit Chaudhary', '3140', 'biotech', 'itineris', '2018-11-04', '3939 w 9000 south', 1, '', 84088, 0),
(7, 'haha', 'Mohit Chaudhary', '3140', 'biotech', 'itineris', '2018-11-04', '3939 w 9000 south', 1, '', 84088, 0),
(8, 'haha', 'Mohit Chaudhary', '3140', 'biotech', 'itineris', '2018-11-04', '3939 w 9000 south', 1, '', 84088, 0),
(9, 'ok', 'Mohit Chaudhary', '3930', 'SLC startup', 'University of Utah', '2018-11-30', '3939 w 9000 south', 1, '', 84121, 0),
(10, 'ok', 'Mohit Chaudhary', '3930', 'SLC startup', 'University of Utah', '2018-11-30', '3939 w 9000 south', 1, '', 84121, 0),
(11, 'ok', 'Mohit Chaudhary', '3930', 'SLC startup', 'University of Utah', '2018-11-30', '3939 w 9000 south', 1, '', 84121, 0),
(12, 'blue', 'Mohit Chaudhary', 'laugh boi', 'lol', 'ok', '2018-11-23', '3939 w 9000 south', 1, '', 121321, 0),
(13, 'blue', 'Mohit Chaudhary', 'laugh boi', 'lol', 'ok', '2018-11-23', '3939 w 9000 south', 1, '', 121321, 0),
(14, 'j', 'Mohit Chaudhary', '2250', 'SLC startup', 'boi', '2018-11-23', '121 street', 1, '', 84121, 0),
(15, 'j', 'Mohit Chaudhary', '2250', 'SLC startup', 'boi', '2018-11-23', '121 street', 1, '', 84121, 0),
(16, 'ok', 'Mohit Chaudhary', '3190', 'Math', 'University of Utah', '2018-11-29', '3939 w 9000 south', 1, '', 84101, 0),
(17, 'latest', 'Mohit Chaudhary', '3190', 'Math', 'University of Utah', '2018-11-29', '3939 w 9000 south', 1, '', 84101, 0),
(18, 'latest 2', 'Mohit Chaudhary', '3190', 'Math', 'University of Utah', '2018-11-29', '3939 w 9000 south', 1, '', 84101, 0),
(19, 'New Study session', 'Mohit Chaudhary', '3930', 'j', 'University of Utah', '2018-11-24', '3939 w 9000 south', 1, '', 121111, 0),
(20, 'David', 'Mohit Chaudhary', '4460', 'inforomation systems', 'eccles school fo business', '2018-11-23', '123 400 south salt lake city', 1, '', 84101, 0),
(23, 'latest study session', 'Mohit Chaudhary', 'CS 4400', 'SLC startup', '', '2018-11-30', '3939 w 9000 south', 1, 'test', 84107, 9);

-- --------------------------------------------------------

--
-- Table structure for table `tutorRequest`
--

CREATE TABLE `tutorRequest` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `student_id` int(11) NOT NULL,
  `tutor_id` int(11) NOT NULL,
  `sessionLength` int(11) NOT NULL,
  `studentComment` text NOT NULL,
  `tutorComment` text NOT NULL,
  `approved` int(11) NOT NULL,
  `changesRequested` int(11) NOT NULL,
  `zip` int(11) NOT NULL,
  `address` text NOT NULL,
  `timeStart` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tutorRequest`
--

INSERT INTO `tutorRequest` (`id`, `date`, `student_id`, `tutor_id`, `sessionLength`, `studentComment`, `tutorComment`, `approved`, `changesRequested`, `zip`, `address`, `timeStart`) VALUES
(1, '2018-11-23', 10, 7, 111, 'lets do this boi!', '', 0, 0, 84101, '100 S. South Campus Dr.', '7:00'),
(2, '2018-11-22', 10, 10, 187, 'lets do this boi!', 'please change the date to the 7th', 0, 1, 84088, '9183 S TRIMBLE CREEK DR', '11:00 PM'),
(3, '2018-11-29', 10, 10, 187, 'lets do this boi!', 'test', 0, 1, 84088, '9183 S TRIMBLE CREEK DR', '9 am'),
(4, '2018-11-27', 11, 2, 121, 'help me on this boi lol ok plz like thanks boi', '', 0, 0, 84088, '91833 ss lol', '7:00 pm'),
(5, '2018-11-30', 11, 6, 121, 'please help me on math', 'wait lets do this on the day before', 0, 1, 84088, '9183 S. Trimble Creek Dr.', '8:00 pm'),
(6, '2018-11-29', 9, 2, 2, 'help me', '', 0, 0, 84088, '9183 S. Trimble Creek Dr.', '7:00 pm'),
(7, '2018-11-30', 9, 6, 1, 'please help me on math', '', 0, 0, 84107, '5585 South 900 East', '8:00 pm'),
(8, '2018-12-07', 9, 10, 3, 'help me on this boi lol ok plz', 'actually nevermind', 0, 1, 84107, '5585 South 900 East', '8:00 pm'),
(9, '2018-11-22', 9, 2, 2, 'help me on this boi', '', 0, 0, 84101, '100 S. South Campus Dr.', '7:00 pm');

-- --------------------------------------------------------

--
-- Table structure for table `university`
--

CREATE TABLE `university` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `university`
--

INSERT INTO `university` (`id`, `name`) VALUES
(1, 'University of Utah'),
(2, 'Utah State University'),
(3, 'University of Phoenix');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `FullName` varchar(255) NOT NULL,
  `Phone` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Token` varchar(255) NOT NULL,
  `School` varchar(255) NOT NULL,
  `Major` varchar(255) NOT NULL,
  `Zip` text NOT NULL,
  `Address` varchar(255) NOT NULL,
  `UserType` varchar(255) NOT NULL,
  `PayRate` varchar(255) NOT NULL,
  `id` int(11) NOT NULL,
  `zipa` text NOT NULL,
  `imgUrl` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`FullName`, `Phone`, `Email`, `Token`, `School`, `Major`, `Zip`, `Address`, `UserType`, `PayRate`, `id`, `zipa`, `imgUrl`) VALUES
('David Oh', '87656777', 'david@mail.com', '543002d2a8b2a14d1cca1dc37e9816e0', 'usc', '90210', '', '234 fake street ', 'tutor', '2', 7, '', 'https://media.gettyimages.com/photos/rio-de-janeiro-brazil-picture-id672036306'),
('Mohit Chaudhary', '8014484123', 'thewush@hotmail.com', '15187c14c07459bd1154ed635a81559d', 'u of u', '84088', '', '9183 S. Trimble Creek Dr.', 'tutor', '15', 2, '', 'https://media.gettyimages.com/photos/rio-de-janeiro-brazil-picture-id672036306'),
('Mohit', '1231112333', 'm@mail.com', '5fe372adb4f667960152ae841d2371b9', 'MIT', '83211', '', '123 slime blvd', 'student', '0', 8, '', NULL),
('Mohit Chaudhary', '8014484123', 'a@mail.com', '5fe372adb4f667960152ae841d2371b9', 'lol', '90210', '', '9183 S. Trimble Creek Dr.', 'student', '0', 9, '', NULL),
('new name', '12345678', 'b@mail.com', '5fe372adb4f667960152ae841d2371b9', 'University of Utah', '832111', '1231121', 'fake street', 'tutor', '11', 10, '873455', 'https://media.gettyimages.com/photos/rio-de-janeiro-brazil-picture-id672036306'),
('jake', '76333333333', 'mail@mail.com', '5fe372adb4f667960152ae841d2371b9', 'test u', '84112', '', '9183 S. Trimble Creek Dr.', 'tutor', '3', 6, '', 'https://media.gettyimages.com/photos/rio-de-janeiro-brazil-picture-id672036306'),
('Mohit Chaudhary', '8014484123', 'nu@mail.com', '5fe372adb4f667960152ae841d2371b9', 'tester u', '84088', '', '9183 S. Trimble Creek Dr.', 'student', '0', 11, '', NULL),
('ju', '7173484322', 'ju@mail.com', '5fe372adb4f667960152ae841d2371b9', 'washington', '91230', '', '345 true street', 'student', '0', 12, '', NULL),
('ju', '7173484322', 'ju@mail.com', '5fe372adb4f667960152ae841d2371b9', 'University of Utah', '90210', '', '345 true street', '', '', 13, '', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contactAdmin`
--
ALTER TABLE `contactAdmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `joinedSession`
--
ALTER TABLE `joinedSession`
  ADD PRIMARY KEY (`id`),
  ADD KEY `joinedSessionFk1` (`studySessionId`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`messageId`),
  ADD KEY `messages_fk` (`studySessionId`);

--
-- Indexes for table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `replies_FK` (`messageId`);

--
-- Indexes for table `studySession`
--
ALTER TABLE `studySession`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tutorRequest`
--
ALTER TABLE `tutorRequest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `university`
--
ALTER TABLE `university`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contactAdmin`
--
ALTER TABLE `contactAdmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `joinedSession`
--
ALTER TABLE `joinedSession`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `messageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `studySession`
--
ALTER TABLE `studySession`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tutorRequest`
--
ALTER TABLE `tutorRequest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `university`
--
ALTER TABLE `university`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_fk` FOREIGN KEY (`studySessionId`) REFERENCES `studySession` (`id`);

--
-- Constraints for table `replies`
--
ALTER TABLE `replies`
  ADD CONSTRAINT `replies_FK` FOREIGN KEY (`messageId`) REFERENCES `messages` (`messageId`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
