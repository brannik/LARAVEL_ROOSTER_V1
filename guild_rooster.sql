-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия на сървъра:            10.4.17-MariaDB-log - mariadb.org binary distribution
-- ОС на сървъра:                Win64
-- HeidiSQL Версия:              11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Дъмп на структурата на БД laravel
DROP DATABASE IF EXISTS `laravel`;
CREATE DATABASE IF NOT EXISTS `laravel` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `laravel`;

-- Дъмп структура за таблица laravel.characters
DROP TABLE IF EXISTS `characters`;
CREATE TABLE IF NOT EXISTS `characters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) NOT NULL DEFAULT 0,
  `guild` int(11) NOT NULL DEFAULT 0,
  `name` text NOT NULL,
  `race` text NOT NULL,
  `class` text NOT NULL,
  `rank` int(11) NOT NULL DEFAULT 0,
  `ms` text NOT NULL,
  `ms_gs` text NOT NULL,
  `os` text NOT NULL,
  `os_gs` text NOT NULL,
  `armory` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Дъмп данни за таблица laravel.characters: ~3 rows (приблизително)
DELETE FROM `characters`;
/*!40000 ALTER TABLE `characters` DISABLE KEYS */;
INSERT INTO `characters` (`id`, `owner_id`, `guild`, `name`, `race`, `class`, `rank`, `ms`, `ms_gs`, `os`, `os_gs`, `armory`) VALUES
	(1, 1, 1, 'Agset', 'Blood Elf', 'paladin', 3, 'DPS', '6.9', 'Heal', '6.5', 'http://armory.warmane.com/character/Agset/Icecrown/summary'),
	(2, 1, 1, 'Agsset', 'Tauren', 'druid', 2, 'DPS', '6.0', 'Heal', '6.2', 'http://armory.warmane.com/character/Agsset/Icecrown/summary'),
	(3, 2, 1, 'Brannik', 'Gnome', 'mage', 1, 'Arcane', '5.3', 'Fire', '5.3', 'http://armory.warmane.com/character/Brannik/Icecrown/summary');
/*!40000 ALTER TABLE `characters` ENABLE KEYS */;

-- Дъмп структура за таблица laravel.comunity_ranks
DROP TABLE IF EXISTS `comunity_ranks`;
CREATE TABLE IF NOT EXISTS `comunity_ranks` (
  `name` text DEFAULT NULL,
  `requirement_min` int(11) DEFAULT 0,
  `requirement_max` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Дъмп данни за таблица laravel.comunity_ranks: ~5 rows (приблизително)
DELETE FROM `comunity_ranks`;
/*!40000 ALTER TABLE `comunity_ranks` DISABLE KEYS */;
INSERT INTO `comunity_ranks` (`name`, `requirement_min`, `requirement_max`) VALUES
	('New commer', 1, 100),
	('Initial', 101, 250),
	('Member', 251, 1200),
	('Master', 1001, 2000),
	('Hated', -190000, 1);
/*!40000 ALTER TABLE `comunity_ranks` ENABLE KEYS */;

-- Дъмп структура за таблица laravel.failed_jobs
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дъмп данни за таблица laravel.failed_jobs: ~0 rows (приблизително)
DELETE FROM `failed_jobs`;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Дъмп структура за таблица laravel.guild
DROP TABLE IF EXISTS `guild`;
CREATE TABLE IF NOT EXISTS `guild` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `owner` int(11) NOT NULL DEFAULT 0,
  `banner` text NOT NULL,
  `reqruiter_rank` int(11) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Дъмп данни за таблица laravel.guild: ~0 rows (приблизително)
DELETE FROM `guild`;
/*!40000 ALTER TABLE `guild` DISABLE KEYS */;
INSERT INTO `guild` (`id`, `name`, `owner`, `banner`, `reqruiter_rank`) VALUES
	(1, 'Server Staff', 1, '', 4);
/*!40000 ALTER TABLE `guild` ENABLE KEYS */;

-- Дъмп структура за таблица laravel.guild_ranks
DROP TABLE IF EXISTS `guild_ranks`;
CREATE TABLE IF NOT EXISTS `guild_ranks` (
  `id` int(11) DEFAULT NULL,
  `guild_id` int(11) DEFAULT NULL,
  `name` text DEFAULT NULL,
  `color` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Дъмп данни за таблица laravel.guild_ranks: ~6 rows (приблизително)
DELETE FROM `guild_ranks`;
/*!40000 ALTER TABLE `guild_ranks` DISABLE KEYS */;
INSERT INTO `guild_ranks` (`id`, `guild_id`, `name`, `color`) VALUES
	(0, 1, 'Test', 'badge badge-pill badge-light text-dark'),
	(1, 1, 'Member', 'badge badge-pill badge-info text-dark'),
	(2, 1, 'Raider', 'badge badge-pill badge-success'),
	(3, 1, 'Heroic Raider', 'badge badge-pill badge-warning'),
	(4, 1, 'Officer', 'badge badge-pill badge-primary'),
	(5, 1, 'Guild Master', 'badge badge-pill badge-danger');
/*!40000 ALTER TABLE `guild_ranks` ENABLE KEYS */;

-- Дъмп структура за таблица laravel.mailbox
DROP TABLE IF EXISTS `mailbox`;
CREATE TABLE IF NOT EXISTS `mailbox` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender` int(11) NOT NULL DEFAULT 0,
  `reciever` int(11) NOT NULL DEFAULT 0,
  `is_system` int(11) NOT NULL DEFAULT 0,
  `title` text NOT NULL,
  `text` text NOT NULL,
  `is_read` int(11) NOT NULL DEFAULT 0,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `token` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Дъмп данни за таблица laravel.mailbox: ~4 rows (приблизително)
