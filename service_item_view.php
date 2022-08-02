<?php
// This script and data application were generated by AppGini 22.13
// Download AppGini for free from https://bigprof.com/appgini/download/

	include_once(__DIR__ . '/lib.php');
	@include_once(__DIR__ . '/hooks/service_item.php');
	include_once(__DIR__ . '/service_item_dml.php');

	// mm: can the current member access this page?
	$perm = getTablePermissions('service_item');
	if(!$perm['access']) {
		echo error_message($Translation['tableAccessDenied']);
		exit;
	}

	$x = new DataList;
	$x->TableName = 'service_item';

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = [
		"`service_item`.`service_item_id`" => "service_item_id",
		"`service_item`.`service_item`" => "service_item",
	];
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = [
		1 => '`service_item`.`service_item_id`',
		2 => 2,
	];

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = [
		"`service_item`.`service_item_id`" => "service_item_id",
		"`service_item`.`service_item`" => "service_item",
	];
	// Fields that can be filtered
	$x->QueryFieldsFilters = [
		"`service_item`.`service_item_id`" => "Service Item ID:",
		"`service_item`.`service_item`" => "Service Item:",
	];

	// Fields that can be quick searched
	$x->QueryFieldsQS = [
		"`service_item`.`service_item_id`" => "service_item_id",
		"`service_item`.`service_item`" => "service_item",
	];

	// Lookup fields that can be used as filterers
	$x->filterers = [];

	$x->QueryFrom = "`service_item` ";
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
	$x->ScriptFileName = 'service_item_view.php';
	$x->RedirectAfterInsert = 'service_item_view.php?SelectedID=#ID#';
	$x->TableTitle = 'Service Item:';
	$x->TableIcon = 'resources/table_icons/gaming_steering.png';
	$x->PrimaryKey = '`service_item`.`service_item_id`';

	$x->ColWidth = [150, 150, ];
	$x->ColCaption = ['Service Item ID:', 'Service Item:', ];
	$x->ColFieldName = ['service_item_id', 'service_item', ];
	$x->ColNumber  = [1, 2, ];

	// template paths below are based on the app main directory
	$x->Template = 'templates/service_item_templateTV.html';
	$x->SelectedTemplate = 'templates/service_item_templateTVS.html';
	$x->TemplateDV = 'templates/service_item_templateDV.html';
	$x->TemplateDVP = 'templates/service_item_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HasCalculatedFields = false;
	$x->AllowConsoleLog = false;
	$x->AllowDVNavigation = true;

	// hook: service_item_init
	$render = true;
	if(function_exists('service_item_init')) {
		$args = [];
		$render = service_item_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: service_item_header
	$headerCode = '';
	if(function_exists('service_item_header')) {
		$args = [];
		$headerCode = service_item_header($x->ContentType, getMemberInfo(), $args);
	}

	if(!$headerCode) {
		include_once(__DIR__ . '/header.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/header.php');
		echo str_replace('<%%HEADER%%>', ob_get_clean(), $headerCode);
	}

	echo $x->HTML;

	// hook: service_item_footer
	$footerCode = '';
	if(function_exists('service_item_footer')) {
		$args = [];
		$footerCode = service_item_footer($x->ContentType, getMemberInfo(), $args);
	}

	if(!$footerCode) {
		include_once(__DIR__ . '/footer.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/footer.php');
		echo str_replace('<%%FOOTER%%>', ob_get_clean(), $footerCode);
	}
