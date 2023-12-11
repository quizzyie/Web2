-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2023 at 01:50 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `do_an_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `resipient_name` varchar(50) DEFAULT NULL,
  `resipient_phonenumber` varchar(20) DEFAULT NULL,
  `delivery_address` varchar(100) DEFAULT NULL,
  `note` varchar(100) DEFAULT NULL,
  `id_order_status` int(11) NOT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`id`, `user_id`, `resipient_name`, `resipient_phonenumber`, `delivery_address`, `note`, `id_order_status`, `create_at`, `update_at`) VALUES
(5, 9, 'MinhLam', '0987654321', 'tuy phuoc binh dinh', 'ok', 4, '2023-03-29 19:23:42', '2023-04-10 15:43:45'),
(6, 10, 'Tienhai', '0987982144', 'q8 tphcm', 'ok', 6, '2023-01-22 19:24:11', '2023-03-30 08:28:42'),
(11, 3, 'haile', '0987654321', 'ok !', 'huy don vi mot so li do', 2, '2023-01-29 21:16:53', '2023-04-17 13:24:45'),
(13, 3, 'Tien Hai Le', '0987982144', '', 'dang giao', 5, '2023-04-14 09:52:11', '2023-04-17 13:25:02'),
(14, 3, 'Tien Hai Le', '0987982144', '', '', 1, '2023-04-14 10:04:43', NULL),
(15, 3, 'Tien Hai Le', '0987982144', 'Biinh Dinh Viet Nam', '', 4, '2023-04-14 10:59:27', NULL),
(16, 3, 'Tien Hai Le', '0987982144', 'viet nam viet na', '', 4, '2023-04-14 11:00:17', NULL),
(17, 3, 'Tien Hai Le', '0987982144', 'viet nam viet na', 'chu y', 4, '2023-04-14 11:01:53', '2023-04-17 13:25:15'),
(18, 3, 'Tien Hai Le', '0987982144', 'sdfaaaaaaaaafdasfd', '', 4, '2023-04-14 15:57:35', NULL),
(19, 9, 'Minh Lam ', '0987654321', 'Tuy phuoc binh dinh', '', 1, '2023-05-07 20:07:46', NULL),
(20, 37, 'Le Tien Hai', '0987654321', 'Ho Chi Minh Viet Nam', 'ok', 6, '2023-05-07 22:12:40', '2023-05-07 23:03:23'),
(21, 37, 'Le Tien Hai', '0987654321', 'Ho Chi Minh Viet Nam', 'nguoi dung tu y huy', 6, '2023-05-07 23:13:07', '2023-05-07 23:15:43'),
(22, 10, 'Le Tien Hai', '0987654321', 'Ho Chi Minh Viet Nam', '.', 1, '2023-05-08 09:54:55', NULL),
(23, 9, 'Le Tien Hai', '0987654321', 'Ho Chi Minh Viet Nam', '.', 6, '2023-05-08 09:55:55', '2023-05-08 10:19:53'),
(24, 9, 'Le Tien Hai', '0987654321', 'Ho Chi Minh Viet Nam', '', 1, '2023-05-08 11:17:41', NULL),
(25, 9, 'Le Tien Hai', '0987654321', 'Ho Chi Minh Viet Nam', '', 1, '2023-05-08 11:22:55', NULL),
(26, 9, 'Le Tien Hai', '0987654321', 'Ho Chi Minh Viet Nam', '', 1, '2023-05-08 11:31:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bill_detail`
--

CREATE TABLE `bill_detail` (
  `id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `total` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bill_detail`
--

INSERT INTO `bill_detail` (`id`, `bill_id`, `product_id`, `size_id`, `total`, `quantity`) VALUES
(8, 5, 1, 3, 600, 2),
(9, 5, 8, 6, 2800, 4),
(10, 6, 7, 1, 6000, 5),
(11, 5, 12, 2, 200, 2),
(14, 6, 7, 3, 4800, 4),
(17, 5, 13, 4, 49000, 10),
(20, 11, 2, 2, 15000, 30),
(21, 11, 8, 3, 10500, 15),
(22, 11, 11, 4, 2000, 10),
(27, 13, 2, 2, 46500, 93),
(28, 13, 12, 2, 100, 1),
(29, 15, 12, 3, 500, 5),
(30, 16, 12, 5, 100, 1),
(31, 17, 12, 3, 100, 1),
(32, 18, 2, 2, 4000, 8),
(33, 18, 2, 3, 500, 1),
(34, 18, 2, 4, 500, 1),
(35, 18, 12, 3, 100, 1),
(36, 19, 2, 4, 500, 1),
(37, 20, 1, 3, 5400, 18),
(38, 20, 2, 2, 500, 1),
(39, 21, 1, 2, 5400, 18),
(40, 21, 2, 2, 4000, 8),
(41, 22, 2, 3, 500, 1),
(42, 23, 2, 1, 500, 1),
(43, 23, 2, 2, 500, 1),
(44, 23, 2, 3, 500, 1),
(45, 23, 12, 4, 900, 9),
(46, 23, 12, 6, 1200, 12),
(47, 24, 28, 4, 2800, 4),
(48, 24, 36, 2, 3000, 5),
(49, 24, 37, 4, 4800, 4),
(50, 24, 38, 4, 32000, 8),
(51, 25, 22, 3, 500, 1),
(52, 25, 27, 3, 4800, 4),
(53, 25, 35, 3, 9000, 3),
(54, 26, 7, 5, 21600, 18);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `image`, `create_at`, `update_at`) VALUES
(1, 'Addidas', 'adidas.jpg', '2023-03-20 13:30:00', '2023-03-27 14:58:38'),
(2, 'Nike', 'nike.jpg', '2023-03-20 13:30:00', '2023-03-20 13:30:00'),
(3, 'Puma', 'puma.jpg', '2023-03-20 13:30:00', '2023-03-20 13:30:00'),
(4, 'Gucci', 'gucci.jpg', '2023-03-20 13:30:00', '2023-03-20 13:30:00'),
(5, 'Reebok', 'reebok.jpg', '2023-03-20 13:30:00', '2023-03-20 13:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `amount`, `size_id`, `created_at`) VALUES
(41, 3, 5, 1, 5, '2023-04-24 07:19:23');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`, `create_at`, `update_at`) VALUES
(1, 'Áo Thun', 'adidas-d2m-3s-gm2135-1.jpg', '2023-03-20 13:30:00', '2023-03-20 13:30:00'),
(2, 'Áo Hoodie', 'images/sp3/ao-hoodie-lifestyle-nam-adidas-hl6925-1.jpg', '2023-03-20 13:30:00', '2023-03-27 14:59:53'),
(3, 'Áo Sơ Mi', 'images/categories/ao-thun-lifestyle-nam-puma-classics-logo-metallic-534711-01-1.jpg', '2023-03-20 13:30:00', '2023-03-27 15:00:33'),
(4, 'Áo Polo', 'images/categories/nike-dq1011-824-1.jpg', '2023-03-20 13:30:00', '2023-03-27 15:00:17'),
(15, 'Áo khoác', 'images/categories/ao-hoodie-lifestyle-nam-adidas-hl6925-1.jpg', '2023-03-29 16:39:38', '2023-03-30 16:30:10');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '1:Chưa xử lý 2:Đang xử lý 3:Đã xử lý',
  `note` text DEFAULT NULL,
  `create_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `message`, `status`, `note`, `create_at`) VALUES
