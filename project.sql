-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2025 at 07:44 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--
CREATE DATABASE IF NOT EXISTS `project` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `project`;

-- --------------------------------------------------------

--
-- Table structure for table `campus_news`
--

CREATE TABLE `campus_news` (
  `news_id` int(11) NOT NULL,
  `uploader_id` int(11) NOT NULL,
  `category` enum('Academic','Sports','Student Life','Campus Events','Administration','Research','Other') NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `views_count` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `club_activities`
--

CREATE TABLE `club_activities` (
  `activity_id` int(11) NOT NULL,
  `president_id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `day_schedule` varchar(100) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `banner_image_path` varchar(255) DEFAULT NULL,
  `join_message` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `club_activity_members`
--

CREATE TABLE `club_activity_members` (
  `club_member_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `joined_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `club_member_testimonials`
--

CREATE TABLE `club_member_testimonials` (
  `testimonial_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `testimonial_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_code` varchar(20) NOT NULL,
  `course_title` varchar(255) NOT NULL,
  `attendance_required` tinyint(1) DEFAULT 0,
  `department` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_code`, `course_title`, `attendance_required`, `department`) VALUES
('BIO 301', 'Molecular Biology', 1, 'BIOLOGY'),
('CHEM 301', 'Organic Chemistry', 1, 'CHEMISTRY'),
('CS 102', 'JAVA 2 Programming', 1, 'Computer Science'),
('CS 103', 'JAVA 2 Programming', 1, 'Computer Science'),
('CS 202', 'Data Structures & Algorithms', 1, 'COMPUTER SCIENCE'),
('HIST 101', 'World History: 1500-Present', 1, 'HISTORY'),
('MATH 201', 'Calculus II', 1, 'MATHEMATICS'),
('PHYS 401', 'Quantum Physics', 1, 'PHYSICS'),
('PSYC 202', 'Cognitive Psychology', 1, 'PSYCHOLOGY');

-- --------------------------------------------------------

--
-- Table structure for table `course_notes`
--

CREATE TABLE `course_notes` (
  `note_id` int(11) NOT NULL,
  `uploader_id` int(11) NOT NULL,
  `major_for_course` varchar(100) NOT NULL,
  `course_code` varchar(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_type` enum('PDF','DOCX') NOT NULL,
  `file_size_mb` decimal(6,2) NOT NULL,
  `page_count` int(11) DEFAULT NULL,
  `download_count` int(11) DEFAULT 0,
  `views_count` int(11) DEFAULT 0,
  `rating_sum` int(11) DEFAULT 0,
  `rating_count` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_note_comments`
--

CREATE TABLE `course_note_comments` (
  `comment_id` int(11) NOT NULL,
  `note_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_text` text NOT NULL,
  `helpful_count` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_note_comment_helpful_votes`
--

CREATE TABLE `course_note_comment_helpful_votes` (
  `vote_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_note_tags`
--

CREATE TABLE `course_note_tags` (
  `tag_id` int(11) NOT NULL,
  `note_id` int(11) NOT NULL,
  `tag_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_note_topics`
--

CREATE TABLE `course_note_topics` (
  `topic_id` int(11) NOT NULL,
  `note_id` int(11) NOT NULL,
  `topic_text` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_note_user_ratings`
--

CREATE TABLE `course_note_user_ratings` (
  `rating_id` int(11) NOT NULL,
  `note_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating_value` tinyint(4) NOT NULL,
  `rated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_reviews`
--

CREATE TABLE `course_reviews` (
  `review_id` int(11) NOT NULL,
  `course_code` varchar(20) NOT NULL,
  `reviewer_id` int(11) NOT NULL,
  `difficulty_rating` decimal(3,1) NOT NULL,
  `workload_rating` decimal(3,1) NOT NULL,
  `overall_rating` decimal(2,1) NOT NULL,
  `would_take_again` tinyint(1) NOT NULL,
  `review_text` text NOT NULL,
  `pros` text DEFAULT NULL,
  `cons` text DEFAULT NULL,
  `advice` text DEFAULT NULL,
  `helpful_votes_count` int(11) DEFAULT 0,
  `unhelpful_votes_count` int(11) NOT NULL DEFAULT 0 COMMENT 'Count of "No" / Not Helpful votes',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_reviews`
--

INSERT INTO `course_reviews` (`review_id`, `course_code`, `reviewer_id`, `difficulty_rating`, `workload_rating`, `overall_rating`, `would_take_again`, `review_text`, `pros`, `cons`, `advice`, `helpful_votes_count`, `unhelpful_votes_count`, `created_at`) VALUES
(1, 'CS 102', 2, '3.5', '4.0', '4.5', 1, 'This Java 2 course was quite comprehensive. The professor explained concepts well, but the project deadlines were a bit tight.', 'Good practical assignments; Clear explanations of core Java concepts; Responsive professor.', 'Workload can be heavy at times, especially around project deadlines; Some advanced topics were rushed.', 'Start projects early and don\'t be afraid to ask questions during office hours. Practice coding regularly.', 0, 0, '2024-01-15 07:00:00'),
(2, 'MATH 201', 3, '4.0', '3.5', '4.0', 1, 'Calculus II is challenging, but Prof. Adnan made it manageable. The homework was directly relevant to the exams.', 'Professor is very knowledgeable and helpful; Good examples in lectures; Fair grading.', 'Pace can be fast; Requires consistent effort to keep up.', 'Form a study group! Working through problems together helps a lot. Do all the practice problems.', 0, 0, '2024-02-20 11:30:00'),
(3, 'HIST 101', 2, '2.5', '3.0', '3.8', 1, 'World History was interesting. Lots of reading, but the discussions were engaging. The professor is passionate.', 'Engaging lectures; Interesting reading material; Approachable professor.', 'Lots of memorization required for dates and events; Essay grading can be subjective.', 'Take good notes during lectures and keep up with the readings. Participate in discussions.', 0, 0, '2024-03-10 06:15:00'),
(4, 'CHEM 301', 3, '4.5', '4.8', '3.2', 0, 'Organic Chemistry is notoriously difficult, and this was no exception. The professor is brilliant but sometimes hard to follow for beginners.', 'Covers a lot of material in depth.', 'Very fast-paced; Complex mechanisms require a lot of study time; Textbook is dense.', 'Stay on top of the material from day one. Use online resources and practice problems extensively. Office hours are a must.', 0, 0, '2025-04-01 08:00:00'),
(5, 'CS 202', 2, '4.2', '4.5', '4.6', 1, 'Data Structures & Algorithms is a cornerstone CS course. It was challenging but incredibly rewarding. The professor provided excellent resources.', 'Teaches fundamental concepts very well; Prepares you for technical interviews; Interesting assignments.', 'Assignments can be very time-consuming; Some concepts are abstract and require deep thinking.', 'Master the basics before moving on. Whiteboard problems. Understand Big O notation thoroughly.', 0, 0, '2025-04-25 13:45:00'),
(6, 'PSYC 202', 3, '3.0', '3.2', '4.2', 1, 'Cognitive Psychology was fascinating! The professor used a lot of real-world examples which made the theories easier to grasp.', 'Engaging content; Relatable examples; Thought-provoking discussions.', 'Some readings can be a bit dry; Exams require understanding concepts, not just memorization.', 'Relate the theories to your own experiences. Participate in class discussions to solidify understanding.', 0, 0, '2025-05-05 10:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `course_review_comments`
--

CREATE TABLE `course_review_comments` (
  `comment_id` int(11) NOT NULL,
  `review_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_text` text NOT NULL,
  `helpful_count` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_review_comment_helpful_votes`
--

CREATE TABLE `course_review_comment_helpful_votes` (
  `vote_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_review_votes`
--

CREATE TABLE `course_review_votes` (
  `vote_id` int(11) NOT NULL,
  `review_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `result` tinyint(1) NOT NULL COMMENT 'TRUE for helpful (Yes), FALSE for not helpful (No)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `organizer_id` int(11) NOT NULL,
  `category` enum('Academic','Workshop','Social','Sports','Cultural','Career','Other') NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `event_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_attendees`
--

CREATE TABLE `event_attendees` (
  `event_attendee_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `registered_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_comments`
--

CREATE TABLE `event_comments` (
  `comment_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_text` text NOT NULL,
  `helpful_count` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_comment_helpful_votes`
--

CREATE TABLE `event_comment_helpful_votes` (
  `vote_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `marketplace_items`
--

CREATE TABLE `marketplace_items` (
  `item_id` int(11) NOT NULL,
  `uploader_id` int(11) NOT NULL,
  `category` enum('Textbook','Furniture','Electronics','Services','Clothing','Tickets','Housing','Other') NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `item_condition` enum('New','Like New','Good','Fair','Poor','N/A for services') NOT NULL,
  `main_image_path` varchar(255) NOT NULL,
  `current_price` decimal(10,2) NOT NULL,
  `original_price` decimal(10,2) DEFAULT NULL,
  `response_time_estimate` varchar(50) DEFAULT NULL,
  `is_sold` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `marketplace_item_features`
--

CREATE TABLE `marketplace_item_features` (
  `feature_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `feature_text` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `marketplace_item_images`
--

CREATE TABLE `marketplace_item_images` (
  `image_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `upload_order` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `study_groups`
--

CREATE TABLE `study_groups` (
  `group_id` int(11) NOT NULL,
  `leader_id` int(11) NOT NULL,
  `course_code` varchar(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `max_members` int(11) DEFAULT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `day_schedule` varchar(100) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `study_groups`
--

INSERT INTO `study_groups` (`group_id`, `leader_id`, `course_code`, `title`, `description`, `max_members`, `start_time`, `end_time`, `day_schedule`, `location`, `created_at`) VALUES
(1, 2, 'MATH 201', 'Calculus II Study Group', 'Join us to master derivatives, integrals, and series. This study group is perfect for students currently enrolled in MATH 201 (Calculus II). We focus on solving practice problems, explaining difficult concepts, and preparing for exams together.\n\nAll skill levels are welcome! We believe in collaborative learning and helping each other succeed. Bring your textbooks, questions, and a positive attitude.', 20, '15:00:00', '17:00:00', 'Every Monday', 'Library, Room 204 (2nd Floor, North Wing)', '2024-05-10 07:00:00'),
(2, 2, 'CS 202', 'Data Structures & Algorithms Practice', 'Weekly sessions to tackle Data Structures and Algorithms problems. Focus on whiteboarding, Big O analysis, and common interview patterns. Ideal for CS 202 students aiming for a deeper understanding and for those preparing for technical interviews. We will cover topics like arrays, linked lists, trees, graphs, sorting, and searching algorithms.', 15, '16:00:00', '18:00:00', 'Every Tuesday', 'CS Department, Lab 3B', '2024-05-11 08:30:00'),
(3, 2, 'BIO 301', 'Molecular Biology Concepts Review', 'Reviewing key concepts from BIO 301 including DNA replication, transcription, translation, protein synthesis, and cellular mechanisms. We will go over lecture notes, textbook chapters, and past exam questions. Great for exam preparation and clarifying doubts.', 12, '17:30:00', '19:00:00', 'Every Wednesday', 'Biology Building, Study Room 1', '2025-05-13 02:03:11'),
(4, 2, 'CHEM 301', 'Organic Chemistry Problem Solving', 'Dedicated sessions for solving complex organic chemistry problems, understanding reaction mechanisms, spectroscopy, and nomenclature. Suitable for CHEM 301 students looking to improve their grades and grasp challenging topics. Please bring your model kits!', 10, '14:00:00', '16:00:00', 'Every Thursday', 'Chemistry Labs, Discussion Area (Chem West, Room 112)', '2024-05-09 06:15:00'),
(5, 2, 'PSYC 202', 'Cognitive Psychology Discussion Group', 'Join us to discuss fascinating topics from PSYC 202 like memory, perception, attention, language, and problem-solving. We will analyze case studies, review key theories, and discuss recent research. Interactive and engaging sessions designed to foster critical thinking.', 25, '13:00:00', '14:30:00', 'Every Friday', 'Psychology Department Lounge (Building C, Room 305)', '2024-05-12 11:00:00'),
(6, 2, 'PHYS 401', 'Quantum Physics Explorers', 'Dive deep into the world of quantum mechanics. We will explore wave functions, Schrödinger\'s equation, quantum entanglement, and other core concepts of PHYS 401. Collaborative problem-solving and conceptual discussions.', 8, '10:00:00', '12:00:00', 'Every Saturday', 'Physics Building, Seminar Room A', '2024-05-13 05:00:00'),
(7, 2, 'CS 103', 'Java 2 Study Group', 'We will study a lot of java programs', 22, '15:00:00', '16:00:00', 'Every Tuesday', 'Online', '2025-05-13 02:58:01'),
(9, 2, 'BIO 301', '1323232', 'fewfewfewfwe', 2, '13:02:00', '14:02:00', 'Every Sunday', 'fewfewfew', '2025-05-13 14:22:56'),
(10, 2, 'PHYS 401', 'quantum entanglement group', 'eee', NULL, '14:00:00', '15:00:00', 'Every Sunday', NULL, '2025-05-13 19:17:53');

-- --------------------------------------------------------

--
-- Table structure for table `study_group_comments`
--

CREATE TABLE `study_group_comments` (
  `comment_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_text` text NOT NULL,
  `helpful_count` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `study_group_comments`
--

INSERT INTO `study_group_comments` (`comment_id`, `group_id`, `user_id`, `comment_text`, `helpful_count`, `created_at`) VALUES
(13, 7, 2, 'hello', 0, '2025-05-13 06:40:15'),
(14, 7, 2, 'dfd', 0, '2025-05-13 06:48:30'),
(15, 7, 3, 'wassup', 0, '2025-05-13 13:35:25');

-- --------------------------------------------------------

--
-- Table structure for table `study_group_comment_helpful_votes`
--

CREATE TABLE `study_group_comment_helpful_votes` (
  `vote_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `study_group_members`
--

CREATE TABLE `study_group_members` (
  `group_member_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `joined_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `study_group_members`
--

INSERT INTO `study_group_members` (`group_member_id`, `group_id`, `user_id`, `joined_at`) VALUES
(1, 1, 2, '2025-05-13 02:08:59'),
(3, 7, 3, '2025-05-13 13:35:37'),
(4, 9, 2, '2025-05-13 14:22:56'),
(5, 10, 2, '2025-05-13 19:17:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `university_id` varchar(50) DEFAULT NULL,
  `major` varchar(100) DEFAULT NULL,
  `academic_level` enum('Freshman','Sophomore','Junior','Senior','Graduate','Alumni','Faculty','Other') DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `password_hash`, `university_id`, `major`, `academic_level`, `date_of_birth`, `created_at`) VALUES
(2, 'Adnan', 'Sarhan', '202008997@stu.uob.edu.bh', '$2y$10$nvR9cyjljEZQKbOBVhVZNu64TlcK46wefBHrxLJo/IB7A6PL5s3kK', '202008997', 'Software Engineering', 'Freshman', '2002-10-11', '2025-05-12 23:27:44'),
(3, 'John', 'Doe', 'whatever@gmail.com', '$2y$10$3FXuiMXE5RvT6w1AOFLhZer6nBK1Ha6l9cAP/a6PAqpIOWpdoTAtu', '202108997', 'Computer Science', 'Freshman', '2002-02-02', '2025-05-13 13:35:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `campus_news`
--
ALTER TABLE `campus_news`
  ADD PRIMARY KEY (`news_id`),
  ADD KEY `uploader_id` (`uploader_id`);

--
-- Indexes for table `club_activities`
--
ALTER TABLE `club_activities`
  ADD PRIMARY KEY (`activity_id`),
  ADD KEY `president_id` (`president_id`);

--
-- Indexes for table `club_activity_members`
--
ALTER TABLE `club_activity_members`
  ADD PRIMARY KEY (`club_member_id`),
  ADD UNIQUE KEY `unique_activity_user` (`activity_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `club_member_testimonials`
--
ALTER TABLE `club_member_testimonials`
  ADD PRIMARY KEY (`testimonial_id`),
  ADD KEY `activity_id` (`activity_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_code`);

--
-- Indexes for table `course_notes`
--
ALTER TABLE `course_notes`
  ADD PRIMARY KEY (`note_id`),
  ADD KEY `uploader_id` (`uploader_id`),
  ADD KEY `course_code` (`course_code`);

--
-- Indexes for table `course_note_comments`
--
ALTER TABLE `course_note_comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `note_id` (`note_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `course_note_comment_helpful_votes`
--
ALTER TABLE `course_note_comment_helpful_votes`
  ADD PRIMARY KEY (`vote_id`),
  ADD UNIQUE KEY `unique_note_comment_user_vote` (`comment_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `course_note_tags`
--
ALTER TABLE `course_note_tags`
  ADD PRIMARY KEY (`tag_id`),
  ADD UNIQUE KEY `unique_note_tag` (`note_id`,`tag_name`);

--
-- Indexes for table `course_note_topics`
--
ALTER TABLE `course_note_topics`
  ADD PRIMARY KEY (`topic_id`),
  ADD KEY `note_id` (`note_id`);

--
-- Indexes for table `course_note_user_ratings`
--
ALTER TABLE `course_note_user_ratings`
  ADD PRIMARY KEY (`rating_id`),
  ADD UNIQUE KEY `unique_note_user_rating` (`note_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `course_reviews`
--
ALTER TABLE `course_reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `course_code` (`course_code`),
  ADD KEY `reviewer_id` (`reviewer_id`);

--
-- Indexes for table `course_review_comments`
--
ALTER TABLE `course_review_comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `review_id` (`review_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `course_review_comment_helpful_votes`
--
ALTER TABLE `course_review_comment_helpful_votes`
  ADD PRIMARY KEY (`vote_id`),
  ADD UNIQUE KEY `unique_review_comment_user_vote` (`comment_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `course_review_votes`
--
ALTER TABLE `course_review_votes`
  ADD PRIMARY KEY (`vote_id`),
  ADD UNIQUE KEY `unique_review_user_vote` (`review_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `organizer_id` (`organizer_id`);

--
-- Indexes for table `event_attendees`
--
ALTER TABLE `event_attendees`
  ADD PRIMARY KEY (`event_attendee_id`),
  ADD UNIQUE KEY `unique_event_user` (`event_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `event_comments`
--
ALTER TABLE `event_comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `event_comment_helpful_votes`
--
ALTER TABLE `event_comment_helpful_votes`
  ADD PRIMARY KEY (`vote_id`),
  ADD UNIQUE KEY `unique_event_comment_user_vote` (`comment_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `marketplace_items`
--
ALTER TABLE `marketplace_items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `uploader_id` (`uploader_id`);

--
-- Indexes for table `marketplace_item_features`
--
ALTER TABLE `marketplace_item_features`
  ADD PRIMARY KEY (`feature_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `marketplace_item_images`
--
ALTER TABLE `marketplace_item_images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `study_groups`
--
ALTER TABLE `study_groups`
  ADD PRIMARY KEY (`group_id`),
  ADD KEY `leader_id` (`leader_id`),
  ADD KEY `fk_study_group_course` (`course_code`);

--
-- Indexes for table `study_group_comments`
--
ALTER TABLE `study_group_comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `study_group_comment_helpful_votes`
--
ALTER TABLE `study_group_comment_helpful_votes`
  ADD PRIMARY KEY (`vote_id`),
  ADD UNIQUE KEY `unique_study_comment_user_vote` (`comment_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `study_group_members`
--
ALTER TABLE `study_group_members`
  ADD PRIMARY KEY (`group_member_id`),
  ADD UNIQUE KEY `unique_group_user` (`group_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `university_id` (`university_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `campus_news`
--
ALTER TABLE `campus_news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `club_activities`
--
ALTER TABLE `club_activities`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `club_activity_members`
--
ALTER TABLE `club_activity_members`
  MODIFY `club_member_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `club_member_testimonials`
--
ALTER TABLE `club_member_testimonials`
  MODIFY `testimonial_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_notes`
--
ALTER TABLE `course_notes`
  MODIFY `note_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_note_comments`
--
ALTER TABLE `course_note_comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_note_comment_helpful_votes`
--
ALTER TABLE `course_note_comment_helpful_votes`
  MODIFY `vote_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_note_tags`
--
ALTER TABLE `course_note_tags`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_note_topics`
--
ALTER TABLE `course_note_topics`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_note_user_ratings`
--
ALTER TABLE `course_note_user_ratings`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_reviews`
--
ALTER TABLE `course_reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `course_review_comments`
--
ALTER TABLE `course_review_comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_review_comment_helpful_votes`
--
ALTER TABLE `course_review_comment_helpful_votes`
  MODIFY `vote_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_review_votes`
--
ALTER TABLE `course_review_votes`
  MODIFY `vote_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event_attendees`
--
ALTER TABLE `event_attendees`
  MODIFY `event_attendee_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event_comments`
--
ALTER TABLE `event_comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event_comment_helpful_votes`
--
ALTER TABLE `event_comment_helpful_votes`
  MODIFY `vote_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `marketplace_items`
--
ALTER TABLE `marketplace_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `marketplace_item_features`
--
ALTER TABLE `marketplace_item_features`
  MODIFY `feature_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `marketplace_item_images`
--
ALTER TABLE `marketplace_item_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `study_groups`
--
ALTER TABLE `study_groups`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `study_group_comments`
--
ALTER TABLE `study_group_comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `study_group_comment_helpful_votes`
--
ALTER TABLE `study_group_comment_helpful_votes`
  MODIFY `vote_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `study_group_members`
--
ALTER TABLE `study_group_members`
  MODIFY `group_member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `campus_news`
--
ALTER TABLE `campus_news`
  ADD CONSTRAINT `campus_news_ibfk_1` FOREIGN KEY (`uploader_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `club_activities`
--
ALTER TABLE `club_activities`
  ADD CONSTRAINT `club_activities_ibfk_1` FOREIGN KEY (`president_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `club_activity_members`
--
ALTER TABLE `club_activity_members`
  ADD CONSTRAINT `club_activity_members_ibfk_1` FOREIGN KEY (`activity_id`) REFERENCES `club_activities` (`activity_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `club_activity_members_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `club_member_testimonials`
--
ALTER TABLE `club_member_testimonials`
  ADD CONSTRAINT `club_member_testimonials_ibfk_1` FOREIGN KEY (`activity_id`) REFERENCES `club_activities` (`activity_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `club_member_testimonials_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `course_notes`
--
ALTER TABLE `course_notes`
  ADD CONSTRAINT `course_notes_ibfk_1` FOREIGN KEY (`uploader_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_notes_ibfk_2` FOREIGN KEY (`course_code`) REFERENCES `courses` (`course_code`) ON DELETE CASCADE;

--
-- Constraints for table `course_note_comments`
--
ALTER TABLE `course_note_comments`
  ADD CONSTRAINT `course_note_comments_ibfk_1` FOREIGN KEY (`note_id`) REFERENCES `course_notes` (`note_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_note_comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `course_note_comment_helpful_votes`
--
ALTER TABLE `course_note_comment_helpful_votes`
  ADD CONSTRAINT `course_note_comment_helpful_votes_ibfk_1` FOREIGN KEY (`comment_id`) REFERENCES `course_note_comments` (`comment_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_note_comment_helpful_votes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `course_note_tags`
--
ALTER TABLE `course_note_tags`
  ADD CONSTRAINT `course_note_tags_ibfk_1` FOREIGN KEY (`note_id`) REFERENCES `course_notes` (`note_id`) ON DELETE CASCADE;

--
-- Constraints for table `course_note_topics`
--
ALTER TABLE `course_note_topics`
  ADD CONSTRAINT `course_note_topics_ibfk_1` FOREIGN KEY (`note_id`) REFERENCES `course_notes` (`note_id`) ON DELETE CASCADE;

--
-- Constraints for table `course_note_user_ratings`
--
ALTER TABLE `course_note_user_ratings`
  ADD CONSTRAINT `course_note_user_ratings_ibfk_1` FOREIGN KEY (`note_id`) REFERENCES `course_notes` (`note_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_note_user_ratings_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `course_reviews`
--
ALTER TABLE `course_reviews`
  ADD CONSTRAINT `course_reviews_ibfk_1` FOREIGN KEY (`course_code`) REFERENCES `courses` (`course_code`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_reviews_ibfk_2` FOREIGN KEY (`reviewer_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `course_review_comments`
--
ALTER TABLE `course_review_comments`
  ADD CONSTRAINT `course_review_comments_ibfk_1` FOREIGN KEY (`review_id`) REFERENCES `course_reviews` (`review_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_review_comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `course_review_comment_helpful_votes`
--
ALTER TABLE `course_review_comment_helpful_votes`
  ADD CONSTRAINT `course_review_comment_helpful_votes_ibfk_1` FOREIGN KEY (`comment_id`) REFERENCES `course_review_comments` (`comment_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_review_comment_helpful_votes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `course_review_votes`
--
ALTER TABLE `course_review_votes`
  ADD CONSTRAINT `course_review_votes_ibfk_1` FOREIGN KEY (`review_id`) REFERENCES `course_reviews` (`review_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_review_votes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`organizer_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `event_attendees`
--
ALTER TABLE `event_attendees`
  ADD CONSTRAINT `event_attendees_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_attendees_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `event_comments`
--
ALTER TABLE `event_comments`
  ADD CONSTRAINT `event_comments_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `event_comment_helpful_votes`
--
ALTER TABLE `event_comment_helpful_votes`
  ADD CONSTRAINT `event_comment_helpful_votes_ibfk_1` FOREIGN KEY (`comment_id`) REFERENCES `event_comments` (`comment_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_comment_helpful_votes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `marketplace_items`
--
ALTER TABLE `marketplace_items`
  ADD CONSTRAINT `marketplace_items_ibfk_1` FOREIGN KEY (`uploader_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `marketplace_item_features`
--
ALTER TABLE `marketplace_item_features`
  ADD CONSTRAINT `marketplace_item_features_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `marketplace_items` (`item_id`) ON DELETE CASCADE;

--
-- Constraints for table `marketplace_item_images`
--
ALTER TABLE `marketplace_item_images`
  ADD CONSTRAINT `marketplace_item_images_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `marketplace_items` (`item_id`) ON DELETE CASCADE;

--
-- Constraints for table `study_groups`
--
ALTER TABLE `study_groups`
  ADD CONSTRAINT `fk_study_group_course` FOREIGN KEY (`course_code`) REFERENCES `courses` (`course_code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `study_groups_ibfk_1` FOREIGN KEY (`leader_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `study_group_comments`
--
ALTER TABLE `study_group_comments`
  ADD CONSTRAINT `study_group_comments_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `study_groups` (`group_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `study_group_comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `study_group_comment_helpful_votes`
--
ALTER TABLE `study_group_comment_helpful_votes`
  ADD CONSTRAINT `study_group_comment_helpful_votes_ibfk_1` FOREIGN KEY (`comment_id`) REFERENCES `study_group_comments` (`comment_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `study_group_comment_helpful_votes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `study_group_members`
--
ALTER TABLE `study_group_members`
  ADD CONSTRAINT `study_group_members_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `study_groups` (`group_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `study_group_members_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
