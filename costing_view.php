<?php
// This script and data application were generated by AppGini 22.13
// Download AppGini for free from https://bigprof.com/appgini/download/

	include_once(__DIR__ . '/lib.php');
	@include_once(__DIR__ . '/hooks/costing.php');
	include_once(__DIR__ . '/costing_dml.php');

	// mm: can the current member access this page?
	$perm = getTablePermissions('costing');
	if(!$perm['access']) {
		echo error_message($Translation['tableAccessDenied']);
		exit;
	}

	$x = new DataList;
	$x->TableName = 'costing';

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = [
		"`costing`.`costing_id`" => "costing_id",
		"IF(    CHAR_LENGTH(`districts1`.`station`) || CHAR_LENGTH(`districts1`.`district`), CONCAT_WS('',   `districts1`.`station`, '    |    and    |      ', `districts1`.`district`), '') /* Government Garage Name: */" => "government_garage_name",
		"`costing`.`supervisor_name_and_surname`" => "supervisor_name_and_surname",
		"`costing`.`supervisor_contact_details`" => "supervisor_contact_details",
		"`costing`.`supervisor_email_address`" => "supervisor_email_address",
		"`costing`.`supervisor_signature`" => "supervisor_signature",
		"IF(    CHAR_LENGTH(`reception1`.`job_card_number`), CONCAT_WS('',   `reception1`.`job_card_number`), '') /* Job Card Number: */" => "job_card_number",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`), '') /* Registration Number: */" => "vehicle_registration_number",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS('',   `gmt_fleet_register1`.`engine_number`), '') /* Engine Number: */" => "engine_number",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`) || CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS('',   `gmt_fleet_register1`.`model_of_vehicle`, '   |    and     |     ', `dealer1`.`make_of_vehicle`, '   '), '') /* Make of Vehicle: */" => "make_of_vehicle",
		"`costing`.`reconciliation_of_total_costs_by_costing_officer`" => "reconciliation_of_total_costs_by_costing_officer",
		"`costing`.`costing_officer_name_and_surname`" => "costing_officer_name_and_surname",
		"`costing`.`costing_officer_contact_details`" => "costing_officer_contact_details",
		"`costing`.`costing_officer_email_address`" => "costing_officer_email_address",
		"`costing`.`costing_officer_signature`" => "costing_officer_signature",
		"`costing`.`material_cost`" => "material_cost",
		"`costing`.`spares_orders_quotation`" => "spares_orders_quotation",
		"`costing`.`spares_orders_quotation_upload`" => "spares_orders_quotation_upload",
		"`costing`.`standard_labour_cost_per_hour`" => "standard_labour_cost_per_hour",
		"`costing`.`labour_quotation`" => "labour_quotation",
		"`costing`.`labour_quotation_upload`" => "labour_quotation_upload",
		"`costing`.`vat`" => "vat",
		"`costing`.`total_amount`" => "total_amount",
		"`costing`.`workshop_manager_name_and_surname`" => "workshop_manager_name_and_surname",
		"`costing`.`workshop_manager_contact_details`" => "workshop_manager_contact_details",
		"`costing`.`workshop_manager_email_address`" => "workshop_manager_email_address",
		"`costing`.`workshop_manager_signature`" => "workshop_manager_signature",
		"`costing`.`invoice_approved`" => "invoice_approved",
		"if(`costing`.`invoice_date`,date_format(`costing`.`invoice_date`,'%d/%m/%Y'),'')" => "invoice_date",
		"`costing`.`upload_invoice`" => "upload_invoice",
	];
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = [
		1 => '`costing`.`costing_id`',
		2 => 2,
		3 => 3,
		4 => 4,
		5 => 5,
		6 => 6,
		7 => '`reception1`.`job_card_number`',
		8 => '`gmt_fleet_register1`.`vehicle_registration_number`',
		9 => '`gmt_fleet_register1`.`engine_number`',
		10 => 10,
		11 => 11,
		12 => 12,
		13 => 13,
		14 => 14,
		15 => 15,
		16 => '`costing`.`material_cost`',
		17 => '`costing`.`spares_orders_quotation`',
		18 => 18,
		19 => '`costing`.`standard_labour_cost_per_hour`',
		20 => '`costing`.`labour_quotation`',
		21 => 21,
		22 => '`costing`.`vat`',
		23 => '`costing`.`total_amount`',
		24 => 24,
		25 => 25,
		26 => 26,
		27 => 27,
		28 => 28,
		29 => '`costing`.`invoice_date`',
		30 => 30,
	];

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = [
		"`costing`.`costing_id`" => "costing_id",
		"IF(    CHAR_LENGTH(`districts1`.`station`) || CHAR_LENGTH(`districts1`.`district`), CONCAT_WS('',   `districts1`.`station`, '    |    and    |      ', `districts1`.`district`), '') /* Government Garage Name: */" => "government_garage_name",
		"`costing`.`supervisor_name_and_surname`" => "supervisor_name_and_surname",
		"`costing`.`supervisor_contact_details`" => "supervisor_contact_details",
		"`costing`.`supervisor_email_address`" => "supervisor_email_address",
		"`costing`.`supervisor_signature`" => "supervisor_signature",
		"IF(    CHAR_LENGTH(`reception1`.`job_card_number`), CONCAT_WS('',   `reception1`.`job_card_number`), '') /* Job Card Number: */" => "job_card_number",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`), '') /* Registration Number: */" => "vehicle_registration_number",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS('',   `gmt_fleet_register1`.`engine_number`), '') /* Engine Number: */" => "engine_number",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`) || CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS('',   `gmt_fleet_register1`.`model_of_vehicle`, '   |    and     |     ', `dealer1`.`make_of_vehicle`, '   '), '') /* Make of Vehicle: */" => "make_of_vehicle",
		"`costing`.`reconciliation_of_total_costs_by_costing_officer`" => "reconciliation_of_total_costs_by_costing_officer",
		"`costing`.`costing_officer_name_and_surname`" => "costing_officer_name_and_surname",
		"`costing`.`costing_officer_contact_details`" => "costing_officer_contact_details",
		"`costing`.`costing_officer_email_address`" => "costing_officer_email_address",
		"`costing`.`costing_officer_signature`" => "costing_officer_signature",
		"`costing`.`material_cost`" => "material_cost",
		"`costing`.`spares_orders_quotation`" => "spares_orders_quotation",
		"`costing`.`spares_orders_quotation_upload`" => "spares_orders_quotation_upload",
		"`costing`.`standard_labour_cost_per_hour`" => "standard_labour_cost_per_hour",
		"`costing`.`labour_quotation`" => "labour_quotation",
		"`costing`.`labour_quotation_upload`" => "labour_quotation_upload",
		"`costing`.`vat`" => "vat",
		"`costing`.`total_amount`" => "total_amount",
		"`costing`.`workshop_manager_name_and_surname`" => "workshop_manager_name_and_surname",
		"`costing`.`workshop_manager_contact_details`" => "workshop_manager_contact_details",
		"`costing`.`workshop_manager_email_address`" => "workshop_manager_email_address",
		"`costing`.`workshop_manager_signature`" => "workshop_manager_signature",
		"`costing`.`invoice_approved`" => "invoice_approved",
		"if(`costing`.`invoice_date`,date_format(`costing`.`invoice_date`,'%d/%m/%Y'),'')" => "invoice_date",
		"`costing`.`upload_invoice`" => "upload_invoice",
	];
	// Fields that can be filtered
	$x->QueryFieldsFilters = [
		"`costing`.`costing_id`" => "Costing ID:",
		"IF(    CHAR_LENGTH(`districts1`.`station`) || CHAR_LENGTH(`districts1`.`district`), CONCAT_WS('',   `districts1`.`station`, '    |    and    |      ', `districts1`.`district`), '') /* Government Garage Name: */" => "Government Garage Name:",
		"`costing`.`supervisor_name_and_surname`" => "Supervisor Name & Surname:",
		"`costing`.`supervisor_contact_details`" => "Supervisor Contact Details:",
		"`costing`.`supervisor_email_address`" => "Supervisor Email Address:",
		"IF(    CHAR_LENGTH(`reception1`.`job_card_number`), CONCAT_WS('',   `reception1`.`job_card_number`), '') /* Job Card Number: */" => "Job Card Number:",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`), '') /* Registration Number: */" => "Registration Number:",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS('',   `gmt_fleet_register1`.`engine_number`), '') /* Engine Number: */" => "Engine Number:",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`) || CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS('',   `gmt_fleet_register1`.`model_of_vehicle`, '   |    and     |     ', `dealer1`.`make_of_vehicle`, '   '), '') /* Make of Vehicle: */" => "Make of Vehicle:",
		"`costing`.`reconciliation_of_total_costs_by_costing_officer`" => "Reconciliation of Total Cost By Costing Officer:",
		"`costing`.`costing_officer_name_and_surname`" => "Costing Officer Name & Surname:",
		"`costing`.`costing_officer_contact_details`" => "Costing Officer Contact Details:",
		"`costing`.`costing_officer_email_address`" => "Costing Officer Email Address:",
		"`costing`.`material_cost`" => "Material Cost (R):",
		"`costing`.`spares_orders_quotation`" => "Spare Orders Quotation (R):",
		"`costing`.`spares_orders_quotation_upload`" => "Spare Orders Quotation Upload:",
		"`costing`.`standard_labour_cost_per_hour`" => "Standard Labour Cost per Hour:",
		"`costing`.`labour_quotation`" => "Labour Quotation (R):",
		"`costing`.`labour_quotation_upload`" => "Labour Quotation Upload:",
		"`costing`.`vat`" => "Vat 15 % (R):",
		"`costing`.`total_amount`" => "Total Amount (R):",
		"`costing`.`workshop_manager_name_and_surname`" => "Workshop Manager Name & Surname:",
		"`costing`.`workshop_manager_contact_details`" => "Workshop Manager Contact Details:",
		"`costing`.`workshop_manager_email_address`" => "Workshop Manager Email Address:",
		"`costing`.`invoice_approved`" => "Internal Requisition to Stores Approved:",
		"`costing`.`invoice_date`" => "Invoice Date:",
		"`costing`.`upload_invoice`" => "Invoice Upload:",
	];

	// Fields that can be quick searched
	$x->QueryFieldsQS = [
		"`costing`.`costing_id`" => "costing_id",
		"IF(    CHAR_LENGTH(`districts1`.`station`) || CHAR_LENGTH(`districts1`.`district`), CONCAT_WS('',   `districts1`.`station`, '    |    and    |      ', `districts1`.`district`), '') /* Government Garage Name: */" => "government_garage_name",
		"`costing`.`supervisor_name_and_surname`" => "supervisor_name_and_surname",
		"`costing`.`supervisor_contact_details`" => "supervisor_contact_details",
		"`costing`.`supervisor_email_address`" => "supervisor_email_address",
		"IF(    CHAR_LENGTH(`reception1`.`job_card_number`), CONCAT_WS('',   `reception1`.`job_card_number`), '') /* Job Card Number: */" => "job_card_number",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`), '') /* Registration Number: */" => "vehicle_registration_number",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS('',   `gmt_fleet_register1`.`engine_number`), '') /* Engine Number: */" => "engine_number",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`) || CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS('',   `gmt_fleet_register1`.`model_of_vehicle`, '   |    and     |     ', `dealer1`.`make_of_vehicle`, '   '), '') /* Make of Vehicle: */" => "make_of_vehicle",
		"`costing`.`reconciliation_of_total_costs_by_costing_officer`" => "reconciliation_of_total_costs_by_costing_officer",
		"`costing`.`costing_officer_name_and_surname`" => "costing_officer_name_and_surname",
		"`costing`.`costing_officer_contact_details`" => "costing_officer_contact_details",
		"`costing`.`costing_officer_email_address`" => "costing_officer_email_address",
		"`costing`.`material_cost`" => "material_cost",
		"`costing`.`spares_orders_quotation`" => "spares_orders_quotation",
		"`costing`.`spares_orders_quotation_upload`" => "spares_orders_quotation_upload",
		"`costing`.`standard_labour_cost_per_hour`" => "standard_labour_cost_per_hour",
		"`costing`.`labour_quotation`" => "labour_quotation",
		"`costing`.`labour_quotation_upload`" => "labour_quotation_upload",
		"`costing`.`vat`" => "vat",
		"`costing`.`total_amount`" => "total_amount",
		"`costing`.`workshop_manager_name_and_surname`" => "workshop_manager_name_and_surname",
		"`costing`.`workshop_manager_contact_details`" => "workshop_manager_contact_details",
		"`costing`.`workshop_manager_email_address`" => "workshop_manager_email_address",
		"`costing`.`invoice_approved`" => "invoice_approved",
		"if(`costing`.`invoice_date`,date_format(`costing`.`invoice_date`,'%d/%m/%Y'),'')" => "invoice_date",
		"`costing`.`upload_invoice`" => "upload_invoice",
	];

	// Lookup fields that can be used as filterers
	$x->filterers = ['government_garage_name' => 'Government Garage Name:', 'job_card_number' => 'Job Card Number:', 'vehicle_registration_number' => 'Registration Number:', ];

	$x->QueryFrom = "`costing` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`costing`.`government_garage_name` LEFT JOIN `reception` as reception1 ON `reception1`.`reception_user_id`=`costing`.`job_card_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`costing`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` ";
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
	$x->ScriptFileName = 'costing_view.php';
	$x->RedirectAfterInsert = 'costing_view.php?SelectedID=#ID#';
	$x->TableTitle = 'Costing:';
	$x->TableIcon = 'resources/table_icons/Tachometer.png';
	$x->PrimaryKey = '`costing`.`costing_id`';

	$x->ColWidth = [150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 80, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, ];
	$x->ColCaption = ['Costing ID:', 'Government Garage Name:', 'Supervisor Name & Surname:', 'Supervisor Contact Details:', 'Supervisor Email Address:', 'Supervisor Signature:', 'Job Card Number:', 'Registration Number:', 'Engine Number:', 'Make of Vehicle:', 'Reconciliation of Total Cost By Costing Officer:', 'Costing Officer Name & Surname:', 'Costing Officer Contact Details:', 'Costing Officer Email Address:', 'Costing Officer Signature:', 'Material Cost (R):', 'Spare Orders Quotation (R):', 'Spare Orders Quotation Upload:', 'Standard Labour Cost per Hour:', 'Labour Quotation (R):', 'Labour Quotation Upload:', 'Vat 15 % (R):', 'Total Amount (R):', 'Workshop Manager Name & Surname:', 'Workshop Manager Contact Details:', 'Workshop Manager Email Address:', 'Workshop Manager Signature:', 'Internal Requisition to Stores Approved:', 'Invoice Date:', 'Invoice Upload:', ];
	$x->ColFieldName = ['costing_id', 'government_garage_name', 'supervisor_name_and_surname', 'supervisor_contact_details', 'supervisor_email_address', 'supervisor_signature', 'job_card_number', 'vehicle_registration_number', 'engine_number', 'make_of_vehicle', 'reconciliation_of_total_costs_by_costing_officer', 'costing_officer_name_and_surname', 'costing_officer_contact_details', 'costing_officer_email_address', 'costing_officer_signature', 'material_cost', 'spares_orders_quotation', 'spares_orders_quotation_upload', 'standard_labour_cost_per_hour', 'labour_quotation', 'labour_quotation_upload', 'vat', 'total_amount', 'workshop_manager_name_and_surname', 'workshop_manager_contact_details', 'workshop_manager_email_address', 'workshop_manager_signature', 'invoice_approved', 'invoice_date', 'upload_invoice', ];
	$x->ColNumber  = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, ];

	// template paths below are based on the app main directory
	$x->Template = 'templates/costing_templateTV.html';
	$x->SelectedTemplate = 'templates/costing_templateTVS.html';
	$x->TemplateDV = 'templates/costing_templateDV.html';
	$x->TemplateDVP = 'templates/costing_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HasCalculatedFields = false;
	$x->AllowConsoleLog = false;
	$x->AllowDVNavigation = true;

	// hook: costing_init
	$render = true;
	if(function_exists('costing_init')) {
		$args = [];
		$render = costing_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// column sums
	if(strpos($x->HTML, '<!-- tv data below -->')) {
		// if printing multi-selection TV, calculate the sum only for the selected records
		$record_selector = Request::val('record_selector');
		if(Request::val('Print_x') && is_array($record_selector)) {
			$QueryWhere = '';
			foreach($record_selector as $id) {   // get selected records
				if($id != '') $QueryWhere .= "'" . makeSafe($id) . "',";
			}
			if($QueryWhere != '') {
				$QueryWhere = 'where `costing`.`costing_id` in ('.substr($QueryWhere, 0, -1).')';
			} else { // if no selected records, write the where clause to return an empty result
				$QueryWhere = 'where 1=0';
			}
		} else {
			$QueryWhere = $x->QueryWhere;
		}

		$sumQuery = "SELECT SUM(`costing`.`total_amount`) FROM {$x->QueryFrom} {$QueryWhere}";
		$res = sql($sumQuery, $eo);
		if($row = db_fetch_row($res)) {
			$sumRow = '<tr class="success sum">';
			if(!Request::val('Print_x')) $sumRow .= '<th class="text-center sum">&sum;</th>';
			$sumRow .= '<td class="costing-costing_id sum"></td>';
			$sumRow .= '<td class="costing-government_garage_name sum"></td>';
			$sumRow .= '<td class="costing-supervisor_name_and_surname sum"></td>';
			$sumRow .= '<td class="costing-supervisor_contact_details sum"></td>';
			$sumRow .= '<td class="costing-supervisor_email_address sum"></td>';
			$sumRow .= '<td class="costing-supervisor_signature sum"></td>';
			$sumRow .= '<td class="costing-job_card_number sum"></td>';
			$sumRow .= '<td class="costing-vehicle_registration_number sum"></td>';
			$sumRow .= '<td class="costing-engine_number sum"></td>';
			$sumRow .= '<td class="costing-make_of_vehicle sum"></td>';
			$sumRow .= '<td class="costing-reconciliation_of_total_costs_by_costing_officer sum"></td>';
			$sumRow .= '<td class="costing-costing_officer_name_and_surname sum"></td>';
			$sumRow .= '<td class="costing-costing_officer_contact_details sum"></td>';
			$sumRow .= '<td class="costing-costing_officer_email_address sum"></td>';
			$sumRow .= '<td class="costing-costing_officer_signature sum"></td>';
			$sumRow .= '<td class="costing-material_cost sum"></td>';
			$sumRow .= '<td class="costing-spares_orders_quotation sum"></td>';
			$sumRow .= '<td class="costing-spares_orders_quotation_upload sum"></td>';
			$sumRow .= '<td class="costing-standard_labour_cost_per_hour sum"></td>';
			$sumRow .= '<td class="costing-labour_quotation sum"></td>';
			$sumRow .= '<td class="costing-labour_quotation_upload sum"></td>';
			$sumRow .= '<td class="costing-vat sum"></td>';
			$sumRow .= "<td class=\"costing-total_amount text-right sum locale-float\">{$row[0]}</td>";
			$sumRow .= '<td class="costing-workshop_manager_name_and_surname sum"></td>';
			$sumRow .= '<td class="costing-workshop_manager_contact_details sum"></td>';
			$sumRow .= '<td class="costing-workshop_manager_email_address sum"></td>';
			$sumRow .= '<td class="costing-workshop_manager_signature sum"></td>';
			$sumRow .= '<td class="costing-invoice_approved sum"></td>';
			$sumRow .= '<td class="costing-invoice_date sum"></td>';
			$sumRow .= '<td class="costing-upload_invoice sum"></td>';
			$sumRow .= '</tr>';

			$x->HTML = str_replace('<!-- tv data below -->', '', $x->HTML);
			$x->HTML = str_replace('<!-- tv data above -->', $sumRow, $x->HTML);
		}
	}

	// hook: costing_header
	$headerCode = '';
	if(function_exists('costing_header')) {
		$args = [];
		$headerCode = costing_header($x->ContentType, getMemberInfo(), $args);
	}

	if(!$headerCode) {
		include_once(__DIR__ . '/header.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/header.php');
		echo str_replace('<%%HEADER%%>', ob_get_clean(), $headerCode);
	}

	echo $x->HTML;

	// hook: costing_footer
	$footerCode = '';
	if(function_exists('costing_footer')) {
		$args = [];
		$footerCode = costing_footer($x->ContentType, getMemberInfo(), $args);
	}

	if(!$footerCode) {
		include_once(__DIR__ . '/footer.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/footer.php');
		echo str_replace('<%%FOOTER%%>', ob_get_clean(), $footerCode);
	}