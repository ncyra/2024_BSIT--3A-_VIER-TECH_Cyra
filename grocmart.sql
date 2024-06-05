-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2024 at 09:18 PM
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
-- Database: `grocmart_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`) VALUES
(1, 'admin', '111');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` date NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending',
  `reference_number` varchar(255) NOT NULL,
  `order_status` enum('to ship','to receive','delivered','cancelled') NOT NULL DEFAULT 'to ship',
  `account_number` int(20) NOT NULL,
  `account_name` varchar(50) NOT NULL,
  `amount_paid` int(50) NOT NULL,
  `archived` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`, `reference_number`, `order_status`, `account_number`, `account_name`, `amount_paid`, `archived`) VALUES
(2, 1, 'Hazel Bino', '0949660318', 'hazelbino837@gmail.com', 'cash on delivery', '1, tuscano, Albay, Polangui, Balinad, 4506', 'Hatsu Soda (50 x 1) - ', 50, '2024-06-01', 'pending', '', 'to receive', 0, '', 0, 0),
(9, 1, 'Hazel Bino', '0949660318', 'hazelbino837@gmail.com', 'cash on delivery', '1, tuscano, Albay, Polangui, Balinad, 4506', 'Vita Drink (50 x 2) - ', 100, '2024-06-02', 'pending', '', 'to ship', 0, '', 0, 0),
(10, 1, 'Hazel Bino', '0949660318', 'hazelbino837@gmail.com', 'cash on delivery', '1, tuscano, Albay, Polangui, Balinad, 4506', 'Orange (150 x 1) - ', 150, '2024-06-02', 'pending', '', 'to ship', 0, '', 0, 0),
(12, 1, 'Hazel Bino', '0949660318', 'hazelbino837@gmail.com', 'gcash', '1, tuscano, Albay, Polangui, Balinad, 4506', 'Sun Puffs (25 x 1) - Hatsu Soda (50 x 1) - ', 75, '2024-06-02', 'completed', '09496603189', 'to ship', 0, '', 0, 0),
(14, 1, 'Hazel Bino', '0949660318', 'hazelbino837@gmail.com', 'cash on delivery', '1, tuscano, Albay, Polangui, Balinad, 4506', 'Hatsu Soda (50 x 1) - apple (25 x 1) - ', 75, '2024-06-02', 'pending', '', 'to ship', 0, '', 0, 0),
(15, 1, 'Hazel Bino', '0949660318', 'hazelbino837@gmail.com', 'cash on delivery', '1, tuscano, Albay, Polangui, Balinad, 4506', 'apple (25 x 1) - ', 25, '2024-06-02', 'pending', '', 'to ship', 0, '', 0, 0),
(16, 1, 'Hazel Bino', '0949660318', 'hazelbino837@gmail.com', 'cash on delivery', '1, tuscano, Albay, Polangui, Balinad, 4506', 'apple (25 x 1) - ', 25, '2024-06-02', 'pending', '', 'to ship', 0, '', 0, 0),
(17, 1, 'Hazel Bino', '0949660318', 'hazelbino837@gmail.com', 'cash on delivery', '1, tuscano, Albay, Polangui, Balinad, 4506', 'apple (25 x 1) - ', 25, '2024-06-02', 'pending', '', 'to ship', 0, '', 0, 0),
(18, 2, 'eyy', '6394966031', 'yow@gmail.com', 'gcash', '1, 5, albay, polangui, Balinad, 4506', 'apple (25 x 1) - ', 25, '2024-06-05', 'pending', '1223434', 'to ship', 0, 'pupapips', 25, 0),
(19, 2, 'eyy', '6394966031', 'yow@gmail.com', 'cash on delivery', '1, 5, albay, polangui, Balinad, 4506', 'apple (25 x 1) - ', 25, '2024-06-05', 'pending', '', 'to ship', 0, '', 0, 0),
(20, 2, 'eyy', '6394966031', 'yow@gmail.com', 'gcash', '1, 5, albay, polangui, Balinad, 4506', 'apple (25 x 1) - ', 25, '2024-06-05', 'pending', '1223434', 'to ship', 976555678, 'pupapips', 25, 0),
(21, 2, 'eyy', '6394966031', 'yow@gmail.com', 'gcash', '1, 5, albay, polangui, Balinad, 4506', 'apple (25 x 1) - ', 25, '2024-06-05', 'pending', '1223434', 'to ship', 976555678, 'pupapips', 25, 0),
(22, 2, 'eyy', '6394966031', 'yow@gmail.com', 'gcash', '1, 5, albay, polangui, Balinad, 4506', 'Chinese Cabbage (200 x 1) - ', 200, '2024-06-05', 'pending', '1223434', 'to ship', 976555678, 'pupapips', 200, 0),
(23, 2, 'eyy', '6394966031', 'yow@gmail.com', 'cash on delivery', '1, 5, albay, polangui, Balinad, 4506', 'Fanta (25 x 1) - ', 25, '2024-06-05', 'pending', '', 'to ship', 0, '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `image` varchar(100) NOT NULL,
  `date_added` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(10) NOT NULL DEFAULT 'available',
  `stocks` int(30) NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `price`, `image`, `date_added`, `status`, `stocks`, `description`) VALUES
(3, 'Chinese Cabbage', 'Vegetables', 200, 'Chinese Cabbage.jpg', '2024-06-01', 'sold out', 0, ''),
(4, 'Hatsu Soda', 'Beverages', 50, 'Hatsu Soda.png', '2024-06-01', 'available', 0, ''),
(5, 'Sun Puffs', 'Snacks', 25, 'Sun Puffs.jpg', '2024-06-01', 'available', 0, ''),
(6, 'Capsicum', 'Vegetables', 50, 'capsicum.png', '2024-06-01', 'available', 0, ''),
(7, 'Vita Drink', 'Beverages', 50, 'Vita Drink.png', '2024-06-01', 'available', 0, ''),
(8, 'Orange', 'Fruits', 150, 'orange.png', '2024-06-01', 'available', 0, ''),
(9, 'apple', 'Fruits', 25, 'apple.png', '2024-06-02', 'available', 100, ''),
(10, 'Corn', 'Fruits', 50, 'corn.png', '2024-06-05', 'available', 100, ''),
(11, 'Fanta', 'Beverages', 25, 'fanta.png', '2024-06-05', 'available', 100, ''),
(12, 'Eggplant', 'Vegetables', 120, 'eggplant.png', '2024-06-05', 'available', 100, ''),
(13, 'Cheetos', 'Snacks', 20, 'cheetos.jpg', '2024-06-05', 'available', 100, ''),
(14, 'Pocky', 'Snacks', 50, 'pk.png', '2024-06-05', 'available', 100, ''),
(15, 'Instant Noodles', 'Snacks', 50, 'Instant Noodles.jpg', '2024-06-05', 'available', 100, ''),
(16, 'Cup Noodles', 'Snacks', 50, 'Cup Noodles.jpg', '2024-06-05', 'available', 100, '');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `reviews` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `name`, `email`, `reviews`) VALUES
(1, 0, 'Hazel Bino', 'hazelbino837@gmail.com', 'nice service!');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `number`, `password`, `address`) VALUES
(1, 'Hazel Bino', 'hazelbino837@gmail.com', '0949660318', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '1, tuscano, Albay, Polangui, Balinad, 4506'),
(2, 'eyy', 'yow@gmail.com', '6394966031', '123', '1, 5, albay, polangui, Balinad, 4506');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
