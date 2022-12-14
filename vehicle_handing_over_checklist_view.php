<?php
// This script and data application were generated by AppGini 22.13
// Download AppGini for free from https://bigprof.com/appgini/download/

	include_once(__DIR__ . '/lib.php');
	@include_once(__DIR__ . '/hooks/vehicle_handing_over_checklist.php');
	include_once(__DIR__ . '/vehicle_handing_over_checklist_dml.php');

	// mm: can the current member access this page?
	$perm = getTablePermissions('vehicle_handing_over_checklist');
	if(!$perm['access']) {
		echo error_message($Translation['tableAccessDenied']);
		exit;
	}

	$x = new DataList;
	$x->TableName = 'vehicle_handing_over_checklist';

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = [
		"`vehicle_handing_over_checklist`.`vehicle_handing_over_id`" => "vehicle_handing_over_id",
		"`vehicle_handing_over_checklist`.`company_name`" => "company_name",
		"`vehicle_handing_over_checklist`.`company_address`" => "company_address",
		"`vehicle_handing_over_checklist`.`company_contact_details`" => "company_contact_details",
		"`vehicle_handing_over_checklist`.`reason_for_handling_over`" => "reason_for_handling_over",
		"`vehicle_handing_over_checklist`.`name_of_department`" => "name_of_department",
		"`vehicle_handing_over_checklist`.`name_of_component`" => "name_of_component",
		"`vehicle_handing_over_checklist`.`transport_officer_name_and_surname`" => "transport_officer_name_and_surname",
		"`vehicle_handing_over_checklist`.`transport_officer_email`" => "transport_officer_email",
		"`vehicle_handing_over_checklist`.`job_pre_authorization_number`" => "job_pre_authorization_number",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`), '') /* Vehicle Registration Number: */" => "vehicle_registration_number",
		"IF(    CHAR_LENGTH(`log_sheet1`.`closing_km`), CONCAT_WS('',   `log_sheet1`.`closing_km`, '     '), '') /* Odometer Reading/Closing KM: */" => "closing_km",
		"IF(    CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS('',   `dealer1`.`make_of_vehicle`, '   '), '') /* Make of Vehicle: */" => "make_of_vehicle",
		"IF(    CHAR_LENGTH(`gmt_fleet_register3`.`model_of_vehicle`), CONCAT_WS('',   `gmt_fleet_register3`.`model_of_vehicle`), '') /* Model of Vehicle: */" => "model_of_vehicle",
		"IF(    CHAR_LENGTH(`claim1`.`authorization_number`) || CHAR_LENGTH(`merchant1`.`merchant_name`) || CHAR_LENGTH(`merchant1`.`merchant_code`), CONCAT_WS('',   `claim1`.`authorization_number`, '  |   and    |    ', `merchant1`.`merchant_name`, '     |   and    |   ', `merchant1`.`merchant_code`), '') /* Authorization Number: */" => "authorization_number",
		"FORMAT(`vehicle_handing_over_checklist`.`authorization_date`, 2)" => "authorization_date",
		"`vehicle_handing_over_checklist`.`radio_dvd_combination`" => "radio_dvd_combination",
		"`vehicle_handing_over_checklist`.`number_of_keys_handling_over`" => "number_of_keys_handling_over",
		"`vehicle_handing_over_checklist`.`jack_with_handle`" => "jack_with_handle",
		"`vehicle_handing_over_checklist`.`tyre_spare`" => "tyre_spare",
		"`vehicle_handing_over_checklist`.`tyre_spare_condition`" => "tyre_spare_condition",
		"`vehicle_handing_over_checklist`.`wheel_spanner`" => "wheel_spanner",
		"`vehicle_handing_over_checklist`.`wheel_cups`" => "wheel_cups",
		"`vehicle_handing_over_checklist`.`tri_angles`" => "tri_angles",
		"`vehicle_handing_over_checklist`.`mats`" => "mats",
		"`vehicle_handing_over_checklist`.`other`" => "other",
		"`vehicle_handing_over_checklist`.`number_of_keys`" => "number_of_keys",
		"`vehicle_handing_over_checklist`.`tyre_r_f`" => "tyre_r_f",
		"`vehicle_handing_over_checklist`.`tyre_r_f_1`" => "tyre_r_f_1",
		"`vehicle_handing_over_checklist`.`tyre_r_f_1_1`" => "tyre_r_f_1_1",
		"`vehicle_handing_over_checklist`.`tyre_r_r`" => "tyre_r_r",
		"`vehicle_handing_over_checklist`.`tyre_r_r_1`" => "tyre_r_r_1",
		"`vehicle_handing_over_checklist`.`tyre_r_r_1_1`" => "tyre_r_r_1_1",
		"`vehicle_handing_over_checklist`.`tyre_l_f`" => "tyre_l_f",
		"`vehicle_handing_over_checklist`.`tyre_l_f_1`" => "tyre_l_f_1",
		"`vehicle_handing_over_checklist`.`tyre_l_f_1_1`" => "tyre_l_f_1_1",
		"`vehicle_handing_over_checklist`.`tyer_l_r`" => "tyer_l_r",
		"`vehicle_handing_over_checklist`.`tyer_l_r_1`" => "tyer_l_r_1",
		"`vehicle_handing_over_checklist`.`tyre_l_r_1_1`" => "tyre_l_r_1_1",
		"IF(    CHAR_LENGTH(`driver1`.`drivers_name_and_surname`) || CHAR_LENGTH(`driver1`.`drivers_persal_number`), CONCAT_WS('',   `driver1`.`drivers_name_and_surname`, '    |    and    |     ', `driver1`.`drivers_persal_number`), '') /* Driver Name: */" => "driver_name_and_surname",
		"IF(    CHAR_LENGTH(`driver1`.`drivers_persal_number`) || CHAR_LENGTH(`driver1`.`drivers_license_number`), CONCAT_WS('',   `driver1`.`drivers_persal_number`, '    |   and    |   ', `driver1`.`drivers_license_number`), '') /* Driver Persal Number: */" => "driver_persal_number",
		"`vehicle_handing_over_checklist`.`driver_signature`" => "driver_signature",
		"if(`vehicle_handing_over_checklist`.`date_checked_in`,date_format(`vehicle_handing_over_checklist`.`date_checked_in`,'%d/%m/%Y %H:%i'),'')" => "date_checked_in",
		"`vehicle_handing_over_checklist`.`testing_officer_name_and_surname`" => "testing_officer_name_and_surname",
		"`vehicle_handing_over_checklist`.`testing_officer_signature`" => "testing_officer_signature",
		"`vehicle_handing_over_checklist`.`fuel_gauge_amount`" => "fuel_gauge_amount",
		"`vehicle_handing_over_checklist`.`vehicle_marks_1`" => "vehicle_marks_1",
		"`vehicle_handing_over_checklist`.`vehicle_marks_2`" => "vehicle_marks_2",
		"`vehicle_handing_over_checklist`.`vehicle_marks_3`" => "vehicle_marks_3",
		"`vehicle_handing_over_checklist`.`vehicle_marks_4`" => "vehicle_marks_4",
		"`vehicle_handing_over_checklist`.`vehicle_marks_5`" => "vehicle_marks_5",
		"`vehicle_handing_over_checklist`.`vehicle_marks_6`" => "vehicle_marks_6",
		"`vehicle_handing_over_checklist`.`vehicle_marks_7`" => "vehicle_marks_7",
		"`vehicle_handing_over_checklist`.`vehicle_marks_8`" => "vehicle_marks_8",
		"`vehicle_handing_over_checklist`.`remarks`" => "remarks",
		"`vehicle_handing_over_checklist`.`vehicle_handing_over_ckecklist`" => "vehicle_handing_over_ckecklist",
	];
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = [
		1 => '`vehicle_handing_over_checklist`.`vehicle_handing_over_id`',
		2 => 2,
		3 => 3,
		4 => 4,
		5 => 5,
		6 => 6,
		7 => 7,
		8 => 8,
		9 => 9,
		10 => 10,
		11 => 11,
		12 => 12,
		13 => 13,
		14 => 14,
		15 => 15,
		16 => '`vehicle_handing_over_checklist`.`authorization_date`',
		17 => 17,
		18 => 18,
		19 => 19,
		20 => 20,
		21 => 21,
		22 => 22,
		23 => 23,
		24 => 24,
		25 => 25,
		26 => 26,
		27 => 27,
		28 => 28,
		29 => 29,
		30 => 30,
		31 => 31,
		32 => 32,
		33 => 33,
		34 => 34,
		35 => 35,
		36 => 36,
		37 => 37,
		38 => 38,
		39 => 39,
		40 => 40,
		41 => 41,
		42 => 42,
		43 => '`vehicle_handing_over_checklist`.`date_checked_in`',
		44 => 44,
		45 => 45,
		46 => 46,
		47 => 47,
		48 => 48,
		49 => 49,
		50 => 50,
		51 => 51,
		52 => 52,
		53 => 53,
		54 => 54,
		55 => 55,
		56 => 56,
	];

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = [
		"`vehicle_handing_over_checklist`.`vehicle_handing_over_id`" => "vehicle_handing_over_id",
		"`vehicle_handing_over_checklist`.`company_name`" => "company_name",
		"`vehicle_handing_over_checklist`.`company_address`" => "company_address",
		"`vehicle_handing_over_checklist`.`company_contact_details`" => "company_contact_details",
		"`vehicle_handing_over_checklist`.`reason_for_handling_over`" => "reason_for_handling_over",
		"`vehicle_handing_over_checklist`.`name_of_department`" => "name_of_department",
		"`vehicle_handing_over_checklist`.`name_of_component`" => "name_of_component",
		"`vehicle_handing_over_checklist`.`transport_officer_name_and_surname`" => "transport_officer_name_and_surname",
		"`vehicle_handing_over_checklist`.`transport_officer_email`" => "transport_officer_email",
		"`vehicle_handing_over_checklist`.`job_pre_authorization_number`" => "job_pre_authorization_number",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`), '') /* Vehicle Registration Number: */" => "vehicle_registration_number",
		"IF(    CHAR_LENGTH(`log_sheet1`.`closing_km`), CONCAT_WS('',   `log_sheet1`.`closing_km`, '     '), '') /* Odometer Reading/Closing KM: */" => "closing_km",
		"IF(    CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS('',   `dealer1`.`make_of_vehicle`, '   '), '') /* Make of Vehicle: */" => "make_of_vehicle",
		"IF(    CHAR_LENGTH(`gmt_fleet_register3`.`model_of_vehicle`), CONCAT_WS('',   `gmt_fleet_register3`.`model_of_vehicle`), '') /* Model of Vehicle: */" => "model_of_vehicle",
		"IF(    CHAR_LENGTH(`claim1`.`authorization_number`) || CHAR_LENGTH(`merchant1`.`merchant_name`) || CHAR_LENGTH(`merchant1`.`merchant_code`), CONCAT_WS('',   `claim1`.`authorization_number`, '  |   and    |    ', `merchant1`.`merchant_name`, '     |   and    |   ', `merchant1`.`merchant_code`), '') /* Authorization Number: */" => "authorization_number",
		"FORMAT(`vehicle_handing_over_checklist`.`authorization_date`, 2)" => "authorization_date",
		"`vehicle_handing_over_checklist`.`radio_dvd_combination`" => "radio_dvd_combination",
		"`vehicle_handing_over_checklist`.`number_of_keys_handling_over`" => "number_of_keys_handling_over",
		"`vehicle_handing_over_checklist`.`jack_with_handle`" => "jack_with_handle",
		"`vehicle_handing_over_checklist`.`tyre_spare`" => "tyre_spare",
		"`vehicle_handing_over_checklist`.`tyre_spare_condition`" => "tyre_spare_condition",
		"`vehicle_handing_over_checklist`.`wheel_spanner`" => "wheel_spanner",
		"`vehicle_handing_over_checklist`.`wheel_cups`" => "wheel_cups",
		"`vehicle_handing_over_checklist`.`tri_angles`" => "tri_angles",
		"`vehicle_handing_over_checklist`.`mats`" => "mats",
		"`vehicle_handing_over_checklist`.`other`" => "other",
		"`vehicle_handing_over_checklist`.`number_of_keys`" => "number_of_keys",
		"`vehicle_handing_over_checklist`.`tyre_r_f`" => "tyre_r_f",
		"`vehicle_handing_over_checklist`.`tyre_r_f_1`" => "tyre_r_f_1",
		"`vehicle_handing_over_checklist`.`tyre_r_f_1_1`" => "tyre_r_f_1_1",
		"`vehicle_handing_over_checklist`.`tyre_r_r`" => "tyre_r_r",
		"`vehicle_handing_over_checklist`.`tyre_r_r_1`" => "tyre_r_r_1",
		"`vehicle_handing_over_checklist`.`tyre_r_r_1_1`" => "tyre_r_r_1_1",
		"`vehicle_handing_over_checklist`.`tyre_l_f`" => "tyre_l_f",
		"`vehicle_handing_over_checklist`.`tyre_l_f_1`" => "tyre_l_f_1",
		"`vehicle_handing_over_checklist`.`tyre_l_f_1_1`" => "tyre_l_f_1_1",
		"`vehicle_handing_over_checklist`.`tyer_l_r`" => "tyer_l_r",
		"`vehicle_handing_over_checklist`.`tyer_l_r_1`" => "tyer_l_r_1",
		"`vehicle_handing_over_checklist`.`tyre_l_r_1_1`" => "tyre_l_r_1_1",
		"IF(    CHAR_LENGTH(`driver1`.`drivers_name_and_surname`) || CHAR_LENGTH(`driver1`.`drivers_persal_number`), CONCAT_WS('',   `driver1`.`drivers_name_and_surname`, '    |    and    |     ', `driver1`.`drivers_persal_number`), '') /* Driver Name: */" => "driver_name_and_surname",
		"IF(    CHAR_LENGTH(`driver1`.`drivers_persal_number`) || CHAR_LENGTH(`driver1`.`drivers_license_number`), CONCAT_WS('',   `driver1`.`drivers_persal_number`, '    |   and    |   ', `driver1`.`drivers_license_number`), '') /* Driver Persal Number: */" => "driver_persal_number",
		"`vehicle_handing_over_checklist`.`driver_signature`" => "driver_signature",
		"if(`vehicle_handing_over_checklist`.`date_checked_in`,date_format(`vehicle_handing_over_checklist`.`date_checked_in`,'%d/%m/%Y %H:%i'),'')" => "date_checked_in",
		"`vehicle_handing_over_checklist`.`testing_officer_name_and_surname`" => "testing_officer_name_and_surname",
		"`vehicle_handing_over_checklist`.`testing_officer_signature`" => "testing_officer_signature",
		"`vehicle_handing_over_checklist`.`fuel_gauge_amount`" => "fuel_gauge_amount",
		"`vehicle_handing_over_checklist`.`vehicle_marks_1`" => "vehicle_marks_1",
		"`vehicle_handing_over_checklist`.`vehicle_marks_2`" => "vehicle_marks_2",
		"`vehicle_handing_over_checklist`.`vehicle_marks_3`" => "vehicle_marks_3",
		"`vehicle_handing_over_checklist`.`vehicle_marks_4`" => "vehicle_marks_4",
		"`vehicle_handing_over_checklist`.`vehicle_marks_5`" => "vehicle_marks_5",
		"`vehicle_handing_over_checklist`.`vehicle_marks_6`" => "vehicle_marks_6",
		"`vehicle_handing_over_checklist`.`vehicle_marks_7`" => "vehicle_marks_7",
		"`vehicle_handing_over_checklist`.`vehicle_marks_8`" => "vehicle_marks_8",
		"`vehicle_handing_over_checklist`.`remarks`" => "remarks",
		"`vehicle_handing_over_checklist`.`vehicle_handing_over_ckecklist`" => "vehicle_handing_over_ckecklist",
	];
	// Fields that can be filtered
	$x->QueryFieldsFilters = [
		"`vehicle_handing_over_checklist`.`vehicle_handing_over_id`" => "Vehicle Handing Over  Check List ID:",
		"`vehicle_handing_over_checklist`.`company_name`" => "Merchant/Agent/Panel Beater Name:",
		"`vehicle_handing_over_checklist`.`company_address`" => "Merchant/Agent/Panel Beater Address:",
		"`vehicle_handing_over_checklist`.`company_contact_details`" => "Merchant/Agent/Panel Beater Contact Details:",
		"`vehicle_handing_over_checklist`.`reason_for_handling_over`" => "Reason for Handing Over of Departmental Vehicle:",
		"`vehicle_handing_over_checklist`.`name_of_department`" => "Name of Department:",
		"`vehicle_handing_over_checklist`.`name_of_component`" => "Name of Component:",
		"`vehicle_handing_over_checklist`.`transport_officer_name_and_surname`" => "Transport Officer Details:",
		"`vehicle_handing_over_checklist`.`transport_officer_email`" => "Transport Officer e-Mail:",
		"`vehicle_handing_over_checklist`.`job_pre_authorization_number`" => "Job Pre-Authorization Number:",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`), '') /* Vehicle Registration Number: */" => "Vehicle Registration Number:",
		"IF(    CHAR_LENGTH(`log_sheet1`.`closing_km`), CONCAT_WS('',   `log_sheet1`.`closing_km`, '     '), '') /* Odometer Reading/Closing KM: */" => "Odometer Reading/Closing KM:",
		"IF(    CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS('',   `dealer1`.`make_of_vehicle`, '   '), '') /* Make of Vehicle: */" => "Make of Vehicle:",
		"IF(    CHAR_LENGTH(`gmt_fleet_register3`.`model_of_vehicle`), CONCAT_WS('',   `gmt_fleet_register3`.`model_of_vehicle`), '') /* Model of Vehicle: */" => "Model of Vehicle:",
		"IF(    CHAR_LENGTH(`claim1`.`authorization_number`) || CHAR_LENGTH(`merchant1`.`merchant_name`) || CHAR_LENGTH(`merchant1`.`merchant_code`), CONCAT_WS('',   `claim1`.`authorization_number`, '  |   and    |    ', `merchant1`.`merchant_name`, '     |   and    |   ', `merchant1`.`merchant_code`), '') /* Authorization Number: */" => "Authorization Number:",
		"`vehicle_handing_over_checklist`.`authorization_date`" => "Authorization Date:",
		"`vehicle_handing_over_checklist`.`radio_dvd_combination`" => "Radio/DVD Combination:",
		"`vehicle_handing_over_checklist`.`number_of_keys_handling_over`" => "Number of Keys Handling Over:",
		"`vehicle_handing_over_checklist`.`jack_with_handle`" => "Jack with Handle:",
		"`vehicle_handing_over_checklist`.`tyre_spare`" => "Tyre Spare (Available):",
		"`vehicle_handing_over_checklist`.`tyre_spare_condition`" => "Tyre Spare (Thread Condition):",
		"`vehicle_handing_over_checklist`.`wheel_spanner`" => "Wheel Spanner:",
		"`vehicle_handing_over_checklist`.`wheel_cups`" => "Wheel Hub Cups (Available):",
		"`vehicle_handing_over_checklist`.`tri_angles`" => "Tri Angles Available:",
		"`vehicle_handing_over_checklist`.`mats`" => "Mats:",
		"`vehicle_handing_over_checklist`.`other`" => "Other (specify):",
		"`vehicle_handing_over_checklist`.`number_of_keys`" => "Number of Keys Handed Over:",
		"`vehicle_handing_over_checklist`.`tyre_r_f`" => "Tyre R/F (Available):",
		"`vehicle_handing_over_checklist`.`tyre_r_f_1`" => "Tyre R/F (Thread Condition):",
		"`vehicle_handing_over_checklist`.`tyre_r_f_1_1`" => "Tyre R/F Brand:",
		"`vehicle_handing_over_checklist`.`tyre_r_r`" => "Tyre R/R (Available):",
		"`vehicle_handing_over_checklist`.`tyre_r_r_1`" => "Tyre R/R (Available):",
		"`vehicle_handing_over_checklist`.`tyre_r_r_1_1`" => "Tyre R/F Brand:",
		"`vehicle_handing_over_checklist`.`tyre_l_f`" => "Tyre L/F (Available):",
		"`vehicle_handing_over_checklist`.`tyre_l_f_1`" => "Tyre L/F (Thread Condition):",
		"`vehicle_handing_over_checklist`.`tyre_l_f_1_1`" => "Tyre R/F Brand:",
		"`vehicle_handing_over_checklist`.`tyer_l_r`" => "Tyre L/R (Available):",
		"`vehicle_handing_over_checklist`.`tyer_l_r_1`" => "Tyre L/R (Thread Condition):",
		"`vehicle_handing_over_checklist`.`tyre_l_r_1_1`" => "Tyre R/F Brand:",
		"IF(    CHAR_LENGTH(`driver1`.`drivers_name_and_surname`) || CHAR_LENGTH(`driver1`.`drivers_persal_number`), CONCAT_WS('',   `driver1`.`drivers_name_and_surname`, '    |    and    |     ', `driver1`.`drivers_persal_number`), '') /* Driver Name: */" => "Driver Name:",
		"IF(    CHAR_LENGTH(`driver1`.`drivers_persal_number`) || CHAR_LENGTH(`driver1`.`drivers_license_number`), CONCAT_WS('',   `driver1`.`drivers_persal_number`, '    |   and    |   ', `driver1`.`drivers_license_number`), '') /* Driver Persal Number: */" => "Driver Persal Number:",
		"`vehicle_handing_over_checklist`.`date_checked_in`" => "Declaration Date & Time:",
		"`vehicle_handing_over_checklist`.`testing_officer_name_and_surname`" => "Testing Officer/Tradesman Aid Name & Surname:",
		"`vehicle_handing_over_checklist`.`fuel_gauge_amount`" => "Fuel Gauge Amount:",
		"`vehicle_handing_over_checklist`.`remarks`" => "Remarks about Vehicle:",
		"`vehicle_handing_over_checklist`.`vehicle_handing_over_ckecklist`" => "Vehicle Handing Over Ckecklist:",
	];

	// Fields that can be quick searched
	$x->QueryFieldsQS = [
		"`vehicle_handing_over_checklist`.`vehicle_handing_over_id`" => "vehicle_handing_over_id",
		"`vehicle_handing_over_checklist`.`company_name`" => "company_name",
		"`vehicle_handing_over_checklist`.`company_address`" => "company_address",
		"`vehicle_handing_over_checklist`.`company_contact_details`" => "company_contact_details",
		"`vehicle_handing_over_checklist`.`reason_for_handling_over`" => "reason_for_handling_over",
		"`vehicle_handing_over_checklist`.`name_of_department`" => "name_of_department",
		"`vehicle_handing_over_checklist`.`name_of_component`" => "name_of_component",
		"`vehicle_handing_over_checklist`.`transport_officer_name_and_surname`" => "transport_officer_name_and_surname",
		"`vehicle_handing_over_checklist`.`transport_officer_email`" => "transport_officer_email",
		"`vehicle_handing_over_checklist`.`job_pre_authorization_number`" => "job_pre_authorization_number",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`), '') /* Vehicle Registration Number: */" => "vehicle_registration_number",
		"IF(    CHAR_LENGTH(`log_sheet1`.`closing_km`), CONCAT_WS('',   `log_sheet1`.`closing_km`, '     '), '') /* Odometer Reading/Closing KM: */" => "closing_km",
		"IF(    CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS('',   `dealer1`.`make_of_vehicle`, '   '), '') /* Make of Vehicle: */" => "make_of_vehicle",
		"IF(    CHAR_LENGTH(`gmt_fleet_register3`.`model_of_vehicle`), CONCAT_WS('',   `gmt_fleet_register3`.`model_of_vehicle`), '') /* Model of Vehicle: */" => "model_of_vehicle",
		"IF(    CHAR_LENGTH(`claim1`.`authorization_number`) || CHAR_LENGTH(`merchant1`.`merchant_name`) || CHAR_LENGTH(`merchant1`.`merchant_code`), CONCAT_WS('',   `claim1`.`authorization_number`, '  |   and    |    ', `merchant1`.`merchant_name`, '     |   and    |   ', `merchant1`.`merchant_code`), '') /* Authorization Number: */" => "authorization_number",
		"FORMAT(`vehicle_handing_over_checklist`.`authorization_date`, 2)" => "authorization_date",
		"`vehicle_handing_over_checklist`.`radio_dvd_combination`" => "radio_dvd_combination",
		"`vehicle_handing_over_checklist`.`number_of_keys_handling_over`" => "number_of_keys_handling_over",
		"`vehicle_handing_over_checklist`.`jack_with_handle`" => "jack_with_handle",
		"`vehicle_handing_over_checklist`.`tyre_spare`" => "tyre_spare",
		"`vehicle_handing_over_checklist`.`tyre_spare_condition`" => "tyre_spare_condition",
		"`vehicle_handing_over_checklist`.`wheel_spanner`" => "wheel_spanner",
		"`vehicle_handing_over_checklist`.`wheel_cups`" => "wheel_cups",
		"`vehicle_handing_over_checklist`.`tri_angles`" => "tri_angles",
		"`vehicle_handing_over_checklist`.`mats`" => "mats",
		"`vehicle_handing_over_checklist`.`other`" => "other",
		"`vehicle_handing_over_checklist`.`number_of_keys`" => "number_of_keys",
		"`vehicle_handing_over_checklist`.`tyre_r_f`" => "tyre_r_f",
		"`vehicle_handing_over_checklist`.`tyre_r_f_1`" => "tyre_r_f_1",
		"`vehicle_handing_over_checklist`.`tyre_r_f_1_1`" => "tyre_r_f_1_1",
		"`vehicle_handing_over_checklist`.`tyre_r_r`" => "tyre_r_r",
		"`vehicle_handing_over_checklist`.`tyre_r_r_1`" => "tyre_r_r_1",
		"`vehicle_handing_over_checklist`.`tyre_r_r_1_1`" => "tyre_r_r_1_1",
		"`vehicle_handing_over_checklist`.`tyre_l_f`" => "tyre_l_f",
		"`vehicle_handing_over_checklist`.`tyre_l_f_1`" => "tyre_l_f_1",
		"`vehicle_handing_over_checklist`.`tyre_l_f_1_1`" => "tyre_l_f_1_1",
		"`vehicle_handing_over_checklist`.`tyer_l_r`" => "tyer_l_r",
		"`vehicle_handing_over_checklist`.`tyer_l_r_1`" => "tyer_l_r_1",
		"`vehicle_handing_over_checklist`.`tyre_l_r_1_1`" => "tyre_l_r_1_1",
		"IF(    CHAR_LENGTH(`driver1`.`drivers_name_and_surname`) || CHAR_LENGTH(`driver1`.`drivers_persal_number`), CONCAT_WS('',   `driver1`.`drivers_name_and_surname`, '    |    and    |     ', `driver1`.`drivers_persal_number`), '') /* Driver Name: */" => "driver_name_and_surname",
		"IF(    CHAR_LENGTH(`driver1`.`drivers_persal_number`) || CHAR_LENGTH(`driver1`.`drivers_license_number`), CONCAT_WS('',   `driver1`.`drivers_persal_number`, '    |   and    |   ', `driver1`.`drivers_license_number`), '') /* Driver Persal Number: */" => "driver_persal_number",
		"if(`vehicle_handing_over_checklist`.`date_checked_in`,date_format(`vehicle_handing_over_checklist`.`date_checked_in`,'%d/%m/%Y %H:%i'),'')" => "date_checked_in",
		"`vehicle_handing_over_checklist`.`testing_officer_name_and_surname`" => "testing_officer_name_and_surname",
		"`vehicle_handing_over_checklist`.`fuel_gauge_amount`" => "fuel_gauge_amount",
		"`vehicle_handing_over_checklist`.`remarks`" => "remarks",
		"`vehicle_handing_over_checklist`.`vehicle_handing_over_ckecklist`" => "vehicle_handing_over_ckecklist",
	];

	// Lookup fields that can be used as filterers
	$x->filterers = ['vehicle_registration_number' => 'Vehicle Registration Number:', 'authorization_number' => 'Authorization Number:', 'driver_name_and_surname' => 'Driver Name:', ];

	$x->QueryFrom = "`vehicle_handing_over_checklist` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`vehicle_handing_over_checklist`.`vehicle_registration_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`log_sheet1`.`vehicle_registration_number` LEFT JOIN `claim` as claim1 ON `claim1`.`claim_id`=`vehicle_handing_over_checklist`.`authorization_number` LEFT JOIN `merchant` as merchant1 ON `merchant1`.`merchant_id`=`claim1`.`merchant_name` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`vehicle_handing_over_checklist`.`driver_name_and_surname` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register3 ON `gmt_fleet_register3`.`fleet_asset_id`=`log_sheet1`.`model_of_vehicle` ";
	$x->QueryWhere = '';
	$x->QueryOrder = '';

	$x->AllowSelection = 1;
	$x->HideTableView = ($perm['view'] == 0 ? 1 : 0);
	$x->AllowDelete = $perm['delete'];
	$x->AllowMassDelete = (getLoggedAdmin() !== false);
	$x->AllowInsert = $perm['insert'];
	$x->AllowUpdate = $perm['edit'];
	$x->SeparateDV = 1;
	$x->AllowDeleteOfParents = 0;
	$x->AllowFilters = 1;
	$x->AllowSavingFilters = (getLoggedAdmin() !== false);
	$x->AllowSorting = 1;
	$x->AllowNavigation = 1;
	$x->AllowPrinting = 1;
	$x->AllowPrintingDV = 1;
	$x->AllowCSV = 1;
	$x->RecordsPerPage = 25;
	$x->QuickSearch = 1;
	$x->QuickSearchText = $Translation['quick search'];
	$x->ScriptFileName = 'vehicle_handing_over_checklist_view.php';
	$x->RedirectAfterInsert = 'vehicle_handing_over_checklist_view.php?SelectedID=#ID#';
	$x->TableTitle = 'Vehicle Handing Over Checklist:';
	$x->TableIcon = 'resources/table_icons/CarHeadUnit_Map.png';
	$x->PrimaryKey = '`vehicle_handing_over_checklist`.`vehicle_handing_over_id`';

	$x->ColWidth = [150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, ];
	$x->ColCaption = ['Vehicle Handing Over  Check List ID:', 'Merchant/Agent/Panel Beater Name:', 'Merchant/Agent/Panel Beater Address:', 'Merchant/Agent/Panel Beater Contact Details:', 'Reason for Handing Over of Departmental Vehicle:', 'Name of Department:', 'Name of Component:', 'Transport Officer Details:', 'Transport Officer e-Mail:', 'Job Pre-Authorization Number:', 'Vehicle Registration Number:', 'Odometer Reading/Closing KM:', 'Make of Vehicle:', 'Model of Vehicle:', 'Authorization Number:', 'Authorization Date:', 'Radio/DVD Combination:', 'Number of Keys Handling Over:', 'Jack with Handle:', 'Tyre Spare (Available):', 'Tyre Spare (Thread Condition):', 'Wheel Spanner:', 'Wheel Hub Cups (Available):', 'Tri Angles Available:', 'Mats:', 'Other (specify):', 'Number of Keys Handed Over:', 'Tyre R/F (Available):', 'Tyre R/F (Thread Condition):', 'Tyre R/F Brand:', 'Tyre R/R (Available):', 'Tyre R/R (Available):', 'Tyre R/F Brand:', 'Tyre L/F (Available):', 'Tyre L/F (Thread Condition):', 'Tyre R/F Brand:', 'Tyre L/R (Available):', 'Tyre L/R (Thread Condition):', 'Tyre R/F Brand:', 'Driver Name:', 'Driver Persal Number:', 'Driver Signature:', 'Declaration Date & Time:', 'Testing Officer/Tradesman Aid Name & Surname:', 'Testing Officer/Tradesman Aid Signature:', 'Fuel Gauge Amount:', 'Vehicle Marks (1):', 'Vehicle Marks(2):', 'Vehicle Marks(3):', 'Vehicle Marks(4):', 'Vehicle Marks(5):', 'Vehicle Marks(6):', 'Vehicle Marks(7):', 'Vehicle Marks (8):', 'Remarks about Vehicle:', 'Vehicle Handing Over Ckecklist:', ];
	$x->ColFieldName = ['vehicle_handing_over_id', 'company_name', 'company_address', 'company_contact_details', 'reason_for_handling_over', 'name_of_department', 'name_of_component', 'transport_officer_name_and_surname', 'transport_officer_email', 'job_pre_authorization_number', 'vehicle_registration_number', 'closing_km', 'make_of_vehicle', 'model_of_vehicle', 'authorization_number', 'authorization_date', 'radio_dvd_combination', 'number_of_keys_handling_over', 'jack_with_handle', 'tyre_spare', 'tyre_spare_condition', 'wheel_spanner', 'wheel_cups', 'tri_angles', 'mats', 'other', 'number_of_keys', 'tyre_r_f', 'tyre_r_f_1', 'tyre_r_f_1_1', 'tyre_r_r', 'tyre_r_r_1', 'tyre_r_r_1_1', 'tyre_l_f', 'tyre_l_f_1', 'tyre_l_f_1_1', 'tyer_l_r', 'tyer_l_r_1', 'tyre_l_r_1_1', 'driver_name_and_surname', 'driver_persal_number', 'driver_signature', 'date_checked_in', 'testing_officer_name_and_surname', 'testing_officer_signature', 'fuel_gauge_amount', 'vehicle_marks_1', 'vehicle_marks_2', 'vehicle_marks_3', 'vehicle_marks_4', 'vehicle_marks_5', 'vehicle_marks_6', 'vehicle_marks_7', 'vehicle_marks_8', 'remarks', 'vehicle_handing_over_ckecklist', ];
	$x->ColNumber  = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, ];

	// template paths below are based on the app main directory
	$x->Template = 'templates/vehicle_handing_over_checklist_templateTV.html';
	$x->SelectedTemplate = 'templates/vehicle_handing_over_checklist_templateTVS.html';
	$x->TemplateDV = 'templates/vehicle_handing_over_checklist_templateDV.html';
	$x->TemplateDVP = 'templates/vehicle_handing_over_checklist_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HasCalculatedFields = false;
	$x->AllowConsoleLog = false;
	$x->AllowDVNavigation = true;

	// hook: vehicle_handing_over_checklist_init
	$render = true;
	if(function_exists('vehicle_handing_over_checklist_init')) {
		$args = [];
		$render = vehicle_handing_over_checklist_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: vehicle_handing_over_checklist_header
	$headerCode = '';
	if(function_exists('vehicle_handing_over_checklist_header')) {
		$args = [];
		$headerCode = vehicle_handing_over_checklist_header($x->ContentType, getMemberInfo(), $args);
	}

	if(!$headerCode) {
		include_once(__DIR__ . '/header.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/header.php');
		echo str_replace('<%%HEADER%%>', ob_get_clean(), $headerCode);
	}

	echo $x->HTML;

	// hook: vehicle_handing_over_checklist_footer
	$footerCode = '';
	if(function_exists('vehicle_handing_over_checklist_footer')) {
		$args = [];
		$footerCode = vehicle_handing_over_checklist_footer($x->ContentType, getMemberInfo(), $args);
	}

	if(!$footerCode) {
		include_once(__DIR__ . '/footer.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/footer.php');
		echo str_replace('<%%FOOTER%%>', ob_get_clean(), $footerCode);
	}
