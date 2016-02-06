-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 13, 2015 at 07:49 PM
-- Server version: 5.5.42-cll
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gcmrwnvc_bookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `activeorders`
--

CREATE TABLE IF NOT EXISTS `activeorders` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `storeID` int(11) DEFAULT NULL,
  `storeName` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `custID` int(11) DEFAULT NULL,
  `custFirstName` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `custLastName` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `transTime` datetime NOT NULL,
  `numberOfLines` int(11) DEFAULT NULL,
  `unitsOrdered` int(11) DEFAULT NULL,
  `title` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
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
  `deliveryNotes` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `orderStatus` varchar(30) DEFAULT NULL,
  `msgToCust` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `msgToStore` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `agentName` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `notes` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `adminledger`
--

CREATE TABLE IF NOT EXISTS `adminledger` (
  `custID` int(11) DEFAULT NULL,
  `custName` varchar(100) DEFAULT NULL,
  `storeID` int(11) DEFAULT NULL,
  `storeName` varchar(100) DEFAULT NULL,
  `ledgerNum` int(11) DEFAULT NULL,
  `tid` bigint(20) DEFAULT NULL,
  `ledgerDate` datetime DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `income` float DEFAULT NULL,
  `inMethod` varchar(20) DEFAULT NULL,
  `inNote` varchar(200) DEFAULT NULL,
  `expense` float DEFAULT NULL,
  `exMethod` varchar(20) DEFAULT NULL,
  `exNote` varchar(200) DEFAULT NULL,
  `note` varchar(200) DEFAULT NULL,
  `balance` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `adminID` int(11) NOT NULL AUTO_INCREMENT,
  `insertDate` date NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `otherPhone` varchar(30) DEFAULT NULL,
  `mailAddr` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(30) NOT NULL,
  `question` tinyint(4) NOT NULL,
  `answer` varchar(50) NOT NULL,
  PRIMARY KEY (`adminID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bookreviews`
--

CREATE TABLE IF NOT EXISTS `bookreviews` (
  `isbn` varchar(20) NOT NULL DEFAULT '',
  `bookTitle` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custID` int(11) NOT NULL DEFAULT '0',
  `custFirstName` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `custLastName` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `reviewTime` datetime NOT NULL,
  `overallStars` float NOT NULL,
  `revTitle` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `comment` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `helpful` int(11) DEFAULT NULL,
  `noHelp` int(11) DEFAULT NULL,
  `numFbk` int(11) DEFAULT NULL,
  `feedback` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`isbn`,`custID`,`reviewTime`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE IF NOT EXISTS `books` (
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
  `keywords` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `description` text CHARACTER SET utf8,
  `contents` text CHARACTER SET utf8,
  `fromBackCover` text CHARACTER SET utf8,
  `productFormatDetail` varchar(100) DEFAULT NULL,
  `productDimensions` varchar(200) DEFAULT NULL,
  `shippingWeight` float DEFAULT NULL,
  `pages` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`isbn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`isbn`, `isbn10`, `insertDate`, `callNum`, `title`, `subTitle`, `altTitle`, `author`, `translator`, `audience`, `language`, `editionType`, `edtionNumber`, `amzonStar`, `amazonReviews`, `amazonRevLink`, `category`, `subCat`, `subSubCat`, `altCat`, `altSubCat`, `altSubSubCat`, `publisherName`, `pubDate`, `keywords`, `description`, `contents`, `fromBackCover`, `productFormatDetail`, `productDimensions`, `shippingWeight`, `pages`) VALUES
('0486121178', NULL, '2015-09-10', 'BR 138 .T27', 'In a Dry Season', NULL, NULL, 'Peter Robinson', NULL, NULL, 'English', 'First edition', 1, 3, 0, NULL, 'Science', 'Trigonometry', 'Properties', NULL, NULL, NULL, 'Science inspiration', '2015-03-12', NULL, 'This Book provides sufficiently strong base to our students for the purpose of Public Examinations, All Engineering Entrance and National Entrance Exams like NEET, JEE etc. ', NULL, NULL, NULL, NULL, NULL, 500),
('0486121179', NULL, '2015-09-10', 'BR 138 .T27', 'In a Dry Season1', NULL, NULL, 'Peter Robinson', NULL, NULL, 'English', 'First edition', 1, 3, 0, NULL, 'Science', 'Trigonometry', 'Properties', NULL, NULL, NULL, 'Science inspiration', '2015-03-12', NULL, 'This Book provides sufficiently strong base to our students for the purpose of Public Examinations, All Engineering Entrance and National Entrance Exams like NEET, JEE etc. ', NULL, NULL, NULL, NULL, NULL, 500),
('0486474172', NULL, '2013-09-09', 'BR 145 .L85', 'Alien Corn (play)', NULL, NULL, 'Sidney Howard', NULL, NULL, 'English', 'Second edition', 2, 4.5, 0, NULL, 'Mathematics', 'Trigonometry', 'Abstract Algebra', NULL, NULL, NULL, 'Dover Publications', '2010-01-14', NULL, 'Accessible but rigorous, this outstanding text encompasses all of the topics covered by a typical course in elementary abstract algebra. Its easy-to-read treatment offers an intuitive approach, featuring informal discussions followed by thematically arranged exercises.', NULL, NULL, NULL, NULL, NULL, 400),
('0486474178', NULL, '2013-09-09', 'BR 145 .L85', 'Alien Corn (play)', NULL, NULL, 'Sidney Howard', NULL, NULL, 'English', 'Second edition', 2, 4.5, 0, NULL, 'Mathematics', 'Algebra', 'Abstract Algebra', NULL, NULL, NULL, 'Dover Publications', '2010-01-14', NULL, 'Accessible but rigorous, this outstanding text encompasses all of the topics covered by a typical course in elementary abstract algebra. Its easy-to-read treatment offers an intuitive approach, featuring informal discussions followed by thematically arranged exercises.', NULL, NULL, NULL, NULL, NULL, 400),
('0785287971', NULL, '2015-09-02', 'BR 120 .M27', 'All Passion Spent', NULL, NULL, 'Vita Sackville-West', NULL, NULL, 'English', 'First edition', 1, 5, 0, NULL, 'Business', 'Management', 'Biblical Principles for the Workplace', NULL, NULL, NULL, 'Thomas Nelson', '2005-12-25', NULL, 'Business by the Book is a step-by-step presentation of how businesses should be run according to the Creator of all management rules: God', NULL, NULL, NULL, NULL, NULL, 250),
('0785287973', NULL, '2015-09-02', 'BR 120 .M27', 'All Passion Spent', NULL, NULL, 'Vita Sackville-West', NULL, NULL, 'English', 'First edition', 1, 5, 0, NULL, 'Business', 'Biblical Principles', 'Biblical Principles for the Workplace', NULL, NULL, NULL, 'Thomas Nelson', '2005-12-25', NULL, 'Business by the Book is a step-by-step presentation of how businesses should be run according to the Creator of all management rules: God', NULL, NULL, NULL, NULL, NULL, 250),
('0785688670', NULL, '2015-09-01', 'BR 100 .T25', 'All the Kings Men', NULL, NULL, 'Robert Penn Warren', NULL, NULL, 'English', 'First edition', 1, 4.5, 0, NULL, 'Reasoning', 'Digit', 'Tax savings tips', NULL, NULL, NULL, 'Thomas Nelson', '2013-06-11', NULL, 'Tired of paying so much tax to the IRS? You are not alone! Small business owners and self-employed people are overpaying their taxes by millions of dollars every year. “Small Business Tax Deductions Revealed” provides the tax reduction strategies you need to substantially lower your taxes. Read this book to discover “29 Tax-Saving Tips You Wish You Knew”. These tax tips are perfectly legal self-employed tax deductions that you can use without any fear of the IRS.', NULL, NULL, NULL, NULL, NULL, 300),
('0785688673', NULL, '2015-09-01', 'BR 100 .T25', 'All the Kings Men', NULL, NULL, 'Robert Penn Warren', NULL, NULL, 'English', 'First edition', 1, 4.5, 0, NULL, 'Reasoning', 'Tax', 'Tax savings tips', NULL, NULL, NULL, 'Thomas Nelson', '2013-06-11', NULL, 'Tired of paying so much tax to the IRS? You are not alone! Small business owners and self-employed people are overpaying their taxes by millions of dollars every year. “Small Business Tax Deductions Revealed” provides the tax reduction strategies you need to substantially lower your taxes. Read this book to discover “29 Tax-Saving Tips You Wish You Knew”. These tax tips are perfectly legal self-employed tax deductions that you can use without any fear of the IRS.', NULL, NULL, NULL, NULL, NULL, 300),
('0848736571', NULL, '2014-02-08', 'BR 105 L88', 'Antic Hay', NULL, NULL, 'John k.', NULL, NULL, 'English', 'first edition', 2, 3, 0, NULL, 'Cooking', 'Junior Cooking', 'appetizers and beverages', NULL, NULL, NULL, 'Oxmoor House', '2012-09-25', NULL, 'For delicious make-ahead meals, nothing beats a crock-pot. Cooking Light® Slow Cooker Tonight! is your perfect source for recipes that transform simple ingredients into filling, flavorful dishes. ', NULL, NULL, NULL, NULL, NULL, 100),
('0848736575', NULL, '2014-02-08', 'BR 105 L80', 'Antic Hay', NULL, NULL, 'John k.', NULL, NULL, 'English', 'second edition', 2, 3, 0, NULL, 'Cooking', 'Delicious', 'appetizers and beverages', NULL, NULL, NULL, 'Oxmoor House', '2012-09-25', NULL, 'For delicious make-ahead meals, nothing beats a crock-pot. Cooking Light® Slow Cooker Tonight! is your perfect source for recipes that transform simple ingredients into filling, flavorful dishes. ', NULL, NULL, NULL, NULL, NULL, 100);

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE IF NOT EXISTS `branches` (
  `organID` int(11) DEFAULT NULL,
  `branchID` int(11) NOT NULL AUTO_INCREMENT,
  `insertDate` date NOT NULL,
  `organName` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `bname` varchar(100) CHARACTER SET utf8 NOT NULL,
  `cbname` varchar(100) DEFAULT NULL,
  `description` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `contact` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `ccontact` varchar(50) DEFAULT NULL,
  `telephoneNumber` varchar(30) NOT NULL,
  `otherPhone` varchar(30) DEFAULT NULL,
  `address` varchar(300) DEFAULT NULL,
  `emailAddress` varchar(100) NOT NULL,
  `meetingName` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `meetingTime` varchar(50) DEFAULT NULL,
  `meetingDesc` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`branchID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `custID` int(11) NOT NULL AUTO_INCREMENT,
  `insertDate` date NOT NULL,
  `firstName` varchar(30) CHARACTER SET utf8 NOT NULL,
  `middleName` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `lastName` varchar(30) CHARACTER SET utf8 NOT NULL,
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
  `deals` tinyint(1) DEFAULT NULL,
  `numOverdue` int(11) DEFAULT NULL,
  `numAbuse` int(11) DEFAULT NULL,
  `numLost` int(11) DEFAULT NULL,
  `numFines` int(11) DEFAULT NULL,
  `amtFine` float DEFAULT NULL,
  PRIMARY KEY (`custID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`custID`, `insertDate`, `firstName`, `middleName`, `lastName`, `altName`, `telephoneNumber`, `otherPhone`, `addrStNum`, `addrL2`, `city`, `state`, `zip`, `latitude`, `longtitude`, `emailAddress`, `password`, `cardNumber`, `cardType`, `cardName`, `cardExp`, `cardCode`, `billingAddr`, `paypalNum`, `homeLib`, `notify`, `deals`, `numOverdue`, `numAbuse`, `numLost`, `numFines`, `amtFine`) VALUES
(30, '0000-00-00', 'jaydeep', 'r', 'kakadiya', NULL, '9722575820', '4565558552', '300 bhavani circle', '', 'Los Angeles', 'CA - California', '27402', NULL, NULL, 'kakadiyajaydeepjk@gmail.com', '81', '5656565655', 'VISA', 'sirisha', '0000-00-00', '123', '3456gyhuji', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, '0000-00-00', 'maulik', 'k', 'vora', NULL, '8866292528', '3362561137', '167 sector-15', '', 'Seattle', 'CA - California', '27402', NULL, NULL, 'patelpateljaydeepjk@gmail.com', '13', '', 'VISA', '', '0000-00-00', '', '', NULL, 'vid library', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, '0000-00-00', 'gopal', 'h', 'hingu', NULL, '8000772376', '', '123  hill road', '', 'tampa', 'FL - Florida', '90013', NULL, NULL, 'sorathiya@gmail.com', '123', '', 'Amex', '', '0000-00-00', '', '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, '0000-00-00', 'amit', 'r', 'kakadiya', NULL, '9722575820', '4565558552', '300 bhavani circle', '', 'cary', 'NC - North Carolina', '90039', NULL, NULL, 'kakadiya@gmail.com', '123', '5656565655', 'VISA', 'sirisha', '0000-00-00', '123', '3456gyhuji', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, '0000-00-00', 'ankur', 'k', 'vora', NULL, '8866292528', '3362561137', '167 sector-15', '', 'Greensboro', 'NC - North Carolina', '90039', NULL, NULL, 'gopalhingu123@gmail.com', 'KieL9o,F', '', 'VISA', '', '0000-00-00', '', '', NULL, 'vid library', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, '0000-00-00', 'paresh', 'h', 'hingu', NULL, '8000772376', '', '123  hill road', '', 'Greensboro', 'NC - North Carolina', '90039', NULL, NULL, 'sorathiya@gmail.com', '123', '', 'Amex', '', '0000-00-00', '', '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(36, '0000-00-00', 'vora', NULL, 'maulik', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'maulikvora.ws@gmail.com', '12345', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(37, '0000-00-00', 'pintu', NULL, 'vasani', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'p@gmail.com', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `custreviews`
--

CREATE TABLE IF NOT EXISTS `custreviews` (
  `storeID` int(11) NOT NULL DEFAULT '0',
  `storeName` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `custID` int(11) NOT NULL DEFAULT '0',
  `custFirstName` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `custLastName` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `reviewTime` datetime NOT NULL,
  `overallStars` float NOT NULL,
  `revTitle` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `comment` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `custReply` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `helpful` int(11) DEFAULT NULL,
  `noHelp` int(11) DEFAULT NULL,
  `numFbk` int(11) DEFAULT NULL,
  `feedback` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `numOverdue` int(11) DEFAULT NULL,
  `numAbuse` int(11) DEFAULT NULL,
  `numLost` int(11) DEFAULT NULL,
  `numFines` int(11) DEFAULT NULL,
  `amtFine` float DEFAULT NULL,
  PRIMARY KEY (`storeID`,`custID`,`reviewTime`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `directory`
--

CREATE TABLE IF NOT EXISTS `directory` (
  `organID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `cname` varchar(256) DEFAULT NULL,
  `foundYear` year(4) DEFAULT NULL,
  `type` varchar(30) NOT NULL,
  `keywords` varchar(256) DEFAULT NULL,
  `telephoneNumber` varchar(30) NOT NULL,
  `otherPhone` varchar(30) DEFAULT NULL,
  `addrStNum` varchar(256) NOT NULL,
  `addrL2` varchar(100) DEFAULT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) DEFAULT 'United States',
  `zip` varchar(20) NOT NULL,
  `emailAddress` varchar(100) NOT NULL,
  `website` varchar(200) DEFAULT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `status` varchar(30) DEFAULT NULL,
  `pastor` varchar(100) DEFAULT NULL,
  `cpastor` varchar(100) DEFAULT NULL,
  `contact` varchar(100) DEFAULT NULL,
  `ccontact` varchar(100) DEFAULT NULL,
  `numAdults` int(11) DEFAULT NULL,
  `numKids` int(11) DEFAULT NULL,
  `worshipTime` varchar(100) DEFAULT NULL,
  `prayerTime` varchar(100) DEFAULT NULL,
  `bibleStudyTime` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`organID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE IF NOT EXISTS `inventory` (
  `storeID` int(11) NOT NULL DEFAULT '0',
  `storeName` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `isbn` varchar(20) NOT NULL DEFAULT '',
  `idx` tinyint(4) NOT NULL DEFAULT '0',
  `title` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `privateCallNum` varchar(20) DEFAULT NULL,
  `bookCondition` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `condDesc` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `salesPrice` float DEFAULT NULL,
  `rentPrice` float DEFAULT NULL,
  `rentDuration` int(11) DEFAULT NULL,
  `holderID` int(11) DEFAULT NULL,
  `holdDate` date DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`storeID`,`isbn`,`idx`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`storeID`, `storeName`, `isbn`, `idx`, `title`, `privateCallNum`, `bookCondition`, `condDesc`, `quantity`, `salesPrice`, `rentPrice`, `rentDuration`, `holderID`, `holdDate`, `status`) VALUES
(5, 'UNCG Bookstore', '0486121178 ', 0, NULL, NULL, 'new', 'good', 0, 0, 0, 15, NULL, NULL, NULL),
(6, 'Scuppernong Books', '0486121179', 0, NULL, NULL, 'new', 'good', 0, 0, 0, 15, NULL, NULL, NULL),
(7, 'The Last Bookstore', '0486474172', 0, NULL, NULL, 'new', 'good', 5, 50, 30, 20, NULL, NULL, NULL),
(8, 'Skylight Books', '0486474178', 0, NULL, NULL, 'new', 'good', 0, 0, 0, 15, NULL, NULL, NULL),
(9, 'The Library Store', '0785287971', 0, NULL, NULL, 'new', 'good', NULL, NULL, NULL, 15, NULL, NULL, NULL),
(10, 'Silver Lake Library', '0785287973', 0, NULL, NULL, 'old', 'good', NULL, NULL, NULL, 20, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ledgers`
--

CREATE TABLE IF NOT EXISTS `ledgers` (
  `custID` int(11) NOT NULL DEFAULT '0',
  `storeID` int(11) NOT NULL DEFAULT '0',
  `ledgerNum` int(11) NOT NULL DEFAULT '0',
  `tid` int(11) DEFAULT NULL,
  `custFirstName` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `custLastName` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `storeName` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `ledgerDate` date DEFAULT NULL,
  `description` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `chargeToCustAmt` float DEFAULT NULL,
  `custPayAmt` float DEFAULT NULL,
  `payMethod` varchar(20) DEFAULT NULL,
  `bal` float DEFAULT NULL,
  `note` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`custID`,`storeID`,`ledgerNum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `libmembers`
--

CREATE TABLE IF NOT EXISTS `libmembers` (
  `custID` int(11) NOT NULL DEFAULT '0',
  `custFirstName` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `custLastName` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `storeID` int(11) NOT NULL DEFAULT '0',
  `storeName` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `joinDate` date DEFAULT NULL,
  `barcode` varchar(20) DEFAULT NULL,
  `pin` varchar(10) DEFAULT NULL,
  `activate` tinyint(1) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`custID`,`storeID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lineitems`
--

CREATE TABLE IF NOT EXISTS `lineitems` (
  `tid` int(11) NOT NULL DEFAULT '0',
  `lineNumber` int(11) NOT NULL DEFAULT '0',
  `isbn` varchar(30) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `description` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `report` varchar(200) DEFAULT NULL,
  `orderQuantity` int(11) DEFAULT '1',
  `priceAmount` float DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `dueDate` date DEFAULT NULL,
  PRIMARY KEY (`tid`,`lineNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `msgID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `msgTime` datetime DEFAULT NULL,
  `subject` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `msgText` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `replyTime` datetime DEFAULT NULL,
  `replyText` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `replied` tinyint(1) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`msgID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE IF NOT EXISTS `organizations` (
  `organID` int(11) NOT NULL AUTO_INCREMENT,
  `insertDate` datetime NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `cname` varchar(100) DEFAULT NULL,
  `foundYear` year(4) DEFAULT NULL,
  `type` varchar(30) CHARACTER SET utf8 NOT NULL,
  `keywords` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
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
  `pastor` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `cpastor` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `contact` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `ccontact` varchar(50) DEFAULT NULL,
  `numAdults` int(11) DEFAULT NULL,
  `numKids` int(11) DEFAULT NULL,
  `worshipTime` varchar(50) DEFAULT NULL,
  `sunSchoolTime` varchar(50) DEFAULT NULL,
  `prayerTime` varchar(50) DEFAULT NULL,
  `bibleStudyTime` varchar(50) DEFAULT NULL,
  `meetingName` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  `meetingTime` varchar(50) DEFAULT NULL,
  `meetingName1` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  `meetingTime1` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`organID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `outitmes`
--

CREATE TABLE IF NOT EXISTS `outitmes` (
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
  `dueDate` date DEFAULT NULL,
  PRIMARY KEY (`storeID`,`custID`,`isbn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `outitmes`
--

INSERT INTO `outitmes` (`storeID`, `storeName`, `custID`, `custFirstName`, `custLastName`, `isbn`, `title`, `tid`, `quantity`, `type`, `outDate`, `dueDate`) VALUES
(1, 'UNCG Bookstore', 1, 'siri', 'g', '1234567891', 'Introduction to Algorithm Analysis', 27, 1, 'rent', '2015-04-13', NULL),
(1, 'UNCG Bookstore', 2, 'Lixin', 'Fu', '1428365762', 'Property Samba', 42, 1, 'borrow', '2015-04-13', NULL),
(1, 'UNCG Bookstore', 2, 'Lixin', 'Fu', '6054860445', 'Xml Databases', 39, 1, 'rent', '2015-04-13', NULL),
(1, 'UNCG Bookstore', 2, 'Lixin', 'Fu', '794867409485', 'Databases', 40, 1, 'rent', '2015-04-13', NULL),
(1, 'UNCG Bookstore', 2, 'Lixin', 'Fu', '8586474939', 'Advanced databases', 41, 1, 'rent', '2015-04-13', NULL),
(4, 'Scuppernong Books', 1, 'siri', 'g', '0848736575', 'Cooking Light Slow-Cooker Tonight!', 1, NULL, 'rent', '2015-02-11', '2015-04-16');

-- --------------------------------------------------------

--
-- Table structure for table `procurelineitems`
--

CREATE TABLE IF NOT EXISTS `procurelineitems` (
  `PID` int(11) NOT NULL DEFAULT '0',
  `LineNum` int(11) NOT NULL DEFAULT '0',
  `isbn` varchar(30) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `description` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `Quantity` int(11) DEFAULT '1',
  `price` float DEFAULT NULL,
  PRIMARY KEY (`PID`,`LineNum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `procures`
--

CREATE TABLE IF NOT EXISTS `procures` (
  `PID` int(11) NOT NULL AUTO_INCREMENT,
  `StoreName` varchar(30) CHARACTER SET utf8 NOT NULL,
  `SupplierName` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `ProcureTime` datetime NOT NULL,
  `NumberOfLines` int(11) DEFAULT NULL,
  `TotalPrice` float DEFAULT NULL,
  `UnitsProcured` int(11) DEFAULT NULL,
  `AgentName` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `Title` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`PID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `storeassociations`
--

CREATE TABLE IF NOT EXISTS `storeassociations` (
  `storeID` int(11) NOT NULL DEFAULT '0',
  `storeName` varchar(100) DEFAULT NULL,
  `motherID` int(11) NOT NULL DEFAULT '0',
  `motherStore` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`storeID`,`motherID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `storereviews`
--

CREATE TABLE IF NOT EXISTS `storereviews` (
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
  `feedback` text,
  PRIMARY KEY (`storeID`,`custID`,`reviewTime`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE IF NOT EXISTS `stores` (
  `storeID` int(11) NOT NULL AUTO_INCREMENT,
  `insertDate` date DEFAULT NULL,
  `storeName` varchar(100) CHARACTER SET utf8 NOT NULL,
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
  `maxFine` float DEFAULT NULL,
  `isbnCnt` int(11) DEFAULT NULL,
  PRIMARY KEY (`storeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`storeID`, `insertDate`, `storeName`, `altStoreName`, `addrStNum`, `addrLine2`, `city`, `state`, `zip`, `latitude`, `longtitude`, `phone`, `phone1`, `email`, `mgrPasswd`, `staffPasswd`, `website`, `question`, `answer`, `mgrName`, `mgrPhone`, `mgrEmail`, `storeType`, `keywords`, `openHour`, `services`, `dueRent`, `dueLent`, `lentLimit`, `graceLend`, `graceRent`, `dueHold`, `selfCheckout`, `maxRenew`, `fineRateLend`, `fineRateRent`, `maxFine`, `isbnCnt`) VALUES
(5, '2014-12-01', 'UNCG Bookstore', NULL, '100 ldrp college', NULL, 'Los Angeles', 'CA - California', '27402', 36.063061, -79.806839, '(02841) 244031', NULL, 'kakadiya@gmail.com', '12345', '6789', 'google.com', 2, 'yes', NULL, NULL, NULL, 'bookstore', NULL, '9:00 am - 9:00 pm', 'sell, rent, return', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, '2014-12-01', 'Scuppernong Books', NULL, '304 S Elm St', NULL, 'Seattle', 'CA - California', '27402', 36.063061, -79.806839, '(02841) 244031', NULL, 'kakadiya@gmail.com', '12345', '6789', 'google.com', 2, 'yes', NULL, NULL, NULL, 'bookstore', NULL, '9:00 am - 9:00 pm', 'sell, rent, return', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, '2014-12-01', 'The Last Bookstore', NULL, '453 S Spring St', NULL, 'tampa', 'FL - Florida', '90013', 36.066010, -79.816811, '336-123-0000', NULL, 'sorathiya@gmail.com', '12345', '6789', 'google.com', 2, 'yes', NULL, NULL, NULL, 'bookstore', NULL, '8:00 am - 9:00 pm', 'sell, rent, return', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, '2014-12-16', 'Skylight Books', NULL, '1000 spring Garden Street', NULL, 'cary', 'NC - North Carolina', '90039', 36.069958, -79.790825, '(336) 763-1919', NULL, 'sorathiya@gmail.com', '14562', '86952', 'google.com', 0, '', NULL, NULL, NULL, 'bookstore', NULL, '10:00 am - 9:00 pm', 'buy', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, '2015-01-19', 'The Library Store', NULL, '630 W 5th St', NULL, 'Greensboro', 'NC - North Carolina', '90039', 34.047764, -118.249512, '(213) 488-0599', NULL, 'sorathiya@gmail.com', '12305', '86952', 'goole.com', 0, '', NULL, NULL, NULL, 'bookstore', NULL, '10:00 am - 10:00 pm', 'buy,rent', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, '2015-01-19', 'Silver Lake Library', NULL, '1818 N Vermont Ave', NULL, 'Greensboro', 'NC - North Carolina', '90039', 34.047764, -118.249512, '(213) 488-0599', NULL, 'sorathiya@gmail.com', '12305', '86952', 'goole.com', 0, '', NULL, NULL, NULL, 'bookstore', NULL, '10:00 am - 10:00 pm', 'buy,rent', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `storeID` int(11) DEFAULT NULL,
  `storeName` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `custID` int(11) DEFAULT NULL,
  `custFirstName` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `custLastName` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `transTime` datetime NOT NULL,
  `numberOfLines` int(11) DEFAULT NULL,
  `unitsOrdered` int(11) DEFAULT NULL,
  `title` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
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
  `deliveryNotes` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `orderStatus` varchar(30) DEFAULT NULL,
  `msgToCust` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `msgToStore` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `agentName` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `notes` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
