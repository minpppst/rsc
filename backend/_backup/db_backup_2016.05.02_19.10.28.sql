-- -------------------------------------------
SET AUTOCOMMIT=0;
START TRANSACTION;
SET SQL_QUOTE_SHOW_CREATE = 1;
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
-- -------------------------------------------
-- -------------------------------------------
-- START BACKUP
-- -------------------------------------------
-- -------------------------------------------
-- TABLE `ac_variable`
-- -------------------------------------------
DROP TABLE IF EXISTS `ac_variable`;
CREATE TABLE IF NOT EXISTS `ac_variable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_u_ej` int(11) NOT NULL,
  `nombre_variable` varchar(60) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_ac` (`id_u_ej`),
  KEY `id_ac_esp` (`id_u_ej`),
  CONSTRAINT `frk_ac_variable` FOREIGN KEY (`id_u_ej`) REFERENCES `unidad_ejecutora` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `accion_centralizada`
-- -------------------------------------------
DROP TABLE IF EXISTS `accion_centralizada`;
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `accion_centralizada_ac_especifica_uej`
-- -------------------------------------------
DROP TABLE IF EXISTS `accion_centralizada_ac_especifica_uej`;
CREATE TABLE IF NOT EXISTS `accion_centralizada_ac_especifica_uej` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ue` int(11) NOT NULL,
  `id_ac_esp` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_ue` (`id_ue`),
  KEY `id_v` (`id_ac_esp`),
  CONSTRAINT `frk_acesp` FOREIGN KEY (`id_ac_esp`) REFERENCES `accion_centralizada_accion_especifica` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `frk_uej_acesp` FOREIGN KEY (`id_ue`) REFERENCES `unidad_ejecutora` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `accion_centralizada_accion_especifica`
-- -------------------------------------------
DROP TABLE IF EXISTS `accion_centralizada_accion_especifica`;
CREATE TABLE IF NOT EXISTS `accion_centralizada_accion_especifica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ac_centr` int(11) NOT NULL,
  `cod_ac_espe` varchar(3) NOT NULL,
  `nombre` text NOT NULL,
  `estatus` tinyint(1) NOT NULL,
  `fecha_inicio` date NOT NULL COMMENT 'fecha de inicio de la acciones especifica',
  `fecha_fin` date NOT NULL COMMENT 'fecha fin de la accion especifica',
  PRIMARY KEY (`id`),
  KEY `id_ac_centr` (`id_ac_centr`),
  CONSTRAINT `frk_ac_acesp` FOREIGN KEY (`id_ac_centr`) REFERENCES `accion_centralizada` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `accion_centralizada_asignar`
-- -------------------------------------------
DROP TABLE IF EXISTS `accion_centralizada_asignar`;
CREATE TABLE IF NOT EXISTS `accion_centralizada_asignar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` int(11) NOT NULL,
  `unidad_ejecutora` int(11) NOT NULL,
  `accion_especifica` int(11) NOT NULL,
  `estatus` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario` (`usuario`),
  KEY `unidad_ejecutora` (`unidad_ejecutora`),
  KEY `accion_especifica` (`accion_especifica`),
  CONSTRAINT `accion_centralizada_asignar_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `user_accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `accion_centralizada_asignar_ibfk_2` FOREIGN KEY (`unidad_ejecutora`) REFERENCES `unidad_ejecutora` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `accion_centralizada_asignar_ibfk_3` FOREIGN KEY (`accion_especifica`) REFERENCES `accion_centralizada_accion_especifica` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Relación entre usuarios, unidades ejecutoras y acciones específicas de una accion centralizada';

-- -------------------------------------------
-- TABLE `accion_centralizada_pedido`
-- -------------------------------------------
DROP TABLE IF EXISTS `accion_centralizada_pedido`;
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
  KEY `asignado` (`asignado`),
  CONSTRAINT `frk_asignada_centralpedido` FOREIGN KEY (`asignado`) REFERENCES `accion_centralizada_asignar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `frk_materiales_centralpedido` FOREIGN KEY (`id_material`) REFERENCES `materiales_servicios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `accion_centralizada_variables`
