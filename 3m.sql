-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 03-06-2017 a las 12:54:54
-- Versión del servidor: 5.5.41-0ubuntu0.14.04.1
-- Versión de PHP: 5.5.9-1ubuntu4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `3m`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `columnas`
--

CREATE TABLE IF NOT EXISTS `columnas` (
  `id_project` int(11) NOT NULL,
  `nombre_columna` varchar(20) NOT NULL,
  `orden` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `columnas`
--

INSERT INTO `columnas` (`id_project`, `nombre_columna`, `orden`) VALUES
(1, 'Pendiente', 1),
(1, 'En proceso', 2),
(1, 'Terminado', 3),
(5, 'Pendiente', 1),
(5, 'En Proceso', 2),
(5, 'En revisión', 3),
(5, 'Terminado', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `columnas` int(11) NOT NULL,
  `color` varchar(6) NOT NULL,
  `estado` int(11) NOT NULL,
  `propietario` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `project`
--

INSERT INTO `project` (`id`, `nombre`, `descripcion`, `columnas`, `color`, `estado`, `propietario`) VALUES
(5, 'Taller 04', 'Crear web para metodología kanban', 4, '13A1AB', 1, 1),
(6, 'Test', 'test 01', 3, 'A5FF70', 1, 1),
(7, 'Test', 'test 01', 3, 'A5FF70', 1, 1),
(8, 'Test', 'test 01', 3, 'A5FF70', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarea`
--

CREATE TABLE IF NOT EXISTS `tarea` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_project` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `columna` int(11) NOT NULL,
  `propietario` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `tiempo` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `tarea`
--

INSERT INTO `tarea` (`id`, `id_project`, `nombre`, `descripcion`, `columna`, `propietario`, `estado`, `tiempo`) VALUES
(10, 5, 'Entrega informe', 'descripción y orden del informe', 1, 2, 1, 11.4),
(11, 5, 'presentación diagrama', 'presentación en clase ', 3, 3, 1, 1),
(12, 5, 'Modificar proyecto', 'Modificar el diseño del proyecto ', 4, 1, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(200) NOT NULL,
  `estado` int(1) NOT NULL,
  `perfil` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `estado`, `perfil`) VALUES
(1, 'mvillanueva', '202cb962ac59075b964b07152d234b70', 1, 1),
(2, 'mmaltez', '202cb962ac59075b964b07152d234b70', 1, 1),
(3, 'mserrano', '202cb962ac59075b964b07152d234b70', 1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
