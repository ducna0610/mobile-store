-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table mobile_store_db.admins
CREATE TABLE IF NOT EXISTS `admins` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` tinyint(1) NOT NULL DEFAULT '1',
  `phone` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` tinyint NOT NULL DEFAULT '0' COMMENT 'AdminRoleEnum',
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mobile_store_db.admins: ~1 rows (approximately)
INSERT INTO `admins` (`id`, `name`, `email`, `password`, `gender`, `phone`, `address`, `dob`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'anh duc deeptry', 'ducna0610@gmail.com', '$2y$10$.zBJmANPexFOb9VYq0.cpeGppieitPVBE0jM3i/RQlhdOETr2yODW', 1, '0973054202', 'HCM', '2023-02-18 02:49:24', 1, NULL, '2023-02-17 19:49:24', '2023-02-17 19:49:24');

-- Dumping structure for table mobile_store_db.bills
CREATE TABLE IF NOT EXISTS `bills` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name_receiver` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_receiver` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_receiver` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_price` double NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '0' COMMENT 'StatusOrderEnum',
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bills_user_id_foreign` (`user_id`),
  CONSTRAINT `bills_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mobile_store_db.bills: ~0 rows (approximately)
INSERT INTO `bills` (`id`, `name_receiver`, `phone_receiver`, `address_receiver`, `total_price`, `note`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 'Nguyen Anh Duc', '0979575539', 'Thạnh Xuân 14, Q12', 124940000, 'giao buổi chiều giúp e', 0, 11, '2022-12-20 20:33:52', '2023-02-17 19:50:31'),
	(2, 'Nguyen Anh Duc', '0979575539', 'Thạnh Xuân 14, Q12', 1990000, NULL, 0, 11, '2022-12-26 00:50:36', '2022-12-26 00:50:36'),
	(3, 'Nguyen Anh Duc', '0979575539', 'Thạnh Xuân 14, Q12', 34980000, 'sẽ boom hàng', 0, 11, '2023-01-03 20:44:07', '2023-01-03 20:44:07'),
	(4, 'Nguyen Anh Khoa', '0979575539', 'Thành phố Thủ Đức', 999999000, NULL, 0, 11, '2023-01-14 20:47:21', '2023-01-14 20:47:21'),
	(5, 'Nguyen Anh Duc', '0979575539', 'Thạnh Xuân 14, Q12', 4490000, NULL, 0, 11, '2023-01-17 20:48:13', '2023-01-17 20:48:13'),
	(6, 'Đạt alime', '0973054222', 'Tân Bình, Tp Hồ Chí Minh', 46470000, 'free ship thì lấy', 0, 1, '2023-01-17 20:52:02', '2023-01-17 20:52:02'),
	(7, 'Anh Nghĩa châu Phi', '0753252841', 'Chợ Gạo Tiền Giang', 81800000, 'Bắt đc e thì nhận', 0, 5, '2023-01-23 21:02:57', '2023-02-17 19:50:27'),
	(9, 'Đông chiến thần', '0900101011', 'bốn bể là nhà', 1460000, NULL, 0, 2, '2023-01-22 00:57:54', '2023-01-22 00:57:54'),
	(10, 'nyc', '0900101011', 'bốn bể là nhà', 13470000, NULL, 0, 2, '2023-01-20 00:58:51', '2023-01-20 00:58:51'),
	(11, 'ny anh Giap', '0905030201', 'Los Angeles(Long An)', 90270000, NULL, 0, 10, '2023-01-25 20:28:19', '2023-02-17 19:50:17');

-- Dumping structure for table mobile_store_db.bill_detail
CREATE TABLE IF NOT EXISTS `bill_detail` (
  `type_id` bigint unsigned NOT NULL,
  `bill_id` bigint unsigned NOT NULL,
  `quantity` int NOT NULL,
  `price` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`bill_id`,`type_id`),
  KEY `bill_detail_type_id_foreign` (`type_id`),
  CONSTRAINT `bill_detail_bill_id_foreign` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`id`),
  CONSTRAINT `bill_detail_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mobile_store_db.bill_detail: ~0 rows (approximately)
INSERT INTO `bill_detail` (`type_id`, `bill_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
	(1, 1, 2, 17490000, '2022-12-20 20:33:52', '2022-12-20 20:33:52'),
	(41, 1, 4, 22490000, '2022-12-20 20:33:52', '2022-12-20 20:33:52'),
	(95, 2, 1, 1990000, '2022-12-26 00:50:36', '2022-12-26 00:50:36'),
	(1, 3, 2, 17490000, '2023-01-03 20:44:07', '2023-01-03 20:44:07'),
	(67, 4, 1, 999999000, '2023-01-14 20:47:21', '2023-01-14 20:47:21'),
	(118, 5, 1, 4490000, '2023-01-17 20:48:13', '2023-01-17 20:48:13'),
	(104, 6, 3, 6490000, '2023-01-17 20:52:02', '2023-01-17 20:52:02'),
	(132, 6, 1, 27000000, '2023-01-17 20:52:02', '2023-01-17 20:52:02'),
	(106, 7, 2, 40900000, '2023-01-23 21:02:57', '2023-01-23 21:02:57'),
	(130, 9, 2, 730000, '2023-01-22 00:57:54', '2023-01-22 00:57:54'),
	(101, 10, 3, 4490000, '2023-01-20 00:58:51', '2023-01-20 00:58:51'),
	(63, 11, 3, 30090000, '2023-01-25 20:28:19', '2023-01-25 20:28:19');

-- Dumping structure for table mobile_store_db.images
CREATE TABLE IF NOT EXISTS `images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `image_names` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `images_product_id_foreign` (`product_id`),
  CONSTRAINT `images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mobile_store_db.images: ~0 rows (approximately)
