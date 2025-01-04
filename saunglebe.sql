-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 8.3.0 - MySQL Community Server - GPL
-- OS Server:                    Win64
-- HeidiSQL Versi:               12.8.0.6951
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Membuang struktur basisdata untuk saunglebe
CREATE DATABASE IF NOT EXISTS `saunglebe` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `saunglebe`;

-- membuang struktur untuk table saunglebe.detail_transaksi
CREATE TABLE IF NOT EXISTS `detail_transaksi` (
  `id_detail_transaksi` int NOT NULL AUTO_INCREMENT,
  `id_transaksi` int NOT NULL,
  `id_menu` int NOT NULL,
  `qty` int NOT NULL,
  `total_harga` int NOT NULL,
  PRIMARY KEY (`id_detail_transaksi`),
  KEY `a` (`id_menu`),
  KEY `b` (`id_transaksi`),
  CONSTRAINT `a` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `b` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel saunglebe.detail_transaksi: ~12 rows (lebih kurang)
DELETE FROM `detail_transaksi`;
INSERT INTO `detail_transaksi` (`id_detail_transaksi`, `id_transaksi`, `id_menu`, `qty`, `total_harga`) VALUES
	(1, 1, 3, 0, 0),
	(2, 1, 2, 0, 0),
	(3, 1, 4, 0, 0),
	(4, 3, 2, 2, 160000),
	(5, 3, 3, 1, 80000),
	(6, 3, 4, 1, 40000),
	(7, 5, 3, 1, 80000),
	(8, 6, 4, 1, 40000),
	(9, 7, 3, 1, 80000),
	(10, 7, 2, 1, 80000),
	(11, 8, 3, 1, 80000),
	(12, 8, 4, 1, 40000),
	(13, 9, 4, 3, 120000),
	(14, 9, 3, 2, 160000),
	(15, 9, 2, 1, 80000),
	(16, 10, 3, 1, 80000),
	(17, 10, 4, 5, 200000),
	(18, 11, 2, 1, 80000),
	(19, 11, 3, 4, 320000),
	(20, 11, 4, 2, 80000),
	(21, 12, 2, 2, 160000),
	(22, 12, 4, 1, 40000);

-- membuang struktur untuk table saunglebe.menu
CREATE TABLE IF NOT EXISTS `menu` (
  `id_menu` int NOT NULL AUTO_INCREMENT,
  `nama_menu` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `harga` int NOT NULL DEFAULT (0),
  `jenis_menu` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `foto_menu` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel saunglebe.menu: ~0 rows (lebih kurang)
DELETE FROM `menu`;
INSERT INTO `menu` (`id_menu`, `nama_menu`, `harga`, `jenis_menu`, `foto_menu`) VALUES
	(2, 'Pink Drink', 80000, 'minuman', 'uploads/menu/1735822406_8082c7dd5304bbcdb01d.jpg'),
	(3, 'Iced Toasted Vanilla Oatmilk S', 80000, 'minuman', 'uploads/menu/1735822424_2ffba0c25ea35a4fe97a.jpg'),
	(4, 'Ice Brown Sugar Oat Milk', 40000, 'minuman', 'uploads/menu/1735822448_35d16457d2ce47c03ce7.jpg');

-- membuang struktur untuk table saunglebe.transaksi
CREATE TABLE IF NOT EXISTS `transaksi` (
  `id_transaksi` int NOT NULL AUTO_INCREMENT,
  `kode_transaksi` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `total_belanja` int NOT NULL,
  `jenis_pembayaran` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `tunai` int NOT NULL,
  `kembalian` int NOT NULL,
  `tanggal` date NOT NULL,
  `id_user` int NOT NULL,
  PRIMARY KEY (`id_transaksi`),
  UNIQUE KEY `kode_transaksi` (`kode_transaksi`),
  KEY `c` (`id_user`),
  CONSTRAINT `c` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel saunglebe.transaksi: ~8 rows (lebih kurang)
DELETE FROM `transaksi`;
INSERT INTO `transaksi` (`id_transaksi`, `kode_transaksi`, `total_belanja`, `jenis_pembayaran`, `tunai`, `kembalian`, `tanggal`, `id_user`) VALUES
	(1, '20250102', 0, 'Tunai', 500000, 0, '2025-01-02', 2),
	(3, '2147483647', 0, 'Tunai', 300000, 0, '2025-01-02', 2),
	(5, '202501020003', 0, 'Tunai', 100000, 0, '2025-01-02', 2),
	(6, '202501020004', 0, 'Tunai', 50000, 0, '2025-01-02', 2),
	(7, '202501020005', 0, 'Tunai', 200000, -40000, '2025-01-02', 2),
	(8, '202501020006', 120000, 'Tunai', 150000, 30000, '2025-01-02', 2),
	(9, '202501020007', 360000, 'Tunai', 400000, 40000, '2025-01-02', 2),
	(10, '202501020008', 280000, 'Tunai', 300000, 20000, '2025-01-02', 2),
	(11, '202501020009', 480000, 'Tunai', 500000, 20000, '2025-01-02', 5),
	(12, '202501020010', 200000, 'Tunai', 200000, 0, '2025-01-02', 5);

-- membuang struktur untuk table saunglebe.user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `jabatan` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel saunglebe.user: ~2 rows (lebih kurang)
DELETE FROM `user`;
INSERT INTO `user` (`id_user`, `nama`, `email`, `password`, `jabatan`) VALUES
	(2, 'Admin', 'admin@saunglebe.com', '$2y$10$6Kntvy9r/eXMsmCr/CPiMOlkXTZStynbB9QFFN/y55QWnBPMTVho2', 'admin'),
	(5, 'Asep Sukma', 'thalalatha13@gmail.com', '$2y$10$Hzvgp9l/8IH1tVUtz.feq.QDP4lYLRGbwXiO063.Le1de0miNNCTq', 'kasir');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
