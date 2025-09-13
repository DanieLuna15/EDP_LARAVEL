-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-08-2025 a las 22:25:58
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `api_pollos_final5`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acuerdo_clientes`
--

CREATE TABLE `acuerdo_clientes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cantidad` decimal(10,3) DEFAULT NULL,
  `peso` decimal(10,3) DEFAULT NULL,
  `precio` decimal(10,3) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `digitar` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `acuerdo_clientes`
--

INSERT INTO `acuerdo_clientes` (`id`, `name`, `cantidad`, `peso`, `precio`, `estado`, `created_at`, `updated_at`, `digitar`) VALUES
(1, 'ACUERDO 1', '2.000', '0.390', '14.000', 0, '2024-01-12 20:19:52', '2025-05-16 21:28:14', 0),
(2, 'ACUERDO 2', '2.000', '0.000', '13.500', 1, '2024-01-12 20:20:06', '2024-06-07 22:40:22', 1),
(3, 'ACUERDO 1', '2.000', '0.360', '10.000', 1, '2025-05-16 21:28:06', '2025-07-23 15:10:58', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adeudacuotas`
--

CREATE TABLE `adeudacuotas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `monto` decimal(10,3) NOT NULL DEFAULT 0.000,
  `adeuda_id` int(11) DEFAULT NULL,
  `pagado` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adeudas`
--

CREATE TABLE `adeudas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `planilla_id` int(11) NOT NULL DEFAULT 1,
  `contrato_id` int(11) NOT NULL DEFAULT 1,
  `fecha` date DEFAULT NULL,
  `monto` decimal(10,3) NOT NULL DEFAULT 1.000,
  `motivo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plan` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adeuda_planillas`
--

CREATE TABLE `adeuda_planillas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `adeuda_id` int(11) NOT NULL DEFAULT 1,
  `planilla_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ajustedotaciondetalles`
--

CREATE TABLE `ajustedotaciondetalles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stockdotaciondetail_id` int(11) NOT NULL DEFAULT 1,
  `ajustedotacion_id` int(11) NOT NULL DEFAULT 1,
  `cantidad` decimal(10,3) NOT NULL DEFAULT 1.000,
  `antes` decimal(10,3) NOT NULL DEFAULT 1.000,
  `ahora` decimal(10,3) NOT NULL DEFAULT 1.000,
  `despues` decimal(10,3) NOT NULL DEFAULT 1.000,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ajustedotacions`
--

CREATE TABLE `ajustedotacions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `motivo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacens`
--

CREATE TABLE `almacens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `almacens`
--

