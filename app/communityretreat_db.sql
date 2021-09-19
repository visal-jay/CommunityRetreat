-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 18, 2021 at 07:49 PM
-- Server version: 5.7.24
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
-- Database: `communityretreat_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `event_id` int(10) DEFAULT NULL,
  `uid` varchar(10) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
  `image` varchar(500) NOT NULL DEFAULT '/Uploads/placeholder-image.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `uid` varchar(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_number` varchar(12) NOT NULL,
  `profile_pic` varchar(500) NOT NULL DEFAULT '/Uploads/placeholder-image.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`uid`, `username`, `email`, `contact_number`, `profile_pic`) VALUES
('ADM0000031', 'LeoClub', 'ucsc@gmail.com', '+94702154671', '/Uploads/profile/ADM00000310.png');

--
-- Triggers `admin`
--
DELIMITER $$
CREATE TRIGGER `id_seq_admin_insert` BEFORE INSERT ON `admin` FOR EACH ROW BEGIN
  INSERT INTO id_seq VALUES (NULL);
  SET NEW.uid = CONCAT('ADM', LPAD(LAST_INSERT_ID(), 7, '0'));
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `login_admin_update` AFTER UPDATE ON `admin` FOR EACH ROW BEGIN
    	UPDATE login SET email = NEW.email WHERE email = old.email;    
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `announcement_id` int(10) NOT NULL,
  `event_id` int(10) NOT NULL,
  `title` varchar(500) DEFAULT NULL,
  `announcement` text NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`announcement_id`, `event_id`, `title`, `announcement`, `time_stamp`) VALUES
(1, 2, NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '2021-08-28 06:47:28');

-- --------------------------------------------------------

--
-- Table structure for table `calender`
--

CREATE TABLE `calender` (
  `uid` varchar(10) NOT NULL,
  `event_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `calender`
--

INSERT INTO `calender` (`uid`, `event_id`) VALUES
('REG0000032', 2),
('REG0000032', 4);

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
  `record_id` int(10) DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `contact_no` int(12) NOT NULL,
  `credit_card_no` int(11) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `donation`
--

INSERT INTO `donation` (`donation_id`, `event_id`, `uid`, `record_id`, `amount`, `contact_no`, `credit_card_no`, `time_stamp`) VALUES
(1, 1, NULL, 2, 123, 1234, 1234, '2021-08-26 19:02:15'),
(2, 1, NULL, 3, 123, 1234, 1234, '2021-08-26 19:03:02'),
(3, 1, NULL, 4, 123, 1234, 1234, '2021-08-26 19:05:19'),
(4, 5, 'REG0000032', 5, 12000, 1234, 1234, '2021-09-10 17:19:18'),
(5, 3, 'REG0000032', 6, 3000, 119, 22222, '2021-09-10 17:20:51');

--
-- Triggers `donation`
--
DELIMITER $$
CREATE TRIGGER `income_donation` BEFORE INSERT ON `donation` FOR EACH ROW BEGIN
DECLARE sid TIMESTAMP;
DECLARE rid INT(10);
INSERT INTO income (event_id,status,details,amount)
VALUES (NEW.event_id,'donation','donation',NEW.amount);
SELECT record_id FROM `income` ORDER BY time_stamp DESC LIMIT 1 INTO rid;
SET NEW.record_id=rid;
SELECT time_stamp FROM `income` ORDER BY time_stamp DESC LIMIT 1 INTO sid;
SET NEW.time_stamp=sid;
END
$$
DELIMITER ;

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
  `end_time` time NOT NULL,
  `about` text NOT NULL,
  `mode` enum('Virtual','Physical','Physical & Virtual') NOT NULL,
  `status` enum('added','published','unpublished','deleted','ended') NOT NULL,
  `volunteer_capacity` int(11) DEFAULT NULL,
  `donation_capacity` int(11) DEFAULT NULL,
  `cover_photo` varchar(500) DEFAULT '/Uploads/placeholder-image.jpg',
  `donation_status` tinyint(1) NOT NULL DEFAULT '0',
  `volunteer_status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`event_id`, `event_name`, `org_uid`, `latlang`, `start_date`, `start_time`, `end_time`, `about`, `mode`, `status`, `volunteer_capacity`, `donation_capacity`, `cover_photo`, `donation_status`, `volunteer_status`) VALUES
