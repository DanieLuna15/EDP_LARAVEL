DROP TABLE adeudacuotas;

CREATE TABLE `adeudacuotas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `monto` decimal(8,2) NOT NULL DEFAULT 0.00,
  `adeuda_id` int(11) DEFAULT NULL,
  `pagado` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE adeudas;

CREATE TABLE `adeudas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `planilla_id` int(11) NOT NULL DEFAULT 1,
  `contrato_id` int(11) NOT NULL DEFAULT 1,
  `fecha` date DEFAULT NULL,
  `monto` decimal(8,2) NOT NULL DEFAULT 1.00,
  `motivo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plan` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE ajustedotaciondetalles;

CREATE TABLE `ajustedotaciondetalles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `stockdotaciondetail_id` int(11) NOT NULL DEFAULT 1,
  `ajustedotacion_id` int(11) NOT NULL DEFAULT 1,
  `cantidad` decimal(8,2) NOT NULL DEFAULT 1.00,
  `antes` decimal(8,2) NOT NULL DEFAULT 1.00,
  `ahora` decimal(8,2) NOT NULL DEFAULT 1.00,
  `despues` decimal(8,2) NOT NULL DEFAULT 1.00,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE ajustedotacions;

CREATE TABLE `ajustedotacions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `motivo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE areas;

CREATE TABLE `areas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO areas VALUES("1","AREA","1","2023-02-09 11:26:11","2023-02-09 11:26:11");



DROP TABLE clientes;

CREATE TABLE `clientes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `documento_id` int(11) NOT NULL DEFAULT 1,
  `doc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE cogplanillas;

CREATE TABLE `cogplanillas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `dias_base` int(11) NOT NULL DEFAULT 1,
  `atraso` int(11) NOT NULL DEFAULT 1,
  `multiplicar` int(11) NOT NULL DEFAULT 1,
  `sueldo_base` decimal(8,2) NOT NULL DEFAULT 1.00,
  `dividir_dia` int(11) NOT NULL DEFAULT 1,
  `dividir_hora` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO cogplanillas VALUES("1","1","1","1","1.00","1","1","1","","");



DROP TABLE comprobantes;

CREATE TABLE `comprobantes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE contratocostos;

CREATE TABLE `contratocostos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `contrato_id` int(11) NOT NULL DEFAULT 1,
  `costofijo_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO contratocostos VALUES("1","1","1","1","2023-02-09 11:26:58","2023-02-09 11:26:58");



DROP TABLE contratos;

CREATE TABLE `contratos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `terminos` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `inicio` date DEFAULT NULL,
  `fin` date DEFAULT NULL,
  `tipocontrato_id` int(11) NOT NULL DEFAULT 1,
  `persona_id` int(11) NOT NULL DEFAULT 1,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `area_id` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `sueldo` decimal(8,2) NOT NULL DEFAULT 1.00,
  `servicio` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO contratos VALUES("1","---","2021-01-30","2023-02-09","1","1","1","1","1","1000.00","1","1","2023-02-09 11:26:58","2023-02-09 11:26:58");



DROP TABLE costofijos;

CREATE TABLE `costofijos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `monto` decimal(8,2) NOT NULL DEFAULT 1.00,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO costofijos VALUES("1","AFP","5.00","1","2023-02-09 11:25:51","2023-02-09 11:25:51");



DROP TABLE costovariables;

CREATE TABLE `costovariables` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE devosalidotacontras;

CREATE TABLE `devosalidotacontras` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `salidadotacioncontrato_id` int(11) NOT NULL DEFAULT 1,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `fecha` date DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE documentos;

CREATE TABLE `documentos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO documentos VALUES("1","NIT","1","2023-02-09 11:25:27","2023-02-09 11:25:27");



DROP TABLE dotacions;

CREATE TABLE `dotacions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `costo` decimal(8,2) NOT NULL DEFAULT 1.00,
  `venta` decimal(8,2) NOT NULL DEFAULT 1.00,
  `stock` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE filepersonas;

CREATE TABLE `filepersonas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `file_id` int(11) NOT NULL DEFAULT 1,
  `tipoarchivo_id` int(11) NOT NULL DEFAULT 1,
  `persona_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE files;

