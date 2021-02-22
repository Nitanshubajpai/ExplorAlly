-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2021 at 06:57 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shoround`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(10) UNSIGNED NOT NULL,
  `userid` int(11) NOT NULL,
  `guideid` int(11) NOT NULL,
  `charge` int(11) NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `userid`, `guideid`, `charge`, `date`) VALUES
(21, 4, 10, 840, '2020-12-16'),
(22, 6, 11, 600, '2020-12-23'),
(23, 6, 10, 480, '2020-12-30'),
(24, 6, 8, 120, '2020-12-02');

-- --------------------------------------------------------

--
-- Table structure for table `friend_request`
--

CREATE TABLE `friend_request` (
  `id` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `charge` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `friend_request`
--

INSERT INTO `friend_request` (`id`, `sender`, `receiver`, `charge`, `date`) VALUES
(37, 6, 7, 240, '2020-12-09'),
(38, 6, 11, 600, '2020-12-23');

-- --------------------------------------------------------

--
-- Table structure for table `guide`
--

CREATE TABLE `guide` (
  `guideid` int(11) NOT NULL,
  `guidename` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guide_email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guide_password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `guide_image` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guide`
--

INSERT INTO `guide` (`guideid`, `guidename`, `guide_email`, `guide_password`, `gender`, `city`, `contact`, `bio`, `guide_image`) VALUES
(7, 'Harry Potter', 'harry@hogwarts.com', '$2y$10$9bNpSmVpUSMkp1ymeevRQe5lWxjshsKxJzn2YyDsyaOou4NeuVKJW', 'Male', 'Delhi', '1234123400', 'Avadacadabra', '23.png'),
(8, 'Ron Weasley', 'ron@hogwarts.com', '$2y$10$eNp4h5TS2nWjvdE2X8v5tuv1HU8JGYpTpHG5osgIl6W8YY91loI92', 'Male', 'Bangalore', '1234123401', 'Alohomora', '26.png'),
(9, 'Hermoine Granger', 'hermoine@hogwarts.com', '$2y$10$a9clMoUbvbIryc/sCwkAPuS.wtfDKCoSSenAHOwjPC.5MqbAhYnie', 'Female', 'Goa', '1234123402', 'Expectopatronum', '13.png'),
(10, 'Alaska Young', 'alaska@gmail.com', '$2y$10$7IlhIZvvh6fTQyy4MnKVYOJNJ8V978mW/hwtgOLk/u3tyDwkEq.z6', 'Female', 'Mumbai', '1234567890', 'Hello, I am a guide welcome to shoround. Hire me for your next destination.', '14.png'),
(11, 'Miles Halter', 'miles@gmail.com', '$2y$10$rselBD0cx0nPOMGF3N7pnucOkKuTU42G7hdeepUjbPNa6cBzFCkyO', 'Male', 'Manali', '0000000000', 'Hello, I am a guide welcome to shoround. Hire me for your next destination.', '27.png'),
(12, 'Hazel Grace', 'hazel@gmail.com', '$2y$10$QD0NMn/bN4JyAvf4TKj7oOXB76gRGDZ1ozojcwc/ScCH.9brVyC9m', 'Female', 'Lucknow', '1231231231', 'Hello, I am a guide welcome to shoround. Hire me for your next destination.', '15.png'),
(13, 'Hassan Mirza', 'hassan@gmail.com', '$2y$10$2h7KYEPJDZbb8725qi5sceJJP9oe/kQX8iPuhYXVRMMfNu7qqBNkm', 'Male', 'Kanpur', '1231231231', 'Hello, I am a guide welcome to shoround. Hire me for your next destination.', '28.png'),
(14, 'Amir Pashtun', 'Amir@gmail.com', '$2y$10$EspU/cFSiBEZ443F0NvjFeSJlawzyyNtYhLTilvfowtSecufORc4G', 'Male', 'Kolkata', '1231231231', 'Hello, I am a guide welcome to shoround. Hire me for your next destination.', '18.png'),
(15, 'James Miller', 'james@gmail.com', '$2y$10$/9G18huXRLAzv5ARGIlSsOYwxJg6gTD5kxNxyRFC0YVypa4dOB1V.', 'Male', 'Chennai', '1231231231', 'Hello, I am a guide welcome to shoround. Hire me for your next destination.', '30.png'),
(16, 'Augustus Waters', 'Augustus@gmail.com', '$2y$10$7sZEQVeJucbHXPGkIcVMJ.wSPCm1RrveSbqa0bGi.DUo37r062sr.', 'Male', 'Mumbai', '1231231231', 'Hello, I am a guide welcome to shoround. Hire me for your next destination.', '32.png');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `vendorid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `productname` varchar(50) NOT NULL,
  `category` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `productimage` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`vendorid`, `productid`, `productname`, `category`, `description`, `price`, `productimage`) VALUES
(1, 7, 'Iphone 12', 'Phone', 'Iphone 12', 100000, 'download.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `username` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_image` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `username`, `user_email`, `user_password`, `gender`, `city`, `contact`, `bio`, `user_image`) VALUES
(4, 'Severous Snape', 'snape@hogwarts.com', '$2y$10$4FuU.8EfNSK63.1roGXcXOJoDNYq1MwQrWe3q8351Yj.nMOYo34pe', 'Male', 'Delhi', '1234123400', 'Obliviate', '20.png'),
(5, 'Sirius Black', 'black@hogwarts.com', '$2y$10$cR0Te1RpxUMMPXPOvFTML.4kxtzbrZgh.VIl46M9K09Ki4m621UiW', 'Male', 'Bangalore', '1234123401', 'Expelliarmus', '19.png'),
(6, 'Albus Dumbeldore', 'albus@hogwarts.com', '$2y$10$fTBAtVzKrUk/loip4ako3.wKoAdIPTpF8lvo9AOH8cqal5.l0SMnS', 'Male', 'Goa', '1234123402', 'Lumos', '22.png'),
(7, 'John Denver', 'john@gmail.com', '$2y$10$kRaetpL.mNW4.m.1hohMhup4wZYu6Bbq63gD72tX3GyJM1d27xbCC', 'Male', 'Chennai', '1233123312', 'New user', '29.png'),
(8, 'Luna Lovegood', 'luna@hogwarts.com', '$2y$10$vsm.AbgBiMJKUwqdj6sH0.tbliI7F.w1iZgvz29jIeNbMgQlOgilG', 'Female', 'Chennai', '1212121212', 'Blah blah blah', '5.png'),
(9, 'Alicia Cox', 'alicia@hogwarts.com', '$2y$10$c0nRHzf3cSP1fr0EKBrVpeF4K/a/vmJkSzzI3Vj.aQ0MUS4kph1wK', 'Female', 'Goa', '1212121221', 'Blah blah blah', '7.png'),
(10, 'Nikita Singh', 'nikita@hogwarts.com', '$2y$10$mABjWrksLbdVvl9uyAaLR.kWdpCfrldzspD3P8tOSy.8uiqOEQhVu', 'Female', 'Mumbai', '1212345221', 'Blah blah blah Blah blah blah', '17.png'),
(11, 'Pranjali Gurnule', 'p@gmail.com', '$2y$10$fuVUhqdhACtlEj5QcltkJuhUm3mvkA67tftNqmVjuyC6gfn465xWW', 'Female', 'Mumbai', '0000000000', 'Blah Blah Blah', '10.png');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `vendorid` int(11) NOT NULL,
  `vendorname` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_image` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendorid`, `vendorname`, `vendor_email`, `vendor_password`, `city`, `address`, `contact`, `bio`, `vendor_image`) VALUES
