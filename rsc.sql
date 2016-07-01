-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 01-07-2016 a las 12:23:53
-- Versión del servidor: 5.7.12-0ubuntu1.1
-- Versión de PHP: 7.0.4-7ubuntu2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `rsc`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accion_centralizada`
--

CREATE TABLE `accion_centralizada` (
  `id` int(11) NOT NULL,
  `codigo_accion` varchar(45) NOT NULL,
  `codigo_accion_sne` varchar(45) NOT NULL,
  `nombre_accion` varchar(45) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `estatus` tinyint(1) NOT NULL,
  `aprobado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `accion_centralizada`
--

INSERT INTO `accion_centralizada` (`id`, `codigo_accion`, `codigo_accion_sne`, `nombre_accion`, `fecha_inicio`, `fecha_fin`, `estatus`, `aprobado`) VALUES
(3, '01', '01', 'probando', '2016-04-01', '2016-04-30', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accion_centralizada_accion_especifica`
--

CREATE TABLE `accion_centralizada_accion_especifica` (
  `id` int(11) NOT NULL,
  `id_ac_centr` int(11) NOT NULL,
  `cod_ac_espe` varchar(3) NOT NULL,
  `nombre` text NOT NULL,
  `estatus` tinyint(1) NOT NULL,
  `fecha_inicio` date NOT NULL COMMENT 'fecha de inicio de la acciones especifica',
  `fecha_fin` date NOT NULL COMMENT 'fecha fin de la accion especifica'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `accion_centralizada_accion_especifica`
--

INSERT INTO `accion_centralizada_accion_especifica` (`id`, `id_ac_centr`, `cod_ac_espe`, `nombre`, `estatus`, `fecha_inicio`, `fecha_fin`) VALUES
(7, 3, '01', 'probando', 1, '2016-04-01', '2016-04-30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accion_centralizada_ac_especifica_uej`
--

CREATE TABLE `accion_centralizada_ac_especifica_uej` (
  `id` int(11) NOT NULL,
  `id_ue` int(11) NOT NULL,
  `id_ac_esp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `accion_centralizada_ac_especifica_uej`
--

INSERT INTO `accion_centralizada_ac_especifica_uej` (`id`, `id_ue`, `id_ac_esp`) VALUES
(233, 600, 7),
(234, 601, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accion_centralizada_asignar`
--

CREATE TABLE `accion_centralizada_asignar` (
  `id` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `unidad_ejecutora` int(11) NOT NULL,
  `accion_especifica` int(11) NOT NULL,
  `estatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Relación entre usuarios, unidades ejecutoras y acciones específicas de una accion centralizada';

--
-- Volcado de datos para la tabla `accion_centralizada_asignar`
--

INSERT INTO `accion_centralizada_asignar` (`id`, `usuario`, `unidad_ejecutora`, `accion_especifica`, `estatus`) VALUES
(3, 2, 600, 7, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accion_centralizada_desbloqueo_mes`
--

CREATE TABLE `accion_centralizada_desbloqueo_mes` (
  `id` int(11) NOT NULL,
  `id_ejecucion` int(11) NOT NULL,
  `mes` int(11) NOT NULL COMMENT 'mes que se desbloquea/bloquea'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `accion_centralizada_desbloqueo_mes`
--

INSERT INTO `accion_centralizada_desbloqueo_mes` (`id`, `id_ejecucion`, `mes`) VALUES
(19, 34, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accion_centralizada_pedido`
--

CREATE TABLE `accion_centralizada_pedido` (
  `id` int(11) NOT NULL,
  `id_material` int(11) NOT NULL,
  `enero` int(11) NOT NULL DEFAULT '0',
  `febrero` int(11) NOT NULL DEFAULT '0',
  `marzo` int(11) NOT NULL DEFAULT '0',
  `abril` int(11) NOT NULL DEFAULT '0',
  `mayo` int(11) NOT NULL DEFAULT '0',
  `junio` int(11) NOT NULL DEFAULT '0',
  `julio` int(11) NOT NULL DEFAULT '0',
  `agosto` int(11) NOT NULL DEFAULT '0',
  `septiembre` int(11) NOT NULL DEFAULT '0',
  `octubre` int(11) NOT NULL DEFAULT '0',
  `noviembre` int(11) NOT NULL DEFAULT '0',
  `diciembre` int(11) NOT NULL DEFAULT '0',
  `precio` decimal(12,2) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `asignado` int(11) NOT NULL COMMENT 'ID de la asignacion (Usuario-UE-AC)',
  `estatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accion_centralizada_variables`
--

CREATE TABLE `accion_centralizada_variables` (
  `id` int(11) NOT NULL,
  `nombre_variable` text NOT NULL,
  `unidad_medida` int(11) NOT NULL,
  `localizacion` int(11) NOT NULL,
  `definicion` text NOT NULL,
  `base_calculo` text NOT NULL,
  `fuente_informacion` text NOT NULL,
  `meta_programada_variable` int(11) NOT NULL,
  `unidad_ejecutora` int(11) NOT NULL,
  `acc_accion_especifica` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `accion_centralizada_variables`
--

INSERT INTO `accion_centralizada_variables` (`id`, `nombre_variable`, `unidad_medida`, `localizacion`, `definicion`, `base_calculo`, `fuente_informacion`, `meta_programada_variable`, `unidad_ejecutora`, `acc_accion_especifica`) VALUES
(31, 'Variable ACC 1', 2, 1, 'probando', 'dos', 'dos', 0, 600, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accion_centralizada_variables_usuarios`
--

CREATE TABLE `accion_centralizada_variables_usuarios` (
  `id` int(11) NOT NULL,
  `id_variable` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `accion_centralizada_variables_usuarios`
--

INSERT INTO `accion_centralizada_variables_usuarios` (`id`, `id_variable`, `id_usuario`, `estatus`) VALUES
(32, 31, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accion_centralizada_variable_ejecucion`
--

CREATE TABLE `accion_centralizada_variable_ejecucion` (
  `id` int(11) NOT NULL,
  `id_programacion` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `enero` int(11) DEFAULT NULL,
  `febrero` int(11) DEFAULT NULL,
  `marzo` int(11) DEFAULT NULL,
  `abril` int(11) DEFAULT NULL,
  `mayo` int(11) DEFAULT NULL,
  `junio` int(11) DEFAULT NULL,
  `julio` int(11) DEFAULT NULL,
  `agosto` int(11) DEFAULT NULL,
  `septiembre` int(11) DEFAULT NULL,
  `octubre` int(11) DEFAULT NULL,
  `noviembre` int(11) DEFAULT NULL,
  `diciembre` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `accion_centralizada_variable_ejecucion`
--

INSERT INTO `accion_centralizada_variable_ejecucion` (`id`, `id_programacion`, `id_usuario`, `fecha`, `enero`, `febrero`, `marzo`, `abril`, `mayo`, `junio`, `julio`, `agosto`, `septiembre`, `octubre`, `noviembre`, `diciembre`) VALUES
(32, 31, 2, '2016-06-23 19:22:43', 102, 200, 10, 22, 4, 12, NULL, NULL, NULL, NULL, NULL, 300),
(34, 29, 2, '2016-06-23 23:38:39', 99880, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accion_centralizada_variable_programacion`
--

CREATE TABLE `accion_centralizada_variable_programacion` (
  `id` int(11) NOT NULL,
  `id_localizacion` int(11) DEFAULT NULL,
  `enero` decimal(10,0) DEFAULT NULL,
  `febrero` decimal(10,0) DEFAULT NULL,
  `marzo` decimal(10,0) DEFAULT NULL,
  `abril` decimal(10,0) DEFAULT NULL,
  `mayo` decimal(10,0) DEFAULT NULL,
  `junio` decimal(10,0) DEFAULT NULL,
  `julio` decimal(10,0) DEFAULT NULL,
  `agosto` decimal(10,0) DEFAULT NULL,
  `septiembre` decimal(10,0) DEFAULT NULL,
  `octubre` decimal(10,0) DEFAULT NULL,
  `noviembre` decimal(10,0) DEFAULT NULL,
  `diciembre` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `accion_centralizada_variable_programacion`
--

INSERT INTO `accion_centralizada_variable_programacion` (`id`, `id_localizacion`, `enero`, `febrero`, `marzo`, `abril`, `mayo`, `junio`, `julio`, `agosto`, `septiembre`, `octubre`, `noviembre`, `diciembre`) VALUES
(29, 51, '10', '12', '10', '6', '8', '9', '0', '20', '0', '0', '0', '0'),
(31, 54, '10', '10', '10', '0', '0', '0', '0', '0', '0', '0', '0', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ambito`
--

CREATE TABLE `ambito` (
  `id` int(11) NOT NULL,
  `ambito` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ambito`
--

INSERT INTO `ambito` (`id`, `ambito`) VALUES
(1, 'Internacional'),
(2, 'Nacional'),
(3, 'Regional'),
(4, 'Estadal'),
(5, 'Municipal'),
(6, 'Parroquial'),
(7, 'Comunal'),
(8, 'Otros');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `audit_data`
--

CREATE TABLE `audit_data` (
  `id` int(11) NOT NULL,
  `entry_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `data` blob,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `audit_entry`
--

CREATE TABLE `audit_entry` (
  `id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `user_id` int(11) DEFAULT '0',
  `duration` float DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `request_method` varchar(16) DEFAULT NULL,
  `ajax` int(1) NOT NULL DEFAULT '0',
  `route` varchar(255) DEFAULT NULL,
  `memory_max` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `audit_error`
--

CREATE TABLE `audit_error` (
  `id` int(11) NOT NULL,
  `entry_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `message` text NOT NULL,
  `code` int(11) DEFAULT '0',
  `file` varchar(512) DEFAULT NULL,
  `line` int(11) DEFAULT NULL,
  `trace` blob,
  `hash` varchar(32) DEFAULT NULL,
  `emailed` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `audit_javascript`
--

CREATE TABLE `audit_javascript` (
  `id` int(11) NOT NULL,
  `entry_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `type` varchar(20) NOT NULL,
  `message` text NOT NULL,
  `origin` varchar(512) DEFAULT NULL,
  `data` blob
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `audit_mail`
--

CREATE TABLE `audit_mail` (
  `id` int(11) NOT NULL,
  `entry_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `successful` int(11) NOT NULL,
  `from` varchar(255) DEFAULT NULL,
  `to` varchar(255) DEFAULT NULL,
  `reply` varchar(255) DEFAULT NULL,
  `cc` varchar(255) DEFAULT NULL,
  `bcc` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `text` blob,
  `html` blob,
  `data` blob
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `audit_trail`
--

CREATE TABLE `audit_trail` (
  `id` int(11) NOT NULL,
  `entry_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `model_id` varchar(255) NOT NULL,
  `field` varchar(255) DEFAULT NULL,
  `old_value` text,
  `new_value` text,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `audit_trail`
--

INSERT INTO `audit_trail` (`id`, `entry_id`, `user_id`, `action`, `model`, `model_id`, `field`, `old_value`, `new_value`, `created`) VALUES
(1, 5906, 2, 'UPDATE', 'common\\models\\Proyecto', '1', 'nombre', 'Lorem ipsum dolor sit amet, per an accusata petentium conceptam, an case causae oporteat mel. Te epicuri praesent constituam mel, semper recusabo dissentiet ea qui. Quo dictas prompta constituam et. Vis ea sale commodo, iriure fierent sed cu.', 'Lorem ipsum dolor sit amet, per an accusata petentium conceptam, an case causae oporteat mel. Te epicuri praesent constituam mel, semper recusabo dissentiet ea qui. Quo dictas prompta constituam et. Vis ea sale commodo.', '2016-04-07 20:52:52'),
(2, 6095, 2, 'UPDATE', 'common\\models\\Proyecto', '1', 'nombre', 'Lorem ipsum dolor sit amet, per an accusata petentium conceptam, an case causae oporteat mel. Te epicuri praesent constituam mel, semper recusabo dissentiet ea qui. Quo dictas prompta constituam et. Vis ea sale commodo. Te epicuri praesent constituam me.', 'Lorem ipsum dolor sit amet, per an accusata petentium conceptam, an case causae oporteat mel. Te epicuri praesent constituam mel, semper recusabo dissentiet ea qui. Quo dictas prompta constituam et.', '2016-04-07 22:22:26'),
(3, 6108, 2, 'UPDATE', 'common\\models\\ProyectoAccionEspecifica', '20', 'unidad_medida', '0', '1', '2016-04-07 22:24:50'),
(4, 6108, 2, 'UPDATE', 'common\\models\\ProyectoAccionEspecifica', '20', 'meta', '0', '5', '2016-04-07 22:24:50'),
(5, 6108, 2, 'UPDATE', 'common\\models\\ProyectoAccionEspecifica', '20', 'ponderacion', '0', '0.1', '2016-04-07 22:24:50'),
(6, 6108, 2, 'UPDATE', 'common\\models\\ProyectoAccionEspecifica', '20', 'bien_servicio', '', 'Ninguno', '2016-04-07 22:24:50'),
(7, 6108, 2, 'UPDATE', 'common\\models\\ProyectoAccionEspecifica', '20', 'estatus', '0', '1', '2016-04-07 22:24:50'),
(8, 6113, 2, 'UPDATE', 'common\\models\\ProyectoAccionEspecifica', '21', 'estatus', '0', '1', '2016-04-07 22:28:26'),
(9, 6400, 1, 'UPDATE', 'common\\models\\Proyecto', '1', 'fecha_inicio', '2016-01-01', '2016-01-15', '2016-04-08 01:53:34'),
(10, 6411, 1, 'UPDATE', 'common\\models\\Proyecto', '1', 'fecha_inicio', '2016-01-15', '2016-01-01', '2016-04-08 01:54:07'),
(11, 6426, 1, 'UPDATE', 'common\\models\\Proyecto', '1', 'estatus_proyecto', '1', '2', '2016-04-08 02:13:25'),
(12, 6429, 1, 'UPDATE', 'common\\models\\Proyecto', '1', 'estatus_proyecto', '2', '1', '2016-04-08 02:13:35'),
(13, 6597, 1, 'UPDATE', 'common\\models\\Proyecto', '1', 'monto_proyecto', '99999.00', '999999', '2016-04-08 03:40:14'),
(14, 7177, 2, 'UPDATE', 'common\\models\\Proyecto', '1', 'monto_proyecto', '999999.00', '999.999', '2016-04-11 03:18:02'),
(15, 7178, 2, 'UPDATE', 'common\\models\\Proyecto', '1', 'monto_proyecto', '1000.00', '1.000', '2016-04-11 03:18:40'),
(16, 7179, 2, 'UPDATE', 'common\\models\\Proyecto', '1', 'monto_proyecto', '1.00', '1,00', '2016-04-11 03:22:55'),
(17, 7180, 2, 'UPDATE', 'common\\models\\Proyecto', '1', 'monto_proyecto', '1.00', '1,00', '2016-04-11 03:23:27'),
(18, 7181, 2, 'UPDATE', 'common\\models\\Proyecto', '1', 'monto_proyecto', '1.00', '100', '2016-04-11 03:28:57'),
(19, 7182, 2, 'UPDATE', 'common\\models\\Proyecto', '1', 'monto_proyecto', '100.00', '10000', '2016-04-11 03:29:17'),
(20, 7183, 2, 'UPDATE', 'common\\models\\Proyecto', '1', 'monto_proyecto', '10000.00', '1000000', '2016-04-11 03:34:02'),
(21, 7184, 2, 'UPDATE', 'common\\models\\Proyecto', '1', 'monto_proyecto', '1000000.00', '100000000', '2016-04-11 03:34:21'),
(22, 7185, 2, 'UPDATE', 'common\\models\\Proyecto', '1', 'monto_proyecto', '99999999.99', '9999999999', '2016-04-11 03:35:07'),
(23, 7186, 2, 'UPDATE', 'common\\models\\Proyecto', '1', 'monto_proyecto', '99999999.99', '9999999999', '2016-04-11 03:37:29'),
(24, 7187, 2, 'UPDATE', 'common\\models\\Proyecto', '1', 'monto_proyecto', '99999999.99', '9999999999', '2016-04-11 03:37:37'),
(25, 7188, 2, 'UPDATE', 'common\\models\\Proyecto', '1', 'monto_proyecto', '99999999.99', '9999999999', '2016-04-11 03:38:09'),
(26, 7189, 2, 'UPDATE', 'common\\models\\Proyecto', '1', 'monto_proyecto', '99999999.99', '9999999999', '2016-04-11 03:38:25'),
(27, 7190, 2, 'UPDATE', 'common\\models\\Proyecto', '1', 'monto_proyecto', '99999999.99', '9999999999', '2016-04-11 03:38:33'),
(28, 7191, 2, 'UPDATE', 'common\\models\\Proyecto', '1', 'monto_proyecto', '99999999.99', '9999999999', '2016-04-11 03:38:44'),
(29, 7192, 2, 'UPDATE', 'common\\models\\Proyecto', '1', 'monto_proyecto', '99999999.99', '23.3', '2016-04-11 03:39:11'),
(30, 7193, 2, 'UPDATE', 'common\\models\\Proyecto', '1', 'monto_proyecto', '23.30', '15.12', '2016-04-11 03:39:49'),
(31, 7194, 2, 'UPDATE', 'common\\models\\Proyecto', '1', 'monto_proyecto', '15.12', '1512', '2016-04-11 03:40:31'),
(32, 7195, 2, 'UPDATE', 'common\\models\\Proyecto', '1', 'monto_proyecto', '1512.00', '151200', '2016-04-11 03:40:43'),
(33, 7196, 2, 'UPDATE', 'common\\models\\Proyecto', '1', 'monto_proyecto', '151200.00', '15120000', '2016-04-11 03:41:13'),
(34, 7197, 2, 'UPDATE', 'common\\models\\Proyecto', '1', 'monto_proyecto', '15120000.00', '1512000000', '2016-04-11 03:41:45'),
(35, 7198, 2, 'UPDATE', 'common\\models\\Proyecto', '1', 'monto_proyecto', '99999999.99', '9999999999', '2016-04-11 03:42:13'),
(36, 7199, 2, 'UPDATE', 'common\\models\\Proyecto', '1', 'monto_proyecto', '99999999.99', '9999999999', '2016-04-11 03:42:47'),
(37, 7200, 2, 'UPDATE', 'common\\models\\Proyecto', '1', 'monto_proyecto', '99999999.99', '9999999999', '2016-04-11 03:44:05'),
(38, 7201, 2, 'UPDATE', 'common\\models\\Proyecto', '1', 'monto_proyecto', '99999999.99', '9999999999', '2016-04-11 03:44:47'),
(39, 7202, 2, 'UPDATE', 'common\\models\\Proyecto', '1', 'monto_proyecto', '99999999.99', '9999999999', '2016-04-11 03:45:00'),
(40, 7203, 2, 'UPDATE', 'common\\models\\Proyecto', '1', 'monto_proyecto', '99999999.99', '9999999999.00', '2016-04-11 03:49:45'),
(41, 7204, 2, 'UPDATE', 'common\\models\\Proyecto', '1', 'monto_proyecto', '99999999.99', '9999999999.00', '2016-04-11 03:56:18'),
(42, 7205, 2, 'UPDATE', 'common\\models\\Proyecto', '1', 'monto_proyecto', '99999999.99', '9999999999.00', '2016-04-11 03:56:28'),
(43, 7206, 2, 'UPDATE', 'common\\models\\Proyecto', '1', 'monto_proyecto', '99999999.99', '9999999999.00', '2016-04-11 03:59:08'),
(44, 7207, 2, 'UPDATE', 'common\\models\\Proyecto', '1', 'monto_proyecto', '99999999.99', '9999999999.00', '2016-04-11 03:59:43'),
(45, 7208, 2, 'UPDATE', 'common\\models\\Proyecto', '1', 'monto_proyecto', '99999999.99', '9999999999.00', '2016-04-11 04:05:24'),
(46, 7209, 2, 'UPDATE', 'common\\models\\Proyecto', '1', 'monto_proyecto', '99999999.99', '9999999999.00', '2016-04-11 04:05:40'),
(47, 7210, 2, 'UPDATE', 'common\\models\\Proyecto', '1', 'monto_proyecto', '99999999.99', '1.51', '2016-04-11 04:06:17'),
(48, 7211, 2, 'UPDATE', 'common\\models\\Proyecto', '1', 'monto_proyecto', '1.51', '151.00', '2016-04-11 04:06:42'),
(49, 7212, 2, 'UPDATE', 'common\\models\\Proyecto', '1', 'monto_proyecto', '151.00', '15100.00', '2016-04-11 04:06:53'),
(50, 7213, 2, 'UPDATE', 'common\\models\\Proyecto', '1', 'monto_proyecto', '15100.00', '1510000.00', '2016-04-11 04:07:19'),
(51, 7225, 2, 'UPDATE', 'common\\models\\Proyecto', '1', 'monto_proyecto', '1510000.00', '151000000.00', '2016-04-11 04:10:48'),
(52, 7226, 2, 'UPDATE', 'common\\models\\Proyecto', '1', 'monto_proyecto', '99999999.99', '984465454.00', '2016-04-11 04:12:08'),
(53, 7227, 2, 'UPDATE', 'common\\models\\Proyecto', '1', 'monto_proyecto', '99999999.99', '9846846543.00', '2016-04-11 04:12:43'),
(54, 7228, 2, 'UPDATE', 'common\\models\\Proyecto', '1', 'monto_proyecto', '99999999.99', '7.45', '2016-04-11 04:14:00'),
(55, 7229, 2, 'UPDATE', 'common\\models\\Proyecto', '1', 'monto_proyecto', '7.45', '1.51', '2016-04-11 04:26:08'),
(56, 7230, 2, 'UPDATE', 'common\\models\\Proyecto', '1', 'monto_proyecto', '1.51', '5764.35', '2016-04-11 04:26:46'),
(57, 7242, 1, 'UPDATE', 'common\\models\\Proyecto', '1', 'monto_proyecto', '5764.35', '576.43', '2016-04-11 04:29:22'),
(58, 7249, 2, 'UPDATE', 'common\\models\\Proyecto', '1', 'monto_proyecto', '576.43', '514124.12', '2016-04-11 15:28:10'),
(59, 7310, 1, 'CREATE', 'common\\models\\ProyectoAsignar', '6', 'id', '', '6', '2016-04-11 15:39:58'),
(60, 7310, 1, 'CREATE', 'common\\models\\ProyectoAsignar', '6', 'usuario', '', '2', '2016-04-11 15:39:58'),
(61, 7310, 1, 'CREATE', 'common\\models\\ProyectoAsignar', '6', 'unidad_ejecutora', '', '1', '2016-04-11 15:39:58'),
(62, 7310, 1, 'CREATE', 'common\\models\\ProyectoAsignar', '6', 'accion_especifica', '', '20', '2016-04-11 15:39:58'),
(63, 7310, 1, 'CREATE', 'common\\models\\ProyectoAsignar', '6', 'estatus', '', '1', '2016-04-11 15:39:58'),
(64, 7313, 1, 'DELETE', 'common\\models\\ProyectoAsignar', '6', NULL, NULL, NULL, '2016-04-11 15:42:13'),
(65, 7317, 1, 'CREATE', 'common\\models\\ProyectoAsignar', '7', 'id', '', '7', '2016-04-11 15:42:44'),
(66, 7317, 1, 'CREATE', 'common\\models\\ProyectoAsignar', '7', 'usuario', '', '2', '2016-04-11 15:42:44'),
(67, 7317, 1, 'CREATE', 'common\\models\\ProyectoAsignar', '7', 'unidad_ejecutora', '', '1', '2016-04-11 15:42:44'),
(68, 7317, 1, 'CREATE', 'common\\models\\ProyectoAsignar', '7', 'accion_especifica', '', '20', '2016-04-11 15:42:44'),
(69, 7317, 1, 'CREATE', 'common\\models\\ProyectoAsignar', '7', 'estatus', '', '1', '2016-04-11 15:42:44'),
(70, 7355, 2, 'CREATE', 'common\\models\\ProyectoPedido', '4', 'id', '', '4', '2016-04-11 15:51:51'),
(71, 7355, 2, 'CREATE', 'common\\models\\ProyectoPedido', '4', 'id_material', '', '1', '2016-04-11 15:51:51'),
(72, 7355, 2, 'CREATE', 'common\\models\\ProyectoPedido', '4', 'enero', '', '0', '2016-04-11 15:51:51'),
(73, 7355, 2, 'CREATE', 'common\\models\\ProyectoPedido', '4', 'febrero', '', '0', '2016-04-11 15:51:51'),
(74, 7355, 2, 'CREATE', 'common\\models\\ProyectoPedido', '4', 'marzo', '', '2', '2016-04-11 15:51:51'),
(75, 7355, 2, 'CREATE', 'common\\models\\ProyectoPedido', '4', 'abril', '', '0', '2016-04-11 15:51:51'),
(76, 7355, 2, 'CREATE', 'common\\models\\ProyectoPedido', '4', 'mayo', '', '0', '2016-04-11 15:51:51'),
(77, 7355, 2, 'CREATE', 'common\\models\\ProyectoPedido', '4', 'junio', '', '0', '2016-04-11 15:51:51'),
(78, 7355, 2, 'CREATE', 'common\\models\\ProyectoPedido', '4', 'julio', '', '0', '2016-04-11 15:51:51'),
(79, 7355, 2, 'CREATE', 'common\\models\\ProyectoPedido', '4', 'agosto', '', '3', '2016-04-11 15:51:51'),
(80, 7355, 2, 'CREATE', 'common\\models\\ProyectoPedido', '4', 'septiembre', '', '0', '2016-04-11 15:51:51'),
(81, 7355, 2, 'CREATE', 'common\\models\\ProyectoPedido', '4', 'octubre', '', '0', '2016-04-11 15:51:51'),
(82, 7355, 2, 'CREATE', 'common\\models\\ProyectoPedido', '4', 'noviembre', '', '0', '2016-04-11 15:51:51'),
(83, 7355, 2, 'CREATE', 'common\\models\\ProyectoPedido', '4', 'diciembre', '', '0', '2016-04-11 15:51:51'),
(84, 7355, 2, 'CREATE', 'common\\models\\ProyectoPedido', '4', 'precio', '', '100.00', '2016-04-11 15:51:51'),
(85, 7355, 2, 'CREATE', 'common\\models\\ProyectoPedido', '4', 'fecha_creacion', '', '2016-04-11 15:51:51', '2016-04-11 15:51:51'),
(86, 7355, 2, 'CREATE', 'common\\models\\ProyectoPedido', '4', 'asignado', '', '7', '2016-04-11 15:51:51'),
(87, 7355, 2, 'CREATE', 'common\\models\\ProyectoPedido', '4', 'estatus', '', '1', '2016-04-11 15:51:51'),
(88, 7396, 2, 'UPDATE', 'common\\models\\ProyectoPedido', '4', 'marzo', '2', '0', '2016-04-11 15:55:51'),
(89, 7396, 2, 'UPDATE', 'common\\models\\ProyectoPedido', '4', 'agosto', '3', '0', '2016-04-11 15:55:51'),
(90, 7396, 2, 'UPDATE', 'common\\models\\ProyectoPedido', '4', 'fecha_creacion', '2016-04-11 15:51:51', '2016-04-11 15:55:51', '2016-04-11 15:55:51'),
(91, 7995, 2, 'CREATE', 'common\\models\\ProyectoPedido', '5', 'id', '', '5', '2016-04-17 20:35:05'),
(92, 7995, 2, 'CREATE', 'common\\models\\ProyectoPedido', '5', 'id_material', '', '1', '2016-04-17 20:35:05'),
(93, 7995, 2, 'CREATE', 'common\\models\\ProyectoPedido', '5', 'enero', '', '2', '2016-04-17 20:35:05'),
(94, 7995, 2, 'CREATE', 'common\\models\\ProyectoPedido', '5', 'febrero', '', '0', '2016-04-17 20:35:05'),
(95, 7995, 2, 'CREATE', 'common\\models\\ProyectoPedido', '5', 'marzo', '', '0', '2016-04-17 20:35:05'),
(96, 7995, 2, 'CREATE', 'common\\models\\ProyectoPedido', '5', 'abril', '', '0', '2016-04-17 20:35:05'),
(97, 7995, 2, 'CREATE', 'common\\models\\ProyectoPedido', '5', 'mayo', '', '0', '2016-04-17 20:35:05'),
(98, 7995, 2, 'CREATE', 'common\\models\\ProyectoPedido', '5', 'junio', '', '0', '2016-04-17 20:35:05'),
(99, 7995, 2, 'CREATE', 'common\\models\\ProyectoPedido', '5', 'julio', '', '1', '2016-04-17 20:35:05'),
(100, 7995, 2, 'CREATE', 'common\\models\\ProyectoPedido', '5', 'agosto', '', '0', '2016-04-17 20:35:05'),
(101, 7995, 2, 'CREATE', 'common\\models\\ProyectoPedido', '5', 'septiembre', '', '0', '2016-04-17 20:35:05'),
(102, 7995, 2, 'CREATE', 'common\\models\\ProyectoPedido', '5', 'octubre', '', '0', '2016-04-17 20:35:05'),
(103, 7995, 2, 'CREATE', 'common\\models\\ProyectoPedido', '5', 'noviembre', '', '0', '2016-04-17 20:35:05'),
(104, 7995, 2, 'CREATE', 'common\\models\\ProyectoPedido', '5', 'diciembre', '', '0', '2016-04-17 20:35:05'),
(105, 7995, 2, 'CREATE', 'common\\models\\ProyectoPedido', '5', 'precio', '', '100.00', '2016-04-17 20:35:05'),
(106, 7995, 2, 'CREATE', 'common\\models\\ProyectoPedido', '5', 'fecha_creacion', '', '2016-04-17 20:35:05', '2016-04-17 20:35:05'),
(107, 7995, 2, 'CREATE', 'common\\models\\ProyectoPedido', '5', 'asignado', '', '5', '2016-04-17 20:35:05'),
(108, 7995, 2, 'CREATE', 'common\\models\\ProyectoPedido', '5', 'estatus', '', '1', '2016-04-17 20:35:05'),
(109, 8022, 2, 'DELETE', 'common\\models\\ProyectoPedido', '5', NULL, NULL, NULL, '2016-04-17 20:37:40'),
(110, 8028, 2, 'CREATE', 'common\\models\\ProyectoPedido', '6', 'id', '', '6', '2016-04-17 20:38:10'),
(111, 8028, 2, 'CREATE', 'common\\models\\ProyectoPedido', '6', 'id_material', '', '1', '2016-04-17 20:38:10'),
(112, 8028, 2, 'CREATE', 'common\\models\\ProyectoPedido', '6', 'enero', '', '2', '2016-04-17 20:38:10'),
(113, 8028, 2, 'CREATE', 'common\\models\\ProyectoPedido', '6', 'febrero', '', '0', '2016-04-17 20:38:10'),
(114, 8028, 2, 'CREATE', 'common\\models\\ProyectoPedido', '6', 'marzo', '', '0', '2016-04-17 20:38:10'),
(115, 8028, 2, 'CREATE', 'common\\models\\ProyectoPedido', '6', 'abril', '', '0', '2016-04-17 20:38:10'),
(116, 8028, 2, 'CREATE', 'common\\models\\ProyectoPedido', '6', 'mayo', '', '0', '2016-04-17 20:38:10'),
(117, 8028, 2, 'CREATE', 'common\\models\\ProyectoPedido', '6', 'junio', '', '0', '2016-04-17 20:38:10'),
(118, 8028, 2, 'CREATE', 'common\\models\\ProyectoPedido', '6', 'julio', '', '2', '2016-04-17 20:38:10'),
(119, 8028, 2, 'CREATE', 'common\\models\\ProyectoPedido', '6', 'agosto', '', '0', '2016-04-17 20:38:10'),
(120, 8028, 2, 'CREATE', 'common\\models\\ProyectoPedido', '6', 'septiembre', '', '0', '2016-04-17 20:38:10'),
(121, 8028, 2, 'CREATE', 'common\\models\\ProyectoPedido', '6', 'octubre', '', '0', '2016-04-17 20:38:10'),
(122, 8028, 2, 'CREATE', 'common\\models\\ProyectoPedido', '6', 'noviembre', '', '0', '2016-04-17 20:38:10'),
(123, 8028, 2, 'CREATE', 'common\\models\\ProyectoPedido', '6', 'diciembre', '', '3', '2016-04-17 20:38:10'),
(124, 8028, 2, 'CREATE', 'common\\models\\ProyectoPedido', '6', 'precio', '', '100.00', '2016-04-17 20:38:10'),
(125, 8028, 2, 'CREATE', 'common\\models\\ProyectoPedido', '6', 'fecha_creacion', '', '2016-04-17 20:38:10', '2016-04-17 20:38:10'),
(126, 8028, 2, 'CREATE', 'common\\models\\ProyectoPedido', '6', 'asignado', '', '5', '2016-04-17 20:38:10'),
(127, 8028, 2, 'CREATE', 'common\\models\\ProyectoPedido', '6', 'estatus', '', '1', '2016-04-17 20:38:10'),
(128, 8043, 2, 'DELETE', 'common\\models\\ProyectoPedido', '6', NULL, NULL, NULL, '2016-04-17 20:39:38'),
(129, 8046, 2, 'CREATE', 'common\\models\\ProyectoPedido', '7', 'id', '', '7', '2016-04-17 20:39:47'),
(130, 8046, 2, 'CREATE', 'common\\models\\ProyectoPedido', '7', 'id_material', '', '1', '2016-04-17 20:39:47'),
(131, 8046, 2, 'CREATE', 'common\\models\\ProyectoPedido', '7', 'enero', '', '0', '2016-04-17 20:39:47'),
(132, 8046, 2, 'CREATE', 'common\\models\\ProyectoPedido', '7', 'febrero', '', '2', '2016-04-17 20:39:47'),
(133, 8046, 2, 'CREATE', 'common\\models\\ProyectoPedido', '7', 'marzo', '', '0', '2016-04-17 20:39:47'),
(134, 8046, 2, 'CREATE', 'common\\models\\ProyectoPedido', '7', 'abril', '', '0', '2016-04-17 20:39:47'),
(135, 8046, 2, 'CREATE', 'common\\models\\ProyectoPedido', '7', 'mayo', '', '2', '2016-04-17 20:39:47'),
(136, 8046, 2, 'CREATE', 'common\\models\\ProyectoPedido', '7', 'junio', '', '0', '2016-04-17 20:39:47'),
(137, 8046, 2, 'CREATE', 'common\\models\\ProyectoPedido', '7', 'julio', '', '0', '2016-04-17 20:39:47'),
(138, 8046, 2, 'CREATE', 'common\\models\\ProyectoPedido', '7', 'agosto', '', '0', '2016-04-17 20:39:47'),
(139, 8046, 2, 'CREATE', 'common\\models\\ProyectoPedido', '7', 'septiembre', '', '0', '2016-04-17 20:39:47'),
(140, 8046, 2, 'CREATE', 'common\\models\\ProyectoPedido', '7', 'octubre', '', '0', '2016-04-17 20:39:47'),
(141, 8046, 2, 'CREATE', 'common\\models\\ProyectoPedido', '7', 'noviembre', '', '0', '2016-04-17 20:39:47'),
(142, 8046, 2, 'CREATE', 'common\\models\\ProyectoPedido', '7', 'diciembre', '', '2', '2016-04-17 20:39:47'),
(143, 8046, 2, 'CREATE', 'common\\models\\ProyectoPedido', '7', 'precio', '', '100.00', '2016-04-17 20:39:47'),
(144, 8046, 2, 'CREATE', 'common\\models\\ProyectoPedido', '7', 'fecha_creacion', '', '2016-04-17 20:39:47', '2016-04-17 20:39:47'),
(145, 8046, 2, 'CREATE', 'common\\models\\ProyectoPedido', '7', 'asignado', '', '5', '2016-04-17 20:39:47'),
(146, 8046, 2, 'CREATE', 'common\\models\\ProyectoPedido', '7', 'estatus', '', '1', '2016-04-17 20:39:47'),
(147, 8793, 2, 'CREATE', 'common\\models\\ProyectoPedido', '8', 'id', '', '8', '2016-04-17 21:35:44'),
(148, 8793, 2, 'CREATE', 'common\\models\\ProyectoPedido', '8', 'id_material', '', '1', '2016-04-17 21:35:44'),
(149, 8793, 2, 'CREATE', 'common\\models\\ProyectoPedido', '8', 'enero', '', '0', '2016-04-17 21:35:44'),
(150, 8793, 2, 'CREATE', 'common\\models\\ProyectoPedido', '8', 'febrero', '', '0', '2016-04-17 21:35:44'),
(151, 8793, 2, 'CREATE', 'common\\models\\ProyectoPedido', '8', 'marzo', '', '7', '2016-04-17 21:35:44'),
(152, 8793, 2, 'CREATE', 'common\\models\\ProyectoPedido', '8', 'abril', '', '0', '2016-04-17 21:35:44'),
(153, 8793, 2, 'CREATE', 'common\\models\\ProyectoPedido', '8', 'mayo', '', '045', '2016-04-17 21:35:44'),
(154, 8793, 2, 'CREATE', 'common\\models\\ProyectoPedido', '8', 'junio', '', '0', '2016-04-17 21:35:44'),
(155, 8793, 2, 'CREATE', 'common\\models\\ProyectoPedido', '8', 'julio', '', '0', '2016-04-17 21:35:44'),
(156, 8793, 2, 'CREATE', 'common\\models\\ProyectoPedido', '8', 'agosto', '', '066', '2016-04-17 21:35:44'),
(157, 8793, 2, 'CREATE', 'common\\models\\ProyectoPedido', '8', 'septiembre', '', '12', '2016-04-17 21:35:44'),
(158, 8793, 2, 'CREATE', 'common\\models\\ProyectoPedido', '8', 'octubre', '', '0', '2016-04-17 21:35:44'),
(159, 8793, 2, 'CREATE', 'common\\models\\ProyectoPedido', '8', 'noviembre', '', '0', '2016-04-17 21:35:44'),
(160, 8793, 2, 'CREATE', 'common\\models\\ProyectoPedido', '8', 'diciembre', '', '01', '2016-04-17 21:35:44'),
(161, 8793, 2, 'CREATE', 'common\\models\\ProyectoPedido', '8', 'precio', '', '100.00', '2016-04-17 21:35:44'),
(162, 8793, 2, 'CREATE', 'common\\models\\ProyectoPedido', '8', 'fecha_creacion', '', '2016-04-17 21:35:44', '2016-04-17 21:35:44'),
(163, 8793, 2, 'CREATE', 'common\\models\\ProyectoPedido', '8', 'asignado', '', '5', '2016-04-17 21:35:44'),
(164, 8793, 2, 'CREATE', 'common\\models\\ProyectoPedido', '8', 'estatus', '', '1', '2016-04-17 21:35:44'),
(165, 9841, 2, 'CREATE', 'common\\models\\ProyectoPedido', '9', 'id', '', '9', '2016-04-17 22:58:30'),
(166, 9841, 2, 'CREATE', 'common\\models\\ProyectoPedido', '9', 'id_material', '', '1', '2016-04-17 22:58:30'),
(167, 9841, 2, 'CREATE', 'common\\models\\ProyectoPedido', '9', 'enero', '', '0455', '2016-04-17 22:58:30'),
(168, 9841, 2, 'CREATE', 'common\\models\\ProyectoPedido', '9', 'febrero', '', '0', '2016-04-17 22:58:30'),
(169, 9841, 2, 'CREATE', 'common\\models\\ProyectoPedido', '9', 'marzo', '', '0', '2016-04-17 22:58:30'),
(170, 9841, 2, 'CREATE', 'common\\models\\ProyectoPedido', '9', 'abril', '', '3', '2016-04-17 22:58:30'),
(171, 9841, 2, 'CREATE', 'common\\models\\ProyectoPedido', '9', 'mayo', '', '0', '2016-04-17 22:58:30'),
(172, 9841, 2, 'CREATE', 'common\\models\\ProyectoPedido', '9', 'junio', '', '0', '2016-04-17 22:58:30'),
(173, 9841, 2, 'CREATE', 'common\\models\\ProyectoPedido', '9', 'julio', '', '0', '2016-04-17 22:58:30'),
(174, 9841, 2, 'CREATE', 'common\\models\\ProyectoPedido', '9', 'agosto', '', '0', '2016-04-17 22:58:30'),
(175, 9841, 2, 'CREATE', 'common\\models\\ProyectoPedido', '9', 'septiembre', '', '0456', '2016-04-17 22:58:30'),
(176, 9841, 2, 'CREATE', 'common\\models\\ProyectoPedido', '9', 'octubre', '', '145', '2016-04-17 22:58:30'),
(177, 9841, 2, 'CREATE', 'common\\models\\ProyectoPedido', '9', 'noviembre', '', '0', '2016-04-17 22:58:30'),
(178, 9841, 2, 'CREATE', 'common\\models\\ProyectoPedido', '9', 'diciembre', '', '0', '2016-04-17 22:58:30'),
(179, 9841, 2, 'CREATE', 'common\\models\\ProyectoPedido', '9', 'precio', '', '100.00', '2016-04-17 22:58:30'),
(180, 9841, 2, 'CREATE', 'common\\models\\ProyectoPedido', '9', 'fecha_creacion', '', '2016-04-17 22:58:30', '2016-04-17 22:58:30'),
(181, 9841, 2, 'CREATE', 'common\\models\\ProyectoPedido', '9', 'asignado', '', '7', '2016-04-17 22:58:30'),
(182, 9841, 2, 'CREATE', 'common\\models\\ProyectoPedido', '9', 'estatus', '', '1', '2016-04-17 22:58:30'),
(183, 10610, 1, 'CREATE', 'common\\models\\ProyectoAsignar', '8', 'id', '', '8', '2016-05-24 13:50:46'),
(184, 10610, 1, 'CREATE', 'common\\models\\ProyectoAsignar', '8', 'usuario', '', '3', '2016-05-24 13:50:46'),
(185, 10610, 1, 'CREATE', 'common\\models\\ProyectoAsignar', '8', 'unidad_ejecutora', '', '1', '2016-05-24 13:50:46'),
(186, 10610, 1, 'CREATE', 'common\\models\\ProyectoAsignar', '8', 'accion_especifica', '', '20', '2016-05-24 13:50:46'),
(187, 10610, 1, 'CREATE', 'common\\models\\ProyectoAsignar', '8', 'estatus', '', '1', '2016-05-24 13:50:46'),
(188, 10611, 1, 'CREATE', 'common\\models\\MaterialesServicios', '2', 'id', '', '2', '2016-06-03 00:53:27'),
(189, 10611, 1, 'CREATE', 'common\\models\\MaterialesServicios', '2', 'id_se', '', '2', '2016-06-03 00:53:27'),
(190, 10611, 1, 'CREATE', 'common\\models\\MaterialesServicios', '2', 'nombre', '', 'Servicio de luz eléctrica', '2016-06-03 00:53:27'),
(191, 10611, 1, 'CREATE', 'common\\models\\MaterialesServicios', '2', 'unidad_medida', '', '320', '2016-06-03 00:53:27'),
(192, 10611, 1, 'CREATE', 'common\\models\\MaterialesServicios', '2', 'presentacion', '', '2', '2016-06-03 00:53:27'),
(193, 10611, 1, 'CREATE', 'common\\models\\MaterialesServicios', '2', 'precio', '', '85', '2016-06-03 00:53:27'),
(194, 10611, 1, 'CREATE', 'common\\models\\MaterialesServicios', '2', 'iva', '', '0', '2016-06-03 00:53:27'),
(195, 10611, 1, 'CREATE', 'common\\models\\MaterialesServicios', '2', 'estatus', '', '1', '2016-06-03 00:53:27'),
(196, 10612, 2, 'CREATE', 'common\\models\\ProyectoPedido', '10', 'id', '', '10', '2016-06-03 00:54:55'),
(197, 10612, 2, 'CREATE', 'common\\models\\ProyectoPedido', '10', 'id_material', '', '2', '2016-06-03 00:54:55'),
(198, 10612, 2, 'CREATE', 'common\\models\\ProyectoPedido', '10', 'enero', '', '100', '2016-06-03 00:54:55'),
(199, 10612, 2, 'CREATE', 'common\\models\\ProyectoPedido', '10', 'febrero', '', '250', '2016-06-03 00:54:55'),
(200, 10612, 2, 'CREATE', 'common\\models\\ProyectoPedido', '10', 'marzo', '', '250', '2016-06-03 00:54:55'),
(201, 10612, 2, 'CREATE', 'common\\models\\ProyectoPedido', '10', 'abril', '', '250', '2016-06-03 00:54:55'),
(202, 10612, 2, 'CREATE', 'common\\models\\ProyectoPedido', '10', 'mayo', '', '250', '2016-06-03 00:54:55'),
(203, 10612, 2, 'CREATE', 'common\\models\\ProyectoPedido', '10', 'junio', '', '250', '2016-06-03 00:54:55'),
(204, 10612, 2, 'CREATE', 'common\\models\\ProyectoPedido', '10', 'julio', '', '300', '2016-06-03 00:54:55'),
(205, 10612, 2, 'CREATE', 'common\\models\\ProyectoPedido', '10', 'agosto', '', '300', '2016-06-03 00:54:55'),
(206, 10612, 2, 'CREATE', 'common\\models\\ProyectoPedido', '10', 'septiembre', '', '300', '2016-06-03 00:54:55'),
(207, 10612, 2, 'CREATE', 'common\\models\\ProyectoPedido', '10', 'octubre', '', '500', '2016-06-03 00:54:55'),
(208, 10612, 2, 'CREATE', 'common\\models\\ProyectoPedido', '10', 'noviembre', '', '500', '2016-06-03 00:54:55'),
(209, 10612, 2, 'CREATE', 'common\\models\\ProyectoPedido', '10', 'diciembre', '', '550', '2016-06-03 00:54:55'),
(210, 10612, 2, 'CREATE', 'common\\models\\ProyectoPedido', '10', 'precio', '', '85.00', '2016-06-03 00:54:55'),
(211, 10612, 2, 'CREATE', 'common\\models\\ProyectoPedido', '10', 'fecha_creacion', '', '2016-06-03 00:54:55', '2016-06-03 00:54:55'),
(212, 10612, 2, 'CREATE', 'common\\models\\ProyectoPedido', '10', 'asignado', '', '7', '2016-06-03 00:54:55'),
(213, 10612, 2, 'CREATE', 'common\\models\\ProyectoPedido', '10', 'estatus', '', '1', '2016-06-03 00:54:55'),
(214, 10613, 2, 'DELETE', 'common\\models\\ProyectoPedido', '4', NULL, NULL, NULL, '2016-06-03 00:55:03'),
(215, 10614, 2, 'CREATE', 'common\\models\\ProyectoPedido', '1', 'id', '', '1', '2016-06-23 16:16:20'),
(216, 10614, 2, 'CREATE', 'common\\models\\ProyectoPedido', '1', 'id_material', '', '2', '2016-06-23 16:16:20'),
(217, 10614, 2, 'CREATE', 'common\\models\\ProyectoPedido', '1', 'enero', '', '11', '2016-06-23 16:16:20'),
(218, 10614, 2, 'CREATE', 'common\\models\\ProyectoPedido', '1', 'febrero', '', '0', '2016-06-23 16:16:20'),
(219, 10614, 2, 'CREATE', 'common\\models\\ProyectoPedido', '1', 'marzo', '', '0', '2016-06-23 16:16:20'),
(220, 10614, 2, 'CREATE', 'common\\models\\ProyectoPedido', '1', 'abril', '', '0', '2016-06-23 16:16:20'),
(221, 10614, 2, 'CREATE', 'common\\models\\ProyectoPedido', '1', 'mayo', '', '4', '2016-06-23 16:16:20'),
(222, 10614, 2, 'CREATE', 'common\\models\\ProyectoPedido', '1', 'junio', '', '0', '2016-06-23 16:16:20'),
(223, 10614, 2, 'CREATE', 'common\\models\\ProyectoPedido', '1', 'julio', '', '0', '2016-06-23 16:16:20'),
(224, 10614, 2, 'CREATE', 'common\\models\\ProyectoPedido', '1', 'agosto', '', '0', '2016-06-23 16:16:20'),
(225, 10614, 2, 'CREATE', 'common\\models\\ProyectoPedido', '1', 'septiembre', '', '25', '2016-06-23 16:16:20'),
(226, 10614, 2, 'CREATE', 'common\\models\\ProyectoPedido', '1', 'octubre', '', '0', '2016-06-23 16:16:20'),
(227, 10614, 2, 'CREATE', 'common\\models\\ProyectoPedido', '1', 'noviembre', '', '0', '2016-06-23 16:16:20'),
(228, 10614, 2, 'CREATE', 'common\\models\\ProyectoPedido', '1', 'diciembre', '', '0', '2016-06-23 16:16:20'),
(229, 10614, 2, 'CREATE', 'common\\models\\ProyectoPedido', '1', 'precio', '', '230.00', '2016-06-23 16:16:20'),
(230, 10614, 2, 'CREATE', 'common\\models\\ProyectoPedido', '1', 'fecha_creacion', '', '2016-06-23 16:16:20', '2016-06-23 16:16:20'),
(231, 10614, 2, 'CREATE', 'common\\models\\ProyectoPedido', '1', 'asignado', '', '7', '2016-06-23 16:16:20'),
(232, 10614, 2, 'CREATE', 'common\\models\\ProyectoPedido', '1', 'estatus', '', '1', '2016-06-23 16:16:20'),
(233, 10615, 2, 'CREATE', 'common\\models\\ProyectoPedido', '2', 'id', '', '2', '2016-06-23 16:16:51'),
(234, 10615, 2, 'CREATE', 'common\\models\\ProyectoPedido', '2', 'id_material', '', '3', '2016-06-23 16:16:51'),
(235, 10615, 2, 'CREATE', 'common\\models\\ProyectoPedido', '2', 'enero', '', '1500', '2016-06-23 16:16:51'),
(236, 10615, 2, 'CREATE', 'common\\models\\ProyectoPedido', '2', 'febrero', '', '0', '2016-06-23 16:16:51'),
(237, 10615, 2, 'CREATE', 'common\\models\\ProyectoPedido', '2', 'marzo', '', '0', '2016-06-23 16:16:51'),
(238, 10615, 2, 'CREATE', 'common\\models\\ProyectoPedido', '2', 'abril', '', '0', '2016-06-23 16:16:51'),
(239, 10615, 2, 'CREATE', 'common\\models\\ProyectoPedido', '2', 'mayo', '', '0', '2016-06-23 16:16:51'),
(240, 10615, 2, 'CREATE', 'common\\models\\ProyectoPedido', '2', 'junio', '', '0', '2016-06-23 16:16:51'),
(241, 10615, 2, 'CREATE', 'common\\models\\ProyectoPedido', '2', 'julio', '', '1200', '2016-06-23 16:16:51'),
(242, 10615, 2, 'CREATE', 'common\\models\\ProyectoPedido', '2', 'agosto', '', '0', '2016-06-23 16:16:51'),
(243, 10615, 2, 'CREATE', 'common\\models\\ProyectoPedido', '2', 'septiembre', '', '0', '2016-06-23 16:16:51'),
(244, 10615, 2, 'CREATE', 'common\\models\\ProyectoPedido', '2', 'octubre', '', '0', '2016-06-23 16:16:51'),
(245, 10615, 2, 'CREATE', 'common\\models\\ProyectoPedido', '2', 'noviembre', '', '0', '2016-06-23 16:16:51'),
(246, 10615, 2, 'CREATE', 'common\\models\\ProyectoPedido', '2', 'diciembre', '', '0', '2016-06-23 16:16:51'),
(247, 10615, 2, 'CREATE', 'common\\models\\ProyectoPedido', '2', 'precio', '', '4620.00', '2016-06-23 16:16:51'),
(248, 10615, 2, 'CREATE', 'common\\models\\ProyectoPedido', '2', 'fecha_creacion', '', '2016-06-23 16:16:51', '2016-06-23 16:16:51'),
(249, 10615, 2, 'CREATE', 'common\\models\\ProyectoPedido', '2', 'asignado', '', '7', '2016-06-23 16:16:51'),
(250, 10615, 2, 'CREATE', 'common\\models\\ProyectoPedido', '2', 'estatus', '', '1', '2016-06-23 16:16:51'),
(251, 10616, 1, 'CREATE', 'common\\models\\ProyectoAsignar', '9', 'id', '', '9', '2016-06-30 00:29:24'),
(252, 10616, 1, 'CREATE', 'common\\models\\ProyectoAsignar', '9', 'usuario', '', '2', '2016-06-30 00:29:24'),
(253, 10616, 1, 'CREATE', 'common\\models\\ProyectoAsignar', '9', 'unidad_ejecutora', '', '603', '2016-06-30 00:29:24'),
(254, 10616, 1, 'CREATE', 'common\\models\\ProyectoAsignar', '9', 'accion_especifica', '', '36', '2016-06-30 00:29:24'),
(255, 10616, 1, 'CREATE', 'common\\models\\ProyectoAsignar', '9', 'estatus', '', '1', '2016-06-30 00:29:24'),
(256, 10617, 2, 'CREATE', 'common\\models\\ProyectoPedido', '3', 'id', '', '3', '2016-06-30 02:22:19'),
(257, 10617, 2, 'CREATE', 'common\\models\\ProyectoPedido', '3', 'id_material', '', '49', '2016-06-30 02:22:19'),
(258, 10617, 2, 'CREATE', 'common\\models\\ProyectoPedido', '3', 'enero', '', '01', '2016-06-30 02:22:19'),
(259, 10617, 2, 'CREATE', 'common\\models\\ProyectoPedido', '3', 'febrero', '', '1', '2016-06-30 02:22:19'),
(260, 10617, 2, 'CREATE', 'common\\models\\ProyectoPedido', '3', 'marzo', '', '1', '2016-06-30 02:22:19'),
(261, 10617, 2, 'CREATE', 'common\\models\\ProyectoPedido', '3', 'abril', '', '1', '2016-06-30 02:22:19'),
(262, 10617, 2, 'CREATE', 'common\\models\\ProyectoPedido', '3', 'mayo', '', '1', '2016-06-30 02:22:19'),
(263, 10617, 2, 'CREATE', 'common\\models\\ProyectoPedido', '3', 'junio', '', '1', '2016-06-30 02:22:19'),
(264, 10617, 2, 'CREATE', 'common\\models\\ProyectoPedido', '3', 'julio', '', '1', '2016-06-30 02:22:19'),
(265, 10617, 2, 'CREATE', 'common\\models\\ProyectoPedido', '3', 'agosto', '', '1', '2016-06-30 02:22:19'),
(266, 10617, 2, 'CREATE', 'common\\models\\ProyectoPedido', '3', 'septiembre', '', '1', '2016-06-30 02:22:19'),
(267, 10617, 2, 'CREATE', 'common\\models\\ProyectoPedido', '3', 'octubre', '', '1', '2016-06-30 02:22:19'),
(268, 10617, 2, 'CREATE', 'common\\models\\ProyectoPedido', '3', 'noviembre', '', '1', '2016-06-30 02:22:19'),
(269, 10617, 2, 'CREATE', 'common\\models\\ProyectoPedido', '3', 'diciembre', '', '1', '2016-06-30 02:22:19'),
(270, 10617, 2, 'CREATE', 'common\\models\\ProyectoPedido', '3', 'precio', '', '2000000.00', '2016-06-30 02:22:19'),
(271, 10617, 2, 'CREATE', 'common\\models\\ProyectoPedido', '3', 'fecha_creacion', '', '2016-06-30 02:22:19', '2016-06-30 02:22:19'),
(272, 10617, 2, 'CREATE', 'common\\models\\ProyectoPedido', '3', 'asignado', '', '7', '2016-06-30 02:22:19'),
(273, 10617, 2, 'CREATE', 'common\\models\\ProyectoPedido', '3', 'estatus', '', '1', '2016-06-30 02:22:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('acc_accion_especifica', '1', 1467389470),
('acc_variables', '1', 1467389470),
('accion_centralizada', '1', 1467389470),
('accion_centralizada', '2', 1459774927),
('accion_centralizada_asignar', '1', 1467389470),
('accion_centralizada_requerimiento', '1', 1467389470),
('accion_centralizada_requerimiento', '2', 1459774927),
('gestor_proyecto', '1', 1467389470),
('materiales_servicios', '1', 1467389470),
('proyecto_asignar', '1', 1467389470),
('proyecto_pedido', '1', 1467389470),
('proyecto_pedido', '2', 1459774927),
('registrador_accion_especifica', '1', 1467389470),
('registrador_accion_especifica', '2', 1459774927),
('registrador_accion_especifica', '3', 1454611275),
('registrador_alcance', '1', 1467389470),
('registrador_alcance', '2', 1459774927),
('registrador_alcance', '3', 1454611275),
('registrador_basico', '1', 1467389470),
('registrador_basico', '2', 1459774927),
('registrador_basico', '3', 1454611275),
('registrador_distribucion_presupuestaria', '1', 1467389470),
('registrador_distribucion_presupuestaria', '3', 1454611275),
('sysadmin', '1', 1467389470),
('sysadmin', '3', 1454611275);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('ac-ac-espec/create', 2, 'Crear acción específica de ACC', NULL, NULL, 1456113811, 1456113811),
('ac-ac-espec/delete', 2, 'Eliminar acción específica de ACC', NULL, NULL, 1456113851, 1456113851),
('ac-ac-espec/index', 2, 'Lista de acciones específicas de ACC', NULL, NULL, 1456113780, 1456113780),
('ac-ac-espec/update', 2, 'Modificar acción específica de ACC', NULL, NULL, 1456113834, 1456113834),
('ac-ac-espec/view', 2, 'Ver una acción específica de ACC', NULL, NULL, 1456114927, 1456114927),
('ac-esp-uej/create', 2, 'Asociar una UE a una acción específica de ACC', NULL, NULL, 1456114656, 1456114656),
('ac-esp-uej/delete', 2, 'Desasignar una UE de una acción específica de ACC', NULL, NULL, 1456114789, 1456114789),
('ac-esp-uej/index', 2, 'Lista de UE asociadas a una acción específica de ACC', NULL, NULL, 1456114628, 1456114667),
('ac-esp-uej/update', 2, 'Cambiar la asignación de una UE de acción específica de ACC', NULL, NULL, 1456114758, 1456114758),
('acc_accion_especifica', 1, 'Crear, editar y eliminar acciones específicas de ACC', NULL, NULL, 1456113925, 1456114942),
('acc_variables', 1, 'Ver, crear, editar y eliminar variables de ACC', NULL, NULL, 1467389461, 1467389461),
('accion_centralizada', 1, 'ver las acciones centralizadas', NULL, NULL, 1455129653, 1459443467),
('accion_centralizada_asignar', 1, 'Asignar usuarios a Acciones Centralizadas', NULL, NULL, 1459442993, 1459443946),
('accion_centralizada_requerimiento', 1, 'permisos para poder realizar requerimientos de acciones centralizadas', NULL, NULL, 1459774903, 1459788763),
('accion-centralizada-asignar/ace', 2, 'JSON con las Acciones Específicas a asignar', NULL, NULL, 1459443928, 1459443928),
('accion-centralizada-asignar/asignar', 2, 'Asignar usuario a acción específica de ACC', NULL, NULL, 1459443071, 1459443071),
('accion-centralizada-asignar/create', 2, 'Crear asignacion', NULL, NULL, 1459443103, 1459443103),
('accion-centralizada-asignar/delete', 2, 'Eliminar asignacion', NULL, NULL, 1459443147, 1459443147),
('accion-centralizada-asignar/index', 2, 'Lista de asignaciones de usuarios a ACC', NULL, NULL, 1459442945, 1459442945),
('accion-centralizada-asignar/update', 2, 'Modificar asignacion', NULL, NULL, 1459443134, 1459443134),
('accion-centralizada-asignar/view', 2, 'Ver asignacion', NULL, NULL, 1459443115, 1459443115),
('accion-centralizada-pedido/bulk-activar', 2, 'activar por lotes los requermientos de accion centralizada', NULL, NULL, 1459788691, 1459788691),
('accion-centralizada-pedido/bulk-delete', 2, 'borrar por lote los requerimientos de accion centralizada', NULL, NULL, 1459788636, 1459788636),
('accion-centralizada-pedido/bulk-desactivar', 2, 'desactivar por lotes los requerimientos de accion centralizada', NULL, NULL, 1459788669, 1459788669),
('accion-centralizada-pedido/create', 2, 'crear requerimiento de accion centralizada', NULL, NULL, 1459774359, 1459774359),
('accion-centralizada-pedido/delete', 2, 'eliminar un requerimiento de accion centralizada', NULL, NULL, 1459788724, 1459788724),
('accion-centralizada-pedido/index', 2, 'pagina inicial de los pedidos de accion centralizada', NULL, NULL, 1459774327, 1459774327),
('accion-centralizada-pedido/llenarprecio', 2, 'consulta para traer el precio del material y su iva', NULL, NULL, 1459775236, 1459775236),
('accion-centralizada-pedido/pedido', 2, 'pedir requerimiento de accion centralizada', NULL, NULL, 1459774549, 1459774549),
('accion-centralizada-pedido/update', 2, 'modiifcar requerimiento de accion centralizada', NULL, NULL, 1459774383, 1459774383),
('accion-centralizada-pedido/view', 2, 'ver el detalle del requerimiento', NULL, NULL, 1459788595, 1459788595),
('accion-centralizada-variables/create', 2, 'crear variables para acciones centralizadas', NULL, NULL, 1455136899, 1467389622),
('accion-centralizada-variables/delete', 2, 'poder borrar la variable', NULL, NULL, 1455136995, 1467389629),
('accion-centralizada-variables/index', 2, 'poder ir al inicio del modulo variables ', NULL, NULL, 1455136979, 1467389635),
('accion-centralizada-variables/update', 2, 'actulizar variables de acciones centralizadas', NULL, NULL, 1455136923, 1467389641),
('accion-centralizada-variables/view', 2, 'ver el detalle de variable', NULL, NULL, 1455136945, 1467389646),
('accion-centralizada/create', 2, 'crear acciones centralizadas', NULL, NULL, 1455130416, 1455130416),
('accion-centralizada/delete', 2, 'borrar acciones centralizadas', NULL, NULL, 1455130459, 1455130459),
('accion-centralizada/importar', 2, 'Importar acciones centralizadas', NULL, NULL, 1458862735, 1458862842),
('accion-centralizada/index', 2, 'ver el inicio de acciones centralizadas', NULL, NULL, 1455129506, 1455130004),
('accion-centralizada/update', 2, 'actualizar acciones centralizadas', NULL, NULL, 1455130436, 1455136413),
('accion-centralizada/view', 2, 'ver el detalle de la accion centralizada', NULL, NULL, 1455130492, 1455130492),
('gestor_proyecto', 1, 'Administrador de proyecto', NULL, NULL, 1456979251, 1464408657),
('materiales_servicios', 1, 'Crea, modifica y elimina materiales y servicios', NULL, NULL, 1455502889, 1455502889),
('materiales-servicios/create', 2, 'Crear materiales y servicios', NULL, NULL, 1455502798, 1455502798),
('materiales-servicios/delete', 2, 'Eliminar materiales y servicios', NULL, NULL, 1455502828, 1455502828),
('materiales-servicios/index', 2, 'Lista de materiales y servicios', NULL, NULL, 1455502782, 1455502782),
('materiales-servicios/update', 2, 'Modificar materiales y servicios', NULL, NULL, 1455502813, 1455502813),
('proyecto_asignar', 1, 'Gestionar las asignaciones de usuarios a las acciones específicas de un proyecto', NULL, NULL, 1458229165, 1467246247),
('proyecto_pedido', 1, 'Pedidos de materiales y servicios de proyecto', NULL, NULL, 1457400383, 1460932850),
('proyecto-accion-especifica/bulk-activar', 2, 'Activar múltiples acciones específicas de proyecto', NULL, NULL, 1457393259, 1457393259),
('proyecto-accion-especifica/bulk-desactivar', 2, 'Desactivar múltiples acciones específicas de proyecto', NULL, NULL, 1457393291, 1457393291),
('proyecto-accion-especifica/create', 2, 'Crear acción específica de proyecto', NULL, NULL, 1452529692, 1452529692),
('proyecto-accion-especifica/delete', 2, 'Eliminar acción específica de proyecto', NULL, NULL, 1452529736, 1452529736),
('proyecto-accion-especifica/index', 2, 'Lista de acciones específicas de proyecto', NULL, NULL, 1452529786, 1452529786),
('proyecto-accion-especifica/toggle-activo', 2, 'Activar/Desactivar una acción específica de proyecto', NULL, NULL, 1457393202, 1457393330),
('proyecto-accion-especifica/update', 2, 'Editar acción específica de proyecto', NULL, NULL, 1452529715, 1452529715),
('proyecto-accion-especifica/view', 2, 'Ver acción específica de proyecto', NULL, NULL, 1452631085, 1452631085),
('proyecto-alcance/create', 2, 'Crear alcance de proyecto', NULL, NULL, 1452221668, 1452221668),
('proyecto-alcance/delete', 2, 'Eliminar alcance de proyecto', NULL, NULL, 1452221699, 1452221699),
('proyecto-alcance/update', 2, 'Editar alcance de proyecto', NULL, NULL, 1452221681, 1452221681),
('proyecto-alcance/view', 2, 'Ver alcance de proyecto', NULL, NULL, 1452223025, 1452223025),
('proyecto-asignar/asignar', 2, 'Lista de asignaciones de un usuario a proyecto/acción específica', NULL, NULL, 1458228890, 1458228890),
('proyecto-asignar/aue', 2, 'Respuesta JSON', NULL, NULL, 1467244885, 1467244905),
('proyecto-asignar/bulk-activar', 2, 'Activar múltiples asignaciones de un usuario a proyecto/acción específica', NULL, NULL, 1458229012, 1458229060),
('proyecto-asignar/bulk-delete', 2, 'Eliminar múltiples asignaciones de usuario a proyecto/acción específica', NULL, NULL, 1458228933, 1458228933),
('proyecto-asignar/bulk-desactivar', 2, 'Desactivar múltiples asignaciones de un usuario a proyecto/acción específica', NULL, NULL, 1458229050, 1458229050),
('proyecto-asignar/create', 2, 'Crear asignación de usuario a proyecto/acción específica', NULL, NULL, 1458228779, 1458228779),
('proyecto-asignar/delete', 2, 'Eliminar asignación de usuario a proyecto/acción específica', NULL, NULL, 1458228811, 1458228811),
('proyecto-asignar/index', 2, 'Lista de usuarios asignados a proyectos', NULL, NULL, 1458228739, 1458228739),
('proyecto-asignar/pae', 2, 'Respuesta JSON', NULL, NULL, 1458275263, 1467242280),
('proyecto-asignar/toggle-activo', 2, 'Activar/Desactivar asignación de usuario a proyecto/acción específica', NULL, NULL, 1458228960, 1458228960),
('proyecto-asignar/update', 2, 'Modificar asignación de usuario a proyecto/acción específica', NULL, NULL, 1458228795, 1458228795),
('proyecto-asignar/view', 2, 'Ver asignación de usuario a proyecto/acción específica', NULL, NULL, 1458228845, 1458228845),
('proyecto-distribucion-presupuestaria/create', 2, 'Crear distribución presupuestaria de proyecto', NULL, NULL, 1452649234, 1452649234),
('proyecto-distribucion-presupuestaria/delete', 2, 'Eliminar distribución presupuestaria de proyecto', NULL, NULL, 1452649263, 1452649263),
('proyecto-distribucion-presupuestaria/index', 2, 'Lista de distribución presupuestaria de proyecto', NULL, NULL, 1452649290, 1452649290),
('proyecto-distribucion-presupuestaria/update', 2, 'Editar distribución presupuestaria de proyecto', NULL, NULL, 1452649249, 1452649249),
('proyecto-distribucion-presupuestaria/view', 2, 'Ver distribución presupuestaria de proyecto', NULL, NULL, 1452649220, 1452649220),
('proyecto-internacional/create', 2, 'Ámbito internacional crear', NULL, NULL, 1451487147, 1451487539),
('proyecto-internacional/delete', 2, 'Ámbito internacional eliminar', NULL, NULL, 1451487197, 1451487564),
('proyecto-internacional/index', 2, 'Ámbito internacional lista', NULL, NULL, 1451487641, 1451487656),
('proyecto-internacional/update', 2, 'Ámbito internacional editar', NULL, NULL, 1451487172, 1451487587),
('proyecto-internacional/view', 2, 'Ámbito internacional ver', NULL, NULL, 1451487215, 1451487602),
('proyecto-localizacion/create', 2, 'Localización estadal, municipal, parroquial - crear', NULL, NULL, 1451505242, 1451505242),
('proyecto-localizacion/delete', 2, 'Localización estadal, municipal, parroquial - eliminar', NULL, NULL, 1452359464, 1452359464),
('proyecto-localizacion/index', 2, 'Localización estadal, municipal, parroquial - lista', NULL, NULL, 1451499354, 1451499354),
('proyecto-localizacion/update', 2, 'Localización estadal, municipal, parroquial - modificar', NULL, NULL, 1451967049, 1451967049),
('proyecto-localizacion/view', 2, 'Localización estadal, municipal, parroquial - ver', NULL, NULL, 1451968567, 1451968567),
('proyecto-pedido/bulk-activar', 2, 'Activar múltiples pedidos de proyecto', NULL, NULL, 1460932803, 1460932803),
('proyecto-pedido/bulk-desactivar', 2, 'Desactivar múltiples pedidos de proyecto', NULL, NULL, 1460932827, 1460932827),
('proyecto-pedido/create', 2, 'Crear pedido', NULL, NULL, 1458102921, 1458102921),
('proyecto-pedido/delete', 2, 'Eliminar pedido', NULL, NULL, 1458102957, 1458102957),
('proyecto-pedido/index', 2, 'Lista de pedidos de materiales y servicios de proyecto', NULL, NULL, 1456116851, 1456116851),
('proyecto-pedido/pedido', 2, 'Pedidos', NULL, NULL, 1458100323, 1458100323),
('proyecto-pedido/toggle-activo', 2, 'Activar/desactivar pedido', NULL, NULL, 1458105557, 1458105557),
('proyecto-pedido/update', 2, 'Modificar pedido', NULL, NULL, 1458102942, 1458102942),
('proyecto-pedido/view', 2, 'Ver pedido', NULL, NULL, 1458105517, 1458105517),
('proyecto-registrador/create', 2, 'Crear registrador de proyecto', NULL, NULL, 1451931943, 1451931943),
('proyecto-registrador/create-alt', 2, 'Crear registrador de proyecto - método alternativo', NULL, NULL, 1452023090, 1452023090),
('proyecto-registrador/delete', 2, 'Eliminar registrador de proyecto', NULL, NULL, 1451931989, 1451931989),
('proyecto-registrador/index', 2, 'Lista de registrador de proyecto', NULL, NULL, 1451932055, 1451932055),
('proyecto-registrador/update', 2, 'Editar registrador de proyecto', NULL, NULL, 1451931966, 1451931966),
('proyecto-registrador/view', 2, 'Ver registrador de proyecto', NULL, NULL, 1451937934, 1451937934),
('proyecto-responsable-administrativo/create', 2, 'Crear responsable administrativo de proyecto', NULL, NULL, 1452006664, 1452006664),
('proyecto-responsable-administrativo/create-alt', 2, 'Crear responsable administrativo de proyecto - método alternativo', NULL, NULL, 1452023021, 1452023098),
('proyecto-responsable-administrativo/delete', 2, 'Eliminar responsable administrativo de proyecto', NULL, NULL, 1452006754, 1452006754),
('proyecto-responsable-administrativo/update', 2, 'Editar responsable administrativo de proyecto', NULL, NULL, 1452006689, 1452006689),
('proyecto-responsable-administrativo/view', 2, 'Ver responsable administrativo de proyecto', NULL, NULL, 1452006722, 1452006722),
('proyecto-responsable-tecnico/create', 2, 'Crear responsable técnico de proyecto', NULL, NULL, 1452011058, 1452011058),
('proyecto-responsable-tecnico/delete', 2, 'Eliminar responsable técnico de proyecto', NULL, NULL, 1460241927, 1460241927),
('proyecto-responsable-tecnico/update', 2, 'Editar responsable técnico de proyecto', NULL, NULL, 1452011082, 1452011082),
('proyecto-responsable-tecnico/view', 2, 'Ver responsable técnico de proyecto', NULL, NULL, 1460241976, 1460241976),
('proyecto-responsable/create', 2, 'Crear responsable de proyecto', NULL, NULL, 1452005727, 1452005727),
('proyecto-responsable/delete', 2, 'Eliminar responsable de proyecto', NULL, NULL, 1452019408, 1452019408),
('proyecto-responsable/update', 2, 'Editar responsable de proyecto', NULL, NULL, 1452005753, 1452005753),
('proyecto-responsable/view', 2, 'Ver responsable de proyecto', NULL, NULL, 1452006168, 1452006168),
('proyecto/aprobar', 2, 'Aprobar/desaprobar proyecto', NULL, NULL, 1464384527, 1464384527),
('proyecto/bulk-activar', 2, 'Activar múltiples proyectos', NULL, NULL, 1456979084, 1456979084),
('proyecto/bulk-delete', 2, 'Eliminar múltiples proyectos', NULL, NULL, 1456979023, 1456979023),
('proyecto/bulk-desactivar', 2, 'Desactivar múltiples proyectos', NULL, NULL, 1456979103, 1456979103),
('proyecto/create', 2, 'Crear Proyecto', NULL, NULL, 1450393912, 1450645199),
('proyecto/delete', 2, 'Eliminar Proyecto', NULL, NULL, 1450393912, 1450645229),
('proyecto/distribucion', 2, 'Distribución presupuestaria de proyecto', NULL, NULL, 1464408600, 1464408600),
('proyecto/index', 2, 'Lista de proyectos', NULL, NULL, 1450646779, 1450646779),
('proyecto/toggle-activo', 2, 'Activar/desactivar un proyecto', NULL, NULL, 1456978982, 1456979131),
('proyecto/update', 2, 'Editar Proyecto', NULL, NULL, 1450393912, 1450645214),
('proyecto/view', 2, 'Ver Proyecto', NULL, NULL, 1450393912, 1450645173),
('registrador_accion_especifica', 1, 'Crea, edita y elimina acciones específicas de proyecto', NULL, NULL, 1452529829, 1457393365),
('registrador_alcance', 1, 'Crea, edita y elimina "alcance e impacto" de proyecto', NULL, NULL, 1452221931, 1452223040),
('registrador_basico', 1, 'Crea, edita y elimina datos básicos de proyecto', NULL, NULL, 1450393912, 1460242009),
('registrador_distribucion_presupuestaria', 1, 'Crea, edita y elimina la distribución presupuestaria de proyecto', NULL, NULL, 1452649340, 1452649340),
('site/audit', 2, 'Auditoría', NULL, NULL, 1458665093, 1458665093),
('site/configuracion', 2, 'Configurar el sistema', NULL, NULL, 1450736795, 1450736795),
('sysadmin', 1, 'Administrador del sistema', NULL, NULL, 1450736017, 1459774580),
('unidad-medida/create', 2, 'Crear unidad de medida', NULL, NULL, 1453773712, 1453773712),
('unidad-medida/delete', 2, 'Eliminar unidad de medida', NULL, NULL, 1453773745, 1453773745),
('unidad-medida/index', 2, 'Lista de unidad de medida', NULL, NULL, 1453773700, 1453773700),
('unidad-medida/update', 2, 'Editar unidad de medida', NULL, NULL, 1453773728, 1453773728),
('updateOwnPost', 2, 'Update own post', NULL, NULL, 1456117284, 1456117284);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('acc_accion_especifica', 'ac-ac-espec/create'),
('sysadmin', 'ac-ac-espec/create'),
('acc_accion_especifica', 'ac-ac-espec/delete'),
('sysadmin', 'ac-ac-espec/delete'),
('acc_accion_especifica', 'ac-ac-espec/index'),
('sysadmin', 'ac-ac-espec/index'),
('acc_accion_especifica', 'ac-ac-espec/update'),
('sysadmin', 'ac-ac-espec/update'),
('acc_accion_especifica', 'ac-ac-espec/view'),
('sysadmin', 'ac-ac-espec/view'),
('acc_accion_especifica', 'ac-esp-uej/create'),
('sysadmin', 'ac-esp-uej/create'),
('acc_accion_especifica', 'ac-esp-uej/delete'),
('sysadmin', 'ac-esp-uej/delete'),
('acc_accion_especifica', 'ac-esp-uej/index'),
('sysadmin', 'ac-esp-uej/index'),
('acc_accion_especifica', 'ac-esp-uej/update'),
('accion_centralizada_asignar', 'accion-centralizada-asignar/ace'),
('sysadmin', 'accion-centralizada-asignar/ace'),
('accion_centralizada_asignar', 'accion-centralizada-asignar/asignar'),
('sysadmin', 'accion-centralizada-asignar/asignar'),
('accion_centralizada_asignar', 'accion-centralizada-asignar/create'),
('sysadmin', 'accion-centralizada-asignar/create'),
('accion_centralizada_asignar', 'accion-centralizada-asignar/delete'),
('sysadmin', 'accion-centralizada-asignar/delete'),
('accion_centralizada_asignar', 'accion-centralizada-asignar/index'),
('sysadmin', 'accion-centralizada-asignar/index'),
('accion_centralizada_asignar', 'accion-centralizada-asignar/update'),
('sysadmin', 'accion-centralizada-asignar/update'),
('accion_centralizada_asignar', 'accion-centralizada-asignar/view'),
('sysadmin', 'accion-centralizada-asignar/view'),
('accion_centralizada_requerimiento', 'accion-centralizada-pedido/bulk-activar'),
('accion_centralizada_requerimiento', 'accion-centralizada-pedido/bulk-delete'),
('accion_centralizada_requerimiento', 'accion-centralizada-pedido/bulk-desactivar'),
('accion_centralizada_requerimiento', 'accion-centralizada-pedido/create'),
('sysadmin', 'accion-centralizada-pedido/create'),
('accion_centralizada_requerimiento', 'accion-centralizada-pedido/delete'),
('accion_centralizada_requerimiento', 'accion-centralizada-pedido/index'),
('sysadmin', 'accion-centralizada-pedido/index'),
('accion_centralizada_requerimiento', 'accion-centralizada-pedido/llenarprecio'),
('accion_centralizada_requerimiento', 'accion-centralizada-pedido/pedido'),
('sysadmin', 'accion-centralizada-pedido/pedido'),
('accion_centralizada_requerimiento', 'accion-centralizada-pedido/update'),
('sysadmin', 'accion-centralizada-pedido/update'),
('accion_centralizada_requerimiento', 'accion-centralizada-pedido/view'),
('acc_variables', 'accion-centralizada-variables/create'),
('acc_variables', 'accion-centralizada-variables/delete'),
('acc_variables', 'accion-centralizada-variables/index'),
('acc_variables', 'accion-centralizada-variables/update'),
('acc_variables', 'accion-centralizada-variables/view'),
('accion_centralizada', 'accion-centralizada/create'),
('sysadmin', 'accion-centralizada/create'),
('accion_centralizada', 'accion-centralizada/delete'),
('sysadmin', 'accion-centralizada/delete'),
('accion_centralizada', 'accion-centralizada/importar'),
('sysadmin', 'accion-centralizada/importar'),
('accion_centralizada', 'accion-centralizada/index'),
('sysadmin', 'accion-centralizada/index'),
('accion_centralizada', 'accion-centralizada/update'),
('sysadmin', 'accion-centralizada/update'),
('accion_centralizada', 'accion-centralizada/view'),
('sysadmin', 'accion-centralizada/view'),
('materiales_servicios', 'materiales-servicios/create'),
('sysadmin', 'materiales-servicios/create'),
('materiales_servicios', 'materiales-servicios/delete'),
('sysadmin', 'materiales-servicios/delete'),
('materiales_servicios', 'materiales-servicios/index'),
('sysadmin', 'materiales-servicios/index'),
('materiales_servicios', 'materiales-servicios/update'),
('sysadmin', 'materiales-servicios/update'),
('registrador_accion_especifica', 'proyecto-accion-especifica/bulk-activar'),
('registrador_accion_especifica', 'proyecto-accion-especifica/bulk-desactivar'),
('registrador_accion_especifica', 'proyecto-accion-especifica/create'),
('registrador_accion_especifica', 'proyecto-accion-especifica/delete'),
('registrador_accion_especifica', 'proyecto-accion-especifica/index'),
('registrador_accion_especifica', 'proyecto-accion-especifica/toggle-activo'),
('registrador_accion_especifica', 'proyecto-accion-especifica/update'),
('registrador_accion_especifica', 'proyecto-accion-especifica/view'),
('registrador_alcance', 'proyecto-alcance/create'),
('registrador_alcance', 'proyecto-alcance/delete'),
('registrador_alcance', 'proyecto-alcance/update'),
('registrador_alcance', 'proyecto-alcance/view'),
('proyecto_asignar', 'proyecto-asignar/asignar'),
('proyecto_asignar', 'proyecto-asignar/aue'),
('proyecto_asignar', 'proyecto-asignar/bulk-activar'),
('proyecto_asignar', 'proyecto-asignar/bulk-delete'),
('proyecto_asignar', 'proyecto-asignar/bulk-desactivar'),
('proyecto_asignar', 'proyecto-asignar/create'),
('proyecto_asignar', 'proyecto-asignar/delete'),
('proyecto_asignar', 'proyecto-asignar/index'),
('proyecto_asignar', 'proyecto-asignar/pae'),
('proyecto_asignar', 'proyecto-asignar/toggle-activo'),
('proyecto_asignar', 'proyecto-asignar/update'),
('proyecto_asignar', 'proyecto-asignar/view'),
('registrador_distribucion_presupuestaria', 'proyecto-distribucion-presupuestaria/create'),
('registrador_distribucion_presupuestaria', 'proyecto-distribucion-presupuestaria/delete'),
('registrador_distribucion_presupuestaria', 'proyecto-distribucion-presupuestaria/index'),
('registrador_distribucion_presupuestaria', 'proyecto-distribucion-presupuestaria/update'),
('registrador_distribucion_presupuestaria', 'proyecto-distribucion-presupuestaria/view'),
('registrador_basico', 'proyecto-internacional/create'),
('registrador_basico', 'proyecto-internacional/delete'),
('registrador_basico', 'proyecto-internacional/index'),
('registrador_basico', 'proyecto-internacional/update'),
('registrador_basico', 'proyecto-internacional/view'),
('registrador_basico', 'proyecto-localizacion/create'),
('registrador_basico', 'proyecto-localizacion/delete'),
('registrador_basico', 'proyecto-localizacion/index'),
('registrador_basico', 'proyecto-localizacion/update'),
('registrador_basico', 'proyecto-localizacion/view'),
('proyecto_pedido', 'proyecto-pedido/bulk-activar'),
('proyecto_pedido', 'proyecto-pedido/bulk-desactivar'),
('proyecto_pedido', 'proyecto-pedido/create'),
('proyecto_pedido', 'proyecto-pedido/delete'),
('proyecto_pedido', 'proyecto-pedido/index'),
('proyecto_pedido', 'proyecto-pedido/pedido'),
('proyecto_pedido', 'proyecto-pedido/toggle-activo'),
('proyecto_pedido', 'proyecto-pedido/update'),
('proyecto_pedido', 'proyecto-pedido/view'),
('registrador_basico', 'proyecto-registrador/create'),
('registrador_basico', 'proyecto-registrador/create-alt'),
('registrador_basico', 'proyecto-registrador/delete'),
('registrador_basico', 'proyecto-registrador/index'),
('registrador_basico', 'proyecto-registrador/update'),
('registrador_basico', 'proyecto-registrador/view'),
('registrador_basico', 'proyecto-responsable-administrativo/create'),
('registrador_basico', 'proyecto-responsable-administrativo/create-alt'),
('registrador_basico', 'proyecto-responsable-administrativo/delete'),
('registrador_basico', 'proyecto-responsable-administrativo/update'),
('registrador_basico', 'proyecto-responsable-administrativo/view'),
('registrador_basico', 'proyecto-responsable-tecnico/create'),
('registrador_basico', 'proyecto-responsable-tecnico/delete'),
('registrador_basico', 'proyecto-responsable-tecnico/update'),
('registrador_basico', 'proyecto-responsable-tecnico/view'),
('registrador_basico', 'proyecto-responsable/create'),
('registrador_basico', 'proyecto-responsable/delete'),
('registrador_basico', 'proyecto-responsable/update'),
('registrador_basico', 'proyecto-responsable/view'),
('gestor_proyecto', 'proyecto/bulk-activar'),
('gestor_proyecto', 'proyecto/bulk-delete'),
('gestor_proyecto', 'proyecto/bulk-desactivar'),
('registrador_basico', 'proyecto/create'),
('gestor_proyecto', 'proyecto/delete'),
('registrador_basico', 'proyecto/delete'),
('gestor_proyecto', 'proyecto/distribucion'),
('registrador_basico', 'proyecto/index'),
('gestor_proyecto', 'proyecto/toggle-activo'),
('registrador_basico', 'proyecto/update'),
('registrador_basico', 'proyecto/view'),
('sysadmin', 'site/audit'),
('sysadmin', 'site/configuracion'),
('sysadmin', 'unidad-medida/create'),
('sysadmin', 'unidad-medida/delete'),
('sysadmin', 'unidad-medida/index'),
('sysadmin', 'unidad-medida/update');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta_presupuestaria`
--

CREATE TABLE `cuenta_presupuestaria` (
  `cuenta` char(1) NOT NULL,
  `nombre` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cuenta_presupuestaria`
--

INSERT INTO `cuenta_presupuestaria` (`cuenta`, `nombre`) VALUES
('3', 'Recursos'),
('4', 'Egresos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) CHARACTER SET utf8 NOT NULL,
  `id_pais` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id`, `nombre`, `id_pais`) VALUES
(1, 'Amazonas', 862),
(2, 'Anzoátegui', 862),
(3, 'Apure', 862),
(4, 'Aragua', 862),
(5, 'Barinas', 862),
(6, 'Bolívar', 862),
(7, 'Carabobo', 862),
(8, 'Cojedes', 862),
(9, 'Delta Amacuro', 862),
(10, 'Falcón', 862),
(11, 'Guárico', 862),
(12, 'Lara', 862),
(13, 'Mérida', 862),
(14, 'Miranda', 862),
(15, 'Monagas', 862),
(16, 'Nueva Esparta', 862),
(17, 'Portuguesa', 862),
(18, 'Sucre', 862),
(19, 'Táchira', 862),
(20, 'Trujillo', 862),
(21, 'Vargas', 862),
(22, 'Yaracuy', 862),
(23, 'Zulia', 862),
(24, 'Distrito Capital', 862),
(25, 'Dependencias Federales', 862);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estatus_proyecto`
--

CREATE TABLE `estatus_proyecto` (
  `id` int(11) NOT NULL,
  `estatus` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Lista de estatus de proyecto';

--
-- Volcado de datos para la tabla `estatus_proyecto`
--

INSERT INTO `estatus_proyecto` (`id`, `estatus`) VALUES
(1, 'Idea'),
(2, 'Prefactibilidad'),
(3, 'Por iniciar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fuente_financiamiento`
--

CREATE TABLE `fuente_financiamiento` (
  `id` int(11) NOT NULL,
  `fuente` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `fuente_financiamiento`
--

INSERT INTO `fuente_financiamiento` (`id`, `fuente`) VALUES
(1, 'RECURSOS ORDINARIOS'),
(2, 'SITUADO CONSTITUCIONAL'),
(3, 'FONDO DE COMPENSACIÓN INTERTERRITORIAL (FCI)'),
(4, 'INGRESOS PROPIOS'),
(5, 'FONDEN'),
(6, 'FONDO NACIONAL DE CIENCIA, TECNOLOGÍA E INNOVACIÓN'),
(7, 'FONDO EZEQUIEL ZAMORA'),
(8, 'FONDO SIMÓN BOLÍVAR'),
(9, 'FONDESPA'),
(10, 'FONDO NACIONAL ANTIDROGAS'),
(11, 'FONDO CONJUNTO CHINO VENEZOLANO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instancia_institucion`
--

CREATE TABLE `instancia_institucion` (
  `id` int(11) NOT NULL,
  `tipo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tipo de instancia o institución';

--
-- Volcado de datos para la tabla `instancia_institucion`
--

INSERT INTO `instancia_institucion` (`id`, `tipo`) VALUES
(1, 'Institución'),
(2, 'Instancia del Poder Popular'),
(3, 'Ambas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localizacion_acc_variable`
--

CREATE TABLE `localizacion_acc_variable` (
  `id` int(11) NOT NULL,
  `id_variable` int(11) NOT NULL,
  `id_pais` smallint(3) UNSIGNED ZEROFILL NOT NULL,
  `id_estado` int(11) DEFAULT NULL,
  `id_municipio` int(11) DEFAULT NULL,
  `id_parroquia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `localizacion_acc_variable`
--

INSERT INTO `localizacion_acc_variable` (`id`, `id_variable`, `id_pais`, `id_estado`, `id_municipio`, `id_parroquia`) VALUES
(51, 31, 862, 2, NULL, NULL),
(54, 31, 862, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materiales_servicios`
--

CREATE TABLE `materiales_servicios` (
  `id` int(11) NOT NULL,
  `cuenta` char(1) NOT NULL,
  `partida` char(2) NOT NULL,
  `generica` char(2) NOT NULL,
  `especifica` char(2) NOT NULL,
  `subespecifica` char(2) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `unidad_medida` int(11) DEFAULT NULL,
  `presentacion` int(11) DEFAULT NULL,
  `precio` decimal(12,2) NOT NULL,
  `iva` int(11) NOT NULL,
  `estatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `materiales_servicios`
--

INSERT INTO `materiales_servicios` (`id`, `cuenta`, `partida`, `generica`, `especifica`, `subespecifica`, `nombre`, `unidad_medida`, `presentacion`, `precio`, `iva`, `estatus`) VALUES
(1, '4', '02', '01', '01', '00', 'ALMUERZOS', NULL, NULL, '280.00', 12, 1),
(2, '4', '02', '10', '05', '00', 'LÁPIZ GRAFITO', NULL, NULL, '230.00', 12, 1),
(3, '4', '02', '05', '07', '00', 'PAPEL BOND BASE 20. TAMAÑO CARTA 500 HOJAS (1 X 10)', NULL, NULL, '4620.00', 12, 1),
(4, '4', '02', '03', '02', '00', 'GORRAS', NULL, NULL, '168.00', 12, 1),
(5, '4', '02', '05', '03', '00', 'BLOCK RAYADO TAMAÑO CARTA NRO. 1 (80 HOJAS)', NULL, NULL, '63.00', 12, 1),
(6, '4', '02', '05', '01', '00', 'ETIQUETAS AUTOADHESIVAS 1X100', NULL, NULL, '2324.00', 12, 1),
(7, '4', '03', '07', '02', '00', 'DISEÑO E IMPRESIÓN DE TRÍPTICOS', NULL, NULL, '49.00', 12, 1),
(8, '4', '03', '09', '01', '00', 'VIÁTICOS Y PASAJES AÉREOS', NULL, NULL, '4606.00', 12, 1),
(9, '4', '02', '04', '03', '00', 'NEUMÁTICO (CAUCHO) PARA CAMIONETA', NULL, NULL, '13500.00', 12, 1),
(10, '4', '02', '06', '06', '00', 'ACEITE DE MOTOR', NULL, NULL, '4000.00', 12, 1),
(11, '4', '04', '07', '06', '00', 'ALTAVOCES', NULL, NULL, '13300.00', 12, 1),
(12, '4', '04', '07', '02', '00', 'VIDEO BEAM EPSON POWERLITE S12', NULL, NULL, '50400.00', 12, 1),
(13, '4', '02', '10', '08', '00', 'DISCOS COMPACTOS (CD)', NULL, NULL, '5200.00', 12, 1),
(14, '4', '02', '10', '02', '00', 'DETERGENTES', NULL, NULL, '5.00', 12, 1),
(15, '4', '02', '03', '01', '00', 'TELA DE TAPICERÍA', NULL, NULL, '364.00', 12, 1),
(16, '4', '02', '05', '02', '00', 'VASOS CÓNICOS (1X150)', NULL, NULL, '1680.00', 12, 1),
(17, '4', '02', '06', '08', '00', 'VASOS PLÁSTICOS PARA CAFÉ 150 CC 1X100 (GRANDES)', NULL, NULL, '104.00', 12, 1),
(18, '4', '02', '10', '12', '00', 'ACCESORIOS PARA SALAS DE BAÑOS', NULL, NULL, '3500.00', 12, 1),
(19, '4', '02', '08', '03', '00', 'CANILLA DE 1/2 X 1/2', NULL, NULL, '5.00', 12, 1),
(20, '4', '04', '05', '01', '00', 'TELÉFONO ANALÓGICO', NULL, NULL, '5180.00', 12, 1),
(21, '4', '04', '09', '01', '00', 'SILLA EJECUTIVA EN TELA', NULL, NULL, '5445.00', 12, 1),
(22, '4', '04', '09', '02', '00', 'COMPUTADORAS DE ESCRITORIO', NULL, NULL, '24848.00', 12, 1),
(23, '4', '04', '03', '04', '00', 'FOTOCOPIADORAS', NULL, NULL, '65800.00', 12, 1),
(24, '4', '02', '10', '11', '00', 'REGULADOR DE VOLTAJE AVTEK 1KA', NULL, NULL, '5880.00', 12, 1),
(25, '4', '02', '06', '04', '00', '(250 G) 1 BOLSA DE 250 G', NULL, NULL, '32.00', 12, 1),
(26, '4', '02', '10', '03', '00', 'PAÑITOS DE LIMPIEZA 3M', NULL, NULL, '146.00', 12, 1),
(27, '4', '04', '09', '03', '00', 'MICROONDAS', NULL, NULL, '6720.00', 12, 1),
(28, '4', '04', '09', '99', '00', 'EXTINTOR DE CO2 DE 10 LBS', NULL, NULL, '7700.00', 12, 1),
(29, '4', '02', '06', '03', '00', 'PINTURA DE CAUCHO ', NULL, NULL, '1613.00', 12, 1),
(30, '4', '04', '06', '01', '00', 'CAMILLAS DE ADULTOS', NULL, NULL, '7700.00', 12, 1),
(31, '4', '02', '10', '04', '00', 'VENDAJES', NULL, NULL, '1400.00', 12, 1),
(32, '4', '02', '10', '07', '00', 'TAPA BOCAS O MASCARILLAS', NULL, NULL, '560.00', 12, 1),
(33, '4', '02', '08', '07', '00', 'SEÑALES DE SEGURIDAD', NULL, NULL, '392.00', 12, 1),
(34, '4', '04', '03', '05', '00', 'HERRAMIENTAS MALETÍN DE 45 HERRAMIENTAS PARA REDES Y PC', NULL, NULL, '50050.00', 12, 1),
(35, '4', '04', '06', '99', '00', 'EQUIPO DE HIDROTERAPIA', NULL, NULL, '80000.00', 12, 1),
(36, '4', '03', '07', '03', '00', 'BOLSAS DE HIELO', NULL, NULL, '157.00', 12, 1),
(37, '4', '04', '03', '01', '00', 'ESCALERAS PORTÁTILES', NULL, NULL, '13720.00', 12, 1),
(38, '4', '03', '99', '01', '00', 'CONTRATACIÓN DE SERVICIOS DE PERITO EVALUADOR', NULL, NULL, '42000.00', 12, 1),
(39, '4', '04', '11', '02', '00', 'ADQUISICIÓN DE EDIFICIOS E INSTALACIONES', NULL, NULL, '23000000.00', 12, 1),
(40, '4', '04', '11', '01', '00', 'TERRENO', NULL, NULL, '7000.00', 12, 1),
(41, '4', '03', '10', '04', '00', 'LEVANTAMIENTO TOPOGRÁFICO ', NULL, NULL, '6.00', 12, 1),
(42, '4', '03', '07', '04', '00', 'VALLA DE PUBLICIDAD', NULL, NULL, '2500.00', 12, 1),
(43, '4', '04', '15', '05', '00', 'CONSTRUCCIÓN', NULL, NULL, '7421.00', 12, 1),
(44, '4', '02', '05', '04', '00', 'LIBROS', NULL, NULL, '238.00', 12, 1),
(45, '4', '03', '09', '02', '00', 'BOLETOS AÉREOS FUERA DEL PAÍS (EUROPA)', NULL, NULL, '112000.00', 12, 1),
(46, '4', '03', '01', '01', '00', 'ALQUILERES DE EDIFICIO', NULL, NULL, '8084902.00', 12, 1),
(47, '4', '03', '04', '01', '00', 'ELECTRICIDAD', NULL, NULL, '1624798.00', 12, 1),
(48, '4', '03', '04', '02', '00', 'SERVICIO DE GAS', NULL, NULL, '2700.00', 12, 1),
(49, '4', '03', '04', '05', '00', 'INTERNET', NULL, NULL, '2000000.00', 12, 1),
(50, '4', '03', '04', '06', '00', 'SERVICIO DE ASEO URBANO Y DOMICILIARIO', NULL, NULL, '455225.00', 12, 1),
(51, '4', '03', '04', '07', '00', 'CONDOMINIO', NULL, NULL, '9350746.00', 12, 1),
(52, '4', '03', '06', '01', '00', 'FLETES Y EMBALAJE', NULL, NULL, '378000.00', 12, 1),
(53, '4', '03', '06', '03', '00', 'ESTACIONAMIENTO', NULL, NULL, '19530.00', 12, 1),
(54, '4', '03', '06', '05', '00', 'SERVICIO DE PROTECCIÓN EN TRASLADO DE FONDOS Y DE MENSAJERÍA', NULL, NULL, '208000.00', 12, 1),
(55, '4', '03', '08', '01', '00', 'GASTOS DE SEGURO PARA VEHÍCULOS AUTOMOTORES', NULL, NULL, '105000.00', 12, 1),
(56, '4', '03', '08', '02', '00', 'COMISIONES Y GASTOS BANCARIOS', NULL, NULL, '1260.00', 12, 1),
(57, '4', '03', '10', '99', '00', 'OTROS SERVICIOS PROFESIONALES Y TÉCNICOS', NULL, NULL, '8400.00', 12, 1),
(58, '4', '04', '03', '02', '00', 'REMACHADORAS DE BANDAS DE FRENO', NULL, NULL, '44800.00', 12, 1),
(59, '4', '04', '04', '01', '00', 'AUTOMÓVILES', NULL, NULL, '150900.00', 12, 1),
(60, '4', '11', '11', '04', '00', 'COMPROMISOS PENDIENTES DE EJERCICIOS ANTERIORES', NULL, NULL, '2000000.00', 12, 1),
(61, '4', '03', '11', '07', '00', 'MANTENIMIENTO DE AIRE ACONDICIONADO', NULL, NULL, '16741.00', 12, 1),
(62, '4', '03', '11', '02', '00', 'MANTENIMIENTO DE ASCENSORES', NULL, NULL, '69384.00', 12, 1),
(63, '4', '02', '08', '02', '00', 'LAMINA DE ACEROLIT 3 X 0.82', NULL, NULL, '756.00', 12, 1),
(64, '4', '02', '08', '99', '00', 'LAMINA DE ALUMINIO 1', NULL, NULL, '196.00', 12, 1),
(65, '4', '02', '10', '99', '00', 'MANGUERAS DE ALTA RESISTENCIA DE 25MTS', NULL, NULL, '4480.00', 12, 1),
(66, '4', '02', '08', '04', '00', 'BASE PARA TELEVISIÓN', NULL, NULL, '20132.00', 12, 1),
(67, '4', '02', '10', '01', '00', 'PELOTAS', NULL, NULL, '2450.00', 12, 1),
(68, '4', '02', '08', '09', '00', 'JUEGO COMPLETO DE EMPACADURA CHEVROLET LUV DMAX', NULL, NULL, '6387.00', 12, 1),
(69, '4', '03', '10', '07', '00', 'SERVICIO DE CAPACITACIÓN Y ADIESTRAMIENTO', NULL, NULL, '8400.00', 12, 1),
(70, '4', '03', '04', '03', '00', 'SERVICIO DE AGUA', NULL, NULL, '1485304.00', 12, 1),
(71, '4', '02', '99', '01', '00', 'MATEROS', NULL, NULL, '600.00', 12, 1),
(72, '4', '02', '10', '06', '00', 'BANDEJAS PARA COLOCAR LAS CONDECORACIONES (JOYA)', NULL, NULL, '280.00', 12, 1),
(73, '4', '03', '07', '01', '00', 'CINTILLOS', NULL, NULL, '63000.00', 12, 1),
(74, '4', '03', '18', '01', '00', 'IMPUESTO AL VALOR AGREGADO (UNIFORMES OBREROS)', NULL, NULL, '12480000.00', 12, 1),
(75, '4', '03', '12', '01', '00', 'REPARACIÓN DE GARAJE Y TRANSPORTE', NULL, NULL, '280028.00', 12, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1449374474),
('m140506_102106_rbac_init', 1449375197),
('m150122_115959_activerecordhistory_init', 1455311512),
('m150626_000001_create_audit_entry', 1458325958),
('m150626_000002_create_audit_data', 1458325958),
('m150626_000003_create_audit_error', 1458325959),
('m150626_000004_create_audit_trail', 1458325959),
('m150626_000005_create_audit_javascript', 1458325959),
('m150626_000006_create_audit_mail', 1458325959),
('m150703_191015_init', 1449787681),
('m150714_000001_alter_audit_data', 1458325959),
('m151008_162401_create_notification_table', 1460920146),
('m151013_131405_add_user_field', 1455311512);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelhistory`
--

CREATE TABLE `modelhistory` (
  `id` bigint(20) NOT NULL,
  `date` datetime NOT NULL,
  `table` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `field_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `field_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `old_value` text COLLATE utf8_unicode_ci,
  `new_value` text COLLATE utf8_unicode_ci,
  `type` smallint(6) NOT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipio`
--

CREATE TABLE `municipio` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `id_estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `key` varchar(255) NOT NULL,
  `key_id` int(11) DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `seen` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `notification`
--

INSERT INTO `notification` (`id`, `key`, `key_id`, `type`, `user_id`, `seen`, `created_at`) VALUES
(2, 'nuevo_pedido', 8, 'default', 1, 1, '2016-04-17 17:05:44'),
(3, 'nuevo_pedido', 9, 'default', 1, 1, '2016-04-17 18:28:30'),
(4, 'nuevo_pedido', 9, 'default', 2, 0, '2016-04-17 18:28:30'),
(5, 'nuevo_pedido', 10, 'default', 1, 1, '2016-06-02 20:54:55'),
(6, 'nuevo_pedido', 10, 'default', 2, 0, '2016-06-02 20:54:55'),
(7, 'nuevo_pedido', 1, 'default', 1, 1, '2016-06-23 12:16:20'),
(8, 'nuevo_pedido', 1, 'default', 2, 0, '2016-06-23 12:16:20'),
(9, 'nuevo_pedido', 2, 'default', 1, 1, '2016-06-23 12:16:51'),
(10, 'nuevo_pedido', 2, 'default', 2, 0, '2016-06-23 12:16:51'),
(11, 'nuevo_pedido', 3, 'default', 1, 1, '2016-06-29 22:22:19'),
(12, 'nuevo_pedido', 3, 'default', 2, 0, '2016-06-29 22:22:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `objetivos_estrategicos`
--

CREATE TABLE `objetivos_estrategicos` (
  `id` int(11) NOT NULL,
  `objetivo_estrategico` text NOT NULL,
  `objetivo_nacional` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Objetivos estrategicos - Area estrategica';

--
-- Volcado de datos para la tabla `objetivos_estrategicos`
--

INSERT INTO `objetivos_estrategicos` (`id`, `objetivo_estrategico`, `objetivo_nacional`) VALUES
(1, 'Fortalecer a través de los procesos electorales la Revolución Bolivariana, elevando la moral y la conciencia del pueblo venezolano y de los pueblos del mundo en su lucha por la emancipación. ', 1),
(2, 'Preparar la defensa de la voluntad del pueblo, mediante la organización popular y el ejercicio democrático de la autoridad del Estado', 1),
(3, 'Fortalecer y expandir el Poder Popular.', 1),
(4, 'Preservar y recuperar los espacios de gobierno regional y local, para profundizar la restitución del poder al pueblo.', 1),
(5, 'Seguir construyendo la soberanía y democratización comunicacional. ', 1),
(6, 'Fortalecer el rol del Estado en la administración y explotación de los recursos hidrocarburiferos y mineros.', 2),
(7, 'Mantener y garantizar el control por parte del Estado sobre Petróleos de Venezuela S.A. (PDVSA).', 2),
(8, 'Mantener y garantizar el control por parte del Estado de las empresas nacionales que exploten los recursos mineros en el territorio nacional.', 2),
(9, 'Promover y estimular la investigación científica y el desarrollo tecnológico, con el propósito de asegurar las operaciones medulares de la industria petrolera. ', 2),
(10, 'Asegurar los medios para el control efectivo de las actividades conexas y estratégicas asociadas a la cadena industrial de explotación de los recursos hidrocarburiferos.', 2),
(11, 'Fortalecer la coordinación de políticas petroleras en el seno de la OPEP y otros organismos internacionales, para la justa valorización de nuestros recursos naturales.', 2),
(12, 'Impulsar y promover una iniciativa de coordinación entre los países gigantes petroleros. ', 2),
(13, 'Asegurar los medios para el control efectivo de las actividades conexas y estratégicas asociadas a la cadena industrial de explotación de los recursos mineros.', 2),
(14, 'Lograr una instancia de coordinación de políticas gasíferas para una valorización justa y razonable del gas.', 2),
(15, 'Elevar la conciencia política e ideológica del Pueblo y de los trabajadores petroleros y mineros, así como también su participación activa en la defensa de los recursos naturales estratégicos de la Nación. ', 2),
(16, 'Crearlas condiciones para influir en a valorización de los precios de los minerales.', 2),
(17, 'Garantizar la propiedad y uso de los recursos naturales del país, de forma soberana, para la satisfacción de las demandas internas así como su uso en función de los más altos intereses nacionales. ', 2),
(18, 'Mantener y fortalecer el actual régimen fiscal petrolero para garantizar si bienestar del pueblo. ', 3),
(19, 'Mantener y fortalecer mecanismos eficaces de captación de la renta excedentaria, por incrementos extraordinarios de los precios internacionales de los hidrocarburos. ', 3),
(20, 'Establecer y desarrollar un régimen fiscal minero, así como mecanismos de captación eficientes para la recaudación de la renta por la actividad minera.', 3),
(21, 'Establecer mecanismos de control sobre la comercialización de los minerales.', 3),
(22, 'Fortalecer y profundizar acuerdos financieros con socios estratégicos.', 3),
(23, 'Mantener y consolidar los convenios de cooperación, solidaridad y complementariedad con países aliados.', 3),
(24, 'Fortalecer los mecanismos de cooperación en el mercado común del Sur (MERCOSUR).', 3),
(25, 'Diseñar y establecer mecanismos novedosos y efectivos, orientados a promover la participación popular en la renta petrolera, tales como la inversión y el ahorro.', 3),
(26, 'Compatibilizar el sistema impositivo hacia estándares internacionales de eficiencia tributaria para alcanzar acuerdos comerciales más efectivos y eficientes con los países socios, salvaguardando la soberanía nacional.', 3),
(27, 'Mejorar y promover la eficiencia de la gestión fiscal del sector público para generar mayor transparencia, y confiabilidad sobre el impacto económico y social de la política fiscal.', 3),
(28, 'Eliminar definitivamente el latifundio. Realizar un proceso de organización y zonificación agroecológica en base a las capacidades de uso de la tierra y crear un sistema de catastro rural para garantizar el acceso justo y uso racional del recurso suelo.', 4),
(29, 'Acelerar la democratización del acceso de los campesinos y campesinas, productores y productoras, y de las distintas formas colectivas y empresas socialistas, a los recursos necesarios para la producción (tierra, agua, riego, semillas, capital), impulsando el uso racional y sostenible de los mismos.', 4),
(30, 'Afianzar un conjunto de políticas públicas de apoyo a la producción, distribución, comercialización y organización del sector rural y participación del poder popular campesino en la implementación de un Plan Nacional de Producción de Alimentos que garantice la soberanía alimentaria.', 4),
(31, ' Fortalecer la infraestructura, el desarrollo y funcionamiento de los grandes polos socialistas de producción primaria agropecuaria y grandes sistemas de riego, gestionados a través de empresas socialistas, privilegiando la integración de los procesos productivos a escala industrial.', 4),
(32, 'Consolidar las redes de producción y distribución de productos de consumo directo y del sistema de procesamiento agroindustrial.', 4),
(33, 'Crear, consolidar y apoyar centros de venta y distribución directa de productos agropecuarios y otros de consumo masivo, locales y en las grandes ciudades, garantizando su acceso a precio justo por parte de la población y una remuneración justa al trabajo campesino e incentivando el desarrollo del comercio local, nacional y de exportación.', 4),
(34, 'Consolidar el aparato agroindustrial bajo control de empresas socialistas, garantizando al menos un % de la capacidad de almacenamiento y procesamiento en rubros básicos (cereales, oleaginosas, leguminosas, azúcar, carne y leche) y un % en el resto de los rubros alimenticios.', 4),
(35, 'Desarrollar un sistema de apoyo e incentivos para la promoción del comercio internacional de exportación de rubros agrícolas.', 4),
(36, 'Establecer mecanismos para ejercer la nueva institucionalidad revolucionaria que garantice la participación de los pequeños y medianos productores en las decisiones en materia agropecuaria, a través de los consejos campesinos y las redes de productores y productoras libres y asociados.', 4),
(37, 'Promover los modelos de producción diversificados, a partir de la agricultura familiar, \' campesina, urbana, periurbana e indígena, recuperando, validando y divulgando modelos tradicionales y sostenibles de producción.', 4),
(38, 'Consolidar un estilo científico, tecnológico e innovador de carácter transformador, diverso, creativo y dinámico, garante de la independencia y la soberanía económica, contribuyendo así a la construcción del Modelo Productivo Socialista, el fortalecimiento de la Ética Socialista y la satisfacción efectiva de las necesidades del pueblo venezolano.', 5),
(39, 'Fortalecer los espacios y programas de formación para el trabajo liberador, fomentando los valores patrióticos y el sentido crítico.', 5),
(40, 'Impulsar el desarrollo y uso de equipos electrónicos y aplicaciones informáticas en tecnologías libres y estándares abiertos.', 5),
(41, ' Establecer una política satelital del Estado venezolano para colocar la actividad al servicio del desarrollo general de la Nación.', 5),
(42, 'Incrementar la capacidad defensiva del país con la consolidación y afianzamiento de la redistribución territorial de la Fuerza Armada Nacional Bolivariana.', 6),
(43, 'Consolidar la Gran Misión Soldado de la Patria Negro Primero como política integral de fortalecimiento de la Fuerza Armada Nacional Bolivariana, que asegure bienestar, seguridad social y protección a la familia militar venezolana,el equipamiento, mantenimiento e infraestructura militar,la participación de la FANB en las tareas de desarrollo nacional,y el desarrollo educativo de sus componentes.', 6),
(44, 'Fortalecer e incrementar el sistema de Inteligencia y Contrainteligencia Militar para la Defensa Integral de la Patria.', 6),
(45, 'Fortalecer la Milicia Nacional Bolivariana.', 6),
(46, ' Incrementar y mantener el apresto operacional de la Fuerza Armada Nacional Bolivariana para la Defensa Integral de la Nación.', 6),
(47, 'Crear el Sistema Integral de Gestión de los estados de excepción.', 7),
(48, 'Crear el Sistema Logístico Nacional, integrando el Sistema Logístico de la Fuerza Armada Nacional Bolivariana.', 7),
(49, 'Impulsar nuevas formas de organización que pongan al servicio de la sociedad los medios de producción, y estimulen la generación de un tejido productivo sustentable enmarcado en el nuevo metabolismo para la transición al socialismo.', 8),
(50, 'Desarrollar un sistema de fijación de precios justos para los bienes y servicios, combatiendo las prácticas de ataque a la moneda, acaparamiento, especulación, usura y otros falsos mecanismos de fijación de precios, mediante el fortalecimiento de las leyes e instituciones responsables y la participación protagónica del Poder Popular, para el desarrollo de un nuevo modelo productivo diversificado, sustentado en la cultura del trabajo.', 8),
(51, 'Expandir e integrar las cadenas productivas, generando la mayor cantidad de valor agregado y orientándolas hacia la satisfacción de las necesidades sociales para la construcción del socialismo, promoviendo la diversificación del aparato productivo.', 8),
(52, 'Desarrollar modelos incluyentes de gestión de las unidades productivas, participativos con los trabajadores y trabajadoras, alineados con las políticas nacionales, así como con una cultura del trabajo que se contraponga al rentismo petrolero, desmontando la estructura oligopólica y monopólica existente.', 8),
(53, 'Fortalecer el sistema de distribución directa de los insumos y productos, atacando la especulación propia del capitalismo, para garantizar la satisfacción de las necesidades del pueblo.', 8),
(54, 'Superar las formas de explotación capitalistas presentes en el proceso social del trabajo, a través del despliegue de relaciones socialistas entre trabajadores y trabajadoras con este proceso, como espacio fundamental para el desarrollo integral de la población.', 9),
(55, 'Consolidar el Sistema Nacional de Misiones y Grandes Misiones Socialistas Hugo Chávez, como conjunto integrado de políticas y programas que materializan los derechos y garantías del Estado Social de Derecho y de Justicia y sirve de plataforma de organización, articulación y gestión de la política social en los distintos niveles territoriales del país, para dar mayor eficiencia y eficacia a las políticas sociales de la Revolución.', 9),
(56, 'Potenciar las expresiones culturales liberadoras del pueblo.', 9),
(57, 'Consolidar la equidad de género con valores socialistas, garantizando y respetando los derechos de todos y todas, y la diversidad social.', 9),
(58, 'Fomentar la inclusión y el vivir bien de los pueblos Indígenas.', 9),
(59, 'Propiciar las condiciones para el desarrollo de una cultura de recreación y práctica deportiva liberadora, ambientalista e integradora en torno a los valores de la Patria, como vía para la liberación de la conciencia, la paz y la convivencia armónica.', 9),
(60, 'Fortalecer el protagonismo de la juventud en el desarrollo y consolidación de la Revolución Bolivariana.', 9),
(61, 'Seguir avanzando en la transformación del sistema penitenciario para la prestación de un servicio que garantice los derechos humanos de las personas privadas de libertad y favorezca su inserción productiva en la sociedad.', 9),
(62, 'Continuar combatiendo la desigualdad a través de la erradicación de la pobreza extrema y disminución de la pobreza general, hacia su total eliminación.', 9),
(63, ' Asegurar la salud de la población desde la perspectiva de prevención y promoción de la calidad de vida, teniendo en cuenta los grupos sociales vulnerables, etarios, etnias, género, estratos y territorios sociales.', 9),
(64, 'Asegurar una alimentación saludable, una nutrición adecuada a lo largo del ciclo de vida y la lactancia materna, en concordancia con Ios mandatos constitucionales sobre salud, soberanía y seguridad alimentaria, profundizando y ampliando las condiciones que las garanticen:', 9),
(65, 'Continuar garantizando el derecho a la educación con calidad y pertinencia, a través del mejoramiento de las condiciones de ingreso, prosecución y egreso del sistema educativo.', 9),
(66, 'Consolidar las Misiones, Grandes Misiones Socialistas como instrumento revolucionario para nuevo Estado democrático, social de derecho y de justicia.', 9),
(67, 'Promover la construcción del Estado Social de Derecho y de Justicia a través de la consolidación y expansión del poder popular organizado.', 10),
(68, 'Impulsar la transformación del modelo económico rentístico hacia el nuevo modelo productivo diversificado y socialista, con participación protagónica de las instancias del Poder Popular.', 10),
(69, 'Garantizar la transferencia de competencias en torno a la gestión y administración de lo público desde las distintas instancias del Estado hacía las comunidades organizadas.', 10),
(70, 'Impulsar la corresponsabilidad del Poder Popular en la lucha por la inclusión social y erradicación de la pobreza.', 10),
(71, 'Consolidar la formación integral socialista, permanente y continua, en los diferentes procesos de socialización e intercambio de saberes del Poder Popular, fortaleciendo habilidades y estrategias para el ejercicio de lo público y el desarrollo socio-cultural y productivo de las comunidades.', 10),
(72, 'Preservar los valores bolivarianos liberadores, igualitarios, solidarios del pueblo venezolano y fomentar el desarrollo de una nueva ética socialista.', 11),
(73, 'Fortalecer la contraloría social, para mejorar el desempeño de la gestión pública, de las instancias del Poder Popular y las actividades privadas que afecten el interés colectivo.', 11),
(74, 'Desatar la potencia contenida en la Constitución Bolivariana para el ejercicio de la democracia participativa y protagónica.', 12),
(75, 'Desarrollar el Sistema Federal de Gobierno, basado en los principios de integridad territorial, económica y política de la Nación, mediante la participación protagónica del Poder Popular en las funciones de gobierno comunal y en la administración de los medios de producción de bienes y servicios de propiedad social.', 12),
(76, ' Acelerar la construcción de la nueva plataforma institucional del Estado, en el marco del nuevo modelo de Gestión Socialista Bolivariano.', 12),
(77, 'Impulsar una profunda, definitiva e impostergable revolución en el sistema de administración de Justicia, entre los Poderes Públicos y el Poder Popular, que garantice la igualdad de condiciones y oportunidades a toda la población a su acceso y aplicación.', 12),
(78, 'Desplegar en sobre marcha la Gran Misión A Toda Vida Venezuela concebida como una política integral de seguridad ciudadana, con el fin de transformar los factores de carácter estructural, situacional e institucional, generadores de la violencia y el delito, para reducirlos, aumentando la convivencia solidaria y el disfrute del pueblo al libre y seguro ejercicio de sus actividades familiares, comunales, sociales, formativas, laborales, sindicales, económicas, culturales y recreacionales.', 12),
(79, 'Fortalecer el Sistema Nacional de Planificación Pública y Popular para la construcción de la sociedad socialista de justicia y equidad, en el marco del nuevo Estado democrático y social de Derecho y de Justicia.', 12),
(80, 'Fortalecer el Sistema Estadístico Nacional en sus mecanismos, instancias y operaciones estadísticas.', 12),
(81, ' Impulsar el desarrollo de la normativa legal e Infraestructura necesaria para la consolidación de Gobierno Electrónico.', 12),
(82, 'Desarrollar la capacidad de producción del país en línea con las inmensas reservas de hidrocarburos, bajo el principio de la explotación racional y la política de conservación del recurso natural agotable y no renovable.', 13),
(83, 'Desarrollar la Faja Petrolífera del Orinoco, para alcanzar, mediante las reservas probadas, ya certificadas, una capacidad de producción total de  MMBD para el , en concordancia con los objetivos estratégicos de producción de crudo, bajo una política ambientalmente responsable.', 13),
(84, 'Mantener la producción en las áreas tradicionales de petróleo y gas.', 13),
(85, 'Desarrollar las reservas del Cinturón Gasífero en nuestro mar territorial. Incrementando la capacidad de producción y acelerando los esfuerzos exploratorios de nuestras reservas.', 13),
(86, 'Adecuar y expandir el circuito de refinación nacional para el incremento de la capacidad de procesamiento de hidrocarburos, en especifico crudo extra pesado de la Faja, desconcentrando territorialmente la manufactura de combustible y ampliando la cobertura territorial de abastecimiento de las refinerías.', 13),
(87, 'Expandir la infraestructura de transporte, almacenamiento y despacho de petróleo y gas, sobre la base de complementar los objetivos de seguridad energética de la Nación, la nueva geopolítica nacional y él incremento de la producción nacional de petróleo y gas.', 13),
(88, 'Fortalecer y expandir la industria petroquímica nacional.', 13),
(89, 'Desarrollar el complejo industrial conexo a la industria petrolera, gasífera y petroquímica para fortalecer y profundizar nuestra soberanía económica.', 13),
(90, 'Fortalecer y profundizar la soberanía tecnológica del sector hidrocarburos.', 13),
(91, 'Profundizar la diversificación de nuestros mercados internacionales de hidrocarburos, con el objetivo de utilizar la fortaleza de ser un país potencia energética, para desplegar nuestra propia geopolítica.', 13),
(92, 'Fortalecer y profundizar las capacidades operativas de PDVSA.', 13),
(93, 'Garantizar la Seguridad Energética del país, optimizando la eficiencia en la planificación estratégica y táctica, que permita minimizar los riesgos inherentes a los flujos energéticos en el territorio.', 13),
(94, 'Fortalecer al Estado en el control y gestión del sistema eléctrico nacional para su ampliación y consolidación.', 13),
(95, 'Fortalecer y profundizar la cooperación energética internacional.', 13),
(96, 'Contribuir al desarrollo del sistema económico nacional mediante la explotación y transformación racional sustentable de los recursos minerales, con el uso de tecnología de bajo impacto ambiental.', 13),
(97, 'Desarrollar el potencial minero nacional para la diversificación de las fuentes de empleo, ingresos y formas de propiedad social.', 13),
(98, 'Avanzar hacia la soberanía e independencia productiva en la construcción de redes estratégicas tanto para bienes esenciales como de generación de valor, a partir de nuestras ventajas comparativas.', 14),
(99, 'Aprovechar las ventajas de localización de nuestro país a escala continental y diversidad de regiones nacionales, a efecto dé fomentar su especialización productiva, asociada a ventajas comparativas de sectores estratégicos.', 14),
(100, 'Apropiar y desarrollar la técnica y tecnología como clave de la eficiencia y humanización del proceso productivo, andando eslabones de las cadenas productivas y desatando el potencial espacial de las mismas.', 14),
(101, 'Generar mecanismos de circulación del capital que construyan un nuevo metabolismo económico para el estimuló, funcionamiento y desarrollo de la industria nacional.', 14),
(102, 'Desarrollar, fortalecer e impulsar los eslabones productivos de la industria nacional identificados en proyectos de áreas prioritarias tales como automotriz, electrodomésticos, materiales de construcción, transformación de plástico y envases, química, hierro, acero, aluminio, entre otras,orientados por un mecanismo de planificación centralizada, sistema presupuestario y modelos de gestión eficientes y productivos cónsonos con la transición al socialismo.', 14),
(103, 'Fortalecer el sector turismo como estrategia de inclusión social que facilite y garantice al pueblo venezolano, fundamentalmente a las poblaciones más vulnerables, el acceso a su patrimonio turístico (destinos turísticos) y el disfrute de las infraestructuras turísticas del Estado en condiciones de precios justos y razonables.', 14),
(104, 'Desarrollar el sector turismo como una actividad productiva sustentable que genere excedentes que puedan redistribuirse para satisfacer las necesidades del pueblo.', 14),
(105, 'Fortalecer la industria militar venezolana.', 15),
(106, 'Desarrollar el sistema de adiestramiento con la doctrina militar Bolivariana para la Defensa Integral de la Patria.', 15),
(107, 'Mejorar y perfeccionar el sistema educativo de la Fuerza Armada Nacional y el Poder Popular, para fortalecer la unidad cívico militar en función de los intereses de la Patria.', 15),
(108, 'Profundizar la integración soberana nacional y la equidad socio-territorial a través de Ejes de Desarrollo Integral: Norte Llanero, Apure-Orinoco, Occidental y Oriental, Polos de Desarrollo Socialista, Distritos Motores de Desarrollo, las Zonas Económicas Especiales y REDIS.', 16),
(109, 'Mantener y garantizar el funcionamiento del Consejo Federal de Gobierno, las instancias que lo conforman, así como las formas de coordinación de políticas y acciones entre las entidades político-territoriales y las organizaciones de base del Poder Popular.', 16),
(110, 'Promover la creación del los Distritos Motores de Desarrollo, con la finalidad de impulsar proyectos económicos, sociales, científicos y tecnológicos destinados a lograr el desarrollo integral de las regiones y el fortalecimiento del Poder Popular, en aras de facilitar la transición hacia el socialismo.', 16),
(111, 'Mejorar e incrementar la infraestructura en las áreas de producción agrícola.', 16),
(112, 'Integrar el territorio nacional, mediante los corredores multimodales de infraestructura: transporte terrestre, ferroviario, aéreo, fluvial, energía eléctrica, gas, petróleo, agua y telecomunicaciones.', 16),
(113, 'Planificar desde el Gobierno Central y con protagonismo popular, el desarrollo urbano y rural de las ciudades existentes y de las nacientes a lo largo de nuestro territorio nacional.', 16),
(114, 'Reforzar y desarrollar mecanismos de control que permitan al Estado ejercer eficazmente su soberanía en el intercambio de bienes en las zonas fronterizas.', 16),
(115, 'Fortalecer la Alianza Bolivariana para los Pueblos de Nuestra América (ALBA) como el espacio vital de relacionamiento político de la Revolución Bolivariana.', 17),
(116, 'Fortalecer la iniciativa Petrocaribe como esquema de cooperación energética y social solidario.', 17),
(117, 'Fortalecer Mercosur como espacio de cooperación e integración social, política, económica, productiva y comercial.', 17),
(118, 'Consolidar la Unión de Naciones Suramericanas (Unasur) como espacio estratégico regional para la construcción del mundo pluripolar.', 17),
(119, 'Impulsar y fortalecer a la Comunidad de Estados Latinoamericanos y Caribeños (Celac), como mecanismo de unión de Nuestra América.', 17),
(120, 'Fortalecer las alianzas estratégicas bilaterales con los países de Nuestra América, como base para impulsar los esquemas de integración y unión subregionales y regionales', 17),
(121, 'Avanzar en la creación de encadenamientos económicos productivos y esquemas de financiamiento con América Latina y el Caribe, que fortalezcan la industria nacional y garanticen el suministro seguro de productos.', 17),
(122, 'Profundizar las alianzas estratégicas bilaterales existentes entre Venezuela y los países de la región, con especial énfasis en la cooperación con Brasil, Argentina y Uruguay, en las distintas áreas de complementación y cooperación en marcha.', 17),
(123, 'Impulsar el nuevo orden comunicacional! de Nuestra América, con especial énfasis en los nuevos sistemas y medios de información regionales y en el impulso de nuevas herramientas comunicacionales.', 17),
(124, 'Promover la resolución armoniosa y cooperativa de las delimitaciones pendientes, entendiendo la estabilización de las fronteras como un elemento de unidad y de paz.', 17),
(125, 'Consolidar la visión de la heterogeneidad y diversidad étnica de Venezuela y Nuestra América, bajo el respete e inclusión participativa y protagónica de las minorías y pueblos originarios.', 18),
(126, 'Crear y consolidar la institucionalidad nacional nuestroamericana en las organizaciones de cooperación e integración.', 18),
(127, 'Conformar una red de relaciones políticas con los polos de poder emergentes.', 19),
(128, 'Conformar un nuevo orden comunicacional del Sur.', 19),
(129, 'Impulsar la diplomacia de los pueblos y la participación protagónica de los movimientos populares organizados en la construcción de un mundo multipolar y en equilibrio.', 19),
(130, 'Deslindar a Venezuela de los mecanismos internacionales de dominación imperial.', 20),
(131, 'Reducir el relacionamiento económico y tecnológico con los centros imperiales de dominación a niveles que no comprometan la independencia nacional.', 20),
(132, 'Profundizar y ampliar el relacionamiento con los polos emergentes del mundo nuevo.', 20),
(133, 'Impulsar de manera colectiva la construcción y consolidación del socialismo como única opción frente al modelo depredador, discriminador e insostenible capitalista.', 21),
(134, 'Promover, a nivel nacional e internacional, una ética ecosocialista que impulse la transformación de los patrones insostenibles de producción y de consumo propios del sistema capitalista.', 21),
(135, 'Generar alternativas socio-productivas y nuevos esquemas de cooperación social, económica y financiera para el apalancamiento del ecososcialismo y el establecimiento de un comercio justo, bajo los principios de complementariedad, cooperación, soberanía y solidaridad.', 21),
(136, 'Impulsar la protección del ambiente, la eficiencia en la utilización de recursos y el logro de un desarrollo sostenible, implementando la reducción y el reúso en todas las actividades económicas públicas y privadas.', 21),
(137, 'Mejorar sustancialmente las condiciones socioambientales de las ciudades.', 21),
(138, 'Impulsar la generación de energías limpias, aumentando su participación en la matriz energética nacional y promoviendo la soberanía tecnológica.', 21),
(139, 'Promover acciones en el ámbito nacional e internacional para la protección, conservación y gestión sustentable de áreas estratégicas, tales como fuentes y reservones de agua dulce (superficial y subterránea), cuencas hidrográficas, diversidad biológica mares, océanos y bosques.', 22),
(140, 'Desmontar y luchar contra los esquemas internacionales que promueven la mercantilización de la naturaleza, de los servicios ambientales y de los ecosistemas.', 22),
(141, 'Promover la cooperación, a nivel regional, para el manejo integrado de los recursos naturales transfronterizos.', 22),
(142, 'Luchar contra la securitización de los problemas ambientales mundiales, para evitar la incorporación de los temas ambientales y humanos como temas de “Seguridad internacional” por parte de las potencias hegemónicas.', 22),
(143, 'Contrarrestar la producción y valorización de elementos culturales y relatos históricos generados desde la óptica neocolonial dominante, que circulan a través de los medios de comunicación e instituciones educativas y culturales, entre otras.', 23),
(144, 'Fortalecer y visibilizar los espacios de expresión y fomentar mecanismos de registro e interpretación de las culturas populares y de la memoria histórica venezolana y nuestroamericana.', 23),
(145, 'Promover una cultura ecosocialista, que revalorice el patrimonio histórico cultural venezolano y nuestroamericano.', 23),
(146, 'Elaborar estrategias de mantenimiento y difusión de las características culturales y de la memoria histórica del pueblo venezolano.', 23),
(147, 'Continuar la lucha por la preservación, el respeto y el fortalecimiento del régimen climático conformado por la Convención Marco de Naciones Unidas para el Cambio Climático y su Protocolo de Kyoto', 24),
(148, 'Diseñar un plan de mitigación que abarque los sectores productivos emisores de gases de efecto invernadero, como una contribución voluntaria nacional a los esfuerzos para salvar el planeta.', 24),
(149, 'Diseñar un plan nacional de adaptación que permita al país prepararse para los escenarios e impactos climáticos que se producirán debido a la irresponsabilidad de los países industrializados, contaminadores del mundo.', 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `objetivos_generales`
--

CREATE TABLE `objetivos_generales` (
  `id` int(11) NOT NULL,
  `objetivo_general` text NOT NULL,
  `objetivo_estrategico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Objetivos generales - Area estrategica';

--
-- Volcado de datos para la tabla `objetivos_generales`
--

INSERT INTO `objetivos_generales` (`id`, `objetivo_general`, `objetivo_estrategico`) VALUES
(1, ' Consolidar la unidad de la clase trabajadora y de sus capas\nprofesionales, de los pequeños y medianos productores del campo y\nla ciudad; así como de los movimientos y organizaciones sociales\nque acompañan a la Revolución Bolivariana.\n', 1),
(2, ' Desplegar todas las acciones políticas necesarias para\ngarantizar los procesos electorales en un clima de estabilidad y lograr\nque se reconozca de manera pacífica la voluntad soberana de\nnuestro pueblo.', 1),
(3, ' Convocar a todos los sectores democráticos y honestos del\npaís a contribuir al desarrollo pacífico de los procesos electorales.', 1),
(4, ' Fortalecer y defender a los Poderes Públicos del Estado.', 2),
(5, ' Fortalecer la conciencia y la organización sectorial y territorial\nde nuestro pueblo para la defensa integral de la patria.', 2),
(6, ' Potenciar las capacidades de los organismos de Seguridad\nciudadana del Estado para garantizar la estabilidad política y la paz\nde la Nación.', 2),
(7, ' Formar a las organizaciones del Poder Popular en procesos\nde planificación, coordinación, control y administración de servicios\nque eleven el vivir bien.', 3),
(8, ' Fortalecer el Poder Popular en el ejercicio compartido de\nfunciones de planificación, elaboración, ejecución y seguimiento de\nlas políticas públicas.', 3),
(9, ' Transferir al Poder Popular, en corresponsabilidad,\ncompetencias, servicios y otras atribuciones del Poder Público\nnacional, regional y municipal.', 3),
(10, ' Garantizar la planificación, elaboración, ejecución y seguimiento participativo de las políticas regionales y locales, en consonancia con los objetivos del Plan de Desarrollo Económico y Social de la Nación.', 4),
(11, ' Garantizar el derecho del pueblo a estar informado veraz y oportunamente, así como al libre ejercicio de la información y\ncomunicación.', 5),
(12, ' Fortalecer el uso responsable y critico de los medios de\ncomunicación públicos, privados y comunitarios como instrumentos de formación de valores bolivarianos.', 5),
(13, ' Consolidar la regulación y contraloría social de los medios de comunicación como herramienta para el fortalecimiento del Poder Popular.\n', 5),
(14, ' Promover e impulsar un sistema nacional de comunicación popular.\n', 5),
(15, ' Fomentar la investigación y formación sobre la comunicación como proceso humano y herramienta de transformación y construcción social.\n', 5),
(16, ' Desarrollar redes de comunicación y medios de expresión de la palabra, la imagen y las voces de nuestros pueblos, con miras al fortalecimiento de los procesos de integración y unidad latinoamericana y caribeña.', 5),
(17, ' Actualizar y desarrollar de forma permanente las plataformas tecnológicas de comunicación e información, garantizando el acceso a la comunicación oportuna y ética a fin de contribuir a la satisfacción de las necesidades para el vivir bien de nuestro pueblo, entre otras.\n', 5),
(18, ' Consolidar la adecuación tecnológica del sistema público de comunicación con el marco de la implementación de la Televisión Digital Abierta y el uso de las nuevas TIC.', 5),
(19, ' Conformar un sistema de medios que contribuya a la\norganización sectorial para la defensa integral de la Patria, con\nénfasis en la consolidación de nuevos medios y formas de producir contenidos en la frontera con relevancia de los valores patrióticos y socialistas.', 5),
(20, ' Garantizar la hegemonía del Estado sobre la producción\nnacional de petróleo.\n', 6),
(21, ' Asegurar una participación mayoritaria de PDVSA en las\nempresas mixtas.', 7),
(22, ' Consolidar y fortalecer una empresa estatal para la\nexplotación de los recursos mineros.', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `objetivos_historicos`
--

CREATE TABLE `objetivos_historicos` (
  `id` int(11) NOT NULL,
  `objetivo_historico` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Objetivos historicos - Area estrategica';

--
-- Volcado de datos para la tabla `objetivos_historicos`
--

INSERT INTO `objetivos_historicos` (`id`, `objetivo_historico`) VALUES
(1, 'Defender expandir y consolidar el bien más preciado que hemos reconquistado después de 200 años: la independencia Nacional'),
(2, 'Continuar construyendo el socialismo bolivariano del siglo XXI, en Venezuela, como alternativa al sistema destructivo y salvaje del capitalismo y con ello asegurar “la mayor suma de felicidad posible, la mayor suma de seguridad social y la mayor suma de estabilidad política” para nuestro pueblo'),
(3, 'Convertir a Venezuela en un país potencia en lo social, lo económico y lo político dentro de la Gran Potencia Naciente de América Latina y el Caribe, que garanticen la conformación de una zona de paz en Nuestra América'),
(4, 'Contribuir al desarrollo de una nueva geopolítica internacional en la cual tome cuerpo el mundo multicéntrico y pluripolar que permita lograr el equilibrio del universo y garantizar la paz planetaria en el planeta'),
(5, 'Contribuir con la preservación de la vida en el planeta y la salvación de la especie humana');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `objetivos_nacionales`
--

CREATE TABLE `objetivos_nacionales` (
  `id` int(11) NOT NULL,
  `objetivo_nacional` text NOT NULL,
  `objetivo_historico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Objetivos nacionales - Area estrategica';

--
-- Volcado de datos para la tabla `objetivos_nacionales`
--

INSERT INTO `objetivos_nacionales` (`id`, `objetivo_nacional`, `objetivo_historico`) VALUES
(1, 'Garantizar la continuidad y consolidación de la Revolución Bolivariana.', 1),
(2, 'Preservar y consolidar la soberanía sobre los recursos petroleros y demás recursos naturales estratégicos.', 1),
(3, 'Garantizar el manejo soberano del ingreso nacional.', 1),
(4, 'Lograr la soberanía alimentaria para garantizar el sagrado derecho a la alimentación de nuestro pueblo.', 1),
(5, 'Desarrollar nuestras capacidades científico-tecnológicas vinculadas a las necesidades del pueblo.', 1),
(6, 'Fortalecer el poder defensivo nacional para proteger la Independencia y la soberanía nacional, asegurando los recursos y riquezas de nuestro país para las futuras generaciones.', 1),
(7, 'Adecuar el aparato económico productivo, la infraestructura y los servicios del Estado incrementando la capacidad de respuesta a las necesidades del pueblo ante posibles estados de excepción en el marco de la Defensa Integral de la Nación.', 1),
(8, 'Propulsar la transformación del sistema económico, en función de la transición al socialismo bolivariano, trascendiendo el modelo rentista petrolero capitalista hacia el modelo económico productivo socialista, basado en el desarrollo de las fuerzas productivas.', 2),
(9, 'Construir una sociedad igualitaria y justa.', 2),
(10, 'Consolidar y expandir el poder popular y la democracia socialista. Alcanzar la soberanía plena, como garantía de irreversibilidad del proyecto bolivariano, es el propósito central del ejercido del poder por parte del pueblo consciente y organizado. La gestación y desarrollo de nuevas instancias de participación popular dan cuenta de como la Revolución Bolivariana avanza consolidando la hegemonía y el control de la orientación política, social, económica y cultural de la nación. El poder que habla sido secuestrado por la oligarquía va siendo restituido al pueblo, quien, de batalla en batalla y de victoria en victoria, ha aumentado su nivel de complejidad organizativa.', 2),
(11, 'Convocar y promover una nueva orientación ética, moral y espiritual de la sociedad, basada en los valores liberadores del socialismo.', 2),
(12, 'Lograr la irrupción definitiva del Nuevo Estado Democrático y Social, de Derecho y de Justicia.', 2),
(13, 'Consolidar el papel de Venezuela como Potencia Energética Mundial.', 3),
(14, 'Desarrollar el poderío económico en base al aprovechamiento óptimo de las potencialidades que ofrecen nuestros recursos para la generación de la máxima felicidad de nuestro pueblo, así como de las bases materiales para la construcción de nuestro socialismo bolivariano.', 3),
(15, 'Ampliar y conformar el poderío militar para la defensa de la Patria. Nuestra Patria promueve la cooperación pacifica entre las naciones, impulsa la integración latinoamericana y caribeña, el principio de autodeterminación de los pueblos y la no intervención en los asuntos internos de cada país, es por ello que el poderlo militar del país es netamente defensivo y disuasivo, que no amenaza a nadie ni tiene pretensiones invasoras, todo lo contrario somos promotores de la paz y de la integración latinoamericana y caribeña para contribuir con la defensa de nuestros pueblos, ello nos obliga a garantizar cada día el fortalecimiento de nuestras propias doctrinas y tecnologías militares que nos permitan ser una referencia pacifica en la región, adecuando nuestra industria militar a nuestras propias necesidades, derivadas de la realidad geoestratógica de nuestra Patria, valiéndonos de la cooperación con países amigos.', 3),
(16, 'Profundizar el desarrollo de la nueva geopolítica nacional.', 3),
(17, 'Continuar desempeñando un papel protagónico en la construcción de la unión latinoamericana y caribeña.', 4),
(18, 'Afianzar la identidad nacional y nuestro americana.', 4),
(19, 'Continuar impulsando el desarrollo de un mundo multicéntrico y pluripolar sin dominación imperial y con respeto a la autodeterminación de los pueblos', 4),
(20, 'Desmontar el sistema neocolonial de dominación imperial.', 4),
(21, 'Construir e impulsar el modelo económico productivo eco-socialista, basado en una relación armónica entre el hombre y la naturaleza, que garantice el uso y aprovechamiento racional, óptimo y sostenible de los recursos naturales, respetando los procesos y ciclos de la naturaleza.', 5),
(22, 'Proteger y defender la soberanía permanente del Estado sobre los recursos naturales para el beneficio supremo de nuestro Pueblo, que será su principal garante.', 5),
(23, 'Defender y proteger el patrimonio histórico y cultural venezolano y nuestroamericano.', 5),
(24, 'Contribuir a la conformación de un gran movimiento mundial para contener las causas y reparar los efectos de cambio climático que ocurren como consecuencia del modelo capitalista depredador.', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE `pais` (
  `id` smallint(3) UNSIGNED ZEROFILL NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`id`, `nombre`) VALUES
(004, 'Afganistán'),
(008, 'Albania'),
(010, 'Antártida'),
(012, 'Argelia'),
(016, 'Samoa Americana'),
(020, 'Andorra'),
(024, 'Angola'),
(028, 'Antigua y Barbuda'),
(031, 'Azerbaiyán'),
(032, 'Argentina'),
(036, 'Australia'),
(040, 'Austria'),
(044, 'Bahamas'),
(048, 'Bahréin'),
(050, 'Bangladesh'),
(051, 'Armenia'),
(052, 'Barbados'),
(056, 'Bélgica'),
(060, 'Bermudas'),
(064, 'Bhután'),
(068, 'Bolivia'),
(070, 'Bosnia y Herzegovina'),
(072, 'Botsuana'),
(074, 'Isla Bouvet'),
(076, 'Brasil'),
(084, 'Belice'),
(086, 'Territorio Británico del Océano Índico'),
(090, 'Islas Salomón'),
(092, 'Islas Vírgenes Británicas'),
(096, 'Brunéi'),
(100, 'Bulgaria'),
(104, 'Myanmar'),
(108, 'Burundi'),
(112, 'Bielorrusia'),
(116, 'Camboya'),
(120, 'Camerún'),
(124, 'Canadá'),
(132, 'Cabo Verde'),
(136, 'Islas Caimán'),
(140, 'República Centroafricana'),
(144, 'Sri Lanka'),
(148, 'Chad'),
(152, 'Chile'),
(156, 'China'),
(158, 'Taiwán'),
(162, 'Isla de Navidad'),
(166, 'Islas Cocos'),
(170, 'Colombia'),
(174, 'Comoras'),
(175, 'Mayotte'),
(178, 'Congo'),
(180, 'República Democrática del Congo'),
(184, 'Islas Cook'),
(188, 'Costa Rica'),
(191, 'Croacia'),
(192, 'Cuba'),
(196, 'Chipre'),
(203, 'República Checa'),
(204, 'Benín'),
(208, 'Dinamarca'),
(212, 'Dominica'),
(214, 'República Dominicana'),
(218, 'Ecuador'),
(222, 'El Salvador'),
(226, 'Guinea Ecuatorial'),
(231, 'Etiopía'),
(232, 'Eritrea'),
(233, 'Estonia'),
(234, 'Islas Feroe'),
(238, 'Islas Malvinas'),
(239, 'Islas Georgias del Sur y Sandwich del Sur'),
(242, 'Fiyi'),
(246, 'Finlandia'),
(248, 'Islas Gland'),
(250, 'Francia'),
(254, 'Guayana Francesa'),
(258, 'Polinesia Francesa'),
(260, 'Territorios Australes Franceses'),
(262, 'Yibuti'),
(266, 'Gabón'),
(268, 'Georgia'),
(270, 'Gambia'),
(275, 'Palestina'),
(276, 'Alemania'),
(288, 'Ghana'),
(292, 'Gibraltar'),
(296, 'Kiribati'),
(300, 'Grecia'),
(304, 'Groenlandia'),
(308, 'Granada'),
(312, 'Guadalupe'),
(316, 'Guam'),
(320, 'Guatemala'),
(324, 'Guinea'),
(328, 'Guyana'),
(332, 'Haití'),
(334, 'Islas Heard y McDonald'),
(336, 'Ciudad del Vaticano'),
(340, 'Honduras'),
(344, 'Hong Kong'),
(348, 'Hungría'),
(352, 'Islandia'),
(356, 'India'),
(360, 'Indonesia'),
(364, 'Irán'),
(368, 'Iraq'),
(372, 'Irlanda'),
(376, 'Israel'),
(380, 'Italia'),
(384, 'Costa de Marfil'),
(388, 'Jamaica'),
(392, 'Japón'),
(398, 'Kazajstán'),
(400, 'Jordania'),
(404, 'Kenia'),
(408, 'Corea del Norte'),
(410, 'Corea del Sur'),
(414, 'Kuwait'),
(417, 'Kirguistán'),
(418, 'Laos'),
(422, 'Líbano'),
(426, 'Lesotho'),
(428, 'Letonia'),
(430, 'Liberia'),
(434, 'Libia'),
(438, 'Liechtenstein'),
(440, 'Lituania'),
(442, 'Luxemburgo'),
(446, 'Macao'),
(450, 'Madagascar'),
(454, 'Malaui'),
(458, 'Malasia'),
(462, 'Maldivas'),
(466, 'Malí'),
(470, 'Malta'),
(474, 'Martinica'),
(478, 'Mauritania'),
(480, 'Mauricio'),
(484, 'México'),
(492, 'Mónaco'),
(496, 'Mongolia'),
(498, 'Moldavia'),
(499, 'Montenegro'),
(500, 'Montserrat'),
(504, 'Marruecos'),
(508, 'Mozambique'),
(512, 'Omán'),
(516, 'Namibia'),
(520, 'Nauru'),
(524, 'Nepal'),
(528, 'Países Bajos'),
(530, 'Antillas Holandesas'),
(533, 'Aruba'),
(540, 'Nueva Caledonia'),
(548, 'Vanuatu'),
(554, 'Nueva Zelanda'),
(558, 'Nicaragua'),
(562, 'Níger'),
(566, 'Nigeria'),
(570, 'Niue'),
(574, 'Isla Norfolk'),
(578, 'Noruega'),
(580, 'Islas Marianas del Norte'),
(581, 'Islas Ultramarinas de Estados Unidos'),
(583, 'Micronesia'),
(584, 'Islas Marshall'),
(585, 'Palaos'),
(586, 'Pakistán'),
(591, 'Panamá'),
(598, 'Papúa Nueva Guinea'),
(600, 'Paraguay'),
(604, 'Perú'),
(608, 'Filipinas'),
(612, 'Islas Pitcairn'),
(616, 'Polonia'),
(620, 'Portugal'),
(624, 'Guinea-Bissau'),
(626, 'Timor Oriental'),
(630, 'Puerto Rico'),
(634, 'Qatar'),
(638, 'Reunión'),
(642, 'Rumania'),
(643, 'Rusia'),
(646, 'Ruanda'),
(654, 'Santa Helena'),
(659, 'San Cristóbal y Nieves'),
(660, 'Anguila'),
(662, 'Santa Lucía'),
(666, 'San Pedro y Miquelón'),
(670, 'San Vicente y las Granadinas'),
(674, 'San Marino'),
(678, 'Santo Tomé y Príncipe'),
(682, 'Arabia Saudí'),
(686, 'Senegal'),
(688, 'Serbia'),
(690, 'Seychelles'),
(694, 'Sierra Leona'),
(702, 'Singapur'),
(703, 'Eslovaquia'),
(704, 'Vietnam'),
(705, 'Eslovenia'),
(706, 'Somalia'),
(710, 'Sudáfrica'),
(716, 'Zimbabue'),
(724, 'España'),
(732, 'Sahara Occidental'),
(736, 'Sudán'),
(740, 'Surinam'),
(744, 'Svalbard y Jan Mayen'),
(748, 'Suazilandia'),
(752, 'Suecia'),
(756, 'Suiza'),
(760, 'Siria'),
(762, 'Tayikistán'),
(764, 'Tailandia'),
(768, 'Togo'),
(772, 'Tokelau'),
(776, 'Tonga'),
(780, 'Trinidad y Tobago'),
(784, 'Emiratos Árabes Unidos'),
(788, 'Túnez'),
(792, 'Turquía'),
(795, 'Turkmenistán'),
(796, 'Islas Turcas y Caicos'),
(798, 'Tuvalu'),
(800, 'Uganda'),
(804, 'Ucrania'),
(807, 'Macedonia'),
(818, 'Egipto'),
(826, 'Reino Unido'),
(834, 'Tanzania'),
(840, 'Estados Unidos'),
(850, 'Islas Vírgenes de los Estados Unidos'),
(854, 'Burkina Faso'),
(858, 'Uruguay'),
(860, 'Uzbekistán'),
(862, 'Venezuela'),
(876, 'Wallis y Futuna'),
(882, 'Samoa'),
(887, 'Yemen'),
(894, 'Zambia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parroquia`
--

CREATE TABLE `parroquia` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) CHARACTER SET latin1 NOT NULL,
  `id_municipio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partida_especifica`
--

CREATE TABLE `partida_especifica` (
  `cuenta` char(1) NOT NULL,
  `partida` char(2) NOT NULL,
  `generica` char(2) NOT NULL,
  `especifica` char(2) NOT NULL,
  `nombre` text NOT NULL,
  `estatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `partida_especifica`
--

INSERT INTO `partida_especifica` (`cuenta`, `partida`, `generica`, `especifica`, `nombre`, `estatus`) VALUES
('3', '01', '01', '01', 'Impuesto sobre la renta a personas jurídicas', 1),
('3', '01', '01', '02', 'Impuesto sobre la renta a personas naturales', 1),
('3', '01', '01', '03', 'Impuestos sobre sucesiones, donaciones y demás ramos conexos', 1),
('3', '01', '01', '04', 'Reparos administrativos por impuesto sobre la renta a personas juridica', 1),
('3', '01', '01', '05', 'Reparos administrativos por impuesto sobre la renta a personas naturales', 1),
('3', '01', '01', '06', 'Reparos administrativos a impuesto sobre sucesiones, donaciones y demás ramos conexos', 1),
('3', '01', '02', '01', 'Impuestos de importación', 1),
('3', '01', '02', '02', 'Impuesto de exportación', 1),
('3', '01', '02', '03', 'Impuesto sobre la producción, el consumo y transacciones financieras', 1),
('3', '01', '02', '04', 'Impuestos a las actividades de juegos de envite o azar', 1),
('3', '01', '02', '05', 'Inmuebles urbanos', 1),
('3', '01', '02', '06', 'Participación en el impuesto a la propiedad rural', 1),
('3', '01', '02', '07', 'Patente de industria y comercio', 1),
('3', '01', '02', '08', 'Patente de vehículo', 1),
('3', '01', '02', '09', 'Propaganda comercial', 1),
('3', '01', '02', '10', 'Espectáculos públicos', 1),
('3', '01', '02', '11', 'Apuestas lícitas', 1),
('3', '01', '02', '12', 'Deudas morosas', 1),
('3', '01', '02', '99', 'Otros impuestos indirectos', 1),
('3', '01', '03', '01', 'Derechos de tránsito terrestre', 1),
('3', '01', '03', '02', 'Derechos a examen', 1),
('3', '01', '03', '03', 'Derechos de expedición, renovación y reválida de licencias', 1),
('3', '01', '03', '04', 'Derechos de registro y traspaso', 1),
('3', '01', '03', '05', 'Derechos de placas identificadoras', 1),
('3', '01', '03', '06', 'Derechos por revisión anual', 1),
('3', '01', '03', '07', 'Derechos por remoción o arrastre de vehículos', 1),
('3', '01', '03', '08', 'Derechos por estacionamiento de vehículos', 1),
('3', '01', '03', '09', 'Permiso para uso de rutas extraurbanas', 1),
('3', '01', '03', '10', 'Copias de documentos', 1),
('3', '01', '03', '11', 'Tasas para el uso de aeronaves y por licencias de personal aeronáutico', 1),
('3', '01', '03', '12', 'Tasas aeroportuarias', 1),
('3', '01', '03', '13', 'Tasas por uso de canales de navegación', 1),
('3', '01', '03', '14', 'Patente de navegación', 1),
('3', '01', '03', '15', 'Expedición de licencias de navegación', 1),
('3', '01', '03', '16', 'Servicio de telecomunicaciones', 1),
('3', '01', '03', '17', 'Permisos para estaciones privadas de radiocomunicaciones', 1),
('3', '01', '03', '18', 'Derechos de pilotajes', 1),
('3', '01', '03', '19', 'Habilitación de pilotaje', 1),
('3', '01', '03', '20', 'Servicios de remolcadores', 1),
('3', '01', '03', '21', 'Habilitación de remolcadores', 1),
('3', '01', '03', '22', 'Habilitación de capitanías de puerto', 1),
('3', '01', '03', '23', 'Otros servicios de capitanías de puerto', 1),
('3', '01', '03', '24', 'Tasas de faros y boyas', 1),
('3', '01', '03', '25', 'Servicios de aduana', 1),
('3', '01', '03', '26', 'Habilitación de aduanas', 1),
('3', '01', '03', '27', 'Derechos de almacenaje', 1),
('3', '01', '03', '28', 'Corretaje de bultos postales', 1),
('3', '01', '03', '29', 'Servicios de consulta sobre clasificación arancelaria, valoración aduanera y análisis de laboratorio', 1),
('3', '01', '03', '30', 'Bandas de garantía, cápsulas y sellos', 1),
('3', '01', '03', '31', 'Servicio de peaje', 1),
('3', '01', '03', '32', 'Servicio de riego y drenaje', 1),
('3', '01', '03', '33', 'Estampillas fiscales', 1),
('3', '01', '03', '34', 'Papel sellado', 1),
('3', '01', '03', '35', 'Derechos de traslado', 1),
('3', '01', '03', '36', 'Servicios sanitarios marítimos', 1),
('3', '01', '03', '37', 'Servicios hospitalarios', 1),
('3', '01', '03', '38', 'Venta de copias de planos', 1),
('3', '01', '03', '39', 'Derechos de contraste, verificación y estudios', 1),
('3', '01', '03', '40', 'Patente de pesca de perlas', 1),
('3', '01', '03', '41', 'Licencia de caza', 1),
('3', '01', '03', '42', 'Derechos de cancillería', 1),
('3', '01', '03', '43', 'Depósitos por el ingreso al país de extranjeros', 1),
('3', '01', '03', '44', 'Registro sanitario', 1),
('3', '01', '03', '45', 'Derechos de análisis de sustancias químicas', 1),
('3', '01', '03', '46', 'Derechos consulares', 1),
('3', '01', '03', '47', 'Matrícula para importar y exportar sustancias estupefacientes y psicotrópicas', 1),
('3', '01', '03', '48', 'Permisos municipales', 1),
('3', '01', '03', '49', 'Certificaciones y solvencias', 1),
('3', '01', '03', '50', 'Servicio de energía eléctrica', 1),
('3', '01', '03', '51', 'Servicio de distribución de agua', 1),
('3', '01', '03', '52', 'Servicio de gas doméstico', 1),
('3', '01', '03', '53', 'Mensura y deslinde', 1),
('3', '01', '03', '54', 'Aseo domiciliario', 1),
('3', '01', '03', '55', 'Matadero', 1),
('3', '01', '03', '56', 'Mercado', 1),
('3', '01', '03', '57', 'Cementerio', 1),
('3', '01', '03', '58', 'Terminal de pasajeros', 1),
('3', '01', '03', '59', 'Deudas morosas por tasas', 1),
('3', '01', '03', '99', 'Otros tipos de tasas', 1),
('3', '01', '04', '01', 'Sobre la plusvalía inmobiliaria', 1),
('3', '01', '04', '02', 'Contribuciones por mejoras', 1),
('3', '01', '04', '99', 'Otras contribuciones especiales', 1),
('3', '01', '05', '01', 'Ingresos por aportes patronales a la seguridad social', 1),
('3', '01', '05', '02', 'Contribuciones personales a la seguridad social', 1),
('3', '01', '06', '01', 'Regalías', 1),
('3', '01', '06', '02', 'Impuesto superficial de hidrocarburos', 1),
('3', '01', '06', '03', 'Impuesto de extracción', 1),
('3', '01', '06', '04', 'Impuesto de registro de exportación', 1),
('3', '01', '06', '05', 'Participación por azufre', 1),
('3', '01', '06', '06', 'Participación por coque', 1),
('3', '01', '06', '07', 'Ventajas especiales petroleras', 1),
('3', '01', '06', '99', 'Otros ingresos del dominio petrolero', 1),
('3', '01', '07', '01', 'Superficial minero', 1),
('3', '01', '07', '02', 'Impuesto de explotación', 1),
('3', '01', '07', '03', 'Ventajas especiales mineras', 1),
('3', '01', '07', '04', 'Regalía minera de oro', 1),
('3', '01', '08', '01', 'Impuesto superficial', 1),
('3', '01', '08', '02', 'Impuesto de explotación o aprovechamiento', 1),
('3', '01', '08', '03', 'Permiso o autorización para la explotación o aprovechamiento de los productos forestales', 1),
('3', '01', '08', '04', 'Autorización para deforestación', 1),
('3', '01', '08', '05', 'Autorización para movilizar productos forestales', 1),
('3', '01', '08', '06', 'Participación por la explotación en zonas de reserva forestal', 1),
('3', '01', '08', '07', 'Ventajas especiales por recursos forestales', 1),
('3', '01', '09', '01', 'Ingresos por la venta de bienes', 1),
('3', '01', '09', '02', 'Ingresos por la venta de servicios', 1),
('3', '01', '09', '99', 'Ingresos por la venta de otros bienes y servicios', 1),
('3', '01', '10', '01', 'Intereses por préstamos concedidos al sector privado', 1),
('3', '01', '10', '03', 'Intereses por préstamos concedidos al sector externo', 1),
('3', '01', '10', '04', 'Intereses por depósitos en instituciones financieras', 1),
('3', '01', '10', '05', 'Intereses de títulos y valores', 1),
('3', '01', '10', '06', 'Utilidades de acciones y participaciones de capital', 1),
('3', '01', '10', '07', 'Utilidades de explotación de juegos de azar', 1),
('3', '01', '10', '08', 'Alquileres', 1),
('3', '01', '10', '09', 'Derechos sobre bienes intangibles', 1),
('3', '01', '10', '10', 'Concesiones de bienes y servicios', 1),
('3', '01', '11', '01', 'Intereses moratorios', 1),
('3', '01', '11', '02', 'Reparos fiscales', 1),
('3', '01', '11', '03', 'Sanciones fiscales', 1),
('3', '01', '11', '04', 'Juicios y costas procesales', 1),
('3', '01', '11', '05', 'Beneficios en operaciones cambiarias', 1),
('3', '01', '11', '06', 'Utilidad por venta de activos', 1),
('3', '01', '11', '07', 'Intereses por financiamiento de deudas tributarias', 1),
('3', '01', '11', '08', 'Multas y recargos', 1),
('3', '01', '11', '09', 'Reparos administrativos al impuesto a los activos empresariales', 1),
('3', '01', '11', '10', 'Diversos reparos administrativos', 1),
('3', '01', '11', '11', 'Ingresos en tránsito', 1),
('3', '01', '11', '12', 'Reparos administrativos por impuestos municipales', 1),
('3', '01', '99', '01', 'Otros ingresos ordinarios', 1),
('3', '02', '01', '01', 'Colocación de títulos y valores de deuda pública interna a corto plazo', 1),
('3', '02', '01', '02', 'Obtención de préstamos internos a corto plazo', 1),
('3', '02', '01', '03', 'Colocación de títulos y valores de la deuda pública interna a largo plazo', 1),
('3', '02', '01', '04', 'Obtención de préstamos internos a largo plazo', 1),
('3', '02', '02', '01', 'Colocación de títulos y valores de la deuda pública externa a corto plazo', 1),
('3', '02', '02', '02', 'Obtención de préstamos externos a corto plazo', 1),
('3', '02', '02', '03', 'Colocación de títulos y valores de la deuda pública externa a largo plazo', 1),
('3', '02', '02', '04', 'Obtención de préstamos externos a largo plazo', 1),
('3', '02', '03', '01', 'Liquidación de entes descentralizados', 1),
('3', '02', '03', '02', 'Herencias vacantes y donaciones', 1),
('3', '02', '03', '03', 'Prima en colocación de títulos y valores de la deuda pública', 1),
('3', '02', '03', '05', 'Ingresos por procesos licitatorios', 1),
('3', '02', '04', '01', 'Reintegro proveniente de bonos de exportación', 1),
('3', '02', '04', '02', 'Reintegro de fondos efectuado por organismos públicos proveniente de bonos de exportación', 1),
('3', '02', '05', '01', 'Ingresos por obtención indebida de devoluciones o reintegros', 1),
('3', '02', '06', '01', 'Impuesto a las transacciones financieras', 1),
('3', '02', '06', '02', 'Reparos administrativos al impuesto a las transacciones financieras', 1),
('3', '02', '06', '03', 'Multas y recargos por el impuesto a las transacciones financieras', 1),
('3', '02', '99', '01', 'Otros ingresos extraordinarios', 1),
('3', '03', '01', '01', 'Venta de productos del sector industrial', 1),
('3', '03', '01', '02', 'Venta de productos del sector comercial', 1),
('3', '03', '02', '01', 'Venta bruta de servicios', 1),
('3', '03', '03', '01', 'Ingresos por inversiones en valores', 1),
('3', '03', '03', '02', 'Ingresos por cartera de créditos', 1),
('3', '03', '03', '03', 'Ingresos provenientes de la administración de fideicomisos', 1),
('3', '03', '03', '99', 'Otros ingresos financieros', 1),
('3', '03', '04', '01', 'Ingresos por inversiones en valores', 1),
('3', '03', '04', '02', 'Ingresos por cartera de créditos', 1),
('3', '03', '04', '03', 'Ingresos provenientes de la administración de fideicomisos', 1),
('3', '03', '04', '99', 'Otros ingresos financieros', 1),
('3', '03', '05', '01', 'Ingresos por operaciones de primas de seguro', 1),
('3', '03', '05', '02', 'Ingresos por operaciones de reaseguro', 1),
('3', '03', '05', '03', 'Ingresos por salvamento de siniestros', 1),
('3', '03', '05', '99', 'Otros ingresos por operaciones de seguro', 1),
('3', '03', '99', '01', 'Otros ingresos de operación', 1),
('3', '04', '01', '01', 'Subsidios para precios y tarifas', 1),
('3', '04', '02', '01', 'Incentivos a la exportación', 1),
('3', '04', '99', '01', 'Otros ingresos ajenos a la operación', 1),
('3', '05', '01', '01', 'Transferencias corrientes internas del sector privado', 1),
('3', '05', '01', '02', 'Donaciones corrientes internas del sector privado', 1),
('3', '05', '01', '03', 'Transferencias corrientes internas del sector público', 1),
('3', '05', '01', '04', 'Donaciones corrientes internas del sector público', 1),
('3', '05', '01', '05', 'Transferencias corrientes del exterior', 1),
('3', '05', '01', '06', 'Donaciones corrientes del exterior', 1),
('3', '05', '02', '01', 'Transferencias de capital internas del sector privado', 1),
('3', '05', '02', '02', 'Donaciones de capital internas del sector privado', 1),
('3', '05', '02', '03', 'Transferencias de capital internas del sector público', 1),
('3', '05', '02', '04', 'Donaciones de capital internas del sector público', 1),
('3', '05', '02', '05', 'Transferencias de capital del exterior', 1),
('3', '05', '02', '06', 'Donaciones de capital del exterior', 1),
('3', '05', '03', '01', 'Situado Constitucional', 1),
('3', '05', '03', '02', 'Situado Estadal a Municipal', 1),
('3', '05', '04', '01', 'Subsidio de Régimen Especial', 1),
('3', '05', '05', '01', 'Subsidio de Capitalidad', 1),
('3', '05', '06', '01', 'Asignaciones Económicas Especiales (LAEE) Estadal', 1),
('3', '05', '06', '02', 'Asignaciones Económicas Especiales (LAEE) Estadal a Municipal', 1),
('3', '05', '06', '03', 'Asignaciones Económicas Especiales (LAEE) Municipal', 1),
('3', '05', '06', '04', 'Asignaciones Económicas Especiales (LAEE) Fondo Nacional de los Consejos Comunales', 1),
('3', '05', '06', '05', 'Asignaciones Económicas Especiales (LAEE) Apoyo al Fortalecimiento Institucional', 1),
('3', '05', '07', '01', 'Fondo Intergubernamental para la Descentralización (FIDES)', 1),
('3', '05', '08', '01', 'Fondo de Compensación Interterritorial Estadal', 1),
('3', '05', '08', '02', 'Fondo de Compensación Interterritorial Municipal', 1),
('3', '05', '08', '03', 'Fondo de Compensación Interterritorial Poder Popular', 1),
('3', '05', '08', '04', 'Fondo de Compensación Interterritorial Fortalecimiento Institucional', 1),
('3', '05', '09', '01', 'Aportes del Sector Público al Poder Estadal por transferencia de servicios', 1),
('3', '05', '09', '02', 'Aportes del Sector Público al Poder Municipal por transferencia de servicios', 1),
('3', '05', '10', '01', 'Transferencias y donaciones corrientes de Organismos del Sector Público a los Consejos Comunales', 1),
('3', '05', '10', '02', 'Transferencias y donaciones de capital de Organismos del Sector Público a los Consejos Comunales', 1),
('3', '06', '01', '01', 'Venta y/o desincorporación de tierras y terrenos', 1),
('3', '06', '01', '02', 'Venta y/o desincorporación de edificios e instalaciones', 1),
('3', '06', '01', '03', 'Venta y/o desincorporación de maquinarias, equipos y semovientes', 1),
('3', '06', '02', '01', 'Venta de marcas de fábrica y patentes de invención', 1),
('3', '06', '02', '02', 'Venta de derechos de autor', 1),
('3', '06', '02', '03', 'Recuperación de gastos de organización', 1),
('3', '06', '02', '04', 'Venta de paquetes y programas de computación', 1),
('3', '06', '02', '05', 'Venta de estudios y proyectos', 1),
('3', '06', '02', '99', 'Venta de otros activos intangibles', 1),
('3', '06', '03', '01', 'Incremento de la depreciación acumulada', 1),
('3', '06', '03', '02', 'Incremento de la amortización acumulada', 1),
('3', '07', '01', '01', 'Venta de títulos y valores privados de corto plazo', 1),
('3', '07', '01', '02', 'Venta de títulos y valores públicos de corto plazo', 1),
('3', '07', '01', '03', 'Venta de títulos y valores externos de corto plazo', 1),
('3', '07', '02', '01', 'Venta de títulos y valores privados de largo plazo', 1),
('3', '07', '02', '02', 'Venta de títulos y valores públicos de largo plazo', 1),
('3', '07', '02', '03', 'Venta de títulos y valores externos de largo plazo', 1),
('3', '08', '01', '01', 'Venta de acciones y participaciones de capital del sector privado', 1),
('3', '08', '02', '01', 'Venta de acciones y participaciones de capital de entes descentralizados sin fines empresariales', 1),
('3', '08', '02', '02', 'Venta de acciones y participaciones de capital de instituciones de protección social', 1),
('3', '08', '02', '03', 'Venta de acciones y participaciones de capital de entes descentralizados con fines empresariales petroleros', 1),
('3', '08', '02', '04', 'Venta de acciones y participaciones de capital de entes descentralizados con fines empresariales no petroleros', 1),
('3', '08', '02', '05', 'Venta de acciones y participaciones de capital de entes descentralizados financieros bancarios', 1),
('3', '08', '02', '06', 'Venta de acciones y participaciones de capital de entes descentralizados financieros no bancarios', 1),
('3', '08', '03', '01', 'Venta de acciones y participaciones de capital de organismos internacionales', 1),
('3', '08', '03', '99', 'Venta de acciones y participaciones de capital de otros entes del sector externo', 1),
('3', '09', '01', '01', 'Recuperación de préstamos otorgados al sector privado de corto plazo', 1),
('3', '09', '02', '01', 'Recuperación de préstamos otorgados a la República de corto plazo', 1),
('3', '09', '02', '02', 'Recuperación de préstamos otorgados a entes descentralizados sin fines empresariales de corto plazo', 1),
('3', '09', '02', '03', 'Recuperación de préstamos otorgados a instituciones de protección social de corto plazo', 1),
('3', '09', '02', '04', 'Recuperación de préstamos otorgados a entes descentralizados con fines empresariales petroleros de corto plazo', 1),
('3', '09', '02', '05', 'Recuperación de préstamos otorgados a entes descentralizados con fines empresariales no petroleros de corto plazo', 1),
('3', '09', '02', '06', 'Recuperación de préstamos otorgados a entes descentralizados financieros bancarios de corto plazo', 1),
('3', '09', '02', '07', 'Recuperación de préstamos otorgados a entes descentralizados financieros no bancarios de corto plazo', 1),
('3', '09', '02', '08', 'Recuperación de préstamos otorgados al Poder Estadal de corto plazo', 1),
('3', '09', '02', '09', 'Recuperación de préstamos otorgados al Poder Municipal de corto plazo', 1),
('3', '09', '03', '01', 'Recuperación de préstamos otorgados a instituciones sin fines de lucro de corto plazo', 1),
('3', '09', '03', '02', 'Recuperación de préstamos otorgados a gobiernos extranjeros de corto plazo', 1),
('3', '09', '03', '03', 'Recuperación de préstamos otorgados a los organismos internacionales de corto plazo', 1),
('3', '10', '01', '01', 'Recuperación de préstamos otorgados al sector privado de largo plazo', 1),
('3', '10', '02', '01', 'Recuperación de préstamos otorgados a la República de largo plazo', 1),
('3', '10', '02', '02', 'Recuperación de préstamos otorgados a entes descentralizados sin fines empresariales de largo plazo', 1),
('3', '10', '02', '03', 'Recuperación de préstamos otorgados a instituciones de protección social de largo plazo', 1),
('3', '10', '02', '04', 'Recuperación de préstamos otorgados a entes descentralizados con fines empresariales petroleros de largo plazo', 1),
('3', '10', '02', '05', 'Recuperación de préstamos otorgados a entes descentralizados con fines empresariales no petroleros de largo plazo', 1),
('3', '10', '02', '06', 'Recuperación de préstamos otorgados a entes descentralizados financieros bancarios de largo plazo', 1),
('3', '10', '02', '07', 'Recuperación de préstamos otorgados a entes descentralizados financieros no bancarios de largo plazo', 1),
('3', '10', '02', '08', 'Recuperación de préstamos otorgados al Poder Estadal de largo plazo', 1),
('3', '10', '02', '09', 'Recuperación de préstamos otorgados al Poder Municipal de largo plazo', 1),
('3', '10', '03', '01', 'Recuperación de préstamos otorgados a instituciones sin fines de lucro de largo plazo', 1),
('3', '10', '03', '02', 'Recuperación de préstamos otorgados a gobiernos extranjeros de largo plazo', 1),
('3', '10', '03', '03', 'Recuperación de préstamos otorgados a organismos internacionales de largo plazo', 1),
('3', '11', '01', '01', 'Disminución de caja', 1),
('3', '11', '01', '02', 'Disminución de bancos', 1),
('3', '11', '01', '03', 'Disminución de inversiones temporales', 1),
('3', '11', '02', '01', 'Disminución de cuentas comerciales por cobrar a corto plazo', 1),
('3', '11', '02', '02', 'Disminución de rentas por recaudar a corto plazo', 1),
('3', '11', '02', '03', 'Disminución de deudas de cuentas por rendir a corto plazo', 1),
('3', '11', '02', '99', 'Disminución de otras cuentas por cobrar a corto plazo', 1),
('3', '11', '03', '01', 'Disminución de efectos comerciales por cobrar a corto plazo', 1),
('3', '11', '03', '99', 'Disminución de otros efectos por cobrar a corto plazo', 1),
('3', '11', '04', '01', 'Disminución de cuentas comerciales por cobrar a mediano y largo plazo', 1),
('3', '11', '04', '02', 'Disminución de rentas por recaudar a mediano y largo plazo', 1),
('3', '11', '04', '99', 'Disminución de otras cuentas por cobrar a mediano y largo plazo', 1),
('3', '11', '05', '01', 'Disminución de efectos comerciales por cobrar a mediano y largo plazo', 1),
('3', '11', '05', '99', 'Disminución de otros efectos por cobrar a mediano y largo plazo', 1),
('3', '11', '06', '01', 'Disminución de fondos en avance', 1),
('3', '11', '06', '02', 'Disminución de fondos en anticipo', 1),
('3', '11', '06', '03', 'Disminución de fondos en fideicomiso', 1),
('3', '11', '06', '04', 'Disminución de anticipos a proveedores', 1),
('3', '11', '06', '05', 'Disminución de anticipos a contratistas, por contratos a corto plazo', 1),
('3', '11', '06', '06', 'Disminución de anticipos a contratistas, por contratos a mediano y largo plazo', 1),
('3', '11', '07', '01', 'Disminución de gastos a corto plazo pagados por anticipado', 1),
('3', '11', '07', '02', 'Disminución de depósitos en garantía a corto plazo', 1),
('3', '11', '07', '99', 'Disminución de otros activos diferidos a corto plazo', 1),
('3', '11', '08', '01', 'Disminución de gastos a mediano y largo plazo pagados por anticipado', 1),
('3', '11', '08', '02', 'Disminución de depósitos en garantía a mediano y largo plazo', 1),
('3', '11', '08', '99', 'Disminución de otros activos diferidos a mediano y largo plazo', 1),
('3', '11', '09', '01', 'Disminución del Fondo de Estabilización Macroeconómica (FEM) de la República', 1),
('3', '11', '09', '02', 'Disminución del Fondo de Estabilización Macroeconómica (FEM) del Poder Estadal', 1),
('3', '11', '09', '03', 'Disminución del Fondo de Estabilización Macroeconómica (FEM) del Poder Municipal', 1),
('3', '11', '10', '01', 'Disminución del Fondo de Ahorro Intergeneracional', 1),
('3', '11', '12', '01', 'Disminución del Fondo de Aporte del Sector Público', 1),
('3', '11', '20', '01', 'Disminución de activos financieros en gestión judicial a mediano y largo plazo', 1),
('3', '11', '20', '02', 'Disminución de títulos y otros valores de la deuda pública en litigio a largo plazo', 1),
('3', '11', '99', '01', 'Disminución de otros activos financieros circulantes', 1),
('3', '11', '99', '02', 'Disminución de otros activos financieros no circulantes', 1),
('3', '12', '01', '01', 'Incremento de sueldos, salarios y otras remuneraciones por pagar', 1),
('3', '12', '02', '01', 'Incremento de aportes patronales y retenciones laborales por pagar al Instituto Venezolano de los Seguros Sociales (IVSS)', 1),
('3', '12', '02', '02', 'Incremento de aportes patronales y retenciones laborales por pagar al Instituto de Previsión Social del Ministerio de Educación (Ipasme)', 1),
('3', '12', '02', '03', 'Incremento de aportes patronales y retenciones laborales por pagar al Fondo de Jubilaciones', 1),
('3', '12', '02', '04', 'Incremento de aportes patronales y retenciones laborales por pagar al Fondo de Seguro de Paro Forzoso', 1),
('3', '12', '02', '05', 'Incremento de aportes patronales y retenciones laborales por pagar al Fondo de Ahorro Obligatorio para la Vivienda (FAOV)', 1),
('3', '12', '02', '06', 'Incremento de aportes patronales y retenciones laborales por pagar por seguro de vida, accidentes personales, hospitalización, cirugía y maternidad (HCM) y gastos funerarios', 1),
('3', '12', '02', '07', 'Incremento de aportes patronales y retenciones laborales por pagar a cajas de ahorro', 1),
('3', '12', '02', '08', 'Incremento de aportes patronales y retenciones laborales por pagar a los organismos de seguridad social', 1),
('3', '12', '02', '09', 'Incremento de aportes patronales y retenciones laborales por pagar al Instituto Nacional de Capacitación y Educación Socialista (Inces)', 1),
('3', '12', '02', '10', 'Incremento de aportes patronales y retenciones laborales por pagar por pensión alimenticia', 1),
('3', '12', '02', '99', 'Incremento de otros aportes patronales y otras retenciones laborales por pagar', 1),
('3', '12', '03', '01', 'Incremento de cuentas por pagar a proveedores a corto plazo', 1),
('3', '12', '03', '02', 'Incremento de efectos por pagar a proveedores a corto plazo', 1),
('3', '12', '03', '03', 'Incremento de cuentas por pagar a proveedores a mediano y largo plazo', 1),
('3', '12', '03', '04', 'Incremento de efectos por pagar a proveedores a mediano y largo plazo', 1),
('3', '12', '04', '01', 'Incremento de cuentas por pagar a contratistas a corto plazo', 1),
('3', '12', '04', '02', 'Incremento de efectos por pagar a contratistas a corto plazo', 1),
('3', '12', '04', '03', 'Incremento de cuentas por pagar a contratistas a mediano y largo plazo', 1),
('3', '12', '04', '04', 'Incremento de efectos por pagar a contratistas a mediano y largo plazo', 1),
('3', '12', '05', '01', 'Incremento de intereses internos por pagar', 1),
('3', '12', '05', '02', 'Incremento de intereses externos por pagar', 1),
('3', '12', '06', '01', 'Incremento de otras cuentas por pagar a corto plazo', 1),
('3', '12', '06', '02', 'Incremento de otras obligaciones de ejercicios anteriores por pagar', 1),
('3', '12', '06', '03', 'Incremento de otros efectos por pagar a corto plazo', 1),
('3', '12', '07', '01', 'Incremento de pasivos diferidos a corto plazo', 1),
('3', '12', '07', '02', 'Incremento de pasivos diferidos a mediano y largo plazo', 1),
('3', '12', '08', '01', 'Incremento de provisiones', 1),
('3', '12', '08', '02', 'Incremento de reservas técnicas', 1),
('3', '12', '09', '01', 'Incremento de depósitos recibidos en garantía', 1),
('3', '12', '09', '99', 'Incremento de otros fondos de terceros', 1),
('3', '12', '10', '01', 'Incremento de depósitos a la vista', 1),
('3', '12', '10', '02', 'Incremento de depósitos a plazo fijo', 1),
('3', '12', '11', '01', 'Incremento por reestructuración y/o refinanciamiento de la deuda pública interna de largo plazo en corto plazo', 1),
('3', '12', '11', '02', 'Incremento por reestructuración y/o refinanciamiento de la deuda pública interna de corto plazo en largo plazo', 1),
('3', '12', '11', '03', 'Incremento por reestructuración y/o refinanciamiento de la deuda pública externa de largo plazo en corto plazo', 1),
('3', '12', '11', '04', 'Incremento por reestructuración y/o refinanciamiento de la deuda pública externa de corto plazo en largo plazo', 1),
('3', '12', '11', '05', 'Incremento de la deuda pública por distribuir', 1),
('3', '12', '99', '01', 'Incremento de otros pasivos a corto plazo', 1),
('3', '12', '99', '02', 'Incremento de otros pasivos a mediano y largo plazo', 1),
('3', '13', '01', '01', 'Incremento del capital fiscal e institucional', 1),
('3', '13', '01', '02', 'Incremento de aportes por capitalizar', 1),
('3', '13', '01', '03', 'Incremento de dividendos a distribuir', 1),
('3', '13', '02', '01', 'Incremento de reservas', 1),
('3', '13', '03', '01', 'Ajustes por inflación', 1),
('3', '13', '04', '01', 'Incremento de resultados acumulados', 1),
('3', '13', '04', '02', 'Incremento de resultados del ejercicio', 1),
('4', '01', '01', '01', 'Sueldos básicos personal fijo a tiempo completo', 1),
('4', '01', '01', '02', 'Sueldos básicos personal fijo a tiempo parcial', 1),
('4', '01', '01', '03', 'Suplencias a empleados', 1),
('4', '01', '01', '08', 'Sueldo al personal en trámite de nombramiento', 1),
('4', '01', '01', '09', 'Remuneraciones al personal en período de disponibilidad', 1),
('4', '01', '01', '10', 'Salarios a obreros en puestos permanentes a tiempo completo', 1),
('4', '01', '01', '11', 'Salarios a obreros en puestos permanentes a tiempo parcial', 1),
('4', '01', '01', '12', 'Salarios a obreros en puestos no permanentes', 1),
('4', '01', '01', '13', 'Suplencias a obreros', 1),
('4', '01', '01', '18', 'Remuneraciones al personal contratado', 1),
('4', '01', '01', '19', 'Retribuciones por becas - salarios, bolsas de trabajo, pasantías y similares', 1),
('4', '01', '01', '20', 'Sueldo del personal militar profesional', 1),
('4', '01', '01', '21', 'Sueldo o ración del personal militar no profesional', 1),
('4', '01', '01', '22', 'Sueldo del personal militar de reserva', 1),
('4', '01', '01', '29', 'Dietas', 1),
('4', '01', '01', '30', 'Retribución al personal de reserva', 1),
('4', '01', '01', '35', 'Sueldo básico de los altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
('4', '01', '01', '36', 'Sueldo básico del personal de alto nivel y de dirección', 1),
('4', '01', '01', '37', 'Dietas de los altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
('4', '01', '01', '38', 'Dietas del personal de alto nivel y de dirección', 1),
('4', '01', '01', '99', 'Otras retribuciones', 1),
('4', '01', '02', '01', 'Compensaciones previstas en las escalas de sueldos al personal empleado fijo a tiempo completo', 1),
('4', '01', '02', '02', 'Compensaciones previstas en las escalas de sueldos al personal empleado fijo a tiempo parcial', 1),
('4', '01', '02', '03', 'Compensaciones previstas en las escalas de salarios al personal obrero fijo a tiempo completo', 1),
('4', '01', '02', '04', 'Compensaciones previstas en las escalas de salarios al personal obrero fijo a tiempo parcial', 1),
('4', '01', '02', '05', 'Compensaciones previstas en las escalas de sueldos al personal militar', 1),
('4', '01', '02', '06', 'Compensaciones previstas en las escalas de sueldos de los altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
('4', '01', '02', '07', 'Compensaciones previstas en las escalas de sueldos del personal de alto nivel y de dirección', 1),
('4', '01', '03', '01', 'Primas por mérito a empleados', 1),
('4', '01', '03', '02', 'Primas de transporte a empleados', 1),
('4', '01', '03', '03', 'Primas por hogar a empleados', 1),
('4', '01', '03', '04', 'Primas por hijos a empleados', 1),
('4', '01', '03', '05', 'Primas por alquileres a empleados', 1),
('4', '01', '03', '06', 'Primas por residencia a empleados', 1),
('4', '01', '03', '07', 'Primas por categoría de escuelas a empleados', 1),
('4', '01', '03', '08', 'Primas de profesionalización a empleados', 1),
('4', '01', '03', '09', 'Primas por antigüedad a empleados', 1),
('4', '01', '03', '10', 'Primas por jerarquía o responsabilidad en el cargo', 1),
('4', '01', '03', '11', 'Primas al personal en servicio en el exterior', 1),
('4', '01', '03', '16', 'Primas por mérito a obreros', 1),
('4', '01', '03', '17', 'Primas de transporte a obreros', 1),
('4', '01', '03', '18', 'Primas por hogar a obreros', 1),
('4', '01', '03', '19', 'Primas por hijos de obreros', 1),
('4', '01', '03', '20', 'Primas por residencia a obreros', 1),
('4', '01', '03', '21', 'Primas por antigüedad a obreros', 1),
('4', '01', '03', '22', 'Primas de profesionalización a obreros', 1),
('4', '01', '03', '26', 'Primas por hijos al personal militar', 1),
('4', '01', '03', '27', 'Primas de profesionalización al personal militar', 1),
('4', '01', '03', '28', 'Primas por antigüedad al personal militar', 1),
('4', '01', '03', '29', 'Primas por potencial de ascenso al personal militar', 1),
('4', '01', '03', '30', 'Primas por frontera y sitios inhóspitos al personal militar y de seguridad', 1),
('4', '01', '03', '31', 'Primas por riesgo al personal militar y de seguridad', 1),
('4', '01', '03', '37', 'Primas de transporte al personal contratado', 1),
('4', '01', '03', '38', 'Primas por hogar al personal contratado', 1),
('4', '01', '03', '39', 'Primas por hijos al personal contratado', 1),
('4', '01', '03', '40', 'Primas de profesionalización al personal contratado', 1),
('4', '01', '03', '41', 'Primas por antigüedad al personal contratado', 1),
('4', '01', '03', '46', 'Primas a los altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
('4', '01', '03', '47', 'Primas al personal de alto nivel y de dirección', 1),
('4', '01', '03', '94', 'Otras primas a los altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
('4', '01', '03', '95', 'Otras primas al personal de alto nivel y de dirección', 1),
('4', '01', '03', '96', 'Otras primas al personal contratado', 1),
('4', '01', '03', '97', 'Otras primas a empleados', 1),
('4', '01', '03', '98', 'Otras primas a obreros', 1),
('4', '01', '03', '99', 'Otras primas al personal militar', 1),
('4', '01', '04', '01', 'Complemento a empleados por horas extraordinarias o por sobre tiempo', 1),
('4', '01', '04', '02', 'Complemento a empleados por trabajo nocturno', 1),
('4', '01', '04', '03', 'Complemento a empleados por gastos de alimentación', 1),
('4', '01', '04', '04', 'Complemento a empleados por gastos de transporte', 1),
('4', '01', '04', '05', 'Complemento a empleados por gastos de representación', 1),
('4', '01', '04', '06', 'Complemento a empleados por comisión de servicios', 1),
('4', '01', '04', '07', 'Bonificación a empleados', 1),
('4', '01', '04', '08', 'Bono compensatorio de alimentación a empleados', 1),
('4', '01', '04', '09', 'Bono compensatorio de transporte a empleados', 1),
('4', '01', '04', '10', 'Complemento a empleados por días feriados', 1),
('4', '01', '04', '14', 'Complemento a obreros por horas extraordinarias o por sobre tiempo', 1),
('4', '01', '04', '15', 'Complemento a obreros por trabajo o jornada nocturna', 1),
('4', '01', '04', '16', 'Complemento a obreros por gastos de alimentación', 1),
('4', '01', '04', '17', 'Complemento a obreros por gastos de transporte', 1),
('4', '01', '04', '18', 'Bono compensatorio de alimentación a obreros', 1),
('4', '01', '04', '19', 'Bono compensatorio de transporte a obreros', 1),
('4', '01', '04', '20', 'Complemento a obreros por días feriados', 1),
('4', '01', '04', '24', 'Complemento al personal contratado por horas extraordinarias o por sobre tiempo', 1),
('4', '01', '04', '25', 'Complemento al personal contratado por gastos de alimentación', 1),
('4', '01', '04', '26', 'Bono compensatorio de alimentación al personal contratado', 1),
('4', '01', '04', '27', 'Bono compensatorio de transporte al personal contratado', 1),
('4', '01', '04', '28', 'Complemento al personal contratado por días feriados', 1),
('4', '01', '04', '32', 'Complemento al personal militar por gastos de alimentación', 1),
('4', '01', '04', '33', 'Complemento al personal militar por gastos de transporte', 1),
('4', '01', '04', '34', 'Complemento al personal militar en el exterior', 1),
('4', '01', '04', '35', 'Bono compensatorio de alimentación al personal militar', 1),
('4', '01', '04', '43', 'Complemento a altos funcionarios y altas funcionarias del poder público y de elección popular por gastos de representación', 1),
('4', '01', '04', '44', 'Complemento a altos funcionarios y altas funcionarias del poder público y  de elección popular por comisión de servicios', 1),
('4', '01', '04', '45', 'Bonificación a altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
('4', '01', '04', '46', 'Bono compensatorio de alimentación a altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
('4', '01', '04', '47', 'Bono compensatorio de transporte a altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
('4', '01', '04', '48', 'Complemento al personal de alto nivel y de dirección por gastos de representación', 1),
('4', '01', '04', '49', 'Complemento al personal de alto nivel y de dirección por comisión de servicios', 1),
('4', '01', '04', '50', 'Bonificación al personal de alto nivel y de dirección', 1),
('4', '01', '04', '51', 'Bono compensatorio de alimentación al personal de alto nivel y de dirección', 1),
('4', '01', '04', '52', 'Bono compensatorio de transporte al personal de alto nivel y de dirección', 1),
('4', '01', '04', '94', 'Otros complementos a altos funcionarios y altas funcionarias del sector público y de elección popular', 1),
('4', '01', '04', '95', 'Otros complementos al personal de alto nivel y de dirección', 1),
('4', '01', '04', '96', 'Otros complementos a empleados', 1),
('4', '01', '04', '97', 'Otros complementos a obreros', 1),
('4', '01', '04', '98', 'Otros complementos al personal contratado', 1),
('4', '01', '04', '99', 'Otros complementos al personal militar', 1),
('4', '01', '05', '01', 'Aguinaldos a empleados', 1),
('4', '01', '05', '02', 'Utilidades legales y convencionales a empleados', 1),
('4', '01', '05', '03', 'Bono vacacional a empleados', 1),
('4', '01', '05', '04', 'Aguinaldos a obreros', 1),
('4', '01', '05', '05', 'Utilidades legales y convencionales a obreros', 1),
('4', '01', '05', '06', 'Bono vacacional a obreros', 1),
('4', '01', '05', '07', 'Aguinaldos al personal contratado', 1),
('4', '01', '05', '08', 'Bono vacacional al personal contratado', 1),
('4', '01', '05', '09', 'Aguinaldos al personal militar', 1),
('4', '01', '05', '10', 'Bono vacacional al personal militar', 1),
('4', '01', '05', '13', 'Aguinaldos a altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
('4', '01', '05', '14', 'Utilidades legales y convencionales a altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
('4', '01', '05', '15', 'Bono vacacional a altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
('4', '01', '05', '16', 'Aguinaldos al personal de alto nivel y de dirección', 1),
('4', '01', '05', '17', 'Utilidades legales y convencionales al personal de alto nivel y de dirección', 1),
('4', '01', '05', '18', 'Bono vacacional al personal de alto nivel y de dirección', 1),
('4', '01', '06', '01', 'Aporte patronal al Instituto Venezolano de los Seguros Sociales (IVSS) por empleados', 1),
('4', '01', '06', '02', 'Aporte patronal al Instituto de Previsión y Asistencia Social para el personal del Ministerio de Educación (Ipasme) por empleados', 1),
('4', '01', '06', '03', 'Aporte patronal al Fondo de Jubilaciones por empleados', 1),
('4', '01', '06', '04', 'Aporte patronal al Fondo de Seguro de Paro Forzoso por empleados', 1),
('4', '01', '06', '05', 'Aporte patronal al Fondo de Ahorro Obligatorio para la Vivienda por empleados', 1),
('4', '01', '06', '10', 'Aporte patronal al Instituto Venezolano de los Seguros Sociales (IVSS) por obreros', 1),
('4', '01', '06', '11', 'Aporte patronal al Fondo de Jubilaciones por obreros', 1),
('4', '01', '06', '12', 'Aporte patronal al Fondo de Seguro de Paro Forzoso por obreros', 1),
('4', '01', '06', '13', 'Aporte patronal al Fondo de Ahorro Obligatorio para la Vivienda por obreros', 1),
('4', '01', '06', '18', 'Aporte patronal a los organismos de seguridad social por los trabajadores locales empleados en las representaciones de Venezuela en el exterior', 1),
('4', '01', '06', '19', 'Aporte patronal al Fondo de Ahorro Obligatorio para la Vivienda por personal militar', 1),
('4', '01', '06', '25', 'Aporte legal al Instituto Venezolano de los Seguros Sociales (IVSS) por personal contratado', 1),
('4', '01', '06', '26', 'Aporte patronal al Fondo de Ahorro Obligatorio para la Vivienda por personal contratado', 1),
('4', '01', '06', '27', 'Aporte patronal al Fondo de Seguro de Paro Forzoso por personal contratado', 1),
('4', '01', '06', '31', 'Aporte patronal al Instituto Venezolano de los Seguros Sociales (IVSS) por altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
('4', '01', '06', '32', 'Aporte patronal al Instituto de Previsión y Asistencia Social para el personal del Ministerio de Educación (Ipasme) por empleados personal del Ministerio de Educación (Ipasme) por altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
('4', '01', '06', '33', 'Aporte patronal al Fondo de Jubilaciones por altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
('4', '01', '06', '34', 'Aporte patronal al Fondo de Ahorro Obligatorio para la Vivienda por altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
('4', '01', '06', '35', 'Aporte patronal al Fondo de Seguro de Paro Forzoso por altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
('4', '01', '06', '39', 'Aporte patronal al Instituto Venezolano de los Seguros Sociales (IVSS) por personal de alto nivel y de dirección', 1),
('4', '01', '06', '40', 'Aporte patronal al Instituto de Previsión y Asistencia Social para el personal del Ministerio de Educación (Ipasme) por personal de alto nivel y de dirección', 1),
('4', '01', '06', '41', 'Aporte patronal al Fondo de Jubilaciones por personal de alto nivel y de dirección', 1),
('4', '01', '06', '42', 'Aporte patronal al Fondo de Ahorro Obligatorio para la Vivienda por personal de alto nivel y de dirección', 1),
('4', '01', '06', '43', 'Aporte patronal al Fondo de Seguro de Paro Forzoso por personal de alto nivel y de dirección', 1),
('4', '01', '06', '93', 'Otros aportes legales por altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
('4', '01', '06', '94', 'Otros aportes legales por el personal de alto nivel y de dirección', 1),
('4', '01', '06', '95', 'Otros aportes legales por personal contratado', 1),
('4', '01', '06', '96', 'Otros aportes legales por empleados', 1),
('4', '01', '06', '97', 'Otros aportes legales por obreros', 1),
('4', '01', '06', '98', 'Otros aportes legales por personal militar', 1),
('4', '01', '07', '01', 'Capacitación y adiestramiento a empleados', 1),
('4', '01', '07', '02', 'Becas a empleados', 1),
('4', '01', '07', '03', 'Ayudas por matrimonio a empleados', 1),
('4', '01', '07', '04', 'Ayudas por nacimiento de hijos a empleados', 1),
('4', '01', '07', '05', 'Ayudas por defunción a empleados', 1),
('4', '01', '07', '06', 'Ayudas para medicinas, gastos médicos, odontológicos y de hospitalización a empleados', 1),
('4', '01', '07', '07', 'Aporte patronal a cajas de ahorro por empleados', 1),
('4', '01', '07', '08', 'Aporte patronal a los servicios de salud, accidentes personales y gastos funerarios por empleados', 1),
('4', '01', '07', '09', 'Ayudas a empleados para adquisición de uniformes y útiles escolares de sus hijos', 1),
('4', '01', '07', '10', 'Dotación de uniformes a empleados', 1),
('4', '01', '07', '11', 'Aporte patronal para gastos de guarderías y preescolar para hijos de empleados', 1),
('4', '01', '07', '12', 'Aportes para la adquisición de juguetes para los hijos del personal empleado', 1),
('4', '01', '07', '17', 'Capacitación y adiestramiento a obreros', 1),
('4', '01', '07', '18', 'Becas a obreros', 1),
('4', '01', '07', '19', 'Ayudas por matrimonio de obreros', 1),
('4', '01', '07', '20', 'Ayudas por nacimiento de hijos de obreros', 1),
('4', '01', '07', '21', 'Ayudas por defunción a obreros', 1),
('4', '01', '07', '22', 'Ayudas para medicinas, gastos médicos, odontológicos y de hospitalización a obreros', 1),
('4', '01', '07', '23', 'Aporte patronal a cajas de ahorro por obreros', 1),
('4', '01', '07', '24', 'Aporte patronal a los servicios de salud, accidentes personales y gastos funerarios por obreros', 1),
('4', '01', '07', '25', 'Ayudas a obreros para adquisición de uniformes y útiles escolares de sus hijos', 1),
('4', '01', '07', '26', 'Dotación de uniformes a obreros', 1),
('4', '01', '07', '27', 'Aporte patronal para gastos de guarderías y preescolar para hijos de obreros', 1),
('4', '01', '07', '28', 'Aportes para la adquisición de juguetes para los hijos del personal obrero', 1),
('4', '01', '07', '34', 'Capacitación y adiestramiento al personal militar', 1),
('4', '01', '07', '35', 'Becas al personal militar', 1),
('4', '01', '07', '36', 'Ayudas por matrimonio al personal militar', 1),
('4', '01', '07', '37', 'Ayudas por nacimiento de hijos al personal militar', 1),
('4', '01', '07', '38', 'Ayudas por defunción al personal militar', 1),
('4', '01', '07', '39', 'Ayudas para medicinas, gastos médicos, odontológicos y de hospitalización al personal militar', 1),
('4', '01', '07', '40', 'Aporte patronal a caja de ahorro por personal militar', 1),
('4', '01', '07', '41', 'Aporte patronal a los servicios de salud, accidentes personales y gastos funerarios personal militar', 1),
('4', '01', '07', '42', 'Ayudas al personal militar para adquisición de uniformes y útiles escolares de sus hijos', 1),
('4', '01', '07', '43', 'Aportes para la adquisición de juguetes para los hijos del personal militar', 1),
('4', '01', '07', '44', 'Aporte patronal para gastos de guarderías y preescolar para hijos del personal militar', 1),
('4', '01', '07', '52', 'Capacitación y adiestramiento a altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
('4', '01', '07', '53', 'Ayudas por matrimonio a altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
('4', '01', '07', '54', 'Ayudas por nacimiento de hijos altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
('4', '01', '07', '55', 'Ayudas por defunción a altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
('4', '01', '07', '56', 'Ayudas para medicinas, gastos médicos, odontológicos y de hospitalización a altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
('4', '01', '07', '57', 'Aporte patronal a cajas de ahorro por altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
('4', '01', '07', '58', 'Aporte patronal a los servicios de salud, accidentes personales y gastos funerarios por altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
('4', '01', '07', '63', 'Capacitación y adiestramiento al personal de alto nivel y de dirección', 1),
('4', '01', '07', '64', 'Ayudas por matrimonio al personal de alto nivel y de dirección ', 1),
('4', '01', '07', '65', 'Ayudas por nacimiento de hijos al personal de alto nivel y de dirección', 1),
('4', '01', '07', '66', 'Ayudas por defunción al personal de alto nivel y de dirección', 1),
('4', '01', '07', '67', 'Ayudas para medicinas, gastos médicos, odontológicos y de hospitalización al personal de alto nivel y de dirección', 1),
('4', '01', '07', '68', 'Aporte patronal a cajas de ahorro por personal de alto nivel y de dirección', 1),
('4', '01', '07', '69', 'Aporte patronal a los servicios de salud, accidentes personales y gastos funerarios por personal de alto nivel y de dirección', 1),
('4', '01', '07', '74', 'Capacitación y adiestramiento al personal contratado', 1),
('4', '01', '07', '75', 'Becas al personal contratado', 1),
('4', '01', '07', '76', 'Ayudas por matrimonio al personal contratado', 1),
('4', '01', '07', '77', 'Ayudas por nacimiento de hijos al personal contratado', 1),
('4', '01', '07', '78', 'Ayudas por defunción al personal contratado', 1),
('4', '01', '07', '79', 'Ayudas para medicinas, gastos médicos, odontológicos y de hospitalización al personal contratado', 1),
('4', '01', '07', '80', 'Aporte patronal a cajas de ahorro por personal contratado', 1),
('4', '01', '07', '81', 'Aporte patronal a los servicios de salud, accidentes personales y gastos funerarios por personal contratado', 1),
('4', '01', '07', '82', 'Ayudas al personal contratado para adquisición de uniformes y útiles escolares de sus hijos', 1),
('4', '01', '07', '83', 'Dotación de uniformes al personal contratado', 1),
('4', '01', '07', '84', 'Aporte patronal para gastos de guarderías y preescolar para hijos del personal contratado', 1),
('4', '01', '07', '85', 'Aportes para la adquisición de juguetes para los hijos del personal contratado', 1),
('4', '01', '07', '94', 'Otras subvenciones a altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
('4', '01', '07', '95', 'Otras subvenciones al personal de alto nivel y de dirección', 1),
('4', '01', '07', '96', 'Otras subvenciones a empleados', 1),
('4', '01', '07', '97', 'Otras subvenciones a obreros', 1),
('4', '01', '07', '98', 'Otras subvenciones al personal militar', 1),
('4', '01', '07', '99', 'Otras subvenciones al personal contratado', 1),
('4', '01', '08', '01', 'Prestaciones sociales e indemnizaciones a empleados', 1),
('4', '01', '08', '02', 'Prestaciones sociales e indemnizaciones a obreros', 1),
('4', '01', '08', '03', 'Prestaciones sociales e indemnizaciones al personal contratado', 1),
('4', '01', '08', '04', 'Prestaciones sociales e indemnizaciones al personal militar', 1),
('4', '01', '08', '06', 'Prestaciones sociales e indemnizaciones a altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
('4', '01', '08', '07', 'Prestaciones sociales e indemnizaciones al personal de alto nivel y Prestaciones sociales e indemnizaciones al personal de alto nivel y de dirección', 1),
('4', '01', '09', '01', 'Capacitación y adiestramiento realizado por personal del organismo', 1),
('4', '01', '94', '01', 'Otros gastos de los altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
('4', '01', '95', '01', 'Otros gastos del personal de alto nivel y de dirección', 1),
('4', '01', '96', '01', 'Otros gastos del personal empleado', 1),
('4', '01', '97', '01', 'Otros gastos del personal obrero', 1),
('4', '01', '98', '01', 'Otros gastos del personal militar', 1),
('4', '02', '01', '01', 'Alimentos y bebidas para personas', 1),
('4', '02', '01', '02', 'Alimentos para animales', 1),
('4', '02', '01', '03', 'Productos agrícolas y pecuarios', 1),
('4', '02', '01', '04', 'Productos de la caza y pesca', 1),
('4', '02', '01', '99', 'Otros productos alimenticios y agropecuarios', 1),
('4', '02', '02', '01', 'Carbón mineral', 1),
('4', '02', '02', '02', 'Petróleo crudo y gas natural', 1),
('4', '02', '02', '03', 'Mineral de hierro', 1),
('4', '02', '02', '04', 'Mineral no ferroso', 1),
('4', '02', '02', '05', 'Piedra, arcilla, arena y tierra', 1),
('4', '02', '02', '06', 'Mineral para la fabricación de productos químicos', 1),
('4', '02', '02', '07', 'Sal para uso industrial', 1),
('4', '02', '02', '99', 'Otros productos de minas, canteras y yacimientos', 1),
('4', '02', '03', '01', 'Textiles', 1),
('4', '02', '03', '02', 'Prendas de vestir', 1),
('4', '02', '03', '03', 'Calzados', 1),
('4', '02', '03', '99', 'Otros productos textiles y vestuarios', 1),
('4', '02', '04', '01', 'Cueros y pieles', 1),
('4', '02', '04', '02', 'Productos de cuero y sucedáneos del cuero', 1),
('4', '02', '04', '03', 'Cauchos y tripas para vehículos', 1),
('4', '02', '04', '99', 'Otros productos de cuero y caucho', 1),
('4', '02', '05', '01', 'Pulpa de madera, papel y cartón', 1),
('4', '02', '05', '02', 'Envases y cajas de papel y cartón', 1),
('4', '02', '05', '03', 'Productos de papel y cartón para oficina', 1),
('4', '02', '05', '04', 'Libros, revistas y periódicos', 1),
('4', '02', '05', '05', 'Material de enseñanza', 1),
('4', '02', '05', '06', 'Productos de papel y cartón para computación', 1),
('4', '02', '05', '07', 'Productos de papel y cartón para la imprenta y reproducción', 1),
('4', '02', '05', '99', 'Otros productos de pulpa, papel y cartón', 1);
INSERT INTO `partida_especifica` (`cuenta`, `partida`, `generica`, `especifica`, `nombre`, `estatus`) VALUES
('4', '02', '06', '01', 'Sustancias químicas y de uso industrial', 1),
('4', '02', '06', '02', 'Abonos, plaguicidas y otros', 1),
('4', '02', '06', '03', 'Tintas, pinturas y colorantes', 1),
('4', '02', '06', '04', 'Productos farmacéuticos y medicamentos', 1),
('4', '02', '06', '05', 'Productos de tocador', 1),
('4', '02', '06', '06', 'Combustibles y lubricantes', 1),
('4', '02', '06', '07', 'Productos diversos derivados del petróleo y del carbón', 1),
('4', '02', '06', '08', 'Productos plásticos', 1),
('4', '02', '06', '09', 'Mezclas explosivas', 1),
('4', '02', '06', '99', 'Otros productos de la industria química y conexos', 1),
('4', '02', '07', '01', 'Productos de barro, loza y porcelana', 1),
('4', '02', '07', '02', 'Vidrios y productos de vidrio', 1),
('4', '02', '07', '03', 'Productos de arcilla para construcción', 1),
('4', '02', '07', '04', 'Cemento, cal y yeso', 1),
('4', '02', '07', '99', 'Otros productos minerales no metálicos', 1),
('4', '02', '08', '01', 'Productos primarios de hierro y acero', 1),
('4', '02', '08', '02', 'Productos de metales no ferrosos', 1),
('4', '02', '08', '03', 'Herramientas menores, cuchillería y artículos generales de ferretería', 1),
('4', '02', '08', '04', 'Productos metálicos estructurales', 1),
('4', '02', '08', '05', 'Materiales de orden público, seguridad y defensa', 1),
('4', '02', '08', '07', 'Material de señalamiento', 1),
('4', '02', '08', '08', 'Material de educación', 1),
('4', '02', '08', '09', 'Repuestos y accesorios para equipos de transporte', 1),
('4', '02', '08', '10', 'Repuestos y accesorios para otros equipos', 1),
('4', '02', '08', '99', 'Otros productos metálicos', 1),
('4', '02', '09', '01', 'Productos primarios de madera', 1),
('4', '02', '09', '02', 'Muebles y accesorios de madera para edificaciones', 1),
('4', '02', '09', '99', 'Otros productos de madera', 1),
('4', '02', '10', '01', 'Artículos de deporte, recreación y juguetes', 1),
('4', '02', '10', '02', 'Materiales y útiles de limpieza y aseo', 1),
('4', '02', '10', '03', 'Utensilios de cocina y comedor', 1),
('4', '02', '10', '04', 'Útiles menores médico - quirúrgicos de laboratorio, dentales y de veterinaria', 1),
('4', '02', '10', '05', 'Útiles de escritorio, oficina y materiales de instrucción', 1),
('4', '02', '10', '06', 'Condecoraciones, ofrendas y similares', 1),
('4', '02', '10', '07', 'Productos de seguridad en el trabajo', 1),
('4', '02', '10', '08', 'Materiales para equipos de computación', 1),
('4', '02', '10', '09', 'Especies timbradas y valores', 1),
('4', '02', '10', '10', 'Útiles religiosos', 1),
('4', '02', '10', '11', 'Materiales eléctricos', 1),
('4', '02', '10', '12', 'Materiales para instalaciones sanitarias', 1),
('4', '02', '10', '13', 'Materiales fotográficos', 1),
('4', '02', '10', '99', 'Otros productos y útiles diversos', 1),
('4', '02', '11', '01', 'Productos y artículos para la venta', 1),
('4', '02', '11', '02', 'Maquinarias y equipos para la venta', 1),
('4', '02', '11', '03', 'Inmuebles para la venta', 1),
('4', '02', '11', '04', 'Tierras y terrenos para la venta', 1),
('4', '02', '11', '99', 'Otros bienes para la venta', 1),
('4', '02', '99', '01', 'Otros materiales y suministros', 1),
('4', '03', '01', '01', 'Alquileres de edificios y locales', 1),
('4', '03', '01', '02', 'Alquileres de edificios y locales', 1),
('4', '03', '01', '03', 'Alquileres de tierras y terrenos', 1),
('4', '03', '02', '01', 'Alquileres de maquinaria y demás equipos de construcción, campo, industria y taller', 1),
('4', '03', '02', '02', 'Alquileres de equipos de transporte, tracción y elevación', 1),
('4', '03', '02', '03', 'Alquileres de equipos de comunicaciones y de señalamiento', 1),
('4', '03', '02', '04', 'Alquileres de equipos médico - quirúrgicos, dentales y de veterinaria', 1),
('4', '03', '02', '05', 'Alquileres de equipos científicos, religiosos, de enseñanza y recreación', 1),
('4', '03', '02', '06', 'Alquileres de máquinas, muebles y demás equipos de oficina y alojamiento', 1),
('4', '03', '02', '99', 'Alquileres de otras maquinaria y equipos', 1),
('4', '03', '03', '01', 'Marcas de fábrica y patentes de invención', 1),
('4', '03', '03', '02', 'Derechos de autor', 1),
('4', '03', '03', '03', 'Paquetes y programas de computación', 1),
('4', '03', '03', '04', 'Concesión de bienes y servicios', 1),
('4', '03', '04', '01', 'Electricidad', 1),
('4', '03', '04', '02', 'Gas', 1),
('4', '03', '04', '03', 'Agua', 1),
('4', '03', '04', '04', 'Teléfonos', 1),
('4', '03', '04', '05', 'Servicio de comunicaciones', 1),
('4', '03', '04', '06', 'Servicio de aseo urbano y domiciliario', 1),
('4', '03', '04', '07', 'Servicio de condominio', 1),
('4', '03', '05', '01', 'Servicio de administración, vigilancia y mantenimiento del servicio de electricidad', 1),
('4', '03', '05', '02', 'Servicio de administración, vigilancia y mantenimiento del servicio de gas', 1),
('4', '03', '05', '03', 'Servicio de administración, vigilancia y mantenimiento del servicio de agua', 1),
('4', '03', '05', '04', 'Servicio de administración, vigilancia y mantenimiento del servicio de teléfonos', 1),
('4', '03', '05', '05', 'Servicio de administración, vigilancia y mantenimiento del servicio de comunicaciones', 1),
('4', '03', '05', '06', 'Servicio de administración, vigilancia y mantenimiento del servicio de aseo urbano y domiciliario', 1),
('4', '03', '06', '01', 'Fletes y embalajes', 1),
('4', '03', '06', '02', 'Almacenaje', 1),
('4', '03', '06', '03', 'Estacionamiento', 1),
('4', '03', '06', '04', 'Peaje', 1),
('4', '03', '06', '05', 'Servicios de protección en traslado de fondos y de mensajería', 1),
('4', '03', '07', '01', 'Publicidad y propaganda', 1),
('4', '03', '07', '02', 'Imprenta y reproducción', 1),
('4', '03', '07', '03', 'Relaciones sociales', 1),
('4', '03', '07', '04', 'Avisos', 1),
('4', '03', '08', '01', 'Primas y gastos de seguros', 1),
('4', '03', '08', '02', 'Comisiones y gastos bancarios', 1),
('4', '03', '08', '03', 'Comisiones y gastos de adquisición de seguros', 1),
('4', '03', '09', '01', 'Viáticos y pasajes dentro del país', 1),
('4', '03', '09', '02', 'Viáticos y pasajes fuera del país', 1),
('4', '03', '09', '03', 'Asignación por kilómetros recorridos', 1),
('4', '03', '10', '01', 'Servicios jurídicos', 1),
('4', '03', '10', '02', 'Servicios de contabilidad y auditoría', 1),
('4', '03', '10', '03', 'Servicios de procesamiento de datos', 1),
('4', '03', '10', '04', 'Servicios de ingeniería y arquitectónicos', 1),
('4', '03', '10', '05', 'Servicios médicos, odontológicos y otros servicios de sanidad', 1),
('4', '03', '10', '06', 'Servicios de veterinaria', 1),
('4', '03', '10', '07', 'Servicios de capacitación y adiestramiento', 1),
('4', '03', '10', '08', 'Servicios presupuestarios', 1),
('4', '03', '10', '09', 'Servicios de lavandería y tintorería', 1),
('4', '03', '10', '10', 'Servicios de vigilancia y seguridad', 1),
('4', '03', '10', '11', 'Servicios para la elaboración y suministro de comida', 1),
('4', '03', '10', '99', 'Otros servicios profesionales y técnicos', 1),
('4', '03', '11', '01', 'Conservación y reparaciones menores de maquinaria y demás equipos de construcción, campo, industria y taller', 1),
('4', '03', '11', '02', 'Conservación y reparaciones menores de equipos de transporte, tracción y elevación', 1),
('4', '03', '11', '03', 'Conservación y reparaciones menores de equipos de comunicaciones y de señalamiento', 1),
('4', '03', '11', '04', 'Conservación y reparaciones menores de equipos médicoquirúrgicos dentales y de veterinaria', 1),
('4', '03', '11', '05', 'Conservación y reparaciones menores de equipos científicos, religiosos, de enseñanza y recreación', 1),
('4', '03', '11', '06', 'Conservación y reparaciones menores de equipos y armamentos de orden público, seguridad y defensa nacional', 1),
('4', '03', '11', '07', 'Conservación y reparaciones menores de máquinas, muebles y demás equipos de oficina y alojamiento', 1),
('4', '03', '11', '99', 'Conservación y reparaciones menores de otras maquinaria y equipos', 1),
('4', '03', '12', '01', 'Conservación y reparaciones menores de obras en bienes del dominio privado', 1),
('4', '03', '12', '02', 'Conservación y reparaciones menores de obras en bienes del dominio público', 1),
('4', '03', '13', '01', 'Servicios de construcciones temporales', 1),
('4', '03', '14', '01', 'Servicios de construcción de edificaciones para la venta', 1),
('4', '03', '15', '01', 'Derechos de importación y servicios aduaneros', 1),
('4', '03', '15', '02', 'Tasas y otros derechos obligatorios', 1),
('4', '03', '15', '03', 'Asignación a agentes de especies fiscales', 1),
('4', '03', '15', '99', 'Otros servicios fiscales', 1),
('4', '03', '16', '01', 'Servicios de diversión, esparcimiento y culturales', 1),
('4', '03', '17', '01', 'Servicios de gestión administrativa prestados por organismos de asistencia técnica', 1),
('4', '03', '18', '01', 'Impuesto al valor agregado', 1),
('4', '03', '18', '99', 'Otros impuestos indirectos', 1),
('4', '03', '19', '01', 'Comisiones por servicios para cumplir con los beneficios sociales', 1),
('4', '03', '99', '01', 'Otros servicios no personales', 1),
('4', '04', '01', '01', 'Repuestos mayores', 1),
('4', '04', '01', '02', 'Reparaciones, mejoras y adiciones mayores de maquinaria y equipos', 1),
('4', '04', '02', '01', 'Conservación, ampliaciones y mejoras mayores de obras en bienes del dominio privado', 1),
('4', '04', '02', '02', 'Conservación, ampliaciones y mejoras mayores de obras en bienes del dominio público', 1),
('4', '04', '03', '01', 'Maquinaria y demás equipos de construcción y mantenimiento', 1),
('4', '04', '03', '02', 'Maquinaria y equipos para mantenimiento de automotores', 1),
('4', '04', '03', '03', 'Maquinaria y equipos agrícolas y pecuarios', 1),
('4', '04', '03', '04', 'Maquinaria y equipos de artes gráficas y reproducción', 1),
('4', '04', '03', '05', 'Maquinaria y equipos industriales y de taller', 1),
('4', '04', '03', '06', 'Maquinaria y equipos de energía', 1),
('4', '04', '03', '07', 'Maquinaria y equipos de riego y acueductos', 1),
('4', '04', '03', '08', 'Equipos de almacén', 1),
('4', '04', '03', '99', 'Otra maquinaria y demás equipos de construcción, campo, industria y taller', 1),
('4', '04', '04', '01', 'Vehículos automotores terrestres', 1),
('4', '04', '04', '02', 'Equipos ferroviarios y de cables aéreos', 1),
('4', '04', '04', '03', 'Equipos marítimos de transporte', 1),
('4', '04', '04', '04', 'Equipos aéreos de transporte', 1),
('4', '04', '04', '05', 'Vehículos de tracción no motorizados', 1),
('4', '04', '04', '06', 'Equipos auxiliares de transporte', 1),
('4', '04', '04', '99', 'Otros equipos de transporte, tracción y elevación', 1),
('4', '04', '05', '01', 'Equipos de telecomunicaciones', 1),
('4', '04', '05', '02', 'Equipos de señalamiento', 1),
('4', '04', '05', '03', 'Equipos de control de tráfico aéreo', 1),
('4', '04', '05', '04', 'Equipos de correo', 1),
('4', '04', '05', '99', 'Otros equipos de comunicaciones y de señalamiento', 1),
('4', '04', '06', '01', 'Equipos médico - quirúrgicos, dentales y de veterinaria', 1),
('4', '04', '06', '99', 'Otros equipos médico - quirúrgicos, dentales y de veterinaria', 1),
('4', '04', '07', '01', 'Equipos científicos y de laboratorio', 1),
('4', '04', '07', '02', 'Equipos de enseñanza, deporte y recreación', 1),
('4', '04', '07', '03', 'Obras de arte', 1),
('4', '04', '07', '04', 'Libros, revistas y otros instrumentos de enseñanzas', 1),
('4', '04', '07', '05', 'Equipos religiosos', 1),
('4', '04', '07', '06', 'Instrumentos musicales y equipos de audio', 1),
('4', '04', '07', '99', 'Otros equipos científicos, religiosos, de enseñanza y recreación', 1),
('4', '04', '08', '01', 'Equipos y armamentos de orden público, seguridad y defensa nacional', 1),
('4', '04', '08', '02', 'Equipos y armamentos de seguridad para la custodia y resguardo personal', 1),
('4', '04', '08', '99', 'Otros equipos y armamentos de orden público, seguridad y defensa', 1),
('4', '04', '09', '01', 'Mobiliario y equipos de oficina', 1),
('4', '04', '09', '02', 'Equipos de computación', 1),
('4', '04', '09', '03', 'Mobiliario y equipos de alojamiento', 1),
('4', '04', '09', '99', 'Otras máquinas, muebles y demás equipos de oficina y alojamiento', 1),
('4', '04', '10', '01', 'Semovientes', 1),
('4', '04', '11', '01', 'Adquisición de tierras y terrenos', 1),
('4', '04', '11', '02', 'Adquisición de edificios e instalaciones', 1),
('4', '04', '11', '03', 'Expropiación de tierras y terrenos', 1),
('4', '04', '11', '04', 'Expropiación de edificios e instalaciones', 1),
('4', '04', '11', '05', 'Adquisición de maquinaria y equipos usados', 1),
('4', '04', '12', '01', 'Marcas de fábrica y patentes de invención', 1),
('4', '04', '12', '02', 'Derechos de autor', 1),
('4', '04', '12', '03', 'Gastos de organización', 1),
('4', '04', '12', '04', 'Paquetes y programas de computación', 1),
('4', '04', '12', '05', 'Estudios y proyectos', 1),
('4', '04', '12', '99', 'Otros activos intangibles', 1),
('4', '04', '13', '01', 'Estudios y proyectos aplicables a bienes del dominio privado', 1),
('4', '04', '13', '02', 'Estudios y proyectos aplicables a bienes del dominio público', 1),
('4', '04', '14', '01', 'Contratación de inspección de obras de bienes del dominio privado', 1),
('4', '04', '14', '02', 'Contratación de inspección de obras de bienes del dominio público', 1),
('4', '04', '15', '01', 'Construcciones de edificaciones médico-asistenciales', 1),
('4', '04', '15', '02', 'Construcciones de edificaciones militares y de seguridad', 1),
('4', '04', '15', '03', 'Construcciones de edificaciones educativas, religiosas y recreativas', 1),
('4', '04', '15', '04', 'Construcciones de edificaciones culturales y deportivas', 1),
('4', '04', '15', '05', 'Construcciones de edificaciones para oficina', 1),
('4', '04', '15', '06', 'Construcciones de edificaciones industriales', 1),
('4', '04', '15', '07', 'Construcciones de edificaciones habitacionales', 1),
('4', '04', '15', '99', 'Otras construcciones del dominio privado', 1),
('4', '04', '16', '01', 'Construcción de vialidad', 1),
('4', '04', '16', '02', 'Construcción de plazas, parques y similares', 1),
('4', '04', '16', '03', 'Construcciones de instalaciones hidráulicas', 1),
('4', '04', '16', '04', 'Construcciones de puertos y aeropuertos', 1),
('4', '04', '16', '99', 'Otras construcciones del dominio público', 1),
('4', '04', '99', '01', 'Otros activos reales', 1),
('4', '05', '01', '01', 'Aportes en acciones y participaciones de capital al sector privado', 1),
('4', '05', '01', '02', 'Aportes en acciones y participaciones de capital al sector público', 1),
('4', '05', '01', '03', 'Aportes en acciones y participaciones de capital al sector externo', 1),
('4', '05', '02', '01', 'Adquisición de títulos y valores a corto plazo', 1),
('4', '05', '02', '02', 'Adquisición de títulos y valores a largo plazo', 1),
('4', '05', '03', '01', 'Concesión de préstamos al sector público a corto plazo', 1),
('4', '05', '03', '02', 'Concesión de préstamos al sector público a corto plazo', 1),
('4', '05', '03', '03', 'Concesión de préstamos al sector externo a corto plazo', 1),
('4', '05', '04', '01', 'Concesión de préstamos al sector privado a largo plazo', 1),
('4', '05', '04', '02', 'Concesión de préstamos al sector público a largo plazo', 1),
('4', '05', '04', '03', 'Concesión de préstamos al sector externo a largo plazo', 1),
('4', '05', '05', '01', 'Incremento en caja', 1),
('4', '05', '05', '02', 'Incremento en bancos', 1),
('4', '05', '05', '03', 'Incremento de inversiones temporales', 1),
('4', '05', '06', '01', 'Incremento de cuentas comerciales por cobrar a corto plazo', 1),
('4', '05', '06', '02', 'Incremento de rentas por recaudar a corto plazo', 1),
('4', '05', '06', '03', 'Incremento de deudas por rendir', 1),
('4', '05', '06', '99', 'Incremento de otras cuentas por cobrar a corto plazo', 1),
('4', '05', '07', '01', 'Incremento de efectos comerciales por cobrar a corto plazo', 1),
('4', '05', '07', '99', 'Incremento de otros efectos por cobrar a corto plazo', 1),
('4', '05', '08', '01', 'Incremento de cuentas comerciales por cobrar a mediano y largo plazo', 1),
('4', '05', '08', '02', 'Incremento de rentas por recaudar a mediano y largo plazo', 1),
('4', '05', '08', '99', 'Incremento de otras cuentas por cobrar a mediano y largo plazo', 1),
('4', '05', '09', '01', 'Incremento de efectos comerciales por cobrar a mediano y largo plazo', 1),
('4', '05', '09', '99', 'Incremento de otros efectos por cobrar a mediano y largo plazo', 1),
('4', '05', '10', '01', 'Incremento de fondos en avance', 1),
('4', '05', '10', '02', 'Incremento de fondos en anticipos', 1),
('4', '05', '10', '03', 'Incremento de fondos en fideicomiso', 1),
('4', '05', '10', '04', 'Incremento de anticipos a proveedores', 1),
('4', '05', '10', '05', 'Incremento de anticipos a contratistas por contratos de corto plazo', 1),
('4', '05', '10', '06', 'Incremento de anticipos a contratistas por contratos de mediano y largo plazo', 1),
('4', '05', '11', '01', 'Incremento de gastos a corto plazo pagados por anticipado', 1),
('4', '05', '11', '02', 'Incremento de depósitos otorgados en garantía a corto plazo', 1),
('4', '05', '11', '99', 'Incremento de otros activos diferidos a corto plazo', 1),
('4', '05', '12', '01', 'Incremento de gastos a mediano y largo plazo pagados por anticipado', 1),
('4', '05', '12', '02', 'Incremento de depósitos otorgados en garantía a mediano y largo plazo', 1),
('4', '05', '12', '99', 'Incremento de otros activos diferidos a mediano y largo plazo', 1),
('4', '05', '13', '01', 'Incremento del Fondo de Estabilización Macroeconómica (FEM) de la República', 1),
('4', '05', '13', '02', 'Incremento del Fondo de Estabilización Macroeconómica (FEM) del Poder Estadal', 1),
('4', '05', '13', '03', 'Incremento del Fondo de Estabilización Macroeconómica (FEM) del Poder Municipal', 1),
('4', '05', '14', '01', 'Incremento del Fondo de Ahorro Intergeneracional', 1),
('4', '05', '16', '01', 'Incremento del Fondo de Aportes del Sector Público', 1),
('4', '05', '20', '01', 'Incremento de otros activos financieros circulantes', 1),
('4', '05', '21', '01', 'Incremento de activos en gestión judicial a mediano y largo plazo', 1),
('4', '05', '21', '02', 'Incremento de títulos y otros valores de la deuda pública en litigio a largo plazo', 1),
('4', '05', '21', '99', 'Incremento de otros activos financieros no circulantes', 1),
('4', '05', '99', '01', 'Otros activos financieros', 1),
('4', '06', '01', '01', 'Gastos de defensa y seguridad del Estado', 1),
('4', '07', '01', '01', 'Transferencias corrientes internas al sector privado', 1),
('4', '07', '01', '02', 'Donaciones corrientes internas al sector privado', 1),
('4', '07', '01', '03', 'Transferencias corrientes internas al sector público', 1),
('4', '07', '01', '04', 'Donaciones corrientes internas al sector público', 1),
('4', '07', '01', '05', 'Pensiones de altos funcionarios y altas funcionarias del poder público y de elección popular, del personal de alto nivel y de dirección', 1),
('4', '07', '01', '06', 'Jubilaciones de altos funcionarios y altas funcionarias del poder público y de elección popular, del personal de alto nivel y de dirección', 1),
('4', '07', '02', '01', 'Transferencias corrientes al exterior', 1),
('4', '07', '02', '02', 'Donaciones corrientes al exterior', 1),
('4', '07', '03', '01', 'Transferencias de capital internas al sector privado', 1),
('4', '07', '03', '02', 'Donaciones de capital internas al sector privado', 1),
('4', '07', '03', '03', 'Transferencias de capital internas al sector público', 1),
('4', '07', '03', '04', 'Donaciones de capital internas al sector público', 1),
('4', '07', '04', '01', 'Transferencias de capital al exterior', 1),
('4', '07', '04', '02', 'Donaciones de capital al exterior', 1),
('4', '07', '05', '01', 'Situado Constitucional', 1),
('4', '07', '05', '02', 'Situado Estadal a Municipal', 1),
('4', '07', '06', '01', 'Subsidio de Régimen Especial', 1),
('4', '07', '07', '01', 'Subsidio de capitalidad', 1),
('4', '07', '08', '01', 'Asignaciones Económicas Especiales (LAEE) Estadal', 1),
('4', '07', '08', '02', 'Asignaciones Económicas Especiales (LAEE) Estadal a Municipal', 1),
('4', '07', '08', '03', 'Asignaciones Económicas Especiales (LAEE) Municipal', 1),
('4', '07', '08', '04', 'Asignaciones Económicas Especiales (LAEE) Fondo Nacional de los Consejos Comunales', 1),
('4', '07', '08', '05', 'Asignaciones Económicas Especiales (LAEE) Apoyo al Fortalecimiento Institucional', 1),
('4', '07', '09', '01', 'Aportes al Poder Estadal por transferencia de servicios', 1),
('4', '07', '09', '02', 'Aportes al Poder Municipal por transferencia de servicios', 1),
('4', '07', '10', '01', 'Fondo Intergubernamental para la Descentralización (FIDES)', 1),
('4', '07', '11', '01', 'Fondo de Compensación Interterritorial Estadal', 1),
('4', '07', '11', '02', 'Fondo de Compensación Interterritorial Municipal', 1),
('4', '07', '11', '03', 'Fondo de Compensación Interterritorial Poder Popular', 1),
('4', '07', '11', '04', 'Fondo de Compensación Interterritorial Fortalecimiento Institucional', 1),
('4', '07', '12', '01', 'Transferencias y donaciones corrientes a Consejos Comunales', 1),
('4', '07', '12', '02', 'Transferencias y donaciones de capital a Consejos Comunales', 1),
('4', '08', '01', '01', 'Depreciación', 1),
('4', '08', '01', '02', 'Amortización', 1),
('4', '08', '02', '01', 'Intereses por depósitos internos', 1),
('4', '08', '02', '02', 'Intereses por títulos y valores', 1),
('4', '08', '02', '03', 'Intereses por otros financiamientos', 1),
('4', '08', '03', '01', 'Gastos de siniestros', 1),
('4', '08', '03', '02', 'Gastos de operaciones de reaseguros', 1),
('4', '08', '03', '99', 'Otros gastos de operaciones de seguro', 1),
('4', '08', '04', '01', 'Pérdidas en el proceso de distribución de los servicios', 1),
('4', '08', '04', '99', 'Otras pérdidas en operación', 1),
('4', '08', '05', '01', 'Devoluciones de cobros indebidos', 1),
('4', '08', '05', '02', 'Devoluciones y reintegros diversos', 1),
('4', '08', '05', '03', 'Indemnizaciones diversas', 1),
('4', '08', '06', '01', 'Pérdidas en inventarios', 1),
('4', '08', '06', '02', 'Pérdidas en operaciones cambiarias', 1),
('4', '08', '06', '03', 'Pérdidas en ventas de activos', 1),
('4', '08', '06', '04', 'Pérdidas por cuentas incobrables', 1),
('4', '08', '06', '05', 'Participación en pérdidas de otras empresas', 1),
('4', '08', '06', '06', 'Pérdidas por auto-seguro', 1),
('4', '08', '06', '07', 'Impuestos directos', 1),
('4', '08', '06', '08', 'Intereses de mora', 1),
('4', '08', '06', '09', 'Reservas técnicas', 1),
('4', '08', '07', '01', 'Descuentos sobre ventas', 1),
('4', '08', '07', '02', 'Bonificaciones por ventas', 1),
('4', '08', '07', '03', 'Devoluciones por ventas', 1),
('4', '08', '07', '04', 'Devoluciones por primas de seguro', 1),
('4', '08', '08', '01', 'Indemnizaciones por daños y perjuicios', 1),
('4', '08', '08', '02', 'Sanciones pecuniarias', 1),
('4', '08', '99', '01', 'Otros gastos', 1),
('4', '09', '01', '01', 'Asignaciones no distribuidas de la Asamblea Nacional', 1),
('4', '09', '02', '01', 'Asignaciones no distribuidas de la Contraloría General de la República', 1),
('4', '09', '03', '01', 'Asignaciones no distribuidas del Consejo Nacional Electoral', 1),
('4', '09', '04', '01', 'Asignaciones no distribuidas del Tribunal Supremo de Justicia', 1),
('4', '09', '05', '01', 'Asignaciones no distribuidas del Ministerio Público', 1),
('4', '09', '06', '01', 'Asignaciones no distribuidas de la Defensoría del Pueblo', 1),
('4', '09', '07', '01', 'Asignaciones no distribuidas del Consejo Moral Republicano', 1),
('4', '09', '08', '01', 'Reestructuración de organismos del sector público', 1),
('4', '09', '09', '01', 'Fondo de apoyo al trabajador y su grupo familiar de la Administración Pública Nacional', 1),
('4', '09', '09', '02', 'Fondo de apoyo al trabajador y su grupo familiar de las Entidades Federales, los Municipios y otras formas de gobierno municipal', 1),
('4', '09', '10', '01', 'Reforma de la seguridad social', 1),
('4', '09', '11', '01', 'Emergencias en el territorio nacional', 1),
('4', '09', '12', '01', 'Fondo para la cancelación de pasivos laborales', 1),
('4', '09', '13', '01', 'Fondo para la cancelación de deuda por servicios de electricidad teléfono, aseo, agua y condominio, de los organismos de la Administración Central', 1),
('4', '09', '13', '02', 'Fondo para la cancelación de deuda por servicios de electricidad teléfono, aseo, agua y condominio, de los organismos de la  Administración Descentralizada Nacional', 1),
('4', '09', '14', '01', 'Fondo para remuneraciones, pensiones y jubilaciones y otras retribuciones', 1),
('4', '09', '15', '01', 'Fondo para atender compromisos generados de la Ley Orgánica del Trabajo, los Trabajadores y las Trabajadoras', 1),
('4', '09', '16', '01', 'Asignaciones para cancelar compromisos pendientes de ejercicios anteriores', 1),
('4', '09', '17', '01', 'Asignaciones para cancelar la deuda Fogade – Ministerio competente en Materia de Finanzas – Banco Central de Venezuela (BCV)', 1),
('4', '09', '18', '01', 'Asignaciones para atender los gastos de la referenda y elecciones', 1),
('4', '09', '19', '01', 'Asignaciones para atender los gastos por honorarios profesionales de bufetes internacionales, costas y costos judiciales', 1),
('4', '09', '20', '01', 'Fondo para atender compromisos generados por la contratación colectiva', 1),
('4', '09', '21', '01', 'Proyecto social especial', 1),
('4', '09', '22', '01', 'Asignaciones para programas y proyectos financiados con recursos de organismos multilaterales y/o bilaterales', 1),
('4', '09', '23', '01', 'Asignación para facilitar la preparación de proyectos', 1),
('4', '09', '24', '01', 'Programas de inversión para las entidades estadales municipalidades y otras instituciones', 1),
('4', '09', '25', '01', 'Cancelación de compromisos', 1),
('4', '09', '26', '01', 'Asignaciones para atender gastos de los organismos del sector público', 1),
('4', '09', '27', '01', 'Convenio de Cooperación Especial', 1),
('4', '10', '01', '01', 'Servicio de la deuda pública interna a corto plazo de títulos valores', 1),
('4', '10', '01', '02', 'Servicio de la deuda pública interna por préstamos a corto plazo', 1),
('4', '10', '01', '03', 'Servicio de la deuda pública interna indirecta por préstamos a corto plazo', 1),
('4', '10', '02', '01', 'Servicio de la deuda pública interna a largo plazo de títulos y valores', 1),
('4', '10', '02', '02', 'Servicio de la deuda pública interna por préstamos a largo plazo', 1),
('4', '10', '02', '03', 'Servicio de la deuda pública interna indirecta a largo plazo de títulos y valores', 1),
('4', '10', '02', '04', 'Servicio de la deuda pública interna indirecta por préstamos a largo plazo', 1),
('4', '10', '03', '01', 'Servicio de la deuda pública externa a corto plazo de títulos y valores', 1),
('4', '10', '03', '02', 'Servicio de la deuda pública externa por préstamos a corto plazo', 1),
('4', '10', '03', '03', 'Servicio de la deuda pública externa indirecta por préstamos a corto plazo', 1),
('4', '10', '04', '01', 'Servicio de la deuda pública externa a largo plazo de títulos y valores', 1),
('4', '10', '04', '02', 'Servicio de la deuda pública externa por préstamos a largo plazo', 1),
('4', '10', '04', '03', 'Servicio de la deuda pública externa indirecta a largo plazo de títulos y valores', 1),
('4', '10', '04', '04', 'Servicio de la deuda pública externa indirecta por préstamos a largo plazo', 1),
('4', '10', '05', '01', 'Disminución por reestructuración y/o refinanciamiento de la deuda interna a largo plazo, en a corto plazo', 1),
('4', '10', '05', '02', 'Disminución por reestructuración y/o refinanciamiento de la deuda interna a corto plazo, en a largo plazo', 1),
('4', '10', '05', '03', 'Disminución por reestructuración y/o refinanciamiento de la deuda externa a largo plazo, en a corto plazo', 1),
('4', '10', '05', '04', 'Disminución por reestructuración y/o refinanciamiento de la deuda externa a corto plazo, en a largo plazo', 1),
('4', '10', '05', '05', 'Disminución de la deuda pública por distribuir', 1),
('4', '10', '06', '01', 'Amortización de la deuda pública de obligaciones pendientes de ejercicios anteriores', 1),
('4', '10', '06', '02', 'Intereses de la deuda pública de obligaciones pendientes de ejercicios anteriores', 1),
('4', '10', '06', '03', 'Intereses por mora y multas de la deuda pública de obligaciones pendientes de ejercicios anteriores', 1),
('4', '10', '06', '04', 'Comisiones y otros gastos de la deuda pública de obligaciones pendientes de ejercicios anteriores', 1),
('4', '11', '01', '01', 'Disminución de sueldos, salarios y otras remuneraciones por pagar', 1),
('4', '11', '02', '01', 'Disminución de aportes patronales y retenciones laborales por pagar al Instituto Venezolano de los Seguros Sociales (IVSS)', 1),
('4', '11', '02', '02', 'Disminución de aportes patronales y retenciones laborales por pagar al Instituto de Previsión Social del Ministerio de Educación (Ipasme)', 1),
('4', '11', '02', '03', 'Disminución de aportes patronales y retenciones laborales por pagar al Fondo de Jubilaciones', 1),
('4', '11', '02', '04', 'Disminución de aportes patronales y retenciones laborales por pagar al Fondo de Seguro de Paro Forzoso', 1),
('4', '11', '02', '05', 'Disminución de aportes patronales y retenciones laborales por pagar al Fondo de Ahorro Obligatorio para la Vivienda (FAOV)', 1),
('4', '11', '02', '06', 'Disminución de aportes patronales y retenciones laborales por pagar al seguro de vida, accidentes personales, hospitalización, cirugía, maternidad (HCM) y gastos funerarios', 1),
('4', '11', '02', '07', 'Disminución de aportes patronales y retenciones laborales por pagar a cajas de ahorro', 1),
('4', '11', '02', '08', 'Disminución de aportes patronales por pagar a organismos de seguridad social', 1),
('4', '11', '02', '09', 'Disminución de retenciones laborales por pagar al Instituto Nacional de Capacitación y Educación Socialista (Inces)', 1),
('4', '11', '02', '10', 'Disminución de retenciones laborales por pagar por pensión alimenticia', 1),
('4', '11', '02', '98', 'Disminución de otros aportes legales por pagar', 1),
('4', '11', '02', '99', 'Disminución de otras retenciones laborales por pagar', 1),
('4', '11', '03', '01', 'Disminución de cuentas por pagar a proveedores a corto plazo', 1),
('4', '11', '03', '02', 'Disminución de efectos por pagar a proveedores a corto plazo', 1),
('4', '11', '03', '03', 'Disminución de cuentas por pagar a proveedores a mediano y largo plazo', 1),
('4', '11', '03', '04', 'Disminución de efectos por pagar a proveedores a mediano y largo plazo', 1),
('4', '11', '04', '01', 'Disminución de cuentas por pagar a contratistas a corto plazo', 1),
('4', '11', '04', '02', 'Disminución de efectos por pagar a contratistas a corto plazo', 1),
('4', '11', '04', '03', 'Disminución de cuentas por pagar a contratistas a mediano largo y plazo', 1),
('4', '11', '04', '04', 'Disminución de efectos por pagar a contratistas a mediano y plazo', 1),
('4', '11', '05', '01', 'Disminución de intereses internos por pagar', 1),
('4', '11', '05', '02', 'Disminución de intereses externos por pagar', 1),
('4', '11', '06', '01', 'Disminución de obligaciones de ejercicios anteriores', 1),
('4', '11', '06', '02', 'Disminución de otras cuentas por pagar a corto plazo', 1),
('4', '11', '06', '03', 'Disminución de otros efectos por pagar a corto plazo', 1),
('4', '11', '07', '01', 'Disminución de pasivos diferidos a corto plazo', 1),
('4', '11', '07', '02', 'Disminución de pasivos diferidos a mediano y largo plazo', 1),
('4', '11', '08', '01', 'Disminución de provisiones', 1),
('4', '11', '08', '02', 'Disminución de reservas técnicas', 1),
('4', '11', '09', '01', 'Disminución de depósitos recibidos en garantía', 1),
('4', '11', '09', '99', 'Disminución de otros fondos de terceros', 1),
('4', '11', '10', '01', 'Disminución de depósitos a la vista', 1),
('4', '11', '10', '02', 'Disminución de depósitos a plazo fijo', 1),
('4', '11', '11', '01', 'Devoluciones de cobros indebidos', 1),
('4', '11', '11', '02', 'Devoluciones y reintegros diversos', 1),
('4', '11', '11', '03', 'Indemnizaciones diversas', 1),
('4', '11', '11', '04', 'Compromisos pendientes de ejercicios anteriores', 1),
('4', '11', '11', '05', 'Prestaciones sociales originadas por la aplicación de la Ley Orgánica del Trabajo, los Trabajadores y las Trabajadoras', 1),
('4', '11', '98', '01', 'Disminución de otros pasivos a corto plazo', 1),
('4', '11', '99', '01', 'Disminución de otros pasivos a mediano y largo plazo', 1),
('4', '12', '01', '01', 'Disminución del capital fiscal e institucional', 1),
('4', '12', '01', '02', 'Disminución de aportes por capitalizar', 1),
('4', '12', '01', '03', 'Disminución de dividendos a distribuir', 1),
('4', '12', '02', '01', 'Disminución de reservas', 1),
('4', '12', '03', '01', 'Ajuste por inflación', 1),
('4', '12', '04', '01', 'Disminución de resultados acumulados', 1),
('4', '12', '04', '02', 'Disminución de resultados del ejercicio', 1),
('4', '98', '01', '01', 'Rectificaciones al presupuesto', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partida_generica`
--

CREATE TABLE `partida_generica` (
  `cuenta` char(1) NOT NULL,
  `partida` char(2) NOT NULL,
  `generica` char(2) NOT NULL,
  `nombre` text NOT NULL,
  `estatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `partida_generica`
--

INSERT INTO `partida_generica` (`cuenta`, `partida`, `generica`, `nombre`, `estatus`) VALUES
('3', '01', '01', 'Impuestos directos', 1),
('3', '01', '02', 'Impuestos indirectos', 1),
('3', '01', '03', 'Ingresos por tasas', 1),
('3', '01', '04', 'Ingresos por contribuciones especiales', 1),
('3', '01', '05', 'Ingresos por aportes y contribuciones a la seguridad social', 1),
('3', '01', '06', 'Ingresos del dominio petrolero', 1),
('3', '01', '07', 'Ingresos del dominio minero', 1),
('3', '01', '08', 'Ingresos del dominio forestal', 1),
('3', '01', '09', 'Ingresos por la venta de bienes y servicios de la administración pública', 1),
('3', '01', '10', 'Ingresos de la propiedad', 1),
('3', '01', '11', 'Diversos ingresos', 1),
('3', '01', '99', 'Otros ingresos ordinarios', 1),
('3', '02', '01', 'Endeudamiento público interno', 1),
('3', '02', '02', 'Endeudamiento público externo', 1),
('3', '02', '03', 'Ingresos por operaciones diversas', 1),
('3', '02', '04', 'Reintegro de fondos correspondientes a ejercicios anteriores', 1),
('3', '02', '05', 'Ingresos por obtención indebida de devoluciones o reintegros', 1),
('3', '02', '06', 'Impuesto a las transacciones financieras', 1),
('3', '02', '99', 'Otros ingresos extraordinarios', 1),
('3', '03', '01', 'Venta bruta de bienes', 1),
('3', '03', '02', 'Venta bruta de servicios', 1),
('3', '03', '03', 'Ingresos financieros de instituciones financieras bancarias', 1),
('3', '03', '04', 'Ingresos financieros de instituciones financieras no bancarias', 1),
('3', '03', '05', 'Ingresos por operaciones de seguro', 1),
('3', '03', '99', 'Otros ingresos de operación', 1),
('3', '04', '01', 'Subsidios para precios y tarifas', 1),
('3', '04', '02', 'Incentivos a la exportación', 1),
('3', '04', '99', 'Otros ingresos ajenos a la operación', 1),
('3', '05', '01', 'Transferencias y donaciones corrientes', 1),
('3', '05', '02', 'Transferencias y donaciones de capital', 1),
('3', '05', '03', 'Situado', 1),
('3', '05', '04', 'Subsidio de Régimen Especial', 1),
('3', '05', '05', 'Subsidio de Capitalidad', 1),
('3', '05', '06', 'Asignaciones Económicas Especiales (LAEE)', 1),
('3', '05', '07', 'Fondo Intergubernamental para la Descentralización (FIDES)', 1),
('3', '05', '08', 'Fondo de Compensación Interterritorial', 1),
('3', '05', '09', 'Aportes del Sector Público al Poder Estadal y al Poder Municipal por transferencia de servicios', 1),
('3', '05', '10', 'Transferencias y donaciones de Organismos del Sector Público a los Consejos Comunales', 1),
('3', '06', '01', 'Venta y/o desincorporación de activos fijos', 1),
('3', '06', '02', 'Venta de activos intangibles', 1),
('3', '06', '03', 'Incremento de la depreciación y amortización acumuladas', 1),
('3', '07', '01', 'Venta de títulos y valores de corto plazo', 1),
('3', '07', '02', 'Venta de títulos y valores de largo plazo', 1),
('3', '08', '01', 'Venta de acciones y participaciones de capital del sector privado', 1),
('3', '08', '02', 'Venta de acciones y participaciones de capital del sector público', 1),
('3', '08', '03', 'Venta de acciones y participaciones de capital del sector externo', 1),
('3', '09', '01', 'Recuperación de préstamos otorgados al sector privado de corto plazo', 1),
('3', '09', '02', 'Recuperación de préstamos otorgados al sector público de corto plazo', 1),
('3', '09', '03', 'Recuperación de préstamos otorgados al sector externo de corto plazo', 1),
('3', '10', '01', 'Recuperación de préstamos otorgados al sector privado de largo plazo', 1),
('3', '10', '02', 'Recuperación de préstamos otorgados al sector público de largo plazo', 1),
('3', '10', '03', 'Recuperación de préstamos otorgados al sector externo de largo plazo', 1),
('3', '11', '01', 'Disminución de disponibilidades', 1),
('3', '11', '02', 'Disminución de cuentas por cobrar a corto plazo', 1),
('3', '11', '03', 'Disminución de efectos por cobrar a corto plazo', 1),
('3', '11', '04', 'Disminución de cuentas por cobrar a mediano y largo plazo', 1),
('3', '11', '05', 'Disminución de efectos por cobrar a mediano y largo plazo', 1),
('3', '11', '06', 'Disminución de fondos en avance, anticipo y en fideicomiso', 1),
('3', '11', '07', 'Disminución de activos diferidos a corto plazo', 1),
('3', '11', '08', 'Disminución de activos diferidos a mediano y largo plazo', 1),
('3', '11', '09', 'Disminución del Fondo de Estabilización Macroeconómica (FEM)', 1),
('3', '11', '10', 'Disminución del Fondo de Ahorro Intergeneracional', 1),
('3', '11', '12', 'Disminución del Fondo de Aporte del Sector Público', 1),
('3', '11', '20', 'Disminución de activos en proceso judicial', 1),
('3', '11', '99', 'Disminución de otros activos financieros', 1),
('3', '12', '01', 'Incremento de gastos de personal por pagar', 1),
('3', '12', '02', 'Incremento de aportes patronales y retenciones laborales por pagar', 1),
('3', '12', '03', 'Incremento de cuentas y efectos por pagar a proveedores', 1),
('3', '12', '04', 'Incremento de cuentas y efectos por pagar a contratistas', 1),
('3', '12', '05', 'Incremento de intereses por pagar', 1),
('3', '12', '06', 'Incremento de otras cuentas y efectos por pagar', 1),
('3', '12', '07', 'Incremento de pasivos diferidos', 1),
('3', '12', '08', 'Incremento de provisiones y reservas técnicas', 1),
('3', '12', '09', 'Incremento de fondos de terceros', 1),
('3', '12', '10', 'Incremento de depósitos en instituciones financieras', 1),
('3', '12', '11', 'Reestructuración y/o refinanciamiento de la deuda pública', 1),
('3', '12', '99', 'Incremento de otros pasivos', 1),
('3', '13', '01', 'Incremento del capital', 1),
('3', '13', '02', 'Incremento de reservas', 1),
('3', '13', '03', 'Ajustes por inflación', 1),
('3', '13', '04', 'Incremento de resultados', 1),
('4', '01', '01', 'Sueldos, salarios y otras retribuciones', 1),
('4', '01', '02', 'Compensaciones previstas en las escalas de sueldos y salarios', 1),
('4', '01', '03', 'Primas', 1),
('4', '01', '04', 'Complementos de sueldos y salarios', 1),
('4', '01', '05', 'Aguinaldos, utilidades o bonificación legal, y bono vacacional', 1),
('4', '01', '06', 'Aportes patronales y legales', 1),
('4', '01', '07', 'Asistencia socio-económica', 1),
('4', '01', '08', 'Prestaciones sociales e indemnizaciones', 1),
('4', '01', '09', 'Capacitación y adiestramiento realizado por personal del organismo', 1),
('4', '01', '94', 'Otros gastos de los altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
('4', '01', '95', 'Otros gastos del personal de alto nivel y de dirección', 1),
('4', '01', '96', 'Otros gastos del personal empleado', 1),
('4', '01', '97', 'Otros gastos del personal obrero', 1),
('4', '01', '98', 'Otros gastos del personal militar', 1),
('4', '02', '01', 'Productos alimenticios y agropecuarios', 1),
('4', '02', '02', 'Productos de minas, canteras y yacimientos', 1),
('4', '02', '03', 'Textiles y vestuarios', 1),
('4', '02', '04', 'Productos de cuero y caucho', 1),
('4', '02', '05', 'Productos de papel, cartón e impresos', 1),
('4', '02', '06', 'Productos químicos y derivados', 1),
('4', '02', '07', 'Productos minerales no metálicos', 1),
('4', '02', '08', 'Productos metálicos', 1),
('4', '02', '09', 'Productos de madera', 1),
('4', '02', '10', 'Productos varios y útiles diversos', 1),
('4', '02', '11', 'Bienes para la venta', 1),
('4', '02', '99', 'Otros materiales y suministros', 1),
('4', '03', '01', 'Alquileres de inmuebles', 1),
('4', '03', '02', 'Alquileres de maquinaria y equipos', 1),
('4', '03', '03', 'Derechos sobre bienes intangibles', 1),
('4', '03', '04', 'Servicios básicos', 1),
('4', '03', '05', 'Servicio de administración, vigilancia y mantenimiento de los servicios básicos', 1),
('4', '03', '06', 'Servicios de transporte y almacenaje', 1),
('4', '03', '07', 'Servicios de información, impresión y relaciones públicas', 1),
('4', '03', '08', 'Primas y otros gastos de seguros y comisiones bancarias', 1),
('4', '03', '09', 'Viáticos y pasajes', 1),
('4', '03', '10', 'Servicios profesionales, técnicos y demás oficios y ocupaciones', 1),
('4', '03', '11', 'Conservación y reparaciones menores de maquinaria y equipos', 1),
('4', '03', '12', 'Conservación y reparaciones menores de obras', 1),
('4', '03', '13', 'Servicios de construcciones temporales', 1),
('4', '03', '14', 'Servicios de construcción de edificaciones para la venta', 1),
('4', '03', '15', 'Servicios fiscales', 1),
('4', '03', '16', 'Servicios de diversión, esparcimiento y culturales', 1),
('4', '03', '17', 'Servicios de gestión administrativa prestados por organismos de asistencia técnica', 1),
('4', '03', '18', 'Impuestos indirectos', 1),
('4', '03', '19', 'Comisiones por servicios para cumplir con los beneficios sociales', 1),
('4', '03', '99', 'Otros servicios no personales', 1),
('4', '04', '01', 'Repuestos, reparaciones, mejoras y adiciones mayores', 1),
('4', '04', '02', 'Conservación, ampliaciones y mejoras mayores de obras', 1),
('4', '04', '03', 'Maquinaria y demás equipos de construcción, campo, industria y taller', 1),
('4', '04', '04', 'Equipos de transporte, tracción y elevación', 1),
('4', '04', '05', 'Equipos de comunicaciones y de señalamiento', 1),
('4', '04', '06', 'Equipos médico - quirúrgicos, dentales y de veterinaria', 1),
('4', '04', '07', 'Equipos científicos, religiosos, de enseñanza y recreación', 1),
('4', '04', '08', 'Equipos y armamentos de orden público, seguridad y defensa', 1),
('4', '04', '09', 'Máquinas, muebles y demás equipos de oficina y alojamiento', 1),
('4', '04', '10', 'Semovientes', 1),
('4', '04', '11', 'Inmuebles, maquinaria y equipos usados', 1),
('4', '04', '12', 'Activos intangibles', 1),
('4', '04', '13', 'Estudios y proyectos para inversión en activos fijos', 1),
('4', '04', '14', 'Contratación de inspección de obras', 1),
('4', '04', '15', 'Construcciones del dominio privado', 1),
('4', '04', '16', 'Construcciones del dominio público', 1),
('4', '04', '99', 'Otros activos reales', 1),
('4', '05', '01', 'Aportes en acciones y participaciones de capital', 1),
('4', '05', '02', 'Adquisición de títulos y valores que no otorgan propiedad', 1),
('4', '05', '03', 'Concesión de préstamos a corto plazo', 1),
('4', '05', '04', 'Concesión de préstamos a largo plazo', 1),
('4', '05', '05', 'Incremento de disponibilidades', 1),
('4', '05', '06', 'Incremento de cuentas por cobrar a corto plazo', 1),
('4', '05', '07', 'Incremento de efectos por cobrar a corto plazo', 1),
('4', '05', '08', 'Incremento de cuentas por cobrar a mediano y largo plazo', 1),
('4', '05', '09', 'Incremento de efectos por cobrar a mediano y largo plazo', 1),
('4', '05', '10', 'Incremento de fondos en avance, en anticipos y en fideicomiso', 1),
('4', '05', '11', 'Incremento de activos diferidos a corto plazo', 1),
('4', '05', '12', 'Incremento de activos diferidos a mediano y largo plazo', 1),
('4', '05', '13', 'Incremento del Fondo de Estabilización Macroeconómica (FEM)', 1),
('4', '05', '14', 'Incremento del Fondo de Ahorro Intergeneracional', 1),
('4', '05', '16', 'Incremento del Fondo de Aportes del Sector Público', 1),
('4', '05', '20', 'Incremento de otros activos financieros circulantes', 1),
('4', '05', '21', 'Incremento de otros activos financieros no circulantes', 1),
('4', '05', '99', 'Otros activos financieros', 1),
('4', '06', '01', 'Gastos de defensa y seguridad del Estado', 1),
('4', '07', '01', 'Transferencias y donaciones corrientes internas', 1),
('4', '07', '02', 'Transferencias y donaciones corrientes al exterior', 1),
('4', '07', '05', 'Situado', 1),
('4', '07', '06', 'Subsidio de Régimen Especial', 1),
('4', '07', '07', 'Subsidio de capitalidad', 1),
('4', '07', '08', 'Asignaciones Económicas Especiales (LAEE)', 1),
('4', '07', '09', 'Aportes al Poder Estadal y al Poder Municipal por transferencia de servicios', 1),
('4', '07', '10', 'Fondo Intergubernamental para la Descentralización (FIDES)', 1),
('4', '07', '11', 'Fondo de Compensación Interterritorial', 1),
('4', '07', '12', 'Transferencias y donaciones a Consejos Comunales', 1),
('4', '08', '01', 'Depreciación y amortización', 1),
('4', '08', '02', 'Intereses por operaciones financieras', 1),
('4', '08', '03', 'Gastos por operaciones de seguro', 1),
('4', '08', '04', 'Pérdida en operaciones de los servicios básicos', 1),
('4', '08', '05', 'Obligaciones en el ejercicio vigente', 1),
('4', '08', '06', 'Pérdidas ajenas a la operación', 1),
('4', '08', '07', 'Descuentos, bonificaciones y devoluciones', 1),
('4', '08', '08', 'Indemnizaciones y sanciones pecuniarias', 1),
('4', '08', '99', 'Otros gastos', 1),
('4', '09', '01', 'Asignaciones no distribuidas de la Asamblea Nacional', 1),
('4', '09', '02', 'Asignaciones no distribuidas de la Contraloría General de la República', 1),
('4', '09', '03', 'Asignaciones no distribuidas del Consejo Nacional Electoral', 1),
('4', '09', '04', 'Asignaciones no distribuidas del Tribunal Supremo de Justicia', 1),
('4', '09', '05', 'Asignaciones no distribuidas del Ministerio Público', 1),
('4', '09', '06', 'Asignaciones no distribuidas de la Defensoría del Pueblo', 1),
('4', '09', '07', 'Asignaciones no distribuidas del Consejo Moral Republicano', 1),
('4', '09', '08', 'Reestructuración de organismos del sector público', 1),
('4', '09', '09', 'Fondo de apoyo al trabajador y su grupo familiar', 1),
('4', '09', '10', 'Reforma de la seguridad social', 1),
('4', '09', '11', 'Emergencias en el territorio nacional', 1),
('4', '09', '12', 'Fondo para la cancelación de pasivos laborales', 1),
('4', '09', '13', 'Fondo para la cancelación de deuda por servicios de electricidad, teléfono, aseo, agua y condominio', 1),
('4', '09', '14', 'Fondo para remuneraciones, pensiones y jubilaciones y otras retribuciones', 1),
('4', '09', '15', 'Fondo para atender compromisos generados de la Ley Orgánica del Trabajo, los Trabajadores y las Trabajadoras', 1),
('4', '09', '16', 'Asignaciones para cancelar compromisos pendientes de ejercicios anteriores', 1),
('4', '09', '17', 'Asignaciones para cancelar la deuda Fogade – Ministerio competente en Materia de Finanzas – Banco Central de Venezuela (BCV)', 1),
('4', '09', '18', 'Asignaciones para atender los gastos de la referenda y elecciones', 1),
('4', '09', '19', 'Asignaciones para atender los gastos por honorarios profesionales de bufetes internacionales, costas y costos judiciales', 1),
('4', '09', '20', 'Fondo para atender compromisos generados por la contratación colectiva', 1),
('4', '09', '21', 'Proyecto social especial', 1),
('4', '09', '22', 'Asignaciones para programas y proyectos financiados con recursos de organismos multilaterales y/o bilaterales', 1),
('4', '09', '23', 'Asignación para facilitar la preparación de proyectos', 1),
('4', '09', '24', 'Programas de inversión para las entidades estadales, municipalidades y otras instituciones', 1),
('4', '09', '25', 'Cancelación de compromisos', 1),
('4', '09', '26', 'Asignaciones para atender gastos de los organismos del sector público', 1),
('4', '09', '27', 'Convenio de Cooperación Especial', 1),
('4', '10', '01', 'Servicio de la deuda pública interna a corto plazo', 1),
('4', '10', '02', 'Servicio de la deuda pública interna a largo plazo', 1),
('4', '10', '03', 'Servicio de la deuda pública externa a corto plazo', 1),
('4', '10', '04', 'Servicio de la deuda pública externa a largo plazo', 1),
('4', '10', '05', 'Reestructuración y/o refinanciamiento de la deuda publica', 1),
('4', '10', '06', 'Servicio de la deuda pública por obligaciones de ejercicios anteriores', 1),
('4', '11', '01', 'Disminución de gastos de personal por pagar', 1),
('4', '11', '02', 'Disminución de aportes patronales y retenciones laborales por pagar', 1),
('4', '11', '03', 'Disminución de cuentas y efectos por pagar a proveedores', 1),
('4', '11', '04', 'Disminución de cuentas y efectos por pagar a contratistas', 1),
('4', '11', '05', 'Disminución de intereses por pagar', 1),
('4', '11', '06', 'Disminución de otras cuentas y efectos por pagar a corto plazo', 1),
('4', '11', '07', 'Disminución de pasivos diferidos', 1),
('4', '11', '08', 'Disminución de provisiones y reservas técnicas', 1),
('4', '11', '10', 'Disminución de depósitos de instituciones financieras', 1),
('4', '11', '11', 'Obligaciones de ejercicios anteriores', 1),
('4', '11', '98', 'Disminución de otros pasivos a corto plazo', 1),
('4', '12', '01', 'Disminución del capital', 1),
('4', '12', '02', 'Disminución de reservas', 1),
('4', '12', '03', 'Ajuste por inflación', 1),
('4', '12', '04', 'Disminución de resultados', 1),
('4', '98', '01', 'Rectificaciones al presupuesto', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partida_partida`
--

CREATE TABLE `partida_partida` (
  `cuenta` char(1) NOT NULL COMMENT 'ID Cuenta',
  `partida` char(2) NOT NULL,
  `nombre` text NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `partida_partida`
--

INSERT INTO `partida_partida` (`cuenta`, `partida`, `nombre`, `estatus`) VALUES
('3', '01', 'Ingresos ordinarios', 1),
('3', '02', 'Ingresos extraordinarios', 1),
('3', '03', 'Ingresos de operación', 1),
('3', '04', 'Ingresos ajenos a la operación', 1),
('3', '05', 'Transferencias y donaciones', 1),
('3', '06', 'Recursos propios de capital', 1),
('3', '07', 'Venta de títulos y valores que no otorgan propiedad', 1),
('3', '08', 'Venta de acciones y participaciones de capital', 1),
('3', '09', 'Recuperación de préstamos de corto plazo', 1),
('3', '10', 'Recuperación de préstamos de largo plazo', 1),
('3', '11', 'Disminución de otros activos financieros', 1),
('3', '12', 'Incremento de pasivos', 1),
('3', '13', 'Incremento del patrimonio', 1),
('4', '01', 'Gastos de personal', 1),
('4', '02', 'Materiales, suministros y mercancías', 1),
('4', '03', 'Servicios no personales', 1),
('4', '04', 'Activos reales', 1),
('4', '05', 'Activos financieros', 1),
('4', '06', 'Gastos de defensa y seguridad del estado', 1),
('4', '07', 'Transferencias y donaciones', 1),
('4', '08', 'Otros gastos', 1),
('4', '09', 'Asignaciones no distribuidas', 1),
('4', '10', 'Servicio de la deuda pública', 1),
('4', '11', 'Disminución de pasivos', 1),
('4', '12', 'Disminución del patrimonio', 1),
('4', '98', 'Rectificaciones al presupuesto', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partida_sub_especifica`
--

CREATE TABLE `partida_sub_especifica` (
  `cuenta` char(1) NOT NULL,
  `partida` char(2) NOT NULL,
  `generica` char(2) NOT NULL,
  `especifica` char(2) NOT NULL,
  `subespecifica` char(2) NOT NULL,
  `nombre` text NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `partida_sub_especifica`
--

INSERT INTO `partida_sub_especifica` (`cuenta`, `partida`, `generica`, `especifica`, `subespecifica`, `nombre`, `estatus`) VALUES
('3', '01', '01', '01', '00', 'Impuesto sobre la renta a personas jurídicas', 1),
('3', '01', '01', '02', '00', 'Impuesto sobre la renta a personas naturales', 1),
('3', '01', '01', '03', '00', 'Impuestos sobre sucesiones, donaciones y demás ramos conexos', 1),
('3', '01', '01', '04', '00', 'Reparos administrativos por impuesto sobre la renta a personas juridica', 1),
('3', '01', '01', '05', '00', 'Reparos administrativos por impuesto sobre la renta a personas naturales', 1),
('3', '01', '01', '06', '00', 'Reparos administrativos a impuesto sobre sucesiones, donaciones y demás ramos conexos', 1),
('3', '01', '02', '01', '00', 'Impuestos de importación', 1),
('3', '01', '02', '02', '00', 'Impuesto de exportación', 1),
('3', '01', '02', '03', '00', 'Impuesto sobre la producción, el consumo y transacciones financieras', 1),
('3', '01', '02', '04', '00', 'Impuestos a las actividades de juegos de envite o azar', 1),
('3', '01', '02', '05', '00', 'Inmuebles urbanos', 1),
('3', '01', '02', '06', '00', 'Participación en el impuesto a la propiedad rural', 1),
('3', '01', '02', '07', '00', 'Patente de industria y comercio', 1),
('3', '01', '02', '08', '00', 'Patente de vehículo', 1),
('3', '01', '02', '09', '00', 'Propaganda comercial', 1),
('3', '01', '02', '10', '00', 'Espectáculos públicos', 1),
('3', '01', '02', '11', '00', 'Apuestas lícitas', 1),
('3', '01', '02', '12', '00', 'Deudas morosas', 1),
('3', '01', '02', '99', '00', 'Otros impuestos indirectos', 1),
('3', '01', '03', '01', '00', 'Derechos de tránsito terrestre', 1),
('3', '01', '03', '02', '00', 'Derechos a examen', 1),
('3', '01', '03', '03', '00', 'Derechos de expedición, renovación y reválida de licencias', 1),
('3', '01', '03', '04', '00', 'Derechos de registro y traspaso', 1),
('3', '01', '03', '05', '00', 'Derechos de placas identificadoras', 1),
('3', '01', '03', '06', '00', 'Derechos por revisión anual', 1),
('3', '01', '03', '07', '00', 'Derechos por remoción o arrastre de vehículos', 1),
('3', '01', '03', '08', '00', 'Derechos por estacionamiento de vehículos', 1),
('3', '01', '03', '09', '00', 'Permiso para uso de rutas extraurbanas', 1),
('3', '01', '03', '10', '00', 'Copias de documentos', 1),
('3', '01', '03', '11', '00', 'Tasas para el uso de aeronaves y por licencias de personal aeronáutico', 1),
('3', '01', '03', '12', '00', 'Tasas aeroportuarias', 1),
('3', '01', '03', '13', '00', 'Tasas por uso de canales de navegación', 1),
('3', '01', '03', '14', '00', 'Patente de navegación', 1),
('3', '01', '03', '15', '00', 'Expedición de licencias de navegación', 1),
('3', '01', '03', '16', '00', 'Servicio de telecomunicaciones', 1),
('3', '01', '03', '17', '00', 'Permisos para estaciones privadas de radiocomunicaciones', 1),
('3', '01', '03', '18', '00', 'Derechos de pilotajes', 1),
('3', '01', '03', '19', '00', 'Habilitación de pilotaje', 1),
('3', '01', '03', '20', '00', 'Servicios de remolcadores', 1),
('3', '01', '03', '21', '00', 'Habilitación de remolcadores', 1),
('3', '01', '03', '22', '00', 'Habilitación de capitanías de puerto', 1),
('3', '01', '03', '23', '00', 'Otros servicios de capitanías de puerto', 1),
('3', '01', '03', '24', '00', 'Tasas de faros y boyas', 1),
('3', '01', '03', '25', '00', 'Servicios de aduana', 1),
('3', '01', '03', '26', '00', 'Habilitación de aduanas', 1),
('3', '01', '03', '27', '00', 'Derechos de almacenaje', 1),
('3', '01', '03', '28', '00', 'Corretaje de bultos postales', 1),
('3', '01', '03', '29', '00', 'Servicios de consulta sobre clasificación arancelaria, valoración aduanera y análisis de laboratorio', 1),
('3', '01', '03', '30', '00', 'Bandas de garantía, cápsulas y sellos', 1),
('3', '01', '03', '31', '00', 'Servicio de peaje', 1),
('3', '01', '03', '32', '00', 'Servicio de riego y drenaje', 1),
('3', '01', '03', '33', '00', 'Estampillas fiscales', 1),
('3', '01', '03', '34', '00', 'Papel sellado', 1),
('3', '01', '03', '35', '00', 'Derechos de traslado', 1),
('3', '01', '03', '36', '00', 'Servicios sanitarios marítimos', 1),
('3', '01', '03', '37', '00', 'Servicios hospitalarios', 1),
('3', '01', '03', '38', '00', 'Venta de copias de planos', 1),
('3', '01', '03', '39', '00', 'Derechos de contraste, verificación y estudios', 1),
('3', '01', '03', '40', '00', 'Patente de pesca de perlas', 1),
('3', '01', '03', '41', '00', 'Licencia de caza', 1),
('3', '01', '03', '42', '00', 'Derechos de cancillería', 1),
('3', '01', '03', '43', '00', 'Depósitos por el ingreso al país de extranjeros', 1),
('3', '01', '03', '44', '00', 'Registro sanitario', 1),
('3', '01', '03', '45', '00', 'Derechos de análisis de sustancias químicas', 1),
('3', '01', '03', '46', '00', 'Derechos consulares', 1),
('3', '01', '03', '47', '00', 'Matrícula para importar y exportar sustancias estupefacientes y psicotrópicas', 1),
('3', '01', '03', '48', '00', 'Permisos municipales', 1),
('3', '01', '03', '49', '00', 'Certificaciones y solvencias', 1),
('3', '01', '03', '50', '00', 'Servicio de energía eléctrica', 1),
('3', '01', '03', '51', '00', 'Servicio de distribución de agua', 1),
('3', '01', '03', '52', '00', 'Servicio de gas doméstico', 1),
('3', '01', '03', '53', '00', 'Mensura y deslinde', 1),
('3', '01', '03', '54', '00', 'Aseo domiciliario', 1),
('3', '01', '03', '55', '00', 'Matadero', 1),
('3', '01', '03', '56', '00', 'Mercado', 1),
('3', '01', '03', '57', '00', 'Cementerio', 1),
('3', '01', '03', '58', '00', 'Terminal de pasajeros', 1),
('3', '01', '03', '59', '00', 'Deudas morosas por tasas', 1),
('3', '01', '03', '99', '00', 'Otros tipos de tasas', 1),
('3', '01', '04', '01', '00', 'Sobre la plusvalía inmobiliaria', 1),
('3', '01', '04', '02', '00', 'Contribuciones por mejoras', 1),
('3', '01', '04', '99', '00', 'Otras contribuciones especiales', 1),
('3', '01', '05', '01', '00', 'Ingresos por aportes patronales a la seguridad social', 1),
('3', '01', '05', '02', '00', 'Contribuciones personales a la seguridad social', 1),
('3', '01', '06', '01', '00', 'Regalías', 1),
('3', '01', '06', '02', '00', 'Impuesto superficial de hidrocarburos', 1),
('3', '01', '06', '03', '00', 'Impuesto de extracción', 1),
('3', '01', '06', '04', '00', 'Impuesto de registro de exportación', 1),
('3', '01', '06', '05', '00', 'Participación por azufre', 1),
('3', '01', '06', '06', '00', 'Participación por coque', 1),
('3', '01', '06', '07', '00', 'Ventajas especiales petroleras', 1),
('3', '01', '06', '99', '00', 'Otros ingresos del dominio petrolero', 1),
('3', '01', '07', '01', '00', 'Superficial minero', 1),
('3', '01', '07', '02', '00', 'Impuesto de explotación', 1),
('3', '01', '07', '03', '00', 'Ventajas especiales mineras', 1),
('3', '01', '07', '04', '00', 'Regalía minera de oro', 1),
('3', '01', '08', '01', '00', 'Impuesto superficial', 1),
('3', '01', '08', '02', '00', 'Impuesto de explotación o aprovechamiento', 1),
('3', '01', '08', '03', '00', 'Permiso o autorización para la explotación o aprovechamiento de los productos forestales', 1),
('3', '01', '08', '04', '00', 'Autorización para deforestación', 1),
('3', '01', '08', '05', '00', 'Autorización para movilizar productos forestales', 1),
('3', '01', '08', '06', '00', 'Participación por la explotación en zonas de reserva forestal', 1),
('3', '01', '08', '07', '00', 'Ventajas especiales por recursos forestales', 1),
('3', '01', '09', '01', '00', 'Ingresos por la venta de bienes', 1),
('3', '01', '09', '02', '00', 'Ingresos por la venta de servicios', 1),
('3', '01', '09', '99', '00', 'Ingresos por la venta de otros bienes y servicios', 1),
('3', '01', '10', '01', '00', 'Intereses por préstamos concedidos al sector privado', 1),
('3', '01', '10', '03', '00', 'Intereses por préstamos concedidos al sector externo', 1),
('3', '01', '10', '04', '00', 'Intereses por depósitos en instituciones financieras', 1),
('3', '01', '10', '05', '00', 'Intereses de títulos y valores', 1),
('3', '01', '10', '06', '00', 'Utilidades de acciones y participaciones de capital', 1),
('3', '01', '10', '07', '00', 'Utilidades de explotación de juegos de azar', 1),
('3', '01', '10', '08', '00', 'Alquileres', 1),
('3', '01', '10', '09', '00', 'Derechos sobre bienes intangibles', 1),
('3', '01', '10', '10', '00', 'Concesiones de bienes y servicios', 1),
('3', '01', '11', '01', '00', 'Intereses moratorios', 1),
('3', '01', '11', '02', '00', 'Reparos fiscales', 1),
('3', '01', '11', '03', '00', 'Sanciones fiscales', 1),
('3', '01', '11', '04', '00', 'Juicios y costas procesales', 1),
('3', '01', '11', '05', '00', 'Beneficios en operaciones cambiarias', 1),
('3', '01', '11', '06', '00', 'Utilidad por venta de activos', 1),
('3', '01', '11', '07', '00', 'Intereses por financiamiento de deudas tributarias', 1),
('3', '01', '11', '08', '00', 'Multas y recargos', 1),
('3', '01', '11', '09', '00', 'Reparos administrativos al impuesto a los activos empresariales', 1),
('3', '01', '11', '10', '00', 'Diversos reparos administrativos', 1),
('3', '01', '11', '11', '00', 'Ingresos en tránsito', 1),
('3', '01', '11', '12', '00', 'Reparos administrativos por impuestos municipales', 1),
('3', '01', '99', '01', '00', 'Otros ingresos ordinarios', 1),
('3', '02', '01', '01', '00', 'Colocación de títulos y valores de deuda pública interna a corto plazo', 1),
('3', '02', '01', '02', '00', 'Obtención de préstamos internos a corto plazo', 1),
('3', '02', '01', '03', '00', 'Colocación de títulos y valores de la deuda pública interna a largo plazo', 1),
('3', '02', '01', '04', '00', 'Obtención de préstamos internos a largo plazo', 1),
('3', '02', '02', '01', '00', 'Colocación de títulos y valores de la deuda pública externa a corto plazo', 1),
('3', '02', '02', '02', '00', 'Obtención de préstamos externos a corto plazo', 1),
('3', '02', '02', '03', '00', 'Colocación de títulos y valores de la deuda pública externa a largo plazo', 1),
('3', '02', '02', '04', '00', 'Obtención de préstamos externos a largo plazo', 1),
('3', '02', '03', '01', '00', 'Liquidación de entes descentralizados', 1),
('3', '02', '03', '02', '00', 'Herencias vacantes y donaciones', 1),
('3', '02', '03', '03', '00', 'Prima en colocación de títulos y valores de la deuda pública', 1),
('3', '02', '03', '05', '00', 'Ingresos por procesos licitatorios', 1),
('3', '02', '04', '01', '00', 'Reintegro proveniente de bonos de exportación', 1),
('3', '02', '04', '02', '00', 'Reintegro de fondos efectuado por organismos públicos proveniente de bonos de exportación', 1),
('3', '02', '05', '01', '00', 'Ingresos por obtención indebida de devoluciones o reintegros', 1),
('3', '02', '06', '01', '00', 'Impuesto a las transacciones financieras', 1),
('3', '02', '06', '02', '00', 'Reparos administrativos al impuesto a las transacciones financieras', 1),
('3', '02', '06', '03', '00', 'Multas y recargos por el impuesto a las transacciones financieras', 1),
('3', '02', '99', '01', '00', 'Otros ingresos extraordinarios', 1),
('3', '03', '01', '01', '00', 'Venta de productos del sector industrial', 1),
('3', '03', '01', '02', '00', 'Venta de productos del sector comercial', 1),
('3', '03', '02', '01', '00', 'Venta bruta de servicios', 1),
('3', '03', '03', '01', '00', 'Ingresos por inversiones en valores', 1),
('3', '03', '03', '02', '00', 'Ingresos por cartera de créditos', 1),
('3', '03', '03', '03', '00', 'Ingresos provenientes de la administración de fideicomisos', 1),
('3', '03', '03', '99', '00', 'Otros ingresos financieros', 1),
('3', '03', '04', '01', '00', 'Ingresos por inversiones en valores', 1),
('3', '03', '04', '02', '00', 'Ingresos por cartera de créditos', 1),
('3', '03', '04', '03', '00', 'Ingresos provenientes de la administración de fideicomisos', 1),
('3', '03', '04', '99', '00', 'Otros ingresos financieros', 1),
('3', '03', '05', '01', '00', 'Ingresos por operaciones de primas de seguro', 1),
('3', '03', '05', '02', '00', 'Ingresos por operaciones de reaseguro', 1),
('3', '03', '05', '03', '00', 'Ingresos por salvamento de siniestros', 1),
('3', '03', '05', '99', '00', 'Otros ingresos por operaciones de seguro', 1),
('3', '03', '99', '01', '00', 'Otros ingresos de operación', 1),
('3', '04', '01', '01', '00', 'Subsidios para precios y tarifas', 1),
('3', '04', '02', '01', '00', 'Incentivos a la exportación', 1),
('3', '04', '99', '01', '00', 'Otros ingresos ajenos a la operación', 1),
('3', '05', '01', '01', '00', 'Transferencias corrientes internas del sector privado', 1),
('3', '05', '01', '02', '00', 'Donaciones corrientes internas del sector privado', 1),
('3', '05', '01', '03', '00', 'Transferencias corrientes internas del sector público', 1),
('3', '05', '01', '04', '00', 'Donaciones corrientes internas del sector público', 1),
('3', '05', '01', '05', '00', 'Transferencias corrientes del exterior', 1),
('3', '05', '01', '06', '00', 'Donaciones corrientes del exterior', 1),
('3', '05', '02', '01', '00', 'Transferencias de capital internas del sector privado', 1),
('3', '05', '02', '02', '00', 'Donaciones de capital internas del sector privado', 1),
('3', '05', '02', '03', '00', 'Transferencias de capital internas del sector público', 1),
('3', '05', '02', '04', '00', 'Donaciones de capital internas del sector público', 1),
('3', '05', '02', '05', '00', 'Transferencias de capital del exterior', 1),
('3', '05', '02', '06', '00', 'Donaciones de capital del exterior', 1),
('3', '05', '03', '01', '00', 'Situado Constitucional', 1),
('3', '05', '03', '02', '00', 'Situado Estadal a Municipal', 1),
('3', '05', '04', '01', '00', 'Subsidio de Régimen Especial', 1),
('3', '05', '05', '01', '00', 'Subsidio de Capitalidad', 1),
('3', '05', '06', '01', '00', 'Asignaciones Económicas Especiales (LAEE) Estadal', 1),
('3', '05', '06', '02', '00', 'Asignaciones Económicas Especiales (LAEE) Estadal a Municipal', 1),
('3', '05', '06', '03', '00', 'Asignaciones Económicas Especiales (LAEE) Municipal', 1),
('3', '05', '06', '04', '00', 'Asignaciones Económicas Especiales (LAEE) Fondo Nacional de los Consejos Comunales', 1),
('3', '05', '06', '05', '00', 'Asignaciones Económicas Especiales (LAEE) Apoyo al Fortalecimiento Institucional', 1),
('3', '05', '07', '01', '00', 'Fondo Intergubernamental para la Descentralización (FIDES)', 1),
('3', '05', '08', '01', '00', 'Fondo de Compensación Interterritorial Estadal', 1),
('3', '05', '08', '02', '00', 'Fondo de Compensación Interterritorial Municipal', 1),
('3', '05', '08', '03', '00', 'Fondo de Compensación Interterritorial Poder Popular', 1),
('3', '05', '08', '04', '00', 'Fondo de Compensación Interterritorial Fortalecimiento Institucional', 1),
('3', '05', '09', '01', '00', 'Aportes del Sector Público al Poder Estadal por transferencia de servicios', 1),
('3', '05', '09', '02', '00', 'Aportes del Sector Público al Poder Municipal por transferencia de servicios', 1),
('3', '05', '10', '01', '00', 'Transferencias y donaciones corrientes de Organismos del Sector Público a los Consejos Comunales', 1),
('3', '05', '10', '02', '00', 'Transferencias y donaciones de capital de Organismos del Sector Público a los Consejos Comunales', 1),
('3', '06', '01', '01', '00', 'Venta y/o desincorporación de tierras y terrenos', 1),
('3', '06', '01', '02', '00', 'Venta y/o desincorporación de edificios e instalaciones', 1),
('3', '06', '01', '03', '00', 'Venta y/o desincorporación de maquinarias, equipos y semovientes', 1),
('3', '06', '02', '01', '00', 'Venta de marcas de fábrica y patentes de invención', 1),
('3', '06', '02', '02', '00', 'Venta de derechos de autor', 1),
('3', '06', '02', '03', '00', 'Recuperación de gastos de organización', 1),
('3', '06', '02', '04', '00', 'Venta de paquetes y programas de computación', 1),
('3', '06', '02', '05', '00', 'Venta de estudios y proyectos', 1),
('3', '06', '02', '99', '00', 'Venta de otros activos intangibles', 1),
('3', '06', '03', '01', '00', 'Incremento de la depreciación acumulada', 1),
('3', '06', '03', '02', '00', 'Incremento de la amortización acumulada', 1),
('3', '07', '01', '01', '00', 'Venta de títulos y valores privados de corto plazo', 1),
('3', '07', '01', '02', '00', 'Venta de títulos y valores públicos de corto plazo', 1),
('3', '07', '01', '03', '00', 'Venta de títulos y valores externos de corto plazo', 1),
('3', '07', '02', '01', '00', 'Venta de títulos y valores privados de largo plazo', 1),
('3', '07', '02', '02', '00', 'Venta de títulos y valores públicos de largo plazo', 1),
('3', '07', '02', '03', '00', 'Venta de títulos y valores externos de largo plazo', 1),
('3', '08', '01', '01', '00', 'Venta de acciones y participaciones de capital del sector privado', 1),
('3', '08', '02', '01', '00', 'Venta de acciones y participaciones de capital de entes descentralizados sin fines empresariales', 1),
('3', '08', '02', '02', '00', 'Venta de acciones y participaciones de capital de instituciones de protección social', 1),
('3', '08', '02', '03', '00', 'Venta de acciones y participaciones de capital de entes descentralizados con fines empresariales petroleros', 1),
('3', '08', '02', '04', '00', 'Venta de acciones y participaciones de capital de entes descentralizados con fines empresariales no petroleros', 1),
('3', '08', '02', '05', '00', 'Venta de acciones y participaciones de capital de entes descentralizados financieros bancarios', 1),
('3', '08', '02', '06', '00', 'Venta de acciones y participaciones de capital de entes descentralizados financieros no bancarios', 1),
('3', '08', '03', '01', '00', 'Venta de acciones y participaciones de capital de organismos internacionales', 1),
('3', '08', '03', '99', '00', 'Venta de acciones y participaciones de capital de otros entes del sector externo', 1),
('3', '09', '01', '01', '00', 'Recuperación de préstamos otorgados al sector privado de corto plazo', 1),
('3', '09', '02', '01', '00', 'Recuperación de préstamos otorgados a la República de corto plazo', 1),
('3', '09', '02', '02', '00', 'Recuperación de préstamos otorgados a entes descentralizados sin fines empresariales de corto plazo', 1),
('3', '09', '02', '03', '00', 'Recuperación de préstamos otorgados a instituciones de protección social de corto plazo', 1),
('3', '09', '02', '04', '00', 'Recuperación de préstamos otorgados a entes descentralizados con fines empresariales petroleros de corto plazo', 1),
('3', '09', '02', '05', '00', 'Recuperación de préstamos otorgados a entes descentralizados con fines empresariales no petroleros de corto plazo', 1),
('3', '09', '02', '06', '00', 'Recuperación de préstamos otorgados a entes descentralizados financieros bancarios de corto plazo', 1),
('3', '09', '02', '07', '00', 'Recuperación de préstamos otorgados a entes descentralizados financieros no bancarios de corto plazo', 1),
('3', '09', '02', '08', '00', 'Recuperación de préstamos otorgados al Poder Estadal de corto plazo', 1),
('3', '09', '02', '09', '00', 'Recuperación de préstamos otorgados al Poder Municipal de corto plazo', 1),
('3', '09', '03', '01', '00', 'Recuperación de préstamos otorgados a instituciones sin fines de lucro de corto plazo', 1),
('3', '09', '03', '02', '00', 'Recuperación de préstamos otorgados a gobiernos extranjeros de corto plazo', 1),
('3', '09', '03', '03', '00', 'Recuperación de préstamos otorgados a los organismos internacionales de corto plazo', 1),
('3', '10', '01', '01', '00', 'Recuperación de préstamos otorgados al sector privado de largo plazo', 1),
('3', '10', '02', '01', '00', 'Recuperación de préstamos otorgados a la República de largo plazo', 1),
('3', '10', '02', '02', '00', 'Recuperación de préstamos otorgados a entes descentralizados sin fines empresariales de largo plazo', 1),
('3', '10', '02', '03', '00', 'Recuperación de préstamos otorgados a instituciones de protección social de largo plazo', 1),
('3', '10', '02', '04', '00', 'Recuperación de préstamos otorgados a entes descentralizados con fines empresariales petroleros de largo plazo', 1),
('3', '10', '02', '05', '00', 'Recuperación de préstamos otorgados a entes descentralizados con fines empresariales no petroleros de largo plazo', 1),
('3', '10', '02', '06', '00', 'Recuperación de préstamos otorgados a entes descentralizados financieros bancarios de largo plazo', 1),
('3', '10', '02', '07', '00', 'Recuperación de préstamos otorgados a entes descentralizados financieros no bancarios de largo plazo', 1),
('3', '10', '02', '08', '00', 'Recuperación de préstamos otorgados al Poder Estadal de largo plazo', 1),
('3', '10', '02', '09', '00', 'Recuperación de préstamos otorgados al Poder Municipal de largo plazo', 1),
('3', '10', '03', '01', '00', 'Recuperación de préstamos otorgados a instituciones sin fines de lucro de largo plazo', 1),
('3', '10', '03', '02', '00', 'Recuperación de préstamos otorgados a gobiernos extranjeros de largo plazo', 1),
('3', '10', '03', '03', '00', 'Recuperación de préstamos otorgados a organismos internacionales de largo plazo', 1),
('3', '11', '01', '01', '00', 'Disminución de caja', 1),
('3', '11', '01', '02', '00', 'Disminución de bancos', 1),
('3', '11', '01', '03', '00', 'Disminución de inversiones temporales', 1),
('3', '11', '02', '01', '00', 'Disminución de cuentas comerciales por cobrar a corto plazo', 1),
('3', '11', '02', '02', '00', 'Disminución de rentas por recaudar a corto plazo', 1),
('3', '11', '02', '03', '00', 'Disminución de deudas de cuentas por rendir a corto plazo', 1),
('3', '11', '02', '99', '00', 'Disminución de otras cuentas por cobrar a corto plazo', 1),
('3', '11', '03', '01', '00', 'Disminución de efectos comerciales por cobrar a corto plazo', 1),
('3', '11', '03', '99', '00', 'Disminución de otros efectos por cobrar a corto plazo', 1),
('3', '11', '04', '01', '00', 'Disminución de cuentas comerciales por cobrar a mediano y largo plazo', 1),
('3', '11', '04', '02', '00', 'Disminución de rentas por recaudar a mediano y largo plazo', 1),
('3', '11', '04', '99', '00', 'Disminución de otras cuentas por cobrar a mediano y largo plazo', 1),
('3', '11', '05', '01', '00', 'Disminución de efectos comerciales por cobrar a mediano y largo plazo', 1),
('3', '11', '05', '99', '00', 'Disminución de otros efectos por cobrar a mediano y largo plazo', 1),
('3', '11', '06', '01', '00', 'Disminución de fondos en avance', 1),
('3', '11', '06', '02', '00', 'Disminución de fondos en anticipo', 1),
('3', '11', '06', '03', '00', 'Disminución de fondos en fideicomiso', 1),
('3', '11', '06', '04', '00', 'Disminución de anticipos a proveedores', 1),
('3', '11', '06', '05', '00', 'Disminución de anticipos a contratistas, por contratos a corto plazo', 1),
('3', '11', '06', '06', '00', 'Disminución de anticipos a contratistas, por contratos a mediano y largo plazo', 1),
('3', '11', '07', '01', '00', 'Disminución de gastos a corto plazo pagados por anticipado', 1),
('3', '11', '07', '02', '00', 'Disminución de depósitos en garantía a corto plazo', 1),
('3', '11', '07', '99', '00', 'Disminución de otros activos diferidos a corto plazo', 1),
('3', '11', '08', '01', '00', 'Disminución de gastos a mediano y largo plazo pagados por anticipado', 1),
('3', '11', '08', '02', '00', 'Disminución de depósitos en garantía a mediano y largo plazo', 1),
('3', '11', '08', '99', '00', 'Disminución de otros activos diferidos a mediano y largo plazo', 1),
('3', '11', '09', '01', '00', 'Disminución del Fondo de Estabilización Macroeconómica (FEM) de la República', 1),
('3', '11', '09', '02', '00', 'Disminución del Fondo de Estabilización Macroeconómica (FEM) del Poder Estadal', 1),
('3', '11', '09', '03', '00', 'Disminución del Fondo de Estabilización Macroeconómica (FEM) del Poder Municipal', 1),
('3', '11', '10', '01', '00', 'Disminución del Fondo de Ahorro Intergeneracional', 1),
('3', '11', '12', '01', '00', 'Disminución del Fondo de Aporte del Sector Público', 1),
('3', '11', '20', '01', '00', 'Disminución de activos financieros en gestión judicial a mediano y largo plazo', 1),
('3', '11', '20', '02', '00', 'Disminución de títulos y otros valores de la deuda pública en litigio a largo plazo', 1),
('3', '11', '99', '01', '00', 'Disminución de otros activos financieros circulantes', 1),
('3', '11', '99', '02', '00', 'Disminución de otros activos financieros no circulantes', 1),
('3', '12', '01', '01', '00', 'Incremento de sueldos, salarios y otras remuneraciones por pagar', 1),
('3', '12', '02', '01', '00', 'Incremento de aportes patronales y retenciones laborales por pagar al Instituto Venezolano de los Seguros Sociales (IVSS)', 1),
('3', '12', '02', '02', '00', 'Incremento de aportes patronales y retenciones laborales por pagar al Instituto de Previsión Social del Ministerio de Educación (Ipasme)', 1),
('3', '12', '02', '03', '00', 'Incremento de aportes patronales y retenciones laborales por pagar al Fondo de Jubilaciones', 1),
('3', '12', '02', '04', '00', 'Incremento de aportes patronales y retenciones laborales por pagar al Fondo de Seguro de Paro Forzoso', 1),
('3', '12', '02', '05', '00', 'Incremento de aportes patronales y retenciones laborales por pagar al Fondo de Ahorro Obligatorio para la Vivienda (FAOV)', 1),
('3', '12', '02', '06', '00', 'Incremento de aportes patronales y retenciones laborales por pagar por seguro de vida, accidentes personales, hospitalización, cirugía y maternidad (HCM) y gastos funerarios', 1),
('3', '12', '02', '07', '00', 'Incremento de aportes patronales y retenciones laborales por pagar a cajas de ahorro', 1),
('3', '12', '02', '08', '00', 'Incremento de aportes patronales y retenciones laborales por pagar a los organismos de seguridad social', 1),
('3', '12', '02', '09', '00', 'Incremento de aportes patronales y retenciones laborales por pagar al Instituto Nacional de Capacitación y Educación Socialista (Inces)', 1),
('3', '12', '02', '10', '00', 'Incremento de aportes patronales y retenciones laborales por pagar por pensión alimenticia', 1),
('3', '12', '02', '99', '00', 'Incremento de otros aportes patronales y otras retenciones laborales por pagar', 1),
('3', '12', '03', '01', '00', 'Incremento de cuentas por pagar a proveedores a corto plazo', 1),
('3', '12', '03', '02', '00', 'Incremento de efectos por pagar a proveedores a corto plazo', 1),
('3', '12', '03', '03', '00', 'Incremento de cuentas por pagar a proveedores a mediano y largo plazo', 1),
('3', '12', '03', '04', '00', 'Incremento de efectos por pagar a proveedores a mediano y largo plazo', 1),
('3', '12', '04', '01', '00', 'Incremento de cuentas por pagar a contratistas a corto plazo', 1),
('3', '12', '04', '02', '00', 'Incremento de efectos por pagar a contratistas a corto plazo', 1),
('3', '12', '04', '03', '00', 'Incremento de cuentas por pagar a contratistas a mediano y largo plazo', 1),
('3', '12', '04', '04', '00', 'Incremento de efectos por pagar a contratistas a mediano y largo plazo', 1),
('3', '12', '05', '01', '00', 'Incremento de intereses internos por pagar', 1),
('3', '12', '05', '02', '00', 'Incremento de intereses externos por pagar', 1),
('3', '12', '06', '01', '00', 'Incremento de otras cuentas por pagar a corto plazo', 1),
('3', '12', '06', '02', '00', 'Incremento de otras obligaciones de ejercicios anteriores por pagar', 1),
('3', '12', '06', '03', '00', 'Incremento de otros efectos por pagar a corto plazo', 1),
('3', '12', '07', '01', '00', 'Incremento de pasivos diferidos a corto plazo', 1),
('3', '12', '07', '02', '00', 'Incremento de pasivos diferidos a mediano y largo plazo', 1),
('3', '12', '08', '01', '00', 'Incremento de provisiones', 1),
('3', '12', '08', '02', '00', 'Incremento de reservas técnicas', 1),
('3', '12', '09', '01', '00', 'Incremento de depósitos recibidos en garantía', 1),
('3', '12', '09', '99', '00', 'Incremento de otros fondos de terceros', 1),
('3', '12', '10', '01', '00', 'Incremento de depósitos a la vista', 1),
('3', '12', '10', '02', '00', 'Incremento de depósitos a plazo fijo', 1),
('3', '12', '11', '01', '00', 'Incremento por reestructuración y/o refinanciamiento de la deuda pública interna de largo plazo en corto plazo', 1),
('3', '12', '11', '02', '00', 'Incremento por reestructuración y/o refinanciamiento de la deuda pública interna de corto plazo en largo plazo', 1),
('3', '12', '11', '03', '00', 'Incremento por reestructuración y/o refinanciamiento de la deuda pública externa de largo plazo en corto plazo', 1),
('3', '12', '11', '04', '00', 'Incremento por reestructuración y/o refinanciamiento de la deuda pública externa de corto plazo en largo plazo', 1),
('3', '12', '11', '05', '00', 'Incremento de la deuda pública por distribuir', 1),
('3', '12', '99', '01', '00', 'Incremento de otros pasivos a corto plazo', 1),
('3', '12', '99', '02', '00', 'Incremento de otros pasivos a mediano y largo plazo', 1),
('3', '13', '01', '01', '00', 'Incremento del capital fiscal e institucional', 1),
('3', '13', '01', '02', '00', 'Incremento de aportes por capitalizar', 1),
('3', '13', '01', '03', '00', 'Incremento de dividendos a distribuir', 1),
('3', '13', '02', '01', '00', 'Incremento de reservas', 1),
('3', '13', '03', '01', '00', 'Ajustes por inflación', 1),
('3', '13', '04', '01', '00', 'Incremento de resultados acumulados', 1),
('3', '13', '04', '02', '00', 'Incremento de resultados del ejercicio', 1),
('4', '01', '01', '01', '00', 'Sueldos básicos personal fijo a tiempo completo', 1),
('4', '01', '01', '02', '00', 'Sueldos básicos personal fijo a tiempo parcial', 1),
('4', '01', '01', '03', '00', 'Suplencias a empleados', 1),
('4', '01', '01', '08', '00', 'Sueldo al personal en trámite de nombramiento', 1),
('4', '01', '01', '09', '00', 'Remuneraciones al personal en período de disponibilidad', 1),
('4', '01', '01', '10', '00', 'Salarios a obreros en puestos permanentes a tiempo completo', 1),
('4', '01', '01', '11', '00', 'Salarios a obreros en puestos permanentes a tiempo parcial', 1),
('4', '01', '01', '12', '00', 'Salarios a obreros en puestos no permanentes', 1),
('4', '01', '01', '13', '00', 'Suplencias a obreros', 1),
('4', '01', '01', '18', '00', 'Remuneraciones al personal contratado', 1),
('4', '01', '01', '19', '00', 'Retribuciones por becas - salarios, bolsas de trabajo, pasantías y similares', 1),
('4', '01', '01', '20', '00', 'Sueldo del personal militar profesional', 1),
('4', '01', '01', '21', '00', 'Sueldo o ración del personal militar no profesional', 1),
('4', '01', '01', '22', '00', 'Sueldo del personal militar de reserva', 1),
('4', '01', '01', '29', '00', 'Dietas', 1),
('4', '01', '01', '30', '00', 'Retribución al personal de reserva', 1),
('4', '01', '01', '35', '00', 'Sueldo básico de los altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
('4', '01', '01', '36', '00', 'Sueldo básico del personal de alto nivel y de dirección', 1),
('4', '01', '01', '37', '00', 'Dietas de los altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
('4', '01', '01', '38', '00', 'Dietas del personal de alto nivel y de dirección', 1),
('4', '01', '01', '99', '00', 'Otras retribuciones', 1),
('4', '01', '02', '01', '00', 'Compensaciones previstas en las escalas de sueldos al personal empleado fijo a tiempo completo', 1),
('4', '01', '02', '02', '00', 'Compensaciones previstas en las escalas de sueldos al personal empleado fijo a tiempo parcial', 1),
('4', '01', '02', '03', '00', 'Compensaciones previstas en las escalas de salarios al personal obrero fijo a tiempo completo', 1),
('4', '01', '02', '04', '00', 'Compensaciones previstas en las escalas de salarios al personal obrero fijo a tiempo parcial', 1),
('4', '01', '02', '05', '00', 'Compensaciones previstas en las escalas de sueldos al personal militar', 1),
('4', '01', '02', '06', '00', 'Compensaciones previstas en las escalas de sueldos de los altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
('4', '01', '02', '07', '00', 'Compensaciones previstas en las escalas de sueldos del personal de alto nivel y de dirección', 1),
('4', '01', '03', '01', '00', 'Primas por mérito a empleados', 1),
('4', '01', '03', '02', '00', 'Primas de transporte a empleados', 1),
('4', '01', '03', '03', '00', 'Primas por hogar a empleados', 1),
('4', '01', '03', '04', '00', 'Primas por hijos a empleados', 1),
('4', '01', '03', '05', '00', 'Primas por alquileres a empleados', 1),
('4', '01', '03', '06', '00', 'Primas por residencia a empleados', 1),
('4', '01', '03', '07', '00', 'Primas por categoría de escuelas a empleados', 1),
('4', '01', '03', '08', '00', 'Primas de profesionalización a empleados', 1),
('4', '01', '03', '09', '00', 'Primas por antigüedad a empleados', 1),
('4', '01', '03', '10', '00', 'Primas por jerarquía o responsabilidad en el cargo', 1),
('4', '01', '03', '11', '00', 'Primas al personal en servicio en el exterior', 1),
('4', '01', '03', '16', '00', 'Primas por mérito a obreros', 1),
('4', '01', '03', '17', '00', 'Primas de transporte a obreros', 1),
('4', '01', '03', '18', '00', 'Primas por hogar a obreros', 1),
('4', '01', '03', '19', '00', 'Primas por hijos de obreros', 1),
('4', '01', '03', '20', '00', 'Primas por residencia a obreros', 1),
('4', '01', '03', '21', '00', 'Primas por antigüedad a obreros', 1),
('4', '01', '03', '22', '00', 'Primas de profesionalización a obreros', 1),
('4', '01', '03', '26', '00', 'Primas por hijos al personal militar', 1),
('4', '01', '03', '27', '00', 'Primas de profesionalización al personal militar', 1),
('4', '01', '03', '28', '00', 'Primas por antigüedad al personal militar', 1),
('4', '01', '03', '29', '00', 'Primas por potencial de ascenso al personal militar', 1),
('4', '01', '03', '30', '00', 'Primas por frontera y sitios inhóspitos al personal militar y de seguridad', 1),
('4', '01', '03', '31', '00', 'Primas por riesgo al personal militar y de seguridad', 1),
('4', '01', '03', '37', '00', 'Primas de transporte al personal contratado', 1),
('4', '01', '03', '38', '00', 'Primas por hogar al personal contratado', 1),
('4', '01', '03', '39', '00', 'Primas por hijos al personal contratado', 1),
('4', '01', '03', '40', '00', 'Primas de profesionalización al personal contratado', 1),
('4', '01', '03', '41', '00', 'Primas por antigüedad al personal contratado', 1),
('4', '01', '03', '46', '00', 'Primas a los altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
('4', '01', '03', '47', '00', 'Primas al personal de alto nivel y de dirección', 1),
('4', '01', '03', '94', '00', 'Otras primas a los altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
('4', '01', '03', '95', '00', 'Otras primas al personal de alto nivel y de dirección', 1),
('4', '01', '03', '96', '00', 'Otras primas al personal contratado', 1),
('4', '01', '03', '97', '00', 'Otras primas a empleados', 1),
('4', '01', '03', '98', '00', 'Otras primas a obreros', 1),
('4', '01', '03', '99', '00', 'Otras primas al personal militar', 1),
('4', '01', '04', '01', '00', 'Complemento a empleados por horas extraordinarias o por sobre tiempo', 1),
('4', '01', '04', '02', '00', 'Complemento a empleados por trabajo nocturno', 1),
('4', '01', '04', '03', '00', 'Complemento a empleados por gastos de alimentación', 1),
('4', '01', '04', '04', '00', 'Complemento a empleados por gastos de transporte', 1),
('4', '01', '04', '05', '00', 'Complemento a empleados por gastos de representación', 1),
('4', '01', '04', '06', '00', 'Complemento a empleados por comisión de servicios', 1),
('4', '01', '04', '07', '00', 'Bonificación a empleados', 1),
('4', '01', '04', '08', '00', 'Bono compensatorio de alimentación a empleados', 1),
('4', '01', '04', '09', '00', 'Bono compensatorio de transporte a empleados', 1),
('4', '01', '04', '10', '00', 'Complemento a empleados por días feriados', 1),
('4', '01', '04', '14', '00', 'Complemento a obreros por horas extraordinarias o por sobre tiempo', 1),
('4', '01', '04', '15', '00', 'Complemento a obreros por trabajo o jornada nocturna', 1),
('4', '01', '04', '16', '00', 'Complemento a obreros por gastos de alimentación', 1),
('4', '01', '04', '17', '00', 'Complemento a obreros por gastos de transporte', 1),
('4', '01', '04', '18', '00', 'Bono compensatorio de alimentación a obreros', 1),
('4', '01', '04', '19', '00', 'Bono compensatorio de transporte a obreros', 1),
('4', '01', '04', '20', '00', 'Complemento a obreros por días feriados', 1),
('4', '01', '04', '24', '00', 'Complemento al personal contratado por horas extraordinarias o por sobre tiempo', 1),
('4', '01', '04', '25', '00', 'Complemento al personal contratado por gastos de alimentación', 1),
('4', '01', '04', '26', '00', 'Bono compensatorio de alimentación al personal contratado', 1),
('4', '01', '04', '27', '00', 'Bono compensatorio de transporte al personal contratado', 1),
('4', '01', '04', '28', '00', 'Complemento al personal contratado por días feriados', 1),
('4', '01', '04', '32', '00', 'Complemento al personal militar por gastos de alimentación', 1),
('4', '01', '04', '33', '00', 'Complemento al personal militar por gastos de transporte', 1),
('4', '01', '04', '34', '00', 'Complemento al personal militar en el exterior', 1),
('4', '01', '04', '35', '00', 'Bono compensatorio de alimentación al personal militar', 1),
('4', '01', '04', '43', '00', 'Complemento a altos funcionarios y altas funcionarias del poder público y de elección popular por gastos de representación', 1),
('4', '01', '04', '44', '00', 'Complemento a altos funcionarios y altas funcionarias del poder público y  de elección popular por comisión de servicios', 1),
('4', '01', '04', '45', '00', 'Bonificación a altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
('4', '01', '04', '46', '00', 'Bono compensatorio de alimentación a altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
('4', '01', '04', '47', '00', 'Bono compensatorio de transporte a altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
('4', '01', '04', '48', '00', 'Complemento al personal de alto nivel y de dirección por gastos de representación', 1),
('4', '01', '04', '49', '00', 'Complemento al personal de alto nivel y de dirección por comisión de servicios', 1),
('4', '01', '04', '50', '00', 'Bonificación al personal de alto nivel y de dirección', 1),
('4', '01', '04', '51', '00', 'Bono compensatorio de alimentación al personal de alto nivel y de dirección', 1),
('4', '01', '04', '52', '00', 'Bono compensatorio de transporte al personal de alto nivel y de dirección', 1),
('4', '01', '04', '94', '00', 'Otros complementos a altos funcionarios y altas funcionarias del sector público y de elección popular', 1),
('4', '01', '04', '95', '00', 'Otros complementos al personal de alto nivel y de dirección', 1),
('4', '01', '04', '96', '00', 'Otros complementos a empleados', 1),
('4', '01', '04', '97', '00', 'Otros complementos a obreros', 1),
('4', '01', '04', '98', '00', 'Otros complementos al personal contratado', 1),
('4', '01', '04', '99', '00', 'Otros complementos al personal militar', 1),
('4', '01', '05', '01', '00', 'Aguinaldos a empleados', 1),
('4', '01', '05', '02', '00', 'Utilidades legales y convencionales a empleados', 1),
('4', '01', '05', '03', '00', 'Bono vacacional a empleados', 1),
('4', '01', '05', '04', '00', 'Aguinaldos a obreros', 1),
('4', '01', '05', '05', '00', 'Utilidades legales y convencionales a obreros', 1),
('4', '01', '05', '06', '00', 'Bono vacacional a obreros', 1),
('4', '01', '05', '07', '00', 'Aguinaldos al personal contratado', 1),
('4', '01', '05', '08', '00', 'Bono vacacional al personal contratado', 1),
('4', '01', '05', '09', '00', 'Aguinaldos al personal militar', 1),
('4', '01', '05', '10', '00', 'Bono vacacional al personal militar', 1),
('4', '01', '05', '13', '00', 'Aguinaldos a altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
('4', '01', '05', '14', '00', 'Utilidades legales y convencionales a altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
('4', '01', '05', '15', '00', 'Bono vacacional a altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
('4', '01', '05', '16', '00', 'Aguinaldos al personal de alto nivel y de dirección', 1),
('4', '01', '05', '17', '00', 'Utilidades legales y convencionales al personal de alto nivel y de dirección', 1),
('4', '01', '05', '18', '00', 'Bono vacacional al personal de alto nivel y de dirección', 1),
('4', '01', '06', '01', '00', 'Aporte patronal al Instituto Venezolano de los Seguros Sociales (IVSS) por empleados', 1),
('4', '01', '06', '02', '00', 'Aporte patronal al Instituto de Previsión y Asistencia Social para el personal del Ministerio de Educación (Ipasme) por empleados', 1),
('4', '01', '06', '03', '00', 'Aporte patronal al Fondo de Jubilaciones por empleados', 1),
('4', '01', '06', '04', '00', 'Aporte patronal al Fondo de Seguro de Paro Forzoso por empleados', 1),
('4', '01', '06', '05', '00', 'Aporte patronal al Fondo de Ahorro Obligatorio para la Vivienda por empleados', 1),
('4', '01', '06', '10', '00', 'Aporte patronal al Instituto Venezolano de los Seguros Sociales (IVSS) por obreros', 1),
('4', '01', '06', '11', '00', 'Aporte patronal al Fondo de Jubilaciones por obreros', 1),
('4', '01', '06', '12', '00', 'Aporte patronal al Fondo de Seguro de Paro Forzoso por obreros', 1),
('4', '01', '06', '13', '00', 'Aporte patronal al Fondo de Ahorro Obligatorio para la Vivienda por obreros', 1),
('4', '01', '06', '18', '00', 'Aporte patronal a los organismos de seguridad social por los trabajadores locales empleados en las representaciones de Venezuela en el exterior', 1),
('4', '01', '06', '19', '00', 'Aporte patronal al Fondo de Ahorro Obligatorio para la Vivienda por personal militar', 1),
('4', '01', '06', '25', '00', 'Aporte legal al Instituto Venezolano de los Seguros Sociales (IVSS) por personal contratado', 1),
('4', '01', '06', '26', '00', 'Aporte patronal al Fondo de Ahorro Obligatorio para la Vivienda por personal contratado', 1),
('4', '01', '06', '27', '00', 'Aporte patronal al Fondo de Seguro de Paro Forzoso por personal contratado', 1),
('4', '01', '06', '31', '00', 'Aporte patronal al Instituto Venezolano de los Seguros Sociales (IVSS) por altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
('4', '01', '06', '32', '00', 'Aporte patronal al Instituto de Previsión y Asistencia Social para el personal del Ministerio de Educación (Ipasme) por empleados personal del Ministerio de Educación (Ipasme) por altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
('4', '01', '06', '33', '00', 'Aporte patronal al Fondo de Jubilaciones por altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
('4', '01', '06', '34', '00', 'Aporte patronal al Fondo de Ahorro Obligatorio para la Vivienda por altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
('4', '01', '06', '35', '00', 'Aporte patronal al Fondo de Seguro de Paro Forzoso por altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
('4', '01', '06', '39', '00', 'Aporte patronal al Instituto Venezolano de los Seguros Sociales (IVSS) por personal de alto nivel y de dirección', 1),
('4', '01', '06', '40', '00', 'Aporte patronal al Instituto de Previsión y Asistencia Social para el personal del Ministerio de Educación (Ipasme) por personal de alto nivel y de dirección', 1),
('4', '01', '06', '41', '00', 'Aporte patronal al Fondo de Jubilaciones por personal de alto nivel y de dirección', 1),
('4', '01', '06', '42', '00', 'Aporte patronal al Fondo de Ahorro Obligatorio para la Vivienda por personal de alto nivel y de dirección', 1),
('4', '01', '06', '43', '00', 'Aporte patronal al Fondo de Seguro de Paro Forzoso por personal de alto nivel y de dirección', 1),
('4', '01', '06', '93', '00', 'Otros aportes legales por altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
('4', '01', '06', '94', '00', 'Otros aportes legales por el personal de alto nivel y de dirección', 1),
('4', '01', '06', '95', '00', 'Otros aportes legales por personal contratado', 1),
('4', '01', '06', '96', '00', 'Otros aportes legales por empleados', 1),
('4', '01', '06', '97', '00', 'Otros aportes legales por obreros', 1),
('4', '01', '06', '98', '00', 'Otros aportes legales por personal militar', 1),
('4', '01', '07', '01', '00', 'Capacitación y adiestramiento a empleados', 1),
('4', '01', '07', '02', '00', 'Becas a empleados', 1),
('4', '01', '07', '03', '00', 'Ayudas por matrimonio a empleados', 1),
('4', '01', '07', '04', '00', 'Ayudas por nacimiento de hijos a empleados', 1),
('4', '01', '07', '05', '00', 'Ayudas por defunción a empleados', 1),
('4', '01', '07', '06', '00', 'Ayudas para medicinas, gastos médicos, odontológicos y de hospitalización a empleados', 1),
('4', '01', '07', '07', '00', 'Aporte patronal a cajas de ahorro por empleados', 1),
('4', '01', '07', '08', '00', 'Aporte patronal a los servicios de salud, accidentes personales y gastos funerarios por empleados', 1),
('4', '01', '07', '09', '00', 'Ayudas a empleados para adquisición de uniformes y útiles escolares de sus hijos', 1),
('4', '01', '07', '10', '00', 'Dotación de uniformes a empleados', 1),
('4', '01', '07', '11', '00', 'Aporte patronal para gastos de guarderías y preescolar para hijos de empleados', 1),
('4', '01', '07', '12', '00', 'Aportes para la adquisición de juguetes para los hijos del personal empleado', 1),
('4', '01', '07', '17', '00', 'Capacitación y adiestramiento a obreros', 1),
('4', '01', '07', '18', '00', 'Becas a obreros', 1),
('4', '01', '07', '19', '00', 'Ayudas por matrimonio de obreros', 1),
('4', '01', '07', '20', '00', 'Ayudas por nacimiento de hijos de obreros', 1),
('4', '01', '07', '21', '00', 'Ayudas por defunción a obreros', 1),
('4', '01', '07', '22', '00', 'Ayudas para medicinas, gastos médicos, odontológicos y de hospitalización a obreros', 1),
('4', '01', '07', '23', '00', 'Aporte patronal a cajas de ahorro por obreros', 1),
('4', '01', '07', '24', '00', 'Aporte patronal a los servicios de salud, accidentes personales y gastos funerarios por obreros', 1),
('4', '01', '07', '25', '00', 'Ayudas a obreros para adquisición de uniformes y útiles escolares de sus hijos', 1),
('4', '01', '07', '26', '00', 'Dotación de uniformes a obreros', 1),
('4', '01', '07', '27', '00', 'Aporte patronal para gastos de guarderías y preescolar para hijos de obreros', 1),
('4', '01', '07', '28', '00', 'Aportes para la adquisición de juguetes para los hijos del personal obrero', 1),
('4', '01', '07', '34', '00', 'Capacitación y adiestramiento al personal militar', 1),
('4', '01', '07', '35', '00', 'Becas al personal militar', 1),
('4', '01', '07', '36', '00', 'Ayudas por matrimonio al personal militar', 1),
('4', '01', '07', '37', '00', 'Ayudas por nacimiento de hijos al personal militar', 1),
('4', '01', '07', '38', '00', 'Ayudas por defunción al personal militar', 1),
('4', '01', '07', '39', '00', 'Ayudas para medicinas, gastos médicos, odontológicos y de hospitalización al personal militar', 1),
('4', '01', '07', '40', '00', 'Aporte patronal a caja de ahorro por personal militar', 1),
('4', '01', '07', '41', '00', 'Aporte patronal a los servicios de salud, accidentes personales y gastos funerarios personal militar', 1),
('4', '01', '07', '42', '00', 'Ayudas al personal militar para adquisición de uniformes y útiles escolares de sus hijos', 1),
('4', '01', '07', '43', '00', 'Aportes para la adquisición de juguetes para los hijos del personal militar', 1),
('4', '01', '07', '44', '00', 'Aporte patronal para gastos de guarderías y preescolar para hijos del personal militar', 1),
('4', '01', '07', '52', '00', 'Capacitación y adiestramiento a altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
('4', '01', '07', '53', '00', 'Ayudas por matrimonio a altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
('4', '01', '07', '54', '00', 'Ayudas por nacimiento de hijos altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
('4', '01', '07', '55', '00', 'Ayudas por defunción a altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
('4', '01', '07', '56', '00', 'Ayudas para medicinas, gastos médicos, odontológicos y de hospitalización a altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
('4', '01', '07', '57', '00', 'Aporte patronal a cajas de ahorro por altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
('4', '01', '07', '58', '00', 'Aporte patronal a los servicios de salud, accidentes personales y gastos funerarios por altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
('4', '01', '07', '63', '00', 'Capacitación y adiestramiento al personal de alto nivel y de dirección', 1),
('4', '01', '07', '64', '00', 'Ayudas por matrimonio al personal de alto nivel y de dirección ', 1),
('4', '01', '07', '65', '00', 'Ayudas por nacimiento de hijos al personal de alto nivel y de dirección', 1),
('4', '01', '07', '66', '00', 'Ayudas por defunción al personal de alto nivel y de dirección', 1),
('4', '01', '07', '67', '00', 'Ayudas para medicinas, gastos médicos, odontológicos y de hospitalización al personal de alto nivel y de dirección', 1),
('4', '01', '07', '68', '00', 'Aporte patronal a cajas de ahorro por personal de alto nivel y de dirección', 1),
('4', '01', '07', '69', '00', 'Aporte patronal a los servicios de salud, accidentes personales y gastos funerarios por personal de alto nivel y de dirección', 1),
('4', '01', '07', '74', '00', 'Capacitación y adiestramiento al personal contratado', 1),
('4', '01', '07', '75', '00', 'Becas al personal contratado', 1),
('4', '01', '07', '76', '00', 'Ayudas por matrimonio al personal contratado', 1),
('4', '01', '07', '77', '00', 'Ayudas por nacimiento de hijos al personal contratado', 1),
('4', '01', '07', '78', '00', 'Ayudas por defunción al personal contratado', 1),
('4', '01', '07', '79', '00', 'Ayudas para medicinas, gastos médicos, odontológicos y de hospitalización al personal contratado', 1),
('4', '01', '07', '80', '00', 'Aporte patronal a cajas de ahorro por personal contratado', 1),
('4', '01', '07', '81', '00', 'Aporte patronal a los servicios de salud, accidentes personales y gastos funerarios por personal contratado', 1),
('4', '01', '07', '82', '00', 'Ayudas al personal contratado para adquisición de uniformes y útiles escolares de sus hijos', 1),
('4', '01', '07', '83', '00', 'Dotación de uniformes al personal contratado', 1),
('4', '01', '07', '84', '00', 'Aporte patronal para gastos de guarderías y preescolar para hijos del personal contratado', 1),
('4', '01', '07', '85', '00', 'Aportes para la adquisición de juguetes para los hijos del personal contratado', 1),
('4', '01', '07', '94', '00', 'Otras subvenciones a altos funcionarios y altas funcionarias del poder público y de elección popular', 1);
INSERT INTO `partida_sub_especifica` (`cuenta`, `partida`, `generica`, `especifica`, `subespecifica`, `nombre`, `estatus`) VALUES
('4', '01', '07', '95', '00', 'Otras subvenciones al personal de alto nivel y de dirección', 1),
('4', '01', '07', '96', '00', 'Otras subvenciones a empleados', 1),
('4', '01', '07', '97', '00', 'Otras subvenciones a obreros', 1),
('4', '01', '07', '98', '00', 'Otras subvenciones al personal militar', 1),
('4', '01', '07', '99', '00', 'Otras subvenciones al personal contratado', 1),
('4', '01', '08', '01', '00', 'Prestaciones sociales e indemnizaciones a empleados', 1),
('4', '01', '08', '02', '00', 'Prestaciones sociales e indemnizaciones a obreros', 1),
('4', '01', '08', '03', '00', 'Prestaciones sociales e indemnizaciones al personal contratado', 1),
('4', '01', '08', '04', '00', 'Prestaciones sociales e indemnizaciones al personal militar', 1),
('4', '01', '08', '06', '00', 'Prestaciones sociales e indemnizaciones a altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
('4', '01', '08', '07', '00', 'Prestaciones sociales e indemnizaciones al personal de alto nivel y Prestaciones sociales e indemnizaciones al personal de alto nivel y de dirección', 1),
('4', '01', '09', '01', '00', 'Capacitación y adiestramiento realizado por personal del organismo', 1),
('4', '01', '94', '01', '00', 'Otros gastos de los altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
('4', '01', '95', '01', '00', 'Otros gastos del personal de alto nivel y de dirección', 1),
('4', '01', '96', '01', '00', 'Otros gastos del personal empleado', 1),
('4', '01', '97', '01', '00', 'Otros gastos del personal obrero', 1),
('4', '01', '98', '01', '00', 'Otros gastos del personal militar', 1),
('4', '02', '01', '01', '00', 'Alimentos y bebidas para personas', 1),
('4', '02', '01', '02', '00', 'Alimentos para animales', 1),
('4', '02', '01', '03', '00', 'Productos agrícolas y pecuarios', 1),
('4', '02', '01', '04', '00', 'Productos de la caza y pesca', 1),
('4', '02', '01', '99', '00', 'Otros productos alimenticios y agropecuarios', 1),
('4', '02', '02', '01', '00', 'Carbón mineral', 1),
('4', '02', '02', '02', '00', 'Petróleo crudo y gas natural', 1),
('4', '02', '02', '03', '00', 'Mineral de hierro', 1),
('4', '02', '02', '04', '00', 'Mineral no ferroso', 1),
('4', '02', '02', '05', '00', 'Piedra, arcilla, arena y tierra', 1),
('4', '02', '02', '06', '00', 'Mineral para la fabricación de productos químicos', 1),
('4', '02', '02', '07', '00', 'Sal para uso industrial', 1),
('4', '02', '02', '99', '00', 'Otros productos de minas, canteras y yacimientos', 1),
('4', '02', '03', '01', '00', 'Textiles', 1),
('4', '02', '03', '02', '00', 'Prendas de vestir', 1),
('4', '02', '03', '03', '00', 'Calzados', 1),
('4', '02', '03', '99', '00', 'Otros productos textiles y vestuarios', 1),
('4', '02', '04', '01', '00', 'Cueros y pieles', 1),
('4', '02', '04', '02', '00', 'Productos de cuero y sucedáneos del cuero', 1),
('4', '02', '04', '03', '00', 'Cauchos y tripas para vehículos', 1),
('4', '02', '04', '99', '00', 'Otros productos de cuero y caucho', 1),
('4', '02', '05', '01', '00', 'Pulpa de madera, papel y cartón', 1),
('4', '02', '05', '02', '00', 'Envases y cajas de papel y cartón', 1),
('4', '02', '05', '03', '00', 'Productos de papel y cartón para oficina', 1),
('4', '02', '05', '04', '00', 'Libros, revistas y periódicos', 1),
('4', '02', '05', '05', '00', 'Material de enseñanza', 1),
('4', '02', '05', '06', '00', 'Productos de papel y cartón para computación', 1),
('4', '02', '05', '07', '00', 'Productos de papel y cartón para la imprenta y reproducción', 1),
('4', '02', '05', '99', '00', 'Otros productos de pulpa, papel y cartón', 1),
('4', '02', '06', '01', '00', 'Sustancias químicas y de uso industrial', 1),
('4', '02', '06', '02', '00', 'Abonos, plaguicidas y otros', 1),
('4', '02', '06', '03', '00', 'Tintas, pinturas y colorantes', 1),
('4', '02', '06', '04', '00', 'Productos farmacéuticos y medicamentos', 1),
('4', '02', '06', '05', '00', 'Productos de tocador', 1),
('4', '02', '06', '06', '00', 'Combustibles y lubricantes', 1),
('4', '02', '06', '07', '00', 'Productos diversos derivados del petróleo y del carbón', 1),
('4', '02', '06', '08', '00', 'Productos plásticos', 1),
('4', '02', '06', '09', '00', 'Mezclas explosivas', 1),
('4', '02', '06', '99', '00', 'Otros productos de la industria química y conexos', 1),
('4', '02', '07', '01', '00', 'Productos de barro, loza y porcelana', 1),
('4', '02', '07', '02', '00', 'Vidrios y productos de vidrio', 1),
('4', '02', '07', '03', '00', 'Productos de arcilla para construcción', 1),
('4', '02', '07', '04', '00', 'Cemento, cal y yeso', 1),
('4', '02', '07', '99', '00', 'Otros productos minerales no metálicos', 1),
('4', '02', '08', '01', '00', 'Productos primarios de hierro y acero', 1),
('4', '02', '08', '02', '00', 'Productos de metales no ferrosos', 1),
('4', '02', '08', '03', '00', 'Herramientas menores, cuchillería y artículos generales de ferretería', 1),
('4', '02', '08', '04', '00', 'Productos metálicos estructurales', 1),
('4', '02', '08', '05', '00', 'Materiales de orden público, seguridad y defensa', 1),
('4', '02', '08', '07', '00', 'Material de señalamiento', 1),
('4', '02', '08', '08', '00', 'Material de educación', 1),
('4', '02', '08', '09', '00', 'Repuestos y accesorios para equipos de transporte', 1),
('4', '02', '08', '10', '00', 'Repuestos y accesorios para otros equipos', 1),
('4', '02', '08', '99', '00', 'Otros productos metálicos', 1),
('4', '02', '09', '01', '00', 'Productos primarios de madera', 1),
('4', '02', '09', '02', '00', 'Muebles y accesorios de madera para edificaciones', 1),
('4', '02', '09', '99', '00', 'Otros productos de madera', 1),
('4', '02', '10', '01', '00', 'Artículos de deporte, recreación y juguetes', 1),
('4', '02', '10', '02', '00', 'Materiales y útiles de limpieza y aseo', 1),
('4', '02', '10', '03', '00', 'Utensilios de cocina y comedor', 1),
('4', '02', '10', '04', '00', 'Útiles menores médico - quirúrgicos de laboratorio, dentales y de veterinaria', 1),
('4', '02', '10', '05', '00', 'Útiles de escritorio, oficina y materiales de instrucción', 1),
('4', '02', '10', '06', '00', 'Condecoraciones, ofrendas y similares', 1),
('4', '02', '10', '07', '00', 'Productos de seguridad en el trabajo', 1),
('4', '02', '10', '08', '00', 'Materiales para equipos de computación', 1),
('4', '02', '10', '09', '00', 'Especies timbradas y valores', 1),
('4', '02', '10', '10', '00', 'Útiles religiosos', 1),
('4', '02', '10', '11', '00', 'Materiales eléctricos', 1),
('4', '02', '10', '12', '00', 'Materiales para instalaciones sanitarias', 1),
('4', '02', '10', '13', '00', 'Materiales fotográficos', 1),
('4', '02', '10', '99', '00', 'Otros productos y útiles diversos', 1),
('4', '02', '11', '01', '00', 'Productos y artículos para la venta', 1),
('4', '02', '11', '02', '00', 'Maquinarias y equipos para la venta', 1),
('4', '02', '11', '03', '00', 'Inmuebles para la venta', 1),
('4', '02', '11', '04', '00', 'Tierras y terrenos para la venta', 1),
('4', '02', '11', '99', '00', 'Otros bienes para la venta', 1),
('4', '02', '99', '01', '00', 'Otros materiales y suministros', 1),
('4', '03', '01', '01', '00', 'Alquileres de edificios y locales', 1),
('4', '03', '01', '02', '00', 'Alquileres de edificios y locales', 1),
('4', '03', '01', '03', '00', 'Alquileres de tierras y terrenos', 1),
('4', '03', '02', '01', '00', 'Alquileres de maquinaria y demás equipos de construcción, campo, industria y taller', 1),
('4', '03', '02', '02', '00', 'Alquileres de equipos de transporte, tracción y elevación', 1),
('4', '03', '02', '03', '00', 'Alquileres de equipos de comunicaciones y de señalamiento', 1),
('4', '03', '02', '04', '00', 'Alquileres de equipos médico - quirúrgicos, dentales y de veterinaria', 1),
('4', '03', '02', '05', '00', 'Alquileres de equipos científicos, religiosos, de enseñanza y recreación', 1),
('4', '03', '02', '06', '00', 'Alquileres de máquinas, muebles y demás equipos de oficina y alojamiento', 1),
('4', '03', '02', '99', '00', 'Alquileres de otras maquinaria y equipos', 1),
('4', '03', '03', '01', '00', 'Marcas de fábrica y patentes de invención', 1),
('4', '03', '03', '02', '00', 'Derechos de autor', 1),
('4', '03', '03', '03', '00', 'Paquetes y programas de computación', 1),
('4', '03', '03', '04', '00', 'Concesión de bienes y servicios', 1),
('4', '03', '04', '01', '00', 'Electricidad', 1),
('4', '03', '04', '02', '00', 'Gas', 1),
('4', '03', '04', '03', '00', 'Agua', 1),
('4', '03', '04', '04', '00', 'Teléfonos', 1),
('4', '03', '04', '05', '00', 'Servicio de comunicaciones', 1),
('4', '03', '04', '06', '00', 'Servicio de aseo urbano y domiciliario', 1),
('4', '03', '04', '07', '00', 'Servicio de condominio', 1),
('4', '03', '05', '01', '00', 'Servicio de administración, vigilancia y mantenimiento del servicio de electricidad', 1),
('4', '03', '05', '02', '00', 'Servicio de administración, vigilancia y mantenimiento del servicio de gas', 1),
('4', '03', '05', '03', '00', 'Servicio de administración, vigilancia y mantenimiento del servicio de agua', 1),
('4', '03', '05', '04', '00', 'Servicio de administración, vigilancia y mantenimiento del servicio de teléfonos', 1),
('4', '03', '05', '05', '00', 'Servicio de administración, vigilancia y mantenimiento del servicio de comunicaciones', 1),
('4', '03', '05', '06', '00', 'Servicio de administración, vigilancia y mantenimiento del servicio de aseo urbano y domiciliario', 1),
('4', '03', '06', '01', '00', 'Fletes y embalajes', 1),
('4', '03', '06', '02', '00', 'Almacenaje', 1),
('4', '03', '06', '03', '00', 'Estacionamiento', 1),
('4', '03', '06', '04', '00', 'Peaje', 1),
('4', '03', '06', '05', '00', 'Servicios de protección en traslado de fondos y de mensajería', 1),
('4', '03', '07', '01', '00', 'Publicidad y propaganda', 1),
('4', '03', '07', '02', '00', 'Imprenta y reproducción', 1),
('4', '03', '07', '03', '00', 'Relaciones sociales', 1),
('4', '03', '07', '04', '00', 'Avisos', 1),
('4', '03', '08', '01', '00', 'Primas y gastos de seguros', 1),
('4', '03', '08', '02', '00', 'Comisiones y gastos bancarios', 1),
('4', '03', '08', '03', '00', 'Comisiones y gastos de adquisición de seguros', 1),
('4', '03', '09', '01', '00', 'Viáticos y pasajes dentro del país', 1),
('4', '03', '09', '02', '00', 'Viáticos y pasajes fuera del país', 1),
('4', '03', '09', '03', '00', 'Asignación por kilómetros recorridos', 1),
('4', '03', '10', '01', '00', 'Servicios jurídicos', 1),
('4', '03', '10', '02', '00', 'Servicios de contabilidad y auditoría', 1),
('4', '03', '10', '03', '00', 'Servicios de procesamiento de datos', 1),
('4', '03', '10', '04', '00', 'Servicios de ingeniería y arquitectónicos', 1),
('4', '03', '10', '05', '00', 'Servicios médicos, odontológicos y otros servicios de sanidad', 1),
('4', '03', '10', '06', '00', 'Servicios de veterinaria', 1),
('4', '03', '10', '07', '00', 'Servicios de capacitación y adiestramiento', 1),
('4', '03', '10', '08', '00', 'Servicios presupuestarios', 1),
('4', '03', '10', '09', '00', 'Servicios de lavandería y tintorería', 1),
('4', '03', '10', '10', '00', 'Servicios de vigilancia y seguridad', 1),
('4', '03', '10', '11', '00', 'Servicios para la elaboración y suministro de comida', 1),
('4', '03', '10', '99', '00', 'Otros servicios profesionales y técnicos', 1),
('4', '03', '11', '01', '00', 'Conservación y reparaciones menores de maquinaria y demás equipos de construcción, campo, industria y taller', 1),
('4', '03', '11', '02', '00', 'Conservación y reparaciones menores de equipos de transporte, tracción y elevación', 1),
('4', '03', '11', '03', '00', 'Conservación y reparaciones menores de equipos de comunicaciones y de señalamiento', 1),
('4', '03', '11', '04', '00', 'Conservación y reparaciones menores de equipos médicoquirúrgicos dentales y de veterinaria', 1),
('4', '03', '11', '05', '00', 'Conservación y reparaciones menores de equipos científicos, religiosos, de enseñanza y recreación', 1),
('4', '03', '11', '06', '00', 'Conservación y reparaciones menores de equipos y armamentos de orden público, seguridad y defensa nacional', 1),
('4', '03', '11', '07', '00', 'Conservación y reparaciones menores de máquinas, muebles y demás equipos de oficina y alojamiento', 1),
('4', '03', '11', '99', '00', 'Conservación y reparaciones menores de otras maquinaria y equipos', 1),
('4', '03', '12', '01', '00', 'Conservación y reparaciones menores de obras en bienes del dominio privado', 1),
('4', '03', '12', '02', '00', 'Conservación y reparaciones menores de obras en bienes del dominio público', 1),
('4', '03', '13', '01', '00', 'Servicios de construcciones temporales', 1),
('4', '03', '14', '01', '00', 'Servicios de construcción de edificaciones para la venta', 1),
('4', '03', '15', '01', '00', 'Derechos de importación y servicios aduaneros', 1),
('4', '03', '15', '02', '00', 'Tasas y otros derechos obligatorios', 1),
('4', '03', '15', '03', '00', 'Asignación a agentes de especies fiscales', 1),
('4', '03', '15', '99', '00', 'Otros servicios fiscales', 1),
('4', '03', '16', '01', '00', 'Servicios de diversión, esparcimiento y culturales', 1),
('4', '03', '17', '01', '00', 'Servicios de gestión administrativa prestados por organismos de asistencia técnica', 1),
('4', '03', '18', '01', '00', 'Impuesto al valor agregado', 1),
('4', '03', '18', '99', '00', 'Otros impuestos indirectos', 1),
('4', '03', '19', '01', '00', 'Comisiones por servicios para cumplir con los beneficios sociales', 1),
('4', '03', '99', '01', '00', 'Otros servicios no personales', 1),
('4', '04', '01', '01', '00', 'Repuestos mayores', 1),
('4', '04', '01', '02', '00', 'Reparaciones, mejoras y adiciones mayores de maquinaria y equipos', 1),
('4', '04', '02', '01', '00', 'Conservación, ampliaciones y mejoras mayores de obras en bienes del dominio privado', 1),
('4', '04', '02', '02', '00', 'Conservación, ampliaciones y mejoras mayores de obras en bienes del dominio público', 1),
('4', '04', '03', '01', '00', 'Maquinaria y demás equipos de construcción y mantenimiento', 1),
('4', '04', '03', '02', '00', 'Maquinaria y equipos para mantenimiento de automotores', 1),
('4', '04', '03', '03', '00', 'Maquinaria y equipos agrícolas y pecuarios', 1),
('4', '04', '03', '04', '00', 'Maquinaria y equipos de artes gráficas y reproducción', 1),
('4', '04', '03', '05', '00', 'Maquinaria y equipos industriales y de taller', 1),
('4', '04', '03', '06', '00', 'Maquinaria y equipos de energía', 1),
('4', '04', '03', '07', '00', 'Maquinaria y equipos de riego y acueductos', 1),
('4', '04', '03', '08', '00', 'Equipos de almacén', 1),
('4', '04', '03', '99', '00', 'Otra maquinaria y demás equipos de construcción, campo, industria y taller', 1),
('4', '04', '04', '01', '00', 'Vehículos automotores terrestres', 1),
('4', '04', '04', '02', '00', 'Equipos ferroviarios y de cables aéreos', 1),
('4', '04', '04', '03', '00', 'Equipos marítimos de transporte', 1),
('4', '04', '04', '04', '00', 'Equipos aéreos de transporte', 1),
('4', '04', '04', '05', '00', 'Vehículos de tracción no motorizados', 1),
('4', '04', '04', '06', '00', 'Equipos auxiliares de transporte', 1),
('4', '04', '04', '99', '00', 'Otros equipos de transporte, tracción y elevación', 1),
('4', '04', '05', '01', '00', 'Equipos de telecomunicaciones', 1),
('4', '04', '05', '02', '00', 'Equipos de señalamiento', 1),
('4', '04', '05', '03', '00', 'Equipos de control de tráfico aéreo', 1),
('4', '04', '05', '04', '00', 'Equipos de correo', 1),
('4', '04', '05', '99', '00', 'Otros equipos de comunicaciones y de señalamiento', 1),
('4', '04', '06', '01', '00', 'Equipos médico - quirúrgicos, dentales y de veterinaria', 1),
('4', '04', '06', '99', '00', 'Otros equipos médico - quirúrgicos, dentales y de veterinaria', 1),
('4', '04', '07', '01', '00', 'Equipos científicos y de laboratorio', 1),
('4', '04', '07', '02', '00', 'Equipos de enseñanza, deporte y recreación', 1),
('4', '04', '07', '03', '00', 'Obras de arte', 1),
('4', '04', '07', '04', '00', 'Libros, revistas y otros instrumentos de enseñanzas', 1),
('4', '04', '07', '05', '00', 'Equipos religiosos', 1),
('4', '04', '07', '06', '00', 'Instrumentos musicales y equipos de audio', 1),
('4', '04', '07', '99', '00', 'Otros equipos científicos, religiosos, de enseñanza y recreación', 1),
('4', '04', '08', '01', '00', 'Equipos y armamentos de orden público, seguridad y defensa nacional', 1),
('4', '04', '08', '02', '00', 'Equipos y armamentos de seguridad para la custodia y resguardo personal', 1),
('4', '04', '08', '99', '00', 'Otros equipos y armamentos de orden público, seguridad y defensa', 1),
('4', '04', '09', '01', '00', 'Mobiliario y equipos de oficina', 1),
('4', '04', '09', '02', '00', 'Equipos de computación', 1),
('4', '04', '09', '03', '00', 'Mobiliario y equipos de alojamiento', 1),
('4', '04', '09', '99', '00', 'Otras máquinas, muebles y demás equipos de oficina y alojamiento', 1),
('4', '04', '10', '01', '00', 'Semovientes', 1),
('4', '04', '11', '01', '00', 'Adquisición de tierras y terrenos', 1),
('4', '04', '11', '02', '00', 'Adquisición de edificios e instalaciones', 1),
('4', '04', '11', '03', '00', 'Expropiación de tierras y terrenos', 1),
('4', '04', '11', '04', '00', 'Expropiación de edificios e instalaciones', 1),
('4', '04', '11', '05', '00', 'Adquisición de maquinaria y equipos usados', 1),
('4', '04', '12', '01', '00', 'Marcas de fábrica y patentes de invención', 1),
('4', '04', '12', '02', '00', 'Derechos de autor', 1),
('4', '04', '12', '03', '00', 'Gastos de organización', 1),
('4', '04', '12', '04', '00', 'Paquetes y programas de computación', 1),
('4', '04', '12', '05', '00', 'Estudios y proyectos', 1),
('4', '04', '12', '99', '00', 'Otros activos intangibles', 1),
('4', '04', '13', '01', '00', 'Estudios y proyectos aplicables a bienes del dominio privado', 1),
('4', '04', '13', '02', '00', 'Estudios y proyectos aplicables a bienes del dominio público', 1),
('4', '04', '14', '01', '00', 'Contratación de inspección de obras de bienes del dominio privado', 1),
('4', '04', '14', '02', '00', 'Contratación de inspección de obras de bienes del dominio público', 1),
('4', '04', '15', '01', '00', 'Construcciones de edificaciones médico-asistenciales', 1),
('4', '04', '15', '02', '00', 'Construcciones de edificaciones militares y de seguridad', 1),
('4', '04', '15', '03', '00', 'Construcciones de edificaciones educativas, religiosas y recreativas', 1),
('4', '04', '15', '04', '00', 'Construcciones de edificaciones culturales y deportivas', 1),
('4', '04', '15', '05', '00', 'Construcciones de edificaciones para oficina', 1),
('4', '04', '15', '06', '00', 'Construcciones de edificaciones industriales', 1),
('4', '04', '15', '07', '00', 'Construcciones de edificaciones habitacionales', 1),
('4', '04', '15', '99', '00', 'Otras construcciones del dominio privado', 1),
('4', '04', '16', '01', '00', 'Construcción de vialidad', 1),
('4', '04', '16', '02', '00', 'Construcción de plazas, parques y similares', 1),
('4', '04', '16', '03', '00', 'Construcciones de instalaciones hidráulicas', 1),
('4', '04', '16', '04', '00', 'Construcciones de puertos y aeropuertos', 1),
('4', '04', '16', '99', '00', 'Otras construcciones del dominio público', 1),
('4', '04', '99', '01', '00', 'Otros activos reales', 1),
('4', '05', '01', '01', '00', 'Aportes en acciones y participaciones de capital al sector privado', 1),
('4', '05', '01', '02', '00', 'Aportes en acciones y participaciones de capital al sector público', 1),
('4', '05', '01', '03', '00', 'Aportes en acciones y participaciones de capital al sector externo', 1),
('4', '05', '02', '01', '00', 'Adquisición de títulos y valores a corto plazo', 1),
('4', '05', '02', '02', '00', 'Adquisición de títulos y valores a largo plazo', 1),
('4', '05', '03', '01', '00', 'Concesión de préstamos al sector público a corto plazo', 1),
('4', '05', '03', '02', '00', 'Concesión de préstamos al sector público a corto plazo', 1),
('4', '05', '03', '03', '00', 'Concesión de préstamos al sector externo a corto plazo', 1),
('4', '05', '04', '01', '00', 'Concesión de préstamos al sector privado a largo plazo', 1),
('4', '05', '04', '02', '00', 'Concesión de préstamos al sector público a largo plazo', 1),
('4', '05', '04', '03', '00', 'Concesión de préstamos al sector externo a largo plazo', 1),
('4', '05', '05', '01', '00', 'Incremento en caja', 1),
('4', '05', '05', '02', '00', 'Incremento en bancos', 1),
('4', '05', '05', '03', '00', 'Incremento de inversiones temporales', 1),
('4', '05', '06', '01', '00', 'Incremento de cuentas comerciales por cobrar a corto plazo', 1),
('4', '05', '06', '02', '00', 'Incremento de rentas por recaudar a corto plazo', 1),
('4', '05', '06', '03', '00', 'Incremento de deudas por rendir', 1),
('4', '05', '06', '99', '00', 'Incremento de otras cuentas por cobrar a corto plazo', 1),
('4', '05', '07', '01', '00', 'Incremento de efectos comerciales por cobrar a corto plazo', 1),
('4', '05', '07', '99', '00', 'Incremento de otros efectos por cobrar a corto plazo', 1),
('4', '05', '08', '01', '00', 'Incremento de cuentas comerciales por cobrar a mediano y largo plazo', 1),
('4', '05', '08', '02', '00', 'Incremento de rentas por recaudar a mediano y largo plazo', 1),
('4', '05', '08', '99', '00', 'Incremento de otras cuentas por cobrar a mediano y largo plazo', 1),
('4', '05', '09', '01', '00', 'Incremento de efectos comerciales por cobrar a mediano y largo plazo', 1),
('4', '05', '09', '99', '00', 'Incremento de otros efectos por cobrar a mediano y largo plazo', 1),
('4', '05', '10', '01', '00', 'Incremento de fondos en avance', 1),
('4', '05', '10', '02', '00', 'Incremento de fondos en anticipos', 1),
('4', '05', '10', '03', '00', 'Incremento de fondos en fideicomiso', 1),
('4', '05', '10', '04', '00', 'Incremento de anticipos a proveedores', 1),
('4', '05', '10', '05', '00', 'Incremento de anticipos a contratistas por contratos de corto plazo', 1),
('4', '05', '10', '06', '00', 'Incremento de anticipos a contratistas por contratos de mediano y largo plazo', 1),
('4', '05', '11', '01', '00', 'Incremento de gastos a corto plazo pagados por anticipado', 1),
('4', '05', '11', '02', '00', 'Incremento de depósitos otorgados en garantía a corto plazo', 1),
('4', '05', '11', '99', '00', 'Incremento de otros activos diferidos a corto plazo', 1),
('4', '05', '12', '01', '00', 'Incremento de gastos a mediano y largo plazo pagados por anticipado', 1),
('4', '05', '12', '02', '00', 'Incremento de depósitos otorgados en garantía a mediano y largo plazo', 1),
('4', '05', '12', '99', '00', 'Incremento de otros activos diferidos a mediano y largo plazo', 1),
('4', '05', '13', '01', '00', 'Incremento del Fondo de Estabilización Macroeconómica (FEM) de la República', 1),
('4', '05', '13', '02', '00', 'Incremento del Fondo de Estabilización Macroeconómica (FEM) del Poder Estadal', 1),
('4', '05', '13', '03', '00', 'Incremento del Fondo de Estabilización Macroeconómica (FEM) del Poder Municipal', 1),
('4', '05', '14', '01', '00', 'Incremento del Fondo de Ahorro Intergeneracional', 1),
('4', '05', '16', '01', '00', 'Incremento del Fondo de Aportes del Sector Público', 1),
('4', '05', '20', '01', '00', 'Incremento de otros activos financieros circulantes', 1),
('4', '05', '21', '01', '00', 'Incremento de activos en gestión judicial a mediano y largo plazo', 1),
('4', '05', '21', '02', '00', 'Incremento de títulos y otros valores de la deuda pública en litigio a largo plazo', 1),
('4', '05', '21', '99', '00', 'Incremento de otros activos financieros no circulantes', 1),
('4', '05', '99', '01', '00', 'Otros activos financieros', 1),
('4', '06', '01', '01', '00', 'Gastos de defensa y seguridad del Estado', 1),
('4', '07', '01', '01', '00', 'Transferencias corrientes internas al sector privado', 1),
('4', '07', '01', '02', '00', 'Donaciones corrientes internas al sector privado', 1),
('4', '07', '01', '03', '00', 'Transferencias corrientes internas al sector público', 1),
('4', '07', '01', '04', '00', 'Donaciones corrientes internas al sector público', 1),
('4', '07', '01', '05', '00', 'Pensiones de altos funcionarios y altas funcionarias del poder público y de elección popular, del personal de alto nivel y de dirección', 1),
('4', '07', '01', '06', '00', 'Jubilaciones de altos funcionarios y altas funcionarias del poder público y de elección popular, del personal de alto nivel y de dirección', 1),
('4', '07', '02', '01', '00', 'Transferencias corrientes al exterior', 1),
('4', '07', '02', '02', '00', 'Donaciones corrientes al exterior', 1),
('4', '07', '03', '01', '00', 'Transferencias de capital internas al sector privado', 1),
('4', '07', '03', '02', '00', 'Donaciones de capital internas al sector privado', 1),
('4', '07', '03', '03', '00', 'Transferencias de capital internas al sector público', 1),
('4', '07', '03', '04', '00', 'Donaciones de capital internas al sector público', 1),
('4', '07', '04', '01', '00', 'Transferencias de capital al exterior', 1),
('4', '07', '04', '02', '00', 'Donaciones de capital al exterior', 1),
('4', '07', '05', '01', '00', 'Situado Constitucional', 1),
('4', '07', '05', '02', '00', 'Situado Estadal a Municipal', 1),
('4', '07', '06', '01', '00', 'Subsidio de Régimen Especial', 1),
('4', '07', '07', '01', '00', 'Subsidio de capitalidad', 1),
('4', '07', '08', '01', '00', 'Asignaciones Económicas Especiales (LAEE) Estadal', 1),
('4', '07', '08', '02', '00', 'Asignaciones Económicas Especiales (LAEE) Estadal a Municipal', 1),
('4', '07', '08', '03', '00', 'Asignaciones Económicas Especiales (LAEE) Municipal', 1),
('4', '07', '08', '04', '00', 'Asignaciones Económicas Especiales (LAEE) Fondo Nacional de los Consejos Comunales', 1),
('4', '07', '08', '05', '00', 'Asignaciones Económicas Especiales (LAEE) Apoyo al Fortalecimiento Institucional', 1),
('4', '07', '09', '01', '00', 'Aportes al Poder Estadal por transferencia de servicios', 1),
('4', '07', '09', '02', '00', 'Aportes al Poder Municipal por transferencia de servicios', 1),
('4', '07', '10', '01', '00', 'Fondo Intergubernamental para la Descentralización (FIDES)', 1),
('4', '07', '11', '01', '00', 'Fondo de Compensación Interterritorial Estadal', 1),
('4', '07', '11', '02', '00', 'Fondo de Compensación Interterritorial Municipal', 1),
('4', '07', '11', '03', '00', 'Fondo de Compensación Interterritorial Poder Popular', 1),
('4', '07', '11', '04', '00', 'Fondo de Compensación Interterritorial Fortalecimiento Institucional', 1),
('4', '07', '12', '01', '00', 'Transferencias y donaciones corrientes a Consejos Comunales', 1),
('4', '07', '12', '02', '00', 'Transferencias y donaciones de capital a Consejos Comunales', 1),
('4', '08', '01', '01', '00', 'Depreciación', 1),
('4', '08', '01', '02', '00', 'Amortización', 1),
('4', '08', '02', '01', '00', 'Intereses por depósitos internos', 1),
('4', '08', '02', '02', '00', 'Intereses por títulos y valores', 1),
('4', '08', '02', '03', '00', 'Intereses por otros financiamientos', 1),
('4', '08', '03', '01', '00', 'Gastos de siniestros', 1),
('4', '08', '03', '02', '00', 'Gastos de operaciones de reaseguros', 1),
('4', '08', '03', '99', '00', 'Otros gastos de operaciones de seguro', 1),
('4', '08', '04', '01', '00', 'Pérdidas en el proceso de distribución de los servicios', 1),
('4', '08', '04', '99', '00', 'Otras pérdidas en operación', 1),
('4', '08', '05', '01', '00', 'Devoluciones de cobros indebidos', 1),
('4', '08', '05', '02', '00', 'Devoluciones y reintegros diversos', 1),
('4', '08', '05', '03', '00', 'Indemnizaciones diversas', 1),
('4', '08', '06', '01', '00', 'Pérdidas en inventarios', 1),
('4', '08', '06', '02', '00', 'Pérdidas en operaciones cambiarias', 1),
('4', '08', '06', '03', '00', 'Pérdidas en ventas de activos', 1),
('4', '08', '06', '04', '00', 'Pérdidas por cuentas incobrables', 1),
('4', '08', '06', '05', '00', 'Participación en pérdidas de otras empresas', 1),
('4', '08', '06', '06', '00', 'Pérdidas por auto-seguro', 1),
('4', '08', '06', '07', '00', 'Impuestos directos', 1),
('4', '08', '06', '08', '00', 'Intereses de mora', 1),
('4', '08', '06', '09', '00', 'Reservas técnicas', 1),
('4', '08', '07', '01', '00', 'Descuentos sobre ventas', 1),
('4', '08', '07', '02', '00', 'Bonificaciones por ventas', 1),
('4', '08', '07', '03', '00', 'Devoluciones por ventas', 1),
('4', '08', '07', '04', '00', 'Devoluciones por primas de seguro', 1),
('4', '08', '08', '01', '00', 'Indemnizaciones por daños y perjuicios', 1),
('4', '08', '08', '02', '00', 'Sanciones pecuniarias', 1),
('4', '08', '99', '01', '00', 'Otros gastos', 1),
('4', '09', '01', '01', '00', 'Asignaciones no distribuidas de la Asamblea Nacional', 1),
('4', '09', '02', '01', '00', 'Asignaciones no distribuidas de la Contraloría General de la República', 1),
('4', '09', '03', '01', '00', 'Asignaciones no distribuidas del Consejo Nacional Electoral', 1),
('4', '09', '04', '01', '00', 'Asignaciones no distribuidas del Tribunal Supremo de Justicia', 1),
('4', '09', '05', '01', '00', 'Asignaciones no distribuidas del Ministerio Público', 1),
('4', '09', '06', '01', '00', 'Asignaciones no distribuidas de la Defensoría del Pueblo', 1),
('4', '09', '07', '01', '00', 'Asignaciones no distribuidas del Consejo Moral Republicano', 1),
('4', '09', '08', '01', '00', 'Reestructuración de organismos del sector público', 1),
('4', '09', '09', '01', '00', 'Fondo de apoyo al trabajador y su grupo familiar de la Administración Pública Nacional', 1),
('4', '09', '09', '02', '00', 'Fondo de apoyo al trabajador y su grupo familiar de las Entidades Federales, los Municipios y otras formas de gobierno municipal', 1),
('4', '09', '10', '01', '00', 'Reforma de la seguridad social', 1),
('4', '09', '11', '01', '00', 'Emergencias en el territorio nacional', 1),
('4', '09', '12', '01', '00', 'Fondo para la cancelación de pasivos laborales', 1),
('4', '09', '13', '01', '00', 'Fondo para la cancelación de deuda por servicios de electricidad teléfono, aseo, agua y condominio, de los organismos de la Administración Central', 1),
('4', '09', '13', '02', '00', 'Fondo para la cancelación de deuda por servicios de electricidad teléfono, aseo, agua y condominio, de los organismos de la  Administración Descentralizada Nacional', 1),
('4', '09', '14', '01', '00', 'Fondo para remuneraciones, pensiones y jubilaciones y otras retribuciones', 1),
('4', '09', '15', '01', '00', 'Fondo para atender compromisos generados de la Ley Orgánica del Trabajo, los Trabajadores y las Trabajadoras', 1),
('4', '09', '16', '01', '00', 'Asignaciones para cancelar compromisos pendientes de ejercicios anteriores', 1),
('4', '09', '17', '01', '00', 'Asignaciones para cancelar la deuda Fogade – Ministerio competente en Materia de Finanzas – Banco Central de Venezuela (BCV)', 1),
('4', '09', '18', '01', '00', 'Asignaciones para atender los gastos de la referenda y elecciones', 1),
('4', '09', '19', '01', '00', 'Asignaciones para atender los gastos por honorarios profesionales de bufetes internacionales, costas y costos judiciales', 1),
('4', '09', '20', '01', '00', 'Fondo para atender compromisos generados por la contratación colectiva', 1),
('4', '09', '21', '01', '00', 'Proyecto social especial', 1),
('4', '09', '22', '01', '00', 'Asignaciones para programas y proyectos financiados con recursos de organismos multilaterales y/o bilaterales', 1),
('4', '09', '23', '01', '00', 'Asignación para facilitar la preparación de proyectos', 1),
('4', '09', '24', '01', '00', 'Programas de inversión para las entidades estadales municipalidades y otras instituciones', 1),
('4', '09', '25', '01', '00', 'Cancelación de compromisos', 1),
('4', '09', '26', '01', '00', 'Asignaciones para atender gastos de los organismos del sector público', 1),
('4', '09', '27', '01', '00', 'Convenio de Cooperación Especial', 1),
('4', '10', '01', '01', '00', 'Servicio de la deuda pública interna a corto plazo de títulos valores', 1),
('4', '10', '01', '02', '00', 'Servicio de la deuda pública interna por préstamos a corto plazo', 1),
('4', '10', '01', '03', '00', 'Servicio de la deuda pública interna indirecta por préstamos a corto plazo', 1),
('4', '10', '02', '01', '00', 'Servicio de la deuda pública interna a largo plazo de títulos y valores', 1),
('4', '10', '02', '02', '00', 'Servicio de la deuda pública interna por préstamos a largo plazo', 1),
('4', '10', '02', '03', '00', 'Servicio de la deuda pública interna indirecta a largo plazo de títulos y valores', 1),
('4', '10', '02', '04', '00', 'Servicio de la deuda pública interna indirecta por préstamos a largo plazo', 1),
('4', '10', '03', '01', '00', 'Servicio de la deuda pública externa a corto plazo de títulos y valores', 1),
('4', '10', '03', '02', '00', 'Servicio de la deuda pública externa por préstamos a corto plazo', 1),
('4', '10', '03', '03', '00', 'Servicio de la deuda pública externa indirecta por préstamos a corto plazo', 1),
('4', '10', '04', '01', '00', 'Servicio de la deuda pública externa a largo plazo de títulos y valores', 1),
('4', '10', '04', '02', '00', 'Servicio de la deuda pública externa por préstamos a largo plazo', 1),
('4', '10', '04', '03', '00', 'Servicio de la deuda pública externa indirecta a largo plazo de títulos y valores', 1),
('4', '10', '04', '04', '00', 'Servicio de la deuda pública externa indirecta por préstamos a largo plazo', 1),
('4', '10', '05', '01', '00', 'Disminución por reestructuración y/o refinanciamiento de la deuda interna a largo plazo, en a corto plazo', 1),
('4', '10', '05', '02', '00', 'Disminución por reestructuración y/o refinanciamiento de la deuda interna a corto plazo, en a largo plazo', 1),
('4', '10', '05', '03', '00', 'Disminución por reestructuración y/o refinanciamiento de la deuda externa a largo plazo, en a corto plazo', 1),
('4', '10', '05', '04', '00', 'Disminución por reestructuración y/o refinanciamiento de la deuda externa a corto plazo, en a largo plazo', 1),
('4', '10', '05', '05', '00', 'Disminución de la deuda pública por distribuir', 1),
('4', '10', '06', '01', '00', 'Amortización de la deuda pública de obligaciones pendientes de ejercicios anteriores', 1),
('4', '10', '06', '02', '00', 'Intereses de la deuda pública de obligaciones pendientes de ejercicios anteriores', 1),
('4', '10', '06', '03', '00', 'Intereses por mora y multas de la deuda pública de obligaciones pendientes de ejercicios anteriores', 1),
('4', '10', '06', '04', '00', 'Comisiones y otros gastos de la deuda pública de obligaciones pendientes de ejercicios anteriores', 1),
('4', '11', '01', '01', '00', 'Disminución de sueldos, salarios y otras remuneraciones por pagar', 1),
('4', '11', '02', '01', '00', 'Disminución de aportes patronales y retenciones laborales por pagar al Instituto Venezolano de los Seguros Sociales (IVSS)', 1),
('4', '11', '02', '02', '00', 'Disminución de aportes patronales y retenciones laborales por pagar al Instituto de Previsión Social del Ministerio de Educación (Ipasme)', 1),
('4', '11', '02', '03', '00', 'Disminución de aportes patronales y retenciones laborales por pagar al Fondo de Jubilaciones', 1),
('4', '11', '02', '04', '00', 'Disminución de aportes patronales y retenciones laborales por pagar al Fondo de Seguro de Paro Forzoso', 1),
('4', '11', '02', '05', '00', 'Disminución de aportes patronales y retenciones laborales por pagar al Fondo de Ahorro Obligatorio para la Vivienda (FAOV)', 1),
('4', '11', '02', '06', '00', 'Disminución de aportes patronales y retenciones laborales por pagar al seguro de vida, accidentes personales, hospitalización, cirugía, maternidad (HCM) y gastos funerarios', 1),
('4', '11', '02', '07', '00', 'Disminución de aportes patronales y retenciones laborales por pagar a cajas de ahorro', 1),
('4', '11', '02', '08', '00', 'Disminución de aportes patronales por pagar a organismos de seguridad social', 1),
('4', '11', '02', '09', '00', 'Disminución de retenciones laborales por pagar al Instituto Nacional de Capacitación y Educación Socialista (Inces)', 1),
('4', '11', '02', '10', '00', 'Disminución de retenciones laborales por pagar por pensión alimenticia', 1),
('4', '11', '02', '98', '00', 'Disminución de otros aportes legales por pagar', 1),
('4', '11', '02', '99', '00', 'Disminución de otras retenciones laborales por pagar', 1),
('4', '11', '03', '01', '00', 'Disminución de cuentas por pagar a proveedores a corto plazo', 1),
('4', '11', '03', '02', '00', 'Disminución de efectos por pagar a proveedores a corto plazo', 1),
('4', '11', '03', '03', '00', 'Disminución de cuentas por pagar a proveedores a mediano y largo plazo', 1),
('4', '11', '03', '04', '00', 'Disminución de efectos por pagar a proveedores a mediano y largo plazo', 1),
('4', '11', '04', '01', '00', 'Disminución de cuentas por pagar a contratistas a corto plazo', 1),
('4', '11', '04', '02', '00', 'Disminución de efectos por pagar a contratistas a corto plazo', 1),
('4', '11', '04', '03', '00', 'Disminución de cuentas por pagar a contratistas a mediano largo y plazo', 1),
('4', '11', '04', '04', '00', 'Disminución de efectos por pagar a contratistas a mediano y plazo', 1),
('4', '11', '05', '01', '00', 'Disminución de intereses internos por pagar', 1),
('4', '11', '05', '02', '00', 'Disminución de intereses externos por pagar', 1),
('4', '11', '06', '01', '00', 'Disminución de obligaciones de ejercicios anteriores', 1),
('4', '11', '06', '02', '00', 'Disminución de otras cuentas por pagar a corto plazo', 1),
('4', '11', '06', '03', '00', 'Disminución de otros efectos por pagar a corto plazo', 1),
('4', '11', '07', '01', '00', 'Disminución de pasivos diferidos a corto plazo', 1),
('4', '11', '07', '02', '00', 'Disminución de pasivos diferidos a mediano y largo plazo', 1),
('4', '11', '08', '01', '00', 'Disminución de provisiones', 1),
('4', '11', '08', '02', '00', 'Disminución de reservas técnicas', 1),
('4', '11', '09', '01', '00', 'Disminución de depósitos recibidos en garantía', 1),
('4', '11', '09', '99', '00', 'Disminución de otros fondos de terceros', 1),
('4', '11', '10', '01', '00', 'Disminución de depósitos a la vista', 1),
('4', '11', '10', '02', '00', 'Disminución de depósitos a plazo fijo', 1),
('4', '11', '11', '01', '00', 'Devoluciones de cobros indebidos', 1),
('4', '11', '11', '02', '00', 'Devoluciones y reintegros diversos', 1),
('4', '11', '11', '03', '00', 'Indemnizaciones diversas', 1),
('4', '11', '11', '04', '00', 'Compromisos pendientes de ejercicios anteriores', 1),
('4', '11', '11', '05', '00', 'Prestaciones sociales originadas por la aplicación de la Ley Orgánica del Trabajo, los Trabajadores y las Trabajadoras', 1),
('4', '11', '98', '01', '00', 'Disminución de otros pasivos a corto plazo', 1),
('4', '11', '99', '01', '00', 'Disminución de otros pasivos a mediano y largo plazo', 1),
('4', '12', '01', '01', '00', 'Disminución del capital fiscal e institucional', 1),
('4', '12', '01', '02', '00', 'Disminución de aportes por capitalizar', 1),
('4', '12', '01', '03', '00', 'Disminución de dividendos a distribuir', 1),
('4', '12', '02', '01', '00', 'Disminución de reservas', 1),
('4', '12', '03', '01', '00', 'Ajuste por inflación', 1),
('4', '12', '04', '01', '00', 'Disminución de resultados acumulados', 1),
('4', '12', '04', '02', '00', 'Disminución de resultados del ejercicio', 1),
('4', '98', '01', '01', '00', 'Rectificaciones al presupuesto', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `cedula` int(8) NOT NULL,
  `user_accounts` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Perfil de usuario';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan_operativo`
--

CREATE TABLE `plan_operativo` (
  `id` int(11) NOT NULL,
  `plan_operativo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `plan_operativo`
--

INSERT INTO `plan_operativo` (`id`, `plan_operativo`) VALUES
(1, 'POA'),
(2, 'POAN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presentacion`
--

CREATE TABLE `presentacion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `presentacion`
--

INSERT INTO `presentacion` (`id`, `nombre`) VALUES
(1, 'Presentación'),
(2, 'No disponible');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programacion_fisica_presupuestaria`
--

CREATE TABLE `programacion_fisica_presupuestaria` (
  `id` int(11) NOT NULL,
  `id_proyecto_accion_especifica` int(11) NOT NULL,
  `tipo_distribucion` int(11) DEFAULT NULL,
  `enero` decimal(10,0) DEFAULT NULL,
  `febrero` decimal(10,0) DEFAULT NULL,
  `marzo` decimal(10,0) DEFAULT NULL,
  `abril` decimal(10,0) DEFAULT NULL,
  `mayo` decimal(10,0) DEFAULT NULL,
  `junio` decimal(10,0) DEFAULT NULL,
  `julio` decimal(10,0) DEFAULT NULL,
  `agosto` decimal(10,0) DEFAULT NULL,
  `septiembre` decimal(10,0) DEFAULT NULL,
  `octubre` decimal(10,0) DEFAULT NULL,
  `noviembre` decimal(10,0) DEFAULT NULL,
  `diciembre` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

CREATE TABLE `proyecto` (
  `id` int(11) NOT NULL,
  `codigo_proyecto` varchar(45) DEFAULT NULL,
  `codigo_sne` varchar(45) DEFAULT NULL,
  `nombre` text NOT NULL,
  `fecha_inicio` date NOT NULL COMMENT 'Fecha de inicio del proyecto',
  `fecha_fin` date NOT NULL COMMENT 'Fecha de fin del proyecto',
  `estatus_proyecto` int(11) NOT NULL,
  `situacion_presupuestaria` int(11) NOT NULL,
  `monto_proyecto` decimal(20,2) DEFAULT NULL,
  `descripcion` text,
  `objetivo_general_proyecto` text COMMENT 'Objetivo General del proyecto',
  `sector` int(11) DEFAULT NULL,
  `sub_sector` int(11) DEFAULT NULL,
  `plan_operativo` int(11) NOT NULL,
  `objetivo_general` int(11) NOT NULL,
  `objetivo_estrategico_institucional` text NOT NULL,
  `ambito` int(11) NOT NULL,
  `aprobado` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Estatus de aprobación',
  `estatus` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `proyecto`
--

INSERT INTO `proyecto` (`id`, `codigo_proyecto`, `codigo_sne`, `nombre`, `fecha_inicio`, `fecha_fin`, `estatus_proyecto`, `situacion_presupuestaria`, `monto_proyecto`, `descripcion`, `objetivo_general_proyecto`, `sector`, `sub_sector`, `plan_operativo`, `objetivo_general`, `objetivo_estrategico_institucional`, `ambito`, `aprobado`, `estatus`) VALUES
(1, '0001', '0001', 'Lorem ipsum dolor sit amet, per an accusata petentium conceptam, an case causae oporteat mel. Te epicuri praesent constituam mel, semper recusabo dissentiet ea qui. Quo dictas prompta constituam et.', '2016-01-01', '2016-12-31', 1, 1, '514124.12', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', 1, 1, 1, 1, 'Aliquam aliquam lectus orci, rhoncus ultricies quam cursus at. Pellentesque ac ultrices est. Sed at cursus ante. Nunc molestie facilisis nisi quis congue. Donec vel vulputate leo. Praesent a rhoncus sapien, quis rutrum felis. Maecenas placerat, enim in euismod tincidunt, magna quam laoreet augue, at facilisis purus risus nec leo. Pellentesque pulvinar, augue at fringilla vulputate, lorem nulla finibus justo, suscipit pretium risus dolor vel diam.', 4, 0, 1),
(999999, '9999', '9999', 'Proyecto de prueba', '2016-01-01', '1970-01-01', 1, 1, '46578.44', 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', 1, 1, 1, 1, 'Praesent a rhoncus sapien, quis rutrum felis. Maecenas placerat, enim in euismod tincidunt, magna quam laoreet augue, at facilisis purus risus nec leo. Pellentesque pulvinar, augue at fringilla vulputate, lorem nulla finibus justo, suscipit pretium risus dolor vel diam.', 1, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_accion_especifica`
--

CREATE TABLE `proyecto_accion_especifica` (
  `id` int(11) NOT NULL,
  `id_proyecto` int(11) NOT NULL,
  `codigo_accion_especifica` varchar(3) NOT NULL,
  `nombre` text,
  `unidad_medida` int(11) NOT NULL,
  `meta` int(11) NOT NULL,
  `ponderacion` float(1,1) NOT NULL,
  `bien_servicio` text CHARACTER SET utf8 NOT NULL,
  `id_unidad_ejecutora` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL COMMENT 'Fecha de inicio de la acción específica',
  `fecha_fin` date NOT NULL COMMENT 'Fecha de fin de la acción específica',
  `estatus` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proyecto_accion_especifica`
--

INSERT INTO `proyecto_accion_especifica` (`id`, `id_proyecto`, `codigo_accion_especifica`, `nombre`, `unidad_medida`, `meta`, `ponderacion`, `bien_servicio`, `id_unidad_ejecutora`, `fecha_inicio`, `fecha_fin`, `estatus`) VALUES
(20, 999999, '123', 'Acción Específica 20', 1, 5, 0.1, 'Ninguno', 1, '2016-01-01', '2016-12-31', 1),
(21, 999999, '1', 'AC21', 1, 0, 0.0, 'Ninguno', 600, '2016-01-01', '2016-12-31', 1),
(22, 999999, '2', 'AC22', 1, 0, 0.0, 'Ninguno', 602, '2016-01-01', '2016-12-31', 0),
(23, 999999, '4', 'AC23', 1, 0, 0.0, 'Ninguno', 601, '2016-01-01', '2016-12-31', 0),
(24, 999999, '4', 'AC24', 1, 0, 0.0, 'Ninguno', 600, '2016-01-01', '2016-12-31', 0),
(25, 999999, '6', 'AC25', 1, 0, 0.0, 'Ninguno', 600, '2016-01-01', '2016-12-31', 0),
(26, 999999, '7', 'AC26', 1, 0, 0.0, 'Ninguno', 600, '2016-01-01', '2016-12-31', 0),
(27, 1, '10', 'Acción específica 27', 1, 3, 0.1, 'Un bien', 602, '2016-01-01', '2017-12-31', 1),
(36, 1, '444', 'Otra acción 36', 1, 1, 0.5, 'Otro bien', 603, '2016-01-01', '2016-12-31', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_alcance`
--

CREATE TABLE `proyecto_alcance` (
  `id` int(11) NOT NULL,
  `id_proyecto` int(11) NOT NULL,
  `enunciado_problema` text NOT NULL COMMENT 'Enunciado del problema o necesidad',
  `poblacion_afectada` text NOT NULL COMMENT 'Población afectada',
  `indicador_situacion` text NOT NULL COMMENT 'Indicador de la situación inicial',
  `formula_indicador` text NOT NULL COMMENT 'Fórmula del indicador',
  `fuente_indicador` varchar(45) NOT NULL COMMENT 'Fuente del indicador',
  `fecha_indicador_inicial` date NOT NULL COMMENT 'Fecha del indicador de la situación inicial',
  `enunciado_situacion_deseada` text NOT NULL COMMENT 'Enunciado de la situación deseada',
  `poblacion_objetivo` text NOT NULL COMMENT 'Población objetivo',
  `indicador_situacion_deseada` text NOT NULL COMMENT 'Indicador de la situación deseada',
  `resultado_esperado` text NOT NULL COMMENT 'Resultado esperado',
  `unidad_medida` int(11) NOT NULL COMMENT 'Unidad de medida',
  `meta_proyecto` text NOT NULL COMMENT 'Meta del proyecto',
  `benficiarios_femeninos` float NOT NULL COMMENT 'Número de beneficiarios femeninos',
  `beneficiarios_masculinos` float NOT NULL COMMENT 'Número de beneficiarios masculinos',
  `denominacion_beneficiario` varchar(45) NOT NULL COMMENT 'Denominación del beneficiario',
  `total_empleos_directos_femeninos` float NOT NULL COMMENT 'Total de empleos directos femeninos',
  `total_empleos_directos_masculino` float NOT NULL COMMENT 'Total de empleos directos masculinos',
  `empleos_directos_nuevos_femeninos` float NOT NULL COMMENT 'Empleos directos nuevos femeninos',
  `empleos_directos_nuevos_masculino` float NOT NULL COMMENT 'Empleos directos nuevos masculinos',
  `empleos_directos_sostenidos_femeninos` float NOT NULL COMMENT 'Empleos directos sostenidos femeninos',
  `empleos_directos_sostenidos_masculino` float NOT NULL COMMENT 'Empleos directos sostenidos masculinos',
  `requiere_accion_no_financiera` tinyint(1) NOT NULL COMMENT '¿Este proyecto requiere acciones no financieras de otra institución o instancia del Poder Popular?',
  `especifique_con_cual` int(11) DEFAULT NULL COMMENT 'Si es si, especifique con cual',
  `requiere_nombre_institucion` varchar(80) DEFAULT NULL COMMENT 'Nombre de la institución',
  `requiere_nombre_instancia` varchar(80) DEFAULT NULL COMMENT 'Nombre de la instancia',
  `requiere_mencione_acciones` text COMMENT 'Mencione las acciones',
  `contribuye_complementa` tinyint(1) NOT NULL COMMENT '¿Contribuye o complementa acciones de otra institución o instancia del Poder Popular?',
  `especifique_complementa_cual` int(11) DEFAULT NULL COMMENT 'Si es si, especifique',
  `contribuye_nombre_institucion` varchar(80) DEFAULT NULL COMMENT 'Nombre de la institución',
  `contribuye_nombre_instancia` varchar(80) DEFAULT NULL COMMENT 'Nombre de la instancia',
  `contribuye_mencione_acciones` text COMMENT 'Mencione las acciones',
  `vinculado_otro` tinyint(1) NOT NULL COMMENT '¿Este proyecto está vinculado a otro?',
  `vinculado_especifique` int(11) DEFAULT NULL COMMENT 'Si es si, especifique',
  `vinculado_nombre_institucion` varchar(80) DEFAULT NULL COMMENT 'Nombre de la institución responsable del proyecto con el que este se encuentra vinculado',
  `vinculado_nombre_instancia` varchar(80) DEFAULT NULL COMMENT 'Nombre de la instancia responsable del proyecto con el que este se encuentra vinculado',
  `vinculado_nombre_proyecto` text COMMENT 'Nombre del proyecto con el que se encuentra vinculado',
  `vinculado_medida` text COMMENT '¿En que medida se encuentran vinculados los proyectos?',
  `obstaculos` text NOT NULL COMMENT ' ¿Cuáles serían los supuestos obstáculos para la ejecución de este proyecto? Especifique:'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Alcance e impacto del proyecto';

--
-- Volcado de datos para la tabla `proyecto_alcance`
--

INSERT INTO `proyecto_alcance` (`id`, `id_proyecto`, `enunciado_problema`, `poblacion_afectada`, `indicador_situacion`, `formula_indicador`, `fuente_indicador`, `fecha_indicador_inicial`, `enunciado_situacion_deseada`, `poblacion_objetivo`, `indicador_situacion_deseada`, `resultado_esperado`, `unidad_medida`, `meta_proyecto`, `benficiarios_femeninos`, `beneficiarios_masculinos`, `denominacion_beneficiario`, `total_empleos_directos_femeninos`, `total_empleos_directos_masculino`, `empleos_directos_nuevos_femeninos`, `empleos_directos_nuevos_masculino`, `empleos_directos_sostenidos_femeninos`, `empleos_directos_sostenidos_masculino`, `requiere_accion_no_financiera`, `especifique_con_cual`, `requiere_nombre_institucion`, `requiere_nombre_instancia`, `requiere_mencione_acciones`, `contribuye_complementa`, `especifique_complementa_cual`, `contribuye_nombre_institucion`, `contribuye_nombre_instancia`, `contribuye_mencione_acciones`, `vinculado_otro`, `vinculado_especifique`, `vinculado_nombre_institucion`, `vinculado_nombre_instancia`, `vinculado_nombre_proyecto`, `vinculado_medida`, `obstaculos`) VALUES
(1, 1, 'Según indican los últimos datos del INE correspondiente a enero de 2015,  en torno a la situación de la fuerza de trabajo, en Venezuela existe una población ocupada en el sector informal de 5.394.922  trabajadores  y trabajadoras que no disfrutan de ningún tipo de protección social o tienen una cobertura de seguridad social muy limitada por lo que se hace necesario la ejecución de un conjunto de acciones que permitan su inclusión al régimen de pensiones y otras asignaciones económicas.', '4.157.726  trabajadores y trabajadoras no dependientes se encuentran fuera del sistema de seguridad social.', 'El 77% de trabajadores no dependientes se encuentran fuera del sistema de seguridad social.', 'Trab. No dependientes excluidos SS= Trab. No dependientes excluidos SS/Total trab. No dependiente X100', 'INE', '2015-01-01', '1.338.496 de trabajadores y trabajadoras no dependientes incorporados al sistema de seguridad social.', '101.300 trabajadores y trabajadoras no incorporados al regimen de pensiones y otras asignaciones económicas.', '74,57%  de trabajadores no dependientes se encuentran fuera del sistema de seguridad social para el año 2015.', 'Trabajadores y trabajadoras no dependientes orientados en cuanto sus deberes y derechos de la Seguridad Social.', 2, '101.300', 50, 50, 'Trabajadores', 0, 0, 0, 0, 0, 0, 0, NULL, '', '', '', 0, NULL, '', '', '', 0, NULL, '', '', '', '', 'Ninguno.'),
(3, 999999, 'asfasf', 'adsfafas', 'asfasf', 'asfas', 'asfasf', '0000-00-00', 'asdasafs', 'asfasfas', 'asfasfsaf', 'asfasaf', 1, 'fadfdas', 1, 1, 'asdasd', 1, 1, 1, 1, 1, 1, 0, NULL, '', '', '', 0, NULL, '', '', '', 0, NULL, '', '', '', '', 'asfasfasf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_asignar`
--

CREATE TABLE `proyecto_asignar` (
  `id` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `unidad_ejecutora` int(11) NOT NULL,
  `accion_especifica` int(11) NOT NULL,
  `estatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Relación entre usuarios, unidades ejecutoras y acciones específicas de un proyecto';

--
-- Volcado de datos para la tabla `proyecto_asignar`
--

INSERT INTO `proyecto_asignar` (`id`, `usuario`, `unidad_ejecutora`, `accion_especifica`, `estatus`) VALUES
(5, 2, 602, 27, 1),
(7, 2, 1, 20, 1),
(8, 3, 1, 20, 1),
(9, 2, 603, 36, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_distribucion_presupuestaria`
--

CREATE TABLE `proyecto_distribucion_presupuestaria` (
  `id` int(11) NOT NULL,
  `id_accion_especifica` int(11) NOT NULL COMMENT 'Acción Específica',
  `id_partida` int(11) NOT NULL COMMENT 'Partida',
  `cantidad` decimal(20,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Distribución presupuestaria de proyecto';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_fuente_financiamiento`
--

CREATE TABLE `proyecto_fuente_financiamiento` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_localizacion`
--

CREATE TABLE `proyecto_localizacion` (
  `id` int(11) NOT NULL,
  `id_proyecto` int(11) NOT NULL,
  `id_pais` int(11) NOT NULL,
  `id_estado` int(11) DEFAULT NULL,
  `id_municipio` int(11) DEFAULT NULL,
  `id_parroquia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `proyecto_localizacion`
--

INSERT INTO `proyecto_localizacion` (`id`, `id_proyecto`, `id_pais`, `id_estado`, `id_municipio`, `id_parroquia`) VALUES
(1, 1, 862, 2, NULL, NULL),
(3, 1, 862, 16, NULL, NULL),
(4, 1, 862, 5, NULL, NULL),
(15, 999999, 862, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_pedido`
--

CREATE TABLE `proyecto_pedido` (
  `id` int(11) NOT NULL,
  `id_material` int(11) NOT NULL,
  `enero` int(11) NOT NULL DEFAULT '0',
  `febrero` int(11) NOT NULL DEFAULT '0',
  `marzo` int(11) NOT NULL DEFAULT '0',
  `abril` int(11) NOT NULL DEFAULT '0',
  `mayo` int(11) NOT NULL DEFAULT '0',
  `junio` int(11) NOT NULL DEFAULT '0',
  `julio` int(11) NOT NULL DEFAULT '0',
  `agosto` int(11) NOT NULL DEFAULT '0',
  `septiembre` int(11) NOT NULL DEFAULT '0',
  `octubre` int(11) NOT NULL DEFAULT '0',
  `noviembre` int(11) NOT NULL DEFAULT '0',
  `diciembre` int(11) NOT NULL DEFAULT '0',
  `precio` decimal(12,2) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `asignado` int(11) NOT NULL COMMENT 'ID de la asignacion (Usuario-UE-AC)',
  `estatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `proyecto_pedido`
--

INSERT INTO `proyecto_pedido` (`id`, `id_material`, `enero`, `febrero`, `marzo`, `abril`, `mayo`, `junio`, `julio`, `agosto`, `septiembre`, `octubre`, `noviembre`, `diciembre`, `precio`, `fecha_creacion`, `asignado`, `estatus`) VALUES
(1, 2, 11, 0, 0, 0, 4, 0, 0, 0, 25, 0, 0, 0, '230.00', '2016-06-23 20:16:20', 7, 1),
(2, 3, 1500, 0, 0, 0, 0, 0, 1200, 0, 0, 0, 0, 0, '4620.00', '2016-06-23 20:16:51', 7, 1),
(3, 49, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '2000000.00', '2016-06-30 06:22:19', 7, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_registrador`
--

CREATE TABLE `proyecto_registrador` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `cedula` int(10) NOT NULL,
  `email` varchar(80) DEFAULT NULL,
  `telefono` varchar(14) NOT NULL,
  `id_proyecto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `proyecto_registrador`
--

INSERT INTO `proyecto_registrador` (`id`, `nombre`, `cedula`, `email`, `telefono`, `id_proyecto`) VALUES
(3, 'Carlos Samaniego', 16344539, 'catu52@yahoo.com', '+584262130565', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_responsable`
--

CREATE TABLE `proyecto_responsable` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `cedula` int(10) NOT NULL,
  `email` varchar(45) NOT NULL,
  `telefono` varchar(14) NOT NULL,
  `id_proyecto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `proyecto_responsable`
--

INSERT INTO `proyecto_responsable` (`id`, `nombre`, `cedula`, `email`, `telefono`, `id_proyecto`) VALUES
(4, 'John Doe', 123456789, 'john@correo.com', '+584262130565', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_responsable_administrativo`
--

CREATE TABLE `proyecto_responsable_administrativo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `cedula` int(10) NOT NULL,
  `email` varchar(45) NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `unidad_administradora` varchar(45) NOT NULL,
  `id_proyecto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_responsable_tecnico`
--

CREATE TABLE `proyecto_responsable_tecnico` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `cedula` int(10) NOT NULL,
  `email` varchar(45) NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `unidad_tecnica` varchar(45) NOT NULL,
  `id_proyecto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `proyecto_responsable_tecnico`
--

INSERT INTO `proyecto_responsable_tecnico` (`id`, `nombre`, `cedula`, `email`, `telefono`, `unidad_tecnica`, `id_proyecto`) VALUES
(2, 'Jane', 65498732, 'jane@correo.com', '(212)9876543', 'Tecnica', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `responsable_acc_variable`
--

CREATE TABLE `responsable_acc_variable` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `cedula` int(10) NOT NULL,
  `email` varchar(45) NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `oficina` varchar(60) NOT NULL,
  `id_variable` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `responsable_acc_variable`
--

INSERT INTO `responsable_acc_variable` (`id`, `nombre`, `cedula`, `email`, `telefono`, `oficina`, `id_variable`) VALUES
(19, 'walter', 17389814, 'walter86_79@hotmail.com', '02124813639', 'caracas', 31);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sector`
--

CREATE TABLE `sector` (
  `id` int(11) NOT NULL,
  `sector` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sector`
--

INSERT INTO `sector` (`id`, `sector`) VALUES
(1, 'Seguridad Social'),
(2, 'Dirección Superior del Estado'),
(3, 'Seguridad_y_Defensa'),
(4, 'Agrícola'),
(5, 'Energía_Minas_y_Petróleo'),
(6, 'Industria_y_Comercio'),
(7, 'Turismo_y_recreación'),
(8, 'Transporte_y_Comunicaciones'),
(9, 'Educación'),
(10, 'Cultura_y_Comunicación_Social'),
(11, 'Ciencia_y_Tecnología'),
(12, 'Vivienda_Desarrollo_Urbano_y_S'),
(13, 'Salud'),
(14, 'Desarrollo_Social_y_Participac'),
(15, 'Seguridad_Social'),
(16, 'Gastos_No_Clasificados_Sectori');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `situacion_presupuestaria`
--

CREATE TABLE `situacion_presupuestaria` (
  `id` int(11) NOT NULL,
  `situacion` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `situacion_presupuestaria`
--

INSERT INTO `situacion_presupuestaria` (`id`, `situacion`) VALUES
(1, 'Por iniciar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sub_sector`
--

CREATE TABLE `sub_sector` (
  `id` int(11) NOT NULL,
  `sub_sector` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sub_sector`
--

INSERT INTO `sub_sector` (`id`, `sub_sector`) VALUES
(1, 'N/D');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_distribucion`
--

CREATE TABLE `tipo_distribucion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_financiamiento`
--

CREATE TABLE `tipo_financiamiento` (
  `id` int(11) NOT NULL,
  `tipo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_financiamiento`
--

INSERT INTO `tipo_financiamiento` (`id`, `tipo`) VALUES
(1, 'Total'),
(2, 'Parcial');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad_ejecutora`
--

CREATE TABLE `unidad_ejecutora` (
  `id` int(11) NOT NULL,
  `codigo_ue` varchar(5) CHARACTER SET latin1 NOT NULL,
  `nombre` text CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `unidad_ejecutora`
--

INSERT INTO `unidad_ejecutora` (`id`, `codigo_ue`, `nombre`) VALUES
(1, '9999', 'UNIDAD EJECUTORA'),
(600, '10000', 'OFICINA DE ADMINISTRACIÓN Y SERVICIOS '),
(601, '10001', 'DESPACHO DE LA MINISTRO '),
(602, '10002', 'DESPACHO DEL VICEMINISTRO DEL TRABAJO '),
(603, '10003', 'DIRECCIÓN GENERAL DEL DESPACHO '),
(604, '10004', 'OFICINA DE AUDITORÍA INTERNA '),
(605, '10005', 'OFICINA DE PLANIFICACIÓN Y PRESUPUESTO '),
(606, '10006', 'CONSULTORÍA JURÍDICA '),
(607, '10007', 'DIRECCIÓN DE PERSONAL '),
(608, '10008', 'OFICINA DE ESTADÍSTICA E INFORMÁTICA '),
(609, '10011', 'OFICINA DE ADMINISTRACIÓN Y GESTIÓN INTERNA '),
(610, '10013', 'DIRECCIÓN DE DOCUMENTACIÓN E INFORMACIÓN '),
(611, '10014', 'DIRECCIÓN DE RELACIONES PÚBLICAS '),
(612, '10015', 'DIRECCIÓN DE RELACIONES INTERNACIONALES Y ENLACE CON LA OIT '),
(613, '10016', 'DIRECCIÓN DE ESTADÍSTICA '),
(614, '10017', 'DIRECCIÓN DE INFORMÁTICA '),
(615, '10018', 'COORDINACIÓN ZONA METROPOLITANA '),
(616, '10019', 'COORDINACIÓN ZONA MIRANDA '),
(617, '10020', 'COORDINACIÓN ZONA CENTRAL '),
(618, '10021', 'COORDINACIÓN ZONA CENTRO OCCIDENTAL '),
(619, '10022', 'COORDINACIÓN ZONA ZULIA '),
(620, '10023', 'COORDINACIÓN ZONA FALCÓN '),
(621, '10024', 'COORDINACIÓN ZONA ANDINA '),
(622, '10025', 'COORDINACIÓN ZONA LLANOS OCCIDENTALES '),
(623, '10026', 'COORDINACIÓN ZONA CENTRO SUR '),
(624, '10027', 'COORDINACIÓN ZONA NOR-ORIENTAL '),
(625, '10028', 'COORDINACIÓN ZONA ORIENTAL '),
(626, '10029', 'COORDINACIÓN ZONA GUAYANA '),
(627, '10030', 'DESPACHO DEL VICEMINISTRO DE SEGURIDAD SOCIAL '),
(628, '10031', 'UNIDAD ESTRATÉGICA DE SEGUIMIENTO Y EVALUACIÓN DE POLÍTICAS PÚBLICAS '),
(629, '10032', 'OFICINA DE PLANIFICACIÓN ESTRATÉGICA Y CONTROL DE GESTIÓN '),
(630, '10033', 'DIRECCIÓN DE PRESUPUESTO '),
(631, '20001', 'DIRECCIÓN GENERAL DE RELACIONES LABORALES '),
(632, '20004', 'DIRECCIÓN DE INSPECTORÍA NACIONAL Y OTROS ASUNTOS COLECTIVOS DE TRABAJO (SECTOR PRIVADO) '),
(633, '20007', 'DIRECCIÓN DE INSPECTORÍA NACIONAL Y OTROS ASUNTOS COLECTIVOS DE TRABAJO (SECTOR PÚBLICO) '),
(634, '20009', 'DIRECCIÓN DE INSPECCIÓN Y CONDICIONES DE TRABAJO '),
(635, '20010', 'DIRECCIÓN DE NEGOCIACIÓN'),
(636, '30004', 'INSTITUTO VENEZOLANO DE LOS SEGUROS SOCIALES (IVSS) '),
(637, '30005', 'DIRECCIÓN GENERAL DE PREVISIÓN SOCIAL '),
(638, '30006', 'DIRECCIÓN DE HIGIENE Y SEGURIDAD INDUSTRIAL '),
(639, '30007', 'DIRECCIÓN DE SEGURIDAD SOCIAL '),
(640, '30008', 'INSTITUTO NACIONAL PARA LA CAPACITACIÓN Y RECREACIÓN DE LOS '),
(641, '30010', 'INSTITUTO NACIONAL DE PREVENCIÓN'),
(642, '30011', 'FUNDACIÓN MADRES DE BARRIO '),
(643, '30012', 'TESORERIA DE SEGURIDAD SOCIAL (TSS) '),
(644, '40001', 'DIRECCIÓN GENERAL DE EMPLEO '),
(645, '40002', 'DIRECCIÓN DE ESTUDIOS Y ANÁLISIS DE EMPLEO Y MERCADO DE TRABAJO '),
(646, '40003', 'DIRECCIÓN DE MIGRACIONES LABORALES '),
(647, '40004', 'DIRECCIÓN DE FORMACIÓN PROFESIONAL '),
(648, '40017', 'INTERMEDIACIÓN DISTRITO CAPITAL - VARGAS '),
(649, '40018', 'INTERMEDIACIÓN ESTADO MIRANDA '),
(650, '40019', 'INTERMEDIACIÓN ESTADOS ARAGUA - CARABOBO '),
(651, '40020', 'INTERMEDIACIÓN ESTADOS LARA -TRUJILLO -YARACUY '),
(652, '40021', 'INTERMEDIACIÓN ESTADO ZULIA '),
(653, '40022', 'INTERMEDIACIÓN ESTADO FALCÓN '),
(654, '40023', 'INTERMEDIACIÓN ESTADOS TÁCHIRA - MÉRIDA '),
(655, '40024', 'INTERMEDIACIÓN ESTADOS BARINAS - PORTUGUESA - COJEDES '),
(656, '40025', 'INTERMEDIACIÓN ESTADOS APURE - GUÁRICO - AMAZONAS '),
(657, '40026', 'INTERMEDIACIÓN ESTADOS NUEVA ESPARTA - ANZOÁTEGUI '),
(658, '40027', 'INTERMEDIACIÓN ESTADOS SUCRE - MONAGAS - DELTA AMACURO '),
(659, '40028', 'INTERMEDIACIÓN ESTADO BOLÍVAR '),
(660, '40029', 'DIVISIÓN DE REHABILITACIÓN OCUPACIONAL '),
(661, '50001', 'DIRECCIÓN GENERAL DE PROCURADURÍA NACIONAL DE TRABAJADORES '),
(662, '50003', 'DIRECCIÓN DE PROCURADURÍA '),
(663, '50016', 'DEFENSORÍA DISTRITO CAPITAL - VARGAS '),
(664, '50017', 'DEFENSORÍA ESTADO MIRANDA '),
(665, '50018', 'DEFENSORÍA ESTADOS ARAGUA - CARABOBO '),
(666, '50019', 'DEFENSORÍA ESTADOS LARA - TRUJILLO- YARACUY '),
(667, '50020', 'DEFENSORÍA ESTADO ZULIA '),
(668, '50021', 'DEFENSORÍA ESTADO FALCÓN '),
(669, '50022', 'DEFENSORÍA ESTADOS TÁCHIRA - MÉRIDA '),
(670, '50023', 'DEFENSORÍA ESTADOS BARINAS - PORTUGUESA - COJEDES '),
(671, '50024', 'DEFENSORÍA ESTADOS APURE - GUÁRICO - AMAZONAS '),
(672, '50025', 'DEFENSORÍA ESTADOS NUEVA ESPARTA - ANZOÁTEGUI '),
(673, '50026', 'DEFENSORÍA ESTADOS SUCRE - MONAGAS - DELTA AMACURO '),
(674, '50027', 'DEFENSORÍA ESTADO BOLÍVAR '),
(675, '50028', 'DIRECCIÓN DE INVESTIGACIÓN Y ASUNTOS LABORALES '),
(676, '60022', 'INSPECCIÓN DISTRITO CAPITAL - VARGAS '),
(677, '60023', 'INSPECCIÓN ESTADO MIRANDA '),
(678, '60024', 'INSPECCIÓN ESTADOS ARAGUA - CARABOBO '),
(679, '60025', 'INSPECCIÓN ESTADOS LARA - TRUJILLO - YARACUY '),
(680, '60026', 'INSPECCIÓN ESTADO ZULIA '),
(681, '60027', 'INSPECCIÓN ESTADO FALCÓN '),
(682, '60028', 'INSPECCIÓN ESTADOS TÁCHIRA - MÉRIDA '),
(683, '60029', 'INSPECCIÓN ESTADOS BARINAS - PORTUGUESA - COJEDES '),
(684, '60030', 'INSPECCIÓN ESTADOS APURE - GUÁRICO - AMAZONAS '),
(685, '60031', 'INSPECCIÓN ESTADOS NUEVA ESPARTA - ANZOÁTEGUI '),
(686, '60032', 'INSPECCIÓN ESTADOS SUCRE - MONAGAS - DELTA AMACURO '),
(687, '60033', 'INSPECCIÓN ESTADO BOLÍVAR ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad_medida`
--

CREATE TABLE `unidad_medida` (
  `id` int(11) NOT NULL,
  `unidad_medida` varchar(45) NOT NULL COMMENT 'Unidad de medida'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Unidad de medida para el alcance e impacto del proyecto';

--
-- Volcado de datos para la tabla `unidad_medida`
--

INSERT INTO `unidad_medida` (`id`, `unidad_medida`) VALUES
(1, 'Accion(es)'),
(2, 'Trabajador(es)'),
(3, 'abastecimiento(s)'),
(4, 'academia(s)'),
(5, 'acompañamiento(s)'),
(6, 'acondicionamiento(s)'),
(7, 'acta(s)'),
(8, 'actividad(es)'),
(9, 'acto(s)'),
(10, 'actuación(es)'),
(11, 'acueducto(s)'),
(12, 'adquisición(es)'),
(13, 'aeronave(s)'),
(14, 'ambulatorio(s)'),
(15, 'análisi(s)'),
(16, 'animal(es)'),
(17, 'antena(s)'),
(18, 'anuario(s)'),
(19, 'apoyo(s)'),
(20, 'área(s)'),
(21, 'arma(s)'),
(22, 'artículo(s)'),
(23, 'asesoría(s)'),
(24, 'asignación(es) económica(s)'),
(25, 'asistencia(s) técnica(s)'),
(26, 'atención(es)'),
(27, 'auditoría(s)'),
(28, 'biopsia(s)'),
(29, 'blister(s)'),
(30, 'bloque(s)'),
(31, 'boleta(s)'),
(32, 'boletín(s)'),
(33, 'bolsa(s)'),
(34, 'bota(s)'),
(35, 'botella(s)'),
(36, 'boya(s)'),
(37, 'brigada(s)'),
(38, 'bulto(s)'),
(39, 'buque(s)'),
(40, 'cabeza(s)'),
(41, 'cadete(s)'),
(42, 'caja(s)'),
(43, 'calculadora(s)'),
(44, 'calibración(es)'),
(45, 'cama(s)'),
(46, 'camara(s)'),
(47, 'camión(es) cisterna(s)'),
(48, 'camisa(s)'),
(49, 'campaña(s)'),
(50, 'campaña(s) publicitaria(s)'),
(51, 'canal(es)'),
(52, 'cancha(s)'),
(53, 'cantero(s)'),
(54, 'capacitación(es)'),
(55, 'capitanía(s)'),
(56, 'caracterización(es)'),
(57, 'carcel(es)'),
(58, 'cargabilidad(es)'),
(59, 'cargo(s)'),
(60, 'carnet(es)'),
(61, 'carta(s) de naturalización(es)'),
(62, 'cartelera(s)'),
(63, 'casa(s)'),
(64, 'casco(s)'),
(65, 'caseta(s)'),
(66, 'caso(s)'),
(67, 'catálogo(s)'),
(68, 'catastro(s)'),
(69, 'cátedra(s)'),
(70, 'cauce(s)'),
(71, 'caucho(s)'),
(72, 'cédula(s)'),
(73, 'cédula(s) de identidad'),
(74, 'censo(s)'),
(75, 'centro(s)'),
(76, 'centro(s) de Diagnóstico Integral'),
(77, 'centro(s) de salud'),
(78, 'centro(s) de votación'),
(79, 'centro(s) penitenciario(s)'),
(80, 'centro(s) piloto(s)'),
(81, 'certificado(s)'),
(82, 'cesta ticket(s)'),
(83, 'charla(s)'),
(84, 'cheque(s)'),
(85, 'circuito(s)'),
(86, 'circunscripción(es) judicial(es)'),
(87, 'citación(es)'),
(88, 'ciudad(es) judicial(es)'),
(89, 'clase(s)'),
(90, 'cobija(s)'),
(91, 'colchon(es)'),
(92, 'colección(es)'),
(93, 'combo(s) de uniforme(s)'),
(94, 'comedor(es)'),
(95, 'comida(s) servida(s)'),
(96, 'comisión(s)'),
(97, 'comité(s)'),
(98, 'complejo(s)'),
(99, 'compra(s)'),
(100, 'computadora(s)'),
(101, 'comunidad(es)'),
(102, 'concierto(s)'),
(103, 'concurso(s)'),
(104, 'conexión(es)'),
(105, 'conferencia(s)'),
(106, 'configuración(es)'),
(107, 'consejo(s)'),
(108, 'consejo(s) comunal(es)'),
(109, 'constancia(s)'),
(110, 'construcción(es)'),
(111, 'consulta(s)'),
(112, 'consultorio(s) popular(es)'),
(113, 'contenido(s)'),
(114, 'contrato(s)'),
(115, 'contribuyente(s)'),
(116, 'control(es)'),
(117, 'convención(es)'),
(118, 'convenio(s)'),
(119, 'convocatoría(s)'),
(120, 'cooperativa(s)'),
(121, 'coordinación(es)'),
(122, 'coproducción(es)'),
(123, 'corte(s)'),
(124, 'cortometraje(s)'),
(125, 'cotización(es)'),
(126, 'crédito(s)'),
(127, 'cuaderno(s)'),
(128, 'cuadro(s)'),
(129, 'cuarto(s)'),
(130, 'cuenca(s)'),
(131, 'cuestionario(s)'),
(132, 'cultivo(s)'),
(133, 'cuñete(s)'),
(134, 'curso(s)'),
(135, 'decisión(es)'),
(136, 'declaración(es)'),
(137, 'decreto(s)'),
(138, 'defensa(s)'),
(139, 'delegación(es)'),
(140, 'delegado(s)'),
(141, 'demanda(s)'),
(142, 'denuncia(s)'),
(143, 'dependencia(s)'),
(144, 'derecho(s) de autor'),
(145, 'designación(es)'),
(146, 'despacho(s)'),
(147, 'destacamento(s)'),
(148, 'día(s)'),
(149, 'día(s) / hombre'),
(150, 'diagnóstico(s)'),
(151, 'diagrama(s)'),
(152, 'diccionario(s)'),
(153, 'dictámen(es)'),
(154, 'digitalización(es)'),
(155, 'dique(s)'),
(156, 'disco(s) compacto(s)'),
(157, 'diseño(s)'),
(158, 'dispositivo(s)'),
(159, 'docente(s)'),
(160, 'documental(es)'),
(161, 'documento(s)'),
(162, 'dosi(s)'),
(163, 'dossier(s)'),
(164, 'dotación(es)'),
(165, 'drenaje(s)'),
(166, 'edición(es)'),
(167, 'edificación(es)'),
(168, 'efectivo(s)'),
(169, 'ejemplar(es)'),
(170, 'ejercicio(s)'),
(171, 'elección(es)'),
(172, 'elector(es)'),
(173, 'electrodoméstico(s)'),
(174, 'embalse(s)'),
(175, 'embarcación(es)'),
(176, 'embargo(s)'),
(177, 'embrión(es)'),
(178, 'emergencia(s)'),
(179, 'empresa(s)'),
(180, 'empresa(s) de propiedad social'),
(181, 'encuentro(s)'),
(182, 'encuesta(s)'),
(183, 'ensayo(s)'),
(184, 'ente(s)'),
(185, 'entidad(es)'),
(186, 'entrega(s)'),
(187, 'entrenamiento(s)'),
(188, 'entrevista(s)'),
(189, 'equipamiento(s)'),
(190, 'equipo(s)'),
(191, 'escritorio(s)'),
(192, 'escuela(s)'),
(193, 'espacio(s)'),
(194, 'especie(s) fiscal(es)'),
(195, 'espectador(es)'),
(196, 'esquema(s)'),
(197, 'establecimiento(s)'),
(198, 'estación(es)'),
(199, 'estado(s) financiero(s)'),
(200, 'estanque(s)'),
(201, 'estatuto(s)'),
(202, 'estructura(s)'),
(203, 'estuche(s)'),
(204, 'estudiante(s)'),
(205, 'estudio(s)'),
(206, 'evaluación(es)'),
(207, 'evento(s)'),
(208, 'exámen(es)'),
(209, 'exhibición(es)'),
(210, 'expedición(es)'),
(211, 'expediente(s)'),
(212, 'experticia(s)'),
(213, 'exposición(es)'),
(214, 'expropiación(es)'),
(215, 'extintor(es)'),
(216, 'extracción(es)'),
(217, 'facilitador(es)'),
(218, 'factura(s)'),
(219, 'familia(s)'),
(220, 'faro(s)'),
(221, 'fase(s)'),
(222, 'federación(es)'),
(223, 'feria(s)'),
(224, 'ferretería(s)'),
(225, 'festival(es)'),
(226, 'fianza(s)'),
(227, 'ficha(s)'),
(228, 'financiamiento(s)'),
(229, 'finca(s)'),
(230, 'fiscalía(s)'),
(231, 'fiscalización(es)'),
(232, 'flete(s)'),
(233, 'flujograma(s)'),
(234, 'foco(s)'),
(235, 'folio(s)'),
(236, 'fondo(s)'),
(237, 'formato(s)'),
(238, 'formulario(s)'),
(239, 'foro(s)'),
(240, 'frasco(s)'),
(241, 'fuente(s)'),
(242, 'funcionario(s)'),
(243, 'funda(s)'),
(244, 'fundación(es)'),
(245, 'fundo(s)'),
(246, 'gaceta(s)'),
(247, 'galón(es)'),
(248, 'galpón(es)'),
(249, 'garantía(s)'),
(250, 'gerencia(s)'),
(251, 'gigavatio(s)'),
(252, 'gigavatio(s) / Hora'),
(253, 'gira(s)'),
(254, 'grabación(es)'),
(255, 'grado(s)'),
(256, 'gramo(s)'),
(257, 'granja(s)'),
(258, 'gruesa(s)'),
(259, 'grupo(s) teatral(es)'),
(260, 'guardacuenca(s)'),
(261, 'guía(s)'),
(262, 'guión(es)'),
(263, 'habitación(es)'),
(264, 'hectárea(s)'),
(265, 'herramienta(s) tecnológica(s)'),
(266, 'história(s) médica(s)'),
(267, 'hito(s)'),
(268, 'hogar(es)'),
(269, 'hoja(s)'),
(270, 'homenaje(s)'),
(271, 'hora(s)'),
(272, 'hospital(es)'),
(273, 'huerto(s)'),
(274, 'imágen(es)'),
(275, 'implantación(es)'),
(276, 'impresión(es)'),
(277, 'impulso(s)'),
(278, 'indemnización(es)'),
(279, 'indicador(es)'),
(280, 'infocentro(s)'),
(281, 'infolancha(s)'),
(282, 'infomóvil(es)'),
(283, 'Infopunto(s)'),
(284, 'información(es)'),
(285, 'informe(s)'),
(286, 'infraestructura(s)'),
(287, 'inmueble(s)'),
(288, 'inscripción(es)'),
(289, 'inspección(es)'),
(290, 'instalación(es)'),
(291, 'instancia(s) del poder popular'),
(292, 'institución(es)'),
(293, 'instrucción(es)'),
(294, 'instructivo(s)'),
(295, 'instructor(es)'),
(296, 'instrumento(s)'),
(297, 'insumo(s)'),
(298, 'intercambio(s)'),
(299, 'interno(s)'),
(300, 'intervención(es)'),
(301, 'inventario(s)'),
(302, 'investigación(es)'),
(303, 'investigador(es)'),
(304, 'jornada(s)'),
(305, 'jornal(es)'),
(306, 'jubilación(es)'),
(307, 'juego(s)'),
(308, 'juez(ces)'),
(309, 'juguete(s)'),
(310, 'juicio(s)'),
(311, 'junta(s)'),
(312, 'kilo(s)'),
(313, 'kilobit(s) por segundo'),
(314, 'kilográmetro(s)'),
(315, 'kilogramo(s)'),
(316, 'kilolitro(s)'),
(317, 'kilómetro(s)'),
(318, 'kilómetro(s) cuadrado(s)'),
(319, 'kilovatio(s)'),
(320, 'kilovatio(s) / hora'),
(321, 'laboratorio(s)'),
(322, 'laguna(s)'),
(323, 'lámina(s)'),
(324, 'lancero(s)'),
(325, 'lancha(s)'),
(326, 'largometraje(s)'),
(327, 'lata(s)'),
(328, 'legalización(es)'),
(329, 'ley(es)'),
(330, 'librería(s)'),
(331, 'libreta(s)'),
(332, 'libro(s)'),
(333, 'licencia(s)'),
(334, 'liceo(s)'),
(335, 'licitación(es)'),
(336, 'liga(s)'),
(337, 'línea(s)'),
(338, 'lineamiento(s)'),
(339, 'listado(s)'),
(340, 'litigio(s)'),
(341, 'litro(s)'),
(342, 'litro(s) cúbico(s)'),
(343, 'llamada(s)'),
(344, 'local(es)'),
(345, 'lote(s)'),
(346, 'mancomunidad(es)'),
(347, 'maniobra(s)'),
(348, 'mantenimiento(s)'),
(349, 'manual(es)'),
(350, 'mapa(s)'),
(351, 'máquina(s)'),
(352, 'maquinaría(s)'),
(353, 'mareógrafo(s)'),
(354, 'matrícula(s)'),
(355, 'medalla(s)'),
(356, 'medicamento(s)'),
(357, 'medio(s) alternativo(s) comunitario(s)'),
(358, 'mega(s)'),
(359, 'megavatio(s)'),
(360, 'megavatio(s) / hora'),
(361, 'megavoltamperio(s)'),
(362, 'mensaje(s)'),
(363, 'menú(s)'),
(364, 'mes(es)'),
(365, 'mesa(s)'),
(366, 'metro(s)'),
(367, 'metro(s) cuadrado(s)'),
(368, 'metro(s) cúbico(s)'),
(369, 'metro(s) lineal(es)'),
(370, 'micro(s)'),
(371, 'miembro(s)'),
(372, 'mil(es)'),
(373, 'milla(s)'),
(374, 'millar(es)'),
(375, 'millardo(s)'),
(376, 'millón(es)'),
(377, 'millón(es) de metro(s) cúbico(s)'),
(378, 'minuto(s)'),
(379, 'misa(s)'),
(380, 'mobiliario(s)'),
(381, 'modelo(s)'),
(382, 'modificación(es) presupuestaria(s)'),
(383, 'módulo(s)'),
(384, 'montaje(s)'),
(385, 'movimiento(s)'),
(386, 'muestra(s)'),
(387, 'multa(s)'),
(388, 'munición(es)'),
(389, 'municipio(s)'),
(390, 'nodo(s)'),
(391, 'nombramiento(s)'),
(392, 'nómina(s)'),
(393, 'norma(s)'),
(394, 'normativa(s)'),
(395, 'nota(s) informativa(s)'),
(396, 'notificación(es)'),
(397, 'núcleo(s)'),
(398, 'núcleo(s) de desarrollo endógeno'),
(399, 'obra(s)'),
(400, 'oficial(es)'),
(401, 'oficina(s)'),
(402, 'oficio(s)'),
(403, 'onza(s) Troy'),
(404, 'operación(es)'),
(405, 'operador(es)'),
(406, 'operativo(s)'),
(407, 'opinión(es)'),
(408, 'orden(es)'),
(409, 'organización(es)'),
(410, 'órgano(s)'),
(411, 'paciente(s)'),
(412, 'página(s) web'),
(413, 'pago(s)'),
(414, 'pajuela(s) de semen'),
(415, 'pancarta(s)'),
(416, 'paquete(s)'),
(417, 'par(es)'),
(418, 'participación(es)'),
(419, 'participante(s)'),
(420, 'partitura(s)'),
(421, 'parto(s)'),
(422, 'pasaje(s)'),
(423, 'pasantía(s)'),
(424, 'pasaporte(s)'),
(425, 'patio(s)'),
(426, 'pauta(s)'),
(427, 'película(s)'),
(428, 'pendón(es)'),
(429, 'pensión(es)'),
(430, 'pensum(s)'),
(431, 'perfil(es)'),
(432, 'perforación(es)'),
(433, 'perímetro(s)'),
(434, 'periódico(s)'),
(435, 'período(s)'),
(436, 'persona(s)'),
(437, 'pie(s)'),
(438, 'pieza(s)'),
(439, 'piscina(s)'),
(440, 'pizarra(s)'),
(441, 'plan(es)'),
(442, 'planilla(s)'),
(443, 'plano(s)'),
(444, 'planta(s)'),
(445, 'plantación(es)'),
(446, 'plantilla(s)'),
(447, 'plántula(s)'),
(448, 'plataforma(s)'),
(449, 'plataforma(s) satelital(s)'),
(450, 'plataforma(s) tecnológica(s)'),
(451, 'pliego(s)'),
(452, 'población(es)'),
(453, 'policía(s)'),
(454, 'policia(s) militar(es)'),
(455, 'política(s)'),
(456, 'póliza(s)'),
(457, 'ponencia(s)'),
(458, 'portal(es)'),
(459, 'post producción(es)'),
(460, 'potestad(es) investigativa(s)'),
(461, 'pozo(s)'),
(462, 'pre producción(es)'),
(463, 'premio(s)'),
(464, 'presentación(es)'),
(465, 'previsión(es)'),
(466, 'proceso(s)'),
(467, 'producción(es)'),
(468, 'producto(s)'),
(469, 'programa(s)'),
(470, 'promoción(es)'),
(471, 'prototipo(s)'),
(472, 'providencia(s)'),
(473, 'provisión(es)'),
(474, 'proyecto(s) de investigación'),
(475, 'prueba(s)'),
(476, 'publicación(es)'),
(477, 'público(s)'),
(478, 'pueblo(s)'),
(479, 'puente(s)'),
(480, 'puerto(s)'),
(481, 'puesto(s)'),
(482, 'punto(s) de acceso'),
(483, 'punto(s) de cuenta'),
(484, 'punto(s) de información'),
(485, 'punto(s) geodésico'),
(486, 'pupitre(s)'),
(487, 'quirófano(s)'),
(488, 'ración(es)'),
(489, 'radio(s)'),
(490, 'radio(s) base'),
(491, 'radiografía(s)'),
(492, 'rastreo(s)'),
(493, 'récipe(s)'),
(494, 'reconocimiento(s)'),
(495, 'recurso(s)'),
(496, 'red(es)'),
(497, 'red(es) portátil(es)'),
(498, 'reestructuración(es)'),
(499, 'refinación(es)'),
(500, 'reforestación(es)'),
(501, 'registro(s)'),
(502, 'registro(s) contable(s)'),
(503, 'reglamento(s)'),
(504, 'reintegro(s)'),
(505, 'reparación(es)'),
(506, 'reportaje(s)'),
(507, 'reporte(s)'),
(508, 'repuesto(s)'),
(509, 'requisa(s)'),
(510, 'requisición(es)'),
(511, 'reseña(s)'),
(512, 'reservista(s)'),
(513, 'resma(s)'),
(514, 'resolución(es)'),
(515, 'restauración(es)'),
(516, 'retiro(s)'),
(517, 'retrato(s)'),
(518, 'retribución(es)'),
(519, 'reunión(es)'),
(520, 'revista(s)'),
(521, 'revolución(es) por minuto'),
(522, 'rodaje(s)'),
(523, 'rollo(s)'),
(524, 'rubro(s)'),
(525, 'rueda(s) de prensa'),
(526, 'sabana(s)'),
(527, 'saco(s)'),
(528, 'sala(s)'),
(529, 'salud'),
(530, 'saneamiento(s)'),
(531, 'satélite(s)'),
(532, 'sección(es)'),
(533, 'seccional(es)'),
(534, 'sede(s)'),
(535, 'segundo(s)'),
(536, 'sello(s)'),
(537, 'semilla(s)'),
(538, 'seminario(s)'),
(539, 'sensor(es)'),
(540, 'sentencia(s)'),
(541, 'señalización(es)'),
(542, 'servicio(s)'),
(543, 'servidor(es)'),
(544, 'silla(s)'),
(545, 'silla(s) de rueda(s)'),
(546, 'silo(s)'),
(547, 'simposio(s)'),
(548, 'sistema(s)'),
(549, 'sistema(s) de agregación'),
(550, 'sistema(s) de riego'),
(551, 'sistema(s) Fotovoltaíco(s)'),
(552, 'sistema(s) Híbrido(s)'),
(553, 'sobre(s)'),
(554, 'software(s)'),
(555, 'solicitud(es)'),
(556, 'solución(es)'),
(557, 'subscripción(es)'),
(558, 'subsidio(s)'),
(559, 'subvención(es)'),
(560, 'supervisión(es)'),
(561, 'supervisor(es)'),
(562, 'suplemento(s)'),
(563, 'suscripción(es)'),
(564, 'suscriptor(es)'),
(565, 'taller(es)'),
(566, 'talonario(s)'),
(567, 'tambor(es)'),
(568, 'técnico(s)'),
(569, 'tecnología(s)'),
(570, 'télefono(s)'),
(571, 'telex'),
(572, 'tendido(s)'),
(573, 'terabyte(s)'),
(574, 'terreno(s)'),
(575, 'tiempo(s)'),
(576, 'tienda(s)'),
(577, 'tipiaje(s)'),
(578, 'tiraje(s)'),
(579, 'título(s)'),
(580, 'tonelada(s)'),
(581, 'tonelada(s) métrica'),
(582, 'topónimo(s)'),
(583, 'tornero(s)'),
(584, 'trailer(es)'),
(585, 'trámite(s)'),
(586, 'tramo(s)'),
(587, 'transferencia(s)'),
(588, 'transmisor(es)'),
(589, 'transplante(s)'),
(590, 'traslado(s)'),
(591, 'tratado(s)'),
(592, 'tratamiento(s)'),
(593, 'tribunal(es)'),
(594, 'trofeo(s)'),
(595, 'tubo(s)'),
(596, 'unidad(es)'),
(597, 'unidad(es) curricular(es)'),
(598, 'unidad(es) de defensa'),
(599, 'unidad(es) de quimioterapia'),
(600, 'uniforme(s)'),
(601, 'usuario(s)'),
(602, 'vacuna(s)'),
(603, 'valija(s)'),
(604, 'valla(s)'),
(605, 'vehículo(s)'),
(606, 'viaje(s)'),
(607, 'video(s)'),
(608, 'video-conferencia(s)'),
(609, 'video-llamada(s)'),
(610, 'vigilancia(s)'),
(611, 'visa(s)'),
(612, 'visita(s)'),
(613, 'vivero(s)'),
(614, 'vivienda(s)'),
(615, 'volumen(es)'),
(616, 'volumen(es) de Tráfico Telefónico (Erlang)'),
(617, 'votante(s)'),
(618, 'yacimiento(s)'),
(619, 'yarda(s)'),
(620, 'zapato(s)'),
(621, 'zona(s)'),
(622, 'zoológico(s)');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_accounts`
--

CREATE TABLE `user_accounts` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `auth_key` varchar(255) NOT NULL,
  `administrator` int(11) DEFAULT NULL,
  `creator` int(11) DEFAULT NULL,
  `creator_ip` varchar(40) DEFAULT NULL,
  `confirm_token` varchar(255) DEFAULT NULL,
  `recovery_token` varchar(255) DEFAULT NULL,
  `blocked_at` int(11) DEFAULT NULL,
  `confirmed_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user_accounts`
--

INSERT INTO `user_accounts` (`id`, `login`, `username`, `password_hash`, `auth_key`, `administrator`, `creator`, `creator_ip`, `confirm_token`, `recovery_token`, `blocked_at`, `confirmed_at`, `created_at`, `updated_at`) VALUES
(1, 'catu52@gmail.com', 'admin', '$2y$13$93TebP1Z2QcqANsVIzAwrON2lrPaFFXqUoJswU0VHa63avQoNS6G6', '', 1, -2, 'Local', NULL, NULL, NULL, 1449790220, 1449790220, 1449864304),
(2, 'antonioluismonasterio@gmail.com', 'antonio', '$2y$13$uRtF0rjXFE4jX1RIQ3kIqOBhEKjPzGBJp1zf20M04v8mYmNihVSBe', '', 0, 1, '127.0.0.1', NULL, NULL, NULL, 1449848097, 1449848097, 1466698373),
(3, 'walter86_79@hotmail.com', 'soulip', '$2y$13$UjYRjClQAEpe2OzeogsZoederx9EgVItIQCy5bNrV0xz8vQWDI3DS', '', 0, 1, '127.0.0.1', NULL, NULL, NULL, 1454610570, 1454610571, 1458107096);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `accion_centralizada`
--
ALTER TABLE `accion_centralizada`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `accion_centralizada_accion_especifica`
--
ALTER TABLE `accion_centralizada_accion_especifica`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ac_centr` (`id_ac_centr`);

--
-- Indices de la tabla `accion_centralizada_ac_especifica_uej`
--
ALTER TABLE `accion_centralizada_ac_especifica_uej`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ue` (`id_ue`),
  ADD KEY `id_v` (`id_ac_esp`);

--
-- Indices de la tabla `accion_centralizada_asignar`
--
ALTER TABLE `accion_centralizada_asignar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `unidad_ejecutora` (`unidad_ejecutora`),
  ADD KEY `accion_especifica` (`accion_especifica`);

--
-- Indices de la tabla `accion_centralizada_desbloqueo_mes`
--
ALTER TABLE `accion_centralizada_desbloqueo_mes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ejecucion` (`id_ejecucion`);

--
-- Indices de la tabla `accion_centralizada_pedido`
--
ALTER TABLE `accion_centralizada_pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_material` (`id_material`),
  ADD KEY `asignado` (`asignado`);

--
-- Indices de la tabla `accion_centralizada_variables`
--
ALTER TABLE `accion_centralizada_variables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `unidad_medida_2` (`unidad_medida`),
  ADD KEY `localizacion` (`localizacion`),
  ADD KEY `meta_programada_variable` (`meta_programada_variable`),
  ADD KEY `unidad_ejecutora` (`unidad_ejecutora`),
  ADD KEY `acc_accion_especifica` (`acc_accion_especifica`);

--
-- Indices de la tabla `accion_centralizada_variables_usuarios`
--
ALTER TABLE `accion_centralizada_variables_usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_variable` (`id_variable`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `accion_centralizada_variable_ejecucion`
--
ALTER TABLE `accion_centralizada_variable_ejecucion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_programacion` (`id_programacion`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `accion_centralizada_variable_programacion`
--
ALTER TABLE `accion_centralizada_variable_programacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_localizacion` (`id_localizacion`);

--
-- Indices de la tabla `ambito`
--
ALTER TABLE `ambito`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `audit_data`
--
ALTER TABLE `audit_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_audit_data_entry_id` (`entry_id`);

--
-- Indices de la tabla `audit_entry`
--
ALTER TABLE `audit_entry`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_route` (`route`);

--
-- Indices de la tabla `audit_error`
--
ALTER TABLE `audit_error`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_audit_error_entry_id` (`entry_id`),
  ADD KEY `idx_file` (`file`(180)),
  ADD KEY `idx_emailed` (`emailed`);

--
-- Indices de la tabla `audit_javascript`
--
ALTER TABLE `audit_javascript`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_audit_javascript_entry_id` (`entry_id`);

--
-- Indices de la tabla `audit_mail`
--
ALTER TABLE `audit_mail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_audit_mail_entry_id` (`entry_id`);

--
-- Indices de la tabla `audit_trail`
--
ALTER TABLE `audit_trail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_audit_trail_entry_id` (`entry_id`),
  ADD KEY `idx_audit_user_id` (`user_id`),
  ADD KEY `idx_audit_trail_field` (`model`,`model_id`,`field`),
  ADD KEY `idx_audit_trail_action` (`action`);

--
-- Indices de la tabla `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Indices de la tabla `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indices de la tabla `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indices de la tabla `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indices de la tabla `cuenta_presupuestaria`
--
ALTER TABLE `cuenta_presupuestaria`
  ADD PRIMARY KEY (`cuenta`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pais` (`id_pais`);

--
-- Indices de la tabla `estatus_proyecto`
--
ALTER TABLE `estatus_proyecto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `fuente_financiamiento`
--
ALTER TABLE `fuente_financiamiento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `instancia_institucion`
--
ALTER TABLE `instancia_institucion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `localizacion_acc_variable`
--
ALTER TABLE `localizacion_acc_variable`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_variable` (`id_variable`),
  ADD KEY `id_pais` (`id_pais`),
  ADD KEY `id_estado` (`id_estado`),
  ADD KEY `id_municipio` (`id_municipio`),
  ADD KEY `id_parroquia` (`id_parroquia`);

--
-- Indices de la tabla `materiales_servicios`
--
ALTER TABLE `materiales_servicios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cuenta` (`cuenta`,`partida`,`generica`,`especifica`,`subespecifica`),
  ADD KEY `unidad_medida` (`unidad_medida`),
  ADD KEY `presentacion` (`presentacion`);

--
-- Indices de la tabla `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `modelhistory`
--
ALTER TABLE `modelhistory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-table` (`table`),
  ADD KEY `idx-field_name` (`field_name`),
  ADD KEY `idx-type` (`type`),
  ADD KEY `idx-user_id` (`user_id`);

--
-- Indices de la tabla `municipio`
--
ALTER TABLE `municipio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_estado` (`id_estado`);

--
-- Indices de la tabla `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `objetivos_estrategicos`
--
ALTER TABLE `objetivos_estrategicos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `directriz` (`objetivo_nacional`);

--
-- Indices de la tabla `objetivos_generales`
--
ALTER TABLE `objetivos_generales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estrategia` (`objetivo_estrategico`);

--
-- Indices de la tabla `objetivos_historicos`
--
ALTER TABLE `objetivos_historicos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `objetivos_nacionales`
--
ALTER TABLE `objetivos_nacionales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `directriz` (`objetivo_historico`);

--
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `parroquia`
--
ALTER TABLE `parroquia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_municipio` (`id_municipio`);

--
-- Indices de la tabla `partida_especifica`
--
ALTER TABLE `partida_especifica`
  ADD PRIMARY KEY (`cuenta`,`partida`,`generica`,`especifica`) USING BTREE;

--
-- Indices de la tabla `partida_generica`
--
ALTER TABLE `partida_generica`
  ADD PRIMARY KEY (`cuenta`,`partida`,`generica`) USING BTREE;

--
-- Indices de la tabla `partida_partida`
--
ALTER TABLE `partida_partida`
  ADD PRIMARY KEY (`cuenta`,`partida`) USING BTREE,
  ADD KEY `ramo` (`cuenta`);

--
-- Indices de la tabla `partida_sub_especifica`
--
ALTER TABLE `partida_sub_especifica`
  ADD PRIMARY KEY (`cuenta`,`partida`,`generica`,`especifica`,`subespecifica`) USING BTREE;

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_accounts` (`user_accounts`);

--
-- Indices de la tabla `plan_operativo`
--
ALTER TABLE `plan_operativo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `presentacion`
--
ALTER TABLE `presentacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `programacion_fisica_presupuestaria`
--
ALTER TABLE `programacion_fisica_presupuestaria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_programacion_fisica_presupuestaria_1_idx` (`tipo_distribucion`),
  ADD KEY `fk_programacion_fisica_presupuestaria_2_idx` (`id_proyecto_accion_especifica`);

--
-- Indices de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo_proyecto_UNIQUE` (`codigo_proyecto`),
  ADD UNIQUE KEY `codigo_sne_UNIQUE` (`codigo_sne`),
  ADD KEY `estatus_proyecto_fk` (`estatus_proyecto`),
  ADD KEY `situacion_presupuestaria_fk` (`situacion_presupuestaria`),
  ADD KEY `clasificacion_sector_fk` (`sector`) USING BTREE,
  ADD KEY `sub_sector_fk` (`sub_sector`) USING BTREE,
  ADD KEY `plan_operativo_fk` (`plan_operativo`) USING BTREE,
  ADD KEY `objetivo_general_fk` (`objetivo_general`) USING BTREE,
  ADD KEY `ambito_fk` (`ambito`) USING BTREE;

--
-- Indices de la tabla `proyecto_accion_especifica`
--
ALTER TABLE `proyecto_accion_especifica`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_accion_especifica_proyecto_1_idx` (`id_proyecto`),
  ADD KEY `fk_accion_especifica_proyecto_2_idx` (`id_unidad_ejecutora`),
  ADD KEY `unidad_medida` (`unidad_medida`);

--
-- Indices de la tabla `proyecto_alcance`
--
ALTER TABLE `proyecto_alcance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_proyecto` (`id_proyecto`);

--
-- Indices de la tabla `proyecto_asignar`
--
ALTER TABLE `proyecto_asignar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `proyecto_asignar_unico` (`usuario`,`unidad_ejecutora`,`accion_especifica`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `unidad_ejecutora` (`unidad_ejecutora`),
  ADD KEY `accion_especifica` (`accion_especifica`);

--
-- Indices de la tabla `proyecto_distribucion_presupuestaria`
--
ALTER TABLE `proyecto_distribucion_presupuestaria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_accion_especifica` (`id_accion_especifica`),
  ADD KEY `id_partida` (`id_partida`);

--
-- Indices de la tabla `proyecto_fuente_financiamiento`
--
ALTER TABLE `proyecto_fuente_financiamiento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proyecto_localizacion`
--
ALTER TABLE `proyecto_localizacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estados_fk_idx` (`id_estado`),
  ADD KEY `municipio_fk_idx` (`id_municipio`),
  ADD KEY `parroquia_fk_idx` (`id_parroquia`),
  ADD KEY `proyecto_fk_idx` (`id_proyecto`),
  ADD KEY `id_pais` (`id_pais`);

--
-- Indices de la tabla `proyecto_pedido`
--
ALTER TABLE `proyecto_pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_material` (`id_material`),
  ADD KEY `asignado` (`asignado`);

--
-- Indices de la tabla `proyecto_registrador`
--
ALTER TABLE `proyecto_registrador`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_proyecto` (`id_proyecto`);

--
-- Indices de la tabla `proyecto_responsable`
--
ALTER TABLE `proyecto_responsable`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proyecto_fk` (`id_proyecto`);

--
-- Indices de la tabla `proyecto_responsable_administrativo`
--
ALTER TABLE `proyecto_responsable_administrativo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_proyecto_idx` (`id_proyecto`);

--
-- Indices de la tabla `proyecto_responsable_tecnico`
--
ALTER TABLE `proyecto_responsable_tecnico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_proyecto_fk` (`id_proyecto`);

--
-- Indices de la tabla `responsable_acc_variable`
--
ALTER TABLE `responsable_acc_variable`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_variable` (`id_variable`);

--
-- Indices de la tabla `sector`
--
ALTER TABLE `sector`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `situacion_presupuestaria`
--
ALTER TABLE `situacion_presupuestaria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sub_sector`
--
ALTER TABLE `sub_sector`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_distribucion`
--
ALTER TABLE `tipo_distribucion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_financiamiento`
--
ALTER TABLE `tipo_financiamiento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `unidad_ejecutora`
--
ALTER TABLE `unidad_ejecutora`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo_ue_UNIQUE` (`codigo_ue`);

--
-- Indices de la tabla `unidad_medida`
--
ALTER TABLE `unidad_medida`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user_accounts`
--
ALTER TABLE `user_accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_unique_login` (`login`),
  ADD UNIQUE KEY `user_unique_username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `accion_centralizada`
--
ALTER TABLE `accion_centralizada`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `accion_centralizada_accion_especifica`
--
ALTER TABLE `accion_centralizada_accion_especifica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `accion_centralizada_ac_especifica_uej`
--
ALTER TABLE `accion_centralizada_ac_especifica_uej`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=235;
--
-- AUTO_INCREMENT de la tabla `accion_centralizada_asignar`
--
ALTER TABLE `accion_centralizada_asignar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `accion_centralizada_desbloqueo_mes`
--
ALTER TABLE `accion_centralizada_desbloqueo_mes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `accion_centralizada_pedido`
--
ALTER TABLE `accion_centralizada_pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `accion_centralizada_variables`
--
ALTER TABLE `accion_centralizada_variables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT de la tabla `accion_centralizada_variables_usuarios`
--
ALTER TABLE `accion_centralizada_variables_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT de la tabla `accion_centralizada_variable_ejecucion`
--
ALTER TABLE `accion_centralizada_variable_ejecucion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT de la tabla `accion_centralizada_variable_programacion`
--
ALTER TABLE `accion_centralizada_variable_programacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT de la tabla `ambito`
--
ALTER TABLE `ambito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `audit_data`
--
ALTER TABLE `audit_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `audit_entry`
--
ALTER TABLE `audit_entry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `audit_error`
--
ALTER TABLE `audit_error`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `audit_javascript`
--
ALTER TABLE `audit_javascript`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `audit_mail`
--
ALTER TABLE `audit_mail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `audit_trail`
--
ALTER TABLE `audit_trail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=274;
--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT de la tabla `estatus_proyecto`
--
ALTER TABLE `estatus_proyecto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `fuente_financiamiento`
--
ALTER TABLE `fuente_financiamiento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `instancia_institucion`
--
ALTER TABLE `instancia_institucion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `localizacion_acc_variable`
--
ALTER TABLE `localizacion_acc_variable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT de la tabla `materiales_servicios`
--
ALTER TABLE `materiales_servicios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT de la tabla `modelhistory`
--
ALTER TABLE `modelhistory`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `municipio`
--
ALTER TABLE `municipio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `objetivos_estrategicos`
--
ALTER TABLE `objetivos_estrategicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;
--
-- AUTO_INCREMENT de la tabla `objetivos_generales`
--
ALTER TABLE `objetivos_generales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT de la tabla `objetivos_historicos`
--
ALTER TABLE `objetivos_historicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `objetivos_nacionales`
--
ALTER TABLE `objetivos_nacionales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `parroquia`
--
ALTER TABLE `parroquia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `plan_operativo`
--
ALTER TABLE `plan_operativo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `presentacion`
--
ALTER TABLE `presentacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000000;
--
-- AUTO_INCREMENT de la tabla `proyecto_accion_especifica`
--
ALTER TABLE `proyecto_accion_especifica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT de la tabla `proyecto_alcance`
--
ALTER TABLE `proyecto_alcance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `proyecto_asignar`
--
ALTER TABLE `proyecto_asignar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `proyecto_distribucion_presupuestaria`
--
ALTER TABLE `proyecto_distribucion_presupuestaria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `proyecto_fuente_financiamiento`
--
ALTER TABLE `proyecto_fuente_financiamiento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `proyecto_localizacion`
--
ALTER TABLE `proyecto_localizacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `proyecto_pedido`
--
ALTER TABLE `proyecto_pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `proyecto_registrador`
--
ALTER TABLE `proyecto_registrador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `proyecto_responsable`
--
ALTER TABLE `proyecto_responsable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `proyecto_responsable_administrativo`
--
ALTER TABLE `proyecto_responsable_administrativo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `proyecto_responsable_tecnico`
--
ALTER TABLE `proyecto_responsable_tecnico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `responsable_acc_variable`
--
ALTER TABLE `responsable_acc_variable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de la tabla `sector`
--
ALTER TABLE `sector`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `situacion_presupuestaria`
--
ALTER TABLE `situacion_presupuestaria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `sub_sector`
--
ALTER TABLE `sub_sector`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tipo_distribucion`
--
ALTER TABLE `tipo_distribucion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tipo_financiamiento`
--
ALTER TABLE `tipo_financiamiento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `unidad_ejecutora`
--
ALTER TABLE `unidad_ejecutora`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=688;
--
-- AUTO_INCREMENT de la tabla `unidad_medida`
--
ALTER TABLE `unidad_medida`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=623;
--
-- AUTO_INCREMENT de la tabla `user_accounts`
--
ALTER TABLE `user_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `accion_centralizada_accion_especifica`
--
ALTER TABLE `accion_centralizada_accion_especifica`
  ADD CONSTRAINT `frk_ac_acesp` FOREIGN KEY (`id_ac_centr`) REFERENCES `accion_centralizada` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `accion_centralizada_ac_especifica_uej`
--
ALTER TABLE `accion_centralizada_ac_especifica_uej`
  ADD CONSTRAINT `frk_acesp` FOREIGN KEY (`id_ac_esp`) REFERENCES `accion_centralizada_accion_especifica` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `frk_uej_acesp` FOREIGN KEY (`id_ue`) REFERENCES `unidad_ejecutora` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `accion_centralizada_asignar`
--
ALTER TABLE `accion_centralizada_asignar`
  ADD CONSTRAINT `accion_centralizada_asignar_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `user_accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `accion_centralizada_asignar_ibfk_2` FOREIGN KEY (`unidad_ejecutora`) REFERENCES `unidad_ejecutora` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `accion_centralizada_asignar_ibfk_3` FOREIGN KEY (`accion_especifica`) REFERENCES `accion_centralizada_accion_especifica` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `accion_centralizada_desbloqueo_mes`
--
ALTER TABLE `accion_centralizada_desbloqueo_mes`
  ADD CONSTRAINT `frkey_ejecucion_mes` FOREIGN KEY (`id_ejecucion`) REFERENCES `accion_centralizada_variable_ejecucion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `accion_centralizada_pedido`
--
ALTER TABLE `accion_centralizada_pedido`
  ADD CONSTRAINT `frk_asignada_centralpedido` FOREIGN KEY (`asignado`) REFERENCES `accion_centralizada_asignar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `frk_materiales_centralpedido` FOREIGN KEY (`id_material`) REFERENCES `materiales_servicios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `accion_centralizada_variables`
--
ALTER TABLE `accion_centralizada_variables`
  ADD CONSTRAINT `frk_uej_variable` FOREIGN KEY (`unidad_ejecutora`) REFERENCES `unidad_ejecutora` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `frk_unidad_medida_variable` FOREIGN KEY (`unidad_medida`) REFERENCES `unidad_medida` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `accion_centralizada_variables_usuarios`
--
ALTER TABLE `accion_centralizada_variables_usuarios`
  ADD CONSTRAINT `frk_user_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `user_accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `frk_variable_usuario` FOREIGN KEY (`id_variable`) REFERENCES `accion_centralizada_variables` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `accion_centralizada_variable_ejecucion`
--
ALTER TABLE `accion_centralizada_variable_ejecucion`
  ADD CONSTRAINT `frk_programacion_ejecucion` FOREIGN KEY (`id_programacion`) REFERENCES `accion_centralizada_variable_programacion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `frk_user_ejecucion` FOREIGN KEY (`id_usuario`) REFERENCES `user_accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `accion_centralizada_variable_programacion`
--
ALTER TABLE `accion_centralizada_variable_programacion`
  ADD CONSTRAINT `frk-programacion-localizacion` FOREIGN KEY (`id_localizacion`) REFERENCES `localizacion_acc_variable` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `audit_data`
--
ALTER TABLE `audit_data`
  ADD CONSTRAINT `fk_audit_data_entry_id` FOREIGN KEY (`entry_id`) REFERENCES `audit_entry` (`id`);

--
-- Filtros para la tabla `audit_error`
--
ALTER TABLE `audit_error`
  ADD CONSTRAINT `fk_audit_error_entry_id` FOREIGN KEY (`entry_id`) REFERENCES `audit_entry` (`id`);

--
-- Filtros para la tabla `audit_javascript`
--
ALTER TABLE `audit_javascript`
  ADD CONSTRAINT `fk_audit_javascript_entry_id` FOREIGN KEY (`entry_id`) REFERENCES `audit_entry` (`id`);

--
-- Filtros para la tabla `audit_mail`
--
ALTER TABLE `audit_mail`
  ADD CONSTRAINT `fk_audit_mail_entry_id` FOREIGN KEY (`entry_id`) REFERENCES `audit_entry` (`id`);

--
-- Filtros para la tabla `audit_trail`
--
ALTER TABLE `audit_trail`
  ADD CONSTRAINT `fk_audit_trail_entry_id` FOREIGN KEY (`entry_id`) REFERENCES `audit_entry` (`id`);

--
-- Filtros para la tabla `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `localizacion_acc_variable`
--
ALTER TABLE `localizacion_acc_variable`
  ADD CONSTRAINT `frk_acc_variable_localizacion` FOREIGN KEY (`id_variable`) REFERENCES `accion_centralizada_variables` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `frk_estados_variables` FOREIGN KEY (`id_estado`) REFERENCES `estados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `frk_municipio_variable` FOREIGN KEY (`id_municipio`) REFERENCES `municipio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `frk_pais_variable` FOREIGN KEY (`id_pais`) REFERENCES `pais` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `frk_parroquia_variable` FOREIGN KEY (`id_parroquia`) REFERENCES `parroquia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `materiales_servicios`
--
ALTER TABLE `materiales_servicios`
  ADD CONSTRAINT `frk_pre_materiales` FOREIGN KEY (`presentacion`) REFERENCES `presentacion` (`id`),
  ADD CONSTRAINT `frk_um_materiales` FOREIGN KEY (`unidad_medida`) REFERENCES `unidad_medida` (`id`),
  ADD CONSTRAINT `materiales_servicios_ibfk_1` FOREIGN KEY (`cuenta`,`partida`,`generica`,`especifica`,`subespecifica`) REFERENCES `partida_sub_especifica` (`cuenta`, `partida`, `generica`, `especifica`, `subespecifica`);

--
-- Filtros para la tabla `objetivos_generales`
--
ALTER TABLE `objetivos_generales`
  ADD CONSTRAINT `objetivos_generales_ibfk_1` FOREIGN KEY (`objetivo_estrategico`) REFERENCES `objetivos_estrategicos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `partida_especifica`
--
ALTER TABLE `partida_especifica`
  ADD CONSTRAINT `partida_especifica_ibfk_1` FOREIGN KEY (`cuenta`,`partida`,`generica`) REFERENCES `partida_generica` (`cuenta`, `partida`, `generica`);

--
-- Filtros para la tabla `partida_generica`
--
ALTER TABLE `partida_generica`
  ADD CONSTRAINT `partida_generica_ibfk_1` FOREIGN KEY (`cuenta`,`partida`) REFERENCES `partida_partida` (`cuenta`, `partida`);

--
-- Filtros para la tabla `partida_partida`
--
ALTER TABLE `partida_partida`
  ADD CONSTRAINT `partida_partida_ibfk_1` FOREIGN KEY (`cuenta`) REFERENCES `cuenta_presupuestaria` (`cuenta`);

--
-- Filtros para la tabla `partida_sub_especifica`
--
ALTER TABLE `partida_sub_especifica`
  ADD CONSTRAINT `partida_sub_especifica_ibfk_1` FOREIGN KEY (`cuenta`,`partida`,`generica`,`especifica`) REFERENCES `partida_especifica` (`cuenta`, `partida`, `generica`, `especifica`);

--
-- Filtros para la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD CONSTRAINT `user_accounts_idfk` FOREIGN KEY (`user_accounts`) REFERENCES `user_accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `programacion_fisica_presupuestaria`
--
ALTER TABLE `programacion_fisica_presupuestaria`
  ADD CONSTRAINT `fk_programacion_fisica_presupuestaria_1` FOREIGN KEY (`tipo_distribucion`) REFERENCES `tipo_distribucion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `proyecto_accion_especifica`
--
ALTER TABLE `proyecto_accion_especifica`
  ADD CONSTRAINT `fk_accion_especifica_proyecto_1` FOREIGN KEY (`id_proyecto`) REFERENCES `proyecto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_accion_especifica_proyecto_2` FOREIGN KEY (`id_unidad_ejecutora`) REFERENCES `unidad_ejecutora` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `proyecto_alcance`
--
ALTER TABLE `proyecto_alcance`
  ADD CONSTRAINT `proyecto_alcance_ibfk_1` FOREIGN KEY (`id_proyecto`) REFERENCES `proyecto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `proyecto_asignar`
--
ALTER TABLE `proyecto_asignar`
  ADD CONSTRAINT `proyecto_asignar_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `user_accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `proyecto_asignar_ibfk_2` FOREIGN KEY (`unidad_ejecutora`) REFERENCES `unidad_ejecutora` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `proyecto_asignar_ibfk_3` FOREIGN KEY (`accion_especifica`) REFERENCES `proyecto_accion_especifica` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `proyecto_distribucion_presupuestaria`
--
ALTER TABLE `proyecto_distribucion_presupuestaria`
  ADD CONSTRAINT `id_accion_especifica_fk` FOREIGN KEY (`id_accion_especifica`) REFERENCES `proyecto_accion_especifica` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `proyecto_localizacion`
--
ALTER TABLE `proyecto_localizacion`
  ADD CONSTRAINT `estado_fk` FOREIGN KEY (`id_estado`) REFERENCES `estados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `municipio_fk` FOREIGN KEY (`id_municipio`) REFERENCES `municipio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `parroquia_fk` FOREIGN KEY (`id_parroquia`) REFERENCES `parroquia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `proyecto_fk` FOREIGN KEY (`id_proyecto`) REFERENCES `proyecto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `proyecto_pedido`
--
ALTER TABLE `proyecto_pedido`
  ADD CONSTRAINT `frk_asignado_pedido` FOREIGN KEY (`asignado`) REFERENCES `proyecto_asignar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `frk_materiales_pedido` FOREIGN KEY (`id_material`) REFERENCES `materiales_servicios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `proyecto_registrador`
--
ALTER TABLE `proyecto_registrador`
  ADD CONSTRAINT `proyecto_registrador_ibfk_1` FOREIGN KEY (`id_proyecto`) REFERENCES `proyecto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `proyecto_responsable`
--
ALTER TABLE `proyecto_responsable`
  ADD CONSTRAINT `fk_responsable_proyecto_1` FOREIGN KEY (`id_proyecto`) REFERENCES `proyecto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `proyecto_responsable_administrativo`
--
ALTER TABLE `proyecto_responsable_administrativo`
  ADD CONSTRAINT `idx_id_proyecto_fk` FOREIGN KEY (`id_proyecto`) REFERENCES `proyecto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `proyecto_responsable_tecnico`
--
ALTER TABLE `proyecto_responsable_tecnico`
  ADD CONSTRAINT `fk_id_proyecto` FOREIGN KEY (`id_proyecto`) REFERENCES `proyecto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `responsable_acc_variable`
--
ALTER TABLE `responsable_acc_variable`
  ADD CONSTRAINT `frk_acc_variable_responsable` FOREIGN KEY (`id_variable`) REFERENCES `accion_centralizada_variables` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
