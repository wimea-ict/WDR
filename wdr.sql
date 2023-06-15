-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 15, 2023 at 09:43 AM
-- Server version: 8.0.33-0ubuntu0.20.04.2
-- PHP Version: 7.4.3-4ubuntu2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wdr`
--

-- --------------------------------------------------------

--
-- Table structure for table `archivedekadalformreportdata`
--

CREATE TABLE `archivedekadalformreportdata` (
  `id` bigint NOT NULL,
  `Date` date NOT NULL,
  `station` int DEFAULT NULL,
  `MAX_TEMP` varchar(255) DEFAULT NULL,
  `MIN_TEMP` varchar(255) DEFAULT NULL,
  `DRY_BULB_0600Z` varchar(255) DEFAULT NULL,
  `WET_BULB_0600Z` varchar(255) DEFAULT NULL,
  `DEW_POINT_0600Z` varchar(255) DEFAULT NULL,
  `RELATIVE_HUMIDITY_0600Z` varchar(255) DEFAULT NULL,
  `WIND_DIRECTION_0600Z` varchar(255) DEFAULT NULL,
  `WIND_SPEED_0600Z` varchar(255) DEFAULT NULL,
  `RAINFALL_0600Z` varchar(255) DEFAULT NULL,
  `DRY_BULB_1200Z` varchar(255) DEFAULT NULL,
  `WET_BULB_1200Z` varchar(255) DEFAULT NULL,
  `DEW_POINT_1200Z` varchar(255) DEFAULT NULL,
  `RELATIVE_HUMIDITY_1200Z` varchar(255) DEFAULT NULL,
  `WIND_DIRECTION_1200Z` varchar(255) DEFAULT NULL,
  `WIND_SPEED_1200Z` varchar(255) DEFAULT NULL,
  `Dekadalnumber` int NOT NULL,
  `AD_SubmittedBy` varchar(255) NOT NULL,
  `submitedBy_Id` int NOT NULL,
  `Approved` varchar(225) NOT NULL,
  `ApprovedBy` varchar(100) DEFAULT NULL,
  `qaBy` varchar(100) DEFAULT NULL,
  `CreationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `numberofcomments` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `archivedekadalformreportdata`
--

INSERT INTO `archivedekadalformreportdata` (`id`, `Date`, `station`, `MAX_TEMP`, `MIN_TEMP`, `DRY_BULB_0600Z`, `WET_BULB_0600Z`, `DEW_POINT_0600Z`, `RELATIVE_HUMIDITY_0600Z`, `WIND_DIRECTION_0600Z`, `WIND_SPEED_0600Z`, `RAINFALL_0600Z`, `DRY_BULB_1200Z`, `WET_BULB_1200Z`, `DEW_POINT_1200Z`, `RELATIVE_HUMIDITY_1200Z`, `WIND_DIRECTION_1200Z`, `WIND_SPEED_1200Z`, `Dekadalnumber`, `AD_SubmittedBy`, `submitedBy_Id`, `Approved`, `ApprovedBy`, `qaBy`, `CreationDate`, `numberofcomments`) VALUES
(7, '2020-08-26', 4, '5', '76', '5', '6', '6', '2', '7', '65', '67', '5', '4', '4', '4', '4', '4', 2, 'Andrew Mwesigwa', 77, 'FALSE', NULL, NULL, '2021-01-03 14:55:26', 0);

-- --------------------------------------------------------

--
-- Table structure for table `archivemetarformdata`
--