(2, 'TienHai', 'tienhai488@gmai.com', 'Vui lòng liên hệ với chúng tôi', 1, 'Chưa xử lý', '2023-04-02 11:06:44'),
(3, 'MinhLam', 'minhlam@gmal.com', 'chung tôi đâ đen day', 1, 'Chưa xử lý', '2023-04-02 11:07:23'),
(5, 'TIenhai', 'tienhaile488@gmail.com', 'chao buoi toi', 1, 'Chưa xử lý', '2023-05-07 23:21:21'),
(6, 'Tienhai', 'tienhaile488@gmail.com', 'cahho buoi sang', 1, 'Chưa xử lý', '2023-05-07 23:23:51'),
(7, 'tienhai', 'tienhaile488@gmail.com', 'chao buoi san', 1, 'Chưa xử lý', '2023-05-07 23:24:10'),
(8, 'tienhai', 'tienhaile488@gmail.com', 'chao buoi sang', 1, 'Chưa xử lý', '2023-05-07 23:24:31'),
(9, 'tienhai', 'tienhaile488@gmail.com', 'chao dfsfdasfsad', 1, 'Chưa xử lý', '2023-05-07 23:24:52'),
(10, 'hai tien', 'tienhaile488@gmail.com', 'daffffffffff', 1, 'Chưa xử lý', '2023-05-07 23:25:46');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `permission` text DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `permission`, `create_at`, `update_at`) VALUES
(2, 'Người dùng', '{\"groups\":[\"view\",\"add\",\"update\",\"delete\"],\"products\":[\"view\",\"add\"],\"users\":[\"view\",\"add\"],\"bill\":[\"view\",\"update\"]}', '2023-03-17 11:18:31', '2023-03-26 21:43:20'),
(3, 'Xử lý đơn hàng', NULL, '2023-03-17 11:18:43', '2023-03-26 21:09:57'),
(5, 'Quản lý ', '{\"groups\":[\"view\"],\"products\":[\"add\"],\"users\":[\"update\"],\"bill\":[\"view\",\"update\"]}', '2023-03-17 11:19:13', '2023-03-26 21:03:40'),
(7, 'Nhân Viên', '{\"groups\":[\"update\"],\"users\":[\"add\"],\"bill\":[\"update\"],\"contacts\":[\"update\"],\"reviews\":[\"update\",\"delete\"]}', '2023-04-01 17:56:34', '2023-05-06 10:49:33'),
(8, 'Admin', '{\"groups\":[\"add\",\"update\",\"delete\",\"permission\"],\"products\":[\"add\",\"update\",\"delete\"],\"users\":[\"add\",\"update\",\"delete\"],\"bill\":[\"update\"],\"contacts\":[\"update\",\"delete\"],\"reviews\":[\"update\",\"delete\"],\"options\":[\"update\"],\"dashboard\":[\"view\"]}', '2023-04-01 20:31:31', '2023-04-02 08:59:41'),
(10, 'Bán hàng', NULL, '2023-05-08 10:07:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `id_product`, `image`, `create_at`, `update_at`) VALUES
(1, 1, 'images/product_image/adidas-d2m-3s-gm2135-2.jpg', '2023-03-29 22:04:45', NULL),
(2, 1, 'images/product_image/adidas-d2m-3s-gm2135-3.jpg', '2023-03-29 22:04:45', NULL),
(3, 1, 'images/product_image/adidas-d2m-3s-gm2135-4.jpg', '2023-03-29 22:04:45', NULL),
(4, 1, 'images/product_image/adidas-d2m-3s-gm2135-5.jpg', '2023-03-29 22:04:45', NULL),
(22, 21, 'images/product_image/adidas-d2m-3s-gm2135-2.jpg', '2023-03-29 22:04:45', NULL),
(23, 21, 'images/product_image/adidas-d2m-3s-gm2135-3.jpg', '2023-03-29 22:04:45', NULL),
(24, 21, 'images/product_image/adidas-d2m-3s-gm2135-4.jpg', '2023-03-29 22:04:45', NULL),
(25, 21, 'images/product_image/adidas-d2m-3s-gm2135-5.jpg', '2023-03-29 22:04:45', NULL),
(26, 34, 'images/sp4/reebok-re-basic-ss-tee-hm2865-2.jpg', '2023-05-07 21:40:00', NULL),
(27, 34, 'images/sp4/reebok-re-basic-ss-tee-hm2865-3.jpg', '2023-05-07 21:40:00', NULL),
(28, 34, 'images/sp4/reebok-re-basic-ss-tee-hm2865-4.jpg', '2023-05-07 21:40:00', NULL),
(29, 35, 'images/sp6/ao-so-mi-coc-tay-adidas-originals-hs9471-mau-den-xam-2.jpg', '2023-05-07 21:46:30', NULL),
(30, 35, 'images/sp6/ao-so-mi-coc-tay-adidas-originals-hs9471-mau-den-xam-3.jpg', '2023-05-07 21:46:30', NULL),
(31, 35, 'images/sp6/ao-so-mi-coc-tay-adidas-originals-hs9471-mau-den-xam-4.jpg', '2023-05-07 21:46:30', NULL),
(32, 36, 'images/sp7/nike-dq1011-824-2.jpg', '2023-05-07 21:48:52', NULL),
(33, 36, 'images/sp7/nike-dq1011-824-3.jpg', '2023-05-07 21:48:52', NULL),
(34, 36, 'images/sp7/nike-dq1011-824-4.jpg', '2023-05-07 21:48:52', NULL),
(35, 25, 'images/sp8/ao-hoodie-adidas-tokyo-brand-carrier-pullover-h64727-mau-den-size-l-2.jpg', '2023-05-07 21:51:28', NULL),
(36, 25, 'images/sp8/ao-hoodie-adidas-tokyo-brand-carrier-pullover-h64727-mau-den-size-l-3.jpg', '2023-05-07 21:51:28', NULL),
(37, 25, 'images/sp8/ao-hoodie-adidas-tokyo-brand-carrier-pullover-h64727-mau-den-size-l-4.jpg', '2023-05-07 21:51:28', NULL),
(38, 33, 'images/sp9/ao-ba-lo-chay-bo-nam-nike-cz9180-010-2.jpg', '2023-05-07 21:53:38', NULL),
(39, 33, 'images/sp9/ao-ba-lo-chay-bo-nam-nike-cz9180-010-3.jpg', '2023-05-07 21:53:38', NULL),
(40, 33, 'images/sp9/ao-ba-lo-chay-bo-nam-nike-cz9180-010-4.jpg', '2023-05-07 21:53:38', NULL),
(41, 32, 'images/sp10/adidas-m-ti-tee-hc2760-den-2.jpg', '2023-05-07 21:55:07', NULL),
(42, 32, 'images/sp10/adidas-m-ti-tee-hc2760-den-3.jpg', '2023-05-07 21:55:07', NULL),
(43, 32, 'images/sp10/adidas-m-ti-tee-hc2760-den-4.jpg', '2023-05-07 21:55:07', NULL),
(44, 31, 'images/sp11/ao-thun-lifestyle-nam-adidas-m-feelcozy-swt-h12221-2.jpg', '2023-05-07 21:57:06', NULL),
(45, 31, 'images/sp11/ao-thun-lifestyle-nam-adidas-m-feelcozy-swt-h12221-3.jpg', '2023-05-07 21:57:06', NULL),
(46, 31, 'images/sp11/ao-thun-lifestyle-nam-adidas-m-feelcozy-swt-h12221-4.jpg', '2023-05-07 21:57:06', NULL),
(47, 30, 'images/sp12/ao-polo-gucci-with-pocket-713997-xjetr-9088-mau-trang-2.jpg', '2023-05-07 21:59:14', NULL),
(48, 30, 'images/sp12/ao-polo-gucci-with-pocket-713997-xjetr-9088-mau-trang-3.jpg', '2023-05-07 21:59:14', NULL),
(49, 30, 'images/sp12/ao-polo-gucci-with-pocket-713997-xjetr-9088-mau-trang-4.jpg', '2023-05-07 21:59:14', NULL),
(50, 29, 'images/sp13/ao-nike-sportswear-men-s-hoodie-midnight-navy-cw4319-400-mau-xanh-navy-2.jpg', '2023-05-07 22:02:43', NULL),
(51, 29, 'images/sp13/ao-nike-sportswear-men-s-hoodie-midnight-navy-cw4319-400-mau-xanh-navy-3.jpg', '2023-05-07 22:02:43', NULL),
(52, 29, 'images/sp13/ao-nike-sportswear-men-s-hoodie-midnight-navy-cw4319-400-mau-xanh-navy-4.jpg', '2023-05-07 22:02:43', NULL),
(56, 27, 'images/sp15/ao-hoodie-puma-power-knit-trainning-hoodie-black-518978-01-mau-den-size-m-2.jpg', '2023-05-07 22:05:45', NULL),
(57, 27, 'images/sp15/ao-hoodie-puma-power-knit-trainning-hoodie-black-518978-01-mau-den-size-m-3.jpg', '2023-05-07 22:05:45', NULL),
(58, 27, 'images/sp15/ao-hoodie-puma-power-knit-trainning-hoodie-black-518978-01-mau-den-size-m-4.jpg', '2023-05-07 22:05:45', NULL),
(59, 28, 'images/sp14/ao-thun-lifestyle-nam-nike-dr8055-100-1.jpg', '2023-05-07 22:06:33', NULL),
(60, 28, 'images/sp14/ao-thun-lifestyle-nam-nike-dr8055-100-2.jpg', '2023-05-07 22:06:33', NULL),
(61, 28, 'images/sp14/ao-thun-lifestyle-nam-nike-dr8055-100-3.jpg', '2023-05-07 22:06:33', NULL),
(62, 26, 'images/sp16/ao-hoodie-lifestyle-nam-adidas-hl6925-2.jpg', '2023-05-07 22:07:57', NULL),
(63, 26, 'images/sp16/ao-hoodie-lifestyle-nam-adidas-hl6925-3.jpg', '2023-05-07 22:07:57', NULL),
(64, 26, 'images/sp16/ao-hoodie-lifestyle-nam-adidas-hl6925-4.jpg', '2023-05-07 22:07:57', NULL),
(65, 23, 'images/sp17/adidas-m-ti-tee-hc2760-den-2.jpg', '2023-05-07 22:09:18', NULL),
(66, 23, 'images/sp17/adidas-m-ti-tee-hc2760-den-3.jpg', '2023-05-07 22:09:18', NULL),
(67, 23, 'images/sp17/adidas-m-ti-tee-hc2760-den-4.jpg', '2023-05-07 22:09:18', NULL),
(68, 22, 'images/sp18/adidas-d4r-tee-men-hk7117-2.jpg', '2023-05-07 22:10:46', NULL),
(69, 22, 'images/sp18/adidas-d4r-tee-men-hk7117-3.jpg', '2023-05-07 22:10:46', NULL),
(70, 22, 'images/sp18/adidas-d4r-tee-men-hk7117-4.jpg', '2023-05-07 22:10:46', NULL),
(71, 37, 'images/sp19/ao-nike-sportswear-men-s-pullover-hoodie-tokyo-color-cw0308-100-mau-trang-2.jpg', '2023-05-07 22:15:11', NULL),
(72, 37, 'images/sp19/ao-nike-sportswear-men-s-pullover-hoodie-tokyo-color-cw0308-100-mau-trang-3.jpg', '2023-05-07 22:15:11', NULL),
(73, 37, 'images/sp19/ao-nike-sportswear-men-s-pullover-hoodie-tokyo-color-cw0308-100-mau-trang-4.jpg', '2023-05-07 22:15:11', NULL),
(74, 38, 'images/sp20/ao-so-mi-gucci-white-cotton-snake-embroidered-collar-duke-shirt-4.jpg', '2023-05-07 22:18:10', NULL),
(75, 38, 'images/sp20/ao-so-mi-gucci-white-cotton-snake-embroidered-collar-duke-shirt-3.jpg', '2023-05-07 22:18:10', NULL),
(76, 38, 'images/sp20/ao-so-mi-gucci-white-cotton-snake-embroidered-collar-duke-shirt-1.jpg', '2023-05-07 22:18:10', NULL),
(78, 39, 'images/sp14/team-4.jpg', '2023-05-08 14:10:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `login_token`
--

CREATE TABLE `login_token` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `token` text DEFAULT NULL,
  `create_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login_token`
--

INSERT INTO `login_token` (`id`, `user_id`, `token`, `create_at`) VALUES
(234, 9, '58e6904b813511f21b70843e15817ec89b03f5f3', '2023-09-12 16:52:40'),
(286, 3, '20474106a24ae4e0a31c367c688997917ca021b4', '2023-12-11 19:48:02');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `name` varchar(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `actions` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`name`, `title`, `actions`) VALUES
('groups', 'Nhóm người dùng', '{\"add\":\"Thêm\",\"update\":\"Sửa\",\"delete\":\"Xóa\",\"permission\":\"Phân quyền\"}'),
('products', 'Sản phẩm', '{\"add\":\"Thêm\",\"update\":\"Sửa\",\"delete\":\"Xóa\"}'),
('users', 'Người dùng', '{\"add\":\"Thêm\",\"update\":\"Sửa\",\"delete\":\"Xóa\"}'),
('bill', 'Hóa đơn', '{\"update\":\"Sửa\"}'),
('contacts', 'Liên hệ', '{\"update\":\"Sửa\",\"delete\":\"Xóa\"}'),
('reviews', 'Đánh giá', '{\"update\":\"Sửa\",\"delete\":\"Xóa\"}'),
('options', 'Cài đặt chung', '{\"update\":\"Sửa\"}'),
('dashboard', 'Thống kê', '{\"view\":\"Xem\"}');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `opt_key` varchar(100) DEFAULT NULL,
  `opt_value` text DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `opt_key`, `opt_value`, `name`) VALUES
(1, 'general_hotline', '0987982144', 'Liên hệ'),
(2, 'general_address', 'tienhai488@gmail.com', 'Địa chỉ'),
(3, 'general_email', 'tienhai488@gmail.com', 'Email'),
(4, 'general_delivery', 'Miễn phí vận chuyển, bảo đảm đổi trả hoặc hoàn tiền trong 30 ngày.', 'Giao hàng'),
(5, 'general_facebook', 'https://www.facebook.com/', 'Facebook'),
(6, 'general_twitter', 'https://www.twitter.com/', 'Twitter'),
(7, 'general_youtube', 'https://www.youtube.com/', 'Youtube'),
(8, 'general_instagram', 'https://www.instagram.com/', 'Instagram'),
(9, 'general_footer', '{\"title_1\":\"Male Fashion\",\"des_1\":\"The customer is at the heart of our unique business model, which includes design.\",\"title_2\":\"SHOPPING\",\"name_quicklink\":[\"Clothing Store  \",\"Trending Shoes\",\"Accessories\",\"Sale\"],\"link_quicklink\":[\"#\",\"#\",\"#\",\"#\"],\"title_3\":\"SHOPPING\",\"name_quicklink2\":[\"Contact Us\",\"Payment Methods\",\"Delivary\",\"Return &#38; Exchanges\"],\"link_quicklink2\":[\"#\",\"#\",\"#\",\"#\"],\"title_4\":\"NEWLETTER\",\"des_4\":\"Consectetur adipiscing elit. Vestibulum vel sapien et lacus tempus varius. In finibus lorem vel.\",\"copy_right\":\"Copyright \\u00a9 20232020 All rights reserved | This template is made with  by Colorlib\"}', 'Footer'),
(10, 'general_country', '1', 'Số quốc gia'),
(11, 'general_happy_customer', '90', 'Tỉ lệ khách hài lòng'),
(12, 'general_clients', '150', 'Số lượng khách hàng'),
(13, 'general_partner', '{\"heading_1\":\"PARTNER\",\"heading_2\":\"Happy Clients\",\"image\":[\"images\\/client-1.png\",\"images\\/client-2.png\",\"images\\/client-3.png\",\"images\\/client-4.png\",\"images\\/client-5.png\",\"images\\/client-6.png\"],\"link\":[\"#\",\"#\",\"#\",\"#\",\"#\",\"#\"]}', 'Thiết lập đối tác'),
(14, 'general_our_team', '{\"heading_1\":\"OUR TEAM\",\"heading_2\":\"Meet Our Team\",\"name\":[\"NgocHuy\",\"TienHai\",\"HongSon\",\"DienTam\"],\"position\":[\"Founder\",\"Dev\",\"Dev\",\"Dev\"],\"image\":[\"images\\/our_team\\/team-1.jpg\",\"images\\/our_team\\/team-2.jpg\",\"images\\/our_team\\/team-3.jpg\",\"images\\/our_team\\/team-4.jpg\"]}', 'Thành viên'),
(15, 'general_advertise', '{\"title\":[\"Summer Collection\",\"Summer Collection\"],\"header\":[\"Fall - Winter Collections 2030\",\"Fall - Winter Collections 2030\"],\"image\":[\"images\\/hero-1.jpg\",\"images\\/hero-2.jpg\"],\"description\":[\"&#60;p&#62;A specialist label creating luxury essentials. Ethically crafted with an unwavering commitment to exceptional quality.&#60;\\/p&#62;&#13;&#10;\",\"&#60;p&#62;A specialist label creating luxury essentials. Ethically crafted with an unwavering commitment to exceptional quality.&#60;\\/p&#62;&#13;&#10;\"]}', 'Quảng cáo');

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `name`, `description`, `create_at`, `update_at`) VALUES
(1, 'Chờ duyệt', 'Chờ người bán duyệt đơn hàng', '2023-03-22 10:51:30', NULL),
(2, 'Đã duyệt', 'duyệt', '2023-03-22 10:51:38', '2023-03-22 10:51:56'),
(3, 'Đang chuẩn bị hàng', 'Đang chuẩn bị đơn hàng', '2023-05-07 23:17:15', NULL),
(4, 'Hủy đơn', 'Đơn hàng bị hủy bỏ&#13;&#10;', '2023-03-30 08:26:35', NULL),
(5, 'Đang giao', 'Đang được giao', '2023-03-30 08:26:56', NULL),
(6, 'Thành công', 'Giao hàng thành công', '2023-03-30 08:27:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `img` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `sale` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `id_brand` int(11) NOT NULL,
  `status` tinyint(4) DEFAULT NULL COMMENT '1 Mở bán 2 Ẩn',
  `type` varchar(50) DEFAULT NULL COMMENT 'Normal Sale New',
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `img`, `description`, `price`, `sale`, `id_category`, `id_brand`, `status`, `type`, `create_at`, `update_at`) VALUES
(1, 'Áo Addidas D2M', 'adidas-d2m-3s-gm2135-1.jpg', '&#60;p&#62;Mặc l&#38;ecirc;n tự tin thoải m&#38;aacute;i sẵn s&#38;agrave;ng t&#38;ecirc; t&#38;aacute;i&#60;/p&#62;&#13;&#10;', 600, 300, 1, 1, 2, 'new', '2023-03-20 13:30:00', '2023-05-06 10:44:01'),
(2, 'Áo Thun Adidas D4R Xanh', 'adidas-d4r-tee-men-hk7117-1.jpg', 'Tuy không xinh nhưng biết thế nào là ảo', 800, 500, 1, 1, 1, 'new', '2023-03-20 13:30:00', '2023-05-08 10:12:21'),
(3, 'Áo Thun Adidas HC2760 Đen', 'adidas-m-ti-tee-hc2760-den-1.jpg', 'Đen như cuộc tình của anh và em', 900, 800, 1, 1, 1, 'normal', '2023-03-20 13:30:00', '2023-03-20 13:30:00'),
(5, 'Áo Hoodie Adidas Tokyo Carrier Pullover', 'images/categories/ao-hoodie-lifestyle-nam-adidas-hl6925-1.jpg', '&#60;p&#62;Kẻ si t&#38;igrave;nh trong cuộc t&#38;igrave;nh tay ba&#60;/p&#62;&#13;&#10;', 1500, 1200, 2, 1, 1, 'sale', '2023-03-20 13:30:00', '2023-03-27 15:03:27'),
(6, 'Áo Hoodie Lifestyle HL6925 Adidas', 'ao-hoodie-lifestyle-nam-adidas-hl6925-1.jpg', 'Hoodie của anh, hóa đơn của em', 1200, 800, 2, 1, 1, 'sale', '2023-03-20 13:30:00', '2023-03-20 13:30:00'),
(7, 'Áo Hoodie Puma Power Knit Training', 'images/categories/ao-thun-lifestyle-nam-puma-classics-logo-metallic-534711-01-1.jpg', '&#60;p&#62;Pu em như con ruồi, để ma em đuổi anh đi&#60;/p&#62;&#13;&#10;', 1700, 1200, 2, 3, 1, 'sale', '2023-03-20 13:30:00', '2023-05-08 11:22:00'),
(8, 'Áo Hoodie Nike Sportwear Midnight Navy', 'images/categories/ao-thun-lifestyle-nam-nike-dr8055-100-3.jpg', '&#60;p&#62;Nữa đ&#38;ecirc;m bật dậy nhắn em 1 c&#38;acirc;u, anh y&#38;ecirc;u em như cọc t&#38;igrave;m tr&#38;acirc;u&#60;/p&#62;&#13;&#10;', 800, 700, 2, 2, 1, 'normal', '2023-03-20 13:30:00', '2023-03-27 15:05:37'),
(9, 'Áo Hoodie Nike Pullover Tokyo', 'images/sp1/adidas-d4r-tee-men-hk7117-1.jpg', '&#60;p&#62;Tokyo ở Nhật, c&#38;ograve;n em ở trong tim anh&#60;/p&#62;&#13;&#10;', 1900, 1500, 2, 2, 1, 'normal', '2023-03-20 13:30:00', '2023-03-27 15:07:52'),
(10, 'Áo Polo Gucci With Pocket', 'images/sp2/ao-thun-lifestyle-nam-adidas-hl9386-1.jpg', '&#60;p&#62;Anh l&#38;agrave; ch&#38;agrave;ng trai Đ&#38;ocirc;n Chề c&#38;ograve;n em l&#38;agrave; c&#38;ocirc; g&#38;aacute;i Gu Ch&#38;igrave; của anh&#60;/p&#62;&#13;&#10;', 3000, 2800, 4, 4, 1, 'normal', '2023-03-20 13:30:00', '2023-03-27 15:08:19'),
(11, 'Áo Sơ Mi Adidas Short Sleeve Xanh Olive', 'images/categories/ao-thun-lifestyle-nam-adidas-m-feelcozy-swt-h12221-1.jpg', '&#60;p&#62;Anh mặc sơ mi đi l&#38;agrave;m tr&#38;acirc;u l&#38;agrave;m ngựa, em mặc &#38;aacute;o crop-top đi l&#38;agrave;m ghệ người ta&#60;/p&#62;&#13;&#10;', 400, 200, 3, 1, 2, 'normal', '2023-03-20 13:30:00', '2023-03-27 15:07:19'),
(12, 'Áo Sơ Mi Cộc Tay Adidas Màu Đen Xám', 'images/categories/adidas-m-ti-tee-hc2760-den-1.jpg', '&#60;p&#62;Em dạo n&#38;agrave;y c&#38;oacute; c&#38;ograve;n xem phim một m&#38;igrave;nh, em dạo n&#38;agrave;y c&#38;oacute; c&#38;ograve;n y&#38;ecirc;u người kh&#38;aacute;c kh&#38;ocirc;ng&#60;/p&#62;&#13;&#10;', 300, 100, 3, 1, 1, 'new', '2023-03-20 13:30:00', '2023-03-27 15:07:01'),
(13, 'Áo Sơ Mi Gucci Cotton Trắng', 'images/categories/ao-ba-lo-chay-bo-nam-nike-cz9180-010-5.jpg', '&#60;p&#62;&#38;Aacute;o n&#38;agrave;y tuy rẻ nhưng vẫn mắc hơn lương t&#38;acirc;m của m&#60;/p&#62;&#13;&#10;', 5000, 4900, 3, 4, 1, 'sale', '2023-03-20 13:30:00', '2023-03-27 15:06:28'),
(21, 'Áo Addidas D2M', 'adidas-d2m-3s-gm2135-1.jpg', '&#60;p&#62;Mặc l&#38;ecirc;n tự tin thoải m&#38;aacute;i sẵn s&#38;agrave;ng t&#38;ecirc; t&#38;aacute;i&#60;/p&#62;&#13;&#10;', 600, 300, 1, 1, 2, 'new', '2023-03-20 13:30:00', '2023-03-29 22:04:45'),
(22, 'Áo Thun Adidas D4R Xanh', 'images/sp18/adidas-d4r-tee-men-hk7117-1.jpg', '&#60;p&#62;Xanh Xanh Long Lanh, Mặc V&#38;agrave;o Y&#38;ecirc;u Anh&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;h&#38;atilde;y mua ngay n&#38;egrave;&#60;/p&#62;&#13;&#10;', 800, 500, 1, 1, 1, 'new', '2023-03-20 13:30:00', '2023-05-07 22:10:46'),
(23, 'Áo Thun Adidas HC2760 Đen', 'images/sp17/adidas-m-ti-tee-hc2760-den-1.jpg', '&#60;p&#62;&#38;Aacute;o Thun Thoải M&#38;aacute;i, Chưa Mặc Đ&#38;atilde; Kho&#38;aacute;i&#60;/p&#62;&#13;&#10;', 900, 800, 1, 1, 1, 'normal', '2023-03-20 13:30:00', '2023-05-07 22:09:18'),
(25, 'Áo Hoodie Adidas Tokyo Carrier Pullover', 'images/sp8/ao-hoodie-adidas-tokyo-brand-carrier-pullover-h64727-mau-den-size-l-1.jpg', '&#60;p&#62;Hoodie Tokyo Carrier Pullover ho&#38;agrave;n to&#38;agrave;n mới đến từ nh&#38;agrave; Adidas, h&#38;atilde;y mua ngay trước khi ch&#38;aacute;y h&#38;agrave;ng&#60;/p&#62;&#13;&#10;', 1500, 1200, 2, 1, 1, 'sale', '2023-03-20 13:30:00', '2023-05-07 21:51:28'),
(26, 'Áo Hoodie Lifestyle HL6925 Adidas', 'images/sp16/ao-hoodie-lifestyle-nam-adidas-hl6925-1.jpg', '&#60;p&#62;Được l&#38;agrave;m từ t&#38;igrave;nh y&#38;ecirc;u v&#38;ocirc; v&#38;agrave;n của nh&#38;agrave; thiết kế&#60;/p&#62;&#13;&#10;', 1200, 800, 2, 1, 1, 'sale', '2023-03-20 13:30:00', '2023-05-07 22:07:57'),
(27, 'Áo Hoodie Puma Power Knit Training', 'images/sp15/ao-hoodie-puma-power-knit-trainning-hoodie-black-518978-01-mau-den-size-m-1.jpg', '&#60;p&#62;Hoodie mới đến từ nh&#38;agrave; Puma h&#38;atilde;y bấm n&#38;uacute;t mua ngay để sỡ hữu&#60;/p&#62;&#13;&#10;', 1700, 1200, 2, 3, 1, 'sale', '2023-03-20 13:30:00', '2023-05-07 22:05:45'),
(28, 'Áo Thun Life Style Nike DR8055', 'images/sp14/ao-thun-lifestyle-nam-nike-dr8055-100-4.jpg', '&#60;p&#62;&#38;Aacute;o thun thoải m&#38;aacute;i, m&#38;aacute;t mẻ đến từ Nike&#60;/p&#62;&#13;&#10;', 800, 700, 2, 2, 1, 'normal', '2023-03-20 13:30:00', '2023-05-07 22:06:33'),
(29, 'Áo Hoodie Nike Midnight Navy Nike', 'images/sp13/ao-nike-sportswear-men-s-hoodie-midnight-navy-cw4319-400-mau-xanh-navy-1.jpg', '&#60;p&#62;M&#38;agrave;u xanh độc đ&#38;aacute;o khiến ch&#38;agrave;ng nổi bật giữa đ&#38;aacute;m đ&#38;ocirc;ng&#60;/p&#62;&#13;&#10;', 1900, 1500, 2, 2, 1, 'normal', '2023-03-20 13:30:00', '2023-05-07 22:02:43'),
(30, 'Áo Polo Gucci With Pocket', 'images/sp12/ao-polo-gucci-with-pocket-713997-xjetr-9088-mau-trang-1.jpg', '&#60;p&#62;Thời thượng chưa bao giờ rẻ đến vậy, h&#38;atilde;y mua ng&#38;agrave;y trước khi ch&#38;aacute;y&#38;nbsp;&#60;/p&#62;&#13;&#10;', 3000, 2800, 4, 4, 1, 'normal', '2023-03-20 13:30:00', '2023-05-07 21:59:14'),
(31, 'Áo Sơ Mi Adidas Short Sleeve Xanh Olive', 'images/sp11/ao-thun-lifestyle-nam-adidas-m-feelcozy-swt-h12221-1.jpg', '&#60;p&#62;M&#38;aacute;t mẻ nhưng tinh tế, đơn giản nhưng độc đ&#38;aacute;o, h&#38;atilde;y mua ngay nh&#38;eacute;&#60;/p&#62;&#13;&#10;', 400, 200, 3, 1, 1, 'normal', '2023-03-20 13:30:00', '2023-05-07 21:57:06'),
(32, 'Áo Sơ Mi Cộc Tay Adidas Màu Đen Xám', 'images/sp10/adidas-m-ti-tee-hc2760-den-1.jpg', '&#60;p&#62;Đơn giản, tinh tế đ&#38;oacute; l&#38;agrave; những g&#38;igrave; m&#38;agrave; người thiết kế muốn hướng đến&#38;nbsp;&#60;/p&#62;&#13;&#10;', 300, 100, 3, 1, 1, 'new', '2023-03-20 13:30:00', '2023-05-07 21:55:07'),
(33, 'Áo Sơ Mi Gucci Cotton Trắng', 'images/sp9/ao-ba-lo-chay-bo-nam-nike-cz9180-010-1.jpg', '&#60;p&#62;Kiểu d&#38;aacute;ng mới mẻ ph&#38;ugrave; hợp với người đ&#38;agrave;n &#38;ocirc;ng khỏe khoắn&#60;/p&#62;&#13;&#10;', 5000, 4900, 3, 4, 1, 'sale', '2023-03-20 13:30:00', '2023-05-07 21:53:38'),
(34, 'Áo Reebook ReBasic HM2856', 'images/sp4/reebok-re-basic-ss-tee-hm2865-1.jpg', '&#60;p&#62;Mỏng nhẹ tho&#38;aacute;ng kh&#38;iacute; ph&#38;ugrave; hợp với c&#38;aacute;nh đ&#38;agrave;n &#38;ocirc;ng lịch l&#38;atilde;m.&#38;nbsp;&#60;/p&#62;&#13;&#10;', 2000, 1300, 1, 5, 1, 'new', '2023-05-07 21:40:00', NULL),
(35, 'Áo Sơ Mi Adidas Cộc Tay Originals HS9471 Đen Xám', 'images/sp6/ao-so-mi-coc-tay-adidas-originals-hs9471-mau-den-xam-1.jpg', '&#60;p&#62;Được sản xuất từ nguy&#38;ecirc;n liệu tự nhiện, gi&#38;uacute;p bảo vệ m&#38;ocirc;i trường v&#38;agrave; ho&#38;agrave;n to&#38;agrave;n m&#38;aacute;t mẻ&#60;/p&#62;&#13;&#10;', 4000, 3000, 3, 1, 1, 'sale', '2023-05-07 21:46:30', NULL),
(36, 'Áo Nike Hồng Nam Tính', 'images/sp7/nike-dq1011-824-1.jpg', '&#60;p&#62;Ai n&#38;oacute;i m&#38;agrave;u hồng chỉ d&#38;agrave;nh cho phụ nữ th&#38;ocirc;i, h&#38;atilde;y mua ngay mẫu &#38;aacute;o hồng ho&#38;agrave;n to&#38;agrave;n mới đến từ Nike&#60;/p&#62;&#13;&#10;', 1000, 600, 1, 2, 1, 'new', '2023-05-07 21:48:52', NULL),
(37, 'Hoodie Nike Thể Thao Pullover  Tokyo Trăng', 'images/sp19/ao-nike-sportswear-men-s-pullover-hoodie-tokyo-color-cw0308-100-mau-trang-1.jpg', '&#60;p&#62;Vừa nh&#38;igrave;n đ&#38;atilde; đẹp, kh&#38;ocirc;ng cần g&#38;igrave; hết chỉ với chiếc Hoodie n&#38;agrave;y l&#38;agrave; c&#38;oacute; thể tự tin ra đường&#60;/p&#62;&#13;&#10;', 1400, 1200, 2, 2, 1, 'new', '2023-05-07 22:15:11', NULL),
(38, 'Áo Sơ Mi Gucci Embroidered Cotten Trắng', 'images/sp20/ao-so-mi-gucci-white-cotton-snake-embroidered-collar-duke-shirt-2.jpg', '&#60;p&#62;Si&#38;ecirc;u phẩm đến từ Gucci, chỉ với ch&#38;uacute;t đỉnh l&#38;agrave; c&#38;oacute; thể sỡ hữu&#60;/p&#62;&#13;&#10;', 5000, 4000, 3, 4, 1, 'sale', '2023-05-07 22:18:10', '2023-05-08 11:06:10'),
(39, 'abcxyz', 'images/sp14/team-4.jpg', '&#60;p&#62;abc&#60;/p&#62;&#13;&#10;', 2147483647, 2147483647, 1, 2, 2, 'normal', '2023-05-08 14:09:56', '2023-05-08 14:13:56');

