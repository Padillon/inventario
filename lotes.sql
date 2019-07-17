-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2019 at 08:35 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `inventario`
--

-- --------------------------------------------------------

--
-- Table structure for table `lotes`
--

CREATE TABLE IF NOT EXISTS `lotes` (
  `id_lote` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha_entrada` date NOT NULL,
  `fecha_caducidad` date NOT NULL,
  PRIMARY KEY (`id_lote`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf32 COLLATE=utf32_spanish2_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `lotes`
--

INSERT INTO `lotes` (`id_lote`, `id_producto`, `cantidad`, `fecha_entrada`, `fecha_caducidad`) VALUES
(1, 65, 1, '2019-07-17', '2019-08-25'),
(2, 3, 6, '2019-07-15', '2019-07-30'),
(3, 3, 6, '2019-07-15', '2019-07-30'),
(4, 65, 3, '2019-07-15', '2019-07-16'),
(5, 65, 3, '2019-07-15', '2019-07-16'),
(6, 3, 1, '2019-07-15', '2019-07-16'),
(7, 3, 1, '2019-07-15', '2019-07-16'),
(8, 12, 1, '2019-07-15', '2019-07-17'),
(9, 12, 1, '2019-07-15', '2019-07-17'),
(10, 65, 1, '2019-07-15', '2019-07-16'),
(11, 65, 1, '2019-07-15', '2019-07-16'),
(12, 3, 1, '2019-07-15', '0000-00-00'),
(13, 65, 0, '2019-07-15', '2019-07-15');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