CREATE TABLE `archivemetarformdata` (
  `Date` date NOT NULL,
  `id` bigint NOT NULL,
  `station` int NOT NULL,
  `TIME` varchar(225) NOT NULL,
  `METARSPECI` varchar(225) NOT NULL,
  `CCCC` varchar(225) DEFAULT NULL,
  `YYGGgg` varchar(225) DEFAULT NULL,
  `Dddfffmfm` varchar(225) DEFAULT NULL,
  `WWorCAVOK` varchar(225) DEFAULT NULL,
  `W1W1` varchar(225) DEFAULT NULL,
  `NlCCNmCCNhCC` varchar(225) DEFAULT NULL,
  `TTTdTd` varchar(225) DEFAULT NULL,
  `Qnhhpa` varchar(225) DEFAULT NULL,
  `Qnhin` varchar(225) DEFAULT NULL,
  `Qfehpa` varchar(225) DEFAULT NULL,
  `Qfein` varchar(225) DEFAULT NULL,
  `REW1W1` varchar(225) DEFAULT NULL,
  `AM_SubmittedBy` varchar(225) NOT NULL,
  `submitedBy_Id` int NOT NULL,
  `Approved` varchar(225) NOT NULL,
  `ApprovedBy` varchar(100) DEFAULT NULL,
  `qaBy` varchar(100) DEFAULT NULL,
  `CreationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `numberofcomments` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `archivemetarformdata`
--

INSERT INTO `archivemetarformdata` (`Date`, `id`, `station`, `TIME`, `METARSPECI`, `CCCC`, `YYGGgg`, `Dddfffmfm`, `WWorCAVOK`, `W1W1`, `NlCCNmCCNhCC`, `TTTdTd`, `Qnhhpa`, `Qnhin`, `Qfehpa`, `Qfein`, `REW1W1`, `AM_SubmittedBy`, `submitedBy_Id`, `Approved`, `ApprovedBy`, `qaBy`, `CreationDate`, `numberofcomments`) VALUES
('2021-01-04', 67, 4, '0530Z', 'METAR', 'HUJI', '040530Z', '65', '65', '65', '65', '65', '65', '65', '65', '65', 'er', 'Andrew Mwesigwa', 77, 'FALSE', NULL, NULL, '2021-01-03 14:47:54', 1);

-- --------------------------------------------------------

--
-- Table structure for table `archivemonthlyrainfallformreportdata`
--

CREATE TABLE `archivemonthlyrainfallformreportdata` (
  `id` bigint NOT NULL,
  `Date` date DEFAULT NULL,
  `month` varchar(100) DEFAULT NULL,
  `year` varchar(100) DEFAULT NULL,
  `station` int NOT NULL,
  `Rainfall` varchar(225) NOT NULL,
  `AR_SubmittedBy` varchar(225) NOT NULL,
  `submitedBy_Id` int NOT NULL,
  `Approved` varchar(225) NOT NULL,
  `ApprovedBy` varchar(100) DEFAULT NULL,
  `qaBy` varchar(100) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `CreationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `numberofcomments` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `archivemonthlyrainfallformreportdata`
--

INSERT INTO `archivemonthlyrainfallformreportdata` (`id`, `Date`, `month`, `year`, `station`, `Rainfall`, `AR_SubmittedBy`, `submitedBy_Id`, `Approved`, `ApprovedBy`, `qaBy`, `comment`, `CreationDate`, `numberofcomments`) VALUES
(32, '2021-01-01', 'January', '2021', 4, '4.7', 'Andrew Mwesigwa', 77, 'FALSE', NULL, NULL, NULL, '2021-01-23 22:43:14', 0),
(100, '2021-02-02', 'February', '2021', 4, '6456', 'Andrew Mwesigwa', 77, 'TRUE', NULL, NULL, NULL, '2021-02-01 21:13:29', 0);

-- --------------------------------------------------------

--
-- Table structure for table `archiveobservationslipformdata`
--

CREATE TABLE `archiveobservationslipformdata` (
  `Date` date NOT NULL,
  `id` bigint NOT NULL,
  `station` int NOT NULL,
  `TIME` varchar(225) NOT NULL,
  `TotalAmountOfAllClouds` varchar(225) DEFAULT NULL,
  `TotalAmountOfLowClouds` varchar(225) DEFAULT NULL,
  `TypeOfLowClouds1` varchar(225) DEFAULT NULL,
  `OktasOfLowClouds1` varchar(225) DEFAULT NULL,
  `HeightOfLowClouds1` varchar(225) DEFAULT NULL,
  `CLCODEOfLowClouds1` varchar(225) DEFAULT NULL,
  `TypeOfLowClouds2` varchar(255) DEFAULT NULL,
  `OktasOfLowClouds2` varchar(255) DEFAULT NULL,
  `HeightOfLowClouds2` varchar(255) DEFAULT NULL,
  `CLCODEOfLowClouds2` varchar(255) DEFAULT NULL,
  `TypeOfLowClouds3` varchar(255) DEFAULT NULL,
  `OktasOfLowClouds3` varchar(255) DEFAULT NULL,
  `HeightOfLowClouds3` varchar(255) DEFAULT NULL,
  `CLCODEOfLowClouds3` varchar(255) DEFAULT NULL,
  `TypeOfMediumClouds1` varchar(225) DEFAULT NULL,
  `OktasOfMediumClouds1` varchar(225) DEFAULT NULL,
  `HeightOfMediumClouds1` varchar(225) DEFAULT NULL,
  `CLCODEOfMediumClouds1` varchar(225) DEFAULT NULL,
  `TypeOfMediumClouds2` varchar(255) DEFAULT NULL,
  `OktasOfMediumClouds2` varchar(255) DEFAULT NULL,
  `HeightOfMediumClouds2` varchar(255) DEFAULT NULL,
  `CLCODEOfMediumClouds2` varchar(255) DEFAULT NULL,
  `TypeOfMediumClouds3` varchar(255) DEFAULT NULL,
  `OktasOfMediumClouds3` varchar(255) DEFAULT NULL,
  `HeightOfMediumClouds3` varchar(255) DEFAULT NULL,
  `CLCODEOfMediumClouds3` varchar(255) DEFAULT NULL,
  `TypeOfHighClouds1` varchar(225) DEFAULT NULL,
  `OktasOfHighClouds1` varchar(225) DEFAULT NULL,
  `HeightOfHighClouds1` varchar(225) DEFAULT NULL,
  `CLCODEOfHighClouds1` varchar(225) DEFAULT NULL,
  `TypeOfHighClouds2` varchar(255) DEFAULT NULL,
  `OktasOfHighClouds2` varchar(255) DEFAULT NULL,
  `HeightOfHighClouds2` varchar(255) DEFAULT NULL,
  `CLCODEOfHighClouds2` varchar(255) DEFAULT NULL,
  `TypeOfHighClouds3` varchar(255) DEFAULT NULL,
  `OktasOfHighClouds3` varchar(255) DEFAULT NULL,
  `HeightOfHighClouds3` varchar(255) DEFAULT NULL,
  `CLCODEOfHighClouds3` varchar(255) DEFAULT NULL,
  `CloudSearchLightReading` varchar(225) DEFAULT NULL,
  `Rainfall` varchar(225) DEFAULT NULL,
  `Dry_Bulb` varchar(225) DEFAULT NULL,
  `Wet_Bulb` varchar(225) DEFAULT NULL,
  `Max_Read` varchar(225) DEFAULT NULL,
  `Max_Reset` varchar(225) DEFAULT NULL,
  `Min_Read` varchar(225) DEFAULT NULL,
  `Min_Reset` varchar(225) DEFAULT NULL,
  `Piche_Read` varchar(225) DEFAULT NULL,
  `Piche_Reset` varchar(225) DEFAULT NULL,
  `TimeMarksThermo` varchar(225) DEFAULT NULL,
  `TimeMarksHygro` varchar(225) DEFAULT NULL,
  `TimeMarksRainRec` varchar(225) DEFAULT NULL,
  `Present_Weather` varchar(225) DEFAULT NULL,
  `Visibility` varchar(225) DEFAULT NULL,
  `Wind_Direction` varchar(225) DEFAULT NULL,
  `Wind_Speed` varchar(225) DEFAULT NULL,
  `Gusting` varchar(225) DEFAULT NULL,
  `AttdThermo` varchar(225) DEFAULT NULL,
  `PrAsRead` varchar(225) DEFAULT NULL,
  `Correction` varchar(225) DEFAULT NULL,
  `CLP` varchar(225) DEFAULT NULL,
  `MSLPr` varchar(225) DEFAULT NULL,
  `TimeMarksBarograph` varchar(225) DEFAULT NULL,
  `TimeMarksAnemograph` varchar(225) DEFAULT NULL,
  `OtherTMarks` varchar(255) DEFAULT NULL,
  `Remarks` varchar(255) DEFAULT NULL,
  `AO_SubmittedBy` varchar(225) NOT NULL,
  `submitedBy_Id` int NOT NULL,
  `Approved` varchar(225) NOT NULL,
  `ApprovedBy` varchar(100) DEFAULT NULL,
  `qaBy` varchar(100) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `CreationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `numberofcomments` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `archiveobservationslipformdata`
--

INSERT INTO `archiveobservationslipformdata` (`Date`, `id`, `station`, `TIME`, `TotalAmountOfAllClouds`, `TotalAmountOfLowClouds`, `TypeOfLowClouds1`, `OktasOfLowClouds1`, `HeightOfLowClouds1`, `CLCODEOfLowClouds1`, `TypeOfLowClouds2`, `OktasOfLowClouds2`, `HeightOfLowClouds2`, `CLCODEOfLowClouds2`, `TypeOfLowClouds3`, `OktasOfLowClouds3`, `HeightOfLowClouds3`, `CLCODEOfLowClouds3`, `TypeOfMediumClouds1`, `OktasOfMediumClouds1`, `HeightOfMediumClouds1`, `CLCODEOfMediumClouds1`, `TypeOfMediumClouds2`, `OktasOfMediumClouds2`, `HeightOfMediumClouds2`, `CLCODEOfMediumClouds2`, `TypeOfMediumClouds3`, `OktasOfMediumClouds3`, `HeightOfMediumClouds3`, `CLCODEOfMediumClouds3`, `TypeOfHighClouds1`, `OktasOfHighClouds1`, `HeightOfHighClouds1`, `CLCODEOfHighClouds1`, `TypeOfHighClouds2`, `OktasOfHighClouds2`, `HeightOfHighClouds2`, `CLCODEOfHighClouds2`, `TypeOfHighClouds3`, `OktasOfHighClouds3`, `HeightOfHighClouds3`, `CLCODEOfHighClouds3`, `CloudSearchLightReading`, `Rainfall`, `Dry_Bulb`, `Wet_Bulb`, `Max_Read`, `Max_Reset`, `Min_Read`, `Min_Reset`, `Piche_Read`, `Piche_Reset`, `TimeMarksThermo`, `TimeMarksHygro`, `TimeMarksRainRec`, `Present_Weather`, `Visibility`, `Wind_Direction`, `Wind_Speed`, `Gusting`, `AttdThermo`, `PrAsRead`, `Correction`, `CLP`, `MSLPr`, `TimeMarksBarograph`, `TimeMarksAnemograph`, `OtherTMarks`, `Remarks`, `AO_SubmittedBy`, `submitedBy_Id`, `Approved`, `ApprovedBy`, `qaBy`, `comment`, `CreationDate`, `numberofcomments`) VALUES
('2020-02-14', 6, 4, '0500Z', '', '', '2', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2', '', '', '', '', '', '2', '', '44', '', 'RA', '33', '22', '22', '22', '', '2', '22', '2', '11', '', '22', '', '', 'Jasper Ainebyona', 0, 'FALSE', 'Andrew Mwesigwa', NULL, NULL, '2020-02-14 14:37:25', 0),
('2020-12-10', 37, 0, '0600Z', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 'Racheal Nabadda', 0, 'FALSE', NULL, 'Andrew Mwesigwa', '  the comment', '2020-12-10 10:55:37', 0),
('2020-12-01', 38, 13, '0030Z', '', '', '', '', '16000', '', '', '', '', '', '', '', '', '', '', '', '12000', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '67', '56', '55', '36', '', '11', '', '', '', '', '', '', 'TS', '2000', '456', '2000', '6000', '545', '44', '68', '35', '34', '36', '67', '44', NULL, 'Andrew Mwesigwa', 0, 'FALSE', NULL, 'Andrew Mwesigwa', '  the comment', '2020-12-15 13:21:47', 0),
('2021-01-26', 39, 4, '0230Z', '2', '5', '3', '4', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '34', '44', '2', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Andrew Mwesigwa', 77, 'FALSE', NULL, NULL, NULL, '2021-01-03 14:22:36', 0);

-- --------------------------------------------------------

--
-- Table structure for table `archivescannnedfiles`
--

CREATE TABLE `archivescannnedfiles` (
  `id` int NOT NULL,
  `file` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `record_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `archivescannnedfiles`
--

INSERT INTO `archivescannnedfiles` (`id`, `file`, `description`, `record_id`) VALUES
(1, 'scannedObservationslip2020-05-29.docx', 'preliminary pages', '680ObservationSlip_20200529014008am'),
(65, 'scannedmonthlyrainfall2021-01-03.pdf', 'trial file', 'monthlyrainfall_20210103023351pm'),
(66, 'yearlyrainfall2021-01-03.pdf', 'trial file', 'yearlyrainfall_20210103023632pm');

-- --------------------------------------------------------

--
-- Table structure for table `archivesynopticformreportdata`
--

CREATE TABLE `archivesynopticformreportdata` (
  `id` int NOT NULL,
  `Date` date NOT NULL,
  `station` int NOT NULL,
  `TIME` varchar(50) NOT NULL,
  `UWS` varchar(25) DEFAULT NULL,
  `BN` varchar(25) DEFAULT NULL,
  `IOOP` varchar(25) DEFAULT NULL,
  `TSPPW` varchar(25) DEFAULT NULL,
  `HLC` varchar(25) DEFAULT NULL,
  `HV` varchar(25) DEFAULT NULL,
  `TCC` varchar(25) DEFAULT NULL,
  `WD` varchar(25) DEFAULT NULL,
  `WS` varchar(25) DEFAULT NULL,
  `GI1_1` varchar(25) DEFAULT NULL,
  `SignOfData_1` varchar(25) DEFAULT NULL,
  `Air_temperature` varchar(25) DEFAULT NULL,
  `GI2_1` varchar(25) DEFAULT NULL,
  `SignOfData_2` varchar(25) DEFAULT NULL,
  `Dewpoint_temperature` varchar(25) DEFAULT NULL,
  `GI3_1` varchar(25) DEFAULT NULL,
  `PASL` varchar(25) DEFAULT NULL,
  `GI4_1` varchar(25) DEFAULT NULL,
  `SIS` varchar(25) DEFAULT NULL,
  `GSIS` varchar(25) DEFAULT NULL,
  `GI6_1` varchar(25) DEFAULT NULL,
  `AOP` varchar(25) DEFAULT NULL,
  `DPOP` varchar(25) DEFAULT NULL,
  `GI7_1` varchar(25) DEFAULT NULL,
  `Present_Weather` varchar(25) DEFAULT NULL,
  `Past_Weather` varchar(25) DEFAULT NULL,
  `GI8_1` varchar(25) DEFAULT NULL,
  `AOC` varchar(25) DEFAULT NULL,
  `CLOG` varchar(25) DEFAULT NULL,
  `CGOG` varchar(25) DEFAULT NULL,
  `CHOG` varchar(25) DEFAULT NULL,
  `Section_Indicator333` varchar(25) DEFAULT NULL,
  `GI0_1` varchar(25) DEFAULT NULL,
  `GMT` varchar(25) DEFAULT NULL,
  `CIOP` varchar(25) DEFAULT NULL,
  `BEOP` varchar(25) DEFAULT NULL,
  `ThunderStorm` varchar(11) DEFAULT NULL,
  `HailStorm` varchar(11) DEFAULT NULL,
  `Fog` varchar(11) DEFAULT NULL,
  `EarthQuake` varchar(11) DEFAULT NULL,
  `Anemometer_Reading` varchar(11) DEFAULT NULL,
  `Actual_Rainfall` varchar(10) DEFAULT NULL,
  `GI1_2` varchar(25) DEFAULT NULL,
  `SignOfData_3` varchar(25) DEFAULT NULL,
  `Max_TempTx` varchar(25) DEFAULT NULL,
  `GI2_2` varchar(25) DEFAULT NULL,
  `SignOfData_4` varchar(25) DEFAULT NULL,
  `Max_TempTn` varchar(25) DEFAULT NULL,
  `GI5_1` varchar(25) DEFAULT NULL,
  `AOE` varchar(25) DEFAULT NULL,
  `ITI` varchar(25) DEFAULT NULL,
  `GI55` varchar(25) DEFAULT NULL,
  `DOS` varchar(25) DEFAULT NULL,
  `GI5_2` varchar(25) DEFAULT NULL,
  `SPC` varchar(12) DEFAULT NULL,
  `PCI24Hrs` varchar(25) DEFAULT NULL,
  `GI6_2` varchar(25) DEFAULT NULL,
  `AOP_2` varchar(25) DEFAULT NULL,
  `DPOP_2` varchar(25) DEFAULT NULL,
  `GI8_2` varchar(25) DEFAULT NULL,
  `AICL` varchar(25) DEFAULT NULL,
  `GOC` varchar(12) DEFAULT NULL,
  `HBCLOM` varchar(25) DEFAULT NULL,
  `GI8_3` varchar(25) DEFAULT NULL,
  `AICL_2` varchar(25) DEFAULT NULL,
  `GOC_2` varchar(25) DEFAULT NULL,
  `HBCLOM_2` varchar(25) DEFAULT NULL,
  `GI8_4` varchar(25) DEFAULT NULL,
  `AICL_3` varchar(25) DEFAULT NULL,
  `GOC_3` varchar(25) DEFAULT NULL,
  `HBCLOM_3` varchar(25) DEFAULT NULL,
  `GI8_5` varchar(25) DEFAULT NULL,
  `AICL_4` varchar(25) DEFAULT NULL,
  `GOC_4` varchar(25) DEFAULT NULL,
  `HBCLOM_4` varchar(25) DEFAULT NULL,
  `GI9` varchar(25) DEFAULT NULL,
  `Supp_Info` varchar(25) DEFAULT NULL,
  `Section_Indicator555` varchar(25) DEFAULT NULL,
  `GI1_3` varchar(25) DEFAULT NULL,
  `SignOfData_5` varchar(25) DEFAULT NULL,
  `Wetbulb_Temp` varchar(25) DEFAULT NULL,
  `R_Humidity` varchar(25) DEFAULT NULL,
  `V_Pressure` varchar(25) DEFAULT NULL,
  `remarks` text,
  `time_` time DEFAULT NULL,
  `ObserverOnDuty` varchar(30) DEFAULT NULL,
  `to_` varchar(30) DEFAULT NULL,
  `from_` varchar(30) DEFAULT NULL,
  `Approved` varchar(15) NOT NULL,
  `AS_SubmittedBy` varchar(20) NOT NULL,
  `submitedBy_Id` int NOT NULL,
  `ApprovedBy` varchar(100) DEFAULT NULL,
  `qaBy` varchar(100) DEFAULT NULL,
  `CreationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `numberofcomments` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `archivesynopticformreportdata`
--

INSERT INTO `archivesynopticformreportdata` (`id`, `Date`, `station`, `TIME`, `UWS`, `BN`, `IOOP`, `TSPPW`, `HLC`, `HV`, `TCC`, `WD`, `WS`, `GI1_1`, `SignOfData_1`, `Air_temperature`, `GI2_1`, `SignOfData_2`, `Dewpoint_temperature`, `GI3_1`, `PASL`, `GI4_1`, `SIS`, `GSIS`, `GI6_1`, `AOP`, `DPOP`, `GI7_1`, `Present_Weather`, `Past_Weather`, `GI8_1`, `AOC`, `CLOG`, `CGOG`, `CHOG`, `Section_Indicator333`, `GI0_1`, `GMT`, `CIOP`, `BEOP`, `ThunderStorm`, `HailStorm`, `Fog`, `EarthQuake`, `Anemometer_Reading`, `Actual_Rainfall`, `GI1_2`, `SignOfData_3`, `Max_TempTx`, `GI2_2`, `SignOfData_4`, `Max_TempTn`, `GI5_1`, `AOE`, `ITI`, `GI55`, `DOS`, `GI5_2`, `SPC`, `PCI24Hrs`, `GI6_2`, `AOP_2`, `DPOP_2`, `GI8_2`, `AICL`, `GOC`, `HBCLOM`, `GI8_3`, `AICL_2`, `GOC_2`, `HBCLOM_2`, `GI8_4`, `AICL_3`, `GOC_3`, `HBCLOM_3`, `GI8_5`, `AICL_4`, `GOC_4`, `HBCLOM_4`, `GI9`, `Supp_Info`, `Section_Indicator555`, `GI1_3`, `SignOfData_5`, `Wetbulb_Temp`, `R_Humidity`, `V_Pressure`, `remarks`, `time_`, `ObserverOnDuty`, `to_`, `from_`, `Approved`, `AS_SubmittedBy`, `submitedBy_Id`, `ApprovedBy`, `qaBy`, `CreationDate`, `numberofcomments`) VALUES
(5, '2020-12-30', 4, '1200Z', '', '63', '', '', '0', '', '', '9', '9', '1', '0', '8', '2', '0', '', '3', '', '4', '8', '', '6', '', '', '7', '', '', '8', '', '', '', '', '333', '0', '', '', '', 'false', 'false', 'false', 'false', 'false', 'false', '1', '0', '', '2', '0', '', '5', '', '', '55', '', '5', '', '', '6', '', '', '8', '', '', '', '8', '', '', '', '8', '', '', '', '8', '', '', '', '9', '', '555', '1', '0', '', '', '', '', '00:00:00', '', '', '', 'FALSE', 'Andrew Mwesigwa', 77, NULL, NULL, '2021-01-03 14:51:10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `archiveweathersummaryformreportdata`
--

CREATE TABLE `archiveweathersummaryformreportdata` (
  `id` int NOT NULL,
  `Date` date NOT NULL,
  `station` int NOT NULL,
  `TEMP_MAX` varchar(25) DEFAULT NULL,
  `TEMP_MIN` varchar(25) DEFAULT NULL,
  `SUNSHINE` varchar(25) DEFAULT NULL,
  `DB_0600Z` varchar(25) DEFAULT NULL,
  `WB_0600Z` varchar(25) DEFAULT NULL,
  `DP_0600Z` varchar(25) DEFAULT NULL,
  `VP_0600Z` varchar(25) DEFAULT NULL,
  `RH_0600Z` varchar(25) DEFAULT NULL,
  `CLP_0600Z` varchar(25) DEFAULT NULL,
  `GPM_0600Z` varchar(25) DEFAULT NULL,
  `WIND_DIR_0600Z` varchar(25) DEFAULT NULL,
  `FF_0600Z` varchar(25) DEFAULT NULL,
  `DB_1200Z` varchar(255) DEFAULT NULL,
  `WB_1200Z` varchar(255) DEFAULT NULL,
  `DP_1200Z` varchar(255) DEFAULT NULL,
  `VP_1200Z` varchar(255) DEFAULT NULL,
  `RH_1200Z` varchar(255) DEFAULT NULL,
  `CLP_1200Z` varchar(25) DEFAULT NULL,
  `GPM_1200Z` varchar(25) DEFAULT NULL,
  `WIND_DIR_1200Z` varchar(25) DEFAULT NULL,
  `FF_1200Z` varchar(25) DEFAULT NULL,
  `WIND_RUN` varchar(25) DEFAULT NULL,
  `R_F` varchar(25) DEFAULT NULL,
  `ThunderStorm` text,
  `Fog` text,
  `Haze` text,
  `HailStorm` text,
  `EarthQuake` text,
  `AW_SubmittedBy` varchar(255) NOT NULL,
  `submitedBy_Id` int NOT NULL,
  `Approved` varchar(255) NOT NULL,
  `ApprovedBy` varchar(100) DEFAULT NULL,
  `qaBy` varchar(100) DEFAULT NULL,
  `CreationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `numberofcomments` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `archiveweathersummaryformreportdata`
--

INSERT INTO `archiveweathersummaryformreportdata` (`id`, `Date`, `station`, `TEMP_MAX`, `TEMP_MIN`, `SUNSHINE`, `DB_0600Z`, `WB_0600Z`, `DP_0600Z`, `VP_0600Z`, `RH_0600Z`, `CLP_0600Z`, `GPM_0600Z`, `WIND_DIR_0600Z`, `FF_0600Z`, `DB_1200Z`, `WB_1200Z`, `DP_1200Z`, `VP_1200Z`, `RH_1200Z`, `CLP_1200Z`, `GPM_1200Z`, `WIND_DIR_1200Z`, `FF_1200Z`, `WIND_RUN`, `R_F`, `ThunderStorm`, `Fog`, `Haze`, `HailStorm`, `EarthQuake`, `AW_SubmittedBy`, `submitedBy_Id`, `Approved`, `ApprovedBy`, `qaBy`, `CreationDate`, `numberofcomments`) VALUES
(76, '2021-01-03', 4, '32', '44', '22', '22', '', '', '3', '', '3', '23', '3', '234', '34', '', '', '', '', '', '', '', '', '', '', 'false', 'false', 'false', 'false', 'false', 'Andrew Mwesigwa', 77, 'FALSE', NULL, NULL, '2021-01-03 14:43:47', 0);

-- --------------------------------------------------------

--
-- Table structure for table `aws`
--

CREATE TABLE `aws` (
  `id` int NOT NULL,
  `Date` date DEFAULT NULL,
  `Time` time DEFAULT NULL,
  `StationName` varchar(25) DEFAULT NULL,
  `StationNumber` bigint NOT NULL,
  `TXT` varchar(255) DEFAULT NULL,
  `E64` varchar(255) DEFAULT NULL,
  `IdOfTransmittingNode` int DEFAULT NULL,
  `Temperature` int DEFAULT NULL,
  `SoilTemperature` int DEFAULT NULL,
  `T_mcu` int DEFAULT NULL,
  `V_MCU` varchar(255) DEFAULT NULL,
  `P0` int DEFAULT NULL,
  `P0_lst60_02` int DEFAULT NULL,
  `P1` int DEFAULT NULL,
  `P1_t` int DEFAULT NULL,
  `P1_lst` int DEFAULT NULL,
  `Uptime` int DEFAULT NULL,
  `Error` varchar(255) DEFAULT NULL,
  `V_IN` int DEFAULT NULL,
  `A1` int DEFAULT NULL,
  `A2` int DEFAULT NULL,
  `A3` int DEFAULT NULL,
  `GW_LON` int DEFAULT NULL,
  `GW_LAT` int DEFAULT NULL,
  `P_MS5611` int DEFAULT NULL,
  `UT` int DEFAULT NULL,
  `RH_SHT2X` int DEFAULT NULL,
  `T_SHT2X` int DEFAULT NULL,
  `ADC1` int DEFAULT NULL,
  `ADC2` int DEFAULT NULL,
  `DOMAIN` varchar(25) DEFAULT NULL,
  `TZ` varchar(25) DEFAULT NULL,
  `UP` varchar(25) DEFAULT NULL,
  `T` int DEFAULT NULL,
  `PS` varchar(255) DEFAULT NULL,
  `RH` varchar(255) DEFAULT NULL,
  `V_a1` int DEFAULT NULL,
  `P0_T` int DEFAULT NULL,
  `V_A1_V_A2_005_400` int DEFAULT NULL,
  `V_AD1_100` int DEFAULT NULL,
  `V_AD2_100` int DEFAULT NULL,
  `V_AD3_100` int DEFAULT NULL,
  `V_AD1_1000` int DEFAULT NULL,
  `V_AD2_1000` int DEFAULT NULL,
  `V_AD3_1000` int DEFAULT NULL,
  `ADDR` varchar(255) DEFAULT NULL,
  `V_AD1` varchar(255) DEFAULT NULL,
  `V_AD2` varchar(255) DEFAULT NULL,
  `V_AD3` varchar(255) DEFAULT NULL,
  `SEQ` varchar(255) DEFAULT NULL,
  `TTL` varchar(255) DEFAULT NULL,
  `RSSI` varchar(255) DEFAULT NULL,
  `LQI` varchar(255) DEFAULT NULL,
  `DRP` varchar(255) DEFAULT NULL,
  `SRC` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dummy`
--

CREATE TABLE `dummy` (
  `id` int DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `elements`
--

CREATE TABLE `elements` (
  `id` int NOT NULL,
  `ElementName` varchar(30) NOT NULL,
  `InstrumentName` varchar(30) NOT NULL,
  `station` int NOT NULL COMMENT 'foreign key',
  `Abbrev` varchar(10) DEFAULT NULL,
  `Type` varchar(30) DEFAULT NULL,
  `Units` varchar(30) DEFAULT NULL,
  `Scale` varchar(30) DEFAULT NULL,
  `Limits` varchar(30) DEFAULT NULL,
  `Description` varchar(30) DEFAULT NULL,
  `SubmittedBy` varchar(30) NOT NULL,
  `CreationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `groundnode`
--

CREATE TABLE `groundnode` (
  `id` int NOT NULL,
  `station_id` int NOT NULL DEFAULT '111',
  `RTC_T` varchar(200) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `NAME` varchar(200) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `E64` varchar(200) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `V_A1` varchar(200) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `V_A2` varchar(200) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `P0_LST60` varchar(200) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `T1` varchar(200) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `RSSI` varchar(200) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `TTL` varchar(200) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `LQI` varchar(200) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `SEQ` varchar(200) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `UP_TIME` varchar(200) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `T` varchar(200) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `V_IN` varchar(200) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `V_MCU` varchar(200) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `DATE` varchar(200) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `TIME` varchar(200) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `Parameter checked` varchar(200) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'false',
  `Trend checked` varchar(10) CHARACTER SET utf8mb3 DEFAULT 'false',
  `Ignore on calc trend` varchar(10) CHARACTER SET utf8mb3 NOT NULL DEFAULT 'false',
  `hoursSinceEpoch` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `groundnode`
--

INSERT INTO `groundnode` (`id`, `station_id`, `RTC_T`, `NAME`, `E64`, `V_A1`, `V_A2`, `P0_LST60`, `T1`, `RSSI`, `TTL`, `LQI`, `SEQ`, `UP_TIME`, `T`, `V_IN`, `V_MCU`, `DATE`, `TIME`, `Parameter checked`, `Trend checked`, `Ignore on calc trend`, `hoursSinceEpoch`) VALUES
(2031763, 57, '2020-07-06,11:33:13', 'lwg-gnd', NULL, '0.14', '2.60', '0', '25.13', '27', '15', '255', '109', '4.21\nRTC_T', '0.00', '3.82', '2.92', 'Mon Jul 06 2020', '13:29:09', 'false', 'false', 'false', 442786.4860652778);

-- --------------------------------------------------------

--
-- Table structure for table `instruments`
--

CREATE TABLE `instruments` (
  `id` bigint NOT NULL,
  `InstrumentName` varchar(255) NOT NULL,
  `Station` int NOT NULL,
  `DateRegistered` date NOT NULL,
  `ExpirationDate` date NOT NULL,
  `InstrumentCode` varchar(255) NOT NULL,
  `Manufacturer` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `SubmittedBy` varchar(255) NOT NULL,
  `CreationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nodestatus`
--

CREATE TABLE `nodestatus` (
  `id` int NOT NULL,
  `V_MCU` varchar(10) NOT NULL,
  `V_IN` varchar(10) NOT NULL,
  `RSSI` varchar(10) NOT NULL,
  `LQI` varchar(10) NOT NULL,
  `DRP` varchar(10) NOT NULL,
  `SEQ` varchar(20) DEFAULT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `TXT` varchar(20) DEFAULT NULL,
  `E64` varchar(30) DEFAULT NULL,
  `StationNumber` varchar(10) DEFAULT NULL,
  `date_time_recorded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nodestatus_analyzer_checks`
--

CREATE TABLE `nodestatus_analyzer_checks` (
  `id` int NOT NULL,
  `id_first_checked` int NOT NULL,
  `id_last_checked` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `observationslip`
--

CREATE TABLE `observationslip` (
  `Date` text NOT NULL,
  `id` int NOT NULL,
  `Userid` int DEFAULT NULL,
  `station` int NOT NULL,
  `TIME` varchar(10) NOT NULL,
  `TotalAmountOfAllClouds` varchar(255) DEFAULT NULL,
  `TotalAmountOfLowClouds` varchar(100) DEFAULT NULL,
  `TypeOfLowClouds1` varchar(100) DEFAULT NULL,
  `OktasOfLowClouds1` varchar(100) DEFAULT NULL,
  `HeightOfLowClouds1` varchar(100) DEFAULT NULL,
  `CLCODEOfLowClouds1` varchar(10) DEFAULT NULL,
  `TypeOfLowClouds2` varchar(100) DEFAULT NULL,
  `OktasOfLowClouds2` varchar(100) DEFAULT NULL,
  `HeightOfLowClouds2` varchar(100) DEFAULT NULL,
  `CLCODEOfLowClouds2` varchar(10) DEFAULT NULL,
  `TypeOfLowClouds3` varchar(100) DEFAULT NULL,
  `OktasOfLowClouds3` varchar(100) DEFAULT NULL,
  `HeightOfLowClouds3` varchar(100) DEFAULT NULL,
  `CLCODEOfLowClouds3` varchar(255) DEFAULT NULL,
  `TypeOfMediumClouds1` varchar(100) DEFAULT NULL,
  `OktasOfMediumClouds1` varchar(100) DEFAULT NULL,
  `HeightOfMediumClouds1` varchar(100) DEFAULT NULL,
  `CLCODEOfMediumClouds1` varchar(10) DEFAULT NULL,
  `TypeOfMediumClouds2` varchar(100) DEFAULT NULL,
  `OktasOfMediumClouds2` varchar(100) DEFAULT NULL,
  `HeightOfMediumClouds2` varchar(100) DEFAULT NULL,
  `CLCODEOfMediumClouds2` varchar(10) DEFAULT NULL,
  `TypeOfMediumClouds3` varchar(100) DEFAULT NULL,
  `OktasOfMediumClouds3` varchar(100) DEFAULT NULL,
  `HeightOfMediumClouds3` varchar(100) DEFAULT NULL,
  `CLCODEOfMediumClouds3` varchar(11) DEFAULT NULL,
  `TypeOfHighClouds1` varchar(100) DEFAULT NULL,
  `OktasOfHighClouds1` varchar(100) DEFAULT NULL,
  `HeightOfHighClouds1` varchar(100) DEFAULT NULL,
  `CLCODEOfHighClouds1` varchar(10) DEFAULT NULL,
  `TypeOfHighClouds2` varchar(100) DEFAULT NULL,
  `OktasOfHighClouds2` varchar(100) DEFAULT NULL,
  `HeightOfHighClouds2` varchar(100) DEFAULT NULL,
  `CLCODEOfHighClouds2` varchar(10) DEFAULT NULL,
  `TypeOfHighClouds3` varchar(100) DEFAULT NULL,
  `OktasOfHighClouds3` varchar(100) DEFAULT NULL,
  `HeightOfHighClouds3` varchar(100) DEFAULT NULL,
  `CLCODEOfHighClouds3` varchar(10) DEFAULT NULL,
  `CloudSearchLightReading` varchar(255) DEFAULT NULL,
  `Rainfall` varchar(225) DEFAULT NULL,
  `Dry_Bulb` varchar(100) DEFAULT NULL,
  `Wet_Bulb` varchar(100) DEFAULT NULL,
  `Max_Read` varchar(255) DEFAULT NULL,
  `Max_Reset` varchar(255) DEFAULT NULL,
  `Min_Read` varchar(255) DEFAULT NULL,
  `Min_Reset` varchar(255) DEFAULT NULL,
  `Piche_Read` varchar(255) DEFAULT NULL,
  `Piche_Reset` varchar(255) DEFAULT NULL,
  `TimeMarksThermo` varchar(255) DEFAULT NULL,
  `TimeMarksHygro` varchar(255) DEFAULT NULL,
  `TimeMarksRainRec` varchar(255) DEFAULT NULL,
  `Present_Weather` varchar(100) DEFAULT NULL,
  `Present_WeatherCode` varchar(25) DEFAULT NULL,
  `Past_Weather` varchar(25) DEFAULT NULL,
  `Past_WeatherCode` varchar(25) DEFAULT NULL,
  `UnitOfWindSpeed` varchar(30) DEFAULT NULL,
  `Visibility` varchar(255) DEFAULT NULL,
  `Wind_Direction` varchar(255) DEFAULT NULL,
  `Wind_Speed` varchar(100) DEFAULT NULL,
  `Gusting` varchar(255) DEFAULT NULL,
  `AttdThermo` varchar(255) DEFAULT NULL,
  `PrAsRead` varchar(255) DEFAULT NULL,
  `Correction` varchar(255) DEFAULT NULL,
  `CLP` varchar(255) DEFAULT NULL,
  `MSLPr` varchar(255) DEFAULT NULL,
  `TimeMarksBarograph` varchar(255) DEFAULT NULL,
  `TimeMarksAnemograph` varchar(255) DEFAULT NULL,
  `OtherTMarks` varchar(255) DEFAULT NULL,
  `Remarks` varchar(255) DEFAULT NULL,
  `O_SubmittedBy` varchar(40) NOT NULL DEFAULT 'none',
  `Approved` varchar(5) NOT NULL DEFAULT '0',
  `ApprovedBy` varchar(100) DEFAULT NULL,
  `O_CreationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `SoilMoisture` varchar(225) DEFAULT NULL,
  `SoilTemperature` varchar(10) DEFAULT NULL,
  `sunduration` varchar(25) DEFAULT NULL,
  `trend` varchar(255) DEFAULT NULL,
  `windrun` varchar(25) DEFAULT NULL,
  `Max_temp` varchar(25) DEFAULT NULL,
  `Min_temp` varchar(25) DEFAULT NULL,
  `speciormetar` enum('metar','speci','normal') DEFAULT NULL,
  `IndOrOmissionOfPrecipitation` varchar(100) DEFAULT NULL,
  `TypeOfStation_Present_Past_Weather` varchar(30) DEFAULT NULL,
  `HeightOfLowestCloud` varchar(30) DEFAULT NULL,
  `StandardIsobaricSurface` varchar(30) DEFAULT NULL,
  `GPM` varchar(30) DEFAULT NULL,
  `DurationOfPeriodOfPrecipitation` varchar(30) DEFAULT NULL,
  `GrassMinTemp` varchar(30) DEFAULT NULL,
  `CI_OfPrecipitation` varchar(255) DEFAULT NULL,
  `BE_OfPrecipitation` varchar(255) DEFAULT NULL,
  `IndicatorOfTypeOfIntrumentation` varchar(30) DEFAULT NULL,
  `SignOfPressureChange` varchar(30) DEFAULT NULL,
  `Supp_Info` varchar(255) DEFAULT NULL,
  `VapourPressure` varchar(100) DEFAULT NULL,
  `T_H_Graph` varchar(100) DEFAULT NULL,
  `DeviceType` enum('AWS','web','mobile','desktop','sms') NOT NULL DEFAULT 'AWS',
  `Endorsed` varchar(15) DEFAULT 'NOT ENDORSED',
  `EndorsedBy` varchar(35) NOT NULL DEFAULT 'none',
  `ExpectedTime` varchar(255) NOT NULL,
  `recent_weather` varchar(100) DEFAULT NULL,
  `runwayVisualRange` varchar(100) DEFAULT NULL,
  `relative_humidity` varchar(100) DEFAULT NULL,
  `numberofcomments` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `observationslip`
--

INSERT INTO `observationslip` (`Date`, `id`, `Userid`, `station`, `TIME`, `TotalAmountOfAllClouds`, `TotalAmountOfLowClouds`, `TypeOfLowClouds1`, `OktasOfLowClouds1`, `HeightOfLowClouds1`, `CLCODEOfLowClouds1`, `TypeOfLowClouds2`, `OktasOfLowClouds2`, `HeightOfLowClouds2`, `CLCODEOfLowClouds2`, `TypeOfLowClouds3`, `OktasOfLowClouds3`, `HeightOfLowClouds3`, `CLCODEOfLowClouds3`, `TypeOfMediumClouds1`, `OktasOfMediumClouds1`, `HeightOfMediumClouds1`, `CLCODEOfMediumClouds1`, `TypeOfMediumClouds2`, `OktasOfMediumClouds2`, `HeightOfMediumClouds2`, `CLCODEOfMediumClouds2`, `TypeOfMediumClouds3`, `OktasOfMediumClouds3`, `HeightOfMediumClouds3`, `CLCODEOfMediumClouds3`, `TypeOfHighClouds1`, `OktasOfHighClouds1`, `HeightOfHighClouds1`, `CLCODEOfHighClouds1`, `TypeOfHighClouds2`, `OktasOfHighClouds2`, `HeightOfHighClouds2`, `CLCODEOfHighClouds2`, `TypeOfHighClouds3`, `OktasOfHighClouds3`, `HeightOfHighClouds3`, `CLCODEOfHighClouds3`, `CloudSearchLightReading`, `Rainfall`, `Dry_Bulb`, `Wet_Bulb`, `Max_Read`, `Max_Reset`, `Min_Read`, `Min_Reset`, `Piche_Read`, `Piche_Reset`, `TimeMarksThermo`, `TimeMarksHygro`, `TimeMarksRainRec`, `Present_Weather`, `Present_WeatherCode`, `Past_Weather`, `Past_WeatherCode`, `UnitOfWindSpeed`, `Visibility`, `Wind_Direction`, `Wind_Speed`, `Gusting`, `AttdThermo`, `PrAsRead`, `Correction`, `CLP`, `MSLPr`, `TimeMarksBarograph`, `TimeMarksAnemograph`, `OtherTMarks`, `Remarks`, `O_SubmittedBy`, `Approved`, `ApprovedBy`, `O_CreationDate`, `SoilMoisture`, `SoilTemperature`, `sunduration`, `trend`, `windrun`, `Max_temp`, `Min_temp`, `speciormetar`, `IndOrOmissionOfPrecipitation`, `TypeOfStation_Present_Past_Weather`, `HeightOfLowestCloud`, `StandardIsobaricSurface`, `GPM`, `DurationOfPeriodOfPrecipitation`, `GrassMinTemp`, `CI_OfPrecipitation`, `BE_OfPrecipitation`, `IndicatorOfTypeOfIntrumentation`, `SignOfPressureChange`, `Supp_Info`, `VapourPressure`, `T_H_Graph`, `DeviceType`, `Endorsed`, `EndorsedBy`, `ExpectedTime`, `recent_weather`, `runwayVisualRange`, `relative_humidity`, `numberofcomments`) VALUES
('2020-02-10', 558631, 63, 4, '06:00Z', '0', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '', '0', '0.0', '21', '18.5', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', '05', '44', '', NULL, '3000', '00000', '00', '0', '0', '0', '0', '', '0', '0', '0', '', '', 'Agnes Nalukwago', 'TRUE', 'MichaelLubega', '2020-02-14 10:36:43', NULL, NULL, '', NULL, '', '', '', 'normal', '', '3', '', '', '', '', '', '', '', '', '', '', '', '', 'web', 'NOT ENDORSED', 'none', '07:30Z', NULL, '0', '', 0),
('2021-01-01', 559165, 109, 13, '06:00Z', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '149', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'andrew mwesigwa', 'FALSE', NULL, '2021-03-10 08:50:31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'normal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'sms', 'NOT ENDORSED', 'none', '05:30Z', NULL, NULL, NULL, 0),
('2021-01-01', 559166, 96, 4, '06:00Z', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '149', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Andrew Mwesigwa', 'FALSE', NULL, '2021-03-10 08:50:37', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'normal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'sms', 'NOT ENDORSED', 'none', '05:30Z', NULL, NULL, NULL, 0),
('2021-03-06', 559167, 96, 4, '06:00Z', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '149', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Andrew Mwesigwa', 'FALSE', NULL, '2021-03-10 08:50:44', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'normal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'sms', 'NOT ENDORSED', 'none', '05:30Z', NULL, NULL, NULL, 0);

--
-- Triggers `observationslip`
--
DELIMITER $$
CREATE TRIGGER `update_of_data` AFTER UPDATE ON `observationslip` FOR EACH ROW BEGIN
    
    IF (NEW.TotalAmountOfAllClouds != OLD.TotalAmountOfAllClouds) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "Total amount of all clouds", OLD.TotalAmountOfAllClouds , NEW.TotalAmountOfAllClouds , NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;



IF (NEW.TIME != OLD.TIME) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "TIME", OLD.TIME , NEW.TIME , NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
    IF (NEW.TotalAmountOfLowClouds != OLD.TotalAmountOfLowClouds) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "TotalAmountOfLowClouds", OLD.TotalAmountOfLowClouds, NEW.TotalAmountOfLowClouds, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
     IF (NEW.TypeOfLowClouds1 != OLD.TypeOfLowClouds1) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "TypeOfLowClouds1", OLD.TypeOfLowClouds1, NEW.TypeOfLowClouds1, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
     IF (NEW.OktasOfLowClouds1 != OLD.OktasOfLowClouds1) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "OktasOfLowClouds1", OLD.OktasOfLowClouds1, NEW.OktasOfLowClouds1, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.HeightOfLowClouds1!= OLD.HeightOfLowClouds1) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "HeightOfLowClouds1", OLD.HeightOfLowClouds1, NEW.HeightOfLowClouds1, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.CLCODEOfLowClouds1!= OLD.CLCODEOfLowClouds1) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "CLCODEOfLowClouds1", OLD.CLCODEOfLowClouds1, NEW.CLCODEOfLowClouds1, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.TypeOfLowClouds2!= OLD.TypeOfLowClouds2) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "TypeOfLowClouds2", OLD.TypeOfLowClouds2, NEW.TypeOfLowClouds2, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.OktasOfLowClouds2!= OLD.OktasOfLowClouds2) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "OktasOfLowClouds2", OLD.OktasOfLowClouds2, NEW.OktasOfLowClouds2, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.HeightOfLowClouds2!= OLD.HeightOfLowClouds2) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "HeightOfLowClouds2", OLD.HeightOfLowClouds2, NEW.HeightOfLowClouds2, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
     IF (NEW.CLCODEOfLowClouds2!= OLD.CLCODEOfLowClouds2) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "CLCODEOfLowClouds2", OLD.CLCODEOfLowClouds2, NEW.CLCODEOfLowClouds2, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.TypeOfLowClouds3!= OLD.TypeOfLowClouds3) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "TypeOfLowClouds3", OLD.TypeOfLowClouds3, NEW.TypeOfLowClouds3, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.OktasOfLowClouds3!= OLD.OktasOfLowClouds3) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "OktasOfLowClouds3", OLD.OktasOfLowClouds3, NEW.OktasOfLowClouds3, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.HeightOfLowClouds3!= OLD.HeightOfLowClouds3) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "HeightOfLowClouds3", OLD.HeightOfLowClouds3, NEW.HeightOfLowClouds3, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
     IF (NEW.CLCODEOfLowClouds3!= OLD.CLCODEOfLowClouds3) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "CLCODEOfLowClouds3", OLD.CLCODEOfLowClouds3, NEW.CLCODEOfLowClouds3, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.TypeOfMediumClouds1!= OLD.TypeOfMediumClouds1) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "TypeOfMediumClouds1", OLD.TypeOfMediumClouds1, NEW.TypeOfMediumClouds1, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.OktasOfMediumClouds1!= OLD.OktasOfMediumClouds1) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "OktasOfMediumClouds1", OLD.OktasOfMediumClouds1, NEW.OktasOfMediumClouds1, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.HeightOfMediumClouds1!= OLD.HeightOfMediumClouds1) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "HeightOfMediumClouds1", OLD.HeightOfMediumClouds1, NEW.HeightOfMediumClouds1, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
     IF (NEW.CLCODEOfMediumClouds1!= OLD.CLCODEOfMediumClouds1) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "CLCODEOfMediumClouds1", OLD.CLCODEOfMediumClouds1, NEW.CLCODEOfMediumClouds1, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
     IF (NEW.TypeOfMediumClouds2!= OLD.TypeOfMediumClouds2) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "TypeOfMediumClouds2", OLD.TypeOfMediumClouds2, NEW.TypeOfMediumClouds2, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.OktasOfMediumClouds2!= OLD.OktasOfMediumClouds2) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "OktasOfMediumClouds2", OLD.OktasOfMediumClouds2, NEW.OktasOfMediumClouds2, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.HeightOfMediumClouds2!= OLD.HeightOfMediumClouds2) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "HeightOfMediumClouds2", OLD.HeightOfMediumClouds2, NEW.HeightOfMediumClouds2, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
     IF (NEW.CLCODEOfMediumClouds2!= OLD.CLCODEOfMediumClouds2) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "CLCODEOfMediumClouds2", OLD.CLCODEOfMediumClouds2, NEW.CLCODEOfMediumClouds2, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.TypeOfMediumClouds3!= OLD.TypeOfMediumClouds3) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "TypeOfMediumClouds3", OLD.TypeOfMediumClouds3, NEW.TypeOfMediumClouds3, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.OktasOfMediumClouds3!= OLD.OktasOfMediumClouds3) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "OktasOfMediumClouds3", OLD.OktasOfMediumClouds3, NEW.OktasOfMediumClouds3, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.HeightOfMediumClouds3!= OLD.HeightOfMediumClouds3) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "HeightOfMediumClouds3", OLD.HeightOfMediumClouds3, NEW.HeightOfMediumClouds3, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
     IF (NEW.CLCODEOfMediumClouds3!= OLD.CLCODEOfMediumClouds3) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "CLCODEOfMediumClouds3", OLD.CLCODEOfMediumClouds3, NEW.CLCODEOfMediumClouds3, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.TypeOfHighClouds1!= OLD.TypeOfHighClouds1) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "TypeOfHighClouds1", OLD.TypeOfHighClouds1, NEW.TypeOfHighClouds1, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.OktasOfHighClouds1!= OLD.OktasOfHighClouds1) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "OktasOfHighClouds1", OLD.OktasOfHighClouds1, NEW.OktasOfHighClouds1, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.HeightOfHighClouds1!= OLD.HeightOfHighClouds1) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "HeightOfHighClouds1", OLD.HeightOfHighClouds1, NEW.HeightOfHighClouds1, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
     IF (NEW.CLCODEOfHighClouds1!= OLD.CLCODEOfHighClouds1) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "CLCODEOfHighClouds1", OLD.CLCODEOfHighClouds1, NEW.CLCODEOfHighClouds1, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.TypeOfHighClouds2!= OLD.TypeOfHighClouds2) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "TypeOfHighClouds2", OLD.TypeOfHighClouds2, NEW.TypeOfHighClouds2, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.OktasOfHighClouds2!= OLD.OktasOfHighClouds2) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "OktasOfHighClouds2", OLD.OktasOfHighClouds2, NEW.OktasOfHighClouds2, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.HeightOfHighClouds2!= OLD.HeightOfHighClouds2) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "HeightOfHighClouds2", OLD.HeightOfHighClouds2, NEW.HeightOfHighClouds2, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
     IF (NEW.CLCODEOfHighClouds2!= OLD.CLCODEOfHighClouds2) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "CLCODEOfHighClouds2", OLD.CLCODEOfHighClouds2, NEW.CLCODEOfHighClouds2, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.TypeOfHighClouds3!= OLD.TypeOfHighClouds3) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "TypeOfHighClouds3", OLD.TypeOfHighClouds3, NEW.TypeOfHighClouds3, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.OktasOfHighClouds3!= OLD.OktasOfHighClouds3) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "OktasOfHighClouds3", OLD.OktasOfHighClouds3, NEW.OktasOfHighClouds3, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.HeightOfHighClouds3!= OLD.HeightOfHighClouds3) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "HeightOfHighClouds3", OLD.HeightOfHighClouds3, NEW.HeightOfHighClouds3, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
     IF (NEW.CLCODEOfHighClouds3!= OLD.CLCODEOfHighClouds3) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "CLCODEOfHighClouds3", OLD.CLCODEOfHighClouds3, NEW.CLCODEOfHighClouds3, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.CloudSearchLightReading!= OLD.CloudSearchLightReading) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "CloudSearchLightReading", OLD.CloudSearchLightReading, NEW.CloudSearchLightReading, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.Rainfall!= OLD.Rainfall) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "Rainfall", OLD.Rainfall, NEW.Rainfall, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.Dry_Bulb!= OLD.Dry_Bulb) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "Dry_Bulb", OLD.Dry_Bulb, NEW.Dry_Bulb, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.Wet_Bulb!= OLD.Wet_Bulb) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "Wet_Bulb", OLD.Wet_Bulb, NEW.Wet_Bulb, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.Max_Read!= OLD.Max_Read) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "Max_Read", OLD.Max_Read, NEW.Max_Read, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.Max_Reset!= OLD.Max_Reset) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "Max_Reset", OLD.Max_Reset, NEW.Max_Reset, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.Min_Read!= OLD.Min_Read) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "Min_Read", OLD.Min_Read, NEW.Min_Read, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.Min_Reset!= OLD.Min_Reset) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "Min_Reset", OLD.Min_Reset, NEW.Min_Reset, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.Piche_Read!= OLD.Piche_Read) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "Piche_Read", OLD.Piche_Read, NEW.Piche_Read, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.Piche_Reset!= OLD.Piche_Reset) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "Piche_Reset", OLD.Piche_Reset, NEW.Piche_Reset, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.TimeMarksThermo!= OLD.TimeMarksThermo) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "TimeMarksThermo", OLD.TimeMarksThermo, NEW.TimeMarksThermo, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.TimeMarksHygro!= OLD.TimeMarksHygro) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "TimeMarksHygro", OLD.TimeMarksHygro, NEW.TimeMarksHygro, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.TimeMarksRainRec!= OLD.TimeMarksRainRec) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "TimeMarksRainRec", OLD.TimeMarksRainRec, NEW.TimeMarksRainRec, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.Present_Weather!= OLD.Present_Weather) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "Present_Weather", OLD.Present_Weather, NEW.Present_Weather, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.Present_WeatherCode!= OLD.Present_WeatherCode) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "Present_WeatherCode", OLD.Present_WeatherCode, NEW.Present_WeatherCode, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.Past_Weather!= OLD.Past_Weather) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "Past_Weather", OLD.Past_Weather, NEW.Past_Weather, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
       IF (NEW.Visibility!= OLD.Visibility) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "Visibility", OLD.Visibility, NEW.Visibility, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.Wind_Direction!= OLD.Wind_Direction) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "Wind_Direction", OLD.Wind_Direction, NEW.Wind_Direction, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.Wind_Speed!= OLD.Wind_Speed) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "Wind_Speed", OLD.Wind_Speed, NEW.Wind_Speed, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.Gusting!= OLD.Gusting) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "Gusting", OLD.Gusting, NEW.Gusting, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.AttdThermo!= OLD.AttdThermo) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "AttdThermo", OLD.AttdThermo, NEW.AttdThermo, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
       IF (NEW.PrAsRead!= OLD.PrAsRead) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "PrAsRead", OLD.PrAsRead, NEW.PrAsRead, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.Correction!= OLD.Correction) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "Correction", OLD.Correction, NEW.Correction, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.CLP!= OLD.CLP) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "CLP", OLD.CLP, NEW.CLP, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.MSLPr!= OLD.MSLPr) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "MSLPr", OLD.MSLPr, NEW.MSLPr, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.TimeMarksBarograph!= OLD.TimeMarksBarograph) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "TimeMarksBarograph", OLD.TimeMarksBarograph, NEW.TimeMarksBarograph, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.TimeMarksAnemograph!= OLD.TimeMarksAnemograph) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "TimeMarksAnemograph", OLD.TimeMarksAnemograph, NEW.TimeMarksAnemograph, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.OthertMarks!= OLD.OthertMarks) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "OthertMarks", OLD.OthertMarks, NEW.OthertMarks, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.Remarks!= OLD.Remarks) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "Remarks", OLD.Remarks, NEW.Remarks, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.O_SubmittedBy!= OLD.O_SubmittedBy) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "SubmittedBy", OLD.O_SubmittedBy, NEW.O_SubmittedBy, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.Approved!= OLD.Approved) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "Approved", OLD.Approved, NEW.Approved, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.O_CreationDate!= OLD.O_CreationDate) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "CreationDate", OLD.O_CreationDate, NEW.O_CreationDate, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.SoilMoisture!= OLD.SoilMoisture) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "SoilMoisture", OLD.SoilMoisture, NEW.SoilMoisture, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.SoilTemperature!= OLD.SoilTemperature) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "SoilTemperature", OLD.SoilTemperature, NEW.SoilTemperature, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.sunduration!= OLD.sunduration) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "sunduration", OLD.sunduration, NEW.sunduration, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.trend!= OLD.trend) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "trend", OLD.trend, NEW.trend, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.windrun!= OLD.windrun) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "windrun", OLD.windrun, NEW.windrun, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
       IF (NEW.speciormetar!= OLD.speciormetar) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "speciormetar", OLD.speciormetar, NEW.speciormetar, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.UnitOfWindSpeed!= OLD.UnitOfWindSpeed) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "UnitOfWindSpeed", OLD.UnitOfWindSpeed, NEW.UnitOfWindSpeed, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.IndorOmissionOfprecipitation!= OLD.IndorOmissionOfprecipitation) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "IndorOmissionOfprecipitation", OLD.IndorOmissionOfprecipitation, NEW.IndorOmissionOfprecipitation, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.TypeOfStation_Present_past_Weather!= OLD.TypeOfStation_Present_past_Weather) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "TypeOfStation_Present_past_Weather", OLD.TypeOfStation_Present_past_Weather, NEW.TypeOfStation_Present_past_Weather, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.HeightOfLowestCloud!= OLD.HeightOfLowestCloud) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "HeightOfLowestCloud", OLD.HeightOfLowestCloud, NEW.HeightOfLowestCloud, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.StandardIsobaricSurface!= OLD.StandardIsobaricSurface) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "StandardIsobaricSurface", OLD.StandardIsobaricSurface, NEW.StandardIsobaricSurface, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.GPM!= OLD.GPM) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "GPM", OLD.GPM, NEW.GPM, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
       IF (NEW.DurationOfPeriodOfPrecipitation!= OLD.DurationOfPeriodOfPrecipitation) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "DurationOfPeriodOfPrecipitation", OLD.DurationOfPeriodOfPrecipitation, NEW.DurationOfPeriodOfPrecipitation, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.GrassMinTemp!= OLD.GrassMinTemp) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "GrassMinTemp", OLD.GrassMinTemp, NEW.GrassMinTemp, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.CI_OfPrecipitation!= OLD.CI_OfPrecipitation) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "CI_OfPrecipitation", OLD.CI_OfPrecipitation, NEW.CI_OfPrecipitation, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.BE_OfPrecipitation!= OLD.BE_OfPrecipitation) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "BE_OfPrecipitation", OLD.BE_OfPrecipitation, NEW.BE_OfPrecipitation, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.IndicatorOfTypeOfIntrumentation!= OLD.IndicatorOfTypeOfIntrumentation) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "IndicatorOfTypeOfIntrumentation", OLD.IndicatorOfTypeOfIntrumentation, NEW.IndicatorOfTypeOfIntrumentation, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.SignOfPressureChange!= OLD.SignOfPressureChange) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "SignOfPressureChange", OLD.SignOfPressureChange, NEW.SignOfPressureChange, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.Supp_Info!= OLD.Supp_Info) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "Supp_Info", OLD.Supp_Info, NEW.Supp_Info, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
      IF (NEW.vapourPressure!= OLD.vapourPressure) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "vapourPressure", OLD.vapourPressure, NEW.vapourPressure, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
       IF (NEW.T_H_Graph!= OLD.T_H_Graph) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "T_H_Graph", OLD.T_H_Graph, NEW.T_H_Graph, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
         IF (NEW.DeviceType!= OLD.DeviceType) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date` , `Userid`,`Action`,`Details`,`IP`,`status`) 
        VALUES 
            (NEW.id, "DeviceType", OLD.DeviceType, NEW.DeviceType, NOW(),@Userid,@Action,@Details,@IP,1);
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `observationslipFromDesktop`
--

CREATE TABLE `observationslipFromDesktop` (
  `id` int NOT NULL,
  `Date` varchar(255) NOT NULL,
  `Userid` varchar(255) DEFAULT NULL,
  `station` varchar(255) NOT NULL,
  `TIME` varchar(255) NOT NULL,
  `TotalAmountOfAllClouds` varchar(255) DEFAULT NULL,
  `TotalAmountOfLowClouds` varchar(255) DEFAULT NULL,
  `TypeOfLowClouds1` varchar(255) DEFAULT NULL,
  `OktasOfLowClouds1` varchar(255) DEFAULT NULL,
  `HeightOfLowClouds1` varchar(255) DEFAULT NULL,
  `CLCODEOfLowClouds1` varchar(255) DEFAULT '00',
  `TypeOfLowClouds2` varchar(255) DEFAULT NULL,
  `OktasOfLowClouds2` varchar(255) DEFAULT NULL,
  `HeightOfLowClouds2` varchar(255) DEFAULT NULL,
  `CLCODEOfLowClouds2` varchar(255) DEFAULT NULL,
  `TypeOfLowClouds3` varchar(255) DEFAULT NULL,
  `OktasOfLowClouds3` varchar(255) DEFAULT NULL,
  `HeightOfLowClouds3` varchar(255) DEFAULT NULL,
  `CLCODEOfLowClouds3` varchar(255) DEFAULT NULL,
  `TypeOfMediumClouds1` varchar(255) DEFAULT NULL,
  `OktasOfMediumClouds1` varchar(255) DEFAULT NULL,
  `HeightOfMediumClouds1` varchar(255) DEFAULT NULL,
  `CLCODEOfMediumClouds1` varchar(255) DEFAULT NULL,
  `TypeOfMediumClouds2` varchar(255) DEFAULT NULL,
  `OktasOfMediumClouds2` varchar(255) DEFAULT NULL,
  `HeightOfMediumClouds2` varchar(255) DEFAULT NULL,
  `CLCODEOfMediumClouds2` varchar(255) DEFAULT NULL,
  `TypeOfMediumClouds3` varchar(255) DEFAULT NULL,
  `OktasOfMediumClouds3` varchar(255) DEFAULT NULL,
  `HeightOfMediumClouds3` varchar(255) DEFAULT NULL,
  `CLCODEOfMediumClouds3` varchar(255) DEFAULT NULL,
  `TypeOfHighClouds1` varchar(255) DEFAULT NULL,
  `OktasOfHighClouds1` varchar(255) DEFAULT NULL,
  `HeightOfHighClouds1` varchar(255) DEFAULT NULL,
  `CLCODEOfHighClouds1` varchar(255) DEFAULT NULL,
  `TypeOfHighClouds2` varchar(255) DEFAULT NULL,
  `OktasOfHighClouds2` varchar(255) DEFAULT NULL,
  `HeightOfHighClouds2` varchar(255) DEFAULT NULL,
  `CLCODEOfHighClouds2` varchar(255) DEFAULT NULL,
  `TypeOfHighClouds3` varchar(255) DEFAULT NULL,
  `OktasOfHighClouds3` varchar(255) DEFAULT NULL,
  `HeightOfHighClouds3` varchar(255) DEFAULT NULL,
  `CLCODEOfHighClouds3` varchar(255) DEFAULT NULL,
  `CloudSearchLightReading` varchar(255) DEFAULT NULL,
  `Rainfall` varchar(225) DEFAULT NULL,
  `Dry_Bulb` varchar(255) DEFAULT NULL,
  `Wet_Bulb` varchar(255) DEFAULT NULL,
  `Max_Read` varchar(255) DEFAULT NULL,
  `Max_Reset` varchar(255) DEFAULT NULL,
  `Min_Read` varchar(255) DEFAULT NULL,
  `Min_Reset` varchar(255) DEFAULT NULL,
  `Piche_Read` varchar(255) DEFAULT NULL,
  `Piche_Reset` varchar(255) DEFAULT NULL,
  `TimeMarksThermo` varchar(255) DEFAULT NULL,
  `TimeMarksHygro` varchar(255) DEFAULT NULL,
  `TimeMarksRainRec` varchar(255) DEFAULT NULL,
  `Present_Weather` varchar(255) DEFAULT NULL,
  `Present_WeatherCode` varchar(255) DEFAULT NULL,
  `Past_Weather` varchar(255) DEFAULT NULL,
  `Past_WeatherCode` varchar(255) DEFAULT NULL,
  `Visibility` varchar(255) DEFAULT NULL,
  `Wind_Direction` varchar(255) DEFAULT NULL,
  `Wind_Speed` varchar(255) DEFAULT NULL,
  `Gusting` varchar(255) DEFAULT NULL,
  `AttdThermo` varchar(255) DEFAULT NULL,
  `PrAsRead` varchar(255) DEFAULT NULL,
  `Correction` varchar(255) DEFAULT NULL,
  `CLP` varchar(255) DEFAULT NULL,
  `MSLPr` varchar(255) DEFAULT NULL,
  `TimeMarksBarograph` varchar(255) DEFAULT NULL,
  `TimeMarksAnemograph` varchar(255) DEFAULT NULL,
  `OtherTMarks` varchar(255) DEFAULT NULL,
  `Remarks` varchar(255) DEFAULT NULL,
  `O_SubmittedBy` varchar(255) NOT NULL DEFAULT 'none',
  `Approved` varchar(255) NOT NULL DEFAULT '0',
  `ApprovedBy` varchar(255) NOT NULL DEFAULT '0',
  `O_CreationDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `SoilMoisture` varchar(225) DEFAULT NULL,
  `SoilTemperature` varchar(255) DEFAULT NULL,
  `sunduration` varchar(255) DEFAULT NULL,
  `trend` varchar(50) DEFAULT NULL,
  `windrun` varchar(25) DEFAULT NULL,
  `Max_temp` varchar(25) DEFAULT NULL,
  `Min_temp` varchar(25) DEFAULT NULL,
  `speciormetar` enum('metar','speci','normal') DEFAULT NULL,
  `UnitOfWindSpeed` varchar(255) DEFAULT NULL,
  `IndOrOmissionOfPrecipitation` varchar(255) DEFAULT NULL,
  `TypeOfStation_Present_Past_Weather` varchar(255) DEFAULT NULL,
  `HeightOfLowestCloud` varchar(255) DEFAULT NULL,
  `StandardIsobaricSurface` varchar(255) DEFAULT NULL,
  `GPM` varchar(255) DEFAULT NULL,
  `DurationOfPeriodOfPrecipitation` varchar(255) DEFAULT NULL,
  `GrassMinTemp` varchar(255) DEFAULT NULL,
  `CI_OfPrecipitation` varchar(255) DEFAULT NULL,
  `BE_OfPrecipitation` varchar(255) DEFAULT NULL,
  `IndicatorOfTypeOfIntrumentation` varchar(255) DEFAULT NULL,
  `SignOfPressureChange` varchar(255) DEFAULT NULL,
  `Supp_Info` varchar(255) DEFAULT NULL,
  `VapourPressure` varchar(255) DEFAULT NULL,
  `T_H_Graph` varchar(255) DEFAULT NULL,
  `DeviceType` enum('AWS','web','mobile','desktop') NOT NULL DEFAULT 'AWS',
  `Endorsed` varchar(255) DEFAULT 'NOT ENDORSED',
  `EndorsedBy` varchar(255) NOT NULL DEFAULT 'none',
  `SyncStatus` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `observationslipFromDesktop`
--

INSERT INTO `observationslipFromDesktop` (`id`, `Date`, `Userid`, `station`, `TIME`, `TotalAmountOfAllClouds`, `TotalAmountOfLowClouds`, `TypeOfLowClouds1`, `OktasOfLowClouds1`, `HeightOfLowClouds1`, `CLCODEOfLowClouds1`, `TypeOfLowClouds2`, `OktasOfLowClouds2`, `HeightOfLowClouds2`, `CLCODEOfLowClouds2`, `TypeOfLowClouds3`, `OktasOfLowClouds3`, `HeightOfLowClouds3`, `CLCODEOfLowClouds3`, `TypeOfMediumClouds1`, `OktasOfMediumClouds1`, `HeightOfMediumClouds1`, `CLCODEOfMediumClouds1`, `TypeOfMediumClouds2`, `OktasOfMediumClouds2`, `HeightOfMediumClouds2`, `CLCODEOfMediumClouds2`, `TypeOfMediumClouds3`, `OktasOfMediumClouds3`, `HeightOfMediumClouds3`, `CLCODEOfMediumClouds3`, `TypeOfHighClouds1`, `OktasOfHighClouds1`, `HeightOfHighClouds1`, `CLCODEOfHighClouds1`, `TypeOfHighClouds2`, `OktasOfHighClouds2`, `HeightOfHighClouds2`, `CLCODEOfHighClouds2`, `TypeOfHighClouds3`, `OktasOfHighClouds3`, `HeightOfHighClouds3`, `CLCODEOfHighClouds3`, `CloudSearchLightReading`, `Rainfall`, `Dry_Bulb`, `Wet_Bulb`, `Max_Read`, `Max_Reset`, `Min_Read`, `Min_Reset`, `Piche_Read`, `Piche_Reset`, `TimeMarksThermo`, `TimeMarksHygro`, `TimeMarksRainRec`, `Present_Weather`, `Present_WeatherCode`, `Past_Weather`, `Past_WeatherCode`, `Visibility`, `Wind_Direction`, `Wind_Speed`, `Gusting`, `AttdThermo`, `PrAsRead`, `Correction`, `CLP`, `MSLPr`, `TimeMarksBarograph`, `TimeMarksAnemograph`, `OtherTMarks`, `Remarks`, `O_SubmittedBy`, `Approved`, `ApprovedBy`, `O_CreationDate`, `SoilMoisture`, `SoilTemperature`, `sunduration`, `trend`, `windrun`, `Max_temp`, `Min_temp`, `speciormetar`, `UnitOfWindSpeed`, `IndOrOmissionOfPrecipitation`, `TypeOfStation_Present_Past_Weather`, `HeightOfLowestCloud`, `StandardIsobaricSurface`, `GPM`, `DurationOfPeriodOfPrecipitation`, `GrassMinTemp`, `CI_OfPrecipitation`, `BE_OfPrecipitation`, `IndicatorOfTypeOfIntrumentation`, `SignOfPressureChange`, `Supp_Info`, `VapourPressure`, `T_H_Graph`, `DeviceType`, `Endorsed`, `EndorsedBy`, `SyncStatus`) VALUES
(45, 'U2FsdGVkX19yvel0oz94rY24G7LC+JCsH0p1ChPu6CE=', 'U2FsdGVkX1/ebx4Yio3MigY1i6h57n26lnJWB67hf2M=', 'U2FsdGVkX1/2j9b5mAdj799P3BfLHxEDmonqJNzZBxc=', 'U2FsdGVkX1+wd6gvrhUc560QA0n0+z9jI/H9yWCXQmk=', 'U2FsdGVkX18gksPLT9lAYVjS/L69kJTHBVPpnayg34Y=', 'U2FsdGVkX18qhPCqd/0433qULKC8RN2KMqlmkxvSB78=', 'U2FsdGVkX19K1eKxW6XqKRzLVjMyRWMus3yjkMzpVKo=', 'U2FsdGVkX1/b2jJicuo5Zk19tNoRgBPnHc1rQgAlkKo=', 'U2FsdGVkX1+uZ7YLNOpomW7deJIFuCa5O222RnoocOc=', 'U2FsdGVkX1+G+3UUA2iAQ+JI1u2IW+NzyGMzMACLD5M=', 'U2FsdGVkX1/V375Lho6kHlAna7NHRNAgXXJBhedB0Vc=', 'U2FsdGVkX19ifruIvA7+h5viZmwYeIt1NGP4NPKVB6M=', 'U2FsdGVkX1+a3e4PGLbZf+gccBcE18gCO8vZwyZnSaw=', 'U2FsdGVkX1/LtyuVTo+Mh3vDPkVOu7Zr7bBG+QHq+mM=', 'U2FsdGVkX1+Wvg3Ekp3jIlN6VF8S6DDgq0FYmEtEtio=', 'U2FsdGVkX19PBT9A+9sX9OkeG3ON8QnmaMIGY5dgi5g=', 'U2FsdGVkX1+YsyFhtZl2GFCyNk90xzb6wBA47ehZdpc=', 'U2FsdGVkX18aBH3k1m9iyIZtTsO/EPdhhfKWkfYnbbo=', 'U2FsdGVkX1+ny5WI3S64KXjnGWUhARq+dUJIgahOmac=', 'U2FsdGVkX1/O1kcdFbcR0E2RoJOyi6mnagyRTySzFjo=', 'U2FsdGVkX180oTj1jI+ic3dliRoVx+0QG3XB/KVAnmg=', 'U2FsdGVkX1/BmOXwMOJ8D0aB0eumF5PnSrNqZ/l7dX0=', 'U2FsdGVkX1+JzvpngrKvcUR7hlmMvlyflGH5hwuw8fo=', 'U2FsdGVkX1+NRnzqstpT7q8GQTdmavZhaMAQl3cJNUo=', 'U2FsdGVkX19WwriHFaDU6T8X9RS7vVwiTtu/ZcC/EJQ=', 'U2FsdGVkX19fRy1pUZM/XAk53B9SZR5L7JoRq95JoUw=', 'U2FsdGVkX1/mqJz3zQBuSU1ih0kD8sVQ5fDMeQ9DLrk=', 'U2FsdGVkX18tnDqW/HaxF1r/Z6QD2BTq9mvUn9YJQXI=', 'U2FsdGVkX19tw/Sk6ULpiqMGo6VzPCLq/rL3VVz5rXE=', 'U2FsdGVkX1/HiTMxdFTAwKP5ZJ5KMgp0odq7/L3kNkc=', 'U2FsdGVkX193GWIpDYq3EvTSdwsJvpThPXsjJ3QuUEw=', 'U2FsdGVkX18tyjhL0xgJ4+lxXqx/UC7AgMu+q4RMNR4=', 'U2FsdGVkX1/0CYpM6qHJYFnEikFcWG/5E4fKWBRD/ds=', 'U2FsdGVkX1+Y3BtK4Rk5Kvj45kgupYaRsuPz0o+vE6c=', 'U2FsdGVkX1/sGolVgo0ErojcBHUk41TE/oAcBrz8bjw=', 'U2FsdGVkX1/ogWBfgqv9+VjvfiJTdJWVmhzVv6UNh04=', 'U2FsdGVkX1/kYk2BrneQqxjn+LCMDvVKLNBNOHe124A=', 'U2FsdGVkX18UpvtQ1M09EIn98ha/jNG8+RUJglev7IM=', 'U2FsdGVkX18J2cUYccJeIDP3bTleYFr1n1Af60km4Ds=', 'U2FsdGVkX1/WjUYUmigtVH3adwBathQi2A/MO2NQ5LE=', 'U2FsdGVkX1+V//f6RlTioT/xsr3jPfc8q5+qVS5Wdc0=', 'U2FsdGVkX1+59WsOk3Dzc2X6qQaYYb5X04ffwP62LQY=', 'U2FsdGVkX1/piipfPOlCztnbn1ruaGZVv9hSocEAKzI=', 'U2FsdGVkX1+j45W1RjgeMSipHkAsBjDcaHOQHHoCxEU=', 'U2FsdGVkX1/kLF+W5RI3p3JxjK3bg8TJP/HSGkIXVt0=', 'U2FsdGVkX1+KWujhXfnGdSGnmdkpYVihkweFoDKiaZM=', 'U2FsdGVkX1+C3VFM+Hl4cAt55SNGCq45KjQhcbxRtkQ=', 'U2FsdGVkX182b9qWJdWCSuwUj0itfS5aOdvQbWkJrKk=', 'U2FsdGVkX19+Js+xv1G0TiCkYrVkwhRrFvwl5UvyDd8=', 'U2FsdGVkX1/GZYAfScwHQhKaI/kkWnRv4iBWN3Oa92Y=', 'U2FsdGVkX19h57fOzG8UN0qOu6ymdAEj0BUgQAH5lrM=', 'U2FsdGVkX19GEHibuL5+ghjzpAaxQHuApXYcE7/UrsI=', 'U2FsdGVkX1/sZxIujKwnNyaKCTmNk84ZN61TVP6xOfs=', 'U2FsdGVkX1/JOS5bBWuslJty/Nba7/old709Mlzww2s=', 'U2FsdGVkX1/BOSl5lu1Cwsd9KpXzXUI4SajzKCBKfzs=', 'U2FsdGVkX19gKi1uuhePZgDHNQReapI5xCGoubUMP8c=', 'U2FsdGVkX1+6V1rU0mCZxxPctYceaFOzH9ShMQI/Hw0=', 'U2FsdGVkX19oWbIvKbsKDLG7+ieION0kKJxkJ50g8sw=', NULL, 'U2FsdGVkX184UFF9JU3jLhR6Q7zzLglQozevqI8bzF0=', 'U2FsdGVkX1+t1Pas83sst1Q26vkvAE6+jEr5FSwbgWY=', 'U2FsdGVkX1/HH3EbQBnpe9/VTh33zU4Vm4Y6OGRRxs4=', 'U2FsdGVkX19oKzKrrLixOnNqubcFoxugowOn7LeaE/E=', 'U2FsdGVkX18vKEEozTiQ4ZnGFFniOBNQLwOtkwP2NZY=', 'U2FsdGVkX1/l/6V16nYITh4mnJn45/NtyDqP/yu1Uks=', 'U2FsdGVkX19xR7qYgxgdVIpruCeVAaxJGkFnmtvwC5s=', 'U2FsdGVkX1++yvqEiUARuA4qafEJLuS97llpL/z4+IQ=', 'U2FsdGVkX1+GzvwXhrIscb8GJqIsHB2t2vJbr0AIQyE=', 'U2FsdGVkX19hWcsggPGi/ezUqsECPYGo7Bb4jy7JVTQ=', 'U2FsdGVkX18yiWF6vd68BLIommHvasSIqQD+6e2DBGQ=', 'U2FsdGVkX18ztPdhGEyEQ7nn4MR+q/ZnmCgp2Z7N/hM=', 'U2FsdGVkX1/CheDUjninW5W1Dmcwh/r7JfOpu+JoCmE=', 'U2FsdGVkX1+NghhvI2Dzvpi2QdUvYi5wwU0lDQkw4RY=', 'U2FsdGVkX1/tHhh1SX32oXx9HH1nQk9ICjt/Tifz8OU=', '0', '2020-12-09 12:45:36', 'U2FsdGVkX1+zyTvus7sor0U96u5jI+tO0NvRshMI82g=', 'U2FsdGVkX19ESKyplOlTSSg9PA78T4OUwH6BOxtGQj0=', 'U2FsdGVkX19LYbuT4kjCQ17uBqWeeKzw8LEW3iMPDjY=', 'U2FsdGVkX19sSDaViHRomagb5lMI5yxG4+DrDthDgj4=', 'U2FsdGVkX1+JBrKC7PJDtGryc', 'U2FsdGVkX1+CREUCHEKrQP9+W', 'U2FsdGVkX1+hbgx8t+59NAVAV', 'normal', 'U2FsdGVkX19oASDaTDTwHBk1+SUiN1xX+E6sYgQEsSU=', 'U2FsdGVkX1+Jr00pToNp46j1k2/tz5KOwCDtjQqcxXY=', 'U2FsdGVkX18184u9DdzYSt3jR15n0LJD0lhx9aZRoSo=', 'U2FsdGVkX19mEjwHFjFlUEYJB4mHx8kAu9NooG6lT9Y=', 'U2FsdGVkX18RbGdaVLJTw6OCsfo+L5ZTmDZCPr/ixMk=', 'U2FsdGVkX1+GTvjA2u/LsoQbAJOpoZg/5AshspXwMq4=', 'U2FsdGVkX19IQeb5Cr9QGgdTDmSM9I53CvG/V9CWFvo=', 'U2FsdGVkX1+8Y6JVp9zck8pi2XbjFTv7EayvgNybjhI=', 'U2FsdGVkX1/5z67cVseKqepJc6sP7t3gK50qAAVoHh0=', 'U2FsdGVkX1/17nneCX3JP9GyWxhbsSVrJALPH+I508c=', 'U2FsdGVkX1/g+EjYiSeU8EQsYMVr3Uc9yQR+yY9v14s=', 'U2FsdGVkX19xaMSSoRvViFa9HdXxkDSl8rW2amQi+tg=', 'U2FsdGVkX1+X47VVFGIInW5E7yrIMYoaLDdcmy5Eyb8=', 'U2FsdGVkX1+2FvpIYayxFRzs/DuLBT1Cr4zjZ771qO0=', 'U2FsdGVkX19nox7NEBT7Nayy5W5A8Punly4TEHhkcNA=', 'desktop', 'NOT ENDORSED', 'none', '1'),
(97, 'U2FsdGVkX1+KXEh7lInYVDBjBL2KakSaPpqTpo/SeCc=', '59', 'U2FsdGVkX18epQHud0x428Jm9U3kexjkY87+psUr6As=', 'U2FsdGVkX1/XQPkqlnYzgI6glBXzGWjB9EuCLzh1P7A=', '0', '0', '0', '0', '0', 'U2FsdGVkX1+Op1rSOPKA5b7RAhhyJcGelZFfLCoeU90=', '0', '0', '0', 'U2FsdGVkX18pFnEkItmaJJOO0Ftm5nvFwKn4EE5uaFg=', '0', '0', '0', 'U2FsdGVkX1/YCCiE3JYUVtL2Ew/0Y2wGlcHV8infU2s=', '0', '0', '0', 'U2FsdGVkX1/88K0/hu1qW6xiM8Vpwnax3B/8wXt1iWM=', '0', '0', '0', 'U2FsdGVkX1+9PTctuQdAPxGOZQTx4Ue1oUmT/z2H/nk=', '0', '0', '0', 'U2FsdGVkX1+XB2d+lk+okChPa1iF8go4/TiCq7i9vgM=', '0', '0', '0', 'U2FsdGVkX1/utQIBUrQVmR95uD8jWijOoraxNRCM7TU=', '0', '0', '0', 'U2FsdGVkX1+dSbkcDPJ9++V8zNWjEFRXAFD1jGg23Bs=', '0', '0', '0', 'U2FsdGVkX1/b4wRtCD+dLT2gdlLAXLErOHuKkWpbv60=', '0', 'U2FsdGVkX19altFNkt8YmvxbIj761F2abStHS/qQ8EU=', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'U2FsdGVkX193ynbgnWKNClCvQwm+RGIiHDU47vCrlgo=', 'U2FsdGVkX1+UeLaek8YtpVdAqVEY010aSAB2oyEJlc8=', 'U2FsdGVkX1/K38oraKJPB6p9hDIBQtDBKKAWxzF1YcU=', '', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'none', '0', '0', '2020-12-18 09:26:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'U2FsdGVkX1+ZYxxkiY42Y/wKuW7+HJTIC4D+lr0GLsM=', 'U2FsdGVkX1/W/iXNwOws72c0MPoi1FctPsxSFmtC3eg=', 'U2FsdGVkX18DUwLpCH/q4qoAW14Q7i4IVypVSSzeZg8=', 'U2FsdGVkX18emDLVJDensBhlAC5zPpB8AEcBYwLkjPM=', 'desktop', 'NOT ENDORSED', '0', '0'),
(98, 'U2FsdGVkX1+6e7DNg2gGkjCRTU2cvshwAzBFqxWFhg0=', '60', 'U2FsdGVkX1+PbvGKPDErST+/7H0vcmBPvgvqc0PHcMo=', 'U2FsdGVkX19fkev80NT+Y2jpKmqTGGlJ0MizTC+73sg=', '0', '0', '0', '0', '0', 'U2FsdGVkX19l4VSlRtQfd09BDCTfvMBFg8GHE8eYA+c=', '0', '0', '0', 'U2FsdGVkX1+j2dVeoY4pQCZEX6pqpc+Za7zZVbNXvwQ=', '0', '0', '0', 'U2FsdGVkX1/Elo+6ydk9UMqtt0y5+2BX4RAGzlaczYs=', '0', '0', '0', 'U2FsdGVkX1+TIdE9LXcWb59xD05KUpNyb/Ptuo/c/88=', '0', '0', '0', 'U2FsdGVkX1+QTHuWqF9err42h1SGcgyEF76Hhfs1uP0=', '0', '0', '0', 'U2FsdGVkX1+S0DPBPcWe/ZUHXC3HtRD/SR6k27wxyfM=', '0', '0', '0', 'U2FsdGVkX1/xu6MMg1jZkS4gjvu4XU/SADeKxc53X2k=', '0', '0', '0', 'U2FsdGVkX1+uMHvd2u6BRnMJLYRoPBr/icBWK1ZyiBM=', '0', '0', '0', 'U2FsdGVkX19QW0FBCiBO5UH4A2bB9jd2heYYcKeaRpQ=', '0', 'U2FsdGVkX1/0wj4Cb4zvPk+V8ZVOG7zNG2ukjyQJRIk=', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'U2FsdGVkX1/VWFvavJ1HfVqVvNFqfPYyNxdjvC/4YoI=', 'U2FsdGVkX1/MDbHyUZHPiqywFizgPgkIWpAKeP4SYT8=', 'U2FsdGVkX18x31pN68A5PuPp4CatWWwI8BcK6Zf4gNg=', '', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'none', '0', '0', '2020-12-18 10:12:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'U2FsdGVkX1/IPwCtlqhz/OhBmRqim+VRwcbyL1ik6QY=', 'U2FsdGVkX18l71HajX+Xu3iWqFp8f0xGm5D/thVvZkU=', 'U2FsdGVkX19lzxHfryCmDCpopLduz4d1w1+BtMifi1U=', 'U2FsdGVkX1820dPyuO2iG1V8PwkKHSbjhYiRwGin9HI=', 'desktop', 'NOT ENDORSED', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `observationslipTestSync`
--

CREATE TABLE `observationslipTestSync` (
  `id` int NOT NULL,
  `Date` varchar(1000) NOT NULL,
  `Userid` varchar(1199) DEFAULT NULL,
  `station` varchar(100) NOT NULL,
  `TIME` varchar(10) NOT NULL,
  `TotalAmountOfAllClouds` int DEFAULT NULL,
  `TotalAmountOfLowClouds` int DEFAULT NULL,
  `TypeOfLowClouds1` int DEFAULT NULL,
  `OktasOfLowClouds1` int DEFAULT NULL,
  `HeightOfLowClouds1` int DEFAULT NULL,
  `CLCODEOfLowClouds1` varchar(10) DEFAULT '00',
  `TypeOfLowClouds2` int DEFAULT NULL,
  `OktasOfLowClouds2` int DEFAULT NULL,
  `HeightOfLowClouds2` int DEFAULT NULL,
  `CLCODEOfLowClouds2` varchar(10) DEFAULT NULL,
  `TypeOfLowClouds3` int DEFAULT NULL,
  `OktasOfLowClouds3` int DEFAULT NULL,
  `HeightOfLowClouds3` int DEFAULT NULL,
  `CLCODEOfLowClouds3` varchar(255) DEFAULT NULL,
  `TypeOfMediumClouds1` int DEFAULT NULL,
  `OktasOfMediumClouds1` int DEFAULT NULL,
  `HeightOfMediumClouds1` int DEFAULT NULL,
  `CLCODEOfMediumClouds1` varchar(10) DEFAULT NULL,
  `TypeOfMediumClouds2` int DEFAULT NULL,
  `OktasOfMediumClouds2` int DEFAULT NULL,
  `HeightOfMediumClouds2` int DEFAULT NULL,
  `CLCODEOfMediumClouds2` varchar(10) DEFAULT NULL,
  `TypeOfMediumClouds3` int DEFAULT NULL,
  `OktasOfMediumClouds3` int DEFAULT NULL,
  `HeightOfMediumClouds3` int DEFAULT NULL,
  `CLCODEOfMediumClouds3` varchar(11) DEFAULT NULL,
  `TypeOfHighClouds1` int DEFAULT NULL,
  `OktasOfHighClouds1` int DEFAULT NULL,
  `HeightOfHighClouds1` int DEFAULT NULL,
  `CLCODEOfHighClouds1` varchar(10) DEFAULT NULL,
  `TypeOfHighClouds2` int DEFAULT NULL,
  `OktasOfHighClouds2` int DEFAULT NULL,
  `HeightOfHighClouds2` int DEFAULT NULL,
  `CLCODEOfHighClouds2` varchar(10) DEFAULT NULL,
  `TypeOfHighClouds3` int DEFAULT NULL,
  `OktasOfHighClouds3` int DEFAULT NULL,
  `HeightOfHighClouds3` int DEFAULT NULL,
  `CLCODEOfHighClouds3` varchar(10) DEFAULT NULL,
  `CloudSearchLightReading` double DEFAULT NULL,
  `Rainfall` varchar(225) DEFAULT NULL,
  `Dry_Bulb` varchar(10) DEFAULT NULL,
  `Wet_Bulb` varchar(10) DEFAULT NULL,
  `Max_Read` double DEFAULT NULL,
  `Max_Reset` double DEFAULT NULL,
  `Min_Read` double DEFAULT NULL,
  `Min_Reset` double DEFAULT NULL,
  `Piche_Read` double DEFAULT NULL,
  `Piche_Reset` double DEFAULT NULL,
  `TimeMarksThermo` double DEFAULT NULL,
  `TimeMarksHygro` double DEFAULT NULL,
  `TimeMarksRainRec` double DEFAULT NULL,
  `Present_Weather` varchar(100) DEFAULT NULL,
  `Present_WeatherCode` varchar(25) DEFAULT NULL,
  `Past_Weather` varchar(25) DEFAULT NULL,
  `Past_WeatherCode` varchar(25) DEFAULT NULL,
  `Visibility` double DEFAULT NULL,
  `Wind_Direction` varchar(255) DEFAULT NULL,
  `Wind_Speed` varchar(10) DEFAULT NULL,
  `Gusting` double DEFAULT NULL,
  `AttdThermo` double DEFAULT NULL,
  `PrAsRead` double DEFAULT NULL,
  `Correction` double DEFAULT NULL,
  `CLP` varchar(10) DEFAULT NULL,
  `MSLPr` double DEFAULT NULL,
  `TimeMarksBarograph` double DEFAULT NULL,
  `TimeMarksAnemograph` double DEFAULT NULL,
  `OtherTMarks` varchar(125) DEFAULT NULL,
  `Remarks` varchar(100) DEFAULT NULL,
  `O_SubmittedBy` varchar(30) DEFAULT 'none',
  `Approved` varchar(5) NOT NULL DEFAULT '0',
  `ApprovedBy` int NOT NULL DEFAULT '0',
  `O_CreationDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `SoilMoisture` varchar(225) DEFAULT NULL,
  `SoilTemperature` varchar(10) DEFAULT NULL,
  `sunduration` varchar(25) DEFAULT NULL,
  `trend` varchar(50) DEFAULT NULL,
  `windrun` varchar(25) DEFAULT NULL,
  `Max_temp` varchar(25) DEFAULT NULL,
  `Min_temp` varchar(25) DEFAULT NULL,
  `speciormetar` enum('metar','speci','normal') DEFAULT NULL,
  `UnitOfWindSpeed` varchar(30) DEFAULT NULL,
  `IndOrOmissionOfPrecipitation` varchar(30) DEFAULT NULL,
  `TypeOfStation_Present_Past_Weather` varchar(30) DEFAULT NULL,
  `HeightOfLowestCloud` varchar(30) DEFAULT NULL,
  `StandardIsobaricSurface` varchar(30) DEFAULT NULL,
  `GPM` varchar(30) DEFAULT NULL,
  `DurationOfPeriodOfPrecipitation` varchar(30) DEFAULT NULL,
  `GrassMinTemp` varchar(30) DEFAULT NULL,
  `CI_OfPrecipitation` varchar(30) DEFAULT NULL,
  `BE_OfPrecipitation` varchar(30) DEFAULT NULL,
  `IndicatorOfTypeOfIntrumentation` varchar(30) DEFAULT NULL,
  `SignOfPressureChange` varchar(30) DEFAULT NULL,
  `Supp_Info` varchar(30) DEFAULT NULL,
  `VapourPressure` varchar(30) DEFAULT NULL,
  `T_H_Graph` varchar(30) DEFAULT NULL,
  `DeviceType` enum('AWS','web','mobile','desktop') NOT NULL DEFAULT 'AWS',
  `Endorsed` varchar(15) DEFAULT 'NOT ENDORSED',
  `EndorsedBy` varchar(35) NOT NULL DEFAULT 'none',
  `SyncStatus` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `observationslipTestSync`
--

INSERT INTO `observationslipTestSync` (`id`, `Date`, `Userid`, `station`, `TIME`, `TotalAmountOfAllClouds`, `TotalAmountOfLowClouds`, `TypeOfLowClouds1`, `OktasOfLowClouds1`, `HeightOfLowClouds1`, `CLCODEOfLowClouds1`, `TypeOfLowClouds2`, `OktasOfLowClouds2`, `HeightOfLowClouds2`, `CLCODEOfLowClouds2`, `TypeOfLowClouds3`, `OktasOfLowClouds3`, `HeightOfLowClouds3`, `CLCODEOfLowClouds3`, `TypeOfMediumClouds1`, `OktasOfMediumClouds1`, `HeightOfMediumClouds1`, `CLCODEOfMediumClouds1`, `TypeOfMediumClouds2`, `OktasOfMediumClouds2`, `HeightOfMediumClouds2`, `CLCODEOfMediumClouds2`, `TypeOfMediumClouds3`, `OktasOfMediumClouds3`, `HeightOfMediumClouds3`, `CLCODEOfMediumClouds3`, `TypeOfHighClouds1`, `OktasOfHighClouds1`, `HeightOfHighClouds1`, `CLCODEOfHighClouds1`, `TypeOfHighClouds2`, `OktasOfHighClouds2`, `HeightOfHighClouds2`, `CLCODEOfHighClouds2`, `TypeOfHighClouds3`, `OktasOfHighClouds3`, `HeightOfHighClouds3`, `CLCODEOfHighClouds3`, `CloudSearchLightReading`, `Rainfall`, `Dry_Bulb`, `Wet_Bulb`, `Max_Read`, `Max_Reset`, `Min_Read`, `Min_Reset`, `Piche_Read`, `Piche_Reset`, `TimeMarksThermo`, `TimeMarksHygro`, `TimeMarksRainRec`, `Present_Weather`, `Present_WeatherCode`, `Past_Weather`, `Past_WeatherCode`, `Visibility`, `Wind_Direction`, `Wind_Speed`, `Gusting`, `AttdThermo`, `PrAsRead`, `Correction`, `CLP`, `MSLPr`, `TimeMarksBarograph`, `TimeMarksAnemograph`, `OtherTMarks`, `Remarks`, `O_SubmittedBy`, `Approved`, `ApprovedBy`, `O_CreationDate`, `SoilMoisture`, `SoilTemperature`, `sunduration`, `trend`, `windrun`, `Max_temp`, `Min_temp`, `speciormetar`, `UnitOfWindSpeed`, `IndOrOmissionOfPrecipitation`, `TypeOfStation_Present_Past_Weather`, `HeightOfLowestCloud`, `StandardIsobaricSurface`, `GPM`, `DurationOfPeriodOfPrecipitation`, `GrassMinTemp`, `CI_OfPrecipitation`, `BE_OfPrecipitation`, `IndicatorOfTypeOfIntrumentation`, `SignOfPressureChange`, `Supp_Info`, `VapourPressure`, `T_H_Graph`, `DeviceType`, `Endorsed`, `EndorsedBy`, `SyncStatus`) VALUES
(58, '2020-11-16', NULL, '1', '05:00Z', NULL, 0, 0, 0, 0, ' ', 0, 0, 0, ' ', 0, 0, 0, ' ', 0, 0, 0, ' ', 0, 0, 0, ' ', 0, 0, 0, ' ', 0, 0, 0, ' ', 0, 0, 0, ' ', 0, 0, 0, ' ', 0, ' ', ' ', ' ', 0, 0, 0, 0, 0, 0, 0, 0, 0, ' ', ' ', ' ', NULL, 0, ' ', ' ', 0, 0, 0, 0, ' ', 0, 0, 0, ' ', ' ', 'musta', '0', 0, '2020-11-17 20:33:36', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 'normal', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 'desktop', 'NOT ENDORSED', 'none', '1'),
(95, '2020-12-23', '34', '1', '03:00Z', 0, 5, 0, 0, 0, ' ', 0, 0, 0, ' ', 0, 0, 0, ' ', 0, 0, 0, ' ', 0, 0, 0, ' ', 0, 0, 0, ' ', 0, 0, 0, ' ', 0, 0, 0, ' ', 0, 0, 0, ' ', 0, ' ', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ' ', ' ', ' ', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'none', '0', 0, '2020-12-08 22:19:37', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ' ', ' ', ' ', ' ', 'desktop', 'NOT ENDORSED', '0', '0'),
(96, '2020-12-10', '35', '1', '02:30Z', 0, 4, 0, 0, 0, ' ', 0, 0, 0, ' ', 0, 0, 0, ' ', 0, 0, 0, ' ', 0, 0, 0, ' ', 0, 0, 0, ' ', 0, 0, 0, ' ', 0, 0, 0, ' ', 0, 0, 0, ' ', 0, ' ', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ' ', ' ', ' ', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'none', '0', 0, '2020-12-08 22:21:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ' ', ' ', ' ', ' ', 'desktop', 'NOT ENDORSED', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `observtnslp_analyzer_checks`
--

CREATE TABLE `observtnslp_analyzer_checks` (
  `id` int NOT NULL,
  `id_first_checked` int NOT NULL,
  `id_last_checked` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Table structure for table `problems`
--

CREATE TABLE `problems` (
  `id` int UNSIGNED NOT NULL,
  `source` enum('sensor','station','twoMeterNode','groundNode','tenMeterNode','sinkNode') COLLATE utf8mb4_unicode_ci NOT NULL,
  `source_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `criticality` enum('Critical','Non Critical') COLLATE utf8mb4_unicode_ci NOT NULL,
  `classification_id` int UNSIGNED NOT NULL,
  `track_counter` int UNSIGNED NOT NULL,
  `status` enum('reported','investigation','solved') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `problem_classification`
--

CREATE TABLE `problem_classification` (
  `id` int UNSIGNED NOT NULL,
  `problem_description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `source` enum('node','station','sensor') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `raw_datacomments`
--

CREATE TABLE `raw_datacomments` (
  `id` int NOT NULL,
  `comment` text NOT NULL,
  `record_id` varchar(100) NOT NULL,
  `form_type` varchar(100) NOT NULL,
  `solved` enum('TRUE','FALSE') NOT NULL DEFAULT 'FALSE',
  `comment_by` varchar(200) NOT NULL,
  `userrole` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `raw_datacomments`
--

INSERT INTO `raw_datacomments` (`id`, `comment`, `record_id`, `form_type`, `solved`, `comment_by`, `userrole`) VALUES
(1, '				\r\n	Hello observer, I notice that there is a suspicious value in the rainfall field if this record. The value is to high as compared to max expected. Please do a thorough check and correct the value 			', '559156', '', 'FALSE', 'Mwesigwa Andrew', 'Senior Weather Observer'),
(2, 'Hello observer, I notice another issue with the temperature value. Please do a thorough check and correct the value				\r\n				', '559156', '', 'FALSE', 'Mwesigwa Andrew', 'Senior Weather Observer'),
(3, 'Has this been worked on. testing testing comments.', '559156', '', 'FALSE', 'Mwesigwa Andrew', 'Senior Weather Observer'),
(4, '				\r\n				1. Double check rainfall value of this record. It\'s unusual.', '559079', '', 'FALSE', 'Test observer Test account', 'Observer'),
(5, 'try comment								\r\n								', '', '', 'FALSE', 'Mwesigwa Andrew', 'DataOfficer'),
(6, '								\r\ntry 2								', '65', '', 'FALSE', 'Mwesigwa Andrew', 'DataOfficer'),
(7, 'try 3							\r\n								', '65', '', 'FALSE', 'Mwesigwa Andrew', 'DataOfficer'),
(8, 'try 4							\r\n								', '65', '', 'FALSE', 'Mwesigwa Andrew', 'DataOfficer'),
(9, 'try 5								\r\n								', '57', '', 'FALSE', 'Mwesigwa Andrew', 'DataOfficer'),
(10, '                            \r\n try metar                           ', '', '', 'FALSE', 'Mwesigwa Andrew', 'DataOfficer'),
(11, '                            \r\ntry metar 2                            ', '', '', 'FALSE', 'Mwesigwa Andrew', 'DataOfficer'),
(12, '  try metar 3                          \r\n                            ', '57', '', 'FALSE', 'Mwesigwa Andrew', 'DataOfficer'),
(13, '      try with form type                      \r\n                            ', '57', 'archivemetarformdata', 'FALSE', 'Mwesigwa Andrew', 'DataOfficer'),
(14, '                   try dekadal    ', '1', 'archivedekadalformreportdata', 'FALSE', 'Mwesigwa Andrew', 'DataOfficer'),
(15, 'try again                            \r\n                            ', '1', 'archivedekadalformreportdata', 'FALSE', 'Mwesigwa Andrew', 'DataOfficer'),
(16, 'try synop                   ', '4', 'archivesynopticformreportdata', 'FALSE', 'Mwesigwa Andrew', 'DataOfficer'),
(17, 'try weather summary						', '57', 'archiveweathersummaryformreportdata', 'FALSE', 'Mwesigwa Andrew', 'DataOfficer'),
(18, 'try metar     \r\n                            ', '49', 'archivemetarformdata', 'FALSE', 'Mwesigwa Andrew', 'DataOfficer'),
(19, 'try dekadal                     \r\n                            ', '1', 'archivedekadalformreportdata', 'TRUE', 'Mwesigwa Andrew', 'DataOfficer'),
(20, '	Add							\r\n								', '65', 'archiveweathersummaryformreportdata', 'FALSE', 'Mwesigwa Andrew', 'SeniorDataOfficer'),
(21, 'try observation				', '26', 'archiveobservationslipformdata', 'FALSE', 'Mwesigwa Andrew', 'SeniorDataOfficer'),
(22, 'try observation again				\r\n				', '26', 'archiveobservationslipformdata', 'TRUE', 'Mwesigwa Andrew', 'SeniorDataOfficer'),
(23, '  try monthly rain                                \r\n                                    ', '7', 'archivesynopticformreportdata', 'FALSE', 'Mwesigwa Andrew', 'SeniorDataOfficer'),
(24, 'try monthly rain                                    \r\n                                    ', '7', 'archivemonthlyrainfallformreportdata', 'FALSE', 'Mwesigwa Andrew', 'SeniorDataOfficer'),
(25, '                            \r\n                            check the height of lowest cloud. it\'s not possible to have that value in kampala!', '5', 'archivesynopticformreportdata', 'FALSE', 'Mwesigwa Andrew', 'DataOfficer'),
(26, '                                    \r\n                              this comment      ', '21', 'archivemonthlyrainfallformreportdata', 'FALSE', 'Mwesigwa Andrew', 'SeniorDataOfficer'),
(27, 'yes.', '67', 'archivemetarformdata', 'FALSE', 'Mwesigwa Andrew', 'DataOfficer'),
(28, '                                    \r\n                                    i hope this is ok now', '22', 'archivemonthlyrainfallformreportdata', 'FALSE', 'Mwesigwa Andrew', 'DataOfficer'),
(29, '				\r\n				Rainfall value is wrong. Please correct.', '559157', 'observationslip', 'FALSE', 'Mwesigwa Andrew', 'Senior Weather Observer'),
(30, '	                            \r\ntry	                            ', '18', 'archiveobservationslipformdata', 'FALSE', 'Mwesigwa Andrew', 'QC'),
(31, 'try scans daily                                \r\n                                ', '35', 'scans_daily', 'TRUE', 'Mwesigwa Andrew', 'SeniorDataOfficer'),
(32, 'try again            ', '35', 'scans_daily', 'FALSE', 'Mwesigwa Andrew', 'SeniorDataOfficer'),
(33, 'try dekadal                                \r\n                                ', '', 'scans_daily', 'FALSE', 'Mwesigwa Andrew', 'SeniorDataOfficer'),
(34, 'dekadal                                \r\n                                ', '10', 'scans_daily', 'TRUE', 'Mwesigwa Andrew', 'SeniorDataOfficer'),
(35, 'try again          \r\n                                ', '10', 'scans_dekadals', 'TRUE', 'Mwesigwa Andrew', 'SeniorDataOfficer'),
(36, ' try                             \r\n                                ', '36', 'scannedmetar', 'TRUE', 'Mwesigwa Andrew', 'SeniorDataOfficer'),
(37, 'try                                \r\n                                ', '14', 'archiveobservationslipformdata', 'FALSE', 'Mwesigwa Andrew', 'SeniorDataOfficer'),
(38, 'try                                \r\n                                ', '14', 'scannedmonthly', 'TRUE', 'Mwesigwa Andrew', 'SeniorDataOfficer'),
(39, '     try                           \r\n                                ', '37', 'scannedsynop', 'TRUE', 'Mwesigwa Andrew', 'SeniorDataOfficer'),
(40, 'try                 ', '13', 'scannedweathersummary', 'TRUE', 'Mwesigwa Andrew', 'SeniorDataOfficer'),
(41, 'try                                \r\n                                ', '2', 'scannedannual', 'FALSE', 'Mwesigwa Andrew', 'SeniorDataOfficer'),
(42, 'try again                                \r\n                                ', '2', 'scannedannual', 'TRUE', 'Mwesigwa Andrew', 'SeniorDataOfficer'),
(43, '                                \r\n                                testing this comment', '33', 'scans_daily', 'TRUE', 'Mwesigwa Andrew', 'SeniorDataOfficer'),
(44, '                            \r\n               try             ', '39', 'archivedekadalformreportdata', 'FALSE', 'Mwesigwa Andrew', 'DataOfficer'),
(45, 'try                            \r\n                            ', '39', 'archivedekadalformreportdata', 'FALSE', 'Mwesigwa Andrew', 'DataOfficer'),
(46, 'try                            \r\n                            ', '39', 'archivemonthlyrainfallformreportdata', 'TRUE', 'Mwesigwa Andrew', 'DataOfficer'),
(47, '                            testing comment. true?\r\n                            ', '99', 'archivemonthlyrainfallformreportdata', 'TRUE', 'Mwesigwa Andrew', 'DataOfficer');

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` int NOT NULL,
  `region` varchar(100) NOT NULL,
  `Date_created` varchar(100) DEFAULT NULL,
  `Time_created` varchar(100) DEFAULT NULL,
  `Created_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `region`, `Date_created`, `Time_created`, `Created_by`) VALUES
(11, 'Central', '16/02/2020', '10:01:08am', 'Manager Stationnetwork'),
(12, 'Western', '16/02/2020', '10:01:25am', 'Manager Stationnetwork'),
(13, 'Southern', '16/02/2020', '10:03:34am', 'Manager Stationnetwork'),
(14, 'Eastern', '16/02/2020', '10:03:45am', 'Manager Stationnetwork'),
(15, 'Northern', '11/06/2020', '11:17:54pm', 'Andrew Mwesigwa'),
(16, 'North-East', '11/06/2020', '11:18:15pm', 'Andrew Mwesigwa'),
(17, 'Equatorial Region', '12/06/2020', '10:01:09am', 'Andrew Mwesigwa'),
(18, 'Lango sub-region', '04/10/2020', '07:04:52am', 'Andrew Mwesigwa'),
(19, 'Test-Region2', '30/11/2020', '10:03:58am', 'Andrew Mwesigwa');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `report_id` int UNSIGNED NOT NULL,
  `problem_id` int NOT NULL,
  `message` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `report_counter` int NOT NULL,
  `station_id` int DEFAULT NULL,
  `node` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sensor` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `scans_daily`
--

CREATE TABLE `scans_daily` (
  `id` int NOT NULL,
  `Form_scanned` enum('observationslip','metarreport','synopticform') NOT NULL,
  `station` int NOT NULL COMMENT 'foreign key for station',
  `form_date` date DEFAULT NULL,
  `TIME` varchar(10) DEFAULT NULL,
  `Description` text,
  `FileRef` varchar(1000) DEFAULT NULL,
  `FileName_FirstPage` varchar(50) DEFAULT NULL,
  `FileName_SecondPage` varchar(50) DEFAULT NULL,
  `SD_SubmittedBy` varchar(25) NOT NULL,
  `submitedBy_Id` int NOT NULL,
  `ApprovedBy` varchar(100) DEFAULT NULL,
  `Approved` varchar(100) DEFAULT NULL,
  `record_id` varchar(100) NOT NULL,
  `submissionstatus` enum('Pending','Completed') NOT NULL DEFAULT 'Pending',
  `numfiles` int NOT NULL DEFAULT '0',
  `comment` varchar(255) DEFAULT NULL,
  `CreationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `numberofcomments` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scans_daily`
--

INSERT INTO `scans_daily` (`id`, `Form_scanned`, `station`, `form_date`, `TIME`, `Description`, `FileRef`, `FileName_FirstPage`, `FileName_SecondPage`, `SD_SubmittedBy`, `submitedBy_Id`, `ApprovedBy`, `Approved`, `record_id`, `submissionstatus`, `numfiles`, `comment`, `CreationDate`, `numberofcomments`) VALUES
(5, 'observationslip', 4, '2020-01-20', '0000Z', NULL, NULL, NULL, NULL, 'Kunya Nathern', 0, 'Andrew Mwesigwa', 'TRUE', '680ObservationSlip_20200611052226pm', 'Pending', 0, NULL, '2020-06-11 18:22:26', 0),
(36, 'metarreport', 4, '2020-03-04', NULL, NULL, NULL, NULL, NULL, 'Andrew Mwesigwa', 77, '', 'FALSE', '680metar_20210103021843pm', 'Completed', 1, '  ', '2021-01-03 15:18:43', 1),
(37, 'synopticform', 4, '2021-01-03', NULL, NULL, NULL, NULL, NULL, 'Andrew Mwesigwa', 77, NULL, 'FALSE', 'synoptic_20210103022614pm', 'Completed', 1, NULL, '2021-01-03 15:26:14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `scans_dekadals`
--

CREATE TABLE `scans_dekadals` (
  `id` int NOT NULL,
  `station` int NOT NULL COMMENT 'foreign key for station',
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `Description` text,
  `FileRef` varchar(1000) DEFAULT NULL,
  `SDE_SubmittedBy` varchar(25) NOT NULL,
  `submitedBy_Id` int NOT NULL,
  `ApprovedBy` varchar(30) DEFAULT NULL,
  `Approved` varchar(100) DEFAULT NULL,
  `Dekadalnumber` int DEFAULT NULL,
  `month` varchar(20) DEFAULT NULL,
  `year` year DEFAULT NULL,
  `record_id` varchar(100) NOT NULL,
  `submissionstatus` enum('Pending','Completed') NOT NULL DEFAULT 'Pending',
  `numfiles` int NOT NULL DEFAULT '0',
  `comment` varchar(255) DEFAULT NULL,
  `CreationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `numberofcomments` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scans_dekadals`
--

INSERT INTO `scans_dekadals` (`id`, `station`, `from_date`, `to_date`, `Description`, `FileRef`, `SDE_SubmittedBy`, `submitedBy_Id`, `ApprovedBy`, `Approved`, `Dekadalnumber`, `month`, `year`, `record_id`, `submissionstatus`, `numfiles`, `comment`, `CreationDate`, `numberofcomments`) VALUES
(1, 4, NULL, NULL, NULL, NULL, 'Andrew Mwesigwa', 0, 'Andrew Mwesigwa', 'TRUE', 1, 'February', 2020, '680dekadal_20200623033713pm', 'Pending', 0, NULL, '2020-06-23 16:37:13', 0),
(9, 4, NULL, NULL, NULL, NULL, 'Andrew Mwesigwa', 0, '', 'FALSE', 1, 'September', 2020, '680dekadal_20201216115728am', 'Completed', 1, '  comment for dekadal 1', '2020-12-16 12:57:28', 0),
(10, 4, NULL, NULL, NULL, NULL, 'Andrew Mwesigwa', 77, NULL, 'FALSE', 1, 'January', 2020, '680dekadal_20210103023111pm', 'Completed', 1, NULL, '2021-01-03 15:31:11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `scans_monthly`
--

CREATE TABLE `scans_monthly` (
  `id` int NOT NULL COMMENT 'scannedarchiveweathersummaryformreportcopydetails',
  `Form_scanned` varchar(30) NOT NULL,
  `station` int NOT NULL COMMENT 'foreign key for station',
  `year` year DEFAULT NULL,
  `month` varchar(13) NOT NULL,
  `Description` text,
  `FileRef` varchar(1000) DEFAULT NULL,
  `SM_SubmittedBy` varchar(25) NOT NULL,
  `submitedBy_Id` int NOT NULL,
  `ApprovedBy` varchar(30) DEFAULT NULL,
  `Approved` varchar(100) DEFAULT NULL,
  `record_id` varchar(100) NOT NULL,
  `submissionstatus` enum('Pending','Completed') NOT NULL DEFAULT 'Pending',
  `numfiles` int NOT NULL DEFAULT '0',
  `comment` varchar(255) DEFAULT NULL,
  `CreationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `numberofcomments` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scans_monthly`
--

INSERT INTO `scans_monthly` (`id`, `Form_scanned`, `station`, `year`, `month`, `Description`, `FileRef`, `SM_SubmittedBy`, `submitedBy_Id`, `ApprovedBy`, `Approved`, `record_id`, `submissionstatus`, `numfiles`, `comment`, `CreationDate`, `numberofcomments`) VALUES
(1, 'Weather Summary Form', 4, 2020, 'February', NULL, '', 'Andrew Mwesigwa', 0, 'Andrew Mwesigwa', 'TRUE', 'Weathersummary_20200623045626pm', 'Pending', 0, NULL, '2020-06-23 17:56:26', 0),
(12, 'MonthlyRainfallReport', 15, 1943, 'November', NULL, NULL, 'Joseph Mawanda', 0, NULL, 'FALSE', 'monthlyrainfall_20201216013915pm', 'Pending', 1, NULL, '2020-12-16 14:39:15', 0),
(13, 'Weather Summary Form', 4, 2023, 'January', NULL, NULL, 'Andrew Mwesigwa', 77, '', 'FALSE', 'Weathersummary_20210103022326pm', 'Completed', 1, '', '2021-01-03 15:23:26', 1),
(14, 'MonthlyRainfallReport', 4, 2021, 'January', NULL, NULL, 'Andrew Mwesigwa', 77, NULL, 'FALSE', 'monthlyrainfall_20210103023351pm', 'Completed', 1, NULL, '2021-01-03 15:33:51', 1);

-- --------------------------------------------------------

--
-- Table structure for table `scans_yearly`
--

CREATE TABLE `scans_yearly` (
  `id` int NOT NULL,
  `Form_scanned` varchar(25) NOT NULL,
  `station` int NOT NULL COMMENT 'foreign key for station',
  `year` year DEFAULT NULL,
  `Description` text,
  `FileRef` varchar(1000) DEFAULT NULL,
  `SY_SubmittedBy` varchar(25) NOT NULL,
  `submitedBy_Id` int NOT NULL,
  `ApprovedBy` varchar(30) DEFAULT NULL,
  `Approved` varchar(100) DEFAULT NULL,
  `record_id` varchar(100) NOT NULL,
  `submissionstatus` enum('Pending','Completed') NOT NULL DEFAULT 'Pending',
  `numfiles` int NOT NULL DEFAULT '0',
  `comment` varchar(255) DEFAULT NULL,
  `CreationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `numberofcomments` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scans_yearly`
--

INSERT INTO `scans_yearly` (`id`, `Form_scanned`, `station`, `year`, `Description`, `FileRef`, `SY_SubmittedBy`, `submitedBy_Id`, `ApprovedBy`, `Approved`, `record_id`, `submissionstatus`, `numfiles`, `comment`, `CreationDate`, `numberofcomments`) VALUES
(1, 'Annual Rainfall Form', 4, 2020, NULL, NULL, 'Andrew Mwesigwa', 0, NULL, 'FALSE', 'yearlyrainfall_20201216121430pm', 'Completed', 1, '  repeat comment', '2020-12-16 13:14:30', 0),
(2, 'Annual Rainfall Form', 4, 2021, NULL, NULL, 'Andrew Mwesigwa', 77, NULL, 'FALSE', 'yearlyrainfall_20210103023632pm', 'Completed', 1, NULL, '2021-01-03 15:36:32', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sensors`
--

CREATE TABLE `sensors` (
  `id` int UNSIGNED NOT NULL,
  `node_id` int UNSIGNED NOT NULL,
  `node_type` enum('twoMeterNode','tenMeterNode','groundNode','sinkNode') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'this should be the table of the node e.g twoMeterNode',
  `sensor_status` enum('on','off') COLLATE utf8mb4_unicode_ci NOT NULL,
  `parameter_read` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `identifier_used` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `min_value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `report_time_interval` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '12',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sinknode`
--

CREATE TABLE `sinknode` (
  `node_id` int NOT NULL,
  `station_id` int NOT NULL,
  `date_sink` varchar(30) NOT NULL,
  `time_sink` varchar(30) NOT NULL,
  `ut_sink` varchar(30) NOT NULL,
  `gw_lat_sink` varchar(30) NOT NULL,
  `gw_long_sink` varchar(30) NOT NULL,
  `e64_sink` varchar(30) NOT NULL,
  `t_sink` varchar(30) NOT NULL,
  `ps_sink` varchar(30) NOT NULL,
  `up_sink` varchar(30) NOT NULL,
  `v_mcu_sink` varchar(30) NOT NULL,
  `v_in_sink` varchar(30) NOT NULL,
  `p_ms5611_sink` varchar(30) NOT NULL,
  `ttl_sink` varchar(30) NOT NULL,
  `rssi_sink` varchar(30) NOT NULL,
  `lqi_sink` varchar(30) NOT NULL,
  `drp_sink` varchar(30) NOT NULL,
  `txt_sink` varchar(30) NOT NULL,
  `seq_sink` varchar(10) NOT NULL DEFAULT 'SEQ',
  `txt_sink_value` varchar(30) NOT NULL,
  `node_status` enum('on','off') NOT NULL,
  `v_in_max_value` double NOT NULL,
  `v_in_min_value` double NOT NULL,
  `v_mcu_max_value` double NOT NULL,
  `v_mcu_min_value` double NOT NULL,
  `CreationDate` timestamp NULL DEFAULT NULL,
  `UpdateDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `speci_notification`
--

CREATE TABLE `speci_notification` (
  `id` int NOT NULL,
  `note_id` varchar(100) NOT NULL,
  `station_id` varchar(100) DEFAULT NULL,
  `note_type` varchar(100) DEFAULT NULL,
  `issue` varchar(1000) DEFAULT NULL,
  `issue_to` int DEFAULT NULL,
  `viewedby_oc` enum('True','False') NOT NULL DEFAULT 'False',
  `viewedby_datamanager` enum('True','False') NOT NULL DEFAULT 'False',
  `viewedby_zoneofficer` enum('True','False') NOT NULL DEFAULT 'False'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `speci_notification`
--

INSERT INTO `speci_notification` (`id`, `note_id`, `station_id`, `note_type`, `issue`, `issue_to`, `viewedby_oc`, `viewedby_datamanager`, `viewedby_zoneofficer`) VALUES
(110, '200214083404AM01', '1', 'new_user', 'New user created pending verification', NULL, 'True', 'True', 'True'),
(111, '200214083519AM01', '1', 'new_user', 'New user created pending verification', NULL, 'True', 'True', 'True'),
(112, '200214085147AM461', '1', 'new_user', 'New user created pending verification', NULL, 'True', 'True', 'True'),
(430, '210119084906PM0133', '1', 'new_user', 'New user created pending verification', NULL, 'True', 'False', 'True'),
(431, '559160', '4', 'normal', NULL, NULL, 'False', 'False', 'False');

-- --------------------------------------------------------

--
-- Table structure for table `stations`
--

CREATE TABLE `stations` (
  `station_id` int NOT NULL,
  `StationName` varchar(255) NOT NULL,
  `StationNumber` varchar(30) DEFAULT NULL,
  `blocknumber` varchar(100) DEFAULT NULL,
  `StationRegNumber` varchar(30) DEFAULT NULL,
  `Location` varchar(255) NOT NULL,
  `Indicator` varchar(30) DEFAULT NULL,
  `StationRegion` varchar(30) NOT NULL,
  `Country` varchar(30) NOT NULL DEFAULT 'Uganda',
  `subregion` varchar(500) DEFAULT NULL,
  `district` varchar(500) DEFAULT NULL,
  `county` varchar(500) DEFAULT NULL,
  `subcounty` varchar(500) DEFAULT NULL,
  `parish` varchar(500) DEFAULT NULL,
  `village` varchar(500) DEFAULT NULL,
  `Latitude` varchar(200) DEFAULT NULL,
  `Longitude` varchar(200) DEFAULT NULL,
  `Height` int DEFAULT NULL,
  `Altitude` double DEFAULT NULL,
  `StationStatus` enum('on','off') NOT NULL DEFAULT 'on',
  `StationType` varchar(30) NOT NULL,
  `Opened` datetime DEFAULT NULL,
  `Closed` varchar(30) DEFAULT NULL,
  `min_expectedtemp` int DEFAULT NULL,
  `max_expectedtemp` int DEFAULT NULL,
  `min_expectedrain` int DEFAULT NULL,
  `max_expectedrain` int DEFAULT NULL,
  `min_expectedwindspeed` varchar(100) DEFAULT NULL,
  `max_expectedwindspeed` varchar(100) DEFAULT NULL,
  `UnitOfWind_Speed` varchar(100) DEFAULT NULL,
  `SubmittedBy` varchar(30) DEFAULT NULL,
  `Creation_Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdateDate` timestamp NULL DEFAULT NULL,
  `stationCategory` enum('manual','aws') NOT NULL,
  `stationstandardisobaricsurface` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stations`
--

INSERT INTO `stations` (`station_id`, `StationName`, `StationNumber`, `blocknumber`, `StationRegNumber`, `Location`, `Indicator`, `StationRegion`, `Country`, `subregion`, `district`, `county`, `subcounty`, `parish`, `village`, `Latitude`, `Longitude`, `Height`, `Altitude`, `StationStatus`, `StationType`, `Opened`, `Closed`, `min_expectedtemp`, `max_expectedtemp`, `min_expectedrain`, `max_expectedrain`, `min_expectedwindspeed`, `max_expectedwindspeed`, `UnitOfWind_Speed`, `SubmittedBy`, `Creation_Date`, `UpdateDate`, `stationCategory`, `stationstandardisobaricsurface`) VALUES
(4, 'Kampala', '680', '63', '8923022', 'Makerere University Kampala ', 'HUKA', 'Central', 'Uganda', 'Kampala', 'Kampala', 'Kyadondo', 'Kawempe', 'Wandegeya', 'Makerere', '19', '32', 1140, 3740, 'on', 'Synoptic', '1993-01-01 00:00:00', NULL, 18, 45, NULL, 53, '10', '30', '2', 'Godfrey Ntabazi', '2020-02-14 09:47:14', NULL, 'manual', '8');
-- --------------------------------------------------------

--
-- Table structure for table `station_problem_settings`
--

CREATE TABLE `station_problem_settings` (
  `id` int UNSIGNED NOT NULL,
  `problem_id` int UNSIGNED NOT NULL COMMENT 'Problem ids must not be repeated for any given station i.e a station must not have a duplicated problem_id',
  `station_id` int NOT NULL,
  `max_track_counter` int UNSIGNED NOT NULL,
  `report_method` enum('sms','email','Both') COLLATE utf8mb4_unicode_ci NOT NULL,
  `reporting_time_interval` int NOT NULL,
  `criticality` enum('Critical','Non Critical') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `submitted_reports`
--

CREATE TABLE `submitted_reports` (
  `id` int NOT NULL,
  `station` int DEFAULT NULL,
  `report_type` varchar(100) DEFAULT NULL,
  `time` varchar(100) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  `month` varchar(100) DEFAULT NULL,
  `year` varchar(100) DEFAULT NULL,
  `startdate` varchar(100) DEFAULT NULL,
  `enddate` varchar(100) DEFAULT NULL,
  `starttime` varchar(100) DEFAULT NULL,
  `endtime` varchar(100) DEFAULT NULL,
  `submitedby` varchar(100) DEFAULT NULL,
  `forwardtomanager` enum('True','False') DEFAULT 'False',
  `forwardedby` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `submitted_reports`
--

INSERT INTO `submitted_reports` (`id`, `station`, `report_type`, `time`, `date`, `month`, `year`, `startdate`, `enddate`, `starttime`, `endtime`, `submitedby`, `forwardtomanager`, `forwardedby`) VALUES
(66, 4, 'speci', NULL, NULL, '', '', '2018-11-25', '2020-07-25', '', '', '70', 'False', NULL),
(83, 4, 'metar', '', '2020-12-09', '', '', NULL, NULL, NULL, NULL, '70', 'False', NULL),
(84, 4, 'metar', '', '2020-12-17', '', '', NULL, NULL, NULL, NULL, '70', 'False', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subregions`
--

CREATE TABLE `subregions` (
  `id` int NOT NULL,
  `subregion` varchar(100) NOT NULL,
  `region` varchar(100) NOT NULL,
  `Date_created` varchar(100) DEFAULT NULL,
  `Time_created` varchar(100) DEFAULT NULL,
  `Created_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subregions`
--

INSERT INTO `subregions` (`id`, `subregion`, `region`, `Date_created`, `Time_created`, `Created_by`) VALUES
(1, 'Central', '11', '25/10/2020', '07:56:23am', 'Andrew Mwesigwa'),
16, 'Wakiso', '11', '13/12/2020', '05:18:14pm', 'andrew mwesigwa'),
(17, 'Kampala', '11', '15/12/2020', '12:02:15pm', 'andrew mwesigwa');

-- --------------------------------------------------------

--
-- Table structure for table `systemusers`
--

CREATE TABLE `systemusers` (
  `Userid` bigint NOT NULL,
  `station` int NOT NULL DEFAULT '1',
  `region_zone` varchar(800) DEFAULT NULL COMMENT 'region or zone of the the user in charge of',
  `UserSubRegion` varchar(100) DEFAULT NULL,
  `FirstName` varchar(100) NOT NULL,
  `SurName` varchar(100) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `UserPassword` varchar(255) NOT NULL,
  `UserRole` varchar(50) NOT NULL,
  `UserEmail` varchar(50) NOT NULL,
  `UserPhone` varchar(50) NOT NULL,
  `Active` bit(1) NOT NULL,
  `LoggedOn` bit(1) DEFAULT NULL,
  `Reset` bit(1) NOT NULL,
  `LastPasswdChange` datetime NOT NULL,
  `LastLoggedIn` datetime NOT NULL,
  `CreatedBy` varchar(100) NOT NULL,
  `createby_ByID` varchar(100) DEFAULT NULL,
  `CreationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `send_mail` enum('True','False') DEFAULT 'True',
  `note_id` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `systemusers`
--

INSERT INTO `systemusers` (`Userid`, `station`, `region_zone`, `UserSubRegion`, `FirstName`, `SurName`, `UserName`, `UserPassword`, `UserRole`, `UserEmail`, `UserPhone`, `Active`, `LoggedOn`, `Reset`, `LastPasswdChange`, `LastLoggedIn`, `CreatedBy`, `createby_ByID`, `CreationDate`, `send_mail`, `note_id`) VALUES
(59, 0, '', NULL, 'Godfrey', 'Ntabazi', 'g.ntabazi', 'd1b6f409f535c9ea7eeb1cfd1fa0aa57', 'ManagerStationNetworks', 'ngdfrey@gmail.com', '0785294190', b'1', NULL, b'0', '2020-02-14 08:41:25', '2020-02-14 08:41:25', 'ManagerData', NULL, '2020-02-14 09:34:04', 'True', '200214083404AM01'),
(150, 17, 'Central', NULL, 'taibu', 'isabiryee', 't.isabiryee', '8b780011f43e7e5240475fc907bdb8d4', 'Observer', 'amtaibu@gmail.com', '078358474', b'1', NULL, b'0', '2021-01-18 20:45:55', '2021-01-18 20:45:55', 'ManagerStationNetworks', '71', '2021-01-18 22:22:27', 'True', NULL),
(151, 17, 'Central', NULL, 'taibu', 'isabirye', 't.isabirye', 'dc16d090a093b583ccc555ae92c0cf12', 'Observer', 'gettaibu@gmail.com', '078358474', b'1', NULL, b'0', '2021-01-19 19:58:23', '2021-01-19 19:58:23', 'ZonalOfficer', '102', '2021-01-19 21:30:02', 'True', NULL);

--
-- Triggers `systemusers`
--
DELIMITER $$
CREATE TRIGGER `update_data` AFTER UPDATE ON `systemusers` FOR EACH ROW BEGIN
	
    IF (NEW.FirstName != OLD.FirstName) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date`,`User`,`UserRole`,`Action`,`Details`,`station`,`IP`) 
        VALUES 
            (NEW.Userid, "Firstname", OLD.FirstName, NEW.FirstName, NOW(), @User,@UserRole,@Action,@Details,@station,@IP);
    END IF;
    IF (NEW.SurName != OLD.SurName) THEN
        INSERT INTO userlogs 
            (`data_id` , `field` , `old_value` , `new_value` , `Date`,`User`,`UserRole`,`Action`,`Details`,`station`,`IP`) 
        VALUES 
            (NEW.Userid, "Surname", OLD.Surname, NEW.Surname, NOW(), @User,@UserRole,@Action,@Details,@station,@IP);
    END IF;
    IF (NEW.UserEmail != OLD.UserEmail) THEN
        INSERT INTO userlogs  
            (`data_id` , `field` , `old_value` , `new_value` , `Date`,`User`,`UserRole`,`Action`,`Details`,`station`,`IP`) 
        VALUES 
            (NEW.Userid, "UserEmail", OLD.UserEmail, NEW.UserEmail, NOW(), @User,@UserRole,@Action,@Details,@station,@IP);
    END IF;
     IF (NEW.UserPhone != OLD.UserPhone) THEN
        INSERT INTO userlogs  
            (`data_id` , `field` , `old_value` , `new_value` , `Date`,`User`,`UserRole`,`Action`,`Details`,`station`,`IP`) 
        VALUES 
            (NEW.Userid, "UserPhone", OLD.UserPhone, NEW.UserPhone, NOW(), @User,@UserRole,@Action,@Details,@station,@IP);
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tenmeternode`
--

CREATE TABLE `tenmeternode` (
  `id` int NOT NULL,
  `station_id` int NOT NULL DEFAULT '111',
  `RTC_T` varchar(200) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `NAME` varchar(200) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `E64` varchar(200) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `V_A1` varchar(200) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `V_A2` varchar(200) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `P0_LST60` varchar(200) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `V_AD1` varchar(200) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `V_AD2` varchar(200) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `RSSI` varchar(200) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `TTL` varchar(200) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `LQI` varchar(200) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `SEQ` varchar(200) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `V_IN` varchar(200) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `V_MCU` varchar(200) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `UP_TIME` varchar(200) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `T` varchar(200) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `DATE` varchar(200) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `TIME` varchar(200) CHARACTER SET utf8mb3 DEFAULT NULL,
  `Parameter checked` varchar(200) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'false',
  `Trend checked` varchar(10) CHARACTER SET utf8mb3 NOT NULL DEFAULT 'false',
  `Ignore on calc trend` varchar(10) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'false',
  `hoursSinceEpoch` double DEFAULT NULL,
  `P0_LST` varchar(200) COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `tenmeternode`
--

INSERT INTO `tenmeternode` (`id`, `station_id`, `RTC_T`, `NAME`, `E64`, `V_A1`, `V_A2`, `P0_LST60`, `V_AD1`, `V_AD2`, `RSSI`, `TTL`, `LQI`, `SEQ`, `V_IN`, `V_MCU`, `UP_TIME`, `T`, `DATE`, `TIME`, `Parameter checked`, `Trend checked`, `Ignore on calc trend`, `hoursSinceEpoch`, `P0_LST`) VALUES
(513, 53, '2018-11-01,10:59:43', 'makg3-10m', 'fcc23d000000180f', NULL, NULL, NULL, NULL, NULL, '3', '15', '255', '0', NULL, '2.10', NULL, NULL, 'Thu Nov 01 2018', '13:57:08', 'false', 'false', 'false', 428074.9524802778, NULL),
(6481, 53, '2018-09-19,15:06:16', 'makg3-10m', NULL, '0.90', '2.51', '109', '0.080438', NULL, '37', '15', '255', '97', '3.59', '2.78', NULL, NULL, 'Mon Nov 12 2018', '15:16:02', 'false', 'false', 'false', 428340.2673238889, NULL),
(1631912, 57, '2020-08-04,18:17:23', 'lwg-10m', NULL, '0.00', '0.35', '204', '0.004969', NULL, '38', '15', '255', '213', '3.79', '2.63', NULL, NULL, 'Tue Aug 04 2020', '18:54:12', 'false', 'false', 'false', 443487.9035772222, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `twometernode`
--

CREATE TABLE `twometernode` (
  `id` int NOT NULL,
  `station_id` int NOT NULL DEFAULT '111',
  `RTC_T` varchar(200) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `NAME` varchar(200) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `E64` varchar(200) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `T_SHT2X` varchar(200) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `checked` varchar(20) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'default-value',
  `RH_SHT2X` varchar(200) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `checkr` varchar(200) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'default-value',
  `RSSI` varchar(200) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `TTL` varchar(200) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `LQI` varchar(200) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `V_IN` varchar(200) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `V_MCU` varchar(200) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `SEQ` varchar(200) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `UP_TIME` varchar(200) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `T` varchar(200) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `DATE` varchar(200) CHARACTER SET utf8mb3 DEFAULT NULL,
  `TIME` varchar(200) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `Parameter checked` varchar(200) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'false',
  `Trend checked` varchar(10) CHARACTER SET utf8mb3 NOT NULL DEFAULT 'false',
  `Ignore on calc trend` varchar(10) CHARACTER SET utf8mb3 NOT NULL DEFAULT 'false' COMMENT 'ignore row if its time difference is big to avoid wrong values',
  `hoursSinceEpoch` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `twometernode`
--

INSERT INTO `twometernode` (`id`, `station_id`, `RTC_T`, `NAME`, `E64`, `T_SHT2X`, `checked`, `RH_SHT2X`, `checkr`, `RSSI`, `TTL`, `LQI`, `V_IN`, `V_MCU`, `SEQ`, `UP_TIME`, `T`, `DATE`, `TIME`, `Parameter checked`, `Trend checked`, `Ignore on calc trend`, `hoursSinceEpoch`) VALUES
(277362, 52, '2018-12-31,22:01:36', 'kml-2m', NULL, '21.32', '', '86.40', '', '29', '15', '255', '3.79', '3.00', '88', NULL, NULL, 'Wed  Jan 22 2020', '22:24:57', 'false', 'false', 'false', 429523.41591083334),
(277636, 53, '2020-07-22,13:49:50', 'fos-2m', 'fcc23d0000005e22', '24.80', 'default-value', '68.40', 'default-value', '18', '15', '255', '4.03', '2.9', '208', NULL, '24.80', 'Wed Jul 22 2020', '14:23:58', 'false', 'false', 'false', 443171.39952222223),
(277637, 53, '2020-07-22,13:50:06', 'fos-2m', 'fcc23d0000005e22', '24.90', 'default-value', '68.90', 'default-value', '18', '15', '255', '4.03', '2.9', '209', NULL, '24.90', 'Wed Jul 22 2020', '14:23:58', 'false', 'false', 'false', 443171.3995225);

-- --------------------------------------------------------

--
-- Table structure for table `userlogs`
--

CREATE TABLE `userlogs` (
  `Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id` int NOT NULL,
  `data_id` int DEFAULT NULL,
  `Userid` int DEFAULT NULL,
  `Action` varchar(50) DEFAULT NULL,
  `Details` text,
  `field` varchar(45) DEFAULT NULL,
  `old_value` text,
  `new_value` text,
  `IP` varchar(25) DEFAULT NULL,
  `status` enum('00','11','10','01') DEFAULT NULL,
  `station_id` varchar(11) DEFAULT NULL,
  `users_region` varchar(500) DEFAULT NULL,
  `users_subregion` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userlogs`
--

INSERT INTO `userlogs` (`Date`, `id`, `data_id`, `Userid`, `Action`, `Details`, `field`, `old_value`, `new_value`, `IP`, `status`, `station_id`, `users_region`, `users_subregion`) VALUES
('2020-02-14 09:25:20', 1687, NULL, 1, 'Logged in', 'Admin manager logged into the system ', NULL, NULL, NULL, '10.10.30.106', NULL, NULL, NULL, NULL),
('2020-02-14 09:25:30', 1688, NULL, 1, 'Logged in', 'Admin manager logged into the system ', NULL, NULL, NULL, '10.1.6.174', NULL, NULL, NULL, NULL),
('2023-01-04 14:57:32', 6649, NULL, 133, 'Logged in', 'andrew mwesigwa logged into the system ', NULL, NULL, NULL, '10.103.3.251', NULL, NULL, 'Central,Western,Southern,Eastern,Northern,North-East,Equatorial Region,Lango sub-region,Test Region2', 'Central,Western,Southern,Eastern,Northern,North-East,Equatorial Region,Lango sub-region,Test Region2'),
('2023-06-14 09:42:18', 6650, NULL, 133, 'Logged in', 'andrew mwesigwa logged into the system ', NULL, NULL, NULL, '10.103.7.161', NULL, NULL, 'Central,Western,Southern,Eastern,Northern,North-East,Equatorial Region,Lango sub-region,Test Region2', 'Central,Western,Southern,Eastern,Northern,North-East,Equatorial Region,Lango sub-region,Test Region2');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `archivedekadalformreportdata`
--
ALTER TABLE `archivedekadalformreportdata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `archivemetarformdata`
--
ALTER TABLE `archivemetarformdata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `archivemonthlyrainfallformreportdata`
--
ALTER TABLE `archivemonthlyrainfallformreportdata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `archiveobservationslipformdata`
--
ALTER TABLE `archiveobservationslipformdata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `archivescannnedfiles`
--
ALTER TABLE `archivescannnedfiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `archivesynopticformreportdata`
--
ALTER TABLE `archivesynopticformreportdata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `archiveweathersummaryformreportdata`
--
ALTER TABLE `archiveweathersummaryformreportdata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aws`
--
ALTER TABLE `aws`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `elements`
--
ALTER TABLE `elements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groundnode`
--
ALTER TABLE `groundnode`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stationID` (`station_id`);

--
-- Indexes for table `instruments`
--
ALTER TABLE `instruments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nodestatus`
--
ALTER TABLE `nodestatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nodestatus_analyzer_checks`
--
ALTER TABLE `nodestatus_analyzer_checks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `observationslip`
--
ALTER TABLE `observationslip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `observationslipFromDesktop`
--
ALTER TABLE `observationslipFromDesktop`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `observationslipTestSync`
--
ALTER TABLE `observationslipTestSync`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `observtnslp_analyzer_checks`
--
ALTER TABLE `observtnslp_analyzer_checks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `problems`
--
ALTER TABLE `problems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `classification_id` (`classification_id`);

--
-- Indexes for table `problem_classification`
--
ALTER TABLE `problem_classification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `raw_datacomments`
--
ALTER TABLE `raw_datacomments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `scans_daily`
--
ALTER TABLE `scans_daily`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scans_dekadals`
--
ALTER TABLE `scans_dekadals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scans_monthly`
--
ALTER TABLE `scans_monthly`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scans_yearly`
--
ALTER TABLE `scans_yearly`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sensors`
--
ALTER TABLE `sensors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sinknode`
--
ALTER TABLE `sinknode`
  ADD PRIMARY KEY (`node_id`),
  ADD UNIQUE KEY `station_id` (`station_id`);

--
-- Indexes for table `speci_notification`
--
ALTER TABLE `speci_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stations`
--
ALTER TABLE `stations`
  ADD PRIMARY KEY (`station_id`);

--
-- Indexes for table `station_problem_settings`
--
ALTER TABLE `station_problem_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `problem_id` (`problem_id`),
  ADD KEY `station_id` (`station_id`);

--
-- Indexes for table `submitted_reports`
--
ALTER TABLE `submitted_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subregions`
--
ALTER TABLE `subregions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `systemusers`
--
ALTER TABLE `systemusers`
  ADD PRIMARY KEY (`Userid`);

--
-- Indexes for table `tenmeternode`
--
ALTER TABLE `tenmeternode`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stationID` (`station_id`);

--
-- Indexes for table `twometernode`
--
ALTER TABLE `twometernode`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stationID` (`station_id`);

--
-- Indexes for table `userlogs`
--
ALTER TABLE `userlogs`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `archivedekadalformreportdata`
--
ALTER TABLE `archivedekadalformreportdata`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `archivemetarformdata`
--
ALTER TABLE `archivemetarformdata`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `archivemonthlyrainfallformreportdata`
--
ALTER TABLE `archivemonthlyrainfallformreportdata`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `archiveobservationslipformdata`
--
ALTER TABLE `archiveobservationslipformdata`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `archivescannnedfiles`
--
ALTER TABLE `archivescannnedfiles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `archivesynopticformreportdata`
--
ALTER TABLE `archivesynopticformreportdata`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `archiveweathersummaryformreportdata`
--
ALTER TABLE `archiveweathersummaryformreportdata`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `aws`
--
ALTER TABLE `aws`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `elements`
--
ALTER TABLE `elements`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groundnode`
--
ALTER TABLE `groundnode`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2031764;

--
-- AUTO_INCREMENT for table `instruments`
--
ALTER TABLE `instruments`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nodestatus`
--
ALTER TABLE `nodestatus`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nodestatus_analyzer_checks`
--
ALTER TABLE `nodestatus_analyzer_checks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `observationslip`
--
ALTER TABLE `observationslip`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=559168;

--
-- AUTO_INCREMENT for table `observationslipFromDesktop`
--
ALTER TABLE `observationslipFromDesktop`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `observationslipTestSync`
--
ALTER TABLE `observationslipTestSync`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `observtnslp_analyzer_checks`
--
ALTER TABLE `observtnslp_analyzer_checks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `problems`
--
ALTER TABLE `problems`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `problem_classification`
--
ALTER TABLE `problem_classification`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `raw_datacomments`
--
ALTER TABLE `raw_datacomments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `report_id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `scans_daily`
--
ALTER TABLE `scans_daily`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `scans_dekadals`
--
ALTER TABLE `scans_dekadals`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `scans_monthly`
--
ALTER TABLE `scans_monthly`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'scannedarchiveweathersummaryformreportcopydetails', AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `scans_yearly`
--
ALTER TABLE `scans_yearly`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sensors`
--
ALTER TABLE `sensors`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sinknode`
--
ALTER TABLE `sinknode`
  MODIFY `node_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `speci_notification`
--
ALTER TABLE `speci_notification`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=432;

--
-- AUTO_INCREMENT for table `stations`
--
ALTER TABLE `stations`
  MODIFY `station_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `station_problem_settings`
--
ALTER TABLE `station_problem_settings`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `submitted_reports`
--
ALTER TABLE `submitted_reports`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `subregions`
--
ALTER TABLE `subregions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `systemusers`
--
ALTER TABLE `systemusers`
  MODIFY `Userid` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `tenmeternode`
--
ALTER TABLE `tenmeternode`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1631913;

--
-- AUTO_INCREMENT for table `twometernode`
--
ALTER TABLE `twometernode`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=277638;

--
-- AUTO_INCREMENT for table `userlogs`
--
ALTER TABLE `userlogs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6651;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