CREATE TABLE `files` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `path` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE filesucursals;

CREATE TABLE `filesucursals` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `file_id` int(11) NOT NULL DEFAULT 1,
  `tipoarchivo_id` int(11) NOT NULL DEFAULT 1,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE finiaguinaldodetalles;

CREATE TABLE `finiaguinaldodetalles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `finiaguinaldo_id` int(11) NOT NULL DEFAULT 1,
  `planilla_id` int(11) NOT NULL DEFAULT 1,
  `pago` decimal(8,2) NOT NULL DEFAULT 1.00,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE finiaguinaldos;

CREATE TABLE `finiaguinaldos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `contrato_id` int(11) NOT NULL DEFAULT 1,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `pago` decimal(8,2) NOT NULL DEFAULT 1.00,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE finianualdetalles;

CREATE TABLE `finianualdetalles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `finiquitoanual_id` int(11) NOT NULL DEFAULT 1,
  `planilla_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE finiquinqueniodetalles;

CREATE TABLE `finiquinqueniodetalles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `finiquinquenio_id` int(11) NOT NULL DEFAULT 1,
  `planilla_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE finiquinquenios;

CREATE TABLE `finiquinquenios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `contrato_id` int(11) NOT NULL DEFAULT 1,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `pago` decimal(8,2) NOT NULL DEFAULT 1.00,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE finiquitoanuals;

CREATE TABLE `finiquitoanuals` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `contrato_id` int(11) NOT NULL DEFAULT 1,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `pago` decimal(8,2) NOT NULL DEFAULT 1.00,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE finivacacionaldetalles;

CREATE TABLE `finivacacionaldetalles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `finivacacional_id` int(11) NOT NULL DEFAULT 1,
  `planilla_id` int(11) NOT NULL DEFAULT 1,
  `pago` decimal(8,2) NOT NULL DEFAULT 1.00,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE finivacacionals;

CREATE TABLE `finivacacionals` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `contrato_id` int(11) NOT NULL DEFAULT 1,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `pago` decimal(8,2) NOT NULL DEFAULT 1.00,
  `planilla` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE formapagos;

CREATE TABLE `formapagos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE liquidacions;

CREATE TABLE `liquidacions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `inicio` date DEFAULT NULL,
  `fin` date DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `contrato_id` int(11) NOT NULL DEFAULT 1,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `dia` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `mes` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `user_id` int(11) NOT NULL DEFAULT 1,
  `sueldo_diario` decimal(8,2) NOT NULL DEFAULT 1.00,
  `sueldo_mensual` decimal(8,2) NOT NULL DEFAULT 1.00,
  `sueldo_bruto` decimal(8,2) NOT NULL DEFAULT 1.00,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE logs;

CREATE TABLE `logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ip` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO logs VALUES("1","127.0.0.1","Chrome","1","1","2023-02-10 14:20:37","2023-02-10 14:20:37");



DROP TABLE memorandums;

CREATE TABLE `memorandums` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `contrato_id` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `motivomemorandum_id` int(11) NOT NULL DEFAULT 1,
  `descripciom` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO memorandums VALUES("1","1","1","1","1","sddsds","2023-02-16","1","2023-02-09 11:52:26","2023-02-09 11:52:26");
INSERT INTO memorandums VALUES("2","1","1","1","1","cx","","1","2023-02-09 12:10:52","2023-02-09 12:10:52");



