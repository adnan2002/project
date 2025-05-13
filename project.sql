-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2025 at 10:13 PM
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
) ;

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `course_review_helpful_votes`
--

CREATE TABLE `course_review_helpful_votes` (
  `vote_id` int(11) NOT NULL,
  `review_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
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
  `major_focus` enum('Mathematics','Chemistry','Physics','Computer Science','Engineering','Biology','Literature','History','Business','General','Other') NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `max_members` int(11) DEFAULT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `day_schedule` varchar(100) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Indexes for table `course_review_helpful_votes`
--
ALTER TABLE `course_review_helpful_votes`
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
  ADD KEY `leader_id` (`leader_id`);

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
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `course_review_helpful_votes`
--
ALTER TABLE `course_review_helpful_votes`
  MODIFY `vote_id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `study_group_comments`
--
ALTER TABLE `study_group_comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `study_group_comment_helpful_votes`
--
ALTER TABLE `study_group_comment_helpful_votes`
  MODIFY `vote_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `study_group_members`
--
ALTER TABLE `study_group_members`
  MODIFY `group_member_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

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
-- Constraints for table `course_review_helpful_votes`
--
ALTER TABLE `course_review_helpful_votes`
  ADD CONSTRAINT `course_review_helpful_votes_ibfk_1` FOREIGN KEY (`review_id`) REFERENCES `course_reviews` (`review_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_review_helpful_votes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

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
