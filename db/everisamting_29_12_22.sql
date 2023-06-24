-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2022 at 07:31 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `everisamting`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'backend/image/default-user.png',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `image`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'arobil@gmail.com', '2022-08-19 23:31:12', '$2y$10$rwN4cgHaDixDZ..bUOoxXOabOfF/c2qVuXd.cM3TI8T7v4DipD5qS', 'media/brand/brand-639465dd72c17.jpg', 'j3LoawGLXpE88K4EjSe8LWczafKt8NhkzNW5l8t3WI87I3GoGBQtkuqAGLXx', '2022-08-19 23:31:12', '2022-12-13 08:09:55'),
(2, 'Elliot', 'shmvanuatu@gmail.com', NULL, '$2y$10$ZS25DinKbTnmN7kAs5va9.uBBN3L9fkCBkEfp4uFg8QmTfqpf6L9a', 'backend/image/default-user.png', NULL, '2022-12-21 11:34:09', '2022-12-21 11:34:09');

-- --------------------------------------------------------

--
-- Table structure for table `admin_searches`
--

CREATE TABLE `admin_searches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_title` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `subcategory_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_name` varchar(30) DEFAULT NULL,
  `price` double(8,2) NOT NULL,
  `description` longtext NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `show_phone` tinyint(1) NOT NULL DEFAULT 1,
  `phone_2` varchar(255) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `status` enum('active','sold','pending','declined') NOT NULL DEFAULT 'active',
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_featured` varchar(20) DEFAULT 'no' COMMENT 'no=was_not_featured, yes=was_featured',
  `total_reports` int(11) NOT NULL DEFAULT 0,
  `total_views` int(11) NOT NULL DEFAULT 0,
  `is_blocked` tinyint(1) NOT NULL DEFAULT 0,
  `drafted_at` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `neighborhood` varchar(255) DEFAULT NULL,
  `locality` varchar(255) DEFAULT NULL,
  `place` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `postcode` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `long` double DEFAULT NULL,
  `lat` double DEFAULT NULL,
  `whatsapp` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `title`, `slug`, `user_id`, `category_id`, `subcategory_id`, `brand_id`, `brand_name`, `price`, `description`, `phone`, `show_phone`, `phone_2`, `thumbnail`, `status`, `featured`, `is_featured`, `total_reports`, `total_views`, `is_blocked`, `drafted_at`, `created_at`, `updated_at`, `address`, `neighborhood`, `locality`, `place`, `district`, `postcode`, `region`, `country`, `long`, `lat`, `whatsapp`) VALUES
(1, 'Acer Laptop New Best', 'acer-laptop-new-best', 1, 1, 53, 1, NULL, 55.00, '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>', NULL, 1, NULL, 'uploads/addss_image/1670941492_63988b34c50a1.jpg', 'active', 1, 'yes', 0, 11, 0, NULL, '2022-11-29 02:00:39', '2022-12-13 14:24:52', 'khulna-bangladesh', '', '', '', '', '', 'Khulna', 'Bangladesh', 89.77566500133268, 22.434309286481856, NULL),
(2, 'Best Electronic Phone', 'best-electronic-phone', 1, 1, 53, 1, NULL, 55.00, '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>', NULL, 1, NULL, 'uploads/addss_image/1670939604_639883d46a852.jpg', 'active', 0, 'yes', 0, 3, 0, NULL, '2022-11-29 02:00:39', '2022-12-13 13:53:24', 'sanma-vanuatu', '', '', '', '', '', 'Sanma', 'Vanuatu', 167.02789298857726, -15.31597598630586, NULL),
(3, 'Why do we use it best new', 'why-do-we-use-it-best-new', 1, 1, 53, 1, NULL, 55.00, '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>', NULL, 1, NULL, 'uploads/addss_image/1670939571_639883b3f3e52.jpg', 'active', 1, 'yes', 0, 1, 0, NULL, '2022-11-29 02:00:39', '2022-12-13 13:52:52', 'vanuatu', '', '', '', '', '', NULL, 'Vanuatu', 166.58843986357726, -15.48544523147364, NULL),
(4, 'Where can I get some?', 'where-can-i-get-some', 1, 1, 53, 1, NULL, 55.00, '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>', NULL, 1, NULL, 'uploads/addss_image/1670939533_6398838d8de6e.jpg', 'active', 1, 'yes', 0, 7, 0, NULL, '2022-11-29 02:00:39', '2022-12-20 14:47:28', 'khulna-bangladesh', '', '', '', '', '', 'Khulna', 'Bangladesh', 89.52137791361602, 23.264215876071336, NULL),
(5, 'Buy and sell Laptop', 'buy-and-sell-laptop', 1, 1, 53, 1, NULL, 55.00, '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>', NULL, 1, NULL, 'uploads/addss_image/1670939491_639883633cf0b.jpg', 'active', 1, 'yes', 0, 0, 0, NULL, '2022-11-29 02:00:39', '2022-12-13 13:51:31', 'dhaka-bangladesh', '', '', '', '', '', 'Dhaka', 'Bangladesh', 90.9480004804212, 24.571989929030558, NULL),
(6, 'Contrary to popular belief', 'contrary-to-popular-belief', 1, 1, 53, 1, NULL, 55.00, '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>', NULL, 1, NULL, 'uploads/addss_image/1670939472_639883504ddd9.jpg', 'active', 1, 'yes', 0, 64, 0, NULL, '2022-11-29 02:00:39', '2022-12-24 03:19:12', 'rajshahi-bangladesh', '', '', '', '', '', 'Rajshahi', 'Bangladesh', 89.3763532580016, 24.43370018602318, NULL),
(7, 'se on the theory of ethics, very during the Renaissance', 'se-on-the-theory-of-ethics-very-during-the-renaissance', 1, 1, 53, 1, NULL, 55.00, '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>', NULL, 1, NULL, 'uploads/addss_image/1670939452_6398833c2ddf9.jpg', 'active', 1, 'yes', 0, 10, 0, NULL, '2022-11-29 02:00:39', '2022-12-13 13:50:52', 'chittagong-bangladesh', '', '', '', '', '', 'Chittagong', 'Bangladesh', 91.19404637064727, 23.08494378745381, NULL),
(8, 'Where does it come from?', 'where-does-it-come-from', 1, 1, 53, 1, NULL, 55.00, '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>', NULL, 1, NULL, 'uploads/addss_image/1670939400_63988308d535e.jpg', 'active', 1, 'yes', 0, 0, 0, NULL, '2022-11-29 02:00:39', '2022-12-13 13:50:01', 'sagaing-myanmar-burma', '', '', '', '', '', 'Sagaing', 'Myanmar (Burma)', 95.07496678080352, 22.910492225784914, NULL),
(9, 'Contrary to popular belief, Lorem Ipsum is not sim', 'contrary-to-popular-belief-lorem-ipsum-is-not-sim', 1, 1, 53, 1, NULL, 55.00, '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>', NULL, 1, NULL, 'uploads/addss_image/1670939378_639882f25ee40.jpg', 'active', 0, 'no', 0, 2, 0, NULL, '2022-11-29 02:00:39', '2022-12-14 09:33:52', 'barisal-bangladesh', '', '', '', '', '', 'Barisal', 'Bangladesh', 90.05242771954184, 22.451171982800698, NULL),
(10, 'Contrary to popular belief, Lorem Ipsum is not simply ny', 'contrary-to-popular-belief-lorem-ipsum-is-not-simply-ny', 1, 1, 53, 1, NULL, 55.00, '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>', NULL, 1, NULL, 'uploads/addss_image/1670939312_639882b06a976.jpg', 'active', 0, 'no', 0, 2, 0, NULL, '2022-11-29 02:00:39', '2022-12-14 09:33:39', 'sagaing-myanmar-burma', '', '', '', '', '', 'Sagaing', 'Myanmar (Burma)', 95.07496678080352, 22.910492225784914, NULL),
(11, 'Contrary to popular belief, Lorem Ipsum is', 'contrary-to-popular-belief-lorem-ipsum-is', 1, 1, 53, 1, NULL, 55.00, '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>', NULL, 1, NULL, 'uploads/addss_image/1670939262_6398827e36c82.jpg', 'active', 0, 'no', 0, 5, 0, NULL, '2022-11-29 02:00:39', '2022-12-14 14:12:18', 'khulna-bangladesh', '', '', '', '', '', 'Khulna', 'Bangladesh', 89.34559666361602, 22.52540205459669, NULL),
(12, 'Acer Laptop best laptop', 'acer-laptop-best-laptop', 1, 1, 53, 1, NULL, 55.00, '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>', NULL, 1, NULL, 'uploads/addss_image/1670939145_6398820998baf.jpg', 'active', 0, 'no', 0, 8, 0, NULL, '2022-11-29 02:00:39', '2022-12-14 07:20:00', 'sanma-province-vanuatu', '', '', '', '', '', 'Sanma Province', 'Vanuatu', 166.87408439482726, -15.31597598630586, NULL),
(13, 'Laravel Developer', 'laravel-developer', 3, 5, NULL, 3, NULL, 150.00, '<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.&nbsp;<a data-ved=\"2ahUKEwj23eqT1un7AhVQ3TgGHSgUCRgQmhN6BAgoEAI\" ping=\"/url?sa=t&amp;source=web&amp;rct=j&amp;url=https://en.wikipedia.org/wiki/Lorem_ipsum&amp;ved=2ahUKEwj23eqT1un7AhVQ3TgGHSgUCRgQmhN6BAgoEAI\" target=\"_blank\" rel=\"noopener\" href=\"https://en.wikipedia.org/wiki/Lorem_ipsum\">Wikipedia</a></p><p>&nbsp;</p>', '01551066777', 0, '01551066777', 'uploads/addss_image/1671005865_639986a9aeecc.jpg', 'active', 1, 'yes', 0, 6, 0, NULL, '2022-12-08 03:09:09', '2022-12-21 04:08:40', 'rajshahi-bangladesh', '', '', '', '', '', 'Rajshahi', 'Bangladesh', 89.04896580424102, 24.229590568850742, NULL),
(14, 'Arobil Need account manegars', 'arobil-need-account-manegar', 3, 5, NULL, 3, NULL, 300.00, '<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.&nbsp;<a data-ved=\"2ahUKEwj23eqT1un7AhVQ3TgGHSgUCRgQmhN6BAgoEAI\" ping=\"/url?sa=t&amp;source=web&amp;rct=j&amp;url=https://en.wikipedia.org/wiki/Lorem_ipsum&amp;ved=2ahUKEwj23eqT1un7AhVQ3TgGHSgUCRgQmhN6BAgoEAI\" target=\"_blank\" rel=\"noopener\" href=\"https://en.wikipedia.org/wiki/Lorem_ipsum\">Wikipedia</a></p>', '01551066777', 0, '01551066777', 'uploads/addss_image/1671005917_639986dd03f5d.jpg', 'active', 0, 'no', 0, 7, 0, NULL, '2022-12-08 03:31:30', '2022-12-21 12:12:03', 'sylhet-bangladesh', '', '', '', '', '', 'Sylhet', 'Bangladesh', 92.04960521340239, 24.66037094869774, NULL),
(15, 'Electronics Products for Sale in Bangladesh', 'electronics-products-for-sale-in-bangladesh', 3, 6, NULL, 1, NULL, 14527.00, '<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.&nbsp;<a data-ved=\"2ahUKEwj23eqT1un7AhVQ3TgGHSgUCRgQmhN6BAgoEAI\" ping=\"/url?sa=t&amp;source=web&amp;rct=j&amp;url=https://en.wikipedia.org/wiki/Lorem_ipsum&amp;ved=2ahUKEwj23eqT1un7AhVQ3TgGHSgUCRgQmhN6BAgoEAI\" target=\"_blank\" rel=\"noopener\" href=\"https://en.wikipedia.org/wiki/Lorem_ipsum\">Wikipedia</a></p>', NULL, 0, '01551066777', 'uploads/addss_image/1671002629_63997a0589803.jpg', 'active', 1, 'yes', 0, 7, 0, NULL, '2022-12-08 03:34:33', '2022-12-23 23:39:45', 'rangpur-bangladesh', '', '', '', '', '', 'Rangpur', 'Bangladesh', 88.45663076863707, 26.078848069915516, NULL),
(16, 'New Phone', 'new-phone', 4, 1, 53, 2, NULL, 450.00, '<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.&nbsp;<a data-ved=\"2ahUKEwj23eqT1un7AhVQ3TgGHSgUCRgQmhN6BAgoEAI\" ping=\"/url?sa=t&amp;source=web&amp;rct=j&amp;url=https://en.wikipedia.org/wiki/Lorem_ipsum&amp;ved=2ahUKEwj23eqT1un7AhVQ3TgGHSgUCRgQmhN6BAgoEAI\" target=\"_blank\" rel=\"noopener\" href=\"https://en.wikipedia.org/wiki/Lorem_ipsum\">Wikipedia</a></p>', '01551066777', 1, '01551066777', 'uploads/addss_image/1671009169_6399939106ac4.jpg', 'active', 1, 'yes', 0, 4, 0, NULL, '2022-12-08 03:39:43', '2022-12-14 09:12:49', 'khulna-bangladesh', '', '', '', '', '', 'Khulna', 'Bangladesh', 89.73396643780555, 22.240961798654393, NULL),
(17, 'Old Phone For users', 'old-phone-for-users', 4, 1, 53, 1, NULL, 150.00, '<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.&nbsp;<a data-ved=\"2ahUKEwj23eqT1un7AhVQ3TgGHSgUCRgQmhN6BAgoEAI\" ping=\"/url?sa=t&amp;source=web&amp;rct=j&amp;url=https://en.wikipedia.org/wiki/Lorem_ipsum&amp;ved=2ahUKEwj23eqT1un7AhVQ3TgGHSgUCRgQmhN6BAgoEAI\" target=\"_blank\" rel=\"noopener\" href=\"https://en.wikipedia.org/wiki/Lorem_ipsum\">Wikipedia</a></p>', '01551066777', 0, '01551066777', 'uploads/addss_image/1671009102_6399934e48909.jpg', 'active', 0, 'no', 0, 1, 0, NULL, '2022-12-08 03:40:37', '2022-12-14 09:11:42', 'khulna-bangladesh', '', '', '', '', '', 'Khulna', 'Bangladesh', 88.86769139017852, 23.647198140953105, NULL),
(18, 'Best Home made things', 'best-home-made-things', 4, 8, NULL, 3, NULL, 234.00, '<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.&nbsp;<a data-ved=\"2ahUKEwj23eqT1un7AhVQ3TgGHSgUCRgQmhN6BAgoEAI\" ping=\"/url?sa=t&amp;source=web&amp;rct=j&amp;url=https://en.wikipedia.org/wiki/Lorem_ipsum&amp;ved=2ahUKEwj23eqT1un7AhVQ3TgGHSgUCRgQmhN6BAgoEAI\" target=\"_blank\" rel=\"noopener\" href=\"https://en.wikipedia.org/wiki/Lorem_ipsum\">Wikipedia</a></p>', '01551066777', 0, '01551066777', 'uploads/addss_image/1671009064_6399932893bcf.jpg', 'active', 1, 'yes', 0, 6, 0, NULL, '2022-12-08 03:43:42', '2022-12-14 09:13:03', 'khulna-bangladesh', '', '', '', '', '', 'Khulna', 'Bangladesh', 88.82374846602852, 23.752910972815883, NULL),
(19, 'OPPO F1s Ram 4 gb/Rom 32 gb', 'oppo-f1s-ram-4-gbrom-32-gb', 7, 1, 7, 2, NULL, 120.00, '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p>&nbsp;</p><p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '8801990572321', 0, '01990572321', 'uploads/addss_image/1670923844_63984644e619c.png', 'active', 1, 'yes', 0, 9, 0, NULL, '2022-12-10 01:11:54', '2022-12-22 06:30:13', 'sanma-vanuatu', '', '', '', '', '', 'Sanma', 'Vanuatu', 166.8534850295929, -15.237814913919413, NULL),
(20, 'Full Gaming Corei5 6th Gen,8gb ddr4 ram,22\" led,4gb grafix,128gb SSD', 'full-gaming-corei5-6th-gen8gb-ddr4-ram22-led4gb-grafix128gb-ssd', 1, 25, 118, 3, NULL, 250.00, '<p>Vai ami 100% Orginal Photo Upload Koresi Amr nijer Table Er uporer photo 100% Gaming Computer khub heavy kore build kora hoise.</p><p>*gaming Casing Onk Sundor valo maner 4 Set RGB Light Soho.</p><p>*Gaming Powersupply khub Valo 550 Watt 2500 taka dami.</p><p>*Gaming Motherboard onk valo maner HDMi &amp; USB3 Soho.</p><p>*Corei5 6th Generation proscessor Orginal&nbsp; intel.</p><p>*8gb DDR4 3200 BAS Gaming Ram Taiwan Lifetime Warranty Genuine transcend.</p><p>*128 GB Supper Speed SSD Made in taiwan.</p><p>*22&quot; Full hd led monitor alada,kononegative Side view nai.</p><p>*4gb grafix</p><p>*3k Dami onk onk heavy Gaming Keybord RGB Mecanical.</p><p>*1k dami heavy gaming Mouse.</p><p>*Micro lab double Spker onk beshi sound soho.</p><p>&nbsp;</p><p>Computer ti multiplan elephant Road market theke&nbsp; order kore 35 hajar takay baniesi matro 1 mas hoy olpo kisu din use koresi 3 years warranty paper amr kase ase ami office carry korar jonno laptob kinbo tai Urgent ato kome sell korbo, 100% ok ase kono problem nai apne warranty ta sure paben sob kisur paket foam soho ase windows 10 deoa ase apni sob kaj korte parben office,grafix, video edit,freelancing, gaming sob dam 100% fixed,amr 35k khoroch hoise..dama dami akdom korben na plz..</p>', '01990572321', 0, '01990572321', 'uploads/addss_image/1670925430_63984c76eb246.jpg', 'pending', 0, 'no', 0, 2, 0, NULL, '2022-12-13 09:55:37', '2022-12-13 13:47:04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 166.96197501982726, -15.347761976376436, NULL),
(21, 'Apple iPhone 8 2GB+64GB (Used)', 'apple-iphone-8-2gb64gb-used', 1, 17, 30, 2, NULL, 2500.00, '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p>&nbsp;</p><p>&nbsp;</p><p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '01990572321', 0, '01990572321', 'uploads/addss_image/1670937543_63987bc72b608.jpg', 'pending', 1, 'yes', 0, 4, 0, NULL, '2022-12-13 13:18:58', '2022-12-13 13:46:57', 'sanma-vanuatu', '', '', '', '', '', 'Sanma', 'Vanuatu', 166.91116325224914, -15.297431927610816, NULL),
(22, 'Electronics Products for Sale in Bangladesh', 'electronics-products-for-sale-in-bangladesh-22', 3, 27, NULL, 3, NULL, 120.00, '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '01990572321', 0, '01990572321', 'uploads/addss_image/1671007719_63998de7b3cd3.jpg', 'pending', 0, 'no', 0, 4, 0, NULL, '2022-12-14 08:48:36', '2022-12-14 08:49:48', 'rajshahi-bangladesh', '', '', '', '', '', 'Rajshahi', 'Bangladesh', 89.04896580424102, 24.229590568850742, NULL),
(23, 'Xiaomi Redmi Note 10', 'xiaomi-redmi-note-10', 7, 4, 40, 3, NULL, 120.00, '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p>&nbsp;</p><p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '01990572321', 0, '01990572321', 'uploads/addss_image/1671010547_639998f3eaf0a.jpg', 'active', 0, 'no', 0, 4, 0, NULL, '2022-12-14 09:35:33', '2022-12-20 14:44:20', 'sanma-vanuatu', '', '', '', '', '', 'Sanma', 'Vanuatu', 166.91116325224914, -15.297431927610816, NULL),
(24, 'Xiaomi Redmi Note 10', 'xiaomi-redmi-note-10-24', 7, 4, 40, 3, NULL, 500.00, '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '01990572321', 0, '01990572321', 'uploads/addss_image/1671010872_63999a3854e6a.jpg', 'pending', 1, 'yes', 0, 2, 0, NULL, '2022-12-14 09:41:12', '2022-12-14 09:41:55', 'sanma-vanuatu', '', '', '', '', '', 'Sanma', 'Vanuatu', 166.91116325224914, -15.297431927610816, NULL),
(25, 'Samsung Galaxy M30s', 'samsung-galaxy-m30s', 8, 4, 42, 1, NULL, 250.00, '<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.&nbsp;<a data-ved=\"2ahUKEwji6vTS9fj7AhXsS2wGHek8AlsQmhN6BAheEAI\" ping=\"/url?sa=t&amp;source=web&amp;rct=j&amp;url=https://en.wikipedia.org/wiki/Lorem_ipsum&amp;ved=2ahUKEwji6vTS9fj7AhXsS2wGHek8AlsQmhN6BAheEAI\" href=\"https://en.wikipedia.org/wiki/Lorem_ipsum\">Wikipedia</a></p>', NULL, 0, NULL, 'uploads/addss_image/1671016561_6399b0716a1d0.jpg', 'active', 0, 'no', 0, 4, 0, NULL, '2022-12-14 11:16:00', '2022-12-21 12:15:23', 'sanma-vanuatu', '', '', '', '', '', 'Sanma', 'Vanuatu', 166.91116325224914, -15.297431927610816, NULL),
(26, 'Corei5 6th Gen Intel Gaming,8gb ddr4', 'corei5-6th-gen-intel-gaming8gb-ddr4', 7, 4, 38, 3, NULL, 1230.00, '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '01990572321', 0, '01990572321', 'uploads/addss_image/1671019104_6399ba60a43df.jpg', 'active', 1, 'yes', 0, 11, 0, NULL, '2022-12-14 11:58:24', '2022-12-22 06:22:56', 'sanma-vanuatu', '', '', '', '', '', 'Sanma', 'Vanuatu', 166.91116325224914, -15.297431927610816, NULL),
(27, 'Corei5 6th Gen Intel Gaming,8gb ddr4', 'corei5-6th-gen-intel-gaming8gb-ddr4-27', 7, 4, 40, 13, NULL, 250.00, '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '01990572321', 0, '01990572321', 'uploads/addss_image/1671019316_6399bb342632c.jpg', 'active', 1, 'yes', 0, 10, 0, NULL, '2022-12-14 12:01:56', '2022-12-24 03:15:53', 'sanma-vanuatu', '', '', '', '', '', 'Sanma', 'Vanuatu', 166.91116325224914, -15.297431927610816, NULL),
(28, 'Electronics Products for Sale in Bangladesh', 'electronics-products-for-sale-in-bangladesh-28', 8, 4, 42, 22, NULL, 1200.00, '<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.&nbsp;<a data-ved=\"2ahUKEwji6vTS9fj7AhXsS2wGHek8AlsQmhN6BAheEAI\" ping=\"/url?sa=t&amp;source=web&amp;rct=j&amp;url=https://en.wikipedia.org/wiki/Lorem_ipsum&amp;ved=2ahUKEwji6vTS9fj7AhXsS2wGHek8AlsQmhN6BAheEAI\" href=\"https://en.wikipedia.org/wiki/Lorem_ipsum\">Wikipedia</a></p>', NULL, 0, NULL, 'uploads/addss_image/1671019535_6399bc0fded9d.jpg', 'active', 0, 'no', 0, 4, 0, NULL, '2022-12-14 12:05:35', '2022-12-22 06:35:47', 'sanma-vanuatu', '', '', '', '', '', 'Sanma', 'Vanuatu', 166.91116325224914, -15.297431927610816, NULL),
(29, 'Corei5 6th Gen Intel Gaming,8gb ddr4 ram,22', 'corei5-6th-gen-intel-gaming8gb-ddr4-ram22', 7, 4, 39, 53, NULL, 120.00, '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '01990572321', 0, '01990572321', 'uploads/addss_image/1671020087_6399be3752317.jpg', 'active', 0, 'no', 0, 1, 0, NULL, '2022-12-14 12:14:47', '2022-12-14 13:58:32', 'sanma-vanuatu', '', '', '', '', '', 'Sanma', 'Vanuatu', 166.91116325224914, -15.297431927610816, NULL),
(30, 'Corei5 6th Gen Intel Gamin', 'corei5-6th-gen-intel-gamin', 7, 4, 42, 70, NULL, 125.00, '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', NULL, 0, NULL, 'uploads/addss_image/1671020854_6399c1365ccb5.jpg', 'active', 0, 'no', 0, 0, 0, NULL, '2022-12-14 12:27:34', '2022-12-14 13:58:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 166.91116325224914, -15.297431927610816, NULL),
(31, 'Vertical disinfection cabinet', 'vertical-disinfection-cabinet', 8, 4, 42, 70, NULL, 1500.00, '<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.&nbsp;<a data-ved=\"2ahUKEwji6vTS9fj7AhXsS2wGHek8AlsQmhN6BAheEAI\" ping=\"/url?sa=t&amp;source=web&amp;rct=j&amp;url=https://en.wikipedia.org/wiki/Lorem_ipsum&amp;ved=2ahUKEwji6vTS9fj7AhXsS2wGHek8AlsQmhN6BAheEAI\" href=\"https://en.wikipedia.org/wiki/Lorem_ipsum\">Wikipedia</a></p>', NULL, 0, NULL, 'uploads/addss_image/1671020968_6399c1a8655cc.jpeg', 'active', 0, 'no', 0, 2, 0, NULL, '2022-12-14 12:29:28', '2022-12-19 05:44:29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 167.80105583037414, -14.788160988049334, NULL),
(33, 'Formalin Cleaning device', 'formalin-cleaning-device', 8, 4, 42, 70, NULL, 240.00, '<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.&nbsp;<a data-ved=\"2ahUKEwji6vTS9fj7AhXsS2wGHek8AlsQmhN6BAheEAI\" ping=\"/url?sa=t&amp;source=web&amp;rct=j&amp;url=https://en.wikipedia.org/wiki/Lorem_ipsum&amp;ved=2ahUKEwji6vTS9fj7AhXsS2wGHek8AlsQmhN6BAheEAI\" href=\"https://en.wikipedia.org/wiki/Lorem_ipsum\">Wikipedia</a></p>', NULL, 0, NULL, 'uploads/addss_image/1671022925_6399c94d18796.jpg', 'active', 0, 'no', 0, 15, 0, NULL, '2022-12-14 13:02:00', '2022-12-23 23:57:37', 'sanma-vanuatu', '', '', '', '', '', 'Sanma', 'Vanuatu', 166.91116325224914, -15.297431927610816, NULL),
(34, 'ASUS ROG STRIX RTX 3060 OC Edition V2 12GB', 'asus-rog-strix-rtx-3060-oc-edition-v2-12gb', 7, 4, 40, 62, NULL, 250.00, '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '01990572321', 0, NULL, 'uploads/addss_image/1671026221_6399d62df16e3.jpg', 'active', 0, 'no', 0, 5, 0, NULL, '2022-12-14 13:57:00', '2022-12-22 04:27:57', 'sanma-vanuatu', '', '', '', '', '', 'Sanma', 'Vanuatu', 166.91116325224914, -15.297431927610816, NULL),
(35, 'Samsung Glaxy M30s', 'samsung-glaxy-m30s', 8, 4, 42, 70, NULL, 1200.00, '<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.&nbsp;<a data-ved=\"2ahUKEwjZn_CHo_n7AhVi8jgGHZU8DgAQmhN6BAhhEAI\" ping=\"/url?sa=t&amp;source=web&amp;rct=j&amp;url=https://en.wikipedia.org/wiki/Lorem_ipsum&amp;ved=2ahUKEwjZn_CHo_n7AhVi8jgGHZU8DgAQmhN6BAhhEAI\" href=\"https://en.wikipedia.org/wiki/Lorem_ipsum\">Wikipedia</a></p>', NULL, 0, NULL, 'uploads/addss_image/1671026586_6399d79add9fa.jpg', 'pending', 0, 'no', 0, 0, 0, NULL, '2022-12-14 14:03:06', '2022-12-14 14:03:07', 'sanma-vanuatu', '', '', '', '', '', 'Sanma', 'Vanuatu', 166.91116325224914, -15.297431927610816, NULL),
(36, 'ASUS ROG STRIX RTX', 'asus-rog-strix-rtx-37', 7, 4, 40, 70, NULL, 500.00, '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '01990572321', 0, '01990572321', 'uploads/addss_image/1671027568_6399db7008011.jpg', 'active', 0, 'no', 0, 9, 0, NULL, '2022-12-14 14:16:08', '2022-12-19 10:37:59', 'sanma-province-vanuatu', '', '', '', '', '', 'Sanma Province', 'Vanuatu', 166.8947063912002, -15.62547791082473, '01990572321'),
(37, 'ASUS ROG STRIX RTX', 'asus-rog-strix-rtx', 7, 4, 35, 69, NULL, 600.00, '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', NULL, 0, NULL, 'uploads/addss_image/1671027612_6399db9c3f7fb.jpg', 'pending', 0, 'no', 0, 1, 0, NULL, '2022-12-14 14:20:12', '2022-12-14 14:20:14', 'sanma-vanuatu', '', '', '', '', '', 'Sanma', 'Vanuatu', 166.91116325224914, -15.297431927610816, NULL),
(38, 'new shoes', 'new-shoes', 10, 21, 85, 3, NULL, 30000.00, '<p>great for walking</p>', '5523694', 1, NULL, 'uploads/addss_image/1671055354_639a47fa2ecf4.png', 'pending', 0, 'no', 0, 2, 0, NULL, '2022-12-14 22:02:29', '2022-12-15 18:12:05', 'sanma-vanuatu', '', '', '', '', '', 'Sanma', 'Vanuatu', 166.91116325224914, -15.297431927610816, NULL),
(39, 'Xiaomi Redmi Note 7 Pro 2020 (Used)', 'xiaomi-redmi-note-7-pro-2020-used', 8, 4, 42, 58, NULL, 1250.00, '<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.&nbsp;<a data-ved=\"2ahUKEwjsjbmZ4Pr7AhUOZ2wGHVyHAi4QmhN6BAhiEAI\" ping=\"/url?sa=t&amp;source=web&amp;rct=j&amp;url=https://en.wikipedia.org/wiki/Lorem_ipsum&amp;ved=2ahUKEwjsjbmZ4Pr7AhUOZ2wGHVyHAi4QmhN6BAhiEAI\" href=\"https://en.wikipedia.org/wiki/Lorem_ipsum\">Wikipedia</a></p>', NULL, 0, NULL, 'uploads/addss_image/1671079818_639aa78a935c3.jpg', 'pending', 1, 'yes', 0, 1, 0, NULL, '2022-12-15 04:50:13', '2022-12-15 04:50:21', 'sanma-vanuatu', '', '', '', '', '', 'Sanma', 'Vanuatu', 166.91116325224914, -15.297431927610816, NULL),
(40, '6th Gen Gaming Corei5,8gb ddr4 ram', '6th-gen-gaming-corei58gb-ddr4-ram', 7, 4, 40, 69, NULL, 250.00, '<p>Vai ami 100% Orginal Photo Upload Koresi Amr nijer Table Er uporer photo 100% Gaming Computer khub heavy kore build kora hoise.</p><p>*gaming Casing Onk Sundor valo maner 4 Set RGB Light Soho.</p><p>*Gaming Powersupply khub Valo 550 Watt 2500 taka dami.</p><p>*Gaming Motherboard onk valo maner HDMi &amp; USB3 Soh</p>', NULL, 0, NULL, 'uploads/addss_image/1671100637_639af8dd72da3.jpg', 'pending', 0, 'no', 0, 1, 0, NULL, '2022-12-15 10:37:12', '2022-12-15 10:37:19', 'sanma-vanuatu', '', '', '', '', '', 'Sanma', 'Vanuatu', 166.91116325224914, -15.297431927610816, NULL),
(41, 'test test test test test test', 'test-test-test-test-test-test', 7, 10, 174, 70, NULL, 250.00, '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '01990572321', 0, NULL, 'uploads/addss_image/1671110647_639b1ff730b76.jpg', 'pending', 0, 'no', 0, 0, 0, NULL, '2022-12-15 13:11:17', '2022-12-15 13:24:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 166.91116325224914, -15.339815932176844, NULL),
(42, 'Accountant Job', 'accountant-job', 11, 10, 162, NULL, NULL, 12000.00, 'Screen Size	55 Inch\r\n\r\nPanel	Flat\r\n\r\nResolution	4K, 3840 x 2160p\r\n\r\nTechnology	LED Smart\r\n\r\n3D Technology	2D\r\n\r\nResponse Time	5MS\r\n\r\nRefresh Rate	Auto Motion Plus\r\n\r\nContrast	HDR10, HDR10+, Hybrid Log Gamma, Mega Contrast\r\n\r\nBrightness	High Dynamic Range\r\n\r\nTV Tuner	Digital / Analog\r\n\r\nSound	20 Watt Sound Output, Dolby Digital Plus Dolby Atmos\r\n\r\nConnectivity	2 x USB / 3 x HDMI / Wi-Fi 5.0 / Bluetooth 5.2V / LAN / Anynet+\r\n\r\nRemote	Voice Remote Control\r\n\r\nOperating System	Android\r\n\r\nDimension	1612 x 950 x 164 mm Package Size\r\n\r\nOther Features	Web Browse, Smart TV Screen Mirroring, Wi-Fi Direct ARC Support\r\n\r\nSamsung UA55AU8100UXTW Description\r\n\r\nThe Samsung AU8100 4K UHD TV has 4X more pixels quality than a standard Full HD screen. It provides bright and sharp images. You will see more genuine color emotions because of its superior color imaging algorithms. Now you have the opportunity to enjoy the realistic vision and fluid performance because of its intelligence functionality that analyses and adjusts frames from the video\'s beginning.', NULL, 1, NULL, 'uploads/addss_image/1671451977_63a055499d1cb.jpg', 'pending', 0, 'no', 0, 1, 0, NULL, '2022-12-19 10:45:11', '2022-12-20 05:12:23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 168.04824821318664, -15.308028733729403, NULL),
(43, 'urgent Land sell bashundhara project', 'urgent-land-sell-bashundhara-project', 13, 2, 62, NULL, NULL, 22562.00, 'dfsgdgdfg drfgd dfg fgdfg', NULL, 1, NULL, 'uploads/addss_image/1671539473_63a1ab11a3a41.jpg', 'pending', 1, 'yes', 0, 2, 0, NULL, '2022-12-20 12:26:08', '2022-12-20 12:31:51', 'fdghdfgdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(44, 'Land sell bashundhara project', 'land-sell-bashundhara-project', 13, 2, 62, NULL, NULL, 456254.00, '<p>🔻 Plot Details 🔻 👉 Block -I 👉 Road - 13 👉 Fornt Road Size: 25 Feet 👉 Plot Serial :- 800 👉Facing- south 👉 Plot Size: 4 Katha 👉 Price: 1 corer 10 Lac Per Katha 📝 Papers Status :- All Paper Complete. 🔻 Plot Special Feature 🔻 👉 Lush and beautiful location. 📞 Call for More details. ❗❗ Thanks -DREAM LINE PROPERTIES❗❗</p>', NULL, 1, NULL, 'uploads/addss_image/1671539647_63a1abbf67b4c.jpg', 'pending', 1, 'yes', 0, 4, 0, NULL, '2022-12-20 12:34:07', '2022-12-20 12:39:05', 'Dhaka New Market, Mirpur Road, Dhaka, Bangladesh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(45, 'Accounts Assistant', 'accounts-assistant', 7, 10, 162, NULL, NULL, 250.00, 'Company Name: Cargo One Limited ( Int\'l Freight Forwarding & Logistics )\r\n\r\nPosition: Account Office \r\n\r\nQualification: Bachelor\'s Degree minimum \r\n\r\nExperience: Experienced or Freshers can apply\r\n\r\nSalary: Negotiable \r\n\r\nOther facilities: As per company policy\r\n\r\nJob Location: Uttara, Dhaka \r\n\r\nOnly Male allowed', '+880199057232', 1, NULL, 'uploads/addss_image/1671541500_63a1b2fc4984c.png', 'pending', 0, 'no', 0, 1, 0, NULL, '2022-12-20 13:04:57', '2022-12-20 13:05:05', 'Dhaka Medical College Hospital, Secretariat Road, Dhaka, Bangladesh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(46, 'Toyota Premio . 2012', 'toyota-premio-2012', 7, 1, 7, NULL, 'Toyota', 200000.00, '<p>assalamualikum.its in good condition alhamdulillah no problem with this car for further information please call..</p>', '+880199057232', 1, NULL, 'uploads/addss_image/1671541757_63a1b3fd3e54f.jpg', 'active', 0, 'no', 0, 9, 0, NULL, '2022-12-20 13:08:07', '2022-12-24 07:53:22', 'VAN Japanese Restaurant, Wharf Road, Port Vila, Vanuatu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(47, 'jfgjhgjhg', 'jfgjhgjhg', 8, 10, 175, NULL, 'kljlk', 56.00, 'wwee ewewr ertret retret', NULL, 1, NULL, 'uploads/addss_image/1671596882_63a28b52593af.png', 'pending', 0, 'no', 0, 0, 0, NULL, '2022-12-21 04:27:56', '2022-12-21 04:28:02', 'House 58 Road No. 16, Dhaka 1212, Bangladesh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(48, 'Premium Car', 'premium-car', 11, 1, 7, NULL, 'Mercedes', 32000.00, 'Lorem ipsum dolor sit amet,consector adipicing', NULL, 1, NULL, 'uploads/addss_image/1671601293_63a29c8de0b18.jpg', 'pending', 1, 'yes', 0, 4, 0, NULL, '2022-12-21 05:38:09', '2022-12-21 05:53:16', 'Dhaka, Bangladesh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(49, 'Toshiba E-Studio2309A/2809A  Printer – Copy Express', 'toshiba-e-studio2309a2809a-printer-copy-express', 1, 28, NULL, NULL, NULL, 1200.00, '<p>Toshiba E-Studio2309A/2809A Printer is now available in store.</p>', '26327', 1, NULL, 'uploads/addss_image/1671625561_63a2fb59ab0a6.jpg', 'active', 0, 'no', 0, 1, 0, NULL, '2022-12-21 12:26:00', '2022-12-21 13:29:55', 'Port Vila International Airport (VLI), Port Vila, Vanuatu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(50, 'Yes', 'yes', 10, 25, 119, NULL, 'Book', 2.00, 'Good stuff', '5523', 0, NULL, 'uploads/addss_image/1671650917_63a35e65e194b.jpg', 'active', 0, 'no', 0, 11, 0, NULL, '2022-12-21 19:28:32', '2022-12-24 07:53:49', 'Port vila', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '01551066777');

-- --------------------------------------------------------

--
-- Table structure for table `ad_features`
--

CREATE TABLE `ad_features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ad_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ad_features`
--

INSERT INTO `ad_features` (`id`, `ad_id`, `name`, `created_at`, `updated_at`) VALUES
(51, 20, NULL, '2022-12-13 09:57:11', '2022-12-13 09:57:11'),
(52, 21, NULL, '2022-12-13 13:19:03', '2022-12-13 13:19:03'),
(54, 12, 'Best desing', '2022-12-13 13:45:45', '2022-12-13 13:45:45'),
(55, 11, 'Best desing', '2022-12-13 13:47:42', '2022-12-13 13:47:42'),
(56, 9, 'Best', '2022-12-13 13:49:38', '2022-12-13 13:49:38'),
(57, 7, 'Best', '2022-12-13 13:50:52', '2022-12-13 13:50:52'),
(58, 6, 'Engine Capacity 160 cc', '2022-12-13 13:51:12', '2022-12-13 13:51:12'),
(59, 6, 'Hydraulic Breaking System', '2022-12-13 13:51:12', '2022-12-13 13:51:12'),
(60, 6, 'Best desing', '2022-12-13 13:51:12', '2022-12-13 13:51:12'),
(61, 5, 'Engine Capacity 4800 cc', '2022-12-13 13:51:31', '2022-12-13 13:51:31'),
(62, 5, 'Hydraulics Break', '2022-12-13 13:51:31', '2022-12-13 13:51:31'),
(63, 5, 'Best desing', '2022-12-13 13:51:31', '2022-12-13 13:51:31'),
(64, 4, 'More versatile', '2022-12-13 13:52:13', '2022-12-13 13:52:13'),
(65, 3, 'Good', '2022-12-13 13:52:51', '2022-12-13 13:52:51'),
(67, 1, 'Best desing', '2022-12-13 14:24:52', '2022-12-13 14:24:52'),
(69, 15, 'Best desing', '2022-12-14 08:17:11', '2022-12-14 08:17:11'),
(70, 13, 'Best desing', '2022-12-14 08:17:41', '2022-12-14 08:17:41'),
(73, 22, NULL, '2022-12-14 08:48:39', '2022-12-14 08:48:39'),
(74, 18, 'Best desing', '2022-12-14 09:11:03', '2022-12-14 09:11:03'),
(75, 18, 'Best', '2022-12-14 09:11:03', '2022-12-14 09:11:03'),
(76, 17, 'Best', '2022-12-14 09:11:42', '2022-12-14 09:11:42'),
(77, 16, 'Best desing', '2022-12-14 09:12:48', '2022-12-14 09:12:48'),
(81, 23, 'Features One', '2022-12-14 09:38:42', '2022-12-14 09:38:42'),
(82, 24, NULL, '2022-12-14 09:41:12', '2022-12-14 09:41:12'),
(83, 25, NULL, '2022-12-14 11:16:01', '2022-12-14 11:16:01'),
(84, 41, 'Feature One', '2022-12-15 13:11:22', '2022-12-15 13:11:22'),
(85, 41, 'Feature Two', '2022-12-15 13:11:22', '2022-12-15 13:11:22'),
(86, 42, 'Lunch Facility', '2022-12-19 12:12:58', '2022-12-19 12:12:58'),
(87, 42, '12 Days Paid Leave', '2022-12-19 12:12:58', '2022-12-19 12:12:58'),
(88, 42, '10 Days Medical leave', '2022-12-19 12:12:58', '2022-12-19 12:12:58'),
(89, 42, 'Yearly Two Festival bonus', '2022-12-19 12:12:58', '2022-12-19 12:12:58'),
(90, 48, 'Kilometer to Run: 3200', '2022-12-21 05:38:14', '2022-12-21 05:38:14'),
(91, 48, 'Kilometer to Run : 3200', '2022-12-21 05:40:00', '2022-12-21 05:40:00'),
(92, 48, 'Kilometer to Run: 3200', '2022-12-21 05:41:34', '2022-12-21 05:41:34'),
(94, 49, 'New', '2022-12-21 12:27:37', '2022-12-21 12:27:37');

-- --------------------------------------------------------

--
-- Table structure for table `ad_galleries`
--

CREATE TABLE `ad_galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ad_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ad_galleries`
--

INSERT INTO `ad_galleries` (`id`, `ad_id`, `image`, `created_at`, `updated_at`) VALUES
(23, 20, 'uploads/adds_multiple/1670925337_63984c191fc79.jpg', '2022-12-13 09:55:37', '2022-12-13 09:55:37'),
(24, 20, 'uploads/adds_multiple/1670925337_63984c1928347.jpg', '2022-12-13 09:55:37', '2022-12-13 09:55:37'),
(25, 20, 'uploads/adds_multiple/1670925431_63984c7700dd7.jpg', '2022-12-13 09:57:11', '2022-12-13 09:57:11'),
(26, 20, 'uploads/adds_multiple/1670925431_63984c770a5a2.jpg', '2022-12-13 09:57:11', '2022-12-13 09:57:11'),
(27, 21, 'uploads/adds_multiple/1670937543_63987bc77488b.jpg', '2022-12-13 13:19:03', '2022-12-13 13:19:03'),
(28, 21, 'uploads/adds_multiple/1670937543_63987bc77edaa.jpg', '2022-12-13 13:19:03', '2022-12-13 13:19:03'),
(29, 12, 'uploads/adds_multiple/1670939145_63988209a2e62.jpg', '2022-12-13 13:45:45', '2022-12-13 13:45:45'),
(30, 11, 'uploads/adds_multiple/1670939262_6398827e4ffa1.jpg', '2022-12-13 13:47:42', '2022-12-13 13:47:42'),
(31, 10, 'uploads/adds_multiple/1670939312_639882b08fccc.jpg', '2022-12-13 13:48:32', '2022-12-13 13:48:32'),
(32, 9, 'uploads/adds_multiple/1670939378_639882f269093.jpg', '2022-12-13 13:49:38', '2022-12-13 13:49:38'),
(33, 8, 'uploads/adds_multiple/1670939400_63988308e1a3e.jpg', '2022-12-13 13:50:01', '2022-12-13 13:50:01'),
(34, 7, 'uploads/adds_multiple/1670939452_6398833c37f55.jpg', '2022-12-13 13:50:52', '2022-12-13 13:50:52'),
(35, 6, 'uploads/adds_multiple/1670939472_6398835067634.jpg', '2022-12-13 13:51:12', '2022-12-13 13:51:12'),
(36, 5, 'uploads/adds_multiple/1670939491_639883637d747.jpg', '2022-12-13 13:51:31', '2022-12-13 13:51:31'),
(37, 4, 'uploads/adds_multiple/1670939533_6398838d97993.jpg', '2022-12-13 13:52:13', '2022-12-13 13:52:13'),
(38, 3, 'uploads/adds_multiple/1670939572_639883b41e6c1.jpg', '2022-12-13 13:52:52', '2022-12-13 13:52:52'),
(39, 2, 'uploads/adds_multiple/1670939604_639883d482a51.jpg', '2022-12-13 13:53:24', '2022-12-13 13:53:24'),
(40, 1, 'uploads/adds_multiple/1670941492_63988b34cf066.jpg', '2022-12-13 14:24:52', '2022-12-13 14:24:52'),
(41, 15, 'uploads/adds_multiple/1671002629_63997a05e3191.jpg', '2022-12-14 07:23:49', '2022-12-14 07:23:49'),
(42, 13, 'uploads/adds_multiple/1671005865_639986a9f1f67.jpg', '2022-12-14 08:17:46', '2022-12-14 08:17:46'),
(43, 14, 'uploads/adds_multiple/1671005917_639986dd0e0ae.jpg', '2022-12-14 08:18:37', '2022-12-14 08:18:37'),
(44, 22, 'uploads/adds_multiple/1671007719_63998de7e14a2.jpg', '2022-12-14 08:48:39', '2022-12-14 08:48:39'),
(45, 18, 'uploads/adds_multiple/1671009064_63999328a1594.jpg', '2022-12-14 09:11:04', '2022-12-14 09:11:04'),
(46, 17, 'uploads/adds_multiple/1671009102_6399934e54483.jpg', '2022-12-14 09:11:42', '2022-12-14 09:11:42'),
(47, 16, 'uploads/adds_multiple/1671009169_6399939113e6d.jpg', '2022-12-14 09:12:49', '2022-12-14 09:12:49'),
(48, 23, 'uploads/adds_multiple/1671010533_639998e5ee197.jpg', '2022-12-14 09:35:33', '2022-12-14 09:35:33'),
(49, 23, 'uploads/adds_multiple/1671010548_639998f402355.jpg', '2022-12-14 09:35:48', '2022-12-14 09:35:48'),
(50, 24, 'uploads/adds_multiple/1671010872_63999a385de24.jpg', '2022-12-14 09:41:12', '2022-12-14 09:41:12'),
(51, 25, 'uploads/adds_multiple/1671016561_6399b071bcc85.jpg', '2022-12-14 11:16:01', '2022-12-14 11:16:01'),
(52, 25, 'uploads/adds_multiple/1671016561_6399b071cf151.jpg', '2022-12-14 11:16:01', '2022-12-14 11:16:01'),
(53, 26, 'uploads/adds_multiple/1671019104_6399ba60b01aa.jpg', '2022-12-14 11:58:24', '2022-12-14 11:58:24'),
(54, 27, 'uploads/adds_multiple/1671019316_6399bb342f016.jpg', '2022-12-14 12:01:56', '2022-12-14 12:01:56'),
(55, 28, 'uploads/adds_multiple/1671019535_6399bc0fe6606.jpg', '2022-12-14 12:05:35', '2022-12-14 12:05:35'),
(56, 28, 'uploads/adds_multiple/1671019535_6399bc0fec78d.jpg', '2022-12-14 12:05:35', '2022-12-14 12:05:35'),
(57, 28, 'uploads/adds_multiple/1671019535_6399bc0ff2839.jpg', '2022-12-14 12:05:36', '2022-12-14 12:05:36'),
(58, 29, 'uploads/adds_multiple/1671020087_6399be3776a00.jpg', '2022-12-14 12:14:47', '2022-12-14 12:14:47'),
(59, 30, 'uploads/adds_multiple/1671020854_6399c13666488.jpg', '2022-12-14 12:27:34', '2022-12-14 12:27:34'),
(60, 31, 'uploads/adds_multiple/1671020968_6399c1a870ca2.jpeg', '2022-12-14 12:29:28', '2022-12-14 12:29:28'),
(61, 31, 'uploads/adds_multiple/1671020968_6399c1a87a2aa.jpeg', '2022-12-14 12:29:28', '2022-12-14 12:29:28'),
(62, 32, 'uploads/adds_multiple/1671021248_6399c2c07db1f.jpeg', '2022-12-14 12:34:08', '2022-12-14 12:34:08'),
(63, 32, 'uploads/adds_multiple/1671021248_6399c2c086438.jpeg', '2022-12-14 12:34:08', '2022-12-14 12:34:08'),
(64, 33, 'uploads/adds_multiple/1671022925_6399c94d9aa7f.jpg', '2022-12-14 13:02:05', '2022-12-14 13:02:05'),
(65, 33, 'uploads/adds_multiple/1671022925_6399c94da5822.jpg', '2022-12-14 13:02:05', '2022-12-14 13:02:05'),
(66, 34, 'uploads/adds_multiple/1671026222_6399d62e13fcf.jpg', '2022-12-14 13:57:02', '2022-12-14 13:57:02'),
(67, 35, 'uploads/adds_multiple/1671026587_6399d79b40e88.jpg', '2022-12-14 14:03:07', '2022-12-14 14:03:07'),
(68, 35, 'uploads/adds_multiple/1671026587_6399d79bc91ae.jpg', '2022-12-14 14:03:07', '2022-12-14 14:03:07'),
(69, 36, 'uploads/adds_multiple/1671027368_6399daa8c3947.jpg', '2022-12-14 14:16:08', '2022-12-14 14:16:08'),
(70, 36, 'uploads/adds_multiple/1671027445_6399daf571d91.jpg', '2022-12-14 14:17:25', '2022-12-14 14:17:25'),
(71, 36, 'uploads/adds_multiple/1671027549_6399db5d4bdf8.jpg', '2022-12-14 14:19:09', '2022-12-14 14:19:09'),
(72, 36, 'uploads/adds_multiple/1671027568_6399db7014ad8.jpg', '2022-12-14 14:19:28', '2022-12-14 14:19:28'),
(73, 37, 'uploads/adds_multiple/1671027612_6399db9c4a1b7.jpg', '2022-12-14 14:20:12', '2022-12-14 14:20:12'),
(74, 38, 'uploads/adds_multiple/1671055354_639a47fa49dd6.png', '2022-12-14 22:02:34', '2022-12-14 22:02:34'),
(75, 39, 'uploads/adds_multiple/1671079818_639aa78adcaa3.jpg', '2022-12-15 04:50:18', '2022-12-15 04:50:18'),
(76, 39, 'uploads/adds_multiple/1671079818_639aa78ae8499.jpg', '2022-12-15 04:50:18', '2022-12-15 04:50:18'),
(77, 40, 'uploads/adds_multiple/1671100637_639af8dd86d71.jpg', '2022-12-15 10:37:17', '2022-12-15 10:37:17'),
(78, 41, 'uploads/adds_multiple/1671109882_639b1cfadd3af.jpg', '2022-12-15 13:11:22', '2022-12-15 13:11:22'),
(79, 41, 'uploads/adds_multiple/1671110300_639b1e9cdf6b2.jpg', '2022-12-15 13:18:20', '2022-12-15 13:18:20'),
(80, 41, 'uploads/adds_multiple/1671110604_639b1fcc6ce78.jpg', '2022-12-15 13:23:24', '2022-12-15 13:23:24'),
(81, 41, 'uploads/adds_multiple/1671110647_639b1ff73dd90.jpg', '2022-12-15 13:24:07', '2022-12-15 13:24:07'),
(82, 42, 'uploads/adds_multiple/1671446717_63a040bd3dd53.jpg', '2022-12-19 10:45:17', '2022-12-19 10:45:17'),
(83, 42, 'uploads/adds_multiple/1671451977_63a05549b099e.jpg', '2022-12-19 12:12:57', '2022-12-19 12:12:57'),
(84, 42, 'uploads/adds_multiple/1671451977_63a05549bb76d.jpg', '2022-12-19 12:12:58', '2022-12-19 12:12:58'),
(85, 43, 'uploads/adds_multiple/1671539173_63a1a9e5a1ad4.jpg', '2022-12-20 12:26:14', '2022-12-20 12:26:14'),
(86, 43, 'uploads/adds_multiple/1671539410_63a1aad246182.jpg', '2022-12-20 12:30:10', '2022-12-20 12:30:10'),
(87, 43, 'uploads/adds_multiple/1671539473_63a1ab11e2aed.jpg', '2022-12-20 12:31:14', '2022-12-20 12:31:14'),
(88, 44, 'uploads/adds_multiple/1671539647_63a1abbfce07d.jpg', '2022-12-20 12:34:09', '2022-12-20 12:34:09'),
(89, 45, 'uploads/adds_multiple/1671541500_63a1b2fc6489d.png', '2022-12-20 13:05:00', '2022-12-20 13:05:00'),
(90, 46, 'uploads/adds_multiple/1671541687_63a1b3b7535f4.jpg', '2022-12-20 13:08:07', '2022-12-20 13:08:07'),
(91, 46, 'uploads/adds_multiple/1671541734_63a1b3e6d448a.jpg', '2022-12-20 13:08:54', '2022-12-20 13:08:54'),
(92, 46, 'uploads/adds_multiple/1671541757_63a1b3fd5bda3.jpg', '2022-12-20 13:09:17', '2022-12-20 13:09:17'),
(93, 47, 'uploads/adds_multiple/1671596882_63a28b5297202.png', '2022-12-21 04:28:02', '2022-12-21 04:28:02'),
(94, 48, 'uploads/adds_multiple/1671601094_63a29bc676b4c.jpg', '2022-12-21 05:38:14', '2022-12-21 05:38:14'),
(95, 48, 'uploads/adds_multiple/1671601200_63a29c30da48e.jpg', '2022-12-21 05:40:00', '2022-12-21 05:40:00'),
(96, 48, 'uploads/adds_multiple/1671601294_63a29c8e1f51a.jpg', '2022-12-21 05:41:34', '2022-12-21 05:41:34'),
(97, 49, 'uploads/addss_multiple/1671625598_63a2fb7ecffdf.jpg', '2022-12-21 12:26:39', '2022-12-21 12:26:39'),
(98, 49, 'uploads/addss_multiple/1671625599_63a2fb7f27f90.jpg', '2022-12-21 12:26:39', '2022-12-21 12:26:39'),
(99, 46, 'uploads/adds_multiple/1671629828_63a30c042bec7.jpeg', '2022-12-21 13:37:08', '2022-12-21 13:37:08'),
(100, 50, 'uploads/adds_multiple/1671650918_63a35e6682655.jpg', '2022-12-21 19:28:38', '2022-12-21 19:28:38');

-- --------------------------------------------------------

--
-- Table structure for table `blog_comments`
--

CREATE TABLE `blog_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `body` varchar(255) NOT NULL,
  `image` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `category_id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 0, 'samsung', 'samsung', '2022-11-29 01:38:08', '2022-11-29 01:38:08'),
(2, 0, 'Apple', 'apple', '2022-11-30 05:13:15', '2022-11-30 05:13:15'),
(3, 0, 'Nike', 'nike', '2022-11-30 05:13:32', '2022-11-30 05:13:32'),
(4, 0, 'Lava', 'lava', '2022-12-14 11:57:30', '2022-12-14 11:57:30'),
(5, 0, 'Microsoft', 'microsoft', '2022-12-14 11:57:53', '2022-12-14 11:57:53'),
(6, 0, 'Micromax', 'micromax', '2022-12-14 11:58:05', '2022-12-14 11:58:05'),
(7, 0, 'Motorola', 'motorola', '2022-12-14 11:58:17', '2022-12-14 11:58:17'),
(8, 0, 'Nokia', 'nokia', '2022-12-14 11:58:28', '2022-12-14 11:58:28'),
(9, 0, 'OnePlus', 'oneplus', '2022-12-14 11:58:40', '2022-12-14 11:58:40'),
(10, 0, 'OPPO', 'oppo', '2022-12-14 11:59:04', '2022-12-14 11:59:04'),
(11, 0, 'Panasonic', 'panasonic', '2022-12-14 11:59:22', '2022-12-14 11:59:22'),
(12, 0, 'Rangs', 'rangs', '2022-12-14 11:59:33', '2022-12-14 11:59:33'),
(13, 0, 'Realme', 'realme', '2022-12-14 11:59:44', '2022-12-14 11:59:44'),
(14, 0, 'Sony Ericsson', 'sony-ericsson', '2022-12-14 12:00:19', '2022-12-14 12:00:19'),
(15, 0, 'Vivo', 'vivo', '2022-12-14 12:00:56', '2022-12-14 12:00:56'),
(16, 0, 'Xiaomi', 'xiaomi', '2022-12-14 12:01:41', '2022-12-14 12:01:41'),
(17, 0, 'Acer', 'acer', '2022-12-14 12:03:01', '2022-12-14 12:03:01'),
(18, 0, 'Ainol', 'ainol', '2022-12-14 12:03:10', '2022-12-14 12:03:10'),
(19, 0, 'Apple iMac', 'apple-imac', '2022-12-14 12:03:20', '2022-12-14 12:03:20'),
(20, 0, 'Asus', 'asus', '2022-12-14 12:03:42', '2022-12-14 12:03:42'),
(21, 0, 'Daffodil', 'daffodil', '2022-12-14 12:03:55', '2022-12-14 12:03:55'),
(22, 0, 'Dell', 'dell', '2022-12-14 12:04:05', '2022-12-14 12:04:05'),
(23, 0, 'HP', 'hp', '2022-12-14 12:04:18', '2022-12-14 12:04:18'),
(24, 0, 'Intel', 'intel', '2022-12-14 12:04:32', '2022-12-14 12:04:32'),
(25, 0, 'Toshiba', 'toshiba', '2022-12-14 12:04:56', '2022-12-14 12:04:56'),
(26, 0, 'Walton', 'walton', '2022-12-14 12:05:07', '2022-12-14 12:05:07'),
(27, 0, 'Sony', 'sony', '2022-12-14 12:05:17', '2022-12-14 12:05:17'),
(28, 0, 'Konka', 'konka', '2022-12-14 12:06:25', '2022-12-14 12:06:25'),
(29, 0, 'LG', 'lg', '2022-12-14 12:06:35', '2022-12-14 12:06:35'),
(30, 0, 'Minister', 'minister', '2022-12-14 12:06:46', '2022-12-14 12:06:46'),
(31, 0, 'National', 'national', '2022-12-14 12:06:58', '2022-12-14 12:06:58'),
(32, 0, 'Nippon', 'nippon', '2022-12-14 12:07:20', '2022-12-14 12:07:20'),
(33, 0, 'Sony Plus', 'sony-plus', '2022-12-14 12:07:38', '2022-12-14 12:07:38'),
(34, 0, 'Vision', 'vision', '2022-12-14 12:07:49', '2022-12-14 12:07:49'),
(35, 0, 'Canon', 'canon', '2022-12-14 12:08:30', '2022-12-14 12:08:30'),
(36, 0, 'Alfa Romeo', 'alfa-romeo', '2022-12-14 12:09:28', '2022-12-14 12:09:28'),
(37, 0, 'Audi', 'audi', '2022-12-14 12:10:05', '2022-12-14 12:10:05'),
(38, 0, 'BMW', 'bmw', '2022-12-14 12:10:16', '2022-12-14 12:10:16'),
(39, 0, 'Changan', 'changan', '2022-12-14 12:10:31', '2022-12-14 12:10:31'),
(40, 0, 'Chery', 'chery', '2022-12-14 12:10:43', '2022-12-14 12:10:43'),
(41, 0, 'Datsun', 'datsun', '2022-12-14 12:10:57', '2022-12-14 12:10:57'),
(42, 0, 'Dodge', 'dodge', '2022-12-14 12:11:08', '2022-12-14 12:11:08'),
(43, 0, 'Ferrari', 'ferrari', '2022-12-14 12:11:20', '2022-12-14 12:11:20'),
(44, 0, 'Fiat', 'fiat', '2022-12-14 12:11:30', '2022-12-14 12:11:30'),
(45, 0, 'Ford', 'ford', '2022-12-14 12:11:42', '2022-12-14 12:11:42'),
(46, 0, 'Honda', 'honda', '2022-12-14 12:11:58', '2022-12-14 12:11:58'),
(47, 0, 'Hummer', 'hummer', '2022-12-14 12:12:11', '2022-12-14 12:12:11'),
(48, 0, 'Hyundai', 'hyundai', '2022-12-14 12:12:19', '2022-12-14 12:12:19'),
(49, 0, 'Jeep', 'jeep', '2022-12-14 12:12:36', '2022-12-14 12:12:36'),
(50, 0, 'Lamborghini', 'lamborghini', '2022-12-14 12:12:48', '2022-12-14 12:12:48'),
(51, 0, 'Land Rover', 'land-rover', '2022-12-14 12:12:58', '2022-12-14 12:12:58'),
(52, 0, 'Lexus', 'lexus', '2022-12-14 12:13:11', '2022-12-14 12:13:11'),
(53, 0, 'Maruti Suzuki', 'maruti-suzuki', '2022-12-14 12:13:22', '2022-12-14 12:13:22'),
(54, 0, 'Mercedes-Benz', 'mercedes-benz', '2022-12-14 12:13:31', '2022-12-14 12:13:31'),
(55, 0, 'Bajaj', 'bajaj', '2022-12-14 12:14:24', '2022-12-14 12:14:24'),
(56, 0, 'Benelli', 'benelli', '2022-12-14 12:14:33', '2022-12-14 12:14:33'),
(57, 0, 'Butterfly', 'butterfly', '2022-12-14 12:14:45', '2022-12-14 12:14:45'),
(58, 0, 'Bennett', 'bennett', '2022-12-14 12:14:55', '2022-12-14 12:14:55'),
(59, 0, 'Ducati', 'ducati', '2022-12-14 12:15:11', '2022-12-14 12:15:11'),
(60, 0, 'Freedom Runner', 'freedom-runner', '2022-12-14 12:15:23', '2022-12-14 12:15:23'),
(61, 0, 'Freedom', 'freedom', '2022-12-14 12:15:34', '2022-12-14 12:15:34'),
(62, 0, 'Hero', 'hero', '2022-12-14 12:15:51', '2022-12-14 12:15:51'),
(63, 0, 'Kawasaki', 'kawasaki', '2022-12-14 12:16:19', '2022-12-14 12:16:19'),
(64, 0, 'Keeway', 'keeway', '2022-12-14 12:16:30', '2022-12-14 12:16:30'),
(65, 0, 'Roadmaster', 'roadmaster', '2022-12-14 12:16:56', '2022-12-14 12:16:56'),
(66, 0, 'Singer', 'singer', '2022-12-14 12:17:08', '2022-12-14 12:17:08'),
(67, 1, 'Sunsuki', 'sunsuki', '2022-12-14 12:17:24', '2022-12-23 22:53:24'),
(68, 10, 'Suzuki', 'suzuki', '2022-12-14 12:17:40', '2022-12-23 22:53:13'),
(69, 2, 'TVS', 'tvs', '2022-12-14 12:17:52', '2022-12-23 22:53:05'),
(70, 1, 'Yamaha', 'yamaha', '2022-12-14 12:18:07', '2022-12-23 22:52:57');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `icon` longtext DEFAULT NULL,
  `order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `is_show_brand` int(11) NOT NULL DEFAULT 1 COMMENT '1=yes 0=no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`, `slug`, `icon`, `order`, `status`, `is_show_brand`, `created_at`, `updated_at`) VALUES
