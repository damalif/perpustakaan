-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 8.0.30 - MySQL Community Server - GPL
-- OS Server:                    Win64
-- HeidiSQL Versi:               12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Membuang struktur basisdata untuk perpustakaan
CREATE DATABASE IF NOT EXISTS `perpustakaan` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `perpustakaan`;

-- membuang struktur untuk table perpustakaan.book
CREATE TABLE IF NOT EXISTS `book` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `author` varchar(50) NOT NULL,
  `publication_year` varchar(4) NOT NULL,
  `id_publisher` int NOT NULL,
  `id_category` int NOT NULL,
  `quantity` int NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_publisher` (`id_publisher`),
  KEY `id_category` (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Membuang data untuk tabel perpustakaan.book: ~4 rows (lebih kurang)
INSERT INTO `book` (`id`, `title`, `author`, `publication_year`, `id_publisher`, `id_category`, `quantity`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Naruto', 'Masashi Kishimoto', '1997', 1, 1, 30, NULL, NULL, NULL),
	(2, 'Naruto Vol2', 'Masashi Kishimoto', '2000', 2, 1, 15, '2023-05-16 11:03:28', '2023-05-16 12:36:07', '2023-05-16 12:36:07'),
	(3, 'Boboiboy', 'Tok Abah', '2005', 1, 1, 10, '2023-05-16 12:03:14', '2023-05-16 12:15:31', NULL),
	(4, 'Septihan', 'Poppi Pertiwi', '2020', 1, 7, 1, '2023-05-17 11:32:21', '2023-05-17 11:32:21', NULL);

-- membuang struktur untuk table perpustakaan.borrow
CREATE TABLE IF NOT EXISTS `borrow` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_borrower` int NOT NULL,
  `id_book` int NOT NULL,
  `id_staff` int NOT NULL,
  `release_date` date NOT NULL,
  `due_date` date NOT NULL,
  `note` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_borrower` (`id_borrower`),
  KEY `id_book` (`id_book`),
  KEY `id_staff` (`id_staff`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Membuang data untuk tabel perpustakaan.borrow: ~1 rows (lebih kurang)
INSERT INTO `borrow` (`id`, `id_borrower`, `id_book`, `id_staff`, `release_date`, `due_date`, `note`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 1, 1, '2023-05-19', '2023-05-30', 'Selesai pinjam', '2023-05-19 11:05:15', '2023-05-19 11:22:20', NULL);

-- membuang struktur untuk table perpustakaan.borrower
CREATE TABLE IF NOT EXISTS `borrower` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `birthdate` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `gender` enum('L','P') NOT NULL,
  `contact` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Membuang data untuk tabel perpustakaan.borrower: ~3 rows (lebih kurang)
INSERT INTO `borrower` (`id`, `name`, `birthdate`, `address`, `gender`, `contact`, `email`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'adam', '2005-05-04', 'cangkuang city', 'L', '000455', 'dix@gmail.com', '2023-05-15 12:46:51', '2023-05-16 08:13:58', NULL),
	(2, 'dam', '2005-05-05', 'cangkuang cuy', 'P', '455000', 'dox@gmail.com', '2023-05-15 12:56:57', '2023-05-15 13:12:10', NULL),
	(3, 'Andin', '2023-05-17', 'Leles', 'P', '12345', 'andin@gmail.com', '2023-05-17 11:33:14', '2023-05-19 08:25:24', '2023-05-19 08:25:24');

-- membuang struktur untuk table perpustakaan.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Membuang data untuk tabel perpustakaan.category: ~4 rows (lebih kurang)
INSERT INTO `category` (`id`, `category`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Komik', '2023-05-15 11:18:35', '2023-05-15 11:25:12', NULL),
	(2, 'Action', '2023-05-15 11:19:11', '2023-05-15 11:25:28', NULL),
	(3, 'Drama Action', '2023-05-16 12:24:55', '2023-05-16 12:25:02', NULL),
	(4, 'Novel', '2023-05-17 11:27:31', '2023-05-17 11:27:31', NULL);

-- membuang struktur untuk table perpustakaan.publisher
CREATE TABLE IF NOT EXISTS `publisher` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Membuang data untuk tabel perpustakaan.publisher: ~2 rows (lebih kurang)
INSERT INTO `publisher` (`id`, `name`, `address`, `contact`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'PT. Maju maju', 'Leles', '123', '2023-05-15 10:50:09', '2023-05-16 09:32:20', NULL),
	(2, 'PT. Jaya jaya', 'Kadungora', '456', '2023-05-15 12:43:01', '2023-05-15 12:43:01', NULL);

-- membuang struktur untuk table perpustakaan.staff
CREATE TABLE IF NOT EXISTS `staff` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Membuang data untuk tabel perpustakaan.staff: ~3 rows (lebih kurang)
INSERT INTO `staff` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'adam', 'adam@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', NULL, NULL, NULL),
	(2, 'dam', 'dam@gmail.com', '8fe9ac6cd5db63a78701c39c3cff6797', '2023-05-12 11:25:39', '2023-05-12 11:25:39', NULL),
	(3, 'alif', 'alif@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2023-05-17 10:03:46', '2023-05-17 10:03:46', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
