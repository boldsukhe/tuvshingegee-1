-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2025 at 04:48 PM
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
-- Database: `tuvshingegee_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `ajilbar`
--

CREATE TABLE `ajilbar` (
  `ner` varchar(255) DEFAULT NULL,
  `tusuv_id` int(11) DEFAULT NULL,
  `ded_group` int(11) DEFAULT NULL,
  `udriin_tuluv` varchar(255) DEFAULT NULL,
  `geodyse_hyanalt` varchar(255) DEFAULT NULL,
  `mashin_mechanism_uuriin` varchar(255) DEFAULT NULL,
  `mashin_mechanism_uuriin_tsag` int(11) DEFAULT NULL,
  `mashin_mechanism_turees` varchar(255) DEFAULT NULL,
  `mashin_mechanism_turees_tsag` int(11) DEFAULT NULL,
  `ajillasan_uuriin_hun` varchar(255) DEFAULT NULL,
  `ajillasan_turees_hun` varchar(255) DEFAULT NULL,
  `ashiglasan_material` varchar(255) DEFAULT NULL,
  `material_too_hemjee` int(11) DEFAULT NULL,
  `hyanalt_hiigdsen_eseh` varchar(255) DEFAULT NULL,
  `anhaarah_zuil` varchar(255) DEFAULT NULL,
  `tailbar` varchar(255) DEFAULT NULL,
  `ajliin_dugaar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ajilbar`
--

INSERT INTO `ajilbar` (`ner`, `tusuv_id`, `ded_group`, `udriin_tuluv`, `geodyse_hyanalt`, `mashin_mechanism_uuriin`, `mashin_mechanism_uuriin_tsag`, `mashin_mechanism_turees`, `mashin_mechanism_turees_tsag`, `ajillasan_uuriin_hun`, `ajillasan_turees_hun`, `ashiglasan_material`, `material_too_hemjee`, `hyanalt_hiigdsen_eseh`, `anhaarah_zuil`, `tailbar`, `ajliin_dugaar`) VALUES
('boldoo', NULL, NULL, '2025-04-01', 'Тийм', 'Индүү', 5, 'Индүү', 3, 'Б.Дорж', '0', '', 10, 'тийм', 'baihgui', 'baihgui', NULL),
(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('boldoo', 0, 0, '2025-04-01', 'Тийм', 'Индүү', 5, 'Индүү', 3, 'Б.Дорж', '0', '', 10, 'тийм', 'baihgui', 'baihgui', NULL),
(NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('test', 0, 0, '2025-04-15', 'Тийм', 'Индүү', 5, 'Индүү', 5, 'Б.Дорж', '0', 'hairga', 10, 'тийм', 'baihgui', 'baihgui', NULL),
(NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('test', 0, 0, '2025-04-15', 'Тийм', 'Индүү', 5, 'Индүү', 5, 'Б.Дорж', '0', 'hairga', 10, 'тийм', 'baihgui', 'baihgui', NULL),
(NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('test', 0, 0, '2025-04-15', 'Тийм', 'Индүү', 5, 'Индүү', 5, 'Б.Дорж', '0', 'hairga', 10, 'тийм', 'baihgui', 'baihgui', NULL),
(NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('boldoo', 2, 171657, '2025-04-15', 'Тийм', 'Индүү', 5, 'Индүү', 1, 'Б.Дорж', '0', 'hairga', 100, 'тийм', 'baihgui', 'qaeqwe', NULL),
(NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('boldoo', 0, 0, '2025-04-01', 'Тийм', 'Индүү', 5, 'Индүү', 3, 'Б.Дорж', '0', 'hairga', 10, 'тийм', 'baihgui', 'baihgui', NULL),
(NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('qwer', 0, 0, '2025-04-01', 'Тийм', 'Индүү', 5, 'Индүү', 3, 'Б.Дорж', '0', 'hairga', 10, 'тийм', 'baihgui', 'baihgui', NULL),
(NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('qwer123', 0, 0, '2025-04-01', 'Тийм', 'Индүү', 5, 'Индүү', 3, 'Б.Дорж', '0', 'hairga', 10, 'тийм', 'baihgui', 'baihgui', NULL),
(NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('qwer1234', 0, 0, '2025-04-01', 'Тийм', 'Индүү', 5, 'Индүү', 3, 'Б.Дорж', '0', 'hairga', 10, 'тийм', 'baihgui', 'baihgui', NULL),
(NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('qwer12345', 0, 0, '2025-04-01', 'Тийм', 'Индүү', 5, 'Индүү', 3, 'Б.Дорж', '0', 'hairga', 10, 'тийм', 'baihgui', 'baihgui', NULL),
(NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('boldoo123', 2, 171657, '', 'Тийм', 'Индүү', 5, 'Индүү', 3, 'Б.Дорж', '0', '', 1, 'тийм', '1', '1', NULL),
(NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('rrrr', 2, 171657, 'Тийм', 'Индүү', '5', 0, '3', 0, 'Ж.Тулга', '0', '1', 0, '1', '1', 'Гэрийн шал, мод, давхарга ачих', ''),
(NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL),
('qqqqqqq', 2, 171657, '2025-04-30', 'Тийм', 'Индүү', 1, 'Индүү', 1, 'Б.Дорж', '0', '1', 1, 'тийм', '1', '1', 'Гэрийн шал, мод, давхарга ачих'),
(NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('111111', 2, 171657, '2025-04-30', 'Үгүй', 'Индүү', 11111, 'Индүү', 11111, 'Б.Дорж', '0', '111', 111, 'тийм', '111', '111', 'Гэрийн шал, мод, давхарга ачих'),
(NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('111111', 2, 171657, '2025-04-30', 'Үгүй', 'Индүү', 11111, 'Индүү', 11111, 'Б.Дорж', '0', '111', 111, 'тийм', '111', '111', 'Гэрийн шал, мод, давхарга ачих'),
(NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('222222222', 2, 171657, '2025-04-30', 'Үгүй', 'Индүү', 11111, 'Индүү', 11111, 'Б.Дорж', '0', '111', 111, 'тийм', '111', '111', 'Гэрийн шал, мод, давхарга ачих'),
(NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('3333333333', 2, 171657, '2025-04-30', 'Тийм', 'Индүү', 5, 'Индүү', 5, 'Б.Дорж', '0', '5', 5, 'тийм', '5', '5', 'Гэрийн шал, мод, давхарга ачих'),
(NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('4444444444', 2, 171657, '2025-04-15', 'Тийм', 'Индүү', 5, 'Индүү', 5, 'Б.Дорж', '0', '5', 5, 'тийм', 'qweqwe', 'qweqweqwe', 'Гэрийн шал, мод, давхарга ачих'),
(NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('5555555555', 2, 171657, '2025-04-30', 'Тийм', 'Индүү', 2, 'Индүү', 2, 'Б.Дорж', '0', '2', 2, 'тийм', '2', '2', 'Гэрийн шал, мод, давхарга ачих'),
(NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('5555555555', 2, 171657, '2025-04-30', 'Тийм', 'Индүү', 2, 'Индүү', 2, 'Б.Дорж', 'Ж.Тулга', '2', 2, 'тийм', '2', '2', 'Гэрийн шал, мод, давхарга ачих'),
(NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('666666666', 2, 171657, '2025-04-21', 'Тийм', 'Индүү', 5, 'Индүү', 5, 'Б.Дорж', 'Ж.Тулга', 'hairga', 10, 'тийм', 'qweqwe', 'qweqweqwe', 'Гэрийн шал, мод, давхарга ачих'),
(NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('777777777777777', 2, 171657, '', 'Тийм', 'Индүү', 5, 'Индүү', 11111, 'Б.Дорж', 'Ж.Тулга', 'els', 100, 'тийм', '111', 'baihgui', 'Гэрийн шал, мод, давхарга ачих'),
(NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('boldoo', 2, 171657, '2025-04-17', 'Тийм', 'Усны машин', 5, 'Усны машин', 5, 'Б.Дорж', 'Ж.Тулга', '111', 100, 'тийм', 'baihgui', 'baihgui', 'Гэрийн шал, мод, давхарга ачих'),
(NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('610', 2, 171658, '2025-04-09', 'Тийм', 'Индүү', 5, 'Индүү', 5, 'Б.Дорж', 'Ж.Тулга', '5', 5, 'тийм', '5', '5', 'Буйрны шороо 10м-т зөөж авчрах'),
(NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('615', 2, 171658, '2025-04-23', 'Тийм', 'Индүү', 1, 'Индүү', 1, 'Б.Дорж', 'Ж.Тулга', '1', 1, 'тийм', '1', '1', 'Буйрны шороо 10м-т зөөж авчрах'),
(NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('615', 2, 171658, '2025-04-23', 'Тийм', 'Индүү', 1, 'Индүү', 1, 'Б.Дорж', 'Ж.Тулга', '1', 1, 'тийм', '1', '1', 'Буйрны шороо 10м-т зөөж авчрах'),
(NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('624', 2, 171657, '', 'Тийм', 'Индүү', 1, 'Индүү', 1, 'Б.Дорж', 'Ж.Тулга', '1', 1, 'тийм', '1', '1', 'Гэрийн шал, мод, давхарга ачих'),
(NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('632', 2, 171657, '', 'Тийм', 'Усны машин', 10, 'Индүү', 5, 'Б.Дорж', 'Ж.Тулга', 'els', 10, 'тийм', 'baihgui', 'baihgui', 'Гэрийн шал, мод, давхарга ачих'),
(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('650', 2, 171657, '2025-04-02', 'Тийм', 'Индүү', 4, 'Индүү', 4, 'Б.Дорж', 'Ж.Тулга', '4', 4, 'тийм', '4', '4', 'Гэрийн шал, мод, давхарга ачих'),
(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('711', 2, 171657, '2025-04-01', 'Тийм', 'Индүү', 2, 'Индүү', 5, 'Б.Дорж', 'Ж.Тулга', '1', 1, 'тийм', '1', '1', 'Гэрийн шал, мод, давхарга ачих'),
(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('717', 2, 171657, '2025-04-01', 'Тийм', 'Индүү', 2, 'Индүү', 2, 'Б.Дорж', 'Ж.Тулга', '2', 2, 'тийм', '2', '2', 'Гэрийн шал, мод, давхарга ачих');

-- --------------------------------------------------------

--
-- Table structure for table `buleg`
--

CREATE TABLE `buleg` (
  `buleg_id` int(11) NOT NULL,
  `utga` varchar(64) NOT NULL,
  `1` varchar(256) NOT NULL,
  `2` varchar(256) NOT NULL,
  `3` varchar(256) NOT NULL,
  `4` varchar(256) NOT NULL,
  `5` varchar(256) NOT NULL,
  `6` varchar(256) NOT NULL,
  `7` varchar(256) NOT NULL,
  `8` varchar(256) NOT NULL,
  `9` varchar(256) NOT NULL,
  `10` varchar(256) NOT NULL,
  `11` varchar(256) NOT NULL,
  `12` varchar(256) NOT NULL,
  `13` varchar(256) NOT NULL,
  `14` varchar(256) NOT NULL,
  `15` varchar(256) NOT NULL,
  `16` varchar(256) NOT NULL,
  `17` varchar(256) NOT NULL,
  `18` varchar(256) NOT NULL,
  `19` varchar(256) NOT NULL,
  `20` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buleg`
