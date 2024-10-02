-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-10-2024 a las 05:51:40
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sgi`
--
CREATE DATABASE IF NOT EXISTS `sgi` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `sgi`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acceso`
--

CREATE TABLE `acceso` (
  `user` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `request_password` enum('0','1') NOT NULL DEFAULT '0',
  `token_password` varchar(200) NOT NULL,
  `roles_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `acceso`
--

INSERT INTO `acceso` (`user`, `email`, `pass`, `request_password`, `token_password`, `roles_fk`) VALUES
('AnaSoto', 'ana_soto82222@elpoli.edu.co', '7y01y3ey64y91y12ay151y187y216y242y273y307y331y363y39by42by451y482y51ey54ey570y60by633y66cy693y72by759y78cy81dy849y876y90cy93', '0', '', 0),
('correo', 'correo@correo.com', '7y01y3ey64y91y12ay151y187y216y242y273y307y331y363y39by42by451y482y51ey54ey570y60by633y66cy693y72by759y78cy81dy849y876y90cy93', '0', '', 2),
('JoseDaza', 'jose_daza82222@elpoli.edu.co', '7y01y3ey64y91y12ay151y187y216y242y273y307y331y363y39by42by451y482y51ey54ey570y60by633y66cy693y72by759y78cy81dy849y876y90cy93', '1', '43b88fdbb587092d2a8c6d7bb7d8533e', 0),
('LuzDelly', 'luzdelly@elpoli.edu.co', '7y01y3ey64y91y12ay151y187y216y242y273y307y331y363y39by42by451y482y51ey54ey570y60by633y66cy693y72by759y78cy81dy849y876y90cy93', '0', '', 1),
('Prueba', 'prueba@chingona.com', '7y01y3ey64y91y12ay151y187y216y242y273y307y331y363y39by42by451y482y51ey54ey570y60by633y66cy693y72by759y78cy81dy849y876y90cy93', '0', '', 2),
('Prueba2', 'chiquillo200401@gmail.com', '7y01y3ey64y91y12ay151y187y216y242y273y307y331y363y39by42by451y482y51ey54ey570y60by633y66cy693y72by759y78cy81dy849y876y90cy93', '0', '', NULL),
('ViviMar', 'vivi_martinez@elpoli.edu.co', '7y01y3ey64y91y12ay151y187y216y242y273y307y331y363y39by42by451y482y51ey54ey570y60by633y66cy693y72by759y78cy81dy849y876y90cy93', '0', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--

CREATE TABLE `area` (
  `id_area` int(11) NOT NULL,
  `nombre_area` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `area`
--

INSERT INTO `area` (`id_area`, `nombre_area`) VALUES
(0, 'fisica'),
(1, 'quimica'),
(2, 'electricidad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `guia`
--

CREATE TABLE `guia` (
  `id_guia` int(11) NOT NULL,
  `nombre_guia` varchar(45) DEFAULT NULL,
  `pdf_guia` varchar(100) DEFAULT NULL,
  `materia_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `guia`
--

INSERT INTO `guia` (`id_guia`, `nombre_guia`, `pdf_guia`, `materia_fk`) VALUES
(1, 'Péndulo simple y compuesto', 'https://drive.google.com/file/d/1unM6J2bLJquHdaw83p-dQIUH83XdRTVR/view?usp=sharing', 1),
(2, 'Sistema masa resorte ', 'https://drive.google.com/file/d/1mw9tmWsge3PGo2AdiVFUevVz3WcBU-vx/view?usp=sharing', 1),
(3, 'Oscilador amortiguado', 'https://drive.google.com/file/d/1vPcfDw4Qw8Asfqv3tDapNfgbfo3xGOBt/view?usp=sharing', 1),
(4, 'Oscilador forzado', 'https://drive.google.com/file/d/1tVEFP-ZBOyDLhU5mxCWNgphOpj5aIJfQ/view?usp=sharing', 1),
(5, 'Características de una onda', 'https://drive.google.com/file/d/1Oy1WW6g0CmQs_GZ6YRcfgDg8AMoMljDP/view?usp=sharing', 1),
(6, 'Ondas estacionarias', 'https://drive.google.com/file/d/1XlX8oU5okVRbQ3f9GYVWzpkNy1xp-k0W/view?usp=sharing', 1),
(7, 'El sonido como una Onda', 'https://drive.google.com/file/d/1fS8rp0DIkMndoK2H_hckbpgThpX5RpTB/view?usp=sharing', 1),
(8, 'Análisis vectorial', 'https://drive.google.com/file/d/1bzO6s_rBqUmkoXSAcW3lrNBdTwdGFTNU/view?usp=sharing', 0),
(9, 'Análisis de datos ', 'https://drive.google.com/file/d/1wTLF8a1Ukas9eQ19UC46uQBorO73ZFZt/view?usp=sharing', 0),
(10, '2a Ley de Newton', 'https://drive.google.com/file/d/1DmfR7Uu-h93tv5W0lsIn5wY-l5HesSRz/view?usp=sharing', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `implemento`
--

CREATE TABLE `implemento` (
  `id_implemento` int(11) NOT NULL,
  `nombre_implemento` varchar(45) NOT NULL,
  `stock_implemento` int(11) NOT NULL,
  `ficha_tecnica` varchar(100) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `guia_uso_lab` varchar(100) DEFAULT NULL,
  `ubicacion_fk` varchar(5) NOT NULL,
  `und_medida_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `implemento`
--

INSERT INTO `implemento` (`id_implemento`, `nombre_implemento`, `stock_implemento`, `ficha_tecnica`, `foto`, `guia_uso_lab`, `ubicacion_fk`, `und_medida_fk`) VALUES
(1, 'Erlenmeyer en vidrio de 200ml', 9, 'https://articulo.mercadolibre.com.co/MCO-836416066-erlenmeyer-en-vidrio-de-200-ml-schott-_JM', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRYOVWAl6FRJtduL0chUokEcL1sJ8jB7jevKay2w9YsqSr4D1JKh2DHjXRu4Qwng6AA', 'Soporta quimicos y temperaturas altas', 'E2', 7),
(2, 'Erlenmeyer En Vidrio De 2000', 3, 'https://articulo.mercadolibre.com.co/MCO-1419241749-erlenmeyer-frasco-de-676fl-oz-vidrio-de-borosili', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRYOVWAl6FRJtduL0chUokEcL1sJ8jB7jevKay2w9YsqSr4D1JKh2DHjXRu4Qwng6AA', 'Soporta quimicos y temperaturas altas', 'E2', 7),
(3, 'Generador de Van der Graaf', 2, 'https://www.phywe.com/es/fisica/electricidad-y-magnetismo/la-electrostatica-y-el-campo-electrico/gen', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQw048rwvs_lNX1FeUOhmQ_2uNh44FG9KrHaw&s', 'Conecta y espera a que cargue', 'Ofi', 7),
(4, 'fuentes de alimentacion de laboratorio dc', 6, 'https://elektroautomatik.com/es/productos/fuentes-de-alimentacion-de-laboratorio-dc/', 'https://static2.efcomponentes.com.ar/6017-thickbox_default/fuente-de-laboratorio-regulable-32v-5a-3-canales-uni-t-utp330', 'Conectar las bananas a los puertos, usar las perillas para controlar el voltaje', 'GE', 7),
(5, 'Multimetro', 8, 'https://www.fluke.com/es-cr/producto/comprobacion-electrica/multimetros-digitales/fluke-115', 'https://dam-assets.fluke.com/s3fs-public/styles/product_slideshow_main/public/flukeig/products/images/dmm/jpeg/115_300dp', 'Girar su perilla para seleccionar lo que se quiera medir, al medir los Amperaje tener en cuenta dond', 'GE', 7),
(6, 'Soporte universal', 17, 'https://fichastecnicas.pchmayoreo.com/CM4365B.pdf', 'https://www.tplaboratorioquimico.com/wp-content/uploads/2015/01/soporte_universal_laboratorio.jpg', 'Material pesado', 'Ofi', 7),
(7, 'Balanza de triple brazo', 6, 'https://www.fishersci.es/shop/products/ohaus-triple-beam-mechanical-balance/11869630', 'https://ftecnologica.udistrital.edu.co/laboratorios/ciencias-basicas/sites/lab-ciencias-basicas/files/imagen-principal-e', 'Poner el elemento a pesar en la placa y deslizar poco a poco hasta que se equilibre', 'GE', 7),
(8, 'Destilador de agua', 1, 'https://www.dentaltix.com/es/sites/default/files/ficha-tecnica-destilador-de-agua.pdf', 'https://www.medicaecuador.com/wp-content/uploads/2021/07/Destilador.png', 'Usarlo dentro de la camara de gases', 'F2', 7),
(9, 'Agitadores magnéticos', 2, 'https://www.pce-iberica.es/medidor-detalles-tecnicos/instrumento-de-medida-laboratorio/agitador-labo', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRXPXKzugtUZSBbcyiwxe_a3FmW-l9gliucag&s', 'la pastilla va dentro del recipiente', 'E2', 7),
(10, 'Aro metálico de 12 cm con nuez', 5, 'https://labcevallos.com/aro-metalico-12-5-cm-con-nuez/13890', 'https://36580daefdd0e4c6740b-4fe617358557d0f7b1aac6516479e176.ssl.cf1.rackcdn.com/products/13890.9303.jpg', 'asegurarse de que este bien fijo al soporte universar', 'E2', 7),
(11, 'Ayudas de ebullición paquetes', 2, 'https://articulo.mercadolibre.com.co/MCO-833400255-perlas-de-ebullicion-de-vidrio-laboratorio-_JM', 'https://http2.mlstatic.com/D_NQ_NP_625770-MCO48273312133_112021-O.webp', 'colocar en el fluido que se va a calentar', 'F2', 0),
(12, 'Balanza analítica', 1, 'https://www.balanzasdigitales.com/analiticas/466-balanza-analitica-de-laboratorio-gram-fv.html', 'https://cdn.shopify.com/s/files/1/0258/6866/4931/files/IMAGEN_1_480x480.png?v=1635990279', 'asegurate de tarar antes de usar', 'F2', 7),
(13, 'Balón de fondo plano de 100 mL', 3, 'https://articulo.mercadolibre.com.co/MCO-2013259760-balon-fondo-plano-de-100-ml-duran-_JM#position=1', 'https://adbaquim.com/media/com_eshop/products/resized/balon-fondo-plano-500x500.jpg', 'material fragil', 'E2', 7),
(14, 'Beaker 100 mL', 20, 'https://articulo.mercadolibre.com.co/MCO-840615604-beaker-de-vidrio-100-ml-laboratorio-vaso-de-preci', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTrXIgv2qqk3BjDZ2fcga8XuSJZuO6Vf3gekg&s', 'material fragil', 'E2', 7),
(15, 'Bureta', 16, 'https://docs.gestionaweb.cat/1081/burn-bureta-con-llave-recta-de-vidrio.pdf', 'https://www.grupocomsurlab.com/wp-content/uploads/2022/02/Bureta-recta-clase-B-llave-de-vidrio.png', 'material fragil', 'C5', 7),
(16, 'Carro con celda de combustible', 1, 'https://www.tiendafotovoltaica.es/Kit-experimental-coche-pila-de-combustible', 'https://i.ytimg.com/vi/Vnx7hZ9YKd0/maxresdefault.jpg', 'Funciona con agua destilada', 'Ofi', 7),
(17, 'Condensador con tubo interno en espiral', 6, 'https://labexco.com/wp-content/uploads/2019/11/Condensador-Graham.pdf', 'https://www.vasodeprecipitado.online/wp-content/uploads/2023/03/tubo-refrigerante.jpg', 'material fragil', 'E2', 7),
(18, 'Crisol', 12, 'https://www.auxilab.es/es/productos-laboratorio/crisol-forma-alta-jipo-30x38-mm/', 'https://ae01.alicdn.com/kf/Hc9ad3929ab904f0092ffa973b25599452.jpg_640x640Q90.jpg_.webp', 'soporta altas temperaturas ', 'E2', 7),
(19, 'Cronómetros', 4, 'https://www.auxilab.es/es/productos-laboratorio/cronometro-digital-hs-12/', 'https://http2.mlstatic.com/D_Q_NP_694950-MLU70666206187_072023-O.webp', 'Fijarse en los modos de uso', 'E2', 7),
(64, 'dd', 5, 'asd', 'dasd', 'asdad', '2A', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimiento`
--

CREATE TABLE `mantenimiento` (
  `id_mantenimiento` int(11) NOT NULL,
  `tipo_mantenimiento` varchar(45) DEFAULT NULL,
  `observaciones` varchar(100) DEFAULT NULL,
  `fecha_mantenimiento` date DEFAULT NULL,
  `implemento_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia`
--

CREATE TABLE `materia` (
  `id_materia` int(11) NOT NULL,
  `nombre_materia` varchar(45) DEFAULT NULL,
  `area_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `materia`
--

INSERT INTO `materia` (`id_materia`, `nombre_materia`, `area_fk`) VALUES
(0, 'fisica de movimiento', 0),
(1, 'fisica de ondas', 0),
(2, 'quimica', 1),
(3, 'quimica general', 1),
(4, 'electricidad y magnetismo', 2),
(5, 'electronica digital', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id_permisos` int(11) NOT NULL,
  `nombre_permiso` varchar(45) DEFAULT NULL,
  `descripcion_permiso` varchar(100) DEFAULT NULL
  `archivo` varchar(45) NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id_permisos`, `nombre_permiso`, `descripcion_permiso`, `archivo`) VALUES
(0, 'GESTIONAR ROLES', 'Puede Gestionar los Roles de los otros usuarios', 'gestionar_roles.php'),
(1, 'Editar_Insumo', 'Puede Editar un insumo'),
(2, 'Agregar_Insumo', 'Puede Registrar Nuevos Implementos'),
(3, 'Eliminar_Insumo', 'Puede Eliminar Implementos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso_rol`
--

CREATE TABLE `permiso_rol` (
  `id_permiso_rol` int(11) NOT NULL,
  `permiso_fk` int(11) NOT NULL,
  `rol_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `permiso_rol`
--

INSERT INTO `permiso_rol` (`id_permiso_rol`, `permiso_fk`, `rol_fk`) VALUES
(1, 0, 0),
(2, 0, 1),
(3, 2, 1),
(4, 2, 0),
(5, 3, 1),
(6, 3, 0),
(7, 1, 0),
(8, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `practica`
--

CREATE TABLE `practica` (
  `id_practica` int(11) NOT NULL,
  `implemento_fk` int(11) NOT NULL,
  `guia_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id_proveedor` int(11) NOT NULL,
  `nombre_proveedor` varchar(45) DEFAULT NULL,
  `tel_proveedor` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id_proveedor`, `nombre_proveedor`, `tel_proveedor`) VALUES
(1, 'dotora', '123123123'),
(2, 'el otro', '1231231234'),
(3, 'federico', '123123123'),
(4, 'carlos', '5151515251'),
(5, 'pedro', '5151235123'),
(6, 'bastian', '23426234'),
(7, 'cortes', '51671236123'),
(8, 'marcos', '377546345373'),
(9, 'mario', '9839829834'),
(10, 'Carla', '52346234');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_entrada`
--

CREATE TABLE `reg_entrada` (
  `id_entrada` int(11) NOT NULL,
  `cantidad_entra` int(11) DEFAULT NULL,
  `fecha_entrada` date DEFAULT NULL,
  `observaciones` varchar(80) DEFAULT NULL,
  `proveedor_fk` int(11) NOT NULL,
  `implemento_entra_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_salida`
--

CREATE TABLE `reg_salida` (
  `id_salida` int(11) NOT NULL,
  `cantidad_sale` int(11) DEFAULT NULL,
  `fecha_salida` date DEFAULT NULL,
  `observaciones` varchar(80) DEFAULT NULL,
  `implemento_sale_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `nombre_rol`) VALUES
(0, 'Administrador'),
(1, 'Laboratorista'),
(2, 'Monitor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transaccion`
--

CREATE TABLE `transaccion` (
  `id_transaccion` int(11) NOT NULL,
  `id_recibe` varchar(13) DEFAULT NULL,
  `tipo_transaccion` varchar(45) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `nombre_recibe` varchar(45) DEFAULT NULL,
  `implemento_transa_fk` int(11) NOT NULL,
  `user_fk` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicacion`
--

CREATE TABLE `ubicacion` (
  `id_ubicacion` varchar(5) NOT NULL,
  `descripcion_ubicacion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ubicacion`
--

INSERT INTO `ubicacion` (`id_ubicacion`, `descripcion_ubicacion`) VALUES
('1A', 'Primer Meson'),
('2A', 'Primer Meson'),
('B1', 'Segundo Meson'),
('C4', 'Tercer Meson'),
('C5', 'Tercer Meson'),
('E2', 'Estantes Blancos al lado izquierdo'),
('F2', 'Cajon grande de madera lado derecho'),
('GE', 'Gabinete Metalico a la Derecha'),
('M2', 'Lockers de madera lado derecho'),
('M4', 'Lockers de madera lado derecho'),
('M7', 'Lockers de madera lado derecho'),
('Ofi', 'Oficina');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad_medida`
--

CREATE TABLE `unidad_medida` (
  `id_medida` int(11) NOT NULL,
  `nombre_medida` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `unidad_medida`
--

INSERT INTO `unidad_medida` (`id_medida`, `nombre_medida`) VALUES
(0, 'gramos'),
(1, 'centimetro'),
(2, 'metro'),
(3, 'litro'),
(4, 'mililitro'),
(7, 'unidad');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acceso`
--
ALTER TABLE `acceso`
  ADD PRIMARY KEY (`user`),
  ADD KEY `fk_ACCESO_ROLES` (`roles_fk`);

--
-- Indices de la tabla `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id_area`);

--
-- Indices de la tabla `guia`
--
ALTER TABLE `guia`
  ADD PRIMARY KEY (`id_guia`),
  ADD KEY `fk_GUIA_MATERIA` (`materia_fk`);

--
-- Indices de la tabla `implemento`
--
ALTER TABLE `implemento`
  ADD PRIMARY KEY (`id_implemento`),
  ADD KEY `ubicacion_implemento` (`ubicacion_fk`),
  ADD KEY `medida_implemento` (`und_medida_fk`);

--
-- Indices de la tabla `mantenimiento`
--
ALTER TABLE `mantenimiento`
  ADD PRIMARY KEY (`id_mantenimiento`),
  ADD KEY `fk_MANTENIMIENTO_IMPLEMENTO` (`implemento_fk`);

--
-- Indices de la tabla `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`id_materia`),
  ADD KEY `fk_MATERIA_AREA` (`area_fk`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id_permisos`);

--
-- Indices de la tabla `permiso_rol`
--
ALTER TABLE `permiso_rol`
  ADD PRIMARY KEY (`id_permiso_rol`),
  ADD KEY `fk_permiso_rol_permisos` (`permiso_fk`),
  ADD KEY `fk_permiso_rol_roles` (`rol_fk`);

--
-- Indices de la tabla `practica`
--
ALTER TABLE `practica`
  ADD PRIMARY KEY (`id_practica`),
  ADD KEY `fk_PRACTICA_implemento` (`implemento_fk`),
  ADD KEY `fk_PRACTICA_GUIA` (`guia_fk`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `reg_entrada`
--
ALTER TABLE `reg_entrada`
  ADD PRIMARY KEY (`id_entrada`),
  ADD KEY `fk_REG_ENTRADA_PROVEEDOR` (`proveedor_fk`),
  ADD KEY `fk_REG_ENTRADA_implemento` (`implemento_entra_fk`);

--
-- Indices de la tabla `reg_salida`
--
ALTER TABLE `reg_salida`
  ADD PRIMARY KEY (`id_salida`),
  ADD KEY `fk_REG_SALIDA_implemento` (`implemento_sale_fk`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `transaccion`
--
ALTER TABLE `transaccion`
  ADD PRIMARY KEY (`id_transaccion`),
  ADD KEY `fk_TRANSACCION_implemento` (`implemento_transa_fk`),
  ADD KEY `fk_TRANSACCION_ACCESO` (`user_fk`);

--
-- Indices de la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  ADD PRIMARY KEY (`id_ubicacion`);

--
-- Indices de la tabla `unidad_medida`
--
ALTER TABLE `unidad_medida`
  ADD PRIMARY KEY (`id_medida`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `area`
--
ALTER TABLE `area`
  MODIFY `id_area` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `guia`
--
ALTER TABLE `guia`
  MODIFY `id_guia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `implemento`
--
ALTER TABLE `implemento`
  MODIFY `id_implemento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT de la tabla `mantenimiento`
--
ALTER TABLE `mantenimiento`
  MODIFY `id_mantenimiento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `materia`
--
ALTER TABLE `materia`
  MODIFY `id_materia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `permiso_rol`
--
ALTER TABLE `permiso_rol`
  MODIFY `id_permiso_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `practica`
--
ALTER TABLE `practica`
  MODIFY `id_practica` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `reg_entrada`
--
ALTER TABLE `reg_entrada`
  MODIFY `id_entrada` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reg_salida`
--
ALTER TABLE `reg_salida`
  MODIFY `id_salida` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `acceso`
--
ALTER TABLE `acceso`
  ADD CONSTRAINT `fk_ACCESO_ROLES` FOREIGN KEY (`roles_fk`) REFERENCES `roles` (`id_rol`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `guia`
--
ALTER TABLE `guia`
  ADD CONSTRAINT `fk_GUIA_MATERIA` FOREIGN KEY (`materia_fk`) REFERENCES `materia` (`id_materia`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `implemento`
--
ALTER TABLE `implemento`
  ADD CONSTRAINT `medida_implemento` FOREIGN KEY (`und_medida_fk`) REFERENCES `unidad_medida` (`id_medida`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `ubicacion_implemento` FOREIGN KEY (`ubicacion_fk`) REFERENCES `ubicacion` (`id_ubicacion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `mantenimiento`
--
ALTER TABLE `mantenimiento`
  ADD CONSTRAINT `fk_MANTENIMIENTO_IMPLEMENTO` FOREIGN KEY (`implemento_fk`) REFERENCES `implemento` (`id_implemento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `materia`
--
ALTER TABLE `materia`
  ADD CONSTRAINT `fk_MATERIA_AREA` FOREIGN KEY (`area_fk`) REFERENCES `area` (`id_area`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `permiso_rol`
--
ALTER TABLE `permiso_rol`
  ADD CONSTRAINT `fk_permiso_rol_permisos` FOREIGN KEY (`permiso_fk`) REFERENCES `permisos` (`id_permisos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_permiso_rol_roles` FOREIGN KEY (`rol_fk`) REFERENCES `roles` (`id_rol`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `practica`
--
ALTER TABLE `practica`
  ADD CONSTRAINT `fk_PRACTICA_GUIA` FOREIGN KEY (`guia_fk`) REFERENCES `guia` (`id_guia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_PRACTICA_implemento` FOREIGN KEY (`implemento_fk`) REFERENCES `implemento` (`id_implemento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `reg_entrada`
--
ALTER TABLE `reg_entrada`
  ADD CONSTRAINT `fk_REG_ENTRADA_PROVEEDOR` FOREIGN KEY (`proveedor_fk`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_REG_ENTRADA_implemento` FOREIGN KEY (`implemento_entra_fk`) REFERENCES `implemento` (`id_implemento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `reg_salida`
--
ALTER TABLE `reg_salida`
  ADD CONSTRAINT `fk_REG_SALIDA_implemento` FOREIGN KEY (`implemento_sale_fk`) REFERENCES `implemento` (`id_implemento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `transaccion`
--
ALTER TABLE `transaccion`
  ADD CONSTRAINT `fk_TRANSACCION_ACCESO` FOREIGN KEY (`user_fk`) REFERENCES `acceso` (`user`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_TRANSACCION_implemento` FOREIGN KEY (`implemento_transa_fk`) REFERENCES `implemento` (`id_implemento`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;