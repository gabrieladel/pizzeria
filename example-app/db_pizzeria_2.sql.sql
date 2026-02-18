-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-02-2026 a las 20:00:54
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
-- Base de datos: `db_pizzeria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(1, 'Pizzas'),
(2, 'Empanadas'),
(3, 'Bebidas'),
(4, 'Pizzas Clásicas'),
(5, 'Pizzas Especiales'),
(6, 'Bebidas'),
(7, 'Postres');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) UNSIGNED NOT NULL,
  `persona_id` int(11) UNSIGNED NOT NULL,
  `cuil` varchar(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `persona_id`, `cuil`, `created_at`) VALUES
(1, 3, '27309998881', '2026-02-13 20:48:17'),
(2, 7, NULL, '2026-02-17 16:54:26'),
(3, 8, NULL, '2026-02-17 19:40:49'),
(4, 9, NULL, '2026-02-18 00:25:58'),
(5, 10, NULL, '2026-02-18 00:29:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedidos`
--

CREATE TABLE `detalle_pedidos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pedido_id` bigint(20) UNSIGNED NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `detalle_pedidos`
--

INSERT INTO `detalle_pedidos` (`id`, `pedido_id`, `producto_id`, `cantidad`, `precio_unitario`, `subtotal`) VALUES
(5, 1, 34, 1, 8500.00, 8500.00),
(6, 7, 41, 10, 1100.00, 11000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pedido_id` bigint(20) UNSIGNED NOT NULL,
  `nro_factura` varchar(20) NOT NULL,
  `tipo_factura` enum('A','B','C') NOT NULL,
  `metodo_pago` varchar(50) NOT NULL,
  `iva` decimal(10,2) DEFAULT 0.00,
  `total_facturado` decimal(10,2) NOT NULL,
  `fecha_emision` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`id`, `pedido_id`, `nro_factura`, `tipo_factura`, `metodo_pago`, `iva`, `total_facturado`, `fecha_emision`) VALUES
(1, 1, '0001-00000001', 'B', 'Efectivo', 2373.00, 11300.00, '2026-02-13 21:18:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(21, '2014_10_12_000000_create_users_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cliente_id` int(11) UNSIGNED NOT NULL,
  `vendedor_id` int(11) UNSIGNED DEFAULT NULL,
  `fecha` datetime NOT NULL,
  `total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `estado` enum('pendiente','preparando','en camino','entregado','cancelado') DEFAULT 'pendiente',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `cliente_id`, `vendedor_id`, `fecha`, `total`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2026-02-13 18:18:06', 11300.00, 'entregado', '2026-02-13 21:18:06', '2026-02-13 21:18:06'),
(2, 2, 1, '2026-02-17 23:21:26', 8500.00, 'pendiente', '2026-02-18 02:21:26', '2026-02-18 02:21:26'),
(3, 2, 1, '2026-02-17 23:22:14', 8500.00, 'pendiente', '2026-02-18 02:22:14', '2026-02-18 02:22:14'),
(4, 2, 1, '2026-02-17 23:35:37', 9500.00, 'pendiente', '2026-02-18 02:35:37', '2026-02-18 02:35:37'),
(5, 3, 1, '2026-02-17 23:47:06', 8500.00, 'pendiente', '2026-02-18 02:47:06', '2026-02-18 02:47:06'),
(6, 3, 1, '2026-02-17 23:47:06', 2800.00, 'pendiente', '2026-02-18 02:47:06', '2026-02-18 02:47:06'),
(7, 2, 1, '2026-02-17 23:48:57', 11000.00, 'pendiente', '2026-02-18 02:48:57', '2026-02-18 02:48:57'),
(8, 3, 1, '2026-02-17 23:51:02', 7000.00, 'pendiente', '2026-02-18 02:51:02', '2026-02-18 02:51:02'),
(9, 5, 1, '2026-02-18 00:30:55', 9500.00, 'pendiente', '2026-02-18 03:30:55', '2026-02-18 03:30:55'),
(10, 5, 1, '2026-02-18 00:30:55', 2800.00, 'pendiente', '2026-02-18 03:30:55', '2026-02-18 03:30:55'),
(11, 5, 1, '2026-02-18 00:30:55', 1100.00, 'pendiente', '2026-02-18 03:30:55', '2026-02-18 03:30:55'),
(12, 5, 1, '2026-02-18 00:30:55', 4200.00, 'pendiente', '2026-02-18 03:30:55', '2026-02-18 03:30:55'),
(13, 3, 1, '2026-02-18 15:27:39', 2800.00, 'pendiente', '2026-02-18 18:27:39', '2026-02-18 18:27:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `telefono` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id`, `user_id`, `nombre`, `apellido`, `telefono`, `created_at`, `updated_at`) VALUES
(2, 9, 'Juan', 'Perez', '55667788', '2026-02-13 20:48:17', '2026-02-17 23:14:37'),
(3, 3, 'Maria', 'Gomez', '99001122', '2026-02-13 20:48:17', '2026-02-13 20:48:17'),
(7, 10, 'monica', 'jofre', '2281232323', '2026-02-17 16:54:26', '2026-02-17 23:14:37'),
(8, 12, 'Julia', 'diaz', '2494545454', '2026-02-17 19:40:49', '2026-02-17 19:40:49'),
(9, 13, 'mateo', 'arias', '2492343434', '2026-02-18 00:25:58', '2026-02-18 00:25:58'),
(10, 14, 'vanesa', 'lopez', '2494778899', '2026-02-18 00:29:31', '2026-02-18 00:29:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `precio` decimal(8,2) DEFAULT NULL,
  `imagen` varchar(250) DEFAULT NULL,
  `descripcion` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `categoria_id`, `nombre`, `precio`, `imagen`, `descripcion`) VALUES
