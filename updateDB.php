<?php
	// check this file's MD5 to make sure it wasn't called before
	$tenantId = Authentication::tenantIdPadded();
	$setupHash = __DIR__ . "/setup{$tenantId}.md5";

	$prevMD5 = @file_get_contents($setupHash);
	$thisMD5 = md5_file(__FILE__);

	// check if this setup file already run
	if($thisMD5 != $prevMD5) {
		// set up tables
		setupTable(
			'gmt_fleet_register', " 
			CREATE TABLE IF NOT EXISTS `gmt_fleet_register` ( 
				`fleet_asset_id` INT(11) NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`fleet_asset_id`),
				`vehicle_registration_number` VARCHAR(25) NOT NULL,
				UNIQUE `vehicle_registration_number_unique` (`vehicle_registration_number`),
				`register_number` VARCHAR(40) NULL,
				`engine_number` VARCHAR(35) NOT NULL,
				UNIQUE `engine_number_unique` (`engine_number`),
				`chassis_number` VARCHAR(35) NOT NULL,
				UNIQUE `chassis_number_unique` (`chassis_number`),
				`dealer_name` INT(11) NULL,
				`make_of_vehicle` INT(11) NULL,
				`model_of_vehicle` VARCHAR(45) NULL,
				`year_model_specification` INT(11) NOT NULL,
				`engine_capacity` VARCHAR(40) NULL,
				`tyre_size` VARCHAR(40) NULL,
				`transmission` INT NULL,
				`fuel_type` INT NULL,
				`type_of_vehicle` INT(11) NOT NULL,
				`colour_of_vehicle` INT(11) NOT NULL,
				`application_status` INT NOT NULL,
				`case_number` VARCHAR(40) NULL DEFAULT 'CAS_',
				`barcode_number` VARCHAR(35) NULL,
				UNIQUE `barcode_number_unique` (`barcode_number`),
				`purchase_price` DECIMAL(10,2) NOT NULL,
				`depreciation_value` VARCHAR(40) NULL,
				`photo_of_vehicle` VARCHAR(255) NULL,
				`user_name_and_surname` VARCHAR(40) NOT NULL,
				`user_contact_email` VARCHAR(40) NOT NULL,
				`contact_number` VARCHAR(16) NOT NULL,
				`department_name` INT(11) NOT NULL,
				`department_address` TEXT NOT NULL,
				`province` INT(11) NOT NULL,
				`district` INT(11) NOT NULL,
				`drivers_name_and_surname` INT(11) NULL,
				`drivers_persal_number` INT NULL,
				`department_name_of_driver` INT(11) NULL,
				`drivers_contact_details` INT NULL,
				`documents` VARCHAR(225) NULL,
				`date_auctioned` DATE NULL DEFAULT '0000-00-00',
				`venue` VARCHAR(40) NULL,
				`comments` LONGTEXT NULL,
				`renewal_of_license` DATE NULL,
				`mm_code` VARCHAR(40) NULL
			) CHARSET latin1"
		);
		setupIndexes('gmt_fleet_register', ['dealer_name','make_of_vehicle','year_model_specification','transmission','fuel_type','type_of_vehicle','colour_of_vehicle','application_status','department_name','province','district','drivers_name_and_surname','department_name_of_driver',]);

		setupTable(
			'log_sheet', " 
			CREATE TABLE IF NOT EXISTS `log_sheet` ( 
				`fuel_log_sheet_id` INT(11) NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`fuel_log_sheet_id`),
				`vehicle_registration_number` INT(11) NULL,
				`register_number` INT(11) NULL,
				`make_of_vehicle` INT(11) NULL,
				`model_of_vehicle` INT(11) NULL,
				`year_model_specification` INT(11) NULL,
				`colour_of_vehicle` INT(11) NULL,
				`engine_capacity` INT(11) NULL,
				`renewal_of_license` DATE NULL,
				`district` INT(11) NULL,
				`month` DATE NULL,
				`drivers_name_and_surname` INT(11) NULL,
				`drivers_persal_number` INT(11) NULL,
				`opening_km` VARCHAR(15) NULL,
				`total_trip_distance` VARCHAR(15) NULL,
				`closing_km` VARCHAR(15) NULL,
				`fuel_type` INT(11) NULL,
				`fuel_tank_capacity` DECIMAL(10,2) NULL,
				`vendor` VARCHAR(40) NULL,
				`fuel_cost_litre` DECIMAL(10,2) NULL,
				`refuel_quantity_1` DECIMAL(10,2) NULL,
				`refuel_first_time_date` DATE NULL,
				`trip_distance_refuel_1` VARCHAR(15) NULL,
				`refuel_quantity_2` DECIMAL(10,2) NULL,
				`refuel_second_time_date` DATE NULL,
				`trip_distance_refuel_2` VARCHAR(15) NULL,
				`refuel_quantity_3` DECIMAL(10,2) NULL,
				`refuel_third_time_date` DATE NULL,
				`trip_distance_refuel_3` VARCHAR(15) NULL,
				`refuel_quantity_4` DECIMAL(10,2) NULL,
				`refuel_fourth_time_date` DATE NULL,
				`trip_distance_refuel_4` VARCHAR(15) NULL,
				`refuel_quantity_5` DECIMAL(10,2) NULL,
				`refuel_fifth_time_date` DATE NULL,
				`trip_distance_refuel_5` VARCHAR(15) NULL,
				`refuel_quantity_6` DECIMAL(10,2) NULL,
				`trip_distance_refuel_6` VARCHAR(15) NULL,
				`refuel_sixth_time_date` DATE NULL,
				`times_refuel_current_month` DECIMAL(10,2) NULL,
				`total_fuel_quantity` DECIMAL(10,2) NULL,
				`fuel_consumption` DECIMAL(10,2) NULL,
				`fuel_total_cost` DECIMAL(10,2) NULL,
				`payment_e_fuel_card` VARCHAR(40) NULL,
				`captured_by` VARCHAR(35) NULL,
				`comments` TEXT NULL,
				`date_captured` DATE NULL,
				`complete_fill_up` VARCHAR(40) NULL
			) CHARSET latin1"
		);
		setupIndexes('log_sheet', ['vehicle_registration_number','register_number','model_of_vehicle','colour_of_vehicle','drivers_name_and_surname','fuel_type',]);

		setupTable(
			'vehicle_history', " 
			CREATE TABLE IF NOT EXISTS `vehicle_history` ( 
				`history_id` INT(11) NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`history_id`),
				`vehicle_registration_number` INT(11) NULL,
				`engine_number` INT(11) NULL,
				`purchased_price` INT(11) NULL,
				`old_registration_number` INT(11) NULL,
				`new_vehicle_registration_number` VARCHAR(25) NULL,
				UNIQUE `new_vehicle_registration_number_unique` (`new_vehicle_registration_number`),
				`date_of_vehicle_transfer` DATE NULL,
				`comments` TEXT NULL,
				`renewal_of_license` INT(11) NULL,
				`date_of_service` INT NULL,
				`date_of_next_service` INT NULL,
				`purchased_order_number` INT NULL,
				`claim_code` INT(11) NULL,
				`tyre_inspection_report` INT(11) NULL,
				`inspection_certification_number` INT(11) NULL,
				`document_checklist_report` INT NULL,
				`next_inspection_date` INT(11) NULL DEFAULT '1',
				`breakdown_of_vehicle` VARCHAR(40) NULL,
				`date_of_vehicle_breakdown` DATE NULL,
				`description_of_vehicle_breakdown` TEXT NULL,
				`closing_km` INT(11) NULL,
				`date_of_vehicle_reactivation` DATETIME NULL,
				`total_cost` INT(11) NULL
			) CHARSET latin1"
		);
		setupIndexes('vehicle_history', ['vehicle_registration_number','date_of_service','purchased_order_number','claim_code','tyre_inspection_report','inspection_certification_number','document_checklist_report','next_inspection_date','closing_km','total_cost',]);

		setupTable(
			'year_model', " 
			CREATE TABLE IF NOT EXISTS `year_model` ( 
				`year_model_id` INT(11) NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`year_model_id`),
				`year_model_specification` VARCHAR(40) NULL
			) CHARSET latin1"
		);

		setupTable(
			'month', " 
			CREATE TABLE IF NOT EXISTS `month` ( 
				`month_id` INT(11) NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`month_id`),
				`month` VARCHAR(40) NULL
			) CHARSET latin1"
		);

		setupTable(
			'body_type', " 
			CREATE TABLE IF NOT EXISTS `body_type` ( 
				`body_type_id` INT(11) NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`body_type_id`),
				`type_of_vehicle` VARCHAR(40) NULL
			) CHARSET latin1"
		);

		setupTable(
			'vehicle_colour', " 
			CREATE TABLE IF NOT EXISTS `vehicle_colour` ( 
				`vehicle_colour_id` INT(11) NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`vehicle_colour_id`),
				`colour_of_vehicle` VARCHAR(40) NULL
			) CHARSET latin1"
		);

		setupTable(
			'province', " 
			CREATE TABLE IF NOT EXISTS `province` ( 
				`province_id` INT(11) NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`province_id`),
				`province` VARCHAR(40) NULL
			) CHARSET latin1"
		);

		setupTable(
			'departments', " 
			CREATE TABLE IF NOT EXISTS `departments` ( 
				`department_id` INT(11) NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`department_id`),
				`department_name` VARCHAR(75) NULL
			) CHARSET latin1"
		);

		setupTable(
			'districts', " 
			CREATE TABLE IF NOT EXISTS `districts` ( 
				`district_id` INT(11) NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`district_id`),
				`district` VARCHAR(40) NULL,
				`station` VARCHAR(40) NULL
			) CHARSET latin1"
		);

		setupTable(
			'application_status', " 
			CREATE TABLE IF NOT EXISTS `application_status` ( 
				`application_id` INT(11) NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`application_id`),
				`application_status` VARCHAR(40) NULL
			) CHARSET latin1"
		);

		setupTable(
			'vehicle_payments', " 
			CREATE TABLE IF NOT EXISTS `vehicle_payments` ( 
				`vehicle_payment_id` INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`vehicle_payment_id`),
				`vehicle_registration_number` INT(11) NULL,
				`engine_number` INT(11) NULL,
				`chassis_number` INT(11) NULL,
				`make_of_vehicle` INT(11) NULL,
				`model_of_vehicle` INT(11) NULL,
				`year_model_of_vehicle` INT(11) NULL,
				`type_of_vehicle` INT(11) NULL,
				`application_status` INT(11) NULL,
				`barcode_number` INT(11) NULL,
				`purchase_price` DECIMAL(10,2) NULL,
				`depreciation_value` DECIMAL(10,2) NULL,
				`closing_km` INT NULL,
				`department` INT(6) NULL,
				`acquisition_reference` VARCHAR(40) NULL,
				`date_of_acquisition` DATE NULL,
				`odometer_at_acquisition` VARCHAR(40) NULL,
				`merchant_name` INT NULL,
				`value_at_acquisition` DECIMAL(10,2) NULL,
				`term` VARCHAR(40) NULL,
				`month_end` DATE NULL,
				`installment_per_month` DECIMAL(10,2) NULL,
				`payment_amount` DECIMAL(10,2) NULL,
				`payment_frequency` VARCHAR(40) NULL,
				`interest_rate` INT NULL,
				`payment_reference` VARCHAR(40) NULL,
				`paid_so_far` DECIMAL(10,2) NULL,
				`remaining_balance` DECIMAL(10,2) NULL,
				`depreciation_since_purchase` VARCHAR(40) NULL,
				`actual_resale_value` VARCHAR(40) NULL,
				`warranty_expires_on` DATE NULL,
				`comments` LONGTEXT NULL,
				`documents` VARCHAR(40) NULL
			) CHARSET latin1"
		);
		setupIndexes('vehicle_payments', ['vehicle_registration_number','closing_km','merchant_name',]);

		setupTable(
			'insurance_payments', " 
			CREATE TABLE IF NOT EXISTS `insurance_payments` ( 
				`insurance_payment_id` INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`insurance_payment_id`),
				`vehicle_registration_number` INT(6) NULL,
				`engine_number` INT(6) NULL,
				`chassis_number` INT(6) NULL,
				`make_of_vehicle` INT(11) NULL,
				`model_of_vehicle` INT(11) NULL,
				`year_model_of_vehicle` INT(6) NULL,
				`type_of_vehicle` INT(6) NULL,
				`application_status` INT(6) NULL,
				`barcode_number` INT(6) NULL,
				`department` INT(6) NULL,
				`insurance_reference` VARCHAR(40) NULL,
				`insurance_expiration` DATE NULL,
				`transaction_date` DATE NULL,
				`reference_number` VARCHAR(40) NULL,
				`merchant_name` INT NULL,
				`payment_amount` DECIMAL(10,2) NULL,
				`month_end` DATE NULL,
				`documents` VARCHAR(40) NULL,
				`comments` LONGTEXT NULL
			) CHARSET latin1"
		);
		setupIndexes('insurance_payments', ['vehicle_registration_number','merchant_name',]);

		setupTable(
			'authorizations', " 
			CREATE TABLE IF NOT EXISTS `authorizations` ( 
				`authorize_id` INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`authorize_id`),
				`job_code` INT(11) NULL,
				`job_status` INT NULL,
				`job_status_date` DATE NULL DEFAULT '0000-00-00',
				`job_status_age` VARCHAR(40) NULL,
				`job_age` VARCHAR(40) NULL,
				`job_category` INT NULL,
				`job_odometer` INT(11) NULL,
				`instruction_note` INT(11) NULL,
				`pre_authorisation_date` INT(11) NULL DEFAULT '1',
				`authorisation_date` DATE NULL DEFAULT '0000-00-00',
				`vehicle_registration_number` INT(11) NULL,
				`make_of_vehicle` INT(11) NULL,
				`client` INT NULL,
				`province_name` INT NULL,
				`merchant_code` INT NULL,
				`merchant_name` INT NULL,
				`merchant_contact_email` INT NULL,
				`merchant_street_address` INT NULL,
				`merchant_suburb` INT NULL,
				`merchant_city` INT NULL,
				`merchant_address_code` INT NULL,
				`merchant_contact_details` INT NULL,
				`total_claim` INT(11) NULL,
				`total_authorised` INT(11) NULL,
				`authorization_number` INT(11) NULL,
				`last_fuel_transaction_date` DATE NULL DEFAULT '0000-00-00',
				`external_repairs` TEXT NULL
			) CHARSET latin1"
		);
		setupIndexes('authorizations', ['job_code','job_status','job_category','vehicle_registration_number','client','province_name','merchant_code',]);

		setupTable(
			'service', " 
			CREATE TABLE IF NOT EXISTS `service` ( 
				`service_id` INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`service_id`),
				`breakdown_of_vehicle` VARCHAR(40) NULL,
				`service_title` VARCHAR(75) NULL,
				`service_item_type` INT(11) NULL,
				`service_category` INT(11) NULL,
				`merchant_name` INT NULL,
				`vehicle_registration_number` INT(11) NULL,
				`engine_number` INT(11) NULL,
				`chassis_number` INT(11) NULL,
				`dealer_name` INT(11) NULL,
				`make_of_vehicle` INT(11) NULL,
				`model_of_vehicle` INT(11) NULL,
				`year_model_of_vehicle` INT(6) NULL,
				`type_of_vehicle` INT(6) NULL,
				`closing_km` INT(11) NULL,
				`application_status` INT(11) NULL,
				`work_allocation_reference_number` INT NULL,
				`barcode_number` INT(6) NULL,
				`department` INT(6) NULL,
				`service_item` TEXT NULL,
				`date_of_service` INT NULL,
				`time` INT NULL,
				`upload_quotation` VARCHAR(40) NULL,
				`date_of_next_service` DATE NULL,
				`repeat_service_schedule_every_km` TEXT NULL,
				`comments` LONGTEXT NULL,
				`upload_invoice` VARCHAR(40) NULL,
				`receptionist` INT NULL,
				`receptionist_contact_email` INT NULL,
				`workshop_name` INT NULL,
				`workshop_address` TEXT NULL,
				`technician` VARCHAR(40) NULL,
				`work_order_status` VARCHAR(40) NULL,
				`job_card_number` INT NULL,
				`completion_date` DATE NULL,
				`due_date` DATE NULL,
				`filed` DATETIME NULL,
				`last_modified` DATETIME NULL
			) CHARSET latin1"
		);
		setupIndexes('service', ['service_item_type','service_category','merchant_name','vehicle_registration_number','dealer_name','closing_km','work_allocation_reference_number','date_of_service','receptionist',]);

		setupTable(
			'service_type', " 
			CREATE TABLE IF NOT EXISTS `service_type` ( 
				`service_type_id` INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`service_type_id`),
				`service` VARCHAR(200) NULL,
				`type_of_service` TEXT NULL,
				`reference` TEXT NULL,
				`service_item_type` INT(11) NULL,
				`service_category` INT(11) NULL,
				`service_item` VARCHAR(40) NULL,
				`frequency_time_number` VARCHAR(40) NULL,
				`frequency_time` VARCHAR(40) NULL,
				`frequency_odometer` VARCHAR(40) NULL
			) CHARSET latin1"
		);
		setupIndexes('service_type', ['service_item_type','service_category',]);

		setupTable(
			'schedule', " 
			CREATE TABLE IF NOT EXISTS `schedule` ( 
				`schedule_id` INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`schedule_id`),
				`title` VARCHAR(40) NULL,
				`user_name_and_surname` INT(11) NULL,
				`user_contact_email` INT(11) NULL,
				`service_item_type` INT(11) NULL,
				`service_item_type_code` INT(11) NULL,
				`application_status` VARCHAR(40) NOT NULL,
				`vehicle_registration_number` INT(11) NULL,
				`engine_number` INT(11) NULL,
				`closing_km` INT(11) NULL,
				`date` DATE NULL,
				`time` TIME NULL DEFAULT '12:00:00',
				`workshop_name` INT(11) NULL,
				`diagnosis` VARCHAR(40) NULL,
				`prescription` VARCHAR(40) NULL,
				`comments` TEXT NULL
			) CHARSET latin1"
		);
		setupIndexes('schedule', ['user_name_and_surname','service_item_type','vehicle_registration_number','closing_km','workshop_name',]);

		setupTable(
			'service_records', " 
			CREATE TABLE IF NOT EXISTS `service_records` ( 
				`records_id` INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`records_id`),
				`vehicle` INT NULL,
				`image_1` VARCHAR(40) NULL,
				`image_2` VARCHAR(40) NULL,
				`image_3` VARCHAR(40) NULL,
				`image_4` VARCHAR(40) NULL,
				`image_5` VARCHAR(40) NULL,
				`document_1` VARCHAR(40) NULL,
				`document_2` VARCHAR(40) NULL,
				`document_3` VARCHAR(40) NULL,
				`document_4` VARCHAR(40) NULL,
				`document_5` VARCHAR(40) NULL,
				`description` TEXT NULL
			) CHARSET latin1"
		);
		setupIndexes('service_records', ['vehicle',]);

		setupTable(
			'service_categories', " 
			CREATE TABLE IF NOT EXISTS `service_categories` ( 
				`service_categories_id` INT(11) NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`service_categories_id`),
				`service_category` VARCHAR(40) NULL
			) CHARSET latin1"
		);

		setupTable(
			'service_item_type', " 
			CREATE TABLE IF NOT EXISTS `service_item_type` ( 
				`service_item_type_id` INT(11) NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`service_item_type_id`),
				`service_item_type` VARCHAR(40) NULL,
				`service_item_type_code` VARCHAR(40) NULL
			) CHARSET latin1"
		);

		setupTable(
			'service_item', " 
			CREATE TABLE IF NOT EXISTS `service_item` ( 
				`service_item_id` INT(11) NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`service_item_id`),
				`service_item` TEXT NULL
			) CHARSET latin1"
		);

		setupTable(
			'purchase_orders', " 
			CREATE TABLE IF NOT EXISTS `purchase_orders` ( 
				`purchase_order_id` INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`purchase_order_id`),
				`purchased_order_number` VARCHAR(40) NOT NULL,
				`purchased_date` DATE NULL,
				`purchaser` VARCHAR(40) NULL,
				`vehicle_registration_number` INT(6) NULL,
				`type_of_vehicle` INT(6) NULL,
				`manufacturer` INT NULL,
				`service_type` TEXT NULL,
				`service_category` INT NULL,
				`service_item` TEXT NULL,
				`upload_quotation` VARCHAR(40) NULL,
				`due_date` DATE NULL,
				`merchant_name` INT NULL,
				`date_of_service` DATE NULL,
				`closing_km` INT NULL,
				`labour_category_1` VARCHAR(40) NULL,
				`part_number_1` INT NULL,
				`part_name_1` INT NULL,
				`part_manufacturer_name_1` INT NULL,
				`quantity_1` VARCHAR(40) NULL,
				`expense_of_item_1` DECIMAL(10,2) NULL,
				`labour_category_2` VARCHAR(40) NULL,
				`part_number_2` INT NULL,
				`part_name_2` INT NULL,
				`part_manufacturer_name_2` INT NULL,
				`quantity_2` VARCHAR(40) NULL,
				`expense_of_item_2` DECIMAL(10,2) NULL,
				`labour_category_3` VARCHAR(40) NULL,
				`part_number_3` INT NULL,
				`part_name_3` INT NULL,
				`part_manufacturer_name_3` INT NULL,
				`quantity_3` VARCHAR(40) NULL,
				`expense_of_item_3` DECIMAL(10,2) NULL,
				`labour_category_4` VARCHAR(40) NULL,
				`part_number_4` INT NULL,
				`part_name_4` INT NULL,
				`part_manufacturer_name_4` INT NULL,
				`quantity_4` VARCHAR(40) NULL,
				`expense_of_item_4` DECIMAL(10,2) NULL,
				`labour_category_5` VARCHAR(40) NULL,
				`part_number_5` INT NULL,
				`part_name_5` INT NULL,
				`part_manufacturer_name_5` INT NULL,
				`quantity_5` VARCHAR(40) NULL,
				`expense_of_item_5` DECIMAL(10,2) NULL,
				`labour_category_6` VARCHAR(40) NULL,
				`part_number_6` INT NULL,
				`part_name_6` INT NULL,
				`part_manufacturer_name_6` INT NULL,
				`quantity_6` VARCHAR(40) NULL,
				`expense_of_item_6` DECIMAL(10,2) NULL,
				`labour_category_7` VARCHAR(40) NULL,
				`part_number_7` INT NULL,
				`part_name_7` INT(11) NULL,
				`part_manufacturer_name_7` INT NULL,
				`quantity_7` VARCHAR(40) NULL,
				`expense_of_item_7` DECIMAL(10,2) NULL,
				`labour_category_8` VARCHAR(40) NULL,
				`part_number_8` INT(11) NULL,
				`part_name_8` INT(11) NULL,
				`part_manufacturer_name_8` INT(11) NULL,
				`expense_of_item_8` DECIMAL(10,2) NULL,
				`material_cost` DECIMAL(10,2) NULL,
				`average_worktime_hrs` VARCHAR(40) NULL,
				`standard_labour_cost_per_hour` DECIMAL(10,2) NULL,
				`labour_charges` DECIMAL(10,2) NULL,
				`vat` DECIMAL(10,2) NULL,
				`total_amount` DECIMAL(10,2) NULL,
				`workshop_name` INT NULL,
				`work_order_id` INT NULL,
				`job_card_number` INT NULL,
				`completion_date` DATE NULL,
				`comments` LONGTEXT NULL,
				`upload_invoice` VARCHAR(40) NULL,
				`date_captured` DATE NULL,
				`data_capturer` VARCHAR(40) NULL,
				`data_capturer_contact_email` VARCHAR(40) NULL
			) CHARSET latin1"
		);
		setupIndexes('purchase_orders', ['vehicle_registration_number','manufacturer','service_category','merchant_name','closing_km','part_number_1','part_name_1','part_manufacturer_name_1','part_number_2','part_name_2','part_manufacturer_name_2','part_number_3','part_manufacturer_name_3','part_number_4','part_manufacturer_name_4','part_number_5','part_manufacturer_name_5','part_number_6','part_name_6','part_manufacturer_name_6','part_number_7','part_name_7','part_manufacturer_name_7','part_number_8','part_name_8','part_manufacturer_name_8','workshop_name','work_order_id','job_card_number',]);

		setupTable(
			'transmission', " 
			CREATE TABLE IF NOT EXISTS `transmission` ( 
				`transmission_id` INT(11) NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`transmission_id`),
				`transmission` VARCHAR(40) NULL
			) CHARSET latin1"
		);

		setupTable(
			'fuel_type', " 
			CREATE TABLE IF NOT EXISTS `fuel_type` ( 
				`fuel_type_id` INT(11) NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`fuel_type_id`),
				`fuel_type` VARCHAR(40) NULL
			) CHARSET latin1"
		);

		setupTable(
			'merchant', " 
			CREATE TABLE IF NOT EXISTS `merchant` ( 
				`merchant_id` INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`merchant_id`),
				`merchant_type` INT NULL,
				`merchant_code` VARCHAR(40) NULL,
				`merchant_name` VARCHAR(40) NULL,
				`merchant_contact_email` VARCHAR(40) NULL,
				`merchant_street_address` TEXT NULL,
				`merchant_suburb` VARCHAR(40) NULL,
				`merchant_city` VARCHAR(40) NULL,
				`merchant_address_code` VARCHAR(40) NULL,
				`merchant_contact_details` VARCHAR(40) NULL
			) CHARSET latin1"
		);
		setupIndexes('merchant', ['merchant_type',]);

		setupTable(
			'merchant_type', " 
			CREATE TABLE IF NOT EXISTS `merchant_type` ( 
				`merchant_type_id` INT(11) NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`merchant_type_id`),
				`merchant_type` VARCHAR(40) NULL
			) CHARSET latin1"
		);

		setupTable(
			'manufacturer', " 
			CREATE TABLE IF NOT EXISTS `manufacturer` ( 
				`manufacturer_id` INT(11) NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`manufacturer_id`),
				`manufacturer_type` INT NULL,
				`manufacturer_name` VARCHAR(40) NULL,
				`contact_person` VARCHAR(40) NULL,
				`contact_details` VARCHAR(40) NULL,
				`contact_email` VARCHAR(40) NULL
			) CHARSET latin1"
		);
		setupIndexes('manufacturer', ['manufacturer_type',]);

		setupTable(
			'manufacturer_type', " 
			CREATE TABLE IF NOT EXISTS `manufacturer_type` ( 
				`manufacturer_type_id` INT(11) NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`manufacturer_type_id`),
				`manufacturer_type` VARCHAR(40) NULL
			) CHARSET latin1"
		);

		setupTable(
			'driver', " 
			CREATE TABLE IF NOT EXISTS `driver` ( 
				`driver_id` INT(11) NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`driver_id`),
				`drivers_name_and_surname` VARCHAR(40) NOT NULL,
				`drivers_persal_number` VARCHAR(40) NOT NULL,
				`drivers_contact_details` VARCHAR(40) NULL,
				`drivers_email_address` VARCHAR(40) NULL,
				`drivers_license` VARCHAR(40) NULL,
				`drivers_license_code` VARCHAR(40) NULL,
				`drivers_license_number` VARCHAR(40) NULL,
				`drivers_license_upload` VARCHAR(40) NULL,
				`drivers_license_expire_date` DATE NULL,
				`drivers_license_renewal_date` DATE NULL,
				`drivers_log_history` TEXT NULL,
				`drivers_license_penalties` VARCHAR(40) NULL,
				`drivers_license_penalties_date` DATE NULL,
				`drivers_license_penalty_details` TEXT NULL,
				`drivers_license_penalty_details_uploads` VARCHAR(40) NULL,
				`involved_in_accident` VARCHAR(40) NULL,
				`accident_report` VARCHAR(40) NULL
			) CHARSET latin1"
		);

		setupTable(
			'accidents', " 
			CREATE TABLE IF NOT EXISTS `accidents` ( 
				`accident_id` INT(11) NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`accident_id`),
				`vehicle_registration_number` INT(11) NULL,
				`closing_km` INT(11) NULL,
				`drivers_surname` INT(11) NULL,
				`drivers_contact_details` INT NULL,
				`dealer_name` INT(11) NULL,
				`model_of_vehicle` INT(11) NULL,
				`date_of_accident` DATE NULL,
				`z181_accident_form` VARCHAR(40) NULL,
				`z181_accident_form_uploaded` VARCHAR(40) NULL,
				`copy_of_trip_authority` VARCHAR(40) NULL,
				`district` INT(11) NULL,
				`location` INT(11) NULL,
				`road_or_street` VARCHAR(40) NULL,
				`coordinates` VARCHAR(40) NULL,
				`deaths` VARCHAR(40) NULL,
				`fatal_amount` VARCHAR(40) NULL,
				`injured` VARCHAR(40) NULL,
				`injured_amount` VARCHAR(40) NULL,
				`description_of_accident` TEXT NULL,
				`insured` VARCHAR(40) NULL,
				`upload_photos_damaged_vehicle` VARCHAR(40) NULL,
				`copy_of_sketch_plan` VARCHAR(40) NULL,
				`accident_report_driver` VARCHAR(40) NULL,
				`accident_report_supervisior` VARCHAR(40) NULL,
				`claims_report_accident_committee` VARCHAR(40) NULL,
				`insurance_claims_report` VARCHAR(40) NULL,
				`amount_paid` VARCHAR(40) NULL,
				`police_officer` VARCHAR(40) NULL,
				`contact_details` VARCHAR(40) NULL,
				`case_number` VARCHAR(40) NULL DEFAULT 'CAS_',
				`police_report` VARCHAR(40) NULL,
				`accident_report_number` VARCHAR(40) NULL
			) CHARSET latin1"
		);
		setupIndexes('accidents', ['vehicle_registration_number','closing_km','drivers_surname','district',]);

		setupTable(
			'accident_type', " 
			CREATE TABLE IF NOT EXISTS `accident_type` ( 
				`accident_type_id` INT(11) NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`accident_type_id`),
				`accident_type` VARCHAR(40) NULL
			) CHARSET latin1"
		);

		setupTable(
			'claim', " 
			CREATE TABLE IF NOT EXISTS `claim` ( 
				`claim_id` INT(11) NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`claim_id`),
				`claim_code` VARCHAR(40) NULL,
				`claim_status` INT NULL,
				`claim_category` INT NULL,
				`cost_centre` INT(11) NULL,
				`client_identification` VARCHAR(40) NULL,
				`department_name` INT NULL,
				`district` INT(11) NULL,
				`province` INT(11) NULL,
				`merchant_name` INT NULL,
				`vehicle_registration_number` INT(11) NULL,
				`model` INT(11) NULL,
				`closing_km` INT(11) NULL,
				`pre_authorization_date` DATE NULL DEFAULT '0000-00-00',
				`instruction_note` TEXT NULL,
				`invoice_date` DATE NULL DEFAULT '0000-00-00',
				`upload_invoice` VARCHAR(40) NULL,
				`payment_date` DATE NULL DEFAULT '0000-00-00',
				`authorization_number` VARCHAR(40) NOT NULL,
				`clearance_number` VARCHAR(40) NULL,
				`vehicle_collected_date` DATE NULL DEFAULT '0000-00-00',
				`total_claimed` DECIMAL(10,2) NULL,
				`total_authorized` DECIMAL(10,2) NULL
			) CHARSET latin1"
		);
		setupIndexes('claim', ['claim_status','claim_category','cost_centre','department_name','district','province','merchant_name','vehicle_registration_number','closing_km',]);

		setupTable(
			'claim_status', " 
			CREATE TABLE IF NOT EXISTS `claim_status` ( 
				`claim_status_id` INT(11) NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`claim_status_id`),
				`claim_status` VARCHAR(40) NULL
			) CHARSET latin1"
		);

		setupTable(
			'claim_category', " 
			CREATE TABLE IF NOT EXISTS `claim_category` ( 
				`claim_category_id` INT(11) NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`claim_category_id`),
				`claim_category` VARCHAR(40) NULL
			) CHARSET latin1"
		);

		setupTable(
			'cost_centre', " 
			CREATE TABLE IF NOT EXISTS `cost_centre` ( 
				`cost_centre_id` INT(11) NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`cost_centre_id`),
				`cost_centre` VARCHAR(40) NULL
			) CHARSET latin1"
		);

		setupTable(
			'dealer', " 
			CREATE TABLE IF NOT EXISTS `dealer` ( 
				`dealer_id` INT(11) NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`dealer_id`),
				`dealer_type` INT(11) NULL,
				`make_of_vehicle` VARCHAR(40) NULL,
				`dealer_name` VARCHAR(40) NULL,
				`contact_person` VARCHAR(40) NULL,
				`contact_details` VARCHAR(40) NULL,
				`contact_email` VARCHAR(40) NULL
			) CHARSET latin1"
		);
		setupIndexes('dealer', ['dealer_type',]);

		setupTable(
			'dealer_type', " 
			CREATE TABLE IF NOT EXISTS `dealer_type` ( 
				`dealer_type_id` INT(11) NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`dealer_type_id`),
				`dealer_type` VARCHAR(40) NULL
			) CHARSET latin1"
		);

		setupTable(
			'tyre_log_sheet', " 
			CREATE TABLE IF NOT EXISTS `tyre_log_sheet` ( 
				`tyre_log_id` INT(11) NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`tyre_log_id`),
				`vehicle_registration_number` INT(11) NULL,
				`tyre_position` VARCHAR(40) NULL,
				`tyre_tread_condition` VARCHAR(40) NULL,
				`tyre_brand` VARCHAR(40) NULL,
				`tyre_model` VARCHAR(40) NULL,
				`tyre_size` VARCHAR(40) NULL,
				`tyre_pressure` VARCHAR(40) NULL,
				`action` TEXT NULL,
				`warranty` VARCHAR(40) NULL,
				`documents` VARCHAR(225) NULL,
				`tyre_tread` VARCHAR(40) NULL,
				`tyre_maximum_wear` VARCHAR(40) NULL,
				`inspection_date` DATE NULL DEFAULT '0000-00-00',
				`tyre_inspection_done_by` VARCHAR(40) NULL,
				`tyre_inspection_report` VARCHAR(40) NULL,
				`status` VARCHAR(40) NULL,
				`opening_km` VARCHAR(15) NULL,
				`closing_km` VARCHAR(15) NULL,
				`total_km` VARCHAR(15) NULL,
				`comments` TEXT NULL,
				`tyres_cause_of_accident` VARCHAR(40) NULL,
				`accident_report` VARCHAR(40) NULL,
				`claims_report` VARCHAR(40) NULL,
				`insurance_claims_report` VARCHAR(40) NULL,
				`reminder_maximum_wear` VARCHAR(40) NULL
			) CHARSET latin1"
		);
		setupIndexes('tyre_log_sheet', ['vehicle_registration_number',]);

		setupTable(
			'vehicle_daily_check_list', " 
			CREATE TABLE IF NOT EXISTS `vehicle_daily_check_list` ( 
				`vehicle_daily_check_list_id` INT(11) NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`vehicle_daily_check_list_id`),
				`inspection_certification_number` VARCHAR(40) NULL,
				`vehicle_registration_number` INT(6) NULL,
				`make_of_vehicle` INT(11) NULL,
				`closing_km` INT(11) NULL,
				`dashboard` VARCHAR(40) NULL,
				`seats` VARCHAR(40) NULL,
				`carpets` VARCHAR(40) NULL,
				`wipers` VARCHAR(40) NULL,
				`head_lights` VARCHAR(40) NULL,
				`tail_lights` VARCHAR(40) NULL,
				`brake_lights` VARCHAR(40) NULL,
				`indicators` VARCHAR(40) NULL,
				`windscreen` VARCHAR(40) NULL,
				`windows` VARCHAR(40) NULL,
				`mirrors` VARCHAR(40) NULL,
				`wheels` VARCHAR(40) NULL,
				`hubcaps` VARCHAR(40) NULL,
				`sparewheel` VARCHAR(40) NULL,
				`tools` VARCHAR(40) NULL,
				`engine_oil` VARCHAR(40) NULL,
				`power_steering_oil` VARCHAR(40) NULL,
				`gearbox_oil` VARCHAR(40) NULL,
				`coolant` VARCHAR(40) NULL,
				`brake_oil` VARCHAR(40) NULL,
				`battery` VARCHAR(40) NULL,
				`brakes_front` VARCHAR(40) NULL,
				`brakes_rear` VARCHAR(40) NULL,
				`fuel_level` VARCHAR(40) NULL,
				`vehicle_fluid_leaks` VARCHAR(40) NULL,
				`note` TEXT NULL,
				`document_checklist_report` VARCHAR(40) NULL,
				`next_inspection_date` DATE NULL,
				`drivers_surname` INT NULL,
				`drivers_persal_number` INT(11) NULL
			) CHARSET latin1"
		);
		setupIndexes('vehicle_daily_check_list', ['vehicle_registration_number','closing_km','drivers_surname',]);

		setupTable(
			'auditor', " 
			CREATE TABLE IF NOT EXISTS `auditor` ( 
				`auditor_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`auditor_id`),
				`res_id` INT(5) UNSIGNED NULL,
				`username` VARCHAR(50) NULL,
				`ipaddr` VARCHAR(25) NULL,
				`time_stmp` TIMESTAMP NULL,
				`change_type` VARCHAR(10) NULL,
				`table_name` VARCHAR(40) NULL,
				`fieldName` VARCHAR(40) NULL,
				`OldValue` TEXT NULL,
				`NewValue` TEXT NULL
			) CHARSET latin1"
		);

		setupTable(
			'parts', " 
			CREATE TABLE IF NOT EXISTS `parts` ( 
				`parts_id` INT(11) NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`parts_id`),
				`part_type` INT NULL,
				`part_number` VARCHAR(40) NULL,
				`part_name` VARCHAR(40) NULL,
				`description` TEXT NULL,
				`manufacturer` INT NULL,
				`dealer` INT(11) NULL,
				`measure` VARCHAR(40) NULL,
				`unit_price` DECIMAL(10,2) NULL,
				`quantity` VARCHAR(40) NULL,
				`freight` VARCHAR(40) NULL,
				`amount` DECIMAL(10,2) NULL,
				`tax` VARCHAR(40) NULL,
				`total_amount` DECIMAL(10,2) NULL,
				`discount_price` DECIMAL(10,2) NULL,
				`net_part_price` DECIMAL(10,2) NULL
			) CHARSET latin1"
		);
		setupIndexes('parts', ['part_type','manufacturer','dealer',]);

		setupTable(
			'parts_type', " 
			CREATE TABLE IF NOT EXISTS `parts_type` ( 
				`part_type_id` INT(11) NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`part_type_id`),
				`part_type` VARCHAR(40) NULL
			) CHARSET latin1"
		);

		setupTable(
			'breakdown_services', " 
			CREATE TABLE IF NOT EXISTS `breakdown_services` ( 
				`breakdown_id` INT(11) NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`breakdown_id`),
				`breakdown_of_vehicle` VARCHAR(40) NULL,
				`breakdown_during_office_hours` VARCHAR(40) NULL,
				`breakdown_within_or_outside_the_province` VARCHAR(40) NULL,
				`description_of_vehicle_breakdown_notes` INT NULL,
				`description_of_vehicle_breakdown` VARCHAR(40) NULL,
				`date_of_vehicle_breakdown` DATE NULL,
				`work_allocation_reference_number` INT NULL,
				`job_card_number` INT NULL,
				`vehicle_registration_number` INT(11) NULL,
				`engine_number` INT(11) NULL,
				`closing_km` INT(11) NULL,
				`date_of_vehicle_reactivation` DATE NULL,
				`type_of_expenditure` VARCHAR(40) NULL,
				`labour_category` VARCHAR(40) NULL,
				`part_number` INT(11) NULL,
				`part_name` INT(11) NULL,
				`part_manufacturer_name` INT(11) NULL,
				`quantity` VARCHAR(40) NULL,
				`expense_of_item` DECIMAL(10,2) NULL,
				`labour_category_1` VARCHAR(40) NULL,
				`part_number_1` INT(11) NULL,
				`part_name_1` INT(11) NULL,
				`part_manufacturer_name_1` INT(11) NULL,
				`quantity_1` VARCHAR(40) NULL,
				`expense_of_item_1` DECIMAL(10,2) NULL,
				`material_cost` DECIMAL(10,2) NULL,
				`average_worktime_hrs` VARCHAR(40) NULL,
				`standard_labour_cost_per_hour` DECIMAL(10,2) NULL,
				`labour_charges` DECIMAL(10,2) NULL,
				`vat` DECIMAL(10,2) NULL,
				`total_amount` DECIMAL(10,2) NULL,
				`workshop_name` INT NULL,
				`work_order_status` VARCHAR(40) NULL,
				`comments` LONGTEXT NULL,
				`upload_invoice` VARCHAR(40) NULL,
				`receptionist` INT NULL,
				`receptionist_contact_email` INT NULL,
				`date_captured` DATETIME NULL
			) CHARSET latin1"
		);
		setupIndexes('breakdown_services', ['description_of_vehicle_breakdown_notes','work_allocation_reference_number','job_card_number','vehicle_registration_number','closing_km','part_number','part_name','part_manufacturer_name','part_number_1','part_name_1','part_manufacturer_name_1','workshop_name',]);

		setupTable(
			'modification_to_vehicle', " 
			CREATE TABLE IF NOT EXISTS `modification_to_vehicle` ( 
				`modification_id` INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`modification_id`),
				`type_of_vehicle` INT(11) NULL,
				`directorate` VARCHAR(40) NULL,
				`head_office` VARCHAR(40) NULL,
				`district` INT(11) NULL,
				`location` INT(11) NULL,
				`drivers_name_and_surname` INT(11) NULL,
				`drivers_persal_number` INT(11) NULL,
				`drivers_contact_details` INT(11) NULL,
				`driver_rank` VARCHAR(40) NULL,
				`driver_signature` VARCHAR(40) NULL,
				`vehicle_registration_number` INT(11) NULL,
				`make_of_vehicle` INT(11) NULL,
				`model_of_vehicle` INT(11) NULL,
				`closing_km` INT(11) NULL,
				`job_card_number` INT NULL,
				`objective` TEXT NULL,
				`fuel_gauge_amount` VARCHAR(40) NULL,
				`keys_ignition` VARCHAR(40) NULL,
				`petrol_cap_with_keys` VARCHAR(40) NULL,
				`padlock_with_keys` VARCHAR(40) NULL,
				`tyre_r_f` VARCHAR(40) NULL,
				`tyre_r_f_1` VARCHAR(40) NULL,
				`tyre_r_r` VARCHAR(40) NULL,
				`tyre_r_r_1` VARCHAR(40) NULL,
				`tyre_l_f` VARCHAR(40) NULL,
				`tyre_l_f_1` VARCHAR(40) NULL,
				`tyer_l_r` VARCHAR(40) NULL,
				`tyer_l_r_1` VARCHAR(40) NULL,
				`tyre_spare` VARCHAR(40) NULL,
				`tyre_spare_1` VARCHAR(40) NULL,
				`wheel_cups` TEXT NULL,
				`other` TEXT NULL,
				`battery` VARCHAR(40) NULL,
				`battery_voltage` VARCHAR(40) NULL,
				`wheel_spanner` VARCHAR(40) NULL,
				`jack_with_handle` VARCHAR(40) NULL,
				`radio_dvd_combination` VARCHAR(40) NULL,
				`petrol_card` VARCHAR(40) NULL,
				`valid_license_disc` VARCHAR(40) NULL,
				`valid_license_disc_date` DATE NULL,
				`fire_extinguisher` VARCHAR(40) NULL,
				`warning_signs_traingle` TEXT NULL,
				`date_checked_in` DATETIME NULL DEFAULT '2020-01-01 00:00:00',
				`testing_officer_name_and_surname` VARCHAR(40) NULL,
				`testing_officer_persal_number` VARCHAR(40) NULL,
				`testing_officer_rank` VARCHAR(40) NULL,
				`testing_officer_signature` VARCHAR(40) NULL,
				`date_received` DATETIME NULL DEFAULT '2020-01-01 00:00:00',
				`supervisor_for_allocation_name_and_surname` VARCHAR(40) NULL,
				`supervisor_for_allocation_persal_number` VARCHAR(40) NULL,
				`supervisor_for_allocation_rank` VARCHAR(40) NULL,
				`supervisor_for_allocation_signature` VARCHAR(40) NULL
			) CHARSET latin1"
		);
		setupIndexes('modification_to_vehicle', ['type_of_vehicle','district','drivers_name_and_surname','vehicle_registration_number','closing_km','job_card_number',]);

		setupTable(
			'vehicle_handing_over_checklist', " 
			CREATE TABLE IF NOT EXISTS `vehicle_handing_over_checklist` ( 
				`vehicle_handing_over_id` INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`vehicle_handing_over_id`),
				`company_name` VARCHAR(40) NULL,
				`company_address` TEXT NULL,
				`company_contact_details` VARCHAR(40) NULL,
				`reason_for_handling_over` TEXT NULL,
				`name_of_department` VARCHAR(40) NULL,
				`name_of_component` VARCHAR(40) NULL,
				`transport_officer_name_and_surname` VARCHAR(40) NULL,
				`transport_officer_email` VARCHAR(40) NULL,
				`job_pre_authorization_number` VARCHAR(40) NULL,
				`vehicle_registration_number` INT(11) NULL,
				`closing_km` INT(11) NULL,
				`make_of_vehicle` INT(11) NULL,
				`model_of_vehicle` INT(11) NULL,
				`authorization_number` INT(11) NULL,
				`authorization_date` DATE NULL DEFAULT '0000-00-00',
				`radio_dvd_combination` VARCHAR(40) NULL,
				`number_of_keys_handling_over` VARCHAR(40) NULL,
				`jack_with_handle` VARCHAR(40) NULL,
				`tyre_spare` VARCHAR(40) NULL,
				`tyre_spare_condition` VARCHAR(40) NULL,
				`wheel_spanner` VARCHAR(40) NULL,
				`wheel_cups` TEXT NULL,
				`tri_angles` VARCHAR(40) NULL,
				`mats` TEXT NULL,
				`other` TEXT NULL,
				`number_of_keys` VARCHAR(40) NULL,
				`tyre_r_f` VARCHAR(40) NULL,
				`tyre_r_f_1` VARCHAR(40) NULL,
				`tyre_r_f_1_1` VARCHAR(40) NULL,
				`tyre_r_r` VARCHAR(40) NULL,
				`tyre_r_r_1` VARCHAR(40) NULL,
				`tyre_r_r_1_1` VARCHAR(40) NULL,
				`tyre_l_f` VARCHAR(40) NULL,
				`tyre_l_f_1` VARCHAR(40) NULL,
				`tyre_l_f_1_1` VARCHAR(40) NULL,
				`tyer_l_r` VARCHAR(40) NULL,
				`tyer_l_r_1` VARCHAR(40) NULL,
				`tyre_l_r_1_1` VARCHAR(40) NULL,
				`driver_name_and_surname` INT(11) NULL,
				`driver_persal_number` INT(11) NULL,
				`driver_signature` VARCHAR(40) NULL,
				`date_checked_in` DATETIME NULL DEFAULT '2020-01-01 00:00:00',
				`testing_officer_name_and_surname` VARCHAR(40) NULL,
				`testing_officer_signature` VARCHAR(40) NULL,
				`fuel_gauge_amount` VARCHAR(40) NULL,
				`vehicle_marks_1` VARCHAR(40) NULL,
				`vehicle_marks_2` VARCHAR(40) NULL,
				`vehicle_marks_3` VARCHAR(40) NULL,
				`vehicle_marks_4` VARCHAR(40) NULL,
				`vehicle_marks_5` VARCHAR(40) NULL,
				`vehicle_marks_6` VARCHAR(40) NULL,
				`vehicle_marks_7` VARCHAR(40) NULL,
				`vehicle_marks_8` VARCHAR(40) NULL,
				`remarks` TEXT NULL,
				`vehicle_handing_over_ckecklist` VARCHAR(40) NULL
			) CHARSET latin1"
		);
		setupIndexes('vehicle_handing_over_checklist', ['vehicle_registration_number','authorization_number','driver_name_and_surname',]);

		setupTable(
			'vehicle_return_check_list', " 
			CREATE TABLE IF NOT EXISTS `vehicle_return_check_list` ( 
				`vehicle_return_check_list_id` INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`vehicle_return_check_list_id`),
				`vehicle_return_date` DATE NULL DEFAULT '0000-00-00',
				`job_card_number` VARCHAR(40) NULL,
				`vehicle_registration_number` INT(11) NULL,
				`make_of_vehicle` INT(11) NULL,
				`model_of_vehicle` INT(11) NULL,
				`closing_km` INT(11) NULL,
				`radio_dvd_combination` VARCHAR(40) NULL,
				`number_of_keys_handling_over` VARCHAR(40) NULL,
				`jack_with_handle` VARCHAR(40) NULL,
				`tyre_spare` VARCHAR(40) NULL,
				`tyre_spare_condition` VARCHAR(40) NULL,
				`wheel_spanner` VARCHAR(40) NULL,
				`wheel_cups` TEXT NULL,
				`tri_angles` VARCHAR(40) NULL,
				`other` TEXT NULL,
				`number_of_keys` VARCHAR(40) NULL,
				`vehicle_washed` VARCHAR(40) NULL,
				`tyre_r_f` VARCHAR(40) NULL,
				`tyre_r_f_1` VARCHAR(40) NULL,
				`tyre_r_f_1_1` VARCHAR(40) NULL,
				`tyre_r_r` VARCHAR(40) NULL,
				`tyre_r_r_1` VARCHAR(40) NULL,
				`tyre_r_r_1_1` VARCHAR(40) NULL,
				`tyre_l_f` VARCHAR(40) NULL,
				`tyre_l_f_1` VARCHAR(40) NULL,
				`tyre_l_f_1_1` VARCHAR(40) NULL,
				`tyer_l_r` VARCHAR(40) NULL,
				`tyer_l_r_1` VARCHAR(40) NULL,
				`tyre_l_r_1_1` VARCHAR(40) NULL,
				`fuel_gauge_amount` VARCHAR(40) NULL,
				`driver_name_and_surname` INT(11) NULL,
				`driver_persal_number` INT(11) NULL,
				`driver_signature` VARCHAR(40) NULL,
				`vehicle_return_date_signed` DATETIME NULL DEFAULT '2020-01-01 00:00:00',
				`testing_officer_name_and_surname` VARCHAR(40) NULL,
				`testing_officer_signature` VARCHAR(40) NULL,
				`vehicle_marks_1` VARCHAR(40) NULL,
				`vehicle_marks_2` VARCHAR(40) NULL,
				`vehicle_marks_3` VARCHAR(40) NULL,
				`vehicle_marks_4` VARCHAR(40) NULL,
				`vehicle_marks_5` VARCHAR(40) NULL,
				`vehicle_marks_6` VARCHAR(40) NULL,
				`vehicle_marks_7` VARCHAR(40) NULL,
				`vehicle_marks_8` VARCHAR(40) NULL,
				`remarks` TEXT NULL,
				`vehicle_return_list` VARCHAR(40) NULL
			) CHARSET latin1"
		);
		setupIndexes('vehicle_return_check_list', ['vehicle_registration_number','closing_km','driver_name_and_surname',]);

		setupTable(
			'indicates_repair_damages_found_list', " 
			CREATE TABLE IF NOT EXISTS `indicates_repair_damages_found_list` ( 
				`repair_damages_list_id` INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`repair_damages_list_id`),
				`brought_in_for_repairs` TEXT NULL,
				`after_repairs` TEXT NULL,
				`driver_name_and_surname` INT(11) NULL,
				`driver_persal_number` INT(11) NULL,
				`driver_signature` VARCHAR(40) NULL,
				`vehicle_return_date_signed` DATETIME NULL DEFAULT '2020-01-01 00:00:00',
				`company_name_and_surname` VARCHAR(40) NULL,
				`company_repesentative_signature` VARCHAR(40) NULL,
				`vehicle_return_date_signed_by_representative` DATETIME NULL DEFAULT '2020-01-01 00:00:00',
				`indicates_and_list_details_of_damages_deficiencies` VARCHAR(40) NULL
			) CHARSET latin1"
		);
		setupIndexes('indicates_repair_damages_found_list', ['driver_name_and_surname',]);

		setupTable(
			'forms', " 
			CREATE TABLE IF NOT EXISTS `forms` ( 
				`forms_id` INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`forms_id`),
				`government_motor_transport_handbook` VARCHAR(40) NULL,
				`approved_workshop_procedure_manual` VARCHAR(40) NULL,
				`vehicle_daily_check_list_and_appraisal_report` VARCHAR(40) NULL,
				`z181_report_on_accident` VARCHAR(40) NULL,
				`vehicle_handing_over_ckecklist` VARCHAR(40) NULL,
				`vehicle_return_list` VARCHAR(40) NULL,
				`indicates_and_list_details_of_damages_deficiencies` VARCHAR(40) NULL
			) CHARSET latin1"
		);

		setupTable(
			'identification_of_defects', " 
			CREATE TABLE IF NOT EXISTS `identification_of_defects` ( 
				`defects_id` INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`defects_id`),
				`vehicle_registration_number` INT(11) NULL,
				`engine_number` INT(11) NULL,
				`make_of_vehicle` INT(11) NULL,
				`end_user_name_and_surname` VARCHAR(40) NULL,
				`end_user_contact_details` VARCHAR(40) NULL,
				`end_user_persal_number` VARCHAR(40) NULL,
				`end_user_email_address` VARCHAR(40) NULL,
				`end_user_signature` VARCHAR(40) NULL,
				`types_of_defects` TEXT NULL,
				`courses_of_defects` TEXT NULL,
				`condition_of_defects` TEXT NULL,
				`transport_officer_name_and_surname` VARCHAR(40) NULL,
				`transport_officer_persal_number` VARCHAR(40) NULL,
				`transport_officer_contact_details` VARCHAR(40) NULL,
				`transport_officer_email_address` VARCHAR(40) NULL,
				`government_garage_manager_name_and_surname` VARCHAR(40) NULL,
				`government_garage_manager_contact_details` VARCHAR(40) NULL,
				`government_garage_manager_address` TEXT NULL,
				`government_garage_manager_email_address` VARCHAR(40) NULL,
				`government_garage_manager_signature` VARCHAR(40) NULL
			) CHARSET latin1"
		);
		setupIndexes('identification_of_defects', ['vehicle_registration_number',]);

		setupTable(
			'gate_security', " 
			CREATE TABLE IF NOT EXISTS `gate_security` ( 
				`gate_security_user_id` INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`gate_security_user_id`),
				`gate_security_name_and_surname` VARCHAR(40) NULL,
				`gate_security_contact_details` VARCHAR(40) NULL,
				`gate_security_signature` VARCHAR(40) NULL,
				`date_of_vehicle_entrance` DATETIME NULL,
				`vehicle_registration_number` INT(11) NULL,
				`engine_number` INT(11) NULL,
				`make_of_vehicle` INT(11) NULL,
				`vehicle_colour` INT(11) NULL,
				`vehicle_inspection` VARCHAR(40) NULL,
				`vehicle_tires_size` VARCHAR(40) NULL,
				`vehicle_tires_check` VARCHAR(40) NULL,
				`vehicle_mirrow_check` VARCHAR(40) NULL,
				`vehicle_interiour_condition` TEXT NULL,
				`vehicle_exteriour_condition` TEXT NULL,
				`gate_security_company_name` VARCHAR(40) NULL,
				`gate_security_company_contact_details` VARCHAR(40) NULL,
				`gate_security_manager_name_and_surname` VARCHAR(40) NULL,
				`gate_security_manager_contact_details` VARCHAR(40) NULL,
				`gate_security_company_address` TEXT NULL,
				`inspection_of_vehicle_report` VARCHAR(40) NULL,
				`record_of_vehicle` VARCHAR(40) NULL,
				`date_of_vehicle_exit` DATETIME NULL
			) CHARSET latin1"
		);
		setupIndexes('gate_security', ['vehicle_registration_number',]);

		setupTable(
			'reception', " 
			CREATE TABLE IF NOT EXISTS `reception` ( 
				`reception_user_id` INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`reception_user_id`),
				`reception_name_and_surname` VARCHAR(40) NULL,
				`reception_persal_number` VARCHAR(40) NULL,
				`reception_contact_details` VARCHAR(40) NULL,
				`reception_email_address` VARCHAR(40) NULL,
				`reception_signature` VARCHAR(40) NULL,
				`date_of_vehicle_entrance` DATETIME NULL,
				`service_status` VARCHAR(40) NULL,
				`district` INT(11) NULL,
				`location` INT(11) NULL,
				`workshop_address` TEXT NULL,
				`vehicle_registration_number` INT(11) NULL,
				`engine_number` INT(11) NULL,
				`make_of_vehicle` INT(11) NULL,
				`breakdown_of_vehicle` INT(11) NULL,
				`description_of_vehicle_breakdown_notes` TEXT NULL,
				`description_of_vehicle_report` TEXT NULL,
				`upload_of_vehicle_report` TEXT NULL,
				`description_of_vehicle_breakdown` TEXT NULL,
				`job_card_number` VARCHAR(40) NULL,
				`visual_inspection_form` VARCHAR(40) NULL,
				`damage_report` VARCHAR(40) NULL,
				`date_of_vehicle_exit` DATETIME NULL,
				`payment` VARCHAR(40) NULL
			) CHARSET latin1"
		);
		setupIndexes('reception', ['district','vehicle_registration_number',]);

		setupTable(
			'inspection_bay', " 
			CREATE TABLE IF NOT EXISTS `inspection_bay` ( 
				`inspection_bay_id` INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`inspection_bay_id`),
				`inspection_bay_supervisor_name_and_surname` VARCHAR(40) NULL,
				`supervisor_contact_details` VARCHAR(40) NULL,
				`supervisor_email_address` VARCHAR(40) NULL,
				`supervisor_signature` VARCHAR(40) NULL,
				`date_of_vehicle_entrance` DATETIME NULL,
				`job_card_number` INT NULL,
				`vehicle_registration_number` INT(11) NULL,
				`engine_number` INT(11) NULL,
				`workshop_name` INT NULL,
				`work_allocation_reference_number` INT NULL,
				`make_of_vehicle` INT(11) NULL,
				`inspection_bay_lane_number` VARCHAR(40) NULL,
				`inspection_bay_condition` TEXT NULL,
				`allocation_feedback` TEXT NULL,
				`verification_of_defects` TEXT NULL,
				`additional_defects` TEXT NULL,
				`additional_defects_record` VARCHAR(40) NULL,
				`repair_requirement_note` TEXT NULL,
				`repair_requirement_report` VARCHAR(40) NULL,
				`date_of_vehicle_exit` DATETIME NULL
			) CHARSET latin1"
		);
		setupIndexes('inspection_bay', ['job_card_number','vehicle_registration_number','work_allocation_reference_number',]);

		setupTable(
			'work_allocation', " 
			CREATE TABLE IF NOT EXISTS `work_allocation` ( 
				`work_allocation_id` INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`work_allocation_id`),
				`district` INT(11) NULL,
				`location` INT(11) NULL,
				`cost_centre` INT(11) NULL,
				`supervisor_name_and_surname` VARCHAR(40) NULL,
				`supervisor_contact_details` VARCHAR(40) NULL,
				`supervisor_email_address` VARCHAR(40) NULL,
				`supervisor_signature` VARCHAR(40) NULL,
				`economical_repair` VARCHAR(40) NULL,
				`uneconomical_repair` VARCHAR(40) NULL,
				UNIQUE `uneconomical_repair_unique` (`uneconomical_repair`),
				`work_allocation_reference_number` VARCHAR(40) NULL,
				`vehicle_registration_number` INT(11) NULL,
				`engine_number` INT(11) NULL,
				`make_of_vehicle` INT(11) NULL,
				`date_captured` DATETIME NULL
			) CHARSET latin1"
		);
		setupIndexes('work_allocation', ['district','cost_centre','vehicle_registration_number',]);

		setupTable(
			'internal_repairs_mechanical', " 
			CREATE TABLE IF NOT EXISTS `internal_repairs_mechanical` ( 
				`internal_mechanical_id` SMALLINT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`internal_mechanical_id`),
				`workshop_name` INT(11) NULL,
				`artisan_name_and_surname` VARCHAR(40) NULL,
				`artisan_contacts` VARCHAR(40) NULL,
				`artisan_email_address` VARCHAR(40) NULL,
				`artisan_signature` VARCHAR(40) NULL,
				`artisan_note_of_starting_time` DATETIME NULL,
				`job_card_number` INT NULL,
				`work_allocation_reference_number` INT NULL,
				`vehicle_registration_number` INT(11) NULL,
				`engine_number` INT(11) NULL,
				`make_of_vehicle` INT(11) NULL,
				`pre_repair_inspections` TEXT NULL,
				`artisan_dismantling_solution` TEXT NULL,
				`spares_order_quotation` VARCHAR(40) NULL,
				`spares_order_description` TEXT NULL,
				`artisan_note_of_completion_time` DATETIME NULL,
				`inspection_bay_lane_number` INT NULL,
				`inspection_bay_report` VARCHAR(40) NULL,
				`total_labour_time` TIME NULL
			) CHARSET latin1"
		);
		setupIndexes('internal_repairs_mechanical', ['workshop_name','job_card_number','work_allocation_reference_number','vehicle_registration_number','make_of_vehicle','inspection_bay_lane_number',]);

		setupTable(
			'external_repairs_mechanical', " 
			CREATE TABLE IF NOT EXISTS `external_repairs_mechanical` ( 
				`external_mechanical_id` INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`external_mechanical_id`),
				`department_inspector_name_and_surname` VARCHAR(40) NULL,
				`department_inspector_persal_number` VARCHAR(40) NULL,
				`department_authorization_quote_note` TEXT NULL,
				`department_inspector_signature` VARCHAR(40) NULL,
				`inspection_approval_repair_note` TEXT NULL,
				`department_authorization_quote` VARCHAR(40) NULL,
				`service_provider_name` INT NULL,
				`service_provider_type` INT NULL,
				`service_provider_contact_details` INT NULL,
				`service_provider_address` INT NULL,
				`service_provider_signature` VARCHAR(40) NULL,
				`service_provider_repair_quote_upload` VARCHAR(40) NULL,
				`service_provider_repair_quote` TEXT NULL,
				`repair_requirement_note` TEXT NULL,
				`merchant_type` INT NULL,
				`merchant_code` INT NULL,
				`merchant_name` INT NULL,
				`merchant_contacts_details` INT NULL,
				`merchant_email_address` INT NULL,
				`merchant_signature` VARCHAR(40) NULL,
				`merchant_address` INT NULL,
				`merchant_address_code` INT NULL,
				`date_of_vehicle_send` DATETIME NULL,
				`authorization_number` INT(11) NULL,
				`instruction_note` INT(11) NULL,
				`work_allocation_reference_number` INT NULL,
				`vehicle_registration_number` INT(11) NULL,
				`engine_number` INT(11) NULL,
				`make_of_vehicle` INT(11) NULL,
				`date_of_vehicle_received` DATETIME NULL,
				`mechanical_repair_progress_monitor` VARCHAR(40) NULL,
				`mechanical_repair_progress_monitor_quality_of_work_manship` VARCHAR(40) NULL,
				`vehicle_inspection_report` VARCHAR(40) NULL,
				`upload_invoice` VARCHAR(40) NULL
			) CHARSET latin1"
		);
		setupIndexes('external_repairs_mechanical', ['service_provider_name','service_provider_type','service_provider_contact_details','service_provider_address','merchant_type','merchant_code','merchant_name','merchant_contacts_details','merchant_email_address','merchant_address','merchant_address_code','authorization_number','instruction_note','work_allocation_reference_number','vehicle_registration_number',]);

		setupTable(
			'internal_repairs_body', " 
			CREATE TABLE IF NOT EXISTS `internal_repairs_body` ( 
				`internal_repairs_body_id` INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`internal_repairs_body_id`),
				`driver_name_and_surname` INT(11) NULL,
				`driver_persal_number` INT(11) NULL,
				`driver_contacts_details` INT(11) NULL,
				`driver_email_address` INT(11) NULL,
				`driver_license_code` INT(11) NULL,
				`driver_license_number` INT(11) NULL,
				`driver_license_upload` VARCHAR(40) NULL,
				`driver_signature` VARCHAR(40) NULL,
				`vehicle_registration_number` INT(11) NULL,
				`engine_number` INT(11) NULL,
				`make_of_vehicle` INT(11) NULL,
				`z181_accident_form` VARCHAR(40) NULL,
				`z181_accident_form_uploaded` VARCHAR(40) NULL,
				`job_card_number` INT NULL,
				`work_allocation_reference_number` INT NULL,
				`artisan_note_of_starting_time` DATETIME NULL,
				`government_garage_name` INT(11) NULL,
				`government_garage_contact_details` VARCHAR(40) NULL,
				`government_garage_address` TEXT NULL,
				`government_garage_email_address` VARCHAR(40) NULL,
				`damages_occured` TEXT NULL,
				`upload_of_internal_damages_1` VARCHAR(40) NULL,
				`upload_of_internal_damages_2` VARCHAR(40) NULL,
				`upload_of_internal_damages_3` VARCHAR(40) NULL,
				`upload_of_internal_damages_4` VARCHAR(40) NULL,
				`head_panel_beating_quotation` VARCHAR(40) NULL,
				`head_panel_beating_quotation_1` VARCHAR(40) NULL,
				`head_panel_beating_name` VARCHAR(40) NULL,
				`head_panel_beating_contact_details` VARCHAR(40) NULL,
				`head_panel_beating_address` TEXT NULL,
				`head_panel_beating_signature` VARCHAR(40) NULL,
				`private_panel_beating_name` VARCHAR(40) NULL,
				`private_panel_beating_contact_details` VARCHAR(40) NULL,
				`private_panel_beating_address` TEXT NULL,
				`private_panel_beating_quotation` VARCHAR(40) NULL,
				`private_panel_beating_quotation_2` VARCHAR(40) NULL,
				`artisan_note_of_completion_time` DATETIME NULL,
				`total_labour_time` TIME NULL
			) CHARSET latin1"
		);
		setupIndexes('internal_repairs_body', ['driver_name_and_surname','vehicle_registration_number','job_card_number','work_allocation_reference_number','government_garage_name',]);

		setupTable(
			'external_repairs_body', " 
			CREATE TABLE IF NOT EXISTS `external_repairs_body` ( 
				`external_repair_body_id` INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`external_repair_body_id`),
				`head_panel_beating_name` VARCHAR(40) NULL,
				`head_panel_beating_contact_details` VARCHAR(40) NULL,
				`head_panel_beating_address` TEXT NULL,
				`head_panel_beating_signature` VARCHAR(40) NULL,
				`panel_beating_quotation` VARCHAR(40) NULL,
				`panel_beating_quotation_approved_by_service_provider` VARCHAR(40) NULL,
				`service_provider_name` INT NULL,
				`service_provider_type` INT NULL,
				`service_provider_contact_details` INT NULL,
				`service_provider_address` INT NULL,
				`service_provider_branch` INT NULL,
				`service_provider_branch_code` INT NULL,
				`service_provider_signature` VARCHAR(40) NULL,
				`instruction_note` INT(11) NULL,
				`authorization_number` INT(11) NULL,
				`vehicle_registration_number` INT(11) NULL,
				`engine_number` INT(11) NULL,
				`make_of_vehicle` INT(11) NULL,
				`vehicle_colour` INT(11) NULL,
				`vehicle_inspection_done` VARCHAR(40) NULL,
				`vehicle_inspection_check_list_form` VARCHAR(40) NULL,
				`vehicle_tyre_sizes` VARCHAR(40) NULL,
				`vehicle_mirrow_check` TEXT NULL,
				`vehicle_interior_condition` TEXT NULL,
				`vehicle_exterior_condition` TEXT NULL,
				`merchant_type` INT NULL,
				`merchant_code` INT NULL,
				`merchant_name` INT NULL,
				`merchant_contacts_details` INT NULL,
				`merchant_email_address` VARCHAR(40) NULL,
				`merchant_signature` VARCHAR(40) NULL,
				`merchant_address` INT NULL,
				`merchant_address_code` INT NULL,
				`merchant_city` INT NULL,
				`head_panel_beating_monitor_progress` VARCHAR(40) NULL,
				`head_panel_beating_monitor_quality_of_work_manship` VARCHAR(40) NULL,
				`vehicle_inspection_report` VARCHAR(40) NULL,
				`upload_invoice` VARCHAR(40) NULL
			) CHARSET latin1"
		);
		setupIndexes('external_repairs_body', ['service_provider_name','service_provider_type','service_provider_contact_details','service_provider_address','service_provider_branch','service_provider_branch_code','instruction_note','vehicle_registration_number','merchant_type','merchant_code','merchant_name','merchant_contacts_details','merchant_address','merchant_address_code','merchant_city',]);

		setupTable(
			'ordering_of_spares_for_internal_repairs', " 
			CREATE TABLE IF NOT EXISTS `ordering_of_spares_for_internal_repairs` ( 
				`spares_id` INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`spares_id`),
				`workshop_name` INT(11) NULL,
				`job_card_number` INT NULL,
				`artisan_name_and_surname` VARCHAR(40) NULL,
				`artisan_contacts` VARCHAR(40) NULL,
				`artisan_email_address` VARCHAR(40) NULL,
				`artisan_signature` VARCHAR(40) NULL,
				`internal_requisition_to_stores` VARCHAR(40) NULL,
				`supervisor_name_and_surname` VARCHAR(40) NULL,
				`supervisor_contact_details` VARCHAR(40) NULL,
				`supervisor_email_address` VARCHAR(40) NULL,
				`supervisor_signature` VARCHAR(40) NULL,
				`internal_requisition_to_stores_recommended` VARCHAR(40) NULL,
				`workshop_manager_name_and_surname` VARCHAR(40) NULL,
				`workshop_manager_contact_details` VARCHAR(40) NULL,
				`workshop_manager_email_address` VARCHAR(40) NULL,
				`workshop_manager_signature` VARCHAR(40) NULL,
				`internal_requisition_to_stores_approved` VARCHAR(40) NULL,
				`date_parts_ordered` DATETIME NULL,
				`vehicle_registration_number` INT(11) NULL,
				`engine_number` INT(11) NULL,
				`make_of_vehicle` INT(11) NULL,
				`part_type_1` INT(11) NULL,
				`part_name_1` INT(11) NULL,
				`description_1` INT(11) NULL,
				`manufacture_1` INT(11) NULL,
				`quality_1` VARCHAR(40) NULL,
				`unit_price_1` DECIMAL(10,2) NULL,
				`net_part_price_1` DECIMAL(10,2) NULL,
				`part_type_2` INT(11) NULL,
				`part_name_2` INT(11) NULL,
				`description_2` INT(11) NULL,
				`manufacture_2` INT(11) NULL,
				`quality_2` VARCHAR(40) NULL,
				`unit_price_2` DECIMAL(10,2) NULL,
				`net_part_price_2` DECIMAL(10,2) NULL,
				`part_type_3` INT(11) NULL,
				`part_name_3` INT(11) NULL,
				`description_3` INT(11) NULL,
				`manufacture_3` INT(11) NULL,
				`quality_3` VARCHAR(40) NULL,
				`unit_price_3` DECIMAL(10,2) NULL,
				`net_part_price_3` DECIMAL(10,2) NULL,
				`part_type_4` INT(11) NULL,
				`part_name_4` INT(11) NULL,
				`description_4` INT(11) NULL,
				`manufacture_4` INT(11) NULL,
				`quality_4` VARCHAR(40) NULL,
				`unit_price_4` DECIMAL(10,2) NULL,
				`net_part_price_4` DECIMAL(10,2) NULL,
				`part_type_5` INT(11) NULL,
				`part_name_5` INT(11) NULL,
				`description_5` INT(11) NULL,
				`manufacture_5` INT(11) NULL,
				`quality_5` VARCHAR(40) NULL,
				`unit_price_5` DECIMAL(10,2) NULL,
				`net_part_price_5` DECIMAL(10,2) NULL,
				`part_type_6` INT(11) NULL,
				`part_name_6` INT(11) NULL,
				`description_6` INT(11) NULL,
				`manufacture_6` INT(11) NULL,
				`quality_6` VARCHAR(40) NULL,
				`unit_price_6` DECIMAL(10,2) NULL,
				`net_part_price_6` DECIMAL(10,2) NULL,
				`part_type_7` INT(11) NULL,
				`part_name_7` INT(11) NULL,
				`description_7` INT(11) NULL,
				`manufacture_7` INT(11) NULL,
				`quality_7` VARCHAR(40) NULL,
				`unit_price_7` DECIMAL(10,2) NULL,
				`net_part_price_7` DECIMAL(10,2) NULL,
				`part_type_8` INT(11) NULL,
				`part_name_8` INT(11) NULL,
				`description_8` INT(11) NULL,
				`manufacture_8` INT(11) NULL,
				`unit_price_8` DECIMAL(10,2) NULL,
				`quality_8` VARCHAR(40) NULL,
				`net_part_price_8` DECIMAL(10,2) NULL,
				`tax` DECIMAL(10,2) NULL,
				`total_amount` DECIMAL(10,2) NULL,
				`attached_requisition_form` VARCHAR(40) NULL,
				`work_allocation_reference_number` INT NULL,
				`date_parts_received` DATETIME NULL
			) CHARSET latin1"
		);
		setupIndexes('ordering_of_spares_for_internal_repairs', ['workshop_name','job_card_number','vehicle_registration_number','part_type_1','part_name_1','description_1','manufacture_1','part_type_2','part_name_2','description_2','manufacture_2','part_type_3','part_name_3','description_3','manufacture_3','part_type_4','part_name_4','description_4','manufacture_4','part_type_5','part_name_5','description_5','manufacture_5','part_type_6','part_name_6','description_6','manufacture_6','part_type_7','part_name_7','description_7','manufacture_7','part_type_8','part_name_8','description_8','manufacture_8','work_allocation_reference_number',]);

		setupTable(
			'collection_of_repaired_vehicles', " 
			CREATE TABLE IF NOT EXISTS `collection_of_repaired_vehicles` ( 
				`collection_id` INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`collection_id`),
				`reception_name_and_surname` INT NULL,
				`reception_persal_number` INT NULL,
				`reception_contact_details` INT NULL,
				`reception_email_address` INT NULL,
				`reception_signature` VARCHAR(40) NULL,
				`driver_name_and_surname` INT(11) NULL,
				`driver_persal_number` INT(11) NULL,
				`driver_contacts_details` INT(11) NULL,
				`driver_email_address` INT(11) NULL,
				`driver_license_upload` VARCHAR(40) NULL,
				`driver_signature` VARCHAR(40) NULL,
				`government_garage_name` INT(11) NULL,
				`government_garage_contact_details` VARCHAR(40) NULL,
				`government_garage_address` TEXT NULL,
				`government_garage_email_address` VARCHAR(40) NULL,
				`vehicle_registration_number` INT(11) NULL,
				`engine_number` INT(11) NULL,
				`make_of_vehicle` INT(11) NULL,
				`vehicle_inspection` VARCHAR(40) NULL,
				`vehicle_inspection_form` VARCHAR(40) NULL,
				`vehicle_interiour_condition` TEXT NULL,
				`vehicle_exteriour_condition` TEXT NULL,
				`vehicle_tyre_check` VARCHAR(40) NULL,
				`sign_off_time` TIME NULL,
				`date_of_repaired_vehicle_collection` DATETIME NULL
			) CHARSET latin1"
		);
		setupIndexes('collection_of_repaired_vehicles', ['reception_name_and_surname','driver_name_and_surname','government_garage_name','vehicle_registration_number',]);

		setupTable(
			'withdrawal_vehicle_from_operation', " 
			CREATE TABLE IF NOT EXISTS `withdrawal_vehicle_from_operation` ( 
				`withdrawal_id` INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`withdrawal_id`),
				`supervisor_name_and_surname` VARCHAR(40) NULL,
				`supervisor_contact_details` VARCHAR(40) NULL,
				`supervisor_email_address` VARCHAR(40) NULL,
				`supervisor_signature` VARCHAR(40) NULL,
				`vehicle_registration_number` INT(11) NULL,
				`engine_number` INT(11) NULL,
				`make_of_vehicle` INT(11) NULL,
				`purchased_price` INT(11) NULL,
				`date_of_service` INT NULL,
				`date_of_next_service` INT NULL,
				`renewal_of_license` INT(11) NULL,
				`date_of_vehicle` DATETIME NULL,
				`description_of_vehicle_breakdown` TEXT NULL,
				`tyre_inspection_report` VARCHAR(40) NULL,
				`document_checklist_report` VARCHAR(40) NULL,
				`compiled_technical_report` VARCHAR(40) NULL,
				`district_officer_name_and_surname` VARCHAR(40) NULL,
				`district_officer_persal_number` VARCHAR(40) NULL,
				`district_officer_contacts` VARCHAR(40) NULL,
				`district_officer_signature` VARCHAR(40) NULL,
				`district_officer_email_address` VARCHAR(40) NULL
			) CHARSET latin1"
		);
		setupIndexes('withdrawal_vehicle_from_operation', ['vehicle_registration_number','date_of_service',]);

		setupTable(
			'costing', " 
			CREATE TABLE IF NOT EXISTS `costing` ( 
				`costing_id` INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`costing_id`),
				`government_garage_name` INT(11) NULL,
				`supervisor_name_and_surname` VARCHAR(40) NULL,
				`supervisor_contact_details` VARCHAR(40) NULL,
				`supervisor_email_address` VARCHAR(40) NULL,
				`supervisor_signature` VARCHAR(40) NULL,
				`job_card_number` INT NULL,
				`vehicle_registration_number` INT(11) NULL,
				`engine_number` INT(11) NULL,
				`make_of_vehicle` INT(11) NULL,
				`reconciliation_of_total_costs_by_costing_officer` VARCHAR(40) NULL,
				`costing_officer_name_and_surname` VARCHAR(40) NULL,
				`costing_officer_contact_details` VARCHAR(40) NULL,
				`costing_officer_email_address` VARCHAR(40) NULL,
				`costing_officer_signature` VARCHAR(40) NULL,
				`material_cost` DECIMAL(10,2) NULL,
				`spares_orders_quotation` DECIMAL(10,2) NULL,
				`spares_orders_quotation_upload` VARCHAR(40) NULL,
				`standard_labour_cost_per_hour` DECIMAL(10,2) NULL,
				`labour_quotation` DECIMAL(10,2) NULL,
				`labour_quotation_upload` VARCHAR(40) NULL,
				`vat` DECIMAL(10,2) NULL,
				`total_amount` DECIMAL(10,2) NULL,
				`workshop_manager_name_and_surname` VARCHAR(40) NULL,
				`workshop_manager_contact_details` VARCHAR(40) NULL,
				`workshop_manager_email_address` VARCHAR(40) NULL,
				`workshop_manager_signature` VARCHAR(40) NULL,
				`invoice_approved` VARCHAR(40) NULL,
				`invoice_date` DATE NULL DEFAULT '0000-00-00',
				`upload_invoice` VARCHAR(40) NULL
			) CHARSET latin1"
		);
		setupIndexes('costing', ['government_garage_name','job_card_number','vehicle_registration_number',]);

		setupTable(
			'billing', " 
			CREATE TABLE IF NOT EXISTS `billing` ( 
				`billing_id` INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`billing_id`),
				`district` INT(11) NULL,
				`location` INT(11) NULL,
				`upload_invoice` VARCHAR(40) NULL,
				`job_card_number` INT NULL,
				`invoice_date` DATE NULL DEFAULT '0000-00-00',
				`maintenance_file` VARCHAR(40) NULL,
				`vehicle_registration_number` INT(11) NULL,
				`engine_number` INT(11) NULL,
				`make_of_vehicle` INT(11) NULL
			) CHARSET latin1"
		);
		setupIndexes('billing', ['district','job_card_number','vehicle_registration_number',]);

		setupTable(
			'general_control_measures', " 
			CREATE TABLE IF NOT EXISTS `general_control_measures` ( 
				`general_control_measures_id` INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`general_control_measures_id`),
				`district` INT(11) NULL,
				`cost_centre` INT(11) NULL,
				`location` INT(11) NULL,
				`government_garage_name` INT(11) NULL,
				`government_garage_section` VARCHAR(40) NULL,
				`government_garage_manager_name_and_surname` VARCHAR(40) NULL,
				`government_garage_manager_contact_details` VARCHAR(40) NULL,
				`government_garage_manager_email_address` VARCHAR(40) NULL,
				`government_garage_manager_signature` VARCHAR(40) NULL,
				`government_garage_address` TEXT NULL,
				`government_garage_condition` VARCHAR(40) NULL,
				`four_post_lift_condition` VARCHAR(40) NULL,
				`low_level_lift_condition` VARCHAR(40) NULL,
				`test_machines_conditions` VARCHAR(40) NULL,
				`battery_testers_conditions` VARCHAR(40) NULL,
				`chargers_conditions` VARCHAR(40) NULL,
				`tools_conditions` INT NULL,
				`hand_tools_conditions` INT NULL,
				`equipment_conditions` VARCHAR(40) NULL,
				`sectional_inspection` VARCHAR(40) NULL
			) CHARSET latin1"
		);
		setupIndexes('general_control_measures', ['district','cost_centre',]);

		setupTable(
			'movement_of_personnel_in_government_garage_and_workshops', " 
			CREATE TABLE IF NOT EXISTS `movement_of_personnel_in_government_garage_and_workshops` ( 
				`movement_id` INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`movement_id`),
				`vehicle_inspection` INT NULL,
				`vehicle_model` VARCHAR(40) NULL,
				`vehicle_number_plate` VARCHAR(40) NULL,
				`vehicle_tires_check` VARCHAR(40) NULL,
				`vehicle_mirrow_check` VARCHAR(40) NULL,
				`gate_security_signature` VARCHAR(40) NULL,
				`government_garage_protocol` VARCHAR(40) NULL,
				`government_garage_safety` VARCHAR(40) NULL,
				`vehicle_handing_over_checklist` VARCHAR(40) NULL,
				`vehicle_return_list` VARCHAR(40) NULL,
				`approved_workshop_procedure_manual` VARCHAR(40) NULL,
				`vehicle_registration_number` VARCHAR(25) NULL,
				`engine_number` VARCHAR(35) NULL,
				`make_of_vehicle` INT(11) NULL
			) CHARSET latin1"
		);
		setupIndexes('movement_of_personnel_in_government_garage_and_workshops', ['vehicle_inspection','make_of_vehicle',]);

		setupTable(
			'service_provider', " 
			CREATE TABLE IF NOT EXISTS `service_provider` ( 
				`service_provider_id` INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`service_provider_id`),
				`service_provider_type` INT(11) NULL,
				`service_provider_name` VARCHAR(40) NULL,
				`service_provider_contact_email` VARCHAR(40) NULL,
				`service_provider_contact_details` VARCHAR(40) NULL,
				`service_provider_street_address` TEXT NULL,
				`service_provider_branch_code` VARCHAR(40) NULL,
				`service_provider_branch` VARCHAR(40) NULL,
				`service_provider_city` VARCHAR(40) NULL,
				`service_provider_address_code` VARCHAR(40) NULL
			) CHARSET latin1"
		);
		setupIndexes('service_provider', ['service_provider_type',]);

		setupTable(
			'service_provider_type', " 
			CREATE TABLE IF NOT EXISTS `service_provider_type` ( 
				`service_provider_type_id` INT(11) NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`service_provider_type_id`),
				`service_provider_type` VARCHAR(40) NULL
			) CHARSET latin1"
		);

		setupTable(
			'vehicle_annual_inspection', " 
			CREATE TABLE IF NOT EXISTS `vehicle_annual_inspection` ( 
				`fleet_asset_id` INT(11) NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`fleet_asset_id`),
				`vehicle_registration_number` INT(11) NOT NULL,
				`register_number` INT(11) NOT NULL,
				`engine_number` INT(11) NOT NULL,
				`chassis_number` INT(11) NOT NULL,
				`make_of_vehicle` INT(11) NOT NULL,
				`model_of_vehicle` INT(11) NOT NULL,
				`year_model_specification` INT(11) NOT NULL,
				`engine_capacity` INT(11) NOT NULL,
				`tyre_size` INT(11) NULL,
				`transmission` INT(11) NULL,
				`fuel_type` INT(11) NULL,
				`type_of_vehicle` INT(11) NULL,
				`colour_of_vehicle` INT(11) NULL,
				`application_status` INT(11) NULL,
				`renewal_of_license` INT(11) NULL,
				`barcode_number` INT(11) NULL,
				`last_entry_logbook` DATE NULL,
				`photo_of_vehicle` VARCHAR(255) NULL,
				`department_name` INT(11) NOT NULL,
				`province` INT(11) NOT NULL,
				`district` INT(11) NOT NULL,
				`mechanical_inspection` LONGTEXT NULL,
				`upholstery` LONGTEXT NULL,
				`electrical_inspection` LONGTEXT NULL,
				`wheel_spanner` VARCHAR(40) NULL,
				`spare_wheel` VARCHAR(40) NULL,
				`jack` VARCHAR(40) NULL,
				`radio` VARCHAR(40) NULL,
				`triangle` VARCHAR(40) NULL,
				`log_book` VARCHAR(40) NULL,
				`iternary` VARCHAR(40) NULL,
				`fuel_card` VARCHAR(40) NULL,
				`recommendation` LONGTEXT NULL,
				`documents` VARCHAR(225) NULL,
				`checking_officer_name_and_surname` VARCHAR(40) NOT NULL,
				`checking_officer_contact_email` VARCHAR(40) NOT NULL,
				`date_of_inspection` DATE NULL DEFAULT '0000-00-00'
			) CHARSET latin1"
		);
		setupIndexes('vehicle_annual_inspection', ['vehicle_registration_number','register_number','department_name','province','district',]);



		// save MD5
		@file_put_contents($setupHash, $thisMD5);
	}


	function setupIndexes($tableName, $arrFields) {
		if(!is_array($arrFields) || !count($arrFields)) return false;

		foreach($arrFields as $fieldName) {
			if(!$res = @db_query("SHOW COLUMNS FROM `$tableName` like '$fieldName'")) continue;
			if(!$row = @db_fetch_assoc($res)) continue;
			if($row['Key']) continue;

			@db_query("ALTER TABLE `$tableName` ADD INDEX `$fieldName` (`$fieldName`)");
		}
	}


	function setupTable($tableName, $createSQL = '', $arrAlter = '') {
		global $Translation;
		$oldTableName = '';
		ob_start();

		echo '<div style="padding: 5px; border-bottom:solid 1px silver; font-family: verdana, arial; font-size: 10px;">';

		// is there a table rename query?
		if(is_array($arrAlter)) {
			$matches = [];
			if(preg_match("/ALTER TABLE `(.*)` RENAME `$tableName`/i", $arrAlter[0], $matches)) {
				$oldTableName = $matches[1];
			}
		}

		if($res = @db_query("SELECT COUNT(1) FROM `$tableName`")) { // table already exists
			if($row = @db_fetch_array($res)) {
				echo str_replace(['<TableName>', '<NumRecords>'], [$tableName, $row[0]], $Translation['table exists']);
				if(is_array($arrAlter)) {
					echo '<br>';
					foreach($arrAlter as $alter) {
						if($alter != '') {
							echo "$alter ... ";
							if(!@db_query($alter)) {
								echo '<span class="label label-danger">' . $Translation['failed'] . '</span>';
								echo '<div class="text-danger">' . $Translation['mysql said'] . ' ' . db_error(db_link()) . '</div>';
							} else {
								echo '<span class="label label-success">' . $Translation['ok'] . '</span>';
							}
						}
					}
				} else {
					echo $Translation['table uptodate'];
				}
			} else {
				echo str_replace('<TableName>', $tableName, $Translation['couldnt count']);
			}
		} else { // given tableName doesn't exist

			if($oldTableName != '') { // if we have a table rename query
				if($ro = @db_query("SELECT COUNT(1) FROM `$oldTableName`")) { // if old table exists, rename it.
					$renameQuery = array_shift($arrAlter); // get and remove rename query

					echo "$renameQuery ... ";
					if(!@db_query($renameQuery)) {
						echo '<span class="label label-danger">' . $Translation['failed'] . '</span>';
						echo '<div class="text-danger">' . $Translation['mysql said'] . ' ' . db_error(db_link()) . '</div>';
					} else {
						echo '<span class="label label-success">' . $Translation['ok'] . '</span>';
					}

					if(is_array($arrAlter)) setupTable($tableName, $createSQL, false, $arrAlter); // execute Alter queries on renamed table ...
				} else { // if old tableName doesn't exist (nor the new one since we're here), then just create the table.
					setupTable($tableName, $createSQL, false); // no Alter queries passed ...
				}
			} else { // tableName doesn't exist and no rename, so just create the table
				echo str_replace("<TableName>", $tableName, $Translation["creating table"]);
				if(!@db_query($createSQL)) {
					echo '<span class="label label-danger">' . $Translation['failed'] . '</span>';
					echo '<div class="text-danger">' . $Translation['mysql said'] . db_error(db_link()) . '</div>';
				} else {
					echo '<span class="label label-success">' . $Translation['ok'] . '</span>';
				}
			}

			// set Admin group permissions for newly created table if membership_grouppermissions exists
			if($ro = @db_query("SELECT COUNT(1) FROM `membership_grouppermissions`")) {
				// get Admins group id
				$ro = @db_query("SELECT `groupID` FROM `membership_groups` WHERE `name`='Admins'");
				if($ro) {
					$adminGroupID = intval(db_fetch_row($ro)[0]);
					if($adminGroupID) @db_query("INSERT IGNORE INTO `membership_grouppermissions` SET
						`groupID`='$adminGroupID',
						`tableName`='$tableName',
						`allowInsert`=1, `allowView`=1, `allowEdit`=1, `allowDelete`=1
					");
				}
			}
		}

		echo '</div>';

		$out = ob_get_clean();
		if(defined('APPGINI_SETUP') && APPGINI_SETUP) echo $out;
	}
