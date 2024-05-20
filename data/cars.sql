-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2024 at 07:12 PM
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
  `emission_id` char(7) DEFAULT NULL,
  `consumption_id` char(8) DEFAULT NULL,
  `deal_id` char(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`car_id`, `car_name`, `cylinders`, `horsepower`, `year`, `engine_type`, `car_make`, `car_model`, `is_fuel_economic`, `owner_id`, `emission_id`, `consumption_id`, `deal_id`) VALUES
('C-00001', 'Honda Accord', 4, 190, 2023, 'gas', 'Honda', 'Accord', 1, 'O-00001', 'E-00001', 'FC-00001', 'D-00001'),
('C-00002', 'Ford Mustang', 0, 450, 2022, 'electric', 'Ford', 'Mustang', 0, 'O-00002', NULL, NULL, 'D-00002'),
('C-00003', 'Chevrolet Malibu', 0, 180, 2024, 'electric', 'Chevrolet', 'Malibu', 1, 'O-00003', NULL, NULL, 'D-00003'),
('C-00004', 'Toyota Prius', 4, 120, 2023, 'gas', 'Toyota', 'Prius', 1, 'O-00004', 'E-00004', 'FC-00004', 'D-00004'),
('C-00005', 'BMW X5', 6, 300, 2022, 'gas', 'BMW', 'X5', 0, 'O-00005', 'E-00005', 'FC-00005', 'D-00005'),
('C-00006', 'Tesla Model 3', 0, 450, 2023, 'electric', 'Tesla', 'Model 3', 1, 'O-00006', NULL, NULL, 'D-00006'),
('C-00007', 'Audi A4', 4, 220, 2024, 'gas', 'Audi', 'A4', 1, 'O-00007', 'E-00007', 'FC-00007', 'D-00007'),
('C-00008', 'Nissan Rogue', 4, 170, 2022, 'gas', 'Nissan', 'Rogue', 0, 'O-00008', 'E-00008', 'FC-00008', 'D-00008'),
('C-00009', 'Hyundai Sonata', 4, 200, 2023, 'gas', 'Hyundai', 'Sonata', 1, 'O-00009', 'E-00009', 'FC-00009', 'D-00009'),
('C-00010', 'Mercedes-Benz C-Class', 0, 300, 2022, 'electric', 'Mercedes-Benz', 'C-Class', 1, 'O-00010', NULL, NULL, 'D-00010'),
('C-00011', 'Volkswagen Golf', 0, 150, 2024, 'electric', 'Volkswagen', 'Golf', 0, 'O-00011', NULL, NULL, 'D-00011'),
('C-00012', 'Lexus RX', 6, 260, 2023, 'gas', 'Lexus', 'RX', 1, 'O-00012', 'E-00012', 'FC-00012', 'D-00012'),
('C-00013', 'Mazda CX-5', 4, 187, 2022, 'gas', 'Mazda', 'CX-5', 1, 'O-00013', 'E-00013', 'FC-00013', 'D-00013'),
('C-00014', 'Subaru Outback', 4, 182, 2024, 'gas', 'Subaru', 'Outback', 0, 'O-00014', 'E-00014', 'FC-00014', 'D-00014'),
('C-00015', 'Kia Telluride', 0, 291, 2023, 'electric', 'Kia', 'Telluride', 1, 'O-00015', NULL, NULL, 'D-00015'),
('C-00016', 'Jaguar F-PACE', 0, 380, 2022, 'electric', 'Jaguar', 'F-PACE', 1, 'O-00016', NULL, NULL, 'D-00016'),
('C-00017', 'Porsche 911', 0, 450, 2024, 'electric', 'Porsche', '911', 0, 'O-00017', NULL, NULL, 'D-00017'),
('C-00018', 'Volvo XC90', 4, 250, 2023, 'gas', 'Volvo', 'XC90', 1, 'O-00018', 'E-00018', 'FC-00018', 'D-00018'),
('C-00019', 'Land Rover Range Rover', 8, 518, 2022, 'gas', 'Land Rover', 'Range Rover', 1, 'O-00019', 'E-00019', 'FC-00019', 'D-00019'),
('C-00020', 'Chrysler Pacifica', 6, 287, 2024, 'gas', 'Chrysler', 'Pacifica', 0, 'O-00020', 'E-00020', 'FC-00020', 'D-00020'),
('C-00021', 'Lucid Air', 4, 1050, 2023, 'gas', 'Lucid', 'Air', 1, 'O-00006', 'E-00005', 'FC-00005', 'D-00008');

-- --------------------------------------------------------

--
-- Table structure for table `consumptions`
--

