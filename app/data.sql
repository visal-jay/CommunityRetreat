SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));

DROP DATABASE IF EXISTS `communityretreat_db`;

CREATE DATABASE `communityretreat_db`;
USE `communityretreat_db`;

-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2021 at 09:50 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `communityretreat_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `event_id` int(10) DEFAULT NULL,
  `uid` varchar(10) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `activity` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `add_photo`
--

CREATE TABLE `add_photo` (
  `image_id` int(10) NOT NULL,
  `event_id` int(10) DEFAULT NULL,
  `uid` varchar(10) NOT NULL,
  `image` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `uid` varchar(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_number` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `announcement_id` int(10) NOT NULL,
  `event_id` int(10) NOT NULL,
  `announcement` text NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `calender`
--

CREATE TABLE `calender` (
  `uid` varchar(10) NOT NULL,
  `event_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

CREATE TABLE `complaint` (
  `complaint_id` int(10) NOT NULL,
  `uid` varchar(10) DEFAULT NULL,
  `event_id` int(10) DEFAULT NULL,
  `details` text NOT NULL,
  `date` date NOT NULL,
  `status` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `donation`
--

CREATE TABLE `donation` (
  `donation_id` int(10) NOT NULL,
  `event_id` int(10) DEFAULT NULL,
  `uid` varchar(10) DEFAULT NULL,
  `record_id` varchar(10) NOT NULL,
  `amount` int(11) NOT NULL,
  `contact_no` int(12) NOT NULL,
  `credit_card_no` int(11) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `donation`
--



-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `event_id` int(10) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `org_uid` varchar(10) DEFAULT NULL,
  `latlang` point DEFAULT NULL,
  `start_date` date NOT NULL,
  `start_time` time NOT NULL,
  `about` text NOT NULL,
  `mode` enum('Virtual','Physical','Physical & Virtual') NOT NULL,
  `volunteer_capacity` int(11) DEFAULT NULL,
  `donation_capacity` int(11) DEFAULT NULL,
  `cover_photo` blob,
  `donation_status` tinyint(1) NOT NULL DEFAULT '0',
  `volunteer_status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event`
--


-- --------------------------------------------------------

--
-- Table structure for table `event_feedback`
--

CREATE TABLE `event_feedback` (
  `feedback_id` varchar(10) NOT NULL,
  `event_id` int(10) DEFAULT NULL,
  `uid` varchar(10) NOT NULL,
  `status` varchar(30) NOT NULL,
  `feedback` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `record_id` varchar(10) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `event_id` int(10) NOT NULL,
  `uid` varchar(10) DEFAULT NULL,
  `status` varchar(30) NOT NULL,
  `details` text NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expense`
--



-- --------------------------------------------------------

--
-- Table structure for table `feedback_id_seq`
--

CREATE TABLE `feedback_id_seq` (
  `f_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback_id_seq`
--



-- --------------------------------------------------------

--
-- Table structure for table `id_seq`
--

CREATE TABLE `id_seq` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `id_seq`
--


-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `record_id` varchar(10) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `event_id` int(10) NOT NULL,
  `uid` varchar(10) DEFAULT NULL,
  `status` varchar(30) NOT NULL,
  `details` text NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `income`
--



-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `email` varchar(255) NOT NULL,
  `user_type` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `uid` varchar(10) NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `failed_login_count` int(11) NOT NULL DEFAULT '0',
  `first_failed_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Table structure for table `moderator_treasurer`
--

CREATE TABLE `moderator_treasurer` (
  `uid` varchar(10) NOT NULL,
  `event_id` int(10) NOT NULL,
  `moderator_flag` tinyint(1) NOT NULL,
  `treasurer_flag` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

CREATE TABLE `organization` (
  `uid` varchar(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_number` varchar(12) NOT NULL,
  `profile_pic` blob,
  `cover_pic` blob,
  `about_us` text,
  `latlang` point DEFAULT NULL,
  `account_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `organization`
--



-- --------------------------------------------------------

--
-- Table structure for table `record_id_seq`
--

CREATE TABLE `record_id_seq` (
  `rec_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `record_id_seq`
--


-- --------------------------------------------------------

--
-- Table structure for table `registered_user`
--

CREATE TABLE `registered_user` (
  `uid` varchar(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_number` int(12) NOT NULL,
  `profile_pic` blob NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `system_feedback`
--

CREATE TABLE `system_feedback` (
  `feedback_id` varchar(10) NOT NULL,
  `uid` varchar(10) NOT NULL,
  `feedback` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Table structure for table `volunteer`
--

CREATE TABLE `volunteer` (
  `uid` varchar(10) NOT NULL,
  `event_id` int(10) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `work_timeline`
--

CREATE TABLE `work_timeline` (
  `task_id` int(10) NOT NULL,
  `event_id` int(10) DEFAULT NULL,
  `start_date` date NOT NULL,
  `task` text NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `work_timeline`
--

--
-- Indexes for dumped tables
--
--
-- Indexes for table `activity_log`
--

ALTER TABLE `event`
  ADD PRIMARY KEY (`event_id`);
  


ALTER TABLE `event`
  MODIFY `event_id` int(10) NOT NULL AUTO_INCREMENT;
 

ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`uid`,`time_stamp`) USING BTREE,
  ADD KEY `activity_event_fk` (`event_id`);

--
-- Indexes for table `add_photo`
--
ALTER TABLE `add_photo`
  ADD PRIMARY KEY (`image_id`) USING BTREE,
  ADD KEY `addphoto_user_fk` (`uid`),
  ADD KEY `addphoto_event_fk` (`event_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`announcement_id`,`event_id`) USING BTREE,
  ADD KEY `announcement_event_fk` (`event_id`);

--
-- Indexes for table `calender`
--
ALTER TABLE `calender`
  ADD PRIMARY KEY (`uid`,`event_id`),
  ADD KEY `calender_event_fk` (`event_id`);

--
-- Indexes for table `complaint`
--
ALTER TABLE `complaint`
  ADD PRIMARY KEY (`complaint_id`) USING BTREE,
  ADD KEY `complaint_user_fk` (`uid`),
  ADD KEY `complaint_event_fk` (`event_id`);

--
-- Indexes for table `donation`
--
ALTER TABLE `donation`
  ADD PRIMARY KEY (`donation_id`),
  ADD KEY `donation_event_fk` (`event_id`),
  ADD KEY `donation_user_fk` (`uid`),
  ADD KEY `donation_income_fk` (`record_id`);

--
-- Indexes for table `event`
--


  

--
-- Indexes for table `event_feedback`
--
ALTER TABLE `event_feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `event_feedback_user_fk` (`uid`),
  ADD KEY `event_feedback_event_fk` (`event_id`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`record_id`,`time_stamp`,`event_id`) USING BTREE,
  ADD KEY `expense_event_fk` (`event_id`),
  ADD KEY `expense_user_fk` (`uid`);

--
-- Indexes for table `feedback_id_seq`
--
ALTER TABLE `feedback_id_seq`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `id_seq`
--
ALTER TABLE `id_seq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`record_id`,`time_stamp`,`event_id`) USING BTREE,
  ADD KEY `income_event_fk` (`event_id`),
  ADD KEY `income_user_fk` (`uid`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`email`),
  ADD KEY `login_org_fk` (`uid`);

--
-- Indexes for table `moderator_treasurer`
--
ALTER TABLE `moderator_treasurer`
  ADD PRIMARY KEY (`uid`,`event_id`),
  ADD KEY `moderator_treasurer_event_fk` (`event_id`);

--
-- Indexes for table `organization`
--
ALTER TABLE `organization`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `record_id_seq`
--
ALTER TABLE `record_id_seq`
  ADD PRIMARY KEY (`rec_id`);

--
-- Indexes for table `registered_user`
--
ALTER TABLE `registered_user`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `system_feedback`
--
ALTER TABLE `system_feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `system_feedback_user_fk` (`uid`);

--
-- Indexes for table `volunteer`
--
ALTER TABLE `volunteer`
  ADD PRIMARY KEY (`uid`,`event_id`) USING BTREE,
  ADD KEY `volunteer_event_fk` (`event_id`);

--
-- Indexes for table `work_timeline`
--
ALTER TABLE `work_timeline`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `work_timeline_event_fk` (`event_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_photo`
--
ALTER TABLE `add_photo`
  MODIFY `image_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `announcement_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `complaint`
--
ALTER TABLE `complaint`
  MODIFY `complaint_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `donation`
--
ALTER TABLE `donation`
  MODIFY `donation_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `feedback_id_seq`
--
ALTER TABLE `feedback_id_seq`
  MODIFY `f_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `id_seq`
--
ALTER TABLE `id_seq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `record_id_seq`
--
ALTER TABLE `record_id_seq`
  MODIFY `rec_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `work_timeline`
--
ALTER TABLE `work_timeline`
  MODIFY `task_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD CONSTRAINT `activity_event_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`),
  ADD CONSTRAINT `activity_user_fk` FOREIGN KEY (`uid`) REFERENCES `registered_user` (`uid`) ON DELETE CASCADE;

--
-- Constraints for table `add_photo`
--
ALTER TABLE `add_photo`
  ADD CONSTRAINT `addphoto_event_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `addphoto_user_fk` FOREIGN KEY (`uid`) REFERENCES `registered_user` (`uid`) ON DELETE CASCADE;

--
-- Constraints for table `announcement`
--
ALTER TABLE `announcement`
  ADD CONSTRAINT `announcement_event_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `calender`
--
ALTER TABLE `calender`
  ADD CONSTRAINT `calender_event_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `calender_user_fk` FOREIGN KEY (`uid`) REFERENCES `registered_user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `complaint`
--
ALTER TABLE `complaint`
  ADD CONSTRAINT `complaint_event_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `complaint_user_fk` FOREIGN KEY (`uid`) REFERENCES `registered_user` (`uid`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `donation`
--
ALTER TABLE `donation`
  ADD CONSTRAINT `donation_event_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `donation_income_fk` FOREIGN KEY (`record_id`) REFERENCES `income` (`record_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `donation_user_fk` FOREIGN KEY (`uid`) REFERENCES `registered_user` (`uid`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `org_event_fk` FOREIGN KEY (`org_uid`) REFERENCES `organization` (`uid`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `event_feedback`
--
ALTER TABLE `event_feedback`
  ADD CONSTRAINT `event_feedback_event_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_feedback_user_fk` FOREIGN KEY (`uid`) REFERENCES `registered_user` (`uid`) ON DELETE CASCADE;

--
-- Constraints for table `expense`
--
ALTER TABLE `expense`
  ADD CONSTRAINT `expense_event_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `expense_user_fk` FOREIGN KEY (`uid`) REFERENCES `registered_user` (`uid`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `income`
--
ALTER TABLE `income`
  ADD CONSTRAINT `income_event_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`),
  ADD CONSTRAINT `income_user_fk` FOREIGN KEY (`uid`) REFERENCES `registered_user` (`uid`) ON DELETE SET NULL ON UPDATE CASCADE;


--
-- Constraints for table `moderator_treasurer`
--
ALTER TABLE `moderator_treasurer`
  ADD CONSTRAINT `moderator_treasurer_event_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `moderator_treasurer_user_fk` FOREIGN KEY (`uid`) REFERENCES `registered_user` (`uid`) ON DELETE CASCADE;

--
-- Constraints for table `system_feedback`
--
ALTER TABLE `system_feedback`
  ADD CONSTRAINT `system_feedback_user_fk` FOREIGN KEY (`uid`) REFERENCES `registered_user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `volunteer`
--
ALTER TABLE `volunteer`
  ADD CONSTRAINT `volunteer_event_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `volunteer_user_fk` FOREIGN KEY (`uid`) REFERENCES `registered_user` (`uid`) ON DELETE CASCADE;

--
-- Constraints for table `work_timeline`
--
ALTER TABLE `work_timeline`
  ADD CONSTRAINT `work_timeline_event_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`) ON DELETE SET NULL;
--
-- Triggers `admin`
--
CREATE TRIGGER `id_seq_admin_insert` BEFORE INSERT ON `admin` FOR EACH ROW BEGIN
  INSERT INTO id_seq VALUES (NULL);
  SET NEW.uid = CONCAT('ADM', LPAD(LAST_INSERT_ID(), 7, '0'));
END;


CREATE TRIGGER `login_admin_delete` AFTER DELETE ON `admin` FOR EACH ROW BEGIN
  DELETE FROM login WHERE login.uid=old.uid;
END;

--
-- Triggers `donation`
--

CREATE TRIGGER `income_donation` BEFORE INSERT ON `donation` FOR EACH ROW BEGIN
DECLARE sid TIMESTAMP;
DECLARE rid VARCHAR(10);
INSERT INTO income (event_id,status,details,amount)
VALUES (NEW.event_id,'hello','helloworld',NEW.amount);
SELECT record_id FROM `income` ORDER BY time_stamp DESC LIMIT 1 INTO rid;
SET NEW.record_id=rid;
SELECT time_stamp FROM `income` ORDER BY time_stamp DESC LIMIT 1 INTO sid;
SET NEW.time_stamp=sid;
END;

--
-- Triggers `system_feedback`

CREATE TRIGGER `feedback_id_seq_system_feedback_insert` BEFORE INSERT ON `system_feedback` FOR EACH ROW BEGIN
  INSERT INTO feedback_id_seq VALUES (NULL);
  SET NEW.feedback_id = CONCAT('S', LPAD(LAST_INSERT_ID(), 7, '0'));
END;

--
-- Triggers `event_feedback`
--

CREATE TRIGGER `feedback_id_seq_event_feedback_insert` BEFORE INSERT ON `event_feedback` FOR EACH ROW BEGIN
  INSERT INTO feedback_id_seq VALUES (NULL);
  SET NEW.feedback_id = CONCAT('E', LPAD(LAST_INSERT_ID(), 7, '0'));
END;

--
-- Triggers `expense`
--

CREATE TRIGGER `record_id_seq_expense_insert` BEFORE INSERT ON `expense` FOR EACH ROW BEGIN
  INSERT INTO record_id_seq VALUES (NULL);
  SET NEW.record_id = CONCAT('EXP', LPAD(LAST_INSERT_ID(), 7, '0'));
END;
--
-- Triggers `income`
--

CREATE TRIGGER `record_id_seq_income_insert` BEFORE INSERT ON `income` FOR EACH ROW BEGIN
  INSERT INTO record_id_seq VALUES (NULL);
  SET NEW.record_id= CONCAT('INC', LPAD(LAST_INSERT_ID(), 7, '0'));
END
;

--
-- Triggers `organization`
--

CREATE TRIGGER `id_seq_organization_insert` BEFORE INSERT ON `organization` FOR EACH ROW BEGIN
  INSERT INTO id_seq VALUES (NULL);
  SET NEW.uid = CONCAT('ORG', LPAD(LAST_INSERT_ID(), 7, '0'));
END;


CREATE TRIGGER `login_organization_delete` AFTER DELETE ON `organization` FOR EACH ROW BEGIN
  DELETE FROM login WHERE login.uid=old.uid;
END
;


--
-- Triggers `registered_user`
--

CREATE TRIGGER `id_seq_registered_user_insert` BEFORE INSERT ON `registered_user` FOR EACH ROW BEGIN
  INSERT INTO id_seq VALUES (NULL);
  SET NEW.uid = CONCAT('REG', LPAD(LAST_INSERT_ID(), 7, '0'));
END
;


CREATE TRIGGER `login_registereduser_delete` AFTER DELETE ON `registered_user` FOR EACH ROW BEGIN
  DELETE FROM login WHERE login.uid=old.uid;
END
;


COMMIT;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
