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
  `us_apellidos` varchar(200) DEFAULT NULL,
  `us_correo` varchar(120) DEFAULT NULL,
  `us_username` varchar(80) NOT NULL,
  `us_password_hash` varchar(255) NOT NULL,
  `us_token_recuperacion` varchar(255) DEFAULT NULL,
  `us_token_expiracion` datetime DEFAULT NULL,
  `us_creado_en` datetime NOT NULL DEFAULT current_timestamp(),
  `us_actualizado_en` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`us_id`);


--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `us_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

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