-- -------------------------------------------
DROP TABLE IF EXISTS `accion_centralizada_variables`;
CREATE TABLE IF NOT EXISTS `accion_centralizada_variables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_variable` text NOT NULL,
  `unidad_medida` int(11) NOT NULL,
  `localizacion` int(11) NOT NULL,
  `definicion` text NOT NULL,
  `base_calculo` text NOT NULL,
  `fuente_informacion` text NOT NULL,
  `responsable` int(11) NOT NULL,
  `meta_programada_variable` int(11) NOT NULL,
  `unidad_ejecutora` int(11) NOT NULL,
  `acc_accion_especifica` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `unidad_medida_2` (`unidad_medida`),
  KEY `localizacion` (`localizacion`),
  KEY `responsable` (`responsable`),
  KEY `meta_programada_variable` (`meta_programada_variable`),
  KEY `unidad_ejecutora` (`unidad_ejecutora`),
  KEY `acc_accion_especifica` (`acc_accion_especifica`),
  CONSTRAINT `frk_acc_variable` FOREIGN KEY (`acc_accion_especifica`) REFERENCES `accion_centralizada_ac_especifica_uej` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `frk_uej_variable` FOREIGN KEY (`unidad_ejecutora`) REFERENCES `unidad_ejecutora` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `frk_unidad_medida_variable` FOREIGN KEY (`unidad_medida`) REFERENCES `unidad_medida` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `ambito`
-- -------------------------------------------
DROP TABLE IF EXISTS `ambito`;
CREATE TABLE IF NOT EXISTS `ambito` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ambito` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `audit_data`
-- -------------------------------------------
DROP TABLE IF EXISTS `audit_data`;
CREATE TABLE IF NOT EXISTS `audit_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entry_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `data` blob,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_audit_data_entry_id` (`entry_id`),
  CONSTRAINT `fk_audit_data_entry_id` FOREIGN KEY (`entry_id`) REFERENCES `audit_entry` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `audit_entry`
-- -------------------------------------------
DROP TABLE IF EXISTS `audit_entry`;
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `audit_error`
-- -------------------------------------------
DROP TABLE IF EXISTS `audit_error`;
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
  KEY `idx_emailed` (`emailed`),
  CONSTRAINT `fk_audit_error_entry_id` FOREIGN KEY (`entry_id`) REFERENCES `audit_entry` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `audit_javascript`
-- -------------------------------------------
DROP TABLE IF EXISTS `audit_javascript`;
CREATE TABLE IF NOT EXISTS `audit_javascript` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entry_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `type` varchar(20) NOT NULL,
  `message` text NOT NULL,
  `origin` varchar(512) DEFAULT NULL,
  `data` blob,
  PRIMARY KEY (`id`),
  KEY `fk_audit_javascript_entry_id` (`entry_id`),
  CONSTRAINT `fk_audit_javascript_entry_id` FOREIGN KEY (`entry_id`) REFERENCES `audit_entry` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `audit_mail`
-- -------------------------------------------
DROP TABLE IF EXISTS `audit_mail`;
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
  KEY `fk_audit_mail_entry_id` (`entry_id`),
  CONSTRAINT `fk_audit_mail_entry_id` FOREIGN KEY (`entry_id`) REFERENCES `audit_entry` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `audit_trail`
-- -------------------------------------------
DROP TABLE IF EXISTS `audit_trail`;
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
  KEY `idx_audit_trail_action` (`action`),
  CONSTRAINT `fk_audit_trail_entry_id` FOREIGN KEY (`entry_id`) REFERENCES `audit_entry` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `auth_assignment`
-- -------------------------------------------
DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `auth_item`
-- -------------------------------------------
DROP TABLE IF EXISTS `auth_item`;
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
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `auth_item_child`
-- -------------------------------------------
DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `auth_rule`
-- -------------------------------------------
DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `cuenta_presupuestaria`
-- -------------------------------------------
DROP TABLE IF EXISTS `cuenta_presupuestaria`;
CREATE TABLE IF NOT EXISTS `cuenta_presupuestaria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cuenta` varchar(1) NOT NULL COMMENT 'Código de la cuenta',
  `nombre` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `estados`
-- -------------------------------------------
DROP TABLE IF EXISTS `estados`;
CREATE TABLE IF NOT EXISTS `estados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) CHARACTER SET utf8 NOT NULL,
  `id_pais` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_pais` (`id_pais`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `estatus_proyecto`
-- -------------------------------------------
DROP TABLE IF EXISTS `estatus_proyecto`;
CREATE TABLE IF NOT EXISTS `estatus_proyecto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estatus` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Lista de estatus de proyecto';

-- -------------------------------------------
-- TABLE `fuente_financiamiento`
-- -------------------------------------------
DROP TABLE IF EXISTS `fuente_financiamiento`;
CREATE TABLE IF NOT EXISTS `fuente_financiamiento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fuente` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `instancia_institucion`
-- -------------------------------------------
DROP TABLE IF EXISTS `instancia_institucion`;
CREATE TABLE IF NOT EXISTS `instancia_institucion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Tipo de instancia o institución';