DROP TABLE migrations;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=196 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO migrations VALUES("144","2014_10_12_000000_create_users_table","1");
INSERT INTO migrations VALUES("145","2019_12_14_000001_create_personal_access_tokens_table","1");
INSERT INTO migrations VALUES("146","2023_01_06_222527_create_documentos_table","1");
INSERT INTO migrations VALUES("147","2023_01_16_055046_create_personas_table","1");
INSERT INTO migrations VALUES("148","2023_02_07_035249_create_tipocontratos_table","1");
INSERT INTO migrations VALUES("149","2023_02_07_035306_create_tipoarchivos_table","1");
INSERT INTO migrations VALUES("150","2023_02_07_035319_create_comprobantes_table","1");
INSERT INTO migrations VALUES("151","2023_02_07_035341_create_areas_table","1");
INSERT INTO migrations VALUES("152","2023_02_07_042909_create_sucursals_table","1");
INSERT INTO migrations VALUES("153","2023_02_07_083809_create_sucursal_tirajes_table","1");
INSERT INTO migrations VALUES("154","2023_02_08_043711_create_formapagos_table","1");
INSERT INTO migrations VALUES("155","2023_02_08_044238_create_parametrovacacions_table","1");
INSERT INTO migrations VALUES("156","2023_02_08_045135_create_costofijos_table","1");
INSERT INTO migrations VALUES("157","2023_02_08_050105_create_costovariables_table","1");
INSERT INTO migrations VALUES("158","2023_02_08_050353_create_proveedors_table","1");
INSERT INTO migrations VALUES("159","2023_02_08_051412_create_clientes_table","1");
INSERT INTO migrations VALUES("160","2023_02_08_052415_create_dotacions_table","1");
INSERT INTO migrations VALUES("161","2023_02_08_054036_create_stockdotacions_table","1");
INSERT INTO migrations VALUES("162","2023_02_08_054045_create_stockdotaciondetails_table","1");
INSERT INTO migrations VALUES("163","2023_02_08_085227_create_contratos_table","1");
INSERT INTO migrations VALUES("164","2023_02_08_085332_create_contratocostos_table","1");
INSERT INTO migrations VALUES("165","2023_02_08_100332_create_cogplanillas_table","1");
INSERT INTO migrations VALUES("166","2023_02_08_101818_create_planillas_table","1");
INSERT INTO migrations VALUES("167","2023_02_08_110401_create_planillacostos_table","1");
INSERT INTO migrations VALUES("168","2023_02_08_110508_create_adeudas_table","1");
INSERT INTO migrations VALUES("169","2023_02_08_110538_create_adeudacuotas_table","1");
INSERT INTO migrations VALUES("170","2023_02_08_121034_create_finiquitoanuals_table","1");
INSERT INTO migrations VALUES("171","2023_02_08_121046_create_finianualdetalles_table","1");
INSERT INTO migrations VALUES("172","2023_02_08_135142_create_finiquinqueniodetalles_table","1");
INSERT INTO migrations VALUES("173","2023_02_08_135156_create_finiquinquenios_table","1");
INSERT INTO migrations VALUES("174","2023_02_08_142039_create_finivacacionals_table","1");
INSERT INTO migrations VALUES("175","2023_02_08_142048_create_finivacacionaldetalles_table","1");
INSERT INTO migrations VALUES("176","2023_02_08_145129_create_finiaguinaldos_table","1");
INSERT INTO migrations VALUES("177","2023_02_08_145143_create_finiaguinaldodetalles_table","1");
INSERT INTO migrations VALUES("178","2023_02_08_164047_create_liquidacions_table","1");
INSERT INTO migrations VALUES("179","2023_02_08_174637_create_ajustedotacions_table","1");
INSERT INTO migrations VALUES("180","2023_02_08_174646_create_ajustedotaciondetalles_table","1");
INSERT INTO migrations VALUES("181","2023_02_08_183932_create_salidadotacioncontratos_table","1");
INSERT INTO migrations VALUES("182","2023_02_08_184016_create_salidotacontradetas_table","1");
INSERT INTO migrations VALUES("183","2023_02_08_193825_create_devosalidotacontras_table","1");
INSERT INTO migrations VALUES("184","2023_02_08_205153_create_redotacions_table","1");
INSERT INTO migrations VALUES("185","2023_02_08_205215_create_redotaciondetalles_table","1");
INSERT INTO migrations VALUES("186","2023_02_08_222001_create_salidadotaclientes_table","1");
INSERT INTO migrations VALUES("187","2023_02_08_222017_create_salidadotaclidetalles_table","1");
INSERT INTO migrations VALUES("188","2023_02_09_024211_create_logs_table","1");
INSERT INTO migrations VALUES("189","2023_02_09_033057_create_files_table","1");
INSERT INTO migrations VALUES("190","2023_02_09_033106_create_filepersonas_table","1");
INSERT INTO migrations VALUES("191","2023_02_09_033114_create_filesucursals_table","1");
INSERT INTO migrations VALUES("192","2023_02_09_083959_create_planillaservicios_table","1");
INSERT INTO migrations VALUES("193","2023_02_09_084027_create_planillaserviciocostos_table","1");
INSERT INTO migrations VALUES("194","2023_02_09_105314_create_motivomemorandums_table","1");
INSERT INTO migrations VALUES("195","2023_02_09_105345_create_memorandums_table","1");



