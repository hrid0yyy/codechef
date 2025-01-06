-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2025 at 07:39 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `codecraft`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `websiteUrl` varchar(255) DEFAULT NULL,
  `profilePicture` varchar(255) DEFAULT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`, `name`, `createdAt`, `updatedAt`, `websiteUrl`, `profilePicture`, `verified`) VALUES
('cc@gmail.com', '$2y$10$UPEiTt0kRAcMLYju/v7l0O32WrEjSQD486tJnmr97gRjSuMmGEPuS', '', '2025-01-06 04:47:51', '2025-01-06 06:15:32', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `certificate_id` int(11) NOT NULL,
  `contest_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `certificate_code` varchar(50) NOT NULL,
  `issue_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `certificate_type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contests`
--

CREATE TABLE `contests` (
  `contest_id` int(11) NOT NULL,
  `contestants` int(11) DEFAULT NULL,
  `registration_start_time` datetime DEFAULT NULL,
  `registration_end_time` datetime DEFAULT NULL,
  `contest_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `published` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contests`
--

INSERT INTO `contests` (`contest_id`, `contestants`, `registration_start_time`, `registration_end_time`, `contest_name`, `description`, `banner`, `start_time`, `end_time`, `created_at`, `updated_at`, `published`) VALUES
(3, 45, '2025-01-03 21:45:00', '2025-01-03 16:50:00', 'eqw', 'sadsa', NULL, '2025-01-03 16:49:00', '2025-01-03 21:45:00', '2025-01-03 10:45:11', '2025-01-03 10:52:26', 0);

-- --------------------------------------------------------

--
-- Table structure for table `contest_problem_samples`
--

CREATE TABLE `contest_problem_samples` (
  `problem_id` int(11) NOT NULL,
  `contest_id` int(11) NOT NULL,
  `sample_id` int(10) UNSIGNED NOT NULL,
  `sample_input` text NOT NULL,
  `sample_output` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contest_problem_sets`
--

CREATE TABLE `contest_problem_sets` (
  `problem_id` int(11) NOT NULL,
  `problem_title` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `difficulty_level` enum('easy','medium','hard') NOT NULL,
  `input_format` text DEFAULT NULL,
  `output_format` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `contest_id` int(11) NOT NULL,
  `tags` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `message`, `timestamp`) VALUES
