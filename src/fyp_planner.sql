-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2022 at 08:15 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fyp_planner`
--

-- --------------------------------------------------------

--
-- Table structure for table `moderator`
--

CREATE TABLE `moderator` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(72) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `moderator`
--

INSERT INTO `moderator` (`id`, `username`, `password`, `name`) VALUES
(1, 'AdminMod', 'admin', 'Admin Moderator');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `title` varchar(40) NOT NULL,
  `description` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL COMMENT 'Approved / Pending / Rejected / Achieved',
  `supervisor` int(11) NOT NULL,
  `student` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `title`, `description`, `status`, `supervisor`, `student`) VALUES
(25, 'Testing Proposal', 'This is testing proposal submission system', 'Pending', 1, NULL),
(26, 'TEst 2', 'asdsd', 'Pending', 1, NULL),
(27, 'Test 3', 'asdasd', 'Pending', 1, NULL),
(28, 'Test 4', 'desdfsdf', 'Pending', 1, NULL),
(29, 'test', 'asd', 'Pending', 1, NULL),
(30, 'asdasd', 'asd', 'Pending', 1, NULL),
(31, 'ASDalsjd', 'asd', 'Pending', 1, NULL),
(32, 'AI Self Driving System', 'Create a simulator to simulate AI learning to drive.', 'Approved', 1, 2),
(33, 'asd', 'asd', 'Pending', 1, NULL),
(34, 'AI Learning Program', 'Create a program that AI will do self learning on something.', 'Archieved', 1, 3),
(35, 'Movie System', 'Create a movie system.', 'Archieved', 1, 1),
(36, 'test_Data', 'test_data', 'Pending', 1, NULL),
(37, 'sdaasda', 'asd', 'Pending', 1, NULL),
(38, 'SupervisorB Testing proposal', 'Testing Proposal', 'Pending', 2, NULL),
(39, 'alskjdlakdjd', 'asd', 'Pending', 1, NULL),
(41, 'asdeaadade', 'asdasd', 'Pending', 1, NULL),
(42, 'new project', 'qweqew', 'Pending', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project_goal`
--

