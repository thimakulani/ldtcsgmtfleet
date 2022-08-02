<?php
// This script and data application were generated by AppGini 22.13
// Download AppGini for free from https://bigprof.com/appgini/download/

	include_once(__DIR__ . '/lib.php');
	@include_once(__DIR__ . '/hooks/general_control_measures.php');
	include_once(__DIR__ . '/general_control_measures_dml.php');

	// mm: can the current member access this page?
	$perm = getTablePermissions('general_control_measures');
	if(!$perm['access']) {
		echo error_message($Translation['tableAccessDenied']);
		exit;
	}

	$x = new DataList;
	$x->TableName = 'general_control_measures';

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = [
		"`general_control_measures`.`general_control_measures_id`" => "general_control_measures_id",
		"IF(    CHAR_LENGTH(`districts1`.`district`), CONCAT_WS('',   `districts1`.`district`), '') /* District: */" => "district",
		"IF(    CHAR_LENGTH(`cost_centre1`.`cost_centre`), CONCAT_WS('',   `cost_centre1`.`cost_centre`), '') /* Cost Centre: */" => "cost_centre",
		"IF(    CHAR_LENGTH(`districts1`.`station`), CONCAT_WS('',   `districts1`.`station`, '   |  and   |   '), '') /* Station: */" => "location",
		"`general_control_measures`.`government_garage_name`" => "government_garage_name",
		"`general_control_measures`.`government_garage_section`" => "government_garage_section",
		"`general_control_measures`.`government_garage_manager_name_and_surname`" => "government_garage_manager_name_and_surname",
		"`general_control_measures`.`government_garage_manager_contact_details`" => "government_garage_manager_contact_details",
		"`general_control_measures`.`government_garage_manager_email_address`" => "government_garage_manager_email_address",
		"`general_control_measures`.`government_garage_manager_signature`" => "government_garage_manager_signature",
		"`general_control_measures`.`government_garage_address`" => "government_garage_address",
		"`general_control_measures`.`government_garage_condition`" => "government_garage_condition",
		"`general_control_measures`.`four_post_lift_condition`" => "four_post_lift_condition",
		"`general_control_measures`.`low_level_lift_condition`" => "low_level_lift_condition",
		"`general_control_measures`.`test_machines_conditions`" => "test_machines_conditions",
		"`general_control_measures`.`battery_testers_conditions`" => "battery_testers_conditions",
		"`general_control_measures`.`chargers_conditions`" => "chargers_conditions",
		"`general_control_measures`.`tools_conditions`" => "tools_conditions",
		"`general_control_measures`.`hand_tools_conditions`" => "hand_tools_conditions",
		"`general_control_measures`.`equipment_conditions`" => "equipment_conditions",
		"`general_control_measures`.`sectional_inspection`" => "sectional_inspection",
	];
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = [
		1 => '`general_control_measures`.`general_control_measures_id`',
		2 => '`districts1`.`district`',
		3 => '`cost_centre1`.`cost_centre`',
		4 => 4,
		5 => '`general_control_measures`.`government_garage_name`',
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
		18 => '`general_control_measures`.`tools_conditions`',
		19 => '`general_control_measures`.`hand_tools_conditions`',
		20 => 20,
		21 => 21,
	];

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = [
		"`general_control_measures`.`general_control_measures_id`" => "general_control_measures_id",
		"IF(    CHAR_LENGTH(`districts1`.`district`), CONCAT_WS('',   `districts1`.`district`), '') /* District: */" => "district",
		"IF(    CHAR_LENGTH(`cost_centre1`.`cost_centre`), CONCAT_WS('',   `cost_centre1`.`cost_centre`), '') /* Cost Centre: */" => "cost_centre",
		"IF(    CHAR_LENGTH(`districts1`.`station`), CONCAT_WS('',   `districts1`.`station`, '   |  and   |   '), '') /* Station: */" => "location",
		"`general_control_measures`.`government_garage_name`" => "government_garage_name",
		"`general_control_measures`.`government_garage_section`" => "government_garage_section",
		"`general_control_measures`.`government_garage_manager_name_and_surname`" => "government_garage_manager_name_and_surname",
		"`general_control_measures`.`government_garage_manager_contact_details`" => "government_garage_manager_contact_details",
		"`general_control_measures`.`government_garage_manager_email_address`" => "government_garage_manager_email_address",
		"`general_control_measures`.`government_garage_manager_signature`" => "government_garage_manager_signature",
		"`general_control_measures`.`government_garage_address`" => "government_garage_address",
		"`general_control_measures`.`government_garage_condition`" => "government_garage_condition",
		"`general_control_measures`.`four_post_lift_condition`" => "four_post_lift_condition",
		"`general_control_measures`.`low_level_lift_condition`" => "low_level_lift_condition",
		"`general_control_measures`.`test_machines_conditions`" => "test_machines_conditions",
		"`general_control_measures`.`battery_testers_conditions`" => "battery_testers_conditions",
		"`general_control_measures`.`chargers_conditions`" => "chargers_conditions",
		"`general_control_measures`.`tools_conditions`" => "tools_conditions",
		"`general_control_measures`.`hand_tools_conditions`" => "hand_tools_conditions",
		"`general_control_measures`.`equipment_conditions`" => "equipment_conditions",
		"`general_control_measures`.`sectional_inspection`" => "sectional_inspection",
	];
	// Fields that can be filtered
	$x->QueryFieldsFilters = [
		"`general_control_measures`.`general_control_measures_id`" => "General Control Measures ID:",
		"IF(    CHAR_LENGTH(`districts1`.`district`), CONCAT_WS('',   `districts1`.`district`), '') /* District: */" => "District:",
		"IF(    CHAR_LENGTH(`cost_centre1`.`cost_centre`), CONCAT_WS('',   `cost_centre1`.`cost_centre`), '') /* Cost Centre: */" => "Cost Centre:",
		"IF(    CHAR_LENGTH(`districts1`.`station`), CONCAT_WS('',   `districts1`.`station`, '   |  and   |   '), '') /* Station: */" => "Station:",
		"`general_control_measures`.`government_garage_name`" => "Government Garage Name:",
		"`general_control_measures`.`government_garage_section`" => "Government Garage Section:",
		"`general_control_measures`.`government_garage_manager_name_and_surname`" => "Manager Name & Surname:",
		"`general_control_measures`.`government_garage_manager_contact_details`" => "Government Garage Manager Contact Details:",
		"`general_control_measures`.`government_garage_manager_email_address`" => "Government Garage Manager Email Address:",
		"`general_control_measures`.`government_garage_manager_signature`" => "Government Garage Manager Signature:",
		"`general_control_measures`.`government_garage_address`" => "Government Garage Address:",
		"`general_control_measures`.`government_garage_condition`" => "Government Garage Condition:",
		"`general_control_measures`.`four_post_lift_condition`" => "Four Post Lift Condition:",
		"`general_control_measures`.`low_level_lift_condition`" => "Low Level Lift Condition:",
		"`general_control_measures`.`test_machines_conditions`" => "Test Machines Conditions:",
		"`general_control_measures`.`battery_testers_conditions`" => "Battery Testers Conditions:",
		"`general_control_measures`.`chargers_conditions`" => "Chargers Conditions:",
		"`general_control_measures`.`tools_conditions`" => "Tools Conditions:",
		"`general_control_measures`.`hand_tools_conditions`" => "Hand Tools Conditions:",
		"`general_control_measures`.`equipment_conditions`" => "Equipment Conditions:",
		"`general_control_measures`.`sectional_inspection`" => "Sectional Inspection:",
	];

	// Fields that can be quick searched
	$x->QueryFieldsQS = [
		"`general_control_measures`.`general_control_measures_id`" => "general_control_measures_id",
		"IF(    CHAR_LENGTH(`districts1`.`district`), CONCAT_WS('',   `districts1`.`district`), '') /* District: */" => "district",
		"IF(    CHAR_LENGTH(`cost_centre1`.`cost_centre`), CONCAT_WS('',   `cost_centre1`.`cost_centre`), '') /* Cost Centre: */" => "cost_centre",
		"IF(    CHAR_LENGTH(`districts1`.`station`), CONCAT_WS('',   `districts1`.`station`, '   |  and   |   '), '') /* Station: */" => "location",
		"`general_control_measures`.`government_garage_name`" => "government_garage_name",
		"`general_control_measures`.`government_garage_section`" => "government_garage_section",
		"`general_control_measures`.`government_garage_manager_name_and_surname`" => "government_garage_manager_name_and_surname",
		"`general_control_measures`.`government_garage_manager_contact_details`" => "government_garage_manager_contact_details",
		"`general_control_measures`.`government_garage_manager_email_address`" => "government_garage_manager_email_address",
		"`general_control_measures`.`government_garage_manager_signature`" => "government_garage_manager_signature",
		"`general_control_measures`.`government_garage_address`" => "government_garage_address",
		"`general_control_measures`.`government_garage_condition`" => "government_garage_condition",
		"`general_control_measures`.`four_post_lift_condition`" => "four_post_lift_condition",
		"`general_control_measures`.`low_level_lift_condition`" => "low_level_lift_condition",
		"`general_control_measures`.`test_machines_conditions`" => "test_machines_conditions",
		"`general_control_measures`.`battery_testers_conditions`" => "battery_testers_conditions",
		"`general_control_measures`.`chargers_conditions`" => "chargers_conditions",
		"`general_control_measures`.`tools_conditions`" => "tools_conditions",
		"`general_control_measures`.`hand_tools_conditions`" => "hand_tools_conditions",
		"`general_control_measures`.`equipment_conditions`" => "equipment_conditions",
		"`general_control_measures`.`sectional_inspection`" => "sectional_inspection",
	];

	// Lookup fields that can be used as filterers
	$x->filterers = ['district' => 'District:', 'cost_centre' => 'Cost Centre:', ];

	$x->QueryFrom = "`general_control_measures` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`general_control_measures`.`district` LEFT JOIN `cost_centre` as cost_centre1 ON `cost_centre1`.`cost_centre_id`=`general_control_measures`.`cost_centre` ";
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
	$x->ScriptFileName = 'general_control_measures_view.php';
	$x->RedirectAfterInsert = 'general_control_measures_view.php?SelectedID=#ID#';
	$x->TableTitle = 'General Control Measures:';
	$x->TableIcon = 'resources/table_icons/EKG.png';
	$x->PrimaryKey = '`general_control_measures`.`general_control_measures_id`';

	$x->ColWidth = [150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, ];
	$x->ColCaption = ['General Control Measures ID:', 'District:', 'Cost Centre:', 'Station:', 'Government Garage Name:', 'Government Garage Section:', 'Manager Name & Surname:', 'Government Garage Manager Contact Details:', 'Government Garage Manager Email Address:', 'Government Garage Manager Signature:', 'Government Garage Address:', 'Government Garage Condition:', 'Four Post Lift Condition:', 'Low Level Lift Condition:', 'Test Machines Conditions:', 'Battery Testers Conditions:', 'Chargers Conditions:', 'Tools Conditions:', 'Hand Tools Conditions:', 'Equipment Conditions:', 'Sectional Inspection:', ];
	$x->ColFieldName = ['general_control_measures_id', 'district', 'cost_centre', 'location', 'government_garage_name', 'government_garage_section', 'government_garage_manager_name_and_surname', 'government_garage_manager_contact_details', 'government_garage_manager_email_address', 'government_garage_manager_signature', 'government_garage_address', 'government_garage_condition', 'four_post_lift_condition', 'low_level_lift_condition', 'test_machines_conditions', 'battery_testers_conditions', 'chargers_conditions', 'tools_conditions', 'hand_tools_conditions', 'equipment_conditions', 'sectional_inspection', ];
	$x->ColNumber  = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, ];

	// template paths below are based on the app main directory
	$x->Template = 'templates/general_control_measures_templateTV.html';
	$x->SelectedTemplate = 'templates/general_control_measures_templateTVS.html';
	$x->TemplateDV = 'templates/general_control_measures_templateDV.html';
	$x->TemplateDVP = 'templates/general_control_measures_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HasCalculatedFields = false;
	$x->AllowConsoleLog = false;
	$x->AllowDVNavigation = true;

	// hook: general_control_measures_init
	$render = true;
	if(function_exists('general_control_measures_init')) {
		$args = [];
		$render = general_control_measures_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: general_control_measures_header
	$headerCode = '';
	if(function_exists('general_control_measures_header')) {
		$args = [];
		$headerCode = general_control_measures_header($x->ContentType, getMemberInfo(), $args);
	}

	if(!$headerCode) {
		include_once(__DIR__ . '/header.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/header.php');
		echo str_replace('<%%HEADER%%>', ob_get_clean(), $headerCode);
	}

	echo $x->HTML;

	// hook: general_control_measures_footer
	$footerCode = '';
	if(function_exists('general_control_measures_footer')) {
		$args = [];
		$footerCode = general_control_measures_footer($x->ContentType, getMemberInfo(), $args);
	}

	if(!$footerCode) {
		include_once(__DIR__ . '/footer.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/footer.php');
		echo str_replace('<%%FOOTER%%>', ob_get_clean(), $footerCode);
	}