(9, 5, 6, 'oye', '2025-01-04 19:30:36'),
(10, 6, 5, 'aa', '2025-01-04 19:31:01'),
(11, 6, 5, 'asd', '2025-01-04 19:31:09'),
(12, 6, 5, 'oye', '2025-01-04 19:32:00'),
(13, 6, 5, 'babababa', '2025-01-04 19:32:09'),
(14, 6, 5, 'babababa', '2025-01-04 19:32:11'),
(15, 6, 5, 'asdsa', '2025-01-04 19:32:47'),
(16, 6, 5, 'asdsa', '2025-01-04 19:32:56'),
(17, 6, 5, 'asd', '2025-01-04 19:42:09');

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `user_id` int(11) NOT NULL,
  `contest_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `problem_samples`
--

CREATE TABLE `problem_samples` (
  `problem_id` int(11) NOT NULL,
  `sample_id` int(11) NOT NULL,
  `sample_input` text NOT NULL,
  `sample_output` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `problem_samples`
--

INSERT INTO `problem_samples` (`problem_id`, `sample_id`, `sample_input`, `sample_output`) VALUES
(1, 3, '2 7 11 15 9', '0 1'),
(1, 4, '3 2 4 6', '1 2'),
(2, 5, 'hello', 'olleh'),
(2, 6, 'world', 'dlrow'),
(3, 7, '1 2 4 5', '3'),
(3, 8, '1 2 3 4 5 7', '6'),
(4, 9, '(){}[]', 'YES'),
(4, 10, '(]', 'NO'),
(5, 11, '-2 1 -3 4 -1 2 1 -5 4', '6'),
(5, 12, '-1 -2 -3 -4', '-1'),
(6, 13, 'racecar', 'YES'),
(6, 14, 'hello', 'NO'),
(7, 15, 'hello world', '3'),
(7, 16, 'programming', '3'),
(8, 17, '1 2 3 4 5', '4'),
(8, 18, '10 20 20 30', '20'),
(9, 19, '123', '6'),
(9, 20, '9876', '30'),
(10, 21, '5', '120'),
(10, 22, '7', '5040'),
(11, 23, '7', '13'),
(11, 24, '10', '55'),
(12, 25, '13', 'YES'),
(12, 26, '15', 'NO'),
(13, 27, '24 36', '12'),
(13, 28, '8 14', '2'),
(14, 29, 'hello', 'helo'),
(14, 30, 'aabbcc', 'abc'),
(15, 31, 'listen silent', 'YES'),
(15, 32, 'hello world', 'NO'),
(16, 33, '1011', '11'),
(16, 34, '11001', '25'),
(17, 35, '10', '1010'),
(17, 36, '15', '1111'),
(18, 37, '1 2 3 4 5 2', '4 5 1 2 3'),
(18, 38, '10 20 30 40 3', '30 40 10 20'),
(19, 39, '1 1 2 2 3', '3'),
(19, 40, '5 5 7 8 7', '8'),
(20, 41, '1 3 5 7 9 2 4 6 8', '1 2 3 4 5 6 7 8 9'),
(20, 42, '10 20 30 40 5 15 25 35', '5 10 15 20 25 30 35 40'),
(21, 43, 'AABB', 'YES'),
(21, 44, 'ABABA', 'NO'),
(22, 45, 'I love programming in Python', 'programming'),
(22, 46, 'The quick brown fox jumps', 'jumps'),
(23, 47, 'hello hello world', 'hello: 2, world: 1'),
(23, 48, 'apple banana apple apple', 'apple: 3, banana: 1'),
(24, 49, '1 2 3 4 5 6', '12'),
(24, 50, '7 8 9 10', '18'),
(25, 51, '16', 'YES'),
(25, 52, '18', 'NO');

-- --------------------------------------------------------

--
-- Table structure for table `problem_sets`
--

CREATE TABLE `problem_sets` (
  `problem_id` int(11) NOT NULL,
  `problem_title` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `difficulty_level` enum('easy','medium','hard') NOT NULL,
  `input_format` text DEFAULT NULL,
  `output_format` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tags` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `problem_sets`
--