(1, 'Vehicles', 'uploads/category/Uan6uoBfcalh6K2PHgLlAEM0xnJcXlkbx9t4Gyft.png', 'vehicles', 'fas fa-car', 1, 1, 0, '2022-10-24 22:25:27', '2022-12-13 09:08:39'),
(2, 'Property', 'uploads/category/Uan6uoBfcalh6K2PHgLlAEM0xnJcXlkbx9t4Gyft.png', 'property', 'fas fa-landmark', 4, 1, 1, '2022-10-26 14:47:30', '2022-12-01 21:14:09'),
(3, 'Mobile phones & tablets', 'uploads/category/Uan6uoBfcalh6K2PHgLlAEM0xnJcXlkbx9t4Gyft.png', 'mobile-phones-tablets', 'fas fa-mobile-alt', 3, 1, 1, '2022-10-26 14:48:43', '2022-12-01 21:15:37'),
(4, 'Electronics', 'uploads/category/Uan6uoBfcalh6K2PHgLlAEM0xnJcXlkbx9t4Gyft.png', 'electronics', 'fas fa-battery-half', 2, 1, 1, '2022-10-26 14:49:26', '2022-12-01 21:16:48'),
(5, 'Fashion', 'uploads/category/Uan6uoBfcalh6K2PHgLlAEM0xnJcXlkbx9t4Gyft.png', 'fashion', 'fas fa-ad', 7, 1, 1, '2022-10-26 14:50:05', '2022-10-26 14:50:05'),
(6, 'Home, Furniture and Appliances', 'uploads/category/Uan6uoBfcalh6K2PHgLlAEM0xnJcXlkbx9t4Gyft.png', 'home-furniture-and-appliances', 'fas fa-home', 3, 1, 1, '2022-10-26 18:20:07', '2022-10-26 18:20:07'),
(7, 'Health & Beauty', 'uploads/category/Uan6uoBfcalh6K2PHgLlAEM0xnJcXlkbx9t4Gyft.png', 'health-beauty', 'fas fa-beer', 3, 1, 1, '2022-10-26 18:20:57', '2022-12-01 21:34:49'),
(8, 'Sports, Arts and Outdoors', 'uploads/category/Uan6uoBfcalh6K2PHgLlAEM0xnJcXlkbx9t4Gyft.png', 'sports-arts-and-outdoors', 'fas fa-passport', 4, 1, 1, '2022-10-26 18:21:35', '2022-10-26 18:21:35'),
(9, 'Services', 'uploads/category/Uan6uoBfcalh6K2PHgLlAEM0xnJcXlkbx9t4Gyft.png', 'services', 'fas fa-server', 3, 1, 1, '2022-10-26 18:22:08', '2022-10-26 18:22:08'),
(10, 'Jobs', 'uploads/category/Uan6uoBfcalh6K2PHgLlAEM0xnJcXlkbx9t4Gyft.png', 'jobs', 'fab fa-joomla', 4, 1, 1, '2022-10-26 18:22:43', '2022-10-26 18:22:43'),
(11, 'Babies and Kids', 'uploads/category/Uan6uoBfcalh6K2PHgLlAEM0xnJcXlkbx9t4Gyft.png', 'babies-and-kids', 'fab fa-kickstarter-k', 8, 1, 1, '2022-10-26 18:23:22', '2022-10-26 18:23:22'),
(14, 'Repair and Construction', 'uploads/category/Uan6uoBfcalh6K2PHgLlAEM0xnJcXlkbx9t4Gyft.png', 'repair-and-construction', 'fab fa-autoprefixer', 4, 1, 1, '2022-10-26 18:25:52', '2022-10-26 18:25:52'),
(15, 'Commercial equipment and tools', 'uploads/category/Uan6uoBfcalh6K2PHgLlAEM0xnJcXlkbx9t4Gyft.png', 'commercial-equipment-and-tools', 'fas fa-comment-slash', 5, 1, 1, '2022-10-26 18:26:38', '2022-10-26 18:26:38'),
(16, 'Phone', 'uploads/category/Uan6uoBfcalh6K2PHgLlAEM0xnJcXlkbx9t4Gyft.png', 'phone', 'fas fa-mobile-alt', 10, 1, 1, '2022-12-04 00:36:08', '2022-12-04 00:36:08'),
(17, 'Mobiles', 'uploads/category/Uan6uoBfcalh6K2PHgLlAEM0xnJcXlkbx9t4Gyft.png', 'mobiles', 'fas fa-mobile-alt', 5, 1, 1, '2022-12-13 15:34:11', '2022-12-13 15:34:11'),
(18, 'Home & Living', 'uploads/category/Uan6uoBfcalh6K2PHgLlAEM0xnJcXlkbx9t4Gyft.png', 'home-living', 'fas fa-home', 3, 1, 0, '2022-12-13 15:35:50', '2022-12-13 15:35:50'),
(19, 'Pets & Animals', 'uploads/category/Uan6uoBfcalh6K2PHgLlAEM0xnJcXlkbx9t4Gyft.png', 'pets-animals', 'fab fa-wolf-pack-battalion', 9, 1, 0, '2022-12-13 15:37:10', '2022-12-13 15:37:10'),
(20, 'Hobbies, Sports & Kids', 'uploads/category/Uan6uoBfcalh6K2PHgLlAEM0xnJcXlkbx9t4Gyft.png', 'hobbies-sports-kids', 'fas fa-football-ball', 2, 1, 1, '2022-12-13 15:38:31', '2022-12-13 15:38:31'),
(21, 'Men\'s Fashion & Grooming', 'uploads/category/Uan6uoBfcalh6K2PHgLlAEM0xnJcXlkbx9t4Gyft.png', 'mens-fashion-grooming', 'fas fa-tshirt', 4, 1, 1, '2022-12-13 15:39:28', '2022-12-13 15:39:28'),
(22, 'Women\'s Fashion & Beauty', 'uploads/category/Uan6uoBfcalh6K2PHgLlAEM0xnJcXlkbx9t4Gyft.png', 'womens-fashion-beauty', 'fas fa-paint-brush', 6, 1, 1, '2022-12-13 15:41:48', '2022-12-13 15:41:48'),
(23, 'Business & Industry', 'uploads/category/Uan6uoBfcalh6K2PHgLlAEM0xnJcXlkbx9t4Gyft.png', 'business-industry', 'fas fa-industry', 4, 1, 0, '2022-12-13 15:42:55', '2022-12-13 15:42:55'),
(24, 'Essentials', 'uploads/category/Uan6uoBfcalh6K2PHgLlAEM0xnJcXlkbx9t4Gyft.png', 'essentials', 'fas fa-box', 6, 1, 0, '2022-12-13 15:43:46', '2022-12-13 15:43:46'),
(25, 'Education', 'uploads/category/Uan6uoBfcalh6K2PHgLlAEM0xnJcXlkbx9t4Gyft.png', 'education', 'fas fa-school', 3, 1, 0, '2022-12-13 15:44:36', '2022-12-13 15:44:36'),
(26, 'Agriculture', 'uploads/category/Uan6uoBfcalh6K2PHgLlAEM0xnJcXlkbx9t4Gyft.png', 'agriculture', 'fab fa-angrycreative', 4, 1, 0, '2022-12-13 15:48:58', '2022-12-13 15:48:58'),
(27, 'Overseas Jobs', 'uploads/category/Uan6uoBfcalh6K2PHgLlAEM0xnJcXlkbx9t4Gyft.png', 'overseas-jobs', 'fas fa-briefcase', 2, 1, 0, '2022-12-13 15:49:42', '2022-12-13 15:49:42'),
(28, 'Office Supplies', 'uploads/category/qWRtijZmPX2lrn8v9zswQmmynOi4bUscCpKUBU1r.jpg', 'office-supplies', 'fas fa-warehouse', 3, 1, 1, '2022-12-21 12:20:43', '2022-12-21 12:20:43');