(34, 1, 'Muzzarella Familiar', 8500.00, 'productos/muzafamiliar.jpg', '8 porciones, salsa artesanal'),
(35, 1, 'Especial con Jamón', 9500.00, 'productos/pizzajamon.jpg', 'Con morrones y aceitunas'),
(36, 2, 'Coca Cola 1.5L', 2800.00, 'productos/cocabotella.jpg', 'Línea clásica'),
(37, 1, 'Pizza Muzarella', 8500.00, 'productos/PizzaMuzzarella.jpg', 'Salsa de tomate, abundante muzarella, aceitunas y orégano.'),
(38, 4, 'Pizza Fugazzetta', 9200.00, 'productos/PizzaFugazzetta.jpg\r\n', 'Doble masa rellena con queso y cubierta con mucha cebolla blanca.'),
(39, 5, 'Pizza Calabresa', 11000.00, 'productos/calabresa.jpg', 'Muzarella, rodajas de salame tipo calabrés y un toque de picante.'),
(40, 2, 'Empanada de Carne', 1200.00, 'productos/empanadadeCarne.jpg', 'Carne cortada a cuchillo, cebolla de verdeo y huevo duro.'),
(41, 2, 'Empanada de Jamón y Queso', 1100.00, 'productos/empanadajyq.jpg', 'Cremoso queso derretido con trozos de jamón cocido de primera.'),
(42, 3, 'Coca Cola lata', 3500.00, 'productos/cocalata.jpg', 'Bebida cola original, tamaño ideal para compartir.'),
(43, 6, 'Cerveza Quilmes 1L', 4200.00, 'productos/cerveza.jpg', 'Cerveza clásica argentina, bien helada.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nombre_rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `roles` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `roles`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Pizzeria', 'admin@pizza.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, '2026-02-13 20:48:17', NULL),
(2, 'Juan Vendedor', 'juan@pizza.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, '2026-02-13 20:48:17', NULL),
(3, 'Maria Cliente', 'maria@cliente.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, '2026-02-13 20:48:17', NULL),
(9, 'Juan Perez', 'juan.vendedor@pizzeria.com', NULL, 'hash_password_456', 'vendedor', NULL, NULL, NULL),
(10, 'Monica', 'monicagjofre@gmail.com', NULL, '$2y$10$VonQ9FWXf1/./n0lrHPPMunHxkh57ZH4U/DjsCkFWRYysGvNBwfHm', 'admin', NULL, '2026-02-14 00:55:25', '2026-02-14 00:55:25'),
(12, 'Julia', 'julia@gmail.com', NULL, '$2y$10$1aAJq3wPnkB/X7xbXzQxPu.x69OgLw5UMflRgnvLbB9gk74qaQ7Hm', 'cliente', NULL, '2026-02-17 22:40:49', '2026-02-17 22:40:49'),
(13, 'mateo', 'mateo@gmail.com', NULL, '$2y$10$upzdAuvafdDJXBAOZZD7XO4SRyxtN96WxXO2hMBz8P/667B3q6BbK', 'cliente', NULL, '2026-02-18 03:25:58', '2026-02-18 03:25:58'),
(14, 'vanesa', 'vanesa@gmail.com', NULL, '$2y$10$GNPApC0yHgCd9hREjs.qbeGfWCLrKPeFGJ9nYOzmh5zXMmxXyTZb.', 'cliente', NULL, '2026-02-18 03:29:31', '2026-02-18 03:29:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendedores`
--

CREATE TABLE `vendedores` (
  `id` int(11) UNSIGNED NOT NULL,
  `persona_id` int(11) UNSIGNED NOT NULL,
  `legajo` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `vendedores`
--

INSERT INTO `vendedores` (`id`, `persona_id`, `legajo`, `created_at`) VALUES
(1, 2, 'LEG-001', '2026-02-13 20:48:17');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `persona_id` (`persona_id`);

--
-- Indices de la tabla `detalle_pedidos`
--
ALTER TABLE `detalle_pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedido_id` (`pedido_id`),
  ADD KEY `fk_detalle_producto` (`producto_id`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pedido_id` (`pedido_id`),
  ADD UNIQUE KEY `nro_factura` (`nro_factura`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `vendedor_id` (`vendedor_id`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `roles` (`roles`),
  ADD KEY `roles_2` (`roles`);

--
-- Indices de la tabla `vendedores`
--
ALTER TABLE `vendedores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `persona_id` (`persona_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `detalle_pedidos`
--
ALTER TABLE `detalle_pedidos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `vendedores`
--
ALTER TABLE `vendedores`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `detalle_pedidos`
--
ALTER TABLE `detalle_pedidos`
  ADD CONSTRAINT `detalle_pedidos_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_detalle_producto` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `facturas_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`vendedor_id`) REFERENCES `vendedores` (`id`);

--
-- Filtros para la tabla `personas`
--
ALTER TABLE `personas`
  ADD CONSTRAINT `personas_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);

--
-- Filtros para la tabla `vendedores`
--
ALTER TABLE `vendedores`
  ADD CONSTRAINT `vendedores_ibfk_1` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
