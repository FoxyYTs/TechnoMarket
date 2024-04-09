-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-09-2023 a las 22:31:37
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `zoologicosr`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acceso`
--

CREATE TABLE `acceso` (
  `usuario` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `clave` varchar(30) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `acceso`
--

INSERT INTO `acceso` (`usuario`, `clave`) VALUES
('poli1', 'poli123'),
('poli2', 'poli123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alimentos`
--

CREATE TABLE `alimentos` (
  `cod_alimento` int(11) NOT NULL,
  `nombre` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `unidad_medida` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `alimentos`
--

INSERT INTO `alimentos` (`cod_alimento`, `nombre`, `unidad_medida`) VALUES
(1, 'Carne de Res', 3),
(2, 'Carne de Cerdo', 3),
(3, 'Zanahorias', 1),
(4, 'Acelgas', 1),
(5, 'Insectos', 2),
(6, 'esparragos', 3),
(7, 'maiz', 1),
(8, 'oregano', 2),
(9, 'burro', 1),
(10, 'pez', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ambiente`
--

CREATE TABLE `ambiente` (
  `id_ambiente` int(11) NOT NULL,
  `nombre` varchar(20) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `ambiente`
--

INSERT INTO `ambiente` (`id_ambiente`, `nombre`) VALUES
(1, 'Pradera'),
(2, 'Bosque'),
(3, 'Desierto'),
(4, 'Selva'),
(5, 'Sabana'),
(6, 'Jungla');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `animal`
--

CREATE TABLE `animal` (
  `id_animal` int(11) NOT NULL,
  `nombre_animal` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `fecha_salida` date DEFAULT NULL,
  `fecha_muerte` date DEFAULT NULL,
  `estado_an` int(11) NOT NULL,
  `cod_esp_an` int(11) NOT NULL,
  `imagen` varchar(200) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `animal`
--

INSERT INTO `animal` (`id_animal`, `nombre_animal`, `fecha_ingreso`, `fecha_salida`, `fecha_muerte`, `estado_an`, `cod_esp_an`, `imagen`) VALUES
(123, 'Mico', '2023-05-01', NULL, NULL, 1, 601, 'https://inaturalist-open-data.s3.amazonaws.com/photos/60804996/large.jpg'),
(493, 'Serpiente', '2023-04-13', '0000-00-00', '0000-00-00', 1, 1546, 'https://statics-cuidateplus.marca.com/cms/styles/natural/azblob/serpiente-azul.jpg.webp'),
(1056, 'Oso', '2020-05-15', '0000-00-00', '0000-00-00', 1, 601, 'https://us.123rf.com/450wm/rarityassetclub/rarityassetclub2301/rarityassetclub230101243/197147257-representaci%C3%B3n-3d-de-un-oso-pardo-parado-en-un-lago-congelado-al-atardecer.jpg?ver=6'),
(1234, 'Perro', '2023-05-01', NULL, NULL, 1, 601, 'https://estaticos-cdn.prensaiberica.es/clip/823f515c-8143-4044-8f13-85ea1ef58f3a_16-9-discover-aspect-ratio_default_0.jpg'),
(1644, 'León', '2020-07-10', '0000-00-00', '0000-00-00', 1, 601, 'https://cdn0.bioenciclopedia.com/es/posts/2/3/0/leon_32_600_square.jpg'),
(4991, 'Venado', '2019-01-18', '2023-04-12', '0000-00-00', 3, 601, 'https://t1.ea.ltmcdn.com/es/posts/6/1/9/diferencias_entre_ciervo_y_venado_23916_600_square.jpg'),
(5698, 'Lechuza', '2023-05-03', NULL, NULL, 1, 601, 'https://www.revistapetlovers.com/wp-content/uploads/2020/08/donde-viven-las-lechuzas_buhos-lechuza-cazadores-nocturnos-diferencis-beneficios-e1598392848316.jpeg'),
(9433, 'Coyote', '2018-04-25', '0000-00-00', '0000-00-00', 1, 601, 'https://www.ngenespanol.com/wp-content/uploads/2023/01/coyote-el-aullador-nocturno-y-depredador-implacable-770x431.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especies`
--

CREATE TABLE `especies` (
  `codigo_esp` int(11) NOT NULL,
  `nombre` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `cantidad_esp` int(11) NOT NULL,
  `ambiente_esp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `especies`
--

INSERT INTO `especies` (`codigo_esp`, `nombre`, `cantidad_esp`, `ambiente_esp`) VALUES
(601, 'Mamifero', 7, 2),
(1546, 'Reptil', 6, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id_estado` int(11) NOT NULL,
  `nombre_estado` varchar(15) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id_estado`, `nombre_estado`) VALUES
(1, 'Vivo'),
(2, 'Muerto'),
(3, 'Trasladado'),
(4, 'Enfermo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `porciones`
--

CREATE TABLE `porciones` (
  `id_porcion` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` int(11) NOT NULL,
  `cantidad_alimento` int(11) NOT NULL,
  `cod_alimento_por` int(11) NOT NULL,
  `cod_animal_por` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `porciones`
--

INSERT INTO `porciones` (`id_porcion`, `fecha`, `hora`, `cantidad_alimento`, `cod_alimento_por`, `cod_animal_por`) VALUES
(1, '2023-04-10', 6, 3, 2, 9433),
(2, '2023-04-10', 7, 5, 1, 1644),
(3, '2023-04-10', 8, 5, 2, 1056),
(4, '2023-04-10', 8, 100, 5, 493),
(5, '2023-04-10', 9, 5, 3, 4991);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad_medida`
--

CREATE TABLE `unidad_medida` (
  `id_unidad` int(11) NOT NULL,
  `nombre_unidad` varchar(30) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `unidad_medida`
--

INSERT INTO `unidad_medida` (`id_unidad`, `nombre_unidad`) VALUES
(1, 'Libra'),
(2, 'Gramo'),
(3, 'Kilogramo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `nombre_usuario` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `clave` varchar(30) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`nombre_usuario`, `clave`) VALUES
('zoo1', 'zoo1'),
('zoo2', 'zoo2');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acceso`
--
ALTER TABLE `acceso`
  ADD PRIMARY KEY (`usuario`);

--
-- Indices de la tabla `alimentos`
--
ALTER TABLE `alimentos`
  ADD PRIMARY KEY (`cod_alimento`),
  ADD KEY `unidad_medida` (`unidad_medida`);

--
-- Indices de la tabla `ambiente`
--
ALTER TABLE `ambiente`
  ADD PRIMARY KEY (`id_ambiente`);

--
-- Indices de la tabla `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`id_animal`),
  ADD KEY `estado_an` (`estado_an`),
  ADD KEY `cod_esp_an` (`cod_esp_an`);

--
-- Indices de la tabla `especies`
--
ALTER TABLE `especies`
  ADD PRIMARY KEY (`codigo_esp`),
  ADD KEY `ambiente_esp` (`ambiente_esp`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `porciones`
--
ALTER TABLE `porciones`
  ADD PRIMARY KEY (`id_porcion`),
  ADD KEY `cod_alimento_por` (`cod_alimento_por`),
  ADD KEY `cod_animal_por` (`cod_animal_por`);

--
-- Indices de la tabla `unidad_medida`
--
ALTER TABLE `unidad_medida`
  ADD PRIMARY KEY (`id_unidad`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`nombre_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `porciones`
--
ALTER TABLE `porciones`
  MODIFY `id_porcion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `unidad_medida`
--
ALTER TABLE `unidad_medida`
  MODIFY `id_unidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alimentos`
--
ALTER TABLE `alimentos`
  ADD CONSTRAINT `alimentos_ibfk_1` FOREIGN KEY (`unidad_medida`) REFERENCES `unidad_medida` (`id_unidad`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `animal`
--
ALTER TABLE `animal`
  ADD CONSTRAINT `animal_ibfk_1` FOREIGN KEY (`estado_an`) REFERENCES `estado` (`id_estado`) ON UPDATE CASCADE,
  ADD CONSTRAINT `animal_ibfk_2` FOREIGN KEY (`cod_esp_an`) REFERENCES `especies` (`codigo_esp`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `especies`
--
ALTER TABLE `especies`
  ADD CONSTRAINT `especies_ibfk_1` FOREIGN KEY (`ambiente_esp`) REFERENCES `ambiente` (`id_ambiente`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `porciones`
--
ALTER TABLE `porciones`
  ADD CONSTRAINT `porciones_ibfk_1` FOREIGN KEY (`cod_alimento_por`) REFERENCES `alimentos` (`cod_alimento`) ON UPDATE CASCADE,
  ADD CONSTRAINT `porciones_ibfk_2` FOREIGN KEY (`cod_animal_por`) REFERENCES `animal` (`id_animal`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
