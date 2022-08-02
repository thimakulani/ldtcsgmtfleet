<?php
	define('PREPEND_PATH', '');
	include_once(__DIR__ . '/lib.php');

	// accept a record as an assoc array, return transformed row ready to insert to table
	$transformFunctions = [
		'gmt_fleet_register' => function($data, $options = []) {
			if(isset($data['dealer_name'])) $data['dealer_name'] = pkGivenLookupText($data['dealer_name'], 'gmt_fleet_register', 'dealer_name');
			if(isset($data['make_of_vehicle'])) $data['make_of_vehicle'] = pkGivenLookupText($data['make_of_vehicle'], 'gmt_fleet_register', 'make_of_vehicle');
			if(isset($data['year_model_specification'])) $data['year_model_specification'] = pkGivenLookupText($data['year_model_specification'], 'gmt_fleet_register', 'year_model_specification');
			if(isset($data['transmission'])) $data['transmission'] = pkGivenLookupText($data['transmission'], 'gmt_fleet_register', 'transmission');
			if(isset($data['fuel_type'])) $data['fuel_type'] = pkGivenLookupText($data['fuel_type'], 'gmt_fleet_register', 'fuel_type');
			if(isset($data['type_of_vehicle'])) $data['type_of_vehicle'] = pkGivenLookupText($data['type_of_vehicle'], 'gmt_fleet_register', 'type_of_vehicle');
			if(isset($data['colour_of_vehicle'])) $data['colour_of_vehicle'] = pkGivenLookupText($data['colour_of_vehicle'], 'gmt_fleet_register', 'colour_of_vehicle');
			if(isset($data['application_status'])) $data['application_status'] = pkGivenLookupText($data['application_status'], 'gmt_fleet_register', 'application_status');
			if(isset($data['department_name'])) $data['department_name'] = pkGivenLookupText($data['department_name'], 'gmt_fleet_register', 'department_name');
			if(isset($data['province'])) $data['province'] = pkGivenLookupText($data['province'], 'gmt_fleet_register', 'province');
			if(isset($data['district'])) $data['district'] = pkGivenLookupText($data['district'], 'gmt_fleet_register', 'district');
			if(isset($data['drivers_name_and_surname'])) $data['drivers_name_and_surname'] = pkGivenLookupText($data['drivers_name_and_surname'], 'gmt_fleet_register', 'drivers_name_and_surname');
			if(isset($data['department_name_of_driver'])) $data['department_name_of_driver'] = pkGivenLookupText($data['department_name_of_driver'], 'gmt_fleet_register', 'department_name_of_driver');
			if(isset($data['drivers_contact_details'])) $data['drivers_contact_details'] = str_replace('-', '', $data['drivers_contact_details']);
			if(isset($data['date_auctioned'])) $data['date_auctioned'] = guessMySQLDateTime($data['date_auctioned']);
			if(isset($data['renewal_of_license'])) $data['renewal_of_license'] = guessMySQLDateTime($data['renewal_of_license']);
			if(isset($data['drivers_persal_number'])) $data['drivers_persal_number'] = thisOr($data['drivers_name_and_surname'], pkGivenLookupText($data['drivers_persal_number'], 'gmt_fleet_register', 'drivers_persal_number'));
			if(isset($data['drivers_contact_details'])) $data['drivers_contact_details'] = thisOr($data['drivers_name_and_surname'], pkGivenLookupText($data['drivers_contact_details'], 'gmt_fleet_register', 'drivers_contact_details'));

			return $data;
		},
		'log_sheet' => function($data, $options = []) {
			if(isset($data['vehicle_registration_number'])) $data['vehicle_registration_number'] = pkGivenLookupText($data['vehicle_registration_number'], 'log_sheet', 'vehicle_registration_number');
			if(isset($data['register_number'])) $data['register_number'] = pkGivenLookupText($data['register_number'], 'log_sheet', 'register_number');
			if(isset($data['model_of_vehicle'])) $data['model_of_vehicle'] = pkGivenLookupText($data['model_of_vehicle'], 'log_sheet', 'model_of_vehicle');
			if(isset($data['colour_of_vehicle'])) $data['colour_of_vehicle'] = pkGivenLookupText($data['colour_of_vehicle'], 'log_sheet', 'colour_of_vehicle');
			if(isset($data['renewal_of_license'])) $data['renewal_of_license'] = guessMySQLDateTime($data['renewal_of_license']);
			if(isset($data['month'])) $data['month'] = guessMySQLDateTime($data['month']);
			if(isset($data['drivers_name_and_surname'])) $data['drivers_name_and_surname'] = pkGivenLookupText($data['drivers_name_and_surname'], 'log_sheet', 'drivers_name_and_surname');
			if(isset($data['fuel_type'])) $data['fuel_type'] = pkGivenLookupText($data['fuel_type'], 'log_sheet', 'fuel_type');
			if(isset($data['refuel_first_time_date'])) $data['refuel_first_time_date'] = guessMySQLDateTime($data['refuel_first_time_date']);
			if(isset($data['refuel_second_time_date'])) $data['refuel_second_time_date'] = guessMySQLDateTime($data['refuel_second_time_date']);
			if(isset($data['refuel_third_time_date'])) $data['refuel_third_time_date'] = guessMySQLDateTime($data['refuel_third_time_date']);
			if(isset($data['refuel_fourth_time_date'])) $data['refuel_fourth_time_date'] = guessMySQLDateTime($data['refuel_fourth_time_date']);
			if(isset($data['refuel_fifth_time_date'])) $data['refuel_fifth_time_date'] = guessMySQLDateTime($data['refuel_fifth_time_date']);
			if(isset($data['refuel_sixth_time_date'])) $data['refuel_sixth_time_date'] = guessMySQLDateTime($data['refuel_sixth_time_date']);
			if(isset($data['date_captured'])) $data['date_captured'] = guessMySQLDateTime($data['date_captured']);
			if(isset($data['make_of_vehicle'])) $data['make_of_vehicle'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['make_of_vehicle'], 'log_sheet', 'make_of_vehicle'));
			if(isset($data['year_model_specification'])) $data['year_model_specification'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['year_model_specification'], 'log_sheet', 'year_model_specification'));
			if(isset($data['engine_capacity'])) $data['engine_capacity'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['engine_capacity'], 'log_sheet', 'engine_capacity'));
			if(isset($data['district'])) $data['district'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['district'], 'log_sheet', 'district'));
			if(isset($data['drivers_persal_number'])) $data['drivers_persal_number'] = thisOr($data['drivers_name_and_surname'], pkGivenLookupText($data['drivers_persal_number'], 'log_sheet', 'drivers_persal_number'));

			return $data;
		},
		'vehicle_history' => function($data, $options = []) {
			if(isset($data['vehicle_registration_number'])) $data['vehicle_registration_number'] = pkGivenLookupText($data['vehicle_registration_number'], 'vehicle_history', 'vehicle_registration_number');
			if(isset($data['date_of_vehicle_transfer'])) $data['date_of_vehicle_transfer'] = guessMySQLDateTime($data['date_of_vehicle_transfer']);
			if(isset($data['renewal_of_license'])) $data['renewal_of_license'] = date('Y-m-d H:i:s', strtotime($data['renewal_of_license']));
			if(isset($data['date_of_service'])) $data['date_of_service'] = pkGivenLookupText($data['date_of_service'], 'vehicle_history', 'date_of_service');
			if(isset($data['date_of_next_service'])) $data['date_of_next_service'] = date('Y-m-d H:i:s', strtotime($data['date_of_next_service']));
			if(isset($data['purchased_order_number'])) $data['purchased_order_number'] = pkGivenLookupText($data['purchased_order_number'], 'vehicle_history', 'purchased_order_number');
			if(isset($data['claim_code'])) $data['claim_code'] = pkGivenLookupText($data['claim_code'], 'vehicle_history', 'claim_code');
			if(isset($data['tyre_inspection_report'])) $data['tyre_inspection_report'] = pkGivenLookupText($data['tyre_inspection_report'], 'vehicle_history', 'tyre_inspection_report');
			if(isset($data['inspection_certification_number'])) $data['inspection_certification_number'] = pkGivenLookupText($data['inspection_certification_number'], 'vehicle_history', 'inspection_certification_number');
			if(isset($data['document_checklist_report'])) $data['document_checklist_report'] = pkGivenLookupText($data['document_checklist_report'], 'vehicle_history', 'document_checklist_report');
			if(isset($data['next_inspection_date'])) $data['next_inspection_date'] = pkGivenLookupText($data['next_inspection_date'], 'vehicle_history', 'next_inspection_date');
			if(isset($data['date_of_vehicle_breakdown'])) $data['date_of_vehicle_breakdown'] = guessMySQLDateTime($data['date_of_vehicle_breakdown']);
			if(isset($data['closing_km'])) $data['closing_km'] = pkGivenLookupText($data['closing_km'], 'vehicle_history', 'closing_km');
			if(isset($data['date_of_vehicle_reactivation'])) $data['date_of_vehicle_reactivation'] = guessMySQLDateTime($data['date_of_vehicle_reactivation']);
			if(isset($data['total_cost'])) $data['total_cost'] = pkGivenLookupText($data['total_cost'], 'vehicle_history', 'total_cost');
			if(isset($data['engine_number'])) $data['engine_number'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['engine_number'], 'vehicle_history', 'engine_number'));
			if(isset($data['purchased_price'])) $data['purchased_price'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['purchased_price'], 'vehicle_history', 'purchased_price'));
			if(isset($data['old_registration_number'])) $data['old_registration_number'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['old_registration_number'], 'vehicle_history', 'old_registration_number'));
			if(isset($data['renewal_of_license'])) $data['renewal_of_license'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['renewal_of_license'], 'vehicle_history', 'renewal_of_license'));
			if(isset($data['date_of_next_service'])) $data['date_of_next_service'] = thisOr($data['date_of_service'], pkGivenLookupText($data['date_of_next_service'], 'vehicle_history', 'date_of_next_service'));

			return $data;
		},
		'year_model' => function($data, $options = []) {

			return $data;
		},
		'month' => function($data, $options = []) {

			return $data;
		},
		'body_type' => function($data, $options = []) {

			return $data;
		},
		'vehicle_colour' => function($data, $options = []) {

			return $data;
		},
		'province' => function($data, $options = []) {

			return $data;
		},
		'departments' => function($data, $options = []) {

			return $data;
		},
		'districts' => function($data, $options = []) {

			return $data;
		},
		'application_status' => function($data, $options = []) {

			return $data;
		},
		'vehicle_payments' => function($data, $options = []) {
			if(isset($data['vehicle_registration_number'])) $data['vehicle_registration_number'] = pkGivenLookupText($data['vehicle_registration_number'], 'vehicle_payments', 'vehicle_registration_number');
			if(isset($data['closing_km'])) $data['closing_km'] = pkGivenLookupText($data['closing_km'], 'vehicle_payments', 'closing_km');
			if(isset($data['date_of_acquisition'])) $data['date_of_acquisition'] = guessMySQLDateTime($data['date_of_acquisition']);
			if(isset($data['merchant_name'])) $data['merchant_name'] = pkGivenLookupText($data['merchant_name'], 'vehicle_payments', 'merchant_name');
			if(isset($data['month_end'])) $data['month_end'] = guessMySQLDateTime($data['month_end']);
			if(isset($data['warranty_expires_on'])) $data['warranty_expires_on'] = guessMySQLDateTime($data['warranty_expires_on']);
			if(isset($data['engine_number'])) $data['engine_number'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['engine_number'], 'vehicle_payments', 'engine_number'));
			if(isset($data['chassis_number'])) $data['chassis_number'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['chassis_number'], 'vehicle_payments', 'chassis_number'));
			if(isset($data['make_of_vehicle'])) $data['make_of_vehicle'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['make_of_vehicle'], 'vehicle_payments', 'make_of_vehicle'));
			if(isset($data['model_of_vehicle'])) $data['model_of_vehicle'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['model_of_vehicle'], 'vehicle_payments', 'model_of_vehicle'));
			if(isset($data['year_model_of_vehicle'])) $data['year_model_of_vehicle'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['year_model_of_vehicle'], 'vehicle_payments', 'year_model_of_vehicle'));
			if(isset($data['type_of_vehicle'])) $data['type_of_vehicle'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['type_of_vehicle'], 'vehicle_payments', 'type_of_vehicle'));
			if(isset($data['application_status'])) $data['application_status'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['application_status'], 'vehicle_payments', 'application_status'));
			if(isset($data['barcode_number'])) $data['barcode_number'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['barcode_number'], 'vehicle_payments', 'barcode_number'));
			if(isset($data['department'])) $data['department'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['department'], 'vehicle_payments', 'department'));

			return $data;
		},
		'insurance_payments' => function($data, $options = []) {
			if(isset($data['vehicle_registration_number'])) $data['vehicle_registration_number'] = pkGivenLookupText($data['vehicle_registration_number'], 'insurance_payments', 'vehicle_registration_number');
			if(isset($data['insurance_expiration'])) $data['insurance_expiration'] = guessMySQLDateTime($data['insurance_expiration']);
			if(isset($data['transaction_date'])) $data['transaction_date'] = guessMySQLDateTime($data['transaction_date']);
			if(isset($data['merchant_name'])) $data['merchant_name'] = pkGivenLookupText($data['merchant_name'], 'insurance_payments', 'merchant_name');
			if(isset($data['month_end'])) $data['month_end'] = guessMySQLDateTime($data['month_end']);
			if(isset($data['engine_number'])) $data['engine_number'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['engine_number'], 'insurance_payments', 'engine_number'));
			if(isset($data['chassis_number'])) $data['chassis_number'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['chassis_number'], 'insurance_payments', 'chassis_number'));
			if(isset($data['make_of_vehicle'])) $data['make_of_vehicle'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['make_of_vehicle'], 'insurance_payments', 'make_of_vehicle'));
			if(isset($data['model_of_vehicle'])) $data['model_of_vehicle'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['model_of_vehicle'], 'insurance_payments', 'model_of_vehicle'));
			if(isset($data['year_model_of_vehicle'])) $data['year_model_of_vehicle'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['year_model_of_vehicle'], 'insurance_payments', 'year_model_of_vehicle'));
			if(isset($data['type_of_vehicle'])) $data['type_of_vehicle'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['type_of_vehicle'], 'insurance_payments', 'type_of_vehicle'));
			if(isset($data['application_status'])) $data['application_status'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['application_status'], 'insurance_payments', 'application_status'));
			if(isset($data['barcode_number'])) $data['barcode_number'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['barcode_number'], 'insurance_payments', 'barcode_number'));
			if(isset($data['department'])) $data['department'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['department'], 'insurance_payments', 'department'));

			return $data;
		},
		'authorizations' => function($data, $options = []) {
			if(isset($data['job_code'])) $data['job_code'] = pkGivenLookupText($data['job_code'], 'authorizations', 'job_code');
			if(isset($data['job_status'])) $data['job_status'] = pkGivenLookupText($data['job_status'], 'authorizations', 'job_status');
			if(isset($data['job_status_date'])) $data['job_status_date'] = guessMySQLDateTime($data['job_status_date']);
			if(isset($data['job_category'])) $data['job_category'] = pkGivenLookupText($data['job_category'], 'authorizations', 'job_category');
			if(isset($data['authorisation_date'])) $data['authorisation_date'] = guessMySQLDateTime($data['authorisation_date']);
			if(isset($data['vehicle_registration_number'])) $data['vehicle_registration_number'] = pkGivenLookupText($data['vehicle_registration_number'], 'authorizations', 'vehicle_registration_number');
			if(isset($data['client'])) $data['client'] = pkGivenLookupText($data['client'], 'authorizations', 'client');
			if(isset($data['province_name'])) $data['province_name'] = pkGivenLookupText($data['province_name'], 'authorizations', 'province_name');
			if(isset($data['merchant_code'])) $data['merchant_code'] = pkGivenLookupText($data['merchant_code'], 'authorizations', 'merchant_code');
			if(isset($data['total_claim'])) $data['total_claim'] = preg_replace('/[^\d\.]/', '', $data['total_claim']);
			if(isset($data['total_authorised'])) $data['total_authorised'] = preg_replace('/[^\d\.]/', '', $data['total_authorised']);
			if(isset($data['last_fuel_transaction_date'])) $data['last_fuel_transaction_date'] = guessMySQLDateTime($data['last_fuel_transaction_date']);
			if(isset($data['job_odometer'])) $data['job_odometer'] = thisOr($data['job_code'], pkGivenLookupText($data['job_odometer'], 'authorizations', 'job_odometer'));
			if(isset($data['instruction_note'])) $data['instruction_note'] = thisOr($data['job_code'], pkGivenLookupText($data['instruction_note'], 'authorizations', 'instruction_note'));
			if(isset($data['pre_authorisation_date'])) $data['pre_authorisation_date'] = thisOr($data['job_code'], pkGivenLookupText($data['pre_authorisation_date'], 'authorizations', 'pre_authorisation_date'));
			if(isset($data['make_of_vehicle'])) $data['make_of_vehicle'] = thisOr($data['job_code'], pkGivenLookupText($data['make_of_vehicle'], 'authorizations', 'make_of_vehicle'));
			if(isset($data['merchant_name'])) $data['merchant_name'] = thisOr($data['merchant_code'], pkGivenLookupText($data['merchant_name'], 'authorizations', 'merchant_name'));
			if(isset($data['merchant_contact_email'])) $data['merchant_contact_email'] = thisOr($data['merchant_code'], pkGivenLookupText($data['merchant_contact_email'], 'authorizations', 'merchant_contact_email'));
			if(isset($data['merchant_street_address'])) $data['merchant_street_address'] = thisOr($data['merchant_code'], pkGivenLookupText($data['merchant_street_address'], 'authorizations', 'merchant_street_address'));
			if(isset($data['merchant_suburb'])) $data['merchant_suburb'] = thisOr($data['merchant_code'], pkGivenLookupText($data['merchant_suburb'], 'authorizations', 'merchant_suburb'));
			if(isset($data['merchant_city'])) $data['merchant_city'] = thisOr($data['merchant_code'], pkGivenLookupText($data['merchant_city'], 'authorizations', 'merchant_city'));
			if(isset($data['merchant_address_code'])) $data['merchant_address_code'] = thisOr($data['merchant_code'], pkGivenLookupText($data['merchant_address_code'], 'authorizations', 'merchant_address_code'));
			if(isset($data['merchant_contact_details'])) $data['merchant_contact_details'] = thisOr($data['merchant_code'], pkGivenLookupText($data['merchant_contact_details'], 'authorizations', 'merchant_contact_details'));
			if(isset($data['total_claim'])) $data['total_claim'] = thisOr($data['job_code'], pkGivenLookupText($data['total_claim'], 'authorizations', 'total_claim'));
			if(isset($data['total_authorised'])) $data['total_authorised'] = thisOr($data['job_code'], pkGivenLookupText($data['total_authorised'], 'authorizations', 'total_authorised'));
			if(isset($data['authorization_number'])) $data['authorization_number'] = thisOr($data['job_code'], pkGivenLookupText($data['authorization_number'], 'authorizations', 'authorization_number'));

			return $data;
		},
		'service' => function($data, $options = []) {
			if(isset($data['service_item_type'])) $data['service_item_type'] = pkGivenLookupText($data['service_item_type'], 'service', 'service_item_type');
			if(isset($data['service_category'])) $data['service_category'] = pkGivenLookupText($data['service_category'], 'service', 'service_category');
			if(isset($data['merchant_name'])) $data['merchant_name'] = pkGivenLookupText($data['merchant_name'], 'service', 'merchant_name');
			if(isset($data['vehicle_registration_number'])) $data['vehicle_registration_number'] = pkGivenLookupText($data['vehicle_registration_number'], 'service', 'vehicle_registration_number');
			if(isset($data['dealer_name'])) $data['dealer_name'] = pkGivenLookupText($data['dealer_name'], 'service', 'dealer_name');
			if(isset($data['closing_km'])) $data['closing_km'] = pkGivenLookupText($data['closing_km'], 'service', 'closing_km');
			if(isset($data['work_allocation_reference_number'])) $data['work_allocation_reference_number'] = pkGivenLookupText($data['work_allocation_reference_number'], 'service', 'work_allocation_reference_number');
			if(isset($data['date_of_service'])) $data['date_of_service'] = pkGivenLookupText($data['date_of_service'], 'service', 'date_of_service');
			if(isset($data['date_of_next_service'])) $data['date_of_next_service'] = guessMySQLDateTime($data['date_of_next_service']);
			if(isset($data['receptionist'])) $data['receptionist'] = pkGivenLookupText($data['receptionist'], 'service', 'receptionist');
			if(isset($data['completion_date'])) $data['completion_date'] = guessMySQLDateTime($data['completion_date']);
			if(isset($data['due_date'])) $data['due_date'] = guessMySQLDateTime($data['due_date']);
			if(isset($data['filed'])) $data['filed'] = guessMySQLDateTime($data['filed']);
			if(isset($data['last_modified'])) $data['last_modified'] = guessMySQLDateTime($data['last_modified']);
			if(isset($data['engine_number'])) $data['engine_number'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['engine_number'], 'service', 'engine_number'));
			if(isset($data['chassis_number'])) $data['chassis_number'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['chassis_number'], 'service', 'chassis_number'));
			if(isset($data['make_of_vehicle'])) $data['make_of_vehicle'] = thisOr($data['dealer_name'], pkGivenLookupText($data['make_of_vehicle'], 'service', 'make_of_vehicle'));
			if(isset($data['model_of_vehicle'])) $data['model_of_vehicle'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['model_of_vehicle'], 'service', 'model_of_vehicle'));
			if(isset($data['year_model_of_vehicle'])) $data['year_model_of_vehicle'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['year_model_of_vehicle'], 'service', 'year_model_of_vehicle'));
			if(isset($data['type_of_vehicle'])) $data['type_of_vehicle'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['type_of_vehicle'], 'service', 'type_of_vehicle'));
			if(isset($data['application_status'])) $data['application_status'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['application_status'], 'service', 'application_status'));
			if(isset($data['barcode_number'])) $data['barcode_number'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['barcode_number'], 'service', 'barcode_number'));
			if(isset($data['department'])) $data['department'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['department'], 'service', 'department'));
			if(isset($data['time'])) $data['time'] = thisOr($data['date_of_service'], pkGivenLookupText($data['time'], 'service', 'time'));
			if(isset($data['receptionist_contact_email'])) $data['receptionist_contact_email'] = thisOr($data['receptionist'], pkGivenLookupText($data['receptionist_contact_email'], 'service', 'receptionist_contact_email'));
			if(isset($data['workshop_name'])) $data['workshop_name'] = thisOr($data['receptionist'], pkGivenLookupText($data['workshop_name'], 'service', 'workshop_name'));
			if(isset($data['job_card_number'])) $data['job_card_number'] = thisOr($data['receptionist'], pkGivenLookupText($data['job_card_number'], 'service', 'job_card_number'));

			return $data;
		},
		'service_type' => function($data, $options = []) {
			if(isset($data['service_item_type'])) $data['service_item_type'] = pkGivenLookupText($data['service_item_type'], 'service_type', 'service_item_type');
			if(isset($data['service_category'])) $data['service_category'] = pkGivenLookupText($data['service_category'], 'service_type', 'service_category');

			return $data;
		},
		'schedule' => function($data, $options = []) {
			if(isset($data['user_name_and_surname'])) $data['user_name_and_surname'] = pkGivenLookupText($data['user_name_and_surname'], 'schedule', 'user_name_and_surname');
			if(isset($data['service_item_type'])) $data['service_item_type'] = pkGivenLookupText($data['service_item_type'], 'schedule', 'service_item_type');
			if(isset($data['vehicle_registration_number'])) $data['vehicle_registration_number'] = pkGivenLookupText($data['vehicle_registration_number'], 'schedule', 'vehicle_registration_number');
			if(isset($data['closing_km'])) $data['closing_km'] = pkGivenLookupText($data['closing_km'], 'schedule', 'closing_km');
			if(isset($data['date'])) $data['date'] = guessMySQLDateTime($data['date']);
			if(isset($data['workshop_name'])) $data['workshop_name'] = pkGivenLookupText($data['workshop_name'], 'schedule', 'workshop_name');
			if(isset($data['user_contact_email'])) $data['user_contact_email'] = thisOr($data['user_name_and_surname'], pkGivenLookupText($data['user_contact_email'], 'schedule', 'user_contact_email'));
			if(isset($data['service_item_type_code'])) $data['service_item_type_code'] = thisOr($data['service_item_type'], pkGivenLookupText($data['service_item_type_code'], 'schedule', 'service_item_type_code'));
			if(isset($data['engine_number'])) $data['engine_number'] = thisOr($data['user_name_and_surname'], pkGivenLookupText($data['engine_number'], 'schedule', 'engine_number'));

			return $data;
		},
		'service_records' => function($data, $options = []) {
			if(isset($data['vehicle'])) $data['vehicle'] = pkGivenLookupText($data['vehicle'], 'service_records', 'vehicle');

			return $data;
		},
		'service_categories' => function($data, $options = []) {

			return $data;
		},
		'service_item_type' => function($data, $options = []) {

			return $data;
		},
		'service_item' => function($data, $options = []) {

			return $data;
		},
		'purchase_orders' => function($data, $options = []) {
			if(isset($data['purchased_date'])) $data['purchased_date'] = guessMySQLDateTime($data['purchased_date']);
			if(isset($data['vehicle_registration_number'])) $data['vehicle_registration_number'] = pkGivenLookupText($data['vehicle_registration_number'], 'purchase_orders', 'vehicle_registration_number');
			if(isset($data['manufacturer'])) $data['manufacturer'] = pkGivenLookupText($data['manufacturer'], 'purchase_orders', 'manufacturer');
			if(isset($data['service_category'])) $data['service_category'] = pkGivenLookupText($data['service_category'], 'purchase_orders', 'service_category');
			if(isset($data['due_date'])) $data['due_date'] = guessMySQLDateTime($data['due_date']);
			if(isset($data['merchant_name'])) $data['merchant_name'] = pkGivenLookupText($data['merchant_name'], 'purchase_orders', 'merchant_name');
			if(isset($data['date_of_service'])) $data['date_of_service'] = guessMySQLDateTime($data['date_of_service']);
			if(isset($data['closing_km'])) $data['closing_km'] = pkGivenLookupText($data['closing_km'], 'purchase_orders', 'closing_km');
			if(isset($data['part_number_1'])) $data['part_number_1'] = pkGivenLookupText($data['part_number_1'], 'purchase_orders', 'part_number_1');
			if(isset($data['part_name_1'])) $data['part_name_1'] = pkGivenLookupText($data['part_name_1'], 'purchase_orders', 'part_name_1');
			if(isset($data['part_manufacturer_name_1'])) $data['part_manufacturer_name_1'] = pkGivenLookupText($data['part_manufacturer_name_1'], 'purchase_orders', 'part_manufacturer_name_1');
			if(isset($data['part_number_2'])) $data['part_number_2'] = pkGivenLookupText($data['part_number_2'], 'purchase_orders', 'part_number_2');
			if(isset($data['part_name_2'])) $data['part_name_2'] = pkGivenLookupText($data['part_name_2'], 'purchase_orders', 'part_name_2');
			if(isset($data['part_manufacturer_name_2'])) $data['part_manufacturer_name_2'] = pkGivenLookupText($data['part_manufacturer_name_2'], 'purchase_orders', 'part_manufacturer_name_2');
			if(isset($data['part_number_3'])) $data['part_number_3'] = pkGivenLookupText($data['part_number_3'], 'purchase_orders', 'part_number_3');
			if(isset($data['part_manufacturer_name_3'])) $data['part_manufacturer_name_3'] = pkGivenLookupText($data['part_manufacturer_name_3'], 'purchase_orders', 'part_manufacturer_name_3');
			if(isset($data['part_number_4'])) $data['part_number_4'] = pkGivenLookupText($data['part_number_4'], 'purchase_orders', 'part_number_4');
			if(isset($data['part_manufacturer_name_4'])) $data['part_manufacturer_name_4'] = pkGivenLookupText($data['part_manufacturer_name_4'], 'purchase_orders', 'part_manufacturer_name_4');
			if(isset($data['part_number_5'])) $data['part_number_5'] = pkGivenLookupText($data['part_number_5'], 'purchase_orders', 'part_number_5');
			if(isset($data['part_manufacturer_name_5'])) $data['part_manufacturer_name_5'] = pkGivenLookupText($data['part_manufacturer_name_5'], 'purchase_orders', 'part_manufacturer_name_5');
			if(isset($data['part_number_6'])) $data['part_number_6'] = pkGivenLookupText($data['part_number_6'], 'purchase_orders', 'part_number_6');
			if(isset($data['part_name_6'])) $data['part_name_6'] = pkGivenLookupText($data['part_name_6'], 'purchase_orders', 'part_name_6');
			if(isset($data['part_manufacturer_name_6'])) $data['part_manufacturer_name_6'] = pkGivenLookupText($data['part_manufacturer_name_6'], 'purchase_orders', 'part_manufacturer_name_6');
			if(isset($data['part_number_7'])) $data['part_number_7'] = pkGivenLookupText($data['part_number_7'], 'purchase_orders', 'part_number_7');
			if(isset($data['part_name_7'])) $data['part_name_7'] = pkGivenLookupText($data['part_name_7'], 'purchase_orders', 'part_name_7');
			if(isset($data['part_manufacturer_name_7'])) $data['part_manufacturer_name_7'] = pkGivenLookupText($data['part_manufacturer_name_7'], 'purchase_orders', 'part_manufacturer_name_7');
			if(isset($data['part_number_8'])) $data['part_number_8'] = pkGivenLookupText($data['part_number_8'], 'purchase_orders', 'part_number_8');
			if(isset($data['part_name_8'])) $data['part_name_8'] = pkGivenLookupText($data['part_name_8'], 'purchase_orders', 'part_name_8');
			if(isset($data['part_manufacturer_name_8'])) $data['part_manufacturer_name_8'] = pkGivenLookupText($data['part_manufacturer_name_8'], 'purchase_orders', 'part_manufacturer_name_8');
			if(isset($data['workshop_name'])) $data['workshop_name'] = pkGivenLookupText($data['workshop_name'], 'purchase_orders', 'workshop_name');
			if(isset($data['work_order_id'])) $data['work_order_id'] = pkGivenLookupText($data['work_order_id'], 'purchase_orders', 'work_order_id');
			if(isset($data['job_card_number'])) $data['job_card_number'] = pkGivenLookupText($data['job_card_number'], 'purchase_orders', 'job_card_number');
			if(isset($data['completion_date'])) $data['completion_date'] = guessMySQLDateTime($data['completion_date']);
			if(isset($data['date_captured'])) $data['date_captured'] = guessMySQLDateTime($data['date_captured']);
			if(isset($data['type_of_vehicle'])) $data['type_of_vehicle'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['type_of_vehicle'], 'purchase_orders', 'type_of_vehicle'));
			if(isset($data['part_name_3'])) $data['part_name_3'] = thisOr($data['part_number_1'], pkGivenLookupText($data['part_name_3'], 'purchase_orders', 'part_name_3'));
			if(isset($data['part_name_4'])) $data['part_name_4'] = thisOr($data['part_number_1'], pkGivenLookupText($data['part_name_4'], 'purchase_orders', 'part_name_4'));
			if(isset($data['part_name_5'])) $data['part_name_5'] = thisOr($data['part_number_1'], pkGivenLookupText($data['part_name_5'], 'purchase_orders', 'part_name_5'));

			return $data;
		},
		'transmission' => function($data, $options = []) {

			return $data;
		},
		'fuel_type' => function($data, $options = []) {

			return $data;
		},
		'merchant' => function($data, $options = []) {
			if(isset($data['merchant_type'])) $data['merchant_type'] = pkGivenLookupText($data['merchant_type'], 'merchant', 'merchant_type');

			return $data;
		},
		'merchant_type' => function($data, $options = []) {

			return $data;
		},
		'manufacturer' => function($data, $options = []) {
			if(isset($data['manufacturer_type'])) $data['manufacturer_type'] = pkGivenLookupText($data['manufacturer_type'], 'manufacturer', 'manufacturer_type');

			return $data;
		},
		'manufacturer_type' => function($data, $options = []) {

			return $data;
		},
		'driver' => function($data, $options = []) {
			if(isset($data['drivers_contact_details'])) $data['drivers_contact_details'] = str_replace('-', '', $data['drivers_contact_details']);
			if(isset($data['drivers_license_expire_date'])) $data['drivers_license_expire_date'] = guessMySQLDateTime($data['drivers_license_expire_date']);
			if(isset($data['drivers_license_renewal_date'])) $data['drivers_license_renewal_date'] = guessMySQLDateTime($data['drivers_license_renewal_date']);
			if(isset($data['drivers_license_penalties_date'])) $data['drivers_license_penalties_date'] = guessMySQLDateTime($data['drivers_license_penalties_date']);

			return $data;
		},
		'accidents' => function($data, $options = []) {
			if(isset($data['vehicle_registration_number'])) $data['vehicle_registration_number'] = pkGivenLookupText($data['vehicle_registration_number'], 'accidents', 'vehicle_registration_number');
			if(isset($data['closing_km'])) $data['closing_km'] = pkGivenLookupText($data['closing_km'], 'accidents', 'closing_km');
			if(isset($data['drivers_surname'])) $data['drivers_surname'] = pkGivenLookupText($data['drivers_surname'], 'accidents', 'drivers_surname');
			if(isset($data['drivers_contact_details'])) $data['drivers_contact_details'] = str_replace('-', '', $data['drivers_contact_details']);
			if(isset($data['date_of_accident'])) $data['date_of_accident'] = guessMySQLDateTime($data['date_of_accident']);
			if(isset($data['district'])) $data['district'] = pkGivenLookupText($data['district'], 'accidents', 'district');
			if(isset($data['drivers_contact_details'])) $data['drivers_contact_details'] = thisOr($data['drivers_surname'], pkGivenLookupText($data['drivers_contact_details'], 'accidents', 'drivers_contact_details'));
			if(isset($data['dealer_name'])) $data['dealer_name'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['dealer_name'], 'accidents', 'dealer_name'));
			if(isset($data['model_of_vehicle'])) $data['model_of_vehicle'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['model_of_vehicle'], 'accidents', 'model_of_vehicle'));
			if(isset($data['location'])) $data['location'] = thisOr($data['district'], pkGivenLookupText($data['location'], 'accidents', 'location'));

			return $data;
		},
		'accident_type' => function($data, $options = []) {

			return $data;
		},
		'claim' => function($data, $options = []) {
			if(isset($data['claim_status'])) $data['claim_status'] = pkGivenLookupText($data['claim_status'], 'claim', 'claim_status');
			if(isset($data['claim_category'])) $data['claim_category'] = pkGivenLookupText($data['claim_category'], 'claim', 'claim_category');
			if(isset($data['cost_centre'])) $data['cost_centre'] = pkGivenLookupText($data['cost_centre'], 'claim', 'cost_centre');
			if(isset($data['department_name'])) $data['department_name'] = pkGivenLookupText($data['department_name'], 'claim', 'department_name');
			if(isset($data['district'])) $data['district'] = pkGivenLookupText($data['district'], 'claim', 'district');
			if(isset($data['province'])) $data['province'] = pkGivenLookupText($data['province'], 'claim', 'province');
			if(isset($data['merchant_name'])) $data['merchant_name'] = pkGivenLookupText($data['merchant_name'], 'claim', 'merchant_name');
			if(isset($data['vehicle_registration_number'])) $data['vehicle_registration_number'] = pkGivenLookupText($data['vehicle_registration_number'], 'claim', 'vehicle_registration_number');
			if(isset($data['closing_km'])) $data['closing_km'] = pkGivenLookupText($data['closing_km'], 'claim', 'closing_km');
			if(isset($data['pre_authorization_date'])) $data['pre_authorization_date'] = guessMySQLDateTime($data['pre_authorization_date']);
			if(isset($data['invoice_date'])) $data['invoice_date'] = guessMySQLDateTime($data['invoice_date']);
			if(isset($data['payment_date'])) $data['payment_date'] = guessMySQLDateTime($data['payment_date']);
			if(isset($data['vehicle_collected_date'])) $data['vehicle_collected_date'] = guessMySQLDateTime($data['vehicle_collected_date']);
			if(isset($data['model'])) $data['model'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['model'], 'claim', 'model'));

			return $data;
		},
		'claim_status' => function($data, $options = []) {

			return $data;
		},
		'claim_category' => function($data, $options = []) {

			return $data;
		},
		'cost_centre' => function($data, $options = []) {

			return $data;
		},
		'dealer' => function($data, $options = []) {
			if(isset($data['dealer_type'])) $data['dealer_type'] = pkGivenLookupText($data['dealer_type'], 'dealer', 'dealer_type');

			return $data;
		},
		'dealer_type' => function($data, $options = []) {

			return $data;
		},
		'tyre_log_sheet' => function($data, $options = []) {
			if(isset($data['vehicle_registration_number'])) $data['vehicle_registration_number'] = pkGivenLookupText($data['vehicle_registration_number'], 'tyre_log_sheet', 'vehicle_registration_number');
			if(isset($data['inspection_date'])) $data['inspection_date'] = guessMySQLDateTime($data['inspection_date']);

			return $data;
		},
		'vehicle_daily_check_list' => function($data, $options = []) {
			if(isset($data['vehicle_registration_number'])) $data['vehicle_registration_number'] = pkGivenLookupText($data['vehicle_registration_number'], 'vehicle_daily_check_list', 'vehicle_registration_number');
			if(isset($data['closing_km'])) $data['closing_km'] = pkGivenLookupText($data['closing_km'], 'vehicle_daily_check_list', 'closing_km');
			if(isset($data['next_inspection_date'])) $data['next_inspection_date'] = guessMySQLDateTime($data['next_inspection_date']);
			if(isset($data['drivers_surname'])) $data['drivers_surname'] = pkGivenLookupText($data['drivers_surname'], 'vehicle_daily_check_list', 'drivers_surname');
			if(isset($data['make_of_vehicle'])) $data['make_of_vehicle'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['make_of_vehicle'], 'vehicle_daily_check_list', 'make_of_vehicle'));
			if(isset($data['drivers_persal_number'])) $data['drivers_persal_number'] = thisOr($data['drivers_surname'], pkGivenLookupText($data['drivers_persal_number'], 'vehicle_daily_check_list', 'drivers_persal_number'));

			return $data;
		},
		'auditor' => function($data, $options = []) {
			if(isset($data['time_stmp'])) $data['time_stmp'] = guessMySQLDateTime($data['time_stmp']);

			return $data;
		},
		'parts' => function($data, $options = []) {
			if(isset($data['part_type'])) $data['part_type'] = pkGivenLookupText($data['part_type'], 'parts', 'part_type');
			if(isset($data['manufacturer'])) $data['manufacturer'] = pkGivenLookupText($data['manufacturer'], 'parts', 'manufacturer');
			if(isset($data['dealer'])) $data['dealer'] = pkGivenLookupText($data['dealer'], 'parts', 'dealer');

			return $data;
		},
		'parts_type' => function($data, $options = []) {

			return $data;
		},
		'breakdown_services' => function($data, $options = []) {
			if(isset($data['description_of_vehicle_breakdown_notes'])) $data['description_of_vehicle_breakdown_notes'] = pkGivenLookupText($data['description_of_vehicle_breakdown_notes'], 'breakdown_services', 'description_of_vehicle_breakdown_notes');
			if(isset($data['date_of_vehicle_breakdown'])) $data['date_of_vehicle_breakdown'] = guessMySQLDateTime($data['date_of_vehicle_breakdown']);
			if(isset($data['work_allocation_reference_number'])) $data['work_allocation_reference_number'] = pkGivenLookupText($data['work_allocation_reference_number'], 'breakdown_services', 'work_allocation_reference_number');
			if(isset($data['job_card_number'])) $data['job_card_number'] = pkGivenLookupText($data['job_card_number'], 'breakdown_services', 'job_card_number');
			if(isset($data['vehicle_registration_number'])) $data['vehicle_registration_number'] = pkGivenLookupText($data['vehicle_registration_number'], 'breakdown_services', 'vehicle_registration_number');
			if(isset($data['closing_km'])) $data['closing_km'] = pkGivenLookupText($data['closing_km'], 'breakdown_services', 'closing_km');
			if(isset($data['date_of_vehicle_reactivation'])) $data['date_of_vehicle_reactivation'] = guessMySQLDateTime($data['date_of_vehicle_reactivation']);
			if(isset($data['part_number'])) $data['part_number'] = pkGivenLookupText($data['part_number'], 'breakdown_services', 'part_number');
			if(isset($data['part_name'])) $data['part_name'] = pkGivenLookupText($data['part_name'], 'breakdown_services', 'part_name');
			if(isset($data['part_manufacturer_name'])) $data['part_manufacturer_name'] = pkGivenLookupText($data['part_manufacturer_name'], 'breakdown_services', 'part_manufacturer_name');
			if(isset($data['part_number_1'])) $data['part_number_1'] = pkGivenLookupText($data['part_number_1'], 'breakdown_services', 'part_number_1');
			if(isset($data['part_name_1'])) $data['part_name_1'] = pkGivenLookupText($data['part_name_1'], 'breakdown_services', 'part_name_1');
			if(isset($data['part_manufacturer_name_1'])) $data['part_manufacturer_name_1'] = pkGivenLookupText($data['part_manufacturer_name_1'], 'breakdown_services', 'part_manufacturer_name_1');
			if(isset($data['workshop_name'])) $data['workshop_name'] = pkGivenLookupText($data['workshop_name'], 'breakdown_services', 'workshop_name');
			if(isset($data['date_captured'])) $data['date_captured'] = guessMySQLDateTime($data['date_captured']);
			if(isset($data['engine_number'])) $data['engine_number'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['engine_number'], 'breakdown_services', 'engine_number'));
			if(isset($data['receptionist'])) $data['receptionist'] = thisOr($data['description_of_vehicle_breakdown_notes'], pkGivenLookupText($data['receptionist'], 'breakdown_services', 'receptionist'));
			if(isset($data['receptionist_contact_email'])) $data['receptionist_contact_email'] = thisOr($data['description_of_vehicle_breakdown_notes'], pkGivenLookupText($data['receptionist_contact_email'], 'breakdown_services', 'receptionist_contact_email'));

			return $data;
		},
		'modification_to_vehicle' => function($data, $options = []) {
			if(isset($data['type_of_vehicle'])) $data['type_of_vehicle'] = pkGivenLookupText($data['type_of_vehicle'], 'modification_to_vehicle', 'type_of_vehicle');
			if(isset($data['district'])) $data['district'] = pkGivenLookupText($data['district'], 'modification_to_vehicle', 'district');
			if(isset($data['drivers_name_and_surname'])) $data['drivers_name_and_surname'] = pkGivenLookupText($data['drivers_name_and_surname'], 'modification_to_vehicle', 'drivers_name_and_surname');
			if(isset($data['drivers_contact_details'])) $data['drivers_contact_details'] = str_replace('-', '', $data['drivers_contact_details']);
			if(isset($data['vehicle_registration_number'])) $data['vehicle_registration_number'] = pkGivenLookupText($data['vehicle_registration_number'], 'modification_to_vehicle', 'vehicle_registration_number');
			if(isset($data['closing_km'])) $data['closing_km'] = pkGivenLookupText($data['closing_km'], 'modification_to_vehicle', 'closing_km');
			if(isset($data['job_card_number'])) $data['job_card_number'] = pkGivenLookupText($data['job_card_number'], 'modification_to_vehicle', 'job_card_number');
			if(isset($data['valid_license_disc_date'])) $data['valid_license_disc_date'] = guessMySQLDateTime($data['valid_license_disc_date']);
			if(isset($data['date_checked_in'])) $data['date_checked_in'] = guessMySQLDateTime($data['date_checked_in']);
			if(isset($data['date_received'])) $data['date_received'] = guessMySQLDateTime($data['date_received']);
			if(isset($data['location'])) $data['location'] = thisOr($data['district'], pkGivenLookupText($data['location'], 'modification_to_vehicle', 'location'));
			if(isset($data['drivers_persal_number'])) $data['drivers_persal_number'] = thisOr($data['drivers_name_and_surname'], pkGivenLookupText($data['drivers_persal_number'], 'modification_to_vehicle', 'drivers_persal_number'));
			if(isset($data['drivers_contact_details'])) $data['drivers_contact_details'] = thisOr($data['drivers_name_and_surname'], pkGivenLookupText($data['drivers_contact_details'], 'modification_to_vehicle', 'drivers_contact_details'));
			if(isset($data['make_of_vehicle'])) $data['make_of_vehicle'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['make_of_vehicle'], 'modification_to_vehicle', 'make_of_vehicle'));
			if(isset($data['model_of_vehicle'])) $data['model_of_vehicle'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['model_of_vehicle'], 'modification_to_vehicle', 'model_of_vehicle'));

			return $data;
		},
		'vehicle_handing_over_checklist' => function($data, $options = []) {
			if(isset($data['vehicle_registration_number'])) $data['vehicle_registration_number'] = pkGivenLookupText($data['vehicle_registration_number'], 'vehicle_handing_over_checklist', 'vehicle_registration_number');
			if(isset($data['authorization_number'])) $data['authorization_number'] = pkGivenLookupText($data['authorization_number'], 'vehicle_handing_over_checklist', 'authorization_number');
			if(isset($data['authorization_date'])) $data['authorization_date'] = guessMySQLDateTime($data['authorization_date']);
			if(isset($data['driver_name_and_surname'])) $data['driver_name_and_surname'] = pkGivenLookupText($data['driver_name_and_surname'], 'vehicle_handing_over_checklist', 'driver_name_and_surname');
			if(isset($data['date_checked_in'])) $data['date_checked_in'] = guessMySQLDateTime($data['date_checked_in']);
			if(isset($data['closing_km'])) $data['closing_km'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['closing_km'], 'vehicle_handing_over_checklist', 'closing_km'));
			if(isset($data['make_of_vehicle'])) $data['make_of_vehicle'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['make_of_vehicle'], 'vehicle_handing_over_checklist', 'make_of_vehicle'));
			if(isset($data['model_of_vehicle'])) $data['model_of_vehicle'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['model_of_vehicle'], 'vehicle_handing_over_checklist', 'model_of_vehicle'));
			if(isset($data['driver_persal_number'])) $data['driver_persal_number'] = thisOr($data['driver_name_and_surname'], pkGivenLookupText($data['driver_persal_number'], 'vehicle_handing_over_checklist', 'driver_persal_number'));

			return $data;
		},
		'vehicle_return_check_list' => function($data, $options = []) {
			if(isset($data['vehicle_return_date'])) $data['vehicle_return_date'] = guessMySQLDateTime($data['vehicle_return_date']);
			if(isset($data['vehicle_registration_number'])) $data['vehicle_registration_number'] = pkGivenLookupText($data['vehicle_registration_number'], 'vehicle_return_check_list', 'vehicle_registration_number');
			if(isset($data['closing_km'])) $data['closing_km'] = pkGivenLookupText($data['closing_km'], 'vehicle_return_check_list', 'closing_km');
			if(isset($data['driver_name_and_surname'])) $data['driver_name_and_surname'] = pkGivenLookupText($data['driver_name_and_surname'], 'vehicle_return_check_list', 'driver_name_and_surname');
			if(isset($data['vehicle_return_date_signed'])) $data['vehicle_return_date_signed'] = guessMySQLDateTime($data['vehicle_return_date_signed']);
			if(isset($data['make_of_vehicle'])) $data['make_of_vehicle'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['make_of_vehicle'], 'vehicle_return_check_list', 'make_of_vehicle'));
			if(isset($data['model_of_vehicle'])) $data['model_of_vehicle'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['model_of_vehicle'], 'vehicle_return_check_list', 'model_of_vehicle'));
			if(isset($data['driver_persal_number'])) $data['driver_persal_number'] = thisOr($data['driver_name_and_surname'], pkGivenLookupText($data['driver_persal_number'], 'vehicle_return_check_list', 'driver_persal_number'));

			return $data;
		},
		'indicates_repair_damages_found_list' => function($data, $options = []) {
			if(isset($data['driver_name_and_surname'])) $data['driver_name_and_surname'] = pkGivenLookupText($data['driver_name_and_surname'], 'indicates_repair_damages_found_list', 'driver_name_and_surname');
			if(isset($data['vehicle_return_date_signed'])) $data['vehicle_return_date_signed'] = guessMySQLDateTime($data['vehicle_return_date_signed']);
			if(isset($data['vehicle_return_date_signed_by_representative'])) $data['vehicle_return_date_signed_by_representative'] = guessMySQLDateTime($data['vehicle_return_date_signed_by_representative']);
			if(isset($data['driver_persal_number'])) $data['driver_persal_number'] = thisOr($data['driver_name_and_surname'], pkGivenLookupText($data['driver_persal_number'], 'indicates_repair_damages_found_list', 'driver_persal_number'));

			return $data;
		},
		'forms' => function($data, $options = []) {

			return $data;
		},
		'identification_of_defects' => function($data, $options = []) {
			if(isset($data['vehicle_registration_number'])) $data['vehicle_registration_number'] = pkGivenLookupText($data['vehicle_registration_number'], 'identification_of_defects', 'vehicle_registration_number');
			if(isset($data['engine_number'])) $data['engine_number'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['engine_number'], 'identification_of_defects', 'engine_number'));
			if(isset($data['make_of_vehicle'])) $data['make_of_vehicle'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['make_of_vehicle'], 'identification_of_defects', 'make_of_vehicle'));

			return $data;
		},
		'gate_security' => function($data, $options = []) {
			if(isset($data['date_of_vehicle_entrance'])) $data['date_of_vehicle_entrance'] = guessMySQLDateTime($data['date_of_vehicle_entrance']);
			if(isset($data['vehicle_registration_number'])) $data['vehicle_registration_number'] = pkGivenLookupText($data['vehicle_registration_number'], 'gate_security', 'vehicle_registration_number');
			if(isset($data['date_of_vehicle_exit'])) $data['date_of_vehicle_exit'] = guessMySQLDateTime($data['date_of_vehicle_exit']);
			if(isset($data['engine_number'])) $data['engine_number'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['engine_number'], 'gate_security', 'engine_number'));
			if(isset($data['make_of_vehicle'])) $data['make_of_vehicle'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['make_of_vehicle'], 'gate_security', 'make_of_vehicle'));
			if(isset($data['vehicle_colour'])) $data['vehicle_colour'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['vehicle_colour'], 'gate_security', 'vehicle_colour'));

			return $data;
		},
		'reception' => function($data, $options = []) {
			if(isset($data['date_of_vehicle_entrance'])) $data['date_of_vehicle_entrance'] = guessMySQLDateTime($data['date_of_vehicle_entrance']);
			if(isset($data['district'])) $data['district'] = pkGivenLookupText($data['district'], 'reception', 'district');
			if(isset($data['vehicle_registration_number'])) $data['vehicle_registration_number'] = pkGivenLookupText($data['vehicle_registration_number'], 'reception', 'vehicle_registration_number');
			if(isset($data['date_of_vehicle_exit'])) $data['date_of_vehicle_exit'] = guessMySQLDateTime($data['date_of_vehicle_exit']);
			if(isset($data['location'])) $data['location'] = thisOr($data['district'], pkGivenLookupText($data['location'], 'reception', 'location'));
			if(isset($data['engine_number'])) $data['engine_number'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['engine_number'], 'reception', 'engine_number'));
			if(isset($data['make_of_vehicle'])) $data['make_of_vehicle'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['make_of_vehicle'], 'reception', 'make_of_vehicle'));

			return $data;
		},
		'inspection_bay' => function($data, $options = []) {
			if(isset($data['date_of_vehicle_entrance'])) $data['date_of_vehicle_entrance'] = guessMySQLDateTime($data['date_of_vehicle_entrance']);
			if(isset($data['job_card_number'])) $data['job_card_number'] = pkGivenLookupText($data['job_card_number'], 'inspection_bay', 'job_card_number');
			if(isset($data['vehicle_registration_number'])) $data['vehicle_registration_number'] = pkGivenLookupText($data['vehicle_registration_number'], 'inspection_bay', 'vehicle_registration_number');
			if(isset($data['work_allocation_reference_number'])) $data['work_allocation_reference_number'] = pkGivenLookupText($data['work_allocation_reference_number'], 'inspection_bay', 'work_allocation_reference_number');
			if(isset($data['date_of_vehicle_exit'])) $data['date_of_vehicle_exit'] = guessMySQLDateTime($data['date_of_vehicle_exit']);
			if(isset($data['engine_number'])) $data['engine_number'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['engine_number'], 'inspection_bay', 'engine_number'));
			if(isset($data['workshop_name'])) $data['workshop_name'] = thisOr($data['job_card_number'], pkGivenLookupText($data['workshop_name'], 'inspection_bay', 'workshop_name'));
			if(isset($data['make_of_vehicle'])) $data['make_of_vehicle'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['make_of_vehicle'], 'inspection_bay', 'make_of_vehicle'));

			return $data;
		},
		'work_allocation' => function($data, $options = []) {
			if(isset($data['district'])) $data['district'] = pkGivenLookupText($data['district'], 'work_allocation', 'district');
			if(isset($data['cost_centre'])) $data['cost_centre'] = pkGivenLookupText($data['cost_centre'], 'work_allocation', 'cost_centre');
			if(isset($data['vehicle_registration_number'])) $data['vehicle_registration_number'] = pkGivenLookupText($data['vehicle_registration_number'], 'work_allocation', 'vehicle_registration_number');
			if(isset($data['date_captured'])) $data['date_captured'] = guessMySQLDateTime($data['date_captured']);
			if(isset($data['location'])) $data['location'] = thisOr($data['district'], pkGivenLookupText($data['location'], 'work_allocation', 'location'));
			if(isset($data['engine_number'])) $data['engine_number'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['engine_number'], 'work_allocation', 'engine_number'));
			if(isset($data['make_of_vehicle'])) $data['make_of_vehicle'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['make_of_vehicle'], 'work_allocation', 'make_of_vehicle'));

			return $data;
		},
		'internal_repairs_mechanical' => function($data, $options = []) {
			if(isset($data['workshop_name'])) $data['workshop_name'] = pkGivenLookupText($data['workshop_name'], 'internal_repairs_mechanical', 'workshop_name');
			if(isset($data['artisan_note_of_starting_time'])) $data['artisan_note_of_starting_time'] = guessMySQLDateTime($data['artisan_note_of_starting_time']);
			if(isset($data['job_card_number'])) $data['job_card_number'] = pkGivenLookupText($data['job_card_number'], 'internal_repairs_mechanical', 'job_card_number');
			if(isset($data['work_allocation_reference_number'])) $data['work_allocation_reference_number'] = pkGivenLookupText($data['work_allocation_reference_number'], 'internal_repairs_mechanical', 'work_allocation_reference_number');
			if(isset($data['vehicle_registration_number'])) $data['vehicle_registration_number'] = pkGivenLookupText($data['vehicle_registration_number'], 'internal_repairs_mechanical', 'vehicle_registration_number');
			if(isset($data['make_of_vehicle'])) $data['make_of_vehicle'] = pkGivenLookupText($data['make_of_vehicle'], 'internal_repairs_mechanical', 'make_of_vehicle');
			if(isset($data['artisan_note_of_completion_time'])) $data['artisan_note_of_completion_time'] = guessMySQLDateTime($data['artisan_note_of_completion_time']);
			if(isset($data['inspection_bay_lane_number'])) $data['inspection_bay_lane_number'] = pkGivenLookupText($data['inspection_bay_lane_number'], 'internal_repairs_mechanical', 'inspection_bay_lane_number');
			if(isset($data['engine_number'])) $data['engine_number'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['engine_number'], 'internal_repairs_mechanical', 'engine_number'));

			return $data;
		},
		'external_repairs_mechanical' => function($data, $options = []) {
			if(isset($data['service_provider_name'])) $data['service_provider_name'] = pkGivenLookupText($data['service_provider_name'], 'external_repairs_mechanical', 'service_provider_name');
			if(isset($data['service_provider_type'])) $data['service_provider_type'] = pkGivenLookupText($data['service_provider_type'], 'external_repairs_mechanical', 'service_provider_type');
			if(isset($data['service_provider_contact_details'])) $data['service_provider_contact_details'] = pkGivenLookupText($data['service_provider_contact_details'], 'external_repairs_mechanical', 'service_provider_contact_details');
			if(isset($data['service_provider_address'])) $data['service_provider_address'] = pkGivenLookupText($data['service_provider_address'], 'external_repairs_mechanical', 'service_provider_address');
			if(isset($data['merchant_type'])) $data['merchant_type'] = pkGivenLookupText($data['merchant_type'], 'external_repairs_mechanical', 'merchant_type');
			if(isset($data['merchant_code'])) $data['merchant_code'] = pkGivenLookupText($data['merchant_code'], 'external_repairs_mechanical', 'merchant_code');
			if(isset($data['merchant_name'])) $data['merchant_name'] = pkGivenLookupText($data['merchant_name'], 'external_repairs_mechanical', 'merchant_name');
			if(isset($data['merchant_contacts_details'])) $data['merchant_contacts_details'] = pkGivenLookupText($data['merchant_contacts_details'], 'external_repairs_mechanical', 'merchant_contacts_details');
			if(isset($data['merchant_email_address'])) $data['merchant_email_address'] = pkGivenLookupText($data['merchant_email_address'], 'external_repairs_mechanical', 'merchant_email_address');
			if(isset($data['merchant_address'])) $data['merchant_address'] = pkGivenLookupText($data['merchant_address'], 'external_repairs_mechanical', 'merchant_address');
			if(isset($data['merchant_address_code'])) $data['merchant_address_code'] = pkGivenLookupText($data['merchant_address_code'], 'external_repairs_mechanical', 'merchant_address_code');
			if(isset($data['date_of_vehicle_send'])) $data['date_of_vehicle_send'] = guessMySQLDateTime($data['date_of_vehicle_send']);
			if(isset($data['authorization_number'])) $data['authorization_number'] = pkGivenLookupText($data['authorization_number'], 'external_repairs_mechanical', 'authorization_number');
			if(isset($data['instruction_note'])) $data['instruction_note'] = pkGivenLookupText($data['instruction_note'], 'external_repairs_mechanical', 'instruction_note');
			if(isset($data['work_allocation_reference_number'])) $data['work_allocation_reference_number'] = pkGivenLookupText($data['work_allocation_reference_number'], 'external_repairs_mechanical', 'work_allocation_reference_number');
			if(isset($data['vehicle_registration_number'])) $data['vehicle_registration_number'] = pkGivenLookupText($data['vehicle_registration_number'], 'external_repairs_mechanical', 'vehicle_registration_number');
			if(isset($data['date_of_vehicle_received'])) $data['date_of_vehicle_received'] = guessMySQLDateTime($data['date_of_vehicle_received']);
			if(isset($data['engine_number'])) $data['engine_number'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['engine_number'], 'external_repairs_mechanical', 'engine_number'));
			if(isset($data['make_of_vehicle'])) $data['make_of_vehicle'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['make_of_vehicle'], 'external_repairs_mechanical', 'make_of_vehicle'));

			return $data;
		},
		'internal_repairs_body' => function($data, $options = []) {
			if(isset($data['driver_name_and_surname'])) $data['driver_name_and_surname'] = pkGivenLookupText($data['driver_name_and_surname'], 'internal_repairs_body', 'driver_name_and_surname');
			if(isset($data['vehicle_registration_number'])) $data['vehicle_registration_number'] = pkGivenLookupText($data['vehicle_registration_number'], 'internal_repairs_body', 'vehicle_registration_number');
			if(isset($data['job_card_number'])) $data['job_card_number'] = pkGivenLookupText($data['job_card_number'], 'internal_repairs_body', 'job_card_number');
			if(isset($data['work_allocation_reference_number'])) $data['work_allocation_reference_number'] = pkGivenLookupText($data['work_allocation_reference_number'], 'internal_repairs_body', 'work_allocation_reference_number');
			if(isset($data['artisan_note_of_starting_time'])) $data['artisan_note_of_starting_time'] = guessMySQLDateTime($data['artisan_note_of_starting_time']);
			if(isset($data['government_garage_name'])) $data['government_garage_name'] = pkGivenLookupText($data['government_garage_name'], 'internal_repairs_body', 'government_garage_name');
			if(isset($data['artisan_note_of_completion_time'])) $data['artisan_note_of_completion_time'] = guessMySQLDateTime($data['artisan_note_of_completion_time']);
			if(isset($data['driver_persal_number'])) $data['driver_persal_number'] = thisOr($data['driver_name_and_surname'], pkGivenLookupText($data['driver_persal_number'], 'internal_repairs_body', 'driver_persal_number'));
			if(isset($data['driver_contacts_details'])) $data['driver_contacts_details'] = thisOr($data['driver_name_and_surname'], pkGivenLookupText($data['driver_contacts_details'], 'internal_repairs_body', 'driver_contacts_details'));
			if(isset($data['driver_email_address'])) $data['driver_email_address'] = thisOr($data['driver_name_and_surname'], pkGivenLookupText($data['driver_email_address'], 'internal_repairs_body', 'driver_email_address'));
			if(isset($data['driver_license_code'])) $data['driver_license_code'] = thisOr($data['driver_name_and_surname'], pkGivenLookupText($data['driver_license_code'], 'internal_repairs_body', 'driver_license_code'));
			if(isset($data['driver_license_number'])) $data['driver_license_number'] = thisOr($data['driver_name_and_surname'], pkGivenLookupText($data['driver_license_number'], 'internal_repairs_body', 'driver_license_number'));
			if(isset($data['engine_number'])) $data['engine_number'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['engine_number'], 'internal_repairs_body', 'engine_number'));
			if(isset($data['make_of_vehicle'])) $data['make_of_vehicle'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['make_of_vehicle'], 'internal_repairs_body', 'make_of_vehicle'));

			return $data;
		},
		'external_repairs_body' => function($data, $options = []) {
			if(isset($data['service_provider_name'])) $data['service_provider_name'] = pkGivenLookupText($data['service_provider_name'], 'external_repairs_body', 'service_provider_name');
			if(isset($data['service_provider_type'])) $data['service_provider_type'] = pkGivenLookupText($data['service_provider_type'], 'external_repairs_body', 'service_provider_type');
			if(isset($data['service_provider_contact_details'])) $data['service_provider_contact_details'] = pkGivenLookupText($data['service_provider_contact_details'], 'external_repairs_body', 'service_provider_contact_details');
			if(isset($data['service_provider_address'])) $data['service_provider_address'] = pkGivenLookupText($data['service_provider_address'], 'external_repairs_body', 'service_provider_address');
			if(isset($data['service_provider_branch'])) $data['service_provider_branch'] = pkGivenLookupText($data['service_provider_branch'], 'external_repairs_body', 'service_provider_branch');
			if(isset($data['service_provider_branch_code'])) $data['service_provider_branch_code'] = pkGivenLookupText($data['service_provider_branch_code'], 'external_repairs_body', 'service_provider_branch_code');
			if(isset($data['instruction_note'])) $data['instruction_note'] = pkGivenLookupText($data['instruction_note'], 'external_repairs_body', 'instruction_note');
			if(isset($data['vehicle_registration_number'])) $data['vehicle_registration_number'] = pkGivenLookupText($data['vehicle_registration_number'], 'external_repairs_body', 'vehicle_registration_number');
			if(isset($data['merchant_type'])) $data['merchant_type'] = pkGivenLookupText($data['merchant_type'], 'external_repairs_body', 'merchant_type');
			if(isset($data['merchant_code'])) $data['merchant_code'] = pkGivenLookupText($data['merchant_code'], 'external_repairs_body', 'merchant_code');
			if(isset($data['merchant_name'])) $data['merchant_name'] = pkGivenLookupText($data['merchant_name'], 'external_repairs_body', 'merchant_name');
			if(isset($data['merchant_contacts_details'])) $data['merchant_contacts_details'] = pkGivenLookupText($data['merchant_contacts_details'], 'external_repairs_body', 'merchant_contacts_details');
			if(isset($data['merchant_address'])) $data['merchant_address'] = pkGivenLookupText($data['merchant_address'], 'external_repairs_body', 'merchant_address');
			if(isset($data['merchant_address_code'])) $data['merchant_address_code'] = pkGivenLookupText($data['merchant_address_code'], 'external_repairs_body', 'merchant_address_code');
			if(isset($data['merchant_city'])) $data['merchant_city'] = pkGivenLookupText($data['merchant_city'], 'external_repairs_body', 'merchant_city');
			if(isset($data['authorization_number'])) $data['authorization_number'] = thisOr($data['instruction_note'], pkGivenLookupText($data['authorization_number'], 'external_repairs_body', 'authorization_number'));
			if(isset($data['engine_number'])) $data['engine_number'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['engine_number'], 'external_repairs_body', 'engine_number'));
			if(isset($data['make_of_vehicle'])) $data['make_of_vehicle'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['make_of_vehicle'], 'external_repairs_body', 'make_of_vehicle'));
			if(isset($data['vehicle_colour'])) $data['vehicle_colour'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['vehicle_colour'], 'external_repairs_body', 'vehicle_colour'));

			return $data;
		},
		'ordering_of_spares_for_internal_repairs' => function($data, $options = []) {
			if(isset($data['workshop_name'])) $data['workshop_name'] = pkGivenLookupText($data['workshop_name'], 'ordering_of_spares_for_internal_repairs', 'workshop_name');
			if(isset($data['job_card_number'])) $data['job_card_number'] = pkGivenLookupText($data['job_card_number'], 'ordering_of_spares_for_internal_repairs', 'job_card_number');
			if(isset($data['date_parts_ordered'])) $data['date_parts_ordered'] = guessMySQLDateTime($data['date_parts_ordered']);
			if(isset($data['vehicle_registration_number'])) $data['vehicle_registration_number'] = pkGivenLookupText($data['vehicle_registration_number'], 'ordering_of_spares_for_internal_repairs', 'vehicle_registration_number');
			if(isset($data['part_type_1'])) $data['part_type_1'] = pkGivenLookupText($data['part_type_1'], 'ordering_of_spares_for_internal_repairs', 'part_type_1');
			if(isset($data['part_name_1'])) $data['part_name_1'] = pkGivenLookupText($data['part_name_1'], 'ordering_of_spares_for_internal_repairs', 'part_name_1');
			if(isset($data['description_1'])) $data['description_1'] = pkGivenLookupText($data['description_1'], 'ordering_of_spares_for_internal_repairs', 'description_1');
			if(isset($data['manufacture_1'])) $data['manufacture_1'] = pkGivenLookupText($data['manufacture_1'], 'ordering_of_spares_for_internal_repairs', 'manufacture_1');
			if(isset($data['unit_price_1'])) $data['unit_price_1'] = preg_replace('/[^\d\.]/', '', $data['unit_price_1']);
			if(isset($data['net_part_price_1'])) $data['net_part_price_1'] = preg_replace('/[^\d\.]/', '', $data['net_part_price_1']);
			if(isset($data['part_type_2'])) $data['part_type_2'] = pkGivenLookupText($data['part_type_2'], 'ordering_of_spares_for_internal_repairs', 'part_type_2');
			if(isset($data['part_name_2'])) $data['part_name_2'] = pkGivenLookupText($data['part_name_2'], 'ordering_of_spares_for_internal_repairs', 'part_name_2');
			if(isset($data['description_2'])) $data['description_2'] = pkGivenLookupText($data['description_2'], 'ordering_of_spares_for_internal_repairs', 'description_2');
			if(isset($data['manufacture_2'])) $data['manufacture_2'] = pkGivenLookupText($data['manufacture_2'], 'ordering_of_spares_for_internal_repairs', 'manufacture_2');
			if(isset($data['unit_price_2'])) $data['unit_price_2'] = preg_replace('/[^\d\.]/', '', $data['unit_price_2']);
			if(isset($data['net_part_price_2'])) $data['net_part_price_2'] = preg_replace('/[^\d\.]/', '', $data['net_part_price_2']);
			if(isset($data['part_type_3'])) $data['part_type_3'] = pkGivenLookupText($data['part_type_3'], 'ordering_of_spares_for_internal_repairs', 'part_type_3');
			if(isset($data['part_name_3'])) $data['part_name_3'] = pkGivenLookupText($data['part_name_3'], 'ordering_of_spares_for_internal_repairs', 'part_name_3');
			if(isset($data['description_3'])) $data['description_3'] = pkGivenLookupText($data['description_3'], 'ordering_of_spares_for_internal_repairs', 'description_3');
			if(isset($data['manufacture_3'])) $data['manufacture_3'] = pkGivenLookupText($data['manufacture_3'], 'ordering_of_spares_for_internal_repairs', 'manufacture_3');
			if(isset($data['unit_price_3'])) $data['unit_price_3'] = preg_replace('/[^\d\.]/', '', $data['unit_price_3']);
			if(isset($data['net_part_price_3'])) $data['net_part_price_3'] = preg_replace('/[^\d\.]/', '', $data['net_part_price_3']);
			if(isset($data['part_type_4'])) $data['part_type_4'] = pkGivenLookupText($data['part_type_4'], 'ordering_of_spares_for_internal_repairs', 'part_type_4');
			if(isset($data['part_name_4'])) $data['part_name_4'] = pkGivenLookupText($data['part_name_4'], 'ordering_of_spares_for_internal_repairs', 'part_name_4');
			if(isset($data['description_4'])) $data['description_4'] = pkGivenLookupText($data['description_4'], 'ordering_of_spares_for_internal_repairs', 'description_4');
			if(isset($data['manufacture_4'])) $data['manufacture_4'] = pkGivenLookupText($data['manufacture_4'], 'ordering_of_spares_for_internal_repairs', 'manufacture_4');
			if(isset($data['unit_price_4'])) $data['unit_price_4'] = preg_replace('/[^\d\.]/', '', $data['unit_price_4']);
			if(isset($data['net_part_price_4'])) $data['net_part_price_4'] = preg_replace('/[^\d\.]/', '', $data['net_part_price_4']);
			if(isset($data['part_type_5'])) $data['part_type_5'] = pkGivenLookupText($data['part_type_5'], 'ordering_of_spares_for_internal_repairs', 'part_type_5');
			if(isset($data['part_name_5'])) $data['part_name_5'] = pkGivenLookupText($data['part_name_5'], 'ordering_of_spares_for_internal_repairs', 'part_name_5');
			if(isset($data['description_5'])) $data['description_5'] = pkGivenLookupText($data['description_5'], 'ordering_of_spares_for_internal_repairs', 'description_5');
			if(isset($data['manufacture_5'])) $data['manufacture_5'] = pkGivenLookupText($data['manufacture_5'], 'ordering_of_spares_for_internal_repairs', 'manufacture_5');
			if(isset($data['unit_price_5'])) $data['unit_price_5'] = preg_replace('/[^\d\.]/', '', $data['unit_price_5']);
			if(isset($data['net_part_price_5'])) $data['net_part_price_5'] = preg_replace('/[^\d\.]/', '', $data['net_part_price_5']);
			if(isset($data['part_type_6'])) $data['part_type_6'] = pkGivenLookupText($data['part_type_6'], 'ordering_of_spares_for_internal_repairs', 'part_type_6');
			if(isset($data['part_name_6'])) $data['part_name_6'] = pkGivenLookupText($data['part_name_6'], 'ordering_of_spares_for_internal_repairs', 'part_name_6');
			if(isset($data['description_6'])) $data['description_6'] = pkGivenLookupText($data['description_6'], 'ordering_of_spares_for_internal_repairs', 'description_6');
			if(isset($data['manufacture_6'])) $data['manufacture_6'] = pkGivenLookupText($data['manufacture_6'], 'ordering_of_spares_for_internal_repairs', 'manufacture_6');
			if(isset($data['unit_price_6'])) $data['unit_price_6'] = preg_replace('/[^\d\.]/', '', $data['unit_price_6']);
			if(isset($data['net_part_price_6'])) $data['net_part_price_6'] = preg_replace('/[^\d\.]/', '', $data['net_part_price_6']);
			if(isset($data['part_type_7'])) $data['part_type_7'] = pkGivenLookupText($data['part_type_7'], 'ordering_of_spares_for_internal_repairs', 'part_type_7');
			if(isset($data['part_name_7'])) $data['part_name_7'] = pkGivenLookupText($data['part_name_7'], 'ordering_of_spares_for_internal_repairs', 'part_name_7');
			if(isset($data['description_7'])) $data['description_7'] = pkGivenLookupText($data['description_7'], 'ordering_of_spares_for_internal_repairs', 'description_7');
			if(isset($data['manufacture_7'])) $data['manufacture_7'] = pkGivenLookupText($data['manufacture_7'], 'ordering_of_spares_for_internal_repairs', 'manufacture_7');
			if(isset($data['unit_price_7'])) $data['unit_price_7'] = preg_replace('/[^\d\.]/', '', $data['unit_price_7']);
			if(isset($data['net_part_price_7'])) $data['net_part_price_7'] = preg_replace('/[^\d\.]/', '', $data['net_part_price_7']);
			if(isset($data['part_type_8'])) $data['part_type_8'] = pkGivenLookupText($data['part_type_8'], 'ordering_of_spares_for_internal_repairs', 'part_type_8');
			if(isset($data['part_name_8'])) $data['part_name_8'] = pkGivenLookupText($data['part_name_8'], 'ordering_of_spares_for_internal_repairs', 'part_name_8');
			if(isset($data['description_8'])) $data['description_8'] = pkGivenLookupText($data['description_8'], 'ordering_of_spares_for_internal_repairs', 'description_8');
			if(isset($data['manufacture_8'])) $data['manufacture_8'] = pkGivenLookupText($data['manufacture_8'], 'ordering_of_spares_for_internal_repairs', 'manufacture_8');
			if(isset($data['unit_price_8'])) $data['unit_price_8'] = preg_replace('/[^\d\.]/', '', $data['unit_price_8']);
			if(isset($data['net_part_price_8'])) $data['net_part_price_8'] = preg_replace('/[^\d\.]/', '', $data['net_part_price_8']);
			if(isset($data['total_amount'])) $data['total_amount'] = preg_replace('/[^\d\.]/', '', $data['total_amount']);
			if(isset($data['work_allocation_reference_number'])) $data['work_allocation_reference_number'] = pkGivenLookupText($data['work_allocation_reference_number'], 'ordering_of_spares_for_internal_repairs', 'work_allocation_reference_number');
			if(isset($data['date_parts_received'])) $data['date_parts_received'] = guessMySQLDateTime($data['date_parts_received']);
			if(isset($data['engine_number'])) $data['engine_number'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['engine_number'], 'ordering_of_spares_for_internal_repairs', 'engine_number'));
			if(isset($data['make_of_vehicle'])) $data['make_of_vehicle'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['make_of_vehicle'], 'ordering_of_spares_for_internal_repairs', 'make_of_vehicle'));

			return $data;
		},
		'collection_of_repaired_vehicles' => function($data, $options = []) {
			if(isset($data['reception_name_and_surname'])) $data['reception_name_and_surname'] = pkGivenLookupText($data['reception_name_and_surname'], 'collection_of_repaired_vehicles', 'reception_name_and_surname');
			if(isset($data['driver_name_and_surname'])) $data['driver_name_and_surname'] = pkGivenLookupText($data['driver_name_and_surname'], 'collection_of_repaired_vehicles', 'driver_name_and_surname');
			if(isset($data['government_garage_name'])) $data['government_garage_name'] = pkGivenLookupText($data['government_garage_name'], 'collection_of_repaired_vehicles', 'government_garage_name');
			if(isset($data['vehicle_registration_number'])) $data['vehicle_registration_number'] = pkGivenLookupText($data['vehicle_registration_number'], 'collection_of_repaired_vehicles', 'vehicle_registration_number');
			if(isset($data['sign_off_time'])) $data['sign_off_time'] = mysql_datetime($data['sign_off_time'], 'd/m/Y', 'h:i:s a');
			if(isset($data['date_of_repaired_vehicle_collection'])) $data['date_of_repaired_vehicle_collection'] = guessMySQLDateTime($data['date_of_repaired_vehicle_collection']);
			if(isset($data['reception_persal_number'])) $data['reception_persal_number'] = thisOr($data['reception_name_and_surname'], pkGivenLookupText($data['reception_persal_number'], 'collection_of_repaired_vehicles', 'reception_persal_number'));
			if(isset($data['reception_contact_details'])) $data['reception_contact_details'] = thisOr($data['reception_name_and_surname'], pkGivenLookupText($data['reception_contact_details'], 'collection_of_repaired_vehicles', 'reception_contact_details'));
			if(isset($data['reception_email_address'])) $data['reception_email_address'] = thisOr($data['reception_name_and_surname'], pkGivenLookupText($data['reception_email_address'], 'collection_of_repaired_vehicles', 'reception_email_address'));
			if(isset($data['driver_persal_number'])) $data['driver_persal_number'] = thisOr($data['driver_name_and_surname'], pkGivenLookupText($data['driver_persal_number'], 'collection_of_repaired_vehicles', 'driver_persal_number'));
			if(isset($data['driver_contacts_details'])) $data['driver_contacts_details'] = thisOr($data['driver_name_and_surname'], pkGivenLookupText($data['driver_contacts_details'], 'collection_of_repaired_vehicles', 'driver_contacts_details'));
			if(isset($data['driver_email_address'])) $data['driver_email_address'] = thisOr($data['driver_name_and_surname'], pkGivenLookupText($data['driver_email_address'], 'collection_of_repaired_vehicles', 'driver_email_address'));
			if(isset($data['engine_number'])) $data['engine_number'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['engine_number'], 'collection_of_repaired_vehicles', 'engine_number'));
			if(isset($data['make_of_vehicle'])) $data['make_of_vehicle'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['make_of_vehicle'], 'collection_of_repaired_vehicles', 'make_of_vehicle'));

			return $data;
		},
		'withdrawal_vehicle_from_operation' => function($data, $options = []) {
			if(isset($data['vehicle_registration_number'])) $data['vehicle_registration_number'] = pkGivenLookupText($data['vehicle_registration_number'], 'withdrawal_vehicle_from_operation', 'vehicle_registration_number');
			if(isset($data['date_of_service'])) $data['date_of_service'] = pkGivenLookupText($data['date_of_service'], 'withdrawal_vehicle_from_operation', 'date_of_service');
			if(isset($data['date_of_vehicle'])) $data['date_of_vehicle'] = guessMySQLDateTime($data['date_of_vehicle']);
			if(isset($data['engine_number'])) $data['engine_number'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['engine_number'], 'withdrawal_vehicle_from_operation', 'engine_number'));
			if(isset($data['make_of_vehicle'])) $data['make_of_vehicle'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['make_of_vehicle'], 'withdrawal_vehicle_from_operation', 'make_of_vehicle'));
			if(isset($data['purchased_price'])) $data['purchased_price'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['purchased_price'], 'withdrawal_vehicle_from_operation', 'purchased_price'));
			if(isset($data['date_of_next_service'])) $data['date_of_next_service'] = thisOr($data['date_of_service'], pkGivenLookupText($data['date_of_next_service'], 'withdrawal_vehicle_from_operation', 'date_of_next_service'));
			if(isset($data['renewal_of_license'])) $data['renewal_of_license'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['renewal_of_license'], 'withdrawal_vehicle_from_operation', 'renewal_of_license'));

			return $data;
		},
		'costing' => function($data, $options = []) {
			if(isset($data['government_garage_name'])) $data['government_garage_name'] = pkGivenLookupText($data['government_garage_name'], 'costing', 'government_garage_name');
			if(isset($data['job_card_number'])) $data['job_card_number'] = pkGivenLookupText($data['job_card_number'], 'costing', 'job_card_number');
			if(isset($data['vehicle_registration_number'])) $data['vehicle_registration_number'] = pkGivenLookupText($data['vehicle_registration_number'], 'costing', 'vehicle_registration_number');
			if(isset($data['invoice_date'])) $data['invoice_date'] = guessMySQLDateTime($data['invoice_date']);
			if(isset($data['engine_number'])) $data['engine_number'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['engine_number'], 'costing', 'engine_number'));
			if(isset($data['make_of_vehicle'])) $data['make_of_vehicle'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['make_of_vehicle'], 'costing', 'make_of_vehicle'));

			return $data;
		},
		'billing' => function($data, $options = []) {
			if(isset($data['district'])) $data['district'] = pkGivenLookupText($data['district'], 'billing', 'district');
			if(isset($data['job_card_number'])) $data['job_card_number'] = pkGivenLookupText($data['job_card_number'], 'billing', 'job_card_number');
			if(isset($data['invoice_date'])) $data['invoice_date'] = guessMySQLDateTime($data['invoice_date']);
			if(isset($data['vehicle_registration_number'])) $data['vehicle_registration_number'] = pkGivenLookupText($data['vehicle_registration_number'], 'billing', 'vehicle_registration_number');
			if(isset($data['location'])) $data['location'] = thisOr($data['district'], pkGivenLookupText($data['location'], 'billing', 'location'));
			if(isset($data['engine_number'])) $data['engine_number'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['engine_number'], 'billing', 'engine_number'));
			if(isset($data['make_of_vehicle'])) $data['make_of_vehicle'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['make_of_vehicle'], 'billing', 'make_of_vehicle'));

			return $data;
		},
		'general_control_measures' => function($data, $options = []) {
			if(isset($data['district'])) $data['district'] = pkGivenLookupText($data['district'], 'general_control_measures', 'district');
			if(isset($data['cost_centre'])) $data['cost_centre'] = pkGivenLookupText($data['cost_centre'], 'general_control_measures', 'cost_centre');
			if(isset($data['location'])) $data['location'] = thisOr($data['district'], pkGivenLookupText($data['location'], 'general_control_measures', 'location'));

			return $data;
		},
		'movement_of_personnel_in_government_garage_and_workshops' => function($data, $options = []) {
			if(isset($data['vehicle_inspection'])) $data['vehicle_inspection'] = pkGivenLookupText($data['vehicle_inspection'], 'movement_of_personnel_in_government_garage_and_workshops', 'vehicle_inspection');
			if(isset($data['make_of_vehicle'])) $data['make_of_vehicle'] = pkGivenLookupText($data['make_of_vehicle'], 'movement_of_personnel_in_government_garage_and_workshops', 'make_of_vehicle');

			return $data;
		},
		'service_provider' => function($data, $options = []) {
			if(isset($data['service_provider_type'])) $data['service_provider_type'] = pkGivenLookupText($data['service_provider_type'], 'service_provider', 'service_provider_type');

			return $data;
		},
		'service_provider_type' => function($data, $options = []) {

			return $data;
		},
		'vehicle_annual_inspection' => function($data, $options = []) {
			if(isset($data['vehicle_registration_number'])) $data['vehicle_registration_number'] = pkGivenLookupText($data['vehicle_registration_number'], 'vehicle_annual_inspection', 'vehicle_registration_number');
			if(isset($data['register_number'])) $data['register_number'] = pkGivenLookupText($data['register_number'], 'vehicle_annual_inspection', 'register_number');
			if(isset($data['renewal_of_license'])) $data['renewal_of_license'] = date('Y-m-d H:i:s', strtotime($data['renewal_of_license']));
			if(isset($data['last_entry_logbook'])) $data['last_entry_logbook'] = guessMySQLDateTime($data['last_entry_logbook']);
			if(isset($data['department_name'])) $data['department_name'] = pkGivenLookupText($data['department_name'], 'vehicle_annual_inspection', 'department_name');
			if(isset($data['province'])) $data['province'] = pkGivenLookupText($data['province'], 'vehicle_annual_inspection', 'province');
			if(isset($data['district'])) $data['district'] = pkGivenLookupText($data['district'], 'vehicle_annual_inspection', 'district');
			if(isset($data['date_of_inspection'])) $data['date_of_inspection'] = guessMySQLDateTime($data['date_of_inspection']);
			if(isset($data['engine_number'])) $data['engine_number'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['engine_number'], 'vehicle_annual_inspection', 'engine_number'));
			if(isset($data['chassis_number'])) $data['chassis_number'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['chassis_number'], 'vehicle_annual_inspection', 'chassis_number'));
			if(isset($data['make_of_vehicle'])) $data['make_of_vehicle'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['make_of_vehicle'], 'vehicle_annual_inspection', 'make_of_vehicle'));
			if(isset($data['model_of_vehicle'])) $data['model_of_vehicle'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['model_of_vehicle'], 'vehicle_annual_inspection', 'model_of_vehicle'));
			if(isset($data['year_model_specification'])) $data['year_model_specification'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['year_model_specification'], 'vehicle_annual_inspection', 'year_model_specification'));
			if(isset($data['engine_capacity'])) $data['engine_capacity'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['engine_capacity'], 'vehicle_annual_inspection', 'engine_capacity'));
			if(isset($data['tyre_size'])) $data['tyre_size'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['tyre_size'], 'vehicle_annual_inspection', 'tyre_size'));
			if(isset($data['transmission'])) $data['transmission'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['transmission'], 'vehicle_annual_inspection', 'transmission'));
			if(isset($data['fuel_type'])) $data['fuel_type'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['fuel_type'], 'vehicle_annual_inspection', 'fuel_type'));
			if(isset($data['type_of_vehicle'])) $data['type_of_vehicle'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['type_of_vehicle'], 'vehicle_annual_inspection', 'type_of_vehicle'));
			if(isset($data['colour_of_vehicle'])) $data['colour_of_vehicle'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['colour_of_vehicle'], 'vehicle_annual_inspection', 'colour_of_vehicle'));
			if(isset($data['application_status'])) $data['application_status'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['application_status'], 'vehicle_annual_inspection', 'application_status'));
			if(isset($data['renewal_of_license'])) $data['renewal_of_license'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['renewal_of_license'], 'vehicle_annual_inspection', 'renewal_of_license'));
			if(isset($data['barcode_number'])) $data['barcode_number'] = thisOr($data['vehicle_registration_number'], pkGivenLookupText($data['barcode_number'], 'vehicle_annual_inspection', 'barcode_number'));

			return $data;
		},
	];

	// accept a record as an assoc array, return a boolean indicating whether to import or skip record
	$filterFunctions = [
		'gmt_fleet_register' => function($data, $options = []) { return true; },
		'log_sheet' => function($data, $options = []) { return true; },
		'vehicle_history' => function($data, $options = []) { return true; },
		'year_model' => function($data, $options = []) { return true; },
		'month' => function($data, $options = []) { return true; },
		'body_type' => function($data, $options = []) { return true; },
		'vehicle_colour' => function($data, $options = []) { return true; },
		'province' => function($data, $options = []) { return true; },
		'departments' => function($data, $options = []) { return true; },
		'districts' => function($data, $options = []) { return true; },
		'application_status' => function($data, $options = []) { return true; },
		'vehicle_payments' => function($data, $options = []) { return true; },
		'insurance_payments' => function($data, $options = []) { return true; },
		'authorizations' => function($data, $options = []) { return true; },
		'service' => function($data, $options = []) { return true; },
		'service_type' => function($data, $options = []) { return true; },
		'schedule' => function($data, $options = []) { return true; },
		'service_records' => function($data, $options = []) { return true; },
		'service_categories' => function($data, $options = []) { return true; },
		'service_item_type' => function($data, $options = []) { return true; },
		'service_item' => function($data, $options = []) { return true; },
		'purchase_orders' => function($data, $options = []) { return true; },
		'transmission' => function($data, $options = []) { return true; },
		'fuel_type' => function($data, $options = []) { return true; },
		'merchant' => function($data, $options = []) { return true; },
		'merchant_type' => function($data, $options = []) { return true; },
		'manufacturer' => function($data, $options = []) { return true; },
		'manufacturer_type' => function($data, $options = []) { return true; },
		'driver' => function($data, $options = []) { return true; },
		'accidents' => function($data, $options = []) { return true; },
		'accident_type' => function($data, $options = []) { return true; },
		'claim' => function($data, $options = []) { return true; },
		'claim_status' => function($data, $options = []) { return true; },
		'claim_category' => function($data, $options = []) { return true; },
		'cost_centre' => function($data, $options = []) { return true; },
		'dealer' => function($data, $options = []) { return true; },
		'dealer_type' => function($data, $options = []) { return true; },
		'tyre_log_sheet' => function($data, $options = []) { return true; },
		'vehicle_daily_check_list' => function($data, $options = []) { return true; },
		'auditor' => function($data, $options = []) { return true; },
		'parts' => function($data, $options = []) { return true; },
		'parts_type' => function($data, $options = []) { return true; },
		'breakdown_services' => function($data, $options = []) { return true; },
		'modification_to_vehicle' => function($data, $options = []) { return true; },
		'vehicle_handing_over_checklist' => function($data, $options = []) { return true; },
		'vehicle_return_check_list' => function($data, $options = []) { return true; },
		'indicates_repair_damages_found_list' => function($data, $options = []) { return true; },
		'forms' => function($data, $options = []) { return true; },
		'identification_of_defects' => function($data, $options = []) { return true; },
		'gate_security' => function($data, $options = []) { return true; },
		'reception' => function($data, $options = []) { return true; },
		'inspection_bay' => function($data, $options = []) { return true; },
		'work_allocation' => function($data, $options = []) { return true; },
		'internal_repairs_mechanical' => function($data, $options = []) { return true; },
		'external_repairs_mechanical' => function($data, $options = []) { return true; },
		'internal_repairs_body' => function($data, $options = []) { return true; },
		'external_repairs_body' => function($data, $options = []) { return true; },
		'ordering_of_spares_for_internal_repairs' => function($data, $options = []) { return true; },
		'collection_of_repaired_vehicles' => function($data, $options = []) { return true; },
		'withdrawal_vehicle_from_operation' => function($data, $options = []) { return true; },
		'costing' => function($data, $options = []) { return true; },
		'billing' => function($data, $options = []) { return true; },
		'general_control_measures' => function($data, $options = []) { return true; },
		'movement_of_personnel_in_government_garage_and_workshops' => function($data, $options = []) { return true; },
		'service_provider' => function($data, $options = []) { return true; },
		'service_provider_type' => function($data, $options = []) { return true; },
		'vehicle_annual_inspection' => function($data, $options = []) { return true; },
	];

	/*
	Hook file for overwriting/amending $transformFunctions and $filterFunctions:
	hooks/import-csv.php
	If found, it's included below

	The way this works is by either completely overwriting any of the above 2 arrays,
	or, more commonly, overwriting a single function, for example:
		$transformFunctions['tablename'] = function($data, $options = []) {
			// new definition here
			// then you must return transformed data
			return $data;
		};

	Another scenario is transforming a specific field and leaving other fields to the default
	transformation. One possible way of doing this is to store the original transformation function
	in GLOBALS array, calling it inside the custom transformation function, then modifying the
	specific field:
		$GLOBALS['originalTransformationFunction'] = $transformFunctions['tablename'];
		$transformFunctions['tablename'] = function($data, $options = []) {
			$data = call_user_func_array($GLOBALS['originalTransformationFunction'], [$data, $options]);
			$data['fieldname'] = 'transformed value';
			return $data;
		};
	*/

	@include(__DIR__ . '/hooks/import-csv.php');

	$ui = new CSVImportUI($transformFunctions, $filterFunctions);
