/*!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.8-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: kos_evanka_laravel
-- ------------------------------------------------------
-- Server version	10.11.8-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `banks`
--

DROP TABLE IF EXISTS `banks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `logo` varchar(255) DEFAULT NULL,
  `bank_name` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banks`
--

LOCK TABLES `banks` WRITE;
/*!40000 ALTER TABLE `banks` DISABLE KEYS */;
INSERT INTO `banks` VALUES
(1,'bank-logos/01JRX3VAFR6F19K72K4YN235FQ.jpeg','BRI','0225822','Dicky','2025-04-15 09:21:35','2025-04-15 16:17:21');
/*!40000 ALTER TABLE `banks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES
('e_kost_cache_356a192b7913b04c54574d18c28d46e6395428ab','i:1;',1744773362),
('e_kost_cache_356a192b7913b04c54574d18c28d46e6395428ab:timer','i:1744773362;',1744773362),
('laravel_cache_356a192b7913b04c54574d18c28d46e6395428ab','i:1;',1744733899),
('laravel_cache_356a192b7913b04c54574d18c28d46e6395428ab:timer','i:1744733899;',1744733899),
('laravel_cache_gimul|127.0.0.1','i:1;',1744718957),
('laravel_cache_gimul|127.0.0.1:timer','i:1744718957;',1744718957),
('laravel_cache_livewire-rate-limiter:a17961fa74e9275d529f489537f179c05d50c2f3','i:1;',1744731651),
('laravel_cache_livewire-rate-limiter:a17961fa74e9275d529f489537f179c05d50c2f3:timer','i:1744731651;',1744731651);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES
(1,'Deluxe','2025-04-15 09:17:29','2025-04-16 03:14:26'),
(2,'Premiere','2025-04-16 03:14:14','2025-04-16 03:14:14'),
(3,'Reguler','2025-04-16 03:14:19','2025-04-16 03:14:19');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES
(1,'0001_01_01_000000_create_users_table',1),
(2,'0001_01_01_000001_create_cache_table',1),
(3,'0001_01_01_000002_create_jobs_table',1),
(4,'2025_03_01_064934_create_categories_table',1),
(5,'2025_03_01_065439_create_rooms_table',1),
(6,'2025_04_15_090309_create_banks_table',1),
(7,'2025_04_15_143935_create_pesanan_table',2),
(8,'2025_04_15_143942_create_pembayaran_table',2),
(9,'2025_04_16_024115_create_settings_table',3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pembayaran`
--

DROP TABLE IF EXISTS `pembayaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pembayaran` (
  `id_pembayaran` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_pesanan` bigint(20) unsigned NOT NULL,
  `id_user` bigint(20) unsigned NOT NULL,
  `nominal_dibayar` decimal(12,2) NOT NULL,
  `bukti_pembayaran` varchar(255) NOT NULL,
  `tanggal_pembayaran` timestamp NOT NULL,
  `validasi` enum('pending','valid','invalid') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_pembayaran`),
  KEY `pembayaran_id_pesanan_foreign` (`id_pesanan`),
  KEY `pembayaran_id_user_foreign` (`id_user`),
  CONSTRAINT `pembayaran_id_pesanan_foreign` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`) ON DELETE CASCADE,
  CONSTRAINT `pembayaran_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pembayaran`
--

LOCK TABLES `pembayaran` WRITE;
/*!40000 ALTER TABLE `pembayaran` DISABLE KEYS */;
INSERT INTO `pembayaran` VALUES
(1,1,3,2750000.00,'bukti_pembayaran/vanLpavgRemD9Funm1knSd81jh74ZkJ6VnKjGGbZ.png','2025-04-15 14:44:48','invalid','2025-04-15 14:44:48','2025-04-15 15:07:36'),
(2,2,3,2750000.00,'bukti_pembayaran/JlJCh1jNeHoQCEeR4CGsEExbp72NqiyCV7IJPqcS.png','2025-04-15 14:45:47','invalid','2025-04-15 14:45:47','2025-04-15 15:07:34'),
(3,3,3,3000000.00,'bukti_pembayaran/j4Jf0zPJcBXWKyytNQUp27GBqkctSfSsHyfOfhoo.png','2025-04-15 15:27:48','valid','2025-04-15 15:27:48','2025-04-15 15:37:46'),
(4,4,3,400000.00,'bukti_pembayaran/PsSe6iyxQIVwzXPRWfQ7WPVJrS7WpJYhWvRMWKxg.jpg','2025-04-15 16:17:58','invalid','2025-04-15 16:17:58','2025-04-15 16:53:22'),
(5,5,2,400000.00,'bukti_pembayaran/stOmq82liTjlfn5WR17LQ7zPMlLjpmSLm4RGVuC5.png','2025-04-16 03:56:12','invalid','2025-04-16 03:56:12','2025-04-16 06:58:11'),
(6,6,2,400000.00,'bukti_pembayaran/17kQYHn3IWk7NoXZjhZZklbNJbSqTfeY76wApl19.png','2025-04-16 03:56:53','invalid','2025-04-16 03:56:53','2025-04-16 06:58:09'),
(7,7,2,400000.00,'bukti_pembayaran/Xh6umSMi1IzWLDCZHsGXYBEvPLqwtGQEpjphbvrl.png','2025-04-16 04:00:25','invalid','2025-04-16 04:00:25','2025-04-16 06:57:59'),
(8,8,2,400000.00,'bukti_pembayaran/JRVNc37RHeCU5ZjWAFKMbjMGVrLlTe9ZhkVE6taG.png','2025-04-16 04:00:36','invalid','2025-04-16 04:00:36','2025-04-16 06:57:58'),
(9,9,2,400000.00,'bukti_pembayaran/Vx9dEM5uMw9PeqmVfVSbC1sBSNzzxYsw8daeBTj8.png','2025-04-16 04:03:44','invalid','2025-04-16 04:03:44','2025-04-16 06:57:56'),
(10,10,2,400000.00,'bukti_pembayaran/bnzffH9CE9YFQfXdOnVNY0ws2wYCSS5NK4mUoh4C.png','2025-04-16 04:31:40','valid','2025-04-16 04:31:40','2025-04-16 04:43:35'),
(11,11,2,400000.00,'bukti_pembayaran/rGGYMzdpf6I0cqczwTyF38pbZjwpBpq0Ik00KKmG.png','2025-04-16 04:31:59','valid','2025-04-16 04:31:59','2025-04-16 04:50:51'),
(12,12,2,400000.00,'bukti_pembayaran/BvWkNIyoDGKmkrRjrHMiftj0ZgA9mR4zSZTXPtyN.png','2025-04-16 08:01:36','invalid','2025-04-16 08:01:36','2025-04-16 08:10:47'),
(13,13,3,400000.00,'bukti_pembayaran/04rqsJskqb2ZqtlhEHH8J3ltrY8dcfTqDSNiZbgl.png','2025-04-16 08:12:47','valid','2025-04-16 08:12:47','2025-04-16 08:19:30'),
(14,14,2,125000.00,'bukti_pembayaran/gz5MMXTmmjL9gaGF7qJ2hrhGN9xtf7JfgGSVKlhq.png','2025-04-16 08:31:10','valid','2025-04-16 08:31:10','2025-04-16 08:31:45');
/*!40000 ALTER TABLE `pembayaran` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pesanan`
--

DROP TABLE IF EXISTS `pesanan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pesanan` (
  `id_pesanan` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` bigint(20) unsigned NOT NULL,
  `id_kamar` bigint(20) unsigned NOT NULL,
  `durasi_sewa` int(11) NOT NULL,
  `nominal_tagihan` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_pesanan`),
  KEY `pesanan_id_user_foreign` (`id_user`),
  KEY `pesanan_id_kamar_foreign` (`id_kamar`),
  CONSTRAINT `pesanan_id_kamar_foreign` FOREIGN KEY (`id_kamar`) REFERENCES `rooms` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pesanan_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pesanan`
--

LOCK TABLES `pesanan` WRITE;
/*!40000 ALTER TABLE `pesanan` DISABLE KEYS */;
INSERT INTO `pesanan` VALUES
(1,3,1,11,2750000.00,'2025-04-15 14:44:47','2025-04-15 14:44:47'),
(2,3,1,11,2750000.00,'2025-04-15 14:45:47','2025-04-15 14:45:47'),
(3,3,1,12,3000000.00,'2025-04-15 15:27:48','2025-04-15 15:27:48'),
(4,3,2,1,400000.00,'2025-04-15 16:17:58','2025-04-15 16:17:58'),
(5,2,2,1,400000.00,'2025-04-16 03:56:12','2025-04-16 03:56:12'),
(6,2,2,1,400000.00,'2025-04-16 03:56:53','2025-04-16 03:56:53'),
(7,2,2,1,400000.00,'2025-04-16 04:00:25','2025-04-16 04:00:25'),
(8,2,2,1,400000.00,'2025-04-16 04:00:36','2025-04-16 04:00:36'),
(9,2,2,1,400000.00,'2025-04-16 04:03:44','2025-04-16 04:03:44'),
(10,2,2,1,400000.00,'2025-04-16 04:31:40','2025-04-16 04:31:40'),
(11,2,2,1,400000.00,'2025-04-16 04:31:59','2025-04-16 04:31:59'),
(12,2,2,1,400000.00,'2025-04-16 08:01:36','2025-04-16 08:01:36'),
(13,3,2,1,400000.00,'2025-04-16 08:12:47','2025-04-16 08:12:47'),
(14,2,3,1,125000.00,'2025-04-16 08:31:10','2025-04-16 08:31:10');
/*!40000 ALTER TABLE `pesanan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rooms` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) unsigned NOT NULL,
  `room_number` varchar(50) NOT NULL,
  `room_name` varchar(50) NOT NULL,
  `price` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('ready','not_ready') NOT NULL DEFAULT 'ready',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rooms_category_id_foreign` (`category_id`),
  CONSTRAINT `rooms_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rooms`
--

LOCK TABLES `rooms` WRITE;
/*!40000 ALTER TABLE `rooms` DISABLE KEYS */;
INSERT INTO `rooms` VALUES
(1,1,'1','kamar mawar','250000','ac tv','room-images/01JRY99MQN2QZ94NEG7A0E5JJC.jpg','not_ready','2025-04-15 09:18:10','2025-04-16 03:11:48'),
(2,1,'2','kamar jamu','400000','c tv kulkas','room-images/01JRY98VZR5BJHV740F14N2JJW.jpg','not_ready','2025-04-15 16:11:15','2025-04-16 08:19:30'),
(3,2,'3','Kamar sari','125000','Ac t kulkas','room-images/01JRY9FQ8PH56ESMYGTPR4H55K.jpg','not_ready','2025-04-16 03:15:07','2025-04-16 08:31:45');
/*!40000 ALTER TABLE `rooms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES
('6G8hpxlkbLZQtt4LSOd3XqohZiglj2Dt4r9aI9gH',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiRVZPV0ViOHNHS3VGZlR2TVpIYWhsWWd5Tkx1TXNmUkRjUXVhZ0tCMiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6OTAwMi8/bW9ub3NwYWNlVWlkPTAiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1744785410),
('P5diKjEJ9DD5DbRtS35SFZ28chkUhG9lXvPu93Qi',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoibDlMb0RJVTdQUUlhbmprcEt4SnRJbnFDRVg3eG5WQ1hMVTgyYXhnUSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6OTAwMi9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1744785412),
('ryl9I1ovM2JMBLcfY7bJiAn89ZZNEURaEjBCEMep',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoieGJva2lETFI1YzRqZDVyZTVUblB2UzJOT2xpbkJwVFFIQkYzQ0hMWSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6OTAwMi9hZG1pbi9wYXltZW50cyI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMiRnamdUNTEyOE03NzdvQ2Ewd1pSUjVPclNpajN2LlRUdnFBT3BJOVRJektCZ0UyaVZKYTZLTyI7fQ==',1744792305),
('vK4BTEX0YAyNQm3SxgTXnA2KY9ADUAZtzc2eG1O9',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiSlpGd0pWVHFGZ0VVRU93dWJwelBjQlhPVG9SUmNDMWwyNXJtQUVhcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly8xMjcuMC4wLjE6OTAwMi8/bW9ub3NwYWNlVWlkPTY0NjE0MCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1744785411);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `alamat` varchar(255) NOT NULL,
  `maps_embed` text DEFAULT NULL,
  `whatsapp` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES
(1,'Jalan kambing hitam','<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3955.7643338887656!2d112.70829152591332!3d-7.491252473882325!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7e1812411a7df%3A0x6f4631d0d1213057!2sUniversitas%20Muhammadiyah%20Sidoarjo%20kampus%202!5e0!3m2!1sid!2sid!4v1744620927260!5m2!1sid!2sid\" width=\"1200\" height=\"500\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>','0895411179875','2025-04-16 02:46:38','2025-04-16 03:55:34');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nik` varchar(50) NOT NULL DEFAULT '-',
  `name` varchar(50) NOT NULL DEFAULT 'Guest',
  `address` varchar(50) NOT NULL DEFAULT '-',
  `birth_date` date DEFAULT NULL,
  `gender` varchar(50) NOT NULL DEFAULT 'unknown',
  `phone` varchar(50) NOT NULL DEFAULT '-',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(1,'admin','admin','admin@gmail.com','$2y$12$gjgT5128M777oCa0wZRR5OrSij3v.TTvqAOpI9TIzKBgE2iVJa6KO','1234567890','Admin','Jakarta','2000-01-01','male','08123456789','2025-04-15 09:15:01','2025-04-15 09:15:01'),
(2,'user','dicky','dicky@gmail.com','$2y$12$C6Qbi/6INgCy03OaM.2HAeM1YNaowDEkaIWogPIUnkZilaaW.akFy','-','Dicky','Sidpoarjo','2025-04-15','laki-laki','0895411179875','2025-04-15 09:41:16','2025-04-16 04:43:10'),
(3,'user','gimul','gimul@gmail.com','$2y$12$W.j0YOc1nf4V3IC4yeoZ9uXI5ZbnbnJD.bWWe0Gh9Nde7fnrY6sAy','12129192','Fernaldo Mahardika','Sidoarjo','2025-04-15','laki-laki','0895555','2025-04-15 12:00:15','2025-04-15 16:41:10');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-16  8:43:04