INSERT INTO `images` (`id`, `image_names`, `product_id`, `created_at`, `updated_at`) VALUES
	(1, '["167247475688.jpg","167247475628.jpg","16724747562.jpg","167247475632.jpg","167247475690.jpg","167247475633.jpg","167247475684.jpg","167247475615.jpg"]', 1, '2022-12-31 01:19:16', '2022-12-31 01:19:16'),
	(2, '["167247507991.jpg","167247507939.jpg","16724750794.jpg","167247507944.jpg","167247507997.jpg","167247507963.jpg"]', 2, '2022-12-31 01:24:39', '2022-12-31 01:24:39'),
	(3, '["167247542332.jpg","167247542366.jpg","167247542370.jpg","167247542325.jpg","167247542314.jpg"]', 3, '2022-12-31 01:30:23', '2022-12-31 01:30:23'),
	(4, '["167247584973.jpg","167247584936.jpg","167247584990.jpg","167247584985.jpg"]', 5, '2022-12-31 01:35:29', '2022-12-31 01:37:29'),
	(5, '["167247604026.jpg","167247604099.jpg","167247604050.jpg","167247604013.jpg"]', 4, '2022-12-31 01:40:40', '2022-12-31 01:40:40'),
	(6, '["167247675044.jpg","167247675035.jpg","167247675058.jpg","167247675097.jpg","167247675074.jpg"]', 9, '2022-12-31 01:52:30', '2022-12-31 01:52:30'),
	(7, '["167249214673.jpg","167249214610.jpg","167249214673.jpg","167249214625.jpg","167249214677.jpg","167249214669.jpg","167249214640.jpg","167249214679.jpg"]', 10, '2022-12-31 06:09:06', '2022-12-31 06:09:06'),
	(8, '["167290753841.jpg","167290753858.jpg","167290753836.jpg","167290753826.jpg","167290753865.jpg","167290753857.jpg"]', 6, '2023-01-05 01:32:18', '2023-01-05 01:32:37'),
	(9, '["167290799595.jpg","167290799542.jpg","167290799566.jpg","16729079952.jpg","167290799563.jpg","167290799569.jpg","167290799512.jpg"]', 8, '2023-01-05 01:39:55', '2023-01-05 01:39:55'),
	(10, '["167290816578.jpg","167290816559.jpg","16729081655.jpg","167290816524.jpg","167290816597.jpg","167290816519.jpg"]', 7, '2023-01-05 01:42:45', '2023-01-05 01:42:45'),
	(11, '["167290982092.jpg","167290982084.jpg","167290982029.jpg","167290982034.jpg"]', 12, '2023-01-05 02:10:20', '2023-01-05 02:10:20'),
	(12, '["167292219985.jpg","167292219974.jpg","167292219954.jpg","167292219933.jpg","167292219949.jpg","167292219922.jpg","167292219979.jpg","167292219986.jpg"]', 13, '2023-01-05 05:36:39', '2023-01-05 05:36:39'),
	(13, '["16729227449.jpg","167292274485.jpg","167292274445.jpg","167292274433.jpg","167292274417.jpg","167292275974.jpg","167292275952.jpg"]', 14, '2023-01-05 05:45:44', '2023-01-05 05:45:59'),
	(14, '["167292310073.jpg","167292310080.jpg","16729231007.jpg","167292310026.jpg","167292310079.jpg","167292310053.jpg","167292310056.jpg","167292310072.jpg"]', 15, '2023-01-05 05:51:40', '2023-01-05 05:51:40'),
	(15, '["1672923489100.jpg","167292348978.jpg","167292348932.jpg","167292348924.jpg","16729234898.jpg","167292348987.jpg","167292348916.jpg"]', 16, '2023-01-05 05:58:09', '2023-01-05 05:58:52'),
	(16, '["16729241112.jpg","1672924111100.jpg","167292411126.jpg","167292411145.jpg","167292411147.jpg","167292411118.jpg"]', 17, '2023-01-05 06:08:31', '2023-01-05 06:08:31'),
	(17, '["167292541967.jpg","167292541966.jpg","167292541965.jpg","167292541954.jpg","167292541982.jpg","167292541930.jpg","167292541942.jpg","167292541924.jpg"]', 18, '2023-01-05 06:30:19', '2023-01-05 06:30:19'),
	(18, '["167344350281.jpg","167344350232.jpg","167344350263.jpg","167344350273.jpg","167344350292.jpg","167344350213.jpg","167344350225.jpg","167344350299.jpg","167344350223.jpg"]', 19, '2023-01-11 06:25:02', '2023-01-11 06:25:02'),
	(19, '["167344404216.jpg","167344404214.jpg","1673444042100.jpg","167344404219.jpg","167344404210.jpg","167344404297.jpg"]', 20, '2023-01-11 06:34:02', '2023-01-11 06:34:02'),
	(20, '["167344449497.jpg","167344449494.jpg","167344449468.jpg","167344449470.jpg","167344449430.jpg","1673444494100.jpg","16734444945.jpg","167344449451.jpg"]', 21, '2023-01-11 06:41:34', '2023-01-11 06:41:34'),
	(21, '["167344494597.jpg","167344494584.jpg","167344494541.jpg","167344494514.jpg","167344494544.jpg","167344494525.jpg","167344494568.jpg"]', 22, '2023-01-11 06:49:05', '2023-01-11 06:49:05'),
	(22, '["167344549688.jpg","1673445496100.jpg","167344549636.jpg","167344549639.jpg","167344549683.jpg","167344549666.jpg","167344549680.jpg","167344549692.jpg"]', 23, '2023-01-11 06:58:16', '2023-01-11 06:58:16'),
	(23, '["167344591732.jpg","167344591797.jpg","167344591774.jpg","167344591714.jpg","167344591728.jpg","167344591731.jpg","167344591759.jpg","167344591743.jpg"]', 24, '2023-01-11 07:05:17', '2023-01-11 07:05:17'),
	(24, '["167344628140.jpg","167344692759.jpg","167344692798.jpg"]', 11, '2023-01-11 07:11:21', '2023-01-11 07:22:35'),
	(25, '["167384283182.jpg","167384283172.jpg","167384283111.jpg","167384283191.jpg","167384283198.jpg","167384283112.jpg","167384283118.jpg"]', 25, '2023-01-15 21:20:31', '2023-01-15 21:20:31'),
	(26, '["167384324655.jpg","167384324687.jpg","167384324694.jpg","167384324698.jpg","167384324656.jpg"]', 26, '2023-01-15 21:27:26', '2023-01-15 21:27:26'),
	(27, '["167385472239.jpg","167385472259.jpg","167385472223.jpg","167385472217.jpg","167385472261.jpg","167385472294.jpg","167385472288.jpg","167385472236.jpg"]', 27, '2023-01-16 00:38:42', '2023-01-16 00:38:42'),
	(28, '["167385537793.jpg","167385537754.jpg","16738553776.jpg","167385537798.jpg","167385537779.jpg","167385537724.jpg","167385537714.jpg"]', 28, '2023-01-16 00:49:37', '2023-01-16 00:49:37');

-- Dumping structure for table mobile_store_db.manufacturers
CREATE TABLE IF NOT EXISTS `manufacturers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mobile_store_db.manufacturers: ~0 rows (approximately)
INSERT INTO `manufacturers` (`id`, `name`, `logo`, `address`, `phone`, `email`, `created_at`, `updated_at`) VALUES
	(1, 'Samsung', 'images/Samsung/logo.png', 'Korea', '09090909', 'samsung@gmail.com', '2022-12-27 01:03:44', '2022-12-27 01:13:24'),
	(2, 'Nokia', 'images/Nokia/logo.png', '404', 'Japan', 'nokialo@gmail.com', '2022-12-27 01:17:52', '2022-12-27 01:17:52'),
	(3, 'IPhone', 'images/IPhone/logo.png', 'L/A', 'America', 'iP@gmail.com', '2022-12-27 01:18:34', '2022-12-27 01:18:34'),
	(4, 'Xiaomi', 'images/Xiaomi/logo.png', 'China', '012345767', 'xiaomi@gmail.com', '2022-12-27 01:19:14', '2022-12-27 01:19:14'),
	(5, 'Itel', 'images/Itel/logo.png', 'Not found', '112233', 'itel@gmail.com', '2022-12-27 01:19:47', '2022-12-27 01:19:47'),
	(6, 'Philips', 'images/Philips/logo.png', 'Viet Nam', '043291', 'philips@gmail.com', '2022-12-27 01:20:19', '2023-01-15 21:14:43'),
	(7, 'Mobell', 'images/Mobell/logo.png', 'Malaysia', '23213749', 'mobell@gmail.com', '2022-12-27 01:20:52', '2022-12-27 01:20:52'),
	(8, 'Oppo', 'images/Oppo/logo.png', 'China', '111', 'oppo@gmail.com', '2022-12-27 01:21:27', '2022-12-27 01:21:27'),
	(9, 'Realme', 'images/Realme/logo.png', 'China', '2348791', 'realme@gmail.com', '2022-12-27 01:21:52', '2022-12-27 01:21:52'),
	(10, 'Tcl', 'images/Tcl/logo.png', 'Singrapo', '111', 'tcl@gmail.com', '2022-12-27 01:22:22', '2022-12-27 01:22:22'),
	(11, 'Vivo', 'images/Vivo/logo.png', 'Viet Nam', '273462', 'vivo@gmail.com', '2022-12-27 01:22:47', '2022-12-27 01:22:47'),
	(12, 'Mobiistar', 'images/Mobiistar/logo.png', 'abc', '092282', 'mmm@gm.com', '2023-01-14 08:21:28', '2023-01-14 08:21:28');

-- Dumping structure for table mobile_store_db.order_confirm
CREATE TABLE IF NOT EXISTS `order_confirm` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint NOT NULL,
  `admin_id` bigint unsigned NOT NULL,
  `bill_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_confirm_admin_id_foreign` (`admin_id`),
  KEY `order_confirm_bill_id_foreign` (`bill_id`),
  CONSTRAINT `order_confirm_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`),
  CONSTRAINT `order_confirm_bill_id_foreign` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mobile_store_db.order_confirm: ~0 rows (approximately)
-- INSERT INTO `order_confirm` (`id`, `status`, `admin_id`, `bill_id`, `created_at`, `updated_at`) VALUES
-- 	(1, 1, 1, 12, '2023-02-17 19:50:17', '2023-02-17 19:50:17'),
-- 	(2, 1, 1, 7, '2023-02-17 19:50:27', '2023-02-17 19:50:27'),
-- 	(3, 2, 1, 1, '2023-02-17 19:50:31', '2023-02-17 19:50:31');

-- Dumping structure for table mobile_store_db.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mobile_store_db.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table mobile_store_db.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `manufacturer_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_manufacturer_id_foreign` (`manufacturer_id`),
  CONSTRAINT `products_manufacturer_id_foreign` FOREIGN KEY (`manufacturer_id`) REFERENCES `manufacturers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mobile_store_db.products: ~0 rows (approximately)
