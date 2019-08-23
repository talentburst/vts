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

-- Dumping structure for table vts_db.leave_details
CREATE TABLE IF NOT EXISTS `leave_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `paid_leave` float(10,2) DEFAULT NULL,
  `sick_leave` float(10,2) DEFAULT NULL,
  `casual_leave` float(10,2) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table vts_db.leave_details: ~0 rows (approximately)
DELETE FROM `leave_details`;
/*!40000 ALTER TABLE `leave_details` DISABLE KEYS */;
INSERT INTO `leave_details` (`id`, `user_id`, `paid_leave`, `sick_leave`, `casual_leave`, `created_at`, `updated_at`, `updated_by`) VALUES
	(1, 1, 7.00, 3.50, 0.00, '2019-08-21 09:57:59', '2019-08-21 09:58:14', NULL),
	(2, 2, NULL, NULL, NULL, '2019-08-22 07:26:47', '2019-08-22 07:26:47', NULL);
/*!40000 ALTER TABLE `leave_details` ENABLE KEYS */;

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
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `closed_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Pending=0, Approved=1, Rejected=2, Deleted=3',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table vts_db.ticket_details: ~8 rows (approximately)
DELETE FROM `ticket_details`;
/*!40000 ALTER TABLE `ticket_details` DISABLE KEYS */;
INSERT INTO `ticket_details` (`id`, `user_id`, `ticket_id`, `subject`, `message`, `remark`, `mark_to`, `responce`, `responce_by`, `created_at`, `updated_at`, `deleted_at`, `closed_at`, `status`) VALUES
	(1, 1, 'TB577780', 'Salary not received', 'Salary not received', 'Ok, No comment.', 0, 'Ok, Reply you soon.', 0, '2019-07-31 14:16:11', '2019-08-21 07:00:50', NULL, NULL, 0),
	(2, 2, 'TB577782', 'Application for PL', 'Salary not received again after deduction', '', 0, '', 0, '2019-07-31 14:30:59', '2019-08-21 07:00:54', NULL, '2019-08-20 04:44:53', 1),
	(4, 2, 'TB577783', 'Application for PL', 'Salary not received again & again', '', 0, '', 0, '2019-07-31 14:35:57', '2019-08-21 07:00:57', NULL, '2019-08-20 04:44:53', 1),
	(5, 1, 'TB577784', 'Application for PL', 'Salary deduction Again', 'Ok, No comment.', 0, '', 0, '2019-08-08 11:07:10', '2019-08-21 07:01:01', '2019-08-21 06:59:39', NULL, 0),
	(6, 1, 'TB577785', 'Application for SL', 'PF Deduction', '', 0, '', 0, '2019-08-08 13:17:17', '2019-08-21 07:01:04', '2019-08-21 06:58:58', NULL, 1),
	(7, 1, 'TB577786', 'Application for SL', 'Application for SL Application for SL', 'Application for SL', NULL, NULL, NULL, '2019-08-20 12:31:49', '2019-08-21 07:01:11', NULL, NULL, 0),
	(8, 1, 'TB988708', 'Salary not received again after deduction', 'Salary not received again after deduction Salary not received again after deduction', 'Salary not received again after deduction', NULL, NULL, NULL, '2019-08-20 13:13:57', '2019-08-21 08:24:13', '2019-08-21 06:58:47', NULL, 1),
	(9, 1, 'TB201486', 'Application for PL', 'Salary not received again Salary not received again11', 'Salary not received again Salary not received again11', NULL, NULL, NULL, '2019-08-20 14:27:02', '2019-08-21 04:55:12', '2019-08-21 07:02:29', NULL, 2);
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
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `email_verified_at` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `last_login` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table vts_db.users: ~2 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `emp_id`, `email`, `phone_number`, `password`, `name`, `dob`, `doj`, `role`, `profile_image`, `location`, `remember_token`, `timestamp`, `created_at`, `updated_at`, `email_verified_at`, `status`, `last_login`) VALUES
	(1, '0276', 'arvind.singh@talentburst.com', '8802411053', '$2y$10$6MTSymfvDRfkWtSxNwkeFu9zH35l4K1FzatpDprskcsKJgIodwfkS', 'arvind Singh ', '1987-01-25', '2019-04-02', 'Lead Dveloper', '20190823114312.png', 'Gurgaon', 'GcohxA0voNSDP3xrE6cvWCxt8XhnvMcyMYMczG0tscK5gUyHUsVO5gX1VTQT', NULL, '2019-08-16 11:17:49', '2019-08-23 08:10:11', NULL, 1, '2019-08-23 12:08:15'),
	(2, '0277', 'amit.malik@talentburst.com', '8802411054', '$2y$10$PY81TsyKXB5HOHgw3/oXhOD3ZRHKO2L5/fCNHtT8eX1tQhSuLWGzi', 'Talent Burst', '2019-08-01', '2019-01-01', 'Lead Developer', 'C:\\xampp\\tmp\\php87CE.tmp', 'New Delhi', 'cM8Vu4wT6vcIzCUNFS4kfVq350JKEHMP7aIFKKJ7B01dnuaTTxuDzIcYKETt', NULL, '2019-08-16 11:22:32', '2019-08-23 09:09:37', NULL, 1, '2019-08-22 11:22:32');
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
