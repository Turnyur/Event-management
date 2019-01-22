-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2018 at 07:26 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php-jquery_example`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `event_title` varchar(80) COLLATE utf8_unicode_ci DEFAULT 'NULL',
  `event_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `event_start` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `event_end` timestamp NOT NULL,
  `user_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `event_type` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `event_venue` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `event_title`, `event_desc`, `event_start`, `event_end`, `user_name`, `event_type`, `event_venue`) VALUES
(2, 'dLast Day of January', 'Last day of the month! Yay!', '2018-01-29 23:00:00', '2018-02-05 08:09:33', 'Turnyur', NULL, NULL),
(4, 'Starting January', 'This is the start of January 2018', '2017-12-31 23:00:00', '2018-02-05 08:09:48', 'godspower', NULL, NULL),
(67, 'Godspower', 'Gosp', '2018-02-07 07:31:35', '2018-02-07 22:59:59', 'Godspower', NULL, NULL),
(68, 'Gospower', 'hth', '2018-02-15 07:05:36', '2018-02-15 22:59:59', 'Godspower', NULL, NULL),
(69, 'GGodspower', 'ggg', '2018-02-28 07:32:36', '2018-02-28 07:32:36', 'Godspower', NULL, NULL),
(82, 'Top Security Derivative ', 'This is a test of the Top security Derivative with a magniferouess interconthghg of the a very wonderful', '2018-02-23 13:49:33', '2018-02-23 22:59:59', 'Godspower', NULL, NULL),
(71, 'Chukwudi Williams The Great', 'Testing of Multiple insertattion of one of the worlds most deadly code writing nug', '2018-02-16 07:45:39', '2018-02-16 07:45:39', 'Turnyur', NULL, NULL),
(76, 'TESinng of 25', 'Chineke meee iwepuhalam ', '2018-04-03 14:09:57', '2018-04-03 22:59:59', 'Godspower', NULL, NULL),
(77, 'Introducing jQuery', 'Introducing jQuery pluggins', '2018-02-19 15:10:04', '2018-02-19 22:59:59', 'Godspower', NULL, NULL),
(78, 'Another Test', 'Another of the Testsss', '2018-02-20 15:21:06', '2018-02-20 22:59:59', 'Godspower', NULL, NULL),
(83, 'October Gods work', 'Star boy come me number one', '2018-02-06 06:46:20', '2018-02-06 22:59:59', 'Godspower', NULL, NULL),
(84, 'October Test to fix bugs', 'This is to test October work with its associated stuffs', '2018-10-10 06:18:35', '2018-02-10 22:59:59', 'Godspower', NULL, NULL),
(156, 'Thank God for Jesus Christ', 'The International Community', '2018-02-18 16:05:21', '2018-02-18 22:59:59', 'WilliamChuks', 'wedding', 'rrrrr'),
(89, 'December Test for Username', 'The following activity is some how restricted to practical handling of one of the worlds most astute professional', '2018-12-04 08:45:28', '2018-12-04 08:45:28', 'WilliamChuks', NULL, NULL),
(142, 'Joint Fellowship Congress', 'From Umuahia straight to Abuja. this is so that international communities will align with forces in the natural domain of catsFrom Umuahia straight to Abuja. this is so that international communities will align with forces in the natural domain of catsFrom Umuahia straight to Abuja. this is so that international communities will align with forces in the natural domain of catsFrom Umuahia straight to Abuja. this is so that international communities will align with forces in the natural domain of catsFrom Umuahia straight to Abuja. this is so that international communities will align with forces in the natural domain of catsFrom Umuahia straight to Abuja. this is so that international communities will align with forces in the natural domain of catsFrom Umuahia straight to Abuja. this is so that international communities will align with forces in the natural domain of catsFrom Umuahia straight to Abuja. this is so that international communities will align with forces in the natural domain of catsFrom Umuahia straight to Abuja. this is so that international communities will align with forces in the natural domain of catsFrom Umuahia straight to Abuja. this is so that international communities will align with forces in the natural domain of catsFrom Umuahia straight to Abuja. this is so that international communities will align with forces in the natural domain of catsFrom Umuahia straight to Abuja. this is so that international communities will align with forces in the natural domain of catsFrom Umuahia straight to Abuja. this is so that international communities will align with forces in the natural domain of catsFrom Umuahia straight to Abuja. this is so that international communities will align with forces in the natural domain of catsFrom Umuahia straight to Abuja. this is so that international communities will align with forces in the natural domain of catsFrom Umuahia straight to Abuja. this is so that international communities will align with forces in the natural domain of catsFrom Umuahia straight to Abuja. this is so that international communities will align with forces in the natural domain of catsFrom Umuahia straight to Abuja. this is so that international communities will align with forces in the natural domain of catsFrom Umuahia straight to Abuja. this is so that international communities will align with forces in the natural domain of catsFrom Umuahia straight to Abuja. this is so that international communities will align with forces in the natural domain of catsFrom Umuahia straight to Abuja. this is so that international communities will align with forces in the natural domain of catsFrom Umuahia straight to Abuja. this is so that international communities will align with forces in the natural domain of catsFrom Umuahia straight to Abuja. this is so that international communities will align with forces in the natural domain of catsFrom Umuahia straight to Abuja. this is so that international communities will align with forces in the natural domain of catsFrom Umuahia straight to Abuja. this is so that international communities will align with forces in the natural domain of catsFrom Umuahia straight to Abuja. this is so that international communities will align with forces in the natural domain of catsFrom Umuahia straight to Abuja. this is so that international communities will align with forces in the natural domain of catsFrom Umuahia straight to Abuja. this is so that international communities will align with forces in the natural domain of catsFrom Umuahia straight to Abuja. this is so that international communities will align with forces in the natural domain of catsFrom Umuahia straight to Abuja. this is so that international communities will align with forces in the natural domain of catsFrom Umuahia straight to Abuja. this is so that international communities will align with forces in the natural domain of catsFrom Umuahia straight to Abuja. this is so that international communities will align with forces in the natural domain of catsFrom Umuahia straight to Abuja. this is so that international communities will align with forces in the natural domain of cats', '2018-02-14 22:35:26', '2018-02-14 22:59:59', 'WilliamChuks', 'wedding', 'Michael okpara University'),
(143, 'Overtaking is allowed. ', 'President BCA sports. Chairmen Harvester hotels and suites ', '2018-01-10 22:24:33', '2018-01-10 22:59:59', 'WilliamChuks', 'Vacation', 'Onisha Main Market'),
(150, 'Web of Multiple Inter-disciplinary Control', 'This is to inform us the delivery of Michael Okpara University of Sussex in cooperation to the royale association of America', '2018-08-15 09:59:06', '2018-08-15 22:59:59', 'Turnyur', 'birthday', 'Classified files association of Nigeria'),
(95, 'From You have to show Commitment', 'You guys have to drop your projects and table of contents and problem statements', '2018-01-17 12:53:50', '2018-01-17 22:59:59', 'Turnyur', NULL, NULL),
(96, 'Yeah Yeah Baby', 'Baby How you dey', '2018-04-11 12:51:52', '2018-04-11 22:59:59', 'Turnyur', NULL, NULL),
(97, 'Steady For me', 'I wanna put you in my life. Wont gonna go me. I wanna put you in my life. Yeah Yeah baby come closer. Baby closer come closer to me the worlds baddest programmer', '2018-04-24 12:33:53', '2018-04-24 22:59:59', 'Turnyur', NULL, NULL),
(98, 'Star Boy dancing', 'All of my hailing people of the most teriffic Bondardment of the worlds international theory of relative of the international society of the people of the relative of china in the international ', '2018-04-08 12:11:55', '2018-04-08 22:59:59', 'Turnyur', NULL, NULL),
(99, 'Hello Sir', 'I greet you in the beauty of your holiness. Now we have to tell the people of France how it is that we are relating our problem to the new H.O.D', '2018-04-13 12:23:57', '2018-04-13 22:59:59', 'Turnyur', NULL, NULL),
(100, 'Engineer Chiagunye Fresh', 'For us we are living in the Atlantic Ocean of the Frantic efforts', '2018-04-26 12:55:58', '2018-04-26 22:59:59', 'Turnyur', NULL, NULL),
(105, 'Baby Come Closer', 'huhuyuyuyuy', '2018-03-07 07:57:31', '2018-03-07 22:59:59', 'Turnyur', NULL, NULL),
(106, 'The WOlrds most Eloquent', 'This is introducing one of the powerful things in the world of science of the Engineering commandment of the twentieth century fox Nigeria international Hotel', '2025-04-09 07:48:38', '2025-04-09 22:59:59', 'Turnyur', NULL, NULL),
(159, 'Bug Discovered', 'International Space Center has been edited to reflect bugs in the edit button', '2018-02-14 01:45:17', '2018-02-14 22:59:59', 'Turnyur', 'wedding', 'Computer Engineering Lab'),
(152, 'The International Committee', 'The International Committee of friends', '2018-12-05 12:33:59', '2018-12-05 22:59:59', 'Turnyur', 'wedding', 'The Meridian Hotels'),
(153, 'Progress has been recorded', 'There has been records of progress turn out in the international society of friends in the worlds most inudanting regions of expertise', '2018-02-16 22:52:48', '2018-02-16 22:59:59', 'WilliamChuks', 'vacation', 'Pavillion Ground Abuja'),
(154, 'Its going to happen live Again', 'Nigerian Union of Journalist', '2018-02-06 23:31:00', '2018-02-07 22:59:59', 'WilliamChuks', 'wedding', 'Michael okpara University'),
(146, 'Life Transforming Program', 'School of Engineering and Management in the international committee of nations', '2018-02-12 07:02:57', '2018-02-12 22:59:59', 'WilliamChuks', 'wedding', 'Chief Enest. CEO ELEphar Security'),
(147, 'Time Format Validation Test', 'Testing of the student union of the worlds national day', '2018-02-26 08:39:39', '2018-02-26 22:59:59', 'WilliamChuks', 'birthday', 'TheInternational Students'),
(149, 'On the road to victory', 'The continents most dangerous mode of cultivating', '2018-02-02 08:20:50', '2018-02-02 22:59:59', 'WilliamChuks', 'wedding', 'Despacito International'),
(141, 'Modified Date of Mobilization', 'This Event will hold at Abia State Polytecnic Nigeria', '2018-03-14 22:34:16', '2018-03-14 22:59:59', 'WilliamChuks', 'wedding', 'Abia State Politecnic'),
(162, 'Moving to Umuahia', 'This is a note of moving to national stadium umuahia', '2018-02-22 08:33:22', '2018-02-22 22:59:59', 'WilliamChuks', 'vacation', 'Okpara Suare Umuahia'),
(163, 'Trying to reach out a compromise', 'This day signals a compromise between Turnyur Siy and the International community of friends based in washington DC. It was established to set a detailed look in the international union of journalists. He would have increased the number of people in every group', '2018-02-19 06:24:31', '2018-02-19 22:59:59', 'Turnyur', 'wedding', 'On this day, a compromise will be reached...'),
(164, 'Lets go there', 'The dawn of new demonstration in the people&#039;s republic of America', '2018-02-05 06:41:38', '2018-02-05 22:59:59', 'Turnyur', 'General', 'Federal University of Technology Owerri'),
(165, 'Wedding Ceremony', 'This is a test of Event Management Software form Turnyur Technologies', '2018-07-04 13:22:16', '2018-07-04 22:59:59', 'WilliamChuks', 'General', 'Michael okpara University'),
(167, 'New Branch ', 'Web Application function Test', '2018-08-20 14:38:53', '2018-08-20 22:59:59', 'joel', 'wedding', 'MOUAU');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_pass` varchar(47) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_email` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_pass`, `user_email`) VALUES
(8, 'WilliamChuks', '7ef6ebf1dfb026df4c43d4b17de59d664c9fa180ad5660e', 'turnyurdegreat@yahoo.com'),
(21, 'joel', '12b6f04a78b8f204481d577224e743ac7f372ce82858a32', 'igbojoel@gmail.com'),
(20, 'group9', '22b9b571c163e1dd253e06288a630c8d38e37616bd14d2c', 'group9@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `event_start` (`event_start`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
