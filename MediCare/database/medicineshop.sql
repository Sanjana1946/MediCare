-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2023 at 07:51 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medicineshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(10) NOT NULL,
  `customerid` int(10) UNSIGNED NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `customerid`, `date`) VALUES
(23, 7, '2019-07-05 15:21:55'),
(24, 7, '2019-07-05 15:22:25'),
(25, 7, '2019-07-05 15:22:55'),
(26, 6, '2019-07-05 16:32:04'),
(27, 19, '2023-04-13 14:58:42'),
(28, 19, '2023-04-13 14:58:42'),
(29, 19, '2023-04-13 14:59:52'),
(30, 19, '2023-04-13 14:59:52'),
(31, 19, '2023-04-14 05:49:31'),
(32, 19, '2023-04-15 12:31:11'),
(33, 19, '2023-04-17 12:24:05'),
(34, 19, '2023-04-17 12:24:05'),
(35, 19, '2023-04-17 13:38:38'),
(36, 19, '2023-04-17 13:38:38'),
(37, 19, '2023-04-17 13:44:42'),
(38, 19, '2023-04-17 13:44:42');

-- --------------------------------------------------------

--
-- Table structure for table `cartitems`
--

CREATE TABLE `cartitems` (
  `id` int(10) NOT NULL,
  `cartid` int(10) UNSIGNED NOT NULL,
  `productid` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `quantity` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `cartitems`
--

INSERT INTO `cartitems` (`id`, `cartid`, `productid`, `quantity`) VALUES
(24, 23, '978-0-321-94786-4', 1),
(25, 23, '9781409178811', 1),
(26, 23, '978-1-484217-26-9', 5),
(27, 26, '978-1-44937-019-0', 10),
(28, 27, '978-1-4571-0402-2', 1),
(29, 27, '978-1-484217-26-9', 2),
(30, 27, '978-1-484216-40-8', 1),
(31, 27, '2345', 1),
(32, 27, '4000', 1),
(33, 27, '4545', 5),
(34, 27, '4000', 1),
(35, 27, '2345', 1),
(36, 27, '4000', 1),
(37, 27, '1946', 4),
(38, 27, '1088', 1),
(39, 27, '1946', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryid` int(10) NOT NULL,
  `category_name` varchar(60) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryid`, `category_name`) VALUES
(12, 'Tablet'),
(13, 'Capsule'),
(16, 'Syrup'),
(47, 'Oral Powder');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) NOT NULL,
  `firstname` varchar(40) NOT NULL,
  `lastname` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `address` varchar(120) NOT NULL,
  `city` varchar(40) NOT NULL,
  `zipcode` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `firstname`, `lastname`, `email`, `password`, `address`, `city`, `zipcode`) VALUES
