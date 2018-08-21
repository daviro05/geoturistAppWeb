-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-08-2018 a las 19:04:56
-- Versión del servidor: 10.1.28-MariaDB
-- Versión de PHP: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `geoturistapp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `audios`
--

CREATE TABLE `audios` (
  `id_lugar` int(11) NOT NULL,
  `url_audio` varchar(200) CHARACTER SET utf8 NOT NULL,
  `descripcion` varchar(300) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `audios`
--

INSERT INTO `audios` (`id_lugar`, `url_audio`, `descripcion`) VALUES
(5, 'MosManRap.mp3', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentario` int(11) NOT NULL,
  `id_usuario` varchar(40) CHARACTER SET utf8 NOT NULL,
  `id_lugar` int(11) NOT NULL,
  `comentario` varchar(400) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id_comentario`, `id_usuario`, `id_lugar`, `comentario`) VALUES
(2, 'david', 5, 'Me encanta!'),
(3, 'david', 6, 'Es un museo genial!'),
(4, 'admin', 5, 'Precioso!'),
(5, 'admin', 5, 'Jajajaja volverÃ© segurisimo'),
(10, 'admin', 8, 'mola'),
(11, 'admin', 8, 'Sorolla es lo mÃ¡s'),
(12, 'admin', 76, 'me gusta'),
(13, 'admin', 138, 'VolverÃ© seguro'),
(14, 'mariana', 138, 'Interesante'),
(15, 'admin', 5, 'Mola!'),
(16, 'admin', 139, 'Me gusta mucho'),
(17, 'admin', 142, 'mola');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

CREATE TABLE `documentos` (
  `id_lugar` int(11) NOT NULL,
  `url_doc` varchar(200) CHARACTER SET utf8 NOT NULL,
  `descripcion` varchar(300) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `documentos`
--

INSERT INTO `documentos` (`id_lugar`, `url_doc`, `descripcion`) VALUES
(5, 'Entradas.pdf', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gestion`
--

CREATE TABLE `gestion` (
  `id_admin` varchar(40) CHARACTER SET utf8 NOT NULL,
  `password` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `gestion`
--

INSERT INTO `gestion` (`id_admin`, `password`) VALUES
('david', 'fcea920f7412b5da7be0cf42b8c93759'),
('admin', '12345');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `id_lugar` int(11) NOT NULL,
  `url_imagen` varchar(200) CHARACTER SET utf8 NOT NULL,
  `descripcion` varchar(300) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`id_lugar`, `url_imagen`, `descripcion`) VALUES
