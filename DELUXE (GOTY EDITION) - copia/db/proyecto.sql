-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-11-2024 a las 04:57:27
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `id` int(11) NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`id`, `nombre_usuario`, `password`, `email`) VALUES
(1, 'Jacqueline', '$2y$10$5VRwjUCdht2ycBWvi5hEuuybYX3AzfUWqoAapEFrCmhvuCusc0PUy', 'Admin@gmail.com'),
(2, 'Admin', '$2y$10$DNKL0DoNbRzmYBOtPOcU.etHqB1G6p3usw4ZOGy3Z22hbI7EObJ2G', 'Administrar@gmail.com'),
(3, 'Admin', '$2y$10$a79Ts0ayZ3RRB4k9u33TBu.0WZAjvfhgJ7IFQ7CV2sf1kjAZK6mUy', 'admin2@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tipo_usuario` enum('administrador','usuario') DEFAULT 'usuario',
  `activo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `tipo_usuario`, `activo`) VALUES
(1, 'Alan', 'user1@gmail.com', '$2y$10$//bEMyv6g7bcgkVLqHpdheW8PfXENe0yaYVUnjisexObIkEM5z4BC', NULL, 0),
(2, 'madhya', 'madhyacumbalaya@gmail.com', '$2y$10$SDZM3ThJ/jmz1mNBsT5.F.nSTu49FtcneoImlBiXDcyhHhgQa6QxW', NULL, 1),
(3, 'prueba1', 'prueba1@gmail.com', '$2y$10$BryE9BaRt2IFyfb3NGb5.Ocn69LLsY/aHQkC7G0dIXu2FufNRzQ0u', 'usuario', 1),
(4, 'user2', 'user2@gmail.com', '$2y$10$cdh3uenaV5pjeyhQecfQaO0e7DNWsHnWAotoJGtOvOgDHtRNiqGVG', 'usuario', 1),
(5, 'Juanita', 'Juanita@gmail.com', '$2y$10$3RpGA93330me88NzTgsc8OpVSoByhx42Ye/5gWpXhep0BY/wbLJC6', 'usuario', 1),
(6, 'user3', 'user3@gmail.com', '$2y$10$WQJaR7psTXd.Oy6oHYl.S.7Kxlj/QUjTnDlQy3zUpmZch0Uyj2vnW', 'usuario', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