--

INSERT INTO `buleg` (`buleg_id`, `utga`, `1`, `2`, `3`, `4`, `5`, `6`, `7`, `8`, `9`, `10`, `11`, `12`, `13`, `14`, `15`, `16`, `17`, `18`, `19`, `20`) VALUES
(250101, 'Гэр барих', '171657', '171658', '171659', '171660', '171661', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(250102, 'Гэр буулгах', '1716105', '171657', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `ded_buleg`
--

CREATE TABLE `ded_buleg` (
  `ded_buleg_id` int(11) NOT NULL,
  `utga` varchar(256) NOT NULL,
  `1` varchar(256) NOT NULL,
  `2` varchar(256) NOT NULL,
  `3` varchar(256) NOT NULL,
  `4` varchar(256) NOT NULL,
  `5` varchar(256) NOT NULL,
  `6` varchar(256) NOT NULL,
  `7` varchar(256) NOT NULL,
  `8` varchar(256) NOT NULL,
  `9` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ded_buleg`
--

INSERT INTO `ded_buleg` (`ded_buleg_id`, `utga`, `1`, `2`, `3`, `4`, `5`, `6`, `7`, `8`, `9`) VALUES
(171657, 'Гэр тээврийн хэрэгсэлд ачих, буулгах', 'Гэрийн шал, мод, давхарга ачих', 'Буулгах', '', '', '', '', '', '', ''),
(171658, 'Гэрийн шалны буйр засч тэгшлэх', 'Буйрны шороо 10м-т зөөж авчрах', 'Буйранд шороо асгаж тэгшлэх', '', '', '', '', '', '', ''),
(171659, 'Гэрийн шал байрлуулах', 'Шалны мод 10м-т зөөж авчрах', 'Шал байрлуулах', '', '', '', '', '', '', ''),
(171660, 'Гэр барих', 'Бусад хэрэгсэлийг 10м-т зөөж авчрах', 'Гэр барих', '', '', '', '', '', '', ''),
(171661, 'Цахилгааны холболт хийх', 'Цахилгааны монтаж хийх', '', '', '', '', '', '', '', ''),
(1716105, 'Гэр буулгах', '5 ханатай гэр буулгах', 'Гэр тээврийн хэрэгсэлд ачих, буулгах', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `excel_data`
--

CREATE TABLE `excel_data` (
  `group_name` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_cost` int(11) NOT NULL,
  `total_cost` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `excel_data`
--

INSERT INTO `excel_data` (`group_name`, `name`, `quantity`, `unit_cost`, `total_cost`, `start_date`, `end_date`, `id`) VALUES
(250001, '', 15, 30, 450, '2025-04-03', '2025-04-24', 1),
(250101, 'Гэр барих', 123, 123123, 15144129, '2025-04-02', '2025-04-03', 2),
(250102, 'Гэр буулгах', 123, 123123, 15144129, '2025-04-02', '2025-04-03', 3),
(250101, 'Гэр барих', 155, 1, 155, '2025-04-24', '2025-04-26', 4),
(250101, 'Гэр барих', 155, 1, 155, '2025-04-24', '2025-04-26', 5),
(250101, 'Гэр барих', 1, 1, 1, '2025-04-03', '2025-04-04', 6),
(250101, 'Гэр барих', 1, 1, 1, '2025-04-03', '2025-04-04', 7),
(250102, 'Гэр буулгах', 10, 5, 50, '2025-04-09', '2025-04-25', 8);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tusuv_oruulah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `tusuv_oruulah`) VALUES
('tuvshin_1', 'ex54qw61ip', 1),
('tuvshin_2', 'password123', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buleg`
--
ALTER TABLE `buleg`
  ADD PRIMARY KEY (`buleg_id`);

--
-- Indexes for table `ded_buleg`
--
ALTER TABLE `ded_buleg`
  ADD PRIMARY KEY (`ded_buleg_id`);

--
-- Indexes for table `excel_data`
--
ALTER TABLE `excel_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `excel_data`
--
ALTER TABLE `excel_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
