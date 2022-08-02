<?php
// This script and data application were generated by AppGini 22.13
// Download AppGini for free from https://bigprof.com/appgini/download/

	include_once(__DIR__ . '/lib.php');
	@include_once(__DIR__ . '/hooks/vehicle_daily_check_list.php');
	include_once(__DIR__ . '/vehicle_daily_check_list_dml.php');

	// mm: can the current member access this page?
	$perm = getTablePermissions('vehicle_daily_check_list');
	if(!$perm['access']) {
		echo error_message($Translation['tableAccessDenied']);
		exit;
	}

	$x = new DataList;
	$x->TableName = 'vehicle_daily_check_list';

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = [
		"`vehicle_daily_check_list`.`vehicle_daily_check_list_id`" => "vehicle_daily_check_list_id",
		"`vehicle_daily_check_list`.`inspection_certification_number`" => "inspection_certification_number",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`) || CHAR_LENGTH(`gmt_fleet_register1`.`chassis_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`, '   |  and  |   ', `gmt_fleet_register1`.`chassis_number`), '') /* Registration Number: */" => "vehicle_registration_number",
		"IF(    CHAR_LENGTH(`dealer1`.`make_of_vehicle`) || CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`), CONCAT_WS('',   `dealer1`.`make_of_vehicle`, '   ', '   |  and  |   ', `gmt_fleet_register1`.`model_of_vehicle`), '') /* Make of Vehicle: */" => "make_of_vehicle",
		"IF(    CHAR_LENGTH(`log_sheet1`.`closing_km`), CONCAT_WS('',   `log_sheet1`.`closing_km`), '') /* Odometer Reading KM: */" => "closing_km",
		"`vehicle_daily_check_list`.`dashboard`" => "dashboard",
		"`vehicle_daily_check_list`.`seats`" => "seats",
		"`vehicle_daily_check_list`.`carpets`" => "carpets",
		"`vehicle_daily_check_list`.`wipers`" => "wipers",
		"`vehicle_daily_check_list`.`head_lights`" => "head_lights",
		"`vehicle_daily_check_list`.`tail_lights`" => "tail_lights",
		"`vehicle_daily_check_list`.`brake_lights`" => "brake_lights",
		"`vehicle_daily_check_list`.`indicators`" => "indicators",
		"`vehicle_daily_check_list`.`windscreen`" => "windscreen",
		"`vehicle_daily_check_list`.`windows`" => "windows",
		"`vehicle_daily_check_list`.`mirrors`" => "mirrors",
		"`vehicle_daily_check_list`.`wheels`" => "wheels",
		"`vehicle_daily_check_list`.`hubcaps`" => "hubcaps",
		"`vehicle_daily_check_list`.`sparewheel`" => "sparewheel",
		"`vehicle_daily_check_list`.`tools`" => "tools",
		"`vehicle_daily_check_list`.`engine_oil`" => "engine_oil",
		"`vehicle_daily_check_list`.`power_steering_oil`" => "power_steering_oil",
		"`vehicle_daily_check_list`.`gearbox_oil`" => "gearbox_oil",
		"`vehicle_daily_check_list`.`coolant`" => "coolant",
		"`vehicle_daily_check_list`.`brake_oil`" => "brake_oil",
		"`vehicle_daily_check_list`.`battery`" => "battery",
		"`vehicle_daily_check_list`.`brakes_front`" => "brakes_front",
		"`vehicle_daily_check_list`.`brakes_rear`" => "brakes_rear",
		"`vehicle_daily_check_list`.`fuel_level`" => "fuel_level",
		"`vehicle_daily_check_list`.`vehicle_fluid_leaks`" => "vehicle_fluid_leaks",
		"`vehicle_daily_check_list`.`note`" => "note",
		"`vehicle_daily_check_list`.`document_checklist_report`" => "document_checklist_report",
		"if(`vehicle_daily_check_list`.`next_inspection_date`,date_format(`vehicle_daily_check_list`.`next_inspection_date`,'%d/%m/%Y'),'')" => "next_inspection_date",
		"IF(    CHAR_LENGTH(`driver1`.`drivers_name_and_surname`), CONCAT_WS('',   `driver1`.`drivers_name_and_surname`), '') /* Driver\'s Surname: */" => "drivers_surname",
		"IF(    CHAR_LENGTH(`driver1`.`drivers_persal_number`), CONCAT_WS('',   `driver1`.`drivers_persal_number`), '') /* Driver\'s Persal Number: */" => "drivers_persal_number",
	];
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = [
		1 => '`vehicle_daily_check_list`.`vehicle_daily_check_list_id`',
		2 => 2,
		3 => 3,
		4 => 4,
		5 => '`log_sheet1`.`closing_km`',
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
		33 => '`vehicle_daily_check_list`.`next_inspection_date`',
		34 => '`driver1`.`drivers_name_and_surname`',
		35 => '`driver1`.`drivers_persal_number`',
	];

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = [
		"`vehicle_daily_check_list`.`vehicle_daily_check_list_id`" => "vehicle_daily_check_list_id",
		"`vehicle_daily_check_list`.`inspection_certification_number`" => "inspection_certification_number",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`) || CHAR_LENGTH(`gmt_fleet_register1`.`chassis_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`, '   |  and  |   ', `gmt_fleet_register1`.`chassis_number`), '') /* Registration Number: */" => "vehicle_registration_number",
		"IF(    CHAR_LENGTH(`dealer1`.`make_of_vehicle`) || CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`), CONCAT_WS('',   `dealer1`.`make_of_vehicle`, '   ', '   |  and  |   ', `gmt_fleet_register1`.`model_of_vehicle`), '') /* Make of Vehicle: */" => "make_of_vehicle",
		"IF(    CHAR_LENGTH(`log_sheet1`.`closing_km`), CONCAT_WS('',   `log_sheet1`.`closing_km`), '') /* Odometer Reading KM: */" => "closing_km",
		"`vehicle_daily_check_list`.`dashboard`" => "dashboard",
		"`vehicle_daily_check_list`.`seats`" => "seats",
		"`vehicle_daily_check_list`.`carpets`" => "carpets",
		"`vehicle_daily_check_list`.`wipers`" => "wipers",
		"`vehicle_daily_check_list`.`head_lights`" => "head_lights",
		"`vehicle_daily_check_list`.`tail_lights`" => "tail_lights",
		"`vehicle_daily_check_list`.`brake_lights`" => "brake_lights",
		"`vehicle_daily_check_list`.`indicators`" => "indicators",
		"`vehicle_daily_check_list`.`windscreen`" => "windscreen",
		"`vehicle_daily_check_list`.`windows`" => "windows",
		"`vehicle_daily_check_list`.`mirrors`" => "mirrors",
		"`vehicle_daily_check_list`.`wheels`" => "wheels",
		"`vehicle_daily_check_list`.`hubcaps`" => "hubcaps",
		"`vehicle_daily_check_list`.`sparewheel`" => "sparewheel",
		"`vehicle_daily_check_list`.`tools`" => "tools",
		"`vehicle_daily_check_list`.`engine_oil`" => "engine_oil",
		"`vehicle_daily_check_list`.`power_steering_oil`" => "power_steering_oil",
		"`vehicle_daily_check_list`.`gearbox_oil`" => "gearbox_oil",
		"`vehicle_daily_check_list`.`coolant`" => "coolant",
		"`vehicle_daily_check_list`.`brake_oil`" => "brake_oil",
		"`vehicle_daily_check_list`.`battery`" => "battery",
		"`vehicle_daily_check_list`.`brakes_front`" => "brakes_front",
		"`vehicle_daily_check_list`.`brakes_rear`" => "brakes_rear",
		"`vehicle_daily_check_list`.`fuel_level`" => "fuel_level",
		"`vehicle_daily_check_list`.`vehicle_fluid_leaks`" => "vehicle_fluid_leaks",
		"`vehicle_daily_check_list`.`note`" => "note",
		"`vehicle_daily_check_list`.`document_checklist_report`" => "document_checklist_report",
		"if(`vehicle_daily_check_list`.`next_inspection_date`,date_format(`vehicle_daily_check_list`.`next_inspection_date`,'%d/%m/%Y'),'')" => "next_inspection_date",
		"IF(    CHAR_LENGTH(`driver1`.`drivers_name_and_surname`), CONCAT_WS('',   `driver1`.`drivers_name_and_surname`), '') /* Driver\'s Surname: */" => "drivers_surname",
		"IF(    CHAR_LENGTH(`driver1`.`drivers_persal_number`), CONCAT_WS('',   `driver1`.`drivers_persal_number`), '') /* Driver\'s Persal Number: */" => "drivers_persal_number",
	];
	// Fields that can be filtered
	$x->QueryFieldsFilters = [
		"`vehicle_daily_check_list`.`vehicle_daily_check_list_id`" => "Daily Checked ID:",
		"`vehicle_daily_check_list`.`inspection_certification_number`" => "Inspection Certification No:",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`) || CHAR_LENGTH(`gmt_fleet_register1`.`chassis_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`, '   |  and  |   ', `gmt_fleet_register1`.`chassis_number`), '') /* Registration Number: */" => "Registration Number:",
		"IF(    CHAR_LENGTH(`dealer1`.`make_of_vehicle`) || CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`), CONCAT_WS('',   `dealer1`.`make_of_vehicle`, '   ', '   |  and  |   ', `gmt_fleet_register1`.`model_of_vehicle`), '') /* Make of Vehicle: */" => "Make of Vehicle:",
		"IF(    CHAR_LENGTH(`log_sheet1`.`closing_km`), CONCAT_WS('',   `log_sheet1`.`closing_km`), '') /* Odometer Reading KM: */" => "Odometer Reading KM:",
		"`vehicle_daily_check_list`.`dashboard`" => "Dashboard:",
		"`vehicle_daily_check_list`.`seats`" => "Seats:",
		"`vehicle_daily_check_list`.`carpets`" => "Carpets:",
		"`vehicle_daily_check_list`.`wipers`" => "Wipers:",
		"`vehicle_daily_check_list`.`head_lights`" => "Head Lights:",
		"`vehicle_daily_check_list`.`tail_lights`" => "Tail lights:",
		"`vehicle_daily_check_list`.`brake_lights`" => "Brake Lights:",
		"`vehicle_daily_check_list`.`indicators`" => "Indicators:",
		"`vehicle_daily_check_list`.`windscreen`" => "Windscreen:",
		"`vehicle_daily_check_list`.`windows`" => "Windows:",
		"`vehicle_daily_check_list`.`mirrors`" => "Mirrors:",
		"`vehicle_daily_check_list`.`wheels`" => "Wheels:",
		"`vehicle_daily_check_list`.`hubcaps`" => "Hubcaps:",
		"`vehicle_daily_check_list`.`sparewheel`" => "Sparewheel:",
		"`vehicle_daily_check_list`.`tools`" => "Tools:",
		"`vehicle_daily_check_list`.`engine_oil`" => "Engine Oil:",
		"`vehicle_daily_check_list`.`power_steering_oil`" => "Power Wheel Steering Oil:",
		"`vehicle_daily_check_list`.`gearbox_oil`" => "Gearbox Oil:",
		"`vehicle_daily_check_list`.`coolant`" => "Coolant Level:",
		"`vehicle_daily_check_list`.`brake_oil`" => "Brake oil",
		"`vehicle_daily_check_list`.`battery`" => "Battery:",
		"`vehicle_daily_check_list`.`brakes_front`" => "Brakes Front:",
		"`vehicle_daily_check_list`.`brakes_rear`" => "Brakes Rear:",
		"`vehicle_daily_check_list`.`fuel_level`" => "Fuel Level:",
		"`vehicle_daily_check_list`.`vehicle_fluid_leaks`" => "Vehicle Fluid Leaks",
		"`vehicle_daily_check_list`.`note`" => "Note:",
		"`vehicle_daily_check_list`.`document_checklist_report`" => "Document Check List Report:",
		"`vehicle_daily_check_list`.`next_inspection_date`" => "Next Inspection Date:",
		"IF(    CHAR_LENGTH(`driver1`.`drivers_name_and_surname`), CONCAT_WS('',   `driver1`.`drivers_name_and_surname`), '') /* Driver\'s Surname: */" => "Driver\'s Surname:",
		"IF(    CHAR_LENGTH(`driver1`.`drivers_persal_number`), CONCAT_WS('',   `driver1`.`drivers_persal_number`), '') /* Driver\'s Persal Number: */" => "Driver\'s Persal Number:",
	];

	// Fields that can be quick searched
	$x->QueryFieldsQS = [
		"`vehicle_daily_check_list`.`vehicle_daily_check_list_id`" => "vehicle_daily_check_list_id",
		"`vehicle_daily_check_list`.`inspection_certification_number`" => "inspection_certification_number",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`) || CHAR_LENGTH(`gmt_fleet_register1`.`chassis_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`, '   |  and  |   ', `gmt_fleet_register1`.`chassis_number`), '') /* Registration Number: */" => "vehicle_registration_number",
		"IF(    CHAR_LENGTH(`dealer1`.`make_of_vehicle`) || CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`), CONCAT_WS('',   `dealer1`.`make_of_vehicle`, '   ', '   |  and  |   ', `gmt_fleet_register1`.`model_of_vehicle`), '') /* Make of Vehicle: */" => "make_of_vehicle",
		"IF(    CHAR_LENGTH(`log_sheet1`.`closing_km`), CONCAT_WS('',   `log_sheet1`.`closing_km`), '') /* Odometer Reading KM: */" => "closing_km",
		"`vehicle_daily_check_list`.`dashboard`" => "dashboard",
		"`vehicle_daily_check_list`.`seats`" => "seats",
		"`vehicle_daily_check_list`.`carpets`" => "carpets",
		"`vehicle_daily_check_list`.`wipers`" => "wipers",
		"`vehicle_daily_check_list`.`head_lights`" => "head_lights",
		"`vehicle_daily_check_list`.`tail_lights`" => "tail_lights",
		"`vehicle_daily_check_list`.`brake_lights`" => "brake_lights",
		"`vehicle_daily_check_list`.`indicators`" => "indicators",
		"`vehicle_daily_check_list`.`windscreen`" => "windscreen",
		"`vehicle_daily_check_list`.`windows`" => "windows",
		"`vehicle_daily_check_list`.`mirrors`" => "mirrors",
		"`vehicle_daily_check_list`.`wheels`" => "wheels",
		"`vehicle_daily_check_list`.`hubcaps`" => "hubcaps",
		"`vehicle_daily_check_list`.`sparewheel`" => "sparewheel",
		"`vehicle_daily_check_list`.`tools`" => "tools",
		"`vehicle_daily_check_list`.`engine_oil`" => "engine_oil",
		"`vehicle_daily_check_list`.`power_steering_oil`" => "power_steering_oil",
		"`vehicle_daily_check_list`.`gearbox_oil`" => "gearbox_oil",
		"`vehicle_daily_check_list`.`coolant`" => "coolant",
		"`vehicle_daily_check_list`.`brake_oil`" => "brake_oil",
		"`vehicle_daily_check_list`.`battery`" => "battery",
		"`vehicle_daily_check_list`.`brakes_front`" => "brakes_front",
		"`vehicle_daily_check_list`.`brakes_rear`" => "brakes_rear",
		"`vehicle_daily_check_list`.`fuel_level`" => "fuel_level",
		"`vehicle_daily_check_list`.`vehicle_fluid_leaks`" => "vehicle_fluid_leaks",
		"`vehicle_daily_check_list`.`note`" => "note",
		"`vehicle_daily_check_list`.`document_checklist_report`" => "document_checklist_report",
		"if(`vehicle_daily_check_list`.`next_inspection_date`,date_format(`vehicle_daily_check_list`.`next_inspection_date`,'%d/%m/%Y'),'')" => "next_inspection_date",
		"IF(    CHAR_LENGTH(`driver1`.`drivers_name_and_surname`), CONCAT_WS('',   `driver1`.`drivers_name_and_surname`), '') /* Driver\'s Surname: */" => "drivers_surname",
		"IF(    CHAR_LENGTH(`driver1`.`drivers_persal_number`), CONCAT_WS('',   `driver1`.`drivers_persal_number`), '') /* Driver\'s Persal Number: */" => "drivers_persal_number",
	];

	// Lookup fields that can be used as filterers
	$x->filterers = ['vehicle_registration_number' => 'Registration Number:', 'closing_km' => 'Odometer Reading KM:', 'drivers_surname' => 'Driver\'s Surname:', ];

	$x->QueryFrom = "`vehicle_daily_check_list` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`vehicle_daily_check_list`.`vehicle_registration_number` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`vehicle_daily_check_list`.`closing_km` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`vehicle_daily_check_list`.`drivers_surname` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` ";
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
	$x->ScriptFileName = 'vehicle_daily_check_list_view.php';
	$x->RedirectAfterInsert = 'vehicle_daily_check_list_view.php?SelectedID=#ID#';
	$x->TableTitle = 'Vehicle Daily Check List:';
	$x->TableIcon = 'resources/table_icons/dispatch_order_128.png';
	$x->PrimaryKey = '`vehicle_daily_check_list`.`vehicle_daily_check_list_id`';

	$x->ColWidth = [150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, ];
	$x->ColCaption = ['Daily Checked ID:', 'Inspection Certification No:', 'Registration Number:', 'Make of Vehicle:', 'Odometer Reading KM:', 'Dashboard:', 'Seats:', 'Carpets:', 'Wipers:', 'Head Lights:', 'Tail lights:', 'Brake Lights:', 'Indicators:', 'Windscreen:', 'Windows:', 'Mirrors:', 'Wheels:', 'Hubcaps:', 'Sparewheel:', 'Tools:', 'Engine Oil:', 'Power Wheel Steering Oil:', 'Gearbox Oil:', 'Coolant Level:', 'Brake oil', 'Battery:', 'Brakes Front:', 'Brakes Rear:', 'Fuel Level:', 'Vehicle Fluid Leaks', 'Note:', 'Document Check List Report:', 'Next Inspection Date:', 'Driver\'s Surname:', 'Driver\'s Persal Number:', ];
	$x->ColFieldName = ['vehicle_daily_check_list_id', 'inspection_certification_number', 'vehicle_registration_number', 'make_of_vehicle', 'closing_km', 'dashboard', 'seats', 'carpets', 'wipers', 'head_lights', 'tail_lights', 'brake_lights', 'indicators', 'windscreen', 'windows', 'mirrors', 'wheels', 'hubcaps', 'sparewheel', 'tools', 'engine_oil', 'power_steering_oil', 'gearbox_oil', 'coolant', 'brake_oil', 'battery', 'brakes_front', 'brakes_rear', 'fuel_level', 'vehicle_fluid_leaks', 'note', 'document_checklist_report', 'next_inspection_date', 'drivers_surname', 'drivers_persal_number', ];
	$x->ColNumber  = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, ];

	// template paths below are based on the app main directory
	$x->Template = 'templates/vehicle_daily_check_list_templateTV.html';
	$x->SelectedTemplate = 'templates/vehicle_daily_check_list_templateTVS.html';
	$x->TemplateDV = 'templates/vehicle_daily_check_list_templateDV.html';
	$x->TemplateDVP = 'templates/vehicle_daily_check_list_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HasCalculatedFields = false;
	$x->AllowConsoleLog = false;
	$x->AllowDVNavigation = true;

	// hook: vehicle_daily_check_list_init
	$render = true;
	if(function_exists('vehicle_daily_check_list_init')) {
		$args = [];
		$render = vehicle_daily_check_list_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: vehicle_daily_check_list_header
	$headerCode = '';
	if(function_exists('vehicle_daily_check_list_header')) {
		$args = [];
		$headerCode = vehicle_daily_check_list_header($x->ContentType, getMemberInfo(), $args);
	}

	if(!$headerCode) {
		include_once(__DIR__ . '/header.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/header.php');
		echo str_replace('<%%HEADER%%>', ob_get_clean(), $headerCode);
	}

	echo $x->HTML;

	// hook: vehicle_daily_check_list_footer
	$footerCode = '';
	if(function_exists('vehicle_daily_check_list_footer')) {
		$args = [];
		$footerCode = vehicle_daily_check_list_footer($x->ContentType, getMemberInfo(), $args);
	}

	if(!$footerCode) {
		include_once(__DIR__ . '/footer.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/footer.php');
		echo str_replace('<%%FOOTER%%>', ob_get_clean(), $footerCode);
	}