INSERT INTO `problem_sets` (`problem_id`, `problem_title`, `description`, `difficulty_level`, `input_format`, `output_format`, `created_at`, `updated_at`, `tags`) VALUES
(1, 'Two Sum', 'Given an array of integers and a target sum, return indices of two numbers that add up to the target.', 'easy', 'Space-separated integers followed by the target number at the end', 'Two space-separated integers (indices of the numbers that add up to target)', '2025-01-04 14:32:35', '2025-01-04 14:32:35', 'array, hashing'),
(2, 'Reverse a String', 'Given a string, reverse the order of characters.', 'easy', 'Single line containing a string S', 'Reversed string', '2025-01-04 14:32:35', '2025-01-04 14:32:35', 'string, implementation'),
(3, 'Find the Missing Number', 'Given space-separated numbers from 1 to N (excluding one missing number), find the missing number.', 'medium', 'Space-separated integers from 1 to N-1', 'Single integer representing the missing number', '2025-01-04 14:32:35', '2025-01-04 14:32:35', 'array, math'),
(4, 'Valid Parentheses', 'Given a string of parentheses, check if it is valid.', 'medium', 'Single line containing a string of parentheses', 'YES or NO (YES if valid, otherwise NO)', '2025-01-04 14:32:35', '2025-01-04 14:32:35', 'stack, string'),
(5, 'Maximum Subarray Sum', 'Find the largest sum of any contiguous subarray.', 'hard', 'Space-separated integers representing the array', 'Single integer representing the maximum subarray sum', '2025-01-04 14:32:35', '2025-01-04 14:32:35', 'array, dynamic-programming'),
(6, 'Palindrome Check', 'Check if the given string is a palindrome.', 'easy', 'Single line containing a string', 'YES or NO', '2025-01-04 15:10:03', '2025-01-04 15:10:03', 'string, implementation'),
(7, 'Count Vowels', 'Count the number of vowels in a given string.', 'easy', 'Single line containing a string', 'Single integer representing the number of vowels', '2025-01-04 15:10:03', '2025-01-04 15:10:03', 'string, counting'),
(8, 'Second Largest Number', 'Find the second largest number in an array.', 'medium', 'Space-separated integers', 'Single integer representing the second largest number', '2025-01-04 15:10:03', '2025-01-04 15:10:03', 'array, sorting'),
(9, 'Sum of Digits', 'Find the sum of digits of a given number.', 'easy', 'Single integer N', 'Single integer representing the sum of digits', '2025-01-04 15:10:03', '2025-01-04 15:10:03', 'math, implementation'),
(10, 'Factorial Calculation', 'Calculate the factorial of a number.', 'easy', 'Single integer N', 'Single integer representing N!', '2025-01-04 15:10:03', '2025-01-04 15:10:03', 'math, recursion'),
(11, 'Fibonacci Series', 'Find the Nth Fibonacci number.', 'medium', 'Single integer N', 'Single integer representing the Nth Fibonacci number', '2025-01-04 15:10:03', '2025-01-04 15:10:03', 'math, dynamic-programming'),
(12, 'Check Prime Number', 'Determine if a number is prime.', 'medium', 'Single integer N', 'YES or NO', '2025-01-04 15:10:03', '2025-01-04 15:10:03', 'math, number-theory'),
(13, 'Greatest Common Divisor', 'Find the greatest common divisor (GCD) of two numbers.', 'medium', 'Two space-separated integers', 'Single integer representing the GCD', '2025-01-04 15:10:03', '2025-01-04 15:10:03', 'math, number-theory'),
(14, 'Remove Duplicates', 'Remove duplicate characters from a string.', 'easy', 'Single line containing a string', 'String with duplicates removed', '2025-01-04 15:10:03', '2025-01-04 15:10:03', 'string, implementation'),
(15, 'Anagram Check', 'Check if two words are anagrams.', 'medium', 'Two space-separated words', 'YES or NO', '2025-01-04 15:10:03', '2025-01-04 15:10:03', 'string, sorting'),
(16, 'Binary to Decimal', 'Convert a binary number to decimal.', 'easy', 'Single binary number', 'Single integer representing the decimal value', '2025-01-04 15:10:03', '2025-01-04 15:10:03', 'math, binary'),
(17, 'Decimal to Binary', 'Convert a decimal number to binary.', 'easy', 'Single integer', 'Binary representation of the integer', '2025-01-04 15:10:03', '2025-01-04 15:10:03', 'math, binary'),
(18, 'Rotate Array', 'Rotate an array to the right by K positions.', 'medium', 'Space-separated integers followed by K', 'Space-separated integers representing the rotated array', '2025-01-04 15:10:03', '2025-01-04 15:10:03', 'array, implementation'),
(19, 'Find Unique Number', 'Find the unique number in an array where all other numbers appear twice.', 'hard', 'Space-separated integers', 'Single integer representing the unique number', '2025-01-04 15:10:03', '2025-01-04 15:10:03', 'array, bitwise-operations'),
(20, 'Merge Two Sorted Arrays', 'Merge two sorted arrays into one sorted array.', 'medium', 'Two space-separated sorted arrays', 'Merged sorted array', '2025-01-04 15:10:03', '2025-01-04 15:10:03', 'array, sorting'),
(21, 'Check Balanced String', 'Check if a string has equal occurrences of A and B.', 'easy', 'Single line containing a string', 'YES or NO', '2025-01-04 15:10:03', '2025-01-04 15:10:03', 'string, implementation'),
(22, 'Longest Word in a Sentence', 'Find the longest word in a given sentence.', 'medium', 'Single line containing a sentence', 'The longest word', '2025-01-04 15:10:03', '2025-01-04 15:10:03', 'string, implementation'),
(23, 'Word Frequency Counter', 'Count the occurrences of each word in a string.', 'medium', 'Single line containing words', 'Word count mapping', '2025-01-04 15:10:03', '2025-01-04 15:10:03', 'string, hash-table'),
(24, 'Sum of Even Numbers', 'Find the sum of even numbers in a given list.', 'easy', 'Space-separated integers', 'Single integer representing the sum of even numbers', '2025-01-04 15:10:03', '2025-01-04 15:10:03', 'array, math'),
(25, 'Check Power of Two', 'Determine if a number is a power of two.', 'medium', 'Single integer', 'YES or NO', '2025-01-04 15:10:03', '2025-01-04 15:10:03', 'math, bitwise-operations');

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE `submissions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `problem_id` int(11) NOT NULL,
  `status` enum('Accepted','Wrong Answer','Runtime Error','Compilation Error') NOT NULL,
  `submission_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `RunTime` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `submissions`