CREATE TABLE `project_goal` (
  `id` int(11) NOT NULL,
  `project` int(11) NOT NULL,
  `task` varchar(50) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `status` varchar(15) NOT NULL COMMENT 'Not Started / In Progress / Completed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `project_marksheet`
--

CREATE TABLE `project_marksheet` (
  `id` int(11) NOT NULL,
  `project` int(11) NOT NULL,
  `mark1` int(3) NOT NULL,
  `mark2` int(3) NOT NULL,
  `mark3` int(3) NOT NULL,
  `mark4` int(3) NOT NULL,
  `mark5` int(3) NOT NULL,
  `comment` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project_marksheet`
--

INSERT INTO `project_marksheet` (`id`, `project`, `mark1`, `mark2`, `mark3`, `mark4`, `mark5`, `comment`) VALUES
(10, 34, 10, 20, 30, 40, 50, 'Test marksheet'),
(11, 35, 12, 13, 14, 15, 16, 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `project_meeting`
--

CREATE TABLE `project_meeting` (
  `id` int(11) NOT NULL,
  `project` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project_meeting`
--

INSERT INTO `project_meeting` (`id`, `project`, `date`, `time`, `description`) VALUES
(1, 34, '2022-03-30', '14:36:30', 'Upcoming Test'),
(2, 34, '2022-03-17', '00:36:30', 'Past Time Test'),
(3, 34, '2022-03-19', '17:39:56', 'Test Time'),
(4, 34, '2022-03-02', '17:40:42', 'Test Time 2'),
(6, 32, '2022-03-24', '18:35:00', 'First Meeting'),
(7, 32, '2022-03-10', '11:40:00', 'Test'),
(8, 35, '2022-03-18', '05:40:00', 'ASD'),
(9, 35, '2022-03-10', '17:40:00', 'asd');

-- --------------------------------------------------------

--
-- Table structure for table `project_planning`
--

CREATE TABLE `project_planning` (
  `id` int(11) NOT NULL,
  `week` int(3) NOT NULL,
  `description` varchar(50) NOT NULL,
  `project` int(11) NOT NULL,
  `status` varchar(10) NOT NULL COMMENT 'Approved, Pending, Rejected'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project_planning`
--

INSERT INTO `project_planning` (`id`, `week`, `description`, `project`, `status`) VALUES
(1, 1, 'Formulate initial project plan', 34, 'Approved'),
(2, 2, 'Write up project spec & scope', 34, 'Approved'),
(3, 12, 'Finish The Report', 34, 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `project_registration`
--

CREATE TABLE `project_registration` (
  `id` int(11) NOT NULL,
  `project` int(11) NOT NULL,
  `student` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project_registration`
--

INSERT INTO `project_registration` (`id`, `project`, `student`) VALUES
(1, 34, 1),
(2, 34, 3),
(3, 35, 1),
(4, 32, 2);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(72) NOT NULL,
  `name` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `state` int(2) NOT NULL COMMENT '1->No Projects yet, 2->Waiting supervisor to approve, 3->Ongoing project, 4->Project Completed '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `username`, `password`, `name`, `dob`, `state`) VALUES
(1, 'test1', '$2y$10$mf2WRYtAZEIvoD92Jf5MyeZW9FLm5Jru0/ti5wN1B1X1MGHsuTeOS', 'Test A', '2022-03-23', 1),
(2, 'studenta', '$2y$10$Aurp.AUpf//y8JNtnLLIz.LWTjx0d3cIBZXNqM6YBwU3HjrMzSluC', 'Student A', '2022-03-24', 1),
(3, '123', '$2y$10$/W2w9Xi8XHIZCzez1OWFpOD2y2MKZoeJe/U/O.JsYNSos1gxAWmxe', '123', '0003-03-12', 1),
(4, '321', '$2y$10$fcjaUTt8OCWwD8NZjvFRN.sFK6f2UCJq.tdti.mbJDj57Ac7rsmWG', '123', '0023-03-12', 1),
(6, 'AdminStud', '$2y$10$AhI7PSZqisPp75v9IgGgIOjCNiJJYGTISWdx4eeuolYdXWTs7P8V6', 'Admin Student', '0001-01-01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `supervisor`
--

CREATE TABLE `supervisor` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(72) NOT NULL,
  `name` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `rating` int(11) NOT NULL,
  `total_rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supervisor`
--

INSERT INTO `supervisor` (`id`, `username`, `password`, `name`, `dob`, `rating`, `total_rating`) VALUES
(1, 'SupervisorA', '$2y$10$yVnxpM0nP2pzIjUdObmTuubtsrkmVBUXiNUx7xpu3DBmO6xpAmA4C', 'Test Supervisor A', '2022-03-15', 0, 0),
(2, 'SupervisorB', '$2y$10$c.jsmUjwEmr44Ku0iqlBne3xAC/OiIBjErQWRRuZWUbiENKqne6om', 'Supervisor B', '1980-10-18', 0, 0),
(4, 'AdminSuper', '$2y$10$8o.Y.DGrJpYtb/wZvcUaJ.pRXU/mzrn5GexIlAakM6AC4N8aJOo46', 'Admin Supervisor', '0001-01-01', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `moderator`
--
ALTER TABLE `moderator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supervisor` (`supervisor`),
  ADD KEY `student` (`student`);

--
-- Indexes for table `project_goal`
--
ALTER TABLE `project_goal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project` (`project`);

--
-- Indexes for table `project_marksheet`
--
ALTER TABLE `project_marksheet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project` (`project`);

--
-- Indexes for table `project_meeting`
--
ALTER TABLE `project_meeting`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project` (`project`);

--
-- Indexes for table `project_planning`
--
ALTER TABLE `project_planning`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project` (`project`);

--
-- Indexes for table `project_registration`
--
ALTER TABLE `project_registration`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project` (`project`),
  ADD KEY `student` (`student`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supervisor`
--
ALTER TABLE `supervisor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `moderator`
--
ALTER TABLE `moderator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `project_goal`
--
ALTER TABLE `project_goal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project_marksheet`
--
ALTER TABLE `project_marksheet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `project_meeting`
--
ALTER TABLE `project_meeting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `project_planning`
--
ALTER TABLE `project_planning`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `project_registration`
--
ALTER TABLE `project_registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `supervisor`
--
ALTER TABLE `supervisor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`student`) REFERENCES `student` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `project_ibfk_4` FOREIGN KEY (`supervisor`) REFERENCES `supervisor` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `project_goal`
--
ALTER TABLE `project_goal`
  ADD CONSTRAINT `project_goal_ibfk_1` FOREIGN KEY (`project`) REFERENCES `project` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `project_marksheet`
--
ALTER TABLE `project_marksheet`
  ADD CONSTRAINT `project_marksheet_ibfk_1` FOREIGN KEY (`project`) REFERENCES `project` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `project_meeting`
--
ALTER TABLE `project_meeting`
  ADD CONSTRAINT `project_meeting_ibfk_1` FOREIGN KEY (`project`) REFERENCES `project` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `project_planning`
--
ALTER TABLE `project_planning`
  ADD CONSTRAINT `project_planning_ibfk_1` FOREIGN KEY (`project`) REFERENCES `project` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `project_registration`
--
ALTER TABLE `project_registration`
  ADD CONSTRAINT `project_registration_ibfk_1` FOREIGN KEY (`project`) REFERENCES `project` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `project_registration_ibfk_2` FOREIGN KEY (`student`) REFERENCES `student` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