INSERT INTO `products` (`id`, `name`, `description`, `image`, `active`, `manufacturer_id`, `created_at`, `updated_at`) VALUES
	(1, 'iPhone 11', 'Apple đã chính thức trình làng bộ 3 siêu phẩm iPhone 11, trong đó phiên bản iPhone 11 64GB có mức giá rẻ nhất nhưng vẫn được nâng cấp mạnh mẽ như iPhone Xr ra mắt trước đó.', 'images/IPhone/iPhone 11/product.png', 1, 3, '2022-12-29 18:12:15', '2023-01-15 03:18:58'),
	(2, 'iPhone 12', 'Trong những tháng cuối năm 2020, Apple đã chính thức giới thiệu đến người dùng cũng như iFan thế hệ iPhone 12 series mới với hàng loạt tính năng bứt phá, thiết kế được lột xác hoàn toàn, hiệu năng đầy mạnh mẽ. Apple đã trang bị con chip mới nhất của hãng (tính đến 11/2020) cho iPhone 12 đó là A14 Bionic, được sản xuất trên tiến trình 5 nm với hiệu suất ổn định hơn so với chip A13 được trang bị trên phiên bản tiền nhiệm iPhone 11.', 'images/IPhone/iPhone 12/product.png', 1, 3, '2022-12-29 18:12:51', '2023-01-15 03:19:01'),
	(3, 'iPhone 13', 'Trong khi sức hút đến từ bộ 4 phiên bản iPhone 12 vẫn chưa nguội đi, thì hãng điện thoại Apple đã mang đến cho người dùng một siêu phẩm mới iPhone 13 với nhiều cải tiến thú vị sẽ mang lại những trải nghiệm hấp dẫn nhất cho người dùng. Con chip Apple A15 Bionic siêu mạnh được sản xuất trên quy trình 5 nm giúp iPhone 13 đạt hiệu năng ấn tượng, với CPU nhanh hơn 50%, GPU nhanh hơn 30% so với các đối thủ trong cùng phân khúc. Nhờ hiệu năng được cải tiến, người dùng có được những trải nghiệm tốt hơn trên điện thoại khi dùng các ứng dụng chỉnh sửa ảnh hay chiến các tựa game đồ họa cao mượt mà. Mạng 5G được cải thiện chất lượng với nhiều băng tần hơn, với 5G giúp điện thoại xem trực tuyến hay tải xuống các ứng dụng và tài liệu đều đạt tốc độ nhanh chóng. Không chỉ vậy, siêu phẩm mới này còn có chế độ dữ liệu thông minh, tự động phát hiện và giảm tải tốc độ mạng để tiết kiệm năng lượng khi không cần dùng tốc độ cao. iPhone 13 sử dụng tấm nền OLED với kích thước màn hình 6.1 inch cho chất lượng màu sắc và chi tiết hình ảnh sắc nét, sống động, độ phân giải đạt 1170 x 2532 Pixels. Nhờ có công nghệ Super Retina XDR giúp cho máy đạt độ sáng 800 nits, tối đa lên đến 1200 nits cùng dải màu rộng P3, tỷ lệ tương phản lớn giúp ổn định tốt màu sắc và chất lượng hình ảnh hiển thị trong nhiều điều kiện sáng khác nhau, kể cả môi trường nắng gắt hay ánh sáng chói.', 'images/IPhone/iPhone 13/product.png', 1, 3, '2022-12-29 18:13:43', '2023-01-15 03:18:56'),
	(4, 'iPhone 13 mini', 'Trong khi sức hút đến từ bộ 4 phiên bản iPhone 12 vẫn chưa nguội đi, thì hãng điện thoại Apple đã mang đến cho người dùng một siêu phẩm mới iPhone 13 với nhiều cải tiến thú vị sẽ mang lại những trải nghiệm hấp dẫn nhất cho người dùng. Con chip Apple A15 Bionic siêu mạnh được sản xuất trên quy trình 5 nm giúp iPhone 13 đạt hiệu năng ấn tượng, với CPU nhanh hơn 50%, GPU nhanh hơn 30% so với các đối thủ trong cùng phân khúc. Nhờ hiệu năng được cải tiến, người dùng có được những trải nghiệm tốt hơn trên điện thoại khi dùng các ứng dụng chỉnh sửa ảnh hay chiến các tựa game đồ họa cao mượt mà. Mạng 5G được cải thiện chất lượng với nhiều băng tần hơn, với 5G giúp điện thoại xem trực tuyến hay tải xuống các ứng dụng và tài liệu đều đạt tốc độ nhanh chóng. Không chỉ vậy, siêu phẩm mới này còn có chế độ dữ liệu thông minh, tự động phát hiện và giảm tải tốc độ mạng để tiết kiệm năng lượng khi không cần dùng tốc độ cao. iPhone 13 sử dụng tấm nền OLED với kích thước màn hình 6.1 inch cho chất lượng màu sắc và chi tiết hình ảnh sắc nét, sống động, độ phân giải đạt 1170 x 2532 Pixels. Nhờ có công nghệ Super Retina XDR giúp cho máy đạt độ sáng 800 nits, tối đa lên đến 1200 nits cùng dải màu rộng P3, tỷ lệ tương phản lớn giúp ổn định tốt màu sắc và chất lượng hình ảnh hiển thị trong nhiều điều kiện sáng khác nhau, kể cả môi trường nắng gắt hay ánh sáng chói.', 'images/IPhone/iPhone 13 mini/product.png', 1, 3, '2022-12-29 18:14:17', '2023-01-15 03:19:33'),
	(5, 'iPhone 13 Pro', 'Trong khi sức hút đến từ bộ 4 phiên bản iPhone 12 vẫn chưa nguội đi, thì hãng điện thoại Apple đã mang đến cho người dùng một siêu phẩm mới iPhone 13 với nhiều cải tiến thú vị sẽ mang lại những trải nghiệm hấp dẫn nhất cho người dùng. Con chip Apple A15 Bionic siêu mạnh được sản xuất trên quy trình 5 nm giúp iPhone 13 đạt hiệu năng ấn tượng, với CPU nhanh hơn 50%, GPU nhanh hơn 30% so với các đối thủ trong cùng phân khúc. Nhờ hiệu năng được cải tiến, người dùng có được những trải nghiệm tốt hơn trên điện thoại khi dùng các ứng dụng chỉnh sửa ảnh hay chiến các tựa game đồ họa cao mượt mà. Mạng 5G được cải thiện chất lượng với nhiều băng tần hơn, với 5G giúp điện thoại xem trực tuyến hay tải xuống các ứng dụng và tài liệu đều đạt tốc độ nhanh chóng. Không chỉ vậy, siêu phẩm mới này còn có chế độ dữ liệu thông minh, tự động phát hiện và giảm tải tốc độ mạng để tiết kiệm năng lượng khi không cần dùng tốc độ cao. iPhone 13 sử dụng tấm nền OLED với kích thước màn hình 6.1 inch cho chất lượng màu sắc và chi tiết hình ảnh sắc nét, sống động, độ phân giải đạt 1170 x 2532 Pixels. Nhờ có công nghệ Super Retina XDR giúp cho máy đạt độ sáng 800 nits, tối đa lên đến 1200 nits cùng dải màu rộng P3, tỷ lệ tương phản lớn giúp ổn định tốt màu sắc và chất lượng hình ảnh hiển thị trong nhiều điều kiện sáng khác nhau, kể cả môi trường nắng gắt hay ánh sáng chói.', 'images/IPhone/iPhone 13 Pro/product.png', 1, 3, '2022-12-29 18:14:41', '2023-01-15 03:18:41'),
	(6, 'iPhone 14', 'iPhone 14 được xem là mẫu smartphone bùng nổ của nhà táo trong năm 2022, ấn tượng với ngoại hình trẻ trung, màn hình chất lượng đi kèm với những cải tiến về hệ điều hành và thuật toán xử lý hình ảnh, giúp máy trở thành cái tên thu hút được đông đảo người dùng quan tâm tại thời điểm ra mắt.\r\niPhone 14 sở hữu thiết kế cao cấp\r\nVới phiên bản tiêu chuẩn thì nhà Apple vẫn giữ nguyên kiểu dáng thiết kế so với thế hệ tiền nhiệm, vẫn là mặt lưng phẳng cùng bộ khung vuông giúp máy trở nên hiện đại hơn.', 'images/IPhone/iPhone 14/product.png', 1, 3, '2022-12-29 18:15:09', '2023-01-15 03:18:52'),
	(7, 'iPhone 14 Pro Max', 'iPhone 14 được xem là mẫu smartphone bùng nổ của nhà táo trong năm 2022, ấn tượng với ngoại hình trẻ trung, màn hình chất lượng đi kèm với những cải tiến về hệ điều hành và thuật toán xử lý hình ảnh, giúp máy trở thành cái tên thu hút được đông đảo người dùng quan tâm tại thời điểm ra mắt.', 'images/IPhone/iPhone 14 Pro Max/product.png', 1, 3, '2022-12-29 18:15:43', '2023-01-15 03:18:44'),
	(8, 'iPhone 14 Pro', 'iPhone 14 được xem là mẫu smartphone bùng nổ của nhà táo trong năm 2022, ấn tượng với ngoại hình trẻ trung, màn hình chất lượng đi kèm với những cải tiến về hệ điều hành và thuật toán xử lý hình ảnh, giúp máy trở thành cái tên thu hút được đông đảo người dùng quan tâm tại thời điểm ra mắt.', 'images/IPhone/iPhone 14 Pro/product.png', 1, 3, '2022-12-29 18:16:12', '2023-02-03 01:52:33'),
	(9, 'Samsung Galaxy A13', 'Nhằm mang trải nghiệm tốt hơn trên dòng sản phẩm giá rẻ, Samsung cho ra mắt Galaxy A13 4G với một hiệu năng ổn định, camera chụp ảnh sắc nét và viên pin khủng đáp ứng nhu cầu sử dụng cả ngày cho bạn cùng một mức giá trang bị cực kỳ phải chăng.', 'images/Samsung/Samsung Galaxy A13/product.png', 1, 1, '2022-12-31 01:48:45', '2023-01-15 03:19:39'),
	(10, 'Samsung Galaxy A22', 'Samsung chào đón mùa hè 2021 bằng sự ra mắt của bộ đôi Galaxy A22 và Galaxy A22 5G với nhiều thông số ấn tượng. Trong đó, Galaxy A22 sở hữu viên pin đầy năng suất, hiệu năng gaming mạnh mẽ và màn hình lớn có khả năng hiển thị tốt.', 'images/Samsung/Samsung Galaxy A22/product.png', 1, 1, '2022-12-31 06:04:42', '2023-01-14 07:57:02'),
	(11, 'Nokia black future', 'Bền bỉ theo năm tháng, chiến mọi loại game. 3, 4 người dùng vô tư.', 'images/Nokia/Nokia black future/product.png', 1, 2, '2023-01-05 01:47:28', '2023-01-14 07:56:59'),
	(12, 'Nokia G11', 'Nokia G11 được hãng cho ra mắt với hiệu năng ổn định, màn hình kích thước lớn mang đến những trải nghiệm giải trí tuyệt vời cùng thời gian sử dụng lâu dài với viên pin cực khủng.', 'images/Nokia/Nokia G11/product.png', 1, 2, '2023-01-05 02:08:18', '2023-01-15 03:20:01'),
	(13, 'Samsung Galaxy S22 Ultra 5G', 'Galaxy S22 Ultra 5G chiếc smartphone cao cấp nhất trong bộ 3 Galaxy S22 series mà Samsung đã cho ra mắt. Tích hợp bút S Pen hoàn hảo trong thân máy, trang bị vi xử lý mạnh mẽ cho các tác vụ sử dụng vô cùng mượt mà và nổi bật hơn với cụm camera không viền độc đáo mang đậm dấu ấn riêng.', 'images/Samsung/Samsung Galaxy S22 Ultra 5G/product.png', 1, 1, '2023-01-05 05:32:05', '2023-01-14 07:57:05'),
	(14, 'Samsung Galaxy M53', 'Có lẽ 2022 là một năm bùng nổ của nhà Samsung, khi hãng liên tục trình làng nhiều sản phẩm có cấu hình mạnh mẽ cùng một mức giá bán hợp lý trên thị trường smartphone tầm trung và giá rẻ, tiêu biểu trong số đó có Samsung Galaxy M53 được xem là cái tên được cộng đồng người dùng tích cực quan tâm và săn đón kể cả khi chưa ra mắt.', 'images/Samsung/Samsung Galaxy M53/product.png', 1, 1, '2023-01-05 05:41:52', '2023-01-15 03:21:57'),
	(15, 'Samsung Galaxy A23', 'Samsung đã cho ra mắt mẫu điện thoại Samsung Galaxy A23 5G 4GB, là một phiên bản được nâng cấp hỗ trợ kết nối 5G hiện đại của Galaxy A23 ra mắt hồi tháng 3/2022.', 'images/Samsung/Samsung Galaxy A23/product.png', 1, 1, '2023-01-05 05:47:31', '2023-01-14 07:57:08'),
	(16, 'Itel L6502', 'Sở hữu một smartphone có ngoại hình đẹp với cấu hình tốt, giá rẻ không còn là điều không tưởng với Itel L6502, một phiên bản đẹp, giá tốt đến từ Itel đã sẵn sàng cho bạn trải nghiệm.', 'images/Itel/Itel L6502/product.png', 1, 5, '2023-01-05 05:54:24', '2023-01-15 21:05:21'),
	(17, 'Xiaomi Redmi 9A', 'Xiaomi Redmi 9A - chiếc smartphone đến từ Xiaomi hướng tới nhóm khách hàng đang tìm kiếm cho mình một sản phẩm với cấu hình tốt giá thành phải chăng, cũng như được trang bị đầy đủ các tính năng ấn tượng.', 'images/Xiaomi/Xiaomi Redmi 9A/product.png', 1, 4, '2023-01-05 06:06:24', '2023-01-15 03:18:33'),
	(18, 'Xiaomi 12T', 'Xiaomi 12T series đã ra mắt trong sự kiện của Xiaomi vào ngày 4/10, trong đó có Xiaomi 12T 5G 128GB - máy sở hữu nhiều công nghệ hàng đầu trong giới smartphone tiêu biểu như: Chipset mạnh mẽ đến từ MediaTek, camera 108 MP sắc nét cùng khả năng sạc 120 W siêu nhanh.', 'images/Xiaomi/Xiaomi 12T/product.png', 1, 4, '2023-01-05 06:11:02', '2023-01-15 03:19:49'),
	(19, 'OPPO A55', 'OPPO cho ra mắt OPPO A55 4G chiếc smartphone giá rẻ tầm trung có thiết kế đẹp mắt, cấu hình khá ổn, cụm camera chất lượng và dung lượng pin ấn tượng, mang đến một lựa chọn trải nghiệm thú vị vừa túi tiền cho người tiêu dùng.', 'images/Oppo/OPPO A55/product.png', 1, 8, '2023-01-11 06:19:28', '2023-01-15 03:19:47'),
	(20, 'OPPO A96', 'OPPO A96 là cái tên được nhắc đến khá nhiều trên các diễn đàn công nghệ hiện nay, nhờ sở hữu một ngoại hình hết sức bắt mắt cùng hàng loạt các thông số ấn tượng trong phân khúc giá như hiệu năng cao, camera chụp ảnh sắc nét.', 'images/Oppo/OPPO A96/product.png', 1, 8, '2023-01-11 06:31:28', '2023-01-25 20:22:56'),
	(21, 'Xiaomi Redmi Note 11', 'Xiaomi Redmi Note 11 Pro 4G mang trong mình khá nhiều những nâng cấp cực kì sáng giá. Là chiếc điện thoại có màn hình lớn, tần số quét 120 Hz, hiệu năng ổn định cùng một viên pin siêu trâu.', 'images/Xiaomi/Xiaomi Redmi Note 11/product.png', 1, 4, '2023-01-11 06:36:01', '2023-01-15 03:21:53'),
	(22, 'Vivo Y16', 'Vivo Y16 64GB tiếp tục sẽ là cái tên được hãng bổ sung cho bộ sưu tập điện thoại Vivo dòng Y trong thời điểm cuối năm 2022, với mục tiêu mang đến nhiều trải nghiệm tốt hơn đối với dòng sản phẩm giá rẻ, Vivo hứa hẹn sẽ mang lại cho người dùng những trải nghiệm vượt xa mong đợi nhờ việc trang bị nhiều công nghệ xịn sò.', 'images/Vivo/Vivo Y16/product.png', 1, 11, '2023-01-11 06:45:31', '2023-01-15 03:18:27'),
	(23, 'Realme 9i', 'Realme đang ngày càng cải thiện hơn rất nhiều ở các sản phẩm của họ và sản phẩm gần đây nhất đó là dòng điện thoại Realme 9i. Chiếc điện thoại này được sở hữu con chip Snapdragon 680 kết hợp cùng với các tiện ích khác, hứa hẹn sẽ mang lại cho bạn sự trải nghiệm hiệu năng ổn định, mượt mà.', 'images/Realme/Realme 9i/product.png', 1, 9, '2023-01-11 06:53:40', '2023-01-15 03:18:25'),
	(24, 'Realme C35', 'Điện thoại Realme C35 thuộc phân khúc giá rẻ được nhà Realme cho ra mắt với thiết kế trẻ trung, dung lượng pin lớn cùng camera hỗ trợ nhiều tính năng. Đây sẽ là thiết bị liên lạc, giải trí và làm việc ổn định,… cho các nhu cầu sử dụng của bạn.', 'images/Realme/Realme C35/product.png', 1, 9, '2023-01-11 07:01:25', '2023-01-15 03:18:21'),
	(25, 'Philips V787', '2 sim, 2 sóng, 1 tình yêu.', 'images/Philips/Philips V787/product.png', 1, 6, '2023-01-15 21:18:22', '2023-01-15 21:18:26'),
	(26, 'Mobell M539', 'Cấu hình khủng, gọn nhẹ.', 'images/Mobell/Mobell M539/product.png', 1, 7, '2023-01-15 21:23:34', '2023-01-15 21:23:38'),
	(27, 'OPPO Find X5 Pro 5G', 'OPPO Find X5 Pro 5G có lẽ là cái tên sáng giá được xướng tên trong danh sách điện thoại có thiết kế ấn tượng trong năm 2022. Máy được hãng cho ra mắt với một diện mạo độc lạ chưa từng có, cùng với đó là những nâng cấp về chất lượng ở camera nhờ sự hợp tác với nhà sản xuất máy ảnh Hasselblad. ', 'images/Oppo/OPPO Find X5 Pro 5G/product.png', 1, 8, '2023-01-16 00:33:45', '2023-01-16 00:33:49'),
	(28, 'TCL 30 SE', 'Cuối cùng thì chiếc điện thoại TCL 30 SE cũng đã chính thức kinh doanh tại thị trường Việt Nam vào tháng 09/2022 với một mức giá bán phải chăng, nhằm chiếm được cảm tình của phần đông người dùng điện thoại thì hãng trang bị cho máy khá nhiều thông số nổi bật để bạn có thể trải nghiệm các tác vụ hàng ngày tốt hơn.', 'images/Tcl/TCL 30 SE/product.png', 1, 10, '2023-01-16 00:45:25', '2023-01-16 00:45:28');