DROP TABLE IF EXISTS `consumptions`;
CREATE TABLE `consumptions` (
  `comsumption_id` char(8) NOT NULL,
  `engine_size` int(255) NOT NULL,
  `fuel_consumption_city` float(255,2) NOT NULL,
  `fuel_consumption_hwy` float(255,2) NOT NULL,
  `fuel_consumption_combined` float(255,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `consumptions`
--

INSERT INTO `consumptions` (`comsumption_id`, `engine_size`, `fuel_consumption_city`, `fuel_consumption_hwy`, `fuel_consumption_combined`) VALUES
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
('O-00020', 'Olivia Davis', 'olivia.davis@example.com', '10987', 'Italy', 'Rome', 26, 'Female', 'I-00020'),
('O-00021', 'Elena Reynolds', 'elena.reynolds@example.com', '10987', 'Vietname', 'Quy Nhon', 24, 'Female', 'I-00020'),
('O-00027', 'Elena Reynolds', 'elena.reynolds@example.com', '10987', 'Vietname', 'Quy Nhon', 24, 'Female', 'I-00020');

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

-- --------------------------------------------------------

--
-- Table structure for table `ws_log`
--

DROP TABLE IF EXISTS `ws_log`;
CREATE TABLE `ws_log` (
  `log_id` int(10) UNSIGNED NOT NULL,
  `email` varchar(150) NOT NULL,
  `user_action` varchar(255) NOT NULL,
  `logged_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ws_log`
--

INSERT INTO `ws_log` (`log_id`, `email`, `user_action`, `logged_at`, `user_id`) VALUES
(1, 'email_RU08', '/players', '0000-00-00 00:00:00', 2),
(2, 'email_RU08', '/cars', '0000-00-00 00:00:00', 2),
(3, 'email_RU08', '/cscs', '0000-00-00 00:00:00', 2),
(4, 'email_RU08', '/cscs', '0000-00-00 00:00:00', 2),
(5, 'email_RU08', '/cars', '0000-00-00 00:00:00', 2),
(6, 'email_RU08', '/cscsc', '0000-00-00 00:00:00', 2),
(7, 'email_RU08', '/cscs', '0000-00-00 00:00:00', 2),
(8, 'email_RU08', '/cscs', '0000-00-00 00:00:00', 2),
(9, 'email_RU08', '/cscs', '0000-00-00 00:00:00', 2),
(10, 'conan@gmail.com', '/cscs', '0000-00-00 00:00:00', 1),
(11, 'conan@gmail.com', '/tokencscs', '0000-00-00 00:00:00', 1),
(12, 'conan@gmail.com', '/tokencscs', '0000-00-00 00:00:00', 1),
(13, 'conan@gmail.com', '/tokencscs', '0000-00-00 00:00:00', 1),
(14, 'conan@gmail.com', '/tokencscs', '0000-00-00 00:00:00', 1),
(15, 'conan@gmail.com', '/tokencscs', '0000-00-00 00:00:00', 1),
(16, 'conan@gmail.com', '/tokencscs', '0000-00-00 00:00:00', 1),
(17, 'conan@gmail.com', '/tokencscs', '0000-00-00 00:00:00', 1),
(18, 'conan@gmail.com', '/tokencscs', '0000-00-00 00:00:00', 1),
(19, 'conan@gmail.com', '/tokencscs', '0000-00-00 00:00:00', 1),
(20, 'conan@gmail.com', '/tokencscs', '0000-00-00 00:00:00', 1),
(21, 'conan@gmail.com', '/cars/C-00001', '0000-00-00 00:00:00', 1),
(22, 'conan@gmail.com', '/cars/C-00001', '0000-00-00 00:00:00', 1),
(23, 'conan@gmail.com', '/cars/C-00001', '0000-00-00 00:00:00', 1),
(24, 'conan@gmail.com', '/cars/C-00001', '0000-00-00 00:00:00', 1),
(25, 'conan@gmail.com', '/tokvsvs', '0000-00-00 00:00:00', 1),
(26, 'conan@gmail.com', '/tokvsvs', '0000-00-00 00:00:00', 1),
(27, 'conan@gmail.com', '/cars', '2024-05-13 00:21:57', 1),
(28, 'conan@gmail.com', '/cars', '2024-05-13 00:22:24', 1),
(29, 'conan@gmail.com', '/cars', '2024-05-13 00:22:26', 1),
(30, 'conan@gmail.com', '/cars', '2024-05-13 00:22:27', 1),
(31, 'conan@gmail.com', '/cars', '2024-05-13 00:22:27', 1),
(32, 'conan@gmail.com', '/cars', '2024-05-13 00:22:27', 1),
(33, 'conan@gmail.com', '/cars', '2024-05-13 00:22:27', 1),
(34, 'conan@gmail.com', '/cars', '2024-05-13 00:22:27', 1),
(35, 'conan@gmail.com', '/cars', '2024-05-13 00:22:27', 1),
(36, 'conan@gmail.com', '/cars', '2024-05-13 00:22:27', 1),
(37, 'conan@gmail.com', '/cars', '2024-05-13 00:22:28', 1),
(38, 'conan@gmail.com', '/cars', '2024-05-13 00:22:28', 1),
(39, 'conan@gmail.com', '/cars', '2024-05-13 00:22:35', 1),
(40, 'conan@gmail.com', '/cars', '2024-05-13 01:39:30', 1),
(41, 'conan@gmail.com', '/owners', '2024-05-13 01:39:34', 1),
(42, 'conan@gmail.com', '/owners', '2024-05-13 01:52:14', 1),
(43, 'conan@gmail.com', '/owners', '2024-05-13 01:52:38', 1),
(44, 'conan@gmail.com', '/owners', '2024-05-13 01:55:27', 1),
(45, 'conan@gmail.com', '/cars', '2024-05-13 01:57:59', 1),
(46, 'conan@gmail.com', '/owners', '2024-05-13 01:58:02', 1),
(47, 'conan@gmail.com', '/owners', '2024-05-13 01:59:56', 1),
(48, 'conan@gmail.com', '/owners', '2024-05-13 02:00:09', 1),
(49, 'conan@gmail.com', '/owners', '2024-05-13 02:00:19', 1),
(50, 'conan@gmail.com', '/owners', '2024-05-13 02:00:34', 1),
(51, 'conan@gmail.com', '/owners', '2024-05-13 02:07:02', 1),
(52, 'conan@gmail.com', '/owners', '2024-05-13 02:07:26', 1),
(53, 'conan@gmail.com', '/owners', '2024-05-13 02:07:40', 1),
(54, 'conan@gmail.com', '/owners', '2024-05-13 02:10:45', 1),
(55, 'conan@gmail.com', '/owners', '2024-05-13 02:10:51', 1),
(56, 'conan@gmail.com', '/owners', '2024-05-13 02:10:52', 1),
(57, 'conan@gmail.com', '/owners', '2024-05-13 02:10:52', 1),
(58, 'conan@gmail.com', '/owners', '2024-05-13 02:10:52', 1),
(59, 'conan@gmail.com', '/owners', '2024-05-13 02:12:35', 1),
(60, 'conan@gmail.com', '/owners', '2024-05-13 02:12:45', 1),
(61, 'conan@gmail.com', '/owners', '2024-05-13 02:12:46', 1),
(62, 'conan@gmail.com', '/owners', '2024-05-13 02:12:46', 1),
(63, 'conan@gmail.com', '/owners', '2024-05-13 02:12:46', 1),
(64, 'conan@gmail.com', '/owners', '2024-05-13 02:13:00', 1),
(65, 'conan@gmail.com', '/owners', '2024-05-13 02:13:36', 1),
(66, 'conan@gmail.com', '/owners', '2024-05-13 02:13:39', 1),
(67, 'conan@gmail.com', '/owners', '2024-05-13 02:20:55', 1),
(68, 'conan@gmail.com', '/owners', '2024-05-13 02:21:01', 1),
(69, 'conan@gmail.com', '/owners', '2024-05-13 02:21:53', 1),
(70, 'conan@gmail.com', '/owners', '2024-05-13 02:22:23', 1),
(71, 'conan@gmail.com', '/owners', '2024-05-13 02:22:27', 1),
(72, 'conan@gmail.com', '/owners', '2024-05-13 02:22:31', 1),
(73, 'conan@gmail.com', '/owners', '2024-05-13 02:22:32', 1),
(74, 'conan@gmail.com', '/owners', '2024-05-13 02:23:39', 1),
(75, 'conan@gmail.com', '/owners', '2024-05-15 03:56:32', 1),
(76, 'conan@gmail.com', '/owners', '2024-05-15 03:56:33', 1),
(77, 'conan@gmail.com', '/owners', '2024-05-15 03:58:09', 1),
(78, 'conan@gmail.com', '/owners', '2024-05-15 03:58:22', 1),
(79, 'conan@gmail.com', '/owners', '2024-05-15 03:58:26', 1),
(80, 'conan@gmail.com', '/owners', '2024-05-15 04:00:23', 1),
(81, 'conan@gmail.com', '/owners', '2024-05-15 04:00:27', 1),
(82, 'conan@gmail.com', '/owners', '2024-05-15 04:01:34', 1),
(83, 'conan@gmail.com', '/owners', '2024-05-15 04:01:37', 1),
(84, 'conan@gmail.com', '/owners', '2024-05-15 04:01:37', 1),
(85, 'conan@gmail.com', '/owners', '2024-05-15 04:01:37', 1),
(86, 'conan@gmail.com', '/owners', '2024-05-15 04:04:52', 1),
(87, 'conan@gmail.com', '/owners', '2024-05-15 04:05:17', 1),
(88, 'conan@gmail.com', '/owners', '2024-05-15 04:05:18', 1),
(89, 'conan@gmail.com', '/owners', '2024-05-15 04:05:18', 1),
(90, 'conan@gmail.com', '/owners', '2024-05-15 04:05:19', 1),
(91, 'conan@gmail.com', '/owners', '2024-05-15 04:05:19', 1),
(92, 'conan@gmail.com', '/owners', '2024-05-15 04:05:19', 1),
(93, 'conan@gmail.com', '/owners', '2024-05-15 04:05:54', 1),
(94, 'conan@gmail.com', '/owners', '2024-05-15 04:06:46', 1),
(95, 'conan@gmail.com', '/owners', '2024-05-15 04:07:20', 1),
(96, 'conan@gmail.com', '/owners', '2024-05-15 04:07:24', 1),
(97, 'conan@gmail.com', '/owners', '2024-05-15 04:07:25', 1),
(98, 'conan@gmail.com', '/owners', '2024-05-15 04:07:25', 1),
(99, 'conan@gmail.com', '/owners', '2024-05-15 04:07:43', 1),
(100, 'conan@gmail.com', '/owners', '2024-05-15 04:07:44', 1),
(101, 'conan@gmail.com', '/owners', '2024-05-15 04:07:46', 1),
(102, 'conan@gmail.com', '/owners', '2024-05-15 04:07:46', 1),
(103, 'conan@gmail.com', '/owners', '2024-05-15 04:07:46', 1),
(104, 'conan@gmail.com', '/owners', '2024-05-15 04:07:46', 1),
(105, 'conan@gmail.com', '/owners', '2024-05-15 04:07:49', 1),
(106, 'conan@gmail.com', '/owners', '2024-05-15 04:07:49', 1),
(107, 'conan@gmail.com', '/owners', '2024-05-15 04:07:50', 1),
(108, 'conan@gmail.com', '/owners', '2024-05-15 04:07:50', 1),
(109, 'conan@gmail.com', '/owners', '2024-05-15 04:07:57', 1),
(110, 'conan@gmail.com', '/owners', '2024-05-15 04:08:47', 1),
(111, 'conan@gmail.com', '/owners', '2024-05-15 04:08:56', 1),
(112, 'conan@gmail.com', '/owners', '2024-05-15 04:09:03', 1),
(113, 'conan@gmail.com', '/owners', '2024-05-15 04:20:48', 1),
(114, 'conan@gmail.com', '/owners', '2024-05-15 04:20:49', 1),
(115, 'conan@gmail.com', '/owners', '2024-05-15 04:20:55', 1),
(116, 'conan@gmail.com', '/owners', '2024-05-15 04:20:56', 1),
(117, 'conan@gmail.com', '/owners', '2024-05-15 04:20:56', 1),
(118, 'conan@gmail.com', '/owners', '2024-05-15 04:20:58', 1),
(119, 'conan@gmail.com', '/owners', '2024-05-15 04:20:58', 1),
(120, 'conan@gmail.com', '/owners', '2024-05-15 04:20:58', 1),
(121, 'conan@gmail.com', '/owners', '2024-05-15 04:20:58', 1),
(122, 'conan@gmail.com', '/owners', '2024-05-15 04:21:03', 1),
(123, 'conan@gmail.com', '/owners', '2024-05-15 04:21:47', 1),
(124, 'conan@gmail.com', '/owners', '2024-05-15 04:21:48', 1),
(125, 'conan@gmail.com', '/owners', '2024-05-15 04:21:49', 1),
(126, 'conan@gmail.com', '/owners', '2024-05-15 04:21:50', 1),
(127, 'conan@gmail.com', '/owners', '2024-05-15 04:21:50', 1),
(128, 'conan@gmail.com', '/owners', '2024-05-15 04:21:50', 1),
(129, 'conan@gmail.com', '/owners', '2024-05-15 04:21:50', 1),
(130, 'conan@gmail.com', '/owners', '2024-05-15 04:21:50', 1),
(131, 'conan@gmail.com', '/owners', '2024-05-15 04:21:52', 1),
(132, 'conan@gmail.com', '/owners', '2024-05-15 04:21:53', 1),
(133, 'conan@gmail.com', '/owners', '2024-05-15 04:22:00', 1),
(134, 'conan@gmail.com', '/owners', '2024-05-15 04:22:01', 1),
(135, 'conan@gmail.com', '/owners', '2024-05-15 04:22:01', 1),
(136, 'conan@gmail.com', '/owners', '2024-05-15 04:23:47', 1),
(137, 'conan@gmail.com', '/owners', '2024-05-15 04:24:00', 1),
(138, 'conan@gmail.com', '/owners', '2024-05-15 04:24:01', 1),
(139, 'conan@gmail.com', '/owners', '2024-05-15 04:24:31', 1),
(140, 'conan@gmail.com', '/owners', '2024-05-15 04:24:46', 1),
(141, 'conan@gmail.com', '/owners', '2024-05-15 04:25:00', 1),
(142, 'conan@gmail.com', '/owners', '2024-05-15 04:37:07', 1),
(143, 'conan@gmail.com', '/owners', '2024-05-15 04:37:15', 1),
(144, 'conan@gmail.com', '/owners', '2024-05-15 04:37:24', 1),
(145, 'conan@gmail.com', '/owners', '2024-05-15 18:13:15', 1),
(146, 'conan@gmail.com', '/owners', '2024-05-15 18:18:00', 1),
(147, 'conan@gmail.com', '/owners', '2024-05-15 18:18:16', 1),
(148, 'conan@gmail.com', '/owners', '2024-05-15 18:18:42', 1),
(149, 'conan@gmail.com', '/owners', '2024-05-15 18:19:09', 1),
(150, 'conan@gmail.com', '/owners', '2024-05-15 18:19:53', 1),
(151, 'conan@gmail.com', '/owners', '2024-05-15 18:20:02', 1),
(152, 'conan@gmail.com', '/owners', '2024-05-15 18:20:17', 1),
(153, 'conan@gmail.com', '/owners', '2024-05-15 19:08:18', 1),
(154, 'conan@gmail.com', '/owners', '2024-05-15 19:08:31', 1),
(155, 'conan@gmail.com', '/owners', '2024-05-15 19:08:51', 1),
(156, 'conan@gmail.com', '/owners', '2024-05-15 19:09:23', 1),
(157, 'conan@gmail.com', '/owners', '2024-05-15 19:09:52', 1),
(158, 'conan@gmail.com', '/owners', '2024-05-15 19:10:07', 1),
(159, 'conan@gmail.com', '/owners', '2024-05-15 19:10:52', 1),
(160, 'conan@gmail.com', '/owners', '2024-05-15 19:11:07', 1),
(161, 'conan@gmail.com', '/owners', '2024-05-15 19:11:46', 1),
(162, 'conan@gmail.com', '/owners', '2024-05-15 19:12:45', 1),
(163, 'conan@gmail.com', '/owners', '2024-05-15 19:16:30', 1),
(164, 'conan@gmail.com', '/owners', '2024-05-15 19:16:43', 1),
(165, 'conan@gmail.com', '/owners', '2024-05-15 19:17:05', 1),
(166, 'conan@gmail.com', '/owners', '2024-05-15 19:17:22', 1),
(167, 'conan@gmail.com', '/owners', '2024-05-15 19:17:47', 1),
(168, 'conan@gmail.com', '/owners', '2024-05-15 19:17:56', 1),
(169, 'conan@gmail.com', '/owners', '2024-05-15 19:18:17', 1),
(170, 'conan@gmail.com', '/owners', '2024-05-15 19:18:25', 1),
(171, 'conan@gmail.com', '/owners', '2024-05-15 19:18:35', 1),
(172, 'conan@gmail.com', '/owners', '2024-05-15 19:28:11', 1),
(173, 'conan@gmail.com', '/owners', '2024-05-15 19:28:18', 1),
(174, 'conan@gmail.com', '/owners', '2024-05-15 19:35:08', 1),
(175, 'conan@gmail.com', '/owners', '2024-05-15 19:35:17', 1),
(176, 'conan@gmail.com', '/owners', '2024-05-15 19:35:22', 1),
(177, 'conan@gmail.com', '/owners', '2024-05-15 19:35:35', 1),
(178, 'conan@gmail.com', '/owners', '2024-05-15 19:36:05', 1),
(179, 'conan@gmail.com', '/owners', '2024-05-15 19:36:15', 1),
(180, 'conan@gmail.com', '/owners', '2024-05-15 19:36:25', 1),
(181, 'conan@gmail.com', '/owners', '2024-05-15 19:41:27', 1),
(182, 'conan@gmail.com', '/owners', '2024-05-15 19:41:57', 1),
(183, 'conan@gmail.com', '/owners', '2024-05-15 19:45:55', 1),
(184, 'conan@gmail.com', '/owners', '2024-05-15 19:45:59', 1),
(185, 'conan@gmail.com', '/owners', '2024-05-15 19:46:05', 1),
(186, 'conan@gmail.com', '/owners', '2024-05-15 19:49:58', 1),
(187, 'conan@gmail.com', '/owners', '2024-05-15 19:50:06', 1),
(188, 'conan@gmail.com', '/owners', '2024-05-15 19:50:11', 1),
(189, 'conan@gmail.com', '/owners', '2024-05-15 20:00:39', 1),
(190, 'conan@gmail.com', '/owners', '2024-05-15 20:02:46', 1),
(191, 'conan@gmail.com', '/owners', '2024-05-15 20:03:02', 1),
(192, 'conan@gmail.com', '/owners', '2024-05-15 20:03:10', 1),
(193, 'conan@gmail.com', '/owners', '2024-05-15 20:03:29', 1),
(194, 'conan@gmail.com', '/owners', '2024-05-15 20:03:45', 1),
(195, 'conan@gmail.com', '/owners', '2024-05-15 20:03:45', 1),
(196, 'conan@gmail.com', '/owners', '2024-05-15 20:03:59', 1),
(197, 'conan@gmail.com', '/owners', '2024-05-15 20:07:48', 1),
(198, 'conan@gmail.com', '/owners', '2024-05-15 20:07:58', 1),
(199, 'conan@gmail.com', '/owners', '2024-05-15 20:09:26', 1),
(200, 'conan@gmail.com', '/owners', '2024-05-15 20:09:42', 1),
(201, 'conan@gmail.com', '/owners', '2024-05-15 20:09:51', 1),
(202, 'conan@gmail.com', '/owners', '2024-05-15 20:09:55', 1),
(203, 'conan@gmail.com', '/owners', '2024-05-15 20:10:22', 1),
(204, 'conan@gmail.com', '/owners', '2024-05-15 20:10:29', 1),
(205, 'conan@gmail.com', '/owners', '2024-05-15 20:10:33', 1),
(206, 'conan@gmail.com', '/owners', '2024-05-15 20:10:39', 1),
(207, 'conan@gmail.com', '/owners', '2024-05-15 20:11:17', 1),
(208, 'conan@gmail.com', '/owners', '2024-05-15 20:11:38', 1),
(209, 'conan@gmail.com', '/owners', '2024-05-15 20:11:55', 1),
(210, 'conan@gmail.com', '/owners', '2024-05-15 20:12:15', 1),
(211, 'conan@gmail.com', '/owners', '2024-05-15 20:12:24', 1),
(212, 'conan@gmail.com', '/owners', '2024-05-15 20:15:09', 1),
(213, 'conan@gmail.com', '/owners', '2024-05-15 20:15:24', 1),
(214, 'conan@gmail.com', '/owners', '2024-05-15 20:15:25', 1),
(215, 'conan@gmail.com', '/owners', '2024-05-15 20:15:25', 1),
(216, 'conan@gmail.com', '/owners', '2024-05-15 20:15:26', 1),
(217, 'conan@gmail.com', '/owners', '2024-05-15 20:15:37', 1),
(218, 'conan@gmail.com', '/owners', '2024-05-15 20:15:42', 1),
(219, 'conan@gmail.com', '/owners', '2024-05-15 20:32:52', 1),
(220, 'conan@gmail.com', '/owners', '2024-05-15 20:33:09', 1),
(221, 'conan@gmail.com', '/owners', '2024-05-15 20:33:12', 1),
(222, 'conan@gmail.com', '/owners', '2024-05-15 20:33:13', 1),
(223, 'conan@gmail.com', '/owners', '2024-05-15 20:33:13', 1),
(224, 'conan@gmail.com', '/owners', '2024-05-15 20:33:13', 1),
(225, 'conan@gmail.com', '/owners', '2024-05-15 20:33:13', 1),
(226, 'conan@gmail.com', '/owners', '2024-05-15 20:33:14', 1),
(227, 'conan@gmail.com', '/owners', '2024-05-15 20:33:14', 1),
(228, 'conan@gmail.com', '/owners', '2024-05-15 20:33:14', 1),
(229, 'conan@gmail.com', '/owners', '2024-05-15 20:33:14', 1),
(230, 'conan@gmail.com', '/owners', '2024-05-15 20:33:15', 1),
(231, 'conan@gmail.com', '/owners', '2024-05-15 20:33:15', 1),
(232, 'conan@gmail.com', '/owners', '2024-05-15 20:33:15', 1),
(233, 'conan@gmail.com', '/owners', '2024-05-15 20:33:15', 1),
(234, 'conan@gmail.com', '/owners', '2024-05-15 20:33:15', 1),
(235, 'conan@gmail.com', '/owners', '2024-05-15 20:33:16', 1),
(236, 'conan@gmail.com', '/owners', '2024-05-15 20:33:16', 1),
(237, 'conan@gmail.com', '/owners', '2024-05-15 20:42:54', 1),
(238, 'conan@gmail.com', '/owners', '2024-05-15 20:43:05', 1),
(239, 'conan@gmail.com', '/owners', '2024-05-15 20:45:37', 1),
(240, 'conan@gmail.com', '/owners', '2024-05-15 20:45:39', 1),
(241, 'conan@gmail.com', '/owners', '2024-05-15 20:46:19', 1),
(242, 'conan@gmail.com', '/owners', '2024-05-15 20:46:40', 1),
(243, 'conan@gmail.com', '/owners', '2024-05-15 20:48:32', 1),
(244, 'conan@gmail.com', '/owners', '2024-05-15 21:03:17', 1),
(245, 'conan@gmail.com', '/owners', '2024-05-15 21:03:35', 1),
(246, 'conan@gmail.com', '/owners', '2024-05-15 21:03:41', 1),
(247, 'conan@gmail.com', '/owners', '2024-05-15 21:04:21', 1),
(248, 'conan@gmail.com', '/owners', '2024-05-15 21:04:36', 1),
(249, 'conan@gmail.com', '/owners', '2024-05-15 21:04:43', 1),
(250, 'conan@gmail.com', '/owners', '2024-05-15 21:04:46', 1),
(251, 'conan@gmail.com', '/owners', '2024-05-15 21:04:48', 1),
(252, 'conan@gmail.com', '/owners', '2024-05-15 21:04:50', 1),
(253, 'conan@gmail.com', '/owners', '2024-05-15 21:04:51', 1),
(254, 'conan@gmail.com', '/owners', '2024-05-15 21:05:12', 1),
(255, 'conan@gmail.com', '/owners', '2024-05-15 21:05:17', 1),
(256, 'conan@gmail.com', '/owners', '2024-05-15 21:07:54', 1),
(257, 'conan@gmail.com', '/owners', '2024-05-15 21:08:17', 1),
(258, 'conan@gmail.com', '/owners', '2024-05-15 21:08:26', 1),
(259, 'conan@gmail.com', '/owners', '2024-05-15 21:09:26', 1),
(260, 'conan@gmail.com', '/owners', '2024-05-15 21:09:37', 1),
(261, 'conan@gmail.com', '/owners', '2024-05-15 21:11:48', 1),
(262, 'conan@gmail.com', '/owners', '2024-05-15 21:12:17', 1),
(263, 'conan@gmail.com', '/owners', '2024-05-15 21:12:19', 1),
(264, 'conan@gmail.com', '/owners', '2024-05-15 21:12:19', 1),
(265, 'conan@gmail.com', '/owners', '2024-05-15 21:12:19', 1),
(266, 'conan@gmail.com', '/owners', '2024-05-15 21:12:19', 1),
(267, 'conan@gmail.com', '/owners', '2024-05-15 21:12:32', 1),
(268, 'conan@gmail.com', '/owners', '2024-05-15 21:12:51', 1),
(269, 'conan@gmail.com', '/owners', '2024-05-15 21:13:11', 1),
(270, 'conan@gmail.com', '/owners', '2024-05-15 21:13:15', 1),
(271, 'conan@gmail.com', '/owners', '2024-05-15 21:13:16', 1),
(272, 'conan@gmail.com', '/owners', '2024-05-15 21:13:21', 1),
(273, 'conan@gmail.com', '/owners', '2024-05-15 21:13:22', 1),
(274, 'conan@gmail.com', '/owners', '2024-05-15 21:13:22', 1),
(275, 'conan@gmail.com', '/owners', '2024-05-15 21:13:22', 1),
(276, 'conan@gmail.com', '/owners', '2024-05-15 21:13:26', 1),
(277, 'conan@gmail.com', '/owners', '2024-05-15 21:13:34', 1),
(278, 'conan@gmail.com', '/owners', '2024-05-15 21:14:24', 1),
(279, 'conan@gmail.com', '/owners', '2024-05-15 21:15:02', 1),
(280, 'conan@gmail.com', '/owners', '2024-05-15 21:15:06', 1),
(281, 'conan@gmail.com', '/owners', '2024-05-15 21:15:07', 1),
(282, 'conan@gmail.com', '/owners', '2024-05-15 21:15:07', 1),
(283, 'conan@gmail.com', '/owners', '2024-05-15 21:15:08', 1),
(284, 'conan@gmail.com', '/owners', '2024-05-15 21:15:08', 1),
(285, 'conan@gmail.com', '/owners', '2024-05-15 21:15:08', 1),
(286, 'conan@gmail.com', '/owners', '2024-05-15 21:15:08', 1),
(287, 'conan@gmail.com', '/owners', '2024-05-15 21:15:49', 1),
(288, 'conan@gmail.com', '/owners', '2024-05-15 21:15:56', 1),
(289, 'conan@gmail.com', '/owners', '2024-05-15 21:16:03', 1),
(290, 'conan@gmail.com', '/owners', '2024-05-15 21:18:34', 1),
(291, 'conan@gmail.com', '/owners', '2024-05-15 21:19:12', 1),
(292, 'conan@gmail.com', '/owners', '2024-05-15 21:19:15', 1),
(293, 'conan@gmail.com', '/owners', '2024-05-15 21:19:16', 1),
(294, 'conan@gmail.com', '/owners', '2024-05-15 21:19:16', 1),
(295, 'conan@gmail.com', '/owners', '2024-05-15 21:19:16', 1),
(296, 'conan@gmail.com', '/owners', '2024-05-15 21:22:16', 1),
(297, 'conan@gmail.com', '/owners', '2024-05-15 21:22:37', 1),
(298, 'conan@gmail.com', '/owners', '2024-05-15 21:23:01', 1),
(299, 'conan@gmail.com', '/owners', '2024-05-15 21:23:05', 1),
(300, 'conan@gmail.com', '/owners', '2024-05-15 21:25:25', 1),
(301, 'conan@gmail.com', '/owners', '2024-05-15 21:37:43', 1),
(302, 'conan@gmail.com', '/owners', '2024-05-15 21:37:59', 1),
(303, 'conan@gmail.com', '/owners', '2024-05-15 21:38:25', 1),
(304, 'conan@gmail.com', '/owners', '2024-05-15 21:38:32', 1),
(305, 'conan@gmail.com', '/owners', '2024-05-15 21:39:57', 1),
(306, 'conan@gmail.com', '/owners', '2024-05-15 21:40:02', 1),
(307, 'conan@gmail.com', '/owners', '2024-05-15 21:40:11', 1),
(308, 'conan@gmail.com', '/owners', '2024-05-15 21:40:21', 1),
(309, 'conan@gmail.com', '/owners', '2024-05-15 21:40:26', 1),
(310, 'conan@gmail.com', '/owners', '2024-05-15 21:47:39', 1),
(311, 'conan@gmail.com', '/owners', '2024-05-15 21:47:51', 1),
(312, 'conan@gmail.com', '/owners', '2024-05-15 21:48:12', 1),
(313, 'conan@gmail.com', '/owners', '2024-05-15 21:48:14', 1),
(314, 'conan@gmail.com', '/owners', '2024-05-15 21:49:13', 1),
(315, 'conan@gmail.com', '/owners', '2024-05-15 21:55:19', 1),
(316, 'conan@gmail.com', '/owners', '2024-05-15 22:07:42', 1),
(317, 'conan@gmail.com', '/owners', '2024-05-15 22:07:50', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ws_users`
--

DROP TABLE IF EXISTS `ws_users`;
CREATE TABLE `ws_users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ws_users`
--

INSERT INTO `ws_users` (`user_id`, `first_name`, `last_name`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'conan', 'ymn', 'conan@gmail.com', '$2y$15$w2MwMIb/RTAWpdQ/K4otaenq2xSEsmyCmfLlfq0jlKPlfbJ1jtDBe', 'admin', '2024-05-08 12:26:24'),
(3, 'arsh', 'singh', '', '$2y$15$lZhhl2kNo6b6Q8ftdiey5.kTj9eKnxtppcQEq2ozD/hk0s94xnPe.', 'user', '2024-05-15 05:40:16'),
(5, 'Arsh', 'Singh', 'arshsingh@gmail.com', '$2y$15$QyRq3rcLGnXzlJRUiX0HzOK.GY3ykbx4mv2gKwb7xOWUGW5.oy0Lm', 'admin', '2024-05-15 10:35:08');

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
  ADD PRIMARY KEY (`comsumption_id`);

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
-- Indexes for table `ws_log`
--
ALTER TABLE `ws_log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `ws_users`
--
ALTER TABLE `ws_users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ws_log`
--
ALTER TABLE `ws_log`
  MODIFY `log_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=318;

--
-- AUTO_INCREMENT for table `ws_users`
--
ALTER TABLE `ws_users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `cars_consumptions_comsumption_id_fk` FOREIGN KEY (`consumption_id`) REFERENCES `consumptions` (`comsumption_id`) ON DELETE CASCADE ON UPDATE CASCADE,
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