DELETE FROM `mailbox`;
/*!40000 ALTER TABLE `mailbox` DISABLE KEYS */;
INSERT INTO `mailbox` (`id`, `sender`, `reciever`, `is_system`, `title`, `text`, `is_read`, `date`, `token`) VALUES
	(1, 2, 1, 0, 'This is normal message', 'test here', 0, '2021-06-20 20:40:57', 'ASDASFAS'),
	(2, 2, 1, 1, 'This is system message', 'test here', 0, '2021-06-20 20:40:57', 'SHJDHGD'),
	(4, 1, 2, 0, 'This is normal message', 'test here', 1, '2021-06-20 20:40:57', 'asaasdasdas'),
	(5, 2, 1, 0, 'This is normal message', 'test here', 1, '2021-06-20 20:40:57', 'asaasdasdas'),
	(6, 1, 2, 0, 'Hello', 'This is test message from Brannik', 0, '2021-06-20 21:22:05', 'BGCFGQNOKKWMQE');
/*!40000 ALTER TABLE `mailbox` ENABLE KEYS */;

-- Дъмп структура за таблица laravel.messages
DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `messages_user_id_foreign` (`user_id`),
  CONSTRAINT `messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дъмп данни за таблица laravel.messages: ~0 rows (приблизително)
DELETE FROM `messages`;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` (`id`, `user_id`, `message`, `created_at`, `updated_at`) VALUES
	(19, 1, 'hello this is first guild chat message ever', '2021-06-24 23:52:09', '2021-06-24 23:52:09');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;

-- Дъмп структура за таблица laravel.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дъмп данни за таблица laravel.migrations: ~15 rows (приблизително)
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '0000_00_00_000000_create_websockets_statistics_entries_table', 2),
	(5, '2016_06_01_000001_create_oauth_auth_codes_table', 3),
	(6, '2016_06_01_000002_create_oauth_access_tokens_table', 3),
	(7, '2016_06_01_000003_create_oauth_refresh_tokens_table', 3),
	(8, '2016_06_01_000004_create_oauth_clients_table', 3),
	(9, '2016_06_01_000005_create_oauth_personal_access_clients_table', 3),
	(10, '2014_10_12_200000_add_two_factor_columns_to_users_table', 4),
	(11, '2019_12_14_000001_create_personal_access_tokens_table', 4),
	(12, '2021_06_22_194026_create_sessions_table', 4),
	(13, '2021_06_22_232859_create_events_table', 5),
	(14, '2013_04_09_062329_create_revisions_table', 6),
	(15, '2021_06_24_204555_create_messages_table', 7);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Дъмп структура за таблица laravel.news
DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL DEFAULT 0,
  `title` text NOT NULL,
  `text` text NOT NULL,
  `important` int(11) NOT NULL DEFAULT 0,
  `date` timestamp NULL DEFAULT current_timestamp(),
  `token` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

-- Дъмп данни за таблица laravel.news: ~2 rows (приблизително)
DELETE FROM `news`;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` (`id`, `author_id`, `title`, `text`, `important`, `date`, `token`) VALUES
	(14, 1, 'This is test post', 'This post is for testing purposes and is important', 1, '2021-06-17 01:05:21', 'NTVFDAPMNC'),
	(15, 2, 'This is second test post', 'This post is for testing purposes and is NOT important', 0, '2021-06-16 22:06:59', 'SKNXCYQYEH');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;

-- Дъмп структура за таблица laravel.password_resets
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дъмп данни за таблица laravel.password_resets: ~0 rows (приблизително)
DELETE FROM `password_resets`;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Дъмп структура за таблица laravel.personal_access_tokens
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дъмп данни за таблица laravel.personal_access_tokens: ~0 rows (приблизително)
DELETE FROM `personal_access_tokens`;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Дъмп структура за таблица laravel.rates
DROP TABLE IF EXISTS `rates`;
CREATE TABLE IF NOT EXISTS `rates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_user` int(11) NOT NULL DEFAULT 0,
  `to_user` int(11) NOT NULL DEFAULT 0,
  `type` text NOT NULL DEFAULT 'neutral',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- Дъмп данни за таблица laravel.rates: ~0 rows (приблизително)
DELETE FROM `rates`;
/*!40000 ALTER TABLE `rates` DISABLE KEYS */;
/*!40000 ALTER TABLE `rates` ENABLE KEYS */;

-- Дъмп структура за таблица laravel.revisions
DROP TABLE IF EXISTS `revisions`;
CREATE TABLE IF NOT EXISTS `revisions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `revisionable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revisionable_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `old_value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `new_value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `revisions_revisionable_id_revisionable_type_index` (`revisionable_id`,`revisionable_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дъмп данни за таблица laravel.revisions: ~0 rows (приблизително)
DELETE FROM `revisions`;
/*!40000 ALTER TABLE `revisions` DISABLE KEYS */;
/*!40000 ALTER TABLE `revisions` ENABLE KEYS */;