(5, 'museo-prado.jpg', ''),
(5, 'museo-prado2.jpg', ''),
(5, 'museo-prado3.jpg', ''),
(138, 'museo-arqueologico.jpg', ''),
(138, 'museo-arqueologico2.jpg', ''),
(140, 'torre.jpg', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidencias`
--

CREATE TABLE `incidencias` (
  `id_incidencia` int(11) NOT NULL,
  `id_usuario` varchar(40) CHARACTER SET utf8 NOT NULL,
  `tipo` varchar(40) CHARACTER SET utf8 NOT NULL,
  `incidencia` varchar(200) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `incidencias`
--

INSERT INTO `incidencias` (`id_incidencia`, `id_usuario`, `tipo`, `incidencia`) VALUES
(5, 'admin', 'informacion', 'La aplicaciÃ³n es muy Ãºtil'),
(6, 'david', 'problema', 'No se pueden ver las imÃ¡genes del Museo ArqueolÃ³gico Nacional');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lugares`
--

CREATE TABLE `lugares` (
  `id_lugar` int(11) NOT NULL,
  `nombre` varchar(150) CHARACTER SET utf8 NOT NULL,
  `tipo` varchar(200) CHARACTER SET utf8 NOT NULL,
  `latitud` varchar(150) CHARACTER SET utf8 NOT NULL,
  `longitud` varchar(150) CHARACTER SET utf8 NOT NULL,
  `hora_abre` time NOT NULL,
  `hora_cierra` time NOT NULL,
  `dias_abre` varchar(100) CHARACTER SET utf8 NOT NULL,
  `descripcion` varchar(500) CHARACTER SET utf8 NOT NULL,
  `visitas` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `lugares`
--

INSERT INTO `lugares` (`id_lugar`, `nombre`, `tipo`, `latitud`, `longitud`, `hora_abre`, `hora_cierra`, `dias_abre`, `descripcion`, `visitas`) VALUES
(5, 'Museo Nacional del Prado', 'museum', '40.4137818', '-3.6921270999999933', '00:00:00', '00:00:00', '', '', 3),
(6, 'Museo Reina SofÃ­a', 'museum', '40.4073281', '-3.694900200', '00:00:00', '00:00:00', '', '', 3),
(8, 'Museo Sorolla', 'museum', '40.4354363', '-3.692517299999963', '20:20:00', '21:21:00', 'L', 'Uno de los museos', 4),
(76, 'Museo de Cera', 'museum', '40.4249581', '-3.691335200000026', '00:00:00', '00:00:00', '', '', 3),
(97, 'Museo De La Radio', 'bar', '40.4097375', '-3.7085617000000184', '00:00:00', '00:00:00', '', '', 3),
(100, 'Parque El Capricho', 'park', '40.456625', '-3.5989319999999907', '00:00:00', '00:00:00', '', '', 3),
(119, 'Museo Sorolla', 'museum', '40.4354363', '-3.692517299999963', '00:00:00', '00:00:00', '', 'Museo muy bonito', 3),
(120, 'Becerril de la Sierra', 'locality', '40.7102483', '-3.9954969000000347', '21:00:00', '22:00:00', 'L M X ', 'Pueblo de mierda', 3),
(121, 'Torrelodones', 'locality', '40.5766078', '-3.9293645999999853', '00:00:00', '00:00:00', '', '', 3),
(123, 'Puerta del Sol', 'monumento', '40.4169473', '-3.7035284999999476', '00:00:00', '23:59:00', '', 'Es muy bonita', 3),
(133, 'Parque de El Retiro', 'park', '40.4152606', '-3.6844995000000154', '10:00:00', '22:00:00', 'L M X J V S ', 'Bonito lugar', 3),
(136, 'Palacio de Bellas Artes', 'premise', '19.4352', '-99.14120000000003', '10:00:00', '20:00:00', 'L M X J V S D ', 'Uno de los monumentos mÃ¡s bonitos de la CDMX', 3),
(137, 'Ciudad de MÃ©xico', 'ciudad', '19.2464696', '-99.10134979999998', '00:00:00', '00:00:00', 'L M X J V S D ', 'Me encanta la CDMX', 3),
(138, 'Museo Arqueologico', 'museum', '40.423553', '-3.6894019999999728', '09:00:00', '19:00:00', 'L M X J V S D ', 'Es un Museo Nacional espaÃ±ol con sede en el Palacio de Biblioteca y Museos Nacionales de Madrid', 3),
(139, 'Casa de la Cultura', 'point_of_interest', '40.5795742', '-3.9566796000000295', '10:00:00', '21:00:00', 'L M X J V ', 'Casa de la cultura', 3),
(140, 'Atalaya Torrelodones', 'point_of_interest', '40.5738996', '-3.9324454999999716', '00:00:00', '00:00:00', 'L M X J V S D ', 'La torre', 2),
(142, 'Parroquia San Ignacio de Loyola', 'church', '40.5768141', '-3.9527971999999636', '00:00:00', '00:00:00', '', 'iglesia', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` varchar(40) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `apellidos` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `comentarios` int(11) NOT NULL,
  `valoraciones` int(11) NOT NULL,
  `img_perfil` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellidos`, `password`, `email`, `comentarios`, `valoraciones`, `img_perfil`) VALUES
('admin', 'David', 'Admin', '21232f297a57a5a743894a0e4a801fc3', 'david_admin@ucm.es', 13, 11, 'vacio.png'),
('david', 'David', 'Rodriguez', '827ccb0eea8a706c4c34a16891f84e7b', 'daviro05@ucm.es', 2, 1, 'vacio.png'),
('mariana', 'Mariana', 'Vega', '827ccb0eea8a706c4c34a16891f84e7b', 'mariana@gmail.com', 1, 1, 'vacio.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_lugares`
--

CREATE TABLE `usuarios_lugares` (
  `id_usuario` varchar(40) CHARACTER SET utf8 NOT NULL,
  `id_lugar` int(11) NOT NULL,
  `nombre_lugar` varchar(150) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios_lugares`
--

INSERT INTO `usuarios_lugares` (`id_usuario`, `id_lugar`, `nombre_lugar`) VALUES
('admin', 8, 'Museo Sorolla'),
('admin', 76, 'Museo de Cera'),
('admin', 5, 'Museo Nacional del Prado'),
('admin', 139, 'Casa de la Cultura'),
('admin', 142, 'Parroquia San Ignacio de Loyola');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valoraciones`
--

CREATE TABLE `valoraciones` (
  `id_valoracion` int(11) NOT NULL,
  `id_usuario` varchar(40) CHARACTER SET utf8 NOT NULL,
  `id_lugar` int(11) NOT NULL,
  `valoracion` float NOT NULL,
  `num_valoraciones` int(11) NOT NULL,
  `sum_valoraciones` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `valoraciones`
--

INSERT INTO `valoraciones` (`id_valoracion`, `id_usuario`, `id_lugar`, `valoracion`, `num_valoraciones`, `sum_valoraciones`) VALUES
(18, 'david', 5, 6.5, 8, 52),
(20, 'admin', 8, 6.5, 2, 13),
(21, 'admin', 76, 6, 1, 6),
(22, 'admin', 138, 5.33333, 3, 16),
(23, 'admin', 139, 5, 1, 5),
(25, 'admin', 142, 5, 1, 5);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `audios`
--
ALTER TABLE `audios`
  ADD KEY `id_lugar` (`id_lugar`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_comentario` (`id_comentario`),
  ADD KEY `id_lugar` (`id_lugar`);

--
-- Indices de la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD KEY `id_lugar` (`id_lugar`);

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD KEY `id_lugar` (`id_lugar`);

--
-- Indices de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  ADD PRIMARY KEY (`id_incidencia`),
  ADD KEY `id_incidencia` (`id_incidencia`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `lugares`
--
ALTER TABLE `lugares`
  ADD PRIMARY KEY (`id_lugar`),
  ADD KEY `id_lugar` (`id_lugar`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `nick` (`id_usuario`);

--
-- Indices de la tabla `usuarios_lugares`
--
ALTER TABLE `usuarios_lugares`
  ADD KEY `id_usuario` (`id_usuario`,`id_lugar`),
  ADD KEY `id_lugar` (`id_lugar`);

--
-- Indices de la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  ADD PRIMARY KEY (`id_valoracion`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_lugar` (`id_lugar`),
  ADD KEY `id_valoracion` (`id_valoracion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  MODIFY `id_incidencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `lugares`
--
ALTER TABLE `lugares`
  MODIFY `id_lugar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT de la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  MODIFY `id_valoracion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `audios`
--
ALTER TABLE `audios`
  ADD CONSTRAINT `audios_ibfk_1` FOREIGN KEY (`id_lugar`) REFERENCES `lugares` (`id_lugar`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`id_lugar`) REFERENCES `lugares` (`id_lugar`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD CONSTRAINT `documentos_ibfk_1` FOREIGN KEY (`id_lugar`) REFERENCES `lugares` (`id_lugar`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD CONSTRAINT `imagenes_ibfk_1` FOREIGN KEY (`id_lugar`) REFERENCES `lugares` (`id_lugar`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `incidencias`
--
ALTER TABLE `incidencias`
  ADD CONSTRAINT `incidencias_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios_lugares`
--
ALTER TABLE `usuarios_lugares`
  ADD CONSTRAINT `usuarios_lugares_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_lugares_ibfk_2` FOREIGN KEY (`id_lugar`) REFERENCES `lugares` (`id_lugar`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  ADD CONSTRAINT `valoraciones_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `valoraciones_ibfk_2` FOREIGN KEY (`id_lugar`) REFERENCES `lugares` (`id_lugar`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
