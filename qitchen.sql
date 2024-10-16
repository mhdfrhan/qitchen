/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE `articles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_published` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `cart_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cart_id` bigint unsigned NOT NULL,
  `menu_id` bigint unsigned NOT NULL,
  `quantity` int NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cart_items_cart_id_foreign` (`cart_id`),
  KEY `cart_items_menu_id_foreign` (`menu_id`),
  CONSTRAINT `cart_items_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cart_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `carts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `used_points` int NOT NULL DEFAULT '0',
  `discount_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `carts_user_id_foreign` (`user_id`),
  CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `discounts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_amount` bigint NOT NULL,
  `valid_until` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `menu` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint unsigned NOT NULL,
  `is_halal` tinyint(1) NOT NULL,
  `available` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_category_id_foreign` (`category_id`),
  CONSTRAINT `menu_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `menu_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `menu_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `reservation_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `reservation_id` bigint unsigned NOT NULL,
  `menu_id` bigint unsigned NOT NULL,
  `quantity` int NOT NULL,
  `price` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reservation_items_reservation_id_foreign` (`reservation_id`),
  KEY `reservation_items_menu_id_foreign` (`menu_id`),
  CONSTRAINT `reservation_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `reservation_items_reservation_id_foreign` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `reservations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `reservation_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `table_id` bigint unsigned NOT NULL,
  `reservation_date` date NOT NULL,
  `reservation_time` time NOT NULL,
  `guest_count` int NOT NULL,
  `total_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_preorder` tinyint(1) NOT NULL DEFAULT '0',
  `payment_option` int NOT NULL,
  `used_points` int NOT NULL DEFAULT '0',
  `discount_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `snap_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reservations_user_id_foreign` (`user_id`),
  KEY `reservations_table_id_foreign` (`table_id`),
  CONSTRAINT `reservations_table_id_foreign` FOREIGN KEY (`table_id`) REFERENCES `tables` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `reservations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `tables` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `table_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `floor` int NOT NULL,
  `capacity` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `loyalty_points` bigint NOT NULL DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `google_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `articles` (`id`, `image`, `title`, `slug`, `body`, `author`, `is_published`, `created_at`, `updated_at`) VALUES
(1, 'assets/img/articles/2024/bagaimana-qitchen-mendefinisikan-kembali-harmoni-rasa-dalam-setiap-gigitan.webp', 'Bagaimana Qitchen Mendefinisikan Kembali Harmoni Rasa dalam Setiap Gigitan', 'bagaimana-qitchen-mendefinisikan-kembali-harmoni-rasa-dalam-setiap-gigitan', '<div>&nbsp;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed urna erat, sodales id nisl sit amet, malesuada bibendum ex. Ut bibendum lectus id facilisis aliquam. Phasellus sed massa tristique, congue arcu id, ultrices ante. Suspendisse vel arcu id mi lobortis placerat eu aliquam nisl. Sed commodo odio nunc. Quisque a ornare lacus. Donec sit amet semper massa, id venenatis quam. Curabitur in enim non erat euismod auctor eu ut ligula.&nbsp;<br><br></div><div>&nbsp;Suspendisse non pretium purus. Nullam leo lacus, scelerisque eget turpis in, dictum mollis nibh. Quisque non luctus leo. Vestibulum a orci ante. Nunc sit amet erat ultricies, cursus ex eu, ornare elit. Cras a finibus ligula, vitae molestie sem. Nam nec dignissim dolor. Sed eget ligula in erat varius imperdiet nec porttitor libero. Donec at porttitor est. Vestibulum tristique at dolor eu consequat. Nam accumsan dolor eu condimentum sollicitudin.&nbsp;<br><br></div><div>&nbsp;Aenean quis tincidunt metus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur luctus nisl tristique odio tempus, sit amet sollicitudin dolor viverra. Nullam semper tellus diam, varius cursus mi semper tincidunt. Nam interdum justo vel pulvinar molestie. Integer et tristique nisl, vitae iaculis risus. Donec vel nisl ullamcorper, euismod augue eleifend, ullamcorper diam. Suspendisse ac facilisis ipsum, vel vulputate lectus. Aliquam eleifend nulla eget feugiat viverra. Integer tincidunt nisi non neque tempus lacinia.&nbsp;</div><div>&nbsp;Etiam nec velit velit. Donec a arcu non justo lobortis eleifend. Donec rutrum urna a scelerisque imperdiet. Sed dolor massa, egestas tristique elementum et, laoreet quis urna. Phasellus vulputate bibendum ipsum, a pellentesque enim aliquet vitae. Praesent ac dictum massa. Cras erat libero, interdum et pretium sed, porta quis tortor. Nam congue blandit sapien in posuere. Etiam pretium egestas enim, aliquam lobortis erat hendrerit id.&nbsp;<br><br></div><div>&nbsp;In consectetur, neque ut tempor maximus, orci dui tristique mauris, et imperdiet libero ante quis tellus. Vivamus varius quam eu tellus malesuada auctor. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vestibulum in condimentum libero. Nam quis tempus leo, in auctor elit. Donec vestibulum tempus metus, eget consequat mi ornare at. Proin commodo accumsan turpis eget elementum. Nullam mattis dui vitae efficitur posuere. In mollis quis libero quis facilisis. Cras ultricies at neque eget tempus. Mauris id magna massa. Nulla maximus vitae justo ullamcorper finibus. Aliquam tincidunt lacus nisl, et imperdiet augue egestas quis. Curabitur vulputate laoreet ipsum, et rhoncus lorem imperdiet sed.&nbsp;</div>', 'admin', 1, '2024-10-01 20:25:11', '2024-10-01 20:25:22');
INSERT INTO `articles` (`id`, `image`, `title`, `slug`, `body`, `author`, `is_published`, `created_at`, `updated_at`) VALUES
(2, 'assets/img/articles/2024/beberapa-rekomendasi-menu-favorit-yang-ada-di-qitchen.webp', 'Beberapa rekomendasi menu favorit yang ada di Qitchen', 'beberapa-rekomendasi-menu-favorit-yang-ada-di-qitchen', '<div>&nbsp;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed urna erat, sodales id nisl sit amet, malesuada bibendum ex. Ut bibendum lectus id facilisis aliquam. Phasellus sed massa tristique, congue arcu id, ultrices ante. Suspendisse vel arcu id mi lobortis placerat eu aliquam nisl. Sed commodo odio nunc. Quisque a ornare lacus. Donec sit amet semper massa, id venenatis quam. Curabitur in enim non erat euismod auctor eu ut ligula.&nbsp;<br><br></div><div>&nbsp;Suspendisse non pretium purus. Nullam leo lacus, scelerisque eget turpis in, dictum mollis nibh. Quisque non luctus leo. Vestibulum a orci ante. Nunc sit amet erat ultricies, cursus ex eu, ornare elit. Cras a finibus ligula, vitae molestie sem. Nam nec dignissim dolor. Sed eget ligula in erat varius imperdiet nec porttitor libero. Donec at porttitor est. Vestibulum tristique at dolor eu consequat. Nam accumsan dolor eu condimentum sollicitudin.&nbsp;<br><br></div><div>&nbsp;Aenean quis tincidunt metus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur luctus nisl tristique odio tempus, sit amet sollicitudin dolor viverra. Nullam semper tellus diam, varius cursus mi semper tincidunt. Nam interdum justo vel pulvinar molestie. Integer et tristique nisl, vitae iaculis risus. Donec vel nisl ullamcorper, euismod augue eleifend, ullamcorper diam. Suspendisse ac facilisis ipsum, vel vulputate lectus. Aliquam eleifend nulla eget feugiat viverra. Integer tincidunt nisi non neque tempus lacinia.&nbsp;<br><br></div><div>&nbsp;Etiam nec velit velit. Donec a arcu non justo lobortis eleifend. Donec rutrum urna a scelerisque imperdiet. Sed dolor massa, egestas tristique elementum et, laoreet quis urna. Phasellus vulputate bibendum ipsum, a pellentesque enim aliquet vitae. Praesent ac dictum massa. Cras erat libero, interdum et pretium sed, porta quis tortor. Nam congue blandit sapien in posuere. Etiam pretium egestas enim, aliquam lobortis erat hendrerit id.&nbsp;<br><br></div><div>&nbsp;In consectetur, neque ut tempor maximus, orci dui tristique mauris, et imperdiet libero ante quis tellus. Vivamus varius quam eu tellus malesuada auctor. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vestibulum in condimentum libero. Nam quis tempus leo, in auctor elit. Donec vestibulum tempus metus, eget consequat mi ornare at. Proin commodo accumsan turpis eget elementum. Nullam mattis dui vitae efficitur posuere. In mollis quis libero quis facilisis. Cras ultricies at neque eget tempus. Mauris id magna massa. Nulla maximus vitae justo ullamcorper finibus. Aliquam tincidunt lacus nisl, et imperdiet augue egestas quis. Curabitur vulputate laoreet ipsum, et rhoncus lorem imperdiet sed.&nbsp;</div>', 'admin', 1, '2024-10-01 20:26:00', '2024-10-01 20:26:00');
INSERT INTO `articles` (`id`, `image`, `title`, `slug`, `body`, `author`, `is_published`, `created_at`, `updated_at`) VALUES
(3, 'assets/img/articles/2024/restaurant-qitchen-berhasil-menjadi-restaurant-favorit-yang-ada-di-indonesia.jpg', 'Restaurant Qitchen berhasil menjadi restaurant favorit yang ada di Indonesia', 'restaurant-qitchen-berhasil-menjadi-restaurant-favorit-yang-ada-di-indonesia', '<div>&nbsp;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed urna erat, sodales id nisl sit amet, malesuada bibendum ex. Ut bibendum lectus id facilisis aliquam. Phasellus sed massa tristique, congue arcu id, ultrices ante. Suspendisse vel arcu id mi lobortis placerat eu aliquam nisl. Sed commodo odio nunc. Quisque a ornare lacus. Donec sit amet semper massa, id venenatis quam. Curabitur in enim non erat euismod auctor eu ut ligula.&nbsp;<br><br></div><div>&nbsp;Suspendisse non pretium purus. Nullam leo lacus, scelerisque eget turpis in, dictum mollis nibh. Quisque non luctus leo. Vestibulum a orci ante. Nunc sit amet erat ultricies, cursus ex eu, ornare elit. Cras a finibus ligula, vitae molestie sem. Nam nec dignissim dolor. Sed eget ligula in erat varius imperdiet nec porttitor libero. Donec at porttitor est. Vestibulum tristique at dolor eu consequat. Nam accumsan dolor eu condimentum sollicitudin.&nbsp;<br><br></div><div>&nbsp;Aenean quis tincidunt metus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur luctus nisl tristique odio tempus, sit amet sollicitudin dolor viverra. Nullam semper tellus diam, varius cursus mi semper tincidunt. Nam interdum justo vel pulvinar molestie. Integer et tristique nisl, vitae iaculis risus. Donec vel nisl ullamcorper, euismod augue eleifend, ullamcorper diam. Suspendisse ac facilisis ipsum, vel vulputate lectus. Aliquam eleifend nulla eget feugiat viverra. Integer tincidunt nisi non neque tempus lacinia.&nbsp;<br><br></div><div>&nbsp;Etiam nec velit velit. Donec a arcu non justo lobortis eleifend. Donec rutrum urna a scelerisque imperdiet. Sed dolor massa, egestas tristique elementum et, laoreet quis urna. Phasellus vulputate bibendum ipsum, a pellentesque enim aliquet vitae. Praesent ac dictum massa. Cras erat libero, interdum et pretium sed, porta quis tortor. Nam congue blandit sapien in posuere. Etiam pretium egestas enim, aliquam lobortis erat hendrerit id.&nbsp;<br><br></div><div>&nbsp;In consectetur, neque ut tempor maximus, orci dui tristique mauris, et imperdiet libero ante quis tellus. Vivamus varius quam eu tellus malesuada auctor. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vestibulum in condimentum libero. Nam quis tempus leo, in auctor elit. Donec vestibulum tempus metus, eget consequat mi ornare at. Proin commodo accumsan turpis eget elementum. Nullam mattis dui vitae efficitur posuere. In mollis quis libero quis facilisis. Cras ultricies at neque eget tempus. Mauris id magna massa. Nulla maximus vitae justo ullamcorper finibus. Aliquam tincidunt lacus nisl, et imperdiet augue egestas quis. Curabitur vulputate laoreet ipsum, et rhoncus lorem imperdiet sed.&nbsp;</div>', 'admin', 1, '2024-10-01 20:26:33', '2024-10-01 20:26:33');

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('356a192b7913b04c54574d18c28d46e6395428ab', 'i:2;', 1727796598);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1727796598;', 1727796598);




INSERT INTO `cart_items` (`id`, `cart_id`, `menu_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(17, 7, 1, 1, '55000', '2024-10-01 21:43:37', '2024-10-01 21:43:37');


