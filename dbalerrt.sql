-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2019 at 02:46 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbalerrt`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblagency`
--

CREATE TABLE `tblagency` (
  `AgencyID` int(255) NOT NULL,
  `AgencyCaption` varchar(500) NOT NULL,
  `AgencyDescription` varchar(5000) NOT NULL,
  `AgencyContactNumber` varchar(5000) NOT NULL,
  `AgencyLocation` varchar(1000) NOT NULL,
  `AgencyStatus` varchar(255) NOT NULL,
  `AgencyImage` varchar(1000) NOT NULL,
  `AgencyMain` varchar(255) NOT NULL,
  `AgencyAvailability` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblagency`
--

INSERT INTO `tblagency` (`AgencyID`, `AgencyCaption`, `AgencyDescription`, `AgencyContactNumber`, `AgencyLocation`, `AgencyStatus`, `AgencyImage`, `AgencyMain`, `AgencyAvailability`) VALUES
(1, 'Bureau of Fire Protection-Manila Chapter', 'Bureau of Fire Protection-Manila Chapter Description', '09573475934', 'Bureau of Fire Protection-Manila Chapter Address', 'Active', '', '', '12hrs'),
(2, 'DSWD-Main', 'Description 2', '57435834534', '', 'Active', '', '', ''),
(3, 'Manila Water', 'Description 3', '654645645', '', 'Active', '', '', '24hrs'),
(4, 'NDRRMC-NCR', 'Description 4', '53453453', '', 'Active', '', '', '24hrs'),
(5, 'DSWD 2', '', '4253453', '', 'Active', '', '2', ''),
(6, 'Manila Water (Tondo Manila)', 'SAMPLE', 'SAMPLE', 'SAMPLE ADDRESS', 'Active', '', '3', '24hrs');

-- --------------------------------------------------------

--
-- Table structure for table `tblcomments`
--

CREATE TABLE `tblcomments` (
  `CommentID` int(255) NOT NULL,
  `PostID` varchar(255) NOT NULL,
  `CommentBy` varchar(1000) NOT NULL,
  `Comment` varchar(5000) NOT NULL,
  `DateAndTimeCommented` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblposts`
--

CREATE TABLE `tblposts` (
  `TopicID` int(255) NOT NULL,
  `TopicSeverity` varchar(255) NOT NULL DEFAULT 'Minor',
  `TopicTitle` varchar(255) NOT NULL,
  `TopicImage` varchar(1000) NOT NULL,
  `TopicLocationID` varchar(1000) NOT NULL,
  `TopicLocationName` varchar(1000) NOT NULL,
  `TopicLocationAddress` varchar(1000) NOT NULL,
  `TopicAgencyID` varchar(255) NOT NULL,
  `TopicStatus` varchar(1000) NOT NULL,
  `TopicPostedBy` varchar(1000) NOT NULL,
  `TopicDateAndTimePosted` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblposts`
--

INSERT INTO `tblposts` (`TopicID`, `TopicSeverity`, `TopicTitle`, `TopicImage`, `TopicLocationID`, `TopicLocationName`, `TopicLocationAddress`, `TopicAgencyID`, `TopicStatus`, `TopicPostedBy`, `TopicDateAndTimePosted`) VALUES
(6, 'Minor', 'NDRRMC REPORT', 'images/posts/56324a7126984782f8bf7e9fb94df35f.jpg', '849VCWC8+QCRR', '37Â°25\'19.2\"N 122Â°05\'02.4\"W', 'Address: \n1600 Amphitheatre Pkwy, Mountain View, CA 94043, USA\n', '4', 'Pending', '9acc07c3f382248122c419bdc7c45fa9', 'February 09, 2019 | 09:16 PM'),
(7, 'Critical', 'MANILA WATER REPORT', 'images/posts/411991efea734b9c97e5a982448e217c.jpg', 'ChIJpbWakPi5j4ARe6K8tsWb_eg', 'Google Shuttle Stop @ Building 40/43', 'Address: \nMountain View, CA 94043, USA\n', '3', 'Ongoing', '9acc07c3f382248122c419bdc7c45fa9', 'February 10, 2019 | 05:38 PM');

-- --------------------------------------------------------

--
-- Table structure for table `tblstatus`
--

CREATE TABLE `tblstatus` (
  `StatusID` int(255) NOT NULL,
  `StatusPostID` varchar(255) NOT NULL,
  `StatusType` varchar(500) NOT NULL,
  `StatusBy` varchar(255) NOT NULL,
  `StatusDateAndTime` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblstatus`
--

INSERT INTO `tblstatus` (`StatusID`, `StatusPostID`, `StatusType`, `StatusBy`, `StatusDateAndTime`) VALUES
(1, '7', 'Ongoing', '9acc07c3f382248122c419bdc7c45ga8', 'February 10, 2019 | 10:04 PM');

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `ID` int(255) NOT NULL,
  `UserID` varchar(1000) NOT NULL,
  `Fullname` varchar(500) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `MobileNumber` varchar(255) NOT NULL,
  `Gender` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `DateAndTimeRegistered` varchar(255) NOT NULL,
  `Birthdate` varchar(255) NOT NULL,
  `UserRole` varchar(255) NOT NULL,
  `ProfilePicture` varchar(1000) NOT NULL,
  `Agency` varchar(255) NOT NULL,
  `UserStatus` varchar(255) NOT NULL,
  `LatLong` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`ID`, `UserID`, `Fullname`, `Email`, `MobileNumber`, `Gender`, `Password`, `DateAndTimeRegistered`, `Birthdate`, `UserRole`, `ProfilePicture`, `Agency`, `UserStatus`, `LatLong`) VALUES
(1, '9acc07c3f382248122c419bdc7c45fa9', 'Tristan Jules B. Rosales', 'tristanrosales0@gmail.com', '09979859471', 'Male', 'tan123', 'October 29, 2018 | 10:15 PM', '02/22/1999', 'USER', '', '', 'Approved', '14.5955,120.9721'),
(2, '9acc07c3f382248122c419bdc7c45ga8', 'ALERRT', 'alerrt@gmail.com', '09582475548', 'Male', 'alerrt123', 'January 01, 2019 | 04:14 PM', '02/22/1999', 'SUPER_ADMIN', '', '', 'Approved', '14.5955,120.9721'),
(3, '9acc07c3f382248122c419bdc7c45ce6', 'DSWD-Main User', 'dswd@gmail.com', '09582475548', '', 'dswd123', 'January 17, 2019 | 08:30 PM', '', 'ADMIN', '', '2', 'Approved', '14.537752, 121.001381'),
(4, '1b625fbe91a54f8fd6207a900cf1be88', 'Manila Water User', 'manila.water@gmail.com', '09987659986', '', 'mw123', 'January 27, 2019 | 07:32 PM', '', 'ADMIN', '', '3', 'Approved', '14.5955,120.9721'),
(5, '1b625fbe91a54f8fd6207a900cf1be90', 'Manila Water Backup User', 'mw_backup@gmail.com', '54353452', '', 'mw12', 'January 28, 2019 | 07:32 PM', '', 'ADMIN', '', '6', 'Approved', '14.5955,120.9721'),
(6, '4cc8c6db9dc6d1b5cc4504942be4e1f3', 'SAMPLE', 'sample@gmail.com', '5453645', '', 'sample', 'February 09, 2019 | 07:57 PM', '', 'ADMIN', '', '6', 'Approved', '14.5955,120.9721');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblagency`
--
ALTER TABLE `tblagency`
  ADD PRIMARY KEY (`AgencyID`);

--
-- Indexes for table `tblcomments`
--
ALTER TABLE `tblcomments`
  ADD PRIMARY KEY (`CommentID`);

--
-- Indexes for table `tblposts`
--
ALTER TABLE `tblposts`
  ADD PRIMARY KEY (`TopicID`);

--
-- Indexes for table `tblstatus`
--
ALTER TABLE `tblstatus`
  ADD PRIMARY KEY (`StatusID`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblagency`
--
ALTER TABLE `tblagency`
  MODIFY `AgencyID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblcomments`
--
ALTER TABLE `tblcomments`
  MODIFY `CommentID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblposts`
--
ALTER TABLE `tblposts`
  MODIFY `TopicID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblstatus`
--
ALTER TABLE `tblstatus`
  MODIFY `StatusID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
