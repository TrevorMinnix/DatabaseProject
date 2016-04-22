-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2016 at 12:37 AM
-- Server version: 5.7.11
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminLogin` varchar(50) NOT NULL,
  `adminPass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminLogin`, `adminPass`) VALUES
('a', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `gcchair`
--

CREATE TABLE `gcchair` (
  `gcLogin` varchar(50) NOT NULL,
  `sessionid` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gcchair`
--

INSERT INTO `gcchair` (`gcLogin`, `sessionid`) VALUES
('gc1', 'summer2017');

-- --------------------------------------------------------

--
-- Table structure for table `gcmember`
--

CREATE TABLE `gcmember` (
  `gcName` varchar(70) NOT NULL,
  `gcEmail` varchar(255) NOT NULL,
  `gcLogin` varchar(50) NOT NULL,
  `gcPass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gcmember`
--

INSERT INTO `gcmember` (`gcName`, `gcEmail`, `gcLogin`, `gcPass`) VALUES
('Effie, Karlene', 'gc1@mailinator.com', 'gc1', 'gc1'),
('Estelle, Andre', 'gc2@mailinator.com', 'gc2', 'gc2'),
('Jeanette, Fiona', 'gc3@mailinator.com', 'gc3', 'gc3');

-- --------------------------------------------------------

--
-- Table structure for table `gcscoring`
--

CREATE TABLE `gcscoring` (
  `gcLogin` varchar(50) NOT NULL,
  `pid` varchar(20) NOT NULL,
  `score` int(11) NOT NULL,
  `sessionid` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gtanominator`
--

CREATE TABLE `gtanominator` (
  `nominatorName` varchar(70) NOT NULL,
  `nominatorEmail` varchar(255) NOT NULL,
  `nominatorLogin` varchar(50) NOT NULL,
  `nominatorPass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gtanominator`
--

INSERT INTO `gtanominator` (`nominatorName`, `nominatorEmail`, `nominatorLogin`, `nominatorPass`) VALUES
('Caden, Quinn', 'nom1@mailinator.com', 'nom1', 'nom1'),
('Page, Luvenia', 'nom2@mialinator.com', 'nom2', 'nom2'),
('Finnega, Monte', 'nom3@mailinator.com', 'nom3', 'nom3');

-- --------------------------------------------------------

--
-- Table structure for table `gtanominee`
--

CREATE TABLE `gtanominee` (
  `advisor` varchar(70) DEFAULT NULL,
  `nomineeName` varchar(70) DEFAULT NULL,
  `pid` varchar(20) NOT NULL,
  `nomineeEmail` varchar(255) DEFAULT NULL,
  `nomineePhone` varchar(10) DEFAULT NULL,
  `isPHDStudent` int(11) DEFAULT NULL,
  `semestersAsGrad` int(11) DEFAULT NULL,
  `passedSpeak` int(11) DEFAULT NULL,
  `semestersAsGTA` int(11) DEFAULT NULL,
  `gradCourses` varchar(255) DEFAULT NULL,
  `gpa` float DEFAULT NULL,
  `publications` varchar(255) DEFAULT NULL,
  `newlyAdmitted` tinyint(1) DEFAULT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nomination`
--

CREATE TABLE `nomination` (
  `nominatorLogin` varchar(50) NOT NULL,
  `pid` varchar(20) NOT NULL,
  `ranking` int(11) NOT NULL,
  `timestamp` datetime NOT NULL,
  `sessionid` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `sessionid` varchar(20) NOT NULL,
  `nominationDeadline` datetime NOT NULL,
  `nomineeResponseDeadline` datetime NOT NULL,
  `nomineeVerificationDeadline` datetime NOT NULL,
  `currentlyActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`sessionid`, `nominationDeadline`, `nomineeResponseDeadline`, `nomineeVerificationDeadline`, `currentlyActive`) VALUES
('summer2017', '2016-04-15 00:00:00', '2016-04-21 00:00:00', '2016-04-20 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sessiongc`
--

CREATE TABLE `sessiongc` (
  `sessionid` varchar(20) NOT NULL,
  `gcLogin` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sessiongc`
--

INSERT INTO `sessiongc` (`sessionid`, `gcLogin`) VALUES
('summer2017', 'gc1'),
('summer2017', 'gc2'),
('summer2017', 'gc3');

-- --------------------------------------------------------

--
-- Table structure for table `sessionnominators`
--

CREATE TABLE `sessionnominators` (
  `sessionid` varchar(20) NOT NULL,
  `gtaNominatorLogin` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sessionnominators`
--

INSERT INTO `sessionnominators` (`sessionid`, `gtaNominatorLogin`) VALUES
('summer2017', 'nom1'),
('summer2017', 'nom2'),
('summer2017', 'nom3');

-- --------------------------------------------------------

--
-- Table structure for table `sessionnominee`
--

CREATE TABLE `sessionnominee` (
  `sessionid` varchar(20) NOT NULL,
  `gtanomineeLogin` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminLogin`);

--
-- Indexes for table `gcchair`
--
ALTER TABLE `gcchair`
  ADD PRIMARY KEY (`gcLogin`,`sessionid`),
  ADD UNIQUE KEY `sessionid_2` (`sessionid`),
  ADD KEY `gcLogin` (`gcLogin`),
  ADD KEY `sessionid` (`sessionid`),
  ADD KEY `gcLogin_2` (`gcLogin`),
  ADD KEY `gcLogin_3` (`gcLogin`);

--
-- Indexes for table `gcmember`
--
ALTER TABLE `gcmember`
  ADD PRIMARY KEY (`gcLogin`),
  ADD KEY `gcLogin` (`gcLogin`);

--
-- Indexes for table `gcscoring`
--
ALTER TABLE `gcscoring`
  ADD PRIMARY KEY (`gcLogin`,`pid`,`sessionid`),
  ADD KEY `gcLogin` (`gcLogin`,`pid`,`sessionid`),
  ADD KEY `pid` (`pid`),
  ADD KEY `sessionid` (`sessionid`);

--
-- Indexes for table `gtanominator`
--
ALTER TABLE `gtanominator`
  ADD PRIMARY KEY (`nominatorLogin`),
  ADD KEY `nominatorLogin` (`nominatorLogin`);

--
-- Indexes for table `gtanominee`
--
ALTER TABLE `gtanominee`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `nomination`
--
ALTER TABLE `nomination`
  ADD PRIMARY KEY (`nominatorLogin`,`pid`,`sessionid`),
  ADD KEY `nominatorLogin` (`nominatorLogin`,`pid`,`sessionid`),
  ADD KEY `pid` (`pid`),
  ADD KEY `sessionid` (`sessionid`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`sessionid`),
  ADD KEY `sessionid` (`sessionid`);

--
-- Indexes for table `sessiongc`
--
ALTER TABLE `sessiongc`
  ADD PRIMARY KEY (`sessionid`,`gcLogin`),
  ADD KEY `sessionid` (`sessionid`),
  ADD KEY `gcmemberLogin` (`gcLogin`);

--
-- Indexes for table `sessionnominators`
--
ALTER TABLE `sessionnominators`
  ADD PRIMARY KEY (`sessionid`,`gtaNominatorLogin`),
  ADD KEY `sessionid` (`sessionid`),
  ADD KEY `gtaNominatorLogin` (`gtaNominatorLogin`);

--
-- Indexes for table `sessionnominee`
--
ALTER TABLE `sessionnominee`
  ADD PRIMARY KEY (`sessionid`,`gtanomineeLogin`),
  ADD KEY `sessionid` (`sessionid`),
  ADD KEY `gtanomineeLogin` (`gtanomineeLogin`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gcchair`
--
ALTER TABLE `gcchair`
  ADD CONSTRAINT `gcchair_ibfk_1` FOREIGN KEY (`sessionid`) REFERENCES `session` (`sessionid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gcchair_ibfk_2` FOREIGN KEY (`gcLogin`) REFERENCES `gcmember` (`gcLogin`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gcscoring`
--
ALTER TABLE `gcscoring`
  ADD CONSTRAINT `gcscoring_ibfk_1` FOREIGN KEY (`gcLogin`) REFERENCES `gcmember` (`gcLogin`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gcscoring_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `gtanominee` (`pid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gcscoring_ibfk_3` FOREIGN KEY (`sessionid`) REFERENCES `session` (`sessionid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nomination`
--
ALTER TABLE `nomination`
  ADD CONSTRAINT `nomination_ibfk_1` FOREIGN KEY (`nominatorLogin`) REFERENCES `gtanominator` (`nominatorLogin`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nomination_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `gtanominee` (`pid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nomination_ibfk_3` FOREIGN KEY (`sessionid`) REFERENCES `session` (`sessionid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sessiongc`
--
ALTER TABLE `sessiongc`
  ADD CONSTRAINT `sessiongc_ibfk_1` FOREIGN KEY (`sessionid`) REFERENCES `session` (`sessionid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sessiongc_ibfk_2` FOREIGN KEY (`gcLogin`) REFERENCES `gcmember` (`gcLogin`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sessionnominators`
--
ALTER TABLE `sessionnominators`
  ADD CONSTRAINT `sessionnominators_ibfk_1` FOREIGN KEY (`sessionid`) REFERENCES `session` (`sessionid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sessionnominators_ibfk_2` FOREIGN KEY (`gtaNominatorLogin`) REFERENCES `gtanominator` (`nominatorLogin`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sessionnominee`
--
ALTER TABLE `sessionnominee`
  ADD CONSTRAINT `sessionnominee_ibfk_1` FOREIGN KEY (`sessionid`) REFERENCES `session` (`sessionid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sessionnominee_ibfk_2` FOREIGN KEY (`gtanomineeLogin`) REFERENCES `gtanominee` (`pid`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
