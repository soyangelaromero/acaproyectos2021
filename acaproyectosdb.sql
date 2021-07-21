-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-07-2021 a las 05:45:01
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `acaproyectosdb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `ID_Cliente` int(11) NOT NULL,
  `nombre_empresa` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `sector_mercado` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `pais_id` int(11) NOT NULL,
  `nombre_representante` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  `correo_contacto` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `cantidad_proyectos` int(11) NOT NULL,
  `estatus_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`ID_Cliente`, `nombre_empresa`, `sector_mercado`, `pais_id`, `nombre_representante`, `telefono`, `correo_contacto`, `cantidad_proyectos`, `estatus_id`) VALUES
(1, 'Askix Revolution, Inc', 'Productos Industriales', 2, 'Adib Akram Askix', '00966', 'askixrevolution@company.as', 5, 1),
(2, 'Blissardz Company', 'Comercio Internacional', 12, 'Caroline Mercedes ', '55642', 'blissarddzCO@company.com', 12, 2),
(4, 'Minicious Corp#', 'ProducciÃ³n de software', 9, 'Isaac Elvez', '04248828989', 'minicorp@software.co', 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estatus`
--

CREATE TABLE `estatus` (
  `ID_estatus` int(11) NOT NULL,
  `nombre_estatus` varchar(500) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `estatus`
--

INSERT INTO `estatus` (`ID_estatus`, `nombre_estatus`) VALUES
(1, 'Activo'),
(2, 'Inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivel_ingles`
--

CREATE TABLE `nivel_ingles` (
  `ID_NivelIngles` int(11) NOT NULL,
  `nivel_ingles` varchar(500) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `nivel_ingles`
--

INSERT INTO `nivel_ingles` (`ID_NivelIngles`, `nivel_ingles`) VALUES
(1, 'Principiante'),
(2, 'Intermedio'),
(3, 'Avanzado'),
(4, 'Nativo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE `pais` (
  `ID_Pais` int(11) NOT NULL,
  `nombre_pais` varchar(500) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`ID_Pais`, `nombre_pais`) VALUES
(1, 'Alemania'),
(2, 'Arabia Saudita'),
(3, 'Argentina'),
(4, 'Australia'),
(5, 'Bélgica'),
(6, 'Brasil'),
(7, 'Canadá'),
(8, 'Chile'),
(9, 'China'),
(10, 'Colombia'),
(11, 'Costa Rica'),
(12, 'Croacia'),
(13, 'Dinamarca'),
(14, 'Ecuador'),
(15, 'Egipto'),
(16, 'España'),
(17, 'Estados Unidos'),
(18, 'Francia'),
(19, 'Hungría'),
(20, 'India'),
(21, 'Italia'),
(22, 'Japón'),
(23, 'México'),
(24, 'Noruega'),
(25, 'Nueva Zelanda'),
(26, 'Países Bajos'),
(27, 'Panamá'),
(28, 'Portugal'),
(29, 'Reino Unido'),
(30, 'Rusia'),
(31, 'Singapur'),
(32, 'Sudáfrica'),
(33, 'Suecia'),
(34, 'Suiza'),
(35, 'Tailandia'),
(36, 'Trinidad y Tobago'),
(37, 'Turquía'),
(38, 'Ucrania'),
(39, 'Venezuela');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prioridad`
--

CREATE TABLE `prioridad` (
  `ID_Prioridad` int(11) NOT NULL,
  `nivel_prioridad` varchar(500) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `prioridad`
--

INSERT INTO `prioridad` (`ID_Prioridad`, `nivel_prioridad`) VALUES
(1, 'Bajo'),
(2, 'Medio'),
(3, 'Alto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesional`
--

CREATE TABLE `profesional` (
  `ID_Profesional` int(11) NOT NULL,
  `nombre_completo` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `correo_profesional` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `telefono_profesional` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  `seniority_id` int(11) NOT NULL,
  `disponible` tinyint(1) NOT NULL,
  `puntuacion` double(10,2) NOT NULL,
  `horas_diarias` int(11) NOT NULL,
  `horas_disponibles` int(11) NOT NULL,
  `nivel_ingles_id` int(11) NOT NULL,
  `pais_id` int(11) NOT NULL,
  `contrasenia` varchar(8) COLLATE utf8_spanish_ci NOT NULL,
  `tipo_usuario_id` int(11) NOT NULL,
  `estatus_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `profesional`
--

INSERT INTO `profesional` (`ID_Profesional`, `nombre_completo`, `fecha_nacimiento`, `correo_profesional`, `telefono_profesional`, `seniority_id`, `disponible`, `puntuacion`, `horas_diarias`, `horas_disponibles`, `nivel_ingles_id`, `pais_id`, `contrasenia`, `tipo_usuario_id`, `estatus_id`) VALUES
(1, 'Jane Doe', '1996-01-01', 'admin@acaproyectos.com', '48584', 1, 0, 98.00, 8, 2, 1, 1, 'admin', 1, 1),
(12, 'Jonny Doe', '1996-01-01', 'jodoe@acaproyectos.com', '5554367', 3, 0, 58.00, 6, 1, 2, 18, 'regular1', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesional_proyecto`
--

CREATE TABLE `profesional_proyecto` (
  `ID_ProfesionalProyecto` int(11) NOT NULL,
  `profesional_id` int(11) NOT NULL,
  `proyecto_id` int(11) NOT NULL,
  `rol_laboral_id` int(11) NOT NULL,
  `horas_asignadas` int(11) NOT NULL,
  `horas_trabajadas` int(11) NOT NULL,
  `trabajando` tinyint(1) NOT NULL,
  `estatus_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `profesional_proyecto`
--

INSERT INTO `profesional_proyecto` (`ID_ProfesionalProyecto`, `profesional_id`, `proyecto_id`, `rol_laboral_id`, `horas_asignadas`, `horas_trabajadas`, `trabajando`, `estatus_id`) VALUES
(1, 1, 1, 1, 444, 317, 1, 2),
(2, 12, 3, 3, 554, 88, 1, 1),
(4, 12, 1, 9, 648, 640, 0, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `progreso`
--

CREATE TABLE `progreso` (
  `ID_Progreso` int(11) NOT NULL,
  `nivel_progreso` varchar(500) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `progreso`
--

INSERT INTO `progreso` (`ID_Progreso`, `nivel_progreso`) VALUES
(1, 'Por Hacer'),
(2, 'En Proceso'),
(3, 'Finalizado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

CREATE TABLE `proyecto` (
  `ID_Proyecto` int(11) NOT NULL,
  `nombre_proyecto` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion_breve` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `prioridad_id` int(11) NOT NULL,
  `progreso_id` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin_estimada` date NOT NULL,
  `fecha_fin_real` date NOT NULL,
  `total_horas_estimadas` int(11) NOT NULL,
  `total_horas_real` int(11) NOT NULL,
  `gasto_estimado` double(10,2) NOT NULL,
  `gasto_real` double(10,2) NOT NULL,
  `estatus_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proyecto`
--

INSERT INTO `proyecto` (`ID_Proyecto`, `nombre_proyecto`, `descripcion_breve`, `cliente_id`, `prioridad_id`, `progreso_id`, `fecha_inicio`, `fecha_fin_estimada`, `fecha_fin_real`, `total_horas_estimadas`, `total_horas_real`, `gasto_estimado`, `gasto_real`, `estatus_id`) VALUES
(1, 'Paneles Solares AsKix LLD', 'Manejo de energÃ­as naturales', 1, 3, 3, '2020-11-30', '2021-06-07', '2021-07-29', 200, 250, 51254.00, 80254.00, 1),
(3, 'Nano Ads Element', 'Minirobots para la higiene personal', 4, 2, 1, '2021-08-25', '2022-07-15', '0000-00-00', 1200, 0, 124578.00, 254871.00, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_laboral`
--

CREATE TABLE `rol_laboral` (
  `ID_RolLaboral` int(11) NOT NULL,
  `nombre_rol` varchar(500) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `rol_laboral`
--

INSERT INTO `rol_laboral` (`ID_RolLaboral`, `nombre_rol`) VALUES
(1, 'FrontEnd'),
(2, 'BackEnd'),
(3, 'FullStack'),
(4, 'Bases de Datos'),
(5, 'DevOps'),
(6, 'Analista QA'),
(7, 'Project Manager'),
(8, 'UX/UI'),
(9, 'Arquitecto de Software'),
(10, 'Consultor Técnico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seniority`
--

CREATE TABLE `seniority` (
  `ID_Seniority` int(11) NOT NULL,
  `nivel_seniority` varchar(500) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `seniority`
--

INSERT INTO `seniority` (`ID_Seniority`, `nivel_seniority`) VALUES
(1, 'Trainee'),
(2, 'Apprentice'),
(3, 'Junior'),
(4, 'Semi Senior'),
(5, 'Senior');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `ID_TipoUsuario` int(11) NOT NULL,
  `tipo_usuario` varchar(500) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`ID_TipoUsuario`, `tipo_usuario`) VALUES
(1, 'Administrador'),
(2, 'Regular');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`ID_Cliente`),
  ADD KEY `pais_id` (`pais_id`),
  ADD KEY `estatus_id` (`estatus_id`);

--
-- Indices de la tabla `estatus`
--
ALTER TABLE `estatus`
  ADD PRIMARY KEY (`ID_estatus`);

--
-- Indices de la tabla `nivel_ingles`
--
ALTER TABLE `nivel_ingles`
  ADD PRIMARY KEY (`ID_NivelIngles`);

--
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`ID_Pais`);

--
-- Indices de la tabla `prioridad`
--
ALTER TABLE `prioridad`
  ADD PRIMARY KEY (`ID_Prioridad`);

--
-- Indices de la tabla `profesional`
--
ALTER TABLE `profesional`
  ADD PRIMARY KEY (`ID_Profesional`),
  ADD KEY `seniority_id` (`seniority_id`),
  ADD KEY `nivel_ingles_id` (`nivel_ingles_id`),
  ADD KEY `pais_id` (`pais_id`),
  ADD KEY `tipo_usuario_id` (`tipo_usuario_id`),
  ADD KEY `estatus_id` (`estatus_id`);

--
-- Indices de la tabla `profesional_proyecto`
--
ALTER TABLE `profesional_proyecto`
  ADD PRIMARY KEY (`ID_ProfesionalProyecto`),
  ADD KEY `profesional_id` (`profesional_id`),
  ADD KEY `proyecto_id` (`proyecto_id`),
  ADD KEY `rol_laboral_id` (`rol_laboral_id`),
  ADD KEY `estatus_id` (`estatus_id`);

--
-- Indices de la tabla `progreso`
--
ALTER TABLE `progreso`
  ADD PRIMARY KEY (`ID_Progreso`);

--
-- Indices de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD PRIMARY KEY (`ID_Proyecto`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `prioridad_id` (`prioridad_id`),
  ADD KEY `progreso_id` (`progreso_id`),
  ADD KEY `estatus_id` (`estatus_id`);

--
-- Indices de la tabla `rol_laboral`
--
ALTER TABLE `rol_laboral`
  ADD PRIMARY KEY (`ID_RolLaboral`);

--
-- Indices de la tabla `seniority`
--
ALTER TABLE `seniority`
  ADD PRIMARY KEY (`ID_Seniority`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`ID_TipoUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `ID_Cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `estatus`
--
ALTER TABLE `estatus`
  MODIFY `ID_estatus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `nivel_ingles`
--
ALTER TABLE `nivel_ingles`
  MODIFY `ID_NivelIngles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `pais`
--
ALTER TABLE `pais`
  MODIFY `ID_Pais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `prioridad`
--
ALTER TABLE `prioridad`
  MODIFY `ID_Prioridad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `profesional`
--
ALTER TABLE `profesional`
  MODIFY `ID_Profesional` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `profesional_proyecto`
--
ALTER TABLE `profesional_proyecto`
  MODIFY `ID_ProfesionalProyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `progreso`
--
ALTER TABLE `progreso`
  MODIFY `ID_Progreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  MODIFY `ID_Proyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `rol_laboral`
--
ALTER TABLE `rol_laboral`
  MODIFY `ID_RolLaboral` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `seniority`
--
ALTER TABLE `seniority`
  MODIFY `ID_Seniority` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `ID_TipoUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`pais_id`) REFERENCES `pais` (`ID_Pais`),
  ADD CONSTRAINT `cliente_ibfk_2` FOREIGN KEY (`estatus_id`) REFERENCES `estatus` (`ID_estatus`);

--
-- Filtros para la tabla `profesional`
--
ALTER TABLE `profesional`
  ADD CONSTRAINT `profesional_ibfk_1` FOREIGN KEY (`seniority_id`) REFERENCES `seniority` (`ID_Seniority`),
  ADD CONSTRAINT `profesional_ibfk_2` FOREIGN KEY (`nivel_ingles_id`) REFERENCES `nivel_ingles` (`ID_NivelIngles`),
  ADD CONSTRAINT `profesional_ibfk_3` FOREIGN KEY (`pais_id`) REFERENCES `pais` (`ID_Pais`),
  ADD CONSTRAINT `profesional_ibfk_4` FOREIGN KEY (`tipo_usuario_id`) REFERENCES `tipo_usuario` (`ID_TipoUsuario`),
  ADD CONSTRAINT `profesional_ibfk_5` FOREIGN KEY (`estatus_id`) REFERENCES `estatus` (`ID_estatus`);

--
-- Filtros para la tabla `profesional_proyecto`
--
ALTER TABLE `profesional_proyecto`
  ADD CONSTRAINT `profesional_proyecto_ibfk_1` FOREIGN KEY (`profesional_id`) REFERENCES `profesional` (`ID_Profesional`),
  ADD CONSTRAINT `profesional_proyecto_ibfk_2` FOREIGN KEY (`proyecto_id`) REFERENCES `proyecto` (`ID_Proyecto`),
  ADD CONSTRAINT `profesional_proyecto_ibfk_3` FOREIGN KEY (`rol_laboral_id`) REFERENCES `rol_laboral` (`ID_RolLaboral`),
  ADD CONSTRAINT `profesional_proyecto_ibfk_4` FOREIGN KEY (`estatus_id`) REFERENCES `estatus` (`ID_estatus`);

--
-- Filtros para la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD CONSTRAINT `proyecto_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`ID_Cliente`),
  ADD CONSTRAINT `proyecto_ibfk_2` FOREIGN KEY (`prioridad_id`) REFERENCES `prioridad` (`ID_Prioridad`),
  ADD CONSTRAINT `proyecto_ibfk_3` FOREIGN KEY (`progreso_id`) REFERENCES `progreso` (`ID_Progreso`),
  ADD CONSTRAINT `proyecto_ibfk_4` FOREIGN KEY (`estatus_id`) REFERENCES `estatus` (`ID_estatus`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