DROP TABLE motivomemorandums;

CREATE TABLE `motivomemorandums` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO motivomemorandums VALUES("1","MOTIVO","1","2023-02-09 11:27:12","2023-02-09 11:27:12");



DROP TABLE parametrovacacions;

CREATE TABLE `parametrovacacions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `desde` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hasta` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dias` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE personal_access_tokens;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE personas;

CREATE TABLE `personas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apellidos` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `documento_id` int(11) NOT NULL DEFAULT 1,
  `doc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cargo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `garante` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cel_garante` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dir_garante` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `inactivo` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO personas VALUES("1","PERSONA 1","APELLIDO","1","101","+51988714360","10","10","10","10","Walter acevedo Otuzco La Libertad","1","1","2023-02-09 11:25:42","2023-02-09 11:25:42");



DROP TABLE planillacostos;

CREATE TABLE `planillacostos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `planilla_id` int(11) NOT NULL DEFAULT 1,
  `costovariable_id` int(11) NOT NULL DEFAULT 1,
  `monto` decimal(8,2) NOT NULL DEFAULT 1.00,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE planillas;

CREATE TABLE `planillas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `contrato_id` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `fecha` date DEFAULT NULL,
  `desde` date DEFAULT NULL,
  `hasta` date DEFAULT NULL,
  `fijos` decimal(8,2) NOT NULL DEFAULT 1.00,
  `valor_vacaciones` decimal(8,2) NOT NULL DEFAULT 0.00,
  `sueldo` decimal(8,2) NOT NULL DEFAULT 1.00,
  `variables` decimal(8,2) NOT NULL DEFAULT 1.00,
  `bruto` decimal(8,2) NOT NULL DEFAULT 1.00,
  `extras` decimal(8,2) NOT NULL DEFAULT 1.00,
  `extras_n` decimal(8,2) NOT NULL DEFAULT 1.00,
  `faltas` decimal(8,2) NOT NULL DEFAULT 1.00,
  `faltas_n` decimal(8,2) NOT NULL DEFAULT 1.00,
  `atraso` decimal(8,2) NOT NULL DEFAULT 1.00,
  `atraso_n` decimal(8,2) NOT NULL DEFAULT 1.00,
  `venta_n` decimal(8,2) NOT NULL DEFAULT 1.00,
  `venta` decimal(8,2) NOT NULL DEFAULT 1.00,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE planillaserviciocostos;

CREATE TABLE `planillaserviciocostos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `planillaservicio_id` int(11) NOT NULL DEFAULT 1,
  `costovariable_id` int(11) NOT NULL DEFAULT 1,
  `monto` decimal(8,2) NOT NULL DEFAULT 1.00,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE planillaservicios;

CREATE TABLE `planillaservicios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `contrato_id` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `horas` int(11) NOT NULL DEFAULT 1,
  `valor_horas` decimal(8,2) NOT NULL DEFAULT 1.00,
  `motivo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `desde` date DEFAULT NULL,
  `hasta` date DEFAULT NULL,
  `fijos` decimal(8,2) NOT NULL DEFAULT 1.00,
  `sueldo` decimal(8,2) NOT NULL DEFAULT 1.00,
  `variables` decimal(8,2) NOT NULL DEFAULT 1.00,
  `bruto` decimal(8,2) NOT NULL DEFAULT 1.00,
  `extras` decimal(8,2) NOT NULL DEFAULT 1.00,
  `extras_n` decimal(8,2) NOT NULL DEFAULT 1.00,
  `faltas` decimal(8,2) NOT NULL DEFAULT 1.00,
  `faltas_n` decimal(8,2) NOT NULL DEFAULT 1.00,
  `atraso` decimal(8,2) NOT NULL DEFAULT 1.00,
  `atraso_n` decimal(8,2) NOT NULL DEFAULT 1.00,
  `venta_n` decimal(8,2) NOT NULL DEFAULT 1.00,
  `venta` decimal(8,2) NOT NULL DEFAULT 1.00,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE proveedors;

CREATE TABLE `proveedors` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `documento_id` int(11) NOT NULL DEFAULT 1,
  `doc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `encargado` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE redotaciondetalles;

