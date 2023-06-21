-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 20-04-2023 a las 10:12:37
-- Versión del servidor: 10.3.38-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mysql_tfg`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CALENDARIO`
--

CREATE TABLE `CALENDARIO` (
  `id` int(11) NOT NULL,
  `liga_id` int(11) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `equipo_local_id` int(11) NOT NULL,
  `equipo_visitante_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `DEPORTE`
--

CREATE TABLE `DEPORTE` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `logo` text NOT NULL,
  `cover` text NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 1,
  `creado_por` int(11) NOT NULL,
  `modificado_por` int(11) NOT NULL,
  `borrado_por` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `EQUIPO`
--

CREATE TABLE `EQUIPO` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `cover` text NOT NULL,
  `escudo` text NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `fecha_creacion` date NOT NULL DEFAULT current_timestamp(),
  `fecha_mod` date NOT NULL,
  `fecha_baja` date NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 1,
  `liga_id` int(11) NOT NULL,
  `deporte_id` int(11) NOT NULL,
  `creado_por` int(11) NOT NULL,
  `modificado_por` int(11) NOT NULL,
  `borrado_por` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `EQUIPO_ADMIN`
--

CREATE TABLE `EQUIPO_ADMIN` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `equipo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `JUGADOR`
--

CREATE TABLE `JUGADOR` (
  `id` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `equipo_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `LIGA`
--

CREATE TABLE `LIGA` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 1,
  `cover` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `deporte_id` int(11) NOT NULL,
  `liga_id` int(11) NOT NULL,
  `creado_por` int(11) NOT NULL,
  `modificado_por` int(11) NOT NULL,
  `borrado_por` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `LIGA_ADMIN`
--

CREATE TABLE `LIGA_ADMIN` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `liga_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PARTIDOS`
--

CREATE TABLE `PARTIDOS` (
  `id` int(11) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `equipo_local_id` int(11) DEFAULT NULL,
  `equipo_visitante_id` int(11) DEFAULT NULL,
  `liga_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `RESULTADOS`
--

CREATE TABLE `RESULTADOS` (
  `id` int(11) NOT NULL,
  `partido_id` int(11) DEFAULT NULL,
  `equipo_ganador_id` int(11) DEFAULT NULL,
  `equipo_perdedor_id` int(11) DEFAULT NULL,
  `marcador_final` varchar(10) NOT NULL,
  `fecha_partido` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `USUARIO`
--

CREATE TABLE `USUARIO` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` text NOT NULL,
  `numero_sesiones` int(11) NOT NULL,
  `ultima_sesion` date NOT NULL DEFAULT current_timestamp(),
  `fecha_alta` date NOT NULL DEFAULT current_timestamp(),
  `fecha_mod` date NOT NULL,
  `fecha_baja` date NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 1,
  `creado_por` int(11) NOT NULL,
  `modificado_por` int(11) NOT NULL,
  `borrado_por` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `CALENDARIO`
--
ALTER TABLE `CALENDARIO`
  ADD PRIMARY KEY (`id`),
  ADD KEY `liga_id` (`liga_id`),
  ADD KEY `equipo_local_id` (`equipo_local_id`),
  ADD KEY `equipo_visitante_id` (`equipo_visitante_id`);

--
-- Indices de la tabla `DEPORTE`
--
ALTER TABLE `DEPORTE`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`),
  ADD KEY `creado_por` (`creado_por`),
  ADD KEY `modificado_por` (`modificado_por`),
  ADD KEY `borrado_por` (`borrado_por`);

--
-- Indices de la tabla `EQUIPO`
--
ALTER TABLE `EQUIPO`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`),
  ADD KEY `deporte_id` (`deporte_id`),
  ADD KEY `liga_id` (`liga_id`),
  ADD KEY `usr_alta` (`creado_por`),
  ADD KEY `usr_baja` (`borrado_por`),
  ADD KEY `usr_mod` (`modificado_por`);

--
-- Indices de la tabla `EQUIPO_ADMIN`
--
ALTER TABLE `EQUIPO_ADMIN`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `equipo_id` (`equipo_id`);

--
-- Indices de la tabla `JUGADOR`
--
ALTER TABLE `JUGADOR`
  ADD PRIMARY KEY (`id`),
  ADD KEY `equipo_id` (`equipo_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `LIGA`
--
ALTER TABLE `LIGA`
  ADD PRIMARY KEY (`id`),


--
-- Indices de la tabla `LIGA_ADMIN`
--
ALTER TABLE `LIGA_ADMIN`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `liga_id` (`liga_id`);

--
-- Indices de la tabla `PARTIDOS`
--
ALTER TABLE `PARTIDOS`
  ADD PRIMARY KEY (`id`),
  ADD KEY `equipo_local_id` (`equipo_local_id`),
  ADD KEY `equipo_visitante_id` (`equipo_visitante_id`),
  ADD KEY `liga_id` (`liga_id`);

--
-- Indices de la tabla `RESULTADOS`
--
ALTER TABLE `RESULTADOS`
  ADD PRIMARY KEY (`id`),
  ADD KEY `partido_id` (`partido_id`),
  ADD KEY `equipo_ganador_id` (`equipo_ganador_id`),
  ADD KEY `equipo_perdedor_id` (`equipo_perdedor_id`);

--
-- Indices de la tabla `USUARIO`
--
ALTER TABLE `USUARIO`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `usr_alta` (`creado_por`),
  ADD KEY `usr_mod` (`modificado_por`),
  ADD KEY `usr_baja` (`borrado_por`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `CALENDARIO`
--
ALTER TABLE `CALENDARIO`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `DEPORTE`
--
ALTER TABLE `DEPORTE`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `EQUIPO`
--
ALTER TABLE `EQUIPO`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `EQUIPO_ADMIN`
--
ALTER TABLE `EQUIPO_ADMIN`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `JUGADOR`
--
ALTER TABLE `JUGADOR`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `LIGA`
--
ALTER TABLE `LIGA`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `LIGA_ADMIN`
--
ALTER TABLE `LIGA_ADMIN`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `PARTIDOS`
--
ALTER TABLE `PARTIDOS`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `RESULTADOS`
--
ALTER TABLE `RESULTADOS`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `USUARIO`
--
ALTER TABLE `USUARIO`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `CALENDARIO`
--
ALTER TABLE `CALENDARIO`
  ADD CONSTRAINT `CALENDARIO_ibfk_1` FOREIGN KEY (`liga_id`) REFERENCES `LIGA` (`id`),
  ADD CONSTRAINT `CALENDARIO_ibfk_2` FOREIGN KEY (`equipo_local_id`) REFERENCES `EQUIPO` (`id`),
  ADD CONSTRAINT `CALENDARIO_ibfk_3` FOREIGN KEY (`equipo_visitante_id`) REFERENCES `EQUIPO` (`id`);

--
-- Filtros para la tabla `DEPORTE`
--
ALTER TABLE `DEPORTE`
  ADD CONSTRAINT `DEPORTE_ibfk_1` FOREIGN KEY (`creado_por`) REFERENCES `USUARIO` (`id`),
  ADD CONSTRAINT `DEPORTE_ibfk_2` FOREIGN KEY (`modificado_por`) REFERENCES `USUARIO` (`id`),
  ADD CONSTRAINT `DEPORTE_ibfk_3` FOREIGN KEY (`borrado_por`) REFERENCES `USUARIO` (`id`);

--
-- Filtros para la tabla `EQUIPO`
--
ALTER TABLE `EQUIPO`
  ADD CONSTRAINT `EQUIPO_ibfk_1` FOREIGN KEY (`deporte_id`) REFERENCES `DEPORTE` (`id`),
  ADD CONSTRAINT `EQUIPO_ibfk_2` FOREIGN KEY (`creado_por`) REFERENCES `USUARIO` (`id`),
  ADD CONSTRAINT `EQUIPO_ibfk_3` FOREIGN KEY (`modificado_por`) REFERENCES `USUARIO` (`id`),
  ADD CONSTRAINT `EQUIPO_ibfk_4` FOREIGN KEY (`borrado_por`) REFERENCES `USUARIO` (`id`),
  ADD CONSTRAINT `EQUIPO_ibfk_5` FOREIGN KEY (`liga_id`) REFERENCES `LIGA` (`id`),
  ADD CONSTRAINT `EQUIPO_ibfk_6` FOREIGN KEY (`creado_por`) REFERENCES `USUARIO` (`id`),
  ADD CONSTRAINT `EQUIPO_ibfk_7` FOREIGN KEY (`borrado_por`) REFERENCES `USUARIO` (`id`),
  ADD CONSTRAINT `EQUIPO_ibfk_8` FOREIGN KEY (`modificado_por`) REFERENCES `USUARIO` (`id`),
  ADD CONSTRAINT `liga_id` FOREIGN KEY (`id`) REFERENCES `LIGA` (`id`);

--
-- Filtros para la tabla `EQUIPO_ADMIN`
--
ALTER TABLE `EQUIPO_ADMIN`
  ADD CONSTRAINT `EQUIPO_ADMIN_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `USUARIO` (`id`),
  ADD CONSTRAINT `EQUIPO_ADMIN_ibfk_2` FOREIGN KEY (`equipo_id`) REFERENCES `EQUIPO` (`id`);

--
-- Filtros para la tabla `JUGADOR`
--
ALTER TABLE `JUGADOR`
  ADD CONSTRAINT `JUGADOR_ibfk_1` FOREIGN KEY (`equipo_id`) REFERENCES `EQUIPO` (`id`),
  ADD CONSTRAINT `JUGADOR_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `USUARIO` (`id`);

--
-- Filtros para la tabla `LIGA`
--
ALTER TABLE `LIGA`
  ADD CONSTRAINT `LIGA_ibfk_1` FOREIGN KEY (`deporte_id`) REFERENCES `DEPORTE` (`id`),
  ADD CONSTRAINT `LIGA_ibfk_2` FOREIGN KEY (`creado_por`) REFERENCES `USUARIO` (`id`),
  ADD CONSTRAINT `LIGA_ibfk_3` FOREIGN KEY (`modificado_por`) REFERENCES `USUARIO` (`id`);

--
-- Filtros para la tabla `LIGA_ADMIN`
--
ALTER TABLE `LIGA_ADMIN`
  ADD CONSTRAINT `LIGA_ADMIN_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `USUARIO` (`id`),
  ADD CONSTRAINT `LIGA_ADMIN_ibfk_2` FOREIGN KEY (`liga_id`) REFERENCES `LIGA` (`id`);

--
-- Filtros para la tabla `PARTIDOS`
--
ALTER TABLE `PARTIDOS`
  ADD CONSTRAINT `PARTIDOS_ibfk_1` FOREIGN KEY (`equipo_local_id`) REFERENCES `EQUIPO` (`id`),
  ADD CONSTRAINT `PARTIDOS_ibfk_2` FOREIGN KEY (`equipo_visitante_id`) REFERENCES `EQUIPO` (`id`),
  ADD CONSTRAINT `PARTIDOS_ibfk_3` FOREIGN KEY (`liga_id`) REFERENCES `LIGA` (`id`);

--
-- Filtros para la tabla `RESULTADOS`
--
ALTER TABLE `RESULTADOS`
  ADD CONSTRAINT `RESULTADOS_ibfk_1` FOREIGN KEY (`partido_id`) REFERENCES `PARTIDOS` (`id`),
  ADD CONSTRAINT `RESULTADOS_ibfk_2` FOREIGN KEY (`equipo_ganador_id`) REFERENCES `EQUIPO` (`id`),
  ADD CONSTRAINT `RESULTADOS_ibfk_3` FOREIGN KEY (`equipo_perdedor_id`) REFERENCES `EQUIPO` (`id`);

--
-- Filtros para la tabla `USUARIO`
--
ALTER TABLE `USUARIO`
  ADD CONSTRAINT `USUARIO_ibfk_1` FOREIGN KEY (`creado_por`) REFERENCES `USUARIO` (`id`),
  ADD CONSTRAINT `USUARIO_ibfk_2` FOREIGN KEY (`modificado_por`) REFERENCES `USUARIO` (`id`),
  ADD CONSTRAINT `USUARIO_ibfk_3` FOREIGN KEY (`borrado_por`) REFERENCES `USUARIO` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
