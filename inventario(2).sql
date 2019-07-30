-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-07-2019 a las 06:29:59
-- Versión del servidor: 5.6.16
-- Versión de PHP: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `inventario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ajustes`
--

CREATE TABLE IF NOT EXISTS `ajustes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `registro` varchar(10) NOT NULL,
  `giro` varchar(100) NOT NULL,
  `logo` varchar(150) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `correo` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `ajustes`
--

INSERT INTO `ajustes` (`id`, `nombre`, `direccion`, `registro`, `giro`, `logo`, `telefono`, `correo`) VALUES
(1, 'Bazar Zulma', 'San Miguel', '138513-0', 'venta de ropa', 'photo4906976604010424386.jpg', '6109-9440', 'holak@hace.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `estado` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre`, `estado`) VALUES
(1, 'Calzoncillo de hombreeee', 1),
(2, 'Blusas', 1),
(3, 'Faldas', 1),
(4, 'Bloomer', 1),
(5, 'Camison', 1),
(6, 'Capri', 1),
(7, 'Tangas', 1),
(8, 'Cacheteros', 1),
(9, 'Brasier', 1),
(10, 'Short', 1),
(11, 'Camisas', 1),
(12, 'Calcetines', 1),
(13, 'Calcetas', 1),
(14, 'Pantalones', 1),
(15, 'Toalla', 1),
(16, 'Camiseta', 1),
(17, 'Centro', 1),
(18, 'Mantel', 1),
(19, 'Vestidos', 1),
(20, 'kkkkk}}{}++', 0),
(21, 'ddddddddddddddd', 0),
(22, 'Alimento', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  `nit` varchar(25) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `registro` varchar(50) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `estado` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre`, `apellido`, `nit`, `telefono`, `registro`, `direccion`, `estado`) VALUES
(1, 'varios', '', '', '', '', '', 1),
(2, '', '', '', '', '', '', 0),
(3, '', '', '', '', '', '', 0),
(4, '', '', '', '', '', '', 0),
(5, 'Abigail', 'Mejia', '', '', '', 'San Antonio Silva', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_entrada`
--

CREATE TABLE IF NOT EXISTS `detalle_entrada` (
  `id_detalle_entrada` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `precio` double NOT NULL,
  `iva` double NOT NULL,
  `subtotal` double NOT NULL,
  `id_entrada` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_detalle_entrada`),
  KEY `id_producto` (`id_producto`),
  KEY `id_entrada` (`id_entrada`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=125 ;

--
-- Volcado de datos para la tabla `detalle_entrada`
--

INSERT INTO `detalle_entrada` (`id_detalle_entrada`, `cantidad`, `id_producto`, `precio`, `iva`, `subtotal`, `id_entrada`, `estado`) VALUES
(1, 12, 1, 1.42, 0, 17.04, 1, 1),
(2, 36, 2, 1.91, 0, 68.76, 2, 1),
(3, 12, 6, 2.5, 0, 30, 2, 1),
(4, 12, 7, 2, 0, 24, 2, 1),
(5, 12, 8, 1.66, 0, 19.92, 2, 1),
(6, 12, 9, 1.66, 0, 19.92, 2, 1),
(7, 36, 2, 1.91, 0, 68.76, 3, 1),
(8, 12, 6, 2.5, 0, 30, 3, 1),
(9, 12, 8, 1.66, 0, 19.92, 3, 1),
(10, 12, 9, 1.66, 0, 19.92, 3, 1),
(11, 36, 4, 0.75, 0, 27, 4, 1),
(12, 36, 3, 1, 0, 36, 4, 1),
(13, 36, 5, 0.75, 0, 27, 4, 1),
(14, 12, 10, 0.58, 0, 6.96, 5, 1),
(15, 12, 11, 0.66, 0, 7.92, 5, 1),
(16, 12, 12, 0.83, 0, 9.96, 5, 1),
(17, 12, 13, 0.83, 0, 9.96, 5, 1),
(18, 12, 14, 0.83, 0, 9.96, 5, 1),
(19, 10, 15, 0.83, 0, 8.3, 5, 1),
(20, 12, 10, 0.58, 0, 6.96, 6, 1),
(21, 12, 11, 0.66, 0, 7.92, 6, 1),
(22, 12, 12, 0.83, 0, 9.96, 6, 1),
(23, 12, 13, 0.83, 0, 9.96, 7, 1),
(24, 12, 14, 0.83, 0, 9.96, 7, 1),
(25, 12, 15, 0.83, 0, 9.96, 7, 1),
(26, 24, 16, 0.42, 0, 10.08, 7, 1),
(27, 24, 17, 0.42, 0, 10.08, 8, 1),
(28, 24, 18, 0.42, 0, 10.08, 8, 1),
(29, 24, 19, 0.41, 0, 9.84, 8, 1),
(30, 24, 20, 0.41, 0, 9.84, 8, 1),
(31, 24, 21, 0.41, 0, 9.84, 8, 1),
(32, 24, 22, 0.41, 0, 9.84, 8, 1),
(33, 24, 17, 0.42, 0, 10.08, 9, 1),
(34, 24, 18, 0.42, 0, 10.08, 9, 1),
(35, 24, 19, 0.41, 0, 9.84, 9, 1),
(36, 24, 20, 0.41, 0, 9.84, 9, 1),
(37, 24, 21, 0.41, 0, 9.84, 9, 1),
(38, 24, 22, 0.41, 0, 9.84, 10, 1),
(39, 24, 23, 0.41, 0, 9.84, 10, 1),
(40, 24, 24, 0.41, 0, 9.84, 10, 1),
(41, 24, 25, 0.41, 0, 9.84, 10, 1),
(42, 24, 26, 0.41, 0, 9.84, 10, 1),
(43, 24, 27, 0.41, 0, 9.84, 10, 1),
(44, 24, 22, 0.41, 0, 9.84, 11, 1),
(45, 24, 23, 0.41, 0, 9.84, 11, 1),
(46, 24, 24, 0.41, 0, 9.84, 11, 1),
(47, 24, 25, 0.41, 0, 9.84, 11, 1),
(48, 24, 26, 0.41, 0, 9.84, 11, 1),
(49, 24, 27, 0.41, 0, 9.84, 12, 1),
(50, 36, 28, 0.83, 0, 29.88, 12, 1),
(51, 12, 29, 0.83, 0, 9.96, 12, 1),
(52, 24, 30, 0.66, 0, 15.84, 12, 1),
(53, 24, 31, 0.83, 0, 19.92, 12, 1),
(54, 12, 32, 0.83, 0, 9.96, 13, 1),
(55, 12, 33, 0.58, 0, 6.96, 13, 1),
(56, 84, 34, 1.75, 0, 147, 14, 1),
(57, 6, 34, 1.75, 0, 10.5, 14, 1),
(58, 6, 35, 1.75, 0, 10.5, 14, 1),
(59, 36, 36, 1.5, 0, 54, 14, 1),
(60, 6, 36, 1.5, 0, 9, 14, 1),
(61, 24, 37, 1.75, 0, 42, 15, 1),
(62, 24, 38, 2.5, 0, 60, 15, 1),
(63, 9, 34, 1.75, 0, 15.75, 15, 1),
(64, 6, 34, 1.75, 0, 10.5, 15, 1),
(65, 12, 39, 0.83, 0, 9.96, 16, 1),
(66, 36, 40, 0.75, 0, 27, 16, 1),
(67, 36, 41, 0.66, 0, 23.76, 16, 1),
(68, 4, 42, 2.5, 0, 10, 16, 1),
(69, 1, 43, 2, 0, 2, 16, 1),
(70, 12, 39, 0.83, 0, 9.96, 17, 1),
(71, 36, 40, 0.75, 0, 27, 17, 1),
(72, 36, 41, 0.66, 0, 23.76, 17, 1),
(73, 4, 42, 2.5, 0, 10, 18, 1),
(74, 1, 43, 2, 0, 2, 19, 1),
(75, 12, 44, 0.83, 0, 9.96, 19, 1),
(76, 36, 45, 0.31, 0, 11.16, 19, 1),
(77, 48, 46, 0.43, 0, 20.64, 20, 1),
(78, 60, 47, 0.43, 0, 25.8, 20, 1),
(79, 12, 48, 0.75, 0, 9, 20, 1),
(80, 12, 49, 0.58, 0, 6.96, 20, 1),
(81, 4, 50, 2.75, 0, 11, 21, 1),
(82, 6, 39, 0.83, 0, 4.98, 22, 1),
(83, 3, 8, 1.66, 0, 4.98, 23, 1),
(84, 3, 7, 2, 0, 6, 23, 1),
(85, 6, 35, 1.75, 0, 10.5, 23, 1),
(86, 6, 6, 2.5, 0, 15, 23, 1),
(87, 4, 9, 1.66, 0, 6.64, 24, 1),
(88, 12, 37, 1.75, 0, 21, 24, 1),
(89, 12, 21, 0.41, 0, 4.92, 24, 1),
(90, 12, 39, 0.83, 0, 9.96, 24, 1),
(91, 12, 44, 0.83, 0, 9.96, 24, 1),
(92, 12, 8, 1.66, 0, 19.92, 25, 1),
(93, 12, 12, 0.83, 0, 9.96, 25, 1),
(94, 12, 19, 0.41, 0, 4.92, 25, 1),
(95, 12, 1, 1.42, 0, 17.04, 25, 1),
(96, 12, 37, 1.75, 0, 21, 25, 1),
(97, 12, 35, 1.75, 0, 21, 25, 1),
(98, 12, 36, 1.5, 0, 18, 25, 1),
(99, 33, 16, 0.42, 0, 13.86, 26, 1),
(100, 34, 1, 1.42, 0, 48.28, 26, 1),
(101, 1, 65, 0, 0, 0, 29, 1),
(102, 6, 3, 1, 0, 6, 30, 1),
(103, 7, 65, 5.25, 0, 36.75, 30, 1),
(104, 3, 65, 5.25, 0, 15.75, 31, 1),
(105, 3, 3, 1, 0, 3, 31, 1),
(106, 1, 3, 1, 0, 1, 34, 1),
(107, 1, 65, 5.25, 0, 5.25, 34, 1),
(108, 1, 12, 0.83, 0, 0.83, 35, 1),
(109, 1, 65, 5.25, 0, 5.25, 35, 1),
(110, 1, 3, 1, 0, 1, 37, 1),
(111, 1, 3, 1, 0, 1, 38, 1),
(112, 1, 65, 5.25, 0, 5.25, 38, 1),
(113, 1, 65, 5.25, 0, 5.25, 39, 1),
(114, 1, 3, 1, 0, 1, 40, 1),
(115, 1, 65, 5.25, 0, 5.25, 41, 1),
(116, 1, 3, 1, 0, 1, 41, 1),
(117, 1, 65, 5.25, 0, 5.25, 42, 1),
(118, 1, 3, 1, 0, 1, 42, 1),
(119, 1, 65, 5.25, 0, 5.25, 43, 1),
(120, 1, 1, 1.42, 0, 1.42, 43, 1),
(121, 1, 65, 5.25, 0, 5.25, 44, 1),
(122, 3, 65, 5.25, 0, 15.75, 45, 1),
(123, 1, 65, 5.25, 0, 5.25, 46, 1),
(124, 5, 65, 5.25, 0, 26.25, 47, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_salida`
--

CREATE TABLE IF NOT EXISTS `detalle_salida` (
  `id_detalle_salida` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `precio_venta` double NOT NULL,
  `iva` double NOT NULL,
  `subtotal` double NOT NULL,
  `id_salida` int(11) NOT NULL,
  `id_lote` int(11) NOT NULL,
  PRIMARY KEY (`id_detalle_salida`),
  KEY `id_producto` (`id_producto`),
  KEY `id_salida_2` (`id_salida`),
  KEY `id_salida_3` (`id_salida`),
  KEY `id_salida` (`id_salida`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Volcado de datos para la tabla `detalle_salida`
--

INSERT INTO `detalle_salida` (`id_detalle_salida`, `cantidad`, `id_producto`, `precio_venta`, `iva`, `subtotal`, `id_salida`, `id_lote`) VALUES
(1, 3, 6, 3, 0, 9, 1, 0),
(2, 6, 1, 1.66, 0, 9.96, 2, 0),
(3, 12, 1, 1.66, 0, 19.92, 3, 0),
(4, 1, 22, 0.66, 0, 0.66, 4, 0),
(5, 2, 13, 1.04, 0, 2.08, 4, 0),
(6, 1, 16, 0.66, 0, 0.66, 4, 0),
(7, 12, 28, 1.04, 0, 12.48, 4, 0),
(8, 12, 24, 0.66, 0, 7.92, 4, 0),
(9, 1, 65, 0, 0, 0, 5, 0),
(10, 1, 65, 0.04, 0, 0.04, 11, 2),
(11, 2, 65, 0, 0, 0, 12, 2),
(12, 1, 65, 0, 0, 0, 14, 3),
(13, 1, 65, 0, 0, 0, 15, 3),
(14, 1, 65, 0, 0, 0, 16, 3),
(15, 1, 65, 0, 0, 0, 17, 3),
(16, 1, 65, 0, 0, 0, 18, 3),
(17, 1, 65, 0, 0, 0, 19, 3),
(18, 0, 65, 0, 0, 0, 20, 3),
(19, 0, 65, 0, 0, 0, 21, 0),
(20, 0, 65, 0, 0, 0, 22, 0),
(21, 0, 35, 2, 0, 0, 23, 0),
(22, 0, 35, 2, 0, 0, 24, 0),
(23, 1, 35, 2, 0, 2, 25, 0),
(24, 10, 65, 0, 0, 0, 26, 0),
(25, 1, 35, 2, 0, 2, 26, 0),
(26, 10, 65, 0, 0, 0, 27, 0),
(27, 10, 65, 0, 0, 0, 28, 3),
(28, 1, 35, 2, 0, 2, 29, 0),
(29, 10, 65, 0, 0, 0, 30, 3),
(30, 10, 35, 2, 0, 20, 30, 0),
(31, 1, 65, 0, 0, 0, 31, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas`
--

CREATE TABLE IF NOT EXISTS `entradas` (
  `id_entrada` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_movimiento` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `total` double NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `estado` tinyint(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_entrada`),
  KEY `id_usuario` (`id_usuario`,`id_movimiento`,`id_proveedor`),
  KEY `id_tipo_entrada` (`id_movimiento`),
  KEY `id_proveedor` (`id_proveedor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Volcado de datos para la tabla `entradas`
--

INSERT INTO `entradas` (`id_entrada`, `id_usuario`, `id_movimiento`, `fecha`, `total`, `id_proveedor`, `estado`) VALUES
(1, 1, 1, '2019-06-07', 17.04, 2, 0),
(2, 1, 1, '2019-06-07', 162.6, 2, 1),
(3, 1, 1, '2019-06-07', 138.6, 2, 1),
(4, 1, 1, '2019-06-07', 90, 5, 1),
(5, 1, 1, '2019-06-07', 53.06, 5, 1),
(6, 1, 1, '2019-06-07', 24.84, 5, 1),
(7, 1, 1, '2019-06-07', 39.96, 5, 1),
(8, 1, 1, '2019-06-07', 59.52, 5, 1),
(9, 1, 1, '2019-06-07', 49.68, 5, 1),
(10, 1, 1, '2019-06-07', 59.04, 5, 1),
(11, 1, 1, '2019-06-07', 49.2, 5, 1),
(12, 1, 1, '2019-06-07', 85.44, 5, 1),
(13, 1, 1, '2019-06-07', 16.92, 5, 1),
(14, 1, 1, '2019-06-07', 231, 5, 1),
(15, 1, 1, '2019-06-08', 128.25, 5, 1),
(16, 1, 1, '2019-06-08', 72.72, 5, 1),
(17, 1, 1, '2019-06-08', 60.72, 5, 1),
(18, 1, 1, '2019-06-08', 10, 5, 1),
(19, 1, 1, '2019-06-08', 23.12, 5, 1),
(20, 1, 1, '2019-06-08', 62.4, 5, 1),
(21, 1, 1, '2019-06-08', 11, 5, 0),
(22, 1, 1, '2019-06-08', 4.98, 5, 0),
(23, 1, 0, '2019-06-28', 36.48, 5, 1),
(24, 1, 0, '2019-06-28', 52.48, 5, 1),
(25, 1, 0, '2019-06-28', 111.84, 5, 1),
(26, 1, 0, '2019-06-28', 62.14, 5, 1),
(27, 5, 0, '2019-07-11', 1350, 4, 1),
(28, 5, 0, '2019-07-17', 0, 26, 1),
(29, 5, 0, '2019-07-17', 0, 26, 1),
(30, 5, 0, '2019-07-15', 42.75, 26, 1),
(31, 5, 0, '2019-07-15', 18.75, 26, 1),
(32, 5, 0, '2019-07-15', 6.25, 26, 1),
(33, 5, 0, '2019-07-15', 6.25, 26, 1),
(34, 5, 0, '2019-07-15', 6.25, 26, 1),
(35, 5, 0, '2019-07-15', 6.08, 26, 1),
(36, 5, 0, '2019-07-15', 1, 26, 1),
(37, 5, 0, '2019-07-15', 1, 26, 1),
(38, 5, 0, '2019-07-15', 6.25, 26, 1),
(39, 5, 0, '2019-07-15', 5.25, 26, 1),
(40, 5, 0, '2019-07-15', 1, 26, 1),
(41, 5, 0, '2019-07-15', 6.25, 26, 0),
(42, 5, 0, '2019-07-15', 6.25, 26, 1),
(43, 5, 0, '2019-07-15', 6.67, 26, 0),
(44, 5, 0, '2019-07-18', 5.25, 26, 0),
(45, 5, 0, '2019-07-18', 15.75, 26, 0),
(46, 5, 0, '2019-07-18', 5.25, 26, 1),
(47, 5, 0, '2019-07-24', 26.25, 26, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kardex`
--

CREATE TABLE IF NOT EXISTS `kardex` (
  `id_kardex` int(11) NOT NULL AUTO_INCREMENT,
  `id_movimiento` int(2) NOT NULL,
  `fecha` date NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` float NOT NULL,
  `total` float NOT NULL,
  `saldo` float NOT NULL,
  `id_entrada` int(100) NOT NULL DEFAULT '0',
  `id_salida` int(100) NOT NULL DEFAULT '0',
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_kardex`),
  KEY `id_producto` (`id_producto`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_movimiento` (`id_movimiento`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=180 ;

--
-- Volcado de datos para la tabla `kardex`
--

INSERT INTO `kardex` (`id_kardex`, `id_movimiento`, `fecha`, `descripcion`, `id_producto`, `cantidad`, `precio`, `total`, `saldo`, `id_entrada`, `id_salida`, `id_usuario`) VALUES
(1, 1, '2019-06-07', 'Entrada de producto.', 1, 12, 1.42, 17.04, 17.04, 1, 0, 1),
(2, 1, '2019-06-07', 'Entrada de producto.', 2, 36, 1.91, 68.76, 68.76, 2, 0, 1),
(3, 1, '2019-06-07', 'Entrada de producto.', 6, 12, 2.5, 30, 30, 2, 0, 1),
(4, 1, '2019-06-07', 'Entrada de producto.', 7, 12, 2, 24, 24, 2, 0, 1),
(5, 1, '2019-06-07', 'Entrada de producto.', 8, 12, 1.66, 19.92, 19.92, 2, 0, 1),
(6, 1, '2019-06-07', 'Entrada de producto.', 9, 12, 1.66, 19.92, 19.92, 2, 0, 1),
(7, 1, '2019-06-07', 'Entrada de producto.', 2, 36, 1.91, 68.76, 137.52, 3, 0, 1),
(8, 1, '2019-06-07', 'Entrada de producto.', 6, 12, 2.5, 30, 60, 3, 0, 1),
(9, 1, '2019-06-07', 'Entrada de producto.', 8, 12, 1.66, 19.92, 39.84, 3, 0, 1),
(10, 1, '2019-06-07', 'Entrada de producto.', 9, 12, 1.66, 19.92, 39.84, 3, 0, 1),
(11, 1, '2019-06-07', 'Entrada de producto.', 4, 36, 0.75, 27, 27, 4, 0, 1),
(12, 1, '2019-06-07', 'Entrada de producto.', 3, 36, 1, 36, 36, 4, 0, 1),
(13, 1, '2019-06-07', 'Entrada de producto.', 5, 36, 0.75, 27, 27, 4, 0, 1),
(14, 2, '2019-06-07', 'Salida', 6, 3, 3, 9, 51, 0, 1, 1),
(15, 1, '2019-06-07', 'Entrada de producto.', 10, 12, 0.58, 6.96, 6.96, 5, 0, 1),
(16, 1, '2019-06-07', 'Entrada de producto.', 11, 12, 0.66, 7.92, 7.92, 5, 0, 1),
(17, 1, '2019-06-07', 'Entrada de producto.', 12, 12, 0.83, 9.96, 9.96, 5, 0, 1),
(18, 1, '2019-06-07', 'Entrada de producto.', 13, 12, 0.83, 9.96, 9.96, 5, 0, 1),
(19, 1, '2019-06-07', 'Entrada de producto.', 14, 12, 0.83, 9.96, 9.96, 5, 0, 1),
(20, 1, '2019-06-07', 'Entrada de producto.', 15, 10, 0.83, 8.3, 8.3, 5, 0, 1),
(21, 1, '2019-06-07', 'Entrada de producto.', 10, 12, 0.58, 6.96, 13.92, 6, 0, 1),
(22, 1, '2019-06-07', 'Entrada de producto.', 11, 12, 0.66, 7.92, 15.84, 6, 0, 1),
(23, 1, '2019-06-07', 'Entrada de producto.', 12, 12, 0.83, 9.96, 19.92, 6, 0, 1),
(24, 1, '2019-06-07', 'Entrada de producto.', 13, 12, 0.83, 9.96, 19.92, 7, 0, 1),
(25, 1, '2019-06-07', 'Entrada de producto.', 14, 12, 0.83, 9.96, 19.92, 7, 0, 1),
(26, 1, '2019-06-07', 'Entrada de producto.', 15, 12, 0.83, 9.96, 18.26, 7, 0, 1),
(27, 1, '2019-06-07', 'Entrada de producto.', 16, 24, 0.42, 10.08, 10.08, 7, 0, 1),
(28, 1, '2019-06-07', 'Entrada de producto.', 17, 24, 0.42, 10.08, 10.08, 8, 0, 1),
(29, 1, '2019-06-07', 'Entrada de producto.', 18, 24, 0.42, 10.08, 10.08, 8, 0, 1),
(30, 1, '2019-06-07', 'Entrada de producto.', 19, 24, 0.41, 9.84, 9.84, 8, 0, 1),
(31, 1, '2019-06-07', 'Entrada de producto.', 20, 24, 0.41, 9.84, 9.84, 8, 0, 1),
(32, 1, '2019-06-07', 'Entrada de producto.', 21, 24, 0.41, 9.84, 9.84, 8, 0, 1),
(33, 1, '2019-06-07', 'Entrada de producto.', 22, 24, 0.41, 9.84, 9.84, 8, 0, 1),
(34, 1, '2019-06-07', 'Entrada de producto.', 17, 24, 0.42, 10.08, 20.16, 9, 0, 1),
(35, 1, '2019-06-07', 'Entrada de producto.', 18, 24, 0.42, 10.08, 20.16, 9, 0, 1),
(36, 1, '2019-06-07', 'Entrada de producto.', 19, 24, 0.41, 9.84, 19.68, 9, 0, 1),
(37, 1, '2019-06-07', 'Entrada de producto.', 20, 24, 0.41, 9.84, 19.68, 9, 0, 1),
(38, 1, '2019-06-07', 'Entrada de producto.', 21, 24, 0.41, 9.84, 19.68, 9, 0, 1),
(39, 1, '2019-06-07', 'Entrada de producto.', 22, 24, 0.41, 9.84, 19.68, 10, 0, 1),
(40, 1, '2019-06-07', 'Entrada de producto.', 23, 24, 0.41, 9.84, 9.84, 10, 0, 1),
(41, 1, '2019-06-07', 'Entrada de producto.', 24, 24, 0.41, 9.84, 9.84, 10, 0, 1),
(42, 1, '2019-06-07', 'Entrada de producto.', 25, 24, 0.41, 9.84, 9.84, 10, 0, 1),
(43, 1, '2019-06-07', 'Entrada de producto.', 26, 24, 0.41, 9.84, 9.84, 10, 0, 1),
(44, 1, '2019-06-07', 'Entrada de producto.', 27, 24, 0.41, 9.84, 9.84, 10, 0, 1),
(45, 1, '2019-06-07', 'Entrada de producto.', 22, 24, 0.41, 9.84, 29.52, 11, 0, 1),
(46, 1, '2019-06-07', 'Entrada de producto.', 23, 24, 0.41, 9.84, 19.68, 11, 0, 1),
(47, 1, '2019-06-07', 'Entrada de producto.', 24, 24, 0.41, 9.84, 19.68, 11, 0, 1),
(48, 1, '2019-06-07', 'Entrada de producto.', 25, 24, 0.41, 9.84, 19.68, 11, 0, 1),
(49, 1, '2019-06-07', 'Entrada de producto.', 26, 24, 0.41, 9.84, 19.68, 11, 0, 1),
(50, 1, '2019-06-07', 'Entrada de producto.', 27, 24, 0.41, 9.84, 19.68, 12, 0, 1),
(51, 1, '2019-06-07', 'Entrada de producto.', 28, 36, 0.83, 29.88, 29.88, 12, 0, 1),
(52, 1, '2019-06-07', 'Entrada de producto.', 29, 12, 0.83, 9.96, 9.96, 12, 0, 1),
(53, 1, '2019-06-07', 'Entrada de producto.', 30, 24, 0.66, 15.84, 15.84, 12, 0, 1),
(54, 1, '2019-06-07', 'Entrada de producto.', 31, 24, 0.83, 19.92, 19.92, 12, 0, 1),
(55, 1, '2019-06-07', 'Entrada de producto.', 32, 12, 0.83, 9.96, 9.96, 13, 0, 1),
(56, 1, '2019-06-07', 'Entrada de producto.', 33, 12, 0.58, 6.96, 6.96, 13, 0, 1),
(57, 1, '2019-06-07', 'Entrada de producto.', 34, 84, 1.75, 147, 147, 14, 0, 1),
(58, 1, '2019-06-07', 'Entrada de producto.', 34, 6, 1.75, 10.5, 157.5, 14, 0, 1),
(59, 1, '2019-06-07', 'Entrada de producto.', 35, 6, 1.75, 10.5, 10.5, 14, 0, 1),
(60, 1, '2019-06-07', 'Entrada de producto.', 36, 36, 1.5, 54, 54, 14, 0, 1),
(61, 1, '2019-06-07', 'Entrada de producto.', 36, 6, 1.5, 9, 63, 14, 0, 1),
(62, 1, '2019-06-08', 'Entrada de producto.', 37, 24, 1.75, 42, 42, 15, 0, 1),
(63, 1, '2019-06-08', 'Entrada de producto.', 38, 24, 2.5, 60, 60, 15, 0, 1),
(64, 1, '2019-06-08', 'Entrada de producto.', 34, 9, 1.75, 15.75, 173.25, 15, 0, 1),
(65, 1, '2019-06-08', 'Entrada de producto.', 34, 6, 1.75, 10.5, 183.75, 15, 0, 1),
(66, 1, '2019-06-08', 'Entrada de producto.', 39, 12, 0.83, 9.96, 9.96, 16, 0, 1),
(67, 1, '2019-06-08', 'Entrada de producto.', 40, 36, 0.75, 27, 27, 16, 0, 1),
(68, 1, '2019-06-08', 'Entrada de producto.', 41, 36, 0.66, 23.76, 23.76, 16, 0, 1),
(69, 1, '2019-06-08', 'Entrada de producto.', 42, 4, 2.5, 10, 10, 16, 0, 1),
(70, 1, '2019-06-08', 'Entrada de producto.', 43, 1, 2, 2, 2, 16, 0, 1),
(71, 1, '2019-06-08', 'Entrada de producto.', 39, 12, 0.83, 9.96, 19.92, 17, 0, 1),
(72, 1, '2019-06-08', 'Entrada de producto.', 40, 36, 0.75, 27, 54, 17, 0, 1),
(73, 1, '2019-06-08', 'Entrada de producto.', 41, 36, 0.66, 23.76, 47.52, 17, 0, 1),
(74, 1, '2019-06-08', 'Entrada de producto.', 42, 4, 2.5, 10, 20, 18, 0, 1),
(75, 1, '2019-06-08', 'Entrada de producto.', 43, 1, 2, 2, 4, 19, 0, 1),
(76, 1, '2019-06-08', 'Entrada de producto.', 44, 12, 0.83, 9.96, 9.96, 19, 0, 1),
(77, 1, '2019-06-08', 'Entrada de producto.', 45, 36, 0.31, 11.16, 11.16, 19, 0, 1),
(78, 1, '2019-06-08', 'Entrada de producto.', 46, 48, 0.43, 20.64, 20.64, 20, 0, 1),
(79, 1, '2019-06-08', 'Entrada de producto.', 47, 60, 0.43, 25.8, 25.8, 20, 0, 1),
(80, 1, '2019-06-08', 'Entrada de producto.', 48, 12, 0.75, 9, 9, 20, 0, 1),
(81, 1, '2019-06-08', 'Entrada de producto.', 49, 12, 0.58, 6.96, 6.96, 20, 0, 1),
(82, 1, '2019-06-08', 'Entrada de producto.', 50, 4, 2.75, 11, 11, 21, 0, 1),
(83, 1, '2019-06-08', 'Compra de producto.', 39, 6, 0.83, 4.98, 24.9, 22, 0, 1),
(84, 3, '2019-06-08', 'Compra anulada.', 39, 6, 0.83, 4.98, 19.92, 22, 0, 1),
(85, 3, '2019-06-08', 'Compra anulada.', 50, 4, 2.75, 11, 0, 21, 0, 1),
(86, 2, '2019-06-08', 'Salida', 1, 6, 1.66, 9.96, 7.08, 0, 2, 1),
(87, 4, '2019-06-08', 'Venta anulada.', 1, 6, 1.66, 9.96, -2.88, 0, 2, 1),
(88, 1, '2019-06-28', 'Compra de producto.', 8, 3, 1.66, 4.98, 44.82, 23, 0, 1),
(89, 1, '2019-06-28', 'Compra de producto.', 7, 3, 2, 6, 30, 23, 0, 1),
(90, 1, '2019-06-28', 'Compra de producto.', 35, 6, 1.75, 10.5, 21, 23, 0, 1),
(91, 1, '2019-06-28', 'Compra de producto.', 6, 6, 2.5, 15, 66, 23, 0, 1),
(92, 1, '2019-06-28', 'Compra de producto.', 9, 4, 1.66, 6.64, 46.48, 24, 0, 1),
(93, 1, '2019-06-28', 'Compra de producto.', 37, 12, 1.75, 21, 63, 24, 0, 1),
(94, 1, '2019-06-28', 'Compra de producto.', 21, 12, 0.41, 4.92, 24.6, 24, 0, 1),
(95, 1, '2019-06-28', 'Compra de producto.', 39, 12, 0.83, 9.96, 29.88, 24, 0, 1),
(96, 1, '2019-06-28', 'Compra de producto.', 44, 12, 0.83, 9.96, 19.92, 24, 0, 1),
(97, 1, '2019-06-28', 'Compra de producto.', 8, 12, 1.66, 19.92, 64.74, 25, 0, 1),
(98, 1, '2019-06-28', 'Compra de producto.', 12, 12, 0.83, 9.96, 29.88, 25, 0, 1),
(99, 1, '2019-06-28', 'Compra de producto.', 19, 12, 0.41, 4.92, 24.6, 25, 0, 1),
(100, 1, '2019-06-28', 'Compra de producto.', 1, 12, 1.42, 17.04, 14.16, 25, 0, 1),
(101, 1, '2019-06-28', 'Compra de producto.', 37, 12, 1.75, 21, 84, 25, 0, 1),
(102, 1, '2019-06-28', 'Compra de producto.', 35, 12, 1.75, 21, 42, 25, 0, 1),
(103, 1, '2019-06-28', 'Compra de producto.', 36, 12, 1.5, 18, 81, 25, 0, 1),
(104, 1, '2019-06-28', 'Compra de producto.', 16, 33, 0.42, 13.86, 23.94, 26, 0, 1),
(105, 1, '2019-06-28', 'Compra de producto.', 1, 34, 1.42, 48.28, 62.44, 26, 0, 1),
(106, 3, '2019-06-28', 'Compra anulada.', 1, 12, 1.42, 17.04, 0, 1, 0, 1),
(107, 2, '2019-06-28', 'Salida', 1, 12, 1.66, 19.92, -19.92, 0, 3, 1),
(108, 4, '2019-06-28', 'Venta anulada.', 1, 12, 1.66, 19.92, -39.84, 0, 3, 1),
(109, 2, '2019-06-28', 'Salida', 22, 1, 0.66, 0.66, 28.86, 0, 4, 1),
(110, 2, '2019-06-28', 'Salida', 13, 2, 1.04, 2.08, 17.84, 0, 4, 1),
(111, 2, '2019-06-28', 'Salida', 16, 1, 0.66, 0.66, 23.28, 0, 4, 1),
(112, 2, '2019-06-28', 'Salida', 28, 12, 1.04, 12.48, 17.4, 0, 4, 1),
(113, 2, '2019-06-28', 'Salida', 24, 12, 0.66, 7.92, 11.76, 0, 4, 1),
(114, 1, '2019-07-17', 'Compra de producto.', 65, 1, 0, 0, 0, 29, 0, 5),
(115, 1, '2019-07-15', 'Compra de producto.', 3, 6, 1, 6, 42, 30, 0, 5),
(116, 1, '2019-07-15', 'Compra de producto.', 65, 7, 5.25, 36.75, 36.75, 30, 0, 5),
(117, 1, '2019-07-15', 'Compra de producto.', 65, 3, 5.25, 15.75, 52.5, 31, 0, 5),
(118, 1, '2019-07-15', 'Compra de producto.', 3, 3, 1, 3, 45, 31, 0, 5),
(119, 1, '2019-07-15', 'Compra de producto.', 3, 1, 1, 1, 46, 34, 0, 5),
(120, 1, '2019-07-15', 'Compra de producto.', 65, 1, 5.25, 5.25, 57.75, 34, 0, 5),
(121, 1, '2019-07-15', 'Compra de producto.', 12, 1, 0.83, 0.83, 30.71, 35, 0, 5),
(122, 1, '2019-07-15', 'Compra de producto.', 65, 1, 5.25, 5.25, 63, 35, 0, 5),
(123, 1, '2019-07-15', 'Compra de producto.', 3, 1, 1, 1, 47, 37, 0, 5),
(124, 1, '2019-07-15', 'Compra de producto.', 3, 1, 1, 1, 48, 38, 0, 5),
(125, 1, '2019-07-15', 'Compra de producto.', 65, 1, 5.25, 5.25, 68.25, 38, 0, 5),
(126, 1, '2019-07-15', 'Compra de producto.', 65, 1, 5.25, 5.25, 73.5, 39, 0, 5),
(127, 1, '2019-07-15', 'Compra de producto.', 3, 1, 1, 1, 49, 40, 0, 5),
(128, 1, '2019-07-15', 'Compra de producto.', 65, 1, 5.25, 5.25, 78.75, 41, 0, 5),
(129, 1, '2019-07-15', 'Compra de producto.', 3, 1, 1, 1, 50, 41, 0, 5),
(130, 1, '2019-07-15', 'Compra de producto.', 65, 1, 5.25, 5.25, 84, 42, 0, 5),
(131, 1, '2019-07-15', 'Compra de producto.', 3, 1, 1, 1, 51, 42, 0, 5),
(132, 1, '2019-07-15', 'Compra de producto.', 65, 1, 5.25, 5.25, 89.25, 43, 0, 5),
(133, 1, '2019-07-15', 'Compra de producto.', 1, 1, 1.42, 1.42, -38.42, 43, 0, 5),
(134, 2, '2019-07-16', 'Salida', 65, 1, 0, 0, 89.25, 0, 5, 5),
(135, 1, '2019-07-18', 'Compra de producto.', 65, 1, 5.25, 5.25, 94.5, 44, 0, 5),
(136, 3, '2019-07-18', 'Compra anulada.', 65, 1, 5.25, 5.25, 89.25, 44, 0, 5),
(137, 3, '2019-07-18', 'Compra anulada.', 65, 1, 5.25, 5.25, 84, 43, 0, 5),
(138, 3, '2019-07-18', 'Compra anulada.', 1, 1, 1.42, 1.42, -39.84, 43, 0, 5),
(139, 1, '2019-07-18', 'Compra de producto.', 65, 3, 5.25, 15.75, 99.75, 45, 0, 5),
(140, 3, '2019-07-18', 'Compra anulada.', 65, 3, 5.25, 15.75, 84, 45, 0, 5),
(141, 1, '2019-07-18', 'Compra de producto.', 65, 1, 5.25, 5.25, 89.25, 46, 0, 5),
(142, 3, '2019-07-18', 'Compra anulada.', 65, 1, 5.25, 5.25, 73.5, 41, 0, 5),
(143, 3, '2019-07-18', 'Compra anulada.', 3, 1, 1, 1, 49, 41, 0, 5),
(144, 2, '2019-07-18', 'Salida', 65, 1, 0.04, 0.04, 73.46, 0, 7, 5),
(145, 2, '2019-07-18', 'Salida', 65, 1, 0.04, 0.04, 73.42, 0, 8, 5),
(146, 2, '2019-07-18', 'Salida', 65, 1, 0.04, 0.04, 73.38, 0, 9, 5),
(147, 2, '2019-07-18', 'Salida', 65, 1, 0.04, 0.04, 73.34, 0, 10, 5),
(148, 2, '2019-07-18', 'Salida', 65, 1, 0.04, 0.04, 73.3, 0, 11, 5),
(149, 4, '2019-07-18', 'Venta anulada.', 65, 1, 0.04, 0.04, 73.26, 0, 11, 5),
(150, 2, '2019-07-18', 'Salida', 65, 2, 0, 0, 73.26, 0, 12, 5),
(151, 2, '2019-07-18', 'Salida', 65, 1, 0, 0, 73.26, 0, 14, 5),
(152, 2, '2019-07-18', 'Salida', 65, 1, 0, 0, 73.26, 0, 15, 5),
(153, 2, '2019-07-18', 'Salida', 65, 1, 0, 0, 73.26, 0, 16, 5),
(154, 2, '2019-07-18', 'Salida', 65, 1, 0, 0, 73.26, 0, 17, 5),
(155, 2, '2019-07-18', 'Salida', 65, 1, 0, 0, 73.26, 0, 18, 5),
(156, 2, '2019-07-18', 'Salida', 65, 1, 0, 0, 73.26, 0, 19, 5),
(157, 4, '2019-07-18', 'Venta anulada.', 65, 1, 0, 0, 73.26, 0, 19, 5),
(158, 2, '2019-07-18', 'Salida', 65, 0, 0, 0, 73.26, 0, 20, 5),
(159, 2, '2019-07-18', 'Salida', 65, 0, 0, 0, 73.26, 0, 21, 5),
(160, 2, '2019-07-18', 'Salida', 65, 0, 0, 0, 73.26, 0, 22, 5),
(161, 2, '2019-07-18', 'Salida', 35, 0, 2, 0, 42, 0, 23, 5),
(162, 2, '2019-07-18', 'Salida', 35, 0, 2, 0, 42, 0, 24, 5),
(163, 2, '2019-07-18', 'Salida', 35, 1, 2, 2, 40, 0, 25, 5),
(164, 4, '2019-07-18', 'Venta anulada.', 35, 1, 2, 2, 38, 0, 25, 5),
(165, 4, '2019-07-18', 'Venta anulada.', 35, 0, 2, 0, 42, 0, 24, 5),
(166, 4, '2019-07-18', 'Venta anulada.', 35, 0, 2, 0, 42, 0, 23, 5),
(167, 2, '2019-07-18', 'Salida', 65, 10, 0, 0, 73.26, 0, 26, 5),
(168, 2, '2019-07-18', 'Salida', 35, 1, 2, 2, 40, 0, 26, 5),
(169, 2, '2019-07-18', 'Salida', 65, 10, 0, 0, 73.26, 0, 27, 5),
(170, 2, '2019-07-18', 'Salida', 65, 10, 0, 0, 73.26, 0, 28, 5),
(171, 4, '2019-07-18', 'Venta anulada.', 65, 10, 0, 0, 73.26, 0, 28, 5),
(172, 2, '2019-07-18', 'Salida', 35, 1, 2, 2, 38, 0, 29, 5),
(173, 4, '2019-07-18', 'Venta anulada.', 35, 1, 2, 2, 36, 0, 29, 5),
(174, 2, '2019-07-18', 'Salida', 65, 10, 0, 0, 73.26, 0, 30, 5),
(175, 2, '2019-07-18', 'Salida', 35, 10, 2, 20, 16, 0, 30, 5),
(176, 4, '2019-07-18', 'Venta anulada.', 65, 10, 0, 0, 73.26, 0, 30, 5),
(177, 4, '2019-07-18', 'Venta anulada.', 35, 10, 2, 20, -4, 0, 30, 5),
(178, 2, '2019-07-24', 'Salida', 65, 1, 0, 0, 73.26, 0, 31, 5),
(179, 1, '2019-07-24', 'Compra de producto.', 65, 5, 5.25, 26.25, 99.51, 47, 0, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lotes`
--

CREATE TABLE IF NOT EXISTS `lotes` (
  `id_lote` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) NOT NULL,
  `id_entrada` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha_entrada` date NOT NULL,
  `fecha_caducidad` date NOT NULL,
  `estado` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_lote`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf32 COLLATE=utf32_spanish2_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `lotes`
--

INSERT INTO `lotes` (`id_lote`, `id_producto`, `id_entrada`, `cantidad`, `fecha_entrada`, `fecha_caducidad`, `estado`) VALUES
(1, 65, 44, 1, '2019-07-18', '2019-07-18', 0),
(2, 65, 45, 3, '2019-07-18', '2019-07-18', 0),
(3, 65, 46, 99, '2019-07-18', '2019-07-19', 1),
(4, 65, 47, 5, '2019-07-24', '2019-07-24', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE IF NOT EXISTS `marcas` (
  `id_marca` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `estado` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_marca`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=57 ;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id_marca`, `nombre`, `estado`) VALUES
(1, 'Latina Secret', 1),
(2, 'Viquelsy', 1),
(3, 'Hers', 1),
(4, 'Amiga', 1),
(5, 'Rosmy Love', 1),
(6, 'Amiguita', 1),
(7, 'Popeye', 1),
(8, 'Differ', 1),
(9, 'Tela Fria', 1),
(10, 'Amiga Fashion', 1),
(11, 'Septima', 1),
(12, 'Sexy Couture', 1),
(13, 'Sweet Couture', 1),
(14, 'Leotex', 1),
(15, 'Miss Rudy', 1),
(16, 'Bacci', 1),
(17, 'Petals', 1),
(18, 'Texas Basic', 1),
(19, 'Mariana Kids', 1),
(20, 'Amiga School', 1),
(21, 'Fillette', 1),
(22, 'Bonita Girls', 1),
(23, 'Vertikal', 1),
(24, 'Most Wanted', 1),
(25, 'Hot Delicius', 1),
(26, 'Salvaje', 1),
(27, 'Top Shop', 1),
(28, 'Cosita Rica', 1),
(29, 'Diego Cassel', 1),
(30, 'Fiara Intimate', 1),
(31, 'Capitan', 1),
(32, 'Premier', 1),
(33, '05 Sport', 1),
(34, 'Laos', 1),
(35, 'Caterpillar', 1),
(36, 'Brenda', 1),
(37, 'Caribe', 1),
(38, 'Mantel', 1),
(39, 'American Texas', 1),
(40, 'Mary', 1),
(41, 'J&P', 1),
(42, 'Barata', 1),
(43, 'Creaciones Yaneth', 1),
(44, 'Chapina', 1),
(45, 'Kinder', 1),
(46, 'Pony', 1),
(47, 'Colar', 1),
(48, 'Milavista', 1),
(49, 'Lady Vusques', 1),
(50, 'Varios', 1),
(51, 'Viquelsy', 0),
(52, 'ñ+{}{}+{+''´+¿´+{', 1),
(53, 'ssssssssssssssss', 0),
(54, 'tggggggggggggggg', 0),
(55, 'Lactolac', 1),
(56, 'coca-cola', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(35) COLLATE utf8_spanish2_ci NOT NULL,
  `link` varchar(35) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id_menu`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`id_menu`, `nombre`, `link`) VALUES
(1, 'Inicio', 'dashboard'),
(2, 'Marcas', 'mantenimiento/marcas'),
(3, 'Productos', 'mantenimiento/productos'),
(4, 'Presentaciones', 'mantenimiento/presentaciones'),
(5, 'Proveedores', 'mantenimiento/proveedores'),
(6, 'Clientes', 'mantenimiento/clientes'),
(7, 'Usuarios', 'mantenimiento/usuarios'),
(8, 'Entradas', 'movimientos/entradas'),
(9, 'Salidas', 'movimientos/salidas'),
(10, 'Configuracion', 'ajustes/ajustes'),
(11, 'Permisos', 'ajustes/permisos'),
(12, 'Kardex', 'movimientos/kardex');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE IF NOT EXISTS `permisos` (
  `id_permiso` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(10) NOT NULL,
  `rol_id` int(2) NOT NULL,
  `read` int(2) NOT NULL,
  `insert` int(2) NOT NULL,
  `update` int(2) NOT NULL,
  `delete` int(2) NOT NULL,
  PRIMARY KEY (`id_permiso`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id_permiso`, `menu_id`, `rol_id`, `read`, `insert`, `update`, `delete`) VALUES
(1, 2, 1, 1, 1, 1, 1),
(2, 1, 1, 1, 1, 1, 1),
(3, 3, 1, 1, 1, 1, 1),
(4, 4, 1, 1, 1, 1, 1),
(5, 5, 1, 1, 1, 1, 1),
(6, 6, 1, 1, 1, 1, 1),
(7, 7, 1, 1, 1, 1, 1),
(8, 8, 1, 1, 1, 1, 1),
(9, 9, 1, 1, 1, 1, 1),
(10, 10, 1, 1, 1, 1, 1),
(11, 11, 1, 1, 1, 1, 1),
(12, 12, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presentacion`
--

CREATE TABLE IF NOT EXISTS `presentacion` (
  `id_presentacion` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `estado` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_presentacion`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `presentacion`
--

INSERT INTO `presentacion` (`id_presentacion`, `nombre`, `estado`) VALUES
(1, 'Unidad', 0),
(2, 'Caja', 0),
(3, 'Estuche', 0),
(4, 'unidad', 1),
(5, 'pieza', 1),
(6, 'Docena', 1),
(7, 'ñ', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `id_producto` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) NOT NULL,
  `codigo` varchar(100) NOT NULL,
  `id_stock` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `precio_compra` double NOT NULL,
  `precio_venta` double NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `inventariable` tinyint(4) NOT NULL,
  `id_presentacion` int(11) NOT NULL,
  `perecedero` int(2) NOT NULL,
  `estado` int(2) NOT NULL DEFAULT '1',
  `id_marca` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_producto`),
  KEY `id_categoria` (`id_categoria`,`id_stock`,`id_presentacion`),
  KEY `id_stock` (`id_stock`),
  KEY `id_presentacion` (`id_presentacion`),
  KEY `id_marca` (`id_marca`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=66 ;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `id_categoria`, `codigo`, `id_stock`, `nombre`, `descripcion`, `precio_compra`, `precio_venta`, `imagen`, `inventariable`, `id_presentacion`, `perecedero`, `estado`, `id_marca`) VALUES
(1, 2, 'FCH-7320', 1, 'blusa', 'Blusa tipo Polo', 1.42, 1.66, '', 0, 5, 0, 1, 4),
(2, 3, 'K18-XL063', 2, 'Falda', 'falda cuadriculada', 1.91, 3, '', 0, 5, 0, 1, 1),
(3, 4, 'B.A.C.', 3, 'Bloomer', 'Bloomer Algodon color', 1, 1.25, '', 0, 5, 0, 1, 5),
(4, 7, 'T.A.C', 4, 'Tanga', 'tanga de algodon de color', 0.75, 1, '', 0, 5, 0, 1, 5),
(5, 7, 'T.L.C', 5, 'Tanga', 'tanga de licra de color', 0.75, 1, '', 0, 5, 0, 1, 5),
(6, 3, 'K18-XL062', 6, 'Falda', 'falda cuadriculada larga', 2.5, 3, '', 0, 5, 0, 1, 1),
(7, 6, 'K18-XL067', 7, 'Capri', 'Capri cuadriculado', 2, 2.5, '', 0, 5, 0, 1, 1),
(8, 5, 'HDH-011', 8, 'Camison', 'Camison juvenil corto', 1.66, 2, '', 0, 5, 0, 1, 10),
(9, 5, 'HDH-010', 9, 'camison', 'Camison juvenil corto', 1.66, 2, '', 0, 5, 0, 1, 10),
(10, 7, 'T.L.E.', 10, 'Tanga', 'tanga de licra estampada', 0.58, 0.83, '', 0, 5, 0, 1, 5),
(11, 8, 'C.L.E.', 11, 'Cachetero', 'Licra estampada', 0.66, 0.83, '', 0, 5, 0, 1, 5),
(12, 4, 'K17-YTF3527P', 12, 'Bloomer', 'Bloomer Algodon', 0.83, 1.04, '', 0, 5, 0, 1, 1),
(13, 4, 'K17-YTF3529P', 13, 'Bloomer', 'Bloomer Algodon', 0.83, 1.04, '', 0, 5, 0, 1, 1),
(14, 4, 'C18-HY3810P', 14, 'Bloomer', 'Bloomer Algodon', 0.83, 1.04, '', 0, 5, 0, 1, 1),
(15, 4, 'K17-YTF3536P', 15, 'Bloomer', 'Bloomer Algodon', 0.83, 1.04, '', 0, 5, 0, 1, 1),
(16, 4, '1126', 16, 'Bloomer', 'Bloomer chino tela fria', 0.42, 0.66, '', 0, 5, 0, 0, 9),
(17, 4, 'GB/T8878-2002', 17, 'Bloomer', 'Bloomer chino tela fria', 0.42, 0.66, '', 0, 5, 0, 1, 9),
(18, 4, 'GB/T8878-2009 ', 18, 'Bloomer', 'Bloomer chino tela fria', 0.42, 0.66, '', 0, 5, 0, 1, 9),
(19, 4, 'GB18401-2010B', 19, 'Bloomer', 'Bloomer chino tela fria', 0.41, 0.66, '', 0, 5, 0, 1, 9),
(20, 4, '206', 20, 'Bloomer', 'Bloomer chino tela fria', 0.41, 0.66, '', 0, 5, 0, 1, 9),
(21, 4, '3319', 21, 'Bloomer', 'Bloomer chino tela fria', 0.41, 0.66, '', 0, 5, 0, 1, 9),
(22, 4, '2003', 22, 'Bloomer', 'Bloomer chino tela fria', 0.41, 0.66, '', 0, 5, 0, 0, 9),
(23, 4, '3358', 23, 'Bloomer', 'Bloomer chino tela fria', 0.41, 0.66, '', 0, 5, 0, 1, 9),
(24, 4, 'PLS13120', 24, 'Bloomer', 'Bloomer chino tela fria', 0.41, 0.66, '', 0, 5, 0, 1, 9),
(25, 4, '9483', 25, 'Bloomer', 'Bloomer chino tela fria', 0.41, 0.66, '', 0, 5, 0, 1, 9),
(26, 4, '653', 26, 'Bloomer', 'Bloomer chino tela fria', 0.41, 0.66, '', 0, 5, 0, 1, 9),
(27, 4, '8347', 27, 'Bloomer', 'Bloomer chino tela fria', 0.41, 0.66, '', 0, 5, 0, 1, 9),
(28, 4, 'C18-HY3814P', 28, 'Bloomer', 'Bloomer Algodon', 0.83, 1.04, '', 0, 5, 0, 1, 1),
(29, 4, 'E18-LGQ4011P', 29, 'Bloomer', 'Bloomer Algodon', 0.83, 1.04, '', 0, 5, 0, 1, 1),
(30, 4, '050', 30, 'Bloomer', 'Bloomer Algodon', 0.66, 0.83, '', 0, 5, 0, 0, 40),
(31, 4, 'C18-HY3827P', 31, 'Bloomer', 'Bloomer Algodon', 0.83, 1.04, '', 0, 5, 0, 1, 1),
(32, 4, 'C18-HY3812P', 32, 'Bloomer', 'Bloomer Algodon', 0.83, 1.04, '', 0, 5, 0, 1, 1),
(33, 4, 'HF56', 33, 'Bloomer', 'Bloomer Algodon estampado', 0.58, 0.75, '', 0, 5, 0, 1, 41),
(34, 3, 'FB24', 34, 'Falda 24', 'Falda licra', 1.75, 2, '', 0, 5, 0, 1, 42),
(35, 3, 'FBL', 35, 'falda larga 24', 'falda barata larga', 1.75, 2, '', 0, 5, 0, 1, 42),
(36, 3, 'FB20', 36, 'Falda 20', 'falda corta 20', 1.5, 1.66, '', 0, 5, 0, 1, 42),
(37, 2, 'BC24', 37, 'Blusa 24', 'blusa surtida', 1.75, 2, '', 0, 5, 0, 1, 44),
(38, 19, 'V01', 38, 'Vestido', 'vestido colores', 2.5, 3, '', 0, 5, 0, 1, 43),
(39, 15, 'TP01', 39, 'Toalla Colores Pastel', 'toalla colores pastel', 0.83, 0.91, '', 0, 5, 0, 1, 32),
(40, 18, 'MG-11', 40, 'Mantel grande', 'grande de dacron', 0.75, 0.91, '', 0, 5, 0, 1, 46),
(41, 18, 'MM-10', 41, 'Mantel mediano', 'mantel dacron', 0.66, 0.83, '', 0, 5, 0, 1, 46),
(42, 15, 'TP-350', 42, 'Toalla pequeña', 'toalla pequeña surtida', 2.5, 3.5, '', 0, 6, 0, 1, 50),
(43, 15, 'TK-3', 43, 'Toalla Kinder', 'Toalla kinder surtida', 2, 3, '', 0, 6, 0, 1, 50),
(44, 18, 'MJ-12', 44, 'Mantel Jumbo', 'mantel dacron', 0.83, 1, '', 0, 5, 0, 1, 46),
(45, 18, 'MP-450', 45, 'Mantel pequeño', 'mantel dacron', 0.31, 0.37, '', 0, 5, 0, 1, 46),
(46, 15, 'TC-6', 46, 'Toalla Colores Pastel', 'toalla mechas', 0.43, 0.5, '', 0, 5, 0, 1, 37),
(47, 18, 'MC-6', 47, 'Mantel estampado', 'mantel mechas', 0.43, 0.5, '', 0, 5, 0, 1, 37),
(48, 18, 'MP-11', 48, 'Mantel Pavo', 'mantel con dibujo pavo', 0.75, 0.91, '', 0, 5, 0, 1, 46),
(49, 18, 'MC-8', 49, 'Mantel colar', 'Mantel para colar', 0.58, 0.66, '', 0, 5, 0, 1, 50),
(50, 15, 'FCH-6586', 50, 'Toalla Baño', 'toalla lisa colores', 2.75, 3.5, '', 0, 5, 0, 1, 18),
(51, 1, '', 51, '', '', 0, 0, '', 0, 4, 0, 1, 1),
(52, 1, '', 52, '', '', 0, 0, '', 0, 4, 0, 1, 1),
(53, 1, '', 53, '', '', 0, 0, '', 0, 4, 0, 1, 1),
(54, 1, '', 54, '', '', 0, 0, '', 0, 4, 0, 1, 1),
(55, 1, '', 55, '', '', 0, 0, '', 0, 4, 0, 1, 1),
(56, 22, '005500220001', 56, 'carne', 'kobe beef', 150, 200, '', 0, 4, 1, 0, 55),
(57, 22, '005500220002', 57, 'carne', 'carne cobe beef', 150, 275, '', 0, 4, 1, 0, 55),
(58, 5, '', 58, 'carne', 'asdasda', 150, 1000, '', 0, 4, 1, 0, 4),
(59, 1, '', 59, 'carne', 'adasd', 150, 200, '', 0, 4, 1, 0, 1),
(60, 1, '000100010007', 60, '', '', 0, 0, '', 0, 4, 0, 1, 1),
(61, 1, '000100010008', 61, '', '', 0, 0, '', 0, 4, 0, 1, 1),
(62, 1, '000100010009', 62, '', '', 0, 0, '', 0, 4, 0, 1, 1),
(63, 1, '000100010010', 63, '', '', 0, 0, '', 0, 4, 0, 1, 1),
(64, 1, '000100010011', 64, '', '', 0, 0, '', 0, 4, 0, 0, 1),
(65, 22, '005500220003', 65, 'carneeeeee', 'kobe', 5.25, 0, 'calculadora-chuleta.jpg', 0, 4, 1, 1, 55);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE IF NOT EXISTS `proveedores` (
  `id_proveedor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `empresa` varchar(100) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_proveedor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id_proveedor`, `nombre`, `empresa`, `telefono`, `estado`) VALUES
(1, 'Gilberto', 'Popeye', '7862-9409', 1),
(2, 'Lisseth', 'Distribuidora Latina', '7232-6342', 1),
(3, 'Javier', 'Lavable', '7932-8000', 1),
(4, 'Francisco Guerra Hers', 'HERS', '', 1),
(5, 'Zulma', 'Bazar Zulma', '', 1),
(6, '', '', '', 0),
(7, '', '', '', 0),
(8, '', '', '', 0),
(9, 'KK', 'acción', '9', 1),
(10, 'HKJDHS', 'GHJ', '8', 1),
(11, 'HGJH', 'HJGJHG', '555', 1),
(12, 'GFFDDF', 'DFG', '', 1),
(13, 'HGHG', 'UYFHGF', '', 0),
(14, 'JHJHG', 'HJGJH', '', 0),
(15, 'HJHGHJ', 'JGHJH', '', 0),
(16, 'JGDJHSG', 'DJHSGJ', '', 0),
(17, 'HJJ', 'HGHG', '', 0),
(18, 'SDA', 'AFD', '', 1),
(19, 'JHGDH', 'JHGJHG', '', 1),
(20, 'KHKDHJS', 'HKJHKJH', '5465', 1),
(21, 'JJHHKJH', 'KJHKJH', '55', 1),
(22, 'lkmlk', 'klk', 'klk', 1),
(23, 'radarada', 'gombal', '666666666', 0),
(24, 'holaño', 'pipian', '111', 1),
(25, 'ola', 'piopio', 'pipio', 1),
(26, 'hugo', 'jugitos de helado', '666666', 1),
(27, 'kony', 'pony salvaje', '2121 2828', 1),
(28, 'niña zulma', 'niña zulma', 'niña zulma', 1),
(29, 'jordy wile', 'xvideos', '21212828', 1),
(30, 'khalifa', 'xvieos', '3333336', 1),
(31, 'coma', 'lapa', '1212', 1),
(32, 'ss', '', '', 1),
(33, 'jdklkj', '', '', 1),
(34, 'djksajkjh', '', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `nombre`) VALUES
(1, 'Administrador'),
(2, 'Vendedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salidas`
--

CREATE TABLE IF NOT EXISTS `salidas` (
  `id_salida` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `fecha` date NOT NULL,
  `total` double NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `id_movimiento` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_salida`),
  KEY `id_usuario` (`id_usuario`,`id_movimiento`),
  KEY `id_tipo_salida` (`id_movimiento`),
  KEY `id_cliente` (`id_cliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Volcado de datos para la tabla `salidas`
--

INSERT INTO `salidas` (`id_salida`, `id_usuario`, `id_cliente`, `fecha`, `total`, `descripcion`, `id_movimiento`, `estado`) VALUES
(1, 1, 1, '2019-06-07', 9, 'venta de producto', 2, 1),
(2, 1, 1, '2019-06-08', 9.96, 'venta de producto', 2, 0),
(3, 1, 1, '2019-06-28', 19.92, 'venta de producto', 0, 0),
(4, 1, 1, '2019-06-28', 23.8, 'venta de producto', 0, 1),
(5, 5, 1, '2019-07-16', 0, 'venta de producto', 0, 1),
(6, 5, 1, '2019-07-18', 0.04, 'venta de producto', 0, 1),
(7, 5, 1, '2019-07-18', 0.04, 'venta de producto', 0, 1),
(8, 5, 1, '2019-07-18', 0.04, 'venta de producto', 0, 1),
(9, 5, 1, '2019-07-18', 0.04, 'venta de producto', 0, 1),
(10, 5, 1, '2019-07-18', 0.04, 'venta de producto', 0, 1),
(11, 5, 1, '2019-07-18', 0.04, 'venta de producto', 0, 0),
(12, 5, 1, '2019-07-18', 0, 'venta de producto', 0, 1),
(13, 5, 1, '2019-07-18', 0, 'venta de producto', 0, 1),
(14, 5, 1, '2019-07-18', 0, 'venta de producto', 0, 1),
(15, 5, 1, '2019-07-18', 0, 'venta de producto', 0, 1),
(16, 5, 1, '2019-07-18', 0, 'venta de producto', 0, 1),
(17, 5, 1, '2019-07-18', 0, 'venta de producto', 0, 1),
(18, 5, 1, '2019-07-18', 0, 'venta de producto', 0, 1),
(19, 5, 1, '2019-07-18', 0, 'venta de producto', 0, 0),
(20, 5, 1, '2019-07-18', 0, 'venta de producto', 0, 1),
(21, 5, 1, '2019-07-18', 0, 'venta de producto', 0, 1),
(22, 5, 1, '2019-07-18', 0, 'venta de producto', 0, 1),
(23, 5, 1, '2019-07-18', 0, 'venta de producto', 0, 0),
(24, 5, 1, '2019-07-18', 0, 'venta de producto', 0, 0),
(25, 5, 1, '2019-07-18', 2, 'venta de producto', 0, 0),
(26, 5, 1, '2019-07-18', 2, 'venta de producto', 0, 1),
(27, 5, 1, '2019-07-18', 0, 'venta de producto', 0, 1),
(28, 5, 1, '2019-07-18', 0, 'venta de producto', 0, 0),
(29, 5, 1, '2019-07-18', 2, 'venta de producto', 0, 0),
(30, 5, 1, '2019-07-18', 20, 'venta de producto', 0, 0),
(31, 5, 1, '2019-07-24', 0, 'venta de producto', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock`
--

CREATE TABLE IF NOT EXISTS `stock` (
  `id_stock` int(11) NOT NULL AUTO_INCREMENT,
  `stock_actual` int(11) NOT NULL,
  `stock_inicial` int(11) NOT NULL,
  `stock_minimo` int(11) NOT NULL,
  PRIMARY KEY (`id_stock`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=66 ;

--
-- Volcado de datos para la tabla `stock`
--

INSERT INTO `stock` (`id_stock`, `stock_actual`, `stock_inicial`, `stock_minimo`) VALUES
(1, 46, 0, 0),
(2, 72, 0, 0),
(3, 50, 0, 0),
(4, 36, 0, 0),
(5, 36, 0, 0),
(6, 27, 0, 0),
(7, 15, 0, 0),
(8, 39, 0, 0),
(9, 28, 0, 0),
(10, 24, 0, 0),
(11, 24, 0, 0),
(12, 37, 0, 0),
(13, 22, 0, 0),
(14, 24, 0, 0),
(15, 22, 0, 0),
(16, 56, 0, 0),
(17, 48, 0, 0),
(18, 48, 0, 0),
(19, 60, 0, 0),
(20, 48, 0, 0),
(21, 60, 0, 0),
(22, 71, 0, 0),
(23, 48, 0, 0),
(24, 36, 0, 0),
(25, 48, 0, 0),
(26, 48, 0, 0),
(27, 48, 0, 0),
(28, 24, 0, 0),
(29, 12, 0, 0),
(30, 24, 0, 0),
(31, 24, 0, 0),
(32, 12, 0, 0),
(33, 12, 0, 0),
(34, 105, 0, 0),
(35, 23, 0, 0),
(36, 54, 0, 0),
(37, 48, 0, 0),
(38, 24, 0, 0),
(39, 36, 0, 0),
(40, 72, 0, 0),
(41, 72, 0, 0),
(42, 8, 0, 0),
(43, 2, 0, 0),
(44, 24, 0, 0),
(45, 36, 0, 1),
(46, 48, 0, 0),
(47, 60, 0, 0),
(48, 12, 0, 0),
(49, 12, 0, 0),
(50, 0, 0, 0),
(51, 0, 0, 0),
(52, 0, 0, 0),
(53, 0, 0, 0),
(54, 0, 0, 0),
(55, 0, 0, 0),
(56, 0, 0, 5),
(57, 0, 0, 10),
(58, 0, 0, 55),
(59, 0, 0, 3),
(60, 0, 0, 0),
(61, 0, 0, 0),
(62, 0, 0, 0),
(63, 0, 0, 0),
(64, 0, 0, 0),
(65, -7, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_movimiento`
--

CREATE TABLE IF NOT EXISTS `tipo_movimiento` (
  `id_movimiento` int(2) NOT NULL AUTO_INCREMENT,
  `tipo_transaccion` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id_movimiento`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `tipo_movimiento`
--

INSERT INTO `tipo_movimiento` (`id_movimiento`, `tipo_transaccion`, `nombre`) VALUES
(1, 1, 'Compra'),
(2, 2, 'Venta'),
(3, 2, 'Anulación de compra'),
(4, 1, 'Anulación de venta'),
(5, 1, 'Devolucion de cliente'),
(6, 2, 'Devolucion a proveedor'),
(7, 1, 'Entrada, ajuste de inventario'),
(8, 2, 'Salida, ajuste de inventario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `rol` int(2) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `estado` tinyint(4) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `rol`, `usuario`, `correo`, `estado`, `password`) VALUES
(1, 1, 'Hugo', 'hugoale_ab2@hotmail.com', 1, 'd033e22ae348aeb5660fc2140aec35850c4da997'),
(5, 1, 'Edward', 'baionz_hg@hotmail.com', 1, 'e3240071674a2d3febf0c612c4c60a0498e2375b'),
(6, 2, 'Konny', 'pinchehugochan@gmail.com', 1, '9cdc0d9d072d2a1ed2f5d2c2af594c39c5f1d51c');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_entrada`
--
ALTER TABLE `detalle_entrada`
  ADD CONSTRAINT `detalle_entrada_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`),
  ADD CONSTRAINT `detalle_entrada_ibfk_2` FOREIGN KEY (`id_entrada`) REFERENCES `entradas` (`id_entrada`);

--
-- Filtros para la tabla `kardex`
--
ALTER TABLE `kardex`
  ADD CONSTRAINT `kardex_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`),
  ADD CONSTRAINT `kardex_ibfk_4` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `kardex_ibfk_5` FOREIGN KEY (`id_movimiento`) REFERENCES `tipo_movimiento` (`id_movimiento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `salidas`
--
ALTER TABLE `salidas`
  ADD CONSTRAINT `salidas_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
