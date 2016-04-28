-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Apr 28, 2016 at 02:03 PM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `ielanat`
--

-- --------------------------------------------------------

--
-- Table structure for table `allads`
--

CREATE TABLE `allads` (
  `id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `subcategory` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `price` varchar(20) NOT NULL,
  `description` varchar(400) NOT NULL,
  `city` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `locality` varchar(200) NOT NULL,
  `images` varchar(100) NOT NULL,
  `mobile` int(15) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `allads`
--

INSERT INTO `allads` (`id`, `category`, `subcategory`, `title`, `price`, `description`, `city`, `address`, `locality`, `images`, `mobile`, `time`) VALUES
(28, 'Mobiles', 'Houses', 'hii', 'AED567', 'gh', 'dfghjk', 'dgfh', '', 'http://192.168.1.100/ielanat/uploads/1461580268.jpeg', 0, '2016-04-25 10:31:08');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `adid` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `message` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `adid`, `phone`, `message`) VALUES
(1, '', '', '', '', ''),
(2, 'asdfafsafasd', 'ada', 'kn ', '898', '7jb ,jnbdsjnjk'),
(3, 'adsnjsd', 'jknhkbhj', 'khbhjbj', 'hbkjbh', 'khbkb\r\n'),
(4, '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `message` varchar(300) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `phone`, `message`) VALUES
(1, 'fghg', ' v', ' fghg', 'vvvfghg'),
(2, 'xnkj', 'kjhkjjk', '', 'jkhjbjm89ou'),
(3, '', '', '', ''),
(4, 'xnkj', 'kjhkjjk', '', 'jkhjbjm89ou'),
(5, 'xnkj', 'kjhkjjk', '', 'jkhjbjm89ou'),
(6, '', '', '', ''),
(7, '', '', '', ''),
(8, '', '', '', ''),
(9, '', '', '', ''),
(10, '', '', '', ''),
(11, '', '', '', ''),
(12, '', '', '', ''),
(13, '', '', '', ''),
(14, '', '', '', ''),
(15, '', '', '', ''),
(16, '', '', '', ''),
(17, '', '', '', ''),
(18, '', '', '', ''),
(19, '', '', '', ''),
(20, '', '', '', ''),
(21, '', '', '', ''),
(22, '', '', '', ''),
(23, '', '', '', ''),
(24, 'xnkj', 'kjhkjjk', '', 'jkhjbjm89ou'),
(25, '', '', '', ''),
(26, '', '', '', ''),
(27, ' Name', 'Email', 'Phone No', 'Message...'),
(28, ' Name', 'Email', 'Phone No', 'Message...'),
(29, 'wejfkwjkefwjkf', 'ielanat', 'ielanat', 'ielanatielanat'),
(30, '', '', '', ''),
(31, '', '', '', ''),
(32, ' Name', 'Email', 'Phone No', 'Message...');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `memberID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `active` varchar(255) NOT NULL,
  `resetToken` varchar(255) DEFAULT NULL,
  `resetComplete` varchar(3) DEFAULT 'No'
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`memberID`, `name`, `username`, `password`, `email`, `active`, `resetToken`, `resetComplete`) VALUES
(1, 'surendra reddy', 'surendrak', '$2y$10$Q54pSeNumTxPP7EX6Y15beKt/8xUwTGppP8zOPZzUjSh9YuPo8O5i', 'surendra.reddy@studentpartner.com', 'Yes', 'bc528119b8f97791be163887a31f10e9', 'Yes'),
(4, 'surendra reddy', 'surendrak96', '$2y$10$kPprmdckGqiWpbiSbw97OOkuGRn4G/mkFTCifi4RF4UTuIilP0aD6', 'imsurendra99@gmail.com', '5be47efe896a59b72c9eeae6170cf852', NULL, 'No');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allads`
--
ALTER TABLE `allads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`memberID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allads`
--
ALTER TABLE `allads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `memberID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;