-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 07, 2018 at 02:01 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kejaport`
--

-- --------------------------------------------------------

--
-- Table structure for table `wards`
--

CREATE TABLE `wards` (
  `constituency_id` int(11),
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `ward` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wards`
--

INSERT INTO `wards` (`constituency_id`, `ward`) VALUES
(1, 'Kitisuru'),
(1, 'Parklands/Highridge'),
(1, 'Kangemi'),
(1, 'Karura'),
(1, 'Mountain View'),
(2, 'Kilimani'),
(2, 'Kawangware'),
(2, 'Gatina'),
(2, 'Kileleshwa'),
(2, 'Kabiro'),
(3, 'Mutu-ini'),
(3, 'Karen'),
(3, 'Ngando'),
(3, 'Riruta satellite'),
(3, 'Uthiru/Ruthimitu'),
(3, 'Waithaka'),
(4, 'Karen'),
(4, 'Nairobi West'),
(4, 'Nyayo Highrise'),
(4, 'South C'),
(5, 'Laini Saba'),
(5, 'Lindi'),
(5, 'Makina'),
(5, 'Woodley-Kenyatta Golf Course'),
(5, 'Sarang-ombe'),
(6, 'Githurai'),
(6, 'Kahawa West'),
(6, 'Zimmermann'),
(6, 'Roysambu'),
(6, 'Kahawa'),
(7, 'Clay City'),
(7, 'Mwiki'),
(7, 'Kasarani'),
(7, 'Njiru Shopping Centre'),
(7, 'Ruai'),
(7, 'Kakamega'),
(8, 'Babadogo'),
(8, 'Utalii'),
(8, 'Mathare North'),
(8, 'Lucky Summer'),
(8, 'Korogocho'),
(9, 'Imara Daima'),
(9, 'Kwa Njenga'),
(9, 'Kwa Reuben'),
(9, 'Pipeline'),
(9, 'Kware'),
(10, 'Kariobangi North'),
(10, 'Dandora Area I'),
(10, 'Dandora Area II'),
(10, 'Dandora Area III'),
(10, 'Dandora Area IV'),
(11, 'Kayole North'),
(11, 'Kayole NorthCentral'),
(11, 'Kayole South'),
(11, 'Komarock'),
(11, 'Chokaa'),
(11, ' Matopeni/Spring Valley'),
(12, 'Upper Savanna'),
(12, 'Lower Savanna'),
(12, 'Embakasi Constituency'),
(12, 'Utawala'),
(12, 'Mihango'),
(13, 'Umoja I'),
(13, 'Umoja II'),
(13, 'Mowlem'),
(13, ' Kariobangi South'),
(14, 'Maringo/Hamza'),
(14, 'Viwandani'),
(14, 'Harambee'),
(14, 'Makongeni'),
(15, 'Pumwani'),
(15, 'Eastleigh North'),
(15, 'Eastleigh South'),
(15, 'Airbase'),
(15, 'California'),
(16, 'Nairobi Central'),
(16, 'Ngara'),
(16, 'Pangani'),
(16, 'Ziwani/ Kariokor'),
(16, 'Landimawe'),
(17, 'Hospital'),
(17, 'Mabatini'),
(17, 'Huruma'),
(17, 'Ngei'),
(17, 'Mlango Kubwa'),
(17, 'Kiamaiko');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wards`
--
ALTER TABLE `wards`
  ADD KEY `constituency_id` (`constituency_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `wards`
--
ALTER TABLE `wards`
  ADD CONSTRAINT `wards_ibfk_1` FOREIGN KEY (`constituency_id`) REFERENCES `constituencies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
