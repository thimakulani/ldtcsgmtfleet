<?php
// This script and data application were generated by AppGini 22.13
// Download AppGini for free from https://bigprof.com/appgini/download/

	include_once(__DIR__ . '/lib.php');
	@include_once(__DIR__ . '/hooks/billing.php');
	include_once(__DIR__ . '/billing_dml.php');

	// mm: can the current member access this page?
	$perm = getTablePermissions('billing');
	if(!$perm['access']) {
		echo error_message($Translation['tableAccessDenied']);
		exit;
	}

	$x = new DataList;
	$x->TableName = 'billing';

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = [
		"`billing`.`billing_id`" => "billing_id",
		"IF(    CHAR_LENGTH(`districts1`.`district`), CONCAT_WS('',   `districts1`.`district`), '') /* District: */" => "district",
		"IF(    CHAR_LENGTH(`districts1`.`station`), CONCAT_WS('',   `districts1`.`station`, '   |  and   |   '), '') /* Station: */" => "location",
		"`billing`.`upload_invoice`" => "upload_invoice",
		"IF(    CHAR_LENGTH(`reception1`.`job_card_number`), CONCAT_WS('',   `reception1`.`job_card_number`), '') /* Job Card Number: */" => "job_card_number",
		"if(`billing`.`invoice_date`,date_format(`billing`.`invoice_date`,'%d/%m/%Y'),'')" => "invoice_date",
		"`billing`.`maintenance_file`" => "maintenance_file",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`), '') /* Registration Number: */" => "vehicle_registration_number",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS('',   `gmt_fleet_register1`.`engine_number`), '') /* Engine Number: */" => "engine_number",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`) || CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS('',   `gmt_fleet_register1`.`model_of_vehicle`, '   |    and     |     ', `dealer1`.`make_of_vehicle`, '   '), '') /* Make of Vehicle: */" => "make_of_vehicle",
	];
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = [
		1 => '`billing`.`billing_id`',
		2 => '`districts1`.`district`',
		3 => 3,
		4 => 4,
		5 => 5,
		6 => '`billing`.`invoice_date`',
		7 => 7,
		8 => '`gmt_fleet_register1`.`vehicle_registration_number`',
		9 => '`gmt_fleet_register1`.`engine_number`',
		10 => 10,
	];

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = [
		"`billing`.`billing_id`" => "billing_id",
		"IF(    CHAR_LENGTH(`districts1`.`district`), CONCAT_WS('',   `districts1`.`district`), '') /* District: */" => "district",
		"IF(    CHAR_LENGTH(`districts1`.`station`), CONCAT_WS('',   `districts1`.`station`, '   |  and   |   '), '') /* Station: */" => "location",
		"`billing`.`upload_invoice`" => "upload_invoice",
		"IF(    CHAR_LENGTH(`reception1`.`job_card_number`), CONCAT_WS('',   `reception1`.`job_card_number`), '') /* Job Card Number: */" => "job_card_number",
		"if(`billing`.`invoice_date`,date_format(`billing`.`invoice_date`,'%d/%m/%Y'),'')" => "invoice_date",
		"`billing`.`maintenance_file`" => "maintenance_file",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`), '') /* Registration Number: */" => "vehicle_registration_number",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS('',   `gmt_fleet_register1`.`engine_number`), '') /* Engine Number: */" => "engine_number",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`) || CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS('',   `gmt_fleet_register1`.`model_of_vehicle`, '   |    and     |     ', `dealer1`.`make_of_vehicle`, '   '), '') /* Make of Vehicle: */" => "make_of_vehicle",
	];
	// Fields that can be filtered
	$x->QueryFieldsFilters = [
		"`billing`.`billing_id`" => "Billing ID:",
		"IF(    CHAR_LENGTH(`districts1`.`district`), CONCAT_WS('',   `districts1`.`district`), '') /* District: */" => "District:",
		"IF(    CHAR_LENGTH(`districts1`.`station`), CONCAT_WS('',   `districts1`.`station`, '   |  and   |   '), '') /* Station: */" => "Station:",
		"`billing`.`upload_invoice`" => "Invoice Upload:",
		"IF(    CHAR_LENGTH(`reception1`.`job_card_number`), CONCAT_WS('',   `reception1`.`job_card_number`), '') /* Job Card Number: */" => "Job Card Number:",
		"`billing`.`invoice_date`" => "Invoice Date:",
		"`billing`.`maintenance_file`" => "Maintenance File:",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`), '') /* Registration Number: */" => "Registration Number:",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS('',   `gmt_fleet_register1`.`engine_number`), '') /* Engine Number: */" => "Engine Number:",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`) || CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS('',   `gmt_fleet_register1`.`model_of_vehicle`, '   |    and     |     ', `dealer1`.`make_of_vehicle`, '   '), '') /* Make of Vehicle: */" => "Make of Vehicle:",
	];

	// Fields that can be quick searched
	$x->QueryFieldsQS = [
		"`billing`.`billing_id`" => "billing_id",
		"IF(    CHAR_LENGTH(`districts1`.`district`), CONCAT_WS('',   `districts1`.`district`), '') /* District: */" => "district",
		"IF(    CHAR_LENGTH(`districts1`.`station`), CONCAT_WS('',   `districts1`.`station`, '   |  and   |   '), '') /* Station: */" => "location",
		"`billing`.`upload_invoice`" => "upload_invoice",
		"IF(    CHAR_LENGTH(`reception1`.`job_card_number`), CONCAT_WS('',   `reception1`.`job_card_number`), '') /* Job Card Number: */" => "job_card_number",
		"if(`billing`.`invoice_date`,date_format(`billing`.`invoice_date`,'%d/%m/%Y'),'')" => "invoice_date",
		"`billing`.`maintenance_file`" => "maintenance_file",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`), '') /* Registration Number: */" => "vehicle_registration_number",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS('',   `gmt_fleet_register1`.`engine_number`), '') /* Engine Number: */" => "engine_number",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`) || CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS('',   `gmt_fleet_register1`.`model_of_vehicle`, '   |    and     |     ', `dealer1`.`make_of_vehicle`, '   '), '') /* Make of Vehicle: */" => "make_of_vehicle",
	];

	// Lookup fields that can be used as filterers
	$x->filterers = ['district' => 'District:', 'job_card_number' => 'Job Card Number:', 'vehicle_registration_number' => 'Registration Number:', ];

	$x->QueryFrom = "`billing` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`billing`.`district` LEFT JOIN `costing` as costing1 ON `costing1`.`costing_id`=`billing`.`job_card_number` LEFT JOIN `reception` as reception1 ON `reception1`.`reception_user_id`=`costing1`.`job_card_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`billing`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` ";
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
	$x->ScriptFileName = 'billing_view.php';
	$x->RedirectAfterInsert = 'billing_view.php?SelectedID=#ID#';
	$x->TableTitle = 'Billing:';
	$x->TableIcon = 'resources/table_icons/Invoice_Paid_Document.png';
	$x->PrimaryKey = '`billing`.`billing_id`';

	$x->ColWidth = [150, 150, 150, 150, 150, 150, 150, 150, 150, 150, ];
	$x->ColCaption = ['Billing ID:', 'District:', 'Station:', 'Invoice Upload:', 'Job Card Number:', 'Invoice Date:', 'Maintenance File:', 'Registration Number:', 'Engine Number:', 'Make of Vehicle:', ];
	$x->ColFieldName = ['billing_id', 'district', 'location', 'upload_invoice', 'job_card_number', 'invoice_date', 'maintenance_file', 'vehicle_registration_number', 'engine_number', 'make_of_vehicle', ];
	$x->ColNumber  = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, ];

	// template paths below are based on the app main directory
	$x->Template = 'templates/billing_templateTV.html';
	$x->SelectedTemplate = 'templates/billing_templateTVS.html';
	$x->TemplateDV = 'templates/billing_templateDV.html';
	$x->TemplateDVP = 'templates/billing_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HasCalculatedFields = false;
	$x->AllowConsoleLog = false;
	$x->AllowDVNavigation = true;

	// hook: billing_init
	$render = true;
	if(function_exists('billing_init')) {
		$args = [];
		$render = billing_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: billing_header
	$headerCode = '';
	if(function_exists('billing_header')) {
		$args = [];
		$headerCode = billing_header($x->ContentType, getMemberInfo(), $args);
	}

	if(!$headerCode) {
		include_once(__DIR__ . '/header.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/header.php');
		echo str_replace('<%%HEADER%%>', ob_get_clean(), $headerCode);
	}

	echo $x->HTML;

	// hook: billing_footer
	$footerCode = '';
	if(function_exists('billing_footer')) {
		$args = [];
		$footerCode = billing_footer($x->ContentType, getMemberInfo(), $args);
	}

	if(!$footerCode) {
		include_once(__DIR__ . '/footer.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/footer.php');
		echo str_replace('<%%FOOTER%%>', ob_get_clean(), $footerCode);
	}
