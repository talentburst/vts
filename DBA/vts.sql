-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.38-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for vts_db
CREATE DATABASE IF NOT EXISTS `vts_db` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `vts_db`;

-- Dumping structure for table vts_db.credit_debit_leaves
CREATE TABLE IF NOT EXISTS `credit_debit_leaves` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `leave_type` varchar(100) DEFAULT NULL,
  `credit_leave` float(10,2) DEFAULT NULL,
  `debit_leave` float(10,2) DEFAULT NULL,
  `remark` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table vts_db.credit_debit_leaves: ~0 rows (approximately)
DELETE FROM `credit_debit_leaves`;
/*!40000 ALTER TABLE `credit_debit_leaves` DISABLE KEYS */;
/*!40000 ALTER TABLE `credit_debit_leaves` ENABLE KEYS */;

-- Dumping structure for table vts_db.leave_details
CREATE TABLE IF NOT EXISTS `leave_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `paid_leave` float(10,2) DEFAULT NULL,
  `sick_leave` float(10,2) DEFAULT NULL,
  `casual_leave` float(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table vts_db.leave_details: ~3 rows (approximately)
DELETE FROM `leave_details`;
/*!40000 ALTER TABLE `leave_details` DISABLE KEYS */;
INSERT INTO `leave_details` (`id`, `user_id`, `paid_leave`, `sick_leave`, `casual_leave`, `created_at`, `updated_at`, `updated_by`) VALUES
	(1, 1, 7.00, 3.50, 0.00, '2019-08-21 09:57:59', '2019-08-26 10:21:18', NULL),
	(2, 2, NULL, NULL, NULL, '2019-08-22 07:26:47', '2019-08-27 02:18:40', 1),
	(3, 3, NULL, NULL, NULL, '2019-08-26 08:56:57', '2019-08-26 10:21:18', NULL);
/*!40000 ALTER TABLE `leave_details` ENABLE KEYS */;

-- Dumping structure for table vts_db.status
CREATE TABLE IF NOT EXISTS `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_visible` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table vts_db.status: ~5 rows (approximately)
DELETE FROM `status`;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` (`id`, `status_name`, `created_at`, `updated_at`, `is_active`, `is_visible`) VALUES
	(1, 'Pending', '2019-08-27 06:28:04', '2019-08-27 06:59:59', 1, 0),
	(2, 'Approved', '2019-08-27 06:29:28', '2019-08-27 06:29:28', 1, 1),
	(3, 'On-Hold', '2019-08-27 06:29:40', '2019-08-27 06:29:40', 1, 1),
	(4, 'Rejected', '2019-08-27 06:29:51', '2019-08-27 06:29:51', 1, 1),
	(5, 'Deleted', '2019-08-27 06:30:47', '2019-08-27 06:59:57', 1, 0);
/*!40000 ALTER TABLE `status` ENABLE KEYS */;

-- Dumping structure for table vts_db.ticket_details
CREATE TABLE IF NOT EXISTS `ticket_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `ticket_id` varchar(100) NOT NULL,
  `subject` varchar(150) NOT NULL,
  `message` text NOT NULL,
  `remark` text NOT NULL,
  `mark_to` int(11) DEFAULT NULL,
  `responce` text,
  `responce_by` int(11) DEFAULT NULL,
  `responce_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Pending=1, Approved=2, On-Hold=3, Rejected=4, Deleted=5',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Dumping data for table vts_db.ticket_details: ~9 rows (approximately)
DELETE FROM `ticket_details`;
/*!40000 ALTER TABLE `ticket_details` DISABLE KEYS */;
INSERT INTO `ticket_details` (`id`, `user_id`, `ticket_id`, `subject`, `message`, `remark`, `mark_to`, `responce`, `responce_by`, `responce_at`, `created_at`, `updated_at`, `deleted_at`, `status`) VALUES
	(1, 1, 'TB577780', 'Application for SL', 'Salary not received', 'Ok, No comment.', 0, 'Ok, Reply you soon. Ok, Reply you soon.', 1, '2019-08-27 08:49:29', '2019-07-31 14:16:11', '2019-08-27 10:06:39', NULL, 2),
	(2, 2, 'TB577782', 'Application for PL', 'Salary not received again after deduction', '', 0, '', NULL, '2019-08-20 04:44:53', '2019-07-31 14:30:59', '2019-08-27 10:14:21', NULL, 1),
	(4, 2, 'TB577783', 'Application for PL', 'Salary not received again & again', '', 0, '', NULL, '2019-08-20 04:44:53', '2019-07-31 14:35:57', '2019-08-27 10:14:19', NULL, 1),
	(5, 1, 'TB577784', 'Application for PL', 'Salary deduction Again', 'Ok, No comment.', 0, '', NULL, NULL, '2019-08-08 11:07:10', '2019-08-27 10:14:17', '2019-08-21 06:59:39', 1),
	(6, 1, 'TB577785', 'Application for SL', 'PF Deduction', '', 0, '', NULL, NULL, '2019-08-08 13:17:17', '2019-08-27 10:14:15', '2019-08-21 06:58:58', 1),
	(7, 2, 'TB577786', 'Application for SL', 'Application for SL Application for SL', 'Application for SL', NULL, NULL, NULL, NULL, '2019-08-20 12:31:49', '2019-08-27 10:14:12', NULL, 1),
	(8, 1, 'TB988708', 'Application for PL', 'Salary not received again after deduction Salary not received again after deduction', 'Salary not received again after deduction', NULL, NULL, NULL, NULL, '2019-08-20 13:13:57', '2019-08-27 10:14:11', '2019-08-21 06:58:47', 1),
	(9, 1, 'TB201486', 'Application for SL', 'Salary not received again Salary not received again11', 'Salary not received again Salary not received again11', NULL, NULL, NULL, NULL, '2019-08-20 14:27:02', '2019-08-27 10:14:09', '2019-08-21 07:02:29', 1),
	(10, 2, 'TB975836', 'Application for PL', 'I want 3 days leave to attend my family function \r\nThanks.', 'No Remarks', NULL, 'Granted.\r\nYou can go.\r\nAll the best.', 1, '2019-08-27 11:41:16', '2019-08-27 11:25:06', '2019-08-27 10:06:39', NULL, 2),
	(11, 3, 'TB975836', 'Application for PL', 'I want 3 days leave to attend my family function \r\nThanks.', 'No Remarks', NULL, 'Granted.\r\nYou can go.\r\nAll the best.', 1, '2019-08-27 11:41:16', '2019-08-27 11:25:06', '2019-08-27 10:13:56', NULL, 2),
	(12, 2, 'TB975836', 'Application for PL', 'I want 3 days leave to attend my family function \r\nThanks.', 'No Remarks', NULL, 'Granted.\r\nYou can go.\r\nAll the best.', 1, '2019-08-27 11:41:16', '2019-08-27 11:25:06', '2019-08-27 10:06:39', NULL, 2),
	(13, 3, 'TB975836', 'Application for PL', 'I want 3 days leave to attend my family function \r\nThanks.', 'No Remarks', NULL, 'Granted.\r\nYou can go.\r\nAll the best.', 1, '2019-08-27 11:41:16', '2019-08-27 11:25:06', '2019-08-27 10:06:39', NULL, 2);
