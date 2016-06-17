-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-06-2016 a las 11:19:10
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `rsc`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accion_centralizada`
--

CREATE TABLE IF NOT EXISTS `accion_centralizada` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_accion` varchar(45) NOT NULL,
  `codigo_accion_sne` varchar(45) NOT NULL,
  `nombre_accion` varchar(45) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `estatus` tinyint(1) NOT NULL,
  `aprobado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `accion_centralizada`
--

INSERT INTO `accion_centralizada` (`id`, `codigo_accion`, `codigo_accion_sne`, `nombre_accion`, `fecha_inicio`, `fecha_fin`, `estatus`, `aprobado`) VALUES
(3, '01', '01', 'probando', '2016-04-01', '2016-04-30', 1, 1),
(4, '002', '002', 'probando4', '2016-06-01', '2016-06-30', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accion_centralizada_accion_especifica`
--

CREATE TABLE IF NOT EXISTS `accion_centralizada_accion_especifica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ac_centr` int(11) NOT NULL,
  `cod_ac_espe` varchar(3) NOT NULL,
  `nombre` text NOT NULL,
  `estatus` tinyint(1) NOT NULL,
  `fecha_inicio` date NOT NULL COMMENT 'fecha de inicio de la acciones especifica',
  `fecha_fin` date NOT NULL COMMENT 'fecha fin de la accion especifica',
  PRIMARY KEY (`id`),
  KEY `id_ac_centr` (`id_ac_centr`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `accion_centralizada_accion_especifica`
--

INSERT INTO `accion_centralizada_accion_especifica` (`id`, `id_ac_centr`, `cod_ac_espe`, `nombre`, `estatus`, `fecha_inicio`, `fecha_fin`) VALUES
(7, 3, '01', 'probando', 1, '2016-04-01', '2016-04-30'),
(8, 3, '8', 'probando codigo 08', 1, '2016-06-01', '2016-06-30'),
(9, 4, '04', 'probnado5', 1, '2016-06-01', '2016-06-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accion_centralizada_ac_especifica_uej`
--

CREATE TABLE IF NOT EXISTS `accion_centralizada_ac_especifica_uej` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ue` int(11) NOT NULL,
  `id_ac_esp` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_ue` (`id_ue`),
  KEY `id_v` (`id_ac_esp`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=239 ;

--
-- Volcado de datos para la tabla `accion_centralizada_ac_especifica_uej`
--

INSERT INTO `accion_centralizada_ac_especifica_uej` (`id`, `id_ue`, `id_ac_esp`) VALUES
(233, 600, 7),
(234, 601, 7),
(235, 600, 8),
(236, 601, 8),
(237, 602, 8),
(238, 600, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accion_centralizada_asignar`
--

CREATE TABLE IF NOT EXISTS `accion_centralizada_asignar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` int(11) NOT NULL,
  `unidad_ejecutora` int(11) NOT NULL,
  `accion_especifica` int(11) NOT NULL,
  `estatus` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario` (`usuario`),
  KEY `unidad_ejecutora` (`unidad_ejecutora`),
  KEY `accion_especifica` (`accion_especifica`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Relación entre usuarios, unidades ejecutoras y acciones específicas de una accion centralizada' AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `accion_centralizada_asignar`
--

INSERT INTO `accion_centralizada_asignar` (`id`, `usuario`, `unidad_ejecutora`, `accion_especifica`, `estatus`) VALUES
(3, 2, 600, 7, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accion_centralizada_desbloqueo_mes`
--

CREATE TABLE IF NOT EXISTS `accion_centralizada_desbloqueo_mes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ejecucion` int(11) NOT NULL,
  `mes` int(11) NOT NULL COMMENT 'mes que se desbloquea/bloquea',
  PRIMARY KEY (`id`),
  KEY `id_ejecucion` (`id_ejecucion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accion_centralizada_pedido`
--

CREATE TABLE IF NOT EXISTS `accion_centralizada_pedido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `estatus` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_material` (`id_material`),
  KEY `asignado` (`asignado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accion_centralizada_variables`
--

CREATE TABLE IF NOT EXISTS `accion_centralizada_variables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_variable` text NOT NULL,
  `unidad_medida` int(11) NOT NULL,
  `localizacion` int(11) NOT NULL,
  `definicion` text NOT NULL,
  `base_calculo` text NOT NULL,
  `fuente_informacion` text NOT NULL,
  `meta_programada_variable` int(11) NOT NULL,
  `unidad_ejecutora` int(11) NOT NULL,
  `acc_accion_especifica` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `unidad_medida_2` (`unidad_medida`),
  KEY `localizacion` (`localizacion`),
  KEY `meta_programada_variable` (`meta_programada_variable`),
  KEY `unidad_ejecutora` (`unidad_ejecutora`),
  KEY `acc_accion_especifica` (`acc_accion_especifica`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- Volcado de datos para la tabla `accion_centralizada_variables`
--

INSERT INTO `accion_centralizada_variables` (`id`, `nombre_variable`, `unidad_medida`, `localizacion`, `definicion`, `base_calculo`, `fuente_informacion`, `meta_programada_variable`, `unidad_ejecutora`, `acc_accion_especifica`) VALUES
(31, 'probando variable', 2, 1, 'probando', 'dos', 'dos', 0, 600, 7),
(32, 'probando variables 2', 4, 1, 'probando variables', 'no se', 'no se', 0, 600, 8),
(33, 'probando nacional', 2, 0, 'probando nacional', 'no se', 'probando nacional', 0, 600, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accion_centralizada_variables_usuarios`
--

CREATE TABLE IF NOT EXISTS `accion_centralizada_variables_usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_variable` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id_variable` (`id_variable`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Volcado de datos para la tabla `accion_centralizada_variables_usuarios`
--

INSERT INTO `accion_centralizada_variables_usuarios` (`id`, `id_variable`, `id_usuario`, `estatus`) VALUES
(29, 31, 2, 1),
(30, 32, 2, 1),
(31, 33, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accion_centralizada_variable_ejecucion`
--

CREATE TABLE IF NOT EXISTS `accion_centralizada_variable_ejecucion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_programacion` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
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
  `diciembre` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_programacion` (`id_programacion`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- Volcado de datos para la tabla `accion_centralizada_variable_ejecucion`
--

INSERT INTO `accion_centralizada_variable_ejecucion` (`id`, `id_programacion`, `id_usuario`, `fecha`, `enero`, `febrero`, `marzo`, `abril`, `mayo`, `junio`, `julio`, `agosto`, `septiembre`, `octubre`, `noviembre`, `diciembre`) VALUES
(30, 24, 2, '2016-06-14 15:27:58', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 31, 2, '2016-06-17 14:19:56', 100, 200, 10, 22, 4, 12, NULL, NULL, NULL, NULL, NULL, 300),
(33, 36, 2, '2016-06-17 15:36:07', 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accion_centralizada_variable_programacion`
--

CREATE TABLE IF NOT EXISTS `accion_centralizada_variable_programacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `diciembre` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_localizacion` (`id_localizacion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Volcado de datos para la tabla `accion_centralizada_variable_programacion`
--

INSERT INTO `accion_centralizada_variable_programacion` (`id`, `id_localizacion`, `enero`, `febrero`, `marzo`, `abril`, `mayo`, `junio`, `julio`, `agosto`, `septiembre`, `octubre`, `noviembre`, `diciembre`) VALUES
(24, 46, '2', '2', '2', '0', '10', '0', '0', '0', '0', '0', '0', '12'),
(25, 47, '1', '1', '1', '1', '1', '1', '1', '1', '11', '0', '0', '0'),
(26, 48, '12', '22', '22', '112', '0', '0', '11', '11', '11', '0', '0', '0'),
(29, 51, '10', '12', '10', '6', '8', '9', '0', '20', '0', '0', '0', '0'),
(31, 54, '10', '10', '10', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(36, 59, '1', '2', '0', '0', '0', '0', '0', '3', '0', '0', '0', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ac_variable`
--

CREATE TABLE IF NOT EXISTS `ac_variable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_u_ej` int(11) NOT NULL,
  `nombre_variable` varchar(60) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_ac` (`id_u_ej`),
  KEY `id_ac_esp` (`id_u_ej`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ambito`
--

CREATE TABLE IF NOT EXISTS `ambito` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ambito` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

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

CREATE TABLE IF NOT EXISTS `audit_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entry_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `data` blob,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_audit_data_entry_id` (`entry_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `audit_entry`
--

CREATE TABLE IF NOT EXISTS `audit_entry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `user_id` int(11) DEFAULT '0',
  `duration` float DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `request_method` varchar(16) DEFAULT NULL,
  `ajax` int(1) NOT NULL DEFAULT '0',
  `route` varchar(255) DEFAULT NULL,
  `memory_max` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_user_id` (`user_id`),
  KEY `idx_route` (`route`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=53369 ;

--
-- Volcado de datos para la tabla `audit_entry`
--

INSERT INTO `audit_entry` (`id`, `created`, `user_id`, `duration`, `ip`, `request_method`, `ajax`, `route`, `memory_max`) VALUES
(53347, '2016-06-17 11:18:19', 1, NULL, '127.0.0.1', 'GET', 1, 'notifications/notifications/poll', NULL),
(53348, '2016-06-17 11:18:19', 1, NULL, '127.0.0.1', 'GET', 1, 'notifications/notifications/poll', NULL),
(53349, '2016-06-17 11:18:24', 1, NULL, '127.0.0.1', 'GET', 1, 'notifications/notifications/poll', NULL),
(53350, '2016-06-17 11:18:24', 1, NULL, '127.0.0.1', 'GET', 1, 'notifications/notifications/poll', NULL),
(53351, '2016-06-17 11:18:29', 1, NULL, '127.0.0.1', 'GET', 1, 'notifications/notifications/poll', NULL),
(53352, '2016-06-17 11:18:29', 1, NULL, '127.0.0.1', 'GET', 1, 'notifications/notifications/poll', NULL),
(53353, '2016-06-17 11:18:34', 1, NULL, '127.0.0.1', 'GET', 1, 'notifications/notifications/poll', NULL),
(53354, '2016-06-17 11:18:34', 1, NULL, '127.0.0.1', 'GET', 1, 'notifications/notifications/poll', NULL),
(53355, '2016-06-17 11:18:39', 1, NULL, '127.0.0.1', 'GET', 1, 'notifications/notifications/poll', NULL),
(53356, '2016-06-17 11:18:39', 1, NULL, '127.0.0.1', 'GET', 1, 'notifications/notifications/poll', NULL),
(53357, '2016-06-17 11:18:44', 1, NULL, '127.0.0.1', 'GET', 1, 'notifications/notifications/poll', NULL),
(53358, '2016-06-17 11:18:44', 1, NULL, '127.0.0.1', 'GET', 1, 'notifications/notifications/poll', NULL),
(53359, '2016-06-17 11:18:49', 1, NULL, '127.0.0.1', 'GET', 1, 'notifications/notifications/poll', NULL),
(53360, '2016-06-17 11:18:49', 1, NULL, '127.0.0.1', 'GET', 1, 'notifications/notifications/poll', NULL),
(53361, '2016-06-17 11:18:54', 1, NULL, '127.0.0.1', 'GET', 1, 'notifications/notifications/poll', NULL),
(53362, '2016-06-17 11:18:54', 1, NULL, '127.0.0.1', 'GET', 1, 'notifications/notifications/poll', NULL),
(53363, '2016-06-17 11:18:59', 1, NULL, '127.0.0.1', 'GET', 1, 'notifications/notifications/poll', NULL),
(53364, '2016-06-17 11:18:59', 1, NULL, '127.0.0.1', 'GET', 1, 'notifications/notifications/poll', NULL),
(53365, '2016-06-17 11:19:04', 1, NULL, '127.0.0.1', 'GET', 1, 'notifications/notifications/poll', NULL),
(53366, '2016-06-17 11:19:04', 1, NULL, '127.0.0.1', 'GET', 1, 'notifications/notifications/poll', NULL),
(53367, '2016-06-17 11:19:09', 1, NULL, '127.0.0.1', 'GET', 1, 'notifications/notifications/poll', NULL),
(53368, '2016-06-17 11:19:09', 1, NULL, '127.0.0.1', 'GET', 1, 'notifications/notifications/poll', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `audit_error`
--

CREATE TABLE IF NOT EXISTS `audit_error` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entry_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `message` text NOT NULL,
  `code` int(11) DEFAULT '0',
  `file` varchar(512) DEFAULT NULL,
  `line` int(11) DEFAULT NULL,
  `trace` blob,
  `hash` varchar(32) DEFAULT NULL,
  `emailed` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_audit_error_entry_id` (`entry_id`),
  KEY `idx_file` (`file`(180)),
  KEY `idx_emailed` (`emailed`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `audit_javascript`
--

CREATE TABLE IF NOT EXISTS `audit_javascript` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entry_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `type` varchar(20) NOT NULL,
  `message` text NOT NULL,
  `origin` varchar(512) DEFAULT NULL,
  `data` blob,
  PRIMARY KEY (`id`),
  KEY `fk_audit_javascript_entry_id` (`entry_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `audit_mail`
--

CREATE TABLE IF NOT EXISTS `audit_mail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `data` blob,
  PRIMARY KEY (`id`),
  KEY `fk_audit_mail_entry_id` (`entry_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `audit_trail`
--

CREATE TABLE IF NOT EXISTS `audit_trail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entry_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `model_id` varchar(255) NOT NULL,
  `field` varchar(255) DEFAULT NULL,
  `old_value` text,
  `new_value` text,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_audit_trail_entry_id` (`entry_id`),
  KEY `idx_audit_user_id` (`user_id`),
  KEY `idx_audit_trail_field` (`model`,`model_id`,`field`),
  KEY `idx_audit_trail_action` (`action`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=209 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_assignment`
--

CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('acc_accion_especifica', '1', 1466001492),
('accion_centralizada', '1', 1466001492),
('accion_centralizada', '2', 1465993920),
('accion_centralizada_asignar', '1', 1466001492),
('accion_centralizada_requerimiento', '2', 1465993920),
('accion_centralizada_variable_ejecucion', '1', 1466001492),
('accion_centralizada_variable_ejecucion', '2', 1465993920),
('accion_centralizada_variables', '1', 1466001492),
('accion_centralizada_variables', '2', 1465993920),
('desbloquear_meses_variables', '1', 1466001492),
('gestor_proyecto', '1', 1466001492),
('materiales_servicios', '1', 1466001492),
('proyecto_asignar', '1', 1466001492),
('proyecto_pedido', '1', 1466001492),
('proyecto_pedido', '2', 1465993920),
('registrador_accion_especifica', '1', 1466001492),
('registrador_accion_especifica', '2', 1465993920),
('registrador_accion_especifica', '3', 1454611275),
('registrador_alcance', '1', 1466001492),
('registrador_alcance', '2', 1465993920),
('registrador_alcance', '3', 1454611275),
('registrador_basico', '1', 1466001492),
('registrador_basico', '2', 1465993920),
('registrador_basico', '3', 1454611275),
('registrador_distribucion_presupuestaria', '1', 1466001492),
('registrador_distribucion_presupuestaria', '3', 1454611275),
('sysadmin', '1', 1466001492),
('sysadmin', '3', 1454611275);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_item`
--

CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`)
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
('ac-variable/create', 2, 'crear variables para acciones centralizadas', NULL, NULL, 1455136899, 1455136899),
('ac-variable/delete', 2, 'poder borrar la variable', NULL, NULL, 1455136995, 1455136995),
('ac-variable/index', 2, 'poder ir al inicio del modulo variables ', NULL, NULL, 1455136979, 1455136979),
('ac-variable/update', 2, 'actulizar variables de acciones centralizadas', NULL, NULL, 1455136923, 1455136923),
('ac-variable/view', 2, 'ver el detalle de variable', NULL, NULL, 1455136945, 1455136945),
('acc_accion_especifica', 1, 'Crear, editar y eliminar acciones específicas de ACC', NULL, NULL, 1456113925, 1456114942),
('accion_centralizada', 1, 'ver las acciones centralizadas', NULL, NULL, 1455129653, 1459443467),
('accion_centralizada_asignar', 1, 'Asignar usuarios a Acciones Centralizadas', NULL, NULL, 1459442993, 1459443946),
('accion_centralizada_requerimiento', 1, 'permisos para poder realizar requerimientos de acciones centralizadas', NULL, NULL, 1459774903, 1459788763),
('accion_centralizada_variable_ejecucion', 1, 'poder gestionar las ejecucciones de las variables', NULL, NULL, 1465993762, 1465994345),
('accion_centralizada_variables', 1, 'ver, modificar, eliminar variables', NULL, NULL, 1465215913, 1466174840),
('accion-centralizada-asignar/ace', 2, 'JSON con las Acciones Específicas a asignar', NULL, NULL, 1459443928, 1459443928),
('accion-centralizada-asignar/asignar', 2, 'Asignar usuario a acción específica de ACC', NULL, NULL, 1459443071, 1459443071),
('accion-centralizada-asignar/create', 2, 'Crear asignacion', NULL, NULL, 1459443103, 1459443103),
('accion-centralizada-asignar/delete', 2, 'Eliminar asignacion', NULL, NULL, 1459443147, 1459443147),
('accion-centralizada-asignar/index', 2, 'Lista de asignaciones de usuarios a ACC', NULL, NULL, 1459442945, 1459442945),
('accion-centralizada-asignar/update', 2, 'Modificar asignacion', NULL, NULL, 1459443134, 1459443134),
('accion-centralizada-asignar/view', 2, 'Ver asignacion', NULL, NULL, 1459443115, 1459443115),
('accion-centralizada-desbloqueo-mes/bulk-delete', 2, 'Borrar por lotes los meses desbloqueados', NULL, NULL, 1466173315, 1466175402),
('accion-centralizada-desbloqueo-mes/create', 2, 'crear desbloqueo mes para ejecucion de variable', NULL, NULL, 1465999570, 1465999570),
('accion-centralizada-desbloqueo-mes/delete', 2, 'borrar desbloque mes de ejecucion de variables', NULL, NULL, 1465999596, 1465999596),
('accion-centralizada-desbloqueo-mes/index', 2, 'ver el inical del desbloqueo mes de las ejecciones de variables', NULL, NULL, 1465999477, 1465999477),
('accion-centralizada-desbloqueo-mes/update', 2, 'modificar el mes de bloque', NULL, NULL, 1466006452, 1466006452),
('accion-centralizada-desbloqueo-mes/view', 2, 'ver el detalle del mes de desbloque de variables', NULL, NULL, 1466006480, 1466006480),
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
('accion-centralizada-variable-ejecucion/create', 2, 'permite la ejeccion de las variables', NULL, NULL, 1465994301, 1465994301),
('accion-centralizada-variable-ejecucion/localizacion', 2, 'ver las regiones asociadas a las variables', NULL, NULL, 1465993983, 1465993983),
('accion-centralizada-variable-ejecucion/variables', 2, 'ver las variables asignadas al usuario', NULL, NULL, 1465993548, 1465993548),
('accion-centralizada-variables/ace', 2, 'buscar  accionces especificas relacionadas con la unidad ejecutora y q esten activas', NULL, NULL, 1465216126, 1465216126),
('accion-centralizada-variables/ace1', 2, 'buscar usuarios que tengan asignados la unidad ejecutora y relacionarlos con la variable', NULL, NULL, 1465216159, 1465216159),
('accion-centralizada-variables/bulk-delete', 2, 'borrar por lotes las variables', NULL, NULL, 1465219918, 1465219918),
('accion-centralizada-variables/create', 2, 'crear variables', NULL, NULL, 1465215735, 1465215735),
('accion-centralizada-variables/delete', 2, 'poder borrar variables', NULL, NULL, 1465215767, 1465215767),
('accion-centralizada-variables/index', 2, 'pagina inicio de las variables', NULL, NULL, 1465215694, 1465215694),
('accion-centralizada-variables/update', 2, 'poder modificar las variables', NULL, NULL, 1465215750, 1465215750),
('accion-centralizada-variables/view', 2, 'ver detalles de la variable', NULL, NULL, 1465215780, 1465215780),
('accion-centralizada/create', 2, 'crear acciones centralizadas', NULL, NULL, 1455130416, 1455130416),
('accion-centralizada/delete', 2, 'borrar acciones centralizadas', NULL, NULL, 1455130459, 1455130459),
('accion-centralizada/importar', 2, 'Importar acciones centralizadas', NULL, NULL, 1458862735, 1458862842),
('accion-centralizada/index', 2, 'ver el inicio de acciones centralizadas', NULL, NULL, 1455129506, 1455130004),
('accion-centralizada/update', 2, 'actualizar acciones centralizadas', NULL, NULL, 1455130436, 1455136413),
('accion-centralizada/view', 2, 'ver el detalle de la accion centralizada', NULL, NULL, 1455130492, 1455130492),
('desbloquear_meses_variables', 1, 'permisos para crear, eliminar y ver los meses que han sido desbloqueados de la ejecucion de las variables ', NULL, NULL, 1466001414, 1466173347),
('gestor_proyecto', 1, 'Administrador de proyecto', NULL, NULL, 1456979251, 1456979251),
('localizacion-acc-variable/bulk-delete', 2, 'Borrar por lotes las localizacion de las variables', NULL, NULL, 1466174794, 1466175024),
('localizacion-acc-variable/create', 2, 'creando las localizaciones de las variables', NULL, NULL, 1465216675, 1465216675),
('localizacion-acc-variable/delete', 2, 'borrar las localizaciones de variable', NULL, NULL, 1465216740, 1465216740),
('localizacion-acc-variable/update', 2, 'modificando las localizaciones de las variables', NULL, NULL, 1465216709, 1465216709),
('localizacion-acc-variable/view', 2, 'ver el detalle de la localizacion', NULL, NULL, 1465221236, 1465221236),
('materiales_servicios', 1, 'Crea, modifica y elimina materiales y servicios', NULL, NULL, 1455502889, 1455502889),
('materiales-servicios/create', 2, 'Crear materiales y servicios', NULL, NULL, 1455502798, 1455502798),
('materiales-servicios/delete', 2, 'Eliminar materiales y servicios', NULL, NULL, 1455502828, 1455502828),
('materiales-servicios/index', 2, 'Lista de materiales y servicios', NULL, NULL, 1455502782, 1455502782),
('materiales-servicios/update', 2, 'Modificar materiales y servicios', NULL, NULL, 1455502813, 1455502813),
('proyecto_asignar', 1, 'Gestionar las asignaciones de usuarios a las acciones específicas de un proyecto', NULL, NULL, 1458229165, 1458275288),
('proyecto_pedido', 1, 'Pedidos de materiales y servicios de proyecto', NULL, NULL, 1457400383, 1465223730),
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
('proyecto-asignar/ace', 2, 'Respuesta JSON', NULL, NULL, 1458275263, 1458275263),
('proyecto-asignar/asignar', 2, 'Lista de asignaciones de un usuario a proyecto/acción específica', NULL, NULL, 1458228890, 1458228890),
('proyecto-asignar/bulk-activar', 2, 'Activar múltiples asignaciones de un usuario a proyecto/acción específica', NULL, NULL, 1458229012, 1458229060),
('proyecto-asignar/bulk-delete', 2, 'Eliminar múltiples asignaciones de usuario a proyecto/acción específica', NULL, NULL, 1458228933, 1458228933),
('proyecto-asignar/bulk-desactivar', 2, 'Desactivar múltiples asignaciones de un usuario a proyecto/acción específica', NULL, NULL, 1458229050, 1458229050),
('proyecto-asignar/create', 2, 'Crear asignación de usuario a proyecto/acción específica', NULL, NULL, 1458228779, 1458228779),
('proyecto-asignar/delete', 2, 'Eliminar asignación de usuario a proyecto/acción específica', NULL, NULL, 1458228811, 1458228811),
('proyecto-asignar/index', 2, 'Lista de usuarios asignados a proyectos', NULL, NULL, 1458228739, 1458228739),
('proyecto-asignar/toggle-activo', 2, 'Activar/Desactivar asignación de usuario a proyecto/acción específica', NULL, NULL, 1458228960, 1458228960),
('proyecto-asignar/update', 2, 'Modificar asignación de usuario a proyecto/acción específica', NULL, NULL, 1458228795, 1458228795),
('proyecto-asignar/view', 2, 'Ver asignación de usuario a proyecto/acción específica', NULL, NULL, 1458228845, 1458228845),
('proyecto-distribucion', 2, 'crear la distribucion', NULL, NULL, 1465223368, 1465223368),
('proyecto-distribucion-presupuestaria/create', 2, 'Crear distribución presupuestaria de proyecto', NULL, NULL, 1452649234, 1452649234),
('proyecto-distribucion-presupuestaria/delete', 2, 'Eliminar distribución presupuestaria de proyecto', NULL, NULL, 1452649263, 1452649263),
('proyecto-distribucion-presupuestaria/index', 2, 'Lista de distribución presupuestaria de proyecto', NULL, NULL, 1452649290, 1452649290),
('proyecto-distribucion-presupuestaria/update', 2, 'Editar distribución presupuestaria de proyecto', NULL, NULL, 1452649249, 1452649249),
('proyecto-distribucion-presupuestaria/view', 2, 'Ver distribución presupuestaria de proyecto', NULL, NULL, 1452649220, 1452649220),
('proyecto-distribucion-update', 2, 'modificar proyecto distribucion', NULL, NULL, 1465223188, 1465223188),
('proyecto-distribucion/create', 2, 'crear proyecto distribucion', NULL, NULL, 1465223147, 1465223147),
('proyecto-distribucion/index', 2, 'inicio de distribucion de proyecto', NULL, NULL, 1465223126, 1465223126),
('proyecto-distribucion/view', 2, 'vista de la distribucion de proyecto', NULL, NULL, 1465223169, 1465223169),
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
('proyecto/bulk-activar', 2, 'Activar múltiples proyectos', NULL, NULL, 1456979084, 1456979084),
('proyecto/bulk-delete', 2, 'Eliminar múltiples proyectos', NULL, NULL, 1456979023, 1456979023),
('proyecto/bulk-desactivar', 2, 'Desactivar múltiples proyectos', NULL, NULL, 1456979103, 1456979103),
('proyecto/create', 2, 'Crear Proyecto', NULL, NULL, 1450393912, 1450645199),
('proyecto/delete', 2, 'Eliminar Proyecto', NULL, NULL, 1450393912, 1450645229),
('proyecto/distribucion', 2, 'distribucion de proyecto', NULL, NULL, 1465223687, 1465223687),
('proyecto/index', 2, 'Lista de proyectos', NULL, NULL, 1450646779, 1450646779),
('proyecto/toggle-activo', 2, 'Activar/desactivar un proyecto', NULL, NULL, 1456978982, 1456979131),
('proyecto/update', 2, 'Editar Proyecto', NULL, NULL, 1450393912, 1450645214),
('proyecto/view', 2, 'Ver Proyecto', NULL, NULL, 1450393912, 1450645173),
('registrador_accion_especifica', 1, 'Crea, edita y elimina acciones específicas de proyecto', NULL, NULL, 1452529829, 1457393365),
('registrador_alcance', 1, 'Crea, edita y elimina "alcance e impacto" de proyecto', NULL, NULL, 1452221931, 1452223040),
('registrador_basico', 1, 'Crea, edita y elimina datos básicos de proyecto', NULL, NULL, 1450393912, 1460242009),
('registrador_distribucion_presupuestaria', 1, 'Crea, edita y elimina la distribución presupuestaria de proyecto', NULL, NULL, 1452649340, 1452649340),
('responsable-acc-variable/create', 2, 'panta de creacion de responsable de la variable', NULL, NULL, 1465216350, 1465216350),
('responsable-acc-variable/delete', 2, 'borrar responsable relacionado con variable', NULL, NULL, 1465216419, 1465216419),
('responsable-acc-variable/index', 2, 'inicio de los responsables creados', NULL, NULL, 1465216441, 1465216441),
('responsable-acc-variable/update', 2, 'pantalla de modificacion de responsable de variable', NULL, NULL, 1465216389, 1465216389),
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

CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
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
('desbloquear_meses_variables', 'accion-centralizada-desbloqueo-mes/bulk-delete'),
('desbloquear_meses_variables', 'accion-centralizada-desbloqueo-mes/create'),
('desbloquear_meses_variables', 'accion-centralizada-desbloqueo-mes/delete'),
('desbloquear_meses_variables', 'accion-centralizada-desbloqueo-mes/index'),
('desbloquear_meses_variables', 'accion-centralizada-desbloqueo-mes/update'),
('desbloquear_meses_variables', 'accion-centralizada-desbloqueo-mes/view'),
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
('accion_centralizada_variable_ejecucion', 'accion-centralizada-variable-ejecucion/create'),
('accion_centralizada_variable_ejecucion', 'accion-centralizada-variable-ejecucion/localizacion'),
('accion_centralizada_variable_ejecucion', 'accion-centralizada-variable-ejecucion/variables'),
('accion_centralizada_variables', 'accion-centralizada-variables/ace'),
('accion_centralizada_variables', 'accion-centralizada-variables/ace1'),
('accion_centralizada_variables', 'accion-centralizada-variables/bulk-delete'),
('accion_centralizada_variables', 'accion-centralizada-variables/create'),
('accion_centralizada_variables', 'accion-centralizada-variables/delete'),
('accion_centralizada_variables', 'accion-centralizada-variables/index'),
('accion_centralizada_variables', 'accion-centralizada-variables/update'),
('accion_centralizada_variables', 'accion-centralizada-variables/view'),
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
('accion_centralizada_variables', 'localizacion-acc-variable/bulk-delete'),
('accion_centralizada_variables', 'localizacion-acc-variable/create'),
('accion_centralizada_variables', 'localizacion-acc-variable/delete'),
('accion_centralizada_variables', 'localizacion-acc-variable/update'),
('accion_centralizada_variables', 'localizacion-acc-variable/view'),
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
('proyecto_asignar', 'proyecto-asignar/ace'),
('proyecto_asignar', 'proyecto-asignar/asignar'),
('proyecto_asignar', 'proyecto-asignar/bulk-activar'),
('proyecto_asignar', 'proyecto-asignar/bulk-delete'),
('proyecto_asignar', 'proyecto-asignar/bulk-desactivar'),
('proyecto_asignar', 'proyecto-asignar/create'),
('proyecto_asignar', 'proyecto-asignar/delete'),
('proyecto_asignar', 'proyecto-asignar/index'),
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
('proyecto_pedido', 'proyecto/distribucion'),
('registrador_basico', 'proyecto/index'),
('gestor_proyecto', 'proyecto/toggle-activo'),
('registrador_basico', 'proyecto/update'),
('registrador_basico', 'proyecto/view'),
('accion_centralizada_variables', 'responsable-acc-variable/create'),
('accion_centralizada_variables', 'responsable-acc-variable/delete'),
('accion_centralizada_variables', 'responsable-acc-variable/index'),
('accion_centralizada_variables', 'responsable-acc-variable/update'),
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

CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta_presupuestaria`
--

CREATE TABLE IF NOT EXISTS `cuenta_presupuestaria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cuenta` varchar(1) NOT NULL COMMENT 'Código de la cuenta',
  `nombre` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `cuenta_presupuestaria`
--

INSERT INTO `cuenta_presupuestaria` (`id`, `cuenta`, `nombre`) VALUES
(1, '3', 'Recursos'),
(2, '4', 'Egresos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE IF NOT EXISTS `estados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) CHARACTER SET utf8 NOT NULL,
  `id_pais` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_pais` (`id_pais`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

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

CREATE TABLE IF NOT EXISTS `estatus_proyecto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estatus` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Lista de estatus de proyecto' AUTO_INCREMENT=4 ;

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

CREATE TABLE IF NOT EXISTS `fuente_financiamiento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fuente` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

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

CREATE TABLE IF NOT EXISTS `instancia_institucion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Tipo de instancia o institución' AUTO_INCREMENT=4 ;

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

CREATE TABLE IF NOT EXISTS `localizacion_acc_variable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_variable` int(11) NOT NULL,
  `id_pais` smallint(3) unsigned zerofill NOT NULL,
  `id_estado` int(11) DEFAULT NULL,
  `id_municipio` int(11) DEFAULT NULL,
  `id_parroquia` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_variable` (`id_variable`),
  KEY `id_pais` (`id_pais`),
  KEY `id_estado` (`id_estado`),
  KEY `id_municipio` (`id_municipio`),
  KEY `id_parroquia` (`id_parroquia`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=60 ;

--
-- Volcado de datos para la tabla `localizacion_acc_variable`
--

INSERT INTO `localizacion_acc_variable` (`id`, `id_variable`, `id_pais`, `id_estado`, `id_municipio`, `id_parroquia`) VALUES
(46, 32, 862, 3, NULL, NULL),
(47, 32, 862, 4, NULL, NULL),
(48, 32, 862, 5, NULL, NULL),
(51, 31, 862, 2, NULL, NULL),
(54, 31, 862, 3, NULL, NULL),
(59, 33, 862, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materiales_servicios`
--

CREATE TABLE IF NOT EXISTS `materiales_servicios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_se` int(11) NOT NULL COMMENT 'ID partida sub-especifica',
  `nombre` varchar(60) NOT NULL,
  `unidad_medida` int(11) NOT NULL,
  `presentacion` int(11) NOT NULL,
  `precio` decimal(12,2) NOT NULL,
  `iva` int(11) NOT NULL,
  `estatus` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_se` (`id_se`),
  KEY `unidad_medida` (`unidad_medida`),
  KEY `presentacion` (`presentacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
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

CREATE TABLE IF NOT EXISTS `modelhistory` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `table` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `field_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `field_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `old_value` text COLLATE utf8_unicode_ci,
  `new_value` text COLLATE utf8_unicode_ci,
  `type` smallint(6) NOT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-table` (`table`),
  KEY `idx-field_name` (`field_name`),
  KEY `idx-type` (`type`),
  KEY `idx-user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipio`
--

CREATE TABLE IF NOT EXISTS `municipio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `id_estado` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_estado` (`id_estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `key_id` int(11) DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `seen` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `notification`
--

INSERT INTO `notification` (`id`, `key`, `key_id`, `type`, `user_id`, `seen`, `created_at`) VALUES
(2, 'nuevo_pedido', 8, 'default', 1, 1, '2016-04-17 17:05:44'),
(3, 'nuevo_pedido', 9, 'default', 1, 0, '2016-04-17 18:28:30'),
(4, 'nuevo_pedido', 9, 'default', 2, 0, '2016-04-17 18:28:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `objetivos_estrategicos`
--

CREATE TABLE IF NOT EXISTS `objetivos_estrategicos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `objetivo_estrategico` text NOT NULL,
  `objetivo_nacional` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `directriz` (`objetivo_nacional`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Objetivos estrategicos - Area estrategica' AUTO_INCREMENT=150 ;

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
(37, 'Promover los modelos de producción diversificados, a partir de la agricultura familiar, '' campesina, urbana, periurbana e indígena, recuperando, validando y divulgando modelos tradicionales y sostenibles de producción.', 4),
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

CREATE TABLE IF NOT EXISTS `objetivos_generales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `objetivo_general` text NOT NULL,
  `objetivo_estrategico` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `estrategia` (`objetivo_estrategico`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Objetivos generales - Area estrategica' AUTO_INCREMENT=23 ;

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

CREATE TABLE IF NOT EXISTS `objetivos_historicos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `objetivo_historico` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Objetivos historicos - Area estrategica' AUTO_INCREMENT=6 ;

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

CREATE TABLE IF NOT EXISTS `objetivos_nacionales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `objetivo_nacional` text NOT NULL,
  `objetivo_historico` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `directriz` (`objetivo_historico`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Objetivos nacionales - Area estrategica' AUTO_INCREMENT=25 ;

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

CREATE TABLE IF NOT EXISTS `pais` (
  `id` smallint(3) unsigned zerofill NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
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

CREATE TABLE IF NOT EXISTS `parroquia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) CHARACTER SET latin1 NOT NULL,
  `id_municipio` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_municipio` (`id_municipio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partida_especifica`
--

CREATE TABLE IF NOT EXISTS `partida_especifica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `generica` int(11) NOT NULL,
  `especifica` varchar(2) NOT NULL,
  `nombre` text NOT NULL,
  `estatus` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_ge` (`generica`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2018 ;

--
-- Volcado de datos para la tabla `partida_especifica`
--

INSERT INTO `partida_especifica` (`id`, `generica`, `especifica`, `nombre`, `estatus`) VALUES
(1027, 514, '01', 'Impuesto sobre la renta a personas jurídicas', 0),
(1028, 514, '02', 'Impuesto sobre la renta a personas naturales', 0),
(1029, 514, '03', 'Impuestos sobre sucesiones, donaciones y demás ramos conexos', 0),
(1030, 514, '04', 'Reparos administrativos por impuesto sobre la renta a personas juridica', 0),
(1031, 514, '05', 'Reparos administrativos por impuesto sobre la renta a personas naturales', 0),
(1032, 514, '06', 'Reparos administrativos a impuesto sobre sucesiones, donaciones y demás ramos conexos', 0),
(1033, 515, '01', 'Impuestos de importación', 0),
(1034, 515, '02', 'Impuesto de exportación', 0),
(1035, 515, '03', 'Impuesto sobre la producción, el consumo y transacciones financieras', 0),
(1036, 515, '04', 'Impuestos a las actividades de juegos de envite o azar', 0),
(1037, 515, '05', 'Inmuebles urbanos', 0),
(1038, 515, '06', 'Participación en el impuesto a la propiedad rural', 0),
(1039, 515, '07', 'Patente de industria y comercio', 0),
(1040, 515, '08', 'Patente de vehículo', 0),
(1041, 515, '09', 'Propaganda comercial', 0),
(1042, 515, '10', 'Espectáculos públicos', 0),
(1043, 515, '11', 'Apuestas lícitas', 0),
(1044, 515, '12', 'Deudas morosas', 0),
(1045, 515, '99', 'Otros impuestos indirectos', 0),
(1046, 516, '01', 'Derechos de tránsito terrestre', 0),
(1047, 516, '02', 'Derechos a examen', 0),
(1048, 516, '03', 'Derechos de expedición, renovación y reválida de licencias', 0),
(1049, 516, '04', 'Derechos de registro y traspaso', 0),
(1050, 516, '05', 'Derechos de placas identificadoras', 0),
(1051, 516, '06', 'Derechos por revisión anual', 0),
(1052, 516, '07', 'Derechos por remoción o arrastre de vehículos', 0),
(1053, 516, '08', 'Derechos por estacionamiento de vehículos', 0),
(1054, 516, '09', 'Permiso para uso de rutas extraurbanas', 0),
(1055, 516, '10', 'Copias de documentos', 0),
(1056, 516, '11', 'Tasas para el uso de aeronaves y por licencias de personal aeronáutico', 0),
(1057, 516, '12', 'Tasas aeroportuarias', 0),
(1058, 516, '13', 'Tasas por uso de canales de navegación', 0),
(1059, 516, '14', 'Patente de navegación', 0),
(1060, 516, '15', 'Expedición de licencias de navegación', 0),
(1061, 516, '16', 'Servicio de telecomunicaciones', 0),
(1062, 516, '17', 'Permisos para estaciones privadas de radiocomunicaciones', 0),
(1063, 516, '18', 'Derechos de pilotajes', 0),
(1064, 516, '19', 'Habilitación de pilotaje', 0),
(1065, 516, '20', 'Servicios de remolcadores', 0),
(1066, 516, '21', 'Habilitación de remolcadores', 0),
(1067, 516, '22', 'Habilitación de capitanías de puerto', 0),
(1068, 516, '23', 'Otros servicios de capitanías de puerto', 0),
(1069, 516, '24', 'Tasas de faros y boyas', 0),
(1070, 516, '25', 'Servicios de aduana', 0),
(1071, 516, '26', 'Habilitación de aduanas', 0),
(1072, 516, '27', 'Derechos de almacenaje', 0),
(1073, 516, '28', 'Corretaje de bultos postales', 0),
(1074, 516, '29', 'Servicios de consulta sobre clasificación arancelaria, valoración aduanera y análisis de laboratorio', 0),
(1075, 516, '30', 'Bandas de garantía, cápsulas y sellos', 0),
(1076, 516, '31', 'Servicio de peaje', 0),
(1077, 516, '32', 'Servicio de riego y drenaje', 0),
(1078, 516, '33', 'Estampillas fiscales', 0),
(1079, 516, '34', 'Papel sellado', 0),
(1080, 516, '35', 'Derechos de traslado', 0),
(1081, 516, '36', 'Servicios sanitarios marítimos', 0),
(1082, 516, '37', 'Servicios hospitalarios', 0),
(1083, 516, '38', 'Venta de copias de planos', 0),
(1084, 516, '39', 'Derechos de contraste, verificación y estudios', 0),
(1085, 516, '40', 'Patente de pesca de perlas', 0),
(1086, 516, '41', 'Licencia de caza', 0),
(1087, 516, '42', 'Derechos de cancillería', 0),
(1088, 516, '43', 'Depósitos por el ingreso al país de extranjeros', 0),
(1089, 516, '44', 'Registro sanitario', 0),
(1090, 516, '45', 'Derechos de análisis de sustancias químicas', 0),
(1091, 516, '46', 'Derechos consulares', 0),
(1092, 516, '47', 'Matrícula para importar y exportar sustancias estupefacientes y psicotrópicas', 0),
(1093, 516, '48', 'Permisos municipales', 0),
(1094, 516, '49', 'Certificaciones y solvencias', 0),
(1095, 516, '50', 'Servicio de energía eléctrica', 0),
(1096, 516, '51', 'Servicio de distribución de agua', 0),
(1097, 516, '52', 'Servicio de gas doméstico', 0),
(1098, 516, '53', 'Mensura y deslinde', 0),
(1099, 516, '54', 'Aseo domiciliario', 0),
(1100, 516, '55', 'Matadero', 0),
(1101, 516, '56', 'Mercado', 0),
(1102, 516, '57', 'Cementerio', 0),
(1103, 516, '58', 'Terminal de pasajeros', 0),
(1104, 516, '59', 'Deudas morosas por tasas', 0),
(1105, 516, '99', 'Otros tipos de tasas', 0),
(1106, 517, '01', 'Sobre la plusvalía inmobiliaria', 0),
(1107, 517, '02', 'Contribuciones por mejoras', 0),
(1108, 517, '99', 'Otras contribuciones especiales', 0),
(1109, 518, '01', 'Ingresos por aportes patronales a la seguridad social', 0),
(1110, 518, '02', 'Contribuciones personales a la seguridad social', 0),
(1111, 519, '01', 'Regalías', 0),
(1112, 519, '02', 'Impuesto superficial de hidrocarburos', 0),
(1113, 519, '03', 'Impuesto de extracción', 0),
(1114, 519, '04', 'Impuesto de registro de exportación', 0),
(1115, 519, '05', 'Participación por azufre', 0),
(1116, 519, '06', 'Participación por coque', 0),
(1117, 519, '07', 'Ventajas especiales petroleras', 0),
(1118, 519, '99', 'Otros ingresos del dominio petrolero', 0),
(1119, 520, '01', 'Superficial minero', 0),
(1120, 520, '02', 'Impuesto de explotación', 0),
(1121, 520, '03', 'Ventajas especiales mineras', 0),
(1122, 520, '04', 'Regalía minera de oro', 0),
(1123, 521, '01', 'Impuesto superficial', 0),
(1124, 521, '02', 'Impuesto de explotación o aprovechamiento', 0),
(1125, 521, '03', 'Permiso o autorización para la explotación o aprovechamiento de los productos forestales', 0),
(1126, 521, '04', 'Autorización para deforestación', 0),
(1127, 521, '05', 'Autorización para movilizar productos forestales', 0),
(1128, 521, '06', 'Participación por la explotación en zonas de reserva forestal', 0),
(1129, 521, '07', 'Ventajas especiales por recursos forestales', 0),
(1130, 522, '01', 'Ingresos por la venta de bienes', 0),
(1131, 522, '02', 'Ingresos por la venta de servicios', 0),
(1132, 522, '99', 'Ingresos por la venta de otros bienes y servicios', 0),
(1133, 523, '01', 'Intereses por préstamos concedidos al sector privado', 0),
(1134, 523, '03', 'Intereses por préstamos concedidos al sector externo', 0),
(1135, 523, '04', 'Intereses por depósitos en instituciones financieras', 0),
(1136, 523, '05', 'Intereses de títulos y valores', 0),
(1137, 523, '06', 'Utilidades de acciones y participaciones de capital', 0),
(1138, 523, '07', 'Utilidades de explotación de juegos de azar', 0),
(1139, 523, '08', 'Alquileres', 0),
(1140, 523, '09', 'Derechos sobre bienes intangibles', 0),
(1141, 523, '10', 'Concesiones de bienes y servicios', 0),
(1142, 524, '01', 'Intereses moratorios', 0),
(1143, 524, '02', 'Reparos fiscales', 0),
(1144, 524, '03', 'Sanciones fiscales', 0),
(1145, 524, '04', 'Juicios y costas procesales', 0),
(1146, 524, '05', 'Beneficios en operaciones cambiarias', 0),
(1147, 524, '06', 'Utilidad por venta de activos', 0),
(1148, 524, '07', 'Intereses por financiamiento de deudas tributarias', 0),
(1149, 524, '08', 'Multas y recargos', 0),
(1150, 524, '09', 'Reparos administrativos al impuesto a los activos empresariales', 0),
(1151, 524, '10', 'Diversos reparos administrativos', 0),
(1152, 524, '11', 'Ingresos en tránsito', 0),
(1153, 524, '12', 'Reparos administrativos por impuestos municipales', 0),
(1154, 525, '01', 'Otros ingresos ordinarios', 0),
(1155, 526, '01', 'Colocación de títulos y valores de deuda pública interna a corto plazo', 0),
(1156, 526, '02', 'Obtención de préstamos internos a corto plazo', 0),
(1157, 526, '03', 'Colocación de títulos y valores de la deuda pública interna a largo plazo', 0),
(1158, 526, '04', 'Obtención de préstamos internos a largo plazo', 0),
(1159, 527, '01', 'Colocación de títulos y valores de la deuda pública externa a corto plazo', 0),
(1160, 527, '02', 'Obtención de préstamos externos a corto plazo', 0),
(1161, 527, '03', 'Colocación de títulos y valores de la deuda pública externa a largo plazo', 0),
(1162, 527, '04', 'Obtención de préstamos externos a largo plazo', 0),
(1163, 528, '01', 'Liquidación de entes descentralizados', 0),
(1164, 528, '02', 'Herencias vacantes y donaciones', 0),
(1165, 528, '03', 'Prima en colocación de títulos y valores de la deuda pública', 0),
(1166, 528, '05', 'Ingresos por procesos licitatorios', 0),
(1167, 529, '01', 'Reintegro proveniente de bonos de exportación', 0),
(1168, 529, '02', 'Reintegro de fondos efectuado por organismos públicos proveniente de bonos de exportación', 0),
(1169, 530, '01', 'Ingresos por obtención indebida de devoluciones o reintegros', 0),
(1170, 531, '01', 'Impuesto a las transacciones financieras', 0),
(1171, 531, '02', 'Reparos administrativos al impuesto a las transacciones financieras', 0),
(1172, 531, '03', 'Multas y recargos por el impuesto a las transacciones financieras', 0),
(1173, 532, '01', 'Otros ingresos extraordinarios', 0),
(1174, 533, '01', 'Venta de productos del sector industrial', 0),
(1175, 533, '02', 'Venta de productos del sector comercial', 0),
(1176, 534, '01', 'Venta bruta de servicios', 0),
(1177, 535, '01', 'Ingresos por inversiones en valores', 0),
(1178, 535, '02', 'Ingresos por cartera de créditos', 0),
(1179, 535, '03', 'Ingresos provenientes de la administración de fideicomisos', 0),
(1180, 535, '99', 'Otros ingresos financieros', 0),
(1181, 536, '01', 'Ingresos por inversiones en valores', 0),
(1182, 536, '02', 'Ingresos por cartera de créditos', 0),
(1183, 536, '03', 'Ingresos provenientes de la administración de fideicomisos', 0),
(1184, 536, '99', 'Otros ingresos financieros', 0),
(1185, 537, '01', 'Ingresos por operaciones de primas de seguro', 0),
(1186, 537, '02', 'Ingresos por operaciones de reaseguro', 0),
(1187, 537, '03', 'Ingresos por salvamento de siniestros', 0),
(1188, 537, '99', 'Otros ingresos por operaciones de seguro', 0),
(1189, 538, '01', 'Otros ingresos de operación', 0),
(1190, 539, '01', 'Subsidios para precios y tarifas', 0),
(1191, 540, '01', 'Incentivos a la exportación', 0),
(1192, 541, '01', 'Otros ingresos ajenos a la operación', 0),
(1193, 542, '01', 'Transferencias corrientes internas del sector privado', 0),
(1194, 542, '02', 'Donaciones corrientes internas del sector privado', 0),
(1195, 542, '03', 'Transferencias corrientes internas del sector público', 0),
(1196, 542, '04', 'Donaciones corrientes internas del sector público', 0),
(1197, 542, '05', 'Transferencias corrientes del exterior', 0),
(1198, 542, '06', 'Donaciones corrientes del exterior', 0),
(1199, 543, '01', 'Transferencias de capital internas del sector privado', 0),
(1200, 543, '02', 'Donaciones de capital internas del sector privado', 0),
(1201, 543, '03', 'Transferencias de capital internas del sector público', 0),
(1202, 543, '04', 'Donaciones de capital internas del sector público', 0),
(1203, 543, '05', 'Transferencias de capital del exterior', 0),
(1204, 543, '06', 'Donaciones de capital del exterior', 0),
(1205, 544, '01', 'Situado Constitucional', 0),
(1206, 544, '02', 'Situado Estadal a Municipal', 0),
(1207, 545, '01', 'Subsidio de Régimen Especial', 0),
(1208, 546, '01', 'Subsidio de Capitalidad', 0),
(1209, 547, '01', 'Asignaciones Económicas Especiales (LAEE) Estadal', 0),
(1210, 547, '02', 'Asignaciones Económicas Especiales (LAEE) Estadal a Municipal', 0),
(1211, 547, '03', 'Asignaciones Económicas Especiales (LAEE) Municipal', 0),
(1212, 547, '04', 'Asignaciones Económicas Especiales (LAEE) Fondo Nacional de los Consejos Comunales', 0),
(1213, 547, '05', 'Asignaciones Económicas Especiales (LAEE) Apoyo al Fortalecimiento Institucional', 0),
(1214, 548, '01', 'Fondo Intergubernamental para la Descentralización (FIDES)', 0),
(1215, 549, '01', 'Fondo de Compensación Interterritorial Estadal', 0),
(1216, 549, '02', 'Fondo de Compensación Interterritorial Municipal', 0),
(1217, 549, '03', 'Fondo de Compensación Interterritorial Poder Popular', 0),
(1218, 549, '04', 'Fondo de Compensación Interterritorial Fortalecimiento Institucional', 0),
(1219, 550, '01', 'Aportes del Sector Público al Poder Estadal por transferencia de servicios', 0),
(1220, 550, '02', 'Aportes del Sector Público al Poder Municipal por transferencia de servicios', 0),
(1221, 551, '01', 'Transferencias y donaciones corrientes de Organismos del Sector Público a los Consejos Comunales', 0),
(1222, 551, '02', 'Transferencias y donaciones de capital de Organismos del Sector Público a los Consejos Comunales', 0),
(1223, 552, '01', 'Venta y/o desincorporación de tierras y terrenos', 0),
(1224, 552, '02', 'Venta y/o desincorporación de edificios e instalaciones', 0),
(1225, 552, '03', 'Venta y/o desincorporación de maquinarias, equipos y semovientes', 0),
(1226, 553, '01', 'Venta de marcas de fábrica y patentes de invención', 0),
(1227, 553, '02', 'Venta de derechos de autor', 0),
(1228, 553, '03', 'Recuperación de gastos de organización', 0),
(1229, 553, '04', 'Venta de paquetes y programas de computación', 0),
(1230, 553, '05', 'Venta de estudios y proyectos', 0),
(1231, 553, '99', 'Venta de otros activos intangibles', 0),
(1232, 554, '01', 'Incremento de la depreciación acumulada', 0),
(1233, 554, '02', 'Incremento de la amortización acumulada', 0),
(1234, 555, '01', 'Venta de títulos y valores privados de corto plazo', 0),
(1235, 555, '02', 'Venta de títulos y valores públicos de corto plazo', 0),
(1236, 555, '03', 'Venta de títulos y valores externos de corto plazo', 0),
(1237, 556, '01', 'Venta de títulos y valores privados de largo plazo', 0),
(1238, 556, '02', 'Venta de títulos y valores públicos de largo plazo', 0),
(1239, 556, '03', 'Venta de títulos y valores externos de largo plazo', 0),
(1240, 557, '01', 'Venta de acciones y participaciones de capital del sector privado', 0),
(1241, 558, '01', 'Venta de acciones y participaciones de capital de entes descentralizados sin fines empresariales', 0),
(1242, 558, '02', 'Venta de acciones y participaciones de capital de instituciones de protección social', 0),
(1243, 558, '03', 'Venta de acciones y participaciones de capital de entes descentralizados con fines empresariales petroleros', 0),
(1244, 558, '04', 'Venta de acciones y participaciones de capital de entes descentralizados con fines empresariales no petroleros', 0),
(1245, 558, '05', 'Venta de acciones y participaciones de capital de entes descentralizados financieros bancarios', 0),
(1246, 558, '06', 'Venta de acciones y participaciones de capital de entes descentralizados financieros no bancarios', 0),
(1247, 559, '01', 'Venta de acciones y participaciones de capital de organismos internacionales', 0),
(1248, 559, '99', 'Venta de acciones y participaciones de capital de otros entes del sector externo', 0),
(1249, 560, '01', 'Recuperación de préstamos otorgados al sector privado de corto plazo', 0),
(1250, 561, '01', 'Recuperación de préstamos otorgados a la República de corto plazo', 0),
(1251, 561, '02', 'Recuperación de préstamos otorgados a entes descentralizados sin fines empresariales de corto plazo', 0),
(1252, 561, '03', 'Recuperación de préstamos otorgados a instituciones de protección social de corto plazo', 0),
(1253, 561, '04', 'Recuperación de préstamos otorgados a entes descentralizados con fines empresariales petroleros de corto plazo', 0),
(1254, 561, '05', 'Recuperación de préstamos otorgados a entes descentralizados con fines empresariales no petroleros de corto plazo', 0),
(1255, 561, '06', 'Recuperación de préstamos otorgados a entes descentralizados financieros bancarios de corto plazo', 0),
(1256, 561, '07', 'Recuperación de préstamos otorgados a entes descentralizados financieros no bancarios de corto plazo', 0),
(1257, 561, '08', 'Recuperación de préstamos otorgados al Poder Estadal de corto plazo', 0),
(1258, 561, '09', 'Recuperación de préstamos otorgados al Poder Municipal de corto plazo', 0),
(1259, 562, '01', 'Recuperación de préstamos otorgados a instituciones sin fines de lucro de corto plazo', 0),
(1260, 562, '02', 'Recuperación de préstamos otorgados a gobiernos extranjeros de corto plazo', 0),
(1261, 562, '03', 'Recuperación de préstamos otorgados a los organismos internacionales de corto plazo', 0),
(1262, 563, '01', 'Recuperación de préstamos otorgados al sector privado de largo plazo', 0),
(1263, 564, '01', 'Recuperación de préstamos otorgados a la República de largo plazo', 0),
(1264, 564, '02', 'Recuperación de préstamos otorgados a entes descentralizados sin fines empresariales de largo plazo', 0),
(1265, 564, '03', 'Recuperación de préstamos otorgados a instituciones de protección social de largo plazo', 0),
(1266, 564, '04', 'Recuperación de préstamos otorgados a entes descentralizados con fines empresariales petroleros de largo plazo', 0),
(1267, 564, '05', 'Recuperación de préstamos otorgados a entes descentralizados con fines empresariales no petroleros de largo plazo', 0),
(1268, 564, '06', 'Recuperación de préstamos otorgados a entes descentralizados financieros bancarios de largo plazo', 0),
(1269, 564, '07', 'Recuperación de préstamos otorgados a entes descentralizados financieros no bancarios de largo plazo', 0),
(1270, 564, '08', 'Recuperación de préstamos otorgados al Poder Estadal de largo plazo', 0),
(1271, 564, '09', 'Recuperación de préstamos otorgados al Poder Municipal de largo plazo', 0),
(1272, 565, '01', 'Recuperación de préstamos otorgados a instituciones sin fines de lucro de largo plazo', 0),
(1273, 565, '02', 'Recuperación de préstamos otorgados a gobiernos extranjeros de largo plazo', 0),
(1274, 565, '03', 'Recuperación de préstamos otorgados a organismos internacionales de largo plazo', 0),
(1275, 566, '01', 'Disminución de caja', 0),
(1276, 566, '02', 'Disminución de bancos', 0),
(1277, 566, '03', 'Disminución de inversiones temporales', 0),
(1278, 567, '01', 'Disminución de cuentas comerciales por cobrar a corto plazo', 0),
(1279, 567, '02', 'Disminución de rentas por recaudar a corto plazo', 0),
(1280, 567, '03', 'Disminución de deudas de cuentas por rendir a corto plazo', 0),
(1281, 567, '99', 'Disminución de otras cuentas por cobrar a corto plazo', 0),
(1282, 568, '01', 'Disminución de efectos comerciales por cobrar a corto plazo', 0),
(1283, 568, '99', 'Disminución de otros efectos por cobrar a corto plazo', 0),
(1284, 569, '01', 'Disminución de cuentas comerciales por cobrar a mediano y largo plazo', 0),
(1285, 569, '02', 'Disminución de rentas por recaudar a mediano y largo plazo', 0),
(1286, 569, '99', 'Disminución de otras cuentas por cobrar a mediano y largo plazo', 0),
(1287, 570, '01', 'Disminución de efectos comerciales por cobrar a mediano y largo plazo', 0),
(1288, 570, '99', 'Disminución de otros efectos por cobrar a mediano y largo plazo', 0),
(1289, 571, '01', 'Disminución de fondos en avance', 0),
(1290, 571, '02', 'Disminución de fondos en anticipo', 0),
(1291, 571, '03', 'Disminución de fondos en fideicomiso', 0),
(1292, 571, '04', 'Disminución de anticipos a proveedores', 0),
(1293, 571, '05', 'Disminución de anticipos a contratistas, por contratos a corto plazo', 0),
(1294, 571, '06', 'Disminución de anticipos a contratistas, por contratos a mediano y largo plazo', 0),
(1295, 572, '01', 'Disminución de gastos a corto plazo pagados por anticipado', 0),
(1296, 572, '02', 'Disminución de depósitos en garantía a corto plazo', 0),
(1297, 572, '99', 'Disminución de otros activos diferidos a corto plazo', 0),
(1298, 573, '01', 'Disminución de gastos a mediano y largo plazo pagados por anticipado', 0),
(1299, 573, '02', 'Disminución de depósitos en garantía a mediano y largo plazo', 0),
(1300, 573, '99', 'Disminución de otros activos diferidos a mediano y largo plazo', 0),
(1301, 574, '01', 'Disminución del Fondo de Estabilización Macroeconómica (FEM) de la República', 0),
(1302, 574, '02', 'Disminución del Fondo de Estabilización Macroeconómica (FEM) del Poder Estadal', 0),
(1303, 574, '03', 'Disminución del Fondo de Estabilización Macroeconómica (FEM) del Poder Municipal', 0),
(1304, 575, '01', 'Disminución del Fondo de Ahorro Intergeneracional', 0),
(1305, 576, '01', 'Disminución del Fondo de Aporte del Sector Público', 0),
(1306, 577, '01', 'Disminución de activos financieros en gestión judicial a mediano y largo plazo', 0),
(1307, 577, '02', 'Disminución de títulos y otros valores de la deuda pública en litigio a largo plazo', 0),
(1308, 578, '01', 'Disminución de otros activos financieros circulantes', 0),
(1309, 578, '02', 'Disminución de otros activos financieros no circulantes', 0),
(1310, 579, '01', 'Incremento de sueldos, salarios y otras remuneraciones por pagar', 0),
(1311, 580, '01', 'Incremento de aportes patronales y retenciones laborales por pagar al Instituto Venezolano de los Seguros Sociales (IVSS)', 0),
(1312, 580, '02', 'Incremento de aportes patronales y retenciones laborales por pagar al Instituto de Previsión Social del Ministerio de Educación (Ipasme)', 0),
(1313, 580, '03', 'Incremento de aportes patronales y retenciones laborales por pagar al Fondo de Jubilaciones', 0),
(1314, 580, '04', 'Incremento de aportes patronales y retenciones laborales por pagar al Fondo de Seguro de Paro Forzoso', 0),
(1315, 580, '05', 'Incremento de aportes patronales y retenciones laborales por pagar al Fondo de Ahorro Obligatorio para la Vivienda (FAOV)', 0),
(1316, 580, '06', 'Incremento de aportes patronales y retenciones laborales por pagar por seguro de vida, accidentes personales, hospitalización, cirugía y maternidad (HCM) y gastos funerarios', 0),
(1317, 580, '07', 'Incremento de aportes patronales y retenciones laborales por pagar a cajas de ahorro', 0),
(1318, 580, '08', 'Incremento de aportes patronales y retenciones laborales por pagar a los organismos de seguridad social', 0),
(1319, 580, '09', 'Incremento de aportes patronales y retenciones laborales por pagar al Instituto Nacional de Capacitación y Educación Socialista (Inces)', 0),
(1320, 580, '10', 'Incremento de aportes patronales y retenciones laborales por pagar por pensión alimenticia', 0),
(1321, 580, '99', 'Incremento de otros aportes patronales y otras retenciones laborales por pagar', 0),
(1322, 581, '01', 'Incremento de cuentas por pagar a proveedores a corto plazo', 0),
(1323, 581, '02', 'Incremento de efectos por pagar a proveedores a corto plazo', 0),
(1324, 581, '03', 'Incremento de cuentas por pagar a proveedores a mediano y largo plazo', 0),
(1325, 581, '04', 'Incremento de efectos por pagar a proveedores a mediano y largo plazo', 0),
(1326, 582, '01', 'Incremento de cuentas por pagar a contratistas a corto plazo', 0),
(1327, 582, '02', 'Incremento de efectos por pagar a contratistas a corto plazo', 0),
(1328, 582, '03', 'Incremento de cuentas por pagar a contratistas a mediano y largo plazo', 0),
(1329, 582, '04', 'Incremento de efectos por pagar a contratistas a mediano y largo plazo', 0),
(1330, 583, '01', 'Incremento de intereses internos por pagar', 0),
(1331, 583, '02', 'Incremento de intereses externos por pagar', 0),
(1332, 584, '01', 'Incremento de otras cuentas por pagar a corto plazo', 0),
(1333, 584, '02', 'Incremento de otras obligaciones de ejercicios anteriores por pagar', 0),
(1334, 584, '03', 'Incremento de otros efectos por pagar a corto plazo', 0),
(1335, 585, '01', 'Incremento de pasivos diferidos a corto plazo', 0),
(1336, 585, '02', 'Incremento de pasivos diferidos a mediano y largo plazo', 0),
(1337, 586, '01', 'Incremento de provisiones', 0),
(1338, 586, '02', 'Incremento de reservas técnicas', 0),
(1339, 587, '01', 'Incremento de depósitos recibidos en garantía', 0),
(1340, 587, '99', 'Incremento de otros fondos de terceros', 0),
(1341, 588, '01', 'Incremento de depósitos a la vista', 0),
(1342, 588, '02', 'Incremento de depósitos a plazo fijo', 0),
(1343, 589, '01', 'Incremento por reestructuración y/o refinanciamiento de la deuda pública interna de largo plazo en corto plazo', 0),
(1344, 589, '02', 'Incremento por reestructuración y/o refinanciamiento de la deuda pública interna de corto plazo en largo plazo', 0),
(1345, 589, '03', 'Incremento por reestructuración y/o refinanciamiento de la deuda pública externa de largo plazo en corto plazo', 0),
(1346, 589, '04', 'Incremento por reestructuración y/o refinanciamiento de la deuda pública externa de corto plazo en largo plazo', 0),
(1347, 589, '05', 'Incremento de la deuda pública por distribuir', 0),
(1348, 590, '01', 'Incremento de otros pasivos a corto plazo', 0),
(1349, 590, '02', 'Incremento de otros pasivos a mediano y largo plazo', 0),
(1350, 591, '01', 'Incremento del capital fiscal e institucional', 0),
(1351, 591, '02', 'Incremento de aportes por capitalizar', 0),
(1352, 591, '03', 'Incremento de dividendos a distribuir', 0),
(1353, 592, '01', 'Incremento de reservas', 0),
(1354, 593, '01', 'Ajustes por inflación', 0),
(1355, 594, '01', 'Incremento de resultados acumulados', 0),
(1356, 594, '02', 'Incremento de resultados del ejercicio', 0),
(1357, 595, '01', 'Sueldos básicos personal fijo a tiempo completo', 1),
(1358, 595, '02', 'Sueldos básicos personal fijo a tiempo parcial', 1),
(1359, 595, '03', 'Suplencias a empleados', 1),
(1360, 595, '08', 'Sueldo al personal en trámite de nombramiento', 1),
(1361, 595, '09', 'Remuneraciones al personal en período de disponibilidad', 1),
(1362, 595, '10', 'Salarios a obreros en puestos permanentes a tiempo completo', 1),
(1363, 595, '11', 'Salarios a obreros en puestos permanentes a tiempo parcial', 1),
(1364, 595, '12', 'Salarios a obreros en puestos no permanentes', 1),
(1365, 595, '13', 'Suplencias a obreros', 1),
(1366, 595, '18', 'Remuneraciones al personal contratado', 1),
(1367, 595, '19', 'Retribuciones por becas - salarios, bolsas de trabajo, pasantías y similares', 1),
(1368, 595, '20', 'Sueldo del personal militar profesional', 1),
(1369, 595, '21', 'Sueldo o ración del personal militar no profesional', 1),
(1370, 595, '22', 'Sueldo del personal militar de reserva', 1),
(1371, 595, '29', 'Dietas', 1),
(1372, 595, '30', 'Retribución al personal de reserva', 1),
(1373, 595, '35', 'Sueldo básico de los altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
(1374, 595, '36', 'Sueldo básico del personal de alto nivel y de dirección', 1),
(1375, 595, '37', 'Dietas de los altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
(1376, 595, '38', 'Dietas del personal de alto nivel y de dirección', 1),
(1377, 595, '99', 'Otras retribuciones', 1),
(1378, 596, '01', 'Compensaciones previstas en las escalas de sueldos al personal empleado fijo a tiempo completo', 1),
(1379, 596, '02', 'Compensaciones previstas en las escalas de sueldos al personal empleado fijo a tiempo parcial', 1),
(1380, 596, '03', 'Compensaciones previstas en las escalas de salarios al personal obrero fijo a tiempo completo', 1),
(1381, 596, '04', 'Compensaciones previstas en las escalas de salarios al personal obrero fijo a tiempo parcial', 1),
(1382, 596, '05', 'Compensaciones previstas en las escalas de sueldos al personal militar', 1),
(1383, 596, '06', 'Compensaciones previstas en las escalas de sueldos de los altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
(1384, 596, '07', 'Compensaciones previstas en las escalas de sueldos del personal de alto nivel y de dirección', 1),
(1385, 597, '01', 'Primas por mérito a empleados', 1),
(1386, 597, '02', 'Primas de transporte a empleados', 1),
(1387, 597, '03', 'Primas por hogar a empleados', 1),
(1388, 597, '04', 'Primas por hijos a empleados', 1),
(1389, 597, '05', 'Primas por alquileres a empleados', 1),
(1390, 597, '06', 'Primas por residencia a empleados', 1),
(1391, 597, '07', 'Primas por categoría de escuelas a empleados', 1),
(1392, 597, '08', 'Primas de profesionalización a empleados', 1),
(1393, 597, '09', 'Primas por antigüedad a empleados', 1),
(1394, 597, '10', 'Primas por jerarquía o responsabilidad en el cargo', 1),
(1395, 597, '11', 'Primas al personal en servicio en el exterior', 1),
(1396, 597, '16', 'Primas por mérito a obreros', 1),
(1397, 597, '17', 'Primas de transporte a obreros', 1),
(1398, 597, '18', 'Primas por hogar a obreros', 1),
(1399, 597, '19', 'Primas por hijos de obreros', 1),
(1400, 597, '20', 'Primas por residencia a obreros', 1),
(1401, 597, '21', 'Primas por antigüedad a obreros', 1),
(1402, 597, '22', 'Primas de profesionalización a obreros', 1),
(1403, 597, '26', 'Primas por hijos al personal militar', 1),
(1404, 597, '27', 'Primas de profesionalización al personal militar', 1),
(1405, 597, '28', 'Primas por antigüedad al personal militar', 1),
(1406, 597, '29', 'Primas por potencial de ascenso al personal militar', 1),
(1407, 597, '30', 'Primas por frontera y sitios inhóspitos al personal militar y de seguridad', 1),
(1408, 597, '31', 'Primas por riesgo al personal militar y de seguridad', 1),
(1409, 597, '37', 'Primas de transporte al personal contratado', 1),
(1410, 597, '38', 'Primas por hogar al personal contratado', 1),
(1411, 597, '39', 'Primas por hijos al personal contratado', 1),
(1412, 597, '40', 'Primas de profesionalización al personal contratado', 1),
(1413, 597, '41', 'Primas por antigüedad al personal contratado', 1),
(1414, 597, '46', 'Primas a los altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
(1415, 597, '47', 'Primas al personal de alto nivel y de dirección', 1),
(1416, 597, '94', 'Otras primas a los altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
(1417, 597, '95', 'Otras primas al personal de alto nivel y de dirección', 1),
(1418, 597, '96', 'Otras primas al personal contratado', 1),
(1419, 597, '97', 'Otras primas a empleados', 1),
(1420, 597, '98', 'Otras primas a obreros', 1),
(1421, 597, '99', 'Otras primas al personal militar', 1),
(1422, 598, '01', 'Complemento a empleados por horas extraordinarias o por sobre tiempo', 1),
(1423, 598, '02', 'Complemento a empleados por trabajo nocturno', 1),
(1424, 598, '03', 'Complemento a empleados por gastos de alimentación', 1),
(1425, 598, '04', 'Complemento a empleados por gastos de transporte', 1),
(1426, 598, '05', 'Complemento a empleados por gastos de representación', 1),
(1427, 598, '06', 'Complemento a empleados por comisión de servicios', 1),
(1428, 598, '07', 'Bonificación a empleados', 1),
(1429, 598, '08', 'Bono compensatorio de alimentación a empleados', 1),
(1430, 598, '09', 'Bono compensatorio de transporte a empleados', 1),
(1431, 598, '10', 'Complemento a empleados por días feriados', 1),
(1432, 598, '14', 'Complemento a obreros por horas extraordinarias o por sobre tiempo', 1),
(1433, 598, '15', 'Complemento a obreros por trabajo o jornada nocturna', 1),
(1434, 598, '16', 'Complemento a obreros por gastos de alimentación', 1),
(1435, 598, '17', 'Complemento a obreros por gastos de transporte', 1),
(1436, 598, '18', 'Bono compensatorio de alimentación a obreros', 1),
(1437, 598, '19', 'Bono compensatorio de transporte a obreros', 1),
(1438, 598, '20', 'Complemento a obreros por días feriados', 1),
(1439, 598, '24', 'Complemento al personal contratado por horas extraordinarias o por sobre tiempo', 1),
(1440, 598, '25', 'Complemento al personal contratado por gastos de alimentación', 1),
(1441, 598, '26', 'Bono compensatorio de alimentación al personal contratado', 1),
(1442, 598, '27', 'Bono compensatorio de transporte al personal contratado', 1),
(1443, 598, '28', 'Complemento al personal contratado por días feriados', 1),
(1444, 598, '32', 'Complemento al personal militar por gastos de alimentación', 1),
(1445, 598, '33', 'Complemento al personal militar por gastos de transporte', 1),
(1446, 598, '34', 'Complemento al personal militar en el exterior', 1),
(1447, 598, '35', 'Bono compensatorio de alimentación al personal militar', 1),
(1448, 598, '43', 'Complemento a altos funcionarios y altas funcionarias del poder público y de elección popular por gastos de representación', 1),
(1449, 598, '44', 'Complemento a altos funcionarios y altas funcionarias del poder público y de elección popular por comisión de servicios', 1),
(1450, 598, '45', 'Bonificación a altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
(1451, 598, '46', 'Bono compensatorio de alimentación a altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
(1452, 598, '47', 'Bono compensatorio de transporte a altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
(1453, 598, '48', 'Complemento al personal de alto nivel y de dirección por gastos de representación', 1),
(1454, 598, '49', 'Complemento al personal de alto nivel y de dirección por comisión de servicios', 1),
(1455, 598, '50', 'Bonificación al personal de alto nivel y de dirección', 1),
(1456, 598, '51', 'Bono compensatorio de alimentación al personal de alto nivel y de dirección', 1),
(1457, 598, '52', 'Bono compensatorio de transporte al personal de alto nivel y de dirección', 1),
(1458, 598, '94', 'Otros complementos a altos funcionarios y altas funcionarias del sector público y de elección popular', 1),
(1459, 598, '95', 'Otros complementos al personal de alto nivel y de dirección', 1),
(1460, 598, '96', 'Otros complementos a empleados', 1),
(1461, 598, '97', 'Otros complementos a obreros', 1),
(1462, 598, '98', 'Otros complementos al personal contratado', 1),
(1463, 598, '99', 'Otros complementos al personal militar', 1),
(1464, 599, '01', 'Aguinaldos a empleados', 1),
(1465, 599, '02', 'Utilidades legales y convencionales a empleados', 1),
(1466, 599, '03', 'Bono vacacional a empleados', 1),
(1467, 599, '04', 'Aguinaldos a obreros', 1),
(1468, 599, '05', 'Utilidades legales y convencionales a obreros', 1),
(1469, 599, '06', 'Bono vacacional a obreros', 1),
(1470, 599, '07', 'Aguinaldos al personal contratado', 1),
(1471, 599, '08', 'Bono vacacional al personal contratado', 1),
(1472, 599, '09', 'Aguinaldos al personal militar', 1),
(1473, 599, '10', 'Bono vacacional al personal militar', 1),
(1474, 599, '13', 'Aguinaldos a altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
(1475, 599, '14', 'Utilidades legales y convencionales a altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
(1476, 599, '15', 'Bono vacacional a altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
(1477, 599, '16', 'Aguinaldos al personal de alto nivel y de dirección', 1),
(1478, 599, '17', 'Utilidades legales y convencionales al personal de alto nivel y de dirección', 1),
(1479, 599, '18', 'Bono vacacional al personal de alto nivel y de dirección', 1),
(1480, 600, '01', 'Aporte patronal al Instituto Venezolano de los Seguros Sociales (IVSS) por empleados', 1),
(1481, 600, '02', 'Aporte patronal al Instituto de Previsión y Asistencia Social para el personal del Ministerio de Educación (Ipasme) por empleados', 1),
(1482, 600, '03', 'Aporte patronal al Fondo de Jubilaciones por empleados', 1),
(1483, 600, '04', 'Aporte patronal al Fondo de Seguro de Paro Forzoso por empleados', 1),
(1484, 600, '05', 'Aporte patronal al Fondo de Ahorro Obligatorio para la Vivienda por empleados', 1),
(1485, 600, '10', 'Aporte patronal al Instituto Venezolano de los Seguros Sociales (IVSS) por obreros', 1),
(1486, 600, '11', 'Aporte patronal al Fondo de Jubilaciones por obreros', 1),
(1487, 600, '12', 'Aporte patronal al Fondo de Seguro de Paro Forzoso por obreros', 1),
(1488, 600, '13', 'Aporte patronal al Fondo de Ahorro Obligatorio para la Vivienda por obreros', 1),
(1489, 600, '18', 'Aporte patronal a los organismos de seguridad social por los trabajadores locales empleados en las representaciones de Venezuela en el exterior', 1),
(1490, 600, '19', 'Aporte patronal al Fondo de Ahorro Obligatorio para la Vivienda por personal militar', 1),
(1491, 600, '25', 'Aporte legal al Instituto Venezolano de los Seguros Sociales (IVSS) por personal contratado', 1),
(1492, 600, '26', 'Aporte patronal al Fondo de Ahorro Obligatorio para la Vivienda por personal contratado', 1),
(1493, 600, '27', 'Aporte patronal al Fondo de Seguro de Paro Forzoso por personal contratado', 1),
(1494, 600, '31', 'Aporte patronal al Instituto Venezolano de los Seguros Sociales (IVSS) por altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
(1495, 600, '32', 'Aporte patronal al Instituto de Previsión y Asistencia Social para el personal del Ministerio de Educación (Ipasme) por empleados personal del Ministerio de Educación (Ipasme) por altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
(1496, 600, '33', 'Aporte patronal al Fondo de Jubilaciones por altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
(1497, 600, '34', 'Aporte patronal al Fondo de Ahorro Obligatorio para la Vivienda por altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
(1498, 600, '35', 'Aporte patronal al Fondo de Seguro de Paro Forzoso por altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
(1499, 600, '39', 'Aporte patronal al Instituto Venezolano de los Seguros Sociales (IVSS) por personal de alto nivel y de dirección', 1),
(1500, 600, '40', 'Aporte patronal al Instituto de Previsión y Asistencia Social para el personal del Ministerio de Educación (Ipasme) por personal de alto nivel y de dirección', 1),
(1501, 600, '41', 'Aporte patronal al Fondo de Jubilaciones por personal de alto nivel y de dirección', 1),
(1502, 600, '42', 'Aporte patronal al Fondo de Ahorro Obligatorio para la Vivienda por personal de alto nivel y de dirección', 1),
(1503, 600, '43', 'Aporte patronal al Fondo de Seguro de Paro Forzoso por personal de alto nivel y de dirección', 1),
(1504, 600, '93', 'Otros aportes legales por altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
(1505, 600, '94', 'Otros aportes legales por el personal de alto nivel y de dirección', 1),
(1506, 600, '95', 'Otros aportes legales por personal contratado', 1),
(1507, 600, '96', 'Otros aportes legales por empleados', 1),
(1508, 600, '97', 'Otros aportes legales por obreros', 1),
(1509, 600, '98', 'Otros aportes legales por personal militar', 1),
(1510, 601, '01', 'Capacitación y adiestramiento a empleados', 1),
(1511, 601, '02', 'Becas a empleados', 1),
(1512, 601, '03', 'Ayudas por matrimonio a empleados', 1),
(1513, 601, '04', 'Ayudas por nacimiento de hijos a empleados', 1),
(1514, 601, '05', 'Ayudas por defunción a empleados', 1),
(1515, 601, '06', 'Ayudas para medicinas, gastos médicos, odontológicos y de hospitalización a empleados', 1),
(1516, 601, '07', 'Aporte patronal a cajas de ahorro por empleados', 1),
(1517, 601, '08', 'Aporte patronal a los servicios de salud, accidentes personales y gastos funerarios por empleados', 1),
(1518, 601, '09', 'Ayudas a empleados para adquisición de uniformes y útiles escolares de sus hijos', 1),
(1519, 601, '10', 'Dotación de uniformes a empleados', 1),
(1520, 601, '11', 'Aporte patronal para gastos de guarderías y preescolar para hijos de empleados', 1),
(1521, 601, '12', 'Aportes para la adquisición de juguetes para los hijos del personal empleado', 1),
(1522, 601, '17', 'Capacitación y adiestramiento a obreros', 1),
(1523, 601, '18', 'Becas a obreros', 1),
(1524, 601, '19', 'Ayudas por matrimonio de obreros', 1),
(1525, 601, '20', 'Ayudas por nacimiento de hijos de obreros', 1),
(1526, 601, '21', 'Ayudas por defunción a obreros', 1),
(1527, 601, '22', 'Ayudas para medicinas, gastos médicos, odontológicos y de hospitalización a obreros', 1),
(1528, 601, '23', 'Aporte patronal a cajas de ahorro por obreros', 1),
(1529, 601, '24', 'Aporte patronal a los servicios de salud, accidentes personales y gastos funerarios por obreros', 1),
(1530, 601, '25', 'Ayudas a obreros para adquisición de uniformes y útiles escolares de sus hijos', 1),
(1531, 601, '26', 'Dotación de uniformes a obreros', 1),
(1532, 601, '27', 'Aporte patronal para gastos de guarderías y preescolar para hijos de obreros', 1),
(1533, 601, '28', 'Aportes para la adquisición de juguetes para los hijos del personal obrero', 1),
(1534, 601, '34', 'Capacitación y adiestramiento al personal militar', 1),
(1535, 601, '35', 'Becas al personal militar', 1),
(1536, 601, '36', 'Ayudas por matrimonio al personal militar', 1),
(1537, 601, '37', 'Ayudas por nacimiento de hijos al personal militar', 1),
(1538, 601, '38', 'Ayudas por defunción al personal militar', 1),
(1539, 601, '39', 'Ayudas para medicinas, gastos médicos, odontológicos y de hospitalización al personal militar', 1),
(1540, 601, '40', 'Aporte patronal a caja de ahorro por personal militar', 1),
(1541, 601, '41', 'Aporte patronal a los servicios de salud, accidentes personales y gastos funerarios personal militar', 1),
(1542, 601, '42', 'Ayudas al personal militar para adquisición de uniformes y útiles escolares de sus hijos', 1),
(1543, 601, '43', 'Aportes para la adquisición de juguetes para los hijos del personal militar', 1),
(1544, 601, '44', 'Aporte patronal para gastos de guarderías y preescolar para hijos del personal militar', 1),
(1545, 601, '52', 'Capacitación y adiestramiento a altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
(1546, 601, '53', 'Ayudas por matrimonio a altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
(1547, 601, '54', 'Ayudas por nacimiento de hijos altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
(1548, 601, '55', 'Ayudas por defunción a altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
(1549, 601, '56', 'Ayudas para medicinas, gastos médicos, odontológicos y de hospitalización a altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
(1550, 601, '57', 'Aporte patronal a cajas de ahorro por altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
(1551, 601, '58', 'Aporte patronal a los servicios de salud, accidentes personales y gastos funerarios por altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
(1552, 601, '63', 'Capacitación y adiestramiento al personal de alto nivel y de dirección', 1),
(1553, 601, '64', 'Ayudas por matrimonio al personal de alto nivel y de dirección', 1),
(1554, 601, '65', 'Ayudas por nacimiento de hijos al personal de alto nivel y de dirección', 1),
(1555, 601, '66', 'Ayudas por defunción al personal de alto nivel y de dirección', 1),
(1556, 601, '67', 'Ayudas para medicinas, gastos médicos, odontológicos y de hospitalización al personal de alto nivel y de dirección', 1),
(1557, 601, '68', 'Aporte patronal a cajas de ahorro por personal de alto nivel y de dirección', 1),
(1558, 601, '69', 'Aporte patronal a los servicios de salud, accidentes personales y gastos funerarios por personal de alto nivel y de dirección', 1),
(1559, 601, '74', 'Capacitación y adiestramiento al personal contratado', 1),
(1560, 601, '75', 'Becas al personal contratado', 1),
(1561, 601, '76', 'Ayudas por matrimonio al personal contratado', 1),
(1562, 601, '77', 'Ayudas por nacimiento de hijos al personal contratado', 1),
(1563, 601, '78', 'Ayudas por defunción al personal contratado', 1),
(1564, 601, '79', 'Ayudas para medicinas, gastos médicos, odontológicos y de hospitalización al personal contratado', 1),
(1565, 601, '80', 'Aporte patronal a cajas de ahorro por personal contratado', 1),
(1566, 601, '81', 'Aporte patronal a los servicios de salud, accidentes personales y gastos funerarios por personal contratado', 1),
(1567, 601, '82', 'Ayudas al personal contratado para adquisición de uniformes y útiles escolares de sus hijos', 1),
(1568, 601, '83', 'Dotación de uniformes al personal contratado', 1),
(1569, 601, '84', 'Aporte patronal para gastos de guarderías y preescolar para hijos del personal contratado', 1),
(1570, 601, '85', 'Aportes para la adquisición de juguetes para los hijos del personal contratado', 1),
(1571, 601, '94', 'Otras subvenciones a altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
(1572, 601, '95', 'Otras subvenciones al personal de alto nivel y de dirección', 1),
(1573, 601, '96', 'Otras subvenciones a empleados', 1),
(1574, 601, '97', 'Otras subvenciones a obreros', 1),
(1575, 601, '98', 'Otras subvenciones al personal militar', 1),
(1576, 601, '99', 'Otras subvenciones al personal contratado', 1),
(1577, 602, '01', 'Prestaciones sociales e indemnizaciones a empleados', 1),
(1578, 602, '02', 'Prestaciones sociales e indemnizaciones a obreros', 1),
(1579, 602, '03', 'Prestaciones sociales e indemnizaciones al personal contratado', 1),
(1580, 602, '04', 'Prestaciones sociales e indemnizaciones al personal militar', 1),
(1581, 602, '06', 'Prestaciones sociales e indemnizaciones a altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
(1582, 602, '07', 'Prestaciones sociales e indemnizaciones al personal de alto nivel y Prestaciones sociales e indemnizaciones al personal de alto nivel y de dirección', 1),
(1583, 603, '01', 'Capacitación y adiestramiento realizado por personal del organismo', 1),
(1584, 604, '01', 'Otros gastos de los altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
(1585, 605, '01', 'Otros gastos del personal de alto nivel y de dirección', 1),
(1586, 606, '01', 'Otros gastos del personal empleado', 1),
(1587, 607, '01', 'Otros gastos del personal obrero', 1),
(1588, 608, '01', 'Otros gastos del personal militar', 1),
(1589, 609, '01', 'Alimentos y bebidas para personas', 1),
(1590, 609, '02', 'Alimentos para animales', 1),
(1591, 609, '03', 'Productos agrícolas y pecuarios', 1),
(1592, 609, '04', 'Productos de la caza y pesca', 1),
(1593, 609, '99', 'Otros productos alimenticios y agropecuarios', 1),
(1594, 610, '01', 'Carbón mineral', 1),
(1595, 610, '02', 'Petróleo crudo y gas natural', 1),
(1596, 610, '03', 'Mineral de hierro', 1),
(1597, 610, '04', 'Mineral no ferroso', 1),
(1598, 610, '05', 'Piedra, arcilla, arena y tierra', 1),
(1599, 610, '06', 'Mineral para la fabricación de productos químicos', 1),
(1600, 610, '07', 'Sal para uso industrial', 1),
(1601, 610, '99', 'Otros productos de minas, canteras y yacimientos', 1),
(1602, 611, '01', 'Textiles', 1),
(1603, 611, '02', 'Prendas de vestir', 1),
(1604, 611, '03', 'Calzados', 1),
(1605, 611, '99', 'Otros productos textiles y vestuarios', 1),
(1606, 612, '01', 'Cueros y pieles', 1),
(1607, 612, '02', 'Productos de cuero y sucedáneos del cuero', 1),
(1608, 612, '03', 'Cauchos y tripas para vehículos', 1),
(1609, 612, '99', 'Otros productos de cuero y caucho', 1),
(1610, 612, '99', 'Otros productos de cuero y caucho', 1),
(1611, 613, '01', 'Cueros y pieles', 1),
(1612, 613, '01', 'Pulpa de madera, papel y cartón', 1),
(1613, 613, '02', 'Productos de cuero y sucedáneos del cuero', 1),
(1614, 613, '02', 'Envases y cajas de papel y cartón', 1),
(1615, 613, '03', 'Cauchos y tripas para vehículos', 1),
(1616, 613, '03', 'Productos de papel y cartón para oficina', 1),
(1617, 613, '04', 'Libros, revistas y periódicos', 1),
(1618, 613, '05', 'Material de enseñanza', 1),
(1619, 613, '06', 'Productos de papel y cartón para computación', 1),
(1620, 613, '07', 'Productos de papel y cartón para la imprenta y reproducción', 1),
(1621, 613, '99', 'Otros productos de pulpa, papel y cartón', 1),
(1622, 614, '01', 'Sustancias químicas y de uso industrial', 1),
(1623, 614, '02', 'Abonos, plaguicidas y otros', 1),
(1624, 614, '03', 'Tintas, pinturas y colorantes', 1),
(1625, 614, '04', 'Productos farmacéuticos y medicamentos', 1),
(1626, 614, '05', 'Productos de tocador', 1),
(1627, 614, '06', 'Combustibles y lubricantes', 1),
(1628, 614, '07', 'Productos diversos derivados del petróleo y del carbón', 1),
(1629, 614, '08', 'Productos plásticos', 1),
(1630, 614, '09', 'Mezclas explosivas', 1),
(1631, 614, '99', 'Otros productos de la industria química y conexos', 1),
(1632, 615, '01', 'Productos de barro, loza y porcelana', 1),
(1633, 615, '02', 'Vidrios y productos de vidrio', 1),
(1634, 615, '03', 'Productos de arcilla para construcción', 1),
(1635, 615, '04', 'Cemento, cal y yeso', 1),
(1636, 615, '99', 'Otros productos minerales no metálicos', 1),
(1637, 616, '01', 'Productos primarios de hierro y acero', 1),
(1638, 616, '02', 'Productos de metales no ferrosos', 1),
(1639, 616, '03', 'Herramientas menores, cuchillería y artículos generales de ferretería', 1),
(1640, 616, '04', 'Productos metálicos estructurales', 1),
(1641, 616, '05', 'Materiales de orden público, seguridad y defensa', 1),
(1642, 616, '07', 'Material de señalamiento', 1),
(1643, 616, '08', 'Material de educación', 1),
(1644, 616, '09', 'Repuestos y accesorios para equipos de transporte', 1),
(1645, 616, '10', 'Repuestos y accesorios para otros equipos', 1),
(1646, 616, '99', 'Otros productos metálicos', 1),
(1647, 617, '01', 'Productos primarios de madera', 1),
(1648, 617, '02', 'Muebles y accesorios de madera para edificaciones', 1),
(1649, 617, '99', 'Otros productos de madera', 1),
(1650, 618, '01', 'Artículos de deporte, recreación y juguetes', 1),
(1651, 618, '02', 'Materiales y útiles de limpieza y aseo', 1),
(1652, 618, '03', 'Utensilios de cocina y comedor', 1),
(1653, 618, '04', 'Útiles menores médico - quirúrgicos de laboratorio, dentales y de veterinaria', 1),
(1654, 618, '05', 'Útiles de escritorio, oficina y materiales de instrucción', 1),
(1655, 618, '06', 'Condecoraciones, ofrendas y similares', 1),
(1656, 618, '07', 'Productos de seguridad en el trabajo', 1),
(1657, 618, '08', 'Materiales para equipos de computación', 1),
(1658, 618, '09', 'Especies timbradas y valores', 1),
(1659, 618, '10', 'Útiles religiosos', 1),
(1660, 618, '11', 'Materiales eléctricos', 1),
(1661, 618, '12', 'Materiales para instalaciones sanitarias', 1),
(1662, 618, '13', 'Materiales fotográficos', 1),
(1663, 618, '99', 'Otros productos y útiles diversos', 1),
(1664, 619, '01', 'Productos y artículos para la venta', 1),
(1665, 619, '02', 'Maquinarias y equipos para la venta', 1),
(1666, 619, '03', 'Inmuebles para la venta', 1),
(1667, 619, '04', 'Tierras y terrenos para la venta', 1),
(1668, 619, '99', 'Otros bienes para la venta', 1),
(1669, 620, '01', 'Otros materiales y suministros', 1),
(1670, 621, '01', 'Alquileres de edificios y locales', 1);
INSERT INTO `partida_especifica` (`id`, `generica`, `especifica`, `nombre`, `estatus`) VALUES
(1671, 621, '02', 'Alquileres de edificios y locales', 1),
(1672, 621, '03', 'Alquileres de tierras y terrenos', 1),
(1673, 622, '01', 'Alquileres de maquinaria y demás equipos de construcción, campo, industria y taller', 1),
(1674, 622, '02', 'Alquileres de equipos de transporte, tracción y elevación', 1),
(1675, 622, '03', 'Alquileres de equipos de comunicaciones y de señalamiento', 1),
(1676, 622, '04', 'Alquileres de equipos médico - quirúrgicos, dentales y de veterinaria', 1),
(1677, 622, '05', 'Alquileres de equipos científicos, religiosos, de enseñanza y recreación', 1),
(1678, 622, '06', 'Alquileres de máquinas, muebles y demás equipos de oficina y alojamiento', 1),
(1679, 622, '99', 'Alquileres de otras maquinaria y equipos', 1),
(1680, 623, '01', 'Marcas de fábrica y patentes de invención', 1),
(1681, 623, '02', 'Derechos de autor', 1),
(1682, 623, '03', 'Paquetes y programas de computación', 1),
(1683, 623, '04', 'Concesión de bienes y servicios', 1),
(1684, 624, '01', 'Electricidad', 1),
(1685, 624, '02', 'Gas', 1),
(1686, 624, '03', 'Agua', 1),
(1687, 624, '04', 'Teléfonos', 1),
(1688, 624, '05', 'Servicio de comunicaciones', 1),
(1689, 624, '06', 'Servicio de aseo urbano y domiciliario', 1),
(1690, 624, '07', 'Servicio de condominio', 1),
(1691, 625, '01', 'Servicio de administración, vigilancia y mantenimiento del servicio de electricidad', 1),
(1692, 625, '02', 'Servicio de administración, vigilancia y mantenimiento del servicio de gas', 1),
(1693, 625, '03', 'Servicio de administración, vigilancia y mantenimiento del servicio de agua', 1),
(1694, 625, '04', 'Servicio de administración, vigilancia y mantenimiento del servicio de teléfonos', 1),
(1695, 625, '05', 'Servicio de administración, vigilancia y mantenimiento del servicio de comunicaciones', 1),
(1696, 625, '06', 'Servicio de administración, vigilancia y mantenimiento del servicio de aseo urbano y domiciliario', 1),
(1697, 626, '01', 'Fletes y embalajes', 1),
(1698, 626, '02', 'Almacenaje', 1),
(1699, 626, '03', 'Estacionamiento', 1),
(1700, 626, '04', 'Peaje', 1),
(1701, 626, '05', 'Servicios de protección en traslado de fondos y de mensajería', 1),
(1702, 627, '01', 'Publicidad y propaganda', 1),
(1703, 627, '02', 'Imprenta y reproducción', 1),
(1704, 627, '03', 'Relaciones sociales', 1),
(1705, 627, '04', 'Avisos', 1),
(1706, 628, '01', 'Primas y gastos de seguros', 1),
(1707, 628, '02', 'Comisiones y gastos bancarios', 1),
(1708, 628, '03', 'Comisiones y gastos de adquisición de seguros', 1),
(1709, 629, '01', 'Viáticos y pasajes dentro del país', 1),
(1710, 629, '02', 'Viáticos y pasajes fuera del país', 1),
(1711, 629, '03', 'Asignación por kilómetros recorridos', 1),
(1712, 630, '01', 'Servicios jurídicos', 1),
(1713, 630, '02', 'Servicios de contabilidad y auditoría', 1),
(1714, 630, '03', 'Servicios de procesamiento de datos', 1),
(1715, 630, '04', 'Servicios de ingeniería y arquitectónicos', 1),
(1716, 630, '05', 'Servicios médicos, odontológicos y otros servicios de sanidad', 1),
(1717, 630, '06', 'Servicios de veterinaria', 1),
(1718, 630, '07', 'Servicios de capacitación y adiestramiento', 1),
(1719, 630, '08', 'Servicios presupuestarios', 1),
(1720, 630, '09', 'Servicios de lavandería y tintorería', 1),
(1721, 630, '10', 'Servicios de vigilancia y seguridad', 1),
(1722, 630, '11', 'Servicios para la elaboración y suministro de comida', 1),
(1723, 630, '99', 'Otros servicios profesionales y técnicos', 1),
(1724, 631, '01', 'Conservación y reparaciones menores de maquinaria y demás equipos de construcción, campo, industria y taller', 1),
(1725, 631, '02', 'Conservación y reparaciones menores de equipos de transporte, tracción y elevación', 1),
(1726, 631, '03', 'Conservación y reparaciones menores de equipos de comunicaciones y de señalamiento', 1),
(1727, 631, '04', 'Conservación y reparaciones menores de equipos médicoquirúrgicos dentales y de veterinaria', 1),
(1728, 631, '05', 'Conservación y reparaciones menores de equipos científicos, religiosos, de enseñanza y recreación', 1),
(1729, 631, '06', 'Conservación y reparaciones menores de equipos y armamentos de orden público, seguridad y defensa nacional', 1),
(1730, 631, '07', 'Conservación y reparaciones menores de máquinas, muebles y demás equipos de oficina y alojamiento', 1),
(1731, 631, '99', 'Conservación y reparaciones menores de otras maquinaria y equipos', 1),
(1732, 632, '01', 'Conservación y reparaciones menores de obras en bienes del dominio privado', 1),
(1733, 632, '02', 'Conservación y reparaciones menores de obras en bienes del dominio público', 1),
(1734, 633, '01', 'Servicios de construcciones temporales', 1),
(1735, 634, '01', 'Servicios de construcción de edificaciones para la venta', 1),
(1736, 635, '01', 'Derechos de importación y servicios aduaneros', 1),
(1737, 635, '02', 'Tasas y otros derechos obligatorios', 1),
(1738, 635, '03', 'Asignación a agentes de especies fiscales', 1),
(1739, 635, '99', 'Otros servicios fiscales', 1),
(1740, 636, '01', 'Servicios de diversión, esparcimiento y culturales', 1),
(1741, 637, '01', 'Servicios de gestión administrativa prestados por organismos de asistencia técnica', 1),
(1742, 638, '01', 'Impuesto al valor agregado', 1),
(1743, 638, '99', 'Otros impuestos indirectos', 1),
(1744, 639, '01', 'Comisiones por servicios para cumplir con los beneficios sociales', 1),
(1745, 640, '01', 'Otros servicios no personales', 1),
(1746, 641, '01', 'Repuestos mayores', 1),
(1747, 641, '02', 'Reparaciones, mejoras y adiciones mayores de maquinaria y equipos', 1),
(1748, 642, '01', 'Conservación, ampliaciones y mejoras mayores de obras en bienes del dominio privado', 1),
(1749, 642, '02', 'Conservación, ampliaciones y mejoras mayores de obras en bienes del dominio público', 1),
(1750, 643, '01', 'Maquinaria y demás equipos de construcción y mantenimiento', 1),
(1751, 643, '02', 'Maquinaria y equipos para mantenimiento de automotores', 1),
(1752, 643, '03', 'Maquinaria y equipos agrícolas y pecuarios', 1),
(1753, 643, '04', 'Maquinaria y equipos de artes gráficas y reproducción', 1),
(1754, 643, '05', 'Maquinaria y equipos industriales y de taller', 1),
(1755, 643, '06', 'Maquinaria y equipos de energía', 1),
(1756, 643, '07', 'Maquinaria y equipos de riego y acueductos', 1),
(1757, 643, '08', 'Equipos de almacén', 1),
(1758, 643, '99', 'Otra maquinaria y demás equipos de construcción, campo, industria y taller', 1),
(1759, 644, '01', 'Vehículos automotores terrestres', 1),
(1760, 644, '02', 'Equipos ferroviarios y de cables aéreos', 1),
(1761, 644, '03', 'Equipos marítimos de transporte', 1),
(1762, 644, '04', 'Equipos aéreos de transporte', 1),
(1763, 644, '05', 'Vehículos de tracción no motorizados', 1),
(1764, 644, '06', 'Equipos auxiliares de transporte', 1),
(1765, 644, '99', 'Otros equipos de transporte, tracción y elevación', 1),
(1766, 645, '01', 'Equipos de telecomunicaciones', 1),
(1767, 645, '02', 'Equipos de señalamiento', 1),
(1768, 645, '03', 'Equipos de control de tráfico aéreo', 1),
(1769, 645, '04', 'Equipos de correo', 1),
(1770, 645, '99', 'Otros equipos de comunicaciones y de señalamiento', 1),
(1771, 646, '01', 'Equipos médico - quirúrgicos, dentales y de veterinaria', 1),
(1772, 646, '99', 'Otros equipos médico - quirúrgicos, dentales y de veterinaria', 1),
(1773, 647, '01', 'Equipos científicos y de laboratorio', 1),
(1774, 647, '02', 'Equipos de enseñanza, deporte y recreación', 1),
(1775, 647, '03', 'Obras de arte', 1),
(1776, 647, '04', 'Libros, revistas y otros instrumentos de enseñanzas', 1),
(1777, 647, '05', 'Equipos religiosos', 1),
(1778, 647, '06', 'Instrumentos musicales y equipos de audio', 1),
(1779, 647, '99', 'Otros equipos científicos, religiosos, de enseñanza y recreación', 1),
(1780, 648, '01', 'Equipos y armamentos de orden público, seguridad y defensa nacional', 1),
(1781, 648, '02', 'Equipos y armamentos de seguridad para la custodia y resguardo personal', 1),
(1782, 648, '99', 'Otros equipos y armamentos de orden público, seguridad y defensa', 1),
(1783, 649, '01', 'Mobiliario y equipos de oficina', 1),
(1784, 649, '02', 'Equipos de computación', 1),
(1785, 649, '03', 'Mobiliario y equipos de alojamiento', 1),
(1786, 649, '99', 'Otras máquinas, muebles y demás equipos de oficina y alojamiento', 1),
(1787, 650, '01', 'Semovientes', 1),
(1788, 651, '01', 'Adquisición de tierras y terrenos', 1),
(1789, 651, '02', 'Adquisición de edificios e instalaciones', 1),
(1790, 651, '03', 'Expropiación de tierras y terrenos', 1),
(1791, 651, '04', 'Expropiación de edificios e instalaciones', 1),
(1792, 651, '05', 'Adquisición de maquinaria y equipos usados', 1),
(1793, 652, '01', 'Marcas de fábrica y patentes de invención', 1),
(1794, 652, '02', 'Derechos de autor', 1),
(1795, 652, '03', 'Gastos de organización', 1),
(1796, 652, '04', 'Paquetes y programas de computación', 1),
(1797, 652, '05', 'Estudios y proyectos', 1),
(1798, 652, '99', 'Otros activos intangibles', 1),
(1799, 653, '01', 'Estudios y proyectos aplicables a bienes del dominio privado', 1),
(1800, 653, '02', 'Estudios y proyectos aplicables a bienes del dominio público', 1),
(1801, 654, '01', 'Contratación de inspección de obras de bienes del dominio privado', 1),
(1802, 654, '02', 'Contratación de inspección de obras de bienes del dominio público', 1),
(1803, 655, '01', 'Construcciones de edificaciones médico-asistenciales', 1),
(1804, 655, '02', 'Construcciones de edificaciones militares y de seguridad', 1),
(1805, 655, '03', 'Construcciones de edificaciones educativas, religiosas y recreativas', 1),
(1806, 655, '04', 'Construcciones de edificaciones culturales y deportivas', 1),
(1807, 655, '05', 'Construcciones de edificaciones para oficina', 1),
(1808, 655, '06', 'Construcciones de edificaciones industriales', 1),
(1809, 655, '07', 'Construcciones de edificaciones habitacionales', 1),
(1810, 655, '99', 'Otras construcciones del dominio privado', 1),
(1811, 656, '01', 'Construcción de vialidad', 1),
(1812, 656, '02', 'Construcción de plazas, parques y similares', 1),
(1813, 656, '03', 'Construcciones de instalaciones hidráulicas', 1),
(1814, 656, '04', 'Construcciones de puertos y aeropuertos', 1),
(1815, 656, '99', 'Otras construcciones del dominio público', 1),
(1816, 657, '01', 'Otros activos reales', 1),
(1817, 658, '01', 'Aportes en acciones y participaciones de capital al sector privado', 1),
(1818, 658, '02', 'Aportes en acciones y participaciones de capital al sector público', 1),
(1819, 658, '03', 'Aportes en acciones y participaciones de capital al sector externo', 1),
(1820, 659, '01', 'Adquisición de títulos y valores a corto plazo', 1),
(1821, 659, '02', 'Adquisición de títulos y valores a largo plazo', 1),
(1822, 660, '01', 'Concesión de préstamos al sector público a corto plazo', 1),
(1823, 660, '02', 'Concesión de préstamos al sector público a corto plazo', 1),
(1824, 660, '03', 'Concesión de préstamos al sector externo a corto plazo', 1),
(1825, 661, '01', 'Concesión de préstamos al sector privado a largo plazo', 1),
(1826, 661, '02', 'Concesión de préstamos al sector público a largo plazo', 1),
(1827, 661, '03', 'Concesión de préstamos al sector externo a largo plazo', 1),
(1828, 662, '01', 'Incremento en caja', 1),
(1829, 662, '02', 'Incremento en bancos', 1),
(1830, 662, '03', 'Incremento de inversiones temporales', 1),
(1831, 663, '01', 'Incremento de cuentas comerciales por cobrar a corto plazo', 1),
(1832, 663, '02', 'Incremento de rentas por recaudar a corto plazo', 1),
(1833, 663, '03', 'Incremento de deudas por rendir', 1),
(1834, 663, '99', 'Incremento de otras cuentas por cobrar a corto plazo', 1),
(1835, 664, '01', 'Incremento de efectos comerciales por cobrar a corto plazo', 1),
(1836, 664, '99', 'Incremento de otros efectos por cobrar a corto plazo', 1),
(1837, 665, '01', 'Incremento de cuentas comerciales por cobrar a mediano y largo plazo', 1),
(1838, 665, '02', 'Incremento de rentas por recaudar a mediano y largo plazo', 1),
(1839, 665, '99', 'Incremento de otras cuentas por cobrar a mediano y largo plazo', 1),
(1840, 666, '01', 'Incremento de efectos comerciales por cobrar a mediano y largo plazo', 1),
(1841, 666, '99', 'Incremento de otros efectos por cobrar a mediano y largo plazo', 1),
(1842, 667, '01', 'Incremento de fondos en avance', 1),
(1843, 667, '02', 'Incremento de fondos en anticipos', 1),
(1844, 667, '03', 'Incremento de fondos en fideicomiso', 1),
(1845, 667, '04', 'Incremento de anticipos a proveedores', 1),
(1846, 667, '05', 'Incremento de anticipos a contratistas por contratos de corto plazo', 1),
(1847, 667, '06', 'Incremento de anticipos a contratistas por contratos de mediano y largo plazo', 1),
(1848, 668, '01', 'Incremento de gastos a corto plazo pagados por anticipado', 1),
(1849, 668, '02', 'Incremento de depósitos otorgados en garantía a corto plazo', 1),
(1850, 668, '99', 'Incremento de otros activos diferidos a corto plazo', 1),
(1851, 669, '01', 'Incremento de gastos a mediano y largo plazo pagados por anticipado', 1),
(1852, 669, '02', 'Incremento de depósitos otorgados en garantía a mediano y largo plazo', 1),
(1853, 669, '99', 'Incremento de otros activos diferidos a mediano y largo plazo', 1),
(1854, 670, '01', 'Incremento del Fondo de Estabilización Macroeconómica (FEM) de la República', 1),
(1855, 670, '02', 'Incremento del Fondo de Estabilización Macroeconómica (FEM) del Poder Estadal', 1),
(1856, 670, '03', 'Incremento del Fondo de Estabilización Macroeconómica (FEM) del Poder Municipal', 1),
(1857, 671, '01', 'Incremento del Fondo de Ahorro Intergeneracional', 1),
(1858, 672, '01', 'Incremento del Fondo de Aportes del Sector Público', 1),
(1859, 673, '01', 'Incremento de otros activos financieros circulantes', 1),
(1860, 674, '01', 'Incremento de activos en gestión judicial a mediano y largo plazo', 1),
(1861, 674, '02', 'Incremento de títulos y otros valores de la deuda pública en litigio a largo plazo', 1),
(1862, 674, '99', 'Incremento de otros activos financieros no circulantes', 1),
(1863, 675, '01', 'Otros activos financieros', 1),
(1864, 676, '01', 'Gastos de defensa y seguridad del Estado', 1),
(1865, 677, '01', 'Transferencias corrientes internas al sector privado', 1),
(1866, 677, '02', 'Donaciones corrientes internas al sector privado', 1),
(1867, 677, '03', 'Transferencias corrientes internas al sector público', 1),
(1868, 677, '04', 'Donaciones corrientes internas al sector público', 1),
(1869, 677, '05', 'Pensiones de altos funcionarios y altas funcionarias del poder público y de elección popular, del personal de alto nivel y de dirección', 1),
(1870, 677, '06', 'Jubilaciones de altos funcionarios y altas funcionarias del poder público y de elección popular, del personal de alto nivel y de dirección', 1),
(1871, 678, '01', 'Transferencias corrientes al exterior', 1),
(1872, 678, '02', 'Donaciones corrientes al exterior', 1),
(1873, 679, '01', 'Situado Constitucional', 1),
(1874, 679, '02', 'Situado Estadal a Municipal', 1),
(1875, 680, '01', 'Subsidio de Régimen Especial', 1),
(1876, 681, '01', 'Subsidio de capitalidad', 1),
(1877, 682, '01', 'Asignaciones Económicas Especiales (LAEE) Estadal', 1),
(1878, 682, '02', 'Asignaciones Económicas Especiales (LAEE) Estadal a Municipal', 1),
(1879, 682, '03', 'Asignaciones Económicas Especiales (LAEE) Municipal', 1),
(1880, 682, '04', 'Asignaciones Económicas Especiales (LAEE) Fondo Nacional de los Consejos Comunales', 1),
(1881, 682, '05', 'Asignaciones Económicas Especiales (LAEE) Apoyo al Fortalecimiento Institucional', 1),
(1882, 683, '01', 'Aportes al Poder Estadal por transferencia de servicios', 1),
(1883, 683, '02', 'Aportes al Poder Municipal por transferencia de servicios', 1),
(1884, 684, '01', 'Fondo Intergubernamental para la Descentralización (FIDES)', 1),
(1885, 685, '01', 'Fondo de Compensación Interterritorial Estadal', 1),
(1886, 685, '02', 'Fondo de Compensación Interterritorial Municipal', 1),
(1887, 685, '03', 'Fondo de Compensación Interterritorial Poder Popular', 1),
(1888, 685, '04', 'Fondo de Compensación Interterritorial Fortalecimiento Institucional', 1),
(1889, 686, '01', 'Transferencias y donaciones corrientes a Consejos Comunales', 1),
(1890, 686, '02', 'Transferencias y donaciones de capital a Consejos Comunales', 1),
(1891, 687, '01', 'Depreciación', 1),
(1892, 687, '02', 'Amortización', 1),
(1893, 688, '01', 'Intereses por depósitos internos', 1),
(1894, 688, '02', 'Intereses por títulos y valores', 1),
(1895, 688, '03', 'Intereses por otros financiamientos', 1),
(1896, 689, '01', 'Gastos de siniestros', 1),
(1897, 689, '02', 'Gastos de operaciones de reaseguros', 1),
(1898, 689, '99', 'Otros gastos de operaciones de seguro', 1),
(1899, 690, '01', 'Pérdidas en el proceso de distribución de los servicios', 1),
(1900, 690, '99', 'Otras pérdidas en operación', 1),
(1901, 691, '01', 'Devoluciones de cobros indebidos', 1),
(1902, 691, '02', 'Devoluciones y reintegros diversos', 1),
(1903, 691, '03', 'Indemnizaciones diversas', 1),
(1904, 692, '01', 'Pérdidas en inventarios', 1),
(1905, 692, '02', 'Pérdidas en operaciones cambiarias', 1),
(1906, 692, '03', 'Pérdidas en ventas de activos', 1),
(1907, 692, '04', 'Pérdidas por cuentas incobrables', 1),
(1908, 692, '05', 'Participación en pérdidas de otras empresas', 1),
(1909, 692, '06', 'Pérdidas por auto-seguro', 1),
(1910, 692, '07', 'Impuestos directos', 1),
(1911, 692, '08', 'Intereses de mora', 1),
(1912, 692, '09', 'Reservas técnicas', 1),
(1913, 693, '01', 'Descuentos sobre ventas', 1),
(1914, 693, '02', 'Bonificaciones por ventas', 1),
(1915, 693, '03', 'Devoluciones por ventas', 1),
(1916, 693, '04', 'Devoluciones por primas de seguro', 1),
(1917, 694, '01', 'Indemnizaciones por daños y perjuicios', 1),
(1918, 694, '02', 'Sanciones pecuniarias', 1),
(1919, 695, '01', 'Otros gastos', 1),
(1920, 696, '01', 'Asignaciones no distribuidas de la Asamblea Nacional', 1),
(1921, 697, '01', 'Asignaciones no distribuidas de la Contraloría General de la República', 1),
(1922, 698, '01', 'Asignaciones no distribuidas del Consejo Nacional Electoral', 1),
(1923, 699, '01', 'Asignaciones no distribuidas del Tribunal Supremo de Justicia', 1),
(1924, 700, '01', 'Asignaciones no distribuidas del Ministerio Público', 1),
(1925, 701, '01', 'Asignaciones no distribuidas de la Defensoría del Pueblo', 1),
(1926, 702, '01', 'Asignaciones no distribuidas del Consejo Moral Republicano', 1),
(1927, 703, '01', 'Reestructuración de organismos del sector público', 1),
(1928, 704, '01', 'Fondo de apoyo al trabajador y su grupo familiar de la Administración Pública Nacional', 1),
(1929, 704, '02', 'Fondo de apoyo al trabajador y su grupo familiar de las Entidades Federales, los Municipios y otras formas de gobierno municipal', 1),
(1930, 705, '01', 'Reforma de la seguridad social', 1),
(1931, 706, '01', 'Emergencias en el territorio nacional', 1),
(1932, 707, '01', 'Fondo para la cancelación de pasivos laborales', 1),
(1933, 708, '01', 'Fondo para la cancelación de deuda por servicios de electricidad teléfono, aseo, agua y condominio, de los organismos de la Administración Central', 1),
(1934, 708, '02', 'Fondo para la cancelación de deuda por servicios de electricidad teléfono, aseo, agua y condominio, de los organismos de la Administración Descentralizada Nacional', 1),
(1935, 709, '01', 'Fondo para remuneraciones, pensiones y jubilaciones y otras retribuciones', 1),
(1936, 710, '01', 'Fondo para atender compromisos generados de la Ley Orgánica del Trabajo, los Trabajadores y las Trabajadoras', 1),
(1937, 711, '01', 'Asignaciones para cancelar compromisos pendientes de ejercicios anteriores', 1),
(1938, 712, '01', 'Asignaciones para cancelar la deuda Fogade – Ministerio competente en Materia de Finanzas – Banco Central de Venezuela (BCV)', 1),
(1939, 713, '01', 'Asignaciones para atender los gastos de la referenda y elecciones', 1),
(1940, 714, '01', 'Asignaciones para atender los gastos por honorarios profesionales de bufetes internacionales, costas y costos judiciales', 1),
(1941, 715, '01', 'Fondo para atender compromisos generados por la contratación colectiva', 1),
(1942, 716, '01', 'Proyecto social especial', 1),
(1943, 717, '01', 'Asignaciones para programas y proyectos financiados con recursos de organismos multilaterales y/o bilaterales', 1),
(1944, 718, '01', 'Asignación para facilitar la preparación de proyectos', 1),
(1945, 719, '01', 'Programas de inversión para las entidades estadales municipalidades y otras instituciones', 1),
(1946, 720, '01', 'Cancelación de compromisos', 1),
(1947, 721, '01', 'Asignaciones para atender gastos de los organismos del sector público', 1),
(1948, 722, '01', 'Convenio de Cooperación Especial', 1),
(1949, 723, '01', 'Servicio de la deuda pública interna a corto plazo de títulos valores', 1),
(1950, 723, '02', 'Servicio de la deuda pública interna por préstamos a corto plazo', 1),
(1951, 723, '03', 'Servicio de la deuda pública interna indirecta por préstamos a corto plazo', 1),
(1952, 724, '01', 'Servicio de la deuda pública interna a largo plazo de títulos y valores', 1),
(1953, 724, '02', 'Servicio de la deuda pública interna por préstamos a largo plazo', 1),
(1954, 724, '03', 'Servicio de la deuda pública interna indirecta a largo plazo de títulos y valores', 1),
(1955, 724, '04', 'Servicio de la deuda pública interna indirecta por préstamos a largo plazo', 1),
(1956, 725, '01', 'Servicio de la deuda pública externa a corto plazo de títulos y valores', 1),
(1957, 725, '02', 'Servicio de la deuda pública externa por préstamos a corto plazo', 1),
(1958, 725, '03', 'Servicio de la deuda pública externa indirecta por préstamos a corto plazo', 1),
(1959, 726, '01', 'Servicio de la deuda pública externa a largo plazo de títulos y valores', 1),
(1960, 726, '02', 'Servicio de la deuda pública externa por préstamos a largo plazo', 1),
(1961, 726, '03', 'Servicio de la deuda pública externa indirecta a largo plazo de títulos y valores', 1),
(1962, 726, '04', 'Servicio de la deuda pública externa indirecta por préstamos a largo plazo', 1),
(1963, 727, '01', 'Disminución por reestructuración y/o refinanciamiento de la deuda interna a largo plazo, en a corto plazo', 1),
(1964, 727, '02', 'Disminución por reestructuración y/o refinanciamiento de la deuda interna a corto plazo, en a largo plazo', 1),
(1965, 727, '03', 'Disminución por reestructuración y/o refinanciamiento de la deuda externa a largo plazo, en a corto plazo', 1),
(1966, 727, '04', 'Disminución por reestructuración y/o refinanciamiento de la deuda externa a corto plazo, en a largo plazo', 1),
(1967, 727, '05', 'Disminución de la deuda pública por distribuir', 1),
(1968, 728, '01', 'Amortización de la deuda pública de obligaciones pendientes de ejercicios anteriores', 1),
(1969, 728, '02', 'Intereses de la deuda pública de obligaciones pendientes de ejercicios anteriores', 1),
(1970, 728, '03', 'Intereses por mora y multas de la deuda pública de obligaciones pendientes de ejercicios anteriores', 1),
(1971, 728, '04', 'Comisiones y otros gastos de la deuda pública de obligaciones pendientes de ejercicios anteriores', 1),
(1972, 729, '01', 'Disminución de sueldos, salarios y otras remuneraciones por pagar', 1),
(1973, 730, '01', 'Disminución de aportes patronales y retenciones laborales por pagar al Instituto Venezolano de los Seguros Sociales (IVSS)', 1),
(1974, 730, '02', 'Disminución de aportes patronales y retenciones laborales por pagar al Instituto de Previsión Social del Ministerio de Educación (Ipasme)', 1),
(1975, 730, '03', 'Disminución de aportes patronales y retenciones laborales por pagar al Fondo de Jubilaciones', 1),
(1976, 730, '04', 'Disminución de aportes patronales y retenciones laborales por pagar al Fondo de Seguro de Paro Forzoso', 1),
(1977, 730, '05', 'Disminución de aportes patronales y retenciones laborales por pagar al Fondo de Ahorro Obligatorio para la Vivienda (FAOV)', 1),
(1978, 730, '06', 'Disminución de aportes patronales y retenciones laborales por pagar al seguro de vida, accidentes personales, hospitalización, cirugía, maternidad (HCM) y gastos funerarios', 1),
(1979, 730, '07', 'Disminución de aportes patronales y retenciones laborales por pagar a cajas de ahorro', 1),
(1980, 730, '08', 'Disminución de aportes patronales por pagar a organismos de seguridad social', 1),
(1981, 730, '09', 'Disminución de retenciones laborales por pagar al Instituto Nacional de Capacitación y Educación Socialista (Inces)', 1),
(1982, 730, '10', 'Disminución de retenciones laborales por pagar por pensión alimenticia', 1),
(1983, 730, '98', 'Disminución de otros aportes legales por pagar', 1),
(1984, 730, '99', 'Disminución de otras retenciones laborales por pagar', 1),
(1985, 731, '01', 'Disminución de cuentas por pagar a proveedores a corto plazo', 1),
(1986, 731, '02', 'Disminución de efectos por pagar a proveedores a corto plazo', 1),
(1987, 731, '03', 'Disminución de cuentas por pagar a proveedores a mediano y largo plazo', 1),
(1988, 731, '04', 'Disminución de efectos por pagar a proveedores a mediano y largo plazo', 1),
(1989, 732, '01', 'Disminución de cuentas por pagar a contratistas a corto plazo', 1),
(1990, 732, '02', 'Disminución de efectos por pagar a contratistas a corto plazo', 1),
(1991, 732, '03', 'Disminución de cuentas por pagar a contratistas a mediano largo y plazo', 1),
(1992, 732, '04', 'Disminución de efectos por pagar a contratistas a mediano y plazo', 1),
(1993, 733, '01', 'Disminución de intereses internos por pagar', 1),
(1994, 733, '02', 'Disminución de intereses externos por pagar', 1),
(1995, 734, '01', 'Disminución de obligaciones de ejercicios anteriores', 1),
(1996, 734, '02', 'Disminución de otras cuentas por pagar a corto plazo', 1),
(1997, 734, '03', 'Disminución de otros efectos por pagar a corto plazo', 1),
(1998, 735, '01', 'Disminución de pasivos diferidos a corto plazo', 1),
(1999, 735, '02', 'Disminución de pasivos diferidos a mediano y largo plazo', 1),
(2000, 736, '01', 'Disminución de provisiones', 1),
(2001, 736, '02', 'Disminución de reservas técnicas', 1),
(2002, 737, '01', 'Disminución de depósitos a la vista', 1),
(2003, 737, '02', 'Disminución de depósitos a plazo fijo', 1),
(2004, 738, '01', 'Devoluciones de cobros indebidos', 1),
(2005, 738, '02', 'Devoluciones y reintegros diversos', 1),
(2006, 738, '03', 'Indemnizaciones diversas', 1),
(2007, 738, '04', 'Compromisos pendientes de ejercicios anteriores', 1),
(2008, 738, '05', 'Prestaciones sociales originadas por la aplicación de la Ley Orgánica del Trabajo, los Trabajadores y las Trabajadoras', 1),
(2009, 739, '01', 'Disminución de otros pasivos a corto plazo', 1),
(2010, 740, '01', 'Disminución del capital fiscal e institucional', 1),
(2011, 740, '02', 'Disminución de aportes por capitalizar', 1),
(2012, 740, '03', 'Disminución de dividendos a distribuir', 1),
(2013, 741, '01', 'Disminución de reservas', 1),
(2014, 742, '01', 'Ajuste por inflación', 1),
(2015, 743, '01', 'Disminución de resultados acumulados', 1),
(2016, 743, '02', 'Disminución de resultados del ejercicio', 1),
(2017, 744, '01', 'Rectificaciones al presupuesto', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partida_generica`
--

CREATE TABLE IF NOT EXISTS `partida_generica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_partida` int(11) NOT NULL,
  `generica` varchar(2) NOT NULL,
  `nombre` text NOT NULL,
  `estatus` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_partidad` (`id_partida`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=745 ;

--
-- Volcado de datos para la tabla `partida_generica`
--

INSERT INTO `partida_generica` (`id`, `id_partida`, `generica`, `nombre`, `estatus`) VALUES
(514, 2, '01', 'Impuestos directos', 0),
(515, 2, '02', 'Impuestos indirectos', 0),
(516, 2, '03', 'Ingresos por tasas', 0),
(517, 2, '04', 'Ingresos por contribuciones especiales', 0),
(518, 2, '05', 'Ingresos por aportes y contribuciones a la seguridad social', 0),
(519, 2, '06', 'Ingresos del dominio petrolero', 0),
(520, 2, '07', 'Ingresos del dominio minero', 0),
(521, 2, '08', 'Ingresos del dominio forestal', 0),
(522, 2, '09', 'Ingresos por la venta de bienes y servicios de la administración pública', 0),
(523, 2, '10', 'Ingresos de la propiedad', 0),
(524, 2, '11', 'Diversos ingresos', 0),
(525, 2, '99', 'Otros ingresos ordinarios', 0),
(526, 3, '01', 'Endeudamiento público interno', 0),
(527, 3, '02', 'Endeudamiento público externo', 0),
(528, 3, '03', 'Ingresos por operaciones diversas', 0),
(529, 3, '04', 'Reintegro de fondos correspondientes a ejercicios anteriores', 0),
(530, 3, '05', 'Ingresos por obtención indebida de devoluciones o reintegros', 0),
(531, 3, '06', 'Impuesto a las transacciones financieras', 0),
(532, 3, '99', 'Otros ingresos extraordinarios', 0),
(533, 4, '01', 'Venta bruta de bienes', 0),
(534, 4, '02', 'Venta bruta de servicios', 0),
(535, 4, '03', 'Ingresos financieros de instituciones financieras bancarias', 0),
(536, 4, '04', 'Ingresos financieros de instituciones financieras no bancarias', 0),
(537, 4, '05', 'Ingresos por operaciones de seguro', 0),
(538, 4, '99', 'Otros ingresos de operación', 0),
(539, 5, '01', 'Subsidios para precios y tarifas', 0),
(540, 5, '02', 'Incentivos a la exportación', 0),
(541, 5, '99', 'Otros ingresos ajenos a la operación', 0),
(542, 6, '01', 'Transferencias y donaciones corrientes', 0),
(543, 6, '02', 'Transferencias y donaciones de capital', 0),
(544, 6, '03', 'Situado', 0),
(545, 6, '04', 'Subsidio de Régimen Especial', 0),
(546, 6, '05', 'Subsidio de Capitalidad', 0),
(547, 6, '06', 'Asignaciones Económicas Especiales (LAEE)', 0),
(548, 6, '07', 'Fondo Intergubernamental para la Descentralización (FIDES)', 0),
(549, 6, '08', 'Fondo de Compensación Interterritorial', 0),
(550, 6, '09', 'Aportes del Sector Público al Poder Estadal y al Poder Municipal por transferencia de servicios', 0),
(551, 6, '10', 'Transferencias y donaciones de Organismos del Sector Público a los Consejos Comunales', 0),
(552, 7, '01', 'Venta y/o desincorporación de activos fijos', 0),
(553, 7, '02', 'Venta de activos intangibles', 0),
(554, 7, '03', 'Incremento de la depreciación y amortización acumuladas', 0),
(555, 8, '01', 'Venta de títulos y valores de corto plazo', 0),
(556, 8, '02', 'Venta de títulos y valores de largo plazo', 0),
(557, 9, '01', 'Venta de acciones y participaciones de capital del sector privado', 0),
(558, 9, '02', 'Venta de acciones y participaciones de capital del sector público', 0),
(559, 9, '03', 'Venta de acciones y participaciones de capital del sector externo', 0),
(560, 10, '01', 'Recuperación de préstamos otorgados al sector privado de corto plazo', 0),
(561, 10, '02', 'Recuperación de préstamos otorgados al sector público de corto plazo', 0),
(562, 10, '03', 'Recuperación de préstamos otorgados al sector externo de corto plazo', 0),
(563, 11, '01', 'Recuperación de préstamos otorgados al sector privado de largo plazo', 0),
(564, 11, '02', 'Recuperación de préstamos otorgados al sector público de largo plazo', 0),
(565, 11, '03', 'Recuperación de préstamos otorgados al sector externo de largo plazo', 0),
(566, 12, '01', 'Disminución de disponibilidades', 0),
(567, 12, '02', 'Disminución de cuentas por cobrar a corto plazo', 0),
(568, 12, '03', 'Disminución de efectos por cobrar a corto plazo', 0),
(569, 12, '04', 'Disminución de cuentas por cobrar a mediano y largo plazo', 0),
(570, 12, '05', 'Disminución de efectos por cobrar a mediano y largo plazo', 0),
(571, 12, '06', 'Disminución de fondos en avance, anticipo y en fideicomiso', 0),
(572, 12, '07', 'Disminución de activos diferidos a corto plazo', 0),
(573, 12, '08', 'Disminución de activos diferidos a mediano y largo plazo', 0),
(574, 12, '09', 'Disminución del Fondo de Estabilización Macroeconómica (FEM)', 0),
(575, 12, '10', 'Disminución del Fondo de Ahorro Intergeneracional', 0),
(576, 12, '12', 'Disminución del Fondo de Aporte del Sector Público', 0),
(577, 12, '20', 'Disminución de activos en proceso judicial', 0),
(578, 12, '99', 'Disminución de otros activos financieros', 0),
(579, 13, '01', 'Incremento de gastos de personal por pagar', 0),
(580, 13, '02', 'Incremento de aportes patronales y retenciones laborales por pagar', 0),
(581, 13, '03', 'Incremento de cuentas y efectos por pagar a proveedores', 0),
(582, 13, '04', 'Incremento de cuentas y efectos por pagar a contratistas', 0),
(583, 13, '05', 'Incremento de intereses por pagar', 0),
(584, 13, '06', 'Incremento de otras cuentas y efectos por pagar', 0),
(585, 13, '07', 'Incremento de pasivos diferidos', 0),
(586, 13, '08', 'Incremento de provisiones y reservas técnicas', 0),
(587, 13, '09', 'Incremento de fondos de terceros', 0),
(588, 13, '10', 'Incremento de depósitos en instituciones financieras', 0),
(589, 13, '11', 'Reestructuración y/o refinanciamiento de la deuda pública', 0),
(590, 13, '99', 'Incremento de otros pasivos', 0),
(591, 14, '01', 'Incremento del capital', 0),
(592, 14, '02', 'Incremento de reservas', 0),
(593, 14, '03', 'Ajustes por inflación', 0),
(594, 14, '04', 'Incremento de resultados', 0),
(595, 16, '01', 'Sueldos, salarios y otras retribuciones', 1),
(596, 16, '02', 'Compensaciones previstas en las escalas de sueldos y salarios', 1),
(597, 16, '03', 'Primas', 1),
(598, 16, '04', 'Complementos de sueldos y salarios', 1),
(599, 16, '05', 'Aguinaldos, utilidades o bonificación legal, y bono vacacional', 1),
(600, 16, '06', 'Aportes patronales y legales', 1),
(601, 16, '07', 'Asistencia socio-económica', 1),
(602, 16, '08', 'Prestaciones sociales e indemnizaciones', 1),
(603, 16, '09', 'Capacitación y adiestramiento realizado por personal del organismo', 1),
(604, 16, '94', 'Otros gastos de los altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
(605, 16, '95', 'Otros gastos del personal de alto nivel y de dirección', 1),
(606, 16, '96', 'Otros gastos del personal empleado', 1),
(607, 16, '97', 'Otros gastos del personal obrero', 1),
(608, 16, '98', 'Otros gastos del personal militar', 1),
(609, 17, '01', 'Productos alimenticios y agropecuarios', 1),
(610, 17, '02', 'Productos de minas, canteras y yacimientos', 1),
(611, 17, '03', 'Textiles y vestuarios', 1),
(612, 17, '04', 'Productos de cuero y caucho', 1),
(613, 17, '05', 'Productos de papel, cartón e impresos', 1),
(614, 17, '06', 'Productos químicos y derivados', 1),
(615, 17, '07', 'Productos minerales no metálicos', 1),
(616, 17, '08', 'Productos metálicos', 1),
(617, 17, '09', 'Productos de madera', 1),
(618, 17, '10', 'Productos varios y útiles diversos', 1),
(619, 17, '11', 'Bienes para la venta', 1),
(620, 17, '99', 'Otros materiales y suministros', 1),
(621, 18, '01', 'Alquileres de inmuebles', 1),
(622, 18, '02', 'Alquileres de maquinaria y equipos', 1),
(623, 18, '03', 'Derechos sobre bienes intangibles', 1),
(624, 18, '04', 'Servicios básicos', 1),
(625, 18, '05', 'Servicio de administración, vigilancia y mantenimiento de los servicios básicos', 1),
(626, 18, '06', 'Servicios de transporte y almacenaje', 1),
(627, 18, '07', 'Servicios de información, impresión y relaciones públicas', 1),
(628, 18, '08', 'Primas y otros gastos de seguros y comisiones bancarias', 1),
(629, 18, '09', 'Viáticos y pasajes', 1),
(630, 18, '10', 'Servicios profesionales, técnicos y demás oficios y ocupaciones', 1),
(631, 18, '11', 'Conservación y reparaciones menores de maquinaria y equipos', 1),
(632, 18, '12', 'Conservación y reparaciones menores de obras', 1),
(633, 18, '13', 'Servicios de construcciones temporales', 1),
(634, 18, '14', 'Servicios de construcción de edificaciones para la venta', 1),
(635, 18, '15', 'Servicios fiscales', 1),
(636, 18, '16', 'Servicios de diversión, esparcimiento y culturales', 1),
(637, 18, '17', 'Servicios de gestión administrativa prestados por organismos de asistencia técnica', 1),
(638, 18, '18', 'Impuestos indirectos', 1),
(639, 18, '19', 'Comisiones por servicios para cumplir con los beneficios sociales', 1),
(640, 18, '99', 'Otros servicios no personales', 1),
(641, 19, '01', 'Repuestos, reparaciones, mejoras y adiciones mayores', 1),
(642, 19, '02', 'Conservación, ampliaciones y mejoras mayores de obras', 1),
(643, 19, '03', 'Maquinaria y demás equipos de construcción, campo, industria y taller', 1),
(644, 19, '04', 'Equipos de transporte, tracción y elevación', 1),
(645, 19, '05', 'Equipos de comunicaciones y de señalamiento', 1),
(646, 19, '06', 'Equipos médico - quirúrgicos, dentales y de veterinaria', 1),
(647, 19, '07', 'Equipos científicos, religiosos, de enseñanza y recreación', 1),
(648, 19, '08', 'Equipos y armamentos de orden público, seguridad y defensa', 1),
(649, 19, '09', 'Máquinas, muebles y demás equipos de oficina y alojamiento', 1),
(650, 19, '10', 'Semovientes', 1),
(651, 19, '11', 'Inmuebles, maquinaria y equipos usados', 1),
(652, 19, '12', 'Activos intangibles', 1),
(653, 19, '13', 'Estudios y proyectos para inversión en activos fijos', 1),
(654, 19, '14', 'Contratación de inspección de obras', 1),
(655, 19, '15', 'Construcciones del dominio privado', 1),
(656, 19, '16', 'Construcciones del dominio público', 1),
(657, 19, '99', 'Otros activos reales', 1),
(658, 20, '01', 'Aportes en acciones y participaciones de capital', 1),
(659, 20, '02', 'Adquisición de títulos y valores que no otorgan propiedad', 1),
(660, 20, '03', 'Concesión de préstamos a corto plazo', 1),
(661, 20, '04', 'Concesión de préstamos a largo plazo', 1),
(662, 20, '05', 'Incremento de disponibilidades', 1),
(663, 20, '06', 'Incremento de cuentas por cobrar a corto plazo', 1),
(664, 20, '07', 'Incremento de efectos por cobrar a corto plazo', 1),
(665, 20, '08', 'Incremento de cuentas por cobrar a mediano y largo plazo', 1),
(666, 20, '09', 'Incremento de efectos por cobrar a mediano y largo plazo', 1),
(667, 20, '10', 'Incremento de fondos en avance, en anticipos y en fideicomiso', 1),
(668, 20, '11', 'Incremento de activos diferidos a corto plazo', 1),
(669, 20, '12', 'Incremento de activos diferidos a mediano y largo plazo', 1),
(670, 20, '13', 'Incremento del Fondo de Estabilización Macroeconómica (FEM)', 1),
(671, 20, '14', 'Incremento del Fondo de Ahorro Intergeneracional', 1),
(672, 20, '16', 'Incremento del Fondo de Aportes del Sector Público', 1),
(673, 20, '20', 'Incremento de otros activos financieros circulantes', 1),
(674, 20, '21', 'Incremento de otros activos financieros no circulantes', 1),
(675, 20, '99', 'Otros activos financieros', 1),
(676, 21, '01', 'Gastos de defensa y seguridad del Estado', 1),
(677, 22, '01', 'Transferencias y donaciones corrientes internas', 1),
(678, 22, '02', 'Transferencias y donaciones corrientes al exterior', 1),
(679, 22, '05', 'Situado', 1),
(680, 22, '06', 'Subsidio de Régimen Especial', 1),
(681, 22, '07', 'Subsidio de capitalidad', 1),
(682, 22, '08', 'Asignaciones Económicas Especiales (LAEE)', 1),
(683, 22, '09', 'Aportes al Poder Estadal y al Poder Municipal por transferencia de servicios', 1),
(684, 22, '10', 'Fondo Intergubernamental para la Descentralización (FIDES)', 1),
(685, 22, '11', 'Fondo de Compensación Interterritorial', 1),
(686, 22, '12', 'Transferencias y donaciones a Consejos Comunales', 1),
(687, 23, '01', 'Depreciación y amortización', 1),
(688, 23, '02', 'Intereses por operaciones financieras', 1),
(689, 23, '03', 'Gastos por operaciones de seguro', 1),
(690, 23, '04', 'Pérdida en operaciones de los servicios básicos', 1),
(691, 23, '05', 'Obligaciones en el ejercicio vigente', 1),
(692, 23, '06', 'Pérdidas ajenas a la operación', 1),
(693, 23, '07', 'Descuentos, bonificaciones y devoluciones', 1),
(694, 23, '08', 'Indemnizaciones y sanciones pecuniarias', 1),
(695, 23, '99', 'Otros gastos', 1),
(696, 24, '01', 'Asignaciones no distribuidas de la Asamblea Nacional', 1),
(697, 24, '02', 'Asignaciones no distribuidas de la Contraloría General de la República', 1),
(698, 24, '03', 'Asignaciones no distribuidas del Consejo Nacional Electoral', 1),
(699, 24, '04', 'Asignaciones no distribuidas del Tribunal Supremo de Justicia', 1),
(700, 24, '05', 'Asignaciones no distribuidas del Ministerio Público', 1),
(701, 24, '06', 'Asignaciones no distribuidas de la Defensoría del Pueblo', 1),
(702, 24, '07', 'Asignaciones no distribuidas del Consejo Moral Republicano', 1),
(703, 24, '08', 'Reestructuración de organismos del sector público', 1),
(704, 24, '09', 'Fondo de apoyo al trabajador y su grupo familiar', 1),
(705, 24, '10', 'Reforma de la seguridad social', 1),
(706, 24, '11', 'Emergencias en el territorio nacional', 1),
(707, 24, '12', 'Fondo para la cancelación de pasivos laborales', 1),
(708, 24, '13', 'Fondo para la cancelación de deuda por servicios de electricidad, teléfono, aseo, agua y condominio', 1),
(709, 24, '14', 'Fondo para remuneraciones, pensiones y jubilaciones y otras retribuciones', 1),
(710, 24, '15', 'Fondo para atender compromisos generados de la Ley Orgánica del Trabajo, los Trabajadores y las Trabajadoras', 1),
(711, 24, '16', 'Asignaciones para cancelar compromisos pendientes de ejercicios anteriores', 1),
(712, 24, '17', 'Asignaciones para cancelar la deuda Fogade – Ministerio competente en Materia de Finanzas – Banco Central de Venezuela (BCV)', 1),
(713, 24, '18', 'Asignaciones para atender los gastos de la referenda y elecciones', 1),
(714, 24, '19', 'Asignaciones para atender los gastos por honorarios profesionales de bufetes internacionales, costas y costos judiciales', 1),
(715, 24, '20', 'Fondo para atender compromisos generados por la contratación colectiva', 1),
(716, 24, '21', 'Proyecto social especial', 1),
(717, 24, '22', 'Asignaciones para programas y proyectos financiados con recursos de organismos multilaterales y/o bilaterales', 1),
(718, 24, '23', 'Asignación para facilitar la preparación de proyectos', 1),
(719, 24, '24', 'Programas de inversión para las entidades estadales, municipalidades y otras instituciones', 1),
(720, 24, '25', 'Cancelación de compromisos', 1),
(721, 24, '26', 'Asignaciones para atender gastos de los organismos del sector público', 1),
(722, 24, '27', 'Convenio de Cooperación Especial', 1),
(723, 25, '01', 'Servicio de la deuda pública interna a corto plazo', 1),
(724, 25, '02', 'Servicio de la deuda pública interna a largo plazo', 1),
(725, 25, '03', 'Servicio de la deuda pública externa a corto plazo', 1),
(726, 25, '04', 'Servicio de la deuda pública externa a largo plazo', 1),
(727, 25, '05', 'Reestructuración y/o refinanciamiento de la deuda publica', 1),
(728, 25, '06', 'Servicio de la deuda pública por obligaciones de ejercicios anteriores', 1),
(729, 26, '01', 'Disminución de gastos de personal por pagar', 1),
(730, 26, '02', 'Disminución de aportes patronales y retenciones laborales por pagar', 1),
(731, 26, '03', 'Disminución de cuentas y efectos por pagar a proveedores', 1),
(732, 26, '04', 'Disminución de cuentas y efectos por pagar a contratistas', 1),
(733, 26, '05', 'Disminución de intereses por pagar', 1),
(734, 26, '06', 'Disminución de otras cuentas y efectos por pagar a corto plazo', 1),
(735, 26, '07', 'Disminución de pasivos diferidos', 1),
(736, 26, '08', 'Disminución de provisiones y reservas técnicas', 1),
(737, 26, '10', 'Disminución de depósitos de instituciones financieras', 1),
(738, 26, '11', 'Obligaciones de ejercicios anteriores', 1),
(739, 26, '98', 'Disminución de otros pasivos a corto plazo', 1),
(740, 27, '01', 'Disminución del capital', 1),
(741, 27, '02', 'Disminución de reservas', 1),
(742, 27, '03', 'Ajuste por inflación', 1),
(743, 27, '04', 'Disminución de resultados', 1),
(744, 28, '01', 'Rectificaciones al presupuesto', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partida_partida`
--

CREATE TABLE IF NOT EXISTS `partida_partida` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cuenta` int(11) NOT NULL COMMENT 'ID Cuenta',
  `partida` varchar(2) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `ramo` (`cuenta`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Volcado de datos para la tabla `partida_partida`
--

INSERT INTO `partida_partida` (`id`, `cuenta`, `partida`, `nombre`, `estatus`) VALUES
(1, 1, '00', 'Recursos', 0),
(2, 1, '01', 'Ingresos Ordinarios', 0),
(3, 1, '02', 'Ingresos Extraordinarios', 0),
(4, 1, '03', 'Ingresos de Operación', 0),
(5, 1, '04', 'Ingresos Ajenos a la Operación', 0),
(6, 1, '05', 'Transferencias y Donaciones', 0),
(7, 1, '06', 'Recursos Propios de Capital', 0),
(8, 1, '07', 'Venta de Títulos y Valores que No Otorgan Propiedad', 0),
(9, 1, '08', 'Venta de Acciones y Participaciones de Capital', 0),
(10, 1, '09', 'Recuperación de Préstamos de Corto Plazo', 0),
(11, 1, '10', 'Recuperación de Préstamos de Largo Plazo', 0),
(12, 1, '11', 'Disminución de Otros Activos Financieros', 0),
(13, 1, '12', 'Incremento de Pasivos', 0),
(14, 1, '13', 'Incremento del Patrimonio', 0),
(15, 2, '00', 'Egresos', 1),
(16, 2, '01', 'Gastos de Personal', 1),
(17, 2, '02', 'Materiales, Suministros y Mercancías', 1),
(18, 2, '03', 'Servicios No Personales', 1),
(19, 2, '04', 'Activos Reales', 1),
(20, 2, '05', 'Activos Financieros', 1),
(21, 2, '06', 'Gastos de Defensa y Seguridad del Estado', 1),
(22, 2, '07', 'Transferencias y Donaciones', 1),
(23, 2, '08', 'Otros Gastos', 1),
(24, 2, '09', 'Asignaciones No Distribuidas', 1),
(25, 2, '10', 'Servicio de la Deuda Pública', 1),
(26, 2, '11', 'Disminución de pasivos', 1),
(27, 2, '12', 'Disminución del Patrimonio', 1),
(28, 2, '98', 'Rectificaciones al Presupuesto', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partida_sub_especifica`
--

CREATE TABLE IF NOT EXISTS `partida_sub_especifica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `especifica` int(11) NOT NULL,
  `sub_especifica` varchar(2) NOT NULL,
  `nombre` text NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id_se` (`especifica`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=699 ;

--
-- Volcado de datos para la tabla `partida_sub_especifica`
--

INSERT INTO `partida_sub_especifica` (`id`, `especifica`, `sub_especifica`, `nombre`, `estatus`) VALUES
(2, 1027, '01', 'Impuesto a empresas de hidrocarburos públicas', 0),
(3, 1027, '02', 'Impuesto a empresas de hidrocarburos públicas - operadoras y comercializadoras', 0),
(4, 1027, '03', 'Impuesto a empresas de hidrocarburos públicas - Petróleos de Venezuela, S.A (Pdvsa) Casa matriz y otras filiales', 0),
(5, 1027, '04', 'Impuesto adicional a empresas de hidrocarburos privadas', 0),
(6, 1027, '05', 'Impuesto adicional a empresas de hidrocarburos privadas - operadoras y comercializadoras', 0),
(7, 1027, '06', 'Impuesto adicional a empresas de hidrocarburos públicas - otras filiales de Petróleos de Venezuela, S.A. (Pdvsa)', 0),
(8, 1027, '07', 'Impuesto a empresas mineras sector hierro', 0),
(9, 1027, '08', 'Impuesto a empresas mineras sector otros minerales', 0),
(10, 1027, '09', 'Impuesto adicional a empresas mineras sector hierro', 0),
(11, 1027, '10', 'Impuesto adicional a empresas mineras sector otros minerales', 0),
(12, 1027, '11', 'Impuesto sobre la renta a otras personas jurídicas', 0),
(13, 1030, '01', 'Reparos administrativos por impuesto a empresas de hidrocarburos privada', 0),
(14, 1030, '02', 'Reparos administrativos a empresas de hidrocarburos públicas - operadoras y comercializadoras', 0),
(15, 1030, '03', 'Reparos administrativos a empresas de hidrocarburos públicas - otras filiales de Petróleos de Venezuela, S.A (Pdvsa)', 0),
(16, 1030, '04', 'Reparos administrativos a empresas mineras sector hierro', 0),
(17, 1030, '05', 'Reparos administrativos a empresas mineras sector otros minerales', 0),
(18, 1030, '06', 'Reparos administrativos a otras personas jurídicas', 0),
(19, 1033, '01', 'Impuesto de importación ordinario', 0),
(20, 1033, '02', 'Impuesto de importación de bultos postales', 0),
(21, 1033, '03', 'Impuesto interno por la importación de alcoholes y bebidas alcohólicas', 0),
(22, 1035, '01', 'Impuesto sobre alcoholes de producción nacional', 0),
(23, 1035, '02', 'Impuesto sobre bebidas alcohólicas de producción nacional', 0),
(24, 1035, '03', 'Impuesto sobre cerveza de producción nacional', 0),
(25, 1035, '04', 'Impuesto sobre vinos de producción nacional', 0),
(26, 1035, '05', 'Impuesto sobre el precio de venta al público de las cervezas y vinos naturales de producción nacional', 0),
(27, 1035, '06', 'Impuesto sobre el precio de venta al público de las cervezas y vinos naturales importados', 0),
(28, 1035, '07', 'Impuesto sobre el precio de venta al público de otras bebidas hasta 50.0° G.L. de producción nacional', 0),
(29, 1035, '08', 'Impuesto sobre el precio de venta al público de otras bebidas hasta 50.0° G.L. importadas', 0),
(30, 1035, '09', 'Impuesto sobre expedición al público de especies alcohólicas importadas', 0),
(31, 1035, '10', 'Impuesto sobre expedición al público de especies alcohólicas nacionales', 0),
(32, 1035, '11', 'Impuesto sobre la venta de cigarrillos, tabacos y picaduras importadas', 0),
(33, 1035, '12', 'Impuesto sobre la venta de cigarrillos, tabacos y picaduras de producción nacional', 0),
(34, 1035, '13', 'Impuesto a la producción de fósforos', 0),
(35, 1035, '14', 'Ventajas especiales por fabricación de fósforos', 0),
(36, 1035, '15', 'Impuesto al consumo propio de gasolina', 0),
(37, 1035, '16', 'Impuesto al consumo general a la gasolina', 0),
(38, 1035, '17', 'Impuesto al consumo propio de otros derivados del petróleo', 0),
(39, 1035, '18', 'Impuesto al consumo general de otros derivados del petróleo', 0),
(40, 1035, '19', 'Impuesto sobre telecomunicaciones', 0),
(41, 1035, '20', 'Impuesto al valor agregado sobre la importación de bienes y servicios', 0),
(42, 1035, '21', 'Impuesto al valor agregado sobre la producción, distribución y comercialización de bienes y servicios', 0),
(43, 1035, '22', 'Impuesto al valor agregado sobre los hechos imponibles realizados por empresas públicas, institutos autónomos y demás entes descentralizados', 0),
(44, 1035, '23', 'Reparos administrativos a impuestos al valor agregado', 0),
(45, 1035, '24', 'Impuesto al débito bancario', 0),
(46, 1035, '25', 'Reparos administrativos al impuesto al débito bancario', 0),
(47, 1035, '26', 'Impuesto al consumo propio de hidrocarburos gaseosos', 0),
(48, 1036, '01', 'Impuestos sobre casinos y salas de bingo', 0),
(49, 1036, '02', 'Impuestos de explotación de máquinas traganíqueles', 0),
(50, 1036, '03', 'Reparos administrativos impuesto casinos, salas de juego y máquinas traganíqueles', 0),
(51, 1036, '04', 'Impuesto a la operación de juegos de lotería', 0),
(52, 1036, '05', 'Impuesto a las apuestas sobre la explotación de espectáculos hípicos', 0),
(53, 1036, '06', 'Impuesto sobre la organización en general de juegos de envite o azar', 0),
(54, 1036, '07', 'Impuesto sobre apuestas deportivas', 0),
(55, 1036, '08', 'Reparos administrativos impuesto a la operación de juegos de lotería, apuestas sobre la explotación de espectáculos hípicos y organización en general de juegos de envite o azar y apuestas deportivas', 0),
(56, 1109, '01', 'Ingresos por aportes del sector privado', 0),
(57, 1109, '02', 'Ingresos por aportes del sector público', 0),
(58, 1110, '01', 'Contribuciones del sector privado', 0),
(59, 1110, '02', 'Contribuciones del sector público', 0),
(60, 1111, '01', 'Regalías petroleras privadas', 0),
(61, 1111, '02', 'Regalías petroleras públicas - crudos y condensados', 0),
(62, 1111, '03', 'Regalías petroleras públicas - extrapesado para orimulsión', 0),
(63, 1111, '04', 'Regalías del gas empresas privadas', 0),
(64, 1111, '05', 'Regalías del gas empresas públicas', 0),
(65, 1119, '01', 'Superficial sobre hierro', 0),
(66, 1119, '02', 'Superficial sobre oro y diamante', 0),
(67, 1119, '03', 'Superficial sobre otros minerales', 0),
(68, 1120, '01', 'Impuesto de explotación sobre hierro', 0),
(69, 1120, '02', 'Impuesto de explotación sobre oro, plata, platino y otros metales asociados a este último', 0),
(70, 1120, '03', 'Impuesto de explotación sobre diamante y demás piedras preciosas', 0),
(71, 1120, '04', 'Impuesto de explotación sobre otros minerales', 0),
(72, 1130, '01', 'Ingresos por la venta de gacetas municipales y formularios', 0),
(73, 1130, '02', 'Ingresos por la venta de publicaciones oficiales y formularios', 0),
(74, 1131, '01', 'Ingresos por la venta de productos de lotería', 0),
(75, 1135, '01', 'Intereses por depósitos a la vista', 0),
(76, 1135, '02', 'Intereses por depósitos a plazo fijo', 0),
(77, 1136, '01', 'Intereses de títulos y valores privados', 0),
(78, 1136, '02', 'Intereses de títulos y valores públicos', 0),
(79, 1136, '03', 'Intereses de títulos y valores externos', 0),
(80, 1137, '01', 'Utilidades de acciones y participaciones de capital del sector privado empresarial', 0),
(81, 1137, '02', 'Utilidades de acciones y participaciones de capital de entes descentralizados con fines empresariales petroleros – dividendos de Petróleos de Venezuela, S.A (Pdvsa)', 0),
(82, 1137, '03', 'Utilidades de acciones y participaciones de capital de entes descentralizados con fines empresariales petroleros – otras empresas petroleras', 0),
(83, 1137, '04', 'Utilidades de acciones y participaciones de capital de entes descentralizados con fines empresariales no petroleros', 0),
(84, 1137, '05', 'Utilidades de acciones y participaciones de capital de entes descentralizados financieros bancarios', 0),
(85, 1137, '06', 'Utilidades de acciones y participaciones de capital de entes descentralizados financieros no bancarios', 0),
(86, 1137, '07', 'Utilidades de acciones y participaciones de capital de organismos internacionales', 0),
(87, 1137, '08', 'Utilidades de acciones y participaciones de capital de otros entes del sector externo', 0),
(88, 1137, '09', 'Utilidades netas semestrales Banco Central de Venezuela (BCV)', 0),
(89, 1138, '01', 'Utilidades de explotación de juegos de azar por concesiones', 0),
(90, 1138, '02', 'Utilidades de explotación de juegos de azar de empresas públicas', 0),
(91, 1139, '01', 'Alquileres de edificios y locales', 0),
(92, 1139, '02', 'Alquileres de tierras y terrenos', 0),
(93, 1139, '03', 'Alquileres de instalaciones culturales y recreativas', 0),
(94, 1139, '04', 'Alquileres de máquinas y demás equipos de construcción, campo, industria y taller', 0),
(95, 1139, '05', 'Alquileres de equipos de transporte, tracción y elevación', 0),
(96, 1139, '06', 'Alquileres de equipos de telecomunicaciones y señalamiento', 0),
(97, 1139, '07', 'Alquileres de equipos médico - quirúrgicos, dentales y de veterinaria', 0),
(98, 1139, '08', 'Alquileres de equipos científicos, de enseñanza y recreación', 0),
(99, 1139, '09', 'Alquileres de máquinas, muebles y demás equipos de oficina y alojamiento', 0),
(100, 1139, '99', 'Alquileres de otros bienes', 0),
(101, 1140, '01', 'Marcas de fábrica y patentes de invención', 0),
(102, 1140, '02', 'Derechos de autor', 0),
(103, 1140, '03', 'Paquetes y programas de computación', 0),
(104, 1145, '01', 'Ingresos por el principal en sentencias judiciales', 0),
(105, 1145, '02', 'Costas procesales varias', 0),
(106, 1145, '03', 'Responsabilidad fiscal', 0),
(107, 1145, '04', 'Otras disposiciones legales', 0),
(108, 1145, '05', 'Indemnización por incumplimiento de contratos', 0),
(109, 1145, '06', 'Juicios y costas procesales por impuesto sobre la renta', 0),
(110, 1155, '01', 'Colocación de bonos a corto plazo', 0),
(111, 1155, '02', 'Colocación de letras del tesoro a corto plazo', 0),
(112, 1156, '01', 'Obtención de préstamos del sector privado a corto plazo', 0),
(113, 1156, '02', 'Obtención de préstamos de la República a corto plazo', 0),
(114, 1156, '03', 'Obtención de préstamos de los entes descentralizados sin fines empresariales a corto plazo', 0),
(115, 1156, '04', 'Obtención de préstamos de las instituciones de protección social a corto plazo', 0),
(116, 1156, '05', 'Obtención de préstamos de los entes descentralizados con fines empresariales petroleros a corto plazo', 0),
(117, 1156, '06', 'Obtención de préstamos de los entes descentralizados con fines empresariales no petroleros a corto plazo', 0),
(118, 1156, '07', 'Obtención de préstamos de entes descentralizados financieros bancarios a corto plazo', 0),
(119, 1156, '08', 'Obtención de préstamos de entes descentralizados financieros no bancarios a corto plazo', 0),
(120, 1156, '09', 'Obtención de préstamos del Poder Estadal a corto plazo', 0),
(121, 1156, '10', 'Obtención de préstamos del Poder Municipal a corto plazo', 0),
(122, 1157, '01', 'Colocación de bonos a largo plazo', 0),
(123, 1157, '02', 'Colocación de letras del tesoro a largo plazo', 0),
(124, 1158, '01', 'Obtención de préstamos del sector privado a largo plazo', 0),
(125, 1158, '02', 'Obtención de préstamos de la República a largo plazo', 0),
(126, 1158, '03', 'Obtención de préstamos de los entes descentralizados sin fines empresariales a largo plazo', 0),
(127, 1158, '04', 'Obtención de préstamos de las instituciones de protección social a largo plazo', 0),
(128, 1158, '05', 'Obtención de préstamos de los entes descentralizados con fines empresariales petroleros a largo plazo', 0),
(129, 1158, '06', 'Obtención de préstamos de los entes descentralizados con fines empresariales no petroleros a largo plazo', 0),
(130, 1158, '07', 'Obtención de préstamos de entes descentralizados financieros bancarios a largo plazo', 0),
(131, 1158, '08', 'Obtención de préstamos de entes descentralizados financieros no bancarios a largo plazo', 0),
(132, 1158, '09', 'Obtención de préstamos del Poder Estadal a largo plazo', 0),
(133, 1158, '10', 'Obtención de préstamos del Poder Municipal a largo plazo', 0),
(134, 1160, '01', 'Obtención de préstamos de gobiernos extranjeros a corto plazo', 0),
(135, 1160, '02', 'Obtención de préstamos de organismos internacionales a corto plazo', 0),
(136, 1160, '03', 'Obtención de préstamos de instituciones financieras externas a corto plazo', 0),
(137, 1160, '04', 'Obtención de préstamos de proveedores de bienes y servicios externos a corto plazo', 0),
(138, 1162, '01', 'Obtención de préstamos de gobiernos extranjeros a largo plazo', 0),
(139, 1162, '02', 'Obtención de préstamos de organismos internacionales a largo plazo', 0),
(140, 1162, '03', 'Obtención de préstamos de instituciones financieras externas a largo plazo', 0),
(141, 1162, '04', 'Obtención de préstamos de proveedores de bienes y servicios externos a largo plazo', 0),
(142, 1166, '01', 'Cuotas por participación', 0),
(143, 1166, '02', 'Bonos de desempate', 0),
(144, 1166, '99', 'Otros ingresos por procesos licitatorios', 0),
(145, 1193, '01', 'Transferencias corrientes internas de personas', 0),
(146, 1193, '02', 'Transferencias corrientes internas de instituciones sin fines de lucro', 0),
(147, 1193, '03', 'Transferencias corrientes internas de empresas privadas', 0),
(148, 1194, '01', 'Donaciones corrientes internas de personas', 0),
(149, 1194, '02', 'Donaciones corrientes internas de instituciones sin fines de lucro', 0),
(150, 1194, '03', 'Donaciones corrientes internas de empresas privadas', 0),
(151, 1195, '01', 'Transferencias corrientes internas de la República', 0),
(152, 1195, '02', 'Transferencias corrientes internas de entes descentralizados sin fines empresariales', 0),
(153, 1195, '03', 'Transferencias corrientes internas de instituciones de protección social', 0),
(154, 1195, '04', 'Transferencias corrientes internas de entes descentralizados con fines empresariales petroleros', 0),
(155, 1195, '05', 'Transferencias corrientes internas de entes descentralizados con fines empresariales no petroleros', 0),
(156, 1195, '06', 'Transferencias corrientes internas de entes descentralizados financieros bancarios', 0),
(157, 1195, '07', 'Transferencias corrientes internas de entes descentralizados financieros no bancarios', 0),
(158, 1195, '08', 'Transferencias corrientes internas del Poder Estadal', 0),
(159, 1195, '09', 'Transferencias corrientes internas del Poder Municipal', 0),
(160, 1195, '99', 'Otras transferencias corrientes internas del sector público', 0),
(161, 1196, '01', 'Donaciones corrientes internas de la República', 0),
(162, 1196, '02', 'Donaciones corrientes internas de entes descentralizados sin fines empresariales', 0),
(163, 1196, '03', 'Donaciones corrientes internas de instituciones de protección social', 0),
(164, 1196, '04', 'Donaciones corrientes internas de entes descentralizados con fines empresariales petroleros', 0),
(165, 1196, '05', 'Donaciones corrientes internas de entes descentralizados con fines empresariales no petroleros', 0),
(166, 1196, '06', 'Donaciones corrientes internas de entes descentralizados financieros bancarios', 0),
(167, 1196, '07', 'Donaciones corrientes internas de entes descentralizados financieros no bancarios', 0),
(168, 1196, '08', 'Donaciones corrientes internas del Poder Estadal', 0),
(169, 1196, '09', 'Donaciones corrientes internas del Poder Municipal', 0),
(170, 1197, '01', 'Transferencias corrientes de instituciones sin fines de lucro', 0),
(171, 1197, '02', 'Transferencias corrientes de gobiernos extranjeros', 0),
(172, 1197, '03', 'Transferencias corrientes de organismos internacionales', 0),
(173, 1198, '01', 'Donaciones corrientes de personas', 0),
(174, 1198, '02', 'Donaciones corrientes de instituciones sin fines de lucro', 0),
(175, 1198, '03', 'Donaciones corrientes de gobiernos extranjeros', 0),
(176, 1198, '04', 'Donaciones corrientes de organismos internacionales', 0),
(177, 1199, '01', 'Transferencias de capital internas de personas', 0),
(178, 1199, '02', 'Transferencias de capital internas de instituciones sin fines de lucro', 0),
(179, 1199, '03', 'Transferencias de capital internas de empresas privadas', 0),
(180, 1200, '01', 'Donaciones de capital internas de personas', 0),
(181, 1200, '02', 'Donaciones de capital internas de instituciones sin fines de lucro', 0),
(182, 1200, '03', 'Donaciones de capital internas de empresas privadas', 0),
(183, 1201, '01', 'Transferencias de capital internas de la República', 0),
(184, 1201, '02', 'Transferencias de capital internas de entes descentralizados sin fines empresariales', 0),
(185, 1201, '03', 'Transferencias de capital internas de instituciones de protección social', 0),
(186, 1201, '04', 'Transferencias de capital internas de entes descentralizados con fines empresariales petroleros', 0),
(187, 1201, '05', 'Transferencias de capital internas de entes descentralizados con fines empresariales no petroleros', 0),
(188, 1201, '06', 'Transferencias de capital internas de entes descentralizados financieros bancarios', 0),
(189, 1201, '07', 'Transferencias de capital internas de entes descentralizados financieros no bancarios', 0),
(190, 1201, '08', 'Transferencias de capital internas del Poder Estadal', 0),
(191, 1201, '09', 'Transferencias de capital internas del Poder Municipal', 0),
(192, 1201, '99', 'Otras transferencias de capital del sector público', 0),
(193, 1202, '01', 'Donaciones de capital internas de la República', 0),
(194, 1202, '02', 'Donaciones de capital internas de entes descentralizados sin fines empresariales', 0),
(195, 1202, '03', 'Donaciones de capital internas de instituciones de protección social', 0),
(196, 1202, '04', 'Donaciones de capital internas de entes descentralizados con fines empresariales petroleros', 0),
(197, 1202, '05', 'Donaciones de capital internas de entes descentralizados con fines empresariales no petroleros', 0),
(198, 1202, '06', 'Donaciones de capital internas de entes descentralizados financieros bancarios', 0),
(199, 1202, '07', 'Donaciones de capital internas de entes descentralizados financieros no bancarios', 0),
(200, 1202, '08', 'Donaciones de capital internas del Poder Estadal', 0),
(201, 1202, '09', 'Donaciones de capital internas del Poder Municipal', 0),
(202, 1203, '01', 'Transferencias de capital de instituciones sin fines de lucro', 0),
(203, 1203, '02', 'Transferencias de capital de gobiernos extranjeros', 0),
(204, 1203, '03', 'Transferencias de capital de organismos internacionales', 0),
(205, 1204, '01', 'Donaciones de capital de personas', 0),
(206, 1204, '02', 'Donaciones de capital de instituciones sin fines de lucro', 0),
(207, 1204, '03', 'Donaciones de capital de gobiernos extranjeros', 0),
(208, 1204, '04', 'Donaciones de capital de organismos internacionales', 0),
(209, 1205, '01', 'Situado Estadal', 0),
(210, 1205, '02', 'Situado Municipal', 0),
(211, 1221, '01', 'Transferencias corrientes de Organismos del Sector Público a los Consejos Comunales', 0),
(212, 1221, '02', 'Donaciones corrientes de Organismos del Sector Público a los Consejos Comunales', 0),
(213, 1222, '01', 'Transferencias de capital de Organismos del Sector Público a los Consejos Comunales', 0),
(214, 1222, '02', 'Donaciones de capital de Organismos del Sector Público a los Consejos Comunales', 0),
(215, 1225, '01', 'Venta y/o desincorporación de maquinarias y demás equipos de construcción, campo, industria y taller', 0),
(216, 1225, '02', 'Venta y/o desincorporación de equipos de transporte, tracción y elevación', 0),
(217, 1225, '03', 'Venta y/o desincorporación de equipos de comunicaciones y de señalamiento', 0),
(218, 1225, '04', 'Venta y/o desincorporación de equipos médico - quirúrgicos, dentales y de veterinaria', 0),
(219, 1225, '05', 'Venta y/o desincorporación de equipos científicos, religiosos, de enseñanza y recreación', 0),
(220, 1225, '06', 'Venta y/o desincorporación de equipos para la seguridad pública', 0),
(221, 1225, '07', 'Venta y/o desincorporación de máquinas, muebles y demás equipos de oficina y alojamiento', 0),
(222, 1225, '08', 'Venta y/o desincorporación de semovientes', 0),
(223, 1225, '99', 'Venta y/o desincorporación de otros activos fijos', 0),
(224, 1232, '01', 'Incremento de la depreciación acumulada de edificios e instalaciones', 0),
(225, 1232, '02', 'Incremento de la depreciación acumulada de maquinarias y demás equipos de construcción, campo, industria y taller', 0),
(226, 1232, '03', 'Incremento de la depreciación acumulada de equipos de transporte, tracción y elevación', 0),
(227, 1232, '04', 'Incremento de la depreciación acumulada de equipos de comunicaciones y de señalamiento', 0),
(228, 1232, '05', 'Incremento de la depreciación acumulada de equipos médico quirúrgicos, dentales y de veterinaria', 0),
(229, 1232, '06', 'Incremento de la depreciación acumulada de equipos científicos, religiosos, de enseñanza y recreación', 0),
(230, 1232, '07', 'Incremento de la depreciación acumulada de equipos para la seguridad pública', 0),
(231, 1232, '08', 'Incremento de la depreciación acumulada de máquinas, muebles y demás equipos de oficina y alojamiento', 0),
(232, 1232, '09', 'Incremento de la depreciación acumulada de semovientes', 0),
(233, 1232, '99', 'Incremento de la depreciación acumulada de otros activos fijos', 0),
(234, 1233, '01', 'Incremento de la amortización acumulada de marcas de fábrica y patentes de invención', 0),
(235, 1233, '02', 'Incremento de la amortización acumulada de derechos de autor', 0),
(236, 1233, '03', 'Incremento de la amortización acumulada de gastos de organización', 0),
(237, 1233, '04', 'Incremento de la amortización acumulada de paquetes y programas de computación', 0),
(238, 1233, '05', 'Incremento de la amortización acumulada de estudios y proyectos', 0),
(239, 1233, '99', 'Incremento de la amortización acumulada de otros activos intangibles', 0),
(240, 1276, '01', 'Disminución de bancos públicos', 0),
(241, 1276, '02', 'Disminución de bancos privados', 0),
(242, 1276, '03', 'Disminución de bancos en el exterior', 0),
(243, 1280, '01', 'Disminución de deudas de cuentadantes por rendir de fondos en avance a corto plazo', 0),
(244, 1280, '02', 'Disminución de deudas de cuentadantes por rendir de fondos en anticipos a corto plazo', 0),
(245, 1295, '01', 'Disminución de intereses de la deuda pública interna a corto plazo pagados por anticipado', 0),
(246, 1295, '02', 'Disminución de intereses de la deuda pública externa a corto plazo pagados por anticipado', 0),
(247, 1295, '03', 'Disminución de otros intereses a corto plazo pagados por anticipado', 0),
(248, 1295, '04', 'Disminución de débitos por apertura de cartas de crédito a corto plazo', 0),
(249, 1295, '99', 'Disminución de otros gastos a corto plazo pagados por anticipado', 0),
(250, 1298, '01', 'Disminución de intereses de la deuda pública interna a largo plazo pagados por anticipado', 0),
(251, 1298, '02', 'Disminución de intereses de la deuda pública externa a largo plazo pagados por anticipado', 0),
(252, 1298, '03', 'Disminución de otros intereses a mediano y largo plazo pagados por anticipado', 0),
(253, 1298, '99', 'Disminución de otros gastos a mediano y largo plazo pagados por anticipado', 0),
(254, 1321, '01', 'Incremento de otros aportes patronales por pagar', 0),
(255, 1321, '02', 'Incremento de otras retenciones laborales por pagar', 0),
(256, 1335, '01', 'Incremento de rentas diferidas por recaudar a corto plazo', 0),
(257, 1336, '01', 'Incremento de colocación de certificados de reintegro tributario', 0),
(258, 1336, '02', 'Incremento de colocación de bonos de exportación', 0),
(259, 1336, '03', 'Incremento de colocación de bonos en dación de pagos', 0),
(260, 1337, '01', 'Incremento de provisiones para cuentas incobrables', 0),
(261, 1337, '02', 'Incremento de provisiones para despidos', 0),
(262, 1337, '03', 'Incremento de provisiones para pérdidas de inventarios', 0),
(263, 1337, '04', 'Incremento de provisiones para beneficios sociales', 0),
(264, 1337, '99', 'Incremento de otras provisiones', 0),
(265, 1341, '01', 'Incremento de depósitos a la vista de organismos del sector público', 0),
(266, 1341, '02', 'Incremento de depósitos a la vista de personas naturales y jurídicas del sector privado', 0),
(267, 1342, '01', 'Incremento de depósitos a plazo fijo de organismos del sector público', 0),
(268, 1342, '02', 'Incremento de depósitos a plazo fijo de personas naturales y jurídicas del sector privado', 0),
(269, 1347, '01', 'Incremento de la deuda pública interna por distribuir', 0),
(270, 1347, '02', 'Incremento de la deuda pública externa por distribuir', 0),
(271, 1366, '01', 'Remuneraciones al personal contratado a tiempo determinado', 1),
(272, 1366, '02', 'Remuneraciones por honorarios profesionales', 1),
(273, 1687, '01', 'Servicios de telefonía prestados por organismos públicos', 1),
(274, 1687, '02', 'Servicios de telefonía prestados por instituciones privadas', 1),
(275, 1746, '01', 'Repuestos mayores para maquinaria y demás equipos de construcción, campo, industria y taller', 1),
(276, 1746, '02', 'Repuestos mayores para equipos de transporte, tracción y elevación', 1),
(277, 1746, '03', 'Repuestos mayores para equipos de comunicaciones y de señalamiento', 1),
(278, 1746, '04', 'Repuestos mayores para equipos médico-quirúrgicos, dentales y de veterinaria', 1),
(279, 1746, '05', 'Repuestos mayores para equipos científicos, religiosos, de enseñanza y recreación', 1),
(280, 1746, '06', 'Repuestos mayores para equipos y armamentos de orden público, seguridad y defensa', 1),
(281, 1746, '07', 'Repuestos mayores para máquinas, muebles y demás equipos de oficina y alojamiento', 1),
(282, 1746, '99', 'Repuestos mayores para otras maquinaria y equipos', 1),
(283, 1747, '01', 'Reparaciones, mejoras y adiciones mayores de maquinaria y demás equipos de construcción, campo, industria y taller', 1),
(284, 1747, '02', 'Reparaciones, mejoras y adiciones mayores de equipos de transporte, tracción y elevación', 1),
(285, 1747, '03', 'Reparaciones, mejoras y adiciones mayores de equipos de comunicaciones y de señalamiento', 1),
(286, 1747, '04', 'Reparaciones, mejoras y adiciones mayores de equipos médico quirúrgicos, dentales y de veterinaria', 1),
(287, 1747, '05', 'Reparaciones, mejoras y adiciones mayores de equipos científicos, religiosos, de enseñanza y recreación', 1),
(288, 1747, '06', 'Reparaciones, mejoras y adiciones mayores de equipos y armamentos de orden público, seguridad y defensa nacional', 1),
(289, 1747, '07', 'Reparaciones, mejoras y adiciones mayores de máquinas, muebles y demás equipos de oficina y alojamiento', 1),
(290, 1747, '99', 'Reparaciones, mejoras y adiciones mayores de otras maquinaria y equipos', 1),
(291, 1792, '01', 'Maquinaria y demás equipos de construcción, campo, industria y taller', 1),
(292, 1792, '02', 'Equipos de transporte, tracción y elevación', 1),
(293, 1792, '03', 'Equipos de comunicaciones y de señalamiento', 1),
(294, 1792, '04', 'Equipos médico - quirúrgicos, dentales y de veterinaria', 1),
(295, 1792, '05', 'Equipos científicos, religiosos, de enseñanza y recreación', 1),
(296, 1792, '06', 'Equipos para seguridad pública', 1),
(297, 1792, '07', 'Máquinas, muebles y demás equipos de oficina y alojamiento', 1),
(298, 1792, '99', 'Otras maquinaria y equipos usados', 1),
(299, 1818, '01', 'Aportes en acciones y participaciones de capital a entes descentralizados sin fines empresariales', 1),
(300, 1818, '02', 'Aportes en acciones y participaciones de capital a instituciones de protección social', 1),
(301, 1818, '03', 'Aportes en acciones y participaciones de capital a entes descentralizados con fines empresariales petroleros', 1),
(302, 1818, '04', 'Aportes en acciones y participaciones de capital a entes descentralizados con fines empresariales no petroleros', 1),
(303, 1818, '05', 'Aportes en acciones y participaciones de capital a entes descentralizados financieros bancarios', 1),
(304, 1818, '06', 'Aportes en acciones y participaciones de capital a entes descentralizados financieros no bancarios', 1),
(305, 1818, '07', 'Aportes en acciones y participaciones de capital a organismos del sector público para el pago de su deuda', 1),
(306, 1819, '01', 'Aportes en acciones y participaciones de capital a organismos internacionales', 1),
(307, 1819, '99', 'Otros aportes en acciones y participaciones de capital al sector externo', 1),
(308, 1820, '01', 'Adquisición de títulos y valores privados', 1),
(309, 1820, '02', 'Adquisición de títulos y valores públicos', 1),
(310, 1820, '03', 'Adquisición de títulos y valores externos', 1),
(311, 1821, '01', 'Adquisición de títulos y valores privados', 1),
(312, 1821, '02', 'Adquisición de títulos y valores públicos', 1),
(313, 1821, '03', 'Adquisición de títulos y valores externos', 1),
(314, 1823, '01', 'Concesión de préstamos a la República', 1),
(315, 1823, '02', 'Concesión de préstamos a entes descentralizados sin fines empresariales', 1),
(316, 1823, '03', 'Concesión de préstamos a instituciones de protección social', 1),
(317, 1823, '04', 'Concesión de préstamos a entes descentralizados con fines empresariales petroleros', 1),
(318, 1823, '05', 'Concesión de préstamos a entes descentralizados con fines empresariales no petroleros', 1),
(319, 1823, '06', 'Concesión de préstamos a entes descentralizados financieros bancarios', 1),
(320, 1823, '07', 'Concesión de préstamos a entes descentralizados financieras no bancarios', 1),
(321, 1823, '08', 'Concesión de préstamos al Poder Estadal', 1),
(322, 1823, '09', 'Concesión de préstamos al Poder Municipal', 1),
(323, 1824, '01', 'Concesión de préstamos a instituciones sin fines de lucro', 1),
(324, 1824, '02', 'Concesión de préstamos a gobiernos extranjeros', 1),
(325, 1824, '03', 'Concesión de préstamos a organismos internacionales', 1),
(326, 1826, '01', 'Concesión de préstamos a la República', 1),
(327, 1826, '02', 'Concesión de préstamos a entes descentralizados sin fines empresariales', 1),
(328, 1826, '03', 'Concesión de préstamos a instituciones de protección social', 1),
(329, 1826, '04', 'Concesión de préstamos a entes descentralizados con fines empresariales petroleros', 1),
(330, 1826, '05', 'Concesión de préstamos a entes descentralizados con fines empresariales no petroleros', 1),
(331, 1826, '06', 'Concesión de préstamos a entes descentralizados financieros bancarios', 1),
(332, 1826, '07', 'Concesión de préstamos a entes descentralizados financieros no bancarios', 1),
(333, 1826, '08', 'Concesión de préstamos al Poder Estadal', 1),
(334, 1826, '09', 'Concesión de préstamos al Poder Municipal', 1),
(335, 1827, '01', 'Concesión de préstamos a instituciones sin fines de lucro', 1),
(336, 1827, '02', 'Concesión de préstamos a gobiernos extranjeros', 1),
(337, 1827, '03', 'Concesión de préstamos a organismos internacionales', 1),
(338, 1829, '01', 'Incremento en bancos públicos', 1),
(339, 1829, '02', 'Incremento en bancos privados', 1),
(340, 1829, '03', 'Incremento en bancos del exterior', 1),
(341, 1833, '01', 'Incremento de deudas por rendir de fondos en avance', 1),
(342, 1833, '02', 'Incremento de deudas por rendir de fondos en anticipo', 1),
(343, 1848, '01', 'Incremento de intereses de la deuda pública interna a corto plazo pagados por anticipado', 1),
(344, 1848, '02', 'Incremento de intereses de la deuda pública externa a corto plazo pagados por anticipado', 1),
(345, 1848, '03', 'Incremento de otros intereses a corto plazo pagados por anticipado', 1),
(346, 1848, '04', 'Incremento de débitos por apertura de carta de crédito a corto plazo', 1),
(347, 1848, '99', 'Incremento de otros gastos a corto plazo pagados por anticipado', 1),
(348, 1851, '01', 'Incremento de intereses de la deuda pública interna a largo plazo pagados por anticipado', 1),
(349, 1851, '02', 'Incremento de intereses de la deuda pública externa a largo plazo pagados por anticipado', 1),
(350, 1851, '08', 'Incremento de otros intereses a mediano y largo plazo pagados por anticipado', 1),
(351, 1851, '99', 'Incremento de otros gastos a mediano y largo plazo pagados por anticipado', 1),
(352, 1865, '01', 'Pensiones del personal empleado, obrero y militar', 1),
(353, 1865, '02', 'Jubilaciones del personal empleado, obrero y militar', 1),
(354, 1865, '03', 'Becas escolares', 1),
(355, 1865, '04', 'Becas universitarias en el país', 1),
(356, 1865, '05', 'Becas de perfeccionamiento profesional en el país', 1),
(357, 1865, '06', 'Becas para estudios en el extranjero', 1),
(358, 1865, '07', 'Otras becas', 1),
(359, 1865, '08', 'Previsión por accidentes de trabajo', 1),
(360, 1865, '09', 'Aguinaldos al personal empleado, obrero y militar pensionado', 1),
(361, 1865, '10', 'Aportes a caja de ahorro del personal empleado, obrero y militar pensionado', 1),
(362, 1865, '11', 'Aportes a los servicios de salud, accidentes personales y gastos funerarios del personal empleado, obrero y militar pensionado', 1),
(363, 1865, '12', 'Otras subvenciones socio - económicas del personal empleado obrero y militar pensionado', 1),
(364, 1865, '13', 'Aguinaldos al personal empleado, obrero y militar jubilado', 1),
(365, 1865, '14', 'Aportes a caja de ahorro del personal empleado, obrero y militar jubilado', 1),
(366, 1865, '15', 'Aportes a los servicios de salud, accidentes personales y gastos funerarios del personal empleado, obrero y militar jubilado', 1),
(367, 1865, '16', 'Otras subvenciones socio - económicas del personal empleado, obrero y militar jubilado', 1),
(368, 1865, '30', 'Incapacidad temporal sin hospitalización', 1),
(369, 1865, '31', 'Incapacidad temporal con hospitalización', 1),
(370, 1865, '32', 'Reposo por maternidad', 1),
(371, 1865, '33', 'Indemnización por paro forzoso', 1),
(372, 1865, '34', 'Otros tipos de incapacidad temporal', 1),
(373, 1865, '35', 'Indemnización por comisión por pensiones', 1),
(374, 1865, '36', 'Indemnización por comisión por cesantía', 1),
(375, 1865, '37', 'Incapacidad parcial', 1),
(376, 1865, '38', 'Invalidez', 1),
(377, 1865, '39', 'Pensiones por vejez, viudez y orfandad', 1),
(378, 1865, '40', 'Indemnización por cesantía', 1),
(379, 1865, '41', 'Otras pensiones y demás prestaciones en dinero', 1),
(380, 1865, '42', 'Incapacidad parcial por accidente común', 1),
(381, 1865, '43', 'Incapacidad parcial por enfermedades profesionales', 1),
(382, 1865, '44', 'Incapacidad parcial por accidente de trabajo', 1),
(383, 1865, '45', 'Indemnización única por invalidez', 1),
(384, 1865, '46', 'Indemnización única por vejez', 1),
(385, 1865, '47', 'Sobrevivientes por enfermedad común', 1),
(386, 1865, '48', 'Sobrevivientes por accidente común', 1),
(387, 1865, '49', 'Sobrevivientes por enfermedades profesionales', 1),
(388, 1865, '50', 'Sobrevivientes por accidentes de trabajo', 1),
(389, 1865, '51', 'Indemnizaciones por conmutación de renta', 1),
(390, 1865, '52', 'Indemnizaciones por conmutación de pensiones', 1),
(391, 1865, '53', 'Indemnizaciones por comisión de renta', 1),
(392, 1865, '54', 'Asignación por nupcias', 1),
(393, 1865, '55', 'Asignación por funeraria', 1),
(394, 1865, '56', 'Otras asignaciones', 1),
(395, 1865, '70', 'Subsidios educacionales al sector privado', 1),
(396, 1865, '71', 'Subsidios a universidades privadas', 1),
(397, 1865, '72', 'Subsidios culturales al sector privado', 1),
(398, 1865, '73', 'Subsidios a instituciones benéficas privadas', 1),
(399, 1865, '74', 'Subsidios a centros de empleados', 1),
(400, 1865, '75', 'Subsidios a organismos laborales y gremiales', 1),
(401, 1865, '76', 'Subsidios a entidades religiosas', 1),
(402, 1865, '77', 'Subsidios a entidades deportivas y recreativas de carácter privado', 1),
(403, 1865, '78', 'Subsidios científicos al sector privado', 1),
(404, 1865, '79', 'Subsidios a cooperativas', 1),
(405, 1865, '80', 'Subsidios a empresas privadas', 1),
(406, 1865, '99', 'Otras transferencias corrientes internas al sector privado', 1),
(407, 1866, '01', 'Donaciones corrientes a personas', 1),
(408, 1866, '02', 'Donaciones corrientes a instituciones sin fines de lucro', 1),
(409, 1867, '01', 'Transferencias corrientes a la República', 1),
(410, 1867, '02', 'Transferencias corrientes a entes descentralizados sin fines empresariales', 1),
(411, 1867, '03', 'Transferencias corrientes a entes descentralizados sin fines empresariales para atender beneficios de la seguridad social', 1),
(412, 1867, '04', 'Transferencias corrientes a instituciones de protección social', 1),
(413, 1867, '05', 'Transferencias corrientes a instituciones de protección social para atender beneficios de la seguridad social', 1),
(414, 1867, '06', 'Transferencias corrientes a entes descentralizados con fines empresariales petroleros', 1),
(415, 1867, '07', 'Transferencias corrientes a entes descentralizados con fines empresariales no petroleros', 1),
(416, 1867, '08', 'Transferencias corrientes a entes descentralizados financieros bancarios', 1),
(417, 1867, '09', 'Transferencias corrientes a entes descentralizados financieros no bancarios', 1),
(418, 1867, '10', 'Transferencias corrientes al Poder Estadal', 1),
(419, 1867, '11', 'Transferencias corrientes al Poder Municipal', 1),
(420, 1867, '13', 'Subsidios otorgados por normas externas', 1),
(421, 1867, '14', 'Incentivos otorgados por normas externas', 1),
(422, 1867, '15', 'Subsidios otorgados por precios políticos', 1),
(423, 1867, '16', 'Subsidios de costos sociales por normas externas', 1),
(424, 1867, '99', 'Otras transferencias corrientes internas al sector público', 1),
(425, 1868, '01', 'Donaciones corrientes a la República', 1),
(426, 1868, '02', 'Donaciones corrientes a entes descentralizados sin fines empresariales', 1),
(427, 1868, '03', 'Donaciones corrientes a instituciones de protección social', 1),
(428, 1868, '04', 'Donaciones corrientes a entes descentralizados con fines empresariales petroleros', 1),
(429, 1868, '05', 'Donaciones corrientes a entes descentralizados con fines empresariales no petroleros', 1),
(430, 1868, '06', 'Donaciones corrientes a entes descentralizados financieros bancarios', 1),
(431, 1868, '07', 'Donaciones corrientes a entes descentralizados financieros no bancarios', 1),
(432, 1868, '08', 'Donaciones corrientes al Poder Estadal', 1),
(433, 1868, '09', 'Donaciones corrientes al Poder Municipal', 1),
(434, 1869, '01', 'Pensiones de altos funcionarios y altas funcionarias del poder público y de elección popular', 1),
(435, 1869, '02', 'Pensiones del personal de alto nivel y de dirección', 1),
(436, 1869, '06', 'Aguinaldos de altos funcionarios y altas funcionarias del poder público y de elección popular pensionados', 1),
(437, 1869, '07', 'Aguinaldos del personal pensionado de alto nivel y de dirección', 1),
(438, 1869, '11', 'Aportes a caja de ahorro de altos funcionarios y altas funcionarias del poder público y de elección popular pensionados', 1),
(439, 1869, '12', 'Aportes a caja de ahorro del personal pensionado de alto nivel y de dirección', 1),
(440, 1869, '16', 'Aportes a los servicios de salud, accidentes personales y gastos funerarios de altos funcionarios y altas funcionarias del poder público y de elección popular pensionados', 1),
(441, 1869, '17', 'Aportes a los servicios de salud, accidentes personales y gastos funerarios del personal pensionado de alto nivel y de dirección', 1),
(442, 1869, '98', 'Otras subvenciones de altos funcionarios y altas funcionarias del poder público y de elección popular pensionados', 1),
(443, 1869, '99', 'Otras subvenciones del personal pensionado de alto nivel y de dirección', 1),
(444, 1870, '01', 'Jubilaciones de altos funcionarios y altas funcionarias del poder público y de elección popular, del personal de alto nivel y de dirección público y de elección popular', 1),
(445, 1870, '02', 'Jubilaciones del personal de alto nivel y de dirección', 1),
(446, 1870, '06', 'Aguinaldos de altos funcionarios y altas funcionarias del poder público y de elección popular jubilados', 1),
(447, 1870, '07', 'Aguinaldos del personal jubilado de alto nivel y de dirección', 1),
(448, 1870, '11', 'Aportes a caja de ahorro de altos funcionarios y altas funcionarias del poder público y de elección popular jubilados', 1),
(449, 1870, '12', 'Aportes a caja de ahorro del personal jubilado de alto nivel y de dirección', 1),
(450, 1870, '16', 'Aportes a los servicios de salud, accidentes personales y gastos funerarios de altos funcionarios y altas funcionarias del poder público y de elección popular jubilados', 1),
(451, 1870, '17', 'Aportes a los servicios de salud, accidentes personales y gastos funerarios del personal jubilado de alto nivel y de dirección', 1),
(452, 1870, '98', 'Otras subvenciones de altos funcionarios y altas funcionarias del poder público y de elección popular jubilados', 1),
(453, 1870, '99', 'Otras subvenciones del personal jubilado de alto nivel y de dirección', 1),
(454, 1871, '01', 'Becas de capacitación e investigación en el exterior', 1),
(455, 1871, '02', 'Transferencias corrientes a instituciones sin fines de lucro', 1),
(456, 1871, '03', 'Transferencias corrientes a gobiernos extranjeros', 1),
(457, 1871, '04', 'Transferencias corrientes a organismos internacionales', 1),
(458, 1872, '01', 'Donaciones corrientes a personas', 1),
(459, 1872, '02', 'Donaciones corrientes a instituciones sin fines de lucro', 1),
(460, 1872, '03', 'Donaciones corrientes a gobiernos extranjeros', 1),
(461, 1872, '04', 'Donaciones corrientes a organismos internacionales', 1),
(462, 1873, '01', 'Situado Estadal', 1),
(463, 1873, '02', 'Situado Municipal', 1),
(464, 1889, '01', 'Transferencias corrientes a Consejos Comunales', 1),
(465, 1889, '02', 'Donaciones corrientes a Consejos Comunales', 1),
(466, 1890, '01', 'Transferencias de capital a Consejos Comunales', 1),
(467, 1890, '02', 'Donaciones de capital a Consejos Comunales', 1),
(468, 1891, '01', 'Depreciación de edificios e instalaciones', 1),
(469, 1891, '02', 'Depreciación de maquinaria y demás equipos de construcción campo, industria y taller', 1),
(470, 1891, '03', 'Depreciación de equipos de transporte, tracción y elevación', 1),
(471, 1891, '04', 'Depreciación de equipos de comunicaciones y de señalamiento', 1),
(472, 1891, '05', 'Depreciación de equipos médico - quirúrgicos, dentales y de veterinaria', 1),
(473, 1891, '06', 'Depreciación de equipos científicos, religiosos, de enseñanza y recreación', 1),
(474, 1891, '07', 'Depreciación de equipos para la seguridad pública', 1),
(475, 1891, '08', 'Depreciación de máquinas, muebles y demás equipos de oficina y alojamiento', 1),
(476, 1891, '09', 'Depreciación de semovientes', 1),
(477, 1891, '99', 'Depreciación de otros bienes de uso', 1),
(478, 1892, '01', 'Amortización de marcas de fábrica y patentes de invención', 1),
(479, 1892, '02', 'Amortización de derechos de autor', 1),
(480, 1892, '03', 'Amortización de gastos de organización', 1),
(481, 1892, '04', 'Amortización de paquetes y programas de computación', 1),
(482, 1892, '05', 'Amortización de estudios y proyectos', 1),
(483, 1892, '99', 'Amortización de otros activos intangibles', 1),
(484, 1917, '01', 'Indemnizaciones por daños y perjuicios ocasionados por organismos de la República, del Poder Estadal y del Poder Municipal', 1),
(485, 1917, '02', 'Indemnizaciones por daños y perjuicios ocasionados por entes descentralizados sin fines empresariales', 1),
(486, 1917, '03', 'Indemnizaciones por daños y perjuicios ocasionados por entes descentralizados con fines empresariales', 1),
(487, 1918, '01', 'Sanciones pecuniarias impuestas a los organismos de la República, del Poder Estadal y del Poder Municipal', 1),
(488, 1918, '02', 'Sanciones pecuniarias impuestas a los entes descentralizados sin fines empresariales', 1),
(489, 1918, '03', 'Sanciones pecuniarias impuestas a los entes descentralizados con fines empresariales', 1),
(490, 1949, '01', 'Amortización de la deuda pública interna a corto plazo de títulos y valores', 1),
(491, 1949, '02', 'Amortización de la deuda pública interna a corto plazo de letras del tesoro', 1),
(492, 1949, '03', 'Intereses de la deuda pública interna a corto plazo de títulos y valores', 1),
(493, 1949, '04', 'Intereses por mora y multas de la deuda pública interna a corto plazo de títulos y valores', 1),
(494, 1949, '05', 'Comisiones y otros gastos de la deuda pública interna a corto plazo de títulos y valores', 1),
(495, 1949, '06', 'Descuentos en colocación de títulos y valores de la deuda pública interna a corto plazo', 1),
(496, 1949, '07', 'Descuentos en colocación de letras del tesoro a corto plazo', 1),
(497, 1950, '01', 'Amortización de la deuda pública interna por préstamos recibidos del sector privado a corto plazo', 1),
(498, 1950, '02', 'Amortización de la deuda pública interna por préstamos recibidos de la República a corto plazo', 1),
(499, 1950, '03', 'Amortización de la deuda pública interna por préstamos recibidos de entes descentralizados sin fines empresariales a corto plazo', 1),
(500, 1950, '04', 'Amortización de la deuda pública interna por préstamos recibidos de instituciones de protección social a corto plazo', 1),
(501, 1950, '05', 'Amortización de la deuda pública interna por préstamos recibidos de entes descentralizados con fines empresariales petroleros a corto plazo', 1),
(502, 1950, '06', 'Amortización de la deuda pública interna por préstamos recibidos de entes descentralizados con fines empresariales no petroleros a corto plazo', 1),
(503, 1950, '07', 'Amortización de la deuda pública interna por préstamos recibidos de entes descentralizados financieros bancarios a corto plazo', 1),
(504, 1950, '08', 'Amortización de la deuda pública interna por préstamos recibidos de entes descentralizados financieros no bancarios a corto plazo', 1),
(505, 1950, '09', 'Amortización de la deuda pública interna por préstamos recibidos del Poder Estadal a corto plazo', 1),
(506, 1950, '10', 'Amortización de la deuda pública interna por préstamos recibidos del Poder Municipal a corto plazo', 1),
(507, 1950, '11', 'Intereses de la deuda pública interna por préstamos recibidos del sector privado a corto plazo', 1),
(508, 1950, '12', 'Intereses de la deuda pública interna por préstamos recibidos de la República a corto plazo', 1),
(509, 1950, '13', 'Intereses de la deuda pública interna por préstamos recibidos de entes descentralizados sin fines empresariales a corto plazo', 1),
(510, 1950, '14', 'Intereses de la deuda pública interna por préstamos recibidos de instituciones de protección social a corto plazo', 1),
(511, 1950, '15', 'Intereses de la deuda pública interna por préstamos recibidos de entes descentralizados con fines empresariales petroleros a corto plazo', 1),
(512, 1950, '16', 'Intereses de la deuda pública interna por préstamos recibidos de entes descentralizados con fines empresariales no petroleros a corto plazo', 1),
(513, 1950, '17', 'Intereses de la deuda pública interna por préstamos recibidos de entes descentralizados financieros bancarios a corto plazo', 1),
(514, 1950, '18', 'Intereses de la deuda pública interna por préstamos recibidos de entes descentralizados financieros no bancarios a corto plazo', 1),
(515, 1950, '19', 'Intereses de la deuda pública interna por préstamos recibidos del Poder Estadal a corto plazo', 1),
(516, 1950, '20', 'Intereses de la deuda pública interna por préstamos recibidos del Poder Municipal a corto plazo', 1),
(517, 1950, '21', 'Intereses por mora y multas de la deuda pública interna por préstamos recibidos del sector privado a corto plazo', 1),
(518, 1950, '22', 'Intereses por mora y multas de la deuda pública interna por préstamos recibidos de la República a corto plazo', 1),
(519, 1950, '23', 'Intereses por mora y multas de la deuda pública interna por préstamos recibidos de entes descentralizados sin fines empresariales a corto plazo', 1),
(520, 1950, '24', 'Intereses por mora y multas de la deuda pública interna por préstamos recibidos de instituciones de protección social a corto plazo', 1),
(521, 1950, '25', 'Intereses por mora y multas de la deuda pública interna por préstamos recibidos de entes descentralizados con fines empresariales petroleros a corto plazo', 1),
(522, 1950, '26', 'Intereses por mora y multas de la deuda pública interna por préstamos recibidos de entes descentralizados con fines empresariales no petroleros a corto plazo', 1),
(523, 1950, '27', 'Intereses por mora y multas de la deuda pública interna por préstamos recibidos de entes descentralizados financieros bancarios a corto plazo', 1),
(524, 1950, '28', 'Intereses por mora y multas de la deuda pública interna por préstamos recibidos de entes descentralizados financieros no bancarios a corto plazo', 1),
(525, 1950, '29', 'Intereses por mora y multas de la deuda pública interna por préstamos recibidos del Poder Estadal a corto plazo', 1),
(526, 1950, '30', 'Intereses por mora y multas de la deuda pública interna por préstamos recibidos del Poder Municipal a corto plazo', 1),
(527, 1950, '31', 'Comisiones y otros gastos de la deuda pública interna por préstamos recibidos del sector privado a corto plazo', 1),
(528, 1950, '32', 'Comisiones y otros gastos de la deuda pública interna por préstamos recibidos del sector privado a corto plazo', 1),
(529, 1950, '33', 'Comisiones y otros gastos de la deuda pública interna por préstamos recibidos de entes descentralizados sin fines empresariales a corto plazo', 1),
(530, 1950, '34', 'Comisiones y otros gastos de la deuda pública interna por préstamos recibidos de instituciones de protección social a corto plazo', 1),
(531, 1950, '35', 'Comisiones y otros gastos de la deuda pública interna por préstamos recibidos de entes descentralizados con fines empresariales petroleros a corto plazo', 1),
(532, 1950, '36', 'Comisiones y otros gastos de la deuda pública interna por préstamos recibidos de entes descentralizados con fines empresariales no petroleros a corto plazo', 1),
(533, 1950, '37', 'Comisiones y otros gastos de la deuda pública interna por préstamos recibidos de entes descentralizados financieros bancarios a corto plazo', 1),
(534, 1950, '38', 'Comisiones y otros gastos de la deuda pública interna por préstamos recibidos de entes descentralizados financieros no bancarios a corto plazo', 1),
(535, 1950, '39', 'Comisiones y otros gastos de la deuda pública interna por préstamos recibidos del Poder Estadal a corto plazo', 1),
(536, 1950, '40', 'Comisiones y otros gastos de la deuda pública interna por préstamos recibidos del Poder Municipal a corto plazo', 1),
(537, 1951, '01', 'Amortización de la deuda pública interna indirecta por préstamos recibidos del sector privado a corto plazo', 1),
(538, 1951, '02', 'Amortización de la deuda pública interna indirecta por préstamos recibidos del sector público a corto plazo', 1),
(539, 1951, '03', 'Intereses de la deuda pública interna indirecta por préstamos recibidos del sector privado a corto plazo', 1);
INSERT INTO `partida_sub_especifica` (`id`, `especifica`, `sub_especifica`, `nombre`, `estatus`) VALUES
(540, 1951, '04', 'Intereses de la deuda pública interna indirecta por préstamos recibidos del sector público a corto plazo', 1),
(541, 1951, '05', 'Intereses por mora y multas de la deuda pública interna indirecta por préstamos recibidos del sector privado a corto plazo', 1),
(542, 1951, '06', 'Intereses por mora y multas de la deuda pública interna indirecta por préstamos recibidos del sector público a corto plazo', 1),
(543, 1951, '07', 'Comisiones y otros gastos de la deuda pública interna indirecta por préstamos recibidos del sector privado a corto plazo', 1),
(544, 1951, '08', 'Comisiones y otros gastos de la deuda pública interna indirecta por préstamos recibidos del sector público a corto plazo', 1),
(545, 1952, '01', 'Amortización de la deuda pública interna a largo plazo de títulos y valores', 1),
(546, 1952, '02', 'Amortización de la deuda pública interna a largo plazo de letras del tesoro', 1),
(547, 1952, '03', 'Intereses de la deuda pública interna a largo plazo de títulos y valores', 1),
(548, 1952, '04', 'Intereses por mora y multas de la deuda pública interna a largo plazo de títulos y valores', 1),
(549, 1952, '05', 'Comisiones y otros gastos de la deuda pública interna a largo plazo de títulos y valores', 1),
(550, 1952, '06', 'Descuentos en colocación de títulos y valores de la deuda pública interna a largo plazo', 1),
(551, 1952, '07', 'Descuentos en colocación de letras del tesoro a largo plazo', 1),
(552, 1953, '01', 'Amortización de la deuda pública interna por préstamos recibidos del sector privado a largo plazo', 1),
(553, 1953, '02', 'Amortización de la deuda pública interna por préstamos recibidos de la República a largo plazo', 1),
(554, 1953, '03', 'Amortización de la deuda pública interna por préstamos recibidos de entes descentralizados sin fines empresariales a largo plazo', 1),
(555, 1953, '04', 'Amortización de la deuda pública interna por préstamos recibidos de instituciones de protección social a largo plazo', 1),
(556, 1953, '05', 'Amortización de la deuda pública interna por préstamos recibidos de entes descentralizados con fines empresariales petroleros a largo plazo', 1),
(557, 1953, '06', 'Amortización de la deuda pública interna por préstamos recibidos de entes descentralizados con fines empresariales no petroleros a largo plazo', 1),
(558, 1953, '07', 'Amortización de la deuda pública interna por préstamos recibidos de entes descentralizados financieros bancarios a largo plazo', 1),
(559, 1953, '08', 'Amortización de la deuda pública interna por préstamos recibidos de entes descentralizados financieros no bancarios a largo plazo', 1),
(560, 1953, '09', 'Amortización de la deuda pública interna por préstamos recibidos del Poder Estadal a largo plazo', 1),
(561, 1953, '10', 'Amortización de la deuda pública interna por préstamos recibidos del Poder Municipal a largo plazo', 1),
(562, 1953, '11', 'Intereses de la deuda pública interna por préstamos recibidos del sector privado a largo plazo', 1),
(563, 1953, '12', 'Intereses de la deuda pública interna por préstamos recibidos de la Intereses de la deuda pública interna por préstamos recibidos de la República a largo plazo', 1),
(564, 1953, '13', 'Intereses de la deuda pública interna por préstamos recibidos de entes descentralizados sin fines empresariales a largo plazo', 1),
(565, 1953, '14', 'Intereses de la deuda pública interna por préstamos recibidos de instituciones de protección social a largo plazo', 1),
(566, 1953, '15', 'Intereses de la deuda pública interna por préstamos recibidos de entes descentralizados con fines empresariales petroleros a largo plazo', 1),
(567, 1953, '16', 'Intereses de la deuda pública interna por préstamos recibidos de entes descentralizados con fines empresariales no petroleros a largo plazo', 1),
(568, 1953, '17', 'Intereses de la deuda pública interna por préstamos recibidos de entes descentralizados financieros bancarios a largo plazo', 1),
(569, 1953, '18', 'Intereses de la deuda pública interna por préstamos recibidos de entes descentralizados financieros no bancarios a largo plazo', 1),
(570, 1953, '19', 'Intereses de la deuda pública interna por préstamos recibidos de Poder Estadal a largo plazo', 1),
(571, 1953, '20', 'Intereses de la deuda pública interna por préstamos recibidos de Poder Municipal a largo plazo', 1),
(572, 1953, '21', 'Intereses por mora y multas de la deuda pública interna por préstamos recibidos del sector privado a largo plazo', 1),
(573, 1953, '22', 'Intereses por mora y multas de la deuda pública interna por préstamos recibidos de la República a largo plazo', 1),
(574, 1953, '23', 'Intereses por mora y multas de la deuda pública interna por préstamos recibidos de entes descentralizados sin fines empresariales a largo plazo', 1),
(575, 1953, '24', 'Intereses por mora y multas de la deuda pública interna por préstamos recibidos de instituciones de protección social a largo plazo', 1),
(576, 1953, '25', 'Intereses por mora y multas de la deuda pública interna por préstamos recibidos de entes descentralizados con fines empresariales petroleros a largo plazo', 1),
(577, 1953, '26', 'Intereses por mora y multas de la deuda pública interna por préstamos recibidos de entes descentralizados con fines empresariales no petroleros a largo plazo', 1),
(578, 1953, '27', 'Intereses por mora y multas de la deuda pública interna por préstamos recibidos de entes descentralizados financieros bancarios a largo plazo', 1),
(579, 1953, '28', 'Intereses por mora y multas de la deuda pública interna por préstamos recibidos de entes descentralizados financieros no bancarios a largo plazo', 1),
(580, 1953, '29', 'Intereses por mora y multas de la deuda pública interna por préstamos recibidos del Poder Estadal a largo plazo', 1),
(581, 1953, '30', 'Intereses por mora y multas de la deuda pública interna por préstamos recibidos del Poder Municipal a largo plazo', 1),
(582, 1953, '31', 'Comisiones y otros gastos de la deuda pública interna por préstamos recibidos del sector privado a largo plazo', 1),
(583, 1953, '32', 'Comisiones y otros gastos de la deuda pública interna por préstamos recibidos de la República a largo plazo', 1),
(584, 1953, '33', 'Comisiones y otros gastos de la deuda pública interna por préstamos recibidos de entes descentralizados sin fines empresariales a largo plazo', 1),
(585, 1953, '34', 'Comisiones y otros gastos de la deuda pública interna por préstamos recibidos de instituciones de protección social a largo plazo', 1),
(586, 1953, '35', 'Comisiones y otros gastos de la deuda pública interna por préstamos recibidos de entes descentralizados con fines empresariales petroleros a largo plazo', 1),
(587, 1953, '36', 'Comisiones y otros gastos de la deuda pública interna por préstamos recibidos de entes descentralizados con fines empresariales no petroleros a largo plazo', 1),
(588, 1953, '37', 'Comisiones y otros gastos de la deuda pública interna por préstamos recibidos de entes descentralizados financieros bancarios a largo plazo', 1),
(589, 1953, '38', 'Comisiones y otros gastos de la deuda pública interna por préstamos recibidos de entes descentralizados financieros no bancarios a largo plazo', 1),
(590, 1953, '39', 'Comisiones y otros gastos de la deuda pública interna por préstamos recibidos del Poder Estadal a largo plazo', 1),
(591, 1953, '40', 'Comisiones y otros gastos de la deuda pública interna por préstamos recibidos del Poder Municipal a largo plazo', 1),
(592, 1954, '01', 'Amortización de la deuda pública interna indirecta a largo plazo de títulos y valores', 1),
(593, 1954, '02', 'Intereses de la deuda pública interna indirecta a largo plazo de títulos y valores', 1),
(594, 1954, '03', 'Intereses por mora y multas de la deuda pública interna indirecta a largo plazo de títulos y valores', 1),
(595, 1954, '04', 'Comisiones y otros gastos de la deuda pública interna indirecta a largo plazo de títulos y valores', 1),
(596, 1954, '05', 'Descuentos en colocación de títulos y valores de la deuda pública interna indirecta de largo plazo', 1),
(597, 1955, '01', 'Amortización de la deuda pública interna indirecta por préstamos recibidos del sector privado a largo plazo', 1),
(598, 1955, '02', 'Amortización de la deuda pública interna indirecta por préstamos recibidos del sector público a largo plazo', 1),
(599, 1955, '03', 'Intereses de la deuda pública interna indirecta por préstamos recibidos del sector privado a largo plazo', 1),
(600, 1955, '04', 'Intereses de la deuda pública interna indirecta por préstamos recibidos del sector público a largo plazo', 1),
(601, 1955, '05', 'Intereses por mora y multas de la deuda pública interna indirecta por préstamos recibidos del sector privado a largo plazo', 1),
(602, 1955, '06', 'Intereses por mora y multas de la deuda pública interna indirecta por préstamos recibidos del sector público a largo plazo', 1),
(603, 1955, '07', 'Comisiones y otros gastos de la deuda pública interna indirecta por préstamos recibidos del sector privado a largo plazo', 1),
(604, 1955, '08', 'Comisiones y otros gastos de la deuda pública interna indirecta por préstamos recibidos del sector público a largo plazo', 1),
(605, 1956, '01', 'Amortización de la deuda pública externa a corto plazo de títulos y valores', 1),
(606, 1956, '02', 'Intereses de la deuda pública externa a corto plazo de títulos y valores', 1),
(607, 1956, '03', 'Intereses por mora y multas de la deuda pública externa a corto plazo de títulos y valores', 1),
(608, 1956, '04', 'Comisiones y otros gastos de la deuda pública externa a corto plazo de títulos y valores', 1),
(609, 1956, '05', 'Descuentos en colocación de títulos y valores de la deuda pública externa a corto plazo', 1),
(610, 1957, '01', 'Amortización de la deuda pública externa por préstamos recibidos de gobiernos extranjeros a corto plazo', 1),
(611, 1957, '02', 'Amortización de la deuda pública externa por préstamos recibidos de organismos internacionales a corto plazo', 1),
(612, 1957, '03', 'Amortización de la deuda pública externa por préstamos recibidos de instituciones financieras externas a corto plazo', 1),
(613, 1957, '04', 'Amortización de la deuda pública externa por préstamos recibidos de proveedores de bienes y servicios externos a corto plazo', 1),
(614, 1957, '05', 'Intereses de la deuda pública externa por préstamos recibidos de gobiernos extranjeros a corto plazo', 1),
(615, 1957, '06', 'Intereses de la deuda pública externa por préstamos recibidos de gobiernos extranjeros a corto plazo', 1),
(616, 1957, '07', 'Intereses de la deuda pública externa por préstamos recibidos de instituciones financieras externas a corto plazo', 1),
(617, 1957, '08', 'Intereses de la deuda pública externa por préstamos recibidos de proveedores de bienes y servicios externos a corto plazo', 1),
(618, 1957, '09', 'Intereses por mora y multas de la deuda pública externa por préstamos recibidos de gobiernos extranjeros a corto plazo', 1),
(619, 1957, '10', 'Intereses por mora y multas de la deuda pública externa por préstamos recibidos de organismos internacionales a corto plazo', 1),
(620, 1957, '11', 'Intereses por mora y multas de la deuda pública externa por préstamos recibidos de instituciones financieras externas a corto plazo', 1),
(621, 1957, '12', 'Intereses por mora y multas de la deuda pública externa por préstamos recibidos de proveedores de bienes y servicios externos a corto plazo', 1),
(622, 1957, '13', 'Comisiones y otros gastos de la deuda pública externa por préstamos recibidos de gobiernos extranjeros a corto plazo', 1),
(623, 1957, '14', 'Comisiones y otros gastos de la deuda pública externa por préstamos recibidos de organismos internacionales a corto plazo', 1),
(624, 1957, '15', 'Comisiones y otros gastos de la deuda pública externa por préstamos recibidos de instituciones financieras externas a corto plazo', 1),
(625, 1957, '16', 'Comisiones y otros gastos de la deuda pública externa por préstamos recibidos de proveedores de bienes y servicios externos a corto plazo', 1),
(626, 1958, '01', 'Amortización de la deuda pública externa indirecta por préstamos recibidos de gobiernos extranjeros a corto plazo', 1),
(627, 1958, '02', 'Amortización de la deuda pública externa indirecta por préstamos recibidos de organismos internacionales a corto plazo', 1),
(628, 1958, '03', 'Amortización de la deuda pública externa indirecta por préstamos recibidos de instituciones financieras externas a corto plazo', 1),
(629, 1958, '04', 'Amortización de la deuda pública externa indirecta por préstamos recibidos de proveedores de bienes y servicios externos a corto plazo', 1),
(630, 1958, '05', 'Intereses de la deuda pública externa indirecta por préstamos recibidos de gobiernos extranjeros a corto plazo', 1),
(631, 1958, '06', 'Intereses de la deuda pública externa indirecta por préstamos recibidos de organismos internacionales a corto plazo', 1),
(632, 1958, '07', 'Intereses de la deuda pública externa indirecta por préstamos recibidos de instituciones financieras externas a corto plazo', 1),
(633, 1958, '08', 'Intereses de la deuda pública externa indirecta por préstamos recibidos de proveedores de bienes y servicios externos a corto plazo', 1),
(634, 1958, '09', 'Intereses por mora y multas de la deuda pública externa indirecta por préstamos recibidos de gobiernos extranjeros a corto plazo', 1),
(635, 1958, '10', 'Intereses por mora y multas de la deuda pública externa indirecta por préstamos recibidos de organismos internacionales a corto plazo', 1),
(636, 1958, '11', 'Intereses por mora y multas de la deuda pública externa indirecta por préstamos recibidos de instituciones financieras externas a corto plazo', 1),
(637, 1958, '12', 'Intereses por mora y multas de la deuda pública externa indirecta por préstamos recibidos de proveedores de bienes y servicios externos a corto plazo', 1),
(638, 1958, '13', 'Comisiones y otros gastos de la deuda pública externa indirecta por préstamos recibidos de gobiernos extranjeros a corto plazo', 1),
(639, 1958, '14', 'Comisiones y otros gastos de la deuda pública externa indirecta por préstamos recibidos de organismos internacionales a corto plazo', 1),
(640, 1958, '15', 'Comisiones y otros gastos de la deuda pública externa indirecta por préstamos recibidos de instituciones financieras externas a corto plazo', 1),
(641, 1958, '16', 'Comisiones y otros gastos de la deuda pública externa indirecta por préstamos recibidos de proveedores de bienes y servicios externos a corto plazo', 1),
(642, 1959, '01', 'Amortización de la deuda pública externa a largo plazo de títulos y valores', 1),
(643, 1959, '02', 'Intereses de la deuda pública externa a largo plazo de títulos y valores', 1),
(644, 1959, '03', 'Intereses por mora y multas de la deuda pública externa a largo plazo de títulos y valores', 1),
(645, 1959, '04', 'Comisiones y otros gastos de la deuda pública externa a largo plazo de títulos y valores', 1),
(646, 1959, '05', 'Descuentos en colocación de títulos y valores de la deuda pública externa a largo plazo', 1),
(647, 1960, '01', 'Amortización de la deuda pública externa por préstamos recibidos de gobiernos extranjeros a largo plazo', 1),
(648, 1960, '02', 'Amortización de la deuda pública externa por préstamos recibidos de organismos internacionales a largo plazo', 1),
(649, 1960, '03', 'Amortización de la deuda pública externa por préstamos recibidos de instituciones financieras externas a largo plazo', 1),
(650, 1960, '04', 'Amortización de la deuda pública externa por préstamos recibidos de proveedores de bienes y servicios externos a largo plazo', 1),
(651, 1960, '05', 'Intereses de la deuda pública externa por préstamos recibidos de gobiernos extranjeros a largo plazo', 1),
(652, 1960, '06', 'Intereses de la deuda pública externa por préstamos recibidos de organismos internacionales a largo plazo', 1),
(653, 1960, '07', 'Intereses de la deuda pública externa por préstamos recibidos de instituciones financieras externas a largo plazo', 1),
(654, 1960, '08', 'Intereses de la deuda pública externa por préstamos recibidos de proveedores de bienes y servicios externos a largo plazo', 1),
(655, 1960, '09', 'Intereses por mora y multas de la deuda pública externa por préstamos recibidos de gobiernos extranjeros a largo plazo', 1),
(656, 1960, '10', 'Intereses por mora y multas de la deuda pública externa por préstamos recibidos de organismos internacionales a largo plazo', 1),
(657, 1960, '11', 'Intereses por mora y multas de la deuda pública externa por préstamos recibidos de instituciones financieras externas a largo plazo', 1),
(658, 1960, '12', 'Intereses por mora y multas de la deuda pública externa por préstamos recibidos de proveedores de bienes y servicios externos a largo plazo', 1),
(659, 1960, '13', 'Comisiones y otros gastos de la deuda pública externa por préstamos recibidos de gobiernos extranjeros a largo plazo', 1),
(660, 1960, '14', 'Comisiones y otros gastos de la deuda pública externa por préstamos recibidos de organismos internacionales a largo plazo', 1),
(661, 1960, '15', 'Comisiones y otros gastos de la deuda pública externa por préstamos recibidos de instituciones financieras externas a largo plazo', 1),
(662, 1960, '16', 'Comisiones y otros gastos de la deuda pública externa por préstamos recibidos de proveedores de bienes y servicios externos a largo plazo', 1),
(663, 1961, '01', 'Amortización de la deuda pública externa indirecta a largo plazo de títulos y valores', 1),
(664, 1961, '02', 'Intereses de la deuda pública externa indirecta a largo plazo de títulos y valores', 1),
(665, 1961, '03', 'Intereses por mora y multas de la deuda pública externa indirecta a Intereses por mora y multas de la deuda pública externa indirecta a', 1),
(666, 1961, '04', 'Comisiones y otros gastos de la deuda pública externa indirecta a largo plazo de títulos y valores', 1),
(667, 1961, '05', 'Descuentos en colocación de títulos y valores de la deuda pública externa indirecta a largo plazo', 1),
(668, 1962, '01', 'Amortización de la deuda pública externa indirecta por préstamos recibidos de gobiernos extranjeros a largo plazo', 1),
(669, 1962, '02', 'Amortización de la deuda pública externa indirecta por préstamos recibidos de organismos internacionales a largo plazo', 1),
(670, 1962, '03', 'Amortización de la deuda pública externa indirecta por préstamos recibidos de instituciones financieras externas a largo plazo', 1),
(671, 1962, '04', 'Amortización de la deuda pública externa indirecta por préstamos recibidos de proveedores de bienes y servicios externos a largo plazo', 1),
(672, 1962, '05', 'Intereses de la deuda pública externa indirecta por préstamos recibidos de gobiernos extranjeros a largo plazo', 1),
(673, 1962, '06', 'Intereses de la deuda pública externa indirecta por préstamos recibidos de organismos internacionales a largo plazo', 1),
(674, 1962, '07', 'Intereses de la deuda pública externa indirecta por préstamos recibidos de instituciones financieras externas a largo plazo', 1),
(675, 1962, '08', 'Intereses de la deuda pública externa indirecta por préstamos recibidos de proveedores de bienes y servicios externos a largo plazo', 1),
(676, 1962, '09', 'Intereses por mora y multas de la deuda pública externa indirecta por préstamos recibidos de gobiernos extranjeros a largo plazo', 1),
(677, 1962, '10', 'Intereses por mora y multas de la deuda pública externa indirecta por préstamos recibidos de organismos internacionales a largo plazo', 1),
(678, 1962, '11', 'Intereses por mora y multas de la deuda pública externa indirecta por préstamos recibidos de instituciones financieras externas a largo plazo', 1),
(679, 1962, '12', 'Intereses por mora y multas de la deuda pública externa indirecta por préstamos recibidos de proveedores de bienes y servicios externos a largo plazo', 1),
(680, 1962, '13', 'Comisiones y otros gastos de la deuda pública externa indirecta por préstamos recibidos de gobiernos extranjeros a largo plazo', 1),
(681, 1962, '14', 'Comisiones y otros gastos de la deuda pública externa indirecta por préstamos recibidos de organismos internacionales a largo plazo', 1),
(682, 1962, '15', 'Comisiones y otros gastos de la deuda pública externa indirecta por préstamos recibidos de instituciones financieras externas a largo plazo', 1),
(683, 1962, '16', 'Comisiones y otros gastos de la deuda pública externa indirecta por préstamos recibidos de proveedores de bienes y servicios externos a largo plazo', 1),
(684, 1967, '01', 'Disminución de la deuda pública interna por distribuir', 1),
(685, 1967, '02', 'Disminución de la deuda pública externa por distribuir', 1),
(686, 1998, '01', 'Disminución de rentas diferidas por recaudar a corto plazo', 1),
(687, 1999, '01', 'Disminución del rescate de certificados de reintegro tributario', 1),
(688, 1999, '02', 'Disminución del rescate de bonos de exportación', 1),
(689, 1999, '03', 'Disminución del rescate de bonos en dación de pagos', 1),
(690, 2000, '01', 'Disminución de provisiones para cuentas incobrables', 1),
(691, 2000, '02', 'Disminución de provisiones para despidos', 1),
(692, 2000, '03', 'Disminución de provisiones para pérdidas en el inventario', 1),
(693, 2000, '04', 'Disminución de provisiones para beneficios sociales', 1),
(694, 2000, '99', 'Disminución de otras provisiones', 1),
(695, 2002, '01', 'Disminución de depósitos de terceros a la vista de organismos del sector público', 1),
(696, 2002, '02', 'Disminución de depósitos de terceros a la vista de personas naturales y jurídicas del sector privado', 1),
(697, 2003, '01', 'Disminución de depósitos a plazo fijo de organismos del sector público', 1),
(698, 2003, '02', 'Disminución de depósitos a plazo fijo de personas naturales y jurídicas del sector privado', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE IF NOT EXISTS `perfil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `cedula` int(8) NOT NULL,
  `user_accounts` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_accounts` (`user_accounts`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Perfil de usuario' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan_operativo`
--

CREATE TABLE IF NOT EXISTS `plan_operativo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plan_operativo` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

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

CREATE TABLE IF NOT EXISTS `presentacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `presentacion`
--

INSERT INTO `presentacion` (`id`, `nombre`) VALUES
(1, 'Presentación');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programacion_fisica_presupuestaria`
--

CREATE TABLE IF NOT EXISTS `programacion_fisica_presupuestaria` (
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
  `diciembre` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_programacion_fisica_presupuestaria_1_idx` (`tipo_distribucion`),
  KEY `fk_programacion_fisica_presupuestaria_2_idx` (`id_proyecto_accion_especifica`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

CREATE TABLE IF NOT EXISTS `proyecto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo_proyecto_UNIQUE` (`codigo_proyecto`),
  UNIQUE KEY `codigo_sne_UNIQUE` (`codigo_sne`),
  KEY `estatus_proyecto_fk` (`estatus_proyecto`),
  KEY `situacion_presupuestaria_fk` (`situacion_presupuestaria`),
  KEY `clasificacion_sector_fk` (`sector`) USING BTREE,
  KEY `sub_sector_fk` (`sub_sector`) USING BTREE,
  KEY `plan_operativo_fk` (`plan_operativo`) USING BTREE,
  KEY `objetivo_general_fk` (`objetivo_general`) USING BTREE,
  KEY `ambito_fk` (`ambito`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1000000 ;

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

CREATE TABLE IF NOT EXISTS `proyecto_accion_especifica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `estatus` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_accion_especifica_proyecto_1_idx` (`id_proyecto`),
  KEY `fk_accion_especifica_proyecto_2_idx` (`id_unidad_ejecutora`),
  KEY `unidad_medida` (`unidad_medida`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Volcado de datos para la tabla `proyecto_accion_especifica`
--

INSERT INTO `proyecto_accion_especifica` (`id`, `id_proyecto`, `codigo_accion_especifica`, `nombre`, `unidad_medida`, `meta`, `ponderacion`, `bien_servicio`, `id_unidad_ejecutora`, `fecha_inicio`, `fecha_fin`, `estatus`) VALUES
(20, 999999, '123', 'Acción Específica', 1, 5, 0.1, 'Ninguno', 1, '2016-01-01', '2016-12-31', 1),
(21, 999999, '1', 'probadno', 1, 0, 0.0, 'Ninguno', 600, '2016-01-01', '2016-12-31', 1),
(22, 999999, '2', 'probando2', 1, 0, 0.0, 'Ninguno', 602, '2016-01-01', '2016-12-31', 0),
(23, 999999, '4', 'probadno', 1, 0, 0.0, 'Ninguno', 601, '2016-01-01', '2016-12-31', 0),
(24, 999999, '4', 'probadno', 1, 0, 0.0, 'Ninguno', 600, '2016-01-01', '2016-12-31', 0),
(25, 999999, '6', 'probadno3', 1, 0, 0.0, 'Ninguno', 600, '2016-01-01', '2016-12-31', 0),
(26, 999999, '7', 'probando', 1, 0, 0.0, 'Ninguno', 600, '2016-01-01', '2016-12-31', 0),
(27, 1, '10', 'Acción específica.', 1, 3, 0.1, 'Un bien', 602, '2016-01-01', '2017-12-31', 1),
(36, 1, '444', 'Otra acción', 1, 1, 0.5, 'Otro bien', 603, '2016-01-01', '2016-12-31', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_alcance`
--

CREATE TABLE IF NOT EXISTS `proyecto_alcance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `obstaculos` text NOT NULL COMMENT ' ¿Cuáles serían los supuestos obstáculos para la ejecución de este proyecto? Especifique:',
  PRIMARY KEY (`id`),
  KEY `id_proyecto` (`id_proyecto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Alcance e impacto del proyecto' AUTO_INCREMENT=4 ;

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

CREATE TABLE IF NOT EXISTS `proyecto_asignar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` int(11) NOT NULL,
  `unidad_ejecutora` int(11) NOT NULL,
  `accion_especifica` int(11) NOT NULL,
  `estatus` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `proyecto_asignar_unico` (`usuario`,`unidad_ejecutora`,`accion_especifica`),
  KEY `usuario` (`usuario`),
  KEY `unidad_ejecutora` (`unidad_ejecutora`),
  KEY `accion_especifica` (`accion_especifica`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Relación entre usuarios, unidades ejecutoras y acciones específicas de un proyecto' AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `proyecto_asignar`
--

INSERT INTO `proyecto_asignar` (`id`, `usuario`, `unidad_ejecutora`, `accion_especifica`, `estatus`) VALUES
(5, 2, 602, 27, 1),
(7, 2, 1, 20, 1),
(8, 3, 1, 20, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_distribucion_presupuestaria`
--

CREATE TABLE IF NOT EXISTS `proyecto_distribucion_presupuestaria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_accion_especifica` int(11) NOT NULL COMMENT 'Acción Específica',
  `id_partida` int(11) NOT NULL COMMENT 'Partida',
  `cantidad` decimal(20,0) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_accion_especifica` (`id_accion_especifica`),
  KEY `id_partida` (`id_partida`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Distribución presupuestaria de proyecto' AUTO_INCREMENT=29 ;

--
-- Volcado de datos para la tabla `proyecto_distribucion_presupuestaria`
--

INSERT INTO `proyecto_distribucion_presupuestaria` (`id`, `id_accion_especifica`, `id_partida`, `cantidad`) VALUES
(1, 36, 1, '0'),
(2, 36, 2, '0'),
(3, 36, 3, '0'),
(4, 36, 4, '0'),
(5, 36, 5, '0'),
(6, 36, 6, '0'),
(7, 36, 7, '0'),
(8, 36, 8, '0'),
(9, 36, 9, '0'),
(10, 36, 10, '0'),
(11, 36, 11, '0'),
(12, 36, 12, '0'),
(13, 36, 13, '0'),
(14, 36, 14, '0'),
(15, 36, 15, '0'),
(16, 36, 16, '0'),
(17, 36, 17, '0'),
(18, 36, 18, '0'),
(19, 36, 19, '0'),
(20, 36, 20, '0'),
(21, 36, 21, '0'),
(22, 36, 22, '0'),
(23, 36, 23, '0'),
(24, 36, 24, '0'),
(25, 36, 25, '0'),
(26, 36, 26, '0'),
(27, 36, 27, '0'),
(28, 36, 28, '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_fuente_financiamiento`
--

CREATE TABLE IF NOT EXISTS `proyecto_fuente_financiamiento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_localizacion`
--

CREATE TABLE IF NOT EXISTS `proyecto_localizacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_proyecto` int(11) NOT NULL,
  `id_pais` int(11) NOT NULL,
  `id_estado` int(11) DEFAULT NULL,
  `id_municipio` int(11) DEFAULT NULL,
  `id_parroquia` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `estados_fk_idx` (`id_estado`),
  KEY `municipio_fk_idx` (`id_municipio`),
  KEY `parroquia_fk_idx` (`id_parroquia`),
  KEY `proyecto_fk_idx` (`id_proyecto`),
  KEY `id_pais` (`id_pais`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

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

CREATE TABLE IF NOT EXISTS `proyecto_pedido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `estatus` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_material` (`id_material`),
  KEY `asignado` (`asignado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_registrador`
--

CREATE TABLE IF NOT EXISTS `proyecto_registrador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `cedula` int(10) NOT NULL,
  `email` varchar(80) DEFAULT NULL,
  `telefono` varchar(14) NOT NULL,
  `id_proyecto` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_proyecto` (`id_proyecto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `proyecto_registrador`
--

INSERT INTO `proyecto_registrador` (`id`, `nombre`, `cedula`, `email`, `telefono`, `id_proyecto`) VALUES
(3, 'Carlos Samaniego', 16344539, 'catu52@yahoo.com', '+584262130565', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_responsable`
--

CREATE TABLE IF NOT EXISTS `proyecto_responsable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `cedula` int(10) NOT NULL,
  `email` varchar(45) NOT NULL,
  `telefono` varchar(14) NOT NULL,
  `id_proyecto` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `proyecto_fk` (`id_proyecto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `proyecto_responsable`
--

INSERT INTO `proyecto_responsable` (`id`, `nombre`, `cedula`, `email`, `telefono`, `id_proyecto`) VALUES
(4, 'John Doe', 123456789, 'john@correo.com', '+584262130565', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_responsable_administrativo`
--

CREATE TABLE IF NOT EXISTS `proyecto_responsable_administrativo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `cedula` int(10) NOT NULL,
  `email` varchar(45) NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `unidad_administradora` varchar(45) NOT NULL,
  `id_proyecto` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_id_proyecto_idx` (`id_proyecto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_responsable_tecnico`
--

CREATE TABLE IF NOT EXISTS `proyecto_responsable_tecnico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `cedula` int(10) NOT NULL,
  `email` varchar(45) NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `unidad_tecnica` varchar(45) NOT NULL,
  `id_proyecto` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_proyecto_fk` (`id_proyecto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `proyecto_responsable_tecnico`
--

INSERT INTO `proyecto_responsable_tecnico` (`id`, `nombre`, `cedula`, `email`, `telefono`, `unidad_tecnica`, `id_proyecto`) VALUES
(2, 'Jane', 65498732, 'jane@correo.com', '(212)9876543', 'Tecnica', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `responsable_acc_variable`
--

CREATE TABLE IF NOT EXISTS `responsable_acc_variable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `cedula` int(10) NOT NULL,
  `email` varchar(45) NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `oficina` varchar(60) NOT NULL,
  `id_variable` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_variable` (`id_variable`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Volcado de datos para la tabla `responsable_acc_variable`
--

INSERT INTO `responsable_acc_variable` (`id`, `nombre`, `cedula`, `email`, `telefono`, `oficina`, `id_variable`) VALUES
(19, 'walter', 17389814, 'walter86_79@hotmail.com', '02124813639', 'caracas', 31),
(20, 'walter', 17389814, 'walter86_79@hotmail.com', '02124813639', 'caracas', 32),
(21, 'walter', 17389814, 'walter86_79@hotmail.com', '02124813639', 'caracas', 33);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sector`
--

CREATE TABLE IF NOT EXISTS `sector` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sector` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

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

CREATE TABLE IF NOT EXISTS `situacion_presupuestaria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `situacion` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `situacion_presupuestaria`
--

INSERT INTO `situacion_presupuestaria` (`id`, `situacion`) VALUES
(1, 'Por iniciar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sub_sector`
--

CREATE TABLE IF NOT EXISTS `sub_sector` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_sector` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `sub_sector`
--

INSERT INTO `sub_sector` (`id`, `sub_sector`) VALUES
(1, 'N/D');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_distribucion`
--

CREATE TABLE IF NOT EXISTS `tipo_distribucion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_financiamiento`
--

CREATE TABLE IF NOT EXISTS `tipo_financiamiento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

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

CREATE TABLE IF NOT EXISTS `unidad_ejecutora` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_ue` varchar(5) CHARACTER SET latin1 NOT NULL,
  `nombre` text CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo_ue_UNIQUE` (`codigo_ue`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=688 ;

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

CREATE TABLE IF NOT EXISTS `unidad_medida` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unidad_medida` varchar(45) NOT NULL COMMENT 'Unidad de medida',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Unidad de medida para el alcance e impacto del proyecto' AUTO_INCREMENT=623 ;

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

CREATE TABLE IF NOT EXISTS `user_accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_unique_login` (`login`),
  UNIQUE KEY `user_unique_username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `user_accounts`
--

INSERT INTO `user_accounts` (`id`, `login`, `username`, `password_hash`, `auth_key`, `administrator`, `creator`, `creator_ip`, `confirm_token`, `recovery_token`, `blocked_at`, `confirmed_at`, `created_at`, `updated_at`) VALUES
(1, 'catu52@gmail.com', 'admin', '$2y$13$93TebP1Z2QcqANsVIzAwrON2lrPaFFXqUoJswU0VHa63avQoNS6G6', '', 1, -2, 'Local', NULL, NULL, NULL, 1449790220, 1449790220, 1449864304),
(2, 'antonioluismonasterio@gmail.com', 'antonio', '$2y$13$I/K3TenE57er26KZengHNujOrM7kYiCsGZzG4XXK1MOx/zhsmCZdi', '', 0, 1, '127.0.0.1', NULL, NULL, NULL, 1449848097, 1449848097, 1458867181),
(3, 'walter86_79@hotmail.com', 'soulip', '$2y$13$UjYRjClQAEpe2OzeogsZoederx9EgVItIQCy5bNrV0xz8vQWDI3DS', '', 0, 1, '127.0.0.1', NULL, NULL, NULL, 1454610570, 1454610571, 1458107096);

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
-- Filtros para la tabla `ac_variable`
--
ALTER TABLE `ac_variable`
  ADD CONSTRAINT `frk_ac_variable` FOREIGN KEY (`id_u_ej`) REFERENCES `unidad_ejecutora` (`id`);

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
  ADD CONSTRAINT `frk_se_materiales` FOREIGN KEY (`id_se`) REFERENCES `partida_sub_especifica` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `frk_um_materiales` FOREIGN KEY (`unidad_medida`) REFERENCES `unidad_medida` (`id`);

--
-- Filtros para la tabla `objetivos_generales`
--
ALTER TABLE `objetivos_generales`
  ADD CONSTRAINT `objetivos_generales_ibfk_1` FOREIGN KEY (`objetivo_estrategico`) REFERENCES `objetivos_estrategicos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `partida_especifica`
--
ALTER TABLE `partida_especifica`
  ADD CONSTRAINT `frk_ge_es` FOREIGN KEY (`generica`) REFERENCES `partida_generica` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `partida_generica`
--
ALTER TABLE `partida_generica`
  ADD CONSTRAINT `fk_partida` FOREIGN KEY (`id_partida`) REFERENCES `partida_partida` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `partida_partida`
--
ALTER TABLE `partida_partida`
  ADD CONSTRAINT `partida_partida_ibfk_1` FOREIGN KEY (`cuenta`) REFERENCES `cuenta_presupuestaria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `partida_sub_especifica`
--
ALTER TABLE `partida_sub_especifica`
  ADD CONSTRAINT `frk_es_se` FOREIGN KEY (`especifica`) REFERENCES `partida_especifica` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `id_accion_especifica_fk` FOREIGN KEY (`id_accion_especifica`) REFERENCES `proyecto_accion_especifica` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_partida_fk` FOREIGN KEY (`id_partida`) REFERENCES `partida_partida` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
