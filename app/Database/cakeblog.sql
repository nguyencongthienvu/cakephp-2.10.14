-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 07, 2019 at 09:32 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cakeblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `body` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `body`, `created`, `modified`) VALUES
(1, 'The title', 'This is the post body.', '2018-12-20 11:19:53', NULL),
(2, 'A title once again', 'And the post body follows.', '2018-12-20 11:19:53', NULL),
(3, 'Title strikes back', 'This is really exciting! Not.', '2018-12-20 11:19:53', NULL),
(4, 'A title once again', 'And the post body follows.', '2018-12-20 16:46:24', NULL),
(5, 'Title strikes back', 'This is really exciting! Not.', '2018-12-20 16:46:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `postview`
--

CREATE TABLE `postview` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `body` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `postview`
--

INSERT INTO `postview` (`id`, `title`, `body`, `created`, `modified`) VALUES
(1, 'The title', 'This is the post body.', '2018-12-20 16:46:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `postviews`
--

CREATE TABLE `postviews` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `body` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `postviews`
--

INSERT INTO `postviews` (`id`, `title`, `body`, `created`, `modified`) VALUES
(12, 'VuTitle', 'sadasdasdfdsf ff df sdf sdfa', '2018-12-21 10:53:46', '2019-01-07 08:34:10'),
(15, 'VuNek', 'ahihi', '2018-12-24 02:27:49', '2018-12-24 02:27:49'),
(16, 'VuGa', 'asdasda', '2018-12-24 02:37:14', '2018-12-24 02:37:14'),
(21, 'saf', 'asf', '2018-12-24 02:48:03', '2018-12-24 02:48:03'),
(22, 'wa', 'sda', '2018-12-24 02:49:19', '2018-12-24 02:49:19'),
(23, 'test', 'asd', '2018-12-24 02:49:50', '2018-12-24 02:49:50'),
(24, 'query2', 'asdas', '2018-12-24 02:50:25', '2018-12-24 02:50:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `access_token` varchar(500) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `facebook_id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `picture_url` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `access_token`, `created`, `modified`, `facebook_id`, `email`, `picture_url`) VALUES
(1, 'Admin', '93477851451f6583c7efd383e715cb6f8accb804', '1', '93477851451f6583c7efd383e715cb6f8accb804', '2018-12-25 10:29:56', '2018-12-25 10:29:56', 0, 'Admin2@gmail.com', ''),
(46, 'Thien Vu Nguyen', NULL, '1', 'EAAHL1ZB7ncpsBAL9gnAuwv6cxoZAyUDRuBIZCShxjsPnTRRxKbE6BEdZBdE4uand9BriQ12oe04tDsXyEpGzrPZBQnmuuQBZBIZBJZBo4V0ZCp6AOgjS4KaKExbDRhdVSofHcmluZBZB1w9Dum0ofxzadNzxO8VZAeXHXm7d7AFdWBRSagZDZD', '2019-01-07 08:48:10', '2019-01-07 08:48:10', 1211773292306359, 'angelnguyen234@gmail.com', 'https://platform-lookaside.fbsbx.com/platform/profilepic/?asid=1211773292306359&height=50&width=50&ext=1549439290&hash=AeRQMo7jh83gwibG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `postview`
--
ALTER TABLE `postview`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `postviews`
--
ALTER TABLE `postviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `postview`
--
ALTER TABLE `postview`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `postviews`
--
ALTER TABLE `postviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
