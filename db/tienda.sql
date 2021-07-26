-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-08-2020 a las 21:02:53
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accesorios`
--

CREATE TABLE `accesorios` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `imagen` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `accesorios`
--

INSERT INTO `accesorios` (`id`, `name`, `price`, `imagen`) VALUES
(42, 'Toalla de gimnasio - Work Hard', 6.99, 'Toalla de gimnasio - Work Hard4.png'),
(43, 'Cinturon NEOPRENE - Black', 17.99, 'Cinturon NEOPRENE - Black361.png'),
(44, 'SmartWatch Monitor de frec. cardiaca Ubiq', 69.99, 'SmartWatch Monitor de frec. cardiaca Ubiq673.png'),
(45, 'Guantes para entrenamiento Fitness & Gym', 15.99, 'Guantes para entrenamiento Fitness & Gym747.png'),
(46, 'Ultra Grip Training Gloves - GRAY', 17.99, 'Ultra Grip Training Gloves - GRAY935.png'),
(47, 'Botella Shaker ARMY HYDRA - Green', 19.99, 'Botella Shaker ARMY HYDRA - Green350.png'),
(48, 'Botella Shaker Hydra - Black ', 14.99, 'Botella Shaker Hydra - Black 944.png'),
(51, 'Gorra Army - Flag Bearer Stealth Black', 14.99, 'Gorra Army - Flag Bearer Stealth Black120.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `name`, `email`) VALUES
(1, 'angel', '123456789', 'Angel Ciudad', 'angelcd7@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alimentos`
--

CREATE TABLE `alimentos` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `alimentos`
--

