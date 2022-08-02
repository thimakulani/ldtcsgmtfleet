<?php
// This script and data application were generated by AppGini 22.13
// Download AppGini for free from https://bigprof.com/appgini/download/

	include_once(__DIR__ . '/lib.php');
	@include_once(__DIR__ . '/hooks/work_allocation.php');
	include_once(__DIR__ . '/work_allocation_dml.php');

	// mm: can the current member access this page?
	$perm = getTablePermissions('work_allocation');
	if(!$perm['access']) {
		echo error_message($Translation['tableAccessDenied']);
		exit;
	}

	$x = new DataList;
	$x->TableName = 'work_allocation';

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = [
		"`work_allocation`.`work_allocation_id`" => "work_allocation_id",
		"IF(    CHAR_LENGTH(`districts1`.`district`), CONCAT_WS('',   `districts1`.`district`), '') /* District: */" => "district",
		"IF(    CHAR_LENGTH(`districts1`.`station`), CONCAT_WS('',   `districts1`.`station`, '   |  and   |   '), '') /* Workshop Name/Station: */" => "location",
		"IF(    CHAR_LENGTH(`cost_centre1`.`cost_centre`), CONCAT_WS('',   `cost_centre1`.`cost_centre`), '') /* Cost centre */" => "cost_centre",
		"`work_allocation`.`supervisor_name_and_surname`" => "supervisor_name_and_surname",
		"`work_allocation`.`supervisor_contact_details`" => "supervisor_contact_details",
		"`work_allocation`.`supervisor_email_address`" => "supervisor_email_address",
		"`work_allocation`.`supervisor_signature`" => "supervisor_signature",
		"`work_allocation`.`economical_repair`" => "economical_repair",
		"`work_allocation`.`uneconomical_repair`" => "uneconomical_repair",
		"`work_allocation`.`work_allocation_reference_number`" => "work_allocation_reference_number",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`), '') /* Registration Number: */" => "vehicle_registration_number",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS('',   `gmt_fleet_register1`.`engine_number`), '') /* Engine Number: */" => "engine_number",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`) || CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS('',   `gmt_fleet_register1`.`model_of_vehicle`, '   |    and     |     ', `dealer1`.`make_of_vehicle`, '   '), '') /* Make of Vehicle: */" => "make_of_vehicle",
		"DATE_FORMAT(`work_allocation`.`date_captured`, '%e/%c/%Y %l:%i%p')" => "date_captured",
	];
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = [
		1 => '`work_allocation`.`work_allocation_id`',
		2 => '`districts1`.`district`',
		3 => 3,
		4 => '`cost_centre1`.`cost_centre`',
		5 => 5,
		6 => 6,
		7 => 7,
		8 => 8,
		9 => 9,
		10 => 10,
		11 => 11,
		12 => '`gmt_fleet_register1`.`vehicle_registration_number`',
		13 => '`gmt_fleet_register1`.`engine_number`',
		14 => 14,
		15 => '`work_allocation`.`date_captured`',
	];

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = [
		"`work_allocation`.`work_allocation_id`" => "work_allocation_id",
		"IF(    CHAR_LENGTH(`districts1`.`district`), CONCAT_WS('',   `districts1`.`district`), '') /* District: */" => "district",
		"IF(    CHAR_LENGTH(`districts1`.`station`), CONCAT_WS('',   `districts1`.`station`, '   |  and   |   '), '') /* Workshop Name/Station: */" => "location",
		"IF(    CHAR_LENGTH(`cost_centre1`.`cost_centre`), CONCAT_WS('',   `cost_centre1`.`cost_centre`), '') /* Cost centre */" => "cost_centre",
		"`work_allocation`.`supervisor_name_and_surname`" => "supervisor_name_and_surname",
		"`work_allocation`.`supervisor_contact_details`" => "supervisor_contact_details",
		"`work_allocation`.`supervisor_email_address`" => "supervisor_email_address",
		"`work_allocation`.`supervisor_signature`" => "supervisor_signature",
		"`work_allocation`.`economical_repair`" => "economical_repair",
		"`work_allocation`.`uneconomical_repair`" => "uneconomical_repair",
		"`work_allocation`.`work_allocation_reference_number`" => "work_allocation_reference_number",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`), '') /* Registration Number: */" => "vehicle_registration_number",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS('',   `gmt_fleet_register1`.`engine_number`), '') /* Engine Number: */" => "engine_number",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`) || CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS('',   `gmt_fleet_register1`.`model_of_vehicle`, '   |    and     |     ', `dealer1`.`make_of_vehicle`, '   '), '') /* Make of Vehicle: */" => "make_of_vehicle",
		"DATE_FORMAT(`work_allocation`.`date_captured`, '%e/%c/%Y %l:%i%p')" => "date_captured",
	];
	// Fields that can be filtered
	$x->QueryFieldsFilters = [
		"`work_allocation`.`work_allocation_id`" => "Work Allocation ID:",
		"IF(    CHAR_LENGTH(`districts1`.`district`), CONCAT_WS('',   `districts1`.`district`), '') /* District: */" => "District:",
		"IF(    CHAR_LENGTH(`districts1`.`station`), CONCAT_WS('',   `districts1`.`station`, '   |  and   |   '), '') /* Workshop Name/Station: */" => "Workshop Name/Station:",
		"IF(    CHAR_LENGTH(`cost_centre1`.`cost_centre`), CONCAT_WS('',   `cost_centre1`.`cost_centre`), '') /* Cost centre */" => "Cost centre",
		"`work_allocation`.`supervisor_name_and_surname`" => "Supervisor Name & Surname:",
		"`work_allocation`.`supervisor_contact_details`" => "Supervisor Contact Details:",
		"`work_allocation`.`supervisor_email_address`" => "Supervisor Email Address:",
		"`work_allocation`.`economical_repair`" => "Economical Repair:",
		"`work_allocation`.`uneconomical_repair`" => "Uneconomical Repair:",
		"`work_allocation`.`work_allocation_reference_number`" => "Work Allocation Reference Number:",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`), '') /* Registration Number: */" => "Registration Number:",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS('',   `gmt_fleet_register1`.`engine_number`), '') /* Engine Number: */" => "Engine Number:",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`) || CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS('',   `gmt_fleet_register1`.`model_of_vehicle`, '   |    and     |     ', `dealer1`.`make_of_vehicle`, '   '), '') /* Make of Vehicle: */" => "Make of Vehicle:",
		"`work_allocation`.`date_captured`" => "Date Captured:",
	];

	// Fields that can be quick searched
	$x->QueryFieldsQS = [
		"`work_allocation`.`work_allocation_id`" => "work_allocation_id",
		"IF(    CHAR_LENGTH(`districts1`.`district`), CONCAT_WS('',   `districts1`.`district`), '') /* District: */" => "district",
		"IF(    CHAR_LENGTH(`districts1`.`station`), CONCAT_WS('',   `districts1`.`station`, '   |  and   |   '), '') /* Workshop Name/Station: */" => "location",
		"IF(    CHAR_LENGTH(`cost_centre1`.`cost_centre`), CONCAT_WS('',   `cost_centre1`.`cost_centre`), '') /* Cost centre */" => "cost_centre",
		"`work_allocation`.`supervisor_name_and_surname`" => "supervisor_name_and_surname",
		"`work_allocation`.`supervisor_contact_details`" => "supervisor_contact_details",
		"`work_allocation`.`supervisor_email_address`" => "supervisor_email_address",
		"`work_allocation`.`economical_repair`" => "economical_repair",
		"`work_allocation`.`uneconomical_repair`" => "uneconomical_repair",
		"`work_allocation`.`work_allocation_reference_number`" => "work_allocation_reference_number",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`), '') /* Registration Number: */" => "vehicle_registration_number",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS('',   `gmt_fleet_register1`.`engine_number`), '') /* Engine Number: */" => "engine_number",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`) || CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS('',   `gmt_fleet_register1`.`model_of_vehicle`, '   |    and     |     ', `dealer1`.`make_of_vehicle`, '   '), '') /* Make of Vehicle: */" => "make_of_vehicle",
		"DATE_FORMAT(`work_allocation`.`date_captured`, '%e/%c/%Y %l:%i%p')" => "date_captured",
	];

	// Lookup fields that can be used as filterers
	$x->filterers = ['district' => 'District:', 'cost_centre' => 'Cost centre', 'vehicle_registration_number' => 'Registration Number:', ];

	$x->QueryFrom = "`work_allocation` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`work_allocation`.`district` LEFT JOIN `cost_centre` as cost_centre1 ON `cost_centre1`.`cost_centre_id`=`work_allocation`.`cost_centre` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`work_allocation`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` ";
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
	$x->ScriptFileName = 'work_allocation_view.php';
	$x->RedirectAfterInsert = 'work_allocation_view.php?SelectedID=#ID#';
	$x->TableTitle = 'Work Allocation:';
	$x->TableIcon = 'resources/table_icons/inventory_clock_128.png';
	$x->PrimaryKey = '`work_allocation`.`work_allocation_id`';

	$x->ColWidth = [150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, ];
	$x->ColCaption = ['Work Allocation ID:', 'District:', 'Workshop Name/Station:', 'Cost centre', 'Supervisor Name & Surname:', 'Supervisor Contact Details:', 'Supervisor Email Address:', 'Supervisor Signature:', 'Economical Repair:', 'Uneconomical Repair:', 'Work Allocation Reference Number:', 'Registration Number:', 'Engine Number:', 'Make of Vehicle:', 'Date Captured:', ];
	$x->ColFieldName = ['work_allocation_id', 'district', 'location', 'cost_centre', 'supervisor_name_and_surname', 'supervisor_contact_details', 'supervisor_email_address', 'supervisor_signature', 'economical_repair', 'uneconomical_repair', 'work_allocation_reference_number', 'vehicle_registration_number', 'engine_number', 'make_of_vehicle', 'date_captured', ];
	$x->ColNumber  = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, ];

	// template paths below are based on the app main directory
	$x->Template = 'templates/work_allocation_templateTV.html';
	$x->SelectedTemplate = 'templates/work_allocation_templateTVS.html';
	$x->TemplateDV = 'templates/work_allocation_templateDV.html';
	$x->TemplateDVP = 'templates/work_allocation_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HasCalculatedFields = false;
	$x->AllowConsoleLog = false;
	$x->AllowDVNavigation = true;

	// hook: work_allocation_init
	$render = true;
	if(function_exists('work_allocation_init')) {
		$args = [];
		$render = work_allocation_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: work_allocation_header
	$headerCode = '';
	if(function_exists('work_allocation_header')) {
		$args = [];
		$headerCode = work_allocation_header($x->ContentType, getMemberInfo(), $args);
	}

	if(!$headerCode) {
		include_once(__DIR__ . '/header.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/header.php');
		echo str_replace('<%%HEADER%%>', ob_get_clean(), $headerCode);
	}

	echo $x->HTML;

	// hook: work_allocation_footer
	$footerCode = '';
	if(function_exists('work_allocation_footer')) {
		$args = [];
		$footerCode = work_allocation_footer($x->ContentType, getMemberInfo(), $args);
	}

	if(!$footerCode) {
		include_once(__DIR__ . '/footer.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/footer.php');
		echo str_replace('<%%FOOTER%%>', ob_get_clean(), $footerCode);
	}