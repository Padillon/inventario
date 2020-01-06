-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-01-2020 a las 04:06:18
-- Versión del servidor: 10.1.25-MariaDB
-- Versión de PHP: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inventario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ajustes`
--

CREATE TABLE `ajustes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(40) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `registro` varchar(10) NOT NULL,
  `giro` varchar(100) NOT NULL,
  `logo` varchar(150) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `correo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ajustes`
--

INSERT INTO `ajustes` (`id`, `nombre`, `direccion`, `registro`, `giro`, `logo`, `telefono`, `correo`) VALUES
(1, 'Bazar Zulma', 'San Miguel', '138513-0', 'venta de ropa', 'photo4906976604010424386.jpg', '6109-9440', 'holak@hace.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre`, `estado`) VALUES
(1, 'Material', 1),
(2, 'Bebida', 1),
(3, 'EMBUTIDO', 1),
(4, 'Hogar', 1),
(5, 'LIMPIEZA DE COMPUTADORA ', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  `nit` varchar(25) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `registro` varchar(50) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre`, `apellido`, `nit`, `telefono`, `registro`, `direccion`, `estado`) VALUES
(1, 'Sin definir', NULL, NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_entrada`
--

CREATE TABLE `detalle_entrada` (
  `id_detalle_entrada` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `precio` double NOT NULL,
  `subtotal` double NOT NULL,
  `id_entrada` int(11) NOT NULL,
  `id_presentacion_producto` int(3) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_entrada`
--

INSERT INTO `detalle_entrada` (`id_detalle_entrada`, `cantidad`, `id_producto`, `precio`, `subtotal`, `id_entrada`, `id_presentacion_producto`, `estado`) VALUES
(6, 1, 42, 10, 10, 5, 28, 1),
(7, 1, 42, 10, 10, 6, 28, 1),
(8, 10, 42, 10, 100, 7, 28, 1),
(9, 10, 42, 10, 100, 8, 28, 1),
(10, 10, 42, 10, 100, 9, 28, 1),
(11, 10, 42, 10, 100, 10, 28, 1),
(14, 10, 43, 0.01, 0.1, 13, 29, 1),
(15, 10, 43, 0.01, 0.1, 14, 29, 1),
(16, 1000, 43, 0, 0, 15, 29, 1),
(17, 3, 43, 0, 0, 16, 29, 1),
(18, 1000, 43, 0, 0, 17, 29, 1),
(19, 10, 43, 0, 0, 18, 29, 1),
(20, 4, 48, 1, 4, 19, 33, 1),
(21, 8, 49, 1, 8, 20, 34, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_salida`
--

CREATE TABLE `detalle_salida` (
  `id_detalle_salida` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `precio_venta` double NOT NULL,
  `subtotal` double NOT NULL,
  `id_salida` int(11) NOT NULL,
  `id_lote` int(11) NOT NULL,
  `id_presentacion_producto` int(3) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_salida`
--

INSERT INTO `detalle_salida` (`id_detalle_salida`, `cantidad`, `id_producto`, `precio_venta`, `subtotal`, `id_salida`, `id_lote`, `id_presentacion_producto`, `estado`) VALUES
(1, 10, 43, 13.45, 134.5, 2, 2, 29, 1),
(2, 10, 43, 13.45, 134.5, 3, 2, 29, 1),
(3, 1, 43, 13.45, 13.45, 4, 2, 29, 1),
(4, 4, 43, 13.45, 53.8, 5, 2, 29, 1),
(5, 10, 43, 13.45, 134.5, 5, 3, 29, 1),
(6, 15, 43, 13.45, 201.75, 6, 1, 29, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas`
--

CREATE TABLE `entradas` (
  `id_entrada` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_movimiento` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `total` double NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `estado` tinyint(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `entradas`
--

INSERT INTO `entradas` (`id_entrada`, `id_usuario`, `id_movimiento`, `fecha`, `total`, `id_proveedor`, `estado`) VALUES
(5, 1, 1, '2019-12-18', 10, 2, 0),
(6, 1, 1, '2019-12-18', 10, 2, 0),
(7, 1, 1, '2019-12-19', 100, 2, 1),
(8, 1, 1, '2019-12-19', 100, 2, 1),
(9, 1, 1, '2019-12-19', 100, 2, 1),
(10, 1, 1, '2019-12-19', 100, 2, 1),
(13, 1, 1, '2019-12-21', 0.1, 2, 0),
(14, 1, 1, '2019-12-21', 0.1, 2, 0),
(15, 1, 1, '2019-12-21', 0, 2, 0),
(16, 1, 1, '2019-12-21', 0, 2, 0),
(17, 1, 1, '2019-12-21', 0, 2, 1),
(18, 1, 1, '2019-12-21', 0, 2, 1),
(19, 1, 1, '2019-12-31', 4, 2, 1),
(20, 1, 1, '2019-12-31', 8, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kardex`
--

CREATE TABLE `kardex` (
  `id_kardex` int(11) NOT NULL,
  `id_movimiento` int(2) NOT NULL,
  `fecha` date NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` float NOT NULL DEFAULT '0',
  `total` float NOT NULL DEFAULT '0',
  `id_entrada` int(100) NOT NULL DEFAULT '0',
  `id_salida` int(100) NOT NULL DEFAULT '0',
  `id_presentacion_producto` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `kardex`
--

INSERT INTO `kardex` (`id_kardex`, `id_movimiento`, `fecha`, `descripcion`, `id_producto`, `cantidad`, `precio`, `total`, `id_entrada`, `id_salida`, `id_presentacion_producto`, `id_usuario`) VALUES
(14, 1, '2019-12-18', 'Compra de producto.', 42, 1, 10, 10, 5, 0, 27, 1),
(15, 3, '2019-12-18', 'Compra anulada.', 42, 1, 10, 10, 5, 0, 27, 1),
(16, 1, '2019-12-18', 'Compra de producto.', 42, 1, 10, 10, 6, 0, 27, 1),
(17, 3, '2019-12-18', 'Compra anulada.', 42, 1, 10, 10, 6, 0, 27, 1),
(18, 1, '2019-12-19', 'Compra de producto.', 42, 10, 10, 100, 7, 0, 12, 1),
(19, 1, '2019-12-19', 'Compra de producto.', 42, 10, 10, 100, 8, 0, 12, 1),
(20, 1, '2019-12-19', 'Compra de producto.', 42, 10, 10, 100, 9, 0, 12, 1),
(21, 1, '2019-12-19', 'Compra de producto.', 42, 10, 10, 100, 10, 0, 12, 1),
(26, 1, '2019-12-21', 'Compra de producto.', 43, 10, 0.01, 0.1, 14, 0, 29, 1),
(27, 3, '2019-12-21', 'Compra anulada.', 43, 10, 0.01, 0.1, 14, 0, 29, 1),
(28, 1, '2019-12-21', 'Compra de producto.', 43, 1000, 0, 0, 15, 0, 29, 1),
(29, 3, '2019-12-21', 'Compra anulada.', 43, 1000, 0, 0, 15, 0, 29, 1),
(30, 1, '2019-12-21', 'Compra de producto.', 43, 3, 0, 0, 16, 0, 29, 1),
(31, 3, '2019-12-21', 'Compra anulada.', 43, 3, 0, 0, 16, 0, 29, 1),
(32, 1, '2019-12-21', 'Compra de producto.', 43, 1000, 0, 0, 17, 0, 29, 1),
(33, 2, '2019-12-21', 'Salida', 43, 10, 13.45, 134.5, 0, 2, 29, 1),
(34, 2, '2019-12-21', 'Salida', 43, 10, 13.45, 134.5, 0, 3, 29, 1),
(35, 2, '2019-12-21', 'Salida', 43, 1, 13.45, 13.45, 0, 4, 29, 1),
(36, 1, '2019-12-21', 'Compra de producto.', 43, 10, 0, 0, 18, 0, 29, 1),
(37, 2, '2019-12-21', 'Salida', 43, 4, 13.45, 53.8, 0, 5, 29, 1),
(38, 2, '2019-12-21', 'Salida', 43, 10, 13.45, 134.5, 0, 5, 29, 1),
(39, 5, '2019-12-30', 'asasdasd', 42, 2, 0.01, 0.02, 0, 0, 27, 1),
(40, 5, '2019-12-30', '', 42, 1, 0, 0, 0, 0, 27, 1),
(41, 5, '2019-12-30', '', 42, 1, 0.01, 0.01, 0, 0, 27, 1),
(42, 7, '2019-12-30', '', 42, 10, 0, 0, 0, 0, 27, 1),
(43, 5, '2019-12-30', '', 42, 1, 0, 0, 0, 0, 28, 1),
(44, 2, '2019-12-30', 'Salida', 43, 15, 13.45, 201.75, 0, 6, 29, 1),
(45, 1, '2019-12-31', 'Compra de producto.', 48, 4, 1, 4, 19, 0, 33, 1),
(46, 1, '2019-12-31', 'Compra de producto.', 49, 8, 1, 8, 20, 0, 34, 1),
(47, 5, '2019-12-31', 'porque quiero', 49, 8, 0.13, 1.04, 0, 0, 34, 1),
(48, 6, '2019-12-31', 'otra prueba', 49, 6, 0.01, 0.06, 0, 0, 34, 1),
(50, 9, '2020-01-04', '0', 49, 0, 0, 0, 0, 0, 34, 1),
(51, 9, '2020-01-04', '0', 49, 0, 0, 0, 0, 0, 34, 1),
(52, 9, '2020-01-04', 'Trans formación de prueba numero 6 a prueba numero 110', 49, 0, 0, 0, 0, 0, 34, 1),
(53, 9, '2020-01-04', 'Transformación de prueba numero 6 a prueba numero 110', 50, 0, 0, 0, 0, 0, 35, 1),
(54, 9, '2020-01-04', 'Trans formación de prueba numero 6 a prueba numero 110', 49, 1, 0, 0, 0, 0, 34, 1),
(55, 9, '2020-01-04', 'Transformación de prueba numero 6 a prueba numero 110', 50, 1, 0, 0, 0, 0, 35, 1),
(56, 9, '2020-01-04', 'Trans formación de prueba numero 6 a prueba numero 110', 49, 1, 0, 0, 0, 0, 34, 1),
(57, 9, '2020-01-04', 'Transformación de prueba numero 6 a prueba numero 110', 50, 5, 0, 0, 0, 0, 35, 1),
(58, 9, '2020-01-04', 'Trans formación de prueba numero 6 a prueba numero 110', 49, 1, 0, 0, 0, 0, 34, 1),
(59, 9, '2020-01-04', 'Transformación de prueba numero 6 a prueba numero 110', 50, 1, 0, 0, 0, 0, 35, 1),
(60, 9, '2020-01-04', 'Trans formación de prueba numero 6 a prueba numero 110', 49, 2, 0, 0, 0, 0, 34, 1),
(61, 9, '2020-01-04', 'Transformación de prueba numero 6 a prueba numero 110', 50, 20, 0, 0, 0, 0, 35, 1),
(62, 9, '2020-01-04', 'Trans formación de prueba numero 6 a prueba numero 110', 49, 1, 0, 0, 0, 0, 34, 1),
(63, 9, '2020-01-04', 'Transformación de prueba numero 6 a prueba numero 110', 50, 1, 0, 0, 0, 0, 35, 1),
(64, 9, '2020-01-04', 'Trans formación de prueba numero 6 a prueba numero 110', 49, 10, 0, 0, 0, 0, 34, 1),
(65, 9, '2020-01-04', 'Transformación de prueba numero 6 a prueba numero 110', 50, 10, 0, 0, 0, 0, 35, 1),
(67, 9, '2020-01-04', 'Trans formación de prueba numero 6 a prueba numero 110', 49, 90, 0, 0, 0, 0, 34, 1),
(68, 9, '2020-01-04', 'Transformación de prueba numero 6 a prueba numero 110', 50, 1, 0, 0, 0, 0, 35, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lotes`
--

CREATE TABLE `lotes` (
  `id_lote` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_entrada` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha_entrada` date NOT NULL,
  `fecha_caducidad` date NOT NULL,
  `estado` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish2_ci;

--
-- Volcado de datos para la tabla `lotes`
--

INSERT INTO `lotes` (`id_lote`, `id_producto`, `id_entrada`, `cantidad`, `fecha_entrada`, `fecha_caducidad`, `estado`) VALUES
(1, 43, 14, -5, '2019-12-21', '2019-12-28', 1),
(2, 43, 17, 975, '2019-12-21', '2019-12-28', 1),
(3, 43, 18, 0, '2019-12-21', '2020-01-10', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id_marca` int(11) NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `estado` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id_marca`, `nombre`, `estado`) VALUES
(1, 'Lactolac', 1),
(2, 'VITA', 1),
(3, 'Glade', 1),
(4, 'TOUCH', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `nombre` varchar(35) COLLATE utf8_spanish2_ci NOT NULL,
  `link` varchar(35) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

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
(12, 'Kardex', 'movimientos/kardex'),
(13, 'Categorias', 'mantenimiento/categorias');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id_permiso` int(11) NOT NULL,
  `menu_id` int(10) NOT NULL,
  `rol_id` int(2) NOT NULL,
  `read` int(2) NOT NULL,
  `insert` int(2) NOT NULL,
  `update` int(2) NOT NULL,
  `delete` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

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
(12, 12, 1, 1, 1, 1, 1),
(13, 9, 2, 1, 1, 1, 1),
(14, 8, 2, 1, 1, 1, 1),
(15, 3, 2, 1, 1, 1, 1),
(16, 13, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presentacion`
--

CREATE TABLE `presentacion` (
  `id_presentacion` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `presentacion`
--

INSERT INTO `presentacion` (`id_presentacion`, `nombre`, `estado`) VALUES
(1, 'Unidad', 0),
(2, 'Caja', 0),
(3, 'Estuche', 0),
(4, 'unidad', 1),
(5, 'pieza', 1),
(6, 'Docena', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presentaciones_producto`
--

CREATE TABLE `presentaciones_producto` (
  `id_presentacion_producto` int(11) NOT NULL,
  `id_presentacion` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `valor` int(11) NOT NULL,
  `precio_compra` double NOT NULL,
  `precio_venta` double NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `equivalencia` tinyint(1) NOT NULL DEFAULT '0',
  `estado` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `presentaciones_producto`
--

INSERT INTO `presentaciones_producto` (`id_presentacion_producto`, `id_presentacion`, `id_producto`, `valor`, `precio_compra`, `precio_venta`, `codigo`, `equivalencia`, `estado`) VALUES
(27, 4, 42, 1, 0.75, 1.5, '123', 0, 1),
(28, 6, 42, 12, 10, 9, '124', 1, 1),
(29, 4, 43, 1, 0, 13.45, '7411200603466', 1, 1),
(30, 4, 44, 1, 1, 50, '1321', 1, 1),
(31, 4, 45, 1, 1, 50, '1321', 1, 1),
(32, 4, 47, 2, 3, 3, 'asda', 1, 1),
(33, 4, 48, 1, 1, 1, '123', 1, 1),
(34, 4, 49, 1, 1, 1, '1', 1, 1),
(35, 4, 50, 1, 0.5, 500, '000100010008', 1, 1),
(36, 4, 51, 1, 5, 10, '22', 1, 1),
(37, 6, 51, 12, 3, 3, '888', 0, 1),
(38, 4, 52, 1, 1, 1, '6666', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_stock` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `perecedero` int(2) NOT NULL,
  `estado` int(2) NOT NULL DEFAULT '1',
  `id_marca` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `id_categoria`, `id_stock`, `nombre`, `descripcion`, `imagen`, `perecedero`, `estado`, `id_marca`) VALUES
(42, 4, 58, 'calculadora', 'calculadora casio', '', 0, 0, 4),
(43, 1, 59, 'Mozzarella', '', 'mozzarella.jpg', 1, 0, 1),
(44, 1, 60, 'ejemplo', 'asd', 'colochita_duda.jpg', 0, 0, 1),
(45, 1, 61, 'ejemplo', 'asd', 'colochita_duda.jpg', 0, 0, 1),
(46, 1, 62, 'asdas', '', NULL, 0, 1, 1),
(47, 1, 63, 'ejemplo 9', '', NULL, 0, 0, 1),
(48, 1, 64, 'ejemplo', 'asdasd', NULL, 0, 0, 1),
(49, 1, 65, 'prueba numero 6', 'prueba numero 6', NULL, 0, 1, 1),
(50, 1, 66, 'prueba numero 110', 'esta es una prueba para konny', NULL, 0, 1, 1),
(51, 5, 67, 'resma', 'resam', NULL, 0, 1, 4),
(52, 5, 68, 'fardito de papel bond', '', NULL, 0, 1, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id_proveedor` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `empresa` varchar(100) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id_proveedor`, `nombre`, `empresa`, `telefono`, `estado`) VALUES
(1, 'Enrique', 'Lactolac', '7921-5833', 1),
(2, 'Alexis', 'Comercial', '7878-9884', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

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

CREATE TABLE `salidas` (
  `id_salida` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `fecha` date NOT NULL,
  `total` double NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `id_movimiento` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `salidas`
--

INSERT INTO `salidas` (`id_salida`, `id_usuario`, `id_cliente`, `fecha`, `total`, `descripcion`, `id_movimiento`, `estado`) VALUES
(2, 1, 1, '2019-12-21', 134.5, 'venta de producto', 2, 1),
(3, 1, 1, '2019-12-21', 134.5, 'venta de producto', 2, 1),
(4, 1, 1, '2019-12-21', 13.45, 'venta de producto', 2, 1),
(5, 1, 1, '2019-12-21', 188.3, 'venta de producto', 2, 1),
(6, 1, 1, '2019-12-30', 201.75, 'venta de producto', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock`
--

CREATE TABLE `stock` (
  `id_stock` int(11) NOT NULL,
  `stock_actual` int(11) NOT NULL DEFAULT '0',
  `stock_minimo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `stock`
--

INSERT INTO `stock` (`id_stock`, `stock_actual`, `stock_minimo`) VALUES
(58, 34, 24),
(59, 970, 15),
(60, 0, 1),
(61, 0, 1),
(62, 0, 0),
(63, 0, 2),
(64, 4, 1),
(65, 0, 1),
(66, 206, 1),
(67, 0, 2),
(68, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_movimiento`
--

CREATE TABLE `tipo_movimiento` (
  `id_movimiento` int(2) NOT NULL,
  `tipo_transaccion` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_movimiento`
--

INSERT INTO `tipo_movimiento` (`id_movimiento`, `tipo_transaccion`, `nombre`) VALUES
(1, 1, 'Entrada'),
(2, 2, 'Salida'),
(3, 2, 'Anulación de compra'),
(4, 1, 'Anulación de venta'),
(5, 1, 'Devolucion de cliente'),
(6, 2, 'Devolucion a proveedor'),
(7, 1, 'Entrada, ajuste de inventario'),
(8, 2, 'Salida, ajuste de inventario'),
(9, 0, 'Conversión');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `rol` int(2) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `estado` tinyint(4) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `id_usuario_creacion`, `rol`, `usuario`, `correo`, `estado`, `password`) VALUES
(1, 0, 1, 'hugo', 'hugoale_ab2@hotmail.com', 1, 'd033e22ae348aeb5660fc2140aec35850c4da997');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ajustes`
--
ALTER TABLE `ajustes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `detalle_entrada`
--
ALTER TABLE `detalle_entrada`
  ADD PRIMARY KEY (`id_detalle_entrada`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_entrada` (`id_entrada`);

--
-- Indices de la tabla `detalle_salida`
--
ALTER TABLE `detalle_salida`
  ADD PRIMARY KEY (`id_detalle_salida`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_salida_2` (`id_salida`),
  ADD KEY `id_salida_3` (`id_salida`),
  ADD KEY `id_salida` (`id_salida`) USING BTREE;

--
-- Indices de la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`id_entrada`),
  ADD KEY `id_usuario` (`id_usuario`,`id_movimiento`,`id_proveedor`),
  ADD KEY `id_tipo_entrada` (`id_movimiento`),
  ADD KEY `id_proveedor` (`id_proveedor`);

--
-- Indices de la tabla `kardex`
--
ALTER TABLE `kardex`
  ADD PRIMARY KEY (`id_kardex`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_movimiento` (`id_movimiento`);

--
-- Indices de la tabla `lotes`
--
ALTER TABLE `lotes`
  ADD PRIMARY KEY (`id_lote`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id_permiso`);

--
-- Indices de la tabla `presentacion`
--
ALTER TABLE `presentacion`
  ADD PRIMARY KEY (`id_presentacion`);

--
-- Indices de la tabla `presentaciones_producto`
--
ALTER TABLE `presentaciones_producto`
  ADD PRIMARY KEY (`id_presentacion_producto`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD UNIQUE KEY `id_stock_2` (`id_stock`),
  ADD KEY `id_categoria` (`id_categoria`,`id_stock`),
  ADD KEY `id_stock` (`id_stock`),
  ADD KEY `id_marca` (`id_marca`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `salidas`
--
ALTER TABLE `salidas`
  ADD PRIMARY KEY (`id_salida`),
  ADD KEY `id_usuario` (`id_usuario`,`id_movimiento`),
  ADD KEY `id_tipo_salida` (`id_movimiento`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id_stock`);

--
-- Indices de la tabla `tipo_movimiento`
--
ALTER TABLE `tipo_movimiento`
  ADD PRIMARY KEY (`id_movimiento`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ajustes`
--
ALTER TABLE `ajustes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `detalle_entrada`
--
ALTER TABLE `detalle_entrada`
  MODIFY `id_detalle_entrada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de la tabla `detalle_salida`
--
ALTER TABLE `detalle_salida`
  MODIFY `id_detalle_salida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `entradas`
--
ALTER TABLE `entradas`
  MODIFY `id_entrada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de la tabla `kardex`
--
ALTER TABLE `kardex`
  MODIFY `id_kardex` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT de la tabla `lotes`
--
ALTER TABLE `lotes`
  MODIFY `id_lote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `presentacion`
--
ALTER TABLE `presentacion`
  MODIFY `id_presentacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `presentaciones_producto`
--
ALTER TABLE `presentaciones_producto`
  MODIFY `id_presentacion_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `salidas`
--
ALTER TABLE `salidas`
  MODIFY `id_salida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `stock`
--
ALTER TABLE `stock`
  MODIFY `id_stock` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT de la tabla `tipo_movimiento`
--
ALTER TABLE `tipo_movimiento`
  MODIFY `id_movimiento` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
