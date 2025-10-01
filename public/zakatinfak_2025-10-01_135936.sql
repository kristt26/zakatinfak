-- MySQL dump 10.13  Distrib 8.0.31, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: zakatinfak
-- ------------------------------------------------------
-- Server version	8.0.31

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `jenis_bantuan`
--

DROP TABLE IF EXISTS `jenis_bantuan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jenis_bantuan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_bantuan` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jenis_bantuan`
--

/*!40000 ALTER TABLE `jenis_bantuan` DISABLE KEYS */;
INSERT INTO `jenis_bantuan` VALUES (1,'Bantuan Biaya Pendidikan','Infak yang diperuntukkan untuk membantu biaya pendidikan secara umum.'),(2,'Bantuan Biaya Beasiswa Siswa-Siswi Berprestasi','Infak yang digunakan untuk memberikan beasiswa kepada siswa-siswi berprestasi.'),(3,'Bantuan biaya pendidikan insidentil (kuliah/sekolah)','Infak insidentil untuk mendukung kebutuhan mendesak pendidikan kuliah atau sekolah.'),(4,'Bantuan biaya ekonomi perorangan / komunitas','Infak untuk membantu kebutuhan ekonomi individu maupun komunitas.'),(5,'Bantuan biaya kesehatan','Infak yang dialokasikan untuk membantu biaya pengobatan dan kesehatan.'),(6,'Bantuan biaya hutang piutang','Infak yang diberikan untuk membantu pelunasan hutang/piutang mustahik.'),(7,'Bantuan Biaya Dakwah Keagamaan','Infak yang digunakan untuk mendukung kegiatan dakwah dan keagamaan.'),(8,'Bantuan Biaya Kemanusiaan','Infak untuk membantu korban bencana, konflik, dan kebutuhan kemanusiaan lainnya.');
/*!40000 ALTER TABLE `jenis_bantuan` ENABLE KEYS */;

--
-- Table structure for table `kategori_zis`
--

DROP TABLE IF EXISTS `kategori_zis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kategori_zis` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `no_rekening` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama_bank` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategori_zis`
--

/*!40000 ALTER TABLE `kategori_zis` DISABLE KEYS */;
INSERT INTO `kategori_zis` VALUES (1,'Zakat','1111-2222-3333-4444','Bank ABC','Kewajiban bagi muslim yang memenuhi syarat nisab dan haul, dengan aturan tertentu dan mustahik yang jelas.'),(2,'Infak','5555-6666-7777-8888','Bank XYZ','Pengeluaran harta untuk kebaikan, nilainya bebas sesuai kemampuan, tidak terikat nisab maupun haul.'),(3,'Sedekah','9999-0000-1111-2222','Bank DEF','Pemberian yang lebih luas, tidak hanya harta tetapi juga mencakup segala bentuk kebaikan, seperti senyum, tenaga, dan doa.');
/*!40000 ALTER TABLE `kategori_zis` ENABLE KEYS */;

--
-- Table structure for table `kelengkapan`
--

DROP TABLE IF EXISTS `kelengkapan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kelengkapan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_persyaratan` int NOT NULL,
  `file` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_pendaftaran` int NOT NULL,
  `status` enum('Valid','Tidak Valid') COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kelengkapan_id_persyaratan_foreign` (`id_persyaratan`),
  KEY `kelengkapan_id_pendaftaran_foreign` (`id_pendaftaran`),
  CONSTRAINT `kelengkapan_id_pendaftaran_foreign` FOREIGN KEY (`id_pendaftaran`) REFERENCES `pendaftaran` (`id`),
  CONSTRAINT `kelengkapan_id_persyaratan_foreign` FOREIGN KEY (`id_persyaratan`) REFERENCES `persyaratan` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kelengkapan`
--

/*!40000 ALTER TABLE `kelengkapan` DISABLE KEYS */;
INSERT INTO `kelengkapan` VALUES (1,37,'68dbeb39326d7.pdf',1,NULL),(2,38,'68dbeb3932e58.pdf',1,NULL),(3,37,'68dc1ca81524a.jpeg',2,NULL),(4,38,'68dc1ca81578a.jpeg',2,NULL);
/*!40000 ALTER TABLE `kelengkapan` ENABLE KEYS */;

--
-- Table structure for table `kriteria`
--

DROP TABLE IF EXISTS `kriteria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kriteria` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_kriteria` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bobot` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kriteria`
--

/*!40000 ALTER TABLE `kriteria` DISABLE KEYS */;
INSERT INTO `kriteria` VALUES (1,'Ekonomi',40),(2,'Kesehatan',10),(3,'Keimanan',5);
/*!40000 ALTER TABLE `kriteria` ENABLE KEYS */;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (42,'2025-09-28-044735','App\\Database\\Migrations\\Zakatinfak','default','App',1759221252,1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

--
-- Table structure for table `mustahik`
--

DROP TABLE IF EXISTS `mustahik`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mustahik` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `nik` varchar(16) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_general_ci,
  `telepon` varchar(16) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pekerjaan` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `penghasilan` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_users` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `mustahik_id_users_foreign` (`id_users`),
  CONSTRAINT `mustahik_id_users_foreign` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mustahik`
--

/*!40000 ALTER TABLE `mustahik` DISABLE KEYS */;
INSERT INTO `mustahik` VALUES (1,'Paulin Rachel Uyainah S.Kom','1872882012123434','Jln. Kartini No. 460, Tual 64032, Kepri','(+62) 334 1838 2','Perancang Busana','4000000','bmardhiyah@example.com',14),(2,'Prayitna Prabu Marbun','6411720210127010','Jr. Bazuka Raya No. 946, Binjai 21899, Kalbar','(+62) 542 0237 1','Wakil Presiden','< 1 Juta','qwahyudin@example.net',15),(3,'Kenes Samosir','1701654308185948','Kpg. Sukabumi No. 511, Tangerang Selatan 88086, Kalteng','0819 6686 8263','Nelayan / Perikanan','< 1 Juta','nurul.maheswara@example.net',16),(4,'Karsana Prasetya','9123662508991666','Jln. Yohanes No. 338, Tanjungbalai 89183, Jabar','(+62) 278 8471 6','Montir','> 5 Juta','sihombing.rahmi@example.org',17),(5,'Garang Salahudin','3571814207053567','Ds. Nanas No. 580, Palu 17783, Kaltim','(+62) 24 5272 98','Tukang Kayu','1-3 Juta','wlestari@example.org',18),(6,'Simon Gatra Jailani','7304321704039672','Psr. Moch. Ramdan No. 554, Tangerang 29240, Kaltara','(+62) 798 5253 4','Jaksa','> 5 Juta','fsaputra@example.net',19),(7,'Chandra Rahman Rajasa','1210465502152864','Jr. Cikutra Barat No. 641, Kupang 94285, Maluku','(+62) 826 7965 7','Nelayan / Perikanan','1-3 Juta','wacana.narji@example.net',20),(8,'Wirda Padmasari','9110603012178199','Ki. Cokroaminoto No. 882, Padangpanjang 99641, Jatim','0319 0105 802','Presiden','> 5 Juta','kwijaya@example.net',21),(9,'Zizi Farida','7414196910013469','Psr. Bawal No. 501, Palangka Raya 11160, Sulsel','(+62) 968 9901 1','Pialang','3-5 Juta','ratna51@example.com',22),(10,'Cakrawala Saputra M.M.','1371107101092006','Kpg. Urip Sumoharjo No. 28, Padangpanjang 44074, Jabar','0545 8319 111','Konsultan','1-3 Juta','shakila.yuliarti@example.net',23);
/*!40000 ALTER TABLE `mustahik` ENABLE KEYS */;

--
-- Table structure for table `muzaki`
--

DROP TABLE IF EXISTS `muzaki`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `muzaki` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nik` varchar(16) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_general_ci,
  `telepon` varchar(16) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `penghasilan` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_users` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `muzaki_id_users_foreign` (`id_users`),
  CONSTRAINT `muzaki_id_users_foreign` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `muzaki`
--

/*!40000 ALTER TABLE `muzaki` DISABLE KEYS */;
INSERT INTO `muzaki` VALUES (1,'3522501810013641','Jagaraga Erik Wasita S.E.I','Ki. Bakau No. 956, Sibolga 65328, DKI','(+62) 22 5704 36','8000000','rahayu.wahyudin@example.com',4),(2,'3315732512116013','Kamidin Wacana','Gg. Bayam No. 275, Cimahi 82421, Sulsel','(+62) 768 8324 1','5000000','oktaviani.mustofa@example.org',5),(3,'1102302003961588','Belinda Kusmawati S.Psi','Ds. Kyai Gede No. 886, Makassar 28002, Bali','(+62) 647 3368 9','9000000','hasna51@example.net',6),(4,'6309452708024986','Martana Dwi Nababan','Dk. Jagakarsa No. 45, Binjai 41044, Bali','0668 8032 278','9000000','rmaryati@example.org',7),(5,'1604421503242096','Fitriani Usada','Kpg. Basudewo No. 738, Salatiga 37274, Sulsel','0668 8465 889','7000000','vera.megantara@example.com',8),(6,'7571715404184980','Jaga Siregar M.Farm','Ki. Umalas No. 214, Manado 79261, Maluku','(+62) 874 3077 5','7000000','melani.jaiman@example.net',9),(7,'5208792802046923','Paris Citra Rahmawati','Ds. Halim No. 529, Sawahlunto 63339, DKI','0960 8224 076','7000000','tami85@example.net',10),(8,'7105344402983345','Wira Thamrin S.I.Kom','Ds. Imam No. 58, Malang 43057, Sulsel','0362 2219 235','5000000','cakrabuana39@example.net',11),(9,'9128656211105685','Calista Iriana Kuswandari S.Gz','Dk. Baan No. 182, Salatiga 84060, Jabar','0591 8281 1674','5000000','yahya.suartini@example.org',12),(10,'5208876611997546','Purwadi Prakasa','Psr. Cokroaminoto No. 115, Kupang 74233, Aceh','(+62) 349 4515 6','7000000','amelia.saragih@example.net',13);
/*!40000 ALTER TABLE `muzaki` ENABLE KEYS */;

--
-- Table structure for table `pendaftaran`
--

DROP TABLE IF EXISTS `pendaftaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pendaftaran` (
  `id` int NOT NULL AUTO_INCREMENT,
  `no_daftar` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_mustahik` int NOT NULL,
  `id_jenis_bantuan` int NOT NULL,
  `tanggal_daftar` date DEFAULT NULL,
  `alasan` text COLLATE utf8mb4_general_ci,
  `status_pengajuan` enum('diajukan','diverifikasi','disurvey','disetujui','ditolak') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pesan` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id`),
  KEY `pendaftaran_id_mustahik_foreign` (`id_mustahik`),
  KEY `pendaftaran_id_jenis_bantuan_foreign` (`id_jenis_bantuan`),
  CONSTRAINT `pendaftaran_id_jenis_bantuan_foreign` FOREIGN KEY (`id_jenis_bantuan`) REFERENCES `jenis_bantuan` (`id`),
  CONSTRAINT `pendaftaran_id_mustahik_foreign` FOREIGN KEY (`id_mustahik`) REFERENCES `mustahik` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pendaftaran`
--

/*!40000 ALTER TABLE `pendaftaran` DISABLE KEYS */;
INSERT INTO `pendaftaran` VALUES (1,'PEN-20250930-88528',1,8,'2025-09-30','asdfa sd a fasdf a dsaf asdf asd','disetujui',NULL),(2,'PEN-20251001-64551',1,8,'2025-09-30','Untuk Membantu Koerban Kencana Kebakaran','diajukan',NULL);
/*!40000 ALTER TABLE `pendaftaran` ENABLE KEYS */;

--
-- Table structure for table `persyaratan`
--

DROP TABLE IF EXISTS `persyaratan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `persyaratan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_persyaratan` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_jenis_bantuan` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `persyaratan_id_jenis_bantuan_foreign` (`id_jenis_bantuan`),
  CONSTRAINT `persyaratan_id_jenis_bantuan_foreign` FOREIGN KEY (`id_jenis_bantuan`) REFERENCES `jenis_bantuan` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `persyaratan`
--

/*!40000 ALTER TABLE `persyaratan` DISABLE KEYS */;
INSERT INTO `persyaratan` VALUES (1,'Surat permohonan bantuan',1),(2,'Surat keterangan tidak mampu dari kantor lurah',1),(3,'Surat rekomendasi kampus / surat aktif kuliah',1),(4,'Surat rekomendasi masjid',1),(5,'Foto copy kartu keluarga',1),(6,'Foto copy ktp dan ktp orang tua pemohon',1),(7,'Surat rekomendasi sekolah',2),(8,'Surat keterangan tidak mampu dari kantor lurah',2),(9,'Foto copy kartu keluarga pemohon',2),(10,'Foto copy ktp orang tua pemohon',2),(11,'Foto copy raport dan transkip nilai',2),(12,'Surat permohonan bantuan',3),(13,'Surat keterangan tidak mampu dari kantor lurah',3),(14,'Surat aktif kuliah',3),(15,'Foto copy ktp pemohon',3),(16,'Foto copy kartu keluarga pemohon',3),(17,'Surat rincian tunggakan kampus/sekolah',3),(18,'Surat permohonan bantuan',4),(19,'Surat keterangan tidak mampu dari kantor lurah',4),(20,'Surat rekomendasi masjid',4),(21,'Foto copy ktp pemohon',4),(22,'Foto copy kartu keluarga pemohon',4),(23,'Rincian anggaran biaya kebutuhan usaha',4),(24,'Surat permohonan bantuan',5),(25,'Foto copy ktp pemohon',5),(26,'Foto copy kartu keluarga pemohon',5),(27,'Surat keterangan tidak mampu',5),(28,'Resume medis dari dokter/rumah sakit',5),(29,'Surat permohonan bantuan',6),(30,'Foto copy ktp pemohon',6),(31,'Foto copy kartu keluarga pemohon',6),(32,'Surat keterangan tidak mampu dari kantor lurah',6),(33,'Surat pernyataan hutang piutang bermaterai',6),(34,'Bukti kwitansi lainnya',6),(35,'Surat permohonan bantuan',7),(36,'Foto copy identitas pemohon',7),(37,'Surat permohonan bantuan',8),(38,'Terms of Reference / perencanaan kegiatan',8);
/*!40000 ALTER TABLE `persyaratan` ENABLE KEYS */;

--
-- Table structure for table `pertanyaan`
--

DROP TABLE IF EXISTS `pertanyaan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pertanyaan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pertanyaan` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `opsi` text COLLATE utf8mb4_general_ci,
  `type` text COLLATE utf8mb4_general_ci,
  `id_sub_kriteria` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pertanyaan_id_sub_kriteria_foreign` (`id_sub_kriteria`),
  CONSTRAINT `pertanyaan_id_sub_kriteria_foreign` FOREIGN KEY (`id_sub_kriteria`) REFERENCES `sub_kriteria` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pertanyaan`
--

/*!40000 ALTER TABLE `pertanyaan` DISABLE KEYS */;
INSERT INTO `pertanyaan` VALUES (1,'Ukuran rumah (m2/orang)','a:4:{i:0;a:2:{s:5:\"label\";s:21:\"Sangat kecil (< 4 m2)\";s:4:\"skor\";i:4;}i:1;a:2:{s:5:\"label\";s:14:\"Kecil (4-6 m2)\";s:4:\"skor\";i:3;}i:2;a:2:{s:5:\"label\";s:15:\"Sedang (6-8 m2)\";s:4:\"skor\";i:0;}i:3;a:2:{s:5:\"label\";s:14:\"Besar (> 8 m2)\";s:4:\"skor\";i:-1;}}','radio',1),(2,'Kepemilikan Rumah','a:4:{i:0;a:2:{s:5:\"label\";s:9:\"Menumpang\";s:4:\"skor\";i:2;}i:1;a:2:{s:5:\"label\";s:8:\"Keluarga\";s:4:\"skor\";i:1;}i:2;a:2:{s:5:\"label\";s:12:\"Kontrak/Sewa\";s:4:\"skor\";i:3;}i:3;a:2:{s:5:\"label\";s:7:\"Sendiri\";s:4:\"skor\";i:0;}}','radio',1),(3,'Dinding rumah','a:4:{i:0;a:2:{s:5:\"label\";s:22:\"Bilik Bambu / Tripleks\";s:4:\"skor\";i:4;}i:1;a:2:{s:5:\"label\";s:4:\"Kayu\";s:4:\"skor\";i:2;}i:2;a:2:{s:5:\"label\";s:4:\"Semi\";s:4:\"skor\";i:1;}i:3;a:2:{s:5:\"label\";s:14:\"Tembok / Beton\";s:4:\"skor\";i:0;}}','radio',1),(4,'Lantai rumah','a:4:{i:0;a:2:{s:5:\"label\";s:5:\"Tanah\";s:4:\"skor\";i:4;}i:1;a:2:{s:5:\"label\";s:8:\"Panggung\";s:4:\"skor\";i:2;}i:2;a:2:{s:5:\"label\";s:5:\"Semen\";s:4:\"skor\";i:1;}i:3;a:2:{s:5:\"label\";s:7:\"Keramik\";s:4:\"skor\";i:0;}}','radio',1),(5,'Atap','a:4:{i:0;a:2:{s:5:\"label\";s:12:\"Kirai / Ijuk\";s:4:\"skor\";i:3;}i:1;a:2:{s:5:\"label\";s:4:\"Seng\";s:4:\"skor\";i:1;}i:2;a:2:{s:5:\"label\";s:14:\"Asbes / Glazur\";s:4:\"skor\";i:1;}i:3;a:2:{s:5:\"label\";s:7:\"Genteng\";s:4:\"skor\";i:1;}}','radio',1),(6,'Ventilasi','a:3:{i:0;a:2:{s:5:\"label\";s:10:\"Ada, layak\";s:4:\"skor\";i:0;}i:1;a:2:{s:5:\"label\";s:17:\"Ada, kurang layak\";s:4:\"skor\";i:2;}i:2;a:2:{s:5:\"label\";s:9:\"Tidak ada\";s:4:\"skor\";i:3;}}','radio',1),(7,'Plafon','a:3:{i:0;a:2:{s:5:\"label\";s:10:\"Ada, layak\";s:4:\"skor\";i:0;}i:1;a:2:{s:5:\"label\";s:17:\"Ada, kurang layak\";s:4:\"skor\";i:2;}i:2;a:2:{s:5:\"label\";s:9:\"Tidak ada\";s:4:\"skor\";i:3;}}','radio',1),(8,'MCK','a:4:{i:0;a:2:{s:5:\"label\";s:17:\"Sendiri, di dalam\";s:4:\"skor\";i:0;}i:1;a:2:{s:5:\"label\";s:16:\"Sendiri, di luar\";s:4:\"skor\";i:1;}i:2;a:2:{s:5:\"label\";s:13:\"Berbagi pakai\";s:4:\"skor\";i:2;}i:3;a:2:{s:5:\"label\";s:9:\"Tidak ada\";s:4:\"skor\";i:3;}}','radio',1),(9,'Sumber air untuk MCK','a:4:{i:0;a:2:{s:5:\"label\";s:4:\"PDAM\";s:4:\"skor\";i:0;}i:1;a:2:{s:5:\"label\";s:5:\"Sumur\";s:4:\"skor\";i:1;}i:2;a:2:{s:5:\"label\";s:6:\"Sungai\";s:4:\"skor\";i:2;}i:3;a:2:{s:5:\"label\";s:9:\"Air hujan\";s:4:\"skor\";i:3;}}','radio',1),(10,'Sumber air minum','a:5:{i:0;a:2:{s:5:\"label\";s:4:\"PDAM\";s:4:\"skor\";i:0;}i:1;a:2:{s:5:\"label\";s:5:\"Sumur\";s:4:\"skor\";i:1;}i:2;a:2:{s:5:\"label\";s:6:\"Sungai\";s:4:\"skor\";i:2;}i:3;a:2:{s:5:\"label\";s:9:\"Air hujan\";s:4:\"skor\";i:3;}i:4;a:2:{s:5:\"label\";s:19:\"Galon (air kemasan)\";s:4:\"skor\";i:-1;}}','radio',1),(11,'Daya listrik rumah','a:4:{i:0;a:2:{s:5:\"label\";s:7:\"450 kWh\";s:4:\"skor\";i:3;}i:1;a:2:{s:5:\"label\";s:7:\"900 kWh\";s:4:\"skor\";i:2;}i:2;a:2:{s:5:\"label\";s:8:\"1300 kWh\";s:4:\"skor\";i:0;}i:3;a:2:{s:5:\"label\";s:10:\"> 1300 kWh\";s:4:\"skor\";i:-1;}}','radio',1),(12,'Dapur','a:2:{i:0;a:2:{s:5:\"label\";s:10:\"Tersendiri\";s:4:\"skor\";i:0;}i:1;a:2:{s:5:\"label\";s:8:\"Terpisah\";s:4:\"skor\";i:1;}}','radio',1),(13,'Alat Dapur','a:4:{i:0;a:2:{s:5:\"label\";s:6:\"Tungku\";s:4:\"skor\";i:3;}i:1;a:2:{s:5:\"label\";s:10:\"Kompor Gas\";s:4:\"skor\";i:0;}i:2;a:2:{s:5:\"label\";s:13:\"Kompor Minyak\";s:4:\"skor\";i:2;}i:3;a:2:{s:5:\"label\";s:14:\"Kompor Listrik\";s:4:\"skor\";i:-1;}}','radio',1),(14,'Kepemilikan sawah / kebun','a:2:{i:0;a:2:{s:5:\"label\";s:3:\"Ada\";s:4:\"skor\";i:0;}i:1;a:2:{s:5:\"label\";s:9:\"Tidak ada\";s:4:\"skor\";i:5;}}','radio',2),(15,'Status kepemilikan sawah / kebun','a:4:{i:0;a:2:{s:5:\"label\";s:15:\"Warisan / Hibah\";s:4:\"skor\";i:0;}i:1;a:2:{s:5:\"label\";s:4:\"Beli\";s:4:\"skor\";i:0;}i:2;a:2:{s:5:\"label\";s:10:\"Bagi Hasil\";s:4:\"skor\";i:2;}i:3;a:2:{s:5:\"label\";s:4:\"Sewa\";s:4:\"skor\";i:3;}}','radio',2),(16,'Luas sawah / kebun','a:4:{i:0;a:2:{s:5:\"label\";s:7:\"<500 m2\";s:4:\"skor\";i:1;}i:1;a:2:{s:5:\"label\";s:14:\"500–1.000 m2\";s:4:\"skor\";i:0;}i:2;a:2:{s:5:\"label\";s:16:\"1.000–2.000 m2\";s:4:\"skor\";i:-1;}i:3;a:2:{s:5:\"label\";s:9:\">2.000 m2\";s:4:\"skor\";i:-2;}}','radio',2),(17,'Ternak (ada/tidak)','a:2:{i:0;a:2:{s:5:\"label\";s:10:\"Ternak ada\";s:4:\"skor\";i:0;}i:1;a:2:{s:5:\"label\";s:16:\"Ternak tidak ada\";s:4:\"skor\";i:5;}}','radio',2),(18,'Jenis ternak','a:4:{i:0;a:2:{s:5:\"label\";s:6:\"Unggas\";s:4:\"skor\";i:0;}i:1;a:2:{s:5:\"label\";s:7:\"Kambing\";s:4:\"skor\";i:0;}i:2;a:2:{s:5:\"label\";s:4:\"Sapi\";s:4:\"skor\";i:-1;}i:3;a:2:{s:5:\"label\";s:6:\"Kerbau\";s:4:\"skor\";i:-1;}}','checkbox',2),(19,'Status kepemilikan ternak','a:4:{i:0;a:2:{s:5:\"label\";s:15:\"Warisan / Hibah\";s:4:\"skor\";i:0;}i:1;a:2:{s:5:\"label\";s:4:\"Beli\";s:4:\"skor\";i:0;}i:2;a:2:{s:5:\"label\";s:10:\"Bagi Hasil\";s:4:\"skor\";i:2;}i:3;a:2:{s:5:\"label\";s:4:\"Sewa\";s:4:\"skor\";i:3;}}','radio',2),(20,'Kendaraan (ada/tidak)','a:2:{i:0;a:2:{s:5:\"label\";s:13:\"Kendaraan ada\";s:4:\"skor\";i:0;}i:1;a:2:{s:5:\"label\";s:19:\"Kendaraan tidak ada\";s:4:\"skor\";i:5;}}','radio',2),(21,'Jenis kendaraan','a:4:{i:0;a:2:{s:5:\"label\";s:6:\"Sepeda\";s:4:\"skor\";i:0;}i:1;a:2:{s:5:\"label\";s:12:\"Sepeda motor\";s:4:\"skor\";i:0;}i:2;a:2:{s:5:\"label\";s:5:\"Mobil\";s:4:\"skor\";i:-1;}i:3;a:2:{s:5:\"label\";s:13:\"Mobil pick up\";s:4:\"skor\";i:-1;}}','checkbox',2),(22,'Status kepemilikan kendaraan','a:5:{i:0;a:2:{s:5:\"label\";s:15:\"Warisan / Hibah\";s:4:\"skor\";i:0;}i:1;a:2:{s:5:\"label\";s:4:\"Beli\";s:4:\"skor\";i:0;}i:2;a:2:{s:5:\"label\";s:7:\"Titipan\";s:4:\"skor\";i:0;}i:3;a:2:{s:5:\"label\";s:10:\"Bagi Hasil\";s:4:\"skor\";i:1;}i:4;a:2:{s:5:\"label\";s:4:\"Sewa\";s:4:\"skor\";i:3;}}','radio',2),(23,'Alat komunikasi','a:4:{i:0;a:2:{s:5:\"label\";s:9:\"Tidak ada\";s:4:\"skor\";i:5;}i:1;a:2:{s:5:\"label\";s:25:\"Featured phone (hp biasa)\";s:4:\"skor\";i:2;}i:2;a:2:{s:5:\"label\";s:7:\"Android\";s:4:\"skor\";i:0;}i:3;a:2:{s:5:\"label\";s:25:\"iPhone / smartphone mahal\";s:4:\"skor\";i:0;}}','radio',2),(24,'Alat elektronik / perabot (pilih yang dimilik','a:11:{i:0;a:2:{s:5:\"label\";s:8:\"Televisi\";s:4:\"skor\";i:-1;}i:1;a:2:{s:5:\"label\";s:6:\"Kulkas\";s:4:\"skor\";i:-1;}i:2;a:2:{s:5:\"label\";s:6:\"Laptop\";s:4:\"skor\";i:-1;}i:3;a:2:{s:5:\"label\";s:10:\"Mesin cuci\";s:4:\"skor\";i:-1;}i:4;a:2:{s:5:\"label\";s:2:\"AC\";s:4:\"skor\";i:-1;}i:5;a:2:{s:5:\"label\";s:11:\"Kipas angin\";s:4:\"skor\";i:-1;}i:6;a:2:{s:5:\"label\";s:9:\"Dispenser\";s:4:\"skor\";i:-1;}i:7;a:2:{s:5:\"label\";s:4:\"Meja\";s:4:\"skor\";i:-1;}i:8;a:2:{s:5:\"label\";s:6:\"Lemari\";s:4:\"skor\";i:-1;}i:9;a:2:{s:5:\"label\";s:5:\"Kursi\";s:4:\"skor\";i:-1;}i:10;a:2:{s:5:\"label\";s:4:\"Sofa\";s:4:\"skor\";i:-1;}}','checkbox',2),(25,'Perabotan Rumah','a:4:{i:0;a:2:{s:5:\"label\";s:5:\"Kursi\";s:4:\"skor\";i:-1;}i:1;a:2:{s:5:\"label\";s:4:\"Sofa\";s:4:\"skor\";i:-1;}i:2;a:2:{s:5:\"label\";s:4:\"Meja\";s:4:\"skor\";i:-1;}i:3;a:2:{s:5:\"label\";s:6:\"Lemari\";s:4:\"skor\";i:-1;}}','checkbox',2),(26,'Simpanan (tabungan / perhiasan)','a:4:{i:0;a:2:{s:5:\"label\";s:4:\"Emas\";s:4:\"skor\";i:-1;}i:1;a:2:{s:5:\"label\";s:5:\"Perak\";s:4:\"skor\";i:-1;}i:2;a:2:{s:5:\"label\";s:13:\"Batu berharga\";s:4:\"skor\";i:-1;}i:3;a:2:{s:5:\"label\";s:8:\"Tabungan\";s:4:\"skor\";i:-1;}}','checkbox',2),(27,'Pendapatan keluarga total per bulan (Rp)','a:0:{}','number',3),(28,'Pengeluaran rutin keluarga per bulan (Rp)','a:0:{}','number',3),(29,'Jumlah Anggota Keluarga','a:0:{}','number',3),(30,'Frekuensi sakit (dalam sebulan)','a:2:{i:0;a:2:{s:5:\"label\";s:8:\"1-3 kali\";s:4:\"skor\";i:1;}i:1;a:2:{s:5:\"label\";s:8:\"> 3 kali\";s:4:\"skor\";i:3;}}','radio',4),(31,'Frekuensi makan (per hari)','a:2:{i:0;a:2:{s:5:\"label\";s:8:\"1-3 kali\";s:4:\"skor\";i:2;}i:1;a:2:{s:5:\"label\";s:8:\"> 3 kali\";s:4:\"skor\";i:0;}}','radio',4),(32,'Pembelian protein hewani (per pekan)','a:2:{i:0;a:2:{s:5:\"label\";s:8:\"1-3 kali\";s:4:\"skor\";i:2;}i:1;a:2:{s:5:\"label\";s:8:\"> 3 kali\";s:4:\"skor\";i:0;}}','radio',4),(33,'Penyakit kronis','a:2:{i:0;a:2:{s:5:\"label\";s:9:\"Tidak ada\";s:4:\"skor\";i:0;}i:1;a:2:{s:5:\"label\";s:3:\"Ada\";s:4:\"skor\";i:3;}}','radio',4),(34,'Merokok','a:2:{i:0;a:2:{s:5:\"label\";s:13:\"Tidak merokok\";s:4:\"skor\";i:2;}i:1;a:2:{s:5:\"label\";s:7:\"Merokok\";s:4:\"skor\";i:-1;}}','radio',4),(35,'Asuransi kesehatan','a:2:{i:0;a:2:{s:5:\"label\";s:3:\"Ada\";s:4:\"skor\";i:0;}i:1;a:2:{s:5:\"label\";s:9:\"Tidak ada\";s:4:\"skor\";i:2;}}','radio',5),(36,'Sanitasi (sampah & limbah RT)','a:2:{i:0;a:2:{s:5:\"label\";s:4:\"Baik\";s:4:\"skor\";i:0;}i:1;a:2:{s:5:\"label\";s:5:\"Buruk\";s:4:\"skor\";i:1;}}','radio',5),(37,'Sumber air minum layak?','a:2:{i:0;a:2:{s:5:\"label\";s:5:\"Layak\";s:4:\"skor\";i:0;}i:1;a:2:{s:5:\"label\";s:11:\"Tidak layak\";s:4:\"skor\";i:1;}}','radio',5),(38,'MCK (dari sisi kesehatan) layak?','a:2:{i:0;a:2:{s:5:\"label\";s:5:\"Layak\";s:4:\"skor\";i:0;}i:1;a:2:{s:5:\"label\";s:11:\"Tidak layak\";s:4:\"skor\";i:1;}}','radio',5),(39,'Dapur (kondisi) layak?','a:2:{i:0;a:2:{s:5:\"label\";s:5:\"Layak\";s:4:\"skor\";i:0;}i:1;a:2:{s:5:\"label\";s:11:\"Tidak layak\";s:4:\"skor\";i:1;}}','radio',5),(40,'Ventilasi rumah','a:2:{i:0;a:2:{s:5:\"label\";s:12:\"Tidak lembab\";s:4:\"skor\";i:0;}i:1;a:2:{s:5:\"label\";s:6:\"Lembab\";s:4:\"skor\";i:1;}}','radio',5),(41,'Lingkungan sekitar rumah','a:2:{i:0;a:2:{s:5:\"label\";s:11:\"Tidak kumuh\";s:4:\"skor\";i:0;}i:1;a:2:{s:5:\"label\";s:5:\"Kumuh\";s:4:\"skor\";i:1;}}','radio',5),(42,'Sholat fardhu','a:3:{i:0;a:2:{s:5:\"label\";s:5:\"Rajin\";s:4:\"skor\";i:2;}i:1;a:2:{s:5:\"label\";s:6:\"Jarang\";s:4:\"skor\";i:0;}i:2;a:2:{s:5:\"label\";s:12:\"Tidak pernah\";s:4:\"skor\";i:-2;}}','radio',6),(43,'Sholat di masjid','a:3:{i:0;a:2:{s:5:\"label\";s:5:\"Rajin\";s:4:\"skor\";i:2;}i:1;a:2:{s:5:\"label\";s:6:\"Jarang\";s:4:\"skor\";i:0;}i:2;a:2:{s:5:\"label\";s:12:\"Tidak pernah\";s:4:\"skor\";i:-1;}}','radio',6),(44,'Pengajian (keaktifan)','a:3:{i:0;a:2:{s:5:\"label\";s:16:\"Aktif ikut serta\";s:4:\"skor\";i:2;}i:1;a:2:{s:5:\"label\";s:6:\"Jarang\";s:4:\"skor\";i:1;}i:2;a:2:{s:5:\"label\";s:12:\"Tidak pernah\";s:4:\"skor\";i:0;}}','radio',6),(45,'Kegiatan masyarakat (keaktifan)','a:3:{i:0;a:2:{s:5:\"label\";s:16:\"Aktif ikut serta\";s:4:\"skor\";i:2;}i:1;a:2:{s:5:\"label\";s:6:\"Jarang\";s:4:\"skor\";i:1;}i:2;a:2:{s:5:\"label\";s:12:\"Tidak pernah\";s:4:\"skor\";i:0;}}','radio',6),(46,'Penampilan (tato, tindik, rambut punk)','a:3:{i:0;a:2:{s:5:\"label\";s:9:\"Tidak ada\";s:4:\"skor\";i:1;}i:1;a:2:{s:5:\"label\";s:17:\"Ada, sudah insyaf\";s:4:\"skor\";i:0;}i:2;a:2:{s:5:\"label\";s:3:\"Ada\";s:4:\"skor\";i:-2;}}','radio',6),(47,'Kebiasaan patologis (judi, miras, dll.)','a:3:{i:0;a:2:{s:5:\"label\";s:12:\"Tidak pernah\";s:4:\"skor\";i:1;}i:1;a:2:{s:5:\"label\";s:6:\"Jarang\";s:4:\"skor\";i:-1;}i:2;a:2:{s:5:\"label\";s:3:\"Ada\";s:4:\"skor\";i:-2;}}','radio',6);
/*!40000 ALTER TABLE `pertanyaan` ENABLE KEYS */;

--
-- Table structure for table `petugas`
--

DROP TABLE IF EXISTS `petugas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `petugas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `jabatan` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_users` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `petugas_id_users_foreign` (`id_users`),
  CONSTRAINT `petugas_id_users_foreign` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `petugas`
--

/*!40000 ALTER TABLE `petugas` DISABLE KEYS */;
INSERT INTO `petugas` VALUES (1,'Kania Farah Novitasari','Admin',1),(2,'Fathonah Ciaobella Andriani S.E.','Petugas',2),(3,'Cinta Gilda Zulaika S.Kom','Pimpinan',3);
/*!40000 ALTER TABLE `petugas` ENABLE KEYS */;

--
-- Table structure for table `rekomendasi`
--

DROP TABLE IF EXISTS `rekomendasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rekomendasi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_pendaftaran` int NOT NULL,
  `id_kriteria` int NOT NULL,
  `rekap` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rekomendasi_id_pendaftaran_foreign` (`id_pendaftaran`),
  KEY `rekomendasi_id_kriteria_foreign` (`id_kriteria`),
  CONSTRAINT `rekomendasi_id_kriteria_foreign` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id`),
  CONSTRAINT `rekomendasi_id_pendaftaran_foreign` FOREIGN KEY (`id_pendaftaran`) REFERENCES `pendaftaran` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rekomendasi`
--

/*!40000 ALTER TABLE `rekomendasi` DISABLE KEYS */;
INSERT INTO `rekomendasi` VALUES (1,1,1,53),(2,1,2,11),(3,1,3,6);
/*!40000 ALTER TABLE `rekomendasi` ENABLE KEYS */;

--
-- Table structure for table `sub_kriteria`
--

DROP TABLE IF EXISTS `sub_kriteria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sub_kriteria` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_sub` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_kriteria` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sub_kriteria_id_kriteria_foreign` (`id_kriteria`),
  CONSTRAINT `sub_kriteria_id_kriteria_foreign` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sub_kriteria`
--

/*!40000 ALTER TABLE `sub_kriteria` DISABLE KEYS */;
INSERT INTO `sub_kriteria` VALUES (1,'Indeks Rumah',1),(2,'Kepemilikan Harta',1),(3,'Penghasilan',1),(4,'Pola Hidup',2),(5,'Keadaan Rumah',2),(6,'Ibadan dan Kemasyarakatan',3);
/*!40000 ALTER TABLE `sub_kriteria` ENABLE KEYS */;

--
-- Table structure for table `survey`
--

DROP TABLE IF EXISTS `survey`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `survey` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_pendaftaran` int NOT NULL,
  `id_pertanyaan` int NOT NULL,
  `jawaban` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `survey_id_pendaftaran_foreign` (`id_pendaftaran`),
  KEY `survey_id_pertanyaan_foreign` (`id_pertanyaan`),
  CONSTRAINT `survey_id_pendaftaran_foreign` FOREIGN KEY (`id_pendaftaran`) REFERENCES `pendaftaran` (`id`),
  CONSTRAINT `survey_id_pertanyaan_foreign` FOREIGN KEY (`id_pertanyaan`) REFERENCES `pertanyaan` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `survey`
--

/*!40000 ALTER TABLE `survey` DISABLE KEYS */;
INSERT INTO `survey` VALUES (1,1,1,'Sangat kecil (< 4 m2)'),(2,1,2,'Menumpang'),(3,1,3,'Bilik Bambu / Tripleks'),(4,1,4,'Tanah'),(5,1,5,'Kirai / Ijuk'),(6,1,6,'Ada, layak'),(7,1,7,'Ada, layak'),(8,1,8,'Berbagi pakai'),(9,1,9,'Sungai'),(10,1,10,'Air hujan'),(11,1,11,'450 kWh'),(12,1,12,'Terpisah'),(13,1,13,'Tungku'),(14,1,14,'Ada'),(15,1,15,'Sewa'),(16,1,16,'<500 m2'),(17,1,17,'Ternak tidak ada'),(18,1,20,'Kendaraan ada'),(19,1,21,'Sepeda'),(20,1,22,'Sewa'),(21,1,23,'Featured phone (hp biasa)'),(22,1,24,'Televisi'),(23,1,25,'Kursi'),(24,1,27,'4000000'),(25,1,28,'2500000'),(26,1,29,'5'),(27,1,30,'> 3 kali'),(28,1,31,'1-3 kali'),(29,1,32,'> 3 kali'),(30,1,33,'Tidak ada'),(31,1,34,'Tidak merokok'),(32,1,35,'Tidak ada'),(33,1,36,'Baik'),(34,1,37,'Layak'),(35,1,38,'Layak'),(36,1,39,'Tidak layak'),(37,1,40,'Lembab'),(38,1,41,'Tidak kumuh'),(39,1,42,'Rajin'),(40,1,43,'Rajin'),(41,1,44,'Jarang'),(42,1,45,'Aktif ikut serta'),(43,1,46,'Ada, sudah insyaf'),(44,1,47,'Jarang');
/*!40000 ALTER TABLE `survey` ENABLE KEYS */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `akses` enum('admin','petugas','pimpinan','mustahik','muzaki') COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','$2y$10$3/zcSQyOcTZry7eq3LmEKeTBRnJFpeMN6zS/dxW5YHKQkQwf8kIxe','admin'),(2,'petugas','$2y$10$M4bciuJ0RV39IbJw/3oGouUOnkBQLIX08aDh2tyB/iC1ggP27NoR6','petugas'),(3,'pimpinan','$2y$10$XHrq0jOwR6CJAl7r.5WZMuW246xEJYf.PTrnTv7jEi0UWlgNluns6','pimpinan'),(4,'muzaki1','$2y$10$YA7rLC6EmMRnpyEAKWC2dOIFymX6MsHMGNbT9oy7NOTQRICp6soJ.','muzaki'),(5,'muzaki2','$2y$10$bHtNlbEyeQ689pkFCml7BuFw5/LAwK3vmPPiS7tkt81I6WeuJeZL2','muzaki'),(6,'muzaki3','$2y$10$ONL5C7wDoJNut4G0S2fTwOePTO52KA2CJAc0dJISmKG3HO9woq47C','muzaki'),(7,'muzaki4','$2y$10$bveB4ufez1k7Q5hw3gh5Ku6pGQEL67o2.0JaoEDdHNxOeREkJTnIK','muzaki'),(8,'muzaki5','$2y$10$PaFHuENV0DWeS2RX.IEHfegGwvX5N9GFMI3XYBtlkS23QfWJdKXKu','muzaki'),(9,'muzaki6','$2y$10$BnNRI9P.kXb9RRsEOQUGPuKwBkVgQeotWEXGmcwTs7XXZgushzX7O','muzaki'),(10,'muzaki7','$2y$10$0U86QJuaa6KjIgBpjSgRsei9lDfq82L3T0efNClpv243QuezsFPwu','muzaki'),(11,'muzaki8','$2y$10$tan1tLSrEdE8LoOxZhdw2O7pG1TyUUxSswobMktCk569X3BvzA4Fu','muzaki'),(12,'muzaki9','$2y$10$MPC22FBy6MutaLf5FCywf.l67bP0xGfb3Fesz3BXwaQLLH7paTwsK','muzaki'),(13,'muzaki10','$2y$10$65DtmuYu68iwYazg8t2Fyus27gW1eIiVUTdOH6QLbU5lwdfUpkqbW','muzaki'),(14,'mustahik1','$2y$10$Gs9rtzHzPkRLEk/HHXTkkeWXf5bC0DIA8.rkDErczpoqSKFmym5Ha','mustahik'),(15,'mustahik2','$2y$10$.Qov6M2wOIqj/isjTDNe3uebtJJx08bQ5viAtdVEkOMBhmI1sjziC','mustahik'),(16,'mustahik3','$2y$10$017D.4HW9SRw9R.LgxsfQeAzKHC0yh3V7YRv.GwPbwgnjQn4GOlyy','mustahik'),(17,'mustahik4','$2y$10$TcK6rUBhyWneNfyTD/b0A.AHC5qFxfa/MrFAbFnv7DHwnoIh1CBt.','mustahik'),(18,'mustahik5','$2y$10$WyTsYql8AtqSy8BhiTF/DOno5fMQBgVyQx/ngX4uGF0F8ISlBHPfa','mustahik'),(19,'mustahik6','$2y$10$o3geuPs2Ioogly9FDehAG.koIeoEGDeY1ZL3DbgTBrwcYug0BtsU2','mustahik'),(20,'mustahik7','$2y$10$4GqX17jKWgdYhsU2FI9xyeV3yvGfzz9ca2RqIcAH/hOQffpshD3zC','mustahik'),(21,'mustahik8','$2y$10$OsMyOQJtOgH.mvcaCYLF7e1f81daPtllCkEIUH.gZSqbZGjtiFNmW','mustahik'),(22,'mustahik9','$2y$10$EwLu5bFIE63oDg8UbDtc/OxyAXe.aPgEpzXhNNozGkh.XbUcsdn06','mustahik'),(23,'mustahik10','$2y$10$Ai8rgBNlc//8BkW9KnA7Red/TDcGT631KhPHWhCKYLLitCin56rOm','mustahik');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

--
-- Table structure for table `zakat`
--

DROP TABLE IF EXISTS `zakat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `zakat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `no_bayar` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jumlah_bayar` double DEFAULT NULL,
  `tanggal_bayar` datetime DEFAULT NULL,
  `bukti_bayar` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status_transaksi` enum('pending','valid','ditolak') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_muzaki` int DEFAULT NULL,
  `id_mustahik` int DEFAULT NULL,
  `id_kategori` int NOT NULL,
  `pesan` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id`),
  KEY `zakat_id_muzaki_foreign` (`id_muzaki`),
  KEY `zakat_id_mustahik_foreign` (`id_mustahik`),
  KEY `zakat_id_kategori_foreign` (`id_kategori`),
  CONSTRAINT `zakat_id_kategori_foreign` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_zis` (`id`),
  CONSTRAINT `zakat_id_mustahik_foreign` FOREIGN KEY (`id_mustahik`) REFERENCES `mustahik` (`id`),
  CONSTRAINT `zakat_id_muzaki_foreign` FOREIGN KEY (`id_muzaki`) REFERENCES `muzaki` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zakat`
--

/*!40000 ALTER TABLE `zakat` DISABLE KEYS */;
INSERT INTO `zakat` VALUES (1,'BYR-20250930-87939',200000,'2025-09-20 08:35:33','68dbcf6e2e5e3.jpeg','valid',1,NULL,1,NULL),(3,'BYR-20251001-25034',100000,'2025-09-30 15:33:52','68dbf8600c0e2.jpeg','valid',NULL,1,1,NULL),(4,'BYR-20251001-26219',200000,'2025-09-30 18:05:02','68dc1bcea342e.jpeg','pending',1,NULL,2,NULL);
/*!40000 ALTER TABLE `zakat` ENABLE KEYS */;

--
-- Dumping routines for database 'zakatinfak'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-10-01 13:59:43