(1, 'Shop test1', 'shop1@vendor.com', '$2y$10$0S1096UmxESzy1AO9Boc2Oj/CHUOeGlRw8nt.nyO2oA7gcRKDOaei', 'Mumbai', 'Shop 1 address.', '0000000000', 'blah blah blah.', '8.png'),
(5, 'Shop test2', 'shop2@vendor.com', '$2y$10$PlIVnCS2SHm4osDK/G52vuQGo2y8qGz0kWPokKR0u9BPp.d7sQ.wG', 'Mumbai', 'Shop test2 address.', '1231231231', 'Blah Blah Blah', '1.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `guideid` (`guideid`);

--
-- Indexes for table `friend_request`
--
ALTER TABLE `friend_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender` (`sender`),
  ADD KEY `receiver` (`receiver`);

--
-- Indexes for table `guide`
--
ALTER TABLE `guide`
  ADD PRIMARY KEY (`guideid`),
  ADD UNIQUE KEY `guide_email` (`guide_email`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productid`),
  ADD KEY `vendorid` (`vendorid`),
  ADD KEY `productid` (`productid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`vendorid`),
  ADD UNIQUE KEY `vendor_email` (`vendor_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `friend_request`
--
ALTER TABLE `friend_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `guide`
--
ALTER TABLE `guide`
  MODIFY `guideid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `vendorid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`guideid`) REFERENCES `guide` (`guideid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `friend_request`
--
ALTER TABLE `friend_request`
  ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`sender`) REFERENCES `users` (`userid`) ON DELETE CASCADE,
  ADD CONSTRAINT `request_ibfk_2` FOREIGN KEY (`receiver`) REFERENCES `guide` (`guideid`) ON DELETE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`vendorid`) REFERENCES `vendor` (`vendorid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