--

INSERT INTO `submissions` (`id`, `user_id`, `problem_id`, `status`, `submission_time`, `RunTime`) VALUES
(3, 5, 7, 'Wrong Answer', '2025-01-04 17:37:35', '27.91655'),
(4, 5, 7, 'Wrong Answer', '2025-01-04 17:39:06', '16.7591'),
(5, 5, 7, 'Accepted', '2025-01-04 17:39:15', '15.18635'),
(6, 5, 7, 'Accepted', '2025-01-04 17:39:36', '15.5123'),
(7, 5, 7, 'Accepted', '2025-01-04 17:39:42', '14.86665');

-- --------------------------------------------------------

--
-- Table structure for table `super_admins`
--

CREATE TABLE `super_admins` (
  `super_admin_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `role` enum('Super Admin') DEFAULT 'Super Admin',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `super_admins`
--

INSERT INTO `super_admins` (`super_admin_id`, `full_name`, `email`, `password_hash`, `phone_number`, `profile_picture`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin@gmail.com', '$2y$10$UPEiTt0kRAcMLYju/v7l0O32WrEjSQD486tJnmr97gRjSuMmGEPuS', '0123456789', NULL, 'Super Admin', '2025-01-06 04:45:47', '2025-01-06 05:10:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `skills` text DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `linkedinUrl` varchar(255) DEFAULT NULL,
  `githubUrl` varchar(255) DEFAULT NULL,
  `portfolioUrl` varchar(255) DEFAULT NULL,
  `profilePicture` varchar(100) DEFAULT NULL,
  `total_problems_solved` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `name`, `date_of_birth`, `created_at`, `skills`, `bio`, `linkedinUrl`, `githubUrl`, `portfolioUrl`, `profilePicture`, `total_problems_solved`) VALUES
(5, 'hrid0yy', 'hridoyahmedddd@gmail.com', '$2y$10$UPEiTt0kRAcMLYju/v7l0O32WrEjSQD486tJnmr97gRjSuMmGEPuS', 'Hridoy Ahmed', '2025-01-08', '2025-01-04 13:12:43', 'Data Structures, Algorithms', 'aaa', 'https://github.com/hrid0yyy', 'https://github.com/hrid0yyy', '', 'uploads/1735997451_Screenshot (590).png', 1),
(6, 'arafat', 'arafat@gmail.com', '$2y$10$R/qCBuy196VR3QlozKJnDOz.Cu1/tcchVEabJx/snAt7bC1CZx1La', 'Arafat Ahmed', '2025-01-15', '2025-01-04 18:20:04', 'Database Management, Operating Systems', 'oye mairalamu', 'https://github.com/hrid0yyy', 'https://github.com/hrid0yyy', 'https://github.com/hrid0yyy', 'uploads/1736014832_Screenshot (539).png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_problem_status`
--

CREATE TABLE `user_problem_status` (
  `user_id` int(11) NOT NULL,
  `problem_id` int(11) NOT NULL,
  `solved_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_problem_status`
--

INSERT INTO `user_problem_status` (`user_id`, `problem_id`, `solved_at`) VALUES
(5, 7, '2025-01-04 17:39:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`certificate_id`),
  ADD UNIQUE KEY `certificate_code` (`certificate_code`),
  ADD KEY `contest_id` (`contest_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `contests`
--
ALTER TABLE `contests`
  ADD PRIMARY KEY (`contest_id`);

--
-- Indexes for table `contest_problem_samples`
--
ALTER TABLE `contest_problem_samples`
  ADD PRIMARY KEY (`sample_id`);

--
-- Indexes for table `contest_problem_sets`
--
ALTER TABLE `contest_problem_sets`
  ADD PRIMARY KEY (`problem_id`),
  ADD KEY `contest_id` (`contest_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`user_id`,`contest_id`),
  ADD KEY `contest_id` (`contest_id`);

--
-- Indexes for table `problem_samples`
--
ALTER TABLE `problem_samples`
  ADD PRIMARY KEY (`sample_id`);

--
-- Indexes for table `problem_sets`
--
ALTER TABLE `problem_sets`
  ADD PRIMARY KEY (`problem_id`);

--
-- Indexes for table `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `problem_id` (`problem_id`);

--
-- Indexes for table `super_admins`
--
ALTER TABLE `super_admins`
  ADD PRIMARY KEY (`super_admin_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone_number` (`phone_number`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_problem_status`
--
ALTER TABLE `user_problem_status`
  ADD PRIMARY KEY (`user_id`,`problem_id`),
  ADD KEY `problem_id` (`problem_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `certificate_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contests`
--
ALTER TABLE `contests`
  MODIFY `contest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contest_problem_samples`
--
ALTER TABLE `contest_problem_samples`
  MODIFY `sample_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contest_problem_sets`
--
ALTER TABLE `contest_problem_sets`
  MODIFY `problem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `problem_samples`
--
ALTER TABLE `problem_samples`
  MODIFY `sample_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `problem_sets`
--
ALTER TABLE `problem_sets`
  MODIFY `problem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `submissions`
--
ALTER TABLE `submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `super_admins`
--
ALTER TABLE `super_admins`
  MODIFY `super_admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `certificates`
--
ALTER TABLE `certificates`
  ADD CONSTRAINT `certificates_ibfk_1` FOREIGN KEY (`contest_id`) REFERENCES `contests` (`contest_id`),
  ADD CONSTRAINT `certificates_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `contest_problem_sets`
--
ALTER TABLE `contest_problem_sets`
  ADD CONSTRAINT `contest_problem_sets_ibfk_1` FOREIGN KEY (`contest_id`) REFERENCES `contests` (`contest_id`);

--
-- Constraints for table `participants`
--
ALTER TABLE `participants`
  ADD CONSTRAINT `participants_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `participants_ibfk_2` FOREIGN KEY (`contest_id`) REFERENCES `contests` (`contest_id`) ON DELETE CASCADE;

--
-- Constraints for table `submissions`
--
ALTER TABLE `submissions`
  ADD CONSTRAINT `submissions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `submissions_ibfk_2` FOREIGN KEY (`problem_id`) REFERENCES `problem_sets` (`problem_id`) ON DELETE CASCADE;

--
-- Constraints for table `user_problem_status`
--
ALTER TABLE `user_problem_status`
  ADD CONSTRAINT `user_problem_status_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_problem_status_ibfk_2` FOREIGN KEY (`problem_id`) REFERENCES `problem_sets` (`problem_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
