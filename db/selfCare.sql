-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2024 at 04:04 PM
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
-- Database: `self_caredb`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `CommentID` int(11) NOT NULL,
  `PostID` int(11) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `CommentText` text DEFAULT NULL,
  `CommentDate` date DEFAULT NULL,
  `Likes` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`CommentID`, `PostID`, `UserID`, `CommentText`, `CommentDate`, `Likes`) VALUES
(1, 2, 2, 'hi', '2024-04-08', 0);

-- --------------------------------------------------------

--
-- Table structure for table `communityposts`
--

CREATE TABLE `communityposts` (
  `PostID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `GoalID` int(11) DEFAULT NULL,
  `PostText` text DEFAULT NULL,
  `PostDate` date DEFAULT NULL,
  `Likes` int(11) DEFAULT 0,
  `CommentsCount` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `communityposts`
--

INSERT INTO `communityposts` (`PostID`, `UserID`, `GoalID`, `PostText`, `PostDate`, `Likes`, `CommentsCount`) VALUES
(1, 1, NULL, 'Reach out if you need a specialist\r\n', '2024-04-07', 0, 0),
(2, 2, NULL, 'Hello this is my first ever post XD', '2024-04-08', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `goals`
--

CREATE TABLE `goals` (
  `GoalID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `ReminderTime` time DEFAULT NULL,
  `GoalText` text DEFAULT NULL,
  `GoalStatus` enum('complete','incomplete') DEFAULT 'incomplete'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `goals`
--

INSERT INTO `goals` (`GoalID`, `UserID`, `ReminderTime`, `GoalText`, `GoalStatus`) VALUES
(5, 1, '12:00:00', 'exercise', 'incomplete'),
(6, 1, '00:00:00', 'exercise', 'incomplete'),
(7, 1, '00:00:00', 'exercise', 'incomplete'),
(8, 1, '00:00:00', 'b', 'incomplete'),
(9, 1, '00:00:00', 'b', 'incomplete'),
(10, 1, '00:00:00', 'b', 'incomplete'),
(12, 2, '00:00:00', 'skincare', 'incomplete'),
(13, 1, '00:00:00', 'skincare', 'incomplete');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `LikeID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `PostID` int(11) DEFAULT NULL,
  `CommentID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `likes`
--

INSERT INTO `likes` (`LikeID`, `UserID`, `PostID`, `CommentID`) VALUES
(1, 2, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `request_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `specialist_id` int(11) DEFAULT NULL,
  `date_requested` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `specialists`
--

CREATE TABLE `specialists` (
  `SpecialistID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Specialization` enum('Skincare') NOT NULL,
  `ContactInfo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `specialists`
--

INSERT INTO `specialists` (`SpecialistID`, `Name`, `Specialization`, `ContactInfo`) VALUES
(1, 'Dr. Erica Thompson', 'Skincare', 'drerica@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Gender` enum('male','female','other') DEFAULT 'male',
  `DateOfBirth` date NOT NULL,
  `Password` varchar(255) NOT NULL,
  `RegistrationDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `FirstName`, `LastName`, `Email`, `Gender`, `DateOfBirth`, `Password`, `RegistrationDate`) VALUES
(1, 'Dr. Erica', 'Thompson', 'drerica@gmail.com', 'female', '1998-02-02', '$2y$10$DTUaUj4p6eZAzjnS1I8ow.M8ifWuY9WzAvZwozq9y8/tXDOWDORf6', '2024-04-07 22:35:25'),
(2, 'Mariam', 'Wahab', 'mariamw605@gmail.com', 'female', '2003-08-27', '$2y$10$4ml9F7WFjk6lsPxq9G4GpObHDNcsLOlEwYuSub5LHz18htccXdT2G', '2024-04-07 22:40:09');

-- Create Role Table
CREATE TABLE Roles (
    RoleID INT PRIMARY KEY,
    RoleName VARCHAR(100) NOT NULL
);

-- Insert Role Data
INSERT INTO Roles (RoleID, RoleName) VALUES
(1, 'Specialist'),
(2, 'User');

-- Add RoleID column to Users table
ALTER TABLE Users
ADD COLUMN RoleID INT,
ADD CONSTRAINT fk_user_role FOREIGN KEY (RoleID) REFERENCES Roles(RoleID);

-- Add RoleID column to Specialists table
ALTER TABLE Specialists
ADD COLUMN RoleID INT,
ADD CONSTRAINT fk_specialist_role FOREIGN KEY (RoleID) REFERENCES Roles(RoleID);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`CommentID`),
  ADD KEY `PostID` (`PostID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `communityposts`
--
ALTER TABLE `communityposts`
  ADD PRIMARY KEY (`PostID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `GoalID` (`GoalID`);

--
-- Indexes for table `goals`
--
ALTER TABLE `goals`
  ADD PRIMARY KEY (`GoalID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`LikeID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `PostID` (`PostID`),
  ADD KEY `CommentID` (`CommentID`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `specialist_id` (`specialist_id`);

--
-- Indexes for table `specialists`
--
ALTER TABLE `specialists`
  ADD PRIMARY KEY (`SpecialistID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `CommentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `communityposts`
--
ALTER TABLE `communityposts`
  MODIFY `PostID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `goals`
--
ALTER TABLE `goals`
  MODIFY `GoalID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=412;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `LikeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `specialists`
--
ALTER TABLE `specialists`
  MODIFY `SpecialistID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`PostID`) REFERENCES `communityposts` (`PostID`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `communityposts`
--
ALTER TABLE `communityposts`
  ADD CONSTRAINT `communityposts_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `communityposts_ibfk_2` FOREIGN KEY (`GoalID`) REFERENCES `goals` (`GoalID`);

--
-- Constraints for table `goals`
--
ALTER TABLE `goals`
  ADD CONSTRAINT `goals_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`PostID`) REFERENCES `communityposts` (`PostID`),
  ADD CONSTRAINT `likes_ibfk_3` FOREIGN KEY (`CommentID`) REFERENCES `comments` (`CommentID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