INSERT INTO `almacens` (`id`, `sucursal_id`, `name`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, 'almacen CBBA', 1, '2023-03-09 21:04:47', '2025-05-21 16:52:36'),
(2, 1, 'almacen LP', 1, '2023-04-03 13:34:50', '2025-05-21 16:52:25'),
(3, 1, 'almacen RESERVA', 1, '2023-04-06 11:34:59', '2025-05-21 16:52:30'),
(4, 1, 'Granja SCZ', 1, '2025-05-22 21:21:00', '2025-05-22 21:21:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id`, `name`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'AREA', 1, '2023-02-09 16:26:11', '2023-02-09 16:26:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arqueos`
--

CREATE TABLE `arqueos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `caja_sucursal_usuario_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sucursal_id` int(11) NOT NULL,
  `monto_inicial` decimal(10,3) NOT NULL,
  `apertura` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `observaciones` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `detalle_billetaje` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`detalle_billetaje`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arqueo_ingresos`
--

CREATE TABLE `arqueo_ingresos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nro` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cajamotivo_id` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `arqueo_id` int(11) NOT NULL,
  `tipo` int(11) NOT NULL,
  `formapago_id` int(11) NOT NULL,
  `monto` decimal(10,3) NOT NULL,
  `fecha` date NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arqueo_ventas`
--

CREATE TABLE `arqueo_ventas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `arqueo_id` int(11) NOT NULL DEFAULT 1,
  `venta_id` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `formapago_id` int(11) NOT NULL DEFAULT 1,
  `monto` decimal(10,2) NOT NULL DEFAULT 0.00,
  `pago_con` decimal(10,2) NOT NULL DEFAULT 0.00,
  `cambio` decimal(10,2) NOT NULL DEFAULT 0.00,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ticket_first_printed_at` timestamp NULL DEFAULT NULL,
  `ticket_print_count` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arqueo_venta_pago_global`
--

CREATE TABLE `arqueo_venta_pago_global` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pago_global_id` bigint(20) UNSIGNED NOT NULL,
  `arqueo_venta_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ave_inventarios`
--

CREATE TABLE `ave_inventarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `producto_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `sucursal_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `almacen_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `lote_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `motivo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `medida_producto_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `sub_medida_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `cant` decimal(8,3) NOT NULL DEFAULT 0.000,
  `nro` decimal(8,3) NOT NULL DEFAULT 0.000,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bancos`
--

CREATE TABLE `bancos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `titular` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cuenta` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `bancos`
--

INSERT INTO `bancos` (`id`, `name`, `estado`, `created_at`, `updated_at`, `titular`, `cuenta`) VALUES
(1, 'BCP', 1, '2023-03-22 10:40:06', '2023-11-20 01:24:53', NULL, NULL),
(2, 'BNB', 1, '2023-03-22 10:40:11', '2023-11-20 01:24:48', NULL, NULL),
(3, 'FORTALEZA', 1, '2024-02-02 14:49:11', '2024-02-02 14:49:11', '-', '-'),
(4, 'EFECTIVO', 1, '2024-02-02 14:49:17', '2024-02-02 14:49:17', '-', '-'),
(5, 'UNION', 1, '2024-02-02 14:49:25', '2024-02-02 14:49:25', '-', '-'),
(6, 'FIE', 1, '2024-02-02 14:49:31', '2024-02-02 14:49:31', '-', '-'),
(7, 'PRODEM', 1, '2024-02-02 14:49:36', '2024-02-02 14:49:36', '-', '-'),
(8, 'ECONOMICO', 1, '2024-02-02 14:49:44', '2024-02-02 14:49:44', '-', '-');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banderas`
--

CREATE TABLE `banderas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min` int(11) NOT NULL DEFAULT 0,
  `max` int(11) NOT NULL DEFAULT 0,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `banderas`
--

INSERT INTO `banderas` (`id`, `name`, `min`, `max`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'success', 0, 1, 1, '2024-04-23 05:00:04', '2024-04-23 05:25:03'),
(2, 'warning', 1, 2, 1, '2024-04-23 05:00:36', '2024-04-23 05:25:09'),
(3, 'danger', 2, 9999999, 1, '2024-04-23 05:01:27', '2024-04-23 05:25:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora_lotes`
--

CREATE TABLE `bitacora_lotes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lote_id` int(11) NOT NULL DEFAULT 1,
  `fecha` date DEFAULT NULL,
  `peso_total` decimal(10,3) NOT NULL,
  `peso_neto` decimal(10,3) NOT NULL,
  `peso_bruto` decimal(10,3) NOT NULL,
  `cajas` decimal(10,3) NOT NULL,
  `cajas_lote` decimal(10,3) NOT NULL,
  `pollos` decimal(10,3) NOT NULL,
  `pollos_lote` decimal(10,3) NOT NULL,
  `tipo` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cajacerrada_clientes`
--

CREATE TABLE `cajacerrada_clientes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desde` decimal(10,3) DEFAULT NULL,
  `hasta` decimal(10,3) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cajacerrada_clientes`
--

INSERT INTO `cajacerrada_clientes` (`id`, `name`, `desde`, `hasta`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'DE 1 A 14 POLLOS', '1.000', '14.000', 1, '2024-10-09 13:23:02', '2024-10-09 13:23:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cajas`
--

CREATE TABLE `cajas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `compra` decimal(10,3) NOT NULL DEFAULT 0.000,
  `venta` decimal(10,3) NOT NULL DEFAULT 0.000,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cajas`
--

INSERT INTO `cajas` (`id`, `name`, `estado`, `compra`, `venta`, `created_at`, `updated_at`) VALUES
(1, 'CAJA', 1, '1.000', '2.000', '2025-04-15 08:46:35', '2025-04-15 08:48:33'),
(2, 'Jaula', 1, '100.000', '100.000', '2025-05-23 16:36:56', '2025-05-23 16:36:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja_ajustes`
--

CREATE TABLE `caja_ajustes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecha` date DEFAULT NULL,
  `motivo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja_ajuste_detalles`
--

CREATE TABLE `caja_ajuste_detalles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `caja_ajuste_id` int(11) NOT NULL DEFAULT 1,
  `caja_inventario_id` int(11) NOT NULL DEFAULT 1,
  `stock_actual` int(11) NOT NULL DEFAULT 1,
  `ajuste` int(11) NOT NULL DEFAULT 1,
  `stock_final` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja_compras`
--

CREATE TABLE `caja_compras` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `caja_id` int(11) NOT NULL DEFAULT 1,
  `caja_inventario_id` int(11) NOT NULL DEFAULT 1,
  `compra_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja_compras_aves`
--

CREATE TABLE `caja_compras_aves` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `caja_id` int(11) NOT NULL DEFAULT 1,
  `caja_inventario_id` int(11) NOT NULL DEFAULT 1,
  `compra_ave_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja_entradas`
--

CREATE TABLE `caja_entradas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `almacen_id` int(11) NOT NULL DEFAULT 1,
  `fecha` date DEFAULT NULL,
  `hora` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja_envios`
--

CREATE TABLE `caja_envios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecha` date DEFAULT NULL,
  `almacen_origen_id` int(11) NOT NULL DEFAULT 1,
  `almacen_destino_id` int(11) NOT NULL DEFAULT 1,
  `caja_id` int(11) NOT NULL DEFAULT 1,
  `motivo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chofer` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `camion` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja_inventarios`
--

CREATE TABLE `caja_inventarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tipo` int(11) NOT NULL DEFAULT 1,
  `motivo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `caja_id` int(11) NOT NULL DEFAULT 1,
  `almacen_id` int(11) NOT NULL DEFAULT 1,
  `cantidad` int(11) NOT NULL DEFAULT 1,
  `compra` decimal(10,3) NOT NULL DEFAULT 0.000,
  `venta` decimal(10,3) NOT NULL DEFAULT 0.000,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja_motivos`
--

CREATE TABLE `caja_motivos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `caja_motivos`
--

INSERT INTO `caja_motivos` (`id`, `name`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'venta', 1, '2025-05-26 18:07:58', '2025-05-26 18:07:58'),
(2, 'pago de luz', 1, '2025-05-26 18:08:04', '2025-05-26 18:08:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja_proveedors`
--

CREATE TABLE `caja_proveedors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `documento_id` int(11) NOT NULL DEFAULT 1,
  `doc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `encargado` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja_sucursals`
--

CREATE TABLE `caja_sucursals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `caja_sucursals`
--

INSERT INTO `caja_sucursals` (`id`, `name`, `sucursal_id`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'CAJA PRINCIPAL', 1, 1, '2025-05-16 22:01:43', '2025-05-16 22:01:43'),
(2, 'caja 2', 1, 1, '2025-08-11 20:04:23', '2025-08-11 20:04:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja_sucursal_usuarios`
--

CREATE TABLE `caja_sucursal_usuarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `caja_sucursal_id` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `caja_sucursal_usuarios`
--

INSERT INTO `caja_sucursal_usuarios` (`id`, `caja_sucursal_id`, `user_id`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2025-05-16 22:03:02', '2025-05-16 22:03:02'),
(2, 1, 1, 0, '2025-05-26 20:53:04', '2025-05-26 20:53:08'),
(3, 2, 2, 1, '2025-08-11 20:04:32', '2025-08-11 20:04:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja_venta_clientes`
--

CREATE TABLE `caja_venta_clientes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hora` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 0,
  `debe` int(11) NOT NULL DEFAULT 0,
  `entregado` int(11) NOT NULL DEFAULT 0,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `cliente_id` int(11) NOT NULL DEFAULT 1,
  `venta_id` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cambio_precios`
--

CREATE TABLE `cambio_precios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sucursal_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cambio_precio_consolidacions`
--

CREATE TABLE `cambio_precio_consolidacions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `consolidacion_id` bigint(20) UNSIGNED NOT NULL,
  `consolidacion_detalle_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `precio_anterior` decimal(10,3) NOT NULL,
  `precio_actual` decimal(10,3) NOT NULL,
  `nro_cambio` int(11) NOT NULL DEFAULT 0,
  `fecha_cambio` datetime DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cambio_precio_consolidacion_aves`
--

CREATE TABLE `cambio_precio_consolidacion_aves` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `consolidacion_id` bigint(20) UNSIGNED NOT NULL,
  `consolidacion_detalle_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `precio_anterior` decimal(10,2) DEFAULT NULL,
  `precio_actual` decimal(10,2) DEFAULT NULL,
  `nro_cambio` int(11) NOT NULL DEFAULT 0,
  `fecha_cambio` datetime DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cambio_precio_consolidacion_aves_new`
--

CREATE TABLE `cambio_precio_consolidacion_aves_new` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `consolidacion_id` bigint(20) UNSIGNED NOT NULL,
  `consolidacion_detalle_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `precio_anterior` decimal(10,3) NOT NULL,
  `precio_actual` decimal(10,3) NOT NULL,
  `nro_cambio` int(11) NOT NULL DEFAULT 0,
  `fecha_cambio` datetime DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cinta` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `name`, `estado`, `created_at`, `updated_at`, `cinta`) VALUES
(1, 'PRIMERA', 1, '2023-03-09 20:35:29', '2023-03-09 20:35:29', 1),
(2, 'SEGUNDA', 1, '2023-03-09 20:35:34', '2023-04-04 21:28:16', 1),
(3, 'BB', 1, '2023-04-04 21:44:54', '2023-04-04 21:44:54', 1),
(4, 'PRESAS ALA', 0, '2024-07-19 14:20:36', '2025-02-11 16:24:46', 2),
(5, 'Nuevo', 0, '2024-09-08 19:50:07', '2024-09-08 19:51:26', 1),
(6, 'PRESA PECHUGA', 1, '2025-02-11 16:25:02', '2025-02-11 17:04:09', 1),
(7, 'PRESA PIERNA', 1, '2025-02-11 16:25:25', '2025-02-11 17:04:16', 1),
(8, 'PRESA ALA', 1, '2025-02-11 16:57:01', '2025-02-11 17:04:23', 1),
(9, 'PRESA CAZUELA', 1, '2025-02-11 16:57:10', '2025-02-11 17:04:29', 1),
(10, 'PRESA CUELLO', 1, '2025-02-11 16:57:19', '2025-02-11 17:04:36', 1),
(11, 'PRESA MENUDO', 1, '2025-02-11 16:57:29', '2025-02-11 17:05:05', 1),
(12, 'PRESA HIGADO', 1, '2025-02-11 16:57:37', '2025-02-11 17:05:09', 1),
(13, 'PRESA FILETE', 1, '2025-02-11 16:57:46', '2025-02-11 17:05:13', 1),
(14, 'PRESA PULMON', 1, '2025-02-11 16:57:59', '2025-02-11 17:05:17', 1),
(15, 'PRESA COSTILLA', 1, '2025-02-11 16:58:07', '2025-02-11 17:05:22', 1),
(16, 'PRESA FILETE DESHUESADO', 1, '2025-02-11 16:59:20', '2025-02-11 17:05:27', 1),
(17, 'PRESA FILETILLO', 1, '2025-02-11 16:59:41', '2025-02-11 17:05:32', 1),
(18, 'PRESA ALA PICADA', 1, '2025-02-11 16:59:55', '2025-02-11 17:05:36', 1),
(19, 'PRESA PUNTA DE ALA', 1, '2025-02-11 17:00:14', '2025-02-11 17:05:40', 1),
(20, 'PRESA MALTRATO', 1, '2025-02-11 17:00:56', '2025-02-11 17:05:45', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chofers`
--

CREATE TABLE `chofers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `documento_id` int(11) NOT NULL DEFAULT 1,
  `doc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `placa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modelo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zona` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `capacidad` decimal(10,3) NOT NULL DEFAULT 0.000,
  `estado_compra_chofer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `chofers`
--

INSERT INTO `chofers` (`id`, `nombre`, `documento_id`, `doc`, `estado`, `created_at`, `updated_at`, `placa`, `modelo`, `color`, `zona`, `capacidad`, `estado_compra_chofer_id`) VALUES
(1, 'CHOFER 1', 1, '123456', 1, '2024-01-12 16:15:21', '2024-01-12 16:15:21', 'X3D-231', 'XD-21', 'BLANCO', 'ZONA A', '104500.000', 2),
(2, 'CHOFER 2', 1, '112231', 1, '2024-01-12 16:15:53', '2024-01-12 16:15:53', 'XT3321-2', 'XQ183', 'NEGRO', 'ZONA B', '140500.000', 1),
(3, 'CHOFER 3', 1, '66666', 1, '2025-06-10 14:08:10', '2025-06-10 14:08:10', '999999', '2006', 'VERDE', 'ZONA 3', '5600000.000', 1),
(4, 'CHOFER 4', 1, '88888888', 1, '2025-06-10 14:08:34', '2025-06-10 14:08:34', '77777777', '2003', 'AZUL', 'ZONA 4', '45600.000', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cinta_clientes`
--

CREATE TABLE `cinta_clientes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inicio` decimal(10,3) DEFAULT NULL,
  `fin` decimal(10,3) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cinta_clientes`
--

INSERT INTO `cinta_clientes` (`id`, `name`, `inicio`, `fin`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'G1', '0.300', '0.400', 1, '2024-01-12 16:11:45', '2024-01-12 16:11:45'),
(2, 'G2', '0.300', '0.400', 1, '2024-01-12 16:11:51', '2024-01-12 16:11:51'),
(3, 'G3', '0.300', '0.400', 1, '2024-01-12 16:11:55', '2024-01-12 16:11:55'),
(4, 'G4', '0.300', '0.400', 1, '2024-01-12 16:12:01', '2024-01-12 16:12:01'),
(5, 'G5', '0.300', '0.400', 1, '2024-01-12 16:12:07', '2024-01-12 16:12:07'),
(6, 'DESCARTE', '0.300', '0.400', 1, '2024-01-12 16:12:15', '2024-01-12 16:12:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `documento_id` int(11) NOT NULL DEFAULT 1,
  `doc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tipocliente_id` int(11) NOT NULL DEFAULT 1,
  `telefono` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `limite_crediticio` decimal(10,3) NOT NULL DEFAULT 0.000,
  `creditos_activos` int(11) NOT NULL DEFAULT 1,
  `dias_horas` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitud` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitud` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cinta_cliente_id` int(11) NOT NULL DEFAULT 1,
  `dinero_cuenta` decimal(10,3) NOT NULL DEFAULT 0.000,
  `deuda_heredada` decimal(10,3) NOT NULL DEFAULT 0.000,
  `tipo_caja_cerrada` int(11) NOT NULL DEFAULT 1,
  `tipo_cliente_pp` int(11) NOT NULL DEFAULT 1,
  `tipo_pollo_limpia` int(11) NOT NULL DEFAULT 1,
  `acuerdo` int(11) NOT NULL DEFAULT 1,
  `acuerdo_cliente_id` int(11) NOT NULL DEFAULT 1,
  `cajacerrada_cliente_id` int(11) NOT NULL DEFAULT 1,
  `aprobado` int(11) NOT NULL DEFAULT 1,
  `activo` int(11) NOT NULL DEFAULT 1,
  `tipo_cliente_pp_id` int(11) NOT NULL DEFAULT 1,
  `tipo_cliente_pp_limpio_id` int(11) NOT NULL DEFAULT 1,
  `interes` decimal(10,3) NOT NULL DEFAULT 1.000,
  `tipopago_id` int(11) NOT NULL DEFAULT 1,
  `caja_cerrada` int(11) NOT NULL DEFAULT 1,
  `iva` decimal(8,2) NOT NULL DEFAULT 0.00,
  `is_iva` tinyint(1) NOT NULL DEFAULT 0,
  `forma_pedido_id` int(11) NOT NULL DEFAULT 1,
  `tipo_negocio_id` int(11) NOT NULL DEFAULT 1,
  `zona_despacho_id` int(11) NOT NULL DEFAULT 1,
  `usuario_id` int(11) NOT NULL DEFAULT 1,
  `preventista_id` int(11) NOT NULL DEFAULT 1,
  `horario_preferencia` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `horario_pedido` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chofer_id` int(11) NOT NULL DEFAULT 1,
  `tipo_pt` int(11) NOT NULL DEFAULT 1,
  `tipo_trans` int(11) NOT NULL DEFAULT 1,
  `distribuidor_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `documento_id`, `doc`, `estado`, `created_at`, `updated_at`, `tipocliente_id`, `telefono`, `direccion`, `correo`, `limite_crediticio`, `creditos_activos`, `dias_horas`, `latitud`, `longitud`, `cinta_cliente_id`, `dinero_cuenta`, `deuda_heredada`, `tipo_caja_cerrada`, `tipo_cliente_pp`, `tipo_pollo_limpia`, `acuerdo`, `acuerdo_cliente_id`, `cajacerrada_cliente_id`, `aprobado`, `activo`, `tipo_cliente_pp_id`, `tipo_cliente_pp_limpio_id`, `interes`, `tipopago_id`, `caja_cerrada`, `iva`, `is_iva`, `forma_pedido_id`, `tipo_negocio_id`, `zona_despacho_id`, `usuario_id`, `preventista_id`, `horario_preferencia`, `horario_pedido`, `chofer_id`, `tipo_pt`, `tipo_trans`, `distribuidor_id`) VALUES
(1, 'Cliente numero 1', 1, '1', 1, '2025-05-09 17:44:54', '2025-07-30 14:05:50', 1, '12', NULL, 'cliente@gmail.com', '1000.000', 3, '1', '-16.522160799931', '-68.249902078113', 3, '0.000', '0.000', 8, 1, 5, 1, 3, 1, 1, 1, 1, 1, '0.000', 1, 2, '0.00', 0, 1, 1, 1, 1, 1, '1', '1', 1, 1, 1, 1),
(2, 'CLIENTE NRO 2', 1, '88888888', 1, '2025-06-10 14:06:18', '2025-08-05 22:09:47', 1, '666666666', NULL, 'CLIENTE123@GMAIL.COM', '1500.000', 2, '7', '-16.512626233469', '-68.207694300001', 2, '0.000', '0.000', 9, 1, 8, 1, 2, 1, 1, 1, 1, 1, '0.000', 1, 1, '0.00', 0, 1, 1, 1, 1, 2, '18:00', '18:00', 1, 8, 9, 1),
(3, 'CLIENTE NRO 3', 1, '99999999', 1, '2025-06-10 14:07:22', '2025-08-11 21:55:05', 1, '88888888', NULL, 'CLIENTE.GMAIL.COM', '20000.000', 50, '10', '-16.533691525618', '-68.198248103076', 1, '0.000', '0.000', 8, 1, 0, 1, 2, 1, 1, 1, 1, 1, '0.000', 1, 1, '0.00', 0, 1, 1, 1, 1, 1, '18:00', '18:00', 1, 1, 1, 1),
(4, 'nuevo', 1, '456789', 1, '2025-08-01 14:19:48', '2025-08-08 21:12:53', 1, '789786', NULL, 'dani123@gmailc.p', '567.000', 6, '10', '-16.53661700746', '-68.172569274902', 1, '0.000', '0.000', 9, 1, 7, 1, 0, 1, 1, 1, 1, 1, '0.000', 1, 1, '0.00', 0, 1, 1, 1, 1, 2, '18:00', '18:00', 1, 10, 10, 1),
(5, 'cliente sin acuerdo', 1, 'cliente sin acuerdo', 1, '2025-08-05 20:42:49', '2025-08-05 20:42:49', 1, 'cliente sin acuerdo', NULL, 'cliente sin acuerdo', '0.000', 0, '12', '-16.51601748407', '-68.20424079895', 0, '0.000', '0.000', 0, 0, 0, 1, 0, 1, 0, 1, 1, 1, '0.000', 1, 0, '0.00', 0, 1, 1, 1, 1, 1, '12:19', '12:19', 1, 0, 0, 1),
(6, 'cliente acuer', 1, '2321332', 1, '2025-08-05 20:43:47', '2025-08-05 20:43:47', 1, '32132131', NULL, 'asd@gmail.com', '0.000', 0, '10', '-16.515605072602', '-68.260341882706', 0, '0.000', '0.000', 0, 0, 0, 1, 0, 1, 0, 1, 1, 1, '0.000', 1, 0, '0.00', 0, 1, 1, 1, 1, 1, '12:11', '12:11', 1, 0, 0, 1),
(7, 'hola', 1, '3321321', 1, '2025-08-05 20:46:26', '2025-08-05 20:46:26', 1, '33213213', NULL, 'qwe@gmail.com', '0.000', 0, '10', '-16.513055045126', '-68.209733963013', 0, '0.000', '0.000', 0, 0, 0, 1, 0, 1, 0, 1, 1, 1, '0.000', 1, 0, '0.00', 0, 1, 1, 1, 1, 1, '13:23', '13:23', 1, 0, 0, 1),
(8, 'hola', 1, 'hola', 1, '2025-08-05 20:49:59', '2025-08-05 20:49:59', 1, 'hola', NULL, 'hola', '0.000', 0, '21', '-16.51585290532', '-68.198575973511', 3, '0.000', '0.000', 5, 0, 7, 1, 3, 1, 0, 1, 1, 1, '0.000', 1, 1, '0.00', 0, 1, 1, 1, 1, 1, '12:22', '12:22', 1, 7, 8, 1),
(9, 'kk', 1, 'kk', 0, '2025-08-05 20:54:10', '2025-08-05 21:08:46', 1, 'kk', NULL, 'kk', '20000.000', 10, 'kk', '-16.521118712915', '-68.18262510803', 0, '10.000', '1010.000', 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, '1.000', 1, 0, '0.00', 0, 1, 1, 1, 1, 1, 'kk', 'kk', 1, 0, 0, 1),
(10, 'CLIENTE DESDE EXCEL 1', 3, '788278', 1, '2025-08-05 22:47:17', '2025-08-05 22:47:17', 1, '787858', 'AVENIDA', '123@GMAILC.OM', '5000.000', 4, '10', '-5515111', '75664654646', 1, '0.000', '0.000', 1, 1, 1, 1, 1, 1, 0, 0, 1, 1, '0.000', 1, 0, '0.00', 0, 1, 1, 1, 1, 1, NULL, NULL, 1, 1, 1, 1),
(11, 'CLIENTE DESDE EXCEL 2', 3, '878272782', 0, '2025-08-05 22:47:17', '2025-08-05 22:47:17', 1, '28227878', 'AVENIDA', '123@GMAILC.OM', '36300.000', 5, '10', '-5515111', '543432432432', 1, '0.000', '0.000', 1, 1, 1, 1, 1, 1, 0, 0, 1, 1, '0.000', 1, 0, '0.00', 0, 1, 1, 1, 1, 1, NULL, NULL, 1, 1, 1, 1),
(12, 'CLIENTE DESDE EXCEL 4', 3, '545454353', 1, '2025-08-05 22:50:12', '2025-08-05 22:50:39', 1, '787858', 'AVENIDA', '123@GMAILC.OM', '5000.000', 4, '10', '-5515111', '75664654646', 1, '0.000', '0.000', 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, '0.000', 1, 0, '0.00', 0, 1, 1, 1, 1, 1, NULL, NULL, 1, 1, 1, 1),
(13, 'CLIENTE DESDE EXCEL 5', 3, '54535435435', 1, '2025-08-05 22:50:12', '2025-08-05 22:50:33', 1, '28227878', 'AVENIDA', '123@GMAILC.OM', '36300.000', 5, '10', '-5515111', '543432432432', 1, '0.000', '0.000', 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, '0.000', 1, 0, '0.00', 0, 1, 1, 1, 1, 1, NULL, NULL, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_cajacerradas`
--

CREATE TABLE `cliente_cajacerradas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cliente_id` int(11) NOT NULL DEFAULT 1,
  `producto_precio_id` int(11) NOT NULL DEFAULT 1,
  `valor` decimal(8,2) NOT NULL DEFAULT 1.00,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cliente_cajacerradas`
--

INSERT INTO `cliente_cajacerradas` (`id`, `cliente_id`, `producto_precio_id`, `valor`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2.00', 0, '2025-05-09 17:44:54', '2025-07-12 14:41:32'),
(2, 1, 4, '4.00', 0, '2025-06-18 22:16:15', '2025-07-12 14:41:32'),
(3, 3, 2, '10.00', 1, '2025-07-11 19:33:45', '2025-07-11 19:33:45'),
(4, 3, 10, '3.00', 0, '2025-07-11 19:34:01', '2025-07-11 20:07:18'),
(5, 3, 9, '123.00', 1, '2025-07-11 20:15:01', '2025-07-11 20:15:01'),
(6, 3, 6, '23.00', 1, '2025-07-11 20:17:45', '2025-07-11 20:17:45'),
(7, 3, 10, '18.00', 1, '2025-07-11 20:22:04', '2025-07-11 20:22:04'),
(8, 1, 10, '15.90', 0, '2025-07-11 21:01:24', '2025-07-12 14:41:32'),
(9, 3, 7, '12.30', 1, '2025-07-11 22:12:54', '2025-07-11 22:12:54'),
(10, 3, 4, '6.99', 1, '2025-07-12 14:25:17', '2025-07-12 14:25:17'),
(11, 2, 2, '15.00', 0, '2025-07-12 14:33:29', '2025-08-04 21:53:13'),
(12, 2, 7, '14.60', 0, '2025-07-12 14:33:29', '2025-08-04 21:53:13'),
(13, 2, 10, '15.60', 0, '2025-07-12 14:33:29', '2025-08-04 21:53:13'),
(14, 1, 2, '10.00', 1, '2025-07-19 14:58:44', '2025-07-19 14:58:44'),
(15, 1, 9, '15.00', 0, '2025-07-29 19:05:47', '2025-07-29 19:07:17'),
(16, 4, 4, '3.50', 1, '2025-08-08 21:14:54', '2025-08-08 21:14:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_files`
--

CREATE TABLE `cliente_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file_id` int(11) NOT NULL DEFAULT 1,
  `tipoarchivo_id` int(11) NOT NULL DEFAULT 1,
  `cliente_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_pps`
--

CREATE TABLE `cliente_pps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cliente_id` int(11) NOT NULL DEFAULT 1,
  `item_id` int(11) NOT NULL DEFAULT 1,
  `valor` decimal(8,2) NOT NULL DEFAULT 1.00,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_pts`
--

CREATE TABLE `cliente_pts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cliente_id` int(11) NOT NULL DEFAULT 1,
  `item_id` int(11) NOT NULL DEFAULT 1,
  `valor` decimal(8,2) NOT NULL DEFAULT 1.00,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cogplanillas`
--

CREATE TABLE `cogplanillas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dias_base` int(11) NOT NULL DEFAULT 1,
  `atraso` int(11) NOT NULL DEFAULT 1,
  `multiplicar` int(11) NOT NULL DEFAULT 1,
  `sueldo_base` decimal(10,3) NOT NULL DEFAULT 1.000,
  `dividir_dia` int(11) NOT NULL DEFAULT 1,
  `dividir_hora` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cogplanillas`
--

INSERT INTO `cogplanillas` (`id`, `dias_base`, `atraso`, `multiplicar`, `sueldo_base`, `dividir_dia`, `dividir_hora`, `estado`, `created_at`, `updated_at`) VALUES
(1, 30, 3, 1, '2250.000', 30, 8, 1, '0000-00-00 00:00:00', '2023-02-11 00:38:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compo_externas`
--

CREATE TABLE `compo_externas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cantidad` decimal(10,3) NOT NULL DEFAULT 0.000,
  `peso` decimal(8,3) NOT NULL DEFAULT 0.000,
  `compra` decimal(10,3) NOT NULL DEFAULT 0.000,
  `venta` decimal(10,3) NOT NULL DEFAULT 0.000,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compo_externa_detalles`
--

CREATE TABLE `compo_externa_detalles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `compo_externa_id` int(11) NOT NULL DEFAULT 1,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cantidad` decimal(10,3) NOT NULL DEFAULT 0.000,
  `peso` decimal(8,3) NOT NULL DEFAULT 0.000,
  `compra` decimal(10,3) NOT NULL DEFAULT 0.000,
  `venta` decimal(10,3) NOT NULL DEFAULT 0.000,
  `principal` int(11) NOT NULL DEFAULT 0,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compo_externa_files`
--

CREATE TABLE `compo_externa_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `compo_externa_id` int(11) NOT NULL DEFAULT 1,
  `file_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compo_internas`
--

CREATE TABLE `compo_internas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cantidad` decimal(10,3) NOT NULL DEFAULT 0.000,
  `peso` decimal(8,3) NOT NULL DEFAULT 0.000,
  `compra` decimal(10,3) NOT NULL DEFAULT 0.000,
  `venta` decimal(10,3) NOT NULL DEFAULT 0.000,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compo_interna_files`
--

CREATE TABLE `compo_interna_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `compo_interna_id` int(11) NOT NULL DEFAULT 1,
  `file_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `fecha` date DEFAULT NULL,
  `hora` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chofer` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `camion` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `placa` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `e_despacho` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `e_recepcion` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sum_cant_pollos` decimal(8,3) NOT NULL DEFAULT 0.000,
  `sum_cant_envases` decimal(8,3) NOT NULL DEFAULT 0.000,
  `sum_peso_bruto` decimal(8,3) NOT NULL DEFAULT 0.000,
  `sum_peso_neto` decimal(8,3) NOT NULL DEFAULT 0.000,
  `sum_retraccion` decimal(8,3) NOT NULL DEFAULT 0.000,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nro` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proveedor_compra_id` int(11) NOT NULL DEFAULT 1,
  `fecha_llegada` date DEFAULT NULL,
  `fecha_salida` date DEFAULT NULL,
  `almacen_id` int(11) NOT NULL DEFAULT 1,
  `validar` int(11) NOT NULL DEFAULT 0,
  `nro_compra` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `obs` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fin` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras_aves`
--

CREATE TABLE `compras_aves` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `sucursal_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `fecha` date DEFAULT NULL,
  `hora` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chofer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `camion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `placa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `e_despacho` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `e_recepcion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sum_cant_pollos` decimal(8,3) NOT NULL DEFAULT 0.000,
  `sum_cant_envases` decimal(8,3) NOT NULL DEFAULT 0.000,
  `sum_peso_bruto` decimal(8,3) NOT NULL DEFAULT 0.000,
  `sum_peso_neto` decimal(8,3) NOT NULL DEFAULT 0.000,
  `sum_retraccion` decimal(8,3) NOT NULL DEFAULT 0.000,
  `sum_precio` decimal(8,2) NOT NULL DEFAULT 0.00,
  `estado` int(11) NOT NULL DEFAULT 1,
  `nro` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nro_compra` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proveedor_compra_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `fecha_llegada` date DEFAULT NULL,
  `fecha_salida` date DEFAULT NULL,
  `metodo_pago` int(11) NOT NULL DEFAULT 1,
  `almacen_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `obs` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fin` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra_ave_inventarios`
--

CREATE TABLE `compra_ave_inventarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `compra_ave_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `inventario_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `medida_producto_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `sub_medida_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `categoria_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `cant` decimal(8,3) NOT NULL DEFAULT 0.000,
  `nro` int(11) DEFAULT NULL,
  `valor` decimal(8,3) NOT NULL DEFAULT 0.000,
  `estado` int(11) NOT NULL DEFAULT 1,
  `cinta` int(11) NOT NULL DEFAULT 1,
  `sub_original_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `pigmento` int(11) NOT NULL DEFAULT 1,
  `tipo_pollo` int(11) NOT NULL DEFAULT 1,
  `editado` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_producto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra_cajas`
--

CREATE TABLE `compra_cajas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `fecha` date DEFAULT NULL,
  `caja_proveedor_id` int(11) NOT NULL DEFAULT 1,
  `almacen_id` int(11) NOT NULL DEFAULT 1,
  `tipo` int(11) NOT NULL DEFAULT 1,
  `total` decimal(10,3) NOT NULL DEFAULT 0.000,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `monto` decimal(10,3) NOT NULL DEFAULT 0.000
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra_caja_detalles`
--

CREATE TABLE `compra_caja_detalles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `caja_inventario_id` int(11) NOT NULL DEFAULT 1,
  `compra_caja_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra_inventarios`
--

CREATE TABLE `compra_inventarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `compra_id` int(11) NOT NULL DEFAULT 1,
  `inventario_id` int(11) NOT NULL DEFAULT 1,
  `medida_producto_id` int(11) NOT NULL DEFAULT 1,
  `sub_medida_id` int(11) NOT NULL DEFAULT 1,
  `categoria_id` int(11) NOT NULL DEFAULT 1,
  `cant` decimal(8,3) NOT NULL DEFAULT 0.000,
  `nro` int(11) DEFAULT NULL,
  `valor` decimal(8,3) NOT NULL DEFAULT 0.000,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cinta` int(11) NOT NULL DEFAULT 1,
  `sub_original_id` int(11) NOT NULL DEFAULT 1,
  `pigmento` int(11) NOT NULL DEFAULT 1,
  `tipo_pollo` int(11) NOT NULL DEFAULT 1,
  `editado` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_producto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprobantes`
--

CREATE TABLE `comprobantes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consolidacionavenew_pagos`
--

CREATE TABLE `consolidacionavenew_pagos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `banco_id` int(11) NOT NULL DEFAULT 1,
  `formapago_id` int(11) NOT NULL DEFAULT 1,
  `suma_total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `adelanto` decimal(10,2) NOT NULL DEFAULT 0.00,
  `fecha_limite` date DEFAULT NULL,
  `tipo` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `observaciones` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consolidacionavenew_pago_detalles`
--

CREATE TABLE `consolidacionavenew_pago_detalles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `consolidacion_pago_id` int(11) NOT NULL DEFAULT 1,
  `consolidacion_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consolidacionavenew_pago_tickets`
--

CREATE TABLE `consolidacionavenew_pago_tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `consolidacion_pago_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `monto` decimal(10,2) NOT NULL DEFAULT 0.00,
  `pendiente` decimal(10,2) NOT NULL DEFAULT 0.00,
  `deuda` decimal(10,2) NOT NULL DEFAULT 0.00,
  `banco_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `formapago_id` int(11) NOT NULL DEFAULT 1,
  `observaciones` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consolidacionave_pagos`
--

CREATE TABLE `consolidacionave_pagos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `banco_id` int(11) NOT NULL DEFAULT 1,
  `formapago_id` int(11) NOT NULL DEFAULT 1,
  `suma_total` decimal(10,2) DEFAULT NULL,
  `adelanto` decimal(10,2) DEFAULT NULL,
  `fecha_limite` date DEFAULT NULL,
  `tipo` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `observaciones` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consolidacionave_pago_detalles`
--

CREATE TABLE `consolidacionave_pago_detalles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `consolidacion_pago_id` int(11) NOT NULL DEFAULT 1,
  `consolidacion_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consolidacionave_pago_tickets`
--

CREATE TABLE `consolidacionave_pago_tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `consolidacion_pago_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `total` decimal(10,2) DEFAULT NULL,
  `monto` decimal(10,2) DEFAULT NULL,
  `pendiente` decimal(10,2) DEFAULT NULL,
  `deuda` decimal(10,2) DEFAULT NULL,
  `banco_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `formapago_id` int(11) NOT NULL DEFAULT 1,
  `observaciones` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consolidacionparams`
--

CREATE TABLE `consolidacionparams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `monto` decimal(8,3) NOT NULL DEFAULT 0.000,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consolidacions`
--

CREATE TABLE `consolidacions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecha` date DEFAULT NULL,
  `compra_id` int(11) NOT NULL DEFAULT 1,
  `consolidacionparam_id` int(11) NOT NULL DEFAULT 1,
  `peso_total` decimal(10,3) NOT NULL DEFAULT 0.000,
  `valor_total` decimal(10,3) NOT NULL DEFAULT 0.000,
  `detalle_gastos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`detalle_gastos`)),
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consolidacions_ave`
--

CREATE TABLE `consolidacions_ave` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecha` date DEFAULT NULL,
  `compra_ave_id` int(11) NOT NULL DEFAULT 1,
  `consolidacionparam_id` int(11) NOT NULL DEFAULT 1,
  `peso_total` decimal(10,3) NOT NULL DEFAULT 0.000,
  `valor_total` decimal(10,2) DEFAULT NULL,
  `detalle_gastos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`detalle_gastos`)),
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consolidacions_ave_new`
--

CREATE TABLE `consolidacions_ave_new` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `fecha` date DEFAULT NULL,
  `consolidacionparam_id` int(11) NOT NULL DEFAULT 1,
  `peso_total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `valor_total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `valor_aves_muertas` decimal(10,2) NOT NULL DEFAULT 0.00,
  `valor_por_ave_muerta` decimal(10,2) NOT NULL DEFAULT 0.00,
  `detalle_gastos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`detalle_gastos`)),
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consolidacion_ave_detalles`
--

CREATE TABLE `consolidacion_ave_detalles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `categoria_id` int(11) NOT NULL DEFAULT 1,
  `consolidacion_id` int(11) NOT NULL DEFAULT 1,
  `suma_total` decimal(10,3) NOT NULL DEFAULT 0.000,
  `criterio` decimal(10,3) NOT NULL DEFAULT 0.000,
  `precio` decimal(10,2) DEFAULT NULL,
  `nuevoajuste` decimal(10,3) NOT NULL DEFAULT 0.000,
  `ajuste` decimal(10,3) NOT NULL DEFAULT 0.000,
  `nuevo_peso` decimal(10,3) NOT NULL DEFAULT 0.000,
  `nuevo_peso_2` decimal(10,3) NOT NULL DEFAULT 0.000,
  `oficial` decimal(10,3) NOT NULL DEFAULT 0.000,
  `precio_compra` decimal(10,2) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `compra_ave_id` int(11) NOT NULL DEFAULT 1,
  `lp` decimal(10,3) NOT NULL DEFAULT 0.000,
  `pollos` int(11) NOT NULL DEFAULT 0,
  `kg_total` decimal(10,3) NOT NULL DEFAULT 0.000,
  `kg_criterio` decimal(10,3) NOT NULL DEFAULT 0.000,
  `kg_criterio_total` decimal(10,3) NOT NULL DEFAULT 0.000,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consolidacion_ave_new_detalles`
--

CREATE TABLE `consolidacion_ave_new_detalles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nro_lote` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `observacion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `categoria_id` int(11) NOT NULL DEFAULT 1,
  `consolidacion_id` int(11) NOT NULL DEFAULT 1,
  `suma_total` decimal(10,3) NOT NULL DEFAULT 0.000,
  `criterio` decimal(10,3) NOT NULL DEFAULT 0.000,
  `precio` decimal(10,2) NOT NULL DEFAULT 0.00,
  `nuevoajuste` decimal(10,3) NOT NULL DEFAULT 0.000,
  `ajuste` decimal(10,3) NOT NULL DEFAULT 0.000,
  `nuevo_peso` decimal(10,3) NOT NULL DEFAULT 0.000,
  `nuevo_peso_2` decimal(10,3) NOT NULL DEFAULT 0.000,
  `oficial` decimal(10,3) NOT NULL DEFAULT 0.000,
  `precio_compra` decimal(10,2) NOT NULL DEFAULT 0.00,
  `estado` int(11) NOT NULL DEFAULT 1,
  `lp` decimal(10,3) NOT NULL DEFAULT 0.000,
  `pollos` int(11) NOT NULL DEFAULT 0,
  `kg_total` decimal(10,3) NOT NULL DEFAULT 0.000,
  `kg_criterio` decimal(10,3) NOT NULL DEFAULT 0.000,
  `kg_criterio_total` decimal(10,3) NOT NULL DEFAULT 0.000,
  `cantidad_jaulas` int(11) NOT NULL DEFAULT 0,
  `tara` decimal(10,3) NOT NULL DEFAULT 0.000,
  `peso_bruto` decimal(10,3) NOT NULL DEFAULT 0.000,
  `proveedor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consolidacion_detalles`
--

CREATE TABLE `consolidacion_detalles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `categoria_id` int(11) NOT NULL DEFAULT 1,
  `consolidacion_id` int(11) NOT NULL DEFAULT 1,
  `suma_total` decimal(10,3) NOT NULL DEFAULT 0.000,
  `criterio` decimal(10,3) NOT NULL DEFAULT 0.000,
  `precio` decimal(10,3) NOT NULL DEFAULT 0.000,
  `nuevoajuste` decimal(10,3) NOT NULL DEFAULT 0.000,
  `ajuste` decimal(10,3) NOT NULL DEFAULT 0.000,
  `nuevo_peso` decimal(10,3) NOT NULL DEFAULT 0.000,
  `nuevo_peso_2` decimal(10,3) NOT NULL DEFAULT 0.000,
  `oficial` decimal(10,3) NOT NULL DEFAULT 0.000,
  `precio_compra` decimal(10,3) NOT NULL DEFAULT 0.000,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `compra_id` int(11) NOT NULL DEFAULT 1,
  `lp` decimal(10,3) NOT NULL DEFAULT 0.000,
  `pollos` int(11) NOT NULL DEFAULT 0,
  `kg_total` decimal(10,3) NOT NULL DEFAULT 0.000,
  `kg_criterio` decimal(10,3) NOT NULL DEFAULT 0.000,
  `kg_criterio_total` decimal(10,3) NOT NULL DEFAULT 0.000
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consolidacion_pagos`
--

CREATE TABLE `consolidacion_pagos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `banco_id` int(11) NOT NULL DEFAULT 1,
  `formapago_id` int(11) NOT NULL DEFAULT 1,
  `suma_total` decimal(10,3) NOT NULL DEFAULT 0.000,
  `adelanto` decimal(10,3) NOT NULL DEFAULT 0.000,
  `fecha_limite` date DEFAULT NULL,
  `tipo` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `observaciones` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consolidacion_pago_detalles`
--

CREATE TABLE `consolidacion_pago_detalles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `consolidacion_pago_id` int(11) NOT NULL DEFAULT 1,
  `consolidacion_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consolidacion_pago_tickets`
--

CREATE TABLE `consolidacion_pago_tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `consolidacion_pago_id` int(11) NOT NULL DEFAULT 1,
  `total` decimal(10,3) NOT NULL DEFAULT 0.000,
  `monto` decimal(10,3) NOT NULL DEFAULT 0.000,
  `pendiente` decimal(10,3) NOT NULL DEFAULT 0.000,
  `deuda` decimal(10,3) NOT NULL DEFAULT 0.000,
  `banco_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `formapago_id` int(11) NOT NULL DEFAULT 1,
  `observaciones` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contratocostos`
--

CREATE TABLE `contratocostos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contrato_id` int(11) NOT NULL DEFAULT 1,
  `costofijo_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contratos`
--

CREATE TABLE `contratos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `terminos` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `inicio` date DEFAULT NULL,
  `fin` date DEFAULT NULL,
  `tipocontrato_id` int(11) NOT NULL DEFAULT 1,
  `persona_id` int(11) NOT NULL DEFAULT 1,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `area_id` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `sueldo` decimal(10,3) NOT NULL DEFAULT 1.000,
  `servicio` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `contratos`
--

INSERT INTO `contratos` (`id`, `terminos`, `inicio`, `fin`, `tipocontrato_id`, `persona_id`, `sucursal_id`, `area_id`, `user_id`, `sueldo`, `servicio`, `estado`, `created_at`, `updated_at`) VALUES
(1, '123', '2025-06-17', '2025-09-19', 1, 7, 1, 1, 1, '123.000', 1, 1, '2025-06-17 21:44:49', '2025-06-17 21:44:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `costofijos`
--

CREATE TABLE `costofijos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `monto` decimal(10,3) NOT NULL DEFAULT 1.000,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `costofijos`
--

INSERT INTO `costofijos` (`id`, `name`, `monto`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'AFP', '5.000', 1, '2023-02-09 16:25:51', '2023-02-09 16:25:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `costovariables`
--

CREATE TABLE `costovariables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `costovariables`
--

INSERT INTO `costovariables` (`id`, `name`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'xx', 1, '2023-02-11 00:08:28', '2023-02-11 00:08:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descomponer_pts`
--

CREATE TABLE `descomponer_pts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecha` date DEFAULT NULL,
  `pt_id` int(11) DEFAULT NULL,
  `cajas` decimal(10,3) DEFAULT NULL,
  `pollos` decimal(10,3) DEFAULT NULL,
  `peso_bruto` decimal(10,3) DEFAULT NULL,
  `peso_neto` decimal(10,3) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descomponer_transformacion_lotes`
--

CREATE TABLE `descomponer_transformacion_lotes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transformacion_lote_id` int(11) NOT NULL DEFAULT 1,
  `item_id` int(11) NOT NULL DEFAULT 1,
  `subitem_id` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `fecha_hora` datetime DEFAULT NULL,
  `peso_bruto` decimal(8,3) NOT NULL DEFAULT 0.000,
  `peso_neto` decimal(8,3) NOT NULL DEFAULT 0.000,
  `cajas` int(11) NOT NULL DEFAULT 0,
  `recep` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `despacho_arqueos`
--

CREATE TABLE `despacho_arqueos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `venta_id` int(11) NOT NULL DEFAULT 1,
  `arqueo_id` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `forma_pago_id` int(11) NOT NULL DEFAULT 1,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `monto` decimal(10,2) NOT NULL DEFAULT 0.00,
  `paga_con` decimal(10,2) NOT NULL DEFAULT 0.00,
  `cambio` decimal(10,2) NOT NULL DEFAULT 0.00,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `desplegue_pps`
--

CREATE TABLE `desplegue_pps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `pp_id` int(11) NOT NULL DEFAULT 0,
  `cinta_cliente_id` int(11) NOT NULL DEFAULT 0,
  `cajas` int(8) NOT NULL DEFAULT 0,
  `pollos` int(11) NOT NULL DEFAULT 0,
  `peso_bruto` decimal(10,3) NOT NULL DEFAULT 0.000,
  `peso_neto` decimal(10,3) NOT NULL DEFAULT 0.000,
  `merma_bruta` decimal(10,3) NOT NULL DEFAULT 0.000,
  `merma_neta` decimal(10,3) NOT NULL DEFAULT 0.000,
  `tipo` int(11) NOT NULL DEFAULT 1,
  `aceptado` int(11) NOT NULL DEFAULT 0,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pigmento` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pps`
--

CREATE TABLE `detalle_pps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pp_id` int(11) NOT NULL DEFAULT 1,
  `lote_id` int(11) NOT NULL DEFAULT 1,
  `lote_detalle_id` int(11) NOT NULL DEFAULT 1,
  `lote_detalle_movimiento_id` int(11) NOT NULL DEFAULT 1,
  `cajas` int(10) NOT NULL DEFAULT 0,
  `pollos` int(10) NOT NULL DEFAULT 0,
  `peso_total` decimal(10,3) NOT NULL DEFAULT 0.000,
  `peso_neto` decimal(10,3) NOT NULL DEFAULT 0.000,
  `peso_bruto` decimal(10,3) NOT NULL DEFAULT 0.000,
  `merma_bruta` decimal(10,3) NOT NULL DEFAULT 0.000,
  `merma_neta` decimal(10,3) NOT NULL DEFAULT 0.000,
  `fecha` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descomponer` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `back` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `peso_inicial_tipo` int(11) NOT NULL DEFAULT 1,
  `hora` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pp_descomposicions`
--

CREATE TABLE `detalle_pp_descomposicions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_venta` decimal(10,3) NOT NULL,
  `peso_total` decimal(10,3) NOT NULL,
  `detalle_pp_id` int(11) NOT NULL DEFAULT 1,
  `pp_id` int(11) NOT NULL DEFAULT 1,
  `compo_interna_id` int(11) NOT NULL DEFAULT 1,
  `trozado` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pts`
--

CREATE TABLE `detalle_pts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pt_id` int(11) NOT NULL DEFAULT 1,
  `lote_id` int(11) NOT NULL DEFAULT 1,
  `lote_detalle_id` int(11) NOT NULL DEFAULT 1,
  `lote_detalle_movimiento_id` int(11) NOT NULL DEFAULT 1,
  `cajas` int(10) NOT NULL DEFAULT 0,
  `pollos` int(10) NOT NULL DEFAULT 0,
  `peso_total` decimal(10,3) NOT NULL DEFAULT 0.000,
  `peso_neto` decimal(10,3) NOT NULL DEFAULT 0.000,
  `peso_bruto` decimal(10,3) NOT NULL DEFAULT 0.000,
  `merma_bruta` decimal(10,3) NOT NULL DEFAULT 0.000,
  `merma_neta` decimal(10,3) NOT NULL DEFAULT 0.000,
  `fecha` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descomponer` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `back` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `peso_inicial_tipo` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pt_descomposicions`
--

CREATE TABLE `detalle_pt_descomposicions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_venta` decimal(10,3) NOT NULL,
  `peso_total` decimal(10,3) NOT NULL,
  `detalle_pt_id` int(11) NOT NULL DEFAULT 1,
  `pt_id` int(11) NOT NULL DEFAULT 1,
  `compo_externa_id` int(11) NOT NULL DEFAULT 1,
  `trozado` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `devosalidotacontras`
--

CREATE TABLE `devosalidotacontras` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `salidadotacioncontrato_id` int(11) NOT NULL DEFAULT 1,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `fecha` date DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentacions`
--

CREATE TABLE `documentacions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

CREATE TABLE `documentos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `documentos`
--

INSERT INTO `documentos` (`id`, `name`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'NIT', 1, '2023-02-09 16:25:27', '2023-02-09 16:25:27'),
(2, 'DNI', 1, '2024-01-05 17:11:41', '2024-01-05 17:11:41'),
(3, 'C.I.', 1, '2024-06-20 10:14:40', '2024-06-20 10:14:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dotacions`
--

CREATE TABLE `dotacions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `familia_id` int(11) NOT NULL DEFAULT 1,
  `codigo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `costo` decimal(10,3) NOT NULL DEFAULT 1.000,
  `venta` decimal(10,3) NOT NULL DEFAULT 1.000,
  `stock` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrega_cajas`
--

CREATE TABLE `entrega_cajas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cliente_id` int(11) NOT NULL DEFAULT 1,
  `venta_id` int(11) NOT NULL DEFAULT 1,
  `chofer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `saldo_anterior` int(11) NOT NULL DEFAULT 0,
  `cajas` int(11) NOT NULL DEFAULT 0,
  `saldo_actual` int(11) NOT NULL DEFAULT 0,
  `fecha` date DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cajas_first_printed_at` timestamp NULL DEFAULT NULL,
  `cajas_print_count` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `cajas_chofer_first_printed_at` timestamp NULL DEFAULT NULL,
  `cajas_chofer_print_count` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrega_cajas_recuperadas`
--

CREATE TABLE `entrega_cajas_recuperadas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cliente_id` int(11) NOT NULL DEFAULT 1,
  `chofer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `cajas` int(11) NOT NULL DEFAULT 0,
  `fecha` date DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `entrega_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enviar_item_pt_transformacions`
--

CREATE TABLE `enviar_item_pt_transformacions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pt_id` int(11) NOT NULL DEFAULT 1,
  `item_id` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `fecha_hora` datetime DEFAULT NULL,
  `peso_bruto` decimal(8,3) NOT NULL DEFAULT 0.000,
  `peso_neto` decimal(8,3) NOT NULL DEFAULT 0.000,
  `cajas` int(11) NOT NULL DEFAULT 0,
  `is_aceptado` int(11) NOT NULL DEFAULT 0,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envio_gen_pps`
--

CREATE TABLE `envio_gen_pps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `pp_id` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envio_gen_pp_detalles`
--

CREATE TABLE `envio_gen_pp_detalles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `envio_gen_pp_id` int(11) NOT NULL DEFAULT 1,
  `detalle_pp_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envio_gen_pts`
--

CREATE TABLE `envio_gen_pts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `pt_id` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envio_gen_pt_detalles`
--

CREATE TABLE `envio_gen_pt_detalles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `envio_gen_pt_id` int(11) NOT NULL DEFAULT 1,
  `detalle_pt_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_compra_chofers`
--

CREATE TABLE `estado_compra_chofers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `estado_compra_chofers`
--

INSERT INTO `estado_compra_chofers` (`id`, `name`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'SEMINUEVO', 1, '2024-01-12 16:13:07', '2024-01-12 16:14:17'),
(2, 'NUEVO', 1, '2024-01-12 16:13:11', '2024-01-12 16:13:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `familias`
--

CREATE TABLE `familias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `filemonedas`
--

CREATE TABLE `filemonedas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file_id` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `tipoarchivo_id` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `moneda_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `filemonedas`
--

INSERT INTO `filemonedas` (`id`, `file_id`, `tipoarchivo_id`, `moneda_id`, `estado`, `created_at`, `updated_at`) VALUES
(1, 14, 1, 3, 0, '2025-05-27 20:00:42', '2025-05-27 20:01:06'),
(2, 15, 1, 3, 0, '2025-05-27 20:01:07', '2025-05-27 20:07:21'),
(3, 16, 1, 4, 1, '2025-05-27 20:01:16', '2025-05-27 20:01:16'),
(4, 17, 1, 5, 1, '2025-05-27 20:01:33', '2025-05-27 20:01:33'),
(5, 18, 1, 7, 1, '2025-05-27 20:01:42', '2025-05-27 20:01:42'),
(6, 19, 1, 8, 1, '2025-05-27 20:01:52', '2025-05-27 20:01:52'),
(7, 20, 1, 9, 1, '2025-05-27 20:01:59', '2025-05-27 20:01:59'),
(8, 21, 1, 10, 1, '2025-05-27 20:03:01', '2025-05-27 20:03:01'),
(9, 22, 1, 11, 1, '2025-05-27 20:03:18', '2025-05-27 20:03:18'),
(10, 23, 1, 12, 1, '2025-05-27 20:03:28', '2025-05-27 20:03:28'),
(11, 24, 1, 13, 1, '2025-05-27 20:03:36', '2025-05-27 20:03:36'),
(12, 25, 1, 14, 1, '2025-05-27 20:03:44', '2025-05-27 20:03:44'),
(13, 26, 1, 3, 1, '2025-05-27 20:07:23', '2025-05-27 20:07:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `filepersonas`
--

CREATE TABLE `filepersonas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file_id` int(11) NOT NULL DEFAULT 1,
  `tipoarchivo_id` int(11) NOT NULL DEFAULT 1,
  `persona_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `filepersonas`
--

INSERT INTO `filepersonas` (`id`, `file_id`, `tipoarchivo_id`, `persona_id`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, 1, '2023-02-10 20:25:23', '2023-02-10 20:25:23'),
(2, 2, 1, 2, 1, '2023-02-10 20:32:32', '2023-02-10 20:32:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `files`
--

CREATE TABLE `files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `path` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `files`
--

INSERT INTO `files` (`id`, `path`, `estado`, `created_at`, `updated_at`) VALUES
(1, '/storage/personas/hPN9knWXyodY78aYIzSZ2UtqFCQ0DyWGam90FxAm.jpg', 1, '2023-02-10 20:25:23', '2023-02-10 20:25:23'),
(2, '/storage/personas/7Dw06DDOzyQNdA6nZmtAHTKfGtyZkLev84Pq6Vj0.txt', 1, '2023-02-10 20:32:32', '2023-02-10 20:32:32'),
(3, '/storage/sucursals/M1T3sguZKFxi9KxwiRgzR4QQZmlScF1dS5SuOt3N.jpg', 1, '2023-02-10 20:49:37', '2023-02-10 20:49:37'),
(4, '/storage/sucursals/AUkKR4lul7qM2souHS22JN0Ajy6HZYzS7spmdiuB.webp', 1, '2023-02-10 20:49:48', '2023-02-10 20:49:48'),
(5, '/storage/clientes/JMFHj1WLCNC3GUM7rWABDdLQCpshEAY3V7GYWUS5.pdf', 1, '2023-04-10 00:40:04', '2023-04-10 00:40:04'),
(6, '/storage/clientes/WbPtjLuayYZvpZQgtKtUBjmSKb0FFPFboC1F7GnM.pdf', 1, '2023-04-10 00:40:11', '2023-04-10 00:40:11'),
(7, '/storage/clientes/E2lVYBAxmqeEwcyB2VKeH8wNNnoiBiIS1qWI2uWO.pdf', 1, '2023-04-10 00:40:32', '2023-04-10 00:40:32'),
(8, '/storage/clientes/bdvARx28yb35kxVYQyIvkZD6nKRP3ub9oDRlITo0.jpg', 1, '2023-04-10 00:44:06', '2023-04-10 00:44:06'),
(9, '/storage/sucursals/XFm5u8BdO1YB4ePTKOFaChoWUONC2leKYK31kCnX.png', 1, '2023-05-23 11:28:35', '2023-05-23 11:28:35'),
(10, '/storage/composicion/YKNdjPhtN3eh5G2YtfFNCNuhxH6VjXcDpVxyHR0c.png', 1, '2023-05-23 11:29:54', '2023-05-23 11:29:54'),
(11, '/storage/composicion/2dYzmrXVyMpJXw6gsArNDe7amvM0Co8Qi0xfFYuZ.png', 1, '2023-05-23 11:43:52', '2023-05-23 11:43:52'),
(12, '/storage/items/6caCt6fGmq666DejVWQznHMTfWTFf6ptG5N4D9k9.webp', 1, '2023-06-09 12:09:40', '2023-06-09 12:09:40'),
(13, '/storage/sucursals/7dyQ7bFcsFEKyJfhPYmpDCEivR3wKmGVzJ5OK6NX.png', 1, '2023-06-13 14:57:14', '2023-06-13 14:57:14'),
(14, '/storage/monedas/Ev10wsvHMcN9u7s9FurWcjGoDBwNeagoA88AmT4s.jpg', 1, '2025-05-27 20:00:42', '2025-05-27 20:00:42'),
(15, '/storage/monedas/esqmJ2SbaCfAwIsBLj4YpOLm164GlAXqWyq6Qc7T.jpg', 1, '2025-05-27 20:01:07', '2025-05-27 20:01:07'),
(16, '/storage/monedas/BkuN8yqnzdqrG47aBVOITFhCdUqIvTyWNZmL8HqE.jpg', 1, '2025-05-27 20:01:16', '2025-05-27 20:01:16'),
(17, '/storage/monedas/bjwZG4dGSpcnus3BCGTchhU5lDl2d3WIfNEsshRz.jpg', 1, '2025-05-27 20:01:33', '2025-05-27 20:01:33'),
(18, '/storage/monedas/irjRgru4zkAgbuFANv6EL3vqzKJUfXDIioKSExqp.jpg', 1, '2025-05-27 20:01:42', '2025-05-27 20:01:42'),
(19, '/storage/monedas/BSIjNv8U4s4sRqn6IWY5tNvBfWrPBomHpFajalOd.jpg', 1, '2025-05-27 20:01:52', '2025-05-27 20:01:52'),
(20, '/storage/monedas/9CMi8k46AkuqvHlT16OMmOdWkxRByUYEaZku0pso.jpg', 1, '2025-05-27 20:01:59', '2025-05-27 20:01:59'),
(21, '/storage/monedas/Ok4f52VgAFsUrxt9yhZGrNEzEQ8OXr1HtXgWNuEt.jpg', 1, '2025-05-27 20:03:01', '2025-05-27 20:03:01'),
(22, '/storage/monedas/w3mg15EM4GkLsCLawzvsguHkm2Wi6pFpArD3Y6No.jpg', 1, '2025-05-27 20:03:18', '2025-05-27 20:03:18'),
(23, '/storage/monedas/v4yjBYQ4zZwjvHSyTSQMkQ634DM6cWlusdbSwpsI.jpg', 1, '2025-05-27 20:03:28', '2025-05-27 20:03:28'),
(24, '/storage/monedas/E4uXYYbOSchiruXEzNPaIjOtp8aKLlUUwjLJeen7.jpg', 1, '2025-05-27 20:03:36', '2025-05-27 20:03:36'),
(25, '/storage/monedas/SlwCGx4sdYX1xJTTf9nebZQBAAyPd8FdijRCHBdj.jpg', 1, '2025-05-27 20:03:44', '2025-05-27 20:03:44'),
(26, '/storage/monedas/krgO0yZPc5BD136dKLBn1BkGGyJgBdAmdhorgIme.jpg', 1, '2025-05-27 20:07:23', '2025-05-27 20:07:23'),
(27, '/storage/sucursals/foCtp0B7DRqwShcJxuwnrWNMB3nmMmrazAT4t3Gz.png', 1, '2025-05-27 20:10:13', '2025-05-27 20:10:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `filesucursals`
--

CREATE TABLE `filesucursals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file_id` int(11) NOT NULL DEFAULT 1,
  `tipoarchivo_id` int(11) NOT NULL DEFAULT 1,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `filesucursals`
--

INSERT INTO `filesucursals` (`id`, `file_id`, `tipoarchivo_id`, `sucursal_id`, `estado`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 1, 0, '2023-02-10 20:49:37', '2023-06-13 14:57:04'),
(2, 4, 1, 1, 0, '2023-02-10 20:49:48', '2023-02-10 20:49:52'),
(3, 13, 1, 1, 0, '2023-06-13 14:57:14', '2025-06-10 21:21:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `finiaguinaldodetalles`
--

CREATE TABLE `finiaguinaldodetalles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `finiaguinaldo_id` int(11) NOT NULL DEFAULT 1,
  `planilla_id` int(11) NOT NULL DEFAULT 1,
  `pago` decimal(10,3) NOT NULL DEFAULT 1.000,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `finiaguinaldos`
--

CREATE TABLE `finiaguinaldos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecha` date DEFAULT NULL,
  `contrato_id` int(11) NOT NULL DEFAULT 1,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `pago` decimal(10,3) NOT NULL DEFAULT 1.000,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `finianualdetalles`
--

CREATE TABLE `finianualdetalles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `finiquitoanual_id` int(11) NOT NULL DEFAULT 1,
  `planilla_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `finiquinqueniodetalles`
--

CREATE TABLE `finiquinqueniodetalles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `finiquinquenio_id` int(11) NOT NULL DEFAULT 1,
  `planilla_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `finiquinquenios`
--

CREATE TABLE `finiquinquenios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecha` date DEFAULT NULL,
  `contrato_id` int(11) NOT NULL DEFAULT 1,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `pago` decimal(10,3) NOT NULL DEFAULT 1.000,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `finiquitoanuals`
--

CREATE TABLE `finiquitoanuals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecha` date DEFAULT NULL,
  `contrato_id` int(11) NOT NULL DEFAULT 1,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `pago` decimal(10,3) NOT NULL DEFAULT 1.000,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `finivacacionaldetalles`
--

CREATE TABLE `finivacacionaldetalles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `finivacacional_id` int(11) NOT NULL DEFAULT 1,
  `planilla_id` int(11) NOT NULL DEFAULT 1,
  `pago` decimal(10,3) NOT NULL DEFAULT 1.000,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `finivacacionalplanillas`
--

CREATE TABLE `finivacacionalplanillas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `finivacacional_id` int(11) NOT NULL DEFAULT 1,
  `planilla_id` int(11) NOT NULL DEFAULT 1,
  `pago` decimal(10,3) NOT NULL DEFAULT 1.000,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `finivacacionals`
--

CREATE TABLE `finivacacionals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `contrato_id` int(11) NOT NULL DEFAULT 1,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `pago` decimal(10,3) NOT NULL DEFAULT 1.000,
  `planilla` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formapagos`
--

CREATE TABLE `formapagos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `formapagos`
--

INSERT INTO `formapagos` (`id`, `name`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Efectivo', 1, '2023-02-10 20:58:31', '2023-02-10 20:58:31'),
(2, 'Deposito bancario', 1, '2023-11-14 03:50:20', '2023-11-14 03:50:20'),
(3, 'QR', 1, '2024-02-02 14:49:56', '2024-02-02 14:49:56'),
(4, 'TRANSFERENCIA', 1, '2024-02-02 14:50:08', '2024-02-02 14:50:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `forma_pedidos`
--

CREATE TABLE `forma_pedidos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `forma_pedidos`
--

INSERT INTO `forma_pedidos` (`id`, `name`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'LLAMADA', 1, '2024-11-13 11:23:07', '2024-11-13 11:23:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos_extras_aves`
--

CREATE TABLE `gastos_extras_aves` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `consolidacion_id` bigint(20) UNSIGNED NOT NULL,
  `detalle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informe_detalles`
--

CREATE TABLE `informe_detalles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `informe_preliminar_id` int(11) NOT NULL DEFAULT 1,
  `compo_externa_id` int(11) NOT NULL DEFAULT 1,
  `cupo` decimal(10,3) NOT NULL DEFAULT 0.000,
  `cupo_dia` decimal(10,3) NOT NULL DEFAULT 0.000,
  `cupo_fit` decimal(10,3) NOT NULL DEFAULT 0.000,
  `peso` decimal(10,3) NOT NULL DEFAULT 0.000,
  `total_cupo_fit` decimal(10,3) NOT NULL DEFAULT 0.000,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informe_preliminars`
--

CREATE TABLE `informe_preliminars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `dia` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `observacion` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `cant` decimal(10,3) NOT NULL DEFAULT 0.000,
  `cajas` decimal(10,3) NOT NULL DEFAULT 0.000,
  `pollos` int(11) NOT NULL DEFAULT 0,
  `kg` decimal(10,3) NOT NULL DEFAULT 0.000,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventarios`
--

CREATE TABLE `inventarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `producto_id` int(11) NOT NULL DEFAULT 1,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `almacen_id` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `lote_id` int(11) NOT NULL DEFAULT 1,
  `motivo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `medida_producto_id` int(11) NOT NULL DEFAULT 1,
  `sub_medida_id` int(11) NOT NULL DEFAULT 1,
  `cant` decimal(8,3) NOT NULL DEFAULT 0.000,
  `nro` decimal(8,3) NOT NULL DEFAULT 0.000,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `compra` decimal(10,3) DEFAULT NULL,
  `venta` decimal(10,3) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tipo` int(11) NOT NULL DEFAULT 1,
  `precio_1` int(11) NOT NULL DEFAULT 0,
  `precio_2` int(11) NOT NULL DEFAULT 0,
  `precio_3` int(11) NOT NULL DEFAULT 0,
  `merma` decimal(8,4) NOT NULL DEFAULT 0.0000
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `items`
--

INSERT INTO `items` (`id`, `name`, `compra`, `venta`, `estado`, `created_at`, `updated_at`, `tipo`, `precio_1`, `precio_2`, `precio_3`, `merma`) VALUES
(1, 'PIERNA', '1.000', '1.000', 1, '2025-08-13 14:28:20', '2025-08-13 14:28:20', 2, 0, 0, 0, '1.0000'),
(2, 'PECHUGA', '1.000', '1.000', 1, '2025-08-13 14:28:30', '2025-08-13 14:28:30', 2, 0, 0, 0, '1.0000'),
(3, 'ALA', '1.000', '1.000', 1, '2025-08-13 14:28:37', '2025-08-13 14:28:37', 2, 0, 0, 0, '1.0000'),
(4, 'CAZUELA', '1.000', '1.000', 1, '2025-08-13 14:28:47', '2025-08-13 14:28:47', 2, 0, 0, 0, '1.0000'),
(5, 'MENUDO', '1.000', '1.000', 1, '2025-08-13 14:28:57', '2025-08-13 14:28:57', 2, 0, 0, 0, '1.0000'),
(6, 'CUELLO', '1.000', '1.000', 1, '2025-08-13 14:29:07', '2025-08-13 14:29:07', 2, 0, 0, 0, '1.0000'),
(7, 'HIGADO', '1.000', '1.000', 1, '2025-08-13 14:29:17', '2025-08-13 14:29:17', 2, 0, 0, 0, '1.0000'),
(8, 'MALTRATO', '1.000', '1.000', 1, '2025-08-13 14:29:26', '2025-08-13 14:29:26', 2, 0, 0, 0, '1.0000'),
(9, 'FILETE', '1.000', '1.000', 1, '2025-08-13 14:29:48', '2025-08-13 14:29:48', 3, 0, 0, 0, '1.0000'),
(10, 'COSTILLA', '1.000', '1.000', 1, '2025-08-13 14:30:02', '2025-08-13 14:30:15', 3, 0, 0, 0, '1.0000'),
(11, 'CUERO', '1.000', '1.000', 1, '2025-08-13 14:30:24', '2025-08-13 14:30:24', 3, 0, 0, 0, '1.0000'),
(12, 'FILETE CON PIEL', '1.000', '1.000', 1, '2025-08-13 14:30:38', '2025-08-13 14:30:38', 3, 0, 0, 0, '1.0000'),
(13, 'FILETE DE P/', '1.000', '1.000', 1, '2025-08-13 14:30:57', '2025-08-13 14:30:57', 3, 0, 0, 0, '1.0000'),
(14, 'HUESO DE P/', '1.000', '1.000', 1, '2025-08-13 14:31:13', '2025-08-13 14:31:13', 3, 0, 0, 0, '1.0000'),
(15, 'PIERNA SOLA', '1.000', '1.000', 1, '2025-08-13 14:31:24', '2025-08-13 14:31:24', 3, 0, 0, 0, '1.0000'),
(16, 'MUSLO', '1.000', '1.000', 1, '2025-08-13 14:31:36', '2025-08-13 14:31:36', 3, 0, 0, 0, '1.0000'),
(17, 'MUSLO ALA', '1.000', '1.000', 1, '2025-08-13 14:31:46', '2025-08-13 14:31:46', 3, 0, 0, 0, '1.0000'),
(18, 'CONTRA MUSLO', '1.000', '1.000', 1, '2025-08-13 14:32:00', '2025-08-13 14:32:00', 3, 0, 0, 0, '1.0000'),
(19, 'PUNTA ALA', '1.000', '1.000', 1, '2025-08-13 14:32:09', '2025-08-13 14:32:09', 3, 0, 0, 0, '1.0000'),
(20, 'CUELLO PP', '1.000', '1.000', 1, '2025-08-14 20:19:42', '2025-08-14 20:19:42', 1, 0, 0, 0, '1.0000'),
(21, 'MENUDO PP', '1.000', '1.000', 1, '2025-08-14 20:19:52', '2025-08-14 20:19:52', 1, 0, 0, 0, '1.0000'),
(22, 'HIGADO PP', '1.000', '1.000', 1, '2025-08-14 20:20:01', '2025-08-14 20:20:01', 1, 0, 0, 0, '1.0000'),
(23, 'GRASA PP', '1.000', '1.000', 1, '2025-08-14 20:20:12', '2025-08-14 20:20:12', 1, 0, 0, 0, '1.0000'),
(24, 'PULMON PP', '1.000', '1.000', 1, '2025-08-14 20:20:25', '2025-08-14 20:20:25', 1, 0, 0, 0, '1.0000'),
(25, 'CUERO PP', '1.000', '1.000', 1, '2025-08-14 20:20:34', '2025-08-14 20:20:34', 1, 0, 0, 0, '1.0000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items_pts`
--

CREATE TABLE `items_pts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecha` date DEFAULT NULL,
  `pt_id` int(11) DEFAULT NULL,
  `descomponer_pt_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `cajas` decimal(10,3) DEFAULT NULL,
  `taras` decimal(10,3) DEFAULT NULL,
  `peso_bruto` decimal(10,3) DEFAULT NULL,
  `peso_neto` decimal(10,3) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `recep` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `item_files`
--

CREATE TABLE `item_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `file_id` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `item_pollos`
--

CREATE TABLE `item_pollos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pollo_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `precio` decimal(10,3) NOT NULL DEFAULT 0.000,
  `precio_cbba` decimal(10,3) NOT NULL DEFAULT 0.000,
  `precio_lpz` decimal(10,3) NOT NULL DEFAULT 0.000,
  `precio_alternativo_1` decimal(10,2) NOT NULL DEFAULT 0.00,
  `precio_alternativo_2` decimal(10,2) NOT NULL DEFAULT 0.00,
  `precio_alternativo_3` decimal(10,2) NOT NULL DEFAULT 0.00,
  `precio_alternativo_4` decimal(10,2) NOT NULL DEFAULT 0.00,
  `estado_precio_alternativo_1` tinyint(1) NOT NULL DEFAULT 0,
  `estado_precio_alternativo_2` tinyint(1) NOT NULL DEFAULT 0,
  `estado_precio_alternativo_3` tinyint(1) NOT NULL DEFAULT 0,
  `estado_precio_alternativo_4` tinyint(1) NOT NULL DEFAULT 0,
  `estado_precio_alternativo_5` tinyint(1) NOT NULL DEFAULT 0,
  `precio_alternativo_5` decimal(10,2) NOT NULL DEFAULT 0.00,
  `peso` decimal(10,3) NOT NULL DEFAULT 0.000,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `descuento_1` decimal(8,3) NOT NULL DEFAULT 0.000,
  `descuento_2` decimal(8,3) NOT NULL DEFAULT 0.000,
  `descuento_3` decimal(8,3) NOT NULL DEFAULT 0.000,
  `descuento_4` decimal(8,3) NOT NULL DEFAULT 0.000,
  `descuento_alternativo_1` decimal(8,2) NOT NULL DEFAULT 0.00,
  `descuento_alternativo_2` decimal(8,2) NOT NULL DEFAULT 0.00,
  `descuento_alternativo_3` decimal(8,2) NOT NULL DEFAULT 0.00,
  `descuento_alternativo_4` decimal(8,2) NOT NULL DEFAULT 0.00,
  `descuento_alternativo_5` decimal(8,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `item_pollos`
--

INSERT INTO `item_pollos` (`id`, `pollo_id`, `item_id`, `precio`, `precio_cbba`, `precio_lpz`, `precio_alternativo_1`, `precio_alternativo_2`, `precio_alternativo_3`, `precio_alternativo_4`, `estado_precio_alternativo_1`, `estado_precio_alternativo_2`, `estado_precio_alternativo_3`, `estado_precio_alternativo_4`, `estado_precio_alternativo_5`, `precio_alternativo_5`, `peso`, `estado`, `created_at`, `updated_at`, `descuento_1`, `descuento_2`, `descuento_3`, `descuento_4`, `descuento_alternativo_1`, `descuento_alternativo_2`, `descuento_alternativo_3`, `descuento_alternativo_4`, `descuento_alternativo_5`) VALUES
(1, 1, 2, '2.700', '1.000', '1.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2024-07-24 05:52:45', '2024-07-24 05:52:45', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(2, 1, 3, '2.000', '1.000', '1.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2024-07-24 05:52:45', '2024-07-24 05:52:45', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(3, 1, 4, '1.000', '1.000', '1.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2024-07-24 05:52:45', '2024-07-24 05:52:45', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(4, 1, 5, '1.000', '1.000', '1.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2024-07-24 05:52:45', '2024-07-24 05:52:45', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(5, 1, 2, '2.700', '1.000', '1.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2024-09-09 06:07:58', '2024-09-09 06:07:58', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(6, 1, 3, '2.000', '1.000', '1.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2024-09-09 06:07:58', '2024-09-09 06:07:58', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(7, 1, 4, '1.000', '1.000', '1.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2024-09-09 06:07:58', '2024-09-09 06:07:58', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(8, 1, 5, '1.000', '1.000', '1.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2024-09-09 06:07:58', '2024-09-09 06:07:58', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(9, 1, 7, '4.000', '1.000', '1.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2024-09-09 06:07:58', '2024-09-09 06:07:58', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(10, 1, 2, '2.700', '1.000', '1.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2024-09-11 15:14:02', '2024-09-11 15:14:02', '0.200', '1.000', '1.300', '1.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(11, 1, 3, '2.000', '1.000', '1.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2024-09-11 15:14:02', '2024-09-11 15:14:02', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(12, 1, 4, '1.000', '1.000', '1.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2024-09-11 15:14:02', '2024-09-11 15:14:02', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(13, 1, 5, '1.000', '1.000', '1.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2024-09-11 15:14:02', '2024-09-11 15:14:02', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(14, 1, 7, '4.000', '1.000', '1.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2024-09-11 15:14:02', '2024-09-11 15:14:02', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(15, 1, 2, '2.700', '1.000', '3.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-14 16:08:43', '2025-07-14 16:08:43', '0.200', '1.000', '1.300', '1.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(16, 1, 3, '2.000', '1.000', '3.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-14 16:08:43', '2025-07-14 16:08:43', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(17, 1, 4, '1.000', '1.000', '3.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-14 16:08:43', '2025-07-14 16:08:43', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(18, 1, 5, '1.000', '1.000', '3.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-14 16:08:44', '2025-07-14 16:08:44', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(19, 1, 7, '4.000', '1.000', '3.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-14 16:08:44', '2025-07-14 16:08:44', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(20, 1, 2, '2.700', '1.000', '3.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-14 16:31:55', '2025-07-14 16:31:55', '0.200', '1.000', '1.300', '1.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(21, 1, 3, '2.000', '1.000', '3.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-14 16:31:55', '2025-07-14 16:31:55', '0.200', '0.300', '0.400', '0.500', '0.00', '0.00', '0.00', '0.00', '0.00'),
(22, 1, 4, '1.000', '1.000', '3.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-14 16:31:55', '2025-07-14 16:31:55', '0.300', '0.400', '0.500', '0.600', '0.00', '0.00', '0.00', '0.00', '0.00'),
(23, 1, 5, '1.000', '1.000', '3.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-14 16:31:55', '2025-07-14 16:31:55', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(24, 1, 7, '4.000', '1.000', '3.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-14 16:31:55', '2025-07-14 16:31:55', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(25, 1, 2, '2.700', '1.000', '3.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-14 16:32:52', '2025-07-14 16:32:52', '0.200', '1.000', '1.300', '1.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(26, 1, 3, '4.000', '1.000', '3.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-14 16:32:52', '2025-07-14 16:32:52', '0.200', '0.300', '0.400', '0.500', '0.00', '0.00', '0.00', '0.00', '0.00'),
(27, 1, 4, '1.000', '1.000', '3.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-14 16:32:52', '2025-07-14 16:32:52', '0.300', '0.400', '0.500', '0.600', '0.00', '0.00', '0.00', '0.00', '0.00'),
(28, 1, 5, '1.000', '1.000', '3.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-14 16:32:52', '2025-07-14 16:32:52', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(29, 1, 7, '4.000', '1.000', '3.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-14 16:32:52', '2025-07-14 16:32:52', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(30, 1, 2, '2.700', '1.000', '3.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-14 16:50:48', '2025-07-14 16:50:48', '0.200', '1.000', '1.300', '1.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(31, 1, 3, '2.000', '1.000', '3.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-14 16:50:48', '2025-07-14 16:50:48', '0.200', '0.300', '0.400', '0.500', '0.00', '0.00', '0.00', '0.00', '0.00'),
(32, 1, 4, '1.000', '1.000', '3.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-14 16:50:48', '2025-07-14 16:50:48', '0.300', '0.400', '0.500', '0.600', '0.00', '0.00', '0.00', '0.00', '0.00'),
(33, 1, 5, '1.000', '1.000', '3.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-14 16:50:48', '2025-07-14 16:50:48', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(34, 1, 7, '4.000', '1.000', '3.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-14 16:50:48', '2025-07-14 16:50:48', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(35, 1, 2, '2.700', '1.000', '150.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-14 16:53:32', '2025-07-14 16:53:32', '0.200', '1.000', '1.300', '1.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(36, 1, 3, '2.000', '1.000', '150.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-14 16:53:33', '2025-07-14 16:53:33', '0.200', '0.300', '0.400', '0.500', '0.00', '0.00', '0.00', '0.00', '0.00'),
(37, 1, 4, '1.000', '1.000', '150.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-14 16:53:33', '2025-07-14 16:53:33', '0.300', '0.400', '0.500', '0.600', '0.00', '0.00', '0.00', '0.00', '0.00'),
(38, 1, 5, '1.000', '1.000', '150.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-14 16:53:33', '2025-07-14 16:53:33', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(39, 1, 7, '4.000', '1.000', '150.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-14 16:53:33', '2025-07-14 16:53:33', '0.000', '200.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(40, 1, 2, '2.700', '1.000', '150.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-14 16:53:58', '2025-07-14 16:53:58', '0.200', '1.000', '1.300', '1.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(41, 1, 3, '2.000', '1.000', '150.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-14 16:53:58', '2025-07-14 16:53:58', '0.200', '0.300', '0.400', '0.500', '0.00', '0.00', '0.00', '0.00', '0.00'),
(42, 1, 4, '1.000', '1.000', '150.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-14 16:53:58', '2025-07-14 16:53:58', '0.300', '0.400', '0.500', '0.600', '0.00', '0.00', '0.00', '0.00', '0.00'),
(43, 1, 5, '1.000', '1.000', '150.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-14 16:53:58', '2025-07-14 16:53:58', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(44, 1, 7, '4.000', '1.000', '150.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-14 16:53:58', '2025-07-14 16:53:58', '0.000', '1.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(45, 1, 2, '2.700', '1.000', '1.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-14 16:54:05', '2025-07-14 16:54:05', '0.200', '1.000', '1.300', '1.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(46, 1, 3, '2.000', '1.000', '1.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-14 16:54:05', '2025-07-14 16:54:05', '0.200', '0.300', '0.400', '0.500', '0.00', '0.00', '0.00', '0.00', '0.00'),
(47, 1, 4, '1.000', '1.000', '1.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-14 16:54:05', '2025-07-14 16:54:05', '0.300', '0.400', '0.500', '0.600', '0.00', '0.00', '0.00', '0.00', '0.00'),
(48, 1, 5, '1.000', '1.000', '1.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-14 16:54:05', '2025-07-14 16:54:05', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(49, 1, 7, '4.000', '1.000', '1.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-14 16:54:05', '2025-07-14 16:54:05', '0.000', '1.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(50, 1, 2, '2.800', '1.000', '1.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-14 17:18:06', '2025-07-14 17:18:06', '0.200', '1.000', '1.300', '1.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(51, 1, 3, '2.000', '1.000', '1.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-14 17:18:06', '2025-07-14 17:18:06', '0.200', '0.300', '0.400', '0.500', '0.00', '0.00', '0.00', '0.00', '0.00'),
(52, 1, 4, '1.000', '1.000', '1.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-14 17:18:06', '2025-07-14 17:18:06', '0.300', '0.400', '0.500', '0.600', '0.00', '0.00', '0.00', '0.00', '0.00'),
(53, 1, 5, '1.000', '1.000', '1.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-14 17:18:06', '2025-07-14 17:18:06', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(54, 1, 7, '4.000', '1.000', '1.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-14 17:18:06', '2025-07-14 17:18:06', '0.000', '1.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(55, 1, 2, '2.900', '1.000', '1.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-14 19:28:21', '2025-07-14 19:28:21', '0.200', '1.000', '1.300', '1.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(56, 1, 3, '2.000', '1.000', '1.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-14 19:28:21', '2025-07-14 19:28:21', '0.200', '0.300', '0.400', '0.500', '0.00', '0.00', '0.00', '0.00', '0.00'),
(57, 1, 4, '1.000', '1.000', '1.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-14 19:28:21', '2025-07-14 19:28:21', '0.300', '0.400', '0.500', '0.600', '0.00', '0.00', '0.00', '0.00', '0.00'),
(58, 1, 5, '1.000', '1.000', '1.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-14 19:28:21', '2025-07-14 19:28:21', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(59, 1, 7, '4.000', '1.000', '1.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-14 19:28:21', '2025-07-14 19:28:21', '0.000', '1.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(60, 1, 2, '2.900', '1.000', '1.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-14 19:36:57', '2025-07-14 19:36:57', '0.200', '1.000', '1.300', '1.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(61, 1, 3, '2.000', '1.000', '1.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-14 19:36:57', '2025-07-14 19:36:57', '0.200', '0.300', '0.400', '0.500', '0.00', '0.00', '0.00', '0.00', '0.00'),
(62, 1, 4, '1.000', '1.000', '1.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-14 19:36:57', '2025-07-14 19:36:57', '0.300', '0.400', '0.500', '0.600', '0.00', '0.00', '0.00', '0.00', '0.00'),
(63, 1, 5, '1.000', '1.000', '1.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-14 19:36:57', '2025-07-14 19:36:57', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(64, 1, 7, '777.500', '1.000', '1.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-14 19:36:57', '2025-07-14 19:36:57', '0.000', '1.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(65, 1, 2, '2.900', '1.000', '1.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-18 22:24:12', '2025-07-18 22:24:12', '0.200', '0.600', '1.300', '1.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(66, 1, 3, '2.000', '1.000', '1.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-18 22:24:12', '2025-07-18 22:24:12', '0.200', '0.300', '0.400', '0.500', '0.00', '0.00', '0.00', '0.00', '0.00'),
(67, 1, 4, '1.000', '1.000', '1.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-18 22:24:12', '2025-07-18 22:24:12', '0.300', '0.400', '0.500', '0.600', '0.00', '0.00', '0.00', '0.00', '0.00'),
(68, 1, 5, '1.000', '1.000', '1.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-18 22:24:12', '2025-07-18 22:24:12', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(69, 1, 7, '777.500', '1.000', '1.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-18 22:24:12', '2025-07-18 22:24:12', '0.600', '0.800', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(70, 1, 2, '2.900', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-19 15:34:19', '2025-07-19 15:34:19', '0.200', '0.600', '1.300', '1.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(71, 1, 3, '2.000', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-19 15:34:19', '2025-07-19 15:34:19', '0.200', '0.300', '0.400', '0.500', '0.00', '0.00', '0.00', '0.00', '0.00'),
(72, 1, 4, '1.000', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-19 15:34:19', '2025-07-19 15:34:19', '0.300', '0.400', '0.500', '0.600', '0.00', '0.00', '0.00', '0.00', '0.00'),
(73, 1, 5, '1.000', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-19 15:34:19', '2025-07-19 15:34:19', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(74, 1, 7, '777.500', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-19 15:34:19', '2025-07-19 15:34:19', '0.600', '0.800', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(75, 1, 2, '2.900', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-19 15:36:48', '2025-07-19 15:36:48', '0.200', '0.600', '1.300', '1.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(76, 1, 3, '2.800', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-19 15:36:48', '2025-07-19 15:36:48', '0.200', '0.300', '0.400', '0.500', '0.00', '0.00', '0.00', '0.00', '0.00'),
(77, 1, 4, '2.700', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-19 15:36:48', '2025-07-19 15:36:48', '0.300', '0.400', '0.500', '0.600', '0.00', '0.00', '0.00', '0.00', '0.00'),
(78, 1, 5, '2.600', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-19 15:36:48', '2025-07-19 15:36:48', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(79, 1, 7, '2.500', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-19 15:36:48', '2025-07-19 15:36:48', '0.600', '0.800', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(80, 1, 2, '3.900', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-19 16:40:03', '2025-07-19 16:40:03', '0.200', '0.600', '1.300', '1.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(81, 1, 3, '3.800', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-19 16:40:03', '2025-07-19 16:40:03', '0.200', '0.300', '0.400', '0.500', '0.00', '0.00', '0.00', '0.00', '0.00'),
(82, 1, 4, '2.700', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-19 16:40:03', '2025-07-19 16:40:03', '0.300', '0.400', '0.500', '0.600', '0.00', '0.00', '0.00', '0.00', '0.00'),
(83, 1, 5, '2.600', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-19 16:40:03', '2025-07-19 16:40:03', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(84, 1, 7, '2.500', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-19 16:40:03', '2025-07-19 16:40:03', '0.600', '0.800', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(85, 1, 2, '3.900', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-26 14:41:59', '2025-07-26 14:41:59', '0.200', '0.600', '1.300', '1.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(86, 1, 3, '3.800', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-26 14:41:59', '2025-07-26 14:41:59', '0.200', '0.300', '0.400', '0.500', '0.00', '0.00', '0.00', '0.00', '0.00'),
(87, 1, 4, '2.700', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-26 14:41:59', '2025-07-26 14:41:59', '0.300', '0.400', '0.500', '0.600', '0.00', '0.00', '0.00', '0.00', '0.00'),
(88, 1, 5, '2.600', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-26 14:41:59', '2025-07-26 14:41:59', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(89, 1, 7, '2.500', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-26 14:41:59', '2025-07-26 14:41:59', '0.600', '0.800', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(90, 1, 2, '3.900', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-26 14:46:21', '2025-07-26 14:46:21', '0.200', '0.600', '1.300', '1.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(91, 1, 3, '3.800', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-26 14:46:21', '2025-07-26 14:46:21', '0.200', '0.300', '0.400', '0.500', '0.00', '0.00', '0.00', '0.00', '0.00'),
(92, 1, 4, '2.700', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-26 14:46:21', '2025-07-26 14:46:21', '0.300', '0.400', '0.500', '0.600', '0.00', '0.00', '0.00', '0.00', '0.00'),
(93, 1, 5, '2.600', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-26 14:46:21', '2025-07-26 14:46:21', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(94, 1, 7, '2.500', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-26 14:46:21', '2025-07-26 14:46:21', '0.600', '0.800', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(95, 1, 2, '3.900', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-26 14:47:57', '2025-07-26 14:47:57', '0.200', '0.600', '1.300', '1.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(96, 1, 3, '3.800', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-26 14:47:57', '2025-07-26 14:47:57', '0.200', '0.300', '0.400', '0.500', '0.00', '0.00', '0.00', '0.00', '0.00'),
(97, 1, 4, '2.700', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-26 14:47:57', '2025-07-26 14:47:57', '0.300', '0.400', '0.500', '0.600', '0.00', '0.00', '0.00', '0.00', '0.00'),
(98, 1, 5, '2.600', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-26 14:47:57', '2025-07-26 14:47:57', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(99, 1, 7, '2.500', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-26 14:47:57', '2025-07-26 14:47:57', '0.600', '0.800', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(100, 1, 2, '3.900', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-26 16:18:45', '2025-07-26 16:18:45', '0.200', '0.600', '1.300', '1.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(101, 1, 3, '3.800', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-26 16:18:45', '2025-07-26 16:18:45', '0.200', '0.300', '0.400', '0.500', '0.00', '0.00', '0.00', '0.00', '0.00'),
(102, 1, 4, '2.700', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-26 16:18:45', '2025-07-26 16:18:45', '0.300', '0.400', '0.500', '0.600', '0.00', '0.00', '0.00', '0.00', '0.00'),
(103, 1, 5, '2.600', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-26 16:18:45', '2025-07-26 16:18:45', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(104, 1, 7, '2.500', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-26 16:18:45', '2025-07-26 16:18:45', '0.600', '0.800', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(105, 1, 2, '3.900', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-26 16:34:08', '2025-07-26 16:34:08', '0.200', '0.600', '1.300', '1.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(106, 1, 3, '3.800', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-26 16:34:08', '2025-07-26 16:34:08', '0.200', '0.300', '0.400', '0.500', '0.00', '0.00', '0.00', '0.00', '0.00'),
(107, 1, 4, '2.700', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-26 16:34:08', '2025-07-26 16:34:08', '0.300', '0.400', '0.500', '0.600', '0.00', '0.00', '0.00', '0.00', '0.00'),
(108, 1, 5, '2.600', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-26 16:34:08', '2025-07-26 16:34:08', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(109, 1, 7, '2.500', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-26 16:34:08', '2025-07-26 16:34:08', '0.600', '0.800', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(110, 1, 2, '3.900', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-26 16:38:45', '2025-07-26 16:38:45', '0.200', '0.600', '1.300', '1.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(111, 1, 3, '3.800', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-26 16:38:45', '2025-07-26 16:38:45', '0.200', '0.300', '0.400', '0.500', '0.00', '0.00', '0.00', '0.00', '0.00'),
(112, 1, 4, '2.700', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-26 16:38:45', '2025-07-26 16:38:45', '0.300', '0.400', '0.500', '0.600', '0.00', '0.00', '0.00', '0.00', '0.00'),
(113, 1, 5, '2.600', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-26 16:38:45', '2025-07-26 16:38:45', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(114, 1, 7, '2.500', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-26 16:38:45', '2025-07-26 16:38:45', '0.600', '0.800', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(115, 1, 2, '3.900', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 15:47:36', '2025-07-28 15:47:36', '0.200', '0.600', '1.300', '1.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(116, 1, 3, '3.800', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 15:47:36', '2025-07-28 15:47:36', '0.200', '0.300', '0.400', '0.500', '0.00', '0.00', '0.00', '0.00', '0.00'),
(117, 1, 4, '2.700', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 15:47:36', '2025-07-28 15:47:36', '0.300', '0.400', '0.500', '0.600', '0.00', '0.00', '0.00', '0.00', '0.00'),
(118, 1, 5, '2.600', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 15:47:36', '2025-07-28 15:47:36', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(119, 1, 7, '2.500', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 15:47:36', '2025-07-28 15:47:36', '0.600', '0.800', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(120, 1, 2, '3.900', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 15:48:41', '2025-07-28 15:48:41', '0.200', '0.600', '1.300', '1.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(121, 1, 3, '3.800', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 15:48:41', '2025-07-28 15:48:41', '0.200', '0.300', '0.400', '0.500', '0.00', '0.00', '0.00', '0.00', '0.00'),
(122, 1, 4, '2.700', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 15:48:41', '2025-07-28 15:48:41', '0.300', '0.400', '0.500', '0.600', '0.00', '0.00', '0.00', '0.00', '0.00'),
(123, 1, 5, '2.600', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 15:48:41', '2025-07-28 15:48:41', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(124, 1, 7, '2.500', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 15:48:41', '2025-07-28 15:48:41', '0.600', '0.800', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(125, 1, 2, '3.900', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 16:19:05', '2025-07-28 16:19:05', '0.200', '0.600', '1.300', '1.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(126, 1, 3, '3.800', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 16:19:05', '2025-07-28 16:19:05', '0.200', '0.300', '0.400', '0.500', '0.00', '0.00', '0.00', '0.00', '0.00'),
(127, 1, 4, '2.700', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 16:19:05', '2025-07-28 16:19:05', '0.300', '0.400', '0.500', '0.600', '0.00', '0.00', '0.00', '0.00', '0.00'),
(128, 1, 5, '2.600', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 16:19:05', '2025-07-28 16:19:05', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(129, 1, 7, '2.500', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 16:19:05', '2025-07-28 16:19:05', '0.600', '0.800', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(130, 1, 2, '3.900', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 16:35:31', '2025-07-28 16:35:31', '0.200', '0.600', '1.300', '1.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(131, 1, 3, '3.800', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 16:35:31', '2025-07-28 16:35:31', '0.200', '0.300', '0.400', '0.500', '0.00', '0.00', '0.00', '0.00', '0.00'),
(132, 1, 4, '2.700', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 16:35:31', '2025-07-28 16:35:31', '0.300', '0.400', '0.500', '0.600', '0.00', '0.00', '0.00', '0.00', '0.00'),
(133, 1, 5, '2.600', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 16:35:31', '2025-07-28 16:35:31', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(134, 1, 7, '2.500', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 16:35:31', '2025-07-28 16:35:31', '0.600', '0.800', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(135, 1, 2, '3.900', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 17:00:47', '2025-07-28 17:00:47', '0.200', '0.600', '1.300', '1.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(136, 1, 3, '3.800', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 17:00:47', '2025-07-28 17:00:47', '0.200', '0.300', '0.400', '0.500', '0.00', '0.00', '0.00', '0.00', '0.00'),
(137, 1, 4, '2.700', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 17:00:47', '2025-07-28 17:00:47', '0.300', '0.400', '0.500', '0.600', '0.00', '0.00', '0.00', '0.00', '0.00'),
(138, 1, 5, '2.600', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 17:00:47', '2025-07-28 17:00:47', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(139, 1, 7, '2.500', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 17:00:47', '2025-07-28 17:00:47', '0.600', '0.800', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(140, 1, 2, '3.900', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 17:01:33', '2025-07-28 17:01:33', '0.200', '0.600', '1.300', '1.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(141, 1, 3, '3.800', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 17:01:33', '2025-07-28 17:01:33', '0.200', '0.300', '0.400', '0.500', '0.00', '0.00', '0.00', '0.00', '0.00'),
(142, 1, 4, '2.700', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 17:01:33', '2025-07-28 17:01:33', '0.300', '0.400', '0.500', '0.600', '0.00', '0.00', '0.00', '0.00', '0.00'),
(143, 1, 5, '2.600', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 17:01:33', '2025-07-28 17:01:33', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(144, 1, 7, '2.500', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 17:01:33', '2025-07-28 17:01:33', '0.600', '0.800', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(145, 1, 2, '3.900', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 17:02:34', '2025-07-28 17:02:34', '0.200', '0.600', '1.300', '1.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(146, 1, 3, '3.800', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 17:02:34', '2025-07-28 17:02:34', '0.200', '0.300', '0.400', '0.500', '0.00', '0.00', '0.00', '0.00', '0.00'),
(147, 1, 4, '2.700', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 17:02:34', '2025-07-28 17:02:34', '0.300', '0.400', '0.500', '0.600', '0.00', '0.00', '0.00', '0.00', '0.00'),
(148, 1, 5, '2.600', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 17:02:34', '2025-07-28 17:02:34', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(149, 1, 7, '2.500', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 17:02:34', '2025-07-28 17:02:34', '0.600', '0.800', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(150, 1, 2, '3.900', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 17:03:12', '2025-07-28 17:03:12', '0.200', '0.600', '1.300', '1.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(151, 1, 3, '3.800', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 17:03:12', '2025-07-28 17:03:12', '0.200', '0.300', '0.400', '0.500', '0.00', '0.00', '0.00', '0.00', '0.00'),
(152, 1, 4, '2.700', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 17:03:12', '2025-07-28 17:03:12', '0.300', '0.400', '0.500', '0.600', '0.00', '0.00', '0.00', '0.00', '0.00'),
(153, 1, 5, '2.600', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 17:03:12', '2025-07-28 17:03:12', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(154, 1, 7, '2.500', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 17:03:12', '2025-07-28 17:03:12', '0.600', '0.800', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(155, 1, 2, '3.900', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 17:03:32', '2025-07-28 17:03:32', '0.200', '0.600', '1.300', '1.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(156, 1, 3, '3.800', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 17:03:32', '2025-07-28 17:03:32', '0.200', '0.300', '0.400', '0.500', '0.00', '0.00', '0.00', '0.00', '0.00'),
(157, 1, 4, '2.700', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 17:03:32', '2025-07-28 17:03:32', '0.300', '0.400', '0.500', '0.600', '0.00', '0.00', '0.00', '0.00', '0.00'),
(158, 1, 5, '2.600', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 17:03:32', '2025-07-28 17:03:32', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(159, 1, 7, '2.500', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 17:03:32', '2025-07-28 17:03:32', '0.600', '0.800', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(160, 1, 2, '3.900', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 17:05:34', '2025-07-28 17:05:34', '0.200', '0.600', '1.300', '1.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(161, 1, 3, '3.800', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 17:05:34', '2025-07-28 17:05:34', '0.200', '0.300', '0.400', '0.500', '0.00', '0.00', '0.00', '0.00', '0.00'),
(162, 1, 4, '2.700', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 17:05:34', '2025-07-28 17:05:34', '0.300', '0.400', '0.500', '0.600', '0.00', '0.00', '0.00', '0.00', '0.00'),
(163, 1, 5, '2.600', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 17:05:34', '2025-07-28 17:05:34', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(164, 1, 7, '2.500', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 17:05:34', '2025-07-28 17:05:34', '0.600', '0.800', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(165, 1, 2, '3.900', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 21:02:17', '2025-07-28 21:02:17', '0.200', '0.600', '1.300', '1.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(166, 1, 3, '3.800', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 21:02:17', '2025-07-28 21:02:17', '0.200', '0.300', '0.400', '0.500', '0.00', '0.00', '0.00', '0.00', '0.00'),
(167, 1, 4, '2.700', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 21:02:17', '2025-07-28 21:02:17', '0.300', '0.400', '0.500', '0.600', '0.00', '0.00', '0.00', '0.00', '0.00'),
(168, 1, 5, '2.600', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 21:02:17', '2025-07-28 21:02:17', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(169, 1, 7, '2.500', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 21:02:17', '2025-07-28 21:02:17', '0.600', '0.800', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(170, 1, 2, '3.900', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 21:02:27', '2025-07-28 21:02:27', '0.200', '0.600', '1.300', '1.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(171, 1, 3, '3.800', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 21:02:27', '2025-07-28 21:02:27', '0.200', '0.300', '0.400', '0.500', '0.00', '0.00', '0.00', '0.00', '0.00'),
(172, 1, 4, '2.700', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 21:02:27', '2025-07-28 21:02:27', '0.300', '0.400', '0.500', '0.600', '0.00', '0.00', '0.00', '0.00', '0.00'),
(173, 1, 5, '2.600', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 21:02:27', '2025-07-28 21:02:27', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(174, 1, 7, '2.500', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 21:02:27', '2025-07-28 21:02:27', '0.600', '0.800', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(175, 1, 2, '3.900', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 21:02:54', '2025-07-28 21:02:54', '0.200', '0.600', '1.300', '1.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(176, 1, 3, '3.800', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 21:02:54', '2025-07-28 21:02:54', '0.200', '0.300', '0.400', '0.500', '0.00', '0.00', '0.00', '0.00', '0.00'),
(177, 1, 4, '2.700', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 21:02:54', '2025-07-28 21:02:54', '0.300', '0.400', '0.500', '0.600', '0.00', '0.00', '0.00', '0.00', '0.00'),
(178, 1, 5, '2.600', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 21:02:54', '2025-07-28 21:02:54', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(179, 1, 7, '2.500', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 21:02:54', '2025-07-28 21:02:54', '0.600', '0.800', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(180, 1, 2, '3.900', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 21:03:22', '2025-07-28 21:03:22', '0.200', '0.600', '1.300', '1.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(181, 1, 3, '3.800', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 21:03:22', '2025-07-28 21:03:22', '0.200', '0.300', '0.400', '0.500', '0.00', '0.00', '0.00', '0.00', '0.00'),
(182, 1, 4, '2.700', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 21:03:22', '2025-07-28 21:03:22', '0.300', '0.400', '0.500', '0.600', '0.00', '0.00', '0.00', '0.00', '0.00'),
(183, 1, 5, '2.600', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 21:03:22', '2025-07-28 21:03:22', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(184, 1, 7, '2.500', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 21:03:22', '2025-07-28 21:03:22', '0.600', '0.800', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(185, 1, 2, '3.900', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 21:21:42', '2025-07-28 21:21:42', '0.200', '0.600', '1.300', '1.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(186, 1, 3, '3.800', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 21:21:42', '2025-07-28 21:21:42', '0.200', '0.300', '0.400', '0.500', '0.00', '0.00', '0.00', '0.00', '0.00'),
(187, 1, 4, '2.700', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 21:21:42', '2025-07-28 21:21:42', '0.300', '0.400', '0.500', '0.600', '0.00', '0.00', '0.00', '0.00', '0.00'),
(188, 1, 5, '2.600', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 21:21:42', '2025-07-28 21:21:42', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(189, 1, 7, '2.500', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 21:21:42', '2025-07-28 21:21:42', '0.600', '0.800', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(190, 1, 2, '3.900', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 21:21:49', '2025-07-28 21:21:49', '0.200', '0.600', '1.300', '1.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(191, 1, 3, '3.800', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 21:21:49', '2025-07-28 21:21:49', '0.200', '0.300', '0.400', '0.500', '0.00', '0.00', '0.00', '0.00', '0.00'),
(192, 1, 4, '2.700', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 21:21:49', '2025-07-28 21:21:49', '0.300', '0.400', '0.500', '0.600', '0.00', '0.00', '0.00', '0.00', '0.00'),
(193, 1, 5, '2.600', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 21:21:49', '2025-07-28 21:21:49', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(194, 1, 7, '2.500', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-28 21:21:49', '2025-07-28 21:21:49', '0.600', '0.800', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(195, 1, 2, '3.900', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-30 14:14:37', '2025-07-30 14:14:37', '0.200', '0.600', '1.300', '1.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(196, 1, 3, '3.800', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-30 14:14:37', '2025-07-30 14:14:37', '0.200', '0.300', '0.400', '0.500', '0.00', '0.00', '0.00', '0.00', '0.00'),
(197, 1, 4, '2.700', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-30 14:14:37', '2025-07-30 14:14:37', '0.300', '0.400', '0.500', '0.600', '0.00', '0.00', '0.00', '0.00', '0.00'),
(198, 1, 5, '2.600', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-30 14:14:37', '2025-07-30 14:14:37', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(199, 1, 7, '2.500', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-30 14:14:37', '2025-07-30 14:14:37', '0.600', '0.800', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(200, 1, 2, '3.900', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-30 16:50:46', '2025-07-30 16:50:46', '0.200', '0.600', '1.300', '1.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(201, 1, 3, '3.800', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-30 16:50:46', '2025-07-30 16:50:46', '0.200', '0.300', '0.400', '0.500', '0.00', '0.00', '0.00', '0.00', '0.00'),
(202, 1, 4, '2.700', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-30 16:50:46', '2025-07-30 16:50:46', '0.300', '0.400', '0.500', '0.600', '0.00', '0.00', '0.00', '0.00', '0.00'),
(203, 1, 5, '2.600', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-30 16:50:46', '2025-07-30 16:50:46', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(204, 1, 7, '2.500', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-30 16:50:46', '2025-07-30 16:50:46', '0.600', '0.800', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(205, 1, 2, '3.900', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-30 16:53:58', '2025-07-30 16:53:58', '0.200', '0.600', '1.300', '1.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(206, 1, 3, '3.800', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-30 16:53:58', '2025-07-30 16:53:58', '0.200', '0.300', '0.400', '0.500', '0.00', '0.00', '0.00', '0.00', '0.00'),
(207, 1, 4, '2.700', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-30 16:53:58', '2025-07-30 16:53:58', '0.300', '0.400', '0.500', '0.600', '0.00', '0.00', '0.00', '0.00', '0.00'),
(208, 1, 5, '2.600', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-30 16:53:58', '2025-07-30 16:53:58', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(209, 1, 7, '2.500', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-30 16:53:58', '2025-07-30 16:53:58', '0.600', '0.800', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(210, 1, 2, '3.900', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-30 18:20:27', '2025-07-30 18:20:27', '0.200', '0.600', '1.300', '1.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(211, 1, 3, '3.800', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-30 18:20:27', '2025-07-30 18:20:27', '0.200', '0.300', '0.400', '0.500', '0.00', '0.00', '0.00', '0.00', '0.00'),
(212, 1, 4, '2.700', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-30 18:20:27', '2025-07-30 18:20:27', '0.300', '0.400', '0.500', '0.600', '0.00', '0.00', '0.00', '0.00', '0.00'),
(213, 1, 5, '2.600', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-30 18:20:27', '2025-07-30 18:20:27', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(214, 1, 7, '2.500', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-30 18:20:27', '2025-07-30 18:20:27', '0.600', '0.800', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(215, 1, 2, '3.900', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-30 18:37:50', '2025-07-30 18:37:50', '0.200', '0.600', '1.300', '1.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(216, 1, 3, '3.800', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-30 18:37:50', '2025-07-30 18:37:50', '0.200', '0.300', '0.400', '0.500', '0.00', '0.00', '0.00', '0.00', '0.00');
INSERT INTO `item_pollos` (`id`, `pollo_id`, `item_id`, `precio`, `precio_cbba`, `precio_lpz`, `precio_alternativo_1`, `precio_alternativo_2`, `precio_alternativo_3`, `precio_alternativo_4`, `estado_precio_alternativo_1`, `estado_precio_alternativo_2`, `estado_precio_alternativo_3`, `estado_precio_alternativo_4`, `estado_precio_alternativo_5`, `precio_alternativo_5`, `peso`, `estado`, `created_at`, `updated_at`, `descuento_1`, `descuento_2`, `descuento_3`, `descuento_4`, `descuento_alternativo_1`, `descuento_alternativo_2`, `descuento_alternativo_3`, `descuento_alternativo_4`, `descuento_alternativo_5`) VALUES
(217, 1, 4, '2.700', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-30 18:37:50', '2025-07-30 18:37:50', '0.300', '0.400', '0.500', '0.600', '0.00', '0.00', '0.00', '0.00', '0.00'),
(218, 1, 5, '2.600', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-30 18:37:50', '2025-07-30 18:37:50', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(219, 1, 7, '2.500', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-30 18:37:50', '2025-07-30 18:37:50', '0.600', '0.800', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(220, 1, 2, '3.900', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-30 18:39:57', '2025-07-30 18:39:57', '0.200', '0.600', '1.300', '1.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(221, 1, 3, '3.800', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-30 18:39:57', '2025-07-30 18:39:57', '0.200', '0.300', '0.400', '0.500', '0.00', '0.00', '0.00', '0.00', '0.00'),
(222, 1, 4, '2.700', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-30 18:39:57', '2025-07-30 18:39:57', '0.300', '0.400', '0.500', '0.600', '0.00', '0.00', '0.00', '0.00', '0.00'),
(223, 1, 5, '2.600', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-30 18:39:57', '2025-07-30 18:39:57', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(224, 1, 7, '2.500', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-30 18:39:57', '2025-07-30 18:39:57', '0.600', '0.800', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(225, 1, 2, '3.900', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-30 18:43:50', '2025-07-30 18:43:50', '0.200', '0.600', '1.300', '1.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(226, 1, 3, '3.800', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-30 18:43:50', '2025-07-30 18:43:50', '0.200', '0.300', '0.400', '0.500', '0.00', '0.00', '0.00', '0.00', '0.00'),
(227, 1, 4, '2.700', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-30 18:43:50', '2025-07-30 18:43:50', '0.300', '0.400', '0.500', '0.600', '0.00', '0.00', '0.00', '0.00', '0.00'),
(228, 1, 5, '2.600', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-30 18:43:50', '2025-07-30 18:43:50', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(229, 1, 7, '2.500', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-30 18:43:50', '2025-07-30 18:43:50', '0.600', '0.800', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(230, 1, 2, '3.900', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-30 19:04:28', '2025-07-30 19:04:28', '0.200', '0.600', '1.300', '1.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(231, 1, 3, '3.800', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-30 19:04:28', '2025-07-30 19:04:28', '0.200', '0.300', '0.400', '0.500', '0.00', '0.00', '0.00', '0.00', '0.00'),
(232, 1, 4, '2.700', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-30 19:04:28', '2025-07-30 19:04:28', '0.300', '0.400', '0.500', '0.600', '0.00', '0.00', '0.00', '0.00', '0.00'),
(233, 1, 5, '2.600', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-30 19:04:28', '2025-07-30 19:04:28', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(234, 1, 7, '2.500', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-07-30 19:04:28', '2025-07-30 19:04:28', '0.600', '0.800', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(235, 1, 2, '3.900', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-08-08 18:38:05', '2025-08-08 18:38:05', '0.200', '0.600', '1.300', '1.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(236, 1, 3, '3.800', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-08-08 18:38:05', '2025-08-08 18:38:05', '0.200', '0.300', '0.400', '0.500', '0.00', '0.00', '0.00', '0.00', '0.00'),
(237, 1, 4, '2.700', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-08-08 18:38:05', '2025-08-08 18:38:05', '0.300', '0.400', '0.500', '0.600', '0.00', '0.00', '0.00', '0.00', '0.00'),
(238, 1, 5, '2.600', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-08-08 18:38:05', '2025-08-08 18:38:05', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(239, 1, 7, '2.500', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-08-08 18:38:05', '2025-08-08 18:38:05', '0.600', '0.800', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(240, 1, 17, '1.000', '29.000', '31.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '2.300', 1, '2025-08-08 18:38:05', '2025-08-08 18:38:05', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(241, 1, 2, '3.900', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-08-08 19:29:32', '2025-08-08 19:29:32', '0.200', '0.600', '1.300', '1.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(242, 1, 3, '3.800', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-08-08 19:29:32', '2025-08-08 19:29:32', '0.200', '0.300', '0.400', '0.500', '0.00', '0.00', '0.00', '0.00', '0.00'),
(243, 1, 4, '2.700', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-08-08 19:29:32', '2025-08-08 19:29:32', '0.300', '0.400', '0.500', '0.600', '0.00', '0.00', '0.00', '0.00', '0.00'),
(244, 1, 5, '2.600', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-08-08 19:29:32', '2025-08-08 19:29:32', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(245, 1, 7, '2.500', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-08-08 19:29:32', '2025-08-08 19:29:32', '0.600', '0.800', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(246, 1, 17, '1.000', '29.000', '31.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '2.300', 1, '2025-08-08 19:29:32', '2025-08-08 19:29:32', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(247, 1, 18, '1.000', '29.000', '31.000', '1.00', '2.00', '3.00', '4.00', 0, 0, 0, 0, 0, '5.00', '2.300', 1, '2025-08-08 19:29:32', '2025-08-08 19:29:32', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(248, 1, 2, '3.900', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-08-08 19:35:54', '2025-08-08 19:35:54', '0.200', '0.600', '1.300', '1.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(249, 1, 3, '3.800', '13.000', '14.000', '5.00', '6.00', '7.00', '8.00', 0, 0, 0, 1, 0, '9.00', '1.000', 1, '2025-08-08 19:35:54', '2025-08-08 19:35:54', '0.200', '0.300', '0.400', '0.500', '0.00', '0.00', '0.00', '0.00', '0.00'),
(250, 1, 4, '2.700', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-08-08 19:35:54', '2025-08-08 19:35:54', '0.300', '0.400', '0.500', '0.600', '0.00', '0.00', '0.00', '0.00', '0.00'),
(251, 1, 5, '2.600', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-08-08 19:35:54', '2025-08-08 19:35:54', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(252, 1, 7, '2.500', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-08-08 19:35:54', '2025-08-08 19:35:54', '0.600', '0.800', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(253, 1, 17, '1.000', '29.000', '31.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '2.300', 1, '2025-08-08 19:35:54', '2025-08-08 19:35:54', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(254, 1, 18, '1.000', '29.000', '31.000', '1.00', '2.00', '3.00', '4.00', 0, 0, 1, 0, 0, '5.00', '2.300', 1, '2025-08-08 19:35:54', '2025-08-08 19:35:54', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(255, 1, 2, '3.900', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-08-08 19:39:39', '2025-08-08 19:39:39', '0.200', '0.600', '1.300', '1.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(256, 1, 3, '3.800', '13.000', '14.000', '5.00', '6.00', '7.00', '8.00', 0, 0, 0, 0, 0, '9.00', '1.000', 1, '2025-08-08 19:39:39', '2025-08-08 19:39:39', '0.200', '0.300', '0.400', '0.500', '0.00', '0.00', '0.00', '0.00', '0.00'),
(257, 1, 4, '2.700', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-08-08 19:39:39', '2025-08-08 19:39:39', '0.300', '0.400', '0.500', '0.600', '0.00', '0.00', '0.00', '0.00', '0.00'),
(258, 1, 5, '2.600', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-08-08 19:39:39', '2025-08-08 19:39:39', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(259, 1, 7, '2.500', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-08-08 19:39:39', '2025-08-08 19:39:39', '0.600', '0.800', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(260, 1, 17, '1.000', '29.000', '31.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '2.300', 1, '2025-08-08 19:39:39', '2025-08-08 19:39:39', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(261, 1, 18, '1.000', '29.000', '31.000', '1.00', '2.00', '3.00', '4.00', 0, 0, 0, 0, 0, '5.00', '2.300', 1, '2025-08-08 19:39:39', '2025-08-08 19:39:39', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(262, 1, 2, '3.900', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-08-08 19:54:12', '2025-08-08 19:54:12', '0.200', '0.600', '1.300', '1.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(263, 1, 3, '3.800', '13.000', '14.000', '5.00', '6.00', '7.00', '8.00', 0, 0, 0, 0, 0, '9.00', '1.000', 1, '2025-08-08 19:54:12', '2025-08-08 19:54:12', '0.200', '0.300', '0.400', '0.500', '0.00', '0.00', '0.00', '0.00', '0.00'),
(264, 1, 4, '2.700', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-08-08 19:54:12', '2025-08-08 19:54:12', '0.300', '0.400', '0.500', '0.600', '0.00', '0.00', '0.00', '0.00', '0.00'),
(265, 1, 5, '2.600', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-08-08 19:54:12', '2025-08-08 19:54:12', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(266, 1, 7, '2.500', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-08-08 19:54:12', '2025-08-08 19:54:12', '0.600', '0.800', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(267, 1, 17, '1.000', '29.000', '31.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '2.300', 1, '2025-08-08 19:54:12', '2025-08-08 19:54:12', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(268, 1, 18, '1.000', '29.000', '31.000', '1.00', '2.00', '3.00', '4.00', 0, 0, 0, 0, 1, '5.00', '2.300', 1, '2025-08-08 19:54:12', '2025-08-08 19:54:12', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(269, 1, 2, '3.900', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-08-13 13:13:45', '2025-08-13 13:13:45', '0.200', '0.600', '1.300', '1.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(270, 1, 3, '3.800', '13.000', '14.000', '5.00', '6.00', '7.00', '8.00', 0, 0, 0, 0, 0, '9.00', '1.000', 1, '2025-08-13 13:13:45', '2025-08-13 13:13:45', '0.200', '0.300', '0.400', '0.500', '0.00', '0.00', '0.00', '0.00', '0.00'),
(271, 1, 4, '2.700', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-08-13 13:13:45', '2025-08-13 13:13:45', '0.300', '0.400', '0.500', '0.600', '0.00', '0.00', '0.00', '0.00', '0.00'),
(272, 1, 5, '2.600', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-08-13 13:13:45', '2025-08-13 13:13:45', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(273, 1, 7, '2.500', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-08-13 13:13:45', '2025-08-13 13:13:45', '0.600', '0.800', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(274, 1, 17, '1.000', '29.000', '31.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '2.300', 1, '2025-08-13 13:13:45', '2025-08-13 13:13:45', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(275, 1, 18, '5.000', '29.000', '31.000', '1.00', '2.00', '3.00', '4.00', 0, 0, 0, 0, 1, '5.00', '2.300', 1, '2025-08-13 13:13:45', '2025-08-13 13:13:45', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(276, 1, 1, '1.000', '29.000', '31.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '2.300', 1, '2025-08-14 20:11:07', '2025-08-14 20:11:07', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(277, 1, 2, '3.900', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-08-14 20:11:07', '2025-08-14 20:11:07', '0.200', '0.600', '1.300', '1.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(278, 1, 3, '3.800', '13.000', '14.000', '5.00', '6.00', '7.00', '8.00', 0, 0, 0, 0, 0, '9.00', '1.000', 1, '2025-08-14 20:11:07', '2025-08-14 20:11:07', '0.200', '0.300', '0.400', '0.500', '0.00', '0.00', '0.00', '0.00', '0.00'),
(279, 1, 4, '2.700', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-08-14 20:11:07', '2025-08-14 20:11:07', '0.300', '0.400', '0.500', '0.600', '0.00', '0.00', '0.00', '0.00', '0.00'),
(280, 1, 5, '2.600', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-08-14 20:11:07', '2025-08-14 20:11:07', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(281, 1, 6, '1.000', '29.000', '31.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '2.300', 1, '2025-08-14 20:11:07', '2025-08-14 20:11:07', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(282, 1, 7, '2.500', '13.000', '14.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '1.000', 1, '2025-08-14 20:11:07', '2025-08-14 20:11:07', '0.600', '0.800', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00'),
(283, 1, 8, '1.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, '0.00', '0.000', 1, '2025-08-14 20:11:07', '2025-08-14 20:11:07', '0.000', '0.000', '0.000', '0.000', '0.00', '0.00', '0.00', '0.00', '0.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `item_precios`
--

CREATE TABLE `item_precios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` int(11) NOT NULL,
  `cambio` int(11) NOT NULL,
  `cambio_precio_id` int(11) NOT NULL,
  `sucursal_id` int(11) NOT NULL,
  `precio` decimal(10,3) NOT NULL,
  `precio_anterior` decimal(10,3) NOT NULL,
  `fecha` date NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `item_pt_movimientos`
--

CREATE TABLE `item_pt_movimientos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` int(11) NOT NULL DEFAULT 1,
  `pt_id` int(11) NOT NULL DEFAULT 1,
  `cajas` int(11) NOT NULL DEFAULT 1,
  `kgb` decimal(8,3) NOT NULL DEFAULT 0.000,
  `taras` decimal(8,3) NOT NULL DEFAULT 0.000,
  `kgn` decimal(8,3) NOT NULL DEFAULT 0.000,
  `fecha` date DEFAULT NULL,
  `hora` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dia` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `motivo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `item_pt_transformacion_lotes`
--

CREATE TABLE `item_pt_transformacion_lotes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `encargado` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transformacion_lote_id` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `item_id` int(11) NOT NULL DEFAULT 1,
  `pt_id` int(11) NOT NULL DEFAULT 1,
  `cajas` int(11) NOT NULL DEFAULT 0,
  `peso_bruto` decimal(8,3) NOT NULL DEFAULT 0.000,
  `peso_neto` decimal(8,3) NOT NULL DEFAULT 0.000,
  `taras` decimal(8,3) NOT NULL DEFAULT 0.000,
  `fecha_hora` datetime DEFAULT NULL,
  `is_declarado` int(11) NOT NULL DEFAULT 0,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cierre` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `item_sobra_pts`
--

CREATE TABLE `item_sobra_pts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` int(11) NOT NULL DEFAULT 1,
  `pt_id` int(11) NOT NULL DEFAULT 1,
  `pt_secundario_id` int(11) NOT NULL DEFAULT 0,
  `cajas` int(11) NOT NULL DEFAULT 1,
  `kgb` decimal(8,3) NOT NULL DEFAULT 0.000,
  `taras` decimal(8,3) NOT NULL DEFAULT 0.000,
  `kgn` decimal(8,3) NOT NULL DEFAULT 0.000,
  `sobra` int(11) NOT NULL DEFAULT 1,
  `fecha` date DEFAULT NULL,
  `hora` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dia` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kardex_dotacions`
--

CREATE TABLE `kardex_dotacions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `motivo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `dotacion_id` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `movimiento` int(11) NOT NULL DEFAULT 1,
  `tipo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `costo` decimal(10,2) NOT NULL DEFAULT 0.00,
  `venta` decimal(10,2) NOT NULL DEFAULT 0.00,
  `entradas` int(11) NOT NULL DEFAULT 1,
  `salidas` int(11) NOT NULL DEFAULT 1,
  `stock` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fechatime` datetime DEFAULT NULL,
  `familia_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `liquidacions`
--

CREATE TABLE `liquidacions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `inicio` date DEFAULT NULL,
  `fin` date DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `contrato_id` int(11) NOT NULL DEFAULT 1,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `dia` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `mes` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `user_id` int(11) NOT NULL DEFAULT 1,
  `sueldo_diario` decimal(10,3) NOT NULL DEFAULT 1.000,
  `sueldo_mensual` decimal(10,3) NOT NULL DEFAULT 1.000,
  `sueldo_bruto` decimal(10,3) NOT NULL DEFAULT 1.000,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logs`
--

CREATE TABLE `logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ip` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `logs`
--

INSERT INTO `logs` (`id`, `ip`, `browser`, `user_id`, `estado`, `created_at`, `updated_at`) VALUES
(1, '127.0.0.1', 'Chrome', 1, 1, '2025-05-20 18:18:57', '2025-05-20 18:18:57'),
(2, '127.0.0.1', 'Chrome', 1, 1, '2025-05-21 16:51:02', '2025-05-21 16:51:02'),
(3, '127.0.0.1', 'Chrome', 1, 1, '2025-05-23 23:26:13', '2025-05-23 23:26:13'),
(4, '127.0.0.1', 'Chrome', 1, 1, '2025-05-27 19:48:01', '2025-05-27 19:48:01'),
(5, '127.0.0.1', 'Chrome', 1, 1, '2025-05-27 20:10:22', '2025-05-27 20:10:22'),
(6, '127.0.0.1', 'Chrome', 1, 1, '2025-05-27 20:37:31', '2025-05-27 20:37:31'),
(7, '127.0.0.1', 'Chrome', 1, 1, '2025-06-03 13:16:44', '2025-06-03 13:16:44'),
(8, '127.0.0.1', 'Chrome', 1, 1, '2025-06-03 13:39:59', '2025-06-03 13:39:59'),
(9, '127.0.0.1', 'Chrome', 1, 1, '2025-06-03 13:39:59', '2025-06-03 13:39:59'),
(10, '127.0.0.1', 'Chrome', 1, 1, '2025-06-17 12:52:18', '2025-06-17 12:52:18'),
(11, '127.0.0.1', 'Safari', 1, 1, '2025-06-17 14:15:10', '2025-06-17 14:15:10'),
(12, '127.0.0.1', 'Chrome', 1, 1, '2025-06-18 16:51:19', '2025-06-18 16:51:19'),
(13, '127.0.0.1', 'Chrome', 1, 1, '2025-06-18 16:51:23', '2025-06-18 16:51:23'),
(14, '127.0.0.1', 'Chrome', 1, 1, '2025-06-18 21:34:16', '2025-06-18 21:34:16'),
(15, '127.0.0.1', 'Chrome', 1, 1, '2025-07-08 19:09:32', '2025-07-08 19:09:32'),
(16, '127.0.0.1', 'Chrome', 1, 1, '2025-07-21 15:22:51', '2025-07-21 15:22:51'),
(17, '127.0.0.1', 'Chrome', 1, 1, '2025-07-26 14:43:47', '2025-07-26 14:43:47'),
(18, '127.0.0.1', 'Chrome', 1, 1, '2025-07-28 16:36:20', '2025-07-28 16:36:20'),
(19, '127.0.0.1', 'Safari', 1, 1, '2025-07-30 18:13:13', '2025-07-30 18:13:13'),
(20, '127.0.0.1', 'Chrome', 1, 1, '2025-08-01 18:56:21', '2025-08-01 18:56:21'),
(21, '127.0.0.1', 'Chrome', 1, 1, '2025-08-02 15:20:26', '2025-08-02 15:20:26'),
(22, '127.0.0.1', 'Chrome', 2, 1, '2025-08-02 15:20:44', '2025-08-02 15:20:44'),
(23, '127.0.0.1', 'Chrome', 1, 1, '2025-08-02 15:21:08', '2025-08-02 15:21:08'),
(24, '127.0.0.1', 'Chrome', 1, 1, '2025-08-02 15:25:20', '2025-08-02 15:25:20'),
(25, '127.0.0.1', 'Safari', 2, 1, '2025-08-11 20:03:51', '2025-08-11 20:03:51'),
(26, '127.0.0.1', 'Safari', 1, 1, '2025-08-11 20:46:29', '2025-08-11 20:46:29'),
(27, '127.0.0.1', 'Chrome', 1, 1, '2025-08-13 13:11:56', '2025-08-13 13:11:56'),
(28, '127.0.0.1', 'Chrome', 1, 1, '2025-08-14 20:10:15', '2025-08-14 20:10:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lotes`
--

CREATE TABLE `lotes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `compra_id` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `precio_venta` decimal(10,3) NOT NULL DEFAULT 0.000,
  `pollos` int(11) NOT NULL DEFAULT 0,
  `valor_venta` decimal(10,3) NOT NULL DEFAULT 0.000,
  `valor_compra` decimal(10,3) NOT NULL DEFAULT 0.000,
  `cajas` decimal(10,3) NOT NULL DEFAULT 0.000,
  `valor_peso` decimal(10,3) NOT NULL DEFAULT 0.000,
  `fecha` date DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fin` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lotes_aves`
--

CREATE TABLE `lotes_aves` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `compra_ave_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `precio_venta` decimal(10,3) NOT NULL DEFAULT 0.000,
  `pollos` int(11) NOT NULL DEFAULT 0,
  `valor_venta` decimal(10,3) NOT NULL DEFAULT 0.000,
  `valor_compra` decimal(10,3) NOT NULL DEFAULT 0.000,
  `cajas` decimal(10,3) NOT NULL DEFAULT 0.000,
  `valor_peso` decimal(10,3) NOT NULL DEFAULT 0.000,
  `fecha` date DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `fin` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lote_aves_detalles`
--

CREATE TABLE `lote_aves_detalles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cajas` decimal(10,3) NOT NULL DEFAULT 0.000,
  `pollos` int(11) NOT NULL DEFAULT 0,
  `equivalente` decimal(10,3) NOT NULL DEFAULT 0.000,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `peso_total` decimal(10,3) NOT NULL DEFAULT 0.000,
  `lote_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `categoria_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `medida_producto_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `sub_medida_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `pigmento` int(11) NOT NULL DEFAULT 0,
  `compra_ave_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `producto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hora` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nro` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_nro` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `detalle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `compra_inventario_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `tipo_producto` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lote_detalles`
--

CREATE TABLE `lote_detalles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cajas` decimal(10,3) NOT NULL DEFAULT 0.000,
  `pollos` int(11) NOT NULL DEFAULT 0,
  `equivalente` decimal(10,3) NOT NULL DEFAULT 0.000,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `peso_total` decimal(10,3) NOT NULL DEFAULT 0.000,
  `lote_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `categoria_id` int(11) NOT NULL DEFAULT 1,
  `medida_producto_id` int(11) NOT NULL DEFAULT 1,
  `sub_medida_id` int(11) NOT NULL DEFAULT 1,
  `pigmento` int(11) NOT NULL DEFAULT 0,
  `compra_id` int(11) NOT NULL DEFAULT 1,
  `producto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hora` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nro` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_nro` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `detalle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `compra_inventario_id` int(11) NOT NULL DEFAULT 1,
  `tipo_producto` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lote_detalle_clientes`
--

CREATE TABLE `lote_detalle_clientes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nro` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cliente` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lote_detalle_id` int(11) NOT NULL DEFAULT 1,
  `cliente_id` int(11) NOT NULL DEFAULT 1,
  `lote_id` int(11) NOT NULL DEFAULT 1,
  `peso_bruto` decimal(10,3) NOT NULL DEFAULT 0.000,
  `tara` decimal(10,3) NOT NULL DEFAULT 0.000,
  `peso_neto` decimal(10,3) NOT NULL DEFAULT 0.000,
  `cont_e` decimal(10,3) NOT NULL DEFAULT 0.000,
  `cont_s` decimal(10,3) NOT NULL DEFAULT 0.000,
  `cont_sa` decimal(10,3) NOT NULL DEFAULT 0.000,
  `unit_e` decimal(10,3) NOT NULL DEFAULT 0.000,
  `unit_s` decimal(10,3) NOT NULL DEFAULT 0.000,
  `unit_sa` decimal(10,3) NOT NULL DEFAULT 0.000,
  `kgs_e` decimal(10,3) NOT NULL DEFAULT 0.000,
  `kgs_s` decimal(10,3) NOT NULL DEFAULT 0.000,
  `kgs_sa` decimal(10,3) NOT NULL DEFAULT 0.000,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `anulado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lote_detalle_compras`
--

CREATE TABLE `lote_detalle_compras` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `peso_bruto` decimal(10,3) NOT NULL,
  `peso_neto` decimal(10,3) NOT NULL,
  `lote_detalle_id` int(11) NOT NULL DEFAULT 1,
  `compra_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `anulado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lote_detalle_compras_aves`
--

CREATE TABLE `lote_detalle_compras_aves` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `peso_bruto` decimal(10,3) NOT NULL,
  `peso_neto` decimal(10,3) NOT NULL,
  `lote_detalle_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `compra_ave_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `anulado` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lote_detalle_historials`
--

CREATE TABLE `lote_detalle_historials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lote_detalle_id` int(11) NOT NULL DEFAULT 1,
  `lote_detalle_venta_id` int(11) NOT NULL DEFAULT 1,
  `lote_detalle_producto_id` int(11) NOT NULL DEFAULT 1,
  `lote_detalle_cliente_id` int(11) NOT NULL DEFAULT 1,
  `lote_detalle_seguimiento_id` int(11) NOT NULL DEFAULT 1,
  `lote_detalle_movimiento_id` int(11) NOT NULL DEFAULT 1,
  `lote_detalle_compra_id` int(11) NOT NULL DEFAULT 1,
  `venta_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lote_detalle_movimientos`
--

CREATE TABLE `lote_detalle_movimientos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `tipo` int(11) NOT NULL DEFAULT 1,
  `cajas` decimal(10,3) NOT NULL DEFAULT 0.000,
  `peso_bruto` decimal(10,3) NOT NULL DEFAULT 0.000,
  `peso_neto` decimal(10,3) NOT NULL DEFAULT 0.000,
  `cantidad` int(11) NOT NULL DEFAULT 0,
  `peso` decimal(10,3) NOT NULL DEFAULT 0.000,
  `lote_detalle_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `anulado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lote_detalle_productos`
--

CREATE TABLE `lote_detalle_productos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lote_id` int(11) DEFAULT NULL,
  `lote_detalle_id` int(11) DEFAULT NULL,
  `producto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pigmento` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hora` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nro` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_nro` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `detalle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `peso_bruto` decimal(10,3) NOT NULL DEFAULT 0.000,
  `tara` decimal(10,3) NOT NULL DEFAULT 0.000,
  `peso_neto` decimal(10,3) NOT NULL DEFAULT 0.000,
  `m1` decimal(10,3) NOT NULL DEFAULT 0.000,
  `m2` decimal(10,3) NOT NULL DEFAULT 0.000,
  `mermatotal` decimal(10,3) NOT NULL DEFAULT 0.000,
  `cajas_e` decimal(10,3) NOT NULL DEFAULT 0.000,
  `cajas_s` decimal(10,3) NOT NULL DEFAULT 0.000,
  `cajas_sa` decimal(10,3) NOT NULL DEFAULT 0.000,
  `und_e` decimal(10,3) NOT NULL DEFAULT 0.000,
  `und_s` decimal(10,3) NOT NULL DEFAULT 0.000,
  `und_sa` decimal(10,3) NOT NULL DEFAULT 0.000,
  `kg_e` decimal(10,3) NOT NULL DEFAULT 0.000,
  `kg_s` decimal(10,3) NOT NULL DEFAULT 0.000,
  `kg_sa` decimal(10,3) NOT NULL DEFAULT 0.000,
  `estado` int(11) NOT NULL DEFAULT 1,
  `tipo_mov` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `anulado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lote_detalle_seguimientos`
--

CREATE TABLE `lote_detalle_seguimientos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nro` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cliente` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `lote_detalle_id` int(11) NOT NULL DEFAULT 1,
  `peso_bruto` decimal(10,3) NOT NULL DEFAULT 0.000,
  `tara` decimal(10,3) NOT NULL DEFAULT 0.000,
  `peso_neto` decimal(10,3) NOT NULL DEFAULT 0.000,
  `cont_e` decimal(10,3) NOT NULL DEFAULT 0.000,
  `cont_s` decimal(10,3) NOT NULL DEFAULT 0.000,
  `cont_sa` decimal(10,3) NOT NULL DEFAULT 0.000,
  `unit_e` decimal(10,3) NOT NULL DEFAULT 0.000,
  `unit_s` decimal(10,3) NOT NULL DEFAULT 0.000,
  `unit_sa` decimal(10,3) NOT NULL DEFAULT 0.000,
  `kgs_e` decimal(10,3) NOT NULL DEFAULT 0.000,
  `kgs_s` decimal(10,3) NOT NULL DEFAULT 0.000,
  `kgs_sa` decimal(10,3) NOT NULL DEFAULT 0.000,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `anulado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lote_detalle_ventas`
--

CREATE TABLE `lote_detalle_ventas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `venta_id` int(11) NOT NULL DEFAULT 1,
  `lote_detalle_id` int(11) NOT NULL DEFAULT 1,
  `cajas` decimal(10,3) NOT NULL DEFAULT 0.000,
  `pollos` decimal(10,3) NOT NULL DEFAULT 0.000,
  `peso_total` decimal(10,3) NOT NULL DEFAULT 0.000,
  `peso_neto` decimal(10,3) NOT NULL DEFAULT 0.000,
  `peso_bruto` decimal(10,3) NOT NULL DEFAULT 0.000,
  `merma_bruta` decimal(10,3) NOT NULL DEFAULT 0.000,
  `merma_neta` decimal(10,3) NOT NULL DEFAULT 0.000,
  `fecha` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descomponer` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `back` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `precio_acuerdo` decimal(8,2) NOT NULL DEFAULT 0.00,
  `total` decimal(8,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lote_envio_pppts`
--

CREATE TABLE `lote_envio_pppts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lote_id` int(11) NOT NULL DEFAULT 1,
  `pp_detalle_id` int(11) NOT NULL DEFAULT 1,
  `pt_detalle_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lote_envio_pps`
--

CREATE TABLE `lote_envio_pps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lote_id` int(11) NOT NULL DEFAULT 1,
  `lote_detalle_id` int(11) NOT NULL DEFAULT 1,
  `pp_detalle_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lote_envio_pts`
--

CREATE TABLE `lote_envio_pts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lote_id` int(11) NOT NULL DEFAULT 1,
  `lote_detalle_id` int(11) NOT NULL DEFAULT 1,
  `lote_detalle_movimiento_id` int(11) NOT NULL DEFAULT 1,
  `pt_detalle_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lote_trozado_pps`
--

CREATE TABLE `lote_trozado_pps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lote_id` int(11) NOT NULL DEFAULT 1,
  `pp_detalle_id` int(11) NOT NULL DEFAULT 1,
  `trozado` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lote_trozado_pts`
--

CREATE TABLE `lote_trozado_pts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lote_id` int(11) NOT NULL DEFAULT 1,
  `pt_detalle_id` int(11) NOT NULL DEFAULT 1,
  `trozado` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medidas`
--

CREATE TABLE `medidas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `retraccion` decimal(8,3) NOT NULL DEFAULT 0.000,
  `tipo` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `medidas`
--

INSERT INTO `medidas` (`id`, `name`, `retraccion`, `tipo`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'CAJAS', '2.000', 1, 1, '2023-03-09 20:35:43', '2023-03-09 20:35:43'),
(2, 'UNIDAD', '0.000', 1, 1, '2023-03-09 20:36:38', '2023-03-09 20:36:51'),
(3, 'JAULA', '7.000', 1, 1, '2025-05-22 20:44:53', '2025-06-02 19:38:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medida_productos`
--

CREATE TABLE `medida_productos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `medida_id` int(11) NOT NULL DEFAULT 1,
  `producto_id` int(11) NOT NULL DEFAULT 1,
  `valor` decimal(8,3) NOT NULL DEFAULT 0.000,
  `estado` int(11) NOT NULL DEFAULT 1,
  `principal` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `medida_productos`
--

INSERT INTO `medida_productos` (`id`, `medida_id`, `producto_id`, `valor`, `estado`, `principal`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '15.000', 1, 1, '2023-03-10 00:39:51', '2023-03-28 22:57:56'),
(2, 2, 1, '0.000', 0, 1, '2023-03-28 23:01:09', '2023-03-28 23:01:13'),
(3, 1, 2, '15.000', 1, 1, '2023-03-28 23:02:25', '2023-03-28 23:02:25'),
(4, 2, 2, '0.000', 0, 1, '2023-03-28 23:02:50', '2023-03-28 23:03:00'),
(5, 1, 3, '0.000', 1, 1, '2023-10-26 15:31:06', '2023-10-26 15:31:06'),
(6, 1, 4, '1.000', 1, 1, '2023-10-26 15:32:35', '2023-10-26 15:32:35'),
(7, 1, 5, '0.000', 1, 1, '2024-06-20 17:30:55', '2024-06-20 17:30:55'),
(8, 1, 10, '15.000', 1, 1, '2024-11-07 09:24:01', '2024-11-07 09:24:01'),
(9, 1, 11, '15.000', 1, 1, '2024-11-07 09:24:52', '2024-11-07 09:24:52'),
(10, 1, 31, '0.000', 1, 1, '2025-02-11 21:21:09', '2025-02-11 21:21:09'),
(11, 1, 12, '0.000', 1, 1, '2025-02-11 21:22:00', '2025-02-11 21:22:00'),
(12, 1, 13, '0.000', 1, 1, '2025-02-11 21:22:37', '2025-02-11 21:22:37'),
(13, 1, 14, '0.000', 1, 1, '2025-02-11 21:22:59', '2025-02-11 21:22:59'),
(14, 1, 15, '0.000', 1, 1, '2025-02-11 21:23:25', '2025-02-11 21:23:25'),
(15, 1, 16, '0.000', 1, 1, '2025-02-11 21:23:52', '2025-02-11 21:23:52'),
(16, 1, 17, '0.000', 1, 1, '2025-02-11 21:24:26', '2025-02-11 21:24:26'),
(17, 1, 18, '0.000', 1, 1, '2025-02-11 21:24:59', '2025-02-11 21:24:59'),
(18, 1, 19, '0.000', 1, 1, '2025-02-11 21:25:25', '2025-02-11 21:25:25'),
(19, 1, 20, '0.000', 1, 1, '2025-02-11 21:27:43', '2025-02-11 21:27:43'),
(20, 1, 21, '0.000', 1, 1, '2025-02-11 21:28:05', '2025-02-11 21:28:05'),
(21, 1, 22, '0.000', 1, 1, '2025-02-11 21:28:51', '2025-02-11 21:28:51'),
(22, 1, 23, '0.000', 1, 1, '2025-02-11 21:32:20', '2025-02-11 21:32:20'),
(23, 1, 24, '0.000', 1, 1, '2025-02-11 21:32:41', '2025-02-11 21:32:41'),
(24, 1, 25, '0.000', 1, 1, '2025-02-11 21:33:17', '2025-02-11 21:33:17'),
(25, 1, 26, '0.000', 1, 1, '2025-02-11 21:33:50', '2025-02-11 21:33:50'),
(26, 1, 27, '0.000', 1, 1, '2025-02-11 21:34:12', '2025-02-11 21:34:12'),
(27, 1, 28, '0.000', 1, 1, '2025-02-11 21:34:45', '2025-02-11 21:34:45'),
(28, 1, 29, '0.000', 1, 1, '2025-02-11 21:35:20', '2025-02-11 21:35:20'),
(29, 3, 32, '8.000', 1, 1, '2025-05-23 00:46:08', '2025-05-24 00:21:44'),
(30, 1, 1, '0.000', 0, 1, '2025-07-22 13:49:41', '2025-07-22 13:49:50'),
(31, 3, 1, '0.000', 0, 1, '2025-07-22 15:36:35', '2025-07-22 15:36:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `memorandums`
--

CREATE TABLE `memorandums` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contrato_id` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `motivomemorandum_id` int(11) NOT NULL DEFAULT 1,
  `descripciom` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(144, '2014_10_12_000000_create_users_table', 1),
(145, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(146, '2023_01_06_222527_create_documentos_table', 1),
(147, '2023_01_16_055046_create_personas_table', 1),
(148, '2023_02_07_035249_create_tipocontratos_table', 1),
(149, '2023_02_07_035306_create_tipoarchivos_table', 1),
(150, '2023_02_07_035319_create_comprobantes_table', 1),
(151, '2023_02_07_035341_create_areas_table', 1),
(152, '2023_02_07_042909_create_sucursals_table', 1),
(153, '2023_02_07_083809_create_sucursal_tirajes_table', 1),
(154, '2023_02_08_043711_create_formapagos_table', 1),
(155, '2023_02_08_044238_create_parametrovacacions_table', 1),
(156, '2023_02_08_045135_create_costofijos_table', 1),
(157, '2023_02_08_050105_create_costovariables_table', 1),
(158, '2023_02_08_050353_create_proveedors_table', 1),
(159, '2023_02_08_051412_create_clientes_table', 1),
(160, '2023_02_08_052415_create_dotacions_table', 1),
(161, '2023_02_08_054036_create_stockdotacions_table', 1),
(162, '2023_02_08_054045_create_stockdotaciondetails_table', 1),
(163, '2023_02_08_085227_create_contratos_table', 1),
(164, '2023_02_08_085332_create_contratocostos_table', 1),
(165, '2023_02_08_100332_create_cogplanillas_table', 1),
(166, '2023_02_08_101818_create_planillas_table', 1),
(167, '2023_02_08_110401_create_planillacostos_table', 1),
(168, '2023_02_08_110508_create_adeudas_table', 1),
(169, '2023_02_08_110538_create_adeudacuotas_table', 1),
(170, '2023_02_08_121034_create_finiquitoanuals_table', 1),
(171, '2023_02_08_121046_create_finianualdetalles_table', 1),
(172, '2023_02_08_135142_create_finiquinqueniodetalles_table', 1),
(173, '2023_02_08_135156_create_finiquinquenios_table', 1),
(174, '2023_02_08_142039_create_finivacacionals_table', 1),
(175, '2023_02_08_142048_create_finivacacionaldetalles_table', 1),
(176, '2023_02_08_145129_create_finiaguinaldos_table', 1),
(177, '2023_02_08_145143_create_finiaguinaldodetalles_table', 1),
(178, '2023_02_08_164047_create_liquidacions_table', 1),
(179, '2023_02_08_174637_create_ajustedotacions_table', 1),
(180, '2023_02_08_174646_create_ajustedotaciondetalles_table', 1),
(181, '2023_02_08_183932_create_salidadotacioncontratos_table', 1),
(182, '2023_02_08_184016_create_salidotacontradetas_table', 1),
(183, '2023_02_08_193825_create_devosalidotacontras_table', 1),
(184, '2023_02_08_205153_create_redotacions_table', 1),
(185, '2023_02_08_205215_create_redotaciondetalles_table', 1),
(186, '2023_02_08_222001_create_salidadotaclientes_table', 1),
(187, '2023_02_08_222017_create_salidadotaclidetalles_table', 1),
(188, '2023_02_09_024211_create_logs_table', 1),
(189, '2023_02_09_033057_create_files_table', 1),
(190, '2023_02_09_033106_create_filepersonas_table', 1),
(191, '2023_02_09_033114_create_filesucursals_table', 1),
(192, '2023_02_09_083959_create_planillaservicios_table', 1),
(193, '2023_02_09_084027_create_planillaserviciocostos_table', 1),
(194, '2023_02_09_105314_create_motivomemorandums_table', 1),
(195, '2023_02_09_105345_create_memorandums_table', 1),
(196, '2023_02_10_151322_add_telefono_to_personas_table', 2),
(197, '2023_02_10_203140_create_finivacacionalplanillas_table', 3),
(216, '2023_02_12_164606_create_categorias_table', 4),
(217, '2023_02_12_164630_create_medidas_table', 4),
(218, '2023_02_12_164704_create_productos_table', 4),
(219, '2023_02_12_164724_create_medida_productos_table', 4),
(220, '2023_02_12_164845_create_sub_medidas_table', 4),
(221, '2023_02_15_173911_create_compras_table', 4),
(222, '2023_02_15_184324_create_inventarios_table', 4),
(226, '2023_02_15_191321_create_compra_inventarios_table', 5),
(227, '2023_02_17_194130_create_almacens_table', 5),
(228, '2023_02_19_154959_create_adeuda_planillas_table', 5),
(229, '2023_03_10_062557_create_consolidacionparams_table', 6),
(230, '2023_03_10_114300_create_tipoclientes_table', 7),
(232, '2023_03_10_132705_add_tipo_to_clientes_table', 8),
(234, '2023_03_22_040031_create_consolidacions_table', 9),
(235, '2023_03_22_042841_create_consolidacion_detalles_table', 10),
(236, '2023_03_22_053808_create_bancos_table', 11),
(238, '2023_03_22_072853_create_consolidacion_pagos_table', 12),
(239, '2023_03_23_003222_create_consolidacion_pago_detalles_table', 12),
(240, '2023_03_27_014828_add_nro_to_compras_table', 13),
(241, '2023_03_27_054139_add_user_to_consolidacion_pagos_table', 14),
(242, '2023_03_28_045339_create_proveedor_compras_table', 15),
(243, '2023_03_28_060930_add_proveedor_to_compras_table', 16),
(967, '2023_03_28_112007_add_observacion_to_planillas_table', 17),
(968, '2023_03_28_112404_add_observacion_to_planillaservicios_table', 17),
(969, '2023_03_30_061716_create_consolidacion_pago_tickets_table', 17),
(970, '2023_04_02_075136_create_caja_proveedors_table', 17),
(971, '2023_04_02_081430_create_cajas_table', 17),
(972, '2023_04_03_070652_create_compra_cajas_table', 17),
(973, '2023_04_03_073419_create_caja_inventarios_table', 17),
(974, '2023_04_03_073437_create_compra_caja_detalles_table', 17),
(975, '2023_04_03_090502_create_traspaso_cajas_table', 17),
(976, '2023_04_04_162214_add_cinta_to_categorias_table', 17),
(977, '2023_04_04_163048_add_cinta_to_compra_inventarios_table', 17),
(978, '2023_04_04_222731_create_caja_envios_table', 17),
(979, '2023_04_04_230554_add_fecha_to_compras_table', 17),
(980, '2023_04_05_002352_create_caja_compras_table', 17),
(981, '2023_04_06_073257_create_caja_ajustes_table', 17),
(982, '2023_04_06_073311_create_caja_ajuste_detalles_table', 17),
(983, '2023_04_09_191353_add_telefone_to_clientes_table', 17),
(984, '2023_04_09_193413_create_cliente_files_table', 17),
(985, '2023_04_11_005539_add_pagado_to_compra_cajas_table', 17),
(986, '2023_04_11_010856_create_pago_compra_cajas_table', 17),
(987, '2023_04_12_064415_create_compo_internas_table', 17),
(988, '2023_04_15_072538_create_lotes_table', 17),
(989, '2023_04_15_080653_create_lote_detalles_table', 17),
(990, '2023_04_17_012604_add_original_to_compra_inventarios_table', 17),
(991, '2023_04_17_033057_add_validar_to_compras_table', 17),
(992, '2023_04_17_041948_create_validar_cajas_table', 17),
(993, '2023_04_17_051053_add_chofer_to_validar_cajas_table', 17),
(994, '2023_04_19_091037_create_validar_caja_detalles_table', 17),
(995, '2023_04_23_043214_create_pp_detalles_table', 17),
(996, '2023_05_04_071449_create_compo_externas_table', 17),
(997, '2023_05_04_074117_create_compo_externa_detalles_table', 17),
(998, '2023_05_07_024723_create_informe_preliminars_table', 17),
(999, '2023_05_07_045055_create_informe_detalles_table', 17),
(1000, '2023_05_11_061201_create_pp_detalle_descomposicions_table', 17),
(1001, '2023_05_12_063811_create_pt_detalles_table', 17),
(1002, '2023_05_13_080215_create_pp_pts_table', 17),
(1003, '2023_05_14_054726_create_pt_detalle_descomposicions_table', 17),
(1004, '2023_05_14_064619_create_pt_detalle_sub_descomposicions_table', 17),
(1005, '2023_05_15_041141_create_lote_envio_pps_table', 17),
(1006, '2023_05_15_072307_create_lote_trozado_pps_table', 17),
(1007, '2023_05_15_080410_create_lote_envio_pppts_table', 17),
(1008, '2023_05_18_161353_create_lote_detalle_movimientos_table', 17),
(1009, '2023_05_18_163739_add_lote_detalle_to_pp_detalles_table', 17),
(1010, '2023_05_20_083235_add_cinta_to_lote_detalles_table', 17),
(1011, '2023_05_20_094625_add_back_to_pt_detalles_table', 17),
(1012, '2023_05_20_163542_create_lote_envio_pts_table', 17),
(1013, '2023_05_21_195204_create_lote_trozado_pts_table', 17),
(1014, '2023_05_21_215227_create_sub_des_pt_detalle_descos_table', 17),
(1015, '2023_05_22_023645_create_bitacora_lotes_table', 17),
(1016, '2023_05_23_061201_create_compo_interna_files_table', 17),
(1017, '2023_05_23_061249_create_compo_externa_files_table', 17),
(1018, '2023_05_24_033232_create_cinta_clientes_table', 17),
(1019, '2023_05_25_191709_add_lote_to_pp_detalle_descomposicions_table', 17),
(1020, '2023_05_26_021821_add_lote_to_pt_detalle_descomposicions_table', 17),
(1021, '2023_06_05_052125_create_caja_sucursals_table', 17),
(1022, '2023_06_05_061214_create_caja_sucursal_usuarios_table', 17),
(1023, '2023_06_05_070009_create_caja_motivos_table', 17),
(1024, '2023_06_06_044229_create_pps_table', 17),
(1025, '2023_06_06_060647_create_detalle_pps_table', 17),
(1026, '2023_06_06_070323_create_detalle_pp_descomposicions_table', 17),
(1027, '2023_06_06_210019_add_abreviatura_to_proveedor_compras_table', 17),
(1028, '2023_06_08_070926_add_fin_to_lotes_table', 17),
(1029, '2023_06_09_064720_create_items_table', 17),
(1030, '2023_06_09_064825_create_item_files_table', 17),
(1031, '2023_06_09_081113_create_lote_detalle_seguimientos_table', 17),
(1032, '2023_06_09_135825_create_banderas_table', 17),
(1033, '2023_06_09_201107_create_pts_table', 17),
(1034, '2023_06_09_204257_create_detalle_pts_table', 17),
(1035, '2023_06_09_232159_create_detalle_pt_descomposicions_table', 17),
(1036, '2023_06_12_040817_add_tipo_to_items_table', 17),
(1037, '2023_06_12_093636_create_traspaso_pps_table', 17),
(1038, '2023_06_12_101837_create_sobra_pps_table', 17),
(1039, '2023_06_12_101947_create_sobra_detalle_pps_table', 17),
(1040, '2023_06_13_051530_create_pp_traspaso_pps_table', 17),
(1041, '2023_06_13_073345_create_pt_traspaso_pps_table', 17),
(1042, '2023_06_13_085142_create_pt_sobra_pps_table', 17),
(1043, '2023_06_14_082225_create_sub_des_detalle_pts_table', 17),
(1044, '2023_06_16_035622_create_envio_gen_pps_table', 17),
(1045, '2023_06_16_035732_create_envio_gen_pp_detalles_table', 17),
(1046, '2023_06_16_055104_create_envio_gen_pts_table', 17),
(1047, '2023_06_16_055116_create_envio_gen_pt_detalles_table', 17),
(1048, '2023_06_16_110823_create_traspaso_pp_detalles_table', 17),
(1049, '2023_06_16_115112_create_traspaso_pp_envios_table', 17),
(1050, '2023_06_16_123554_add_fecha_to_traspaso_pp_table', 17),
(1051, '2023_06_17_165317_create_venta_detalle_pps_table', 17),
(1052, '2023_06_17_165800_create_ventas_table', 17),
(1053, '2023_06_17_212937_create_descomponer_pts_table', 17),
(1054, '2023_06_17_213154_create_items_pts_table', 17),
(1055, '2023_06_20_071102_add_tipocinta_id_to_clientes_table', 17),
(1056, '2023_06_20_140102_create_lote_detalle_ventas_table', 17),
(1057, '2023_06_22_061446_create_chofers_table', 17),
(1058, '2023_06_23_054156_add_item_id__to_venta_detalle_pps_table', 17),
(1059, '2023_06_23_061838_add_sucursal_id_to_ventas_table', 17),
(1060, '2023_06_25_023122_create_venta_items_pts_table', 17),
(1061, '2023_06_25_072711_add_precios_to_items_table', 17),
(1062, '2023_06_25_080858_create_monedas_table', 17),
(1063, '2023_06_25_111200_create_arqueos_table', 17),
(1064, '2023_06_25_120518_create_arqueo_ingresos_table', 17),
(1065, '2023_06_25_145827_create_item_precios_table', 17),
(1066, '2023_06_25_164655_create_cambio_precios_table', 17),
(1067, '2023_07_01_205608_create_venta_turno_chofers_table', 17),
(1068, '2023_07_01_225446_add_placa_to_chofers_table', 17),
(1069, '2023_07_01_225852_create_estado_compra_chofers_table', 17),
(1070, '2023_07_01_225924_add_estado_compra_chofer_id_to_chofers_table', 17),
(1071, '2023_07_01_235549_create_turno_chofers_table', 17),
(1072, '2023_07_02_014840_add_fecha_to_ventas_table', 17),
(1073, '2023_07_02_091516_create_producto_precios_table', 17),
(1074, '2023_07_02_102919_create_producto_precio_sucursals_table', 17),
(1075, '2023_07_02_103036_create_producto_precio_cambios_table', 17),
(1076, '2023_07_02_134819_add_dinero_cuenta_to_clientes_table', 17),
(1077, '2023_07_04_030207_create_pollolimpios_table', 17),
(1078, '2023_07_04_031909_create_pollolimpio_cambios_table', 17),
(1079, '2023_07_04_032005_create_pollolimpio_sucursals_table', 17),
(1080, '2023_07_04_122905_create_pollo_sucursals_table', 17),
(1081, '2023_07_04_133755_create_item_pollos_table', 17),
(1082, '2023_07_04_211939_create_promedio_pollolimpios_table', 17),
(1083, '2023_07_06_065946_create_pedido_clientes_table', 17),
(1084, '2023_07_06_074858_create_pedido_cliente_detalles_table', 17),
(1085, '2023_07_06_134552_add_venta_to_producto_precio_sucursals_table', 17),
(1086, '2023_07_06_140506_add_fechatime_to_producto_precio_sucursals_table', 17),
(1087, '2023_07_06_140638_add_fechatime_to_producto_precio_sucursals_table', 17),
(1088, '2023_07_06_153516_add_fechatime_to_producto_precio_sucursals_table', 17),
(1089, '2023_07_06_175914_add_fechatime_to_pollolimpio_sucursals_table', 17),
(1090, '2023_07_06_180010_add_fechatime_to_pollolimpio_sucursals_table', 17),
(1091, '2023_07_09_190637_create_transformacions_table', 17),
(1092, '2023_07_09_194526_create_transformacion_items_table', 17),
(1093, '2023_07_09_220926_create_transformacion_detalles_table', 17),
(1094, '2023_07_11_040737_create_transformacion_detalle_sucursals_table', 17),
(1095, '2023_07_11_064723_create_transformacion_sucursals_table', 17),
(1096, '2023_07_11_164704_add_user_id_to_producto_precio_cambios_table', 17),
(1097, '2023_07_11_164742_add_user_id_to_pollolimpio_cambios_table', 17),
(1098, '2023_07_11_234709_add_precio_cbba_to_producto_precio_sucursals_table', 17),
(1099, '2023_07_11_234747_add_precio_cbba_to_pollolimpio_sucursals_table', 17),
(1100, '2023_07_18_014435_create_acuerdo_clientes_table', 17),
(1101, '2023_07_18_014648_create_cajacerrada_clientes_table', 17),
(1102, '2023_07_18_025330_add_acuerdo_cliente_id_to_clientes_table', 17),
(1103, '2023_07_18_030931_add_aprobado_id_to_clientes_table', 17),
(1104, '2023_07_18_064315_create_tipo_cliente_pps_table', 17),
(1105, '2023_07_18_064348_create_tipo_cliente_pp_limpios_table', 17),
(1106, '2023_07_18_070922_add_aprobado_id_to_clientes_table', 17),
(1107, '2023_07_18_073941_add_aprobado_id_to_clientes_table', 17),
(1108, '2023_08_04_064004_add_pigmento_to_compra_inventarios_table', 17),
(1109, '2023_08_08_035031_add_pigmento_to_lote_detalles_table', 17),
(1110, '2023_08_14_235133_add_categoria_id_to_proveedor_compras_table', 17),
(1111, '2023_08_16_040641_create_proveedor_compra_medidas_table', 17),
(1112, '2023_08_24_025524_add_compra_id_to_lote_detalles_table', 17),
(1113, '2023_08_24_040107_create_lote_detalle_compras_table', 17),
(1114, '2023_08_24_225607_create_lote_detalle_clientes_table', 17),
(1115, '2023_08_29_013744_add_producto_to_lote_detalles_table', 17),
(1116, '2023_08_29_025850_create_lote_detalle_productos_table', 17),
(1117, '2023_08_29_221340_create_proveedor_categorias_table', 17),
(1118, '2023_08_30_004522_create_proveedor_categoria_detalles_table', 17),
(1119, '2023_09_03_222756_add_id_nro_to_lote_detalle_productos_table', 17),
(1120, '2023_09_03_223623_add_id_nro_to_lote_detalles_table', 17),
(1121, '2023_09_12_133338_add_id_inactivo_to_proveedor_compras_table', 17),
(1122, '2023_09_13_053403_add_hora_to_lote_detalles_table', 17),
(1123, '2023_09_13_053827_add_hora_to_lote_detalle_clientes_table', 17),
(1124, '2023_09_13_054017_add_hora_to_lote_detalle_productos_table', 17),
(1125, '2023_09_27_095855_add_compra_id_to_consolidacion_detalles_table', 17),
(1126, '2023_10_17_074646_add_tipo_pollo_to_compra_inventarios_table', 17),
(1127, '2023_11_09_230816_create_cambio_precio_consolidacions_table', 17),
(1128, '2023_11_13_230747_add_formapago_id_to_consolidacion_pagos_table', 17),
(1129, '2023_11_14_131753_add_formapago_id_to_consolidacion_pago_tickets_table', 17),
(1130, '2023_11_19_201523_add_titular_to_bancos_table', 17),
(1131, '2023_11_27_103927_add_peso_inicial_tipo_to_pps_table', 17),
(1132, '2023_11_27_104414_add_peso_inicial_tipo_to_pp_detalles_table', 17),
(1133, '2023_11_27_112227_add_peso_inicial_tipo_to_detalle_pps_table', 17),
(1134, '2023_11_28_103038_add_cinta_cliente_tipo_to_traspaso_pps_table', 17),
(1135, '2023_11_28_105231_add_cinta_cliente_id_to_pp_traspaso_pps_table', 17),
(1136, '2023_11_29_111202_create_desplegue_pps_table', 17),
(1137, '2023_12_01_113009_add_nro_compra_to_compras_table', 17),
(1138, '2023_12_13_105934_add_cinta_cliente_to_venta_detalle_pps_table', 17),
(1139, '2023_12_15_113056_add_obs_to_compras_table', 17),
(1140, '2024_01_05_115318_add_peso_neto_to_pt_detalles_table', 18),
(1141, '2024_01_06_123126_add_nro_traspaso_to_sobra_pps_table', 19),
(1142, '2024_01_11_113313_add_editado_to_compra_inventarios_table', 20),
(1143, '2024_01_12_121643_add_peso_inicial_tipo_to_detalle_pts_table', 21),
(1144, '2024_01_12_123018_add_peso_inicial_tipo_to_pts_table', 22),
(1145, '2024_01_12_134608_add_user_id_to_detalle_pts_table', 23),
(1146, '2024_01_17_114409_add_fin_to_compras_table', 24),
(1147, '2024_01_17_115732_add_name_to_compras_inventarios_table', 25),
(1148, '2024_01_19_130502_add_compra_detalle_id_to_lote_detalles_table', 26),
(1149, '2024_02_16_095959_add_recep_to_items_pts_table', 27),
(1150, '2024_02_17_033911_create_promedio_mermas_table', 28),
(1151, '2024_03_01_085029_add_pigmento_to_traspaso_pps_table', 29),
(1152, '2024_03_01_085331_add_pigmento_to_desplegue_pps_table', 30),
(1153, '2024_03_01_085416_add_pigmento_to_traspaso_pp_envios_table', 30),
(1154, '2024_03_01_085431_add_pigmento_to_traspaso_pp_detalles_table', 30),
(1155, '2024_03_01_103233_create_venta_cerradas_table', 31),
(1156, '2024_03_01_103317_create_venta_pts_table', 31),
(1157, '2024_03_01_103352_create_venta_pps_table', 31),
(1158, '2024_03_14_175003_add_user_id_to_pp_traspaso_pps_table', 32),
(1159, '2024_03_15_192517_add_user_id_to_sobra_detalle_pps_table', 33),
(1162, '2024_04_16_073459_create_lote_detalle_historials_table', 34),
(1163, '2024_04_19_021049_add_anulado_to_lote_detalle_compras_table', 35),
(1164, '2024_04_19_021233_add_anulado_to_lote_detalle_seguimientos_table', 35),
(1165, '2024_04_19_021355_add_anulado_to_lote_detalle_movimientos_table', 35),
(1166, '2024_04_19_021450_add_anulado_to_lote_detalle_clientes_table', 35),
(1167, '2024_04_19_021531_add_anulado_to_lote_detalle_productos_table', 35),
(1170, '2024_05_08_155200_create_item_sobra_pts_table', 36),
(1172, '2024_05_08_181213_create_item_pt_movimientos_table', 37),
(1173, '2024_06_01_013516_create_tipopagos_table', 38),
(1175, '2024_06_01_015009_add_tipo_id_to_clientes_table', 39),
(1176, '2024_06_03_234449_add_acuerdo_cliente_id_to_ventas_table', 40),
(1177, '2024_06_03_235128_add_precio_to_lote_detalle_ventas_table', 41),
(1178, '2024_06_04_000833_add_precio_to_venta_detalle_pps_table', 42),
(1179, '2024_06_06_080643_add_precio_to_venta_items_pts_table', 43),
(1180, '2024_06_07_110907_add_digitar_to_acuerdo_clientes_table', 44),
(1181, '2024_06_08_041641_add_caja_cerrada_to_cliente_table', 45),
(1182, '2024_06_17_115156_create_familias_table', 46),
(1183, '2024_06_17_120651_add_familia_id_to_dotacions_tables', 47),
(1185, '2024_06_17_132305_create_kardex_dotacions_table', 48),
(1186, '2024_06_17_142841_add_sucursal_id_to_stock_dotacion_details_table', 49),
(1187, '2024_06_17_152825_add_fechatime_to_kardex_dotacions_table', 50),
(1188, '2024_06_17_161940_create_traspaso_dotacions_table', 51),
(1189, '2024_06_17_161957_create_traspaso_dotacion_detalles_table', 51),
(1190, '2024_06_24_233352_add_lote_to_stockdotacions_table', 52),
(1191, '2024_06_24_233513_add_lote_to_stockdotaciondetails_table', 52),
(1192, '2024_06_25_012716_add_familia_id_to_kardex_dotacions_table', 53),
(1196, '2024_07_04_061344_create_cliente_cajacerradas_table', 54),
(1197, '2024_07_04_061453_create_cliente_pps_table', 54),
(1198, '2024_07_04_061524_create_cliente_pts_table', 54),
(1199, '2024_07_16_110424_add_tipo_to_productos_table', 55),
(1200, '2024_07_16_114316_add_tipo_producto_to_lote_detalles_table', 56),
(1201, '2024_07_24_031110_add_venta_7_to_producto_precioss_table', 57),
(1202, '2024_07_26_015058_create_sub_items_table', 58),
(1203, '2024_07_26_043153_create_producto_precio_lotes_table', 59),
(1204, '2024_07_30_020656_add_venta_7_to_producto_precio_sucursals_table', 60),
(1205, '2024_07_30_035545_create_trans_items_table', 61),
(1206, '2024_07_30_043601_create_trans_item_detalles_table', 62),
(1207, '2024_07_30_230525_add_iva_to_clientes_table', 63),
(1208, '2024_08_02_042214_add_suma_to_trans_items_table', 64),
(1209, '2024_08_02_074558_create_transformacion_lotes_table', 65),
(1212, '2024_08_02_130059_create_trans_especials_table', 66),
(1213, '2024_08_02_130357_create_trans_especial_items_table', 66),
(1220, '2024_08_06_083521_create_pp_envio_transformacions_table', 67),
(1221, '2024_08_06_083844_create_pp_envio_transformacion_detalles_table', 67),
(1223, '2024_08_06_103031_create_transformacion_lote_detalles_table', 68),
(1224, '2024_08_08_090923_create_enviar_item_pt_transformacions_table', 69),
(1225, '2024_08_08_134844_create_transformacion_lote_items_table', 70),
(1226, '2024_08_15_025041_create_descomponer_transformacion_lotes_table', 71),
(1228, '2024_08_21_023459_add_pt_id_to_transformacion_lote_items_table', 72),
(1229, '2024_08_23_213153_create_item_pt_transformacion_lotes_table', 73),
(1235, '2024_08_25_091102_create_sub_item_pt_transformacion_lotes_table', 74),
(1236, '2024_08_26_043912_add_merma_to_items_table', 74),
(1237, '2024_08_27_060516_add_cierre_to_item_pt_transformacion_lotes_table', 74),
(1238, '2024_09_09_001421_add_descuento_to_producto_precios_table', 75),
(1239, '2024_09_09_003732_add_descuento_to_producto_precio_sucursals_table', 75),
(1240, '2024_09_11_100540_add_descuento_to_item_pollos_table', 76),
(1241, '2024_09_11_100816_add_descuento_to_sub_items_table', 76),
(1244, '2024_09_18_014831_create_venta_transformacions_table', 77),
(1249, '2024_09_20_040701_add_precio_to_producto_precio_sucursals_table', 78),
(1250, '2024_09_20_040912_add_precio_to_producto_precios_table', 78),
(1251, '2024_11_07_000906_add_nro_orden_to_sub_medidas_table', 79),
(1252, '2024_11_13_025011_create_zona_despachos_table', 80),
(1253, '2024_11_13_030544_create_tipo_negocios_table', 80),
(1254, '2024_11_13_032151_create_forma_pedidos_table', 80),
(1255, '2024_11_13_035933_add_forma_pedido_id_to_clientes_table', 81),
(1256, '2024_11_13_161140_add_horario_preferencia_id_to_clientes_table', 82),
(1257, '2024_11_15_145424_add_horario_pedido_to_clientes_table', 83),
(1258, '2024_11_15_162441_add_chofer_id_to_clientes_table', 84),
(1259, '2025_02_13_115144_create_documentacions_table', 85),
(1260, '2025_04_15_035526_create_caja_entradas_table', 86),
(1261, '2025_04_16_014918_create_caja_venta_clientes_table', 87),
(1264, '2025_05_15_134428_add_metodo_pago_to_ventas_table', 88),
(1265, '2025_05_16_163150_add_total_to_ventas_table', 89),
(1266, '2025_05_16_170548_add_pagado_total_to_ventas_table', 90),
(1267, '2025_05_12_114917_create_filemonedas_table', 91),
(1734, '2025_05_20_200218_create_despacho_arqueos_table', 92),
(1735, '2025_05_21_161952_add_destino_stock_to_validar_caja_detalles_table', 92),
(1736, '2025_05_22_171128_create_compras_aves_table', 92),
(1737, '2025_05_23_113130_create_lotes_aves_table', 92),
(1738, '2025_05_23_113256_create_lote_aves_detalles_table', 92),
(1739, '2025_05_23_113638_create_lote_detalle_compras_aves_table', 92),
(1740, '2025_05_23_114733_create_ave_inventarios_table', 92),
(1741, '2025_05_23_114842_create_compra_ave_inventarios_table', 92),
(1742, '2025_05_23_182140_create_arqueo_ventas_table', 92),
(1743, '2025_05_24_115803_add_sum_precio_to_compras_aves', 92),
(1744, '2025_05_26_174302_add_observaciones_and_detalle_billetaje_to_arqueos_table', 92),
(1745, '2025_05_31_112226_create_caja_compras_aves_table', 92),
(1746, '2025_05_31_112729_create_consolidacions_ave_table', 92),
(1747, '2025_05_31_115052_create_consolidacionave_pagos_table', 92),
(1748, '2025_05_31_115307_create_consolidacionave_pago_detalles_table', 92),
(1749, '2025_05_31_115425_create_consolidacionave_pago_tickets_table', 92),
(1750, '2025_06_02_105454_create_consolidacion_ave_detalles_table', 92),
(1751, '2025_06_03_181756_create_cambio_precio_consolidacion_aves_table', 92),
(1752, '2025_06_05_120504_add_detalle_gastos_to_consolidacions_ave_table', 92),
(1753, '2025_06_05_120530_add_detalle_gastos_to_consolidacions_table', 92),
(1754, '2025_06_05_150605_create_gastos_extras_aves_table', 92),
(1755, '2025_06_06_005911_create_venta_cajas_table', 93),
(1756, '2025_06_09_001724_create_entrega_cajas_table', 93),
(1757, '2025_06_09_152851_create_entrega_cajas_recuperadas_table', 93),
(1758, '2025_06_09_153833_add_saldos_to_entrega_cajas_table', 93),
(1759, '2025_06_10_173021_update_decimal_valor_total_to_consolidacions_ave_table', 94),
(1760, '2025_06_10_173348_update_decimal_suma_total_adelanto_to_consolidacionave_pagos_table', 94),
(1761, '2025_06_10_173500_update_decimal_total_monto_pendiente_deuda_to_consolidacionave_pago_tickets_table', 94),
(1762, '2025_06_10_173547_update_decimal_precio_precio_compra_to_consolidacion_ave_detalles_table', 94),
(1763, '2025_06_10_173624_update_decimal_precio_anterior_precio_actual_to_cambio_precio_consolidacion_aves_table', 94),
(1764, '2025_06_11_123142_add_entrega_id_to_entrega_cajas_recuperadas_table', 95),
(1765, '2025_06_11_164524_add_tipo_to_proveedor_compras', 95),
(1836, '2025_06_12_150127_create_consolidacions_ave_new_table', 96),
(1837, '2025_06_12_151958_create_consolidacionavenew_pagos_table', 96),
(1838, '2025_06_12_152146_create_consolidacionavenew_pago_detalles_table', 96),
(1839, '2025_06_12_152247_create_consolidacionavenew_pago_tickets_table', 96),
(1840, '2025_06_12_152410_create_consolidacion_ave_new_detalles_table', 96),
(1841, '2025_06_12_152602_create_cambio_precio_consolidacion_aves_new_table', 96),
(1842, '2025_06_12_152724_add_detalle_gastos_to_consolidacions_ave_new_table', 96),
(1843, '2025_06_13_101550_update_consolidacions_ave_new_and_detalles_tables', 96),
(1844, '2025_06_14_115740_add_chofer_id_to_entrega_cajas_table', 97),
(1845, '2025_06_14_115917_add_chofer_id_to_entrega_cajas_recuperadas_table', 97),
(1846, '2025_06_16_144537_add_observacion_to_consolidacion_ave_new_detalles_table', 98),
(1850, '2025_06_18_155335_add_valor_aves_muertas_to_consolidacion_ave_new_detalles', 99),
(1851, '2025_06_27_152630_create_subdetalle_descuento_acuerdo_table', 100),
(1904, '2025_07_10_165752_add_estado_precios_to_producto_precio_sucursals_and_producto_precios', 101),
(1905, '2025_07_25_153327_add_alternativos_to_item_pollos', 101),
(1906, '2025_07_25_172807_add_alternativos_to_trans_item_detalles', 101),
(1907, '2025_07_25_172833_add_alternativos_to_trans_especial_items', 101),
(1908, '2025_07_28_150058_add_precio_sucursal_to_producto_precio_sucursals_and_producto_precios', 101),
(1909, '2025_07_30_095533_add_tipo_pt_and_tipo_trans_to_clientes_table', 101),
(1910, '2025_07_31_110101_create_pagos_globales_table', 101),
(1911, '2025_07_31_110127_create_arqueo_venta_pago_global_table', 101),
(1912, '2025_08_07_203427_create_venta_acuerdos_table', 102),
(1913, '2025_08_07_204815_create_venta_gastos_table', 102),
(1914, '2025_08_09_000445_add_venta_id_to_entrega_cajas_table', 103),
(1917, '2025_08_09_010859_add_print_flags_to_multiple_tables', 104),
(1918, '2025_08_11_145749_add_preventista_id_to_ventas_table', 105),
(1919, '2025_08_11_160909_add_entregado_to_ventas_table', 106),
(1920, '2025_08_13_105841_create_permission_tables', 107),
(1921, '2025_08_14_135051_add_distribuidor_id_to_clientes_ventas_table', 107);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `monedas`
--

CREATE TABLE `monedas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `valor` decimal(10,3) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `monedas`
--

INSERT INTO `monedas` (`id`, `name`, `valor`, `estado`, `created_at`, `updated_at`) VALUES
(1, '10 ctvos', '0.100', 0, '2025-05-26 18:44:21', '2025-05-26 20:43:46'),
(2, '20 ctvs', '0.200', 0, '2025-05-26 20:38:12', '2025-05-26 20:43:49'),
(3, '10 ctvs', '0.100', 1, '2025-05-26 20:44:03', '2025-05-26 20:44:03'),
(4, '20 ctvs', '0.200', 1, '2025-05-26 22:17:36', '2025-05-26 22:17:36'),
(5, '50 ctvs', '0.500', 1, '2025-05-26 22:17:45', '2025-05-26 22:17:45'),
(6, 'bb', '0.500', 0, '2025-05-26 22:17:51', '2025-05-26 22:17:55'),
(7, '1 BS', '1.000', 1, '2025-05-26 22:18:01', '2025-05-26 22:18:01'),
(8, '2 BS', '2.000', 1, '2025-05-26 22:18:08', '2025-05-26 22:18:08'),
(9, '5 BS', '5.000', 1, '2025-05-26 22:18:13', '2025-05-26 22:18:13'),
(10, '10 BS', '10.000', 1, '2025-05-26 22:18:21', '2025-05-26 22:18:21'),
(11, '20 BS', '20.000', 1, '2025-05-27 13:35:40', '2025-05-27 13:35:40'),
(12, '50 BS', '50.000', 1, '2025-05-27 13:35:49', '2025-05-27 13:35:49'),
(13, '100 BS', '100.000', 1, '2025-05-27 13:35:56', '2025-05-27 13:35:56'),
(14, '200 BS', '200.000', 1, '2025-05-27 13:36:07', '2025-05-27 13:36:07'),
(15, '500 bs', '500.000', 0, '2025-05-27 20:28:13', '2025-05-27 20:29:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `motivomemorandums`
--

CREATE TABLE `motivomemorandums` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `motivomemorandums`
--

INSERT INTO `motivomemorandums` (`id`, `name`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'MOTIVO', 1, '2023-02-09 16:27:12', '2023-02-09 16:27:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos_globales`
--

CREATE TABLE `pagos_globales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `formapago_id` int(11) NOT NULL DEFAULT 1,
  `monto_total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ticket_first_printed_at` timestamp NULL DEFAULT NULL,
  `ticket_print_count` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago_compra_cajas`
--

CREATE TABLE `pago_compra_cajas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `compra_caja_id` int(11) NOT NULL DEFAULT 1,
  `total` decimal(10,3) NOT NULL DEFAULT 0.000,
  `monto` decimal(10,3) NOT NULL DEFAULT 0.000,
  `pendiente` decimal(10,3) NOT NULL DEFAULT 0.000,
  `deuda` decimal(10,3) NOT NULL DEFAULT 0.000,
  `banco_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parametrovacacions`
--

CREATE TABLE `parametrovacacions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `desde` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hasta` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dias` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `parametrovacacions`
--

INSERT INTO `parametrovacacions` (`id`, `desde`, `hasta`, `dias`, `estado`, `created_at`, `updated_at`) VALUES
(1, '1', '3', '7', 1, '2023-02-11 01:19:38', '2023-02-11 01:19:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_clientes`
--

CREATE TABLE `pedido_clientes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `cliente_id` int(11) NOT NULL DEFAULT 1,
  `chofer_id` int(11) NOT NULL DEFAULT 1,
  `formapago_id` int(11) NOT NULL DEFAULT 1,
  `tipo` int(11) NOT NULL DEFAULT 1,
  `fecha_entrega` date DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora_entrega` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tiempo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_cliente_detalles`
--

CREATE TABLE `pedido_cliente_detalles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pedido_cliente_id` int(11) NOT NULL DEFAULT 1,
  `item_id` int(11) NOT NULL DEFAULT 1,
  `cajas` decimal(10,3) NOT NULL DEFAULT 0.000,
  `pollos` decimal(10,3) NOT NULL DEFAULT 0.000,
  `peso_bruto` decimal(10,3) NOT NULL DEFAULT 0.000,
  `peso_neto` decimal(10,3) NOT NULL DEFAULT 0.000,
  `tara` decimal(10,3) NOT NULL DEFAULT 0.000,
  `peso_neto_unitario` decimal(10,3) NOT NULL DEFAULT 0.000,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `tel_cor` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planillacostos`
--

CREATE TABLE `planillacostos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `planilla_id` int(11) NOT NULL DEFAULT 1,
  `costovariable_id` int(11) NOT NULL DEFAULT 1,
  `monto` decimal(10,3) NOT NULL DEFAULT 1.000,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planillas`
--

CREATE TABLE `planillas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contrato_id` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `fecha` date DEFAULT NULL,
  `desde` date DEFAULT NULL,
  `hasta` date DEFAULT NULL,
  `fijos` decimal(10,3) NOT NULL DEFAULT 1.000,
  `valor_vacaciones` decimal(10,3) NOT NULL DEFAULT 0.000,
  `sueldo` decimal(10,3) NOT NULL DEFAULT 1.000,
  `variables` decimal(10,3) NOT NULL DEFAULT 1.000,
  `bruto` decimal(10,3) NOT NULL DEFAULT 1.000,
  `extras` decimal(10,3) NOT NULL DEFAULT 1.000,
  `extras_n` decimal(10,3) NOT NULL DEFAULT 1.000,
  `faltas` decimal(10,3) NOT NULL DEFAULT 1.000,
  `faltas_n` decimal(10,3) NOT NULL DEFAULT 1.000,
  `atraso` decimal(10,3) NOT NULL DEFAULT 1.000,
  `atraso_n` decimal(10,3) NOT NULL DEFAULT 1.000,
  `venta_n` decimal(10,3) NOT NULL DEFAULT 1.000,
  `venta` decimal(10,3) NOT NULL DEFAULT 1.000,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `observacion` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planillaserviciocostos`
--

CREATE TABLE `planillaserviciocostos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `planillaservicio_id` int(11) NOT NULL DEFAULT 1,
  `costovariable_id` int(11) NOT NULL DEFAULT 1,
  `monto` decimal(10,3) NOT NULL DEFAULT 1.000,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planillaservicios`
--

CREATE TABLE `planillaservicios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contrato_id` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `horas` int(11) NOT NULL DEFAULT 1,
  `valor_horas` decimal(10,3) NOT NULL DEFAULT 1.000,
  `motivo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `desde` date DEFAULT NULL,
  `hasta` date DEFAULT NULL,
  `fijos` decimal(10,3) NOT NULL DEFAULT 1.000,
  `sueldo` decimal(10,3) NOT NULL DEFAULT 1.000,
  `variables` decimal(10,3) NOT NULL DEFAULT 1.000,
  `bruto` decimal(10,3) NOT NULL DEFAULT 1.000,
  `extras` decimal(10,3) NOT NULL DEFAULT 1.000,
  `extras_n` decimal(10,3) NOT NULL DEFAULT 1.000,
  `faltas` decimal(10,3) NOT NULL DEFAULT 1.000,
  `faltas_n` decimal(10,3) NOT NULL DEFAULT 1.000,
  `atraso` decimal(10,3) NOT NULL DEFAULT 1.000,
  `atraso_n` decimal(10,3) NOT NULL DEFAULT 1.000,
  `venta_n` decimal(10,3) NOT NULL DEFAULT 1.000,
  `venta` decimal(10,3) NOT NULL DEFAULT 1.000,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `observacion` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pollolimpios`
--

CREATE TABLE `pollolimpios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `precio` decimal(10,3) NOT NULL DEFAULT 0.000,
  `venta_1` decimal(10,3) NOT NULL DEFAULT 0.000,
  `venta_2` decimal(10,3) NOT NULL DEFAULT 0.000,
  `venta_3` decimal(10,3) NOT NULL DEFAULT 0.000,
  `venta_4` decimal(10,3) NOT NULL DEFAULT 0.000,
  `venta_5` decimal(10,3) NOT NULL DEFAULT 0.000,
  `venta_6` decimal(10,3) NOT NULL DEFAULT 0.000,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pollolimpio_cambios`
--

CREATE TABLE `pollolimpio_cambios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sucursal_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pollolimpio_sucursals`
--

CREATE TABLE `pollolimpio_sucursals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pollolimpio_id` int(11) NOT NULL,
  `cambio` int(11) NOT NULL,
  `pollolimpio_cambio_id` int(11) NOT NULL,
  `sucursal_id` int(11) NOT NULL,
  `precio` decimal(10,3) NOT NULL,
  `precio_anterior` decimal(10,3) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `venta_1` decimal(10,3) NOT NULL DEFAULT 0.000,
  `venta_3` decimal(10,3) NOT NULL DEFAULT 0.000,
  `venta_4` decimal(10,3) NOT NULL DEFAULT 0.000,
  `venta_5` decimal(10,3) NOT NULL DEFAULT 0.000,
  `venta_6` decimal(10,3) NOT NULL DEFAULT 0.000,
  `fecha` datetime DEFAULT NULL,
  `f` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `h` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `precio_cbba` decimal(10,3) NOT NULL DEFAULT 0.000
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pollo_sucursals`
--

CREATE TABLE `pollo_sucursals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sucursal_id` int(11) NOT NULL,
  `precio_cbba` decimal(10,3) NOT NULL DEFAULT 0.000,
  `precio_lpz` decimal(10,3) NOT NULL DEFAULT 0.000,
  `peso` decimal(10,3) NOT NULL DEFAULT 0.000,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pollo_sucursals`
--

INSERT INTO `pollo_sucursals` (`id`, `sucursal_id`, `precio_cbba`, `precio_lpz`, `peso`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, '12.600', '13.600', '2.300', 1, '2024-01-12 16:25:26', '2025-07-19 15:34:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pps`
--

CREATE TABLE `pps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecha` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nro` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `curso` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `peso_inicial_tipo` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pp_detalles`
--

CREATE TABLE `pp_detalles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lote_id` int(11) NOT NULL DEFAULT 1,
  `lote_detalle_id` int(11) NOT NULL DEFAULT 1,
  `cantidad` decimal(10,3) NOT NULL DEFAULT 0.000,
  `precio_venta` decimal(10,3) NOT NULL DEFAULT 0.000,
  `peso_total` decimal(10,3) NOT NULL DEFAULT 0.000,
  `peso_neto` decimal(10,3) NOT NULL DEFAULT 0.000,
  `fecha` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descomponer` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `lote_detalle_movimiento_id` int(11) NOT NULL DEFAULT 1,
  `peso_bruto` decimal(10,3) NOT NULL DEFAULT 0.000,
  `merma_bruta` decimal(10,3) NOT NULL DEFAULT 0.000,
  `merma_neta` decimal(10,3) NOT NULL DEFAULT 0.000,
  `cajas` int(11) NOT NULL DEFAULT 0,
  `back` int(11) NOT NULL DEFAULT 1,
  `peso_inicial_tipo` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pp_detalle_descomposicions`
--

CREATE TABLE `pp_detalle_descomposicions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_venta` decimal(10,3) NOT NULL,
  `peso_total` decimal(10,3) NOT NULL,
  `pp_detalle_id` int(11) NOT NULL DEFAULT 1,
  `compo_interna_id` int(11) NOT NULL DEFAULT 1,
  `trozado` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `lote_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pp_envio_transformacions`
--

CREATE TABLE `pp_envio_transformacions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecha_hora` datetime DEFAULT NULL,
  `sucursal_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `pp_id` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pp_envio_transformacion_detalles`
--

CREATE TABLE `pp_envio_transformacion_detalles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecha_hora` datetime DEFAULT NULL,
  `pp_envio_transformacion_id` int(11) DEFAULT NULL,
  `cajas` int(11) NOT NULL DEFAULT 0,
  `pollos` int(11) NOT NULL DEFAULT 0,
  `peso_bruto` decimal(8,3) NOT NULL DEFAULT 0.000,
  `peso_neto` decimal(8,3) NOT NULL DEFAULT 0.000,
  `peso_bruto_u` decimal(8,3) NOT NULL DEFAULT 0.000,
  `peso_neto_u` decimal(8,3) NOT NULL DEFAULT 0.000,
  `merma_bruto` decimal(8,3) NOT NULL DEFAULT 0.000,
  `merma_neto` decimal(8,3) NOT NULL DEFAULT 0.000,
  `sucursal_id` int(11) DEFAULT NULL,
  `cinta_pigmento` int(11) DEFAULT NULL,
  `cinta_cliente` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `pp_id` int(11) DEFAULT NULL,
  `is_aceptado` int(11) NOT NULL DEFAULT 0,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pp_pts`
--

CREATE TABLE `pp_pts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 0,
  `pp_detalle_id` int(11) NOT NULL DEFAULT 1,
  `pt_detalle_id` int(11) NOT NULL DEFAULT 1,
  `fecha` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hora` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pp_traspaso_pps`
--

CREATE TABLE `pp_traspaso_pps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `traspaso_pp_id` int(11) NOT NULL DEFAULT 1,
  `pp_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cinta_cliente_id` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `fecha_hora` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `complemento` decimal(8,3) NOT NULL DEFAULT 0.000,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tipo` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `name`, `complemento`, `estado`, `created_at`, `updated_at`, `tipo`) VALUES
(1, 'POLLOS', '1.000', 1, '2023-03-10 00:39:51', '2024-07-16 20:06:11', 1),
(2, 'prueba', '1.000', 0, '2023-03-28 23:02:25', '2023-08-29 08:49:57', 0),
(3, 'ALA', '1.000', 0, '2023-10-26 15:30:56', '2025-02-11 20:04:45', 0),
(4, 'MENUDO', '1.000', 0, '2023-10-26 15:32:35', '2025-02-11 20:04:50', 0),
(5, 'CUELLO', '0.000', 0, '2024-06-20 17:30:40', '2024-06-20 17:31:15', 0),
(6, 'CUELLO', '1.000', 0, '2024-06-20 17:31:39', '2025-02-11 20:04:54', 0),
(7, 'HIGADO', '1.000', 0, '2024-06-20 17:32:01', '2025-02-11 20:04:58', 0),
(8, 'PULMON', '1.000', 0, '2024-06-20 17:32:20', '2025-02-11 20:05:02', 0),
(9, 'GRASA', '1.000', 0, '2024-06-20 17:32:30', '2025-02-11 20:05:07', 0),
(10, 'demo', '1.000', 0, '2024-11-07 09:24:01', '2024-11-07 09:25:10', 1),
(11, 'ddemo', '2.000', 0, '2024-11-07 09:24:52', '2024-11-07 09:25:06', 1),
(12, 'PECHUGA', '1.000', 1, '2025-02-11 20:05:40', '2025-02-11 20:05:40', 0),
(13, 'PIERNA', '1.000', 1, '2025-02-11 20:05:54', '2025-02-11 20:05:54', 0),
(14, 'ALA', '1.000', 1, '2025-02-11 20:06:07', '2025-02-11 20:06:07', 0),
(15, 'CAZUELA', '1.000', 1, '2025-02-11 20:06:26', '2025-02-11 20:06:26', 0),
(16, 'CUELLO', '1.000', 1, '2025-02-11 20:06:44', '2025-02-11 20:06:44', 0),
(17, 'MENUDO', '1.000', 1, '2025-02-11 20:07:05', '2025-02-11 20:07:05', 0),
(18, 'HIGADO', '1.000', 1, '2025-02-11 20:07:19', '2025-02-11 20:07:19', 0),
(19, 'FILETE', '1.000', 1, '2025-02-11 20:07:37', '2025-02-11 20:07:37', 0),
(20, 'COSTILLA', '1.000', 1, '2025-02-11 20:10:28', '2025-02-11 20:10:28', 0),
(21, 'CUERO', '1.000', 1, '2025-02-11 20:10:40', '2025-02-11 20:10:40', 0),
(22, 'FILETE DE PIERNA', '1.000', 1, '2025-02-11 20:11:19', '2025-02-11 20:11:19', 0),
(23, 'HUESO DE PIERNA', '1.000', 1, '2025-02-11 20:11:38', '2025-02-11 20:11:38', 0),
(24, 'ALA PICADA', '1.000', 1, '2025-02-11 20:12:33', '2025-02-11 20:12:33', 0),
(25, 'PUNTA DE ALA', '1.000', 1, '2025-02-11 20:12:48', '2025-02-11 20:12:48', 0),
(26, 'FILETE DESHUESADO', '1.000', 1, '2025-02-11 20:13:19', '2025-02-11 20:13:19', 0),
(27, 'MOLIDA ESPECIAL', '1.000', 1, '2025-02-11 20:13:51', '2025-02-11 20:13:51', 0),
(28, 'MOLIDA CORRIENTE', '1.000', 1, '2025-02-11 20:14:09', '2025-02-11 20:14:09', 0),
(29, 'CUELLO SIN CABEZA', '1.000', 1, '2025-02-11 20:14:33', '2025-02-11 20:14:33', 0),
(30, 'PULMON', '1.000', 1, '2025-02-11 20:14:49', '2025-02-11 20:14:49', 0),
(31, 'GRASA', '1.000', 1, '2025-02-11 20:15:03', '2025-02-11 20:15:03', 0),
(32, 'AVE', '1.000', 1, '2025-05-23 00:46:08', '2025-05-24 00:26:33', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_precios`
--

CREATE TABLE `producto_precios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `precio` decimal(10,3) NOT NULL DEFAULT 0.000,
  `venta_1` decimal(10,3) NOT NULL DEFAULT 0.000,
  `venta_2` decimal(10,3) NOT NULL DEFAULT 0.000,
  `venta_3` decimal(10,3) NOT NULL DEFAULT 0.000,
  `venta_4` decimal(10,3) NOT NULL DEFAULT 0.000,
  `venta_5` decimal(10,3) NOT NULL DEFAULT 0.000,
  `estado_precio_5` tinyint(1) NOT NULL DEFAULT 0,
  `venta_6` decimal(10,3) NOT NULL DEFAULT 0.000,
  `estado_precio_6` tinyint(1) NOT NULL DEFAULT 0,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `venta_7` decimal(10,3) NOT NULL DEFAULT 0.000,
  `estado_precio_7` tinyint(1) NOT NULL DEFAULT 0,
  `descuento_1` decimal(10,3) NOT NULL DEFAULT 0.000,
  `descuento_2` decimal(10,3) NOT NULL DEFAULT 0.000,
  `descuento_3` decimal(10,3) NOT NULL DEFAULT 0.000,
  `descuento_4` decimal(10,3) NOT NULL DEFAULT 0.000,
  `descuento_5` decimal(10,3) NOT NULL DEFAULT 0.000,
  `descuento_6` decimal(10,3) NOT NULL DEFAULT 0.000,
  `descuento_7` decimal(10,3) NOT NULL DEFAULT 0.000,
  `descuento_8` decimal(10,3) NOT NULL DEFAULT 0.000,
  `venta_8` decimal(10,3) NOT NULL DEFAULT 0.000,
  `estado_precio_8` tinyint(1) NOT NULL DEFAULT 0,
  `descuento_9` decimal(10,3) NOT NULL DEFAULT 0.000,
  `venta_9` decimal(8,2) NOT NULL DEFAULT 0.00,
  `descuento_10` decimal(8,2) NOT NULL DEFAULT 0.00,
  `venta_10` decimal(8,2) NOT NULL DEFAULT 0.00,
  `descuento_11` decimal(8,2) NOT NULL DEFAULT 0.00,
  `venta_11` decimal(8,2) NOT NULL DEFAULT 0.00,
  `descuento_12` decimal(8,2) NOT NULL DEFAULT 0.00,
  `venta_12` decimal(8,2) NOT NULL DEFAULT 0.00,
  `descuento_13` decimal(8,2) NOT NULL DEFAULT 0.00,
  `estado_precio_12` tinyint(1) NOT NULL DEFAULT 0,
  `estado_precio_11` tinyint(1) NOT NULL DEFAULT 0,
  `estado_precio_10` tinyint(1) NOT NULL DEFAULT 0,
  `estado_precio_9` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `producto_precios`
--

INSERT INTO `producto_precios` (`id`, `name`, `precio`, `venta_1`, `venta_2`, `venta_3`, `venta_4`, `venta_5`, `estado_precio_5`, `venta_6`, `estado_precio_6`, `estado`, `created_at`, `updated_at`, `venta_7`, `estado_precio_7`, `descuento_1`, `descuento_2`, `descuento_3`, `descuento_4`, `descuento_5`, `descuento_6`, `descuento_7`, `descuento_8`, `venta_8`, `estado_precio_8`, `descuento_9`, `venta_9`, `descuento_10`, `venta_10`, `descuento_11`, `venta_11`, `descuento_12`, `venta_12`, `descuento_13`, `estado_precio_12`, `estado_precio_11`, `estado_precio_10`, `estado_precio_9`) VALUES
(1, 'EXTRA BLANCA', '0.000', '0.200', '0.000', '-0.100', '-0.200', '-0.200', 0, '-0.400', 0, 1, '2025-08-13 14:25:49', '2025-08-13 14:25:49', '1.000', 0, '0.000', '0.000', '0.000', '0.000', '0.000', '0.000', '0.000', '0.000', '1.000', 0, '0.000', '1.00', '0.00', '1.00', '0.00', '1.00', '0.00', '1.00', '0.00', 0, 0, 0, 0),
(2, 'BLANCA', '0.000', '0.200', '0.000', '-0.100', '-0.200', '-0.200', 0, '-0.400', 0, 1, '2025-08-13 14:26:10', '2025-08-13 14:26:10', '1.000', 0, '0.000', '0.000', '0.000', '0.000', '0.000', '0.000', '0.000', '0.000', '1.000', 0, '0.000', '1.00', '0.00', '1.00', '0.00', '1.00', '0.00', '1.00', '0.00', 0, 0, 0, 0),
(3, 'NEGRA', '0.000', '0.200', '0.000', '-0.100', '-0.200', '-0.200', 0, '-0.400', 0, 1, '2025-08-13 14:26:18', '2025-08-13 14:26:18', '1.000', 0, '0.000', '0.000', '0.000', '0.000', '0.000', '0.000', '0.000', '0.000', '1.000', 0, '0.000', '1.00', '0.00', '1.00', '0.00', '1.00', '0.00', '1.00', '0.00', 0, 0, 0, 0),
(4, 'AZUL', '0.000', '0.200', '0.000', '-0.100', '-0.200', '-0.200', 0, '-0.400', 0, 1, '2025-08-13 14:26:29', '2025-08-13 14:26:29', '1.000', 0, '0.000', '0.000', '0.000', '0.000', '0.000', '0.000', '0.000', '0.000', '1.000', 0, '0.000', '1.00', '0.00', '1.00', '0.00', '1.00', '0.00', '1.00', '0.00', 0, 0, 0, 0),
(5, 'BB', '0.000', '0.200', '0.000', '-0.100', '-0.200', '-0.200', 0, '-0.400', 0, 1, '2025-08-13 14:26:42', '2025-08-13 14:26:42', '1.000', 0, '0.000', '0.000', '0.000', '0.000', '0.000', '0.000', '0.000', '0.000', '1.000', 0, '0.000', '1.00', '0.00', '1.00', '0.00', '1.00', '0.00', '1.00', '0.00', 0, 0, 0, 0),
(6, 'AMARILLA', '0.000', '0.200', '0.000', '-0.100', '-0.200', '-0.200', 0, '-0.400', 0, 1, '2025-08-13 14:27:02', '2025-08-13 14:27:02', '1.000', 0, '0.000', '0.000', '0.000', '0.000', '0.000', '0.000', '0.000', '0.000', '1.000', 0, '0.000', '1.00', '0.00', '1.00', '0.00', '1.00', '0.00', '1.00', '0.00', 0, 0, 0, 0),
(7, 'ROJA', '0.000', '0.200', '0.000', '-0.100', '-0.200', '-0.200', 0, '-0.400', 0, 1, '2025-08-13 14:27:14', '2025-08-13 14:27:14', '1.000', 0, '0.000', '0.000', '0.000', '0.000', '0.000', '0.000', '0.000', '0.000', '1.000', 0, '0.000', '1.00', '0.00', '1.00', '0.00', '1.00', '0.00', '1.00', '0.00', 0, 0, 0, 0),
(8, 'POLLO LIMPIO', '0.000', '0.200', '0.000', '-0.100', '-0.200', '-0.200', 0, '-0.400', 0, 1, '2025-08-13 14:27:22', '2025-08-13 14:27:22', '1.000', 0, '0.000', '0.000', '0.000', '0.000', '0.000', '0.000', '0.000', '0.000', '1.000', 0, '0.000', '1.00', '0.00', '1.00', '0.00', '1.00', '0.00', '1.00', '0.00', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_precio_cambios`
--

CREATE TABLE `producto_precio_cambios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sucursal_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_precio_lotes`
--

CREATE TABLE `producto_precio_lotes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `producto_precio_id` int(11) NOT NULL DEFAULT 1,
  `lote_id` int(11) NOT NULL DEFAULT 1,
  `precio` decimal(10,3) NOT NULL DEFAULT 0.000,
  `peso` decimal(10,3) NOT NULL DEFAULT 0.000,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_precio_sucursals`
--

CREATE TABLE `producto_precio_sucursals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `producto_precio_id` int(11) NOT NULL,
  `cambio` int(11) NOT NULL,
  `tipo_cambio` tinyint(4) NOT NULL DEFAULT 1,
  `producto_precio_cambio_id` int(11) NOT NULL,
  `sucursal_id` int(11) NOT NULL,
  `precio` decimal(10,3) NOT NULL,
  `precio_anterior` decimal(10,3) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `venta_1` decimal(10,3) NOT NULL DEFAULT 0.000,
  `venta_3` decimal(10,3) NOT NULL DEFAULT 0.000,
  `venta_4` decimal(10,3) NOT NULL DEFAULT 0.000,
  `venta_5` decimal(10,3) NOT NULL DEFAULT 0.000,
  `estado_precio_5` tinyint(1) NOT NULL DEFAULT 0,
  `venta_6` decimal(10,3) NOT NULL DEFAULT 0.000,
  `estado_precio_6` tinyint(1) NOT NULL DEFAULT 0,
  `fecha` datetime DEFAULT NULL,
  `f` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `h` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `precio_cbba` decimal(10,3) NOT NULL DEFAULT 0.000,
  `venta_7` decimal(8,3) NOT NULL DEFAULT 0.000,
  `estado_precio_7` tinyint(1) NOT NULL DEFAULT 0,
  `descuento_1` decimal(10,3) NOT NULL DEFAULT 0.000,
  `descuento_2` decimal(10,3) NOT NULL DEFAULT 0.000,
  `descuento_3` decimal(10,3) NOT NULL DEFAULT 0.000,
  `descuento_4` decimal(10,3) NOT NULL DEFAULT 0.000,
  `descuento_5` decimal(10,3) NOT NULL DEFAULT 0.000,
  `descuento_6` decimal(10,3) NOT NULL DEFAULT 0.000,
  `descuento_7` decimal(10,3) NOT NULL DEFAULT 0.000,
  `descuento_8` decimal(10,3) NOT NULL DEFAULT 0.000,
  `venta_8` decimal(10,3) NOT NULL DEFAULT 0.000,
  `estado_precio_8` tinyint(1) NOT NULL DEFAULT 0,
  `descuento_9` decimal(10,3) NOT NULL DEFAULT 0.000,
  `venta_9` decimal(8,2) NOT NULL DEFAULT 0.00,
  `descuento_10` decimal(8,2) NOT NULL DEFAULT 0.00,
  `venta_10` decimal(8,2) NOT NULL DEFAULT 0.00,
  `descuento_11` decimal(8,2) NOT NULL DEFAULT 0.00,
  `venta_11` decimal(8,2) NOT NULL DEFAULT 0.00,
  `descuento_12` decimal(8,2) NOT NULL DEFAULT 0.00,
  `venta_12` decimal(8,2) NOT NULL DEFAULT 0.00,
  `descuento_13` decimal(8,2) NOT NULL DEFAULT 0.00,
  `estado_precio_12` tinyint(1) NOT NULL DEFAULT 0,
  `estado_precio_11` tinyint(1) NOT NULL DEFAULT 0,
  `estado_precio_10` tinyint(1) NOT NULL DEFAULT 0,
  `estado_precio_9` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promedio_mermas`
--

CREATE TABLE `promedio_mermas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `promedio` decimal(10,3) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `promedio_mermas`
--

INSERT INTO `promedio_mermas` (`id`, `promedio`, `estado`, `created_at`, `updated_at`) VALUES
(1, '0.060', 1, NULL, '2024-02-17 09:42:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promedio_pollolimpios`
--

CREATE TABLE `promedio_pollolimpios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `precio_1` decimal(10,3) NOT NULL DEFAULT 0.000,
  `peso_1` decimal(10,3) NOT NULL DEFAULT 0.000,
  `precio_2` decimal(10,3) NOT NULL DEFAULT 0.000,
  `peso_2` decimal(10,3) NOT NULL DEFAULT 0.000,
  `precio_3` decimal(10,3) NOT NULL DEFAULT 0.000,
  `peso_3` decimal(10,3) NOT NULL DEFAULT 0.000,
  `precio_4` decimal(10,3) NOT NULL DEFAULT 0.000,
  `peso_4` decimal(10,3) NOT NULL DEFAULT 0.000,
  `precio_5` decimal(10,3) NOT NULL DEFAULT 0.000,
  `peso_5` decimal(10,3) NOT NULL DEFAULT 0.000,
  `precio_6` decimal(10,3) NOT NULL DEFAULT 0.000,
  `peso_6` decimal(10,3) NOT NULL DEFAULT 0.000,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedors`
--

CREATE TABLE `proveedors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `documento_id` int(11) NOT NULL DEFAULT 1,
  `doc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `encargado` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor_categorias`
--

CREATE TABLE `proveedor_categorias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `proveedor_compra_id` int(11) NOT NULL DEFAULT 0,
  `categoria_id` int(11) NOT NULL DEFAULT 0,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `proveedor_categorias`
--

INSERT INTO `proveedor_categorias` (`id`, `proveedor_compra_id`, `categoria_id`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0, '2025-02-05 11:58:28', '2025-02-05 12:19:28'),
(2, 1, 1, 0, '2025-02-05 12:07:09', '2025-02-05 12:07:13'),
(3, 1, 2, 0, '2025-02-05 12:07:22', '2025-02-05 12:13:33'),
(4, 1, 2, 1, '2025-02-05 12:13:56', '2025-02-05 12:13:56'),
(5, 1, 1, 1, '2025-02-05 12:19:38', '2025-02-05 12:19:38'),
(6, 3, 6, 0, '2025-02-11 17:03:18', '2025-02-11 17:03:44'),
(7, 3, 6, 1, '2025-02-11 17:08:27', '2025-02-11 17:08:27'),
(8, 3, 6, 1, '2025-02-11 17:09:51', '2025-02-11 17:09:51'),
(9, 5, 1, 1, '2025-06-11 22:18:27', '2025-06-11 22:18:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor_categoria_detalles`
--

CREATE TABLE `proveedor_categoria_detalles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `proveedor_categoria_id` int(11) NOT NULL DEFAULT 0,
  `proveedor_compra_id` int(11) NOT NULL DEFAULT 1,
  `sub_medida_id` int(11) NOT NULL DEFAULT 1,
  `medida_producto_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `proveedor_categoria_detalles`
--

INSERT INTO `proveedor_categoria_detalles` (`id`, `proveedor_categoria_id`, `proveedor_compra_id`, `sub_medida_id`, `medida_producto_id`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 1, '2025-02-05 15:58:48', '2025-02-05 15:58:48'),
(2, 1, 1, 2, 1, 1, '2025-02-05 15:59:08', '2025-02-05 15:59:08'),
(3, 1, 1, 3, 1, 1, '2025-02-05 15:59:12', '2025-02-05 15:59:12'),
(4, 1, 1, 4, 1, 1, '2025-02-05 15:59:15', '2025-02-05 15:59:15'),
(5, 3, 1, 5, 1, 1, '2025-02-05 16:07:30', '2025-02-05 16:07:30'),
(6, 4, 1, 6, 1, 1, '2025-02-05 16:14:00', '2025-02-05 16:14:00'),
(7, 4, 1, 5, 1, 1, '2025-02-05 16:14:03', '2025-02-05 16:14:03'),
(8, 5, 1, 1, 1, 1, '2025-02-05 16:19:47', '2025-02-05 16:19:47'),
(9, 5, 1, 2, 1, 1, '2025-02-05 16:19:51', '2025-02-05 16:19:51'),
(10, 5, 1, 3, 1, 1, '2025-02-05 16:19:56', '2025-02-05 16:19:56'),
(11, 5, 1, 4, 1, 1, '2025-02-05 16:20:03', '2025-02-05 16:20:03'),
(12, 5, 1, 30, 29, 1, '2025-06-04 00:43:27', '2025-06-04 00:43:27'),
(13, 5, 1, 31, 29, 1, '2025-06-04 00:43:27', '2025-06-04 00:43:27'),
(14, 5, 1, 32, 29, 1, '2025-06-04 00:43:27', '2025-06-04 00:43:27'),
(15, 5, 1, 33, 29, 1, '2025-06-04 00:43:27', '2025-06-04 00:43:27'),
(16, 5, 1, 34, 29, 1, '2025-06-04 00:43:27', '2025-06-04 00:43:27'),
(17, 5, 1, 35, 29, 1, '2025-06-04 00:43:27', '2025-06-04 00:43:27'),
(18, 5, 2, 30, 29, 1, '2025-06-04 00:43:27', '2025-06-04 00:43:27'),
(19, 5, 2, 31, 29, 1, '2025-06-04 00:43:27', '2025-06-04 00:43:27'),
(20, 5, 2, 32, 29, 1, '2025-06-04 00:43:27', '2025-06-04 00:43:27'),
(21, 5, 2, 33, 29, 1, '2025-06-04 00:43:27', '2025-06-04 00:43:27'),
(22, 5, 2, 34, 29, 1, '2025-06-04 00:43:27', '2025-06-04 00:43:27'),
(23, 5, 2, 35, 29, 1, '2025-06-04 00:43:27', '2025-06-04 00:43:27'),
(24, 5, 3, 30, 29, 1, '2025-06-04 00:43:27', '2025-06-04 00:43:27'),
(25, 5, 3, 31, 29, 1, '2025-06-04 00:43:27', '2025-06-04 00:43:27'),
(26, 5, 3, 32, 29, 1, '2025-06-04 00:43:27', '2025-06-04 00:43:27'),
(27, 5, 3, 33, 29, 1, '2025-06-04 00:43:27', '2025-06-04 00:43:27'),
(28, 5, 3, 34, 29, 1, '2025-06-04 00:43:27', '2025-06-04 00:43:27'),
(29, 5, 3, 35, 29, 1, '2025-06-04 00:43:27', '2025-06-04 00:43:27'),
(30, 5, 4, 30, 29, 1, '2025-06-04 00:43:27', '2025-06-04 00:43:27'),
(31, 5, 4, 31, 29, 1, '2025-06-04 00:43:27', '2025-06-04 00:43:27'),
(32, 5, 4, 32, 29, 1, '2025-06-04 00:43:27', '2025-06-04 00:43:27'),
(33, 5, 4, 33, 29, 1, '2025-06-04 00:43:27', '2025-06-04 00:43:27'),
(34, 5, 4, 34, 29, 1, '2025-06-04 00:43:27', '2025-06-04 00:43:27'),
(35, 5, 4, 35, 29, 1, '2025-06-04 00:43:27', '2025-06-04 00:43:27'),
(36, 9, 5, 30, 29, 1, '2025-06-11 22:18:33', '2025-06-11 22:18:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor_compras`
--

CREATE TABLE `proveedor_compras` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `abreviatura` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `documento_id` int(11) NOT NULL DEFAULT 1,
  `doc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `encargado` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `inactivo` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `categoria_id` int(11) NOT NULL DEFAULT 1,
  `tipo` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `proveedor_compras`
--

INSERT INTO `proveedor_compras` (`id`, `nombre`, `abreviatura`, `documento_id`, `doc`, `direccion`, `telefono`, `encargado`, `estado`, `inactivo`, `created_at`, `updated_at`, `categoria_id`, `tipo`) VALUES
(1, 'ALEJANDRA CHOQUE', 'A', 1, '1234', 'VINTO- CBBA', '12345678', 'RONAL UVINA', 1, 1, '2024-10-29 06:25:35', '2025-02-05 12:19:09', 1, 1),
(2, 'PRODUCCIÓN PARA POLLO', 'TRS PT', 1, '1234', 'PLANTA', '2214131', 'ANDRES VALLEJOS', 1, 1, '2025-02-11 15:40:33', '2025-02-18 10:04:49', 1, 1),
(3, 'PRODUCCION PARA TROSADO', 'TRS PP', 1, '1234', 'PLANTA', '2214131', 'ANDRES VALLEJOS', 1, 1, '2025-02-11 15:41:24', '2025-02-18 10:04:26', 1, 1),
(4, 'EL CARMEN - CESPEDES', 'CC', 1, '134561', 'CBBA', '24463', 'GILDA LA PAZ', 1, 1, '2025-02-11 18:38:35', '2025-02-11 18:38:35', 1, 1),
(5, 'PROVEEDOR AVES', 'ENG', 1, '23213', '32131', '3213', 'ENCARGADO', 1, 1, '2025-06-11 22:15:30', '2025-06-11 22:15:30', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor_compra_medidas`
--

CREATE TABLE `proveedor_compra_medidas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `proveedor_compra_id` int(11) NOT NULL DEFAULT 1,
  `sub_medida_id` int(11) NOT NULL DEFAULT 1,
  `medida_producto_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pts`
--

CREATE TABLE `pts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecha` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nro` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `curso` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `peso_inicial_tipo` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pt_detalles`
--

CREATE TABLE `pt_detalles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lote_id` int(11) NOT NULL DEFAULT 1,
  `lote_detalle_id` int(11) NOT NULL DEFAULT 1,
  `cantidad` int(11) NOT NULL DEFAULT 0,
  `descomponer` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `back` int(11) NOT NULL DEFAULT 1,
  `peso_bruto` decimal(10,3) NOT NULL DEFAULT 0.000,
  `merma_bruta` decimal(10,3) NOT NULL DEFAULT 0.000,
  `merma_neta` decimal(10,3) NOT NULL DEFAULT 0.000,
  `cajas` int(11) NOT NULL DEFAULT 0,
  `peso_neto` decimal(10,3) NOT NULL DEFAULT 0.000
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pt_detalle_descomposicions`
--

CREATE TABLE `pt_detalle_descomposicions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_venta` decimal(10,3) NOT NULL,
  `peso_total` decimal(10,3) NOT NULL,
  `pt_detalle_id` int(11) NOT NULL DEFAULT 1,
  `compo_externa_id` int(11) NOT NULL DEFAULT 1,
  `trozado` int(11) NOT NULL DEFAULT 0,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `lote_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pt_detalle_sub_descomposicions`
--

CREATE TABLE `pt_detalle_sub_descomposicions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_venta` decimal(10,3) NOT NULL,
  `peso_total` decimal(10,3) NOT NULL,
  `pt_detalle_descomposicion_id` int(11) NOT NULL DEFAULT 1,
  `compo_externa_detalle_id` int(11) NOT NULL DEFAULT 1,
  `pt_detalle_id` int(11) NOT NULL DEFAULT 1,
  `trozado` int(11) NOT NULL DEFAULT 0,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pt_sobra_pps`
--

CREATE TABLE `pt_sobra_pps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sobra_pp_id` int(11) NOT NULL DEFAULT 1,
  `pt_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pt_traspaso_pps`
--

CREATE TABLE `pt_traspaso_pps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `traspaso_pp_id` int(11) NOT NULL DEFAULT 1,
  `pt_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `redotaciondetalles`
--

CREATE TABLE `redotaciondetalles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stockdotaciondetail_id` int(11) NOT NULL DEFAULT 1,
  `redotacion_id` int(11) NOT NULL DEFAULT 1,
  `cantidad` decimal(10,3) NOT NULL DEFAULT 1.000,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `redotacions`
--

CREATE TABLE `redotacions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contrato_id` int(11) NOT NULL DEFAULT 1,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `salidadotacioncontrato_id` int(11) NOT NULL DEFAULT 1,
  `fecha` date DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salidadotacioncontratos`
--

CREATE TABLE `salidadotacioncontratos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecha` date DEFAULT NULL,
  `contrato_id` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salidadotaclidetalles`
--

CREATE TABLE `salidadotaclidetalles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stockdotaciondetail_id` int(11) NOT NULL DEFAULT 1,
  `salidadotacliente_id` int(11) NOT NULL DEFAULT 1,
  `cliente_id` int(11) NOT NULL DEFAULT 1,
  `cantidad` decimal(10,3) NOT NULL DEFAULT 1.000,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salidadotaclientes`
--

CREATE TABLE `salidadotaclientes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecha` date DEFAULT NULL,
  `cliente_id` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salidotacontradetas`
--

CREATE TABLE `salidotacontradetas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stockdotaciondetail_id` int(11) NOT NULL DEFAULT 1,
  `salidadotacioncontrato_id` int(11) NOT NULL DEFAULT 1,
  `contrato_id` int(11) NOT NULL DEFAULT 1,
  `cantidad` decimal(10,3) NOT NULL DEFAULT 1.000,
  `estado` int(11) NOT NULL DEFAULT 1,
  `fecha` date DEFAULT NULL,
  `motivo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sobra_detalle_pps`
--

CREATE TABLE `sobra_detalle_pps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sobra_pp_id` int(11) NOT NULL DEFAULT 0,
  `item_id` int(11) NOT NULL DEFAULT 0,
  `cajas` decimal(10,3) NOT NULL DEFAULT 0.000,
  `taras` decimal(10,3) NOT NULL DEFAULT 0.000,
  `peso_bruto` decimal(10,3) NOT NULL DEFAULT 0.000,
  `peso_neto` decimal(10,3) NOT NULL DEFAULT 0.000,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `fecha_hora` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sobra_pps`
--

CREATE TABLE `sobra_pps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecha` date DEFAULT NULL,
  `pp_id` int(11) NOT NULL DEFAULT 0,
  `aceptado` int(11) NOT NULL DEFAULT 0,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nro_traspaso` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stockdotaciondetails`
--

CREATE TABLE `stockdotaciondetails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `proveedor_id` int(11) NOT NULL DEFAULT 1,
  `dotacion_id` int(11) NOT NULL DEFAULT 1,
  `stockdotacion_id` int(11) NOT NULL DEFAULT 1,
  `costo` decimal(10,3) NOT NULL DEFAULT 1.000,
  `venta` decimal(10,3) NOT NULL DEFAULT 1.000,
  `cantidad` decimal(10,3) NOT NULL DEFAULT 1.000,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `lote` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stockdotacions`
--

CREATE TABLE `stockdotacions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `proveedor_id` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `formapago_id` int(11) NOT NULL DEFAULT 1,
  `fecha` date DEFAULT NULL,
  `motivo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `lote` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subdetalle_descuento_acuerdo`
--

CREATE TABLE `subdetalle_descuento_acuerdo` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `venta_detalle_pp_id` bigint(20) UNSIGNED DEFAULT NULL,
  `item_id` bigint(20) UNSIGNED DEFAULT NULL,
  `item_nombre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acuerdo_id` bigint(20) UNSIGNED DEFAULT NULL,
  `acuerdo_nombre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `peso` decimal(10,3) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `descuento_valor` decimal(10,2) DEFAULT NULL,
  `total_con_descuento` decimal(10,2) DEFAULT NULL,
  `total_sin_descuento` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sub_des_detalle_pts`
--

CREATE TABLE `sub_des_detalle_pts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cantidad` int(11) NOT NULL,
  `peso_total` decimal(10,3) NOT NULL,
  `equivale` decimal(10,3) NOT NULL,
  `detalle_pt_descomposicion_id` int(11) NOT NULL DEFAULT 1,
  `compo_externa_detalle_id` int(11) NOT NULL DEFAULT 1,
  `detalle_pt_id` int(11) NOT NULL DEFAULT 1,
  `trozado` int(11) NOT NULL DEFAULT 0,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sub_des_pt_detalle_descos`
--

CREATE TABLE `sub_des_pt_detalle_descos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cantidad` int(11) NOT NULL,
  `peso_total` decimal(10,3) NOT NULL,
  `equivale` decimal(10,3) NOT NULL,
  `pt_detalle_descomposicion_id` int(11) NOT NULL DEFAULT 1,
  `compo_externa_detalle_id` int(11) NOT NULL DEFAULT 1,
  `pt_detalle_id` int(11) NOT NULL DEFAULT 1,
  `trozado` int(11) NOT NULL DEFAULT 0,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sub_items`
--

CREATE TABLE `sub_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` int(11) NOT NULL DEFAULT 1,
  `sub_item_id` int(11) NOT NULL DEFAULT 1,
  `precio` decimal(10,3) NOT NULL DEFAULT 0.000,
  `peso` decimal(10,3) NOT NULL DEFAULT 0.000,
  `promedio` decimal(10,3) NOT NULL DEFAULT 0.000,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `descuento_1` decimal(8,3) NOT NULL DEFAULT 0.000,
  `descuento_2` decimal(8,3) NOT NULL DEFAULT 0.000,
  `descuento_3` decimal(8,3) NOT NULL DEFAULT 0.000,
  `descuento_4` decimal(8,3) NOT NULL DEFAULT 0.000
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sub_item_pt_transformacion_lotes`
--

CREATE TABLE `sub_item_pt_transformacion_lotes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `encargado` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_pt_transformacion_lote_id` int(11) NOT NULL DEFAULT 1,
  `transformacion_lote_id` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `item_id` int(11) NOT NULL DEFAULT 1,
  `subitem_id` int(11) NOT NULL DEFAULT 1,
  `pt_id` int(11) NOT NULL DEFAULT 1,
  `cajas` int(11) NOT NULL DEFAULT 0,
  `peso_bruto` decimal(8,3) NOT NULL DEFAULT 0.000,
  `peso_neto` decimal(8,3) NOT NULL DEFAULT 0.000,
  `fecha_hora` datetime DEFAULT NULL,
  `is_declarado` int(11) NOT NULL DEFAULT 0,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sub_medidas`
--

CREATE TABLE `sub_medidas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `valor_1` decimal(8,3) NOT NULL DEFAULT 0.000,
  `valor_2` decimal(8,3) NOT NULL DEFAULT 0.000,
  `medida_producto_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nro_orden` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sub_medidas`
--

INSERT INTO `sub_medidas` (`id`, `name`, `valor_1`, `valor_2`, `medida_producto_id`, `estado`, `created_at`, `updated_at`, `nro_orden`) VALUES
(1, 'EXTRA BLANCA', '2.800', '3.200', 1, 1, '2024-06-20 13:42:13', '2024-06-20 13:42:13', 1),
(2, 'BLANCA', '2.400', '2.799', 1, 1, '2024-06-20 13:44:31', '2024-11-07 10:02:09', 2),
(3, 'NEGRA', '2.100', '2.399', 1, 1, '2024-06-20 13:45:55', '2024-11-07 09:18:21', 3),
(4, 'AZUL', '1.800', '2.099', 1, 1, '2024-06-20 13:46:26', '2024-11-07 10:02:17', 4),
(5, 'BB', '1.500', '1.799', 1, 1, '2024-06-20 13:46:50', '2024-06-20 13:46:50', 5),
(6, 'AMARILLA', '1400.000', '3200.000', 1, 1, '2024-06-20 13:48:06', '2024-11-07 09:21:43', 7),
(7, 'ALA', '0.000', '0.000', 5, 1, '2024-07-18 21:50:55', '2024-07-18 21:50:55', 1),
(8, 'aa', '1.000', '2.000', 1, 0, '2024-11-07 09:21:20', '2024-11-07 09:21:27', 4),
(9, 'dd', '2.000', '3.000', 9, 1, '2024-11-07 09:24:52', '2024-11-07 09:24:52', 1),
(10, 'PECHUGA', '1.000', '1.000', 11, 1, '2025-02-11 21:22:23', '2025-02-11 21:22:23', 1),
(11, 'PIERNA', '1.000', '1.000', 12, 1, '2025-02-11 21:22:46', '2025-02-11 21:22:46', 2),
(12, 'ALA', '1.000', '1.000', 13, 1, '2025-02-11 21:23:09', '2025-02-11 21:23:09', 3),
(13, 'CAZUELA', '1.000', '1.000', 14, 1, '2025-02-11 21:23:42', '2025-02-11 21:23:42', 4),
(14, 'CUELLO', '1.000', '1.000', 15, 1, '2025-02-11 21:24:13', '2025-02-11 21:24:13', 5),
(15, 'MENUDO', '1.000', '1.000', 16, 1, '2025-02-11 21:24:43', '2025-02-11 21:24:43', 6),
(16, 'HIGADO', '1.000', '1.000', 17, 1, '2025-02-11 21:25:14', '2025-02-11 21:25:14', 7),
(17, 'FILETE', '1.000', '1.000', 18, 1, '2025-02-11 21:25:45', '2025-02-11 21:25:45', 8),
(18, 'COSTILLA', '1.000', '1.000', 19, 1, '2025-02-11 21:27:55', '2025-02-11 21:27:55', 9),
(19, 'CUERO', '1.000', '1.000', 20, 1, '2025-02-11 21:28:22', '2025-02-11 21:28:22', 10),
(20, 'FILETE DE PIERNA', '1.000', '1.000', 21, 1, '2025-02-11 21:29:09', '2025-02-11 21:29:40', 11),
(21, 'HUESO DE PIERNA', '1.000', '1.000', 22, 1, '2025-02-11 21:32:30', '2025-02-11 21:32:30', 12),
(22, 'ALA PICADA', '1.000', '1.000', 23, 1, '2025-02-11 21:32:51', '2025-02-11 21:32:51', 13),
(23, 'PUNTA DE ALA', '1.000', '1.000', 24, 1, '2025-02-11 21:33:26', '2025-02-11 21:33:26', 14),
(24, 'FILETE DESHUESADO', '1.000', '1.000', 25, 1, '2025-02-11 21:34:01', '2025-02-11 21:34:01', 15),
(25, 'MOLIDA ESPECIAL', '1.000', '1.000', 26, 1, '2025-02-11 21:34:22', '2025-02-11 21:34:22', 17),
(26, 'MOLIDA CORRIENTE', '1.000', '1.000', 27, 1, '2025-02-11 21:34:57', '2025-02-11 21:34:57', 17),
(27, 'CUELLO SIN CABEZA', '1.000', '1.000', 28, 1, '2025-02-11 21:35:35', '2025-02-11 21:35:35', 18),
(28, 'PILMON', '1.000', '1.000', 10, 1, '2025-02-11 21:36:05', '2025-02-11 21:36:05', 19),
(29, 'GRASA', '1.000', '1.000', 10, 1, '2025-02-11 21:36:28', '2025-02-11 21:36:28', 20),
(30, 'AVE', '2.800', '3.200', 29, 1, '2024-06-20 13:42:13', '2024-06-20 13:42:13', 1),
(31, 'AVE', '2.400', '2.799', 29, 1, '2024-06-20 13:44:31', '2024-11-07 10:02:09', 3),
(32, 'AVE', '2.100', '2.399', 29, 1, '2024-06-20 13:45:55', '2024-11-07 09:18:21', 2),
(33, 'AVE', '1.800', '2.099', 29, 1, '2024-06-20 13:46:26', '2024-11-07 10:02:17', 4),
(34, 'AVE', '1.500', '1.799', 29, 1, '2024-06-20 13:46:50', '2024-06-20 13:46:50', 1),
(35, 'AVE', '1400.000', '3200.000', 29, 1, '2024-06-20 13:48:06', '2024-11-07 09:21:43', 1),
(36, 'ROJA', '1.300', '1.499', 1, 1, '2024-06-20 13:46:50', '2024-06-20 13:46:50', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursals`
--

CREATE TABLE `sucursals` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sucursals`
--

INSERT INTO `sucursals` (`id`, `nombre`, `documento_id`, `doc`, `telefono`, `email`, `responsable`, `encargado`, `medidor`, `direccion`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'EDP', 1, '121456789', '22655555', 'edp@gmail.com', 'PEDRO', 'JUAN', 'A123', 'LA PAZ VILLA FATIMA', 1, '2023-02-09 16:26:31', '2024-01-29 09:43:10'),
(2, 'Sucursal 2', 1, '11', '8', '8', '--', '--', '--', 'Jr. Ticapampa', 1, '2024-06-17 21:08:41', '2024-06-17 21:08:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal_tirajes`
--

CREATE TABLE `sucursal_tirajes` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoarchivos`
--

CREATE TABLE `tipoarchivos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipoarchivos`
--

INSERT INTO `tipoarchivos` (`id`, `name`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'FOTO', 1, '2023-02-10 20:25:12', '2023-02-10 20:25:12'),
(2, 'CONVENIOS', 1, '2023-04-10 00:32:20', '2023-04-10 00:32:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoclientes`
--

CREATE TABLE `tipoclientes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `monto` decimal(8,3) NOT NULL DEFAULT 0.000,
  `desde` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipoclientes`
--

INSERT INTO `tipoclientes` (`id`, `name`, `monto`, `desde`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'VIP', '0.300', 10, 1, '2023-03-10 16:48:28', '2023-03-10 16:48:28'),
(2, 'Recurrente', '1.000', 1, 1, '2023-03-10 16:48:42', '2023-03-10 16:48:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipocontratos`
--

CREATE TABLE `tipocontratos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipocontratos`
--

INSERT INTO `tipocontratos` (`id`, `name`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'FIJO', 1, '2023-02-09 16:25:58', '2023-02-09 16:25:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipopagos`
--

CREATE TABLE `tipopagos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipopagos`
--

INSERT INTO `tipopagos` (`id`, `name`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'TIPO', 1, '2024-06-01 06:39:26', '2024-06-01 06:39:30'),
(2, 'TIPO 2', 1, '2024-06-01 06:39:35', '2024-06-01 06:39:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_cliente_pps`
--

CREATE TABLE `tipo_cliente_pps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desde` decimal(10,3) DEFAULT NULL,
  `hasta` decimal(10,3) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_cliente_pps`
--

INSERT INTO `tipo_cliente_pps` (`id`, `name`, `desde`, `hasta`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'DE 1 A 14 POLLOS', '1.000', '14.000', 1, '2024-10-09 10:49:32', '2024-10-09 10:49:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_cliente_pp_limpios`
--

CREATE TABLE `tipo_cliente_pp_limpios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desde` decimal(10,3) DEFAULT NULL,
  `hasta` decimal(10,3) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_cliente_pp_limpios`
--

INSERT INTO `tipo_cliente_pp_limpios` (`id`, `name`, `desde`, `hasta`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'DE 1 A 14 POLLOS', '1.000', '14.000', 1, '2024-10-09 10:50:37', '2024-10-09 10:50:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_negocios`
--

CREATE TABLE `tipo_negocios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_negocios`
--

INSERT INTO `tipo_negocios` (`id`, `name`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'ROSTICERIA', 1, '2024-11-13 11:24:24', '2024-11-13 11:24:24'),
(2, 'FRIAL', 1, '2024-11-13 11:24:28', '2024-11-13 11:24:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transformacions`
--

CREATE TABLE `transformacions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transformacion_detalles`
--

CREATE TABLE `transformacion_detalles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `peso` decimal(10,3) NOT NULL DEFAULT 0.000,
  `precio` decimal(10,3) NOT NULL DEFAULT 0.000,
  `promedio` decimal(10,3) NOT NULL DEFAULT 0.000,
  `transformacion_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transformacion_detalle_sucursals`
--

CREATE TABLE `transformacion_detalle_sucursals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transformacion_detalle_id` int(11) NOT NULL DEFAULT 1,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `peso` decimal(10,3) NOT NULL DEFAULT 0.000,
  `precio` decimal(10,3) NOT NULL DEFAULT 0.000,
  `promedio` decimal(10,3) NOT NULL DEFAULT 0.000,
  `fecha` datetime NOT NULL,
  `f` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `h` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cambios` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transformacion_items`
--

CREATE TABLE `transformacion_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `peso` decimal(10,3) NOT NULL DEFAULT 0.000,
  `precio` decimal(10,3) NOT NULL DEFAULT 0.000,
  `promedio` decimal(10,3) NOT NULL DEFAULT 0.000,
  `item_id` int(11) NOT NULL DEFAULT 1,
  `transformacion_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transformacion_lotes`
--

CREATE TABLE `transformacion_lotes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecha` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nro` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `curso` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transformacion_lote_detalles`
--

CREATE TABLE `transformacion_lote_detalles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecha_hora` datetime DEFAULT NULL,
  `pp_envio_transformacion_detalle_id` int(11) DEFAULT NULL,
  `transformacion_lote_id` int(11) DEFAULT NULL,
  `cajas` int(11) NOT NULL DEFAULT 0,
  `pollos` int(11) NOT NULL DEFAULT 0,
  `peso_bruto` decimal(8,3) NOT NULL DEFAULT 0.000,
  `peso_neto` decimal(8,3) NOT NULL DEFAULT 0.000,
  `peso_bruto_u` decimal(8,3) NOT NULL DEFAULT 0.000,
  `peso_neto_u` decimal(8,3) NOT NULL DEFAULT 0.000,
  `merma_bruto` decimal(8,3) NOT NULL DEFAULT 0.000,
  `merma_neto` decimal(8,3) NOT NULL DEFAULT 0.000,
  `sucursal_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transformacion_lote_items`
--

CREATE TABLE `transformacion_lote_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transformacion_lote_id` int(11) NOT NULL DEFAULT 1,
  `item_id` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `fecha_hora` datetime DEFAULT NULL,
  `peso_bruto` decimal(8,3) NOT NULL DEFAULT 0.000,
  `peso_neto` decimal(8,3) NOT NULL DEFAULT 0.000,
  `cajas` int(11) NOT NULL DEFAULT 0,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pt_id` int(11) NOT NULL DEFAULT 1,
  `tara` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transformacion_sucursals`
--

CREATE TABLE `transformacion_sucursals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transformacion_id` int(11) NOT NULL DEFAULT 1,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `peso` decimal(10,3) NOT NULL DEFAULT 0.000,
  `precio` decimal(10,3) NOT NULL DEFAULT 0.000,
  `promedio` decimal(10,3) NOT NULL DEFAULT 0.000,
  `fecha` datetime NOT NULL,
  `f` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `h` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cambios` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trans_especials`
--

CREATE TABLE `trans_especials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_id` int(11) NOT NULL DEFAULT 0,
  `precio_aprox` decimal(8,3) NOT NULL DEFAULT 0.000,
  `suma_promedio` decimal(8,3) NOT NULL DEFAULT 0.000,
  `promedio_item` decimal(8,3) NOT NULL DEFAULT 0.000,
  `suma_precio` decimal(8,3) NOT NULL DEFAULT 0.000,
  `suma_peso` decimal(8,3) NOT NULL DEFAULT 0.000,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trans_especial_items`
--

CREATE TABLE `trans_especial_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` int(11) NOT NULL DEFAULT 0,
  `trans_especial_id` int(11) NOT NULL DEFAULT 0,
  `precio` decimal(8,3) NOT NULL DEFAULT 0.000,
  `precio_2` decimal(8,3) NOT NULL DEFAULT 0.000,
  `peso` decimal(8,3) NOT NULL DEFAULT 0.000,
  `promedio` decimal(8,3) NOT NULL DEFAULT 0.000,
  `precio_alternativo_1` decimal(8,2) NOT NULL DEFAULT 0.00,
  `precio_alternativo_2` decimal(8,2) NOT NULL DEFAULT 0.00,
  `precio_alternativo_3` decimal(8,2) NOT NULL DEFAULT 0.00,
  `precio_alternativo_4` decimal(8,2) NOT NULL DEFAULT 0.00,
  `precio_alternativo_5` decimal(8,2) NOT NULL DEFAULT 0.00,
  `estado` int(11) NOT NULL DEFAULT 1,
  `estado_precio_alternativo_1` int(11) NOT NULL DEFAULT 0,
  `estado_precio_alternativo_2` int(11) NOT NULL DEFAULT 0,
  `estado_precio_alternativo_3` int(11) NOT NULL DEFAULT 0,
  `estado_precio_alternativo_4` int(11) NOT NULL DEFAULT 0,
  `estado_precio_alternativo_5` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trans_items`
--

CREATE TABLE `trans_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_id` int(11) NOT NULL DEFAULT 0,
  `precio` decimal(8,3) NOT NULL DEFAULT 0.000,
  `peso` decimal(8,3) NOT NULL DEFAULT 0.000,
  `promedio` decimal(8,3) NOT NULL DEFAULT 0.000,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `suma_promedio` decimal(8,3) NOT NULL DEFAULT 0.000,
  `promedio_item` decimal(8,3) NOT NULL DEFAULT 0.000
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `trans_items`
--

INSERT INTO `trans_items` (`id`, `name`, `item_id`, `precio`, `peso`, `promedio`, `estado`, `created_at`, `updated_at`, `suma_promedio`, `promedio_item`) VALUES
(1, 'FILETE CON PIEL', 2, '25.000', '0.816', '20.400', 1, '2025-08-13 14:36:21', '2025-08-13 14:36:21', '22.112', '27.098'),
(2, 'TRANS. PIERNA FILETADA', 1, '18.000', '0.315', '5.670', 1, '2025-08-13 14:37:12', '2025-08-13 14:37:12', '6.670', '21.175'),
(3, 'TRANS. PIERNA MUSLO', 1, '23.000', '0.340', '7.820', 1, '2025-08-13 14:38:33', '2025-08-13 14:38:33', '7.140', '21.000'),
(4, 'TRANS. DE ALA', 3, '28.000', '0.220', '6.160', 1, '2025-08-13 14:39:30', '2025-08-13 14:39:30', '6.180', '28.091');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trans_item_detalles`
--

CREATE TABLE `trans_item_detalles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` int(11) NOT NULL DEFAULT 0,
  `trans_item_id` int(11) NOT NULL DEFAULT 0,
  `precio` decimal(8,3) NOT NULL DEFAULT 0.000,
  `peso` decimal(8,3) NOT NULL DEFAULT 0.000,
  `promedio` decimal(8,3) NOT NULL DEFAULT 0.000,
  `precio_alternativo_1` decimal(8,2) NOT NULL DEFAULT 0.00,
  `precio_alternativo_2` decimal(8,2) NOT NULL DEFAULT 0.00,
  `precio_alternativo_3` decimal(8,2) NOT NULL DEFAULT 0.00,
  `precio_alternativo_4` decimal(8,2) NOT NULL DEFAULT 0.00,
  `precio_alternativo_5` decimal(8,2) NOT NULL DEFAULT 0.00,
  `estado` int(11) NOT NULL DEFAULT 1,
  `estado_precio_alternativo_1` int(11) NOT NULL DEFAULT 0,
  `estado_precio_alternativo_2` int(11) NOT NULL DEFAULT 0,
  `estado_precio_alternativo_3` int(11) NOT NULL DEFAULT 0,
  `estado_precio_alternativo_4` int(11) NOT NULL DEFAULT 0,
  `estado_precio_alternativo_5` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `trans_item_detalles`
--

INSERT INTO `trans_item_detalles` (`id`, `item_id`, `trans_item_id`, `precio`, `peso`, `promedio`, `precio_alternativo_1`, `precio_alternativo_2`, `precio_alternativo_3`, `precio_alternativo_4`, `precio_alternativo_5`, `estado`, `estado_precio_alternativo_1`, `estado_precio_alternativo_2`, `estado_precio_alternativo_3`, `estado_precio_alternativo_4`, `estado_precio_alternativo_5`, `created_at`, `updated_at`) VALUES
(1, 12, 1, '30.700', '0.692', '21.244', '0.00', '0.00', '0.00', '0.00', '0.00', 1, 0, 0, 0, 0, 0, '2025-08-13 14:36:21', '2025-08-13 14:36:21'),
(2, 10, 1, '7.000', '0.124', '0.868', '0.00', '0.00', '0.00', '0.00', '0.00', 1, 0, 0, 0, 0, 0, '2025-08-13 14:36:21', '2025-08-13 14:36:21'),
(3, 13, 2, '24.500', '0.260', '6.370', '0.00', '0.00', '0.00', '0.00', '0.00', 1, 0, 0, 0, 0, 0, '2025-08-13 14:37:12', '2025-08-13 14:37:12'),
(4, 14, 2, '6.000', '0.050', '0.300', '0.00', '0.00', '0.00', '0.00', '0.00', 1, 0, 0, 0, 0, 0, '2025-08-13 14:37:12', '2025-08-13 14:37:12'),
(5, 15, 3, '21.000', '0.150', '3.150', '0.00', '0.00', '0.00', '0.00', '0.00', 1, 0, 0, 0, 0, 0, '2025-08-13 14:38:33', '2025-08-13 14:38:33'),
(6, 16, 3, '21.000', '0.190', '3.990', '0.00', '0.00', '0.00', '0.00', '0.00', 1, 0, 0, 0, 0, 0, '2025-08-13 14:38:33', '2025-08-13 14:38:33'),
(7, 17, 4, '29.000', '0.170', '4.930', '0.00', '0.00', '0.00', '0.00', '0.00', 1, 0, 0, 0, 0, 0, '2025-08-13 14:39:30', '2025-08-13 14:39:30'),
(8, 18, 4, '29.000', '0.040', '1.160', '0.00', '0.00', '0.00', '0.00', '0.00', 1, 0, 0, 0, 0, 0, '2025-08-13 14:39:30', '2025-08-13 14:39:30'),
(9, 19, 4, '9.000', '0.010', '0.090', '0.00', '0.00', '0.00', '0.00', '0.00', 1, 0, 0, 0, 0, 0, '2025-08-13 14:39:30', '2025-08-13 14:39:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `traspaso_cajas`
--

CREATE TABLE `traspaso_cajas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecha` date DEFAULT NULL,
  `almacen_origen_id` int(11) NOT NULL DEFAULT 1,
  `almacen_destino_id` int(11) NOT NULL DEFAULT 1,
  `caja_id` int(11) NOT NULL DEFAULT 1,
  `motivo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `traspaso_dotacions`
--

CREATE TABLE `traspaso_dotacions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `motivo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `sucursal_destino_id` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `traspaso_dotacion_detalles`
--

CREATE TABLE `traspaso_dotacion_detalles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stockdotaciondetail_id` int(11) NOT NULL DEFAULT 1,
  `traspaso_dotacion_id` int(11) NOT NULL DEFAULT 1,
  `cantidad` decimal(8,2) NOT NULL DEFAULT 1.00,
  `costo` decimal(8,2) NOT NULL DEFAULT 1.00,
  `venta` decimal(8,2) NOT NULL DEFAULT 1.00,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `traspaso_pps`
--

CREATE TABLE `traspaso_pps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pp_id` int(11) NOT NULL DEFAULT 0,
  `cajas` int(8) NOT NULL DEFAULT 0,
  `pollos` int(11) NOT NULL DEFAULT 0,
  `peso_bruto` decimal(10,3) NOT NULL DEFAULT 0.000,
  `peso_neto` decimal(10,3) NOT NULL DEFAULT 0.000,
  `merma_bruta` decimal(10,3) NOT NULL DEFAULT 0.000,
  `merma_neta` decimal(10,3) NOT NULL DEFAULT 0.000,
  `tipo` int(11) NOT NULL DEFAULT 1,
  `aceptado` int(11) NOT NULL DEFAULT 0,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `cinta_cliente_id` int(11) NOT NULL DEFAULT 1,
  `pigmento` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `traspaso_pp_detalles`
--

CREATE TABLE `traspaso_pp_detalles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `traspaso_pp_id` int(11) NOT NULL DEFAULT 1,
  `lote_detalle_id` int(11) NOT NULL DEFAULT 1,
  `cajas` int(8) NOT NULL DEFAULT 0,
  `pollos` int(11) NOT NULL DEFAULT 0,
  `peso_bruto` decimal(10,3) NOT NULL DEFAULT 0.000,
  `peso_neto` decimal(10,3) NOT NULL DEFAULT 0.000,
  `merma_neta` decimal(10,3) NOT NULL DEFAULT 0.000,
  `merma_bruta` decimal(10,3) NOT NULL DEFAULT 0.000,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pigmento` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `traspaso_pp_envios`
--

CREATE TABLE `traspaso_pp_envios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `traspaso_pp_id` int(11) NOT NULL DEFAULT 0,
  `cajas` decimal(10,3) NOT NULL DEFAULT 0.000,
  `pollos` int(11) NOT NULL DEFAULT 0,
  `peso_bruto` decimal(10,3) NOT NULL DEFAULT 0.000,
  `peso_neto` decimal(10,3) NOT NULL DEFAULT 0.000,
  `merma_bruta` decimal(10,3) NOT NULL DEFAULT 0.000,
  `merma_neta` decimal(10,3) NOT NULL DEFAULT 0.000,
  `tipo` int(11) NOT NULL DEFAULT 1,
  `aceptado` int(11) NOT NULL DEFAULT 0,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pigmento` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turno_chofers`
--

CREATE TABLE `turno_chofers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecha` date DEFAULT NULL,
  `hora_inicio` time DEFAULT NULL,
  `chofer_id` int(11) NOT NULL DEFAULT 1,
  `apertura` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `turno_chofers`
--

INSERT INTO `turno_chofers` (`id`, `fecha`, `hora_inicio`, `chofer_id`, `apertura`, `estado`, `created_at`, `updated_at`) VALUES
(1, '2024-01-12', '11:26:27', 2, 1, 1, '2024-01-12 16:26:27', '2024-01-12 16:26:27'),
(2, '2025-06-10', '10:08:40', 4, 1, 1, '2025-06-10 14:08:40', '2025-06-10 14:08:40'),
(3, '2025-06-10', '10:08:46', 3, 1, 1, '2025-06-10 14:08:46', '2025-06-10 14:08:46'),
(4, '2025-06-27', '21:25:42', 1, 1, 1, '2025-06-28 01:25:42', '2025-06-28 01:25:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apellidos` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usuario` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `nombre`, `apellidos`, `correo`, `usuario`, `password`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'DEMO', 'DEMO', 'DEMO', 'DEMO', '$2y$12$yG8AqU5gwIbTSaiy/nXqZ.JmlzwWm7om7IcC4TWL8SHR5UOOBFK9u', 1, '2023-02-09 16:25:19', '2023-02-09 16:25:19'),
(2, 'DOS', 'DOS', 'DOS', 'DOS', '$2y$12$yG8AqU5gwIbTSaiy/nXqZ.JmlzwWm7om7IcC4TWL8SHR5UOOBFK9u', 1, '2023-06-05 10:55:33', '2023-06-05 10:55:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `validar_cajas`
--

CREATE TABLE `validar_cajas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `motivo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `compra_id` int(11) NOT NULL DEFAULT 1,
  `destino_id` int(11) NOT NULL DEFAULT 1,
  `origen_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `fecha` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `chofer` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `placa` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `validar_caja_detalles`
--

CREATE TABLE `validar_caja_detalles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `motivo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock` decimal(10,3) NOT NULL DEFAULT 0.000,
  `destino_stock_anterior` decimal(10,3) NOT NULL DEFAULT 0.000,
  `destino_stock_actual` decimal(10,3) NOT NULL DEFAULT 0.000,
  `cantidad` decimal(10,3) NOT NULL DEFAULT 0.000,
  `compra_id` int(11) NOT NULL DEFAULT 1,
  `validar_caja_id` int(11) NOT NULL DEFAULT 1,
  `destino_id` int(11) NOT NULL DEFAULT 1,
  `origen_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `fecha` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ticket_cobranza_first_printed_at` timestamp NULL DEFAULT NULL,
  `cobranza_first_printed_at` timestamp NULL DEFAULT NULL,
  `ticket_cobranza_print_count` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `cobranza_print_count` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `preventista_id` int(11) NOT NULL DEFAULT 1,
  `cliente_id` int(11) NOT NULL DEFAULT 1,
  `chofer_id` int(11) NOT NULL DEFAULT 1,
  `fecha_entrega` date DEFAULT NULL,
  `hora_entrega` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acuerdo_cliente_id` int(11) NOT NULL DEFAULT 1,
  `observacion` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metodo_pago` int(11) DEFAULT 1,
  `despachado` int(11) DEFAULT 1,
  `entregado` int(11) DEFAULT 1,
  `total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `pagado_total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `pendiente_total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `distribuidor_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_acuerdos`
--

CREATE TABLE `venta_acuerdos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `venta_id` int(11) NOT NULL DEFAULT 0,
  `item` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cod` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cajas` int(11) NOT NULL DEFAULT 0,
  `unidad` int(11) NOT NULL DEFAULT 0,
  `peso_bruto` decimal(10,3) NOT NULL DEFAULT 0.000,
  `peso_neto` decimal(10,3) NOT NULL DEFAULT 0.000,
  `tara` decimal(10,3) NOT NULL DEFAULT 0.000,
  `precio_kg` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_cajas`
--

CREATE TABLE `venta_cajas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `venta_id` int(11) NOT NULL DEFAULT 1,
  `cliente_id` int(11) NOT NULL DEFAULT 1,
  `cajas` int(11) NOT NULL DEFAULT 0,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_cerradas`
--

CREATE TABLE `venta_cerradas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `venta_id` int(11) NOT NULL DEFAULT 1,
  `fecha` datetime DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_detalle_pps`
--

CREATE TABLE `venta_detalle_pps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecha` date DEFAULT NULL,
  `cajas` decimal(10,3) NOT NULL DEFAULT 0.000,
  `pollos` int(11) NOT NULL DEFAULT 0,
  `peso_bruto` decimal(10,3) NOT NULL DEFAULT 0.000,
  `peso_neto` decimal(10,3) NOT NULL DEFAULT 0.000,
  `pp_id` int(11) NOT NULL DEFAULT 1,
  `venta_id` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `item_id` int(11) NOT NULL DEFAULT 1,
  `precio` decimal(10,3) NOT NULL DEFAULT 0.000,
  `hora` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cinta_cliente_id` int(11) NOT NULL DEFAULT 1,
  `cliente_id` int(11) NOT NULL DEFAULT 1,
  `precio_acuerdo` decimal(8,2) NOT NULL DEFAULT 0.00,
  `total` decimal(8,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_gastos`
--

CREATE TABLE `venta_gastos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `venta_id` int(11) NOT NULL DEFAULT 0,
  `detalle` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `valor` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_items_pts`
--

CREATE TABLE `venta_items_pts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecha` date DEFAULT NULL,
  `pt_id` int(11) DEFAULT NULL,
  `items_pt_id` int(11) DEFAULT NULL,
  `venta_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `cajas` decimal(10,3) DEFAULT NULL,
  `taras` decimal(10,3) DEFAULT NULL,
  `peso_bruto` decimal(10,3) DEFAULT NULL,
  `peso_neto` decimal(10,3) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `precio` decimal(8,2) NOT NULL DEFAULT 0.00,
  `total` decimal(8,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_pps`
--

CREATE TABLE `venta_pps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `venta_id` int(11) NOT NULL DEFAULT 1,
  `pp_id` int(11) NOT NULL DEFAULT 1,
  `fecha` datetime DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_pts`
--

CREATE TABLE `venta_pts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `venta_id` int(11) NOT NULL DEFAULT 1,
  `pt_id` int(11) NOT NULL DEFAULT 1,
  `fecha` datetime DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_transformacions`
--

CREATE TABLE `venta_transformacions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `venta_id` int(11) NOT NULL DEFAULT 1,
  `transformacion_id` int(11) NOT NULL DEFAULT 1,
  `sucursal_id` int(11) NOT NULL DEFAULT 1,
  `subitem_id` int(11) NOT NULL DEFAULT 1,
  `pt_id` int(11) NOT NULL DEFAULT 1,
  `cajas` int(11) NOT NULL DEFAULT 0,
  `venta` decimal(8,2) NOT NULL DEFAULT 0.00,
  `total` decimal(8,2) NOT NULL DEFAULT 0.00,
  `peso_bruto` decimal(8,3) NOT NULL DEFAULT 0.000,
  `peso_neto` decimal(8,3) NOT NULL DEFAULT 0.000,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_turno_chofers`
--

CREATE TABLE `venta_turno_chofers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `turno_chofer_id` int(11) NOT NULL DEFAULT 1,
  `venta_id` int(11) NOT NULL DEFAULT 1,
  `peso` decimal(10,3) NOT NULL DEFAULT 0.000,
  `fecha` date DEFAULT NULL,
  `entregado` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zona_despachos`
--

CREATE TABLE `zona_despachos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `zona_despachos`
--

INSERT INTO `zona_despachos` (`id`, `name`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'PUENTE VELA', 1, '2024-11-13 10:46:30', '2024-11-13 10:46:40'),
(2, 'SAN MARTIN', 1, '2024-11-13 10:47:00', '2024-11-13 10:47:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acuerdo_clientes`
--
ALTER TABLE `acuerdo_clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `adeudacuotas`
--
ALTER TABLE `adeudacuotas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `adeudas`
--
ALTER TABLE `adeudas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `adeuda_planillas`
--
ALTER TABLE `adeuda_planillas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ajustedotaciondetalles`
--
ALTER TABLE `ajustedotaciondetalles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ajustedotacions`
--
ALTER TABLE `ajustedotacions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `almacens`
--
ALTER TABLE `almacens`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `arqueos`
--
ALTER TABLE `arqueos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `arqueo_ingresos`
--
ALTER TABLE `arqueo_ingresos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `arqueo_ventas`
--
ALTER TABLE `arqueo_ventas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `arqueo_venta_pago_global`
--
ALTER TABLE `arqueo_venta_pago_global`
  ADD PRIMARY KEY (`id`),
  ADD KEY `arqueo_venta_pago_global_pago_global_id_foreign` (`pago_global_id`),
  ADD KEY `arqueo_venta_pago_global_arqueo_venta_id_foreign` (`arqueo_venta_id`);

--
-- Indices de la tabla `ave_inventarios`
--
ALTER TABLE `ave_inventarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `bancos`
--
ALTER TABLE `bancos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `banderas`
--
ALTER TABLE `banderas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `bitacora_lotes`
--
ALTER TABLE `bitacora_lotes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cajacerrada_clientes`
--
ALTER TABLE `cajacerrada_clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cajas`
--
ALTER TABLE `cajas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `caja_ajustes`
--
ALTER TABLE `caja_ajustes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `caja_ajuste_detalles`
--
ALTER TABLE `caja_ajuste_detalles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `caja_compras`
--
ALTER TABLE `caja_compras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `caja_compras_aves`
--
ALTER TABLE `caja_compras_aves`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `caja_entradas`
--
ALTER TABLE `caja_entradas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `caja_envios`
--
ALTER TABLE `caja_envios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `caja_inventarios`
--
ALTER TABLE `caja_inventarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `caja_motivos`
--
ALTER TABLE `caja_motivos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `caja_proveedors`
--
ALTER TABLE `caja_proveedors`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `caja_sucursals`
--
ALTER TABLE `caja_sucursals`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `caja_sucursal_usuarios`
--
ALTER TABLE `caja_sucursal_usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `caja_venta_clientes`
--
ALTER TABLE `caja_venta_clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cambio_precios`
--
ALTER TABLE `cambio_precios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cambio_precio_consolidacions`
--
ALTER TABLE `cambio_precio_consolidacions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cambio_precio_consolidacions_consolidacion_id_foreign` (`consolidacion_id`),
  ADD KEY `cambio_precio_consolidacions_consolidacion_detalle_id_foreign` (`consolidacion_detalle_id`),
  ADD KEY `cambio_precio_consolidacions_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `cambio_precio_consolidacion_aves`
--
ALTER TABLE `cambio_precio_consolidacion_aves`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cambio_precio_consolidacion_aves_new`
--
ALTER TABLE `cambio_precio_consolidacion_aves_new`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `chofers`
--
ALTER TABLE `chofers`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cinta_clientes`
--
ALTER TABLE `cinta_clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cliente_cajacerradas`
--
ALTER TABLE `cliente_cajacerradas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cliente_files`
--
ALTER TABLE `cliente_files`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cliente_pps`
--
ALTER TABLE `cliente_pps`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cliente_pts`
--
ALTER TABLE `cliente_pts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cogplanillas`
--
ALTER TABLE `cogplanillas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compo_externas`
--
ALTER TABLE `compo_externas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compo_externa_detalles`
--
ALTER TABLE `compo_externa_detalles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compo_externa_files`
--
ALTER TABLE `compo_externa_files`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compo_internas`
--
ALTER TABLE `compo_internas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compo_interna_files`
--
ALTER TABLE `compo_interna_files`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compras_aves`
--
ALTER TABLE `compras_aves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `compras_aves_user_id_foreign` (`user_id`),
  ADD KEY `compras_aves_sucursal_id_foreign` (`sucursal_id`),
  ADD KEY `compras_aves_proveedor_compra_id_foreign` (`proveedor_compra_id`),
  ADD KEY `compras_aves_almacen_id_foreign` (`almacen_id`);

--
-- Indices de la tabla `compra_ave_inventarios`
--
ALTER TABLE `compra_ave_inventarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compra_cajas`
--
ALTER TABLE `compra_cajas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compra_caja_detalles`
--
ALTER TABLE `compra_caja_detalles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compra_inventarios`
--
ALTER TABLE `compra_inventarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comprobantes`
--
ALTER TABLE `comprobantes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `consolidacionavenew_pagos`
--
ALTER TABLE `consolidacionavenew_pagos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `consolidacionavenew_pago_detalles`
--
ALTER TABLE `consolidacionavenew_pago_detalles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `consolidacionavenew_pago_tickets`
--
ALTER TABLE `consolidacionavenew_pago_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `consolidacionave_pagos`
--
ALTER TABLE `consolidacionave_pagos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `consolidacionave_pago_detalles`
--
ALTER TABLE `consolidacionave_pago_detalles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `consolidacionave_pago_tickets`
--
ALTER TABLE `consolidacionave_pago_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `consolidacionparams`
--
ALTER TABLE `consolidacionparams`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `consolidacions`
--
ALTER TABLE `consolidacions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `consolidacions_ave`
--
ALTER TABLE `consolidacions_ave`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `consolidacions_ave_new`
--
ALTER TABLE `consolidacions_ave_new`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `consolidacion_ave_detalles`
--
ALTER TABLE `consolidacion_ave_detalles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `consolidacion_ave_new_detalles`
--
ALTER TABLE `consolidacion_ave_new_detalles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `consolidacion_detalles`
--
ALTER TABLE `consolidacion_detalles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `consolidacion_pagos`
--
ALTER TABLE `consolidacion_pagos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `consolidacion_pago_detalles`
--
ALTER TABLE `consolidacion_pago_detalles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `consolidacion_pago_tickets`
--
ALTER TABLE `consolidacion_pago_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `contratocostos`
--
ALTER TABLE `contratocostos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `contratos`
--
ALTER TABLE `contratos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `costofijos`
--
ALTER TABLE `costofijos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `costovariables`
--
ALTER TABLE `costovariables`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `descomponer_pts`
--
ALTER TABLE `descomponer_pts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `descomponer_transformacion_lotes`
--
ALTER TABLE `descomponer_transformacion_lotes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `despacho_arqueos`
--
ALTER TABLE `despacho_arqueos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `desplegue_pps`
--
ALTER TABLE `desplegue_pps`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_pps`
--
ALTER TABLE `detalle_pps`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_pp_descomposicions`
--
ALTER TABLE `detalle_pp_descomposicions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_pts`
--
ALTER TABLE `detalle_pts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_pt_descomposicions`
--
ALTER TABLE `detalle_pt_descomposicions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `devosalidotacontras`
--
ALTER TABLE `devosalidotacontras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `documentacions`
--
ALTER TABLE `documentacions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `dotacions`
--
ALTER TABLE `dotacions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `entrega_cajas`
--
ALTER TABLE `entrega_cajas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `entrega_cajas_recuperadas`
--
ALTER TABLE `entrega_cajas_recuperadas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `enviar_item_pt_transformacions`
--
ALTER TABLE `enviar_item_pt_transformacions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `envio_gen_pps`
--
ALTER TABLE `envio_gen_pps`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `envio_gen_pp_detalles`
--
ALTER TABLE `envio_gen_pp_detalles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `envio_gen_pts`
--
ALTER TABLE `envio_gen_pts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `envio_gen_pt_detalles`
--
ALTER TABLE `envio_gen_pt_detalles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estado_compra_chofers`
--
ALTER TABLE `estado_compra_chofers`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `familias`
--
ALTER TABLE `familias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `filemonedas`
--
ALTER TABLE `filemonedas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `filemonedas_moneda_id_foreign` (`moneda_id`);

--
-- Indices de la tabla `filepersonas`
--
ALTER TABLE `filepersonas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `filesucursals`
--
ALTER TABLE `filesucursals`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `finiaguinaldodetalles`
--
ALTER TABLE `finiaguinaldodetalles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `finiaguinaldos`
--
ALTER TABLE `finiaguinaldos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `finianualdetalles`
--
ALTER TABLE `finianualdetalles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `finiquinqueniodetalles`
--
ALTER TABLE `finiquinqueniodetalles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `finiquinquenios`
--
ALTER TABLE `finiquinquenios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `finiquitoanuals`
--
ALTER TABLE `finiquitoanuals`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `finivacacionaldetalles`
--
ALTER TABLE `finivacacionaldetalles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `finivacacionalplanillas`
--
ALTER TABLE `finivacacionalplanillas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `finivacacionals`
--
ALTER TABLE `finivacacionals`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `formapagos`
--
ALTER TABLE `formapagos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `forma_pedidos`
--
ALTER TABLE `forma_pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `gastos_extras_aves`
--
ALTER TABLE `gastos_extras_aves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gastos_extras_aves_consolidacion_id_foreign` (`consolidacion_id`);

--
-- Indices de la tabla `informe_detalles`
--
ALTER TABLE `informe_detalles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `informe_preliminars`
--
ALTER TABLE `informe_preliminars`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inventarios`
--
ALTER TABLE `inventarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `items_pts`
--
ALTER TABLE `items_pts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `item_files`
--
ALTER TABLE `item_files`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `item_pollos`
--
ALTER TABLE `item_pollos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `item_precios`
--
ALTER TABLE `item_precios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `item_pt_movimientos`
--
ALTER TABLE `item_pt_movimientos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `item_pt_transformacion_lotes`
--
ALTER TABLE `item_pt_transformacion_lotes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `item_sobra_pts`
--
ALTER TABLE `item_sobra_pts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `kardex_dotacions`
--
ALTER TABLE `kardex_dotacions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `liquidacions`
--
ALTER TABLE `liquidacions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lotes`
--
ALTER TABLE `lotes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lotes_aves`
--
ALTER TABLE `lotes_aves`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lote_aves_detalles`
--
ALTER TABLE `lote_aves_detalles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lote_detalles`
--
ALTER TABLE `lote_detalles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lote_detalle_clientes`
--
ALTER TABLE `lote_detalle_clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lote_detalle_compras`
--
ALTER TABLE `lote_detalle_compras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lote_detalle_compras_aves`
--
ALTER TABLE `lote_detalle_compras_aves`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lote_detalle_historials`
--
ALTER TABLE `lote_detalle_historials`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lote_detalle_movimientos`
--
ALTER TABLE `lote_detalle_movimientos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lote_detalle_productos`
--
ALTER TABLE `lote_detalle_productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lote_detalle_seguimientos`
--
ALTER TABLE `lote_detalle_seguimientos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lote_detalle_ventas`
--
ALTER TABLE `lote_detalle_ventas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lote_envio_pppts`
--
ALTER TABLE `lote_envio_pppts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lote_envio_pps`
--
ALTER TABLE `lote_envio_pps`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lote_envio_pts`
--
ALTER TABLE `lote_envio_pts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lote_trozado_pps`
--
ALTER TABLE `lote_trozado_pps`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lote_trozado_pts`
--
ALTER TABLE `lote_trozado_pts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `medidas`
--
ALTER TABLE `medidas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `medida_productos`
--
ALTER TABLE `medida_productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `memorandums`
--
ALTER TABLE `memorandums`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `monedas`
--
ALTER TABLE `monedas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `motivomemorandums`
--
ALTER TABLE `motivomemorandums`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pagos_globales`
--
ALTER TABLE `pagos_globales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pago_compra_cajas`
--
ALTER TABLE `pago_compra_cajas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `parametrovacacions`
--
ALTER TABLE `parametrovacacions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedido_clientes`
--
ALTER TABLE `pedido_clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedido_cliente_detalles`
--
ALTER TABLE `pedido_cliente_detalles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `planillacostos`
--
ALTER TABLE `planillacostos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `planillas`
--
ALTER TABLE `planillas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `planillaserviciocostos`
--
ALTER TABLE `planillaserviciocostos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `planillaservicios`
--
ALTER TABLE `planillaservicios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pollolimpios`
--
ALTER TABLE `pollolimpios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pollolimpio_cambios`
--
ALTER TABLE `pollolimpio_cambios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pollolimpio_sucursals`
--
ALTER TABLE `pollolimpio_sucursals`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pollo_sucursals`
--
ALTER TABLE `pollo_sucursals`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pps`
--
ALTER TABLE `pps`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pp_detalles`
--
ALTER TABLE `pp_detalles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pp_detalle_descomposicions`
--
ALTER TABLE `pp_detalle_descomposicions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pp_envio_transformacions`
--
ALTER TABLE `pp_envio_transformacions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pp_envio_transformacion_detalles`
--
ALTER TABLE `pp_envio_transformacion_detalles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pp_pts`
--
ALTER TABLE `pp_pts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pp_traspaso_pps`
--
ALTER TABLE `pp_traspaso_pps`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto_precios`
--
ALTER TABLE `producto_precios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto_precio_cambios`
--
ALTER TABLE `producto_precio_cambios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto_precio_lotes`
--
ALTER TABLE `producto_precio_lotes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto_precio_sucursals`
--
ALTER TABLE `producto_precio_sucursals`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `promedio_mermas`
--
ALTER TABLE `promedio_mermas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `promedio_pollolimpios`
--
ALTER TABLE `promedio_pollolimpios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proveedors`
--
ALTER TABLE `proveedors`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proveedor_categorias`
--
ALTER TABLE `proveedor_categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proveedor_categoria_detalles`
--
ALTER TABLE `proveedor_categoria_detalles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proveedor_compras`
--
ALTER TABLE `proveedor_compras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proveedor_compra_medidas`
--
ALTER TABLE `proveedor_compra_medidas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pts`
--
ALTER TABLE `pts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pt_detalles`
--
ALTER TABLE `pt_detalles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pt_detalle_descomposicions`
--
ALTER TABLE `pt_detalle_descomposicions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pt_detalle_sub_descomposicions`
--
ALTER TABLE `pt_detalle_sub_descomposicions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pt_sobra_pps`
--
ALTER TABLE `pt_sobra_pps`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pt_traspaso_pps`
--
ALTER TABLE `pt_traspaso_pps`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `redotaciondetalles`
--
ALTER TABLE `redotaciondetalles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `redotacions`
--
ALTER TABLE `redotacions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `salidadotacioncontratos`
--
ALTER TABLE `salidadotacioncontratos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `salidadotaclidetalles`
--
ALTER TABLE `salidadotaclidetalles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `salidadotaclientes`
--
ALTER TABLE `salidadotaclientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `salidotacontradetas`
--
ALTER TABLE `salidotacontradetas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sobra_detalle_pps`
--
ALTER TABLE `sobra_detalle_pps`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sobra_pps`
--
ALTER TABLE `sobra_pps`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `stockdotaciondetails`
--
ALTER TABLE `stockdotaciondetails`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `stockdotacions`
--
ALTER TABLE `stockdotacions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `subdetalle_descuento_acuerdo`
--
ALTER TABLE `subdetalle_descuento_acuerdo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sub_des_detalle_pts`
--
ALTER TABLE `sub_des_detalle_pts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sub_des_pt_detalle_descos`
--
ALTER TABLE `sub_des_pt_detalle_descos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sub_items`
--
ALTER TABLE `sub_items`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sub_item_pt_transformacion_lotes`
--
ALTER TABLE `sub_item_pt_transformacion_lotes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sub_medidas`
--
ALTER TABLE `sub_medidas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sucursals`
--
ALTER TABLE `sucursals`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sucursal_tirajes`
--
ALTER TABLE `sucursal_tirajes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipoarchivos`
--
ALTER TABLE `tipoarchivos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipoclientes`
--
ALTER TABLE `tipoclientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipocontratos`
--
ALTER TABLE `tipocontratos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipopagos`
--
ALTER TABLE `tipopagos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_cliente_pps`
--
ALTER TABLE `tipo_cliente_pps`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_cliente_pp_limpios`
--
ALTER TABLE `tipo_cliente_pp_limpios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_negocios`
--
ALTER TABLE `tipo_negocios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `transformacions`
--
ALTER TABLE `transformacions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `transformacion_detalles`
--
ALTER TABLE `transformacion_detalles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `transformacion_detalle_sucursals`
--
ALTER TABLE `transformacion_detalle_sucursals`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `transformacion_items`
--
ALTER TABLE `transformacion_items`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `transformacion_lotes`
--
ALTER TABLE `transformacion_lotes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `transformacion_lote_detalles`
--
ALTER TABLE `transformacion_lote_detalles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `transformacion_lote_items`
--
ALTER TABLE `transformacion_lote_items`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `transformacion_sucursals`
--
ALTER TABLE `transformacion_sucursals`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `trans_especials`
--
ALTER TABLE `trans_especials`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `trans_especial_items`
--
ALTER TABLE `trans_especial_items`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `trans_items`
--
ALTER TABLE `trans_items`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `trans_item_detalles`
--
ALTER TABLE `trans_item_detalles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `traspaso_cajas`
--
ALTER TABLE `traspaso_cajas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `traspaso_dotacions`
--
ALTER TABLE `traspaso_dotacions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `traspaso_dotacion_detalles`
--
ALTER TABLE `traspaso_dotacion_detalles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `traspaso_pps`
--
ALTER TABLE `traspaso_pps`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `traspaso_pp_detalles`
--
ALTER TABLE `traspaso_pp_detalles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `traspaso_pp_envios`
--
ALTER TABLE `traspaso_pp_envios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `turno_chofers`
--
ALTER TABLE `turno_chofers`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `validar_cajas`
--
ALTER TABLE `validar_cajas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `validar_caja_detalles`
--
ALTER TABLE `validar_caja_detalles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `venta_acuerdos`
--
ALTER TABLE `venta_acuerdos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `venta_cajas`
--
ALTER TABLE `venta_cajas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `venta_cerradas`
--
ALTER TABLE `venta_cerradas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `venta_detalle_pps`
--
ALTER TABLE `venta_detalle_pps`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `venta_gastos`
--
ALTER TABLE `venta_gastos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `venta_items_pts`
--
ALTER TABLE `venta_items_pts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `venta_pps`
--
ALTER TABLE `venta_pps`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `venta_pts`
--
ALTER TABLE `venta_pts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `venta_transformacions`
--
ALTER TABLE `venta_transformacions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `venta_turno_chofers`
--
ALTER TABLE `venta_turno_chofers`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `zona_despachos`
--
ALTER TABLE `zona_despachos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acuerdo_clientes`
--
ALTER TABLE `acuerdo_clientes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `adeudacuotas`
--
ALTER TABLE `adeudacuotas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `adeudas`
--
ALTER TABLE `adeudas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `adeuda_planillas`
--
ALTER TABLE `adeuda_planillas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ajustedotaciondetalles`
--
ALTER TABLE `ajustedotaciondetalles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ajustedotacions`
--
ALTER TABLE `ajustedotacions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `almacens`
--
ALTER TABLE `almacens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `arqueos`
--
ALTER TABLE `arqueos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `arqueo_ingresos`
--
ALTER TABLE `arqueo_ingresos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `arqueo_ventas`
--
ALTER TABLE `arqueo_ventas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `arqueo_venta_pago_global`
--
ALTER TABLE `arqueo_venta_pago_global`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ave_inventarios`
--
ALTER TABLE `ave_inventarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `bancos`
--
ALTER TABLE `bancos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `banderas`
--
ALTER TABLE `banderas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `bitacora_lotes`
--
ALTER TABLE `bitacora_lotes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cajacerrada_clientes`
--
ALTER TABLE `cajacerrada_clientes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cajas`
--
ALTER TABLE `cajas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `caja_ajustes`
--
ALTER TABLE `caja_ajustes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `caja_ajuste_detalles`
--
ALTER TABLE `caja_ajuste_detalles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `caja_compras`
--
ALTER TABLE `caja_compras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `caja_compras_aves`
--
ALTER TABLE `caja_compras_aves`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `caja_entradas`
--
ALTER TABLE `caja_entradas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `caja_envios`
--
ALTER TABLE `caja_envios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `caja_inventarios`
--
ALTER TABLE `caja_inventarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `caja_motivos`
--
ALTER TABLE `caja_motivos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `caja_proveedors`
--
ALTER TABLE `caja_proveedors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `caja_sucursals`
--
ALTER TABLE `caja_sucursals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `caja_sucursal_usuarios`
--
ALTER TABLE `caja_sucursal_usuarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `caja_venta_clientes`
--
ALTER TABLE `caja_venta_clientes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cambio_precios`
--
ALTER TABLE `cambio_precios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cambio_precio_consolidacions`
--
ALTER TABLE `cambio_precio_consolidacions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cambio_precio_consolidacion_aves`
--
ALTER TABLE `cambio_precio_consolidacion_aves`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cambio_precio_consolidacion_aves_new`
--
ALTER TABLE `cambio_precio_consolidacion_aves_new`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `chofers`
--
ALTER TABLE `chofers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `cinta_clientes`
--
ALTER TABLE `cinta_clientes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `cliente_cajacerradas`
--
ALTER TABLE `cliente_cajacerradas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `cliente_files`
--
ALTER TABLE `cliente_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cliente_pps`
--
ALTER TABLE `cliente_pps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cliente_pts`
--
ALTER TABLE `cliente_pts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cogplanillas`
--
ALTER TABLE `cogplanillas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `compo_externas`
--
ALTER TABLE `compo_externas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `compo_externa_detalles`
--
ALTER TABLE `compo_externa_detalles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `compo_externa_files`
--
ALTER TABLE `compo_externa_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `compo_internas`
--
ALTER TABLE `compo_internas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `compo_interna_files`
--
ALTER TABLE `compo_interna_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `compras_aves`
--
ALTER TABLE `compras_aves`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `compra_ave_inventarios`
--
ALTER TABLE `compra_ave_inventarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `compra_cajas`
--
ALTER TABLE `compra_cajas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `compra_caja_detalles`
--
ALTER TABLE `compra_caja_detalles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `compra_inventarios`
--
ALTER TABLE `compra_inventarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comprobantes`
--
ALTER TABLE `comprobantes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `consolidacionavenew_pagos`
--
ALTER TABLE `consolidacionavenew_pagos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `consolidacionavenew_pago_detalles`
--
ALTER TABLE `consolidacionavenew_pago_detalles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `consolidacionavenew_pago_tickets`
--
ALTER TABLE `consolidacionavenew_pago_tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `consolidacionave_pagos`
--
ALTER TABLE `consolidacionave_pagos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `consolidacionave_pago_detalles`
--
ALTER TABLE `consolidacionave_pago_detalles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `consolidacionave_pago_tickets`
--
ALTER TABLE `consolidacionave_pago_tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `consolidacionparams`
--
ALTER TABLE `consolidacionparams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `consolidacions`
--
ALTER TABLE `consolidacions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `consolidacions_ave`
--
ALTER TABLE `consolidacions_ave`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `consolidacions_ave_new`
--
ALTER TABLE `consolidacions_ave_new`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `consolidacion_ave_detalles`
--
ALTER TABLE `consolidacion_ave_detalles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `consolidacion_ave_new_detalles`
--
ALTER TABLE `consolidacion_ave_new_detalles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `consolidacion_detalles`
--
ALTER TABLE `consolidacion_detalles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `consolidacion_pagos`
--
ALTER TABLE `consolidacion_pagos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `consolidacion_pago_detalles`
--
ALTER TABLE `consolidacion_pago_detalles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `consolidacion_pago_tickets`
--
ALTER TABLE `consolidacion_pago_tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `contratocostos`
--
ALTER TABLE `contratocostos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `contratos`
--
ALTER TABLE `contratos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `costofijos`
--
ALTER TABLE `costofijos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `costovariables`
--
ALTER TABLE `costovariables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `descomponer_pts`
--
ALTER TABLE `descomponer_pts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `descomponer_transformacion_lotes`
--
ALTER TABLE `descomponer_transformacion_lotes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `despacho_arqueos`
--
ALTER TABLE `despacho_arqueos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `desplegue_pps`
--
ALTER TABLE `desplegue_pps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_pps`
--
ALTER TABLE `detalle_pps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_pp_descomposicions`
--
ALTER TABLE `detalle_pp_descomposicions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_pts`
--
ALTER TABLE `detalle_pts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_pt_descomposicions`
--
ALTER TABLE `detalle_pt_descomposicions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `devosalidotacontras`
--
ALTER TABLE `devosalidotacontras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `documentacions`
--
ALTER TABLE `documentacions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `documentos`
--
ALTER TABLE `documentos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `dotacions`
--
ALTER TABLE `dotacions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `entrega_cajas`
--
ALTER TABLE `entrega_cajas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `entrega_cajas_recuperadas`
--
ALTER TABLE `entrega_cajas_recuperadas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `enviar_item_pt_transformacions`
--
ALTER TABLE `enviar_item_pt_transformacions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `envio_gen_pps`
--
ALTER TABLE `envio_gen_pps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `envio_gen_pp_detalles`
--
ALTER TABLE `envio_gen_pp_detalles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `envio_gen_pts`
--
ALTER TABLE `envio_gen_pts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `envio_gen_pt_detalles`
--
ALTER TABLE `envio_gen_pt_detalles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estado_compra_chofers`
--
ALTER TABLE `estado_compra_chofers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `familias`
--
ALTER TABLE `familias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `filemonedas`
--
ALTER TABLE `filemonedas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `filepersonas`
--
ALTER TABLE `filepersonas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `files`
--
ALTER TABLE `files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `filesucursals`
--
ALTER TABLE `filesucursals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `finiaguinaldodetalles`
--
ALTER TABLE `finiaguinaldodetalles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `finiaguinaldos`
--
ALTER TABLE `finiaguinaldos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `finianualdetalles`
--
ALTER TABLE `finianualdetalles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `finiquinqueniodetalles`
--
ALTER TABLE `finiquinqueniodetalles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `finiquinquenios`
--
ALTER TABLE `finiquinquenios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `finiquitoanuals`
--
ALTER TABLE `finiquitoanuals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `finivacacionaldetalles`
--
ALTER TABLE `finivacacionaldetalles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `finivacacionalplanillas`
--
ALTER TABLE `finivacacionalplanillas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `finivacacionals`
--
ALTER TABLE `finivacacionals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `formapagos`
--
ALTER TABLE `formapagos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `forma_pedidos`
--
ALTER TABLE `forma_pedidos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `gastos_extras_aves`
--
ALTER TABLE `gastos_extras_aves`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `informe_detalles`
--
ALTER TABLE `informe_detalles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `informe_preliminars`
--
ALTER TABLE `informe_preliminars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inventarios`
--
ALTER TABLE `inventarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `items_pts`
--
ALTER TABLE `items_pts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `item_files`
--
ALTER TABLE `item_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `item_pollos`
--
ALTER TABLE `item_pollos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=284;

--
-- AUTO_INCREMENT de la tabla `item_precios`
--
ALTER TABLE `item_precios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `item_pt_movimientos`
--
ALTER TABLE `item_pt_movimientos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `item_pt_transformacion_lotes`
--
ALTER TABLE `item_pt_transformacion_lotes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `item_sobra_pts`
--
ALTER TABLE `item_sobra_pts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `kardex_dotacions`
--
ALTER TABLE `kardex_dotacions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `liquidacions`
--
ALTER TABLE `liquidacions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `logs`
--
ALTER TABLE `logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `lotes`
--
ALTER TABLE `lotes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lotes_aves`
--
ALTER TABLE `lotes_aves`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lote_aves_detalles`
--
ALTER TABLE `lote_aves_detalles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lote_detalles`
--
ALTER TABLE `lote_detalles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lote_detalle_clientes`
--
ALTER TABLE `lote_detalle_clientes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lote_detalle_compras`
--
ALTER TABLE `lote_detalle_compras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lote_detalle_compras_aves`
--
ALTER TABLE `lote_detalle_compras_aves`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lote_detalle_historials`
--
ALTER TABLE `lote_detalle_historials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lote_detalle_movimientos`
--
ALTER TABLE `lote_detalle_movimientos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lote_detalle_productos`
--
ALTER TABLE `lote_detalle_productos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lote_detalle_seguimientos`
--
ALTER TABLE `lote_detalle_seguimientos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lote_detalle_ventas`
--
ALTER TABLE `lote_detalle_ventas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lote_envio_pppts`
--
ALTER TABLE `lote_envio_pppts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lote_envio_pps`
--
ALTER TABLE `lote_envio_pps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lote_envio_pts`
--
ALTER TABLE `lote_envio_pts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lote_trozado_pps`
--
ALTER TABLE `lote_trozado_pps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lote_trozado_pts`
--
ALTER TABLE `lote_trozado_pts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `medidas`
--
ALTER TABLE `medidas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `medida_productos`
--
ALTER TABLE `medida_productos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `memorandums`
--
ALTER TABLE `memorandums`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1922;

--
-- AUTO_INCREMENT de la tabla `monedas`
--
ALTER TABLE `monedas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `motivomemorandums`
--
ALTER TABLE `motivomemorandums`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `pagos_globales`
--
ALTER TABLE `pagos_globales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pago_compra_cajas`
--
ALTER TABLE `pago_compra_cajas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `parametrovacacions`
--
ALTER TABLE `parametrovacacions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `pedido_clientes`
--
ALTER TABLE `pedido_clientes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedido_cliente_detalles`
--
ALTER TABLE `pedido_cliente_detalles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `planillacostos`
--
ALTER TABLE `planillacostos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `planillas`
--
ALTER TABLE `planillas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `planillaserviciocostos`
--
ALTER TABLE `planillaserviciocostos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `planillaservicios`
--
ALTER TABLE `planillaservicios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pollolimpios`
--
ALTER TABLE `pollolimpios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pollolimpio_cambios`
--
ALTER TABLE `pollolimpio_cambios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pollolimpio_sucursals`
--
ALTER TABLE `pollolimpio_sucursals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pollo_sucursals`
--
ALTER TABLE `pollo_sucursals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `pps`
--
ALTER TABLE `pps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pp_detalles`
--
ALTER TABLE `pp_detalles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pp_detalle_descomposicions`
--
ALTER TABLE `pp_detalle_descomposicions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pp_envio_transformacions`
--
ALTER TABLE `pp_envio_transformacions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pp_envio_transformacion_detalles`
--
ALTER TABLE `pp_envio_transformacion_detalles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pp_pts`
--
ALTER TABLE `pp_pts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pp_traspaso_pps`
--
ALTER TABLE `pp_traspaso_pps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `producto_precios`
--
ALTER TABLE `producto_precios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `producto_precio_cambios`
--
ALTER TABLE `producto_precio_cambios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto_precio_lotes`
--
ALTER TABLE `producto_precio_lotes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto_precio_sucursals`
--
ALTER TABLE `producto_precio_sucursals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `promedio_mermas`
--
ALTER TABLE `promedio_mermas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `promedio_pollolimpios`
--
ALTER TABLE `promedio_pollolimpios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proveedors`
--
ALTER TABLE `proveedors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proveedor_categorias`
--
ALTER TABLE `proveedor_categorias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `proveedor_categoria_detalles`
--
ALTER TABLE `proveedor_categoria_detalles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `proveedor_compras`
--
ALTER TABLE `proveedor_compras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `proveedor_compra_medidas`
--
ALTER TABLE `proveedor_compra_medidas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pts`
--
ALTER TABLE `pts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pt_detalles`
--
ALTER TABLE `pt_detalles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pt_detalle_descomposicions`
--
ALTER TABLE `pt_detalle_descomposicions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pt_detalle_sub_descomposicions`
--
ALTER TABLE `pt_detalle_sub_descomposicions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pt_sobra_pps`
--
ALTER TABLE `pt_sobra_pps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pt_traspaso_pps`
--
ALTER TABLE `pt_traspaso_pps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `redotaciondetalles`
--
ALTER TABLE `redotaciondetalles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `redotacions`
--
ALTER TABLE `redotacions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `salidadotacioncontratos`
--
ALTER TABLE `salidadotacioncontratos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `salidadotaclidetalles`
--
ALTER TABLE `salidadotaclidetalles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `salidadotaclientes`
--
ALTER TABLE `salidadotaclientes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `salidotacontradetas`
--
ALTER TABLE `salidotacontradetas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sobra_detalle_pps`
--
ALTER TABLE `sobra_detalle_pps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sobra_pps`
--
ALTER TABLE `sobra_pps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `stockdotaciondetails`
--
ALTER TABLE `stockdotaciondetails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `stockdotacions`
--
ALTER TABLE `stockdotacions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `subdetalle_descuento_acuerdo`
--
ALTER TABLE `subdetalle_descuento_acuerdo`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sub_des_detalle_pts`
--
ALTER TABLE `sub_des_detalle_pts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sub_des_pt_detalle_descos`
--
ALTER TABLE `sub_des_pt_detalle_descos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sub_items`
--
ALTER TABLE `sub_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sub_item_pt_transformacion_lotes`
--
ALTER TABLE `sub_item_pt_transformacion_lotes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sub_medidas`
--
ALTER TABLE `sub_medidas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `sucursals`
--
ALTER TABLE `sucursals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `sucursal_tirajes`
--
ALTER TABLE `sucursal_tirajes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipoarchivos`
--
ALTER TABLE `tipoarchivos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipoclientes`
--
ALTER TABLE `tipoclientes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipocontratos`
--
ALTER TABLE `tipocontratos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipopagos`
--
ALTER TABLE `tipopagos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_cliente_pps`
--
ALTER TABLE `tipo_cliente_pps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipo_cliente_pp_limpios`
--
ALTER TABLE `tipo_cliente_pp_limpios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipo_negocios`
--
ALTER TABLE `tipo_negocios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `transformacions`
--
ALTER TABLE `transformacions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `transformacion_detalles`
--
ALTER TABLE `transformacion_detalles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `transformacion_detalle_sucursals`
--
ALTER TABLE `transformacion_detalle_sucursals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `transformacion_items`
--
ALTER TABLE `transformacion_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `transformacion_lotes`
--
ALTER TABLE `transformacion_lotes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `transformacion_lote_detalles`
--
ALTER TABLE `transformacion_lote_detalles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `transformacion_lote_items`
--
ALTER TABLE `transformacion_lote_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `transformacion_sucursals`
--
ALTER TABLE `transformacion_sucursals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `trans_especials`
--
ALTER TABLE `trans_especials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `trans_especial_items`
--
ALTER TABLE `trans_especial_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `trans_items`
--
ALTER TABLE `trans_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `trans_item_detalles`
--
ALTER TABLE `trans_item_detalles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `traspaso_cajas`
--
ALTER TABLE `traspaso_cajas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `traspaso_dotacions`
--
ALTER TABLE `traspaso_dotacions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `traspaso_dotacion_detalles`
--
ALTER TABLE `traspaso_dotacion_detalles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `traspaso_pps`
--
ALTER TABLE `traspaso_pps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `traspaso_pp_detalles`
--
ALTER TABLE `traspaso_pp_detalles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `traspaso_pp_envios`
--
ALTER TABLE `traspaso_pp_envios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `turno_chofers`
--
ALTER TABLE `turno_chofers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `validar_cajas`
--
ALTER TABLE `validar_cajas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `validar_caja_detalles`
--
ALTER TABLE `validar_caja_detalles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `venta_acuerdos`
--
ALTER TABLE `venta_acuerdos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `venta_cajas`
--
ALTER TABLE `venta_cajas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `venta_cerradas`
--
ALTER TABLE `venta_cerradas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `venta_detalle_pps`
--
ALTER TABLE `venta_detalle_pps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `venta_gastos`
--
ALTER TABLE `venta_gastos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `venta_items_pts`
--
ALTER TABLE `venta_items_pts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `venta_pps`
--
ALTER TABLE `venta_pps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `venta_pts`
--
ALTER TABLE `venta_pts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `venta_transformacions`
--
ALTER TABLE `venta_transformacions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `venta_turno_chofers`
--
ALTER TABLE `venta_turno_chofers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `zona_despachos`
--
ALTER TABLE `zona_despachos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `arqueo_venta_pago_global`
--
ALTER TABLE `arqueo_venta_pago_global`
  ADD CONSTRAINT `arqueo_venta_pago_global_arqueo_venta_id_foreign` FOREIGN KEY (`arqueo_venta_id`) REFERENCES `arqueo_ventas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `arqueo_venta_pago_global_pago_global_id_foreign` FOREIGN KEY (`pago_global_id`) REFERENCES `pagos_globales` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `compras_aves`
--
ALTER TABLE `compras_aves`
  ADD CONSTRAINT `compras_aves_almacen_id_foreign` FOREIGN KEY (`almacen_id`) REFERENCES `almacens` (`id`),
  ADD CONSTRAINT `compras_aves_proveedor_compra_id_foreign` FOREIGN KEY (`proveedor_compra_id`) REFERENCES `proveedor_compras` (`id`),
  ADD CONSTRAINT `compras_aves_sucursal_id_foreign` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursals` (`id`),
  ADD CONSTRAINT `compras_aves_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `filemonedas`
--
ALTER TABLE `filemonedas`
  ADD CONSTRAINT `filemonedas_moneda_id_foreign` FOREIGN KEY (`moneda_id`) REFERENCES `monedas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `gastos_extras_aves`
--
ALTER TABLE `gastos_extras_aves`
  ADD CONSTRAINT `gastos_extras_aves_consolidacion_id_foreign` FOREIGN KEY (`consolidacion_id`) REFERENCES `consolidacions_ave` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
