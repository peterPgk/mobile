-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.14 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for mp
CREATE DATABASE IF NOT EXISTS `mp` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `mp`;

-- Dumping structure for table mp.accessories
CREATE TABLE IF NOT EXISTS `accessories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `available` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mp.accessories: ~6 rows (approximately)
/*!40000 ALTER TABLE `accessories` DISABLE KEYS */;
INSERT INTO `accessories` (`id`, `name`, `description`, `available`, `created_at`, `updated_at`) VALUES
	(1, 'Case Z1', 'For Sony Z1 phone', 0, '2018-01-23 17:47:41', '2018-01-26 08:44:52'),
	(2, 'Charger for Sony Z1', 'For Sony Z1 phone', 1, '2018-01-23 17:48:03', '2018-01-23 17:48:03'),
	(3, 'Charger for Motorola', 'For Motorola Z and Motorola G series', 1, '2018-01-24 08:08:33', '2018-01-24 08:08:33'),
	(8, 'Charger for Xiaomi 3S', 'Xiaomi 3S, 3S pro', 1, '2018-01-24 09:43:41', '2018-01-24 10:25:55'),
	(9, 'Case for Motorola', 'new', 1, '2018-01-24 09:45:09', '2018-01-24 09:45:09'),
	(10, 'Protector for Sony Z5', 'Sony Z series', 1, '2018-01-24 09:46:38', '2018-01-24 09:46:38'),
	(11, 'Tempered glass for Sony Z5', 'SonyZ5, Z5', 1, '2018-01-26 08:47:44', '2018-01-26 08:47:44');
/*!40000 ALTER TABLE `accessories` ENABLE KEYS */;

-- Dumping structure for table mp.accessory_phone
CREATE TABLE IF NOT EXISTS `accessory_phone` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `accessory_id` int(10) unsigned NOT NULL,
  `phone_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `accessory_phone_accessory_id_foreign` (`accessory_id`),
  KEY `accessory_phone_phone_id_foreign` (`phone_id`),
  CONSTRAINT `accessory_phone_accessory_id_foreign` FOREIGN KEY (`accessory_id`) REFERENCES `accessories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `accessory_phone_phone_id_foreign` FOREIGN KEY (`phone_id`) REFERENCES `phones` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mp.accessory_phone: ~8 rows (approximately)
/*!40000 ALTER TABLE `accessory_phone` DISABLE KEYS */;
INSERT INTO `accessory_phone` (`id`, `accessory_id`, `phone_id`, `created_at`, `updated_at`) VALUES
	(10, 9, 1, '2018-01-24 09:45:09', '2018-01-24 09:45:09'),
	(11, 9, 2, '2018-01-24 09:45:09', '2018-01-24 09:45:09'),
	(12, 9, 3, '2018-01-24 09:45:09', '2018-01-24 09:45:09'),
	(13, 10, 2, '2018-01-24 09:46:38', '2018-01-24 09:46:38'),
	(14, 8, 3, '2018-01-24 10:25:49', '2018-01-24 10:25:49'),
	(15, 1, 2, '2018-01-24 10:45:37', '2018-01-24 10:45:37'),
	(16, 9, 4, '2018-01-24 14:10:45', '2018-01-24 14:10:45'),
	(17, 9, 5, '2018-01-24 14:11:08', '2018-01-24 14:11:08'),
	(18, 1, 8, '2018-01-26 08:22:09', '2018-01-26 08:22:09'),
	(19, 3, 4, '2018-01-26 08:35:06', '2018-01-26 08:35:06'),
	(20, 10, 10, '2018-01-26 08:46:12', '2018-01-26 08:46:12'),
	(21, 11, 10, '2018-01-26 08:47:44', '2018-01-26 08:47:44');
/*!40000 ALTER TABLE `accessory_phone` ENABLE KEYS */;

-- Dumping structure for table mp.fileables
CREATE TABLE IF NOT EXISTS `fileables` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `file_id` int(10) unsigned NOT NULL,
  `fileable_id` int(10) unsigned NOT NULL,
  `fileable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fileables_fileable_id_fileable_type_index` (`fileable_id`,`fileable_type`),
  KEY `fileables_file_id_foreign` (`file_id`),
  CONSTRAINT `fileables_file_id_foreign` FOREIGN KEY (`file_id`) REFERENCES `files` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mp.fileables: ~0 rows (approximately)
/*!40000 ALTER TABLE `fileables` DISABLE KEYS */;
INSERT INTO `fileables` (`id`, `file_id`, `fileable_id`, `fileable_type`) VALUES
	(23, 23, 1, 'App\\Phone'),
	(24, 24, 1, 'App\\Accessory'),
	(25, 25, 4, 'App\\Phone'),
	(26, 26, 10, 'App\\Phone');
/*!40000 ALTER TABLE `fileables` ENABLE KEYS */;

-- Dumping structure for table mp.files
CREATE TABLE IF NOT EXISTS `files` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mp.files: ~0 rows (approximately)
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
INSERT INTO `files` (`id`, `type`, `name`, `path`, `created_at`, `updated_at`) VALUES
	(23, 'image', '22282050_10159471232750711_2314342738849573438_n.jpg', 'files/image\\22282050_10159471232750711_2314342738849573438_n.jpg', '2018-01-26 07:56:05', '2018-01-26 07:56:05'),
	(24, 'image', '22290016_1855424788101269_3242383464044788995_o.jpg', 'files/image\\22290016_1855424788101269_3242383464044788995_o.jpg', '2018-01-26 08:21:43', '2018-01-26 08:21:43'),
	(25, 'image', '18623381_1366215810127824_4299080965103388319_o.jpg', 'files/image\\18623381_1366215810127824_4299080965103388319_o.jpg', '2018-01-26 08:34:54', '2018-01-26 08:34:54'),
	(26, 'image', '19437427_1903436749913762_5581494014380014272_n.jpg', 'files/image\\19437427_1903436749913762_5581494014380014272_n.jpg', '2018-01-26 08:46:12', '2018-01-26 08:46:12');
/*!40000 ALTER TABLE `files` ENABLE KEYS */;

-- Dumping structure for table mp.media
CREATE TABLE IF NOT EXISTS `media` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `model_id` int(10) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `collection_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int(10) unsigned NOT NULL,
  `manipulations` json NOT NULL,
  `custom_properties` json NOT NULL,
  `order_column` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `media_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mp.media: ~0 rows (approximately)
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
/*!40000 ALTER TABLE `media` ENABLE KEYS */;

-- Dumping structure for table mp.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mp.migrations: ~8 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2018_01_22_095451_create_permission_tables', 1),
	(4, '2018_01_22_153504_create_phones_table', 1),
	(5, '2018_01_22_155550_create_media_table', 1),
	(6, '2018_01_23_092915_create_files_table', 1),
	(7, '2018_01_23_150252_create_accessories_table', 1),
	(8, '2018_01_23_152515_create_accessory_phone_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table mp.model_has_permissions
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `model_id` int(10) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mp.model_has_permissions: ~0 rows (approximately)
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;

-- Dumping structure for table mp.model_has_roles
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` int(10) unsigned NOT NULL,
  `model_id` int(10) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mp.model_has_roles: ~1 rows (approximately)
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` (`role_id`, `model_id`, `model_type`) VALUES
	(1, 1, 'App\\User');
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;

-- Dumping structure for table mp.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mp.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table mp.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mp.permissions: ~0 rows (approximately)
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

-- Dumping structure for table mp.phones
CREATE TABLE IF NOT EXISTS `phones` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `year` year(4) NOT NULL,
  `available` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mp.phones: ~9 rows (approximately)
/*!40000 ALTER TABLE `phones` DISABLE KEYS */;
INSERT INTO `phones` (`id`, `name`, `description`, `year`, `available`, `created_at`, `updated_at`) VALUES
	(1, 'Motorola Moto Z', 'Motorola Z series edited', '2000', 0, '2018-01-23 17:46:52', '2018-01-26 08:44:32'),
	(2, 'Sony Z1', 'Sony description', '2000', 1, '2018-01-23 17:47:22', '2018-01-24 10:45:37'),
	(3, 'Xiaomi Redmi 3S', '3S Pro', '2000', 0, '2018-01-24 09:30:58', '2018-01-24 14:13:36'),
	(4, 'Motorola moto g', 'series moto g edited', '2006', 1, '2018-01-24 14:10:45', '2018-01-26 08:35:15'),
	(5, 'Motorola moto g5 plus', 'series moto g', '2000', 1, '2018-01-24 14:11:08', '2018-01-24 14:11:08'),
	(6, 'Motorola Moto Play', 'Motorola Z series', '2017', 1, '2018-01-23 17:46:52', '2018-01-24 14:10:12'),
	(7, 'Motorola Moto Z2', 'Motorola Z series', '2017', 1, '2018-01-23 17:46:52', '2018-01-24 14:10:12'),
	(8, 'Sony ZX2', 'Xperia series', '2000', 1, '2018-01-23 17:47:22', '2018-01-24 10:45:37'),
	(9, 'Samsung S8', 'Samsung description', '2000', 1, '2018-01-25 11:03:08', '2018-01-25 15:26:00'),
	(10, 'Sony Z5', 'Sony Z1, Sony', '2011', 1, '2018-01-26 08:46:12', '2018-01-26 08:46:12');
/*!40000 ALTER TABLE `phones` ENABLE KEYS */;

-- Dumping structure for table mp.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mp.roles: ~2 rows (approximately)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'web', '2018-01-23 15:43:51', '2018-01-23 15:43:51'),
	(2, 'user', 'web', '2018-01-23 15:43:51', '2018-01-23 15:43:51');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Dumping structure for table mp.role_has_permissions
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mp.role_has_permissions: ~0 rows (approximately)
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;

-- Dumping structure for table mp.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mp.users: ~2 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', 'admin@site.bg', '$2y$10$DTCPfFB1OrxaBx20Ks1C5eNWFoJNHbcr4MFZvzFm2RnMElmLtjEUq', 'vkmJPZ9iVIRZDNf9ExqVLLg9X58U5rX8rdCNKChtS1kRAfig56nf4pzTeMAc', '2018-01-23 15:44:41', '2018-01-23 15:44:41'),
	(2, 'User', 'user@site.bg', '$2y$10$daHRdINwpdsvsC.Q6XHWre/ln7XBR2Ssz.1ZyLN6PrqrIued8Ppje', 'ZUOwnHggiurhlEgyXLgvP6ZLeI1n838J4nGsMUWemaV3TmBsIabFg4p2ckAt', '2018-01-23 15:45:01', '2018-01-23 15:45:01');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
