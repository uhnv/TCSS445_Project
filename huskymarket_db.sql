-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 10, 2023 at 09:48 AM
-- Server version: 10.6.12-MariaDB
-- PHP Version: 8.1.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `huskymarket_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `BUYER`
--

CREATE TABLE `BUYER` (
  `Cust_ID` int(11) NOT NULL,
  `FirstName` varchar(256) NOT NULL,
  `LastName` varchar(256) NOT NULL,
  `Email` varchar(256) NOT NULL,
  `Phone` varchar(10) NOT NULL,
  `Username` varchar(256) NOT NULL,
  `Password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `BUYER`
--

INSERT INTO `BUYER` (`Cust_ID`, `FirstName`, `LastName`, `Email`, `Phone`, `Username`, `Password`) VALUES
(1, 'Jame', 'Smith', 'jame@gmail.com', '2064456060', 'jsmith01', 'j123'),
(2, 'Karen', 'Smith', 'karen@gmail.com', '2064459001', 'ksmith11', 'k321'),
(3, 'Lora', 'Harry', 'lora@gmail.com', '2063347000', 'lharry12', 'l456'),
(4, 'Ann', 'Nguyen', 'annguyen@gmail.com', '2063346060', 'anguyen20', 'a999'),
(5, 'Vicky', 'Tran', 'vickytran@gmail.com', '2068098003', 'vtran00', 'v886'),
(6, 'Anna', 'Willam', 'anna@gmail.com', '2068091034', 'awillam', 'a512'),
(7, 'Alex', 'Timmy', 'alex@gmail.com', '2064459000', 'atimmy23', 'a2314'),
(8, 'Tommy', 'Nguyen', 'tommy@gmail.com', '2064453434', 'tnguyen123', 't512'),
(9, 'Kenny', 'Tran', 'kenny@gmail.com', '2064408080', 'ktran25', 'k052'),
(10, 'Tim', 'Derric', 'tderric@gmail.com', '2147483647', 'tderric53', 't1235');

-- --------------------------------------------------------

--
-- Table structure for table `CUSTOMERADDRESS`
--

