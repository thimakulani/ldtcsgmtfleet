<?php
// This script and data application were generated by AppGini 22.13
// Download AppGini for free from https://bigprof.com/appgini/download/

	include_once(__DIR__ . '/lib.php');
	@include_once(__DIR__ . '/hooks/vehicle_return_check_list.php');
	include_once(__DIR__ . '/vehicle_return_check_list_dml.php');

	// mm: can the current member access this page?
	$perm = getTablePermissions('vehicle_return_check_list');
	if(!$perm['access']) {
		echo error_message($Translation['tableAccessDenied']);
		exit;
	}

	$x = new DataList;
	$x->TableName = 'vehicle_return_check_list';

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = [
		"`vehicle_return_check_list`.`vehicle_return_check_list_id`" => "vehicle_return_check_list_id",
		"DATE_FORMAT(`vehicle_return_check_list`.`vehicle_return_date`, '%D %b %Y %l:%i%p')" => "vehicle_return_date",
		"`vehicle_return_check_list`.`job_card_number`" => "job_card_number",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`) || CHAR_LENGTH(`gmt_fleet_register1`.`chassis_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`, '    |   and    |  ', `gmt_fleet_register1`.`chassis_number`), '') /* Vehicle Registration Number: */" => "vehicle_registration_number",
		"IF(    CHAR_LENGTH(`dealer1`.`make_of_vehicle`) || CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`), CONCAT_WS('',   `dealer1`.`make_of_vehicle`, '   ', '   |  and  |   ', `gmt_fleet_register1`.`model_of_vehicle`), '') /* Make of Vehicle: */" => "make_of_vehicle",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`) || CHAR_LENGTH(`gmt_fleet_register1`.`chassis_number`), CONCAT_WS('',   `gmt_fleet_register1`.`model_of_vehicle`, '   |  and  |   ', `gmt_fleet_register1`.`chassis_number`), '') /* Model of Vehicle: */" => "model_of_vehicle",
		"IF(    CHAR_LENGTH(`log_sheet1`.`closing_km`) || CHAR_LENGTH(`log_sheet1`.`fuel_log_sheet_id`), CONCAT_WS('',   `log_sheet1`.`closing_km`, '  |    and     |     ', `log_sheet1`.`fuel_log_sheet_id`), '') /* Odometer Reading/Closing KM: */" => "closing_km",
		"`vehicle_return_check_list`.`radio_dvd_combination`" => "radio_dvd_combination",
		"`vehicle_return_check_list`.`number_of_keys_handling_over`" => "number_of_keys_handling_over",
		"`vehicle_return_check_list`.`jack_with_handle`" => "jack_with_handle",
		"`vehicle_return_check_list`.`tyre_spare`" => "tyre_spare",
		"`vehicle_return_check_list`.`tyre_spare_condition`" => "tyre_spare_condition",
		"`vehicle_return_check_list`.`wheel_spanner`" => "wheel_spanner",
		"`vehicle_return_check_list`.`wheel_cups`" => "wheel_cups",
		"`vehicle_return_check_list`.`tri_angles`" => "tri_angles",
		"`vehicle_return_check_list`.`other`" => "other",
		"`vehicle_return_check_list`.`number_of_keys`" => "number_of_keys",
		"`vehicle_return_check_list`.`vehicle_washed`" => "vehicle_washed",
		"`vehicle_return_check_list`.`tyre_r_f`" => "tyre_r_f",
		"`vehicle_return_check_list`.`tyre_r_f_1`" => "tyre_r_f_1",
		"`vehicle_return_check_list`.`tyre_r_f_1_1`" => "tyre_r_f_1_1",
		"`vehicle_return_check_list`.`tyre_r_r`" => "tyre_r_r",
		"`vehicle_return_check_list`.`tyre_r_r_1`" => "tyre_r_r_1",
		"`vehicle_return_check_list`.`tyre_r_r_1_1`" => "tyre_r_r_1_1",
		"`vehicle_return_check_list`.`tyre_l_f`" => "tyre_l_f",
		"`vehicle_return_check_list`.`tyre_l_f_1`" => "tyre_l_f_1",
		"`vehicle_return_check_list`.`tyre_l_f_1_1`" => "tyre_l_f_1_1",
		"`vehicle_return_check_list`.`tyer_l_r`" => "tyer_l_r",
		"`vehicle_return_check_list`.`tyer_l_r_1`" => "tyer_l_r_1",
		"`vehicle_return_check_list`.`tyre_l_r_1_1`" => "tyre_l_r_1_1",
		"`vehicle_return_check_list`.`fuel_gauge_amount`" => "fuel_gauge_amount",
		"IF(    CHAR_LENGTH(`driver1`.`drivers_name_and_surname`) || CHAR_LENGTH(`driver1`.`drivers_persal_number`), CONCAT_WS('',   `driver1`.`drivers_name_and_surname`, '    |   and    |   ', `driver1`.`drivers_persal_number`), '') /* Driver Name & Surname: */" => "driver_name_and_surname",
		"IF(    CHAR_LENGTH(`driver1`.`drivers_persal_number`) || CHAR_LENGTH(`driver1`.`drivers_license_number`), CONCAT_WS('',   `driver1`.`drivers_persal_number`, '      |    and   |   ', `driver1`.`drivers_license_number`), '') /* Driver Persal Number: */" => "driver_persal_number",
		"`vehicle_return_check_list`.`driver_signature`" => "driver_signature",
		"if(`vehicle_return_check_list`.`vehicle_return_date_signed`,date_format(`vehicle_return_check_list`.`vehicle_return_date_signed`,'%d/%m/%Y %H:%i'),'')" => "vehicle_return_date_signed",
		"`vehicle_return_check_list`.`testing_officer_name_and_surname`" => "testing_officer_name_and_surname",
		"`vehicle_return_check_list`.`testing_officer_signature`" => "testing_officer_signature",
		"`vehicle_return_check_list`.`vehicle_marks_1`" => "vehicle_marks_1",
		"`vehicle_return_check_list`.`vehicle_marks_2`" => "vehicle_marks_2",
		"`vehicle_return_check_list`.`vehicle_marks_3`" => "vehicle_marks_3",
		"`vehicle_return_check_list`.`vehicle_marks_4`" => "vehicle_marks_4",
		"`vehicle_return_check_list`.`vehicle_marks_5`" => "vehicle_marks_5",
		"`vehicle_return_check_list`.`vehicle_marks_6`" => "vehicle_marks_6",
		"`vehicle_return_check_list`.`vehicle_marks_7`" => "vehicle_marks_7",
		"`vehicle_return_check_list`.`vehicle_marks_8`" => "vehicle_marks_8",
		"`vehicle_return_check_list`.`remarks`" => "remarks",
		"`vehicle_return_check_list`.`vehicle_return_list`" => "vehicle_return_list",
	];
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = [
		1 => '`vehicle_return_check_list`.`vehicle_return_check_list_id`',
		2 => '`vehicle_return_check_list`.`vehicle_return_date`',
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
		16 => 16,
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
		35 => '`vehicle_return_check_list`.`vehicle_return_date_signed`',
		36 => 36,
		37 => 37,
		38 => 38,
		39 => 39,
		40 => 40,
		41 => 41,
		42 => 42,
		43 => 43,
		44 => 44,
		45 => 45,
		46 => 46,
		47 => 47,
	];

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = [
		"`vehicle_return_check_list`.`vehicle_return_check_list_id`" => "vehicle_return_check_list_id",
		"DATE_FORMAT(`vehicle_return_check_list`.`vehicle_return_date`, '%D %b %Y %l:%i%p')" => "vehicle_return_date",
		"`vehicle_return_check_list`.`job_card_number`" => "job_card_number",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`) || CHAR_LENGTH(`gmt_fleet_register1`.`chassis_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`, '    |   and    |  ', `gmt_fleet_register1`.`chassis_number`), '') /* Vehicle Registration Number: */" => "vehicle_registration_number",
		"IF(    CHAR_LENGTH(`dealer1`.`make_of_vehicle`) || CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`), CONCAT_WS('',   `dealer1`.`make_of_vehicle`, '   ', '   |  and  |   ', `gmt_fleet_register1`.`model_of_vehicle`), '') /* Make of Vehicle: */" => "make_of_vehicle",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`) || CHAR_LENGTH(`gmt_fleet_register1`.`chassis_number`), CONCAT_WS('',   `gmt_fleet_register1`.`model_of_vehicle`, '   |  and  |   ', `gmt_fleet_register1`.`chassis_number`), '') /* Model of Vehicle: */" => "model_of_vehicle",
		"IF(    CHAR_LENGTH(`log_sheet1`.`closing_km`) || CHAR_LENGTH(`log_sheet1`.`fuel_log_sheet_id`), CONCAT_WS('',   `log_sheet1`.`closing_km`, '  |    and     |     ', `log_sheet1`.`fuel_log_sheet_id`), '') /* Odometer Reading/Closing KM: */" => "closing_km",
		"`vehicle_return_check_list`.`radio_dvd_combination`" => "radio_dvd_combination",
		"`vehicle_return_check_list`.`number_of_keys_handling_over`" => "number_of_keys_handling_over",
		"`vehicle_return_check_list`.`jack_with_handle`" => "jack_with_handle",
		"`vehicle_return_check_list`.`tyre_spare`" => "tyre_spare",
		"`vehicle_return_check_list`.`tyre_spare_condition`" => "tyre_spare_condition",
		"`vehicle_return_check_list`.`wheel_spanner`" => "wheel_spanner",
		"`vehicle_return_check_list`.`wheel_cups`" => "wheel_cups",
		"`vehicle_return_check_list`.`tri_angles`" => "tri_angles",
		"`vehicle_return_check_list`.`other`" => "other",
		"`vehicle_return_check_list`.`number_of_keys`" => "number_of_keys",
		"`vehicle_return_check_list`.`vehicle_washed`" => "vehicle_washed",
		"`vehicle_return_check_list`.`tyre_r_f`" => "tyre_r_f",
		"`vehicle_return_check_list`.`tyre_r_f_1`" => "tyre_r_f_1",
		"`vehicle_return_check_list`.`tyre_r_f_1_1`" => "tyre_r_f_1_1",
		"`vehicle_return_check_list`.`tyre_r_r`" => "tyre_r_r",
		"`vehicle_return_check_list`.`tyre_r_r_1`" => "tyre_r_r_1",
		"`vehicle_return_check_list`.`tyre_r_r_1_1`" => "tyre_r_r_1_1",
		"`vehicle_return_check_list`.`tyre_l_f`" => "tyre_l_f",
		"`vehicle_return_check_list`.`tyre_l_f_1`" => "tyre_l_f_1",
		"`vehicle_return_check_list`.`tyre_l_f_1_1`" => "tyre_l_f_1_1",
		"`vehicle_return_check_list`.`tyer_l_r`" => "tyer_l_r",
		"`vehicle_return_check_list`.`tyer_l_r_1`" => "tyer_l_r_1",
		"`vehicle_return_check_list`.`tyre_l_r_1_1`" => "tyre_l_r_1_1",
		"`vehicle_return_check_list`.`fuel_gauge_amount`" => "fuel_gauge_amount",
		"IF(    CHAR_LENGTH(`driver1`.`drivers_name_and_surname`) || CHAR_LENGTH(`driver1`.`drivers_persal_number`), CONCAT_WS('',   `driver1`.`drivers_name_and_surname`, '    |   and    |   ', `driver1`.`drivers_persal_number`), '') /* Driver Name & Surname: */" => "driver_name_and_surname",
		"IF(    CHAR_LENGTH(`driver1`.`drivers_persal_number`) || CHAR_LENGTH(`driver1`.`drivers_license_number`), CONCAT_WS('',   `driver1`.`drivers_persal_number`, '      |    and   |   ', `driver1`.`drivers_license_number`), '') /* Driver Persal Number: */" => "driver_persal_number",
		"`vehicle_return_check_list`.`driver_signature`" => "driver_signature",
		"if(`vehicle_return_check_list`.`vehicle_return_date_signed`,date_format(`vehicle_return_check_list`.`vehicle_return_date_signed`,'%d/%m/%Y %H:%i'),'')" => "vehicle_return_date_signed",
		"`vehicle_return_check_list`.`testing_officer_name_and_surname`" => "testing_officer_name_and_surname",
		"`vehicle_return_check_list`.`testing_officer_signature`" => "testing_officer_signature",
		"`vehicle_return_check_list`.`vehicle_marks_1`" => "vehicle_marks_1",
		"`vehicle_return_check_list`.`vehicle_marks_2`" => "vehicle_marks_2",
		"`vehicle_return_check_list`.`vehicle_marks_3`" => "vehicle_marks_3",
		"`vehicle_return_check_list`.`vehicle_marks_4`" => "vehicle_marks_4",
		"`vehicle_return_check_list`.`vehicle_marks_5`" => "vehicle_marks_5",
		"`vehicle_return_check_list`.`vehicle_marks_6`" => "vehicle_marks_6",
		"`vehicle_return_check_list`.`vehicle_marks_7`" => "vehicle_marks_7",
		"`vehicle_return_check_list`.`vehicle_marks_8`" => "vehicle_marks_8",
		"`vehicle_return_check_list`.`remarks`" => "remarks",
		"`vehicle_return_check_list`.`vehicle_return_list`" => "vehicle_return_list",
	];
	// Fields that can be filtered
	$x->QueryFieldsFilters = [
		"`vehicle_return_check_list`.`vehicle_return_check_list_id`" => "Vehicle Return  Check List ID:",
		"`vehicle_return_check_list`.`vehicle_return_date`" => "Vehicle Return Date:",
		"`vehicle_return_check_list`.`job_card_number`" => "Job Card Number:",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`) || CHAR_LENGTH(`gmt_fleet_register1`.`chassis_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`, '    |   and    |  ', `gmt_fleet_register1`.`chassis_number`), '') /* Vehicle Registration Number: */" => "Vehicle Registration Number:",
		"IF(    CHAR_LENGTH(`dealer1`.`make_of_vehicle`) || CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`), CONCAT_WS('',   `dealer1`.`make_of_vehicle`, '   ', '   |  and  |   ', `gmt_fleet_register1`.`model_of_vehicle`), '') /* Make of Vehicle: */" => "Make of Vehicle:",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`) || CHAR_LENGTH(`gmt_fleet_register1`.`chassis_number`), CONCAT_WS('',   `gmt_fleet_register1`.`model_of_vehicle`, '   |  and  |   ', `gmt_fleet_register1`.`chassis_number`), '') /* Model of Vehicle: */" => "Model of Vehicle:",
		"IF(    CHAR_LENGTH(`log_sheet1`.`closing_km`) || CHAR_LENGTH(`log_sheet1`.`fuel_log_sheet_id`), CONCAT_WS('',   `log_sheet1`.`closing_km`, '  |    and     |     ', `log_sheet1`.`fuel_log_sheet_id`), '') /* Odometer Reading/Closing KM: */" => "Odometer Reading/Closing KM:",
		"`vehicle_return_check_list`.`radio_dvd_combination`" => "Radio/DVD Combination:",
		"`vehicle_return_check_list`.`number_of_keys_handling_over`" => "Number of Keys Handling Over:",
		"`vehicle_return_check_list`.`jack_with_handle`" => "Jack with Handle:",
		"`vehicle_return_check_list`.`tyre_spare`" => "Tyre Spare (Available):",
		"`vehicle_return_check_list`.`tyre_spare_condition`" => "Tyre Spare (Thread Condition):",
		"`vehicle_return_check_list`.`wheel_spanner`" => "Wheel Spanner:",
		"`vehicle_return_check_list`.`wheel_cups`" => "Wheel Hub Cups (Available):",
		"`vehicle_return_check_list`.`tri_angles`" => "Tri Angles Available:",
		"`vehicle_return_check_list`.`other`" => "Other (specify):",
		"`vehicle_return_check_list`.`number_of_keys`" => "Number of Keys Handed Over:",
		"`vehicle_return_check_list`.`vehicle_washed`" => "Vehicle Washed:",
		"`vehicle_return_check_list`.`tyre_r_f`" => "Tyre R/F (Available):",
		"`vehicle_return_check_list`.`tyre_r_f_1`" => "Tyre R/F (Thread Condition):",
		"`vehicle_return_check_list`.`tyre_r_f_1_1`" => "Tyre R/F Brand:",
		"`vehicle_return_check_list`.`tyre_r_r`" => "Tyre R/R (Available):",
		"`vehicle_return_check_list`.`tyre_r_r_1`" => "Tyre R/R (Available):",
		"`vehicle_return_check_list`.`tyre_r_r_1_1`" => "Tyre R/F Brand:",
		"`vehicle_return_check_list`.`tyre_l_f`" => "Tyre L/F (Available):",
		"`vehicle_return_check_list`.`tyre_l_f_1`" => "Tyre L/F (Thread Condition):",
		"`vehicle_return_check_list`.`tyre_l_f_1_1`" => "Tyre R/F Brand:",
		"`vehicle_return_check_list`.`tyer_l_r`" => "Tyre L/R (Available):",
		"`vehicle_return_check_list`.`tyer_l_r_1`" => "Tyre L/R (Thread Condition):",
		"`vehicle_return_check_list`.`tyre_l_r_1_1`" => "Tyre R/F Brand:",
		"`vehicle_return_check_list`.`fuel_gauge_amount`" => "Fuel Gauge Amount:",
		"IF(    CHAR_LENGTH(`driver1`.`drivers_name_and_surname`) || CHAR_LENGTH(`driver1`.`drivers_persal_number`), CONCAT_WS('',   `driver1`.`drivers_name_and_surname`, '    |   and    |   ', `driver1`.`drivers_persal_number`), '') /* Driver Name & Surname: */" => "Driver Name & Surname:",
		"IF(    CHAR_LENGTH(`driver1`.`drivers_persal_number`) || CHAR_LENGTH(`driver1`.`drivers_license_number`), CONCAT_WS('',   `driver1`.`drivers_persal_number`, '      |    and   |   ', `driver1`.`drivers_license_number`), '') /* Driver Persal Number: */" => "Driver Persal Number:",
		"`vehicle_return_check_list`.`vehicle_return_date_signed`" => "Declaration Date & Time:",
		"`vehicle_return_check_list`.`testing_officer_name_and_surname`" => "Testing Officer/Tradesman Aid Name & Surname:",
		"`vehicle_return_check_list`.`remarks`" => "Remarks about Vehicle:",
		"`vehicle_return_check_list`.`vehicle_return_list`" => "Vehicle  Return List:",
	];

	// Fields that can be quick searched
	$x->QueryFieldsQS = [
		"`vehicle_return_check_list`.`vehicle_return_check_list_id`" => "vehicle_return_check_list_id",
		"DATE_FORMAT(`vehicle_return_check_list`.`vehicle_return_date`, '%D %b %Y %l:%i%p')" => "vehicle_return_date",
		"`vehicle_return_check_list`.`job_card_number`" => "job_card_number",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`) || CHAR_LENGTH(`gmt_fleet_register1`.`chassis_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`, '    |   and    |  ', `gmt_fleet_register1`.`chassis_number`), '') /* Vehicle Registration Number: */" => "vehicle_registration_number",
		"IF(    CHAR_LENGTH(`dealer1`.`make_of_vehicle`) || CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`), CONCAT_WS('',   `dealer1`.`make_of_vehicle`, '   ', '   |  and  |   ', `gmt_fleet_register1`.`model_of_vehicle`), '') /* Make of Vehicle: */" => "make_of_vehicle",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`) || CHAR_LENGTH(`gmt_fleet_register1`.`chassis_number`), CONCAT_WS('',   `gmt_fleet_register1`.`model_of_vehicle`, '   |  and  |   ', `gmt_fleet_register1`.`chassis_number`), '') /* Model of Vehicle: */" => "model_of_vehicle",
		"IF(    CHAR_LENGTH(`log_sheet1`.`closing_km`) || CHAR_LENGTH(`log_sheet1`.`fuel_log_sheet_id`), CONCAT_WS('',   `log_sheet1`.`closing_km`, '  |    and     |     ', `log_sheet1`.`fuel_log_sheet_id`), '') /* Odometer Reading/Closing KM: */" => "closing_km",
		"`vehicle_return_check_list`.`radio_dvd_combination`" => "radio_dvd_combination",
		"`vehicle_return_check_list`.`number_of_keys_handling_over`" => "number_of_keys_handling_over",
		"`vehicle_return_check_list`.`jack_with_handle`" => "jack_with_handle",
		"`vehicle_return_check_list`.`tyre_spare`" => "tyre_spare",
		"`vehicle_return_check_list`.`tyre_spare_condition`" => "tyre_spare_condition",
		"`vehicle_return_check_list`.`wheel_spanner`" => "wheel_spanner",
		"`vehicle_return_check_list`.`wheel_cups`" => "wheel_cups",
		"`vehicle_return_check_list`.`tri_angles`" => "tri_angles",
		"`vehicle_return_check_list`.`other`" => "other",
		"`vehicle_return_check_list`.`number_of_keys`" => "number_of_keys",
		"`vehicle_return_check_list`.`vehicle_washed`" => "vehicle_washed",
		"`vehicle_return_check_list`.`tyre_r_f`" => "tyre_r_f",
		"`vehicle_return_check_list`.`tyre_r_f_1`" => "tyre_r_f_1",
		"`vehicle_return_check_list`.`tyre_r_f_1_1`" => "tyre_r_f_1_1",
		"`vehicle_return_check_list`.`tyre_r_r`" => "tyre_r_r",
		"`vehicle_return_check_list`.`tyre_r_r_1`" => "tyre_r_r_1",
		"`vehicle_return_check_list`.`tyre_r_r_1_1`" => "tyre_r_r_1_1",
		"`vehicle_return_check_list`.`tyre_l_f`" => "tyre_l_f",
		"`vehicle_return_check_list`.`tyre_l_f_1`" => "tyre_l_f_1",
		"`vehicle_return_check_list`.`tyre_l_f_1_1`" => "tyre_l_f_1_1",
		"`vehicle_return_check_list`.`tyer_l_r`" => "tyer_l_r",
		"`vehicle_return_check_list`.`tyer_l_r_1`" => "tyer_l_r_1",
		"`vehicle_return_check_list`.`tyre_l_r_1_1`" => "tyre_l_r_1_1",
		"`vehicle_return_check_list`.`fuel_gauge_amount`" => "fuel_gauge_amount",
		"IF(    CHAR_LENGTH(`driver1`.`drivers_name_and_surname`) || CHAR_LENGTH(`driver1`.`drivers_persal_number`), CONCAT_WS('',   `driver1`.`drivers_name_and_surname`, '    |   and    |   ', `driver1`.`drivers_persal_number`), '') /* Driver Name & Surname: */" => "driver_name_and_surname",
		"IF(    CHAR_LENGTH(`driver1`.`drivers_persal_number`) || CHAR_LENGTH(`driver1`.`drivers_license_number`), CONCAT_WS('',   `driver1`.`drivers_persal_number`, '      |    and   |   ', `driver1`.`drivers_license_number`), '') /* Driver Persal Number: */" => "driver_persal_number",
		"if(`vehicle_return_check_list`.`vehicle_return_date_signed`,date_format(`vehicle_return_check_list`.`vehicle_return_date_signed`,'%d/%m/%Y %H:%i'),'')" => "vehicle_return_date_signed",
		"`vehicle_return_check_list`.`testing_officer_name_and_surname`" => "testing_officer_name_and_surname",
		"`vehicle_return_check_list`.`remarks`" => "remarks",
		"`vehicle_return_check_list`.`vehicle_return_list`" => "vehicle_return_list",
	];

	// Lookup fields that can be used as filterers
	$x->filterers = ['vehicle_registration_number' => 'Vehicle Registration Number:', 'closing_km' => 'Odometer Reading/Closing KM:', 'driver_name_and_surname' => 'Driver Name & Surname:', ];

	$x->QueryFrom = "`vehicle_return_check_list` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`vehicle_return_check_list`.`vehicle_registration_number` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`vehicle_return_check_list`.`closing_km` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`vehicle_return_check_list`.`driver_name_and_surname` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` ";
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
	$x->ScriptFileName = 'vehicle_return_check_list_view.php';
	$x->RedirectAfterInsert = 'vehicle_return_check_list_view.php?SelectedID=#ID#';
	$x->TableTitle = 'Vehicle Return Check List:';
	$x->TableIcon = 'resources/table_icons/keys.png';
	$x->PrimaryKey = '`vehicle_return_check_list`.`vehicle_return_check_list_id`';

	$x->ColWidth = [150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, ];
	$x->ColCaption = ['Vehicle Return  Check List ID:', 'Vehicle Return Date:', 'Job Card Number:', 'Vehicle Registration Number:', 'Make of Vehicle:', 'Model of Vehicle:', 'Odometer Reading/Closing KM:', 'Radio/DVD Combination:', 'Number of Keys Handling Over:', 'Jack with Handle:', 'Tyre Spare (Available):', 'Tyre Spare (Thread Condition):', 'Wheel Spanner:', 'Wheel Hub Cups (Available):', 'Tri Angles Available:', 'Other (specify):', 'Number of Keys Handed Over:', 'Vehicle Washed:', 'Tyre R/F (Available):', 'Tyre R/F (Thread Condition):', 'Tyre R/F Brand:', 'Tyre R/R (Available):', 'Tyre R/R (Available):', 'Tyre R/F Brand:', 'Tyre L/F (Available):', 'Tyre L/F (Thread Condition):', 'Tyre R/F Brand:', 'Tyre L/R (Available):', 'Tyre L/R (Thread Condition):', 'Tyre R/F Brand:', 'Fuel Gauge Amount:', 'Driver Name & Surname:', 'Driver Persal Number:', 'Driver Signature:', 'Declaration Date & Time:', 'Testing Officer/Tradesman Aid Name & Surname:', 'Testing Officer/Tradesman Aid Signature:', 'Vehicle Marks (1):', 'Vehicle Marks(2):', 'Vehicle Marks(3):', 'Vehicle Marks(4):', 'Vehicle Marks(5):', 'Vehicle Marks(6):', 'Vehicle Marks(7):', 'Vehicle Marks (8):', 'Remarks about Vehicle:', 'Vehicle  Return List:', ];
	$x->ColFieldName = ['vehicle_return_check_list_id', 'vehicle_return_date', 'job_card_number', 'vehicle_registration_number', 'make_of_vehicle', 'model_of_vehicle', 'closing_km', 'radio_dvd_combination', 'number_of_keys_handling_over', 'jack_with_handle', 'tyre_spare', 'tyre_spare_condition', 'wheel_spanner', 'wheel_cups', 'tri_angles', 'other', 'number_of_keys', 'vehicle_washed', 'tyre_r_f', 'tyre_r_f_1', 'tyre_r_f_1_1', 'tyre_r_r', 'tyre_r_r_1', 'tyre_r_r_1_1', 'tyre_l_f', 'tyre_l_f_1', 'tyre_l_f_1_1', 'tyer_l_r', 'tyer_l_r_1', 'tyre_l_r_1_1', 'fuel_gauge_amount', 'driver_name_and_surname', 'driver_persal_number', 'driver_signature', 'vehicle_return_date_signed', 'testing_officer_name_and_surname', 'testing_officer_signature', 'vehicle_marks_1', 'vehicle_marks_2', 'vehicle_marks_3', 'vehicle_marks_4', 'vehicle_marks_5', 'vehicle_marks_6', 'vehicle_marks_7', 'vehicle_marks_8', 'remarks', 'vehicle_return_list', ];
	$x->ColNumber  = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, ];

	// template paths below are based on the app main directory
	$x->Template = 'templates/vehicle_return_check_list_templateTV.html';
	$x->SelectedTemplate = 'templates/vehicle_return_check_list_templateTVS.html';
	$x->TemplateDV = 'templates/vehicle_return_check_list_templateDV.html';
	$x->TemplateDVP = 'templates/vehicle_return_check_list_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HasCalculatedFields = false;
	$x->AllowConsoleLog = false;
	$x->AllowDVNavigation = true;

	// hook: vehicle_return_check_list_init
	$render = true;
	if(function_exists('vehicle_return_check_list_init')) {
		$args = [];
		$render = vehicle_return_check_list_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: vehicle_return_check_list_header
	$headerCode = '';
	if(function_exists('vehicle_return_check_list_header')) {
		$args = [];
		$headerCode = vehicle_return_check_list_header($x->ContentType, getMemberInfo(), $args);
	}

	if(!$headerCode) {
		include_once(__DIR__ . '/header.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/header.php');
		echo str_replace('<%%HEADER%%>', ob_get_clean(), $headerCode);
	}

	echo $x->HTML;

	// hook: vehicle_return_check_list_footer
	$footerCode = '';
	if(function_exists('vehicle_return_check_list_footer')) {
		$args = [];
		$footerCode = vehicle_return_check_list_footer($x->ContentType, getMemberInfo(), $args);
	}

	if(!$footerCode) {
		include_once(__DIR__ . '/footer.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/footer.php');
		echo str_replace('<%%FOOTER%%>', ob_get_clean(), $footerCode);
	}