INSERT INTO `carts` (`id`, `user_id`, `status`, `total_amount`, `used_points`, `discount_id`, `created_at`, `updated_at`) VALUES
(7, 1, 'pending', '55000', 0, NULL, '2024-10-01 21:43:37', '2024-10-01 21:43:37');


INSERT INTO `discounts` (`id`, `code`, `description`, `discount_amount`, `valid_until`, `created_at`, `updated_at`) VALUES
(1, 'DISCOUNT10', 'Diskon 10%', 10, '2024-10-31', '2024-10-01 09:52:32', '2024-10-01 09:52:32');








INSERT INTO `menu` (`id`, `image`, `name`, `description`, `price`, `category_id`, `is_halal`, `available`, `created_at`, `updated_at`) VALUES
(1, 'assets/img/menu//5U13SV6sxHnuEeAvq7jQ.png', 'BEEF CHEESE ROLL', 'The soft beef rolls are filled with cheese, giving it a blend of savory and creamy flavors.', '55000', 1, 1, 1, '2024-10-01 10:13:51', '2024-10-01 10:13:51');
INSERT INTO `menu` (`id`, `image`, `name`, `description`, `price`, `category_id`, `is_halal`, `available`, `created_at`, `updated_at`) VALUES
(2, 'assets/img/menu//denXOPPiAzcg4zwFmgix.png', 'CALIFORNIA ROLL', 'Sushi roll filled with crab meat, avocado, and cucumber, wrapped in rice and seaweed, often topped with tobiko or sesame seeds.', '65000', 1, 1, 1, '2024-10-01 10:31:27', '2024-10-01 10:31:27');
INSERT INTO `menu` (`id`, `image`, `name`, `description`, `price`, `category_id`, `is_halal`, `available`, `created_at`, `updated_at`) VALUES
(3, 'assets/img/menu//vDKnCaru4ybW1nE0ORGL.png', 'CHICKEN TERIYAKI ROLL', 'Sushi roll filled with grilled chicken glazed in teriyaki sauce, complemented by cucumber and avocado, all wrapped in rice and seaweed.', '60000', 1, 1, 1, '2024-10-01 10:32:00', '2024-10-01 10:32:00');
INSERT INTO `menu` (`id`, `image`, `name`, `description`, `price`, `category_id`, `is_halal`, `available`, `created_at`, `updated_at`) VALUES
(4, 'assets/img/menu//wS3lqYh4KqCC9ULsIPqZ.png', 'CRISPY TUNA SALAD SPICY ROLL', 'Sushi roll filled with spicy tuna salad and crunchy vegetables, wrapped in rice and seaweed, providing a delightful combination of textures and flavors.', '70000', 1, 1, 1, '2024-10-01 10:32:40', '2024-10-01 10:32:40'),
(5, 'assets/img/menu//LorIBsqGycN0lGzFue1h.png', 'DYNAMITE SALMON NIGIRI', 'Sushi dish featuring a slice of fresh salmon atop a mound of sushi rice, drizzled with spicy sauce for an extra kick of flavor.', '69000', 2, 1, 1, '2024-10-01 10:35:34', '2024-10-01 10:35:34'),
(6, 'assets/img/menu//mzACDhoHM4lecsQqOCwU.png', 'EGG NIGIRI', 'Sushi delicacy consisting of a slice of sweet, fluffy tamagoyaki (Japanese omelet) placed on a small ball of sushi rice, often garnished with a touch of wasabi.', '56000', 2, 1, 1, '2024-10-01 10:36:35', '2024-10-01 10:36:35'),
(7, 'assets/img/menu//XhwkrBkqEhtYXlbJiAe3.png', 'FATTIEST TUNA NIGIRI', 'A piece of fat-rich tuna (otoro) on top of sushi rice, giving it a melt-in-the-mouth texture and delicious flavor.', '45000', 2, 1, 1, '2024-10-01 10:37:30', '2024-10-01 10:37:30'),
(8, 'assets/img/menu//sJWbmga0yohUsYcZobVP.png', 'BAKED SALMON & EGG BOWL', 'Hearty dish featuring tender baked salmon served over a bed of rice, topped with a soft-cooked egg and drizzled with a savory sauce for added flavor.', '60000', 3, 1, 1, '2024-10-01 10:38:09', '2024-10-01 10:38:09'),
(9, 'assets/img/menu//JqqdL9Zdn0snnOFePvsk.png', 'BEEF & EGG BOWL', 'Tender slices of beef served over rice, topped with a gently cooked egg.', '58000', 3, 1, 1, '2024-10-01 10:38:57', '2024-10-01 10:38:57'),
(10, 'assets/img/menu//kuWmwgjwndufocpjRHE1.png', 'BEEF UDON', 'Thick and chewy udon noodles served in a rich broth with tender sliced beef, vegetables, and garnished with green onions and sesame seeds.', '59000', 3, 1, 1, '2024-10-01 10:39:59', '2024-10-01 10:39:59'),
(11, 'assets/img/menu//RbLuCRix1cPmEpkpPcO2.png', 'BEEF YAKINIKU BOWL', 'The grilled beef is seasoned and served over rice, accompanied by stir-fried vegetables and drizzled with a savory yakiniku sauce.', '60000', 3, 1, 1, '2024-10-01 10:40:37', '2024-10-01 10:40:37'),
(12, 'assets/img/menu//I8QtSTpUly4FdLDq54tl.png', 'SPRITE', 'a refreshing lime-flavored soft drink known for its fresh and bubbly taste.', '7000', 4, 1, 1, '2024-10-01 10:42:00', '2024-10-01 10:42:00'),
(13, 'assets/img/menu//okYGTgydlvmvIXb2yNwi.png', 'MINERAL WATER', 'Naturally sourced water enriched with essential minerals, providing a fresh and invigorating taste, is often consumed for hydration and health benefits.', '6000', 4, 1, 1, '2024-10-01 10:42:33', '2024-10-01 10:42:33'),
(14, 'assets/img/menu//zg9RVe4h8Cjf5CjToWbs.png', 'LEMON TEA', 'Soothing beverage made by steeping tea leaves with fresh lemon juice and slices, offering a refreshing balance of tangy and sweet flavors, often enjoyed hot or iced.', '8000', 4, 1, 1, '2024-10-01 10:43:05', '2024-10-01 10:43:05'),
(15, 'assets/img/menu//9q6zzOOLPY1OUgqJLC9w.png', 'SJORA PEACH', 'A refreshing peach-flavored soft drink that combines the sweetness of ripe peaches with a crunchy, fizzy texture.', '8000', 4, 1, 1, '2024-10-01 10:43:55', '2024-10-01 10:43:55'),
(17, 'assets/img/menu//B1KSPEPiB2yM9PhrxwWo.png', 'DEEP FRIED CHICKEN SALAD', 'Crispy fried chicken served on a bed of fresh vegetables, such as lettuce, tomato and cucumber.', '40000', 10, 1, 1, '2024-10-01 22:31:22', '2024-10-01 22:31:22');