CREATE TABLE `CUSTOMERADDRESS` (
  `Address_ID` varchar(256) NOT NULL,
  `Address` varchar(256) NOT NULL,
  `AddressType` varchar(256) NOT NULL,
  `Cust_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `CUSTOMERADDRESS`
--

INSERT INTO `CUSTOMERADDRESS` (`Address_ID`, `Address`, `AddressType`, `Cust_ID`) VALUES
('0a', '901 Sunset BLVD, Renton, WA 98056', 'Shipping', 1),
('0b', '901 Sunset BLVD, Renton, WA 98056', 'Billing', 1),
('0c', '29500 125 Pl, Renton, WA 98058', 'Shipping', 2),
('0d', '29500 125 Pl, Renton, WA 98058', 'Billing', 2),
('0e', '880 SE 5th, Redmond, WA 98052', 'Shipping', 3),
('0f', '900 Jefferson Ave, Tacoma WA 98402', 'Home', 3),
('0g', '900 Jefferson Ave, Tacoma WA 98402', 'Billing', 3),
('0h', '909 Jefferson Ave, suite C103, Tacoma WA 98402', 'Shipping', 4),
('0i', '909 Jefferson Ave, suite C103, Tacoma WA 98402', 'Billing', 4),
('0j', '990 123 st Ct NE, Bellvue WA 9842', 'Shipping', 5),
('0k', '990 123 st Ct NE, Bellvue WA 9842', 'Billing', 5),
('0l', '12600 65rd Ct SE, Kent WA 98030', 'Home', 6),
('0m', '2900 190rd Ct NE, Auburn, WA 98002', 'Shipping', 6),
('0n', '12600 65rd Ct SE, Kent WA 98030', 'Billing', 6),
('0o', '12300 Jefferson Ave, Renton, WA 98056', 'Home', 7),
('0p', '110 Sunset SE, Suite A204, Renton, WA 98059', 'Shipping', 7),
('0q', '12300 Jefferson Ave, Renton, WA 98056', 'Billing', 7),
('0r', '4450 NE 4th, Auburn, WA 98092', 'Shipping', 8),
('0s', '4450 NE 4th, Auburn, WA 98092', 'Billing', 8),
('0t', '123 NE 5th, Bellevue, WA 98005', 'Shipping', 9),
('0u', '123 NE 5th, Bellevue, WA 98005', 'Billing', 9),
('0v', '9920 123rd Ct S, Kent, WA 98031', 'Shipping', 10),
('0w', '9920 123rd Ct S, Kent, WA 98031', 'Billing', 10);

-- --------------------------------------------------------

--
-- Table structure for table `INVENTORY`
--

CREATE TABLE `INVENTORY` (
  `Inventory_ID` int(11) NOT NULL,
  `Product_ID` int(11) NOT NULL,
  `Product_name` varchar(255) NOT NULL,
  `Location` varchar(255) NOT NULL,
  `Quantity` int(11) NOT NULL CHECK (`Quantity` >= 0),
  `Stock_level` int(11) NOT NULL CHECK (`Stock_level` >= 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `INVENTORY`
--

INSERT INTO `INVENTORY` (`Inventory_ID`, `Product_ID`, `Product_name`, `Location`, `Quantity`, `Stock_level`) VALUES
(1, 1, 'Intro to Programming', 'Tacoma, WA', 99, 50),
(2, 2, 'Calculus I', 'Tacoma,WA', 99, 10),
(3, 3, 'Biology 101', 'Bothell, WA', 99, 25),
(4, 4, 'Mechanical Pencils', 'Tacoma, WA', 99, 1),
(5, 5, 'Notebooks', 'Seattle, WA', 99, 1),
(6, 6, 'Highlighters', 'Seattle, WA', 99, 30),
(7, 7, 'Chemistry 101', 'Seattle, WA', 99, 20),
(8, 8, 'Folders', 'Bothell, WA', 99, 1),
(9, 9, 'Physics 101', 'Bothell, WA', 99, 1),
(10, 10, 'Pens', 'Tacoma, WA', 99, 10),
(11, 11, 'Stapler', 'Tacoma, Wa', 99, 10),
(12, 12, 'Paper Clips', 'Bothell, WA', 99, 15),
(13, 13, 'Scissors', 'Seattle, WA', 99, 10),
(14, 14, 'Glue Sticks', 'Tacoma, WA', 99, 10),
(15, 15, 'Correction Tape', 'Bothell, WA', 99, 5),
(16, 16, 'Wireless Mouse', 'Tacoma, WA', 99, 2),
(17, 17, 'USB Flash Drive', 'Tacoma, WA', 99, 2),
(18, 18, 'Laptop Sleeve', 'Tacoma, WA', 99, 17),
(19, 19, 'Headphones', 'Bothell, WA', 99, 30),
(20, 20, 'External Hard Drive', 'Tacoma, WA', 99, 10),
(21, 21, 'Power Bank', 'Seattle, WA', 99, 10),
(22, 22, 'HDMI Cable', 'Tacoma, WA', 99, 10),
(23, 23, 'Wireless Keyboard', 'Bothell, WA', 99, 6),
(24, 24, 'Webcam', 'Bothell, WA', 99, 5),
(25, 25, 'Portable Speakers', 'Seattle, WA', 99, 5),
(26, 26, 'Wireless Headphones', 'Tacoma, WA', 50, 10),
(27, 27, 'USB Flash Drive', 'Tacoma, WA', 30, 10),
(28, 28, 'Portable Charger', 'Tacoma, WA', 30, 20),
(29, 29, 'Smart Watch', 'Tacoma, WA', 30, 50),
(30, 30, 'Bluetooth Speaker', 'Bothell, WA', 40, 20),
(31, 31, 'Wireless Mouse', 'Bothell, WA', 20, 10),
(32, 32, 'HDMI Cable', 'Bothell, WA', 40, 10),
(33, 33, 'Power Strip', 'Seattle, WA', 60, 14),
(34, 34, 'Wireless Keyboard', 'Seattle, WA', 99, 40),
(35, 35, 'Tablet Stand', 'Seattle, WA', 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ORDERS`
--

CREATE TABLE `ORDERS` (
  `Order_ID` int(11) NOT NULL,
  `Order_Number` varchar(256) NOT NULL,
  `Cust_ID` int(11) NOT NULL,
  `Total_Price` double NOT NULL CHECK (`Total_Price` >= 0.0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ORDERS`
--

INSERT INTO `ORDERS` (`Order_ID`, `Order_Number`, `Cust_ID`, `Total_Price`) VALUES
(1, 'ORD1', 1, 259.94),
(2, 'ORD2', 2, 37.95),
(3, 'ORD3', 3, 449.85),
(4, 'ORD4', 4, 479.84),
(5, 'ORD5', 5, 299.9),
(6, 'ORD6', 6, 299.9),
(7, 'ORD7', 7, 353.38),
(8, 'ORD8', 8, 299.9),
(9, 'ORD9', 9, 39.99),
(10, 'ORD10', 10, 179.94);

-- --------------------------------------------------------

--
-- Table structure for table `ORDER_ITEMS`
--

CREATE TABLE `ORDER_ITEMS` (
  `Order_ID` int(10) NOT NULL,
  `Line_Item_ID` int(10) NOT NULL,
  `Product_ID` int(10) NOT NULL,
  `Quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ORDER_ITEMS`
--

INSERT INTO `ORDER_ITEMS` (`Order_ID`, `Line_Item_ID`, `Product_ID`, `Quantity`) VALUES
(1, 1, 1, 2),
(1, 2, 3, 4),
(2, 1, 1, 1),
(2, 2, 10, 4),
(3, 1, 1, 15),
(4, 1, 1, 16),
(5, 1, 1, 10),
(6, 1, 1, 10),
(7, 1, 1, 10),
(7, 2, 3, 1),
(7, 3, 6, 1),
(8, 1, 1, 10),
(9, 1, 2, 1),
(10, 1, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ORDER_STATUS`
--

CREATE TABLE `ORDER_STATUS` (
  `Status_ID` int(10) NOT NULL,
  `Order_Number` varchar(256) NOT NULL,
  `Status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ORDER_STATUS`
--

INSERT INTO `ORDER_STATUS` (`Status_ID`, `Order_Number`, `Status`) VALUES
(1, 'ORD1', 'Confirmed'),
(2, 'ORD2', 'Shipped'),
(3, 'ORD3', 'Delievered'),
(4, 'ORD4', 'Processing'),
(5, 'ORD5', 'In-Transit'),
(6, 'ORD6', 'Confirmed'),
(7, 'ORD7', 'Shipped'),
(8, 'ORD8', 'Delievered'),
(9, 'ORD9', 'Processing'),
(10, 'ORD10', 'In-Transit');

-- --------------------------------------------------------

--
-- Table structure for table `PRODUCT`
--

CREATE TABLE `PRODUCT` (
  `Product_id` int(10) NOT NULL,
  `Product_name` varchar(256) NOT NULL,
  `Product_type` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Weight` double(8,2) NOT NULL CHECK (`Weight` >= 0.0),
  `Price` double(8,2) NOT NULL CHECK (`Price` >= 0.0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `PRODUCT`
--

INSERT INTO `PRODUCT` (`Product_id`, `Product_name`, `Product_type`, `Description`, `Weight`, `Price`) VALUES
(1, 'Intro to Programming', 'Textbook', 'An introductory textbook for programming', 2.10, 29.99),
(2, 'Calculus I', 'Textbook', 'A textbook for calculus', 3.20, 39.99),
(3, 'Biology 101', 'Textbook', 'An introductory biology textbook', 2.90, 49.99),
(4, 'Mechanical Pencils', 'School Supply', 'Pack of 5 mechanical pencils', 0.10, 4.99),
(5, 'Notebooks', 'School Supply', 'Pack of 3 notebooks', 0.50, 7.99),
(6, 'Highlighters', 'School Supply', 'Pack of 4 highlighters', 0.20, 3.49),
(7, 'Chemistry 101', 'Textbook', 'An introductory chemistry textbook', 3.50, 59.99),
(8, 'Folders', 'School Supply', 'Pack of 10 folders', 0.30, 2.99),
(9, 'Physics 101', 'Textbook', 'An introductory physics textbook', 3.00, 49.99),
(10, 'Pens', 'School Supply', 'Pack of 10 pens', 0.10, 1.99),
(11, 'Stapler', 'School Supply', 'A small stapler for home or office use', 0.80, 9.99),
(12, 'Paper Clips', 'School Supply', 'Box of 1000 paper clips', 0.10, 1.99),
(13, 'Scissors', 'School Supply', 'A pair of stainless steel scissors', 0.30, 6.99),
(14, 'Glue Sticks', 'School Supply', 'Pack of 6 glue sticks', 0.20, 3.49),
(15, 'Correction Tape', 'School Supply', 'Pack of 2 correction tapes', 0.10, 2.99),
(16, 'Wireless Mouse', 'Accessories', 'A wireless mouse for your computer', 0.10, 12.99),
(17, 'USB Flash Drive', 'Accessories', 'A 16GB USB flash drive for file storage', 0.05, 8.99),
(18, 'Laptop Sleeve', 'Accessories', 'A protective sleeve for your laptop', 0.30, 15.99),
(19, 'Headphones', 'Accessories', 'A pair of comfortable headphones', 0.20, 19.99),
(20, 'External Hard Drive', 'Accessories', 'A 1TB external hard drive for backup storage', 0.50, 49.99),
(21, 'Power Bank', 'Accessories', 'A portable charger for your devices', 0.20, 24.99),
(22, 'HDMI Cable', 'Accessories', 'A 6ft HDMI cable for connecting your devices to a TV', 0.10, 7.99),
(23, 'Wireless Keyboard', 'Accessories', 'A wireless keyboard for your computer', 0.20, 19.99),
(24, 'Webcam', 'Accessories', 'A webcam for video conferencing', 0.10, 29.99),
(25, 'Portable Speakers', 'Accessories', 'A pair of portable speakers for your phone or laptop', 0.50, 34.99),
(26, 'Wireless Headphones', 'Electronics', 'Bluetooth wireless headphones with noise-cancelling', 0.50, 49.99),
(27, 'USB Flash Drive', 'Electronics', '64GB USB flash drive for storing files', 0.10, 9.99),
(28, 'Portable Charger', 'Electronics', '5000mAh portable charger for smartphones', 0.30, 19.99),
(29, 'Smart Watch', 'Electronics', 'Smart watch with heart rate monitor and fitness tracking', 0.20, 59.99),
(30, 'Bluetooth Speaker', 'Electronics', 'Portable Bluetooth speaker with 10 hours of battery life', 0.60, 29.99),
(31, 'Wireless Mouse', 'Electronics', 'Wireless optical mouse for laptops or desktops', 0.10, 14.99),
(32, 'HDMI Cable', 'Electronics', '6ft HDMI cable for connecting devices to a TV or monitor', 0.20, 7.99),
(33, 'Power Strip', 'Electronics', '6-outlet power strip with surge protection', 0.80, 12.99),
(34, 'Wireless Keyboard', 'Electronics', 'Wireless keyboard with full-size layout and numeric keypad', 0.40, 24.99),
(35, 'Tablet Stand', 'Electronics', 'Adjustable tablet stand for hands-free use', 0.30, 8.99);

-- --------------------------------------------------------

--
-- Table structure for table `SHIPPING`
--

CREATE TABLE `SHIPPING` (
  `Shipping_ID` int(11) NOT NULL,
  `Tracking_ID` int(11) NOT NULL,
  `Status` varchar(256) NOT NULL,
  `Address_ID` varchar(256) NOT NULL,
  `Date` date NOT NULL DEFAULT curdate(),
  `Expected_delivery_date` date NOT NULL,
  `Shipping_cost` decimal(10,2) NOT NULL CHECK (`Shipping_cost` >= 0.0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `SHIPPING`
--

INSERT INTO `SHIPPING` (`Shipping_ID`, `Tracking_ID`, `Status`, `Address_ID`, `Date`, `Expected_delivery_date`, `Shipping_cost`) VALUES
(1, 1, 'Confirmed', '0a', '2023-02-01', '2023-02-15', 8.99),
(2, 2, 'Shipped', '0c', '2023-02-08', '2023-02-11', 12.99),
(3, 3, 'Delivered', '0e', '2023-01-08', '2023-01-13', 9.99),
(4, 4, 'Processing', '0h', '2023-02-12', '2023-02-17', 10.99),
(5, 5, 'In Transit', '0j', '2023-01-31', '2023-02-07', 7.99),
(6, 6, 'Confirmed', '0m', '2023-01-31', '2023-02-04', 5.99),
(7, 7, 'Shipped', '0p', '2023-01-31', '2023-02-08', 10.99),
(8, 8, 'Delivered', '0r', '2023-01-31', '2023-02-20', 9.99),
(9, 9, 'Processing', '0t', '2023-01-31', '2023-02-15', 7.99),
(10, 10, 'In Transit', '0v', '2023-01-31', '2023-02-08', 12.99);

-- --------------------------------------------------------

--
-- Table structure for table `TRACK`
--

CREATE TABLE `TRACK` (
  `Tracking_ID` int(11) NOT NULL,
  `Order_Num` varchar(256) NOT NULL,
  `Date` date NOT NULL,
  `Address_ID` varchar(256) NOT NULL,
  `Expected_delivery_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `TRACK`
--

INSERT INTO `TRACK` (`Tracking_ID`, `Order_Num`, `Date`, `Address_ID`, `Expected_delivery_date`) VALUES
(1, 'ORD1', '2023-02-01', '0a', '2023-02-15'),
(2, 'ORD2', '2023-02-08', '0c', '2023-02-11'),
(3, 'ORD3', '2023-01-08', '0e', '2023-01-13'),
(4, 'ORD4', '2023-02-12', '0h', '2023-02-17'),
(5, 'ORD5', '2023-01-31', '0j', '2023-02-07'),
(6, 'ORD6', '2023-01-31', '0m', '2023-02-04'),
(7, 'ORD7', '2023-01-31', '0p', '2023-02-08'),
(8, 'ORD8', '2023-01-31', '0r', '2023-02-20'),
(9, 'ORD9', '2023-01-31', '0t', '2023-02-15'),
(10, 'ORD10', '2023-01-31', '0v', '2023-02-08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `BUYER`
--
ALTER TABLE `BUYER`
  ADD PRIMARY KEY (`Cust_ID`);

--
-- Indexes for table `CUSTOMERADDRESS`
--
ALTER TABLE `CUSTOMERADDRESS`
  ADD PRIMARY KEY (`Address_ID`),
  ADD UNIQUE KEY `Address_ID` (`Address_ID`,`AddressType`,`Cust_ID`),
  ADD KEY `Cust_ID_Address-foreign` (`Cust_ID`);

--
-- Indexes for table `INVENTORY`
--
ALTER TABLE `INVENTORY`
  ADD PRIMARY KEY (`Inventory_ID`),
  ADD KEY `Product_ID_Inventory-foreign` (`Product_ID`);

--
-- Indexes for table `ORDERS`
--
ALTER TABLE `ORDERS`
  ADD PRIMARY KEY (`Order_ID`,`Cust_ID`),
  ADD UNIQUE KEY `Order_Number` (`Order_Number`);

--
-- Indexes for table `ORDER_ITEMS`
--
ALTER TABLE `ORDER_ITEMS`
  ADD PRIMARY KEY (`Order_ID`,`Line_Item_ID`) USING BTREE,
  ADD KEY `Product_ID_OI-foreign` (`Product_ID`);

--
-- Indexes for table `ORDER_STATUS`
--
ALTER TABLE `ORDER_STATUS`
  ADD PRIMARY KEY (`Status_ID`),
  ADD UNIQUE KEY `Order_Number` (`Order_Number`);

--
-- Indexes for table `PRODUCT`
--
ALTER TABLE `PRODUCT`
  ADD PRIMARY KEY (`Product_id`);

--
-- Indexes for table `SHIPPING`
--
ALTER TABLE `SHIPPING`
  ADD PRIMARY KEY (`Shipping_ID`),
  ADD KEY `Tracking_ID_Shipping-foreign` (`Tracking_ID`),
  ADD KEY `Address_ID_Shipping-foreign` (`Address_ID`);

--
-- Indexes for table `TRACK`
--
ALTER TABLE `TRACK`
  ADD PRIMARY KEY (`Tracking_ID`),
  ADD UNIQUE KEY `Order_Num` (`Order_Num`),
  ADD KEY `Address_ID_Track-foreign` (`Address_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `BUYER`
--
ALTER TABLE `BUYER`
  MODIFY `Cust_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ORDERS`
--
ALTER TABLE `ORDERS`
  MODIFY `Order_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `CUSTOMERADDRESS`
--
ALTER TABLE `CUSTOMERADDRESS`
  ADD CONSTRAINT `Cust_ID_Address-foreign` FOREIGN KEY (`Cust_ID`) REFERENCES `BUYER` (`Cust_ID`);

--
-- Constraints for table `INVENTORY`
--
ALTER TABLE `INVENTORY`
  ADD CONSTRAINT `Product_ID_Inventory-foreign` FOREIGN KEY (`Product_ID`) REFERENCES `PRODUCT` (`Product_id`);

--
-- Constraints for table `ORDERS`
--
ALTER TABLE `ORDERS`
  ADD CONSTRAINT `Cust_ID_Order-foreign` FOREIGN KEY (`Cust_ID`) REFERENCES `BUYER` (`Cust_ID`),
  ADD CONSTRAINT `Order_ID_O-foreign` FOREIGN KEY (`Order_ID`) REFERENCES `ORDER_ITEMS` (`Order_ID`);

--
-- Constraints for table `ORDER_ITEMS`
--
ALTER TABLE `ORDER_ITEMS`
  ADD CONSTRAINT `Product_ID_OI-foreign` FOREIGN KEY (`Product_ID`) REFERENCES `PRODUCT` (`Product_id`);

--
-- Constraints for table `ORDER_STATUS`
--
ALTER TABLE `ORDER_STATUS`
  ADD CONSTRAINT `Order_Num_Status-foreign` FOREIGN KEY (`Order_Number`) REFERENCES `ORDERS` (`Order_Number`);

--
-- Constraints for table `SHIPPING`
--
ALTER TABLE `SHIPPING`
  ADD CONSTRAINT `Address_ID_Shipping-foreign` FOREIGN KEY (`Address_ID`) REFERENCES `CUSTOMERADDRESS` (`Address_ID`),
  ADD CONSTRAINT `Tracking_ID_Shipping-foreign` FOREIGN KEY (`Tracking_ID`) REFERENCES `TRACK` (`Tracking_ID`);

--
-- Constraints for table `TRACK`
--
ALTER TABLE `TRACK`
  ADD CONSTRAINT `Address_ID_Track-foreign` FOREIGN KEY (`Address_ID`) REFERENCES `CUSTOMERADDRESS` (`Address_ID`),
  ADD CONSTRAINT `Order_Number_Track-foreign` FOREIGN KEY (`Order_Num`) REFERENCES `ORDERS` (`Order_Number`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
