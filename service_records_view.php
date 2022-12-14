<?php
// This script and data application were generated by AppGini 22.13
// Download AppGini for free from https://bigprof.com/appgini/download/

	include_once(__DIR__ . '/lib.php');
	@include_once(__DIR__ . '/hooks/service_records.php');
	include_once(__DIR__ . '/service_records_dml.php');

	// mm: can the current member access this page?
	$perm = getTablePermissions('service_records');
	if(!$perm['access']) {
		echo error_message($Translation['tableAccessDenied']);
		exit;
	}

	$x = new DataList;
	$x->TableName = 'service_records';

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = [
		"`service_records`.`records_id`" => "records_id",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`) || CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`, '  |     and     |     ', `gmt_fleet_register1`.`engine_number`), '') /* Vehicle & Engine Number: */" => "vehicle",
		"`service_records`.`image_1`" => "image_1",
		"`service_records`.`image_2`" => "image_2",
		"`service_records`.`image_3`" => "image_3",
		"`service_records`.`image_4`" => "image_4",
		"`service_records`.`image_5`" => "image_5",
		"`service_records`.`document_1`" => "document_1",
		"`service_records`.`document_2`" => "document_2",
		"`service_records`.`document_3`" => "document_3",
		"`service_records`.`document_4`" => "document_4",
		"`service_records`.`document_5`" => "document_5",
		"`service_records`.`description`" => "description",
	];
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = [
		1 => '`service_records`.`records_id`',
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
	];

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = [
		"`service_records`.`records_id`" => "records_id",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`) || CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`, '  |     and     |     ', `gmt_fleet_register1`.`engine_number`), '') /* Vehicle & Engine Number: */" => "vehicle",
		"`service_records`.`image_1`" => "image_1",
		"`service_records`.`image_2`" => "image_2",
		"`service_records`.`image_3`" => "image_3",
		"`service_records`.`image_4`" => "image_4",
		"`service_records`.`image_5`" => "image_5",
		"`service_records`.`document_1`" => "document_1",
		"`service_records`.`document_2`" => "document_2",
		"`service_records`.`document_3`" => "document_3",
		"`service_records`.`document_4`" => "document_4",
		"`service_records`.`document_5`" => "document_5",
		"`service_records`.`description`" => "description",
	];
	// Fields that can be filtered
	$x->QueryFieldsFilters = [
		"`service_records`.`records_id`" => "Records ID:",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`) || CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`, '  |     and     |     ', `gmt_fleet_register1`.`engine_number`), '') /* Vehicle & Engine Number: */" => "Vehicle & Engine Number:",
		"`service_records`.`document_1`" => "Document 1:",
		"`service_records`.`document_2`" => "Document 2:",
		"`service_records`.`document_3`" => "Document 3:",
		"`service_records`.`document_4`" => "Document 4:",
		"`service_records`.`document_5`" => "Document 5:",
		"`service_records`.`description`" => "Description:",
	];

	// Fields that can be quick searched
	$x->QueryFieldsQS = [
		"`service_records`.`records_id`" => "records_id",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`) || CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`, '  |     and     |     ', `gmt_fleet_register1`.`engine_number`), '') /* Vehicle & Engine Number: */" => "vehicle",
		"`service_records`.`document_1`" => "document_1",
		"`service_records`.`document_2`" => "document_2",
		"`service_records`.`document_3`" => "document_3",
		"`service_records`.`document_4`" => "document_4",
		"`service_records`.`document_5`" => "document_5",
		"`service_records`.`description`" => "description",
	];

	// Lookup fields that can be used as filterers
	$x->filterers = ['vehicle' => 'Vehicle & Engine Number:', ];

	$x->QueryFrom = "`service_records` LEFT JOIN `service` as service1 ON `service1`.`service_id`=`service_records`.`vehicle` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`service1`.`vehicle_registration_number` ";
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
	$x->ScriptFileName = 'service_records_view.php';
	$x->RedirectAfterInsert = 'service_records_view.php?SelectedID=#ID#';
	$x->TableTitle = 'Service Records:';
	$x->TableIcon = 'resources/table_icons/servicelist.png';
	$x->PrimaryKey = '`service_records`.`records_id`';

	$x->ColWidth = [150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, ];
	$x->ColCaption = ['Records ID:', 'Vehicle & Engine Number:', 'Image 1', 'Image 2', 'Image 3', 'Image 4', 'Image 5', 'Document 1:', 'Document 2:', 'Document 3:', 'Document 4:', 'Document 5:', 'Description:', ];
	$x->ColFieldName = ['records_id', 'vehicle', 'image_1', 'image_2', 'image_3', 'image_4', 'image_5', 'document_1', 'document_2', 'document_3', 'document_4', 'document_5', 'description', ];
	$x->ColNumber  = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, ];

	// template paths below are based on the app main directory
	$x->Template = 'templates/service_records_templateTV.html';
	$x->SelectedTemplate = 'templates/service_records_templateTVS.html';
	$x->TemplateDV = 'templates/service_records_templateDV.html';
	$x->TemplateDVP = 'templates/service_records_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HasCalculatedFields = false;
	$x->AllowConsoleLog = false;
	$x->AllowDVNavigation = true;

	// hook: service_records_init
	$render = true;
	if(function_exists('service_records_init')) {
		$args = [];
		$render = service_records_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: service_records_header
	$headerCode = '';
	if(function_exists('service_records_header')) {
		$args = [];
		$headerCode = service_records_header($x->ContentType, getMemberInfo(), $args);
	}

	if(!$headerCode) {
		include_once(__DIR__ . '/header.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/header.php');
		echo str_replace('<%%HEADER%%>', ob_get_clean(), $headerCode);
	}

	echo $x->HTML;

	// hook: service_records_footer
	$footerCode = '';
	if(function_exists('service_records_footer')) {
		$args = [];
		$footerCode = service_records_footer($x->ContentType, getMemberInfo(), $args);
	}

	if(!$footerCode) {
		include_once(__DIR__ . '/footer.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/footer.php');
		echo str_replace('<%%FOOTER%%>', ob_get_clean(), $footerCode);
	}
