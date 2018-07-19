-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-07-2018 a las 17:24:42
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

CREATE TABLE `documentos` (
  `id_lugar` int(11) NOT NULL,
  `url_doc` varchar(200) CHARACTER SET utf8 NOT NULL,
  `descripcion` varchar(300) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(100, '1Q0IeFO.jpg', ''),
(100, '1vPjZos.jpg', ''),
(100, '1yETTgX.jpg', ''),
(100, '2kca5Rj.jpg', ''),
(120, '0aXZGjx.jpg', ''),
(120, '1ioqWLq.jpg', '');

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
(5, 'Museo Nacional del Prado', 'museum', '40.4137818', '-3.6921270999999933', '00:00:00', '00:00:00', '', '', 0),
(6, 'Museo Reina SofÃ­a', 'museum', '40.4073281', '-3.694900200', '00:00:00', '00:00:00', '', '', 0),
(8, 'Museo Sorolla', 'museum', '40.4354363', '-3.692517299999963', '20:20:00', '21:21:00', 'lunes', 'asqawraerf', 0),
(76, 'Museo de Cera', 'museum', '40.4249581', '-3.691335200000026', '00:00:00', '00:00:00', '', '', 0),
(97, 'Museo De La Radio', 'bar', '40.4097375', '-3.7085617000000184', '00:00:00', '00:00:00', '', '', 0),
(100, 'Parque El Capricho', 'park', '40.456625', '-3.5989319999999907', '00:00:00', '00:00:00', '', '', 0),
(119, 'Museo Sorolla', 'museum', '40.4354363', '-3.692517299999963', '00:00:00', '00:00:00', '', 'Museo muy bonito', 0),
(120, 'Becerril de la Sierra', 'locality', '40.7102483', '-3.9954969000000347', '21:00:00', '22:00:00', 'L M X ', 'Pueblo de mierda', 0),
(121, 'Torrelodones', 'locality', '40.5766078', '-3.9293645999999853', '00:00:00', '00:00:00', '', '', 0),
(123, 'Puerta del Sol', 'monumento', '40.4169473', '-3.7035284999999476', '00:00:00', '23:59:00', '', 'Es muy bonita', 0),
(131, 'Museo Nacional del Prado', 'museum', '40.4137818', '-3.6921270999999933', '00:00:00', '00:00:00', 'L M X J V S D ', '', 0);

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
  `visitas` int(11) NOT NULL,
  `img_perfil` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellidos`, `password`, `email`, `comentarios`, `visitas`, `img_perfil`) VALUES
('david', 'David', 'Rodriguez', '827ccb0eea8a706c4c34a16891f84e7b', 'daviro05@ucm.es', 0, 0, 'vacio.png'),
('turista', 'Pedro', 'Martinez', 'fcea920f7412b5da7be0cf42b8c93759', 'pedroturista@ucm.es', 0, 0, 'vacio.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_lugares`
--

CREATE TABLE `usuarios_lugares` (
  `id_usuario` varchar(40) CHARACTER SET utf8 NOT NULL,
  `id_lugar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valoraciones`
--

CREATE TABLE `valoraciones` (
  `id_valoracion` int(11) NOT NULL,
  `id_usuario` varchar(40) CHARACTER SET utf8 NOT NULL,
  `id_lugar` int(11) NOT NULL,
  `valoracion` float NOT NULL,
  `num_valoraciones` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `valoraciones`
--

INSERT INTO `valoraciones` (`id_valoracion`, `id_usuario`, `id_lugar`, `valoracion`, `num_valoraciones`) VALUES
(7, 'david', 5, 2.65, 5);

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
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lugares`
--
ALTER TABLE `lugares`
  MODIFY `id_lugar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT de la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  MODIFY `id_valoracion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
