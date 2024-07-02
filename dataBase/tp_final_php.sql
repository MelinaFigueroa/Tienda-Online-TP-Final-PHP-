-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-07-2024 a las 04:26:58
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
-- Base de datos: `tp_final_php`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Otoño'),
(2, 'Invierno'),
(3, 'Primavera'),
(4, 'Verano'),
(5, 'Outlet/Ofertas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `product_id`, `quantity`, `order_date`) VALUES
(1, 1, 2, 1, '2024-06-21 01:22:24'),
(2, 1, 2, 4, '2024-06-21 01:25:05'),
(3, 1, 2, 10, '2024-06-21 03:07:34'),
(4, 1, 2, 2, '2024-06-23 20:01:55'),
(5, 1, 2, 6, '2024-06-23 20:21:42'),
(6, 1, 2, 6, '2024-06-24 21:28:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image_url` varchar(255) DEFAULT NULL,
  `categories` enum('Otoño','Invierno','Primavera','Verano','Outlet/Ofertas') NOT NULL DEFAULT 'Otoño',
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `created_at`, `image_url`, `categories`, `category_id`, `user_id`) VALUES
(2, 'Jeans colección otoño', 'Todos los talles desde el 36 al 56', 15000.00, '2024-06-20 21:07:36', '../uploads/Jeans.jpg', 'Otoño', 1, 0),
(3, 'Camisas colección primavera', 'Todos los talles desde el xs al xxxl', 20000.00, '2024-06-23 19:19:47', '../uploads/Camisas.jpg', 'Otoño', 3, 0),
(4, 'Remeras colección verano', 'Todos los talles desde el xxs al xxxl', 8000.00, '2024-06-23 19:51:25', '../uploads/Remeras.jpg', 'Otoño', 4, 0),
(7, 'Remeras', 'Remeras en oferta', 5500.00, '2024-06-23 23:57:08', '../uploads/ofertas-remeras.jpg', 'Otoño', 5, 0),
(8, 'Campera de dama', 'Campera para invierno super abrigada ', 1500000.00, '2024-06-24 00:04:09', '../uploads/campera-invierno.jpg', 'Otoño', 2, 0),
(9, 'Gorritos y ponchitos', 'Gorritos y ponchitos super calentitos', 5000.00, '2024-06-24 12:18:49', '../uploads/gorritos-ponchitos-invierno.jpg', 'Otoño', 2, 0),
(10, 'Lentes de sol', 'Lentes de sol, no te quedes sin el tuyo!.', 10000.00, '2024-07-01 21:49:59', '../uploads/lentes-outlet.jpg', 'Otoño', 5, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'melina.figueroa.89@gmail.com', '$2y$10$xSUF9wLTo2wV17nDbpE1JOlyd2jqEKqHUnJQcSjqmGwk6OFR4hTYi'),
(26, 'hola-mundo.89@gmail.com', '$2y$10$lbj8AodtvBFciOfYImMzieYTAR29QWDGiI27eScGkxK6uHJM..Jd6');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
