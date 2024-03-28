-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2024 at 02:39 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cars`
--
CREATE DATABASE IF NOT EXISTS `cars` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `cars`;

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

DROP TABLE IF EXISTS `cars`;
CREATE TABLE `cars` (
  `car_id` char(7) NOT NULL,
  `car_name` varchar(255) NOT NULL,
  `cylinders` int(255) NOT NULL,
  `horsepower` int(255) NOT NULL,
  `year` int(255) NOT NULL,
  `engine_type` varchar(255) NOT NULL,
  `car_make` varchar(255) NOT NULL,
  `car_model` varchar(255) NOT NULL,
  `is_fuel_economic` tinyint(1) NOT NULL,
  `owner_id` char(7) NOT NULL,
  `emission_id` char(7) NOT NULL,
  `consumption_id` char(8) NOT NULL,
  `deal_id` char(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`car_id`, `car_name`, `cylinders`, `horsepower`, `year`, `engine_type`, `car_make`, `car_model`, `is_fuel_economic`, `owner_id`, `emission_id`, `consumption_id`, `deal_id`) VALUES
('C-00001', 'Honda Accord', 4, 190, 2023, 'gas', 'Honda', 'Accord', 1, 'O-00001', 'E-00001', 'FC-00001', 'D-00001'),
('C-00002', 'Ford Mustang', 8, 450, 2022, 'electric', 'Ford', 'Mustang', 0, 'O-00002', 'E-00002', 'FC-00002', 'D-00002'),
('C-00003', 'Chevrolet Malibu', 4, 180, 2024, 'electric', 'Chevrolet', 'Malibu', 1, 'O-00003', 'E-00003', 'FC-00003', 'D-00003'),
('C-00004', 'Toyota Prius', 4, 120, 2023, 'gas', 'Toyota', 'Prius', 1, 'O-00004', 'E-00004', 'FC-00004', 'D-00004'),
('C-00005', 'BMW X5', 6, 300, 2022, 'gas', 'BMW', 'X5', 0, 'O-00005', 'E-00005', 'FC-00005', 'D-00005'),
('C-00006', 'Tesla Model 3', 0, 450, 2023, 'electric', 'Tesla', 'Model 3', 1, 'O-00006', 'E-00006', 'FC-00006', 'D-00006'),
('C-00007', 'Audi A4', 4, 220, 2024, 'gas', 'Audi', 'A4', 1, 'O-00007', 'E-00007', 'FC-00007', 'D-00007'),
('C-00008', 'Nissan Rogue', 4, 170, 2022, 'electric', 'Nissan', 'Rogue', 0, 'O-00008', 'E-00008', 'FC-00008', 'D-00008'),
('C-00009', 'Hyundai Sonata', 4, 200, 2023, 'electric', 'Hyundai', 'Sonata', 1, 'O-00009', 'E-00009', 'FC-00009', 'D-00009'),
('C-00010', 'Mercedes-Benz C-Class', 6, 300, 2022, 'gas', 'Mercedes-Benz', 'C-Class', 1, 'O-00010', 'E-00010', 'FC-00010', 'D-00010'),
('C-00011', 'Volkswagen Golf', 4, 150, 2024, 'gas', 'Volkswagen', 'Golf', 0, 'O-00011', 'E-00011', 'FC-00011', 'D-00011'),
('C-00012', 'Lexus RX', 6, 260, 2023, 'gas', 'Lexus', 'RX', 1, 'O-00012', 'E-00012', 'FC-00012', 'D-00012'),
('C-00013', 'Mazda CX-5', 4, 187, 2022, 'electric', 'Mazda', 'CX-5', 1, 'O-00013', 'E-00013', 'FC-00013', 'D-00013'),
('C-00014', 'Subaru Outback', 4, 182, 2024, 'gas', 'Subaru', 'Outback', 0, 'O-00014', 'E-00014', 'FC-00014', 'D-00014'),
('C-00015', 'Kia Telluride', 6, 291, 2023, 'electric', 'Kia', 'Telluride', 1, 'O-00015', 'E-00015', 'FC-00015', 'D-00015'),
('C-00016', 'Jaguar F-PACE', 6, 380, 2022, 'gas', 'Jaguar', 'F-PACE', 1, 'O-00016', 'E-00016', 'FC-00016', 'D-00016'),
('C-00017', 'Porsche 911', 0, 450, 2024, 'gas', 'Porsche', '911', 0, 'O-00017', 'E-00017', 'FC-00017', 'D-00017'),
('C-00018', 'Volvo XC90', 4, 250, 2023, 'electric', 'Volvo', 'XC90', 1, 'O-00018', 'E-00018', 'FC-00018', 'D-00018'),
('C-00019', 'Land Rover Range Rover', 8, 518, 2022, 'gas', 'Land Rover', 'Range Rover', 1, 'O-00019', 'E-00019', 'FC-00019', 'D-00019'),
('C-00020', 'Chrysler Pacifica', 6, 287, 2024, 'gas', 'Chrysler', 'Pacifica', 0, 'O-00020', 'E-00020', 'FC-00020', 'D-00020');

-- --------------------------------------------------------

--
-- Table structure for table `consumptions`
--

DROP TABLE IF EXISTS `consumptions`;
CREATE TABLE `consumptions` (
  `consumption_id` char(8) NOT NULL,
  `engine_size` int(255) NOT NULL,
  `fuel_consumption_city` float(255,2) NOT NULL,
  `fuel_consumption_hwy` float(255,2) NOT NULL,
  `fuel_consumption_combined` float(255,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `consumptions`
--

INSERT INTO `consumptions` (`consumption_id`, `engine_size`, `fuel_consumption_city`, `fuel_consumption_hwy`, `fuel_consumption_combined`) VALUES
('FC-00001', 2, 26.00, 30.00, 28.00),
('FC-00002', 2, 26.00, 30.00, 28.00),
('FC-00003', 4, 21.00, 26.00, 23.00),
('FC-00004', 2, 26.00, 30.00, 28.00),
('FC-00005', 4, 21.00, 26.00, 23.00),
('FC-00006', 2, 26.00, 30.00, 28.00),
('FC-00007', 4, 21.00, 26.00, 23.00),
('FC-00008', 2, 26.00, 30.00, 28.00),
('FC-00009', 4, 21.00, 26.00, 23.00),
('FC-00010', 2, 26.00, 30.00, 28.00),
('FC-00011', 4, 21.00, 26.00, 23.00),
('FC-00012', 2, 26.00, 30.00, 28.00),
('FC-00013', 4, 21.00, 26.00, 23.00),
('FC-00014', 2, 26.00, 30.00, 28.00),
('FC-00015', 4, 21.00, 26.00, 23.00),
('FC-00016', 2, 26.00, 30.00, 28.00),
('FC-00017', 4, 21.00, 26.00, 23.00),
('FC-00018', 2, 26.00, 30.00, 28.00),
('FC-00019', 4, 21.00, 26.00, 23.00),
('FC-00020', 2, 26.00, 30.00, 28.00);

-- --------------------------------------------------------

--
-- Table structure for table `deals`
--

DROP TABLE IF EXISTS `deals`;
CREATE TABLE `deals` (
  `deal_id` char(7) NOT NULL,
  `selling_price` float(255,2) NOT NULL,
  `km_driven` float(255,2) NOT NULL,
  `fuel_type` varchar(255) NOT NULL,
  `transmission` varchar(255) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `car_condition` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deals`
