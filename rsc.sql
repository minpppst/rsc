-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-01-2016 a las 21:29:17
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
('registrador_accion_especifica', '1', 1453479503),
('registrador_alcance', '1', 1453479503),
('registrador_basico', '1', 1453479503),
('registrador_basico', '2', 1452222004),
('registrador_distribucion_presupuestaria', '1', 1453479503),
('sysadmin', '1', 1453479503);

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
('proyecto-accion-especifica/create', 2, 'Crear acción específica de proyecto', NULL, NULL, 1452529692, 1452529692),
('proyecto-accion-especifica/delete', 2, 'Eliminar acción específica de proyecto', NULL, NULL, 1452529736, 1452529736),
('proyecto-accion-especifica/index', 2, 'Lista de acciones específicas de proyecto', NULL, NULL, 1452529786, 1452529786),
('proyecto-accion-especifica/update', 2, 'Editar acción específica de proyecto', NULL, NULL, 1452529715, 1452529715),
('proyecto-accion-especifica/view', 2, 'Ver acción específica de proyecto', NULL, NULL, 1452631085, 1452631085),
('proyecto-alcance/create', 2, 'Crear alcance de proyecto', NULL, NULL, 1452221668, 1452221668),
('proyecto-alcance/delete', 2, 'Eliminar alcance de proyecto', NULL, NULL, 1452221699, 1452221699),
('proyecto-alcance/update', 2, 'Editar alcance de proyecto', NULL, NULL, 1452221681, 1452221681),
('proyecto-alcance/view', 2, 'Ver alcance de proyecto', NULL, NULL, 1452223025, 1452223025),
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
('proyecto-responsable-tecnico/create-alt', 2, 'Crear responsable de proyecto - método alternativo', NULL, NULL, 1452022995, 1452023110),
('proyecto-responsable-tecnico/update', 2, 'Editar responsable técnico de proyecto', NULL, NULL, 1452011082, 1452011082),
('proyecto-responsable/create', 2, 'Crear responsable de proyecto', NULL, NULL, 1452005727, 1452005727),
('proyecto-responsable/create-alt', 2, 'Crear responsable de proyecto - método alternativo', NULL, NULL, 1452022162, 1452023117),
('proyecto-responsable/delete', 2, 'Eliminar responsable de proyecto', NULL, NULL, 1452019408, 1452019408),
('proyecto-responsable/update', 2, 'Editar responsable de proyecto', NULL, NULL, 1452005753, 1452005753),
('proyecto-responsable/view', 2, 'Ver responsable de proyecto', NULL, NULL, 1452006168, 1452006168),
('proyecto/create', 2, 'Crear Proyecto', NULL, NULL, 1450393912, 1450645199),
('proyecto/delete', 2, 'Eliminar Proyecto', NULL, NULL, 1450393912, 1450645229),
('proyecto/index', 2, 'Lista de proyectos', NULL, NULL, 1450646779, 1450646779),
('proyecto/update', 2, 'Editar Proyecto', NULL, NULL, 1450393912, 1450645214),
('proyecto/view', 2, 'Ver Proyecto', NULL, NULL, 1450393912, 1450645173),
('registrador_accion_especifica', 1, 'Crea, edita y elimina acciones específicas de proyecto', NULL, NULL, 1452529829, 1452631112),
('registrador_alcance', 1, 'Crea, edita y elimina "alcance e impacto" de proyecto', NULL, NULL, 1452221931, 1452223040),
('registrador_basico', 1, 'Crea, edita y elimina datos básicos de proyecto', NULL, NULL, 1450393912, 1452359490),
('registrador_distribucion_presupuestaria', 1, 'Crea, edita y elimina la distribución presupuestaria de proyecto', NULL, NULL, 1452649340, 1452649340),
('site/configuracion', 2, 'Configurar el sistema', NULL, NULL, 1450736795, 1450736795),
('sysadmin', 1, 'Administrador del sistema', NULL, NULL, 1450736017, 1453773800),
('unidad-medida/create', 2, 'Crear unidad de medida', NULL, NULL, 1453773712, 1453773712),
('unidad-medida/delete', 2, 'Eliminar unidad de medida', NULL, NULL, 1453773745, 1453773745),
('unidad-medida/index', 2, 'Lista de unidad de medida', NULL, NULL, 1453773700, 1453773700),
('unidad-medida/update', 2, 'Editar unidad de medida', NULL, NULL, 1453773728, 1453773728);

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
('registrador_accion_especifica', 'proyecto-accion-especifica/create'),
('registrador_accion_especifica', 'proyecto-accion-especifica/delete'),
('registrador_accion_especifica', 'proyecto-accion-especifica/index'),
('registrador_accion_especifica', 'proyecto-accion-especifica/update'),
('registrador_accion_especifica', 'proyecto-accion-especifica/view'),
('registrador_alcance', 'proyecto-alcance/create'),
('registrador_alcance', 'proyecto-alcance/delete'),
('registrador_alcance', 'proyecto-alcance/update'),
('registrador_alcance', 'proyecto-alcance/view'),
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
('registrador_basico', 'proyecto-responsable-tecnico/create-alt'),
('registrador_basico', 'proyecto-responsable-tecnico/update'),
('registrador_basico', 'proyecto-responsable/create'),
('registrador_basico', 'proyecto-responsable/create-alt'),
('registrador_basico', 'proyecto-responsable/delete'),
('registrador_basico', 'proyecto-responsable/update'),
('registrador_basico', 'proyecto-responsable/view'),
('registrador_basico', 'proyecto/create'),
('registrador_basico', 'proyecto/delete'),
('registrador_basico', 'proyecto/index'),
('registrador_basico', 'proyecto/update'),
('registrador_basico', 'proyecto/view'),
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