INSERT INTO `menu_categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Makimono', 'A type of sushi roll.', '2024-10-01 09:52:32', '2024-10-01 09:52:32');
INSERT INTO `menu_categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(2, 'Nigiri', 'A type of inside-out sushi roll.', '2024-10-01 09:52:32', '2024-10-01 09:52:32');
INSERT INTO `menu_categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(3, 'Rice & Noodle', 'Sushi rolls with unique ingredients.', '2024-10-01 09:52:32', '2024-10-01 09:52:32');
INSERT INTO `menu_categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(4, 'Drinks', 'drinks', '2024-10-01 10:34:51', '2024-10-01 11:18:20'),
(10, 'Appetizer', 'An appetizer served with a good portion and good taste', '2024-10-01 22:26:53', '2024-10-01 22:26:53');

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '0001_01_01_000001_create_cache_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(3, '0001_01_01_000002_create_jobs_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(4, '2024_09_19_002904_create_mejas_table', 1),
(5, '2024_09_19_003000_create_menu_categories_table', 1),
(6, '2024_09_19_003214_create_menus_table', 1),
(7, '2024_09_19_003840_create_reservations_table', 1),
(8, '2024_09_19_004439_create_carts_table', 1),
(9, '2024_09_19_004548_create_cart__items_table', 1),
(10, '2024_09_19_005044_create_discounts_table', 1),
(11, '2024_09_26_044922_create_reservation_items_table', 1),
(12, '2024_09_30_083426_create_articles_table', 1);