--

INSERT INTO `deals` (`deal_id`, `selling_price`, `km_driven`, `fuel_type`, `transmission`, `payment_type`, `car_condition`) VALUES
('D-00001', 25000.00, 50213.00, 'Gasoline', 'Automatic', 'Credit Card', 'Good'),
('D-00002', 19000.00, 70065.00, 'Diesel', 'Manual', 'Cash', 'Fair'),
('D-00003', 5000.00, 50213.00, 'Gasoline', 'Automatic', 'Credit Card', 'Good'),
('D-00004', 19000.00, 70065.00, 'Diesel', 'Manual', 'Cash', 'Fair'),
('D-00005', 45000.00, 300231.00, 'Hybrid', 'Automatic', 'Bank Transfer', 'Excellent'),
('D-00006', 65000.00, 50023.00, 'Gasoline', 'Automatic', 'Credit Card', 'Good'),
('D-00007', 21000.00, 70043.00, 'Diesel', 'Manual', 'Cash', 'Fair'),
('D-00008', 23000.00, 30021.00, 'Hybrid', 'Automatic', 'Bank Transfer', 'Excellent'),
('D-00009', 27000.00, 50010.00, 'Gasoline', 'Automatic', 'Credit Card', 'Good'),
('D-00010', 57000.00, 70200.00, 'Diesel', 'Manual', 'Cash', 'Fair'),
('D-00011', 90000.00, 30030.00, 'Hybrid', 'Automatic', 'Bank Transfer', 'Excellent'),
('D-00012', 12000.00, 50050.00, 'Gasoline', 'Automatic', 'Credit Card', 'Good'),
('D-00013', 13000.00, 72000.00, 'Diesel', 'Manual', 'Cash', 'Fair'),
('D-00014', 35000.00, 30500.00, 'Hybrid', 'Automatic', 'Bank Transfer', 'Excellent'),
('D-00015', 9000.00, 50200.00, 'Gasoline', 'Automatic', 'Credit Card', 'Good'),
('D-00016', 14000.00, 70030.00, 'Diesel', 'Manual', 'Cash', 'Fair'),
('D-00017', 100000.00, 20000.00, 'Hybrid', 'Automatic', 'Bank Transfer', 'Excellent'),
('D-00018', 32000.00, 10000.00, 'Gasoline', 'Automatic', 'Credit Card', 'Good'),
('D-00019', 46000.00, 7000.00, 'Diesel', 'Manual', 'Cash', 'Fair'),
('D-00020', 15000.00, 3000.00, 'Hybrid', 'Automatic', 'Bank Transfer', 'Excellent');

