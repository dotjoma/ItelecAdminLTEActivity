-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2025 at 12:45 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbbaste`
--

-- --------------------------------------------------------

--
-- Table structure for table `aboutus`
--

CREATE TABLE `aboutus` (
  `aboutid` int(11) NOT NULL,
  `atitle` varchar(255) NOT NULL,
  `acontent` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `date_posted` date DEFAULT NULL,
  `story` text DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `author`, `date_posted`, `story`, `picture`) VALUES
(4, 'Marcos eases Taiwan travel curbs for PH officials to boost investments', 'Darryl John Esguerra', '2025-04-21', 'MANILA – President Ferdinand R. Marcos Jr. has relaxed long-standing travel restrictions for Philippine government officials to Taiwan, aiming to maximize opportunities for the development and expansion of the country’s priority areas of investments.\r\n\r\nMarcos signed Memorandum Circular (MC) 32 on April 15, reducing the travel limitations that were first imposed under Executive Order (EO) 313 in 1989 during the administration of former president Corazon Aquino. A copy of the memorandum was made public on Monday.\r\n\r\nEO 313 had prohibited all Philippine government officials from undertaking official visits to Taiwan, receiving Taiwanese officials, or conducting any official activity related to Taiwan without clearance from the Department of Foreign Affairs (DFA).\r\n\r\nUnder the new policy, MC 32 limits travel restrictions to the President, Vice President, Secretary of Foreign Affairs, and Secretary of National Defense.\r\n\r\nGovernment officials intending to visit Taiwan for economic, trade and investment purposes are mandated to use their “ordinary passports and without using their official titles.”\r\n\r\nAdditionally, officials are required to inform and coordinate with the Manila Economic and Cultural Office (MECO), the Philippines’ de facto embassy in Taiwan, before their trip. The policy also enables Philippine officials to host Taiwanese delegations for economic talks, provided MECO is notified at least five days in advance.\r\n\r\nHowever, the circular maintains that no official agreements, memoranda of understanding, or similar documents can be signed with Taiwanese entities without prior approval from the DFA and, when necessary, the Office of the President. (PNA)', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aboutus`
--
ALTER TABLE `aboutus`
  ADD PRIMARY KEY (`aboutid`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aboutus`
--
ALTER TABLE `aboutus`
  MODIFY `aboutid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