CREATE TABLE `redotaciondetalles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `stockdotaciondetail_id` int(11) NOT NULL DEFAULT 1,
  `redotacion_id` int(11) NOT NULL DEFAULT 1,
  `cantidad` decimal(8,2) NOT NULL DEFAULT 1.00,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE redotacions;

CREATE TABLE `redotacions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `contrato_id` int(11) NOT NULL DEFAULT 1,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `salidadotacioncontrato_id` int(11) NOT NULL DEFAULT 1,
  `fecha` date DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE salidadotacioncontratos;

CREATE TABLE `salidadotacioncontratos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `contrato_id` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE salidadotaclidetalles;

CREATE TABLE `salidadotaclidetalles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `stockdotaciondetail_id` int(11) NOT NULL DEFAULT 1,
  `salidadotacliente_id` int(11) NOT NULL DEFAULT 1,
  `cliente_id` int(11) NOT NULL DEFAULT 1,
  `cantidad` decimal(8,2) NOT NULL DEFAULT 1.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE salidadotaclientes;

CREATE TABLE `salidadotaclientes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `cliente_id` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE salidotacontradetas;

CREATE TABLE `salidotacontradetas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `stockdotaciondetail_id` int(11) NOT NULL DEFAULT 1,
  `salidadotacioncontrato_id` int(11) NOT NULL DEFAULT 1,
  `contrato_id` int(11) NOT NULL DEFAULT 1,
  `cantidad` decimal(8,2) NOT NULL DEFAULT 1.00,
  `estado` int(11) NOT NULL DEFAULT 1,
  `fecha` date DEFAULT NULL,
  `motivo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE stockdotaciondetails;

CREATE TABLE `stockdotaciondetails` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `proveedor_id` int(11) NOT NULL DEFAULT 1,
  `dotacion_id` int(11) NOT NULL DEFAULT 1,
  `stockdotacion_id` int(11) NOT NULL DEFAULT 1,
  `costo` decimal(8,2) NOT NULL DEFAULT 1.00,
  `venta` decimal(8,2) NOT NULL DEFAULT 1.00,
  `cantidad` decimal(8,2) NOT NULL DEFAULT 1.00,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE stockdotacions;

CREATE TABLE `stockdotacions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `proveedor_id` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `formapago_id` int(11) NOT NULL DEFAULT 1,
  `fecha` date DEFAULT NULL,
  `motivo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE sucursal_tirajes;

CREATE TABLE `sucursal_tirajes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `serie` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nro_auth` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comprobante_id` int(11) NOT NULL DEFAULT 1,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `inicio` int(11) NOT NULL DEFAULT 1,
  `fin` int(11) NOT NULL DEFAULT 1,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE sucursals;

CREATE TABLE `sucursals` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `documento_id` int(11) NOT NULL DEFAULT 1,
  `doc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `responsable` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `encargado` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `medidor` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO sucursals VALUES("1","SUC","1","121","+51988714360","jhonycreativo.code@gmail.com","--","--","--","Walter acevedo Otuzco La Libertad","1","2023-02-09 11:26:31","2023-02-09 11:26:31");



DROP TABLE tipoarchivos;

CREATE TABLE `tipoarchivos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE tipocontratos;

CREATE TABLE `tipocontratos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO tipocontratos VALUES("1","FIJO","1","2023-02-09 11:25:58","2023-02-09 11:25:58");



DROP TABLE users;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apellidos` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usuario` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO users VALUES("1","DEMO","DEMO","DEMO","DEMO","DEMO","1","2023-02-09 11:25:19","2023-02-09 11:25:19");