-- Дъмп структура за таблица laravel.sessions
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дъмп данни за таблица laravel.sessions: ~1 rows (приблизително)
DELETE FROM `sessions`;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('FiWHGKUpnOufxS8suYX6wRL8geOhIpn3uXHLLxtW', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.77 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiQWRwUDZWMDY0Y2tBbTFOSUZUdHI1UWpmcnA1aUU0Z3ViOVNGQnM5RiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTAkRi5QNXRyQ2ZDQ0NqSEc4Wm55Q3RIdTVRcWFuSkp5MFJ4OHNTckppLlNQanpOYURzUlVRTlciO3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2MDoiJDJ5JDEwJEYuUDV0ckNmQ0NDakhHOFpueUN0SHU1UXFhbkpKeTBSeDhzU3JKaS5TUGp6TmFEc1JVUU5XIjt9', 1624390969);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;

-- Дъмп структура за таблица laravel.settings
DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action` text DEFAULT NULL,
  `value` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `it_has_value` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4;

-- Дъмп данни за таблица laravel.settings: ~31 rows (приблизително)
DELETE FROM `settings`;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` (`id`, `action`, `value`, `description`, `it_has_value`) VALUES
	(1, 'vote_account_up_me', '2', 'Comunity points goint to voter account on vote up', 1),
	(2, 'vote_account_down_me', '-50', 'Comunity points goint to voter account on vote down', 1),
	(3, 'vote_account_up', '10', 'Comunity points goint to voted account on vote up', 1),
	(4, 'vote_account_down', '-10', 'Comunity points goint to voted account on vote down', 1),
	(9, 'report_bug', '3', 'Who can report bugs', 1),
	(10, 'post_news', '2', 'Who can post news', 1),
	(11, 'new_forum_category', '5', 'Who can create new forum category', 1),
	(12, 'new_forum_post', '3', 'Who can create new forum post', 1),
	(13, 'new_forum_comment', '1', 'Who can create new forum comment', 1),
	(14, 'edit_my_forum_cat', NULL, 'Can i edit my forum category', 0),
	(15, 'edit_my_post', NULL, 'Can i edit my forum post', 0),
	(16, 'edit_my_comment', NULL, 'Can i edit my forum comment', 0),
	(17, 'delete_my_forum_cat', NULL, 'Can i delete my forum category', 0),
	(18, 'delete_my_forum_post', NULL, 'Can i delete my forum post', 0),
	(19, 'delete_my_forum_comment', NULL, 'Can i delete my forum comment', 0),
	(20, 'edit_forum_cat', '1', 'Who can edit forum category', 1),
	(21, 'edit_forum_post', '1', 'Who can edit forum post', 1),
	(22, 'edit_forum_comment', '1', 'Who can edit forum comment', 1),
	(23, 'delete_forum_cat', NULL, 'Who can delete forum category', 0),
	(24, 'delete_forum_post', NULL, 'Who can delete forum post', 0),
	(25, 'delete_forum_comment', NULL, 'Who can delete forum comment', 0),
	(26, 'edit_news', NULL, 'Who can edit news', 0),
	(27, 'delete_news', NULL, 'Who can delete news', 0),
	(28, 'mod_panel', NULL, 'Who can see moderator panel', 0),
	(29, 'admin_panel', NULL, 'Who can see admin panel', 0),
	(30, 'mod_supp_panel', NULL, 'Who can see support panel for moderators', 0),
	(31, 'can_vote_for_user', NULL, 'Who can vote for other users', 0),
	(32, 'guild_chat', NULL, 'Who can use guild chat', 0),
	(33, 'support_chat', NULL, 'Who can use support chat', 0),
	(34, 'support_levels', NULL, 'Accounts in support access group', 0),
	(35, 'guild_chat_update_interval', '5', 'Set guild chat update interval', 1);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;

-- Дъмп структура за таблица laravel.settings_permission
DROP TABLE IF EXISTS `settings_permission`;
CREATE TABLE IF NOT EXISTS `settings_permission` (
  `option` int(11) DEFAULT NULL,
  `web_rank` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Дъмп данни за таблица laravel.settings_permission: ~31 rows (приблизително)
DELETE FROM `settings_permission`;
/*!40000 ALTER TABLE `settings_permission` DISABLE KEYS */;
INSERT INTO `settings_permission` (`option`, `web_rank`) VALUES
	(1, 1),
	(2, 1),
	(3, 1),
	(4, 1),
	(9, 2),
	(10, 3),
	(34, 3),
	(12, 2),
	(13, 2),
	(14, 1),
	(15, 1),
	(16, 1),
	(17, 1),
	(18, 1),
	(19, 1),
	(20, 3),
	(21, 3),
	(22, 3),
	(23, 3),
	(24, 3),
	(25, 3),
	(26, 3),
	(27, 3),
	(28, 3),
	(29, 4),
	(30, 3),
	(31, 1),
	(32, 1),
	(33, 3),
	(11, 2),
	(35, 4);
/*!40000 ALTER TABLE `settings_permission` ENABLE KEYS */;

-- Дъмп структура за таблица laravel.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `faction` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'images/banner.jpg',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rank` int(11) DEFAULT 0,
  `guild_rank` int(11) DEFAULT 0,
  `guild_id` int(11) DEFAULT 0,
  `banned` int(11) DEFAULT 0,
  `ban_reason` text COLLATE utf8mb4_unicode_ci DEFAULT 'NO W',
  `warning` text COLLATE utf8mb4_unicode_ci DEFAULT 'NO W',
  `pic` text COLLATE utf8mb4_unicode_ci DEFAULT 'images/no_user.jpg',
  `dkp_net` int(11) DEFAULT 0,
  `dkp_tot` int(11) DEFAULT 0,
  `comunity_points` int(11) DEFAULT 1,
  `last_seen` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дъмп данни за таблица laravel.users: ~4 rows (приблизително)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `faction`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `created_at`, `updated_at`, `rank`, `guild_rank`, `guild_id`, `banned`, `ban_reason`, `warning`, `pic`, `dkp_net`, `dkp_tot`, `comunity_points`, `last_seen`) VALUES
	(1, 'brannik', 'images/horde.jpg', 'georgi.vtu.mi@gmail.com', '2021-06-18 01:38:24', '$2y$10$F.P5trCfCCCjHG8ZnyCtHu5QqanJJy0Rx8sSrJi.SPjzNaDsRUQNW', NULL, NULL, 'jWkUG1w9kXhcqrNg6KEuACG1cNNVY7ddiTEZNDNnkigN7oWRS0JhWcvvsFi9', '2021-06-14 17:54:23', '2021-06-28 16:32:25', 4, 5, 1, 0, 'NO W', 'There is some wrning', 'images/no_user.jpg', 12333, 52442, 1, '2021-06-28 16:32:25'),
	(2, 'ATester', 'images/horde.jpg', 'tester@gmail.com', '2021-06-18 01:38:23', '$2y$10$TvH4yz2/sjvgIJgGRDB.seH9YDKubpsHqocKVL8Aj8EW7Ts9.fK3m', NULL, NULL, 'sPYm2M0H55MQ9vqxgoPofje6KPNdFMtHSLUJRXySXAJp1lHN4OII5jy229M0', '2021-06-17 20:04:54', '2021-06-21 03:05:46', 3, 4, 1, 0, 'NO W', 'Verify your email', 'images/no_user.jpg', 12, 144, 1, '2021-06-21 03:05:46'),
	(4, 'tester2', 'images/horde.jpg', 'tester2@gmail.com', '2021-06-18 01:38:23', '$2y$10$TvH4yz2/sjvgIJgGRDB.seH9YDKubpsHqocKVL8Aj8EW7Ts9.fK3m', NULL, NULL, NULL, '2021-06-17 20:04:54', '2021-06-17 20:04:54', 2, 4, 1, 0, 'Staff disrespect', 'Verify your email', 'images/no_user.jpg', 122, 14444, 1, NULL),
	(5, 'tester3', 'images/horde.jpg', 'tester3@gmail.com', '2021-06-18 01:38:23', '$2y$10$TvH4yz2/sjvgIJgGRDB.seH9YDKubpsHqocKVL8Aj8EW7Ts9.fK3m', NULL, NULL, NULL, '2021-06-17 20:04:54', '2021-06-17 20:04:54', 1, 1, 1, 0, 'Staff disrespect', 'Verify your email', 'images/no_user.jpg', 122, 14444, 1, NULL),
	(6, 'tester4', 'images/horde.jpg', 'tester4@gmail.com', '0000-00-00 00:00:00', '$2y$10$TvH4yz2/sjvgIJgGRDB.seH9YDKubpsHqocKVL8Aj8EW7Ts9.fK3m', NULL, NULL, NULL, '2021-06-17 20:04:54', '2021-06-17 20:04:54', 1, 1, 1, 0, 'Staff disrespect', 'Verify your email', 'images/no_user.jpg', 122, 14444, 1, NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Дъмп структура за таблица laravel.web_ranks
DROP TABLE IF EXISTS `web_ranks`;
CREATE TABLE IF NOT EXISTS `web_ranks` (
  `id` int(11) DEFAULT NULL,
  `rank_name` text DEFAULT NULL,
  `rank_color` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Дъмп данни за таблица laravel.web_ranks: ~4 rows (приблизително)
DELETE FROM `web_ranks`;
/*!40000 ALTER TABLE `web_ranks` DISABLE KEYS */;
INSERT INTO `web_ranks` (`id`, `rank_name`, `rank_color`) VALUES
	(0, 'Unverified', 'badge badge-pill badge-light'),
	(1, 'Player', 'badge badge-pill badge-info'),
	(2, 'VIP', 'badge badge-pill badge-primary'),
	(3, 'Moderator', 'badge badge-pill badge-warning'),
	(4, 'Administrator', 'badge badge-pill badge-danger');
/*!40000 ALTER TABLE `web_ranks` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