(1, 'hello', NULL, NULL, '2021-08-10', '23:50:55', '23:50:55', 'asfdfd', 'Virtual', 'published', NULL, NULL, NULL, 0, 0),
(2, 'RevolUX', NULL, NULL, '2021-09-04', '10:00:00', '11:30:00', 'UI/UX designathon', 'Virtual', 'published', 80, 20, NULL, 1, 0),
(3, 'Tree plantation program', NULL, NULL, '2021-10-02', '08:00:00', '18:00:00', '\"Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...\"', 'Physical', 'unpublished', 100, 100, NULL, 1, 1),
(4, 'Pet adoption ', NULL, NULL, '2021-08-31', '10:00:00', '14:00:00', '', 'Physical & Virtual', 'published', 20, 50, NULL, 0, 0),
(5, 'Beach Cleaning event ', NULL, NULL, '2021-11-11', '14:00:00', '18:00:00', '', 'Physical', 'published', 100, 10, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `event_details`
-- (See below for the actual view)
--
CREATE TABLE `event_details` (
`event_id` int(10)
,`event_name` varchar(255)
,`org_uid` varchar(10)
,`latlang` point
,`start_date` date
,`start_time` time
,`end_time` time
,`about` text
,`mode` enum('Virtual','Physical','Physical & Virtual')
,`volunteer_capacity` int(11)
,`donation_capacity` int(11)
,`cover_photo` varchar(500)
,`donation_status` tinyint(1)
,`volunteer_status` tinyint(1)
,`donations` decimal(32,0)
,`donation_percent` decimal(39,4)
,`volunteered` bigint(21)
,`volunteer_percent` decimal(27,4)
,`organisation_username` varchar(255)
,`status` enum('added','published','unpublished','deleted','ended')
);

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
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date` date NOT NULL,
  `rate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `event_feedback`
--
DELIMITER $$
CREATE TRIGGER `feedback_id_seq_event_feedback_insert` BEFORE INSERT ON `event_feedback` FOR EACH ROW BEGIN
  INSERT INTO feedback_id_seq VALUES (NULL);
  SET NEW.feedback_id = CONCAT('E', LPAD(LAST_INSERT_ID(), 7, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `record_id` int(10) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `event_id` int(10) NOT NULL,
  `uid` varchar(10) DEFAULT NULL,
  `status` enum('current','deleted','updated') NOT NULL DEFAULT 'current',
  `details` text NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `feedback_id_seq`
--

CREATE TABLE `feedback_id_seq` (
  `f_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

INSERT INTO `id_seq` (`id`) VALUES
(14),
(15),
(16),
(17),
(18),
(19),
(20),
(21),
(22),
(23),
(24),
(25),
(26),
(27),
(28),
(29),
(30),
(31),
(32);

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `record_id` int(10) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `event_id` int(10) NOT NULL,
  `uid` varchar(10) DEFAULT NULL,
  `status` enum('current','deleted','updated','donation') NOT NULL DEFAULT 'current',
  `details` text NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`record_id`, `time_stamp`, `event_id`, `uid`, `status`, `details`, `amount`) VALUES
(1, '2021-08-26 18:33:46', 1, NULL, 'current', 'abcd', 12000),
(2, '2021-08-26 19:02:15', 1, NULL, 'current', 'helloworld', 123),
(3, '2021-08-26 19:03:02', 1, NULL, 'current', 'helloworld', 123),
(4, '2021-08-26 19:05:19', 1, NULL, 'current', 'donation', 123),
(5, '2021-09-10 17:19:18', 5, NULL, 'current', 'donation', 12000),
(6, '2021-09-10 17:20:51', 3, NULL, 'current', 'donation', 3000);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `email` varchar(255) NOT NULL,
  `user_type` enum('registered_user','organization','admin') NOT NULL,
  `password` varchar(255) NOT NULL,
  `uid` varchar(10) NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `failed_login_count` int(11) NOT NULL DEFAULT '0',
  `first_failed_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reset_password` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`email`, `user_type`, `password`, `uid`, `verified`, `time_stamp`, `failed_login_count`, `first_failed_login`, `reset_password`) VALUES
('abcd@gmail.com', 'registered_user', 'Manu@1997', 'REG0000032', 1, '2021-09-06 16:55:45', 3, '2021-09-06 00:25:45', 0),
('aiesec97@gmail.com', 'organization', 'Manuka@1997', 'ORG0000024', 1, '2021-09-03 10:30:43', 0, '2021-09-03 10:30:43', 0),
('ucsc@gmail.com', 'admin', 'Manuka@1997', 'ADM0000031', 1, '2021-09-06 10:29:50', 0, '2021-09-06 10:30:48', 0);

--
-- Triggers `login`
--
DELIMITER $$
CREATE TRIGGER `login_admin_delete` AFTER DELETE ON `login` FOR EACH ROW BEGIN
  DELETE FROM admin WHERE admin.uid=old.uid;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `login_organization_delete` AFTER DELETE ON `login` FOR EACH ROW BEGIN
  DELETE FROM organization WHERE organization.uid=old.uid;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `login_registereduser_delete` AFTER DELETE ON `login` FOR EACH ROW BEGIN
  DELETE FROM registered_user WHERE registered_user.uid=old.uid;
END
$$
DELIMITER ;

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
  `profile_pic` varchar(500) DEFAULT '/Uploads/placeholder-image.jpg',
  `cover_pic` varchar(500) DEFAULT '/Uploads/placeholder-image.jpg',
  `about_us` text,
  `latlang` point DEFAULT NULL,
  `account_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `organization`
--
DELIMITER $$
CREATE TRIGGER `id_seq_organization_insert` BEFORE INSERT ON `organization` FOR EACH ROW BEGIN
  INSERT INTO id_seq VALUES (NULL);
  SET NEW.uid = CONCAT('ORG', LPAD(LAST_INSERT_ID(), 7, '0'));
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `login_organization_update` AFTER UPDATE ON `organization` FOR EACH ROW BEGIN
    	UPDATE login SET email = NEW.email WHERE email = old.email;    
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `organization_gallery`
--

CREATE TABLE `organization_gallery` (
  `image_id` int(10) NOT NULL,
  `uid` varchar(10) DEFAULT NULL,
  `image` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `record_id_seq`
--

CREATE TABLE `record_id_seq` (
  `rec_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `registered_user`
--

CREATE TABLE `registered_user` (
  `uid` varchar(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_number` varchar(12) NOT NULL,
  `profile_pic` varchar(500) DEFAULT '/Uploads/placeholder-image.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registered_user`
--

INSERT INTO `registered_user` (`uid`, `username`, `email`, `contact_number`, `profile_pic`) VALUES
('REG0000032', 'Phenomenal', 'abcd@gmail.com', '+94703414038', '/Uploads/profile/REG00000320.png');

--
-- Triggers `registered_user`
--
DELIMITER $$
CREATE TRIGGER `id_seq_registered_user_insert` BEFORE INSERT ON `registered_user` FOR EACH ROW BEGIN
  INSERT INTO id_seq VALUES (NULL);
  SET NEW.uid = CONCAT('REG', LPAD(LAST_INSERT_ID(), 7, '0'));
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `login_registered_user_update` AFTER UPDATE ON `registered_user` FOR EACH ROW BEGIN
    	UPDATE login SET email = NEW.email WHERE email=old.email;    
END
$$
DELIMITER ;

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

--
-- Triggers `system_feedback`
--
DELIMITER $$
CREATE TRIGGER `feedback_id_seq_system_feedback_insert` BEFORE INSERT ON `system_feedback` FOR EACH ROW BEGIN
  INSERT INTO feedback_id_seq VALUES (NULL);
  SET NEW.feedback_id = CONCAT('S', LPAD(LAST_INSERT_ID(), 7, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `volunteer`
--

CREATE TABLE `volunteer` (
  `uid` varchar(10) NOT NULL,
  `event_id` int(10) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `volunteer`
--

INSERT INTO `volunteer` (`uid`, `event_id`, `date`) VALUES
('REG0000032', 2, '2021-09-27'),
('REG0000032', 4, '2021-09-22');

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

-- --------------------------------------------------------

--
-- Structure for view `event_details`
--
DROP TABLE IF EXISTS `event_details`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `event_details`  AS  select `event`.`event_id` AS `event_id`,`event`.`event_name` AS `event_name`,`event`.`org_uid` AS `org_uid`,`event`.`latlang` AS `latlang`,`event`.`start_date` AS `start_date`,`event`.`start_time` AS `start_time`,`event`.`end_time` AS `end_time`,`event`.`about` AS `about`,`event`.`mode` AS `mode`,`event`.`volunteer_capacity` AS `volunteer_capacity`,`event`.`donation_capacity` AS `donation_capacity`,`event`.`cover_photo` AS `cover_photo`,`event`.`donation_status` AS `donation_status`,`event`.`volunteer_status` AS `volunteer_status`,sum(`donation`.`amount`) AS `donations`,((sum(`donation`.`amount`) / `event`.`donation_capacity`) * 100) AS `donation_percent`,`vol`.`volunteered` AS `volunteered`,((`vol`.`volunteered` / `event`.`volunteer_capacity`) * 100) AS `volunteer_percent`,`org`.`username` AS `organisation_username`,`event`.`status` AS `status` from (((`event` left join `donation` on((`event`.`event_id` = `donation`.`event_id`))) left join (select `volunteer`.`event_id` AS `event_id`,count(`volunteer`.`event_id`) AS `volunteered` from `volunteer`) `vol` on((`event`.`event_id` = `vol`.`event_id`))) left join (select `organization`.`username` AS `username`,`organization`.`uid` AS `uid` from `organization`) `org` on((`event`.`org_uid` = `org`.`uid`))) group by `event`.`event_id` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
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
ALTER TABLE `event`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `org_event_fk` (`org_uid`);

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
-- Indexes for table `organization_gallery`
--
ALTER TABLE `organization_gallery`
  ADD PRIMARY KEY (`image_id`);

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
  MODIFY `image_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `announcement_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `complaint`
--
ALTER TABLE `complaint`
  MODIFY `complaint_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `donation`
--
ALTER TABLE `donation`
  MODIFY `donation_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `event_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `record_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback_id_seq`
--
ALTER TABLE `feedback_id_seq`
  MODIFY `f_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `id_seq`
--
ALTER TABLE `id_seq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `record_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `organization_gallery`
--
ALTER TABLE `organization_gallery`
  MODIFY `image_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `record_id_seq`
--
ALTER TABLE `record_id_seq`
  MODIFY `rec_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `work_timeline`
--
ALTER TABLE `work_timeline`
  MODIFY `task_id` int(10) NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `addphoto_event_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`) ON DELETE SET NULL;

--
-- Constraints for table `announcement`
--
ALTER TABLE `announcement`
  ADD CONSTRAINT `announcement_event_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `calender`
--
ALTER TABLE `calender`
  ADD CONSTRAINT `calender_event_fk` FOREIGN KEY (`event_id`) REFERENCES `volunteer` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE,
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
  ADD CONSTRAINT `income_event_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`);

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

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `login_reset_password_reset` ON SCHEDULE EVERY 1 MINUTE STARTS '2021-08-23 00:41:03' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE login SET reset_password=0 WHERE time_stamp < now() - interval 60 minute$$

CREATE DEFINER=`root`@`localhost` EVENT `login_delete` ON SCHEDULE EVERY 1 MINUTE STARTS '2021-08-23 00:41:03' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM login WHERE time_stamp < now() - interval 24 hour and verified=0$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
