-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2026 at 12:37 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sdc310_germany`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProductNo` int(11) NOT NULL,
  `ProductId` varchar(10) NOT NULL,
  `ProductName` varchar(50) NOT NULL,
  `ProductDescription` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=geostd8 COLLATE=geostd8_bin;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductNo`, `ProductId`, `ProductName`, `ProductDescription`) VALUES
(1, 'hcomb', 'Hot Comb', 'hotcomb that straightens hair'),
(3, 'mspray', 'Moisturizing Spray', 'hair moisturizer in spray bottle'),
(4, 'blkextensi', 'Braiding Hair', '14-inch human hair extension in color black'),
(5, 'combbrush', 'Comb & Brush Set', 'hair comb & brush set');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductNo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ProductNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
