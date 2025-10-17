-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2025 at 08:16 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `samfarm_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE `categorias` (
  `ca_id` bigint(20) UNSIGNED NOT NULL,
  `ca_nombre` varchar(100) NOT NULL,
  `ca_descripcion` text DEFAULT NULL,
  `ca_imagen` varchar(255) DEFAULT NULL,
  `ca_creado_en` datetime NOT NULL DEFAULT current_timestamp(),
  `ca_actualizado_en` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ca_estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`ca_id`, `ca_nombre`, `ca_descripcion`, `ca_imagen`, `ca_creado_en`, `ca_actualizado_en`, `ca_estado`) VALUES
(1, 'Analgesicos', 'Medicamentos para el dolor', NULL, '2025-10-12 23:00:54', '2025-10-12 23:00:54', 1),
(2, 'Vitaminas', 'Suplementos vitamínicos', NULL, '2025-10-12 23:00:54', '2025-10-12 23:00:54', 1);

-- --------------------------------------------------------

--
-- Table structure for table `clientes`
--

CREATE TABLE `clientes` (
  `cl_id` bigint(20) UNSIGNED NOT NULL,
  `cl_nombre` varchar(200) NOT NULL,
  `cl_tipo_documento` varchar(30) DEFAULT NULL,
  `cl_documento` varchar(60) DEFAULT NULL,
  `cl_telefono` varchar(30) DEFAULT NULL,
  `cl_correo` varchar(120) DEFAULT NULL,
  `cl_direccion` text DEFAULT NULL,
  `cl_creado_en` datetime NOT NULL DEFAULT current_timestamp(),
  `cl_estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clientes`
--

INSERT INTO `clientes` (`cl_id`, `cl_nombre`, `cl_tipo_documento`, `cl_documento`, `cl_telefono`, `cl_correo`, `cl_direccion`, `cl_creado_en`, `cl_estado`) VALUES
(1, 'Juan Pérez', 'CI', '1234567', '+591-7-7000000', 'juan.perez@mail.test', NULL, '2025-10-12 23:00:54', 1),
(2, 'Empresa Salud SRL', 'RUC', '800100200', '+591-7-7000001', 'compras@salud.test', NULL, '2025-10-12 23:00:54', 1);

-- --------------------------------------------------------

--
-- Table structure for table `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `dv_id` bigint(20) UNSIGNED NOT NULL,
  `fa_id` bigint(20) UNSIGNED NOT NULL,
  `pr_id` bigint(20) UNSIGNED NOT NULL,
  `dv_cantidad` int(11) NOT NULL,
  `dv_precio_unitario` decimal(12,2) NOT NULL,
  `dv_descuento` decimal(12,2) NOT NULL DEFAULT 0.00,
  `dv_subtotal` decimal(14,2) NOT NULL,
  `dv_estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detalle_venta`
--

INSERT INTO `detalle_venta` (`dv_id`, `fa_id`, `pr_id`, `dv_cantidad`, `dv_precio_unitario`, `dv_descuento`, `dv_subtotal`, `dv_estado`) VALUES
(1, 1, 1, 2, '5.50', '0.00', '11.00', 1),
(2, 1, 2, 1, '6.50', '0.00', '6.50', 1);

-- --------------------------------------------------------

--
-- Table structure for table `facturas`
--

