-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2015 at 05:03 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `accNum` int(11) NOT NULL,
  `storeID` int(11) DEFAULT NULL,
  `custID` int(11) DEFAULT NULL,
  `bal` float DEFAULT NULL,
  PRIMARY KEY (`accNum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`accNum`, `storeID`, `custID`, `bal`) VALUES
(1, 1, 1, 12),
(2, 1, 2, 115),
(3, 25, 3, 0),
(4, 1, 3, 0),
(5, 1, 12, 0),
(6, 25, 13, 13),
(7, 25, 14, -25);

-- --------------------------------------------------------

--
-- Table structure for table `activeorders`
--

CREATE TABLE IF NOT EXISTS `activeorders` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
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
  `notes` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=122 ;

--
-- Dumping data for table `activeorders`
--

INSERT INTO `activeorders` (`tid`, `storeID`, `storeName`, `custID`, `custFirstName`, `custLastName`, `transTime`, `numberOfLines`, `unitsOrdered`, `title`, `type`, `subTot`, `taxRatePercent`, `taxAmount`, `discountPercentage`, `shipFee`, `totPrice`, `receiverName`, `shippingAddr`, `shipMethod`, `deliveryTimeCode`, `carrierName`, `deliveryNotes`, `orderStatus`, `msgToCust`, `msgToStore`, `agentName`, `notes`) VALUES
(1, 1, 'UNCG Bookstore', 3, 'sri', 'kod', '2014-11-23 09:20:30', 1, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'ordered', NULL, NULL, NULL, NULL),
(27, NULL, 'UNCG Bookstore', 1, NULL, NULL, '2015-04-13 10:55:17', NULL, 1, 'Introduction to Algorithm Analysis', 'rent', NULL, NULL, NULL, NULL, NULL, 67, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 1, 'UNCG Bookstore', 1, NULL, NULL, '2015-04-13 10:57:54', NULL, 1, 'Cooking Light Slow-Cooker Tonight!', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(43, NULL, 'UNCG Bookstore', 1, NULL, NULL, '2015-04-13 20:10:08', NULL, 1, '25 Winter Craft Ideas', 'rent', NULL, NULL, NULL, NULL, NULL, 78.5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(44, NULL, 'UNCG Bookstore', 1, NULL, NULL, '2015-04-13 20:10:09', NULL, 1, '25 Winter Craft Ideas', 'sale', NULL, NULL, NULL, NULL, NULL, 116.5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(45, NULL, 'UNCG Bookstore', 9, NULL, NULL, '2015-04-14 08:46:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(48, NULL, 'UNCG Bookstore', 9, NULL, NULL, '2015-04-14 09:28:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '\nuyyusg to store\n\ne\nnewmsg to store\ngfhikvfchjre', NULL, NULL),
(49, NULL, 'UNCG Bookstore', 9, NULL, NULL, '2015-04-14 10:30:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(50, NULL, 'UNCG Bookstore', 9, NULL, NULL, '2015-04-14 10:30:22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(51, 1, 'UNCG Bookstore', 3, 'sri', 'kod', '2015-03-23 09:50:00', 1, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'ordered', NULL, NULL, NULL, NULL),
(52, 7, 'The Library Store', 3, 'sri', 'kod', '2015-03-30 08:23:23', 1, NULL, NULL, NULL, 55, 0, 0, NULL, 12, 59, 'vij', '123 chapel hill road , Raleigh, NC, 27604', 'fedex-12.00', NULL, 'fedex', '', 'ordered', NULL, NULL, NULL, NULL),
(53, 1, 'UNCG Bookstore', 3, 'sri', 'kod', '2015-02-14 01:50:00', 1, NULL, NULL, NULL, 50, 0, 0, NULL, NULL, 50, NULL, NULL, NULL, NULL, NULL, NULL, 'ordered', NULL, NULL, NULL, NULL),
(54, 1, 'UNCG Bookstore', 3, 'sri', 'kod', '2015-01-30 04:50:23', 1, NULL, NULL, NULL, 50, 0, 0, NULL, NULL, 50, NULL, NULL, NULL, NULL, NULL, NULL, 'ordered', NULL, NULL, NULL, NULL),
(56, 1, 'UNCG Bookstore', 3, 'sri', 'kod', '2015-03-12 07:50:12', 1, NULL, NULL, NULL, 50, 0, 0, NULL, NULL, 50, NULL, NULL, NULL, NULL, NULL, NULL, 'ordered', NULL, NULL, NULL, NULL),
(57, 1, 'UNCG Bookstore', 3, 'sri', 'kod', '2015-02-18 02:50:45', 1, NULL, NULL, NULL, 50, 0, 0, NULL, 12, 42, 'vij', '123 chapel hill road , Raleigh, NC, 27604', 'fedex-12.00', NULL, '', '', 'ordered', NULL, NULL, NULL, NULL),
(59, 1, 'UNCG Bookstore', 3, 'sri', 'kod', '2015-03-12 05:47:20', 1, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'ordered', NULL, NULL, NULL, NULL),
(60, 8, 'Silver Lake Library', 3, 'sri', 'kod', '2015-01-19 00:50:00', 1, NULL, NULL, NULL, 63, 0, 0, NULL, NULL, 63, NULL, NULL, NULL, NULL, NULL, NULL, 'ordered', NULL, NULL, NULL, NULL),
(61, 8, 'Silver Lake Library', 3, 'sri', 'kod', '2015-03-04 01:34:30', 1, NULL, NULL, NULL, 33, 0, 0, NULL, NULL, 33, NULL, NULL, NULL, NULL, NULL, NULL, 'ordered', NULL, NULL, NULL, NULL),
(62, 8, 'Silver Lake Library', 3, 'sri', 'kod', '2014-11-11 11:50:45', 1, NULL, NULL, NULL, 0, 0, 0, NULL, 12, 45, 'vij', '123 chapel hill road , Raleigh, NC, 27604', 'fedex-12.00', NULL, '', '', 'ordered', NULL, NULL, NULL, NULL),
(63, 1, 'UNCG Bookstore', 3, 'sri', 'kod', '2015-05-05 03:45:23', 1, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'ordered', NULL, NULL, NULL, NULL),
(65, 2, 'UNCG Lib', 3, 'sri', 'kod', '2015-02-05 05:34:56', 1, NULL, NULL, NULL, 30, 0, 0, NULL, NULL, 30, NULL, NULL, NULL, NULL, NULL, NULL, 'ordered', NULL, NULL, NULL, NULL),
(66, 1, 'UNCG Bookstore', 3, 'sri', 'kod', '2015-04-11 09:56:59', 1, NULL, NULL, NULL, 50, 0, 0, NULL, NULL, 50, NULL, NULL, NULL, NULL, NULL, NULL, 'ordered', NULL, '{"2015-04-23 05:39:18":" WOW.....GOOD STORE"}', NULL, NULL),
(69, 9, 'store1', 3, 'sri', 'kod', '2015-03-11 09:56:59', 2, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'ordered', NULL, NULL, NULL, NULL),
(70, 9, 'store1', 3, 'sri', 'kod', '2015-01-11 09:56:59', 2, NULL, NULL, NULL, 0, 0, 0, NULL, 3.9, 3.9, 'vij', '123 chapel hill road , Raleigh, NC, 27604', 'regular-3.90', NULL, '', '', 'ordered', NULL, NULL, NULL, NULL),
(71, 1, 'UNCG Bookstore', 3, 'sri', 'kod', '2015-04-11 08:56:59', 1, NULL, NULL, NULL, 67, 0, 0, NULL, 12, 79, 'dh', '123 chapel hill road , Raleigh, NC, 27604', 'fedex-12.00', NULL, '', '', 'ordered', NULL, NULL, NULL, NULL),
(72, 16, 'store8', 3, 'sri', 'kod', '2015-05-11 06:50:12', 1, NULL, NULL, NULL, 50, 0, 0, NULL, NULL, 50, NULL, NULL, NULL, NULL, NULL, NULL, 'ordered', NULL, NULL, NULL, NULL),
(73, 14, 'store6', 3, 'sri', 'kod', '2015-04-27 03:25:25', 1, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'ordered', NULL, NULL, NULL, NULL),
(74, 14, 'store6', 3, 'sri', 'kod', '2015-04-28 09:56:59', 1, NULL, NULL, NULL, 0, 0, 0, NULL, 3.9, 3.9, 'vij', '123 chapel hill road , Raleigh, NC, 27604', 'regular-3.90', NULL, '', '', 'ordered', NULL, NULL, NULL, NULL),
(75, 1, 'UNCG Bookstore', 3, 'sri', 'kod', '2015-04-30 09:56:59', 2, 2, 'A Book of Abstract Algebra', NULL, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'ordered', NULL, NULL, NULL, NULL),
(76, 1, 'UNCG Bookstore', 3, 'sri', 'kod', '2015-02-19 09:56:59', 2, 2, 'A Book of Abstract Algebra', NULL, 0, 0, 0, NULL, 12, 12, 'vij', '123 chapel hill road , Raleigh, NC, 27604', 'fedex-12.00', NULL, '', '', 'ordered', NULL, NULL, NULL, NULL),
(77, 1, 'UNCG Bookstore', 3, 'sri', 'kod', '2015-03-31 09:56:59', 2, 2, 'A Book of Abstract Algebra', NULL, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'ordered', NULL, NULL, NULL, NULL),
(85, 1, 'UNCG Bookstore', 2, 'Lixin', 'Fu', '2014-12-12 09:56:59', 1, 1, 'Properties of Triangles', NULL, 50, 0, 0, NULL, NULL, 50, NULL, NULL, NULL, NULL, NULL, NULL, 'ordered', NULL, NULL, NULL, NULL),
(86, 1, 'UNCG Bookstore', 2, 'Lixin', 'Fu', '2015-03-11 09:56:59', 1, 1, 'Properties of Triangles', NULL, 50, 0, 0, NULL, 3.9, 53.9, 'Lixin Fu', '167 Petty Building, UNCG , Greensboro, NC, 27402', 'regular-3.90', NULL, 'FedEx', 'wrapped in plastic bag', 'ordered', NULL, '{"2015-04-30 15:16:04":" I have ordered","2015-05-01 04:47:47":" and checked again","2015-05-01 04:48:42":" and checked again","2015-05-04 02:42:35":" add a new msg"}', NULL, NULL),
(88, 1, 'UNCG Bookstore', 10, 'madhavi', 'unnam', '0000-00-00 00:00:00', 1, 1, 'Business By The Book', NULL, 50, 0, 0, NULL, NULL, 50, NULL, NULL, NULL, NULL, NULL, NULL, 'ordered', NULL, NULL, NULL, NULL),
(89, 1, 'UNCG Bookstore', 10, 'madhavi', 'unnam', '0000-00-00 00:00:00', 1, 1, 'What Do You Believe? (Big Questions)', NULL, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'ordered', NULL, NULL, NULL, NULL),
(90, 25, 'vid library', 3, 'sri', 'kod', '0000-00-00 00:00:00', 1, 1, 'Better Homes and Gardens New Junior Cook Book', NULL, 25, 0, 0, NULL, NULL, 25, NULL, NULL, NULL, NULL, NULL, NULL, 'ordered', NULL, NULL, NULL, NULL),
(91, 25, 'vid library', 3, 'sri', 'kod', '2015-05-03 17:09:21', 1, 1, 'Better Homes and Gardens New Junior Cook Book', 'rent', 25, 0, 0, NULL, NULL, 25, NULL, NULL, NULL, NULL, NULL, NULL, 'Shipped', NULL, NULL, NULL, NULL),
(98, 1, 'UNCG Bookstore', 10, 'madhavi', 'unnam', '2015-05-04 11:25:04', 1, 1, 'Business By The Book', 'borrow', 0, 0, 0, NULL, 12, 12, 'Madhu', 'newgarden rd greensboro, greensboro, NC, 27410', 'fedex-12.00', NULL, 'fedex', 'testing', 'ordered', NULL, NULL, NULL, NULL),
(99, 1, 'UNCG Bookstore', 11, 'Madhu', 'U', '2015-05-04 11:31:26', 1, 2, 'Advanced databases', 'rent', 134, 0, 0, NULL, NULL, 134, NULL, NULL, NULL, NULL, NULL, NULL, 'ordered', NULL, '{"2015-05-04 17:57:42":" hi"}', NULL, NULL),
(100, 1, 'UNCG Bookstore', 11, 'Madhu', 'U', '2015-05-04 11:52:42', 1, 1, 'Business By The Book', 'borrow', 0, 0, 0, NULL, 12, 12, 'madhu', '343 abc, xyz, AL, 23223', 'fedex-12.00', NULL, 'fedex', '', 'ordered', NULL, NULL, NULL, NULL),
(101, 1, 'UNCG Bookstore', 11, 'Madhu', 'U', '2015-05-04 12:00:37', 1, 1, 'Introduction to Algorithms Box', 'rent', 67, 0, 0, NULL, 12, 79, 'unnam', '555 jefferson, gso, AS, 28888', 'fedex-12.00', NULL, 'fedex', '', 'ordered', NULL, NULL, NULL, NULL),
(102, 1, 'UNCG Bookstore', 10, 'madhavi', 'unnam', '2015-05-04 12:11:13', 2, 3, 'Property Samba', 'buy', 307, 0, 0, NULL, NULL, 307, NULL, NULL, NULL, NULL, NULL, NULL, 'ordered', NULL, '{"2015-05-04 18:11:27":" hello"}', NULL, NULL),
(107, 1, 'UNCG Bookstore', 2, 'Lixin', 'Fu', '2015-05-04 15:09:57', 2, 2, 'A Book of Abstract Algebra', 'borrow', 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'ordered', NULL, NULL, NULL, NULL),
(119, 29, 'ç¶ å ¡è¯äººåŸºç£æ•™æœƒåœ–æ›¸é¤¨', 2, 'Lixin', 'Fu', '2015-05-06 12:53:51', 1, 1, 'ç¾ä»£èˆ‡å¤ä»£è–ç¶“åœ°åœ–æŠ•å½±ç‰‡', 'borrow', 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'Ordered', NULL, NULL, NULL, NULL),
(120, 1, 'UNCG Bookstore', 2, 'Lixin', 'Fu', '2015-05-06 13:29:02', 1, 1, 'Introduction to Algorithms Box', 'borrow', 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'ordered', NULL, NULL, NULL, NULL),
(121, 2, 'UNCG Lib', 2, 'Lixin', 'Fu', '2015-05-06 13:35:57', 1, 1, 'Online Return', 'Return', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Ordered', NULL, NULL, NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`adminID`, `insertDate`, `name`, `phone`, `otherPhone`, `mailAddr`, `email`, `password`, `question`, `answer`) VALUES
(1, '2015-03-23', 'sri', '1234567890', '', '123 chapel hill road raleigh nc', 'srikodali9@gmail.com', '123', 4, 'CSC'),
(2, '2105-04-11', 'Lixin Fu', '3362561137', '', '167 Petty Building, UNCG', 'lfu@uncg.edu', '123', 1, 'fish');

-- --------------------------------------------------------

--
-- Table structure for table `bookreviews`
--

CREATE TABLE IF NOT EXISTS `bookreviews` (
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
  `feedback` text,
  PRIMARY KEY (`isbn`,`custID`,`reviewTime`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookreviews`
--

INSERT INTO `bookreviews` (`isbn`, `bookTitle`, `custID`, `custFirstName`, `custLastName`, `reviewTime`, `overallStars`, `revTitle`, `comment`, `helpful`, `noHelp`, `numFbk`, `feedback`) VALUES
('0486121178', 'Properties of Triangles', 1, NULL, NULL, '2014-05-12 10:40:17', 0, 'good', 'I''ve never given any review five stars before, but this novel deserves it. The sentences are perfectly crafted, the characters are compelling, and the plot is presented from an original point of view.', NULL, NULL, NULL, NULL),
('0486121178', 'Properties of Triangles', 1, NULL, NULL, '2015-04-01 11:17:33', 0, 'good', 'This is really very helpful', NULL, NULL, NULL, NULL),
('0486474178', 'A Book of Abstract Algebra', 1, NULL, NULL, '2013-05-14 06:42:27', 0, 'good', 'Each class I''ve taken as a grad student, I''ve gone a little overboard buying all sorts of books on the subject matter. I like that each author has a unique style and approach.', NULL, NULL, NULL, NULL),
('0486474178', 'A Book of Abstract Algebra', 1, NULL, NULL, '2015-04-01 06:37:46', 0, 'good', 'The author uses a discursive language, pretty unusual for a book of this type but extremely effective. While going through this book, you have the impression not of reading a textbook but of "listening" to the author talking to you.', NULL, NULL, NULL, NULL),
('0785287973', 'Business By The Book', 0, NULL, NULL, '2015-04-02 05:38:23', 0, 'good', 'This book is not for someone wanting to get rich quick! If you are a Christian business owner wanting to run your business according to God''s word, this book explains God''s word and gives helpful tips to follow through with His word.', NULL, NULL, NULL, NULL),
('0785287973', 'Business By The Book', 1, NULL, NULL, '2013-12-18 06:43:26', 0, 'good', 'This book is so good that I give away 10-20 of them a month. I set people up in business and I send it to all my new dealers. Read it and you will know how GOD wants you to run HIS business.', NULL, NULL, NULL, NULL),
('0785688673', 'Small Business Tax Deductions Revealed', 1, NULL, NULL, '2014-10-07 07:42:31', 0, 'better', 'I recommend this title to anyone who is a small business owner, freelancer, or other entrepreneur and wants to pay less in taxes.\r\n', NULL, NULL, NULL, NULL),
('0785688673', 'Small Business Tax Deductions Revealed', 1, NULL, NULL, '2015-04-03 11:09:38', 0, 'good', 'I read this book while reading another book on taxes. The other book gave information that was different than what Wayne had put in his book. I send Wayne an e-mail and the next day he got back to me with an answer on why the info was different.', NULL, NULL, NULL, NULL),
('0848736575', ' Cooking Light Slow-Cooker Tonight!', 1, NULL, NULL, '0000-00-00 00:00:00', 0, 'test review', 'test comments', NULL, NULL, NULL, NULL),
('0848736575', 'Cooking Light Slow-Cooker Tonight!', 1, NULL, NULL, '2014-08-05 08:46:34', 0, 'average', 'This is the same cookbook I bought a few years ago, with some new recipes. Unfortunately, most of them were in the last book. However, if you don''t have the previous Cooking Ligt Slow-Cooker cookbook, this is a great addition to your collection.', NULL, NULL, NULL, NULL),
('0848736575', 'Cooking Light Slow-Cooker Tonight!', 1, NULL, NULL, '2015-04-04 05:46:33', 0, 'good', 'I was excited to get this book as I already had their previous slow cooker book. Only a couple of repeat recipes, which was nice. Simple instructions, great favors & recipes adapt easily to any changes we have made', NULL, NULL, NULL, NULL),
('0848736575', ' Cooking Light Slow-Cooker Tonight!', 1, NULL, NULL, '2015-04-08 13:04:27', 0, 'test new', 'New comments', NULL, NULL, NULL, NULL),
('0848736575', ' Cooking Light Slow-Cooker Tonight!', 2, NULL, NULL, '2015-04-08 13:12:08', 0, 'hiii', 'fhjiijhg', NULL, NULL, NULL, NULL),
('1118146069', 'Better Homes and Gardens New Junior Cook Book', 1, NULL, NULL, '2014-11-12 07:46:35', 0, 'average', 'I gave this to my granddaughter for Christmas and she was using it immediately! She feels so important having her own cookbook! Hard back makes it durable and photos are great!', NULL, NULL, NULL, NULL),
('1118146069', 'Better Homes and Gardens New Junior Cook Book', 1, NULL, NULL, '2015-04-05 06:48:40', 0, 'good', 'Cute titles for each of the recipes, appealing to both boys and girls.\r\nMy grandsons are the chefs so the book is not too girly for them.\r\nIngredients are simple and easy to find.', NULL, NULL, NULL, NULL),
('1145676099', '25 Winter Craft Ideas', 1, NULL, NULL, '2015-04-02 07:40:27', 0, 'average', 'wow this book has an amazing number of ideas for winter! Its laid out beautifully, includes step-by-step pictures and has a materials list for each project.', NULL, NULL, NULL, NULL),
('1263869120', 'Diy Gifts Box Set', 1, NULL, NULL, '2015-04-02 05:31:49', 0, 'better', 'Very nice read and a very unique ideas thank you it is my wish that one day I will be creative like those that have enough faith in their work to show it to everyone. ', NULL, NULL, NULL, NULL),
('1428365762', 'Property Samba', 1, NULL, NULL, '2015-04-01 13:32:00', 0, 'bad', 'Didn''t like this concept. Splitting a house into apartments owned by multiple people sounds like a nightmare if the house needs to be sold in the future.', NULL, NULL, NULL, NULL);

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
  `keywords` varchar(256) DEFAULT NULL,
  `description` text,
  `contents` text,
  `fromBackCover` text,
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
('0926406485', '0926406485', '2015-05-04', '444', 'ç¾ä»£èˆ‡å¤ä»£è–ç¶“åœ°åœ–æŠ•å½±ç‰‡', '', 'Then and Now Bible Map Transparencies', 'NA', NULL, '', '', '', 0, 0, 0, '', 'è–ç¶“è«–å¢', 'è–ç¶“åœ°ç†', '', NULL, NULL, NULL, 'è­‰ä¸»åœ–æ›¸ä¸­å¿ƒ', '0000-00-00', '', NULL, '', 'å…±12é æŠ•å½±ç‰‡åŠå…«é é™„è®€è³‡æ–™ æ­¤æŠ•å½±ç‰‡å¹«åŠ©ä¿¡å¾’æ˜Žç™½è–ç¶“åœ°ç†ï¼Œä¸¦ç¾ä»£åŸŽå¸‚ä¹‹ æ‰€åœ¨åœ°ã€‚å…§é™„åäºŒå¼µæŠ•å½±ç‰‡ï¼Œå°‡ç¾ä»ŠåŸŽå¸‚èˆ‡åœ‹å®¶ç–Šåœ¨å¤ä»£åœ° åœ–ä¸Š,æ–¹ä¾¿è®€è€…ä¸€ç›®äº†ç„¶ã€‚ä¸¦é™„æœ‰èˆŠç´„å’Œæ–°ç´„çš„å¹´ä»£è¡¨ã€è€¶ç©Œ ç”Ÿå¹³åŠä¿ç¾…æ—…ç¨‹ç°¡ä»‹ï¼Œä»¥åŠ©ä½¿ç”¨é€™äº›æŠ•å½±ç‰‡ã€‚è®€è€…å¯ä»¥å¾žä¸­ è‹±å°ç…§çš„åœ°åç´¢å¼•å°‹æ‰¾å„åœ°æ–¹æˆ–åŸŽå¸‚ä¹‹æ‰€åœ¨ã€‚', '', '', 0, 0),
('1428365766', '1428365766', '2015-05-04', '', 'PropertySamba', '', '', 'Tom Costa', NULL, '', '', '', 0, 0, 0, '', 'ART', 'ARCHITECTURE', '', NULL, NULL, NULL, '', '0000-00-00', '', NULL, '', '', '', '', 0, 0),
('9574750795', '9574750795', '2015-04-30', '', 'æ–°ç´„è–ç¶“è¬›ç« å¯¶åº«--åŠ æ‹‰å¤ªæ›¸', '', '', 'é»ƒå…­é»ž æ•´ç†', NULL, '', '', '', 0, 0, 0, '', 'ANTIQUES & COLLECTIBLES', 'ANTIQUES & COLLECTIBLES', 'ANTIQUES & COLLECTIBLES', NULL, NULL, NULL, 'å¤§å…‰å‡ºç‰ˆç¤¾', '0000-00-00', '', NULL, '', 'ã€Œæ–°ç´„è–ç¶“è¬›ç« å¯¶åº«ã€å…¨å¥—ä¸ƒåå†Šï¼Œè²»æ™‚å¹¾åå¹´æ”¶é›†æ•´ç†ï¼Œä½œè€…åŒ…æ‹¬åœ‹å…§å¤–å¹¾ç™¾ä½ä¸Šå¸çš„å¿ åƒ•ï¼Œç ”è®€æœ¬æ›¸ï¼Œèƒ½å¹³è¡¡åŸºç£å¾’çš„ä¿¡ä»°è§€ã€‚æœ¬æ›¸æ•´ç†äº†åŠ æ‹‰å¤ªæ›¸ç¬¬ä¸€ç« è‡³åŠ æ‹‰å¤ªæ›¸ç¬¬å…­ç« ä¸­å…§å®¹ç²¾é—¢é©åˆ‡çš„è¬›ç« ï¼ŒæŒ‰é †åºæŽ’åˆ—ï¼Œå…§å®¹è±å¯Œç²¾æ¹›ï¼Œé©åˆç‰§é•·ã€å‚³é“äººä½¿ç”¨ï¼Œäº¦æ˜¯ä¿¡å¾’ç ”è®€è–ç¶“æ™‚çš„æœ€ä½³æŸ¥è€ƒè³‡æ–™ã€‚', '', '', 0, 346),
('978-0072322064', '0072322063', '2105-02-11', '', 'Database Management Systems', '', '', 'Raghu; Gehrke, Johannes Ramakrishnan', NULL, '', 'English', '', 0, 3.8, 10, 'http://amazon.com/dp/0072322063', 'COMPUTERS', 'COMPUTERS', '', NULL, NULL, NULL, 'McGraw-Hill College', '0000-00-00', 'Raghu; Gehrke, Johannes Ramakrishnan,Database Management Systems,McGraw-Hill College,0072322063,805895891,Databases &amp; data structures,Systems management,Computer Books: Database,Computers,Database Engineering,Database management,General,Internet - Gene', NULL, '', 'Database Management Systems [Raghu; Gehrke, Johannes Ramakrishnan]. Second Edition. Owner&amp;#39;s name inside board. If applicable online access or codes are not guaranteed to work. Pages are clean and binding is tight. Solid Book.', 'Hardcover', '7.7 x 1.5 x 9.8 inches', 3.2, 740),
('978-0307408860', '0307408868', '2015-04-27', '', 'Dead Wake: The Last Crossing of the Lusitania', '', '', 'Erik Larson', NULL, '', 'English', '', 0, 4.5, 917, 'http://amazon.com/dp/0307408868', 'FICTION', 'Thriller', '', NULL, NULL, NULL, 'Crown', '0000-00-00', 'Erik Larson,Dead Wake: The Last Crossing of the Lusitania,Crown,0307408868,20th century,Government policy,Great Britain,History,History - Military / War,History / Military / Naval,History / Military / World War I,History / Modern / 20th Century,Military,Mi', NULL, '', 'Dead Wake: The Last Crossing of the Lusitania [Erik Larson]. &amp;lt;b&amp;gt;#1 New York Times Bestseller From the&amp;#160;bestselling author and master of narrative nonfiction comes the enthralling story of the sinking of the Lusitania&amp;lt;/i&amp;gt;&amp;lt;/b&amp;gt; On May 1', 'Hardcover', '6.5 x 1.4 x 9.5 inches', 1.5, 448),
('978-0486121178', '0486121150', '2015-04-10', NULL, 'Properties of Triangles', NULL, NULL, 'MOHAMMAD KHAJA SHAREEF', NULL, NULL, 'English', NULL, NULL, 3, NULL, NULL, 'Mathematics', 'Trigonometry', 'Properties', NULL, NULL, NULL, 'Science inspiration', '2015-03-12', NULL, 'This Book provides sufficiently strong base to our students for the purpose of Public Examinations, All Engineering Entrance and National Entrance Exams like NEET, JEE etc. ', NULL, NULL, NULL, NULL, NULL, NULL),
('978-0486474178', '0486121179', '2013-04-14', '111', 'A Book of Abstract Algebra', NULL, NULL, 'Charles C Pinter ', NULL, NULL, 'English', NULL, NULL, 4.5, NULL, NULL, 'Mathematics', 'Algebra', 'Abstract Algebra', NULL, NULL, NULL, 'Dover Publications', '2010-01-14', NULL, 'Accessible but rigorous, this outstanding text encompasses all of the topics covered by a typical course in elementary abstract algebra. Its easy-to-read treatment offers an intuitive approach, featuring informal discussions followed by thematically arranged exercises.', NULL, NULL, NULL, NULL, NULL, NULL),
('978-0756672280', '0756672280', '2015-05-01', '', 'What Do You Believe? (Big Questions)', '', '', 'DK', NULL, '', 'English', '', 0, 4.6, 44, 'http://amazon.com/dp/0756672287', 'BIBLES', 'BODY, MIND & SPIRIT', '', NULL, NULL, NULL, 'DK Children', '0000-00-00', 'DK,What Do You Believe? (Big Questions),DK Children,0756672287,Religion - General,Children&#39;s Books/Ages 9-12 Nonfiction,Children: Grades 4-6,Faith,History,Juvenile Nonfiction,Juvenile Nonfiction / Religion / General,Juvenile Religion,Juvenile literatur', NULL, '', 'What Do You Believe? (Big Questions) [DK]. What do you believe? Do you know why you believe what you do? What Do You Believe?&amp;lt;/i&amp;gt; introduces readers to the many religions of the world and its equally numerous philosophies', 'Hardcover', '9 x 0.5 x 11.5 inches', 1.4, 96),
('978-0756672287', '0756672287', '2104-12-12', '', 'What Do You Believe? (Big Questions)', '', '', 'DK', NULL, '', 'English', '', 0, 4.6, 44, 'http://amazon.com/dp/0756672287', 'Biography', 'Auto-Biography', '', NULL, NULL, NULL, 'DK Children', '0000-00-00', 'DK,What Do You Believe? (Big Questions),DK Children,0756672287,Religion - General,Children&#39;s Books/Ages 9-12 Nonfiction,Children: Grades 4-6,Faith,History,Juvenile Nonfiction,Juvenile Nonfiction / Religion / General,Juvenile Religion,Juvenile literatur', NULL, '', 'What Do You Believe? (Big Questions) [DK]. What do you believe? Do you know why you believe what you do? What Do You Believe?&amp;lt;/i&amp;gt; introduces readers to the many religions of the world and its equally numerous philosophies', 'Hardcover', '9 x 0.5 x 11.5 inches', 1.4, 96),
('978-0756672299', '0756672299', '2015-05-02', '', 'What Do You Believe? (Big Questions)', '', '', 'DK', NULL, '', 'English', '', 0, 4.6, 44, 'http://amazon.com/dp/0756672287', 'ART', 'ARCHITECTURE', '', NULL, NULL, NULL, 'DK Children', '0000-00-00', 'DK,What Do You Believe? (Big Questions),DK Children,0756672287,Religion - General,Children&#39;s Books/Ages 9-12 Nonfiction,Children: Grades 4-6,Faith,History,Juvenile Nonfiction,Juvenile Nonfiction / Religion / General,Juvenile Religion,Juvenile literatur', NULL, '', 'What Do You Believe? (Big Questions) [DK]. What do you believe? Do you know why you believe what you do? What Do You Believe?&amp;lt;/i&amp;gt; introduces readers to the many religions of the world and its equally numerous philosophies', 'Hardcover', '9 x 0.5 x 11.5 inches', 1.4, 96),
('978-0758278432', '0758278438', '2014-12-25', '', 'The Plum Tree', '', '', 'Ellen Marie Wiseman', NULL, '', 'English', '', 0, 4.5, 773, 'http://amazon.com/dp/0758278438', 'DRAMA', 'DRAMA', '', NULL, NULL, NULL, 'Kensington', '0000-00-00', 'Ellen Marie Wiseman,The Plum Tree,Kensington,0758278438,Germany,Jews,Women household employees,World War, 1939-1945,Fiction - Historical,Fiction,Fiction / General,Fiction / Historical,Historical - General,Historical fiction,Historical &amp; Mythological Fi', NULL, '', 'The Plum Tree [Ellen Marie Wiseman]. &amp;lt;div&amp;gt; &amp;lt;span&amp;gt;&amp;lt;b&amp;gt;&amp;quot;The meticulous hand-crafted detail and emotional intensity of THE PLUM TREE immersed me in Germany during its darkest hours and the ordeals its citizens had to face. A must-read for WW2 fiction aficionados--and any reader who loves a transporting story.&amp;quot;&amp;lt;/b&amp;gt;--&amp;lt;b&amp;gt;Jenna Blum', 'Paperback', '5.6 x 1 x 8.2 inches', 13.6, 400),
('978-0785242192', '0785242198', '2015-05-01', '', 'The New Evidence That Demands A Verdict: Evidence I & II Fully Updated in One Volume To Answer The Q', '', '', 'Josh McDowell', NULL, '', 'English', '', 0, 4.2, 256, 'http://amazon.com/dp/0785242198', 'BIBLES', 'BIBLES', '', NULL, NULL, NULL, 'Thomas Nelson', '0000-00-00', 'Josh McDowell,The New Evidence That Demands A Verdict: Evidence I &amp; II Fully Updated in One Volume To Answer The Questions Challenging Christians in the 21st Century.,Thomas Nelson,0785242198,Christian Theology - General,Theology,Apologetics,Bible,Bibl', NULL, '', 'The New Evidence That Demands A Verdict: Evidence I &amp;amp; II Fully Updated in One Volume To Answer The Questions Challenging Christians in the 21st Century. [Josh McDowell]. &amp;lt;b&amp;gt;Evidence I &amp;amp; II&amp;lt;/b&amp;gt;&amp;lt;/i&amp;gt;-The classic defense of the faith: Now fully updated to answer the questions challenging evangelical faith today. The New Evidence&amp;lt;/i&amp;gt; maintains its classic defense of the faith yet addresses new issues. The New Evidence&amp;lt;/i&amp;gt; is destined to equip believers with a ready defense for the next decade and beyond', 'Hardcover', '6.6 x 1.7 x 9.6 inches', 2.8, 816),
('978-0785287973', '0785287974', '2015-04-02', '222', 'Business By The Book', NULL, NULL, 'Larry Burkett ', NULL, NULL, 'English', NULL, NULL, 5, NULL, NULL, 'Business', 'Biblical Principles', 'Biblical Principles for the Workplace', NULL, NULL, NULL, 'Thomas Nelson', '2005-12-25', NULL, 'Business by the Book is a step-by-step presentation of how businesses should be run according to the Creator of all management rules: God', NULL, NULL, NULL, NULL, NULL, NULL),
('978-0785688673', '0785688679', '2015-04-01', NULL, 'Small Business Tax Deductions Revealed', NULL, NULL, 'Wayne Davies', NULL, NULL, 'English', NULL, NULL, 4.5, NULL, NULL, 'Business', 'Tax', 'Tax savings tips', NULL, NULL, NULL, 'Thomas Nelson', '2013-06-11', NULL, 'Tired of paying so much tax to the IRS? You are not alone! Small business owners and self-employed people are overpaying their taxes by millions of dollars every year. “Small Business Tax Deductions Revealed” provides the tax reduction strategies you need to substantially lower your taxes. Read this book to discover “29 Tax-Saving Tips You Wish You Knew”. These tax tips are perfectly legal self-employed tax deductions that you can use without any fear of the IRS.', NULL, NULL, NULL, NULL, NULL, NULL),
('978-0848736575', '0848736576', '2014-02-11', NULL, 'Cooking Light Slow-Cooker Tonight', NULL, NULL, 'John k.', NULL, NULL, 'English', NULL, NULL, 3, NULL, NULL, 'Cooking', 'Delicious', 'appetizers and beverages', NULL, NULL, NULL, 'Oxmoor House', '2012-09-25', NULL, 'For delicious make-ahead meals, nothing beats a crock-pot. Cooking Light® Slow Cooker Tonight! is your perfect source for recipes that transform simple ingredients into filling, flavorful dishes. ', NULL, NULL, NULL, NULL, NULL, NULL),
('978-0984782802', '098478280X', '2015-05-01', '', 'Cracking the Coding Interview: 150 Programming Questions and Solutions', '', '', 'Gayle Laakmann McDowell', NULL, '', 'English', '', 0, 4.6, 412, 'http://amazon.com/dp/098478280X', 'COMPUTERS', 'COMPUTERS', '', NULL, NULL, NULL, 'CareerCup', '0000-00-00', 'Gayle Laakmann McDowell,Cracking the Coding Interview: 150 Programming Questions and Solutions,CareerCup,098478280X,Careers - Job Hunting,Programming - General,Software Development &amp; Engineering - General,Business &amp; Economics,Business &amp; Economi', NULL, '', 'Cracking the Coding Interview: 150 Programming Questions and Solutions [Gayle Laakmann McDowell]. Now in the 5th edition, Cracking the Coding Interview gives you the interview preparation you need to get the top software developer jobs. This is a deeply technical book and focuses on the software engineering skills to ace your interview. The book is over 500 pages and includes &amp;lt;b&amp;gt;150 programming interview questions and answers&amp;lt;/b&amp;gt;', 'Paperback', '6 x 1.2 x 9 inches', 1.1, 508),
('978-0990402077', '099040207X', '2015-04-29', '', 'SQL Database for Beginners', '', '', 'Mr. Martin Holzke, Mr. Tom Stachowitz', NULL, '', 'English', '', 0, 4.7, 51, 'http://amazon.com/dp/099040207X', 'COMPUTERS', 'COMPUTERS', '', NULL, NULL, NULL, 'LearnToProgram, Incorporated', '0000-00-00', 'Mr. Martin Holzke, Mr. Tom Stachowitz,SQL Database for Beginners,LearnToProgram, Incorporated,099040207X,Computers - Data Base Management,Computers / Databases / General,Databases - General', NULL, '', 'SQL Database for Beginners [Mr. Martin Holzke, Mr. Tom Stachowitz]. Have you started learning about SQL databases, only to get stuck while trying to teach yourself? Or are you a developer who has never felt totally at ease with database work? Have you been looking for an easy and comprehensive way to go beyond the basics and start using SQL databases in a professional and efficient way? Perhaps', 'Paperback', '6 x 1 x 9 inches', 1.6, 422),
('978-1082829274', '1082829279', '2015-04-10', NULL, 'Graphs of Trigonometric Functions', NULL, NULL, 'Nawab khura', NULL, NULL, 'English', NULL, NULL, 3, NULL, NULL, 'Mathematics', 'Trigonometry5', 'Properties', NULL, NULL, NULL, 'Science inspiration', '2015-03-12', NULL, 'This Book provides sufficiently strong base to our students for the purpose of Public Examinations, All Engineering Entrance and National Entrance Exams like NEET, JEE etc. ', NULL, NULL, NULL, NULL, NULL, NULL),
('978-1118146069', '1118146068', '2013-12-17', NULL, 'Better Homes and Gardens New Junior Cook Book', NULL, NULL, 'Nancy ', NULL, NULL, 'English', NULL, NULL, 4.5, NULL, NULL, 'Cooking', 'Junior Cooking', 'kids ages 5 to 12', NULL, NULL, NULL, ' Better Homes and Gardens', '2012-07-17', NULL, 'All the recipes here are easy-to-follow and packed with helpful hints and fun ways for kids to put their own spin on them. With lots of easy-to-understand nutrition information, it''s a great way to teach kids about healthy eating while getting them interested in cooking.', NULL, NULL, NULL, NULL, NULL, NULL),
('978-1134699020', '1134699021', '2015-04-10', NULL, 'Trignometry Equations', NULL, NULL, 'hakkem ', NULL, NULL, 'English', NULL, NULL, 3, NULL, NULL, 'Mathematics', 'Trigonometry', 'Properties', NULL, NULL, NULL, 'Science inspiration', '2015-03-12', NULL, 'This Book provides sufficiently strong base to our students for the purpose of Public Examinations, All Engineering Entrance and National Entrance Exams like NEET, JEE etc. ', NULL, NULL, NULL, NULL, NULL, NULL),
('978-1145676099', '1145676090', '2014-11-11', '1234567890', '25 Winter Craft Ideas', NULL, NULL, 'Monica Van Zandt', NULL, NULL, 'English', NULL, NULL, 3.5, NULL, NULL, 'Crafts', 'Seasonal Craft', 'Easy Indoor Crafts', '', NULL, NULL, 'Amazon Publishing', '2005-10-25', NULL, 'Winter is the perfect time for seasonal crafts indoors, but it can be hard to find easy ideas that the kids will actually enjoy. In this book, you will find 25 EASY and ACTIONABLE craft ideas for the Winter months.', NULL, NULL, NULL, NULL, NULL, NULL),
('978-1156393783', '1156393748', '2015-04-10', NULL, 'Basic Trignomerty', NULL, NULL, 'MOHAMMAD KHAJA SHAREEF', NULL, NULL, 'English', NULL, NULL, 3, NULL, NULL, 'Mathematics', 'Trigonometry4', 'Properties', NULL, NULL, NULL, 'Science inspiration', '2015-03-12', NULL, 'This Book provides sufficiently strong base to our students for the purpose of Public Examinations, All Engineering Entrance and National Entrance Exams like NEET, JEE etc. ', NULL, NULL, NULL, NULL, NULL, NULL),
('978-1234567890', '1234567891', '2014-12-01', NULL, 'Introduction to Algorithms Box', NULL, NULL, 'Thomas Cormen, T. Leveresen', NULL, NULL, 'English', NULL, NULL, NULL, NULL, NULL, 'Computers', 'Algorithms', 'Algorithms1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('978-1245780111', '1245780115', '2015-04-10', NULL, 'Trigonometric Identities', NULL, NULL, 'Albert', NULL, NULL, 'English', NULL, NULL, 3, NULL, NULL, 'Mathematics', 'Trigonometry1', 'Properties3', NULL, NULL, NULL, 'Science inspiration', '2015-03-12', NULL, 'This Book provides sufficiently strong base to our students for the purpose of Public Examinations, All Engineering Entrance and National Entrance Exams like NEET, JEE etc. ', NULL, NULL, NULL, NULL, NULL, NULL),
('978-1250010100', '1250010101', '2015-03-17', '777', 'Keep Quiet', '', '', 'Lisa Scottoline', NULL, '', 'English', '', 0, 4.2, 646, 'http://amazon.com/dp/1250010101', 'DRAMA', 'DRAMA', '', NULL, NULL, NULL, 'St. Martin-s Griffin', '0000-00-00', 'Lisa Scottoline,Keep Quiet,St. Martin&#39;s Griffin,1250010101,Mystery/Suspense,Fiction - Espionage / Thriller,Fiction,Fiction / Thrillers / Suspense,Thrillers - Suspense,American Mystery &amp; Suspense Fiction,Pennsylvania', NULL, '', 'Keep Quiet [Lisa Scottoline]. New York Times&amp;lt;/i&amp;gt; bestselling and Edgar Award-winning author Lisa Scottoline is loved by millions of readers for her suspenseful novels about family and justice. Scottoline delivers once again with Keep Quiet&amp;lt;/i&amp;gt;', 'Paperback', '5.5 x 1 x 8.2 inches', 9.9, 384),
('978-1256935744', '1256935745', '2015-04-10', NULL, 'Number thoery', NULL, NULL, 'MOHAMMAD KHAJA SHAREEF', NULL, NULL, 'English', NULL, NULL, 3, NULL, NULL, 'Mathematics', 'Trigonometry', 'Properties', NULL, NULL, NULL, 'Science inspiration', '2015-03-12', NULL, 'This Book provides sufficiently strong base to our students for the purpose of Public Examinations, All Engineering Entrance and National Entrance Exams like NEET, JEE etc. ', NULL, NULL, NULL, NULL, NULL, NULL),
('978-1263869120', '1263869132', '2015-02-09', NULL, 'Diy Gifts Box Set', NULL, NULL, 'Amy Cruz', NULL, NULL, 'English', NULL, NULL, 4, NULL, NULL, 'Crafts', 'Easy crafts', 'Diy crafts', NULL, NULL, NULL, 'Friend publishing', '2008-07-15', NULL, 'You would be well-known with the saying fact “gifting boosts up the love relation among the beloved ones. So, catering to decide what to gift becomes mystifying and sometimes tricky. But now you can shed of your confusion by getting the tips and tricks of giving exceptional gifts to your loved ones. ', NULL, NULL, NULL, NULL, NULL, NULL),
('978-1387328218', '1387328220', '2015-04-10', NULL, 'Trig Tables', NULL, NULL, 'MOHAMMAD KHAJA SHAREEF', NULL, NULL, 'English', NULL, NULL, 3, NULL, NULL, 'Mathematics', 'Trigonometry3', 'Properties', NULL, NULL, NULL, 'Science inspiration', '2015-03-12', NULL, 'This Book provides sufficiently strong base to our students for the purpose of Public Examinations, All Engineering Entrance and National Entrance Exams like NEET, JEE etc. ', NULL, NULL, NULL, NULL, NULL, NULL),
('978-1428365762', '1428365760', '2015-02-08', NULL, 'Property Samba', NULL, NULL, 'Tom Costa ', NULL, NULL, 'English', NULL, NULL, 4, NULL, NULL, 'Business', 'Property', 'Real Estate', NULL, NULL, NULL, 'DK', '2014-06-16', NULL, 'Just imagine this: Having YOUR OWN apartment, without having to chase real estate agents, without having to pay off bank loans for the next forty years, and without any kind of investment. Yes, it is possible! And this book teaches you the secret to gaining a real estate property, the Property Samba way. This is not one of those investing books that teaches you how to invest in the real estate business. BECAUSE THERE IS NO INVESTMENT AT ALL! ', NULL, NULL, NULL, NULL, NULL, NULL),
('978-1449392772', '1449392776', '2015-05-05', '', 'Programming PHP', '', '', 'Kevin Tatroe, Peter MacIntyre, Rasmus Lerdorf', NULL, '', 'English', '', 0, 4, 25, 'http://amazon.com/dp/1449392776', 'COMPUTERS', 'Programming Languages', '', NULL, NULL, NULL, 'O-Reilly Media', '0000-00-00', 'Kevin Tatroe, Peter MacIntyre, Rasmus Lerdorf,Programming PHP,O&#39;Reilly Media,1449392776,Programming Languages - PHP,Web - General,Programming &amp; scripting languages: general,Computer - Internet,Computer Books: Languages,Computers,Computers / Program', NULL, '', 'Programming PHP [Kevin Tatroe, Peter MacIntyre, Rasmus Lerdorf]. &amp;lt;div&amp;gt; This updated edition teaches everything you need to know to create effective web applications with the latest features in PHP 5.x. You&amp;#8217;ll start with the big picture and then dive into language syntax', 'Paperback', '7 x 1.2 x 9.2 inches', 1.9, 540),
('978-1456368172', '1456368175', '2014-01-17', NULL, 'A Gallery of KNOTS!', NULL, NULL, 'Tara Cousins', NULL, NULL, 'English', NULL, NULL, 2.5, NULL, NULL, 'Crafts', 'sailors knots', 'Knofts', NULL, NULL, NULL, 'Tiger Road Publishing', '2013-08-13', NULL, 'Knot-tying is a versatile craft that practically anyone can do, anywhere. From traditional sailor’s knots to the trendy friendship bracelets of the 90’s to the modern craze of paracord crafts, knot tying is a fun and valuable skill. Guys, gals and even young kids can learn the principles of knot tying to create a huge variety of projects.', NULL, NULL, NULL, NULL, NULL, NULL),
('978-1481423120', '1481423126', '2015-03-23', '', 'The Contract (Jeter Publishing)', '', '', 'Derek Jeter, Paul Mantell', NULL, '', 'English', '', 0, 4.9, 175, 'http://amazon.com/dp/1481423126', 'BIOGRAPHY & AUTOBIOGRAPHY', 'BIOGRAPHY & AUTOBIOGRAPHY', '', NULL, NULL, NULL, 'Simon &amp', '0000-00-00', 'Derek Jeter, Paul Mantell,The Contract (Jeter Publishing),Simon &amp; Schuster/Paula Wiseman Books,1481423126,Sports &amp; Recreation - Baseball,School &amp; Education,Social Issues - Friendship,Children&#39;s / Teenage fiction: Sporting stories,Baseball,C', NULL, '', 'The Contract (Jeter Publishing) [Derek Jeter, Paul Mantell]. The debut book in the Jeter Publishing imprint, The Contract&amp;lt;/i&amp;gt; is a middle grade baseball novel inspired by the youth of legendary sports icon and role model Derek Jeter.&amp;lt;BR&amp;gt;&amp;lt;BR&amp;gt;As a young boy', 'Hardcover', '6 x 0.7 x 9 inches', 12, 176),
('978-1590282410', '1590282418', '2015-04-27', '', 'Python Programming: An Introduction to Computer Science, 2nd Ed.', '', '', 'John Zelle', NULL, '', 'English', '', 0, 4.6, 101, 'http://amazon.com/dp/1590282418', 'Computers', 'Programming', 'Basics', NULL, NULL, NULL, 'Franklin, Beedle &amp', '0000-00-00', 'John Zelle,Python Programming: An Introduction to Computer Science, 2nd Ed.,Franklin, Beedle &amp; Associates Inc.,1590282418,Programming Languages - Python,Computer Books: Languages,Computers,Computers &amp; Internet / Programming,Computers - Languages / ', NULL, '', 'Python Programming: An Introduction to Computer Science, 2nd Ed. [John Zelle]. This is the second edition of John Zelle&amp;#39;s Python Programming, updated for Python 3. This book is designed to be used as the primary textbook in a college-level first course in computing. It takes a fairly traditional approach', 'Paperback', '7 x 1.2 x 10 inches', 2, 432),
('978-1598633740', '1598633740', '2015-04-27', '', 'Programming for the Absolute Beginner', '', '', 'Jerry Lee Ford Jr.', NULL, '', 'English', '', 0, 3.9, 44, 'http://amazon.com/dp/1598633740', 'Computers', 'Basics', '', NULL, NULL, NULL, 'Cengage Learning PTR', '0000-00-00', 'Jerry Lee Ford Jr.,Programming for the Absolute Beginner,Cengage Learning PTR,1598633740,COM051000,Computer Books: General,Computer programming,Computer programming / software development,Computers,Computers - Languages / Programming,Computers / General,Co', NULL, '', 'Programming for the Absolute Beginner [Jerry Lee Ford Jr.]. Want to learn computer programming but aren&amp;#39;t sure where to start? Programming for the Absolute Beginner provides a gentle learning curve in programming for anyone who wants to develop fundamental programming skills and create computer programs. The primary focus is on teaching the reader how to program using a free implementation of BASIC called Just BASIC. As such', 'Paperback', '7.4 x 0.9 x 9.2 inches', 1.7, 384),
('978-1598634464', '1598634461', '2015-05-01', '', 'Computer Programming for Teens (For Teens (Course Technology))', '', '', 'Mary E. Farrell                       (Author)', NULL, '', 'English', '', 0, 4, 22, 'http://amazon.com/dp/1598634461', 'COMPUTERS', 'Programming', 'Intermediate', NULL, NULL, NULL, 'Cengage Learning PTR', '0000-00-00', 'Mary E. Farrell,Computer Programming for Teens (For Teens (Course Technology)),Cengage Learning PTR,1598634461,Programming - General,C++ (Computer program language),Computer programs,Java (Computer program language),Computer Books: Languages,Computer progr', NULL, '', 'Computer Programming for Teens (For Teens (Course Technology)): 9781598634464: Computer Science Books @ Amazon.com', 'Paperback', '1 x 7.5 x 9 inches', 1.6, 352),
('978-2367912564', '2367912560', '2015-04-10', NULL, 'Limits Involving Infinity', NULL, NULL, 'Ashok sipai', NULL, NULL, 'English', NULL, NULL, 3, NULL, NULL, 'Mathematics', 'Trigonometry1', 'Properties4', NULL, NULL, NULL, 'Science inspiration', '2015-03-12', NULL, 'This Book provides sufficiently strong base to our students for the purpose of Public Examinations, All Engineering Entrance and National Entrance Exams like NEET, JEE etc. ', NULL, NULL, NULL, NULL, NULL, NULL),
('978-2867409485', '2867409490', '2015-03-17', NULL, 'Databases', NULL, NULL, 'Sadri', NULL, NULL, 'E', NULL, NULL, NULL, NULL, NULL, 'Computers', 'Databases', 'Databases1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('978-3299089812', '3299089815', '2015-04-10', NULL, 'Triangles and Vectors', NULL, NULL, 'khanna', NULL, NULL, 'English', NULL, NULL, 3, NULL, NULL, 'Mathematics', 'Trigonometry', 'Properties', NULL, NULL, NULL, 'Science inspiration', '2015-03-12', NULL, 'This Book provides sufficiently strong base to our students for the purpose of Public Examinations, All Engineering Entrance and National Entrance Exams like NEET, JEE etc. ', NULL, NULL, NULL, NULL, NULL, NULL),
('978-3378290191', '3378290190', '2015-04-10', NULL, 'polar coordinates', NULL, NULL, 'MOHAMMAD KHAJA SHAREEF', NULL, NULL, 'English', NULL, NULL, 3, NULL, NULL, 'Mathematics', 'Trigonometry1', 'Properties1', NULL, NULL, NULL, 'Science inspiration', '2015-03-12', NULL, 'This Book provides sufficiently strong base to our students for the purpose of Public Examinations, All Engineering Entrance and National Entrance Exams like NEET, JEE etc. ', NULL, NULL, NULL, NULL, NULL, NULL),
('978-3474005685', '3474005682', '2015-03-15', NULL, 'Chicken Recipes', NULL, NULL, 'Hannie P. Scott ', NULL, NULL, 'English', NULL, NULL, 4, NULL, NULL, 'Cooking', 'Delicious and Easy', 'Easy Chicken Recipes ', NULL, NULL, NULL, 'Hannie P. Publishing', '2015-02-23', NULL, 'Are you looking for some delicious chicken recipes? This simple and easy chicken recipe cookbook has step-by-step recipes for preparing some fantastic chicken dishes. You will impress your friends and family with these delicious chicken recipes. Great for any occasion!', NULL, NULL, NULL, NULL, NULL, NULL),
('978-3482828234', '3482828239', '2014-12-01', NULL, 'Introduction to Algorithm Analysis', NULL, NULL, 'Thomas Cormen, T. Leveresen', NULL, NULL, 'English', NULL, NULL, NULL, NULL, NULL, 'Computers', 'Algorithms', 'Algorithms1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('978-3488927827', '3488927829', '2015-04-10', NULL, 'Triangles and Shapes', NULL, NULL, 'MOHAMMAD KHAJA SHAREEF', NULL, NULL, 'English', NULL, NULL, 3, NULL, NULL, 'Mathematics', 'Trigonometry4', 'Properties', NULL, NULL, NULL, 'Science inspiration', '2015-03-12', NULL, 'This Book provides sufficiently strong base to our students for the purpose of Public Examinations, All Engineering Entrance and National Entrance Exams like NEET, JEE etc. ', NULL, NULL, NULL, NULL, NULL, NULL),
('978-4782530381', '4782530391', '2015-04-10', NULL, 'Simple Trignometry ', NULL, NULL, 'Andrew Jenson', NULL, NULL, 'English', NULL, NULL, 3, NULL, NULL, 'Mathematics', 'Trigonometry1', 'Properties2', NULL, NULL, NULL, 'Science inspiration', '2015-03-12', NULL, 'This Book provides sufficiently strong base to our students for the purpose of Public Examinations, All Engineering Entrance and National Entrance Exams like NEET, JEE etc. ', NULL, NULL, NULL, NULL, NULL, NULL),
('978-6054860445', '6054860449', '2015-03-10', NULL, 'Xml Databases', NULL, NULL, 'jnksnfjsl, jhsidkfjsla', NULL, NULL, 'English', NULL, NULL, NULL, NULL, NULL, 'Computers', 'Databases', 'xml', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('978-6902864832', '6902864833', '2015-04-10', NULL, 'Caluculas and Analysis', NULL, NULL, 'MOHAMMAD KHAJA SHAREEF', NULL, NULL, 'English', NULL, NULL, 3, NULL, NULL, 'Mathematics', 'Calculas', 'Properties5', NULL, NULL, NULL, 'Science inspiration', '2015-03-12', NULL, 'This Book provides sufficiently strong base to our students for the purpose of Public Examinations, All Engineering Entrance and National Entrance Exams like NEET, JEE etc. ', NULL, NULL, NULL, NULL, NULL, NULL),
('978-8143539528', '8143539535', '2015-04-10', NULL, 'Traingles and properties', NULL, NULL, 'MOHAMMAD KHAJA SHAREEF', NULL, NULL, 'English', NULL, NULL, 3, NULL, NULL, 'Mathematics', 'Trigonometry4', 'Properties', NULL, NULL, NULL, 'Science inspiration', '2015-03-12', NULL, 'This Book provides sufficiently strong base to our students for the purpose of Public Examinations, All Engineering Entrance and National Entrance Exams like NEET, JEE etc. ', NULL, NULL, NULL, NULL, NULL, NULL),
('978-8586474939', '8586474945', '2015-03-17', NULL, 'Advanced databases', NULL, NULL, 'djhfksla, jhsidfsakm', NULL, NULL, 'English', NULL, NULL, NULL, NULL, NULL, 'Computers', 'Databases', 'Advanced databases', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('978-8742252925', '8742252923', '2015-04-10', NULL, 'Probability', NULL, NULL, 'Arora', NULL, NULL, 'English', NULL, NULL, 3, NULL, NULL, 'Mathematics', 'Probability and statistics', 'Properties', NULL, NULL, NULL, 'Science inspiration', '2015-03-12', NULL, 'This Book provides sufficiently strong base to our students for the purpose of Public Examinations, All Engineering Entrance and National Entrance Exams like NEET, JEE etc. ', NULL, NULL, NULL, NULL, NULL, NULL),
('978-8742254849', '8742254849', '2015-04-10', NULL, 'Number Theory', NULL, NULL, 'Aryabhatta', NULL, NULL, 'English', NULL, NULL, 3, NULL, NULL, 'Mathematics', 'Numbers ', 'Properties', NULL, NULL, NULL, 'Science inspiration', '2015-03-12', NULL, 'This Book provides sufficiently strong base to our students for the purpose of Public Examinations, All Engineering Entrance and National Entrance Exams like NEET, JEE etc. ', NULL, NULL, NULL, NULL, NULL, NULL),
('978-9441335648', '9441335649', '2015-04-10', NULL, 'book14', NULL, NULL, 'MOHAMMAD KHAJA SHAREEF', NULL, NULL, 'English', NULL, NULL, 3, NULL, NULL, 'Mathematics', 'Trigonometry3', 'Properties', NULL, NULL, NULL, 'Science inspiration', '2015-03-12', NULL, 'This Book provides sufficiently strong base to our students for the purpose of Public Examinations, All Engineering Entrance and National Entrance Exams like NEET, JEE etc. ', NULL, NULL, NULL, NULL, NULL, NULL),
('978-9490518577', '9490518574', '2015-04-10', NULL, 'book15', NULL, NULL, 'MOHAMMAD KHAJA SHAREEF', NULL, NULL, 'English', NULL, NULL, 3, NULL, NULL, 'Mathematics', 'Trigonometry3', 'Properties', NULL, NULL, NULL, 'Science inspiration', '2015-03-12', NULL, 'This Book provides sufficiently strong base to our students for the purpose of Public Examinations, All Engineering Entrance and National Entrance Exams like NEET, JEE etc. ', NULL, NULL, NULL, NULL, NULL, NULL),
('978-9553885650', '9553885651', '2015-04-10', NULL, 'book13', NULL, NULL, 'MOHAMMAD KHAJA SHAREEF', NULL, NULL, 'English', NULL, NULL, 3, NULL, NULL, 'Mathematics', 'Trigonometry3', 'Properties', NULL, NULL, NULL, 'Science inspiration', '2015-03-12', NULL, 'This Book provides sufficiently strong base to our students for the purpose of Public Examinations, All Engineering Entrance and National Entrance Exams like NEET, JEE etc. ', NULL, NULL, NULL, NULL, NULL, NULL),
('978-9581141177', '9581141179', '2015-04-10', NULL, 'book16', NULL, NULL, 'MOHAMMAD KHAJA SHAREEF', NULL, NULL, 'English', NULL, NULL, 3, NULL, NULL, 'Mathematics', 'Trigonometry4', 'Properties', NULL, NULL, NULL, 'Science inspiration', '2015-03-12', NULL, 'This Book provides sufficiently strong base to our students for the purpose of Public Examinations, All Engineering Entrance and National Entrance Exams like NEET, JEE etc. ', NULL, NULL, NULL, NULL, NULL, NULL),
('978-9603089999', '9603089999', '2015-04-10', NULL, 'Algebra Properties', NULL, NULL, 'MOHAMMAD KHAJA SHAREEF', NULL, NULL, 'English', NULL, NULL, 3, NULL, NULL, 'Mathematics', 'Algebra', 'Properties', NULL, NULL, NULL, 'Science inspiration', '2015-03-12', NULL, 'This Book provides sufficiently strong base to our students for the purpose of Public Examinations, All Engineering Entrance and National Entrance Exams like NEET, JEE etc. ', NULL, NULL, NULL, NULL, NULL, NULL),
('978-9848477167', '9848477134', '2015-04-10', NULL, 'Inverse Trigonometric Functions', NULL, NULL, 'MOHAMMAD KHAJA SHAREEF', NULL, NULL, 'English', NULL, NULL, 3, NULL, NULL, 'Mathematics', 'Trigonometry', 'Properties', NULL, NULL, NULL, 'Science inspiration', '2015-03-12', NULL, 'This Book provides sufficiently strong base to our students for the purpose of Public Examinations, All Engineering Entrance and National Entrance Exams like NEET, JEE etc. ', NULL, NULL, NULL, NULL, NULL, NULL),
('9781634200325', '9781634200325', '2015-04-30', '', 'ç³»çµå…¨çƒæ¼å¤«ç¶²--äº’è¯ç¶²æ™‚ä»£çš„å¤§ä½¿å‘½ç•°è±¡', '', '', 'è©¹å§†æ–¯ï¼Žå¥§ï¼Žå¤§è¡›æ–¯', NULL, '', '', '', 0, 0, 0, '', 'BIOGRAPHY & AUTOBIOGRAPHY', 'BIOGRAPHY & AUTOBIOGRAPHY', 'BIOGRAPHY & AUTOBIOGRAPHY', NULL, NULL, NULL, 'åŸºç£ä½¿è€…å”æœƒ', '2015-04-01', '', NULL, '', 'é—œæ–¼æœ¬æ›¸ï¼šæˆ‘å€‘æ­£è¦‹è­‰è‘—ä¸€å ´é¾å¤§çš„ã€åœ‹éš›æ€§çš„å®£æ•™è®Šé·ï¼Œç”šè‡³æ›´ç”šæ–¼æ›´æ­£æ•™æ”¹é©ã€‚ã€Œåå„„éˆé­‚ç¶²ã€çš„å…±åŒå‰µè¾¦äººæˆ´ç¶­æ–¯åšå£«é€™æ¨£èªªï¼šã€Œæˆ‘å€‘æ­£å¾žã€Žå¾žè¥¿æ–¹åˆ°å››æ–¹ã€è®Šç‚ºã€Žå¾žæœ€ä½³åˆ°å››æ–¹ã€ã€‚ã€é€™å ´å»¿ä¸€ä¸–ç´€å…¨æ–°çš„å®£æ•™çœŸè¨€å°±æ˜¯ã€Œäººäººåƒèˆ‡ã€ã€‚ã€Šç³»çµå…¨çƒæ¼å¤«ç¶²ã€‹æ˜¯ä¸€æœ¬é—œæ–¼æ•¸åƒååŸºç£æ•™é ˜è¢–å€‘ä¿¡å¿ƒæ»¿ç›ˆã€ç„¡ç•çš„ç•°è±¡ä¹‹æ›¸ã€‚ä»–å€‘å§”èº«æ–¼å”åŒåŠªåŠ›ï¼Œé›†çœ¾å®¶ä¹‹é•·è€Œéžå–®æ‰“ç¨é¬¥ï¼Œä¾†å…±åŒå®ŒæˆåŒä¸€ç›®æ¨™ã€‚ç•¶ä½ å±•é–‹æœ¬æ›¸çš„é–±è®€ä¹‹æ—…çš„åŒæ™‚ï¼Œå°‡å¾ˆå¿«ç™¼ç¾ä½ å‰æ‰€æœªçŸ¥ã€ä»¥å…¨çƒæ•™æœƒç‚ºè‘—çœ¼çš„æ–°ä¸–ç•Œã€‚æœ¬æ›¸æ˜¯é—œæ–¼ï¼šâ€¢é ˜è¢–å€‘åŒå¿ƒå”åŠ›ã€å…±åŒå®Œæˆå¤§ä½¿å‘½â€¢ç‚ºç¥žçš„è¶…è‡ªç„¶å¤§èƒ½å°‡åœ¨ä¸–ç•Œå„åœ°å‡ºç¾è€Œå°‹æ±‚ç¥žçš„é¢â€¢æ‹¯æ•‘æœªåŠã€æœªå¾—ã€å°šç„¡æ•™æœƒçš„ç¾¤é«”ï¼Œç›´åˆ°ä»–å€‘éƒ½èƒ½é€éŽè‡ªå·±çš„èªžè¨€çŸ¥é“è€¶ç©Œæ˜¯æ•‘ä¸»â€¢å·®æ´¾é–€å¾’æ‹“å±•ç¥žçš„åœ‹åº¦â€¢åˆ†äº«è³‡æºï¼Œä½¿æ•™ç‰§é ˜è¢–å€‘èƒ½è£å‚™èµ·ä¾†ï¼Œå¥½å¯¦è¸ä»–å€‘åœ¨åœ°ä¸Šæ¯ä¸€å€‹ç¤¾ç¾¤ä¸­çš„å‘¼å¬ã€‚â€¢ç‚ºå²ä¸Šæœ€å‰å¤§çš„è±æ”¶è€Œåœ¨è²¡å‹™ä¸Šæ’­ç¨®è€•è€˜ã€Šç³»çµå…¨çƒæ¼å¤«ç¶²ã€‹æ˜¯é—œæ–¼å¹³å‡¡äººå¦‚ä½•å–å¾—éžå‡¡æˆå°±çš„æ›¸ï¼Œå®ƒåœ¨æœ‰çœ¾å¤šè³‡æºå»äº‹å€åŠŸåŠçš„äººä¸­é–“ï¼Œè¬›è¿°æœ‰äººåœ¨æœ‰é™è³‡æºçš„æƒ…æ³ä¸‹å»å¤§æœ‰ä½œç‚ºã€æ¿€å‹µäººå¿ƒçš„æ•…äº‹ã€‚çœ‹å®Œæœ¬æ›¸å¾Œï¼Œä½ å°‡ä¸å†æ»¿è¶³æ–¼ä¸€èˆ¬æ°´å¹³çš„åŸºç£å¾’ç”Ÿæ´»ã€‚', '', '', 0, 280),
('9781939251961', '9781939251961 ', '2015-05-04', '', 'å¸Œä¼¯ä¾†æ›¸(ç°¡é«”ç‰ˆ)--éº¥ç¨®è–ç¶“è¨»é‡‹', '', 'THE LETTER TO THE HEBREWS', 'æ­ç™½æ©', NULL, '', '', '', 0, 0, 0, '', 'è–ç¶“è«–å¢', 'å¸Œä¼¯ä¾†æ›¸', '', NULL, NULL, NULL, 'ç¾Žåœ‹éº¥ç¨®å‚³é“æœƒ', '2013-09-01', '', NULL, '', 'ç€åçš„å¸Œä¼¯æ¥ä¹¦å­¦è€…è®ºå¸Œä¼¯æ¥ä¹¦ã€Œå–œæ¬¢è°œå›¢çš„äººä¸€å®šå–œæ¬¢å¸Œä¼¯æ¥ä¹¦ã€‚ã€â€”è¿žå¨å»‰ï¼ˆL. Lane Williamï¼‰ï¼ŒWBCç³»åˆ—ä¹‹ã€Šå¸Œä¼¯æ¥ä¹¦ã€‹çš„ä½œè€… å¸Œä¼¯æ¥ä¹¦è™½ç„¶æ˜¯ã€Œæœ€ä¼˜ç¾Žå’Œç²¾è‡´çš„ã€ï¼Œä½†ä¹Ÿã€Œå¯èƒ½æ˜¯ç¬¬ä¸€ä¸–çºªåŸºç£æ•™ä¸­æœ€éš¾ç†è§£çš„ç»æ–‡ã€ã€‚â€”â€”è‰¾åž‚ç¦ï¼ˆH. W. Attridgeï¼‰ï¼ŒHermeneia ç³»åˆ—ä¹‹ã€Šå¸Œä¼¯æ¥ä¹¦ã€‹çš„ä½œè€… ç€åçš„å¸Œä¼¯æ¥ä¹¦å­¦è€…è®ºæœ¬æ³¨é‡Šä¹¦ã€Œæ¬§ç™½æ©å†™äº†ä¸€æœ¬ä»¤äººç€è¿·çš„å¸Œä¼¯æ¥ä¹¦æ³¨é‡Šï¼Œç‰¹åˆ«æ˜¯ä¼ é“äººã€æ•™å¸ˆã€å’Œå­¦ç”Ÿéƒ½ä¼šä»Žå®ƒå—ç›Šã€‚ä»–ä½¿ç”¨æ ¹æ®è®²è®ºåˆ†æžè€Œå¾—çš„æ´žè§ï¼Œè¯´æ˜Žè®ºè¿°é‡Œçš„è½¬æŠ˜æ˜¯å¦‚ä½•å‘ç”Ÿçš„ï¼Œå¹¶ä¸”æ¾„æ¸…è¯ é‡Šä¸ŽåŠå‹‰ä¸€èµ·è¿ä½œè€Œè¾¾æˆä½œè€…ç›®çš„çš„æ–¹å¼ã€‚è™½ç„¶åœ¨å…³é”®å¤„æœ‰å¯¹å­¦æœ¯ä¸“ä¸šäº‹é¡¹çš„è¯¦ç»†è®¨è®ºï¼Œå´ä¸ä¼šæ‰“ä¹±æ³¨é‡Šçš„è¿›å±•ã€‚ã€ â€”â€”å½¼å¾—æ£®ï¼ˆDavid Petersonï¼‰ï¼Œã€Šè¯ä¸»21ä¸–çºªåœ£ç»æ–°é‡Šã€‹ä¹‹ã€ˆå¸Œä¼¯æ¥ä¹¦ã€‰çš„ä½œè€… ã€Œæ¬§ç™½æ©çš„å¸Œä¼¯æ¥ä¹¦æ³¨é‡Šå¯¹è¿™å°ä¹¦ä¿¡çš„ç ”ç©¶çŽ°å†µä½œäº†å¹³è¡¡ä¸”åŒ…ç½—ä¸‡è±¡çš„è¯„ä¼°ï¼Œå…·æœ‰è®¸å¤šæ¸…æ–°çš„æ´žè§ã€‚è¿™æœ¬æ³¨é‡Šä¹¦ä¸è®ºåœ¨ç»†èŠ‚æˆ–æ•´ä½“ç»“æž„ä¸Šéƒ½å¾ˆæ¸…æ¥šâ‹¯â‹¯æˆ‘é«˜åº¦æŽ¨èæœ¬ä¹¦ã€‚ã€ â€”â€”è‰¾æž—æ²ƒæ€ï¼ˆPaul Ellingworthï¼‰ï¼ŒNIGNTç³»åˆ—ä¹‹ã€Šå¸Œä¼¯æ¥ä¹¦ã€‹çš„ä½œè€… ã€Œåœ¨ä¸¥è°¨çš„å­¦æœ¯ç ”ç©¶å’Œæ¸…æ™°çš„æ€æƒ³è¿™æ–¹é¢ï¼Œåªæœ‰æžå°‘æ•°çš„åœ£ç»æ³¨é‡Šä¹¦ä½œè€…ä»Žæˆ‘æ‰€å¾—çš„æ•¬é‡ä¼šè¶…è¿‡æ¬§ç™½æ©ï¼Œä»–çš„å¸Œä¼¯æ¥ä¹¦æ³¨é‡Šä¸è´Ÿæ‰€æœ›ã€‚æ¬§ç™½æ©ç²¾æ¹›åœ°ä¸Žè¿‘ä»£å­¦æœ¯æŽ¥è½¨ï¼Œä¸€å†ä»¥å‡†ç¡®çš„è§£ç»æŠ•å…¥å›°éš¾ç»æ–‡çš„è®¨è®ºä¸­ï¼Œæ¸…æ¥šåœ°è§£é‡Šä½œè€…ç”¨è¯­çš„å†…å®¹åŠå«ä¹‰ã€‚åœ¨è¿‡åŽ»äºŒåå¹´æ¥ï¼Œç”±äºŽå¯¹å¸Œä¼¯æ¥ä¹¦çš„ç ”ç©¶æ˜¾ç€å¢žåŠ ï¼Œæ–°çº¦åœ£ç»ä¸­è¿™ä¸ªæœ€éš¾è§£çš„ä¹¦å·å‡ºçŽ°è®¸å¤šå¥½çš„æ³¨é‡Šä¹¦ï¼Œé€ ç¦æ•™ä¼šã€‚ä½†æ˜¯ç‰§è€…ä»¬å¿…å®šä¼šæ¬¢è¿Žè¿™æœ¬ä¹¦ï¼Œå‘çŽ°å®ƒæœ‰ä¸°å¯Œçš„ç¥žå­¦ã€ä¸€è´¯çš„é€ å°±ã€å’Œæ ¼å¤–æœ‰å¸®åŠ©ã€‚æˆ‘å¾ˆä¹æ„æŽ¨èå®ƒã€‚ã€â€”â€”æ ¼æ€é‡Œï¼ˆGeorge Guthrieï¼‰ï¼Žå›½é™…é‡Šç»åº”ç”¨ç³»åˆ—ä¹‹ã€Šå¸Œä¼¯æ¥ä¹¦ã€‹çš„ä½œè€… ä½œè€…ä»‹ç»æ¬§ç™½æ©ï¼ˆPeter T. O''Brienï¼‰æ›¼å½»æ–¯ç‰¹å¤§å­¦åšå£«ï¼ˆPh.D., University of Manchesterï¼‰ ï¼Œæ›¾åœ¨å°åº¦å®£æ•™åå¹´ã€‚è‡ª1974è‡³2009å¹´ä»»æ•™äºŽæ¾³æ´²æ…•å°”ç¥žå­¦é™¢ï¼ˆMoore Theological Collegeï¼‰ï¼Œå¹¶ä¸”å…¼ä»»å‰¯é™¢é•¿åäº”å¹´ï¼ˆ1985-2000ï¼‰ã€‚ æ¬§ç™½æ©åšå£«è¢«æ™®ä¸–å…¬è®¤ä¸ºä¿ç½—ç›‘ç‹±ä¹¦ä¿¡â€”ä»¥å¼—æ‰€ä¹¦ã€è…“ç«‹æ¯”ä¹¦ã€ä»¥åŠæ­Œç½—è¥¿ä¹¦å’Œè…“åˆ©é—¨ä¹¦â€”çš„ä¸“å®¶ï¼Œä»–ä¸ºå…¶ä¸­æ¯ä¸€å·ä¹¦éƒ½å‡ºç‰ˆäº†æœ‰ä»½é‡çš„æ³¨é‡Šä¹¦ï¼Œã€Šä»¥å¼—æ‰€ä¹¦ã€‹å·²äºŽ2009å¹´ç”±ç¾Žå›½éº¦ç§ä¼ é“ä¼šè¯‘ä¸ºä¸­æ–‡å‡ºç‰ˆã€‚ æœ¬ä¹¦åŽŸç‰ˆä¸»ç¼–å¡æ£®ï¼ˆD. A. Carsonï¼‰å¦‚æ­¤ä»‹ç»ä»–çš„æŒšå‹æ¬§ç™½æ©ï¼šæ¬§ç™½æ©æœ‰å¤šå¹´å­¦æœ¯ç ”ç©¶ã€å®£æ•™ã€å’Œé•¿æœŸæ‹…ä»»æ¾³æ´²æ…•å°”ç¥žå­¦é™¢ï¼ˆMoore Theological Collegeï¼‰æ•™å¸ˆçš„ç»åŽ†ï¼Œäº«æœ‰å‡ ä¹Žæ˜¯ç‹¬ç‰¹çš„å£°èª‰ã€‚ä»–ä¹‹ä»¤äººä½©æœä¹ƒæ˜¯è¯¸èˆ¬ä¼˜ç‚¹çš„ç»„åˆï¼šæžç«¯ä»”ç»†åœ°å¤„ç†åœ£ç»ç»æ–‡ã€å…¬å…åœ°è°ˆè®ºä»–äººçš„è§‚ç‚¹ã€ä»–æ‰€ç‰¹æœ‰çš„ä¿å®ˆåŠ ä¸Šè¦ä»¥ç¦éŸ³ä¸ºä¸­å¿ƒçš„çƒ­å¿±ï¼Œè€ŒæŠŠè¿™ä¸€åˆ‡ç»“åˆèµ·æ¥çš„æ˜¯ï¼Œä»–é‚£æ¸©æŸ”çš„å¿ƒçµå¸å¼•äº†åŒåƒšã€å‹äººã€å’Œæ•°åå¹´æ¥çš„å­¦ç”Ÿçš„å¿ƒã€‚å³ä½¿åœ¨ç«žäº‰æ¿€çƒˆçš„å­¦æœ¯ç•Œé‡Œï¼Œä¹Ÿå¾ˆéš¾æ‰¾åˆ°ä¸€ä¸ªä¼šè¯´æ¬§ç™½æ©åè¯çš„äººã€‚', '', '', 0, 0),
('9781939251992', '9781939251992', '2015-05-04', '', 'é¦¬å¤ªç¦éŸ³(ç°¡é«”ç‰ˆ)--éº¥ç¨®è–ç¶“è¨»é‡‹', '', 'Matthew (REBC)', 'å¡æ£®', NULL, '', '', '', 0, 0, 0, '', 'è–ç¶“è«–å¢', 'é¦¬å¤ªç¦éŸ³', '', NULL, NULL, NULL, 'ç¾Žåœ‹éº¥ç¨®å‚³é“æœƒ', '2013-01-01', '', NULL, '', 'åŽ†å²å­¦å®¶é›·å—ï¼ˆE. Renanï¼‰ç§°é©¬å¤ªç¦éŸ³ä¸ºå·²ç»å†™æˆçš„æœ€é‡è¦çš„ä¹¦ã€‚ä½†æ˜¯ï¼Œè¿™å´ä¸æ˜¯ä¸€å·å®¹æ˜“ç†è§£çš„ä¹¦ã€‚å¥¥æ–¯é‚¦ï¼ˆGrant Osborneï¼‰è¯´ï¼šã€Œæ˜¯å·éš¾è§£çš„ä¹¦ï¼Œè™½ç„¶å¤§ä½“è€Œè¨€æ¯”ç¦éŸ³ä¹¦è¦å®¹æ˜“äº›ã€‚ã€ä¸­å›½è‘—åä¼ é“äººå€ªæŸå£°åˆ™è¯´ï¼šã€Œé©¬å¤ªæ˜¯å…¨éƒ¨æ–°çº¦ä¸­æœ€éš¾è¯»çš„ä¸€å·ï¼Œæ¯”å¯ç¤ºå½•éš¾åå€ï¼ã€è¦ä¸ºæœ¬ä¹¦æ’°å†™ä¸€æœ¬ä¼˜è´¨çš„æ³¨é‡Šä¹¦ï¼Œå°±éžå¡æ£®è¿™ä½èœšå£°å›½é™…çš„ä¸€æµå­¦è€…èŽ«å±žäº†ã€‚å°¤å…¶åœ¨åŽ˜æ¸…å›°éš¾çš„é—®é¢˜ä¸Šæ˜¾éœ²å‡ºæ¹›æ·±çš„å­¦å…»ã€é¢é¢ä¿±åˆ°çš„æŽ¢è®¨ã€ä¸ŽæŒå¹³å…¬å…çš„ç«‹åœºã€‚æœ¬ä¹¦ä¸ä»…å¸®åŠ©è¯»è€…æ˜Žç™½é©¬å¤ªåœ¨ç»æ–‡ä¸­çš„åŽŸæ„ï¼Œä¹Ÿå¤„ç†ä¸€èˆ¬åŸºç£å¾’å…³æ³¨çš„å„ç§è®®é¢˜â€”åŽ†å²çš„ï¼ˆå¦‚ï¼šä¸Žå…¶ä»–ç¦éŸ³ä¹¦çš„ã€Œå·®å¼‚ã€ï¼‰ã€ç¥žå­¦çš„ï¼ˆå¦‚ï¼šæˆ‘ä»¬è¿˜éœ€è¦é¡ºæœå¾‹æ³•å—ï¼Ÿï¼‰ã€ä¸Žå®žè¡Œçš„ï¼ˆå¦‚ï¼šç¦»å©šåŽå¯å¦å†å©šï¼Ÿï¼‰ã€‚ä½œè€…æŠŠåœ£ç»çš„ç»æ–‡å½“ä½œç¥žçš„è¯å¤„ç†ï¼Œä½†ä¸ä¼šè¯‰è¯¸äºŽä¸è‡ªç„¶çš„è°ƒå’Œã€æˆ–æ•¬è™”å´è´«ä¹çš„è¯ é‡Šã€‚æ—§ç‰ˆ åœ¨ http://www.bestcommentaries.com ååˆ—é©¬å¤ªç¦éŸ³æ³¨é‡Šä¹¦ç¬¬ä¸€åï¼Œä¸­æ–‡ç‰ˆæ ¹æ®2010å¹´ä¿®è®¢ç‰ˆç¿»è¯‘ã€‚å…¨æ–°ä¿®è®¢æœ¬åŒ…æ‹¬ä¸‹åˆ— ç‰¹è‰²ï¼šå…¨é¢çš„å¯¼è®ºã€æœ€æ–°çš„ç®€æ˜Žä¹¦ç›®ã€è¯¦ç»†çš„çº²è¦ã€é€æ®µé€èŠ‚å……æ»¡æ´žå¯ŸåŠ›çš„æ³¨é‡Šã€æ¯æ®µå¼€å¤´çš„ç»¼è§ˆã€æ–‡æœ¬é—®é¢˜ä¸Žç‰¹æ®Šé—®é¢˜çš„é™„åŠ æ³¨è§£ã€‚', '', '', 0, 1134),
('9789575566579', '9789575566579 ', '2015-05-04', '', 'è–ç¶“æŽ¢ç´¢IV--ç¥žæœªä¾†å°äººçš„ä½œç‚º', '', 'Godâ€™s plan for man : the key to the worldâ€™s storehouse of wisdom', 'èŠ¬å°¼æˆ´å…‹', NULL, '', '', '', 0, 0, 0, '', 'è–ç¶“è«–å¢', 'è–ç¶“ç¥žå­¸', '', NULL, NULL, NULL, 'æ©„æ¬–åŸºé‡‘æœƒ', '2012-02-01', '', NULL, '', '336é /19x26cmé€™æ˜¯å±¬æ–¼è¿½æ±‚çœŸç†è€…çš†å¿…é ˆé–±è®€çš„æ›¸ã€‚æ·ºé¡¯æ˜“æ‡‚ï¼Œå¹«åŠ©è®€è€…æ˜Žç™½è–ç¶“çœŸç†ã€‚æ›¸ä¸­æœ‰ç²¾å½©çš„æ¯é€±è–ç¶“èª²ç¨‹ï¼Œè®€å®Œæ­¤æ›¸ç­‰æ–¼ä¸Šäº†è–ç¶“å­¸é™¢äºŒå¹´çš„èª²ç¨‹ã€‚é€éŽé–±è®€ï¼Œå¿…èƒ½å¸¶ä¾†å•Ÿç¤ºä¸¦æ›´åŠ æ˜Žç™½ç¥žçš„è©±ï¼Œä½œè€…å°‡å…¶å¤šå¹´ä¾†è·Ÿéš¨ç¥žçš„å±¬éˆäº®å…‰å¤§æ–¹æ”¾å…¥ï¼Œç­‰æ–¼çµ¦äº†æ¯ä½é–±è®€æ­¤æ›¸è€…çš„æœ€ä½³ç¦®ç‰©ã€‚', '', '', 0, 336);
INSERT INTO `books` (`isbn`, `isbn10`, `insertDate`, `callNum`, `title`, `subTitle`, `altTitle`, `author`, `translator`, `audience`, `language`, `editionType`, `edtionNumber`, `amzonStar`, `amazonReviews`, `amazonRevLink`, `category`, `subCat`, `subSubCat`, `altCat`, `altSubCat`, `altSubSubCat`, `publisherName`, `pubDate`, `keywords`, `description`, `contents`, `fromBackCover`, `productFormatDetail`, `productDimensions`, `shippingWeight`, `pages`) VALUES
('9789575568139', '9789575568139', '2015-05-04', '', 'å®¶åº­çœŸç†æ•™å®¤--é’å°‘å¹´åŸºç£æ•™æ•™ç¾©å•ç­”', '', '', 'é§±çŽ«çŽ²', NULL, '', '', '', 0, 0, 0, '', 'ç”Ÿæ´»æ•™å°Ž', 'é’å°‘å¹´', '', NULL, NULL, NULL, 'æ©„æ¬–åŸºé‡‘æœƒ', '2015-04-01', '', NULL, '', '168é  / 19 x 19 cmä»€éº¼æ˜¯ç•™çµ¦å…’å¥³æœ€å¥½çš„è²¡å¯Œï¼Ÿä¸æ˜¯é‡‘éŒ¢èˆ‡æˆ¿å±‹ï¼Œè€Œæ˜¯å°ä¸Šå¸çš„èªè­˜ã€‚æœ¬æ•™ææ˜¯æä¾›çˆ¶æ¯æ•™å°Žå…’å¥³åŸºè¦çœŸç†çš„å·¥å…·ï¼Œæœ‰å¤šå…ƒä½¿ç”¨æ–¹å¼ï¸°å•ç­”æ³•ã€æŸ¥ç¶“æ³•ã€èƒŒç¶“æ³•ã€‚å…±æœ‰åèª²ï¼Œå…§å®¹åŒ…æ‹¬ï¼šä»€éº¼æ˜¯è–ç¶“ï¼Ÿã€ä¸Šå¸æ˜¯èª°ï¼Ÿã€è€¶ç©Œæ˜¯èª°ï¼Ÿã€è€¶ç©Œæ˜¯å¾©æ´»çš„ä¸»ã€è–éˆæ˜¯èª°ï¼Ÿã€è–éˆçš„å·¥ä½œã€æœ‰å¤©ä½¿å—Žï¼Ÿã€èª°å‰µé€ äº†ä¸–ç•Œå’Œäººï¼Ÿã€äººæœ‰ç½ªå—Žï¼Ÿã€äººå› ä¿¡è€Œç¨±ç¾©ã€‚æ•™ç¾©å•ç­”çš„ç‰¹é»žï¼Œæ˜¯å›žæ‡‰é’å°‘å¹´éšŽæ®µçš„ç‰¹æ®Šéœ€è¦ï¼Œä»¥è–ç¶“çš„ç¶“æ–‡å¹«åŠ©ä»–å€‘å»ºç«‹æœ‰ç³»çµ±çš„ä¿¡ä»°æ€ç¶­ã€‚æœ¬æ›¸ç‰¹è‰²â—† ã€Œæ€æƒ³æ•…äº‹ã€â€”ç‚ºæ¯èª²çš„ä¸»é¡Œæ•™ç¾©ã€ç ´é¡Œèˆ‡æ€æƒ³ï¼Œå¼•å°Žçˆ¶æ¯å¸¶é ˜å…’å¥³æ€æƒ³ç•¶æ—¥æ•™ç¾©ã€‚â—†ã€Œæ•™ç¾©å•ç­”ã€â€”ä»¥ã€Œä¸€å•ä¸€ç­”ã€æ–¹å¼ï¼Œæ˜Žç™½åŸºæœ¬æ•™ç¾©ã€‚å¯ä»¥æ˜¯çˆ¶æ¯å•ï¼Œå…’å¥³ç­”ï¼Œæˆ–è€…çˆ¶æ¯å•ï¼Œä¸€èµ·è®€ç¶“ï¼Œå…’å¥³å›žç­”ã€‚æ•™ç¾©å•ç­”å¾Œï¼Œå°‡ä¿¡ä»°æ•™ç¾©æ´»ç”¨åœ¨ç”Ÿæ´»ä¸­ã€‚â—†ã€Œæ‡‰ç”¨æ•…äº‹ã€â€”å¯¦éš›åœ°æ‡‰ç”¨æ•™ç¾©åŠç¶“æ–‡ï¼Œä¹Ÿå°å€‹äººçš„ç”Ÿæ´»ä½œå‡ºåæ€èˆ‡å›žæ‡‰ã€‚â—†ã€Œå•é¡Œæ¸¬è©¦ã€â€”è—‰è‘—å°å°æ¸¬é©—å°æ¯èª²çš„æ•™ç¾©ä½œç¶œåˆæ€§çš„ç†è§£ï¼Œå†æ¬¡æ¾„æ¸…æ­£ç¢ºçš„åƒ¹å€¼è§€å¿µï¼Œè‡´ä½¿ä¿¡ä»°çš„æ ¹åŸºæ›´æ‰Žå¯¦ç©©å›ºã€‚ç›®éŒ„è‡ªåºç¬¬ä¸€èª²  ä»€éº¼æ˜¯è–ç¶“ï¼Ÿç¬¬äºŒèª²  ä¸Šå¸æ˜¯èª°ï¼Ÿç¬¬ä¸‰èª²  è€¶ç©Œæ˜¯èª°ï¼Ÿç¬¬å››èª²  è€¶ç©Œæ˜¯å¾©æ´»çš„ä¸»ç¬¬äº”èª²  è–éˆæ˜¯èª°ï¼Ÿç¬¬å…­èª²  è–éˆçš„å·¥ä½œç¬¬ä¸ƒèª²  æœ‰å¤©ä½¿å—Žï¼Ÿç¬¬å…«èª²  èª°å‰µé€ äº†ä¸–ç•Œå’Œäººï¼Ÿç¬¬ä¹èª²  äººæœ‰ç½ªå—Žï¼Ÿç¬¬åèª²  äººå› ä¿¡è€Œç¨±ç¾©ç­”æ¡ˆå·', '', '', 0, 168),
('9789861982670', '9789861982670', '2015-05-09', '', 'JUSTæ„›éˆä¿®--YOUNGé’å°‘å¹´365å¤©é‡è¦‹ä¸»', '', 'The One Year Devotions', 'æ²™å´™è²å…’', NULL, 'é©ç”¨æ‰€æœ‰äºº', '', '', 0, 0, 0, '', 'ç”Ÿå‘½é€ å°±', 'éˆä¿®', '', NULL, NULL, NULL, 'æ ¡åœ’æ›¸æˆ¿å‡ºç‰ˆç¤¾', '0000-00-00', '', NULL, '', '400é /17x23cmå¦‚æžœä½ å¯ä»¥â€§çŸ¥é“è‡ªå·±å–œæ­¡åƒä»€éº¼èœâ€§éµå®ˆäº¤é€šè¦å‰‡ï¼Œè‡ªå·±éŽé¦¬è·¯â€§äº«å—ç¨è™•æ™‚å…‰â€§è‡ªå·±åŽ»æ›¸åº—è²·ä¸€æœ¬æ›¸ä¸¦å›žå®¶çœ‹å®Œâ€§æŒ‰ç…§è‡ªå·±æ“¬è¨‚çš„è¨ˆç•«å®Œæˆä¸€ä»¶äº‹é‚£éº¼ä½ æ‡‰è©²å¯ä»¥è²·ä¸‹æœ¬æ›¸ï¼ŒæŒ‰æ—¥å®Œæˆè®€è–ç¶“çš„ä»»å‹™ï¼Œä¸¦èƒ½æ¨‚åœ¨å…¶ä¸­ã€‚åˆ¥äººå¯ä»¥å¹«ä½ ç…®é£¯å»ä¸èƒ½å¹«ä½ åƒé£¯ï¼ŒåŒæ¨£çš„ï¼Œåˆ¥äººå¯ä»¥å‘ä½ å‚³ç¦éŸ³å»ä¸èƒ½ä»£æ›¿ä½ ä¿¡è€¶ç©Œã€‚å°æ™‚å€™ï¼Œå…’ç«¥ä¸»æ—¥å­¸çš„è€å¸«æˆ–åª½åª½èªªè–ç¶“æ•…äº‹çµ¦ä½ è½ï¼Œä½†å³ä½¿æ˜¯ä»–å€‘ï¼Œä¹Ÿä¸èƒ½ä»£æ›¿ä½ è®€è–ç¶“ã€ä»£æ›¿ä½ ç¦±å‘Šã€‚å¸Œæœ›ä½ èƒ½äº«å—è–éˆçš„é™ªä¼´ï¼Œæ¯å¤©è®€è–ç¶“ã€æ¯å¤©ç¦±å‘Šï¼Œç„¶å¾Œä¸€å¤©æ¯”ä¸€å¤©æ›´èªè­˜ç¥žã€æ›´æ„›ç¥žã€‚ç¥‚æœ‰å¤šéº¼å¥‡å¦™ï¼Œä½ ä¾†çœ‹çœ‹å°±çŸ¥é“ã€‚å¦‚æžœä½ æƒ³è·Ÿè€¶ç©ŒåŸºç£å»ºç«‹è¦ªå¯†ã€ç©©å®šæˆé•·çš„é—œä¿‚ï¼Œå°±ä¸èƒ½ä¸æ³¨é‡ç´°ç¯€ã€‚ç¥žçŸ¥é“ä½ æ˜¯å¤§å¿™äººï¼Œç¥‚çš„ç”¨æ„ä¸æ˜¯ä»¥ç‘£äº‹ä¾†åŠ é‡ä½ çš„è² æ“”ï¼Œä½¿ä½ éˆå‘½å—æŒ«è€Œçµ‚è‡³æ£„å®ˆã€‚ç¥‚çœŸæ­£è¦æˆ‘å€‘æ³¨æ„çš„ï¼Œåªæœ‰å…©å€‹é‡è¦çš„ç´°ç¯€ï¼š1.è¦å°‡è‡ªå·±ç»çµ¦ç¥žï¼Œå°±å¾—æ¯«ç„¡ä¿ç•™ã€‚2.è¦å°‡è‡ªå·±ç»çµ¦ç¥žï¼Œå°±è¦æ¯å¤©èˆ‡ç¥‚è¦ªè¿‘ã€‚æŽ¥ä¸‹ä¾†é€™ä¸€å¹´ï¼Œå°±è®“æˆ‘å€‘å°ˆå¿ƒåšå¥½é€™å…©ä»¶å°äº‹å§ï¼Œç¾åœ¨å°±å°‡å®ƒè¨‚ç‚ºæ–°å¹´æ–°å¸Œæœ›å¦‚ä½•ï¼Ÿå¦‚æžœä½ èƒ½æ’ä¸‹åŽ»â”€â”€ä¸€å¹´ä¸­æ¯å¤©ä¾†èµ´æ­¤ç´„â”€â”€é‚£éº¼åˆ°æ˜Žå¹´æ­¤æ™‚ï¼Œä½ ä¸ä½†èƒ½æœ‰åè¶³çš„æŠŠæ¡ï¼ŒçŸ¥é“è©²å¦‚ä½•å’ŒåŸºç£å»ºç«‹è¦ªå¯†é—œä¿‚ï¼Œè€Œä¸”ä¸€å®šå·²ç¶“èˆ‡ç¥‚æ›´è¦ªè¿‘äº†ã€‚', '', '', 0, 400),
('9789861984193', '9789861984193', '2015-05-03', '', 'æˆ´å¾·ç”Ÿèˆ‡ç‘ªéº—äºž(å…§åœ°æœƒå‰µç«‹150é€±å¹´ç´€å¿µç‰ˆ)ï¼Hudson Taylor and Maria', '', '', 'è’²æ¨‚å…‹', NULL, '', '', '', 0, 0, 0, '', 'è¦‹è­‰å‚³è¨˜ï¼å‚³è¨˜', 'BIBLES', '', NULL, NULL, NULL, 'æ ¡åœ’æ›¸æˆ¿å‡ºç‰ˆç¤¾', '2014-12-01', '', NULL, '', '356é /14.8(W)x21(H)cmå…§åœ°æœƒå‰µç«‹150é€±å¹´ç´€å¿µç‰ˆæ˜¯ä»–ï¼Œæ¯…ç„¶æ‰“ç ´å¸¸è¦ï¼Œæˆç«‹è¶…å®—æ´¾å·®æœƒï¼Œé–‹å‰µå®£æ•™æ–°å±€ï¼æ˜¯ä»–ï¼Œå‘¼å¬è—é ˜æ–°è¡€ï¼Œä¸€æ”¹å®£æ•™ç²¾è‹±ä¸»ç¾©ï¼Œèµ°ä¸€æ¢æ–°è·¯ï¼æ˜¯ä»–ï¼Œä¸æ»¿è¶³æ–¼åœç•™é€šå•†å£å²¸ï¼Œå …æŒè¦è®“ç¦éŸ³æ·±å…¥å…§åœ°ï¼ä»–æ˜¯æˆ´å¾·ç”Ÿï¼Œä¸­åœ‹å…§åœ°æœƒçš„å‰µè¾¦äººã€‚åœ¨å®£æ•™å²ä¸Šï¼Œæˆ´å¾·ç”Ÿèˆ‡ä¸­åœ‹å…§åœ°æœƒçš„æˆå°±æœ‰ç›®å…±ç¹ï¼›ç„¶è€Œï¼Œå°‘æœ‰äººçŸ¥çš„æ˜¯ï¼Œåœ¨æ„Ÿæƒ…çš„äº‹ä¸Šï¼Œç”Ÿæ€§è„†å¼±æ•æ„Ÿçš„æˆ´å¾·ç”Ÿå»åƒè¶³è‹¦é ­ã€‚ç‚ºäº†æ»¿è¶³è¢«æ„›çš„æ¸´æ±‚ã€æ¶ˆé™¤å…§å¿ƒçš„å¯‚å¯žï¼Œä»–å¸¸è¼•æ˜“åœ°å‘äººç¤ºæ„›ï¼Œå› è€Œåœ¨è¢«æ‹’çµ•çš„ç—›è‹¦æˆ–å°æ–¹ç„¡æ³•æ”¯æŒå…¶å‘¼å¬çš„æŽ™æ‰Žä¸­æµé€£ã€‚ç›´åˆ°é‡è¦‹ç‘ªéº—äºžï¼Œä»–çµ‚æ–¼åšåˆ°å…©æƒ…ç›¸æ‚…çš„æ¬£å–œï¼Œä¸æ–™åå°è²æµªå»æŽ’å±±å€’æµ·è€Œä¾†â€¦â€¦æœ¬æ›¸ä¸åƒ…æå¯«ä¸€ä½å®£æ•™å£«çš„å‚³å¥‡ç”Ÿæ¶¯èˆ‡æ¢å¼˜è²¢ç»ï¼Œä¹Ÿæ¥µå…¶ç´°ç·»åœ°åˆ»åŠƒä»–å…§åœ¨æ€§æ ¼çš„è½‰è®Šã€‚ç•¶ä¸Šå¸è¦ä½¿ç”¨ä¸€å€‹äººï¼Œç¥‚æœƒç”¨æœ€æ„æƒ³ä¸åˆ°çš„æ–¹å¼åŽ»æ¨¡å¡‘ã€‚ã€Œç‘ªéº—äºžçš„ä¿¡ä»°æ­·ç¨‹æ˜¯å¾ªåºæ¼¸é€²çš„ã€‚å¥¹ä½¿ä»–çš„ä¿¡å¿ƒæ›´å¹³ç©©ï¼Œä»–å‰‡ä½¿å¥¹çš„ä¿¡ä»°æ›´æ·±åˆ»ã€‚å¥¹é›–ç„¶å€‹æ€§æº«å’Œï¼Œå»ä¸ä½¿ä»–çš„ç†±å¿ƒæ¸›å¼±ï¼›å¥¹æ´»æ½‘è°æ…§çš„å€‹æ€§ï¼Œä¹Ÿä½¿ä»–é€æ¼¸æ“ºè„«æŠ‘é¬±çš„æ€§æƒ…ã€‚è‹¥æ²’æœ‰ç‘ªéº—äºžå¾žæ—å”åŠ©ï¼Œæˆ´å¾·ç”Ÿä¸å¯èƒ½é †åˆ©æŽ¨å±•ä»–ä¸€ç”Ÿçš„å·¥ä½œã€‚ã€â”€â”€è’²æ¨‚å…‹', '', '', 0, 356),
('9789861984346', '9789861984346', '2015-04-29', '', '21ä¸–ç´€ç¥žå­¸äº‹ä»¶ç°¿--å¦‚ä½•åœ¨å¤šå…ƒè™•å¢ƒä¸‹åšç¥žå­¸', '', 'A Theological Event Book for the 21st Century: How to Do Theology in a Pluralistic Context?', 'è¬æœ¨æ°´', NULL, '', '', '', 0, 0, 0, '', 'ANTIQUES & COLLECTIBLES', 'ANTIQUES & COLLECTIBLES', 'ANTIQUES & COLLECTIBLES', NULL, NULL, NULL, 'æ ¡åœ’æ›¸æˆ¿å‡ºç‰ˆç¤¾', '2015-02-02', '', NULL, '', '368é /16(w)x22(h)cmèº«è™•å¤šå…ƒçš„21ä¸–ç´€ï¼Œä¸Šå¸ä¾èˆŠä¸»å‹•è¡Œå‹•èˆ‡è¨€èªªï¼Œæ¿€ç™¼æˆ‘å€‘é€²è¡Œç¥žå­¸æ€è€ƒï¼Œå›žæ‡‰äº‹ä»¶ï¼é€éŽå…«å€‹å›žæ­¸è–ç¶“æ™ºæ…§çš„ç¥žå­¸æ€è€ƒï¼Œé‡æ–°ç™¼ç¾æˆ‘å€‘æ™‚ä»£çš„äº‹ä»¶ï¼Œæ˜¯è–éˆèˆ‡äººçš„äº¤æœƒï¼Œæ˜¯ä»–è€…èˆ‡æˆ‘çš„äº¤æœƒï¼Œæ˜¯åŸºç£èˆ‡ä¸–äººçš„äº¤æœƒã€‚æˆ‘å€‘æ´»åœ¨ä¸€å€‹è¢«äº‹ä»¶é©…å‹•çš„æ™‚ä»£ã€‚æŽ€é–‹äºŒåä¸€ä¸–ç´€åºå¹•çš„911äº‹ä»¶ï¼Œæ’¼å‹•äº†ä¸–äººå°å®—æ•™çš„æƒ³åƒï¼›ä¼Šæ–¯è˜­åœ‹çš„èˆˆèµ·ï¼ŒæŒ‘æˆ°è¥¿æ–¹å´‡å°šçš„æ”¿æ²»ç†æƒ³ï¼›æŠ—çˆ­æˆ¿åƒ¹å±…é«˜ä¸ä¸‹çš„éŠè¡Œæ´»å‹•ï¼Œæ¿€ç™¼å‡ºå±…ä½æ­£ç¾©èˆ‡æ–°è‡ªç”±ä¸»ç¾©å°æŠ—çš„æ–°ç‰ˆåœ–ï¼›é£›å®‰äº‹æ•…é »å‚³ï¼Œé£›èˆªç’°å¢ƒèˆ‡å®‰æª¢åˆ¶åº¦çš„è¨Žè«–æµ®ä¸Šæª¯é¢ï¼›åŠ£è³ªæ²¹å“çš„çˆ†ç™¼ï¼Œé£Ÿå®‰å•é¡Œå‚™å—é‡è¦–ã€‚å¤§è‡³å…¨çƒç¤¾æœƒï¼Œå°è‡³å€‹äººæ°‘ç”Ÿï¼Œäº‹ä»¶ä¸€ç™¼ç”Ÿï¼Œæ€è€ƒä¾¿ç™¼å‹•ã€‚æ€è€ƒçš„ç´ æä¿¯æ‹¾å³æ˜¯ï¼Œç„¶è€Œè³‡è¨Šå¿«é€Ÿã€åˆ†æ•£ã€å¤šæ¨£ï¼Œå»ä¹Ÿé€ æˆæ€è€ƒçš„ç¢Žè£‚åŒ–èˆ‡ç‰‡æ–·åŒ–ã€‚ç½®èº«å…¨çƒåŒ–ã€åª’é«”åŒ–ã€å¤šå…ƒåŒ–ã€è¤‡é›œåŒ–çš„ä¸–ç•Œï¼Œç©¶ç«Ÿè©²å¦‚ä½•æ‰¾åˆ°ä¸€ç¨®æ•´åˆæ€ç¶­çš„æ–¹æ³•ï¼ŸåŸºç£å¾’åˆç•¶å¦‚ä½•æ–¼å„æ¨£è™•å¢ƒä¸‹ï¼Œèšç„¦äº‹ä»¶åˆè¶…è¶Šäº‹ä»¶é€²è¡Œç¥žå­¸æ€è€ƒï¼Ÿæœ¬æ›¸ä¸­ï¼Œè¬æœ¨æ°´åšå£«æ·±å…¥çˆ¬æ¢³æ·±å—å•Ÿè’™é‹å‹•å½±éŸ¿çš„ç¾ä»£ä¸»ç¾©æ€æ½®ç‰¹å¾µï¼Œå˜—è©¦ç‚ºäºŒåä¸€ä¸–ç´€çš„çœ¾å¤šäº‹ä»¶å°‹æ‰¾æ ¹æºï¼Œä¸¦ä¸”æ±²å–çŒ¶å¤ªåŸºç£æ•™æ€æƒ³å®¶çš„ç²¾è¯ï¼Œäºˆä»¥ä¸€ä¸€å›žæ‡‰ã€‚ä»–ä¼åœ–å¾žå¤šå…ƒæ··é›œã€ç™¾å®¶çˆ­é³´çš„å¾Œç¾ä»£ä¸–ç•Œï¼Œå»ºæ§‹ä¸€æ¢åœ¨å¤šå…ƒè™•å¢ƒä¸‹åšç¥žå­¸çš„é“è·¯ï¼Œå‘¼ç±²æƒŸæœ‰é‡å›žå¸Œä¼¯ä¾†å¼çš„è–ç¶“æ™ºæ…§ï¼Œæ‰èƒ½æ•´åˆç†æ€§èˆ‡ä¿¡å¿ƒã€è‡ªç„¶èˆ‡æ©å…¸ã€å®¢è§€èˆ‡ä¸»è§€ã€ç§‘å­¸èˆ‡ä¿¡ä»°ã€çŸ¥è­˜èˆ‡éˆæ€§ã€æ•™ç¾©èˆ‡å€«ç†é–“çš„äºŒå…ƒå°ç«‹æ€ç¶­å›°å¢ƒã€‚é€™ä¸æ˜¯ä¸€ä½ç¥žå­¸äººç¨ç™½å¼çš„ç¥žå­¸æ€è€ƒäº‹ä»¶ç°¿ï¼Œè€Œæ˜¯èžåˆäº†è–ç¶“æ™ºæ…§ã€æ•™æœƒæ­·å²ã€æ™‚ä»£è™•å¢ƒã€å‰µæ„æ€ç¶­ã€å¤šå…ƒæºé€šï¼Œç»çµ¦é¢å°è®Šå‹•ä¸­çš„äºŒåä¸€ä¸–ç´€ï¼Œæœ‰å¿—å°‡ç¥žå­¸åŒ–ç‚ºè¡Œå‹•çš„è®€è€…ä¸€æœ¬çµ•ä½³çš„æ–¹æ³•å­¸æŒ‡å¼•ï¼Œå¸¶æˆ‘å€‘èµ°å‡ºç½é ­å¼ä¿¡ä»°ã€‚', '', '', 0, 368),
('9789861984391', '9789861984391 ', '2015-04-29', '', 'ç‰§è€…çš„ç¿±ç¿”--ç•¢å¾·ç”Ÿçš„40å€‹ç‰§é¤Šç­†è¨˜', '', 'The Pastor: A Memoir', 'ç•¢å¾·ç”Ÿ', NULL, '', '', '', 0, 0, 0, '', 'BIBLES', 'BIBLES', '', NULL, NULL, NULL, 'æ ¡åœ’æ›¸æˆ¿å‡ºç‰ˆç¤¾', '2015-05-01', '', NULL, '', '416é /15(W)x22.4(H)cmé£›è¡Œå¤§å¸«çš„ç¿±ç¿”ç§˜ç¬ˆï¼Œè®“ä½ çš„å±¬éˆç”Ÿå‘½å±•ç¿…é«˜é£›é€™ä¸–ç•Œä¸Šæœ‰ç¨®ç”Ÿç‰©ï¼Œå«åšäººé¡žï¼Œä»–å€‘ç”Ÿä¾†å°±æ¸´æœ›é£›è¡Œã€‚äººé¡žçš„ä¸–ç•Œå……æ»¿å¤§å¤§å°å°çš„æ•…äº‹ï¼Œè€Œé€™äº›æ•…äº‹ï¼Œå‰‡æ˜¯ä»–å€‘çš„é£›è¡Œå™¨ã€‚å¦‚æžœä½ é è¿‘é»žçœ‹ï¼Œæœƒç™¼ç¾æœ‰äº›äººé›–ç„¶é£›å¾—é«˜ï¼Œå»é£›ä¸é ï¼›å¦æœ‰äº›äººï¼Œæ€Žéº¼é£›éƒ½é£›ä¸èµ·ä¾†ï¼Œæˆ–æ˜¯æ‰å‰›èµ·é£›å°±æŽ‰ä¸‹ä¾†ã€‚ä¸éŽï¼Œå¦‚æžœä½ æ›´ä»”ç´°çœ‹ï¼Œé‚„èƒ½ç™¼ç¾é›¶é›¶æ˜Ÿæ˜Ÿå¹¾å€‹äººï¼Œä»–å€‘é£›å¾—è‡ªåœ¨è€Œå„ªé›…ï¼Œä½ å¿ä¸ä½å¥½å¥‡ä»–å€‘ç”¨çš„æ˜¯ä»€éº¼é£›è¡Œå™¨ï¼Ÿç•¢å¾·ç”Ÿå°±æ˜¯å…¶ä¸­ä¸€ä½å„ªé›…çš„ç¿±ç¿”è€…ã€‚ä»–çŸ¥é“ï¼Œè¦é£›å¾—é«˜åˆé ï¼Œå¿…é ˆè¦æœ‰ä¸€å€‹åˆç”¨çš„é£›è¡Œå™¨ï¼Œèƒ½å¤ æ‰¿è¼‰é£›è¡Œè€…çš„é‡é‡ï¼Œè€Œä¸”å …å›ºç²¾è‰¯ï¼Œåœ¨é‡åˆ°æš´é¢¨é›¨æˆ–äº‚æµæ™‚ï¼Œä¸ä½†ä¸æœƒææ¯€ï¼Œé‚„èƒ½ä¹˜é¢¨è€Œä¸Šï¼Œæ„ˆé£›æ„ˆé«˜ã€‚é€™å€‹åˆç”¨çš„é£›è¡Œå™¨å°±æ˜¯è–ç¶“çš„æ•…äº‹ã€‚è–ç¶“çš„æ•…äº‹å¤ å¤§å¤ è±å¯Œï¼Œèƒ½è®“æˆ‘å€‘ç™¼å±•å‡ºä¸€ç¨®å…·æœ‰é˜²ç¦¦æ€§çš„æƒ³åƒåŠ›ï¼Œåœ¨é¢å°æ—¥å¸¸ç”Ÿæ´»çš„å›°å¢ƒæ™‚ï¼Œä¸ä½†ä¸æœƒè¢«æ“Šå€’ï¼Œé‚„èƒ½ä¹˜è‘—é€™äº›äº‹ä»¶ï¼Œè¿Žé¢¨è€Œä¸Šã€‚é€™æœ¬æ›¸è¨˜è¼‰äº†ç•¢å¾·ç”Ÿé£›è¡Œçš„æ•…äº‹ã€‚ä»–é£›è¡Œçš„å ´åœ°å’Œå¤§å¤šæ•¸äººä¸€æ¨£ï¼Œæ˜¯å¹³å‡¡çš„é€±é–“ã€æ˜¯å¤«å¦»çš„ç›¸è™•ã€æ˜¯æœ‹å‹é–“çš„æ‰“é¬§ã€æ˜¯æ•™æœƒè£¡çš„å¤§å°äº‹æƒ…ï¼Œä½†é€éŽè–ç¶“æ•…äº‹æä¾›çš„é£›è¡Œå™¨ï¼Œä»–åœ¨ç‰§è€…ç”Ÿæ´»çš„å¿™äº‚ä¸­ï¼Œæ…¢æ…¢å­¸æœƒå¦‚ä½•åœ¨è€¶ç©Œå’Œè–éˆçš„åŒåœ¨ä¸­ï¼Œè‡ªåœ¨é£›ç¿”ï¼Œæœ€å¾Œæˆç‚ºèˆ‰ä¸–èžåçš„ç¿±ç¿”ç‰§è€…ã€‚é–±è®€é€™æœ¬æ›¸ï¼Œä½ æœƒç™¼ç¾ï¼Œä½ çš„é£›è¡Œå™¨æ…¢æ…¢è®Šå¾—è·Ÿä»¥å‰ä¸ä¸€æ¨£ã€‚é›–ç„¶è·‘é“ä¸Šé‚„æ˜¯æœ‰è¨±å¤šéšœç¤™ï¼Œä½†ç•¶ä½ ä½é€²è–ç¶“çš„ä¸–ç•Œï¼Œé€™äº›éšœç¤™ç‰©è®Šæˆä¸€é™£é™£çš„é¢¨ï¼ŒæŽ¨è‘—ä½ ä¸€é»žä¸€æ»´å‘æ›´è±ç››çš„ç”Ÿå‘½é«˜é£›ã€‚', '', '', 0, 416),
('9789865809911', '9789865809911 ', '2015-05-05', '', 'å¾®å…‰ä¸­è·³èˆž', '', '', 'ç†å¯Ÿï¼Žå²æ±€æ–¯,ç‘žå¦®ï¼Žå²æ±€æ–¯', NULL, 'é©ç”¨æ‰€æœ‰äºº', '', '', 0, 0, 0, '', 'ç¦éŸ³ä½ˆé“', 'æ–‡é¸', '', NULL, NULL, NULL, 'é“è²å‡ºç‰ˆç¤¾', '2015-03-01', '', NULL, '', 'ç­”æ‡‰æˆ‘ï¼Œä½ å°‡çµ¦ä¿¡å¿ƒä¸€æ¬¡å¥®æˆ°çš„æ©Ÿæœƒã€‚ç•¶ä½ å¿…é ˆé¸æ“‡ååœ¨ä¸€æ—è§€çœ‹æˆ–æ˜¯èµ·èº«ä¸Šå ´è·³èˆžæ™‚ï¼Œæˆ‘å¸Œæœ›ä½ é¸æ“‡å¾Œè€…ï¼Œè·³èˆžå§ï¼  ä¸–ç•Œä¸Šæœ‰æ•¸ç™¾è¬äººç”Ÿæ´»åœ¨æ­»äº¡é‚Šç·£ï¼Œç¼ºä¹é£Ÿç‰©å’Œæ°´ç­‰ç”Ÿå­˜åŸºæœ¬éœ€æ±‚ï¼Œæ›´åˆ¥æé†«ç™‚ç…§è­·ã€å—æ•™è‚²çš„æ©Ÿæœƒï¼Œæˆ–æ˜¯å¾žäº‹ä»»ä½•ç¶“æ¿Ÿæ´»å‹•çš„å¯èƒ½æ€§ã€‚ç†æŸ¥å’Œç‘žå¦®å¤«å©¦åŽ»åˆ°ä¸–ç•Œä¸Šæœ€ä¸èµ·çœ¼åˆé™é çš„åœ°æ–¹ï¼Œèµ°é€²é€™ç¾¤äººçš„ç”Ÿæ´»ï¼Œç”¨å¿ƒå‚¾è½èˆ‡äº†è§£çœŸå¯¦çš„ç”Ÿå‘½æ•…äº‹ã€‚ å‡ºä¹Žæ„æ–™åœ°ï¼Œé€™ç¾¤äººåœ¨æŸäº›æ–¹é¢å»éžå¸¸å¯Œè¶³ï¼Œç”šè‡³è¶³ä»¥æˆç‚ºæˆ‘å€‘çš„å°Žå¸«ï¼Œæ•™å°Žæˆ‘å€‘å¦‚ä½•ç”Ÿæ´»ã€æ„›èˆ‡è¢«æ„›ã€å…‹æœé›£é—œï¼Œé‚„æœ‰æ­¡æ¨‚è®šç¾Žã€‚å¾žçƒå¹²é”å¥³å­©ç‘ªæ ¼èŽ‰ç‰¹æ•£ç™¼å‡ºå …æ¯…çš„é¥’æ•åŠ›é‡ï¼›å› è²§å›°è€Œè¢«è¿«æˆç‚ºæ€§å·¥ä½œè€…çš„å°šæ¯”äºžå¹´è¼•åª½åª½ï¼Œå°‡å‰›å‡ºç”Ÿçš„å¥³å…’å‘½åç‚ºã€Œæ›´å¤šç¥ç¦ã€ï¼›å—ä¹¾æ—±å¨è„…çš„é¦¬æ‹‰å¨å©¦å¥³ç‚ºäº†æ–°çš„é¤Šæ®–å ´æ­¡æ¬£è·³èˆžã€‚å¦‚æžœæˆ‘å€‘èŠ±ä¸€é»žæ™‚é–“äº†è§£ä»–å€‘çš„ç”Ÿæ´»ï¼Œä¸€å®šæœƒä¸ç”±å¾—ç‚ºè‡ªå·±æ‰€æ“æœ‰çš„æ„Ÿè¬ï¼Œæ›´æ¸…æ¥šè¦å¦‚ä½•éŽé€™ä¸€ç”Ÿã€‚ é€™æ˜¯ä¸€æœ¬å€¼å¾—çè—çš„æ›¸ã€‚ç…§ç‰‡è£¡çš„æ¯ä¸€å€‹çœ¼ç¥žã€æ¯ä¸€æŠ¹å¾®ç¬‘ï¼Œæ¯ä¸€æ»´çœ¼æ·šéƒ½æ˜¯çè²´çš„å½±åƒï¼Œæ¯ç¯‡æ•…äº‹éƒ½æ˜¯æ´»åœ¨ç¾ä»£ä¿¡å¿ƒå·¨äººçš„è¦‹è­‰ã€‚æœ¬æ›¸ä½œè€…å¸¶è‘—æˆ‘å€‘åŽ»åˆ°é‚£äº›è¢«æˆ°äº‚ã€é¥‘è’ã€è²§çª®ã€ç–¾ç—…ã€åœ°éœ‡ã€é¢¶é¢¨æ‘§æ®˜çš„åœ°æ–¹ï¼Œèµ°é€²é‚£äº›äººçš„ç”Ÿæ´»ï¼Œçœ‹è¦‹ä»–å€‘å¦‚ä½•å¾žå—åŠ©è€…æˆç‚ºå¹«åŠ©è€…ï¼Œæ¿€å‹µæˆ‘å€‘ï¼Œç¹¼çºŒæˆç‚ºå‚³éžæ„›èˆ‡æ©å…¸çš„äººã€‚', '', '', 0, 0),
('9789868406155', '9789868406155', '2015-05-03', '', 'æ‹“è’.æ¤å ‚.ç¥žè¹Ÿ', '', '', 'å³å¾·è– å£è¿°.ä½•æ›‰æ±.æŽéº—è/æ•´ç†', NULL, '', '', '', 0, 0, 0, '', 'è¦‹è­‰å‚³è¨˜ï¼è¦‹è­‰', 'BIBLES', '', NULL, NULL, NULL, 'æ™®ä¸–è±ç››ç”Ÿå‘½ä¸­å¿ƒ              ', '2015-03-01', '', NULL, '', 'æœäº‹ä¸»äº”åé€±å¹´ 50+50è¦‹è­‰æ„Ÿæ©å‚³è¨˜', '', '', 0, 0),
('9789868443518', '9789868443518', '2015-05-03', '', 'æ¦®è€€çš„å…‰è¼--ç¾…ç‚³æ£®å¸«æ¯å‚³è¨˜ï¼Radiant Glory', '', '', 'è³ˆå¾·ç´', NULL, '', '', '', 0, 0, 0, '', 'è¦‹è­‰å‚³è¨˜ï¼å‚³è¨˜', 'BIBLES', '', NULL, NULL, NULL, 'éŒ«å®‰å ‚å‡ºç‰ˆç¤¾', '0000-00-00', '', NULL, '', '354é /20.6Ã—14.6cmæœ¬æ›¸ä¸»è§’ç¾…ç‚³æ£®å¸«æ¯çš„åŒå·¥å…§å‹’å¤ªå¤ªï¼Œå¾—æ‚‰è³ˆå¾·ç´ç‰§å¸«æ­£åœ¨æ’°å¯«é€™æœ¬ç¾…ç‚³æ£®å¸«æ¯çš„å‚³è¨˜æ™‚ï¼Œèªªï¸°ã€Œä½ è¦åœ¨æ¦®è€€è£¡å¯«å®ƒï¼Œå› ç‚ºç¾…ç‚³æ£®å¸«æ¯çš„ä¸€ç”Ÿæ•£ç™¼è‘—æ¦®è€€çš„å…‰è¼ã€‚ã€é€™æ˜¯é€™æœ¬æ›¸åçš„ä¾†æºã€‚ç¾…ç‚³æ£®å¸«æ¯åœ¨é€™å€‹ä¸–ç´€åˆè–éˆå¤§æ¾†çŒä¸­ï¼Œç¶“æ­·äº†è–éˆçš„æµ¸ï¼Œé€™å€‹ç¶“æ­·çš„ä¸­å¿ƒæ„ç¾©â€”è€¶ç©Œè¦å®Œæ»¿åœ°å½°é¡¯ç¥‚çš„åŒåœ¨åœ¨äººèº«ä¸Šçš„ç•°è±¡ï¼Œæ·±æ·±åœ°æŠ“ä½å¥¹ï¼Œæ‰€ä»¥å¥¹ä¸è¨ˆä»£åƒ¹åŠªåŠ›è¿½æ±‚ä¸»ï¼Œä¸»ä¹Ÿä¿¡å¯¦åœ°å¸¶è‘—ç¥‚ä¸€åˆ‡çš„è±æ»¿èˆ‡æ»¿è¶³çš„å–œæ¨‚è‡¨åˆ°å¥¹ã€‚å¥¹çš„ç¶“æ­·æˆç‚ºèˆ‡å¥¹åŒä¸€æ™‚ä»£ï¼Œä»¥åŠå¾Œä¾†å¹¾å€‹ä¸–ä»£ï¼Œè¨±å¤šè–å¾’å¥‡ç«—çš„ç¥ç¦ã€‚è¨±å¤šåœ¨ç¦¾å ´ä¸Šè¢«ä¸»é‡ç”¨çš„ç¥žåƒ•äººä½¿å¥³ï¼Œå› è‘—å¥¹çš„æœäº‹è€Œè¶ŠéŽç”Ÿå‘½ä¸­çš„éšœç¤™ï¼Œä½¿ä»–å€‘é€²å…¥å……æ»¿æ©è†çš„ç”Ÿæ´»èˆ‡äº‹å¥‰ä¸­ã€‚ä¹Ÿæœ‰è¨±å¤šç¥žçš„å…’å¥³ï¼Œå› è‘—è®€é€™æœ¬æ›¸ï¼Œåœ¨å¿ƒä¸­å‡èµ·å°è€¶ç©Œçš„æ¸´æ…•ï¼Œå¾žè€Œèµ·ä¾†ç«­åŠ›è¿½æ±‚ç¥‚ï¼Œä¹Ÿè¢«å¸¶å…¥èˆ‡ç¥žåŒåœ¨çš„æ¦®è€€ç¾Žåœ°ï¼›å…¶ä¸­ä¹Ÿæœ‰æˆ‘å€‘é€™äº›åœ¨å°ç£çš„è–å¾’ã€‚æ·±é¡˜æœ¬æ›¸çš„å†ç‰ˆï¼Œå«æ›´å¤šäººè’™ç¦ï¼Œè¦è¿½æ±‚è®“åŸºç£å®Œå…¨ä½”æœ‰æˆ‘å€‘çš„éˆé­‚èº«é«”ï¼Œä»¥é å‚™åŸºç£æ¦®è€€çš„å†ä¾†ã€‚', '', '', 0, 354),
('9789868812604', '9789868812604', '2015-05-09', '', 'å…ˆè³¢æ‰€ä¿¡â”€æ—©æœŸæ•™æœƒå²è©±', '', '', 'å‘‚æ²›æ·µ', NULL, 'é©ç”¨æ‰€æœ‰äºº', '', '', 0, 0, 0, '', 'æ•™æœƒæ­·å²', 'æ•™æœƒæ­·å²æ¦‚è«–', '', NULL, NULL, NULL, 'æ”¹é©å®—ç¿»è­¯ç¤¾', '2012-02-01', '', NULL, '', 'æœ¬æ›¸ä»¥ã€Œå²è©±ã€æ–¹å¼ï¼Œæ·±å…¥æ·ºå‡ºæ•˜è¿°æ—©æœŸæ•™æœƒçš„æ­·å²äº‹å¯¦ã€äººç‰©ç”Ÿå¹³ã€äº‹ä»¶é‹å‹•ï¼Œç‰¹åˆ¥æ³¨é‡è–ç¶“æ•™ç¾©çš„è§£é‡‹èˆ‡æ­£çµ±ä¿¡ä»°çš„å‚³æ‰¿ã€‚ã€Œé‘’å¾€çŸ¥ä¾†ã€å°è™•æ–¼å¾Œç¾ä»£çš„ä»Šæ—¥æ•™æœƒï¼Œæ˜¯èµ·æ­»å›žç”Ÿçš„è‰¯è—¥ã€‚ã€Œè«–å¤èªªä»Šã€çš„ç›®çš„ï¼Œåœ¨æ–¼å¹«åŠ©ä»Šæ—¥è¯äººæ•™æœƒæ­¸å›žè–ç¶“æ­£çµ±ä¿¡ä»°ï¼Œçœ‹é‡æ•™æœƒçš„ä½¿å‘½å‚³æ‰¿ï¼›å¾žéŽåŽ»ç¥žå­æ°‘çš„è¡€æ·šæŽ™æ‰Žï¼Œå­¸åˆ°å¯¶è²´çš„æ•™è¨“ï¼ŒæŒå®ˆçœŸé“å‹‡æ–¼æ­¸æ­£ã€‚', '', '', 0, 0),
('9789869175319', '9789869175319 ', '2015-04-30', '', 'åœ¨æ„›èˆ‡å¸Œæœ›ä¸­é“åˆ¥â€•å‚³é”å‡ºå€‹äººæƒ…æ„Ÿçš„å‘Šåˆ¥èˆ‡è¿½æ€å„€å¼', '', '', 'ç¾…ç‰¹.å²å¨å¡åˆè‘—', NULL, '', '', '', 0, 0, 0, '', 'BIBLES', 'BIBLES', '', NULL, NULL, NULL, 'å—èˆ‡åŒ—å‡ºç‰ˆç¤¾', '2015-04-01', '', NULL, '', 'è—‰ç”±æœ¬æ›¸å……æ»¿äººæ€§åŒ–çš„å‘Šåˆ¥å¼è¨­è¨ˆå»ºè­°ï¼Œç‚ºæ‘¯æ„›çš„è¦ªå‹çƒ™ä¸‹æœ€ç¾Žçš„è¶³è·¡ï¼Œè®“æœ€çµ‚çš„é“åˆ¥æˆç‚ºæœ€å¤§çš„ç¥ç¦ï¼äººå€‘æœƒé€éŽå„ç¨®ç·Šæ€¥æ‡‰è®Šæ–¹æ¡ˆï¼Œä¾†ç‚ºå¯èƒ½æœƒé¢å°è¨±å¤šç„¡æ³•é è¦‹çš„äº‹ä»¶åšæº–å‚™â€§ä½†å°æ–¼è¦ªäººçš„æ­»äº¡ï¼Œæˆ–ç”šè‡³è‡ªå·±çš„æ­»äº¡ï¼Œç¾ä»£äººä¸€èˆ¬éƒ½æ¥µåº¦æ¬ ç¼ºå……åˆ†çš„æº–å‚™ï¼Œåˆ°äº†é‚£å€‹é—œéµæ™‚åˆ»ï¼Œæˆ‘å€‘ä¸çŸ¥é“è©²æ€Žéº¼è¾¦ã€‚è®“äº¡è€…å®¶å±¬å…·é«”é¢å°ä¸¦æ·±æ€æ­»äº¡çš„ç¾å¯¦ï¼Œä¸ä½†éžå¸¸æœ‰å¹«åŠ©ï¼Œä¹Ÿå¾ˆé‡è¦ï¼Œè€Œé€éŽè¦ªè‡ªåƒèˆ‡å–ªç¦®èˆ‡äº‹å‰æº–å‚™çš„ç›¸é—œäº‹å®œï¼Œå°¤å…¶èƒ½å¤ ç™¼æ®é€™æ¨£çš„ä½œç”¨ã€‚å› ç‚ºï¼Œã€ŒçœŸæ­£çš„å¹¸ç¦ä¹ŸåŒ…æ‹¬æ­»äº¡ã€ã€‚ç„¡è«–è‡¨çµ‚è€…æ˜¯åœ¨å®¶è£¡ã€é†«é™¢ã€è€äººå®‰é¤Šé™¢æˆ–å®‰å¯§ç—…æˆ¿åŽ»ä¸–ï¼Œé‡è¦çš„æ˜¯ã€Œå‘Šåˆ¥ã€é€™å€‹å„€å¼ã€‚å‘Šåˆ¥ä½æ–¼ä¸€å€‹éŽç¨‹çš„é–‹ç«¯ï¼Œåœ¨é€™å€‹éŽç¨‹çš„æœ€å¾Œï¼Œæ‰€æœ‰ç›¸é—œçš„äººæœƒç¶“é©—åˆ°ï¼Œæ­»äº¡ä¸ä»£è¡¨çµæŸï¼Œåè€Œæ˜¯ä¸€ç¨®éŽæ¸¡ï¼›è—‰è‘—å®ƒï¼Œæˆ‘å€‘èˆ‡éŽä¸–è¦ªå‹é–‹å§‹ä¸€ç¨®ä¸ä¸€æ¨£ã€æ°¸æ†ä¸”ç‰¢ä¸å¯ç ´çš„é—œä¿‚ã€‚', '', '', 0, 95),
('9789881544599', '9789881544599', '2015-05-04', '', 'å¤«å¦»ç›¸è™•60å•', '', 'Spousal Relationship 60 Qs ', 'ç¨‹è’™æ©', NULL, '', '', '', 0, 0, 0, '', 'ç”Ÿæ´»æ•™å°Ž', 'å©šå§»', '', NULL, NULL, NULL, 'ä¸»æ©å‡ºç‰ˆç¤¾', '2012-06-01', '', NULL, '', '160é /ã€Œæˆ‘å€‘å¤«å¦»ä¹‹é–“å¸¸å› å°äº‹åµæž¶ï¼Œæ€Žéº¼è¾¦ï¼Ÿã€ã€Œæˆ‘å€‘å¤«å¦»å¸¸å¸¸ç›¸å°ç„¡è¨€ï¼Œè¦ºå¾—éžå¸¸ä¹å‘³ï¼Œè©²æ€Žéº¼è¾¦ï¼Ÿã€ã€Œæˆ‘ç™¼ç¾ä¸ˆå¤«æœ‰å©šå¤–æƒ…ï¼Œå…§å¿ƒéžå¸¸ç—›è‹¦ï¼Œè©²æ€Žéº¼è¾¦ï¼Ÿã€ä¸–é¢¨æ—¥ä¸‹ï¼Œå¾ˆå¤šå¤«å¦»åç›®æˆä»‡ï¼Œé›¢å©šæ”¶å ´ã€‚æœ¬æ›¸åˆ—èˆ‰å…­åæ¢æœ‰é—œå¤«å¦»æ–¼ä¸åŒéšŽæ®µç¢°åˆ°çš„å•é¡Œï¼Œä¸¦æŒ‰ç…§è–ç¶“çš„æ•™å°Žå…·é«”è§£ç­”ï¼Œæœ‰åŠ©ä¿¡å¾’æ”¹å–„å¤«å¦»é—œä¿‚ã€äº«å—ç¾Žæ»¿å©šå§»ï¼Œä½¿ç¥žå¾—è‘—æ¦®è€€ã€‚', '', '', 0, 160),
('9789881620354', '9789881620354', '2015-04-30', '', 'é€ƒäº¡è€…', '', '', 'å¼µä¼¯ç¬ ', NULL, '', '', '', 0, 0, 0, '', 'BIOGRAPHY & AUTOBIOGRAPHY', 'BIOGRAPHY & AUTOBIOGRAPHY', '', NULL, NULL, NULL, 'è¯å®£ç¸½ä»£ç†', '2013-04-01', '', NULL, '', '365é /é€™æ˜¯ä¸€éƒ¨ç¶“å…¸ä¹‹ä½œã€‚å¼µä¼¯ç¬ é®®æ´»çš„å›žæ†¶çµ¦æˆ‘å€‘å‘ˆç¾äº†æ»¿æœ‰ç”Ÿå‘½åƒ¹å€¼çš„çœŸå¯¦æƒ…ç¯€â€¦â€¦ä»–å¤±åŽ»äº†ä¸€åˆ‡â€”â€”å ªç‚ºä½³ä½œï¼å®ƒç”Ÿå‹•åœ°è¨´èªªäº†äººç”Ÿçš„è¿½æ±‚ã€‚ é»Žå®‰å‹(Andrew J.Nathan)ç¾Žåœ‹å“¥å€«æ¯”äºžå¤§å­¸æ”¿æ²»å­¸æ•™æŽˆ é‚£äº›ç›²ç›®æŽ¥å—ä¸­åœ‹æ”¿åºœå®£ç¨±ä»£è¡¨ä¸­åœ‹çš„â€œä¸­åœ‹äººâ€ç‰¹åˆ¥éœ€è¦ä¾†é–±è®€é€™æœ¬æ›¸ã€‚é€™æœ¬æ›¸ä¸­é‚£äº›æ™®é€šäººï¼Œæ…·æ…¨ã€å®‰éœï¼Œä»–å€‘ä¹Ÿæ˜¯ä¸­åœ‹çš„ä»£è¡¨ã€‚ æž—åŸ¹ç‘ž (Perry Link), ç¾Žåœ‹æ™®æž—æ–¯é “å¤§å­¸æ±äºžç ”ç©¶å­¸æ•™æŽˆ æ€Žèƒ½å¿˜è¨˜å¤©å®‰é–€å»£å ´ä¸Šé‚£ä¸€ç¾¤è¢«æ”¿åºœç”¨å¦å…‹éŽ®å£“çš„å‹‡æ•¢çš„å­¸ç”Ÿï¼Ÿä»–å€‘çš„èº«å½±æ—©å·²è¢«åª’é«”å‚³éå¤©ä¸‹ã€‚ç¶“éŽäº†å…©å€‹æ˜ŸæœŸçš„éš”é›¢ï¼Œè»éšŠéŽ®å£“äº†å­¸ç”Ÿçš„æŠ—è­°ï¼Œæ®ºå®³äº†è¨±å¤šå­¸ç”Ÿï¼Œä¸¦ä¸”ç™¼å‡ºé€šç·ä»¤é€®æ•å­¸é‹é ˜è¢–ï¼Œå…¶ä¸­åŒ…æ‹¬äº†å¼µä¼¯ç¬ ã€‚ç¶“éŽäº†å…©å¹´çš„é€ƒäº¡ï¼Œå¼µä¼¯ç¬ â€”â€”åœ¨å­¸é‹é ˜è¢–ä¸­ï¼ŒæƒŸæœ‰ä»–é€ƒè„«äº†è¿½æ•ã€‚é€™ä¹Ÿæ„å‘³è‘—ä»–è¢«è¿«é›¢é–‹ä»–æ‰€æ„›çš„ç¥–åœ‹ã€æƒœåˆ¥ä»–çš„å¦»å­å’Œå¹¼å°çš„å¥³å…’ã€‚åœ¨ç©¿è¶Šå†°å¤©é›ªåœ°çš„ä¸­è˜‡é‚Šå¢ƒçš„é€”ä¸­ï¼Œå‰è˜‡è¯è¾²æ°‘æ•‘äº†ä»–çš„æ€§å‘½ï¼Œä»–çµ‚æ–¼é€ƒå‡ºäº†å……æ»¿å±éšªçš„ä¸­åœ‹é‚Šå¢ƒè’é‡Žä¹‹åœ°ã€‚å”¯æœ‰é‚£è¶…å‡¡çš„æ„å¿—åŠ›ï¼Œä¿ƒä½¿å¼µä¼¯ç¬ å¥”å‘äº†è‡ªç”±ã€‚ã€Šé€ƒäº¡è€…ã€‹é€™æœ¬æ›¸â€”â€”å…·æœ‰æ­·å²å…±é³´çš„ä½œå“ ï¼ï¼ä»–çš„æ•…äº‹èƒ½å¤ å¾žäººçš„å¿ƒéˆæ·±è™•æ›´æ–°ä½ çš„ä¿¡å¿ƒã€‚æ‘˜å¼•è‡ªç¾Žåœ‹ã€Šè¥¿è’™ï¼èˆ’æ–¯ç‰¹å‡ºç‰ˆç¤¾ã€‹(Simon & Schuster)', '', '', 0, 365),
('9789881827920', '9789881827920', '2015-05-04', '', 'å©šå§»äººäººéƒ½ç•¶å°Šé‡(ä¿®è¨‚ç‰ˆ)', '', '', 'å”å´‡æ¦®', NULL, '', '', '', 0, 0, 0, '', 'ç”Ÿæ´»æ•™å°Ž', 'å©šå§»', '', NULL, NULL, NULL, 'å”å´‡æ¦®åœ‹éš›ä½ˆé“åœ˜              ', '2010-06-01', '', NULL, '', '155é /æˆ€æ„›ã€çµå©šã€å®¶åº­ç”Ÿæ´»å¿…è®€é—œæ–¼å©šå§»å®¶åº­çš„æ¬Šå¨è‘—ä½œå©šå§»äººäººéƒ½ç•¶å°Šé‡æ˜¯ã€Œé›™æ–™ã€çš„å©å’ï¼Œçµå©šèˆ‡å¦ï¼Œéƒ½è¦å°Šé‡å©šå§»ã€‚é€™æ¨£ï¼Œä¸çµå©šçš„äººä¸èƒ½ä»¥ç‚ºä»–å€‘æ¯”çµå©šçš„äººæ›´è–æ½”è€Œè¼•çœ‹çµå©šçš„äººï¼›çµå©šçš„äººä¹Ÿä¸èƒ½è¼•çœ‹æ²’æœ‰çµå©šçš„äººã€‚è‹¥æ˜¯å¯èƒ½ï¼Œäººäººéƒ½è¦çµå©šï¼Œå› ç‚ºå©šå§»æ˜¯ä¸Šå¸è¨­ç«‹çš„ï¼Œæ˜¯ä¸Šå¸ç‚ºäººé å‚™çš„ã€‚æœ¬æ›¸ç‚ºå”å´‡æ¦®åšå£«æ­¸æ­£ç¦éŸ³åœ‹éš›è§£ç¶“è¬›åº§ï¼å¸Œä¼¯ä¾†æ›¸ç¬¬åä¸‰ç« ç¬¬å››ç¯€ä¹‹è¬›é“å…§å®¹ã€‚', '', '', 0, 155),
('9789889974992', '9789889974992', '2015-05-01', '', 'è¡çªèˆ‡å’Œè«§--ç¥žå­¸.è–ç¶“åŠå¯¦è¸çš„åæ€', '', '', 'é»ƒçŽ‰æ˜Ž.æŽæ–‡è€€.é«˜éŠ˜è¬™', NULL, '', '', '', 0, 0, 0, '', 'æ•™æœƒæ­·å²', 'æ–‡ç»ä¿¡æ¢', 'é©ç”¨æ‰€æœ‰äºº', NULL, NULL, NULL, 'å»ºé“ç¥žå­¸é™¢', '2014-11-01', '', NULL, '', 'å»ºé“115å‘¨å¹´ç»ç¦®è¡çªèˆ‡å’Œè«§â€”â€”ç¥žå­¸ã€è–ç¶“åŠå¯¦è¸çš„åæ€å»ºé“ç¥žå­¸é™¢å‰µæ ¡115å‘¨å¹´è«–æ–‡é›†è¡çªèˆ‡å’Œè«§ï¼Œå¾€å¾€å–æ±ºæ–¼äººèˆ‡äººä¹‹é–“çš„åƒ¹å€¼å·®ç•°ã€‚ä½œç‚ºåŸºç£å¾’ï¼Œæˆ‘å€‘å¦‚ä½•èˆ‡å¤šå…ƒçš„ç¤¾æœƒæ—ç¾£å»ºç«‹é—œä¿‚ï¼Œå±•ç¾ä¸Šå¸æ‰€å‰µé€ çš„çœŸæˆ‘ï¼Ÿæœ¬è«–æ–‡é›†ä¹ƒå»ºé“ç¥žå­¸é™¢å„å­¸ç³»è€å¸«å¾žè–ç¶“ã€æ­·å²ã€ç¥žå­¸ã€æ–‡åŒ–å’Œç‰§é¤Šç­‰ä¸åŒçš„è§’åº¦åæ€æœ‰é—œèª²é¡Œï¼Œè®“ä¸–äººå¾—è¦‹åŸºç£ä¿¡ä»°çš„è±å¯Œèˆ‡ä¸Šå¸çš„æ¦®ç¾Žã€‚', '', '', 0, 0),
('9862771704', '9862771704 ', '2015-05-05', '', 'ä½¿å¾’ä¸­å¿ƒ', '', '', 'æ¦®æ’’å¡', NULL, 'é©ç”¨æ‰€æœ‰äºº', '', '', 0, 0, 0, '', 'å¯¦è¸ç¥žå­¸', 'æ•™æœƒ', '', NULL, NULL, NULL, 'å¤©æ©å‡ºç‰ˆç¤¾', '2015-05-01', '', NULL, '', '164é /14.8Ã—21cmä»¥ä½¿å¾’ä¸­å¿ƒå»ºé€ ç¥žçš„æ•™æœƒï½žæˆ‘å€‘å¾žä½¿å¾’è¡Œå‚³å¾—çŸ¥åˆä»£æ•™æœƒå¤§æœ‰èƒ½åŠ›ï¼Œä¿¡å¾’è¿…é€Ÿè²«ç©¿ç¤¾æœƒå„å€‹å±¤é¢ï¼Œä¸¦ä¸”ä¸æ–·æ“´å¼µåˆ°æ–°çš„é ˜åŸŸã€‚ç‚ºä»€éº¼åˆä»£æ•™æœƒé€™éº¼æœ‰é­„åŠ›ï¼Ÿæˆ‘å€‘å°æ•™æœƒçš„çœ‹æ³•ï¼Œä»¥åŠï¼»ç¶“ç‡Ÿæ•™æœƒçš„æ–¹å¼ï¼½èˆ‡æ–°ç´„æ¨¡å¼æ˜¯å¦å»åˆï¼Ÿåˆä»£æ•™æœƒé‹ä½œæˆæ•ˆå“è‘—çš„å¼ï½žï¼»ä½¿å¾’ä¸­å¿ƒï¼½ï¼Œä½¿æˆ‘å€‘çœ‹è¦‹ä½•è¬‚æ•™æœƒçš„æœ¬è³ªã€æ•™æœƒè©²å¦‚ä½•é‹ä½œï¼Œä»¥åŠå¦‚ä½•é‹ç”¨æ–°ç´„æ•™æœƒçš„åŽŸå‰‡ã€‚ï¼»ä½¿å¾’ä¸­å¿ƒï¼½çš„èˆˆèµ·èˆ‡å¤§æ”¶å‰²å’Œç¥žåœ‹çš„å¿«é€ŸæŽ¨å±•æœ‰ç›´æŽ¥çš„é—œä¿‚ã€‚æœ¬æ›¸æ‰¼è¦é—¡é‡‹å…¶åŠŸèƒ½ï½ž.æˆç‚ºåŸ¹è¨“ä¸­å¿ƒ.æ˜¯ç¦éŸ³ä¸­å¿ƒåŠç¥žè¹Ÿä¸­å¿ƒ.ä¿ƒä½¿æ•´å€‹å€åŸŸçš„å¤©é–€æ•žé–‹.æ˜¯å®¶æ•™æœƒèˆ‡è·å ´æ•™æœƒçš„èšé›†é»ž.å…¶å­˜åœ¨ä¿ƒæˆå·®æ´¾å¹«åŠ©æˆ‘å€‘é‹ç”¨ä½¿å¾’ä¿ç¾…å»ºç«‹[æ•™æœƒ]çš„æ¨¡å¼åŠåž‹æ…‹ï½žï¼»ä½¿å¾’ä¸­å¿ƒï¼½ï¼Œå‹‡å¾€ç›´å‰ï¼Œçªç ´ç¾ç‹€ï¼Œé€²å…¥ç¥žæ‰€å‘½å®šçš„æ–°äº‹ï¼Œè®“ç¥žåœ‹éš¨è‘—æˆ‘å€‘çš„è…³è¹¤æ“´å¼µï¼', '', '', 0, 164),
('9868313503', '9868313503', '2015-05-09', '', 'åŠ çˆ¾æ–‡åŸºç£æ•™è¦ç¾©(å…¨2å†Š)', '', 'Institutes of the Christian Religion', 'ç´„ç¿°åŠ çˆ¾æ–‡', NULL, 'é©ç”¨æ‰€æœ‰äºº', '', '', 0, 0, 0, '', 'ç¥žå­¸é¡ž', 'ç³»çµ±ç¥žå­¸æ¦‚è«–', '', NULL, NULL, NULL, 'åŠ çˆ¾æ–‡å‡ºç‰ˆç¤¾', '0000-00-00', '', NULL, '', '1500é /ä¸Šä¸‹å†Šï¼Œå››å·ï¼Œç´„ç¿°åŠ çˆ¾æ–‡åœ¨1509å¹´ç”Ÿæ–¼æ³•åœ‹ï¼Œæ˜¯æ”¹é©é‹å‹•ä¸­ä¸€ä½æ·±å—æ„›æˆ´å’Œå¤§æœ‰å½±éŸ¿åŠ›çš„ç¥žå­¸å®¶ã€‚ä»–åœ¨å·´é»Žå¤§å­¸æ”»è®€ï¼Œå—åˆ°äººæ–‡ä¸»ç¾©è€…çš„å½±éŸ¿ã€‚å¾Œä¾†ï¼ŒåŠ çˆ¾æ–‡åœ¨å¥§çˆ¾è‰¯ç ”è®€æ³•å¾‹ï¹”åˆåˆ°å¸ƒçˆ¾æ—¥æ”»è®€ã€‚1534å¹´ï¼Œä»–èˆ‡å¾©åŽŸæ´¾(Protestantism)èªåŒï¼Œä¹‹å¾Œè¢«è¿«é›¢é–‹æ³•åœ‹ã€‚ç•¶æ™‚åŠ çˆ¾æ–‡ä¾†åˆ°ç‘žå£«çš„å·´è‰²ï¼Œåªæœ‰äºŒåå…­æ­²ï¼Œå®Œæˆäº†æ´‹æ´‹å·¨è‘—ã€ŠåŸºç£æ•™è¦ç¾©ã€‹(Institutes of the Christian Religion)ï¼Œæ˜¯ä¸€éƒ¨å‘æ³•åœ‹çš‡å¸ç¶­è­·åŸºç£æ•™çš„è‘—ä½œã€‚é€™éƒ¨å·¨è‘—å¾Œä¾†å¹¾ç¶“ä¿®è¨‚ï¼Œæœ€å¾Œå®šç¨¿å››å¤§å·¨å†Šï¼Œå…±å…«åç« ã€‚ åŠ çˆ¾æ–‡è¢«è­½ç‚ºç¬¬ä¸€å€‹ç”¨ç§‘å­¸æ–¹æ³•è§£é‡‹è–ç¶“çš„äººã€‚ä»–å»ºç«‹èµ·ç¥žçš„ä¸»æ¬Šçš„ç¥žå­¸ï¼Œé€™ç¥žå­¸ä¸»å°Žäº†æ­æ´²å’Œè˜‡æ ¼è˜­çš„æ”¹é©å®—æ•™æœƒ(Reformed Church)çš„æ€æƒ³ã€‚å·ä¸€ ä¸Šå¸ :             1-5ç« ï¼šä¸Šå¸å­˜åœ¨6-11ç« ï¼šä¸Šå¸çš„å•Ÿç¤ºï¼šè–ç¶“12-14ç« ï¼šä¸Šå¸èˆ‡å¶åƒä¹‹è¾¨15-18ç« : ä¸Šå¸çš„è­·ç†å·äºŒ äººèˆ‡åŸºç£ 1-6ç« äººæ€§7-11ç« : å¾‹æ³•èˆ‡ç¦éŸ³12-17ç« : åŸºç£çš„æœ¬æ€§èˆ‡å·¥ä½œå·ä¸‰ æ•‘æ©1-5ç« : ä¿¡å¿ƒã€æ‚”æ”¹èˆ‡è´–ç½ª6-10ç« : åŸºç£å¾’çš„ç”Ÿæ´»11-19ç« : å› ä¿¡ç¨±ç¾©20ç« : ç¦±å‘Š21-25ç« : æ€é¸èˆ‡é å®šå·å›› æ•™æœƒ1-4ç« : æ•™æœƒçš„æœ¬æ€§5-8ç« : ç¾…é¦¬å…¬æ•™æœƒæ‰¹åˆ¤9-13ç« : æ•™æœƒçš„æ¬Šå¨14-19ç« : è–ç¦®', '', '', 0, 1500);

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE IF NOT EXISTS `branches` (
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
  `emailAddress` varchar(100) NOT NULL,
  PRIMARY KEY (`organID`,`branchID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `custID` int(11) NOT NULL AUTO_INCREMENT,
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
  `deals` tinyint(1) DEFAULT NULL,
  `numOverdue` int(11) DEFAULT NULL,
  `numAbuse` int(11) DEFAULT NULL,
  `numLost` int(11) DEFAULT NULL,
  `numFines` int(11) DEFAULT NULL,
  `amtFine` float DEFAULT NULL,
  PRIMARY KEY (`custID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`custID`, `firstName`, `middleName`, `lastName`, `altName`, `telephoneNumber`, `otherPhone`, `addrStNum`, `addrL2`, `city`, `state`, `zip`, `latitude`, `longtitude`, `emailAddress`, `password`, `cardNumber`, `cardType`, `cardName`, `cardExp`, `cardCode`, `billingAddr`, `paypalNum`, `homeLib`, `notify`, `deals`, `numOverdue`, `numAbuse`, `numLost`, `numFines`, `amtFine`) VALUES
(1, 'siri', NULL, 'g', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'g.srisirisha@gmail.com', 'siri', '333566667', 'VISA', 'bookstore', '0000-00-00', '665', '4443gggfr', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Lixin', '', 'Fu', NULL, '3362561137', '3362561137', '167 Petty Building, UNCG', '', 'Greensboro', 'NC', '27402', NULL, NULL, 'lfu@uncg.edu', '123', '55611', 'Amex', 'lixin', '2017-01-01', '000', '167 Petty Building, UNCG', '', 'vid library', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'sirisha', '', 'g', NULL, '', '', '3202 ddyhff', NULL, 'Greensboro ', 'nc', '27412', NULL, NULL, 's_gurram@uncg.edu', 'siri', '6890544790', 'VISA', '6890544790', '0000-00-00', '123', '4788 cfuihh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'madhavi', '', 'unnam', NULL, '', '', 'newgarden rd', 'greensboro', 'greensboro', 'NC', '27410', NULL, NULL, 'madhuunnam@gmail.com', 'txuLcQzF', '1234567892', 'Visa', 'Madhu', '2015-08-01', '123', '3312 battleground', '', 'Madhavi Bookstore', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'Madhu', '', 'U', NULL, '', '', '555', 'jefferson', 'gso', 'AS', '28888', NULL, NULL, 'm_unnam@gmail.com', '09876', '123', 'Amex', 'abc', '2015-12-01', '222', '123 at greensboro', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'shashankj', '', 'muttineni', NULL, '', '', 'sdjkdfu sdfgsejifh', '', 'raleigh', 'NC', '12253', NULL, NULL, 'xyz@test.com', '123', '167256237846', 'Amex', 'hdgfseyu', '2015-01-01', '686', '123 dhfgserui ', '', 'UNCG bookstore', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'sri', '', 'kod', NULL, '', '', '123 chapel hill road', '', 'Raleigh', 'NC', '27604', NULL, NULL, 'srikodali9@gmail.com', '123', '1234567890', 'Amex', 'sri kodali', '2021-09-05', '1111', '123 chapel hill road', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'Nancy', '', 'Green', NULL, '', '', '123 jksdfhsdj ', '', 'raleigh', 'NC', '27401', NULL, NULL, 'nlgreen@gmail.com', '123', '1234567890', 'Amex', 'Green', '0000-00-00', '1111', '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `custreviews`
--

CREATE TABLE IF NOT EXISTS `custreviews` (
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
  `status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`storeID`,`isbn`,`idx`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`storeID`, `storeName`, `isbn`, `idx`, `privateCallNum`, `bookCondition`, `condDesc`, `quantity`, `salesPrice`, `rentPrice`, `rentDuration`, `holderID`, `holdDate`, `status`) VALUES
(1, 'UNCG Bookstore', '978-0486121178', 0, '7832', 'new', 'good', 20, 150, 50, 15, NULL, NULL, NULL),
(1, 'UNCG Bookstore', '978-0486474178', 0, '123', 'new', 'excellent', 10, 75, 25, 15, NULL, NULL, NULL),
(1, 'UNCG Bookstore', '978-0756672287', 0, '', '', '', 19, 135, 65, 5, NULL, NULL, ''),
(1, 'UNCG Bookstore', '978-0785287973', 0, '456', 'new', 'good', 20, 50, 30, 20, NULL, NULL, NULL),
(1, 'UNCG Bookstore', '978-0785688673', 0, '999', 'new', 'good', 20, 65, 35, 15, NULL, NULL, NULL),
(1, 'UNCG Bookstore', '978-0848736575', 0, '125', 'new', 'good', 13, 55, 25, 15, NULL, NULL, NULL),
(1, 'UNCG Bookstore', '978-1118146069', 0, NULL, 'new', 'good', 10, 105, 67, 15, NULL, NULL, NULL),
(1, 'UNCG Bookstore', '978-1145676099', 0, NULL, 'new', 'good', 9, 105, 67, 15, NULL, NULL, NULL),
(1, 'UNCG Bookstore', '978-1234567890', 0, NULL, 'new', 'good', 19, 105, 67, 15, NULL, NULL, NULL),
(1, 'UNCG Bookstore', '978-1263869120', 0, NULL, 'new', 'good', 10, 105, 65, 15, NULL, NULL, NULL),
(1, 'UNCG Bookstore', '978-1428365762', 0, NULL, 'new', 'good', 15, 120, 80, 15, NULL, NULL, NULL),
(1, 'UNCG Bookstore', '978-1456368172', 0, NULL, 'new', 'good', 14, 105, 67, 15, NULL, NULL, NULL),
(1, 'UNCG Bookstore', '978-2867409485', 0, '6777', 'new', 'good', 12, 105, 67, 15, NULL, NULL, NULL),
(1, 'UNCG Bookstore', '978-3474005685', 0, '788', 'new', 'good', 12, 45, 20, 15, NULL, NULL, NULL),
(1, 'UNCG Bookstore', '978-6054860445', 0, NULL, 'new', 'good', 13, 105, 67, 15, NULL, NULL, NULL),
(1, 'UNCG Bookstore', '978-8586474939', 0, NULL, 'new', 'good', 14, 105, 67, 15, NULL, NULL, NULL),
(2, 'UNCG Lib', '978-1234567890', 0, NULL, 'old', 'good', 8, 30, 15, 15, NULL, NULL, NULL),
(2, 'UNCG Lib', '978-1263869120', 0, NULL, 'new ', 'good', 14, 55, 20, 15, NULL, NULL, NULL),
(4, 'Scuppernong Books', '978-0848736575', 0, NULL, 'new', 'good', 8, 100, 80, 15, NULL, NULL, NULL),
(4, 'Scuppernong Books', '978-1145676099', 0, NULL, 'new', 'good', 9, 120, 85, 15, NULL, NULL, NULL),
(4, 'Scuppernong Books', '978-1234567890', 0, NULL, 'new', 'good', 16, 76, 45, 15, NULL, NULL, NULL),
(5, 'The Last Bookstore', '978-0486474178', 0, NULL, 'new', 'good', 16, 150, 75, 15, NULL, NULL, NULL),
(5, 'The Last Bookstore', '978-1263869120', 0, NULL, 'new', 'good', 16, 95, 67, 15, NULL, NULL, NULL),
(5, 'The Last Bookstore', '978-1456368172', 0, NULL, 'new', 'good', 16, 85, 65, 15, NULL, NULL, NULL),
(5, 'The Last Bookstore', '978-2867409485', 0, NULL, 'new', 'average', 17, 150, 90, 15, NULL, NULL, NULL),
(6, 'Skylight Books', '978-0486121178', 0, NULL, 'new', 'good', 18, 89, 52, 15, NULL, NULL, NULL),
(6, 'Skylight Books', '978-1263869120', 0, NULL, 'new', 'good', 18, 60, 25, 15, NULL, NULL, NULL),
(6, 'Skylight Books', '978-1428365762', 0, NULL, 'old', 'but good', 12, 60, 20, 15, NULL, NULL, NULL),
(7, 'The Library Store', '978-0486474178', 0, NULL, 'new', 'good', 18, 78, 43, 15, NULL, NULL, NULL),
(7, 'The Library Store', '978-3474005685', 0, NULL, 'new', 'good', 18, 76, 21, 15, NULL, NULL, NULL),
(7, 'The Library Store', '978-6054860445', 0, NULL, 'new', 'good', 13, 55, 47, 15, NULL, NULL, NULL),
(8, 'Silver Lake Library', '978-2867409485', 0, NULL, 'new', 'good', 16, 63, 33, 15, NULL, NULL, NULL),
(8, 'Silver Lake Library', '978-6054860445', 0, NULL, 'old', 'good', 13, 42, 24, 15, NULL, NULL, NULL),
(9, 'store1', '978-0486121178', 0, NULL, 'poor', 'good', 15, 65, 25, 15, 9, '2015-04-14', NULL),
(9, 'store1', '978-0486474178', 0, NULL, 'good', 'good', 10, 100, 65, 15, 2, '2015-04-14', NULL),
(9, 'store1', '978-0848736575', 0, NULL, 'excellent', 'good', 20, 125, 75, 15, NULL, NULL, NULL),
(9, 'store1', '978-1263869120', 0, NULL, 'old', 'good', 15, 75, 35, 15, 1, '2015-04-14', NULL),
(9, 'store1', '978-1590282410', 0, NULL, 'fair', 'good', 15, 55, 25, 15, NULL, NULL, NULL),
(9, 'store1', '978-1598633740', 0, NULL, 'new', 'good', 15, 90, 35, 15, NULL, NULL, NULL),
(10, 'store2', '978-1145676099', 0, NULL, 'excellent', 'good', 12, 160, 65, 15, NULL, NULL, NULL),
(10, 'store2', '978-1234567890\n', 0, NULL, 'good', 'good', 8, 80, 30, 15, NULL, NULL, NULL),
(10, 'store2', '978-1428365762', 0, NULL, 'new', 'good', 8, 60, 30, 15, NULL, NULL, NULL),
(10, 'store2', '978-2867409485', 0, NULL, 'fair', 'good', 10, 60, 30, 15, NULL, NULL, NULL),
(10, 'store2', '978-6054860445', 0, NULL, 'new', 'good', 8, 60, 30, 15, NULL, NULL, NULL),
(11, 'store3', '978-1234567890', 0, NULL, 'new', 'good', 14, 95, 45, 15, NULL, NULL, NULL),
(11, 'store3', '978-1263869120', 0, NULL, 'old', 'good', 9, 60, 30, 15, NULL, NULL, NULL),
(11, 'store3', '978-1428365762', 0, NULL, 'fair', 'good', 12, 67, 35, 15, NULL, NULL, NULL),
(11, 'store3', '978-3474005685', 0, NULL, 'poor', 'good', 5, 45, 20, 15, NULL, NULL, NULL),
(11, 'store3', '978-6054860445', 0, NULL, 'good', 'good', 14, 90, 35, 15, NULL, NULL, NULL),
(12, 'store4', '978-0486121178', 0, NULL, 'excellent', 'good', 8, 70, 40, 15, NULL, NULL, NULL),
(12, 'store4', '978-0486121178', 1, NULL, 'poor', 'good', 8, 70, 40, 15, NULL, NULL, NULL),
(12, 'store4', '978-1234567890', 0, NULL, 'fair', 'good', 8, 70, 40, 15, NULL, NULL, NULL),
(12, 'store4', '978-1590282410', 0, NULL, 'new', 'good', 8, 70, 40, 15, NULL, NULL, NULL),
(12, 'store4', '978-6054860445', 0, NULL, 'new', 'good', 5, 135, 75, 15, NULL, NULL, NULL),
(13, 'store5', '978-0486121178', 0, NULL, 'excellent', 'good', 8, 70, 40, 15, NULL, NULL, NULL),
(13, 'store5', '978-1428365762', 0, NULL, 'poor', 'good', 5, 70, 40, 15, NULL, NULL, NULL),
(13, 'store5', '978-1598633740', 0, NULL, 'fair', 'good', 8, 70, 40, 15, NULL, NULL, NULL),
(13, 'store5', '978-2867409485', 0, NULL, 'good', 'good', 8, 70, 40, 15, NULL, NULL, NULL),
(14, 'store6', '978-0486121178', 0, NULL, 'fair', 'good', 14, 75, 25, 15, NULL, NULL, NULL),
(14, 'store6', '978-1263869120', 0, NULL, 'new', 'good', 15, 135, 65, 15, NULL, NULL, NULL),
(14, 'store6', '978-1428365762', 0, NULL, 'new', 'good', 15, 135, 65, 15, NULL, NULL, NULL),
(14, 'store6', '978-2867409485', 0, NULL, 'new', 'good', 8, 120, 55, 15, NULL, NULL, NULL),
(15, 'store7', '978-1118146069', 0, NULL, 'excellent', 'good', 8, 60, 40, 15, NULL, NULL, NULL),
(15, 'store7', '978-1234567890', 0, NULL, 'poor', 'good', 8, 50, 40, 15, NULL, NULL, NULL),
(15, 'store7', '978-1598633740', 0, NULL, 'old', 'good', 8, 75, 25, 15, NULL, NULL, NULL),
(15, 'store7', '978-2867409485', 0, NULL, 'good', 'good', 5, 95, 45, 15, NULL, NULL, NULL),
(16, 'store8', '794-2867409485', 0, NULL, 'excellent', 'good', 20, 135, 65, 15, NULL, NULL, NULL),
(16, 'store8', '978-1118146069', 0, NULL, 'fair', 'good', 25, 95, 45, 15, NULL, NULL, NULL),
(16, 'store8', '978-1234567890', 0, NULL, 'poor', 'good', 15, 45, 20, 15, NULL, NULL, NULL),
(16, 'store8', '978-1428365762', 0, NULL, 'new', 'good', 24, 165, 100, 15, NULL, NULL, NULL),
(16, 'store8', '978-1598633740', 0, NULL, 'old', 'good', 12, 25, 10, 15, NULL, NULL, NULL),
(25, 'vid library', '978-0262033848', 1, '', 'good', '', 10, 122, 38, 5, NULL, NULL, ''),
(25, 'vid library', '978-1118146069', 1, '555', 'good', '', 18, 50, 25, 5, NULL, NULL, ''),
(25, 'vid library', '978-1234567890', 1, '639', 'fair', '', 19, 75, 35, 7, NULL, NULL, ''),
(25, 'vid library', '978-1263869120', 1, '111', 'fair', '', 9, 55, 25, 3, NULL, NULL, ''),
(25, 'vid library', '978-1428365762', 0, '234', 'new', '', 23, 175, 85, 10, NULL, NULL, ''),
(25, 'vid library', '978-1428365762', 1, '340', 'poor', '', 25, 55, 20, 3, NULL, NULL, ''),
(25, 'vid library', '978-1449392776', 1, '1111', 'excellent', '', 10, 185, 75, 10, NULL, NULL, ''),
(25, 'vid library', '978-1590282410', 0, '777', 'new', '', 25, 175, 95, 10, NULL, NULL, ''),
(25, 'vid library', '978-1590282418', 0, '567', 'new', '', 20, 150, 75, 10, NULL, NULL, ''),
(25, 'vid library', '978-1598633740', 0, '999', 'excellent', '', 19, 150, 65, 9, NULL, NULL, ''),
(25, 'vid library', '978-2867409485', 0, '233', 'good', '', 10, 85, 45, 6, NULL, NULL, ''),
(25, 'vid library', '9789861984391 ', 0, '888', 'excellent', '', 11, 120, 65, 6, NULL, NULL, ''),
(26, 'Fu Lib', '9578763875', 1, '', '', '', 10, 100, 45, 3, NULL, NULL, ''),
(26, 'Fu Lib', '9781939251961 ', 1, '', '', '', 1, 0, 0, 0, NULL, NULL, ''),
(26, 'Fu Lib', '9789889974992', 1, '', 'new', '', 10, 85, 45, 7, NULL, NULL, ''),
(28, 'Madhavi BookStore', '1428365760', 1, '999', 'new', '', 1, 100, 50, 30, NULL, NULL, ''),
(29, '&#32160;&#22561;&#33775;&#20154;&#22522;&#30563;&#', '0926406485', 1, '', '', '', 1, 0, 0, 0, NULL, NULL, ''),
(29, '&#32511;&#22561;&#21326;&#20154;&#22522;&#30563;&#', '9578763875', 1, '', '', '', 1, 0, 0, 0, NULL, NULL, ''),
(29, '&#32160;&#22561;&#33775;&#20154;&#22522;&#30563;&#', '9781939251961', 1, '', '', '', 1, 0, 0, 0, NULL, NULL, ''),
(29, '&#32160;&#22561;&#33775;&#20154;&#22522;&#30563;&#', '9789575568139', 1, '', '', '', 1, 0, 0, 0, NULL, NULL, ''),
(29, '&#32160;&#22561;&#33775;&#20154;&#22522;&#30563;&#', '9789622948143', 1, '', '', '', 1, 0, 0, 0, NULL, NULL, ''),
(29, '&#32160;&#22561;&#33775;&#20154;&#22522;&#30563;&#', '9789622948143', 2, '', '', '', 1, 0, 0, 0, NULL, NULL, ''),
(29, '&#32160;&#22561;&#33775;&#20154;&#22522;&#30563;&#', '9789861982670', 1, '', '', '', 1, 0, 0, 0, NULL, NULL, ''),
(29, '&#32511;&#22561;&#21326;&#20154;&#22522;&#30563;&#', '9789861984193', 1, '', '', '', 0, 0, 0, 0, NULL, NULL, ''),
(29, '&#32511;&#22561;&#21326;&#20154;&#22522;&#30563;&#', '9789868406155', 1, '', '', '', 0, 0, 0, 0, NULL, NULL, ''),
(29, '&#32511;&#22561;&#21326;&#20154;&#22522;&#30563;&#', '9789868443518', 1, '', '', '', 0, 0, 0, 0, NULL, NULL, ''),
(29, '&#32160;&#22561;&#33775;&#20154;&#22522;&#30563;&#', '9789868812604', 1, '', '', '', 1, 0, 0, 0, NULL, NULL, ''),
(29, '&#32160;&#22561;&#33775;&#20154;&#22522;&#30563;&#', '9789881544599', 1, '', '', '', 1, 0, 0, 0, NULL, NULL, ''),
(29, '&#32160;&#22561;&#33775;&#20154;&#22522;&#30563;&#', '9789881827920', 1, '', '', '', 1, 0, 0, 0, NULL, NULL, ''),
(29, '&#32160;&#22561;&#33775;&#20154;&#22522;&#30563;&#', '9789888018956', 1, '', '', '', 1, 0, 0, 0, NULL, NULL, ''),
(29, '&#32160;&#22561;&#33775;&#20154;&#22522;&#30563;&#', '9789888018956', 2, '', '', '', 1, 0, 0, 0, NULL, NULL, ''),
(29, '&#32160;&#22561;&#33775;&#20154;&#22522;&#30563;&#', '9868313503', 1, '', '', '', 1, 0, 0, 0, NULL, NULL, ''),
(30, 'Jack Lib', '9789889974992', 1, '', '', '', 1, 0, 0, 0, NULL, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `ledgers`
--

CREATE TABLE IF NOT EXISTS `ledgers` (
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
  `note` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`custID`,`storeID`,`ledgerNum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ledgers`
--

INSERT INTO `ledgers` (`custID`, `storeID`, `ledgerNum`, `tid`, `custFirstName`, `custLastName`, `storeName`, `ledgerDate`, `description`, `chargeToCustAmt`, `custPayAmt`, `payMethod`, `bal`, `note`) VALUES
(1, 4, 1, 1, 'siri', 'g', 'Scuppernong Books', '2015-03-12', 'buy', 70, NULL, NULL, NULL, NULL),
(3, 1, 1, 106, 'sri', 'kod', 'UNCG Bookstore', '2015-05-04', 'Processed payment', 25, 25, 'Online', 0, ''),
(3, 25, 1, 103, 'sri', 'kod', 'vid library', '2015-05-04', 'Processed payment', 80, 80, 'Online', 0, ''),
(3, 25, 2, 104, 'sri', 'kod', 'vid library', '2015-05-04', 'Processed payment', 85, 85, 'Online', 0, ''),
(3, 25, 3, 105, 'sri', 'kod', 'vid library', '2015-05-04', '', 30, 0, 'Online', 30, 'Balance unpaid'),
(12, 1, 1, 109, 'shashankj', 'muttineni', 'UNCG Bookstore', '2015-05-04', 'Processed payment', 25, 25, 'Online', 0, ''),
(12, 1, 2, 110, 'shashankj', 'muttineni', 'UNCG Bookstore', '2015-05-04', '', 20, 0, 'Online', 20, 'Balance unpaid'),
(12, 1, 3, 111, 'shashankj', 'muttineni', 'UNCG Bookstore', '2015-05-04', '', 132, 0, 'Amex', 132, 'Balance unpaid'),
(13, 25, 1, 115, 'sri', 'kod', 'vid library', '2015-05-05', '', 13, 0, 'Online', 13, 'Balance unpaid'),
(14, 25, 1, 117, 'Nancy', 'Green', 'vid library', '2015-05-05', '', 30, 55, 'Online', -25, 'Paid in Full');

-- --------------------------------------------------------

--
-- Table structure for table `libmembers`
--

CREATE TABLE IF NOT EXISTS `libmembers` (
  `custID` int(11) NOT NULL DEFAULT '0',
  `custFirstName` varchar(30) DEFAULT NULL,
  `custLastName` varchar(30) DEFAULT NULL,
  `storeID` int(11) NOT NULL DEFAULT '0',
  `storeName` varchar(100) DEFAULT NULL,
  `joinDate` date DEFAULT NULL,
  `barcode` varchar(20) DEFAULT NULL,
  `pin` varchar(10) DEFAULT NULL,
  `activate` tinyint(1) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`custID`,`storeID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `libmembers`
--

INSERT INTO `libmembers` (`custID`, `custFirstName`, `custLastName`, `storeID`, `storeName`, `joinDate`, `barcode`, `pin`, `activate`, `status`) VALUES
(1, 'siri g', NULL, 0, 'store1', '2015-04-10', NULL, '6789', 1, NULL),
(1, 'siri g', NULL, 2, 'UNCG Lib', '2014-11-05', NULL, '4444', 1, NULL),
(1, 'siri g', NULL, 7, 'The Library Store', '2014-11-19', NULL, '5678', 0, NULL),
(1, 'siri g', NULL, 10, 'store2', '2015-04-13', NULL, '4545', 0, NULL),
(2, 'Lixin', 'Fu', 2, 'UNCG Lib', '2015-04-26', '10003', '1234', 0, 'created'),
(2, 'Lixin', 'Fu', 25, 'vid library', '2015-04-27', '10002', '0000', 1, 'OK'),
(2, 'Lixin', 'Fu', 26, 'Fu Lib', '2015-04-29', '10004', '', 1, 'OK'),
(2, 'Lixin', 'Fu', 29, '&#32511;&#22561;&#21326;&#20154;&#22522;&#30563;&#25945;&#20250;&#22270;&#20070;&#39302;', '2015-05-03', '10006', '5555', 1, 'OK'),
(3, 'sri', 'kod', 1, 'UNCG Bookstore', '2015-04-24', '10001', '9999', 0, 'created'),
(3, 'sri', 'kod', 25, 'vid library', '2015-04-30', '10005', '3456', 1, 'OK'),
(9, 'sirisha g', NULL, 2, 'uncg lib', '2015-04-14', NULL, '4556', 0, NULL),
(9, 'sirisha g', NULL, 9, 'store1', '2015-04-14', NULL, '5678', 0, NULL),
(11, 'Madhu', 'U', 1, 'UNCG Bookstore', '2015-05-04', '10007', '1234', 0, 'created'),
(11, 'Madhu', 'U', 26, 'Fu Lib', '2015-05-04', '10008', '', 0, 'created'),
(11, 'Madhu', 'U', 28, 'Madhavi BookStore', '2015-05-04', '10009', '1234', 0, 'created'),
(12, 'shashankj', 'muttineni', 1, 'UNCG Bookstore', '2015-05-04', '10010', '9999', 1, 'OK'),
(14, 'Nancy', 'Green', 25, 'vid library', '2015-05-05', '10011', '9999', 1, 'OK');

-- --------------------------------------------------------

--
-- Table structure for table `lineitems`
--

CREATE TABLE IF NOT EXISTS `lineitems` (
  `tid` int(11) NOT NULL DEFAULT '0',
  `lineNumber` int(11) NOT NULL DEFAULT '0',
  `isbn` varchar(30) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `report` varchar(200) DEFAULT NULL,
  `orderQuantity` int(11) DEFAULT '1',
  `priceAmount` float DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `dueDate` date DEFAULT NULL,
  PRIMARY KEY (`tid`,`lineNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lineitems`
--

INSERT INTO `lineitems` (`tid`, `lineNumber`, `isbn`, `title`, `description`, `report`, `orderQuantity`, `priceAmount`, `type`, `dueDate`) VALUES
(1, 1, '', 'Business By The Book', '', NULL, 1, 30, 'rent', NULL),
(2, 1, '0072322063', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(2, 2, '0486121178', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(2, 3, '0486474178', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(2, 4, '0785287973', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(2, 5, '0785688673', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(4, 1, '0486121178', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(45, 1, '794867409485', 'Databases', NULL, NULL, 1, NULL, 'rent', '2015-04-29'),
(45, 2, '6054860445', 'Xml Databases', NULL, NULL, 1, NULL, 'sale', '2015-04-29'),
(45, 3, '8586474939', 'Advanced databases', NULL, NULL, 1, NULL, 'sale', '2015-04-29'),
(46, 1, '794867409485', 'Databases', NULL, NULL, 1, NULL, 'rent', '2015-04-29'),
(46, 2, '6054860445', 'Xml Databases', NULL, NULL, 1, NULL, 'sale', '2015-04-29'),
(47, 1, '0785688673', 'Small Business Tax Deductions Revealed', NULL, NULL, 1, NULL, 'borrow', '2015-04-24'),
(48, 1, '6054860445', 'Xml Databases', NULL, NULL, 1, NULL, 'sale', '2015-04-29'),
(48, 2, '794867409485', 'Databases', NULL, NULL, 1, NULL, 'rent', '2015-04-29'),
(48, 3, '8586474939', 'Advanced databases', NULL, NULL, 1, NULL, 'sale', '2015-04-29'),
(49, 1, '6054860445', 'Xml Databases', NULL, NULL, 1, NULL, 'sale', '2015-04-29'),
(49, 2, '794867409485', 'Databases', NULL, NULL, 1, NULL, 'rent', '2015-04-29'),
(50, 1, '6054860445', 'Xml Databases', NULL, NULL, 1, NULL, 'sale', '2015-04-29'),
(50, 2, '794867409485', 'Databases', NULL, NULL, 1, NULL, 'rent', '2015-04-29'),
(51, 1, '2015-04-01', 'Small Business Tax Deductions Revealed', '', NULL, 1, 0, 'rent', NULL),
(52, 1, '2015-03-10', 'Xml Databases', '', NULL, 1, 47, 'rent', NULL),
(53, 1, '2015-04-02', 'Business By The Book', '', NULL, 1, 30, 'rent', NULL),
(54, 1, '2015-04-02', 'Business By The Book', '', NULL, 1, 30, 'rent', NULL),
(55, 1, '2013-04-14', 'A Book of Abstract Algebra', '', NULL, 1, 75, 'rent', NULL),
(56, 1, '', 'Business By The Book', '', NULL, 1, 30, 'rent', NULL),
(57, 1, '', 'Business By The Book', '', NULL, 1, 30, 'rent', NULL),
(58, 1, '', 'Diy Gifts Box Set', '', NULL, 1, 67, 'rent', NULL),
(59, 1, '', 'Properties of Triangles', '', NULL, 1, 0, 'rent', NULL),
(60, 1, '', 'Databases', '', NULL, 1, 33, 'rent', NULL),
(61, 1, '', 'Databases', '', NULL, 1, 33, 'rent', NULL),
(62, 1, '', 'Databases', '', NULL, 1, 33, 'rent', NULL),
(63, 1, '0486121178', 'Properties of Triangles', '', NULL, 1, 0, 'rent', NULL),
(64, 1, '', 'Business By The Book', '', NULL, 1, 30, 'rent', NULL),
(65, 1, '', 'Introduction to Algorithms Box', '', NULL, 1, 15, 'rent', NULL),
(66, 1, '', 'Business By The Book', '', NULL, 1, 30, 'rent', NULL),
(67, 1, '0486121178', 'Properties of Triangles', '', NULL, 1, 0, 'buy', NULL),
(68, 1, '', 'A Book of Abstract Algebra', '', NULL, 1, 43, 'rent', NULL),
(69, 1, '', 'book1', '', NULL, 1, 0, 'buy', NULL),
(69, 2, '', 'book5', '', NULL, 1, 0, 'buy', NULL),
(70, 1, '', 'book6', '0', NULL, 0, 0, 'buy', NULL),
(70, 2, '', 'book5', '', NULL, 1, 0, 'buy', NULL),
(71, 1, '', 'Advanced databases', '', NULL, 1, 67, 'rent', NULL),
(72, 1, '109', 'book10', '', NULL, 1, 50, 'buy', NULL),
(73, 1, '', 'book7', '', NULL, 1, 0, 'rent', NULL),
(74, 1, '', 'book5', '', NULL, 1, 0, 'rent', NULL),
(75, 1, '0486474178', 'A Book of Abstract Algebra', '', NULL, 1, 0, 'borrow', NULL),
(75, 2, '0785287973', 'Business By The Book', '', NULL, 1, 0, 'borrow', NULL),
(76, 1, '0486474178', 'A Book of Abstract Algebra', '', NULL, 1, 0, 'borrow', NULL),
(76, 2, '0785287973', 'Business By The Book', '', NULL, 1, 0, 'borrow', NULL),
(77, 1, '0486474178', 'A Book of Abstract Algebra', '', NULL, 1, 0, 'borrow', NULL),
(77, 2, '0785287973', 'Business By The Book', '', NULL, 1, 0, 'borrow', NULL),
(78, 1, '', 'Diy Gifts Box Set', '', NULL, 1, 0, 'borrow', NULL),
(79, 1, '1263869120', 'Diy Gifts Box Set', '', NULL, 1, 0, 'borrow', NULL),
(80, 1, '', 'Introduction to Algorithm Analysis', 'cart 1 book1', NULL, 1, 0, 'borrow', NULL),
(80, 2, '', 'Xml Databases', '', NULL, 2, 0, 'borrow', NULL),
(83, 1, '978-0785688673', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(83, 2, '978-0486121178', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(83, 3, '978-0486474178', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(83, 4, '978-1456368172', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(83, 5, '978-1428365762', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(84, 1, '978-1118146069', 'Better Homes and Gardens New Junior Cook Book', '', NULL, 1, 0, 'buy', NULL),
(84, 2, '978-1234567890', 'Introduction to Algorithms Box', '', NULL, 1, 0, 'buy', NULL),
(84, 3, '978-1428365762', 'Property Samba', '', NULL, 1, 0, 'buy', NULL),
(84, 4, '978-1428365762', 'Property Samba', '', NULL, 1, 0, 'buy', NULL),
(84, 5, '978-1598633740', 'Programming for the Absolute Beginner', '', NULL, 1, 0, 'buy', NULL),
(85, 1, '978-1118146069', 'Better Homes and Gardens New Junior Cook Book', '', NULL, 1, 0, 'buy', NULL),
(85, 2, '978-1234567890', 'Introduction to Algorithms Box', '', NULL, 1, 0, 'buy', NULL),
(85, 3, '978-1428365762', 'Property Samba', '', NULL, 1, 0, 'buy', NULL),
(85, 4, '978-1428365762', 'Property Samba', '', NULL, 1, 0, 'buy', NULL),
(85, 5, '978-1598633740', 'Programming for the Absolute Beginner', '', NULL, 1, 0, 'buy', NULL),
(86, 1, '0486121150', 'Properties of Triangles', '', NULL, 1, 50, 'rent', NULL),
(87, 1, '1234567891', 'Introduction to Algorithms Box', '', NULL, 1, 0, 'borrow', NULL),
(87, 2, '978-1263869120', 'Diy Gifts Box Set', '', NULL, 1, 0, 'borrow', NULL),
(88, 1, '0785287974', 'Business By The Book', '', NULL, 1, 50, 'buy', NULL),
(89, 1, '0756672287', 'What Do You Believe? (Big Questions)', '', NULL, 1, 0, 'rent', NULL),
(90, 1, '1118146068', 'Better Homes and Gardens New Junior Cook Book', '', NULL, 1, 25, 'rent', NULL),
(91, 1, '1118146068', 'Better Homes and Gardens New Junior Cook Book', '', NULL, 1, 25, 'rent', NULL),
(92, 1, '1118146068', 'Better Homes and Gardens New Junior Cook Book', '', NULL, 1, 25, 'rent', NULL),
(93, 1, '1118146068', 'Better Homes and Gardens New Junior Cook Book', '', NULL, 1, 25, 'rent', NULL),
(94, 1, '978-1118146069', 'Better Homes and Gardens New Junior Cook Book', '', NULL, 1, 0, 'borrow', NULL),
(94, 2, '978-1234567890', 'Introduction to Algorithms Box', '', NULL, 1, 0, 'borrow', NULL),
(94, 3, '978-1590282410', 'Python Programming: An Introduction to Computer Science, 2nd Ed.', '', NULL, 1, 0, 'borrow', NULL),
(95, 1, '1428365760', 'Property Samba', '', NULL, 1, 20, 'rent', NULL),
(95, 2, '1263869132', 'Diy Gifts Box Set', '', NULL, 1, 25, 'rent', NULL),
(96, 1, '9789861984193', 'æˆ´å¾·ç”Ÿèˆ‡ç‘ªéº—äºž(å…§åœ°æœƒå‰µç«‹150é€±å¹´ç´€å¿µç‰ˆ)ï¼Hudson Taylor and Maria', '', NULL, 1, 0, 'borrow', NULL),
(96, 2, '9789868443518', 'æ¦®è€€çš„å…‰è¼--ç¾…ç‚³æ£®å¸«æ¯å‚³è¨˜ï¼Radiant Glory', '', NULL, 1, 0, 'borrow', NULL),
(97, 1, '9789861984193', '&#25140;&#24503;&#29983;&#33287;&#29802;&#40599;&#20126;(&#20839;&#22320;&#26371;&#21109;&#31435;150', '', NULL, 1, 0, 'borrowReturn', NULL),
(98, 1, '978-0785287973', 'Business By The Book', '', NULL, 1, 0, 'borrow', NULL),
(99, 1, '8586474945', 'Advanced databases', '', NULL, 2, 134, 'rent', NULL),
(100, 1, '978-0785287973', 'Business By The Book', '', NULL, 1, 0, 'borrow', NULL),
(101, 1, '1234567891', 'Introduction to Algorithms Box', '', NULL, 1, 67, 'rent', NULL),
(102, 1, '1428365760', 'Property Samba', '', NULL, 2, 240, 'buy', NULL),
(102, 2, '8586474945', 'Advanced databases', '', NULL, 1, 67, 'rent', NULL),
(103, 1, '978-1263869120', 'Diy Gifts Box Set', '', NULL, 1, 25, 'rent', NULL),
(103, 2, '978-1428365762', 'Property Samba', '', NULL, 1, 55, 'buy', NULL),
(103, 3, '978-1118146069', 'Better Homes and Gardens New Junior Cook Book', '', NULL, 1, 0, 'borrow', NULL),
(104, 1, '978-1428365762', 'Property Samba', '', NULL, 1, 85, 'rent', NULL),
(105, 1, '978-1263869120', 'Diy Gifts Box Set', NULL, NULL, 1, NULL, 'rentReturn', '2015-05-04'),
(106, 1, '978-0848736575', 'Cooking Light Slow-Cooker Tonight', '', NULL, 1, 25, 'rent', NULL),
(107, 1, '978-0486474178', 'A Book of Abstract Algebra', '', NULL, 1, 0, 'borrow', NULL),
(107, 2, '978-0756672287', 'What Do You Believe? (Big Questions)', '', NULL, 1, 0, 'borrow', NULL),
(108, 1, '978-0848736575', 'Cooking Light Slow-Cooker Tonight', NULL, NULL, 1, NULL, 'rentReturn', '2015-05-18'),
(109, 1, '978-0848736575', 'Cooking Light Slow-Cooker Tonight', '', NULL, 1, 25, 'rent', NULL),
(110, 1, '978-0848736575', 'Cooking Light Slow-Cooker Tonight', NULL, NULL, 1, NULL, 'rentReturn', '2015-05-18'),
(111, 1, '978-0756672287', 'What Do You Believe? (Big Questions)', '', NULL, 1, 0, 'rent', NULL),
(111, 2, '978-2867409485', 'Databases', '', NULL, 1, 0, 'rent', NULL),
(112, 1, '978-0756672287', 'What Do You Believe? (Big Questions)', NULL, NULL, 1, NULL, 'rentReturn', '2015-05-18'),
(112, 2, '978-2867409485', 'What Do You Believe? (Big Questions)', NULL, NULL, 1, NULL, 'rentReturn', '2015-05-18'),
(113, 1, '9789868406155', 'æ‹“è’.æ¤å ‚.ç¥žè¹Ÿ', '', NULL, 1, 0, 'borrow', NULL),
(114, 1, '978-1118146069', 'Better Homes and Gardens New Junior Cook Book', '', NULL, 1, 25, 'rent', NULL),
(115, 1, '978-1118146069', 'Better Homes and Gardens New Junior Cook Book', NULL, NULL, 1, NULL, 'rentReturn', NULL),
(116, 1, '978-1263869120', 'Diy Gifts Box Set', '', NULL, 1, 25, 'rent', NULL),
(117, 1, '978-1263869120', 'Diy Gifts Box Set', NULL, NULL, 1, NULL, 'rentReturn', NULL),
(118, 1, '978-1118146069', 'Better Homes and Gardens New Junior Cook Book', '', NULL, 1, 0, 'borrow', NULL),
(118, 2, '978-1428365762', 'Property Samba', '', NULL, 1, 0, 'borrow', NULL),
(118, 3, '978-1428365762', 'Property Samba', '', NULL, 1, 0, 'borrow', NULL),
(119, 1, '0926406485', 'ç¾ä»£èˆ‡å¤ä»£è–ç¶“åœ°åœ–æŠ•å½±ç‰‡', '', NULL, 1, 0, 'borrow', NULL),
(120, 1, '978-1234567890', 'Introduction to Algorithms Box', '', NULL, 1, 0, 'borrow', NULL),
(121, 1, '978-1263869120', 'Introduction to Algorithms Box', NULL, NULL, 1, NULL, 'borrowReturn', '2015-05-14');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
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
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`name`, `email`, `phone`, `msgTime`, `subject`, `msgText`, `replyTime`, `replyText`, `replied`, `status`) VALUES
('name1', 'ema1@yahoo.com', '3361234567', NULL, 'this is 1st test', 'msg text1', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE IF NOT EXISTS `organizations` (
  `organID` int(11) NOT NULL AUTO_INCREMENT,
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
  `bibleStudyTime` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`organID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `organizations`
--

INSERT INTO `organizations` (`organID`, `name`, `cname`, `foundYear`, `type`, `keywords`, `telephoneNumber`, `otherPhone`, `addrStNum`, `addrL2`, `city`, `state`, `country`, `zip`, `emailAddress`, `website`, `username`, `password`, `status`, `pastor`, `cpastor`, `contact`, `ccontact`, `numAdults`, `numKids`, `worshipTime`, `sunSchoolTime`, `prayerTime`, `bibleStudyTime`) VALUES
(1, 'Another Church', 'xyz', 0000, 'church', 'cc', '345-567-8909', '', '123', '', 'Greensboro', 'NC', 'USA', '2', 'e', NULL, '', '', '', 'abc', 'mno', '', '', 0, 0, '', NULL, '', ''),
(2, 'organization2', 'org', NULL, 'organization', NULL, '678-909-1234', NULL, '', NULL, 'Greensboro', 'NC', 'United States', '', '', NULL, '', '', NULL, 'ijk', 'sql', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'GCCC', 'ç»¿å ¡åŽäººåŸºç£æ•™ä¼š', 1985, 'Church', 'Only Chinese church at Greensboro and High Point', '336-112-3334', '', '1911 Hickswood Ave', '', 'Greensboro', 'NC', 'USA', '27265', 'sfd@kjak.com', NULL, 'gccc', 'gccc', '', 'Steve Chang', 'å¼ è¯—ä¸€', 'Jing', '', 114, 48, 'Sunday, 11am-12:15', NULL, 'Wednesday 7:30pm-9:00pm', 'Friday 7:30pm-9:30pm');

-- --------------------------------------------------------

--
-- Table structure for table `outitems`
--

CREATE TABLE IF NOT EXISTS `outitems` (
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
-- Dumping data for table `outitems`
--

INSERT INTO `outitems` (`storeID`, `storeName`, `custID`, `custFirstName`, `custLastName`, `isbn`, `title`, `tid`, `quantity`, `type`, `outDate`, `dueDate`) VALUES
(1, 'UNCG Bookstore', 1, 'siri', 'g', '1145676099', '25 Winter Craft Ideas', 43, 1, 'rent', '2015-04-13', NULL),
(1, 'UNCG Bookstore', 1, 'siri', 'g', '1234567891', 'Introduction to Algorithm Analysis', 27, 1, 'rent', '2015-04-13', NULL),
(1, 'UNCG Bookstore', 3, 'sri', 'kod', '978-0848736575', 'Cooking Light Slow-Cooker Tonight', 108, 1, 'rentReturn', '2015-05-04', '2015-05-18'),
(1, 'UNCG Bookstore', 9, 'sirisha', 'g', '0785688673', 'Small Business Tax Deductions Revealed', 47, 1, 'borrow', '2015-04-14', '2015-04-24'),
(1, 'UNCG Bookstore', 9, 'sirisha', 'g', '794867409485', 'Databases', 45, 1, 'rent', '2015-04-14', '2015-04-29'),
(1, 'UNCG Bookstore', 12, 'shashankj', 'muttineni', '978-0756672287', 'What Do You Believe? (Big Questions)', 112, 1, 'rentReturn', '2015-05-04', '2015-05-18'),
(1, 'UNCG Bookstore', 12, 'shashankj', 'muttineni', '978-0848736575', 'Cooking Light Slow-Cooker Tonight', 110, 1, 'rentReturn', '2015-05-04', '2015-05-18'),
(1, 'UNCG Bookstore', 12, 'shashankj', 'muttineni', '978-2867409485', 'What Do You Believe? (Big Questions)', 112, 1, 'rentReturn', '2015-05-04', '2015-05-18'),
(2, 'UNCG Lib', 2, 'Lixin', 'Fu', '978-1263869120', 'Introduction to Algorithms Box', 121, 1, 'borrowReturn', '2015-04-30', '2015-05-14'),
(2, 'UNCG Lib', 3, 'sri', 'kod', '1263869120', 'Diy Gifts Box Set', 79, 1, 'borrow', '2015-04-24', '2015-05-08'),
(4, 'Scuppernong Books', 1, 'siri', 'g', '0848736575', 'Cooking Light Slow-Cooker Tonight!', 1, NULL, 'rent', '2015-02-11', '2015-04-16'),
(25, 'vid library', 3, 'sri', 'kod', '1118146068', 'Better Homes and Gardens New Junior Cook Book', 93, 1, 'rent', '2015-05-03', NULL),
(25, 'vid library', 3, 'sri', 'kod', '978-1118146069', 'Better Homes and Gardens New Junior Cook Book', 84, 1, 'buy', '2015-04-27', '2015-04-27'),
(25, 'vid library', 3, 'sri', 'kod', '978-1234567890', 'Better Homes and Gardens New Junior Cook Book', 84, 1, 'buy', '2015-04-27', '2015-04-27'),
(25, 'vid library', 3, 'sri', 'kod', '978-1263869120', 'Diy Gifts Box Set', 105, 1, 'rentReturn', '2015-05-04', '2015-05-04'),
(25, 'vid library', 3, 'sri', 'kod', '978-1428365762', 'Better Homes and Gardens New Junior Cook Book', 84, 1, 'buy', '2015-04-27', '2015-04-27'),
(25, 'vid library', 3, 'sri', 'kod', '978-1598633740', 'Better Homes and Gardens New Junior Cook Book', 84, 1, 'buy', '2015-04-27', '2015-04-27'),
(25, 'vid library', 13, 'sri', 'kod', '978-1118146069', 'Better Homes and Gardens New Junior Cook Book', 115, 1, 'rentReturn', '2015-05-05', NULL),
(25, 'vid library', 14, 'Nancy', 'Green', '978-1118146069', 'Better Homes and Gardens New Junior Cook Book', 118, 1, 'borrow', '2015-05-05', '2015-05-05'),
(25, 'vid library', 14, 'Nancy', 'Green', '978-1263869120', 'Diy Gifts Box Set', 117, 1, 'rentReturn', '2015-05-05', NULL),
(29, '&#32160;&#22561;&#33775;&#20154;&#22522;&#30563;&#25945;&#26371;&#22294;&#26360;&#39208;', 2, 'Lixin', 'Fu', '9789868406155', 'æ‹“è’.æ¤å ‚.ç¥žè¹Ÿ', 113, 1, 'borrow', '2015-05-04', '2015-05-09'),
(29, '&#32511;&#22561;&#21326;&#20154;&#22522;&#30563;&#25945;&#20250;&#22270;&#20070;&#39302;', 2, 'Lixin', 'Fu', '9789868443518', 'æˆ´å¾·ç”Ÿèˆ‡ç‘ªéº—äºž(å…§åœ°æœƒå‰µç«‹150é€±å¹´ç´€å¿µç‰ˆ)ï¼Hudson Taylor and Maria', 96, 1, 'borrow', '2015-05-03', '2015-05-08');

-- --------------------------------------------------------

--
-- Table structure for table `storeassociations`
--

CREATE TABLE IF NOT EXISTS `storeassociations` (
  `storeID` int(11) NOT NULL DEFAULT '0',
  `storeName` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `motherID` int(11) NOT NULL DEFAULT '0',
  `motherStore` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`storeID`,`motherID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `storeassociations`
--

INSERT INTO `storeassociations` (`storeID`, `storeName`, `motherID`, `motherStore`) VALUES
(0, 'UNCG Lib', 0, 'UNCG Bookstore'),
(1, 'UNCG Bookstore', 2, 'UNCG Lib'),
(1, 'UNCG Bookstore', 4, 'Scuppernong Books'),
(2, 'UNCG Lib', 1, 'Scuppernong Books'),
(2, 'UNCG Lib', 4, 'Scuppernong Books'),
(4, 'Scuppernong Books', 1, 'Scuppernong Books'),
(4, 'Scuppernong Books', 2, 'UNCG Lib'),
(5, 'The Last Bookstore', 6, 'Skylight Books'),
(5, 'The Last Bookstore', 7, 'The Library Store'),
(7, 'The Library Store', 6, 'Skylight Books'),
(8, 'Silver Lake Library', 7, 'The Library Store'),
(26, 'vid library', 2, 'UNCG Lib'),
(27, 'vij library', 25, 'vid library'),
(30, 'Jack Lib', 29, '&#32511;&#22561;&#21326;&#20154;&#22522;&#30563;&#25945;&#20250;&#22270;&#20070;&#39302;');

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

--
-- Dumping data for table `storereviews`
--

INSERT INTO `storereviews` (`storeID`, `custID`, `reviewTime`, `overallStars`, `speed`, `quality`, `revTitle`, `comment`, `storeReply`, `helpful`, `noHelp`, `numFbk`, `feedback`) VALUES
(0, 1, '2015-04-08 15:28:05', 0, NULL, NULL, 'test review', 'test comments', NULL, NULL, NULL, NULL, NULL),
(0, 1, '2015-04-08 15:31:18', 0, NULL, NULL, 'test review', 'test comments', NULL, NULL, NULL, NULL, NULL),
(1, 1, '2014-09-11 06:37:28', 0, NULL, NULL, 'better', 'I bought a notebook here once, when my wife brought me here, many years ago. Came again to show a younger cousin around before she attends here in the fall. You can get anything here. I don''t know if the price is right, but if it''s UNC-related, you''ve got it. Textbooks and stuff, too, evidently.', NULL, NULL, NULL, NULL, NULL),
(1, 1, '2014-10-15 09:38:18', 0, NULL, NULL, 'good', 'This is the University of North Carolina''s one-stop shop for everything you might need whether you''re  a student or a fan on campus for a game. ', NULL, NULL, NULL, NULL, NULL),
(2, 1, '2014-04-16 09:35:25', 0, NULL, NULL, 'good', 'Our kids love the All-Arts, Sciences & Technology camp offered at UNCG every summer. Awesome opportunity to live in the dorms, take fun classes and get a taste of what it''s like to be at a university. One of the few programs we''ve found that gives in-depth, hands-on instruction.', NULL, NULL, NULL, NULL, NULL),
(2, 1, '2014-10-16 09:39:28', 0, NULL, NULL, 'average', 'Too big. Too little parking.', NULL, NULL, NULL, NULL, NULL),
(4, 1, '2014-12-02 11:06:00', 0, NULL, NULL, 'good', 'This is an awesome place to just wind down and chill if you are book worm. The staff is very helpful and are also book lovers. They will give you great info if you ask and sometimes more than what you initially wanted. Also, they have wine and beer on draft to keep you hydrated throughout your venture through the store.', NULL, NULL, NULL, NULL, NULL),
(4, 1, '2015-01-12 16:18:35', 0, NULL, NULL, 'better', 'When I think of bookstores I think of places like this. I loved that the employees write little notes giving you opinions about particular books. I was in such admiration of the decor, I didn''t even take any pictures. I was experiencing a mental overload and I loved every moment of it.', NULL, NULL, NULL, NULL, NULL),
(5, 1, '2013-09-17 16:21:00', 0, NULL, NULL, 'better', 'Rad place! Love their vast collection of used and new books, records and other random goods such as clothes, totes and games for sale! The place and atmosphere itself is also very down to earth! Definitely coming back!', NULL, NULL, NULL, NULL, NULL),
(5, 1, '2015-01-19 12:50:14', 0, NULL, NULL, 'good', 'This place is pretty cool!!  You get to see all the different artsy stuff in this place.  You can spend a good hour just walking around and checking the place out!  I really like how the books are put together and such a good photo opp everywhere you look!', NULL, NULL, NULL, NULL, NULL),
(6, 1, '2014-11-11 09:16:43', 0, NULL, NULL, 'better', 'I love books and independent bookstores. This small, hipster bookstore is great! Wide variety of books, stationary, and graphic novels (yay!) \r\n', NULL, NULL, NULL, NULL, NULL),
(6, 1, '2014-11-17 09:44:18', 0, NULL, NULL, 'good', 'One of my favorite places in LF. I even spent 2 hours here on a Friday night once...but, I''m a dork.', NULL, NULL, NULL, NULL, NULL),
(7, 1, '2013-06-12 08:41:11', 0, NULL, NULL, 'good', 'This is a great place to pick up unique gifts and cards. Whoever is the buyer for this store is very talented and has an eye for quality merchandise. ', NULL, NULL, NULL, NULL, NULL),
(7, 1, '2014-11-11 10:17:37', 0, NULL, NULL, 'average', 'very nice shop for something different and unique. Would like to go to the museum but the queue was just too long. it was raining too. From this I assume it must be good. Will pay a visit in future.', NULL, NULL, NULL, NULL, NULL),
(8, 1, '2014-07-16 09:50:28', 0, NULL, NULL, 'good', 'A must see, walk around and enjoy the historic Library of CA . The upstairs floors have awesome architecture and the old school library look that you''ve seen in movies. Very quick and awesome venue!', NULL, NULL, NULL, NULL, NULL),
(8, 1, '2014-09-17 12:42:19', 0, NULL, NULL, 'goog', 'What a beautiful, open space to work!\r\n\r\n', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE IF NOT EXISTS `stores` (
  `storeID` int(11) NOT NULL AUTO_INCREMENT,
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
  `maxFine` float DEFAULT NULL,
  PRIMARY KEY (`storeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`storeID`, `insertDate`, `storeName`, `altStoreName`, `addrStNum`, `addrLine2`, `city`, `state`, `zip`, `latitude`, `longtitude`, `phone`, `phone1`, `email`, `mgrPasswd`, `staffPasswd`, `website`, `question`, `answer`, `mgrName`, `mgrPhone`, `mgrEmail`, `storeType`, `keywords`, `openHour`, `services`, `dueRent`, `dueLent`, `lentLimit`, `graceLend`, `graceRent`, `dueHold`, `selfCheckout`, `maxRenew`, `fineRateLend`, `fineRateRent`, `maxFine`) VALUES
(1, '2014-12-01', 'UNCG Bookstore', NULL, '1000 spring Garden Street', NULL, 'Greensboro', 'NC', '27402', 36.063061, -79.806839, '336-123-4567', NULL, 'xyz@test.com', '12345', '6789', NULL, 2, 'yes', NULL, NULL, NULL, 'bookstore', NULL, NULL, 'sell, rent, return', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, '2014-12-01', 'UNCG Lib', NULL, '1000 spring Garden Street', NULL, 'Greensboro', 'NC', '27402', 36.066010, -79.816811, '336-123-0000', NULL, 'abc@test.com', '12345', '6789', NULL, 2, 'yes', NULL, NULL, NULL, '', NULL, NULL, 'sell, rent, return', 0, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(4, '2014-12-16', 'Scuppernong Books', NULL, '304 S Elm St', NULL, 'Greensboro', 'NC', '27401', 36.069958, -79.790825, '(336) 763-1919', NULL, '', '', NULL, 'scuppernongbooks.com', 0, '', NULL, NULL, NULL, 'bookstore', NULL, '10:00 am - 9:00 pm', 'buy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, '2015-01-19', 'The Last Bookstore', NULL, '453 S Spring St', NULL, 'Los Angeles', 'CA', '90013', 34.047764, -118.249512, '(213) 488-0599', NULL, '', '', NULL, 'lastbookstorela.com', 0, '', NULL, NULL, NULL, 'bookstore', NULL, '10:00 am - 10:00 pm', 'buy,rent', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, '2015-04-03', 'Skylight Books', NULL, '1818 N Vermont Ave', NULL, 'Los Angeles', 'CA', '90027', 34.104218, -118.291489, '(323) 660-1175', NULL, '', '', NULL, 'skylightbooks.com', 0, '', NULL, NULL, NULL, 'bookstore', NULL, '10:00 am - 10:00 pm', 'buy,rent', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, '2014-12-16', 'The Library Store', NULL, '630 W 5th St', NULL, 'Los Angeles', 'CA', '90071', 34.050671, -118.255196, '(213) 228-7550', NULL, '', '', NULL, 'librarystore.org', 0, '', NULL, NULL, NULL, 'bookstore', NULL, '10:00 am - 7:00 pm', 'buy,rent,borrow', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, '2015-02-15', 'Silver Lake Library', NULL, '2411 Glendale Blvd', NULL, 'Los Angeles', 'CA', '90039', 34.100422, -118.259598, '(323) 913-7451', NULL, '', '', NULL, NULL, 0, '', NULL, NULL, NULL, 'public library', NULL, '10:00 am - 8:00 pm', 'rent,borrow', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, '2015-02-11', 'store1', NULL, '304 S Elm St', NULL, 'Greensboro', 'NC', '27401', 36.069958, -79.790825, '(336) 763-1919', NULL, '', '', NULL, NULL, 0, '', NULL, NULL, NULL, 'bookstore', NULL, NULL, 'buy,rent,borrow', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, '2015-02-18', 'store2', NULL, '304 S Elm St', NULL, 'Greensboro', 'NC', '27401', 36.069958, -79.790825, '(336) 763-1919', NULL, '', '', NULL, NULL, 0, '', NULL, NULL, NULL, 'bookstore', NULL, NULL, 'buy,rent,borrow', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, '2015-02-18', 'store3', NULL, '304 S Elm St', NULL, 'Greensboro', 'NC', '27401', 36.069958, -79.790825, '(336) 763-1919', NULL, '', '', NULL, NULL, 0, '', NULL, NULL, NULL, 'bookstore', NULL, NULL, 'buy,rent,borrow', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, '2015-02-18', 'store4', NULL, '304 S Elm St', NULL, 'Cary', 'NC', '27519', 36.069958, -79.790825, '(336) 763-1919', NULL, '', '', NULL, NULL, 0, '', NULL, NULL, NULL, 'bookstore', NULL, NULL, 'buy,rent,borrow', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, '2015-02-18', 'store5', NULL, '304 S Elm St', NULL, 'Cary', 'NC', '27519', 36.069958, -79.790825, '(336) 763-1919', NULL, '', '', NULL, NULL, 0, '', NULL, NULL, NULL, 'bookstore', NULL, NULL, 'buy,rent,borrow', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, '2015-02-18', 'store6', NULL, '304 S Elm St', NULL, 'Cary', 'NC', '27519', 36.069958, -79.790825, '(336) 763-1919', NULL, '', '', NULL, NULL, 0, '', NULL, NULL, NULL, 'bookstore', NULL, NULL, 'buy,rent,borrow', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, '2015-02-18', 'store7', NULL, '304 S Elm St', NULL, 'Cary', 'NC', '27519', 36.069958, -79.790825, '(336) 763-1919', NULL, '', '', NULL, NULL, 0, '', NULL, NULL, NULL, 'bookstore', NULL, NULL, 'buy,rent,borrow', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, '2015-02-18', 'store8', NULL, '304 S Elm St', NULL, 'Cary', 'NC', '27519', 36.069958, -79.790825, '(336) 763-1919', NULL, '', '', NULL, NULL, 0, '', NULL, NULL, NULL, 'bookstore', NULL, NULL, 'buy,rent,borrow', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, '2015-02-18', 'store9', NULL, '304 S Elm St', NULL, 'Cary', 'NC', '27519', 36.069958, -79.790825, '(336) 763-1919', NULL, '', '', NULL, NULL, 0, '', NULL, NULL, NULL, 'bookstore', NULL, NULL, 'buy,rent,borrow', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, '2015-01-15', 'store10', NULL, '453 S Spring St', NULL, 'Los Angeles', 'CA', '90027', 34.104218, -118.291489, '(213) 228-7550', NULL, '', '', NULL, NULL, 0, '', NULL, NULL, NULL, 'bookstore', NULL, NULL, 'buy,rent,borrow', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, '2015-01-21', 'store 11', NULL, '506 Clement St ', NULL, 'San Francisco', 'CA', '94118', 37.783249, -122.464722, '(213) 488-0599', NULL, '', '', NULL, NULL, 0, '', NULL, NULL, NULL, 'bookstore', NULL, NULL, 'buy,rent,borrow', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, '2015-01-21', 'store 12', NULL, '506 Clement St ', NULL, 'San Francisco', 'CA', '94118', 37.783249, -122.464722, '(213) 488-0599', NULL, '', '', NULL, NULL, 0, '', NULL, NULL, NULL, 'bookstore', NULL, NULL, 'buy,rent,borrow', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, '2015-01-21', 'store 13', NULL, '506 Clement St ', NULL, 'San Francisco', 'CA', '94118', 37.783249, -122.464722, '(213) 488-0599', NULL, '', '', NULL, NULL, 0, '', NULL, NULL, NULL, 'bookstore', NULL, NULL, 'buy,rent,borrow', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, '2015-01-21', 'store 14', NULL, '506 Clement St ', NULL, 'San Francisco', 'CA', '94118', 37.783249, -122.464722, '(213) 488-0599', NULL, '', '', NULL, NULL, 0, '', NULL, NULL, NULL, 'bookstore', NULL, NULL, 'buy,rent,borrow', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, '2015-01-21', 'store 15', NULL, '506 Clement St ', NULL, 'San Francisco', 'CA', '94118', 37.783249, -122.464722, '(213) 488-0599', NULL, '', '', NULL, NULL, 0, '', NULL, NULL, NULL, 'bookstore', NULL, NULL, 'buy,rent,borrow', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, '2015-01-21', 'store 16', NULL, '506 Clement St ', NULL, 'San Francisco', 'CA', '94118', 37.783249, -122.464722, '(213) 488-0599', NULL, '', '', NULL, NULL, 0, '', NULL, NULL, NULL, 'bookstore', NULL, NULL, 'buy,rent,borrow', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, '2015-02-20', 'vid library', NULL, '123', '', 'Seattle', 'CA', '27475', NULL, NULL, '1234567890', '', 'srikodali9@gmail.com', '123', '', '', 1, 'err', '', '', '', 'Bookstore', '', '', 'Sell,Lend,Rent,Return,Procure', 0, 0, 0, NULL, 0, 0, 1, 0, NULL, 0, 0),
(26, '2015-03-25', 'Fu Lib', NULL, '1000 Spring garden st', 'W. Lee Street', 'Greensboro', 'NC', '27403', 36.069958, -79.790825, '3362561137', '', 'lfu@uncg.edu', '123', '', '', 1, 'fish', '', '', '', 'Personal', '', 'M-F 9am-5pm', 'Lend,Return', 0, 0, 0, NULL, 0, 0, 0, 0, NULL, 0, 0),
(27, '2015-04-20', 'vij library', NULL, '34556 eastman street', '', 'cary', 'NC', '27604', 36.069958, -79.790825, '1234567890', '', 'srikodali9@gmail.com', '123', '', '', 2, 'bmw', '', '', '', 'Personal', '', '', 'Sell,Lend,Rent,Return', 0, 0, 0, NULL, 0, 0, 1, 0, NULL, 0, 0),
(28, NULL, 'Madhavi BookStore', NULL, '3315', 'horsepencreek rd', 'greensboro', 'NC', '27410', 36.069958, -79.790825, '1234567897', '', 'madhuunnam@gmail.com', '54321', '09876', '', 1, 'doggy', '', '', '', 'Public', '', '', 'Sell,Lend,Rent,Return', 0, 0, 0, NULL, 0, 0, 0, 0, NULL, 0, 0),
(29, NULL, '&#32160;&#22561;&#33775;&#20154;&#22522;&#30563;&#25945;&#26371;&#22294;&#26360;&#39208;', NULL, '1910 Hickswood Road, High Point', '', 'Greensboro', 'NC', '27265', 36.069958, -79.790825, '336-833-3335', '', 'gccc@gmail.com', '123', '', '', 1, 'fish', '', '', '', 'Church', '', 'Friday 7:30', 'Lend,Return', 0, 30, 5, NULL, 30, 30, 0, 3, NULL, 0, 0),
(30, NULL, 'Jack Lib', NULL, '1910 Hickswood Road, High Point', '', 'Greensboro', 'NC', '27265', NULL, NULL, '3368333335', '3368333335', 'jack@gmail.com', '123', '', '', 1, 'fish', '', '3368333335', '', 'Personal', '', '', 'Lend,Return', 0, 0, 0, NULL, 0, 0, 0, 0, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
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
  `notes` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=119 ;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`tid`, `storeID`, `storeName`, `custID`, `custFirstName`, `custLastName`, `transTime`, `numberOfLines`, `unitsOrdered`, `title`, `type`, `subTot`, `taxRatePercent`, `taxAmount`, `discountPercentage`, `shipFee`, `totPrice`, `receiverName`, `shippingAddr`, `shipMethod`, `deliveryTimeCode`, `carrierName`, `deliveryNotes`, `orderStatus`, `msgToCust`, `msgToStore`, `agentName`, `notes`) VALUES
(46, NULL, 'UNCG Bookstore', 9, NULL, NULL, '2015-04-14 08:49:22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'RECEIVED', NULL, NULL, NULL, NULL),
(47, 1, 'UNCG Bookstore', 9, NULL, NULL, '2015-04-14 09:04:53', NULL, 1, 'Small Business Tax Deductions Revealed', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'RECEIVED', NULL, NULL, NULL, NULL),
(48, 26, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL, NULL, NULL, 'BorrowReturn', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Received', NULL, NULL, NULL, NULL),
(55, 5, 'The Last Bookstore', 3, 'sri', 'kod', '0000-00-00 00:00:00', 1, NULL, NULL, NULL, 150, 0, 0, NULL, NULL, 150, NULL, NULL, NULL, NULL, NULL, NULL, 'Received', NULL, NULL, NULL, NULL),
(58, 5, 'The Last Bookstore', 3, 'sri', 'kod', '0000-00-00 00:00:00', 1, NULL, NULL, NULL, 95, 0, 0, NULL, NULL, 95, NULL, NULL, NULL, NULL, NULL, NULL, 'Received', NULL, '{"2015-04-23 02:04:39":" "}', NULL, NULL),
(64, 1, 'UNCG Bookstore', 3, 'sri', 'kod', '0000-00-00 00:00:00', 1, NULL, NULL, NULL, 50, 0, 0, NULL, NULL, 50, NULL, NULL, NULL, NULL, NULL, NULL, 'Received', NULL, NULL, NULL, NULL),
(67, 1, 'UNCG Bookstore', 3, 'sri', 'kod', '0000-00-00 00:00:00', 1, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'Received', NULL, '{"2015-04-23 04:58:10":"UNCG is awesome"}', NULL, NULL),
(68, 7, 'The Library Store', 3, 'sri', 'kod', '0000-00-00 00:00:00', 1, NULL, NULL, NULL, 43, 0, 0, NULL, 3.9, 46.9, 'vij', '123 chapel hill road , Raleigh, NC, 27604', 'regular-3.90', NULL, '', '', 'Received', NULL, NULL, NULL, NULL),
(78, 2, 'UNCG Lib', 3, 'sri', 'kod', '0000-00-00 00:00:00', 1, 1, 'Diy Gifts Box Set', NULL, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'Received', NULL, NULL, NULL, NULL),
(79, 2, 'UNCG Lib', 3, 'sri', 'kod', '0000-00-00 00:00:00', 1, 1, 'Diy Gifts Box Set', NULL, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'Received', NULL, NULL, NULL, NULL),
(81, 25, 'vid library', NULL, NULL, NULL, '2015-04-27 00:00:00', 4, NULL, NULL, 'BorrowReturn', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Received', NULL, NULL, NULL, NULL),
(82, 25, 'vid library', NULL, NULL, NULL, '2015-04-27 00:00:00', 5, NULL, NULL, 'BorrowReturn', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Received', NULL, NULL, NULL, NULL),
(83, 25, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL, NULL, NULL, 'BorrowReturn', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Received', NULL, NULL, NULL, NULL),
(84, 25, 'vid library', 3, 'sri', 'kod', '2015-04-27 00:00:00', 5, 5, 'Better Homes and Gardens New Junior Cook Book', 'buy', 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'Ordered', NULL, NULL, '', NULL),
(92, 25, 'vid library', 3, 'sri', 'kod', '2015-05-03 17:10:20', 1, 1, 'Better Homes and Gardens New Junior Cook Book', 'rent', 25, 0, 0, NULL, NULL, 25, NULL, NULL, NULL, NULL, NULL, NULL, 'Received', NULL, NULL, NULL, NULL),
(93, 25, 'vid library', 3, 'sri', 'kod', '2015-05-03 17:11:09', 1, 1, 'Better Homes and Gardens New Junior Cook Book', 'rent', 25, 0, 0, NULL, NULL, 25, NULL, NULL, NULL, NULL, NULL, NULL, 'Received', NULL, NULL, NULL, NULL),
(94, 25, 'vid library', 3, 'sri', 'kod', '2015-05-03 18:27:58', 3, 3, 'Better Homes and Gardens New Junior Cook Book', 'borrow', 0, 0, 0, NULL, 3.9, 3.9, 'vij', '123 chapel hill road , Raleigh, NC, 27604', 'regular-3.90', NULL, '', '', 'Received', '{"2015-05-04 00:29:32":"It takes 5-7 business days"}', '{"2015-05-04 00:29:05":" how long it takes to send?","2015-05-04 00:29:52":" thank you for reply"}', NULL, NULL),
(95, 25, 'vid library', 3, 'sri', 'kod', '2015-05-03 19:50:50', 2, 2, 'Property Samba', 'rent', 45, 0, 0, NULL, NULL, 45, NULL, NULL, NULL, NULL, NULL, NULL, 'Received', NULL, NULL, NULL, NULL),
(96, 29, 'ç»¿å ¡åŽäººåŸºç£æ•™ä¼šå›¾ä¹¦é¦†', 2, 'Lixin', 'Fu', '2015-05-03 00:00:00', 2, 2, 'æˆ´å¾·ç”Ÿèˆ‡ç‘ªéº—äºž(å…§åœ°æœƒå‰µç«‹150é€±å¹´ç´€å¿µç‰ˆ)ï¼Hudson Taylor and Maria', NULL, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'Received', NULL, NULL, NULL, NULL),
(97, 29, '&#32160;&#22561;&#33775;&#20154;&#22522;&#30563;&#25945;&#26371;&#22294;&#26360;&#39208;', 2, 'Lixin', 'Fu', '2015-05-03 00:00:00', 1, 1, '&#25140;&#24503;&#29983;&#33287;&#29802;&#40599;&#20126;(&#20839;&#22320;&#26371;&#21109;&#31435;150', 'borrowReturn', 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'Received', NULL, NULL, '', NULL),
(103, 25, 'vid library', 3, 'sri', 'kod', '2015-05-04 14:27:40', 3, 3, 'Diy Gifts Box Set', 'rent', 80, 0, 0, NULL, NULL, 80, NULL, NULL, NULL, NULL, NULL, NULL, 'Received', '{"2015-05-04 20:57:42":"11am to 9pm","2015-05-04 20:58:11":"11am to 9pm"}', '{"2015-05-04 20:29:39":"what is the store timings?","2015-05-04 20:30:16":"what is the store timings?","2015-05-04 20:58:05":" thank you"}', NULL, NULL),
(104, 25, 'vid library', 3, 'sri', 'kod', '2015-05-04 15:00:44', 1, 1, 'Property Samba', 'rent', 85, 0, 0, NULL, NULL, 85, NULL, NULL, NULL, NULL, NULL, NULL, 'Received', NULL, NULL, NULL, NULL),
(105, 25, 'vid library', 3, 'sri', 'kod', '2015-05-04 15:04:27', 1, 1, 'Online Return', 'Return', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Received', NULL, NULL, NULL, NULL),
(106, 1, 'UNCG Bookstore', 3, 'sri', 'kod', '2015-05-04 15:08:29', 1, 1, 'Cooking Light Slow-Cooker Tonight', 'rent', 25, 0, 0, NULL, NULL, 25, NULL, NULL, NULL, NULL, NULL, NULL, 'Received', NULL, NULL, NULL, NULL),
(108, 1, 'UNCG Bookstore', 3, 'sri', 'kod', '2015-05-04 15:10:08', 1, 1, 'Online Return', 'Return', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Received', NULL, NULL, NULL, NULL),
(109, 1, 'UNCG Bookstore', 12, 'shashankj', 'muttineni', '2015-05-04 16:01:52', 1, 1, 'Cooking Light Slow-Cooker Tonight', 'rent', 25, 0, 0, NULL, NULL, 25, NULL, NULL, NULL, NULL, NULL, NULL, 'Received', '{"2015-05-04 22:05:28":"11am -9pm"}', '{"2015-05-04 22:03:34":" what are stored timings?","2015-05-04 22:05:35":" what are stored timings?","2015-05-04 22:05:45":" thank you","2015-05-04 22:06:49":" thank you"}', NULL, NULL),
(110, 1, 'UNCG Bookstore', 12, 'shashankj', 'muttineni', '2015-05-04 16:07:59', 1, 1, 'Online Return', 'Return', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Received', NULL, NULL, NULL, NULL),
(111, 1, 'UNCG Bookstore', 12, 'shashankj', 'muttineni', '2015-05-04 00:00:00', 2, 2, 'What Do You Believe? (Big Questions)', 'rent', 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'Received', NULL, NULL, '', NULL),
(112, 1, 'UNCG Bookstore', 12, 'shashankj', 'muttineni', '2015-05-04 16:12:39', 2, 2, 'Online Return', 'Return', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Received', NULL, NULL, NULL, NULL),
(113, 29, '&#32160;&#22561;&#33775;&#20154;&#22522;&#30563;&#25945;&#26371;&#22294;&#26360;&#39208;', 2, 'Lixin', 'Fu', '2015-05-04 00:00:00', 1, 1, 'æ‹“è’.æ¤å ‚.ç¥žè¹Ÿ', 'borrow', 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'Received', NULL, NULL, NULL, NULL),
(114, 25, 'vid library', 13, 'sri', 'kod', '2015-05-05 08:29:51', 1, 1, 'Better Homes and Gardens New Junior Cook Book', 'rent', 25, 0, 0, NULL, NULL, 25, NULL, NULL, NULL, NULL, NULL, NULL, 'Received', NULL, NULL, NULL, NULL),
(115, 25, 'vid library', 13, 'sri', 'kod', '2015-05-05 08:32:25', 1, 1, 'Online Return', 'Return', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Received', NULL, NULL, NULL, NULL),
(116, 25, 'vid library', 14, 'Nancy', 'Green', '2015-05-05 10:33:04', 1, 1, 'Diy Gifts Box Set', 'rent', 25, 0, 0, NULL, NULL, 25, NULL, NULL, NULL, NULL, NULL, NULL, 'Received', '{"2015-05-05 16:37:21":"4-5 days","2015-05-05 16:37:49":"4-5 days"}', '{"2015-05-05 16:35:23":" How long it takes to ship?","2015-05-05 16:37:28":" How long it takes to ship?","2015-05-05 16:37:42":" thank you","2015-05-05 16:38:07":" thank you","2015-05-05 16:38:29":" thank you"}', NULL, NULL),
(117, 25, 'vid library', 14, 'Nancy', 'Green', '2015-05-05 10:39:59', 1, 1, 'Online Return', 'Return', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Received', NULL, NULL, NULL, NULL),
(118, 25, 'vid library', 14, 'Nancy', 'Green', '2015-05-05 10:45:12', 3, 3, 'Better Homes and Gardens New Junior Cook Book', 'borrow', 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'Received', NULL, NULL, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