INSERT INTO `reservation_items` (`id`, `reservation_id`, `menu_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 55000, '2024-10-01 19:09:32', '2024-10-01 19:09:32');
INSERT INTO `reservation_items` (`id`, `reservation_id`, `menu_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(2, 1, 13, 1, 6000, '2024-10-01 19:09:32', '2024-10-01 19:09:32');
INSERT INTO `reservation_items` (`id`, `reservation_id`, `menu_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(3, 2, 1, 1, 55000, '2024-10-01 20:06:43', '2024-10-01 20:06:43');
INSERT INTO `reservation_items` (`id`, `reservation_id`, `menu_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(4, 2, 5, 1, 69000, '2024-10-01 20:06:43', '2024-10-01 20:06:43'),
(5, 2, 12, 1, 7000, '2024-10-01 20:06:43', '2024-10-01 20:06:43'),
(6, 3, 1, 1, 55000, '2024-10-01 20:09:34', '2024-10-01 20:09:34'),
(7, 3, 4, 1, 70000, '2024-10-01 20:09:34', '2024-10-01 20:09:34'),
(8, 3, 3, 1, 60000, '2024-10-01 20:09:34', '2024-10-01 20:09:34'),
(9, 4, 7, 1, 45000, '2024-10-01 20:17:05', '2024-10-01 20:17:05'),
(10, 4, 15, 1, 8000, '2024-10-01 20:17:05', '2024-10-01 20:17:05'),
(11, 5, 5, 1, 69000, '2024-10-01 21:22:29', '2024-10-01 21:22:29'),
(12, 5, 10, 1, 59000, '2024-10-01 21:22:29', '2024-10-01 21:22:29'),
(13, 5, 13, 1, 6000, '2024-10-01 21:22:29', '2024-10-01 21:22:29'),
(14, 6, 1, 1, 55000, '2024-10-01 21:29:41', '2024-10-01 21:29:41'),
(15, 7, 1, 1, 55000, '2024-10-01 21:43:49', '2024-10-01 21:43:49');

INSERT INTO `reservations` (`id`, `reservation_code`, `user_id`, `table_id`, `reservation_date`, `reservation_time`, `guest_count`, `total_amount`, `status`, `is_preorder`, `payment_option`, `used_points`, `discount_id`, `snap_token`, `created_at`, `updated_at`) VALUES
(1, 'b57550be-d210-4fec-8648-da1bc8164998', 45, 8, '2024-09-01', '20:15:00', 4, '67710', 'confirmed', 0, 100, 0, NULL, '82a7552e-585c-46b3-9f10-a6b82b40f273', '2024-09-01 19:09:32', '2024-09-01 20:14:08');
INSERT INTO `reservations` (`id`, `reservation_code`, `user_id`, `table_id`, `reservation_date`, `reservation_time`, `guest_count`, `total_amount`, `status`, `is_preorder`, `payment_option`, `used_points`, `discount_id`, `snap_token`, `created_at`, `updated_at`) VALUES
(2, '2d3f37c8-a295-4728-af79-d452ddfb7914', 45, 12, '2024-09-02', '11:06:00', 6, '145410', 'cancelled', 1, 100, 0, NULL, 'ba991dd4-342c-49b5-b586-950c6d57ebcf', '2024-09-01 20:06:43', '2024-09-01 20:06:56');
INSERT INTO `reservations` (`id`, `reservation_code`, `user_id`, `table_id`, `reservation_date`, `reservation_time`, `guest_count`, `total_amount`, `status`, `is_preorder`, `payment_option`, `used_points`, `discount_id`, `snap_token`, `created_at`, `updated_at`) VALUES
(3, '9a083263-fccb-4f76-88d5-91477772be59', 45, 8, '2024-10-01', '09:10:00', 3, '205350', 'waiting', 1, 100, 0, NULL, 'ab16c754-3332-4e10-9cd3-6544d1e57d7a', '2024-10-01 20:09:34', '2024-10-01 20:13:19');
INSERT INTO `reservations` (`id`, `reservation_code`, `user_id`, `table_id`, `reservation_date`, `reservation_time`, `guest_count`, `total_amount`, `status`, `is_preorder`, `payment_option`, `used_points`, `discount_id`, `snap_token`, `created_at`, `updated_at`) VALUES
(4, '99c70624-614c-4a03-9ace-3f642dea5c05', 45, 1, '2024-10-01', '12:00:00', 1, '58830', 'confirmed', 0, 100, 0, NULL, 'da328239-7aea-4a8c-af05-cbb163c85c43', '2024-10-01 20:17:05', '2024-10-01 22:12:43'),
(5, '17a59272-058e-4c5e-9bf5-dd1479e4ce09', 45, 14, '2024-10-01', '09:00:00', 4, '41933', 'confirmed', 0, 50, 25000, '1', '4da6286e-eafc-4b13-8d3e-41ee2af50d34', '2024-10-01 21:22:29', '2024-10-01 21:51:17'),
(6, '0c74952f-1b92-4783-b0cc-359a98b68ac9', 1, 1, '2024-10-01', '12:00:00', 2, '30525', 'confirmed', 0, 50, 0, NULL, 'b2b1bbbe-45e6-4ed2-bb51-c2e6ff50e7a0', '2024-10-01 21:29:41', '2024-10-01 21:43:29'),
(7, '079c5ee4-f7b1-4059-812f-4002966a8da7', 1, 1, '2024-10-01', '14:00:00', 2, '61050', 'confirmed', 0, 100, 0, NULL, 'ac1570cc-24c5-49f7-ba50-bef2eea83388', '2024-10-01 21:43:49', '2024-10-01 21:54:58');

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('asDTMjkQSlh9qnHL8DjF4GRghbcN3ZuPOFyTwEtN', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:130.0) Gecko/20100101 Firefox/130.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZk5vNzRDdXBmbmJxMHh3M1NQckNFNkdQZ2JzWXNFSU14YTljZnlnNiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjM6InVybCI7YToxOntzOjg6ImludGVuZGVkIjtzOjMxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvZGFzaGJvYXJkIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1727798747);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('EPoHtPF7ffL1mG45r7zz9rZfyluaTPBeuqRzdblY', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiS1MwTTUwblpHZGRvRHpTRWkwQmJwRzNRN0dMT1NCeklBajZPZm1ONCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHBzOi8vcWl0Y2hlbi50ZXN0L2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1OiJzdGF0ZSI7czo0MDoiTEFTTzRndW1JUW8xVElkQmdQZ0tQMEE4MVpudXZNaDlGRkFsUlU3SCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MDoiaHR0cHM6Ly9xaXRjaGVuLnRlc3QvZGFzaGJvYXJkL21lbnUtbGlzdCI7fX0=', 1727798169);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('v6WH2UCjG2NSObHG3qyf17AIGqkqC0vIVl7msyc4', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSEZOdTdKY3dqblUwN2ZmeFEzNTNtcVo4OFRqUXF4YWU3NnBpb2NDcyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozOToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2Rhc2hib2FyZC9raXRjaGVuIjt9fQ==', 1727798169);

INSERT INTO `tables` (`id`, `table_number`, `status`, `floor`, `capacity`, `created_at`, `updated_at`) VALUES
(1, 'T-01', '1', 1, 2, '2024-10-01 09:52:32', '2024-10-01 09:52:32');
INSERT INTO `tables` (`id`, `table_number`, `status`, `floor`, `capacity`, `created_at`, `updated_at`) VALUES
(2, 'T-02', '1', 1, 4, '2024-10-01 09:52:32', '2024-10-01 09:52:32');
INSERT INTO `tables` (`id`, `table_number`, `status`, `floor`, `capacity`, `created_at`, `updated_at`) VALUES
(3, 'T-03', '1', 1, 2, '2024-10-01 09:52:32', '2024-10-01 09:52:32');
INSERT INTO `tables` (`id`, `table_number`, `status`, `floor`, `capacity`, `created_at`, `updated_at`) VALUES
(4, 'T-04', '1', 1, 6, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(5, 'T-05', '1', 1, 6, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(6, 'T-06', '1', 1, 8, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(7, 'T-07', '1', 1, 8, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(8, 'T-08', '1', 1, 4, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(9, 'T-09', '1', 1, 10, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(10, 'T-10', '1', 1, 10, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(11, 'T-11', '1', 1, 4, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(12, 'T-12', '1', 1, 6, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(13, 'T-13', '1', 1, 2, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(14, 'T-14', '1', 1, 4, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(15, 'T-15', '1', 1, 4, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(16, 'T-16', '1', 1, 6, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(17, 'T-17', '1', 1, 10, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(18, 'T-18', '1', 1, 6, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(19, 'T-19', '1', 1, 2, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(20, 'T-20', '1', 1, 10, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(21, 'T-21', '1', 1, 4, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(22, 'T-22', '1', 1, 2, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(23, 'T-23', '1', 1, 10, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(24, 'T-24', '1', 1, 8, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(25, 'T-25', '1', 1, 2, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(26, 'T-26', '1', 1, 6, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(27, 'T-27', '1', 1, 10, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(28, 'T-28', '1', 1, 10, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(29, 'T-29', '1', 1, 8, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(30, 'T-30', '1', 1, 8, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(31, 'T-31', '1', 1, 4, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(32, 'T-32', '1', 1, 2, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(33, 'T-33', '1', 1, 8, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(34, 'T-34', '1', 1, 10, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(35, 'T-35', '1', 1, 6, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(36, 'T-36', '1', 1, 10, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(37, 'T-37', '0', 1, 8, '2024-10-01 09:52:32', '2024-10-01 22:16:14'),
(38, 'T-38', '1', 1, 6, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(39, 'T-39', '0', 1, 10, '2024-10-01 09:52:32', '2024-10-01 22:16:10'),
(40, 'T-40', '1', 1, 2, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(41, 'T-41', '1', 2, 2, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(42, 'T-42', '1', 2, 4, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(43, 'T-43', '1', 2, 6, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(44, 'T-44', '1', 2, 10, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(45, 'T-45', '1', 2, 10, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(46, 'T-46', '1', 2, 4, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(47, 'T-47', '1', 2, 10, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(48, 'T-48', '1', 2, 2, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(49, 'T-49', '1', 2, 8, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(50, 'T-50', '1', 2, 10, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(51, 'T-51', '1', 2, 4, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(52, 'T-52', '1', 2, 6, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(53, 'T-53', '1', 2, 10, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(54, 'T-54', '1', 2, 6, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(55, 'T-55', '1', 2, 10, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(56, 'T-56', '1', 2, 10, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(57, 'T-57', '1', 2, 2, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(58, 'T-58', '1', 2, 8, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(59, 'T-59', '1', 2, 6, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(60, 'T-60', '1', 2, 6, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(61, 'T-61', '1', 2, 8, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(62, 'T-62', '1', 2, 2, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(63, 'T-63', '1', 2, 4, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(64, 'T-64', '1', 2, 6, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(65, 'T-65', '1', 2, 8, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(66, 'T-66', '1', 2, 6, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(67, 'T-67', '1', 2, 8, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(68, 'T-68', '1', 2, 6, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(69, 'T-69', '1', 2, 8, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(70, 'T-70', '1', 2, 2, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(71, 'T-71', '1', 2, 8, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(72, 'T-72', '1', 2, 8, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(73, 'T-73', '1', 2, 6, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(74, 'T-74', '1', 2, 4, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(75, 'T-75', '1', 2, 4, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(76, 'VIP-01', '1', 2, 12, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(77, 'VIP-02', '1', 2, 14, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(78, 'VIP-03', '1', 2, 16, '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(79, 'VIP-04', '1', 2, 20, '2024-10-01 09:52:32', '2024-10-01 09:52:32');

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `role`, `loyalty_points`, `email_verified_at`, `password`, `google_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '08123456789', 'admin', 0, NULL, '$2y$12$6.5zKy3UyjtVR1lwFsYoa.Ws56iRw5fHmMNIMWL5CrJSEPOUO5sbO', NULL, 'gX6yyhQeH9RRloE2ejYSv69QEwvTXG1AFRNL6avUSngRfkHGg8Eo6AOg0TmL', '2024-10-01 09:52:31', '2024-10-01 09:52:31');
INSERT INTO `users` (`id`, `name`, `email`, `phone`, `role`, `loyalty_points`, `email_verified_at`, `password`, `google_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'kasir', 'kasir@gmail.com', '082384733948', 'kasir', 0, NULL, '$2y$12$3vPT7CqCPINxWnLBmGavtekIOJ65YgfuMJUyROXc0s39ThadX3Kgu', NULL, 'xzJ7NwAlReaN8jJ6wPr3XKP9bJdU8cEkzsLnYRcpjDPlCktTyAhnv6L3jqTJ', '2024-10-01 09:52:32', '2024-10-01 09:52:32');
INSERT INTO `users` (`id`, `name`, `email`, `phone`, `role`, `loyalty_points`, `email_verified_at`, `password`, `google_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'koki', 'koki@gmail.com', '085284759384', 'koki', 0, NULL, '$2y$12$CF6kxQjd.OcR9oydUN4QgusyRzZ4.H0cURQHKb78fkGhujDSMmOhu', NULL, 'uFPG6EFzzgRzPKU12rjIqIr3YNyGg15Gg3BG9ze9zYxzbwsqYVHOYtwEx9pp', '2024-10-01 09:52:32', '2024-10-01 09:52:32');
INSERT INTO `users` (`id`, `name`, `email`, `phone`, `role`, `loyalty_points`, `email_verified_at`, `password`, `google_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 'Muhammad Farhan', 'farhan@gmail.com', '083173633639', 'user', 0, NULL, '$2y$12$e0xv88TjzjSzwW2Vsuyrn.hldA2AW8xinHjY/kvMdz6Gnr1.jemLy', NULL, 'vGVv7S6E6J', '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(5, 'Unjani Violet Fujiati S.Kom', 'oktaviani.arsipatra@example.org', '(+62) 410 1807 4152', 'user', 0, NULL, '$2y$12$Lq3SevVSJfZeM74YsZwFF.T3/v0Wd6VWU9Fw5cjrjawXiel5AvITK', NULL, 'rxWeXTgANP', '2024-08-15 09:52:32', '2024-08-17 09:52:32'),
(6, 'Nabila Agustina', 'ardianto.sakura@example.net', '(+62) 20 6713 2555', 'user', 0, NULL, '$2y$12$Lq3SevVSJfZeM74YsZwFF.T3/v0Wd6VWU9Fw5cjrjawXiel5AvITK', NULL, 'TpShipBCRG', '2024-08-19 09:52:32', '2024-08-29 09:52:32'),
(7, 'Siska Farida', 'wnurdiyanti@example.net', '(+62) 543 3773 6639', 'user', 0, NULL, '$2y$12$Lq3SevVSJfZeM74YsZwFF.T3/v0Wd6VWU9Fw5cjrjawXiel5AvITK', NULL, 'mQIuir1Qo3', '2024-08-17 09:52:32', '2024-08-09 09:52:32'),
(8, 'Irnanto Adhiarja Maulana', 'ifa72@example.com', '(+62) 281 2910 229', 'user', 0, NULL, '$2y$12$Lq3SevVSJfZeM74YsZwFF.T3/v0Wd6VWU9Fw5cjrjawXiel5AvITK', NULL, 'Uu80S5enMc', '2024-08-30 09:52:32', '2024-08-15 09:52:32'),
(9, 'Asmianto Among Wibisono', 'sihotang.hendra@example.org', '(+62) 884 697 424', 'user', 0, NULL, '$2y$12$Lq3SevVSJfZeM74YsZwFF.T3/v0Wd6VWU9Fw5cjrjawXiel5AvITK', NULL, 'gWIdBcZCtx', '2024-08-18 09:52:32', '2024-08-06 09:52:32'),
(10, 'Farhunnisa Anggraini', 'agus.wibowo@example.org', '(+62) 632 1258 114', 'user', 0, NULL, '$2y$12$Lq3SevVSJfZeM74YsZwFF.T3/v0Wd6VWU9Fw5cjrjawXiel5AvITK', NULL, 'mL5umGfr4y', '2024-08-07 09:52:32', '2024-08-13 09:52:32'),
(11, 'Ajiono Iswahyudi M.Farm', 'karen.farida@example.org', '0586 3518 1272', 'user', 0, NULL, '$2y$12$Lq3SevVSJfZeM74YsZwFF.T3/v0Wd6VWU9Fw5cjrjawXiel5AvITK', NULL, 'qPEyuJgVgp', '2024-08-09 09:52:32', '2024-08-27 09:52:32'),
(12, 'Ira Genta Kuswandari', 'winda18@example.org', '(+62) 572 6018 232', 'user', 0, NULL, '$2y$12$Lq3SevVSJfZeM74YsZwFF.T3/v0Wd6VWU9Fw5cjrjawXiel5AvITK', NULL, 'M0f5EFUnSD', '2024-08-03 09:52:32', '2024-08-06 09:52:32'),
(13, 'Kayla Sabrina Haryanti', 'yolanda.jamal@example.org', '(+62) 776 6939 423', 'user', 0, NULL, '$2y$12$Lq3SevVSJfZeM74YsZwFF.T3/v0Wd6VWU9Fw5cjrjawXiel5AvITK', NULL, '9ZmwatGan7', '2024-08-31 09:52:32', '2024-08-06 09:52:32'),
(14, 'Okto Pranowo', 'salahudin.hafshah@example.org', '(+62) 840 140 927', 'user', 0, NULL, '$2y$12$Lq3SevVSJfZeM74YsZwFF.T3/v0Wd6VWU9Fw5cjrjawXiel5AvITK', NULL, 'lzOn68Ef7W', '2024-08-19 09:52:32', '2024-08-30 09:52:32'),
(15, 'Yuni Utami', 'hariyah.hesti@example.com', '0512 0844 3210', 'user', 0, NULL, '$2y$12$Lq3SevVSJfZeM74YsZwFF.T3/v0Wd6VWU9Fw5cjrjawXiel5AvITK', NULL, 'GA7pvygYnH', '2024-08-04 09:52:32', '2024-08-30 09:52:32'),
(16, 'Elisa Laksita', 'maryanto.najmudin@example.com', '(+62) 554 3472 8122', 'user', 0, NULL, '$2y$12$Lq3SevVSJfZeM74YsZwFF.T3/v0Wd6VWU9Fw5cjrjawXiel5AvITK', NULL, 'pZbhgHsRSn', '2024-08-25 09:52:32', '2024-08-30 09:52:32'),
(17, 'Ghaliyati Natalia Wijayanti M.Ak', 'laras43@example.com', '(+62) 561 5796 268', 'user', 0, NULL, '$2y$12$Lq3SevVSJfZeM74YsZwFF.T3/v0Wd6VWU9Fw5cjrjawXiel5AvITK', NULL, 'yYZq8ACXBw', '2024-08-23 09:52:32', '2024-08-11 09:52:32'),
(18, 'Unjani Handayani S.Pd', 'yprasasta@example.org', '0229 5446 5748', 'user', 0, NULL, '$2y$12$Lq3SevVSJfZeM74YsZwFF.T3/v0Wd6VWU9Fw5cjrjawXiel5AvITK', NULL, 'V71ldX7Wao', '2024-08-18 09:52:32', '2024-08-24 09:52:32'),
(19, 'Lamar Galuh Damanik', 'permadi.elon@example.net', '(+62) 313 9474 945', 'user', 0, NULL, '$2y$12$Lq3SevVSJfZeM74YsZwFF.T3/v0Wd6VWU9Fw5cjrjawXiel5AvITK', NULL, 'KYwGrslAr3', '2024-08-08 09:52:32', '2024-08-18 09:52:32'),
(20, 'Tami Patricia Usamah M.M.', 'winarsih.latika@example.net', '0760 1326 4556', 'user', 0, NULL, '$2y$12$Lq3SevVSJfZeM74YsZwFF.T3/v0Wd6VWU9Fw5cjrjawXiel5AvITK', NULL, 'VUVvPMUpTq', '2024-08-29 09:52:32', '2024-08-30 09:52:32'),
(21, 'Atmaja Hakim', 'uanggriawan@example.net', '0753 3427 0727', 'user', 0, NULL, '$2y$12$Lq3SevVSJfZeM74YsZwFF.T3/v0Wd6VWU9Fw5cjrjawXiel5AvITK', NULL, 'xLUw8jBrTJ', '2024-08-05 09:52:32', '2024-08-11 09:52:32'),
(22, 'Gasti Ghaliyati Usada M.Pd', 'hardana06@example.net', '(+62) 22 9253 8098', 'user', 0, NULL, '$2y$12$Lq3SevVSJfZeM74YsZwFF.T3/v0Wd6VWU9Fw5cjrjawXiel5AvITK', NULL, 'cA13wTUsLp', '2024-08-26 09:52:32', '2024-08-31 09:52:32'),
(23, 'Lamar Kuncara Wahyudin M.Kom.', 'wacana.harsana@example.com', '(+62) 28 9543 971', 'user', 0, NULL, '$2y$12$Lq3SevVSJfZeM74YsZwFF.T3/v0Wd6VWU9Fw5cjrjawXiel5AvITK', NULL, 'QJOqahYMf9', '2024-08-13 09:52:32', '2024-08-26 09:52:32'),
(24, 'Raina Ulva Yolanda S.Ked', 'victoria13@example.org', '(+62) 25 1463 6342', 'user', 0, NULL, '$2y$12$Lq3SevVSJfZeM74YsZwFF.T3/v0Wd6VWU9Fw5cjrjawXiel5AvITK', NULL, 'Tuyu5yOxcE', '2024-08-07 09:52:32', '2024-08-17 09:52:32'),
(25, 'Nalar Samosir', 'vanya.rahayu@example.org', '0401 0480 7441', 'user', 0, NULL, '$2y$12$Lq3SevVSJfZeM74YsZwFF.T3/v0Wd6VWU9Fw5cjrjawXiel5AvITK', NULL, 'EvPdFFK6MD', '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(26, 'Zelaya Nurdiyanti', 'yuliarti.wirda@example.org', '021 4939 6245', 'user', 0, NULL, '$2y$12$Lq3SevVSJfZeM74YsZwFF.T3/v0Wd6VWU9Fw5cjrjawXiel5AvITK', NULL, 'ahd94itsEy', '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(27, 'Adikara Ibrani Tamba', 'ulya.hastuti@example.org', '(+62) 837 9222 2499', 'user', 0, NULL, '$2y$12$Lq3SevVSJfZeM74YsZwFF.T3/v0Wd6VWU9Fw5cjrjawXiel5AvITK', NULL, 'ToWF69rAcx', '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(28, 'Sakura Hariyah', 'dabukke.setya@example.net', '(+62) 439 1792 098', 'user', 0, NULL, '$2y$12$Lq3SevVSJfZeM74YsZwFF.T3/v0Wd6VWU9Fw5cjrjawXiel5AvITK', NULL, '8RrSLXFd8K', '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(29, 'Reza Adika Januar S.Farm', 'puji64@example.org', '0266 2702 327', 'user', 0, NULL, '$2y$12$Lq3SevVSJfZeM74YsZwFF.T3/v0Wd6VWU9Fw5cjrjawXiel5AvITK', NULL, 'aw5eIRvRpb', '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(30, 'Dariati Dalimin Suwarno', 'prayitna.nugroho@example.net', '(+62) 908 7336 0835', 'user', 0, NULL, '$2y$12$Lq3SevVSJfZeM74YsZwFF.T3/v0Wd6VWU9Fw5cjrjawXiel5AvITK', NULL, 'ZdFZRrHT2t', '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(31, 'Gatra Sitompul', 'gunarto.harsanto@example.net', '(+62) 291 5976 0905', 'user', 0, NULL, '$2y$12$Lq3SevVSJfZeM74YsZwFF.T3/v0Wd6VWU9Fw5cjrjawXiel5AvITK', NULL, 'OIKd1L9d5M', '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(32, 'Kasiyah Astuti', 'setiawan.tantri@example.com', '023 4219 785', 'user', 0, NULL, '$2y$12$Lq3SevVSJfZeM74YsZwFF.T3/v0Wd6VWU9Fw5cjrjawXiel5AvITK', NULL, '0BxAugFrVd', '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(33, 'Najwa Mayasari', 'among25@example.org', '0523 8663 951', 'user', 0, NULL, '$2y$12$Lq3SevVSJfZeM74YsZwFF.T3/v0Wd6VWU9Fw5cjrjawXiel5AvITK', NULL, '7n4t7cZYMh', '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(34, 'Viman Kusumo S.E.', 'unjani91@example.org', '(+62) 940 9437 0610', 'user', 0, NULL, '$2y$12$Lq3SevVSJfZeM74YsZwFF.T3/v0Wd6VWU9Fw5cjrjawXiel5AvITK', NULL, 'TDD5keshLA', '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(35, 'Kairav Manullang', 'wirda.wijaya@example.org', '0656 9761 0230', 'user', 0, NULL, '$2y$12$Lq3SevVSJfZeM74YsZwFF.T3/v0Wd6VWU9Fw5cjrjawXiel5AvITK', NULL, 'O57kHoiNys', '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(36, 'Faizah Laras Oktaviani S.Farm', 'yani.usamah@example.com', '0647 5974 368', 'user', 0, NULL, '$2y$12$Lq3SevVSJfZeM74YsZwFF.T3/v0Wd6VWU9Fw5cjrjawXiel5AvITK', NULL, 'cswmK9PASl', '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(37, 'Unjani Mardhiyah', 'yulianti.gada@example.org', '0867 1295 362', 'user', 0, NULL, '$2y$12$Lq3SevVSJfZeM74YsZwFF.T3/v0Wd6VWU9Fw5cjrjawXiel5AvITK', NULL, 'bymktjPHtg', '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(38, 'Wasis Garan Samosir S.IP', 'waluyo.puti@example.com', '0610 3716 064', 'user', 0, NULL, '$2y$12$Lq3SevVSJfZeM74YsZwFF.T3/v0Wd6VWU9Fw5cjrjawXiel5AvITK', NULL, '4FRtqIzkta', '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(39, 'Endra Narji Latupono', 'waskita.tirtayasa@example.net', '0620 9731 8227', 'user', 0, NULL, '$2y$12$Lq3SevVSJfZeM74YsZwFF.T3/v0Wd6VWU9Fw5cjrjawXiel5AvITK', NULL, 'S5AKMHTexl', '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(40, 'Karen Hassanah', 'zulaika.zelda@example.com', '0847 5950 924', 'user', 0, NULL, '$2y$12$Lq3SevVSJfZeM74YsZwFF.T3/v0Wd6VWU9Fw5cjrjawXiel5AvITK', NULL, 'LYbjHGjrPQ', '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(41, 'Yuni Lala Maryati', 'vkuswoyo@example.com', '0594 5777 528', 'user', 0, NULL, '$2y$12$Lq3SevVSJfZeM74YsZwFF.T3/v0Wd6VWU9Fw5cjrjawXiel5AvITK', NULL, 'AA8UmJV6M5', '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(42, 'Tantri Astuti', 'mpuspasari@example.com', '0585 6028 2995', 'user', 0, NULL, '$2y$12$Lq3SevVSJfZeM74YsZwFF.T3/v0Wd6VWU9Fw5cjrjawXiel5AvITK', NULL, 'cMNQPbbUNm', '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(43, 'Bagas Niyaga Pradipta', 'inuraini@example.net', '(+62) 324 0785 1287', 'user', 0, NULL, '$2y$12$Lq3SevVSJfZeM74YsZwFF.T3/v0Wd6VWU9Fw5cjrjawXiel5AvITK', NULL, 'w5KrjITJEJ', '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(44, 'Asmadi Adinata Sihombing', 'prasetya.pradipta@example.net', '026 7352 4755', 'user', 0, NULL, '$2y$12$Lq3SevVSJfZeM74YsZwFF.T3/v0Wd6VWU9Fw5cjrjawXiel5AvITK', NULL, 'AvMrOMHNK9', '2024-10-01 09:52:32', '2024-10-01 09:52:32'),
(45, 'Muhammad Farhan', 'mhdfarhan5148@gmail.com', '081234567890', 'user', 25000, NULL, '$2y$12$TElD0r3m2xVPdo/7HaVq4eD9TsucaESFeVMXLg/v2D1sV0b8X3xCC', '100056343344801735411', NULL, '2024-10-01 18:51:54', '2024-10-01 20:17:17');


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;