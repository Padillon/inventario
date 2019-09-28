-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-09-2019 a las 00:11:49
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre`, `estado`) VALUES
(1, 'Material', 1),
(2, 'Bebida', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `detalle_entrada`
--

INSERT INTO `detalle_entrada` (`id_detalle_entrada`, `cantidad`, `id_producto`, `precio`, `iva`, `subtotal`, `id_entrada`, `estado`) VALUES
(1, 10, 1, 14.45, 0, 144.5, 1, 1),
(2, 1, 1, 14.45, 0, 14.45, 2, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `detalle_salida`
--

INSERT INTO `detalle_salida` (`id_detalle_salida`, `cantidad`, `id_producto`, `precio_venta`, `iva`, `subtotal`, `id_salida`, `id_lote`) VALUES
(1, 3, 1, 0, 0, 0, 1, 1),
(2, 1, 1, 0, 0, 0, 2, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `entradas`
--

INSERT INTO `entradas` (`id_entrada`, `id_usuario`, `id_movimiento`, `fecha`, `total`, `id_proveedor`, `estado`) VALUES
(1, 1, 0, '2019-08-26', 144.5, 1, 1),
(2, 1, 0, '2019-08-27', 14.45, 1, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `kardex`
--

INSERT INTO `kardex` (`id_kardex`, `id_movimiento`, `fecha`, `descripcion`, `id_producto`, `cantidad`, `precio`, `total`, `saldo`, `id_entrada`, `id_salida`, `id_usuario`) VALUES
(1, 1, '2019-08-26', 'Compra de producto.', 1, 10, 14.45, 144.5, 144.5, 1, 0, 1),
(2, 2, '2019-08-26', 'Salida', 1, 3, 0, 0, 144.5, 0, 1, 1),
(3, 1, '2019-08-27', 'Compra de producto.', 1, 1, 14.45, 14.45, 158.95, 2, 0, 1),
(4, 3, '2019-08-27', 'Compra anulada.', 1, 1, 14.45, 14.45, 144.5, 2, 0, 1),
(5, 2, '2019-08-27', 'Salida', 1, 1, 0, 0, 144.5, 0, 2, 1),
(6, 4, '2019-08-27', 'Venta anulada.', 1, 1, 0, 0, 144.5, 0, 2, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf32 COLLATE=utf32_spanish2_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `lotes`
--

INSERT INTO `lotes` (`id_lote`, `id_producto`, `id_entrada`, `cantidad`, `fecha_entrada`, `fecha_caducidad`, `estado`) VALUES
(1, 1, 1, 7, '2019-08-26', '2019-08-30', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE IF NOT EXISTS `marcas` (
  `id_marca` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `estado` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_marca`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id_marca`, `nombre`, `estado`) VALUES
(1, 'Lactolac', 1),
(2, 'Nike', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(35) COLLATE utf8_spanish2_ci NOT NULL,
  `link` varchar(35) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id_menu`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=14 ;

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

CREATE TABLE IF NOT EXISTS `permisos` (
  `id_permiso` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(10) NOT NULL,
  `rol_id` int(2) NOT NULL,
  `read` int(2) NOT NULL,
  `insert` int(2) NOT NULL,
  `update` int(2) NOT NULL,
  `delete` int(2) NOT NULL,
  PRIMARY KEY (`id_permiso`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=17 ;

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

CREATE TABLE IF NOT EXISTS `presentacion` (
  `id_presentacion` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `estado` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_presentacion`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

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
  UNIQUE KEY `id_stock_2` (`id_stock`),
  KEY `id_categoria` (`id_categoria`,`id_stock`,`id_presentacion`),
  KEY `id_stock` (`id_stock`),
  KEY `id_presentacion` (`id_presentacion`),
  KEY `id_marca` (`id_marca`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `id_categoria`, `codigo`, `id_stock`, `nombre`, `descripcion`, `precio_compra`, `precio_venta`, `imagen`, `inventariable`, `id_presentacion`, `perecedero`, `estado`, `id_marca`) VALUES
(1, 1, '000100010001', 1, 'Mozzarella', 'Mozzarella para pizza, pan con ajo y gringas', 14.45, 0, 'mozzarella.jpg', 0, 4, 1, 1, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id_proveedor`, `nombre`, `empresa`, `telefono`, `estado`) VALUES
(1, 'Enrique', 'Lactolac', '7921-5833', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `salidas`
--

INSERT INTO `salidas` (`id_salida`, `id_usuario`, `id_cliente`, `fecha`, `total`, `descripcion`, `id_movimiento`, `estado`) VALUES
(1, 1, 1, '2019-08-26', 0, 'venta de producto', 0, 1),
(2, 1, 1, '2019-08-27', 0, 'venta de producto', 0, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `stock`
--

INSERT INTO `stock` (`id_stock`, `stock_actual`, `stock_inicial`, `stock_minimo`) VALUES
(1, 7, 0, 2);

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
  `id_usuario_creacion` int(11) NOT NULL,
  `rol` int(2) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `estado` tinyint(4) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `usuario` (`usuario`),
  UNIQUE KEY `correo` (`correo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `id_usuario_creacion`, `rol`, `usuario`, `correo`, `estado`, `password`) VALUES
(1, 0, 1, 'hugo', 'hugoale_ab2@hotmail.com', 1, 'd033e22ae348aeb5660fc2140aec35850c4da997'),
(2, 1, 1, 'Edward', 'baionz_hg@hotmail.com', 1, 'e3240071674a2d3febf0c612c4c60a0498e2375b');

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