-- --------------------------------------------------------

--
-- Table structure for table `category_custom_field`
--

CREATE TABLE `category_custom_field` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `custom_field_id` bigint(20) UNSIGNED NOT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_custom_field`
--

INSERT INTO `category_custom_field` (`id`, `category_id`, `custom_field_id`, `order`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 0, NULL, NULL),
(2, 2, 2, 0, NULL, NULL),
(3, 2, 3, 0, NULL, NULL),
(4, 2, 4, 0, NULL, NULL),
(5, 2, 5, 0, NULL, NULL),
(6, 2, 6, 0, NULL, NULL),
(7, 1, 7, 0, NULL, NULL),
(8, 1, 8, 0, NULL, NULL),
(9, 1, 9, 0, NULL, NULL),
(10, 1, 10, 0, NULL, NULL),
(11, 10, 11, 0, NULL, NULL),
(12, 10, 12, 0, NULL, NULL),
(13, 10, 13, 0, NULL, NULL),
(14, 10, 14, 0, NULL, NULL),
(15, 10, 15, 0, NULL, NULL),
(16, 10, 16, 0, NULL, NULL),
(17, 10, 17, 0, NULL, NULL),
(18, 10, 18, 0, NULL, NULL),
(19, 10, 19, 0, NULL, NULL),
(20, 10, 20, 0, NULL, NULL),
(21, 28, 2, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cms`
--

CREATE TABLE `cms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `home_main_banner` varchar(255) DEFAULT NULL,
  `home_counter_background` varchar(255) DEFAULT NULL,
  `home_mobile_app_banner` varchar(255) DEFAULT NULL,
  `home_title` varchar(255) DEFAULT NULL,
  `home_description` varchar(255) DEFAULT NULL,
  `download_app` varchar(255) DEFAULT NULL,
  `newsletter_content` varchar(255) DEFAULT NULL,
  `membership_content` varchar(255) DEFAULT NULL,
  `create_account` varchar(255) DEFAULT NULL,
  `post_ads` varchar(255) DEFAULT NULL,
  `start_earning` varchar(255) DEFAULT NULL,
  `terms_background` varchar(255) DEFAULT NULL,
  `terms_body` text DEFAULT NULL,
  `about_background` varchar(255) DEFAULT NULL,
  `about_video_thumb` varchar(255) DEFAULT NULL,
  `about_body` text DEFAULT NULL,
  `privacy_background` varchar(255) DEFAULT NULL,
  `privacy_body` text DEFAULT NULL,
  `contact_background` varchar(255) DEFAULT NULL,
  `contact_number` varchar(255) DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `contact_address` varchar(255) DEFAULT NULL,
  `get_membership_background` varchar(255) DEFAULT NULL,
  `get_membership_image` varchar(255) DEFAULT NULL,
  `pricing_plan_background` varchar(255) DEFAULT NULL,
  `faq_background` varchar(255) DEFAULT NULL,
  `faq_content` varchar(255) DEFAULT NULL,
  `manage_ads_content` varchar(255) DEFAULT NULL,
  `chat_content` varchar(255) DEFAULT NULL,
  `verified_user_content` varchar(255) DEFAULT NULL,
  `dashboard_overview_background` varchar(255) DEFAULT NULL,
  `dashboard_post_ads_background` varchar(255) DEFAULT NULL,
  `dashboard_my_ads_background` varchar(255) DEFAULT NULL,
  `dashboard_plan_background` varchar(255) DEFAULT NULL,
  `dashboard_account_setting_background` varchar(255) DEFAULT NULL,
  `dashboard_favorite_ads_background` varchar(255) DEFAULT NULL,
  `dashboard_messenger_background` varchar(255) DEFAULT NULL,
  `posting_rules_background` varchar(255) DEFAULT NULL,
  `posting_rules_body` text DEFAULT NULL,
  `blog_background` varchar(255) DEFAULT NULL,
  `ads_background` varchar(255) DEFAULT NULL,
  `coming_soon_title` varchar(255) DEFAULT NULL,
  `coming_soon_subtitle` varchar(255) DEFAULT NULL,
  `maintenance_title` varchar(255) DEFAULT NULL,
  `maintenance_subtitle` varchar(255) DEFAULT NULL,
  `e404_title` varchar(255) DEFAULT NULL,
  `e404_subtitle` varchar(255) DEFAULT NULL,
  `e404_image` varchar(255) DEFAULT NULL,
  `e500_title` varchar(255) DEFAULT NULL,
  `e500_subtitle` varchar(255) DEFAULT NULL,
  `e500_image` varchar(255) DEFAULT NULL,
  `e503_title` varchar(255) DEFAULT NULL,
  `e503_subtitle` varchar(255) DEFAULT NULL,
  `e503_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms`
--

INSERT INTO `cms` (`id`, `home_main_banner`, `home_counter_background`, `home_mobile_app_banner`, `home_title`, `home_description`, `download_app`, `newsletter_content`, `membership_content`, `create_account`, `post_ads`, `start_earning`, `terms_background`, `terms_body`, `about_background`, `about_video_thumb`, `about_body`, `privacy_background`, `privacy_body`, `contact_background`, `contact_number`, `contact_email`, `contact_address`, `get_membership_background`, `get_membership_image`, `pricing_plan_background`, `faq_background`, `faq_content`, `manage_ads_content`, `chat_content`, `verified_user_content`, `dashboard_overview_background`, `dashboard_post_ads_background`, `dashboard_my_ads_background`, `dashboard_plan_background`, `dashboard_account_setting_background`, `dashboard_favorite_ads_background`, `dashboard_messenger_background`, `posting_rules_background`, `posting_rules_body`, `blog_background`, `ads_background`, `coming_soon_title`, `coming_soon_subtitle`, `maintenance_title`, `maintenance_subtitle`, `e404_title`, `e404_subtitle`, `e404_image`, `e500_title`, `e500_subtitle`, `e500_image`, `e503_title`, `e503_subtitle`, `e503_image`, `created_at`, `updated_at`) VALUES
(1, 'uploads/banners/V1HmW4gnJDHXfap1qiuSbY5212iMV2n8e4FftpB4.jpg', NULL, NULL, 'Buy, Sell, And Find Everisamting', 'Buy And Sell Everything From Used Cars To Mobile Phones And Computers, Or Search For Property And More All Over The World!', NULL, NULL, 'Choose our membership plan to publish your ads with us', NULL, NULL, NULL, NULL, '<p>&nbsp;</p><p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br>&nbsp;</p>', 'uploads/banners/GwZtV6UMxXFp4Ffk1vYwXg5YYNmhemKcPGryq6t7.png', 'https://youtu.be/s7wmiS2mSXY', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br>&nbsp;</p>', NULL, '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br>&nbsp;</p>', NULL, '+88 01767671133', 'info@everisamting.com', 'Banani, Dhaka, Bangladesh', NULL, NULL, NULL, NULL, 'Praesent Finibus Dictum Nisl Sit Amet Vulputate. Fusce A Metus Eu Velit Posuere Semper A Bibendum Ante. Donec Eu Tellus Dapibus, Semper Orci Eget, Commodo Lacu Praesent Ullamcorper.', 'Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit. Etiam Commodo Vel Ligula.', 'Class Aptent Taciti Sociosqu Ad Litora Torquent Per Conubia Nostra, Per Inceptos Himenaeos.', 'Class Aptent Taciti Sociosqu Ad Litora Torquent Per Conubia Nostra, Per Inceptos Himenaeos.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p>&nbsp;</p>', NULL, NULL, 'Coming Soon', 'We are hardly trying to launch our website', 'Under Construction', 'Our website is under construction :)', 'Opps! Page Not Found!', 'We didn\'t find the page for you. Please go back to home page.', 'frontend/images/bg/error.png', 'Opps! Page Not Found!', 'We didn\'t find the page for you. Please go back to home page.', 'frontend/default_images/error-banner.png', 'Opps! Page Not Found!', 'We didn\'t find the page for you. Please go back to home page.', 'frontend/default_images/error-banner.png', '2022-08-19 23:31:12', '2022-12-15 08:59:57');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(1, 'Ziaur Rahman', 'ziariyad018@gmail.com', 'Buy', 'Please help product buy', '2022-11-27 16:43:47', '2022-11-27 16:43:47'),
(2, 'E', 'shmvanuatu@gmail.com', 'Test', 'Test message from website', '2022-12-15 06:58:56', '2022-12-15 06:58:56'),
(3, 'Safwan Ahmmed', 'masudrana.tapu1998@gmail.com', 'New for all time234', 'New worldsdfasdaf sadf sdaf', '2022-12-19 05:25:37', '2022-12-19 05:25:37');

-- --------------------------------------------------------

--
-- Table structure for table `cookies`
--

CREATE TABLE `cookies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `allow_cookies` tinyint(1) NOT NULL DEFAULT 1,
  `cookie_name` varchar(255) NOT NULL DEFAULT 'gdpr_cookie',
  `cookie_expiration` tinyint(4) NOT NULL DEFAULT 30,
  `force_consent` tinyint(1) NOT NULL DEFAULT 0,
  `darkmode` tinyint(1) NOT NULL DEFAULT 0,
  `language` varchar(255) NOT NULL DEFAULT 'en',
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `approve_button_text` varchar(255) NOT NULL,
  `decline_button_text` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cookies`
--

INSERT INTO `cookies` (`id`, `allow_cookies`, `cookie_name`, `cookie_expiration`, `force_consent`, `darkmode`, `language`, `title`, `description`, `approve_button_text`, `decline_button_text`, `created_at`, `updated_at`) VALUES
(1, 1, 'gdpr_cookie', 30, 0, 0, 'en', 'We use cookies!', 'Hi, this website uses essential cookies to ensure its proper operation and tracking cookies to understand how you interact with it. The latter will be set only after consent. <button type=\"button\" data-cc=\"c-settings\" class=\"cc-link\">Let me choose</button>', 'Allow all Cookies', 'Reject all Cookies', '2022-08-19 23:31:12', '2022-08-19 23:31:12');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `iso` char(2) NOT NULL,
  `name` varchar(80) NOT NULL,
  `nicename` varchar(80) NOT NULL,
  `iso3` char(3) DEFAULT NULL,
  `numcode` smallint(6) DEFAULT NULL,
  `phonecode` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES
(1, 'AF', 'AFGHANISTAN', 'Afghanistan', 'AFG', 4, 93),
(2, 'AL', 'ALBANIA', 'Albania', 'ALB', 8, 355),
(3, 'DZ', 'ALGERIA', 'Algeria', 'DZA', 12, 213),
(4, 'AS', 'AMERICAN SAMOA', 'American Samoa', 'ASM', 16, 1684),
(5, 'AD', 'ANDORRA', 'Andorra', 'AND', 20, 376),
(6, 'AO', 'ANGOLA', 'Angola', 'AGO', 24, 244),
(7, 'AI', 'ANGUILLA', 'Anguilla', 'AIA', 660, 1264),
(8, 'AQ', 'ANTARCTICA', 'Antarctica', NULL, NULL, 0),
(9, 'AG', 'ANTIGUA AND BARBUDA', 'Antigua and Barbuda', 'ATG', 28, 1268),
(10, 'AR', 'ARGENTINA', 'Argentina', 'ARG', 32, 54),
(11, 'AM', 'ARMENIA', 'Armenia', 'ARM', 51, 374),
(12, 'AW', 'ARUBA', 'Aruba', 'ABW', 533, 297),
(13, 'AU', 'AUSTRALIA', 'Australia', 'AUS', 36, 61),
(14, 'AT', 'AUSTRIA', 'Austria', 'AUT', 40, 43),
(15, 'AZ', 'AZERBAIJAN', 'Azerbaijan', 'AZE', 31, 994),
(16, 'BS', 'BAHAMAS', 'Bahamas', 'BHS', 44, 1242),
(17, 'BH', 'BAHRAIN', 'Bahrain', 'BHR', 48, 973),
(18, 'BD', 'BANGLADESH', 'Bangladesh', 'BGD', 50, 880),
(19, 'BB', 'BARBADOS', 'Barbados', 'BRB', 52, 1246),
(20, 'BY', 'BELARUS', 'Belarus', 'BLR', 112, 375),
(21, 'BE', 'BELGIUM', 'Belgium', 'BEL', 56, 32),
(22, 'BZ', 'BELIZE', 'Belize', 'BLZ', 84, 501),
(23, 'BJ', 'BENIN', 'Benin', 'BEN', 204, 229),
(24, 'BM', 'BERMUDA', 'Bermuda', 'BMU', 60, 1441),
(25, 'BT', 'BHUTAN', 'Bhutan', 'BTN', 64, 975),
(26, 'BO', 'BOLIVIA', 'Bolivia', 'BOL', 68, 591),
(27, 'BA', 'BOSNIA AND HERZEGOVINA', 'Bosnia and Herzegovina', 'BIH', 70, 387),
(28, 'BW', 'BOTSWANA', 'Botswana', 'BWA', 72, 267),
(29, 'BV', 'BOUVET ISLAND', 'Bouvet Island', NULL, NULL, 0),
(30, 'BR', 'BRAZIL', 'Brazil', 'BRA', 76, 55),
(31, 'IO', 'BRITISH INDIAN OCEAN TERRITORY', 'British Indian Ocean Territory', NULL, NULL, 246),
(32, 'BN', 'BRUNEI DARUSSALAM', 'Brunei Darussalam', 'BRN', 96, 673),
(33, 'BG', 'BULGARIA', 'Bulgaria', 'BGR', 100, 359),
(34, 'BF', 'BURKINA FASO', 'Burkina Faso', 'BFA', 854, 226),
(35, 'BI', 'BURUNDI', 'Burundi', 'BDI', 108, 257),
(36, 'KH', 'CAMBODIA', 'Cambodia', 'KHM', 116, 855),
(37, 'CM', 'CAMEROON', 'Cameroon', 'CMR', 120, 237),
(38, 'CA', 'CANADA', 'Canada', 'CAN', 124, 1),
(39, 'CV', 'CAPE VERDE', 'Cape Verde', 'CPV', 132, 238),
(40, 'KY', 'CAYMAN ISLANDS', 'Cayman Islands', 'CYM', 136, 1345),
(41, 'CF', 'CENTRAL AFRICAN REPUBLIC', 'Central African Republic', 'CAF', 140, 236),
(42, 'TD', 'CHAD', 'Chad', 'TCD', 148, 235),
(43, 'CL', 'CHILE', 'Chile', 'CHL', 152, 56),
(44, 'CN', 'CHINA', 'China', 'CHN', 156, 86),
(45, 'CX', 'CHRISTMAS ISLAND', 'Christmas Island', NULL, NULL, 61),
(46, 'CC', 'COCOS (KEELING) ISLANDS', 'Cocos (Keeling) Islands', NULL, NULL, 672),
(47, 'CO', 'COLOMBIA', 'Colombia', 'COL', 170, 57),
(48, 'KM', 'COMOROS', 'Comoros', 'COM', 174, 269),
(49, 'CG', 'CONGO', 'Congo', 'COG', 178, 242),
(50, 'CD', 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'Congo, the Democratic Republic of the', 'COD', 180, 242),
(51, 'CK', 'COOK ISLANDS', 'Cook Islands', 'COK', 184, 682),
(52, 'CR', 'COSTA RICA', 'Costa Rica', 'CRI', 188, 506),
(53, 'CI', 'COTE D\'IVOIRE', 'Cote D\'Ivoire', 'CIV', 384, 225),
(54, 'HR', 'CROATIA', 'Croatia', 'HRV', 191, 385),
(55, 'CU', 'CUBA', 'Cuba', 'CUB', 192, 53),
(56, 'CY', 'CYPRUS', 'Cyprus', 'CYP', 196, 357),
(57, 'CZ', 'CZECH REPUBLIC', 'Czech Republic', 'CZE', 203, 420),
(58, 'DK', 'DENMARK', 'Denmark', 'DNK', 208, 45),
(59, 'DJ', 'DJIBOUTI', 'Djibouti', 'DJI', 262, 253),
(60, 'DM', 'DOMINICA', 'Dominica', 'DMA', 212, 1767),
(61, 'DO', 'DOMINICAN REPUBLIC', 'Dominican Republic', 'DOM', 214, 1809),
(62, 'EC', 'ECUADOR', 'Ecuador', 'ECU', 218, 593),
(63, 'EG', 'EGYPT', 'Egypt', 'EGY', 818, 20),
(64, 'SV', 'EL SALVADOR', 'El Salvador', 'SLV', 222, 503),
(65, 'GQ', 'EQUATORIAL GUINEA', 'Equatorial Guinea', 'GNQ', 226, 240),
(66, 'ER', 'ERITREA', 'Eritrea', 'ERI', 232, 291),
(67, 'EE', 'ESTONIA', 'Estonia', 'EST', 233, 372),
(68, 'ET', 'ETHIOPIA', 'Ethiopia', 'ETH', 231, 251),
(69, 'FK', 'FALKLAND ISLANDS (MALVINAS)', 'Falkland Islands (Malvinas)', 'FLK', 238, 500),
(70, 'FO', 'FAROE ISLANDS', 'Faroe Islands', 'FRO', 234, 298),
(71, 'FJ', 'FIJI', 'Fiji', 'FJI', 242, 679),
(72, 'FI', 'FINLAND', 'Finland', 'FIN', 246, 358),
(73, 'FR', 'FRANCE', 'France', 'FRA', 250, 33),
(74, 'GF', 'FRENCH GUIANA', 'French Guiana', 'GUF', 254, 594),
(75, 'PF', 'FRENCH POLYNESIA', 'French Polynesia', 'PYF', 258, 689),
(76, 'TF', 'FRENCH SOUTHERN TERRITORIES', 'French Southern Territories', NULL, NULL, 0),
(77, 'GA', 'GABON', 'Gabon', 'GAB', 266, 241),
(78, 'GM', 'GAMBIA', 'Gambia', 'GMB', 270, 220),
(79, 'GE', 'GEORGIA', 'Georgia', 'GEO', 268, 995),
(80, 'DE', 'GERMANY', 'Germany', 'DEU', 276, 49),
(81, 'GH', 'GHANA', 'Ghana', 'GHA', 288, 233),
(82, 'GI', 'GIBRALTAR', 'Gibraltar', 'GIB', 292, 350),
(83, 'GR', 'GREECE', 'Greece', 'GRC', 300, 30),
(84, 'GL', 'GREENLAND', 'Greenland', 'GRL', 304, 299),
(85, 'GD', 'GRENADA', 'Grenada', 'GRD', 308, 1473),
(86, 'GP', 'GUADELOUPE', 'Guadeloupe', 'GLP', 312, 590),
(87, 'GU', 'GUAM', 'Guam', 'GUM', 316, 1671),
(88, 'GT', 'GUATEMALA', 'Guatemala', 'GTM', 320, 502),
(89, 'GN', 'GUINEA', 'Guinea', 'GIN', 324, 224),
(90, 'GW', 'GUINEA-BISSAU', 'Guinea-Bissau', 'GNB', 624, 245),
(91, 'GY', 'GUYANA', 'Guyana', 'GUY', 328, 592),
(92, 'HT', 'HAITI', 'Haiti', 'HTI', 332, 509),
(93, 'HM', 'HEARD ISLAND AND MCDONALD ISLANDS', 'Heard Island and Mcdonald Islands', NULL, NULL, 0),
(94, 'VA', 'HOLY SEE (VATICAN CITY STATE)', 'Holy See (Vatican City State)', 'VAT', 336, 39),
(95, 'HN', 'HONDURAS', 'Honduras', 'HND', 340, 504),
(96, 'HK', 'HONG KONG', 'Hong Kong', 'HKG', 344, 852),
(97, 'HU', 'HUNGARY', 'Hungary', 'HUN', 348, 36),
(98, 'IS', 'ICELAND', 'Iceland', 'ISL', 352, 354),
(99, 'IN', 'INDIA', 'India', 'IND', 356, 91),
(100, 'ID', 'INDONESIA', 'Indonesia', 'IDN', 360, 62),
(101, 'IR', 'IRAN, ISLAMIC REPUBLIC OF', 'Iran, Islamic Republic of', 'IRN', 364, 98),
(102, 'IQ', 'IRAQ', 'Iraq', 'IRQ', 368, 964),
(103, 'IE', 'IRELAND', 'Ireland', 'IRL', 372, 353),
(104, 'IL', 'ISRAEL', 'Israel', 'ISR', 376, 972),
(105, 'IT', 'ITALY', 'Italy', 'ITA', 380, 39),
(106, 'JM', 'JAMAICA', 'Jamaica', 'JAM', 388, 1876),
(107, 'JP', 'JAPAN', 'Japan', 'JPN', 392, 81),
(108, 'JO', 'JORDAN', 'Jordan', 'JOR', 400, 962),
(109, 'KZ', 'KAZAKHSTAN', 'Kazakhstan', 'KAZ', 398, 7),
(110, 'KE', 'KENYA', 'Kenya', 'KEN', 404, 254),
(111, 'KI', 'KIRIBATI', 'Kiribati', 'KIR', 296, 686),
(112, 'KP', 'KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF', 'Korea, Democratic People\'s Republic of', 'PRK', 408, 850),
(113, 'KR', 'KOREA, REPUBLIC OF', 'Korea, Republic of', 'KOR', 410, 82),
(114, 'KW', 'KUWAIT', 'Kuwait', 'KWT', 414, 965),
(115, 'KG', 'KYRGYZSTAN', 'Kyrgyzstan', 'KGZ', 417, 996),
(116, 'LA', 'LAO PEOPLE\'S DEMOCRATIC REPUBLIC', 'Lao People\'s Democratic Republic', 'LAO', 418, 856),
(117, 'LV', 'LATVIA', 'Latvia', 'LVA', 428, 371),
(118, 'LB', 'LEBANON', 'Lebanon', 'LBN', 422, 961),
(119, 'LS', 'LESOTHO', 'Lesotho', 'LSO', 426, 266),
(120, 'LR', 'LIBERIA', 'Liberia', 'LBR', 430, 231),
(121, 'LY', 'LIBYAN ARAB JAMAHIRIYA', 'Libyan Arab Jamahiriya', 'LBY', 434, 218),
(122, 'LI', 'LIECHTENSTEIN', 'Liechtenstein', 'LIE', 438, 423),
(123, 'LT', 'LITHUANIA', 'Lithuania', 'LTU', 440, 370),
(124, 'LU', 'LUXEMBOURG', 'Luxembourg', 'LUX', 442, 352),
(125, 'MO', 'MACAO', 'Macao', 'MAC', 446, 853),
(126, 'MK', 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', 'Macedonia, the Former Yugoslav Republic of', 'MKD', 807, 389),
(127, 'MG', 'MADAGASCAR', 'Madagascar', 'MDG', 450, 261),
(128, 'MW', 'MALAWI', 'Malawi', 'MWI', 454, 265),
(129, 'MY', 'MALAYSIA', 'Malaysia', 'MYS', 458, 60),
(130, 'MV', 'MALDIVES', 'Maldives', 'MDV', 462, 960),
(131, 'ML', 'MALI', 'Mali', 'MLI', 466, 223),
(132, 'MT', 'MALTA', 'Malta', 'MLT', 470, 356),
(133, 'MH', 'MARSHALL ISLANDS', 'Marshall Islands', 'MHL', 584, 692),
(134, 'MQ', 'MARTINIQUE', 'Martinique', 'MTQ', 474, 596),
(135, 'MR', 'MAURITANIA', 'Mauritania', 'MRT', 478, 222),
(136, 'MU', 'MAURITIUS', 'Mauritius', 'MUS', 480, 230),
(137, 'YT', 'MAYOTTE', 'Mayotte', NULL, NULL, 269),
(138, 'MX', 'MEXICO', 'Mexico', 'MEX', 484, 52),
(139, 'FM', 'MICRONESIA, FEDERATED STATES OF', 'Micronesia, Federated States of', 'FSM', 583, 691),
(140, 'MD', 'MOLDOVA, REPUBLIC OF', 'Moldova, Republic of', 'MDA', 498, 373),
(141, 'MC', 'MONACO', 'Monaco', 'MCO', 492, 377),
(142, 'MN', 'MONGOLIA', 'Mongolia', 'MNG', 496, 976),
(143, 'MS', 'MONTSERRAT', 'Montserrat', 'MSR', 500, 1664),
(144, 'MA', 'MOROCCO', 'Morocco', 'MAR', 504, 212),
(145, 'MZ', 'MOZAMBIQUE', 'Mozambique', 'MOZ', 508, 258),
(146, 'MM', 'MYANMAR', 'Myanmar', 'MMR', 104, 95),
(147, 'NA', 'NAMIBIA', 'Namibia', 'NAM', 516, 264),
(148, 'NR', 'NAURU', 'Nauru', 'NRU', 520, 674),
(149, 'NP', 'NEPAL', 'Nepal', 'NPL', 524, 977),
(150, 'NL', 'NETHERLANDS', 'Netherlands', 'NLD', 528, 31),
(151, 'AN', 'NETHERLANDS ANTILLES', 'Netherlands Antilles', 'ANT', 530, 599),
(152, 'NC', 'NEW CALEDONIA', 'New Caledonia', 'NCL', 540, 687),
(153, 'NZ', 'NEW ZEALAND', 'New Zealand', 'NZL', 554, 64),
(154, 'NI', 'NICARAGUA', 'Nicaragua', 'NIC', 558, 505),
(155, 'NE', 'NIGER', 'Niger', 'NER', 562, 227),
(156, 'NG', 'NIGERIA', 'Nigeria', 'NGA', 566, 234),
(157, 'NU', 'NIUE', 'Niue', 'NIU', 570, 683),
(158, 'NF', 'NORFOLK ISLAND', 'Norfolk Island', 'NFK', 574, 672),
(159, 'MP', 'NORTHERN MARIANA ISLANDS', 'Northern Mariana Islands', 'MNP', 580, 1670),
(160, 'NO', 'NORWAY', 'Norway', 'NOR', 578, 47),
(161, 'OM', 'OMAN', 'Oman', 'OMN', 512, 968),
(162, 'PK', 'PAKISTAN', 'Pakistan', 'PAK', 586, 92),
(163, 'PW', 'PALAU', 'Palau', 'PLW', 585, 680),
(164, 'PS', 'PALESTINIAN TERRITORY, OCCUPIED', 'Palestinian Territory, Occupied', NULL, NULL, 970),
(165, 'PA', 'PANAMA', 'Panama', 'PAN', 591, 507),
(166, 'PG', 'PAPUA NEW GUINEA', 'Papua New Guinea', 'PNG', 598, 675),
(167, 'PY', 'PARAGUAY', 'Paraguay', 'PRY', 600, 595),
(168, 'PE', 'PERU', 'Peru', 'PER', 604, 51),
(169, 'PH', 'PHILIPPINES', 'Philippines', 'PHL', 608, 63),
(170, 'PN', 'PITCAIRN', 'Pitcairn', 'PCN', 612, 0),
(171, 'PL', 'POLAND', 'Poland', 'POL', 616, 48),
(172, 'PT', 'PORTUGAL', 'Portugal', 'PRT', 620, 351),
(173, 'PR', 'PUERTO RICO', 'Puerto Rico', 'PRI', 630, 1787),
(174, 'QA', 'QATAR', 'Qatar', 'QAT', 634, 974),
(175, 'RE', 'REUNION', 'Reunion', 'REU', 638, 262),
(176, 'RO', 'ROMANIA', 'Romania', 'ROM', 642, 40),
(177, 'RU', 'RUSSIAN FEDERATION', 'Russian Federation', 'RUS', 643, 70),
(178, 'RW', 'RWANDA', 'Rwanda', 'RWA', 646, 250),
(179, 'SH', 'SAINT HELENA', 'Saint Helena', 'SHN', 654, 290),
(180, 'KN', 'SAINT KITTS AND NEVIS', 'Saint Kitts and Nevis', 'KNA', 659, 1869),
(181, 'LC', 'SAINT LUCIA', 'Saint Lucia', 'LCA', 662, 1758),
(182, 'PM', 'SAINT PIERRE AND MIQUELON', 'Saint Pierre and Miquelon', 'SPM', 666, 508),
(183, 'VC', 'SAINT VINCENT AND THE GRENADINES', 'Saint Vincent and the Grenadines', 'VCT', 670, 1784),
(184, 'WS', 'SAMOA', 'Samoa', 'WSM', 882, 684),
(185, 'SM', 'SAN MARINO', 'San Marino', 'SMR', 674, 378),
(186, 'ST', 'SAO TOME AND PRINCIPE', 'Sao Tome and Principe', 'STP', 678, 239),
(187, 'SA', 'SAUDI ARABIA', 'Saudi Arabia', 'SAU', 682, 966),
(188, 'SN', 'SENEGAL', 'Senegal', 'SEN', 686, 221),
(189, 'CS', 'SERBIA AND MONTENEGRO', 'Serbia and Montenegro', NULL, NULL, 381),
(190, 'SC', 'SEYCHELLES', 'Seychelles', 'SYC', 690, 248),
(191, 'SL', 'SIERRA LEONE', 'Sierra Leone', 'SLE', 694, 232),
(192, 'SG', 'SINGAPORE', 'Singapore', 'SGP', 702, 65),
(193, 'SK', 'SLOVAKIA', 'Slovakia', 'SVK', 703, 421),
(194, 'SI', 'SLOVENIA', 'Slovenia', 'SVN', 705, 386),
(195, 'SB', 'SOLOMON ISLANDS', 'Solomon Islands', 'SLB', 90, 677),
(196, 'SO', 'SOMALIA', 'Somalia', 'SOM', 706, 252),
(197, 'ZA', 'SOUTH AFRICA', 'South Africa', 'ZAF', 710, 27),
(198, 'GS', 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS', 'South Georgia and the South Sandwich Islands', NULL, NULL, 0),
(199, 'ES', 'SPAIN', 'Spain', 'ESP', 724, 34),
(200, 'LK', 'SRI LANKA', 'Sri Lanka', 'LKA', 144, 94),
(201, 'SD', 'SUDAN', 'Sudan', 'SDN', 736, 249),
(202, 'SR', 'SURINAME', 'Suriname', 'SUR', 740, 597),
(203, 'SJ', 'SVALBARD AND JAN MAYEN', 'Svalbard and Jan Mayen', 'SJM', 744, 47),
(204, 'SZ', 'SWAZILAND', 'Swaziland', 'SWZ', 748, 268),
(205, 'SE', 'SWEDEN', 'Sweden', 'SWE', 752, 46),
(206, 'CH', 'SWITZERLAND', 'Switzerland', 'CHE', 756, 41),
(207, 'SY', 'SYRIAN ARAB REPUBLIC', 'Syrian Arab Republic', 'SYR', 760, 963),
(208, 'TW', 'TAIWAN, PROVINCE OF CHINA', 'Taiwan, Province of China', 'TWN', 158, 886),
(209, 'TJ', 'TAJIKISTAN', 'Tajikistan', 'TJK', 762, 992),
(210, 'TZ', 'TANZANIA, UNITED REPUBLIC OF', 'Tanzania, United Republic of', 'TZA', 834, 255),
(211, 'TH', 'THAILAND', 'Thailand', 'THA', 764, 66),
(212, 'TL', 'TIMOR-LESTE', 'Timor-Leste', NULL, NULL, 670),
(213, 'TG', 'TOGO', 'Togo', 'TGO', 768, 228),
(214, 'TK', 'TOKELAU', 'Tokelau', 'TKL', 772, 690),
(215, 'TO', 'TONGA', 'Tonga', 'TON', 776, 676),
(216, 'TT', 'TRINIDAD AND TOBAGO', 'Trinidad and Tobago', 'TTO', 780, 1868),
(217, 'TN', 'TUNISIA', 'Tunisia', 'TUN', 788, 216),
(218, 'TR', 'TURKEY', 'Turkey', 'TUR', 792, 90),
(219, 'TM', 'TURKMENISTAN', 'Turkmenistan', 'TKM', 795, 7370),
(220, 'TC', 'TURKS AND CAICOS ISLANDS', 'Turks and Caicos Islands', 'TCA', 796, 1649),
(221, 'TV', 'TUVALU', 'Tuvalu', 'TUV', 798, 688),
(222, 'UG', 'UGANDA', 'Uganda', 'UGA', 800, 256),
(223, 'UA', 'UKRAINE', 'Ukraine', 'UKR', 804, 380),
(224, 'AE', 'UNITED ARAB EMIRATES', 'United Arab Emirates', 'ARE', 784, 971),
(225, 'GB', 'UNITED KINGDOM', 'United Kingdom', 'GBR', 826, 44),
(226, 'US', 'UNITED STATES', 'United States', 'USA', 840, 1),
(227, 'UM', 'UNITED STATES MINOR OUTLYING ISLANDS', 'United States Minor Outlying Islands', NULL, NULL, 1),
(228, 'UY', 'URUGUAY', 'Uruguay', 'URY', 858, 598),
(229, 'UZ', 'UZBEKISTAN', 'Uzbekistan', 'UZB', 860, 998),
(230, 'VU', 'VANUATU', 'Vanuatu', 'VUT', 548, 678),
(231, 'VE', 'VENEZUELA', 'Venezuela', 'VEN', 862, 58),
(232, 'VN', 'VIET NAM', 'Viet Nam', 'VNM', 704, 84),
(233, 'VG', 'VIRGIN ISLANDS, BRITISH', 'Virgin Islands, British', 'VGB', 92, 1284),
(234, 'VI', 'VIRGIN ISLANDS, U.S.', 'Virgin Islands, U.s.', 'VIR', 850, 1340),
(235, 'WF', 'WALLIS AND FUTUNA', 'Wallis and Futuna', 'WLF', 876, 681),
(236, 'EH', 'WESTERN SAHARA', 'Western Sahara', 'ESH', 732, 212),
(237, 'YE', 'YEMEN', 'Yemen', 'YEM', 887, 967),
(238, 'ZM', 'ZAMBIA', 'Zambia', 'ZMB', 894, 260),
(239, 'ZW', 'ZIMBABWE', 'Zimbabwe', 'ZWE', 716, 263);

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `symbol` varchar(255) DEFAULT NULL,
  `symbol_position` varchar(255) NOT NULL DEFAULT 'left',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `code`, `symbol`, `symbol_position`, `created_at`, `updated_at`) VALUES
(1, 'United State Dollar', 'USD', '$', 'left', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(2, 'Vanuatu Vatu', 'VUV', 'VT', 'right', '2022-12-15 09:02:33', '2022-12-15 09:02:33');

-- --------------------------------------------------------

--
-- Table structure for table `custom_fields`
--

CREATE TABLE `custom_fields` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `custom_field_group_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `type` enum('text','textarea','select','radio','file','url','number','date','checkbox','checkbox_multiple') NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT 0,
  `filterable` tinyint(1) NOT NULL DEFAULT 0,
  `listable` tinyint(1) NOT NULL DEFAULT 0,
  `icon` varchar(255) NOT NULL DEFAULT 'fas fa-cube',
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `custom_fields`
--