-- --------------------------------------------------------

--
-- Table structure for table `products_size`
--

CREATE TABLE `products_size` (
  `id_product` int(11) NOT NULL,
  `id_size` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products_size`
--

INSERT INTO `products_size` (`id_product`, `id_size`, `quantity`, `create_at`, `update_at`) VALUES
(1, 1, 30, '2023-03-29 22:04:45', NULL),
(1, 2, 27, '2023-03-29 22:04:45', '2023-05-07 23:15:29'),
(1, 3, 32, '2023-03-29 22:04:45', '2023-05-07 22:13:49'),
(1, 4, 30, '2023-03-29 22:04:45', NULL),
(1, 5, 30, '2023-03-29 22:04:45', NULL),
(1, 6, 1, '2023-03-29 22:04:45', NULL),
(2, 1, 1, NULL, NULL),
(2, 2, 103, NULL, '2023-05-07 23:15:29'),
(2, 3, -1, NULL, NULL),
(2, 4, 0, NULL, NULL),
(2, 5, 6, NULL, NULL),
(2, 6, 7, NULL, NULL),
(3, 1, 8, NULL, NULL),
(3, 2, 9, NULL, NULL),
(3, 3, 10, NULL, NULL),
(3, 4, 0, NULL, NULL),
(3, 5, 11, NULL, NULL),
(3, 6, 12, NULL, NULL),
(5, 1, 19, NULL, NULL),
(5, 2, 20, NULL, NULL),
(5, 3, 0, NULL, NULL),
(5, 4, 21, NULL, NULL),
(5, 5, 22, NULL, NULL),
(5, 6, 23, NULL, NULL),
(6, 1, 24, NULL, NULL),
(6, 2, 25, NULL, NULL),
(6, 3, 26, NULL, NULL),
(6, 4, 27, NULL, NULL),
(6, 5, 28, NULL, NULL),
(6, 6, 29, NULL, NULL),
(7, 1, 30, NULL, NULL),
(7, 2, 0, NULL, NULL),
(7, 3, 5, NULL, NULL),
(7, 4, 0, NULL, NULL),
(7, 5, 7, NULL, NULL),
(7, 6, 21, NULL, NULL),
(8, 1, 16, NULL, NULL),
(8, 2, 0, NULL, NULL),
(8, 3, 115, NULL, '2023-04-10 21:52:03'),
(8, 4, 6, NULL, NULL),
(8, 5, 12, NULL, NULL),
(8, 6, 0, NULL, NULL),
(9, 1, 30, NULL, NULL),
(9, 2, 8, NULL, NULL),
(9, 3, 21, NULL, NULL),
(9, 4, 22, NULL, NULL),
(9, 5, 30, NULL, NULL),
(9, 6, 1, NULL, NULL),
(10, 1, 12, NULL, NULL),
(10, 2, 11, NULL, NULL),
(10, 3, 20, NULL, NULL),
(10, 4, 10, NULL, NULL),
(10, 5, 0, NULL, NULL),
(10, 6, 6, NULL, NULL),
(11, 1, 24, NULL, NULL),
(11, 2, 5, NULL, NULL),
(11, 3, 11, NULL, NULL),
(11, 4, 97, NULL, '2023-04-10 21:52:03'),
(11, 5, 23, NULL, NULL),
(11, 6, 21, NULL, NULL),
(12, 1, 16, NULL, NULL),
(12, 2, 0, NULL, NULL),
(12, 3, 0, NULL, NULL),
(12, 4, 0, NULL, NULL),
(12, 5, 13, NULL, NULL),
(12, 6, 0, NULL, NULL),
(13, 1, 2, NULL, NULL),
(13, 2, 1, NULL, NULL),
(13, 3, 0, NULL, NULL),
(13, 4, 0, NULL, NULL),
(13, 5, 3, NULL, NULL),
(13, 6, 8, NULL, NULL),
(21, 1, 30, '2023-03-29 22:04:45', NULL),
(21, 2, 45, '2023-03-29 22:04:45', NULL),
(21, 3, 32, '2023-03-29 22:04:45', NULL),
(21, 4, 30, '2023-03-29 22:04:45', NULL),
(21, 5, 30, '2023-03-29 22:04:45', NULL),
(21, 6, 1, '2023-03-29 22:04:45', NULL),
(22, 1, 2, '2023-05-07 22:10:46', NULL),
(22, 2, 3, '2023-05-07 22:10:46', NULL),
(22, 3, 1, '2023-05-07 22:10:46', NULL),
(22, 4, 2, '2023-05-07 22:10:46', NULL),
(22, 5, 6, '2023-05-07 22:10:46', NULL),
(22, 6, 7, '2023-05-07 22:10:46', NULL),
(23, 1, 8, '2023-05-07 22:09:18', NULL),
(23, 2, 9, '2023-05-07 22:09:18', NULL),
(23, 3, 10, '2023-05-07 22:09:18', NULL),
(23, 4, 10, '2023-05-07 22:09:18', NULL),
(23, 5, 11, '2023-05-07 22:09:18', NULL),
(23, 6, 12, '2023-05-07 22:09:18', NULL),
(25, 1, 19, '2023-05-07 21:51:28', NULL),
(25, 2, 20, '2023-05-07 21:51:28', NULL),
(25, 3, 10, '2023-05-07 21:51:28', NULL),
(25, 4, 21, '2023-05-07 21:51:28', NULL),
(25, 5, 22, '2023-05-07 21:51:28', NULL),
(25, 6, 23, '2023-05-07 21:51:28', NULL),
(26, 1, 24, '2023-05-07 22:07:57', NULL),
(26, 2, 25, '2023-05-07 22:07:57', NULL),
(26, 3, 26, '2023-05-07 22:07:57', NULL),
(26, 4, 27, '2023-05-07 22:07:57', NULL),
(26, 5, 28, '2023-05-07 22:07:57', NULL),
(26, 6, 29, '2023-05-07 22:07:57', NULL),
(27, 1, 30, '2023-05-07 22:05:45', NULL),
(27, 2, 10, '2023-05-07 22:05:45', NULL),
(27, 3, 1, '2023-05-07 22:05:45', NULL),
(27, 4, 4, '2023-05-07 22:05:45', NULL),
(27, 5, 25, '2023-05-07 22:05:45', NULL),
(27, 6, 21, '2023-05-07 22:05:45', NULL),
(28, 1, 16, '2023-05-07 22:06:33', NULL),
(28, 3, 10, '2023-05-07 22:06:33', NULL),
(28, 4, 2, '2023-05-07 22:06:33', NULL),
(28, 5, 12, '2023-05-07 22:06:33', NULL),
(29, 1, 30, '2023-05-07 22:02:43', NULL),
(29, 2, 8, '2023-05-07 22:02:43', NULL),
(29, 3, 21, '2023-05-07 22:02:43', NULL),
(29, 4, 22, '2023-05-07 22:02:43', NULL),
(29, 5, 30, '2023-05-07 22:02:43', NULL),
(29, 6, 1, '2023-05-07 22:02:43', NULL),
(30, 1, 12, '2023-05-07 21:59:14', NULL),
(30, 2, 11, '2023-05-07 21:59:14', NULL),
(30, 3, 20, '2023-05-07 21:59:14', NULL),
(30, 4, 10, '2023-05-07 21:59:14', NULL),
(30, 6, 6, '2023-05-07 21:59:14', NULL),
(31, 1, 24, '2023-05-07 21:57:06', NULL),
(31, 2, 0, '2023-05-07 21:57:06', NULL),
(31, 3, 11, '2023-05-07 21:57:06', NULL),
(31, 4, 27, '2023-05-07 21:57:06', NULL),
(31, 5, 23, '2023-05-07 21:57:06', NULL),
(31, 6, 21, '2023-05-07 21:57:06', NULL),
(32, 1, 16, '2023-05-07 21:55:07', NULL),
(32, 2, 3, '2023-05-07 21:55:07', NULL),
(32, 3, 7, '2023-05-07 21:55:07', NULL),
(32, 4, 9, '2023-05-07 21:55:07', NULL),
(32, 5, 14, '2023-05-07 21:55:07', NULL),
(32, 6, 12, '2023-05-07 21:55:07', NULL),
(33, 1, 2, '2023-05-07 21:53:38', NULL),
(33, 2, 1, '2023-05-07 21:53:38', NULL),
(33, 3, 1, '2023-05-07 21:53:38', NULL),
(33, 4, 2, '2023-05-07 21:53:38', NULL),
(33, 5, 3, '2023-05-07 21:53:38', NULL),
(33, 6, 8, '2023-05-07 21:53:38', NULL),
(34, 1, 10, '2023-05-07 21:40:00', NULL),
(34, 2, 24, '2023-05-07 21:40:00', NULL),
(34, 3, 14, '2023-05-07 21:40:00', NULL),
(34, 4, 21, '2023-05-07 21:40:00', NULL),
(34, 5, 24, '2023-05-07 21:40:00', NULL),
(34, 6, 22, '2023-05-07 21:40:00', NULL),
(35, 1, 10, '2023-05-07 21:46:30', NULL),
(35, 2, 2, '2023-05-07 21:46:30', NULL),
(35, 3, 9, '2023-05-07 21:46:30', NULL),
(35, 4, 11, '2023-05-07 21:46:30', NULL),
(35, 5, 42, '2023-05-07 21:46:30', NULL),
(35, 6, 13, '2023-05-07 21:46:30', NULL),
(36, 1, 13, '2023-05-07 21:48:52', NULL),
(36, 2, 7, '2023-05-07 21:48:52', NULL),
(36, 3, 11, '2023-05-07 21:48:52', NULL),
(36, 4, 31, '2023-05-07 21:48:52', NULL),
(36, 5, 32, '2023-05-07 21:48:52', NULL),
(36, 6, 42, '2023-05-07 21:48:52', NULL),
(37, 1, 20, '2023-05-07 22:15:11', NULL),
(37, 2, 31, '2023-05-07 22:15:11', NULL),
(37, 3, 10, '2023-05-07 22:15:11', NULL),
(37, 4, 18, '2023-05-07 22:15:11', NULL),
(37, 5, 12, '2023-05-07 22:15:11', NULL),
(37, 6, 13, '2023-05-07 22:15:11', NULL),
(38, 1, 32, '2023-05-07 22:18:10', NULL),
(38, 2, 23, '2023-05-07 22:18:10', NULL),
(38, 3, 10, '2023-05-07 22:18:10', NULL),
(38, 4, 14, '2023-05-07 22:18:10', NULL),
(38, 5, 13, '2023-05-07 22:18:10', NULL),
(38, 6, 11, '2023-05-07 22:18:10', NULL),
(39, 6, 2, '2023-05-08 14:10:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `star` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '1: An 2:Hien Thi',
  `note` text DEFAULT NULL,
  `create_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `product_id`, `name`, `email`, `message`, `star`, `status`, `note`, `create_at`) VALUES
