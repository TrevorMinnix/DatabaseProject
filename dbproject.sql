-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2016 at 11:14 PM
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
-- Table structure for table `nomination`
--

CREATE TABLE `nomination` (
  `nominatorLogin` varchar(50) NOT NULL,
  `pid` varchar(20) NOT NULL,
  `ranking` int(11) NOT NULL,
  `timestamp` datetime NOT NULL,
  `sessionid` varchar(20) NOT NULL,
  `verified` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nomination`
--

INSERT INTO `nomination` (`nominatorLogin`, `pid`, `ranking`, `timestamp`, `sessionid`, `verified`) VALUES
('nom1', '1192237342', 3, '2016-04-23 04:04:19', 'summer2017', 0),
('nom1', '1744857750', 2, '2016-04-23 04:04:51', 'summer2017', 1),
('nom1', '5826110693', 1, '2016-04-23 04:04:34', 'summer2017', 0),
('nom2', '0748918312', 1, '2016-04-23 04:04:06', 'summer2017', 0),
('nom2', '1255106636', 3, '2016-04-23 04:04:15', 'summer2017', 0),
('nom2', '2162494240', 2, '2016-04-23 04:04:43', 'summer2017', 1),
('nom3', '2546029920', 3, '2016-04-23 04:04:07', 'summer2017', 0),
('nom3', '4398964083', 2, '2016-04-23 04:04:29', 'summer2017', 0),
('nom3', '6009090366', 1, '2016-04-23 04:04:00', 'summer2017', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nomination`
--
ALTER TABLE `nomination`
  ADD PRIMARY KEY (`nominatorLogin`,`pid`,`sessionid`),
  ADD KEY `nominatorLogin` (`nominatorLogin`,`pid`,`sessionid`),
  ADD KEY `pid` (`pid`),
  ADD KEY `sessionid` (`sessionid`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `nomination`
--
ALTER TABLE `nomination`
  ADD CONSTRAINT `nomination_ibfk_1` FOREIGN KEY (`nominatorLogin`) REFERENCES `gtanominator` (`nominatorLogin`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nomination_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `gtanominee` (`pid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nomination_ibfk_3` FOREIGN KEY (`sessionid`) REFERENCES `session` (`sessionid`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
