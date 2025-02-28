-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-02-2025 a las 18:49:20
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ecodriveplus`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beneficios`
--

CREATE TABLE `beneficios` (
  `id` int(11) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `sede` varchar(255) DEFAULT NULL,
  `dias` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `beneficios`
--

INSERT INTO `beneficios` (`id`, `imagen`, `titulo`, `descripcion`, `sede`, `dias`, `created_at`) VALUES
(1, 'uploads/beneficios/1740469507_b2d3226090a276d98c74.jpg', 'Cena Santorini', '1 club sandwich + 2 americanos a S/45.90', 'Fátima', 'Martes', '2025-02-23 06:17:54'),
(2, 'uploads/beneficios/1740293267_088ace6ca16a03dc8a48.jpg', 'Almuerzo Decatta', 'Menú ejecutivo completo a S/35.90', 'Central', 'Martes', '2025-02-23 06:17:54'),
(3, 'uploads/beneficios/1740293348_ec1fcbc59c7b41ea7dcb.jpg', 'Desayuno Vital', '2x1 en desayunos americanos', 'Miraflores', 'Miércoles', '2025-02-23 06:17:54'),
(4, 'uploads/beneficios/1740293392_d6d01c6be2b4b76a3210.jpg', 'Merienda Saludable', 'Batido de frutas + ensalada a S/20.00', 'San Isidro', 'Viernes', '2025-02-23 06:17:54'),
(5, 'uploads/beneficios/1740381853_6380a5a68f69c8935956.jpg', 'Combo Fitness', 'Ensalada César + jugo natural a S/25.90', 'Surco', 'Domingo', '2025-02-23 06:17:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `multimedia`
--

CREATE TABLE `multimedia` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `subtitulo` varchar(255) NOT NULL,
  `detalle` varchar(255) NOT NULL,
  `nota` varchar(500) NOT NULL,
  `fecha` date NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `multimedia`
--

INSERT INTO `multimedia` (`id`, `titulo`, `subtitulo`, `detalle`, `nota`, `fecha`, `imagen`, `created_at`) VALUES
(1, 'Evento de Tecnología', 'Conferencia Anual', 'Últimas tendencias en IA y Blockchain', 'No olvides traer tu entrada', '2025-03-10', 'uploads/multimedia/1740466345_5af3bc55797ee93eb5c5.jpeg', '2025-02-25 06:26:24'),
(2, 'Lanzamiento de Producto', 'Nuevo Smartphone', 'Presentación oficial del modelo X', 'Reservas disponibles desde hoy', '2025-04-05', 'uploads/multimedia/1740465131_c994b210ba50883405b8.jpg', '2025-02-25 06:26:24'),
(3, 'Concierto de Rock', 'Banda Legendaria', 'Concierto exclusivo en la ciudad', 'Entradas limitadas', '2025-05-15', 'uploads/multimedia/1740465182_8dbd51012e8f6b4f72e4.jpg', '2025-02-25 06:26:24'),
(4, 'Festival Gastronómico', 'Sabores del Mundo', 'Degustación de comida internacional', 'Se requiere registro previo', '2025-06-20', 'uploads/multimedia/1740465254_37e90ff0f933132023cf.jpeg', '2025-02-25 06:26:24'),
(5, 'Exposición de Arte', 'Galería de Innovación', 'Muestras de artistas emergentes', 'Entrada gratuita para estudiantes', '2025-07-12', 'uploads/multimedia/1740465292_ed770c0db4c4770509b8.jpg', '2025-02-25 06:26:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participantes`
--

CREATE TABLE `participantes` (
  `id` int(11) NOT NULL,
  `nombre_completo` varchar(255) NOT NULL,
  `dni` varchar(20) DEFAULT NULL,
  `numero` varchar(20) NOT NULL,
  `tipo` enum('conductor','pasajero') NOT NULL,
  `correo` varchar(255) NOT NULL,
  `puntaje` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `participantes`
--

INSERT INTO `participantes` (`id`, `nombre_completo`, `dni`, `numero`, `tipo`, `correo`, `puntaje`, `created_at`) VALUES
(1, 'Jorge Noriega', '12345678', '987654321', 'conductor', 'jorge.noriega@gmail.com', 0, '2025-02-22 09:08:20'),
(2, 'Carla Ramirez', '87654321', '956743821', 'pasajero', 'carla.ramirez@gmail.com', 0, '2025-02-22 09:08:20'),
(3, 'Mario Torres', '45612378', '934567890', 'conductor', 'mario.torres@gmail.com', 0, '2025-02-22 09:08:20'),
(4, 'Lucas Blas', '74185296', '912345678', 'conductor', 'lucas.blas@gmail.com', 0, '2025-02-22 09:08:20'),
(5, 'Maricarmen Saenz', '36925814', '923456789', 'pasajero', 'mari.saenz@gmail.com', 0, '2025-02-22 09:08:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `premios`
--

CREATE TABLE `premios` (
  `id` int(11) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `tipo` enum('conductor','pasajero','gran premio') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `premios`
--

INSERT INTO `premios` (`id`, `imagen`, `titulo`, `descripcion`, `tipo`, `created_at`) VALUES
(1, 'uploads/premios/1740468623_f8d44c37a6c0d1bf90e5.jpg', 'Televisor 45', 'Ganaste un televisor LCD', 'conductor', '2025-02-22 08:26:05'),
(2, 'uploads/premios/1740214557_c44fab2174c033afcd4b.png', 'Auto Nuevo 2024', 'Participa y gana un auto último modelo con todas las comodidades.', 'pasajero', '2025-02-22 08:54:55'),
(3, 'uploads/premios/1740364042_d2ee4374dda525f60fda.jpg', 'Viaje Todo Pagado a Cancún', 'Gana un viaje de lujo con hospedaje y comida incluida.', 'gran premio', '2025-02-22 08:54:55'),
(4, 'uploads/premios/1740214771_ff513611195db8a16dca.jpg', 'Laptop Gamer MSI', 'Obtén una potente laptop gamer con gráficos de última generación.', 'pasajero', '2025-02-22 08:54:55'),
(8, 'uploads/premios/1740630537_887ad3ae7ae6c9c29651.jpeg', 'Cena Santorini', 'Cena Santorini', 'gran premio', '2025-02-27 04:28:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sorteos`
--

CREATE TABLE `sorteos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `tipo` enum('conductor','pasajero','gran_premio') NOT NULL,
  `fecha` date NOT NULL,
  `estado` enum('pendiente','realizado') DEFAULT 'pendiente',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sorteos`
--

INSERT INTO `sorteos` (`id`, `titulo`, `descripcion`, `tipo`, `fecha`, `estado`, `created_at`) VALUES
(9, 'Sorteo Conductores - Marzo', 'Sorteo exclusivo para conductores activos en la plataforma.', 'conductor', '2025-03-10', 'realizado', '2025-02-26 22:42:13'),
(10, 'Sorteo Pasajeros - Marzo', 'Sorteo especial para pasajeros frecuentes.', 'gran_premio', '2025-03-15', 'realizado', '2025-02-26 22:42:13'),
(11, 'Gran Sorteo Mensual', 'Premios especiales para conductores y pasajeros.', 'pasajero', '2025-03-20', 'pendiente', '2025-02-26 22:42:13'),
(12, 'Sorteo de hoy!!', 'Sorteo de hoy!!', 'gran_premio', '2025-03-07', 'realizado', '2025-02-27 05:09:48'),
(13, 'juju', 'nini', 'conductor', '2025-03-06', 'realizado', '2025-02-27 08:23:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sorteo_participantes`
--

CREATE TABLE `sorteo_participantes` (
  `id` int(11) NOT NULL,
  `sorteo_id` int(11) NOT NULL,
  `participante_id` int(11) NOT NULL,
  `premio_id` int(11) DEFAULT NULL,
  `es_ganador` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sorteo_participantes`
--

INSERT INTO `sorteo_participantes` (`id`, `sorteo_id`, `participante_id`, `premio_id`, `es_ganador`) VALUES
(60, 9, 1, NULL, 0),
(61, 9, 3, 1, 1),
(62, 10, 1, 8, 1),
(63, 10, 3, 3, 1),
(64, 13, 1, NULL, 0),
(65, 13, 3, 1, 1),
(66, 13, 4, NULL, 0),
(67, 12, 1, 3, 1),
(68, 12, 2, NULL, 0),
(69, 12, 4, 8, 1),
(70, 12, 5, NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_admin`
--

CREATE TABLE `usuarios_admin` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('admin','editor') NOT NULL DEFAULT 'editor',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios_admin`
--

INSERT INTO `usuarios_admin` (`id`, `nombre`, `email`, `password`, `rol`, `created_at`) VALUES
(1, 'Rodrigo Torres Pastor', 'rodrigofk@gmail.com', '$2y$10$vnN.4foRnOLAfx2nsUVD2u6E8MyTMUvCtUsCsuoWekfWSckeXOGre', 'admin', '2025-02-22 21:40:32'),
(2, 'María Gómez', 'maria.gomez@example.com', '$2y$10$a99BY5YPOhZvPtwpKrOlt.RF9qk6RpsK9InpA/iE776LhQtNNaKme', 'admin', '2025-02-22 22:12:21'),
(3, 'Carlos Ramírez', 'carlos.ramirez@example.com', '$2y$10$ZrRI0YAu518HoMP3VP/GfO68Qycvi2w1mYeHDBsWHkviuY/Vj.e0O', 'editor', '2025-02-22 22:12:41'),
(4, 'Ana Torres', 'ana.torres@example.com', '$2y$10$WJY9afH4sWamvuen.I3GEec.WNTXl1xCkY96VQQtKlLnopGX1Ua3O', 'editor', '2025-02-22 22:13:09'),
(5, 'Luis Castillo', 'luis.castillo@example.com', '$2y$10$H87XFACsX4DQ2wGhoa4Ceu75hpUorFAAAQg1LagnUsF5tzDID2Tcy', 'editor', '2025-02-22 22:13:32');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `beneficios`
--
ALTER TABLE `beneficios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `multimedia`
--
ALTER TABLE `multimedia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `participantes`
--
ALTER TABLE `participantes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD UNIQUE KEY `dni` (`dni`);

--
-- Indices de la tabla `premios`
--
ALTER TABLE `premios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sorteos`
--
ALTER TABLE `sorteos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sorteo_participantes`
--
ALTER TABLE `sorteo_participantes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sorteo_id` (`sorteo_id`),
  ADD KEY `participante_id` (`participante_id`),
  ADD KEY `premio_id` (`premio_id`);

--
-- Indices de la tabla `usuarios_admin`
--
ALTER TABLE `usuarios_admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `beneficios`
--
ALTER TABLE `beneficios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `multimedia`
--
ALTER TABLE `multimedia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `participantes`
--
ALTER TABLE `participantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `premios`
--
ALTER TABLE `premios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `sorteos`
--
ALTER TABLE `sorteos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `sorteo_participantes`
--
ALTER TABLE `sorteo_participantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de la tabla `usuarios_admin`
--
ALTER TABLE `usuarios_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `sorteo_participantes`
--
ALTER TABLE `sorteo_participantes`
  ADD CONSTRAINT `sorteo_participantes_ibfk_1` FOREIGN KEY (`sorteo_id`) REFERENCES `sorteos` (`id`),
  ADD CONSTRAINT `sorteo_participantes_ibfk_2` FOREIGN KEY (`participante_id`) REFERENCES `participantes` (`id`),
  ADD CONSTRAINT `sorteo_participantes_ibfk_3` FOREIGN KEY (`premio_id`) REFERENCES `premios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