-- Dumping structure for table mobile_store_db.rates
CREATE TABLE IF NOT EXISTS `rates` (
  `user_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `star` tinyint NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`,`product_id`),
  KEY `rates_product_id_foreign` (`product_id`),
  CONSTRAINT `rates_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `rates_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mobile_store_db.rates: ~0 rows (approximately)
-- INSERT INTO `rates` (`user_id`, `product_id`, `star`, `comment`, `created_at`, `updated_at`) VALUES
-- 	(5, 21, 4, 'sản phẩm chất lượng', '2023-01-28 19:26:19', '2023-01-28 19:26:19');

-- Dumping structure for table mobile_store_db.types
CREATE TABLE IF NOT EXISTS `types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ram` int NOT NULL,
  `disk` int NOT NULL,
  `pin` int NOT NULL,
  `chip` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `color` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int NOT NULL DEFAULT '0',
  `sold` int NOT NULL DEFAULT '0',
  `product_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `types_product_id_foreign` (`product_id`),
  CONSTRAINT `types_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=136 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mobile_store_db.types: ~0 rows (approximately)
INSERT INTO `types` (`id`, `ram`, `disk`, `pin`, `chip`, `price`, `color`, `quantity`, `sold`, `product_id`, `created_at`, `updated_at`) VALUES
	(1, 4, 128, 2438, 'Apple A15 Bionic 6', 17490000, 'Đen', 40, 4, 4, NULL, '2023-01-23 20:44:08'),
	(2, 4, 128, 2438, 'Apple A15 Bionic 6', 17490000, 'Xanh dương', 23, 0, 4, NULL, NULL),
	(3, 4, 64, 3110, 'Apple A13 Bionic', 11690000, 'Trắng', 0, 0, 1, NULL, '2023-01-23 19:57:31'),
	(4, 4, 64, 3110, 'Apple A13 Bionic', 11690000, 'Đen', 58, 0, 1, NULL, NULL),
	(5, 4, 64, 3110, 'Apple A13 Bionic', 11690000, 'Vàng', 12, 0, 1, NULL, NULL),
	(6, 4, 64, 3110, 'Apple A13 Bionic', 11690000, 'Đỏ', 33, 0, 1, NULL, NULL),
	(7, 4, 128, 3110, 'Apple A13 Bionic', 12490000, 'Đen', 37, 0, 1, NULL, NULL),
	(8, 4, 128, 3110, 'Apple A13 Bionic', 12490000, 'Trắng', 83, 0, 1, NULL, NULL),
	(9, 4, 64, 2815, 'Apple A14 Bionic', 15990000, 'Tím', 22, 0, 2, NULL, NULL),
	(10, 4, 64, 2815, 'Apple A14 Bionic', 15990000, 'Đen', 19, 0, 2, NULL, NULL),
	(11, 4, 64, 2815, 'Apple A14 Bionic', 15990000, 'Xanh lá', 50, 0, 2, NULL, NULL),
	(12, 4, 64, 2815, 'Apple A14 Bionic', 15990000, 'Xanh dương', 4, 0, 2, NULL, NULL),
	(13, 4, 64, 2815, 'Apple A14 Bionic', 15990000, 'Đỏ', 77, 0, 2, NULL, NULL),
	(14, 4, 64, 2815, 'Apple A14 Bionic', 15990000, 'Trắng', 90, 0, 2, NULL, NULL),
	(15, 4, 128, 2815, 'Apple A14 Bionic', 18490000, 'Trắng', 120, 0, 2, NULL, NULL),
	(16, 4, 128, 2815, 'Apple A14 Bionic', 18490000, 'Xanh lá', 31, 0, 2, NULL, NULL),
	(17, 4, 128, 2815, 'Apple A14 Bionic', 18490000, 'Xanh dương', 70, 0, 2, NULL, NULL),
	(18, 4, 128, 2815, 'Apple A14 Bionic', 18490000, 'Đỏ', 99, 0, 2, NULL, NULL),
	(19, 4, 128, 2815, 'Apple A14 Bionic', 18490000, 'Đen', 3, 0, 2, NULL, NULL),
	(22, 4, 128, 3240, 'Apple A15 Bionic', 19990000, 'Trắng', 6, 0, 3, NULL, '2023-01-23 19:39:43'),
	(23, 4, 128, 3240, 'Apple A15 Bionic', 19990000, 'Hồng', 55, 0, 3, NULL, NULL),
	(24, 4, 128, 3240, 'Apple A15 Bionic', 19990000, 'Đen', 32, 0, 3, NULL, NULL),
	(25, 4, 128, 3240, 'Apple A15 Bionic', 19990000, 'Xanh lá', 22, 0, 3, NULL, NULL),
	(26, 4, 128, 3240, 'Apple A15 Bionic', 19990000, 'Xanh dương', 11, 0, 3, NULL, NULL),
	(27, 4, 256, 3240, 'Apple A15 Bionic', 22490000, 'Xanh dương', 89, 0, 3, NULL, NULL),
	(28, 4, 512, 3240, 'Apple A15 Bionic', 24990000, 'Xanh dương', 44, 0, 3, NULL, NULL),
	(29, 6, 1024, 3095, 'Apple A15 Bionic', 30490000, 'Xám', 56, 0, 5, NULL, NULL),
	(30, 6, 1024, 3095, 'Apple A15 Bionic', 30490000, 'Xanh dương', 23, 0, 5, NULL, NULL),
	(31, 6, 1024, 3095, 'Apple A15 Bionic', 30490000, 'Bạc', 55, 0, 5, NULL, NULL),
	(32, 6, 1024, 3095, 'Apple A15 Bionic', 30490000, 'Vàng đồng', 21, 0, 5, NULL, NULL),
	(33, 4, 128, 5000, 'Exynos 850', 3990000, 'Cam', 45, 0, 9, NULL, NULL),
	(34, 4, 128, 5000, 'Exynos 850', 3990000, 'Đen', 21, 0, 9, NULL, NULL),
	(35, 4, 128, 5000, 'Exynos 850', 3990000, 'Xanh dương', 66, 0, 9, NULL, NULL),
	(36, 6, 128, 5000, 'Exynos 850', 4290000, 'Xanh dương', 89, 0, 9, NULL, NULL),
	(37, 6, 128, 5000, 'Exynos 850', 4290000, 'Đen', 22, 0, 9, NULL, NULL),
	(38, 6, 128, 5000, 'Exynos 850', 4290000, 'Cam', 170, 0, 9, NULL, NULL),
	(39, 6, 128, 5000, 'MediaTek MT6769V (Helio G80)', 5300000, 'Tím', 200, 0, 10, NULL, NULL),
	(40, 6, 128, 5000, 'MediaTek MT6769V (Helio G80)', 5300000, 'Đen', 53, 0, 10, NULL, NULL),
	(41, 6, 128, 3279, 'Apple A15 Bionic 6', 22490000, 'Đen', 7, 4, 6, NULL, '2023-01-23 20:33:51'),
	(42, 6, 128, 3279, 'Apple A15 Bionic 6', 22490000, 'Tím nhạt', 5, 0, 6, NULL, NULL),
	(43, 6, 128, 3279, 'Apple A15 Bionic 6', 22490000, 'Trắng', 67, 0, 6, NULL, NULL),
	(44, 6, 128, 3279, 'Apple A15 Bionic 6', 22490000, 'Xanh dương', 69, 0, 6, NULL, NULL),
	(45, 6, 128, 3279, 'Apple A15 Bionic 6', 22490000, 'Đỏ', 43, 0, 6, NULL, NULL),
	(46, 6, 256, 3279, 'Apple A15 Bionic 6', 24490000, 'Đen', 12, 0, 6, NULL, NULL),
	(47, 6, 256, 3279, 'Apple A15 Bionic 6', 24490000, 'Trắng', 43, 0, 6, NULL, NULL),
	(48, 6, 256, 3279, 'Apple A15 Bionic 6', 24490000, 'Xanh dương', 34, 0, 6, NULL, NULL),
	(49, 6, 256, 3279, 'Apple A15 Bionic 6', 24490000, 'Đỏ', 84, 0, 6, NULL, NULL),
	(50, 6, 256, 3279, 'Apple A15 Bionic 6', 24490000, 'Tím nhạt', 22, 0, 6, NULL, NULL),
	(51, 6, 512, 3279, 'Apple A15 Bionic 6', 28490000, 'Tím nhạt', 194, 0, 6, NULL, NULL),
	(52, 6, 128, 4323, 'Apple A16 Bionic', 33190000, 'Vàng', 4, 0, 7, NULL, '2023-01-23 19:39:43'),
	(53, 6, 128, 4323, 'Apple A16 Bionic', 33190000, 'Đen', 4, 0, 7, NULL, NULL),
	(54, 6, 128, 4323, 'Apple A16 Bionic', 33190000, 'Bạc', 25, 0, 7, NULL, NULL),
	(55, 6, 128, 4323, 'Apple A16 Bionic', 33190000, 'Tím', 33, 0, 7, NULL, NULL),
	(56, 6, 256, 4323, 'Apple A16 Bionic', 36190000, 'Vàng', 21, 0, 7, NULL, NULL),
	(57, 6, 256, 4323, 'Apple A16 Bionic', 36190000, 'Tím', 12, 0, 7, NULL, NULL),
	(58, 6, 256, 4323, 'Apple A16 Bionic', 36190000, 'Đen', 53, 0, 7, NULL, NULL),
	(59, 6, 256, 4323, 'Apple A16 Bionic', 36190000, 'Bạc', 64, 0, 7, NULL, NULL),
	(60, 6, 128, 3200, 'Apple A16 Bionic', 30090000, 'Tím', 8, 0, 8, NULL, '2023-01-23 19:58:53'),
	(61, 6, 128, 3200, 'Apple A16 Bionic', 30090000, 'Bạc', 2, 0, 8, NULL, '2023-01-23 19:58:53'),
	(62, 6, 128, 3200, 'Apple A16 Bionic', 30090000, 'Vàng', 77, 0, 8, NULL, NULL),
	(63, 6, 128, 3200, 'Apple A16 Bionic', 30090000, 'Đen', 23, 0, 8, NULL, '2023-02-03 02:02:56'),
	(64, 6, 256, 3200, 'Apple A16 Bionic', 32890000, 'Vàng', 53, 0, 8, NULL, NULL),
	(65, 6, 256, 3200, 'Apple A16 Bionic', 32890000, 'Đen', 28, 0, 8, NULL, NULL),
	(66, 6, 256, 3200, 'Apple A16 Bionic', 32890000, 'Tím', 53, 0, 8, NULL, NULL),
	(67, 999999, 999999, 999999, '16 nhân 128 bit', 999999000, 'Đen huyền ảo', 998, 1, 11, NULL, '2023-01-23 20:47:21'),
	(68, 4, 64, 5050, 'Unisoc T606', 3190000, 'Xám', 15, 0, 12, NULL, NULL),
	(69, 4, 64, 5050, 'Unisoc T606', 3190000, 'Xanh dương', 73, 0, 12, NULL, NULL),
	(70, 8, 128, 5000, 'Snapdragon 8 Gen 1', 23990000, 'Đỏ', 82, 0, 13, NULL, NULL),
	(71, 8, 128, 5000, 'Snapdragon 8 Gen 1', 23990000, 'Trắng', 91, 0, 13, NULL, NULL),
	(72, 8, 128, 5000, 'Snapdragon 8 Gen 1', 23990000, 'Đen', 31, 0, 13, NULL, NULL),
	(73, 8, 128, 5000, 'Snapdragon 8 Gen 1', 23990000, 'Xanh lá', 49, 0, 13, NULL, NULL),
	(74, 12, 256, 5000, 'Snapdragon 8 Gen 1', 26990000, 'Xanh lá', 53, 0, 13, NULL, NULL),
	(75, 12, 256, 5000, 'Snapdragon 8 Gen 1', 26990000, 'Đen', 42, 0, 13, NULL, NULL),
	(76, 12, 256, 5000, 'Snapdragon 8 Gen 1', 26990000, 'Đỏ', 50, 0, 13, NULL, NULL),
	(77, 12, 256, 5000, 'Snapdragon 8 Gen 1', 26990000, 'Trắng', 34, 0, 13, NULL, NULL),
	(78, 12, 512, 5000, 'Snapdragon 8 Gen 1', 29000000, 'Đen', 66, 0, 13, NULL, NULL),
	(79, 12, 512, 5000, 'Snapdragon 8 Gen 1', 29990000, 'Đỏ', 53, 0, 13, NULL, NULL),
	(80, 12, 512, 5000, 'Snapdragon 8 Gen 1', 29000000, 'Trắng', 11, 0, 13, NULL, NULL),
	(81, 12, 512, 5000, 'Snapdragon 8 Gen 1', 29000000, 'Xanh lá', 65, 0, 13, NULL, NULL),
	(82, 8, 256, 5000, 'MediaTek Dimensity 900 5G', 12490000, 'Nâu', 77, 0, 14, NULL, NULL),
	(83, 8, 256, 5000, 'MediaTek Dimensity 900 5G', 12490000, 'Xanh dương', 88, 0, 14, NULL, NULL),
	(84, 8, 256, 5000, 'MediaTek Dimensity 900 5G', 12490000, 'Xanh lá', 23, 0, 14, NULL, NULL),
	(85, 4, 128, 5000, 'Snapdragon 680', 5690000, 'Cam', 55, 0, 15, NULL, NULL),
	(86, 4, 128, 5000, 'Snapdragon 680', 5690000, 'Đen', 78, 0, 15, NULL, NULL),
	(87, 4, 128, 5000, 'Snapdragon 680', 5690000, 'Xanh dương', 23, 0, 15, NULL, NULL),
	(88, 6, 128, 5000, 'Snapdragon 680', 6190000, 'Cam', 33, 0, 15, NULL, NULL),
	(89, 6, 128, 5000, 'Snapdragon 680', 6190000, 'Xanh dương', 6, 0, 15, NULL, NULL),
	(90, 6, 128, 5000, 'Snapdragon 680', 6190000, 'Đen', 32, 0, 15, NULL, NULL),
	(91, 3, 32, 4000, 'Spreadtrum SC9832E', 2290000, 'Đen', 11, 0, 16, NULL, NULL),
	(92, 3, 32, 4000, 'Spreadtrum SC9832E', 2290000, 'Xanh', 55, 0, 16, NULL, NULL),
	(93, 3, 32, 4000, 'Spreadtrum SC9832E', 2290000, 'Xanh ngọc', 53, 0, 16, NULL, NULL),
	(94, 2, 32, 5000, 'MediaTek Helio G25', 1990000, 'Xám', 88, 0, 17, NULL, NULL),
	(95, 2, 32, 5000, 'MediaTek Helio G25', 1990000, 'Xanh lam', 31, 1, 17, NULL, '2023-01-23 20:39:32'),
	(96, 8, 128, 5000, 'MediaTek Dimensity 8100 Ultra', 12490000, 'Đen', 12, 0, 18, NULL, NULL),
	(97, 8, 128, 5000, 'MediaTek Dimensity 8100 Ultra', 12490000, 'Xanh', 42, 0, 18, NULL, NULL),
	(98, 8, 256, 5000, 'MediaTek Dimensity 8100 Ultra', 12990000, 'Đen', 35, 0, 18, NULL, NULL),
	(99, 8, 256, 5000, 'MediaTek Dimensity 8100 Ultra', 12990000, 'Xanh', 75, 0, 18, NULL, NULL),
	(100, 8, 256, 5000, 'MediaTek Dimensity 8100 Ultra', 12990000, 'Bạc', 55, 0, 18, NULL, NULL),
	(101, 4, 64, 5000, 'MediaTek Helio G35', 4490000, 'Xanh lá', 7, 3, 19, '2023-01-11 06:22:57', '2023-01-24 00:58:51'),
	(102, 4, 64, 5000, 'MediaTek Helio G35', 4490000, 'Xanh dương', 23, 0, 19, '2023-01-11 06:22:57', '2023-01-11 06:22:57'),
	(103, 4, 64, 5000, 'MediaTek Helio G35', 4490000, 'Đen', 44, 0, 19, '2023-01-11 06:22:57', '2023-01-11 06:22:57'),
	(104, 8, 128, 5000, 'Snapdragon 680', 6490000, 'Đen', 31, 3, 20, '2023-01-11 06:32:34', '2023-01-23 20:52:02'),
	(105, 8, 128, 5000, 'Snapdragon 680', 6490000, 'Hồng', 23, 0, 20, '2023-01-11 06:32:34', '2023-01-11 06:32:34'),
	(106, 4, 64, 5000, 'Snapdragon 680', 40900000, 'Xám', 4, 2, 21, '2023-01-11 06:38:02', '2023-01-23 21:02:57'),
	(107, 4, 64, 5000, 'Snapdragon 680', 40900000, 'Xanh dương đậm', 4, 0, 21, '2023-01-11 06:38:02', '2023-01-11 06:38:02'),
	(108, 6, 128, 5000, 'Snapdragon 680', 49900000, 'Xanh dương đậm', 28, 0, 21, '2023-01-11 06:38:53', '2023-01-11 06:38:53'),
	(109, 6, 128, 5000, 'Snapdragon 680', 49900000, 'Xám', 49, 0, 21, '2023-01-11 06:38:53', '2023-01-11 06:38:53'),
	(110, 6, 128, 5000, 'Snapdragon 680', 49900000, 'Xanh dương nhạt', 47, 0, 21, '2023-01-11 06:38:53', '2023-01-11 06:38:53'),
	(111, 4, 128, 5000, 'Snapdragon 680', 44900000, 'Xanh dương đậm', 20, 0, 21, '2023-01-11 06:39:31', '2023-01-11 06:39:31'),
	(112, 4, 128, 5000, 'Snapdragon 680', 44900000, 'Xám', 44, 0, 21, '2023-01-11 06:39:31', '2023-01-11 06:39:31'),
	(113, 4, 128, 5000, 'Snapdragon 680', 44900000, 'Xanh dương nhạt', 12, 0, 21, '2023-01-11 06:39:31', '2023-01-11 06:39:31'),
	(114, 4, 64, 5000, 'MediaTek Helio P35', 3790000, 'Vàng', 42, 0, 22, '2023-01-11 06:46:30', '2023-01-11 06:46:30'),
	(115, 4, 64, 5000, 'MediaTek Helio P35', 3790000, 'Đen', 42, 0, 22, '2023-01-11 06:46:30', '2023-01-11 06:46:30'),
	(116, 4, 128, 5000, 'MediaTek Helio P35', 4190000, 'Vàng', 53, 0, 22, '2023-01-11 06:47:01', '2023-01-11 06:47:01'),
	(117, 4, 128, 5000, 'MediaTek Helio P35', 4190000, 'Đen', 55, 0, 22, '2023-01-11 06:47:01', '2023-01-11 06:47:01'),
	(118, 4, 64, 5000, 'Snapdragon 680', 4490000, 'Đen', 22, 1, 23, '2023-01-11 06:54:31', '2023-01-23 20:48:13'),
	(119, 4, 64, 5000, 'Snapdragon 680', 4500000, 'Xanh ngọc', 42, 0, 23, '2023-01-11 06:54:31', '2023-01-11 06:54:52'),
	(120, 6, 128, 5000, 'Snapdragon 680', 5490000, 'Đen', 42, 0, 23, '2023-01-11 06:55:36', '2023-01-11 06:55:36'),
	(121, 6, 128, 5000, 'Snapdragon 680', 5500000, 'Xanh dương', 20, 0, 23, '2023-01-11 06:55:36', '2023-01-11 06:55:51'),
	(122, 4, 64, 5000, 'Unisoc T616', 3940000, 'Xanh ngọc', 55, 0, 24, '2023-01-11 07:02:24', '2023-01-11 07:02:24'),
	(123, 4, 64, 5000, 'Unisoc T616', 3940000, 'Đen', 75, 0, 24, '2023-01-11 07:02:24', '2023-01-11 07:02:24'),
	(124, 4, 128, 5000, 'Unisoc T616', 4490000, 'Xanh ngọc', 53, 0, 24, '2023-01-11 07:02:57', '2023-01-11 07:02:57'),
	(125, 4, 128, 5000, 'Unisoc T616', 4490000, 'Đen', 15, 0, 24, '2023-01-11 07:02:57', '2023-01-11 07:02:57'),
	(126, 4, 128, 5000, 'Unisoc T616', 4490000, 'Xanh lá', 45, 0, 24, '2023-01-11 07:02:57', '2023-01-11 07:02:57'),
	(127, 2, 16, 5000, 'MediaTek MT6753', 1899000, 'Vàng', 63, 0, 25, '2023-01-15 21:19:39', '2023-01-15 21:19:39'),
	(128, 2, 16, 5000, 'MediaTek MT6753', 1899000, 'Đen', 24, 0, 25, '2023-01-15 21:19:39', '2023-01-15 21:19:39'),
	(129, 1, 128, 2000, 'Unisoc T107', 730000, 'Đỏ', 53, 0, 26, '2023-01-15 21:25:45', '2023-01-15 21:25:45'),
	(130, 1, 128, 2000, 'Unisoc T107', 730000, 'Vàng', 86, 2, 26, '2023-01-15 21:25:45', '2023-01-24 00:57:54'),
	(131, 1, 128, 2000, 'Unisoc T107', 730000, 'Đen', 23, 0, 26, '2023-01-15 21:25:45', '2023-01-15 21:25:45'),
	(132, 12, 256, 5000, 'Snapdragon 8 Gen 1', 27000000, 'Đen', 54, 1, 27, '2023-01-16 00:35:11', '2023-01-23 20:52:02'),
	(133, 12, 256, 5000, 'Snapdragon 8 Gen 1', 26990000, 'Trắng', 88, 0, 27, '2023-01-16 00:35:11', '2023-01-16 00:35:11'),
	(134, 4, 128, 5000, 'MediaTek Helio G25', 3690000, 'Xanh đậm', 94, 0, 28, '2023-01-16 00:47:11', '2023-01-16 00:47:11'),
	(135, 4, 128, 5000, 'MediaTek Helio G25', 3690000, 'Xanh nhạt', 34, 0, 28, '2023-01-16 00:47:11', '2023-01-16 00:47:11');

