-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2024 at 02:28 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

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

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`) VALUES
(1, 'admin', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2');

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`, `reference_number`, `order_status`) VALUES
(2, 1, 'Hazel Bino', '0949660318', 'hazelbino837@gmail.com', 'cash on delivery', '1, tuscano, Albay, Polangui, Balinad, 4506', 'Hatsu Soda (50 x 1) - ', 50, '2024-06-01', 'pending', '', 'to receive'),
(9, 1, 'Hazel Bino', '0949660318', 'hazelbino837@gmail.com', 'cash on delivery', '1, tuscano, Albay, Polangui, Balinad, 4506', 'Vita Drink (50 x 2) - ', 100, '2024-06-02', 'pending', '', 'to ship'),
(10, 1, 'Hazel Bino', '0949660318', 'hazelbino837@gmail.com', 'cash on delivery', '1, tuscano, Albay, Polangui, Balinad, 4506', 'Orange (150 x 1) - ', 150, '2024-06-02', 'pending', '', 'to ship'),
(12, 1, 'Hazel Bino', '0949660318', 'hazelbino837@gmail.com', 'gcash', '1, tuscano, Albay, Polangui, Balinad, 4506', 'Sun Puffs (25 x 1) - Hatsu Soda (50 x 1) - ', 75, '2024-06-02', 'completed', '09496603189', 'to ship'),
(14, 1, 'Hazel Bino', '0949660318', 'hazelbino837@gmail.com', 'cash on delivery', '1, tuscano, Albay, Polangui, Balinad, 4506', 'Hatsu Soda (50 x 1) - apple (25 x 1) - ', 75, '2024-06-02', 'pending', '', 'to ship'),
(15, 1, 'Hazel Bino', '0949660318', 'hazelbino837@gmail.com', 'cash on delivery', '1, tuscano, Albay, Polangui, Balinad, 4506', 'apple (25 x 1) - ', 25, '2024-06-02', 'pending', '', 'to ship'),
(16, 1, 'Hazel Bino', '0949660318', 'hazelbino837@gmail.com', 'cash on delivery', '1, tuscano, Albay, Polangui, Balinad, 4506', 'apple (25 x 1) - ', 25, '2024-06-02', 'pending', '', 'to ship'),
(17, 1, 'Hazel Bino', '0949660318', 'hazelbino837@gmail.com', 'cash on delivery', '1, tuscano, Albay, Polangui, Balinad, 4506', 'apple (25 x 1) - ', 25, '2024-06-02', 'pending', '', 'to ship'),
(18, 2, 'Ruffa Mae Nabor', '0977043572', 'ruffamaenabor@gmail.com', 'gcash', '1, cute, Albay, Guinobatan, Lomacao, 4503', 'Capsicum (50 x 1) - Apple (25 x 1) - Sun Puffs (25 x 1) - ', 100, '2024-06-03', 'pending', '111111111111', 'to ship'),
(19, 4, 'Krizia Alvarez', '0987654323', 'kriziaalvarez@gmail.com', 'gcash', '1, , Albay, Guinobatan, Lomacao, 4503', 'Capsicum (50 x 2) - Hatsu Soda (50 x 6) - ', 400, '2024-06-03', 'completed', '555555555555555', 'delivered'),
(20, 4, 'Krizia Alvarez', '0987654323', 'kriziaalvarez@gmail.com', 'cash on delivery', '1, , Albay, Guinobatan, Lomacao, 4503', 'Hatsu Soda (50 x 1) - ', 50, '2024-06-03', 'pending', '', 'to ship'),
(21, 4, 'Krizia Alvarez', '0987654323', 'kriziaalvarez@gmail.com', 'gcash', '1, , Albay, Guinobatan, Lomacao, 4503', 'Capsicum (50 x 2) - Hatsu Soda (50 x 6) - ', 400, '2024-06-03', 'pending', '7777777777777', 'to ship'),
(22, 4, 'Krizia Alvarez', '0987654323', 'kriziaalvarez@gmail.com', 'gcash', '1, , Albay, Guinobatan, Lomacao, 4503', 'Capsicum (50 x 2) - Hatsu Soda (50 x 6) - ', 400, '2024-06-03', 'pending', '7777777777777', 'to ship'),
(23, 4, 'Krizia Alvarez', '0987654323', 'kriziaalvarez@gmail.com', 'gcash', '1, , Albay, Guinobatan, Lomacao, 4503', 'Capsicum (50 x 2) - Hatsu Soda (50 x 6) - ', 400, '2024-06-03', 'pending', '7777777777777', 'to ship'),
(24, 4, 'Krizia Alvarez', '0987654323', 'kriziaalvarez@gmail.com', 'gcash', '1, , Albay, Guinobatan, Lomacao, 4503', 'Capsicum (50 x 2) - Hatsu Soda (50 x 6) - ', 400, '2024-06-03', 'pending', '7777777777777', 'to ship'),
(25, 4, 'Krizia Alvarez', '0987654323', 'kriziaalvarez@gmail.com', 'cash on delivery', '1, , Albay, Guinobatan, Lomacao, 4503', 'Pocky (85 x 23) - ', 1955, '2024-06-03', 'pending', '', 'to ship'),
(26, 4, 'Krizia Alvarez', '0987654323', 'kriziaalvarez@gmail.com', 'cash on delivery', '1, , Albay, Guinobatan, Lomacao, 4503', 'Capsicum (50 x 4) - ', 200, '2024-06-03', 'pending', '', 'to ship'),
(27, 4, 'Krizia Alvarez', '0987654323', 'kriziaalvarez@gmail.com', 'gcash', '1, , Albay, Guinobatan, Lomacao, 4503', 'Capsicum (50 x 8) - ', 400, '2024-06-03', 'pending', 'uuuuuuuuuuu', 'to ship'),
(28, 4, 'Krizia Alvarez', '0987654323', 'kriziaalvarez@gmail.com', 'cash on delivery', '1, , Albay, Guinobatan, Lomacao, 4503', 'Capsicum (50 x 1) - Hatsu Soda (50 x 1) - ', 100, '2024-06-03', 'pending', '', 'to ship'),
(29, 4, 'Krizia Alvarez', '0987654323', 'kriziaalvarez@gmail.com', 'cash on delivery', '1, , Albay, Guinobatan, Lomacao, 4503', 'Capsicum (50 x 5) - ', 250, '2024-06-03', 'pending', '', 'to ship'),
(30, 4, 'Krizia Alvarez', '0987654323', 'kriziaalvarez@gmail.com', 'cash on delivery', '1, , Albay, Guinobatan, Lomacao, 4503', 'Capsicum (50 x 1) - Hatsu Soda (50 x 1) - Sun Puffs (25 x 1) - ', 125, '2024-06-03', 'pending', '', 'to ship'),
(31, 2, 'Ruffa Mae Nabor', '0977043572', 'ruffamaenabor@gmail.com', 'cash on delivery', '1, , Albay, Guinobatan, Lomacao, 4503', 'Capsicum (50 x 3) - Hatsu Soda (50 x 1) - Sun Puffs (25 x 6) - Vita Drink (50 x 6) - Apple (25 x 1) - ', 675, '2024-06-03', 'pending', '', 'to ship'),
(32, 2, 'Ruffa Mae Nabor', '0977043572', 'ruffamaenabor@gmail.com', 'cash on delivery', '1, , Albay, Guinobatan, Lomacao, 4503', 'Capsicum (50 x 1) - Hatsu Soda (50 x 1) - Sun Puffs (25 x 1) - ', 125, '2024-06-03', 'pending', '', 'to ship'),
(33, 2, 'Ruffa Mae Nabor', '0977043572', 'ruffamaenabor@gmail.com', 'cash on delivery', '1, , Albay, Guinobatan, Lomacao, 4503', 'Capsicum (50 x 1) - ', 50, '2024-06-03', 'pending', '', 'to ship'),
(34, 2, 'Ruffa Mae Nabor', '0977043572', 'ruffamaenabor@gmail.com', 'cash on delivery', '1, , Albay, Guinobatan, Lomacao, 4503', 'Capsicum (50 x 1) - ', 50, '2024-06-03', 'completed', '', 'delivered'),
(35, 2, 'Ruffa Mae Nabor', '0977043572', 'ruffamaenabor@gmail.com', 'cash on delivery', '1, , Albay, Guinobatan, Lomacao, 4503', 'Water Melon (100 x 13) - ', 1300, '2024-06-03', 'pending', '', 'to ship'),
(36, 2, 'Ruffa Mae Nabor', '0977043572', 'ruffamaenabor@gmail.com', 'cash on delivery', '1, , Albay, Guinobatan, Lomacao, 4503', 'Capsicum (50 x 1) - ', 50, '2024-06-03', 'pending', '', 'to ship'),
(37, 2, 'Ruffa Mae Nabor', '0977043572', 'ruffamaenabor@gmail.com', 'cash on delivery', '1, , Albay, Guinobatan, Lomacao, 4503', 'Capsicum (50 x 1) - ', 50, '2024-06-03', 'pending', '', 'to ship'),
(38, 2, 'Ruffa Mae Nabor', '0977043572', 'ruffamaenabor@gmail.com', 'cash on delivery', '1, , Albay, Guinobatan, Lomacao, 4503', 'Sun Puffs (25 x 1) - Pocky (85 x 1) - ', 110, '2024-06-04', 'completed', '', 'delivered'),
(39, 2, 'Ruffa Mae Nabor', '0977043572', 'ruffamaenabor@gmail.com', 'cash on delivery', '1, , Albay, Guinobatan, Lomacao, 4503', 'Capsicum (50 x 10) - ', 500, '2024-06-04', 'pending', '', 'to ship'),
(40, 2, 'Ruffa Mae Nabor', '0977043572', 'ruffamaenabor@gmail.com', 'cash on delivery', '1, , Albay, Guinobatan, Lomacao, 4503', 'Capsicum (50 x 1) - ', 50, '2024-06-04', 'pending', '', 'to ship'),
(41, 2, 'Ruffa Mae Nabor', '0977043572', 'ruffamaenabor@gmail.com', 'cash on delivery', '1, , Albay, Guinobatan, Lomacao, 4503', 'Capsicum (50 x 1) - ', 50, '2024-06-04', 'pending', '', 'to ship'),
(42, 2, 'Ruffa Mae Nabor', '0977043572', 'ruffamaenabor@gmail.com', 'gcash', '1, , Albay, Guinobatan, Lomacao, 4503', 'Capsicum (50 x 19) - Sun Puffs (25 x 5) - ', 1075, '2024-06-04', 'pending', '859686856858', 'to ship'),
(43, 2, 'Ruffa Mae Nabor', '0977043572', 'ruffamaenabor@gmail.com', 'cash on delivery', '1, , Albay, Guinobatan, Lomacao, 4503', 'Capsicum (50 x 9) - ', 450, '2024-06-04', 'pending', '', 'to ship');

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `price`, `image`, `date_added`, `status`, `stocks`) VALUES
(6, 'Capsicum', 'Vegetables', 50, 'capsicum.png', '2024-06-01', 'available', 487),
(11, 'Hatsu Soda', 'Beverages', 50, 'Hatsu Soda.png', '2024-06-03', 'available', 0),
(12, 'Sun Puffs', 'Snacks', 25, 'Sun Puffs.jpg', '2024-06-03', 'available', 35),
(13, 'Orange', 'Fruits', 150, 'orange.png', '2024-06-03', 'available', 200),
(14, 'Apple', 'Fruits', 25, 'apple.png', '2024-06-03', 'available', 494),
(15, 'Vita Drink', 'Beverages', 50, 'Vita Drink.png', '2024-06-03', 'available', 100),
(16, 'Chinese Cabbage', 'Vegetables', 200, 'Chinese_Cabbage.jpg', '2024-06-03', 'available', 10000),
(17, 'Pocky', 'Snacks', 85, 'pk.png', '2024-06-03', 'available', 78),
(18, 'Banana', 'Fruits', 50, 'benene.png', '2024-06-03', 'available', 1000),
(19, 'Carrots', 'Vegetables', 200, 'carrots.png', '2024-06-03', 'available', 20000),
(20, 'Eggplant', 'Vegetables', 90, 'eggplant.png', '2024-06-03', 'available', 200),
(21, 'Fanta', 'Beverages', 50, 'fanta.png', '2024-06-03', 'available', 400),
(22, 'Sprite', 'Beverages', 30, 'sprite.png', '2024-06-03', 'available', 20),
(23, 'Water Melon', 'Fruits', 100, 'watermelon.png', '2024-06-03', 'available', 8),
(24, 'Cheetos', 'Snacks', 25, 'cheetos.jpg', '2024-06-03', 'available', 100);

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `name`, `email`, `reviews`) VALUES
(6, 2, 'Ruffa Mae', 'ruffamaenabor@gmail.com', 'HEYYYYYYYYY'),
(7, 3, 'Cyra Nas', 'cyranas@gmail.com', 'wazuppppppppp'),
(8, 4, 'Krizia Alvarez', 'kriziaalvarez@gmail.com', 'waazuppppppp');

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `number`, `password`, `address`) VALUES
(1, 'Hazel Bino', 'hazelbino837@gmail.com', '0949660318', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '1, tuscano, Albay, Polangui, Balinad, 4506'),
(2, 'Ruffa Mae Nabor', 'ruffamaenabor@gmail.com', '0977043572', '7c4a8d09ca3762af61e59520943dc26494f8941b', '1, , Albay, Guinobatan, Lomacao, 4503'),
(3, 'Cyra Nas', 'cyranas@gmail.com', '0988765432', '31ace4ad1831aae866cd7951a842ca3e38f21981', ''),
(4, 'Krizia Alvarez', 'kriziaalvarez@gmail.com', '0987654323', '4e03a774654dc40c978157615cfb7e97df3915aa', '1, , Albay, Guinobatan, Lomacao, 4503');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