(8, 'Sanjana', 'Raha', 'sanjanaraha@gmail.com', 'raha', '97 c block', 'Dhaka', '1234'),
(17, 'Sanjana', 'Binte', 'raha33@gmail.com', '1234', '88 b block', 'Dhaka', '1234'),
(18, 'fardin', 'fahad', 'fardin@gmail.com', '12345', '97 c block', 'Dhaka', '1234'),
(19, '', '', 'fardinx@gmail.com', 'fardin', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `expert`
--

CREATE TABLE `expert` (
  `name` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `pass` varchar(40) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `expert`
--

INSERT INTO `expert` (`name`, `pass`) VALUES
('expert', 'expert');

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `name` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `pass` varchar(40) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`name`, `pass`) VALUES
('manager', 'manager');

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `med_ndc` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `med_name` varchar(60) COLLATE latin1_general_ci DEFAULT NULL,
  `weight` varchar(60) COLLATE latin1_general_ci DEFAULT NULL,
  `med_image` varchar(40) COLLATE latin1_general_ci DEFAULT NULL,
  `med_descr` longtext COLLATE latin1_general_ci DEFAULT NULL,
  `med_price` decimal(6,2) DEFAULT NULL,
  `supplierid` int(10) UNSIGNED DEFAULT NULL,
  `categoryid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`med_ndc`, `med_name`, `weight`, `med_image`, `med_descr`, `med_price`, `supplierid`, `categoryid`) VALUES
('1088', 'Comprid', '80 mg', 'Comprid_80-300x300.jpg', 'Comprid™ is indicated as an adjunct to diet and exercise to improve glycemic control in adults with type 2 diabetes (T2DM). The usual initial dose of Comprid™ is 40 to 80 mg daily, gradually increased, if necessary up to 320 mg daily until adequate control is achieved. A single dose should not exceed 160 mg. When higher doses are required it should be taken twice daily, according to the main meals of the day. For extended release tablet the initial recommended dose is 30 mg daily, even in elderly patients (>65 years); the daily dose may vary from 30 to 120 mg taken orally, once daily. Comprid™ XR should be taken with food because there is increased risk of hypoglycemia if a meal is taken late. It is recommended that the medication be taken at breakfast time. If a dose is forgott', '8.00', 14, 0),
('1946', 'ORSaline-N', '10.25 gm', 'smc-orsaline-n-20-pcs.jpg', 'Orsaline a liquid formulation made by mixing salts (of which the important one is common salt) and sugar which is used to compensate for the loss of excessive fluid (water and salts) from the body that occurs during an episode of severe watery diarrhoea as exemplified by cholera.', '6.00', 17, 0),
('2000', 'Cosec', '20 mg', 'cosec-cap.jpg', 'It is used for duodenal and Gastric Ulcers, NSAID-induced gastric and duodenal ulcers, Reflux Oesophagitis, GERD (Gastroesophageal Reflux Disease), eradication of H. pylori with appropriate antibiotics &Zollinger-Ellison Syndrome.', '5.00', 19, 0),
('2345', 'Maxpro', '20 mg', 'Maxpro-20-Tablet.jpg', 'Maxpro 20 is a proton pump inhibitor that inhibits the H+/K+-ATPase in the gastric parietal cell, suppressing gastric acid output. The first single optical isomer of a proton pump inhibitor, esomeprazole (S-isomer of omeprazole), provides superior acid control than racemic proton pump inhibitors.\r\n\r\nMaxpro 20 Tablets contain an enteric-coated pellet version of esomeprazole magnesium for improved absorption. Peak plasma levels (Cmax) occur roughly 1.5 hours after oral dosing (Tmax). When the dose is increased, the Cmax increases correspondingly, and the area under the plasma concentration-time curve (AUC) increases thrice from 20 to 40 mg. The systemic bioavailability with repeated once-daily doses is around 90%, compared to 64% after a single dose. When compared to fasting conditions, the AUC following a single dosage of esomeprazole is reduced by 33-53 percent after food ingestion. At least one hour before meals, esomeprazole should be consumed.\r\n\r\nEsomeprazole binds to plasma proteins 97 percent of the time. Over a concentration range of 2 20 mmol/L, plasma protein binding remains constant. In healthy volunteers, the apparent volume of distribution at steady state is around 16 L.\r\n\r\nEsomeprazole binds to plasma proteins 97 percent of the time. Over a concentration range of 2 20 mmol/L, plasma protein binding remains constant. In healthy volunteers, the apparent volume of distribution at steady state is around 16 L.\r\n\r\nEsomeprazole is extensively processed by the cytochrome P450 (CYP) enzyme system in the liver. Esomeprazole\'s metabolites have no anti-secretory properties. The CYP2C19 isoenzyme, which creates the hydroxy and desmethyl metabolites, is responsible for the majority of esomeprazole metabolism. The sulphone metabolite is formed by CYP3A4, which is responsible for the remaining proportion.', '7.00', 15, 13),
('4000', 'Omidon', '60 ml', 'Omidon Suspension 60ml-400x400.jpg', 'Omidon 60ml Syrup is a prokinetic. It works on the region in the brain that controls vomiting. It also acts on the upper digestive tract to increase the movement of the stomach and intestines, allowing food to move more easily through the stomach.', '36.00', 16, 16),
('4444', 'Fexo', '120 mg', 'FEXO-120.jpg', 'Fexo 120 mg Tablet is an effective and potent anti-allergic medicine consists of Fexofenadine. It is used to treat allergic symptoms like runny nose, watery eyes, sneezing, itching, hives, etc., associated with Rhinitis (hey fever) and Urticaria (skin allergy). Fexo 120 mg Tablet works by stopping the release of histamine (a chemical substance that causes allergic symptoms). \r\n\r\nFexo 120 mg Tablet shows some common side effects like drowsiness, fever, rash, weakness, etc. Consult your doctor if these symptoms persist for a long time. Do not take this medicine if you are previously allergic to it. If you feel dizzy or tired after taking this medicine, avoid driving vehicles or operating heavy machines. Fexo 120 mg Tablet is not recommended for use in children below 12 years of age.\r\n\r\nFexo 120 mg Tablet can be taken with or without food. Your doctor will decide the dose based on your health condition. Finish your entire course of treatment with Fexo 120 mg Tablet, even if the condition gets better after taking a few doses. If you still feel unwell after completing your treatment course, consult your doctor.\r\n\r\nFexo 120 mg Tablet has to be used with caution if you are pregnant or are breastfeeding. Inform your doctor if you have any liver or kidney problems. Do not give your medicine to other people even if the symptoms appear similar.', '9.00', 14, 0),
('4545', 'Napa', '500 mg', 'napa-tablet-500mg-10-tablets.jpg', 'Paracetamol is indicated for fever, common cold and influenza, headache, toothache, earache, bodyache, myalgia, neuralgia, dysmenorrhoea, sprains, colic pain, back pain, post-operative pain, postpartum pain, inflammatory pain and post vaccination pain in children. It is also indicated for rheumatic & osteoarthritic pain and stiffness of joints.\r\n\r\nPharmacology\r\n\r\nParacetamol has analgesic and antipyretic properties with weak anti-inflammatory activity. Paracetamol (Acetaminophen) is thought to act primarily in the CNS, increasing the pain threshold by inhibiting both isoforms of cyclooxygenase, COX-1, COX-2, and COX-3 enzymes involved in prostaglandin (PG) synthesis. Paracetamol is a para aminophenol derivative, has analgesic and antipyretic properties with weak anti-inflammatory activity. Paracetamol is one of the most widely used, safest and fast acting analgesic. It is well tolerated and free from various side effects of aspirin.', '12.00', 14, 12),
('9999', 'Filmet', '200 mg', 'Filmet-600x600.jpg', 'Filmet 200 is an antibiotic medicine that helps your body fight infections caused by bacteria and parasites. It is used to treat infections of the liver, stomach, intestines, vagina, brain, heart, lungs, bones and skin. Filmet 200 helps prevent an infection after surgery. It is also used in the treatment of dental infections, leg ulcers and pressure sores. This medicine is best taken after eating some food. It should be taken at the same time each day to get the most benefit. The amount you are advised will depend on what you are being treated for and how bad it is, but you should take this antibiotic exactly as prescribed by your doctor. Your symptoms may get better after a short time but do not stop taking it until you have finished a full course of treatment, even if you feel well. If you stop taking it early, some bacteria may survive, and the infection may come back. Do not drink any alcohol while taking this medicine and for a few days after stopping it. Otherwise, you may get unpleasant side effects like nausea, vomiting and stomach pain. The most common side effects of this medicine are headache, dryness in mouth, nausea, and a slight metallic taste in the mouth. These are usually mild but let your doctor know if they bother you or last more than a few days. You can try using sugarless candies or lozenges to overcome any dryness or metallic taste in the mouth. Before using this medicine, inform your doctor if you are allergic to any medicine or have any kidney or liver problems or any disease of the nervous system. Your doctor may change the dose or prescribe a different medicine. If you are pregnant or breastfeeding, inform your doctor before taking this medicine.', '1.00', 18, 0);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplierid` int(11) NOT NULL,
  `supplier_name` varchar(60) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplierid`, `supplier_name`) VALUES
(1, 'Eskayef Pharmaceuticals Ltd.'),
(5, 'Aristopharma Ltd.'),
(14, 'Square'),
(15, 'Renata pharmaceutical Ltd'),
(16, 'Incepta pharmaceutical Ltd'),
(17, 'ACME Laboratories Ltd.'),
(18, 'Beximco'),
(19, 'Drug International Ltd.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cartitems`
--
ALTER TABLE `cartitems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryid`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`med_ndc`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplierid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `cartitems`
--
ALTER TABLE `cartitems`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplierid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