-- Dumping structure for table mobile_store_db.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` tinyint(1) NOT NULL DEFAULT '1',
  `dob` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `phone` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` tinyint DEFAULT NULL COMMENT 'ProviderEnum',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mobile_store_db.users: ~0 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `password`, `gender`, `dob`, `phone`, `address`, `remember_token`, `provider`, `created_at`) VALUES
	(1, 'Đạt alime', 'datanime@gmail.com', '$2y$10$lq9nSoYTIRlyk2eH0RetieNdW54GmPYosuYGcoih7zx29hILs18Bq', 1, '2022-12-31 17:00:00', '0973054222', 'Tân Bình, Tp Hồ Chí Minh', NULL, NULL, '2023-01-23 15:00:33'),
	(2, 'Đông chiến thần', 'dong.nuocmam@gmail.com', '$2y$10$325DawNjzWDTuE6k8iCbfe8pbvX.ewvCS48I4GXxCM411x8FY/3Um', 1, '2023-01-23 15:02:35', '0900101011', 'bốn bể là nhà', NULL, NULL, '2023-01-23 15:02:35'),
	(3, 'Điệp siu tiền đạo', 'diep.abc@gmail.com', '$2y$10$Rde9SuAnaRytqFj5KoLB7.h2msqA8CkWAaR8o4VgkeyYBLnkWHdVS', 1, '2023-01-23 15:05:25', '0972438181', 'biệt thự Phú Mỹ Hưng', NULL, NULL, '2023-01-23 15:05:25'),
	(4, 'Anh Đạt Messi', 'dat.messi@gmail.com', '$2y$10$YoxdubDuVRgvQ5tUAJ8LEuYR6eurQdxIlgydIXEE1ofpXjf5eIfeu', 1, '2023-01-23 15:06:12', NULL, NULL, NULL, NULL, '2023-01-23 15:06:12'),
	(5, 'Anh Nghĩa châu Phi', 'nghia.dutcuoctinh@gmail.com', '$2y$10$uEpGLUrLNtBA5BFUUDJXY.vRRy4sOhEy/x1YduZ2F/KTvbppWo/xC', 1, '2023-01-22 17:00:00', '0753252841', 'Chợ Gạo Tiền Giang', NULL, NULL, '2023-01-23 15:07:28'),
	(6, 'kẻ vô danh', '_@gmail.com', '$2y$10$OhErAIFwyPywaB6OFQmXRu.MEJ.ccaQKDGNL91uJyDT5JQ/GVZjLa', 1, '2023-02-08 17:00:05', NULL, NULL, NULL, NULL, '2023-02-08 17:00:05'),
	(7, 'Anh Đức đẹp zai', 'ducna0610@gmail.com', '$2y$10$Bf1iA9YVcRP0TDMk78sgweL4bcnGOqZs0dvKSJsDx6m5J7zDklsqe', 1, '2023-02-08 16:59:59', NULL, NULL, NULL, NULL, '2023-01-23 15:12:54'),
	(8, 'Gia Cát Lượng', 'luong_sadboi@gmail.com', '$2y$10$zGXvAmcrcd9BGrNVHI3CF.ik1gmaaAR2NGxUzPHnuQCEl55Hsj4uu', 1, '2023-01-23 15:14:11', NULL, NULL, NULL, NULL, '2023-01-23 15:14:11'),
	(9, 'Ngọc Trinh', 'ngoc@gmail.com', '$2y$10$QLvl4T5AjCWRMVtcCLu.zeQMVJyeYvrcYbF/FgqNTbCdpWFk1.iCy', 0, '1999-12-31 17:00:00', NULL, NULL, NULL, NULL, '2023-01-23 15:15:48'),
	(10, 'Giáp hồi sinh', 'tuilagiap@gmail.com', '$2y$10$OTfxxWs7IExvF9D8RLQuwu8DKDmGh/qXt9nC7vRF/llLeehQK4QaC', 1, '2023-01-23 15:21:23', '0905030201', 'Cần em hơn Cần Thơ', NULL, NULL, '2023-01-23 15:21:23'),
	(11, 'Nguyen Anh Duc', 'ducna0610@gmail.com', '$2y$10$w4BOHi4.HmPhQtJ//PVDbOq73LAXTKsXJWgs9fktWwc3MdjkA1UfS', 0, '2023-01-23 17:00:00', '0979575539', 'Thạnh Xuân 14, Q12', NULL, 1, '2023-01-24 01:15:23');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
