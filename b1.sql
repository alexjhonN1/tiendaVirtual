/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE DATABASE IF NOT EXISTS `b1` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `b1`;

CREATE TABLE IF NOT EXISTS `admins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `is_superuser` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`),
  UNIQUE KEY `admins_username_unique` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `admins` (`id`, `name`, `email`, `username`, `email_verified_at`, `password`, `is_superuser`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Super Admin', 'superadmin@admin.com', 'superadmin', NULL, '$2y$12$U.8Ee9AcyMIZQekfCNZSb.N6lwNBNUNjvFyJQLvTRXI3/NEmvdSXm', 1, NULL, '2024-11-22 22:57:15', '2024-11-22 22:57:15'),
	(2, 'alex', 'alex@gmail.com', 'alex', NULL, '$2y$12$dEe1qVbVxeM8ncmZGVgp.edE.s4fzRTvehnD3oq7GC7sgbpeD.aGO', 0, NULL, '2024-11-22 23:53:43', '2024-11-22 23:53:43');

CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE IF NOT EXISTS `carritos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `producto_id` bigint(20) unsigned NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `carritos_user_id_foreign` (`user_id`),
  KEY `carritos_producto_id_foreign` (`producto_id`),
  CONSTRAINT `carritos_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `carritos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE IF NOT EXISTS `categorias` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `categorias` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
	(1, 'Procesadores', '2024-11-23 03:59:56', '2024-11-23 03:59:56'),
	(2, 'Tarjetas Gráficas', '2024-11-23 03:59:56', '2024-11-23 03:59:56'),
	(3, 'Memorias RAM', '2024-11-23 03:59:56', '2024-11-23 03:59:56'),
	(4, 'Almacenamiento', '2024-11-23 03:59:56', '2024-11-23 03:59:56'),
	(5, 'Periféricos', '2024-11-23 03:59:56', '2024-11-23 03:59:56'),
	(6, 'Monitores', '2024-11-23 03:59:56', '2024-11-23 03:59:56'),
	(7, 'Software', '2024-11-23 03:59:56', '2024-11-23 03:59:56'),
	(8, 'Redes', '2024-11-23 03:59:56', '2024-11-23 03:59:56'),
	(9, 'Impresoras', '2024-11-23 03:59:56', '2024-11-23 03:59:56'),
	(10, 'Fuentes de Poder', '2024-11-23 03:59:56', '2024-11-23 03:59:56');

CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000001_create_cache_table', 1),
	(2, '2022_08_19_000000_create_failed_jobs_table', 1),
	(3, '2023_07_24_184706_create_permission_tables', 1),
	(4, '2023_09_12_043205_create_admins_table', 1),
	(5, '2024_07_12_100000_create_password_resets_table', 1),
	(6, '2024_09_05_000000_create_users_table', 1),
	(7, '2024_09_06_041451_add_unique_index_to_password_resets', 1),
	(8, '2024_10_14_193148_create_sessions_table', 1),
	(9, '2024_11_22_183113_crear_tabla_categorias', 2),
	(10, '2024_11_22_183829_crear_tabla_productos', 2),
	(11, '2024_11_22_211103_add_popularity_to_productos_table', 3),
	(12, '2024_11_22_211535_create_carritos_table', 4),
	(13, '2024_11_22_212055_create_resenas_table', 5);

CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(1, 'App\\Models\\Admin', 1),
	(2, 'App\\Models\\Admin', 2);

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  UNIQUE KEY `password_resets_token_unique` (`token`),
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `created_at`, `updated_at`) VALUES
	(1, 'dashboard.view', 'admin', 'dashboard', '2024-11-22 22:57:15', '2024-11-22 22:57:15'),
	(2, 'dashboard.edit', 'admin', 'dashboard', '2024-11-22 22:57:15', '2024-11-22 22:57:15'),
	(3, 'blog.create', 'admin', 'blog', '2024-11-22 22:57:15', '2024-11-22 22:57:15'),
	(4, 'blog.view', 'admin', 'blog', '2024-11-22 22:57:15', '2024-11-22 22:57:15'),
	(5, 'blog.edit', 'admin', 'blog', '2024-11-22 22:57:15', '2024-11-22 22:57:15'),
	(6, 'blog.delete', 'admin', 'blog', '2024-11-22 22:57:15', '2024-11-22 22:57:15'),
	(7, 'blog.approve', 'admin', 'blog', '2024-11-22 22:57:15', '2024-11-22 22:57:15'),
	(8, 'admin.create', 'admin', 'admin', '2024-11-22 22:57:15', '2024-11-22 22:57:15'),
	(9, 'admin.view', 'admin', 'admin', '2024-11-22 22:57:15', '2024-11-22 22:57:15'),
	(10, 'admin.edit', 'admin', 'admin', '2024-11-22 22:57:15', '2024-11-22 22:57:15'),
	(11, 'admin.delete', 'admin', 'admin', '2024-11-22 22:57:15', '2024-11-22 22:57:15'),
	(12, 'admin.approve', 'admin', 'admin', '2024-11-22 22:57:15', '2024-11-22 22:57:15'),
	(13, 'role.create', 'admin', 'role', '2024-11-22 22:57:15', '2024-11-22 22:57:15'),
	(14, 'role.view', 'admin', 'role', '2024-11-22 22:57:15', '2024-11-22 22:57:15'),
	(15, 'role.edit', 'admin', 'role', '2024-11-22 22:57:15', '2024-11-22 22:57:15'),
	(16, 'role.delete', 'admin', 'role', '2024-11-22 22:57:15', '2024-11-22 22:57:15'),
	(17, 'role.approve', 'admin', 'role', '2024-11-22 22:57:15', '2024-11-22 22:57:15'),
	(18, 'profile.view', 'admin', 'profile', '2024-11-22 22:57:15', '2024-11-22 22:57:15'),
	(19, 'profile.edit', 'admin', 'profile', '2024-11-22 22:57:15', '2024-11-22 22:57:15'),
	(20, 'profile.delete', 'admin', 'profile', '2024-11-22 22:57:15', '2024-11-22 22:57:15'),
	(21, 'profile.update', 'admin', 'profile', '2024-11-22 22:57:15', '2024-11-22 22:57:15');

CREATE TABLE IF NOT EXISTS `productos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `popularidad` int(11) NOT NULL DEFAULT 0,
  `imagen` varchar(255) DEFAULT NULL,
  `categoria_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `productos_categoria_id_foreign` (`categoria_id`),
  CONSTRAINT `productos_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `stock`, `popularidad`, `imagen`, `categoria_id`, `created_at`, `updated_at`) VALUES
	(1, 'Intel Core i7-12700Ka', 'Procesador Intel de 12ª generación', 410.99, 35, 85, NULL, 1, '2024-11-23 04:00:25', '2024-11-29 22:21:27'),
	(2, 'AMD Ryzen 5 5600X', 'Procesador AMD de alto rendimiento', 299.99, 25, 90, NULL, 1, '2024-11-23 04:00:25', '2024-11-23 04:00:25'),
	(3, 'NVIDIA GeForce RTX 3080', 'Tarjeta gráfica de última generación', 799.99, 15, 100, NULL, 2, '2024-11-23 04:00:25', '2024-11-23 04:00:25'),
	(4, 'AMD Radeon RX 6700 XT', 'Tarjeta gráfica para gaming', 479.99, 20, 75, NULL, 2, '2024-11-23 04:00:25', '2024-11-23 04:00:25'),
	(5, 'Corsair Vengeance LPX 16GB', 'Memoria RAM DDR4 de alta velocidad', 89.99, 50, 60, NULL, 3, '2024-11-23 04:00:25', '2024-11-23 04:00:25'),
	(6, 'Kingston Fury Beast 32GB', 'Memoria RAM DDR5 de alta velocidad', 199.99, 40, 70, NULL, 3, '2024-11-23 04:00:25', '2024-11-23 04:00:25'),
	(7, 'Samsung 970 EVO Plus 1TB', 'SSD NVMe de alta velocidad', 119.99, 60, 65, NULL, 4, '2024-11-23 04:00:25', '2024-11-23 04:00:25'),
	(8, 'WD Blue 4TB', 'Disco duro SATA para almacenamiento masivo', 99.99, 50, 40, NULL, 4, '2024-11-23 04:00:25', '2024-11-23 04:00:25'),
	(9, 'Logitech G502 HERO', 'Ratón gaming con sensor de alta precisión', 59.99, 100, 95, NULL, 5, '2024-11-23 04:00:25', '2024-11-23 04:00:25'),
	(10, 'Razer BlackWidow V3', 'Teclado mecánico gaming con iluminación RGB', 129.99, 30, 88, NULL, 5, '2024-11-23 04:00:25', '2024-11-23 04:00:25'),
	(11, 'Dell UltraSharp U2723QE', 'Monitor 4K UHD de alta resolución', 499.99, 20, 70, NULL, 6, '2024-11-23 04:00:25', '2024-11-23 04:00:25'),
	(12, 'LG UltraGear 27GP950', 'Monitor gaming 4K con 144Hz', 699.99, 15, 80, NULL, 6, '2024-11-23 04:00:25', '2024-11-23 04:00:25'),
	(13, 'Microsoft Windows 11 Pro', 'Sistema operativo para empresas', 199.99, 500, 75, NULL, 7, '2024-11-23 04:00:25', '2024-11-23 04:00:25'),
	(14, 'Microsoft Office 365', 'Suite de productividad con Word, Excel y PowerPoint', 99.99, 200, 85, NULL, 7, '2024-11-23 04:00:25', '2024-11-23 04:00:25'),
	(15, 'TP-Link Archer AX50', 'Router Wi-Fi 6 de alta velocidad', 129.99, 50, 55, NULL, 8, '2024-11-23 04:00:25', '2024-11-23 04:00:25'),
	(16, 'Netgear Nighthawk RAX70', 'Router Wi-Fi 6 de tres bandas', 299.99, 30, 65, NULL, 8, '2024-11-23 04:00:25', '2024-11-23 04:00:25'),
	(17, 'HP LaserJet Pro M404dn', 'Impresora láser monocromática', 199.99, 25, 45, NULL, 9, '2024-11-23 04:00:25', '2024-11-23 04:00:25'),
	(18, 'Canon PIXMA G6020', 'Impresora de inyección con tanque de tinta', 229.99, 20, 40, NULL, 9, '2024-11-23 04:00:25', '2024-11-23 04:00:25'),
	(19, 'Corsair RM750x', 'Fuente de poder 750W modular', 119.99, 40, 55, NULL, 10, '2024-11-23 04:00:25', '2024-11-23 04:00:25'),
	(20, 'EVGA SuperNOVA 850 GA', 'Fuente de poder 850W 80+ Gold', 149.99, 35, 70, NULL, 10, '2024-11-23 04:00:25', '2024-11-23 04:00:25');