(8, 1, 'Minh Lâm', 'tienhai@gmail.com', 'san pham ok lamnh', 5, 2, 'Vua gui', '2023-04-03 16:40:20'),
(9, 1, 'Minh Lâm', 'minhlam@gmail.com', 'ok lam do nha', 3, 2, 'Vua gui', '2023-04-03 16:44:32'),
(10, 12, 'Minh Lâm', 'tienhai488@gmail.com', 'ok nha moi nguoio', 2, 2, 'Vua gui', '2023-04-03 16:56:27'),
(11, 12, 'Minh Lâm', 'minhlam@gmail.com', 'minhlam@gmail.com', 5, 2, 'Vua gui', '2023-04-03 16:58:09'),
(12, 1, 'PTTK_Tuan3', 'tienhai9a2@gmail.com', 'tienhai9a2@gmail.com', 5, 2, 'Vua gui', '2023-04-03 21:02:24'),
(28, 12, 'haile@gmail.com', 'haile@gmail.com', 'haile@gmail.com', 5, 2, 'Vua gui', '2023-04-14 18:27:39'),
(29, 12, 'TienHai', 'tienhai@gmail.com', 'Binh luan danh gia san pham', 5, 2, 'Chưa xử lý', '2023-04-14 19:57:26'),
(34, 12, 'TienHai488', 'tienhai4888@gmail.com', 'Binh luan cho san pham tesst chuc nawng', 3, 1, 'Chưa xử lý', '2023-04-14 20:43:25');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` int(11) NOT NULL,
  `name` varchar(10) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `name`, `description`, `create_at`, `update_at`) VALUES
(1, 'S', '[value-3]', NULL, NULL),
(2, 'M', '[value-3]', NULL, NULL),
(3, 'L', '[value-3]', NULL, NULL),
(4, 'XL', '[value-3]', NULL, NULL),
(5, '2XL', '[value-3]', NULL, NULL),
(6, '3XL', '[value-3]', NULL, NULL),
(7, '3XL', 'abc', '2023-05-08 14:06:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subcribes`
--

