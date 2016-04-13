-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2016 at 03:44 AM
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
CREATE DATABASE IF NOT EXISTS `dbproject` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `dbproject`;

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
('test', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `gcchair`
--

CREATE TABLE `gcchair` (
  `gcLogin` varchar(50) NOT NULL,
  `sessionid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Table structure for table `gtanominee`
--

CREATE TABLE `gtanominee` (
  `advisor` varchar(70) NOT NULL,
  `nomineeName` varchar(70) NOT NULL,
  `pid` varchar(20) NOT NULL,
  `nomineeEmail` varchar(255) NOT NULL,
  `nomineePhone` int(10) NOT NULL,
  `isPHDStudent` int(11) NOT NULL,
  `semestersAsGrad` int(11) NOT NULL,
  `passedSpeak` int(11) NOT NULL,
  `semestersAsGTA` int(11) NOT NULL,
  `gradCourses` varchar(255) NOT NULL,
  `gpa` float NOT NULL,
  `publications` varchar(255) NOT NULL,
  `newlyAdmitted` tinyint(1) NOT NULL
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
  `sessionid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `sessionid` int(11) NOT NULL,
  `nominationDeadline` datetime NOT NULL,
  `nomineeResponseDeadline` datetime NOT NULL,
  `nomineeVerficationDeadline` datetime NOT NULL,
  `currentlyActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sessiongc`
--

CREATE TABLE `sessiongc` (
  `sessionid` int(11) NOT NULL,
  `gcLogin` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sessionnominators`
--

CREATE TABLE `sessionnominators` (
  `sessionid` int(11) NOT NULL,
  `gtaNominatorLogin` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sessionnominee`
--

CREATE TABLE `sessionnominee` (
  `sessionid` int(11) NOT NULL,
  `gtanomineeLogin` int(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  ADD KEY `gcLogin` (`gcLogin`),
  ADD KEY `sessionid` (`sessionid`);

--
-- Indexes for table `gcmember`
--
ALTER TABLE `gcmember`
  ADD PRIMARY KEY (`gcLogin`);

--
-- Indexes for table `gtanominator`
--
ALTER TABLE `gtanominator`
  ADD PRIMARY KEY (`nominatorLogin`);

--
-- Indexes for table `gtanominee`
--
ALTER TABLE `gtanominee`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `nomination`
--
ALTER TABLE `nomination`
  ADD KEY `nominatorLogin` (`nominatorLogin`,`pid`,`sessionid`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`sessionid`);

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
