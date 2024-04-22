-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2023 at 09:33 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pr`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(255) NOT NULL,
  `SURNAME` varchar(255) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `ADDRESS` varchar(255) NOT NULL,
  `PHONE` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`ID`, `NAME`, `SURNAME`, `EMAIL`, `PASSWORD`, `ADDRESS`, `PHONE`) VALUES
(1, 'Jon', 'Jones', 'admin@adm.com', 'admin', 'there', '112');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(255) NOT NULL,
  `SURNAME` varchar(255) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `ADDRESS` varchar(255) DEFAULT NULL,
  `PHONE` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`ID`, `NAME`, `SURNAME`, `EMAIL`, `PASSWORD`, `ADDRESS`, `PHONE`) VALUES
(1, 'abd', 'ahm', 'abdahm@ktu.lt', 'admin', 'gricpiuo', '+37062139573'),
(123, 'John Doe', '', 'john@example.com', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(255) NOT NULL,
  `SURNAME` varchar(255) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `ADDRESS` varchar(255) NOT NULL,
  `PHONE` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`ID`, `NAME`, `SURNAME`, `EMAIL`, `PASSWORD`, `ADDRESS`, `PHONE`) VALUES
(1, 'Adam', 'Rami', 'adm@emp.com', 'admin', 'molas', '+3706177874');

-- --------------------------------------------------------

--
-- Table structure for table `orderpackages`
--

CREATE TABLE `orderpackages` (
  `OrderID` int(11) NOT NULL,
  `TravelPackageID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderpackages`
--

INSERT INTO `orderpackages` (`OrderID`, `TravelPackageID`) VALUES
(1, 5),
(49875, 1),
(49876, 1),
(49877, 1),
(49878, 1),
(49879, 1),
(49880, 1),
(49881, 1),
(49882, 1),
(49883, 1),
(49884, 2),
(49885, 4);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` int(11) NOT NULL,
  `CustomerID` int(11) DEFAULT NULL,
  `OrderDate` date DEFAULT NULL,
  `InvoiceNumber` varchar(50) NOT NULL,
  `status` varchar(255) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `CustomerID`, `OrderDate`, `InvoiceNumber`, `status`) VALUES
