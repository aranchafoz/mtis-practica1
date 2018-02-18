-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2018 at 09:09 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mtis_p1`
--

-- --------------------------------------------------------

--
-- Table structure for table `poblaciones`
--

CREATE TABLE `poblaciones` (
  `nombre` varchar(100) COLLATE utf8_bin NOT NULL,
  `provincia` varchar(100) COLLATE utf8_bin NOT NULL,
  `cp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `poblaciones`
--

INSERT INTO `poblaciones` (`nombre`, `provincia`, `cp`) VALUES
('Guardamar del Segura', 'Alicante', 3140),
('San Vicent del Raspeig', 'Alicante', 3690);

-- --------------------------------------------------------

--
-- Table structure for table `presupuestos`
--

CREATE TABLE `presupuestos` (
  `id` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `fechaPresupuesto` date NOT NULL,
  `referenciaProducto` varchar(250) COLLATE utf8_bin NOT NULL,
  `cantidadProducto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `presupuestos`
--

INSERT INTO `presupuestos` (`id`, `idCliente`, `fechaPresupuesto`, `referenciaProducto`, `cantidadProducto`) VALUES
(1, 23, '2012-01-04', 'FXCVH', 2),
(2, 44, '2012-04-04', 'fdsa', 4),
(3, 44, '2012-04-04', 'fdsa', 4),
(4, 2222, '2012-04-04', 'mnnbv', 9),
(5, 555, '2012-04-04', 'fghjmnbv', 8),
(6, 1, '2018-02-15', '1', 1),
(7, 44, '2018-02-23', 'NCJ5FK4', 53);

-- --------------------------------------------------------

--
-- Table structure for table `soap_keys`
--

CREATE TABLE `soap_keys` (
  `soapKey` varchar(250) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `soap_keys`
--

INSERT INTO `soap_keys` (`soapKey`) VALUES
('keysupersecretaeindescifrableasdfg'),
('qwerty'),
('XqAO7LXhsED4A8jlMQ83oCc0bSayP0j4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `poblaciones`
--
ALTER TABLE `poblaciones`
  ADD UNIQUE KEY `cp` (`cp`);

--
-- Indexes for table `presupuestos`
--
ALTER TABLE `presupuestos`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
