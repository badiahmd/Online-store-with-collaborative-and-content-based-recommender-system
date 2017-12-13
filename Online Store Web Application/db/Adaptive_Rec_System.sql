-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 13, 2017 at 01:14 PM
-- Server version: 5.6.35
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Adaptive_Rec_System`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `custID` int(10) unsigned NOT NULL,
  `ISBN` varchar(40) NOT NULL,
  `qtyItem` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`custID`, `ISBN`, `qtyItem`) VALUES
(605, '345441036', 1),
(604, '312955006', 1),
(608, '312958455', 1),
(612, '3453151720', 1),
(613, '3453151720', 1),
(603, '3453151720', 2),
(611, '3453151720', 1),
(603, '1570429227', 1),
(620, '3453151720', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contentBF_Recommender`
--

CREATE TABLE IF NOT EXISTS `contentBF_Recommender` (
  `custID` int(10) unsigned NOT NULL,
  `ISBN` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contentBF_Recommender`
--

INSERT INTO `contentBF_Recommender` (`custID`, `ISBN`) VALUES
(613, '312958455'),
(613, '3453159926'),
(613, '3453169247'),
(613, '99244926'),
(613, '3453061187'),
(613, '3453052544'),
(613, '316153915'),
(613, '312955006'),
(613, '3453108191'),
(613, '375727965'),
(611, '312958455'),
(611, '3453159926'),
(611, '3453169247'),
(611, '99244926'),
(611, '3453061187'),
(611, '3453052544'),
(611, '316153915'),
(611, '312955006'),
(611, '3453108191'),
(611, '375727965'),
(616, '312958455'),
(616, '3453159926'),
(616, '3453169247'),
(616, '99244926'),
(616, '3453061187'),
(616, '3453052544'),
(616, '316153915'),
(616, '312955006'),
(616, '3453108191'),
(616, '375727965'),
(619, '590353403'),
(619, '671024256'),
(619, '439321603'),
(619, '439139600'),
(619, '439420105'),
(619, '613329740'),
(619, '743211383'),
(619, '316153915'),
(619, '451166582'),
(619, '2290308404'),
(603, '312958455'),
(603, '446607274'),
(603, '3453169247'),
(603, '99244926'),
(603, '3453061187'),
(603, '312955006'),
(603, '446608815'),
(603, '2290308404'),
(603, '3453108191'),
(603, '446676411'),
(620, '312958455'),
(620, '3453159926'),
(620, '3453169247'),
(620, '99244926'),
(620, '3453061187'),
(620, '3453052544'),
(620, '316153915'),
(620, '312955006'),
(620, '3453108191'),
(620, '375727965'),
(621, '590353403'),
(621, '671024256'),
(621, '425105334'),
(621, '439358078'),
(621, '439139600'),
(621, '439420105'),
(621, '613329740'),
(621, '451166582');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `custID` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fName` varchar(20) DEFAULT NULL,
  `lName` varchar(45) NOT NULL,
  `dateJoined` date NOT NULL,
  `address1` varchar(45) NOT NULL,
  `address2` varchar(45) DEFAULT NULL,
  `state` enum('KUL','JHR','KDH','PNG','PRK','SBH','SWK') NOT NULL,
  `postCode` int(10) unsigned NOT NULL,
  `passWord` varchar(32) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=622 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`custID`, `email`, `fName`, `lName`, `dateJoined`, `address1`, `address2`, `state`, `postCode`, `passWord`) VALUES
