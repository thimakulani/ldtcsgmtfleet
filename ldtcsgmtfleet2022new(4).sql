-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 12, 2022 at 09:17 AM
-- Server version: 8.0.27
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ldtcsgmtfleet2022new`
--

-- --------------------------------------------------------

--
-- Table structure for table `accidents`
--

DROP TABLE IF EXISTS `accidents`;
CREATE TABLE IF NOT EXISTS `accidents` (
  `accident_id` int NOT NULL AUTO_INCREMENT,
  `vehicle_registration_number` int DEFAULT NULL,
  `closing_km` int DEFAULT NULL,
  `drivers_surname` int DEFAULT NULL,
  `drivers_contact_details` int DEFAULT NULL,
  `dealer_name` int DEFAULT NULL,
  `model_of_vehicle` int DEFAULT NULL,
  `date_of_accident` date DEFAULT NULL,
  `z181_accident_form` varchar(40) DEFAULT NULL,
  `z181_accident_form_uploaded` varchar(40) DEFAULT NULL,
  `copy_of_trip_authority` varchar(40) DEFAULT NULL,
  `district` int DEFAULT NULL,
  `road_or_street` varchar(40) DEFAULT NULL,
  `coordinates` varchar(40) DEFAULT NULL,
  `deaths` varchar(40) DEFAULT NULL,
  `fatal_amount` varchar(40) DEFAULT NULL,
  `injured` varchar(40) DEFAULT NULL,
  `injured_amount` varchar(40) DEFAULT NULL,
  `description_of_accident` text,
  `insured` varchar(40) DEFAULT NULL,
  `upload_photos_damaged_vehicle` varchar(40) DEFAULT NULL,
  `copy_of_sketch_plan` varchar(40) DEFAULT NULL,
  `accident_report_driver` varchar(40) DEFAULT NULL,
  `accident_report_supervisior` varchar(40) DEFAULT NULL,
  `claims_report_accident_committee` varchar(40) DEFAULT NULL,
  `insurance_claims_report` varchar(40) DEFAULT NULL,
  `amount_paid` varchar(40) DEFAULT NULL,
  `police_officer` varchar(40) DEFAULT NULL,
  `contact_details` varchar(40) DEFAULT NULL,
  `case_number` varchar(40) DEFAULT 'CAS_',
  `police_report` varchar(40) DEFAULT NULL,
  `accident_report_number` varchar(40) DEFAULT NULL,
  `location` int DEFAULT NULL,
  PRIMARY KEY (`accident_id`),
  KEY `vehicle_registration_number` (`vehicle_registration_number`),
  KEY `closing_km` (`closing_km`),
  KEY `drivers_surname` (`drivers_surname`),
  KEY `dealer_name` (`dealer_name`),
  KEY `district` (`district`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `accident_type`
--

DROP TABLE IF EXISTS `accident_type`;
CREATE TABLE IF NOT EXISTS `accident_type` (
  `accident_type_id` int NOT NULL AUTO_INCREMENT,
  `accident_type` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`accident_type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `appgini_query_log`
--

DROP TABLE IF EXISTS `appgini_query_log`;
CREATE TABLE IF NOT EXISTS `appgini_query_log` (
  `datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `statement` longtext,
  `duration` decimal(10,2) UNSIGNED DEFAULT '0.00',
  `error` text,
  `memberID` varchar(200) DEFAULT NULL,
  `uri` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appgini_query_log`
--

INSERT INTO `appgini_query_log` (`datetime`, `statement`, `duration`, `error`, `memberID`, `uri`) VALUES
('2022-03-17 11:33:25', 'select count(1) from `gmt_fleet_register_2022` WHERE 1=1', '0.00', 'Table \'ldtcsgmtfleet2022new.gmt_fleet_register_2022\' doesn\'t exist', 'whoami', '/ldtcsgmtfleet2022new/index.php'),
('2022-03-17 11:40:48', 'select count(1) from `gmt_fleet_register_2022` WHERE 1=1', '0.00', 'Table \'ldtcsgmtfleet2022new.gmt_fleet_register_2022\' doesn\'t exist', 'whoami', '/ldtcsgmtfleet2022new/index.php'),
('2022-03-17 11:40:55', 'SELECT COUNT(1) FROM `gmt_fleet_register_2022` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register_2022`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register_2022`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register_2022`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register_2022`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register_2022`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register_2022`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register_2022`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register_2022`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register_2022`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register_2022`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register_2022`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register_2022`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register_2022`.`department_name_of_driver`  WHERE 1=1', '0.00', 'Table \'ldtcsgmtfleet2022new.gmt_fleet_register_2022\' doesn\'t exist', 'whoami', '/ldtcsgmtfleet2022new/gmt_fleet_register_2022_view.php'),
('2022-03-17 11:40:55', 'SELECT `gmt_fleet_register_2022`.`fleet_asset_id` AS \'fleet_asset_id\', `gmt_fleet_register_2022`.`vehicle_registration_number` AS \'vehicle_registration_number\', `gmt_fleet_register_2022`.`engine_number` AS \'engine_number\', `gmt_fleet_register_2022`.`chassis_number` AS \'chassis_number\', IF(    CHAR_LENGTH(`dealer1`.`dealer_name`), CONCAT_WS(\'\',   `dealer1`.`dealer_name`), \'\') /* Make of Vehicle/Dealer Name: */ AS \'dealer_name\', IF(    CHAR_LENGTH(`dealer2`.`make_of_vehicle`), CONCAT_WS(\'\',   `dealer2`.`make_of_vehicle`, \'   \'), \'\') /* Make of Vehicle: */ AS \'make_of_vehicle\', `gmt_fleet_register_2022`.`model_of_vehicle` AS \'model_of_vehicle\', IF(    CHAR_LENGTH(`year_model1`.`year_model_specification`), CONCAT_WS(\'\',   `year_model1`.`year_model_specification`), \'\') /* Year Model Specification: */ AS \'year_model_specification\', `gmt_fleet_register_2022`.`engine_capacity` AS \'engine_capacity\', `gmt_fleet_register_2022`.`tyre_size` AS \'tyre_size\', IF(    CHAR_LENGTH(`transmission1`.`transmission`), CONCAT_WS(\'\',   `transmission1`.`transmission`), \'\') /* Transmission: */ AS \'transmission\', IF(    CHAR_LENGTH(`fuel_type1`.`fuel_type`), CONCAT_WS(\'\',   `fuel_type1`.`fuel_type`), \'\') /* Fuel Type: */ AS \'fuel_type\', IF(    CHAR_LENGTH(`body_type1`.`type_of_vehicle`), CONCAT_WS(\'\',   `body_type1`.`type_of_vehicle`), \'\') /* Type of Vehicle: */ AS \'type_of_vehicle\', IF(    CHAR_LENGTH(`vehicle_colour1`.`colour_of_vehicle`), CONCAT_WS(\'\',   `vehicle_colour1`.`colour_of_vehicle`), \'\') /* Colour of Vehicle: */ AS \'colour_of_vehicle\', IF(    CHAR_LENGTH(`application_status1`.`application_status`), CONCAT_WS(\'\',   `application_status1`.`application_status`), \'\') /* Application Status: */ AS \'application_status\', `gmt_fleet_register_2022`.`barcode_number` AS \'barcode_number\', `gmt_fleet_register_2022`.`purchase_price` AS \'purchase_price\', `gmt_fleet_register_2022`.`depreciation_value` AS \'depreciation_value\', `gmt_fleet_register_2022`.`photo_of_vehicle` AS \'photo_of_vehicle\', `gmt_fleet_register_2022`.`user_name_and_surname` AS \'user_name_and_surname\', `gmt_fleet_register_2022`.`user_contact_email` AS \'user_contact_email\', `gmt_fleet_register_2022`.`contact_number` AS \'contact_number\', IF(    CHAR_LENGTH(`departments1`.`department_name`), CONCAT_WS(\'\',   `departments1`.`department_name`), \'\') /* Department Name: */ AS \'department_name\', `gmt_fleet_register_2022`.`department_address` AS \'department_address\', IF(    CHAR_LENGTH(`province1`.`province`), CONCAT_WS(\'\',   `province1`.`province`), \'\') /* Province: */ AS \'province\', IF(    CHAR_LENGTH(`districts1`.`district`) || CHAR_LENGTH(`districts1`.`station`), CONCAT_WS(\'\',   `districts1`.`district`, \'     |     and     |     \', `districts1`.`station`), \'\') /* District and Station: */ AS \'district\', IF(    CHAR_LENGTH(`driver1`.`drivers_name_and_surname`) || CHAR_LENGTH(`driver1`.`drivers_persal_number`), CONCAT_WS(\'\',   `driver1`.`drivers_name_and_surname`, \'      |    and    |         \', `driver1`.`drivers_persal_number`), \'\') /* Driver\\\'s Name & Surname: */ AS \'drivers_name_and_surname\', IF(    CHAR_LENGTH(`driver1`.`drivers_persal_number`), CONCAT_WS(\'\',   `driver1`.`drivers_persal_number`), \'\') /* Driver\\\'s Persal Number: */ AS \'drivers_persal_number\', IF(    CHAR_LENGTH(`departments2`.`department_name`), CONCAT_WS(\'\',   `departments2`.`department_name`), \'\') /* Department Name of Driver: */ AS \'department_name_of_driver\', IF(    CHAR_LENGTH(`driver1`.`drivers_contact_details`), CONCAT_WS(\'\',   `driver1`.`drivers_contact_details`), \'\') /* Driver\\\'s Contact Details: */ AS \'drivers_contact_details\', `gmt_fleet_register_2022`.`documents` AS \'documents\', if(`gmt_fleet_register_2022`.`date_auctioned`,date_format(`gmt_fleet_register_2022`.`date_auctioned`,\'%d/%m/%Y\'),\'\') AS \'date_auctioned\', `gmt_fleet_register_2022`.`comments` AS \'comments\', DATE_FORMAT(`gmt_fleet_register_2022`.`renewal_of_license`, \'%b %D, %Y %l:%i%p\') AS \'renewal_of_license\', `gmt_fleet_register_2022`.`mm_code` AS \'mm_code\', COALESCE(`gmt_fleet_register_2022`.`fleet_asset_id`) AS \'gmt_fleet_register_2022.fleet_asset_id\' FROM `gmt_fleet_register_2022` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register_2022`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register_2022`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register_2022`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register_2022`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register_2022`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register_2022`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register_2022`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register_2022`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register_2022`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register_2022`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register_2022`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register_2022`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register_2022`.`department_name_of_driver`  WHERE 1=1  LIMIT 0, 25', '0.00', 'Table \'ldtcsgmtfleet2022new.gmt_fleet_register_2022\' doesn\'t exist', 'whoami', '/ldtcsgmtfleet2022new/gmt_fleet_register_2022_view.php'),
('2022-03-17 11:41:08', 'SELECT COUNT(1) FROM `gmt_fleet_register_2022`', '0.00', 'Table \'ldtcsgmtfleet2022new.gmt_fleet_register_2022\' doesn\'t exist', 'whoami', '/ldtcsgmtfleet2022new/admin/pageHome.php'),
('2022-03-17 15:00:34', 'select vehicle_registration_number,engine_number from gmt_fleet_register where fleet_asset_id=\'1\'', '0.00', 'Table \'ldtcsgmtfleet2022new.gmt_fleet_register\' doesn\'t exist', 'whoami', '/ldtcsgmtfleet2022new/hooks/calendar.php'),
('2022-03-17 15:02:12', 'select vehicle_registration_number,engine_number from gmt_fleet_register where fleet_asset_id=\'1\'', '0.00', 'Table \'ldtcsgmtfleet2022new.gmt_fleet_register\' doesn\'t exist', 'whoami', '/ldtcsgmtfleet2022new/hooks/calendar.php'),
('2022-03-17 15:34:08', 'select vehicle_registration_number,engine_number from gmt_fleet_register where fleet_asset_id=\'1\'', '0.00', 'Table \'ldtcsgmtfleet2022new.gmt_fleet_register\' doesn\'t exist', 'whoami', '/ldtcsgmtfleet2022new/hooks/calendar.php'),
('2022-03-17 15:34:29', 'select vehicle_registration_number,engine_number from gmt_fleet_register where fleet_asset_id=\'1\'', '0.00', 'Table \'ldtcsgmtfleet2022new.gmt_fleet_register\' doesn\'t exist', 'whoami', '/ldtcsgmtfleet2022new/hooks/calendar.php'),
('2022-03-17 15:48:40', 'select vehicle_registration_number,engine_number from gmt_fleet_register where fleet_asset_id=\'1\'', '0.00', 'Table \'ldtcsgmtfleet2022new.gmt_fleet_register\' doesn\'t exist', 'whoami', '/ldtcsgmtfleet2022new/hooks/calendar.php'),
('2022-03-18 11:49:50', 'select vehicle_registration_number,engine_number from gmt_fleet_register where fleet_asset_id=\'1\'', '0.00', 'Table \'ldtcsgmtfleet2022new.gmt_fleet_register\' doesn\'t exist', 'whoami', '/ldtcsgmtfleet2022new/hooks/calendar.php'),
('2022-03-23 07:27:00', 'select vehicle_registration_number,engine_number from gmt_fleet_register where fleet_asset_id=\'1\'', '0.00', 'Table \'ldtcsgmtfleet2022new.gmt_fleet_register\' doesn\'t exist', 'whoami', '/ldtcsgmtfleet2022new/hooks/calendar.php'),
('2022-03-23 07:56:04', 'select vehicle_registration_number,engine_number from gmt_fleet_register where fleet_asset_id=\'1\'', '0.00', 'Table \'ldtcsgmtfleet2022new.gmt_fleet_register\' doesn\'t exist', 'whoami', '/ldtcsgmtfleet2022new/hooks/calendar.php'),
('2022-03-24 09:50:43', 'select vehicle_registration_number,engine_number from gmt_fleet_register where fleet_asset_id=\'1\'', '0.00', 'Table \'ldtcsgmtfleet2022new.gmt_fleet_register\' doesn\'t exist', 'whoami', '/ldtcsgmtfleet2022new/hooks/calendar.php'),
('2022-03-24 12:14:02', 'SHOW FIELDS FROM `gmt_fleet_register_2022`', '0.00', 'Table \'ldtcsgmtfleet2022new.gmt_fleet_register_2022\' doesn\'t exist', 'whoami', '/ldtcsgmtfleet2022new/admin/pageHome.php'),
('2022-03-24 12:27:35', 'SHOW FIELDS FROM `gmt_fleet_register_2022`', '0.00', 'Table \'ldtcsgmtfleet2022new.gmt_fleet_register_2022\' doesn\'t exist', 'whoami', '/ldtcsgmtfleet2022new/admin/pageHome.php'),
('2022-03-25 09:57:38', 'SELECT `modification_to_vehicle`.`modification_id` as \'modification_id\', IF(    CHAR_LENGTH(`body_type1`.`type_of_vehicle`), CONCAT_WS(\'\',   `body_type1`.`type_of_vehicle`), \'\') as \'type_of_vehicle\', `modification_to_vehicle`.`directorate` as \'directorate\', `modification_to_vehicle`.`head_office` as \'head_office\', IF(    CHAR_LENGTH(`districts1`.`district`) || CHAR_LENGTH(`districts1`.`station`), CONCAT_WS(\'\',   `districts1`.`district`, \'   |  and   |  \', `districts1`.`station`), \'\') as \'districts\', IF(    CHAR_LENGTH(`driver1`.`drivers_name_and_surname`) || CHAR_LENGTH(`driver1`.`drivers_email_address`), CONCAT_WS(\'\',   `driver1`.`drivers_name_and_surname`, \'   |  and   |  \', `driver1`.`drivers_email_address`), \'\') as \'drivers_name_and_surname\', IF(    CHAR_LENGTH(`driver1`.`drivers_persal_number`), CONCAT_WS(\'\',   `driver1`.`drivers_persal_number`), \'\') as \'drivers_persal_number\', IF(    CHAR_LENGTH(`driver1`.`drivers_contact_details`) || CHAR_LENGTH(`driver1`.`drivers_email_address`), CONCAT_WS(\'\',   `driver1`.`drivers_contact_details`, \'    |   and    | \', `driver1`.`drivers_email_address`), \'\') as \'drivers_contact_details\', `modification_to_vehicle`.`driver_rank` as \'driver_rank\', `modification_to_vehicle`.`driver_signature` as \'driver_signature\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`) || CHAR_LENGTH(`gmt_fleet_register1`.`chassis_number`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`vehicle_registration_number`, \'   |  and  |   \', `gmt_fleet_register1`.`chassis_number`), \'\') as \'vehicle_registration_number\', IF(    CHAR_LENGTH(`dealer1`.`make_of_vehicle`) || CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`), CONCAT_WS(\'\',   `dealer1`.`make_of_vehicle`, \'   \', \'   |  and  |   \', `gmt_fleet_register1`.`model_of_vehicle`), \'\') as \'make_of_vehicle\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`) || CHAR_LENGTH(`gmt_fleet_register1`.`chassis_number`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`model_of_vehicle`, \'   |  and  |   \', `gmt_fleet_register1`.`chassis_number`), \'\') as \'model_of_vehicle\', IF(    CHAR_LENGTH(`log_sheet1`.`closing_km`), CONCAT_WS(\'\',   `log_sheet1`.`closing_km`), \'\') as \'closing_km\', IF(    CHAR_LENGTH(`service1`.`job_card_number`), CONCAT_WS(\'\',   `service1`.`job_card_number`), \'\') as \'job_card_number\', `modification_to_vehicle`.`objective` as \'objective\', `modification_to_vehicle`.`fuel_gauge_amount` as \'fuel_gauge_amount\', `modification_to_vehicle`.`keys_ignition` as \'keys_ignition\', `modification_to_vehicle`.`petrol_cap_with_keys` as \'petrol_cap_with_keys\', `modification_to_vehicle`.`padlock_with_keys` as \'padlock_with_keys\', `modification_to_vehicle`.`tyre_r_f` as \'tyre_r_f\', `modification_to_vehicle`.`tyre_r_f_1` as \'tyre_r_f_1\', `modification_to_vehicle`.`tyre_r_r` as \'tyre_r_r\', `modification_to_vehicle`.`tyre_r_r_1` as \'tyre_r_r_1\', `modification_to_vehicle`.`tyre_l_f` as \'tyre_l_f\', `modification_to_vehicle`.`tyre_l_f_1` as \'tyre_l_f_1\', `modification_to_vehicle`.`tyer_l_r` as \'tyer_l_r\', `modification_to_vehicle`.`tyer_l_r_1` as \'tyer_l_r_1\', `modification_to_vehicle`.`tyre_spare` as \'tyre_spare\', `modification_to_vehicle`.`tyre_spare_1` as \'tyre_spare_1\', `modification_to_vehicle`.`wheel_cups` as \'wheel_cups\', `modification_to_vehicle`.`other` as \'other\', `modification_to_vehicle`.`battery` as \'battery\', `modification_to_vehicle`.`battery_voltage` as \'battery_voltage\', `modification_to_vehicle`.`wheel_spanner` as \'wheel_spanner\', `modification_to_vehicle`.`jack_with_handle` as \'jack_with_handle\', `modification_to_vehicle`.`radio_dvd_combination` as \'radio_dvd_combination\', `modification_to_vehicle`.`petrol_card` as \'petrol_card\', `modification_to_vehicle`.`valid_license_disc` as \'valid_license_disc\', if(`modification_to_vehicle`.`valid_license_disc_date`,date_format(`modification_to_vehicle`.`valid_license_disc_date`,\'%d/%m/%Y\'),\'\') as \'valid_license_disc_date\', `modification_to_vehicle`.`fire_extinguisher` as \'fire_extinguisher\', `modification_to_vehicle`.`warning_signs_traingle` as \'warning_signs_traingle\', if(`modification_to_vehicle`.`date_checked_in`,date_format(`modification_to_vehicle`.`date_checked_in`,\'%d/%m/%Y %H:%i\'),\'\') as \'date_checked_in\', `modification_to_vehicle`.`testing_officer_name_and_surname` as \'testing_officer_name_and_surname\', `modification_to_vehicle`.`testing_officer_persal_number` as \'testing_officer_persal_number\', `modification_to_vehicle`.`testing_officer_rank` as \'testing_officer_rank\', `modification_to_vehicle`.`testing_officer_signature` as \'testing_officer_signature\', if(`modification_to_vehicle`.`date_received`,date_format(`modification_to_vehicle`.`date_received`,\'%d/%m/%Y %H:%i\'),\'\') as \'date_received\', `modification_to_vehicle`.`supervisor_for_allocation_name_and_surname` as \'supervisor_for_allocation_name_and_surname\', `modification_to_vehicle`.`supervisor_for_allocation_persal_number` as \'supervisor_for_allocation_persal_number\', `modification_to_vehicle`.`supervisor_for_allocation_rank` as \'supervisor_for_allocation_rank\', `modification_to_vehicle`.`supervisor_for_allocation_signature` as \'supervisor_for_allocation_signature\' FROM `modification_to_vehicle` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`modification_to_vehicle`.`type_of_vehicle` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`modification_to_vehicle`.`districts` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`modification_to_vehicle`.`drivers_name_and_surname` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`modification_to_vehicle`.`vehicle_registration_number` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`modification_to_vehicle`.`closing_km` LEFT JOIN `service` as service1 ON `service1`.`service_id`=`modification_to_vehicle`.`job_card_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle`  WHERE 1=1 AND `modification_to_vehicle`.`modification_id`=\'1\'', '0.00', 'Unknown column \'modification_to_vehicle.districts\' in \'on clause\'', 'whoami', '/ldtcsgmtfleet2022new/modification_to_vehicle_view.php'),
('2022-03-25 10:01:56', 'SELECT `modification_to_vehicle`.`modification_id` as \'modification_id\', IF(    CHAR_LENGTH(`body_type1`.`type_of_vehicle`), CONCAT_WS(\'\',   `body_type1`.`type_of_vehicle`), \'\') as \'type_of_vehicle\', `modification_to_vehicle`.`directorate` as \'directorate\', `modification_to_vehicle`.`head_office` as \'head_office\', IF(    CHAR_LENGTH(`districts1`.`district`) || CHAR_LENGTH(`districts1`.`station`), CONCAT_WS(\'\',   `districts1`.`district`, \'   |  and   |  \', `districts1`.`station`), \'\') as \'districts\', IF(    CHAR_LENGTH(`driver1`.`drivers_name_and_surname`) || CHAR_LENGTH(`driver1`.`drivers_email_address`), CONCAT_WS(\'\',   `driver1`.`drivers_name_and_surname`, \'   |  and   |  \', `driver1`.`drivers_email_address`), \'\') as \'drivers_name_and_surname\', IF(    CHAR_LENGTH(`driver1`.`drivers_persal_number`), CONCAT_WS(\'\',   `driver1`.`drivers_persal_number`), \'\') as \'drivers_persal_number\', IF(    CHAR_LENGTH(`driver1`.`drivers_contact_details`) || CHAR_LENGTH(`driver1`.`drivers_email_address`), CONCAT_WS(\'\',   `driver1`.`drivers_contact_details`, \'    |   and    | \', `driver1`.`drivers_email_address`), \'\') as \'drivers_contact_details\', `modification_to_vehicle`.`driver_rank` as \'driver_rank\', `modification_to_vehicle`.`driver_signature` as \'driver_signature\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`) || CHAR_LENGTH(`gmt_fleet_register1`.`chassis_number`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`vehicle_registration_number`, \'   |  and  |   \', `gmt_fleet_register1`.`chassis_number`), \'\') as \'vehicle_registration_number\', IF(    CHAR_LENGTH(`dealer1`.`make_of_vehicle`) || CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`), CONCAT_WS(\'\',   `dealer1`.`make_of_vehicle`, \'   \', \'   |  and  |   \', `gmt_fleet_register1`.`model_of_vehicle`), \'\') as \'make_of_vehicle\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`) || CHAR_LENGTH(`gmt_fleet_register1`.`chassis_number`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`model_of_vehicle`, \'   |  and  |   \', `gmt_fleet_register1`.`chassis_number`), \'\') as \'model_of_vehicle\', IF(    CHAR_LENGTH(`log_sheet1`.`closing_km`), CONCAT_WS(\'\',   `log_sheet1`.`closing_km`), \'\') as \'closing_km\', IF(    CHAR_LENGTH(`service1`.`job_card_number`), CONCAT_WS(\'\',   `service1`.`job_card_number`), \'\') as \'job_card_number\', `modification_to_vehicle`.`objective` as \'objective\', `modification_to_vehicle`.`fuel_gauge_amount` as \'fuel_gauge_amount\', `modification_to_vehicle`.`keys_ignition` as \'keys_ignition\', `modification_to_vehicle`.`petrol_cap_with_keys` as \'petrol_cap_with_keys\', `modification_to_vehicle`.`padlock_with_keys` as \'padlock_with_keys\', `modification_to_vehicle`.`tyre_r_f` as \'tyre_r_f\', `modification_to_vehicle`.`tyre_r_f_1` as \'tyre_r_f_1\', `modification_to_vehicle`.`tyre_r_r` as \'tyre_r_r\', `modification_to_vehicle`.`tyre_r_r_1` as \'tyre_r_r_1\', `modification_to_vehicle`.`tyre_l_f` as \'tyre_l_f\', `modification_to_vehicle`.`tyre_l_f_1` as \'tyre_l_f_1\', `modification_to_vehicle`.`tyer_l_r` as \'tyer_l_r\', `modification_to_vehicle`.`tyer_l_r_1` as \'tyer_l_r_1\', `modification_to_vehicle`.`tyre_spare` as \'tyre_spare\', `modification_to_vehicle`.`tyre_spare_1` as \'tyre_spare_1\', `modification_to_vehicle`.`wheel_cups` as \'wheel_cups\', `modification_to_vehicle`.`other` as \'other\', `modification_to_vehicle`.`battery` as \'battery\', `modification_to_vehicle`.`battery_voltage` as \'battery_voltage\', `modification_to_vehicle`.`wheel_spanner` as \'wheel_spanner\', `modification_to_vehicle`.`jack_with_handle` as \'jack_with_handle\', `modification_to_vehicle`.`radio_dvd_combination` as \'radio_dvd_combination\', `modification_to_vehicle`.`petrol_card` as \'petrol_card\', `modification_to_vehicle`.`valid_license_disc` as \'valid_license_disc\', if(`modification_to_vehicle`.`valid_license_disc_date`,date_format(`modification_to_vehicle`.`valid_license_disc_date`,\'%d/%m/%Y\'),\'\') as \'valid_license_disc_date\', `modification_to_vehicle`.`fire_extinguisher` as \'fire_extinguisher\', `modification_to_vehicle`.`warning_signs_traingle` as \'warning_signs_traingle\', if(`modification_to_vehicle`.`date_checked_in`,date_format(`modification_to_vehicle`.`date_checked_in`,\'%d/%m/%Y %H:%i\'),\'\') as \'date_checked_in\', `modification_to_vehicle`.`testing_officer_name_and_surname` as \'testing_officer_name_and_surname\', `modification_to_vehicle`.`testing_officer_persal_number` as \'testing_officer_persal_number\', `modification_to_vehicle`.`testing_officer_rank` as \'testing_officer_rank\', `modification_to_vehicle`.`testing_officer_signature` as \'testing_officer_signature\', if(`modification_to_vehicle`.`date_received`,date_format(`modification_to_vehicle`.`date_received`,\'%d/%m/%Y %H:%i\'),\'\') as \'date_received\', `modification_to_vehicle`.`supervisor_for_allocation_name_and_surname` as \'supervisor_for_allocation_name_and_surname\', `modification_to_vehicle`.`supervisor_for_allocation_persal_number` as \'supervisor_for_allocation_persal_number\', `modification_to_vehicle`.`supervisor_for_allocation_rank` as \'supervisor_for_allocation_rank\', `modification_to_vehicle`.`supervisor_for_allocation_signature` as \'supervisor_for_allocation_signature\' FROM `modification_to_vehicle` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`modification_to_vehicle`.`type_of_vehicle` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`modification_to_vehicle`.`districts` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`modification_to_vehicle`.`drivers_name_and_surname` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`modification_to_vehicle`.`vehicle_registration_number` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`modification_to_vehicle`.`closing_km` LEFT JOIN `service` as service1 ON `service1`.`service_id`=`modification_to_vehicle`.`job_card_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle`  WHERE 1=1 AND `modification_to_vehicle`.`modification_id`=\'1\'', '0.00', 'Unknown column \'modification_to_vehicle.districts\' in \'on clause\'', 'whoami', '/ldtcsgmtfleet2022new/modification_to_vehicle_view.php'),
('2022-03-29 12:42:39', 'SELECT `service`.`service_id` AS \'service_id\', `service`.`breakdown_of_vehicle` AS \'breakdown_of_vehicle\', `service`.`service_title` AS \'service_title\', IF(    CHAR_LENGTH(`service_item_type1`.`service_item_type`), CONCAT_WS(\'\',   `service_item_type1`.`service_item_type`), \'\') /* Service Item Type: */ AS \'service_item_type\', IF(    CHAR_LENGTH(`service_categories1`.`service_category`), CONCAT_WS(\'\',   `service_categories1`.`service_category`), \'\') /* Service Category: */ AS \'service_category\', IF(    CHAR_LENGTH(`merchant1`.`merchant_name`) || CHAR_LENGTH(`merchant_type1`.`merchant_type`), CONCAT_WS(\'\',   `merchant1`.`merchant_name`, \'    |   and   |    \', `merchant_type1`.`merchant_type`), \'\') /* Merchant Name: */ AS \'merchant_name\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`vehicle_registration_number`), \'\') /* Registration Number: */ AS \'vehicle_registration_number\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`engine_number`), \'\') /* Engine Number: */ AS \'engine_number\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`chassis_number`) || CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`chassis_number`, \' |  and  |     \', `gmt_fleet_register1`.`vehicle_registration_number`), \'\') /* Chassis Number: */ AS \'chassis_number\', IF(    CHAR_LENGTH(`dealer1`.`dealer_name`), CONCAT_WS(\'\',   `dealer1`.`dealer_name`), \'\') /* Make of Vehicle/Dealer Name: */ AS \'dealer_name\', IF(    CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS(\'\',   `dealer1`.`make_of_vehicle`, \'   \'), \'\') /* Make of Vehicle: */ AS \'make_of_vehicle\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`model_of_vehicle`), \'\') /* Model of Vehicle: */ AS \'model_of_vehicle\', IF(    CHAR_LENGTH(`year_model1`.`year_model_specification`), CONCAT_WS(\'\',   `year_model1`.`year_model_specification`), \'\') /* Year Model of Vehicle: */ AS \'year_model_of_vehicle\', IF(    CHAR_LENGTH(`body_type1`.`type_of_vehicle`), CONCAT_WS(\'\',   `body_type1`.`type_of_vehicle`), \'\') /* Type of Vehicle: */ AS \'type_of_vehicle\', IF(    CHAR_LENGTH(`log_sheet1`.`closing_km`), CONCAT_WS(\'\',   `log_sheet1`.`closing_km`, \' \'), \'\') /* Odometer Reading (km): */ AS \'closing_km\', IF(    CHAR_LENGTH(`application_status1`.`application_status`), CONCAT_WS(\'\',   `application_status1`.`application_status`), \'\') /* Application Status: */ AS \'application_status\', IF(    CHAR_LENGTH(`work_allocation1`.`work_allocation_reference_number`), CONCAT_WS(\'\',   `work_allocation1`.`work_allocation_reference_number`), \'\') /* Work Allocation Reference Number: */ AS \'work_allocation_reference_number\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`barcode_number`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`barcode_number`), \'\') /* Barcode Number: */ AS \'barcode_number\', IF(    CHAR_LENGTH(`departments1`.`department_name`), CONCAT_WS(\'\',   `departments1`.`department_name`), \'\') /* Department: */ AS \'department\', `service`.`service_item` AS \'service_item\', IF(    CHAR_LENGTH(if(`schedule1`.`date`,date_format(`schedule1`.`date`,\'%d/%m/%Y\'),\'\')), CONCAT_WS(\'\',   if(`schedule1`.`date`,date_format(`schedule1`.`date`,\'%d/%m/%Y\'),\'\')), \'\') /* Date of Service: */ AS \'date_of_service\', IF(    CHAR_LENGTH(`schedule1`.`time`), CONCAT_WS(\'\',   `schedule1`.`time`), \'\') /* Time: */ AS \'time\', `service`.`upload_quotation` AS \'upload_quotation\', DATE_FORMAT(`service`.`date_of_next_service`, \'%D %b %Y %l:%i%p\') AS \'date_of_next_service\', `service`.`repeat_service_schedule_every_km` AS \'repeat_service_schedule_every_km\', `service`.`comments` AS \'comments\', `service`.`upload_invoice` AS \'upload_invoice\', IF(    CHAR_LENGTH(`reception1`.`reception_name_and_surname`) || CHAR_LENGTH(`reception1`.`reception_persal_number`), CONCAT_WS(\'\',   `reception1`.`reception_name_and_surname`, \'     |    and     |     \', `reception1`.`reception_persal_number`), \'\') /* Information Capture By Receptionist (Name & Surname): */ AS \'receptionist\', IF(    CHAR_LENGTH(`reception1`.`reception_email_address`) || CHAR_LENGTH(`reception1`.`reception_contact_details`), CONCAT_WS(\'\',   `reception1`.`reception_email_address`, \'     |     and      |    \', `reception1`.`reception_contact_details`), \'\') /* Receptionist Contact e-Mail: */ AS \'receptionist_contact_email\', IF(, CONCAT_WS(\'\', ), \'\') /* Workshop Name: */ AS \'workshop_name\', `service`.`workshop_address` AS \'workshop_address\', `service`.`technician` AS \'technician\', `service`.`work_order_status` AS \'work_order_status\', IF(    CHAR_LENGTH(`reception1`.`job_card_number`), CONCAT_WS(\'\',   `reception1`.`job_card_number`), \'\') /* Job Card Number: */ AS \'job_card_number\', if(`service`.`completion_date`,date_format(`service`.`completion_date`,\'%d/%m/%Y\'),\'\') AS \'completion_date\', if(`service`.`due_date`,date_format(`service`.`due_date`,\'%d/%m/%Y\'),\'\') AS \'due_date\', if(`service`.`birth_date`,date_format(`service`.`birth_date`,\'%d/%m/%Y\'),\'\') AS \'birth_date\', `service`.`age` AS \'age\', DATE_FORMAT(`service`.`filed`, \'%c/%e/%Y %l:%i%p\') AS \'filed\', DATE_FORMAT(`service`.`last_modified`, \'%c/%e/%Y %l:%i%p\') AS \'last_modified\', COALESCE(`service`.`service_id`) AS \'service.service_id\' FROM `service` LEFT JOIN `service_item_type` as service_item_type1 ON `service_item_type1`.`service_item_type_id`=`service`.`service_item_type` LEFT JOIN `service_categories` as service_categories1 ON `service_categories1`.`service_categories_id`=`service`.`service_category` LEFT JOIN `merchant` as merchant1 ON `merchant1`.`merchant_id`=`service`.`merchant_name` LEFT JOIN `merchant_type` as merchant_type1 ON `merchant_type1`.`merchant_type_id`=`merchant1`.`merchant_type` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`service`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`service`.`dealer_name` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`service`.`closing_km` LEFT JOIN `work_allocation` as work_allocation1 ON `work_allocation1`.`work_allocation_id`=`service`.`work_allocation_reference_number` LEFT JOIN `schedule` as schedule1 ON `schedule1`.`schedule_id`=`service`.`date_of_service` LEFT JOIN `reception` as reception1 ON `reception1`.`reception_user_id`=`service`.`receptionist` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register1`.`year_model_specification` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register1`.`type_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register1`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register1`.`department_name`  WHERE 1=1  LIMIT 0, 2000', '0.00', 'You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near \', CONCAT_WS(\'\', ), \'\') /* Workshop Name: */ AS \'workshop_name\', `service`.`works\' at line 1', 'whoami', '/ldtcsgmtfleet2022new/service_view.php'),
('2022-03-29 12:43:30', 'SELECT `service`.`service_id` AS \'service_id\', `service`.`breakdown_of_vehicle` AS \'breakdown_of_vehicle\', `service`.`service_title` AS \'service_title\', IF(    CHAR_LENGTH(`service_item_type1`.`service_item_type`), CONCAT_WS(\'\',   `service_item_type1`.`service_item_type`), \'\') /* Service Item Type: */ AS \'service_item_type\', IF(    CHAR_LENGTH(`service_categories1`.`service_category`), CONCAT_WS(\'\',   `service_categories1`.`service_category`), \'\') /* Service Category: */ AS \'service_category\', IF(    CHAR_LENGTH(`merchant1`.`merchant_name`) || CHAR_LENGTH(`merchant_type1`.`merchant_type`), CONCAT_WS(\'\',   `merchant1`.`merchant_name`, \'    |   and   |    \', `merchant_type1`.`merchant_type`), \'\') /* Merchant Name: */ AS \'merchant_name\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`vehicle_registration_number`), \'\') /* Registration Number: */ AS \'vehicle_registration_number\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`engine_number`), \'\') /* Engine Number: */ AS \'engine_number\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`chassis_number`) || CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`chassis_number`, \' |  and  |     \', `gmt_fleet_register1`.`vehicle_registration_number`), \'\') /* Chassis Number: */ AS \'chassis_number\', IF(    CHAR_LENGTH(`dealer1`.`dealer_name`), CONCAT_WS(\'\',   `dealer1`.`dealer_name`), \'\') /* Make of Vehicle/Dealer Name: */ AS \'dealer_name\', IF(    CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS(\'\',   `dealer1`.`make_of_vehicle`, \'   \'), \'\') /* Make of Vehicle: */ AS \'make_of_vehicle\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`model_of_vehicle`), \'\') /* Model of Vehicle: */ AS \'model_of_vehicle\', IF(    CHAR_LENGTH(`year_model1`.`year_model_specification`), CONCAT_WS(\'\',   `year_model1`.`year_model_specification`), \'\') /* Year Model of Vehicle: */ AS \'year_model_of_vehicle\', IF(    CHAR_LENGTH(`body_type1`.`type_of_vehicle`), CONCAT_WS(\'\',   `body_type1`.`type_of_vehicle`), \'\') /* Type of Vehicle: */ AS \'type_of_vehicle\', IF(    CHAR_LENGTH(`log_sheet1`.`closing_km`), CONCAT_WS(\'\',   `log_sheet1`.`closing_km`, \' \'), \'\') /* Odometer Reading (km): */ AS \'closing_km\', IF(    CHAR_LENGTH(`application_status1`.`application_status`), CONCAT_WS(\'\',   `application_status1`.`application_status`), \'\') /* Application Status: */ AS \'application_status\', IF(    CHAR_LENGTH(`work_allocation1`.`work_allocation_reference_number`), CONCAT_WS(\'\',   `work_allocation1`.`work_allocation_reference_number`), \'\') /* Work Allocation Reference Number: */ AS \'work_allocation_reference_number\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`barcode_number`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`barcode_number`), \'\') /* Barcode Number: */ AS \'barcode_number\', IF(    CHAR_LENGTH(`departments1`.`department_name`), CONCAT_WS(\'\',   `departments1`.`department_name`), \'\') /* Department: */ AS \'department\', `service`.`service_item` AS \'service_item\', IF(    CHAR_LENGTH(if(`schedule1`.`date`,date_format(`schedule1`.`date`,\'%d/%m/%Y\'),\'\')), CONCAT_WS(\'\',   if(`schedule1`.`date`,date_format(`schedule1`.`date`,\'%d/%m/%Y\'),\'\')), \'\') /* Date of Service: */ AS \'date_of_service\', IF(    CHAR_LENGTH(`schedule1`.`time`), CONCAT_WS(\'\',   `schedule1`.`time`), \'\') /* Time: */ AS \'time\', `service`.`upload_quotation` AS \'upload_quotation\', DATE_FORMAT(`service`.`date_of_next_service`, \'%D %b %Y %l:%i%p\') AS \'date_of_next_service\', `service`.`repeat_service_schedule_every_km` AS \'repeat_service_schedule_every_km\', `service`.`comments` AS \'comments\', `service`.`upload_invoice` AS \'upload_invoice\', IF(    CHAR_LENGTH(`reception1`.`reception_name_and_surname`) || CHAR_LENGTH(`reception1`.`reception_persal_number`), CONCAT_WS(\'\',   `reception1`.`reception_name_and_surname`, \'     |    and     |     \', `reception1`.`reception_persal_number`), \'\') /* Information Capture By Receptionist (Name & Surname): */ AS \'receptionist\', IF(    CHAR_LENGTH(`reception1`.`reception_email_address`) || CHAR_LENGTH(`reception1`.`reception_contact_details`), CONCAT_WS(\'\',   `reception1`.`reception_email_address`, \'     |     and      |    \', `reception1`.`reception_contact_details`), \'\') /* Receptionist Contact e-Mail: */ AS \'receptionist_contact_email\', IF(, CONCAT_WS(\'\', ), \'\') /* Workshop Name: */ AS \'workshop_name\', `service`.`workshop_address` AS \'workshop_address\', `service`.`technician` AS \'technician\', `service`.`work_order_status` AS \'work_order_status\', IF(    CHAR_LENGTH(`reception1`.`job_card_number`), CONCAT_WS(\'\',   `reception1`.`job_card_number`), \'\') /* Job Card Number: */ AS \'job_card_number\', if(`service`.`completion_date`,date_format(`service`.`completion_date`,\'%d/%m/%Y\'),\'\') AS \'completion_date\', if(`service`.`due_date`,date_format(`service`.`due_date`,\'%d/%m/%Y\'),\'\') AS \'due_date\', if(`service`.`birth_date`,date_format(`service`.`birth_date`,\'%d/%m/%Y\'),\'\') AS \'birth_date\', `service`.`age` AS \'age\', DATE_FORMAT(`service`.`filed`, \'%c/%e/%Y %l:%i%p\') AS \'filed\', DATE_FORMAT(`service`.`last_modified`, \'%c/%e/%Y %l:%i%p\') AS \'last_modified\', COALESCE(`service`.`service_id`) AS \'service.service_id\' FROM `service` LEFT JOIN `service_item_type` as service_item_type1 ON `service_item_type1`.`service_item_type_id`=`service`.`service_item_type` LEFT JOIN `service_categories` as service_categories1 ON `service_categories1`.`service_categories_id`=`service`.`service_category` LEFT JOIN `merchant` as merchant1 ON `merchant1`.`merchant_id`=`service`.`merchant_name` LEFT JOIN `merchant_type` as merchant_type1 ON `merchant_type1`.`merchant_type_id`=`merchant1`.`merchant_type` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`service`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`service`.`dealer_name` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`service`.`closing_km` LEFT JOIN `work_allocation` as work_allocation1 ON `work_allocation1`.`work_allocation_id`=`service`.`work_allocation_reference_number` LEFT JOIN `schedule` as schedule1 ON `schedule1`.`schedule_id`=`service`.`date_of_service` LEFT JOIN `reception` as reception1 ON `reception1`.`reception_user_id`=`service`.`receptionist` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register1`.`year_model_specification` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register1`.`type_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register1`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register1`.`department_name`  WHERE 1=1  LIMIT 0, 2000', '0.00', 'You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near \', CONCAT_WS(\'\', ), \'\') /* Workshop Name: */ AS \'workshop_name\', `service`.`works\' at line 1', 'whoami', '/ldtcsgmtfleet2022new/service_view.php'),
('2022-03-29 12:43:36', 'SELECT `service`.`service_id` AS \'service_id\', `service`.`breakdown_of_vehicle` AS \'breakdown_of_vehicle\', `service`.`service_title` AS \'service_title\', IF(    CHAR_LENGTH(`service_item_type1`.`service_item_type`), CONCAT_WS(\'\',   `service_item_type1`.`service_item_type`), \'\') /* Service Item Type: */ AS \'service_item_type\', IF(    CHAR_LENGTH(`service_categories1`.`service_category`), CONCAT_WS(\'\',   `service_categories1`.`service_category`), \'\') /* Service Category: */ AS \'service_category\', IF(    CHAR_LENGTH(`merchant1`.`merchant_name`) || CHAR_LENGTH(`merchant_type1`.`merchant_type`), CONCAT_WS(\'\',   `merchant1`.`merchant_name`, \'    |   and   |    \', `merchant_type1`.`merchant_type`), \'\') /* Merchant Name: */ AS \'merchant_name\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`vehicle_registration_number`), \'\') /* Registration Number: */ AS \'vehicle_registration_number\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`engine_number`), \'\') /* Engine Number: */ AS \'engine_number\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`chassis_number`) || CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`chassis_number`, \' |  and  |     \', `gmt_fleet_register1`.`vehicle_registration_number`), \'\') /* Chassis Number: */ AS \'chassis_number\', IF(    CHAR_LENGTH(`dealer1`.`dealer_name`), CONCAT_WS(\'\',   `dealer1`.`dealer_name`), \'\') /* Make of Vehicle/Dealer Name: */ AS \'dealer_name\', IF(    CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS(\'\',   `dealer1`.`make_of_vehicle`, \'   \'), \'\') /* Make of Vehicle: */ AS \'make_of_vehicle\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`model_of_vehicle`), \'\') /* Model of Vehicle: */ AS \'model_of_vehicle\', IF(    CHAR_LENGTH(`year_model1`.`year_model_specification`), CONCAT_WS(\'\',   `year_model1`.`year_model_specification`), \'\') /* Year Model of Vehicle: */ AS \'year_model_of_vehicle\', IF(    CHAR_LENGTH(`body_type1`.`type_of_vehicle`), CONCAT_WS(\'\',   `body_type1`.`type_of_vehicle`), \'\') /* Type of Vehicle: */ AS \'type_of_vehicle\', IF(    CHAR_LENGTH(`log_sheet1`.`closing_km`), CONCAT_WS(\'\',   `log_sheet1`.`closing_km`, \' \'), \'\') /* Odometer Reading (km): */ AS \'closing_km\', IF(    CHAR_LENGTH(`application_status1`.`application_status`), CONCAT_WS(\'\',   `application_status1`.`application_status`), \'\') /* Application Status: */ AS \'application_status\', IF(    CHAR_LENGTH(`work_allocation1`.`work_allocation_reference_number`), CONCAT_WS(\'\',   `work_allocation1`.`work_allocation_reference_number`), \'\') /* Work Allocation Reference Number: */ AS \'work_allocation_reference_number\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`barcode_number`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`barcode_number`), \'\') /* Barcode Number: */ AS \'barcode_number\', IF(    CHAR_LENGTH(`departments1`.`department_name`), CONCAT_WS(\'\',   `departments1`.`department_name`), \'\') /* Department: */ AS \'department\', `service`.`service_item` AS \'service_item\', IF(    CHAR_LENGTH(if(`schedule1`.`date`,date_format(`schedule1`.`date`,\'%d/%m/%Y\'),\'\')), CONCAT_WS(\'\',   if(`schedule1`.`date`,date_format(`schedule1`.`date`,\'%d/%m/%Y\'),\'\')), \'\') /* Date of Service: */ AS \'date_of_service\', IF(    CHAR_LENGTH(`schedule1`.`time`), CONCAT_WS(\'\',   `schedule1`.`time`), \'\') /* Time: */ AS \'time\', `service`.`upload_quotation` AS \'upload_quotation\', DATE_FORMAT(`service`.`date_of_next_service`, \'%D %b %Y %l:%i%p\') AS \'date_of_next_service\', `service`.`repeat_service_schedule_every_km` AS \'repeat_service_schedule_every_km\', `service`.`comments` AS \'comments\', `service`.`upload_invoice` AS \'upload_invoice\', IF(    CHAR_LENGTH(`reception1`.`reception_name_and_surname`) || CHAR_LENGTH(`reception1`.`reception_persal_number`), CONCAT_WS(\'\',   `reception1`.`reception_name_and_surname`, \'     |    and     |     \', `reception1`.`reception_persal_number`), \'\') /* Information Capture By Receptionist (Name & Surname): */ AS \'receptionist\', IF(    CHAR_LENGTH(`reception1`.`reception_email_address`) || CHAR_LENGTH(`reception1`.`reception_contact_details`), CONCAT_WS(\'\',   `reception1`.`reception_email_address`, \'     |     and      |    \', `reception1`.`reception_contact_details`), \'\') /* Receptionist Contact e-Mail: */ AS \'receptionist_contact_email\', IF(, CONCAT_WS(\'\', ), \'\') /* Workshop Name: */ AS \'workshop_name\', `service`.`workshop_address` AS \'workshop_address\', `service`.`technician` AS \'technician\', `service`.`work_order_status` AS \'work_order_status\', IF(    CHAR_LENGTH(`reception1`.`job_card_number`), CONCAT_WS(\'\',   `reception1`.`job_card_number`), \'\') /* Job Card Number: */ AS \'job_card_number\', if(`service`.`completion_date`,date_format(`service`.`completion_date`,\'%d/%m/%Y\'),\'\') AS \'completion_date\', if(`service`.`due_date`,date_format(`service`.`due_date`,\'%d/%m/%Y\'),\'\') AS \'due_date\', if(`service`.`birth_date`,date_format(`service`.`birth_date`,\'%d/%m/%Y\'),\'\') AS \'birth_date\', `service`.`age` AS \'age\', DATE_FORMAT(`service`.`filed`, \'%c/%e/%Y %l:%i%p\') AS \'filed\', DATE_FORMAT(`service`.`last_modified`, \'%c/%e/%Y %l:%i%p\') AS \'last_modified\', COALESCE(`service`.`service_id`) AS \'service.service_id\' FROM `service` LEFT JOIN `service_item_type` as service_item_type1 ON `service_item_type1`.`service_item_type_id`=`service`.`service_item_type` LEFT JOIN `service_categories` as service_categories1 ON `service_categories1`.`service_categories_id`=`service`.`service_category` LEFT JOIN `merchant` as merchant1 ON `merchant1`.`merchant_id`=`service`.`merchant_name` LEFT JOIN `merchant_type` as merchant_type1 ON `merchant_type1`.`merchant_type_id`=`merchant1`.`merchant_type` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`service`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`service`.`dealer_name` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`service`.`closing_km` LEFT JOIN `work_allocation` as work_allocation1 ON `work_allocation1`.`work_allocation_id`=`service`.`work_allocation_reference_number` LEFT JOIN `schedule` as schedule1 ON `schedule1`.`schedule_id`=`service`.`date_of_service` LEFT JOIN `reception` as reception1 ON `reception1`.`reception_user_id`=`service`.`receptionist` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register1`.`year_model_specification` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register1`.`type_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register1`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register1`.`department_name`  WHERE 1=1  LIMIT 0, 2000', '0.00', 'You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near \', CONCAT_WS(\'\', ), \'\') /* Workshop Name: */ AS \'workshop_name\', `service`.`works\' at line 1', 'whoami', '/ldtcsgmtfleet2022new/service_view.php');
INSERT INTO `appgini_query_log` (`datetime`, `statement`, `duration`, `error`, `memberID`, `uri`) VALUES
('2022-03-29 12:44:39', 'SELECT `service`.`service_id` AS \'service_id\', `service`.`breakdown_of_vehicle` AS \'breakdown_of_vehicle\', `service`.`service_title` AS \'service_title\', IF(    CHAR_LENGTH(`service_item_type1`.`service_item_type`), CONCAT_WS(\'\',   `service_item_type1`.`service_item_type`), \'\') /* Service Item Type: */ AS \'service_item_type\', IF(    CHAR_LENGTH(`service_categories1`.`service_category`), CONCAT_WS(\'\',   `service_categories1`.`service_category`), \'\') /* Service Category: */ AS \'service_category\', IF(    CHAR_LENGTH(`merchant1`.`merchant_name`) || CHAR_LENGTH(`merchant_type1`.`merchant_type`), CONCAT_WS(\'\',   `merchant1`.`merchant_name`, \'    |   and   |    \', `merchant_type1`.`merchant_type`), \'\') /* Merchant Name: */ AS \'merchant_name\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`vehicle_registration_number`), \'\') /* Registration Number: */ AS \'vehicle_registration_number\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`engine_number`), \'\') /* Engine Number: */ AS \'engine_number\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`chassis_number`) || CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`chassis_number`, \' |  and  |     \', `gmt_fleet_register1`.`vehicle_registration_number`), \'\') /* Chassis Number: */ AS \'chassis_number\', IF(    CHAR_LENGTH(`dealer1`.`dealer_name`), CONCAT_WS(\'\',   `dealer1`.`dealer_name`), \'\') /* Make of Vehicle/Dealer Name: */ AS \'dealer_name\', IF(    CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS(\'\',   `dealer1`.`make_of_vehicle`, \'   \'), \'\') /* Make of Vehicle: */ AS \'make_of_vehicle\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`model_of_vehicle`), \'\') /* Model of Vehicle: */ AS \'model_of_vehicle\', IF(    CHAR_LENGTH(`year_model1`.`year_model_specification`), CONCAT_WS(\'\',   `year_model1`.`year_model_specification`), \'\') /* Year Model of Vehicle: */ AS \'year_model_of_vehicle\', IF(    CHAR_LENGTH(`body_type1`.`type_of_vehicle`), CONCAT_WS(\'\',   `body_type1`.`type_of_vehicle`), \'\') /* Type of Vehicle: */ AS \'type_of_vehicle\', IF(    CHAR_LENGTH(`log_sheet1`.`closing_km`), CONCAT_WS(\'\',   `log_sheet1`.`closing_km`, \' \'), \'\') /* Odometer Reading (km): */ AS \'closing_km\', IF(    CHAR_LENGTH(`application_status1`.`application_status`), CONCAT_WS(\'\',   `application_status1`.`application_status`), \'\') /* Application Status: */ AS \'application_status\', IF(    CHAR_LENGTH(`work_allocation1`.`work_allocation_reference_number`), CONCAT_WS(\'\',   `work_allocation1`.`work_allocation_reference_number`), \'\') /* Work Allocation Reference Number: */ AS \'work_allocation_reference_number\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`barcode_number`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`barcode_number`), \'\') /* Barcode Number: */ AS \'barcode_number\', IF(    CHAR_LENGTH(`departments1`.`department_name`), CONCAT_WS(\'\',   `departments1`.`department_name`), \'\') /* Department: */ AS \'department\', `service`.`service_item` AS \'service_item\', IF(    CHAR_LENGTH(if(`schedule1`.`date`,date_format(`schedule1`.`date`,\'%d/%m/%Y\'),\'\')), CONCAT_WS(\'\',   if(`schedule1`.`date`,date_format(`schedule1`.`date`,\'%d/%m/%Y\'),\'\')), \'\') /* Date of Service: */ AS \'date_of_service\', IF(    CHAR_LENGTH(`schedule1`.`time`), CONCAT_WS(\'\',   `schedule1`.`time`), \'\') /* Time: */ AS \'time\', `service`.`upload_quotation` AS \'upload_quotation\', DATE_FORMAT(`service`.`date_of_next_service`, \'%D %b %Y %l:%i%p\') AS \'date_of_next_service\', `service`.`repeat_service_schedule_every_km` AS \'repeat_service_schedule_every_km\', `service`.`comments` AS \'comments\', `service`.`upload_invoice` AS \'upload_invoice\', IF(    CHAR_LENGTH(`reception1`.`reception_name_and_surname`) || CHAR_LENGTH(`reception1`.`reception_persal_number`), CONCAT_WS(\'\',   `reception1`.`reception_name_and_surname`, \'     |    and     |     \', `reception1`.`reception_persal_number`), \'\') /* Information Capture By Receptionist (Name & Surname): */ AS \'receptionist\', IF(    CHAR_LENGTH(`reception1`.`reception_email_address`) || CHAR_LENGTH(`reception1`.`reception_contact_details`), CONCAT_WS(\'\',   `reception1`.`reception_email_address`, \'     |     and      |    \', `reception1`.`reception_contact_details`), \'\') /* Receptionist Contact e-Mail: */ AS \'receptionist_contact_email\', IF(, CONCAT_WS(\'\', ), \'\') /* Workshop Name: */ AS \'workshop_name\', `service`.`workshop_address` AS \'workshop_address\', `service`.`technician` AS \'technician\', `service`.`work_order_status` AS \'work_order_status\', IF(    CHAR_LENGTH(`reception1`.`job_card_number`), CONCAT_WS(\'\',   `reception1`.`job_card_number`), \'\') /* Job Card Number: */ AS \'job_card_number\', if(`service`.`completion_date`,date_format(`service`.`completion_date`,\'%d/%m/%Y\'),\'\') AS \'completion_date\', if(`service`.`due_date`,date_format(`service`.`due_date`,\'%d/%m/%Y\'),\'\') AS \'due_date\', if(`service`.`birth_date`,date_format(`service`.`birth_date`,\'%d/%m/%Y\'),\'\') AS \'birth_date\', `service`.`age` AS \'age\', DATE_FORMAT(`service`.`filed`, \'%c/%e/%Y %l:%i%p\') AS \'filed\', DATE_FORMAT(`service`.`last_modified`, \'%c/%e/%Y %l:%i%p\') AS \'last_modified\', COALESCE(`service`.`service_id`) AS \'service.service_id\' FROM `service` LEFT JOIN `service_item_type` as service_item_type1 ON `service_item_type1`.`service_item_type_id`=`service`.`service_item_type` LEFT JOIN `service_categories` as service_categories1 ON `service_categories1`.`service_categories_id`=`service`.`service_category` LEFT JOIN `merchant` as merchant1 ON `merchant1`.`merchant_id`=`service`.`merchant_name` LEFT JOIN `merchant_type` as merchant_type1 ON `merchant_type1`.`merchant_type_id`=`merchant1`.`merchant_type` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`service`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`service`.`dealer_name` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`service`.`closing_km` LEFT JOIN `work_allocation` as work_allocation1 ON `work_allocation1`.`work_allocation_id`=`service`.`work_allocation_reference_number` LEFT JOIN `schedule` as schedule1 ON `schedule1`.`schedule_id`=`service`.`date_of_service` LEFT JOIN `reception` as reception1 ON `reception1`.`reception_user_id`=`service`.`receptionist` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register1`.`year_model_specification` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register1`.`type_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register1`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register1`.`department_name`  WHERE 1=1  LIMIT 0, 2000', '0.00', 'You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near \', CONCAT_WS(\'\', ), \'\') /* Workshop Name: */ AS \'workshop_name\', `service`.`works\' at line 1', 'whoami', '/ldtcsgmtfleet2022new/service_view.php?t=1648557875'),
('2022-03-30 11:31:30', 'show tables like \'membership_%\'', '3.11', NULL, 'whoami', '/ldtcsgmtfleet2022new/ajax_check_login.php'),
('2022-03-31 10:04:11', 'SELECT `service`.`service_id` as \'service_id\', `service`.`breakdown_of_vehicle` as \'breakdown_of_vehicle\', `service`.`service_title` as \'service_title\', IF(    CHAR_LENGTH(`service_item_type1`.`service_item_type`), CONCAT_WS(\'\',   `service_item_type1`.`service_item_type`), \'\') as \'service_item_type\', IF(    CHAR_LENGTH(`service_categories1`.`service_category`), CONCAT_WS(\'\',   `service_categories1`.`service_category`), \'\') as \'service_category\', IF(    CHAR_LENGTH(`merchant1`.`merchant_name`) || CHAR_LENGTH(`merchant_type1`.`merchant_type`), CONCAT_WS(\'\',   `merchant1`.`merchant_name`, \'    |   and   |    \', `merchant_type1`.`merchant_type`), \'\') as \'merchant_name\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`vehicle_registration_number`), \'\') as \'vehicle_registration_number\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`engine_number`), \'\') as \'engine_number\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`chassis_number`) || CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`chassis_number`, \' |  and  |     \', `gmt_fleet_register1`.`vehicle_registration_number`), \'\') as \'chassis_number\', IF(    CHAR_LENGTH(`dealer1`.`dealer_name`), CONCAT_WS(\'\',   `dealer1`.`dealer_name`), \'\') as \'dealer_name\', IF(    CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS(\'\',   `dealer1`.`make_of_vehicle`, \'   \'), \'\') as \'make_of_vehicle\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`model_of_vehicle`), \'\') as \'model_of_vehicle\', IF(    CHAR_LENGTH(`year_model1`.`year_model_specification`), CONCAT_WS(\'\',   `year_model1`.`year_model_specification`), \'\') as \'year_model_of_vehicle\', IF(    CHAR_LENGTH(`body_type1`.`type_of_vehicle`), CONCAT_WS(\'\',   `body_type1`.`type_of_vehicle`), \'\') as \'type_of_vehicle\', IF(    CHAR_LENGTH(`log_sheet1`.`closing_km`), CONCAT_WS(\'\',   `log_sheet1`.`closing_km`, \' \'), \'\') as \'closing_km\', IF(    CHAR_LENGTH(`application_status1`.`application_status`), CONCAT_WS(\'\',   `application_status1`.`application_status`), \'\') as \'application_status\', IF(    CHAR_LENGTH(`work_allocation1`.`work_allocation_reference_number`), CONCAT_WS(\'\',   `work_allocation1`.`work_allocation_reference_number`), \'\') as \'work_allocation_reference_number\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`barcode_number`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`barcode_number`), \'\') as \'barcode_number\', IF(    CHAR_LENGTH(`departments1`.`department_name`), CONCAT_WS(\'\',   `departments1`.`department_name`), \'\') as \'department\', `service`.`service_item` as \'service_item\', IF(    CHAR_LENGTH(if(`schedule1`.`date`,date_format(`schedule1`.`date`,\'%d/%m/%Y\'),\'\')), CONCAT_WS(\'\',   if(`schedule1`.`date`,date_format(`schedule1`.`date`,\'%d/%m/%Y\'),\'\')), \'\') as \'date_of_service\', IF(    CHAR_LENGTH(`schedule1`.`time`), CONCAT_WS(\'\',   `schedule1`.`time`), \'\') as \'time\', `service`.`upload_quotation` as \'upload_quotation\', DATE_FORMAT(`service`.`date_of_next_service`, \'%D %b %Y %l:%i%p\') as \'date_of_next_service\', `service`.`repeat_service_schedule_every_km` as \'repeat_service_schedule_every_km\', `service`.`comments` as \'comments\', `service`.`upload_invoice` as \'upload_invoice\', IF(    CHAR_LENGTH(`reception1`.`reception_name_and_surname`) || CHAR_LENGTH(`reception1`.`reception_persal_number`), CONCAT_WS(\'\',   `reception1`.`reception_name_and_surname`, \'     |    and     |     \', `reception1`.`reception_persal_number`), \'\') as \'receptionist\', IF(    CHAR_LENGTH(`reception1`.`reception_email_address`) || CHAR_LENGTH(`reception1`.`reception_contact_details`), CONCAT_WS(\'\',   `reception1`.`reception_email_address`, \'     |     and      |    \', `reception1`.`reception_contact_details`), \'\') as \'receptionist_contact_email\', IF(    CHAR_LENGTH(`districts1`.`district`) || CHAR_LENGTH(`districts1`.`station`), CONCAT_WS(\'\',   `districts1`.`district`, \'     |    and     |     \', `districts1`.`station`), \'\') as \'workshop_name\', `service`.`workshop_address` as \'workshop_address\', `service`.`technician` as \'technician\', `service`.`work_order_status` as \'work_order_status\', IF(    CHAR_LENGTH(`reception1`.`job_card_number`), CONCAT_WS(\'\',   `reception1`.`job_card_number`), \'\') as \'job_card_number\', if(`service`.`completion_date`,date_format(`service`.`completion_date`,\'%d/%m/%Y\'),\'\') as \'completion_date\', if(`service`.`due_date`,date_format(`service`.`due_date`,\'%d/%m/%Y\'),\'\') as \'due_date\', if(`service`.`birth_date`,date_format(`service`.`birth_date`,\'%d/%m/%Y\'),\'\') as \'birth_date\', `service`.`age` as \'age\', DATE_FORMAT(`service`.`filed`, \'%c/%e/%Y %l:%i%p\') as \'filed\', DATE_FORMAT(`service`.`last_modified`, \'%c/%e/%Y %l:%i%p\') as \'last_modified\' FROM `service` LEFT JOIN `service_item_type` as service_item_type1 ON `service_item_type1`.`service_item_type_id`=`service`.`service_item_type` LEFT JOIN `service_categories` as service_categories1 ON `service_categories1`.`service_categories_id`=`service`.`service_category` LEFT JOIN `merchant` as merchant1 ON `merchant1`.`merchant_id`=`service`.`merchant_name` LEFT JOIN `merchant_type` as merchant_type1 ON `merchant_type1`.`merchant_type_id`=`merchant1`.`merchant_type` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`service`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`service`.`dealer_name` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`service`.`closing_km` LEFT JOIN `work_allocation` as work_allocation1 ON `work_allocation1`.`work_allocation_id`=`service`.`work_allocation_reference_number` LEFT JOIN `schedule` as schedule1 ON `schedule1`.`schedule_id`=`service`.`date_of_service` LEFT JOIN `reception` as reception1 ON `reception1`.`reception_user_id`=`service`.`receptionist` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`service`.`workshop_name` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register1`.`year_model_specification` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register1`.`type_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register1`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register1`.`department_name`  WHERE 1=1 AND `service`.`service_id`=\'1\'', '0.00', 'Unknown column \'service.birth_date\' in \'field list\'', 'whoami', '/ldtcsgmtfleet2022new/service_view.php'),
('2022-03-31 10:04:41', 'SELECT `service`.`service_id` as \'service_id\', `service`.`breakdown_of_vehicle` as \'breakdown_of_vehicle\', `service`.`service_title` as \'service_title\', IF(    CHAR_LENGTH(`service_item_type1`.`service_item_type`), CONCAT_WS(\'\',   `service_item_type1`.`service_item_type`), \'\') as \'service_item_type\', IF(    CHAR_LENGTH(`service_categories1`.`service_category`), CONCAT_WS(\'\',   `service_categories1`.`service_category`), \'\') as \'service_category\', IF(    CHAR_LENGTH(`merchant1`.`merchant_name`) || CHAR_LENGTH(`merchant_type1`.`merchant_type`), CONCAT_WS(\'\',   `merchant1`.`merchant_name`, \'    |   and   |    \', `merchant_type1`.`merchant_type`), \'\') as \'merchant_name\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`vehicle_registration_number`), \'\') as \'vehicle_registration_number\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`engine_number`), \'\') as \'engine_number\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`chassis_number`) || CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`chassis_number`, \' |  and  |     \', `gmt_fleet_register1`.`vehicle_registration_number`), \'\') as \'chassis_number\', IF(    CHAR_LENGTH(`dealer1`.`dealer_name`), CONCAT_WS(\'\',   `dealer1`.`dealer_name`), \'\') as \'dealer_name\', IF(    CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS(\'\',   `dealer1`.`make_of_vehicle`, \'   \'), \'\') as \'make_of_vehicle\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`model_of_vehicle`), \'\') as \'model_of_vehicle\', IF(    CHAR_LENGTH(`year_model1`.`year_model_specification`), CONCAT_WS(\'\',   `year_model1`.`year_model_specification`), \'\') as \'year_model_of_vehicle\', IF(    CHAR_LENGTH(`body_type1`.`type_of_vehicle`), CONCAT_WS(\'\',   `body_type1`.`type_of_vehicle`), \'\') as \'type_of_vehicle\', IF(    CHAR_LENGTH(`log_sheet1`.`closing_km`), CONCAT_WS(\'\',   `log_sheet1`.`closing_km`, \' \'), \'\') as \'closing_km\', IF(    CHAR_LENGTH(`application_status1`.`application_status`), CONCAT_WS(\'\',   `application_status1`.`application_status`), \'\') as \'application_status\', IF(    CHAR_LENGTH(`work_allocation1`.`work_allocation_reference_number`), CONCAT_WS(\'\',   `work_allocation1`.`work_allocation_reference_number`), \'\') as \'work_allocation_reference_number\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`barcode_number`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`barcode_number`), \'\') as \'barcode_number\', IF(    CHAR_LENGTH(`departments1`.`department_name`), CONCAT_WS(\'\',   `departments1`.`department_name`), \'\') as \'department\', `service`.`service_item` as \'service_item\', IF(    CHAR_LENGTH(if(`schedule1`.`date`,date_format(`schedule1`.`date`,\'%d/%m/%Y\'),\'\')), CONCAT_WS(\'\',   if(`schedule1`.`date`,date_format(`schedule1`.`date`,\'%d/%m/%Y\'),\'\')), \'\') as \'date_of_service\', IF(    CHAR_LENGTH(`schedule1`.`time`), CONCAT_WS(\'\',   `schedule1`.`time`), \'\') as \'time\', `service`.`upload_quotation` as \'upload_quotation\', DATE_FORMAT(`service`.`date_of_next_service`, \'%D %b %Y %l:%i%p\') as \'date_of_next_service\', `service`.`repeat_service_schedule_every_km` as \'repeat_service_schedule_every_km\', `service`.`comments` as \'comments\', `service`.`upload_invoice` as \'upload_invoice\', IF(    CHAR_LENGTH(`reception1`.`reception_name_and_surname`) || CHAR_LENGTH(`reception1`.`reception_persal_number`), CONCAT_WS(\'\',   `reception1`.`reception_name_and_surname`, \'     |    and     |     \', `reception1`.`reception_persal_number`), \'\') as \'receptionist\', IF(    CHAR_LENGTH(`reception1`.`reception_email_address`) || CHAR_LENGTH(`reception1`.`reception_contact_details`), CONCAT_WS(\'\',   `reception1`.`reception_email_address`, \'     |     and      |    \', `reception1`.`reception_contact_details`), \'\') as \'receptionist_contact_email\', IF(    CHAR_LENGTH(`districts1`.`district`) || CHAR_LENGTH(`districts1`.`station`), CONCAT_WS(\'\',   `districts1`.`district`, \'     |    and     |     \', `districts1`.`station`), \'\') as \'workshop_name\', `service`.`workshop_address` as \'workshop_address\', `service`.`technician` as \'technician\', `service`.`work_order_status` as \'work_order_status\', IF(    CHAR_LENGTH(`reception1`.`job_card_number`), CONCAT_WS(\'\',   `reception1`.`job_card_number`), \'\') as \'job_card_number\', if(`service`.`completion_date`,date_format(`service`.`completion_date`,\'%d/%m/%Y\'),\'\') as \'completion_date\', if(`service`.`due_date`,date_format(`service`.`due_date`,\'%d/%m/%Y\'),\'\') as \'due_date\', if(`service`.`birth_date`,date_format(`service`.`birth_date`,\'%d/%m/%Y\'),\'\') as \'birth_date\', `service`.`age` as \'age\', DATE_FORMAT(`service`.`filed`, \'%c/%e/%Y %l:%i%p\') as \'filed\', DATE_FORMAT(`service`.`last_modified`, \'%c/%e/%Y %l:%i%p\') as \'last_modified\' FROM `service` LEFT JOIN `service_item_type` as service_item_type1 ON `service_item_type1`.`service_item_type_id`=`service`.`service_item_type` LEFT JOIN `service_categories` as service_categories1 ON `service_categories1`.`service_categories_id`=`service`.`service_category` LEFT JOIN `merchant` as merchant1 ON `merchant1`.`merchant_id`=`service`.`merchant_name` LEFT JOIN `merchant_type` as merchant_type1 ON `merchant_type1`.`merchant_type_id`=`merchant1`.`merchant_type` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`service`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`service`.`dealer_name` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`service`.`closing_km` LEFT JOIN `work_allocation` as work_allocation1 ON `work_allocation1`.`work_allocation_id`=`service`.`work_allocation_reference_number` LEFT JOIN `schedule` as schedule1 ON `schedule1`.`schedule_id`=`service`.`date_of_service` LEFT JOIN `reception` as reception1 ON `reception1`.`reception_user_id`=`service`.`receptionist` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`service`.`workshop_name` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register1`.`year_model_specification` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register1`.`type_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register1`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register1`.`department_name`  WHERE 1=1 AND `service`.`service_id`=\'1\'', '0.00', 'Unknown column \'service.birth_date\' in \'field list\'', 'whoami', '/ldtcsgmtfleet2022new/service_view.php'),
('2022-03-31 10:18:51', 'SELECT `service`.`service_id` as \'service_id\', `service`.`breakdown_of_vehicle` as \'breakdown_of_vehicle\', `service`.`service_title` as \'service_title\', IF(    CHAR_LENGTH(`service_item_type1`.`service_item_type`), CONCAT_WS(\'\',   `service_item_type1`.`service_item_type`), \'\') as \'service_item_type\', IF(    CHAR_LENGTH(`service_categories1`.`service_category`), CONCAT_WS(\'\',   `service_categories1`.`service_category`), \'\') as \'service_category\', IF(    CHAR_LENGTH(`merchant1`.`merchant_name`) || CHAR_LENGTH(`merchant_type1`.`merchant_type`), CONCAT_WS(\'\',   `merchant1`.`merchant_name`, \'    |   and   |    \', `merchant_type1`.`merchant_type`), \'\') as \'merchant_name\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`vehicle_registration_number`), \'\') as \'vehicle_registration_number\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`engine_number`), \'\') as \'engine_number\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`chassis_number`) || CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`chassis_number`, \' |  and  |     \', `gmt_fleet_register1`.`vehicle_registration_number`), \'\') as \'chassis_number\', IF(    CHAR_LENGTH(`dealer1`.`dealer_name`), CONCAT_WS(\'\',   `dealer1`.`dealer_name`), \'\') as \'dealer_name\', IF(    CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS(\'\',   `dealer1`.`make_of_vehicle`, \'   \'), \'\') as \'make_of_vehicle\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`model_of_vehicle`), \'\') as \'model_of_vehicle\', IF(    CHAR_LENGTH(`year_model1`.`year_model_specification`), CONCAT_WS(\'\',   `year_model1`.`year_model_specification`), \'\') as \'year_model_of_vehicle\', IF(    CHAR_LENGTH(`body_type1`.`type_of_vehicle`), CONCAT_WS(\'\',   `body_type1`.`type_of_vehicle`), \'\') as \'type_of_vehicle\', IF(    CHAR_LENGTH(`log_sheet1`.`closing_km`), CONCAT_WS(\'\',   `log_sheet1`.`closing_km`, \' \'), \'\') as \'closing_km\', IF(    CHAR_LENGTH(`application_status1`.`application_status`), CONCAT_WS(\'\',   `application_status1`.`application_status`), \'\') as \'application_status\', IF(    CHAR_LENGTH(`work_allocation1`.`work_allocation_reference_number`), CONCAT_WS(\'\',   `work_allocation1`.`work_allocation_reference_number`), \'\') as \'work_allocation_reference_number\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`barcode_number`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`barcode_number`), \'\') as \'barcode_number\', IF(    CHAR_LENGTH(`departments1`.`department_name`), CONCAT_WS(\'\',   `departments1`.`department_name`), \'\') as \'department\', `service`.`service_item` as \'service_item\', IF(    CHAR_LENGTH(if(`schedule1`.`date`,date_format(`schedule1`.`date`,\'%d/%m/%Y\'),\'\')), CONCAT_WS(\'\',   if(`schedule1`.`date`,date_format(`schedule1`.`date`,\'%d/%m/%Y\'),\'\')), \'\') as \'date_of_service\', IF(    CHAR_LENGTH(`schedule1`.`time`), CONCAT_WS(\'\',   `schedule1`.`time`), \'\') as \'time\', `service`.`upload_quotation` as \'upload_quotation\', DATE_FORMAT(`service`.`date_of_next_service`, \'%D %b %Y %l:%i%p\') as \'date_of_next_service\', `service`.`repeat_service_schedule_every_km` as \'repeat_service_schedule_every_km\', `service`.`comments` as \'comments\', `service`.`upload_invoice` as \'upload_invoice\', IF(    CHAR_LENGTH(`reception1`.`reception_name_and_surname`) || CHAR_LENGTH(`reception1`.`reception_persal_number`), CONCAT_WS(\'\',   `reception1`.`reception_name_and_surname`, \'     |    and     |     \', `reception1`.`reception_persal_number`), \'\') as \'receptionist\', IF(    CHAR_LENGTH(`reception1`.`reception_email_address`) || CHAR_LENGTH(`reception1`.`reception_contact_details`), CONCAT_WS(\'\',   `reception1`.`reception_email_address`, \'     |     and      |    \', `reception1`.`reception_contact_details`), \'\') as \'receptionist_contact_email\', IF(    CHAR_LENGTH(`districts1`.`district`) || CHAR_LENGTH(`districts1`.`station`), CONCAT_WS(\'\',   `districts1`.`district`, \'     |    and     |     \', `districts1`.`station`), \'\') as \'workshop_name\', `service`.`workshop_address` as \'workshop_address\', `service`.`technician` as \'technician\', `service`.`work_order_status` as \'work_order_status\', IF(    CHAR_LENGTH(`reception1`.`job_card_number`), CONCAT_WS(\'\',   `reception1`.`job_card_number`), \'\') as \'job_card_number\', if(`service`.`completion_date`,date_format(`service`.`completion_date`,\'%d/%m/%Y\'),\'\') as \'completion_date\', if(`service`.`due_date`,date_format(`service`.`due_date`,\'%d/%m/%Y\'),\'\') as \'due_date\', if(`service`.`birth_date`,date_format(`service`.`birth_date`,\'%d/%m/%Y\'),\'\') as \'birth_date\', `service`.`age` as \'age\', DATE_FORMAT(`service`.`filed`, \'%c/%e/%Y %l:%i%p\') as \'filed\', DATE_FORMAT(`service`.`last_modified`, \'%c/%e/%Y %l:%i%p\') as \'last_modified\' FROM `service` LEFT JOIN `service_item_type` as service_item_type1 ON `service_item_type1`.`service_item_type_id`=`service`.`service_item_type` LEFT JOIN `service_categories` as service_categories1 ON `service_categories1`.`service_categories_id`=`service`.`service_category` LEFT JOIN `merchant` as merchant1 ON `merchant1`.`merchant_id`=`service`.`merchant_name` LEFT JOIN `merchant_type` as merchant_type1 ON `merchant_type1`.`merchant_type_id`=`merchant1`.`merchant_type` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`service`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`service`.`dealer_name` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`service`.`closing_km` LEFT JOIN `work_allocation` as work_allocation1 ON `work_allocation1`.`work_allocation_id`=`service`.`work_allocation_reference_number` LEFT JOIN `schedule` as schedule1 ON `schedule1`.`schedule_id`=`service`.`date_of_service` LEFT JOIN `reception` as reception1 ON `reception1`.`reception_user_id`=`service`.`receptionist` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`service`.`workshop_name` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register1`.`year_model_specification` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register1`.`type_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register1`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register1`.`department_name`  WHERE 1=1 AND `service`.`service_id`=\'1\'', '0.00', 'Unknown column \'service.birth_date\' in \'field list\'', 'whoami', '/ldtcsgmtfleet2022new/service_view.php'),
('2022-03-31 12:17:09', 'show tables like \'membership_%\'', '2.80', NULL, 'whoami', '/ldtcsgmtfleet2022new/ajax_check_login.php'),
('2022-03-31 12:20:56', 'show tables like \'membership_%\'', '1.78', NULL, 'whoami', '/ldtcsgmtfleet2022new/ajax_check_login.php'),
('2022-03-31 12:21:02', 'show tables like \'membership_%\'', '1.29', NULL, 'whoami', '/ldtcsgmtfleet2022new/ajax_check_login.php'),
('2022-04-26 11:05:53', 'SELECT `log_sheet`.`fuel_log_sheet_id` as \'fuel_log_sheet_id\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`vehicle_registration_number`), \'\') as \'vehicle_registration_number\', IF(    CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS(\'\',   `dealer1`.`make_of_vehicle`, \'   \'), \'\') as \'make_of_vehicle\', IF(    CHAR_LENGTH(`gmt_fleet_register2`.`model_of_vehicle`), CONCAT_WS(\'\',   `gmt_fleet_register2`.`model_of_vehicle`), \'\') as \'model_of_vehicle\', IF(    CHAR_LENGTH(`districts1`.`district`) || CHAR_LENGTH(`districts1`.`station`) || CHAR_LENGTH(`province1`.`province`), CONCAT_WS(\'\',   `districts1`.`district`, \'     |     and     |     \', `districts1`.`station`, `province1`.`province`), \'\') as \'district\', DATE_FORMAT(`log_sheet`.`month`, \'%D %b %Y %l:%i%p\') as \'month\', IF(    CHAR_LENGTH(`year_model1`.`year_model_specification`), CONCAT_WS(\'\',   `year_model1`.`year_model_specification`), \'\') as \'year_model_specification\', IF(    CHAR_LENGTH(`driver1`.`drivers_name_and_surname`), CONCAT_WS(\'\',   `driver1`.`drivers_name_and_surname`), \'\') as \'drivers_name_and_surname\', IF(    CHAR_LENGTH(`driver1`.`drivers_persal_number`), CONCAT_WS(\'\',   `driver1`.`drivers_persal_number`), \'\') as \'drivers_persal_number\', `log_sheet`.`opening_km` as \'opening_km\', `log_sheet`.`total_trip_distance` as \'total_trip_distance\', `log_sheet`.`closing_km` as \'closing_km\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_capacity`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`engine_capacity`), \'\') as \'engine_capacity\', IF(    CHAR_LENGTH(`fuel_type1`.`fuel_type`), CONCAT_WS(\'\',   `fuel_type1`.`fuel_type`), \'\') as \'fuel_type\', `log_sheet`.`fuel_tank_capacity` as \'fuel_tank_capacity\', `log_sheet`.`vendor` as \'vendor\', `log_sheet`.`fuel_cost_litre` as \'fuel_cost_litre\', `log_sheet`.`refuel_quantity_1` as \'refuel_quantity_1\', if(`log_sheet`.`refuel_first_time_date`,date_format(`log_sheet`.`refuel_first_time_date`,\'%d/%m/%Y\'),\'\') as \'refuel_first_time_date\', `log_sheet`.`trip_distance_refuel_1` as \'trip_distance_refuel_1\', `log_sheet`.`refuel_quantity_2` as \'refuel_quantity_2\', if(`log_sheet`.`refuel_second_time_date`,date_format(`log_sheet`.`refuel_second_time_date`,\'%d/%m/%Y\'),\'\') as \'refuel_second_time_date\', `log_sheet`.`trip_distance_refuel_2` as \'trip_distance_refuel_2\', `log_sheet`.`refuel_quantity_3` as \'refuel_quantity_3\', if(`log_sheet`.`refuel_third_time_date`,date_format(`log_sheet`.`refuel_third_time_date`,\'%d/%m/%Y\'),\'\') as \'refuel_third_time_date\', `log_sheet`.`trip_distance_refuel_3` as \'trip_distance_refuel_3\', `log_sheet`.`refuel_quantity_4` as \'refuel_quantity_4\', if(`log_sheet`.`refuel_fourth_time_date`,date_format(`log_sheet`.`refuel_fourth_time_date`,\'%d/%m/%Y\'),\'\') as \'refuel_fourth_time_date\', `log_sheet`.`trip_distance_refuel_4` as \'trip_distance_refuel_4\', `log_sheet`.`refuel_quantity_5` as \'refuel_quantity_5\', if(`log_sheet`.`refuel_fifth_time_date`,date_format(`log_sheet`.`refuel_fifth_time_date`,\'%d/%m/%Y\'),\'\') as \'refuel_fifth_time_date\', `log_sheet`.`trip_distance_refuel_5` as \'trip_distance_refuel_5\', `log_sheet`.`refuel_quantity_6` as \'refuel_quantity_6\', `log_sheet`.`trip_distance_refuel_6` as \'trip_distance_refuel_6\', if(`log_sheet`.`refuel_sixth_time_date`,date_format(`log_sheet`.`refuel_sixth_time_date`,\'%d/%m/%Y\'),\'\') as \'refuel_sixth_time_date\', `log_sheet`.`times_refuel_current_month` as \'times_refuel_current_month\', `log_sheet`.`total_fuel_quantity` as \'total_fuel_quantity\', `log_sheet`.`fuel_consumption` as \'fuel_consumption\', `log_sheet`.`fuel_total_cost` as \'fuel_total_cost\', `log_sheet`.`payment_e_fuel_card` as \'payment_e_fuel_card\', `log_sheet`.`captured_by` as \'captured_by\', `log_sheet`.`comments` as \'comments\', DATE_FORMAT(`log_sheet`.`date_captured`, \'%e/%c/%Y %l:%i%p\') as \'date_captured\', `log_sheet`.`complete_fill_up` as \'complete_fill_up\' FROM `log_sheet` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`log_sheet`.`vehicle_registration_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register2 ON `gmt_fleet_register2`.`fleet_asset_id`=`log_sheet`.`model_of_vehicle` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`log_sheet`.`drivers_name_and_surname` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`log_sheet`.`fuel_type` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register1`.`district` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register1`.`province` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register1`.`year_model_specification`  WHERE ( 1=1 ) AND ( 2=2 ) AND `log_sheet`.`vehicle_registration_number`=\'1\' LIMIT 0, 10', '0.00', 'Unknown column \'log_sheet.total_trip_distance\' in \'field list\'', 'whoami', '/ldtcsgmtfleet2022new/parent-children.php'),
('2022-04-26 11:05:53', 'SELECT `log_sheet`.`fuel_log_sheet_id` as \'fuel_log_sheet_id\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`vehicle_registration_number`), \'\') as \'vehicle_registration_number\', IF(    CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS(\'\',   `dealer1`.`make_of_vehicle`, \'   \'), \'\') as \'make_of_vehicle\', IF(    CHAR_LENGTH(`gmt_fleet_register2`.`model_of_vehicle`), CONCAT_WS(\'\',   `gmt_fleet_register2`.`model_of_vehicle`), \'\') as \'model_of_vehicle\', IF(    CHAR_LENGTH(`districts1`.`district`) || CHAR_LENGTH(`districts1`.`station`) || CHAR_LENGTH(`province1`.`province`), CONCAT_WS(\'\',   `districts1`.`district`, \'     |     and     |     \', `districts1`.`station`, `province1`.`province`), \'\') as \'district\', DATE_FORMAT(`log_sheet`.`month`, \'%D %b %Y %l:%i%p\') as \'month\', IF(    CHAR_LENGTH(`year_model1`.`year_model_specification`), CONCAT_WS(\'\',   `year_model1`.`year_model_specification`), \'\') as \'year_model_specification\', IF(    CHAR_LENGTH(`driver1`.`drivers_name_and_surname`), CONCAT_WS(\'\',   `driver1`.`drivers_name_and_surname`), \'\') as \'drivers_name_and_surname\', IF(    CHAR_LENGTH(`driver1`.`drivers_persal_number`), CONCAT_WS(\'\',   `driver1`.`drivers_persal_number`), \'\') as \'drivers_persal_number\', `log_sheet`.`opening_km` as \'opening_km\', `log_sheet`.`total_trip_distance` as \'total_trip_distance\', `log_sheet`.`closing_km` as \'closing_km\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_capacity`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`engine_capacity`), \'\') as \'engine_capacity\', IF(    CHAR_LENGTH(`fuel_type1`.`fuel_type`), CONCAT_WS(\'\',   `fuel_type1`.`fuel_type`), \'\') as \'fuel_type\', `log_sheet`.`fuel_tank_capacity` as \'fuel_tank_capacity\', `log_sheet`.`vendor` as \'vendor\', `log_sheet`.`fuel_cost_litre` as \'fuel_cost_litre\', `log_sheet`.`refuel_quantity_1` as \'refuel_quantity_1\', if(`log_sheet`.`refuel_first_time_date`,date_format(`log_sheet`.`refuel_first_time_date`,\'%d/%m/%Y\'),\'\') as \'refuel_first_time_date\', `log_sheet`.`trip_distance_refuel_1` as \'trip_distance_refuel_1\', `log_sheet`.`refuel_quantity_2` as \'refuel_quantity_2\', if(`log_sheet`.`refuel_second_time_date`,date_format(`log_sheet`.`refuel_second_time_date`,\'%d/%m/%Y\'),\'\') as \'refuel_second_time_date\', `log_sheet`.`trip_distance_refuel_2` as \'trip_distance_refuel_2\', `log_sheet`.`refuel_quantity_3` as \'refuel_quantity_3\', if(`log_sheet`.`refuel_third_time_date`,date_format(`log_sheet`.`refuel_third_time_date`,\'%d/%m/%Y\'),\'\') as \'refuel_third_time_date\', `log_sheet`.`trip_distance_refuel_3` as \'trip_distance_refuel_3\', `log_sheet`.`refuel_quantity_4` as \'refuel_quantity_4\', if(`log_sheet`.`refuel_fourth_time_date`,date_format(`log_sheet`.`refuel_fourth_time_date`,\'%d/%m/%Y\'),\'\') as \'refuel_fourth_time_date\', `log_sheet`.`trip_distance_refuel_4` as \'trip_distance_refuel_4\', `log_sheet`.`refuel_quantity_5` as \'refuel_quantity_5\', if(`log_sheet`.`refuel_fifth_time_date`,date_format(`log_sheet`.`refuel_fifth_time_date`,\'%d/%m/%Y\'),\'\') as \'refuel_fifth_time_date\', `log_sheet`.`trip_distance_refuel_5` as \'trip_distance_refuel_5\', `log_sheet`.`refuel_quantity_6` as \'refuel_quantity_6\', `log_sheet`.`trip_distance_refuel_6` as \'trip_distance_refuel_6\', if(`log_sheet`.`refuel_sixth_time_date`,date_format(`log_sheet`.`refuel_sixth_time_date`,\'%d/%m/%Y\'),\'\') as \'refuel_sixth_time_date\', `log_sheet`.`times_refuel_current_month` as \'times_refuel_current_month\', `log_sheet`.`total_fuel_quantity` as \'total_fuel_quantity\', `log_sheet`.`fuel_consumption` as \'fuel_consumption\', `log_sheet`.`fuel_total_cost` as \'fuel_total_cost\', `log_sheet`.`payment_e_fuel_card` as \'payment_e_fuel_card\', `log_sheet`.`captured_by` as \'captured_by\', `log_sheet`.`comments` as \'comments\', DATE_FORMAT(`log_sheet`.`date_captured`, \'%e/%c/%Y %l:%i%p\') as \'date_captured\', `log_sheet`.`complete_fill_up` as \'complete_fill_up\' FROM `log_sheet` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`log_sheet`.`vehicle_registration_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register2 ON `gmt_fleet_register2`.`fleet_asset_id`=`log_sheet`.`model_of_vehicle` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`log_sheet`.`drivers_name_and_surname` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`log_sheet`.`fuel_type` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register1`.`district` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register1`.`province` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register1`.`year_model_specification`  WHERE ( 1=1 ) AND ( 2=2 ) AND `log_sheet`.`model_of_vehicle`=\'1\' LIMIT 0, 10', '0.00', 'Unknown column \'log_sheet.total_trip_distance\' in \'field list\'', 'whoami', '/ldtcsgmtfleet2022new/parent-children.php'),
('2022-04-26 11:06:06', 'SELECT `log_sheet`.`fuel_log_sheet_id` as \'fuel_log_sheet_id\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`vehicle_registration_number`), \'\') as \'vehicle_registration_number\', IF(    CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS(\'\',   `dealer1`.`make_of_vehicle`, \'   \'), \'\') as \'make_of_vehicle\', IF(    CHAR_LENGTH(`gmt_fleet_register2`.`model_of_vehicle`), CONCAT_WS(\'\',   `gmt_fleet_register2`.`model_of_vehicle`), \'\') as \'model_of_vehicle\', IF(    CHAR_LENGTH(`districts1`.`district`) || CHAR_LENGTH(`districts1`.`station`) || CHAR_LENGTH(`province1`.`province`), CONCAT_WS(\'\',   `districts1`.`district`, \'     |     and     |     \', `districts1`.`station`, `province1`.`province`), \'\') as \'district\', DATE_FORMAT(`log_sheet`.`month`, \'%D %b %Y %l:%i%p\') as \'month\', IF(    CHAR_LENGTH(`year_model1`.`year_model_specification`), CONCAT_WS(\'\',   `year_model1`.`year_model_specification`), \'\') as \'year_model_specification\', IF(    CHAR_LENGTH(`driver1`.`drivers_name_and_surname`), CONCAT_WS(\'\',   `driver1`.`drivers_name_and_surname`), \'\') as \'drivers_name_and_surname\', IF(    CHAR_LENGTH(`driver1`.`drivers_persal_number`), CONCAT_WS(\'\',   `driver1`.`drivers_persal_number`), \'\') as \'drivers_persal_number\', `log_sheet`.`opening_km` as \'opening_km\', `log_sheet`.`total_trip_distance` as \'total_trip_distance\', `log_sheet`.`closing_km` as \'closing_km\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_capacity`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`engine_capacity`), \'\') as \'engine_capacity\', IF(    CHAR_LENGTH(`fuel_type1`.`fuel_type`), CONCAT_WS(\'\',   `fuel_type1`.`fuel_type`), \'\') as \'fuel_type\', `log_sheet`.`fuel_tank_capacity` as \'fuel_tank_capacity\', `log_sheet`.`vendor` as \'vendor\', `log_sheet`.`fuel_cost_litre` as \'fuel_cost_litre\', `log_sheet`.`refuel_quantity_1` as \'refuel_quantity_1\', if(`log_sheet`.`refuel_first_time_date`,date_format(`log_sheet`.`refuel_first_time_date`,\'%d/%m/%Y\'),\'\') as \'refuel_first_time_date\', `log_sheet`.`trip_distance_refuel_1` as \'trip_distance_refuel_1\', `log_sheet`.`refuel_quantity_2` as \'refuel_quantity_2\', if(`log_sheet`.`refuel_second_time_date`,date_format(`log_sheet`.`refuel_second_time_date`,\'%d/%m/%Y\'),\'\') as \'refuel_second_time_date\', `log_sheet`.`trip_distance_refuel_2` as \'trip_distance_refuel_2\', `log_sheet`.`refuel_quantity_3` as \'refuel_quantity_3\', if(`log_sheet`.`refuel_third_time_date`,date_format(`log_sheet`.`refuel_third_time_date`,\'%d/%m/%Y\'),\'\') as \'refuel_third_time_date\', `log_sheet`.`trip_distance_refuel_3` as \'trip_distance_refuel_3\', `log_sheet`.`refuel_quantity_4` as \'refuel_quantity_4\', if(`log_sheet`.`refuel_fourth_time_date`,date_format(`log_sheet`.`refuel_fourth_time_date`,\'%d/%m/%Y\'),\'\') as \'refuel_fourth_time_date\', `log_sheet`.`trip_distance_refuel_4` as \'trip_distance_refuel_4\', `log_sheet`.`refuel_quantity_5` as \'refuel_quantity_5\', if(`log_sheet`.`refuel_fifth_time_date`,date_format(`log_sheet`.`refuel_fifth_time_date`,\'%d/%m/%Y\'),\'\') as \'refuel_fifth_time_date\', `log_sheet`.`trip_distance_refuel_5` as \'trip_distance_refuel_5\', `log_sheet`.`refuel_quantity_6` as \'refuel_quantity_6\', `log_sheet`.`trip_distance_refuel_6` as \'trip_distance_refuel_6\', if(`log_sheet`.`refuel_sixth_time_date`,date_format(`log_sheet`.`refuel_sixth_time_date`,\'%d/%m/%Y\'),\'\') as \'refuel_sixth_time_date\', `log_sheet`.`times_refuel_current_month` as \'times_refuel_current_month\', `log_sheet`.`total_fuel_quantity` as \'total_fuel_quantity\', `log_sheet`.`fuel_consumption` as \'fuel_consumption\', `log_sheet`.`fuel_total_cost` as \'fuel_total_cost\', `log_sheet`.`payment_e_fuel_card` as \'payment_e_fuel_card\', `log_sheet`.`captured_by` as \'captured_by\', `log_sheet`.`comments` as \'comments\', DATE_FORMAT(`log_sheet`.`date_captured`, \'%e/%c/%Y %l:%i%p\') as \'date_captured\', `log_sheet`.`complete_fill_up` as \'complete_fill_up\' FROM `log_sheet` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`log_sheet`.`vehicle_registration_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register2 ON `gmt_fleet_register2`.`fleet_asset_id`=`log_sheet`.`model_of_vehicle` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`log_sheet`.`drivers_name_and_surname` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`log_sheet`.`fuel_type` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register1`.`district` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register1`.`province` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register1`.`year_model_specification`  WHERE ( 1=1 ) AND ( 2=2 ) AND `log_sheet`.`vehicle_registration_number`=\'1\' LIMIT 0, 10', '0.00', 'Unknown column \'log_sheet.total_trip_distance\' in \'field list\'', 'whoami', '/ldtcsgmtfleet2022new/parent-children.php'),
('2022-04-26 11:06:06', 'SELECT `log_sheet`.`fuel_log_sheet_id` as \'fuel_log_sheet_id\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`vehicle_registration_number`), \'\') as \'vehicle_registration_number\', IF(    CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS(\'\',   `dealer1`.`make_of_vehicle`, \'   \'), \'\') as \'make_of_vehicle\', IF(    CHAR_LENGTH(`gmt_fleet_register2`.`model_of_vehicle`), CONCAT_WS(\'\',   `gmt_fleet_register2`.`model_of_vehicle`), \'\') as \'model_of_vehicle\', IF(    CHAR_LENGTH(`districts1`.`district`) || CHAR_LENGTH(`districts1`.`station`) || CHAR_LENGTH(`province1`.`province`), CONCAT_WS(\'\',   `districts1`.`district`, \'     |     and     |     \', `districts1`.`station`, `province1`.`province`), \'\') as \'district\', DATE_FORMAT(`log_sheet`.`month`, \'%D %b %Y %l:%i%p\') as \'month\', IF(    CHAR_LENGTH(`year_model1`.`year_model_specification`), CONCAT_WS(\'\',   `year_model1`.`year_model_specification`), \'\') as \'year_model_specification\', IF(    CHAR_LENGTH(`driver1`.`drivers_name_and_surname`), CONCAT_WS(\'\',   `driver1`.`drivers_name_and_surname`), \'\') as \'drivers_name_and_surname\', IF(    CHAR_LENGTH(`driver1`.`drivers_persal_number`), CONCAT_WS(\'\',   `driver1`.`drivers_persal_number`), \'\') as \'drivers_persal_number\', `log_sheet`.`opening_km` as \'opening_km\', `log_sheet`.`total_trip_distance` as \'total_trip_distance\', `log_sheet`.`closing_km` as \'closing_km\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_capacity`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`engine_capacity`), \'\') as \'engine_capacity\', IF(    CHAR_LENGTH(`fuel_type1`.`fuel_type`), CONCAT_WS(\'\',   `fuel_type1`.`fuel_type`), \'\') as \'fuel_type\', `log_sheet`.`fuel_tank_capacity` as \'fuel_tank_capacity\', `log_sheet`.`vendor` as \'vendor\', `log_sheet`.`fuel_cost_litre` as \'fuel_cost_litre\', `log_sheet`.`refuel_quantity_1` as \'refuel_quantity_1\', if(`log_sheet`.`refuel_first_time_date`,date_format(`log_sheet`.`refuel_first_time_date`,\'%d/%m/%Y\'),\'\') as \'refuel_first_time_date\', `log_sheet`.`trip_distance_refuel_1` as \'trip_distance_refuel_1\', `log_sheet`.`refuel_quantity_2` as \'refuel_quantity_2\', if(`log_sheet`.`refuel_second_time_date`,date_format(`log_sheet`.`refuel_second_time_date`,\'%d/%m/%Y\'),\'\') as \'refuel_second_time_date\', `log_sheet`.`trip_distance_refuel_2` as \'trip_distance_refuel_2\', `log_sheet`.`refuel_quantity_3` as \'refuel_quantity_3\', if(`log_sheet`.`refuel_third_time_date`,date_format(`log_sheet`.`refuel_third_time_date`,\'%d/%m/%Y\'),\'\') as \'refuel_third_time_date\', `log_sheet`.`trip_distance_refuel_3` as \'trip_distance_refuel_3\', `log_sheet`.`refuel_quantity_4` as \'refuel_quantity_4\', if(`log_sheet`.`refuel_fourth_time_date`,date_format(`log_sheet`.`refuel_fourth_time_date`,\'%d/%m/%Y\'),\'\') as \'refuel_fourth_time_date\', `log_sheet`.`trip_distance_refuel_4` as \'trip_distance_refuel_4\', `log_sheet`.`refuel_quantity_5` as \'refuel_quantity_5\', if(`log_sheet`.`refuel_fifth_time_date`,date_format(`log_sheet`.`refuel_fifth_time_date`,\'%d/%m/%Y\'),\'\') as \'refuel_fifth_time_date\', `log_sheet`.`trip_distance_refuel_5` as \'trip_distance_refuel_5\', `log_sheet`.`refuel_quantity_6` as \'refuel_quantity_6\', `log_sheet`.`trip_distance_refuel_6` as \'trip_distance_refuel_6\', if(`log_sheet`.`refuel_sixth_time_date`,date_format(`log_sheet`.`refuel_sixth_time_date`,\'%d/%m/%Y\'),\'\') as \'refuel_sixth_time_date\', `log_sheet`.`times_refuel_current_month` as \'times_refuel_current_month\', `log_sheet`.`total_fuel_quantity` as \'total_fuel_quantity\', `log_sheet`.`fuel_consumption` as \'fuel_consumption\', `log_sheet`.`fuel_total_cost` as \'fuel_total_cost\', `log_sheet`.`payment_e_fuel_card` as \'payment_e_fuel_card\', `log_sheet`.`captured_by` as \'captured_by\', `log_sheet`.`comments` as \'comments\', DATE_FORMAT(`log_sheet`.`date_captured`, \'%e/%c/%Y %l:%i%p\') as \'date_captured\', `log_sheet`.`complete_fill_up` as \'complete_fill_up\' FROM `log_sheet` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`log_sheet`.`vehicle_registration_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register2 ON `gmt_fleet_register2`.`fleet_asset_id`=`log_sheet`.`model_of_vehicle` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`log_sheet`.`drivers_name_and_surname` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`log_sheet`.`fuel_type` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register1`.`district` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register1`.`province` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register1`.`year_model_specification`  WHERE ( 1=1 ) AND ( 2=2 ) AND `log_sheet`.`model_of_vehicle`=\'1\' LIMIT 0, 10', '0.00', 'Unknown column \'log_sheet.total_trip_distance\' in \'field list\'', 'whoami', '/ldtcsgmtfleet2022new/parent-children.php');
INSERT INTO `appgini_query_log` (`datetime`, `statement`, `duration`, `error`, `memberID`, `uri`) VALUES
('2022-04-26 11:39:21', 'SELECT `log_sheet`.`fuel_log_sheet_id` as \'fuel_log_sheet_id\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`vehicle_registration_number`), \'\') as \'vehicle_registration_number\', IF(    CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS(\'\',   `dealer1`.`make_of_vehicle`, \'   \'), \'\') as \'make_of_vehicle\', IF(    CHAR_LENGTH(`gmt_fleet_register2`.`model_of_vehicle`), CONCAT_WS(\'\',   `gmt_fleet_register2`.`model_of_vehicle`), \'\') as \'model_of_vehicle\', IF(    CHAR_LENGTH(`districts1`.`district`) || CHAR_LENGTH(`districts1`.`station`) || CHAR_LENGTH(`province1`.`province`), CONCAT_WS(\'\',   `districts1`.`district`, \'     |     and     |     \', `districts1`.`station`, `province1`.`province`), \'\') as \'district\', DATE_FORMAT(`log_sheet`.`month`, \'%D %b %Y %l:%i%p\') as \'month\', IF(    CHAR_LENGTH(`year_model1`.`year_model_specification`), CONCAT_WS(\'\',   `year_model1`.`year_model_specification`), \'\') as \'year_model_specification\', IF(    CHAR_LENGTH(`driver1`.`drivers_name_and_surname`), CONCAT_WS(\'\',   `driver1`.`drivers_name_and_surname`), \'\') as \'drivers_name_and_surname\', IF(    CHAR_LENGTH(`driver1`.`drivers_persal_number`), CONCAT_WS(\'\',   `driver1`.`drivers_persal_number`), \'\') as \'drivers_persal_number\', `log_sheet`.`opening_km` as \'opening_km\', `log_sheet`.`total_trip_distance` as \'total_trip_distance\', `log_sheet`.`closing_km` as \'closing_km\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_capacity`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`engine_capacity`), \'\') as \'engine_capacity\', IF(    CHAR_LENGTH(`fuel_type1`.`fuel_type`), CONCAT_WS(\'\',   `fuel_type1`.`fuel_type`), \'\') as \'fuel_type\', `log_sheet`.`fuel_tank_capacity` as \'fuel_tank_capacity\', `log_sheet`.`vendor` as \'vendor\', `log_sheet`.`fuel_cost_litre` as \'fuel_cost_litre\', `log_sheet`.`refuel_quantity_1` as \'refuel_quantity_1\', if(`log_sheet`.`refuel_first_time_date`,date_format(`log_sheet`.`refuel_first_time_date`,\'%d/%m/%Y\'),\'\') as \'refuel_first_time_date\', `log_sheet`.`trip_distance_refuel_1` as \'trip_distance_refuel_1\', `log_sheet`.`refuel_quantity_2` as \'refuel_quantity_2\', if(`log_sheet`.`refuel_second_time_date`,date_format(`log_sheet`.`refuel_second_time_date`,\'%d/%m/%Y\'),\'\') as \'refuel_second_time_date\', `log_sheet`.`trip_distance_refuel_2` as \'trip_distance_refuel_2\', `log_sheet`.`refuel_quantity_3` as \'refuel_quantity_3\', if(`log_sheet`.`refuel_third_time_date`,date_format(`log_sheet`.`refuel_third_time_date`,\'%d/%m/%Y\'),\'\') as \'refuel_third_time_date\', `log_sheet`.`trip_distance_refuel_3` as \'trip_distance_refuel_3\', `log_sheet`.`refuel_quantity_4` as \'refuel_quantity_4\', if(`log_sheet`.`refuel_fourth_time_date`,date_format(`log_sheet`.`refuel_fourth_time_date`,\'%d/%m/%Y\'),\'\') as \'refuel_fourth_time_date\', `log_sheet`.`trip_distance_refuel_4` as \'trip_distance_refuel_4\', `log_sheet`.`refuel_quantity_5` as \'refuel_quantity_5\', if(`log_sheet`.`refuel_fifth_time_date`,date_format(`log_sheet`.`refuel_fifth_time_date`,\'%d/%m/%Y\'),\'\') as \'refuel_fifth_time_date\', `log_sheet`.`trip_distance_refuel_5` as \'trip_distance_refuel_5\', `log_sheet`.`refuel_quantity_6` as \'refuel_quantity_6\', `log_sheet`.`trip_distance_refuel_6` as \'trip_distance_refuel_6\', if(`log_sheet`.`refuel_sixth_time_date`,date_format(`log_sheet`.`refuel_sixth_time_date`,\'%d/%m/%Y\'),\'\') as \'refuel_sixth_time_date\', `log_sheet`.`times_refuel_current_month` as \'times_refuel_current_month\', `log_sheet`.`total_fuel_quantity` as \'total_fuel_quantity\', `log_sheet`.`fuel_consumption` as \'fuel_consumption\', `log_sheet`.`fuel_total_cost` as \'fuel_total_cost\', `log_sheet`.`payment_e_fuel_card` as \'payment_e_fuel_card\', `log_sheet`.`captured_by` as \'captured_by\', `log_sheet`.`comments` as \'comments\', DATE_FORMAT(`log_sheet`.`date_captured`, \'%e/%c/%Y %l:%i%p\') as \'date_captured\', `log_sheet`.`complete_fill_up` as \'complete_fill_up\' FROM `log_sheet` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`log_sheet`.`vehicle_registration_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register2 ON `gmt_fleet_register2`.`fleet_asset_id`=`log_sheet`.`model_of_vehicle` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`log_sheet`.`drivers_name_and_surname` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`log_sheet`.`fuel_type` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register1`.`district` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register1`.`province` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register1`.`year_model_specification`  WHERE ( 1=1 ) AND ( 2=2 ) AND `log_sheet`.`model_of_vehicle`=\'1\' LIMIT 0, 10', '0.00', 'Unknown column \'log_sheet.total_trip_distance\' in \'field list\'', 'whoami', '/ldtcsgmtfleet/parent-children.php'),
('2022-04-26 11:39:21', 'SELECT `log_sheet`.`fuel_log_sheet_id` as \'fuel_log_sheet_id\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`vehicle_registration_number`), \'\') as \'vehicle_registration_number\', IF(    CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS(\'\',   `dealer1`.`make_of_vehicle`, \'   \'), \'\') as \'make_of_vehicle\', IF(    CHAR_LENGTH(`gmt_fleet_register2`.`model_of_vehicle`), CONCAT_WS(\'\',   `gmt_fleet_register2`.`model_of_vehicle`), \'\') as \'model_of_vehicle\', IF(    CHAR_LENGTH(`districts1`.`district`) || CHAR_LENGTH(`districts1`.`station`) || CHAR_LENGTH(`province1`.`province`), CONCAT_WS(\'\',   `districts1`.`district`, \'     |     and     |     \', `districts1`.`station`, `province1`.`province`), \'\') as \'district\', DATE_FORMAT(`log_sheet`.`month`, \'%D %b %Y %l:%i%p\') as \'month\', IF(    CHAR_LENGTH(`year_model1`.`year_model_specification`), CONCAT_WS(\'\',   `year_model1`.`year_model_specification`), \'\') as \'year_model_specification\', IF(    CHAR_LENGTH(`driver1`.`drivers_name_and_surname`), CONCAT_WS(\'\',   `driver1`.`drivers_name_and_surname`), \'\') as \'drivers_name_and_surname\', IF(    CHAR_LENGTH(`driver1`.`drivers_persal_number`), CONCAT_WS(\'\',   `driver1`.`drivers_persal_number`), \'\') as \'drivers_persal_number\', `log_sheet`.`opening_km` as \'opening_km\', `log_sheet`.`total_trip_distance` as \'total_trip_distance\', `log_sheet`.`closing_km` as \'closing_km\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_capacity`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`engine_capacity`), \'\') as \'engine_capacity\', IF(    CHAR_LENGTH(`fuel_type1`.`fuel_type`), CONCAT_WS(\'\',   `fuel_type1`.`fuel_type`), \'\') as \'fuel_type\', `log_sheet`.`fuel_tank_capacity` as \'fuel_tank_capacity\', `log_sheet`.`vendor` as \'vendor\', `log_sheet`.`fuel_cost_litre` as \'fuel_cost_litre\', `log_sheet`.`refuel_quantity_1` as \'refuel_quantity_1\', if(`log_sheet`.`refuel_first_time_date`,date_format(`log_sheet`.`refuel_first_time_date`,\'%d/%m/%Y\'),\'\') as \'refuel_first_time_date\', `log_sheet`.`trip_distance_refuel_1` as \'trip_distance_refuel_1\', `log_sheet`.`refuel_quantity_2` as \'refuel_quantity_2\', if(`log_sheet`.`refuel_second_time_date`,date_format(`log_sheet`.`refuel_second_time_date`,\'%d/%m/%Y\'),\'\') as \'refuel_second_time_date\', `log_sheet`.`trip_distance_refuel_2` as \'trip_distance_refuel_2\', `log_sheet`.`refuel_quantity_3` as \'refuel_quantity_3\', if(`log_sheet`.`refuel_third_time_date`,date_format(`log_sheet`.`refuel_third_time_date`,\'%d/%m/%Y\'),\'\') as \'refuel_third_time_date\', `log_sheet`.`trip_distance_refuel_3` as \'trip_distance_refuel_3\', `log_sheet`.`refuel_quantity_4` as \'refuel_quantity_4\', if(`log_sheet`.`refuel_fourth_time_date`,date_format(`log_sheet`.`refuel_fourth_time_date`,\'%d/%m/%Y\'),\'\') as \'refuel_fourth_time_date\', `log_sheet`.`trip_distance_refuel_4` as \'trip_distance_refuel_4\', `log_sheet`.`refuel_quantity_5` as \'refuel_quantity_5\', if(`log_sheet`.`refuel_fifth_time_date`,date_format(`log_sheet`.`refuel_fifth_time_date`,\'%d/%m/%Y\'),\'\') as \'refuel_fifth_time_date\', `log_sheet`.`trip_distance_refuel_5` as \'trip_distance_refuel_5\', `log_sheet`.`refuel_quantity_6` as \'refuel_quantity_6\', `log_sheet`.`trip_distance_refuel_6` as \'trip_distance_refuel_6\', if(`log_sheet`.`refuel_sixth_time_date`,date_format(`log_sheet`.`refuel_sixth_time_date`,\'%d/%m/%Y\'),\'\') as \'refuel_sixth_time_date\', `log_sheet`.`times_refuel_current_month` as \'times_refuel_current_month\', `log_sheet`.`total_fuel_quantity` as \'total_fuel_quantity\', `log_sheet`.`fuel_consumption` as \'fuel_consumption\', `log_sheet`.`fuel_total_cost` as \'fuel_total_cost\', `log_sheet`.`payment_e_fuel_card` as \'payment_e_fuel_card\', `log_sheet`.`captured_by` as \'captured_by\', `log_sheet`.`comments` as \'comments\', DATE_FORMAT(`log_sheet`.`date_captured`, \'%e/%c/%Y %l:%i%p\') as \'date_captured\', `log_sheet`.`complete_fill_up` as \'complete_fill_up\' FROM `log_sheet` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`log_sheet`.`vehicle_registration_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register2 ON `gmt_fleet_register2`.`fleet_asset_id`=`log_sheet`.`model_of_vehicle` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`log_sheet`.`drivers_name_and_surname` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`log_sheet`.`fuel_type` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register1`.`district` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register1`.`province` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register1`.`year_model_specification`  WHERE ( 1=1 ) AND ( 2=2 ) AND `log_sheet`.`vehicle_registration_number`=\'1\' LIMIT 0, 10', '0.00', 'Unknown column \'log_sheet.total_trip_distance\' in \'field list\'', 'whoami', '/ldtcsgmtfleet/parent-children.php'),
('2022-04-26 11:40:45', 'SELECT `log_sheet`.`fuel_log_sheet_id` AS \'fuel_log_sheet_id\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`vehicle_registration_number`), \'\') /* Registration Number: */ AS \'vehicle_registration_number\', IF(    CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS(\'\',   `dealer1`.`make_of_vehicle`, \'   \'), \'\') /* Make of Vehicle: */ AS \'make_of_vehicle\', IF(    CHAR_LENGTH(`gmt_fleet_register2`.`model_of_vehicle`), CONCAT_WS(\'\',   `gmt_fleet_register2`.`model_of_vehicle`), \'\') /* Model of Vehicle: */ AS \'model_of_vehicle\', IF(    CHAR_LENGTH(`districts1`.`district`) || CHAR_LENGTH(`districts1`.`station`) || CHAR_LENGTH(`province1`.`province`), CONCAT_WS(\'\',   `districts1`.`district`, \'     |     and     |     \', `districts1`.`station`, `province1`.`province`), \'\') /* District and Station: */ AS \'district\', DATE_FORMAT(`log_sheet`.`month`, \'%D %b %Y %l:%i%p\') AS \'month\', IF(    CHAR_LENGTH(`year_model1`.`year_model_specification`), CONCAT_WS(\'\',   `year_model1`.`year_model_specification`), \'\') /* Year Model Specification: */ AS \'year_model_specification\', IF(    CHAR_LENGTH(`driver1`.`drivers_name_and_surname`), CONCAT_WS(\'\',   `driver1`.`drivers_name_and_surname`), \'\') /* Driver\\\'s Surname: */ AS \'drivers_name_and_surname\', IF(    CHAR_LENGTH(`driver1`.`drivers_persal_number`), CONCAT_WS(\'\',   `driver1`.`drivers_persal_number`), \'\') /* Driver\\\'s Persal Number: */ AS \'drivers_persal_number\', `log_sheet`.`opening_km` AS \'opening_km\', `log_sheet`.`total_trip_distance` AS \'total_trip_distance\', `log_sheet`.`closing_km` AS \'closing_km\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_capacity`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`engine_capacity`), \'\') /* Engine Capacity (cc): */ AS \'engine_capacity\', IF(    CHAR_LENGTH(`fuel_type1`.`fuel_type`), CONCAT_WS(\'\',   `fuel_type1`.`fuel_type`), \'\') /* Fuel Type: */ AS \'fuel_type\', `log_sheet`.`fuel_tank_capacity` AS \'fuel_tank_capacity\', `log_sheet`.`vendor` AS \'vendor\', `log_sheet`.`fuel_cost_litre` AS \'fuel_cost_litre\', `log_sheet`.`refuel_quantity_1` AS \'refuel_quantity_1\', if(`log_sheet`.`refuel_first_time_date`,date_format(`log_sheet`.`refuel_first_time_date`,\'%d/%m/%Y\'),\'\') AS \'refuel_first_time_date\', `log_sheet`.`trip_distance_refuel_1` AS \'trip_distance_refuel_1\', `log_sheet`.`refuel_quantity_2` AS \'refuel_quantity_2\', if(`log_sheet`.`refuel_second_time_date`,date_format(`log_sheet`.`refuel_second_time_date`,\'%d/%m/%Y\'),\'\') AS \'refuel_second_time_date\', `log_sheet`.`trip_distance_refuel_2` AS \'trip_distance_refuel_2\', `log_sheet`.`refuel_quantity_3` AS \'refuel_quantity_3\', if(`log_sheet`.`refuel_third_time_date`,date_format(`log_sheet`.`refuel_third_time_date`,\'%d/%m/%Y\'),\'\') AS \'refuel_third_time_date\', `log_sheet`.`trip_distance_refuel_3` AS \'trip_distance_refuel_3\', `log_sheet`.`refuel_quantity_4` AS \'refuel_quantity_4\', if(`log_sheet`.`refuel_fourth_time_date`,date_format(`log_sheet`.`refuel_fourth_time_date`,\'%d/%m/%Y\'),\'\') AS \'refuel_fourth_time_date\', `log_sheet`.`trip_distance_refuel_4` AS \'trip_distance_refuel_4\', `log_sheet`.`refuel_quantity_5` AS \'refuel_quantity_5\', if(`log_sheet`.`refuel_fifth_time_date`,date_format(`log_sheet`.`refuel_fifth_time_date`,\'%d/%m/%Y\'),\'\') AS \'refuel_fifth_time_date\', `log_sheet`.`trip_distance_refuel_5` AS \'trip_distance_refuel_5\', `log_sheet`.`refuel_quantity_6` AS \'refuel_quantity_6\', `log_sheet`.`trip_distance_refuel_6` AS \'trip_distance_refuel_6\', if(`log_sheet`.`refuel_sixth_time_date`,date_format(`log_sheet`.`refuel_sixth_time_date`,\'%d/%m/%Y\'),\'\') AS \'refuel_sixth_time_date\', `log_sheet`.`times_refuel_current_month` AS \'times_refuel_current_month\', `log_sheet`.`total_fuel_quantity` AS \'total_fuel_quantity\', `log_sheet`.`fuel_consumption` AS \'fuel_consumption\', `log_sheet`.`fuel_total_cost` AS \'fuel_total_cost\', `log_sheet`.`payment_e_fuel_card` AS \'payment_e_fuel_card\', `log_sheet`.`captured_by` AS \'captured_by\', `log_sheet`.`comments` AS \'comments\', DATE_FORMAT(`log_sheet`.`date_captured`, \'%e/%c/%Y %l:%i%p\') AS \'date_captured\', `log_sheet`.`complete_fill_up` AS \'complete_fill_up\', COALESCE(`log_sheet`.`fuel_log_sheet_id`) AS \'log_sheet.fuel_log_sheet_id\' FROM `log_sheet` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`log_sheet`.`vehicle_registration_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register2 ON `gmt_fleet_register2`.`fleet_asset_id`=`log_sheet`.`model_of_vehicle` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`log_sheet`.`drivers_name_and_surname` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`log_sheet`.`fuel_type` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register1`.`district` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register1`.`province` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register1`.`year_model_specification`  WHERE 1=1  LIMIT 0, 2000', '0.00', 'Unknown column \'log_sheet.total_trip_distance\' in \'field list\'', 'whoami', '/ldtcsgmtfleet/log_sheet_view.php?t=1650973222'),
('2022-05-09 15:30:48', 'INSERT INTO `gmt_fleet_register` SET `vehicle_registration_number`=\'GTB761L\', `engine_number`=\'F16D4412158KA\', `chassis_number`=\'KL1JF69E9DK069074\', `dealer_name`=\'10\', `make_of_vehicle`=\'10\', `model_of_vehicle`=\'CRUZE 1.6LS\', `year_model_specification`=\'7\', `engine_capacity`=\'1.6\', `tyre_size`=\'15\', `transmission`=\'3\', `fuel_type`=\'2\', `type_of_vehicle`=\'3\', `colour_of_vehicle`=\'22\', `application_status`=\'1\', `barcode_number`=\'1930449\', `purchase_price`=\'R159 045 .31\', `depreciation_value`=\'R159 045.31\', `photo_of_vehicle`=NULL, `user_name_and_surname`=\'CHAUKE J\', `user_contact_email`=\'Chaukej@dtcs.limpopo.gov\', `contact_number`=\'+10158117000\', `department_name`=\'9\', `department_address`=\'Private bag x 9671<div>Giyani</div><div>0826</div>\', `province`=\'1\', `district`=\'70\', `drivers_name_and_surname`=\'2\', `drivers_persal_number`=\'2\', `department_name_of_driver`=\'9\', `drivers_contact_details`=\'2\', `documents`=NULL, `date_auctioned`=NULL, `comments`=\'<br>\', `renewal_of_license`=\'2022-3-31\', `mm_code`=NULL', '0.00', 'Duplicate entry \'GTB761L\' for key \'vehicle_registration_number_unique\'', '80207456', '/ldtcsgmtfleet/gmt_fleet_register_view.php'),
('2022-05-09 15:33:18', 'INSERT INTO `gmt_fleet_register` SET `vehicle_registration_number`=\'GTB761L\', `engine_number`=\'F16D4412158KA\', `chassis_number`=\'KL1JF69E9DK069074\', `dealer_name`=\'10\', `make_of_vehicle`=\'10\', `model_of_vehicle`=\'CRUZE 1.6LS\', `year_model_specification`=\'7\', `engine_capacity`=\'1.6\', `tyre_size`=\'15\', `transmission`=\'3\', `fuel_type`=\'2\', `type_of_vehicle`=\'3\', `colour_of_vehicle`=\'22\', `application_status`=\'1\', `barcode_number`=\'1930449\', `purchase_price`=\'R159 045 .31\', `depreciation_value`=\'R159 045.31\', `photo_of_vehicle`=NULL, `user_name_and_surname`=\'CHAUKE J\', `user_contact_email`=\'Chaukej@dtcs.limpopo.gov\', `contact_number`=\'+10158117000\', `department_name`=\'9\', `department_address`=\'Private bag x 9671<div>Giyani</div><div>0826</div>\', `province`=\'1\', `district`=\'70\', `drivers_name_and_surname`=\'2\', `drivers_persal_number`=\'2\', `department_name_of_driver`=\'9\', `drivers_contact_details`=\'2\', `documents`=NULL, `date_auctioned`=NULL, `comments`=\'<br>\', `renewal_of_license`=\'2022-3-31\', `mm_code`=NULL', '0.00', 'Duplicate entry \'GTB761L\' for key \'vehicle_registration_number_unique\'', '80207456', '/ldtcsgmtfleet/gmt_fleet_register_view.php'),
('2022-05-09 17:04:46', 'INSERT INTO `gmt_fleet_register` SET `vehicle_registration_number`=\'GTB869LL\', `engine_number`=\'HR15715B838\', `chassis_number`=\'MDHBBAN17Z0730066\', `dealer_name`=\'3\', `make_of_vehicle`=\'3\', `model_of_vehicle`=\'ALMERA 1.5 ACCENTA\', `year_model_specification`=\'14\', `engine_capacity`=\'1498CC\', `tyre_size`=\'16\', `transmission`=\'3\', `fuel_type`=\'1\', `type_of_vehicle`=\'3\', `colour_of_vehicle`=\'24\', `application_status`=\'1\', `barcode_number`=\'GTB869L\', `purchase_price`=\'R 175,834.13\', `depreciation_value`=NULL, `photo_of_vehicle`=NULL, `user_name_and_surname`=\'Lekgothoane L.T\', `user_contact_email`=\'lekgothoanel@dtcs.limpopo.gov.za\', `contact_number`=\'(015) 295 1000\', `department_name`=\'13\', `department_address`=\'Private bag x 9491<div>Polokwane</div><div>0700</div>\', `province`=\'1\', `district`=\'1\', `drivers_name_and_surname`=\'2\', `drivers_persal_number`=\'2\', `department_name_of_driver`=\'13\', `drivers_contact_details`=\'2\', `documents`=NULL, `date_auctioned`=\'2022-3-31\', `comments`=\'<br>\', `renewal_of_license`=NULL, `mm_code`=NULL', '0.00', 'Duplicate entry \'MDHBBAN17Z0730066\' for key \'chassis_number_unique\'', '80205411', '/ldtcsgmtfleet/gmt_fleet_register_view.php'),
('2022-05-10 14:14:28', 'INSERT INTO `gmt_fleet_register` SET `vehicle_registration_number`=\'GTB786L\', `engine_number`=\'2NRD062034\', `chassis_number`=\'MBJB29BT600087734\', `dealer_name`=\'1\', `make_of_vehicle`=\'1\', `model_of_vehicle`=\'ETIOS 1.5SX SD\', `year_model_specification`=\'8\', `engine_capacity`=\'1.5\', `tyre_size`=\'14\', `transmission`=\'3\', `fuel_type`=\'2\', `type_of_vehicle`=\'3\', `colour_of_vehicle`=\'13\', `application_status`=\'1\', `barcode_number`=\'2015633\', `purchase_price`=\'R 119 126 .58\', `depreciation_value`=NULL, `photo_of_vehicle`=NULL, `user_name_and_surname`=\'LEKGOTHOANE LT\', `user_contact_email`=\'LEKGOTHOANEL@dtcs.limpopo.gov.za\', `contact_number`=\'+10152951000\', `department_name`=\'13\', `department_address`=\'PRIVATE BAG X 9491<div>POLOKWANE</div><div>0700</div>\', `province`=\'1\', `district`=\'1\', `drivers_name_and_surname`=\'2\', `drivers_persal_number`=\'2\', `department_name_of_driver`=\'13\', `drivers_contact_details`=\'2\', `documents`=NULL, `date_auctioned`=NULL, `comments`=\'<br>\', `renewal_of_license`=\'2022-3-31\', `mm_code`=NULL', '0.00', 'Duplicate entry \'2NRD062034\' for key \'engine_number_unique\'', '80207456', '/ldtcsgmtfleet/gmt_fleet_register_view.php'),
('2022-05-10 15:19:40', 'INSERT INTO `gmt_fleet_register` SET `vehicle_registration_number`=\'GTB870L\', `engine_number`=\'65195035472222\', `chassis_number`=\'W1V44770323931436\', `dealer_name`=\'6\', `make_of_vehicle`=\'9\', `model_of_vehicle`=\'VITO 116 CDI TOURER PROF\', `year_model_specification`=\'15\', `engine_capacity`=\'2199\', `tyre_size`=\'18\', `transmission`=\'1\', `fuel_type`=\'3\', `type_of_vehicle`=\'16\', `colour_of_vehicle`=\'24\', `application_status`=\'1\', `barcode_number`=\'02043215\', `purchase_price`=\'R 778,200.00\', `depreciation_value`=NULL, `photo_of_vehicle`=NULL, `user_name_and_surname`=\'Lekgothoane L.T\', `user_contact_email`=\'lekgothoanel@dtcs.limpopo.gov.za\', `contact_number`=\'(015) 295 1000\', `department_name`=\'13\', `department_address`=\'Private bag x9491<div>Polokwane</div><div>0700</div>\', `province`=\'1\', `district`=\'4\', `drivers_name_and_surname`=\'2\', `drivers_persal_number`=\'2\', `department_name_of_driver`=\'13\', `drivers_contact_details`=\'2\', `documents`=NULL, `date_auctioned`=NULL, `comments`=\'<br>\', `renewal_of_license`=\'2023-2-28\', `mm_code`=NULL', '0.00', 'Duplicate entry \'65195035472222\' for key \'engine_number_unique\'', '80205411', '/ldtcsgmtfleet/gmt_fleet_register_view.php'),
('2022-05-10 15:22:11', 'INSERT INTO `gmt_fleet_register` SET `vehicle_registration_number`=\'GTB870L\', `engine_number`=\'65195035472222\', `chassis_number`=\'W1V44770323931436\', `dealer_name`=\'6\', `make_of_vehicle`=\'9\', `model_of_vehicle`=\'VITO 116 CDI TOURER PROF\', `year_model_specification`=\'15\', `engine_capacity`=\'2199\', `tyre_size`=\'18\', `transmission`=\'1\', `fuel_type`=\'3\', `type_of_vehicle`=\'16\', `colour_of_vehicle`=\'24\', `application_status`=\'1\', `barcode_number`=\'02043215\', `purchase_price`=\'R 778,200.00\', `depreciation_value`=NULL, `photo_of_vehicle`=NULL, `user_name_and_surname`=\'Lekgothoane L.T\', `user_contact_email`=\'lekgothoanel@dtcs.limpopo.gov.za\', `contact_number`=\'(015) 295 1000\', `department_name`=\'13\', `department_address`=\'Private bag x9491<div>Polokwane</div><div>0700</div>\', `province`=\'1\', `district`=\'4\', `drivers_name_and_surname`=\'2\', `drivers_persal_number`=\'2\', `department_name_of_driver`=\'13\', `drivers_contact_details`=\'2\', `documents`=NULL, `date_auctioned`=NULL, `comments`=\'<br>\', `renewal_of_license`=\'2023-2-28\', `mm_code`=NULL', '0.00', 'Duplicate entry \'65195035472222\' for key \'engine_number_unique\'', '80205411', '/ldtcsgmtfleet/gmt_fleet_register_view.php');

-- --------------------------------------------------------

--
-- Table structure for table `application_status`
--

DROP TABLE IF EXISTS `application_status`;
CREATE TABLE IF NOT EXISTS `application_status` (
  `application_id` int NOT NULL AUTO_INCREMENT,
  `application_status` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`application_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `application_status`
--

INSERT INTO `application_status` (`application_id`, `application_status`) VALUES
(1, 'Active'),
(2, 'Withdrawn'),
(3, 'Dormant'),
(4, 'Stolen'),
(5, 'Auction');

-- --------------------------------------------------------

--
-- Table structure for table `auditor`
--

DROP TABLE IF EXISTS `auditor`;
CREATE TABLE IF NOT EXISTS `auditor` (
  `auditor_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `res_id` int UNSIGNED DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `ipaddr` varchar(25) DEFAULT NULL,
  `time_stmp` timestamp NULL DEFAULT NULL,
  `change_type` varchar(10) DEFAULT NULL,
  `table_name` varchar(40) DEFAULT NULL,
  `fieldName` varchar(40) DEFAULT NULL,
  `OldValue` text,
  `NewValue` text,
  PRIMARY KEY (`auditor_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `authorizations`
--

DROP TABLE IF EXISTS `authorizations`;
CREATE TABLE IF NOT EXISTS `authorizations` (
  `authorize_id` int NOT NULL AUTO_INCREMENT,
  `job_code` int DEFAULT NULL,
  `job_status` int DEFAULT NULL,
  `job_status_date` date DEFAULT '0000-00-00',
  `job_status_age` varchar(40) DEFAULT NULL,
  `job_age` varchar(40) DEFAULT NULL,
  `job_category` int DEFAULT NULL,
  `job_odometer` int DEFAULT NULL,
  `instruction_note` int DEFAULT NULL,
  `pre_authorisation_date` int DEFAULT '1',
  `authorisation_date` date DEFAULT '0000-00-00',
  `vehicle_registration_number` int DEFAULT NULL,
  `make_of_vehicle` int DEFAULT NULL,
  `client` int DEFAULT NULL,
  `province_name` int DEFAULT NULL,
  `merchant_code` int DEFAULT NULL,
  `merchant_name` int DEFAULT NULL,
  `merchant_contact_email` int DEFAULT NULL,
  `merchant_street_address` int DEFAULT NULL,
  `merchant_suburb` int DEFAULT NULL,
  `merchant_city` int DEFAULT NULL,
  `merchant_address_code` int DEFAULT NULL,
  `merchant_contact_details` int DEFAULT NULL,
  `total_claim` int DEFAULT NULL,
  `total_authorised` int DEFAULT NULL,
  `authorization_number` int DEFAULT NULL,
  `last_fuel_transaction_date` date DEFAULT '0000-00-00',
  `external_repairs` text,
  PRIMARY KEY (`authorize_id`),
  KEY `job_code` (`job_code`),
  KEY `job_status` (`job_status`),
  KEY `job_category` (`job_category`),
  KEY `job_odometer` (`job_odometer`),
  KEY `pre_authorisation_date` (`pre_authorisation_date`),
  KEY `vehicle_registration_number` (`vehicle_registration_number`),
  KEY `make_of_vehicle` (`make_of_vehicle`),
  KEY `client` (`client`),
  KEY `province_name` (`province_name`),
  KEY `merchant_code` (`merchant_code`),
  KEY `total_claim` (`total_claim`),
  KEY `total_authorised` (`total_authorised`),
  KEY `instruction_note` (`instruction_note`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `authorizations`
--

INSERT INTO `authorizations` (`authorize_id`, `job_code`, `job_status`, `job_status_date`, `job_status_age`, `job_age`, `job_category`, `job_odometer`, `instruction_note`, `pre_authorisation_date`, `authorisation_date`, `vehicle_registration_number`, `make_of_vehicle`, `client`, `province_name`, `merchant_code`, `merchant_name`, `merchant_contact_email`, `merchant_street_address`, `merchant_suburb`, `merchant_city`, `merchant_address_code`, `merchant_contact_details`, `total_claim`, `total_authorised`, `authorization_number`, `last_fuel_transaction_date`, `external_repairs`) VALUES
(1, 1, 2, '2022-02-08', NULL, NULL, 1, 1, 1, 1, NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL),
(2, 2, 2, '2022-01-12', NULL, NULL, 1, 2, 2, 2, '2022-02-15', 2, 2, 2, 1, 1, 1, 1, 1, 1, 1, 1, 1, 2, 2, 2, '2022-01-14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

DROP TABLE IF EXISTS `billing`;
CREATE TABLE IF NOT EXISTS `billing` (
  `billing_id` int NOT NULL AUTO_INCREMENT,
  `upload_invoice` varchar(40) DEFAULT NULL,
  `job_card_number` int DEFAULT NULL,
  `maintenance_file` varchar(40) DEFAULT NULL,
  `vehicle_registration_number` int DEFAULT NULL,
  `engine_number` int DEFAULT NULL,
  `make_of_vehicle` int DEFAULT NULL,
  `district` int DEFAULT NULL,
  `location` int DEFAULT NULL,
  `invoice_date` date DEFAULT '0000-00-00',
  PRIMARY KEY (`billing_id`),
  KEY `vehicle_registration_number` (`vehicle_registration_number`),
  KEY `district` (`district`),
  KEY `job_card_number` (`job_card_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `body_type`
--

DROP TABLE IF EXISTS `body_type`;
CREATE TABLE IF NOT EXISTS `body_type` (
  `body_type_id` int NOT NULL AUTO_INCREMENT,
  `type_of_vehicle` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`body_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `body_type`
--

INSERT INTO `body_type` (`body_type_id`, `type_of_vehicle`) VALUES
(1, 'Coupe'),
(2, 'Cabriolet'),
(3, 'Sedan'),
(4, 'Hatchback'),
(5, 'Station Wagon'),
(6, 'Sport Utility Vehicle'),
(7, 'Sport Activity Vehicle'),
(8, 'Minibus'),
(9, 'Panel Van'),
(10, 'Drop Side'),
(11, 'Pick Up'),
(12, 'Multi Purpose Vehicle'),
(13, 'Chassis Cab'),
(14, 'Trailer'),
(15, 'Road Maintenance Equipment'),
(16, 'Bus'),
(17, 'Ldv'),
(18, 'Double Cab'),
(19, 'Breakdown');

-- --------------------------------------------------------

--
-- Table structure for table `breakdown_services`
--

DROP TABLE IF EXISTS `breakdown_services`;
CREATE TABLE IF NOT EXISTS `breakdown_services` (
  `breakdown_id` int NOT NULL AUTO_INCREMENT,
  `breakdown_of_vehicle` varchar(40) DEFAULT NULL,
  `breakdown_during_office_hours` varchar(40) DEFAULT NULL,
  `breakdown_within_or_outside_the_province` varchar(40) DEFAULT NULL,
  `description_of_vehicle_breakdown_notes` int DEFAULT NULL,
  `description_of_vehicle_breakdown` varchar(40) DEFAULT NULL,
  `date_of_vehicle_breakdown` date DEFAULT NULL,
  `work_allocation_reference_number` int DEFAULT NULL,
  `job_card_number` int DEFAULT NULL,
  `vehicle_registration_number` int DEFAULT NULL,
  `engine_number` int DEFAULT NULL,
  `closing_km` int DEFAULT NULL,
  `date_of_vehicle_reactivation` date DEFAULT NULL,
  `type_of_expenditure` varchar(40) DEFAULT NULL,
  `labour_category` varchar(40) DEFAULT NULL,
  `part_number` int DEFAULT NULL,
  `part_name` int DEFAULT NULL,
  `part_manufacturer_name` int DEFAULT NULL,
  `quantity` varchar(40) DEFAULT NULL,
  `expense_of_item` decimal(10,2) DEFAULT NULL,
  `labour_category_1` varchar(40) DEFAULT NULL,
  `part_number_1` int DEFAULT NULL,
  `part_name_1` int DEFAULT NULL,
  `part_manufacturer_name_1` int DEFAULT NULL,
  `quantity_1` varchar(40) DEFAULT NULL,
  `expense_of_item_1` decimal(10,2) DEFAULT NULL,
  `material_cost` decimal(10,2) DEFAULT NULL,
  `average_worktime_hrs` varchar(40) DEFAULT NULL,
  `standard_labour_cost_per_hour` decimal(10,2) DEFAULT NULL,
  `labour_charges` decimal(10,2) DEFAULT NULL,
  `vat` decimal(10,2) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `workshop_name` int DEFAULT NULL,
  `work_order_status` varchar(40) DEFAULT NULL,
  `comments` longtext,
  `upload_invoice` varchar(40) DEFAULT NULL,
  `receptionist` int DEFAULT NULL,
  `receptionist_contact_email` int DEFAULT NULL,
  `date_captured` datetime DEFAULT NULL,
  PRIMARY KEY (`breakdown_id`),
  KEY `work_allocation_reference_number` (`work_allocation_reference_number`),
  KEY `job_card_number` (`job_card_number`),
  KEY `vehicle_registration_number` (`vehicle_registration_number`),
  KEY `closing_km` (`closing_km`),
  KEY `part_number` (`part_number`),
  KEY `part_name` (`part_name`),
  KEY `part_manufacturer_name` (`part_manufacturer_name`),
  KEY `part_number_1` (`part_number_1`),
  KEY `part_name_1` (`part_name_1`),
  KEY `part_manufacturer_name_1` (`part_manufacturer_name_1`),
  KEY `workshop_name` (`workshop_name`),
  KEY `description_of_vehicle_breakdown_notes` (`description_of_vehicle_breakdown_notes`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `breakdown_services`
--

INSERT INTO `breakdown_services` (`breakdown_id`, `breakdown_of_vehicle`, `breakdown_during_office_hours`, `breakdown_within_or_outside_the_province`, `description_of_vehicle_breakdown_notes`, `description_of_vehicle_breakdown`, `date_of_vehicle_breakdown`, `work_allocation_reference_number`, `job_card_number`, `vehicle_registration_number`, `engine_number`, `closing_km`, `date_of_vehicle_reactivation`, `type_of_expenditure`, `labour_category`, `part_number`, `part_name`, `part_manufacturer_name`, `quantity`, `expense_of_item`, `labour_category_1`, `part_number_1`, `part_name_1`, `part_manufacturer_name_1`, `quantity_1`, `expense_of_item_1`, `material_cost`, `average_worktime_hrs`, `standard_labour_cost_per_hour`, `labour_charges`, `vat`, `total_amount`, `workshop_name`, `work_order_status`, `comments`, `upload_invoice`, `receptionist`, `receptionist_contact_email`, `date_captured`) VALUES
(1, 'Yes', 'Yes', 'Within the Province', 1, NULL, '2020-10-19', NULL, 1, 2, 2, 2, NULL, 'Part', 'Change::Replace', 1, 1, 1, '1', '342.12', 'Rotate', 1, 1, 2, '2', '356.12', '271.34', '4.5', '275.00', '123.45', '0.15', NULL, 1, 'Pending', '<br>', NULL, 1, 1, '2022-03-25 17:52:51');

-- --------------------------------------------------------

--
-- Table structure for table `claim`
--

DROP TABLE IF EXISTS `claim`;
CREATE TABLE IF NOT EXISTS `claim` (
  `claim_id` int NOT NULL AUTO_INCREMENT,
  `claim_code` varchar(40) DEFAULT NULL,
  `claim_status` int DEFAULT NULL,
  `claim_category` int DEFAULT NULL,
  `cost_centre` int DEFAULT NULL,
  `client_identification` varchar(40) DEFAULT NULL,
  `department_name` int DEFAULT NULL,
  `district` int DEFAULT NULL,
  `province` int DEFAULT NULL,
  `merchant_name` int DEFAULT NULL,
  `vehicle_registration_number` int DEFAULT NULL,
  `closing_km` int DEFAULT NULL,
  `pre_authorization_date` date DEFAULT '0000-00-00',
  `instruction_note` text,
  `invoice_date` date DEFAULT '0000-00-00',
  `upload_invoice` varchar(40) DEFAULT NULL,
  `payment_date` date DEFAULT '0000-00-00',
  `authorization_number` varchar(40) NOT NULL,
  `clearance_number` varchar(40) DEFAULT NULL,
  `vehicle_collected_date` date DEFAULT '0000-00-00',
  `total_claimed` decimal(10,2) DEFAULT NULL,
  `total_authorized` decimal(10,2) DEFAULT NULL,
  `model` int DEFAULT NULL,
  PRIMARY KEY (`claim_id`),
  KEY `claim_status` (`claim_status`),
  KEY `claim_category` (`claim_category`),
  KEY `cost_centre` (`cost_centre`),
  KEY `department_name` (`department_name`),
  KEY `district` (`district`),
  KEY `province` (`province`),
  KEY `merchant_name` (`merchant_name`),
  KEY `vehicle_registration_number` (`vehicle_registration_number`),
  KEY `closing_km` (`closing_km`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `claim`
--

INSERT INTO `claim` (`claim_id`, `claim_code`, `claim_status`, `claim_category`, `cost_centre`, `client_identification`, `department_name`, `district`, `province`, `merchant_name`, `vehicle_registration_number`, `closing_km`, `pre_authorization_date`, `instruction_note`, `invoice_date`, `upload_invoice`, `payment_date`, `authorization_number`, `clearance_number`, `vehicle_collected_date`, `total_claimed`, `total_authorized`, `model`) VALUES
(1, 'RusKiyv24022022', 2, 1, 3, 'Vladimir Putin', 5, 51, 1, 1, 2, 2, '2022-02-25', 'Gearbox replacement and fix the drive chain<br>', '2022-03-05', NULL, '2022-03-18', 'AUTH24022022DPL322L', 'CL0331DPL322L', '2022-03-22', '7456.23', '8000.00', NULL),
(2, 'IsrlIrk24022022', 2, 1, 5, 'Nethayahu', 9, 99, 1, 1, 1, 1, '2022-03-02', 'Overhaul the diff and replace gear lever<br>', '2022-03-11', NULL, '2022-03-18', 'AUTH24022022DTN004L', 'CL0331DTN004L', '2022-03-25', '17234.32', '18500.00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `claim_category`
--

DROP TABLE IF EXISTS `claim_category`;
CREATE TABLE IF NOT EXISTS `claim_category` (
  `claim_category_id` int NOT NULL AUTO_INCREMENT,
  `claim_category` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`claim_category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `claim_category`
--

INSERT INTO `claim_category` (`claim_category_id`, `claim_category`) VALUES
(1, 'Maintenance and Repair'),
(2, 'Accident - minor'),
(3, 'General - minor'),
(4, 'Accident - major'),
(5, 'General - major');

-- --------------------------------------------------------

--
-- Table structure for table `claim_status`
--

DROP TABLE IF EXISTS `claim_status`;
CREATE TABLE IF NOT EXISTS `claim_status` (
  `claim_status_id` int NOT NULL AUTO_INCREMENT,
  `claim_status` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`claim_status_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `claim_status`
--

INSERT INTO `claim_status` (`claim_status_id`, `claim_status`) VALUES
(1, 'Pending'),
(2, 'In Process'),
(3, 'Closed'),
(4, 'Started');

-- --------------------------------------------------------

--
-- Table structure for table `collection_of_repaired_vehicles`
--

DROP TABLE IF EXISTS `collection_of_repaired_vehicles`;
CREATE TABLE IF NOT EXISTS `collection_of_repaired_vehicles` (
  `collection_id` int NOT NULL AUTO_INCREMENT,
  `reception_name_and_surname` int DEFAULT NULL,
  `reception_persal_number` int DEFAULT NULL,
  `reception_contact_details` int DEFAULT NULL,
  `reception_email_address` int DEFAULT NULL,
  `reception_signature` varchar(40) DEFAULT NULL,
  `driver_name_and_surname` int DEFAULT NULL,
  `driver_persal_number` int DEFAULT NULL,
  `driver_contacts_details` int DEFAULT NULL,
  `driver_email_address` int DEFAULT NULL,
  `driver_license_upload` varchar(40) DEFAULT NULL,
  `driver_signature` varchar(40) DEFAULT NULL,
  `government_garage_name` int DEFAULT NULL,
  `government_garage_contact_details` varchar(40) DEFAULT NULL,
  `government_garage_address` text,
  `government_garage_email_address` varchar(40) DEFAULT NULL,
  `vehicle_registration_number` int DEFAULT NULL,
  `engine_number` int DEFAULT NULL,
  `make_of_vehicle` int DEFAULT NULL,
  `vehicle_inspection` varchar(40) DEFAULT NULL,
  `vehicle_inspection_form` varchar(40) DEFAULT NULL,
  `vehicle_interiour_condition` text,
  `vehicle_exteriour_condition` text,
  `vehicle_tyre_check` varchar(40) DEFAULT NULL,
  `sign_off_time` time DEFAULT NULL,
  `date_of_repaired_vehicle_collection` datetime DEFAULT NULL,
  PRIMARY KEY (`collection_id`),
  KEY `reception_name_and_surname` (`reception_name_and_surname`),
  KEY `driver_name_and_surname` (`driver_name_and_surname`),
  KEY `government_garage_name` (`government_garage_name`),
  KEY `vehicle_registration_number` (`vehicle_registration_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `costing`
--

DROP TABLE IF EXISTS `costing`;
CREATE TABLE IF NOT EXISTS `costing` (
  `costing_id` int NOT NULL AUTO_INCREMENT,
  `government_garage_name` int DEFAULT NULL,
  `supervisor_name_and_surname` varchar(40) DEFAULT NULL,
  `supervisor_contact_details` varchar(40) DEFAULT NULL,
  `supervisor_email_address` varchar(40) DEFAULT NULL,
  `supervisor_signature` varchar(40) DEFAULT NULL,
  `job_card_number` int DEFAULT NULL,
  `vehicle_registration_number` int DEFAULT NULL,
  `engine_number` int DEFAULT NULL,
  `make_of_vehicle` int DEFAULT NULL,
  `reconciliation_of_total_costs_by_costing_officer` varchar(40) DEFAULT NULL,
  `costing_officer_name_and_surname` varchar(40) DEFAULT NULL,
  `costing_officer_contact_details` varchar(40) DEFAULT NULL,
  `costing_officer_email_address` varchar(40) DEFAULT NULL,
  `costing_officer_signature` varchar(40) DEFAULT NULL,
  `material_cost` decimal(10,2) DEFAULT NULL,
  `spares_orders_quotation` decimal(10,2) DEFAULT NULL,
  `spares_orders_quotation_upload` varchar(40) DEFAULT NULL,
  `standard_labour_cost_per_hour` decimal(10,2) DEFAULT NULL,
  `labour_quotation` decimal(10,2) DEFAULT NULL,
  `labour_quotation_upload` varchar(40) DEFAULT NULL,
  `vat` decimal(10,2) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `workshop_manager_name_and_surname` varchar(40) DEFAULT NULL,
  `workshop_manager_contact_details` varchar(40) DEFAULT NULL,
  `workshop_manager_email_address` varchar(40) DEFAULT NULL,
  `workshop_manager_signature` varchar(40) DEFAULT NULL,
  `invoice_approved` varchar(40) DEFAULT NULL,
  `upload_invoice` varchar(40) DEFAULT NULL,
  `invoice_date` date DEFAULT '0000-00-00',
  PRIMARY KEY (`costing_id`),
  KEY `government_garage_name` (`government_garage_name`),
  KEY `job_card_number` (`job_card_number`),
  KEY `vehicle_registration_number` (`vehicle_registration_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cost_centre`
--

DROP TABLE IF EXISTS `cost_centre`;
CREATE TABLE IF NOT EXISTS `cost_centre` (
  `cost_centre_id` int NOT NULL AUTO_INCREMENT,
  `cost_centre` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`cost_centre_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cost_centre`
--

INSERT INTO `cost_centre` (`cost_centre_id`, `cost_centre`) VALUES
(1, 'Capricorn Cost Centre'),
(2, 'Sekhukhune Cost Centre'),
(3, 'Mopani Cost Centre'),
(4, 'Vhembe Cost Centre'),
(5, 'Waterberg Cost Centre');

-- --------------------------------------------------------

--
-- Table structure for table `dealer`
--

DROP TABLE IF EXISTS `dealer`;
CREATE TABLE IF NOT EXISTS `dealer` (
  `dealer_id` int NOT NULL AUTO_INCREMENT,
  `dealer_type` int DEFAULT NULL,
  `make_of_vehicle` varchar(40) DEFAULT NULL,
  `dealer_name` varchar(40) DEFAULT NULL,
  `contact_person` varchar(40) DEFAULT NULL,
  `contact_details` varchar(40) DEFAULT NULL,
  `contact_email` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`dealer_id`),
  KEY `dealer_type` (`dealer_type`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dealer`
--

INSERT INTO `dealer` (`dealer_id`, `dealer_type`, `make_of_vehicle`, `dealer_name`, `contact_person`, `contact_details`, `contact_email`) VALUES
(1, 1, 'Toyota', 'Toyota Wonderboom - South Pretoria', NULL, NULL, NULL),
(2, 1, 'Volkswagen', 'Volkswagen Mountain View', NULL, NULL, NULL),
(3, 1, 'Nissan', 'Nissan Fairy Glen Pretoria', NULL, NULL, NULL),
(4, 1, 'Ford', 'Ford Wonder Waters Pretoria', NULL, NULL, NULL),
(5, 1, 'Isuzu', 'Isuzu Bedford View', NULL, NULL, NULL),
(6, 1, 'Mercedes Benz', 'Mercedes Benz Grand Central', NULL, NULL, NULL),
(7, 1, 'BMW', 'BMW Silverton Ridge Pretoria', NULL, NULL, NULL),
(8, 1, 'MAHINDRA', 'MAHINDRA SOUTH AFRICA', 'MAHINDRA - MAHINDRA', NULL, NULL),
(9, 1, 'Mercedes Benz', 'Sprinter 518XL', NULL, NULL, NULL),
(10, 1, 'CHEVROLET', 'GENERAL MOTORS SOUTH AFRICA ', NULL, '0414039111', NULL),
(11, 1, 'Suzuki', 'Suzuki Auto South Africa ', NULL, NULL, NULL),
(12, 2, 'VENTER', NULL, NULL, NULL, NULL),
(13, 2, 'VENTER', 'VENTER SOUTH AFRICA', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dealer_type`
--

DROP TABLE IF EXISTS `dealer_type`;
CREATE TABLE IF NOT EXISTS `dealer_type` (
  `dealer_type_id` int NOT NULL AUTO_INCREMENT,
  `dealer_type` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`dealer_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dealer_type`
--

INSERT INTO `dealer_type` (`dealer_type_id`, `dealer_type`) VALUES
(1, 'Motor Vehicles'),
(2, 'Farm Equipment'),
(3, 'Trucks');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
CREATE TABLE IF NOT EXISTS `departments` (
  `department_id` int NOT NULL AUTO_INCREMENT,
  `department_name` varchar(75) DEFAULT NULL,
  PRIMARY KEY (`department_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `department_name`) VALUES
(1, 'Office of the Premier (OTP)'),
(2, 'Department of Agriculture'),
(3, 'Department of Education'),
(4, 'Department of Economic Development,Environmental Affairs'),
(5, 'Department of Health and Social Development'),
(6, 'Department of Cooperative Governance, Human Settlement'),
(7, 'Provincial Treasury'),
(8, 'Department of Public Works'),
(9, 'Department of Transport and Community Security'),
(10, 'Department Safety, Security and Liaison'),
(11, 'Department of Sport, Arts and Culture'),
(12, 'Other'),
(13, 'Department of Transport and Community Safety');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

DROP TABLE IF EXISTS `districts`;
CREATE TABLE IF NOT EXISTS `districts` (
  `district_id` int NOT NULL AUTO_INCREMENT,
  `district` varchar(40) DEFAULT NULL,
  `station` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`district_id`)
) ENGINE=MyISAM AUTO_INCREMENT=119 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`district_id`, `district`, `station`) VALUES
(1, 'Head Office : Pool Section', 'Pool Section'),
(2, 'Head Office : Manenu', 'Manenu'),
(3, 'Head Office : Traffic Management', 'Traffic Management'),
(4, 'Head Office : MEC Office', 'MEC Office'),
(5, 'Capricorn : District Office', 'District Office'),
(6, 'Capricorn : Seshego Govt Garage', 'Seshego Govt Garage'),
(9, 'Capricorn : Polokwane Traffic Station', 'Polokwane Traffic Station'),
(10, 'Capricorn : Mogwadi Traffic Station', 'Mogwadi Traffic Station'),
(13, 'Capricorn : Polokwane Traffic Station', 'Polokwane Traffic Station'),
(14, 'Capricorn : Polokwane Weight Bridge', 'Polokwane Weight Bridge'),
(15, 'Capricorn : Lebowakgomo Traffic Station', 'Lebowakgomo Traffic Station'),
(16, 'Capricorn : Mokomene Traffic Station', 'Mokomene Traffic Station'),
(17, 'Sekhukhune: Dilokong Traffic Station', 'Dilokong Traffic Station'),
(18, 'Sekhukhune: District Office', 'District Office'),
(22, 'Sekhukhune: Lebowakgomo Govt Garage', 'Lebowakgomo Govt Garage'),
(24, 'Sekhukhune: Moutse Traffic Station', 'Moutse Traffic Station'),
(26, 'Sekhukhune: Nebo Government Garage', 'Nebo Government Garage'),
(27, 'Sekhukhune: Nebo Traffic Station', 'Nebo Traffic Station'),
(28, 'Sekhukhune: Rathoke Weighbridge', 'Rathoke Weighbridge'),
(32, 'Vhembe: District Office', 'District Office'),
(34, 'Vhembe: Makhado Traffic Station', 'Makhado Traffic Station'),
(35, 'Vhembe: Dzanani Traffic Station', 'Dzanani Traffic Station'),
(37, 'Vhembe: Malamulele Traffic Station', 'Malamulele Traffic Station'),
(38, 'Vhembe: Musina Weigh Bridge', 'Musina Weigh Bridge'),
(39, 'Vhembe: Mutale Traffic Station', 'Mutale Traffic Station'),
(40, 'Vhembe: Sibasa Govt Garage', 'Sibasa Govt Garage'),
(41, 'Vhembe: Thohoyandou Traffic Station', 'Thohoyandou Traffic Station'),
(42, 'Vhembe: Mampakuil Weigh Bridge', 'Mampakuil Weigh Bridge'),
(43, 'Vhembe: Rabali Traffic Station', 'Rabali Traffic Station'),
(45, 'Mopani: Bolobedu Traffic Station', 'Bolobedu Traffic Station'),
(46, 'Mopani: District Office', 'District Office'),
(50, 'Mopani: Giyani Traffic Station', 'Giyani Traffic Station'),
(51, 'Mopani: Giyani Government Garage', 'Giyani Government Garage'),
(52, 'Mopani: Mooketsi T-C-Centre', 'Mooketsi T-C-Centre'),
(55, 'Mopani: Hoedspruit Traffic Station', 'Hoedspruit Traffic Station'),
(58, 'Mopani: Ba-Phalaborwa Traffic Station', 'Ba-Phalaborwa Traffic Station'),
(63, 'Mopani: Naphuno Traffic Station', 'Naphuno Traffic Station'),
(67, 'Mopani: Ritavi Traffic Station', 'Ritavi Traffic Station'),
(70, 'Mopani: Tzaneen Traffic Station', 'Tzaneen Traffic Station'),
(71, 'Mopani: Maruleng Traffic Station', 'Maruleng Traffic Station'),
(79, 'Waterberg: District Office', 'District Office'),
(82, 'Waterberg: Groblersbrug Traffic Control', 'Groblersbrug Traffic Control'),
(86, 'Waterberg: Lephalale Traffic Centre', 'Lephalale Traffic Centre'),
(87, 'Waterberg: Mahwelereng Govt Garage', 'Mahwelereng Govt Garage'),
(88, 'Waterberg: Mantsole Traffic Centre', 'Mantsole Traffic Centre'),
(91, 'Waterberg: Modimolle Traffic Centre', 'Modimolle Traffic Centre'),
(94, 'Waterberg: Mokopane Traffic Station', 'Mokopane Traffic Station'),
(98, 'Waterberg: Northam Traffic Station', 'Northam Traffic Station'),
(99, 'Waterberg: Nylstroom Traffic Station', 'Nylstroom Traffic Station'),
(105, 'Waterberg: Zebetiela Traffic Control Cen', 'Zebetiela Traffic Control Centre');

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

DROP TABLE IF EXISTS `driver`;
CREATE TABLE IF NOT EXISTS `driver` (
  `driver_id` int NOT NULL AUTO_INCREMENT,
  `drivers_name_and_surname` varchar(40) NOT NULL,
  `drivers_persal_number` varchar(40) NOT NULL,
  `drivers_contact_details` varchar(40) DEFAULT NULL,
  `drivers_email_address` varchar(40) DEFAULT NULL,
  `drivers_license` varchar(40) DEFAULT NULL,
  `drivers_license_code` varchar(40) DEFAULT NULL,
  `drivers_license_number` varchar(40) DEFAULT NULL,
  `drivers_license_upload` varchar(40) DEFAULT NULL,
  `drivers_license_expire_date` date DEFAULT NULL,
  `drivers_license_renewal_date` date DEFAULT NULL,
  `drivers_log_history` text,
  `drivers_license_penalties` varchar(40) DEFAULT NULL,
  `drivers_license_penalties_date` date DEFAULT NULL,
  `drivers_license_penalty_details` text,
  `drivers_license_penalty_details_uploads` varchar(40) DEFAULT NULL,
  `involved_in_accident` varchar(40) DEFAULT NULL,
  `accident_report` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`driver_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`driver_id`, `drivers_name_and_surname`, `drivers_persal_number`, `drivers_contact_details`, `drivers_email_address`, `drivers_license`, `drivers_license_code`, `drivers_license_number`, `drivers_license_upload`, `drivers_license_expire_date`, `drivers_license_renewal_date`, `drivers_log_history`, `drivers_license_penalties`, `drivers_license_penalties_date`, `drivers_license_penalty_details`, `drivers_license_penalty_details_uploads`, `involved_in_accident`, `accident_report`) VALUES
(1, 'Mara Kriel', '82480397', '015 295 1077', 'krielm@dot.limpopo.gov.za', 'Yes', 'Yes', 'Yes', NULL, '2017-07-11', '2017-07-11', '<br>', 'No', '2017-07-11', '<br>', NULL, 'No', NULL),
(2, 'Admin Officials', 'Officials', '01529510000', NULL, 'No', NULL, NULL, NULL, '2022-05-09', '2022-05-09', '<br>', NULL, '2022-05-09', '<br>', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `external_repairs_body`
--

DROP TABLE IF EXISTS `external_repairs_body`;
CREATE TABLE IF NOT EXISTS `external_repairs_body` (
  `external_repair_body_id` int NOT NULL AUTO_INCREMENT,
  `head_panel_beating_name` varchar(40) DEFAULT NULL,
  `head_panel_beating_contact_details` varchar(40) DEFAULT NULL,
  `head_panel_beating_address` text,
  `head_panel_beating_signature` varchar(40) DEFAULT NULL,
  `panel_beating_quotation` varchar(40) DEFAULT NULL,
  `panel_beating_quotation_approved_by_service_provider` varchar(40) DEFAULT NULL,
  `service_provider_name` int DEFAULT NULL,
  `service_provider_type` int DEFAULT NULL,
  `service_provider_contact_details` int DEFAULT NULL,
  `service_provider_address` int DEFAULT NULL,
  `service_provider_branch` int DEFAULT NULL,
  `service_provider_branch_code` int DEFAULT NULL,
  `service_provider_signature` varchar(40) DEFAULT NULL,
  `instruction_note` int DEFAULT NULL,
  `authorization_number` int DEFAULT NULL,
  `vehicle_registration_number` int DEFAULT NULL,
  `engine_number` int DEFAULT NULL,
  `make_of_vehicle` int DEFAULT NULL,
  `vehicle_colour` int DEFAULT NULL,
  `vehicle_inspection_done` varchar(40) DEFAULT NULL,
  `vehicle_inspection_check_list_form` varchar(40) DEFAULT NULL,
  `vehicle_tyre_sizes` varchar(40) DEFAULT NULL,
  `vehicle_mirrow_check` text,
  `vehicle_interior_condition` text,
  `vehicle_exterior_condition` text,
  `merchant_type` int DEFAULT NULL,
  `merchant_code` int DEFAULT NULL,
  `merchant_name` int DEFAULT NULL,
  `merchant_contacts_details` int DEFAULT NULL,
  `merchant_email_address` varchar(40) DEFAULT NULL,
  `merchant_signature` varchar(40) DEFAULT NULL,
  `merchant_address` int DEFAULT NULL,
  `merchant_address_code` int DEFAULT NULL,
  `merchant_city` int DEFAULT NULL,
  `head_panel_beating_monitor_progress` varchar(40) DEFAULT NULL,
  `head_panel_beating_monitor_quality_of_work_manship` varchar(40) DEFAULT NULL,
  `vehicle_inspection_report` varchar(40) DEFAULT NULL,
  `upload_invoice` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`external_repair_body_id`),
  KEY `service_provider_name` (`service_provider_name`),
  KEY `service_provider_type` (`service_provider_type`),
  KEY `service_provider_contact_details` (`service_provider_contact_details`),
  KEY `service_provider_address` (`service_provider_address`),
  KEY `service_provider_branch` (`service_provider_branch`),
  KEY `service_provider_branch_code` (`service_provider_branch_code`),
  KEY `instruction_note` (`instruction_note`),
  KEY `vehicle_registration_number` (`vehicle_registration_number`),
  KEY `merchant_type` (`merchant_type`),
  KEY `merchant_code` (`merchant_code`),
  KEY `merchant_name` (`merchant_name`),
  KEY `merchant_contacts_details` (`merchant_contacts_details`),
  KEY `merchant_address` (`merchant_address`),
  KEY `merchant_address_code` (`merchant_address_code`),
  KEY `merchant_city` (`merchant_city`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `external_repairs_mechanical`
--

DROP TABLE IF EXISTS `external_repairs_mechanical`;
CREATE TABLE IF NOT EXISTS `external_repairs_mechanical` (
  `external_mechanical_id` int NOT NULL AUTO_INCREMENT,
  `department_inspector_name_and_surname` varchar(40) DEFAULT NULL,
  `department_inspector_persal_number` varchar(40) DEFAULT NULL,
  `department_authorization_quote_note` text,
  `department_inspector_signature` varchar(40) DEFAULT NULL,
  `inspection_approval_repair_note` text,
  `department_authorization_quote` varchar(40) DEFAULT NULL,
  `service_provider_name` int DEFAULT NULL,
  `service_provider_type` int DEFAULT NULL,
  `service_provider_contact_details` int DEFAULT NULL,
  `service_provider_address` int DEFAULT NULL,
  `service_provider_signature` varchar(40) DEFAULT NULL,
  `service_provider_repair_quote_upload` varchar(40) DEFAULT NULL,
  `service_provider_repair_quote` text,
  `repair_requirement_note` text,
  `merchant_type` int DEFAULT NULL,
  `merchant_code` int DEFAULT NULL,
  `merchant_name` int DEFAULT NULL,
  `merchant_contacts_details` int DEFAULT NULL,
  `merchant_email_address` int DEFAULT NULL,
  `merchant_signature` varchar(40) DEFAULT NULL,
  `merchant_address` int DEFAULT NULL,
  `merchant_address_code` int DEFAULT NULL,
  `date_of_vehicle_send` datetime DEFAULT NULL,
  `authorization_number` int DEFAULT NULL,
  `instruction_note` int DEFAULT NULL,
  `work_allocation_reference_number` int DEFAULT NULL,
  `vehicle_registration_number` int DEFAULT NULL,
  `engine_number` int DEFAULT NULL,
  `make_of_vehicle` int DEFAULT NULL,
  `date_of_vehicle_received` datetime DEFAULT NULL,
  `mechanical_repair_progress_monitor` varchar(40) DEFAULT NULL,
  `mechanical_repair_progress_monitor_quality_of_work_manship` varchar(40) DEFAULT NULL,
  `vehicle_inspection_report` varchar(40) DEFAULT NULL,
  `upload_invoice` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`external_mechanical_id`),
  KEY `service_provider_name` (`service_provider_name`),
  KEY `service_provider_type` (`service_provider_type`),
  KEY `service_provider_contact_details` (`service_provider_contact_details`),
  KEY `service_provider_address` (`service_provider_address`),
  KEY `merchant_type` (`merchant_type`),
  KEY `merchant_code` (`merchant_code`),
  KEY `merchant_name` (`merchant_name`),
  KEY `merchant_contacts_details` (`merchant_contacts_details`),
  KEY `merchant_email_address` (`merchant_email_address`),
  KEY `merchant_address` (`merchant_address`),
  KEY `merchant_address_code` (`merchant_address_code`),
  KEY `authorization_number` (`authorization_number`),
  KEY `instruction_note` (`instruction_note`),
  KEY `work_allocation_reference_number` (`work_allocation_reference_number`),
  KEY `vehicle_registration_number` (`vehicle_registration_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

DROP TABLE IF EXISTS `forms`;
CREATE TABLE IF NOT EXISTS `forms` (
  `forms_id` int NOT NULL AUTO_INCREMENT,
  `government_motor_transport_handbook` varchar(40) DEFAULT NULL,
  `approved_workshop_procedure_manual` varchar(40) DEFAULT NULL,
  `vehicle_daily_check_list_and_appraisal_report` varchar(40) DEFAULT NULL,
  `z181_report_on_accident` varchar(40) DEFAULT NULL,
  `vehicle_handing_over_ckecklist` varchar(40) DEFAULT NULL,
  `vehicle_return_list` varchar(40) DEFAULT NULL,
  `indicates_and_list_details_of_damages_deficiencies` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`forms_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forms`
--

INSERT INTO `forms` (`forms_id`, `government_motor_transport_handbook`, `approved_workshop_procedure_manual`, `vehicle_daily_check_list_and_appraisal_report`, `z181_report_on_accident`, `vehicle_handing_over_ckecklist`, `vehicle_return_list`, `indicates_and_list_details_of_damages_deficiencies`) VALUES
(1, 'Government_Motor_Transport_Handbook.pdf', 'WORKSHOP_PROCEDURE_MANUAL.pdf', 'Vehicle_Check_List_Report.pdf', 'Z181_Report_on_Accident.PDF', 'Vehicle_Handing_Over_Ckecklist.pdf', 'Vehicle__Return_List.pdf', 'Indicates_and_list_details.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `fuel_type`
--

DROP TABLE IF EXISTS `fuel_type`;
CREATE TABLE IF NOT EXISTS `fuel_type` (
  `fuel_type_id` int NOT NULL AUTO_INCREMENT,
  `fuel_type` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`fuel_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fuel_type`
--

INSERT INTO `fuel_type` (`fuel_type_id`, `fuel_type`) VALUES
(1, 'Petrol - 93 Octaan'),
(2, 'Petrol - 95 Octaan'),
(3, 'Diesel'),
(4, 'Gasoline'),
(5, 'Ethanol'),
(6, 'Biodiesel'),
(7, 'Propane'),
(8, 'Hydrogen');

-- --------------------------------------------------------

--
-- Table structure for table `gate_security`
--

DROP TABLE IF EXISTS `gate_security`;
CREATE TABLE IF NOT EXISTS `gate_security` (
  `gate_security_user_id` int NOT NULL AUTO_INCREMENT,
  `gate_security_name_and_surname` varchar(40) DEFAULT NULL,
  `gate_security_contact_details` varchar(40) DEFAULT NULL,
  `gate_security_signature` varchar(40) DEFAULT NULL,
  `date_of_vehicle_entrance` datetime DEFAULT NULL,
  `vehicle_registration_number` int DEFAULT NULL,
  `engine_number` int DEFAULT NULL,
  `make_of_vehicle` int DEFAULT NULL,
  `vehicle_colour` int DEFAULT NULL,
  `vehicle_inspection` varchar(40) DEFAULT NULL,
  `vehicle_tires_size` varchar(40) DEFAULT NULL,
  `vehicle_tires_check` varchar(40) DEFAULT NULL,
  `vehicle_mirrow_check` varchar(40) DEFAULT NULL,
  `vehicle_interiour_condition` text,
  `vehicle_exteriour_condition` text,
  `gate_security_company_name` varchar(40) DEFAULT NULL,
  `gate_security_company_contact_details` varchar(40) DEFAULT NULL,
  `gate_security_manager_name_and_surname` varchar(40) DEFAULT NULL,
  `gate_security_manager_contact_details` varchar(40) DEFAULT NULL,
  `gate_security_company_address` text,
  `inspection_of_vehicle_report` varchar(40) DEFAULT NULL,
  `record_of_vehicle` varchar(40) DEFAULT NULL,
  `date_of_vehicle_exit` datetime DEFAULT NULL,
  PRIMARY KEY (`gate_security_user_id`),
  KEY `vehicle_registration_number` (`vehicle_registration_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `general_control_measures`
--

DROP TABLE IF EXISTS `general_control_measures`;
CREATE TABLE IF NOT EXISTS `general_control_measures` (
  `general_control_measures_id` int NOT NULL AUTO_INCREMENT,
  `government_garage_name` int DEFAULT NULL,
  `government_garage_section` varchar(40) DEFAULT NULL,
  `government_garage_manager_name_and_surname` varchar(40) DEFAULT NULL,
  `government_garage_manager_contact_details` varchar(40) DEFAULT NULL,
  `government_garage_manager_email_address` varchar(40) DEFAULT NULL,
  `government_garage_manager_signature` varchar(40) DEFAULT NULL,
  `government_garage_address` text,
  `government_garage_condition` varchar(40) DEFAULT NULL,
  `four_post_lift_condition` varchar(40) DEFAULT NULL,
  `low_level_lift_condition` varchar(40) DEFAULT NULL,
  `test_machines_conditions` varchar(40) DEFAULT NULL,
  `battery_testers_conditions` varchar(40) DEFAULT NULL,
  `chargers_conditions` varchar(40) DEFAULT NULL,
  `tools_conditions` int DEFAULT NULL,
  `hand_tools_conditions` int DEFAULT NULL,
  `equipment_conditions` varchar(40) DEFAULT NULL,
  `sectional_inspection` varchar(40) DEFAULT NULL,
  `district` int DEFAULT NULL,
  `location` int DEFAULT NULL,
  `cost_centre` int DEFAULT NULL,
  PRIMARY KEY (`general_control_measures_id`),
  KEY `district` (`district`),
  KEY `cost_centre` (`cost_centre`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `general_control_measures`
--

INSERT INTO `general_control_measures` (`general_control_measures_id`, `government_garage_name`, `government_garage_section`, `government_garage_manager_name_and_surname`, `government_garage_manager_contact_details`, `government_garage_manager_email_address`, `government_garage_manager_signature`, `government_garage_address`, `government_garage_condition`, `four_post_lift_condition`, `low_level_lift_condition`, `test_machines_conditions`, `battery_testers_conditions`, `chargers_conditions`, `tools_conditions`, `hand_tools_conditions`, `equipment_conditions`, `sectional_inspection`, `district`, `location`, `cost_centre`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, '<br>', 'Poor', 'Good', 'Good', 'Good', 'Broken', 'Good', 0, 0, 'Poor', 'Done Quaterly', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gmt_fleet_register`
--

DROP TABLE IF EXISTS `gmt_fleet_register`;
CREATE TABLE IF NOT EXISTS `gmt_fleet_register` (
  `fleet_asset_id` int NOT NULL AUTO_INCREMENT,
  `vehicle_registration_number` varchar(25) NOT NULL,
  `engine_number` varchar(35) NOT NULL,
  `chassis_number` varchar(35) NOT NULL,
  `dealer_name` int DEFAULT NULL,
  `make_of_vehicle` int DEFAULT NULL,
  `model_of_vehicle` varchar(45) DEFAULT NULL,
  `year_model_specification` int NOT NULL,
  `engine_capacity` varchar(40) DEFAULT NULL,
  `tyre_size` varchar(40) DEFAULT NULL,
  `transmission` int DEFAULT NULL,
  `fuel_type` int DEFAULT NULL,
  `type_of_vehicle` int NOT NULL,
  `colour_of_vehicle` int NOT NULL,
  `application_status` int NOT NULL,
  `barcode_number` varchar(35) DEFAULT NULL,
  `purchase_price` decimal(10,2) NOT NULL,
  `depreciation_value` varchar(40) DEFAULT NULL,
  `photo_of_vehicle` varchar(255) DEFAULT NULL,
  `user_name_and_surname` varchar(40) NOT NULL,
  `user_contact_email` varchar(40) NOT NULL,
  `contact_number` varchar(16) NOT NULL,
  `department_name` int NOT NULL,
  `department_address` text NOT NULL,
  `province` int NOT NULL,
  `district` int NOT NULL,
  `drivers_name_and_surname` int DEFAULT NULL,
  `drivers_persal_number` int DEFAULT NULL,
  `department_name_of_driver` int DEFAULT NULL,
  `drivers_contact_details` int DEFAULT NULL,
  `documents` varchar(225) DEFAULT NULL,
  `date_auctioned` date DEFAULT '0000-00-00',
  `comments` longtext,
  `renewal_of_license` date DEFAULT NULL,
  `mm_code` varchar(40) DEFAULT NULL,
  `dealer_type` varchar(40) DEFAULT NULL,
  `register_number` varchar(40) DEFAULT NULL,
  `case_number` varchar(40) DEFAULT 'CAS_',
  `venue` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`fleet_asset_id`),
  UNIQUE KEY `vehicle_registration_number_unique` (`vehicle_registration_number`),
  UNIQUE KEY `engine_number_unique` (`engine_number`),
  UNIQUE KEY `chassis_number_unique` (`chassis_number`),
  UNIQUE KEY `barcode_number_unique` (`barcode_number`),
  KEY `dealer_name` (`dealer_name`),
  KEY `make_of_vehicle` (`make_of_vehicle`),
  KEY `year_model_specification` (`year_model_specification`),
  KEY `transmission` (`transmission`),
  KEY `fuel_type` (`fuel_type`),
  KEY `type_of_vehicle` (`type_of_vehicle`),
  KEY `colour_of_vehicle` (`colour_of_vehicle`),
  KEY `application_status` (`application_status`),
  KEY `department_name` (`department_name`),
  KEY `province` (`province`),
  KEY `district` (`district`),
  KEY `drivers_name_and_surname` (`drivers_name_and_surname`),
  KEY `department_name_of_driver` (`department_name_of_driver`)
) ENGINE=MyISAM AUTO_INCREMENT=151 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gmt_fleet_register`
--

INSERT INTO `gmt_fleet_register` (`fleet_asset_id`, `vehicle_registration_number`, `engine_number`, `chassis_number`, `dealer_name`, `make_of_vehicle`, `model_of_vehicle`, `year_model_specification`, `engine_capacity`, `tyre_size`, `transmission`, `fuel_type`, `type_of_vehicle`, `colour_of_vehicle`, `application_status`, `barcode_number`, `purchase_price`, `depreciation_value`, `photo_of_vehicle`, `user_name_and_surname`, `user_contact_email`, `contact_number`, `department_name`, `department_address`, `province`, `district`, `drivers_name_and_surname`, `drivers_persal_number`, `department_name_of_driver`, `drivers_contact_details`, `documents`, `date_auctioned`, `comments`, `renewal_of_license`, `mm_code`, `dealer_type`, `register_number`, `case_number`, `venue`) VALUES
(1, 'DVS099L', '1ZRV653147', 'AHTLB52E003124753', 1, 1, 'COROLLA QUEST 1.6PLUS', 11, '1600', '14', 3, 2, 3, 22, 1, 'DVS', '212987.34', '212987.34', NULL, 'Thomas Lekgotloane', 'lekgotloanet@dtcs.limpopo.gov.za', '0152951000', 9, 'PRIVATE BAGX 9491<div>POLOKWANE<br></div><div>0700</div>', 1, 3, 2, 2, 9, 2, 'GMT_Vehicle_issue_form-_GMT4-004.pdf', NULL, '<br>', '0000-00-00', NULL, '1', NULL, 'CAS_', NULL),
(2, 'DVS102L', '1ZRV642146', 'AHTLB52E903124753', 1, 1, 'COROLLA QUEST 1.6PLUS', 11, '1600', '14', 3, 1, 3, 2, 1, 'dvs102', '212987.34', NULL, NULL, 'Lekgothoane LT', 'LekgothoaneT@dtcs.limpopo.gov.za', '+10152951000', 9, '<div>Private BagX9491</div><div>Polokwane</div><div>0699<br></div>', 1, 3, 2, 2, 9, 2, NULL, NULL, '<br>', '2021-01-31', NULL, '1', NULL, 'CAS_', NULL),
(3, '001DTNL', 'WRM4L13012', 'MA1TB2WR2N2011081', 8, 8, 'SCORPIO SUV 2.2 MHWAK 2WD', 16, '2.2', '18', 3, 3, 12, 22, 1, '001DTNL', '305.00', '305305.55', NULL, 'THOMAS LEKGOTHOANE', 'LekgothoaneT@dtcs.limpopo.gov.za', '0152951000', 9, 'Private BagX9491,&nbsp;<div>POLOKWANE,&nbsp;</div><div>0699</div>', 1, 4, 2, 2, 9, 2, NULL, NULL, '<br>', '2022-05-01', NULL, NULL, NULL, 'CAS_', NULL),
(4, '005DTNL', '65195035472222', 'W1V44770323931436', 6, 6, 'Vito 116 CDI Tourer PRO F', 16, '1.6', '18', 1, 3, 12, 22, 1, '\'005dtn', '778.00', '778,200.00', NULL, 'THOMAS LEKGOTHOANE', '\'0152951000', '0152951000', 9, 'Private BagX9491,&nbsp;<div>POLOKWANE,&nbsp;</div><div>0699</div>', 1, 4, 2, 2, NULL, 2, NULL, NULL, '<br>', '2023-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(5, '007DTNL', 'CLS777403', 'WVWZZZ60ZLT064220', 2, 2, 'POLO VIVO 1.6S', 15, '1600', '14', 3, 2, 3, 22, 1, '\'000', '207144.33', '207144.33', NULL, 'THOMAS LEKGOTHOANE', '\'0152951000', '+0152951000', 9, 'Private BagX9491,&nbsp;<div>POLOKWANE,&nbsp;</div><div>0699</div>', 1, 4, 2, 2, NULL, 2, NULL, NULL, '<br>', '2023-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(6, '011DTNL', 'HR15762929D', 'MDHBBAN17Z0707210', 3, 3, 'ALMERA 1.5 ACENTA', 9, '1500', '14', 1, 2, 3, 13, 1, '\'02022328', '192610.09', '192610.09', NULL, 'THOMAS LEKGOTHOANE', 'LekgothoaneT@dtcs.limpopo.gov.za', '+10152951000', 9, 'Private BagX9491,&nbsp;<div>POLOKWANE,&nbsp;</div><div>0699</div>', 1, 4, 2, 2, NULL, 2, NULL, NULL, '<br>', '0000-00-00', NULL, NULL, NULL, 'CAS_', NULL),
(7, '015DTNL', 'CLS095403', 'AAVZZZ6SZCU006723', 2, 2, 'POLO VIVO 1.6S', 8, '1600', '14', 3, 2, 3, 13, 1, '\'01930709', '131.00', NULL, NULL, 'THOMAS LEKGOTHOANE', '\'0152951000', '+10152951000', 9, 'Private BagX9491,<div>POLOKWANE</div><div>0699</div>', 1, 4, 2, 2, NULL, 2, NULL, NULL, '<br>', '2023-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(8, '017DTNL', 'CLS206090', 'AAVZZZ6SZFU018824', 2, 2, 'POLO VIVO 1.6S', 8, '1600', '14', 3, 2, 3, 13, 1, '\'02015699', '129188.84', NULL, NULL, 'THOMAS LEKGOTHOANE', 'LekgothoaneT@dtcs.limpopo.gov.za', '\'0152951000', 9, 'Private BagX9491,<div>POLOKWANE,</div><div>0699</div>', 1, 4, 2, 2, NULL, 2, NULL, NULL, '<br>', '0000-00-00', NULL, NULL, NULL, 'CAS_', NULL),
(9, '018DTNL', 'CLS206085', 'AAVZZZ6SZFU018808', 2, 2, 'POLO VIVO 1.6S', 8, '1600', '14', 3, 2, 3, 13, 1, '\'02015690', '129188.84', '129188.84', NULL, 'THOMAS LEKGOTHOANE', 'LekgothoaneT@dtcs.limpopo.gov.za', '+10152951000', 9, 'Private BagX9491,<div>POLOKWANE</div><div>0699</div>', 1, 4, 2, 2, NULL, 2, NULL, NULL, '<br>', '2023-05-31', NULL, NULL, NULL, 'CAS_', NULL),
(10, '020DTNL', '1ZRW265595', 'AHTLB52E903146394', 1, 1, 'COROLLA QUEST 1.6PLUS', 14, '1600', '14', 3, 2, 3, 22, 1, '020DT', '233821.45', NULL, NULL, 'THOMAS LEKGOTHOANE', 'LekgothoaneT@dtcs.limpopo.gov.za', '+10152951000', 9, 'Private BagX9491,&nbsp;<div>POLOKWANE</div><div>0699</div>', 1, 4, 2, 2, NULL, 2, NULL, NULL, '<br>', '0000-00-00', NULL, NULL, NULL, 'CAS_', NULL),
(11, 'DNT429L', '\'643000000000', 'WDC1660242A790881', 6, 6, 'ML350', 10, '350', '21', 1, 3, 12, 3, 1, '\'01628568', '773102.96', NULL, NULL, 'THOMAS LEKGOTHOANE', 'LekgothoaneT@dtcs.limpopo.gov.za', '+10152951000', 9, 'Private BagX9491,<div>POLOKWANE</div><div>0699</div>', 1, 3, 2, 2, NULL, 2, NULL, NULL, '<br>', '0000-00-00', NULL, NULL, NULL, 'CAS_', NULL),
(12, 'GTB745L', 'CLS138707', 'AAVZZZ6SZDU009776', 2, 2, 'polo vivo 1.6s', 7, '1.6', '14', 3, 2, 3, 22, 1, '1930442', '0.00', 'R126 415.74', NULL, 'Sekatane Dikotse', 'sekataneD@dtcs.limpopo.gav.za', '014 718 2300', 9, 'private bag x 1038&nbsp;<div>Nylstroom</div><div>0150</div>', 1, 86, 2, 2, 9, 2, NULL, NULL, 'no Auction', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(13, 'GTB756L', 'CLS139418', 'AAVZZZ6SZDU009779', 2, 2, 'polo vivo 1.6s', 7, '1.6', '14', 3, 2, 3, 22, 1, '1930444', '0.00', 'R126 415.74', NULL, 'Sekatane Dikotse', 'sekataneD@dtcs.limpopo.gav.za', '0147182300', 9, 'Private bag x1038<div>Nylstroom</div><div>0510</div>', 1, 94, 2, 2, 9, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(14, 'FCR913L', '64282642103958', 'WDC1660242B183911', 6, 6, 'GLE 350D (WI66) ZA', 13, '350', '21', 1, 3, 12, 2, 1, 'FCR913', '1.00', NULL, NULL, 'THOMAS LEKGOTHOANE', 'LekgothoaneT@dtcs.limpopo.gov.za', '+10152951000', 9, 'Private BagX9491,&nbsp;<div>POLOKWANE</div><div>0699</div>', 1, 4, 2, 2, NULL, 2, NULL, NULL, '<br>', '2023-05-31', NULL, NULL, NULL, 'CAS_', NULL),
(15, 'GBB205L', 'MB01012SA012564K', 'ODA116104177', 1, 1, 'DA 116 7 TON', 1, '5000', '22', 3, 3, 11, 22, 1, '\'02023987', '156990.54', NULL, NULL, 'Lekgothoane LT', 'LekgothoaneT@dtcs.limpopo.gov.za', '+10152951000', 9, 'Private BagX9491<div>POLOKWANE</div><div>0699</div>', 1, 2, 2, 2, NULL, 2, NULL, NULL, '<br>', '0000-00-00', NULL, NULL, NULL, 'CAS_', NULL),
(16, 'GBB229L', '814043544004010910', 'ZCFC359000D254105', 6, 6, 'IVECO', 20, '2500', '18', 3, 3, 8, 13, 1, '\'00882059', '233500.86', NULL, NULL, 'Lekgothoane LT', 'LekgothoaneT@dtcs.limpopo.gov.za', '+10152951000', 9, 'Private BagX9491,&nbsp;<div>POLOKWANE</div><div>0699</div>', 1, 3, 2, 2, NULL, 2, NULL, NULL, '<br>', '2023-07-30', NULL, NULL, NULL, 'CAS_', NULL),
(17, 'GBB234L', 'FE6226220C', 'PKF210N07718', 3, 3, 'UD90 BUS 60 SEATER', 1, '5000', '22', 3, 3, 16, 22, 1, '\'01458240', '856.00', NULL, NULL, 'THOMAS LEKGOTHOANE', 'LekgothoaneT@dtcs.limpopo.gov.za', '+10152951000', 9, 'Private BagX9491<div>POLOKWANE</div><div>0699</div>', 1, 2, 2, 2, NULL, 2, NULL, NULL, '<br>', '0000-00-00', NULL, NULL, NULL, 'CAS_', NULL),
(18, 'GBB235L', 'FE6226327C', 'ADDT68000007719', 3, 3, 'UD90 BUS 60 SEATER', 1, '5000', '22', 3, 3, 16, 22, 1, '\'01458242', '856798.64', NULL, NULL, 'THOMAS LEKGOTHOANE', 'LekgothoaneT@dtcs.limpopo.gov.za', '+10152951000', 9, 'Private BagX9491,<div>POLOKWANE</div><div>0699</div>', 1, 2, 2, 2, NULL, 2, NULL, NULL, '<br>', '2023-05-31', NULL, NULL, NULL, 'CAS_', NULL),
(19, 'GBB236L', '64299241042722', 'WDB90666572S514393', 6, 9, 'Sprinter 518XL', 5, '518', '19', 3, 3, 16, 22, 1, '\'01929029', '546.00', NULL, NULL, 'THOMAS LEKGOTHOANE', 'LekgothoaneT@dtcs.limpopo.gov.za', '+10152951000', 9, 'Private BagX9491,<div>POLOKWANE</div><div>0699</div>', 1, 1, 2, 2, NULL, 2, NULL, NULL, '<br>', '2023-07-31', NULL, NULL, NULL, 'CAS_', NULL),
(20, 'GBB237L', '1ZRU569950', 'ADTLB56E103077047', 1, 1, 'COROLLA 1.6P ADV 4A', 6, '1600', '14', 3, 2, 3, 22, 1, '\'01930446', '182206.34', NULL, NULL, 'Lekgothoane LT', 'LekgothoaneT@dtcs.limpopo.gov.za', '+10152951000', 9, 'Private BagX9491<div>POLOKWANE</div><div>0699</div>', 1, 1, 2, 2, NULL, 2, NULL, NULL, '<br>', '0000-00-00', NULL, NULL, NULL, 'CAS_', NULL),
(21, 'GSB028L', '1ZZ4394247', 'AHTLB58EC206520184', 1, 1, 'COROLLA 1.8P ADV 4A', 6, '1800', '14', 3, 2, 3, 13, 1, '00853631', '0.00', NULL, NULL, 'Lekgothoane LT', 'LekgothoaneT@dtcs.limpopo.gov.za', '+10152951000', 9, 'Private Bag X9491<div>POLOKWANE&nbsp;</div><div>0699</div>', 1, 1, 2, 2, NULL, 2, NULL, NULL, '<br>', '2023-01-31', NULL, NULL, NULL, 'CAS_', NULL),
(22, 'GTB759L', 'F16D4411529KA', 'KL1F69E9DK066612', 10, 10, 'CRUZE 1.6LS', 7, '1.6', '15', 3, 2, 3, 22, 1, '1930455', '0.00', 'R159 045.31', NULL, 'MOKONE EM', 'Mokonee@dtcs.limpopo.gov.za', '015 633 6706', 9, 'private bag x 61&nbsp;<div>Lebowakgomo</div><div>0737</div>', 1, 27, 2, 2, 9, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(23, 'GTB760L', 'F16D4411776KA', 'KL1F69E9DK066891', 10, 10, 'CRUZE 1.6LS', 7, '1.6', '15', 3, 2, 3, 22, 1, '1930448', '0.00', 'R159 045.31', NULL, 'MOKONE EM', 'Mokonee@dtcs.limpopo.gov.za', '0156336706', 9, 'Private bag x 61<div>Lebowakgomo</div><div>0737</div>', 1, 26, 2, 2, 9, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(24, 'GSB031L', '1TR6098964', 'AHTCW12G404002227', 1, 1, 'Hilux 2.0 4x2 SINGLE CAB', 1, '2000', '14', 3, 2, 17, 22, 1, '\'02056441', '165885.34', NULL, NULL, 'Mokone EM', 'MokoneE@dtcs.limpopo.gov.za', '\'0152951000', 9, 'Private BagX9491<div>POLOKWANE</div><div>0699</div>', 1, 1, 2, 2, NULL, 2, NULL, NULL, '<br>', '2023-07-30', NULL, NULL, NULL, 'CAS_', NULL),
(25, 'GTB761L', 'F16D4412158KA', 'KL1F69E9DK069074', 10, 10, 'CRUZE 1.6LS', 7, '1.6', '15', 3, 2, 3, 22, 1, '1930449', '0.00', 'R159 045.31', NULL, 'CHAUKE J ', 'Chaukej@dtcs.limpopo.gov', '015 8117000', 9, 'Private bag x 9671<div>Giyani</div><div>0826</div>', 1, 70, 2, 2, 9, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(26, 'GSB034L', '1ZRU557366', 'AHTLB58E403075595', 1, 1, 'COROLLA 1.6P ADV 4A', 6, '1600', '14', 3, 2, 3, 22, 1, '\'02056080', '165885.34', NULL, NULL, 'MOKONE EM', 'MokoneE@dtcs.limpopo.gov.za', '+10156336706', 9, 'Private BagX61,<div>LEBOWAKGOMO</div><div>0737</div>', 1, 18, 2, 2, NULL, 2, NULL, NULL, '<br>', '0000-00-00', NULL, NULL, NULL, 'CAS_', NULL),
(27, 'GTB762L', 'F16D4412754KA', 'KL1JF69E9DK068554', 10, 10, 'CRUZE 1.6LS', 7, '1.6', '15', 3, 2, 3, 22, 1, '1930450', '0.00', 'R159 045.31', NULL, 'CHAUKE J', 'Chaukej@dtcs.limpopo.gov', '0158117000', 9, 'Private bag x 9671<div>Giyani</div><div>0826</div>', 1, 46, 2, 2, 9, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(28, 'GTB860L', 'UEKDGE12601', 'MAJFXXMTKFGE12601', 4, 4, 'FIGO 4DR', 11, '1498', '14', 3, 1, 4, 24, 1, '02038130', '150.00', NULL, NULL, 'MOKOENA R.J', 'mokoenar&dtcs.limpopo.gov.za', '(015) 633 6691', 9, 'Private bag x51<div>&nbsp;Lebowakgomo</div><div>0731</div>', 1, 5, 2, 2, 9, 2, NULL, NULL, '<br>', NULL, NULL, NULL, NULL, 'CAS_', NULL),
(29, 'GSB035L', '1ZRU5575333', 'AHTLB58E403075600', 1, 1, 'COROLLA 1.6P ADV 4A', 6, '1600', '14', 3, 2, 3, 22, 1, '\'02056079', '165885.34', NULL, NULL, 'CHAUKE MASINDI JOEL', 'ChaukeM@dtcs.limpopo.gov.za', '0158117000', 9, 'Private BagX9671,<div>Giyani</div><div>0826</div>', 1, 46, 2, 2, NULL, 2, NULL, NULL, '<br>', '0000-00-00', NULL, NULL, NULL, 'CAS_', NULL),
(30, 'GSB036L', '1NR0602938', 'AHTLB58E306045404', 1, 1, 'COROLLA 1.6P ADV 4A', 7, '1600', '14', 3, 2, 3, 22, 1, '\'02056231', '175334.83', NULL, NULL, 'SEKATANE DIKOTSI', 'SekataneD@dtcs.limpopo.gov.za', '\'0147182300', 9, 'Private BagX1038<div>Nylstroom</div><div>0510</div>', 1, 79, 2, 2, NULL, 2, NULL, NULL, '<br>', '2023-05-30', NULL, NULL, NULL, 'CAS_', NULL),
(31, 'GSB037L', '1NR0603688', 'AHTLT58E20604588', 1, 1, 'COROLLA 1.6P ADV 4A', 7, '1600', '14', 3, 2, 3, 22, 1, '\'02056232', '175334.83', NULL, NULL, 'MAPHISWANE THIXEDZWI', 'MaphiswaneT@dtcs.limpopo.gov.za', '\'0159625081', 9, 'Private BagX2145<div>SIBASA</div><div>0970</div>', 1, 32, 2, 2, NULL, 2, NULL, NULL, '<br>', '2023-07-31', NULL, NULL, NULL, 'CAS_', NULL),
(32, 'GTB861L', 'UEKDGY31822', 'MAJFXXMTKFGY31822', 4, 4, 'FIGO 4DR', 11, '1498CC', '14', 3, 1, 3, 24, 1, '02038131', '150.00', NULL, NULL, 'MOKONE E.M', 'mokonem@dtcs.limpopo.gov.za', '(015) 633 5157', 9, 'Private bag x61<div>Lebowakgomo 0737</div>', 1, 18, 2, 2, 9, 2, NULL, NULL, '<br>', NULL, NULL, NULL, NULL, 'CAS_', NULL),
(33, 'GSB038L', '1TR7579749', 'AHTCW12G304051430', 1, 1, 'COROLLA 1.3P PROF', 7, '1300', '14', 3, 2, 3, 22, 1, '\'02056260', '184140.19', NULL, NULL, 'Lekgothoane LT', 'LekgothoaneT@dtcs.limpopo.gov.za', '+10152951000', 9, 'Private BagX9491,&nbsp;<div>POLOKWANE</div><div>0699</div>', 1, 1, 2, 2, NULL, 2, NULL, NULL, '<br>', '2023-06-30', NULL, NULL, NULL, 'CAS_', NULL),
(34, 'GTB764L', 'F16D4400653KA', 'KL1JF69E9DK052594', 10, 10, 'CRUZE 1.6LS', 7, '1.6', '15', 3, 2, 3, 22, 1, '1930452', '0.00', 'R159 045.31', NULL, 'Sekatane Dikotse', 'sekataneD@dtcs.limpopo.gav.za', '+10147182300', 9, 'Private bag x 1038<div>Nylstroom</div><div>0510</div>', 1, 98, 2, 2, 9, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(35, 'GTB765L', 'F16D4411707KA', 'KL1JF69E9DK067166', 10, 10, 'CRUZE 1.6LS', 7, '1.6', '15', 3, 2, 3, 22, 1, '1930453', '0.00', 'R159 045.31', NULL, 'Sekatane Dikotse', 'sekataneD@dtcs.limpopo.gav.za', '+10158117000', 9, 'Private bag x 1038<div>Nylstroom</div><div>1038</div>', 1, 91, 2, 2, 9, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(36, 'GTB862L', 'UEKDGY30454', 'MAJFXXMTKFGY30454', 4, 4, 'FIGO 4DR', 11, '1498CC', '14', 3, 1, 3, 24, 1, '02038132', '150.00', NULL, NULL, 'SEKATANE D.K', 'sekataned@dtcs.limpopo.gov.za', '(015) 718 2300', 13, 'Private bag x1038<div>Nylstroom</div><div>0510</div>', 1, 79, 2, 2, 13, 2, NULL, NULL, '<br>', NULL, NULL, NULL, NULL, 'CAS_', NULL),
(37, 'GTB766L', 'F16D4411514KA', 'KL1JF69E9DK066390', 10, 10, 'CRUZE 1.6LS', 7, '1.6', '15', 3, 2, 3, 22, 1, '1930456', '0.00', 'R159 045.31', NULL, 'RAVHELE TR', 'Ravhelet@dtcs.limpopo.gov.za', '015 9625081', 13, 'PRIVATE BAG X 2145<div>SIBASA</div><div>0970</div>', 1, 32, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(38, 'GSB039L', 'CLP171699', 'AAVZZ6RZEU21430', 2, 2, 'POLO VIVO 1.4TL', 8, '1400', '14', 3, 2, 3, 22, 1, '\'02056400', '268486.82', NULL, NULL, 'Lekgothoane LT', 'LekgothoaneT@dtcs.limpopo.gov.za', '+10147182300', 13, 'Private BagX9491<div>POLOKWANE</div><div>0699</div>', 1, 1, 2, 2, NULL, 2, NULL, NULL, '<br>', '2022-06-30', NULL, NULL, NULL, 'CAS_', NULL),
(39, 'GTB767L', 'F16D4400573KA', 'KL1JF69E9DK051559', 10, 10, 'CRUZE 1.6LS', 7, '1.6', '15', 3, 2, 3, 22, 1, '1930462', '0.00', 'R159 045.31', NULL, 'RAVHELE TR', 'Ravhelet@dtcs.limpopo.gov.za', '0159625081', 13, 'PRIVATE BAG X 2145<div>SIBASA</div><div>0970</div>', 1, 32, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(40, 'GSB040L', 'CLP172849', 'AAVZZZ6RZEU023301', 2, 2, 'POLO VIVO 1.4TL', 8, '1400', '14', 3, 2, 3, 22, 1, '\'02056091', '162742.71', NULL, NULL, 'Lekgothoane LT', 'LekgothoaneT@dtcs.limpopo.gov.za', '+10152951000', 13, 'Private BagX9491<div>POLOKWANE</div><div>0699</div>', 1, 1, 2, 2, NULL, 2, NULL, NULL, '<br>', '2023-07-31', NULL, NULL, NULL, 'CAS_', NULL),
(41, 'GTB768L', '2KDA212045', 'JTFSS23P400128434', 1, 1, 'QUANTUM 2.5D', 7, '2.5', '15', 3, 3, 8, 22, 1, '1930465', '0.00', NULL, NULL, 'Sekatane Dikotse', 'sekataneD@dtcs.limpopo.gav.za', '+10158117000', 13, 'PRAVITE BAG X 1038<div>NYLSTROOM</div><div>0510</div>', 1, 79, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(42, 'GTB863L', 'UEKDGY35021', 'MAJFXXMTKFGE35021', 4, 4, 'FIGO 4DR', 11, '1498CC', '14', 3, 1, 3, 24, 1, '02038133', '150.00', NULL, NULL, 'CHAUKE JOEL', 'chaukej@dtcs.limpopo.gov.za', '(015) 811 7000', 13, 'Private bag X9671<div>Giyani</div><div>0826</div>', 1, 46, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(43, 'GTB864L', 'UEKDGE10563', 'MAJFXXMTKFGE10563', 4, 4, 'FIGO 4DR', 11, '1498CC', '14', 3, 1, 3, 24, 1, '02038134', '150.00', NULL, NULL, 'RAVHELE T.R', 'ravhelet@dtcs.limpopo.gov.za', '(015) 962 5081', 13, 'Private bag X2145<div>Sibasa</div><div>0970</div>', 1, 32, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(44, 'GTB769L', '2KDA218926', 'JFTSS23P300128537', 1, 1, 'QUANTUM 2.5D GL', 7, '2.5D GL', '15', 3, 3, 8, 22, 1, '1930466', '0.00', NULL, NULL, 'CHAUKE J', 'Chaukej@dtcs.limpopo.gov', '+10158117000', 13, 'PRIVATE BAG X 9671<div>GIYANI</div><div>0826</div>', 1, 46, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(45, 'GTB770L', '2KDA221826', 'JTFSS23P400128594', 1, 1, 'QUANTUM 2.5D GL', 7, '2.5D GL', '15', 3, 3, 8, 22, 1, '1930464', '0.00', NULL, NULL, 'MOKONE EM', 'Mokonee@dtcs.limpopo.gov.za', '+10156336706', 13, 'PRAVITE BAG X 61<div>LEBOWAKGOMO</div><div>0737</div>', 1, 18, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(46, 'GSB041L', '2KDA649936', 'AHTFR22G806097387', 1, 1, 'HILUX 2.5D 4X4 SRX', 8, '2500', '17', 3, 3, 18, 22, 1, '\'02138462', '286486.82', NULL, NULL, 'Lekgothoane LT', 'LekgothoaneT@dtcs.limpopo.gov.za', '+10152951000', 13, 'Private BagX9491<div>POLOKWANE</div><div>0699</div>', 1, 1, 2, 2, NULL, 2, NULL, NULL, '<br>', '2023-08-31', NULL, NULL, NULL, 'CAS_', NULL),
(47, 'GTB866L', 'K14BN4132150', 'MA3EWB52S00655743', 11, 11, 'BALENO 1.4 GL MT', 14, '1498CC', '14', 3, 1, 4, 24, 1, '8000000', '0.00', NULL, NULL, 'Lekgothoane L.T', 'lekgothoanel@dtcs.limpopo.gov.za', '(015) 295 1000', 13, 'Private bag x9491<div>Polokwane</div><div>0700</div>', 1, 1, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(48, 'GTB771L', '2KDA198723', 'JTFSS23P900128235', 1, 1, 'QUANTUM 2.5D GL', 7, '2.5', '15', 3, 3, 8, 22, 1, '1930463', '0.00', NULL, NULL, 'MOKWENA RJ', 'MOKWENAR@DTCS.LIMPOPO.GOV.ZA', '015 633 6691', 13, 'PRIVATE BAG X 51<div>CHUENUSPOORT</div><div>0745</div>', 1, 5, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(49, 'GTB867L', 'K14BN4131842', 'MA3EWB52S00654044', 11, 11, 'BALENO 1.4 GL MT', 14, '1498CC', '14', 3, 1, 4, 24, 1, '800000', '0.00', NULL, NULL, 'Lekgothoane L.T', 'lekgothoanel@dtcs.limpopo.gov.za', '(015) 295 1000', 13, 'Private bag X9491<div>Polokwane</div><div>0700</div>', 1, 1, 2, 2, 9, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(50, 'GTB772L', '2KDA208424', 'JTFSS23P900128364', 1, 1, 'QUANTUM 2.5D GL', 7, '2.5D GL', '15', 3, 3, 8, 22, 1, '1930467', '0.00', NULL, NULL, 'RAVHELE TR', 'Ravhelet@dtcs.limpopo.gov.za', '+10159625081', 13, 'PRIVATE BAG X 2145<div>SIBASA</div><div>0970</div>', 1, 32, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(51, 'GTB868L', 'HR15715776B', 'MDHBBAN17Z0730066', 3, 3, 'ALMERA 1.5 ACCENTA', 14, '1498CC', '16', 3, 1, 3, 13, 1, 'GTB868L', '0.00', NULL, NULL, 'Lekgothoane L.T', 'lekgothoanel@dtcs.limpopo.gov.za', '(015) 295 1000', 13, 'Private bag X9491<div>Polokwane</div><div>0700</div>', 1, 1, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(52, 'GTB773L', 'PF2KNDM0531', 'AFANXXMJ2NDM05314', 4, 4, 'RANGER2.2DXLM', 6, '2.2', '18', 3, 3, 18, 22, 1, '2015601', '0.00', NULL, NULL, 'LEKGOTHOANE LT', 'LEKGOTHOANEL@dtcs.limpopo.gov.za', '015 2951000', 13, 'PRIVATE BAG X 9491<div>POLOKWANE</div><div>0700</div>', 1, 1, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(53, 'GTB775L', 'EV2BPDG40143', 'AFAPXXMJ2PD40143', 4, 4, 'RANGER 2.5P XL 2WH', 7, '2.5', '18', 3, 2, 18, 22, 1, '1930468', '0.00', NULL, NULL, 'CHAUKE J', 'Chaukej@dtcs.limpopo.gov', '+10158117000', 13, 'PRIVATE BAG X 9671<div>GIYANI</div><div>0826</div>', 1, 51, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(54, 'GSB042L', '2KDA649923', 'AHTFR22G206097387', 1, 1, 'HILUX 2.5D 4X4 SRX', 8, '2500', '19', 3, 3, 18, 22, 1, '\'2056400', '286486.82', NULL, NULL, 'SEKATANE DIKOTSI', 'SekataneD@dtcs.limpopo.gov.za', '+10152951000', 13, 'Private BagX1038<div>MODIMOLLE</div><div>0510</div>', 1, 79, 2, 2, NULL, 2, NULL, NULL, '<br>', NULL, NULL, NULL, NULL, 'CAS_', NULL),
(55, 'GTB776L', 'EV2BPD40144', 'AFAPXXMJ2PDG40144', 4, 4, 'RANGER2.2L 4X2 XL', 7, '2.2', '18', 3, 3, 17, 22, 1, '1930469', '0.00', NULL, NULL, 'MOKONE EM', 'Mokonee@dtcs.limpopo.gov.za', '+10156336706', 13, 'PRIVATE BAG X 61<div>LEBOWAKGOMO</div><div>0737</div>', 1, 17, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(56, 'GTB777L', 'EV2BPDG40145', 'AFAPXXMJ2PG40145', 4, 4, 'RANGER 2.5P XL 2WH', 8, '2.5', '18', 3, 2, 17, 22, 1, '1930470', '0.00', NULL, NULL, 'LEKGOTHOANE LT', 'LEKGOTHOANEL@dtcs.limpopo.gov.za', '0152951000', 13, 'PRIVATE BAG X 9491<div>POLOKWANE</div><div>0700</div>', 1, 1, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(57, 'GSB043L', '2KDA584846', 'AHTFR22G406093661', 1, 1, 'HILUX 2.5D 4X4 SRX', 8, '2500', '18', 3, 3, 18, 22, 1, '\'02056397', '286486.82', NULL, NULL, 'SEKATANE DIKOTSI', 'SekataneD@dtcs.limpopo.gov.za', '+10152951000', 13, 'Private BagX1038<div>MODIMOLLE</div><div>0510</div>', 1, 79, 2, 2, NULL, 2, NULL, NULL, '<br>', '2023-05-30', NULL, NULL, NULL, 'CAS_', NULL),
(58, 'GSB044L', '2KDA584812', 'AHTFR22G606093659', 1, 1, 'HILUX 2.5D 4X4 SRX', 8, '2500', '18', 3, 3, 18, 22, 1, '\'02056399', '286486.82', NULL, NULL, 'MAPHISWANE THIXEDZWI', 'MaphiswaneT@dtcs.limpopo.gov.za', '+10159625081', 13, 'Private BagX2145<div>SIBASA</div><div>0970</div>', 1, 32, 2, 2, NULL, 2, NULL, NULL, '<br>', '2023-07-31', NULL, NULL, NULL, 'CAS_', NULL),
(59, 'GSB045L', 'NONE', 'AAWB107B16NC01283', 13, 12, 'CHALLENGER', 11, 'N/A', '14', 3, NULL, 15, 22, 1, '\'02138410', '29000.00', NULL, NULL, 'THOMAS LEKGOTHOANE', 'LekgothoaneT@dtcs.limpopo.gov.za', '+10152951000', 13, 'Private BagX9491<div>POLOKWANE</div><div>0699</div>', 1, 1, 2, 2, NULL, 2, NULL, NULL, '<br>', '0000-00-00', NULL, NULL, NULL, 'CAS_', NULL),
(60, 'GSB046L', '634', 'WDF44760323079449', 6, 6, 'VITO 116 CDI PANEL VAN', 11, '2.0', '16', 3, 3, 9, 22, 1, '\'02138408', '0.00', NULL, NULL, 'THOMAS LEKGOTHOANE', 'LekgothoaneT@dtcs.limpopo.gov.za', '+10152951000', 13, 'Private BagX9491<div>POLOKWANE</div><div>0699</div>', 1, 1, 2, 2, NULL, 2, NULL, NULL, '<br>', '0000-00-00', NULL, NULL, NULL, 'CAS_', NULL),
(61, 'GSB047L', 'CKT148658', 'WV1ZZZ2EZH602004', 2, 2, 'CRAFTER', 8, '350', '16', 3, 3, 8, 22, 1, '\'02138409', '574660.32', NULL, NULL, 'THOMAS LEKGOTHOANE', 'LekgothoaneT@dtcs.limpopo.gov.za', '+10152951000', 13, 'Private BagX9491<div>POLOKWANE</div>', 1, 1, 2, 2, NULL, 2, NULL, NULL, '<br>', '2023-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(62, 'GSB048L', 'CLP273811', 'WVWZZZ60ZHT135247', 2, 2, 'POLO VIVO 1.4TL', 11, '1400', '14', 3, 2, 3, 22, 1, '\'01238429', '199837.44', NULL, NULL, 'THOMAS LEKGOTHOANE', 'LekgothoaneT@dtcs.limpopo.gov.za', '+10152951000', 13, 'Private BagX9491<div>POLOKWANE</div><div>0699</div>', 1, 1, 2, 2, 13, 2, NULL, NULL, '<br>', '2023-08-31', NULL, NULL, NULL, 'CAS_', NULL),
(63, 'GTB051L', 'J0101SA088837A', 'ADN52800000043746', 3, 3, 'UG780XC/E BREAKDOWN', 1, '5000', '21', 3, 3, 19, 22, 1, '\'00436613', '0.00', NULL, NULL, 'SEKATANE DIKOTSI', 'SekataneD@dtcs.limpopo.gov.za', '+10147182300', 13, 'Private BagX1038<div>MODIMOLLE</div><div>0510</div>', 1, 87, 2, 2, NULL, 2, NULL, NULL, '<br>', '2022-10-31', NULL, NULL, NULL, 'CAS_', NULL),
(64, 'GTB056N', 'MJ01010SA088318A', 'ADN528000000043748', 3, 3, 'UG780XC/E BREAKDOWN', 1, '5000', '22', 3, 3, 19, 22, 1, '\'00400818', '0.00', NULL, NULL, 'CHAUKE MASINDI JOEL', 'ChaukeM@dtcs.limpopo.gov.za', '+10158117000', 13, 'Private BagX9671<div>Giyani</div><div>0826</div>', 1, 51, 2, 2, NULL, 2, NULL, NULL, '<br>', '2023-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(65, 'GTB778L', 'EV2BPD40146', 'AFAPXXMJ2PDG40146', 4, 4, 'QUANTUM 2.5 TD XL 4X2 ', 7, '2.5', '18', 3, 3, 18, 22, 1, '193047', '0.00', NULL, NULL, 'RAVHELE TR', 'Ravhelet@dtcs.limpopo.gov.za', '+10159625081', 13, 'PRIVATE BAG X 2145<div>SIBASA&nbsp;</div><div>0970</div>', 1, 32, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(66, 'GTB779L', 'EV2BPD40148', 'AFAPXXMJ2PDG40148', 4, 4, 'RANGER 2.5P XL 2WH', 7, '2.5', '18', 3, 2, 18, 22, 1, '1930472', '0.00', NULL, NULL, 'Sekatane Dikotse', 'sekataneD@dtcs.limpopo.gav.za', '+10147182300', 13, 'PRIVATE BAG X 1038<div>NYLSTROON</div><div>0510</div>', 1, 79, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(67, 'GTB059N', 'MJ01010SA088840A', 'ADN52800000043747', 3, 3, 'UG780XC/E BREAKDOWN', 1, '5000', '22', 3, 3, 19, 22, 1, '\'00052054', '0.00', NULL, NULL, 'MAPHISWANE THIXEDZWI', 'MaphiswaneT@dtcs.limpopo.gov.za', '+10159625081', 13, 'Private BagX2145<div>Sibasa</div><div>0970</div>', 1, 40, 2, 2, NULL, 2, NULL, NULL, '<br>', '2022-08-31', NULL, NULL, NULL, 'CAS_', NULL),
(68, 'GTB780L', 'EV2BPDG4014', 'AFAPXXMJ29DG40147', 4, 4, 'RANGER 2.5P XL 2WH', 7, '2.5', '18', 3, 2, 18, 22, 1, '1930473', '0.00', NULL, NULL, 'LEKGOTHOANE LT', 'LEKGOTHOANEL@dtcs.limpopo.gov.za', '+10152951000', 13, 'PRIVATE BAG X 9491<div>POLOKWANE</div><div>0700</div>', 1, 5, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(69, 'GTB784L', '2NRD062122', 'MBJB29BT300087870', 1, 1, 'ETIOS 1.5SX SD', 7, '1.5', '14', 3, 2, 3, 13, 1, '2015635', '0.00', NULL, NULL, 'LEKGOTHOANE LT', 'LEKGOTHOANEL@dtcs.limpopo.gov.za', '+10152951000', 13, 'PRIVATE BAG X 9491<div>POLOKWANE</div><div>0700</div>', 1, 1, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(70, 'GTB451L', 'TD27777765', 'ADNJ410000E000182', 3, 3, 'HARDBODY 2.7D 4X2 S/CAB', 1, '2700', '17', 3, 3, 17, 22, 1, '\'01009851', '97453.33', NULL, NULL, 'MAPHISWANE THIXEDZWI', 'MaphiswaneT@dtcs.limpopo.gov.za', '+10159625081', 13, 'Private BagX2145<div>SIBASA</div><div>0970</div>', 1, 40, 2, 2, NULL, 2, NULL, NULL, '<br>', NULL, NULL, NULL, NULL, 'CAS_', NULL),
(71, 'GTB785L', '2NRD061921', 'MBJB29BT800087783', 1, 1, 'ETIOS 1.5SX SD', 8, '1.5', '14', 3, 2, 3, 13, 1, '2015642', '0.00', NULL, NULL, 'LEKGOTHOANE LT', 'LEKGOTHOANEL@dtcs.limpopo.gov.za', '+10152951000', 13, 'PRIVATE BAG X 9491<div>POLOKWANE</div><div>0700</div>', 1, 1, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(72, 'GT457L', 'TD27774942', 'ADNJ410000E000258', 3, 3, 'HARDBODY 2.7D 4X2 S/CAB', 1, '2700', '17', 3, 3, 17, 13, 1, '\'01009853', '97453.33', NULL, NULL, 'SEKATANE DIKOTSI', 'SekataneD@dtcs.limpopo.gov.za', '+10147182300', 13, 'Private BagX1038<div>MODIMOLLE</div><div>0510</div>', 1, 98, 2, 2, NULL, 2, NULL, NULL, '<br>', '2022-08-31', NULL, NULL, NULL, 'CAS_', NULL),
(73, 'GTB786L', '2NRD062034', 'MBJB29BT600087734', 1, 1, 'ETIOS 1.5SX SD', 8, '1.5', '14', 3, 2, 3, 13, 1, '2015633', '0.00', NULL, NULL, 'LEKGOTHOANE LT', 'LEKGOTHOANEL@dtcs.limpopo.gov.za', '+10152951000', 13, 'PRIVATE BAG X 9491<div>POLOKWANE</div><div>0700</div>', 1, 1, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(74, 'GTB458L', 'TD27778436', 'ADNJ410000E000210', 3, 3, 'HARDBODY 2.7D 4X2 S/CAB', 1, '2700', '15', 3, 3, 17, 13, 1, '\'01009847', '97453.33', NULL, NULL, 'Mokone EM', 'MokoneE@dtcs.limpopo.gov.za', '+10156336706', 13, 'Private BagX61<div>Lebowakgomo</div><div>0737</div>', 1, 17, 2, 2, NULL, 2, NULL, NULL, '<br>', NULL, NULL, NULL, NULL, 'CAS_', NULL),
(75, 'GTB788L', '2NRD062089', 'MBJB29BT800087786', 1, 1, 'ETIOS 1.5SX SD', 8, '1.5', '14', 3, 2, 3, 13, 1, '2015638', '0.00', NULL, NULL, 'LEKGOTHOANE LT', 'LEKGOTHOANEL@dtcs.limpopo.gov.za', '+10152951000', 13, 'PRIVATE BAG X 9491<div>POLOKWANE&nbsp;</div><div>0700</div>', 1, 1, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(76, 'GTB461L', '3ZZE5E21958', 'AHT53ZEC107553376', 1, 1, 'COROLLA 160I GLE', 1, '1600', '14', 3, 2, 3, 22, 1, '\'01242364', '107169.82', NULL, NULL, 'MAPHISWANE THIXEDZWI', 'MaphiswaneT@dtcs.limpopo.gov.za', '+10159625081', 13, 'Private BagX2145<div>SIBASA</div><div>0970</div>', 1, 32, NULL, NULL, NULL, NULL, NULL, NULL, '<br>', NULL, NULL, NULL, NULL, 'CAS_', NULL),
(77, 'GTB790L', '2NRD062107', 'MBJB29BT600087815', 1, 1, 'ETIOS 1.5SX SD', 8, '1.5', '14', 3, 2, 3, 13, 1, '2015629', '0.00', NULL, NULL, 'LEKGOTHOANE LT', 'LEKGOTHOANEL@dtcs.limpopo.gov.za', '+10152951000', 13, 'PRIVATE BAG X 9491<div>POLOKWANE</div><div>0700</div>', 1, 1, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(78, 'GTB791L', '2NRD061857', 'MBJB29BT400087800', 1, 1, 'ETIOS 1.5SX SD', 8, '1.5', '14', 3, 2, 3, 13, 1, '2015643', '0.00', NULL, NULL, 'LEKGOTHOANE LT', 'LEKGOTHOANEL@dtcs.limpopo.gov.za', '+10152951000', 13, 'PRIVATE BAG X 9491<div>POLOKWANE&nbsp;</div><div>0700</div>', 1, 1, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(79, 'GTB792L', '2NRD06501', 'MBJB29BT800088027', 1, 1, 'ETIOS 1.5SX SD', 8, '1.5', '14', 3, 2, 3, 13, 1, '2015632', '0.00', NULL, NULL, 'LEKGOTHOANE LT', 'LEKGOTHOANEL@dtcs.limpopo.gov.za', '+10152951000', 13, 'PRIVATE BAG X 9491<div>POLOKWANE&nbsp;</div><div>0700</div>', 1, 1, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(80, 'GTB796L', '2NRD061840', 'MBJB29BTX00087686', 1, 1, 'ETIOS 1.5SX SD', 8, '1.5', '14', 3, 2, 3, 13, 1, '2015634', '0.00', NULL, NULL, 'LEKGOTHOANE LT', 'LEKGOTHOANEL@dtcs.limpopo.gov.za', '+10152951000', 13, 'PRIVATE BAG X 9491&nbsp;<div>POLOKWANE&nbsp;</div><div>0700</div>', 1, 1, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(81, 'GTB797L', '2NRD061908', 'MBJB29BT100087785', 1, 1, 'ETIOS 1.5SX SD', 8, '1.5', '14', 3, 2, 3, 13, 1, '2015637', '0.00', NULL, NULL, 'LEKGOTHOANE LT', 'LEKGOTHOANEL@dtcs.limpopo.gov.za', '+10152951000', 13, 'PRIVATE BAG X 9491&nbsp;<div>POLOKWANE</div><div>0700</div>', 1, 1, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(82, 'GTB798L', '2NRD061850', 'MBJB29BT600087796', 1, 1, 'ETIOS 1.5SX SD', 8, '1.5', '14', 3, 2, 3, 13, 1, '2015641', '0.00', NULL, NULL, 'LEKGOTHOANE LT', 'LEKGOTHOANEL@dtcs.limpopo.gov.za', '+10152951000', 13, 'PRIVATE BAG X 9491<div>POLOKWANE</div><div>0700</div>', 1, 1, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(83, 'GTB799L', 'CLP185334', 'AAVZZZ6SZEU028570', 2, 2, 'POLO VIVO 1.4S', 8, '1.4', '14', 3, 2, 3, 13, 1, '2015622', '0.00', NULL, NULL, 'LEKGOTHOANE LT', 'LEKGOTHOANEL@dtcs.limpopo.gov.za', '+10152951000', 13, 'PRIVATE BAG X 9491&nbsp;<div>POLOKWANE</div><div>0700</div>', 1, 1, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(84, 'GTB800L', 'CLP185658', 'AAVZZZ6SZEU028773', 2, 2, 'POLO VIVO 1.4S', 8, '1.4', '14', 3, 2, 3, 13, 1, '2015620', '0.00', NULL, NULL, 'LEKGOTHOANE LT', 'LEKGOTHOANEL@dtcs.limpopo.gov.za', '+10152951000', 13, 'PRIVATE BAG X 9491<div>POLOKWANE</div><div>0700</div>', 1, 1, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(85, 'GTB801L', 'CLP185661', 'AAVZZZ6SZEU028778', 2, 2, 'POLO VIVO 1.4S', 8, '1.4', '14', 3, 2, 3, 13, 1, '2015619', '0.00', NULL, NULL, 'LEKGOTHOANE LT', 'LEKGOTHOANEL@dtcs.limpopo.gov.za', '+10152951000', 13, 'PRIVATE BAG X 9491&nbsp;<div>POLOKWANE</div><div>0700</div>', 1, 1, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(86, 'GTB802L', 'CLP185660', 'AAVZZZ6SZEU028779', 2, 2, 'POLO VIVO 1.4S', 8, '1.4', '14', 3, 2, 3, 13, 1, '2015625', '0.00', NULL, NULL, 'LEKGOTHOANE LT', 'LEKGOTHOANEL@dtcs.limpopo.gov.za', '+10152951000', 13, 'PRIVATE BAG X 9491&nbsp;<div>POLOKWANE</div><div>0700</div>', 1, 1, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(87, 'GTB462L', '3ZZE522890', 'AHT53ZEC107553390', 1, 1, 'COROLLA 160I GLE', 1, '1600', '14', 3, 2, 3, 22, 1, '\'01242367', '107169.82', NULL, NULL, 'MAPHISWANE THIXEDZWI', 'MaphiswaneT@dtcs.limpopo.gov.za', '+10159625081', 13, 'Private BagX2145<div>SIBASA</div><div>0970</div>', 1, 32, 2, 2, NULL, 2, NULL, NULL, '<br>', NULL, NULL, NULL, NULL, 'CAS_', NULL),
(88, 'GTB803L', 'CLP185471', 'AAVZZZ6SZEU028791', 2, 2, 'POLO VIVO 1.4S', 8, '1.4', '14', 3, 2, 3, 13, 1, '2015613', '0.00', NULL, NULL, 'LEKGOTHOANE LT', 'LEKGOTHOANEL@dtcs.limpopo.gov.za', '+10152951000', 13, 'PRIVATE BAG X 9491<div>POLOKWANE</div><div>0700</div>', 1, 1, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(89, 'GTB467L', '3ZZE537345', 'AHT53ZEC107554470', 1, 1, 'COROLLA 160I GLE', 1, '1600', '14', 3, 2, 3, 22, 1, '\'01242372', '107169.82', NULL, NULL, 'MOKOENA R GERMINAH', 'MokoenaR@dtcs.limpopo.gov.za', '+10156336691', 13, 'Private BagX51<div>CHUENESPOORT</div><div>0745</div>', 1, 5, 2, 2, NULL, 2, NULL, NULL, '<br>', '2022-08-31', NULL, NULL, NULL, 'CAS_', NULL),
(90, 'GTB804L', 'CLP185467', 'AAVZZZ6SZEU028792', 2, 2, 'POLO VIVO 1.4S', 8, '1.4', '14', 3, 2, 3, 13, 1, '2015621', '0.00', NULL, NULL, 'LEKGOTHOANE LT', 'LEKGOTHOANEL@dtcs.limpopo.gov.za', '+10152951000', 13, 'PRIVATE BAG X 9491<div>POLOKWANE</div><div>0700</div>', 1, 1, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(91, 'GTB468L', '3ZZE527629', 'AHT53ZEC107554453', 1, 1, 'COROLLA 160I GLE', 1, '1600', '14', 3, 2, 3, 13, 1, '\'\'01242373', '107169.82', NULL, NULL, 'MOKOENA R GERMINAH', 'MokoenaR@dtcs.limpopo.gov.za', '+10156336691', 13, 'Private BagX51<div>Chuenespoort</div><div>0745</div>', 1, 5, 2, 2, NULL, 2, NULL, NULL, '<br>', '2022-08-31', NULL, NULL, NULL, 'CAS_', NULL),
(92, 'GTB805L', 'CLP185695', 'AAVZZZ6SZEU028796', 2, 2, 'POLO VIVO 1.4S', 8, '1.4', '14', 3, 2, 3, 13, 1, '2015614', '0.00', NULL, NULL, 'LEKGOTHOANE LT', 'LEKGOTHOANEL@dtcs.limpopo.gov.za', '+10152951000', 13, 'PRIVATE BAG X 9491&nbsp;<div>POLOKWANE</div><div>0700</div>', 1, 1, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(93, 'GTB806L', 'CLP185752', 'AAVZZZ6SZEU028591', 2, 2, 'POLO VIVO 1.4S', 8, '1.4', '14', 3, 2, 3, 13, 1, '2015626', '0.00', NULL, NULL, 'LEKGOTHOANE LT', 'LEKGOTHOANEL@dtcs.limpopo.gov.za', '+10152951000', 13, 'PRIVATE BAG X 9491<div>POLOKWANE</div><div>0700</div>', 1, 1, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(94, 'GTB870L', 'WRM4L13118', 'MA1TB2WR2N2011451', 8, 8, 'SCOPIO SUV 2.2 MHWAK 2WD', 16, '2199', '18', 3, 3, 5, 11, 1, 'GTB870L', '0.00', NULL, NULL, 'Lekgothoane L.T', 'lekgothoanel@dtcs.limpopo.gov.za', '(015) 295 1000', 13, 'Private bag X9491<div>Polokwane</div><div>0700</div>', 1, 1, 2, 2, 13, 2, NULL, NULL, '<br>', '2023-04-30', NULL, NULL, NULL, 'CAS_', NULL),
(95, 'GTB469L', '6130000', 'WDF9046632A951574', 6, 6, 'SPRINTER 416CDI', 1, '2500', '15', 3, 3, 9, 22, 1, '\'\'01242732', '369712.00', NULL, NULL, 'CHAUKE MASINDI JOEL', 'ChaukeM@dtcs.limpopo.gov.za', '+10158117000', 13, 'Private BagX9671<div>GIYANI</div><div>0826</div>', 1, 46, 2, 2, NULL, 2, NULL, NULL, '<br>', NULL, NULL, NULL, NULL, 'CAS_', NULL),
(96, 'GTB807L', 'CLP185629', 'AAVZZZ6SZEU028801', 2, 2, 'POLO VIVO 1.4S', 8, '1.4', '14', 3, 2, 3, 13, 1, '2015616', '0.00', NULL, NULL, 'LEKGOTHOANE LT', 'LEKGOTHOANEL@dtcs.limpopo.gov.za', '+10152951000', 13, 'PRIVATE BAG X 9491&nbsp;<div>POLOKWANE&nbsp;</div><div>0700</div>', 1, 1, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(97, 'GTB871L', 'WRM4L13115', 'MA1TB2WR2N2011478', 8, 8, 'SCOPIO SUV 2.2 MHWAK 2WD', 16, '2199', '18', 3, 3, 5, 16, 1, 'GTB871L', '0.00', NULL, NULL, 'Lekgothoane L.T', 'lekgothoanel@dtcs.limpopo.gov.za', '(015) 295 1000', 13, 'Private bag X9491<div>Polokwane</div><div>0700</div>', 1, 1, 2, 2, 13, 2, NULL, NULL, '<br>', '2023-04-30', NULL, NULL, NULL, 'CAS_', NULL),
(98, 'GTB808L', 'CLP185377', 'AAVZZZ6SZEU028609', 2, 2, 'POLO VIVO 1.4S', 8, '1.4', '14', 3, 2, 3, 13, 1, '2015623', '0.00', NULL, NULL, 'LEKGOTHOANE LT', 'LEKGOTHOANEL@dtcs.limpopo.gov.za', '+10152951000', 13, 'PRIVATE BAG X 9491<div>POLOKWANE</div><div>0700</div>', 1, 1, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(99, 'GTB809L', 'CLP186538', 'AAVZZZ6SZEU028804', 2, 2, 'POLO VIVO 1.4S', 8, '1.4', '14', 3, 2, 3, 13, 1, '2015624', '0.00', NULL, NULL, 'LEKGOTHOANE LT', 'LEKGOTHOANEL@dtcs.limpopo.gov.za', '+10152951000', 13, 'PRIVATE BAG X 9491<div>POLOKWANE</div><div>0700</div>', 1, 1, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(100, 'GTB872L', 'WRM4M15927', 'MA1TB2WR2N2015486', 8, 8, 'SCOPIO SUV 2.2 MHWAK 2WD', 16, '2199', '18', 3, 3, 5, 24, 1, 'GTB872L', '0.00', NULL, NULL, 'Lekgothoane L.T', 'lekgothoanel@dtcs.limpopo.gov.za', '(015) 295 1000', 13, 'Private bag X9491<div>Polokwane</div><div>0700</div>', 1, 1, 2, 2, 13, 2, NULL, NULL, '<br>', '2023-04-30', NULL, NULL, NULL, 'CAS_', NULL),
(101, 'GTB810L', 'CLP185630', 'AAVZZZ6SZEU028807', 2, 2, 'POLO VIVO 1.4S', 8, '1.4', '14', 3, 2, 3, 13, 1, '2015618', '0.00', NULL, NULL, 'LEKGOTHOANE LT', 'LEKGOTHOANEL@dtcs.limpopo.gov.za', '+10152951000', 13, 'PRIVATE BAG X 9491<div>POLOKWANE</div><div>0700</div>', 1, 1, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(102, 'GTB811L', 'CLP185674', 'AAVZZZ6SZEU028816', 2, 2, 'POLO VIVO 1.4S', 8, '1.4', '14', 3, 2, 3, 13, 1, '2015617', '0.00', NULL, NULL, 'LEKGOTHOANE LT', 'LEKGOTHOANEL@dtcs.limpopo.gov.za', '+10152951000', 13, 'PRIVATE BAG X 9491<div>POLOKWANE</div><div>0700</div>', 1, 1, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(103, 'GTB873L', 'WRM4L13013', 'MA1TB2WR2N2011498', 8, 8, 'SCOPIO SUV 2.2 MHWAK 2WD', 16, '2199', '18', 3, 3, 5, 17, 1, 'GTB873L', '0.00', NULL, NULL, 'MOKOENA R.J', 'mokoenar&dtcs.limpopo.gov.za', '(015) 633 6691', 13, 'Private bag X61<div>Lebowakgomo</div><div>0737</div>', 1, 5, 2, 2, 13, 2, NULL, NULL, '<br>', '2023-04-30', NULL, NULL, NULL, 'CAS_', NULL),
(104, 'GTB812L', 'CLP185686', 'AAVZZZ6SZEU028824', 2, 2, 'POLO VIVO 1.4S', 8, '1.4', '14', 3, 2, 3, 13, 1, '2015615', '0.00', NULL, NULL, 'LEKGOTHOANE LT', 'LEKGOTHOANEL@dtcs.limpopo.gov.za', '+10152951000', 13, 'PRIVATE BAG&nbsp; X 9491<div>POLOKWANE</div><div>0700</div>', 1, 1, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(105, 'GTB813L', 'CLP185683', 'AAVZZZ6SZEU02885', 2, 2, 'POLO VIVO 1.4S', 8, '1.4', '14', 3, 2, 3, 13, 1, '2015628', '0.00', NULL, NULL, 'LEKGOTHOANE LT', 'LEKGOTHOANEL@dtcs.limpopo.gov.za', '+10152951000', 13, 'PRIVATE BAG X 9491<div>POLOKWANE</div><div>0700</div>', 1, 1, 2, 2, 13, 2, NULL, NULL, 'PRIVATE BAG X 9491<div>POLOKWANE</div><div>0700</div>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(106, 'GTB814L', '1NR0675592', 'AHTBOJE500002095', 1, 1, 'COROLLA 1.3 ESTEEM', 8, '1.3', '14', 3, 2, 3, 13, 1, '2015648', '0.00', NULL, NULL, 'MOKWENA RJ', 'MOKWENAR@DTCS.LIMPOPO.GOV.ZA', '0156336691', 13, 'PRIVATE BAG X 51<div>CHUENESPOORT</div><div>0745</div>', 1, 5, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(107, 'GTB815L', '1NR0686942', 'AHTBTOJE500002100', 1, 1, 'COROLLA 1.3 ESTEEM', 8, '1.3', '14', 3, 2, 3, 13, 1, '2015659', '0.00', NULL, NULL, 'MOKWENA RJ', 'MOKWENAR@DTCS.LIMPOPO.GOV.ZA', '0156336691', 13, 'PRIVATE BAGX51<div>CHUENESPOORT&nbsp;</div><div>0745</div>', 1, 5, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(108, 'GTB874L', 'WRM4L13010', 'MA1TB2WR2N2011677', 8, 8, 'SCOPIO SUV 2.2 MHWAK 2WD', 16, '2199', '18', 3, 3, 5, 17, 1, 'GTB874L', '0.00', NULL, NULL, 'MOKOENA R.J', 'mokoenar&dtcs.limpopo.gov.za', '(015) 633 6691', 13, 'Private bag X61<div>Lebowakgomo</div><div>0737</div>', 1, 5, 2, 2, 13, 2, NULL, NULL, '<br>', '2023-04-30', NULL, NULL, NULL, 'CAS_', NULL),
(109, 'GTB875L', 'WRM4L13122', 'MA1TB2WR2N2011804', 8, 8, 'SCOPIO SUV 2.2 MHWAK 2WD', 16, '2199', '18', 3, 3, 5, 17, 1, 'GTB875L', '0.00', NULL, NULL, 'MOKOENA R.J', 'mokoenar&dtcs.limpopo.gov.za', '(015) 633 6691', 13, 'Private bag X61<div>Lebowakgomo</div><div>0737</div>', 1, 5, 2, 2, 13, 2, NULL, NULL, '<br>', '2023-04-30', NULL, NULL, NULL, 'CAS_', NULL),
(110, 'GTB816L', '1NR0686923', 'AHTBTOJE900002102', 1, 1, 'COROLLA 1.3 ESTEEM', 8, '1.3', '14', 3, 2, 3, 13, 1, '2015664', '0.00', NULL, NULL, 'MOKWENA RJ', 'MOKWENAR@DTCS.LIMPOPO.GOV.ZA', '0156336691', 13, 'PRIVATE BAG X 51<div>CHUENESPOORT&nbsp;</div><div>0745</div>', 1, 5, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(111, 'GTB876L', 'WRM4L15540', 'MA1TB2WR2N2015466', 8, 8, 'SCOPIO SUV 2.2 MHWAK 2WD', 16, '2199', '18', 3, 3, 5, 24, 1, 'GTB876L', '0.00', NULL, NULL, 'MOKOENA R.J', 'mokoenar&dtcs.limpopo.gov.za', '(015) 633 6691', 13, 'Private bag X61<div>Lebowakgomo</div><div>0737</div>', 1, 5, 2, 2, 13, 2, NULL, NULL, '<br>', NULL, NULL, NULL, NULL, 'CAS_', NULL),
(112, 'GTB475L', 'N307023954', 'AFADXXMJDD6M06084', 4, 4, 'FOCUS 2.0 SI 5DR MANUAL', 1, '2000', '16', 3, 2, 1, 3, 1, '\'01242750', '157568.52', NULL, NULL, 'Lekgothoane LT', 'LekgothoaneT@dtcs.limpopo.gov.za', '+10152951000', 13, 'Private BagX9491<div>POLOKWANE</div><div>0699</div>', 1, 1, 2, 2, NULL, 2, NULL, NULL, '<br>', NULL, NULL, NULL, NULL, 'CAS_', NULL),
(113, 'GTB817L', '1NR0686938', 'AHTBTOJE0002103', 1, 1, 'COROLLA 1.3 ESTEEM', 8, '1.3', '14', 3, 2, 3, 13, 1, '2015649', '0.00', NULL, NULL, 'MOKWENA RJ', 'MOKWENAR@DTCS.LIMPOPO.GOV.ZA', '0156336691', 13, 'PRIVATE BAG X 51<div>CHUENESPOORT</div><div>0745</div>', 1, 6, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(114, 'GTB477L', 'C307025644', 'AFADXXMJDD6P04351', 4, 4, 'FOCUS 2.0 SI 5DR MANUAL', 1, '2000', '16', 3, 2, 1, 3, 1, '\'01242758', '157568.52', NULL, NULL, 'MOKOENA R GERMINAH', 'MokoenaR@dtcs.limpopo.gov.za', '+10156336691', 13, 'Private BagX61<div>CHUENESPOORT</div><div>0745</div>', 1, 5, 2, 2, NULL, 2, NULL, NULL, '<br>', NULL, NULL, NULL, NULL, 'CAS_', NULL),
(115, 'GTB818L', '1NR0684195', 'AHTBTOJE400002118', 1, 1, 'COROLLA 1.3 ESTEEM', 8, '1.3', '14', 3, 2, 3, 13, 1, '2015661', '0.00', NULL, NULL, 'MOKONE EM', 'Mokonee@dtcs.limpopo.gov.za', '0156336691', 13, 'PRIVATE BAG X61<div>LEBOWAKGOMO</div><div>0737</div>', 1, 17, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(116, 'GTB877L', 'WRM4L1928', 'MA1TB2WR2N2015468', 8, 8, 'SCOPIO SUV 2.2 MHWAK 2WD', 16, '2199', '18', 3, 3, 5, 24, 1, 'GTB877L', '0.00', NULL, NULL, 'CHAUKE JOEL', 'chaukej@dtcs.limpopo.gov.za', '(015) 811 7000', 13, 'Private bag X9671<div>Giyani</div><div>0826</div>', 1, 46, 2, 2, 13, 2, NULL, NULL, '<br>', '2023-04-30', NULL, NULL, NULL, 'CAS_', NULL),
(117, 'GTB878L', 'WRM4L15793', 'MA1TB2WR2N2015474', 8, 8, 'SCOPIO SUV 2.2 MHWAK 2WD', 16, '2199', '18', 3, 3, 5, 24, 1, 'GTB878L', '0.00', NULL, NULL, 'CHAUKE JOEL', 'chaukej@dtcs.limpopo.gov.za', '(015) 811 7000', 13, 'Private bag X9671<div>Giyani</div><div>0826</div>', 1, 46, 2, 2, 13, 2, NULL, NULL, '<br>', '2023-04-30', NULL, NULL, NULL, 'CAS_', NULL),
(118, 'GTB879L', 'WRM4L15545', 'MA1TB2WR2N2015481', 8, 8, 'SCOPIO SUV 2.2 MHWAK 2WD', 16, '2199cm', '18', 3, 3, 5, 24, 1, 'GTB879L', '0.00', NULL, NULL, 'CHAUKE JOEL', 'chaukej@dtcs.limpopo.gov.za', '(015) 811 7000', 13, 'Private bag x9671<div>Giyani</div><div>0826</div>', 1, 46, 2, 2, 13, 2, NULL, NULL, '<br>', '2023-04-30', NULL, NULL, NULL, 'CAS_', NULL),
(119, 'GTB479L', 'MR18044969A', 'ADNH340000A000264', 3, 3, 'TIIDA 1.8 ACENTA 4 - DR MT', 1, '1800', '14', 3, 2, 3, 22, 1, '\'01241790', '132151.76', NULL, NULL, 'MOKOENA R GERMINAH', 'MokoenaR@dtcs.limpopo.gov.za', '+10156336691', 13, 'Private BagX61<div>CHUENESPOORT</div><div>0745</div>', 1, 5, 2, 2, NULL, 2, NULL, NULL, '<br>', NULL, NULL, NULL, NULL, 'CAS_', NULL),
(120, 'GTB480L', 'MR18044942A', 'ADNH340000A000265', 3, 3, 'TIIDA 1.8 ACENTA 4 - DR MT', 1, '1800', '14', 3, 2, 3, 22, 1, '\'01241759', '132.00', NULL, NULL, 'MAPHISWANE THIXEDZWI', 'MaphiswaneT@dtcs.limpopo.gov.za', '+10159625081', 13, 'Private BagX2145<div>SIBASA</div><div>0970</div>', 1, 32, 2, 2, NULL, 2, NULL, NULL, '<br>', NULL, NULL, NULL, NULL, 'CAS_', NULL),
(121, 'GTB482L', 'MR18045122A', 'ADNH340000A000269', 3, 3, 'TIIDA 1.8 ACENTA 4 - DR MT', 1, '1800', '14', 3, 2, 3, 22, 1, '\'02020559', '132151.76', NULL, NULL, 'SEKATANE DIKOTSI', 'SekataneD@dtcs.limpopo.gov.za', '+10147182300', 13, 'Private BagX1038<div>Modimolle</div><div>0510</div>', 1, 91, 2, 2, NULL, 2, NULL, NULL, '<br>', NULL, NULL, NULL, NULL, 'CAS_', NULL),
(122, 'GTB489L', 'MR18045390A', 'ADNH340000A000209', 3, 3, 'TIIDA 1.8 ACENTA 4 - DR MT', 1, '1800', '14', 3, 2, 3, 22, 1, '\'01241762', '132151.76', NULL, NULL, 'MOKOENA R GERMINAH', 'MokoenaR@dtcs.limpopo.gov.za', '+10156336691', 13, 'Private BagX61<div>CHUENESPOORT</div><div>0745</div>', 1, 5, 2, 2, NULL, 2, NULL, NULL, '<br>', '2022-05-31', NULL, NULL, NULL, 'CAS_', NULL),
(123, 'GTB819L', '1NR0686754', 'AHTBTOJE00002119', 1, 1, 'COROLLA 1.3 ESTEEM', 8, '1.3', '14', 3, 2, 3, 13, 1, '2015652', '0.00', NULL, NULL, 'MOKONE EM', 'Mokonee@dtcs.limpopo.gov.za', '0156336691', 13, 'PRIVATE BAG X61<div>LEBOAKGOMO</div><div>0737</div>', 1, 18, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(124, 'GTB820L', '1NR0687057', 'AHTBT0JE00002120', 1, 1, 'COROLLA 1.3 ESTEEM', 8, '1.3', '14', 3, 2, 3, 13, 1, '2015655', '0.00', NULL, NULL, 'MOKONE EM', 'Mokonee@dtcs.limpopo.gov.za', '0156336691', 13, 'PRIVATE BAG X 61<div>LEBOWAKGOMO</div><div>0737</div>', 1, 32, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(125, 'GTB821L', '1NR0683112', 'AHTBTOJE2000002121', 1, 1, 'COROLLA 1.3 ESTEEM', 8, '1.3', '14', 3, 2, 3, 13, 1, '2015651', '0.00', NULL, NULL, 'MOKONE EM', 'Mokonee@dtcs.limpopo.gov.za', '0156336691', 13, 'PRIVATE BAG X 61<div>LEBOWAKGOMO</div><div>0737</div>', 1, 18, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(126, 'GTB822L', '1NR063110', 'AHTBT0JE600002123', 1, 1, 'COROLLA 1.3 ESTEEM', 8, '1.3', '14', 3, 2, 3, 13, 1, '2015675', '0.00', NULL, NULL, 'MOKONE EM', 'Mokonee@dtcs.limpopo.gov.za', '0156336691', 13, 'PRIVATE BAG X 61<div>LEBOWAKGOMO</div><div>0737</div>', 1, 5, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(127, 'GTB823L', '1NR0687047', 'AHTBTOJE700002132', 1, 1, 'COROLLA 1.3 ESTEEM', 8, '1.3', '14', 3, 2, 3, 13, 1, '2015646', '0.00', NULL, NULL, 'Sekatane Dikotse', 'sekataneD@dtcs.limpopo.gav.za', '0156336691', 13, 'PRIVARE BAG X 1038<div>NYLSTROOM</div><div>0510</div>', 1, 105, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(128, 'GTB824L', '1NR0686360', 'AHTBTOJE900002133', 1, 1, 'COROLLA 1.3 ESTEEM', 8, '1.3', '14', 3, 2, 3, 13, 1, '2015671', '0.00', NULL, NULL, 'Sekatane Dikotse', 'sekataneD@dtcs.limpopo.gav.za', '0156336691', 13, 'PRIVATE BAG X 1038<div>NYLSTROOM</div><div>0510</div>', 1, 91, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(129, 'GTB490L', 'MR18045376A', 'ADNH340000A000208', 3, 3, 'TIIDA 1.8 ACENTA 4 - DR MT', 1, '1800', '14', 3, 2, 3, 22, 1, '\'01241775', '132151.76', NULL, NULL, 'CHAUKE MASINDI JOEL', 'ChaukeM@dtcs.limpopo.gov.za', '+10158117000', 13, 'Private Bag X9671<div>GIYANI</div><div>0826</div>', 1, 46, 2, 2, NULL, 2, NULL, NULL, '<br>', NULL, NULL, NULL, NULL, 'CAS_', NULL),
(130, 'GTB880L', 'WRM4L15538', 'MA1TB2WR2N2015482', 8, 8, 'SCOPIO SUV 2.2 MHWAK 2WD', 16, '2199', '18', 3, 3, 5, 24, 1, 'GTB880L', '0.00', NULL, NULL, 'RAVHELE T.R', 'ravhelet@dtcs.limpopo.gov.za', '(015) 962 5081', 13, 'Private bag x2145<div>Sibasa</div><div>0970</div>', 1, 32, 2, 2, 13, 2, NULL, NULL, '<br>', '2023-04-30', NULL, NULL, NULL, 'CAS_', NULL),
(131, 'GTB825L', '1NR0687051', 'AHTBTOJE200002134', 1, 1, 'COROLLA 1.3 ESTEEM', 8, '1.3', '14', 3, 2, 3, 13, 1, '2015670', '0.00', NULL, NULL, 'Sekatane Dikotse', 'sekataneD@dtcs.limpopo.gav.za', '0156336691', 13, 'PRIVATE BAG X 1038<div>NYLSTROOM</div><div>0510</div><div><br></div>', 1, 82, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(132, 'GTB492L', 'MR18045708A', 'ADNH340000A000212', 3, 3, 'TIIDA 1.8 ACENTA 4 - DR MT', 1, '1800', '14', 3, 2, 3, 22, 1, '\'01241773', '132151.76', NULL, NULL, 'MOKOENA R GERMINAH', 'MokoenaR@dtcs.limpopo.gov.za', '+10156336691', 13, 'Private BagX61<div>CHUENESPOORT</div><div>0745</div>', 1, 5, 2, 2, NULL, 2, NULL, NULL, '<br>', NULL, NULL, NULL, NULL, 'CAS_', NULL),
(133, 'GTB881L', 'WRM4L13111', 'MA1TB2WR2N2011486', 8, 8, 'SCOPIO SUV 2.2 MHWAK 2WD', 16, '2199cm', '18', 3, 3, 5, 17, 1, 'GTB881L', '0.00', NULL, NULL, 'RAVHELE T.R', 'ravhelet@dtcs.limpopo.gov.za', '(015) 962 5081', 13, 'Private bag 2145<div>Sibasa</div><div>0970</div>', 1, 32, 2, 2, 13, 2, NULL, NULL, '<br>', '2023-04-30', NULL, NULL, NULL, 'CAS_', NULL),
(134, 'GTB499L', 'MR18045370A', 'ADNH340000A000200', 3, 3, 'TIIDA 1.8 ACENTA 4 - DR MT', 1, '1800', '14', 3, 2, 3, 22, 1, '\'01241278', '132.00', NULL, NULL, 'MOKOENA R GERMINAH', 'MokoenaR@dtcs.limpopo.gov.za', '+10156336691', 13, 'Private BagX61<div>Chuenespoort</div><div>0745</div>', 1, 5, 2, 2, NULL, 2, NULL, NULL, '<br>', NULL, NULL, NULL, NULL, 'CAS_', NULL),
(135, 'GTB826L', '1NR0686357', 'AHTBTOJE200002135', 1, 1, 'COROLLA 1.3 ESTEEM', 8, '1.3', '14', 3, 2, 3, 13, 1, '2015647', '0.00', NULL, NULL, 'Sekatane Dikotse', 'sekataneD@dtcs.limpopo.gav.za', '0156336691', 13, 'PRIVATE BAG X 1038<div>NYLSTROOM</div><div>0510</div>', 1, 79, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(136, 'GTB509L', 'MR18045392A', 'ADNH340000A000238', 3, 3, 'TIIDA 1.8 ACENTA 4 - DR MT', 1, '1800', '14', 3, 2, 3, 22, 1, '\'01241756', '132151.76', NULL, NULL, 'CHAUKE MASINDI JOEL', 'ChaukeM@dtcs.limpopo.gov.za', '+10158117000', 13, 'Private BagX9675<div>GIYANI</div><div>0826</div>', 1, 46, 2, 2, NULL, 2, NULL, NULL, '<br>', NULL, NULL, NULL, NULL, 'CAS_', NULL);
INSERT INTO `gmt_fleet_register` (`fleet_asset_id`, `vehicle_registration_number`, `engine_number`, `chassis_number`, `dealer_name`, `make_of_vehicle`, `model_of_vehicle`, `year_model_specification`, `engine_capacity`, `tyre_size`, `transmission`, `fuel_type`, `type_of_vehicle`, `colour_of_vehicle`, `application_status`, `barcode_number`, `purchase_price`, `depreciation_value`, `photo_of_vehicle`, `user_name_and_surname`, `user_contact_email`, `contact_number`, `department_name`, `department_address`, `province`, `district`, `drivers_name_and_surname`, `drivers_persal_number`, `department_name_of_driver`, `drivers_contact_details`, `documents`, `date_auctioned`, `comments`, `renewal_of_license`, `mm_code`, `dealer_type`, `register_number`, `case_number`, `venue`) VALUES
(137, 'GTB882L', 'WRM4L15529', 'MA1TB2WR2N2015488', 8, 8, 'SCOPIO SUV 2.2 MHWAK 2WD', 16, '2199cm', '18', 3, 3, 5, 24, 1, 'GTB882L', '0.00', NULL, NULL, 'RAVHELE T.R', 'ravhelet@dtcs.limpopo.gov.za', '(015) 962 5081', 13, 'Private bag X2145<div>Sibasa</div><div>0970</div>', 1, 32, 2, 2, 13, 2, NULL, NULL, '<br>', NULL, NULL, NULL, NULL, 'CAS_', NULL),
(138, 'GTB827L', '1NR0686362', 'AHTBTOJE400002136', 1, 1, 'COROLLA 1.3 ESTEEM', 8, '1.3', '14', 3, 2, 3, 13, 1, '2015656', '0.00', NULL, NULL, 'Sekatane Dikotse', 'sekataneD@dtcs.limpopo.gav.za', '0156336691', 13, 'PRIVATE BAG X 1038<div>NYLSTROOM</div><div>0510</div>', 1, 88, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(139, 'GTB828L', '1NR0683176', 'AHTBTOJE900002164', 1, 1, 'COROLLA 1.3 ESTEEM', 8, '1.3', '14', 3, 2, 3, 13, 1, '2015654', '0.00', NULL, NULL, 'CHAUKE J', 'Chaukej@dtcs.limpopo.gov', '0156336691', 13, 'PRIVATE BAG X 9671<div>GIYANI</div><div>0826</div>', 1, 45, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-21', NULL, NULL, NULL, 'CAS_', NULL),
(140, 'GTB883L', 'WRM4L15926', 'MA1TB2WR2N2015490', 8, 8, 'SCOPIO SUV 2.2 MHWAK 2WD', 16, '2199cm', '18', 3, 3, 5, 24, 1, 'GTB883L', '0.00', NULL, NULL, 'SEKATANE D.K', 'sekataned@dtcs.limpopo.gov.za', '(015) 718 2300', 13, 'Private bag X1038<div>Nylstroom</div><div>0737</div>', 1, 79, 2, 2, 13, 2, NULL, NULL, '<br>', '2023-04-30', NULL, NULL, NULL, 'CAS_', NULL),
(141, 'GTB884L', 'WRM4M15791', 'MA1TB2WR2N2015576', 8, 8, 'SCOPIO SUV 2.2 MHWAK 2WD', 16, '2199cm', '18', 3, 3, 5, 17, 1, 'GTB884L', '0.00', NULL, NULL, 'SEKATANE D.K', 'sekataned@dtcs.limpopo.gov.za', '(015) 718 2300', 13, 'Private bag X1038<div>Nylstroom</div><div>0737</div>', 1, 79, 2, 2, 13, 2, NULL, NULL, '<br>', '2023-04-30', NULL, NULL, NULL, 'CAS_', NULL),
(142, 'GTB885L', 'WRM4M15527', 'MA1TB2WR2N2015608', 8, 8, 'SCOPIO SUV 2.2 MHWAK 2WD', 16, '2199cm', '18', 3, 3, 5, 24, 1, 'GT885L', '0.00', NULL, NULL, 'SEKATANE D.K', 'sekataned@dtcs.limpopo.gov.za', '(015) 718 2300', 13, 'Private bag 1038<div>Nylstroom</div><div>0737</div>', 1, 79, 2, 2, 13, 2, NULL, NULL, '<br>', '2023-04-30', NULL, NULL, NULL, 'CAS_', NULL),
(143, 'GTB829L', '1NR0684714', 'AHTTBOJE600002199', 1, 1, 'COROLLA 1.3 ESTEEM', 8, '1.3', '14', 3, 2, 3, 13, 1, '2015658', '0.00', NULL, NULL, 'CHAUKE J', 'Chaukej@dtcs.limpopo.gov', '0156336691', 13, 'PRIVATE BAG X 9671<div>GIYANI</div><div>0826</div>', 1, 67, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(144, 'GTB830L', '1NR0685455', 'AHTBTOJEX0002349', 1, 1, 'COROLLA 1.3 ESTEEM', 8, '1.3', '14', 3, 2, 3, 13, 1, '2015660', '0.00', NULL, NULL, 'CHAUKE J', 'Chaukej@dtcs.limpopo.gov', '0156336691', 13, 'PRIVATE BAG X 9671<div>GIYANI</div><div>0826</div>', 1, 46, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(145, 'GTB886L', 'WRM4M15538', 'MA1TB2WR2N2015625', 8, 8, 'SCOPIO SUV 2.2 MHWAK 2WD', 16, '2199cm', '18', 3, 3, 5, 17, 1, 'GTB886L', '0.00', NULL, NULL, 'MOKONE E.M', 'mokonem@dtcs.limpopo.gov.za', '(015) 633 5157', 13, 'Private bag X61<div>Lebowakgomo</div><div>0737</div>', 1, 18, 2, 2, 13, 2, NULL, NULL, '<br>', '2023-04-30', NULL, NULL, NULL, 'CAS_', NULL),
(146, 'GTB831L', '1NR0705254', 'AHTBTOJE100002479', 1, 1, 'COROLLA 1.3 ESTEEM', 8, '1.3', '14', 3, 2, 3, 13, 1, '2015644', '0.00', NULL, NULL, 'CHAUKE J', 'Chaukej@dtcs.limpopo.gov', '0156336691', 13, 'PRIVATE BAG X 9671<div>GIYANI</div><div>0826</div>', 1, 46, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(147, 'GTB887L', 'WRM4M15543', 'MA1TB2WR2N2015743', 8, 8, 'SCOPIO SUV 2.2 MHWAK 2WD', 16, '2199cm', '18', 3, 3, 5, 24, 1, 'GTB887L', '0.00', NULL, NULL, 'MOKONE E.M', 'mokonem@dtcs.limpopo.gov.za', '(015) 633 5157', 13, 'Private bag X61<div>Lebowakgomo</div><div>0737</div>', 1, 18, 2, 2, 13, 2, NULL, NULL, '<br>', '2023-04-30', NULL, NULL, NULL, 'CAS_', NULL),
(148, 'GTB888L', 'WRM4M15536', 'MA1TB2WR2N2015746', 8, 8, 'SCOPIO SUV 2.2 MHWAK 2WD', 16, '2199cm', '18', 3, 3, 5, 24, 1, 'GTB888L', '0.00', NULL, NULL, 'MOKONE E.M', 'mokonem@dtcs.limpopo.gov.za', '(015) 633 5157', 13, 'Private bag x61<div>Lebowakgomo</div><div>0737</div>', 1, 18, 2, 2, 13, 2, NULL, NULL, '<br>', '2023-04-30', NULL, NULL, NULL, 'CAS_', NULL),
(149, 'GTB832L', '1NR0705220', 'AHTBT0JE100002479', 1, 1, 'COROLLA 1.3 ESTEEM', 8, '1.3', '14', 3, 2, 3, 13, 1, '2015677', '0.00', NULL, NULL, 'CHAUKE J', 'Chaukej@dtcs.limpopo.gov', '0156336691', 13, 'PRIVATE BAG X 9671<div>GIYANI</div><div>0826</div>', 1, 46, 2, 2, 13, 2, NULL, NULL, '<br>', '2022-03-31', NULL, NULL, NULL, 'CAS_', NULL),
(150, 'GTB510L', 'MR18045131A', 'ADNH340000A000270', 3, 3, 'TIIDA 1.8 ACENTA 4 - DR MT', 1, '1800', '14', 3, 2, 3, 22, 1, '\'0124175', '132151.76', NULL, NULL, 'Lekgothoane LT', 'LekgothoaneT@dtcs.limpopo.gov.za', '+10152951000', 13, 'Private BagX9491<div>POLOKWANE</div><div>0699</div>', 1, 2, 2, 2, NULL, 2, NULL, NULL, '<br>', NULL, NULL, NULL, NULL, 'CAS_', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `identification_of_defects`
--

DROP TABLE IF EXISTS `identification_of_defects`;
CREATE TABLE IF NOT EXISTS `identification_of_defects` (
  `defects_id` int NOT NULL AUTO_INCREMENT,
  `vehicle_registration_number` int DEFAULT NULL,
  `engine_number` int DEFAULT NULL,
  `make_of_vehicle` int DEFAULT NULL,
  `end_user_name_and_surname` varchar(40) DEFAULT NULL,
  `end_user_contact_details` varchar(40) DEFAULT NULL,
  `end_user_persal_number` varchar(40) DEFAULT NULL,
  `end_user_email_address` varchar(40) DEFAULT NULL,
  `end_user_signature` varchar(40) DEFAULT NULL,
  `types_of_defects` text,
  `courses_of_defects` text,
  `condition_of_defects` text,
  `transport_officer_name_and_surname` varchar(40) DEFAULT NULL,
  `transport_officer_persal_number` varchar(40) DEFAULT NULL,
  `transport_officer_contact_details` varchar(40) DEFAULT NULL,
  `transport_officer_email_address` varchar(40) DEFAULT NULL,
  `government_garage_manager_name_and_surname` varchar(40) DEFAULT NULL,
  `government_garage_manager_contact_details` varchar(40) DEFAULT NULL,
  `government_garage_manager_address` text,
  `government_garage_manager_email_address` varchar(40) DEFAULT NULL,
  `government_garage_manager_signature` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`defects_id`),
  KEY `vehicle_registration_number` (`vehicle_registration_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `indicates_repair_damages_found_list`
--

DROP TABLE IF EXISTS `indicates_repair_damages_found_list`;
CREATE TABLE IF NOT EXISTS `indicates_repair_damages_found_list` (
  `repair_damages_list_id` int NOT NULL AUTO_INCREMENT,
  `brought_in_for_repairs` text,
  `after_repairs` text,
  `driver_name_and_surname` int DEFAULT NULL,
  `driver_persal_number` int DEFAULT NULL,
  `driver_signature` varchar(40) DEFAULT NULL,
  `vehicle_return_date_signed` datetime DEFAULT '2020-01-01 00:00:00',
  `company_name_and_surname` varchar(40) DEFAULT NULL,
  `company_repesentative_signature` varchar(40) DEFAULT NULL,
  `vehicle_return_date_signed_by_representative` datetime DEFAULT '2020-01-01 00:00:00',
  `indicates_and_list_details_of_damages_deficiencies` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`repair_damages_list_id`),
  KEY `driver_name_and_surname` (`driver_name_and_surname`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inspection_bay`
--

DROP TABLE IF EXISTS `inspection_bay`;
CREATE TABLE IF NOT EXISTS `inspection_bay` (
  `inspection_bay_id` int NOT NULL AUTO_INCREMENT,
  `inspection_bay_supervisor_name_and_surname` varchar(40) DEFAULT NULL,
  `supervisor_contact_details` varchar(40) DEFAULT NULL,
  `supervisor_email_address` varchar(40) DEFAULT NULL,
  `supervisor_signature` varchar(40) DEFAULT NULL,
  `date_of_vehicle_entrance` datetime DEFAULT NULL,
  `job_card_number` int DEFAULT NULL,
  `vehicle_registration_number` int DEFAULT NULL,
  `engine_number` int DEFAULT NULL,
  `workshop_name` int DEFAULT NULL,
  `work_allocation_reference_number` int DEFAULT NULL,
  `make_of_vehicle` int DEFAULT NULL,
  `inspection_bay_lane_number` varchar(40) DEFAULT NULL,
  `inspection_bay_condition` text,
  `allocation_feedback` text,
  `verification_of_defects` text,
  `additional_defects` text,
  `additional_defects_record` varchar(40) DEFAULT NULL,
  `repair_requirement_note` text,
  `repair_requirement_report` varchar(40) DEFAULT NULL,
  `date_of_vehicle_exit` datetime DEFAULT NULL,
  PRIMARY KEY (`inspection_bay_id`),
  KEY `job_card_number` (`job_card_number`),
  KEY `vehicle_registration_number` (`vehicle_registration_number`),
  KEY `work_allocation_reference_number` (`work_allocation_reference_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `insurance_payments`
--

DROP TABLE IF EXISTS `insurance_payments`;
CREATE TABLE IF NOT EXISTS `insurance_payments` (
  `insurance_payment_id` int NOT NULL AUTO_INCREMENT,
  `vehicle_registration_number` int DEFAULT NULL,
  `engine_number` int DEFAULT NULL,
  `chassis_number` int DEFAULT NULL,
  `make_of_vehicle` int DEFAULT NULL,
  `model_of_vehicle` int DEFAULT NULL,
  `year_model_of_vehicle` int DEFAULT NULL,
  `type_of_vehicle` int DEFAULT NULL,
  `application_status` int DEFAULT NULL,
  `barcode_number` int DEFAULT NULL,
  `department` int DEFAULT NULL,
  `insurance_reference` varchar(40) DEFAULT NULL,
  `insurance_expiration` date DEFAULT NULL,
  `transaction_date` date DEFAULT NULL,
  `reference_number` varchar(40) DEFAULT NULL,
  `merchant_name` int DEFAULT NULL,
  `payment_amount` decimal(10,2) DEFAULT NULL,
  `month_end` date DEFAULT NULL,
  `documents` varchar(40) DEFAULT NULL,
  `comments` longtext,
  PRIMARY KEY (`insurance_payment_id`),
  KEY `vehicle_registration_number` (`vehicle_registration_number`),
  KEY `merchant_name` (`merchant_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `internal_repairs_body`
--

DROP TABLE IF EXISTS `internal_repairs_body`;
CREATE TABLE IF NOT EXISTS `internal_repairs_body` (
  `internal_repairs_body_id` int NOT NULL AUTO_INCREMENT,
  `driver_name_and_surname` int DEFAULT NULL,
  `driver_persal_number` int DEFAULT NULL,
  `driver_contacts_details` int DEFAULT NULL,
  `driver_email_address` int DEFAULT NULL,
  `driver_license_code` int DEFAULT NULL,
  `driver_license_number` int DEFAULT NULL,
  `driver_license_upload` varchar(40) DEFAULT NULL,
  `driver_signature` varchar(40) DEFAULT NULL,
  `vehicle_registration_number` int DEFAULT NULL,
  `engine_number` int DEFAULT NULL,
  `make_of_vehicle` int DEFAULT NULL,
  `z181_accident_form` varchar(40) DEFAULT NULL,
  `z181_accident_form_uploaded` varchar(40) DEFAULT NULL,
  `job_card_number` int DEFAULT NULL,
  `work_allocation_reference_number` int DEFAULT NULL,
  `artisan_note_of_starting_time` datetime DEFAULT NULL,
  `government_garage_name` int DEFAULT NULL,
  `government_garage_contact_details` varchar(40) DEFAULT NULL,
  `government_garage_address` text,
  `government_garage_email_address` varchar(40) DEFAULT NULL,
  `damages_occured` text,
  `upload_of_internal_damages_1` varchar(40) DEFAULT NULL,
  `upload_of_internal_damages_2` varchar(40) DEFAULT NULL,
  `upload_of_internal_damages_3` varchar(40) DEFAULT NULL,
  `upload_of_internal_damages_4` varchar(40) DEFAULT NULL,
  `head_panel_beating_quotation` varchar(40) DEFAULT NULL,
  `head_panel_beating_quotation_1` varchar(40) DEFAULT NULL,
  `head_panel_beating_name` varchar(40) DEFAULT NULL,
  `head_panel_beating_contact_details` varchar(40) DEFAULT NULL,
  `head_panel_beating_address` text,
  `head_panel_beating_signature` varchar(40) DEFAULT NULL,
  `private_panel_beating_name` varchar(40) DEFAULT NULL,
  `private_panel_beating_contact_details` varchar(40) DEFAULT NULL,
  `private_panel_beating_address` text,
  `private_panel_beating_quotation` varchar(40) DEFAULT NULL,
  `private_panel_beating_quotation_2` varchar(40) DEFAULT NULL,
  `artisan_note_of_completion_time` datetime DEFAULT NULL,
  `total_labour_time` time DEFAULT NULL,
  PRIMARY KEY (`internal_repairs_body_id`),
  KEY `driver_name_and_surname` (`driver_name_and_surname`),
  KEY `vehicle_registration_number` (`vehicle_registration_number`),
  KEY `job_card_number` (`job_card_number`),
  KEY `work_allocation_reference_number` (`work_allocation_reference_number`),
  KEY `government_garage_name` (`government_garage_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `internal_repairs_mechanical`
--

DROP TABLE IF EXISTS `internal_repairs_mechanical`;
CREATE TABLE IF NOT EXISTS `internal_repairs_mechanical` (
  `internal_mechanical_id` smallint NOT NULL AUTO_INCREMENT,
  `workshop_name` int DEFAULT NULL,
  `artisan_name_and_surname` varchar(40) DEFAULT NULL,
  `artisan_contacts` varchar(40) DEFAULT NULL,
  `artisan_email_address` varchar(40) DEFAULT NULL,
  `artisan_signature` varchar(40) DEFAULT NULL,
  `artisan_note_of_starting_time` datetime DEFAULT NULL,
  `job_card_number` int DEFAULT NULL,
  `work_allocation_reference_number` int DEFAULT NULL,
  `vehicle_registration_number` int DEFAULT NULL,
  `engine_number` int DEFAULT NULL,
  `make_of_vehicle` int DEFAULT NULL,
  `pre_repair_inspections` text,
  `artisan_dismantling_solution` text,
  `spares_order_quotation` varchar(40) DEFAULT NULL,
  `spares_order_description` text,
  `artisan_note_of_completion_time` datetime DEFAULT NULL,
  `inspection_bay_lane_number` int DEFAULT NULL,
  `inspection_bay_report` varchar(40) DEFAULT NULL,
  `total_labour_time` time DEFAULT NULL,
  PRIMARY KEY (`internal_mechanical_id`),
  KEY `workshop_name` (`workshop_name`),
  KEY `job_card_number` (`job_card_number`),
  KEY `work_allocation_reference_number` (`work_allocation_reference_number`),
  KEY `vehicle_registration_number` (`vehicle_registration_number`),
  KEY `make_of_vehicle` (`make_of_vehicle`),
  KEY `inspection_bay_lane_number` (`inspection_bay_lane_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `log_sheet`
--

DROP TABLE IF EXISTS `log_sheet`;
CREATE TABLE IF NOT EXISTS `log_sheet` (
  `fuel_log_sheet_id` int NOT NULL AUTO_INCREMENT,
  `vehicle_registration_number` int DEFAULT NULL,
  `make_of_vehicle` int DEFAULT NULL,
  `model_of_vehicle` int DEFAULT NULL,
  `engine_number` int DEFAULT NULL,
  `district` int DEFAULT NULL,
  `month` date DEFAULT NULL,
  `year_model_specification` int DEFAULT NULL,
  `drivers_name_and_surname` int DEFAULT NULL,
  `drivers_persal_number` int DEFAULT NULL,
  `opening_km` varchar(15) DEFAULT NULL,
  `closing_km` varchar(15) DEFAULT NULL,
  `total_km` varchar(15) DEFAULT NULL,
  `engine_capacity` int DEFAULT NULL,
  `fuel_type` int DEFAULT NULL,
  `fuel_tank_capacity` decimal(10,2) DEFAULT NULL,
  `vendor` varchar(40) DEFAULT NULL,
  `fuel_cost_litre` decimal(10,2) DEFAULT NULL,
  `refuel_quantity_1` decimal(10,2) DEFAULT NULL,
  `refuel_first_time_date` date DEFAULT NULL,
  `refuel_quantity_2` decimal(10,2) DEFAULT NULL,
  `refuel_second_time_date` date DEFAULT NULL,
  `refuel_quantity_3` decimal(10,2) DEFAULT NULL,
  `refuel_third_time_date` date DEFAULT NULL,
  `refuel_quantity_4` decimal(10,2) DEFAULT NULL,
  `refuel_fourth_time_date` date DEFAULT NULL,
  `times_refuel_current_month` decimal(10,2) DEFAULT NULL,
  `total_fuel_quantity` decimal(10,2) DEFAULT NULL,
  `fuel_consumption` decimal(10,2) DEFAULT NULL,
  `fuel_total_cost` decimal(10,2) DEFAULT NULL,
  `payment_e_fuel_card` varchar(40) DEFAULT NULL,
  `captured_by` varchar(35) DEFAULT NULL,
  `comments` text,
  `date_captured` date DEFAULT NULL,
  `complete_fill_up` varchar(40) DEFAULT NULL,
  `total_trip_distance` varchar(15) DEFAULT NULL,
  `trip_distance_refuel_1` varchar(15) DEFAULT NULL,
  `trip_distance_refuel_2` varchar(15) DEFAULT NULL,
  `trip_distance_refuel_3` varchar(15) DEFAULT NULL,
  `trip_distance_refuel_4` varchar(15) DEFAULT NULL,
  `refuel_quantity_5` decimal(10,2) DEFAULT NULL,
  `refuel_fifth_time_date` date DEFAULT NULL,
  `trip_distance_refuel_5` varchar(15) DEFAULT NULL,
  `refuel_quantity_6` decimal(10,2) DEFAULT NULL,
  `trip_distance_refuel_6` varchar(15) DEFAULT NULL,
  `refuel_sixth_time_date` date DEFAULT NULL,
  `register_number` int DEFAULT NULL,
  `colour_of_vehicle` int DEFAULT NULL,
  `renewal_of_license` date DEFAULT NULL,
  PRIMARY KEY (`fuel_log_sheet_id`),
  KEY `vehicle_registration_number` (`vehicle_registration_number`),
  KEY `model_of_vehicle` (`model_of_vehicle`),
  KEY `drivers_name_and_surname` (`drivers_name_and_surname`),
  KEY `fuel_type` (`fuel_type`),
  KEY `register_number` (`register_number`),
  KEY `colour_of_vehicle` (`colour_of_vehicle`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_sheet`
--

INSERT INTO `log_sheet` (`fuel_log_sheet_id`, `vehicle_registration_number`, `make_of_vehicle`, `model_of_vehicle`, `engine_number`, `district`, `month`, `year_model_specification`, `drivers_name_and_surname`, `drivers_persal_number`, `opening_km`, `closing_km`, `total_km`, `engine_capacity`, `fuel_type`, `fuel_tank_capacity`, `vendor`, `fuel_cost_litre`, `refuel_quantity_1`, `refuel_first_time_date`, `refuel_quantity_2`, `refuel_second_time_date`, `refuel_quantity_3`, `refuel_third_time_date`, `refuel_quantity_4`, `refuel_fourth_time_date`, `times_refuel_current_month`, `total_fuel_quantity`, `fuel_consumption`, `fuel_total_cost`, `payment_e_fuel_card`, `captured_by`, `comments`, `date_captured`, `complete_fill_up`, `total_trip_distance`, `trip_distance_refuel_1`, `trip_distance_refuel_2`, `trip_distance_refuel_3`, `trip_distance_refuel_4`, `refuel_quantity_5`, `refuel_fifth_time_date`, `trip_distance_refuel_5`, `refuel_quantity_6`, `trip_distance_refuel_6`, `refuel_sixth_time_date`, `register_number`, `colour_of_vehicle`, `renewal_of_license`) VALUES
(1, 1, 1, 1, 1, 1, '2020-03-03', 1, 1, 1, '2456.76', '3345.76', '1842.14', 1, 3, '50.00', 'Engen - Mokopane', '22.25', '48.00', '2020-05-05', '40.00', '2020-05-12', '50.00', '2020-05-21', '0.00', '2020-05-05', '3.00', '138.00', '6.44', '3070.50', NULL, 'Mara Kriel', '<br>', NULL, 'Fill up', '889', '275', '325', '289', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 2, 2, 2, NULL, 2, '2020-03-31', 2, 1, 1, '2345.76', '3068.76', '238.11', 2, 2, '50.00', 'BP Garage Tzaneen', '20.25', '45.00', '2020-04-23', '28.00', '2020-04-26', '0.00', NULL, '0.00', NULL, '2.00', '73.00', '9.90', '1478.25', 'No', 'Mara Kriel', '<br>', '2020-04-30', 'Fill up', '723', '482', '241', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `manufacturer`
--

DROP TABLE IF EXISTS `manufacturer`;
CREATE TABLE IF NOT EXISTS `manufacturer` (
  `manufacturer_id` int NOT NULL AUTO_INCREMENT,
  `manufacturer_type` int DEFAULT NULL,
  `manufacturer_name` varchar(40) DEFAULT NULL,
  `contact_person` varchar(40) DEFAULT NULL,
  `contact_details` varchar(40) DEFAULT NULL,
  `contact_email` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`manufacturer_id`),
  KEY `manufacturer_type` (`manufacturer_type`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manufacturer`
--

INSERT INTO `manufacturer` (`manufacturer_id`, `manufacturer_type`, `manufacturer_name`, `contact_person`, `contact_details`, `contact_email`) VALUES
(1, 4, 'Bosch', NULL, NULL, NULL),
(2, 2, 'Bearing man', NULL, NULL, NULL),
(3, 3, 'ZamOIL', NULL, NULL, NULL),
(4, 1, 'Castor Helix', NULL, NULL, NULL),
(5, 6, 'GUD', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `manufacturer_type`
--

DROP TABLE IF EXISTS `manufacturer_type`;
CREATE TABLE IF NOT EXISTS `manufacturer_type` (
  `manufacturer_type_id` int NOT NULL AUTO_INCREMENT,
  `manufacturer_type` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`manufacturer_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manufacturer_type`
--

INSERT INTO `manufacturer_type` (`manufacturer_type_id`, `manufacturer_type`) VALUES
(1, 'Oil'),
(2, 'Bearings'),
(3, 'Oil Filter'),
(4, 'Bushes'),
(5, 'Brake pads'),
(6, 'Air Filter');

-- --------------------------------------------------------

--
-- Table structure for table `membership_grouppermissions`
--

DROP TABLE IF EXISTS `membership_grouppermissions`;
CREATE TABLE IF NOT EXISTS `membership_grouppermissions` (
  `permissionID` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `groupID` int UNSIGNED DEFAULT NULL,
  `tableName` varchar(100) DEFAULT NULL,
  `allowInsert` tinyint NOT NULL DEFAULT '0',
  `allowView` tinyint NOT NULL DEFAULT '0',
  `allowEdit` tinyint NOT NULL DEFAULT '0',
  `allowDelete` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`permissionID`),
  UNIQUE KEY `groupID_tableName` (`groupID`,`tableName`)
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `membership_grouppermissions`
--

INSERT INTO `membership_grouppermissions` (`permissionID`, `groupID`, `tableName`, `allowInsert`, `allowView`, `allowEdit`, `allowDelete`) VALUES
(1, 2, 'gmt_fleet_register_2022', 1, 3, 3, 3),
(2, 2, 'log_sheet', 1, 3, 3, 3),
(3, 2, 'vehicle_history', 1, 3, 3, 3),
(4, 2, 'year_model', 1, 3, 3, 3),
(5, 2, 'month', 1, 3, 3, 3),
(6, 2, 'body_type', 1, 3, 3, 3),
(7, 2, 'vehicle_colour', 1, 3, 3, 3),
(8, 2, 'province', 1, 3, 3, 3),
(9, 2, 'departments', 1, 3, 3, 3),
(10, 2, 'districts', 1, 3, 3, 3),
(11, 2, 'application_status', 1, 3, 3, 3),
(12, 2, 'vehicle_payments', 1, 3, 3, 3),
(13, 2, 'insurance_payments', 1, 3, 3, 3),
(14, 2, 'authorizations', 1, 3, 3, 3),
(15, 2, 'service', 1, 3, 3, 3),
(16, 2, 'service_type', 1, 3, 3, 3),
(17, 2, 'schedule', 1, 3, 3, 3),
(18, 2, 'service_records', 1, 3, 3, 3),
(19, 2, 'service_categories', 1, 3, 3, 3),
(20, 2, 'service_item_type', 1, 3, 3, 3),
(21, 2, 'service_item', 1, 3, 3, 3),
(22, 2, 'purchase_orders', 1, 3, 3, 3),
(23, 2, 'transmission', 1, 3, 3, 3),
(24, 2, 'fuel_type', 1, 3, 3, 3),
(25, 2, 'merchant', 1, 3, 3, 3),
(26, 2, 'merchant_type', 1, 3, 3, 3),
(27, 2, 'manufacturer', 1, 3, 3, 3),
(28, 2, 'manufacturer_type', 1, 3, 3, 3),
(29, 2, 'driver', 1, 3, 3, 3),
(30, 2, 'accidents', 1, 3, 3, 3),
(31, 2, 'accident_type', 1, 3, 3, 3),
(32, 2, 'claim', 1, 3, 3, 3),
(33, 2, 'claim_status', 1, 3, 3, 3),
(34, 2, 'claim_category', 1, 3, 3, 3),
(35, 2, 'cost_centre', 1, 3, 3, 3),
(36, 2, 'dealer', 1, 3, 3, 3),
(37, 2, 'dealer_type', 1, 3, 3, 3),
(38, 2, 'tyre_log_sheet', 1, 3, 3, 3),
(39, 2, 'vehicle_daily_check_list', 1, 3, 3, 3),
(40, 2, 'auditor', 1, 3, 3, 3),
(41, 2, 'parts', 1, 3, 3, 3),
(42, 2, 'parts_type', 1, 3, 3, 3),
(43, 2, 'breakdown_services', 1, 3, 3, 3),
(44, 2, 'modification_to_vehicle', 1, 3, 3, 3),
(45, 2, 'vehicle_handing_over_checklist', 1, 3, 3, 3),
(46, 2, 'vehicle_return_check_list', 1, 3, 3, 3),
(47, 2, 'indicates_repair_damages_found_list', 1, 3, 3, 3),
(48, 2, 'forms', 1, 3, 3, 3),
(49, 2, 'identification_of_defects', 1, 3, 3, 3),
(50, 2, 'gate_security', 1, 3, 3, 3),
(51, 2, 'reception', 1, 3, 3, 3),
(52, 2, 'inspection_bay', 1, 3, 3, 3),
(53, 2, 'work_allocation', 1, 3, 3, 3),
(54, 2, 'internal_repairs_mechanical', 1, 3, 3, 3),
(55, 2, 'external_repairs_mechanical', 1, 3, 3, 3),
(56, 2, 'internal_repairs_body', 1, 3, 3, 3),
(57, 2, 'external_repairs_body', 1, 3, 3, 3),
(58, 2, 'ordering_of_spares_for_internal_repairs', 1, 3, 3, 3),
(59, 2, 'collection_of_repaired_vehicles', 1, 3, 3, 3),
(60, 2, 'withdrawal_vehicle_from_operation', 1, 3, 3, 3),
(61, 2, 'costing', 1, 3, 3, 3),
(62, 2, 'billing', 1, 3, 3, 3),
(63, 2, 'general_control_measures', 1, 3, 3, 3),
(64, 2, 'movement_of_personnel_in_government_garage_and_workshops', 1, 3, 3, 3),
(65, 2, 'service_provider', 1, 3, 3, 3),
(66, 2, 'service_provider_type', 1, 3, 3, 3),
(67, 2, 'gmt_fleet_register', 1, 3, 3, 3),
(68, 2, 'vehicle_annual_inspection', 1, 3, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `membership_groups`
--

DROP TABLE IF EXISTS `membership_groups`;
CREATE TABLE IF NOT EXISTS `membership_groups` (
  `groupID` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  `allowSignup` tinyint DEFAULT NULL,
  `needsApproval` tinyint DEFAULT NULL,
  `allowCSVImport` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`groupID`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `membership_groups`
--

INSERT INTO `membership_groups` (`groupID`, `name`, `description`, `allowSignup`, `needsApproval`, `allowCSVImport`) VALUES
(1, 'anonymous', 'Anonymous group created automatically on 2022-03-14', 0, 0, 0),
(2, 'Admins', 'Admin group created automatically on 2022-03-14', 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `membership_userpermissions`
--

DROP TABLE IF EXISTS `membership_userpermissions`;
CREATE TABLE IF NOT EXISTS `membership_userpermissions` (
  `permissionID` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `memberID` varchar(100) NOT NULL,
  `tableName` varchar(100) DEFAULT NULL,
  `allowInsert` tinyint NOT NULL DEFAULT '0',
  `allowView` tinyint NOT NULL DEFAULT '0',
  `allowEdit` tinyint NOT NULL DEFAULT '0',
  `allowDelete` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`permissionID`),
  UNIQUE KEY `memberID_tableName` (`memberID`,`tableName`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `membership_userrecords`
--

DROP TABLE IF EXISTS `membership_userrecords`;
CREATE TABLE IF NOT EXISTS `membership_userrecords` (
  `recID` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tableName` varchar(100) DEFAULT NULL,
  `pkValue` varchar(255) DEFAULT NULL,
  `memberID` varchar(100) DEFAULT NULL,
  `dateAdded` bigint UNSIGNED DEFAULT NULL,
  `dateUpdated` bigint UNSIGNED DEFAULT NULL,
  `groupID` int UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`recID`),
  UNIQUE KEY `tableName_pkValue` (`tableName`,`pkValue`(150)),
  KEY `pkValue` (`pkValue`),
  KEY `tableName` (`tableName`),
  KEY `memberID` (`memberID`),
  KEY `groupID` (`groupID`)
) ENGINE=MyISAM AUTO_INCREMENT=482 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `membership_userrecords`
--

INSERT INTO `membership_userrecords` (`recID`, `tableName`, `pkValue`, `memberID`, `dateAdded`, `dateUpdated`, `groupID`) VALUES
(1, 'service', '1', 'whoami', 1588681912, 1648726989, 2),
(2, 'service', '2', 'whoami', 1588682353, 1589825465, 2),
(3, 'schedule', '1', 'whoami', 1588684123, 1648986522, 2),
(4, 'schedule', '2', 'whoami', 1588684261, 1648986589, 2),
(6, 'gmt_fleet_register_2022', '2', 'whoami', 1589288694, 1589288694, 2),
(7, 'gmt_fleet_register_2022', '1', 'whoami', 1589288694, 1647524394, 2),
(8, 'log_sheet', '1', 'whoami', 1589288694, 1650973573, 2),
(9, 'log_sheet', '2', 'whoami', 1589288694, 1652197124, 2),
(10, 'year_model', '1', 'whoami', 1589288694, 1589288694, 2),
(11, 'year_model', '2', 'whoami', 1589288694, 1589288694, 2),
(12, 'year_model', '3', 'whoami', 1589288694, 1589288694, 2),
(13, 'year_model', '4', 'whoami', 1589288694, 1589288694, 2),
(14, 'year_model', '5', 'whoami', 1589288694, 1589288694, 2),
(15, 'year_model', '6', 'whoami', 1589288694, 1589288694, 2),
(16, 'year_model', '7', 'whoami', 1589288694, 1589288694, 2),
(17, 'year_model', '8', 'whoami', 1589288694, 1589288694, 2),
(18, 'year_model', '9', 'whoami', 1589288694, 1589288694, 2),
(19, 'year_model', '10', 'whoami', 1589288694, 1589288694, 2),
(20, 'year_model', '11', 'whoami', 1589288694, 1589288694, 2),
(21, 'year_model', '12', 'whoami', 1589288694, 1589288694, 2),
(22, 'year_model', '13', 'whoami', 1589288694, 1589288694, 2),
(23, 'year_model', '14', 'whoami', 1589288694, 1589288694, 2),
(24, 'year_model', '15', 'whoami', 1589288694, 1589288694, 2),
(25, 'year_model', '16', 'whoami', 1589288694, 1589288694, 2),
(26, 'year_model', '17', 'whoami', 1589288694, 1589288694, 2),
(27, 'year_model', '18', 'whoami', 1589288694, 1589288694, 2),
(28, 'year_model', '19', 'whoami', 1589288694, 1589288694, 2),
(29, 'month', '1', 'whoami', 1589288694, 1589288694, 2),
(30, 'month', '2', 'whoami', 1589288694, 1589288694, 2),
(31, 'month', '3', 'whoami', 1589288694, 1589288694, 2),
(32, 'month', '4', 'whoami', 1589288694, 1589288694, 2),
(33, 'month', '5', 'whoami', 1589288694, 1589288694, 2),
(34, 'month', '6', 'whoami', 1589288694, 1589288694, 2),
(35, 'month', '7', 'whoami', 1589288694, 1589288694, 2),
(36, 'month', '8', 'whoami', 1589288694, 1589288694, 2),
(37, 'month', '9', 'whoami', 1589288694, 1589288694, 2),
(38, 'month', '10', 'whoami', 1589288694, 1589288694, 2),
(39, 'month', '11', 'whoami', 1589288694, 1589288694, 2),
(40, 'month', '12', 'whoami', 1589288694, 1589288694, 2),
(41, 'body_type', '1', 'whoami', 1589288694, 1589288694, 2),
(42, 'body_type', '2', 'whoami', 1589288694, 1589288694, 2),
(43, 'body_type', '3', 'whoami', 1589288694, 1589288694, 2),
(44, 'body_type', '4', 'whoami', 1589288694, 1589288694, 2),
(45, 'body_type', '5', 'whoami', 1589288694, 1589288694, 2),
(46, 'body_type', '6', 'whoami', 1589288694, 1589288694, 2),
(47, 'body_type', '7', 'whoami', 1589288694, 1589288694, 2),
(48, 'body_type', '8', 'whoami', 1589288694, 1589288694, 2),
(49, 'body_type', '9', 'whoami', 1589288694, 1589288694, 2),
(50, 'body_type', '10', 'whoami', 1589288694, 1589288694, 2),
(51, 'body_type', '11', 'whoami', 1589288694, 1589288694, 2),
(52, 'body_type', '12', 'whoami', 1589288694, 1589288694, 2),
(53, 'body_type', '13', 'whoami', 1589288694, 1589288694, 2),
(54, 'body_type', '14', 'whoami', 1589288694, 1589288694, 2),
(55, 'body_type', '15', 'whoami', 1589288694, 1589288694, 2),
(56, 'vehicle_colour', '1', 'whoami', 1589288695, 1589288695, 2),
(57, 'vehicle_colour', '2', 'whoami', 1589288695, 1589288695, 2),
(58, 'vehicle_colour', '3', 'whoami', 1589288695, 1589288695, 2),
(59, 'vehicle_colour', '4', 'whoami', 1589288695, 1589288695, 2),
(60, 'vehicle_colour', '5', 'whoami', 1589288695, 1589288695, 2),
(61, 'vehicle_colour', '6', 'whoami', 1589288695, 1589288695, 2),
(62, 'vehicle_colour', '7', 'whoami', 1589288695, 1589288695, 2),
(63, 'vehicle_colour', '8', 'whoami', 1589288695, 1589288695, 2),
(64, 'vehicle_colour', '9', 'whoami', 1589288695, 1589288695, 2),
(65, 'vehicle_colour', '10', 'whoami', 1589288695, 1589288695, 2),
(66, 'vehicle_colour', '11', 'whoami', 1589288695, 1589288695, 2),
(67, 'vehicle_colour', '12', 'whoami', 1589288695, 1589288695, 2),
(68, 'vehicle_colour', '13', 'whoami', 1589288695, 1589288695, 2),
(69, 'vehicle_colour', '14', 'whoami', 1589288695, 1589288695, 2),
(70, 'vehicle_colour', '15', 'whoami', 1589288695, 1589288695, 2),
(71, 'vehicle_colour', '16', 'whoami', 1589288695, 1589288695, 2),
(72, 'vehicle_colour', '17', 'whoami', 1589288695, 1589288695, 2),
(73, 'vehicle_colour', '18', 'whoami', 1589288695, 1589288695, 2),
(74, 'vehicle_colour', '19', 'whoami', 1589288695, 1589288695, 2),
(75, 'vehicle_colour', '20', 'whoami', 1589288695, 1589288695, 2),
(76, 'vehicle_colour', '21', 'whoami', 1589288695, 1589288695, 2),
(77, 'vehicle_colour', '22', 'whoami', 1589288695, 1589288695, 2),
(78, 'vehicle_colour', '23', 'whoami', 1589288695, 1589288695, 2),
(79, 'vehicle_colour', '24', 'whoami', 1589288695, 1589288695, 2),
(80, 'vehicle_colour', '25', 'whoami', 1589288695, 1589288695, 2),
(81, 'vehicle_colour', '26', 'whoami', 1589288695, 1589288695, 2),
(82, 'vehicle_colour', '27', 'whoami', 1589288695, 1589288695, 2),
(83, 'vehicle_colour', '28', 'whoami', 1589288695, 1589288695, 2),
(84, 'province', '1', 'whoami', 1589288695, 1589288695, 2),
(85, 'province', '2', 'whoami', 1589288695, 1589288695, 2),
(86, 'province', '3', 'whoami', 1589288695, 1589288695, 2),
(87, 'province', '4', 'whoami', 1589288695, 1589288695, 2),
(88, 'province', '5', 'whoami', 1589288695, 1589288695, 2),
(89, 'province', '6', 'whoami', 1589288695, 1589288695, 2),
(90, 'province', '7', 'whoami', 1589288695, 1589288695, 2),
(91, 'province', '8', 'whoami', 1589288695, 1589288695, 2),
(92, 'province', '9', 'whoami', 1589288695, 1589288695, 2),
(93, 'departments', '1', 'whoami', 1589288695, 1589288695, 2),
(94, 'departments', '2', 'whoami', 1589288695, 1589288695, 2),
(95, 'departments', '3', 'whoami', 1589288695, 1589288695, 2),
(96, 'departments', '4', 'whoami', 1589288695, 1589288695, 2),
(97, 'departments', '5', 'whoami', 1589288695, 1589288695, 2),
(98, 'departments', '6', 'whoami', 1589288695, 1589288695, 2),
(99, 'departments', '7', 'whoami', 1589288695, 1589288695, 2),
(100, 'departments', '8', 'whoami', 1589288695, 1589288695, 2),
(101, 'departments', '9', 'whoami', 1589288695, 1589288695, 2),
(102, 'departments', '10', 'whoami', 1589288695, 1589288695, 2),
(103, 'departments', '11', 'whoami', 1589288695, 1589288695, 2),
(104, 'departments', '12', 'whoami', 1589288695, 1589288695, 2),
(105, 'districts', '1', 'whoami', 1589288695, 1648129475, 2),
(106, 'districts', '2', 'whoami', 1589288695, 1648129485, 2),
(107, 'districts', '3', 'whoami', 1589288695, 1648129499, 2),
(108, 'districts', '4', 'whoami', 1589288695, 1648129509, 2),
(109, 'districts', '5', 'whoami', 1589288695, 1648129518, 2),
(110, 'districts', '6', 'whoami', 1589288695, 1648129527, 2),
(111, 'districts', '9', 'whoami', 1589288695, 1648129465, 2),
(112, 'districts', '10', 'whoami', 1589288695, 1648129542, 2),
(113, 'districts', '13', 'whoami', 1589288695, 1648129638, 2),
(114, 'districts', '14', 'whoami', 1589288695, 1648129594, 2),
(115, 'districts', '15', 'whoami', 1589288695, 1648129656, 2),
(116, 'districts', '16', 'whoami', 1589288695, 1648129674, 2),
(117, 'districts', '17', 'whoami', 1589288695, 1648129693, 2),
(118, 'districts', '18', 'whoami', 1589288695, 1648129710, 2),
(119, 'districts', '22', 'whoami', 1589288695, 1648129728, 2),
(120, 'districts', '24', 'whoami', 1589288695, 1648129745, 2),
(121, 'districts', '26', 'whoami', 1589288695, 1648129762, 2),
(122, 'districts', '27', 'whoami', 1589288695, 1648129848, 2),
(123, 'districts', '28', 'whoami', 1589288695, 1648129866, 2),
(124, 'districts', '32', 'whoami', 1589288695, 1648129882, 2),
(125, 'districts', '34', 'whoami', 1589288695, 1648129901, 2),
(126, 'districts', '35', 'whoami', 1589288695, 1648129922, 2),
(127, 'districts', '37', 'whoami', 1589288695, 1648129939, 2),
(128, 'districts', '38', 'whoami', 1589288695, 1648130074, 2),
(129, 'districts', '39', 'whoami', 1589288695, 1648130090, 2),
(130, 'districts', '40', 'whoami', 1589288695, 1648130116, 2),
(131, 'districts', '41', 'whoami', 1589288695, 1648130209, 2),
(132, 'districts', '42', 'whoami', 1589288695, 1648130225, 2),
(133, 'districts', '43', 'whoami', 1589288695, 1648130240, 2),
(134, 'districts', '45', 'whoami', 1589288695, 1648130254, 2),
(135, 'districts', '46', 'whoami', 1589288695, 1648130271, 2),
(136, 'districts', '50', 'whoami', 1589288695, 1648130287, 2),
(137, 'districts', '51', 'whoami', 1589288695, 1648130301, 2),
(138, 'districts', '52', 'whoami', 1589288695, 1648130316, 2),
(139, 'districts', '55', 'whoami', 1589288695, 1648130330, 2),
(140, 'districts', '58', 'whoami', 1589288695, 1648130345, 2),
(141, 'districts', '63', 'whoami', 1589288695, 1648130360, 2),
(142, 'districts', '67', 'whoami', 1589288695, 1648130374, 2),
(143, 'districts', '70', 'whoami', 1589288695, 1648130389, 2),
(144, 'districts', '71', 'whoami', 1589288695, 1648130404, 2),
(145, 'districts', '79', 'whoami', 1589288695, 1648195443, 2),
(146, 'districts', '82', 'whoami', 1589288695, 1648195461, 2),
(147, 'districts', '86', 'whoami', 1589288695, 1648195477, 2),
(148, 'districts', '87', 'whoami', 1589288695, 1648195496, 2),
(149, 'districts', '88', 'whoami', 1589288695, 1648195513, 2),
(150, 'districts', '91', 'whoami', 1589288695, 1648195528, 2),
(151, 'districts', '94', 'whoami', 1589288695, 1648195545, 2),
(152, 'districts', '98', 'whoami', 1589288695, 1648195563, 2),
(153, 'districts', '99', 'whoami', 1589288695, 1648195582, 2),
(154, 'districts', '105', 'whoami', 1589288695, 1648195598, 2),
(155, 'districts', '106', 'whoami', 1589288695, 1589288695, 2),
(156, 'districts', '107', 'whoami', 1589288695, 1589288695, 2),
(157, 'districts', '108', 'whoami', 1589288695, 1589288695, 2),
(158, 'districts', '109', 'whoami', 1589288695, 1589288695, 2),
(159, 'districts', '110', 'whoami', 1589288695, 1589288695, 2),
(160, 'districts', '111', 'whoami', 1589288695, 1589288695, 2),
(161, 'districts', '112', 'whoami', 1589288695, 1589288695, 2),
(162, 'districts', '113', 'whoami', 1589288695, 1589288695, 2),
(163, 'districts', '114', 'whoami', 1589288695, 1589288695, 2),
(164, 'districts', '115', 'whoami', 1589288695, 1589288695, 2),
(165, 'districts', '116', 'whoami', 1589288695, 1589288695, 2),
(166, 'districts', '117', 'whoami', 1589288695, 1589288695, 2),
(167, 'districts', '118', 'whoami', 1589288695, 1589288695, 2),
(168, 'application_status', '1', 'whoami', 1589288695, 1589288695, 2),
(169, 'application_status', '2', 'whoami', 1589288695, 1589288695, 2),
(170, 'application_status', '3', 'whoami', 1589288695, 1589288695, 2),
(171, 'application_status', '4', 'whoami', 1589288695, 1589288695, 2),
(172, 'application_status', '5', 'whoami', 1589288695, 1589288695, 2),
(173, 'service_categories', '1', 'whoami', 1589288695, 1589288695, 2),
(174, 'service_categories', '2', 'whoami', 1589288695, 1589288695, 2),
(175, 'service_categories', '3', 'whoami', 1589288695, 1589288695, 2),
(176, 'service_categories', '4', 'whoami', 1589288695, 1589288695, 2),
(177, 'service_categories', '5', 'whoami', 1589288695, 1589288695, 2),
(178, 'service_item_type', '1', 'whoami', 1589288695, 1589288695, 2),
(179, 'service_item_type', '2', 'whoami', 1589288695, 1589288695, 2),
(180, 'service_item_type', '3', 'whoami', 1589288695, 1589288695, 2),
(181, 'service_item_type', '4', 'whoami', 1589288695, 1589288695, 2),
(182, 'service_item_type', '5', 'whoami', 1589288695, 1589288695, 2),
(183, 'service_item_type', '6', 'whoami', 1589288695, 1589288695, 2),
(184, 'service_item_type', '7', 'whoami', 1589288695, 1589288695, 2),
(185, 'service_item_type', '8', 'whoami', 1589288695, 1589288695, 2),
(186, 'service_item_type', '9', 'whoami', 1589288695, 1589288695, 2),
(187, 'service_item_type', '10', 'whoami', 1589288695, 1589288695, 2),
(188, 'service_item_type', '11', 'whoami', 1589288695, 1589288695, 2),
(189, 'service_item_type', '12', 'whoami', 1589288695, 1589288695, 2),
(190, 'service_item_type', '13', 'whoami', 1589288695, 1589288695, 2),
(191, 'service_item_type', '14', 'whoami', 1589288695, 1589288695, 2),
(192, 'service_item_type', '15', 'whoami', 1589288695, 1589288695, 2),
(193, 'service_item_type', '16', 'whoami', 1589288695, 1589288695, 2),
(194, 'service_item_type', '17', 'whoami', 1589288695, 1589288695, 2),
(195, 'service_item_type', '18', 'whoami', 1589288695, 1589288695, 2),
(196, 'service_item_type', '19', 'whoami', 1589288695, 1589288695, 2),
(197, 'service_item_type', '20', 'whoami', 1589288695, 1589288695, 2),
(198, 'service_item_type', '21', 'whoami', 1589288695, 1589288695, 2),
(199, 'service_item_type', '22', 'whoami', 1589288695, 1589288695, 2),
(200, 'service_item_type', '23', 'whoami', 1589288695, 1589288695, 2),
(201, 'service_item_type', '24', 'whoami', 1589288695, 1589288695, 2),
(202, 'service_item_type', '25', 'whoami', 1589288695, 1589288695, 2),
(203, 'service_item_type', '26', 'whoami', 1589288695, 1589288695, 2),
(204, 'service_item_type', '27', 'whoami', 1589288695, 1589288695, 2),
(205, 'service_item_type', '28', 'whoami', 1589288695, 1589288695, 2),
(206, 'service_item_type', '29', 'whoami', 1589288695, 1589288695, 2),
(207, 'service_item_type', '30', 'whoami', 1589288695, 1589288695, 2),
(208, 'service_item_type', '31', 'whoami', 1589288695, 1589288695, 2),
(209, 'service_item_type', '32', 'whoami', 1589288695, 1589288695, 2),
(210, 'service_item_type', '33', 'whoami', 1589288695, 1589288695, 2),
(211, 'service_item_type', '34', 'whoami', 1589288695, 1589288695, 2),
(212, 'service_item_type', '35', 'whoami', 1589288695, 1589288695, 2),
(213, 'service_item_type', '36', 'whoami', 1589288695, 1589288695, 2),
(214, 'service_item_type', '37', 'whoami', 1589288695, 1589288695, 2),
(215, 'service_item_type', '38', 'whoami', 1589288695, 1589288695, 2),
(216, 'service_item_type', '39', 'whoami', 1589288695, 1589288695, 2),
(217, 'service_item_type', '40', 'whoami', 1589288695, 1589288695, 2),
(218, 'service_item_type', '41', 'whoami', 1589288695, 1589288695, 2),
(219, 'service_item_type', '42', 'whoami', 1589288695, 1589288695, 2),
(220, 'service_item_type', '43', 'whoami', 1589288695, 1589288695, 2),
(221, 'service_item_type', '44', 'whoami', 1589288695, 1589288695, 2),
(222, 'service_item_type', '45', 'whoami', 1589288695, 1589288695, 2),
(223, 'service_item_type', '46', 'whoami', 1589288695, 1589288695, 2),
(224, 'service_item_type', '47', 'whoami', 1589288695, 1589288695, 2),
(225, 'service_item_type', '48', 'whoami', 1589288695, 1589288695, 2),
(226, 'service_item_type', '49', 'whoami', 1589288695, 1589288695, 2),
(227, 'service_item_type', '50', 'whoami', 1589288695, 1589288695, 2),
(228, 'service_item_type', '51', 'whoami', 1589288695, 1589288695, 2),
(229, 'service_item_type', '52', 'whoami', 1589288695, 1589288695, 2),
(230, 'service_item_type', '53', 'whoami', 1589288695, 1589288695, 2),
(231, 'service_item_type', '54', 'whoami', 1589288695, 1589288695, 2),
(232, 'service_item_type', '55', 'whoami', 1589288695, 1589288695, 2),
(233, 'service_item_type', '56', 'whoami', 1589288695, 1589288695, 2),
(234, 'service_item_type', '57', 'whoami', 1589288695, 1589288695, 2),
(235, 'service_item_type', '58', 'whoami', 1589288695, 1589288695, 2),
(236, 'service_item_type', '59', 'whoami', 1589288695, 1589288695, 2),
(237, 'service_item_type', '60', 'whoami', 1589288695, 1589288695, 2),
(238, 'service_item_type', '61', 'whoami', 1589288695, 1589288695, 2),
(239, 'service_item_type', '62', 'whoami', 1589288695, 1589288695, 2),
(240, 'service_item_type', '63', 'whoami', 1589288695, 1589288695, 2),
(241, 'service_item', '1', 'whoami', 1589288695, 1589288695, 2),
(242, 'service_item', '2', 'whoami', 1589288695, 1589288695, 2),
(243, 'service_item', '3', 'whoami', 1589288695, 1589288695, 2),
(244, 'service_item', '4', 'whoami', 1589288695, 1589288695, 2),
(245, 'service_item', '5', 'whoami', 1589288695, 1589288695, 2),
(246, 'purchase_orders', '1', 'whoami', 1589288696, 1589288696, 2),
(247, 'transmission', '1', 'whoami', 1589288696, 1589288696, 2),
(248, 'transmission', '2', 'whoami', 1589288696, 1589288696, 2),
(249, 'transmission', '3', 'whoami', 1589288696, 1589288696, 2),
(250, 'fuel_type', '1', 'whoami', 1589288696, 1589288696, 2),
(251, 'fuel_type', '2', 'whoami', 1589288696, 1589288696, 2),
(252, 'fuel_type', '3', 'whoami', 1589288696, 1589288696, 2),
(253, 'fuel_type', '4', 'whoami', 1589288696, 1589288696, 2),
(254, 'fuel_type', '5', 'whoami', 1589288696, 1589288696, 2),
(255, 'fuel_type', '6', 'whoami', 1589288696, 1589288696, 2),
(256, 'fuel_type', '7', 'whoami', 1589288696, 1589288696, 2),
(257, 'fuel_type', '8', 'whoami', 1589288696, 1589288696, 2),
(258, 'merchant', '1', 'whoami', 1589288696, 1589288696, 2),
(259, 'merchant_type', '1', 'whoami', 1589288696, 1589288696, 2),
(260, 'merchant_type', '2', 'whoami', 1589288696, 1589288696, 2),
(261, 'manufacturer', '4', 'whoami', 1589288696, 1589288696, 2),
(262, 'manufacturer', '2', 'whoami', 1589288696, 1589288696, 2),
(263, 'manufacturer', '3', 'whoami', 1589288696, 1589288696, 2),
(264, 'manufacturer', '1', 'whoami', 1589288696, 1589288696, 2),
(265, 'manufacturer', '5', 'whoami', 1589288696, 1589288696, 2),
(266, 'manufacturer_type', '1', 'whoami', 1589288696, 1589288696, 2),
(267, 'manufacturer_type', '2', 'whoami', 1589288696, 1589288696, 2),
(268, 'manufacturer_type', '3', 'whoami', 1589288696, 1589288696, 2),
(269, 'manufacturer_type', '4', 'whoami', 1589288696, 1589288696, 2),
(270, 'manufacturer_type', '5', 'whoami', 1589288696, 1589288696, 2),
(271, 'manufacturer_type', '6', 'whoami', 1589288696, 1589288696, 2),
(272, 'driver', '1', 'whoami', 1589288696, 1589288696, 2),
(273, 'claim_status', '1', 'whoami', 1589288696, 1589288696, 2),
(274, 'claim_status', '2', 'whoami', 1589288696, 1589288696, 2),
(275, 'claim_status', '3', 'whoami', 1589288696, 1589288696, 2),
(276, 'claim_status', '4', 'whoami', 1589288696, 1589288696, 2),
(277, 'claim_category', '1', 'whoami', 1589288696, 1589288696, 2),
(278, 'claim_category', '2', 'whoami', 1589288696, 1589288696, 2),
(279, 'claim_category', '3', 'whoami', 1589288696, 1589288696, 2),
(280, 'claim_category', '4', 'whoami', 1589288696, 1589288696, 2),
(281, 'claim_category', '5', 'whoami', 1589288696, 1589288696, 2),
(282, 'cost_centre', '1', 'whoami', 1589288696, 1589288696, 2),
(283, 'dealer', '1', 'whoami', 1589288696, 1589288696, 2),
(284, 'dealer', '2', 'whoami', 1589288696, 1589288696, 2),
(285, 'dealer', '3', 'whoami', 1589288696, 1589288696, 2),
(286, 'dealer', '4', 'whoami', 1589288696, 1589288696, 2),
(287, 'dealer', '5', 'whoami', 1589288696, 1589288696, 2),
(288, 'dealer', '6', 'whoami', 1589288696, 1589288696, 2),
(289, 'dealer', '7', 'whoami', 1589288696, 1589288696, 2),
(290, 'dealer_type', '1', 'whoami', 1589288696, 1589288696, 2),
(291, 'dealer_type', '2', 'whoami', 1589288696, 1589288696, 2),
(292, 'dealer_type', '3', 'whoami', 1589288696, 1589288696, 2),
(293, 'vehicle_daily_check_list', '1', 'whoami', 1589288697, 1589288697, 2),
(294, 'parts', '1', 'whoami', 1589288697, 1648747601, 2),
(295, 'parts_type', '1', 'whoami', 1589288697, 1589288697, 2),
(296, 'parts_type', '2', 'whoami', 1589288697, 1589288697, 2),
(297, 'parts_type', '3', 'whoami', 1589288697, 1589288697, 2),
(298, 'parts_type', '4', 'whoami', 1589288697, 1589288697, 2),
(299, 'parts_type', '5', 'whoami', 1589288697, 1589288697, 2),
(300, 'reception', '1', 'whoami', 1589288697, 1648726759, 2),
(301, 'reception', '2', 'whoami', 1589288697, 1648726791, 2),
(302, 'work_allocation', '1', 'whoami', 1589288697, 1648794773, 2),
(303, 'work_allocation', '2', 'whoami', 1589288697, 1648794827, 2),
(304, 'gmt_fleet_register', '1', 'whoami', 1648124909, 1652098558, 2),
(305, 'gmt_fleet_register', '2', 'whoami', 1648124909, 1652100198, 2),
(308, 'breakdown_services', '1', 'whoami', 1648124909, 1648806794, 2),
(309, 'modification_to_vehicle', '1', 'whoami', 1648124909, 1648740874, 2),
(310, 'forms', '1', 'whoami', 1648124909, 1648124909, 2),
(311, 'general_control_measures', '1', 'whoami', 1648124909, 1648124909, 2),
(312, 'cost_centre', '2', 'whoami', 1648197886, 1648197886, 2),
(313, 'cost_centre', '3', 'whoami', 1648197905, 1648197905, 2),
(314, 'cost_centre', '4', 'whoami', 1648197923, 1648197923, 2),
(315, 'cost_centre', '5', 'whoami', 1648197941, 1648197946, 2),
(316, 'claim', '1', 'whoami', 1648742036, 1648743355, 2),
(317, 'claim', '2', 'whoami', 1648742293, 1648743398, 2),
(318, 'authorizations', '1', 'whoami', 1648797024, 1648797024, 2),
(319, 'authorizations', '2', 'whoami', 1648797176, 1648797220, 2),
(321, 'dealer', '8', '81971460', 1652083521, 1652083521, 2),
(322, 'driver', '2', '81971460', 1652083934, 1652083960, 2),
(323, 'gmt_fleet_register', '3', '81971460', 1652084077, 1652084077, 2),
(324, 'gmt_fleet_register', '4', '81971460', 1652087580, 1652087580, 2),
(325, 'gmt_fleet_register', '5', '81971460', 1652088068, 1652088068, 2),
(326, 'gmt_fleet_register', '6', '81971460', 1652088343, 1652088343, 2),
(327, 'gmt_fleet_register', '7', '81971460', 1652089122, 1652089351, 2),
(328, 'gmt_fleet_register', '8', '81971460', 1652090193, 1652090193, 2),
(329, 'gmt_fleet_register', '9', '81971460', 1652090472, 1652090472, 2),
(330, 'gmt_fleet_register', '10', '81971460', 1652090721, 1652090721, 2),
(331, 'gmt_fleet_register', '11', '81971460', 1652098210, 1652098210, 2),
(332, 'gmt_fleet_register', '12', '80207456', 1652099675, 1652099675, 2),
(333, 'gmt_fleet_register', '13', '80207456', 1652100370, 1652106114, 2),
(334, 'gmt_fleet_register', '14', '81971460', 1652100561, 1652100561, 2),
(335, 'gmt_fleet_register', '15', '81971460', 1652101449, 1652101449, 2),
(336, 'year_model', '20', '81971460', 1652102899, 1652102899, 2),
(337, 'gmt_fleet_register', '16', '81971460', 1652103063, 1652103063, 2),
(338, 'body_type', '16', '81971460', 1652103245, 1652103245, 2),
(339, 'gmt_fleet_register', '17', '81971460', 1652103408, 1652103408, 2),
(340, 'gmt_fleet_register', '18', '81971460', 1652103648, 1652103648, 2),
(341, 'dealer', '9', '81971460', 1652105085, 1652105085, 2),
(342, 'gmt_fleet_register', '19', '81971460', 1652105315, 1652105315, 2),
(343, 'gmt_fleet_register', '20', '81971460', 1652106363, 1652106363, 2),
(344, 'dealer', '10', '80207456', 1652107752, 1652107752, 2),
(345, 'gmt_fleet_register', '21', '81971460', 1652107908, 1652107908, 2),
(346, 'body_type', '17', '81971460', 1652108182, 1652108186, 2),
(347, 'gmt_fleet_register', '22', '80207456', 1652108319, 1652108319, 2),
(348, 'gmt_fleet_register', '23', '80207456', 1652108751, 1652108751, 2),
(349, 'gmt_fleet_register', '24', '81971460', 1652108828, 1652109372, 2),
(350, 'gmt_fleet_register', '25', '80207456', 1652109261, 1652109261, 2),
(351, 'gmt_fleet_register', '26', '81971460', 1652109652, 1652109652, 2),
(352, 'gmt_fleet_register', '27', '80207456', 1652109719, 1652109719, 2),
(353, 'gmt_fleet_register', '28', '80205411', 1652109721, 1652109721, 2),
(354, 'gmt_fleet_register', '29', '81971460', 1652109916, 1652109916, 2),
(355, 'gmt_fleet_register', '30', '81971460', 1652110234, 1652110234, 2),
(356, 'gmt_fleet_register', '31', '81971460', 1652110543, 1652110543, 2),
(357, 'gmt_fleet_register', '32', '80205411', 1652110614, 1652110614, 2),
(358, 'gmt_fleet_register', '33', '81971460', 1652110816, 1652110816, 2),
(359, 'gmt_fleet_register', '34', '80207456', 1652110817, 1652110817, 2),
(360, 'gmt_fleet_register', '35', '80207456', 1652111187, 1652111187, 2),
(361, 'departments', '13', '81971460', 1652111218, 1652111218, 2),
(362, 'gmt_fleet_register', '36', '80205411', 1652111381, 1652111381, 2),
(363, 'gmt_fleet_register', '37', '80207456', 1652111629, 1652111629, 2),
(364, 'gmt_fleet_register', '38', '81971460', 1652111768, 1652111768, 2),
(365, 'gmt_fleet_register', '39', '80207456', 1652111987, 1652111987, 2),
(366, 'gmt_fleet_register', '40', '81971460', 1652111996, 1652111996, 2),
(367, 'gmt_fleet_register', '41', '80207456', 1652112387, 1652112387, 2),
(368, 'gmt_fleet_register', '42', '80205411', 1652112388, 1652112388, 2),
(369, 'gmt_fleet_register', '43', '80205411', 1652112786, 1652112786, 2),
(370, 'gmt_fleet_register', '44', '80207456', 1652112812, 1652112812, 2),
(371, 'dealer', '11', '81971460', 1652113201, 1652113205, 2),
(372, 'gmt_fleet_register', '45', '80207456', 1652113244, 1652113244, 2),
(373, 'body_type', '18', '81971460', 1652113369, 1652113369, 2),
(374, 'gmt_fleet_register', '46', '81971460', 1652113489, 1652113489, 2),
(375, 'gmt_fleet_register', '47', '80205411', 1652113659, 1652113659, 2),
(376, 'gmt_fleet_register', '48', '80207456', 1652113854, 1652113854, 2),
(377, 'gmt_fleet_register', '49', '80205411', 1652114324, 1652114324, 2),
(378, 'gmt_fleet_register', '50', '80207456', 1652114358, 1652114358, 2),
(379, 'gmt_fleet_register', '51', '80205411', 1652115061, 1652115061, 2),
(380, 'gmt_fleet_register', '52', '80207456', 1652115238, 1652115238, 2),
(381, 'gmt_fleet_register', '53', '80207456', 1652115801, 1652115801, 2),
(382, 'gmt_fleet_register', '54', '81971460', 1652164097, 1652164097, 2),
(383, 'gmt_fleet_register', '55', '80207456', 1652164536, 1652164536, 2),
(384, 'gmt_fleet_register', '56', '80207456', 1652167026, 1652167026, 2),
(385, 'gmt_fleet_register', '57', '81971460', 1652184968, 1652184968, 2),
(386, 'gmt_fleet_register', '58', '81971460', 1652185197, 1652185197, 2),
(387, 'dealer', '12', '81971460', 1652185272, 1652185272, 2),
(388, 'dealer', '13', '81971460', 1652185309, 1652185309, 2),
(389, 'gmt_fleet_register', '59', '81971460', 1652185485, 1652185485, 2),
(390, 'gmt_fleet_register', '60', '81971460', 1652185726, 1652185726, 2),
(391, 'gmt_fleet_register', '61', '81971460', 1652188652, 1652188652, 2),
(392, 'gmt_fleet_register', '62', '81971460', 1652188883, 1652188883, 2),
(393, 'body_type', '19', '81971460', 1652189240, 1652189240, 2),
(394, 'gmt_fleet_register', '63', '81971460', 1652189345, 1652189406, 2),
(395, 'gmt_fleet_register', '64', '81971460', 1652189661, 1652189661, 2),
(396, 'gmt_fleet_register', '65', '80207456', 1652189717, 1652189717, 2),
(397, 'gmt_fleet_register', '66', '80207456', 1652190129, 1652190129, 2),
(398, 'gmt_fleet_register', '67', '81971460', 1652190285, 1652190285, 2),
(399, 'gmt_fleet_register', '68', '80207456', 1652190520, 1652190520, 2),
(400, 'gmt_fleet_register', '69', '80207456', 1652190975, 1652190975, 2),
(401, 'gmt_fleet_register', '70', '81971460', 1652191306, 1652191306, 2),
(402, 'gmt_fleet_register', '71', '80207456', 1652191598, 1652192327, 2),
(403, 'gmt_fleet_register', '72', '81971460', 1652192120, 1652192120, 2),
(404, 'gmt_fleet_register', '73', '80207456', 1652192250, 1652192357, 2),
(405, 'gmt_fleet_register', '74', '81971460', 1652192368, 1652192368, 2),
(406, 'gmt_fleet_register', '75', '80207456', 1652192671, 1652192671, 2),
(407, 'gmt_fleet_register', '76', '81971460', 1652192723, 1652192723, 2),
(408, 'gmt_fleet_register', '77', '80207456', 1652192944, 1652192944, 2),
(409, 'gmt_fleet_register', '78', '80207456', 1652193172, 1652193172, 2),
(410, 'gmt_fleet_register', '79', '80207456', 1652193441, 1652193441, 2),
(411, 'gmt_fleet_register', '80', '80207456', 1652193660, 1652193660, 2),
(412, 'gmt_fleet_register', '81', '80207456', 1652194043, 1652194043, 2),
(413, 'gmt_fleet_register', '82', '80207456', 1652194314, 1652194314, 2),
(414, 'gmt_fleet_register', '83', '80207456', 1652194584, 1652195199, 2),
(415, 'gmt_fleet_register', '84', '80207456', 1652194847, 1652195240, 2),
(416, 'gmt_fleet_register', '85', '80207456', 1652195093, 1652195093, 2),
(417, 'gmt_fleet_register', '86', '80207456', 1652195519, 1652195519, 2),
(418, 'gmt_fleet_register', '87', '81971460', 1652195835, 1652195835, 2),
(419, 'gmt_fleet_register', '88', '80207456', 1652195848, 1652195848, 2),
(420, 'gmt_fleet_register', '89', '81971460', 1652196119, 1652196119, 2),
(421, 'gmt_fleet_register', '90', '80207456', 1652196121, 1652196121, 2),
(422, 'gmt_fleet_register', '91', '81971460', 1652196523, 1652196523, 2),
(423, 'gmt_fleet_register', '92', '80207456', 1652196565, 1652196565, 2),
(424, 'gmt_fleet_register', '93', '80207456', 1652196881, 1652196881, 2),
(425, 'gmt_fleet_register', '94', '80205411', 1652196895, 1652196895, 2),
(426, 'gmt_fleet_register', '95', '81971460', 1652196941, 1652196941, 2),
(427, 'gmt_fleet_register', '96', '80207456', 1652197116, 1652197116, 2),
(428, 'gmt_fleet_register', '97', '80205411', 1652197216, 1652197216, 2),
(429, 'gmt_fleet_register', '98', '80207456', 1652197354, 1652197354, 2),
(430, 'gmt_fleet_register', '99', '80207456', 1652197588, 1652197588, 2),
(431, 'gmt_fleet_register', '100', '80205411', 1652197730, 1652197730, 2),
(432, 'gmt_fleet_register', '101', '80207456', 1652197818, 1652197818, 2),
(433, 'gmt_fleet_register', '102', '80207456', 1652198056, 1652198056, 2),
(434, 'gmt_fleet_register', '103', '80205411', 1652198209, 1652198209, 2),
(435, 'gmt_fleet_register', '104', '80207456', 1652198288, 1652198288, 2),
(436, 'gmt_fleet_register', '105', '80207456', 1652198704, 1652198704, 2),
(437, 'gmt_fleet_register', '106', '80207456', 1652199348, 1652199348, 2),
(438, 'gmt_fleet_register', '107', '80207456', 1652199816, 1652199816, 2),
(439, 'gmt_fleet_register', '108', '80205411', 1652199923, 1652199923, 2),
(440, 'gmt_fleet_register', '109', '80205411', 1652200297, 1652200297, 2),
(441, 'gmt_fleet_register', '110', '80207456', 1652200870, 1652200870, 2),
(442, 'gmt_fleet_register', '111', '80205411', 1652200890, 1652200890, 2),
(443, 'gmt_fleet_register', '112', '81971460', 1652200998, 1652200998, 2),
(444, 'gmt_fleet_register', '113', '80207456', 1652201131, 1652201131, 2),
(445, 'gmt_fleet_register', '114', '81971460', 1652201184, 1652201184, 2),
(446, 'gmt_fleet_register', '115', '80207456', 1652201491, 1652201491, 2),
(447, 'gmt_fleet_register', '116', '80205411', 1652201805, 1652201805, 2),
(448, 'gmt_fleet_register', '117', '80205411', 1652202136, 1652202136, 2),
(449, 'gmt_fleet_register', '118', '80205411', 1652202489, 1652202489, 2),
(450, 'gmt_fleet_register', '150', 'whoami', 1652291221, 1652291221, 2),
(451, 'gmt_fleet_register', '119', 'whoami', 1652291318, 1652291318, 2),
(452, 'gmt_fleet_register', '120', 'whoami', 1652291318, 1652291318, 2),
(453, 'gmt_fleet_register', '121', 'whoami', 1652291318, 1652291318, 2),
(454, 'gmt_fleet_register', '122', 'whoami', 1652291318, 1652291318, 2),
(455, 'gmt_fleet_register', '123', 'whoami', 1652291318, 1652291318, 2),
(456, 'gmt_fleet_register', '124', 'whoami', 1652291318, 1652291318, 2),
(457, 'gmt_fleet_register', '125', 'whoami', 1652291318, 1652291318, 2),
(458, 'gmt_fleet_register', '126', 'whoami', 1652291318, 1652291318, 2),
(459, 'gmt_fleet_register', '127', 'whoami', 1652291318, 1652291318, 2),
(460, 'gmt_fleet_register', '128', 'whoami', 1652291318, 1652291318, 2),
(461, 'gmt_fleet_register', '129', 'whoami', 1652291318, 1652291318, 2),
(462, 'gmt_fleet_register', '130', 'whoami', 1652291318, 1652291318, 2),
(463, 'gmt_fleet_register', '131', 'whoami', 1652291318, 1652291318, 2),
(464, 'gmt_fleet_register', '132', 'whoami', 1652291318, 1652291318, 2),
(465, 'gmt_fleet_register', '133', 'whoami', 1652291318, 1652291318, 2),
(466, 'gmt_fleet_register', '134', 'whoami', 1652291318, 1652291318, 2),
(467, 'gmt_fleet_register', '135', 'whoami', 1652291318, 1652291318, 2),
(468, 'gmt_fleet_register', '136', 'whoami', 1652291318, 1652291318, 2),
(469, 'gmt_fleet_register', '137', 'whoami', 1652291318, 1652291318, 2),
(470, 'gmt_fleet_register', '138', 'whoami', 1652291318, 1652291318, 2),
(471, 'gmt_fleet_register', '139', 'whoami', 1652291318, 1652291318, 2),
(472, 'gmt_fleet_register', '140', 'whoami', 1652291318, 1652291318, 2),
(473, 'gmt_fleet_register', '141', 'whoami', 1652291318, 1652291318, 2),
(474, 'gmt_fleet_register', '142', 'whoami', 1652291318, 1652291318, 2),
(475, 'gmt_fleet_register', '143', 'whoami', 1652291318, 1652291318, 2),
(476, 'gmt_fleet_register', '144', 'whoami', 1652291318, 1652291318, 2),
(477, 'gmt_fleet_register', '145', 'whoami', 1652291318, 1652291318, 2),
(478, 'gmt_fleet_register', '146', 'whoami', 1652291318, 1652291318, 2),
(479, 'gmt_fleet_register', '147', 'whoami', 1652291318, 1652291318, 2),
(480, 'gmt_fleet_register', '148', 'whoami', 1652291318, 1652291318, 2),
(481, 'gmt_fleet_register', '149', 'whoami', 1652291318, 1652291318, 2);

-- --------------------------------------------------------

--
-- Table structure for table `membership_users`
--

DROP TABLE IF EXISTS `membership_users`;
CREATE TABLE IF NOT EXISTS `membership_users` (
  `memberID` varchar(100) NOT NULL,
  `passMD5` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `signupDate` date DEFAULT NULL,
  `groupID` int UNSIGNED DEFAULT NULL,
  `isBanned` tinyint DEFAULT NULL,
  `isApproved` tinyint DEFAULT NULL,
  `custom1` text,
  `custom2` text,
  `custom3` text,
  `custom4` text,
  `comments` text,
  `pass_reset_key` varchar(100) DEFAULT NULL,
  `pass_reset_expiry` int UNSIGNED DEFAULT NULL,
  `flags` text,
  `allowCSVImport` tinyint NOT NULL DEFAULT '0',
  `data` longtext,
  PRIMARY KEY (`memberID`),
  KEY `groupID` (`groupID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `membership_users`
--

INSERT INTO `membership_users` (`memberID`, `passMD5`, `email`, `signupDate`, `groupID`, `isBanned`, `isApproved`, `custom1`, `custom2`, `custom3`, `custom4`, `comments`, `pass_reset_key`, `pass_reset_expiry`, `flags`, `allowCSVImport`, `data`) VALUES
('guest', NULL, NULL, '2022-03-14', 1, 0, 1, NULL, NULL, NULL, NULL, 'Anonymous member created automatically on 2022-03-14', NULL, NULL, NULL, 0, NULL),
('whoami', '$2y$10$HB2wVj/2BopLTGaVpqz9N.hmQ5mmT6ccnS1RYrRFTa4rm2KRFQg7u', '82080097@dtcs.limpopo.gov.za', '2022-03-14', 2, 0, 1, NULL, NULL, NULL, NULL, 'Admin member created automatically on 2022-03-14\nRecord updated automatically on 2022-03-15\nRecord updated automatically on 2022-04-03\nRecord updated automatically on 2022-04-03', NULL, NULL, NULL, 0, NULL),
('12345678', '87d026dbf8a43d90292525d3962348a4', 'masogam@dot.limpopo.gov.za', '2015-05-29', 2, 0, 1, 'Masoga Mosima', '40 Pres Paul Krugers str, Phamoko Towers,', 'Polokwane', 'Limpopo', '', NULL, NULL, NULL, 0, NULL),
('80066241', 'eb553780cbf79034aec1f5fb40578592', 'mathebulax@dot.limpopo.gov.za', '2015-05-29', 2, 0, 1, 'Mathebula Xirhandziwa', '40 Pres Paul Krugers str, Phamoko Towers,', 'Polokwane', 'Limpopo', '', NULL, NULL, NULL, 0, NULL),
('80188729', '5ef1aa132d29be4ffa38c7ce7f6795c2', 'nekhumbee@dot.limpopo.gov.za', '2015-05-29', 2, 0, 1, 'Nekhumbe Eric', '40 Pres Paul Krugers str, Phamoko Towers,', 'Polokwane', 'Limpopo', '', NULL, NULL, NULL, 0, NULL),
('80189628', '97e28887bcea83e8689968fdb0d8b5f4', 'rembuluwanib@dot.limpopo.gov.za', '2015-05-29', 2, 0, 1, 'Rembuluwani Botha', '40 Pres Paul Krugers str, Phamoko Towers,', 'Polokwane', 'Limpopo', '', NULL, NULL, NULL, 0, NULL),
('80206123', '94cea4b68bf2bb033088c3573fe50fdd', 'tholes@dot.limpopo.gov.za', '2015-05-29', 2, 0, 1, 'Thole Seete Solomon', '40 Pres Paul Krugers str, Phamoko Towers,', 'Polokwane', 'Limpopo', '', NULL, NULL, NULL, 0, NULL),
('80206247', '1e48448554e5f112b0a20d3dcef07047', 'moloper@dot.limpopo.gov.za', '2015-05-29', 2, 0, 1, 'Raisibe Molope', 'Phamoko Towers , LDoT Head Office', 'Polokwane', 'Limpopo', '', NULL, NULL, NULL, 0, NULL),
('80206701', 'ec7a485a1de197269f2731565a43462b', 'senthumulet@dot.limpopo.gov.za', '2015-05-29', 2, 0, 1, 'Tebogo Senthumule', 'Phamoko Towers , LDoT Head Office', 'Polokwane', 'Limpopo', '', NULL, NULL, NULL, 0, NULL),
('80206751', '519b032082b7189017ac4fb082dbe2cf', 'phaahlae@dot.limpopo.gov.za', '2015-05-29', 2, 0, 1, 'Phaahla Edith Madipoane', '40 Pres Paul Krugers str, Phamoko Towers,', 'Polokwane', 'Limpopo', '', NULL, NULL, NULL, 0, NULL),
('8020722', '4e2e2bb844b91a90287858b7a2ec5ebb', 'selolom@dot.limpopo.gov.za', '2015-05-29', 2, 0, 1, 'Manare Selolo', '40 Pres Paul Krugers str, Phamoko Towers,', 'Polokwane', 'Limpopo', '', NULL, NULL, NULL, 0, NULL),
('80207456', '$2y$10$9M97Ey.aJgYEu5dFUs6k0OXpb7KUZVU/cn9YNdkS3hyjpRhOBYnFG', 'ribaj@dot.limpopo.gov.za', '2015-05-29', 2, 0, 1, 'Joseph Riba', '40 Pres Paul Kruger str, Phamaoko Towers', 'Polokwane', 'Limpopo', '', NULL, NULL, NULL, 0, NULL),
('80207880', 'e9a93a1f48a4fb487ffd2bd5d57ca63f', 'thobejanem@dot.limpopo.gov.za', '2016-05-05', 2, 0, 1, 'Matsobane Matthews Thobejane', '40 Pres Paul Kruger street, Phamako Towers', 'Polokwane', 'Limpopo', '', NULL, NULL, NULL, 0, NULL),
('80258433', 'df37d9686b81bfb549bdcfb5ca8eddea', 'mashilat@dot.limpopo.gov.za', '2015-05-29', 2, 0, 1, 'Mashila Thomas', '40 Pres Paul Krugers str, Phamoko Towers,', 'Polokwane', 'Limpopo', '', NULL, NULL, NULL, 0, NULL),
('81071558', '533341599be361c14bde827b7b593193', 'mabundzak@dot.limpopo.gov.za', '2015-05-29', 2, 0, 1, 'Mabundza Kufeni Section', '40 Pres Paul Krugers str, Phamoko Towers,', 'Polokwane', 'Limpopo', '', NULL, NULL, NULL, 0, NULL),
('81292571', '33803cdf662ae653820c4b7200272202', 'mashothlap@dot.limpopo.gov.za', '2015-05-29', 2, 0, 1, 'Mashothla Phorabatho', '40 Pres Paul Krugers str, Phamoko Towers,', 'Polokwane', 'Limpopo', '', NULL, NULL, NULL, 0, NULL),
('81971460', '$2y$10$hNAqMu1OgVxfzMsmK40rA.nZ2/wSUkM110zLt720pVEC9xBlM9KP6', 'mphaphulir@dot.limpopo.gov.za', '2015-05-29', 2, 0, 1, 'Reggy Mphaphuli', 'LDoT, Phamoko Towers,C/o Church Str 39 & Bodenstein Str', 'Polokwane', 'Limpopo', 'Capture history details of auctioned vehicles', NULL, NULL, NULL, 0, NULL),
('82238367', 'd5dd5aed0faa9e9d0594aa96431eb689', 'schraderm@dot.lilpopo.gov.za', '2015-05-29', 2, 0, 1, 'Martha Schrader', '40 Pres Paul Krugers str, Phamoko Towers,', 'Polokwane', 'Polokwane', '', NULL, NULL, NULL, 0, NULL),
('82414181', '33ee226991c5025c6b0721835f539b47', 'mogodim@dot.limpopo.gov.za', '2015-05-29', 2, 0, 1, 'Nancy Mogodi', '39 Pres Paul Kruger str, Phamaoko Towers', 'Polokwane', 'Limpopo', '', NULL, NULL, NULL, 0, NULL),
('82504741', 'cfcf7dc78d4c7b245fa867e047d85cbf', 'mookam@dot.limpopo.gov.za', '2015-05-29', 2, 0, 1, 'Marcus Mooka', '40 Pres Paul Krugers str, Phamoko Towers,', 'Polokwane', 'Limpopo', '', NULL, NULL, NULL, 0, NULL),
('84216123', 'f32866f0e5aa5c8d2ecfe156de152f4a', 'mabalaj@dot.limpopo.gov.za', '2017-11-14', 2, 0, 1, 'J Mabala', '40 Pres Paul Kruger street', 'Polokwane', 'Limpopo', '', NULL, NULL, NULL, 0, NULL),
('80205411', '$2y$10$zy2rE0LU7eUui9Sn6yEq8uD4wDF3GxCZ00zieHvN8PnCcuYbzsIMe', 'seakamelam@dtcs.limpopo.gov.za', '2022-05-09', 2, 0, 1, 'Seakamela M.P', '40 Pres Paul Kruger street, Phamako Towers', 'Polokwane', 'Limpopo Province', 'Seakamela2022!', NULL, NULL, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `membership_usersessions`
--

DROP TABLE IF EXISTS `membership_usersessions`;
CREATE TABLE IF NOT EXISTS `membership_usersessions` (
  `memberID` varchar(100) NOT NULL,
  `token` varchar(100) NOT NULL,
  `agent` varchar(100) NOT NULL,
  `expiry_ts` int UNSIGNED NOT NULL,
  UNIQUE KEY `memberID_token_agent` (`memberID`,`token`,`agent`),
  KEY `memberID` (`memberID`),
  KEY `expiry_ts` (`expiry_ts`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `merchant`
--

DROP TABLE IF EXISTS `merchant`;
CREATE TABLE IF NOT EXISTS `merchant` (
  `merchant_id` int NOT NULL AUTO_INCREMENT,
  `merchant_type` int DEFAULT NULL,
  `merchant_code` varchar(40) DEFAULT NULL,
  `merchant_name` varchar(40) DEFAULT NULL,
  `merchant_contact_email` varchar(40) DEFAULT NULL,
  `merchant_street_address` text,
  `merchant_suburb` varchar(40) DEFAULT NULL,
  `merchant_city` varchar(40) DEFAULT NULL,
  `merchant_address_code` varchar(40) DEFAULT NULL,
  `merchant_contact_details` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`merchant_id`),
  KEY `merchant_type` (`merchant_type`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `merchant`
--

INSERT INTO `merchant` (`merchant_id`, `merchant_type`, `merchant_code`, `merchant_name`, `merchant_contact_email`, `merchant_street_address`, `merchant_suburb`, `merchant_city`, `merchant_address_code`, `merchant_contact_details`) VALUES
(1, 2, '18871283', 'GEARBOX & DIFF', 'geaboxndiff@mweb.co.za', '15 NATRIUM ST&nbsp;&nbsp;&nbsp; <br>', 'LADINE', 'PIETERSBURG', '0699', '0152930595');

-- --------------------------------------------------------

--
-- Table structure for table `merchant_type`
--

DROP TABLE IF EXISTS `merchant_type`;
CREATE TABLE IF NOT EXISTS `merchant_type` (
  `merchant_type_id` int NOT NULL AUTO_INCREMENT,
  `merchant_type` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`merchant_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `merchant_type`
--

INSERT INTO `merchant_type` (`merchant_type_id`, `merchant_type`) VALUES
(1, 'Wholesale'),
(2, 'Retail');

-- --------------------------------------------------------

--
-- Table structure for table `modification_to_vehicle`
--

DROP TABLE IF EXISTS `modification_to_vehicle`;
CREATE TABLE IF NOT EXISTS `modification_to_vehicle` (
  `modification_id` int NOT NULL AUTO_INCREMENT,
  `type_of_vehicle` int DEFAULT NULL,
  `directorate` varchar(40) DEFAULT NULL,
  `head_office` varchar(40) DEFAULT NULL,
  `drivers_name_and_surname` int DEFAULT NULL,
  `drivers_persal_number` int DEFAULT NULL,
  `drivers_contact_details` int DEFAULT NULL,
  `driver_rank` varchar(40) DEFAULT NULL,
  `driver_signature` varchar(40) DEFAULT NULL,
  `vehicle_registration_number` int DEFAULT NULL,
  `make_of_vehicle` int DEFAULT NULL,
  `model_of_vehicle` int DEFAULT NULL,
  `closing_km` int DEFAULT NULL,
  `job_card_number` int DEFAULT NULL,
  `objective` text,
  `fuel_gauge_amount` varchar(40) DEFAULT NULL,
  `keys_ignition` varchar(40) DEFAULT NULL,
  `petrol_cap_with_keys` varchar(40) DEFAULT NULL,
  `padlock_with_keys` varchar(40) DEFAULT NULL,
  `tyre_r_f` varchar(40) DEFAULT NULL,
  `tyre_r_f_1` varchar(40) DEFAULT NULL,
  `tyre_r_r` varchar(40) DEFAULT NULL,
  `tyre_r_r_1` varchar(40) DEFAULT NULL,
  `tyre_l_f` varchar(40) DEFAULT NULL,
  `tyre_l_f_1` varchar(40) DEFAULT NULL,
  `tyer_l_r` varchar(40) DEFAULT NULL,
  `tyer_l_r_1` varchar(40) DEFAULT NULL,
  `tyre_spare` varchar(40) DEFAULT NULL,
  `tyre_spare_1` varchar(40) DEFAULT NULL,
  `wheel_cups` text,
  `other` text,
  `battery` varchar(40) DEFAULT NULL,
  `battery_voltage` varchar(40) DEFAULT NULL,
  `wheel_spanner` varchar(40) DEFAULT NULL,
  `jack_with_handle` varchar(40) DEFAULT NULL,
  `radio_dvd_combination` varchar(40) DEFAULT NULL,
  `petrol_card` varchar(40) DEFAULT NULL,
  `valid_license_disc` varchar(40) DEFAULT NULL,
  `valid_license_disc_date` date DEFAULT NULL,
  `fire_extinguisher` varchar(40) DEFAULT NULL,
  `warning_signs_traingle` text,
  `date_checked_in` datetime DEFAULT '2020-01-01 00:00:00',
  `testing_officer_name_and_surname` varchar(40) DEFAULT NULL,
  `testing_officer_persal_number` varchar(40) DEFAULT NULL,
  `testing_officer_rank` varchar(40) DEFAULT NULL,
  `testing_officer_signature` varchar(40) DEFAULT NULL,
  `date_received` datetime DEFAULT '2020-01-01 00:00:00',
  `supervisor_for_allocation_name_and_surname` varchar(40) DEFAULT NULL,
  `supervisor_for_allocation_persal_number` varchar(40) DEFAULT NULL,
  `supervisor_for_allocation_rank` varchar(40) DEFAULT NULL,
  `supervisor_for_allocation_signature` varchar(40) DEFAULT NULL,
  `district` int DEFAULT NULL,
  `location` int DEFAULT NULL,
  PRIMARY KEY (`modification_id`),
  KEY `type_of_vehicle` (`type_of_vehicle`),
  KEY `drivers_name_and_surname` (`drivers_name_and_surname`),
  KEY `vehicle_registration_number` (`vehicle_registration_number`),
  KEY `closing_km` (`closing_km`),
  KEY `job_card_number` (`job_card_number`),
  KEY `district` (`district`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modification_to_vehicle`
--

INSERT INTO `modification_to_vehicle` (`modification_id`, `type_of_vehicle`, `directorate`, `head_office`, `drivers_name_and_surname`, `drivers_persal_number`, `drivers_contact_details`, `driver_rank`, `driver_signature`, `vehicle_registration_number`, `make_of_vehicle`, `model_of_vehicle`, `closing_km`, `job_card_number`, `objective`, `fuel_gauge_amount`, `keys_ignition`, `petrol_cap_with_keys`, `padlock_with_keys`, `tyre_r_f`, `tyre_r_f_1`, `tyre_r_r`, `tyre_r_r_1`, `tyre_l_f`, `tyre_l_f_1`, `tyer_l_r`, `tyer_l_r_1`, `tyre_spare`, `tyre_spare_1`, `wheel_cups`, `other`, `battery`, `battery_voltage`, `wheel_spanner`, `jack_with_handle`, `radio_dvd_combination`, `petrol_card`, `valid_license_disc`, `valid_license_disc_date`, `fire_extinguisher`, `warning_signs_traingle`, `date_checked_in`, `testing_officer_name_and_surname`, `testing_officer_persal_number`, `testing_officer_rank`, `testing_officer_signature`, `date_received`, `supervisor_for_allocation_name_and_surname`, `supervisor_for_allocation_persal_number`, `supervisor_for_allocation_rank`, `supervisor_for_allocation_signature`, `district`, `location`) VALUES
(1, 2, NULL, 'Yes', 1, 1, 1, NULL, NULL, 1, 1, 1, 1, 1, '<br>', 'Empty Tank', 'Yes - keys/ignition', NULL, 'Yes - padlock with keys', 'Yes', 'Good', 'Yes', 'Good', 'Yes', 'Good', 'Yes', 'Good', 'Yes', 'Good', NULL, '<br>', 'Sabbat', NULL, 'Yes', 'Yes with handle', 'Yes', 'Yes', 'Yes', '2020-10-28', 'Yes', NULL, '2020-01-01 00:00:00', NULL, NULL, NULL, NULL, '2020-01-01 00:00:00', NULL, NULL, NULL, NULL, 14, 14);

-- --------------------------------------------------------

--
-- Table structure for table `month`
--

DROP TABLE IF EXISTS `month`;
CREATE TABLE IF NOT EXISTS `month` (
  `month_id` int NOT NULL AUTO_INCREMENT,
  `month` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`month_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `month`
--

INSERT INTO `month` (`month_id`, `month`) VALUES
(1, 'January'),
(2, 'February'),
(3, 'March'),
(4, 'April'),
(5, 'May'),
(6, 'June'),
(7, 'July'),
(8, 'August'),
(9, 'September'),
(10, 'October'),
(11, 'November'),
(12, 'December');

-- --------------------------------------------------------

--
-- Table structure for table `movement_of_personnel_in_government_garage_and_workshops`
--

DROP TABLE IF EXISTS `movement_of_personnel_in_government_garage_and_workshops`;
CREATE TABLE IF NOT EXISTS `movement_of_personnel_in_government_garage_and_workshops` (
  `movement_id` int NOT NULL AUTO_INCREMENT,
  `vehicle_inspection` int DEFAULT NULL,
  `vehicle_model` varchar(40) DEFAULT NULL,
  `vehicle_number_plate` varchar(40) DEFAULT NULL,
  `vehicle_tires_check` varchar(40) DEFAULT NULL,
  `vehicle_mirrow_check` varchar(40) DEFAULT NULL,
  `gate_security_signature` varchar(40) DEFAULT NULL,
  `government_garage_protocol` varchar(40) DEFAULT NULL,
  `government_garage_safety` varchar(40) DEFAULT NULL,
  `vehicle_handing_over_checklist` varchar(40) DEFAULT NULL,
  `vehicle_return_list` varchar(40) DEFAULT NULL,
  `approved_workshop_procedure_manual` varchar(40) DEFAULT NULL,
  `vehicle_registration_number` varchar(25) DEFAULT NULL,
  `engine_number` varchar(35) DEFAULT NULL,
  `make_of_vehicle` int DEFAULT NULL,
  PRIMARY KEY (`movement_id`),
  KEY `vehicle_inspection` (`vehicle_inspection`),
  KEY `make_of_vehicle` (`make_of_vehicle`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ordering_of_spares_for_internal_repairs`
--

DROP TABLE IF EXISTS `ordering_of_spares_for_internal_repairs`;
CREATE TABLE IF NOT EXISTS `ordering_of_spares_for_internal_repairs` (
  `spares_id` int NOT NULL AUTO_INCREMENT,
  `workshop_name` int DEFAULT NULL,
  `job_card_number` int DEFAULT NULL,
  `artisan_name_and_surname` varchar(40) DEFAULT NULL,
  `artisan_contacts` varchar(40) DEFAULT NULL,
  `artisan_email_address` varchar(40) DEFAULT NULL,
  `artisan_signature` varchar(40) DEFAULT NULL,
  `internal_requisition_to_stores` varchar(40) DEFAULT NULL,
  `supervisor_name_and_surname` varchar(40) DEFAULT NULL,
  `supervisor_contact_details` varchar(40) DEFAULT NULL,
  `supervisor_email_address` varchar(40) DEFAULT NULL,
  `supervisor_signature` varchar(40) DEFAULT NULL,
  `internal_requisition_to_stores_recommended` varchar(40) DEFAULT NULL,
  `workshop_manager_name_and_surname` varchar(40) DEFAULT NULL,
  `workshop_manager_contact_details` varchar(40) DEFAULT NULL,
  `workshop_manager_email_address` varchar(40) DEFAULT NULL,
  `workshop_manager_signature` varchar(40) DEFAULT NULL,
  `internal_requisition_to_stores_approved` varchar(40) DEFAULT NULL,
  `date_parts_ordered` datetime DEFAULT NULL,
  `vehicle_registration_number` int DEFAULT NULL,
  `engine_number` int DEFAULT NULL,
  `make_of_vehicle` int DEFAULT NULL,
  `part_type_1` int DEFAULT NULL,
  `part_name_1` int DEFAULT NULL,
  `description_1` int DEFAULT NULL,
  `manufacture_1` int DEFAULT NULL,
  `quality_1` varchar(40) DEFAULT NULL,
  `unit_price_1` decimal(10,2) DEFAULT NULL,
  `net_part_price_1` decimal(10,2) DEFAULT NULL,
  `part_type_2` int DEFAULT NULL,
  `part_name_2` int DEFAULT NULL,
  `description_2` int DEFAULT NULL,
  `manufacture_2` int DEFAULT NULL,
  `quality_2` varchar(40) DEFAULT NULL,
  `unit_price_2` decimal(10,2) DEFAULT NULL,
  `net_part_price_2` decimal(10,2) DEFAULT NULL,
  `part_type_3` int DEFAULT NULL,
  `part_name_3` int DEFAULT NULL,
  `description_3` int DEFAULT NULL,
  `manufacture_3` int DEFAULT NULL,
  `quality_3` varchar(40) DEFAULT NULL,
  `unit_price_3` decimal(10,2) DEFAULT NULL,
  `net_part_price_3` decimal(10,2) DEFAULT NULL,
  `part_type_4` int DEFAULT NULL,
  `part_name_4` int DEFAULT NULL,
  `description_4` int DEFAULT NULL,
  `manufacture_4` int DEFAULT NULL,
  `quality_4` varchar(40) DEFAULT NULL,
  `unit_price_4` decimal(10,2) DEFAULT NULL,
  `net_part_price_4` decimal(10,2) DEFAULT NULL,
  `part_type_5` int DEFAULT NULL,
  `part_name_5` int DEFAULT NULL,
  `description_5` int DEFAULT NULL,
  `manufacture_5` int DEFAULT NULL,
  `quality_5` varchar(40) DEFAULT NULL,
  `unit_price_5` decimal(10,2) DEFAULT NULL,
  `net_part_price_5` decimal(10,2) DEFAULT NULL,
  `part_type_6` int DEFAULT NULL,
  `part_name_6` int DEFAULT NULL,
  `description_6` int DEFAULT NULL,
  `manufacture_6` int DEFAULT NULL,
  `quality_6` varchar(40) DEFAULT NULL,
  `unit_price_6` decimal(10,2) DEFAULT NULL,
  `net_part_price_6` decimal(10,2) DEFAULT NULL,
  `part_type_7` int DEFAULT NULL,
  `part_name_7` int DEFAULT NULL,
  `description_7` int DEFAULT NULL,
  `manufacture_7` int DEFAULT NULL,
  `quality_7` varchar(40) DEFAULT NULL,
  `unit_price_7` decimal(10,2) DEFAULT NULL,
  `net_part_price_7` decimal(10,2) DEFAULT NULL,
  `part_type_8` int DEFAULT NULL,
  `part_name_8` int DEFAULT NULL,
  `description_8` int DEFAULT NULL,
  `manufacture_8` int DEFAULT NULL,
  `unit_price_8` decimal(10,2) DEFAULT NULL,
  `quality_8` varchar(40) DEFAULT NULL,
  `net_part_price_8` decimal(10,2) DEFAULT NULL,
  `tax` decimal(10,2) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `attached_requisition_form` varchar(40) DEFAULT NULL,
  `work_allocation_reference_number` int DEFAULT NULL,
  `date_parts_received` datetime DEFAULT NULL,
  PRIMARY KEY (`spares_id`),
  KEY `workshop_name` (`workshop_name`),
  KEY `job_card_number` (`job_card_number`),
  KEY `vehicle_registration_number` (`vehicle_registration_number`),
  KEY `part_type_1` (`part_type_1`),
  KEY `part_name_1` (`part_name_1`),
  KEY `description_1` (`description_1`),
  KEY `manufacture_1` (`manufacture_1`),
  KEY `part_type_2` (`part_type_2`),
  KEY `part_name_2` (`part_name_2`),
  KEY `description_2` (`description_2`),
  KEY `manufacture_2` (`manufacture_2`),
  KEY `part_type_3` (`part_type_3`),
  KEY `part_name_3` (`part_name_3`),
  KEY `description_3` (`description_3`),
  KEY `manufacture_3` (`manufacture_3`),
  KEY `part_type_4` (`part_type_4`),
  KEY `part_name_4` (`part_name_4`),
  KEY `description_4` (`description_4`),
  KEY `manufacture_4` (`manufacture_4`),
  KEY `part_type_5` (`part_type_5`),
  KEY `part_name_5` (`part_name_5`),
  KEY `description_5` (`description_5`),
  KEY `manufacture_5` (`manufacture_5`),
  KEY `part_type_6` (`part_type_6`),
  KEY `part_name_6` (`part_name_6`),
  KEY `description_6` (`description_6`),
  KEY `manufacture_6` (`manufacture_6`),
  KEY `part_type_7` (`part_type_7`),
  KEY `part_name_7` (`part_name_7`),
  KEY `description_7` (`description_7`),
  KEY `manufacture_7` (`manufacture_7`),
  KEY `part_type_8` (`part_type_8`),
  KEY `part_name_8` (`part_name_8`),
  KEY `description_8` (`description_8`),
  KEY `manufacture_8` (`manufacture_8`),
  KEY `work_allocation_reference_number` (`work_allocation_reference_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `parts`
--

DROP TABLE IF EXISTS `parts`;
CREATE TABLE IF NOT EXISTS `parts` (
  `parts_id` int NOT NULL AUTO_INCREMENT,
  `part_type` int DEFAULT NULL,
  `part_number` varchar(40) DEFAULT NULL,
  `part_name` varchar(40) DEFAULT NULL,
  `description` text,
  `manufacturer` int DEFAULT NULL,
  `dealer` int DEFAULT NULL,
  `measure` varchar(40) DEFAULT NULL,
  `unit_price` decimal(10,2) DEFAULT NULL,
  `quantity` varchar(40) DEFAULT NULL,
  `freight` varchar(40) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `tax` varchar(40) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `discount_price` decimal(10,2) DEFAULT NULL,
  `net_part_price` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`parts_id`),
  KEY `part_type` (`part_type`),
  KEY `manufacturer` (`manufacturer`),
  KEY `dealer` (`dealer`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parts`
--

INSERT INTO `parts` (`parts_id`, `part_type`, `part_number`, `part_name`, `description`, `manufacturer`, `dealer`, `measure`, `unit_price`, `quantity`, `freight`, `amount`, `tax`, `total_amount`, `discount_price`, `net_part_price`) VALUES
(1, 3, 'AF-SUV-T-Rav4-2020-02-27', 'Air Filter SUV Toyota Rav 4 G.X 2.0', 'Air Filter SUV Toyota Rav 4 <br>', 5, 1, 'PC', '40.00', '2', '50.00', '130.00', '0.15', '19.50', '25.67', '123.83');

-- --------------------------------------------------------

--
-- Table structure for table `parts_type`
--

DROP TABLE IF EXISTS `parts_type`;
CREATE TABLE IF NOT EXISTS `parts_type` (
  `part_type_id` int NOT NULL AUTO_INCREMENT,
  `part_type` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`part_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parts_type`
--

INSERT INTO `parts_type` (`part_type_id`, `part_type`) VALUES
(1, 'Bearing'),
(2, 'Gasket'),
(3, 'Air Filter'),
(4, 'Oil Filter'),
(5, 'Brake pads');

-- --------------------------------------------------------

--
-- Table structure for table `province`
--

DROP TABLE IF EXISTS `province`;
CREATE TABLE IF NOT EXISTS `province` (
  `province_id` int NOT NULL AUTO_INCREMENT,
  `province` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`province_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `province`
--

INSERT INTO `province` (`province_id`, `province`) VALUES
(1, 'Limpopo'),
(2, 'Mpumalanga'),
(3, 'North West'),
(4, 'Gauteng'),
(5, 'Free State'),
(6, 'KwaZulu-Natal'),
(7, 'Eastern Cape'),
(8, 'Northern Cape'),
(9, 'Western Cape');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders`
--

DROP TABLE IF EXISTS `purchase_orders`;
CREATE TABLE IF NOT EXISTS `purchase_orders` (
  `purchase_order_id` int NOT NULL AUTO_INCREMENT,
  `purchased_order_number` varchar(40) NOT NULL,
  `purchased_date` date DEFAULT NULL,
  `purchaser` varchar(40) DEFAULT NULL,
  `vehicle_registration_number` int DEFAULT NULL,
  `type_of_vehicle` int DEFAULT NULL,
  `manufacturer` int DEFAULT NULL,
  `service_type` text,
  `service_category` int DEFAULT NULL,
  `service_item` text,
  `upload_quotation` varchar(40) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `merchant_name` int DEFAULT NULL,
  `date_of_service` date DEFAULT NULL,
  `closing_km` int DEFAULT NULL,
  `labour_category_1` varchar(40) DEFAULT NULL,
  `part_number_1` int DEFAULT NULL,
  `part_name_1` int DEFAULT NULL,
  `part_manufacturer_name_1` int DEFAULT NULL,
  `quantity_1` varchar(40) DEFAULT NULL,
  `expense_of_item_1` decimal(10,2) DEFAULT NULL,
  `labour_category_2` varchar(40) DEFAULT NULL,
  `part_number_2` int DEFAULT NULL,
  `part_name_2` int DEFAULT NULL,
  `part_manufacturer_name_2` int DEFAULT NULL,
  `quantity_2` varchar(40) DEFAULT NULL,
  `expense_of_item_2` decimal(10,2) DEFAULT NULL,
  `labour_category_3` varchar(40) DEFAULT NULL,
  `part_number_3` int DEFAULT NULL,
  `part_name_3` int DEFAULT NULL,
  `part_manufacturer_name_3` int DEFAULT NULL,
  `quantity_3` varchar(40) DEFAULT NULL,
  `expense_of_item_3` decimal(10,2) DEFAULT NULL,
  `labour_category_4` varchar(40) DEFAULT NULL,
  `part_number_4` int DEFAULT NULL,
  `part_name_4` int DEFAULT NULL,
  `part_manufacturer_name_4` int DEFAULT NULL,
  `quantity_4` varchar(40) DEFAULT NULL,
  `expense_of_item_4` decimal(10,2) DEFAULT NULL,
  `labour_category_5` varchar(40) DEFAULT NULL,
  `part_number_5` int DEFAULT NULL,
  `part_name_5` int DEFAULT NULL,
  `part_manufacturer_name_5` int DEFAULT NULL,
  `quantity_5` varchar(40) DEFAULT NULL,
  `expense_of_item_5` decimal(10,2) DEFAULT NULL,
  `labour_category_6` varchar(40) DEFAULT NULL,
  `part_number_6` int DEFAULT NULL,
  `part_name_6` int DEFAULT NULL,
  `part_manufacturer_name_6` int DEFAULT NULL,
  `quantity_6` varchar(40) DEFAULT NULL,
  `expense_of_item_6` decimal(10,2) DEFAULT NULL,
  `labour_category_7` varchar(40) DEFAULT NULL,
  `part_number_7` int DEFAULT NULL,
  `part_name_7` int DEFAULT NULL,
  `part_manufacturer_name_7` int DEFAULT NULL,
  `quantity_7` varchar(40) DEFAULT NULL,
  `expense_of_item_7` decimal(10,2) DEFAULT NULL,
  `labour_category_8` varchar(40) DEFAULT NULL,
  `part_number_8` int DEFAULT NULL,
  `part_name_8` int DEFAULT NULL,
  `part_manufacturer_name_8` int DEFAULT NULL,
  `expense_of_item_8` decimal(10,2) DEFAULT NULL,
  `material_cost` decimal(10,2) DEFAULT NULL,
  `average_worktime_hrs` varchar(40) DEFAULT NULL,
  `standard_labour_cost_per_hour` decimal(10,2) DEFAULT NULL,
  `labour_charges` decimal(10,2) DEFAULT NULL,
  `vat` decimal(10,2) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `workshop_name` int DEFAULT NULL,
  `work_order_id` int DEFAULT NULL,
  `job_card_number` int DEFAULT NULL,
  `completion_date` date DEFAULT NULL,
  `comments` longtext,
  `upload_invoice` varchar(40) DEFAULT NULL,
  `date_captured` date DEFAULT NULL,
  `data_capturer` varchar(40) DEFAULT NULL,
  `data_capturer_contact_email` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`purchase_order_id`),
  KEY `vehicle_registration_number` (`vehicle_registration_number`),
  KEY `manufacturer` (`manufacturer`),
  KEY `service_category` (`service_category`),
  KEY `merchant_name` (`merchant_name`),
  KEY `closing_km` (`closing_km`),
  KEY `part_number_1` (`part_number_1`),
  KEY `part_name_1` (`part_name_1`),
  KEY `part_manufacturer_name_1` (`part_manufacturer_name_1`),
  KEY `part_number_2` (`part_number_2`),
  KEY `part_name_2` (`part_name_2`),
  KEY `part_manufacturer_name_2` (`part_manufacturer_name_2`),
  KEY `part_number_3` (`part_number_3`),
  KEY `part_manufacturer_name_3` (`part_manufacturer_name_3`),
  KEY `part_number_4` (`part_number_4`),
  KEY `part_manufacturer_name_4` (`part_manufacturer_name_4`),
  KEY `part_number_5` (`part_number_5`),
  KEY `part_manufacturer_name_5` (`part_manufacturer_name_5`),
  KEY `part_number_6` (`part_number_6`),
  KEY `part_name_6` (`part_name_6`),
  KEY `part_manufacturer_name_6` (`part_manufacturer_name_6`),
  KEY `part_number_7` (`part_number_7`),
  KEY `part_name_7` (`part_name_7`),
  KEY `part_manufacturer_name_7` (`part_manufacturer_name_7`),
  KEY `part_number_8` (`part_number_8`),
  KEY `part_name_8` (`part_name_8`),
  KEY `part_manufacturer_name_8` (`part_manufacturer_name_8`),
  KEY `workshop_name` (`workshop_name`),
  KEY `work_order_id` (`work_order_id`),
  KEY `job_card_number` (`job_card_number`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_orders`
--

INSERT INTO `purchase_orders` (`purchase_order_id`, `purchased_order_number`, `purchased_date`, `purchaser`, `vehicle_registration_number`, `type_of_vehicle`, `manufacturer`, `service_type`, `service_category`, `service_item`, `upload_quotation`, `due_date`, `merchant_name`, `date_of_service`, `closing_km`, `labour_category_1`, `part_number_1`, `part_name_1`, `part_manufacturer_name_1`, `quantity_1`, `expense_of_item_1`, `labour_category_2`, `part_number_2`, `part_name_2`, `part_manufacturer_name_2`, `quantity_2`, `expense_of_item_2`, `labour_category_3`, `part_number_3`, `part_name_3`, `part_manufacturer_name_3`, `quantity_3`, `expense_of_item_3`, `labour_category_4`, `part_number_4`, `part_name_4`, `part_manufacturer_name_4`, `quantity_4`, `expense_of_item_4`, `labour_category_5`, `part_number_5`, `part_name_5`, `part_manufacturer_name_5`, `quantity_5`, `expense_of_item_5`, `labour_category_6`, `part_number_6`, `part_name_6`, `part_manufacturer_name_6`, `quantity_6`, `expense_of_item_6`, `labour_category_7`, `part_number_7`, `part_name_7`, `part_manufacturer_name_7`, `quantity_7`, `expense_of_item_7`, `labour_category_8`, `part_number_8`, `part_name_8`, `part_manufacturer_name_8`, `expense_of_item_8`, `material_cost`, `average_worktime_hrs`, `standard_labour_cost_per_hour`, `labour_charges`, `vat`, `total_amount`, `workshop_name`, `work_order_id`, `job_card_number`, `completion_date`, `comments`, `upload_invoice`, `date_captured`, `data_capturer`, `data_capturer_contact_email`) VALUES
(1, 'PO-LDoT-2019/09/11-234567', '2019-09-04', 'Dennis Maja', 1, 1, 1, 'Check battery and cables, Check brakes', 2, NULL, 'Z1a_Leave_-_edited.pdf', '2019-11-08', 1, '2019-11-06', NULL, 'Replace', NULL, NULL, 2, '1', '783.46', 'Replace', NULL, NULL, 4, '7', '250.00', NULL, NULL, NULL, NULL, NULL, '0.00', NULL, NULL, NULL, NULL, NULL, '0.00', NULL, NULL, NULL, NULL, NULL, '0.00', NULL, NULL, NULL, NULL, NULL, '0.00', NULL, NULL, NULL, NULL, NULL, '0.00', NULL, NULL, NULL, NULL, '0.00', '0.00', NULL, '0.00', '745.65', '0.15', '3770.98', 1, NULL, NULL, '2019-11-08', '<br>', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reception`
--

DROP TABLE IF EXISTS `reception`;
CREATE TABLE IF NOT EXISTS `reception` (
  `reception_user_id` int NOT NULL AUTO_INCREMENT,
  `reception_name_and_surname` varchar(40) DEFAULT NULL,
  `reception_persal_number` varchar(40) DEFAULT NULL,
  `reception_contact_details` varchar(40) DEFAULT NULL,
  `reception_email_address` varchar(40) DEFAULT NULL,
  `reception_signature` varchar(40) DEFAULT NULL,
  `date_of_vehicle_entrance` datetime DEFAULT NULL,
  `service_status` varchar(40) DEFAULT NULL,
  `workshop_address` text,
  `vehicle_registration_number` int DEFAULT NULL,
  `engine_number` int DEFAULT NULL,
  `make_of_vehicle` int DEFAULT NULL,
  `breakdown_of_vehicle` int DEFAULT NULL,
  `description_of_vehicle_report` text,
  `upload_of_vehicle_report` text,
  `description_of_vehicle_breakdown` text,
  `job_card_number` varchar(40) DEFAULT NULL,
  `visual_inspection_form` varchar(40) DEFAULT NULL,
  `damage_report` varchar(40) DEFAULT NULL,
  `date_of_vehicle_exit` datetime DEFAULT NULL,
  `payment` varchar(40) DEFAULT NULL,
  `district` int DEFAULT NULL,
  `location` int DEFAULT NULL,
  `description_of_vehicle_breakdown_notes` text,
  PRIMARY KEY (`reception_user_id`),
  KEY `vehicle_registration_number` (`vehicle_registration_number`),
  KEY `district` (`district`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reception`
--

INSERT INTO `reception` (`reception_user_id`, `reception_name_and_surname`, `reception_persal_number`, `reception_contact_details`, `reception_email_address`, `reception_signature`, `date_of_vehicle_entrance`, `service_status`, `workshop_address`, `vehicle_registration_number`, `engine_number`, `make_of_vehicle`, `breakdown_of_vehicle`, `description_of_vehicle_report`, `upload_of_vehicle_report`, `description_of_vehicle_breakdown`, `job_card_number`, `visual_inspection_form`, `damage_report`, `date_of_vehicle_exit`, `payment`, `district`, `location`, `description_of_vehicle_breakdown_notes`) VALUES
(1, 'Danisa Khosa', '12345678', '063334567', 'khozad@dtcs.limpopo.gov.za', NULL, '2022-03-25 15:45:04', '75%', '<br>', 2, 2, 2, NULL, NULL, NULL, NULL, 'PTS20210419', NULL, NULL, NULL, NULL, 13, 13, 'The clutch cable brake and drive all the way to Polokwane in the 2nd gear..<br>'),
(2, 'Yulan Moon', '98765432', '0152951897', 'moony@dtcs.limpopo.gov.za', NULL, '2022-03-31 13:33:42', 'Started', '<br>', 1, 1, 1, 0, NULL, NULL, NULL, 'BAPH03312022', NULL, NULL, NULL, NULL, 58, 58, '<br>');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

DROP TABLE IF EXISTS `schedule`;
CREATE TABLE IF NOT EXISTS `schedule` (
  `schedule_id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(40) DEFAULT NULL,
  `user_name_and_surname` int DEFAULT NULL,
  `user_contact_email` int DEFAULT NULL,
  `service_item_type` int DEFAULT NULL,
  `service_item_type_code` int DEFAULT NULL,
  `application_status` varchar(40) NOT NULL,
  `vehicle_registration_number` int DEFAULT NULL,
  `engine_number` int DEFAULT NULL,
  `closing_km` int DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT '12:00:00',
  `workshop_name` int DEFAULT NULL,
  `diagnosis` varchar(40) DEFAULT NULL,
  `prescription` varchar(40) DEFAULT NULL,
  `comments` text,
  PRIMARY KEY (`schedule_id`),
  KEY `user_name_and_surname` (`user_name_and_surname`),
  KEY `service_item_type` (`service_item_type`),
  KEY `vehicle_registration_number` (`vehicle_registration_number`),
  KEY `closing_km` (`closing_km`),
  KEY `workshop_name` (`workshop_name`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`schedule_id`, `title`, `user_name_and_surname`, `user_contact_email`, `service_item_type`, `service_item_type_code`, `application_status`, `vehicle_registration_number`, `engine_number`, `closing_km`, `date`, `time`, `workshop_name`, `diagnosis`, `prescription`, `comments`) VALUES
(1, 'Comprehensive Service', 1, 1, 4, 4, 'Active', 1, 1, 1, '2022-05-11', '09:30:00', 37, 'Silencer box broken', 'Replace silencer', 'Order Bosal silencer<br>'),
(2, 'Major Service', 2, 2, 23, 23, 'Active', 2, 2, 2, '2022-05-11', '09:30:00', 34, 'Problem with automatic gearbox, refuse', 'Overhaul the Gearbox', 'Cannot go into Drive mode<br>');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

DROP TABLE IF EXISTS `service`;
CREATE TABLE IF NOT EXISTS `service` (
  `service_id` int NOT NULL AUTO_INCREMENT,
  `breakdown_of_vehicle` varchar(40) DEFAULT NULL,
  `service_title` varchar(75) DEFAULT NULL,
  `service_item_type` int DEFAULT NULL,
  `service_category` int DEFAULT NULL,
  `merchant_name` int DEFAULT NULL,
  `vehicle_registration_number` int DEFAULT NULL,
  `engine_number` int DEFAULT NULL,
  `chassis_number` int DEFAULT NULL,
  `dealer_name` int DEFAULT NULL,
  `make_of_vehicle` int DEFAULT NULL,
  `model_of_vehicle` int DEFAULT NULL,
  `year_model_of_vehicle` int DEFAULT NULL,
  `type_of_vehicle` int DEFAULT NULL,
  `closing_km` int DEFAULT NULL,
  `application_status` int DEFAULT NULL,
  `work_allocation_reference_number` int DEFAULT NULL,
  `barcode_number` int DEFAULT NULL,
  `department` int DEFAULT NULL,
  `service_item` text,
  `date_of_service` int DEFAULT NULL,
  `time` int DEFAULT NULL,
  `upload_quotation` varchar(40) DEFAULT NULL,
  `date_of_next_service` date DEFAULT NULL,
  `repeat_service_schedule_every_km` text,
  `comments` longtext,
  `upload_invoice` varchar(40) DEFAULT NULL,
  `receptionist` int DEFAULT NULL,
  `receptionist_contact_email` int DEFAULT NULL,
  `workshop_name` int DEFAULT NULL,
  `workshop_address` text,
  `technician` varchar(40) DEFAULT NULL,
  `work_order_status` varchar(40) DEFAULT NULL,
  `job_card_number` int DEFAULT NULL,
  `completion_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `filed` datetime DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`service_id`),
  KEY `service_item_type` (`service_item_type`),
  KEY `service_category` (`service_category`),
  KEY `merchant_name` (`merchant_name`),
  KEY `vehicle_registration_number` (`vehicle_registration_number`),
  KEY `dealer_name` (`dealer_name`),
  KEY `closing_km` (`closing_km`),
  KEY `work_allocation_reference_number` (`work_allocation_reference_number`),
  KEY `date_of_service` (`date_of_service`),
  KEY `receptionist` (`receptionist`),
  KEY `workshop_name` (`workshop_name`),
  KEY `job_card_number` (`job_card_number`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`service_id`, `breakdown_of_vehicle`, `service_title`, `service_item_type`, `service_category`, `merchant_name`, `vehicle_registration_number`, `engine_number`, `chassis_number`, `dealer_name`, `make_of_vehicle`, `model_of_vehicle`, `year_model_of_vehicle`, `type_of_vehicle`, `closing_km`, `application_status`, `work_allocation_reference_number`, `barcode_number`, `department`, `service_item`, `date_of_service`, `time`, `upload_quotation`, `date_of_next_service`, `repeat_service_schedule_every_km`, `comments`, `upload_invoice`, `receptionist`, `receptionist_contact_email`, `workshop_name`, `workshop_address`, `technician`, `work_order_status`, `job_card_number`, `completion_date`, `due_date`, `filed`, `last_modified`) VALUES
(1, 'No', 'Service Nissan Navara 4.0 A/T 4X4 DTN 004 L', 23, 2, 1, 1, 1, 1, 3, 3, 1, 1, 1, 1, 1, 1, 1, 1, 'Change Oil, Check Lights and Traffic Indicators', 1, 1, NULL, '2022-04-11', '12500', '<br>', NULL, 2, 2, 2, '<br>', NULL, NULL, 2, '2020-05-18', '2020-05-23', '2020-05-18 18:36:18', '2022-03-31 13:43:09'),
(2, 'No', 'Service Toyota Rav 4 WD 2.0 GX DPL 322 L', 23, 2, 1, 2, 2, 2, 1, 1, 2, 2, 2, 2, 2, 2, 2, 2, 'Check Drive Belts, Check Hoses, Check Tyre Inflation and Condition, Check Transmission Fluid, Replace Spark Plugs, Replace Oil Filter', 2, 2, NULL, '2020-11-27', '10500', '<br>', NULL, 2, 2, 2, '<br>', NULL, NULL, 2, '2020-05-18', '2020-05-18', '2020-05-18 19:52:46', '2020-05-18 20:11:05');

-- --------------------------------------------------------

--
-- Table structure for table `service_categories`
--

DROP TABLE IF EXISTS `service_categories`;
CREATE TABLE IF NOT EXISTS `service_categories` (
  `service_categories_id` int NOT NULL AUTO_INCREMENT,
  `service_category` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`service_categories_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service_categories`
--

INSERT INTO `service_categories` (`service_categories_id`, `service_category`) VALUES
(1, 'Minor Service'),
(2, 'Major Service'),
(3, 'Comprehensive Service'),
(4, 'Tune Up Service'),
(5, 'Auto Transmission Service');

-- --------------------------------------------------------

--
-- Table structure for table `service_item`
--

DROP TABLE IF EXISTS `service_item`;
CREATE TABLE IF NOT EXISTS `service_item` (
  `service_item_id` int NOT NULL AUTO_INCREMENT,
  `service_item` text,
  PRIMARY KEY (`service_item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service_item`
--

INSERT INTO `service_item` (`service_item_id`, `service_item`) VALUES
(1, 'Change Oil'),
(2, 'Check Battery and Cables'),
(3, 'Check Brake Fluid'),
(4, 'Check Brakes'),
(5, 'Check Coolant (anti-freeze)');

-- --------------------------------------------------------

--
-- Table structure for table `service_item_type`
--

DROP TABLE IF EXISTS `service_item_type`;
CREATE TABLE IF NOT EXISTS `service_item_type` (
  `service_item_type_id` int NOT NULL AUTO_INCREMENT,
  `service_item_type` varchar(40) DEFAULT NULL,
  `service_item_type_code` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`service_item_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service_item_type`
--

INSERT INTO `service_item_type` (`service_item_type_id`, `service_item_type`, `service_item_type_code`) VALUES
(1, 'Bodywork - Minor', 'R001'),
(2, 'Bodywork - Rust', 'R002'),
(3, 'Brake System - Minor', 'R003'),
(4, 'Brake System - Overhaul', 'R004'),
(5, 'Chassis - Repair', 'R005'),
(6, 'Cooling System - Minor', 'R006'),
(7, 'Cooling System - Major', 'R007'),
(8, 'Clutch - Minor', 'R008'),
(9, 'Clutch - Overhaul', 'R009'),
(10, 'Differential - Minor', 'R010'),
(11, 'Differential - Overhaul', 'R011'),
(12, 'Electrical Assesories & Wiring', 'R012'),
(13, 'Electrical - Charge', 'R013'),
(14, 'Electrical - Ignition', 'R014'),
(15, 'Electrical - Starter', 'R015'),
(16, 'Engine Minor - Repair', 'R016'),
(17, 'Engine - Overhaul', 'R017'),
(18, 'Exhaust Minor - Repair', 'R018'),
(19, 'Exhaust System - Replacement', 'R019'),
(20, 'Fuel System - Repair', 'R020'),
(21, 'Fuel System - Replacement', 'R021'),
(22, 'Gearbox Minor - Repairs', 'R022'),
(23, 'Gearbox - Overhaul', 'R023'),
(24, 'Steering Minor - Repairs', 'R024'),
(25, 'Steering - Overhaul', 'R025'),
(26, 'Suspension - Minor', 'R026'),
(27, 'Suspension - Overhaul', 'R027'),
(28, 'Upholstery', 'R028'),
(29, 'Wheel - Alignment', 'R029'),
(30, 'Removal of  Battery', 'R030'),
(31, 'General - Equipment', 'R032'),
(32, 'Service - 1000 km', 'R049'),
(33, 'Pre - Delivery', 'R050'),
(34, 'Service - 5000 km', 'R051'),
(35, 'Service - 10 000 km', 'R052'),
(36, 'Service - 20 000 km', 'R053'),
(37, 'Service - 7 500 km', 'R055'),
(38, 'Service - 15 000 km', 'R056'),
(39, 'Modification - Fuel Tanks', 'R061'),
(40, 'Modification - Canopies', 'R062'),
(41, 'Modification - Dog Kennels', 'R063'),
(42, 'Modification - Screens', 'R064'),
(43, 'Modification - Towbars', 'R065'),
(44, 'Damages', 'R071'),
(45, 'Accidents', 'R072'),
(46, 'Boarded Vehicles', 'R073'),
(47, 'Drive Shaft', 'R074'),
(48, 'Tow-In Services', 'R075'),
(49, 'Windscreen - Repairs', 'R076'),
(50, 'Windscreen - Replacement', 'R077'),
(51, 'Marking of GG Vehicle', 'R078'),
(52, 'Tyre Fitment / Repairs', 'R079'),
(53, 'Aircon Repairs / Re-Gas', 'R080'),
(54, 'Wheel Balancing', 'R081'),
(55, 'Cylinder Head', 'R082'),
(56, 'Replace - Battery', 'R083'),
(57, 'CV Joints', 'R084'),
(58, 'Valet / Car Wash', 'R085'),
(59, 'Wheel Balancing - Front', 'R086'),
(60, 'Wheel Balancing - Rear', 'R087'),
(61, 'Replace - Engine', 'R088'),
(62, 'Replace - Gearbox', 'R089'),
(63, 'Replace - Diff', 'R090');

-- --------------------------------------------------------

--
-- Table structure for table `service_provider`
--

DROP TABLE IF EXISTS `service_provider`;
CREATE TABLE IF NOT EXISTS `service_provider` (
  `service_provider_id` int NOT NULL AUTO_INCREMENT,
  `service_provider_type` int DEFAULT NULL,
  `service_provider_name` varchar(40) DEFAULT NULL,
  `service_provider_contact_email` varchar(40) DEFAULT NULL,
  `service_provider_contact_details` varchar(40) DEFAULT NULL,
  `service_provider_street_address` text,
  `service_provider_branch_code` varchar(40) DEFAULT NULL,
  `service_provider_branch` varchar(40) DEFAULT NULL,
  `service_provider_city` varchar(40) DEFAULT NULL,
  `service_provider_address_code` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`service_provider_id`),
  KEY `service_provider_type` (`service_provider_type`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `service_provider_type`
--

DROP TABLE IF EXISTS `service_provider_type`;
CREATE TABLE IF NOT EXISTS `service_provider_type` (
  `service_provider_type_id` int NOT NULL AUTO_INCREMENT,
  `service_provider_type` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`service_provider_type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `service_records`
--

DROP TABLE IF EXISTS `service_records`;
CREATE TABLE IF NOT EXISTS `service_records` (
  `records_id` int NOT NULL AUTO_INCREMENT,
  `vehicle` int DEFAULT NULL,
  `image_1` varchar(40) DEFAULT NULL,
  `image_2` varchar(40) DEFAULT NULL,
  `image_3` varchar(40) DEFAULT NULL,
  `image_4` varchar(40) DEFAULT NULL,
  `image_5` varchar(40) DEFAULT NULL,
  `document_1` varchar(40) DEFAULT NULL,
  `document_2` varchar(40) DEFAULT NULL,
  `document_3` varchar(40) DEFAULT NULL,
  `document_4` varchar(40) DEFAULT NULL,
  `document_5` varchar(40) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`records_id`),
  KEY `vehicle` (`vehicle`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `service_type`
--

DROP TABLE IF EXISTS `service_type`;
CREATE TABLE IF NOT EXISTS `service_type` (
  `service_type_id` int NOT NULL AUTO_INCREMENT,
  `service` varchar(200) DEFAULT NULL,
  `type_of_service` text,
  `reference` text,
  `service_item_type` int DEFAULT NULL,
  `service_category` int DEFAULT NULL,
  `service_item` varchar(40) DEFAULT NULL,
  `frequency_time_number` varchar(40) DEFAULT NULL,
  `frequency_time` varchar(40) DEFAULT NULL,
  `frequency_odometer` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`service_type_id`),
  KEY `service_item_type` (`service_item_type`),
  KEY `service_category` (`service_category`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transmission`
--

DROP TABLE IF EXISTS `transmission`;
CREATE TABLE IF NOT EXISTS `transmission` (
  `transmission_id` int NOT NULL AUTO_INCREMENT,
  `transmission` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`transmission_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transmission`
--

INSERT INTO `transmission` (`transmission_id`, `transmission`) VALUES
(1, 'Automatic'),
(2, 'Electric'),
(3, 'Manual');

-- --------------------------------------------------------

--
-- Table structure for table `tyre_log_sheet`
--

DROP TABLE IF EXISTS `tyre_log_sheet`;
CREATE TABLE IF NOT EXISTS `tyre_log_sheet` (
  `tyre_log_id` int NOT NULL AUTO_INCREMENT,
  `vehicle_registration_number` int DEFAULT NULL,
  `tyre_position` varchar(40) DEFAULT NULL,
  `tyre_tread_condition` varchar(40) DEFAULT NULL,
  `tyre_brand` varchar(40) DEFAULT NULL,
  `tyre_model` varchar(40) DEFAULT NULL,
  `tyre_size` varchar(40) DEFAULT NULL,
  `tyre_pressure` varchar(40) DEFAULT NULL,
  `action` text,
  `warranty` varchar(40) DEFAULT NULL,
  `documents` varchar(225) DEFAULT NULL,
  `tyre_tread` varchar(40) DEFAULT NULL,
  `tyre_maximum_wear` varchar(40) DEFAULT NULL,
  `inspection_date` date DEFAULT '0000-00-00',
  `tyre_inspection_done_by` varchar(40) DEFAULT NULL,
  `tyre_inspection_report` varchar(40) DEFAULT NULL,
  `status` varchar(40) DEFAULT NULL,
  `opening_km` varchar(15) DEFAULT NULL,
  `closing_km` varchar(15) DEFAULT NULL,
  `total_km` varchar(15) DEFAULT NULL,
  `comments` text,
  `tyres_cause_of_accident` varchar(40) DEFAULT NULL,
  `accident_report` varchar(40) DEFAULT NULL,
  `claims_report` varchar(40) DEFAULT NULL,
  `insurance_claims_report` varchar(40) DEFAULT NULL,
  `reminder_maximum_wear` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`tyre_log_id`),
  KEY `vehicle_registration_number` (`vehicle_registration_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_annual_inspection`
--

DROP TABLE IF EXISTS `vehicle_annual_inspection`;
CREATE TABLE IF NOT EXISTS `vehicle_annual_inspection` (
  `fleet_asset_id` int NOT NULL AUTO_INCREMENT,
  `vehicle_registration_number` int NOT NULL,
  `register_number` int NOT NULL,
  `engine_number` int NOT NULL,
  `chassis_number` int NOT NULL,
  `make_of_vehicle` int NOT NULL,
  `model_of_vehicle` int NOT NULL,
  `year_model_specification` int NOT NULL,
  `engine_capacity` int NOT NULL,
  `tyre_size` int DEFAULT NULL,
  `transmission` int DEFAULT NULL,
  `fuel_type` int DEFAULT NULL,
  `type_of_vehicle` int DEFAULT NULL,
  `colour_of_vehicle` int DEFAULT NULL,
  `application_status` int DEFAULT NULL,
  `renewal_of_license` int DEFAULT NULL,
  `barcode_number` int DEFAULT NULL,
  `last_entry_logbook` date DEFAULT NULL,
  `photo_of_vehicle` varchar(255) DEFAULT NULL,
  `department_name` int NOT NULL,
  `province` int NOT NULL,
  `district` int NOT NULL,
  `mechanical_inspection` longtext,
  `upholstery` longtext,
  `electrical_inspection` longtext,
  `wheel_spanner` varchar(40) DEFAULT NULL,
  `spare_wheel` varchar(40) DEFAULT NULL,
  `jack` varchar(40) DEFAULT NULL,
  `radio` varchar(40) DEFAULT NULL,
  `triangle` varchar(40) DEFAULT NULL,
  `log_book` varchar(40) DEFAULT NULL,
  `iternary` varchar(40) DEFAULT NULL,
  `fuel_card` varchar(40) DEFAULT NULL,
  `recommendation` longtext,
  `documents` varchar(225) DEFAULT NULL,
  `checking_officer_name_and_surname` varchar(40) NOT NULL,
  `checking_officer_contact_email` varchar(40) NOT NULL,
  `date_of_inspection` date DEFAULT '0000-00-00',
  PRIMARY KEY (`fleet_asset_id`),
  KEY `vehicle_registration_number` (`vehicle_registration_number`),
  KEY `register_number` (`register_number`),
  KEY `department_name` (`department_name`),
  KEY `province` (`province`),
  KEY `district` (`district`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_colour`
--

DROP TABLE IF EXISTS `vehicle_colour`;
CREATE TABLE IF NOT EXISTS `vehicle_colour` (
  `vehicle_colour_id` int NOT NULL AUTO_INCREMENT,
  `colour_of_vehicle` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`vehicle_colour_id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle_colour`
--

INSERT INTO `vehicle_colour` (`vehicle_colour_id`, `colour_of_vehicle`) VALUES
(1, 'Beige'),
(2, 'Black'),
(3, 'Blue'),
(4, 'Brown'),
(5, 'Burgundy'),
(6, 'Champaigne'),
(7, 'Charcoal'),
(8, 'Cream'),
(9, 'Gold'),
(10, 'Green'),
(11, 'Grey'),
(12, 'Maroon'),
(13, 'Off White'),
(14, 'Orange'),
(15, 'Purple'),
(16, 'Red'),
(17, 'Silver'),
(18, 'Tan'),
(19, 'Teal'),
(20, 'Titanium'),
(21, 'Turquoise'),
(22, 'White'),
(23, 'Yellow'),
(24, 'Pearl White'),
(25, 'Pearl Grey'),
(26, 'Pearl Green'),
(27, 'Pearl Blue'),
(28, 'Pearl Black');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_daily_check_list`
--

DROP TABLE IF EXISTS `vehicle_daily_check_list`;
CREATE TABLE IF NOT EXISTS `vehicle_daily_check_list` (
  `vehicle_daily_check_list_id` int NOT NULL AUTO_INCREMENT,
  `inspection_certification_number` varchar(40) DEFAULT NULL,
  `vehicle_registration_number` int DEFAULT NULL,
  `make_of_vehicle` int DEFAULT NULL,
  `closing_km` int DEFAULT NULL,
  `dashboard` varchar(40) DEFAULT NULL,
  `seats` varchar(40) DEFAULT NULL,
  `carpets` varchar(40) DEFAULT NULL,
  `wipers` varchar(40) DEFAULT NULL,
  `head_lights` varchar(40) DEFAULT NULL,
  `tail_lights` varchar(40) DEFAULT NULL,
  `brake_lights` varchar(40) DEFAULT NULL,
  `indicators` varchar(40) DEFAULT NULL,
  `windscreen` varchar(40) DEFAULT NULL,
  `windows` varchar(40) DEFAULT NULL,
  `mirrors` varchar(40) DEFAULT NULL,
  `wheels` varchar(40) DEFAULT NULL,
  `hubcaps` varchar(40) DEFAULT NULL,
  `sparewheel` varchar(40) DEFAULT NULL,
  `tools` varchar(40) DEFAULT NULL,
  `engine_oil` varchar(40) DEFAULT NULL,
  `power_steering_oil` varchar(40) DEFAULT NULL,
  `gearbox_oil` varchar(40) DEFAULT NULL,
  `coolant` varchar(40) DEFAULT NULL,
  `brake_oil` varchar(40) DEFAULT NULL,
  `battery` varchar(40) DEFAULT NULL,
  `brakes_front` varchar(40) DEFAULT NULL,
  `brakes_rear` varchar(40) DEFAULT NULL,
  `fuel_level` varchar(40) DEFAULT NULL,
  `vehicle_fluid_leaks` varchar(40) DEFAULT NULL,
  `note` text,
  `document_checklist_report` varchar(40) DEFAULT NULL,
  `next_inspection_date` date DEFAULT NULL,
  `drivers_surname` int DEFAULT NULL,
  `drivers_persal_number` int DEFAULT NULL,
  PRIMARY KEY (`vehicle_daily_check_list_id`),
  KEY `vehicle_registration_number` (`vehicle_registration_number`),
  KEY `closing_km` (`closing_km`),
  KEY `drivers_surname` (`drivers_surname`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle_daily_check_list`
--

INSERT INTO `vehicle_daily_check_list` (`vehicle_daily_check_list_id`, `inspection_certification_number`, `vehicle_registration_number`, `make_of_vehicle`, `closing_km`, `dashboard`, `seats`, `carpets`, `wipers`, `head_lights`, `tail_lights`, `brake_lights`, `indicators`, `windscreen`, `windows`, `mirrors`, `wheels`, `hubcaps`, `sparewheel`, `tools`, `engine_oil`, `power_steering_oil`, `gearbox_oil`, `coolant`, `brake_oil`, `battery`, `brakes_front`, `brakes_rear`, `fuel_level`, `vehicle_fluid_leaks`, `note`, `document_checklist_report`, `next_inspection_date`, `drivers_surname`, `drivers_persal_number`) VALUES
(1, 'LDoTaCS2019/09/11/453', 1, 1, 1, 'Ok', NULL, NULL, 'Ok', 'Ok', NULL, NULL, NULL, 'Ok', 'Ok', 'Ok', NULL, NULL, NULL, NULL, NULL, 'Ok', 'Ok', 'Ok', 'Ok', 'Ok', NULL, 'Ok', 'Ok', 'Ok', '<br>', 'C5-Annex.pdf', '2019-12-17', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_handing_over_checklist`
--

DROP TABLE IF EXISTS `vehicle_handing_over_checklist`;
CREATE TABLE IF NOT EXISTS `vehicle_handing_over_checklist` (
  `vehicle_handing_over_id` int NOT NULL AUTO_INCREMENT,
  `company_name` varchar(40) DEFAULT NULL,
  `company_address` text,
  `company_contact_details` varchar(40) DEFAULT NULL,
  `reason_for_handling_over` text,
  `name_of_department` varchar(40) DEFAULT NULL,
  `name_of_component` varchar(40) DEFAULT NULL,
  `transport_officer_name_and_surname` varchar(40) DEFAULT NULL,
  `transport_officer_email` varchar(40) DEFAULT NULL,
  `job_pre_authorization_number` varchar(40) DEFAULT NULL,
  `vehicle_registration_number` int DEFAULT NULL,
  `closing_km` int DEFAULT NULL,
  `make_of_vehicle` int DEFAULT NULL,
  `model_of_vehicle` int DEFAULT NULL,
  `authorization_number` int DEFAULT NULL,
  `authorization_date` date DEFAULT '0000-00-00',
  `radio_dvd_combination` varchar(40) DEFAULT NULL,
  `number_of_keys_handling_over` varchar(40) DEFAULT NULL,
  `jack_with_handle` varchar(40) DEFAULT NULL,
  `tyre_spare` varchar(40) DEFAULT NULL,
  `tyre_spare_condition` varchar(40) DEFAULT NULL,
  `wheel_spanner` varchar(40) DEFAULT NULL,
  `wheel_cups` text,
  `tri_angles` varchar(40) DEFAULT NULL,
  `mats` text,
  `other` text,
  `number_of_keys` varchar(40) DEFAULT NULL,
  `tyre_r_f` varchar(40) DEFAULT NULL,
  `tyre_r_f_1` varchar(40) DEFAULT NULL,
  `tyre_r_f_1_1` varchar(40) DEFAULT NULL,
  `tyre_r_r` varchar(40) DEFAULT NULL,
  `tyre_r_r_1` varchar(40) DEFAULT NULL,
  `tyre_r_r_1_1` varchar(40) DEFAULT NULL,
  `tyre_l_f` varchar(40) DEFAULT NULL,
  `tyre_l_f_1` varchar(40) DEFAULT NULL,
  `tyre_l_f_1_1` varchar(40) DEFAULT NULL,
  `tyer_l_r` varchar(40) DEFAULT NULL,
  `tyer_l_r_1` varchar(40) DEFAULT NULL,
  `tyre_l_r_1_1` varchar(40) DEFAULT NULL,
  `driver_name_and_surname` int DEFAULT NULL,
  `driver_persal_number` int DEFAULT NULL,
  `driver_signature` varchar(40) DEFAULT NULL,
  `date_checked_in` datetime DEFAULT '2020-01-01 00:00:00',
  `testing_officer_name_and_surname` varchar(40) DEFAULT NULL,
  `testing_officer_signature` varchar(40) DEFAULT NULL,
  `fuel_gauge_amount` varchar(40) DEFAULT NULL,
  `vehicle_marks_1` varchar(40) DEFAULT NULL,
  `vehicle_marks_2` varchar(40) DEFAULT NULL,
  `vehicle_marks_3` varchar(40) DEFAULT NULL,
  `vehicle_marks_4` varchar(40) DEFAULT NULL,
  `vehicle_marks_5` varchar(40) DEFAULT NULL,
  `vehicle_marks_6` varchar(40) DEFAULT NULL,
  `vehicle_marks_7` varchar(40) DEFAULT NULL,
  `vehicle_marks_8` varchar(40) DEFAULT NULL,
  `remarks` text,
  `vehicle_handing_over_ckecklist` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`vehicle_handing_over_id`),
  KEY `vehicle_registration_number` (`vehicle_registration_number`),
  KEY `authorization_number` (`authorization_number`),
  KEY `driver_name_and_surname` (`driver_name_and_surname`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_history`
--

DROP TABLE IF EXISTS `vehicle_history`;
CREATE TABLE IF NOT EXISTS `vehicle_history` (
  `history_id` int NOT NULL AUTO_INCREMENT,
  `vehicle_registration_number` int DEFAULT NULL,
  `engine_number` int DEFAULT NULL,
  `purchased_price` int DEFAULT NULL,
  `old_registration_number` int DEFAULT NULL,
  `new_vehicle_registration_number` varchar(25) DEFAULT NULL,
  `date_of_vehicle_transfer` date DEFAULT NULL,
  `comments` text,
  `renewal_of_license` int DEFAULT NULL,
  `date_of_service` int DEFAULT NULL,
  `date_of_next_service` int DEFAULT NULL,
  `purchased_order_number` int DEFAULT NULL,
  `claim_code` int DEFAULT NULL,
  `tyre_inspection_report` int DEFAULT NULL,
  `inspection_certification_number` int DEFAULT NULL,
  `document_checklist_report` int DEFAULT NULL,
  `next_inspection_date` int DEFAULT '1',
  `breakdown_of_vehicle` varchar(40) DEFAULT NULL,
  `date_of_vehicle_breakdown` date DEFAULT NULL,
  `description_of_vehicle_breakdown` text,
  `closing_km` int DEFAULT NULL,
  `date_of_vehicle_reactivation` datetime DEFAULT NULL,
  `total_cost` int DEFAULT NULL,
  PRIMARY KEY (`history_id`),
  UNIQUE KEY `new_vehicle_registration_number_unique` (`new_vehicle_registration_number`),
  KEY `vehicle_registration_number` (`vehicle_registration_number`),
  KEY `date_of_service` (`date_of_service`),
  KEY `purchased_order_number` (`purchased_order_number`),
  KEY `claim_code` (`claim_code`),
  KEY `tyre_inspection_report` (`tyre_inspection_report`),
  KEY `inspection_certification_number` (`inspection_certification_number`),
  KEY `document_checklist_report` (`document_checklist_report`),
  KEY `next_inspection_date` (`next_inspection_date`),
  KEY `closing_km` (`closing_km`),
  KEY `total_cost` (`total_cost`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_payments`
--

DROP TABLE IF EXISTS `vehicle_payments`;
CREATE TABLE IF NOT EXISTS `vehicle_payments` (
  `vehicle_payment_id` int NOT NULL AUTO_INCREMENT,
  `vehicle_registration_number` int DEFAULT NULL,
  `engine_number` int DEFAULT NULL,
  `chassis_number` int DEFAULT NULL,
  `make_of_vehicle` int DEFAULT NULL,
  `model_of_vehicle` int DEFAULT NULL,
  `year_model_of_vehicle` int DEFAULT NULL,
  `type_of_vehicle` int DEFAULT NULL,
  `application_status` int DEFAULT NULL,
  `barcode_number` int DEFAULT NULL,
  `purchase_price` decimal(10,2) DEFAULT NULL,
  `depreciation_value` decimal(10,2) DEFAULT NULL,
  `closing_km` int DEFAULT NULL,
  `department` int DEFAULT NULL,
  `acquisition_reference` varchar(40) DEFAULT NULL,
  `date_of_acquisition` date DEFAULT NULL,
  `odometer_at_acquisition` varchar(40) DEFAULT NULL,
  `merchant_name` int DEFAULT NULL,
  `value_at_acquisition` decimal(10,2) DEFAULT NULL,
  `term` varchar(40) DEFAULT NULL,
  `month_end` date DEFAULT NULL,
  `installment_per_month` decimal(10,2) DEFAULT NULL,
  `payment_amount` decimal(10,2) DEFAULT NULL,
  `payment_frequency` varchar(40) DEFAULT NULL,
  `interest_rate` int DEFAULT NULL,
  `payment_reference` varchar(40) DEFAULT NULL,
  `paid_so_far` decimal(10,2) DEFAULT NULL,
  `remaining_balance` decimal(10,2) DEFAULT NULL,
  `depreciation_since_purchase` varchar(40) DEFAULT NULL,
  `actual_resale_value` varchar(40) DEFAULT NULL,
  `warranty_expires_on` date DEFAULT NULL,
  `comments` longtext,
  `documents` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`vehicle_payment_id`),
  KEY `vehicle_registration_number` (`vehicle_registration_number`),
  KEY `closing_km` (`closing_km`),
  KEY `merchant_name` (`merchant_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_return_check_list`
--

DROP TABLE IF EXISTS `vehicle_return_check_list`;
CREATE TABLE IF NOT EXISTS `vehicle_return_check_list` (
  `vehicle_return_check_list_id` int NOT NULL AUTO_INCREMENT,
  `vehicle_return_date` date DEFAULT '0000-00-00',
  `job_card_number` varchar(40) DEFAULT NULL,
  `vehicle_registration_number` int DEFAULT NULL,
  `make_of_vehicle` int DEFAULT NULL,
  `model_of_vehicle` int DEFAULT NULL,
  `closing_km` int DEFAULT NULL,
  `radio_dvd_combination` varchar(40) DEFAULT NULL,
  `number_of_keys_handling_over` varchar(40) DEFAULT NULL,
  `jack_with_handle` varchar(40) DEFAULT NULL,
  `tyre_spare` varchar(40) DEFAULT NULL,
  `tyre_spare_condition` varchar(40) DEFAULT NULL,
  `wheel_spanner` varchar(40) DEFAULT NULL,
  `wheel_cups` text,
  `tri_angles` varchar(40) DEFAULT NULL,
  `other` text,
  `number_of_keys` varchar(40) DEFAULT NULL,
  `vehicle_washed` varchar(40) DEFAULT NULL,
  `tyre_r_f` varchar(40) DEFAULT NULL,
  `tyre_r_f_1` varchar(40) DEFAULT NULL,
  `tyre_r_f_1_1` varchar(40) DEFAULT NULL,
  `tyre_r_r` varchar(40) DEFAULT NULL,
  `tyre_r_r_1` varchar(40) DEFAULT NULL,
  `tyre_r_r_1_1` varchar(40) DEFAULT NULL,
  `tyre_l_f` varchar(40) DEFAULT NULL,
  `tyre_l_f_1` varchar(40) DEFAULT NULL,
  `tyre_l_f_1_1` varchar(40) DEFAULT NULL,
  `tyer_l_r` varchar(40) DEFAULT NULL,
  `tyer_l_r_1` varchar(40) DEFAULT NULL,
  `tyre_l_r_1_1` varchar(40) DEFAULT NULL,
  `fuel_gauge_amount` varchar(40) DEFAULT NULL,
  `driver_name_and_surname` int DEFAULT NULL,
  `driver_persal_number` int DEFAULT NULL,
  `driver_signature` varchar(40) DEFAULT NULL,
  `vehicle_return_date_signed` datetime DEFAULT '2020-01-01 00:00:00',
  `testing_officer_name_and_surname` varchar(40) DEFAULT NULL,
  `testing_officer_signature` varchar(40) DEFAULT NULL,
  `vehicle_marks_1` varchar(40) DEFAULT NULL,
  `vehicle_marks_2` varchar(40) DEFAULT NULL,
  `vehicle_marks_3` varchar(40) DEFAULT NULL,
  `vehicle_marks_4` varchar(40) DEFAULT NULL,
  `vehicle_marks_5` varchar(40) DEFAULT NULL,
  `vehicle_marks_6` varchar(40) DEFAULT NULL,
  `vehicle_marks_7` varchar(40) DEFAULT NULL,
  `vehicle_marks_8` varchar(40) DEFAULT NULL,
  `remarks` text,
  `vehicle_return_list` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`vehicle_return_check_list_id`),
  KEY `vehicle_registration_number` (`vehicle_registration_number`),
  KEY `closing_km` (`closing_km`),
  KEY `driver_name_and_surname` (`driver_name_and_surname`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `withdrawal_vehicle_from_operation`
--

DROP TABLE IF EXISTS `withdrawal_vehicle_from_operation`;
CREATE TABLE IF NOT EXISTS `withdrawal_vehicle_from_operation` (
  `withdrawal_id` int NOT NULL AUTO_INCREMENT,
  `supervisor_name_and_surname` varchar(40) DEFAULT NULL,
  `supervisor_contact_details` varchar(40) DEFAULT NULL,
  `supervisor_email_address` varchar(40) DEFAULT NULL,
  `supervisor_signature` varchar(40) DEFAULT NULL,
  `vehicle_registration_number` int DEFAULT NULL,
  `engine_number` int DEFAULT NULL,
  `make_of_vehicle` int DEFAULT NULL,
  `purchased_price` int DEFAULT NULL,
  `date_of_service` int DEFAULT NULL,
  `date_of_next_service` int DEFAULT NULL,
  `renewal_of_license` int DEFAULT NULL,
  `date_of_vehicle` datetime DEFAULT NULL,
  `description_of_vehicle_breakdown` text,
  `tyre_inspection_report` varchar(40) DEFAULT NULL,
  `document_checklist_report` varchar(40) DEFAULT NULL,
  `compiled_technical_report` varchar(40) DEFAULT NULL,
  `district_officer_name_and_surname` varchar(40) DEFAULT NULL,
  `district_officer_persal_number` varchar(40) DEFAULT NULL,
  `district_officer_contacts` varchar(40) DEFAULT NULL,
  `district_officer_signature` varchar(40) DEFAULT NULL,
  `district_officer_email_address` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`withdrawal_id`),
  KEY `vehicle_registration_number` (`vehicle_registration_number`),
  KEY `date_of_service` (`date_of_service`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `work_allocation`
--

DROP TABLE IF EXISTS `work_allocation`;
CREATE TABLE IF NOT EXISTS `work_allocation` (
  `work_allocation_id` int NOT NULL AUTO_INCREMENT,
  `supervisor_name_and_surname` varchar(40) DEFAULT NULL,
  `supervisor_contact_details` varchar(40) DEFAULT NULL,
  `supervisor_email_address` varchar(40) DEFAULT NULL,
  `supervisor_signature` varchar(40) DEFAULT NULL,
  `economical_repair` varchar(40) DEFAULT NULL,
  `uneconomical_repair` varchar(40) DEFAULT NULL,
  `work_allocation_reference_number` varchar(40) DEFAULT NULL,
  `vehicle_registration_number` int DEFAULT NULL,
  `engine_number` int DEFAULT NULL,
  `make_of_vehicle` int DEFAULT NULL,
  `date_captured` datetime DEFAULT NULL,
  `district` int DEFAULT NULL,
  `location` int DEFAULT NULL,
  `cost_centre` int DEFAULT NULL,
  PRIMARY KEY (`work_allocation_id`),
  UNIQUE KEY `uneconomical_repair_unique` (`uneconomical_repair`),
  KEY `vehicle_registration_number` (`vehicle_registration_number`),
  KEY `district` (`district`),
  KEY `cost_centre` (`cost_centre`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_allocation`
--

INSERT INTO `work_allocation` (`work_allocation_id`, `supervisor_name_and_surname`, `supervisor_contact_details`, `supervisor_email_address`, `supervisor_signature`, `economical_repair`, `uneconomical_repair`, `work_allocation_reference_number`, `vehicle_registration_number`, `engine_number`, `make_of_vehicle`, `date_captured`, `district`, `location`, `cost_centre`) VALUES
(1, NULL, NULL, NULL, NULL, 'Yes', NULL, 'LDTCS0312-Dilokong', 1, 1, 1, '2020-03-30 15:43:34', 58, 58, 3),
(2, 'Karabo Makgabo', '0152951000', 'makgabok@dtcs.limpopo.gov.za', NULL, 'Yes', NULL, 'WA-2020-0414-Polokwane', 2, 2, 2, '2020-04-14 21:38:57', 9, 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `year_model`
--

DROP TABLE IF EXISTS `year_model`;
CREATE TABLE IF NOT EXISTS `year_model` (
  `year_model_id` int NOT NULL AUTO_INCREMENT,
  `year_model_specification` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`year_model_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `year_model`
--

INSERT INTO `year_model` (`year_model_id`, `year_model_specification`) VALUES
(1, '2007'),
(2, '2008'),
(3, '2009'),
(4, '2010'),
(5, '2011'),
(6, '2012'),
(7, '2013'),
(8, '2014'),
(9, '2015'),
(10, '2016'),
(11, '2017'),
(12, '2018'),
(13, '2019'),
(14, '2020'),
(15, '2021'),
(16, '2022'),
(17, '2023'),
(18, '2024'),
(19, '2025'),
(20, 'DAILY TURBO');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
