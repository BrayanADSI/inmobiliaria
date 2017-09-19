-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generaci√≥n: 08-03-2017 a las 12:49:23
-- Versi√≥n del servidor: 10.1.9-MariaDB
-- Versi√≥n de PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inmobiliaria_jn1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `abonos`
--

CREATE TABLE `abonos` (
  `idabonos` mediumint(9) NOT NULL,
  `valorabono` mediumint(9) NOT NULL,
  `fechaabono` date NOT NULL,
  `iddeudasabonos` mediumint(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `abonos`
--

INSERT INTO `abonos` (`idabonos`, `valorabono`, `fechaabono`, `iddeudasabonos`) VALUES
(1, 10000, '2017-02-20', 4),
(2, 30000, '2016-10-19', 9),
(3, 210000, '2016-09-05', 14),
(4, 65000, '2016-09-13', 9),
(5, 65000, '2016-09-08', 33),
(6, 42200, '0000-00-00', 9),
(7, 100000, '2016-09-08', 45),
(8, 680000, '2016-11-17', 78);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arriendo`
--

CREATE TABLE `arriendo` (
  `id_Arriendo` mediumint(9) NOT NULL,
  `Fecha_Arriendo` date NOT NULL,
  `id_Cedula_Cliente_Arriendo` int(11) NOT NULL,
  `id_inmobiliario_Arriendo` tinyint(4) NOT NULL,
  `id_Tipo_Arriendo` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `arriendo`
--

INSERT INTO `arriendo` (`id_Arriendo`, `Fecha_Arriendo`, `id_Cedula_Cliente_Arriendo`, `id_inmobiliario_Arriendo`, `id_Tipo_Arriendo`) VALUES
(21, '2016-12-20', 12364525, 1, 11),
(22, '2016-08-03', 30204705, 2, 12),
(23, '2016-12-24', 256784236, 1, 13),
(24, '2016-12-01', 99030203, 4, 14),
(25, '2016-12-01', 256784236, 5, 15),
(26, '2016-12-01', 91010770, 1, 16),
(27, '2016-12-01', 91010770, 2, 17),
(28, '2016-12-01', 1018476700, 8, 18),
(29, '2016-12-01', 2135698523, 9, 19),
(30, '2016-12-01', 2145698745, 10, 20),
(31, '2017-02-24', 256784236, 7, 18),
(34, '2017-02-28', 256784236, 8, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditoria`
--

CREATE TABLE `auditoria` (
  `idauditoria` int(11) NOT NULL,
  `fechaauditoria` date NOT NULL,
  `descripcionauditoria` varchar(90) COLLATE utf8_spanish_ci NOT NULL,
  `idusuariosauditorias` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `auditoria`
--

INSERT INTO `auditoria` (`idauditoria`, `fechaauditoria`, `descripcionauditoria`, `idusuariosauditorias`) VALUES
(15, '2016-08-24', 'se realiza auditoria, la empresa se encuentra la documentaci√≥n y pagos al d√≠a ', 4),
(96, '2016-07-28', 'se realiza auditoria al vendedor 1 y se encuentra que cumple sus metas mensuales de ventas', 3),
(102, '2016-08-19', 'se realiza auditoria a la secretaria y se encuentran documentos y registros de pago al dia', 2),
(104578, '2016-10-18', 'se realiza auditoria y se encuentran todos los documentos en orden y al d√≠a ', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `canon`
--

CREATE TABLE `canon` (
  `idCanon` mediumint(9) NOT NULL,
  `valorArriendoCanon` mediumint(9) NOT NULL,
  `fechaCanon` date NOT NULL,
  `Forma_Pago` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `idArriendoCanon` mediumint(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `canon`
--

INSERT INTO `canon` (`idCanon`, `valorArriendoCanon`, `fechaCanon`, `Forma_Pago`, `idArriendoCanon`) VALUES
(1, 580, '2016-12-20', 'Efectivo', 21),
(2, 580, '2016-12-01', 'efectivo', 22),
(3, 580, '2016-11-09', 'efectivo', 23),
(4, 580, '2016-12-05', 'efectivo', 24),
(5, 590, '2016-12-23', 'dos cuotas', 30),
(6, 580, '2016-11-06', 'efectivo', 26),
(7, 580, '2016-11-20', 'efectivo', 27),
(9, 580, '2016-11-01', 'efectivo', 29);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `idcedulaCliente` int(10) NOT NULL,
  `nombreCliente` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `telefonoCliente` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `direccionCliente` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `emailCliente` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `fechaRegistroCliente` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idcedulaCliente`, `nombreCliente`, `telefonoCliente`, `direccionCliente`, `emailCliente`, `fechaRegistroCliente`) VALUES
(12364525, 'brayan castellanos', '3144307774', 'cra9¬∑5-7', 'bacastellanos@hotmail.com', '2016-10-03'),
(30204705, 'esperanza fajardo', '3212048810', 'cra 10¬∑17-100', 'esperanzaf@hotmail.com', '2016-09-01'),
(91010770, 'nelson marina', '3144406020', 'cra 10¬∑!7-100', 'nelsonm@hotmail.com', '2016-05-22'),
(99030203, 'melissa marin fajardo', '3144213220', 'cra 10¬∑17', 'melissahya@hotmail.com', '2016-03-02'),
(256784236, 'edid hernandez', '3145235236', 'cra 15¬∑7-8', 'edidh@hotmail.com', '2016-02-14'),
(802314520, 'edilma tavera', '3124806948', 'cra 5¬∑5-12', 'edilmat@hotmail.com', '2016-12-27'),
(895623147, 'miguel mu√±oz', '3127913796', 'cra 6¬∑4-5', 'miguelm@hotmail.com', '2016-12-01'),
(1018476700, 'daniela colmenare', '3165351902', 'cra 7 10-10', 'dforero007@hotmail.com', '2016-06-21'),
(2135698523, 'nayi ca√±as', '3214036985', 'cra 7 10-10', 'nayic@hotmail.com', '2016-07-30'),
(2145698745, 'keidy aranda suares', '312334654', 'cra 15¬∑7-9', 'keiya@hotmail.com', '2016-06-20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deudas`
--

CREATE TABLE `deudas` (
  `idDeudas` mediumint(9) NOT NULL,
  `valorDeuda` mediumint(9) NOT NULL,
  `fechaDeuda` date NOT NULL,
  `saldoDeuda` int(11) NOT NULL,
  `idPagosDeudas` mediumint(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `deudas`
--

INSERT INTO `deudas` (`idDeudas`, `valorDeuda`, `fechaDeuda`, `saldoDeuda`, `idPagosDeudas`) VALUES
(4, 190000, '2015-11-07', 20000, 99),
(9, 90000, '2016-05-18', 60000, 28),
(14, 360000, '2016-08-09', 150000, 11),
(15, 50000, '2016-02-09', 15000, 10),
(33, 95000, '2016-09-13', 30000, 33),
(39, 580000, '2016-02-24', 158000, 85),
(45, 128000, '2016-01-12', 280000, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inmobiliario`
--

CREATE TABLE `inmobiliario` (
  `idInmobiliario` tinyint(4) NOT NULL,
  `descripcionInmobiliario` varchar(70) COLLATE utf8_spanish_ci NOT NULL,
  `direccionInmobiliario` varchar(70) COLLATE utf8_spanish_ci NOT NULL,
  `GpsInmobiliario` point NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `inmobiliario`
--

INSERT INTO `inmobiliario` (`idInmobiliario`, `descripcionInmobiliario`, `direccionInmobiliario`, `GpsInmobiliario`) VALUES
(1, 'local de motos', 'diag 18 con calle 19 impar', '\0\0\0\0\0\0\0ÓZB>Ë@öôôôô©O¿'),
(2, 'local de carpinteria', 'diagonal 18 con calle 19 impar', '\0\0\0\0\0\0\0π¸áÙ€@öôôôô©O¿'),
(3, 'local de latoneria automotriz', 'diagonal 18 con calle 19 impar', '\0\0\0\0\0\0\0π¸áÙ€@öôôôô©O¿'),
(4, 'taller de montallantas', 'diagonal 18 con calle 19 impar', '\0\0\0\0\0\0\0π¸áÙ€@öôôôô©O¿'),
(5, 'taller de mecanica automotriz', 'diagonal 18 con calle 19 impar', '\0\0\0\0\0\0\0π¸áÙ€@öôôôô©O¿'),
(6, 'local de motos', 'diag 18 con calle 19 impar', '\0\0\0\0\0\0\0π¸áÙ€@öôôôô©O¿'),
(7, 'taller de pintura para muebles', 'diagonal 18 con calle 19 impar', '\0\0\0\0\0\0\0π¸áÙ€@öôôôô©O¿'),
(8, 'taller de macanica', 'diagonal 18 con calle 19 impar', '\0\0\0\0\0\0\0π¸áÙ€@öôôôô©O¿'),
(9, 'lavadero de carros', 'diagonal 18 con calle 19 impar', '\0\0\0\0\0\0\0π¸áÙ€@öôôôô©O¿'),
(10, 'taller de exostos', 'diagonal 18 con calle 19 impar', '\0\0\0\0\0\0\0π¸áÙ€@öôôôô©O¿');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `idPagos` mediumint(9) NOT NULL,
  `valorPago` mediumint(9) NOT NULL,
  `fechaPago` date NOT NULL,
  `idCanonPagos` mediumint(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`idPagos`, `valorPago`, `fechaPago`, `idCanonPagos`) VALUES
(10, 50000, '2016-05-24', 1),
(11, 350000, '2016-05-16', 6),
(15, 200000, '2015-04-04', 7),
(28, 600000, '2016-08-25', 9),
(33, 450000, '2016-09-29', 3),
(45, 85000, '2016-07-12', 3),
(60, 150000, '2015-07-12', 2),
(85, 250000, '2015-01-24', 5),
(92, 3333, '2016-10-31', 1),
(99, 300004, '2016-11-02', 6),
(101, 545454, '2017-02-27', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `idroles` tinyint(4) NOT NULL,
  `nombrerol` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `clienteroles` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `tipodearriendoroles` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `abonosroles` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `deudasroles` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `arriendoroles` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `pagosroles` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `inmobiliarioroles` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `canonroles` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `usuariosroles` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `auditoriasroles` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `rolesroles` varchar(4) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`idroles`, `nombrerol`, `clienteroles`, `tipodearriendoroles`, `abonosroles`, `deudasroles`, `arriendoroles`, `pagosroles`, `inmobiliarioroles`, `canonroles`, `usuariosroles`, `auditoriasroles`, `rolesroles`) VALUES
(1, 'ADMIN', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD'),
(2, 'SECRETARIA', 'CRUD', 'CRUD', 'CRUD', 'crud', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'R', 'CRUD'),
(3, 'VENDEDOR', 'CRUD', 'CRUD', 'R', 'R', 'CRUD', 'R', 'CRUD', 'R', 'R', 'R', 'R'),
(4, 'GERENTE', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD'),
(5, 'VENDEDOR', 'crud', 'CRUD', 'R', 'R', 'R', 'crud', 'CRUD', 'R', 'R', 'R', 'R'),
(6, 'operador', 'CRUD', 'CRUD', 'R', 'R', 'R', 'CRUD', 'CRUD', 'RU', 'h', 'j', 'k'),
(7, '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoarriendo`
--

CREATE TABLE `tipoarriendo` (
  `idtipodearriendo` tinyint(4) NOT NULL,
  `descripcionarriendo` varchar(80) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipoarriendo`
--

INSERT INTO `tipoarriendo` (`idtipodearriendo`, `descripcionarriendo`) VALUES
(11, 'la forma de pago es en efectivo y este se hace los 5 primeros dias de cada mes.'),
(12, 'Pago mes vencido'),
(13, 'Pago mes anticipado'),
(14, 'Pago en dos cuotas al mes'),
(15, 'Pago con debito automatico'),
(16, 'la forma de pago es en efectivo y este se hace los 5 primeros dias de cada mes.'),
(17, 'la forma de pago es en efectivo y este se hace los 5 primeros dias de cada mes.'),
(18, 'la forma de pago es en efectivo y este se hace los 5 primeros dias de cada mes.'),
(19, 'la forma de pago es en efectivo y este se hace los 5 primeros dias de cada mes.'),
(20, 'la forma de pago es en efectivo y este se hace los 5 primeros dias de cada mes.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuarios` tinyint(4) NOT NULL,
  `nombreusuario` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `emailusuario` varchar(70) COLLATE utf8_spanish_ci NOT NULL,
  `claveusuario` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `celularusuario` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `fecharegistrousuario` date NOT NULL,
  `fechaultimaclave` date NOT NULL,
  `idrolesusuarios` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuarios`, `nombreusuario`, `emailusuario`, `claveusuario`, `celularusuario`, `fecharegistrousuario`, `fechaultimaclave`, `idrolesusuarios`) VALUES
(1, 'JOSE NELSON MARIN ORTIZ', 'jninmobiliaria@hotmail.com', '123456', '3142406929', '2016-04-12', '2016-10-01', 1),
(2, 'Daniela Colmenares', 'dcolmenares@hotmail.com', '321654', '3165351902', '2016-05-18', '2016-09-27', 2),
(3, 'Brayan Castellanos', 'bcastellanos@hotmail.com', '789456', '3214371444', '2016-09-09', '2016-11-10', 3),
(4, 'Melissa Marin ', 'melissamarin@hotmail.com', '147852', '3144213220', '2016-04-30', '2016-08-19', 4),
(5, 'Edith Hernandez', 'ehernandez@hotmail.com', '123456789', '3144807650', '2016-10-13', '2016-11-30', 5);

--
-- √çndices para tablas volcadas
--

--
-- Indices de la tabla `abonos`
--
ALTER TABLE `abonos`
  ADD PRIMARY KEY (`idabonos`);

--
-- Indices de la tabla `arriendo`
--
ALTER TABLE `arriendo`
  ADD PRIMARY KEY (`id_Arriendo`),
  ADD KEY `id_Cedula_Cliente_Arriendo` (`id_Cedula_Cliente_Arriendo`),
  ADD KEY `id_Iinmobiliario_Arriendo` (`id_inmobiliario_Arriendo`),
  ADD KEY `id_Tipo_Arriendo` (`id_Tipo_Arriendo`);

--
-- Indices de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  ADD PRIMARY KEY (`idauditoria`),
  ADD KEY `idusuariosauditorias` (`idusuariosauditorias`);

--
-- Indices de la tabla `canon`
--
ALTER TABLE `canon`
  ADD PRIMARY KEY (`idCanon`),
  ADD KEY `id_Arriendo_Canon` (`idArriendoCanon`),
  ADD KEY `id_Arriendo_Canon_2` (`idArriendoCanon`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idcedulaCliente`);

--
-- Indices de la tabla `deudas`
--
ALTER TABLE `deudas`
  ADD PRIMARY KEY (`idDeudas`),
  ADD KEY `idpagosdeudas` (`idPagosDeudas`);

--
-- Indices de la tabla `inmobiliario`
--
ALTER TABLE `inmobiliario`
  ADD PRIMARY KEY (`idInmobiliario`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`idPagos`),
  ADD KEY `id_canon_pagos` (`idCanonPagos`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idroles`);

--
-- Indices de la tabla `tipoarriendo`
--
ALTER TABLE `tipoarriendo`
  ADD PRIMARY KEY (`idtipodearriendo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuarios`),
  ADD KEY `idrolesusuarios` (`idrolesusuarios`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `abonos`
--
ALTER TABLE `abonos`
  MODIFY `idabonos` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `arriendo`
--
ALTER TABLE `arriendo`
  MODIFY `id_Arriendo` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  MODIFY `idauditoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104579;
--
-- AUTO_INCREMENT de la tabla `canon`
--
ALTER TABLE `canon`
  MODIFY `idCanon` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `deudas`
--
ALTER TABLE `deudas`
  MODIFY `idDeudas` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `idPagos` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `idroles` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `tipoarriendo`
--
ALTER TABLE `tipoarriendo`
  MODIFY `idtipodearriendo` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuarios` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `arriendo`
--
ALTER TABLE `arriendo`
  ADD CONSTRAINT `arriendo_ibfk_1` FOREIGN KEY (`id_Tipo_Arriendo`) REFERENCES `tipoarriendo` (`idtipodearriendo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fkcliente` FOREIGN KEY (`id_Cedula_Cliente_Arriendo`) REFERENCES `cliente` (`idcedulaCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fkinmobiliario` FOREIGN KEY (`id_inmobiliario_Arriendo`) REFERENCES `inmobiliario` (`idInmobiliario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `auditoria`
--
ALTER TABLE `auditoria`
  ADD CONSTRAINT `auditoria_ibfk_1` FOREIGN KEY (`idusuariosauditorias`) REFERENCES `usuarios` (`idusuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `canon`
--
ALTER TABLE `canon`
  ADD CONSTRAINT `canon_ibfk_1` FOREIGN KEY (`idArriendoCanon`) REFERENCES `arriendo` (`id_Arriendo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `deudas`
--
ALTER TABLE `deudas`
  ADD CONSTRAINT `deudas_ibfk_1` FOREIGN KEY (`idPagosDeudas`) REFERENCES `pagos` (`idPagos`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `pagos_ibfk_1` FOREIGN KEY (`idCanonPagos`) REFERENCES `canon` (`idCanon`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fkroles` FOREIGN KEY (`idrolesusuarios`) REFERENCES `roles` (`idroles`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
