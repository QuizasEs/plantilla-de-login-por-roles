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
-- Database: `farmacia_db`
--

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
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`us_id`),
  ADD UNIQUE KEY `ux_usuarios_username` (`us_username`),
  ADD UNIQUE KEY `ux_usuarios_correo` (`us_correo`),
  ADD KEY `fk_usuarios_sucursales` (`su_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `us_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_sucursales` FOREIGN KEY (`su_id`) REFERENCES `sucursales` (`su_id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


 
-- Tabla de productos  
CREATE TABLE productos (  
    pro_id INT AUTO_INCREMENT PRIMARY KEY,  
    pro_titulo VARCHAR(255) NOT NULL,  
    pro_imagen_principal VARCHAR(255),  
    pro_imagen_secundaria1 VARCHAR(255),  
    pro_imagen_secundaria2 VARCHAR(255),  
    pro_imagen_secundaria3 VARCHAR(255),  
    pro_descripcion TEXT,  
    pro_puntaje DECIMAL(3, 2),  
    pro_precio DECIMAL(10, 2),  
    pro_link_video VARCHAR(255),  
    pro_fecha_actualizacion DATETIME,  
    pro_fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP  
);  
  
-- Tabla de servicios  
CREATE TABLE servicios (  
    ser_id INT AUTO_INCREMENT PRIMARY KEY,  
    ser_titulo VARCHAR(255) NOT NULL,  
    ser_descripcion TEXT,  
    ser_imagen_principal VARCHAR(255),  
    ser_imagen_secundaria1 VARCHAR(255),  
    ser_imagen_secundaria2 VARCHAR(255),  
    ser_imagen_secundaria3 VARCHAR(255),  
    ser_precio DECIMAL(10, 2),  
    ser_fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP,  
    ser_fecha_actualizacion DATETIME  
);  
  
-- Tabla de noticias  
CREATE TABLE noticias (  
    not_id INT AUTO_INCREMENT PRIMARY KEY,  
    not_titular VARCHAR(255) NOT NULL,  
    not_descripcion TEXT,  
    not_imagen_principal VARCHAR(255),  
    not_fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP,  
    not_fecha_actualizacion DATETIME  
);  
  
-- Tabla de mensajes  
CREATE TABLE mensajes (  
    mes_id INT AUTO_INCREMENT PRIMARY KEY,  
    mes_nombres VARCHAR(100) NOT NULL,  
    mes_apellidos VARCHAR(100) NOT NULL,  
    mes_correo VARCHAR(100) NOT NULL,  
    mes_telefono VARCHAR(20),  
    mes_asunto VARCHAR(255),  
    mes_mensaje TEXT,  
    mes_fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP  
);  
  
-- Tabla de página  
CREATE TABLE pagina (  
    pag_id INT AUTO_INCREMENT PRIMARY KEY,  
    pag_logo VARCHAR(255),  
    pag_titulo VARCHAR(255) NOT NULL,  
    pag_link_whatsapp VARCHAR(255),  
    pag_logo_whatsapp VARCHAR(255),  
    pag_link1 VARCHAR(255),  
    pag_logo_link1 VARCHAR(255),  
    pag_link2 VARCHAR(255),  
    pag_logo_link2 VARCHAR(255),  
    pag_direccion VARCHAR(255),  
    pag_correo VARCHAR(100),  
    pag_telefono VARCHAR(20),  
    pag_tema VARCHAR(50),  
    pag_fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP,  
    pag_fecha_actualizacion DATETIME  
);  