<?php
// This script and data application were generated by AppGini 22.13
// Download AppGini for free from https://bigprof.com/appgini/download/

	include_once(__DIR__ . '/lib.php');
	@include_once(__DIR__ . '/hooks/vehicle_history.php');
	include_once(__DIR__ . '/vehicle_history_dml.php');

	// mm: can the current member access this page?
	$perm = getTablePermissions('vehicle_history');
	if(!$perm['access']) {
		echo error_message($Translation['tableAccessDenied']);
		exit;
	}

	$x = new DataList;
	$x->TableName = 'vehicle_history';

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = [
		"`vehicle_history`.`history_id`" => "history_id",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`, '  '), '') /* Registration Number: */" => "vehicle_registration_number",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS('',   `gmt_fleet_register1`.`engine_number`, ' '), '') /* Engine Number: */" => "engine_number",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`purchase_price`), CONCAT_WS('',   `gmt_fleet_register1`.`purchase_price`, ' '), '') /* Purchase Price (R): */" => "purchased_price",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`) || CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`, '   |  and  |   ', `gmt_fleet_register1`.`engine_number`), '') /* Old Registration Number: */" => "old_registration_number",
		"`vehicle_history`.`new_vehicle_registration_number`" => "new_vehicle_registration_number",
		"if(`vehicle_history`.`date_of_vehicle_transfer`,date_format(`vehicle_history`.`date_of_vehicle_transfer`,'%d/%m/%Y'),'')" => "date_of_vehicle_transfer",
		"`vehicle_history`.`comments`" => "comments",
		"IF(    CHAR_LENGTH(if(`gmt_fleet_register1`.`renewal_of_license`,date_format(`gmt_fleet_register1`.`renewal_of_license`,'%d/%m/%Y'),'')), CONCAT_WS('',   if(`gmt_fleet_register1`.`renewal_of_license`,date_format(`gmt_fleet_register1`.`renewal_of_license`,'%d/%m/%Y'),'')), '') /* Renewal Of License: */" => "renewal_of_license",
		"IF(    CHAR_LENGTH(if(`schedule1`.`date`,date_format(`schedule1`.`date`,'%d/%m/%Y'),'')), CONCAT_WS('',   if(`schedule1`.`date`,date_format(`schedule1`.`date`,'%d/%m/%Y'),'')), '') /* Date of Service: */" => "date_of_service",
		"IF(    CHAR_LENGTH(if(`service1`.`date_of_next_service`,date_format(`service1`.`date_of_next_service`,'%d/%m/%Y'),'')), CONCAT_WS('',   if(`service1`.`date_of_next_service`,date_format(`service1`.`date_of_next_service`,'%d/%m/%Y'),'')), '') /* Date of Next Service: */" => "date_of_next_service",
		"IF(    CHAR_LENGTH(`purchase_orders1`.`purchased_order_number`), CONCAT_WS('',   `purchase_orders1`.`purchased_order_number`), '') /* Purchased Order Number: */" => "purchased_order_number",
		"IF(    CHAR_LENGTH(`claim1`.`claim_code`), CONCAT_WS('',   `claim1`.`claim_code`), '') /* Claims Code: */" => "claim_code",
		"if(CHAR_LENGTH(IF(    CHAR_LENGTH(`tyre_log_sheet1`.`tyre_inspection_report`), CONCAT_WS('',   `tyre_log_sheet1`.`tyre_inspection_report`), '')), concat('<a href=\"" . getUploadDir('') . "',IF(    CHAR_LENGTH(`tyre_log_sheet1`.`tyre_inspection_report`), CONCAT_WS('',   `tyre_log_sheet1`.`tyre_inspection_report`), ''),'\" target=\"_nWindow\">',IF(    CHAR_LENGTH(`tyre_log_sheet1`.`tyre_inspection_report`), CONCAT_WS('',   `tyre_log_sheet1`.`tyre_inspection_report`), ''),'</a>'), '')" => "tyre_inspection_report",
		"IF(    CHAR_LENGTH(`vehicle_daily_check_list1`.`inspection_certification_number`), CONCAT_WS('',   `vehicle_daily_check_list1`.`inspection_certification_number`), '') /* Inspection Certification No: */" => "inspection_certification_number",
		"if(CHAR_LENGTH(IF(    CHAR_LENGTH(`vehicle_daily_check_list2`.`document_checklist_report`), CONCAT_WS('',   `vehicle_daily_check_list2`.`document_checklist_report`), '')), concat('<a href=\"" . getUploadDir('') . "',IF(    CHAR_LENGTH(`vehicle_daily_check_list2`.`document_checklist_report`), CONCAT_WS('',   `vehicle_daily_check_list2`.`document_checklist_report`), ''),'\" target=\"_nWindow\">',IF(    CHAR_LENGTH(`vehicle_daily_check_list2`.`document_checklist_report`), CONCAT_WS('',   `vehicle_daily_check_list2`.`document_checklist_report`), ''),'</a>'), '')" => "document_checklist_report",
		"IF(    CHAR_LENGTH(if(`vehicle_daily_check_list3`.`next_inspection_date`,date_format(`vehicle_daily_check_list3`.`next_inspection_date`,'%d/%m/%Y'),'')), CONCAT_WS('',   if(`vehicle_daily_check_list3`.`next_inspection_date`,date_format(`vehicle_daily_check_list3`.`next_inspection_date`,'%d/%m/%Y'),'')), '') /* Next Inspection Date: */" => "next_inspection_date",
		"`vehicle_history`.`breakdown_of_vehicle`" => "breakdown_of_vehicle",
		"DATE_FORMAT(`vehicle_history`.`date_of_vehicle_breakdown`, '%D %b %Y %l:%i%p')" => "date_of_vehicle_breakdown",
		"`vehicle_history`.`description_of_vehicle_breakdown`" => "description_of_vehicle_breakdown",
		"IF(    CHAR_LENGTH(`log_sheet1`.`closing_km`), CONCAT_WS('',   `log_sheet1`.`closing_km`), '') /* Closing KM: */" => "closing_km",
		"if(`vehicle_history`.`date_of_vehicle_reactivation`,date_format(`vehicle_history`.`date_of_vehicle_reactivation`,'%d/%m/%Y %H:%i'),'')" => "date_of_vehicle_reactivation",
		"IF(    CHAR_LENGTH(`breakdown_services1`.`total_amount`), CONCAT_WS('',   `breakdown_services1`.`total_amount`), '') /* Total Repairing Cost (R): */" => "total_cost",
	];
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = [
		1 => '`vehicle_history`.`history_id`',
		2 => 2,
		3 => 3,
		4 => 4,
		5 => 5,
		6 => 6,
		7 => '`vehicle_history`.`date_of_vehicle_transfer`',
		8 => 8,
		9 => 'date_format(`gmt_fleet_register1`.`renewal_of_license`,\'%d/%m/%Y\')',
		10 => 10,
		11 => 'date_format(`service1`.`date_of_next_service`,\'%d/%m/%Y\')',
		12 => '`purchase_orders1`.`purchased_order_number`',
		13 => '`claim1`.`claim_code`',
		14 => '`tyre_log_sheet1`.`tyre_inspection_report`',
		15 => '`vehicle_daily_check_list1`.`inspection_certification_number`',
		16 => '`vehicle_daily_check_list2`.`document_checklist_report`',
		17 => 'date_format(`vehicle_daily_check_list3`.`next_inspection_date`,\'%d/%m/%Y\')',
		18 => 18,
		19 => '`vehicle_history`.`date_of_vehicle_breakdown`',
		20 => 20,
		21 => '`log_sheet1`.`closing_km`',
		22 => '`vehicle_history`.`date_of_vehicle_reactivation`',
		23 => '`breakdown_services1`.`total_amount`',
	];

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = [
		"`vehicle_history`.`history_id`" => "history_id",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`, '  '), '') /* Registration Number: */" => "vehicle_registration_number",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS('',   `gmt_fleet_register1`.`engine_number`, ' '), '') /* Engine Number: */" => "engine_number",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`purchase_price`), CONCAT_WS('',   `gmt_fleet_register1`.`purchase_price`, ' '), '') /* Purchase Price (R): */" => "purchased_price",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`) || CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`, '   |  and  |   ', `gmt_fleet_register1`.`engine_number`), '') /* Old Registration Number: */" => "old_registration_number",
		"`vehicle_history`.`new_vehicle_registration_number`" => "new_vehicle_registration_number",
		"if(`vehicle_history`.`date_of_vehicle_transfer`,date_format(`vehicle_history`.`date_of_vehicle_transfer`,'%d/%m/%Y'),'')" => "date_of_vehicle_transfer",
		"`vehicle_history`.`comments`" => "comments",
		"IF(    CHAR_LENGTH(if(`gmt_fleet_register1`.`renewal_of_license`,date_format(`gmt_fleet_register1`.`renewal_of_license`,'%d/%m/%Y'),'')), CONCAT_WS('',   if(`gmt_fleet_register1`.`renewal_of_license`,date_format(`gmt_fleet_register1`.`renewal_of_license`,'%d/%m/%Y'),'')), '') /* Renewal Of License: */" => "renewal_of_license",
		"IF(    CHAR_LENGTH(if(`schedule1`.`date`,date_format(`schedule1`.`date`,'%d/%m/%Y'),'')), CONCAT_WS('',   if(`schedule1`.`date`,date_format(`schedule1`.`date`,'%d/%m/%Y'),'')), '') /* Date of Service: */" => "date_of_service",
		"IF(    CHAR_LENGTH(if(`service1`.`date_of_next_service`,date_format(`service1`.`date_of_next_service`,'%d/%m/%Y'),'')), CONCAT_WS('',   if(`service1`.`date_of_next_service`,date_format(`service1`.`date_of_next_service`,'%d/%m/%Y'),'')), '') /* Date of Next Service: */" => "date_of_next_service",
		"IF(    CHAR_LENGTH(`purchase_orders1`.`purchased_order_number`), CONCAT_WS('',   `purchase_orders1`.`purchased_order_number`), '') /* Purchased Order Number: */" => "purchased_order_number",
		"IF(    CHAR_LENGTH(`claim1`.`claim_code`), CONCAT_WS('',   `claim1`.`claim_code`), '') /* Claims Code: */" => "claim_code",
		"if(CHAR_LENGTH(IF(    CHAR_LENGTH(`tyre_log_sheet1`.`tyre_inspection_report`), CONCAT_WS('',   `tyre_log_sheet1`.`tyre_inspection_report`), '')), concat('" . getUploadDir('') . "', IF(    CHAR_LENGTH(`tyre_log_sheet1`.`tyre_inspection_report`), CONCAT_WS('',   `tyre_log_sheet1`.`tyre_inspection_report`), '')), '')" => "tyre_inspection_report",
		"IF(    CHAR_LENGTH(`vehicle_daily_check_list1`.`inspection_certification_number`), CONCAT_WS('',   `vehicle_daily_check_list1`.`inspection_certification_number`), '') /* Inspection Certification No: */" => "inspection_certification_number",
		"if(CHAR_LENGTH(IF(    CHAR_LENGTH(`vehicle_daily_check_list2`.`document_checklist_report`), CONCAT_WS('',   `vehicle_daily_check_list2`.`document_checklist_report`), '')), concat('" . getUploadDir('') . "', IF(    CHAR_LENGTH(`vehicle_daily_check_list2`.`document_checklist_report`), CONCAT_WS('',   `vehicle_daily_check_list2`.`document_checklist_report`), '')), '')" => "document_checklist_report",
		"IF(    CHAR_LENGTH(if(`vehicle_daily_check_list3`.`next_inspection_date`,date_format(`vehicle_daily_check_list3`.`next_inspection_date`,'%d/%m/%Y'),'')), CONCAT_WS('',   if(`vehicle_daily_check_list3`.`next_inspection_date`,date_format(`vehicle_daily_check_list3`.`next_inspection_date`,'%d/%m/%Y'),'')), '') /* Next Inspection Date: */" => "next_inspection_date",
		"`vehicle_history`.`breakdown_of_vehicle`" => "breakdown_of_vehicle",
		"DATE_FORMAT(`vehicle_history`.`date_of_vehicle_breakdown`, '%D %b %Y %l:%i%p')" => "date_of_vehicle_breakdown",
		"`vehicle_history`.`description_of_vehicle_breakdown`" => "description_of_vehicle_breakdown",
		"IF(    CHAR_LENGTH(`log_sheet1`.`closing_km`), CONCAT_WS('',   `log_sheet1`.`closing_km`), '') /* Closing KM: */" => "closing_km",
		"if(`vehicle_history`.`date_of_vehicle_reactivation`,date_format(`vehicle_history`.`date_of_vehicle_reactivation`,'%d/%m/%Y %H:%i'),'')" => "date_of_vehicle_reactivation",
		"IF(    CHAR_LENGTH(`breakdown_services1`.`total_amount`), CONCAT_WS('',   `breakdown_services1`.`total_amount`), '') /* Total Repairing Cost (R): */" => "total_cost",
	];
	// Fields that can be filtered
	$x->QueryFieldsFilters = [
		"`vehicle_history`.`history_id`" => "History ID:",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`, '  '), '') /* Registration Number: */" => "Registration Number:",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS('',   `gmt_fleet_register1`.`engine_number`, ' '), '') /* Engine Number: */" => "Engine Number:",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`purchase_price`), CONCAT_WS('',   `gmt_fleet_register1`.`purchase_price`, ' '), '') /* Purchase Price (R): */" => "Purchase Price (R):",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`) || CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`, '   |  and  |   ', `gmt_fleet_register1`.`engine_number`), '') /* Old Registration Number: */" => "Old Registration Number:",
		"`vehicle_history`.`new_vehicle_registration_number`" => "New Vehicle Registration Number:",
		"`vehicle_history`.`date_of_vehicle_transfer`" => "Date of  Vehicle Transfer:",
		"`vehicle_history`.`comments`" => "Comments:",
		"IF(    CHAR_LENGTH(if(`gmt_fleet_register1`.`renewal_of_license`,date_format(`gmt_fleet_register1`.`renewal_of_license`,'%d/%m/%Y'),'')), CONCAT_WS('',   if(`gmt_fleet_register1`.`renewal_of_license`,date_format(`gmt_fleet_register1`.`renewal_of_license`,'%d/%m/%Y'),'')), '') /* Renewal Of License: */" => "Renewal Of License:",
		"IF(    CHAR_LENGTH(if(`schedule1`.`date`,date_format(`schedule1`.`date`,'%d/%m/%Y'),'')), CONCAT_WS('',   if(`schedule1`.`date`,date_format(`schedule1`.`date`,'%d/%m/%Y'),'')), '') /* Date of Service: */" => "Date of Service:",
		"IF(    CHAR_LENGTH(if(`service1`.`date_of_next_service`,date_format(`service1`.`date_of_next_service`,'%d/%m/%Y'),'')), CONCAT_WS('',   if(`service1`.`date_of_next_service`,date_format(`service1`.`date_of_next_service`,'%d/%m/%Y'),'')), '') /* Date of Next Service: */" => "Date of Next Service:",
		"IF(    CHAR_LENGTH(`purchase_orders1`.`purchased_order_number`), CONCAT_WS('',   `purchase_orders1`.`purchased_order_number`), '') /* Purchased Order Number: */" => "Purchased Order Number:",
		"IF(    CHAR_LENGTH(`claim1`.`claim_code`), CONCAT_WS('',   `claim1`.`claim_code`), '') /* Claims Code: */" => "Claims Code:",
		"IF(    CHAR_LENGTH(`tyre_log_sheet1`.`tyre_inspection_report`), CONCAT_WS('',   `tyre_log_sheet1`.`tyre_inspection_report`), '') /* Tyre Inspection Report: */" => "Tyre Inspection Report:",
		"IF(    CHAR_LENGTH(`vehicle_daily_check_list1`.`inspection_certification_number`), CONCAT_WS('',   `vehicle_daily_check_list1`.`inspection_certification_number`), '') /* Inspection Certification No: */" => "Inspection Certification No:",
		"IF(    CHAR_LENGTH(`vehicle_daily_check_list2`.`document_checklist_report`), CONCAT_WS('',   `vehicle_daily_check_list2`.`document_checklist_report`), '') /* Document Check List Report: */" => "Document Check List Report:",
		"IF(    CHAR_LENGTH(if(`vehicle_daily_check_list3`.`next_inspection_date`,date_format(`vehicle_daily_check_list3`.`next_inspection_date`,'%d/%m/%Y'),'')), CONCAT_WS('',   if(`vehicle_daily_check_list3`.`next_inspection_date`,date_format(`vehicle_daily_check_list3`.`next_inspection_date`,'%d/%m/%Y'),'')), '') /* Next Inspection Date: */" => "Next Inspection Date:",
		"`vehicle_history`.`breakdown_of_vehicle`" => "Breakdown of Vehicle?:",
		"`vehicle_history`.`date_of_vehicle_breakdown`" => "Date of Vehicle Breakdown:",
		"`vehicle_history`.`description_of_vehicle_breakdown`" => "Description of Vehicle Breakdown:",
		"IF(    CHAR_LENGTH(`log_sheet1`.`closing_km`), CONCAT_WS('',   `log_sheet1`.`closing_km`), '') /* Closing KM: */" => "Closing KM:",
		"`vehicle_history`.`date_of_vehicle_reactivation`" => "Date of Vehicle Re-activation:",
		"IF(    CHAR_LENGTH(`breakdown_services1`.`total_amount`), CONCAT_WS('',   `breakdown_services1`.`total_amount`), '') /* Total Repairing Cost (R): */" => "Total Repairing Cost (R):",
	];

	// Fields that can be quick searched
	$x->QueryFieldsQS = [
		"`vehicle_history`.`history_id`" => "history_id",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`, '  '), '') /* Registration Number: */" => "vehicle_registration_number",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS('',   `gmt_fleet_register1`.`engine_number`, ' '), '') /* Engine Number: */" => "engine_number",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`purchase_price`), CONCAT_WS('',   `gmt_fleet_register1`.`purchase_price`, ' '), '') /* Purchase Price (R): */" => "purchased_price",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`) || CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`, '   |  and  |   ', `gmt_fleet_register1`.`engine_number`), '') /* Old Registration Number: */" => "old_registration_number",
		"`vehicle_history`.`new_vehicle_registration_number`" => "new_vehicle_registration_number",
		"if(`vehicle_history`.`date_of_vehicle_transfer`,date_format(`vehicle_history`.`date_of_vehicle_transfer`,'%d/%m/%Y'),'')" => "date_of_vehicle_transfer",
		"`vehicle_history`.`comments`" => "comments",
		"IF(    CHAR_LENGTH(if(`gmt_fleet_register1`.`renewal_of_license`,date_format(`gmt_fleet_register1`.`renewal_of_license`,'%d/%m/%Y'),'')), CONCAT_WS('',   if(`gmt_fleet_register1`.`renewal_of_license`,date_format(`gmt_fleet_register1`.`renewal_of_license`,'%d/%m/%Y'),'')), '') /* Renewal Of License: */" => "renewal_of_license",
		"IF(    CHAR_LENGTH(if(`schedule1`.`date`,date_format(`schedule1`.`date`,'%d/%m/%Y'),'')), CONCAT_WS('',   if(`schedule1`.`date`,date_format(`schedule1`.`date`,'%d/%m/%Y'),'')), '') /* Date of Service: */" => "date_of_service",
		"IF(    CHAR_LENGTH(if(`service1`.`date_of_next_service`,date_format(`service1`.`date_of_next_service`,'%d/%m/%Y'),'')), CONCAT_WS('',   if(`service1`.`date_of_next_service`,date_format(`service1`.`date_of_next_service`,'%d/%m/%Y'),'')), '') /* Date of Next Service: */" => "date_of_next_service",
		"IF(    CHAR_LENGTH(`purchase_orders1`.`purchased_order_number`), CONCAT_WS('',   `purchase_orders1`.`purchased_order_number`), '') /* Purchased Order Number: */" => "purchased_order_number",
		"IF(    CHAR_LENGTH(`claim1`.`claim_code`), CONCAT_WS('',   `claim1`.`claim_code`), '') /* Claims Code: */" => "claim_code",
		"if(CHAR_LENGTH(IF(    CHAR_LENGTH(`tyre_log_sheet1`.`tyre_inspection_report`), CONCAT_WS('',   `tyre_log_sheet1`.`tyre_inspection_report`), '')), concat('<a href=\"" . getUploadDir('') . "',IF(    CHAR_LENGTH(`tyre_log_sheet1`.`tyre_inspection_report`), CONCAT_WS('',   `tyre_log_sheet1`.`tyre_inspection_report`), ''),'\" target=\"_nWindow\">',IF(    CHAR_LENGTH(`tyre_log_sheet1`.`tyre_inspection_report`), CONCAT_WS('',   `tyre_log_sheet1`.`tyre_inspection_report`), ''),'</a>'), '')" => "tyre_inspection_report",
		"IF(    CHAR_LENGTH(`vehicle_daily_check_list1`.`inspection_certification_number`), CONCAT_WS('',   `vehicle_daily_check_list1`.`inspection_certification_number`), '') /* Inspection Certification No: */" => "inspection_certification_number",
		"if(CHAR_LENGTH(IF(    CHAR_LENGTH(`vehicle_daily_check_list2`.`document_checklist_report`), CONCAT_WS('',   `vehicle_daily_check_list2`.`document_checklist_report`), '')), concat('<a href=\"" . getUploadDir('') . "',IF(    CHAR_LENGTH(`vehicle_daily_check_list2`.`document_checklist_report`), CONCAT_WS('',   `vehicle_daily_check_list2`.`document_checklist_report`), ''),'\" target=\"_nWindow\">',IF(    CHAR_LENGTH(`vehicle_daily_check_list2`.`document_checklist_report`), CONCAT_WS('',   `vehicle_daily_check_list2`.`document_checklist_report`), ''),'</a>'), '')" => "document_checklist_report",
		"IF(    CHAR_LENGTH(if(`vehicle_daily_check_list3`.`next_inspection_date`,date_format(`vehicle_daily_check_list3`.`next_inspection_date`,'%d/%m/%Y'),'')), CONCAT_WS('',   if(`vehicle_daily_check_list3`.`next_inspection_date`,date_format(`vehicle_daily_check_list3`.`next_inspection_date`,'%d/%m/%Y'),'')), '') /* Next Inspection Date: */" => "next_inspection_date",
		"`vehicle_history`.`breakdown_of_vehicle`" => "breakdown_of_vehicle",
		"DATE_FORMAT(`vehicle_history`.`date_of_vehicle_breakdown`, '%D %b %Y %l:%i%p')" => "date_of_vehicle_breakdown",
		"`vehicle_history`.`description_of_vehicle_breakdown`" => "description_of_vehicle_breakdown",
		"IF(    CHAR_LENGTH(`log_sheet1`.`closing_km`), CONCAT_WS('',   `log_sheet1`.`closing_km`), '') /* Closing KM: */" => "closing_km",
		"if(`vehicle_history`.`date_of_vehicle_reactivation`,date_format(`vehicle_history`.`date_of_vehicle_reactivation`,'%d/%m/%Y %H:%i'),'')" => "date_of_vehicle_reactivation",
		"IF(    CHAR_LENGTH(`breakdown_services1`.`total_amount`), CONCAT_WS('',   `breakdown_services1`.`total_amount`), '') /* Total Repairing Cost (R): */" => "total_cost",
	];

	// Lookup fields that can be used as filterers
	$x->filterers = ['vehicle_registration_number' => 'Registration Number:', 'date_of_service' => 'Date of Service:', 'purchased_order_number' => 'Purchased Order Number:', 'claim_code' => 'Claims Code:', 'tyre_inspection_report' => 'Tyre Inspection Report:', 'inspection_certification_number' => 'Inspection Certification No:', 'document_checklist_report' => 'Document Check List Report:', 'next_inspection_date' => 'Next Inspection Date:', 'closing_km' => 'Closing KM:', 'total_cost' => 'Total Repairing Cost (R):', ];

	$x->QueryFrom = "`vehicle_history` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`vehicle_history`.`vehicle_registration_number` LEFT JOIN `service` as service1 ON `service1`.`service_id`=`vehicle_history`.`date_of_service` LEFT JOIN `schedule` as schedule1 ON `schedule1`.`schedule_id`=`service1`.`date_of_service` LEFT JOIN `purchase_orders` as purchase_orders1 ON `purchase_orders1`.`purchase_order_id`=`vehicle_history`.`purchased_order_number` LEFT JOIN `claim` as claim1 ON `claim1`.`claim_id`=`vehicle_history`.`claim_code` LEFT JOIN `tyre_log_sheet` as tyre_log_sheet1 ON `tyre_log_sheet1`.`tyre_log_id`=`vehicle_history`.`tyre_inspection_report` LEFT JOIN `vehicle_daily_check_list` as vehicle_daily_check_list1 ON `vehicle_daily_check_list1`.`vehicle_daily_check_list_id`=`vehicle_history`.`inspection_certification_number` LEFT JOIN `vehicle_daily_check_list` as vehicle_daily_check_list2 ON `vehicle_daily_check_list2`.`vehicle_daily_check_list_id`=`vehicle_history`.`document_checklist_report` LEFT JOIN `vehicle_daily_check_list` as vehicle_daily_check_list3 ON `vehicle_daily_check_list3`.`vehicle_daily_check_list_id`=`vehicle_history`.`next_inspection_date` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`vehicle_history`.`closing_km` LEFT JOIN `breakdown_services` as breakdown_services1 ON `breakdown_services1`.`breakdown_id`=`vehicle_history`.`total_cost` ";
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
	$x->ScriptFileName = 'vehicle_history_view.php';
	$x->RedirectAfterInsert = 'vehicle_history_view.php?SelectedID=#ID#';
	$x->TableTitle = 'Vehicle General History:';
	$x->TableIcon = 'resources/table_icons/Applications-AppleWorks-6.png';
	$x->PrimaryKey = '`vehicle_history`.`history_id`';

	$x->ColWidth = [150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 80, ];
	$x->ColCaption = ['History ID:', 'Registration Number:', 'Engine Number:', 'Purchase Price (R):', 'Old Registration Number:', 'New Vehicle Registration Number:', 'Date of  Vehicle Transfer:', 'Comments:', 'Renewal Of License:', 'Date of Service:', 'Date of Next Service:', 'Purchased Order Number:', 'Claims Code:', 'Tyre Inspection Report:', 'Inspection Certification No:', 'Document Check List Report:', 'Next Inspection Date:', 'Breakdown of Vehicle?:', 'Date of Vehicle Breakdown:', 'Description of Vehicle Breakdown:', 'Closing KM:', 'Date of Vehicle Re-activation:', 'Total Repairing Cost (R):', ];
	$x->ColFieldName = ['history_id', 'vehicle_registration_number', 'engine_number', 'purchased_price', 'old_registration_number', 'new_vehicle_registration_number', 'date_of_vehicle_transfer', 'comments', 'renewal_of_license', 'date_of_service', 'date_of_next_service', 'purchased_order_number', 'claim_code', 'tyre_inspection_report', 'inspection_certification_number', 'document_checklist_report', 'next_inspection_date', 'breakdown_of_vehicle', 'date_of_vehicle_breakdown', 'description_of_vehicle_breakdown', 'closing_km', 'date_of_vehicle_reactivation', 'total_cost', ];
	$x->ColNumber  = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, ];

	// template paths below are based on the app main directory
	$x->Template = 'templates/vehicle_history_templateTV.html';
	$x->SelectedTemplate = 'templates/vehicle_history_templateTVS.html';
	$x->TemplateDV = 'templates/vehicle_history_templateDV.html';
	$x->TemplateDVP = 'templates/vehicle_history_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HasCalculatedFields = false;
	$x->AllowConsoleLog = false;
	$x->AllowDVNavigation = true;

	// hook: vehicle_history_init
	$render = true;
	if(function_exists('vehicle_history_init')) {
		$args = [];
		$render = vehicle_history_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: vehicle_history_header
	$headerCode = '';
	if(function_exists('vehicle_history_header')) {
		$args = [];
		$headerCode = vehicle_history_header($x->ContentType, getMemberInfo(), $args);
	}

	if(!$headerCode) {
		include_once(__DIR__ . '/header.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/header.php');
		echo str_replace('<%%HEADER%%>', ob_get_clean(), $headerCode);
	}

	echo $x->HTML;

	// hook: vehicle_history_footer
	$footerCode = '';
	if(function_exists('vehicle_history_footer')) {
		$args = [];
		$footerCode = vehicle_history_footer($x->ContentType, getMemberInfo(), $args);
	}

	if(!$footerCode) {
		include_once(__DIR__ . '/footer.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/footer.php');
		echo str_replace('<%%FOOTER%%>', ob_get_clean(), $footerCode);
	}