--
-- Volcado de datos para la tabla `auth_rule`
--

INSERT INTO `auth_rule` (`name`, `data`, `created_at`, `updated_at`) VALUES
('isAuthor', 'O:19:"app\\rbac\\AuthorRule":3:{s:4:"name";s:8:"isAuthor";s:9:"createdAt";i:1449863204;s:9:"updatedAt";i:1449863204;}', 1449863204, 1449863204);

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
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE IF NOT EXISTS `historial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idPadre` int(11) NOT NULL COMMENT 'Id del registro en la tabla',
  `tablaPadre` int(11) NOT NULL COMMENT 'nombre de la tabla',
  `creadoPor` int(11) NOT NULL COMMENT 'id del usuario',
  `fechaCreado` int(11) NOT NULL COMMENT 'fecha de los cambios',
  `nombreCampo` int(11) NOT NULL COMMENT 'nombre del campo en la tabla',
  `tipoDato` int(11) NOT NULL COMMENT 'tipo de dato del campo',
  `valorAnterior` int(11) NOT NULL COMMENT 'valor anterior',
  `valorNuevo` int(11) NOT NULL COMMENT 'valor nuevo',
  `textoAnterior` int(11) NOT NULL COMMENT 'valor para datos largos',
  `textoNuevo` int(11) NOT NULL COMMENT 'valor nuevo para datos largos',
  `operacion` int(11) NOT NULL COMMENT 'tipo de operacion',
  PRIMARY KEY (`id`),
  KEY `idPadre` (`idPadre`),
  KEY `creadoPor` (`creadoPor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
('m150703_191015_init', 1449787681);

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
-- Estructura de tabla para la tabla `partida`
--

CREATE TABLE IF NOT EXISTS `partida` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `partida` int(4) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `partida`
--

INSERT INTO `partida` (`id`, `partida`, `nombre`) VALUES
(1, 401, 'Gastos de Personal'),
(2, 402, 'Materiales, Suministros y Mercancías'),
(3, 403, 'Servicios No Personales'),
(4, 404, 'Activos Reales'),
(5, 405, 'Activos Financieros'),
(6, 406, 'Gastos de Defensa y Seguridad del Estado'),
(7, 407, 'Transferencias y Donaciones'),
(8, 408, 'Otros Gastos'),
(9, 409, 'Asignaciones No Distribuidas'),
(10, 410, 'Servicio de la Deuda Pública'),
(11, 411, 'Disminución de pasivos'),
(12, 412, 'Disminución del Patrimonio');

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
  `nombre` varchar(45) NOT NULL,
  `estatus_proyecto` int(11) NOT NULL,
  `situacion_presupuestaria` int(11) NOT NULL,
  `monto_proyecto` decimal(10,0) DEFAULT NULL,
  `descripcion` text,
  `sector` int(11) DEFAULT '1',
  `sub_sector` int(11) DEFAULT '1',
  `plan_operativo` int(11) NOT NULL,
  `objetivo_general` int(11) NOT NULL,
  `objetivo_estrategico_institucional` text NOT NULL,
  `ambito` int(11) NOT NULL,
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

INSERT INTO `proyecto` (`id`, `codigo_proyecto`, `codigo_sne`, `nombre`, `estatus_proyecto`, `situacion_presupuestaria`, `monto_proyecto`, `descripcion`, `sector`, `sub_sector`, `plan_operativo`, `objetivo_general`, `objetivo_estrategico_institucional`, `ambito`) VALUES
(1, '0001', '0001', 'Proyecto Lorem ipsum dolor sit amet, consec', 1, 1, '99999', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1, 1, 1, 1, 'Aliquam aliquam lectus orci, rhoncus ultricies quam cursus at. Pellentesque ac ultrices est. Sed at cursus ante. Nunc molestie facilisis nisi quis congue. Donec vel vulputate leo. Praesent a rhoncus sapien, quis rutrum felis. Maecenas placerat, enim in euismod tincidunt, magna quam laoreet augue, at facilisis purus risus nec leo. Pellentesque pulvinar, augue at fringilla vulputate, lorem nulla finibus justo, suscipit pretium risus dolor vel diam.', 4),
(999999, '9999', '9999', 'Proyecto de prueba', 1, 1, '9999', 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1, 1, 1, 1, 'Praesent a rhoncus sapien, quis rutrum felis. Maecenas placerat, enim in euismod tincidunt, magna quam laoreet augue, at facilisis purus risus nec leo. Pellentesque pulvinar, augue at fringilla vulputate, lorem nulla finibus justo, suscipit pretium risus dolor vel diam.', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_accion_especifica`
--

CREATE TABLE IF NOT EXISTS `proyecto_accion_especifica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_proyecto` int(11) NOT NULL,
  `codigo_accion_especifica` varchar(3) NOT NULL,
  `nombre` text,
  `id_unidad_ejecutora` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_accion_especifica_proyecto_1_idx` (`id_proyecto`),
  KEY `fk_accion_especifica_proyecto_2_idx` (`id_unidad_ejecutora`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Volcado de datos para la tabla `proyecto_accion_especifica`
--

INSERT INTO `proyecto_accion_especifica` (`id`, `id_proyecto`, `codigo_accion_especifica`, `nombre`, `id_unidad_ejecutora`) VALUES
(20, 999999, '123', 'Acción Específica', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Alcance e impacto del proyecto' AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `proyecto_alcance`
--

INSERT INTO `proyecto_alcance` (`id`, `id_proyecto`, `enunciado_problema`, `poblacion_afectada`, `indicador_situacion`, `formula_indicador`, `fuente_indicador`, `fecha_indicador_inicial`, `enunciado_situacion_deseada`, `poblacion_objetivo`, `indicador_situacion_deseada`, `resultado_esperado`, `unidad_medida`, `meta_proyecto`, `benficiarios_femeninos`, `beneficiarios_masculinos`, `denominacion_beneficiario`, `total_empleos_directos_femeninos`, `total_empleos_directos_masculino`, `empleos_directos_nuevos_femeninos`, `empleos_directos_nuevos_masculino`, `empleos_directos_sostenidos_femeninos`, `empleos_directos_sostenidos_masculino`, `requiere_accion_no_financiera`, `especifique_con_cual`, `requiere_nombre_institucion`, `requiere_nombre_instancia`, `requiere_mencione_acciones`, `contribuye_complementa`, `especifique_complementa_cual`, `contribuye_nombre_institucion`, `contribuye_nombre_instancia`, `contribuye_mencione_acciones`, `vinculado_otro`, `vinculado_especifique`, `vinculado_nombre_institucion`, `vinculado_nombre_instancia`, `vinculado_nombre_proyecto`, `vinculado_medida`, `obstaculos`) VALUES
(1, 1, 'Según indican los últimos datos del INE correspondiente a enero de 2015,  en torno a la situación de la fuerza de trabajo, en Venezuela existe una población ocupada en el sector informal de 5.394.922  trabajadores  y trabajadoras que no disfrutan de ningún tipo de protección social o tienen una cobertura de seguridad social muy limitada por lo que se hace necesario la ejecución de un conjunto de acciones que permitan su inclusión al régimen de pensiones y otras asignaciones económicas.', '4.157.726  trabajadores y trabajadoras no dependientes se encuentran fuera del sistema de seguridad social.', 'El 77% de trabajadores no dependientes se encuentran fuera del sistema de seguridad social.', 'Trab. No dependientes excluidos SS= Trab. No dependientes excluidos SS/Total trab. No dependiente X100', 'INE', '2015-01-01', '1.338.496 de trabajadores y trabajadoras no dependientes incorporados al sistema de seguridad social.', '101.300 trabajadores y trabajadoras no incorporados al regimen de pensiones y otras asignaciones económicas.', '74,57%  de trabajadores no dependientes se encuentran fuera del sistema de seguridad social para el año 2015.', 'Trabajadores y trabajadoras no dependientes orientados en cuanto sus deberes y derechos de la Seguridad Social.', 2, '101.300', 50, 50, 'Trabajadores', 0, 0, 0, 0, 0, 0, 0, NULL, '', '', '', 0, NULL, '', '', '', 0, NULL, '', '', '', '', 'Ninguno.');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Distribución presupuestaria de proyecto' AUTO_INCREMENT=62 ;

--
-- Volcado de datos para la tabla `proyecto_distribucion_presupuestaria`
--

INSERT INTO `proyecto_distribucion_presupuestaria` (`id`, `id_accion_especifica`, `id_partida`, `cantidad`) VALUES
(50, 20, 1, '0'),
(51, 20, 2, '0'),
(52, 20, 3, '0'),
(53, 20, 4, '0'),
(54, 20, 5, '0'),
(55, 20, 6, '0'),
(56, 20, 7, '0'),
(57, 20, 8, '0'),
(58, 20, 9, '0'),
(59, 20, 10, '0'),
(60, 20, 11, '0'),
(61, 20, 12, '0');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `proyecto_localizacion`
--

INSERT INTO `proyecto_localizacion` (`id`, `id_proyecto`, `id_pais`, `id_estado`, `id_municipio`, `id_parroquia`) VALUES
(1, 1, 862, 2, NULL, NULL);

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
  UNIQUE KEY `id_proyecto_2` (`id_proyecto`),
  KEY `id_proyecto` (`id_proyecto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `proyecto_registrador`
--

INSERT INTO `proyecto_registrador` (`id`, `nombre`, `cedula`, `email`, `telefono`, `id_proyecto`) VALUES
(3, 'Carlos Samaniego', 16344539, 'catu52@yahoo.com', '+584262130565', 1),
(4, 'qwriujhqwriojk', 2147483647, 'asfashk@casfljl.com', '68413513', 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `proyecto_responsable`
--

INSERT INTO `proyecto_responsable` (`id`, `nombre`, `cedula`, `email`, `telefono`, `id_proyecto`) VALUES
(3, 'Pedro Perez', 98451321, 'pedro@correo.com', '(212)1234589', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `proyecto_responsable_administrativo`
--

INSERT INTO `proyecto_responsable_administrativo` (`id`, `nombre`, `cedula`, `email`, `telefono`, `unidad_administradora`, `id_proyecto`) VALUES
(2, 'John Doe', 6841321, 'john@correo.com', '(212)1234567', 'Unidad', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `unidad_ejecutora`
--

INSERT INTO `unidad_ejecutora` (`id`, `codigo_ue`, `nombre`) VALUES
(1, '9999', 'Unidad Ejecutora');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `user_accounts`
--

INSERT INTO `user_accounts` (`id`, `login`, `username`, `password_hash`, `auth_key`, `administrator`, `creator`, `creator_ip`, `confirm_token`, `recovery_token`, `blocked_at`, `confirmed_at`, `created_at`, `updated_at`) VALUES
(1, 'catu52@gmail.com', 'admin', '$2y$13$93TebP1Z2QcqANsVIzAwrON2lrPaFFXqUoJswU0VHa63avQoNS6G6', '', 1, -2, 'Local', NULL, NULL, NULL, 1449790220, 1449790220, 1449864304),
(2, 'antonioluismonasterio@gmail.com', 'antonio', '$2y$13$Yl3RUN/f9jI.YoHsDHzwsurB3o10UVv1mDHYgoZjGs9xpum2u0wia', '', 1, 1, '127.0.0.1', NULL, NULL, NULL, 1449848097, 1449848097, 1449865724);

--
-- Restricciones para tablas volcadas
--

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
-- Filtros para la tabla `objetivos_generales`
--
ALTER TABLE `objetivos_generales`
  ADD CONSTRAINT `objetivos_generales_ibfk_1` FOREIGN KEY (`objetivo_estrategico`) REFERENCES `objetivos_estrategicos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Filtros para la tabla `proyecto_distribucion_presupuestaria`
--
ALTER TABLE `proyecto_distribucion_presupuestaria`
  ADD CONSTRAINT `id_accion_especifica_fk` FOREIGN KEY (`id_accion_especifica`) REFERENCES `proyecto_accion_especifica` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_partida_fk` FOREIGN KEY (`id_partida`) REFERENCES `partida` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `proyecto_localizacion`
--
ALTER TABLE `proyecto_localizacion`
  ADD CONSTRAINT `estado_fk` FOREIGN KEY (`id_estado`) REFERENCES `estados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `municipio_fk` FOREIGN KEY (`id_municipio`) REFERENCES `municipio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `parroquia_fk` FOREIGN KEY (`id_parroquia`) REFERENCES `parroquia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `proyecto_fk` FOREIGN KEY (`id_proyecto`) REFERENCES `proyecto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