/*!40000 ALTER TABLE `ticket_details` ENABLE KEYS */;

-- Dumping structure for table vts_db.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` varchar(50) DEFAULT NULL,
  `email` varchar(150) NOT NULL,
  `phone_number` varchar(150) NOT NULL,
  `password` text,
  `name` varchar(150) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `doj` date DEFAULT NULL,
  `role` varchar(100) DEFAULT NULL,
  `profile_image` varchar(250) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `remember_token` text,
  `timestamp` time DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=Deactiveted, 1= Activeted, 2=Deteted',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table vts_db.users: ~3 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `emp_id`, `email`, `phone_number`, `password`, `name`, `dob`, `doj`, `role`, `profile_image`, `location`, `remember_token`, `timestamp`, `status`, `created_at`, `updated_at`, `deleted_at`, `email_verified_at`, `last_login`) VALUES
	(1, '0276', 'arvind.singh@talentburst.com', '8802411053', '$2y$10$6MTSymfvDRfkWtSxNwkeFu9zH35l4K1FzatpDprskcsKJgIodwfkS', 'arvind Singh', '1987-01-25', '2019-04-02', 'Lead Dveloper', '20190823114312.png', 'Gurgaon', 'XEgapZx4D4zzqadcFGx1NEoXfCVpdEvVILwj0Y98nuI5FnYAiNQUAllSXjDM', NULL, 1, '2019-08-16 11:17:49', '2019-08-27 07:23:41', NULL, NULL, '2019-08-27 11:23:41'),
	(2, '0277', 'amit.malik@talentburst.com', '8802411054', '$2y$10$PY81TsyKXB5HOHgw3/oXhOD3ZRHKO2L5/fCNHtT8eX1tQhSuLWGzi', 'Talent Burst', '2019-08-01', '2019-01-01', 'Lead Developer', NULL, 'New Delhi', 'V7vDyBa9vAV0ZhAJdC4wS4lazCIlHqEXmpgFRLT9u7lxZK9FaUj6oRlAtD96', NULL, 1, '2019-08-16 11:22:32', '2019-08-27 07:36:30', NULL, NULL, '2019-08-27 11:36:30'),
	(3, NULL, 'asarvindsingh1@gmail.com', '8802411052', '$2y$10$weTGydGnqrXY.vAlvn5hIeBgR/Z4dwtxrLbt9ig10vPrDaFxRzRGa', 'arvind.singh', NULL, NULL, NULL, NULL, NULL, 'hpPRkIfEhiOCLGLmCnw6WTRwag5DYFiziPv0nzbZAfgOnveXMXj6JeC0uqDe', NULL, 0, '2019-08-26 08:56:57', '2019-08-26 06:52:08', '2019-08-26 09:41:39', NULL, '2019-08-26 10:52:08');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table vts_db.user_details
CREATE TABLE IF NOT EXISTS `user_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `role` varchar(100) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_login` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table vts_db.user_details: ~1 rows (approximately)
DELETE FROM `user_details`;
/*!40000 ALTER TABLE `user_details` DISABLE KEYS */;
INSERT INTO `user_details` (`id`, `name`, `email`, `mobile`, `user_pass`, `role`, `status`, `created_at`, `updated_at`, `last_login`) VALUES
	(1, 'Arvind Singh', 'arvind.singh@talentburst.com', '8802411053', 'e10adc3949ba59abbe56e057f20f883e', 'Developer', 1, '2019-08-09 10:23:20', '2019-08-09 10:23:20', NULL);
/*!40000 ALTER TABLE `user_details` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