CREATE TABLE IF NOT EXISTS `resenas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `producto_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `comentario` text NOT NULL,
  `calificacion` int(11) NOT NULL,
  `aprobado` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `resenas_producto_id_foreign` (`producto_id`),
  KEY `resenas_user_id_foreign` (`user_id`),
  CONSTRAINT `resenas_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `resenas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `resenas` (`id`, `producto_id`, `user_id`, `comentario`, `calificacion`, `aprobado`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 'hola', 4, 0, '2024-11-30 03:18:37', '2024-11-30 03:18:37'),
	(2, 1, 1, 'hola', 4, 0, '2024-11-30 03:19:28', '2024-11-30 03:19:28'),
	(3, 2, 1, 'que buen producto', 5, 0, '2024-11-30 03:59:35', '2024-11-30 03:59:35');

CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'superadmin', 'admin', '2024-11-22 22:57:15', '2024-11-22 22:57:15'),
	(2, 'alex', 'admin', '2024-11-22 23:53:07', '2024-11-22 23:53:07');

CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
	(1, 1),
	(2, 1),
	(3, 1),
	(4, 1),
	(5, 1),
	(6, 1),
	(7, 1),
	(8, 1),
	(9, 1),
	(10, 1),
	(11, 1),
	(12, 1),
	(13, 1),
	(14, 1),
	(15, 1),
	(16, 1),
	(17, 1),
	(18, 1),
	(19, 1),
	(20, 1),
	(21, 1),
	(1, 2),
	(2, 2),
	(3, 2),
	(4, 2),
	(5, 2),
	(6, 2),
	(7, 2),
	(8, 2),
	(9, 2),
	(10, 2),
	(11, 2),
	(12, 2),
	(13, 2),
	(14, 2),
	(15, 2),
	(16, 2),
	(17, 2),
	(18, 2),
	(19, 2),
	(20, 2),
	(21, 2);

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  UNIQUE KEY `sessions_id_unique` (`id`),
  KEY `sessions_user_id_foreign` (`user_id`),
  CONSTRAINT `sessions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `sessions` (`id`, `user_id`, `payload`, `last_activity`, `ip_address`, `user_agent`) VALUES
	('osm44u0YDhMdqzsAYYtTQW45adxHb5AnusNj6Lwi', 1, 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiOTAwUll6OXJ3cFh6RlhydjMxenpxbkZ5SWtoMUo0NE9zSjNuVmJ2ViI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL3Byb2R1Y3RvcyI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW4vcHJvZHVjdG9zIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MjoibG9naW5fYWRtaW5fNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1732925554, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36'),
	('Zs9hp46hSh43z1r5fbhcCHEiLtLZJPaCZCPDtrGp', 1, 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZnFJakRyYW16ajJTWmNDeUlWMm1NRHBzMThvR1BSQXU0bGFyc1JoSCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9jYXJyaXRvIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MjoibG9naW5fYWRtaW5fNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1733181946, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36');

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', 'admin@admin.com', NULL, '$2y$12$IcRVA0fS8N0ZenoJmIOt1ePLmjlzDXnnjA.L16Popi/.JUT7vzGzO', NULL, '2024-11-22 22:57:15', '2024-11-22 22:57:15');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
