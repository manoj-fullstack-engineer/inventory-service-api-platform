-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2024 at 06:33 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ransofficedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contract_products`
--

CREATE TABLE `contract_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `cpname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `pmodel` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `srno` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cust_id` int(10) UNSIGNED NOT NULL,
  `agrStatus` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agrNo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agrDos` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agrDoe` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ledgers`
--

CREATE TABLE `ledgers` (
  `id` int(10) UNSIGNED NOT NULL,
  `srNo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `staff_id` int(10) UNSIGNED NOT NULL,
  `action_done` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `partsAndConsumables` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `totalSpent` decimal(10,2) NOT NULL,
  `preReading` int(10) UNSIGNED NOT NULL,
  `todayReading` int(10) UNSIGNED NOT NULL,
  `totalReading` int(11) NOT NULL,
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_12_17_035003_create_staffs_table', 1),
(4, '2018_12_18_035002_create_customers_table', 1),
(5, '2018_12_18_035015_create_sales_table', 1),
(6, '2018_12_18_035038_create_suppliers_table', 1),
(7, '2018_12_18_041830_create_categories_table', 1),
(8, '2018_12_18_042809_create_products_table', 1),
(9, '2018_12_18_043146_create_product_masuk_table', 1),
(10, '2018_12_18_043233_create_product_keluar_table', 1),
(11, '2018_12_19_044911_add_field_role_to_table_users', 1),
(12, '2024_05_13_115957_create_contract_products_table', 1),
(13, '2024_06_05_104712_create_ledgers_table', 1),
(14, '2024_06_19_111436_create_product__returns_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_keluar`
--

CREATE TABLE `product_keluar` (
  `id` int(10) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `productIssueTime` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `partsAndConsumables` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `totalAmount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `staff_id` int(10) UNSIGNED NOT NULL,
  `desc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_masuk`
--

CREATE TABLE `product_masuk` (
  `id` int(10) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `supplier_id` int(10) UNSIGNED NOT NULL,
  `partsAndConsumables` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `totalAmount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `desc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_returns`
--

CREATE TABLE `product_returns` (
  `id` int(10) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `productIssueTime` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `staff_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `desc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE `staffs` (
  `id` int(10) UNSIGNED NOT NULL,
  `staffName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `doj` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dol` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('admin','staff') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'staff'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Admin', 'myransoffice@gmail.com', '$2y$10$5mXnVZ33DVRmcnr3BDHh4u7wzipxCd1Q6zf68DwHxydHo4HPgOCna', NULL, '2024-09-02 22:51:14', NULL, 'admin'),
(2, 'Staff', 'staff@gmail.com', '$2y$10$ca1hPE9jB1.aj8fprTQ5NOPaJx8Xwkz9g49EaitKx/vL0m3nKAGX2', NULL, '2024-09-02 22:51:14', NULL, 'staff');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

--
-- Indexes for table `contract_products`
--
ALTER TABLE `contract_products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `contract_products_srno_unique` (`srno`),
  ADD KEY `contract_products_category_id_foreign` (`category_id`),
  ADD KEY `contract_products_cust_id_foreign` (`cust_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_nama_unique` (`nama`);

--
-- Indexes for table `ledgers`
--
ALTER TABLE `ledgers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ledgers_staff_id_foreign` (`staff_id`),
  ADD KEY `ledgers_srno_foreign` (`srNo`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_nama_unique` (`nama`),
  ADD KEY `products_nama_index` (`nama`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_keluar`
--
ALTER TABLE `product_keluar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_keluar_customer_id_foreign` (`customer_id`),
  ADD KEY `product_keluar_staff_id_foreign` (`staff_id`);

--
-- Indexes for table `product_masuk`
--
ALTER TABLE `product_masuk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_masuk_supplier_id_foreign` (`supplier_id`);

--
-- Indexes for table `product_returns`
--
ALTER TABLE `product_returns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_returns_product_id_foreign` (`product_id`),
  ADD KEY `product_returns_staff_id_foreign` (`staff_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staffs`
--
ALTER TABLE `staffs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `suppliers_nama_unique` (`nama`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contract_products`
--
ALTER TABLE `contract_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ledgers`
--
ALTER TABLE `ledgers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_keluar`
--
ALTER TABLE `product_keluar`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_masuk`
--
ALTER TABLE `product_masuk`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_returns`
--
ALTER TABLE `product_returns`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staffs`
--
ALTER TABLE `staffs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contract_products`
--
ALTER TABLE `contract_products`
  ADD CONSTRAINT `contract_products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `contract_products_cust_id_foreign` FOREIGN KEY (`cust_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ledgers`
--
ALTER TABLE `ledgers`
  ADD CONSTRAINT `ledgers_srno_foreign` FOREIGN KEY (`srNo`) REFERENCES `contract_products` (`srno`) ON DELETE CASCADE,
  ADD CONSTRAINT `ledgers_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `staffs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_keluar`
--
ALTER TABLE `product_keluar`
  ADD CONSTRAINT `product_keluar_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_keluar_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `staffs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_masuk`
--
ALTER TABLE `product_masuk`
  ADD CONSTRAINT `product_masuk_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_returns`
--
ALTER TABLE `product_returns`
  ADD CONSTRAINT `product_returns_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_returns_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `staffs` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
