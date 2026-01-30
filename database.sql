-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-01-2026 a las 15:09:53
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `database`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `mes_id` int(11) NOT NULL,
  `mes_nombres` varchar(100) NOT NULL,
  `mes_apellidos` varchar(100) NOT NULL,
  `mes_correo` varchar(100) NOT NULL,
  `mes_telefono` varchar(20) DEFAULT NULL,
  `mes_asunto` varchar(255) DEFAULT NULL,
  `mes_mensaje` text DEFAULT NULL,
  `mes_fecha_creacion` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `not_id` int(11) NOT NULL,
  `not_titular` varchar(255) NOT NULL,
  `not_descripcion` text DEFAULT NULL,
  `not_imagen_principal` varchar(255) DEFAULT NULL,
  `not_fecha_creacion` datetime DEFAULT current_timestamp(),
  `not_fecha_actualizacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagina`
--

CREATE TABLE `pagina` (
  `pag_id` int(11) NOT NULL,
  `pag_logo` varchar(255) DEFAULT NULL,
  `pag_titulo` varchar(255) NOT NULL,
  `pag_link_whatsapp` varchar(255) DEFAULT NULL,
  `pag_logo_whatsapp` varchar(255) DEFAULT NULL,
  `pag_link1` varchar(255) DEFAULT NULL,
  `pag_logo_link1` varchar(255) DEFAULT NULL,
  `pag_link2` varchar(255) DEFAULT NULL,
  `pag_logo_link2` varchar(255) DEFAULT NULL,
  `pag_direccion` varchar(255) DEFAULT NULL,
  `pag_correo` varchar(100) DEFAULT NULL,
  `pag_telefono` varchar(20) DEFAULT NULL,
  `pag_tema` varchar(50) DEFAULT NULL,
  `pag_fecha_creacion` datetime DEFAULT current_timestamp(),
  `pag_fecha_actualizacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `pro_id` int(11) NOT NULL,
  `pro_titulo` varchar(255) NOT NULL,
  `pro_imagen_principal` varchar(255) DEFAULT NULL,
  `pro_imagen_secundaria1` varchar(255) DEFAULT NULL,
  `pro_imagen_secundaria2` varchar(255) DEFAULT NULL,
  `pro_imagen_secundaria3` varchar(255) DEFAULT NULL,
  `pro_descripcion` text DEFAULT NULL,
  `pro_puntaje` decimal(3,2) DEFAULT NULL,
  `pro_precio` decimal(10,2) DEFAULT NULL,
  `pro_link_video` varchar(255) DEFAULT NULL,
  `pro_fecha_actualizacion` datetime DEFAULT NULL,
  `pro_fecha_creacion` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `ser_id` int(11) NOT NULL,
  `ser_titulo` varchar(255) NOT NULL,
  `ser_descripcion` text DEFAULT NULL,
  `ser_imagen_principal` varchar(255) DEFAULT NULL,
  `ser_imagen_secundaria1` varchar(255) DEFAULT NULL,
  `ser_imagen_secundaria2` varchar(255) DEFAULT NULL,
  `ser_imagen_secundaria3` varchar(255) DEFAULT NULL,
  `ser_precio` decimal(10,2) DEFAULT NULL,
  `ser_fecha_creacion` datetime DEFAULT current_timestamp(),
  `ser_fecha_actualizacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
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

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`us_id`, `us_nombres`, `us_apellidos`, `us_correo`, `us_username`, `us_password_hash`, `us_token_recuperacion`, `us_token_expiracion`, `us_creado_en`, `us_actualizado_en`) VALUES
(1, 'admin', 'admin admin', 'zetaconde@gmail.com', 'admin', 'dlo5ZmZvbmRjME41dGlDY01tTGcrUT09', NULL, NULL, '2026-01-28 10:46:19', '2026-01-28 11:08:10');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`mes_id`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`not_id`);

--
-- Indices de la tabla `pagina`
--
ALTER TABLE `pagina`
  ADD PRIMARY KEY (`pag_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`pro_id`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`ser_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`us_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `mes_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `not_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pagina`
--
ALTER TABLE `pagina`
  MODIFY `pag_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `pro_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `ser_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `us_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
