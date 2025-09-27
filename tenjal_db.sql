-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2025 at 06:28 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tenjal_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `views` int(11) DEFAULT 0,
  `author` varchar(100) DEFAULT 'admin',
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `content`, `image`, `views`, `author`, `created_at`) VALUES
(1, 'How Alkaline Mineral Water Benefits Your General Well-being?', 'Which, in many cases, \"creates inflammation which then directly impacts the hair growth cycle,\" he said, and then continued about the idea behind drinking alkaline water, which is that \"you\'re giving your body a high level of alkaline minerals ready to be used to neutralise those acids so that your body does not have to steal them from other organ systems like your bones, internal organ development, or skin and hair,\" he said......', 'uploads/1758947993_blog-1.jpg', 1000, 'admin', '2018-01-20'),
(2, 'Why Is Drinking RO Water A Terrible Idea', 'When it comes to water, RO is unfortunately a popular option. And this very popularity comes at a terrible cost to its consumers, while the financial expenses are partly what makes up this \"cost\", other humongous sacrifices are being made too when drinking RO water. What RO water is in simple terms is how Brij Mohan Sharma of The Society of Pollution and Environment Conservation Scientists (SPECS) described it in a Down To Earth article, \"It is dead water. It can be used in batteries but not for drinking\"....', 'uploads/1758948014_a (2).jpg', 1000, 'admin', '2018-01-20'),
(3, 'Installation Cost & Maintenance', 'The most obvious issue with RO systems is their costs. And not just of buying one but also of the maintenance costs that keep adding up. For how much the expenses are, they don\'t offer enough in return, not enough to justify the costs. And unfortunately, it\'s worse than just that, on top of all that they are quite detrimental as well. The damages drinking RO water causes to one\'s health are quite terrible, and the extent of which in some cases is even surprising.', 'uploads/1758948025_about.jpg', 1000, 'admin', '2018-01-20'),
(4, 'What is BPA and Why You Need to Be Concerned About It?', 'BPA is a solvent used to improve the durability and transparency of plastics. Although useful for products such as water bottles, toys, and food storage containers, studies show that these plastic containers have the potential to leach into food and beverages.This is especially likely if the plastic is heated, like when you microwave food in it. It is wrong and clear. While it\'s useful in making products like water bottles, toys, and food containers, studies show that BPA can get into the food and drinks stored in these plastics.', 'uploads/1758948043_a (5).jpg', 1000, 'admin', '2018-01-20'),
(5, 'Scientific studies have highlighted several health issues linked to regular BPA exposure.', 'Hormonal disorders: Hormonal disorders are among the top health risks linked to BPA exposure. BPA functions similarly to the body\'s natural hormone, estrogen. This could cause irregularities by interfering with your hormone system\'s regular operation.Problems with Children\'s Development: As a child grows older, exposure to BPA may affect their behaviour and brain development. Land Pollution: BPA-containing plastics often end up in landfills. When this plastic breaks down, it releases BPA into soil and water, harming wildlife and ecosystems. Water Pollution: BPA-containing plastics frequently find their way into rivers, lakes, and seas, where they contaminate them. Aquatic life and marine habitats are impacted by this contamination.', 'uploads/1758948054_a (1).jpg', 1000, 'admin', '2018-01-20'),
(6, 'What Does BPA-Free Mean', 'When something is labelled as BPA-free, it means the plastic does not contain bisphenol-A. This makes the product safer for holding food and drinks. You might see this label on water bottles, lunch boxes, and baby bottles.Families can improve general health and adopt safer habits by choosing BPA-free products. By learning about BPA and choosing safer options, families can avoid potential risks and create a healthier lifestyle. These goods are more than just a fad; they are a significant step toward a better quality of life. BPA-free products are not just a trend, they are a step toward better health for everyone.', 'uploads/1758948065_blog-2.jpg', 1000, 'admin', '2018-01-20'),
(7, 'hello', 'sharad', 'uploads/a (5).jpg', 0, 'admin', '2025-09-27');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `slug`, `title`, `content`, `image`) VALUES
(1, 'about', 'Welcome to Tenjal', 'At Tenjal, we believe that clean, pure, and refreshing water is the foundation of a healthy lifestyle. Established with a commitment to providing the highest quality mineral water, Tenjal is a brand that stands for purity, trust, and sustainability. Our water comes from the finest natural sources, carefully filtered and enriched with essential minerals to ensure a crisp and refreshing taste in every drop.', 'uploads/about.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `description`, `image`) VALUES
(1, 'Source Water Collection', 'Premium groundwater sourced from protected aquifers, ensuring consistent and mineral content.', 'uploads/1758980012_insta5.png'),
(2, 'Pre-Filtration', 'Initial filtration to remove large particles, sediments, and visible impurities from source water.', 'uploads/1758979945_hero-slider-2.jpg'),
(3, 'Carbon Filtration', 'Activated carbon filters remove chlorine, organic compounds, and improve taste and odor.', 'uploads/1758979935_about.jpg'),
(4, 'Reverse Osmosis', 'Advanced RO technology removes dissolved salts, heavy metals, and microscopic contaminants.', 'uploads/1758979924_gallery-5.jpg'),
(5, 'UV Sterilization', 'Ultraviolet light treatment eliminates bacteria, viruses, and other harmful microorganisms.', 'uploads/1758979913_a (3).jpg'),
(6, 'Ozone Treatment', 'Ozone disinfection provides additional protection against pathogens and extends shelf life.', 'uploads/1758979905_about.jpg'),
(7, 'Mineral Balancing', 'Essential minerals are added back to ensure optimal taste and health benefits.', 'uploads/1758979894_a (5).jpg'),
(8, 'Quality Testing & Bottling', 'Final quality checks and automated bottling in sterile conditions with tamper-proof sealing.', 'uploads/1758972583_about.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `alt_text` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `image`, `alt_text`) VALUES
(8, 'slider_1758988831.jpg', NULL),
(10, 'slider_1758988859.jpg', NULL),
(11, 'slider_1758988868.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `name`, `designation`, `image`) VALUES
(1, 'Lily Taylor', 'Hair Specialist', 'uploads/team-1.jpg'),
(2, 'Olivia Smith', 'Nail Designer', 'uploads/team-2.jpg'),
(3, 'Ava Brown', 'Beauty Specialist', 'uploads/team-3.jpg'),
(4, 'Amelia Jones', 'Spa Specialist', 'uploads/team-4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `quote` text NOT NULL,
  `client_name` varchar(100) NOT NULL,
  `profession` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `quote`, `client_name`, `profession`, `image`) VALUES
(1, 'Tenjal Mineral Water has become a staple in my daily routine. As someone who works long hours, staying hydrated is key, and Tenjal makes it easy. I love that it\'s naturally filtered and packed with essential minerals.', 'John Doe', 'Designer', 'uploads/1758948278_gallery-1.jpg'),
(2, 'I\'ve been drinking Tenjal Mineral Water for the past few months, and I can genuinely say it\'s made a difference in how I feel every day. The refreshing taste is unlike any other water I\'ve tried—crisp, clean, and smooth with no aftertaste.', 'Jane Smith', 'Manager', 'uploads/1758948264_a (5).jpg'),
(3, 'Tenjal Mineral Water has become a staple in my daily routine. As someone who works long hours, staying hydrated is key, and Tenjal makes it easy. I love that it\'s naturally filtered and packed with essential minerals.', 'Mike Johnson', 'Engineer', 'uploads/1758948255_about.jpg'),
(4, 'I\'ve been drinking Tenjal Mineral Water for the past few months, and I can genuinely say it\'s made a difference in how I feel every day. The refreshing taste is unlike any other water I\'ve tried—crisp, clean, and smooth with no aftertaste.', 'Sarah Wilson', 'Consultant', 'uploads/1758948247_a (2).jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