INSERT INTO `custom_fields` (`id`, `custom_field_group_id`, `name`, `slug`, `type`, `required`, `filterable`, `listable`, `icon`, `order`, `created_at`, `updated_at`) VALUES
(1, 1, 'Are you acting as an agent?', 'are-you-acting-as-an-agent', 'radio', 1, 1, 1, 'fas fa-male', 1, '2022-12-19 09:18:39', '2022-12-19 09:38:05'),
(2, 1, 'Property type', 'property-type', 'select', 1, 1, 1, 'fas fa-home', 19, '2022-12-19 09:37:44', '2022-12-21 12:25:17'),
(3, 1, 'No. of Bedrooms:', 'no-of-bedrooms', 'select', 1, 1, 1, 'fas fa-home', 3, '2022-12-19 09:40:58', '2022-12-19 09:40:58'),
(4, 1, 'Rent Period', 'rent-period', 'radio', 0, 1, 1, 'fas fa-home', 4, '2022-12-19 09:43:04', '2022-12-19 09:43:04'),
(5, 1, 'Date', 'date', 'date', 1, 1, 1, 'fas fa-calendar-times', 5, '2022-12-19 09:44:39', '2022-12-19 09:44:39'),
(6, 1, 'Website Link', 'website-link', 'text', 0, 1, 1, 'fas fa-volleyball-ball', 6, '2022-12-19 09:47:05', '2022-12-20 12:30:39'),
(7, 2, 'Seller Type', 'seller-type', 'radio', 1, 1, 1, 'fas fa-car', 7, '2022-12-19 09:56:30', '2022-12-19 09:56:30'),
(8, 2, 'Enter Registration Number', 'enter-registration-number', 'number', 1, 1, 1, 'fas fa-car-alt', 8, '2022-12-19 09:57:36', '2022-12-19 09:57:36'),
(9, 2, 'Website Link', 'website-link', 'text', 0, 1, 1, 'fas fa-car-alt', 9, '2022-12-19 09:58:34', '2022-12-21 05:52:24'),
(10, 2, 'Add YouTube Video Link', 'add-youtube-video-link', 'text', 0, 1, 1, 'fas fa-car-alt', 10, '2022-12-19 09:59:36', '2022-12-21 05:52:48'),
(11, 3, 'Role', 'role', 'select', 1, 1, 1, 'fas fa-briefcase', 11, '2022-12-19 10:28:21', '2022-12-19 10:28:21'),
(12, 3, 'Job Type', 'job-type', 'select', 1, 1, 1, 'fas fa-briefcase', 12, '2022-12-19 10:29:50', '2022-12-19 10:29:50'),
(13, 3, 'How do you want to receive applications?', 'how-do-you-want-to-receive-applications', 'checkbox_multiple', 1, 1, 1, 'fas fa-briefcase', 13, '2022-12-19 10:31:02', '2022-12-19 10:31:02'),
(14, 3, 'Required Work Experience (Years) *', 'required-work-experience-years', 'number', 1, 1, 1, 'fas fa-briefcase', 14, '2022-12-19 10:31:49', '2022-12-19 10:31:49'),
(15, 3, 'Required Education', 'required-education', 'select', 1, 1, 1, 'fas fa-briefcase', 15, '2022-12-19 10:33:41', '2022-12-19 10:33:41'),
(16, 3, 'Salary Per Month ( From)', 'salary-per-month-from', 'number', 1, 1, 1, 'fas fa-briefcase', 16, '2022-12-19 10:34:19', '2022-12-19 10:34:19'),
(17, 3, 'Salary Per Month ( To)', 'salary-per-month-to', 'number', 1, 1, 1, 'fas fa-briefcase', 17, '2022-12-19 10:34:50', '2022-12-19 10:34:50'),
(18, 3, 'Application Deadline', 'application-deadline', 'date', 1, 1, 1, 'fas fa-briefcase', 20, '2022-12-19 10:35:24', '2022-12-19 10:35:24'),
(19, 3, 'Employer Name', 'employer-name', 'text', 1, 1, 1, 'fas fa-briefcase', 18, '2022-12-19 10:35:54', '2022-12-19 10:35:54'),
(20, 3, 'Job Location', 'job-location', 'text', 0, 0, 0, 'fas fa-home', 2, '2022-12-21 04:26:28', '2022-12-21 04:26:28');

-- --------------------------------------------------------

--
-- Table structure for table `custom_field_groups`
--

CREATE TABLE `custom_field_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `custom_field_groups`
--

INSERT INTO `custom_field_groups` (`id`, `name`, `slug`, `order`, `created_at`, `updated_at`) VALUES
(1, 'real estate', 'real-estate', 0, '2022-12-19 09:16:23', '2022-12-19 09:16:23'),
(2, 'Cars', 'cars', 0, '2022-12-19 09:50:42', '2022-12-19 09:50:42'),
(3, 'Jobs', 'jobs', 0, '2022-12-19 10:05:44', '2022-12-19 10:05:44');

-- --------------------------------------------------------

--
-- Table structure for table `custom_field_values`
--

CREATE TABLE `custom_field_values` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `custom_field_id` bigint(20) UNSIGNED NOT NULL,
  `value` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `custom_field_values`
--

INSERT INTO `custom_field_values` (`id`, `custom_field_id`, `value`, `created_at`, `updated_at`) VALUES
(21, 1, 'Yes', '2022-12-19 09:38:05', '2022-12-19 09:38:05'),
(22, 1, 'No', '2022-12-19 09:38:05', '2022-12-19 09:38:05'),
(23, 3, '1', '2022-12-19 09:40:58', '2022-12-19 09:40:58'),
(24, 3, '2', '2022-12-19 09:40:58', '2022-12-19 09:40:58'),
(25, 3, '3', '2022-12-19 09:40:58', '2022-12-19 09:40:58'),
(26, 3, '4', '2022-12-19 09:40:58', '2022-12-19 09:40:58'),
(27, 3, '5', '2022-12-19 09:40:58', '2022-12-19 09:40:58'),
(28, 3, '6', '2022-12-19 09:40:58', '2022-12-19 09:40:58'),
(29, 3, '7', '2022-12-19 09:40:58', '2022-12-19 09:40:58'),
(30, 3, '8', '2022-12-19 09:40:58', '2022-12-19 09:40:58'),
(31, 3, '9', '2022-12-19 09:40:58', '2022-12-19 09:40:58'),
(32, 3, '10', '2022-12-19 09:40:58', '2022-12-19 09:40:58'),
(33, 3, '11', '2022-12-19 09:40:58', '2022-12-19 09:40:58'),
(34, 3, '12', '2022-12-19 09:40:58', '2022-12-19 09:40:58'),
(35, 4, 'Monthly', '2022-12-19 09:43:04', '2022-12-19 09:43:04'),
(36, 4, 'Weekly', '2022-12-19 09:43:04', '2022-12-19 09:43:04'),
(37, 7, 'Trade', '2022-12-19 09:56:30', '2022-12-19 09:56:30'),
(38, 7, 'Private', '2022-12-19 09:56:30', '2022-12-19 09:56:30'),
(39, 11, 'Account traine', '2022-12-19 10:28:21', '2022-12-19 10:28:21'),
(40, 11, 'Audit Officer', '2022-12-19 10:28:21', '2022-12-19 10:28:21'),
(41, 11, 'Cashier', '2022-12-19 10:28:21', '2022-12-19 10:28:21'),
(42, 11, 'Tax Officer', '2022-12-19 10:28:21', '2022-12-19 10:28:21'),
(43, 11, 'Message Therapist', '2022-12-19 10:28:21', '2022-12-19 10:28:21'),
(44, 11, 'Spa Therapist', '2022-12-19 10:28:21', '2022-12-19 10:28:21'),
(45, 11, 'Bakeer', '2022-12-19 10:28:21', '2022-12-19 10:28:21'),
(46, 11, 'Chef', '2022-12-19 10:28:21', '2022-12-19 10:28:21'),
(47, 11, 'Master Chef', '2022-12-19 10:28:21', '2022-12-19 10:28:21'),
(48, 12, 'Full Time', '2022-12-19 10:29:50', '2022-12-19 10:29:50'),
(49, 12, 'Half Time', '2022-12-19 10:29:50', '2022-12-19 10:29:50'),
(50, 12, 'Contructual', '2022-12-19 10:29:50', '2022-12-19 10:29:50'),
(51, 12, 'Internship', '2022-12-19 10:29:50', '2022-12-19 10:29:50'),
(52, 13, 'Email And Employer Dashboard', '2022-12-19 10:31:02', '2022-12-19 10:31:02'),
(53, 13, 'Phones (Up To 3)', '2022-12-19 10:31:02', '2022-12-19 10:31:02'),
(54, 15, 'Primary School', '2022-12-19 10:33:41', '2022-12-19 10:33:41'),
(55, 15, 'High School', '2022-12-19 10:33:41', '2022-12-19 10:33:41'),
(56, 15, 'SSC / O Level', '2022-12-19 10:33:41', '2022-12-19 10:33:41'),
(57, 15, 'HSC / A Level', '2022-12-19 10:33:41', '2022-12-19 10:33:41'),
(58, 15, 'Diploma', '2022-12-19 10:33:41', '2022-12-19 10:33:41'),
(59, 15, 'Honors/BSC', '2022-12-19 10:33:41', '2022-12-19 10:33:41'),
(60, 15, 'Masters/MSC', '2022-12-19 10:33:41', '2022-12-19 10:33:41'),
(61, 15, 'PHD', '2022-12-19 10:33:41', '2022-12-19 10:33:41'),
(62, 2, 'Office Space', '2022-12-21 12:25:18', '2022-12-21 12:25:18'),
(63, 2, 'Retail', '2022-12-21 12:25:18', '2022-12-21 12:25:18'),
(64, 2, 'Industrial', '2022-12-21 12:25:18', '2022-12-21 12:25:18'),
(65, 2, 'Desk Space', '2022-12-21 12:25:18', '2022-12-21 12:25:18'),
(66, 2, 'Development/Land', '2022-12-21 12:25:18', '2022-12-21 12:25:18'),
(67, 2, 'Leisure & Hospitality', '2022-12-21 12:25:18', '2022-12-21 12:25:18'),
(68, 2, 'Flat', '2022-12-21 12:25:18', '2022-12-21 12:25:18'),
(69, 2, 'House', '2022-12-21 12:25:18', '2022-12-21 12:25:18'),
(70, 2, 'Apartment', '2022-12-21 12:25:18', '2022-12-21 12:25:18'),
(71, 2, 'Boat', '2022-12-21 12:25:18', '2022-12-21 12:25:18'),
(72, 2, 'Bungalow', '2022-12-21 12:25:18', '2022-12-21 12:25:18'),
(73, 2, 'Farmhouse', '2022-12-21 12:25:18', '2022-12-21 12:25:18'),
(74, 2, 'Cottage', '2022-12-21 12:25:18', '2022-12-21 12:25:18'),
(75, 2, 'Home', '2022-12-21 12:25:18', '2022-12-21 12:25:18'),
(76, 2, 'Lodge', '2022-12-21 12:25:18', '2022-12-21 12:25:18'),
(77, 2, 'Vila', '2022-12-21 12:25:18', '2022-12-21 12:25:18'),
(78, 2, 'Parking Space', '2022-12-21 12:25:18', '2022-12-21 12:25:18'),
(79, 2, 'Garage', '2022-12-21 12:25:18', '2022-12-21 12:25:18');

-- --------------------------------------------------------

--
-- Table structure for table `database_backups`
--

CREATE TABLE `database_backups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `emails`
--