-- -------------------------------------------
-- TABLE `localizacion_acc_variable`
-- -------------------------------------------
DROP TABLE IF EXISTS `localizacion_acc_variable`;
CREATE TABLE IF NOT EXISTS `localizacion_acc_variable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_variable` int(11) NOT NULL,
  `id_pais` smallint(3) unsigned zerofill NOT NULL,
  `id_estado` int(11) NOT NULL,
  `id_municipio` int(11) NOT NULL,
  `id_parroquia` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_variable` (`id_variable`),
  KEY `id_pais` (`id_pais`),
  KEY `id_estado` (`id_estado`),
  KEY `id_municipio` (`id_municipio`),
  KEY `id_parroquia` (`id_parroquia`),
  CONSTRAINT `frk_estados_variables` FOREIGN KEY (`id_estado`) REFERENCES `estados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `frk_acc_variable_localizacion` FOREIGN KEY (`id_variable`) REFERENCES `accion_centralizada_variables` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `frk_municipio_variable` FOREIGN KEY (`id_municipio`) REFERENCES `municipio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `frk_pais_variable` FOREIGN KEY (`id_pais`) REFERENCES `pais` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `frk_parroquia_variable` FOREIGN KEY (`id_parroquia`) REFERENCES `parroquia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `materiales_servicios`
-- -------------------------------------------
DROP TABLE IF EXISTS `materiales_servicios`;
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
  KEY `presentacion` (`presentacion`),
  CONSTRAINT `frk_pre_materiales` FOREIGN KEY (`presentacion`) REFERENCES `presentacion` (`id`),
  CONSTRAINT `frk_se_materiales` FOREIGN KEY (`id_se`) REFERENCES `partida_sub_especifica` (`id`),
  CONSTRAINT `frk_um_materiales` FOREIGN KEY (`unidad_medida`) REFERENCES `unidad_medida` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `migration`
