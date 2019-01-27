-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jan 26, 2019 at 05:01 AM
-- Server version: 10.0.27-MariaDB-cll-lve
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbalerrt`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblagency`
--

CREATE TABLE IF NOT EXISTS `tblagency` (
  `AgencyID` int(255) NOT NULL AUTO_INCREMENT,
  `AgencyCaption` varchar(500) NOT NULL,
  `AgencyDescription` varchar(5000) NOT NULL,
  `AgencyFirstname` varchar(255) NOT NULL,
  `AgencyLastname` varchar(255) NOT NULL,
  `AgencyPosition` varchar(255) NOT NULL,
  `AgencyContactNumber` varchar(5000) NOT NULL,
  `AgencyStatus` varchar(255) NOT NULL,
  `AgencyImage` varchar(1000) NOT NULL,
  PRIMARY KEY (`AgencyID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tblagency`
--

INSERT INTO `tblagency` (`AgencyID`, `AgencyCaption`, `AgencyDescription`, `AgencyFirstname`, `AgencyLastname`, `AgencyPosition`, `AgencyContactNumber`, `AgencyStatus`, `AgencyImage`) VALUES
(1, 'Bureau of Fire Protection-Manila Chapter', 'Bureau of Fire Protection-Manila Chapter Description', 'Julie Ann', 'Tarrobago', 'Social Worker', '421-1918,913-2786,09355062962', 'Active', ''),
(2, 'DSWD-Main', 'DSWD-Main Description', 'Julie Ann', 'Tarrobago', 'Social Worker', '57435834534', 'Active', 'http://alerrt.x10.mx\n/ALERRT/mobile_app/images/agencies/dswd.png'),
(3, 'Manila Water', 'Manila Water Description', 'Julie Ann', 'Tarrobago', 'Social Worker', '654645645', 'Active', ''),
(4, 'NDRRMC-NCR', 'NDRRMC-NCR Description', 'Julie Ann', 'Tarrobago', 'Social Worker', '53453453', 'Active', '');

-- --------------------------------------------------------

--
-- Table structure for table `tblcomments`
--

CREATE TABLE IF NOT EXISTS `tblcomments` (
  `CommentID` int(255) NOT NULL AUTO_INCREMENT,
  `PostID` varchar(255) NOT NULL,
  `CommentBy` varchar(1000) NOT NULL,
  `Comment` varchar(5000) NOT NULL,
  `DateAndTimeCommented` varchar(1000) NOT NULL,
  PRIMARY KEY (`CommentID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tblposts`
--

CREATE TABLE IF NOT EXISTS `tblposts` (
  `TopicID` int(255) NOT NULL AUTO_INCREMENT,
  `TopicTitle` varchar(255) NOT NULL,
  `TopicImage` varchar(1000) NOT NULL,
  `TopicLocationID` varchar(1000) NOT NULL,
  `TopicLocationName` varchar(1000) NOT NULL,
  `TopicLocationAddress` varchar(1000) NOT NULL,
  `TopicAgencyID` varchar(255) NOT NULL,
  `TopicStatus` varchar(1000) NOT NULL,
  `TopicPostedBy` varchar(1000) NOT NULL,
  `TopicDateAndTimePosted` varchar(255) NOT NULL,
  PRIMARY KEY (`TopicID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tblposts`
--

INSERT INTO `tblposts` (`TopicID`, `TopicTitle`, `TopicImage`, `TopicLocationID`, `TopicLocationName`, `TopicLocationAddress`, `TopicAgencyID`, `TopicStatus`, `TopicPostedBy`, `TopicDateAndTimePosted`) VALUES
(1, 'hoy te', '', '', '', '', '4', 'Pending', '9acc07c3f382248122c419bdc7c45ga3', 'January 26, 2019 | 03:12 PM'),
(2, 'hoy te', '', '', '', '', '4', 'Pending', '9acc07c3f382248122c419bdc7c45ga3', 'January 26, 2019 | 03:12 PM'),
(3, 'hey', '', '', '', '', '3', 'Pending', '9acc07c3f382248122c419bdc7c45ga3', 'January 26, 2019 | 03:12 PM'),
(4, 'hey', 'http://alerrt.x10.mx/ALERRT/mobile_app/images/posts/aa2713fc1c64c8e47635554b81dddf55.jpg', 'ChIJVbzr0RjKlzMRdxIRlVwyF9A', 'Universidad De Manila', 'Address: \n659-A Cecilia MuÃ±oz St, Ermita, Manila, 1000 Metro Manila, Philippines\n', '1', 'Pending', '9acc07c3f382248122c419bdc7c45ga3', 'January 26, 2019 | 03:13 PM'),
(5, 'hey', 'http://alerrt.x10.mx/ALERRT/mobile_app/images/posts/231067ca8418248a58b424954e038d76.jpg', 'ChIJVbzr0RjKlzMRdxIRlVwyF9A', 'Universidad De Manila', 'Address: \n659-A Cecilia MuÃ±oz St, Ermita, Manila, 1000 Metro Manila, Philippines\n', '1', 'Pending', '9acc07c3f382248122c419bdc7c45ga3', 'January 26, 2019 | 03:13 PM'),
(6, 'hey', 'http://alerrt.x10.mx/ALERRT/mobile_app/images/posts/43ded59be043447c516f902232866961.jpg', 'ChIJVbzr0RjKlzMRdxIRlVwyF9A', 'Universidad De Manila', 'Address: \n659-A Cecilia MuÃ±oz St, Ermita, Manila, 1000 Metro Manila, Philippines\n', '1', 'Pending', '9acc07c3f382248122c419bdc7c45ga3', 'January 26, 2019 | 03:14 PM');

-- --------------------------------------------------------

--
-- Table structure for table `tblstatus`
--

CREATE TABLE IF NOT EXISTS `tblstatus` (
  `StatusID` int(255) NOT NULL AUTO_INCREMENT,
  `StatusPostID` varchar(255) NOT NULL,
  `StatusType` varchar(500) NOT NULL,
  `StatusBy` varchar(255) NOT NULL,
  `StatusDateAndTime` varchar(1000) NOT NULL,
  PRIMARY KEY (`StatusID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE IF NOT EXISTS `tblusers` (
  `ID` int(255) NOT NULL AUTO_INCREMENT,
  `UserID` varchar(1000) NOT NULL,
  `Fullname` varchar(500) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `MobileNumber` varchar(255) NOT NULL,
  `Gender` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `DateAndTimeRegistered` varchar(255) NOT NULL,
  `Address` varchar(1000) NOT NULL,
  `Birthdate` varchar(255) NOT NULL,
  `UserRole` varchar(255) NOT NULL,
  `ProfilePicture` varchar(1000) NOT NULL,
  `Agency` varchar(255) NOT NULL,
  `UserStatus` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`ID`, `UserID`, `Fullname`, `Email`, `MobileNumber`, `Gender`, `Password`, `DateAndTimeRegistered`, `Address`, `Birthdate`, `UserRole`, `ProfilePicture`, `Agency`, `UserStatus`) VALUES
(1, '9acc07c3f382248122c419bdc7c45ga1', 'ALERRT', 'alerrt@gmail.com', '09582475548', 'Male', 'alerrt123', 'January 01, 2019 | 04:14 PM', 'Manila, Philippines', '02/22/1999', 'SUPER_ADMIN', '', '', 'Approved'),
(2, '9acc07c3f382248122c419bdc7c45ga2', 'Arianne Sora', 'ariannesora@gmail.com', '09070536821', 'Female', 'ajcs1499', 'January 05, 2019 | 06:58 PM', '208 Quezon St Tondo Manila', '03/14/1999', 'USER', '', '', 'Approved'),
(3, '9acc07c3f382248122c419bdc7c45ga3', 'Jemaica Malasaga', 'jemaicamalasaga@yahoo.com', '09387726692', 'Female', 'jemaica18', 'January 06, 2019 | 12:13 AM', 'Manila', '09/29/1996', 'USER', '', '', 'Approved'),
(4, '9acc07c3f382248122c419bdc7c45ga4', 'Marideth', 'maridethbhernandez@gmail.com', '09754906502', 'Female', '112396maridetH', 'January 06, 2019 | 12:16 AM', 'Sta.Ana, Manila', '11/23/1996', 'USER', '', '', 'Approved'),
(5, '9acc07c3f382248122c419bdc7c45ga5', 'watch Me', 'luke31997@gmail.com', '09282423187', 'Female', '112396', 'January 06, 2019 | 12:20 AM', 'Sta.ana', '11/23/1996', 'USER', '', '', 'Approved'),
(6, '9acc07c3f382248122c419bdc7c45ga6', 'Lala', 'mama@gmail.com', '09266322495', 'Female', '112396', 'January 06, 2019 | 12:22 AM', 'Sta. Ana Manila', '11/23/1996', 'USER', '', '', 'Approved'),
(7, '9acc07c3f382248122c419bdc7c45ga7', 'Mamamo', 'mamamo@gmail.com', '099754906502', 'Female', 'mamamo123', 'January 08, 2019 | 01:17 AM', 'Manila', '11/23/1996', 'USER', '', '', 'Approved'),
(8, '9acc07c3f382248122c419bdc7c45ga8', 'Jomari', 'osurejiramoj22@gmail.com', '09958239884', 'Male', 'hahahaha', 'January 11, 2019 | 08:15 AM', '888 CP Garcia', '8/22/1998', 'USER', '', '', 'Approved'),
(9, '9acc07c3f382248122c419bdc7c45ga9', 'John Paul Sibug', 'jhsibug@live.com', '09176666666', 'Male', '1234', 'January 12, 2019 | 03:24 PM', '1234', '06/24/1988', 'USER', '', '', 'Approved'),
(10, '9bpg07c3f382248122c419bdc7c45ce6', 'DSWD-Main User', 'dswd@gmail.com', '09582475548', '', 'dswd123', 'January 20, 2019 | 5:30 PM', 'Manila, Philippines', '', 'ADMIN', 'http://alerrt.x10.mx/ALERRT/mobile_app/images/agencies/dswd.png', '2', 'Approved');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
