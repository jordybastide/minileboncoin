-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: database
-- Generation Time: Jun 15, 2021 at 08:10 PM
-- Server version: 5.7.33
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `symfony`
--

-- --------------------------------------------------------

--
-- Table structure for table `ad`
--

CREATE TABLE `ad` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `price` int(11) NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` int(11) DEFAULT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ad`
--

INSERT INTO `ad` (`id`, `title`, `content`, `short_description`, `created_at`, `updated_at`, `price`, `city`, `phone`, `thumbnail`, `user_id`) VALUES
(18, 'test', 'test', 'test', '2021-06-01 19:25:41', NULL, 300, 'test', 987890987, '/header_image_uploads/7c935e6d30066ee922e622e6f2e26f3f.jpg', 5),
(20, '2 pièces - 50m² - 500€ -  Clermont-Ferrand 63000', 'F2 avec parking\r\n- 50m² env.\r\n- Terrasse 16m²\r\n- 10mins a pied du TRAM\r\n\r\nMerci de faire parvenir un dossier complet par mail\r\n- Copie du passeport ou pièce d\'identité de l\'ensemble des occupants\r\n- 2 Derniers avis d\'imposition\r\n- 3 Derniers bulletins de Salaire\r\n- Caution exigée avec l\'ensemble des documents ci dessus.', '2 pièces - 50m² - 500€ -  Clermont-Ferrand 63000', '2021-06-07 18:00:07', '2021-06-07 18:01:14', 500, 'Clermont-Ferrand', 387654321, '/header_image_uploads/8b631d0ead98582479d4a186df1b060c.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ad_category`
--

CREATE TABLE `ad_category` (
  `ad_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ad_category`
--

INSERT INTO `ad_category` (`ad_id`, `category_id`) VALUES
(18, 2),
(20, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `thumbnail`) VALUES
(1, 'Immobilier', '/header_image_uploads/c98a64b6ab98ee99abc9da12ad744b40.jpg'),
(2, 'test', '/header_image_uploads/5a0b883bc228572d096e7289d2e8bc80.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210521163258', '2021-05-21 18:33:08', 64),
('DoctrineMigrations\\Version20210521163356', '2021-05-21 18:34:00', 53),
('DoctrineMigrations\\Version20210521163430', '2021-05-21 18:34:34', 151),
('DoctrineMigrations\\Version20210521163602', '2021-05-21 18:36:05', 58),
('DoctrineMigrations\\Version20210525222222', '2021-05-26 00:22:33', 215);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nickname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `nickname`, `firstname`, `lastname`) VALUES
(1, 'bastidejordy@gmail.com', '[\"ROLE_ADMIN\"]', '$argon2id$v=19$m=65536,t=4,p=1$AsnlkTX6X3xXClTXpjVBEw$BGyGzoCo/Feqp/lI5jZfNPks6i7jw5xZgKIIRAdkBn8', 'jeej', 'jeej', 'jeej'),
(5, 'test1@test.com', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$CN27FqUM8woU1FezDf0f+g$vWm0Raiw+WhV5HA1VUNid+IJg4MfWRDGQBFfUNOQc7k', 'test', 'test', 'test');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ad`
--
ALTER TABLE `ad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_77E0ED58A76ED395` (`user_id`);

--
-- Indexes for table `ad_category`
--
ALTER TABLE `ad_category`
  ADD PRIMARY KEY (`ad_id`,`category_id`),
  ADD KEY `IDX_EC5414114F34D596` (`ad_id`),
  ADD KEY `IDX_EC54141112469DE2` (`category_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ad`
--
ALTER TABLE `ad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ad`
--
ALTER TABLE `ad`
  ADD CONSTRAINT `FK_77E0ED58A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `ad_category`
--
ALTER TABLE `ad_category`
  ADD CONSTRAINT `FK_EC54141112469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_EC5414114F34D596` FOREIGN KEY (`ad_id`) REFERENCES `ad` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
