-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2016 at 10:59 PM
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
  `sessionid` varchar(20) NOT NULL,
  `comment` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gcscoring`
--

INSERT INTO `gcscoring` (`gcLogin`, `pid`, `score`, `sessionid`, `comment`) VALUES
('gc1', '0748918312', 75, 'summer2017', NULL),
('gc1', '2162494240', 60, 'summer2017', NULL),
('gc2', '0748918312', 1, 'summer2017', 'Terrible'),
('gc2', '1744857750', 100, 'summer2017', 'Great!'),
('gc3', '0748918312', 100, 'summer2017', 'Comment'),
('gc3', '1744857750', 90, 'summer2017', NULL);

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
  `newlyAdmitted` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gtanominee`
--

INSERT INTO `gtanominee` (`advisor`, `nomineeName`, `pid`, `nomineeEmail`, `nomineePhone`, `isPHDStudent`, `semestersAsGrad`, `passedSpeak`, `semestersAsGTA`, `gradCourses`, `gpa`, `publications`, `newlyAdmitted`) VALUES
('asghkghjk', 'Daniella, Kasia', '0748918312', 'gta4@mailinator.com', '6435187964', 0, 4, 2, 2, 'dfgfgs', 3, 'asdfaa', 1),
('sdfgsdfg', 'Tammie, Joanie', '1192237342', 'gta3@mailinator.com', '6413598999', 1, 1, 1, 3, 'dfghdfgadfg', 4, 'dfgsdfgsdfg', 1),
('sdfgfghjgfhj', 'Maris, Phillip', '1255106636', 'gta6@mailinator.com', '9373640293', 1, 7, 1, 4, 'asdnhmghjkghjk', 0, 'ghjkdfghadf', 0),
('4287', 'Linette, Elaine', '1744857750', 'gta2@mailinator.com', '1567891236', 0, 456, 0, 456, '456456', 4, '48378', 1),
('sdfgasdfgask', 'Sharlene, Damon', '2162494240', 'gta5@mailinator.com', '7481235436', 0, 4, 0, 4, '423453', 1, 'asgdfgsdf', 1),
('1', 'Lark, Joanie', '2546029920', 'gta9@mailinator.com', '1454789542', 0, 1, 1, 1, '1', 1, '1', 0),
(NULL, 'Lyla, Sonny', '4398964083', 'gta8@mailinator.com', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(NULL, 'Abd, Grover', '5826110693', 'gta1@mailinator.com', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(NULL, 'Freda, Loretta', '6009090366', 'gta7@mailinator.com', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `nomination`
--

CREATE TABLE `nomination` (
  `nominatorLogin` varchar(50) NOT NULL,
  `pid` varchar(20) NOT NULL,
  `ranking` int(11) NOT NULL,
  `timestamp` datetime NOT NULL,
  `sessionid` varchar(20) NOT NULL,
  `verified` tinyint(4) NOT NULL DEFAULT '0',
  `responded` tinyint(4) NOT NULL DEFAULT '0',
  `averageScore` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nomination`
--

INSERT INTO `nomination` (`nominatorLogin`, `pid`, `ranking`, `timestamp`, `sessionid`, `verified`, `responded`, `averageScore`) VALUES
('nom1', '1192237342', 3, '2016-04-23 04:04:19', 'summer2017', 0, 1, 0),
('nom1', '1744857750', 2, '2016-04-23 04:04:51', 'summer2017', 1, 1, 95),
('nom1', '5826110693', 1, '2016-04-23 04:04:34', 'summer2017', 0, 0, 0),
('nom2', '0748918312', 1, '2016-04-23 04:04:06', 'summer2017', 1, 1, 59),
('nom2', '1255106636', 3, '2016-04-23 04:04:15', 'summer2017', 0, 1, 0),
('nom2', '2162494240', 2, '2016-04-23 04:04:43', 'summer2017', 1, 1, 60),
('nom3', '2546029920', 3, '2016-04-23 04:04:07', 'summer2017', 0, 1, 0),
('nom3', '4398964083', 2, '2016-04-23 04:04:29', 'summer2017', 0, 0, 0),
('nom3', '6009090366', 1, '2016-04-23 04:04:00', 'summer2017', 0, 0, 0);

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
('summer2017', '2016-04-15 00:00:00', '2016-04-23 00:00:00', '2016-04-29 00:00:00', 1);

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
-- Dumping data for table `sessionnominee`
--

INSERT INTO `sessionnominee` (`sessionid`, `gtanomineeLogin`) VALUES
('summer2017', '0748918312'),
('summer2017', '1192237342'),
('summer2017', '1255106636'),
('summer2017', '1744857750'),
('summer2017', '2162494240'),
('summer2017', '2546029920'),
('summer2017', '4398964083'),
('summer2017', '5826110693'),
('summer2017', '6009090366');

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
