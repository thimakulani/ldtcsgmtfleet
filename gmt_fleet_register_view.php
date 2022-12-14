<?php
// This script and data application were generated by AppGini 22.13
// Download AppGini for free from https://bigprof.com/appgini/download/

	include_once(__DIR__ . '/lib.php');
	@include_once(__DIR__ . '/hooks/gmt_fleet_register.php');
	include_once(__DIR__ . '/gmt_fleet_register_dml.php');

	// mm: can the current member access this page?
	$perm = getTablePermissions('gmt_fleet_register');
	if(!$perm['access']) {
		echo error_message($Translation['tableAccessDenied']);
		exit;
	}

	$x = new DataList;
	$x->TableName = 'gmt_fleet_register';

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = [
		"`gmt_fleet_register`.`fleet_asset_id`" => "fleet_asset_id",
		"`gmt_fleet_register`.`vehicle_registration_number`" => "vehicle_registration_number",
		"`gmt_fleet_register`.`register_number`" => "register_number",
		"`gmt_fleet_register`.`engine_number`" => "engine_number",
		"`gmt_fleet_register`.`chassis_number`" => "chassis_number",
		"IF(    CHAR_LENGTH(`dealer1`.`dealer_name`), CONCAT_WS('',   `dealer1`.`dealer_name`), '') /* Make of Vehicle/Dealer Name: */" => "dealer_name",
		"IF(    CHAR_LENGTH(`dealer2`.`make_of_vehicle`), CONCAT_WS('',   `dealer2`.`make_of_vehicle`, '   '), '') /* Make of Vehicle: */" => "make_of_vehicle",
		"`gmt_fleet_register`.`model_of_vehicle`" => "model_of_vehicle",
		"IF(    CHAR_LENGTH(`year_model1`.`year_model_specification`), CONCAT_WS('',   `year_model1`.`year_model_specification`), '') /* Year Model Specification: */" => "year_model_specification",
		"`gmt_fleet_register`.`engine_capacity`" => "engine_capacity",
		"`gmt_fleet_register`.`tyre_size`" => "tyre_size",
		"IF(    CHAR_LENGTH(`transmission1`.`transmission`), CONCAT_WS('',   `transmission1`.`transmission`), '') /* Transmission: */" => "transmission",
		"IF(    CHAR_LENGTH(`fuel_type1`.`fuel_type`), CONCAT_WS('',   `fuel_type1`.`fuel_type`), '') /* Fuel Type: */" => "fuel_type",
		"IF(    CHAR_LENGTH(`body_type1`.`type_of_vehicle`), CONCAT_WS('',   `body_type1`.`type_of_vehicle`), '') /* Type of Vehicle: */" => "type_of_vehicle",
		"IF(    CHAR_LENGTH(`vehicle_colour1`.`colour_of_vehicle`), CONCAT_WS('',   `vehicle_colour1`.`colour_of_vehicle`), '') /* Colour of Vehicle: */" => "colour_of_vehicle",
		"IF(    CHAR_LENGTH(`application_status1`.`application_status`), CONCAT_WS('',   `application_status1`.`application_status`), '') /* Application Status: */" => "application_status",
		"`gmt_fleet_register`.`case_number`" => "case_number",
		"`gmt_fleet_register`.`barcode_number`" => "barcode_number",
		"`gmt_fleet_register`.`purchase_price`" => "purchase_price",
		"`gmt_fleet_register`.`depreciation_value`" => "depreciation_value",
		"`gmt_fleet_register`.`photo_of_vehicle`" => "photo_of_vehicle",
		"`gmt_fleet_register`.`user_name_and_surname`" => "user_name_and_surname",
		"`gmt_fleet_register`.`user_contact_email`" => "user_contact_email",
		"`gmt_fleet_register`.`contact_number`" => "contact_number",
		"IF(    CHAR_LENGTH(`departments1`.`department_name`), CONCAT_WS('',   `departments1`.`department_name`), '') /* Department Name: */" => "department_name",
		"`gmt_fleet_register`.`department_address`" => "department_address",
		"IF(    CHAR_LENGTH(`province1`.`province`), CONCAT_WS('',   `province1`.`province`), '') /* Province: */" => "province",
		"IF(    CHAR_LENGTH(`districts1`.`district`) || CHAR_LENGTH(`districts1`.`station`), CONCAT_WS('',   `districts1`.`district`, '     |     and     |     ', `districts1`.`station`), '') /* District and Station: */" => "district",
		"IF(    CHAR_LENGTH(`driver1`.`drivers_name_and_surname`) || CHAR_LENGTH(`driver1`.`drivers_persal_number`), CONCAT_WS('',   `driver1`.`drivers_name_and_surname`, '      |    and    |         ', `driver1`.`drivers_persal_number`), '') /* Driver\'s Name & Surname: */" => "drivers_name_and_surname",
		"IF(    CHAR_LENGTH(`driver1`.`drivers_persal_number`), CONCAT_WS('',   `driver1`.`drivers_persal_number`), '') /* Driver\'s Persal Number: */" => "drivers_persal_number",
		"IF(    CHAR_LENGTH(`departments2`.`department_name`), CONCAT_WS('',   `departments2`.`department_name`), '') /* Department Name of Driver: */" => "department_name_of_driver",
		"IF(    CHAR_LENGTH(`driver1`.`drivers_contact_details`), CONCAT_WS('',   `driver1`.`drivers_contact_details`), '') /* Driver\'s Contact Details: */" => "drivers_contact_details",
		"`gmt_fleet_register`.`documents`" => "documents",
		"if(`gmt_fleet_register`.`date_auctioned`,date_format(`gmt_fleet_register`.`date_auctioned`,'%d/%m/%Y'),'')" => "date_auctioned",
		"`gmt_fleet_register`.`venue`" => "venue",
		"`gmt_fleet_register`.`comments`" => "comments",
		"DATE_FORMAT(`gmt_fleet_register`.`renewal_of_license`, '%b %D, %Y %l:%i%p')" => "renewal_of_license",
		"`gmt_fleet_register`.`mm_code`" => "mm_code",
	];
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = [
		1 => '`gmt_fleet_register`.`fleet_asset_id`',
		2 => 2,
		3 => 3,
		4 => 4,
		5 => 5,
		6 => '`dealer1`.`dealer_name`',
		7 => 7,
		8 => 8,
		9 => '`year_model1`.`year_model_specification`',
		10 => 10,
		11 => 11,
		12 => '`transmission1`.`transmission`',
		13 => '`fuel_type1`.`fuel_type`',
		14 => '`body_type1`.`type_of_vehicle`',
		15 => '`vehicle_colour1`.`colour_of_vehicle`',
		16 => '`application_status1`.`application_status`',
		17 => 17,
		18 => 18,
		19 => '`gmt_fleet_register`.`purchase_price`',
		20 => 20,
		21 => 21,
		22 => 22,
		23 => 23,
		24 => 24,
		25 => '`departments1`.`department_name`',
		26 => 26,
		27 => '`province1`.`province`',
		28 => 28,
		29 => 29,
		30 => '`driver1`.`drivers_persal_number`',
		31 => '`departments2`.`department_name`',
		32 => '`driver1`.`drivers_contact_details`',
		33 => 33,
		34 => '`gmt_fleet_register`.`date_auctioned`',
		35 => 35,
		36 => 36,
		37 => '`gmt_fleet_register`.`renewal_of_license`',
		38 => 38,
	];

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = [
		"`gmt_fleet_register`.`fleet_asset_id`" => "fleet_asset_id",
		"`gmt_fleet_register`.`vehicle_registration_number`" => "vehicle_registration_number",
		"`gmt_fleet_register`.`register_number`" => "register_number",
		"`gmt_fleet_register`.`engine_number`" => "engine_number",
		"`gmt_fleet_register`.`chassis_number`" => "chassis_number",
		"IF(    CHAR_LENGTH(`dealer1`.`dealer_name`), CONCAT_WS('',   `dealer1`.`dealer_name`), '') /* Make of Vehicle/Dealer Name: */" => "dealer_name",
		"IF(    CHAR_LENGTH(`dealer2`.`make_of_vehicle`), CONCAT_WS('',   `dealer2`.`make_of_vehicle`, '   '), '') /* Make of Vehicle: */" => "make_of_vehicle",
		"`gmt_fleet_register`.`model_of_vehicle`" => "model_of_vehicle",
		"IF(    CHAR_LENGTH(`year_model1`.`year_model_specification`), CONCAT_WS('',   `year_model1`.`year_model_specification`), '') /* Year Model Specification: */" => "year_model_specification",
		"`gmt_fleet_register`.`engine_capacity`" => "engine_capacity",
		"`gmt_fleet_register`.`tyre_size`" => "tyre_size",
		"IF(    CHAR_LENGTH(`transmission1`.`transmission`), CONCAT_WS('',   `transmission1`.`transmission`), '') /* Transmission: */" => "transmission",
		"IF(    CHAR_LENGTH(`fuel_type1`.`fuel_type`), CONCAT_WS('',   `fuel_type1`.`fuel_type`), '') /* Fuel Type: */" => "fuel_type",
		"IF(    CHAR_LENGTH(`body_type1`.`type_of_vehicle`), CONCAT_WS('',   `body_type1`.`type_of_vehicle`), '') /* Type of Vehicle: */" => "type_of_vehicle",
		"IF(    CHAR_LENGTH(`vehicle_colour1`.`colour_of_vehicle`), CONCAT_WS('',   `vehicle_colour1`.`colour_of_vehicle`), '') /* Colour of Vehicle: */" => "colour_of_vehicle",
		"IF(    CHAR_LENGTH(`application_status1`.`application_status`), CONCAT_WS('',   `application_status1`.`application_status`), '') /* Application Status: */" => "application_status",
		"`gmt_fleet_register`.`case_number`" => "case_number",
		"`gmt_fleet_register`.`barcode_number`" => "barcode_number",
		"`gmt_fleet_register`.`purchase_price`" => "purchase_price",
		"`gmt_fleet_register`.`depreciation_value`" => "depreciation_value",
		"`gmt_fleet_register`.`photo_of_vehicle`" => "photo_of_vehicle",
		"`gmt_fleet_register`.`user_name_and_surname`" => "user_name_and_surname",
		"`gmt_fleet_register`.`user_contact_email`" => "user_contact_email",
		"`gmt_fleet_register`.`contact_number`" => "contact_number",
		"IF(    CHAR_LENGTH(`departments1`.`department_name`), CONCAT_WS('',   `departments1`.`department_name`), '') /* Department Name: */" => "department_name",
		"`gmt_fleet_register`.`department_address`" => "department_address",
		"IF(    CHAR_LENGTH(`province1`.`province`), CONCAT_WS('',   `province1`.`province`), '') /* Province: */" => "province",
		"IF(    CHAR_LENGTH(`districts1`.`district`) || CHAR_LENGTH(`districts1`.`station`), CONCAT_WS('',   `districts1`.`district`, '     |     and     |     ', `districts1`.`station`), '') /* District and Station: */" => "district",
		"IF(    CHAR_LENGTH(`driver1`.`drivers_name_and_surname`) || CHAR_LENGTH(`driver1`.`drivers_persal_number`), CONCAT_WS('',   `driver1`.`drivers_name_and_surname`, '      |    and    |         ', `driver1`.`drivers_persal_number`), '') /* Driver\'s Name & Surname: */" => "drivers_name_and_surname",
		"IF(    CHAR_LENGTH(`driver1`.`drivers_persal_number`), CONCAT_WS('',   `driver1`.`drivers_persal_number`), '') /* Driver\'s Persal Number: */" => "drivers_persal_number",
		"IF(    CHAR_LENGTH(`departments2`.`department_name`), CONCAT_WS('',   `departments2`.`department_name`), '') /* Department Name of Driver: */" => "department_name_of_driver",
		"IF(    CHAR_LENGTH(`driver1`.`drivers_contact_details`), CONCAT_WS('',   `driver1`.`drivers_contact_details`), '') /* Driver\'s Contact Details: */" => "drivers_contact_details",
		"`gmt_fleet_register`.`documents`" => "documents",
		"if(`gmt_fleet_register`.`date_auctioned`,date_format(`gmt_fleet_register`.`date_auctioned`,'%d/%m/%Y'),'')" => "date_auctioned",
		"`gmt_fleet_register`.`venue`" => "venue",
		"`gmt_fleet_register`.`comments`" => "comments",
		"DATE_FORMAT(`gmt_fleet_register`.`renewal_of_license`, '%b %D, %Y %l:%i%p')" => "renewal_of_license",
		"`gmt_fleet_register`.`mm_code`" => "mm_code",
	];
	// Fields that can be filtered
	$x->QueryFieldsFilters = [
		"`gmt_fleet_register`.`fleet_asset_id`" => "Asset ID:",
		"`gmt_fleet_register`.`vehicle_registration_number`" => "Registration Number:",
		"`gmt_fleet_register`.`register_number`" => "Register Number:",
		"`gmt_fleet_register`.`engine_number`" => "Engine Number:",
		"`gmt_fleet_register`.`chassis_number`" => "Chassis/Vin Number:",
		"IF(    CHAR_LENGTH(`dealer1`.`dealer_name`), CONCAT_WS('',   `dealer1`.`dealer_name`), '') /* Make of Vehicle/Dealer Name: */" => "Make of Vehicle/Dealer Name:",
		"IF(    CHAR_LENGTH(`dealer2`.`make_of_vehicle`), CONCAT_WS('',   `dealer2`.`make_of_vehicle`, '   '), '') /* Make of Vehicle: */" => "Make of Vehicle:",
		"`gmt_fleet_register`.`model_of_vehicle`" => "Model of Vehicle:",
		"IF(    CHAR_LENGTH(`year_model1`.`year_model_specification`), CONCAT_WS('',   `year_model1`.`year_model_specification`), '') /* Year Model Specification: */" => "Year Model Specification:",
		"`gmt_fleet_register`.`engine_capacity`" => "Engine Capacity (cc):",
		"`gmt_fleet_register`.`tyre_size`" => "Tyre Size (Radial):",
		"IF(    CHAR_LENGTH(`transmission1`.`transmission`), CONCAT_WS('',   `transmission1`.`transmission`), '') /* Transmission: */" => "Transmission:",
		"IF(    CHAR_LENGTH(`fuel_type1`.`fuel_type`), CONCAT_WS('',   `fuel_type1`.`fuel_type`), '') /* Fuel Type: */" => "Fuel Type:",
		"IF(    CHAR_LENGTH(`body_type1`.`type_of_vehicle`), CONCAT_WS('',   `body_type1`.`type_of_vehicle`), '') /* Type of Vehicle: */" => "Type of Vehicle:",
		"IF(    CHAR_LENGTH(`vehicle_colour1`.`colour_of_vehicle`), CONCAT_WS('',   `vehicle_colour1`.`colour_of_vehicle`), '') /* Colour of Vehicle: */" => "Colour of Vehicle:",
		"IF(    CHAR_LENGTH(`application_status1`.`application_status`), CONCAT_WS('',   `application_status1`.`application_status`), '') /* Application Status: */" => "Application Status:",
		"`gmt_fleet_register`.`case_number`" => "Case Number (If Vehicle Stolen):",
		"`gmt_fleet_register`.`barcode_number`" => "Barcode Number:",
		"`gmt_fleet_register`.`purchase_price`" => "Purchase Price:",
		"`gmt_fleet_register`.`depreciation_value`" => "Depreciation Value:",
		"`gmt_fleet_register`.`user_name_and_surname`" => "Owner of Vehicle Name & Surname:",
		"`gmt_fleet_register`.`user_contact_email`" => "User Contact Email:",
		"`gmt_fleet_register`.`contact_number`" => "Contact Number:",
		"IF(    CHAR_LENGTH(`departments1`.`department_name`), CONCAT_WS('',   `departments1`.`department_name`), '') /* Department Name: */" => "Department Name:",
		"`gmt_fleet_register`.`department_address`" => "Department Address:",
		"IF(    CHAR_LENGTH(`province1`.`province`), CONCAT_WS('',   `province1`.`province`), '') /* Province: */" => "Province:",
		"IF(    CHAR_LENGTH(`districts1`.`district`) || CHAR_LENGTH(`districts1`.`station`), CONCAT_WS('',   `districts1`.`district`, '     |     and     |     ', `districts1`.`station`), '') /* District and Station: */" => "District and Station:",
		"IF(    CHAR_LENGTH(`driver1`.`drivers_name_and_surname`) || CHAR_LENGTH(`driver1`.`drivers_persal_number`), CONCAT_WS('',   `driver1`.`drivers_name_and_surname`, '      |    and    |         ', `driver1`.`drivers_persal_number`), '') /* Driver\'s Name & Surname: */" => "Driver\'s Name & Surname:",
		"IF(    CHAR_LENGTH(`driver1`.`drivers_persal_number`), CONCAT_WS('',   `driver1`.`drivers_persal_number`), '') /* Driver\'s Persal Number: */" => "Driver\'s Persal Number:",
		"IF(    CHAR_LENGTH(`departments2`.`department_name`), CONCAT_WS('',   `departments2`.`department_name`), '') /* Department Name of Driver: */" => "Department Name of Driver:",
		"IF(    CHAR_LENGTH(`driver1`.`drivers_contact_details`), CONCAT_WS('',   `driver1`.`drivers_contact_details`), '') /* Driver\'s Contact Details: */" => "Driver\'s Contact Details:",
		"`gmt_fleet_register`.`documents`" => "Documents:",
		"`gmt_fleet_register`.`date_auctioned`" => "Date Auctioned:",
		"`gmt_fleet_register`.`venue`" => "Venue:",
		"`gmt_fleet_register`.`comments`" => "Comments:",
		"`gmt_fleet_register`.`renewal_of_license`" => "License Expiry Date:",
		"`gmt_fleet_register`.`mm_code`" => "MM Code:",
	];

	// Fields that can be quick searched
	$x->QueryFieldsQS = [
		"`gmt_fleet_register`.`fleet_asset_id`" => "fleet_asset_id",
		"`gmt_fleet_register`.`vehicle_registration_number`" => "vehicle_registration_number",
		"`gmt_fleet_register`.`register_number`" => "register_number",
		"`gmt_fleet_register`.`engine_number`" => "engine_number",
		"`gmt_fleet_register`.`chassis_number`" => "chassis_number",
		"IF(    CHAR_LENGTH(`dealer1`.`dealer_name`), CONCAT_WS('',   `dealer1`.`dealer_name`), '') /* Make of Vehicle/Dealer Name: */" => "dealer_name",
		"IF(    CHAR_LENGTH(`dealer2`.`make_of_vehicle`), CONCAT_WS('',   `dealer2`.`make_of_vehicle`, '   '), '') /* Make of Vehicle: */" => "make_of_vehicle",
		"`gmt_fleet_register`.`model_of_vehicle`" => "model_of_vehicle",
		"IF(    CHAR_LENGTH(`year_model1`.`year_model_specification`), CONCAT_WS('',   `year_model1`.`year_model_specification`), '') /* Year Model Specification: */" => "year_model_specification",
		"`gmt_fleet_register`.`engine_capacity`" => "engine_capacity",
		"`gmt_fleet_register`.`tyre_size`" => "tyre_size",
		"IF(    CHAR_LENGTH(`transmission1`.`transmission`), CONCAT_WS('',   `transmission1`.`transmission`), '') /* Transmission: */" => "transmission",
		"IF(    CHAR_LENGTH(`fuel_type1`.`fuel_type`), CONCAT_WS('',   `fuel_type1`.`fuel_type`), '') /* Fuel Type: */" => "fuel_type",
		"IF(    CHAR_LENGTH(`body_type1`.`type_of_vehicle`), CONCAT_WS('',   `body_type1`.`type_of_vehicle`), '') /* Type of Vehicle: */" => "type_of_vehicle",
		"IF(    CHAR_LENGTH(`vehicle_colour1`.`colour_of_vehicle`), CONCAT_WS('',   `vehicle_colour1`.`colour_of_vehicle`), '') /* Colour of Vehicle: */" => "colour_of_vehicle",
		"IF(    CHAR_LENGTH(`application_status1`.`application_status`), CONCAT_WS('',   `application_status1`.`application_status`), '') /* Application Status: */" => "application_status",
		"`gmt_fleet_register`.`case_number`" => "case_number",
		"`gmt_fleet_register`.`barcode_number`" => "barcode_number",
		"`gmt_fleet_register`.`purchase_price`" => "purchase_price",
		"`gmt_fleet_register`.`depreciation_value`" => "depreciation_value",
		"`gmt_fleet_register`.`user_name_and_surname`" => "user_name_and_surname",
		"`gmt_fleet_register`.`user_contact_email`" => "user_contact_email",
		"`gmt_fleet_register`.`contact_number`" => "contact_number",
		"IF(    CHAR_LENGTH(`departments1`.`department_name`), CONCAT_WS('',   `departments1`.`department_name`), '') /* Department Name: */" => "department_name",
		"`gmt_fleet_register`.`department_address`" => "department_address",
		"IF(    CHAR_LENGTH(`province1`.`province`), CONCAT_WS('',   `province1`.`province`), '') /* Province: */" => "province",
		"IF(    CHAR_LENGTH(`districts1`.`district`) || CHAR_LENGTH(`districts1`.`station`), CONCAT_WS('',   `districts1`.`district`, '     |     and     |     ', `districts1`.`station`), '') /* District and Station: */" => "district",
		"IF(    CHAR_LENGTH(`driver1`.`drivers_name_and_surname`) || CHAR_LENGTH(`driver1`.`drivers_persal_number`), CONCAT_WS('',   `driver1`.`drivers_name_and_surname`, '      |    and    |         ', `driver1`.`drivers_persal_number`), '') /* Driver\'s Name & Surname: */" => "drivers_name_and_surname",
		"IF(    CHAR_LENGTH(`driver1`.`drivers_persal_number`), CONCAT_WS('',   `driver1`.`drivers_persal_number`), '') /* Driver\'s Persal Number: */" => "drivers_persal_number",
		"IF(    CHAR_LENGTH(`departments2`.`department_name`), CONCAT_WS('',   `departments2`.`department_name`), '') /* Department Name of Driver: */" => "department_name_of_driver",
		"IF(    CHAR_LENGTH(`driver1`.`drivers_contact_details`), CONCAT_WS('',   `driver1`.`drivers_contact_details`), '') /* Driver\'s Contact Details: */" => "drivers_contact_details",
		"`gmt_fleet_register`.`documents`" => "documents",
		"if(`gmt_fleet_register`.`date_auctioned`,date_format(`gmt_fleet_register`.`date_auctioned`,'%d/%m/%Y'),'')" => "date_auctioned",
		"`gmt_fleet_register`.`venue`" => "venue",
		"`gmt_fleet_register`.`comments`" => "comments",
		"DATE_FORMAT(`gmt_fleet_register`.`renewal_of_license`, '%b %D, %Y %l:%i%p')" => "renewal_of_license",
		"`gmt_fleet_register`.`mm_code`" => "mm_code",
	];

	// Lookup fields that can be used as filterers
	$x->filterers = ['dealer_name' => 'Make of Vehicle/Dealer Name:', 'make_of_vehicle' => 'Make of Vehicle:', 'year_model_specification' => 'Year Model Specification:', 'transmission' => 'Transmission:', 'fuel_type' => 'Fuel Type:', 'type_of_vehicle' => 'Type of Vehicle:', 'colour_of_vehicle' => 'Colour of Vehicle:', 'application_status' => 'Application Status:', 'department_name' => 'Department Name:', 'province' => 'Province:', 'district' => 'District and Station:', 'drivers_name_and_surname' => 'Driver\'s Name & Surname:', 'department_name_of_driver' => 'Department Name of Driver:', ];

	$x->QueryFrom = "`gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ";
	$x->QueryWhere = '';
	$x->QueryOrder = '';

	$x->AllowSelection = 1;
	$x->HideTableView = ($perm['view'] == 0 ? 1 : 0);
	$x->AllowDelete = $perm['delete'];
	$x->AllowMassDelete = true;
	$x->AllowInsert = $perm['insert'];
	$x->AllowUpdate = $perm['edit'];
	$x->SeparateDV = 1;
	$x->AllowDeleteOfParents = 0;
	$x->AllowFilters = 1;
	$x->AllowSavingFilters = 1;
	$x->AllowSorting = 1;
	$x->AllowNavigation = 1;
	$x->AllowPrinting = 1;
	$x->AllowPrintingDV = 1;
	$x->AllowCSV = 1;
	$x->RecordsPerPage = 25;
	$x->QuickSearch = 1;
	$x->QuickSearchText = $Translation['quick search'];
	$x->ScriptFileName = 'gmt_fleet_register_view.php';
	$x->RedirectAfterInsert = 'gmt_fleet_register_view.php';
	$x->TableTitle = 'GMT Fleet Register:';
	$x->TableIcon = 'resources/table_icons/Jeep_Red.png';
	$x->PrimaryKey = '`gmt_fleet_register`.`fleet_asset_id`';

	$x->ColWidth = [150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, ];
	$x->ColCaption = ['Asset ID:', 'Registration Number:', 'Register Number:', 'Engine Number:', 'Chassis/Vin Number:', 'Make of Vehicle/Dealer Name:', 'Make of Vehicle:', 'Model of Vehicle:', 'Year Model Specification:', 'Engine Capacity (cc):', 'Tyre Size (Radial):', 'Transmission:', 'Fuel Type:', 'Type of Vehicle:', 'Colour of Vehicle:', 'Application Status:', 'Case Number (If Vehicle Stolen):', 'Barcode Number:', 'Purchase Price:', 'Depreciation Value:', 'Photo of Vehicle:', 'Owner of Vehicle Name & Surname:', 'User Contact Email:', 'Contact Number:', 'Department Name:', 'Department Address:', 'Province:', 'District and Station:', 'Driver\'s Name & Surname:', 'Driver\'s Persal Number:', 'Department Name of Driver:', 'Driver\'s Contact Details:', 'Documents:', 'Date Auctioned:', 'Venue:', 'Comments:', 'License Expiry Date:', 'MM Code:', ];
	$x->ColFieldName = ['fleet_asset_id', 'vehicle_registration_number', 'register_number', 'engine_number', 'chassis_number', 'dealer_name', 'make_of_vehicle', 'model_of_vehicle', 'year_model_specification', 'engine_capacity', 'tyre_size', 'transmission', 'fuel_type', 'type_of_vehicle', 'colour_of_vehicle', 'application_status', 'case_number', 'barcode_number', 'purchase_price', 'depreciation_value', 'photo_of_vehicle', 'user_name_and_surname', 'user_contact_email', 'contact_number', 'department_name', 'department_address', 'province', 'district', 'drivers_name_and_surname', 'drivers_persal_number', 'department_name_of_driver', 'drivers_contact_details', 'documents', 'date_auctioned', 'venue', 'comments', 'renewal_of_license', 'mm_code', ];
	$x->ColNumber  = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, ];

	// template paths below are based on the app main directory
	$x->Template = 'templates/gmt_fleet_register_templateTV.html';
	$x->SelectedTemplate = 'templates/gmt_fleet_register_templateTVS.html';
	$x->TemplateDV = 'templates/gmt_fleet_register_templateDV.html';
	$x->TemplateDVP = 'templates/gmt_fleet_register_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HasCalculatedFields = false;
	$x->AllowConsoleLog = false;
	$x->AllowDVNavigation = true;

	// hook: gmt_fleet_register_init
	$render = true;
	if(function_exists('gmt_fleet_register_init')) {
		$args = [];
		$render = gmt_fleet_register_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: gmt_fleet_register_header
	$headerCode = '';
	if(function_exists('gmt_fleet_register_header')) {
		$args = [];
		$headerCode = gmt_fleet_register_header($x->ContentType, getMemberInfo(), $args);
	}

	if(!$headerCode) {
		include_once(__DIR__ . '/header.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/header.php');
		echo str_replace('<%%HEADER%%>', ob_get_clean(), $headerCode);
	}

	echo $x->HTML;

	// hook: gmt_fleet_register_footer
	$footerCode = '';
	if(function_exists('gmt_fleet_register_footer')) {
		$args = [];
		$footerCode = gmt_fleet_register_footer($x->ContentType, getMemberInfo(), $args);
	}

	if(!$footerCode) {
		include_once(__DIR__ . '/footer.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/footer.php');
		echo str_replace('<%%FOOTER%%>', ob_get_clean(), $footerCode);
	}
