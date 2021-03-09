-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2021 at 02:31 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id15090934_db_portfolio`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id_brand` int(50) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id_brand`, `name`) VALUES
(2, 'Audi'),
(1, 'BMW'),
(3, 'Nissan'),
(5, 'Porsche'),
(4, 'Toyota');

-- --------------------------------------------------------

--
-- Table structure for table `fuel_type`
--

CREATE TABLE `fuel_type` (
  `id_fuel_type` int(5) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fuel_type`
--

INSERT INTO `fuel_type` (`id_fuel_type`, `name`) VALUES
(2, 'diesel'),
(4, 'electric'),
(3, 'hybrid'),
(1, 'petrol');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(50) NOT NULL,
  `path` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `path`, `title`) VALUES
(1, 'index.php?page=home', 'HOME'),
(2, 'index.php?page=vehicles', 'BROWSE VEHICLES');

-- --------------------------------------------------------

--
-- Table structure for table `rental_car`
--

CREATE TABLE `rental_car` (
  `id_rent` int(255) NOT NULL,
  `id_vehicle` int(255) NOT NULL,
  `id_user` int(255) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `rent_price` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rental_car`
--

INSERT INTO `rental_car` (`id_rent`, `id_vehicle`, `id_user`, `start_date`, `end_date`, `rent_price`) VALUES
(2, 4, 8, '2021-03-25 00:00:00', '2021-03-27 00:00:00', '90.00'),
(3, 4, 7, '2021-03-09 00:00:00', '2021-03-13 00:00:00', '171.00'),
(4, 4, 7, '2021-03-21 00:00:00', '2021-03-27 00:00:00', '256.50'),
(5, 4, 7, '2021-03-01 00:00:00', '2021-03-06 00:00:00', '213.75'),
(6, 4, 7, '2021-03-14 00:00:00', '2021-03-31 00:00:00', '726.75'),
(7, 2, 4, '2021-03-16 00:00:00', '2021-03-18 00:00:00', '88.00'),
(8, 2, 4, '2021-03-11 00:00:00', '2021-03-20 00:00:00', '376.20'),
(9, 2, 4, '2021-03-10 00:00:00', '2021-03-30 00:00:00', '836.00');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id_role` int(5) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id_role`, `name`) VALUES
(1, 'admin'),
(2, 'customer'),
(3, 'VIP customer');

-- --------------------------------------------------------

--
-- Table structure for table `social_media`
--

CREATE TABLE `social_media` (
  `id_social_media` int(50) NOT NULL,
  `icon` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(150) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `social_media`
--

INSERT INTO `social_media` (`id_social_media`, `icon`, `path`) VALUES
(1, '<i class=\"fab fa-instagram\"></i>', 'https://www.instagram.com/'),
(2, '<i class=\"fab fa-facebook\"></i>', 'https://www.facebook.com/'),
(3, '<i class=\"fab fa-linkedin-in\"></i>', 'https://www.linkedin.com/in/anjat99/'),
(4, '<i class=\"fab fa-github\"></i>', 'https://github.com/anjat99');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(255) NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `register_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_role` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `name`, `surname`, `username`, `email`, `password`, `phone_number`, `register_date`, `id_role`) VALUES
(1, 'Anja', 'Tomić', 'admin4rent', 'anja.tomic099@gmail.com', '80c784135d488ec71b0d24305975ba89', '+381606683073', '2021-03-08 14:22:39', 1),
(3, 'Zika', 'Mikic', 'zikam123', 'zikamikic@gmail.com', 'f1dc735ee3581693489eaf286088b916', '+3856845682', '2021-03-08 17:30:52', 2),
(4, 'Mikaa', 'Zikic', 'mikaz123', 'mikazikic@gmail.com', 'f1dc735ee3581693489eaf286088b916', '+38694857156', '2021-03-08 17:31:47', 2),
(7, 'Pera', 'Peric', 'pera123', 'pera@gmail.com', 'f1dc735ee3581693489eaf286088b916', '+3816071881486', '2021-03-08 17:34:41', 3),
(8, 'Someones', 'New', 'someone123', 'someone@gmail.com', 'f1dc735ee3581693489eaf286088b916', '+3816584579856', '2021-03-08 17:35:27', 2);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `id_vehicle` int(255) NOT NULL,
  `model` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `id_type` int(5) NOT NULL,
  `id_brand` int(50) NOT NULL,
  `id_fuel_type` int(5) NOT NULL,
  `construction_year` year(4) NOT NULL,
  `number_seats` int(4) NOT NULL,
  `price_per_day` decimal(6,2) NOT NULL,
  `available` int(10) NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`id_vehicle`, `model`, `id_type`, `id_brand`, `id_fuel_type`, `construction_year`, `number_seats`, `price_per_day`, `available`, `picture`) VALUES
(1, 'Nissan Roguiii', 5, 3, 3, 2019, 5, '50.00', 5, 'assets/images/nissan_rogue2018.jpg'),
(2, 'BMW 5 Seriess', 1, 1, 2, 2017, 5, '44.00', 0, 'assets/images/bmw_5serie2018.jpg'),
(4, 'Rogue', 2, 4, 4, 2021, 4, '50.00', 1, 'assets/images/bmw_5serie.jpg'),
(5, 'Audi Q8', 3, 2, 4, 2022, 5, '65.00', 2, 'assets/images/audi_q82021.jpg'),
(6, 'ModelSome', 2, 2, 4, 2019, 2, '32.00', 3, 'assets/images/1610635534titanic.jpg'),
(7, 'Some model', 2, 3, 3, 2023, 5, '40.00', 4, 'assets/images/1614208553cover.jpg'),
(8, 'Toyota Avalon', 3, 4, 3, 2021, 5, '80.00', 2, 'assets/images/2021_toyota_avalon.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_type`
--

CREATE TABLE `vehicle_type` (
  `id_type` int(5) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vehicle_type`
--

INSERT INTO `vehicle_type` (`id_type`, `name`) VALUES
(5, 'cargo'),
(1, 'economy'),
(2, 'estate'),
(3, 'luxury'),
(4, 'SUV');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id_brand`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `fuel_type`
--
ALTER TABLE `fuel_type`
  ADD PRIMARY KEY (`id_fuel_type`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `rental_car`
--
ALTER TABLE `rental_car`
  ADD PRIMARY KEY (`id_rent`),
  ADD KEY `id_vehicle` (`id_vehicle`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `social_media`
--
ALTER TABLE `social_media`
  ADD PRIMARY KEY (`id_social_media`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_role` (`id_role`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`id_vehicle`),
  ADD KEY `id_type` (`id_type`),
  ADD KEY `id_brand` (`id_brand`),
  ADD KEY `id_fuel_type` (`id_fuel_type`);

--
-- Indexes for table `vehicle_type`
--
ALTER TABLE `vehicle_type`
  ADD PRIMARY KEY (`id_type`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id_brand` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `fuel_type`
--
ALTER TABLE `fuel_type`
  MODIFY `id_fuel_type` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rental_car`
--
ALTER TABLE `rental_car`
  MODIFY `id_rent` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `social_media`
--
ALTER TABLE `social_media`
  MODIFY `id_social_media` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `id_vehicle` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `vehicle_type`
--
ALTER TABLE `vehicle_type`
  MODIFY `id_type` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rental_car`
--
ALTER TABLE `rental_car`
  ADD CONSTRAINT `rental_car_ibfk_1` FOREIGN KEY (`id_vehicle`) REFERENCES `vehicle` (`id_vehicle`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rental_car_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD CONSTRAINT `vehicle_ibfk_1` FOREIGN KEY (`id_type`) REFERENCES `vehicle_type` (`id_type`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vehicle_ibfk_2` FOREIGN KEY (`id_brand`) REFERENCES `brand` (`id_brand`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vehicle_ibfk_3` FOREIGN KEY (`id_fuel_type`) REFERENCES `fuel_type` (`id_fuel_type`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
