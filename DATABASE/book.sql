-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2022 at 03:04 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`name`, `email`, `pass`) VALUES
('Rahul Bhati', 'rb083380@gmail.com', 'rahul@123');

-- --------------------------------------------------------

--
-- Table structure for table `book_data`
--

CREATE TABLE `book_data` (
  `sn` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `detail` mediumblob NOT NULL,
  `category` varchar(255) NOT NULL,
  `price` varchar(222) NOT NULL,
  `mrp` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_data`
--

INSERT INTO `book_data` (`sn`, `code`, `title`, `detail`, `category`, `price`, `mrp`, `email`) VALUES
(1, '123489_1', 'The Art City', 0x53796d626f6c206f662049636f6e, 'Stories', '11$', '15$', 'rb083380@gmail.com'),
(2, '014589_1', 'Give Thanks In EveryThing Haapy', 0x45766572796f6e6520736d696c6520697320612070726563696f7573, 'Stories', '11$', '12$', 'rb083380@gmail.com'),
(3, 'a01489_3', 'Best Gifts', 0x4269672073616c6520616e64204c6f772050726963652047696674, 'Magazines', '3$', '5$', 'rb083380@gmail.com'),
(4, 'A13678_4', 'Your Name', 0x41206d616e676120626f6f6b2061626f757420636f6d656479202c206472616d61202c207363686f6f6c2053746f72792e, 'Stories', '20$', '30$', 'rb083380@gmail.com'),
(5, 'A03689_5', 'Be GarateFul and Give Thank', 0x42652047617261746546756c20616e642047697665205468616e6b, 'Magazines', '21$', '25$', 'rb083380@gmail.com'),
(6, '123578_6', 'Music Rock', 0x4c697374656e206d7573696320697320616c77617973206120676f6f642069646561, 'Magazines', '3$', '5$', 'raaj@gmail.com'),
(7, 'Aa5678_7', 'AI Revolution', 0x526f62696e204c49205072656661636520627920436978696e20204c4955, 'Engineering', '50$', '55$', 'raaj@gmail.com'),
(8, 'a45689_8', 'Mechanical Engineering', 0x522e4b2053696e67616c204d726964756c2053696e67616c2052697368692053696e67616c, 'Competative Exam', '7 $', '10$', 'raaj@gmail.com'),
(9, 'a01458_9', 'Materials', 0x436976696c20456e67696e656572696e6720496e74726f64756374696f6e20616e64206c61626f7261746f72792074657374696e67, 'Engineering', '8$', '10$', 'raaj@gmail.com'),
(10, 'a12578_10', 'SSC CHSL ', 0x4c44432f44454f2f5053412054696572203120436f6d62696e65642048696768205365636f6e64617279204c6576656c2062792041726968616e74, 'Competative Exam', '3$', '5$', 'raaj@gmail.com'),
(11, 'A15678_11', 'Computer Engineering', 0x45787072657373205075626c69636174696f6e, 'Engineering', '5$', '10$', 'rb083380@gmail.com'),
(12, 'Aa2358_12', 'Surgical Suture', 0x4120636f6d706c6574652073746570206279207374657020677569646520666f7220646f63746f72202c6e7572736573202c706172616d6564696373206f6e20737572676963616c2074656368696e7175652e, 'Medical', '7$', '10$', 'kamal@gmail.com'),
(13, '234678_13', 'Biochemistry', 0x54657874626f6f6b206f662042696f6368656d697374727920666f72204d65646963616c2053747564656e74732e20496e636c7564696e67206c6f6e6720616e642073686f7274207479706520717565202c20616e7320616e64206361736520737475646965732e0d0a444d2056617375646576616e202c20537265656b756d617269205320616e64204b616e6e616e205661696479616e617468616e2e0d0a4549474854482045444954494f4e2e, 'Medical', '55$', '70$', 'kamal@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `code` varchar(255) NOT NULL,
  `book_code` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`code`, `book_code`, `email`) VALUES
('a02356', '123578_6', 'rb083380@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `code` varchar(255) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`code`, `cat_name`, `status`) VALUES
('Aa0124', 'Engineering', 0),
('A13678', 'Medical', 0),
('a02479', 'Magzines', 0),
('Aa1689', 'Competative Exam', 0),
('a02347', 'Management Book', 0),
('a15678', 'School Book', 0),
('034679', 'Stories', 0);

-- --------------------------------------------------------

--
-- Table structure for table `msg`
--

CREATE TABLE `msg` (
  `code` varchar(255) NOT NULL,
  `book_code` varchar(255) NOT NULL,
  `from_email` varchar(222) NOT NULL,
  `to_email` varchar(222) NOT NULL,
  `msg_send` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `msg`
--

INSERT INTO `msg` (`code`, `book_code`, `from_email`, `to_email`, `msg_send`) VALUES
('A23489', 'A03689_5', 'raaj@gmail.com', 'rb083380@gmail.com', 'I want This Book'),
('Aa4568', 'a01489_3', 'raaj@gmail.com', 'rb083380@gmail.com', 'I want this book'),
('A02489', '014589_1', 'raaj@gmail.com', 'rb083380@gmail.com', 'hii i want this book');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`name`, `email`, `phone`, `pass`, `status`) VALUES
('Rahul ', 'rb083380@gmail.com', '9001285494', '12', 0),
('raaj', 'raaj@gmail.com', '8934512742', '453', 0),
('Kamal', 'kamal@gmail.com', '2452352352', '231', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
