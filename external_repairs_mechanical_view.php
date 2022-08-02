<?php
// This script and data application were generated by AppGini 22.13
// Download AppGini for free from https://bigprof.com/appgini/download/

	include_once(__DIR__ . '/lib.php');
	@include_once(__DIR__ . '/hooks/external_repairs_mechanical.php');
	include_once(__DIR__ . '/external_repairs_mechanical_dml.php');

	// mm: can the current member access this page?
	$perm = getTablePermissions('external_repairs_mechanical');
	if(!$perm['access']) {
		echo error_message($Translation['tableAccessDenied']);
		exit;
	}

	$x = new DataList;
	$x->TableName = 'external_repairs_mechanical';

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = [
		"`external_repairs_mechanical`.`external_mechanical_id`" => "external_mechanical_id",
		"`external_repairs_mechanical`.`department_inspector_name_and_surname`" => "department_inspector_name_and_surname",
		"`external_repairs_mechanical`.`department_inspector_persal_number`" => "department_inspector_persal_number",
		"`external_repairs_mechanical`.`department_authorization_quote_note`" => "department_authorization_quote_note",
		"`external_repairs_mechanical`.`department_inspector_signature`" => "department_inspector_signature",
		"`external_repairs_mechanical`.`inspection_approval_repair_note`" => "inspection_approval_repair_note",
		"`external_repairs_mechanical`.`department_authorization_quote`" => "department_authorization_quote",
		"IF(    CHAR_LENGTH(`service_provider1`.`service_provider_name`), CONCAT_WS('',   `service_provider1`.`service_provider_name`), '') /* Service Provider Name: */" => "service_provider_name",
		"IF(    CHAR_LENGTH(`service_provider_type1`.`service_provider_type`), CONCAT_WS('',   `service_provider_type1`.`service_provider_type`), '') /* Service Provider Type: */" => "service_provider_type",
		"IF(    CHAR_LENGTH(`service_provider3`.`service_provider_contact_email`), CONCAT_WS('',   `service_provider3`.`service_provider_contact_email`), '') /* Service Provider Contacts: */" => "service_provider_contact_details",
		"IF(    CHAR_LENGTH(`service_provider4`.`service_provider_street_address`), CONCAT_WS('',   `service_provider4`.`service_provider_street_address`), '') /* Service Provider Address: */" => "service_provider_address",
		"`external_repairs_mechanical`.`service_provider_signature`" => "service_provider_signature",
		"`external_repairs_mechanical`.`service_provider_repair_quote_upload`" => "service_provider_repair_quote_upload",
		"`external_repairs_mechanical`.`service_provider_repair_quote`" => "service_provider_repair_quote",
		"`external_repairs_mechanical`.`repair_requirement_note`" => "repair_requirement_note",
		"IF(    CHAR_LENGTH(`merchant_type1`.`merchant_type`), CONCAT_WS('',   `merchant_type1`.`merchant_type`), '') /* Merchant Type: */" => "merchant_type",
		"IF(    CHAR_LENGTH(`merchant2`.`merchant_code`) || CHAR_LENGTH(`merchant2`.`merchant_name`), CONCAT_WS('',   `merchant2`.`merchant_code`, '    |    and     |    ', `merchant2`.`merchant_name`), '') /* Merchant code */" => "merchant_code",
		"IF(    CHAR_LENGTH(`merchant3`.`merchant_name`), CONCAT_WS('',   `merchant3`.`merchant_name`), '') /* Merchant Name: */" => "merchant_name",
		"IF(    CHAR_LENGTH(`merchant4`.`merchant_contact_details`), CONCAT_WS('',   `merchant4`.`merchant_contact_details`), '') /* Merchant Contacts Details: */" => "merchant_contacts_details",
		"IF(    CHAR_LENGTH(`merchant5`.`merchant_contact_email`), CONCAT_WS('',   `merchant5`.`merchant_contact_email`), '') /* Merchant Email Address: */" => "merchant_email_address",
		"`external_repairs_mechanical`.`merchant_signature`" => "merchant_signature",
		"IF(    CHAR_LENGTH(`merchant6`.`merchant_street_address`), CONCAT_WS('',   `merchant6`.`merchant_street_address`), '') /* Merchant Address: */" => "merchant_address",
		"IF(    CHAR_LENGTH(`merchant7`.`merchant_address_code`), CONCAT_WS('',   `merchant7`.`merchant_address_code`), '') /* Merchant Address Code: */" => "merchant_address_code",
		"DATE_FORMAT(`external_repairs_mechanical`.`date_of_vehicle_send`, '%e/%c/%Y %l:%i%p')" => "date_of_vehicle_send",
		"IF(    CHAR_LENGTH(`claim1`.`authorization_number`) || CHAR_LENGTH(`claim1`.`claim_code`), CONCAT_WS('',   `claim1`.`authorization_number`, '     |   and   |     ', `claim1`.`claim_code`), '') /* Authorization Number: */" => "authorization_number",
		"IF(    CHAR_LENGTH(`claim2`.`instruction_note`) || CHAR_LENGTH(`claim2`.`claim_code`), CONCAT_WS('',   `claim2`.`instruction_note`, '    |   and    |     ', `claim2`.`claim_code`), '') /* Instruction Note: */" => "instruction_note",
		"IF(    CHAR_LENGTH(`work_allocation1`.`work_allocation_reference_number`), CONCAT_WS('',   `work_allocation1`.`work_allocation_reference_number`), '') /* Work Allocation Reference Number: */" => "work_allocation_reference_number",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`), '') /* Registration Number: */" => "vehicle_registration_number",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS('',   `gmt_fleet_register1`.`engine_number`), '') /* Engine Number: */" => "engine_number",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`) || CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS('',   `gmt_fleet_register1`.`model_of_vehicle`, '   |    and     |     ', `dealer1`.`make_of_vehicle`, '   '), '') /* Make of Vehicle: */" => "make_of_vehicle",
		"DATE_FORMAT(`external_repairs_mechanical`.`date_of_vehicle_received`, '%e/%c/%Y %l:%i%p')" => "date_of_vehicle_received",
		"`external_repairs_mechanical`.`mechanical_repair_progress_monitor`" => "mechanical_repair_progress_monitor",
		"`external_repairs_mechanical`.`mechanical_repair_progress_monitor_quality_of_work_manship`" => "mechanical_repair_progress_monitor_quality_of_work_manship",
		"`external_repairs_mechanical`.`vehicle_inspection_report`" => "vehicle_inspection_report",
		"`external_repairs_mechanical`.`upload_invoice`" => "upload_invoice",
	];
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = [
		1 => '`external_repairs_mechanical`.`external_mechanical_id`',
		2 => 2,
		3 => 3,
		4 => 4,
		5 => 5,
		6 => 6,
		7 => 7,
		8 => '`service_provider1`.`service_provider_name`',
		9 => 9,
		10 => '`service_provider3`.`service_provider_contact_email`',
		11 => '`service_provider4`.`service_provider_street_address`',
		12 => 12,
		13 => 13,
		14 => 14,
		15 => 15,
		16 => 16,
		17 => 17,
		18 => '`merchant3`.`merchant_name`',
		19 => '`merchant4`.`merchant_contact_details`',
		20 => '`merchant5`.`merchant_contact_email`',
		21 => 21,
		22 => '`merchant6`.`merchant_street_address`',
		23 => '`merchant7`.`merchant_address_code`',
		24 => '`external_repairs_mechanical`.`date_of_vehicle_send`',
		25 => 25,
		26 => 26,
		27 => '`work_allocation1`.`work_allocation_reference_number`',
		28 => '`gmt_fleet_register1`.`vehicle_registration_number`',
		29 => '`gmt_fleet_register1`.`engine_number`',
		30 => 30,
		31 => '`external_repairs_mechanical`.`date_of_vehicle_received`',
		32 => 32,
		33 => 33,
		34 => 34,
		35 => 35,
	];

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = [
		"`external_repairs_mechanical`.`external_mechanical_id`" => "external_mechanical_id",
		"`external_repairs_mechanical`.`department_inspector_name_and_surname`" => "department_inspector_name_and_surname",
		"`external_repairs_mechanical`.`department_inspector_persal_number`" => "department_inspector_persal_number",
		"`external_repairs_mechanical`.`department_authorization_quote_note`" => "department_authorization_quote_note",
		"`external_repairs_mechanical`.`department_inspector_signature`" => "department_inspector_signature",
		"`external_repairs_mechanical`.`inspection_approval_repair_note`" => "inspection_approval_repair_note",
		"`external_repairs_mechanical`.`department_authorization_quote`" => "department_authorization_quote",
		"IF(    CHAR_LENGTH(`service_provider1`.`service_provider_name`), CONCAT_WS('',   `service_provider1`.`service_provider_name`), '') /* Service Provider Name: */" => "service_provider_name",
		"IF(    CHAR_LENGTH(`service_provider_type1`.`service_provider_type`), CONCAT_WS('',   `service_provider_type1`.`service_provider_type`), '') /* Service Provider Type: */" => "service_provider_type",
		"IF(    CHAR_LENGTH(`service_provider3`.`service_provider_contact_email`), CONCAT_WS('',   `service_provider3`.`service_provider_contact_email`), '') /* Service Provider Contacts: */" => "service_provider_contact_details",
		"IF(    CHAR_LENGTH(`service_provider4`.`service_provider_street_address`), CONCAT_WS('',   `service_provider4`.`service_provider_street_address`), '') /* Service Provider Address: */" => "service_provider_address",
		"`external_repairs_mechanical`.`service_provider_signature`" => "service_provider_signature",
		"`external_repairs_mechanical`.`service_provider_repair_quote_upload`" => "service_provider_repair_quote_upload",
		"`external_repairs_mechanical`.`service_provider_repair_quote`" => "service_provider_repair_quote",
		"`external_repairs_mechanical`.`repair_requirement_note`" => "repair_requirement_note",
		"IF(    CHAR_LENGTH(`merchant_type1`.`merchant_type`), CONCAT_WS('',   `merchant_type1`.`merchant_type`), '') /* Merchant Type: */" => "merchant_type",
		"IF(    CHAR_LENGTH(`merchant2`.`merchant_code`) || CHAR_LENGTH(`merchant2`.`merchant_name`), CONCAT_WS('',   `merchant2`.`merchant_code`, '    |    and     |    ', `merchant2`.`merchant_name`), '') /* Merchant code */" => "merchant_code",
		"IF(    CHAR_LENGTH(`merchant3`.`merchant_name`), CONCAT_WS('',   `merchant3`.`merchant_name`), '') /* Merchant Name: */" => "merchant_name",
		"IF(    CHAR_LENGTH(`merchant4`.`merchant_contact_details`), CONCAT_WS('',   `merchant4`.`merchant_contact_details`), '') /* Merchant Contacts Details: */" => "merchant_contacts_details",
		"IF(    CHAR_LENGTH(`merchant5`.`merchant_contact_email`), CONCAT_WS('',   `merchant5`.`merchant_contact_email`), '') /* Merchant Email Address: */" => "merchant_email_address",
		"`external_repairs_mechanical`.`merchant_signature`" => "merchant_signature",
		"IF(    CHAR_LENGTH(`merchant6`.`merchant_street_address`), CONCAT_WS('',   `merchant6`.`merchant_street_address`), '') /* Merchant Address: */" => "merchant_address",
		"IF(    CHAR_LENGTH(`merchant7`.`merchant_address_code`), CONCAT_WS('',   `merchant7`.`merchant_address_code`), '') /* Merchant Address Code: */" => "merchant_address_code",
		"DATE_FORMAT(`external_repairs_mechanical`.`date_of_vehicle_send`, '%e/%c/%Y %l:%i%p')" => "date_of_vehicle_send",
		"IF(    CHAR_LENGTH(`claim1`.`authorization_number`) || CHAR_LENGTH(`claim1`.`claim_code`), CONCAT_WS('',   `claim1`.`authorization_number`, '     |   and   |     ', `claim1`.`claim_code`), '') /* Authorization Number: */" => "authorization_number",
		"IF(    CHAR_LENGTH(`claim2`.`instruction_note`) || CHAR_LENGTH(`claim2`.`claim_code`), CONCAT_WS('',   `claim2`.`instruction_note`, '    |   and    |     ', `claim2`.`claim_code`), '') /* Instruction Note: */" => "instruction_note",
		"IF(    CHAR_LENGTH(`work_allocation1`.`work_allocation_reference_number`), CONCAT_WS('',   `work_allocation1`.`work_allocation_reference_number`), '') /* Work Allocation Reference Number: */" => "work_allocation_reference_number",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`), '') /* Registration Number: */" => "vehicle_registration_number",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS('',   `gmt_fleet_register1`.`engine_number`), '') /* Engine Number: */" => "engine_number",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`) || CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS('',   `gmt_fleet_register1`.`model_of_vehicle`, '   |    and     |     ', `dealer1`.`make_of_vehicle`, '   '), '') /* Make of Vehicle: */" => "make_of_vehicle",
		"DATE_FORMAT(`external_repairs_mechanical`.`date_of_vehicle_received`, '%e/%c/%Y %l:%i%p')" => "date_of_vehicle_received",
		"`external_repairs_mechanical`.`mechanical_repair_progress_monitor`" => "mechanical_repair_progress_monitor",
		"`external_repairs_mechanical`.`mechanical_repair_progress_monitor_quality_of_work_manship`" => "mechanical_repair_progress_monitor_quality_of_work_manship",
		"`external_repairs_mechanical`.`vehicle_inspection_report`" => "vehicle_inspection_report",
		"`external_repairs_mechanical`.`upload_invoice`" => "upload_invoice",
	];
	// Fields that can be filtered
	$x->QueryFieldsFilters = [
		"`external_repairs_mechanical`.`external_mechanical_id`" => "Mechanical ID:",
		"`external_repairs_mechanical`.`department_inspector_name_and_surname`" => "Department Inspector Name & Surname:",
		"`external_repairs_mechanical`.`department_inspector_persal_number`" => "Inspector Persal Number:",
		"`external_repairs_mechanical`.`department_authorization_quote_note`" => "Department Authorization Quote Note:",
		"`external_repairs_mechanical`.`inspection_approval_repair_note`" => "Inspection Approval Repair Note:",
		"`external_repairs_mechanical`.`department_authorization_quote`" => "Department Authorization Quote:",
		"IF(    CHAR_LENGTH(`service_provider1`.`service_provider_name`), CONCAT_WS('',   `service_provider1`.`service_provider_name`), '') /* Service Provider Name: */" => "Service Provider Name:",
		"IF(    CHAR_LENGTH(`service_provider_type1`.`service_provider_type`), CONCAT_WS('',   `service_provider_type1`.`service_provider_type`), '') /* Service Provider Type: */" => "Service Provider Type:",
		"IF(    CHAR_LENGTH(`service_provider3`.`service_provider_contact_email`), CONCAT_WS('',   `service_provider3`.`service_provider_contact_email`), '') /* Service Provider Contacts: */" => "Service Provider Contacts:",
		"IF(    CHAR_LENGTH(`service_provider4`.`service_provider_street_address`), CONCAT_WS('',   `service_provider4`.`service_provider_street_address`), '') /* Service Provider Address: */" => "Service Provider Address:",
		"`external_repairs_mechanical`.`service_provider_repair_quote_upload`" => "Repair Quote Service Provider:",
		"`external_repairs_mechanical`.`service_provider_repair_quote`" => "Repair Qoute Service Providers:",
		"`external_repairs_mechanical`.`repair_requirement_note`" => "Repair Requirement Note:",
		"IF(    CHAR_LENGTH(`merchant_type1`.`merchant_type`), CONCAT_WS('',   `merchant_type1`.`merchant_type`), '') /* Merchant Type: */" => "Merchant Type:",
		"IF(    CHAR_LENGTH(`merchant2`.`merchant_code`) || CHAR_LENGTH(`merchant2`.`merchant_name`), CONCAT_WS('',   `merchant2`.`merchant_code`, '    |    and     |    ', `merchant2`.`merchant_name`), '') /* Merchant code */" => "Merchant code",
		"IF(    CHAR_LENGTH(`merchant3`.`merchant_name`), CONCAT_WS('',   `merchant3`.`merchant_name`), '') /* Merchant Name: */" => "Merchant Name:",
		"IF(    CHAR_LENGTH(`merchant4`.`merchant_contact_details`), CONCAT_WS('',   `merchant4`.`merchant_contact_details`), '') /* Merchant Contacts Details: */" => "Merchant Contacts Details:",
		"IF(    CHAR_LENGTH(`merchant5`.`merchant_contact_email`), CONCAT_WS('',   `merchant5`.`merchant_contact_email`), '') /* Merchant Email Address: */" => "Merchant Email Address:",
		"IF(    CHAR_LENGTH(`merchant6`.`merchant_street_address`), CONCAT_WS('',   `merchant6`.`merchant_street_address`), '') /* Merchant Address: */" => "Merchant Address:",
		"IF(    CHAR_LENGTH(`merchant7`.`merchant_address_code`), CONCAT_WS('',   `merchant7`.`merchant_address_code`), '') /* Merchant Address Code: */" => "Merchant Address Code:",
		"`external_repairs_mechanical`.`date_of_vehicle_send`" => "Date of Vehicle Send:",
		"IF(    CHAR_LENGTH(`claim1`.`authorization_number`) || CHAR_LENGTH(`claim1`.`claim_code`), CONCAT_WS('',   `claim1`.`authorization_number`, '     |   and   |     ', `claim1`.`claim_code`), '') /* Authorization Number: */" => "Authorization Number:",
		"IF(    CHAR_LENGTH(`claim2`.`instruction_note`) || CHAR_LENGTH(`claim2`.`claim_code`), CONCAT_WS('',   `claim2`.`instruction_note`, '    |   and    |     ', `claim2`.`claim_code`), '') /* Instruction Note: */" => "Instruction Note:",
		"IF(    CHAR_LENGTH(`work_allocation1`.`work_allocation_reference_number`), CONCAT_WS('',   `work_allocation1`.`work_allocation_reference_number`), '') /* Work Allocation Reference Number: */" => "Work Allocation Reference Number:",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`), '') /* Registration Number: */" => "Registration Number:",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS('',   `gmt_fleet_register1`.`engine_number`), '') /* Engine Number: */" => "Engine Number:",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`) || CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS('',   `gmt_fleet_register1`.`model_of_vehicle`, '   |    and     |     ', `dealer1`.`make_of_vehicle`, '   '), '') /* Make of Vehicle: */" => "Make of Vehicle:",
		"`external_repairs_mechanical`.`date_of_vehicle_received`" => "Date of Vehicle Received:",
		"`external_repairs_mechanical`.`mechanical_repair_progress_monitor`" => "Monitor Progress:",
		"`external_repairs_mechanical`.`mechanical_repair_progress_monitor_quality_of_work_manship`" => "Monitor the Quality of Workmanship:",
		"`external_repairs_mechanical`.`vehicle_inspection_report`" => "Vehicle Inspection Report:",
		"`external_repairs_mechanical`.`upload_invoice`" => "Upload Invoice:",
	];

	// Fields that can be quick searched
	$x->QueryFieldsQS = [
		"`external_repairs_mechanical`.`external_mechanical_id`" => "external_mechanical_id",
		"`external_repairs_mechanical`.`department_inspector_name_and_surname`" => "department_inspector_name_and_surname",
		"`external_repairs_mechanical`.`department_inspector_persal_number`" => "department_inspector_persal_number",
		"`external_repairs_mechanical`.`department_authorization_quote_note`" => "department_authorization_quote_note",
		"`external_repairs_mechanical`.`inspection_approval_repair_note`" => "inspection_approval_repair_note",
		"`external_repairs_mechanical`.`department_authorization_quote`" => "department_authorization_quote",
		"IF(    CHAR_LENGTH(`service_provider1`.`service_provider_name`), CONCAT_WS('',   `service_provider1`.`service_provider_name`), '') /* Service Provider Name: */" => "service_provider_name",
		"IF(    CHAR_LENGTH(`service_provider_type1`.`service_provider_type`), CONCAT_WS('',   `service_provider_type1`.`service_provider_type`), '') /* Service Provider Type: */" => "service_provider_type",
		"IF(    CHAR_LENGTH(`service_provider3`.`service_provider_contact_email`), CONCAT_WS('',   `service_provider3`.`service_provider_contact_email`), '') /* Service Provider Contacts: */" => "service_provider_contact_details",
		"IF(    CHAR_LENGTH(`service_provider4`.`service_provider_street_address`), CONCAT_WS('',   `service_provider4`.`service_provider_street_address`), '') /* Service Provider Address: */" => "service_provider_address",
		"`external_repairs_mechanical`.`service_provider_repair_quote_upload`" => "service_provider_repair_quote_upload",
		"`external_repairs_mechanical`.`service_provider_repair_quote`" => "service_provider_repair_quote",
		"`external_repairs_mechanical`.`repair_requirement_note`" => "repair_requirement_note",
		"IF(    CHAR_LENGTH(`merchant_type1`.`merchant_type`), CONCAT_WS('',   `merchant_type1`.`merchant_type`), '') /* Merchant Type: */" => "merchant_type",
		"IF(    CHAR_LENGTH(`merchant2`.`merchant_code`) || CHAR_LENGTH(`merchant2`.`merchant_name`), CONCAT_WS('',   `merchant2`.`merchant_code`, '    |    and     |    ', `merchant2`.`merchant_name`), '') /* Merchant code */" => "merchant_code",
		"IF(    CHAR_LENGTH(`merchant3`.`merchant_name`), CONCAT_WS('',   `merchant3`.`merchant_name`), '') /* Merchant Name: */" => "merchant_name",
		"IF(    CHAR_LENGTH(`merchant4`.`merchant_contact_details`), CONCAT_WS('',   `merchant4`.`merchant_contact_details`), '') /* Merchant Contacts Details: */" => "merchant_contacts_details",
		"IF(    CHAR_LENGTH(`merchant5`.`merchant_contact_email`), CONCAT_WS('',   `merchant5`.`merchant_contact_email`), '') /* Merchant Email Address: */" => "merchant_email_address",
		"IF(    CHAR_LENGTH(`merchant6`.`merchant_street_address`), CONCAT_WS('',   `merchant6`.`merchant_street_address`), '') /* Merchant Address: */" => "merchant_address",
		"IF(    CHAR_LENGTH(`merchant7`.`merchant_address_code`), CONCAT_WS('',   `merchant7`.`merchant_address_code`), '') /* Merchant Address Code: */" => "merchant_address_code",
		"DATE_FORMAT(`external_repairs_mechanical`.`date_of_vehicle_send`, '%e/%c/%Y %l:%i%p')" => "date_of_vehicle_send",
		"IF(    CHAR_LENGTH(`claim1`.`authorization_number`) || CHAR_LENGTH(`claim1`.`claim_code`), CONCAT_WS('',   `claim1`.`authorization_number`, '     |   and   |     ', `claim1`.`claim_code`), '') /* Authorization Number: */" => "authorization_number",
		"IF(    CHAR_LENGTH(`claim2`.`instruction_note`) || CHAR_LENGTH(`claim2`.`claim_code`), CONCAT_WS('',   `claim2`.`instruction_note`, '    |   and    |     ', `claim2`.`claim_code`), '') /* Instruction Note: */" => "instruction_note",
		"IF(    CHAR_LENGTH(`work_allocation1`.`work_allocation_reference_number`), CONCAT_WS('',   `work_allocation1`.`work_allocation_reference_number`), '') /* Work Allocation Reference Number: */" => "work_allocation_reference_number",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`), '') /* Registration Number: */" => "vehicle_registration_number",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS('',   `gmt_fleet_register1`.`engine_number`), '') /* Engine Number: */" => "engine_number",
		"IF(    CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`) || CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS('',   `gmt_fleet_register1`.`model_of_vehicle`, '   |    and     |     ', `dealer1`.`make_of_vehicle`, '   '), '') /* Make of Vehicle: */" => "make_of_vehicle",
		"DATE_FORMAT(`external_repairs_mechanical`.`date_of_vehicle_received`, '%e/%c/%Y %l:%i%p')" => "date_of_vehicle_received",
		"`external_repairs_mechanical`.`mechanical_repair_progress_monitor`" => "mechanical_repair_progress_monitor",
		"`external_repairs_mechanical`.`mechanical_repair_progress_monitor_quality_of_work_manship`" => "mechanical_repair_progress_monitor_quality_of_work_manship",
		"`external_repairs_mechanical`.`vehicle_inspection_report`" => "vehicle_inspection_report",
		"`external_repairs_mechanical`.`upload_invoice`" => "upload_invoice",
	];

	// Lookup fields that can be used as filterers
	$x->filterers = ['service_provider_name' => 'Service Provider Name:', 'service_provider_type' => 'Service Provider Type:', 'service_provider_contact_details' => 'Service Provider Contacts:', 'service_provider_address' => 'Service Provider Address:', 'merchant_type' => 'Merchant Type:', 'merchant_code' => 'Merchant code', 'merchant_name' => 'Merchant Name:', 'merchant_contacts_details' => 'Merchant Contacts Details:', 'merchant_email_address' => 'Merchant Email Address:', 'merchant_address' => 'Merchant Address:', 'merchant_address_code' => 'Merchant Address Code:', 'authorization_number' => 'Authorization Number:', 'instruction_note' => 'Instruction Note:', 'work_allocation_reference_number' => 'Work Allocation Reference Number:', 'vehicle_registration_number' => 'Registration Number:', ];

	$x->QueryFrom = "`external_repairs_mechanical` LEFT JOIN `service_provider` as service_provider1 ON `service_provider1`.`service_provider_id`=`external_repairs_mechanical`.`service_provider_name` LEFT JOIN `service_provider` as service_provider2 ON `service_provider2`.`service_provider_id`=`external_repairs_mechanical`.`service_provider_type` LEFT JOIN `service_provider_type` as service_provider_type1 ON `service_provider_type1`.`service_provider_type_id`=`service_provider2`.`service_provider_type` LEFT JOIN `service_provider` as service_provider3 ON `service_provider3`.`service_provider_id`=`external_repairs_mechanical`.`service_provider_contact_details` LEFT JOIN `service_provider` as service_provider4 ON `service_provider4`.`service_provider_id`=`external_repairs_mechanical`.`service_provider_address` LEFT JOIN `merchant` as merchant1 ON `merchant1`.`merchant_id`=`external_repairs_mechanical`.`merchant_type` LEFT JOIN `merchant_type` as merchant_type1 ON `merchant_type1`.`merchant_type_id`=`merchant1`.`merchant_type` LEFT JOIN `merchant` as merchant2 ON `merchant2`.`merchant_id`=`external_repairs_mechanical`.`merchant_code` LEFT JOIN `merchant` as merchant3 ON `merchant3`.`merchant_id`=`external_repairs_mechanical`.`merchant_name` LEFT JOIN `merchant` as merchant4 ON `merchant4`.`merchant_id`=`external_repairs_mechanical`.`merchant_contacts_details` LEFT JOIN `merchant` as merchant5 ON `merchant5`.`merchant_id`=`external_repairs_mechanical`.`merchant_email_address` LEFT JOIN `merchant` as merchant6 ON `merchant6`.`merchant_id`=`external_repairs_mechanical`.`merchant_address` LEFT JOIN `merchant` as merchant7 ON `merchant7`.`merchant_id`=`external_repairs_mechanical`.`merchant_address_code` LEFT JOIN `claim` as claim1 ON `claim1`.`claim_id`=`external_repairs_mechanical`.`authorization_number` LEFT JOIN `claim` as claim2 ON `claim2`.`claim_id`=`external_repairs_mechanical`.`instruction_note` LEFT JOIN `work_allocation` as work_allocation1 ON `work_allocation1`.`work_allocation_id`=`external_repairs_mechanical`.`work_allocation_reference_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`external_repairs_mechanical`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` ";
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
	$x->ScriptFileName = 'external_repairs_mechanical_view.php';
	$x->RedirectAfterInsert = 'external_repairs_mechanical_view.php?SelectedID=#ID#';
	$x->TableTitle = 'External Repairs Mechanical:';
	$x->TableIcon = 'resources/table_icons/document-preferences-2-icon.png';
	$x->PrimaryKey = '`external_repairs_mechanical`.`external_mechanical_id`';

	$x->ColWidth = [150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, ];
	$x->ColCaption = ['Mechanical ID:', 'Department Inspector Name & Surname:', 'Inspector Persal Number:', 'Department Authorization Quote Note:', 'Department Inspector Signature:', 'Inspection Approval Repair Note:', 'Department Authorization Quote:', 'Service Provider Name:', 'Service Provider Type:', 'Service Provider Contacts:', 'Service Provider Address:', 'Service Provider Signature:', 'Repair Quote Service Provider:', 'Repair Qoute Service Providers:', 'Repair Requirement Note:', 'Merchant Type:', 'Merchant code', 'Merchant Name:', 'Merchant Contacts Details:', 'Merchant Email Address:', 'Merchant Signature:', 'Merchant Address:', 'Merchant Address Code:', 'Date of Vehicle Send:', 'Authorization Number:', 'Instruction Note:', 'Work Allocation Reference Number:', 'Registration Number:', 'Engine Number:', 'Make of Vehicle:', 'Date of Vehicle Received:', 'Monitor Progress:', 'Monitor the Quality of Workmanship:', 'Vehicle Inspection Report:', 'Upload Invoice:', ];
	$x->ColFieldName = ['external_mechanical_id', 'department_inspector_name_and_surname', 'department_inspector_persal_number', 'department_authorization_quote_note', 'department_inspector_signature', 'inspection_approval_repair_note', 'department_authorization_quote', 'service_provider_name', 'service_provider_type', 'service_provider_contact_details', 'service_provider_address', 'service_provider_signature', 'service_provider_repair_quote_upload', 'service_provider_repair_quote', 'repair_requirement_note', 'merchant_type', 'merchant_code', 'merchant_name', 'merchant_contacts_details', 'merchant_email_address', 'merchant_signature', 'merchant_address', 'merchant_address_code', 'date_of_vehicle_send', 'authorization_number', 'instruction_note', 'work_allocation_reference_number', 'vehicle_registration_number', 'engine_number', 'make_of_vehicle', 'date_of_vehicle_received', 'mechanical_repair_progress_monitor', 'mechanical_repair_progress_monitor_quality_of_work_manship', 'vehicle_inspection_report', 'upload_invoice', ];
	$x->ColNumber  = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, ];

	// template paths below are based on the app main directory
	$x->Template = 'templates/external_repairs_mechanical_templateTV.html';
	$x->SelectedTemplate = 'templates/external_repairs_mechanical_templateTVS.html';
	$x->TemplateDV = 'templates/external_repairs_mechanical_templateDV.html';
	$x->TemplateDVP = 'templates/external_repairs_mechanical_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HasCalculatedFields = false;
	$x->AllowConsoleLog = false;
	$x->AllowDVNavigation = true;

	// hook: external_repairs_mechanical_init
	$render = true;
	if(function_exists('external_repairs_mechanical_init')) {
		$args = [];
		$render = external_repairs_mechanical_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: external_repairs_mechanical_header
	$headerCode = '';
	if(function_exists('external_repairs_mechanical_header')) {
		$args = [];
		$headerCode = external_repairs_mechanical_header($x->ContentType, getMemberInfo(), $args);
	}

	if(!$headerCode) {
		include_once(__DIR__ . '/header.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/header.php');
		echo str_replace('<%%HEADER%%>', ob_get_clean(), $headerCode);
	}

	echo $x->HTML;

	// hook: external_repairs_mechanical_footer
	$footerCode = '';
	if(function_exists('external_repairs_mechanical_footer')) {
		$args = [];
		$footerCode = external_repairs_mechanical_footer($x->ContentType, getMemberInfo(), $args);
	}

	if(!$footerCode) {
		include_once(__DIR__ . '/footer.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/footer.php');
		echo str_replace('<%%FOOTER%%>', ob_get_clean(), $footerCode);
	}