CREATE TABLE `subcribes` (
  `id` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '1:Chưa xử lý 2:Đang xử lý 3:Đã xử lý'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subcribes`
--

INSERT INTO `subcribes` (`id`, `email`, `note`, `create_at`, `status`) VALUES
(1, 'tienhai488@gmail.com', 'chua xu ly', '2023-03-23 08:53:41', 1),
(2, 'tienhai@gmail.com', 'Chưa xử lý', '2023-04-02 10:10:58', 1),
(3, 'tienhai@gmail.com', 'Chưa xử lý', '2023-04-02 10:15:42', 1),
(4, 'minhlam@gmail.com', 'Chưa xử lý', '2023-04-02 10:16:13', 1),
(5, 'tienhai@gmail.com', 'Chưa xử lý', '2023-04-02 10:16:51', 1),
(6, 'tienhai@gmail.com', 'Chưa xử lý', '2023-04-02 10:17:23', 1),
(7, 'manhtuan@gmail.com', 'Chưa xử lý', '2023-04-02 10:17:56', 1),
(8, 'email@gmail.com', 'Chưa xử lý', '2023-04-12 22:24:42', 1),
(9, 'tienhai488@gmail.com', 'Chưa xử lý', '2023-04-14 20:12:38', 1),
(10, 'ngochuy@gmail.com', 'Chưa xử lý', '2023-04-17 14:30:36', 1),
(11, 'tienhai@gmail.com', 'Chưa xử lý', '2023-05-07 23:26:02', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1 Kich hoat 0 Chua kich hoat',
  `type` varchar(50) DEFAULT 'user',
  `group_id` int(11) NOT NULL,
  `forgot_token` varchar(200) DEFAULT NULL,
  `active_token` varchar(200) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `phone`, `password`, `status`, `type`, `group_id`, `forgot_token`, `active_token`, `create_at`, `update_at`) VALUES
(3, 'Tien Hai Le', 'tienhai4888@gmail.com', '0987982144', '$2y$10$G6GZk.UtbjfwMqDBBXyaEetxOuR1Q2LC1EFbtfM4ykXlRau0xeK62', 1, 'member', 8, 'ebc6cbcc368ed19baba5090bbe324959b967020e', NULL, '2023-03-17 11:05:40', '2023-04-17 16:38:48'),
(9, 'Minh Lam ', 'minhlam@gmail.com', '0987654321', '$2y$10$OcKwsA8ONsFm4ihM1mR8m.gVLCS3terEbozObJ5Jc89dsfOw8tI1O', 1, 'user', 2, NULL, NULL, '2023-03-18 21:48:44', '2023-05-08 13:13:10'),
(10, 'TienHai', 'tienhai@gmail.com', '0987654321', '$2y$10$ilv4fmfcw0cfkdtcUou9xu0joh3KlGC08pEzuoNQKEc6iwNHtPgZm', 1, 'user', 3, NULL, NULL, '2023-03-18 21:50:14', '2023-03-19 09:57:31'),
(37, 'TienHai', 'tienhai488@gmail.com', '0987654321', '$2y$10$G6GZk.UtbjfwMqDBBXyaEetxOuR1Q2LC1EFbtfM4ykXlRau0xeK62', 1, 'user', 2, '', '', '2023-03-31 16:54:53', '2023-03-31 21:22:18'),
(38, 'Minh Lam', 'minhlam2@gmail.com', '0987654321', '$2y$10$uIcF8Q7uXNj7kI/Dc7qhEefwMSa4SZ61q5riSj1QklBx6/2p6O.ei', 1, 'member', 7, NULL, NULL, '2023-04-01 17:18:32', '2023-04-01 23:00:49'),
(45, 'tienhai', 'tienhaile488@gmail.com', '0987654321', '$2y$10$L9WoymN1ZtQJA4EjpUmpo.utErYjFvVI7bl0wt/Fho.dooZYjCRSe', 0, 'user', 2, NULL, '238eacac8221c9a134c6b7b56839247969de1e97', '2023-10-19 10:49:41', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_bill_user` (`user_id`),
  ADD KEY `fk_bill_order_status` (`id_order_status`);

--
-- Indexes for table `bill_detail`
--
ALTER TABLE `bill_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_detail_bill_bill` (`bill_id`),
  ADD KEY `fk_bill_detail_product` (`product_id`),
  ADD KEY `fk_bill_detail_size` (`size_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cart_user` (`user_id`),
  ADD KEY `fk_cart_product` (`product_id`),
  ADD KEY `fk_cart_size` (`size_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_image_product` (`id_product`);

--
-- Indexes for table `login_token`
--
ALTER TABLE `login_token`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_login_token_account` (`user_id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_product_categorie` (`id_category`),
  ADD KEY `fk_product_brand` (`id_brand`);

--
-- Indexes for table `products_size`
--
ALTER TABLE `products_size`
  ADD PRIMARY KEY (`id_product`,`id_size`),
  ADD KEY `fk_product_size_size` (`id_size`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_review_product` (`product_id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcribes`
--
ALTER TABLE `subcribes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_group` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `bill_detail`
--
ALTER TABLE `bill_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `login_token`
--
ALTER TABLE `login_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=287;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `subcribes`
--
ALTER TABLE `subcribes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `fk_bill_order_status` FOREIGN KEY (`id_order_status`) REFERENCES `order_status` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_bill_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bill_detail`
--
ALTER TABLE `bill_detail`
  ADD CONSTRAINT `fk_bill_detail_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_bill_detail_size` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_detail_bill_bill` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_cart_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_cart_size` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_cart_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `fk_image_product` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `login_token`
--
ALTER TABLE `login_token`
  ADD CONSTRAINT `fk_login_token_account` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_product_brand` FOREIGN KEY (`id_brand`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_product_categorie` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products_size`
--
ALTER TABLE `products_size`
  ADD CONSTRAINT `fk_product_size_product` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_product_size_size` FOREIGN KEY (`id_size`) REFERENCES `sizes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `fk_review_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_user_group` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
