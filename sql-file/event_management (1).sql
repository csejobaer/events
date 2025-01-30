-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2025 at 06:55 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `event_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `name` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`, `email`, `phone`, `created_at`, `updated_at`, `name`, `designation`) VALUES
(1, 'admin1', '6dfc4737ba59748934ef213c32f0cb3f', 'admin1@example.com', '01938073856', '2025-01-24 18:01:50', '2025-01-26 21:21:49', 'Admin', 'CEO');

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `author_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `biography` text DEFAULT NULL,
  `total_articles` int(11) DEFAULT 0,
  `social_links` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`social_links`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `event_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `seats_no` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `event_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `location` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`event_id`, `admin_id`, `event_name`, `seats_no`, `price`, `event_date`, `start_time`, `end_time`, `location`, `description`, `image`, `created_at`, `updated_at`) VALUES
(7, 1, 'Contrary to popular belief, Lorem Ipsum is not', 60, 30, '2025-01-22', '05:31:00', '09:31:00', 'mlt.jobaer@gmail.com', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.\r\n\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham', 'uploads/news-1.jpg', '2025-01-25 21:38:06', '2025-01-30 11:16:59'),
(14, 1, 'There are many variations of passages of Lorem Ipsum', 50, 50, '2025-01-29', '03:45:00', '07:42:00', 'mlt.jobaer@gmail.com', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 'uploads/news-2.jpg', '2025-01-25 21:42:11', '2025-01-30 11:17:07'),
(19, 1, 'It is a long established fact that a reader will be distracted', 30, 21, '2025-01-23', '04:40:00', '05:44:00', 'mlt.jobaer@gmail.com', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like)', 'uploads/news-3.jpg', '2025-01-26 18:42:34', '2025-01-30 11:17:16'),
(34, 1, 'Lorem Ipsum is simply dummy text of the printing', 40, 25, '2025-01-31', '03:09:00', '07:09:00', 'sdf', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 'uploads/news-4.jpg', '2025-01-26 19:09:32', '2025-01-30 11:17:24'),
(37, 1, 'Modern Marketing Summit Sydney 2025', 20, 60, '2025-02-08', '05:41:00', '09:41:00', 'Collins Street West Victoria 8007 Canada', 'Dolor sit amet consectetur elit sed do eiusmod tempor incd idunt labore et dolore magna aliqua enim ad minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquip exea commodo consequat.duis aute irure dolor in repre hen derit in voluptate velit esse cillum dolore eu fugiat nulla pariatur cepteur sint occaecat cupidatat eaque ipsa quae illo proident sunt in culpa qui officia deserunt mollit anim id est laborum perspiciatis unde omnis iste natus error sit voluptatem accusantium dolore laudant rem aperiam eaque ipsa quae ab illo inventore veritatis quasi architecto.\r\n\r\nDolor sit amet consectetur elit sed do eiusmod tempor incd idunt labore et dolore magna aliqua enim ad minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquip exea commodo consequat.duis aute irure dolor in reprehen derit in voluptate velit esse cillum dolore eu fugiat nulla pariatur cepteur sint occaecat cupidatat.', 'uploads/news-5.jpg', '2025-01-26 21:41:58', '2025-01-30 11:17:36'),
(38, 1, 'Modern Marketing Summit Sydney 2025', 10, 60, '2025-02-03', '05:41:00', '09:41:00', 'Collins Street West Victoria 8007 Canada', 'Dolor sit amet consectetur elit sed do eiusmod tempor incd idunt labore et dolore magna aliqua enim ad minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquip exea commodo consequat.duis aute irure dolor in repre hen derit in voluptate velit esse cillum dolore eu fugiat nulla pariatur cepteur sint occaecat cupidatat eaque ipsa quae illo proident sunt in culpa qui officia deserunt mollit anim id est laborum perspiciatis unde omnis iste natus error sit voluptatem accusantium dolore laudant rem aperiam eaque ipsa quae ab illo inventore veritatis quasi architecto.\r\n\r\nDolor sit amet consectetur elit sed do eiusmod tempor incd idunt labore et dolore magna aliqua enim ad minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquip exea commodo consequat.duis aute irure dolor in reprehen derit in voluptate velit esse cillum dolore eu fugiat nulla pariatur cepteur sint occaecat cupidatat.', 'uploads/post-img.jpg', '2025-01-27 07:11:11', '2025-01-30 11:17:50');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `ticket_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `seat_number` varchar(20) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `tshirt_size` enum('S','M','L','XL','XXL') NOT NULL,
  `purchased_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `approval_status` enum('approved','rejected','pending') DEFAULT 'pending',
  `user_name` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_phone` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`ticket_id`, `event_id`, `seat_number`, `price`, `tshirt_size`, `purchased_at`, `approval_status`, `user_name`, `user_email`, `user_phone`) VALUES
(1, 7, '20', '20.00', 'L', '2025-01-27 18:05:44', 'rejected', 'Md Rakib Hasan', 'rakib@gmail.com', '0193073696'),
(2, 38, 'B14', '60.00', 'M', '2025-01-28 21:26:46', 'approved', 'Md. Jobaer Hossain', 'jobaer593@gmail.com', '01934773856'),
(3, 37, 'C27', '60.00', 'XL', '2024-12-28 21:30:38', 'approved', 'Sakib Islam', 'sakib@gmail.com', '01938073846'),
(4, 34, 'B15', '25.00', 'L', '2025-01-29 06:33:17', 'approved', 'Yeasin islam', 'yeasin@gmail.com', '01938075874'),
(5, 37, 'A2', '60.00', 'XXL', '2025-01-30 11:27:08', 'approved', 'Sulaiman Sukhon', 'sulaiman@gamil.com', '01973456892');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `gender` varchar(5) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `role` enum('author','subscriber','contributor') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `admin_approval` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `gender`, `email`, `password`, `phone`, `role`, `created_at`, `updated_at`, `admin_approval`) VALUES
(24, 'Arafat Rahman', 'male', 'author@gamil.com', '281c9768797e312545033e4175227d4e', '01938073856', 'author', '2025-01-28 17:18:51', '2025-01-30 11:20:38', 1),
(25, 'MD. JOBAER HOSSAIN', 'male', 'author1@gamil.com', '$2y$10$xkqvI2K6S3YZRhzQ8TrUde9yFq.bM8FgnyTCq7/.HGxGn/2WbSN7.', '01938073856', 'subscriber', '2025-01-29 16:03:48', '2025-01-29 16:30:24', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`author_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `author`
--
ALTER TABLE `author`
  ADD CONSTRAINT `author_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`);

--
-- Constraints for table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