INSERT INTO `alimentos` (`id`, `name`, `price`, `imagen`) VALUES
(100, 'Zero Chips - Patatas fritas proteicas 25 g', 1.49, 'Zero Chips - Patatas fritas proteicas 25 g765.png'),
(101, 'Masa de pizza proteica 250 g', 5.99, 'Masa de pizza proteica 250 g35.png'),
(102, 'Protein Muesli 500 g Opportunity', 5.59, 'Protein Muesli 500 g Opportunity71.png'),
(103, 'Zero Shake Chocolate 250mL', 1.49, 'Zero Shake Chocolate 250mL664.png'),
(104, 'Barrita proteica Cookies&Cream Bajo en Azucares 12 x 60g ', 21.48, 'Barrita proteica Cookies&Cream Bajo en Azucares 12 x 60g 950.png'),
(105, '12 x Protein Snack Chocolate 30 g', 9.48, '12 x Protein Snack Chocolate 30 g131.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aminoacidos`
--

CREATE TABLE `aminoacidos` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `aminoacidos`
--

INSERT INTO `aminoacidos` (`id`, `name`, `price`, `imagen`) VALUES
(81, 'L-glutamina 150 g', 6.99, 'L-glutamina 150 g184.png'),
(82, 'Monohidrato de Creatina 700 g', 12.99, 'Monohidrato de Creatina 700 g937.png'),
(83, 'EAA - Essential Amino-Acids 30 dosis', 8.99, 'EAA - Essential Amino-Acids 30 dosis521.png'),
(84, 'BCAA Professional 150 g', 22.99, 'BCAA Professional 150 g346.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `caracteristica` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `username`, `password`, `name`) VALUES
(2, 'JulianPro', '35789', 'Julian Mess'),
(4, 'MiguelJ', 'qwerty', 'Miguel Hernández'),
(5, 'Juan', '123456', 'Juan Ciudad Berengüí');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `total` float NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`id`, `id_cliente`, `fecha`, `total`, `estado`) VALUES
(7, 2, '2020-08-29 09:16:20', 28.44, 0),
(9, 4, '2020-08-29 12:04:58', 28.44, 0),
(10, 2, '2020-08-29 13:07:56', 258.24, 0),
(11, 2, '2020-08-29 20:13:49', 59.98, 0),
(12, 5, '2020-08-29 20:37:45', 59.49, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `control`
--

CREATE TABLE `control` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `control`
--

INSERT INTO `control` (`id`, `name`, `price`, `imagen`) VALUES
(181, 'Extracto de Aloe Vera - Diuretico - 90 Cápsulas', 8.99, 'Extracto de Aloe Vera - Diuretico65.png'),
(182, 'Termogenico Garcinia Cambogia 1500 mg - 90 capsulas', 12.99, 'Termogenico Garcinia Cambogia 1500 mg - 90 capsulas561.png'),
(183, 'L-Carnitina 1500mg - 60 capsulas', 8.99, 'L-Carnitina 1500mg - 60 capsulas575.png'),
(184, 'Extracto de cafe verde 1200mg - 60 capsulas', 18.99, 'Extracto de cafe verde 1200mg - 60 capsulas698.png'),
(185, 'Cutgenic for Men - 90 capsulas', 21.99, 'Cutgenic for Men - 90 capsulas855.png'),
(186, 'Burn - 60 Caps', 14.99, 'Burn - 60 Caps563.png'),
(187, 'Te verde EGCG 600mg - 100 capsulas', 12.99, 'Te verde EGCG 600mg - 100 capsulas592.png'),
(188, 'Caffeine Professional 200mg - 90 capsulas', 17.99, 'Caffeine Professional 200mg - 90 capsulas702.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pantalones`
--

CREATE TABLE `pantalones` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `imagen` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pantalones`
--

INSERT INTO `pantalones` (`id`, `name`, `price`, `imagen`) VALUES
(21, 'Shorts X-Sense (M) - Kafue Green', 19.59, 'Shorts X-Sense - Kafue Green696.png'),
(22, 'Shorts X-Sense (M) - Kafue Earth', 16.19, 'Shorts X-Sense (M) - Kafue Earth652.png'),
(23, 'Leggings X-Spirit (M) - Ocean Blue', 22.99, 'Leggings X-Spirit (M) - Ocean Blue700.png'),
(24, 'Leggings X-Skin Malie (M) - Lune', 21, 'Leggings X-Skin Malie (M) - Lune300.png'),
(25, 'Pantalones joggers Field (H) - Gray', 43.99, 'Pantalones joggers Field (H) - Gray857.png'),
(26, 'Shorts X-College (H) - Felton Navy', 22.19, 'Shorts X-College (H) - Felton Navy638.png'),
(27, 'X-Cycle Short (H) - Shred Dark Grey', 50.99, 'X-Cycle Short (H) - Shred Dark Grey850.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_compra`
--

CREATE TABLE `productos_compra` (
  `id` int(11) NOT NULL,
  `id_compra` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos_compra`
--

INSERT INTO `productos_compra` (`id`, `id_compra`, `id_producto`, `cantidad`, `total`) VALUES
(20, 7, 105, 3, 9.48),
(23, 9, 105, 3, 9.48),
(24, 10, 81, 3, 6.99),
(25, 10, 184, 3, 18.99),
(26, 10, 22, 2, 16.19),
(27, 10, 61, 3, 19.99),
(28, 10, 146, 2, 31.99),
(29, 10, 123, 3, 7.99),
(30, 11, 65, 2, 29.99),
(31, 12, 167, 1, 59.49);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proteinas`
--

CREATE TABLE `proteinas` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proteinas`
--

INSERT INTO `proteinas` (`id`, `name`, `price`, `imagen`) VALUES
(60, 'Whey Prime 2kg', 34.99, 'Whey Prime 2kg446.png'),
(61, 'Whey PROFESSIONAL Series 900gr', 19.99, 'Whey PROFESSIONAL Series 900gr401.png'),
(62, 'Whey Organic 500gr', 14.99, 'Whey Organic 500gr49.png'),
(63, 'Whey Protein ZERO 750gr', 24.99, 'Whey Protein ZERO 750gr260.png'),
(64, 'Whey Protein PROZIS 25gr', 0.89, 'Whey Protein PROZIS 25gr376.png'),
(65, 'Whey Protein PROZIS 2kg', 29.99, 'Whey Protein PROZIS 2kg571.png'),
(66, 'XTREME Whey 5kg', 49.99, 'XTREME Whey 5kg749.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ropa`
--

CREATE TABLE `ropa` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `imagen` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ropa`
--

INSERT INTO `ropa` (`id`, `name`, `price`, `imagen`) VALUES
(140, 'Sujetador Deportivo X-Sense (M) - Grey', 17.99, 'Sujetador Deportivo X-Sense (M) - Grey433.png'),
(141, 'Top Crush Debbie (M) - Black', 24.99, 'Top Crush Debbie - Black629.png'),
(142, 'Camiseta sin mangas XRun Boston (M) - Ruby', 38.99, 'Camiseta sin mangas X-Run Boston - Ruby1.png'),
(143, 'Camiseta Army (H) - Unstoppable Khaki', 24.99, 'Camiseta Army - Unstoppable Khaki985.png'),
(144, 'Camiseta termica Peak (H) - Blue', 33.59, 'Camiseta termica Peak (H) - Blue48.png'),
(145, 'X-Cycle MTB SS Jersey (H) - Shred Blue', 32.99, 'X-Cycle MTB SS Jersey - Shred Blue345.png'),
(146, 'Top corto X-Skin Eniwa (M) - Black', 31.99, 'Top corto X-Skin Eniwa (M) - Black454.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vitaminas`
--

CREATE TABLE `vitaminas` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `vitaminas`
--

INSERT INTO `vitaminas` (`id`, `name`, `price`, `imagen`) VALUES
(122, 'Omega 3 - 90 capsulas blandas', 7.99, 'Omega 3 - 90 capsulas blandas984.png'),
(123, 'Vitamin B12 100mcg - 60 capsulas', 7.99, 'Vitamin B12 100mcg - 60 capsulas147.png'),
(124, 'Vitamin C 1000mg + Rose Hip 60 tabs', 8.99, 'Vitamin C 1000mg + Rose Hip 60 tabs108.png'),
(125, 'Multivitaminico PROZIS 200 caps', 19.99, 'Multivitaminico PROZIS 200 caps790.png'),
(126, 'Glucosamina Vegana - 60 caps', 12.99, 'Glucosamina Vegana - 60 caps178.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zapatillas`
--

CREATE TABLE `zapatillas` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `imagen` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `zapatillas`
--

INSERT INTO `zapatillas` (`id`, `name`, `price`, `imagen`) VALUES
(163, 'Sneakers DESTROYER - Neon Green', 84.99, 'Sneakers DESTROYER - Neon Green826.png'),
(164, 'Sneakers DESTROYER II - Orange', 63.19, 'Sneakers DESTROYER II - Orange161.png'),
(165, 'Sneakers DESTROYER II - White', 55.29, 'Sneakers DESTROYER II - White99.png'),
(166, 'Sneakers DESTROYER 2.0 - Super Black', 84.99, 'Sneakers DESTROYER 2.0 - Super Black437.png'),
(167, 'Sneakers SLAYER - White', 59.49, 'Sneakers SLAYER - White617.png'),
(168, 'Sneakers DESTROYER 2.0 - Super White', 84.99, 'Sneakers DESTROYER 2.0 - Super White330.png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `accesorios`
--
ALTER TABLE `accesorios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `alimentos`
--
ALTER TABLE `alimentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `aminoacidos`
--
ALTER TABLE `aminoacidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `control`
--
ALTER TABLE `control`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pantalones`
--
ALTER TABLE `pantalones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos_compra`
--
ALTER TABLE `productos_compra`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proteinas`
--
ALTER TABLE `proteinas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ropa`
--
ALTER TABLE `ropa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `vitaminas`
--
ALTER TABLE `vitaminas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `zapatillas`
--
ALTER TABLE `zapatillas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `accesorios`
--
ALTER TABLE `accesorios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `alimentos`
--
ALTER TABLE `alimentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT de la tabla `aminoacidos`
--
ALTER TABLE `aminoacidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `control`
--
ALTER TABLE `control`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190;

--
-- AUTO_INCREMENT de la tabla `pantalones`
--
ALTER TABLE `pantalones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `productos_compra`
--
ALTER TABLE `productos_compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `proteinas`
--
ALTER TABLE `proteinas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT de la tabla `ropa`
--
ALTER TABLE `ropa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT de la tabla `vitaminas`
--
ALTER TABLE `vitaminas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT de la tabla `zapatillas`
--
ALTER TABLE `zapatillas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
