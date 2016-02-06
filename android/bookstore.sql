-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 18, 2015 at 03:33 AM
-- Server version: 5.5.38
-- PHP Version: 5.6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `bookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `ActiveOrders`
--

CREATE TABLE `ActiveOrders` (
`tid` int(11) NOT NULL,
  `storeID` int(11) DEFAULT NULL,
  `storeName` varchar(100) DEFAULT NULL,
  `custID` int(11) DEFAULT NULL,
  `custFirstName` varchar(30) DEFAULT NULL,
  `custLastName` varchar(30) DEFAULT NULL,
  `transTime` datetime NOT NULL,
  `numberOfLines` int(11) DEFAULT NULL,
  `unitsOrdered` int(11) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `type` varchar(30) DEFAULT NULL,
  `subTot` float DEFAULT NULL,
  `taxRatePercent` float DEFAULT NULL,
  `taxAmount` float DEFAULT NULL,
  `discountPercentage` float DEFAULT NULL,
  `shipFee` float DEFAULT NULL,
  `totPrice` float DEFAULT NULL,
  `receiverName` varchar(100) DEFAULT NULL,
  `shippingAddr` varchar(256) DEFAULT NULL,
  `shipMethod` varchar(100) DEFAULT NULL,
  `deliveryTimeCode` varchar(50) DEFAULT NULL,
  `carrierName` varchar(100) DEFAULT NULL,
  `deliveryNotes` varchar(500) DEFAULT NULL,
  `orderStatus` varchar(30) DEFAULT NULL,
  `msgToCust` text,
  `msgToStore` text,
  `agentName` varchar(100) DEFAULT NULL,
  `notes` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Admins`
--

