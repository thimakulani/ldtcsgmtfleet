<?php
// This script and data application were generated by AppGini 22.13
// Download AppGini for free from https://bigprof.com/appgini/download/

	include_once(__DIR__ . '/lib.php');
	@include_once(__DIR__ . '/hooks/fuel_type.php');
	include_once(__DIR__ . '/fuel_type_dml.php');

	// mm: can the current member access this page?
	$perm = getTablePermissions('fuel_type');
	if(!$perm['access']) {
		echo error_message($Translation['tableAccessDenied']);
		exit;
	}

	$x = new DataList;
	$x->TableName = 'fuel_type';

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = [
		"`fuel_type`.`fuel_type_id`" => "fuel_type_id",
		"`fuel_type`.`fuel_type`" => "fuel_type",
	];
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = [
		1 => '`fuel_type`.`fuel_type_id`',
		2 => 2,
	];

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = [
		"`fuel_type`.`fuel_type_id`" => "fuel_type_id",
		"`fuel_type`.`fuel_type`" => "fuel_type",
	];
	// Fields that can be filtered
	$x->QueryFieldsFilters = [
		"`fuel_type`.`fuel_type_id`" => "Fuel Type ID:",
		"`fuel_type`.`fuel_type`" => "Fuel Type:",
	];

	// Fields that can be quick searched
	$x->QueryFieldsQS = [
		"`fuel_type`.`fuel_type_id`" => "fuel_type_id",
		"`fuel_type`.`fuel_type`" => "fuel_type",
	];

	// Lookup fields that can be used as filterers
	$x->filterers = [];

	$x->QueryFrom = "`fuel_type` ";
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
	$x->RecordsPerPage = 10;
	$x->QuickSearch = 1;
	$x->QuickSearchText = $Translation['quick search'];
	$x->ScriptFileName = 'fuel_type_view.php';
	$x->RedirectAfterInsert = 'fuel_type_view.php?SelectedID=#ID#';
	$x->TableTitle = 'Fuel Type:';
	$x->TableIcon = 'resources/table_icons/fuels.png';
	$x->PrimaryKey = '`fuel_type`.`fuel_type_id`';

	$x->ColWidth = [150, 150, ];
	$x->ColCaption = ['Fuel Type ID:', 'Fuel Type:', ];
	$x->ColFieldName = ['fuel_type_id', 'fuel_type', ];
	$x->ColNumber  = [1, 2, ];

	// template paths below are based on the app main directory
	$x->Template = 'templates/fuel_type_templateTV.html';
	$x->SelectedTemplate = 'templates/fuel_type_templateTVS.html';
	$x->TemplateDV = 'templates/fuel_type_templateDV.html';
	$x->TemplateDVP = 'templates/fuel_type_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HasCalculatedFields = false;
	$x->AllowConsoleLog = false;
	$x->AllowDVNavigation = true;

	// hook: fuel_type_init
	$render = true;
	if(function_exists('fuel_type_init')) {
		$args = [];
		$render = fuel_type_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: fuel_type_header
	$headerCode = '';
	if(function_exists('fuel_type_header')) {
		$args = [];
		$headerCode = fuel_type_header($x->ContentType, getMemberInfo(), $args);
	}

	if(!$headerCode) {
		include_once(__DIR__ . '/header.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/header.php');
		echo str_replace('<%%HEADER%%>', ob_get_clean(), $headerCode);
	}

	echo $x->HTML;

	// hook: fuel_type_footer
	$footerCode = '';
	if(function_exists('fuel_type_footer')) {
		$args = [];
		$footerCode = fuel_type_footer($x->ContentType, getMemberInfo(), $args);
	}

	if(!$footerCode) {
		include_once(__DIR__ . '/footer.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/footer.php');
		echo str_replace('<%%FOOTER%%>', ob_get_clean(), $footerCode);
	}