INSERT INTO `emails` (`id`, `email`, `created_at`, `updated_at`) VALUES
(1, 'fdsffdsf@gmail.com', '2022-11-29 04:03:13', '2022-11-29 04:03:13'),
(2, 'rony@gmail.com', '2022-12-21 13:43:32', '2022-12-21 13:43:32');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `details` longtext DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `timezone` varchar(255) DEFAULT NULL,
  `all_day_event_status` int(11) DEFAULT NULL COMMENT '1=Yes; 0=No;',
  `image` varchar(255) DEFAULT NULL,
  `category_id` varchar(255) DEFAULT NULL COMMENT 'json',
  `tag_id` varchar(255) DEFAULT NULL COMMENT 'json',
  `event_status` int(11) DEFAULT NULL COMMENT '1=Scheduled; 2=Canceled; 3=Postponed;',
  `event_status_reason` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '1=Active; 0=Inactive;',
  `venue_id` int(10) DEFAULT NULL,
  `organiser_id` varchar(255) DEFAULT NULL COMMENT 'json',
  `wheelchair` int(11) DEFAULT NULL COMMENT '1=Yes; 0=No;',
  `accessible` int(11) DEFAULT NULL COMMENT '1=Yes; 0=No;',
  `event_info_link` varchar(255) DEFAULT NULL,
  `cost` float(13,2) DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `user_id`, `title`, `details`, `start_date`, `start_time`, `end_time`, `end_date`, `timezone`, `all_day_event_status`, `image`, `category_id`, `tag_id`, `event_status`, `event_status_reason`, `status`, `venue_id`, `organiser_id`, `wheelchair`, `accessible`, `event_info_link`, `cost`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(2, 3, 'MRT Event', '<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available. Wikipedia<br></p>', '2022-12-22', '04:11:00', '04:13:00', '2022-12-31', 'UTC', NULL, NULL, '[\"8\",\"10\",\"11\"]', '[\"5\",\"7\"]', 2, 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the.', 0, 4, '[\"3\",\"4\"]', 1, 1, 'facebook.com', 105.50, '2022-12-28 04:22:48', NULL, 1, NULL),
(3, 3, 'New world', '<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available. Wikipedia</p><div><br></div>', '2022-12-21', '16:39:00', '04:40:00', '2023-12-08', 'Pacific/Tarawa', NULL, NULL, '[\"9\",\"11\"]', '[ \"6\",\"7\"]', 1, NULL, 0, 6, '[\"3\",\"4\"]', 1, 1, 'facebook.com', 105.50, '2022-12-28 04:40:03', NULL, 3, NULL),
(5, 3, 'Lorem ipsum is a placeholder', '<p>n publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.&nbsp;<a class=\"ruhjFe NJLBac fl\" href=\"https://en.wikipedia.org/wiki/Lorem_ipsum\" data-ved=\"2ahUKEwiU9JbSsJz8AhXlSWwGHQ_RADIQmhN6BAgsEAI\" ping=\"/url?sa=t&amp;source=web&amp;rct=j&amp;url=https://en.wikipedia.org/wiki/Lorem_ipsum&amp;ved=2ahUKEwiU9JbSsJz8AhXlSWwGHQ_RADIQmhN6BAgsEAI\" target=\"_blank\" rel=\"noopener\" style=\"-webkit-tap-highlight-color: rgba(255, 255, 255, 0.1); outline: 0px;\">Wikipedia</a><br></p>', '2022-12-23', NULL, NULL, '2023-12-08', 'Pacific/Funafuti', 1, NULL, '[\"9\",\"11\"]', '[\"6\",\"7\"]', 1, NULL, 0, 5, '[\"3\",\"4\"]', 1, 1, 'facebook.com', 105.50, '2022-12-28 07:19:00', NULL, 3, NULL),
(8, NULL, 'New Event form admin', '<p>This is organiser for all and must be used. and take brack for you.&nbsp;</p>', '2022-12-31', NULL, NULL, '2023-01-03', 'UTC', 1, 'media/events/images/events-63ad32a7e0221.jpg', 'null', 'null', 1, NULL, 1, NULL, '[\"5\"]', 1, 0, 'facebook.com', 0.00, '2022-12-29 00:24:39', '2022-12-29 00:25:56', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `event_categories`
--

CREATE TABLE `event_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT 0 COMMENT '1=active; 0=inactive;',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_categories`
--

INSERT INTO `event_categories` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(8, 'Art', 1, '2022-12-27 01:01:30', NULL),
(9, 'Business', 1, '2022-12-27 01:01:39', NULL),
(10, 'Civil', 1, '2022-12-27 01:01:46', NULL),
(11, 'Masud Rana', 1, '2022-12-27 01:51:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `event_organiser`
--

CREATE TABLE `event_organiser` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT current_timestamp(),
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(12) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT 0 COMMENT '1=active; 0=inactive;',
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_organiser`
--

INSERT INTO `event_organiser` (`id`, `name`, `email`, `phone`, `website`, `status`, `created_at`, `created_by`, `updated_at`) VALUES
(4, '12487', '12487@gmail.com', '0123654789', 'facebook.com', 1, '2022-12-27 01:03:54', 1, '2022-12-27 01:08:19'),
(5, 'New World', 'newworld@gmail.com', '01547859632', 'facebook.com', 1, '2022-12-27 01:08:12', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `event_tags`
--

CREATE TABLE `event_tags` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '1=active; 0=inactive;',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_tags`
--

INSERT INTO `event_tags` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(6, 'Anjac', 1, '2022-12-27 01:02:14', NULL),
(8, 'Sandbox New', 1, '2022-12-29 00:10:15', NULL),
(9, 'Old Category', 1, '2022-12-29 00:10:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `event_venues`
--

CREATE TABLE `event_venues` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `postal_code` varchar(10) DEFAULT NULL,
  `phone` varchar(12) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '1=active; 0=inactive;',
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_venues`
--

INSERT INTO `event_venues` (`id`, `name`, `address`, `city`, `country`, `state`, `postal_code`, `phone`, `website`, `status`, `created_at`, `created_by`, `updated_at`) VALUES
(4, '2581', 'Dhaka', '0147850', '1', 'New Dhille', '1478520', '1478523690', 'twitter.com', 1, '2022-12-27 01:53:37', 1, NULL),
(5, 'ANZ', '014785210', 'New Dhaka', '6', '01478523690', '1478', '01547896320', 'pixabay.com', 1, '2022-12-27 01:54:32', 1, '2022-12-29 00:06:46'),
(6, 'MRT Venue', 'Konabri,', 'Gazipur', '5', 'Kabul', '1452', '01478523690', 'facebook.com', 1, '2022-12-28 04:40:03', 3, '2022-12-29 00:06:54');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `faq_category_id` bigint(20) UNSIGNED NOT NULL,
  `question` text NOT NULL,
  `answer` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `faq_category_id`, `question`, `answer`, `created_at`, `updated_at`) VALUES
(1, 1, 'What is Lorem Ipsum?', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2022-11-30 05:09:08', '2022-11-30 05:09:08');

-- --------------------------------------------------------

--
-- Table structure for table `faq_categories`
--

CREATE TABLE `faq_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faq_categories`
--

INSERT INTO `faq_categories` (`id`, `name`, `slug`, `icon`, `order`, `created_at`, `updated_at`) VALUES
(1, 'Basic', 'basic', 'fas fa-database', 0, '2022-11-30 05:08:36', '2022-11-30 05:08:36'),
(2, 'Lorem', 'lorem', 'fas fa-battery-empty', 0, '2022-11-30 05:14:08', '2022-11-30 05:14:08');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `direction` varchar(3) NOT NULL DEFAULT 'ltr',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `code`, `icon`, `direction`, `created_at`, `updated_at`) VALUES
(1, 'English', 'en', 'flag-icon-gb', 'ltr', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(2, 'Chinese', 'zh', 'flag-icon-cn', 'ltr', '2022-12-20 09:15:21', '2022-12-21 09:46:38'),
(3, 'French', 'fr', 'flag-icon-fr', 'ltr', '2022-12-20 12:47:11', '2022-12-20 12:47:11'),
(4, 'Bislama', 'bi', 'flag-icon-vu', 'ltr', '2022-12-22 07:37:24', '2022-12-22 07:37:24');

-- --------------------------------------------------------

--
-- Table structure for table `messengers`
--

CREATE TABLE `messengers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from_id` bigint(20) UNSIGNED NOT NULL,
  `to_id` bigint(20) UNSIGNED NOT NULL,
  `body` text NOT NULL,
  `read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messengers`
--

INSERT INTO `messengers` (`id`, `from_id`, `to_id`, `body`, `read`, `created_at`, `updated_at`) VALUES
(1, 7, 1, '.', 0, '2022-12-14 09:45:58', '2022-12-14 09:45:58'),
(2, 7, 1, 'Hello', 0, '2022-12-14 09:46:06', '2022-12-14 09:46:06'),
(3, 7, 1, 'hi', 0, '2022-12-14 09:46:27', '2022-12-14 09:46:27'),
(4, 7, 1, 'hello', 0, '2022-12-14 09:46:54', '2022-12-14 09:46:54'),
(5, 7, 1, 'hello', 0, '2022-12-14 09:47:18', '2022-12-14 09:47:18'),
(6, 7, 1, 'hello', 0, '2022-12-14 09:49:32', '2022-12-14 09:49:32'),
(7, 7, 1, 'Nice', 0, '2022-12-14 11:56:10', '2022-12-14 11:56:10'),
(8, 10, 8, '.', 0, '2022-12-14 20:46:54', '2022-12-14 20:46:54'),
(9, 5, 8, '.', 0, '2022-12-19 05:47:29', '2022-12-19 05:47:29'),
(10, 5, 8, 'hlw vai', 1, '2022-12-19 05:47:37', '2022-12-20 11:20:16');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2012_07_14_154223_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_11_12_184107_create_permission_tables', 1),
(5, '2020_12_20_161857_create_brands_table', 1),
(6, '2020_12_23_122556_create_contacts_table', 1),
(7, '2021_02_17_110211_create_testimonials_table', 1),
(8, '2021_02_18_112239_create_admins_table', 1),
(9, '2021_08_22_051131_create_categories_table', 1),
(10, '2021_08_22_051134_create_sub_categories_table', 1),
(11, '2021_08_22_051135_create_ads_table', 1),
(12, '2021_08_22_051198_create_post_categories_table', 1),
(13, '2021_08_22_051199_create_posts_table', 1),
(14, '2021_08_23_115402_create_settings_table', 1),
(15, '2021_08_25_061331_create_languages_table', 1),
(16, '2021_09_04_105120_create_blog_comments_table', 1),
(17, '2021_09_05_120235_create_ad_features_table', 1),
(18, '2021_09_05_120248_create_ad_galleries_table', 1),
(19, '2021_09_19_141812_create_plans_table', 1),
(20, '2021_11_13_114825_create_messengers_table', 1),
(21, '2021_11_15_112417_create_user_plans_table', 1),
(22, '2021_11_15_112949_create_transactions_table', 1),
(23, '2021_12_14_142236_create_emails_table', 1),
(24, '2021_12_15_161624_create_module_settings_table', 1),
(25, '2021_12_19_101413_create_cms_table', 1),
(26, '2021_12_19_152529_create_faq_categories_table', 1),
(27, '2021_12_21_105713_create_faqs_table', 1),
(28, '2022_01_25_131111_add_fields_to_settings_table', 1),
(29, '2022_01_26_091457_add_social_login_fields_to_users_table', 1),
(30, '2022_02_16_152704_add_loader_fields_to_settings_table', 1),
(31, '2022_03_05_125615_create_currencies_table', 1),
(32, '2022_03_08_110749_add_website_configuration_to_settings_table', 1),
(33, '2022_03_27_175435_create_orders_table', 1),
(34, '2022_03_28_093629_add_socialite_column_to_users_table', 1),
(35, '2022_03_29_100616_create_timezones_table', 1),
(36, '2022_03_29_121851_create_admin_searches_table', 1),
(37, '2022_03_30_082959_create_cookies_table', 1),
(38, '2022_03_30_114924_create_seos_table', 1),
(39, '2022_03_30_121200_create_database_backups_table', 1),
(40, '2022_04_25_132657_create_setup_guides_table', 1),
(41, '2022_04_28_134721_create_mobile_app_configs_table', 1),
(42, '2022_04_28_142433_create_mobile_app_sliders_table', 1),
(43, '2022_06_06_041744_add_field_to_users_table', 1),
(44, '2022_06_06_052533_create_notifications_table', 1),
(45, '2022_06_06_092421_create_themes_table', 1),
(46, '2022_06_08_053638_create_custom_field_groups_table', 1),
(47, '2022_06_08_060821_create_custom_fields_table', 1),
(48, '2022_06_08_061216_create_custom_field_values_table', 1),
(49, '2022_06_08_061928_create_category_custom_field_table', 1),
(50, '2022_06_08_091126_create_product_custom_fields_table', 1),
(51, '2022_06_14_051918_add_fields_to_user_plans_table', 1),
(52, '2022_06_14_095728_add_fields_to_plans_table', 1),
(53, '2022_06_18_031525_add_full_address_to_ads_table', 1),
(54, '2022_06_27_050337_add_map_to_settings_table', 1),
(55, '2022_07_03_030110_add_whatsapp_field_to_ads_table', 1),
(56, '2022_07_04_042533_create_jobs_table', 1),
(57, '2022_07_05_081552_create_reports_table', 1),
(58, '2022_07_05_112407_create_social_media_table', 1),
(59, '2022_07_14_151623_create_wishlists_table', 1),
(60, '2022_07_14_155901_create_reviews_table', 1),
(61, '2022_07_24_110337_create_user_device_token_tbale', 1),
(62, '2022_07_25_024244_add_push_notification_settings_table', 1),
(63, '2022_08_20_041304_add_social_fields_to_settings_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mobile_app_configs`
--

CREATE TABLE `mobile_app_configs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `android_download_url` varchar(255) DEFAULT NULL,
  `ios_download_url` varchar(255) DEFAULT NULL,
  `privacy_url` varchar(255) DEFAULT NULL,
  `support_url` varchar(255) DEFAULT NULL,
  `terms_and_condition_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mobile_app_configs`
--

INSERT INTO `mobile_app_configs` (`id`, `android_download_url`, `ios_download_url`, `privacy_url`, `support_url`, `terms_and_condition_url`, `created_at`, `updated_at`) VALUES
(1, 'http://127.0.0.1:8000/', 'http://127.0.0.1:8000/', 'https://www.appname.com/privacy-policy', 'https://www.appname.com/support', 'https://www.appname.com/terms-and-conditions', '2022-08-19 23:31:12', '2022-11-30 05:56:06');

-- --------------------------------------------------------

--
-- Table structure for table `mobile_app_sliders`
--

CREATE TABLE `mobile_app_sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `background` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\Admin', 1),
(1, 'App\\Models\\Admin', 2);

-- --------------------------------------------------------

--
-- Table structure for table `module_settings`
--

CREATE TABLE `module_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog` tinyint(1) NOT NULL DEFAULT 1,
  `newsletter` tinyint(1) NOT NULL DEFAULT 1,
  `language` tinyint(1) NOT NULL DEFAULT 1,
  `contact` tinyint(1) NOT NULL DEFAULT 1,
  `faq` tinyint(1) NOT NULL DEFAULT 1,
  `testimonial` tinyint(1) NOT NULL DEFAULT 1,
  `price_plan` tinyint(1) NOT NULL DEFAULT 1,
  `appearance` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `module_settings`
--

INSERT INTO `module_settings` (`id`, `blog`, `newsletter`, `language`, `contact`, `faq`, `testimonial`, `price_plan`, `appearance`) VALUES
(1, 0, 1, 1, 1, 1, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('00e6d825-6aac-4d23-9134-f6a23e3b4294', 'App\\Notifications\\LogoutNotification', 'App\\Models\\User', 7, '{\"msg\":\"You\'re loggedout successfully\",\"type\":\"loggedout\"}', NULL, '2022-12-15 10:46:19', '2022-12-15 10:46:19'),
('05e130f3-b96b-481d-9c1b-2815a8c98411', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 7, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-15 10:55:12', '2022-12-15 10:55:12'),
('07ca91ae-f840-4578-ae0c-bdb6023b6f0c', 'App\\Notifications\\LogoutNotification', 'App\\Models\\User', 1, '{\"msg\":\"You\'re loggedout successfully\",\"type\":\"loggedout\"}', NULL, '2022-12-13 14:38:04', '2022-12-13 14:38:04'),
('0bf9c027-51b4-4a4e-bf45-d598795d14df', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 7, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-15 10:46:38', '2022-12-15 10:46:38'),
('0c42afd0-f5dd-4b32-8a43-e1f2a277a868', 'App\\Notifications\\LogoutNotification', 'App\\Models\\User', 3, '{\"msg\":\"You\'re loggedout successfully\",\"type\":\"loggedout\"}', NULL, '2022-12-14 09:07:06', '2022-12-14 09:07:06'),
('0c818074-b7d6-4612-b6f6-65a02038d804', 'App\\Notifications\\AdCreateNotification', 'App\\Models\\User', 10, '{\"msg\":\"You\'re just created a ad\",\"type\":\"adcreate\",\"url\":\"https:\\/\\/dev.everisamting.com\\/ad\\/details\\/yes\"}', NULL, '2022-12-22 06:34:50', '2022-12-22 06:34:50'),
('109f074a-fe3d-420e-8900-ae14f7f21f2f', 'App\\Notifications\\AdCreateNotification', 'App\\Models\\User', 4, '{\"msg\":\"You\'re just created a ad\",\"type\":\"adcreate\",\"url\":\"http:\\/\\/localhost:8000\\/ad\\/details\\/new-phone\"}', NULL, '2022-12-08 04:09:13', '2022-12-08 04:09:13'),
('12086e43-6957-4820-9431-49f56e0e1c0e', 'App\\Notifications\\LogoutNotification', 'App\\Models\\User', 5, '{\"msg\":\"You\'re loggedout successfully\",\"type\":\"loggedout\"}', NULL, '2022-12-19 07:23:19', '2022-12-19 07:23:19'),
('130b79ac-a1e5-4cf1-a19e-db1b95a27cd3', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 7, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-19 10:36:26', '2022-12-19 10:36:26'),
('132567a6-2862-45b2-82a6-80257b2bc882', 'App\\Notifications\\LogoutNotification', 'App\\Models\\User', 7, '{\"msg\":\"You\'re loggedout successfully\",\"type\":\"loggedout\"}', NULL, '2022-12-21 13:45:31', '2022-12-21 13:45:31'),
('150a4f48-384f-448d-8e58-81716017562d', 'App\\Notifications\\LogoutNotification', 'App\\Models\\User', 5, '{\"msg\":\"You\'re loggedout successfully\",\"type\":\"loggedout\"}', NULL, '2022-12-23 23:16:35', '2022-12-23 23:16:35'),
('18279ca4-a487-4e73-9cc5-c62bf7a638f4', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 8, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-15 04:44:20', '2022-12-15 04:44:20'),
('1a89c3b3-8853-40cf-abd1-04576d189b37', 'App\\Notifications\\AdCreateNotification', 'App\\Models\\User', 8, '{\"msg\":\"You\'re just created a ad\",\"type\":\"adcreate\",\"url\":\"https:\\/\\/dev.everisamting.com\\/ad\\/details\\/formalin-cleaning-device\"}', NULL, '2022-12-14 13:57:34', '2022-12-14 13:57:34'),
('1be5c66f-7a78-4729-92e4-4e62a606f017', 'App\\Notifications\\AdApprovedNotification', 'App\\Models\\User', 8, '{\"msg\":\"Ad Approved\",\"type\":\"adapproved\",\"url\":\"https:\\/\\/dev.everisamting.com\\/ad\\/details\\/vertical-disinfection-cabinet\"}', NULL, '2022-12-14 13:57:58', '2022-12-14 13:57:58'),
('1c3bb2de-976a-4a68-8356-f826933c7202', 'App\\Notifications\\AdApprovedNotification', 'App\\Models\\User', 4, '{\"msg\":\"Ad Approved\",\"type\":\"adapproved\",\"url\":\"http:\\/\\/localhost:8000\\/ad\\/details\\/old-phone-for-users\"}', NULL, '2022-12-08 03:57:17', '2022-12-08 03:57:17'),
('1dfb87a4-0cad-456c-a1cd-5a98746fbcac', 'App\\Notifications\\LogoutNotification', 'App\\Models\\User', 3, '{\"msg\":\"You\'re loggedout successfully\",\"type\":\"loggedout\"}', NULL, '2022-12-08 03:35:02', '2022-12-08 03:35:02'),
('1e318b5a-7a93-4dfa-a6d8-ab68477e5288', 'App\\Notifications\\LogoutNotification', 'App\\Models\\User', 7, '{\"msg\":\"You\'re loggedout successfully\",\"type\":\"loggedout\"}', NULL, '2022-12-15 10:43:25', '2022-12-15 10:43:25'),
('2149782a-20ce-40ae-992b-bc0bf254913c', 'App\\Notifications\\AdApprovedNotification', 'App\\Models\\User', 1, '{\"msg\":\"Ad Approved\",\"type\":\"adapproved\",\"url\":\"https:\\/\\/dev.everisamting.com\\/ad\\/details\\/toshiba-e-studio2309a2809a-printer-copy-express\"}', NULL, '2022-12-21 12:28:57', '2022-12-21 12:28:57'),
('214e7447-e00b-4322-b631-45009296aaca', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 11, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-20 05:06:36', '2022-12-20 05:06:36'),
('2172fcbe-aa9e-4d4a-aeda-dcaf7c845a7d', 'App\\Notifications\\AdApprovedNotification', 'App\\Models\\User', 4, '{\"msg\":\"Ad Approved\",\"type\":\"adapproved\",\"url\":\"http:\\/\\/localhost:8000\\/ad\\/details\\/best-home-made-things\"}', NULL, '2022-12-08 04:09:35', '2022-12-08 04:09:35'),
('22ae9487-ad06-4761-9adf-8a3a483c5d24', 'App\\Notifications\\AdCreateNotification', 'App\\Models\\User', 4, '{\"msg\":\"You\'re just created a ad\",\"type\":\"adcreate\",\"url\":\"http:\\/\\/localhost:8000\\/ad\\/details\\/new-phone\"}', NULL, '2022-12-08 03:57:41', '2022-12-08 03:57:41'),
('2440f22d-aa54-4e73-bab8-c6da85b04057', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 1, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-22 04:43:43', '2022-12-22 04:43:43'),
('26710ed0-9a28-4a74-83df-80e002eb799b', 'App\\Notifications\\AdApprovedNotification', 'App\\Models\\User', 8, '{\"msg\":\"Ad Approved\",\"type\":\"adapproved\",\"url\":\"https:\\/\\/dev.everisamting.com\\/ad\\/details\\/electronics-products-for-sale-in-bangladesh-28\"}', NULL, '2022-12-14 13:58:38', '2022-12-14 13:58:38'),
('275413d5-1188-47ac-b867-33bb0f0ceac6', 'App\\Notifications\\AdCreateNotification', 'App\\Models\\User', 8, '{\"msg\":\"You\'re just created a ad\",\"type\":\"adcreate\",\"url\":\"https:\\/\\/dev.everisamting.com\\/ad\\/details\\/vertical-disinfection-cabinet\"}', NULL, '2022-12-14 13:57:58', '2022-12-14 13:57:58'),
('292f65b3-f810-4ba6-b4e3-4d24391fd1b3', 'App\\Notifications\\LogoutNotification', 'App\\Models\\User', 5, '{\"msg\":\"You\'re loggedout successfully\",\"type\":\"loggedout\"}', NULL, '2022-12-08 03:53:26', '2022-12-08 03:53:26'),
('2a88d46e-1732-48f3-8754-edf1341d1612', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 3, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-28 03:41:04', '2022-12-28 03:41:04'),
('2c621922-2c0c-4b9c-84ac-a2673afc1c7c', 'App\\Notifications\\AdCreateNotification', 'App\\Models\\User', 7, '{\"msg\":\"You\'re just created a ad\",\"type\":\"adcreate\",\"url\":\"https:\\/\\/dev.everisamting.com\\/ad\\/details\\/corei5-6th-gen-intel-gaming8gb-ddr4\"}', NULL, '2022-12-14 13:58:45', '2022-12-14 13:58:45'),
('2cafa0ae-27f9-490e-af76-56b700a095af', 'App\\Notifications\\LogoutNotification', 'App\\Models\\User', 4, '{\"msg\":\"You\'re loggedout successfully\",\"type\":\"loggedout\"}', NULL, '2022-12-08 03:44:37', '2022-12-08 03:44:37'),
('3287337c-3ca9-4243-88b7-4ac22bb56e78', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 10, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-22 04:12:38', '2022-12-22 04:12:38'),
('341fcb6a-10f0-4f82-ada9-29ae8dae0c5c', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 10, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-15 05:41:24', '2022-12-15 05:41:24'),
('39495dbe-7f30-4d98-9d5b-7d3cd8f3f875', 'App\\Notifications\\AdApprovedNotification', 'App\\Models\\User', 3, '{\"msg\":\"Ad Approved\",\"type\":\"adapproved\",\"url\":\"http:\\/\\/localhost:8000\\/ad\\/details\\/laravel-developer\"}', NULL, '2022-12-08 03:59:13', '2022-12-08 03:59:13'),
('3aa32813-e1dc-4fab-af97-3f9f222211b5', 'App\\Notifications\\AdApprovedNotification', 'App\\Models\\User', 7, '{\"msg\":\"Ad Approved\",\"type\":\"adapproved\",\"url\":\"https:\\/\\/dev.everisamting.com\\/ad\\/details\\/asus-rog-strix-rtx-3060-oc-edition-v2-12gb\"}', NULL, '2022-12-14 13:57:28', '2022-12-14 13:57:28'),
('3d2d74f5-9c59-4f24-bb30-9d44fd50e78e', 'App\\Notifications\\AdCreateNotification', 'App\\Models\\User', 1, '{\"msg\":\"You\'re just created a ad\",\"type\":\"adcreate\",\"url\":\"https:\\/\\/dev.everisamting.com\\/ad\\/details\\/toshiba-e-studio2309a2809a-printer-copy-express\"}', NULL, '2022-12-21 12:28:57', '2022-12-21 12:28:57'),
('3d50d4c0-6525-495d-aa8a-c516c28592ea', 'App\\Notifications\\AdCreateNotification', 'App\\Models\\User', 7, '{\"msg\":\"You\'re just created a ad\",\"type\":\"adcreate\",\"url\":\"https:\\/\\/dev.everisamting.com\\/ad\\/details\\/xiaomi-redmi-note-10\"}', NULL, '2022-12-14 09:36:28', '2022-12-14 09:36:28'),
('3d658a54-957a-49dd-8ca4-0528fe2d49ce', 'App\\Notifications\\LogoutNotification', 'App\\Models\\User', 10, '{\"msg\":\"You\'re loggedout successfully\",\"type\":\"loggedout\"}', NULL, '2022-12-22 04:42:43', '2022-12-22 04:42:43'),
('415aea06-9262-410d-b7a4-eeeff7b18c33', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 3, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-24 04:02:25', '2022-12-24 04:02:25'),
('41c27535-7d93-4bce-b351-f4b8f0d31517', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 7, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-19 06:14:40', '2022-12-19 06:14:40'),
('43c359c8-504f-432a-8dea-347901c41ee0', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 11, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-21 05:43:25', '2022-12-21 05:43:25'),
('4400fbbb-2e9f-4405-910c-22ed84a9d560', 'App\\Notifications\\AdApprovedNotification', 'App\\Models\\User', 7, '{\"msg\":\"Ad Approved\",\"type\":\"adapproved\",\"url\":\"https:\\/\\/dev.everisamting.com\\/ad\\/details\\/asus-rog-strix-rtx-37\"}', NULL, '2022-12-15 10:38:53', '2022-12-15 10:38:53'),
('4690329c-34a2-450a-a9a2-49888f8ea147', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 8, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-20 11:17:34', '2022-12-20 11:17:34'),
('4744ef28-315f-455a-be86-b1d93bbf758a', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 1, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-22 04:47:32', '2022-12-22 04:47:32'),
('4b60c4e0-fce7-466d-9a5d-65f11b886ffd', 'App\\Notifications\\AdApprovedNotification', 'App\\Models\\User', 7, '{\"msg\":\"Ad Approved\",\"type\":\"adapproved\",\"url\":\"https:\\/\\/dev.everisamting.com\\/ad\\/details\\/toyota-premio-2012\"}', NULL, '2022-12-21 13:38:54', '2022-12-21 13:38:54'),
('4c64a2f4-5140-473a-bce1-dc69c675ab44', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 3, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-23 23:16:45', '2022-12-23 23:16:45'),
('4ce1fb06-6e2e-438f-a4c8-c3ec2290b1e0', 'App\\Notifications\\AdCreateNotification', 'App\\Models\\User', 7, '{\"msg\":\"You\'re just created a ad\",\"type\":\"adcreate\",\"url\":\"http:\\/\\/localhost:8000\\/ad\\/details\\/oppo-f1s-ram-4-gbrom-32-gb\"}', NULL, '2022-12-11 05:59:35', '2022-12-11 05:59:35'),
('4cf45b78-7f72-46d6-bf5e-2a06103f2583', 'App\\Notifications\\AdWishlistNotification', 'App\\Models\\User', 5, '{\"msg\":\"Added a ad to favourite list\",\"type\":\"added_to_favourite\",\"url\":\"https:\\/\\/dev.everisamting.com\\/ad\\/details\\/vertical-disinfection-cabinet\"}', NULL, '2022-12-19 05:44:28', '2022-12-19 05:44:28'),
('5737b236-1591-4200-9a01-ebb76424c16d', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 1, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-13 13:15:23', '2022-12-13 13:15:23'),
('594caa68-8451-41e1-9451-0b812cd31545', 'App\\Notifications\\LogoutNotification', 'App\\Models\\User', 4, '{\"msg\":\"You\'re loggedout successfully\",\"type\":\"loggedout\"}', NULL, '2022-12-27 03:36:05', '2022-12-27 03:36:05'),
('59728691-30bd-4873-9e61-cd0ffcd71efe', 'App\\Notifications\\LogoutNotification', 'App\\Models\\User', 7, '{\"msg\":\"You\'re loggedout successfully\",\"type\":\"loggedout\"}', NULL, '2022-12-21 05:34:19', '2022-12-21 05:34:19'),
('5992bc6c-bb75-44aa-988f-ff13c07d75cf', 'App\\Notifications\\LogoutNotification', 'App\\Models\\User', 7, '{\"msg\":\"You\'re loggedout successfully\",\"type\":\"loggedout\"}', NULL, '2022-12-15 10:51:10', '2022-12-15 10:51:10'),
('5a4fbb05-7afb-4542-81b5-318ca48df8db', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 7, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-14 09:32:47', '2022-12-14 09:32:47'),
('5b3ea563-e3cc-4b5a-b954-baa66b922e93', 'App\\Notifications\\AdApprovedNotification', 'App\\Models\\User', 7, '{\"msg\":\"Ad Approved\",\"type\":\"adapproved\",\"url\":\"https:\\/\\/dev.everisamting.com\\/ad\\/details\\/corei5-6th-gen-intel-gaming8gb-ddr4-ram22\"}', NULL, '2022-12-14 13:58:33', '2022-12-14 13:58:33'),
('5bbdfa5d-5110-45c7-ac49-45fedcc53d83', 'App\\Notifications\\AdApprovedNotification', 'App\\Models\\User', 7, '{\"msg\":\"Ad Approved\",\"type\":\"adapproved\",\"url\":\"https:\\/\\/dev.everisamting.com\\/ad\\/details\\/corei5-6th-gen-intel-gaming8gb-ddr4-27\"}', NULL, '2022-12-14 12:02:19', '2022-12-14 12:02:19'),
('5bdaa43a-3dac-49f6-8e7e-3cfc72c1c794', 'App\\Notifications\\AdCreateNotification', 'App\\Models\\User', 7, '{\"msg\":\"You\'re just created a ad\",\"type\":\"adcreate\",\"url\":\"https:\\/\\/dev.everisamting.com\\/ad\\/details\\/asus-rog-strix-rtx-37\"}', NULL, '2022-12-15 10:38:54', '2022-12-15 10:38:54'),
('5c075fad-59f7-44bf-a290-2b1f3b1abc4a', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 3, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-28 06:59:47', '2022-12-28 06:59:47'),
('6350b3e8-f870-4b26-8f4c-4d2efae7d397', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 5, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-19 10:36:54', '2022-12-19 10:36:54'),
('6594ffca-3ca0-48d5-a4d9-6be677056fda', 'App\\Notifications\\LogoutNotification', 'App\\Models\\User', 5, '{\"msg\":\"You\'re loggedout successfully\",\"type\":\"loggedout\"}', NULL, '2022-12-27 05:03:57', '2022-12-27 05:03:57'),
('663afe1e-5ec1-4e04-a4f2-976d05a637f2', 'App\\Notifications\\LogoutNotification', 'App\\Models\\User', 1, '{\"msg\":\"You\'re loggedout successfully\",\"type\":\"loggedout\"}', NULL, '2022-12-21 05:38:31', '2022-12-21 05:38:31'),
('6641ee73-2b1e-446a-aac9-0d5a1226c2e3', 'App\\Notifications\\AdCreateNotification', 'App\\Models\\User', 8, '{\"msg\":\"You\'re just created a ad\",\"type\":\"adcreate\",\"url\":\"https:\\/\\/dev.everisamting.com\\/ad\\/details\\/electronics-products-for-sale-in-bangladesh-28\"}', NULL, '2022-12-14 13:58:39', '2022-12-14 13:58:39'),
('6650b1e3-9108-4383-a201-f384b0e505f8', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 2, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-13 09:34:57', '2022-12-13 09:34:57'),
('66ec0c27-c1ab-4331-81ac-1b7cae8d2cb7', 'App\\Notifications\\LogoutNotification', 'App\\Models\\User', 3, '{\"msg\":\"You\'re loggedout successfully\",\"type\":\"loggedout\"}', NULL, '2022-12-28 07:20:28', '2022-12-28 07:20:28'),
('6704734b-0d82-4619-b5aa-027c0edc2a3c', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 4, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-14 09:10:27', '2022-12-14 09:10:27'),
('6af7dff3-c8d7-4709-906c-0ffb25623f4d', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 7, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-15 13:08:35', '2022-12-15 13:08:35'),
('6d8abc83-0a1c-4ed7-87e4-78b5b20e8fdd', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 7, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-15 10:43:55', '2022-12-15 10:43:55'),
('7103e3c4-9022-4040-a614-4736762856d0', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 7, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-21 13:32:33', '2022-12-21 13:32:33'),
('7134b2a3-44f5-43ea-bc68-f0269f4f21e2', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 3, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-24 00:03:21', '2022-12-24 00:03:21'),
('7304ed88-9849-4759-ba2f-e83939e21a7d', 'App\\Notifications\\AdCreateNotification', 'App\\Models\\User', 4, '{\"msg\":\"You\'re just created a ad\",\"type\":\"adcreate\",\"url\":\"http:\\/\\/localhost:8000\\/ad\\/details\\/old-phone-for-users\"}', NULL, '2022-12-08 03:57:23', '2022-12-08 03:57:23'),
('743aaf75-1816-4033-bf85-b8f839efea4c', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 5, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-27 03:37:39', '2022-12-27 03:37:39'),
('7667cad0-306d-4fec-9c6f-195d5f5e6f7e', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 3, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-10 05:02:47', '2022-12-10 05:02:47'),
('767e8e3d-a9ef-441c-ace0-0307fca9260f', 'App\\Notifications\\AdApprovedNotification', 'App\\Models\\User', 3, '{\"msg\":\"Ad Approved\",\"type\":\"adapproved\",\"url\":\"http:\\/\\/localhost:8000\\/ad\\/details\\/arobil-need-account-manegar\"}', NULL, '2022-12-08 03:58:37', '2022-12-08 03:58:37'),
('783843ea-b503-40b0-b085-4f6e5a876b55', 'App\\Notifications\\MembershipUpgradeNotification', 'App\\Models\\User', 7, '{\"msg\":\"Upgrade to Premium plan\",\"type\":\"plan_upgrade\"}', NULL, '2022-12-14 09:39:53', '2022-12-14 09:39:53'),
('79fade5b-8a4e-4940-8edd-8bdc7adb53d3', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 3, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-28 04:50:58', '2022-12-28 04:50:58'),
('7a3161ed-e631-4566-80be-fafa8b925d1d', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 3, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-25 23:56:31', '2022-12-25 23:56:31'),
('7a69bfb3-d3a0-4d63-946a-fe449a5622da', 'App\\Notifications\\LogoutNotification', 'App\\Models\\User', 3, '{\"msg\":\"You\'re loggedout successfully\",\"type\":\"loggedout\"}', NULL, '2022-12-28 04:49:06', '2022-12-28 04:49:06'),
('7ef7ebc6-2ab6-4c4d-8bc1-179c5bcbc930', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 7, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-21 13:41:55', '2022-12-21 13:41:55'),
('80de1692-b922-4722-b2cb-988bfd3f49c4', 'App\\Notifications\\LogoutNotification', 'App\\Models\\User', 4, '{\"msg\":\"You\'re loggedout successfully\",\"type\":\"loggedout\"}', NULL, '2022-12-14 09:32:36', '2022-12-14 09:32:36'),
('81e4f042-c449-4f41-be15-7578838ddc0c', 'App\\Notifications\\MembershipUpgradeNotification', 'App\\Models\\User', 8, '{\"msg\":\"Upgrade to Standard plan\",\"type\":\"plan_upgrade\"}', NULL, '2022-12-15 05:13:07', '2022-12-15 05:13:07'),
('82c78ccf-2dbb-4792-b6eb-cf1e18384020', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 7, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-15 10:33:37', '2022-12-15 10:33:37'),
('84ec69db-9050-4315-b0f3-75710664a7b6', 'App\\Notifications\\LogoutNotification', 'App\\Models\\User', 10, '{\"msg\":\"You\'re loggedout successfully\",\"type\":\"loggedout\"}', NULL, '2022-12-22 04:47:23', '2022-12-22 04:47:23'),
('85cb815e-2123-49f4-9378-70216f5c9183', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 10, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-21 12:25:21', '2022-12-21 12:25:21'),
('8616f26c-3651-4f04-890d-6718c81d1e8f', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 3, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-14 07:23:04', '2022-12-14 07:23:04'),
('88242e12-8ccf-432f-975f-f6d1aeb54a43', 'App\\Notifications\\AdApprovedNotification', 'App\\Models\\User', 4, '{\"msg\":\"Ad Approved\",\"type\":\"adapproved\",\"url\":\"http:\\/\\/localhost:8000\\/ad\\/details\\/new-phone\"}', NULL, '2022-12-08 04:09:08', '2022-12-08 04:09:08'),
('89122e04-95ec-4057-9476-bc71a718b017', 'App\\Notifications\\AdCreateNotification', 'App\\Models\\User', 7, '{\"msg\":\"You\'re just created a ad\",\"type\":\"adcreate\",\"url\":\"https:\\/\\/dev.everisamting.com\\/ad\\/details\\/corei5-6th-gen-intel-gaming8gb-ddr4-ram22\"}', NULL, '2022-12-14 13:58:33', '2022-12-14 13:58:33'),
('8a833899-a3c2-492a-bea0-6c4844afd565', 'App\\Notifications\\AdApprovedNotification', 'App\\Models\\User', 4, '{\"msg\":\"Ad Approved\",\"type\":\"adapproved\",\"url\":\"http:\\/\\/localhost:8000\\/ad\\/details\\/best-home-made-things\"}', NULL, '2022-12-08 03:56:51', '2022-12-08 03:56:51'),
('8e21d2b0-1d37-4938-a5bd-d11beaa12a5a', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 3, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-24 07:47:35', '2022-12-24 07:47:35'),
('92044a06-15f7-4b02-bf02-9e9ff715d43d', 'App\\Notifications\\AdCreateNotification', 'App\\Models\\User', 3, '{\"msg\":\"You\'re just created a ad\",\"type\":\"adcreate\",\"url\":\"http:\\/\\/localhost:8000\\/ad\\/details\\/laravel-developer\"}', NULL, '2022-12-08 03:59:18', '2022-12-08 03:59:18'),
('950d9fee-69a5-4d72-a08c-5e1c9208c9b0', 'App\\Notifications\\AdCreateNotification', 'App\\Models\\User', 7, '{\"msg\":\"You\'re just created a ad\",\"type\":\"adcreate\",\"url\":\"https:\\/\\/dev.everisamting.com\\/ad\\/details\\/corei5-6th-gen-intel-gamin\"}', NULL, '2022-12-14 13:58:21', '2022-12-14 13:58:21'),
('98083cf2-cdeb-43f9-a2e6-f706a17c0488', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 1, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-21 05:39:39', '2022-12-21 05:39:39'),
('989fbd52-0a0e-488c-9887-bf6351dc5060', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 10, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-22 05:02:27', '2022-12-22 05:02:27'),
('99771403-27fb-478f-9c08-3c77eebf9926', 'App\\Notifications\\MembershipUpgradeNotification', 'App\\Models\\User', 3, '{\"msg\":\"Upgrade to Standard plan\",\"type\":\"plan_upgrade\"}', NULL, '2022-12-14 08:51:58', '2022-12-14 08:51:58'),
('9d59fced-f8dc-47b0-ba5b-13e30976523c', 'App\\Notifications\\AdWishlistNotification', 'App\\Models\\User', 5, '{\"msg\":\"Added a ad to favourite list\",\"type\":\"added_to_favourite\",\"url\":\"https:\\/\\/dev.everisamting.com\\/ad\\/details\\/asus-rog-strix-rtx-37\"}', NULL, '2022-12-19 05:44:00', '2022-12-19 05:44:00'),
('a0e0a290-db2a-4673-9e35-0a76ddcc85e6', 'App\\Notifications\\AdApprovedNotification', 'App\\Models\\User', 8, '{\"msg\":\"Ad Approved\",\"type\":\"adapproved\",\"url\":\"https:\\/\\/dev.everisamting.com\\/ad\\/details\\/formalin-cleaning-device\"}', NULL, '2022-12-14 13:57:34', '2022-12-14 13:57:34'),
('a1707c2e-122b-40d0-94dc-6a133e1c4a3e', 'App\\Notifications\\LogoutNotification', 'App\\Models\\User', 2, '{\"msg\":\"You\'re loggedout successfully\",\"type\":\"loggedout\"}', NULL, '2022-12-13 09:37:34', '2022-12-13 09:37:34'),
('a310f139-8599-4103-a2ad-59638ad42514', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 11, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-21 05:30:39', '2022-12-21 05:30:39'),
('a34bca91-645e-405e-b185-69d700100825', 'App\\Notifications\\AdCreateNotification', 'App\\Models\\User', 8, '{\"msg\":\"You\'re just created a ad\",\"type\":\"adcreate\",\"url\":\"https:\\/\\/dev.everisamting.com\\/ad\\/details\\/samsung-galaxy-m30s\"}', NULL, '2022-12-14 13:58:52', '2022-12-14 13:58:52'),
('a372e42d-053d-4a9e-a10b-77139e71d48e', 'App\\Notifications\\AdCreateNotification', 'App\\Models\\User', 4, '{\"msg\":\"You\'re just created a ad\",\"type\":\"adcreate\",\"url\":\"http:\\/\\/localhost:8000\\/ad\\/details\\/best-home-made-things\"}', NULL, '2022-12-08 03:56:56', '2022-12-08 03:56:56'),
('a6390dc1-9064-4944-9038-f00d5b92aecf', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 11, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-19 09:19:20', '2022-12-19 09:19:20'),
('a6af702b-d093-460e-bb9f-f8a268ee55e2', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 7, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-20 13:00:44', '2022-12-20 13:00:44'),
('a76ff8a3-7a09-4f16-8f40-5a5b355bdb69', 'App\\Notifications\\AdCreateNotification', 'App\\Models\\User', 4, '{\"msg\":\"You\'re just created a ad\",\"type\":\"adcreate\",\"url\":\"http:\\/\\/localhost:8000\\/ad\\/details\\/best-home-made-things\"}', NULL, '2022-12-08 04:09:41', '2022-12-08 04:09:41'),
('a77306eb-d8b5-4c89-aef5-a7c6c8ae050d', 'App\\Notifications\\AdCreateNotification', 'App\\Models\\User', 7, '{\"msg\":\"You\'re just created a ad\",\"type\":\"adcreate\",\"url\":\"https:\\/\\/dev.everisamting.com\\/ad\\/details\\/toyota-premio-2012\"}', NULL, '2022-12-21 13:38:54', '2022-12-21 13:38:54'),
('aae756ad-bf52-4328-b8cb-cb92284c4a0b', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 1, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-21 04:10:15', '2022-12-21 04:10:15'),
('abacc21f-60a4-423d-a09e-7ed124ae2dbb', 'App\\Notifications\\LogoutNotification', 'App\\Models\\User', 3, '{\"msg\":\"You\'re loggedout successfully\",\"type\":\"loggedout\"}', NULL, '2022-12-24 00:01:27', '2022-12-24 00:01:27'),
('b0ee14a2-18a9-4e9b-9ad2-b0e735fa6d3d', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 1, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-13 11:27:00', '2022-12-13 11:27:00'),
('b6ed79fb-ed16-4038-a2b1-404ad767a557', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 7, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-21 04:08:50', '2022-12-21 04:08:50'),
('b8c0ca3c-b904-4ac7-bb88-75575b0d0f80', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 7, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-21 13:41:22', '2022-12-21 13:41:22'),
('b9ad8cb2-6fda-4bb1-8a17-36ca17427b56', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 7, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-21 13:46:39', '2022-12-21 13:46:39'),
('ba231ddd-5ad1-4f5c-8364-2333c1a33f9d', 'App\\Notifications\\AdApprovedNotification', 'App\\Models\\User', 7, '{\"msg\":\"Ad Approved\",\"type\":\"adapproved\",\"url\":\"http:\\/\\/localhost:8000\\/ad\\/details\\/oppo-f1s-ram-4-gbrom-32-gb\"}', NULL, '2022-12-11 05:59:31', '2022-12-11 05:59:31'),
('bda1536c-c4d5-460d-b6c7-56b1b82c52cb', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 1, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-21 13:29:42', '2022-12-21 13:29:42'),
('c1ea0fa0-48aa-4ae2-810e-9b4a26bec8ec', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 12, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-20 16:28:48', '2022-12-20 16:28:48'),
('c24ba8a8-d9fe-4682-bd31-47fef8c3c5b5', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 10, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-14 21:44:45', '2022-12-14 21:44:45'),
('c4552710-ad08-46f2-9edb-3244c5edceeb', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 1, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-21 13:47:24', '2022-12-21 13:47:24'),
('c67c47db-2419-4d63-a764-a2c7379737fd', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 10, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-22 04:49:03', '2022-12-22 04:49:03'),
('c8a656f6-d900-4b67-bb45-9f63dac543ca', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 10, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-15 18:09:41', '2022-12-15 18:09:41'),
('cbb21c0a-2ba5-4429-972e-22cf211a8963', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 10, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-22 04:12:13', '2022-12-22 04:12:13'),
('cc1ad708-1121-4a13-94d0-84e40c954732', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 12, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-22 04:42:51', '2022-12-22 04:42:51'),
('ce352ef3-19f0-4213-a384-e3359f8e0d74', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 8, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-21 04:13:35', '2022-12-21 04:13:35'),
('cf757c89-8356-4439-bff0-2643130156a2', 'App\\Notifications\\AdApprovedNotification', 'App\\Models\\User', 8, '{\"msg\":\"Ad Approved\",\"type\":\"adapproved\",\"url\":\"https:\\/\\/dev.everisamting.com\\/ad\\/details\\/samsung-galaxy-m30s\"}', NULL, '2022-12-14 13:58:52', '2022-12-14 13:58:52'),
('d1b6c40e-9b06-4499-8aa9-d50eed93fb39', 'App\\Notifications\\AdApprovedNotification', 'App\\Models\\User', 7, '{\"msg\":\"Ad Approved\",\"type\":\"adapproved\",\"url\":\"https:\\/\\/dev.everisamting.com\\/ad\\/details\\/corei5-6th-gen-intel-gaming8gb-ddr4\"}', NULL, '2022-12-14 13:58:45', '2022-12-14 13:58:45'),
('d1cb0a4a-2e07-4180-9d76-c6f2c7307571', 'App\\Notifications\\LogoutNotification', 'App\\Models\\User', 12, '{\"msg\":\"You\'re loggedout successfully\",\"type\":\"loggedout\"}', NULL, '2022-12-22 04:43:34', '2022-12-22 04:43:34'),
('d29dd7c8-5211-495b-b9a9-3be0348ce933', 'App\\Notifications\\AdCreateNotification', 'App\\Models\\User', 1, '{\"msg\":\"You\'re just created a ad\",\"type\":\"adcreate\",\"url\":\"http:\\/\\/localhost:8000\\/ad\\/details\\/where-can-i-get-some\"}', NULL, '2022-12-08 04:03:11', '2022-12-08 04:03:11'),
('d526a433-6af3-4d77-ad62-f2b20c52728c', 'App\\Notifications\\AdApprovedNotification', 'App\\Models\\User', 7, '{\"msg\":\"Ad Approved\",\"type\":\"adapproved\",\"url\":\"https:\\/\\/dev.everisamting.com\\/ad\\/details\\/xiaomi-redmi-note-10\"}', NULL, '2022-12-14 09:36:28', '2022-12-14 09:36:28'),
('dbc6cfd5-3d34-40e1-9b2e-0c3febdb4432', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 7, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-19 06:17:38', '2022-12-19 06:17:38'),
('dd9fa1bf-387e-43bf-a7aa-e4c1bb3fd259', 'App\\Notifications\\LogoutNotification', 'App\\Models\\User', 10, '{\"msg\":\"You\'re loggedout successfully\",\"type\":\"loggedout\"}', NULL, '2022-12-22 05:22:56', '2022-12-22 05:22:56'),
('de3e094b-07d1-46ad-9134-8c77ed60650b', 'App\\Notifications\\LogoutNotification', 'App\\Models\\User', 3, '{\"msg\":\"You\'re loggedout successfully\",\"type\":\"loggedout\"}', NULL, '2022-12-26 04:25:59', '2022-12-26 04:25:59'),
('de7f795e-5bca-46c2-b8a8-06498722105d', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 10, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-21 19:04:08', '2022-12-21 19:04:08'),
('e33132cf-27ce-40b8-863a-b0787e66e0e7', 'App\\Notifications\\AdApprovedNotification', 'App\\Models\\User', 4, '{\"msg\":\"Ad Approved\",\"type\":\"adapproved\",\"url\":\"http:\\/\\/localhost:8000\\/ad\\/details\\/new-phone\"}', NULL, '2022-12-08 03:57:36', '2022-12-08 03:57:36'),
('e84bdf63-85e6-4588-afea-09f18a8e97ac', 'App\\Notifications\\LogoutNotification', 'App\\Models\\User', 7, '{\"msg\":\"You\'re loggedout successfully\",\"type\":\"loggedout\"}', NULL, '2022-12-19 10:54:02', '2022-12-19 10:54:02'),
('e9faa90c-2821-463b-9339-06fd045e5008', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 7, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-20 08:00:35', '2022-12-20 08:00:35'),
('eaa3446d-d4ce-4101-b2d5-ae3c2e846885', 'App\\Notifications\\AdApprovedNotification', 'App\\Models\\User', 7, '{\"msg\":\"Ad Approved\",\"type\":\"adapproved\",\"url\":\"https:\\/\\/dev.everisamting.com\\/ad\\/details\\/corei5-6th-gen-intel-gamin\"}', NULL, '2022-12-14 13:58:21', '2022-12-14 13:58:21'),
('eaa879a1-bcca-457a-a68d-141fa568c2ad', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 10, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-22 06:40:29', '2022-12-22 06:40:29'),
('ec361f8c-1e0b-4deb-920b-a03cf0117567', 'App\\Notifications\\AdCreateNotification', 'App\\Models\\User', 3, '{\"msg\":\"You\'re just created a ad\",\"type\":\"adcreate\",\"url\":\"http:\\/\\/localhost:8000\\/ad\\/details\\/arobil-need-account-manegar\"}', NULL, '2022-12-08 03:58:43', '2022-12-08 03:58:43'),
('edb1438e-19d2-40af-aeac-014035b19d42', 'App\\Notifications\\AdCreateNotification', 'App\\Models\\User', 7, '{\"msg\":\"You\'re just created a ad\",\"type\":\"adcreate\",\"url\":\"https:\\/\\/dev.everisamting.com\\/ad\\/details\\/asus-rog-strix-rtx-3060-oc-edition-v2-12gb\"}', NULL, '2022-12-14 13:57:28', '2022-12-14 13:57:28'),
('ee8110bc-e204-4b59-a699-34323e82c492', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 5, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-27 05:08:20', '2022-12-27 05:08:20'),
('eed9432b-3234-4328-a859-d3023e2dc785', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 4, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-10 04:31:17', '2022-12-10 04:31:17'),
('f0ad92b9-b229-46c5-a73a-0836f596674e', 'App\\Notifications\\LogoutNotification', 'App\\Models\\User', 9, '{\"msg\":\"You\'re loggedout successfully\",\"type\":\"loggedout\"}', NULL, '2022-12-14 14:13:12', '2022-12-14 14:13:12'),
('f12c8e68-a732-4845-a00d-29f98b2df658', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 5, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-19 05:38:03', '2022-12-19 05:38:03'),
('f28e0e7f-f27d-480e-91d9-b0e8aa03fc17', 'App\\Notifications\\AdApprovedNotification', 'App\\Models\\User', 10, '{\"msg\":\"Ad Approved\",\"type\":\"adapproved\",\"url\":\"https:\\/\\/dev.everisamting.com\\/ad\\/details\\/yes\"}', NULL, '2022-12-22 06:34:49', '2022-12-22 06:34:49'),
('f31723f0-d5ed-4698-95b7-31f01907f16f', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 1, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-13 09:37:39', '2022-12-13 09:37:39'),
('f46861f7-b75d-4528-be75-7446726f35a6', 'App\\Notifications\\LogoutNotification', 'App\\Models\\User', 4, '{\"msg\":\"You\'re loggedout successfully\",\"type\":\"loggedout\"}', NULL, '2022-12-10 04:32:26', '2022-12-10 04:32:26'),
('f483abc9-6ff3-4404-b37e-89afb3552159', 'App\\Notifications\\MembershipUpgradeNotification', 'App\\Models\\User', 5, '{\"msg\":\"Upgrade to Premium plan\",\"type\":\"plan_upgrade\"}', NULL, '2022-12-08 03:48:53', '2022-12-08 03:48:53'),
('f714a794-f659-4c22-b03d-aaddd8cd474d', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 10, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-22 04:41:32', '2022-12-22 04:41:32'),
('f92f84ee-55e5-4c71-a996-ca8a16904acf', 'App\\Notifications\\AdCreateNotification', 'App\\Models\\User', 3, '{\"msg\":\"You\'re just created a ad\",\"type\":\"adcreate\",\"url\":\"http:\\/\\/localhost:8000\\/ad\\/details\\/best-property\"}', NULL, '2022-12-08 03:58:31', '2022-12-08 03:58:31'),
('fa1c23cf-e5a7-4363-aefa-d6ac828c270d', 'App\\Notifications\\AdCreateNotification', 'App\\Models\\User', 7, '{\"msg\":\"You\'re just created a ad\",\"type\":\"adcreate\",\"url\":\"https:\\/\\/dev.everisamting.com\\/ad\\/details\\/corei5-6th-gen-intel-gaming8gb-ddr4-27\"}', NULL, '2022-12-14 12:02:19', '2022-12-14 12:02:19'),
('fa43240f-0bec-4172-8b76-c9cc1ef4c9c2', 'App\\Notifications\\AdApprovedNotification', 'App\\Models\\User', 3, '{\"msg\":\"Ad Approved\",\"type\":\"adapproved\",\"url\":\"http:\\/\\/localhost:8000\\/ad\\/details\\/best-property\"}', NULL, '2022-12-08 03:58:25', '2022-12-08 03:58:25'),
('fa5fc566-7710-46ff-9a27-ac896f927e72', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 5, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-23 23:15:14', '2022-12-23 23:15:14'),
('fc18d2c0-4ef7-4f96-85fa-6b5f08357105', 'App\\Notifications\\AdApprovedNotification', 'App\\Models\\User', 1, '{\"msg\":\"Ad Approved\",\"type\":\"adapproved\",\"url\":\"http:\\/\\/localhost:8000\\/ad\\/details\\/where-can-i-get-some\"}', NULL, '2022-12-08 04:03:06', '2022-12-08 04:03:06'),
('fe91c34c-0f2e-47c0-94ef-401e003eee8c', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 7, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-14 13:55:06', '2022-12-14 13:55:06'),
('ff842fcf-a490-4f4a-943f-c3025e924ba7', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 4, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2022-12-27 02:46:04', '2022-12-27 02:46:04');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `amount` double(8,2) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `number` varchar(16) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `payment_status` enum('1','2','3') DEFAULT NULL COMMENT '1=Waiting for payment, 2=Already paid, 3=Expired',
  `snap_token` varchar(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('masudrana@gmail.com', '$2y$10$2fkux2UtGChnqRcTK4LMUO.dyOQvkPfO8KIrKid19T38bMz518d0i', '2022-12-19 05:36:37');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `created_at`, `updated_at`) VALUES
(1, 'dashboard.view', 'admin', 'dashboard', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(2, 'admin.create', 'admin', 'admin', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(3, 'admin.view', 'admin', 'admin', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(4, 'admin.edit', 'admin', 'admin', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(5, 'admin.delete', 'admin', 'admin', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(6, 'role.create', 'admin', 'role', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(7, 'role.view', 'admin', 'role', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(8, 'role.edit', 'admin', 'role', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(9, 'role.delete', 'admin', 'role', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(10, 'map.create', 'admin', 'map', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(11, 'map.view', 'admin', 'map', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(12, 'map.edit', 'admin', 'map', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(13, 'map.delete', 'admin', 'map', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(14, 'profile.view', 'admin', 'profile', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(15, 'profile.edit', 'admin', 'profile', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(16, 'setting.view', 'admin', 'settings', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(17, 'setting.update', 'admin', 'settings', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(18, 'ad.create', 'admin', 'ad', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(19, 'ad.view', 'admin', 'ad', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(20, 'ad.update', 'admin', 'ad', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(21, 'ad.delete', 'admin', 'ad', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(22, 'category.create', 'admin', 'category', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(23, 'category.view', 'admin', 'category', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(24, 'category.update', 'admin', 'category', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(25, 'category.delete', 'admin', 'category', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(26, 'subcategory.create', 'admin', 'category', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(27, 'subcategory.view', 'admin', 'category', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(28, 'subcategory.update', 'admin', 'category', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(29, 'subcategory.delete', 'admin', 'category', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(30, 'custom-field.create', 'admin', 'custom-field', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(31, 'custom-field.view', 'admin', 'custom-field', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(32, 'custom-field.update', 'admin', 'custom-field', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(33, 'custom-field.delete', 'admin', 'custom-field', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(34, 'custom-field-group.create', 'admin', 'custom-field', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(35, 'custom-field-group.view', 'admin', 'custom-field', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(36, 'custom-field-group.update', 'admin', 'custom-field', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(37, 'custom-field-group.delete', 'admin', 'custom-field', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(38, 'newsletter.view', 'admin', 'newsletter', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(39, 'newsletter.mailsend', 'admin', 'newsletter', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(40, 'newsletter.delete', 'admin', 'newsletter', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(41, 'brand.create', 'admin', 'brand', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(42, 'brand.view', 'admin', 'brand', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(43, 'brand.update', 'admin', 'brand', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(44, 'brand.delete', 'admin', 'brand', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(45, 'plan.create', 'admin', 'plan', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(46, 'plan.view', 'admin', 'plan', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(47, 'plan.update', 'admin', 'plan', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(48, 'plan.delete', 'admin', 'plan', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(49, 'postcategory.create', 'admin', 'Blog', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(50, 'postcategory.view', 'admin', 'Blog', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(51, 'postcategory.update', 'admin', 'Blog', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(52, 'postcategory.delete', 'admin', 'Blog', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(53, 'post.create', 'admin', 'Blog', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(54, 'post.view', 'admin', 'Blog', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(55, 'post.update', 'admin', 'Blog', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(56, 'post.delete', 'admin', 'Blog', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(57, 'tag.create', 'admin', 'Blog', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(58, 'tag.view', 'admin', 'Blog', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(59, 'tag.update', 'admin', 'Blog', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(60, 'tag.delete', 'admin', 'Blog', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(61, 'testimonial.create', 'admin', 'testimonial', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(62, 'testimonial.view', 'admin', 'testimonial', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(63, 'testimonial.update', 'admin', 'testimonial', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(64, 'testimonial.delete', 'admin', 'testimonial', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(65, 'faqcategory.create', 'admin', 'faq', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(66, 'faqcategory.view', 'admin', 'faq', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(67, 'faqcategory.update', 'admin', 'faq', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(68, 'faqcategory.delete', 'admin', 'faq', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(69, 'faq.create', 'admin', 'faq', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(70, 'faq.view', 'admin', 'faq', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(71, 'faq.update', 'admin', 'faq', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(72, 'faq.delete', 'admin', 'faq', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(73, 'customer.view', 'admin', 'others', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(74, 'contact.view', 'admin', 'others', '2022-08-19 23:31:12', '2022-08-19 23:31:12');

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `label` varchar(255) NOT NULL,
  `price` double(8,2) NOT NULL,
  `ad_limit` int(11) NOT NULL,
  `featured_limit` int(11) NOT NULL,
  `badge` tinyint(1) NOT NULL,
  `recommended` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `interval` enum('monthly','yearly','custom_date') DEFAULT NULL,
  `custom_interval_days` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `label`, `price`, `ad_limit`, `featured_limit`, `badge`, `recommended`, `created_at`, `updated_at`, `interval`, `custom_interval_days`) VALUES
(1, 'Basic', 1000.00, 5, 5, 1, 0, '2022-11-30 01:02:13', '2022-12-21 11:44:21', 'monthly', 15),
(2, 'Standard', 1500.00, 10, 10, 1, 1, '2022-11-30 01:02:36', '2022-12-21 11:44:01', 'custom_date', 15),
(3, 'Premium', 2500.00, 25, 25, 1, 0, '2022-11-30 01:02:59', '2022-12-21 11:43:40', 'yearly', 15);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `author_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `short_description` text NOT NULL,
  `description` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post_categories`
--

CREATE TABLE `post_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_custom_fields`
--

CREATE TABLE `product_custom_fields` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ad_id` bigint(20) UNSIGNED DEFAULT NULL,
  `custom_field_id` bigint(20) UNSIGNED DEFAULT NULL,
  `custom_field_group_id` bigint(20) UNSIGNED DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_custom_fields`
--

INSERT INTO `product_custom_fields` (`id`, `ad_id`, `custom_field_id`, `custom_field_group_id`, `value`, `order`, `created_at`, `updated_at`) VALUES
(1, 42, 11, 3, 'Account traine', 0, '2022-12-19 10:45:17', '2022-12-19 10:45:17'),
(2, 42, 17, 3, '11999', 0, '2022-12-19 10:45:17', '2022-12-19 10:45:17'),
(3, 42, 12, 3, 'Full Time', 0, '2022-12-19 10:45:17', '2022-12-19 10:45:17'),
(4, 42, 18, 3, '2022-12-30', 0, '2022-12-19 10:45:17', '2022-12-19 10:45:17'),
(5, 42, 13, 3, '52', 0, '2022-12-19 12:12:58', '2022-12-19 12:12:58'),
(6, 42, 11, 3, 'Account traine', 0, '2022-12-19 12:12:58', '2022-12-19 12:12:58'),
(7, 42, 17, 3, '12000', 0, '2022-12-19 12:12:58', '2022-12-19 12:12:58'),
(8, 42, 12, 3, 'Full Time', 0, '2022-12-19 12:12:58', '2022-12-19 12:12:58'),
(9, 42, 18, 3, '2023-01-05', 0, '2022-12-19 12:12:58', '2022-12-19 12:12:58'),
(10, 43, 1, 1, 'Yes', 0, '2022-12-20 12:31:14', '2022-12-20 12:31:14'),
(11, 43, 3, 1, '3', 0, '2022-12-20 12:31:14', '2022-12-20 12:31:14'),
(12, 43, 2, 1, 'Retail', 0, '2022-12-20 12:31:14', '2022-12-20 12:31:14'),
(13, 43, 4, 1, NULL, 0, '2022-12-20 12:31:14', '2022-12-20 12:31:14'),
(14, 43, 5, 1, '2022-12-22', 0, '2022-12-20 12:31:14', '2022-12-20 12:31:14'),
(15, 43, 6, 1, NULL, 0, '2022-12-20 12:31:14', '2022-12-20 12:31:14'),
(22, 44, 1, 1, 'Yes', 0, '2022-12-20 12:38:40', '2022-12-20 12:38:40'),
(23, 44, 3, 1, '3', 0, '2022-12-20 12:38:40', '2022-12-20 12:38:40'),
(24, 44, 2, 1, 'Desk Space', 0, '2022-12-20 12:38:40', '2022-12-20 12:38:40'),
(25, 44, 5, 1, '2022-12-23', 0, '2022-12-20 12:38:40', '2022-12-20 12:38:40'),
(26, 44, 6, 1, 'https://www.facebook.com', 0, '2022-12-20 12:38:40', '2022-12-20 12:38:40'),
(27, 45, 13, 3, '52', 0, '2022-12-20 13:05:00', '2022-12-20 13:05:00'),
(28, 45, 11, 3, 'Cashier', 0, '2022-12-20 13:05:00', '2022-12-20 13:05:00'),
(29, 45, 12, 3, 'Full Time', 0, '2022-12-20 13:05:00', '2022-12-20 13:05:00'),
(30, 45, 13, 3, NULL, 0, '2022-12-20 13:05:00', '2022-12-20 13:05:00'),
(31, 45, 14, 3, '30', 0, '2022-12-20 13:05:00', '2022-12-20 13:05:00'),
(32, 45, 15, 3, 'Masters/MSC', 0, '2022-12-20 13:05:00', '2022-12-20 13:05:00'),
(33, 45, 16, 3, '2000', 0, '2022-12-20 13:05:00', '2022-12-20 13:05:00'),
(34, 45, 17, 3, '25000', 0, '2022-12-20 13:05:00', '2022-12-20 13:05:00'),
(35, 45, 18, 3, '2022-12-30', 0, '2022-12-20 13:05:00', '2022-12-20 13:05:00'),
(36, 45, 19, 3, 'Arobil', 0, '2022-12-20 13:05:00', '2022-12-20 13:05:00'),
(41, 47, 13, 3, '52', 0, '2022-12-21 04:28:02', '2022-12-21 04:28:02'),
(42, 47, 20, 3, NULL, 0, '2022-12-21 04:28:02', '2022-12-21 04:28:02'),
(43, 47, 11, 3, 'Cashier', 0, '2022-12-21 04:28:02', '2022-12-21 04:28:02'),
(44, 47, 12, 3, 'Internship', 0, '2022-12-21 04:28:02', '2022-12-21 04:28:02'),
(45, 47, 13, 3, NULL, 0, '2022-12-21 04:28:02', '2022-12-21 04:28:02'),
(46, 47, 14, 3, '1', 0, '2022-12-21 04:28:02', '2022-12-21 04:28:02'),
(47, 47, 15, 3, 'Honors/BSC', 0, '2022-12-21 04:28:02', '2022-12-21 04:28:02'),
(48, 47, 16, 3, '20000', 0, '2022-12-21 04:28:02', '2022-12-21 04:28:02'),
(49, 47, 17, 3, '25000', 0, '2022-12-21 04:28:02', '2022-12-21 04:28:02'),
(50, 47, 18, 3, '2022-12-12', 0, '2022-12-21 04:28:02', '2022-12-21 04:28:02'),
(51, 47, 19, 3, 'MKDS', 0, '2022-12-21 04:28:03', '2022-12-21 04:28:03'),
(52, 48, 7, 2, 'Private', 0, '2022-12-21 05:41:34', '2022-12-21 05:41:34'),
(53, 48, 8, 2, '2020', 0, '2022-12-21 05:41:34', '2022-12-21 05:41:34'),
(54, 48, 9, 2, 'https://www.mercedes.com', 0, '2022-12-21 05:41:34', '2022-12-21 05:41:34'),
(55, 48, 10, 2, 'https://www.youtube.com', 0, '2022-12-21 05:41:34', '2022-12-21 05:41:34'),
(56, 49, 2, 1, 'Home', 0, '2022-12-21 12:26:13', '2022-12-21 12:26:13'),
(57, 46, 7, 2, 'Private', 0, '2022-12-21 13:37:04', '2022-12-21 13:37:04'),
(58, 46, 8, 2, '45613', 0, '2022-12-21 13:37:04', '2022-12-21 13:37:04'),
(59, 46, 9, 2, 'https://arobil.com', 0, '2022-12-21 13:37:04', '2022-12-21 13:37:04'),
(60, 46, 10, 2, 'https://arobil.com', 0, '2022-12-21 13:37:04', '2022-12-21 13:37:04');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `report_from_id` bigint(20) UNSIGNED NOT NULL,
  `report_to_id` bigint(20) UNSIGNED NOT NULL,
  `reason` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `report_from_id`, `report_to_id`, `reason`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'fsdfd', '2022-11-30 04:36:33', '2022-11-30 04:36:33');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `stars` int(11) NOT NULL,
  `comment` longtext DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `seller_id`, `user_id`, `stars`, `comment`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 2, 4, 'fds', 1, '2022-11-30 04:36:52', '2022-11-30 04:36:52'),
(2, 7, 10, 5, 'i like the review thing, that is great!', 1, '2022-12-22 05:04:45', '2022-12-22 05:04:45');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'admin', '2022-08-19 23:31:12', '2022-08-19 23:31:12');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

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
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1);

-- --------------------------------------------------------

--
-- Table structure for table `seos`
--

CREATE TABLE `seos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_slug` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seos`
--

INSERT INTO `seos` (`id`, `page_slug`, `title`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'home', 'Welcome To Everisamting', 'Everisamting is a classifieds portal to buy and sell anything ', 'uploads/app/logo/oURKA9u8EVRUAcX2vZE3v1ojlehcXrAYwtlNnxIx.png', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(2, 'about', 'About', 'Everisamting is a classifieds portal to buy and sell anything ', 'uploads/app/logo/oURKA9u8EVRUAcX2vZE3v1ojlehcXrAYwtlNnxIx.png', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(3, 'contact', 'About', 'Everisamting is a classifieds portal to buy and sell anything ', 'uploads/app/logo/oURKA9u8EVRUAcX2vZE3v1ojlehcXrAYwtlNnxIx.png', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(4, 'ads', 'Ads', 'Everisamting is a classifieds portal to buy and sell anything ', 'uploads/app/logo/oURKA9u8EVRUAcX2vZE3v1ojlehcXrAYwtlNnxIx.png', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(5, 'blog', 'blog', 'Everisamting is a classifieds portal to buy and sell anything', 'uploads/app/logo/oURKA9u8EVRUAcX2vZE3v1ojlehcXrAYwtlNnxIx.png', '2022-08-19 23:31:12', '2022-12-13 09:24:30'),
(6, 'pricing', 'Pricing', 'Everisamting is a classifieds portal to buy and sell anything ', 'uploads/app/logo/oURKA9u8EVRUAcX2vZE3v1ojlehcXrAYwtlNnxIx.png', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(7, 'login', 'Login', 'Everisamting is a classifieds portal to buy and sell anything ', 'uploads/app/logo/oURKA9u8EVRUAcX2vZE3v1ojlehcXrAYwtlNnxIx.png', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(8, 'register', 'Register', 'Everisamting is a classifieds portal to buy and sell anything ', 'uploads/app/logo/oURKA9u8EVRUAcX2vZE3v1ojlehcXrAYwtlNnxIx.png', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(9, 'faq', 'FAQ', 'Everisamting is a classifieds portal to buy and sell anything ', 'uploads/app/logo/oURKA9u8EVRUAcX2vZE3v1ojlehcXrAYwtlNnxIx.png', '2022-08-19 23:31:12', '2022-08-19 23:31:12');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `logo_image` varchar(255) DEFAULT NULL,
  `white_logo` varchar(255) DEFAULT NULL,
  `favicon_image` varchar(255) DEFAULT NULL,
  `header_css` varchar(255) DEFAULT NULL,
  `header_script` varchar(255) DEFAULT NULL,
  `body_script` varchar(255) DEFAULT NULL,
  `free_featured_ad_limit` int(11) NOT NULL DEFAULT 3,
  `regular_ads_homepage` tinyint(1) NOT NULL DEFAULT 0,
  `featured_ads_homepage` tinyint(1) NOT NULL DEFAULT 1,
  `customer_email_verification` tinyint(1) NOT NULL DEFAULT 0,
  `maximum_ad_image_limit` int(10) UNSIGNED NOT NULL DEFAULT 5,
  `subscription_type` enum('one_time','recurring') NOT NULL DEFAULT 'one_time',
  `ads_admin_approval` tinyint(1) NOT NULL DEFAULT 0,
  `free_ad_limit` int(11) NOT NULL DEFAULT 5,
  `sidebar_color` varchar(255) DEFAULT NULL,
  `nav_color` varchar(255) DEFAULT NULL,
  `sidebar_txt_color` varchar(255) DEFAULT NULL,
  `nav_txt_color` varchar(255) DEFAULT NULL,
  `main_color` varchar(255) DEFAULT NULL,
  `accent_color` varchar(255) DEFAULT NULL,
  `frontend_primary_color` varchar(255) DEFAULT NULL,
  `frontend_secondary_color` varchar(255) DEFAULT NULL,
  `dark_mode` tinyint(1) NOT NULL DEFAULT 0,
  `facebook_pixel` tinyint(1) NOT NULL DEFAULT 0,
  `google_analytics` tinyint(1) NOT NULL DEFAULT 0,
  `search_engine_indexing` tinyint(1) NOT NULL DEFAULT 1,
  `default_layout` tinyint(1) NOT NULL DEFAULT 1,
  `website_loader` tinyint(1) NOT NULL DEFAULT 1,
  `loader_image` varchar(255) DEFAULT NULL,
  `language_changing` tinyint(1) NOT NULL DEFAULT 1,
  `email_verification` tinyint(1) NOT NULL DEFAULT 0,
  `watermark_status` tinyint(1) NOT NULL DEFAULT 0,
  `watermark_type` enum('text','image') NOT NULL DEFAULT 'text',
  `watermark_text` varchar(255) NOT NULL DEFAULT 'EveriSamting',
  `watermark_image` varchar(255) NOT NULL DEFAULT 'frontend/images/logo.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `default_map` enum('google-map','map-box') NOT NULL DEFAULT 'google-map',
  `google_map_key` varchar(255) DEFAULT NULL,
  `map_box_key` varchar(255) DEFAULT NULL,
  `default_long` double NOT NULL DEFAULT -100,
  `default_lat` double NOT NULL DEFAULT 40,
  `push_notification_status` tinyint(1) NOT NULL DEFAULT 1,
  `server_key` varchar(255) DEFAULT NULL,
  `api_key` varchar(255) DEFAULT NULL,
  `auth_domain` varchar(255) DEFAULT NULL,
  `project_id` varchar(255) DEFAULT NULL,
  `storage_bucket` varchar(255) DEFAULT NULL,
  `messaging_sender_id` varchar(255) DEFAULT NULL,
  `app_id` varchar(255) DEFAULT NULL,
  `measurement_id` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `linkdin` varchar(255) DEFAULT NULL,
  `whatsapp` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `logo_image`, `white_logo`, `favicon_image`, `header_css`, `header_script`, `body_script`, `free_featured_ad_limit`, `regular_ads_homepage`, `featured_ads_homepage`, `customer_email_verification`, `maximum_ad_image_limit`, `subscription_type`, `ads_admin_approval`, `free_ad_limit`, `sidebar_color`, `nav_color`, `sidebar_txt_color`, `nav_txt_color`, `main_color`, `accent_color`, `frontend_primary_color`, `frontend_secondary_color`, `dark_mode`, `facebook_pixel`, `google_analytics`, `search_engine_indexing`, `default_layout`, `website_loader`, `loader_image`, `language_changing`, `email_verification`, `watermark_status`, `watermark_type`, `watermark_text`, `watermark_image`, `created_at`, `updated_at`, `default_map`, `google_map_key`, `map_box_key`, `default_long`, `default_lat`, `push_notification_status`, `server_key`, `api_key`, `auth_domain`, `project_id`, `storage_bucket`, `messaging_sender_id`, `app_id`, `measurement_id`, `facebook`, `twitter`, `instagram`, `youtube`, `linkdin`, `whatsapp`) VALUES
(1, 'uploads/app/logo/oURKA9u8EVRUAcX2vZE3v1ojlehcXrAYwtlNnxIx.png', 'uploads/app/logo/gmZJ5IHuy4YZ5WblPwnKyBp8aAPNACNmgDg7SNLL.png', 'uploads/app/logo/1rt4a6GPqadg3w2WfmEfYVpkvqWKRbezWjiFG30J.png', NULL, NULL, NULL, 3, 1, 1, 0, 5, 'recurring', 0, 10, '#022446', '#0a243e', '#e0e9f2', '#e0e9f2', '#05c279', '#ffc107', '#05c279', '#ffc107', 0, 0, 0, 1, 1, 0, NULL, 1, 0, 1, 'image', 'EveriSamting', 'frontend/images/logo.png', '2022-08-19 23:31:12', '2022-12-24 01:54:44', 'google-map', 'AIzaSyCGYnCh2Uusd7iASDhsUCxvbFgkSifkkTM', '', 166.91116325224914, -15.297431927610816, 0, 'your-server-key', 'your-api-key', 'your-auth-domain', 'your-project-id', 'your-storage-bucket', 'your-messaging-sender-id', 'your-app-id', 'your-measurement-id', 'https://www.facebook.com/Vanuatujobs/', 'https://twitter.com/everisamting?t=82UWbXb4B11EL3NfcVmHMQ&s=09', 'https://instagram.com/everisamting?igshid=NTdlMDg3MTY=', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `setup_guides`
--

CREATE TABLE `setup_guides` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `task_name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `action_route` varchar(255) NOT NULL,
  `action_label` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `setup_guides`
--

INSERT INTO `setup_guides` (`id`, `task_name`, `title`, `description`, `action_route`, `action_label`, `status`, `created_at`, `updated_at`) VALUES
(1, 'app_setting', 'App Information ', 'Add your app logo, name, description, owner and other information.', 'settings.general', 'Add App Information', 1, '2022-08-19 23:31:12', '2022-12-21 12:04:01'),
(2, 'smtp_setting', 'SMTP Configuration', 'Add your app logo, name, description, owner and other information.', 'settings.email', 'Add Mail Configuration', 1, '2022-08-19 23:31:12', '2022-12-08 02:59:00'),
(3, 'payment_setting', 'Enable Payment Method', 'Enable to payment methods to receive payments from your customer.', 'settings.payment', 'Add Payment', 1, '2022-08-19 23:31:12', '2022-12-13 09:21:10'),
(4, 'theme_setting', 'Customize Theme', 'Customize your theme to make your app look more attractive.', 'settings.theme', 'Customize Your App Now', 1, '2022-08-19 23:31:12', '2022-11-30 05:16:52'),
(5, 'map_setting', 'Map Configuration', 'Configure your map setting api to create ad in any location.', 'settings.system', 'Add Map API', 1, '2022-08-19 23:31:12', '2022-12-13 08:15:47'),
(6, 'pusher_setting', 'Pusher Configuration', 'Configure your pusher setting api for the chat application', 'settings.system', 'Add Pusher API', 1, '2022-08-19 23:31:12', '2022-12-13 08:06:04');

-- --------------------------------------------------------

--
-- Table structure for table `social_media`
--

CREATE TABLE `social_media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `social_media` enum('facebook','twitter','instagram','youtube','linkedin','pinterest','reddit','github','other') NOT NULL,
  `url` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_media`
--

INSERT INTO `social_media` (`id`, `user_id`, `social_media`, `url`, `created_at`, `updated_at`) VALUES
(1, 7, 'facebook', 'https://www.facebook.com', '2022-12-15 10:44:36', '2022-12-15 10:44:36'),
(2, 5, 'instagram', 'http://www.instagram.com', '2022-12-19 05:52:27', '2022-12-19 05:52:27'),
(3, 5, 'twitter', 'http://www.witter.com', '2022-12-19 05:52:27', '2022-12-19 05:52:27');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `category_id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(7, 1, 'Cars', 'cars', 1, '2022-10-26 14:56:02', '2022-12-01 21:25:06'),
(12, 1, 'Buses & MicroBuses', 'buses-microbuses', 1, '2022-10-26 14:56:56', '2022-12-01 21:26:44'),
(16, 1, 'Heavy Equipment', 'heavy-equipment', 1, '2022-12-01 21:27:53', '2022-12-01 21:27:53'),
(17, 1, 'Motor Cycles', 'motor-cycles', 1, '2022-12-01 21:28:31', '2022-12-01 21:28:31'),
(18, 1, 'Trucks & Trailers', 'trucks-trailers', 1, '2022-12-01 21:28:54', '2022-12-01 21:28:54'),
(19, 1, 'Spares & Accessories', 'spares-accessories', 1, '2022-12-01 21:29:22', '2022-12-01 21:29:22'),
(20, 7, 'Hair Beauty', 'hair-beauty', 1, '2022-12-01 21:32:41', '2022-12-01 21:32:41'),
(21, 7, 'Skin Care', 'skin-care', 1, '2022-12-01 21:33:12', '2022-12-01 21:33:12'),
(22, 7, 'Sexual Wellness', 'sexual-wellness', 1, '2022-12-01 21:33:43', '2022-12-01 21:33:43'),
(23, 7, 'Make Up', 'make-up', 1, '2022-12-01 21:34:19', '2022-12-01 21:34:19'),
(24, 4, 'Laptops', 'laptops', 1, '2022-12-03 23:42:56', '2022-12-03 23:42:56'),
(25, 16, 'Smart Phone', 'smart-phone', 1, '2022-12-04 00:36:43', '2022-12-04 00:36:43'),
(26, 17, 'Mobile Phones', 'mobile-phones', 1, '2022-12-13 15:52:10', '2022-12-13 15:52:10'),
(27, 17, 'Mobile Phone Accessories', 'mobile-phone-accessories', 1, '2022-12-13 15:52:39', '2022-12-13 15:52:39'),
(28, 17, 'Wearables', 'wearables', 1, '2022-12-13 15:53:09', '2022-12-13 15:53:09'),
(29, 17, 'SIM Cards', 'sim-cards', 1, '2022-12-13 15:53:39', '2022-12-13 15:53:39'),
(30, 17, 'Mobile Phone Services', 'mobile-phone-services', 1, '2022-12-13 15:53:56', '2022-12-13 15:53:56'),
(31, 4, 'Desktop Computers', 'desktop-computers', 1, '2022-12-13 15:55:59', '2022-12-13 15:55:59'),
(32, 4, 'Laptop & Computer Accessories', 'laptop-computer-accessories', 1, '2022-12-13 15:56:19', '2022-12-13 15:56:19'),
(33, 4, 'TVs', 'tvs', 1, '2022-12-13 15:56:43', '2022-12-13 15:56:43'),
(34, 4, 'Audio & Sound Systems', 'audio-sound-systems', 1, '2022-12-13 15:57:02', '2022-12-13 15:57:02'),
(35, 4, 'Home Appliances', 'home-appliances', 1, '2022-12-13 15:57:24', '2022-12-13 15:57:24'),
(36, 4, 'ACs & Home Electronics', 'acs-home-electronics', 1, '2022-12-13 15:57:44', '2022-12-13 15:57:44'),
(37, 4, 'Cameras, Camcorders & Accessories', 'cameras-camcorders-accessories', 1, '2022-12-13 15:58:01', '2022-12-13 15:58:01'),
(38, 4, 'TV & Video Accessories', 'tv-video-accessories', 1, '2022-12-13 15:58:15', '2022-12-13 15:58:15'),
(39, 4, 'Tablets & Accessories', 'tablets-accessories', 1, '2022-12-13 15:58:30', '2022-12-13 15:58:30'),
(40, 4, 'Other Electronics', 'other-electronics', 1, '2022-12-13 16:00:13', '2022-12-13 16:00:13'),
(41, 4, 'Video Game Consoles & Accessories', 'video-game-consoles-accessories', 1, '2022-12-13 16:00:28', '2022-12-13 16:00:28'),
(42, 4, 'Photocopiers', 'photocopiers', 1, '2022-12-13 16:00:42', '2022-12-13 16:00:42'),
(44, 1, 'Bicycles', 'bicycles', 1, '2022-12-13 16:01:44', '2022-12-13 16:01:44'),
(45, 1, 'Auto Parts & Accessories', 'auto-parts-accessories', 1, '2022-12-13 16:01:59', '2022-12-13 16:01:59'),
(46, 1, 'Rentals', 'rentals', 1, '2022-12-13 16:02:12', '2022-12-13 16:02:12'),
(47, 1, 'Trucks', 'trucks', 1, '2022-12-13 16:02:26', '2022-12-13 16:02:26'),
(48, 1, 'Three Wheelers', 'three-wheelers', 1, '2022-12-13 16:02:40', '2022-12-13 16:02:40'),
(49, 1, 'Vans', 'vans', 1, '2022-12-13 16:02:58', '2022-12-13 16:02:58'),
(50, 1, 'Water Transport', 'water-transport', 1, '2022-12-13 16:03:12', '2022-12-13 16:03:12'),
(51, 1, 'Heavy Duty', 'heavy-duty', 1, '2022-12-13 16:03:27', '2022-12-13 16:03:27'),
(52, 1, 'Buses', 'buses', 1, '2022-12-13 16:03:39', '2022-12-13 16:03:39'),
(53, 1, 'Auto Services', 'auto-services', 1, '2022-12-13 16:03:52', '2022-12-13 16:03:52'),
(54, 2, 'Land For Sale', 'land-for-sale', 1, '2022-12-13 16:05:41', '2022-12-13 16:05:41'),
(55, 2, 'Apartments For Sale', 'apartments-for-sale', 1, '2022-12-13 16:05:54', '2022-12-13 16:05:54'),
(56, 2, 'Apartment Rentals', 'apartment-rentals', 1, '2022-12-13 16:06:06', '2022-12-13 16:06:06'),
(57, 2, 'Commercial Property Rentals', 'commercial-property-rentals', 1, '2022-12-13 16:06:19', '2022-12-13 16:06:19'),
(58, 2, 'Houses For Sale', 'houses-for-sale', 1, '2022-12-13 16:06:33', '2022-12-13 16:06:33'),
(59, 2, 'Room Rentals', 'room-rentals', 1, '2022-12-13 16:06:48', '2022-12-13 16:06:48'),
(60, 2, 'Commercial Properties For Sale', 'commercial-properties-for-sale', 1, '2022-12-13 16:07:02', '2022-12-13 16:07:02'),
(61, 2, 'House Rentals', 'house-rentals', 1, '2022-12-13 16:07:15', '2022-12-13 16:07:15'),
(62, 2, 'Land Rentals', 'land-rentals', 1, '2022-12-13 16:07:27', '2022-12-13 16:07:27'),
(63, 2, 'New Projects', 'new-projects', 1, '2022-12-13 16:07:40', '2022-12-13 16:07:40'),
(64, 18, 'Living Room Furniture', 'living-room-furniture', 1, '2022-12-13 16:09:27', '2022-12-13 16:09:27'),
(65, 18, 'Bedroom Furniture', 'bedroom-furniture', 1, '2022-12-13 16:09:48', '2022-12-13 16:09:48'),
(66, 18, 'Office & Shop Furniture', 'office-shop-furniture', 1, '2022-12-13 16:10:05', '2022-12-13 16:10:05'),
(67, 18, 'Household Items', 'household-items', 1, '2022-12-13 16:10:22', '2022-12-13 16:10:22'),
(68, 18, 'Kitchen & Dining Furniture', 'kitchen-dining-furniture', 1, '2022-12-13 16:10:39', '2022-12-13 16:10:39'),
(69, 18, 'Home Textiles & Decoration', 'home-textiles-decoration', 1, '2022-12-13 16:10:54', '2022-12-13 16:10:54'),
(70, 18, 'Bathroom Products', 'bathroom-products', 1, '2022-12-13 16:11:10', '2022-12-13 16:11:10'),
(71, 18, 'Doors', 'doors', 1, '2022-12-13 16:11:26', '2022-12-13 16:11:26'),
(72, 18, 'Children\'s Furniture', 'childrens-furniture', 1, '2022-12-13 16:11:41', '2022-12-13 16:11:41'),
(73, 19, 'Pets', 'pets', 1, '2022-12-13 16:13:12', '2022-12-13 16:13:12'),
(74, 19, 'Farm Animals', 'farm-animals', 1, '2022-12-13 16:13:32', '2022-12-13 16:13:32'),
(75, 19, 'Pet & Animal Accessories', 'pet-animal-accessories', 1, '2022-12-13 16:13:48', '2022-12-13 16:13:48'),
(76, 19, 'Pet & Animal food', 'pet-animal-food', 1, '2022-12-13 16:14:03', '2022-12-13 16:14:03'),
(77, 20, 'Musical Instruments', 'musical-instruments', 1, '2022-12-13 16:14:39', '2022-12-13 16:14:39'),
(78, 20, 'Sports', 'sports', 1, '2022-12-13 16:14:55', '2022-12-13 16:14:55'),
(79, 20, 'Fitness & Gym', 'fitness-gym', 1, '2022-12-13 16:15:09', '2022-12-13 16:15:09'),
(80, 20, 'Children\'s Items', 'childrens-items', 1, '2022-12-13 16:15:22', '2022-12-13 16:15:22'),
(81, 20, 'Other Hobby, Sport & Kids items', 'other-hobby-sport-kids-items', 1, '2022-12-13 16:15:41', '2022-12-13 16:15:41'),
(82, 20, 'Music, Books & Movies', 'music-books-movies', 1, '2022-12-13 16:15:59', '2022-12-13 16:15:59'),
(83, 21, 'Watches', 'watches', 1, '2022-12-13 16:18:16', '2022-12-13 16:18:16'),
(84, 21, 'Jacket & Coat', 'jacket-coat', 1, '2022-12-13 16:18:33', '2022-12-13 16:18:33'),
(85, 21, 'Footwear', 'footwear', 1, '2022-12-13 16:19:07', '2022-12-13 16:19:07'),
(86, 21, 'Shirts & T-Shirts', 'shirts-t-shirts', 1, '2022-12-13 16:19:26', '2022-12-13 16:19:26'),
(87, 21, 'Bags & Accessories', 'bags-accessories', 1, '2022-12-13 16:19:40', '2022-12-13 16:19:40'),
(88, 21, 'Grooming & Bodycare', 'grooming-bodycare', 1, '2022-12-13 16:19:57', '2022-12-13 16:19:57'),
(89, 21, 'Traditional Clothing', 'traditional-clothing', 1, '2022-12-13 16:20:12', '2022-12-13 16:20:12'),
(90, 21, 'Pants', 'pants', 1, '2022-12-13 16:20:25', '2022-12-13 16:20:25'),
(91, 21, 'Optical & Sunglasses', 'optical-sunglasses', 1, '2022-12-13 16:20:40', '2022-12-13 16:20:40'),
(92, 21, 'Wholesale - Bulk', 'wholesale-bulk', 1, '2022-12-13 16:20:54', '2022-12-13 16:20:54'),
(93, 21, 'Baby Boy\'s Fashion', 'baby-boys-fashion', 1, '2022-12-13 16:21:15', '2022-12-13 16:21:15'),
(94, 22, 'Traditional Wear', 'traditional-wear', 1, '2022-12-13 16:23:13', '2022-12-13 16:23:13'),
(95, 22, 'Jewellery & Watches', 'jewellery-watches', 1, '2022-12-13 16:23:27', '2022-12-13 16:23:27'),
(96, 22, 'Beauty & Personal Care', 'beauty-personal-care', 1, '2022-12-13 16:23:40', '2022-12-13 16:23:40'),
(97, 22, 'Western Wear', 'western-wear', 1, '2022-12-13 16:23:54', '2022-12-13 16:23:54'),
(98, 22, 'Winter Wear', 'winter-wear', 1, '2022-12-13 16:24:09', '2022-12-13 16:24:09'),
(99, 22, 'Baby Girl\'s Fashion', 'baby-girls-fashion', 1, '2022-12-13 16:24:49', '2022-12-13 16:24:49'),
(100, 22, 'Lingerie & Sleepwear', 'lingerie-sleepwear', 1, '2022-12-13 16:25:18', '2022-12-13 16:25:18'),
(101, 23, 'Industry Machinery & Tools', 'industry-machinery-tools', 1, '2022-12-13 16:26:12', '2022-12-13 16:26:12'),
(102, 23, 'Other Business & Industry Items', 'other-business-industry-items', 1, '2022-12-13 16:26:28', '2022-12-13 16:26:28'),
(103, 23, 'Medical Equipment & Supplies', 'medical-equipment-supplies', 1, '2022-12-13 16:26:44', '2022-12-13 16:26:44'),
(104, 23, 'Office Supplies & Stationary', 'office-supplies-stationary', 1, '2022-12-13 16:26:58', '2022-12-13 16:26:58'),
(105, 23, 'Licences, Titles & Tenders', 'licences-titles-tenders', 1, '2022-12-13 16:27:13', '2022-12-13 16:27:13'),
(106, 23, 'Raw Materials & Industrial Supplies', 'raw-materials-industrial-supplies', 1, '2022-12-13 16:27:29', '2022-12-13 16:27:29'),
(107, 23, 'Safety & Security', 'safety-security', 1, '2022-12-13 16:27:44', '2022-12-13 16:27:44'),
(108, 24, 'Grocery', 'grocery', 1, '2022-12-13 16:28:15', '2022-12-13 16:28:15'),
(109, 24, 'Healthcare', 'healthcare', 1, '2022-12-13 16:28:29', '2022-12-13 16:28:29'),
(110, 24, 'Household', 'household', 1, '2022-12-13 16:28:42', '2022-12-13 16:28:42'),
(111, 24, 'Other Essentials', 'other-essentials', 1, '2022-12-13 16:29:04', '2022-12-13 16:29:04'),
(112, 24, 'Fruits & Vegetables', 'fruits-vegetables', 1, '2022-12-13 16:29:21', '2022-12-13 16:29:21'),
(113, 24, 'Baby Products', 'baby-products', 1, '2022-12-13 16:29:35', '2022-12-13 16:29:35'),
(114, 24, 'Meat & Seafood', 'meat-seafood', 1, '2022-12-13 16:29:47', '2022-12-13 16:29:47'),
(115, 25, 'Tuition', 'tuition', 1, '2022-12-13 16:31:52', '2022-12-13 16:31:52'),
(116, 25, 'Textbooks', 'textbooks', 1, '2022-12-13 16:32:07', '2022-12-13 16:32:07'),
(117, 25, 'Courses', 'courses', 1, '2022-12-13 16:32:21', '2022-12-13 16:32:21'),
(118, 25, 'Study Abroad', 'study-abroad', 1, '2022-12-13 16:32:36', '2022-12-13 16:32:36'),
(119, 25, 'Other Education', 'other-education', 1, '2022-12-13 16:32:48', '2022-12-13 16:32:48'),
(120, 10, 'Government Jobs', 'government-jobs', 1, '2022-12-13 16:34:57', '2022-12-13 16:34:57'),
(121, 10, 'Office Admin', 'office-admin', 1, '2022-12-13 16:35:46', '2022-12-13 16:35:46'),
(122, 10, 'Maid', 'maid', 1, '2022-12-13 16:36:01', '2022-12-13 16:36:01'),
(123, 10, 'Security Guard', 'security-guard', 1, '2022-12-13 16:36:15', '2022-12-13 16:36:15'),
(124, 10, 'Driver', 'driver', 1, '2022-12-13 16:36:26', '2022-12-13 16:36:26'),
(125, 10, 'Chef', 'chef', 1, '2022-12-13 16:36:40', '2022-12-13 16:36:40'),
(126, 10, 'Counsellor', 'counsellor', 1, '2022-12-13 16:36:54', '2022-12-13 16:36:54'),
(127, 10, 'Teacher', 'teacher', 1, '2022-12-13 16:37:12', '2022-12-13 16:37:12'),
(128, 10, 'Software Engineer', 'software-engineer', 1, '2022-12-13 16:37:27', '2022-12-13 16:37:27'),
(129, 10, 'Hospitality Executive', 'hospitality-executive', 1, '2022-12-13 16:37:41', '2022-12-13 16:37:41'),
(130, 10, 'Customer Support Manager', 'customer-support-manager', 1, '2022-12-13 16:37:54', '2022-12-13 16:37:54'),
(131, 10, 'Nurse', 'nurse', 1, '2022-12-13 16:38:06', '2022-12-13 16:38:06'),
(132, 10, 'Other', 'other', 1, '2022-12-13 16:38:17', '2022-12-13 16:38:17'),
(133, 10, 'Digital Marketing Manager', 'digital-marketing-manager', 1, '2022-12-13 16:38:30', '2022-12-13 16:38:30'),
(134, 10, 'Collection & Recovery Agents', 'collection-recovery-agents', 1, '2022-12-13 16:38:44', '2022-12-13 16:38:44'),
(135, 10, 'Quality Controller', 'quality-controller', 1, '2022-12-13 16:38:57', '2022-12-13 16:38:57'),
(136, 10, 'Doctor', 'doctor', 1, '2022-12-13 16:39:09', '2022-12-13 16:39:09'),
(137, 10, 'Management Trainee', 'management-trainee', 1, '2022-12-13 16:39:20', '2022-12-13 16:39:20'),
(138, 10, 'HR Manager', 'hr-manager', 1, '2022-12-13 16:39:33', '2022-12-13 16:39:33'),
(139, 10, 'Sales Executive', 'sales-executive', 1, '2022-12-13 16:39:50', '2022-12-13 16:39:50'),
(140, 10, 'Operator', 'operator', 1, '2022-12-13 16:40:03', '2022-12-13 16:40:03'),
(141, 10, 'Delivery Rider', 'delivery-rider', 1, '2022-12-13 16:40:15', '2022-12-13 16:40:15'),
(142, 10, 'Supervisor', 'supervisor', 1, '2022-12-13 16:40:25', '2022-12-13 16:40:25'),
(143, 10, 'Digital Marketing Executive', 'digital-marketing-executive', 1, '2022-12-13 16:40:39', '2022-12-13 16:40:39'),
(144, 10, 'Social Media Presenter', 'social-media-presenter', 1, '2022-12-13 16:40:50', '2022-12-13 16:40:50'),
(145, 10, 'Marketing Manager', 'marketing-manager', 1, '2022-12-13 16:41:05', '2022-12-13 16:41:05'),
(146, 10, 'Engineer', 'engineer', 1, '2022-12-13 16:41:19', '2022-12-13 16:41:19'),
(147, 10, 'Quality Checker', 'quality-checker', 1, '2022-12-13 16:41:32', '2022-12-13 16:41:32'),
(148, 10, 'Beautician', 'beautician', 1, '2022-12-13 16:41:43', '2022-12-13 16:41:43'),
(149, 10, 'Journalist', 'journalist', 1, '2022-12-13 16:41:57', '2022-12-13 16:41:57'),
(150, 10, 'Pharmacist', 'pharmacist', 1, '2022-12-13 16:42:09', '2022-12-13 16:42:09'),
(151, 10, 'Videographer', 'videographer', 1, '2022-12-13 16:42:24', '2022-12-13 16:42:24'),
(152, 10, 'SEO specialist', 'seo-specialist', 1, '2022-12-13 16:42:35', '2022-12-13 16:42:35'),
(153, 10, 'Gardener', 'gardener', 1, '2022-12-13 16:42:48', '2022-12-13 16:42:48'),
(154, 10, 'Photographer', 'photographer', 1, '2022-12-13 16:43:00', '2022-12-13 16:43:00'),
(155, 10, 'Event Planner', 'event-planner', 1, '2022-12-13 16:43:12', '2022-12-13 16:43:12'),
(156, 10, 'Merchandiser', 'merchandiser', 1, '2022-12-13 16:43:25', '2022-12-13 16:43:25'),
(157, 10, 'Interior Designer', 'interior-designer', 1, '2022-12-13 16:43:49', '2022-12-13 16:43:49'),
(158, 10, 'Customer Service Executive', 'customer-service-executive', 1, '2022-12-13 16:44:09', '2022-12-13 16:44:09'),
(159, 10, 'Marketing Executive', 'marketing-executive', 1, '2022-12-13 16:44:31', '2022-12-13 16:44:31'),
(160, 10, 'House Keeper', 'house-keeper', 1, '2022-12-13 16:44:43', '2022-12-13 16:44:43'),
(161, 10, 'Garments Worker', 'garments-worker', 1, '2022-12-13 16:44:57', '2022-12-13 16:44:57'),
(162, 10, 'Accountant', 'accountant', 1, '2022-12-13 16:45:12', '2022-12-13 16:45:12'),
(163, 10, 'Designer', 'designer', 1, '2022-12-13 16:45:24', '2022-12-13 16:45:24'),
(164, 10, 'Mechanic', 'mechanic', 1, '2022-12-13 16:45:36', '2022-12-13 16:45:36'),
(165, 10, 'Electrician', 'electrician', 1, '2022-12-13 16:45:48', '2022-12-13 16:45:48'),
(166, 10, 'Sales Manager Field', 'sales-manager-field', 1, '2022-12-13 16:45:59', '2022-12-13 16:45:59'),
(167, 10, 'Construction Worker', 'construction-worker', 1, '2022-12-13 16:46:18', '2022-12-13 16:46:18'),
(168, 10, 'Content Writer', 'content-writer', 1, '2022-12-13 16:46:41', '2022-12-13 16:46:41'),
(169, 10, 'HR Executive', 'hr-executive', 1, '2022-12-13 16:46:52', '2022-12-13 16:46:52'),
(170, 10, 'Production Executive', 'production-executive', 1, '2022-12-13 16:47:05', '2022-12-13 16:47:05'),
(171, 10, 'Business Analyst', 'business-analyst', 1, '2022-12-13 16:47:16', '2022-12-13 16:47:16'),
(172, 10, 'Medical Representative', 'medical-representative', 1, '2022-12-13 16:47:29', '2022-12-13 16:47:29'),
(173, 10, 'Public Relations Officer', 'public-relations-officer', 1, '2022-12-13 16:47:40', '2022-12-13 16:47:40'),
(174, 10, 'Florist', 'florist', 1, '2022-12-13 16:47:52', '2022-12-13 16:47:52'),
(175, 10, 'Flight Attendant', 'flight-attendant', 1, '2022-12-13 16:48:04', '2022-12-13 16:48:04'),
(176, 9, 'Servicing & Repair', 'servicing-repair', 1, '2022-12-13 16:49:04', '2022-12-13 16:49:04'),
(177, 9, 'IT Services', 'it-services', 1, '2022-12-13 16:49:18', '2022-12-13 16:49:18'),
(178, 9, 'Tours & Travels', 'tours-travels', 1, '2022-12-13 16:49:30', '2022-12-13 16:49:30'),
(179, 9, 'Media & Event Management Services', 'media-event-management-services', 1, '2022-12-13 16:49:45', '2022-12-13 16:49:45'),
(180, 9, 'Professional Services', 'professional-services', 1, '2022-12-13 16:49:57', '2022-12-13 16:49:57'),
(181, 9, 'Matrimonials', 'matrimonials', 1, '2022-12-13 16:50:12', '2022-12-13 16:50:12'),
(182, 9, 'Fitness & Beauty Services', 'fitness-beauty-services', 1, '2022-12-13 16:50:26', '2022-12-13 16:50:26'),
(183, 9, 'Building maintenance', 'building-maintenance', 1, '2022-12-13 16:50:38', '2022-12-13 16:50:38'),
(184, 9, 'Domestic & Daycare Services', 'domestic-daycare-services', 1, '2022-12-13 16:50:51', '2022-12-13 16:50:51'),
(185, 26, 'Crops, Seeds & Plants', 'crops-seeds-plants', 1, '2022-12-13 16:53:42', '2022-12-13 16:53:42'),
(186, 26, 'Farming Tools & Machinery', 'farming-tools-machinery', 1, '2022-12-13 16:53:56', '2022-12-13 16:53:56'),
(187, 26, 'Other Agriculture', 'other-agriculture', 1, '2022-12-13 16:54:09', '2022-12-13 16:54:09');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `stars` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

CREATE TABLE `themes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `home_page` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `timezones`
--

CREATE TABLE `timezones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `timezones`
--

INSERT INTO `timezones` (`id`, `value`) VALUES
(1, 'Africa/Abidjan'),
(2, 'Africa/Accra'),
(3, 'Africa/Addis_Ababa'),
(4, 'Africa/Algiers'),
(5, 'Africa/Asmara'),
(6, 'Africa/Bamako'),
(7, 'Africa/Bangui'),
(8, 'Africa/Banjul'),
(9, 'Africa/Bissau'),
(10, 'Africa/Blantyre'),
(11, 'Africa/Brazzaville'),
(12, 'Africa/Bujumbura'),
(13, 'Africa/Cairo'),
(14, 'Africa/Casablanca'),
(15, 'Africa/Ceuta'),
(16, 'Africa/Conakry'),
(17, 'Africa/Dakar'),
(18, 'Africa/Dar_es_Salaam'),
(19, 'Africa/Djibouti'),
(20, 'Africa/Douala'),
(21, 'Africa/El_Aaiun'),
(22, 'Africa/Freetown'),
(23, 'Africa/Gaborone'),
(24, 'Africa/Harare'),
(25, 'Africa/Johannesburg'),
(26, 'Africa/Juba'),
(27, 'Africa/Kampala'),
(28, 'Africa/Khartoum'),
(29, 'Africa/Kigali'),
(30, 'Africa/Kinshasa'),
(31, 'Africa/Lagos'),
(32, 'Africa/Libreville'),
(33, 'Africa/Lome'),
(34, 'Africa/Luanda'),
(35, 'Africa/Lubumbashi'),
(36, 'Africa/Lusaka'),
(37, 'Africa/Malabo'),
(38, 'Africa/Maputo'),
(39, 'Africa/Maseru'),
(40, 'Africa/Mbabane'),
(41, 'Africa/Mogadishu'),
(42, 'Africa/Monrovia'),
(43, 'Africa/Nairobi'),
(44, 'Africa/Ndjamena'),
(45, 'Africa/Niamey'),
(46, 'Africa/Nouakchott'),
(47, 'Africa/Ouagadougou'),
(48, 'Africa/Porto-Novo'),
(49, 'Africa/Sao_Tome'),
(50, 'Africa/Tripoli'),
(51, 'Africa/Tunis'),
(52, 'Africa/Windhoek'),
(53, 'America/Adak'),
(54, 'America/Anchorage'),
(55, 'America/Anguilla'),
(56, 'America/Antigua'),
(57, 'America/Araguaina'),
(58, 'America/Argentina/Buenos_Aires'),
(59, 'America/Argentina/Catamarca'),
(60, 'America/Argentina/Cordoba'),
(61, 'America/Argentina/Jujuy'),
(62, 'America/Argentina/La_Rioja'),
(63, 'America/Argentina/Mendoza'),
(64, 'America/Argentina/Rio_Gallegos'),
(65, 'America/Argentina/Salta'),
(66, 'America/Argentina/San_Juan'),
(67, 'America/Argentina/San_Luis'),
(68, 'America/Argentina/Tucuman'),
(69, 'America/Argentina/Ushuaia'),
(70, 'America/Aruba'),
(71, 'America/Asuncion'),
(72, 'America/Atikokan'),
(73, 'America/Bahia'),
(74, 'America/Bahia_Banderas'),
(75, 'America/Barbados'),
(76, 'America/Belem'),
(77, 'America/Belize'),
(78, 'America/Blanc-Sablon'),
(79, 'America/Boa_Vista'),
(80, 'America/Bogota'),
(81, 'America/Boise'),
(82, 'America/Cambridge_Bay'),
(83, 'America/Campo_Grande'),
(84, 'America/Cancun'),
(85, 'America/Caracas'),
(86, 'America/Cayenne'),
(87, 'America/Cayman'),
(88, 'America/Chicago'),
(89, 'America/Chihuahua'),
(90, 'America/Costa_Rica'),
(91, 'America/Creston'),
(92, 'America/Cuiaba'),
(93, 'America/Curacao'),
(94, 'America/Danmarkshavn'),
(95, 'America/Dawson'),
(96, 'America/Dawson_Creek'),
(97, 'America/Denver'),
(98, 'America/Detroit'),
(99, 'America/Dominica'),
(100, 'America/Edmonton'),
(101, 'America/Eirunepe'),
(102, 'America/El_Salvador'),
(103, 'America/Fort_Nelson'),
(104, 'America/Fortaleza'),
(105, 'America/Glace_Bay'),
(106, 'America/Goose_Bay'),
(107, 'America/Grand_Turk'),
(108, 'America/Grenada'),
(109, 'America/Guadeloupe'),
(110, 'America/Guatemala'),
(111, 'America/Guayaquil'),
(112, 'America/Guyana'),
(113, 'America/Halifax'),
(114, 'America/Havana'),
(115, 'America/Hermosillo'),
(116, 'America/Indiana/Indianapolis'),
(117, 'America/Indiana/Knox'),
(118, 'America/Indiana/Marengo'),
(119, 'America/Indiana/Petersburg'),
(120, 'America/Indiana/Tell_City'),
(121, 'America/Indiana/Vevay'),
(122, 'America/Indiana/Vincennes'),
(123, 'America/Indiana/Winamac'),
(124, 'America/Inuvik'),
(125, 'America/Iqaluit'),
(126, 'America/Jamaica'),
(127, 'America/Juneau'),
(128, 'America/Kentucky/Louisville'),
(129, 'America/Kentucky/Monticello'),
(130, 'America/Kralendijk'),
(131, 'America/La_Paz'),
(132, 'America/Lima'),
(133, 'America/Los_Angeles'),
(134, 'America/Lower_Princes'),
(135, 'America/Maceio'),
(136, 'America/Managua'),
(137, 'America/Manaus'),
(138, 'America/Marigot'),
(139, 'America/Martinique'),
(140, 'America/Matamoros'),
(141, 'America/Mazatlan'),
(142, 'America/Menominee'),
(143, 'America/Merida'),
(144, 'America/Metlakatla'),
(145, 'America/Mexico_City'),
(146, 'America/Miquelon'),
(147, 'America/Moncton'),
(148, 'America/Monterrey'),
(149, 'America/Montevideo'),
(150, 'America/Montserrat'),
(151, 'America/Nassau'),
(152, 'America/New_York'),
(153, 'America/Nipigon'),
(154, 'America/Nome'),
(155, 'America/Noronha'),
(156, 'America/North_Dakota/Beulah'),
(157, 'America/North_Dakota/Center'),
(158, 'America/North_Dakota/New_Salem'),
(159, 'America/Nuuk'),
(160, 'America/Ojinaga'),
(161, 'America/Panama'),
(162, 'America/Pangnirtung'),
(163, 'America/Paramaribo'),
(164, 'America/Phoenix'),
(165, 'America/Port-au-Prince'),
(166, 'America/Port_of_Spain'),
(167, 'America/Porto_Velho'),
(168, 'America/Puerto_Rico'),
(169, 'America/Punta_Arenas'),
(170, 'America/Rainy_River'),
(171, 'America/Rankin_Inlet'),
(172, 'America/Recife'),
(173, 'America/Regina'),
(174, 'America/Resolute'),
(175, 'America/Rio_Branco'),
(176, 'America/Santarem'),
(177, 'America/Santiago'),
(178, 'America/Santo_Domingo'),
(179, 'America/Sao_Paulo'),
(180, 'America/Scoresbysund'),
(181, 'America/Sitka'),
(182, 'America/St_Barthelemy'),
(183, 'America/St_Johns'),
(184, 'America/St_Kitts'),
(185, 'America/St_Lucia'),
(186, 'America/St_Thomas'),
(187, 'America/St_Vincent'),
(188, 'America/Swift_Current'),
(189, 'America/Tegucigalpa'),
(190, 'America/Thule'),
(191, 'America/Thunder_Bay'),
(192, 'America/Tijuana'),
(193, 'America/Toronto'),
(194, 'America/Tortola'),
(195, 'America/Vancouver'),
(196, 'America/Whitehorse'),
(197, 'America/Winnipeg'),
(198, 'America/Yakutat'),
(199, 'America/Yellowknife'),
(200, 'Antarctica/Casey'),
(201, 'Antarctica/Davis'),
(202, 'Antarctica/DumontDUrville'),
(203, 'Antarctica/Macquarie'),
(204, 'Antarctica/Mawson'),
(205, 'Antarctica/McMurdo'),
(206, 'Antarctica/Palmer'),
(207, 'Antarctica/Rothera'),
(208, 'Antarctica/Syowa'),
(209, 'Antarctica/Troll'),
(210, 'Antarctica/Vostok'),
(211, 'Arctic/Longyearbyen'),
(212, 'Asia/Aden'),
(213, 'Asia/Almaty'),
(214, 'Asia/Amman'),
(215, 'Asia/Anadyr'),
(216, 'Asia/Aqtau'),
(217, 'Asia/Aqtobe'),
(218, 'Asia/Ashgabat'),
(219, 'Asia/Atyrau'),
(220, 'Asia/Baghdad'),
(221, 'Asia/Bahrain'),
(222, 'Asia/Baku'),
(223, 'Asia/Bangkok'),
(224, 'Asia/Barnaul'),
(225, 'Asia/Beirut'),
(226, 'Asia/Bishkek'),
(227, 'Asia/Brunei'),
(228, 'Asia/Chita'),
(229, 'Asia/Choibalsan'),
(230, 'Asia/Colombo'),
(231, 'Asia/Damascus'),
(232, 'Asia/Dhaka'),
(233, 'Asia/Dili'),
(234, 'Asia/Dubai'),
(235, 'Asia/Dushanbe'),
(236, 'Asia/Famagusta'),
(237, 'Asia/Gaza'),
(238, 'Asia/Hebron'),
(239, 'Asia/Ho_Chi_Minh'),
(240, 'Asia/Hong_Kong'),
(241, 'Asia/Hovd'),
(242, 'Asia/Irkutsk'),
(243, 'Asia/Jakarta'),
(244, 'Asia/Jayapura'),
(245, 'Asia/Jerusalem'),
(246, 'Asia/Kabul'),
(247, 'Asia/Kamchatka'),
(248, 'Asia/Karachi'),
(249, 'Asia/Kathmandu'),
(250, 'Asia/Khandyga'),
(251, 'Asia/Kolkata'),
(252, 'Asia/Krasnoyarsk'),
(253, 'Asia/Kuala_Lumpur'),
(254, 'Asia/Kuching'),
(255, 'Asia/Kuwait'),
(256, 'Asia/Macau'),
(257, 'Asia/Magadan'),
(258, 'Asia/Makassar'),
(259, 'Asia/Manila'),
(260, 'Asia/Muscat'),
(261, 'Asia/Nicosia'),
(262, 'Asia/Novokuznetsk'),
(263, 'Asia/Novosibirsk'),
(264, 'Asia/Omsk'),
(265, 'Asia/Oral'),
(266, 'Asia/Phnom_Penh'),
(267, 'Asia/Pontianak'),
(268, 'Asia/Pyongyang'),
(269, 'Asia/Qatar'),
(270, 'Asia/Qostanay'),
(271, 'Asia/Qyzylorda'),
(272, 'Asia/Riyadh'),
(273, 'Asia/Sakhalin'),
(274, 'Asia/Samarkand'),
(275, 'Asia/Seoul'),
(276, 'Asia/Shanghai'),
(277, 'Asia/Singapore'),
(278, 'Asia/Srednekolymsk'),
(279, 'Asia/Taipei'),
(280, 'Asia/Tashkent'),
(281, 'Asia/Tbilisi'),
(282, 'Asia/Tehran'),
(283, 'Asia/Thimphu'),
(284, 'Asia/Tokyo'),
(285, 'Asia/Tomsk'),
(286, 'Asia/Ulaanbaatar'),
(287, 'Asia/Urumqi'),
(288, 'Asia/Ust-Nera'),
(289, 'Asia/Vientiane'),
(290, 'Asia/Vladivostok'),
(291, 'Asia/Yakutsk'),
(292, 'Asia/Yangon'),
(293, 'Asia/Yekaterinburg'),
(294, 'Asia/Yerevan'),
(295, 'Atlantic/Azores'),
(296, 'Atlantic/Bermuda'),
(297, 'Atlantic/Canary'),
(298, 'Atlantic/Cape_Verde'),
(299, 'Atlantic/Faroe'),
(300, 'Atlantic/Madeira'),
(301, 'Atlantic/Reykjavik'),
(302, 'Atlantic/South_Georgia'),
(303, 'Atlantic/St_Helena'),
(304, 'Atlantic/Stanley'),
(305, 'Australia/Adelaide'),
(306, 'Australia/Brisbane'),
(307, 'Australia/Broken_Hill'),
(308, 'Australia/Darwin'),
(309, 'Australia/Eucla'),
(310, 'Australia/Hobart'),
(311, 'Australia/Lindeman'),
(312, 'Australia/Lord_Howe'),
(313, 'Australia/Melbourne'),
(314, 'Australia/Perth'),
(315, 'Australia/Sydney'),
(316, 'Europe/Amsterdam'),
(317, 'Europe/Andorra'),
(318, 'Europe/Astrakhan'),
(319, 'Europe/Athens'),
(320, 'Europe/Belgrade'),
(321, 'Europe/Berlin'),
(322, 'Europe/Bratislava'),
(323, 'Europe/Brussels'),
(324, 'Europe/Bucharest'),
(325, 'Europe/Budapest'),
(326, 'Europe/Busingen'),
(327, 'Europe/Chisinau'),
(328, 'Europe/Copenhagen'),
(329, 'Europe/Dublin'),
(330, 'Europe/Gibraltar'),
(331, 'Europe/Guernsey'),
(332, 'Europe/Helsinki'),
(333, 'Europe/Isle_of_Man'),
(334, 'Europe/Istanbul'),
(335, 'Europe/Jersey'),
(336, 'Europe/Kaliningrad'),
(337, 'Europe/Kiev'),
(338, 'Europe/Kirov'),
(339, 'Europe/Lisbon'),
(340, 'Europe/Ljubljana'),
(341, 'Europe/London'),
(342, 'Europe/Luxembourg'),
(343, 'Europe/Madrid'),
(344, 'Europe/Malta'),
(345, 'Europe/Mariehamn'),
(346, 'Europe/Minsk'),
(347, 'Europe/Monaco'),
(348, 'Europe/Moscow'),
(349, 'Europe/Oslo'),
(350, 'Europe/Paris'),
(351, 'Europe/Podgorica'),
(352, 'Europe/Prague'),
(353, 'Europe/Riga'),
(354, 'Europe/Rome'),
(355, 'Europe/Samara'),
(356, 'Europe/San_Marino'),
(357, 'Europe/Sarajevo'),
(358, 'Europe/Saratov'),
(359, 'Europe/Simferopol'),
(360, 'Europe/Skopje'),
(361, 'Europe/Sofia'),
(362, 'Europe/Stockholm'),
(363, 'Europe/Tallinn'),
(364, 'Europe/Tirane'),
(365, 'Europe/Ulyanovsk'),
(366, 'Europe/Uzhgorod'),
(367, 'Europe/Vaduz'),
(368, 'Europe/Vatican'),
(369, 'Europe/Vienna'),
(370, 'Europe/Vilnius'),
(371, 'Europe/Volgograd'),
(372, 'Europe/Warsaw'),
(373, 'Europe/Zagreb'),
(374, 'Europe/Zaporozhye'),
(375, 'Europe/Zurich'),
(376, 'Indian/Antananarivo'),
(377, 'Indian/Chagos'),
(378, 'Indian/Christmas'),
(379, 'Indian/Cocos'),
(380, 'Indian/Comoro'),
(381, 'Indian/Kerguelen'),
(382, 'Indian/Mahe'),
(383, 'Indian/Maldives'),
(384, 'Indian/Mauritius'),
(385, 'Indian/Mayotte'),
(386, 'Indian/Reunion'),
(387, 'Pacific/Apia'),
(388, 'Pacific/Auckland'),
(389, 'Pacific/Bougainville'),
(390, 'Pacific/Chatham'),
(391, 'Pacific/Chuuk'),
(392, 'Pacific/Easter'),
(393, 'Pacific/Efate'),
(394, 'Pacific/Fakaofo'),
(395, 'Pacific/Fiji'),
(396, 'Pacific/Funafuti'),
(397, 'Pacific/Galapagos'),
(398, 'Pacific/Gambier'),
(399, 'Pacific/Guadalcanal'),
(400, 'Pacific/Guam'),
(401, 'Pacific/Honolulu'),
(402, 'Pacific/Kanton'),
(403, 'Pacific/Kiritimati'),
(404, 'Pacific/Kosrae'),
(405, 'Pacific/Kwajalein'),
(406, 'Pacific/Majuro'),
(407, 'Pacific/Marquesas'),
(408, 'Pacific/Midway'),
(409, 'Pacific/Nauru'),
(410, 'Pacific/Niue'),
(411, 'Pacific/Norfolk'),
(412, 'Pacific/Noumea'),
(413, 'Pacific/Pago_Pago'),
(414, 'Pacific/Palau'),
(415, 'Pacific/Pitcairn'),
(416, 'Pacific/Pohnpei'),
(417, 'Pacific/Port_Moresby'),
(418, 'Pacific/Rarotonga'),
(419, 'Pacific/Saipan'),
(420, 'Pacific/Tahiti'),
(421, 'Pacific/Tarawa'),
(422, 'Pacific/Tongatapu'),
(423, 'Pacific/Wake'),
(424, 'Pacific/Wallis'),
(425, 'UTC'),
(426, 'Africa/Abidjan'),
(427, 'Africa/Accra'),
(428, 'Africa/Addis_Ababa'),
(429, 'Africa/Algiers'),
(430, 'Africa/Asmara'),
(431, 'Africa/Bamako'),
(432, 'Africa/Bangui'),
(433, 'Africa/Banjul'),
(434, 'Africa/Bissau'),
(435, 'Africa/Blantyre'),
(436, 'Africa/Brazzaville'),
(437, 'Africa/Bujumbura'),
(438, 'Africa/Cairo'),
(439, 'Africa/Casablanca'),
(440, 'Africa/Ceuta'),
(441, 'Africa/Conakry'),
(442, 'Africa/Dakar'),
(443, 'Africa/Dar_es_Salaam'),
(444, 'Africa/Djibouti'),
(445, 'Africa/Douala'),
(446, 'Africa/El_Aaiun'),
(447, 'Africa/Freetown'),
(448, 'Africa/Gaborone'),
(449, 'Africa/Harare'),
(450, 'Africa/Johannesburg'),
(451, 'Africa/Juba'),
(452, 'Africa/Kampala'),
(453, 'Africa/Khartoum'),
(454, 'Africa/Kigali'),
(455, 'Africa/Kinshasa'),
(456, 'Africa/Lagos'),
(457, 'Africa/Libreville'),
(458, 'Africa/Lome'),
(459, 'Africa/Luanda'),
(460, 'Africa/Lubumbashi'),
(461, 'Africa/Lusaka'),
(462, 'Africa/Malabo'),
(463, 'Africa/Maputo'),
(464, 'Africa/Maseru'),
(465, 'Africa/Mbabane'),
(466, 'Africa/Mogadishu'),
(467, 'Africa/Monrovia'),
(468, 'Africa/Nairobi'),
(469, 'Africa/Ndjamena'),
(470, 'Africa/Niamey'),
(471, 'Africa/Nouakchott'),
(472, 'Africa/Ouagadougou'),
(473, 'Africa/Porto-Novo'),
(474, 'Africa/Sao_Tome'),
(475, 'Africa/Tripoli'),
(476, 'Africa/Tunis'),
(477, 'Africa/Windhoek'),
(478, 'America/Adak'),
(479, 'America/Anchorage'),
(480, 'America/Anguilla'),
(481, 'America/Antigua'),
(482, 'America/Araguaina'),
(483, 'America/Argentina/Buenos_Aires'),
(484, 'America/Argentina/Catamarca'),
(485, 'America/Argentina/Cordoba'),
(486, 'America/Argentina/Jujuy'),
(487, 'America/Argentina/La_Rioja'),
(488, 'America/Argentina/Mendoza'),
(489, 'America/Argentina/Rio_Gallegos'),
(490, 'America/Argentina/Salta'),
(491, 'America/Argentina/San_Juan'),
(492, 'America/Argentina/San_Luis'),
(493, 'America/Argentina/Tucuman'),
(494, 'America/Argentina/Ushuaia'),
(495, 'America/Aruba'),
(496, 'America/Asuncion'),
(497, 'America/Atikokan'),
(498, 'America/Bahia'),
(499, 'America/Bahia_Banderas'),
(500, 'America/Barbados'),
(501, 'America/Belem'),
(502, 'America/Belize'),
(503, 'America/Blanc-Sablon'),
(504, 'America/Boa_Vista'),
(505, 'America/Bogota'),
(506, 'America/Boise'),
(507, 'America/Cambridge_Bay'),
(508, 'America/Campo_Grande'),
(509, 'America/Cancun'),
(510, 'America/Caracas'),
(511, 'America/Cayenne'),
(512, 'America/Cayman'),
(513, 'America/Chicago'),
(514, 'America/Chihuahua'),
(515, 'America/Costa_Rica'),
(516, 'America/Creston'),
(517, 'America/Cuiaba'),
(518, 'America/Curacao'),
(519, 'America/Danmarkshavn'),
(520, 'America/Dawson'),
(521, 'America/Dawson_Creek'),
(522, 'America/Denver'),
(523, 'America/Detroit'),
(524, 'America/Dominica'),
(525, 'America/Edmonton'),
(526, 'America/Eirunepe'),
(527, 'America/El_Salvador'),
(528, 'America/Fort_Nelson'),
(529, 'America/Fortaleza'),
(530, 'America/Glace_Bay'),
(531, 'America/Goose_Bay'),
(532, 'America/Grand_Turk'),
(533, 'America/Grenada'),
(534, 'America/Guadeloupe'),
(535, 'America/Guatemala'),
(536, 'America/Guayaquil'),
(537, 'America/Guyana'),
(538, 'America/Halifax'),
(539, 'America/Havana'),
(540, 'America/Hermosillo'),
(541, 'America/Indiana/Indianapolis'),
(542, 'America/Indiana/Knox'),
(543, 'America/Indiana/Marengo'),
(544, 'America/Indiana/Petersburg'),
(545, 'America/Indiana/Tell_City'),
(546, 'America/Indiana/Vevay'),
(547, 'America/Indiana/Vincennes'),
(548, 'America/Indiana/Winamac'),
(549, 'America/Inuvik'),
(550, 'America/Iqaluit'),
(551, 'America/Jamaica'),
(552, 'America/Juneau'),
(553, 'America/Kentucky/Louisville'),
(554, 'America/Kentucky/Monticello'),
(555, 'America/Kralendijk'),
(556, 'America/La_Paz'),
(557, 'America/Lima'),
(558, 'America/Los_Angeles'),
(559, 'America/Lower_Princes'),
(560, 'America/Maceio'),
(561, 'America/Managua'),
(562, 'America/Manaus'),
(563, 'America/Marigot'),
(564, 'America/Martinique'),
(565, 'America/Matamoros'),
(566, 'America/Mazatlan'),
(567, 'America/Menominee'),
(568, 'America/Merida'),
(569, 'America/Metlakatla'),
(570, 'America/Mexico_City'),
(571, 'America/Miquelon'),
(572, 'America/Moncton'),
(573, 'America/Monterrey'),
(574, 'America/Montevideo'),
(575, 'America/Montserrat'),
(576, 'America/Nassau'),
(577, 'America/New_York'),
(578, 'America/Nipigon'),
(579, 'America/Nome'),
(580, 'America/Noronha'),
(581, 'America/North_Dakota/Beulah'),
(582, 'America/North_Dakota/Center'),
(583, 'America/North_Dakota/New_Salem'),
(584, 'America/Nuuk'),
(585, 'America/Ojinaga'),
(586, 'America/Panama'),
(587, 'America/Pangnirtung'),
(588, 'America/Paramaribo'),
(589, 'America/Phoenix'),
(590, 'America/Port-au-Prince'),
(591, 'America/Port_of_Spain'),
(592, 'America/Porto_Velho'),
(593, 'America/Puerto_Rico'),
(594, 'America/Punta_Arenas'),
(595, 'America/Rainy_River'),
(596, 'America/Rankin_Inlet'),
(597, 'America/Recife'),
(598, 'America/Regina'),
(599, 'America/Resolute'),
(600, 'America/Rio_Branco'),
(601, 'America/Santarem'),
(602, 'America/Santiago'),
(603, 'America/Santo_Domingo'),
(604, 'America/Sao_Paulo'),
(605, 'America/Scoresbysund'),
(606, 'America/Sitka'),
(607, 'America/St_Barthelemy'),
(608, 'America/St_Johns'),
(609, 'America/St_Kitts'),
(610, 'America/St_Lucia'),
(611, 'America/St_Thomas'),
(612, 'America/St_Vincent'),
(613, 'America/Swift_Current'),
(614, 'America/Tegucigalpa'),
(615, 'America/Thule'),
(616, 'America/Thunder_Bay'),
(617, 'America/Tijuana'),
(618, 'America/Toronto'),
(619, 'America/Tortola'),
(620, 'America/Vancouver'),
(621, 'America/Whitehorse'),
(622, 'America/Winnipeg'),
(623, 'America/Yakutat'),
(624, 'America/Yellowknife'),
(625, 'Antarctica/Casey'),
(626, 'Antarctica/Davis'),
(627, 'Antarctica/DumontDUrville'),
(628, 'Antarctica/Macquarie'),
(629, 'Antarctica/Mawson'),
(630, 'Antarctica/McMurdo'),
(631, 'Antarctica/Palmer'),
(632, 'Antarctica/Rothera'),
(633, 'Antarctica/Syowa'),
(634, 'Antarctica/Troll'),
(635, 'Antarctica/Vostok'),
(636, 'Arctic/Longyearbyen'),
(637, 'Asia/Aden'),
(638, 'Asia/Almaty'),
(639, 'Asia/Amman'),
(640, 'Asia/Anadyr'),
(641, 'Asia/Aqtau'),
(642, 'Asia/Aqtobe'),
(643, 'Asia/Ashgabat'),
(644, 'Asia/Atyrau'),
(645, 'Asia/Baghdad'),
(646, 'Asia/Bahrain'),
(647, 'Asia/Baku'),
(648, 'Asia/Bangkok'),
(649, 'Asia/Barnaul'),
(650, 'Asia/Beirut'),
(651, 'Asia/Bishkek'),
(652, 'Asia/Brunei'),
(653, 'Asia/Chita'),
(654, 'Asia/Choibalsan'),
(655, 'Asia/Colombo'),
(656, 'Asia/Damascus'),
(657, 'Asia/Dhaka'),
(658, 'Asia/Dili'),
(659, 'Asia/Dubai'),
(660, 'Asia/Dushanbe'),
(661, 'Asia/Famagusta'),
(662, 'Asia/Gaza'),
(663, 'Asia/Hebron'),
(664, 'Asia/Ho_Chi_Minh'),
(665, 'Asia/Hong_Kong'),
(666, 'Asia/Hovd'),
(667, 'Asia/Irkutsk'),
(668, 'Asia/Jakarta'),
(669, 'Asia/Jayapura'),
(670, 'Asia/Jerusalem'),
(671, 'Asia/Kabul'),
(672, 'Asia/Kamchatka'),
(673, 'Asia/Karachi'),
(674, 'Asia/Kathmandu'),
(675, 'Asia/Khandyga'),
(676, 'Asia/Kolkata'),
(677, 'Asia/Krasnoyarsk'),
(678, 'Asia/Kuala_Lumpur'),
(679, 'Asia/Kuching'),
(680, 'Asia/Kuwait'),
(681, 'Asia/Macau'),
(682, 'Asia/Magadan'),
(683, 'Asia/Makassar'),
(684, 'Asia/Manila'),
(685, 'Asia/Muscat'),
(686, 'Asia/Nicosia'),
(687, 'Asia/Novokuznetsk'),
(688, 'Asia/Novosibirsk'),
(689, 'Asia/Omsk'),
(690, 'Asia/Oral'),
(691, 'Asia/Phnom_Penh'),
(692, 'Asia/Pontianak'),
(693, 'Asia/Pyongyang'),
(694, 'Asia/Qatar'),
(695, 'Asia/Qostanay'),
(696, 'Asia/Qyzylorda'),
(697, 'Asia/Riyadh'),
(698, 'Asia/Sakhalin'),
(699, 'Asia/Samarkand'),
(700, 'Asia/Seoul'),
(701, 'Asia/Shanghai'),
(702, 'Asia/Singapore'),
(703, 'Asia/Srednekolymsk'),
(704, 'Asia/Taipei'),
(705, 'Asia/Tashkent'),
(706, 'Asia/Tbilisi'),
(707, 'Asia/Tehran'),
(708, 'Asia/Thimphu'),
(709, 'Asia/Tokyo'),
(710, 'Asia/Tomsk'),
(711, 'Asia/Ulaanbaatar'),
(712, 'Asia/Urumqi'),
(713, 'Asia/Ust-Nera'),
(714, 'Asia/Vientiane'),
(715, 'Asia/Vladivostok'),
(716, 'Asia/Yakutsk'),
(717, 'Asia/Yangon'),
(718, 'Asia/Yekaterinburg'),
(719, 'Asia/Yerevan'),
(720, 'Atlantic/Azores'),
(721, 'Atlantic/Bermuda'),
(722, 'Atlantic/Canary'),
(723, 'Atlantic/Cape_Verde'),
(724, 'Atlantic/Faroe'),
(725, 'Atlantic/Madeira'),
(726, 'Atlantic/Reykjavik'),
(727, 'Atlantic/South_Georgia'),
(728, 'Atlantic/St_Helena'),
(729, 'Atlantic/Stanley'),
(730, 'Australia/Adelaide'),
(731, 'Australia/Brisbane'),
(732, 'Australia/Broken_Hill'),
(733, 'Australia/Darwin'),
(734, 'Australia/Eucla'),
(735, 'Australia/Hobart'),
(736, 'Australia/Lindeman'),
(737, 'Australia/Lord_Howe'),
(738, 'Australia/Melbourne'),
(739, 'Australia/Perth'),
(740, 'Australia/Sydney'),
(741, 'Europe/Amsterdam'),
(742, 'Europe/Andorra'),
(743, 'Europe/Astrakhan'),
(744, 'Europe/Athens'),
(745, 'Europe/Belgrade'),
(746, 'Europe/Berlin'),
(747, 'Europe/Bratislava'),
(748, 'Europe/Brussels'),
(749, 'Europe/Bucharest'),
(750, 'Europe/Budapest'),
(751, 'Europe/Busingen'),
(752, 'Europe/Chisinau'),
(753, 'Europe/Copenhagen'),
(754, 'Europe/Dublin'),
(755, 'Europe/Gibraltar'),
(756, 'Europe/Guernsey'),
(757, 'Europe/Helsinki'),
(758, 'Europe/Isle_of_Man'),
(759, 'Europe/Istanbul'),
(760, 'Europe/Jersey'),
(761, 'Europe/Kaliningrad'),
(762, 'Europe/Kiev'),
(763, 'Europe/Kirov'),
(764, 'Europe/Lisbon'),
(765, 'Europe/Ljubljana'),
(766, 'Europe/London'),
(767, 'Europe/Luxembourg'),
(768, 'Europe/Madrid'),
(769, 'Europe/Malta'),
(770, 'Europe/Mariehamn'),
(771, 'Europe/Minsk'),
(772, 'Europe/Monaco'),
(773, 'Europe/Moscow'),
(774, 'Europe/Oslo'),
(775, 'Europe/Paris'),
(776, 'Europe/Podgorica'),
(777, 'Europe/Prague'),
(778, 'Europe/Riga'),
(779, 'Europe/Rome'),
(780, 'Europe/Samara'),
(781, 'Europe/San_Marino'),
(782, 'Europe/Sarajevo'),
(783, 'Europe/Saratov'),
(784, 'Europe/Simferopol'),
(785, 'Europe/Skopje'),
(786, 'Europe/Sofia'),
(787, 'Europe/Stockholm'),
(788, 'Europe/Tallinn'),
(789, 'Europe/Tirane'),
(790, 'Europe/Ulyanovsk'),
(791, 'Europe/Uzhgorod'),
(792, 'Europe/Vaduz'),
(793, 'Europe/Vatican'),
(794, 'Europe/Vienna'),
(795, 'Europe/Vilnius'),
(796, 'Europe/Volgograd'),
(797, 'Europe/Warsaw'),
(798, 'Europe/Zagreb'),
(799, 'Europe/Zaporozhye'),
(800, 'Europe/Zurich'),
(801, 'Indian/Antananarivo'),
(802, 'Indian/Chagos'),
(803, 'Indian/Christmas'),
(804, 'Indian/Cocos'),
(805, 'Indian/Comoro'),
(806, 'Indian/Kerguelen'),
(807, 'Indian/Mahe'),
(808, 'Indian/Maldives'),
(809, 'Indian/Mauritius'),
(810, 'Indian/Mayotte'),
(811, 'Indian/Reunion'),
(812, 'Pacific/Apia'),
(813, 'Pacific/Auckland'),
(814, 'Pacific/Bougainville'),
(815, 'Pacific/Chatham'),
(816, 'Pacific/Chuuk'),
(817, 'Pacific/Easter'),
(818, 'Pacific/Efate'),
(819, 'Pacific/Fakaofo'),
(820, 'Pacific/Fiji'),
(821, 'Pacific/Funafuti'),
(822, 'Pacific/Galapagos'),
(823, 'Pacific/Gambier'),
(824, 'Pacific/Guadalcanal'),
(825, 'Pacific/Guam'),
(826, 'Pacific/Honolulu'),
(827, 'Pacific/Kanton'),
(828, 'Pacific/Kiritimati'),
(829, 'Pacific/Kosrae'),
(830, 'Pacific/Kwajalein'),
(831, 'Pacific/Majuro'),
(832, 'Pacific/Marquesas'),
(833, 'Pacific/Midway'),
(834, 'Pacific/Nauru'),
(835, 'Pacific/Niue'),
(836, 'Pacific/Norfolk'),
(837, 'Pacific/Noumea'),
(838, 'Pacific/Pago_Pago'),
(839, 'Pacific/Palau'),
(840, 'Pacific/Pitcairn'),
(841, 'Pacific/Pohnpei'),
(842, 'Pacific/Port_Moresby'),
(843, 'Pacific/Rarotonga'),
(844, 'Pacific/Saipan'),
(845, 'Pacific/Tahiti'),
(846, 'Pacific/Tarawa'),
(847, 'Pacific/Tongatapu'),
(848, 'Pacific/Wake'),
(849, 'Pacific/Wallis'),
(850, 'UTC');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `payment_provider` enum('flutterwave','mollie','midtrans','paypal','paystack','razorpay','sslcommerz','stripe','instamojo','offline') NOT NULL,
  `plan_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `amount` varchar(255) NOT NULL,
  `currency_symbol` varchar(255) DEFAULT NULL,
  `usd_amount` varchar(255) DEFAULT NULL,
  `payment_status` enum('paid','unpaid') NOT NULL DEFAULT 'unpaid',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `order_id`, `transaction_id`, `payment_provider`, `plan_id`, `user_id`, `amount`, `currency_symbol`, `usd_amount`, `payment_status`, `created_at`, `updated_at`) VALUES
(1, '548268777', '5M3605085L2085228', 'paypal', 3, 5, '99', '$', '99', 'paid', '2022-12-08 03:48:44', '2022-12-08 03:48:44'),
(2, '264199951', 'ch_3MEqgvGh5kKYxQzX15hnIU54', 'stripe', 2, 3, '25', '$', '25', 'paid', '2022-12-14 08:51:54', '2022-12-14 08:51:54'),
(3, '595966654', 'ch_3MErRLGh5kKYxQzX0bCa9XfL', 'stripe', 3, 7, '99', '$', '99', 'paid', '2022-12-14 09:39:52', '2022-12-14 09:39:52'),
(4, '995937091', 'ch_3MF9khGh5kKYxQzX0Dn9b3pK', 'stripe', 2, 8, '25', '$', '25', 'paid', '2022-12-15 05:13:05', '2022-12-15 05:13:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `show_email` int(11) DEFAULT NULL,
  `receive_email` int(11) DEFAULT 0,
  `phone` varchar(255) DEFAULT NULL,
  `show_phone` int(11) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `web` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'backend/image/default-user.png',
  `token` varchar(255) DEFAULT NULL,
  `last_seen` text DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `auth_type` varchar(255) NOT NULL DEFAULT 'email',
  `provider` varchar(255) DEFAULT NULL,
  `provider_id` varchar(255) DEFAULT NULL,
  `fcm_token` varchar(255) DEFAULT NULL,
  `about_public_profile` text DEFAULT NULL,
  `opening_hour` time DEFAULT NULL,
  `closing_hours` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `show_email`, `receive_email`, `phone`, `show_phone`, `email_verified_at`, `password`, `web`, `image`, `token`, `last_seen`, `remember_token`, `created_at`, `updated_at`, `auth_type`, `provider`, `provider_id`, `fcm_token`, `about_public_profile`, `opening_hour`, `closing_hours`) VALUES
(1, 'Rabin', 'rabin', 'arobil@gmail.com', 0, 0, NULL, 0, NULL, '$2y$10$3VNEYrmJ0oFmqfhDmk2j8upZwaH/LAIFGCBBfz3YNoY6XWIBrAmJG', NULL, 'backend/image/default-user.png', NULL, '2022-12-22 04:52:24', NULL, '2022-11-29 01:41:26', '2022-12-22 04:52:24', 'email', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'rabin mia', 'rabin-mia', 'rabin@gmail.com', NULL, 0, NULL, NULL, NULL, '$2y$10$3VNEYrmJ0oFmqfhDmk2j8upZwaH/LAIFGCBBfz3YNoY6XWIBrAmJG', NULL, 'backend/image/default-user.png', NULL, '2022-12-13 09:37:34', NULL, '2022-11-30 02:45:01', '2022-12-13 09:37:34', 'email', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Masud Rana', 'masud', 'masud@gmail.com', NULL, 0, NULL, NULL, NULL, '$2y$10$rwN4cgHaDixDZ..bUOoxXOabOfF/c2qVuXd.cM3TI8T7v4DipD5qS', NULL, 'backend/image/default-user.png', NULL, '2022-12-28 13:20:28', NULL, '2022-12-08 03:06:01', '2022-12-28 07:20:28', 'email', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Safwan Ahmmed', 'safwanahmmed', 'safwan@gmail.com', NULL, 0, NULL, NULL, NULL, '$2y$10$rwN4cgHaDixDZ..bUOoxXOabOfF/c2qVuXd.cM3TI8T7v4DipD5qS', NULL, 'backend/image/default-user.png', NULL, '2022-12-27 09:36:04', NULL, '2022-12-08 03:35:36', '2022-12-27 03:36:04', 'email', NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'Masud Rana', 'masud-rana', 'masudrana@gmail.com', 1, 0, '01551066777', 1, NULL, '$2y$10$rwN4cgHaDixDZ..bUOoxXOabOfF/c2qVuXd.cM3TI8T7v4DipD5qS', NULL, 'backend/image/default-user.png', NULL, '2022-12-27 11:14:06', NULL, '2022-12-08 03:45:20', '2022-12-27 05:14:06', 'email', NULL, NULL, NULL, 'My shop is best shop forever', '10:00:00', '18:00:00'),
(7, 'Rony Islam', 'rony-islam', 'ronymia.tech@gmail.com', 1, 0, '+880199057232', 1, NULL, '$2y$10$3VNEYrmJ0oFmqfhDmk2j8upZwaH/LAIFGCBBfz3YNoY6XWIBrAmJG', 'https://webdevs4u.com/', 'backend/image/default-user.png', NULL, '2022-12-21 13:45:31', NULL, '2022-12-10 01:09:58', '2022-12-21 13:45:31', 'email', NULL, NULL, NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '09:00:00', '22:00:00'),
(8, 'Mokaddes Hosain', 'mokaddes', 'mr.mokaddes@gmail.com', NULL, 0, NULL, NULL, NULL, '$2y$10$2EQtbhi5D7R/895YtQwVI.vLfobK.gbnMB6in.deocHKq4o1ZYw8K', NULL, 'backend/image/default-user.png', NULL, '2022-12-21 04:28:04', NULL, '2022-12-14 11:13:41', '2022-12-21 04:28:04', 'email', NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'Rony', 'ronymia11', 'ronymia2211@gmail.com', NULL, 0, NULL, NULL, NULL, '$2y$10$qfGB.O6mUSAy5wXRcoSfmeAZBvZd7imTHnP13Ytlf7Gd0TK.IDG8K', NULL, 'backend/image/default-user.png', NULL, '2022-12-14 14:13:12', NULL, '2022-12-14 14:09:52', '2022-12-14 14:13:12', 'email', NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'El', 'James', 'shmvanuatu@gmail.com', NULL, 0, NULL, NULL, NULL, '$2y$10$Kt9wB5hadkdxvHG7h3f5r.xsAzbdQeGQRHcQnHGPpYzLXzjuBH1Z.', NULL, 'backend/image/default-user.png', NULL, '2022-12-22 06:40:52', 'Jp6joNOIb9ydgsR41vmqAsTMOWLb9leNiJ9vjUYRLzUAmsOOMlMCtrXIT42q', '2022-12-14 18:25:11', '2022-12-22 06:40:52', 'email', NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'Mubarak', 'Mubarak', 'mubaraktech355@gmail.com', NULL, 0, NULL, NULL, NULL, '$2y$10$TtHKVH8cWSQR2NE5LqhF.u8ZxDDwvM.kjbzPJiqBOJAQOv67wFjt6', NULL, 'backend/image/default-user.png', NULL, '2022-12-21 06:20:31', NULL, '2022-12-15 13:17:35', '2022-12-21 06:20:31', 'email', NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'Elliot', 'shmvanuatu@gmail.com', 'vanuatupie@gmail.com', NULL, 0, NULL, NULL, NULL, '$2y$10$LeWUhL2vUqmQQ2vdzXSBF.kmJo8C4oLzSAoUg7L6sTVSNdAxA2hYO', NULL, 'backend/image/default-user.png', NULL, '2022-12-22 04:43:34', NULL, '2022-12-19 15:05:35', '2022-12-22 04:43:34', 'email', NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'Mubarak', 'Mubarak hossain', 'mubarak@gmail.com', NULL, 0, NULL, NULL, NULL, '$2y$10$L.FBSt6kIz6jySoFY90v1.90PN.J1XW2av9Bgjki9A7wylRwIi8DG', NULL, 'backend/image/default-user.png', NULL, '2022-12-20 13:02:54', NULL, '2022-12-20 12:22:05', '2022-12-20 13:02:54', 'email', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_device_tokens`
--

CREATE TABLE `user_device_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `device_token` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_plans`
--

CREATE TABLE `user_plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `ad_limit` bigint(20) UNSIGNED NOT NULL DEFAULT 3,
  `featured_limit` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `badge` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `subscription_type` enum('one_time','recurring') NOT NULL DEFAULT 'one_time',
  `expired_date` date DEFAULT NULL,
  `current_plan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_restored_plan_benefits` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_plans`
--

INSERT INTO `user_plans` (`id`, `user_id`, `ad_limit`, `featured_limit`, `badge`, `created_at`, `updated_at`, `subscription_type`, `expired_date`, `current_plan_id`, `is_restored_plan_benefits`) VALUES
(1, 1, 6, 9, 1, '2022-11-29 01:41:26', '2022-12-22 04:50:24', 'recurring', '2022-12-28', 2, 0),
(2, 2, 5, 3, 0, '2022-11-30 02:45:01', '2022-11-30 02:45:01', 'recurring', '2023-12-08', NULL, 0),
(3, 3, 8, 7, 1, '2022-12-08 03:06:01', '2022-12-24 07:48:04', 'recurring', '2023-12-29', 2, 0),
(4, 4, 0, 0, 0, '2022-12-08 03:35:36', '2022-12-08 03:57:12', 'recurring', NULL, NULL, 0),
(5, 5, 29, 26, 1, '2022-12-08 03:45:20', '2022-12-19 10:38:11', 'recurring', '2023-12-08', 3, 0),
(6, 7, 3, 19, 1, '2022-12-10 01:09:58', '2022-12-21 13:38:51', 'recurring', '2023-12-14', 3, 0),
(7, 8, 8, 12, 1, '2022-12-14 11:13:41', '2022-12-21 04:21:26', 'recurring', '2022-12-30', 2, 0),
(8, 9, 10, 3, 0, '2022-12-14 14:09:52', '2022-12-14 14:09:52', 'recurring', NULL, NULL, 0),
(9, 10, 0, 2, 0, '2022-12-14 18:25:11', '2022-12-21 19:27:53', 'recurring', NULL, NULL, 0),
(10, 11, 4, 1, 0, '2022-12-15 13:17:35', '2022-12-21 05:34:59', 'recurring', NULL, NULL, 0),
(11, 12, 9, 3, 0, '2022-12-19 15:05:35', '2022-12-20 16:30:32', 'recurring', NULL, NULL, 0),
(12, 13, 8, 1, 0, '2022-12-20 12:22:05', '2022-12-20 12:32:52', 'recurring', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ad_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `ad_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 36, 5, '2022-12-19 05:44:00', '2022-12-19 05:44:00'),
(2, 31, 5, '2022-12-19 05:44:28', '2022-12-19 05:44:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `admin_searches`
--
ALTER TABLE `admin_searches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ads_user_id_foreign` (`user_id`),
  ADD KEY `ads_category_id_foreign` (`category_id`),
  ADD KEY `ads_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `ad_features`
--
ALTER TABLE `ad_features`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ad_features_ad_id_foreign` (`ad_id`);

--
-- Indexes for table `ad_galleries`
--
ALTER TABLE `ad_galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_comments`
--
ALTER TABLE `blog_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_comments_post_id_foreign` (`post_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_custom_field`
--
ALTER TABLE `category_custom_field`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_custom_field_category_id_foreign` (`category_id`),
  ADD KEY `category_custom_field_custom_field_id_foreign` (`custom_field_id`);

--
-- Indexes for table `cms`
--
ALTER TABLE `cms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cookies`
--
ALTER TABLE `cookies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_fields`
--
ALTER TABLE `custom_fields`
  ADD PRIMARY KEY (`id`),
  ADD KEY `custom_fields_custom_field_group_id_foreign` (`custom_field_group_id`);

--
-- Indexes for table `custom_field_groups`
--
ALTER TABLE `custom_field_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_field_values`
--
ALTER TABLE `custom_field_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `custom_field_values_custom_field_id_foreign` (`custom_field_id`);

--
-- Indexes for table `database_backups`
--
ALTER TABLE `database_backups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `emails_email_unique` (`email`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_categories`
--
ALTER TABLE `event_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_organiser`
--
ALTER TABLE `event_organiser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_tags`
--
ALTER TABLE `event_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_venues`
--
ALTER TABLE `event_venues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faqs_faq_category_id_foreign` (`faq_category_id`);

--
-- Indexes for table `faq_categories`
--
ALTER TABLE `faq_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `faq_categories_name_unique` (`name`),
  ADD UNIQUE KEY `faq_categories_slug_unique` (`slug`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `languages_name_unique` (`name`),
  ADD UNIQUE KEY `languages_code_unique` (`code`),
  ADD UNIQUE KEY `languages_icon_unique` (`icon`);

--
-- Indexes for table `messengers`
--
ALTER TABLE `messengers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mobile_app_configs`
--
ALTER TABLE `mobile_app_configs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mobile_app_sliders`
--
ALTER TABLE `mobile_app_sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `module_settings`
--
ALTER TABLE `module_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `plans_label_unique` (`label`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_category_id_foreign` (`category_id`),
  ADD KEY `posts_author_id_foreign` (`author_id`);

--
-- Indexes for table `post_categories`
--
ALTER TABLE `post_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_custom_fields`
--
ALTER TABLE `product_custom_fields`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_custom_fields_ad_id_foreign` (`ad_id`),
  ADD KEY `product_custom_fields_custom_field_id_foreign` (`custom_field_id`),
  ADD KEY `product_custom_fields_custom_field_group_id_foreign` (`custom_field_group_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reports_report_from_id_foreign` (`report_from_id`),
  ADD KEY `reports_report_to_id_foreign` (`report_to_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `seos`
--
ALTER TABLE `seos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setup_guides`
--
ALTER TABLE `setup_guides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_media`
--
ALTER TABLE `social_media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `social_media_user_id_foreign` (`user_id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timezones`
--
ALTER TABLE `timezones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_plan_id_foreign` (`plan_id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`),
  ADD UNIQUE KEY `users_web_unique` (`web`);

--
-- Indexes for table `user_device_tokens`
--
ALTER TABLE `user_device_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_device_tokens_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_plans`
--
ALTER TABLE `user_plans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_plans_user_id_foreign` (`user_id`),
  ADD KEY `user_plans_current_plan_id_foreign` (`current_plan_id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlists_ad_id_foreign` (`ad_id`),
  ADD KEY `wishlists_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_searches`
--
ALTER TABLE `admin_searches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `ad_features`
--
ALTER TABLE `ad_features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `ad_galleries`
--
ALTER TABLE `ad_galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `blog_comments`
--
ALTER TABLE `blog_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `category_custom_field`
--
ALTER TABLE `category_custom_field`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `cms`
--
ALTER TABLE `cms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cookies`
--
ALTER TABLE `cookies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `custom_fields`
--
ALTER TABLE `custom_fields`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `custom_field_groups`
--
ALTER TABLE `custom_field_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `custom_field_values`
--
ALTER TABLE `custom_field_values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `database_backups`
--
ALTER TABLE `database_backups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `event_categories`
--
ALTER TABLE `event_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `event_organiser`
--
ALTER TABLE `event_organiser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `event_tags`
--
ALTER TABLE `event_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `event_venues`
--
ALTER TABLE `event_venues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `faq_categories`
--
ALTER TABLE `faq_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `messengers`
--
ALTER TABLE `messengers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `mobile_app_configs`
--
ALTER TABLE `mobile_app_configs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mobile_app_sliders`
--
ALTER TABLE `mobile_app_sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  MODIFY `permission_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  MODIFY `role_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `module_settings`
--
ALTER TABLE `module_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post_categories`
--
ALTER TABLE `post_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_custom_fields`
--
ALTER TABLE `product_custom_fields`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  MODIFY `permission_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `seos`
--
ALTER TABLE `seos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `setup_guides`
--
ALTER TABLE `setup_guides`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `social_media`
--
ALTER TABLE `social_media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `themes`
--
ALTER TABLE `themes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `timezones`
--
ALTER TABLE `timezones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=851;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_device_tokens`
--
ALTER TABLE `user_device_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_plans`
--
ALTER TABLE `user_plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