CREATE TABLE `Admins` (
`adminID` int(11) NOT NULL,
  `insertDate` date NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `otherPhone` varchar(30) DEFAULT NULL,
  `mailAddr` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(30) NOT NULL,
  `question` tinyint(4) NOT NULL,
  `answer` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `BookReviews`
--

CREATE TABLE `BookReviews` (
  `isbn` varchar(20) NOT NULL DEFAULT '',
  `bookTitle` varchar(50) DEFAULT NULL,
  `custID` int(11) NOT NULL DEFAULT '0',
  `custFirstName` varchar(30) DEFAULT NULL,
  `custLastName` varchar(30) DEFAULT NULL,
  `reviewTime` datetime NOT NULL,
  `overallStars` float NOT NULL,
  `revTitle` varchar(200) DEFAULT NULL,
  `comment` text,
  `helpful` int(11) DEFAULT NULL,
  `noHelp` int(11) DEFAULT NULL,
  `numFbk` int(11) DEFAULT NULL,
  `feedback` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Books`
--

CREATE TABLE `Books` (
  `isbn` varchar(20) NOT NULL,
  `isbn10` varchar(20) DEFAULT NULL,
  `insertDate` date NOT NULL,
  `callNum` varchar(30) DEFAULT NULL,
  `title` varchar(100) CHARACTER SET utf8 NOT NULL,
  `subTitle` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `altTitle` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `author` varchar(100) CHARACTER SET utf8 NOT NULL,
  `translator` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `audience` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `language` varchar(50) DEFAULT NULL,
  `editionType` varchar(30) DEFAULT NULL,
  `edtionNumber` tinyint(4) DEFAULT NULL,
  `amzonStar` float DEFAULT NULL,
  `amazonReviews` smallint(6) DEFAULT NULL,
  `amazonRevLink` varchar(200) DEFAULT NULL,
  `category` varchar(50) CHARACTER SET utf8 NOT NULL,
  `subCat` varchar(50) CHARACTER SET utf8 NOT NULL,
  `subSubCat` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `altCat` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `altSubCat` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `altSubSubCat` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `publisherName` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `pubDate` date DEFAULT NULL,
  `keywords` varchar(256) DEFAULT NULL,
  `description` text,
  `contents` text,
  `fromBackCover` text,
  `productFormatDetail` varchar(100) DEFAULT NULL,
  `productDimensions` varchar(200) DEFAULT NULL,
  `shippingWeight` float DEFAULT NULL,
  `pages` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Books`
--

INSERT INTO `Books` (`isbn`, `isbn10`, `insertDate`, `callNum`, `title`, `subTitle`, `altTitle`, `author`, `translator`, `audience`, `language`, `editionType`, `edtionNumber`, `amzonStar`, `amazonReviews`, `amazonRevLink`, `category`, `subCat`, `subSubCat`, `altCat`, `altSubCat`, `altSubSubCat`, `publisherName`, `pubDate`, `keywords`, `description`, `contents`, `fromBackCover`, `productFormatDetail`, `productDimensions`, `shippingWeight`, `pages`) VALUES
('1234567890', NULL, '2014-12-01', NULL, 'Introduction to Algorithms Box', NULL, NULL, 'Thomas Cormen, T. Leveresen', NULL, NULL, 'English', NULL, NULL, NULL, NULL, NULL, 'Computers 	', 'Algorithms', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('1234567891', NULL, '2014-12-01', NULL, 'Introduction to Algorithm Analysis', NULL, NULL, 'Thomas Cormen, T. Leveresen', NULL, NULL, 'English', NULL, NULL, NULL, NULL, NULL, 'Computers', 'Algorithms', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('6054860445', NULL, '2015-03-10', NULL, 'Xml Databases', NULL, NULL, 'jnksnfjsl, jhsidkfjsla', NULL, NULL, 'English', NULL, NULL, NULL, NULL, NULL, 'Computers', 'Databases', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('794867409485', NULL, '2015-03-17', NULL, 'Databases', NULL, NULL, 'guanfs, jlsmvfls', NULL, NULL, 'E', NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('8586474939', NULL, '2015-03-17', NULL, 'Advanced databases', NULL, NULL, 'djhfksla, jhsidfsakm', NULL, NULL, 'English', NULL, NULL, NULL, NULL, NULL, 'Computers', 'Databases', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Branches`
--

CREATE TABLE `Branches` (
  `organID` int(11) NOT NULL DEFAULT '0',
  `branchID` tinyint(4) NOT NULL DEFAULT '0',
  `organName` varchar(100) DEFAULT NULL,
  `bname` varchar(100) NOT NULL,
  `cbname` varchar(100) DEFAULT NULL,
  `contact` varchar(50) DEFAULT NULL,
  `ccontact` varchar(50) DEFAULT NULL,
  `telephoneNumber` varchar(30) NOT NULL,
  `otherPhone` varchar(30) DEFAULT NULL,
  `address` varchar(300) DEFAULT NULL,
  `emailAddress` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Customers`
--

CREATE TABLE `Customers` (
`custID` int(11) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `middleName` varchar(30) DEFAULT NULL,
  `lastName` varchar(30) NOT NULL,
  `altName` varchar(50) DEFAULT NULL,
  `telephoneNumber` varchar(30) DEFAULT NULL,
  `otherPhone` varchar(30) DEFAULT NULL,
  `addrStNum` varchar(100) DEFAULT NULL,
  `addrL2` varchar(100) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `zip` varchar(20) DEFAULT NULL,
  `latitude` float(10,6) DEFAULT NULL,
  `longtitude` float(10,6) DEFAULT NULL,
  `emailAddress` varchar(100) NOT NULL,
  `password` varchar(30) NOT NULL,
  `cardNumber` varchar(20) DEFAULT NULL,
  `cardType` varchar(20) DEFAULT NULL,
  `cardName` varchar(50) DEFAULT NULL,
  `cardExp` date DEFAULT NULL,
  `cardCode` varchar(10) DEFAULT NULL,
  `billingAddr` varchar(300) DEFAULT NULL,
  `paypalNum` varchar(30) DEFAULT NULL,
  `homeLib` varchar(100) DEFAULT NULL,
  `notify` tinyint(1) DEFAULT NULL,
  `deals` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `CustReviews`
--

CREATE TABLE `CustReviews` (
  `storeID` int(11) NOT NULL DEFAULT '0',
  `storeName` varchar(100) DEFAULT NULL,
  `custID` int(11) NOT NULL DEFAULT '0',
  `custFirstName` varchar(30) DEFAULT NULL,
  `custLastName` varchar(30) DEFAULT NULL,
  `reviewTime` datetime NOT NULL,
  `overallStars` float NOT NULL,
  `revTitle` varchar(200) DEFAULT NULL,
  `comment` text,
  `custReply` text,
  `helpful` int(11) DEFAULT NULL,
  `noHelp` int(11) DEFAULT NULL,
  `numFbk` int(11) DEFAULT NULL,
  `feedback` text,
  `numOverdue` int(11) DEFAULT NULL,
  `numAbuse` int(11) DEFAULT NULL,
  `numLost` int(11) DEFAULT NULL,
  `numFines` int(11) DEFAULT NULL,
  `amtFine` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Inventory`
--

CREATE TABLE `Inventory` (
  `storeID` int(11) NOT NULL DEFAULT '0',
  `storeName` varchar(50) DEFAULT NULL,
  `isbn` varchar(20) NOT NULL DEFAULT '',
  `idx` tinyint(4) NOT NULL DEFAULT '0',
  `privateCallNum` varchar(20) DEFAULT NULL,
  `bookCondition` varchar(30) DEFAULT NULL,
  `condDesc` varchar(200) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `salesPrice` float DEFAULT NULL,
  `rentPrice` float DEFAULT NULL,
  `rentDuration` int(11) DEFAULT NULL,
  `holderID` int(11) DEFAULT NULL,
  `holdDate` date DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Inventory`
--

INSERT INTO `Inventory` (`storeID`, `storeName`, `isbn`, `idx`, `privateCallNum`, `bookCondition`, `condDesc`, `quantity`, `salesPrice`, `rentPrice`, `rentDuration`, `holderID`, `holdDate`, `status`) VALUES
(1, '123', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Ledgers`
--

CREATE TABLE `Ledgers` (
  `custID` int(11) NOT NULL DEFAULT '0',
  `storeID` int(11) NOT NULL DEFAULT '0',
  `ledgerNum` int(11) NOT NULL DEFAULT '0',
  `tid` int(11) DEFAULT NULL,
  `custFirstName` varchar(30) DEFAULT NULL,
  `custLastName` varchar(30) DEFAULT NULL,
  `storeName` varchar(50) DEFAULT NULL,
  `ledgerDate` date DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `chargeToCustAmt` float DEFAULT NULL,
  `custPayAmt` float DEFAULT NULL,
  `payMethod` varchar(20) DEFAULT NULL,
  `bal` float DEFAULT NULL,
  `note` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `LibMembers`
--

CREATE TABLE `LibMembers` (
  `custID` int(11) NOT NULL DEFAULT '0',
  `custFirstName` varchar(30) DEFAULT NULL,
  `custLastName` varchar(30) DEFAULT NULL,
  `storeID` int(11) NOT NULL DEFAULT '0',
  `storeName` varchar(100) DEFAULT NULL,
  `joinDate` date DEFAULT NULL,
  `barcode` varchar(20) DEFAULT NULL,
  `pin` varchar(10) DEFAULT NULL,
  `activate` tinyint(1) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `LineItems`
--

CREATE TABLE `LineItems` (
  `tid` int(11) NOT NULL DEFAULT '0',
  `lineNumber` int(11) NOT NULL DEFAULT '0',
  `isbn` varchar(30) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `report` varchar(200) DEFAULT NULL,
  `orderQuantity` int(11) DEFAULT '1',
  `priceAmount` float DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `dueDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Messages`
--

CREATE TABLE `Messages` (
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `msgTime` datetime DEFAULT NULL,
  `subject` varchar(200) DEFAULT NULL,
  `msgText` text,
  `replyTime` datetime DEFAULT NULL,
  `replyText` text,
  `replied` tinyint(1) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Messages`
--

INSERT INTO `Messages` (`name`, `email`, `phone`, `msgTime`, `subject`, `msgText`, `replyTime`, `replyText`, `replied`, `status`) VALUES
('siri', 's_gurram@uncg.edu', '2369807080', '2015-03-17 06:23:10', 'hi', 'heokmofdx', NULL, NULL, NULL, NULL),
('gi', 's_gurram@uncg.edu', '3214569807', '2015-03-16 14:35:13', 'gjj', 'hdbji', NULL, NULL, NULL, NULL),
('gfgj', 'dhhff@gmail.com', '1236980745', '2015-03-17 11:23:39', 'gffhi', 'bffhik', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Organizations`
--

CREATE TABLE `Organizations` (
`organID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `cname` varchar(100) DEFAULT NULL,
  `foundYear` year(4) DEFAULT NULL,
  `type` varchar(30) NOT NULL,
  `keywords` varchar(256) DEFAULT NULL,
  `telephoneNumber` varchar(30) NOT NULL,
  `otherPhone` varchar(30) DEFAULT NULL,
  `addrStNum` varchar(100) NOT NULL,
  `addrL2` varchar(100) DEFAULT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) DEFAULT 'United States',
  `zip` varchar(20) NOT NULL,
  `emailAddress` varchar(100) NOT NULL,
  `website` varchar(100) DEFAULT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `status` varchar(30) DEFAULT NULL,
  `pastor` varchar(50) DEFAULT NULL,
  `cpastor` varchar(50) DEFAULT NULL,
  `contact` varchar(50) DEFAULT NULL,
  `ccontact` varchar(50) DEFAULT NULL,
  `numAdults` int(11) DEFAULT NULL,
  `numKids` int(11) DEFAULT NULL,
  `worshipTime` varchar(50) DEFAULT NULL,
  `sunSchoolTime` varchar(50) DEFAULT NULL,
  `prayerTime` varchar(50) DEFAULT NULL,
  `bibleStudyTime` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `OutItmes`
--

CREATE TABLE `OutItmes` (
  `storeID` int(11) NOT NULL DEFAULT '0',
  `storeName` varchar(100) DEFAULT NULL,
  `custID` int(11) NOT NULL DEFAULT '0',
  `custFirstName` varchar(30) DEFAULT NULL,
  `custLastName` varchar(30) DEFAULT NULL,
  `isbn` varchar(20) NOT NULL DEFAULT '',
  `title` varchar(100) DEFAULT NULL,
  `tid` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `outDate` date DEFAULT NULL,
  `dueDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `StoreAssociations`
--

CREATE TABLE `StoreAssociations` (
  `storeID` int(11) NOT NULL DEFAULT '0',
  `storeName` varchar(100) DEFAULT NULL,
  `motherID` int(11) NOT NULL DEFAULT '0',
  `motherStore` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `StoreAssociations`
--

INSERT INTO `StoreAssociations` (`storeID`, `storeName`, `motherID`, `motherStore`) VALUES
(0, 'UNCG Lib', 0, 'UNCG Bookstore');

-- --------------------------------------------------------

--
-- Table structure for table `StoreReviews`
--

CREATE TABLE `StoreReviews` (
  `storeID` int(11) NOT NULL DEFAULT '0',
  `custID` int(11) NOT NULL DEFAULT '0',
  `reviewTime` datetime NOT NULL,
  `overallStars` float NOT NULL,
  `speed` float DEFAULT NULL,
  `quality` float DEFAULT NULL,
  `revTitle` varchar(200) DEFAULT NULL,
  `comment` text,
  `storeReply` text,
  `helpful` int(11) DEFAULT NULL,
  `noHelp` int(11) DEFAULT NULL,
  `numFbk` int(11) DEFAULT NULL,
  `feedback` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Stores`
--

CREATE TABLE `Stores` (
`storeID` int(11) NOT NULL,
  `insertDate` date DEFAULT NULL,
  `storeName` varchar(100) NOT NULL,
  `altStoreName` varchar(100) DEFAULT NULL,
  `addrStNum` varchar(100) NOT NULL,
  `addrLine2` varchar(100) DEFAULT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `zip` varchar(20) NOT NULL,
  `latitude` float(10,6) DEFAULT NULL,
  `longtitude` float(10,6) DEFAULT NULL,
  `phone` varchar(30) NOT NULL,
  `phone1` varchar(30) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `mgrPasswd` varchar(30) NOT NULL,
  `staffPasswd` varchar(30) DEFAULT NULL,
  `website` varchar(256) DEFAULT NULL,
  `question` tinyint(4) NOT NULL,
  `answer` varchar(50) NOT NULL,
  `mgrName` varchar(50) DEFAULT NULL,
  `mgrPhone` varchar(30) DEFAULT NULL,
  `mgrEmail` varchar(100) DEFAULT NULL,
  `storeType` varchar(30) NOT NULL,
  `keywords` varchar(256) DEFAULT NULL,
  `openHour` varchar(256) DEFAULT NULL,
  `services` varchar(100) NOT NULL,
  `dueRent` tinyint(4) DEFAULT NULL,
  `dueLent` tinyint(4) DEFAULT NULL,
  `lentLimit` tinyint(4) DEFAULT NULL,
  `graceLend` tinyint(4) DEFAULT NULL,
  `graceRent` tinyint(4) DEFAULT NULL,
  `dueHold` tinyint(4) DEFAULT NULL,
  `selfCheckout` tinyint(1) DEFAULT NULL,
  `maxRenew` tinyint(4) DEFAULT NULL,
  `fineRateLend` float DEFAULT NULL,
  `fineRateRent` float DEFAULT NULL,
  `maxFine` float DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Stores`
--

INSERT INTO `Stores` (`storeID`, `insertDate`, `storeName`, `altStoreName`, `addrStNum`, `addrLine2`, `city`, `state`, `zip`, `latitude`, `longtitude`, `phone`, `phone1`, `email`, `mgrPasswd`, `staffPasswd`, `website`, `question`, `answer`, `mgrName`, `mgrPhone`, `mgrEmail`, `storeType`, `keywords`, `openHour`, `services`, `dueRent`, `dueLent`, `lentLimit`, `graceLend`, `graceRent`, `dueHold`, `selfCheckout`, `maxRenew`, `fineRateLend`, `fineRateRent`, `maxFine`) VALUES
(1, '2014-12-01', 'UNCG Bookstore', NULL, '1000 spring Garden Street', NULL, 'Greensboro', 'NC', '27402', 36.063061, -79.806839, '336-123-4567', NULL, 'xyz@test.com', '12345', '6789', NULL, 2, 'yes', NULL, NULL, NULL, 'bookstore', NULL, NULL, 'sell, rent, return', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, '2014-12-01', 'UNCG Lib', NULL, '1000 spring Garden Street', NULL, 'Greensboro', 'NC', '27402', 36.066010, -79.816811, '336-123-0000', NULL, 'abc@test.com', '12345', '6789', NULL, 2, 'yes', NULL, NULL, NULL, '', NULL, NULL, 'sell, rent, return', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, '2015-03-10', 'UNC LIBRARY 	', NULL, '6789 jhgiik', NULL, 'Raleigh', 'NC', '27560', 0.000000, 0.000000, '', NULL, '', '', NULL, NULL, 0, '', NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Transactions`
--

CREATE TABLE `Transactions` (
`tid` int(11) NOT NULL,
  `storeID` int(11) DEFAULT NULL,
  `storeName` varchar(100) DEFAULT NULL,
  `custID` int(11) DEFAULT NULL,
  `custFirstName` varchar(30) DEFAULT NULL,
  `custLastName` varchar(30) DEFAULT NULL,
  `transTime` datetime NOT NULL,
  `numberOfLines` int(11) DEFAULT NULL,
  `unitsOrdered` int(11) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `type` varchar(30) DEFAULT NULL,
  `subTot` float DEFAULT NULL,
  `taxRatePercent` float DEFAULT NULL,
  `taxAmount` float DEFAULT NULL,
  `discountPercentage` float DEFAULT NULL,
  `shipFee` float DEFAULT NULL,
  `totPrice` float DEFAULT NULL,
  `receiverName` varchar(100) DEFAULT NULL,
  `shippingAddr` varchar(256) DEFAULT NULL,
  `shipMethod` varchar(100) DEFAULT NULL,
  `deliveryTimeCode` varchar(50) DEFAULT NULL,
  `carrierName` varchar(100) DEFAULT NULL,
  `deliveryNotes` varchar(300) DEFAULT NULL,
  `orderStatus` varchar(30) DEFAULT NULL,
  `msgToCust` text,
  `msgToStore` text,
  `agentName` varchar(100) DEFAULT NULL,
  `notes` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ActiveOrders`
--
ALTER TABLE `ActiveOrders`
 ADD PRIMARY KEY (`tid`);

--
-- Indexes for table `Admins`
--
ALTER TABLE `Admins`
 ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `BookReviews`
--
ALTER TABLE `BookReviews`
 ADD PRIMARY KEY (`isbn`,`custID`,`reviewTime`);

--
-- Indexes for table `Books`
--
ALTER TABLE `Books`
 ADD PRIMARY KEY (`isbn`);

--
-- Indexes for table `Branches`
--
ALTER TABLE `Branches`
 ADD PRIMARY KEY (`organID`,`branchID`);

--
-- Indexes for table `Customers`
--
ALTER TABLE `Customers`
 ADD PRIMARY KEY (`custID`);

--
-- Indexes for table `CustReviews`
--
ALTER TABLE `CustReviews`
 ADD PRIMARY KEY (`storeID`,`custID`,`reviewTime`);

--
-- Indexes for table `Inventory`
--
ALTER TABLE `Inventory`
 ADD PRIMARY KEY (`storeID`,`isbn`,`idx`);

--
-- Indexes for table `Ledgers`
--
ALTER TABLE `Ledgers`
 ADD PRIMARY KEY (`custID`,`storeID`,`ledgerNum`);

--
-- Indexes for table `LibMembers`
--
ALTER TABLE `LibMembers`
 ADD PRIMARY KEY (`custID`,`storeID`);

--
-- Indexes for table `LineItems`
--
ALTER TABLE `LineItems`
 ADD PRIMARY KEY (`tid`,`lineNumber`);

--
-- Indexes for table `Organizations`
--
ALTER TABLE `Organizations`
 ADD PRIMARY KEY (`organID`);

--
-- Indexes for table `OutItmes`
--
ALTER TABLE `OutItmes`
 ADD PRIMARY KEY (`storeID`,`custID`,`isbn`);

--
-- Indexes for table `StoreAssociations`
--
ALTER TABLE `StoreAssociations`
 ADD PRIMARY KEY (`storeID`,`motherID`);

--
-- Indexes for table `StoreReviews`
--
ALTER TABLE `StoreReviews`
 ADD PRIMARY KEY (`storeID`,`custID`,`reviewTime`);

--
-- Indexes for table `Stores`
--
ALTER TABLE `Stores`
 ADD PRIMARY KEY (`storeID`);

--
-- Indexes for table `Transactions`
--
ALTER TABLE `Transactions`
 ADD PRIMARY KEY (`tid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ActiveOrders`
--
ALTER TABLE `ActiveOrders`
MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Admins`
--
ALTER TABLE `Admins`
MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Customers`
--
ALTER TABLE `Customers`
MODIFY `custID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Organizations`
--
ALTER TABLE `Organizations`
MODIFY `organID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Stores`
--
ALTER TABLE `Stores`
MODIFY `storeID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `Transactions`
--
ALTER TABLE `Transactions`
MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT;