-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 22 Şub 2021, 15:28:43
-- Sunucu sürümü: 5.7.26
-- PHP Sürümü: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `2018469023`
--

DELIMITER $$
--
-- Yordamlar
--
DROP PROCEDURE IF EXISTS `her-bir-startv-dizisinin-ortalama-ab-puani`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `her-bir-startv-dizisinin-ortalama-ab-puani` ()  NO SQL
SELECT round(AVG(reytingler.ab_puan),1) as ab_ortalama, diziler.dizi_ad
FROM kanallar, diziler, yayin, reytingler
WHERE kanallar.kanal_id=diziler.kanal_id
AND diziler.dizi_id=yayin.dizi_id
AND yayin.reyting_id=reytingler.reyting_id
AND kanallar.kanal_id=3
GROUP BY diziler.dizi_id$$

DROP PROCEDURE IF EXISTS `her-bir-startv-dizisinin-ortalama-total-puani`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `her-bir-startv-dizisinin-ortalama-total-puani` ()  NO SQL
SELECT round(AVG(reytingler.total_puan),1) as total_ortalama, diziler.dizi_ad
FROM kanallar, diziler, yayin, reytingler
WHERE kanallar.kanal_id=diziler.kanal_id
AND diziler.dizi_id=yayin.dizi_id
AND yayin.reyting_id=reytingler.reyting_id
AND kanallar.kanal_id=3
GROUP BY diziler.dizi_id$$

DROP PROCEDURE IF EXISTS `sefirin-kizi-ab-puanları`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sefirin-kizi-ab-puanları` ()  NO SQL
SELECT yayin.bolum, reytingler.ab_puan
FROM diziler,yayin,reytingler
WHERE diziler.dizi_id=yayin.dizi_id
AND yayin.reyting_id=reytingler.reyting_id
AND diziler.dizi_ad='Sefirin Kizi'
ORDER BY yayin.bolum$$

DROP PROCEDURE IF EXISTS `sefirin-kizi-total-puanları`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sefirin-kizi-total-puanları` ()  NO SQL
SELECT yayin.bolum, reytingler.total_puan
FROM diziler,yayin,reytingler
WHERE diziler.dizi_id=yayin.dizi_id
AND yayin.reyting_id=reytingler.reyting_id
AND diziler.dizi_ad='Sefirin Kizi'
ORDER BY yayin.bolum$$

DROP PROCEDURE IF EXISTS `soru10_AB_reytingi_2_alti_olan diziler`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `soru10_AB_reytingi_2_alti_olan diziler` ()  NO SQL
SELECT diziler.dizi_id, diziler.dizi_ad, round(MIN(reytingler.ab_puan),2) as en_dusuk_AB_puan, reytingler.reyting_id, yayin.bolum, yayin.tarih
FROM diziler,yayin,reytingler
WHERE diziler.dizi_id=yayin.dizi_id
AND yayin.reyting_id=reytingler.reyting_id
GROUP BY reytingler.reyting_id
HAVING en_dusuk_AB_puan<2
ORDER BY en_dusuk_AB_puan$$

DROP PROCEDURE IF EXISTS `soru1_adi_girilen_dizinin_kanal_bolum_tarih_ve_reytingleri`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `soru1_adi_girilen_dizinin_kanal_bolum_tarih_ve_reytingleri` (IN `dizi` VARCHAR(255))  NO SQL
SELECT kanallar.kanal_ad, yayin.bolum, diziler.dizi_ad, yayin.tarih, reytingler.total_puan, reytingler.ab_puan
FROM diziler, kanallar, yayin, reytingler
WHERE diziler.kanal_id=kanallar.kanal_id
AND diziler.dizi_id=yayin.dizi_id
AND yayin.reyting_id=reytingler.reyting_id
AND diziler.dizi_ad LIKE concat('%',dizi,'%')
ORDER BY yayin.tarih$$

DROP PROCEDURE IF EXISTS `soru2_tarih_parametreli_iki_tarih_arasi_reytingler`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `soru2_tarih_parametreli_iki_tarih_arasi_reytingler` (IN `tarih1` DATE, IN `tarih2` DATE)  NO SQL
SELECT diziler.dizi_ad, yayin.tarih, gunler.gun_ad, yayin.bolum, reytingler.total_puan, reytingler.ab_puan
FROM diziler, yayin, reytingler, gunler, dizi_gun
WHERE diziler.dizi_id=yayin.dizi_id
AND yayin.reyting_id=reytingler.reyting_id
AND diziler.dizi_id=dizi_gun.dizi_id
AND gunler.gun_id=dizi_gun.gun_id
AND yayin.tarih BETWEEN tarih1 AND tarih2
ORDER BY yayin.tarih$$

DROP PROCEDURE IF EXISTS `soru3_adi_girilen_kanalin_dizileri_ve_gunleri`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `soru3_adi_girilen_kanalin_dizileri_ve_gunleri` (IN `kanal` VARCHAR(255))  NO SQL
SELECT kanallar.kanal_ad, diziler.dizi_ad, gunler.gun_ad
FROM kanallar, diziler, gunler, dizi_gun
WHERE diziler.kanal_id=kanallar.kanal_id
AND diziler.dizi_id=dizi_gun.dizi_id
AND dizi_gun.gun_id=gunler.gun_id
AND kanallar.kanal_ad LIKE concat('%',kanal,'%')
ORDER BY gunler.gun_id$$

DROP PROCEDURE IF EXISTS `soru4_tarih_parametre_dizilerin_total_puanlari`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `soru4_tarih_parametre_dizilerin_total_puanlari` (IN `tarih` DATE)  NO SQL
SELECT kanallar.kanal_ad as kanal, gunler.gun_ad as gün, diziler.dizi_ad as dizi, yayin.tarih, reytingler.total_puan
FROM diziler, kanallar, yayin, reytingler, gunler, dizi_gun
WHERE diziler.kanal_id=kanallar.kanal_id
AND diziler.dizi_id=yayin.dizi_id
AND yayin.reyting_id=reytingler.reyting_id
AND gunler.gun_id=dizi_gun.gun_id
AND dizi_gun.dizi_id=diziler.dizi_id
AND yayin.tarih LIKE concat('%',tarih,'%')
ORDER BY reytingler.total_puan DESC$$

DROP PROCEDURE IF EXISTS `soru5_tarih_parametre_dizilerin_ab_puanlari`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `soru5_tarih_parametre_dizilerin_ab_puanlari` (IN `tarih` DATE)  NO SQL
SELECT kanallar.kanal_ad as kanal, gunler.gun_ad as gün, diziler.dizi_ad as dizi, yayin.tarih, reytingler.ab_puan
FROM diziler, kanallar, yayin, reytingler, gunler, dizi_gun
WHERE diziler.kanal_id=kanallar.kanal_id
AND diziler.dizi_id=yayin.dizi_id
AND yayin.reyting_id=reytingler.reyting_id
AND gunler.gun_id=dizi_gun.gun_id
AND dizi_gun.dizi_id=diziler.dizi_id
AND yayin.tarih LIKE concat('%',tarih,'%')
ORDER BY reytingler.ab_puan DESC$$

DROP PROCEDURE IF EXISTS `soru6_her_güne_ait_dizi_sayisi`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `soru6_her_güne_ait_dizi_sayisi` ()  NO SQL
SELECT gunler.gun_ad, COUNT(dizi_gun.dizi_id) AS dizi_sayısı
FROM diziler, dizi_gun, gunler
WHERE diziler.dizi_id=dizi_gun.dizi_id
AND dizi_gun.gun_id=gunler.gun_id
GROUP BY gunler.gun_id$$

DROP PROCEDURE IF EXISTS `soru7_her_kanalin_total_ab_ortalaması`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `soru7_her_kanalin_total_ab_ortalaması` ()  NO SQL
SELECT kanallar.kanal_ad, round(AVG(reytingler.total_puan),1) as total_puan_ortalaması, round(AVG(reytingler.ab_puan),1) as AB_puan_ortalaması
FROM kanallar, diziler, yayin, reytingler
WHERE kanallar.kanal_id=diziler.kanal_id
AND reytingler.reyting_id=yayin.reyting_id
AND yayin.dizi_id=diziler.dizi_id
GROUP BY kanallar.kanal_id$$

DROP PROCEDURE IF EXISTS `soru8_her_dizinin_max_total_puanları`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `soru8_her_dizinin_max_total_puanları` ()  NO SQL
SELECT kanallar.kanal_ad, diziler.dizi_ad, round(MAX(reytingler.total_puan),2) as max_total_puanlar
FROM kanallar, diziler, yayin, reytingler
WHERE kanallar.kanal_id=diziler.kanal_id
AND diziler.dizi_id=yayin.dizi_id
AND yayin.reyting_id=reytingler.reyting_id
GROUP BY diziler.dizi_id$$

DROP PROCEDURE IF EXISTS `soru9_reyting_ortalamasi_7_ustu_diziler`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `soru9_reyting_ortalamasi_7_ustu_diziler` ()  NO SQL
SELECT kanallar.kanal_ad, diziler.dizi_ad, round(AVG(reytingler.total_puan),2) AS total_ortalama, round(AVG(reytingler.ab_puan),2) as AB_ortalama
FROM kanallar,diziler,yayin,reytingler
WHERE kanallar.kanal_id=diziler.kanal_id
AND diziler.dizi_id=yayin.dizi_id
AND yayin.reyting_id=reytingler.reyting_id
GROUP BY diziler.dizi_id
HAVING total_ortalama AND AB_ortalama>7$$

DROP PROCEDURE IF EXISTS `startv-ortalama-ab-puanini-sorgulayiniz`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `startv-ortalama-ab-puanini-sorgulayiniz` ()  NO SQL
SELECT round(AVG(reytingler.ab_puan),1) AS ortalama
FROM kanallar, diziler, yayin, reytingler
WHERE kanallar.kanal_id=diziler.kanal_id
AND diziler.dizi_id=yayin.dizi_id
AND yayin.reyting_id=reytingler.reyting_id
AND kanallar.kanal_ad='Star TV'$$

DROP PROCEDURE IF EXISTS `startv-ortalama-total-puanini-sorgulayiniz`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `startv-ortalama-total-puanini-sorgulayiniz` ()  NO SQL
SELECT round(AVG(reytingler.total_puan),1) AS ortalama
FROM kanallar, diziler, yayin, reytingler
WHERE kanallar.kanal_id=diziler.kanal_id
AND diziler.dizi_id=yayin.dizi_id
AND yayin.reyting_id=reytingler.reyting_id
AND kanallar.kanal_ad='Star TV'$$

DROP PROCEDURE IF EXISTS `startv-toplam-dizi-sayisi`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `startv-toplam-dizi-sayisi` ()  NO SQL
SELECT COUNT(diziler.dizi_id) as dizi_sayısı
FROM kanallar,diziler
WHERE kanallar.kanal_id=diziler.kanal_id
AND kanallar.kanal_ad='Star TV'$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `diziler`
--

DROP TABLE IF EXISTS `diziler`;
CREATE TABLE IF NOT EXISTS `diziler` (
  `dizi_id` int(11) NOT NULL,
  `kanal_id` int(11) NOT NULL,
  `dizi_ad` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`dizi_id`),
  KEY `kanal_id` (`kanal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `diziler`
--

INSERT INTO `diziler` (`dizi_id`, `kanal_id`, `dizi_ad`) VALUES
(1, 1, 'Alev Alev'),
(2, 1, 'Ramo'),
(3, 1, 'Kuzey Yıldızı İlk Aşk'),
(4, 1, 'Arıza'),
(5, 1, 'Çukur'),
(8, 2, 'Sadakatsiz'),
(9, 2, 'Hekimoğlu'),
(10, 2, 'Arka Sokaklar'),
(11, 3, 'Sefirin Kizi'),
(12, 3, 'Menajerimi Ara'),
(13, 3, 'Sol Yanim '),
(14, 3, 'Akrep'),
(15, 4, 'Eşkıya Dünyaya Hükümdar Olmaz'),
(16, 4, 'Kuruluş Osman'),
(17, 4, 'Bir Zamanlar Çukurova'),
(18, 4, 'Hercai'),
(19, 4, 'Akıncı'),
(20, 5, 'Kefaret'),
(21, 5, 'Mucize Doktor'),
(22, 5, 'Sen Çal Kapımı'),
(23, 5, 'Yasak Elma'),
(24, 5, 'Baraj'),
(25, 6, 'Doğduğun Ev Kaderindir'),
(26, 6, 'Kırmızı Oda'),
(27, 7, 'Masumlar Apartmanı'),
(28, 7, 'Uyanış: Büyük Selçuklu'),
(29, 7, 'Gönül Dağı'),
(30, 7, 'Payitaht Abdülhamid'),
(31, 7, 'Tövbeler Olsun'),
(32, 5, 'Son Yaz');

--
-- Tetikleyiciler `diziler`
--
DROP TRIGGER IF EXISTS `adi_değisen_diziler`;
DELIMITER $$
CREATE TRIGGER `adi_değisen_diziler` BEFORE UPDATE ON `diziler` FOR EACH ROW INSERT INTO guncellenen_diziler VALUES (old.dizi_ad, now())
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `final_yapan_diziler`;
DELIMITER $$
CREATE TRIGGER `final_yapan_diziler` AFTER DELETE ON `diziler` FOR EACH ROW INSERT INTO final VALUES(old.dizi_ad, now())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `dizi_gun`
--

DROP TABLE IF EXISTS `dizi_gun`;
CREATE TABLE IF NOT EXISTS `dizi_gun` (
  `dizi_id` int(11) NOT NULL,
  `gun_id` int(11) NOT NULL,
  KEY `dizi_id` (`dizi_id`),
  KEY `gun_id` (`gun_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `dizi_gun`
--

INSERT INTO `dizi_gun` (`dizi_id`, `gun_id`) VALUES
(1, 4),
(2, 5),
(3, 6),
(4, 7),
(5, 1),
(8, 3),
(9, 2),
(10, 5),
(11, 1),
(12, 7),
(13, 4),
(14, 5),
(15, 2),
(16, 3),
(17, 4),
(18, 5),
(20, 7),
(21, 4),
(22, 6),
(23, 1),
(24, 2),
(25, 3),
(26, 5),
(27, 2),
(28, 1),
(29, 6),
(30, 5),
(31, 7),
(32, 5),
(32, 5),
(19, 5),
(19, 5);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `final`
--

DROP TABLE IF EXISTS `final`;
CREATE TABLE IF NOT EXISTS `final` (
  `dizi_id` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `final_tarih` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `final`
--

INSERT INTO `final` (`dizi_id`, `final_tarih`) VALUES
('Bir Annenin Günahı', '2021-02-01 21:15:14'),
('Babam Çok Değişti', '2021-02-01 21:31:59');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `guncellenen_diziler`
--

DROP TABLE IF EXISTS `guncellenen_diziler`;
CREATE TABLE IF NOT EXISTS `guncellenen_diziler` (
  `dizi_ad` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `tarih` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `guncellenen_diziler`
--

INSERT INTO `guncellenen_diziler` (`dizi_ad`, `tarih`) VALUES
('İyi Aile Babası', '2021-02-01 21:22:37');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `gunler`
--

DROP TABLE IF EXISTS `gunler`;
CREATE TABLE IF NOT EXISTS `gunler` (
  `gun_id` int(11) NOT NULL,
  `gun_ad` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`gun_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `gunler`
--

INSERT INTO `gunler` (`gun_id`, `gun_ad`) VALUES
(1, 'Pazartesi'),
(2, 'Salı'),
(3, 'Çarşamba'),
(4, 'Perşembe'),
(5, 'Cuma'),
(6, 'Cumartesi'),
(7, 'Pazar');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kanallar`
--

DROP TABLE IF EXISTS `kanallar`;
CREATE TABLE IF NOT EXISTS `kanallar` (
  `kanal_id` int(11) NOT NULL,
  `kanal_ad` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`kanal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `kanallar`
--

INSERT INTO `kanallar` (`kanal_id`, `kanal_ad`) VALUES
(1, 'Show TV'),
(2, 'Kanal D'),
(3, 'Star TV'),
(4, 'ATV'),
(5, 'Fox'),
(6, 'TV8'),
(7, 'TRT 1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanici`
--

DROP TABLE IF EXISTS `kullanici`;
CREATE TABLE IF NOT EXISTS `kullanici` (
  `kullanici_id` int(11) NOT NULL,
  `ad` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `soyad` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `eposta` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `sifre` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`kullanici_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `kullanici`
--

INSERT INTO `kullanici` (`kullanici_id`, `ad`, `soyad`, `eposta`, `sifre`, `avatar`) VALUES
(1, 'Gokcen', 'Dilber', 'dilbergokcen@gmail.com', '1234', 'img/avatar.jpg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `reytingler`
--

DROP TABLE IF EXISTS `reytingler`;
CREATE TABLE IF NOT EXISTS `reytingler` (
  `reyting_id` int(11) NOT NULL,
  `total_puan` float NOT NULL,
  `ab_puan` float NOT NULL,
  PRIMARY KEY (`reyting_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `reytingler`
--

INSERT INTO `reytingler` (`reyting_id`, `total_puan`, `ab_puan`) VALUES
(1, 5.84, 4.79),
(2, 6.03, 5.37),
(3, 5.84, 5.2),
(4, 6.14, 4.85),
(5, 6.29, 5.53),
(6, 7.37, 6.27),
(7, 8.94, 5.78),
(8, 6.92, 4.9),
(9, 6.55, 4.72),
(10, 7.51, 5.25),
(11, 6.53, 4.77),
(12, 6.07, 4.15),
(13, 6.82, 4.76),
(14, 5.79, 3.75),
(15, 6.59, 4.79),
(16, 6.26, 4.16),
(17, 4.06, 4.15),
(18, 5.28, 4.23),
(19, 5.8, 4.23),
(20, 5.24, 3.86),
(21, 4.93, 2.97),
(22, 5.07, 3.47),
(23, 5.38, 4.11),
(24, 5.34, 4.48),
(25, 5.4, 4.42),
(26, 6.63, 5.21),
(27, 6.16, 4.85),
(28, 6.09, 4.92),
(29, 6.77, 4.6),
(35, 2.96, 2.21),
(36, 3.27, 2.56),
(37, 3.3, 2.45),
(38, 6.02, 7.13),
(39, 6.85, 8.49),
(40, 8.04, 10.12),
(41, 7.38, 10.02),
(42, 9.28, 11.85),
(43, 10.08, 11.58),
(44, 10.65, 10.91),
(45, 9.69, 11.72),
(46, 11.11, 12.38),
(47, 11.05, 11.89),
(48, 4.25, 5.06),
(49, 3.14, 4.55),
(50, 8.33, 11.47),
(51, 9.86, 13.39),
(52, 9.61, 14.11),
(53, 9.56, 14.38),
(54, 10.44, 14.37),
(55, 9.91, 12.13),
(56, 10.29, 12.96),
(57, 10.68, 14.64),
(58, 11.21, 14.8),
(59, 10.85, 13.71),
(60, 11.38, 15.68),
(61, 11.45, 15.68),
(62, 11, 14.39),
(63, 6.55, 5.8),
(64, 5.99, 5.72),
(65, 6.57, 5.23),
(66, 5.9, 5.7),
(67, 3.39, 3.62),
(68, 4.71, 6.01),
(69, 5.23, 5.12),
(70, 5.01, 5),
(71, 6.77, 6.93),
(72, 7.46, 7.16),
(73, 8.16, 7.33),
(74, 8.22, 7.94),
(75, 3.72, 3.49),
(76, 5.2, 5.62),
(77, 4.59, 4.78),
(78, 5.07, 5.09),
(79, 5.14, 4.63),
(80, 5.49, 4.55),
(81, 5.49, 5.3),
(82, 5.9, 4.39),
(83, 5.88, 4.34),
(84, 5.68, 5.05),
(85, 6.77, 4.68),
(86, 5.46, 4.39),
(87, 6.24, 4.31),
(88, 6.05, 4.87),
(89, 4.25, 6.1),
(90, 6.31, 7.49),
(91, 6.75, 9.03),
(92, 7.21, 10.65),
(93, 7.67, 10.94),
(94, 7.28, 9.93),
(95, 7.57, 11.02),
(96, 5.92, 7.41),
(97, 7.12, 10.3),
(98, 7.62, 8.63),
(99, 7.48, 10.06),
(100, 7.72, 9.85),
(101, 9.05, 11.78),
(102, 9, 11.45),
(103, 8.48, 11.86),
(104, 7.13, 8.44),
(105, 8.03, 10.07),
(106, 7.8, 9.89),
(107, 7.27, 9.08),
(108, 7.08, 8.31),
(109, 6.8, 7.36),
(110, 7.25, 8.93),
(111, 8.05, 9.1),
(112, 8.04, 9.24),
(113, 8.89, 10.45),
(114, 9.05, 11.12),
(115, 8.28, 9.38),
(116, 5.05, 2.91),
(117, 5.62, 2.66),
(118, 5.22, 1.95),
(119, 4.42, 1.87),
(120, 5.29, 2.63),
(121, 5.28, 2.44),
(122, 5.67, 2.96),
(123, 6.16, 2.89),
(124, 6.87, 2.52),
(125, 7.45, 3.51),
(126, 8.57, 4.44),
(127, 9.22, 4.49),
(128, 8.07, 3.19),
(129, 7.38, 3.12),
(130, 6.04, 4.74),
(131, 6.51, 6.45),
(132, 6.51, 5.41),
(133, 6.76, 5.07),
(134, 6.33, 5.25),
(135, 6.15, 5.46),
(136, 6.84, 5.83),
(137, 7.44, 5.94),
(138, 7.11, 5.86),
(139, 6.58, 4.51),
(140, 7.46, 5.81),
(141, 7.65, 5.33),
(142, 7.93, 5.88),
(143, 8.69, 6.49),
(144, 8.76, 6.88),
(145, 3.16, 4.52),
(146, 3.1, 4.66),
(147, 3.05, 4.67),
(148, 3.49, 4.83),
(149, 3.04, 3.93),
(150, 2.59, 3.54),
(151, 2.39, 3.52),
(152, 2.89, 4.58),
(153, 2.95, 3.78),
(154, 3.01, 4.34),
(155, 2.77, 3.41),
(156, 2.89, 4.14),
(157, 3.36, 4.42),
(158, 3.29, 4.46),
(159, 3.93, 4.94),
(160, 5.18, 3.05),
(161, 5.22, 2.73),
(162, 5.8, 2.31),
(163, 5.87, 2.77),
(164, 5.83, 2.99),
(165, 6.89, 3.27),
(166, 6.64, 3.35),
(167, 6.59, 4.04),
(168, 6.87, 4.29),
(169, 7.74, 3.75),
(170, 7.28, 4.54),
(171, 7.94, 4.2),
(172, 7.87, 4.27),
(173, 4.8, 4.63),
(174, 5, 4.71),
(175, 5.84, 4.8),
(176, 4.88, 4.33),
(177, 5.44, 4.79),
(178, 5.69, 3.84),
(179, 6.78, 4.59),
(180, 5.78, 5.12),
(181, 7.05, 5.81),
(182, 6.09, 4.78),
(183, 6.47, 4.26),
(184, 6.46, 4.87),
(185, 6.22, 4.3),
(186, 5.86, 4.04),
(187, 6.14, 6.02),
(188, 3.59, 3.98),
(189, 4.9, 6.31),
(190, 4.77, 6.66),
(191, 4.04, 4.75),
(192, 3.43, 3.83),
(193, 3.02, 2.92),
(194, 2.88, 3.01),
(195, 2.76, 3.53),
(196, 4.42, 5.54),
(197, 4.66, 5.29),
(198, 4.92, 6.57),
(199, 4.2, 5.32),
(200, 4, 4.09),
(201, 3.7, 4.85),
(202, 4.24, 5.33),
(203, 3.72, 4.82),
(204, 6.34, 4.9),
(205, 7.93, 7.71),
(206, 8.09, 6.38),
(207, 8.08, 7.25),
(208, 8.69, 7.55),
(209, 9.39, 7.8),
(210, 9.16, 7.03),
(211, 10.05, 9.15),
(212, 10.6, 9.14),
(213, 10.61, 8.05),
(214, 9.26, 8.26),
(215, 9.52, 8.11),
(216, 9.76, 8.45),
(217, 9.39, 7.75),
(218, 9.33, 6.85),
(219, 10.39, 7.9),
(220, 10.06, 8.68),
(221, 11.43, 8.45),
(222, 12.55, 9.53),
(223, 14.07, 11.16),
(224, 13.97, 11.06),
(225, 13.29, 9.65),
(226, 8.79, 6.72),
(227, 10.03, 7.25),
(228, 9.74, 7.98),
(229, 10.52, 7.01),
(230, 11.11, 7.13),
(231, 12.52, 7.97),
(232, 12.16, 8.83),
(233, 12.83, 8.88),
(234, 12.73, 7.96),
(235, 13, 8.26),
(236, 12.45, 8.96),
(237, 12.84, 8.59),
(238, 3.77, 1.64),
(239, 4.38, 1.82),
(240, 4.32, 2.32),
(241, 4.64, 2.06),
(242, 4.81, 1.89),
(243, 4.53, 1.86),
(244, 5.04, 2.41),
(245, 5.67, 2.47),
(246, 5.56, 2.74),
(247, 6.99, 3.12),
(248, 5.98, 3.01),
(249, 8.46, 7.68),
(250, 8.39, 8.05),
(251, 7.68, 7.45),
(252, 8.09, 8.28),
(253, 7.58, 7.15),
(254, 7.9, 6.71),
(255, 7.86, 7.96),
(256, 7.31, 7.01),
(257, 7.06, 7.64),
(258, 7.4, 7.88),
(259, 8.05, 8.86),
(260, 6.96, 7.79),
(261, 4.86, 5.11),
(262, 4.24, 4.01),
(263, 4.35, 4.28),
(264, 4.21, 4.17),
(265, 4.49, 4.01),
(266, 3.92, 3.39),
(267, 4.72, 4.49),
(268, 4.62, 4.42),
(269, 5.1, 5.73),
(270, 4.21, 4.6),
(271, 4.79, 4.49),
(272, 5.19, 5.3),
(273, 5.45, 4.61),
(274, 5.99, 4.88),
(275, 6.05, 5.77),
(276, 7.39, 6.76),
(277, 8.14, 6.4),
(278, 8.57, 7.23),
(279, 8.53, 7.33),
(280, 7.99, 7.03),
(281, 7.19, 6.5),
(282, 3.78, 2.09),
(283, 4.05, 2.95),
(284, 4.74, 2.54),
(285, 4.91, 3.14),
(286, 5.02, 2.62),
(287, 4.74, 2.87),
(288, 5.15, 2.81),
(289, 5.49, 3.09),
(290, 6.05, 3.33),
(291, 6.2, 3.53),
(292, 6.81, 3.93),
(293, 4.82, 4.84),
(294, 4.37, 4.84),
(295, 3.8, 4.34),
(296, 4.35, 3.82),
(297, 4.55, 4.34),
(298, 4.45, 3.84),
(299, 4.36, 3.81),
(300, 6.15, 5.66),
(301, 5.28, 5.21),
(302, 6.15, 6.2),
(303, 5.7, 6.66),
(304, 5.12, 5.66),
(305, 2.5, 3.45),
(306, 2.66, 3.83),
(307, 2.53, 3.49),
(308, 2.54, 2.93),
(309, 3.05, 3.97),
(310, 2.91, 2.28),
(311, 3.48, 4.3),
(312, 3.43, 3.93),
(313, 2.82, 3.95),
(314, 3.05, 3.29),
(315, 3.02, 3.09),
(316, 1.64, 2.22),
(317, 1.66, 2.78),
(318, 1.39, 1.84),
(319, 1.54, 2.26),
(320, 1.84, 2.46),
(321, 1.71, 2.36),
(322, 1.72, 2.78),
(323, 1.69, 2.61),
(324, 1.78, 2.27),
(325, 6.81, 6.34),
(326, 6.23, 5.58),
(327, 6.71, 4.87),
(331, 3.42, 2.36),
(332, 4.18, 4.15),
(333, 12.2, 16.58),
(334, 5.64, 4.75),
(335, 8.63, 8.35),
(336, 6.7, 4.49),
(337, 8.33, 12),
(338, 8.86, 9.75),
(339, 8.18, 2.9),
(340, 9.39, 6.46),
(341, 3.93, 4.93),
(342, 8.27, 4.4),
(343, 6.95, 5.46),
(344, 3.56, 3.48),
(345, 11.17, 9.16),
(346, 5.52, 2.22),
(347, 4.8, 5.08),
(348, 7.37, 6.58),
(349, 6.31, 3.05),
(350, 1.92, 3.3),
(351, 6.21, 6.15),
(352, 6.91, 4.93),
(353, 7.54, 3.29),
(354, 6.95, 5.01),
(355, 8.43, 5.3),
(357, 10.73, 11.32),
(358, 11.03, 12.39),
(359, 4.11, 3.32),
(360, 9.25, 5.15),
(361, 3.97, 4.87),
(362, 6.61, 5.29),
(363, 4.11, 4.88),
(364, 3.37, 2.16),
(365, 3.91, 3.84),
(366, 4.94, 3.81),
(367, 10.81, 9.61),
(368, 5.53, 2.51),
(369, 6.64, 4.18),
(370, 5.84, 5.48),
(371, 12.67, 10.48),
(372, 13.57, 10.83),
(373, 8.25, 8.56),
(374, 4.44, 3.89),
(375, 6.03, 5.71),
(376, 7.5, 6.75),
(377, 6.91, 2.96),
(378, 5.74, 6.21),
(379, 4.61, 5.02),
(380, 8.83, 11.99),
(381, 7.97, 11.09),
(382, 12.31, 17.48),
(383, 9.25, 11.22),
(384, 9.91, 8.73),
(385, 3.88, 3.46),
(386, 3.01, 3.31),
(387, 1.67, 3.12),
(388, 6.34, 5.53),
(389, 9.6, 6.11),
(391, 4.25, 4.52),
(392, 3.15, 2.29),
(393, 5.66, 4.29),
(394, 8.88, 7.45),
(395, 8.82, 5.7),
(396, 7.4, 6.77),
(397, 10.14, 11.74),
(398, 7.26, 6.61),
(399, 6.04, 4.17),
(400, 5.83, 3.63),
(401, 7.86, 5.53),
(403, 8.5, 4.74),
(404, 4.7, 3.43),
(405, 3.68, 5.42),
(406, 3.3, 2.71),
(407, 3.79, 2.64),
(408, 13.03, 8.75),
(409, 12.74, 8.3),
(410, 4.69, 2),
(411, 5.63, 4.24),
(412, 8.37, 7.42),
(413, 7.21, 6.36),
(414, 9.62, 12.12),
(415, 2.78, 3.79),
(416, 3.17, 3.65),
(417, 5.95, 4.59),
(418, 8.68, 4.34),
(419, 3.94, 3.42),
(420, 2.57, 2.94),
(421, 8.2, 12.13),
(422, 7.84, 10.44),
(423, 4.75, 5.49),
(424, 4.5, 3.22),
(425, 4.68, 4.89),
(426, 4.5, 3.4),
(427, 6.1, 3.95),
(428, 3.7, 5.12),
(429, 5.85, 2.9),
(430, 5.21, 4.25),
(431, 2.55, 2.9);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yayin`
--

DROP TABLE IF EXISTS `yayin`;
CREATE TABLE IF NOT EXISTS `yayin` (
  `dizi_id` int(11) NOT NULL,
  `reyting_id` int(11) NOT NULL,
  `tarih` date NOT NULL,
  `bolum` int(11) NOT NULL,
  KEY `reyting_id` (`reyting_id`),
  KEY `dizi_id` (`dizi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `yayin`
--

INSERT INTO `yayin` (`dizi_id`, `reyting_id`, `tarih`, `bolum`) VALUES
(1, 1, '2020-11-05', 1),
(1, 2, '2020-11-12', 2),
(1, 3, '2020-11-19', 3),
(1, 4, '2020-11-26', 4),
(1, 5, '2020-12-03', 5),
(2, 6, '2020-01-14', 1),
(2, 7, '2020-01-21', 2),
(2, 8, '2020-01-28', 3),
(2, 9, '2020-02-04', 4),
(2, 10, '2020-02-11', 5),
(2, 11, '2020-02-18', 6),
(2, 12, '2020-02-25', 7),
(2, 13, '2020-03-03', 8),
(2, 14, '2020-03-10', 9),
(2, 15, '2020-03-17', 10),
(2, 16, '2020-03-24', 11),
(2, 17, '2020-09-18', 12),
(2, 18, '2020-09-25', 13),
(2, 19, '2020-10-02', 14),
(2, 20, '2020-10-09', 15),
(2, 21, '2020-10-16', 16),
(2, 22, '2020-10-23', 17),
(2, 23, '2020-10-30', 18),
(2, 24, '2020-11-06', 19),
(2, 25, '2020-11-13', 20),
(2, 26, '2020-11-20', 21),
(2, 27, '2020-11-27', 22),
(2, 28, '2020-12-04', 23),
(2, 29, '2020-12-11', 24),
(13, 35, '2020-11-26', 1),
(13, 36, '2020-12-03', 2),
(13, 37, '2020-12-10', 3),
(8, 38, '2020-10-07', 1),
(8, 39, '2020-10-14', 2),
(8, 40, '2020-10-21', 3),
(8, 41, '2020-10-28', 4),
(8, 42, '2020-11-04', 5),
(8, 43, '2020-11-11', 6),
(8, 44, '2020-11-18', 7),
(8, 45, '2020-11-25', 8),
(8, 46, '2020-12-09', 9),
(8, 47, '2020-12-16', 10),
(14, 48, '2020-12-11', 1),
(27, 49, '2020-09-15', 1),
(27, 50, '2020-09-22', 2),
(27, 51, '2020-09-29', 3),
(27, 52, '2020-10-06', 4),
(27, 53, '2020-10-13', 5),
(27, 54, '2020-10-20', 6),
(27, 55, '2020-10-27', 7),
(27, 56, '2020-11-03', 8),
(27, 57, '2020-11-10', 9),
(27, 58, '2020-11-17', 10),
(27, 59, '2020-11-24', 11),
(27, 60, '2020-12-01', 12),
(27, 61, '2020-12-08', 13),
(27, 62, '2020-12-15', 14),
(20, 63, '2020-11-22', 1),
(20, 64, '2020-11-29', 2),
(20, 65, '2020-12-06', 3),
(20, 66, '2020-12-13', 4),
(29, 67, '2020-10-17', 1),
(29, 68, '2020-10-24', 2),
(29, 69, '2020-11-07', 3),
(29, 70, '2020-11-14', 4),
(29, 71, '2020-11-21', 5),
(29, 72, '2020-11-28', 6),
(29, 73, '2020-12-05', 7),
(29, 74, '2020-12-12', 8),
(4, 75, '2020-09-13', 1),
(4, 76, '2020-09-20', 2),
(4, 77, '2020-09-27', 3),
(4, 78, '2020-10-04', 4),
(4, 79, '2020-10-11', 5),
(4, 80, '2020-10-18', 6),
(4, 81, '2020-10-25', 7),
(4, 82, '2020-11-01', 8),
(4, 83, '2020-11-08', 9),
(4, 84, '2020-11-15', 10),
(4, 85, '2020-11-22', 11),
(4, 86, '2020-11-29', 12),
(4, 87, '2020-12-06', 13),
(4, 88, '2020-12-13', 14),
(26, 89, '2020-09-04', 1),
(26, 90, '2020-09-11', 2),
(26, 91, '2020-09-18', 3),
(26, 92, '2020-09-25', 4),
(26, 93, '2020-10-02', 5),
(26, 94, '2020-10-09', 6),
(26, 95, '2020-10-16', 7),
(26, 96, '2020-10-23', 8),
(26, 97, '2020-10-30', 9),
(26, 98, '2020-11-06', 10),
(26, 99, '2020-11-13', 11),
(26, 100, '2020-11-20', 12),
(26, 101, '2020-11-27', 13),
(26, 102, '2020-12-04', 14),
(26, 103, '2020-12-11', 15),
(28, 104, '2020-09-28', 1),
(28, 105, '2020-10-05', 2),
(28, 106, '2020-10-12', 3),
(28, 107, '2020-10-19', 4),
(28, 108, '2020-10-26', 5),
(28, 109, '2020-11-02', 6),
(28, 110, '2020-11-09', 7),
(28, 111, '2020-11-16', 8),
(28, 112, '2020-11-23', 9),
(28, 113, '2020-11-30', 10),
(28, 114, '2020-12-07', 11),
(28, 115, '2020-12-14', 12),
(3, 116, '2020-09-05', 30),
(3, 117, '2020-09-12', 31),
(3, 118, '2020-09-19', 32),
(3, 119, '2020-09-26', 33),
(3, 120, '2020-10-03', 34),
(3, 121, '2020-10-10', 35),
(3, 122, '2020-10-17', 36),
(3, 123, '2020-10-24', 37),
(3, 124, '2020-11-07', 38),
(3, 125, '2020-11-14', 39),
(3, 126, '2020-11-21', 40),
(3, 127, '2020-11-28', 41),
(3, 128, '2020-12-05', 42),
(3, 129, '2020-12-12', 43),
(5, 130, '2020-09-07', 93),
(5, 131, '2020-09-14', 94),
(5, 132, '2020-09-21', 95),
(5, 133, '2020-09-28', 96),
(5, 134, '2020-10-05', 97),
(5, 135, '2020-10-12', 98),
(5, 136, '2020-10-19', 99),
(5, 137, '2020-10-26', 100),
(5, 138, '2020-11-02', 101),
(5, 139, '2020-11-09', 102),
(5, 140, '2020-11-16', 103),
(5, 141, '2020-11-23', 104),
(5, 142, '2020-11-30', 105),
(5, 143, '2020-12-07', 106),
(5, 144, '2020-12-14', 107),
(9, 145, '2020-09-01', 15),
(9, 146, '2020-09-08', 16),
(9, 147, '2020-09-15', 17),
(9, 148, '2020-09-22', 18),
(9, 149, '2020-09-29', 19),
(9, 150, '2020-10-06', 20),
(9, 151, '2020-10-13', 21),
(9, 152, '2020-10-20', 22),
(9, 153, '2020-10-27', 23),
(9, 154, '2020-11-03', 24),
(9, 155, '2020-11-17', 25),
(9, 156, '2020-11-24', 26),
(9, 157, '2020-12-01', 27),
(9, 158, '2020-12-08', 28),
(9, 159, '2020-12-15', 29),
(10, 160, '2020-09-18', 557),
(10, 161, '2020-09-25', 558),
(10, 162, '2020-10-02', 559),
(10, 163, '2020-10-09', 560),
(10, 164, '2020-10-16', 561),
(10, 165, '2020-10-23', 562),
(10, 166, '2020-10-30', 563),
(10, 167, '2020-11-06', 564),
(10, 168, '2020-11-13', 565),
(10, 169, '2020-11-20', 566),
(10, 170, '2020-11-27', 567),
(10, 171, '2020-12-04', 568),
(10, 172, '2020-12-11', 569),
(11, 173, '2020-09-07', 18),
(11, 174, '2020-09-14', 19),
(11, 175, '2020-09-21', 20),
(11, 176, '2020-09-28', 21),
(11, 177, '2020-10-05', 22),
(11, 178, '2020-10-12', 23),
(11, 179, '2020-10-19', 24),
(11, 180, '2020-10-26', 25),
(11, 181, '2020-11-02', 26),
(11, 182, '2020-11-09', 27),
(11, 183, '2020-11-16', 28),
(11, 184, '2020-11-23', 29),
(11, 185, '2020-11-30', 30),
(11, 186, '2020-12-07', 31),
(11, 187, '2020-12-14', 32),
(12, 188, '2020-08-25', 1),
(12, 189, '2020-09-01', 2),
(12, 190, '2020-09-08', 3),
(12, 191, '2020-09-15', 4),
(12, 192, '2020-09-22', 5),
(12, 193, '2020-09-29', 6),
(12, 194, '2020-10-06', 7),
(12, 195, '2020-10-13', 8),
(12, 196, '2020-10-18', 9),
(12, 197, '2020-10-25', 10),
(12, 198, '2020-11-01', 11),
(12, 199, '2020-11-08', 12),
(12, 200, '2020-11-22', 13),
(12, 201, '2020-11-29', 14),
(12, 202, '2020-12-06', 15),
(12, 203, '2020-12-13', 16),
(15, 204, '2020-10-06', 166),
(15, 205, '2020-10-13', 167),
(15, 206, '2020-10-20', 168),
(15, 207, '2020-10-27', 169),
(15, 208, '2020-11-03', 170),
(15, 209, '2020-11-10', 171),
(15, 210, '2020-11-17', 172),
(15, 211, '2020-11-24', 173),
(15, 212, '2020-12-01', 174),
(15, 213, '2020-12-08', 175),
(15, 214, '2020-12-15', 176),
(16, 215, '2020-10-07', 28),
(16, 216, '2020-10-14', 29),
(16, 217, '2020-10-21', 30),
(16, 218, '2020-10-28', 31),
(16, 219, '2020-11-04', 32),
(16, 220, '2020-11-11', 33),
(16, 221, '2020-11-18', 34),
(16, 222, '2020-11-25', 35),
(16, 223, '2020-12-02', 36),
(16, 224, '2020-12-09', 37),
(16, 225, '2020-12-16', 38),
(17, 226, '2020-10-01', 66),
(17, 227, '2020-10-08', 67),
(17, 228, '2020-12-15', 68),
(17, 229, '2020-10-22', 69),
(17, 230, '2020-10-29', 70),
(17, 231, '2020-11-05', 71),
(17, 232, '2020-11-12', 72),
(17, 233, '2020-11-19', 73),
(17, 234, '2020-11-26', 74),
(17, 235, '2020-12-03', 75),
(17, 236, '2020-12-10', 76),
(17, 237, '2020-12-17', 77),
(18, 238, '2020-10-02', 41),
(18, 239, '2020-10-09', 42),
(18, 240, '2020-10-16', 43),
(18, 241, '2020-10-23', 44),
(18, 242, '2020-10-30', 45),
(18, 243, '2020-11-06', 46),
(18, 244, '2020-11-13', 47),
(18, 245, '2020-11-20', 48),
(18, 246, '2020-11-27', 49),
(18, 247, '2020-12-04', 50),
(18, 248, '2020-12-11', 51),
(21, 249, '2020-10-01', 31),
(21, 250, '2020-10-08', 32),
(21, 251, '2020-10-15', 33),
(21, 252, '2020-10-22', 34),
(21, 253, '2020-10-29', 35),
(21, 254, '2020-11-05', 36),
(21, 255, '2020-11-12', 37),
(21, 256, '2020-11-19', 38),
(21, 257, '2020-11-26', 39),
(21, 258, '2020-12-03', 40),
(21, 259, '2020-12-10', 41),
(21, 260, '2020-12-17', 42),
(22, 261, '2020-10-07', 13),
(22, 262, '2020-10-14', 14),
(22, 263, '2020-10-21', 15),
(22, 264, '2020-10-28', 16),
(22, 265, '2020-11-04', 17),
(22, 266, '2020-11-11', 18),
(22, 267, '2020-11-21', 19),
(22, 268, '2020-11-28', 20),
(22, 269, '2020-12-05', 21),
(22, 270, '2020-12-12', 22),
(23, 271, '2020-10-05', 79),
(23, 272, '2020-10-12', 80),
(23, 273, '2020-10-19', 81),
(23, 274, '2020-10-26', 82),
(23, 275, '2020-11-02', 83),
(23, 276, '2020-11-09', 84),
(23, 277, '2020-11-16', 85),
(23, 278, '2020-11-23', 86),
(23, 279, '2020-11-30', 87),
(23, 280, '2020-12-07', 88),
(23, 281, '2020-12-14', 89),
(24, 282, '2020-10-06', 8),
(24, 283, '2020-10-13', 9),
(24, 284, '2020-10-20', 10),
(24, 285, '2020-10-27', 11),
(24, 286, '2020-11-03', 12),
(24, 287, '2020-11-10', 13),
(24, 288, '2020-11-17', 14),
(24, 289, '2020-11-24', 15),
(24, 290, '2020-12-01', 16),
(24, 291, '2020-12-08', 17),
(24, 292, '2020-12-15', 18),
(25, 293, '2020-09-30', 13),
(25, 294, '2020-10-07', 14),
(25, 295, '2020-10-14', 15),
(25, 296, '2020-10-21', 16),
(25, 297, '2020-10-28', 17),
(25, 298, '2020-11-04', 18),
(25, 299, '2020-11-11', 19),
(25, 300, '2020-11-18', 20),
(25, 301, '2020-11-25', 21),
(25, 302, '2020-12-02', 22),
(25, 303, '2020-12-09', 23),
(25, 304, '2020-12-16', 24),
(30, 305, '2020-10-09', 120),
(30, 306, '2020-10-16', 121),
(30, 307, '2020-10-23', 122),
(30, 308, '2020-10-30', 123),
(30, 309, '2020-11-06', 124),
(30, 310, '2020-11-13', 125),
(30, 311, '2020-11-20', 126),
(30, 312, '2020-11-27', 127),
(30, 313, '2020-12-04', 128),
(30, 314, '2020-12-11', 129),
(30, 315, '2020-12-18', 130),
(31, 316, '2020-10-04', 9),
(31, 317, '2020-10-18', 10),
(31, 318, '2020-10-25', 11),
(31, 319, '2020-11-08', 12),
(31, 320, '2020-11-15', 13),
(31, 321, '2020-11-22', 14),
(31, 322, '2020-11-29', 15),
(31, 323, '2020-12-06', 16),
(31, 324, '2020-12-13', 17),
(1, 325, '2020-12-10', 6),
(1, 326, '2020-12-17', 7),
(2, 327, '2020-12-18', 25),
(13, 331, '2020-12-17', 4),
(14, 332, '2020-12-18', 2),
(27, 333, '2020-12-22', 15),
(20, 334, '2020-12-20', 5),
(29, 335, '2020-12-19', 9),
(4, 336, '2020-12-20', 15),
(26, 337, '2020-12-18', 16),
(28, 338, '2020-12-21', 13),
(3, 339, '2020-12-19', 44),
(5, 340, '2020-12-21', 108),
(9, 341, '2020-12-22', 30),
(10, 342, '2020-12-18', 570),
(11, 343, '2020-12-21', 33),
(12, 344, '2020-12-20', 17),
(15, 345, '2020-12-22', 177),
(18, 346, '2020-12-18', 52),
(22, 347, '2020-12-19', 23),
(23, 348, '2020-12-21', 90),
(24, 349, '2020-12-22', 19),
(31, 350, '2020-12-20', 18),
(1, 351, '2020-12-24', 8),
(2, 352, '2020-12-25', 26),
(3, 353, '2020-12-26', 45),
(4, 354, '2020-12-27', 16),
(5, 355, '2020-12-28', 109),
(8, 357, '2020-12-23', 11),
(8, 358, '2020-12-30', 12),
(9, 359, '2020-12-29', 31),
(10, 360, '2020-12-25', 571),
(32, 361, '2021-01-01', 1),
(11, 362, '2020-12-28', 34),
(12, 363, '2020-12-27', 18),
(13, 364, '2020-12-24', 5),
(14, 365, '2020-12-25', 3),
(14, 366, '2021-01-01', 4),
(15, 367, '2020-12-29', 178),
(18, 368, '2020-12-25', 53),
(19, 369, '2021-01-01', 1),
(20, 370, '2020-12-27', 6),
(16, 371, '2020-12-23', 39),
(16, 372, '2020-12-30', 40),
(21, 373, '2020-12-24', 43),
(22, 374, '2020-12-26', 24),
(22, 375, '2021-01-02', 25),
(23, 376, '2020-12-28', 91),
(24, 377, '2020-12-29', 20),
(25, 378, '2020-12-23', 25),
(25, 379, '2020-12-30', 26),
(26, 380, '2020-12-25', 17),
(26, 381, '2021-01-01', 18),
(27, 382, '2020-12-29', 16),
(28, 383, '2020-12-28', 14),
(29, 384, '2020-12-26', 10),
(30, 385, '2020-12-25', 131),
(30, 386, '2021-01-01', 132),
(31, 387, '2020-12-27', 19),
(1, 388, '2021-01-07', 9),
(5, 389, '2021-01-04', 110),
(12, 391, '2021-01-03', 19),
(13, 392, '2021-01-07', 6),
(20, 393, '2021-01-03', 7),
(23, 394, '2021-01-04', 92),
(24, 395, '2021-01-05', 21),
(21, 396, '2021-01-07', 44),
(28, 397, '2021-01-04', 15),
(1, 398, '2021-01-14', 10),
(2, 399, '2021-01-08', 27),
(4, 400, '2021-01-10', 17),
(5, 401, '2021-01-11', 111),
(10, 403, '2021-01-08', 571),
(11, 404, '2021-01-14', 35),
(12, 405, '2021-01-10', 20),
(13, 406, '2021-01-14', 7),
(14, 407, '2021-01-08', 5),
(17, 408, '2020-12-24', 78),
(17, 409, '2021-01-07', 79),
(18, 410, '2021-01-10', 54),
(20, 411, '2021-01-10', 8),
(21, 412, '2021-01-14', 45),
(23, 413, '2021-01-11', 93),
(28, 414, '2021-01-11', 16),
(31, 415, '2021-01-10', 21),
(30, 416, '2021-01-08', 133),
(2, 417, '2021-01-15', 28),
(10, 418, '2021-01-15', 572),
(14, 419, '2021-01-15', 6),
(30, 420, '2021-01-15', 134),
(26, 421, '2021-01-08', 19),
(26, 422, '2021-01-15', 20),
(32, 423, '2021-01-08', 2),
(19, 424, '2021-01-08', 2),
(32, 425, '2021-01-15', 3),
(19, 426, '2021-01-15', 3),
(4, 427, '2021-01-17', 18),
(12, 428, '2021-01-17', 21),
(18, 429, '2021-01-17', 55),
(20, 430, '2021-01-17', 9),
(31, 431, '2021-01-17', 22);

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `diziler`
--
ALTER TABLE `diziler`
  ADD CONSTRAINT `kanal_kisiti` FOREIGN KEY (`kanal_id`) REFERENCES `kanallar` (`kanal_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `dizi_gun`
--
ALTER TABLE `dizi_gun`
  ADD CONSTRAINT `d_kisiti` FOREIGN KEY (`dizi_id`) REFERENCES `diziler` (`dizi_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `g_kisiti` FOREIGN KEY (`gun_id`) REFERENCES `gunler` (`gun_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `reytingler`
--
ALTER TABLE `reytingler`
  ADD CONSTRAINT `reyting_kisiti` FOREIGN KEY (`reyting_id`) REFERENCES `yayin` (`reyting_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `yayin`
--
ALTER TABLE `yayin`
  ADD CONSTRAINT `dizi_kisiti` FOREIGN KEY (`dizi_id`) REFERENCES `diziler` (`dizi_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