-- --------------------------------------------------------

--
-- Table structure for table `emissions`
--

DROP TABLE IF EXISTS `emissions`;
CREATE TABLE `emissions` (
  `emission_id` char(7) NOT NULL,
  `engine_size` float(255,2) NOT NULL,
  `cylinder_num` int(255) NOT NULL,
  `fuel_type` varchar(255) NOT NULL,
  `vehicle_class` varchar(255) NOT NULL,
  `co2_emission` float(255,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emissions`
--

INSERT INTO `emissions` (`emission_id`, `engine_size`, `cylinder_num`, `fuel_type`, `vehicle_class`, `co2_emission`) VALUES
('E-00001', 2.00, 4, 'Gasoline', 'Sedan', 150.00),
('E-00002', 4.00, 6, 'Diesel', 'SUV', 200.00),
('E-00003', 2.00, 4, 'Hybrid', 'Compact', 120.00),
('E-00004', 2.00, 4, 'Gasoline', 'Coupe', 400.00),
('E-00005', 4.00, 6, 'Diesel', 'SUV', 600.00),
('E-00006', 2.00, 4, 'Hybrid', 'Compact', 120.00),
('E-00007', 2.00, 4, 'Gasoline', 'Sedan', 150.00),
('E-00008', 4.00, 6, 'Diesel', 'Coupe', 700.00),
('E-00009', 2.00, 4, 'Hybrid', 'Compact', 120.00),
('E-00010', 2.00, 4, 'Gasoline', 'SUV', 275.00),
('E-00011', 4.00, 6, 'Diesel', 'SUV', 200.00),
('E-00012', 2.00, 4, 'Hybrid', 'Compact', 120.00),
('E-00013', 2.00, 4, 'Gasoline', 'Sedan', 150.00),
('E-00014', 4.00, 6, 'Diesel', 'SUV', 200.00),
('E-00015', 2.00, 4, 'Hybrid', 'Sedan', 300.00),
('E-00016', 2.00, 4, 'Gasoline', 'Sedan', 150.00),
('E-00017', 4.00, 6, 'Diesel', 'SUV', 200.00),
('E-00018', 2.00, 4, 'Hybrid', 'Compact', 120.00),
('E-00019', 2.00, 4, 'Gasoline', 'Compact', 175.00),
('E-00020', 4.00, 6, 'Diesel', 'SUV', 200.00);

-- --------------------------------------------------------

--
-- Table structure for table `insurances`
--

DROP TABLE IF EXISTS `insurances`;
CREATE TABLE `insurances` (
  `insurance_id` char(7) NOT NULL,
  `insurance_name` varchar(255) NOT NULL,
  `driving_experience` int(255) NOT NULL,
  `vehicle_year` int(255) NOT NULL,
  `vehicle_type` varchar(255) NOT NULL,
  `annual_mileage` int(255) NOT NULL,
  `price` float(255,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `insurances`
--

INSERT INTO `insurances` (`insurance_id`, `insurance_name`, `driving_experience`, `vehicle_year`, `vehicle_type`, `annual_mileage`, `price`) VALUES
('I-00001', 'ABC Insurance', 5, 2022, 'Sedan', 12000, 800.00),
('I-00002', 'XYZ Insurance', 3, 2019, 'SUV', 15000, 1000.00),
('I-00003', '123 Insurance', 7, 2021, 'Truck', 18000, 1200.00),
('I-00004', 'PQR Insurance', 2, 2023, 'Coupe', 10000, 700.00),
('I-00005', 'LMN Insurance', 4, 2020, 'Minivan', 20000, 1500.00),
('I-00006', 'DEF Insurance', 6, 2024, 'Convertible', 8000, 600.00),
('I-00007', 'JKL Insurance', 1, 2022, 'Hatchback', 13000, 900.00),
('I-00008', 'MNO Insurance', 8, 2018, 'Sedan', 16000, 1100.00),
('I-00009', 'UVW Insurance', 3, 2021, 'SUV', 14000, 950.00),
('I-00010', 'XYZ Insurance', 5, 2023, 'Truck', 17000, 1300.00),
('I-00011', 'ABC Insurance', 2, 2020, 'Coupe', 11000, 750.00),
('I-00012', 'PQR Insurance', 6, 2024, 'Minivan', 19000, 1400.00),
('I-00013', 'MNO Insurance', 4, 2021, 'Convertible', 9000, 650.00),
('I-00014', 'DEF Insurance', 1, 2019, 'Hatchback', 12000, 850.00),
('I-00015', 'LMN Insurance', 7, 2022, 'Sedan', 15000, 1050.00),
('I-00016', 'JKL Insurance', 3, 2023, 'SUV', 16000, 1150.00),
('I-00017', 'UVW Insurance', 5, 2018, 'Truck', 18000, 1350.00),
('I-00018', 'PQR Insurance', 2, 2020, 'Coupe', 10000, 700.00),
('I-00019', 'ABC Insurance', 8, 2024, 'Minivan', 22000, 1600.00),
('I-00020', 'XYZ Insurance', 4, 2021, 'Convertible', 12000, 900.00);

-- --------------------------------------------------------

--
-- Table structure for table `owners`
--

DROP TABLE IF EXISTS `owners`;
CREATE TABLE `owners` (
  `owner_id` char(7) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `postal_code` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `driver_age` int(255) NOT NULL,
  `driver_gender` varchar(255) NOT NULL,
  `insurance_id` char(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `owners`
--

INSERT INTO `owners` (`owner_id`, `name`, `email`, `postal_code`, `country`, `city`, `driver_age`, `driver_gender`, `insurance_id`) VALUES
('O-00001', 'John Doe', 'john.doe@example.com', '12345', 'USA', 'New York', 30, 'Male', 'I-00001'),
('O-00002', 'Jane Smith', 'jane.smith@example.com', '56789', 'Canada', 'Toronto', 25, 'Female', 'I-00002'),
('O-00003', 'Robert Johnson', 'robert.johnson@example.com', '98765', 'UK', 'London', 35, 'Male', 'I-00003'),
('O-00004', 'Emily White', 'emily.white@example.com', '54321', 'Australia', 'Sydney', 28, 'Female', 'I-00004'),
('O-00005', 'Michael Brown', 'michael.brown@example.com', '67890', 'Germany', 'Berlin', 32, 'Male', 'I-00005'),
('O-00006', 'Sophia Miller', 'sophia.miller@example.com', '45678', 'France', 'Paris', 27, 'Female', 'I-00006'),
('O-00007', 'David Wilson', 'david.wilson@example.com', '23456', 'Italy', 'Rome', 34, 'Male', 'I-00007'),
('O-00008', 'Olivia Davis', 'olivia.davis@example.com', '78901', 'Spain', 'Madrid', 29, 'Female', 'I-00008'),
('O-00009', 'William Smith', 'william.smith@example.com', '34567', 'Brazil', 'Rio de Janeiro', 31, 'Male', 'I-00009'),
('O-00010', 'Emma Colella', 'emma.colella@example.com', '89012', 'Italy', 'Napolitan', 20, 'Female', 'I-00010'),
('O-00011', 'James White', 'james.white@example.com', '65432', 'India', 'Mumbai', 33, 'Male', 'I-00011'),
('O-00012', 'Ava Martin', 'ava.martin@example.com', '10987', 'Russia', 'Moscow', 30, 'Female', 'I-00012'),
('O-00013', 'Liam Davis', 'liam.davis@example.com', '87654', 'South Africa', 'Cape Town', 28, 'Male', 'I-00013'),
('O-00014', 'Isabella Johnson', 'isabella.johnson@example.com', '54321', 'Mexico', 'Mexico City', 25, 'Female', 'I-00014'),
('O-00015', 'Mason Smith', 'mason.smith@example.com', '21098', 'Japan', 'Tokyo', 32, 'Male', 'I-00015'),
('O-00016', 'Sophia Wilson', 'sophia.wilson@example.com', '76543', 'South Korea', 'Seoul', 29, 'Female', 'I-00016'),
('O-00017', 'Logan Davis', 'logan.davis@example.com', '32109', 'Argentina', 'Buenos Aires', 31, 'Male', 'I-00017'),
('O-00018', 'Ava Miller', 'ava.miller@example.com', '89012', 'France', 'Paris', 28, 'Female', 'I-00018'),
('O-00019', 'Ethan Wilson', 'ethan.wilson@example.com', '65432', 'Germany', 'Berlin', 33, 'Male', 'I-00019'),
('O-00020', 'Olivia Davis', 'olivia.davis@example.com', '10987', 'Italy', 'Rome', 26, 'Female', 'I-00020');

-- --------------------------------------------------------

--
-- Table structure for table `violations`
--

DROP TABLE IF EXISTS `violations`;
CREATE TABLE `violations` (
  `violation_id` char(7) NOT NULL,
  `location` varchar(255) NOT NULL,
  `violation_type` varchar(255) NOT NULL,
  `is_arrested` tinyint(1) NOT NULL,
  `violation_date` date NOT NULL,
  `violation_fee` float(255,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `violations`
--

INSERT INTO `violations` (`violation_id`, `location`, `violation_type`, `is_arrested`, `violation_date`, `violation_fee`) VALUES
('V-00001', 'Main Street', 'Speeding', 0, '2024-03-04', 100.00),
('V-00002', 'Highway 101', 'Running Red Light', 1, '2024-03-05', 150.00),
('V-00003', 'Oak Avenue', 'Parking Violation', 0, '2024-03-06', 50.00),
('V-00004', 'Broadway Street', 'Seat Belt Violation', 0, '2024-03-07', 75.00),
('V-00005', 'City Center', 'Failure to Signal', 1, '2024-03-08', 80.00),
('V-00006', 'Park Avenue', 'Running Stop Sign', 0, '2024-03-09', 120.00),
('V-00007', 'Downtown Street', 'Speeding', 0, '2024-03-10', 100.00),
('V-00008', 'Highway 101', 'Running Red Light', 1, '2024-03-11', 150.00),
('V-00009', 'Oak Avenue', 'Parking Violation', 0, '2024-03-12', 50.00),
('V-00010', 'Broadway Street', 'Seat Belt Violation', 0, '2024-03-13', 75.00),
('V-00011', 'City Center', 'Failure to Signal', 1, '2024-03-14', 80.00),
('V-00012', 'Park Avenue', 'Running Stop Sign', 0, '2024-03-15', 120.00),
('V-00013', 'Downtown Street', 'Speeding', 0, '2024-03-16', 100.00),
('V-00014', 'Highway 101', 'Running Red Light', 1, '2024-03-17', 150.00),
('V-00015', 'Oak Avenue', 'Parking Violation', 0, '2024-03-18', 50.00),
('V-00016', 'Broadway Street', 'Seat Belt Violation', 0, '2024-03-19', 75.00),
('V-00017', 'City Center', 'Failure to Signal', 1, '2024-03-20', 80.00),
('V-00018', 'Downtown Street', 'Speeding', 0, '2024-03-21', 100.00),
('V-00019', 'Broadway Street', 'Running Red Light', 1, '2024-03-22', 150.00),
('V-00020', 'Park Avenue', 'Parking Violation', 0, '2024-03-23', 50.00);

-- --------------------------------------------------------

--
-- Table structure for table `violations_cars`
--

DROP TABLE IF EXISTS `violations_cars`;
CREATE TABLE `violations_cars` (
  `violation_id` char(7) NOT NULL,
  `car_id` char(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `violations_cars`
--

INSERT INTO `violations_cars` (`violation_id`, `car_id`) VALUES
('V-00001', 'C-00001'),
('V-00002', 'C-00002'),
('V-00003', 'C-00003'),
('V-00004', 'C-00004'),
('V-00005', 'C-00005'),
('V-00006', 'C-00006'),
('V-00007', 'C-00007'),
('V-00008', 'C-00008'),
('V-00009', 'C-00009'),
('V-00010', 'C-00010'),
('V-00011', 'C-00011'),
('V-00012', 'C-00012'),
('V-00013', 'C-00013'),
('V-00014', 'C-00014'),
('V-00015', 'C-00015'),
('V-00016', 'C-00016'),
('V-00017', 'C-00017'),
('V-00018', 'C-00018'),
('V-00019', 'C-00019'),
('V-00020', 'C-00020');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`car_id`),
  ADD KEY `cars_deals_deal_id_fk` (`deal_id`),
  ADD KEY `cars_emissions_emission_id_fk` (`emission_id`),
  ADD KEY `cars_owners_owner_id_fk` (`owner_id`),
  ADD KEY `cars_consumptions_comsumption_id_fk` (`consumption_id`);

--
-- Indexes for table `consumptions`
--
ALTER TABLE `consumptions`
  ADD PRIMARY KEY (`consumption_id`);

--
-- Indexes for table `deals`
--
ALTER TABLE `deals`
  ADD PRIMARY KEY (`deal_id`);

--
-- Indexes for table `emissions`
--
ALTER TABLE `emissions`
  ADD PRIMARY KEY (`emission_id`);

--
-- Indexes for table `insurances`
--
ALTER TABLE `insurances`
  ADD PRIMARY KEY (`insurance_id`);

--
-- Indexes for table `owners`
--
ALTER TABLE `owners`
  ADD PRIMARY KEY (`owner_id`),
  ADD KEY `owners_insurances_insurance_id_fk` (`insurance_id`);

--
-- Indexes for table `violations`
--
ALTER TABLE `violations`
  ADD PRIMARY KEY (`violation_id`);

--
-- Indexes for table `violations_cars`
--
ALTER TABLE `violations_cars`
  ADD PRIMARY KEY (`violation_id`,`car_id`),
  ADD KEY `violations_cars_cars_car_id_fk` (`car_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `cars_consumptions_comsumption_id_fk` FOREIGN KEY (`consumption_id`) REFERENCES `consumptions` (`consumption_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cars_deals_deal_id_fk` FOREIGN KEY (`deal_id`) REFERENCES `deals` (`deal_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cars_emissions_emission_id_fk` FOREIGN KEY (`emission_id`) REFERENCES `emissions` (`emission_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cars_owners_owner_id_fk` FOREIGN KEY (`owner_id`) REFERENCES `owners` (`owner_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `owners`
--
ALTER TABLE `owners`
  ADD CONSTRAINT `owners_insurances_insurance_id_fk` FOREIGN KEY (`insurance_id`) REFERENCES `insurances` (`insurance_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `violations_cars`
--
ALTER TABLE `violations_cars`
  ADD CONSTRAINT `violations_cars_cars_car_id_fk` FOREIGN KEY (`car_id`) REFERENCES `cars` (`car_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `violations_cars_violations_violation_id_fk` FOREIGN KEY (`violation_id`) REFERENCES `violations` (`violation_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