CREATE TABLE `facturas` (
  `fa_id` bigint(20) UNSIGNED NOT NULL,
  `fa_numero_factura` varchar(80) NOT NULL,
  `fa_fecha_emision` datetime NOT NULL DEFAULT current_timestamp(),
  `cl_id` bigint(20) UNSIGNED DEFAULT NULL,
  `us_id` bigint(20) UNSIGNED NOT NULL,
  `su_id` bigint(20) UNSIGNED NOT NULL,
  `fa_subtotal` decimal(14,2) NOT NULL DEFAULT 0.00,
  `fa_impuesto` decimal(14,2) NOT NULL DEFAULT 0.00,
  `fa_total` decimal(14,2) NOT NULL DEFAULT 0.00,
  `fa_creado_en` datetime NOT NULL DEFAULT current_timestamp(),
  `fa_actualizado_en` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fa_estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facturas`
--

INSERT INTO `facturas` (`fa_id`, `fa_numero_factura`, `fa_fecha_emision`, `cl_id`, `us_id`, `su_id`, `fa_subtotal`, `fa_impuesto`, `fa_total`, `fa_creado_en`, `fa_actualizado_en`, `fa_estado`) VALUES
(1, 'F-CENT-0001', '2025-10-12 23:00:54', 1, 2, 1, '17.50', '1.75', '19.25', '2025-10-12 23:00:54', '2025-10-12 23:00:54', 1);

-- --------------------------------------------------------

--
-- Table structure for table `horarios`
--

CREATE TABLE `horarios` (
  `ho_id` bigint(20) UNSIGNED NOT NULL,
  `us_id` bigint(20) UNSIGNED NOT NULL,
  `su_id` bigint(20) UNSIGNED NOT NULL,
  `ho_fecha` date NOT NULL,
  `ho_hora_inicio` time NOT NULL,
  `ho_hora_cierre` time DEFAULT NULL,
  `ho_estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `horarios`
--

INSERT INTO `horarios` (`ho_id`, `us_id`, `su_id`, `ho_fecha`, `ho_hora_inicio`, `ho_hora_cierre`, `ho_estado`) VALUES
(1, 2, 1, '2025-10-12', '08:00:00', '17:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `laboratorios`
--

CREATE TABLE `laboratorios` (
  `la_id` bigint(20) UNSIGNED NOT NULL,
  `la_nombre_contacto` varchar(120) DEFAULT NULL,
  `la_telefono` varchar(30) DEFAULT NULL,
  `la_nombre_comercial` varchar(150) NOT NULL,
  `la_logo` varchar(255) DEFAULT NULL,
  `la_creado_en` datetime NOT NULL DEFAULT current_timestamp(),
  `la_actualizado_en` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `la_estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laboratorios`
--

INSERT INTO `laboratorios` (`la_id`, `la_nombre_contacto`, `la_telefono`, `la_nombre_comercial`, `la_logo`, `la_creado_en`, `la_actualizado_en`, `la_estado`) VALUES
(1, 'Contacto Lab A', '+591-4-1111111', 'Laboratorios A', NULL, '2025-10-12 23:00:54', '2025-10-12 23:00:54', 1),
(2, 'Contacto Lab B', '+591-4-2222222', 'Laboratorios B', NULL, '2025-10-12 23:00:54', '2025-10-12 23:00:54', 1);

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `pr_id` bigint(20) UNSIGNED NOT NULL,
  `pr_codigo_sku` varchar(60) NOT NULL,
  `pr_nombre` varchar(200) NOT NULL,
  `pr_precio_unitario` decimal(12,2) NOT NULL DEFAULT 0.00,
  `pr_precio_caja` decimal(12,2) DEFAULT NULL,
  `la_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ca_id` bigint(20) UNSIGNED DEFAULT NULL,
  `pr_creado_en` datetime NOT NULL DEFAULT current_timestamp(),
  `pr_actualizado_en` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `pr_estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`pr_id`, `pr_codigo_sku`, `pr_nombre`, `pr_precio_unitario`, `pr_precio_caja`, `la_id`, `ca_id`, `pr_creado_en`, `pr_actualizado_en`, `pr_estado`) VALUES
(1, 'SKU-001', 'Paracetamol 500mg - 20 comprimidos', '5.50', '50.00', 1, 1, '2025-10-12 23:00:54', '2025-10-12 23:00:54', 1),
(2, 'SKU-002', 'Multivitamínico 30 caps', '12.00', '120.00', 2, 2, '2025-10-12 23:00:54', '2025-10-12 23:00:54', 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `ro_id` bigint(20) UNSIGNED NOT NULL,
  `ro_nombre` varchar(50) NOT NULL,
  `ro_descripcion` text DEFAULT NULL,
  `ro_creado_en` datetime NOT NULL DEFAULT current_timestamp(),
  `ro_actualizado_en` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ro_estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`ro_id`, `ro_nombre`, `ro_descripcion`, `ro_creado_en`, `ro_actualizado_en`, `ro_estado`) VALUES
(1, 'admin', 'Administrador del sistema con todos los permisos', '2025-10-12 23:00:54', '2025-10-12 23:00:54', 1),
(2, 'gerente', 'Gerente de sucursal', '2025-10-12 23:00:54', '2025-10-12 23:00:54', 1),
(3, 'vendedor', 'Usuario de caja / ventas', '2025-10-12 23:00:54', '2025-10-12 23:00:54', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sucursales`
--

CREATE TABLE `sucursales` (
  `su_id` bigint(20) UNSIGNED NOT NULL,
  `su_nombre` varchar(120) NOT NULL,
  `su_direccion` text DEFAULT NULL,
  `su_telefono` varchar(30) DEFAULT NULL,
  `su_creado_en` datetime NOT NULL DEFAULT current_timestamp(),
  `su_actualizado_en` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `su_estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sucursales`
--

INSERT INTO `sucursales` (`su_id`, `su_nombre`, `su_direccion`, `su_telefono`, `su_creado_en`, `su_actualizado_en`, `su_estado`) VALUES
(1, 'Sucursal Central', 'Av. Principal 123, Ciudad', '+591-2-1234567', '2025-10-12 23:00:54', '2025-10-12 23:00:54', 1),
(2, 'Sucursal Norte', 'Calle 10 #45', '+591-2-7654321', '2025-10-12 23:00:54', '2025-10-12 23:00:54', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `us_id` bigint(20) UNSIGNED NOT NULL,
  `us_nombres` varchar(120) NOT NULL,
  `us_apellido_paterno` varchar(80) DEFAULT NULL,
  `us_apellido_materno` varchar(80) DEFAULT NULL,
  `us_numero_carnet` varchar(60) DEFAULT NULL,
  `us_telefono` varchar(30) DEFAULT NULL,
  `us_correo` varchar(120) DEFAULT NULL,
  `us_direccion` text DEFAULT NULL,
  `us_username` varchar(80) NOT NULL,
  `us_password_hash` varchar(255) NOT NULL,
  `us_token_recuperacion` varchar(255) DEFAULT NULL,
  `us_token_expiracion` datetime DEFAULT NULL,
  `us_creado_en` datetime NOT NULL DEFAULT current_timestamp(),
  `us_actualizado_en` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `us_estado` tinyint(1) NOT NULL DEFAULT 1,
  `su_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ro_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`us_id`, `us_nombres`, `us_apellido_paterno`, `us_apellido_materno`, `us_numero_carnet`, `us_telefono`, `us_correo`, `us_direccion`, `us_username`, `us_password_hash`, `us_token_recuperacion`, `us_token_expiracion`, `us_creado_en`, `us_actualizado_en`, `us_estado`, `su_id`, `ro_id`) VALUES
(1, 'Carlos', 'Gonzales', 'Lopez', 'B1234567', '+591-7-7111111', 'carlos.g@farmacia.test', 'Calle Falsa 123', 'carlosg', '$2y$12$EXAMPLEHASHPASSWORD', NULL, NULL, '2025-10-12 23:00:54', '2025-10-12 23:00:54', 1, 1, 1),
(2, 'Ana', 'Martínez', 'Quispe', 'B7654321', '+591-7-7222222', 'ana.m@farmacia.test', 'Avenida Siempre Viva 5', 'anam', '$2y$12$EXAMPLEHASHPASSWORD2', NULL, NULL, '2025-10-12 23:00:54', '2025-10-12 23:00:54', 1, 1, 3),
(3, 'fghfg', 'gfhfgh', 'mnbnm', '123123', '1234123', 'mnbq@jklqw.q', 'qwe', 'qwe', 'VVRCRW5qNC8wUThFUjQ5ZEdINmJ4QT09', NULL, NULL, '2025-10-14 00:51:30', '2025-10-14 00:51:30', 1, 1, 3),
(4, 'QWE', 'QWE', 'QWE', '123123123', '123123', '123@EQW.QWE', 'qwe asd as sad', 'asdasd', 'aHFnUmZKV3hlaThKck5jMitaNzlOdz09', NULL, NULL, '2025-10-14 00:55:22', '2025-10-14 00:55:22', 1, 1, 3),
(5, 'admin', 'admin', 'admin', '000000000', '000000000', 'admin@admin.com', 'admin', 'admin', 'dlo5ZmZvbmRjME41dGlDY01tTGcrUT09', NULL, NULL, '2025-10-14 03:10:57', '2025-10-14 03:10:57', 1, 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`ca_id`),
  ADD UNIQUE KEY `ux_categorias_nombre` (`ca_nombre`);

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`cl_id`),
  ADD KEY `ix_clientes_documento` (`cl_documento`);

--
-- Indexes for table `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`dv_id`),
  ADD KEY `ix_dv_fa` (`fa_id`),
  ADD KEY `ix_dv_pr` (`pr_id`),
  ADD KEY `ix_dv_fa_pr` (`fa_id`,`pr_id`);

--
-- Indexes for table `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`fa_id`),
  ADD UNIQUE KEY `ux_facturas_numero` (`fa_numero_factura`),
  ADD KEY `ix_facturas_fecha` (`fa_fecha_emision`),
  ADD KEY `fk_facturas_clientes` (`cl_id`),
  ADD KEY `fk_facturas_usuarios` (`us_id`),
  ADD KEY `fk_facturas_sucursales` (`su_id`);

--
-- Indexes for table `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`ho_id`),
  ADD KEY `fk_ho_sucursales` (`su_id`),
  ADD KEY `ix_ho_usuario_fecha` (`us_id`,`ho_fecha`);

--
-- Indexes for table `laboratorios`
--
ALTER TABLE `laboratorios`
  ADD PRIMARY KEY (`la_id`),
  ADD UNIQUE KEY `ux_laboratorios_nombre` (`la_nombre_comercial`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`pr_id`),
  ADD UNIQUE KEY `ux_productos_codigo` (`pr_codigo_sku`),
  ADD KEY `ix_productos_nombre` (`pr_nombre`),
  ADD KEY `fk_productos_laboratorios` (`la_id`),
  ADD KEY `fk_productos_categorias` (`ca_id`),
  ADD KEY `ix_pr_codigo_nombre` (`pr_codigo_sku`,`pr_nombre`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`ro_id`),
  ADD UNIQUE KEY `ro_nombre` (`ro_nombre`);

--
-- Indexes for table `sucursales`
--
ALTER TABLE `sucursales`
  ADD PRIMARY KEY (`su_id`),
  ADD UNIQUE KEY `ux_sucursales_nombre` (`su_nombre`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`us_id`),
  ADD UNIQUE KEY `ux_usuarios_username` (`us_username`),
  ADD UNIQUE KEY `ux_usuarios_correo` (`us_correo`),
  ADD KEY `fk_usuarios_sucursales` (`su_id`),
  ADD KEY `fk_usuarios_roles` (`ro_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `ca_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `cl_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `dv_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `facturas`
--
ALTER TABLE `facturas`
  MODIFY `fa_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `horarios`
--
ALTER TABLE `horarios`
  MODIFY `ho_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `laboratorios`
--
ALTER TABLE `laboratorios`
  MODIFY `la_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `pr_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `ro_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sucursales`
--
ALTER TABLE `sucursales`
  MODIFY `su_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `us_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `fk_dv_facturas` FOREIGN KEY (`fa_id`) REFERENCES `facturas` (`fa_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_dv_productos` FOREIGN KEY (`pr_id`) REFERENCES `productos` (`pr_id`) ON UPDATE CASCADE;

--
-- Constraints for table `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `fk_facturas_clientes` FOREIGN KEY (`cl_id`) REFERENCES `clientes` (`cl_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_facturas_sucursales` FOREIGN KEY (`su_id`) REFERENCES `sucursales` (`su_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_facturas_usuarios` FOREIGN KEY (`us_id`) REFERENCES `usuarios` (`us_id`) ON UPDATE CASCADE;

--
-- Constraints for table `horarios`
--
ALTER TABLE `horarios`
  ADD CONSTRAINT `fk_ho_sucursales` FOREIGN KEY (`su_id`) REFERENCES `sucursales` (`su_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ho_usuarios` FOREIGN KEY (`us_id`) REFERENCES `usuarios` (`us_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_productos_categorias` FOREIGN KEY (`ca_id`) REFERENCES `categorias` (`ca_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_productos_laboratorios` FOREIGN KEY (`la_id`) REFERENCES `laboratorios` (`la_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_roles` FOREIGN KEY (`ro_id`) REFERENCES `roles` (`ro_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_usuarios_sucursales` FOREIGN KEY (`su_id`) REFERENCES `sucursales` (`su_id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