(1, 1, '2023-12-06', '9b85905f-93c8-11ee-9a92-34e6d706d9d5', 'pending'),
(49875, 1, '2023-12-06', '8456', 'pending'),
(49876, 1, '2023-12-06', '8504', 'pending'),
(49877, 1, '2023-12-06', '6756', 'pending'),
(49878, 1, '2023-12-06', '5387', 'pending'),
(49879, 1, '2023-12-06', '8440', 'pending'),
(49880, 1, '2023-12-06', '9928', 'condirmed'),
(49881, 1, '2023-12-06', '8644', 'Cancel request'),
(49882, 1, '2023-12-06', '8665', 'Cancel request'),
(49883, 1, '2023-12-06', '6336', 'Cancel request'),
(49884, 1, '2023-12-06', '7747', 'pending'),
(49885, 1, '2023-12-06', '3171', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `TravelPackageID` int(11) NOT NULL,
  `Destination` varchar(255) NOT NULL,
  `DepartureDate` date NOT NULL,
  `ReturnDate` date NOT NULL,
  `FlightDetails` varchar(255) NOT NULL,
  `AccommodationDetails` varchar(255) NOT NULL,
  `Price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`TravelPackageID`, `Destination`, `DepartureDate`, `ReturnDate`, `FlightDetails`, `AccommodationDetails`, `Price`) VALUES
(1, 'Paris, France', '2023-01-15', '2023-01-22', 'Airline: XYZ, Flight: ABC', 'Hotel: Example Hotel, Room: Suite', '1500.00'),
(2, 'Tokyo, Japan', '2023-02-10', '2023-02-18', 'Airline: DEF, Flight: 123', 'Ryokan: Sample Ryokan, Room: Standard', '2000.00'),
(3, 'Paris, France', '2024-01-05', '2024-01-12', 'Airline: ABC, Flight: 123', 'Hotel: Example Hotel, Room: Standard', '1200.00'),
(4, 'Nice, France', '2024-02-15', '2024-02-22', 'Airline: XYZ, Flight: 456', 'Hotel: Ocean View Resort, Room: Deluxe', '1500.00'),
(5, 'Marseille, France', '2024-03-10', '2024-03-17', 'Airline: DEF, Flight: 789', 'Hotel: City Center Inn, Room: Suite', '1300.00'),
(6, 'Tokyo, Japan', '2024-01-10', '2024-01-18', 'Airline: XYZ, Flight: ABC', 'Ryokan: Traditional Inn, Room: Tatami', '1800.00'),
(7, 'Osaka, Japan', '2024-02-20', '2024-02-28', 'Airline: DEF, Flight: 123', 'Hotel: Sakura Gardens, Room: Executive', '2000.00'),
(8, 'Kyoto, Japan', '2024-03-15', '2024-03-23', 'Airline: GHI, Flight: 456', 'Ryokan: Zen Retreat, Room: Zen Suite', '1900.00'),
(9, 'Rome, Italy', '2024-01-08', '2024-01-15', 'Airline: JKL, Flight: 789', 'Hotel: Historical Residency, Room: Classic', '1400.00'),
(10, 'Venice, Italy', '2024-02-18', '2024-02-25', 'Airline: MNO, Flight: 101', 'Hotel: Grand Canal Hotel, Room: Superior', '1600.00'),
(11, 'Florence, Italy', '2024-03-05', '2024-03-12', 'Airline: PQR, Flight: 112', 'Hotel: Tuscan Retreat, Room: Villa', '1500.00'),
(12, 'New York City, USA', '2024-01-12', '2024-01-19', 'Airline: ABC, Flight: 123', 'Hotel: Times Square Hotel, Room: City View', '2000.00'),
(13, 'Los Angeles, USA', '2024-02-22', '2024-02-29', 'Airline: XYZ, Flight: 456', 'Hotel: Hollywood Hills Resort, Room: Executive Suite', '2200.00'),
(14, 'Miami, USA', '2024-03-18', '2024-03-25', 'Airline: DEF, Flight: 789', 'Resort: Oceanfront Paradise, Room: Beach Villa', '2100.00'),
(15, 'London, UK', '2024-01-15', '2024-01-22', 'Airline: XYZ, Flight: ABC', 'Hotel: Royal Palace Hotel, Room: Deluxe', '1700.00'),
(16, 'Edinburgh, UK', '2024-02-25', '2024-03-03', 'Airline: DEF, Flight: 123', 'Hotel: Highland Retreat, Room: Castle View', '1900.00'),
(17, 'Manchester, UK', '2024-03-10', '2024-03-17', 'Airline: GHI, Flight: 456', 'Hotel: Urban Oasis, Room: City Loft', '1800.00'),
(18, 'Barcelona, Spain', '2024-01-20', '2024-01-27', 'Airline: JKL, Flight: 789', 'Hotel: Mediterranean Resort, Room: Sea View', '1600.00'),
(19, 'Madrid, Spain', '2024-02-28', '2024-03-06', 'Airline: MNO, Flight: 101', 'Hotel: Royal Palace Inn, Room: Superior', '1800.00'),
(20, 'Seville, Spain', '2024-03-15', '2024-03-22', 'Airline: PQR, Flight: 112', 'Hotel: Flamenco Paradise, Room: Suite', '1700.00'),
(21, 'Berlin, Germany', '2024-01-22', '2024-01-29', 'Airline: ABC, Flight: 123', 'Hotel: Brandenburg Hotel, Room: Executive', '1900.00'),
(22, 'Munich, Germany', '2024-02-29', '2024-03-07', 'Airline: XYZ, Flight: 456', 'Hotel: Bavarian Retreat, Room: Alpine Suite', '2100.00'),
(23, 'Hamburg, Germany', '2024-03-20', '2024-03-27', 'Airline: DEF, Flight: 789', 'Hotel: Port City Inn, Room: Harbor View', '2000.00'),
(24, 'Sydney, Australia', '2024-01-25', '2024-02-01', 'Airline: JKL, Flight: 789', 'Hotel: Harbor View Hotel, Room: Ocean View', '2200.00'),
(25, 'Melbourne, Australia', '2024-02-05', '2024-02-12', 'Airline: MNO, Flight: 101', 'Apartment: City Skyline Residences, Unit: Penthouse', '2500.00'),
(26, 'Brisbane, Australia', '2024-03-20', '2024-03-28', 'Airline: PQR, Flight: 112', 'Resort: Tropical Oasis, Room: Beachfront Villa', '2300.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `EMAIL` (`EMAIL`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `orderpackages`
--
ALTER TABLE `orderpackages`
  ADD PRIMARY KEY (`OrderID`,`TravelPackageID`),
  ADD KEY `TravelPackageID` (`TravelPackageID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `CustomerID` (`CustomerID`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`TravelPackageID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49886;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `TravelPackageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orderpackages`
--
ALTER TABLE `orderpackages`
  ADD CONSTRAINT `orderpackages_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`),
  ADD CONSTRAINT `orderpackages_ibfk_2` FOREIGN KEY (`TravelPackageID`) REFERENCES `packages` (`TravelPackageID`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `customers` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
