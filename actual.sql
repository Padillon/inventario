-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-05-2019 a las 06:10:17
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.3

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
(1, 'Kode-Lab', 'San Miguel', '138513-0', 'venta de ropa', 'xadmiracion_jpg_pagespeed_ic_imagenes-plantillas-caras-crear-hacer-memes-memegenerator.jpg', '6109-9440', 'holak@hace.com');

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
(1, 'Bebe', 1),
(2, 'calzado', 1),
(3, 'calzado mujer', 1),
(4, 'kony', 0),
(5, 'hola', 0),
(6, 'g', 0),
(10, 'oilo', 1),
(11, 'lola', 1),
(15, 'jio', 1),
(16, 'jio', 1),
(17, 'guy', 1),
(18, 'guy', 1),
(19, 'tggg', 1),
(20, '444', 1),
(21, 'tt', 1),
(22, 'rre', 1),
(23, 'oooo', 1),
(24, 'fifoo', 0),
(25, 'fffffffffffffffffffffffffff', 0),
(26, 'j', 0),
(27, 'fffffffserrr', 1),
(28, 'mujer', 1),
(29, 'hombre', 1),
(30, 'anime', 1),
(31, 'niño', 1),
(32, 'nombre', 1),
(33, 'nombre', 1);

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
(1, 'hugo', 'amaya', '888888888888888888888', '90900', '90909', '0909', 0),
(2, 'zulmita', 'Amaya', 'j', '65j', 'j', 'j', 1),
(3, 'michi', '', '', '', '', 'Conchagua', 0),
(4, 'Abigail', 'Mejia', '', '', '', 'San Antonio Silva', 1),
(5, 'Carlos', '', '', '', '', '', 0),
(6, 'Izuku', 'Midoriya', '', '', '', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_entrada`
--

CREATE TABLE `detalle_entrada` (
  `id_detalle_entrada` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `precio` double NOT NULL,
  `iva` double NOT NULL,
  `subtotal` double NOT NULL,
  `id_entrada` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_entrada`
--

INSERT INTO `detalle_entrada` (`id_detalle_entrada`, `cantidad`, `id_producto`, `precio`, `iva`, `subtotal`, `id_entrada`, `estado`) VALUES
(1, 2, 7, 5, 0, 10, 1, 0),
(2, 3, 8, 0.25, 0, 0.75, 1, 0),
(3, 3, 8, 0.25, 0, 0.75, 2, 1),
(4, 2, 8, 1, 0, 2, 3, 1),
(5, 10, 8, 1, 0, 10, 4, 1),
(6, 5, 13, 14.45, 0, 72.25, 5, 0),
(7, 11, 10, 32, 0, 352, 6, 1),
(8, 9, 10, 32, 0, 288, 7, 1),
(9, 1, 13, 14.45, 0, 14.45, 8, 1),
(10, 1, 10, 32, 0, 32, 8, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_salida`
--

CREATE TABLE `detalle_salida` (
  `id_detalle_salida` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `precio_venta` double NOT NULL,
  `iva` double NOT NULL,
  `subtotal` double NOT NULL,
  `id_salida` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_salida`
--

INSERT INTO `detalle_salida` (`id_detalle_salida`, `cantidad`, `id_producto`, `precio_venta`, `iva`, `subtotal`, `id_salida`) VALUES
(1, 1, 10, 36, 0, 36, 6),
(2, 1, 10, 36, 0, 36, 7),
(3, 1, 10, 36, 0, 36, 8),
(4, 1, 10, 36, 0, 36, 9),
(5, 1, 10, 36, 0, 36, 10),
(6, 15, 10, 36, 0, 540, 11),
(7, 1, 11, 5, 0, 5, 12),
(9, 0, 10, 36, 0, 0, 13),
(10, 1, 10, 36, 0, 36, 14),
(11, 1, 10, 36, 0, 36, 15),
(12, 1, 10, 36, 0, 36, 16),
(14, 1, 11, 5, 0, 5, 17),
(16, 1, 10, 36, 0, 36, 18),
(18, 1, 10, 36, 0, 36, 19),
(19, 1, 11, 5, 0, 5, 19),
(20, 1, 10, 36, 0, 36, 20),
(21, 1, 11, 5, 0, 5, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `id_detalle_venta` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `precio` varchar(45) NOT NULL,
  `cantidad` varchar(45) NOT NULL,
  `importe` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas`
--

CREATE TABLE `entradas` (
  `id_entrada` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_tipo_entrada` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `total` double NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `estado` tinyint(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `entradas`
--

INSERT INTO `entradas` (`id_entrada`, `id_usuario`, `id_tipo_entrada`, `fecha`, `total`, `id_proveedor`, `estado`) VALUES
(1, 1, 1, '2019-04-26', 10.75, 1, 0),
(2, 1, 1, '2019-04-26', 0.75, 2, 1),
(3, 1, 1, '2019-04-26', 2, 1, 1),
(4, 1, 1, '2019-04-26', 10, 1, 1),
(5, 1, 1, '2019-05-01', 72.25, 1, 0),
(6, 1, 1, '2019-05-03', 352, 1, 1),
(7, 1, 1, '2019-05-03', 288, 1, 1),
(8, 1, 1, '2019-05-03', 46.45, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kardex`
--

CREATE TABLE `kardex` (
  `id_kardex` int(11) NOT NULL,
  `fecha` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_entrada` int(11) NOT NULL,
  `id_salida` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'Lactolacc', 1),
(2, 'Gumarsal', 0),
(3, 'Gumarsal', 0),
(4, 'Size', 0),
(5, 'nike', 1),
(6, 'ya', 1),
(7, 'Hers', 0),
(8, 'Bebe', 0),
(9, 'Bebe', 1),
(10, 'Hers', 0),
(11, 'Hers', 1);

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
(2, 'Caja', 1),
(3, 'Estuche', 0),
(4, 'Docena', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
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
  `id_marca` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `id_categoria`, `codigo`, `id_stock`, `nombre`, `descripcion`, `precio_compra`, `precio_venta`, `imagen`, `inventariable`, `id_presentacion`, `perecedero`, `estado`, `id_marca`) VALUES
(3, 4, 'as', 5, 'haaa prroasass', 'ughkhll', -0.01, 0.01, '', 0, 2, 1, 0, NULL),
(4, 2, 's', 7, 'jejeje', '0', 0.02, 0.01, '', 0, 1, 0, 1, NULL),
(5, 1, '', 9, '0', '0', 0, 0, '', 0, 1, 0, 1, NULL),
(6, 1, '', 10, '0', '0', 0, 0, '', 0, 1, 0, 1, NULL),
(7, 11, '5xll', 12, 'Pizza', '0', 5, 10, 'el-meme-surgio-a-partir.jpg', 0, 1, 0, 1, NULL),
(8, 1, '666', 13, 'calzone', 'toalla', 1, 1.35, '', 0, 1, 0, 1, NULL),
(9, 28, 'xxxxx', 14, 'selena', 'muñeca', 5.2, 10.25, '', 0, 1, 1, 1, NULL),
(10, 5, 'bloomer primavera3', 17, 'Bloomer', 'blanco', 32, 36, 'Dibujos-de-Felicidad-a-lápiz-300x300.jpg', 0, 4, 0, 1, 7),
(11, 10, 'frerr', 18, 'blusa', 'algodon', 3, 5, '', 0, 1, 0, 1, 5),
(12, 5, 'pr', 19, 'pericazo', 'blanco', 1, 6, '', 0, 1, 0, 1, 7),
(13, 1, '55555', 20, 'harina', 'harina 45 libras', 14.45, 0, '', 0, 1, 1, 1, 2);

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
(1, 'Francisco', 'Hers', '4444400000', 1),
(2, 'Javier', 'RosmyLove', '4443222', 0),
(3, 'Baltazar', 'Creaciones Jeanett', '3333', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salidas`
--

CREATE TABLE `salidas` (
  `id_salida` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `total` double NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `id_tipo_salida` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `salidas`
--

INSERT INTO `salidas` (`id_salida`, `id_usuario`, `fecha`, `total`, `descripcion`, `id_tipo_salida`, `estado`) VALUES
(1, 1, '2019-05-03', 36, 'venta de producto', 1, 1),
(2, 1, '2019-05-03', 36, 'venta de producto', 1, 1),
(3, 1, '2019-05-03', 36, 'venta de producto', 1, 1),
(4, 1, '2019-05-03', 36, 'venta de producto', 1, 1),
(5, 1, '2019-05-03', 36, 'venta de producto', 1, 1),
(6, 1, '2019-05-03', 36, 'venta de producto', 1, 1),
(7, 1, '2019-05-03', 36, 'venta de producto', 1, 1),
(8, 1, '2019-05-03', 36, 'venta de producto', 1, 1),
(9, 1, '2019-05-03', 36, 'venta de producto', 1, 1),
(10, 1, '2019-05-03', 36, 'venta de producto', 1, 1),
(11, 1, '2019-05-03', 540, 'venta de producto', 1, 1),
(12, 1, '2019-05-03', 41, 'venta de producto', 1, 1),
(13, 1, '2019-05-03', 0, 'venta de producto', 1, 1),
(14, 1, '2019-05-03', 36, 'venta de producto', 1, 1),
(15, 1, '2019-05-03', 36, 'venta de producto', 1, 1),
(16, 1, '2019-05-03', 41, 'venta de producto', 1, 1),
(17, 1, '2019-05-03', 41, 'venta de producto', 1, 1),
(18, 1, '2019-05-03', 41, 'venta de producto', 1, 1),
(19, 1, '2019-05-03', 41, 'venta de producto', 1, 1),
(20, 1, '2019-05-03', 41, 'venta de producto', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock`
--

CREATE TABLE `stock` (
  `id_stock` int(11) NOT NULL,
  `stock_actual` int(11) NOT NULL,
  `stock_inicial` int(11) NOT NULL,
  `stock_minimo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `stock`
--

INSERT INTO `stock` (`id_stock`, `stock_actual`, `stock_inicial`, `stock_minimo`) VALUES
(1, 0, 0, 0),
(2, 0, 0, 10),
(3, 0, 0, 5),
(4, 0, 0, 2),
(5, 0, 0, 10),
(6, 0, 0, 0),
(7, 0, 0, 1),
(8, 0, 0, 1),
(9, 0, 0, 0),
(10, 0, 0, 0),
(11, 0, 0, 0),
(12, 2, 0, 10),
(13, 24, 0, 10),
(14, 0, 0, 9),
(15, 0, 0, 3),
(16, 0, 0, 3),
(17, -5, 0, 3),
(18, -4, 0, 4),
(19, 0, 0, 3),
(20, 1, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_comprobante`
--

CREATE TABLE `tipo_comprobante` (
  `id_tipo_comprobante` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `iva` int(11) NOT NULL,
  `serie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_comprobante`
--

INSERT INTO `tipo_comprobante` (`id_tipo_comprobante`, `nombre`, `cantidad`, `iva`, `serie`) VALUES
(1, 'Factura', 1, 0, 0),
(2, 'Ticket', 5, 0, 1),
(3, 'Cotización', 0, 0, 0),
(4, 'Crédito Fiscal', 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_entrada`
--

CREATE TABLE `tipo_entrada` (
  `id_tipo_entrada` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_entrada`
--

INSERT INTO `tipo_entrada` (`id_tipo_entrada`, `nombre`) VALUES
(1, 'normal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_salida`
--

CREATE TABLE `tipo_salida` (
  `id_tipo_salida` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_salida`
--

INSERT INTO `tipo_salida` (`id_tipo_salida`, `nombre`) VALUES
(1, 'Nomral');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre_empresa` varchar(45) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `estado` tinyint(4) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_empresa`, `usuario`, `correo`, `estado`, `password`) VALUES
(1, 'Kode-Lab', 'konny', 'pinchehugochan@gmail.com', 1, 'd033e22ae348aeb5660fc2140aec35850c4da997');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `serie` varchar(45) NOT NULL,
  `subtotal` double NOT NULL,
  `iva` double NOT NULL,
  `descuento` double NOT NULL,
  `total` double NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `num_documento` varchar(45) NOT NULL,
  `id_tipo_comprobante` int(11) NOT NULL,
  `estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`id_detalle_venta`),
  ADD KEY `id_producto` (`id_producto`,`id_venta`),
  ADD KEY `id_venta` (`id_venta`);

--
-- Indices de la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`id_entrada`),
  ADD KEY `id_usuario` (`id_usuario`,`id_tipo_entrada`,`id_proveedor`),
  ADD KEY `id_tipo_entrada` (`id_tipo_entrada`),
  ADD KEY `id_proveedor` (`id_proveedor`);

--
-- Indices de la tabla `kardex`
--
ALTER TABLE `kardex`
  ADD PRIMARY KEY (`id_kardex`),
  ADD KEY `id_producto` (`id_producto`,`id_entrada`,`id_salida`),
  ADD KEY `id_salida` (`id_salida`),
  ADD KEY `id_entrada` (`id_entrada`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indices de la tabla `presentacion`
--
ALTER TABLE `presentacion`
  ADD PRIMARY KEY (`id_presentacion`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_categoria` (`id_categoria`,`id_stock`,`id_presentacion`),
  ADD KEY `id_stock` (`id_stock`),
  ADD KEY `id_presentacion` (`id_presentacion`),
  ADD KEY `id_marca` (`id_marca`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `salidas`
--
ALTER TABLE `salidas`
  ADD PRIMARY KEY (`id_salida`),
  ADD KEY `id_usuario` (`id_usuario`,`id_tipo_salida`),
  ADD KEY `id_tipo_salida` (`id_tipo_salida`);

--
-- Indices de la tabla `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id_stock`);

--
-- Indices de la tabla `tipo_comprobante`
--
ALTER TABLE `tipo_comprobante`
  ADD PRIMARY KEY (`id_tipo_comprobante`);

--
-- Indices de la tabla `tipo_entrada`
--
ALTER TABLE `tipo_entrada`
  ADD PRIMARY KEY (`id_tipo_entrada`);

--
-- Indices de la tabla `tipo_salida`
--
ALTER TABLE `tipo_salida`
  ADD PRIMARY KEY (`id_tipo_salida`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `id_cliente` (`id_cliente`,`id_usuario`,`id_tipo_comprobante`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_tipo_comprobante` (`id_tipo_comprobante`);

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
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `detalle_entrada`
--
ALTER TABLE `detalle_entrada`
  MODIFY `id_detalle_entrada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `detalle_salida`
--
ALTER TABLE `detalle_salida`
  MODIFY `id_detalle_salida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `id_detalle_venta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `entradas`
--
ALTER TABLE `entradas`
  MODIFY `id_entrada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `kardex`
--
ALTER TABLE `kardex`
  MODIFY `id_kardex` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `presentacion`
--
ALTER TABLE `presentacion`
  MODIFY `id_presentacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `salidas`
--
ALTER TABLE `salidas`
  MODIFY `id_salida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `stock`
--
ALTER TABLE `stock`
  MODIFY `id_stock` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `tipo_comprobante`
--
ALTER TABLE `tipo_comprobante`
  MODIFY `id_tipo_comprobante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tipo_entrada`
--
ALTER TABLE `tipo_entrada`
  MODIFY `id_tipo_entrada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipo_salida`
--
ALTER TABLE `tipo_salida`
  MODIFY `id_tipo_salida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT;

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
-- Filtros para la tabla `detalle_salida`
--
ALTER TABLE `detalle_salida`
  ADD CONSTRAINT `detalle_salida_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`),
  ADD CONSTRAINT `detalle_salida_ibfk_2` FOREIGN KEY (`id_salida`) REFERENCES `salidas` (`id_salida`);

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `detalle_venta_ibfk_1` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id_venta`),
  ADD CONSTRAINT `detalle_venta_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD CONSTRAINT `entradas_ibfk_1` FOREIGN KEY (`id_tipo_entrada`) REFERENCES `tipo_entrada` (`id_tipo_entrada`),
  ADD CONSTRAINT `entradas_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `entradas_ibfk_4` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`);

--
-- Filtros para la tabla `kardex`
--
ALTER TABLE `kardex`
  ADD CONSTRAINT `kardex_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`),
  ADD CONSTRAINT `kardex_ibfk_2` FOREIGN KEY (`id_salida`) REFERENCES `salidas` (`id_salida`),
  ADD CONSTRAINT `kardex_ibfk_3` FOREIGN KEY (`id_entrada`) REFERENCES `entradas` (`id_entrada`),
  ADD CONSTRAINT `kardex_ibfk_4` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`),
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`id_stock`) REFERENCES `stock` (`id_stock`),
  ADD CONSTRAINT `productos_ibfk_3` FOREIGN KEY (`id_presentacion`) REFERENCES `presentacion` (`id_presentacion`),
  ADD CONSTRAINT `productos_ibfk_4` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id_marca`);

--
-- Filtros para la tabla `salidas`
--
ALTER TABLE `salidas`
  ADD CONSTRAINT `salidas_ibfk_1` FOREIGN KEY (`id_tipo_salida`) REFERENCES `tipo_salida` (`id_tipo_salida`),
  ADD CONSTRAINT `salidas_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`),
  ADD CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