(601, 'badi@yahoo.com', 'aaaa', 'aaaa', '2017-07-04', '1', '2', 'KUL', 3000, 'c4ca4238a0b923820dcc509a6f75849b'),
(602, 'keren@gmail.com', 'fff', 'fff', '2017-07-30', '10 street', '', 'KDH', 3000, '8fa14cdd754f91cc6554c9e71929cce7'),
(603, 'badikerens@gmail.com', 'Abdullah', 'Ahmad', '2017-08-04', 'baker street', 'Moriarty', 'PNG', 1200, '5522f7385a71ef216b717d95dedd7424'),
(604, 'nizam@yahoo.com', 'nizam', 'ahmad', '2017-09-01', 'jebe', 'alay', 'KUL', 1200, 'd2a23a8be13408a2113109a08e7f8bef'),
(605, 'jeve@yahoo.com', 'fikrah', 'alay', '2017-09-01', 'jebe alay', 'alay', 'KUL', 6547, '1ef56065bb752d4e58dc3cc1ae284064'),
(606, 'sherlock@gmail.com', 'sherlock', 'holmes', '2017-09-03', 'baker st1', 'no. 63543', 'PRK', 1466, '5522f7385a71ef216b717d95dedd7424'),
(607, 'piedpiper@gmail.com', 'Ricard', 'Hendricks', '2017-09-03', 'Erlich Bachman Incubator', 'Silicon Valley', 'JHR', 666, '5522f7385a71ef216b717d95dedd7424'),
(608, 'nizampababbarii@yahoo.com', 'nizam', 'pababbari', '2017-09-03', 'endah', 'promenade', 'KUL', 9999, '34d778bcfc8c2829edfc70f690a4b46a'),
(609, 'blizzard_bad@yahoo.com', 'Badi', 'Ahmad', '2017-09-09', 'badisdfs', 'bdasfsad', 'KUL', 1200, '5522f7385a71ef216b717d95dedd7424'),
(610, 'vader@gmail.com', 'Anakin', 'Skywalker', '2017-09-10', 'Death Star, Death Star II, Tatooine', '', 'KDH', 666, '5522f7385a71ef216b717d95dedd7424'),
(611, 'febrik1996@gmail.com', 'Muhammad', 'Febrik', '2017-09-11', 'endah pronened', '', 'KUL', 5700, '5cf7eb9bef3dfcad69589f31c9485b0f'),
(612, 'qwerty@gmail.com', 'qwerty', 'abc', '2017-09-11', 'ijfkasjfas', 'fasfdas', 'KUL', 1213, '5522f7385a71ef216b717d95dedd7424'),
(613, 'badikerenz@gmail.com', 'abdullah', 'ahmad', '2017-09-18', 'badikeren', 'badikeren', 'KUL', 1234, '5522f7385a71ef216b717d95dedd7424'),
(614, 'qwerty@yahoo.com', 'qwert', 'asdfg', '2017-09-19', '123rwewqee', '123qwrewqe', 'KUL', 121, '5522f7385a71ef216b717d95dedd7424'),
(615, 'gordon@yahoo.com', 'Gordon', 'Ramsay', '2017-09-19', 'what are you,', 'an idiot sandwich', 'KUL', 1432, '8fb744b51a1f14e5e8cda4e4aec68e2f'),
(616, 'jayakarim@gmail.com', 'jaya', 'karim', '2017-10-09', 'enda promenade', '', 'KUL', 5700, 'e10adc3949ba59abbe56e057f20f883e'),
(617, 'abdullah@yahoo.com', 'Abdullah', 'Ahmad', '2017-10-09', 'Endah Promenade', '', 'SBH', 1432, '5522f7385a71ef216b717d95dedd7424'),
(618, 'darthvader@yahoo.com', 'Anakin', 'Skywalker', '2017-10-09', 'darth', 'vader', 'SBH', 1342, '5522f7385a71ef216b717d95dedd7424'),
(619, 'skywalkervader@yahoo.com', 'Anakin', 'Skywalker', '2017-09-19', 'Tatooine', 'Obi Wan Kenobi', 'SBH', 1200, '5522f7385a71ef216b717d95dedd7424'),
(620, 'syewele@yahoo.com', 'syewele', 'asdsaj', '2017-11-01', 'sadjfs', 'jdfsajdfa', 'KUL', 4132, '5522f7385a71ef216b717d95dedd7424'),
(621, 'anakins@yahoo.com', 'Abdullah', 'Alkaff', '2017-11-01', 'Endah Promenade', 'c abcdefg', 'KDH', 1200, '5522f7385a71ef216b717d95dedd7424');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE IF NOT EXISTS `delivery` (
  `delState` enum('KUL','JHR','KDH','PNG','PRK','SBH','SWK') NOT NULL,
  `delRate` decimal(10,2) unsigned NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`delState`, `delRate`) VALUES
('KUL', '1.00'),
('JHR', '3.50'),
('KDH', '6.50'),
('PNG', '5.00'),
('PRK', '8.00'),
('SBH', '12.00'),
('SWK', '12.50');

-- --------------------------------------------------------

--
-- Table structure for table `itemCF_Recommender`
--

CREATE TABLE IF NOT EXISTS `itemCF_Recommender` (
  `custID` int(10) unsigned NOT NULL,
  `ISBN` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `itemCF_Recommender`
--

INSERT INTO `itemCF_Recommender` (`custID`, `ISBN`) VALUES
(605, '739302248'),
(605, '446601241'),
(605, '385511612'),
(605, '446611212'),
(605, '345441036'),
(605, '743211383'),
(605, '440234743'),
(605, '439136369'),
(605, '446615145'),
(605, '446609404'),
(606, '440241073'),
(606, '446603929'),
(606, '451191013'),
(606, '670868361'),
(606, '451166582'),
(606, '446679593'),
(606, '385121679'),
(606, '670849367'),
(606, '613329740'),
(606, '375727965'),
(611, '446615145'),
(611, '670835382'),
(611, '312955006'),
(611, '446613266'),
(611, '446609404'),
(611, '385511612'),
(611, '345441036'),
(611, '446601241'),
(611, '440234743'),
(611, '446611212'),
(616, '743436210'),
(616, '446608815'),
(616, '446603929'),
(616, '451191013'),
(616, '446679593'),
(616, '451190491'),
(616, '446601241'),
(616, '440234743'),
(616, '451155750'),
(616, '446611212'),
(619, '451155750'),
(619, '446603929'),
(619, '451191013'),
(619, '670868361'),
(619, '451166582'),
(619, '446679593'),
(619, '451162072'),
(619, '451190491'),
(619, '446601241'),
(619, '440234743'),
(607, '684853507'),
(607, '670868361'),
(607, '440214041'),
(607, '446612731'),
(607, '446611611'),
(607, '451191013'),
(607, '451190491'),
(607, '440241073'),
(607, '670813648'),
(607, '446612790'),
(603, '446692638'),
(603, '670849367'),
(603, '2290308404'),
(603, '671024256'),
(603, '3453061187'),
(603, '425105334'),
(603, '440214041'),
(603, '451163524'),
(603, '553573403'),
(603, '553712527'),
(620, '743436210'),
(620, '446608815'),
(620, '446603929'),
(620, '451191013'),
(620, '446679593'),
(620, '451190491'),
(620, '446601241'),
(620, '440234743'),
(620, '451155750'),
(620, '446611212'),
(621, '684853507'),
(621, '670868361'),
(621, '440214041'),
(621, '446612731'),
(621, '446611611'),
(621, '451191013'),
(621, '451190491'),
(621, '440241073'),
(621, '670813648'),
(621, '446612790');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `ISBN` varchar(40) NOT NULL,
  `bookTitle` varchar(60) NOT NULL,
  `bookAuthor` varchar(255) NOT NULL,
  `publicationYear` varchar(255) NOT NULL,
  `publisher` varchar(255) NOT NULL,
  `qtyOnHand` int(15) NOT NULL DEFAULT '0',
  `unitPrice` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `photo1` varchar(50) NOT NULL,
  `photo2` varchar(50) DEFAULT NULL,
  `photo3` varchar(50) DEFAULT NULL,
  `thumbNail` varchar(50) NOT NULL,
  `featured` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`ISBN`, `bookTitle`, `bookAuthor`, `publicationYear`, `publisher`, `qtyOnHand`, `unitPrice`, `photo1`, `photo2`, `photo3`, `thumbNail`, `featured`) VALUES
