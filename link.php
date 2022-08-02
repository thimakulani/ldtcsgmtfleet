<?php
	include_once(__DIR__ . '/lib.php');

	// upload paths
	$p = [
		'gmt_fleet_register' => [
			'photo_of_vehicle' => getUploadDir(''),
			'documents' => getUploadDir(''),
			'primary key' => 'fleet_asset_id'
		],
		'vehicle_history' => [
			'tyre_inspection_report' => 'Lookup: tyre_log_sheet::tyre_log_id::tyre_inspection_report',
			'document_checklist_report' => 'Lookup: vehicle_daily_check_list::vehicle_daily_check_list_id::document_checklist_report',
			'primary key' => 'history_id'
		],
		'vehicle_payments' => [
			'documents' => getUploadDir(''),
			'primary key' => 'vehicle_payment_id'
		],
		'insurance_payments' => [
			'documents' => getUploadDir(''),
			'primary key' => 'insurance_payment_id'
		],
		'service' => [
			'upload_quotation' => getUploadDir(''),
			'upload_invoice' => getUploadDir(''),
			'primary key' => 'service_id'
		],
		'service_records' => [
			'image_1' => getUploadDir(''),
			'image_2' => getUploadDir(''),
			'image_3' => getUploadDir(''),
			'image_4' => getUploadDir(''),
			'image_5' => getUploadDir(''),
			'document_1' => getUploadDir(''),
			'document_2' => getUploadDir(''),
			'document_3' => getUploadDir(''),
			'document_4' => getUploadDir(''),
			'document_5' => getUploadDir(''),
			'primary key' => 'records_id'
		],
		'purchase_orders' => [
			'upload_quotation' => getUploadDir(''),
			'upload_invoice' => getUploadDir(''),
			'primary key' => 'purchase_order_id'
		],
		'driver' => [
			'drivers_license_upload' => getUploadDir(''),
			'drivers_license_penalty_details_uploads' => getUploadDir(''),
			'accident_report' => getUploadDir(''),
			'primary key' => 'driver_id'
		],
		'accidents' => [
			'z181_accident_form_uploaded' => getUploadDir(''),
			'copy_of_trip_authority' => getUploadDir(''),
			'upload_photos_damaged_vehicle' => getUploadDir(''),
			'copy_of_sketch_plan' => getUploadDir(''),
			'accident_report_driver' => getUploadDir(''),
			'accident_report_supervisior' => getUploadDir(''),
			'claims_report_accident_committee' => getUploadDir(''),
			'insurance_claims_report' => getUploadDir(''),
			'police_report' => getUploadDir(''),
			'primary key' => 'accident_id'
		],
		'claim' => [
			'upload_invoice' => getUploadDir(''),
			'primary key' => 'claim_id'
		],
		'tyre_log_sheet' => [
			'documents' => getUploadDir(''),
			'tyre_inspection_report' => getUploadDir(''),
			'accident_report' => getUploadDir(''),
			'claims_report' => getUploadDir(''),
			'insurance_claims_report' => getUploadDir(''),
			'primary key' => 'tyre_log_id'
		],
		'vehicle_daily_check_list' => [
			'document_checklist_report' => getUploadDir(''),
			'primary key' => 'vehicle_daily_check_list_id'
		],
		'breakdown_services' => [
			'description_of_vehicle_breakdown' => getUploadDir(''),
			'upload_invoice' => getUploadDir(''),
			'primary key' => 'breakdown_id'
		],
		'modification_to_vehicle' => [
			'driver_signature' => getUploadDir(''),
			'testing_officer_signature' => getUploadDir(''),
			'supervisor_for_allocation_signature' => getUploadDir(''),
			'primary key' => 'modification_id'
		],
		'vehicle_handing_over_checklist' => [
			'driver_signature' => getUploadDir(''),
			'testing_officer_signature' => getUploadDir(''),
			'vehicle_marks_1' => getUploadDir(''),
			'vehicle_marks_2' => getUploadDir(''),
			'vehicle_marks_3' => getUploadDir(''),
			'vehicle_marks_4' => getUploadDir(''),
			'vehicle_marks_5' => getUploadDir(''),
			'vehicle_marks_6' => getUploadDir(''),
			'vehicle_marks_7' => getUploadDir(''),
			'vehicle_marks_8' => getUploadDir(''),
			'vehicle_handing_over_ckecklist' => getUploadDir(''),
			'primary key' => 'vehicle_handing_over_id'
		],
		'vehicle_return_check_list' => [
			'driver_signature' => getUploadDir(''),
			'testing_officer_signature' => getUploadDir(''),
			'vehicle_marks_1' => getUploadDir(''),
			'vehicle_marks_2' => getUploadDir(''),
			'vehicle_marks_3' => getUploadDir(''),
			'vehicle_marks_4' => getUploadDir(''),
			'vehicle_marks_5' => getUploadDir(''),
			'vehicle_marks_6' => getUploadDir(''),
			'vehicle_marks_7' => getUploadDir(''),
			'vehicle_marks_8' => getUploadDir(''),
			'vehicle_return_list' => getUploadDir(''),
			'primary key' => 'vehicle_return_check_list_id'
		],
		'indicates_repair_damages_found_list' => [
			'driver_signature' => getUploadDir(''),
			'company_repesentative_signature' => getUploadDir(''),
			'indicates_and_list_details_of_damages_deficiencies' => getUploadDir(''),
			'primary key' => 'repair_damages_list_id'
		],
		'forms' => [
			'government_motor_transport_handbook' => getUploadDir(''),
			'approved_workshop_procedure_manual' => getUploadDir(''),
			'vehicle_daily_check_list_and_appraisal_report' => getUploadDir(''),
			'z181_report_on_accident' => getUploadDir(''),
			'vehicle_handing_over_ckecklist' => getUploadDir(''),
			'vehicle_return_list' => getUploadDir(''),
			'indicates_and_list_details_of_damages_deficiencies' => getUploadDir(''),
			'primary key' => 'forms_id'
		],
		'identification_of_defects' => [
			'end_user_signature' => getUploadDir(''),
			'transport_officer_email_address' => getUploadDir(''),
			'government_garage_manager_signature' => getUploadDir(''),
			'primary key' => 'defects_id'
		],
		'gate_security' => [
			'inspection_of_vehicle_report' => getUploadDir(''),
			'primary key' => 'gate_security_user_id'
		],
		'reception' => [
			'reception_signature' => getUploadDir(''),
			'description_of_vehicle_report' => getUploadDir(''),
			'upload_of_vehicle_report' => getUploadDir(''),
			'visual_inspection_form' => getUploadDir(''),
			'damage_report' => getUploadDir(''),
			'primary key' => 'reception_user_id'
		],
		'inspection_bay' => [
			'supervisor_signature' => getUploadDir(''),
			'additional_defects_record' => getUploadDir(''),
			'repair_requirement_report' => getUploadDir(''),
			'primary key' => 'inspection_bay_id'
		],
		'work_allocation' => [
			'supervisor_signature' => getUploadDir(''),
			'primary key' => 'work_allocation_id'
		],
		'internal_repairs_mechanical' => [
			'artisan_signature' => getUploadDir(''),
			'spares_order_quotation' => getUploadDir(''),
			'inspection_bay_report' => getUploadDir(''),
			'primary key' => 'internal_mechanical_id'
		],
		'external_repairs_mechanical' => [
			'department_inspector_signature' => getUploadDir(''),
			'department_authorization_quote' => getUploadDir(''),
			'service_provider_signature' => getUploadDir(''),
			'service_provider_repair_quote_upload' => getUploadDir(''),
			'merchant_signature' => getUploadDir(''),
			'vehicle_inspection_report' => getUploadDir(''),
			'upload_invoice' => getUploadDir(''),
			'primary key' => 'external_mechanical_id'
		],
		'internal_repairs_body' => [
			'driver_license_upload' => getUploadDir(''),
			'driver_signature' => getUploadDir(''),
			'z181_accident_form_uploaded' => getUploadDir(''),
			'upload_of_internal_damages_1' => getUploadDir(''),
			'upload_of_internal_damages_2' => getUploadDir(''),
			'upload_of_internal_damages_3' => getUploadDir(''),
			'upload_of_internal_damages_4' => getUploadDir(''),
			'head_panel_beating_quotation_1' => getUploadDir(''),
			'head_panel_beating_signature' => getUploadDir(''),
			'private_panel_beating_quotation_2' => getUploadDir(''),
			'primary key' => 'internal_repairs_body_id'
		],
		'external_repairs_body' => [
			'head_panel_beating_signature' => getUploadDir(''),
			'panel_beating_quotation_approved_by_service_provider' => getUploadDir(''),
			'service_provider_signature' => getUploadDir(''),
			'vehicle_inspection_check_list_form' => getUploadDir(''),
			'merchant_signature' => getUploadDir(''),
			'vehicle_inspection_report' => getUploadDir(''),
			'upload_invoice' => getUploadDir(''),
			'primary key' => 'external_repair_body_id'
		],
		'ordering_of_spares_for_internal_repairs' => [
			'artisan_signature' => getUploadDir(''),
			'supervisor_signature' => getUploadDir(''),
			'workshop_manager_signature' => getUploadDir(''),
			'attached_requisition_form' => getUploadDir(''),
			'primary key' => 'spares_id'
		],
		'collection_of_repaired_vehicles' => [
			'reception_signature' => getUploadDir(''),
			'driver_license_upload' => getUploadDir(''),
			'driver_signature' => getUploadDir(''),
			'vehicle_inspection_form' => getUploadDir(''),
			'primary key' => 'collection_id'
		],
		'withdrawal_vehicle_from_operation' => [
			'supervisor_signature' => getUploadDir(''),
			'tyre_inspection_report' => getUploadDir(''),
			'document_checklist_report' => getUploadDir(''),
			'compiled_technical_report' => getUploadDir(''),
			'district_officer_signature' => getUploadDir(''),
			'primary key' => 'withdrawal_id'
		],
		'costing' => [
			'supervisor_signature' => getUploadDir(''),
			'costing_officer_signature' => getUploadDir(''),
			'spares_orders_quotation_upload' => getUploadDir(''),
			'labour_quotation_upload' => getUploadDir(''),
			'workshop_manager_signature' => getUploadDir(''),
			'upload_invoice' => getUploadDir(''),
			'primary key' => 'costing_id'
		],
		'billing' => [
			'upload_invoice' => getUploadDir(''),
			'primary key' => 'billing_id'
		],
		'general_control_measures' => [
			'government_garage_manager_signature' => getUploadDir(''),
			'primary key' => 'general_control_measures_id'
		],
		'movement_of_personnel_in_government_garage_and_workshops' => [
			'gate_security_signature' => getUploadDir(''),
			'vehicle_handing_over_checklist' => getUploadDir(''),
			'vehicle_return_list' => getUploadDir(''),
			'approved_workshop_procedure_manual' => getUploadDir(''),
			'primary key' => 'movement_id'
		],
		'vehicle_annual_inspection' => [
			'photo_of_vehicle' => getUploadDir(''),
			'documents' => getUploadDir(''),
			'primary key' => 'fleet_asset_id'
		],
	];

	if(!count($p)) getLink();

	// default links
	$dL = [
	];

	// receive user input
	$t = Request::val('t'); // table name
	$f = Request::val('f'); // field name
	$i = makeSafe(Request::val('i')); // id

	// validate input
	if(!in_array($t, array_keys($p))) getLink();
	if(!in_array($f, array_keys($p[$t])) || $f == 'primary key') getLink();
	if(!$i && !$dL[$t][$f]) getLink();

	// user has view access to the requested table?
	if(!check_record_permission($t, Request::val('i'))) getLink();

	// send default link if no id provided, e.g. new record
	if(!$i) {
		$path = $p[$t][$f];
		if(preg_match('/^(http|ftp)/i', $dL[$t][$f])) $path = '';
		@header("Location: {$path}{$dL[$t][$f]}");
		exit;
	}

	getLink($t, $f, $p[$t]['primary key'], $i, $p[$t][$f]);

	function getLink($table = '', $linkField = '', $pk = '', $id = '', $path = '') {
		if(!$id || !$table || !$linkField || !$pk) // default link to return
			exit;

		if(preg_match('/^Lookup: (.*?)::(.*?)::(.*?)$/', $path, $m)) {
			$linkID = makeSafe(sqlValue("SELECT `$linkField` FROM `$table` WHERE `$pk`='$id'"));
			$link = sqlValue("SELECT `{$m[3]}` FROM `{$m[1]}` WHERE `{$m[2]}`='$linkID'");
		} else {
			$link = sqlValue("SELECT `$linkField` FROM `$table` WHERE `$pk`='$id'");
		}

		if(!$link) exit;

		if(preg_match('/^(http|ftp)/i', $link)) {    // if the link points to an external url, don't prepend path
			$path = '';
		} elseif(!is_file(__DIR__ . "/{$path}{$link}")) {    // if the file doesn't exist in the given path, try to find it without the path
			$path = '';
		}

		@header("Location: $path$link");
		exit;
	}