-- -------------------------------------------
DROP TABLE IF EXISTS `migration`;
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `modelhistory`
-- -------------------------------------------
DROP TABLE IF EXISTS `modelhistory`;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `municipio`
-- -------------------------------------------
DROP TABLE IF EXISTS `municipio`;
CREATE TABLE IF NOT EXISTS `municipio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `id_estado` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_estado` (`id_estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `notification`
-- -------------------------------------------
DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `key_id` int(11) DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `seen` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `objetivos_estrategicos`
-- -------------------------------------------
DROP TABLE IF EXISTS `objetivos_estrategicos`;
CREATE TABLE IF NOT EXISTS `objetivos_estrategicos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `objetivo_estrategico` text NOT NULL,
  `objetivo_nacional` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `directriz` (`objetivo_nacional`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Objetivos estrategicos - Area estrategica';

-- -------------------------------------------
-- TABLE `objetivos_generales`
-- -------------------------------------------
DROP TABLE IF EXISTS `objetivos_generales`;
CREATE TABLE IF NOT EXISTS `objetivos_generales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `objetivo_general` text NOT NULL,
  `objetivo_estrategico` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `estrategia` (`objetivo_estrategico`),
  CONSTRAINT `objetivos_generales_ibfk_1` FOREIGN KEY (`objetivo_estrategico`) REFERENCES `objetivos_estrategicos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Objetivos generales - Area estrategica';

-- -------------------------------------------
-- TABLE `objetivos_historicos`
-- -------------------------------------------
DROP TABLE IF EXISTS `objetivos_historicos`;
CREATE TABLE IF NOT EXISTS `objetivos_historicos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `objetivo_historico` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Objetivos historicos - Area estrategica';

-- -------------------------------------------
-- TABLE `objetivos_nacionales`
-- -------------------------------------------
DROP TABLE IF EXISTS `objetivos_nacionales`;
CREATE TABLE IF NOT EXISTS `objetivos_nacionales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `objetivo_nacional` text NOT NULL,
  `objetivo_historico` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `directriz` (`objetivo_historico`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Objetivos nacionales - Area estrategica';

-- -------------------------------------------
-- TABLE `pais`
-- -------------------------------------------
DROP TABLE IF EXISTS `pais`;
CREATE TABLE IF NOT EXISTS `pais` (
  `id` smallint(3) unsigned zerofill NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `parroquia`
-- -------------------------------------------
DROP TABLE IF EXISTS `parroquia`;
CREATE TABLE IF NOT EXISTS `parroquia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) CHARACTER SET latin1 NOT NULL,
  `id_municipio` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_municipio` (`id_municipio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `partida_especifica`
-- -------------------------------------------
DROP TABLE IF EXISTS `partida_especifica`;
CREATE TABLE IF NOT EXISTS `partida_especifica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `generica` int(11) NOT NULL,
  `especifica` varchar(2) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `estatus` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_ge` (`generica`),
  CONSTRAINT `frk_ge_es` FOREIGN KEY (`generica`) REFERENCES `partida_generica` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `partida_generica`
-- -------------------------------------------
DROP TABLE IF EXISTS `partida_generica`;
CREATE TABLE IF NOT EXISTS `partida_generica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_partida` int(11) NOT NULL,
  `generica` varchar(2) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `estatus` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_partidad` (`id_partida`),
  CONSTRAINT `fk_partida` FOREIGN KEY (`id_partida`) REFERENCES `partida_partida` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `partida_partida`
-- -------------------------------------------
DROP TABLE IF EXISTS `partida_partida`;
CREATE TABLE IF NOT EXISTS `partida_partida` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cuenta` int(11) NOT NULL COMMENT 'ID Cuenta',
  `partida` varchar(2) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `ramo` (`cuenta`),
  CONSTRAINT `partida_partida_ibfk_1` FOREIGN KEY (`cuenta`) REFERENCES `cuenta_presupuestaria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `partida_sub_especifica`
-- -------------------------------------------
DROP TABLE IF EXISTS `partida_sub_especifica`;
CREATE TABLE IF NOT EXISTS `partida_sub_especifica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `especifica` int(11) NOT NULL,
  `sub_especifica` varchar(2) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id_se` (`especifica`),
  CONSTRAINT `frk_es_se` FOREIGN KEY (`especifica`) REFERENCES `partida_especifica` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `perfil`
-- -------------------------------------------
DROP TABLE IF EXISTS `perfil`;
CREATE TABLE IF NOT EXISTS `perfil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `cedula` int(8) NOT NULL,
  `user_accounts` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_accounts` (`user_accounts`),
  CONSTRAINT `user_accounts_idfk` FOREIGN KEY (`user_accounts`) REFERENCES `user_accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Perfil de usuario';

-- -------------------------------------------
-- TABLE `plan_operativo`
-- -------------------------------------------
DROP TABLE IF EXISTS `plan_operativo`;
CREATE TABLE IF NOT EXISTS `plan_operativo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plan_operativo` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `presentacion`
-- -------------------------------------------
DROP TABLE IF EXISTS `presentacion`;
CREATE TABLE IF NOT EXISTS `presentacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `programacion_fisica_presupuestaria`
-- -------------------------------------------
DROP TABLE IF EXISTS `programacion_fisica_presupuestaria`;
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
  KEY `fk_programacion_fisica_presupuestaria_2_idx` (`id_proyecto_accion_especifica`),
  CONSTRAINT `fk_programacion_fisica_presupuestaria_1` FOREIGN KEY (`tipo_distribucion`) REFERENCES `tipo_distribucion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `proyecto`
-- -------------------------------------------
DROP TABLE IF EXISTS `proyecto`;
CREATE TABLE IF NOT EXISTS `proyecto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_proyecto` varchar(45) DEFAULT NULL,
  `codigo_sne` varchar(45) DEFAULT NULL,
  `nombre` text NOT NULL,
  `fecha_inicio` date NOT NULL COMMENT 'Fecha de inicio del proyecto',
  `fecha_fin` date NOT NULL COMMENT 'Fecha de fin del proyecto',
  `estatus_proyecto` int(11) NOT NULL,
  `situacion_presupuestaria` int(11) NOT NULL,
  `monto_proyecto` decimal(10,2) DEFAULT NULL,
  `descripcion` text,
  `sector` int(11) DEFAULT NULL,
  `sub_sector` int(11) DEFAULT NULL,
  `plan_operativo` int(11) NOT NULL,
  `objetivo_general` int(11) NOT NULL,
  `objetivo_estrategico_institucional` text NOT NULL,
  `ambito` int(11) NOT NULL,
  `aprobado` tinyint(1) NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `proyecto_accion_especifica`
-- -------------------------------------------
DROP TABLE IF EXISTS `proyecto_accion_especifica`;
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
  KEY `unidad_medida` (`unidad_medida`),
  CONSTRAINT `fk_accion_especifica_proyecto_1` FOREIGN KEY (`id_proyecto`) REFERENCES `proyecto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_accion_especifica_proyecto_2` FOREIGN KEY (`id_unidad_ejecutora`) REFERENCES `unidad_ejecutora` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `proyecto_alcance`
-- -------------------------------------------
DROP TABLE IF EXISTS `proyecto_alcance`;
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
  KEY `id_proyecto` (`id_proyecto`),
  CONSTRAINT `proyecto_alcance_ibfk_1` FOREIGN KEY (`id_proyecto`) REFERENCES `proyecto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Alcance e impacto del proyecto';

-- -------------------------------------------
-- TABLE `proyecto_asignar`
-- -------------------------------------------
DROP TABLE IF EXISTS `proyecto_asignar`;
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
  KEY `accion_especifica` (`accion_especifica`),
  CONSTRAINT `proyecto_asignar_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `user_accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `proyecto_asignar_ibfk_2` FOREIGN KEY (`unidad_ejecutora`) REFERENCES `unidad_ejecutora` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `proyecto_asignar_ibfk_3` FOREIGN KEY (`accion_especifica`) REFERENCES `proyecto_accion_especifica` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Relación entre usuarios, unidades ejecutoras y acciones específicas de un proyecto';

-- -------------------------------------------
-- TABLE `proyecto_distribucion_presupuestaria`
-- -------------------------------------------
DROP TABLE IF EXISTS `proyecto_distribucion_presupuestaria`;
CREATE TABLE IF NOT EXISTS `proyecto_distribucion_presupuestaria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_accion_especifica` int(11) NOT NULL COMMENT 'Acción Específica',
  `id_partida` int(11) NOT NULL COMMENT 'Partida',
  `cantidad` decimal(20,0) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_accion_especifica` (`id_accion_especifica`),
  KEY `id_partida` (`id_partida`),
  CONSTRAINT `id_accion_especifica_fk` FOREIGN KEY (`id_accion_especifica`) REFERENCES `proyecto_accion_especifica` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `id_partida_fk` FOREIGN KEY (`id_partida`) REFERENCES `partida_partida` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Distribución presupuestaria de proyecto';

-- -------------------------------------------
-- TABLE `proyecto_fuente_financiamiento`
-- -------------------------------------------
DROP TABLE IF EXISTS `proyecto_fuente_financiamiento`;
CREATE TABLE IF NOT EXISTS `proyecto_fuente_financiamiento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `proyecto_localizacion`
-- -------------------------------------------
DROP TABLE IF EXISTS `proyecto_localizacion`;
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
  KEY `id_pais` (`id_pais`),
  CONSTRAINT `estado_fk` FOREIGN KEY (`id_estado`) REFERENCES `estados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `municipio_fk` FOREIGN KEY (`id_municipio`) REFERENCES `municipio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `parroquia_fk` FOREIGN KEY (`id_parroquia`) REFERENCES `parroquia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `proyecto_fk` FOREIGN KEY (`id_proyecto`) REFERENCES `proyecto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `proyecto_pedido`
-- -------------------------------------------
DROP TABLE IF EXISTS `proyecto_pedido`;
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
  KEY `asignado` (`asignado`),
  CONSTRAINT `frk_asignado_pedido` FOREIGN KEY (`asignado`) REFERENCES `proyecto_asignar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `frk_materiales_pedido` FOREIGN KEY (`id_material`) REFERENCES `materiales_servicios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `proyecto_registrador`
-- -------------------------------------------
DROP TABLE IF EXISTS `proyecto_registrador`;
CREATE TABLE IF NOT EXISTS `proyecto_registrador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `cedula` int(10) NOT NULL,
  `email` varchar(80) DEFAULT NULL,
  `telefono` varchar(14) NOT NULL,
  `id_proyecto` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_proyecto` (`id_proyecto`),
  CONSTRAINT `proyecto_registrador_ibfk_1` FOREIGN KEY (`id_proyecto`) REFERENCES `proyecto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `proyecto_responsable`
-- -------------------------------------------
DROP TABLE IF EXISTS `proyecto_responsable`;
CREATE TABLE IF NOT EXISTS `proyecto_responsable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `cedula` int(10) NOT NULL,
  `email` varchar(45) NOT NULL,
  `telefono` varchar(14) NOT NULL,
  `id_proyecto` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `proyecto_fk` (`id_proyecto`),
  CONSTRAINT `fk_responsable_proyecto_1` FOREIGN KEY (`id_proyecto`) REFERENCES `proyecto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `proyecto_responsable_administrativo`
-- -------------------------------------------
DROP TABLE IF EXISTS `proyecto_responsable_administrativo`;
CREATE TABLE IF NOT EXISTS `proyecto_responsable_administrativo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `cedula` int(10) NOT NULL,
  `email` varchar(45) NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `unidad_administradora` varchar(45) NOT NULL,
  `id_proyecto` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_id_proyecto_idx` (`id_proyecto`),
  CONSTRAINT `idx_id_proyecto_fk` FOREIGN KEY (`id_proyecto`) REFERENCES `proyecto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `proyecto_responsable_tecnico`
-- -------------------------------------------
DROP TABLE IF EXISTS `proyecto_responsable_tecnico`;
CREATE TABLE IF NOT EXISTS `proyecto_responsable_tecnico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `cedula` int(10) NOT NULL,
  `email` varchar(45) NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `unidad_tecnica` varchar(45) NOT NULL,
  `id_proyecto` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_proyecto_fk` (`id_proyecto`),
  CONSTRAINT `fk_id_proyecto` FOREIGN KEY (`id_proyecto`) REFERENCES `proyecto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `responsable_acc_variable`
-- -------------------------------------------
DROP TABLE IF EXISTS `responsable_acc_variable`;
CREATE TABLE IF NOT EXISTS `responsable_acc_variable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `cedula` int(10) NOT NULL,
  `email` varchar(45) NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `oficina` varchar(60) NOT NULL,
  `id_variable` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `sector`
-- -------------------------------------------
DROP TABLE IF EXISTS `sector`;
CREATE TABLE IF NOT EXISTS `sector` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sector` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `situacion_presupuestaria`
-- -------------------------------------------
DROP TABLE IF EXISTS `situacion_presupuestaria`;
CREATE TABLE IF NOT EXISTS `situacion_presupuestaria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `situacion` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `sub_sector`
-- -------------------------------------------
DROP TABLE IF EXISTS `sub_sector`;
CREATE TABLE IF NOT EXISTS `sub_sector` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_sector` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `tipo_distribucion`
-- -------------------------------------------
DROP TABLE IF EXISTS `tipo_distribucion`;
CREATE TABLE IF NOT EXISTS `tipo_distribucion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `tipo_financiamiento`
-- -------------------------------------------
DROP TABLE IF EXISTS `tipo_financiamiento`;
CREATE TABLE IF NOT EXISTS `tipo_financiamiento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `unidad_ejecutora`
-- -------------------------------------------
DROP TABLE IF EXISTS `unidad_ejecutora`;
CREATE TABLE IF NOT EXISTS `unidad_ejecutora` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_ue` varchar(5) CHARACTER SET latin1 NOT NULL,
  `nombre` text CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo_ue_UNIQUE` (`codigo_ue`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `unidad_medida`
-- -------------------------------------------
DROP TABLE IF EXISTS `unidad_medida`;
CREATE TABLE IF NOT EXISTS `unidad_medida` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unidad_medida` varchar(45) NOT NULL COMMENT 'Unidad de medida',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Unidad de medida para el alcance e impacto del proyecto';

-- -------------------------------------------
-- TABLE `user_accounts`
-- -------------------------------------------
DROP TABLE IF EXISTS `user_accounts`;
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE DATA accion_centralizada
-- -------------------------------------------
INSERT INTO `accion_centralizada` (`id`,`codigo_accion`,`codigo_accion_sne`,`nombre_accion`,`fecha_inicio`,`fecha_fin`,`estatus`,`aprobado`) VALUES
('4','01','01','probando','2015-02-01','2016-04-30','1','1');
INSERT INTO `accion_centralizada` (`id`,`codigo_accion`,`codigo_accion_sne`,`nombre_accion`,`fecha_inicio`,`fecha_fin`,`estatus`,`aprobado`) VALUES
('5','02','02','probando con variables','2016-05-01','2016-05-31','1','0');



-- -------------------------------------------
-- TABLE DATA accion_centralizada_ac_especifica_uej
-- -------------------------------------------
INSERT INTO `accion_centralizada_ac_especifica_uej` (`id`,`id_ue`,`id_ac_esp`) VALUES
('1','600','13');
INSERT INTO `accion_centralizada_ac_especifica_uej` (`id`,`id_ue`,`id_ac_esp`) VALUES
('2','601','13');
INSERT INTO `accion_centralizada_ac_especifica_uej` (`id`,`id_ue`,`id_ac_esp`) VALUES
('3','602','13');



-- -------------------------------------------
-- TABLE DATA accion_centralizada_accion_especifica
-- -------------------------------------------
INSERT INTO `accion_centralizada_accion_especifica` (`id`,`id_ac_centr`,`cod_ac_espe`,`nombre`,`estatus`,`fecha_inicio`,`fecha_fin`) VALUES
('8','4','02','probandoggggg','1','2016-04-29','2016-04-30');
INSERT INTO `accion_centralizada_accion_especifica` (`id`,`id_ac_centr`,`cod_ac_espe`,`nombre`,`estatus`,`fecha_inicio`,`fecha_fin`) VALUES
('10','4','03','probando on insert','1','0000-00-00','0000-00-00');
INSERT INTO `accion_centralizada_accion_especifica` (`id`,`id_ac_centr`,`cod_ac_espe`,`nombre`,`estatus`,`fecha_inicio`,`fecha_fin`) VALUES
('11','4','04','probando on delete 2233dfdfs','1','2016-04-01','2016-04-30');
INSERT INTO `accion_centralizada_accion_especifica` (`id`,`id_ac_centr`,`cod_ac_espe`,`nombre`,`estatus`,`fecha_inicio`,`fecha_fin`) VALUES
('12','4','05','probando','1','2016-04-01','2016-04-30');
INSERT INTO `accion_centralizada_accion_especifica` (`id`,`id_ac_centr`,`cod_ac_espe`,`nombre`,`estatus`,`fecha_inicio`,`fecha_fin`) VALUES
('13','5','020','probando accion centralizada para las variables','1','2016-05-01','2016-05-01');



-- -------------------------------------------
-- TABLE DATA ambito
-- -------------------------------------------
INSERT INTO `ambito` (`id`,`ambito`) VALUES
('1','Internacional');
INSERT INTO `ambito` (`id`,`ambito`) VALUES
('2','Nacional');
INSERT INTO `ambito` (`id`,`ambito`) VALUES
('3','Regional');
INSERT INTO `ambito` (`id`,`ambito`) VALUES
('4','Estadal');
INSERT INTO `ambito` (`id`,`ambito`) VALUES
('5','Municipal');
INSERT INTO `ambito` (`id`,`ambito`) VALUES
('6','Parroquial');
INSERT INTO `ambito` (`id`,`ambito`) VALUES
('7','Comunal');
INSERT INTO `ambito` (`id`,`ambito`) VALUES
('8','Otros');



-- -------------------------------------------
-- TABLE DATA audit_data
-- -------------------------------------------