('1570429227', 'Roses Are Red', 'James Patterson', '2000', 'Time Warner Audio Major', 50, '10.00', 'book79.jpg', 'book79.jpg', 'book79.jpg', 'book79resized.jpg', 0),
('1586215809', 'The Big Bad Wolf: A Novel', 'James Patterson', '2003', 'Time Warner Audiobooks', 50, '50.00', 'book80.jpg', 'book80.jpg', 'book80.jpg', 'book80resized.jpg', 0),
('2290308404', 'Differentes saisons', 'Stephen King', '2000', 'Jai lu', 50, '10.00', 'book81.jpg', 'book81.jpg', 'book81.jpg', 'book81resized.jpg', 0),
('312955006', 'The Concrete Blonde (A Harry Bosch Novel)', 'Michael Connelly', '1995', 'St. Martins Paperbacks', 50, '15.00', 'book2.jpg', 'book2.jpg', 'book2.jpg', 'book2resized.jpg', 0),
('312958455', 'The Last Coyote (Last Coyote)', 'Michael Connelly', '1996', 'St. Martins Press', 50, '25.00', 'book3.jpg', 'book3.jpg', 'book3.jpg', 'book3resized.jpg', 0),
('316153915', 'Chasing the Dime', 'Michael Connelly', '2002', 'Little, Brown', 50, '10.00', 'book4.jpg', 'book4.jpg', 'book4.jpg', 'book4resized.jpg', 0),
('316693294', 'Cat and Mouse', 'James Patterson', '1997', 'Replica Books', 50, '15.00', 'book5.jpg', 'book5.jpg', 'book5.jpg', 'book5resized.jpg', 0),
('316710571', 'Sams Letters to Jennifer', 'James Patterson', '2004', 'Little, Brown', 50, '40.00', 'book6.jpg', 'book6.jpg', 'book6.jpg', 'book6resized.jpg', 0),
('3453052544', 'Christine. Roman.', 'Stephen King', '1991', 'Heyne', 50, '50.00', 'book82.jpg', 'book82.jpg', 'book82.jpg', 'book82resized.jpg', 0),
('3453061187', 'Die Jury. Roman.', 'John Grisham', '1992', 'Heyne', 50, '40.00', 'book83.jpg', 'book83.jpg', 'book83.jpg', 'book83resized.jpg', 0),
('3453108191', 'Schwarzes Eis.', 'Michael Connelly', '1996', 'Heyne', 50, '10.00', 'book84.jpg', 'book84.jpg', 'book84.jpg', 'book84resized.jpg', 0),
('3453136411', 'Das Urteil.', 'John Grisham', '1998', 'Heyne', 50, '40.00', 'book85.jpg', 'book85.jpg', 'book85.jpg', 'book85resized.jpg', 0),
('3453151720', 'Der Poet.', 'Michael Connelly', '1999', 'Heyne', 50, '25.00', 'book86.jpg', 'book86.jpg', 'book86.jpg', 'book86resized.jpg', 1),
('3453159926', 'Atlantis.', 'Stephen King', '1999', 'Heyne GmbH &amp; Co. KG, Verlag', 50, '15.00', 'book87.jpg', 'book87.jpg', 'book87.jpg', 'book87resized.jpg', 0),
('3453169247', 'Der Verrat.', 'John Grisham', '2000', 'Heyne', 50, '10.00', 'book88.jpg', 'book88.jpg', 'book88.jpg', 'book88resized.jpg', 0),
('345441036', 'Black House', 'Stephen King', '2002', 'Ballantine Books', 50, '10.00', 'book7.jpg', 'book7.jpg', 'book7.jpg', 'book7resized.jpg', 0),
('375727965', 'The Brethren', 'John Grisham', '2000', 'Random House Large Print Publishing', 50, '25.00', 'book8.jpg', 'book8.jpg', 'book8.jpg', 'book8resized.jpg', 0),
('385121679', 'The Shining', 'Stephen King', '1993', 'Doubleday Books', 50, '15.00', 'book9.jpg', 'book9.jpg', 'book9.jpg', 'book9resized.jpg', 0),
('385199570', 'The Stand (The Complete and Uncut Edition)', 'Stephen King', '1990', 'Doubleday Books', 50, '10.00', 'book10.jpg', 'book10.jpg', 'book10.jpg', 'book10resized.jpg', 0),
('385338600', 'A Time to Kill', 'JOHN GRISHAM', '2004', 'Dell', 50, '40.00', 'book11.jpg', 'book11.jpg', 'book11.jpg', 'book11resized.jpg', 0),
('385510438', 'The Last Juror', 'John Grisham', '2004', 'Doubleday', 50, '10.00', 'book12.jpg', 'book12.jpg', 'book12.jpg', 'book12resized.jpg', 0),
('385511612', 'Bleachers', 'John Grisham', '2003', 'Doubleday', 50, '10.00', 'book13.jpg', 'book13.jpg', 'book13.jpg', 'book13resized.jpg', 0),
('425105334', 'The Talisman', 'Stephen King', '1991', 'Berkley Publishing Group', 50, '25.00', 'book14.jpg', 'book14.jpg', 'book14.jpg', 'book14resized.jpg', 0),
('439136369', 'Harry Potter and the Prisoner of Azkaban (Book 3)', 'J. K. Rowling', '2001', 'Scholastic', 50, '10.00', 'book15.jpg', 'book15.jpg', 'book15.jpg', 'book15resized.jpg', 1),
('439139600', 'Harry Potter and the Goblet of Fire (Book 4)', 'J. K. Rowling', '2002', 'Scholastic Paperbacks', 50, '25.00', 'book16.jpg', 'book16.jpg', 'book16.jpg', 'book16resized.jpg', 0),
('439321603', 'Fantastic Beasts and Where to Find Them', 'J. K. Rowling', '2001', 'Scholastic Paperbacks', 50, '25.00', 'book17.jpg', 'book17.jpg', 'book17.jpg', 'book17resized.jpg', 1),
('439358078', 'Harry Potter and the Order of the Phoenix (Book 5)', 'J. K. Rowling', '2004', 'Scholastic Paperbacks', 50, '25.00', 'book18.jpg', 'book18.jpg', 'book18.jpg', 'book18resized.jpg', 0),
('439420105', 'Harry Potter and the Chamber of Secrets (Book 2)', 'J. K. Rowling', '2002', 'Scholastic', 50, '25.00', 'book19.jpg', 'book19.jpg', 'book19.jpg', 'book19resized.jpg', 0),
('440214041', 'The Pelican Brief', 'John Grisham', '1993', 'Dell', 50, '25.00', 'book20.jpg', 'book20.jpg', 'book20.jpg', 'book20resized.jpg', 0),
('440224764', 'The Partner', 'John Grisham', '1998', 'Dell Publishing Company', 50, '10.00', 'book21.jpg', 'book21.jpg', 'book21.jpg', 'book21resized.jpg', 0),
('440234743', 'The Testament', 'John Grisham', '1999', 'Dell', 50, '40.00', 'book22.jpg', 'book22.jpg', 'book22.jpg', 'book22resized.jpg', 0),
('440241073', 'The Summons', 'John Grisham', '2002', 'Dell Publishing Company', 50, '10.00', 'book23.jpg', 'book23.jpg', 'book23.jpg', 'book23resized.jpg', 0),
('440295521', 'The Runaway Jury', 'John Grisham', '1996', 'Dell Publishing Company', 50, '25.00', 'book24.jpg', 'book24.jpg', 'book24.jpg', 'book24resized.jpg', 0),
('446601241', 'Kiss the Girls', 'James Patterson', '1995', 'Warner Books', 50, '25.00', 'book25.jpg', 'book25.jpg', 'book25.jpg', 'book25resized.jpg', 0),
('446602612', 'The Poet', 'Michael Connelly', '1997', 'Warner Books', 50, '10.00', 'book26.jpg', 'book26.jpg', 'book26.jpg', 'book26resized.jpg', 0),
('446603929', 'See How They Run', 'James Patterson', '1997', 'Warner Books', 50, '10.00', 'book27.jpg', 'book27.jpg', 'book27.jpg', 'book27resized.jpg', 0),
('446607274', 'Angels Flight (Detective Harry Bosch Mysteries)', 'Michael Connelly', '2000', 'Warner Books', 50, '10.00', 'book28.jpg', 'book28.jpg', 'book28.jpg', 'book28resized.jpg', 0),
('446608815', 'Pop Goes the Weasel', 'James Patterson', '2000', 'Warner Vision', 50, '10.00', 'book29.jpg', 'book29.jpg', 'book29.jpg', 'book29resized.jpg', 0),
('446609404', 'Cradle and All', 'James Patterson', '2001', 'Warner Vision', 50, '15.00', 'book30.jpg', 'book30.jpg', 'book30.jpg', 'book30resized.jpg', 0),
('446610038', '1st to Die: A Novel', 'James Patterson', '2002', 'Warner Vision', 50, '15.00', 'book31.jpg', 'book31.jpg', 'book31.jpg', 'book31resized.jpg', 0),
('446611212', 'Violets Are Blue', 'James Patterson', '2002', 'Warner Vision', 50, '50.00', 'book32.jpg', 'book32.jpg', 'book32.jpg', 'book32resized.jpg', 0),
('446611611', 'City of Bones', 'Michael Connelly', '2003', 'Warner Books', 50, '10.00', 'book33.jpg', 'book33.jpg', 'book33.jpg', 'book33resized.jpg', 1),
('446612731', 'The Black Echo', 'Michael Connelly', '2002', 'Warner Books', 50, '10.00', 'book34.jpg', 'book34.jpg', 'book34.jpg', 'book34resized.jpg', 0),
('446612790', '2nd Chance', 'James Patterson', '2003', 'Warner Vision', 50, '50.00', 'book35.jpg', 'book35.jpg', 'book35.jpg', 'book35resized.jpg', 0),
('446613266', 'Four Blind Mice', 'James Patterson', '2003', 'Warner Books', 50, '15.00', 'book36.jpg', 'book36.jpg', 'book36.jpg', 'book36resized.jpg', 0),
('446613843', 'The Jester', 'James Patterson', '2004', 'Warner Books', 50, '10.00', 'book37.jpg', 'book37.jpg', 'book37.jpg', 'book37resized.jpg', 0),
('446615145', 'The Lake House', 'James Patterson', '2004', 'Warner Books', 50, '15.00', 'book38.jpg', 'book38.jpg', 'book38.jpg', 'book38resized.jpg', 0),
('446676411', 'The Midnight Club', 'James Patterson', '2000', 'Warner Books', 50, '10.00', 'book39.jpg', 'book39.jpg', 'book39.jpg', 'book39resized.jpg', 0),
('446679593', 'Suzannes Diary for Nicholas', 'James Patterson', '2002', 'Warner Books', 50, '25.00', 'book40.jpg', 'book40.jpg', 'book40.jpg', 'book40resized.jpg', 0),
('446692638', 'Along Came a Spider (Alex Cross Novels)', 'James Patterson', '2003', 'Warner Books', 50, '25.00', 'book41.jpg', 'book41.jpg', 'book41.jpg', 'book41resized.jpg', 0),
('451155750', 'The Dead Zone', 'Stephen King', '2004', 'Signet Book', 50, '10.00', 'book42.jpg', 'book42.jpg', 'book42.jpg', 'book42resized.jpg', 0),
('451156609', 'The Tommyknockers', 'Stephen King', '1994', 'Signet Book', 50, '50.00', 'book43.jpg', 'book43.jpg', 'book43.jpg', 'book43resized.jpg', 1),
('451162072', 'Pet Sematary', 'Stephen King', '1994', 'Signet Book', 50, '50.00', 'book44.jpg', 'book44.jpg', 'book44.jpg', 'book44resized.jpg', 0),
('451163524', 'The Drawing of the Three (The Dark Tower, Book 2)', 'Stephen King', '1997', 'Signet Book', 50, '10.00', 'book45.jpg', 'book45.jpg', 'book45.jpg', 'book45resized.jpg', 0),
('451166582', 'The Eyes of the Dragon', 'Stephen King', '2001', 'Signet Book', 50, '10.00', 'book46.jpg', 'book46.jpg', 'book46.jpg', 'book46resized.jpg', 1),
('451171810', 'The Dark Half', 'Stephen King', '1994', 'Signet', 50, '10.00', 'book47.jpg', 'book47.jpg', 'book47.jpg', 'book47resized.jpg', 0),
('451178114', 'Geralds Game', 'Stephen King', '1993', 'Signet Books', 50, '15.00', 'book48.jpg', 'book48.jpg', 'book48.jpg', 'book48resized.jpg', 0),
('451186362', 'Rose Madder', 'Stephen King', '2004', 'Signet Book', 50, '40.00', 'book49.jpg', 'book49.jpg', 'book49.jpg', 'book49resized.jpg', 0),
('451190491', 'The Two Dead Girls (Green Mile Series)', 'Stephen King', '1996', 'Signet Book', 50, '10.00', 'book50.jpg', 'book50.jpg', 'book50.jpg', 'book50resized.jpg', 0),
('451191013', 'The Regulators', 'Stephen King', '2002', 'Signet Book', 50, '15.00', 'book51.jpg', 'book51.jpg', 'book51.jpg', 'book51resized.jpg', 0),
('451191935', 'The Bachman Books: Rage, the Long Walk, Roadwork, the Runnin', 'Stephen King', '1991', 'Signet Book', 50, '40.00', 'book52.jpg', 'book52.jpg', 'book52.jpg', 'book52resized.jpg', 0),
('451210840', 'The Gunslinger (The Dark Tower, Book 1)', 'Stephen King', '2003', 'New American Library', 50, '25.00', 'book53.jpg', 'book53.jpg', 'book53.jpg', 'book53resized.jpg', 0),
('553452991', 'The Firm', 'John Grisham', '1991', 'Random House Audio', 50, '25.00', 'book54.jpg', 'book54.jpg', 'book54.jpg', 'book54resized.jpg', 0),
('553471392', 'The Client', 'John Grisham', '1993', 'Random House Audio', 50, '10.00', 'book55.jpg', 'book55.jpg', 'book55.jpg', 'book55resized.jpg', 0),
('553472348', 'The Chamber', 'John Grisham', '1994', 'Random House Audio', 50, '50.00', 'book56.jpg', 'book56.jpg', 'book56.jpg', 'book56resized.jpg', 1),
('553502042', 'The Rainmaker', 'John Grisham', '1997', 'Random House Audio', 50, '25.00', 'book57.jpg', 'book57.jpg', 'book57.jpg', 'book57resized.jpg', 0),
('553573403', 'A Game of Thrones (A Song of Ice and Fire, Book 1)', 'George R.R. Martin', '1997', 'Spectra Books', 50, '25.00', 'book58.jpg', 'book58.jpg', 'book58.jpg', 'book58resized.jpg', 0),
('553712527', 'A Painted House', 'John Grisham', '2001', 'Random House Audio Publishing Group', 50, '15.00', 'book59.jpg', 'book59.jpg', 'book59.jpg', 'book59resized.jpg', 0),
('590353403', 'Harry Potter and the Sorcerers Stone (Book 1)', 'J. K. Rowling', '1998', 'Scholastic', 50, '10.00', 'book60.jpg', 'book60.jpg', 'book60.jpg', 'book60resized.jpg', 0),
('613171004', 'Bag of Bones', 'Stephen King', '1999', 'Sagebrush Bound', 50, '15.00', 'book61.jpg', 'book61.jpg', 'book61.jpg', 'book61resized.jpg', 0),
('613329740', 'Quidditch Through the Ages', 'J. K. Rowling', '2001', 'Sagebrush Education Resources', 50, '10.00', 'book62.jpg', 'book62.jpg', 'book62.jpg', 'book62resized.jpg', 0),
('670813648', 'Misery', 'Stephen King', '1990', 'Viking Books', 50, '15.00', 'book63.jpg', 'book63.jpg', 'book63.jpg', 'book63resized.jpg', 0),
('670835382', 'Four Past Midnight', 'Stephen King', '1990', 'Viking Books', 50, '10.00', 'book64.jpg', 'book64.jpg', 'book64.jpg', 'book64resized.jpg', 0),
('670849367', 'Dolores Claiborne', 'Stephen King', '1992', 'Penguin USA', 50, '10.00', 'book65.jpg', 'book65.jpg', 'book65.jpg', 'book65resized.jpg', 0),
('670855030', 'Insomnia', 'Stephen King', '1994', 'Viking Books', 50, '15.00', 'book66.jpg', 'book66.jpg', 'book66.jpg', 'book66resized.jpg', 0),
('670868361', 'Desperation', 'Stephen King', '1996', 'Viking Books', 50, '15.00', 'book67.jpg', 'book67.jpg', 'book67.jpg', 'book67resized.jpg', 0),
('671024256', 'On Writing', 'Stephen King', '2001', 'Pocket', 50, '10.00', 'book68.jpg', 'book68.jpg', 'book68.jpg', 'book68resized.jpg', 0),
('671039733', 'Carrie', 'Stephen King', '2000', 'Pocket', 50, '15.00', 'book69.jpg', 'book69.jpg', 'book69.jpg', 'book69resized.jpg', 1),
('684853507', 'BAG OF BONES : A NOVEL', 'Stephen King', '1998', 'Scribner', 50, '10.00', 'book70.jpg', 'book70.jpg', 'book70.jpg', 'book70resized.jpg', 0),
('684867621', 'The Girl Who Loved Tom Gordon : A Novel', 'Stephen King', '1999', 'Scribner', 50, '10.00', 'book71.jpg', 'book71.jpg', 'book71.jpg', 'book71resized.jpg', 0),
('717284832', '101 Dalmatians', 'Walt Disney', '1995', 'Stoddart+publishing', 50, '15.00', 'book72.jpg', 'book72.jpg', 'book72.jpg', 'book72resized.jpg', 1),
('739302248', 'The King of Torts', 'John Grisham', '2003', 'Random House Audio Publishing Group', 50, '10.00', 'book73.jpg', 'book73.jpg', 'book73.jpg', 'book73resized.jpg', 0),
('743211383', 'Dreamcatcher', 'Stephen King', '2001', 'Scribner', 50, '10.00', 'book74.jpg', 'book74.jpg', 'book74.jpg', 'book74resized.jpg', 0),
('743235150', 'Everythings Eventual : 14 Dark Tales', 'Stephen King', '2002', 'Scribner', 50, '15.00', 'book75.jpg', 'book75.jpg', 'book75.jpg', 'book75resized.jpg', 0),
('743417682', 'From a Buick 8', 'Stephen King', '2003', 'Pocket Books', 50, '40.00', 'book76.jpg', 'book76.jpg', 'book76.jpg', 'book76resized.jpg', 0),
('743436210', 'Hearts in Atlantis', 'Stephen King', '2001', 'Pocket', 50, '15.00', 'book77.jpg', 'book77.jpg', 'book77.jpg', 'book77resized.jpg', 0),
('831713097', 'Cinderella', 'Walt Disney Productions', '1997', 'Mouse Works', 50, '50.00', 'book78.jpg', 'book78.jpg', 'book78.jpg', 'book78resized.jpg', 0),
('8440691491', 'El Testamento', 'John Grisham', '1999', 'Ediciones B', 50, '10.00', 'book89.jpg', 'book89.jpg', 'book89.jpg', 'book89resized.jpg', 0),
('99244926', 'The Street Lawyer', 'John Grisham', '1999', 'Random House Uk Ltd', 50, '10.00', 'book1.jpg', 'book1.jpg', 'book1.jpg', 'book1resized.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ordereditem`
--

CREATE TABLE IF NOT EXISTS `ordereditem` (
  `orderID` int(10) unsigned NOT NULL,
  `custID` int(10) unsigned NOT NULL,
  `ISBN` varchar(10) NOT NULL,
  `orderedQty` int(10) unsigned NOT NULL,
  `sellingPrice` decimal(10,2) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ordereditem`
--

INSERT INTO `ordereditem` (`orderID`, `custID`, `ISBN`, `orderedQty`, `sellingPrice`) VALUES
(8, 603, '385121679', 1, '10.00'),
(8, 603, '439139600', 2, '10.00'),
(9, 603, '99244926', 1, '10.00'),
(10, 603, '316153915', 1, '10.00'),
(11, 603, '312955006', 1, '10.00'),
(12, 605, '99244926', 1, '10.00'),
(13, 605, '312955006', 1, '10.00'),
(13, 605, '99244926', 1, '10.00'),
(14, 606, '439136369', 1, '10.00'),
(15, 606, '345441036', 1, '10.00'),
(15, 606, '439358078', 2, '10.00'),
(16, 607, '439136369', 1, '10.00'),
(16, 607, '439321603', 1, '10.00'),
(17, 608, '385510438', 6, '10.00'),
(17, 608, '316710571', 2, '10.00'),
(18, 603, '385338600', 1, '10.00'),
(18, 603, '316710571', 1, '10.00'),
(19, 611, '99244926', 2, '10.00'),
(20, 611, '439420105', 1, '10.00'),
(21, 603, '439136369', 2, '10.00'),
(21, 603, '439358078', 1, '25.00'),
(22, 603, '316693294', 1, '15.00'),
(23, 607, '439136369', 1, '10.00'),
(23, 607, '440214041', 1, '25.00'),
(23, 607, '717284832', 1, '15.00'),
(24, 603, '3453151720', 2, '25.00'),
(24, 603, '439136369', 1, '10.00'),
(24, 603, '316693294', 1, '15.00'),
(25, 603, '3453151720', 10, '25.00'),
(26, 603, '1570429227', 1, '10.00'),
(27, 616, '439136369', 2, '10.00'),
(28, 616, '3453151720', 1, '25.00'),
(29, 619, '1570429227', 2, '10.00'),
(30, 619, '439136369', 1, '10.00'),
(31, 619, '439321603', 1, '25.00'),
(32, 620, '3453151720', 1, '25.00'),
(32, 620, '439136369', 1, '10.00'),
(33, 621, '439136369', 1, '10.00'),
(33, 621, '439321603', 1, '25.00');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `orderID` int(11) NOT NULL,
  `custID` int(10) unsigned NOT NULL,
  `orderDate` date NOT NULL,
  `dispatchDate` date DEFAULT NULL,
  `delDate` date DEFAULT NULL,
  `orderNet` decimal(10,2) unsigned NOT NULL,
  `delTo` varchar(60) NOT NULL,
  `delAddress1` varchar(45) NOT NULL,
  `delAddress2` varchar(45) DEFAULT NULL,
  `delState` enum('KUL','JHR','KDH','PNG','PRK','SBH','SWK') NOT NULL,
  `delPostCode` int(10) unsigned NOT NULL,
  `delInstructions` varchar(255) DEFAULT NULL,
  `delValue` decimal(10,2) unsigned NOT NULL,
  `paymentType` enum('MC','VS','MB','PP') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderID`, `custID`, `orderDate`, `dispatchDate`, `delDate`, `orderNet`, `delTo`, `delAddress1`, `delAddress2`, `delState`, `delPostCode`, `delInstructions`, `delValue`, `paymentType`) VALUES
(8, 603, '2017-09-02', '2017-09-02', '2017-09-04', '31.00', 'abdullah ahmad', 'badikeren', 'badikeren', 'KUL', 1234, '', '1.00', 'MC'),
(9, 603, '2017-09-02', '2017-09-02', '2017-09-04', '11.00', 'abdullah ahmad', 'badikeren', 'badikeren', 'KUL', 1234, '', '1.00', 'MC'),
(10, 603, '2017-09-02', '2017-09-02', '2017-09-04', '11.00', 'abdullah ahmad', 'badikeren', 'badikeren', 'KUL', 1234, '', '1.00', 'MC'),
(11, 603, '2017-09-02', '2017-09-02', '2017-09-04', '11.00', 'abdullah ahmad', 'badikeren', 'badikeren', 'KUL', 1234, '', '1.00', 'MC'),
(12, 605, '2017-09-03', '2017-09-03', '2017-09-05', '11.00', 'fikrah alay', 'jebe alay', 'alay', 'KUL', 6547, '', '1.00', 'MC'),
(13, 605, '2017-09-03', '2017-09-03', '2017-09-05', '21.00', 'fikrah alay', 'jebe alay', 'alay', 'KUL', 6547, '', '1.00', 'MC'),
(14, 606, '2017-09-03', '2017-09-03', '2017-09-05', '11.00', 'sherlock holmes', 'baker st1', 'no. 63543', 'KUL', 1466, '', '1.00', 'MC'),
(15, 606, '2017-09-03', '2017-09-03', '2017-09-05', '31.00', 'sherlock holmes', 'baker st1', 'no. 63543', 'KUL', 1466, '', '1.00', 'MC'),
(16, 607, '2017-09-03', '2017-09-03', '2017-09-05', '21.00', 'Ricard Hendrix', 'Erlich Bachman Incubator', 'Silicon Valley', 'KUL', 666, '', '1.00', 'MC'),
(17, 608, '2017-09-03', '2017-09-03', '2017-09-05', '81.00', 'nizam pababbari', 'endah', 'promenade', 'KUL', 9999, 'jhvjhvhj', '1.00', 'MC'),
(18, 603, '2017-09-11', '2017-09-11', '2017-09-13', '25.00', 'Abdullah Ahmad', 'baker street', 'Moriarty', 'PNG', 1200, 'please deliver it to john watson', '5.00', 'MC'),
(19, 611, '2017-09-11', '2017-09-11', '2017-09-13', '21.00', 'Muhammad Febrik', 'endah pronened', '', 'KUL', 5700, '', '1.00', 'MC'),
(20, 611, '2017-09-11', '2017-09-11', '2017-09-13', '11.00', 'Muhammad Febrik', 'endah pronened', '', 'KUL', 5700, '', '1.00', 'MC'),
(21, 603, '2017-09-13', '2017-09-13', '2017-09-15', '50.00', 'Abdullah Ahmad', 'baker street', 'Moriarty', 'PNG', 1200, '', '5.00', 'MC'),
(22, 603, '2017-09-14', '2017-09-14', '2017-09-16', '20.00', 'Abdullah Ahmad', 'baker street', 'Moriarty', 'PNG', 1200, '', '5.00', 'MC'),
(23, 607, '2017-09-17', '2017-09-17', '2017-09-19', '58.00', 'Ricard Hendrix', 'Erlich Bachman Incubator', 'Silicon Valley', 'PRK', 420, 'please deliver it in front of our garage server room', '8.00', 'PP'),
(24, 603, '2017-09-18', '2017-09-18', '2017-09-20', '80.00', 'Abdullah Ahmad', 'baker street', 'Moriarty', 'PNG', 1200, '', '5.00', 'MC'),
(25, 603, '2017-09-19', '2017-09-19', '2017-09-21', '255.00', 'Abdullah Ahmad', 'baker street', 'Moriarty', 'PNG', 1200, '', '5.00', 'MC'),
(26, 603, '2017-09-19', '2017-09-19', '2017-09-21', '15.00', 'Abdullah Ahmad', 'baker street', 'Moriarty', 'PNG', 1200, '', '5.00', 'MB'),
(27, 616, '2017-10-09', '2017-10-09', '2017-10-11', '21.00', 'jaya karim', 'enda promenade', '', 'KUL', 5700, 'it would nice if i can get the book beffore 4 pm tomorrow', '1.00', 'MC'),
(28, 616, '2017-10-09', '2017-10-09', '2017-10-11', '26.00', 'jaya karim', 'enda promenade', '', 'KUL', 5700, '', '1.00', 'MC'),
(29, 619, '2017-09-19', '2017-09-19', '2017-09-21', '21.00', 'Anakin Skywalker', 'Padawan', 'Obi Wan Kenobi', 'KUL', 1200, 'Please deliver it to Luke hehehe', '1.00', 'MB'),
(30, 619, '2017-09-19', '2017-09-19', '2017-09-21', '22.00', 'Anakin Skywalker', 'Tatooine', 'Obi Wan Kenobi', 'SBH', 1200, '', '12.00', 'MC'),
(31, 619, '2017-09-19', '2017-09-19', '2017-09-21', '37.00', 'Anakin Skywalker', 'Tatooine', 'Obi Wan Kenobi', 'SBH', 1200, '', '12.00', 'MC'),
(32, 620, '2017-11-01', '2017-11-01', '2017-11-03', '36.00', 'syewele asdsaj', 'sadjfs', 'jdfsajdfa', 'KUL', 4132, '', '1.00', 'MC'),
(33, 621, '2017-11-01', '2017-11-01', '2017-11-03', '41.50', 'Abdullah Alkaff', 'Endah Promenade', 'c abcdefg', 'KDH', 1200, 'in front of my house', '6.50', 'MC');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE IF NOT EXISTS `ratings` (
  `custID` int(10) unsigned NOT NULL,
  `ISBN` varchar(40) NOT NULL,
  `rating` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`custID`, `ISBN`, `rating`) VALUES
(603, '99244926', 3),
(603, '312955006', 5),
(603, '316153915', 4),
(603, '316710571', 2),
(603, '385199570', 4),
(603, '670835382', 5),
(603, '2290308404', 2),
(605, '99244926', 5),
(605, '312955006', 3),
(603, '440214041', 4),
(603, '446607274', 3),
(604, '99244926', 4),
(604, '440234743', 3),
(605, '446603929', 5),
(605, '439420105', 4),
(605, '439136369', 5),
(605, '439321603', 3),
(605, '8440691491', 3),
(606, '99244926', 5),
(606, '312955006', 4),
(606, '312958455', 3),
(606, '439136369', 4),
(606, '345441036', 4),
(606, '439358078', 4),
(607, '99244926', 3),
(607, '312955006', 3),
(607, '439136369', 4),
(607, '439321603', 5),
(608, '385510438', 1),
(608, '316710571', 5),
(608, '312958455', 5),
(611, '99244926', 5),
(611, '312955006', 4),
(611, '312958455', 5),
(611, '439420105', 4),
(603, '1586215809', 4),
(603, '3453151720', 4),
(603, '439136369', 4),
(603, '1570429227', 4),
(613, '3453151720', 4),
(613, '1586215809', 5),
(616, '1586215809', 5),
(616, '439136369', 5),
(616, '3453151720', 5),
(619, '2290308404', 4),
(619, '1570429227', 5),
(619, '439136369', 5),
(619, '439321603', 5),
(620, '1570429227', 5),
(620, '1586215809', 5),
(620, '316153915', 5),
(620, '439136369', 5),
(620, '3453151720', 5),
(621, '439136369', 4),
(621, '439321603', 5);

-- --------------------------------------------------------

--
-- Table structure for table `Temp`
--

CREATE TABLE IF NOT EXISTS `Temp` (
  `custID` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TFIDF_Temp`
--

CREATE TABLE IF NOT EXISTS `TFIDF_Temp` (
  `cartBook` int(10) unsigned NOT NULL,
  `comparisonBook` varchar(40) NOT NULL,
  `TFIDF_score` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `userCF_Recommender`
--

CREATE TABLE IF NOT EXISTS `userCF_Recommender` (
  `custID` int(10) unsigned NOT NULL,
  `ISBN` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userCF_Recommender`
--

INSERT INTO `userCF_Recommender` (`custID`, `ISBN`) VALUES
(605, '451171810'),
(605, '440295521'),
(605, '451178114'),
(605, '671039733'),
(605, '1586215809'),
(605, '385121679'),
(605, '451210840'),
(605, '717284832'),
(605, '451191935'),
(605, '3453136411'),
(604, '439136369'),
(604, '446611212'),
(604, '446610038'),
(604, '446612790'),
(604, '312955006'),
(604, '590353403'),
(604, '446609404'),
(604, '739302248'),
(604, '451171810'),
(604, '446602612'),
(606, '451171810'),
(606, '316153915'),
(606, '739302248'),
(606, '446615145'),
(606, '451162072'),
(606, '446602612'),
(606, '446607274'),
(606, '446613266'),
(606, '439139600'),
(606, '446613843'),
(608, '439420105'),
(608, '3453052544'),
(608, '743211383'),
(608, '3453136411'),
(608, '439358078'),
(608, '451186362'),
(608, '590353403'),
(608, '451166582'),
(608, '613329740'),
(608, '831713097'),
(613, '446601241'),
(613, '684867621'),
(613, '440224764'),
(613, '385511612'),
(613, '446611212'),
(613, '446612790'),
(613, '446610038'),
(613, '743235150'),
(613, '743436210'),
(613, '440234743'),
(611, '3453136411'),
(611, '316153915'),
(611, '743436210'),
(611, '440234743'),
(611, '743417682'),
(611, '446611611'),
(611, '446601241'),
(611, '451166582'),
(611, '670835382'),
(611, '743211383'),
(619, '451155750'),
(619, '440234743'),
(619, '684867621'),
(619, '446603929'),
(619, '451166582'),
(619, '446679593'),
(619, '451191013'),
(619, '670868361'),
(619, '451162072'),
(619, '451190491'),
(607, '385510438'),
(607, '446612731'),
(607, '684867621'),
(607, '670813648'),
(607, '670868361'),
(607, '451190491'),
(607, '446603929'),
(607, '684853507'),
(607, '446611611'),
(607, '451191013'),
(603, '446692638'),
(603, '553712527'),
(603, '385338600'),
(603, '670855030'),
(603, '670849367'),
(603, '3453061187'),
(603, '385121679'),
(603, '446603929'),
(603, '553472348'),
(603, '670868361'),
(620, '451162072'),
(620, '440224764'),
(620, '446603929'),
(620, '451191013'),
(620, '670868361'),
(620, '451166582'),
(620, '446679593'),
(620, '3453159926'),
(620, '613171004'),
(620, '451186362'),
(621, '385510438'),
(621, '553573403'),
(621, '446612790'),
(621, '446610038'),
(621, '446611212'),
(621, '446612731'),
(621, '684867621'),
(621, '451156609'),
(621, '670813648'),
(621, '670855030');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`custID`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`ISBN`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `custID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=622;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
