<?php

	#########################################################
	/*
	~~~~~~ LIST OF FUNCTIONS ~~~~~~
		get_table_groups() -- returns an associative array (table_group => tables_array)
		getTablePermissions($tn) -- returns an array of permissions allowed for logged member to given table (allowAccess, allowInsert, allowView, allowEdit, allowDelete) -- allowAccess is set to true if any access level is allowed
		get_sql_fields($tn) -- returns the SELECT part of the table view query
		get_sql_from($tn[, true, [, false]]) -- returns the FROM part of the table view query, with full joins (unless third paramaeter is set to true), optionally skipping permissions if true passed as 2nd param.
		get_joined_record($table, $id[, true]) -- returns assoc array of record values for given PK value of given table, with full joins, optionally skipping permissions if true passed as 3rd param.
		get_defaults($table) -- returns assoc array of table fields as array keys and default values (or empty), excluding automatic values as array values
		htmlUserBar() -- returns html code for displaying user login status to be used on top of pages.
		showNotifications($msg, $class) -- returns html code for displaying a notification. If no parameters provided, processes the GET request for possible notifications.
		parseMySQLDate(a, b) -- returns a if valid mysql date, or b if valid mysql date, or today if b is true, or empty if b is false.
		parseCode(code) -- calculates and returns special values to be inserted in automatic fields.
		addFilter(i, filterAnd, filterField, filterOperator, filterValue) -- enforce a filter over data
		clearFilters() -- clear all filters
		loadView($view, $data) -- passes $data to templates/{$view}.php and returns the output
		loadTable($table, $data) -- loads table template, passing $data to it
		br2nl($text) -- replaces all variations of HTML <br> tags with a new line character
		entitiesToUTF8($text) -- convert unicode entities (e.g. &#1234;) to actual UTF8 characters, requires multibyte string PHP extension
		func_get_args_byref() -- returns an array of arguments passed to a function, by reference
		permissions_sql($table, $level) -- returns an array containing the FROM and WHERE additions for applying permissions to an SQL query
		error_message($msg[, $back_url]) -- returns html code for a styled error message .. pass explicit false in second param to suppress back button
		toMySQLDate($formattedDate, $sep = datalist_date_separator, $ord = datalist_date_format)
		reIndex(&$arr) -- returns a copy of the given array, with keys replaced by 1-based numeric indices, and values replaced by original keys
		get_embed($provider, $url[, $width, $height, $retrieve]) -- returns embed code for a given url (supported providers: youtube, googlemap)
		check_record_permission($table, $id, $perm = 'view') -- returns true if current user has the specified permission $perm ('view', 'edit' or 'delete') for the given recors, false otherwise
		NavMenus($options) -- returns the HTML code for the top navigation menus. $options is not implemented currently.
		StyleSheet() -- returns the HTML code for included style sheet files to be placed in the <head> section.
		getUploadDir($dir) -- if dir is empty, returns upload dir configured in defaultLang.php, else returns $dir.
		PrepareUploadedFile($FieldName, $MaxSize, $FileTypes={image file types}, $NoRename=false, $dir="") -- validates and moves uploaded file for given $FieldName into the given $dir (or the default one if empty)
		get_home_links($homeLinks, $default_classes, $tgroup) -- process $homeLinks array and return custom links for homepage. Applies $default_classes to links if links have classes defined, and filters links by $tgroup (using '*' matches all table_group values)
		quick_search_html($search_term, $label, $separate_dv = true) -- returns HTML code for the quick search box.
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	*/

	#########################################################

	function get_table_groups($skip_authentication = false) {
		$tables = getTableList($skip_authentication);
		$all_groups = ['Vehicle', 'Logs', 'Claims', 'Maintenance', 'Repairs', 'Expenses', 'Location', 'Merchant', 'Manufacturer', 'Forms'];

		$groups = [];
		foreach($all_groups as $grp) {
			foreach($tables as $tn => $td) {
				if($td[3] && $td[3] == $grp) $groups[$grp][] = $tn;
				if(!$td[3]) $groups[0][] = $tn;
			}
		}

		return $groups;
	}

	#########################################################

	function getTablePermissions($tn) {
		static $table_permissions = [];
		if(isset($table_permissions[$tn])) return $table_permissions[$tn];

		$groupID = getLoggedGroupID();
		$memberID = makeSafe(getLoggedMemberID());
		$res_group = sql("SELECT `tableName`, `allowInsert`, `allowView`, `allowEdit`, `allowDelete` FROM `membership_grouppermissions` WHERE `groupID`='{$groupID}'", $eo);
		$res_user  = sql("SELECT `tableName`, `allowInsert`, `allowView`, `allowEdit`, `allowDelete` FROM `membership_userpermissions`  WHERE LCASE(`memberID`)='{$memberID}'", $eo);

		while($row = db_fetch_assoc($res_group)) {
			$table_permissions[$row['tableName']] = [
				1 => intval($row['allowInsert']),
				2 => intval($row['allowView']),
				3 => intval($row['allowEdit']),
				4 => intval($row['allowDelete']),
				'insert' => intval($row['allowInsert']),
				'view' => intval($row['allowView']),
				'edit' => intval($row['allowEdit']),
				'delete' => intval($row['allowDelete'])
			];
		}

		// user-specific permissions, if specified, overwrite his group permissions
		while($row = db_fetch_assoc($res_user)) {
			$table_permissions[$row['tableName']] = [
				1 => intval($row['allowInsert']),
				2 => intval($row['allowView']),
				3 => intval($row['allowEdit']),
				4 => intval($row['allowDelete']),
				'insert' => intval($row['allowInsert']),
				'view' => intval($row['allowView']),
				'edit' => intval($row['allowEdit']),
				'delete' => intval($row['allowDelete'])
			];
		}

		// if user has any type of access, set 'access' flag
		foreach($table_permissions as $t => $p) {
			$table_permissions[$t]['access'] = $table_permissions[$t][0] = false;

			if($p['insert'] || $p['view'] || $p['edit'] || $p['delete']) {
				$table_permissions[$t]['access'] = $table_permissions[$t][0] = true;
			}
		}

		return $table_permissions[$tn];
	}

	#########################################################

	function get_sql_fields($table_name) {
		$sql_fields = [
			'gmt_fleet_register' => "`gmt_fleet_register`.`fleet_asset_id` as 'fleet_asset_id', `gmt_fleet_register`.`vehicle_registration_number` as 'vehicle_registration_number', `gmt_fleet_register`.`register_number` as 'register_number', `gmt_fleet_register`.`engine_number` as 'engine_number', `gmt_fleet_register`.`chassis_number` as 'chassis_number', IF(    CHAR_LENGTH(`dealer1`.`dealer_name`), CONCAT_WS('',   `dealer1`.`dealer_name`), '') as 'dealer_name', IF(    CHAR_LENGTH(`dealer2`.`make_of_vehicle`), CONCAT_WS('',   `dealer2`.`make_of_vehicle`, '   '), '') as 'make_of_vehicle', `gmt_fleet_register`.`model_of_vehicle` as 'model_of_vehicle', IF(    CHAR_LENGTH(`year_model1`.`year_model_specification`), CONCAT_WS('',   `year_model1`.`year_model_specification`), '') as 'year_model_specification', `gmt_fleet_register`.`engine_capacity` as 'engine_capacity', `gmt_fleet_register`.`tyre_size` as 'tyre_size', IF(    CHAR_LENGTH(`transmission1`.`transmission`), CONCAT_WS('',   `transmission1`.`transmission`), '') as 'transmission', IF(    CHAR_LENGTH(`fuel_type1`.`fuel_type`), CONCAT_WS('',   `fuel_type1`.`fuel_type`), '') as 'fuel_type', IF(    CHAR_LENGTH(`body_type1`.`type_of_vehicle`), CONCAT_WS('',   `body_type1`.`type_of_vehicle`), '') as 'type_of_vehicle', IF(    CHAR_LENGTH(`vehicle_colour1`.`colour_of_vehicle`), CONCAT_WS('',   `vehicle_colour1`.`colour_of_vehicle`), '') as 'colour_of_vehicle', IF(    CHAR_LENGTH(`application_status1`.`application_status`), CONCAT_WS('',   `application_status1`.`application_status`), '') as 'application_status', `gmt_fleet_register`.`case_number` as 'case_number', `gmt_fleet_register`.`barcode_number` as 'barcode_number', `gmt_fleet_register`.`purchase_price` as 'purchase_price', `gmt_fleet_register`.`depreciation_value` as 'depreciation_value', `gmt_fleet_register`.`photo_of_vehicle` as 'photo_of_vehicle', `gmt_fleet_register`.`user_name_and_surname` as 'user_name_and_surname', `gmt_fleet_register`.`user_contact_email` as 'user_contact_email', `gmt_fleet_register`.`contact_number` as 'contact_number', IF(    CHAR_LENGTH(`departments1`.`department_name`), CONCAT_WS('',   `departments1`.`department_name`), '') as 'department_name', `gmt_fleet_register`.`department_address` as 'department_address', IF(    CHAR_LENGTH(`province1`.`province`), CONCAT_WS('',   `province1`.`province`), '') as 'province', IF(    CHAR_LENGTH(`districts1`.`district`) || CHAR_LENGTH(`districts1`.`station`), CONCAT_WS('',   `districts1`.`district`, '     |     and     |     ', `districts1`.`station`), '') as 'district', IF(    CHAR_LENGTH(`driver1`.`drivers_name_and_surname`) || CHAR_LENGTH(`driver1`.`drivers_persal_number`), CONCAT_WS('',   `driver1`.`drivers_name_and_surname`, '      |    and    |         ', `driver1`.`drivers_persal_number`), '') as 'drivers_name_and_surname', IF(    CHAR_LENGTH(`driver1`.`drivers_persal_number`), CONCAT_WS('',   `driver1`.`drivers_persal_number`), '') as 'drivers_persal_number', IF(    CHAR_LENGTH(`departments2`.`department_name`), CONCAT_WS('',   `departments2`.`department_name`), '') as 'department_name_of_driver', IF(    CHAR_LENGTH(`driver1`.`drivers_contact_details`), CONCAT_WS('',   `driver1`.`drivers_contact_details`), '') as 'drivers_contact_details', `gmt_fleet_register`.`documents` as 'documents', if(`gmt_fleet_register`.`date_auctioned`,date_format(`gmt_fleet_register`.`date_auctioned`,'%d/%m/%Y'),'') as 'date_auctioned', `gmt_fleet_register`.`venue` as 'venue', `gmt_fleet_register`.`comments` as 'comments', DATE_FORMAT(`gmt_fleet_register`.`renewal_of_license`, '%b %D, %Y %l:%i%p') as 'renewal_of_license', `gmt_fleet_register`.`mm_code` as 'mm_code'",
			'log_sheet' => "`log_sheet`.`fuel_log_sheet_id` as 'fuel_log_sheet_id', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`), '') as 'vehicle_registration_number', IF(    CHAR_LENGTH(`gmt_fleet_register2`.`register_number`), CONCAT_WS('',   `gmt_fleet_register2`.`register_number`), '') as 'register_number', IF(    CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS('',   `dealer1`.`make_of_vehicle`, '   '), '') as 'make_of_vehicle', IF(    CHAR_LENGTH(`gmt_fleet_register3`.`model_of_vehicle`), CONCAT_WS('',   `gmt_fleet_register3`.`model_of_vehicle`), '') as 'model_of_vehicle', IF(    CHAR_LENGTH(`year_model1`.`year_model_specification`), CONCAT_WS('',   `year_model1`.`year_model_specification`), '') as 'year_model_specification', IF(    CHAR_LENGTH(`vehicle_colour1`.`colour_of_vehicle`), CONCAT_WS('',   `vehicle_colour1`.`colour_of_vehicle`), '') as 'colour_of_vehicle', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_capacity`), CONCAT_WS('',   `gmt_fleet_register1`.`engine_capacity`), '') as 'engine_capacity', DATE_FORMAT(`log_sheet`.`renewal_of_license`, '%b %D, %Y %l:%i%p') as 'renewal_of_license', IF(    CHAR_LENGTH(`districts1`.`district`) || CHAR_LENGTH(`districts1`.`station`) || CHAR_LENGTH(`province1`.`province`), CONCAT_WS('',   `districts1`.`district`, '     |     and     |     ', `districts1`.`station`, `province1`.`province`), '') as 'district', DATE_FORMAT(`log_sheet`.`month`, '%D %b %Y %l:%i%p') as 'month', IF(    CHAR_LENGTH(`driver1`.`drivers_name_and_surname`), CONCAT_WS('',   `driver1`.`drivers_name_and_surname`), '') as 'drivers_name_and_surname', IF(    CHAR_LENGTH(`driver1`.`drivers_persal_number`), CONCAT_WS('',   `driver1`.`drivers_persal_number`), '') as 'drivers_persal_number', `log_sheet`.`opening_km` as 'opening_km', `log_sheet`.`total_trip_distance` as 'total_trip_distance', `log_sheet`.`closing_km` as 'closing_km', IF(    CHAR_LENGTH(`fuel_type1`.`fuel_type`), CONCAT_WS('',   `fuel_type1`.`fuel_type`), '') as 'fuel_type', `log_sheet`.`fuel_tank_capacity` as 'fuel_tank_capacity', `log_sheet`.`vendor` as 'vendor', `log_sheet`.`fuel_cost_litre` as 'fuel_cost_litre', `log_sheet`.`refuel_quantity_1` as 'refuel_quantity_1', if(`log_sheet`.`refuel_first_time_date`,date_format(`log_sheet`.`refuel_first_time_date`,'%d/%m/%Y'),'') as 'refuel_first_time_date', `log_sheet`.`trip_distance_refuel_1` as 'trip_distance_refuel_1', `log_sheet`.`refuel_quantity_2` as 'refuel_quantity_2', if(`log_sheet`.`refuel_second_time_date`,date_format(`log_sheet`.`refuel_second_time_date`,'%d/%m/%Y'),'') as 'refuel_second_time_date', `log_sheet`.`trip_distance_refuel_2` as 'trip_distance_refuel_2', `log_sheet`.`refuel_quantity_3` as 'refuel_quantity_3', if(`log_sheet`.`refuel_third_time_date`,date_format(`log_sheet`.`refuel_third_time_date`,'%d/%m/%Y'),'') as 'refuel_third_time_date', `log_sheet`.`trip_distance_refuel_3` as 'trip_distance_refuel_3', `log_sheet`.`refuel_quantity_4` as 'refuel_quantity_4', if(`log_sheet`.`refuel_fourth_time_date`,date_format(`log_sheet`.`refuel_fourth_time_date`,'%d/%m/%Y'),'') as 'refuel_fourth_time_date', `log_sheet`.`trip_distance_refuel_4` as 'trip_distance_refuel_4', `log_sheet`.`refuel_quantity_5` as 'refuel_quantity_5', if(`log_sheet`.`refuel_fifth_time_date`,date_format(`log_sheet`.`refuel_fifth_time_date`,'%d/%m/%Y'),'') as 'refuel_fifth_time_date', `log_sheet`.`trip_distance_refuel_5` as 'trip_distance_refuel_5', `log_sheet`.`refuel_quantity_6` as 'refuel_quantity_6', `log_sheet`.`trip_distance_refuel_6` as 'trip_distance_refuel_6', if(`log_sheet`.`refuel_sixth_time_date`,date_format(`log_sheet`.`refuel_sixth_time_date`,'%d/%m/%Y'),'') as 'refuel_sixth_time_date', `log_sheet`.`times_refuel_current_month` as 'times_refuel_current_month', `log_sheet`.`total_fuel_quantity` as 'total_fuel_quantity', `log_sheet`.`fuel_consumption` as 'fuel_consumption', `log_sheet`.`fuel_total_cost` as 'fuel_total_cost', `log_sheet`.`payment_e_fuel_card` as 'payment_e_fuel_card', `log_sheet`.`captured_by` as 'captured_by', `log_sheet`.`comments` as 'comments', DATE_FORMAT(`log_sheet`.`date_captured`, '%e/%c/%Y %l:%i%p') as 'date_captured', `log_sheet`.`complete_fill_up` as 'complete_fill_up'",
			'vehicle_history' => "`vehicle_history`.`history_id` as 'history_id', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`, '  '), '') as 'vehicle_registration_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS('',   `gmt_fleet_register1`.`engine_number`, ' '), '') as 'engine_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`purchase_price`), CONCAT_WS('',   `gmt_fleet_register1`.`purchase_price`, ' '), '') as 'purchased_price', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`) || CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`, '   |  and  |   ', `gmt_fleet_register1`.`engine_number`), '') as 'old_registration_number', `vehicle_history`.`new_vehicle_registration_number` as 'new_vehicle_registration_number', if(`vehicle_history`.`date_of_vehicle_transfer`,date_format(`vehicle_history`.`date_of_vehicle_transfer`,'%d/%m/%Y'),'') as 'date_of_vehicle_transfer', `vehicle_history`.`comments` as 'comments', IF(    CHAR_LENGTH(if(`gmt_fleet_register1`.`renewal_of_license`,date_format(`gmt_fleet_register1`.`renewal_of_license`,'%d/%m/%Y'),'')), CONCAT_WS('',   if(`gmt_fleet_register1`.`renewal_of_license`,date_format(`gmt_fleet_register1`.`renewal_of_license`,'%d/%m/%Y'),'')), '') as 'renewal_of_license', IF(    CHAR_LENGTH(if(`schedule1`.`date`,date_format(`schedule1`.`date`,'%d/%m/%Y'),'')), CONCAT_WS('',   if(`schedule1`.`date`,date_format(`schedule1`.`date`,'%d/%m/%Y'),'')), '') as 'date_of_service', IF(    CHAR_LENGTH(if(`service1`.`date_of_next_service`,date_format(`service1`.`date_of_next_service`,'%d/%m/%Y'),'')), CONCAT_WS('',   if(`service1`.`date_of_next_service`,date_format(`service1`.`date_of_next_service`,'%d/%m/%Y'),'')), '') as 'date_of_next_service', IF(    CHAR_LENGTH(`purchase_orders1`.`purchased_order_number`), CONCAT_WS('',   `purchase_orders1`.`purchased_order_number`), '') as 'purchased_order_number', IF(    CHAR_LENGTH(`claim1`.`claim_code`), CONCAT_WS('',   `claim1`.`claim_code`), '') as 'claim_code', if(CHAR_LENGTH(IF(    CHAR_LENGTH(`tyre_log_sheet1`.`tyre_inspection_report`), CONCAT_WS('',   `tyre_log_sheet1`.`tyre_inspection_report`), '')), concat('" . getUploadDir('') . "', IF(    CHAR_LENGTH(`tyre_log_sheet1`.`tyre_inspection_report`), CONCAT_WS('',   `tyre_log_sheet1`.`tyre_inspection_report`), '')), '') as 'tyre_inspection_report', IF(    CHAR_LENGTH(`vehicle_daily_check_list1`.`inspection_certification_number`), CONCAT_WS('',   `vehicle_daily_check_list1`.`inspection_certification_number`), '') as 'inspection_certification_number', if(CHAR_LENGTH(IF(    CHAR_LENGTH(`vehicle_daily_check_list2`.`document_checklist_report`), CONCAT_WS('',   `vehicle_daily_check_list2`.`document_checklist_report`), '')), concat('" . getUploadDir('') . "', IF(    CHAR_LENGTH(`vehicle_daily_check_list2`.`document_checklist_report`), CONCAT_WS('',   `vehicle_daily_check_list2`.`document_checklist_report`), '')), '') as 'document_checklist_report', IF(    CHAR_LENGTH(if(`vehicle_daily_check_list3`.`next_inspection_date`,date_format(`vehicle_daily_check_list3`.`next_inspection_date`,'%d/%m/%Y'),'')), CONCAT_WS('',   if(`vehicle_daily_check_list3`.`next_inspection_date`,date_format(`vehicle_daily_check_list3`.`next_inspection_date`,'%d/%m/%Y'),'')), '') as 'next_inspection_date', `vehicle_history`.`breakdown_of_vehicle` as 'breakdown_of_vehicle', DATE_FORMAT(`vehicle_history`.`date_of_vehicle_breakdown`, '%D %b %Y %l:%i%p') as 'date_of_vehicle_breakdown', `vehicle_history`.`description_of_vehicle_breakdown` as 'description_of_vehicle_breakdown', IF(    CHAR_LENGTH(`log_sheet1`.`closing_km`), CONCAT_WS('',   `log_sheet1`.`closing_km`), '') as 'closing_km', if(`vehicle_history`.`date_of_vehicle_reactivation`,date_format(`vehicle_history`.`date_of_vehicle_reactivation`,'%d/%m/%Y %H:%i'),'') as 'date_of_vehicle_reactivation', IF(    CHAR_LENGTH(`breakdown_services1`.`total_amount`), CONCAT_WS('',   `breakdown_services1`.`total_amount`), '') as 'total_cost'",
			'year_model' => "`year_model`.`year_model_id` as 'year_model_id', `year_model`.`year_model_specification` as 'year_model_specification'",
			'month' => "`month`.`month_id` as 'month_id', `month`.`month` as 'month'",
			'body_type' => "`body_type`.`body_type_id` as 'body_type_id', `body_type`.`type_of_vehicle` as 'type_of_vehicle'",
			'vehicle_colour' => "`vehicle_colour`.`vehicle_colour_id` as 'vehicle_colour_id', `vehicle_colour`.`colour_of_vehicle` as 'colour_of_vehicle'",
			'province' => "`province`.`province_id` as 'province_id', `province`.`province` as 'province'",
			'departments' => "`departments`.`department_id` as 'department_id', `departments`.`department_name` as 'department_name'",
			'districts' => "`districts`.`district_id` as 'district_id', `districts`.`district` as 'district', `districts`.`station` as 'station'",
			'application_status' => "`application_status`.`application_id` as 'application_id', `application_status`.`application_status` as 'application_status'",
			'vehicle_payments' => "`vehicle_payments`.`vehicle_payment_id` as 'vehicle_payment_id', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`), '') as 'vehicle_registration_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS('',   `gmt_fleet_register1`.`engine_number`), '') as 'engine_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`chassis_number`), CONCAT_WS('',   `gmt_fleet_register1`.`chassis_number`), '') as 'chassis_number', IF(    CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS('',   `dealer1`.`make_of_vehicle`, '   '), '') as 'make_of_vehicle', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`), CONCAT_WS('',   `gmt_fleet_register1`.`model_of_vehicle`), '') as 'model_of_vehicle', IF(    CHAR_LENGTH(`year_model1`.`year_model_specification`), CONCAT_WS('',   `year_model1`.`year_model_specification`), '') as 'year_model_of_vehicle', IF(    CHAR_LENGTH(`body_type1`.`type_of_vehicle`), CONCAT_WS('',   `body_type1`.`type_of_vehicle`), '') as 'type_of_vehicle', IF(    CHAR_LENGTH(`application_status1`.`application_status`), CONCAT_WS('',   `application_status1`.`application_status`), '') as 'application_status', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`barcode_number`), CONCAT_WS('',   `gmt_fleet_register1`.`barcode_number`), '') as 'barcode_number', `vehicle_payments`.`purchase_price` as 'purchase_price', `vehicle_payments`.`depreciation_value` as 'depreciation_value', IF(    CHAR_LENGTH(`log_sheet1`.`closing_km`), CONCAT_WS('',   `log_sheet1`.`closing_km`), '') as 'closing_km', IF(    CHAR_LENGTH(`departments1`.`department_name`), CONCAT_WS('',   `departments1`.`department_name`), '') as 'department', `vehicle_payments`.`acquisition_reference` as 'acquisition_reference', DATE_FORMAT(`vehicle_payments`.`date_of_acquisition`, '%D %b %Y %l:%i%p') as 'date_of_acquisition', `vehicle_payments`.`odometer_at_acquisition` as 'odometer_at_acquisition', IF(    CHAR_LENGTH(`merchant1`.`merchant_name`) || CHAR_LENGTH(`merchant_type1`.`merchant_type`), CONCAT_WS('',   `merchant1`.`merchant_name`, '    |   and   |    ', `merchant_type1`.`merchant_type`), '') as 'merchant_name', `vehicle_payments`.`value_at_acquisition` as 'value_at_acquisition', `vehicle_payments`.`term` as 'term', DATE_FORMAT(`vehicle_payments`.`month_end`, '%D %b %Y %l:%i%p') as 'month_end', `vehicle_payments`.`installment_per_month` as 'installment_per_month', `vehicle_payments`.`payment_amount` as 'payment_amount', `vehicle_payments`.`payment_frequency` as 'payment_frequency', `vehicle_payments`.`interest_rate` as 'interest_rate', `vehicle_payments`.`payment_reference` as 'payment_reference', `vehicle_payments`.`paid_so_far` as 'paid_so_far', `vehicle_payments`.`remaining_balance` as 'remaining_balance', `vehicle_payments`.`depreciation_since_purchase` as 'depreciation_since_purchase', `vehicle_payments`.`actual_resale_value` as 'actual_resale_value', DATE_FORMAT(`vehicle_payments`.`warranty_expires_on`, '%D %b %Y %l:%i%p') as 'warranty_expires_on', `vehicle_payments`.`comments` as 'comments', `vehicle_payments`.`documents` as 'documents'",
			'insurance_payments' => "`insurance_payments`.`insurance_payment_id` as 'insurance_payment_id', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`), '') as 'vehicle_registration_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS('',   `gmt_fleet_register1`.`engine_number`), '') as 'engine_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`chassis_number`), CONCAT_WS('',   `gmt_fleet_register1`.`chassis_number`), '') as 'chassis_number', IF(    CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS('',   `dealer1`.`make_of_vehicle`, '   '), '') as 'make_of_vehicle', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`), CONCAT_WS('',   `gmt_fleet_register1`.`model_of_vehicle`), '') as 'model_of_vehicle', IF(    CHAR_LENGTH(`year_model1`.`year_model_specification`), CONCAT_WS('',   `year_model1`.`year_model_specification`), '') as 'year_model_of_vehicle', IF(    CHAR_LENGTH(`vehicle_colour1`.`colour_of_vehicle`), CONCAT_WS('',   `vehicle_colour1`.`colour_of_vehicle`), '') as 'type_of_vehicle', IF(    CHAR_LENGTH(`application_status1`.`application_status`), CONCAT_WS('',   `application_status1`.`application_status`), '') as 'application_status', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`barcode_number`), CONCAT_WS('',   `gmt_fleet_register1`.`barcode_number`), '') as 'barcode_number', IF(    CHAR_LENGTH(`departments1`.`department_name`), CONCAT_WS('',   `departments1`.`department_name`), '') as 'department', `insurance_payments`.`insurance_reference` as 'insurance_reference', DATE_FORMAT(`insurance_payments`.`insurance_expiration`, '%D %b %Y %l:%i%p') as 'insurance_expiration', DATE_FORMAT(`insurance_payments`.`transaction_date`, '%D %b %Y %l:%i%p') as 'transaction_date', `insurance_payments`.`reference_number` as 'reference_number', IF(    CHAR_LENGTH(`merchant1`.`merchant_name`) || CHAR_LENGTH(`merchant_type1`.`merchant_type`), CONCAT_WS('',   `merchant1`.`merchant_name`, '   |   and   |    ', `merchant_type1`.`merchant_type`), '') as 'merchant_name', `insurance_payments`.`payment_amount` as 'payment_amount', DATE_FORMAT(`insurance_payments`.`month_end`, '%D %b %Y %l:%i%p') as 'month_end', `insurance_payments`.`documents` as 'documents', `insurance_payments`.`comments` as 'comments'",
			'authorizations' => "`authorizations`.`authorize_id` as 'authorize_id', IF(    CHAR_LENGTH(`claim1`.`claim_code`), CONCAT_WS('',   `claim1`.`claim_code`), '') as 'job_code', IF(    CHAR_LENGTH(`claim_status1`.`claim_status`), CONCAT_WS('',   `claim_status1`.`claim_status`), '') as 'job_status', DATE_FORMAT(`authorizations`.`job_status_date`, '%D %b %Y %l:%i%p') as 'job_status_date', `authorizations`.`job_status_age` as 'job_status_age', `authorizations`.`job_age` as 'job_age', IF(    CHAR_LENGTH(`claim_category1`.`claim_category`), CONCAT_WS('',   `claim_category1`.`claim_category`), '') as 'job_category', IF(    CHAR_LENGTH(`log_sheet1`.`closing_km`), CONCAT_WS('',   `log_sheet1`.`closing_km`), '') as 'job_odometer', IF(    CHAR_LENGTH(`claim1`.`instruction_note`), CONCAT_WS('',   `claim1`.`instruction_note`), '') as 'instruction_note', IF(    CHAR_LENGTH(if(`claim1`.`pre_authorization_date`,date_format(`claim1`.`pre_authorization_date`,'%d/%m/%Y'),'')), CONCAT_WS('',   if(`claim1`.`pre_authorization_date`,date_format(`claim1`.`pre_authorization_date`,'%d/%m/%Y'),'')), '') as 'pre_authorisation_date', DATE_FORMAT(`authorizations`.`authorisation_date`, '%D %b %Y %l:%i%p') as 'authorisation_date', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`) || CHAR_LENGTH(`gmt_fleet_register1`.`chassis_number`) || CHAR_LENGTH(`claim2`.`claim_code`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`, '    |   and    |  ', `gmt_fleet_register1`.`chassis_number`, '    |   and   |', `claim2`.`claim_code`), '') as 'vehicle_registration_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`) || CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`) || CHAR_LENGTH(`gmt_fleet_register3`.`vehicle_registration_number`) || CHAR_LENGTH(`gmt_fleet_register3`.`chassis_number`), CONCAT_WS('',   `gmt_fleet_register1`.`model_of_vehicle`, ' |   and    |    ', `gmt_fleet_register1`.`vehicle_registration_number`, `gmt_fleet_register3`.`vehicle_registration_number`, '    |   and    |  ', `gmt_fleet_register3`.`chassis_number`), '') as 'make_of_vehicle', IF(    CHAR_LENGTH(`departments1`.`department_name`) || CHAR_LENGTH(`claim3`.`client_identification`), CONCAT_WS('',   `departments1`.`department_name`, '   |    and    |   ', `claim3`.`client_identification`), '') as 'client', IF(    CHAR_LENGTH(`province1`.`province`), CONCAT_WS('',   `province1`.`province`), '') as 'province_name', IF(    CHAR_LENGTH(`merchant1`.`merchant_code`), CONCAT_WS('',   `merchant1`.`merchant_code`), '') as 'merchant_code', IF(    CHAR_LENGTH(`merchant1`.`merchant_name`) || CHAR_LENGTH(`merchant1`.`merchant_code`), CONCAT_WS('',   `merchant1`.`merchant_name`, '     |     and      |     ', `merchant1`.`merchant_code`), '') as 'merchant_name', IF(    CHAR_LENGTH(`merchant1`.`merchant_contact_email`), CONCAT_WS('',   `merchant1`.`merchant_contact_email`), '') as 'merchant_contact_email', IF(    CHAR_LENGTH(`merchant1`.`merchant_street_address`), CONCAT_WS('',   `merchant1`.`merchant_street_address`), '') as 'merchant_street_address', IF(    CHAR_LENGTH(`merchant1`.`merchant_suburb`), CONCAT_WS('',   `merchant1`.`merchant_suburb`), '') as 'merchant_suburb', IF(    CHAR_LENGTH(`merchant1`.`merchant_city`), CONCAT_WS('',   `merchant1`.`merchant_city`), '') as 'merchant_city', IF(    CHAR_LENGTH(`merchant1`.`merchant_address_code`), CONCAT_WS('',   `merchant1`.`merchant_address_code`), '') as 'merchant_address_code', IF(    CHAR_LENGTH(`merchant1`.`merchant_contact_details`), CONCAT_WS('',   `merchant1`.`merchant_contact_details`), '') as 'merchant_contact_details', IF(    CHAR_LENGTH(`claim1`.`total_claimed`), CONCAT_WS('',   `claim1`.`total_claimed`), '') as 'total_claim', IF(    CHAR_LENGTH(`claim1`.`total_authorized`), CONCAT_WS('',   `claim1`.`total_authorized`), '') as 'total_authorised', IF(    CHAR_LENGTH(`claim1`.`authorization_number`) || CHAR_LENGTH(`claim1`.`claim_code`), CONCAT_WS('',   `claim1`.`authorization_number`, '     |   and   |     ', `claim1`.`claim_code`), '') as 'authorization_number', if(`authorizations`.`last_fuel_transaction_date`,date_format(`authorizations`.`last_fuel_transaction_date`,'%d/%m/%Y'),'') as 'last_fuel_transaction_date', `authorizations`.`external_repairs` as 'external_repairs'",
			'service' => "`service`.`service_id` as 'service_id', `service`.`breakdown_of_vehicle` as 'breakdown_of_vehicle', `service`.`service_title` as 'service_title', IF(    CHAR_LENGTH(`service_item_type1`.`service_item_type`), CONCAT_WS('',   `service_item_type1`.`service_item_type`), '') as 'service_item_type', IF(    CHAR_LENGTH(`service_categories1`.`service_category`), CONCAT_WS('',   `service_categories1`.`service_category`), '') as 'service_category', IF(    CHAR_LENGTH(`merchant1`.`merchant_name`) || CHAR_LENGTH(`merchant_type1`.`merchant_type`), CONCAT_WS('',   `merchant1`.`merchant_name`, '    |   and   |    ', `merchant_type1`.`merchant_type`), '') as 'merchant_name', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`), '') as 'vehicle_registration_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS('',   `gmt_fleet_register1`.`engine_number`), '') as 'engine_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`chassis_number`) || CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS('',   `gmt_fleet_register1`.`chassis_number`, ' |  and  |     ', `gmt_fleet_register1`.`vehicle_registration_number`), '') as 'chassis_number', IF(    CHAR_LENGTH(`dealer1`.`dealer_name`), CONCAT_WS('',   `dealer1`.`dealer_name`), '') as 'dealer_name', IF(    CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS('',   `dealer1`.`make_of_vehicle`, '   '), '') as 'make_of_vehicle', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`), CONCAT_WS('',   `gmt_fleet_register1`.`model_of_vehicle`), '') as 'model_of_vehicle', IF(    CHAR_LENGTH(`year_model1`.`year_model_specification`), CONCAT_WS('',   `year_model1`.`year_model_specification`), '') as 'year_model_of_vehicle', IF(    CHAR_LENGTH(`body_type1`.`type_of_vehicle`), CONCAT_WS('',   `body_type1`.`type_of_vehicle`), '') as 'type_of_vehicle', IF(    CHAR_LENGTH(`log_sheet1`.`closing_km`), CONCAT_WS('',   `log_sheet1`.`closing_km`, ' '), '') as 'closing_km', IF(    CHAR_LENGTH(`application_status1`.`application_status`), CONCAT_WS('',   `application_status1`.`application_status`), '') as 'application_status', IF(    CHAR_LENGTH(`work_allocation1`.`work_allocation_reference_number`), CONCAT_WS('',   `work_allocation1`.`work_allocation_reference_number`), '') as 'work_allocation_reference_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`barcode_number`), CONCAT_WS('',   `gmt_fleet_register1`.`barcode_number`), '') as 'barcode_number', IF(    CHAR_LENGTH(`departments1`.`department_name`), CONCAT_WS('',   `departments1`.`department_name`), '') as 'department', `service`.`service_item` as 'service_item', IF(    CHAR_LENGTH(if(`schedule1`.`date`,date_format(`schedule1`.`date`,'%d/%m/%Y'),'')), CONCAT_WS('',   if(`schedule1`.`date`,date_format(`schedule1`.`date`,'%d/%m/%Y'),'')), '') as 'date_of_service', IF(    CHAR_LENGTH(`schedule1`.`time`), CONCAT_WS('',   `schedule1`.`time`), '') as 'time', `service`.`upload_quotation` as 'upload_quotation', DATE_FORMAT(`service`.`date_of_next_service`, '%D %b %Y %l:%i%p') as 'date_of_next_service', `service`.`repeat_service_schedule_every_km` as 'repeat_service_schedule_every_km', `service`.`comments` as 'comments', `service`.`upload_invoice` as 'upload_invoice', IF(    CHAR_LENGTH(`reception1`.`reception_name_and_surname`) || CHAR_LENGTH(`reception1`.`reception_persal_number`), CONCAT_WS('',   `reception1`.`reception_name_and_surname`, '     |    and     |     ', `reception1`.`reception_persal_number`), '') as 'receptionist', IF(    CHAR_LENGTH(`reception1`.`reception_email_address`) || CHAR_LENGTH(`reception1`.`reception_contact_details`), CONCAT_WS('',   `reception1`.`reception_email_address`, '     |     and      |    ', `reception1`.`reception_contact_details`), '') as 'receptionist_contact_email', IF(    CHAR_LENGTH(`districts1`.`district`), CONCAT_WS('',   `districts1`.`district`), '') as 'workshop_name', `service`.`workshop_address` as 'workshop_address', `service`.`technician` as 'technician', `service`.`work_order_status` as 'work_order_status', IF(    CHAR_LENGTH(`reception1`.`job_card_number`) || CHAR_LENGTH(`gmt_fleet_register10`.`vehicle_registration_number`), CONCAT_WS('',   `reception1`.`job_card_number`, `gmt_fleet_register10`.`vehicle_registration_number`), '') as 'job_card_number', if(`service`.`completion_date`,date_format(`service`.`completion_date`,'%d/%m/%Y'),'') as 'completion_date', if(`service`.`due_date`,date_format(`service`.`due_date`,'%d/%m/%Y'),'') as 'due_date', DATE_FORMAT(`service`.`filed`, '%c/%e/%Y %l:%i%p') as 'filed', DATE_FORMAT(`service`.`last_modified`, '%c/%e/%Y %l:%i%p') as 'last_modified'",
			'service_type' => "`service_type`.`service_type_id` as 'service_type_id', `service_type`.`service` as 'service', `service_type`.`type_of_service` as 'type_of_service', `service_type`.`reference` as 'reference', IF(    CHAR_LENGTH(`service_item_type1`.`service_item_type`), CONCAT_WS('',   `service_item_type1`.`service_item_type`), '') as 'service_item_type', IF(    CHAR_LENGTH(`service_categories1`.`service_category`), CONCAT_WS('',   `service_categories1`.`service_category`), '') as 'service_category', `service_type`.`service_item` as 'service_item', `service_type`.`frequency_time_number` as 'frequency_time_number', `service_type`.`frequency_time` as 'frequency_time', `service_type`.`frequency_odometer` as 'frequency_odometer'",
			'schedule' => "`schedule`.`schedule_id` as 'schedule_id', `schedule`.`title` as 'title', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`user_name_and_surname`), CONCAT_WS('',   `gmt_fleet_register1`.`user_name_and_surname`), '') as 'user_name_and_surname', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`user_contact_email`), CONCAT_WS('',   `gmt_fleet_register1`.`user_contact_email`), '') as 'user_contact_email', IF(    CHAR_LENGTH(`service_item_type1`.`service_item_type`), CONCAT_WS('',   `service_item_type1`.`service_item_type`, '  '), '') as 'service_item_type', IF(    CHAR_LENGTH(`service_item_type1`.`service_item_type_code`), CONCAT_WS('',   `service_item_type1`.`service_item_type_code`), '') as 'service_item_type_code', `schedule`.`application_status` as 'application_status', IF(    CHAR_LENGTH(`gmt_fleet_register2`.`vehicle_registration_number`), CONCAT_WS('',   `gmt_fleet_register2`.`vehicle_registration_number`), '') as 'vehicle_registration_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS('',   `gmt_fleet_register1`.`engine_number`), '') as 'engine_number', IF(    CHAR_LENGTH(`log_sheet1`.`closing_km`), CONCAT_WS('',   `log_sheet1`.`closing_km`, ' '), '') as 'closing_km', if(`schedule`.`date`,date_format(`schedule`.`date`,'%d/%m/%Y'),'') as 'date', `schedule`.`time` as 'time', IF(    CHAR_LENGTH(`districts1`.`station`) || CHAR_LENGTH(`districts1`.`district`), CONCAT_WS('',   `districts1`.`station`, '      |     and      |     ', `districts1`.`district`), '') as 'workshop_name', `schedule`.`diagnosis` as 'diagnosis', `schedule`.`prescription` as 'prescription', `schedule`.`comments` as 'comments'",
			'service_records' => "`service_records`.`records_id` as 'records_id', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`) || CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`, '  |     and     |     ', `gmt_fleet_register1`.`engine_number`), '') as 'vehicle', `service_records`.`image_1` as 'image_1', `service_records`.`image_2` as 'image_2', `service_records`.`image_3` as 'image_3', `service_records`.`image_4` as 'image_4', `service_records`.`image_5` as 'image_5', `service_records`.`document_1` as 'document_1', `service_records`.`document_2` as 'document_2', `service_records`.`document_3` as 'document_3', `service_records`.`document_4` as 'document_4', `service_records`.`document_5` as 'document_5', `service_records`.`description` as 'description'",
			'service_categories' => "`service_categories`.`service_categories_id` as 'service_categories_id', `service_categories`.`service_category` as 'service_category'",
			'service_item_type' => "`service_item_type`.`service_item_type_id` as 'service_item_type_id', `service_item_type`.`service_item_type` as 'service_item_type', `service_item_type`.`service_item_type_code` as 'service_item_type_code'",
			'service_item' => "`service_item`.`service_item_id` as 'service_item_id', `service_item`.`service_item` as 'service_item'",
			'purchase_orders' => "`purchase_orders`.`purchase_order_id` as 'purchase_order_id', `purchase_orders`.`purchased_order_number` as 'purchased_order_number', if(`purchase_orders`.`purchased_date`,date_format(`purchase_orders`.`purchased_date`,'%d/%m/%Y'),'') as 'purchased_date', `purchase_orders`.`purchaser` as 'purchaser', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`, ' '), '') as 'vehicle_registration_number', IF(    CHAR_LENGTH(`body_type1`.`type_of_vehicle`), CONCAT_WS('',   `body_type1`.`type_of_vehicle`), '') as 'type_of_vehicle', IF(    CHAR_LENGTH(`manufacturer1`.`manufacturer_name`), CONCAT_WS('',   `manufacturer1`.`manufacturer_name`), '') as 'manufacturer', `purchase_orders`.`service_type` as 'service_type', IF(    CHAR_LENGTH(`service_categories1`.`service_category`), CONCAT_WS('',   `service_categories1`.`service_category`), '') as 'service_category', `purchase_orders`.`service_item` as 'service_item', `purchase_orders`.`upload_quotation` as 'upload_quotation', if(`purchase_orders`.`due_date`,date_format(`purchase_orders`.`due_date`,'%d/%m/%Y'),'') as 'due_date', IF(    CHAR_LENGTH(`merchant1`.`merchant_name`) || CHAR_LENGTH(`merchant_type1`.`merchant_type`), CONCAT_WS('',   `merchant1`.`merchant_name`, '    |   and   |    ', `merchant_type1`.`merchant_type`), '') as 'merchant_name', DATE_FORMAT(`purchase_orders`.`date_of_service`, '%D %b %Y %l:%i%p') as 'date_of_service', IF(    CHAR_LENGTH(`log_sheet1`.`closing_km`) || CHAR_LENGTH(`log_sheet1`.`fuel_log_sheet_id`), CONCAT_WS('',   `log_sheet1`.`closing_km`, '      |    and    |    ', `log_sheet1`.`fuel_log_sheet_id`), '') as 'closing_km', `purchase_orders`.`labour_category_1` as 'labour_category_1', IF(    CHAR_LENGTH(`parts1`.`part_number`), CONCAT_WS('',   `parts1`.`part_number`), '') as 'part_number_1', IF(    CHAR_LENGTH(`parts2`.`part_name`), CONCAT_WS('',   `parts2`.`part_name`), '') as 'part_name_1', IF(    CHAR_LENGTH(`manufacturer2`.`manufacturer_name`), CONCAT_WS('',   `manufacturer2`.`manufacturer_name`), '') as 'part_manufacturer_name_1', `purchase_orders`.`quantity_1` as 'quantity_1', `purchase_orders`.`expense_of_item_1` as 'expense_of_item_1', `purchase_orders`.`labour_category_2` as 'labour_category_2', IF(    CHAR_LENGTH(`parts3`.`part_number`), CONCAT_WS('',   `parts3`.`part_number`), '') as 'part_number_2', IF(    CHAR_LENGTH(`parts4`.`part_name`), CONCAT_WS('',   `parts4`.`part_name`), '') as 'part_name_2', IF(    CHAR_LENGTH(`manufacturer3`.`manufacturer_name`), CONCAT_WS('',   `manufacturer3`.`manufacturer_name`), '') as 'part_manufacturer_name_2', `purchase_orders`.`quantity_2` as 'quantity_2', `purchase_orders`.`expense_of_item_2` as 'expense_of_item_2', `purchase_orders`.`labour_category_3` as 'labour_category_3', IF(    CHAR_LENGTH(`parts5`.`part_number`), CONCAT_WS('',   `parts5`.`part_number`), '') as 'part_number_3', IF(    CHAR_LENGTH(`parts1`.`part_name`), CONCAT_WS('',   `parts1`.`part_name`), '') as 'part_name_3', IF(    CHAR_LENGTH(`manufacturer4`.`manufacturer_name`), CONCAT_WS('',   `manufacturer4`.`manufacturer_name`), '') as 'part_manufacturer_name_3', `purchase_orders`.`quantity_3` as 'quantity_3', `purchase_orders`.`expense_of_item_3` as 'expense_of_item_3', `purchase_orders`.`labour_category_4` as 'labour_category_4', IF(    CHAR_LENGTH(`parts6`.`part_number`), CONCAT_WS('',   `parts6`.`part_number`), '') as 'part_number_4', IF(    CHAR_LENGTH(`parts1`.`part_name`), CONCAT_WS('',   `parts1`.`part_name`), '') as 'part_name_4', IF(    CHAR_LENGTH(`manufacturer5`.`manufacturer_name`), CONCAT_WS('',   `manufacturer5`.`manufacturer_name`), '') as 'part_manufacturer_name_4', `purchase_orders`.`quantity_4` as 'quantity_4', `purchase_orders`.`expense_of_item_4` as 'expense_of_item_4', `purchase_orders`.`labour_category_5` as 'labour_category_5', IF(    CHAR_LENGTH(`parts7`.`part_number`), CONCAT_WS('',   `parts7`.`part_number`), '') as 'part_number_5', IF(    CHAR_LENGTH(`parts1`.`part_name`), CONCAT_WS('',   `parts1`.`part_name`), '') as 'part_name_5', IF(    CHAR_LENGTH(`manufacturer6`.`manufacturer_name`), CONCAT_WS('',   `manufacturer6`.`manufacturer_name`), '') as 'part_manufacturer_name_5', `purchase_orders`.`quantity_5` as 'quantity_5', `purchase_orders`.`expense_of_item_5` as 'expense_of_item_5', `purchase_orders`.`labour_category_6` as 'labour_category_6', IF(    CHAR_LENGTH(`parts8`.`part_number`), CONCAT_WS('',   `parts8`.`part_number`), '') as 'part_number_6', IF(    CHAR_LENGTH(`parts9`.`part_name`), CONCAT_WS('',   `parts9`.`part_name`), '') as 'part_name_6', IF(    CHAR_LENGTH(`manufacturer7`.`manufacturer_name`), CONCAT_WS('',   `manufacturer7`.`manufacturer_name`), '') as 'part_manufacturer_name_6', `purchase_orders`.`quantity_6` as 'quantity_6', `purchase_orders`.`expense_of_item_6` as 'expense_of_item_6', `purchase_orders`.`labour_category_7` as 'labour_category_7', IF(    CHAR_LENGTH(`parts10`.`part_number`), CONCAT_WS('',   `parts10`.`part_number`), '') as 'part_number_7', IF(    CHAR_LENGTH(`parts11`.`part_name`), CONCAT_WS('',   `parts11`.`part_name`), '') as 'part_name_7', IF(    CHAR_LENGTH(`manufacturer8`.`manufacturer_name`), CONCAT_WS('',   `manufacturer8`.`manufacturer_name`), '') as 'part_manufacturer_name_7', `purchase_orders`.`quantity_7` as 'quantity_7', `purchase_orders`.`expense_of_item_7` as 'expense_of_item_7', `purchase_orders`.`labour_category_8` as 'labour_category_8', IF(    CHAR_LENGTH(`parts12`.`part_number`), CONCAT_WS('',   `parts12`.`part_number`), '') as 'part_number_8', IF(    CHAR_LENGTH(`parts13`.`part_number`), CONCAT_WS('',   `parts13`.`part_number`), '') as 'part_name_8', IF(    CHAR_LENGTH(`manufacturer9`.`manufacturer_name`), CONCAT_WS('',   `manufacturer9`.`manufacturer_name`), '') as 'part_manufacturer_name_8', `purchase_orders`.`expense_of_item_8` as 'expense_of_item_8', `purchase_orders`.`material_cost` as 'material_cost', `purchase_orders`.`average_worktime_hrs` as 'average_worktime_hrs', `purchase_orders`.`standard_labour_cost_per_hour` as 'standard_labour_cost_per_hour', `purchase_orders`.`labour_charges` as 'labour_charges', `purchase_orders`.`vat` as 'vat', `purchase_orders`.`total_amount` as 'total_amount', IF(    CHAR_LENGTH(`service1`.`workshop_name`), CONCAT_WS('',   `service1`.`workshop_name`), '') as 'workshop_name', IF(    CHAR_LENGTH(`service2`.`service_id`), CONCAT_WS('',   `service2`.`service_id`), '') as 'work_order_id', IF(    CHAR_LENGTH(`reception1`.`job_card_number`), CONCAT_WS('',   `reception1`.`job_card_number`), '') as 'job_card_number', if(`purchase_orders`.`completion_date`,date_format(`purchase_orders`.`completion_date`,'%d/%m/%Y'),'') as 'completion_date', `purchase_orders`.`comments` as 'comments', `purchase_orders`.`upload_invoice` as 'upload_invoice', if(`purchase_orders`.`date_captured`,date_format(`purchase_orders`.`date_captured`,'%d/%m/%Y'),'') as 'date_captured', `purchase_orders`.`data_capturer` as 'data_capturer', `purchase_orders`.`data_capturer_contact_email` as 'data_capturer_contact_email'",
			'transmission' => "`transmission`.`transmission_id` as 'transmission_id', `transmission`.`transmission` as 'transmission'",
			'fuel_type' => "`fuel_type`.`fuel_type_id` as 'fuel_type_id', `fuel_type`.`fuel_type` as 'fuel_type'",
			'merchant' => "`merchant`.`merchant_id` as 'merchant_id', IF(    CHAR_LENGTH(`merchant_type1`.`merchant_type`), CONCAT_WS('',   `merchant_type1`.`merchant_type`), '') as 'merchant_type', `merchant`.`merchant_code` as 'merchant_code', `merchant`.`merchant_name` as 'merchant_name', `merchant`.`merchant_contact_email` as 'merchant_contact_email', `merchant`.`merchant_street_address` as 'merchant_street_address', `merchant`.`merchant_suburb` as 'merchant_suburb', `merchant`.`merchant_city` as 'merchant_city', `merchant`.`merchant_address_code` as 'merchant_address_code', `merchant`.`merchant_contact_details` as 'merchant_contact_details'",
			'merchant_type' => "`merchant_type`.`merchant_type_id` as 'merchant_type_id', `merchant_type`.`merchant_type` as 'merchant_type'",
			'manufacturer' => "`manufacturer`.`manufacturer_id` as 'manufacturer_id', IF(    CHAR_LENGTH(`manufacturer_type1`.`manufacturer_type`), CONCAT_WS('',   `manufacturer_type1`.`manufacturer_type`), '') as 'manufacturer_type', `manufacturer`.`manufacturer_name` as 'manufacturer_name', `manufacturer`.`contact_person` as 'contact_person', `manufacturer`.`contact_details` as 'contact_details', `manufacturer`.`contact_email` as 'contact_email'",
			'manufacturer_type' => "`manufacturer_type`.`manufacturer_type_id` as 'manufacturer_type_id', `manufacturer_type`.`manufacturer_type` as 'manufacturer_type'",
			'driver' => "`driver`.`driver_id` as 'driver_id', `driver`.`drivers_name_and_surname` as 'drivers_name_and_surname', `driver`.`drivers_persal_number` as 'drivers_persal_number', CONCAT_WS('-', LEFT(`driver`.`drivers_contact_details`,3), MID(`driver`.`drivers_contact_details`,4,3), RIGHT(`driver`.`drivers_contact_details`,4)) as 'drivers_contact_details', `driver`.`drivers_email_address` as 'drivers_email_address', `driver`.`drivers_license` as 'drivers_license', `driver`.`drivers_license_code` as 'drivers_license_code', `driver`.`drivers_license_number` as 'drivers_license_number', `driver`.`drivers_license_upload` as 'drivers_license_upload', if(`driver`.`drivers_license_expire_date`,date_format(`driver`.`drivers_license_expire_date`,'%d/%m/%Y'),'') as 'drivers_license_expire_date', if(`driver`.`drivers_license_renewal_date`,date_format(`driver`.`drivers_license_renewal_date`,'%d/%m/%Y'),'') as 'drivers_license_renewal_date', `driver`.`drivers_log_history` as 'drivers_log_history', `driver`.`drivers_license_penalties` as 'drivers_license_penalties', if(`driver`.`drivers_license_penalties_date`,date_format(`driver`.`drivers_license_penalties_date`,'%d/%m/%Y'),'') as 'drivers_license_penalties_date', `driver`.`drivers_license_penalty_details` as 'drivers_license_penalty_details', `driver`.`drivers_license_penalty_details_uploads` as 'drivers_license_penalty_details_uploads', `driver`.`involved_in_accident` as 'involved_in_accident', `driver`.`accident_report` as 'accident_report'",
			'accidents' => "`accidents`.`accident_id` as 'accident_id', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`, '   '), '') as 'vehicle_registration_number', IF(    CHAR_LENGTH(`log_sheet1`.`closing_km`), CONCAT_WS('',   `log_sheet1`.`closing_km`), '') as 'closing_km', IF(    CHAR_LENGTH(`driver1`.`drivers_name_and_surname`) || CHAR_LENGTH(`driver1`.`drivers_persal_number`), CONCAT_WS('',   `driver1`.`drivers_name_and_surname`, '    |    and    |   ', `driver1`.`drivers_persal_number`), '') as 'drivers_surname', IF(    CHAR_LENGTH(`driver1`.`drivers_name_and_surname`) || CHAR_LENGTH(`driver1`.`drivers_email_address`), CONCAT_WS('',   `driver1`.`drivers_name_and_surname`, '     |   and    |   ', `driver1`.`drivers_email_address`), '') as 'drivers_contact_details', IF(    CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS('',   `dealer1`.`make_of_vehicle`, '   '), '') as 'dealer_name', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`), CONCAT_WS('',   `gmt_fleet_register1`.`model_of_vehicle`), '') as 'model_of_vehicle', DATE_FORMAT(`accidents`.`date_of_accident`, '%D %b %Y %l:%i%p') as 'date_of_accident', `accidents`.`z181_accident_form` as 'z181_accident_form', `accidents`.`z181_accident_form_uploaded` as 'z181_accident_form_uploaded', `accidents`.`copy_of_trip_authority` as 'copy_of_trip_authority', IF(    CHAR_LENGTH(`districts1`.`district`), CONCAT_WS('',   `districts1`.`district`), '') as 'district', IF(    CHAR_LENGTH(`districts1`.`station`), CONCAT_WS('',   `districts1`.`station`, '   |  and   |   '), '') as 'location', `accidents`.`road_or_street` as 'road_or_street', `accidents`.`coordinates` as 'coordinates', `accidents`.`deaths` as 'deaths', `accidents`.`fatal_amount` as 'fatal_amount', `accidents`.`injured` as 'injured', `accidents`.`injured_amount` as 'injured_amount', `accidents`.`description_of_accident` as 'description_of_accident', `accidents`.`insured` as 'insured', `accidents`.`upload_photos_damaged_vehicle` as 'upload_photos_damaged_vehicle', `accidents`.`copy_of_sketch_plan` as 'copy_of_sketch_plan', `accidents`.`accident_report_driver` as 'accident_report_driver', `accidents`.`accident_report_supervisior` as 'accident_report_supervisior', `accidents`.`claims_report_accident_committee` as 'claims_report_accident_committee', `accidents`.`insurance_claims_report` as 'insurance_claims_report', `accidents`.`amount_paid` as 'amount_paid', `accidents`.`police_officer` as 'police_officer', `accidents`.`contact_details` as 'contact_details', `accidents`.`case_number` as 'case_number', `accidents`.`police_report` as 'police_report', `accidents`.`accident_report_number` as 'accident_report_number'",
			'accident_type' => "`accident_type`.`accident_type_id` as 'accident_type_id', `accident_type`.`accident_type` as 'accident_type'",
			'claim' => "`claim`.`claim_id` as 'claim_id', `claim`.`claim_code` as 'claim_code', IF(    CHAR_LENGTH(`claim_status1`.`claim_status`), CONCAT_WS('',   `claim_status1`.`claim_status`), '') as 'claim_status', IF(    CHAR_LENGTH(`claim_category1`.`claim_category`), CONCAT_WS('',   `claim_category1`.`claim_category`), '') as 'claim_category', IF(    CHAR_LENGTH(`cost_centre1`.`cost_centre`), CONCAT_WS('',   `cost_centre1`.`cost_centre`), '') as 'cost_centre', `claim`.`client_identification` as 'client_identification', IF(    CHAR_LENGTH(`departments1`.`department_name`), CONCAT_WS('',   `departments1`.`department_name`), '') as 'department_name', IF(    CHAR_LENGTH(`districts1`.`district`), CONCAT_WS('',   `districts1`.`district`), '') as 'district', IF(    CHAR_LENGTH(`province1`.`province`), CONCAT_WS('',   `province1`.`province`), '') as 'province', IF(    CHAR_LENGTH(`merchant1`.`merchant_name`) || CHAR_LENGTH(`merchant1`.`merchant_code`), CONCAT_WS('',   `merchant1`.`merchant_name`, '     |   and    |   ', `merchant1`.`merchant_code`), '') as 'merchant_name', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`) || CHAR_LENGTH(`gmt_fleet_register1`.`chassis_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`, '    |   and    |  ', `gmt_fleet_register1`.`chassis_number`), '') as 'vehicle_registration_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`) || CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS('',   `gmt_fleet_register1`.`model_of_vehicle`, ' |   and    |    ', `gmt_fleet_register1`.`vehicle_registration_number`), '') as 'model', IF(    CHAR_LENGTH(`log_sheet1`.`closing_km`), CONCAT_WS('',   `log_sheet1`.`closing_km`), '') as 'closing_km', DATE_FORMAT(`claim`.`pre_authorization_date`, '%D %b %Y %l:%i%p') as 'pre_authorization_date', `claim`.`instruction_note` as 'instruction_note', DATE_FORMAT(`claim`.`invoice_date`, '%D %b %Y %l:%i%p') as 'invoice_date', `claim`.`upload_invoice` as 'upload_invoice', DATE_FORMAT(`claim`.`payment_date`, '%D %b %Y %l:%i%p') as 'payment_date', `claim`.`authorization_number` as 'authorization_number', `claim`.`clearance_number` as 'clearance_number', DATE_FORMAT(`claim`.`vehicle_collected_date`, '%D %b %Y %l:%i%p') as 'vehicle_collected_date', `claim`.`total_claimed` as 'total_claimed', `claim`.`total_authorized` as 'total_authorized'",
			'claim_status' => "`claim_status`.`claim_status_id` as 'claim_status_id', `claim_status`.`claim_status` as 'claim_status'",
			'claim_category' => "`claim_category`.`claim_category_id` as 'claim_category_id', `claim_category`.`claim_category` as 'claim_category'",
			'cost_centre' => "`cost_centre`.`cost_centre_id` as 'cost_centre_id', `cost_centre`.`cost_centre` as 'cost_centre'",
			'dealer' => "`dealer`.`dealer_id` as 'dealer_id', IF(    CHAR_LENGTH(`dealer_type1`.`dealer_type`), CONCAT_WS('',   `dealer_type1`.`dealer_type`), '') as 'dealer_type', `dealer`.`make_of_vehicle` as 'make_of_vehicle', `dealer`.`dealer_name` as 'dealer_name', `dealer`.`contact_person` as 'contact_person', `dealer`.`contact_details` as 'contact_details', `dealer`.`contact_email` as 'contact_email'",
			'dealer_type' => "`dealer_type`.`dealer_type_id` as 'dealer_type_id', `dealer_type`.`dealer_type` as 'dealer_type'",
			'tyre_log_sheet' => "`tyre_log_sheet`.`tyre_log_id` as 'tyre_log_id', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`) || CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`, '    |    and    |      ', `gmt_fleet_register1`.`engine_number`), '') as 'vehicle_registration_number', `tyre_log_sheet`.`tyre_position` as 'tyre_position', `tyre_log_sheet`.`tyre_tread_condition` as 'tyre_tread_condition', `tyre_log_sheet`.`tyre_brand` as 'tyre_brand', `tyre_log_sheet`.`tyre_model` as 'tyre_model', `tyre_log_sheet`.`tyre_size` as 'tyre_size', `tyre_log_sheet`.`tyre_pressure` as 'tyre_pressure', `tyre_log_sheet`.`action` as 'action', `tyre_log_sheet`.`warranty` as 'warranty', `tyre_log_sheet`.`documents` as 'documents', `tyre_log_sheet`.`tyre_tread` as 'tyre_tread', `tyre_log_sheet`.`tyre_maximum_wear` as 'tyre_maximum_wear', DATE_FORMAT(`tyre_log_sheet`.`inspection_date`, '%D %b %Y %l:%i%p') as 'inspection_date', `tyre_log_sheet`.`tyre_inspection_done_by` as 'tyre_inspection_done_by', `tyre_log_sheet`.`tyre_inspection_report` as 'tyre_inspection_report', `tyre_log_sheet`.`status` as 'status', `tyre_log_sheet`.`opening_km` as 'opening_km', `tyre_log_sheet`.`closing_km` as 'closing_km', `tyre_log_sheet`.`total_km` as 'total_km', `tyre_log_sheet`.`comments` as 'comments', `tyre_log_sheet`.`tyres_cause_of_accident` as 'tyres_cause_of_accident', `tyre_log_sheet`.`accident_report` as 'accident_report', `tyre_log_sheet`.`claims_report` as 'claims_report', `tyre_log_sheet`.`insurance_claims_report` as 'insurance_claims_report', `tyre_log_sheet`.`reminder_maximum_wear` as 'reminder_maximum_wear'",
			'vehicle_daily_check_list' => "`vehicle_daily_check_list`.`vehicle_daily_check_list_id` as 'vehicle_daily_check_list_id', `vehicle_daily_check_list`.`inspection_certification_number` as 'inspection_certification_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`) || CHAR_LENGTH(`gmt_fleet_register1`.`chassis_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`, '   |  and  |   ', `gmt_fleet_register1`.`chassis_number`), '') as 'vehicle_registration_number', IF(    CHAR_LENGTH(`dealer1`.`make_of_vehicle`) || CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`), CONCAT_WS('',   `dealer1`.`make_of_vehicle`, '   ', '   |  and  |   ', `gmt_fleet_register1`.`model_of_vehicle`), '') as 'make_of_vehicle', IF(    CHAR_LENGTH(`log_sheet1`.`closing_km`), CONCAT_WS('',   `log_sheet1`.`closing_km`), '') as 'closing_km', `vehicle_daily_check_list`.`dashboard` as 'dashboard', `vehicle_daily_check_list`.`seats` as 'seats', `vehicle_daily_check_list`.`carpets` as 'carpets', `vehicle_daily_check_list`.`wipers` as 'wipers', `vehicle_daily_check_list`.`head_lights` as 'head_lights', `vehicle_daily_check_list`.`tail_lights` as 'tail_lights', `vehicle_daily_check_list`.`brake_lights` as 'brake_lights', `vehicle_daily_check_list`.`indicators` as 'indicators', `vehicle_daily_check_list`.`windscreen` as 'windscreen', `vehicle_daily_check_list`.`windows` as 'windows', `vehicle_daily_check_list`.`mirrors` as 'mirrors', `vehicle_daily_check_list`.`wheels` as 'wheels', `vehicle_daily_check_list`.`hubcaps` as 'hubcaps', `vehicle_daily_check_list`.`sparewheel` as 'sparewheel', `vehicle_daily_check_list`.`tools` as 'tools', `vehicle_daily_check_list`.`engine_oil` as 'engine_oil', `vehicle_daily_check_list`.`power_steering_oil` as 'power_steering_oil', `vehicle_daily_check_list`.`gearbox_oil` as 'gearbox_oil', `vehicle_daily_check_list`.`coolant` as 'coolant', `vehicle_daily_check_list`.`brake_oil` as 'brake_oil', `vehicle_daily_check_list`.`battery` as 'battery', `vehicle_daily_check_list`.`brakes_front` as 'brakes_front', `vehicle_daily_check_list`.`brakes_rear` as 'brakes_rear', `vehicle_daily_check_list`.`fuel_level` as 'fuel_level', `vehicle_daily_check_list`.`vehicle_fluid_leaks` as 'vehicle_fluid_leaks', `vehicle_daily_check_list`.`note` as 'note', `vehicle_daily_check_list`.`document_checklist_report` as 'document_checklist_report', if(`vehicle_daily_check_list`.`next_inspection_date`,date_format(`vehicle_daily_check_list`.`next_inspection_date`,'%d/%m/%Y'),'') as 'next_inspection_date', IF(    CHAR_LENGTH(`driver1`.`drivers_name_and_surname`), CONCAT_WS('',   `driver1`.`drivers_name_and_surname`), '') as 'drivers_surname', IF(    CHAR_LENGTH(`driver1`.`drivers_persal_number`), CONCAT_WS('',   `driver1`.`drivers_persal_number`), '') as 'drivers_persal_number'",
			'auditor' => "`auditor`.`auditor_id` as 'auditor_id', `auditor`.`res_id` as 'res_id', `auditor`.`username` as 'username', `auditor`.`ipaddr` as 'ipaddr', `auditor`.`time_stmp` as 'time_stmp', `auditor`.`change_type` as 'change_type', `auditor`.`table_name` as 'table_name', `auditor`.`fieldName` as 'fieldName', `auditor`.`OldValue` as 'OldValue', `auditor`.`NewValue` as 'NewValue'",
			'parts' => "`parts`.`parts_id` as 'parts_id', IF(    CHAR_LENGTH(`parts_type1`.`part_type`), CONCAT_WS('',   `parts_type1`.`part_type`), '') as 'part_type', `parts`.`part_number` as 'part_number', `parts`.`part_name` as 'part_name', `parts`.`description` as 'description', IF(    CHAR_LENGTH(`manufacturer1`.`manufacturer_name`), CONCAT_WS('',   `manufacturer1`.`manufacturer_name`), '') as 'manufacturer', IF(    CHAR_LENGTH(`dealer1`.`dealer_name`), CONCAT_WS('',   `dealer1`.`dealer_name`), '') as 'dealer', `parts`.`measure` as 'measure', `parts`.`unit_price` as 'unit_price', `parts`.`quantity` as 'quantity', `parts`.`freight` as 'freight', `parts`.`amount` as 'amount', `parts`.`tax` as 'tax', `parts`.`total_amount` as 'total_amount', `parts`.`discount_price` as 'discount_price', `parts`.`net_part_price` as 'net_part_price'",
			'parts_type' => "`parts_type`.`part_type_id` as 'part_type_id', `parts_type`.`part_type` as 'part_type'",
			'breakdown_services' => "`breakdown_services`.`breakdown_id` as 'breakdown_id', `breakdown_services`.`breakdown_of_vehicle` as 'breakdown_of_vehicle', `breakdown_services`.`breakdown_during_office_hours` as 'breakdown_during_office_hours', `breakdown_services`.`breakdown_within_or_outside_the_province` as 'breakdown_within_or_outside_the_province', IF(    CHAR_LENGTH(`reception1`.`description_of_vehicle_breakdown_notes`), CONCAT_WS('',   `reception1`.`description_of_vehicle_breakdown_notes`), '') as 'description_of_vehicle_breakdown_notes', `breakdown_services`.`description_of_vehicle_breakdown` as 'description_of_vehicle_breakdown', DATE_FORMAT(`breakdown_services`.`date_of_vehicle_breakdown`, '%D %b %Y %l:%i%p') as 'date_of_vehicle_breakdown', IF(    CHAR_LENGTH(`work_allocation1`.`work_allocation_reference_number`), CONCAT_WS('',   `work_allocation1`.`work_allocation_reference_number`), '') as 'work_allocation_reference_number', IF(    CHAR_LENGTH(`reception2`.`job_card_number`), CONCAT_WS('',   `reception2`.`job_card_number`), '') as 'job_card_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`) || CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`, '  |   and   |     ', `gmt_fleet_register1`.`engine_number`), '') as 'vehicle_registration_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`) || CHAR_LENGTH(`gmt_fleet_register1`.`chassis_number`), CONCAT_WS('',   `gmt_fleet_register1`.`engine_number`, '   |  and  |   ', `gmt_fleet_register1`.`chassis_number`), '') as 'engine_number', IF(    CHAR_LENGTH(`log_sheet1`.`closing_km`), CONCAT_WS('',   `log_sheet1`.`closing_km`), '') as 'closing_km', if(`breakdown_services`.`date_of_vehicle_reactivation`,date_format(`breakdown_services`.`date_of_vehicle_reactivation`,'%d/%m/%Y'),'') as 'date_of_vehicle_reactivation', `breakdown_services`.`type_of_expenditure` as 'type_of_expenditure', `breakdown_services`.`labour_category` as 'labour_category', IF(    CHAR_LENGTH(`parts1`.`part_number`), CONCAT_WS('',   `parts1`.`part_number`), '') as 'part_number', IF(    CHAR_LENGTH(`parts2`.`part_name`), CONCAT_WS('',   `parts2`.`part_name`), '') as 'part_name', IF(    CHAR_LENGTH(`manufacturer1`.`manufacturer_name`), CONCAT_WS('',   `manufacturer1`.`manufacturer_name`), '') as 'part_manufacturer_name', `breakdown_services`.`quantity` as 'quantity', `breakdown_services`.`expense_of_item` as 'expense_of_item', `breakdown_services`.`labour_category_1` as 'labour_category_1', IF(    CHAR_LENGTH(`parts3`.`part_number`), CONCAT_WS('',   `parts3`.`part_number`), '') as 'part_number_1', IF(    CHAR_LENGTH(`parts4`.`part_name`), CONCAT_WS('',   `parts4`.`part_name`), '') as 'part_name_1', IF(    CHAR_LENGTH(`manufacturer2`.`manufacturer_name`), CONCAT_WS('',   `manufacturer2`.`manufacturer_name`), '') as 'part_manufacturer_name_1', `breakdown_services`.`quantity_1` as 'quantity_1', `breakdown_services`.`expense_of_item_1` as 'expense_of_item_1', `breakdown_services`.`material_cost` as 'material_cost', `breakdown_services`.`average_worktime_hrs` as 'average_worktime_hrs', `breakdown_services`.`standard_labour_cost_per_hour` as 'standard_labour_cost_per_hour', `breakdown_services`.`labour_charges` as 'labour_charges', `breakdown_services`.`vat` as 'vat', `breakdown_services`.`total_amount` as 'total_amount', IF(    CHAR_LENGTH(`service1`.`workshop_name`), CONCAT_WS('',   `service1`.`workshop_name`), '') as 'workshop_name', `breakdown_services`.`work_order_status` as 'work_order_status', `breakdown_services`.`comments` as 'comments', `breakdown_services`.`upload_invoice` as 'upload_invoice', IF(    CHAR_LENGTH(`reception1`.`reception_name_and_surname`), CONCAT_WS('',   `reception1`.`reception_name_and_surname`), '') as 'receptionist', IF(    CHAR_LENGTH(`reception1`.`reception_email_address`), CONCAT_WS('',   `reception1`.`reception_email_address`), '') as 'receptionist_contact_email', DATE_FORMAT(`breakdown_services`.`date_captured`, '%e/%c/%Y %l:%i%p') as 'date_captured'",
			'modification_to_vehicle' => "`modification_to_vehicle`.`modification_id` as 'modification_id', IF(    CHAR_LENGTH(`body_type1`.`type_of_vehicle`), CONCAT_WS('',   `body_type1`.`type_of_vehicle`), '') as 'type_of_vehicle', `modification_to_vehicle`.`directorate` as 'directorate', `modification_to_vehicle`.`head_office` as 'head_office', IF(    CHAR_LENGTH(`districts1`.`district`), CONCAT_WS('',   `districts1`.`district`), '') as 'district', IF(    CHAR_LENGTH(`districts1`.`station`), CONCAT_WS('',   `districts1`.`station`, '   |  and   |   '), '') as 'location', IF(    CHAR_LENGTH(`driver1`.`drivers_name_and_surname`) || CHAR_LENGTH(`driver1`.`drivers_email_address`), CONCAT_WS('',   `driver1`.`drivers_name_and_surname`, '   |  and   |  ', `driver1`.`drivers_email_address`), '') as 'drivers_name_and_surname', IF(    CHAR_LENGTH(`driver1`.`drivers_persal_number`), CONCAT_WS('',   `driver1`.`drivers_persal_number`), '') as 'drivers_persal_number', IF(    CHAR_LENGTH(`driver1`.`drivers_contact_details`) || CHAR_LENGTH(`driver1`.`drivers_email_address`), CONCAT_WS('',   `driver1`.`drivers_contact_details`, '    |   and    | ', `driver1`.`drivers_email_address`), '') as 'drivers_contact_details', `modification_to_vehicle`.`driver_rank` as 'driver_rank', `modification_to_vehicle`.`driver_signature` as 'driver_signature', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`) || CHAR_LENGTH(`gmt_fleet_register1`.`chassis_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`, '   |  and  |   ', `gmt_fleet_register1`.`chassis_number`), '') as 'vehicle_registration_number', IF(    CHAR_LENGTH(`dealer1`.`make_of_vehicle`) || CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`), CONCAT_WS('',   `dealer1`.`make_of_vehicle`, '   ', '   |  and  |   ', `gmt_fleet_register1`.`model_of_vehicle`), '') as 'make_of_vehicle', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`) || CHAR_LENGTH(`gmt_fleet_register1`.`chassis_number`), CONCAT_WS('',   `gmt_fleet_register1`.`model_of_vehicle`, '   |  and  |   ', `gmt_fleet_register1`.`chassis_number`), '') as 'model_of_vehicle', IF(    CHAR_LENGTH(`log_sheet1`.`closing_km`), CONCAT_WS('',   `log_sheet1`.`closing_km`), '') as 'closing_km', IF(    CHAR_LENGTH(`service1`.`job_card_number`), CONCAT_WS('',   `service1`.`job_card_number`), '') as 'job_card_number', `modification_to_vehicle`.`objective` as 'objective', `modification_to_vehicle`.`fuel_gauge_amount` as 'fuel_gauge_amount', `modification_to_vehicle`.`keys_ignition` as 'keys_ignition', `modification_to_vehicle`.`petrol_cap_with_keys` as 'petrol_cap_with_keys', `modification_to_vehicle`.`padlock_with_keys` as 'padlock_with_keys', `modification_to_vehicle`.`tyre_r_f` as 'tyre_r_f', `modification_to_vehicle`.`tyre_r_f_1` as 'tyre_r_f_1', `modification_to_vehicle`.`tyre_r_r` as 'tyre_r_r', `modification_to_vehicle`.`tyre_r_r_1` as 'tyre_r_r_1', `modification_to_vehicle`.`tyre_l_f` as 'tyre_l_f', `modification_to_vehicle`.`tyre_l_f_1` as 'tyre_l_f_1', `modification_to_vehicle`.`tyer_l_r` as 'tyer_l_r', `modification_to_vehicle`.`tyer_l_r_1` as 'tyer_l_r_1', `modification_to_vehicle`.`tyre_spare` as 'tyre_spare', `modification_to_vehicle`.`tyre_spare_1` as 'tyre_spare_1', `modification_to_vehicle`.`wheel_cups` as 'wheel_cups', `modification_to_vehicle`.`other` as 'other', `modification_to_vehicle`.`battery` as 'battery', `modification_to_vehicle`.`battery_voltage` as 'battery_voltage', `modification_to_vehicle`.`wheel_spanner` as 'wheel_spanner', `modification_to_vehicle`.`jack_with_handle` as 'jack_with_handle', `modification_to_vehicle`.`radio_dvd_combination` as 'radio_dvd_combination', `modification_to_vehicle`.`petrol_card` as 'petrol_card', `modification_to_vehicle`.`valid_license_disc` as 'valid_license_disc', if(`modification_to_vehicle`.`valid_license_disc_date`,date_format(`modification_to_vehicle`.`valid_license_disc_date`,'%d/%m/%Y'),'') as 'valid_license_disc_date', `modification_to_vehicle`.`fire_extinguisher` as 'fire_extinguisher', `modification_to_vehicle`.`warning_signs_traingle` as 'warning_signs_traingle', if(`modification_to_vehicle`.`date_checked_in`,date_format(`modification_to_vehicle`.`date_checked_in`,'%d/%m/%Y %H:%i'),'') as 'date_checked_in', `modification_to_vehicle`.`testing_officer_name_and_surname` as 'testing_officer_name_and_surname', `modification_to_vehicle`.`testing_officer_persal_number` as 'testing_officer_persal_number', `modification_to_vehicle`.`testing_officer_rank` as 'testing_officer_rank', `modification_to_vehicle`.`testing_officer_signature` as 'testing_officer_signature', if(`modification_to_vehicle`.`date_received`,date_format(`modification_to_vehicle`.`date_received`,'%d/%m/%Y %H:%i'),'') as 'date_received', `modification_to_vehicle`.`supervisor_for_allocation_name_and_surname` as 'supervisor_for_allocation_name_and_surname', `modification_to_vehicle`.`supervisor_for_allocation_persal_number` as 'supervisor_for_allocation_persal_number', `modification_to_vehicle`.`supervisor_for_allocation_rank` as 'supervisor_for_allocation_rank', `modification_to_vehicle`.`supervisor_for_allocation_signature` as 'supervisor_for_allocation_signature'",
			'vehicle_handing_over_checklist' => "`vehicle_handing_over_checklist`.`vehicle_handing_over_id` as 'vehicle_handing_over_id', `vehicle_handing_over_checklist`.`company_name` as 'company_name', `vehicle_handing_over_checklist`.`company_address` as 'company_address', `vehicle_handing_over_checklist`.`company_contact_details` as 'company_contact_details', `vehicle_handing_over_checklist`.`reason_for_handling_over` as 'reason_for_handling_over', `vehicle_handing_over_checklist`.`name_of_department` as 'name_of_department', `vehicle_handing_over_checklist`.`name_of_component` as 'name_of_component', `vehicle_handing_over_checklist`.`transport_officer_name_and_surname` as 'transport_officer_name_and_surname', `vehicle_handing_over_checklist`.`transport_officer_email` as 'transport_officer_email', `vehicle_handing_over_checklist`.`job_pre_authorization_number` as 'job_pre_authorization_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`), '') as 'vehicle_registration_number', IF(    CHAR_LENGTH(`log_sheet1`.`closing_km`), CONCAT_WS('',   `log_sheet1`.`closing_km`, '     '), '') as 'closing_km', IF(    CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS('',   `dealer1`.`make_of_vehicle`, '   '), '') as 'make_of_vehicle', IF(    CHAR_LENGTH(`gmt_fleet_register3`.`model_of_vehicle`), CONCAT_WS('',   `gmt_fleet_register3`.`model_of_vehicle`), '') as 'model_of_vehicle', IF(    CHAR_LENGTH(`claim1`.`authorization_number`) || CHAR_LENGTH(`merchant1`.`merchant_name`) || CHAR_LENGTH(`merchant1`.`merchant_code`), CONCAT_WS('',   `claim1`.`authorization_number`, '  |   and    |    ', `merchant1`.`merchant_name`, '     |   and    |   ', `merchant1`.`merchant_code`), '') as 'authorization_number', FORMAT(`vehicle_handing_over_checklist`.`authorization_date`, 2) as 'authorization_date', `vehicle_handing_over_checklist`.`radio_dvd_combination` as 'radio_dvd_combination', `vehicle_handing_over_checklist`.`number_of_keys_handling_over` as 'number_of_keys_handling_over', `vehicle_handing_over_checklist`.`jack_with_handle` as 'jack_with_handle', `vehicle_handing_over_checklist`.`tyre_spare` as 'tyre_spare', `vehicle_handing_over_checklist`.`tyre_spare_condition` as 'tyre_spare_condition', `vehicle_handing_over_checklist`.`wheel_spanner` as 'wheel_spanner', `vehicle_handing_over_checklist`.`wheel_cups` as 'wheel_cups', `vehicle_handing_over_checklist`.`tri_angles` as 'tri_angles', `vehicle_handing_over_checklist`.`mats` as 'mats', `vehicle_handing_over_checklist`.`other` as 'other', `vehicle_handing_over_checklist`.`number_of_keys` as 'number_of_keys', `vehicle_handing_over_checklist`.`tyre_r_f` as 'tyre_r_f', `vehicle_handing_over_checklist`.`tyre_r_f_1` as 'tyre_r_f_1', `vehicle_handing_over_checklist`.`tyre_r_f_1_1` as 'tyre_r_f_1_1', `vehicle_handing_over_checklist`.`tyre_r_r` as 'tyre_r_r', `vehicle_handing_over_checklist`.`tyre_r_r_1` as 'tyre_r_r_1', `vehicle_handing_over_checklist`.`tyre_r_r_1_1` as 'tyre_r_r_1_1', `vehicle_handing_over_checklist`.`tyre_l_f` as 'tyre_l_f', `vehicle_handing_over_checklist`.`tyre_l_f_1` as 'tyre_l_f_1', `vehicle_handing_over_checklist`.`tyre_l_f_1_1` as 'tyre_l_f_1_1', `vehicle_handing_over_checklist`.`tyer_l_r` as 'tyer_l_r', `vehicle_handing_over_checklist`.`tyer_l_r_1` as 'tyer_l_r_1', `vehicle_handing_over_checklist`.`tyre_l_r_1_1` as 'tyre_l_r_1_1', IF(    CHAR_LENGTH(`driver1`.`drivers_name_and_surname`) || CHAR_LENGTH(`driver1`.`drivers_persal_number`), CONCAT_WS('',   `driver1`.`drivers_name_and_surname`, '    |    and    |     ', `driver1`.`drivers_persal_number`), '') as 'driver_name_and_surname', IF(    CHAR_LENGTH(`driver1`.`drivers_persal_number`) || CHAR_LENGTH(`driver1`.`drivers_license_number`), CONCAT_WS('',   `driver1`.`drivers_persal_number`, '    |   and    |   ', `driver1`.`drivers_license_number`), '') as 'driver_persal_number', `vehicle_handing_over_checklist`.`driver_signature` as 'driver_signature', if(`vehicle_handing_over_checklist`.`date_checked_in`,date_format(`vehicle_handing_over_checklist`.`date_checked_in`,'%d/%m/%Y %H:%i'),'') as 'date_checked_in', `vehicle_handing_over_checklist`.`testing_officer_name_and_surname` as 'testing_officer_name_and_surname', `vehicle_handing_over_checklist`.`testing_officer_signature` as 'testing_officer_signature', `vehicle_handing_over_checklist`.`fuel_gauge_amount` as 'fuel_gauge_amount', `vehicle_handing_over_checklist`.`vehicle_marks_1` as 'vehicle_marks_1', `vehicle_handing_over_checklist`.`vehicle_marks_2` as 'vehicle_marks_2', `vehicle_handing_over_checklist`.`vehicle_marks_3` as 'vehicle_marks_3', `vehicle_handing_over_checklist`.`vehicle_marks_4` as 'vehicle_marks_4', `vehicle_handing_over_checklist`.`vehicle_marks_5` as 'vehicle_marks_5', `vehicle_handing_over_checklist`.`vehicle_marks_6` as 'vehicle_marks_6', `vehicle_handing_over_checklist`.`vehicle_marks_7` as 'vehicle_marks_7', `vehicle_handing_over_checklist`.`vehicle_marks_8` as 'vehicle_marks_8', `vehicle_handing_over_checklist`.`remarks` as 'remarks', `vehicle_handing_over_checklist`.`vehicle_handing_over_ckecklist` as 'vehicle_handing_over_ckecklist'",
			'vehicle_return_check_list' => "`vehicle_return_check_list`.`vehicle_return_check_list_id` as 'vehicle_return_check_list_id', DATE_FORMAT(`vehicle_return_check_list`.`vehicle_return_date`, '%D %b %Y %l:%i%p') as 'vehicle_return_date', `vehicle_return_check_list`.`job_card_number` as 'job_card_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`) || CHAR_LENGTH(`gmt_fleet_register1`.`chassis_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`, '    |   and    |  ', `gmt_fleet_register1`.`chassis_number`), '') as 'vehicle_registration_number', IF(    CHAR_LENGTH(`dealer1`.`make_of_vehicle`) || CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`), CONCAT_WS('',   `dealer1`.`make_of_vehicle`, '   ', '   |  and  |   ', `gmt_fleet_register1`.`model_of_vehicle`), '') as 'make_of_vehicle', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`) || CHAR_LENGTH(`gmt_fleet_register1`.`chassis_number`), CONCAT_WS('',   `gmt_fleet_register1`.`model_of_vehicle`, '   |  and  |   ', `gmt_fleet_register1`.`chassis_number`), '') as 'model_of_vehicle', IF(    CHAR_LENGTH(`log_sheet1`.`closing_km`) || CHAR_LENGTH(`log_sheet1`.`fuel_log_sheet_id`), CONCAT_WS('',   `log_sheet1`.`closing_km`, '  |    and     |     ', `log_sheet1`.`fuel_log_sheet_id`), '') as 'closing_km', `vehicle_return_check_list`.`radio_dvd_combination` as 'radio_dvd_combination', `vehicle_return_check_list`.`number_of_keys_handling_over` as 'number_of_keys_handling_over', `vehicle_return_check_list`.`jack_with_handle` as 'jack_with_handle', `vehicle_return_check_list`.`tyre_spare` as 'tyre_spare', `vehicle_return_check_list`.`tyre_spare_condition` as 'tyre_spare_condition', `vehicle_return_check_list`.`wheel_spanner` as 'wheel_spanner', `vehicle_return_check_list`.`wheel_cups` as 'wheel_cups', `vehicle_return_check_list`.`tri_angles` as 'tri_angles', `vehicle_return_check_list`.`other` as 'other', `vehicle_return_check_list`.`number_of_keys` as 'number_of_keys', `vehicle_return_check_list`.`vehicle_washed` as 'vehicle_washed', `vehicle_return_check_list`.`tyre_r_f` as 'tyre_r_f', `vehicle_return_check_list`.`tyre_r_f_1` as 'tyre_r_f_1', `vehicle_return_check_list`.`tyre_r_f_1_1` as 'tyre_r_f_1_1', `vehicle_return_check_list`.`tyre_r_r` as 'tyre_r_r', `vehicle_return_check_list`.`tyre_r_r_1` as 'tyre_r_r_1', `vehicle_return_check_list`.`tyre_r_r_1_1` as 'tyre_r_r_1_1', `vehicle_return_check_list`.`tyre_l_f` as 'tyre_l_f', `vehicle_return_check_list`.`tyre_l_f_1` as 'tyre_l_f_1', `vehicle_return_check_list`.`tyre_l_f_1_1` as 'tyre_l_f_1_1', `vehicle_return_check_list`.`tyer_l_r` as 'tyer_l_r', `vehicle_return_check_list`.`tyer_l_r_1` as 'tyer_l_r_1', `vehicle_return_check_list`.`tyre_l_r_1_1` as 'tyre_l_r_1_1', `vehicle_return_check_list`.`fuel_gauge_amount` as 'fuel_gauge_amount', IF(    CHAR_LENGTH(`driver1`.`drivers_name_and_surname`) || CHAR_LENGTH(`driver1`.`drivers_persal_number`), CONCAT_WS('',   `driver1`.`drivers_name_and_surname`, '    |   and    |   ', `driver1`.`drivers_persal_number`), '') as 'driver_name_and_surname', IF(    CHAR_LENGTH(`driver1`.`drivers_persal_number`) || CHAR_LENGTH(`driver1`.`drivers_license_number`), CONCAT_WS('',   `driver1`.`drivers_persal_number`, '      |    and   |   ', `driver1`.`drivers_license_number`), '') as 'driver_persal_number', `vehicle_return_check_list`.`driver_signature` as 'driver_signature', if(`vehicle_return_check_list`.`vehicle_return_date_signed`,date_format(`vehicle_return_check_list`.`vehicle_return_date_signed`,'%d/%m/%Y %H:%i'),'') as 'vehicle_return_date_signed', `vehicle_return_check_list`.`testing_officer_name_and_surname` as 'testing_officer_name_and_surname', `vehicle_return_check_list`.`testing_officer_signature` as 'testing_officer_signature', `vehicle_return_check_list`.`vehicle_marks_1` as 'vehicle_marks_1', `vehicle_return_check_list`.`vehicle_marks_2` as 'vehicle_marks_2', `vehicle_return_check_list`.`vehicle_marks_3` as 'vehicle_marks_3', `vehicle_return_check_list`.`vehicle_marks_4` as 'vehicle_marks_4', `vehicle_return_check_list`.`vehicle_marks_5` as 'vehicle_marks_5', `vehicle_return_check_list`.`vehicle_marks_6` as 'vehicle_marks_6', `vehicle_return_check_list`.`vehicle_marks_7` as 'vehicle_marks_7', `vehicle_return_check_list`.`vehicle_marks_8` as 'vehicle_marks_8', `vehicle_return_check_list`.`remarks` as 'remarks', `vehicle_return_check_list`.`vehicle_return_list` as 'vehicle_return_list'",
			'indicates_repair_damages_found_list' => "`indicates_repair_damages_found_list`.`repair_damages_list_id` as 'repair_damages_list_id', `indicates_repair_damages_found_list`.`brought_in_for_repairs` as 'brought_in_for_repairs', `indicates_repair_damages_found_list`.`after_repairs` as 'after_repairs', IF(    CHAR_LENGTH(`driver1`.`drivers_name_and_surname`) || CHAR_LENGTH(`driver1`.`drivers_persal_number`), CONCAT_WS('',   `driver1`.`drivers_name_and_surname`, '      |   and    |   ', `driver1`.`drivers_persal_number`), '') as 'driver_name_and_surname', IF(    CHAR_LENGTH(`driver1`.`drivers_persal_number`) || CHAR_LENGTH(`driver1`.`drivers_license_number`), CONCAT_WS('',   `driver1`.`drivers_persal_number`, '      |     and     |   ', `driver1`.`drivers_license_number`), '') as 'driver_persal_number', `indicates_repair_damages_found_list`.`driver_signature` as 'driver_signature', if(`indicates_repair_damages_found_list`.`vehicle_return_date_signed`,date_format(`indicates_repair_damages_found_list`.`vehicle_return_date_signed`,'%d/%m/%Y %H:%i'),'') as 'vehicle_return_date_signed', `indicates_repair_damages_found_list`.`company_name_and_surname` as 'company_name_and_surname', `indicates_repair_damages_found_list`.`company_repesentative_signature` as 'company_repesentative_signature', if(`indicates_repair_damages_found_list`.`vehicle_return_date_signed_by_representative`,date_format(`indicates_repair_damages_found_list`.`vehicle_return_date_signed_by_representative`,'%d/%m/%Y %H:%i'),'') as 'vehicle_return_date_signed_by_representative', `indicates_repair_damages_found_list`.`indicates_and_list_details_of_damages_deficiencies` as 'indicates_and_list_details_of_damages_deficiencies'",
			'forms' => "`forms`.`forms_id` as 'forms_id', `forms`.`government_motor_transport_handbook` as 'government_motor_transport_handbook', `forms`.`approved_workshop_procedure_manual` as 'approved_workshop_procedure_manual', `forms`.`vehicle_daily_check_list_and_appraisal_report` as 'vehicle_daily_check_list_and_appraisal_report', `forms`.`z181_report_on_accident` as 'z181_report_on_accident', `forms`.`vehicle_handing_over_ckecklist` as 'vehicle_handing_over_ckecklist', `forms`.`vehicle_return_list` as 'vehicle_return_list', `forms`.`indicates_and_list_details_of_damages_deficiencies` as 'indicates_and_list_details_of_damages_deficiencies'",
			'identification_of_defects' => "`identification_of_defects`.`defects_id` as 'defects_id', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`), '') as 'vehicle_registration_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS('',   `gmt_fleet_register1`.`engine_number`), '') as 'engine_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`) || CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS('',   `gmt_fleet_register1`.`model_of_vehicle`, '   |    and     |     ', `dealer1`.`make_of_vehicle`, '   '), '') as 'make_of_vehicle', `identification_of_defects`.`end_user_name_and_surname` as 'end_user_name_and_surname', `identification_of_defects`.`end_user_contact_details` as 'end_user_contact_details', `identification_of_defects`.`end_user_persal_number` as 'end_user_persal_number', `identification_of_defects`.`end_user_email_address` as 'end_user_email_address', `identification_of_defects`.`end_user_signature` as 'end_user_signature', `identification_of_defects`.`types_of_defects` as 'types_of_defects', `identification_of_defects`.`courses_of_defects` as 'courses_of_defects', `identification_of_defects`.`condition_of_defects` as 'condition_of_defects', `identification_of_defects`.`transport_officer_name_and_surname` as 'transport_officer_name_and_surname', `identification_of_defects`.`transport_officer_persal_number` as 'transport_officer_persal_number', `identification_of_defects`.`transport_officer_contact_details` as 'transport_officer_contact_details', `identification_of_defects`.`transport_officer_email_address` as 'transport_officer_email_address', `identification_of_defects`.`government_garage_manager_name_and_surname` as 'government_garage_manager_name_and_surname', `identification_of_defects`.`government_garage_manager_contact_details` as 'government_garage_manager_contact_details', `identification_of_defects`.`government_garage_manager_address` as 'government_garage_manager_address', `identification_of_defects`.`government_garage_manager_email_address` as 'government_garage_manager_email_address', `identification_of_defects`.`government_garage_manager_signature` as 'government_garage_manager_signature'",
			'gate_security' => "`gate_security`.`gate_security_user_id` as 'gate_security_user_id', `gate_security`.`gate_security_name_and_surname` as 'gate_security_name_and_surname', `gate_security`.`gate_security_contact_details` as 'gate_security_contact_details', `gate_security`.`gate_security_signature` as 'gate_security_signature', DATE_FORMAT(`gate_security`.`date_of_vehicle_entrance`, '%e/%c/%Y %l:%i%p') as 'date_of_vehicle_entrance', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`), '') as 'vehicle_registration_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS('',   `gmt_fleet_register1`.`engine_number`), '') as 'engine_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`) || CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS('',   `gmt_fleet_register1`.`model_of_vehicle`, '   |    and     |     ', `dealer1`.`make_of_vehicle`, '   '), '') as 'make_of_vehicle', IF(    CHAR_LENGTH(`vehicle_colour1`.`colour_of_vehicle`), CONCAT_WS('',   `vehicle_colour1`.`colour_of_vehicle`), '') as 'vehicle_colour', `gate_security`.`vehicle_inspection` as 'vehicle_inspection', `gate_security`.`vehicle_tires_size` as 'vehicle_tires_size', `gate_security`.`vehicle_tires_check` as 'vehicle_tires_check', `gate_security`.`vehicle_mirrow_check` as 'vehicle_mirrow_check', `gate_security`.`vehicle_interiour_condition` as 'vehicle_interiour_condition', `gate_security`.`vehicle_exteriour_condition` as 'vehicle_exteriour_condition', `gate_security`.`gate_security_company_name` as 'gate_security_company_name', `gate_security`.`gate_security_company_contact_details` as 'gate_security_company_contact_details', `gate_security`.`gate_security_manager_name_and_surname` as 'gate_security_manager_name_and_surname', `gate_security`.`gate_security_manager_contact_details` as 'gate_security_manager_contact_details', `gate_security`.`gate_security_company_address` as 'gate_security_company_address', `gate_security`.`inspection_of_vehicle_report` as 'inspection_of_vehicle_report', `gate_security`.`record_of_vehicle` as 'record_of_vehicle', DATE_FORMAT(`gate_security`.`date_of_vehicle_exit`, '%e/%c/%Y %l:%i%p') as 'date_of_vehicle_exit'",
			'reception' => "`reception`.`reception_user_id` as 'reception_user_id', `reception`.`reception_name_and_surname` as 'reception_name_and_surname', `reception`.`reception_persal_number` as 'reception_persal_number', `reception`.`reception_contact_details` as 'reception_contact_details', `reception`.`reception_email_address` as 'reception_email_address', `reception`.`reception_signature` as 'reception_signature', DATE_FORMAT(`reception`.`date_of_vehicle_entrance`, '%e/%c/%Y %l:%i%p') as 'date_of_vehicle_entrance', `reception`.`service_status` as 'service_status', IF(    CHAR_LENGTH(`districts1`.`district`), CONCAT_WS('',   `districts1`.`district`), '') as 'district', IF(    CHAR_LENGTH(`districts1`.`station`), CONCAT_WS('',   `districts1`.`station`, '   |  and   |   '), '') as 'location', `reception`.`workshop_address` as 'workshop_address', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`), '') as 'vehicle_registration_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS('',   `gmt_fleet_register1`.`engine_number`), '') as 'engine_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`) || CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS('',   `gmt_fleet_register1`.`model_of_vehicle`, '   |    and     |     ', `dealer1`.`make_of_vehicle`, '   '), '') as 'make_of_vehicle', `reception`.`breakdown_of_vehicle` as 'breakdown_of_vehicle', `reception`.`description_of_vehicle_breakdown_notes` as 'description_of_vehicle_breakdown_notes', `reception`.`description_of_vehicle_report` as 'description_of_vehicle_report', `reception`.`upload_of_vehicle_report` as 'upload_of_vehicle_report', `reception`.`description_of_vehicle_breakdown` as 'description_of_vehicle_breakdown', `reception`.`job_card_number` as 'job_card_number', `reception`.`visual_inspection_form` as 'visual_inspection_form', `reception`.`damage_report` as 'damage_report', DATE_FORMAT(`reception`.`date_of_vehicle_exit`, '%e/%c/%Y %l:%i%p') as 'date_of_vehicle_exit', `reception`.`payment` as 'payment'",
			'inspection_bay' => "`inspection_bay`.`inspection_bay_id` as 'inspection_bay_id', `inspection_bay`.`inspection_bay_supervisor_name_and_surname` as 'inspection_bay_supervisor_name_and_surname', `inspection_bay`.`supervisor_contact_details` as 'supervisor_contact_details', `inspection_bay`.`supervisor_email_address` as 'supervisor_email_address', `inspection_bay`.`supervisor_signature` as 'supervisor_signature', DATE_FORMAT(`inspection_bay`.`date_of_vehicle_entrance`, '%e/%c/%Y %l:%i%p') as 'date_of_vehicle_entrance', IF(    CHAR_LENGTH(`reception1`.`job_card_number`), CONCAT_WS('',   `reception1`.`job_card_number`), '') as 'job_card_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`), '') as 'vehicle_registration_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS('',   `gmt_fleet_register1`.`engine_number`), '') as 'engine_number', IF(    CHAR_LENGTH(`reception1`.`reception_user_id`) || CHAR_LENGTH(`reception1`.`job_card_number`), CONCAT_WS('',   `reception1`.`reception_user_id`, '      |     and      |     ', `reception1`.`job_card_number`), '') as 'workshop_name', IF(    CHAR_LENGTH(`work_allocation1`.`work_allocation_reference_number`), CONCAT_WS('',   `work_allocation1`.`work_allocation_reference_number`), '') as 'work_allocation_reference_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`) || CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS('',   `gmt_fleet_register1`.`model_of_vehicle`, '   |    and     |     ', `dealer1`.`make_of_vehicle`, '   '), '') as 'make_of_vehicle', `inspection_bay`.`inspection_bay_lane_number` as 'inspection_bay_lane_number', `inspection_bay`.`inspection_bay_condition` as 'inspection_bay_condition', `inspection_bay`.`allocation_feedback` as 'allocation_feedback', `inspection_bay`.`verification_of_defects` as 'verification_of_defects', `inspection_bay`.`additional_defects` as 'additional_defects', `inspection_bay`.`additional_defects_record` as 'additional_defects_record', `inspection_bay`.`repair_requirement_note` as 'repair_requirement_note', `inspection_bay`.`repair_requirement_report` as 'repair_requirement_report', DATE_FORMAT(`inspection_bay`.`date_of_vehicle_exit`, '%e/%c/%Y %l:%i%p') as 'date_of_vehicle_exit'",
			'work_allocation' => "`work_allocation`.`work_allocation_id` as 'work_allocation_id', IF(    CHAR_LENGTH(`districts1`.`district`), CONCAT_WS('',   `districts1`.`district`), '') as 'district', IF(    CHAR_LENGTH(`districts1`.`station`), CONCAT_WS('',   `districts1`.`station`, '   |  and   |   '), '') as 'location', IF(    CHAR_LENGTH(`cost_centre1`.`cost_centre`), CONCAT_WS('',   `cost_centre1`.`cost_centre`), '') as 'cost_centre', `work_allocation`.`supervisor_name_and_surname` as 'supervisor_name_and_surname', `work_allocation`.`supervisor_contact_details` as 'supervisor_contact_details', `work_allocation`.`supervisor_email_address` as 'supervisor_email_address', `work_allocation`.`supervisor_signature` as 'supervisor_signature', `work_allocation`.`economical_repair` as 'economical_repair', `work_allocation`.`uneconomical_repair` as 'uneconomical_repair', `work_allocation`.`work_allocation_reference_number` as 'work_allocation_reference_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`), '') as 'vehicle_registration_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS('',   `gmt_fleet_register1`.`engine_number`), '') as 'engine_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`) || CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS('',   `gmt_fleet_register1`.`model_of_vehicle`, '   |    and     |     ', `dealer1`.`make_of_vehicle`, '   '), '') as 'make_of_vehicle', DATE_FORMAT(`work_allocation`.`date_captured`, '%e/%c/%Y %l:%i%p') as 'date_captured'",
			'internal_repairs_mechanical' => "`internal_repairs_mechanical`.`internal_mechanical_id` as 'internal_mechanical_id', IF(    CHAR_LENGTH(`districts1`.`station`) || CHAR_LENGTH(`districts1`.`district`), CONCAT_WS('',   `districts1`.`station`, '      |     and      |     ', `districts1`.`district`), '') as 'workshop_name', `internal_repairs_mechanical`.`artisan_name_and_surname` as 'artisan_name_and_surname', `internal_repairs_mechanical`.`artisan_contacts` as 'artisan_contacts', `internal_repairs_mechanical`.`artisan_email_address` as 'artisan_email_address', `internal_repairs_mechanical`.`artisan_signature` as 'artisan_signature', if(`internal_repairs_mechanical`.`artisan_note_of_starting_time`,date_format(`internal_repairs_mechanical`.`artisan_note_of_starting_time`,'%d/%m/%Y %H:%i'),'') as 'artisan_note_of_starting_time', IF(    CHAR_LENGTH(`reception1`.`job_card_number`), CONCAT_WS('',   `reception1`.`job_card_number`), '') as 'job_card_number', IF(    CHAR_LENGTH(`work_allocation1`.`work_allocation_reference_number`), CONCAT_WS('',   `work_allocation1`.`work_allocation_reference_number`), '') as 'work_allocation_reference_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`), '') as 'vehicle_registration_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS('',   `gmt_fleet_register1`.`engine_number`), '') as 'engine_number', IF(    CHAR_LENGTH(`dealer1`.`make_of_vehicle`) || CHAR_LENGTH(`dealer_type1`.`dealer_type`), CONCAT_WS('',   `dealer1`.`make_of_vehicle`, '   |    and     |     ', `dealer_type1`.`dealer_type`), '') as 'make_of_vehicle', `internal_repairs_mechanical`.`pre_repair_inspections` as 'pre_repair_inspections', `internal_repairs_mechanical`.`artisan_dismantling_solution` as 'artisan_dismantling_solution', `internal_repairs_mechanical`.`spares_order_quotation` as 'spares_order_quotation', `internal_repairs_mechanical`.`spares_order_description` as 'spares_order_description', if(`internal_repairs_mechanical`.`artisan_note_of_completion_time`,date_format(`internal_repairs_mechanical`.`artisan_note_of_completion_time`,'%d/%m/%Y %H:%i'),'') as 'artisan_note_of_completion_time', IF(    CHAR_LENGTH(`inspection_bay1`.`inspection_bay_lane_number`), CONCAT_WS('',   `inspection_bay1`.`inspection_bay_lane_number`), '') as 'inspection_bay_lane_number', `internal_repairs_mechanical`.`inspection_bay_report` as 'inspection_bay_report', `internal_repairs_mechanical`.`total_labour_time` as 'total_labour_time'",
			'external_repairs_mechanical' => "`external_repairs_mechanical`.`external_mechanical_id` as 'external_mechanical_id', `external_repairs_mechanical`.`department_inspector_name_and_surname` as 'department_inspector_name_and_surname', `external_repairs_mechanical`.`department_inspector_persal_number` as 'department_inspector_persal_number', `external_repairs_mechanical`.`department_authorization_quote_note` as 'department_authorization_quote_note', `external_repairs_mechanical`.`department_inspector_signature` as 'department_inspector_signature', `external_repairs_mechanical`.`inspection_approval_repair_note` as 'inspection_approval_repair_note', `external_repairs_mechanical`.`department_authorization_quote` as 'department_authorization_quote', IF(    CHAR_LENGTH(`service_provider1`.`service_provider_name`), CONCAT_WS('',   `service_provider1`.`service_provider_name`), '') as 'service_provider_name', IF(    CHAR_LENGTH(`service_provider_type1`.`service_provider_type`), CONCAT_WS('',   `service_provider_type1`.`service_provider_type`), '') as 'service_provider_type', IF(    CHAR_LENGTH(`service_provider3`.`service_provider_contact_email`), CONCAT_WS('',   `service_provider3`.`service_provider_contact_email`), '') as 'service_provider_contact_details', IF(    CHAR_LENGTH(`service_provider4`.`service_provider_street_address`), CONCAT_WS('',   `service_provider4`.`service_provider_street_address`), '') as 'service_provider_address', `external_repairs_mechanical`.`service_provider_signature` as 'service_provider_signature', `external_repairs_mechanical`.`service_provider_repair_quote_upload` as 'service_provider_repair_quote_upload', `external_repairs_mechanical`.`service_provider_repair_quote` as 'service_provider_repair_quote', `external_repairs_mechanical`.`repair_requirement_note` as 'repair_requirement_note', IF(    CHAR_LENGTH(`merchant_type1`.`merchant_type`), CONCAT_WS('',   `merchant_type1`.`merchant_type`), '') as 'merchant_type', IF(    CHAR_LENGTH(`merchant2`.`merchant_code`) || CHAR_LENGTH(`merchant2`.`merchant_name`), CONCAT_WS('',   `merchant2`.`merchant_code`, '    |    and     |    ', `merchant2`.`merchant_name`), '') as 'merchant_code', IF(    CHAR_LENGTH(`merchant3`.`merchant_name`), CONCAT_WS('',   `merchant3`.`merchant_name`), '') as 'merchant_name', IF(    CHAR_LENGTH(`merchant4`.`merchant_contact_details`), CONCAT_WS('',   `merchant4`.`merchant_contact_details`), '') as 'merchant_contacts_details', IF(    CHAR_LENGTH(`merchant5`.`merchant_contact_email`), CONCAT_WS('',   `merchant5`.`merchant_contact_email`), '') as 'merchant_email_address', `external_repairs_mechanical`.`merchant_signature` as 'merchant_signature', IF(    CHAR_LENGTH(`merchant6`.`merchant_street_address`), CONCAT_WS('',   `merchant6`.`merchant_street_address`), '') as 'merchant_address', IF(    CHAR_LENGTH(`merchant7`.`merchant_address_code`), CONCAT_WS('',   `merchant7`.`merchant_address_code`), '') as 'merchant_address_code', DATE_FORMAT(`external_repairs_mechanical`.`date_of_vehicle_send`, '%e/%c/%Y %l:%i%p') as 'date_of_vehicle_send', IF(    CHAR_LENGTH(`claim1`.`authorization_number`) || CHAR_LENGTH(`claim1`.`claim_code`), CONCAT_WS('',   `claim1`.`authorization_number`, '     |   and   |     ', `claim1`.`claim_code`), '') as 'authorization_number', IF(    CHAR_LENGTH(`claim2`.`instruction_note`) || CHAR_LENGTH(`claim2`.`claim_code`), CONCAT_WS('',   `claim2`.`instruction_note`, '    |   and    |     ', `claim2`.`claim_code`), '') as 'instruction_note', IF(    CHAR_LENGTH(`work_allocation1`.`work_allocation_reference_number`), CONCAT_WS('',   `work_allocation1`.`work_allocation_reference_number`), '') as 'work_allocation_reference_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`), '') as 'vehicle_registration_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS('',   `gmt_fleet_register1`.`engine_number`), '') as 'engine_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`) || CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS('',   `gmt_fleet_register1`.`model_of_vehicle`, '   |    and     |     ', `dealer1`.`make_of_vehicle`, '   '), '') as 'make_of_vehicle', DATE_FORMAT(`external_repairs_mechanical`.`date_of_vehicle_received`, '%e/%c/%Y %l:%i%p') as 'date_of_vehicle_received', `external_repairs_mechanical`.`mechanical_repair_progress_monitor` as 'mechanical_repair_progress_monitor', `external_repairs_mechanical`.`mechanical_repair_progress_monitor_quality_of_work_manship` as 'mechanical_repair_progress_monitor_quality_of_work_manship', `external_repairs_mechanical`.`vehicle_inspection_report` as 'vehicle_inspection_report', `external_repairs_mechanical`.`upload_invoice` as 'upload_invoice'",
			'internal_repairs_body' => "`internal_repairs_body`.`internal_repairs_body_id` as 'internal_repairs_body_id', IF(    CHAR_LENGTH(`driver1`.`drivers_name_and_surname`), CONCAT_WS('',   `driver1`.`drivers_name_and_surname`), '') as 'driver_name_and_surname', IF(    CHAR_LENGTH(`driver1`.`drivers_persal_number`), CONCAT_WS('',   `driver1`.`drivers_persal_number`), '') as 'driver_persal_number', IF(    CHAR_LENGTH(`driver1`.`drivers_contact_details`), CONCAT_WS('',   `driver1`.`drivers_contact_details`), '') as 'driver_contacts_details', IF(    CHAR_LENGTH(`driver1`.`drivers_email_address`), CONCAT_WS('',   `driver1`.`drivers_email_address`), '') as 'driver_email_address', IF(    CHAR_LENGTH(`driver1`.`drivers_license_code`), CONCAT_WS('',   `driver1`.`drivers_license_code`), '') as 'driver_license_code', IF(    CHAR_LENGTH(`driver1`.`drivers_license_number`), CONCAT_WS('',   `driver1`.`drivers_license_number`), '') as 'driver_license_number', `internal_repairs_body`.`driver_license_upload` as 'driver_license_upload', `internal_repairs_body`.`driver_signature` as 'driver_signature', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`), '') as 'vehicle_registration_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS('',   `gmt_fleet_register1`.`engine_number`), '') as 'engine_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`) || CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS('',   `gmt_fleet_register1`.`model_of_vehicle`, '   |    and     |     ', `dealer1`.`make_of_vehicle`, '   '), '') as 'make_of_vehicle', `internal_repairs_body`.`z181_accident_form` as 'z181_accident_form', `internal_repairs_body`.`z181_accident_form_uploaded` as 'z181_accident_form_uploaded', IF(    CHAR_LENGTH(`reception1`.`job_card_number`), CONCAT_WS('',   `reception1`.`job_card_number`), '') as 'job_card_number', IF(    CHAR_LENGTH(`work_allocation1`.`work_allocation_reference_number`), CONCAT_WS('',   `work_allocation1`.`work_allocation_reference_number`), '') as 'work_allocation_reference_number', DATE_FORMAT(`internal_repairs_body`.`artisan_note_of_starting_time`, '%e/%c/%Y %l:%i%p') as 'artisan_note_of_starting_time', IF(    CHAR_LENGTH(`districts1`.`station`) || CHAR_LENGTH(`districts1`.`district`), CONCAT_WS('',   `districts1`.`station`, '   |     and     |    ', `districts1`.`district`), '') as 'government_garage_name', `internal_repairs_body`.`government_garage_contact_details` as 'government_garage_contact_details', `internal_repairs_body`.`government_garage_address` as 'government_garage_address', `internal_repairs_body`.`government_garage_email_address` as 'government_garage_email_address', `internal_repairs_body`.`damages_occured` as 'damages_occured', `internal_repairs_body`.`upload_of_internal_damages_1` as 'upload_of_internal_damages_1', `internal_repairs_body`.`upload_of_internal_damages_2` as 'upload_of_internal_damages_2', `internal_repairs_body`.`upload_of_internal_damages_3` as 'upload_of_internal_damages_3', `internal_repairs_body`.`upload_of_internal_damages_4` as 'upload_of_internal_damages_4', `internal_repairs_body`.`head_panel_beating_quotation` as 'head_panel_beating_quotation', `internal_repairs_body`.`head_panel_beating_quotation_1` as 'head_panel_beating_quotation_1', `internal_repairs_body`.`head_panel_beating_name` as 'head_panel_beating_name', `internal_repairs_body`.`head_panel_beating_contact_details` as 'head_panel_beating_contact_details', `internal_repairs_body`.`head_panel_beating_address` as 'head_panel_beating_address', `internal_repairs_body`.`head_panel_beating_signature` as 'head_panel_beating_signature', `internal_repairs_body`.`private_panel_beating_name` as 'private_panel_beating_name', `internal_repairs_body`.`private_panel_beating_contact_details` as 'private_panel_beating_contact_details', `internal_repairs_body`.`private_panel_beating_address` as 'private_panel_beating_address', `internal_repairs_body`.`private_panel_beating_quotation` as 'private_panel_beating_quotation', `internal_repairs_body`.`private_panel_beating_quotation_2` as 'private_panel_beating_quotation_2', DATE_FORMAT(`internal_repairs_body`.`artisan_note_of_completion_time`, '%e/%c/%Y %l:%i%p') as 'artisan_note_of_completion_time', `internal_repairs_body`.`total_labour_time` as 'total_labour_time'",
			'external_repairs_body' => "`external_repairs_body`.`external_repair_body_id` as 'external_repair_body_id', `external_repairs_body`.`head_panel_beating_name` as 'head_panel_beating_name', `external_repairs_body`.`head_panel_beating_contact_details` as 'head_panel_beating_contact_details', `external_repairs_body`.`head_panel_beating_address` as 'head_panel_beating_address', `external_repairs_body`.`head_panel_beating_signature` as 'head_panel_beating_signature', `external_repairs_body`.`panel_beating_quotation` as 'panel_beating_quotation', `external_repairs_body`.`panel_beating_quotation_approved_by_service_provider` as 'panel_beating_quotation_approved_by_service_provider', IF(    CHAR_LENGTH(`service_provider1`.`service_provider_name`), CONCAT_WS('',   `service_provider1`.`service_provider_name`), '') as 'service_provider_name', IF(    CHAR_LENGTH(`service_provider_type1`.`service_provider_type`), CONCAT_WS('',   `service_provider_type1`.`service_provider_type`), '') as 'service_provider_type', IF(    CHAR_LENGTH(`service_provider3`.`service_provider_contact_details`), CONCAT_WS('',   `service_provider3`.`service_provider_contact_details`), '') as 'service_provider_contact_details', IF(    CHAR_LENGTH(`service_provider4`.`service_provider_street_address`), CONCAT_WS('',   `service_provider4`.`service_provider_street_address`), '') as 'service_provider_address', IF(    CHAR_LENGTH(`service_provider5`.`service_provider_branch`), CONCAT_WS('',   `service_provider5`.`service_provider_branch`), '') as 'service_provider_branch', IF(    CHAR_LENGTH(`service_provider6`.`service_provider_branch_code`), CONCAT_WS('',   `service_provider6`.`service_provider_branch_code`), '') as 'service_provider_branch_code', `external_repairs_body`.`service_provider_signature` as 'service_provider_signature', IF(    CHAR_LENGTH(`claim1`.`instruction_note`) || CHAR_LENGTH(`claim1`.`claim_code`), CONCAT_WS('',   `claim1`.`instruction_note`, '    |   and    |     ', `claim1`.`claim_code`), '') as 'instruction_note', IF(    CHAR_LENGTH(`claim1`.`authorization_number`) || CHAR_LENGTH(`claim1`.`claim_code`), CONCAT_WS('',   `claim1`.`authorization_number`, '     |   and   |     ', `claim1`.`claim_code`), '') as 'authorization_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`), '') as 'vehicle_registration_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS('',   `gmt_fleet_register1`.`engine_number`), '') as 'engine_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`) || CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS('',   `gmt_fleet_register1`.`model_of_vehicle`, '   |    and     |     ', `dealer1`.`make_of_vehicle`, '   '), '') as 'make_of_vehicle', IF(    CHAR_LENGTH(`vehicle_colour1`.`colour_of_vehicle`), CONCAT_WS('',   `vehicle_colour1`.`colour_of_vehicle`), '') as 'vehicle_colour', `external_repairs_body`.`vehicle_inspection_done` as 'vehicle_inspection_done', `external_repairs_body`.`vehicle_inspection_check_list_form` as 'vehicle_inspection_check_list_form', `external_repairs_body`.`vehicle_tyre_sizes` as 'vehicle_tyre_sizes', `external_repairs_body`.`vehicle_mirrow_check` as 'vehicle_mirrow_check', `external_repairs_body`.`vehicle_interior_condition` as 'vehicle_interior_condition', `external_repairs_body`.`vehicle_exterior_condition` as 'vehicle_exterior_condition', IF(    CHAR_LENGTH(`merchant_type1`.`merchant_type`), CONCAT_WS('',   `merchant_type1`.`merchant_type`), '') as 'merchant_type', IF(    CHAR_LENGTH(`merchant2`.`merchant_code`), CONCAT_WS('',   `merchant2`.`merchant_code`), '') as 'merchant_code', IF(    CHAR_LENGTH(`merchant3`.`merchant_name`), CONCAT_WS('',   `merchant3`.`merchant_name`), '') as 'merchant_name', IF(    CHAR_LENGTH(`merchant4`.`merchant_contact_details`), CONCAT_WS('',   `merchant4`.`merchant_contact_details`), '') as 'merchant_contacts_details', `external_repairs_body`.`merchant_email_address` as 'merchant_email_address', `external_repairs_body`.`merchant_signature` as 'merchant_signature', IF(    CHAR_LENGTH(`merchant5`.`merchant_street_address`), CONCAT_WS('',   `merchant5`.`merchant_street_address`), '') as 'merchant_address', IF(    CHAR_LENGTH(`merchant6`.`merchant_address_code`), CONCAT_WS('',   `merchant6`.`merchant_address_code`), '') as 'merchant_address_code', IF(    CHAR_LENGTH(`merchant7`.`merchant_city`), CONCAT_WS('',   `merchant7`.`merchant_city`), '') as 'merchant_city', `external_repairs_body`.`head_panel_beating_monitor_progress` as 'head_panel_beating_monitor_progress', `external_repairs_body`.`head_panel_beating_monitor_quality_of_work_manship` as 'head_panel_beating_monitor_quality_of_work_manship', `external_repairs_body`.`vehicle_inspection_report` as 'vehicle_inspection_report', `external_repairs_body`.`upload_invoice` as 'upload_invoice'",
			'ordering_of_spares_for_internal_repairs' => "`ordering_of_spares_for_internal_repairs`.`spares_id` as 'spares_id', IF(    CHAR_LENGTH(`districts1`.`station`) || CHAR_LENGTH(`districts1`.`district`), CONCAT_WS('',   `districts1`.`station`, '      |     and      |     ', `districts1`.`district`), '') as 'workshop_name', IF(    CHAR_LENGTH(`reception1`.`job_card_number`), CONCAT_WS('',   `reception1`.`job_card_number`), '') as 'job_card_number', `ordering_of_spares_for_internal_repairs`.`artisan_name_and_surname` as 'artisan_name_and_surname', `ordering_of_spares_for_internal_repairs`.`artisan_contacts` as 'artisan_contacts', `ordering_of_spares_for_internal_repairs`.`artisan_email_address` as 'artisan_email_address', `ordering_of_spares_for_internal_repairs`.`artisan_signature` as 'artisan_signature', `ordering_of_spares_for_internal_repairs`.`internal_requisition_to_stores` as 'internal_requisition_to_stores', `ordering_of_spares_for_internal_repairs`.`supervisor_name_and_surname` as 'supervisor_name_and_surname', `ordering_of_spares_for_internal_repairs`.`supervisor_contact_details` as 'supervisor_contact_details', `ordering_of_spares_for_internal_repairs`.`supervisor_email_address` as 'supervisor_email_address', `ordering_of_spares_for_internal_repairs`.`supervisor_signature` as 'supervisor_signature', `ordering_of_spares_for_internal_repairs`.`internal_requisition_to_stores_recommended` as 'internal_requisition_to_stores_recommended', `ordering_of_spares_for_internal_repairs`.`workshop_manager_name_and_surname` as 'workshop_manager_name_and_surname', `ordering_of_spares_for_internal_repairs`.`workshop_manager_contact_details` as 'workshop_manager_contact_details', `ordering_of_spares_for_internal_repairs`.`workshop_manager_email_address` as 'workshop_manager_email_address', `ordering_of_spares_for_internal_repairs`.`workshop_manager_signature` as 'workshop_manager_signature', `ordering_of_spares_for_internal_repairs`.`internal_requisition_to_stores_approved` as 'internal_requisition_to_stores_approved', DATE_FORMAT(`ordering_of_spares_for_internal_repairs`.`date_parts_ordered`, '%e/%c/%Y %l:%i%p') as 'date_parts_ordered', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`), '') as 'vehicle_registration_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS('',   `gmt_fleet_register1`.`engine_number`), '') as 'engine_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`) || CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS('',   `gmt_fleet_register1`.`model_of_vehicle`, '   |    and     |     ', `dealer1`.`make_of_vehicle`, '   '), '') as 'make_of_vehicle', IF(    CHAR_LENGTH(`parts_type1`.`part_type`), CONCAT_WS('',   `parts_type1`.`part_type`), '') as 'part_type_1', IF(    CHAR_LENGTH(`parts1`.`part_name`), CONCAT_WS('',   `parts1`.`part_name`), '') as 'part_name_1', IF(    CHAR_LENGTH(`parts2`.`description`), CONCAT_WS('',   `parts2`.`description`), '') as 'description_1', IF(    CHAR_LENGTH(`manufacturer1`.`manufacturer_name`), CONCAT_WS('',   `manufacturer1`.`manufacturer_name`), '') as 'manufacture_1', `ordering_of_spares_for_internal_repairs`.`quality_1` as 'quality_1', CONCAT('$', FORMAT(`ordering_of_spares_for_internal_repairs`.`unit_price_1`, 2)) as 'unit_price_1', CONCAT('$', FORMAT(`ordering_of_spares_for_internal_repairs`.`net_part_price_1`, 2)) as 'net_part_price_1', IF(    CHAR_LENGTH(`parts_type2`.`part_type`), CONCAT_WS('',   `parts_type2`.`part_type`), '') as 'part_type_2', IF(    CHAR_LENGTH(`parts4`.`part_name`), CONCAT_WS('',   `parts4`.`part_name`), '') as 'part_name_2', IF(    CHAR_LENGTH(`parts5`.`description`), CONCAT_WS('',   `parts5`.`description`), '') as 'description_2', IF(    CHAR_LENGTH(`manufacturer2`.`manufacturer_name`), CONCAT_WS('',   `manufacturer2`.`manufacturer_name`), '') as 'manufacture_2', `ordering_of_spares_for_internal_repairs`.`quality_2` as 'quality_2', CONCAT('$', FORMAT(`ordering_of_spares_for_internal_repairs`.`unit_price_2`, 2)) as 'unit_price_2', CONCAT('$', FORMAT(`ordering_of_spares_for_internal_repairs`.`net_part_price_2`, 2)) as 'net_part_price_2', IF(    CHAR_LENGTH(`parts_type3`.`part_type`), CONCAT_WS('',   `parts_type3`.`part_type`), '') as 'part_type_3', IF(    CHAR_LENGTH(`parts7`.`part_name`), CONCAT_WS('',   `parts7`.`part_name`), '') as 'part_name_3', IF(    CHAR_LENGTH(`parts8`.`description`), CONCAT_WS('',   `parts8`.`description`), '') as 'description_3', IF(    CHAR_LENGTH(`manufacturer3`.`manufacturer_name`), CONCAT_WS('',   `manufacturer3`.`manufacturer_name`), '') as 'manufacture_3', `ordering_of_spares_for_internal_repairs`.`quality_3` as 'quality_3', CONCAT('$', FORMAT(`ordering_of_spares_for_internal_repairs`.`unit_price_3`, 2)) as 'unit_price_3', CONCAT('$', FORMAT(`ordering_of_spares_for_internal_repairs`.`net_part_price_3`, 2)) as 'net_part_price_3', IF(    CHAR_LENGTH(`parts_type4`.`part_type`), CONCAT_WS('',   `parts_type4`.`part_type`), '') as 'part_type_4', IF(    CHAR_LENGTH(`parts10`.`part_name`), CONCAT_WS('',   `parts10`.`part_name`), '') as 'part_name_4', IF(    CHAR_LENGTH(`parts11`.`description`), CONCAT_WS('',   `parts11`.`description`), '') as 'description_4', IF(    CHAR_LENGTH(`manufacturer4`.`manufacturer_name`), CONCAT_WS('',   `manufacturer4`.`manufacturer_name`), '') as 'manufacture_4', `ordering_of_spares_for_internal_repairs`.`quality_4` as 'quality_4', CONCAT('$', FORMAT(`ordering_of_spares_for_internal_repairs`.`unit_price_4`, 2)) as 'unit_price_4', CONCAT('$', FORMAT(`ordering_of_spares_for_internal_repairs`.`net_part_price_4`, 2)) as 'net_part_price_4', IF(    CHAR_LENGTH(`parts_type5`.`part_type`), CONCAT_WS('',   `parts_type5`.`part_type`), '') as 'part_type_5', IF(    CHAR_LENGTH(`parts13`.`part_name`), CONCAT_WS('',   `parts13`.`part_name`), '') as 'part_name_5', IF(    CHAR_LENGTH(`parts14`.`description`), CONCAT_WS('',   `parts14`.`description`), '') as 'description_5', IF(    CHAR_LENGTH(`manufacturer5`.`manufacturer_name`), CONCAT_WS('',   `manufacturer5`.`manufacturer_name`), '') as 'manufacture_5', `ordering_of_spares_for_internal_repairs`.`quality_5` as 'quality_5', CONCAT('$', FORMAT(`ordering_of_spares_for_internal_repairs`.`unit_price_5`, 2)) as 'unit_price_5', CONCAT('$', FORMAT(`ordering_of_spares_for_internal_repairs`.`net_part_price_5`, 2)) as 'net_part_price_5', IF(    CHAR_LENGTH(`parts_type6`.`part_type`), CONCAT_WS('',   `parts_type6`.`part_type`), '') as 'part_type_6', IF(    CHAR_LENGTH(`parts16`.`part_name`), CONCAT_WS('',   `parts16`.`part_name`), '') as 'part_name_6', IF(    CHAR_LENGTH(`parts17`.`description`), CONCAT_WS('',   `parts17`.`description`), '') as 'description_6', IF(    CHAR_LENGTH(`manufacturer6`.`manufacturer_name`), CONCAT_WS('',   `manufacturer6`.`manufacturer_name`), '') as 'manufacture_6', `ordering_of_spares_for_internal_repairs`.`quality_6` as 'quality_6', CONCAT('$', FORMAT(`ordering_of_spares_for_internal_repairs`.`unit_price_6`, 2)) as 'unit_price_6', CONCAT('$', FORMAT(`ordering_of_spares_for_internal_repairs`.`net_part_price_6`, 2)) as 'net_part_price_6', IF(    CHAR_LENGTH(`parts_type7`.`part_type`), CONCAT_WS('',   `parts_type7`.`part_type`), '') as 'part_type_7', IF(    CHAR_LENGTH(`parts19`.`part_name`), CONCAT_WS('',   `parts19`.`part_name`), '') as 'part_name_7', IF(    CHAR_LENGTH(`parts20`.`description`), CONCAT_WS('',   `parts20`.`description`), '') as 'description_7', IF(    CHAR_LENGTH(`manufacturer7`.`manufacturer_name`), CONCAT_WS('',   `manufacturer7`.`manufacturer_name`), '') as 'manufacture_7', `ordering_of_spares_for_internal_repairs`.`quality_7` as 'quality_7', CONCAT('$', FORMAT(`ordering_of_spares_for_internal_repairs`.`unit_price_7`, 2)) as 'unit_price_7', CONCAT('$', FORMAT(`ordering_of_spares_for_internal_repairs`.`net_part_price_7`, 2)) as 'net_part_price_7', IF(    CHAR_LENGTH(`parts_type8`.`part_type`), CONCAT_WS('',   `parts_type8`.`part_type`), '') as 'part_type_8', IF(    CHAR_LENGTH(`parts22`.`part_name`), CONCAT_WS('',   `parts22`.`part_name`), '') as 'part_name_8', IF(    CHAR_LENGTH(`parts23`.`description`), CONCAT_WS('',   `parts23`.`description`), '') as 'description_8', IF(    CHAR_LENGTH(`manufacturer8`.`manufacturer_name`), CONCAT_WS('',   `manufacturer8`.`manufacturer_name`), '') as 'manufacture_8', CONCAT('$', FORMAT(`ordering_of_spares_for_internal_repairs`.`unit_price_8`, 2)) as 'unit_price_8', `ordering_of_spares_for_internal_repairs`.`quality_8` as 'quality_8', CONCAT('$', FORMAT(`ordering_of_spares_for_internal_repairs`.`net_part_price_8`, 2)) as 'net_part_price_8', `ordering_of_spares_for_internal_repairs`.`tax` as 'tax', CONCAT('$', FORMAT(`ordering_of_spares_for_internal_repairs`.`total_amount`, 2)) as 'total_amount', `ordering_of_spares_for_internal_repairs`.`attached_requisition_form` as 'attached_requisition_form', IF(    CHAR_LENGTH(`work_allocation1`.`work_allocation_reference_number`), CONCAT_WS('',   `work_allocation1`.`work_allocation_reference_number`), '') as 'work_allocation_reference_number', DATE_FORMAT(`ordering_of_spares_for_internal_repairs`.`date_parts_received`, '%e/%c/%Y %l:%i%p') as 'date_parts_received'",
			'collection_of_repaired_vehicles' => "`collection_of_repaired_vehicles`.`collection_id` as 'collection_id', IF(    CHAR_LENGTH(`reception1`.`reception_name_and_surname`), CONCAT_WS('',   `reception1`.`reception_name_and_surname`), '') as 'reception_name_and_surname', IF(    CHAR_LENGTH(`reception1`.`reception_persal_number`), CONCAT_WS('',   `reception1`.`reception_persal_number`), '') as 'reception_persal_number', IF(    CHAR_LENGTH(`reception1`.`reception_contact_details`), CONCAT_WS('',   `reception1`.`reception_contact_details`), '') as 'reception_contact_details', IF(    CHAR_LENGTH(`reception1`.`reception_email_address`), CONCAT_WS('',   `reception1`.`reception_email_address`), '') as 'reception_email_address', `collection_of_repaired_vehicles`.`reception_signature` as 'reception_signature', IF(    CHAR_LENGTH(`driver1`.`drivers_name_and_surname`), CONCAT_WS('',   `driver1`.`drivers_name_and_surname`), '') as 'driver_name_and_surname', IF(    CHAR_LENGTH(`driver1`.`drivers_persal_number`), CONCAT_WS('',   `driver1`.`drivers_persal_number`), '') as 'driver_persal_number', IF(    CHAR_LENGTH(`driver1`.`drivers_contact_details`), CONCAT_WS('',   `driver1`.`drivers_contact_details`), '') as 'driver_contacts_details', IF(    CHAR_LENGTH(`driver1`.`drivers_email_address`), CONCAT_WS('',   `driver1`.`drivers_email_address`), '') as 'driver_email_address', `collection_of_repaired_vehicles`.`driver_license_upload` as 'driver_license_upload', `collection_of_repaired_vehicles`.`driver_signature` as 'driver_signature', IF(    CHAR_LENGTH(`districts1`.`station`) || CHAR_LENGTH(`districts1`.`district`), CONCAT_WS('',   `districts1`.`station`, '    |    and    |      ', `districts1`.`district`), '') as 'government_garage_name', `collection_of_repaired_vehicles`.`government_garage_contact_details` as 'government_garage_contact_details', `collection_of_repaired_vehicles`.`government_garage_address` as 'government_garage_address', `collection_of_repaired_vehicles`.`government_garage_email_address` as 'government_garage_email_address', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`), '') as 'vehicle_registration_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS('',   `gmt_fleet_register1`.`engine_number`), '') as 'engine_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`) || CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS('',   `gmt_fleet_register1`.`model_of_vehicle`, '   |    and     |     ', `dealer1`.`make_of_vehicle`, '   '), '') as 'make_of_vehicle', `collection_of_repaired_vehicles`.`vehicle_inspection` as 'vehicle_inspection', `collection_of_repaired_vehicles`.`vehicle_inspection_form` as 'vehicle_inspection_form', `collection_of_repaired_vehicles`.`vehicle_interiour_condition` as 'vehicle_interiour_condition', `collection_of_repaired_vehicles`.`vehicle_exteriour_condition` as 'vehicle_exteriour_condition', `collection_of_repaired_vehicles`.`vehicle_tyre_check` as 'vehicle_tyre_check', DATE_FORMAT(`collection_of_repaired_vehicles`.`sign_off_time`, '%e/%c/%Y %l:%i%p') as 'sign_off_time', DATE_FORMAT(`collection_of_repaired_vehicles`.`date_of_repaired_vehicle_collection`, '%e/%c/%Y %l:%i%p') as 'date_of_repaired_vehicle_collection'",
			'withdrawal_vehicle_from_operation' => "`withdrawal_vehicle_from_operation`.`withdrawal_id` as 'withdrawal_id', `withdrawal_vehicle_from_operation`.`supervisor_name_and_surname` as 'supervisor_name_and_surname', `withdrawal_vehicle_from_operation`.`supervisor_contact_details` as 'supervisor_contact_details', `withdrawal_vehicle_from_operation`.`supervisor_email_address` as 'supervisor_email_address', `withdrawal_vehicle_from_operation`.`supervisor_signature` as 'supervisor_signature', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`), '') as 'vehicle_registration_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS('',   `gmt_fleet_register1`.`engine_number`), '') as 'engine_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`) || CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS('',   `gmt_fleet_register1`.`model_of_vehicle`, '   |    and     |     ', `dealer1`.`make_of_vehicle`, '   '), '') as 'make_of_vehicle', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`purchase_price`), CONCAT_WS('',   `gmt_fleet_register1`.`purchase_price`), '') as 'purchased_price', IF(    CHAR_LENGTH(if(`schedule1`.`date`,date_format(`schedule1`.`date`,'%d/%m/%Y'),'')), CONCAT_WS('',   if(`schedule1`.`date`,date_format(`schedule1`.`date`,'%d/%m/%Y'),'')), '') as 'date_of_service', IF(    CHAR_LENGTH(if(`service1`.`date_of_next_service`,date_format(`service1`.`date_of_next_service`,'%d/%m/%Y'),'')), CONCAT_WS('',   if(`service1`.`date_of_next_service`,date_format(`service1`.`date_of_next_service`,'%d/%m/%Y'),'')), '') as 'date_of_next_service', IF(    CHAR_LENGTH(if(`gmt_fleet_register1`.`renewal_of_license`,date_format(`gmt_fleet_register1`.`renewal_of_license`,'%d/%m/%Y'),'')), CONCAT_WS('',   if(`gmt_fleet_register1`.`renewal_of_license`,date_format(`gmt_fleet_register1`.`renewal_of_license`,'%d/%m/%Y'),'')), '') as 'renewal_of_license', if(`withdrawal_vehicle_from_operation`.`date_of_vehicle`,date_format(`withdrawal_vehicle_from_operation`.`date_of_vehicle`,'%d/%m/%Y %H:%i'),'') as 'date_of_vehicle', `withdrawal_vehicle_from_operation`.`description_of_vehicle_breakdown` as 'description_of_vehicle_breakdown', `withdrawal_vehicle_from_operation`.`tyre_inspection_report` as 'tyre_inspection_report', `withdrawal_vehicle_from_operation`.`document_checklist_report` as 'document_checklist_report', `withdrawal_vehicle_from_operation`.`compiled_technical_report` as 'compiled_technical_report', `withdrawal_vehicle_from_operation`.`district_officer_name_and_surname` as 'district_officer_name_and_surname', `withdrawal_vehicle_from_operation`.`district_officer_persal_number` as 'district_officer_persal_number', `withdrawal_vehicle_from_operation`.`district_officer_contacts` as 'district_officer_contacts', `withdrawal_vehicle_from_operation`.`district_officer_signature` as 'district_officer_signature', `withdrawal_vehicle_from_operation`.`district_officer_email_address` as 'district_officer_email_address'",
			'costing' => "`costing`.`costing_id` as 'costing_id', IF(    CHAR_LENGTH(`districts1`.`station`) || CHAR_LENGTH(`districts1`.`district`), CONCAT_WS('',   `districts1`.`station`, '    |    and    |      ', `districts1`.`district`), '') as 'government_garage_name', `costing`.`supervisor_name_and_surname` as 'supervisor_name_and_surname', `costing`.`supervisor_contact_details` as 'supervisor_contact_details', `costing`.`supervisor_email_address` as 'supervisor_email_address', `costing`.`supervisor_signature` as 'supervisor_signature', IF(    CHAR_LENGTH(`reception1`.`job_card_number`), CONCAT_WS('',   `reception1`.`job_card_number`), '') as 'job_card_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`), '') as 'vehicle_registration_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS('',   `gmt_fleet_register1`.`engine_number`), '') as 'engine_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`) || CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS('',   `gmt_fleet_register1`.`model_of_vehicle`, '   |    and     |     ', `dealer1`.`make_of_vehicle`, '   '), '') as 'make_of_vehicle', `costing`.`reconciliation_of_total_costs_by_costing_officer` as 'reconciliation_of_total_costs_by_costing_officer', `costing`.`costing_officer_name_and_surname` as 'costing_officer_name_and_surname', `costing`.`costing_officer_contact_details` as 'costing_officer_contact_details', `costing`.`costing_officer_email_address` as 'costing_officer_email_address', `costing`.`costing_officer_signature` as 'costing_officer_signature', `costing`.`material_cost` as 'material_cost', `costing`.`spares_orders_quotation` as 'spares_orders_quotation', `costing`.`spares_orders_quotation_upload` as 'spares_orders_quotation_upload', `costing`.`standard_labour_cost_per_hour` as 'standard_labour_cost_per_hour', `costing`.`labour_quotation` as 'labour_quotation', `costing`.`labour_quotation_upload` as 'labour_quotation_upload', `costing`.`vat` as 'vat', `costing`.`total_amount` as 'total_amount', `costing`.`workshop_manager_name_and_surname` as 'workshop_manager_name_and_surname', `costing`.`workshop_manager_contact_details` as 'workshop_manager_contact_details', `costing`.`workshop_manager_email_address` as 'workshop_manager_email_address', `costing`.`workshop_manager_signature` as 'workshop_manager_signature', `costing`.`invoice_approved` as 'invoice_approved', if(`costing`.`invoice_date`,date_format(`costing`.`invoice_date`,'%d/%m/%Y'),'') as 'invoice_date', `costing`.`upload_invoice` as 'upload_invoice'",
			'billing' => "`billing`.`billing_id` as 'billing_id', IF(    CHAR_LENGTH(`districts1`.`district`), CONCAT_WS('',   `districts1`.`district`), '') as 'district', IF(    CHAR_LENGTH(`districts1`.`station`), CONCAT_WS('',   `districts1`.`station`, '   |  and   |   '), '') as 'location', `billing`.`upload_invoice` as 'upload_invoice', IF(    CHAR_LENGTH(`reception1`.`job_card_number`), CONCAT_WS('',   `reception1`.`job_card_number`), '') as 'job_card_number', if(`billing`.`invoice_date`,date_format(`billing`.`invoice_date`,'%d/%m/%Y'),'') as 'invoice_date', `billing`.`maintenance_file` as 'maintenance_file', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`), '') as 'vehicle_registration_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS('',   `gmt_fleet_register1`.`engine_number`), '') as 'engine_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`) || CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS('',   `gmt_fleet_register1`.`model_of_vehicle`, '   |    and     |     ', `dealer1`.`make_of_vehicle`, '   '), '') as 'make_of_vehicle'",
			'general_control_measures' => "`general_control_measures`.`general_control_measures_id` as 'general_control_measures_id', IF(    CHAR_LENGTH(`districts1`.`district`), CONCAT_WS('',   `districts1`.`district`), '') as 'district', IF(    CHAR_LENGTH(`cost_centre1`.`cost_centre`), CONCAT_WS('',   `cost_centre1`.`cost_centre`), '') as 'cost_centre', IF(    CHAR_LENGTH(`districts1`.`station`), CONCAT_WS('',   `districts1`.`station`, '   |  and   |   '), '') as 'location', `general_control_measures`.`government_garage_name` as 'government_garage_name', `general_control_measures`.`government_garage_section` as 'government_garage_section', `general_control_measures`.`government_garage_manager_name_and_surname` as 'government_garage_manager_name_and_surname', `general_control_measures`.`government_garage_manager_contact_details` as 'government_garage_manager_contact_details', `general_control_measures`.`government_garage_manager_email_address` as 'government_garage_manager_email_address', `general_control_measures`.`government_garage_manager_signature` as 'government_garage_manager_signature', `general_control_measures`.`government_garage_address` as 'government_garage_address', `general_control_measures`.`government_garage_condition` as 'government_garage_condition', `general_control_measures`.`four_post_lift_condition` as 'four_post_lift_condition', `general_control_measures`.`low_level_lift_condition` as 'low_level_lift_condition', `general_control_measures`.`test_machines_conditions` as 'test_machines_conditions', `general_control_measures`.`battery_testers_conditions` as 'battery_testers_conditions', `general_control_measures`.`chargers_conditions` as 'chargers_conditions', `general_control_measures`.`tools_conditions` as 'tools_conditions', `general_control_measures`.`hand_tools_conditions` as 'hand_tools_conditions', `general_control_measures`.`equipment_conditions` as 'equipment_conditions', `general_control_measures`.`sectional_inspection` as 'sectional_inspection'",
			'movement_of_personnel_in_government_garage_and_workshops' => "`movement_of_personnel_in_government_garage_and_workshops`.`movement_id` as 'movement_id', IF(    CHAR_LENGTH(`movement_of_personnel_in_government_garage_and_workshops1`.`vehicle_model`), CONCAT_WS('',   `movement_of_personnel_in_government_garage_and_workshops1`.`vehicle_model`), '') as 'vehicle_inspection', `movement_of_personnel_in_government_garage_and_workshops`.`vehicle_model` as 'vehicle_model', `movement_of_personnel_in_government_garage_and_workshops`.`vehicle_number_plate` as 'vehicle_number_plate', `movement_of_personnel_in_government_garage_and_workshops`.`vehicle_tires_check` as 'vehicle_tires_check', `movement_of_personnel_in_government_garage_and_workshops`.`vehicle_mirrow_check` as 'vehicle_mirrow_check', `movement_of_personnel_in_government_garage_and_workshops`.`gate_security_signature` as 'gate_security_signature', `movement_of_personnel_in_government_garage_and_workshops`.`government_garage_protocol` as 'government_garage_protocol', `movement_of_personnel_in_government_garage_and_workshops`.`government_garage_safety` as 'government_garage_safety', `movement_of_personnel_in_government_garage_and_workshops`.`vehicle_handing_over_checklist` as 'vehicle_handing_over_checklist', `movement_of_personnel_in_government_garage_and_workshops`.`vehicle_return_list` as 'vehicle_return_list', `movement_of_personnel_in_government_garage_and_workshops`.`approved_workshop_procedure_manual` as 'approved_workshop_procedure_manual', `movement_of_personnel_in_government_garage_and_workshops`.`vehicle_registration_number` as 'vehicle_registration_number', `movement_of_personnel_in_government_garage_and_workshops`.`engine_number` as 'engine_number', IF(    CHAR_LENGTH(`dealer1`.`make_of_vehicle`) || CHAR_LENGTH(`dealer_type1`.`dealer_type`), CONCAT_WS('',   `dealer1`.`make_of_vehicle`, '   |    and     |     ', `dealer_type1`.`dealer_type`), '') as 'make_of_vehicle'",
			'service_provider' => "`service_provider`.`service_provider_id` as 'service_provider_id', IF(    CHAR_LENGTH(`service_provider_type1`.`service_provider_type`), CONCAT_WS('',   `service_provider_type1`.`service_provider_type`), '') as 'service_provider_type', `service_provider`.`service_provider_name` as 'service_provider_name', `service_provider`.`service_provider_contact_email` as 'service_provider_contact_email', `service_provider`.`service_provider_contact_details` as 'service_provider_contact_details', `service_provider`.`service_provider_street_address` as 'service_provider_street_address', `service_provider`.`service_provider_branch_code` as 'service_provider_branch_code', `service_provider`.`service_provider_branch` as 'service_provider_branch', `service_provider`.`service_provider_city` as 'service_provider_city', `service_provider`.`service_provider_address_code` as 'service_provider_address_code'",
			'service_provider_type' => "`service_provider_type`.`service_provider_type_id` as 'service_provider_type_id', `service_provider_type`.`service_provider_type` as 'service_provider_type'",
			'vehicle_annual_inspection' => "`vehicle_annual_inspection`.`fleet_asset_id` as 'fleet_asset_id', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`), '') as 'vehicle_registration_number', IF(    CHAR_LENGTH(`gmt_fleet_register2`.`register_number`), CONCAT_WS('',   `gmt_fleet_register2`.`register_number`), '') as 'register_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS('',   `gmt_fleet_register1`.`engine_number`), '') as 'engine_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`chassis_number`), CONCAT_WS('',   `gmt_fleet_register1`.`chassis_number`), '') as 'chassis_number', IF(    CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS('',   `dealer1`.`make_of_vehicle`, '   '), '') as 'make_of_vehicle', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`), CONCAT_WS('',   `gmt_fleet_register1`.`model_of_vehicle`), '') as 'model_of_vehicle', IF(    CHAR_LENGTH(`year_model1`.`year_model_specification`), CONCAT_WS('',   `year_model1`.`year_model_specification`), '') as 'year_model_specification', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_capacity`), CONCAT_WS('',   `gmt_fleet_register1`.`engine_capacity`), '') as 'engine_capacity', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`tyre_size`), CONCAT_WS('',   `gmt_fleet_register1`.`tyre_size`), '') as 'tyre_size', IF(    CHAR_LENGTH(`transmission1`.`transmission`), CONCAT_WS('',   `transmission1`.`transmission`), '') as 'transmission', IF(    CHAR_LENGTH(`fuel_type1`.`fuel_type`), CONCAT_WS('',   `fuel_type1`.`fuel_type`), '') as 'fuel_type', IF(    CHAR_LENGTH(`body_type1`.`type_of_vehicle`), CONCAT_WS('',   `body_type1`.`type_of_vehicle`), '') as 'type_of_vehicle', IF(    CHAR_LENGTH(`vehicle_colour1`.`colour_of_vehicle`), CONCAT_WS('',   `vehicle_colour1`.`colour_of_vehicle`), '') as 'colour_of_vehicle', IF(    CHAR_LENGTH(`application_status1`.`application_status`), CONCAT_WS('',   `application_status1`.`application_status`), '') as 'application_status', IF(    CHAR_LENGTH(if(`gmt_fleet_register1`.`renewal_of_license`,date_format(`gmt_fleet_register1`.`renewal_of_license`,'%d/%m/%Y'),'')), CONCAT_WS('',   if(`gmt_fleet_register1`.`renewal_of_license`,date_format(`gmt_fleet_register1`.`renewal_of_license`,'%d/%m/%Y'),'')), '') as 'renewal_of_license', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`barcode_number`), CONCAT_WS('',   `gmt_fleet_register1`.`barcode_number`), '') as 'barcode_number', if(`vehicle_annual_inspection`.`last_entry_logbook`,date_format(`vehicle_annual_inspection`.`last_entry_logbook`,'%d/%m/%Y'),'') as 'last_entry_logbook', `vehicle_annual_inspection`.`photo_of_vehicle` as 'photo_of_vehicle', IF(    CHAR_LENGTH(`departments1`.`department_name`), CONCAT_WS('',   `departments1`.`department_name`), '') as 'department_name', IF(    CHAR_LENGTH(`province1`.`province`), CONCAT_WS('',   `province1`.`province`), '') as 'province', IF(    CHAR_LENGTH(`districts1`.`district`) || CHAR_LENGTH(`districts1`.`station`), CONCAT_WS('',   `districts1`.`district`, '     |     and     |     ', `districts1`.`station`), '') as 'district', `vehicle_annual_inspection`.`mechanical_inspection` as 'mechanical_inspection', `vehicle_annual_inspection`.`upholstery` as 'upholstery', `vehicle_annual_inspection`.`electrical_inspection` as 'electrical_inspection', `vehicle_annual_inspection`.`wheel_spanner` as 'wheel_spanner', `vehicle_annual_inspection`.`spare_wheel` as 'spare_wheel', `vehicle_annual_inspection`.`jack` as 'jack', `vehicle_annual_inspection`.`radio` as 'radio', `vehicle_annual_inspection`.`triangle` as 'triangle', `vehicle_annual_inspection`.`log_book` as 'log_book', `vehicle_annual_inspection`.`iternary` as 'iternary', `vehicle_annual_inspection`.`fuel_card` as 'fuel_card', `vehicle_annual_inspection`.`recommendation` as 'recommendation', `vehicle_annual_inspection`.`documents` as 'documents', `vehicle_annual_inspection`.`checking_officer_name_and_surname` as 'checking_officer_name_and_surname', `vehicle_annual_inspection`.`checking_officer_contact_email` as 'checking_officer_contact_email', if(`vehicle_annual_inspection`.`date_of_inspection`,date_format(`vehicle_annual_inspection`.`date_of_inspection`,'%d/%m/%Y'),'') as 'date_of_inspection'",
		];

		if(isset($sql_fields[$table_name])) return $sql_fields[$table_name];

		return false;
	}

	#########################################################

	function get_sql_from($table_name, $skip_permissions = false, $skip_joins = false, $lower_permissions = false) {
		$sql_from = [
			'gmt_fleet_register' => "`gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ",
			'log_sheet' => "`log_sheet` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`log_sheet`.`vehicle_registration_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register2 ON `gmt_fleet_register2`.`fleet_asset_id`=`log_sheet`.`register_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register3 ON `gmt_fleet_register3`.`fleet_asset_id`=`log_sheet`.`model_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`log_sheet`.`colour_of_vehicle` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`log_sheet`.`drivers_name_and_surname` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`log_sheet`.`fuel_type` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register1`.`year_model_specification` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register1`.`district` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register1`.`province` ",
			'vehicle_history' => "`vehicle_history` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`vehicle_history`.`vehicle_registration_number` LEFT JOIN `service` as service1 ON `service1`.`service_id`=`vehicle_history`.`date_of_service` LEFT JOIN `schedule` as schedule1 ON `schedule1`.`schedule_id`=`service1`.`date_of_service` LEFT JOIN `purchase_orders` as purchase_orders1 ON `purchase_orders1`.`purchase_order_id`=`vehicle_history`.`purchased_order_number` LEFT JOIN `claim` as claim1 ON `claim1`.`claim_id`=`vehicle_history`.`claim_code` LEFT JOIN `tyre_log_sheet` as tyre_log_sheet1 ON `tyre_log_sheet1`.`tyre_log_id`=`vehicle_history`.`tyre_inspection_report` LEFT JOIN `vehicle_daily_check_list` as vehicle_daily_check_list1 ON `vehicle_daily_check_list1`.`vehicle_daily_check_list_id`=`vehicle_history`.`inspection_certification_number` LEFT JOIN `vehicle_daily_check_list` as vehicle_daily_check_list2 ON `vehicle_daily_check_list2`.`vehicle_daily_check_list_id`=`vehicle_history`.`document_checklist_report` LEFT JOIN `vehicle_daily_check_list` as vehicle_daily_check_list3 ON `vehicle_daily_check_list3`.`vehicle_daily_check_list_id`=`vehicle_history`.`next_inspection_date` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`vehicle_history`.`closing_km` LEFT JOIN `breakdown_services` as breakdown_services1 ON `breakdown_services1`.`breakdown_id`=`vehicle_history`.`total_cost` ",
			'year_model' => "`year_model` ",
			'month' => "`month` ",
			'body_type' => "`body_type` ",
			'vehicle_colour' => "`vehicle_colour` ",
			'province' => "`province` ",
			'departments' => "`departments` ",
			'districts' => "`districts` ",
			'application_status' => "`application_status` ",
			'vehicle_payments' => "`vehicle_payments` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`vehicle_payments`.`vehicle_registration_number` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`vehicle_payments`.`closing_km` LEFT JOIN `merchant` as merchant1 ON `merchant1`.`merchant_id`=`vehicle_payments`.`merchant_name` LEFT JOIN `merchant_type` as merchant_type1 ON `merchant_type1`.`merchant_type_id`=`merchant1`.`merchant_type` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register1`.`year_model_specification` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register1`.`type_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register1`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register1`.`department_name` ",
			'insurance_payments' => "`insurance_payments` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`insurance_payments`.`vehicle_registration_number` LEFT JOIN `merchant` as merchant1 ON `merchant1`.`merchant_id`=`insurance_payments`.`merchant_name` LEFT JOIN `merchant_type` as merchant_type1 ON `merchant_type1`.`merchant_type_id`=`merchant1`.`merchant_type` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register1`.`year_model_specification` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register1`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register1`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register1`.`department_name` ",
			'authorizations' => "`authorizations` LEFT JOIN `claim` as claim1 ON `claim1`.`claim_id`=`authorizations`.`job_code` LEFT JOIN `claim_status` as claim_status1 ON `claim_status1`.`claim_status_id`=`authorizations`.`job_status` LEFT JOIN `claim_category` as claim_category1 ON `claim_category1`.`claim_category_id`=`authorizations`.`job_category` LEFT JOIN `claim` as claim2 ON `claim2`.`claim_id`=`authorizations`.`vehicle_registration_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`claim2`.`vehicle_registration_number` LEFT JOIN `claim` as claim3 ON `claim3`.`claim_id`=`authorizations`.`client` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`claim3`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`authorizations`.`province_name` LEFT JOIN `merchant` as merchant1 ON `merchant1`.`merchant_id`=`authorizations`.`merchant_code` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`claim1`.`closing_km` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register3 ON `gmt_fleet_register3`.`fleet_asset_id`=`claim1`.`vehicle_registration_number` ",
			'service' => "`service` LEFT JOIN `service_item_type` as service_item_type1 ON `service_item_type1`.`service_item_type_id`=`service`.`service_item_type` LEFT JOIN `service_categories` as service_categories1 ON `service_categories1`.`service_categories_id`=`service`.`service_category` LEFT JOIN `merchant` as merchant1 ON `merchant1`.`merchant_id`=`service`.`merchant_name` LEFT JOIN `merchant_type` as merchant_type1 ON `merchant_type1`.`merchant_type_id`=`merchant1`.`merchant_type` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`service`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`service`.`dealer_name` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`service`.`closing_km` LEFT JOIN `work_allocation` as work_allocation1 ON `work_allocation1`.`work_allocation_id`=`service`.`work_allocation_reference_number` LEFT JOIN `schedule` as schedule1 ON `schedule1`.`schedule_id`=`service`.`date_of_service` LEFT JOIN `reception` as reception1 ON `reception1`.`reception_user_id`=`service`.`receptionist` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register1`.`year_model_specification` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register1`.`type_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register1`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register1`.`department_name` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`reception1`.`district` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register10 ON `gmt_fleet_register10`.`fleet_asset_id`=`reception1`.`vehicle_registration_number` ",
			'service_type' => "`service_type` LEFT JOIN `service_item_type` as service_item_type1 ON `service_item_type1`.`service_item_type_id`=`service_type`.`service_item_type` LEFT JOIN `service_categories` as service_categories1 ON `service_categories1`.`service_categories_id`=`service_type`.`service_category` ",
			'schedule' => "`schedule` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`schedule`.`user_name_and_surname` LEFT JOIN `service_item_type` as service_item_type1 ON `service_item_type1`.`service_item_type_id`=`schedule`.`service_item_type` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register2 ON `gmt_fleet_register2`.`fleet_asset_id`=`schedule`.`vehicle_registration_number` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`schedule`.`closing_km` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`schedule`.`workshop_name` ",
			'service_records' => "`service_records` LEFT JOIN `service` as service1 ON `service1`.`service_id`=`service_records`.`vehicle` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`service1`.`vehicle_registration_number` ",
			'service_categories' => "`service_categories` ",
			'service_item_type' => "`service_item_type` ",
			'service_item' => "`service_item` ",
			'purchase_orders' => "`purchase_orders` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`purchase_orders`.`vehicle_registration_number` LEFT JOIN `manufacturer` as manufacturer1 ON `manufacturer1`.`manufacturer_id`=`purchase_orders`.`manufacturer` LEFT JOIN `service_categories` as service_categories1 ON `service_categories1`.`service_categories_id`=`purchase_orders`.`service_category` LEFT JOIN `merchant` as merchant1 ON `merchant1`.`merchant_id`=`purchase_orders`.`merchant_name` LEFT JOIN `merchant_type` as merchant_type1 ON `merchant_type1`.`merchant_type_id`=`merchant1`.`merchant_type` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`purchase_orders`.`closing_km` LEFT JOIN `parts` as parts1 ON `parts1`.`parts_id`=`purchase_orders`.`part_number_1` LEFT JOIN `parts` as parts2 ON `parts2`.`parts_id`=`purchase_orders`.`part_name_1` LEFT JOIN `manufacturer` as manufacturer2 ON `manufacturer2`.`manufacturer_id`=`purchase_orders`.`part_manufacturer_name_1` LEFT JOIN `parts` as parts3 ON `parts3`.`parts_id`=`purchase_orders`.`part_number_2` LEFT JOIN `parts` as parts4 ON `parts4`.`parts_id`=`purchase_orders`.`part_name_2` LEFT JOIN `manufacturer` as manufacturer3 ON `manufacturer3`.`manufacturer_id`=`purchase_orders`.`part_manufacturer_name_2` LEFT JOIN `parts` as parts5 ON `parts5`.`parts_id`=`purchase_orders`.`part_number_3` LEFT JOIN `manufacturer` as manufacturer4 ON `manufacturer4`.`manufacturer_id`=`purchase_orders`.`part_manufacturer_name_3` LEFT JOIN `parts` as parts6 ON `parts6`.`parts_id`=`purchase_orders`.`part_number_4` LEFT JOIN `manufacturer` as manufacturer5 ON `manufacturer5`.`manufacturer_id`=`purchase_orders`.`part_manufacturer_name_4` LEFT JOIN `parts` as parts7 ON `parts7`.`parts_id`=`purchase_orders`.`part_number_5` LEFT JOIN `manufacturer` as manufacturer6 ON `manufacturer6`.`manufacturer_id`=`purchase_orders`.`part_manufacturer_name_5` LEFT JOIN `parts` as parts8 ON `parts8`.`parts_id`=`purchase_orders`.`part_number_6` LEFT JOIN `parts` as parts9 ON `parts9`.`parts_id`=`purchase_orders`.`part_name_6` LEFT JOIN `manufacturer` as manufacturer7 ON `manufacturer7`.`manufacturer_id`=`purchase_orders`.`part_manufacturer_name_6` LEFT JOIN `parts` as parts10 ON `parts10`.`parts_id`=`purchase_orders`.`part_number_7` LEFT JOIN `parts` as parts11 ON `parts11`.`parts_id`=`purchase_orders`.`part_name_7` LEFT JOIN `manufacturer` as manufacturer8 ON `manufacturer8`.`manufacturer_id`=`purchase_orders`.`part_manufacturer_name_7` LEFT JOIN `parts` as parts12 ON `parts12`.`parts_id`=`purchase_orders`.`part_number_8` LEFT JOIN `parts` as parts13 ON `parts13`.`parts_id`=`purchase_orders`.`part_name_8` LEFT JOIN `manufacturer` as manufacturer9 ON `manufacturer9`.`manufacturer_id`=`purchase_orders`.`part_manufacturer_name_8` LEFT JOIN `service` as service1 ON `service1`.`service_id`=`purchase_orders`.`workshop_name` LEFT JOIN `service` as service2 ON `service2`.`service_id`=`purchase_orders`.`work_order_id` LEFT JOIN `reception` as reception1 ON `reception1`.`reception_user_id`=`purchase_orders`.`job_card_number` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register1`.`type_of_vehicle` ",
			'transmission' => "`transmission` ",
			'fuel_type' => "`fuel_type` ",
			'merchant' => "`merchant` LEFT JOIN `merchant_type` as merchant_type1 ON `merchant_type1`.`merchant_type_id`=`merchant`.`merchant_type` ",
			'merchant_type' => "`merchant_type` ",
			'manufacturer' => "`manufacturer` LEFT JOIN `manufacturer_type` as manufacturer_type1 ON `manufacturer_type1`.`manufacturer_type_id`=`manufacturer`.`manufacturer_type` ",
			'manufacturer_type' => "`manufacturer_type` ",
			'driver' => "`driver` ",
			'accidents' => "`accidents` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`accidents`.`vehicle_registration_number` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`accidents`.`closing_km` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`accidents`.`drivers_surname` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`accidents`.`district` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` ",
			'accident_type' => "`accident_type` ",
			'claim' => "`claim` LEFT JOIN `claim_status` as claim_status1 ON `claim_status1`.`claim_status_id`=`claim`.`claim_status` LEFT JOIN `claim_category` as claim_category1 ON `claim_category1`.`claim_category_id`=`claim`.`claim_category` LEFT JOIN `cost_centre` as cost_centre1 ON `cost_centre1`.`cost_centre_id`=`claim`.`cost_centre` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`claim`.`department_name` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`claim`.`district` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`claim`.`province` LEFT JOIN `merchant` as merchant1 ON `merchant1`.`merchant_id`=`claim`.`merchant_name` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`claim`.`vehicle_registration_number` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`claim`.`closing_km` ",
			'claim_status' => "`claim_status` ",
			'claim_category' => "`claim_category` ",
			'cost_centre' => "`cost_centre` ",
			'dealer' => "`dealer` LEFT JOIN `dealer_type` as dealer_type1 ON `dealer_type1`.`dealer_type_id`=`dealer`.`dealer_type` ",
			'dealer_type' => "`dealer_type` ",
			'tyre_log_sheet' => "`tyre_log_sheet` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`tyre_log_sheet`.`vehicle_registration_number` ",
			'vehicle_daily_check_list' => "`vehicle_daily_check_list` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`vehicle_daily_check_list`.`vehicle_registration_number` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`vehicle_daily_check_list`.`closing_km` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`vehicle_daily_check_list`.`drivers_surname` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` ",
			'auditor' => "`auditor` ",
			'parts' => "`parts` LEFT JOIN `parts_type` as parts_type1 ON `parts_type1`.`part_type_id`=`parts`.`part_type` LEFT JOIN `manufacturer` as manufacturer1 ON `manufacturer1`.`manufacturer_id`=`parts`.`manufacturer` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`parts`.`dealer` ",
			'parts_type' => "`parts_type` ",
			'breakdown_services' => "`breakdown_services` LEFT JOIN `reception` as reception1 ON `reception1`.`reception_user_id`=`breakdown_services`.`description_of_vehicle_breakdown_notes` LEFT JOIN `work_allocation` as work_allocation1 ON `work_allocation1`.`work_allocation_id`=`breakdown_services`.`work_allocation_reference_number` LEFT JOIN `reception` as reception2 ON `reception2`.`reception_user_id`=`breakdown_services`.`job_card_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`breakdown_services`.`vehicle_registration_number` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`breakdown_services`.`closing_km` LEFT JOIN `parts` as parts1 ON `parts1`.`parts_id`=`breakdown_services`.`part_number` LEFT JOIN `parts` as parts2 ON `parts2`.`parts_id`=`breakdown_services`.`part_name` LEFT JOIN `manufacturer` as manufacturer1 ON `manufacturer1`.`manufacturer_id`=`breakdown_services`.`part_manufacturer_name` LEFT JOIN `parts` as parts3 ON `parts3`.`parts_id`=`breakdown_services`.`part_number_1` LEFT JOIN `parts` as parts4 ON `parts4`.`parts_id`=`breakdown_services`.`part_name_1` LEFT JOIN `manufacturer` as manufacturer2 ON `manufacturer2`.`manufacturer_id`=`breakdown_services`.`part_manufacturer_name_1` LEFT JOIN `service` as service1 ON `service1`.`service_id`=`breakdown_services`.`workshop_name` ",
			'modification_to_vehicle' => "`modification_to_vehicle` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`modification_to_vehicle`.`type_of_vehicle` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`modification_to_vehicle`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`modification_to_vehicle`.`drivers_name_and_surname` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`modification_to_vehicle`.`vehicle_registration_number` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`modification_to_vehicle`.`closing_km` LEFT JOIN `service` as service1 ON `service1`.`service_id`=`modification_to_vehicle`.`job_card_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` ",
			'vehicle_handing_over_checklist' => "`vehicle_handing_over_checklist` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`vehicle_handing_over_checklist`.`vehicle_registration_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`log_sheet1`.`vehicle_registration_number` LEFT JOIN `claim` as claim1 ON `claim1`.`claim_id`=`vehicle_handing_over_checklist`.`authorization_number` LEFT JOIN `merchant` as merchant1 ON `merchant1`.`merchant_id`=`claim1`.`merchant_name` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`vehicle_handing_over_checklist`.`driver_name_and_surname` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register3 ON `gmt_fleet_register3`.`fleet_asset_id`=`log_sheet1`.`model_of_vehicle` ",
			'vehicle_return_check_list' => "`vehicle_return_check_list` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`vehicle_return_check_list`.`vehicle_registration_number` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`vehicle_return_check_list`.`closing_km` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`vehicle_return_check_list`.`driver_name_and_surname` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` ",
			'indicates_repair_damages_found_list' => "`indicates_repair_damages_found_list` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`indicates_repair_damages_found_list`.`driver_name_and_surname` ",
			'forms' => "`forms` ",
			'identification_of_defects' => "`identification_of_defects` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`identification_of_defects`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` ",
			'gate_security' => "`gate_security` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`gate_security`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register1`.`colour_of_vehicle` ",
			'reception' => "`reception` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`reception`.`district` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`reception`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` ",
			'inspection_bay' => "`inspection_bay` LEFT JOIN `reception` as reception1 ON `reception1`.`reception_user_id`=`inspection_bay`.`job_card_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`inspection_bay`.`vehicle_registration_number` LEFT JOIN `work_allocation` as work_allocation1 ON `work_allocation1`.`work_allocation_id`=`inspection_bay`.`work_allocation_reference_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` ",
			'work_allocation' => "`work_allocation` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`work_allocation`.`district` LEFT JOIN `cost_centre` as cost_centre1 ON `cost_centre1`.`cost_centre_id`=`work_allocation`.`cost_centre` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`work_allocation`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` ",
			'internal_repairs_mechanical' => "`internal_repairs_mechanical` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`internal_repairs_mechanical`.`workshop_name` LEFT JOIN `reception` as reception1 ON `reception1`.`reception_user_id`=`internal_repairs_mechanical`.`job_card_number` LEFT JOIN `work_allocation` as work_allocation1 ON `work_allocation1`.`work_allocation_id`=`internal_repairs_mechanical`.`work_allocation_reference_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`internal_repairs_mechanical`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`internal_repairs_mechanical`.`make_of_vehicle` LEFT JOIN `dealer_type` as dealer_type1 ON `dealer_type1`.`dealer_type_id`=`dealer1`.`dealer_type` LEFT JOIN `inspection_bay` as inspection_bay1 ON `inspection_bay1`.`inspection_bay_id`=`internal_repairs_mechanical`.`inspection_bay_lane_number` ",
			'external_repairs_mechanical' => "`external_repairs_mechanical` LEFT JOIN `service_provider` as service_provider1 ON `service_provider1`.`service_provider_id`=`external_repairs_mechanical`.`service_provider_name` LEFT JOIN `service_provider` as service_provider2 ON `service_provider2`.`service_provider_id`=`external_repairs_mechanical`.`service_provider_type` LEFT JOIN `service_provider_type` as service_provider_type1 ON `service_provider_type1`.`service_provider_type_id`=`service_provider2`.`service_provider_type` LEFT JOIN `service_provider` as service_provider3 ON `service_provider3`.`service_provider_id`=`external_repairs_mechanical`.`service_provider_contact_details` LEFT JOIN `service_provider` as service_provider4 ON `service_provider4`.`service_provider_id`=`external_repairs_mechanical`.`service_provider_address` LEFT JOIN `merchant` as merchant1 ON `merchant1`.`merchant_id`=`external_repairs_mechanical`.`merchant_type` LEFT JOIN `merchant_type` as merchant_type1 ON `merchant_type1`.`merchant_type_id`=`merchant1`.`merchant_type` LEFT JOIN `merchant` as merchant2 ON `merchant2`.`merchant_id`=`external_repairs_mechanical`.`merchant_code` LEFT JOIN `merchant` as merchant3 ON `merchant3`.`merchant_id`=`external_repairs_mechanical`.`merchant_name` LEFT JOIN `merchant` as merchant4 ON `merchant4`.`merchant_id`=`external_repairs_mechanical`.`merchant_contacts_details` LEFT JOIN `merchant` as merchant5 ON `merchant5`.`merchant_id`=`external_repairs_mechanical`.`merchant_email_address` LEFT JOIN `merchant` as merchant6 ON `merchant6`.`merchant_id`=`external_repairs_mechanical`.`merchant_address` LEFT JOIN `merchant` as merchant7 ON `merchant7`.`merchant_id`=`external_repairs_mechanical`.`merchant_address_code` LEFT JOIN `claim` as claim1 ON `claim1`.`claim_id`=`external_repairs_mechanical`.`authorization_number` LEFT JOIN `claim` as claim2 ON `claim2`.`claim_id`=`external_repairs_mechanical`.`instruction_note` LEFT JOIN `work_allocation` as work_allocation1 ON `work_allocation1`.`work_allocation_id`=`external_repairs_mechanical`.`work_allocation_reference_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`external_repairs_mechanical`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` ",
			'internal_repairs_body' => "`internal_repairs_body` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`internal_repairs_body`.`driver_name_and_surname` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`internal_repairs_body`.`vehicle_registration_number` LEFT JOIN `reception` as reception1 ON `reception1`.`reception_user_id`=`internal_repairs_body`.`job_card_number` LEFT JOIN `work_allocation` as work_allocation1 ON `work_allocation1`.`work_allocation_id`=`internal_repairs_body`.`work_allocation_reference_number` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`internal_repairs_body`.`government_garage_name` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` ",
			'external_repairs_body' => "`external_repairs_body` LEFT JOIN `service_provider` as service_provider1 ON `service_provider1`.`service_provider_id`=`external_repairs_body`.`service_provider_name` LEFT JOIN `service_provider` as service_provider2 ON `service_provider2`.`service_provider_id`=`external_repairs_body`.`service_provider_type` LEFT JOIN `service_provider_type` as service_provider_type1 ON `service_provider_type1`.`service_provider_type_id`=`service_provider2`.`service_provider_type` LEFT JOIN `service_provider` as service_provider3 ON `service_provider3`.`service_provider_id`=`external_repairs_body`.`service_provider_contact_details` LEFT JOIN `service_provider` as service_provider4 ON `service_provider4`.`service_provider_id`=`external_repairs_body`.`service_provider_address` LEFT JOIN `service_provider` as service_provider5 ON `service_provider5`.`service_provider_id`=`external_repairs_body`.`service_provider_branch` LEFT JOIN `service_provider` as service_provider6 ON `service_provider6`.`service_provider_id`=`external_repairs_body`.`service_provider_branch_code` LEFT JOIN `claim` as claim1 ON `claim1`.`claim_id`=`external_repairs_body`.`instruction_note` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`external_repairs_body`.`vehicle_registration_number` LEFT JOIN `merchant` as merchant1 ON `merchant1`.`merchant_id`=`external_repairs_body`.`merchant_type` LEFT JOIN `merchant_type` as merchant_type1 ON `merchant_type1`.`merchant_type_id`=`merchant1`.`merchant_type` LEFT JOIN `merchant` as merchant2 ON `merchant2`.`merchant_id`=`external_repairs_body`.`merchant_code` LEFT JOIN `merchant` as merchant3 ON `merchant3`.`merchant_id`=`external_repairs_body`.`merchant_name` LEFT JOIN `merchant` as merchant4 ON `merchant4`.`merchant_id`=`external_repairs_body`.`merchant_contacts_details` LEFT JOIN `merchant` as merchant5 ON `merchant5`.`merchant_id`=`external_repairs_body`.`merchant_address` LEFT JOIN `merchant` as merchant6 ON `merchant6`.`merchant_id`=`external_repairs_body`.`merchant_address_code` LEFT JOIN `merchant` as merchant7 ON `merchant7`.`merchant_id`=`external_repairs_body`.`merchant_city` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register1`.`colour_of_vehicle` ",
			'ordering_of_spares_for_internal_repairs' => "`ordering_of_spares_for_internal_repairs` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`ordering_of_spares_for_internal_repairs`.`workshop_name` LEFT JOIN `reception` as reception1 ON `reception1`.`reception_user_id`=`ordering_of_spares_for_internal_repairs`.`job_card_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`ordering_of_spares_for_internal_repairs`.`vehicle_registration_number` LEFT JOIN `parts_type` as parts_type1 ON `parts_type1`.`part_type_id`=`ordering_of_spares_for_internal_repairs`.`part_type_1` LEFT JOIN `parts` as parts1 ON `parts1`.`parts_id`=`ordering_of_spares_for_internal_repairs`.`part_name_1` LEFT JOIN `parts` as parts2 ON `parts2`.`parts_id`=`ordering_of_spares_for_internal_repairs`.`description_1` LEFT JOIN `parts` as parts3 ON `parts3`.`parts_id`=`ordering_of_spares_for_internal_repairs`.`manufacture_1` LEFT JOIN `manufacturer` as manufacturer1 ON `manufacturer1`.`manufacturer_id`=`parts3`.`manufacturer` LEFT JOIN `parts_type` as parts_type2 ON `parts_type2`.`part_type_id`=`ordering_of_spares_for_internal_repairs`.`part_type_2` LEFT JOIN `parts` as parts4 ON `parts4`.`parts_id`=`ordering_of_spares_for_internal_repairs`.`part_name_2` LEFT JOIN `parts` as parts5 ON `parts5`.`parts_id`=`ordering_of_spares_for_internal_repairs`.`description_2` LEFT JOIN `parts` as parts6 ON `parts6`.`parts_id`=`ordering_of_spares_for_internal_repairs`.`manufacture_2` LEFT JOIN `manufacturer` as manufacturer2 ON `manufacturer2`.`manufacturer_id`=`parts6`.`manufacturer` LEFT JOIN `parts_type` as parts_type3 ON `parts_type3`.`part_type_id`=`ordering_of_spares_for_internal_repairs`.`part_type_3` LEFT JOIN `parts` as parts7 ON `parts7`.`parts_id`=`ordering_of_spares_for_internal_repairs`.`part_name_3` LEFT JOIN `parts` as parts8 ON `parts8`.`parts_id`=`ordering_of_spares_for_internal_repairs`.`description_3` LEFT JOIN `parts` as parts9 ON `parts9`.`parts_id`=`ordering_of_spares_for_internal_repairs`.`manufacture_3` LEFT JOIN `manufacturer` as manufacturer3 ON `manufacturer3`.`manufacturer_id`=`parts9`.`manufacturer` LEFT JOIN `parts_type` as parts_type4 ON `parts_type4`.`part_type_id`=`ordering_of_spares_for_internal_repairs`.`part_type_4` LEFT JOIN `parts` as parts10 ON `parts10`.`parts_id`=`ordering_of_spares_for_internal_repairs`.`part_name_4` LEFT JOIN `parts` as parts11 ON `parts11`.`parts_id`=`ordering_of_spares_for_internal_repairs`.`description_4` LEFT JOIN `parts` as parts12 ON `parts12`.`parts_id`=`ordering_of_spares_for_internal_repairs`.`manufacture_4` LEFT JOIN `manufacturer` as manufacturer4 ON `manufacturer4`.`manufacturer_id`=`parts12`.`manufacturer` LEFT JOIN `parts_type` as parts_type5 ON `parts_type5`.`part_type_id`=`ordering_of_spares_for_internal_repairs`.`part_type_5` LEFT JOIN `parts` as parts13 ON `parts13`.`parts_id`=`ordering_of_spares_for_internal_repairs`.`part_name_5` LEFT JOIN `parts` as parts14 ON `parts14`.`parts_id`=`ordering_of_spares_for_internal_repairs`.`description_5` LEFT JOIN `parts` as parts15 ON `parts15`.`parts_id`=`ordering_of_spares_for_internal_repairs`.`manufacture_5` LEFT JOIN `manufacturer` as manufacturer5 ON `manufacturer5`.`manufacturer_id`=`parts15`.`manufacturer` LEFT JOIN `parts_type` as parts_type6 ON `parts_type6`.`part_type_id`=`ordering_of_spares_for_internal_repairs`.`part_type_6` LEFT JOIN `parts` as parts16 ON `parts16`.`parts_id`=`ordering_of_spares_for_internal_repairs`.`part_name_6` LEFT JOIN `parts` as parts17 ON `parts17`.`parts_id`=`ordering_of_spares_for_internal_repairs`.`description_6` LEFT JOIN `parts` as parts18 ON `parts18`.`parts_id`=`ordering_of_spares_for_internal_repairs`.`manufacture_6` LEFT JOIN `manufacturer` as manufacturer6 ON `manufacturer6`.`manufacturer_id`=`parts18`.`manufacturer` LEFT JOIN `parts_type` as parts_type7 ON `parts_type7`.`part_type_id`=`ordering_of_spares_for_internal_repairs`.`part_type_7` LEFT JOIN `parts` as parts19 ON `parts19`.`parts_id`=`ordering_of_spares_for_internal_repairs`.`part_name_7` LEFT JOIN `parts` as parts20 ON `parts20`.`parts_id`=`ordering_of_spares_for_internal_repairs`.`description_7` LEFT JOIN `parts` as parts21 ON `parts21`.`parts_id`=`ordering_of_spares_for_internal_repairs`.`manufacture_7` LEFT JOIN `manufacturer` as manufacturer7 ON `manufacturer7`.`manufacturer_id`=`parts21`.`manufacturer` LEFT JOIN `parts_type` as parts_type8 ON `parts_type8`.`part_type_id`=`ordering_of_spares_for_internal_repairs`.`part_type_8` LEFT JOIN `parts` as parts22 ON `parts22`.`parts_id`=`ordering_of_spares_for_internal_repairs`.`part_name_8` LEFT JOIN `parts` as parts23 ON `parts23`.`parts_id`=`ordering_of_spares_for_internal_repairs`.`description_8` LEFT JOIN `parts` as parts24 ON `parts24`.`parts_id`=`ordering_of_spares_for_internal_repairs`.`manufacture_8` LEFT JOIN `manufacturer` as manufacturer8 ON `manufacturer8`.`manufacturer_id`=`parts24`.`manufacturer` LEFT JOIN `work_allocation` as work_allocation1 ON `work_allocation1`.`work_allocation_id`=`ordering_of_spares_for_internal_repairs`.`work_allocation_reference_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` ",
			'collection_of_repaired_vehicles' => "`collection_of_repaired_vehicles` LEFT JOIN `reception` as reception1 ON `reception1`.`reception_user_id`=`collection_of_repaired_vehicles`.`reception_name_and_surname` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`collection_of_repaired_vehicles`.`driver_name_and_surname` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`collection_of_repaired_vehicles`.`government_garage_name` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`collection_of_repaired_vehicles`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` ",
			'withdrawal_vehicle_from_operation' => "`withdrawal_vehicle_from_operation` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`withdrawal_vehicle_from_operation`.`vehicle_registration_number` LEFT JOIN `service` as service1 ON `service1`.`service_id`=`withdrawal_vehicle_from_operation`.`date_of_service` LEFT JOIN `schedule` as schedule1 ON `schedule1`.`schedule_id`=`service1`.`date_of_service` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` ",
			'costing' => "`costing` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`costing`.`government_garage_name` LEFT JOIN `reception` as reception1 ON `reception1`.`reception_user_id`=`costing`.`job_card_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`costing`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` ",
			'billing' => "`billing` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`billing`.`district` LEFT JOIN `costing` as costing1 ON `costing1`.`costing_id`=`billing`.`job_card_number` LEFT JOIN `reception` as reception1 ON `reception1`.`reception_user_id`=`costing1`.`job_card_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`billing`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` ",
			'general_control_measures' => "`general_control_measures` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`general_control_measures`.`district` LEFT JOIN `cost_centre` as cost_centre1 ON `cost_centre1`.`cost_centre_id`=`general_control_measures`.`cost_centre` ",
			'movement_of_personnel_in_government_garage_and_workshops' => "`movement_of_personnel_in_government_garage_and_workshops` LEFT JOIN `movement_of_personnel_in_government_garage_and_workshops` as movement_of_personnel_in_government_garage_and_workshops1 ON `movement_of_personnel_in_government_garage_and_workshops1`.`movement_id`=`movement_of_personnel_in_government_garage_and_workshops`.`vehicle_inspection` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`movement_of_personnel_in_government_garage_and_workshops`.`make_of_vehicle` LEFT JOIN `dealer_type` as dealer_type1 ON `dealer_type1`.`dealer_type_id`=`dealer1`.`dealer_type` ",
			'service_provider' => "`service_provider` LEFT JOIN `service_provider_type` as service_provider_type1 ON `service_provider_type1`.`service_provider_type_id`=`service_provider`.`service_provider_type` ",
			'service_provider_type' => "`service_provider_type` ",
			'vehicle_annual_inspection' => "`vehicle_annual_inspection` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`vehicle_annual_inspection`.`vehicle_registration_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register2 ON `gmt_fleet_register2`.`fleet_asset_id`=`vehicle_annual_inspection`.`register_number` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`vehicle_annual_inspection`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`vehicle_annual_inspection`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`vehicle_annual_inspection`.`district` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register1`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register1`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register1`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register1`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register1`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register1`.`application_status` ",
		];

		$pkey = [
			'gmt_fleet_register' => 'fleet_asset_id',
			'log_sheet' => 'fuel_log_sheet_id',
			'vehicle_history' => 'history_id',
			'year_model' => 'year_model_id',
			'month' => 'month_id',
			'body_type' => 'body_type_id',
			'vehicle_colour' => 'vehicle_colour_id',
			'province' => 'province_id',
			'departments' => 'department_id',
			'districts' => 'district_id',
			'application_status' => 'application_id',
			'vehicle_payments' => 'vehicle_payment_id',
			'insurance_payments' => 'insurance_payment_id',
			'authorizations' => 'authorize_id',
			'service' => 'service_id',
			'service_type' => 'service_type_id',
			'schedule' => 'schedule_id',
			'service_records' => 'records_id',
			'service_categories' => 'service_categories_id',
			'service_item_type' => 'service_item_type_id',
			'service_item' => 'service_item_id',
			'purchase_orders' => 'purchase_order_id',
			'transmission' => 'transmission_id',
			'fuel_type' => 'fuel_type_id',
			'merchant' => 'merchant_id',
			'merchant_type' => 'merchant_type_id',
			'manufacturer' => 'manufacturer_id',
			'manufacturer_type' => 'manufacturer_type_id',
			'driver' => 'driver_id',
			'accidents' => 'accident_id',
			'accident_type' => 'accident_type_id',
			'claim' => 'claim_id',
			'claim_status' => 'claim_status_id',
			'claim_category' => 'claim_category_id',
			'cost_centre' => 'cost_centre_id',
			'dealer' => 'dealer_id',
			'dealer_type' => 'dealer_type_id',
			'tyre_log_sheet' => 'tyre_log_id',
			'vehicle_daily_check_list' => 'vehicle_daily_check_list_id',
			'auditor' => 'auditor_id',
			'parts' => 'parts_id',
			'parts_type' => 'part_type_id',
			'breakdown_services' => 'breakdown_id',
			'modification_to_vehicle' => 'modification_id',
			'vehicle_handing_over_checklist' => 'vehicle_handing_over_id',
			'vehicle_return_check_list' => 'vehicle_return_check_list_id',
			'indicates_repair_damages_found_list' => 'repair_damages_list_id',
			'forms' => 'forms_id',
			'identification_of_defects' => 'defects_id',
			'gate_security' => 'gate_security_user_id',
			'reception' => 'reception_user_id',
			'inspection_bay' => 'inspection_bay_id',
			'work_allocation' => 'work_allocation_id',
			'internal_repairs_mechanical' => 'internal_mechanical_id',
			'external_repairs_mechanical' => 'external_mechanical_id',
			'internal_repairs_body' => 'internal_repairs_body_id',
			'external_repairs_body' => 'external_repair_body_id',
			'ordering_of_spares_for_internal_repairs' => 'spares_id',
			'collection_of_repaired_vehicles' => 'collection_id',
			'withdrawal_vehicle_from_operation' => 'withdrawal_id',
			'costing' => 'costing_id',
			'billing' => 'billing_id',
			'general_control_measures' => 'general_control_measures_id',
			'movement_of_personnel_in_government_garage_and_workshops' => 'movement_id',
			'service_provider' => 'service_provider_id',
			'service_provider_type' => 'service_provider_type_id',
			'vehicle_annual_inspection' => 'fleet_asset_id',
		];

		if(!isset($sql_from[$table_name])) return false;

		$from = ($skip_joins ? "`{$table_name}`" : $sql_from[$table_name]);

		if($skip_permissions) return $from . ' WHERE 1=1';

		// mm: build the query based on current member's permissions
		// allowing lower permissions if $lower_permissions set to 'user' or 'group'
		$perm = getTablePermissions($table_name);
		if($perm['view'] == 1 || ($perm['view'] > 1 && $lower_permissions == 'user')) { // view owner only
			$from .= ", `membership_userrecords` WHERE `{$table_name}`.`{$pkey[$table_name]}`=`membership_userrecords`.`pkValue` AND `membership_userrecords`.`tableName`='{$table_name}' AND LCASE(`membership_userrecords`.`memberID`)='" . getLoggedMemberID() . "'";
		} elseif($perm['view'] == 2 || ($perm['view'] > 2 && $lower_permissions == 'group')) { // view group only
			$from .= ", `membership_userrecords` WHERE `{$table_name}`.`{$pkey[$table_name]}`=`membership_userrecords`.`pkValue` AND `membership_userrecords`.`tableName`='{$table_name}' AND `membership_userrecords`.`groupID`='" . getLoggedGroupID() . "'";
		} elseif($perm['view'] == 3) { // view all
			$from .= ' WHERE 1=1';
		} else { // view none
			return false;
		}

		return $from;
	}

	#########################################################

	function get_joined_record($table, $id, $skip_permissions = false) {
		$sql_fields = get_sql_fields($table);
		$sql_from = get_sql_from($table, $skip_permissions);

		if(!$sql_fields || !$sql_from) return false;

		$pk = getPKFieldName($table);
		if(!$pk) return false;

		$safe_id = makeSafe($id, false);
		$sql = "SELECT {$sql_fields} FROM {$sql_from} AND `{$table}`.`{$pk}`='{$safe_id}'";
		$eo = ['silentErrors' => true];
		$res = sql($sql, $eo);
		if($row = db_fetch_assoc($res)) return $row;

		return false;
	}

	#########################################################

	function get_defaults($table) {
		/* array of tables and their fields, with default values (or empty), excluding automatic values */
		$defaults = [
			'gmt_fleet_register' => [
				'fleet_asset_id' => '',
				'vehicle_registration_number' => '',
				'register_number' => '',
				'engine_number' => '',
				'chassis_number' => '',
				'dealer_name' => '',
				'make_of_vehicle' => '',
				'model_of_vehicle' => '',
				'year_model_specification' => '',
				'engine_capacity' => '',
				'tyre_size' => '',
				'transmission' => '',
				'fuel_type' => '',
				'type_of_vehicle' => '',
				'colour_of_vehicle' => '',
				'application_status' => '',
				'case_number' => 'CAS_',
				'barcode_number' => '',
				'purchase_price' => '',
				'depreciation_value' => '',
				'photo_of_vehicle' => '',
				'user_name_and_surname' => '',
				'user_contact_email' => '',
				'contact_number' => '',
				'department_name' => '',
				'department_address' => '',
				'province' => '',
				'district' => '',
				'drivers_name_and_surname' => '',
				'drivers_persal_number' => '',
				'department_name_of_driver' => '',
				'drivers_contact_details' => '',
				'documents' => '',
				'date_auctioned' => '0000-00-00',
				'venue' => '',
				'comments' => '',
				'renewal_of_license' => '',
				'mm_code' => '',
			],
			'log_sheet' => [
				'fuel_log_sheet_id' => '',
				'vehicle_registration_number' => '',
				'register_number' => '',
				'make_of_vehicle' => '',
				'model_of_vehicle' => '',
				'year_model_specification' => '',
				'colour_of_vehicle' => '',
				'engine_capacity' => '',
				'renewal_of_license' => '',
				'district' => '',
				'month' => '',
				'drivers_name_and_surname' => '',
				'drivers_persal_number' => '',
				'opening_km' => '',
				'total_trip_distance' => '',
				'closing_km' => '',
				'fuel_type' => '',
				'fuel_tank_capacity' => '0.00',
				'vendor' => '',
				'fuel_cost_litre' => '0.00',
				'refuel_quantity_1' => '0.00',
				'refuel_first_time_date' => '1',
				'trip_distance_refuel_1' => '',
				'refuel_quantity_2' => '0.00',
				'refuel_second_time_date' => '1',
				'trip_distance_refuel_2' => '',
				'refuel_quantity_3' => '0.00',
				'refuel_third_time_date' => '1',
				'trip_distance_refuel_3' => '',
				'refuel_quantity_4' => '0.00',
				'refuel_fourth_time_date' => '1',
				'trip_distance_refuel_4' => '',
				'refuel_quantity_5' => '0.00',
				'refuel_fifth_time_date' => '1',
				'trip_distance_refuel_5' => '',
				'refuel_quantity_6' => '0.00',
				'trip_distance_refuel_6' => '',
				'refuel_sixth_time_date' => '1',
				'times_refuel_current_month' => '',
				'total_fuel_quantity' => '0.00',
				'fuel_consumption' => '0.00',
				'fuel_total_cost' => '0.00',
				'payment_e_fuel_card' => '',
				'captured_by' => '',
				'comments' => '',
				'date_captured' => '',
				'complete_fill_up' => '',
			],
			'vehicle_history' => [
				'history_id' => '',
				'vehicle_registration_number' => '',
				'engine_number' => '',
				'purchased_price' => '',
				'old_registration_number' => '',
				'new_vehicle_registration_number' => '',
				'date_of_vehicle_transfer' => '',
				'comments' => '',
				'renewal_of_license' => '',
				'date_of_service' => '',
				'date_of_next_service' => '',
				'purchased_order_number' => '',
				'claim_code' => '',
				'tyre_inspection_report' => '',
				'inspection_certification_number' => '',
				'document_checklist_report' => '',
				'next_inspection_date' => '1',
				'breakdown_of_vehicle' => '',
				'date_of_vehicle_breakdown' => '',
				'description_of_vehicle_breakdown' => '',
				'closing_km' => '',
				'date_of_vehicle_reactivation' => '',
				'total_cost' => '0.00',
			],
			'year_model' => [
				'year_model_id' => '',
				'year_model_specification' => '',
			],
			'month' => [
				'month_id' => '',
				'month' => '',
			],
			'body_type' => [
				'body_type_id' => '',
				'type_of_vehicle' => '',
			],
			'vehicle_colour' => [
				'vehicle_colour_id' => '',
				'colour_of_vehicle' => '',
			],
			'province' => [
				'province_id' => '',
				'province' => '',
			],
			'departments' => [
				'department_id' => '',
				'department_name' => '',
			],
			'districts' => [
				'district_id' => '',
				'district' => '',
				'station' => '',
			],
			'application_status' => [
				'application_id' => '',
				'application_status' => '',
			],
			'vehicle_payments' => [
				'vehicle_payment_id' => '',
				'vehicle_registration_number' => '',
				'engine_number' => '',
				'chassis_number' => '',
				'make_of_vehicle' => '',
				'model_of_vehicle' => '',
				'year_model_of_vehicle' => '',
				'type_of_vehicle' => '',
				'application_status' => '',
				'barcode_number' => '',
				'purchase_price' => '',
				'depreciation_value' => '',
				'closing_km' => '',
				'department' => '',
				'acquisition_reference' => '',
				'date_of_acquisition' => '',
				'odometer_at_acquisition' => '',
				'merchant_name' => '',
				'value_at_acquisition' => '',
				'term' => '',
				'month_end' => '',
				'installment_per_month' => '',
				'payment_amount' => '',
				'payment_frequency' => '',
				'interest_rate' => '',
				'payment_reference' => '',
				'paid_so_far' => '',
				'remaining_balance' => '',
				'depreciation_since_purchase' => '',
				'actual_resale_value' => '',
				'warranty_expires_on' => '',
				'comments' => '',
				'documents' => '',
			],
			'insurance_payments' => [
				'insurance_payment_id' => '',
				'vehicle_registration_number' => '',
				'engine_number' => '',
				'chassis_number' => '',
				'make_of_vehicle' => '',
				'model_of_vehicle' => '',
				'year_model_of_vehicle' => '',
				'type_of_vehicle' => '',
				'application_status' => '',
				'barcode_number' => '',
				'department' => '',
				'insurance_reference' => '',
				'insurance_expiration' => '',
				'transaction_date' => '1',
				'reference_number' => '',
				'merchant_name' => '',
				'payment_amount' => '',
				'month_end' => '',
				'documents' => '',
				'comments' => '',
			],
			'authorizations' => [
				'authorize_id' => '',
				'job_code' => '',
				'job_status' => '',
				'job_status_date' => '0000-00-00',
				'job_status_age' => '',
				'job_age' => '',
				'job_category' => '',
				'job_odometer' => '',
				'instruction_note' => '',
				'pre_authorisation_date' => '1',
				'authorisation_date' => '0000-00-00',
				'vehicle_registration_number' => '',
				'make_of_vehicle' => '',
				'client' => '',
				'province_name' => '',
				'merchant_code' => '',
				'merchant_name' => '',
				'merchant_contact_email' => '',
				'merchant_street_address' => '',
				'merchant_suburb' => '',
				'merchant_city' => '',
				'merchant_address_code' => '',
				'merchant_contact_details' => '',
				'total_claim' => '',
				'total_authorised' => '',
				'authorization_number' => '',
				'last_fuel_transaction_date' => '0000-00-00',
				'external_repairs' => '',
			],
			'service' => [
				'service_id' => '',
				'breakdown_of_vehicle' => '',
				'service_title' => '',
				'service_item_type' => '',
				'service_category' => '',
				'merchant_name' => '',
				'vehicle_registration_number' => '',
				'engine_number' => '',
				'chassis_number' => '',
				'dealer_name' => '',
				'make_of_vehicle' => '',
				'model_of_vehicle' => '',
				'year_model_of_vehicle' => '',
				'type_of_vehicle' => '',
				'closing_km' => '',
				'application_status' => '',
				'work_allocation_reference_number' => '',
				'barcode_number' => '',
				'department' => '',
				'service_item' => '',
				'date_of_service' => '',
				'time' => '12:00:00',
				'upload_quotation' => '',
				'date_of_next_service' => '',
				'repeat_service_schedule_every_km' => '',
				'comments' => '',
				'upload_invoice' => '',
				'receptionist' => '',
				'receptionist_contact_email' => '',
				'workshop_name' => '',
				'workshop_address' => '',
				'technician' => '',
				'work_order_status' => '',
				'job_card_number' => '',
				'completion_date' => '1',
				'due_date' => '1',
				'filed' => '',
				'last_modified' => '',
			],
			'service_type' => [
				'service_type_id' => '',
				'service' => '',
				'type_of_service' => '',
				'reference' => '',
				'service_item_type' => '',
				'service_category' => '',
				'service_item' => '',
				'frequency_time_number' => '',
				'frequency_time' => '',
				'frequency_odometer' => '',
			],
			'schedule' => [
				'schedule_id' => '',
				'title' => '',
				'user_name_and_surname' => '',
				'user_contact_email' => '',
				'service_item_type' => '',
				'service_item_type_code' => '',
				'application_status' => '',
				'vehicle_registration_number' => '',
				'engine_number' => '',
				'closing_km' => '',
				'date' => '',
				'time' => '12:00:00',
				'workshop_name' => '',
				'diagnosis' => '',
				'prescription' => '',
				'comments' => '',
			],
			'service_records' => [
				'records_id' => '',
				'vehicle' => '',
				'image_1' => '',
				'image_2' => '',
				'image_3' => '',
				'image_4' => '',
				'image_5' => '',
				'document_1' => '',
				'document_2' => '',
				'document_3' => '',
				'document_4' => '',
				'document_5' => '',
				'description' => '',
			],
			'service_categories' => [
				'service_categories_id' => '',
				'service_category' => '',
			],
			'service_item_type' => [
				'service_item_type_id' => '',
				'service_item_type' => '',
				'service_item_type_code' => '',
			],
			'service_item' => [
				'service_item_id' => '',
				'service_item' => '',
			],
			'purchase_orders' => [
				'purchase_order_id' => '',
				'purchased_order_number' => '',
				'purchased_date' => '1',
				'purchaser' => '',
				'vehicle_registration_number' => '',
				'type_of_vehicle' => '',
				'manufacturer' => '',
				'service_type' => '',
				'service_category' => '',
				'service_item' => '',
				'upload_quotation' => '',
				'due_date' => '1',
				'merchant_name' => '',
				'date_of_service' => '',
				'closing_km' => '',
				'labour_category_1' => '',
				'part_number_1' => '',
				'part_name_1' => '',
				'part_manufacturer_name_1' => '',
				'quantity_1' => '',
				'expense_of_item_1' => '0.00',
				'labour_category_2' => '',
				'part_number_2' => '',
				'part_name_2' => '',
				'part_manufacturer_name_2' => '',
				'quantity_2' => '',
				'expense_of_item_2' => '0.00',
				'labour_category_3' => '',
				'part_number_3' => '',
				'part_name_3' => '',
				'part_manufacturer_name_3' => '',
				'quantity_3' => '',
				'expense_of_item_3' => '0.00',
				'labour_category_4' => '',
				'part_number_4' => '',
				'part_name_4' => '',
				'part_manufacturer_name_4' => '',
				'quantity_4' => '',
				'expense_of_item_4' => '0.00',
				'labour_category_5' => '',
				'part_number_5' => '',
				'part_name_5' => '',
				'part_manufacturer_name_5' => '',
				'quantity_5' => '',
				'expense_of_item_5' => '0.00',
				'labour_category_6' => '',
				'part_number_6' => '',
				'part_name_6' => '',
				'part_manufacturer_name_6' => '',
				'quantity_6' => '',
				'expense_of_item_6' => '0.00',
				'labour_category_7' => '',
				'part_number_7' => '',
				'part_name_7' => '',
				'part_manufacturer_name_7' => '',
				'quantity_7' => '',
				'expense_of_item_7' => '0.00',
				'labour_category_8' => '',
				'part_number_8' => '',
				'part_name_8' => '',
				'part_manufacturer_name_8' => '',
				'expense_of_item_8' => '0.00',
				'material_cost' => '0.00',
				'average_worktime_hrs' => '',
				'standard_labour_cost_per_hour' => '0.00',
				'labour_charges' => '',
				'vat' => '0.15',
				'total_amount' => '',
				'workshop_name' => '',
				'work_order_id' => '',
				'job_card_number' => '',
				'completion_date' => '1',
				'comments' => '',
				'upload_invoice' => '',
				'date_captured' => '',
				'data_capturer' => '',
				'data_capturer_contact_email' => '',
			],
			'transmission' => [
				'transmission_id' => '',
				'transmission' => '',
			],
			'fuel_type' => [
				'fuel_type_id' => '',
				'fuel_type' => '',
			],
			'merchant' => [
				'merchant_id' => '',
				'merchant_type' => '',
				'merchant_code' => '',
				'merchant_name' => '',
				'merchant_contact_email' => '',
				'merchant_street_address' => '',
				'merchant_suburb' => '',
				'merchant_city' => '',
				'merchant_address_code' => '',
				'merchant_contact_details' => '',
			],
			'merchant_type' => [
				'merchant_type_id' => '',
				'merchant_type' => '',
			],
			'manufacturer' => [
				'manufacturer_id' => '',
				'manufacturer_type' => '',
				'manufacturer_name' => '',
				'contact_person' => '',
				'contact_details' => '',
				'contact_email' => '',
			],
			'manufacturer_type' => [
				'manufacturer_type_id' => '',
				'manufacturer_type' => '',
			],
			'driver' => [
				'driver_id' => '',
				'drivers_name_and_surname' => '',
				'drivers_persal_number' => '',
				'drivers_contact_details' => '',
				'drivers_email_address' => '',
				'drivers_license' => '',
				'drivers_license_code' => '',
				'drivers_license_number' => '',
				'drivers_license_upload' => '',
				'drivers_license_expire_date' => '1',
				'drivers_license_renewal_date' => '1',
				'drivers_log_history' => '',
				'drivers_license_penalties' => '',
				'drivers_license_penalties_date' => '1',
				'drivers_license_penalty_details' => '',
				'drivers_license_penalty_details_uploads' => '',
				'involved_in_accident' => '',
				'accident_report' => '',
			],
			'accidents' => [
				'accident_id' => '',
				'vehicle_registration_number' => '',
				'closing_km' => '',
				'drivers_surname' => '',
				'drivers_contact_details' => '',
				'dealer_name' => '',
				'model_of_vehicle' => '',
				'date_of_accident' => '',
				'z181_accident_form' => '',
				'z181_accident_form_uploaded' => '',
				'copy_of_trip_authority' => '',
				'district' => '',
				'location' => '',
				'road_or_street' => '',
				'coordinates' => '',
				'deaths' => '',
				'fatal_amount' => '',
				'injured' => '',
				'injured_amount' => '',
				'description_of_accident' => '',
				'insured' => '',
				'upload_photos_damaged_vehicle' => '',
				'copy_of_sketch_plan' => '',
				'accident_report_driver' => '',
				'accident_report_supervisior' => '',
				'claims_report_accident_committee' => '',
				'insurance_claims_report' => '',
				'amount_paid' => '',
				'police_officer' => '',
				'contact_details' => '',
				'case_number' => 'CAS_',
				'police_report' => '',
				'accident_report_number' => '',
			],
			'accident_type' => [
				'accident_type_id' => '',
				'accident_type' => '',
			],
			'claim' => [
				'claim_id' => '',
				'claim_code' => '',
				'claim_status' => '',
				'claim_category' => '',
				'cost_centre' => '',
				'client_identification' => '',
				'department_name' => '',
				'district' => '',
				'province' => '',
				'merchant_name' => '',
				'vehicle_registration_number' => '',
				'model' => '',
				'closing_km' => '',
				'pre_authorization_date' => '0000-00-00',
				'instruction_note' => '',
				'invoice_date' => '0000-00-00',
				'upload_invoice' => '',
				'payment_date' => '0000-00-00',
				'authorization_number' => '',
				'clearance_number' => '',
				'vehicle_collected_date' => '0000-00-00',
				'total_claimed' => '0.00',
				'total_authorized' => '0.00',
			],
			'claim_status' => [
				'claim_status_id' => '',
				'claim_status' => '',
			],
			'claim_category' => [
				'claim_category_id' => '',
				'claim_category' => '',
			],
			'cost_centre' => [
				'cost_centre_id' => '',
				'cost_centre' => '',
			],
			'dealer' => [
				'dealer_id' => '',
				'dealer_type' => '',
				'make_of_vehicle' => '',
				'dealer_name' => '',
				'contact_person' => '',
				'contact_details' => '',
				'contact_email' => '',
			],
			'dealer_type' => [
				'dealer_type_id' => '',
				'dealer_type' => '',
			],
			'tyre_log_sheet' => [
				'tyre_log_id' => '',
				'vehicle_registration_number' => '',
				'tyre_position' => '',
				'tyre_tread_condition' => '',
				'tyre_brand' => '',
				'tyre_model' => '',
				'tyre_size' => '',
				'tyre_pressure' => '',
				'action' => '',
				'warranty' => '',
				'documents' => '',
				'tyre_tread' => '',
				'tyre_maximum_wear' => '',
				'inspection_date' => '0000-00-00',
				'tyre_inspection_done_by' => '',
				'tyre_inspection_report' => '',
				'status' => '',
				'opening_km' => '',
				'closing_km' => '',
				'total_km' => '',
				'comments' => '',
				'tyres_cause_of_accident' => '',
				'accident_report' => '',
				'claims_report' => '',
				'insurance_claims_report' => '',
				'reminder_maximum_wear' => '',
			],
			'vehicle_daily_check_list' => [
				'vehicle_daily_check_list_id' => '',
				'inspection_certification_number' => '',
				'vehicle_registration_number' => '',
				'make_of_vehicle' => '',
				'closing_km' => '',
				'dashboard' => '',
				'seats' => '',
				'carpets' => '',
				'wipers' => '',
				'head_lights' => '',
				'tail_lights' => '',
				'brake_lights' => '',
				'indicators' => '',
				'windscreen' => '',
				'windows' => '',
				'mirrors' => '',
				'wheels' => '',
				'hubcaps' => '',
				'sparewheel' => '',
				'tools' => '',
				'engine_oil' => '',
				'power_steering_oil' => '',
				'gearbox_oil' => '',
				'coolant' => '',
				'brake_oil' => '',
				'battery' => '',
				'brakes_front' => '',
				'brakes_rear' => '',
				'fuel_level' => '',
				'vehicle_fluid_leaks' => '',
				'note' => '',
				'document_checklist_report' => '',
				'next_inspection_date' => '1',
				'drivers_surname' => '',
				'drivers_persal_number' => '',
			],
			'auditor' => [
				'auditor_id' => '',
				'res_id' => '',
				'username' => '',
				'ipaddr' => '',
				'time_stmp' => '',
				'change_type' => '',
				'table_name' => '',
				'fieldName' => '',
				'OldValue' => '',
				'NewValue' => '',
			],
			'parts' => [
				'parts_id' => '',
				'part_type' => '',
				'part_number' => '',
				'part_name' => '',
				'description' => '',
				'manufacturer' => '',
				'dealer' => '',
				'measure' => '',
				'unit_price' => '0.00',
				'quantity' => '',
				'freight' => '',
				'amount' => '0.00',
				'tax' => '',
				'total_amount' => '0.00',
				'discount_price' => '0.00',
				'net_part_price' => '0.00',
			],
			'parts_type' => [
				'part_type_id' => '',
				'part_type' => '',
			],
			'breakdown_services' => [
				'breakdown_id' => '',
				'breakdown_of_vehicle' => '',
				'breakdown_during_office_hours' => '',
				'breakdown_within_or_outside_the_province' => '',
				'description_of_vehicle_breakdown_notes' => '',
				'description_of_vehicle_breakdown' => '',
				'date_of_vehicle_breakdown' => '',
				'work_allocation_reference_number' => '',
				'job_card_number' => '',
				'vehicle_registration_number' => '',
				'engine_number' => '',
				'closing_km' => '',
				'date_of_vehicle_reactivation' => '',
				'type_of_expenditure' => '',
				'labour_category' => '',
				'part_number' => '',
				'part_name' => '',
				'part_manufacturer_name' => '',
				'quantity' => '',
				'expense_of_item' => '0.00',
				'labour_category_1' => '',
				'part_number_1' => '',
				'part_name_1' => '',
				'part_manufacturer_name_1' => '',
				'quantity_1' => '',
				'expense_of_item_1' => '0.00',
				'material_cost' => '0.00',
				'average_worktime_hrs' => '',
				'standard_labour_cost_per_hour' => '0.00',
				'labour_charges' => '',
				'vat' => '0.15',
				'total_amount' => '',
				'workshop_name' => '',
				'work_order_status' => '',
				'comments' => '',
				'upload_invoice' => '',
				'receptionist' => '',
				'receptionist_contact_email' => '',
				'date_captured' => '',
			],
			'modification_to_vehicle' => [
				'modification_id' => '',
				'type_of_vehicle' => '',
				'directorate' => '',
				'head_office' => '',
				'district' => '',
				'location' => '',
				'drivers_name_and_surname' => '',
				'drivers_persal_number' => '',
				'drivers_contact_details' => '',
				'driver_rank' => '',
				'driver_signature' => '',
				'vehicle_registration_number' => '',
				'make_of_vehicle' => '',
				'model_of_vehicle' => '',
				'closing_km' => '',
				'job_card_number' => '',
				'objective' => '',
				'fuel_gauge_amount' => '',
				'keys_ignition' => '',
				'petrol_cap_with_keys' => '',
				'padlock_with_keys' => '',
				'tyre_r_f' => '',
				'tyre_r_f_1' => '',
				'tyre_r_r' => '',
				'tyre_r_r_1' => '',
				'tyre_l_f' => '',
				'tyre_l_f_1' => '',
				'tyer_l_r' => '',
				'tyer_l_r_1' => '',
				'tyre_spare' => '',
				'tyre_spare_1' => '',
				'wheel_cups' => '',
				'other' => '',
				'battery' => '',
				'battery_voltage' => '',
				'wheel_spanner' => '',
				'jack_with_handle' => '',
				'radio_dvd_combination' => '',
				'petrol_card' => '',
				'valid_license_disc' => '',
				'valid_license_disc_date' => '1',
				'fire_extinguisher' => '',
				'warning_signs_traingle' => '',
				'date_checked_in' => '2020-01-01 00:00:00',
				'testing_officer_name_and_surname' => '',
				'testing_officer_persal_number' => '',
				'testing_officer_rank' => '',
				'testing_officer_signature' => '',
				'date_received' => '2020-01-01 00:00:00',
				'supervisor_for_allocation_name_and_surname' => '',
				'supervisor_for_allocation_persal_number' => '',
				'supervisor_for_allocation_rank' => '',
				'supervisor_for_allocation_signature' => '',
			],
			'vehicle_handing_over_checklist' => [
				'vehicle_handing_over_id' => '',
				'company_name' => '',
				'company_address' => '',
				'company_contact_details' => '',
				'reason_for_handling_over' => '',
				'name_of_department' => '',
				'name_of_component' => '',
				'transport_officer_name_and_surname' => '',
				'transport_officer_email' => '',
				'job_pre_authorization_number' => '',
				'vehicle_registration_number' => '',
				'closing_km' => '',
				'make_of_vehicle' => '',
				'model_of_vehicle' => '',
				'authorization_number' => '',
				'authorization_date' => '0000-00-00',
				'radio_dvd_combination' => '',
				'number_of_keys_handling_over' => '',
				'jack_with_handle' => '',
				'tyre_spare' => '',
				'tyre_spare_condition' => '',
				'wheel_spanner' => '',
				'wheel_cups' => '',
				'tri_angles' => '',
				'mats' => '',
				'other' => '',
				'number_of_keys' => '',
				'tyre_r_f' => '',
				'tyre_r_f_1' => '',
				'tyre_r_f_1_1' => '',
				'tyre_r_r' => '',
				'tyre_r_r_1' => '',
				'tyre_r_r_1_1' => '',
				'tyre_l_f' => '',
				'tyre_l_f_1' => '',
				'tyre_l_f_1_1' => '',
				'tyer_l_r' => '',
				'tyer_l_r_1' => '',
				'tyre_l_r_1_1' => '',
				'driver_name_and_surname' => '',
				'driver_persal_number' => '',
				'driver_signature' => '',
				'date_checked_in' => '2020-01-01 00:00:00',
				'testing_officer_name_and_surname' => '',
				'testing_officer_signature' => '',
				'fuel_gauge_amount' => '',
				'vehicle_marks_1' => '',
				'vehicle_marks_2' => '',
				'vehicle_marks_3' => '',
				'vehicle_marks_4' => '',
				'vehicle_marks_5' => '',
				'vehicle_marks_6' => '',
				'vehicle_marks_7' => '',
				'vehicle_marks_8' => '',
				'remarks' => '',
				'vehicle_handing_over_ckecklist' => '',
			],
			'vehicle_return_check_list' => [
				'vehicle_return_check_list_id' => '',
				'vehicle_return_date' => '0000-00-00',
				'job_card_number' => '',
				'vehicle_registration_number' => '',
				'make_of_vehicle' => '',
				'model_of_vehicle' => '',
				'closing_km' => '',
				'radio_dvd_combination' => '',
				'number_of_keys_handling_over' => '',
				'jack_with_handle' => '',
				'tyre_spare' => '',
				'tyre_spare_condition' => '',
				'wheel_spanner' => '',
				'wheel_cups' => '',
				'tri_angles' => '',
				'other' => '',
				'number_of_keys' => '',
				'vehicle_washed' => '',
				'tyre_r_f' => '',
				'tyre_r_f_1' => '',
				'tyre_r_f_1_1' => '',
				'tyre_r_r' => '',
				'tyre_r_r_1' => '',
				'tyre_r_r_1_1' => '',
				'tyre_l_f' => '',
				'tyre_l_f_1' => '',
				'tyre_l_f_1_1' => '',
				'tyer_l_r' => '',
				'tyer_l_r_1' => '',
				'tyre_l_r_1_1' => '',
				'fuel_gauge_amount' => '',
				'driver_name_and_surname' => '',
				'driver_persal_number' => '',
				'driver_signature' => '',
				'vehicle_return_date_signed' => '2020-01-01 00:00:00',
				'testing_officer_name_and_surname' => '',
				'testing_officer_signature' => '',
				'vehicle_marks_1' => '',
				'vehicle_marks_2' => '',
				'vehicle_marks_3' => '',
				'vehicle_marks_4' => '',
				'vehicle_marks_5' => '',
				'vehicle_marks_6' => '',
				'vehicle_marks_7' => '',
				'vehicle_marks_8' => '',
				'remarks' => '',
				'vehicle_return_list' => '',
			],
			'indicates_repair_damages_found_list' => [
				'repair_damages_list_id' => '',
				'brought_in_for_repairs' => '',
				'after_repairs' => '',
				'driver_name_and_surname' => '',
				'driver_persal_number' => '',
				'driver_signature' => '',
				'vehicle_return_date_signed' => '2020-01-01 00:00:00',
				'company_name_and_surname' => '',
				'company_repesentative_signature' => '',
				'vehicle_return_date_signed_by_representative' => '2020-01-01 00:00:00',
				'indicates_and_list_details_of_damages_deficiencies' => '',
			],
			'forms' => [
				'forms_id' => '',
				'government_motor_transport_handbook' => '',
				'approved_workshop_procedure_manual' => '',
				'vehicle_daily_check_list_and_appraisal_report' => '',
				'z181_report_on_accident' => '',
				'vehicle_handing_over_ckecklist' => '',
				'vehicle_return_list' => '',
				'indicates_and_list_details_of_damages_deficiencies' => '',
			],
			'identification_of_defects' => [
				'defects_id' => '',
				'vehicle_registration_number' => '',
				'engine_number' => '',
				'make_of_vehicle' => '',
				'end_user_name_and_surname' => '',
				'end_user_contact_details' => '',
				'end_user_persal_number' => '',
				'end_user_email_address' => '',
				'end_user_signature' => '',
				'types_of_defects' => '',
				'courses_of_defects' => '',
				'condition_of_defects' => '',
				'transport_officer_name_and_surname' => '',
				'transport_officer_persal_number' => '',
				'transport_officer_contact_details' => '',
				'transport_officer_email_address' => '',
				'government_garage_manager_name_and_surname' => '',
				'government_garage_manager_contact_details' => '',
				'government_garage_manager_address' => '',
				'government_garage_manager_email_address' => '',
				'government_garage_manager_signature' => '',
			],
			'gate_security' => [
				'gate_security_user_id' => '',
				'gate_security_name_and_surname' => '',
				'gate_security_contact_details' => '',
				'gate_security_signature' => '',
				'date_of_vehicle_entrance' => '',
				'vehicle_registration_number' => '',
				'engine_number' => '',
				'make_of_vehicle' => '',
				'vehicle_colour' => '',
				'vehicle_inspection' => '',
				'vehicle_tires_size' => '',
				'vehicle_tires_check' => '',
				'vehicle_mirrow_check' => '',
				'vehicle_interiour_condition' => '',
				'vehicle_exteriour_condition' => '',
				'gate_security_company_name' => '',
				'gate_security_company_contact_details' => '',
				'gate_security_manager_name_and_surname' => '',
				'gate_security_manager_contact_details' => '',
				'gate_security_company_address' => '',
				'inspection_of_vehicle_report' => '',
				'record_of_vehicle' => '',
				'date_of_vehicle_exit' => '',
			],
			'reception' => [
				'reception_user_id' => '',
				'reception_name_and_surname' => '',
				'reception_persal_number' => '',
				'reception_contact_details' => '',
				'reception_email_address' => '',
				'reception_signature' => '',
				'date_of_vehicle_entrance' => '',
				'service_status' => '',
				'district' => '',
				'location' => '',
				'workshop_address' => '',
				'vehicle_registration_number' => '',
				'engine_number' => '',
				'make_of_vehicle' => '',
				'breakdown_of_vehicle' => '',
				'description_of_vehicle_breakdown_notes' => '',
				'description_of_vehicle_report' => '',
				'upload_of_vehicle_report' => '',
				'description_of_vehicle_breakdown' => '',
				'job_card_number' => '',
				'visual_inspection_form' => '',
				'damage_report' => '',
				'date_of_vehicle_exit' => '',
				'payment' => '',
			],
			'inspection_bay' => [
				'inspection_bay_id' => '',
				'inspection_bay_supervisor_name_and_surname' => '',
				'supervisor_contact_details' => '',
				'supervisor_email_address' => '',
				'supervisor_signature' => '',
				'date_of_vehicle_entrance' => '',
				'job_card_number' => '',
				'vehicle_registration_number' => '',
				'engine_number' => '',
				'workshop_name' => '',
				'work_allocation_reference_number' => '',
				'make_of_vehicle' => '',
				'inspection_bay_lane_number' => '',
				'inspection_bay_condition' => '',
				'allocation_feedback' => '',
				'verification_of_defects' => '',
				'additional_defects' => '',
				'additional_defects_record' => '',
				'repair_requirement_note' => '',
				'repair_requirement_report' => '',
				'date_of_vehicle_exit' => '',
			],
			'work_allocation' => [
				'work_allocation_id' => '',
				'district' => '',
				'location' => '',
				'cost_centre' => '',
				'supervisor_name_and_surname' => '',
				'supervisor_contact_details' => '',
				'supervisor_email_address' => '',
				'supervisor_signature' => '',
				'economical_repair' => '',
				'uneconomical_repair' => '',
				'work_allocation_reference_number' => '',
				'vehicle_registration_number' => '',
				'engine_number' => '',
				'make_of_vehicle' => '',
				'date_captured' => '',
			],
			'internal_repairs_mechanical' => [
				'internal_mechanical_id' => '',
				'workshop_name' => '',
				'artisan_name_and_surname' => '',
				'artisan_contacts' => '',
				'artisan_email_address' => '',
				'artisan_signature' => '',
				'artisan_note_of_starting_time' => '',
				'job_card_number' => '',
				'work_allocation_reference_number' => '',
				'vehicle_registration_number' => '',
				'engine_number' => '',
				'make_of_vehicle' => '',
				'pre_repair_inspections' => '',
				'artisan_dismantling_solution' => '',
				'spares_order_quotation' => '',
				'spares_order_description' => '',
				'artisan_note_of_completion_time' => '',
				'inspection_bay_lane_number' => '',
				'inspection_bay_report' => '',
				'total_labour_time' => '',
			],
			'external_repairs_mechanical' => [
				'external_mechanical_id' => '',
				'department_inspector_name_and_surname' => '',
				'department_inspector_persal_number' => '',
				'department_authorization_quote_note' => '',
				'department_inspector_signature' => '',
				'inspection_approval_repair_note' => '',
				'department_authorization_quote' => '',
				'service_provider_name' => '',
				'service_provider_type' => '',
				'service_provider_contact_details' => '',
				'service_provider_address' => '',
				'service_provider_signature' => '',
				'service_provider_repair_quote_upload' => '',
				'service_provider_repair_quote' => '',
				'repair_requirement_note' => '',
				'merchant_type' => '',
				'merchant_code' => '',
				'merchant_name' => '',
				'merchant_contacts_details' => '',
				'merchant_email_address' => '',
				'merchant_signature' => '',
				'merchant_address' => '',
				'merchant_address_code' => '',
				'date_of_vehicle_send' => '',
				'authorization_number' => '',
				'instruction_note' => '',
				'work_allocation_reference_number' => '',
				'vehicle_registration_number' => '',
				'engine_number' => '',
				'make_of_vehicle' => '',
				'date_of_vehicle_received' => '',
				'mechanical_repair_progress_monitor' => '',
				'mechanical_repair_progress_monitor_quality_of_work_manship' => '',
				'vehicle_inspection_report' => '',
				'upload_invoice' => '',
			],
			'internal_repairs_body' => [
				'internal_repairs_body_id' => '',
				'driver_name_and_surname' => '',
				'driver_persal_number' => '',
				'driver_contacts_details' => '',
				'driver_email_address' => '',
				'driver_license_code' => '',
				'driver_license_number' => '',
				'driver_license_upload' => '',
				'driver_signature' => '',
				'vehicle_registration_number' => '',
				'engine_number' => '',
				'make_of_vehicle' => '',
				'z181_accident_form' => '',
				'z181_accident_form_uploaded' => '',
				'job_card_number' => '',
				'work_allocation_reference_number' => '',
				'artisan_note_of_starting_time' => '',
				'government_garage_name' => '',
				'government_garage_contact_details' => '',
				'government_garage_address' => '',
				'government_garage_email_address' => '',
				'damages_occured' => '',
				'upload_of_internal_damages_1' => '',
				'upload_of_internal_damages_2' => '',
				'upload_of_internal_damages_3' => '',
				'upload_of_internal_damages_4' => '',
				'head_panel_beating_quotation' => '',
				'head_panel_beating_quotation_1' => '',
				'head_panel_beating_name' => '',
				'head_panel_beating_contact_details' => '',
				'head_panel_beating_address' => '',
				'head_panel_beating_signature' => '',
				'private_panel_beating_name' => '',
				'private_panel_beating_contact_details' => '',
				'private_panel_beating_address' => '',
				'private_panel_beating_quotation' => '',
				'private_panel_beating_quotation_2' => '',
				'artisan_note_of_completion_time' => '',
				'total_labour_time' => '',
			],
			'external_repairs_body' => [
				'external_repair_body_id' => '',
				'head_panel_beating_name' => '',
				'head_panel_beating_contact_details' => '',
				'head_panel_beating_address' => '',
				'head_panel_beating_signature' => '',
				'panel_beating_quotation' => '',
				'panel_beating_quotation_approved_by_service_provider' => '',
				'service_provider_name' => '',
				'service_provider_type' => '',
				'service_provider_contact_details' => '',
				'service_provider_address' => '',
				'service_provider_branch' => '',
				'service_provider_branch_code' => '',
				'service_provider_signature' => '',
				'instruction_note' => '',
				'authorization_number' => '',
				'vehicle_registration_number' => '',
				'engine_number' => '',
				'make_of_vehicle' => '',
				'vehicle_colour' => '',
				'vehicle_inspection_done' => '',
				'vehicle_inspection_check_list_form' => '',
				'vehicle_tyre_sizes' => '',
				'vehicle_mirrow_check' => '',
				'vehicle_interior_condition' => '',
				'vehicle_exterior_condition' => '',
				'merchant_type' => '',
				'merchant_code' => '',
				'merchant_name' => '',
				'merchant_contacts_details' => '',
				'merchant_email_address' => '',
				'merchant_signature' => '',
				'merchant_address' => '',
				'merchant_address_code' => '',
				'merchant_city' => '',
				'head_panel_beating_monitor_progress' => '',
				'head_panel_beating_monitor_quality_of_work_manship' => '',
				'vehicle_inspection_report' => '',
				'upload_invoice' => '',
			],
			'ordering_of_spares_for_internal_repairs' => [
				'spares_id' => '',
				'workshop_name' => '',
				'job_card_number' => '',
				'artisan_name_and_surname' => '',
				'artisan_contacts' => '',
				'artisan_email_address' => '',
				'artisan_signature' => '',
				'internal_requisition_to_stores' => '',
				'supervisor_name_and_surname' => '',
				'supervisor_contact_details' => '',
				'supervisor_email_address' => '',
				'supervisor_signature' => '',
				'internal_requisition_to_stores_recommended' => '',
				'workshop_manager_name_and_surname' => '',
				'workshop_manager_contact_details' => '',
				'workshop_manager_email_address' => '',
				'workshop_manager_signature' => '',
				'internal_requisition_to_stores_approved' => '',
				'date_parts_ordered' => '',
				'vehicle_registration_number' => '',
				'engine_number' => '',
				'make_of_vehicle' => '',
				'part_type_1' => '',
				'part_name_1' => '',
				'description_1' => '',
				'manufacture_1' => '',
				'quality_1' => '',
				'unit_price_1' => '0.00',
				'net_part_price_1' => '0.00',
				'part_type_2' => '',
				'part_name_2' => '',
				'description_2' => '',
				'manufacture_2' => '',
				'quality_2' => '',
				'unit_price_2' => '0.00',
				'net_part_price_2' => '0.00',
				'part_type_3' => '',
				'part_name_3' => '',
				'description_3' => '',
				'manufacture_3' => '',
				'quality_3' => '',
				'unit_price_3' => '0.00',
				'net_part_price_3' => '0.00',
				'part_type_4' => '',
				'part_name_4' => '',
				'description_4' => '',
				'manufacture_4' => '',
				'quality_4' => '',
				'unit_price_4' => '0.00',
				'net_part_price_4' => '0.00',
				'part_type_5' => '',
				'part_name_5' => '',
				'description_5' => '',
				'manufacture_5' => '',
				'quality_5' => '',
				'unit_price_5' => '0.00',
				'net_part_price_5' => '0.00',
				'part_type_6' => '',
				'part_name_6' => '',
				'description_6' => '',
				'manufacture_6' => '',
				'quality_6' => '',
				'unit_price_6' => '0.00',
				'net_part_price_6' => '0.00',
				'part_type_7' => '',
				'part_name_7' => '',
				'description_7' => '',
				'manufacture_7' => '',
				'quality_7' => '',
				'unit_price_7' => '0.00',
				'net_part_price_7' => '0.00',
				'part_type_8' => '',
				'part_name_8' => '',
				'description_8' => '',
				'manufacture_8' => '',
				'unit_price_8' => '0.00',
				'quality_8' => '',
				'net_part_price_8' => '0.00',
				'tax' => '',
				'total_amount' => '',
				'attached_requisition_form' => '',
				'work_allocation_reference_number' => '',
				'date_parts_received' => '',
			],
			'collection_of_repaired_vehicles' => [
				'collection_id' => '',
				'reception_name_and_surname' => '',
				'reception_persal_number' => '',
				'reception_contact_details' => '',
				'reception_email_address' => '',
				'reception_signature' => '',
				'driver_name_and_surname' => '',
				'driver_persal_number' => '',
				'driver_contacts_details' => '',
				'driver_email_address' => '',
				'driver_license_upload' => '',
				'driver_signature' => '',
				'government_garage_name' => '',
				'government_garage_contact_details' => '',
				'government_garage_address' => '',
				'government_garage_email_address' => '',
				'vehicle_registration_number' => '',
				'engine_number' => '',
				'make_of_vehicle' => '',
				'vehicle_inspection' => '',
				'vehicle_inspection_form' => '',
				'vehicle_interiour_condition' => '',
				'vehicle_exteriour_condition' => '',
				'vehicle_tyre_check' => '',
				'sign_off_time' => '',
				'date_of_repaired_vehicle_collection' => '',
			],
			'withdrawal_vehicle_from_operation' => [
				'withdrawal_id' => '',
				'supervisor_name_and_surname' => '',
				'supervisor_contact_details' => '',
				'supervisor_email_address' => '',
				'supervisor_signature' => '',
				'vehicle_registration_number' => '',
				'engine_number' => '',
				'make_of_vehicle' => '',
				'purchased_price' => '0.00',
				'date_of_service' => '',
				'date_of_next_service' => '',
				'renewal_of_license' => '',
				'date_of_vehicle' => '',
				'description_of_vehicle_breakdown' => '',
				'tyre_inspection_report' => '',
				'document_checklist_report' => '',
				'compiled_technical_report' => '',
				'district_officer_name_and_surname' => '',
				'district_officer_persal_number' => '',
				'district_officer_contacts' => '',
				'district_officer_signature' => '',
				'district_officer_email_address' => '',
			],
			'costing' => [
				'costing_id' => '',
				'government_garage_name' => '',
				'supervisor_name_and_surname' => '',
				'supervisor_contact_details' => '',
				'supervisor_email_address' => '',
				'supervisor_signature' => '',
				'job_card_number' => '',
				'vehicle_registration_number' => '',
				'engine_number' => '',
				'make_of_vehicle' => '',
				'reconciliation_of_total_costs_by_costing_officer' => '',
				'costing_officer_name_and_surname' => '',
				'costing_officer_contact_details' => '',
				'costing_officer_email_address' => '',
				'costing_officer_signature' => '',
				'material_cost' => '0.00',
				'spares_orders_quotation' => '0.00',
				'spares_orders_quotation_upload' => '',
				'standard_labour_cost_per_hour' => '0.00',
				'labour_quotation' => '0.00',
				'labour_quotation_upload' => '',
				'vat' => '0.15',
				'total_amount' => '0.00',
				'workshop_manager_name_and_surname' => '',
				'workshop_manager_contact_details' => '',
				'workshop_manager_email_address' => '',
				'workshop_manager_signature' => '',
				'invoice_approved' => '',
				'invoice_date' => '0000-00-00',
				'upload_invoice' => '',
			],
			'billing' => [
				'billing_id' => '',
				'district' => '',
				'location' => '',
				'upload_invoice' => '',
				'job_card_number' => '',
				'invoice_date' => '0000-00-00',
				'maintenance_file' => '',
				'vehicle_registration_number' => '',
				'engine_number' => '',
				'make_of_vehicle' => '',
			],
			'general_control_measures' => [
				'general_control_measures_id' => '',
				'district' => '',
				'cost_centre' => '',
				'location' => '',
				'government_garage_name' => '',
				'government_garage_section' => '',
				'government_garage_manager_name_and_surname' => '',
				'government_garage_manager_contact_details' => '',
				'government_garage_manager_email_address' => '',
				'government_garage_manager_signature' => '',
				'government_garage_address' => '',
				'government_garage_condition' => '',
				'four_post_lift_condition' => '',
				'low_level_lift_condition' => '',
				'test_machines_conditions' => '',
				'battery_testers_conditions' => '',
				'chargers_conditions' => '',
				'tools_conditions' => '',
				'hand_tools_conditions' => '',
				'equipment_conditions' => '',
				'sectional_inspection' => '',
			],
			'movement_of_personnel_in_government_garage_and_workshops' => [
				'movement_id' => '',
				'vehicle_inspection' => '',
				'vehicle_model' => '',
				'vehicle_number_plate' => '',
				'vehicle_tires_check' => '',
				'vehicle_mirrow_check' => '',
				'gate_security_signature' => '',
				'government_garage_protocol' => '',
				'government_garage_safety' => '',
				'vehicle_handing_over_checklist' => '',
				'vehicle_return_list' => '',
				'approved_workshop_procedure_manual' => '',
				'vehicle_registration_number' => '',
				'engine_number' => '',
				'make_of_vehicle' => '',
			],
			'service_provider' => [
				'service_provider_id' => '',
				'service_provider_type' => '',
				'service_provider_name' => '',
				'service_provider_contact_email' => '',
				'service_provider_contact_details' => '',
				'service_provider_street_address' => '',
				'service_provider_branch_code' => '',
				'service_provider_branch' => '',
				'service_provider_city' => '',
				'service_provider_address_code' => '',
			],
			'service_provider_type' => [
				'service_provider_type_id' => '',
				'service_provider_type' => '',
			],
			'vehicle_annual_inspection' => [
				'fleet_asset_id' => '',
				'vehicle_registration_number' => '',
				'register_number' => '',
				'engine_number' => '',
				'chassis_number' => '',
				'make_of_vehicle' => '',
				'model_of_vehicle' => '',
				'year_model_specification' => '',
				'engine_capacity' => '',
				'tyre_size' => '',
				'transmission' => '',
				'fuel_type' => '',
				'type_of_vehicle' => '',
				'colour_of_vehicle' => '',
				'application_status' => '',
				'renewal_of_license' => '',
				'barcode_number' => '',
				'last_entry_logbook' => '',
				'photo_of_vehicle' => '',
				'department_name' => '',
				'province' => '',
				'district' => '',
				'mechanical_inspection' => '',
				'upholstery' => '',
				'electrical_inspection' => '',
				'wheel_spanner' => '',
				'spare_wheel' => '',
				'jack' => '',
				'radio' => '',
				'triangle' => '',
				'log_book' => '',
				'iternary' => '',
				'fuel_card' => '',
				'recommendation' => '',
				'documents' => '',
				'checking_officer_name_and_surname' => '',
				'checking_officer_contact_email' => '',
				'date_of_inspection' => '0000-00-00',
			],
		];

		return isset($defaults[$table]) ? $defaults[$table] : [];
	}

	#########################################################

	function htmlUserBar() {
		global $Translation;
		if(!defined('PREPEND_PATH')) define('PREPEND_PATH', '');

		$mi = getMemberInfo();
		$adminConfig = config('adminConfig');
		$home_page = (basename($_SERVER['PHP_SELF']) == 'index.php');
		ob_start();

		?>
		<nav class="navbar navbar-default navbar-fixed-top hidden-print" role="navigation">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<!-- application title is obtained from the name besides the yellow database icon in AppGini, use underscores for spaces -->
				<a  href="<?php echo PREPEND_PATH; ?>index.php"><img src="images/CruiserMotorcycle_Yellows.png" /> </a>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav"><?php echo ($home_page ? '' : NavMenus()); ?></ul>

				<?php if(userCanImport()){ ?>
					<ul class="nav navbar-nav">
						<a href="<?php echo PREPEND_PATH; ?>import-csv.php" class="btn btn-default navbar-btn hidden-xs btn-import-csv" title="<?php echo html_attr($Translation['import csv file']); ?>"><i class="glyphicon glyphicon-th"></i> </a>
						<a href="<?php echo PREPEND_PATH; ?>import-csv.php" class="btn btn-default navbar-btn visible-xs btn-lg btn-import-csv" title="<?php echo html_attr($Translation['import csv file']); ?>"><i class="glyphicon glyphicon-th"></i> <?php echo $Translation['import CSV']; ?></a>
					</ul>
				<?php } ?>

				<?php if(getLoggedAdmin() !== false) { ?>
					<ul class="nav navbar-nav">
						<a href="<?php echo PREPEND_PATH; ?>admin/pageHome.php"  title="<?php echo html_attr($Translation['admin area']); ?>"><img src="images/identifications.png" /></a>

					</ul>
				<?php } ?>

				<?php if(!Request::val('signIn') && !Request::val('loginFailed')) { ?>
					<?php if(!$mi['username'] || $mi['username'] == $adminConfig['anonymousMember']) { ?>
						<p class="navbar-text navbar-right">&nbsp;</p>
						<a href="<?php echo PREPEND_PATH; ?>index.php?signIn=1" class="btn btn-success navbar-btn navbar-right"><?php echo $Translation['sign in']; ?></a>
						<p class="navbar-text navbar-right">
							<?php echo $Translation['not signed in']; ?>
						</p>
					<?php } else { ?>


						<a href="hooks/calendar.php" target="_blank" title="Service Scheduler" ><img src="images/calendar_month.png" /></a>
					<a href="hooks/reports.php" target="_blank" title="Report" ><img src="images/report.png" /></a>

					<a href="LDTCS GMT Fleet Maintenance Management System.pdf" target="_blank" title="Guideline" ><img src="images/Books-2-icon3.png" /></a>


						<ul class="nav navbar-nav navbar-right hidden-xs" style="min-width: 330px;">
								<a href="<?php echo PREPEND_PATH; ?>index.php?signOut=1"><img src="images/intranet.png" /> </a>

							<p class="navbar-text signed-in-as">
								 <strong><a href="<?php echo PREPEND_PATH; ?>membership_profile.php" ><img src="images/trainer.png" /><b style="color: #B0090E" ><?php echo getLoggedMemberID(); ?></b></a></strong>
							</p>
						</ul>
						<ul class="nav navbar-nav visible-xs">
							<a class="btn navbar-btn btn-default btn-lg visible-xs" href="<?php echo PREPEND_PATH; ?>index.php?signOut=1"><i class="glyphicon glyphicon-log-out"></i> <?php echo $Translation['sign out']; ?></a>
							<p class="navbar-text text-center signed-in-as">
								<?php echo $Translation['signed as']; ?> <strong><a href="<?php echo PREPEND_PATH; ?>membership_profile.php" class="navbar-link username"><?php echo $mi['username']; ?></a></strong>
							</p>
						</ul>
						<script>
							/* periodically check if user is still signed in */
							setInterval(function() {
								$j.ajax({
									url: '<?php echo PREPEND_PATH; ?>ajax_check_login.php',
									success: function(username) {
										if(!username.length) window.location = '<?php echo PREPEND_PATH; ?>index.php?signIn=1';
									}
								});
							}, 60000);
						</script>
					<?php } ?>
				<?php } ?>

			</div>
		</nav>
		<?php

		return ob_get_clean();
	}

	#########################################################

	function showNotifications($msg = '', $class = '', $fadeout = true) {
		global $Translation;
		if($error_message = strip_tags(Request::val('error_message')))
			$error_message = '<div class="text-bold">' . $error_message . '</div>';

		if(!$msg) { // if no msg, use url to detect message to display
			if(Request::val('record-added-ok')) {
				$msg = $Translation['new record saved'];
				$class = 'alert-success';
			} elseif(Request::val('record-added-error')) {
				$msg = $Translation['Couldn\'t save the new record'] . $error_message;
				$class = 'alert-danger';
				$fadeout = false;
			} elseif(Request::val('record-updated-ok')) {
				$msg = $Translation['record updated'];
				$class = 'alert-success';
			} elseif(Request::val('record-updated-error')) {
				$msg = $Translation['Couldn\'t save changes to the record'] . $error_message;
				$class = 'alert-danger';
				$fadeout = false;
			} elseif(Request::val('record-deleted-ok')) {
				$msg = $Translation['The record has been deleted successfully'];
				$class = 'alert-success';
			} elseif(Request::val('record-deleted-error')) {
				$msg = $Translation['Couldn\'t delete this record'] . $error_message;
				$class = 'alert-danger';
				$fadeout = false;
			} else {
				return '';
			}
		}
		$id = 'notification-' . rand();

		ob_start();
		// notification template
		?>
		<div id="%%ID%%" class="alert alert-dismissable %%CLASS%%" style="opacity: 1; padding-top: 6px; padding-bottom: 6px; animation: fadeIn 1.5s ease-out; z-index: 100; position: relative;">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			%%MSG%%
		</div>
		<script>
			$j(function() {
				var autoDismiss = <?php echo $fadeout ? 'true' : 'false'; ?>,
					embedded = !$j('nav').length,
					messageDelay = 10, fadeDelay = 1.5;

				if(!autoDismiss) {
					if(embedded)
						$j('#%%ID%%').before('<div style="height: 2rem;"></div>');
					else
						$j('#%%ID%%').css({ margin: '0 0 1rem' });

					return;
				}

				// below code runs only in case of autoDismiss

				if(embedded)
					$j('#%%ID%%').css({ margin: '1rem 0 -1rem' });
				else
					$j('#%%ID%%').css({ margin: '-15px 0 -20px' });

				setTimeout(function() {
					$j('#%%ID%%').css({    animation: 'fadeOut ' + fadeDelay + 's ease-out' });
				}, messageDelay * 1000);

				setTimeout(function() {
					$j('#%%ID%%').css({    visibility: 'hidden' });
				}, (messageDelay + fadeDelay) * 1000);
			})
		</script>
		<style>
			@keyframes fadeIn {
				0%   { opacity: 0; }
				100% { opacity: 1; }
			}
			@keyframes fadeOut {
				0%   { opacity: 1; }
				100% { opacity: 0; }
			}
		</style>

		<?php
		$out = ob_get_clean();

		$out = str_replace('%%ID%%', $id, $out);
		$out = str_replace('%%MSG%%', $msg, $out);
		$out = str_replace('%%CLASS%%', $class, $out);

		return $out;
	}

	#########################################################

	function validMySQLDate($date) {
		$date = trim($date);

		try {
			$dtObj = new DateTime($date);
		} catch(Exception $e) {
			return false;
		}

		$parts = explode('-', $date);
		return (
			count($parts) == 3
			// see https://dev.mysql.com/doc/refman/8.0/en/datetime.html
			&& intval($parts[0]) >= 1000
			&& intval($parts[0]) <= 9999
			&& intval($parts[1]) >= 1
			&& intval($parts[1]) <= 12
			&& intval($parts[2]) >= 1
			&& intval($parts[2]) <= 31
		);
	}

	#########################################################

	function parseMySQLDate($date, $altDate) {
		// is $date valid?
		if(validMySQLDate($date)) return trim($date);

		if($date != '--' && validMySQLDate($altDate)) return trim($altDate);

		if($date != '--' && $altDate && is_numeric($altDate))
			return @date('Y-m-d', @time() + ($altDate >= 1 ? $altDate - 1 : $altDate) * 86400);

		return '';
	}

	#########################################################

	function parseCode($code, $isInsert = true, $rawData = false) {
		$mi = Authentication::getUser();

		if($isInsert) {
			$arrCodes = [
				'<%%creatorusername%%>' => $mi['username'],
				'<%%creatorgroupid%%>' => $mi['groupId'],
				'<%%creatorip%%>' => $_SERVER['REMOTE_ADDR'],
				'<%%creatorgroup%%>' => $mi['group'],

				'<%%creationdate%%>' => ($rawData ? date('Y-m-d') : date(app_datetime_format('phps'))),
				'<%%creationtime%%>' => ($rawData ? date('H:i:s') : date(app_datetime_format('phps', 't'))),
				'<%%creationdatetime%%>' => ($rawData ? date('Y-m-d H:i:s') : date(app_datetime_format('phps', 'dt'))),
				'<%%creationtimestamp%%>' => ($rawData ? date('Y-m-d H:i:s') : time()),
			];
		} else {
			$arrCodes = [
				'<%%editorusername%%>' => $mi['username'],
				'<%%editorgroupid%%>' => $mi['groupId'],
				'<%%editorip%%>' => $_SERVER['REMOTE_ADDR'],
				'<%%editorgroup%%>' => $mi['group'],

				'<%%editingdate%%>' => ($rawData ? date('Y-m-d') : date(app_datetime_format('phps'))),
				'<%%editingtime%%>' => ($rawData ? date('H:i:s') : date(app_datetime_format('phps', 't'))),
				'<%%editingdatetime%%>' => ($rawData ? date('Y-m-d H:i:s') : date(app_datetime_format('phps', 'dt'))),
				'<%%editingtimestamp%%>' => ($rawData ? date('Y-m-d H:i:s') : time()),
			];
		}

		$pc = str_ireplace(array_keys($arrCodes), array_values($arrCodes), $code);

		return $pc;
	}

	#########################################################

	function addFilter($index, $filterAnd, $filterField, $filterOperator, $filterValue) {
		// validate input
		if($index < 1 || $index > 80 || !is_int($index)) return false;
		if($filterAnd != 'or')   $filterAnd = 'and';
		$filterField = intval($filterField);

		/* backward compatibility */
		if(in_array($filterOperator, FILTER_OPERATORS)) {
			$filterOperator = array_search($filterOperator, FILTER_OPERATORS);
		}

		if(!in_array($filterOperator, array_keys(FILTER_OPERATORS))) {
			$filterOperator = 'like';
		}

		if(!$filterField) {
			$filterOperator = '';
			$filterValue = '';
		}

		$_REQUEST['FilterAnd'][$index] = $filterAnd;
		$_REQUEST['FilterField'][$index] = $filterField;
		$_REQUEST['FilterOperator'][$index] = $filterOperator;
		$_REQUEST['FilterValue'][$index] = $filterValue;

		return true;
	}

	#########################################################

	function clearFilters() {
		for($i=1; $i<=80; $i++) {
			addFilter($i, '', 0, '', '');
		}
	}

	#########################################################

	/**
	* Loads a given view from the templates folder, passing the given data to it
	* @param $view the name of a php file (without extension) to be loaded from the 'templates' folder
	* @param $the_data_to_pass_to_the_view (optional) associative array containing the data to pass to the view
	* @return the output of the parsed view as a string
	*/
	function loadView($view, $the_data_to_pass_to_the_view = false) {
		global $Translation;

		$view = __DIR__ . "/templates/$view.php";
		if(!is_file($view)) return false;

		if(is_array($the_data_to_pass_to_the_view)) {
			foreach($the_data_to_pass_to_the_view as $data_k => $data_v)
				$$data_k = $data_v;
		}
		unset($the_data_to_pass_to_the_view, $data_k, $data_v);

		ob_start();
		@include($view);
		return ob_get_clean();
	}

	#########################################################

	/**
	* Loads a table template from the templates folder, passing the given data to it
	* @param $table_name the name of the table whose template is to be loaded from the 'templates' folder
	* @param $the_data_to_pass_to_the_table associative array containing the data to pass to the table template
	* @return the output of the parsed table template as a string
	*/
	function loadTable($table_name, $the_data_to_pass_to_the_table = []) {
		$dont_load_header = $the_data_to_pass_to_the_table['dont_load_header'];
		$dont_load_footer = $the_data_to_pass_to_the_table['dont_load_footer'];

		$header = $table = $footer = '';

		if(!$dont_load_header) {
			// try to load tablename-header
			if(!($header = loadView("{$table_name}-header", $the_data_to_pass_to_the_table))) {
				$header = loadView('table-common-header', $the_data_to_pass_to_the_table);
			}
		}

		$table = loadView($table_name, $the_data_to_pass_to_the_table);

		if(!$dont_load_footer) {
			// try to load tablename-footer
			if(!($footer = loadView("{$table_name}-footer", $the_data_to_pass_to_the_table))) {
				$footer = loadView('table-common-footer', $the_data_to_pass_to_the_table);
			}
		}

		return "{$header}{$table}{$footer}";
	}

	#########################################################

	function br2nl($text) {
		return  preg_replace('/\<br(\s*)?\/?\>/i', "\n", $text);
	}

	#########################################################

	function entitiesToUTF8($input) {
		return preg_replace_callback('/(&#[0-9]+;)/', '_toUTF8', $input);
	}

	function _toUTF8($m) {
		if(function_exists('mb_convert_encoding')) {
			return mb_convert_encoding($m[1], "UTF-8", "HTML-ENTITIES");
		} else {
			return $m[1];
		}
	}

	#########################################################

	function func_get_args_byref() {
		if(!function_exists('debug_backtrace')) return false;

		$trace = debug_backtrace();
		return $trace[1]['args'];
	}

	#########################################################

	function permissions_sql($table, $level = 'all') {
		if(!in_array($level, ['user', 'group'])) { $level = 'all'; }
		$perm = getTablePermissions($table);
		$from = '';
		$where = '';
		$pk = getPKFieldName($table);

		if($perm['view'] == 1 || ($perm['view'] > 1 && $level == 'user')) { // view owner only
			$from = 'membership_userrecords';
			$where = "(`$table`.`$pk`=membership_userrecords.pkValue and membership_userrecords.tableName='$table' and lcase(membership_userrecords.memberID)='" . getLoggedMemberID() . "')";
		} elseif($perm['view'] == 2 || ($perm['view'] > 2 && $level == 'group')) { // view group only
			$from = 'membership_userrecords';
			$where = "(`$table`.`$pk`=membership_userrecords.pkValue and membership_userrecords.tableName='$table' and membership_userrecords.groupID='" . getLoggedGroupID() . "')";
		} elseif($perm['view'] == 3) { // view all
			// no further action
		} elseif($perm['view'] == 0) { // view none
			return false;
		}

		return ['where' => $where, 'from' => $from, 0 => $where, 1 => $from];
	}

	#########################################################

	function error_message($msg, $back_url = '', $full_page = true) {
		global $Translation;

		ob_start();

		if($full_page) include(__DIR__ . '/header.php');

		echo '<div class="panel panel-danger">';
			echo '<div class="panel-heading"><h3 class="panel-title">' . $Translation['error:'] . '</h3></div>';
			echo '<div class="panel-body"><p class="text-danger">' . $msg . '</p>';
			if($back_url !== false) { // explicitly passing false suppresses the back link completely
				echo '<div class="text-center">';
				if($back_url) {
					echo '<a href="' . $back_url . '" class="btn btn-danger btn-lg vspacer-lg"><i class="glyphicon glyphicon-chevron-left"></i> ' . $Translation['< back'] . '</a>';
				} else {
					echo '<a href="#" class="btn btn-danger btn-lg vspacer-lg" onclick="history.go(-1); return false;"><i class="glyphicon glyphicon-chevron-left"></i> ' . $Translation['< back'] . '</a>';
				}
				echo '</div>';
			}
			echo '</div>';
		echo '</div>';

		if($full_page) include(__DIR__ . '/footer.php');

		return ob_get_clean();
	}

	#########################################################

	function toMySQLDate($formattedDate, $sep = datalist_date_separator, $ord = datalist_date_format) {
		// extract date elements
		$de=explode($sep, $formattedDate);
		$mySQLDate=intval($de[strpos($ord, 'Y')]).'-'.intval($de[strpos($ord, 'm')]).'-'.intval($de[strpos($ord, 'd')]);
		return $mySQLDate;
	}

	#########################################################

	function reIndex(&$arr) {
		$i=1;
		foreach($arr as $n=>$v) {
			$arr2[$i]=$n;
			$i++;
		}
		return $arr2;
	}

	#########################################################

	function get_embed($provider, $url, $max_width = '', $max_height = '', $retrieve = 'html') {
		global $Translation;
		if(!$url) return '';

		$providers = [
			'youtube' => ['oembed' => 'https://www.youtube.com/oembed?'],
			'googlemap' => ['oembed' => '', 'regex' => '/^http.*\.google\..*maps/i'],
		];

		if(!isset($providers[$provider])) {
			return '<div class="text-danger">' . $Translation['invalid provider'] . '</div>';
		}

		if(isset($providers[$provider]['regex']) && !preg_match($providers[$provider]['regex'], $url)) {
			return '<div class="text-danger">' . $Translation['invalid url'] . '</div>';
		}

		if($providers[$provider]['oembed']) {
			$oembed = $providers[$provider]['oembed'] . 'url=' . urlencode($url) . "&amp;maxwidth={$max_width}&amp;maxheight={$max_height}&amp;format=json";
			$data_json = request_cache($oembed);

			$data = json_decode($data_json, true);
			if($data === null) {
				/* an error was returned rather than a json string */
				if($retrieve == 'html') return "<div class=\"text-danger\">{$data_json}\n<!-- {$oembed} --></div>";
				return '';
			}

			return (isset($data[$retrieve]) ? $data[$retrieve] : $data['html']);
		}

		/* special cases (where there is no oEmbed provider) */
		if($provider == 'googlemap') return get_embed_googlemap($url, $max_width, $max_height, $retrieve);

		return '<div class="text-danger">Invalid provider!</div>';
	}

	#########################################################

	function get_embed_googlemap($url, $max_width = '', $max_height = '', $retrieve = 'html') {
		global $Translation;
		$url_parts = parse_url($url);
		$coords_regex = '/-?\d+(\.\d+)?[,+]-?\d+(\.\d+)?(,\d{1,2}z)?/'; /* https://stackoverflow.com/questions/2660201 */

		if(preg_match($coords_regex, $url_parts['path'] . '?' . $url_parts['query'], $m)) {
			list($lat, $long, $zoom) = explode(',', $m[0]);
			$zoom = intval($zoom);
			if(!$zoom) $zoom = 10; /* default zoom */
			if(!$max_height) $max_height = 360;
			if(!$max_width) $max_width = 480;

			$api_key = config('adminConfig')['googleAPIKey'];
			$embed_url = "https://www.google.com/maps/embed/v1/view?key={$api_key}&amp;center={$lat},{$long}&amp;zoom={$zoom}&amp;maptype=roadmap";
			$thumbnail_url = "https://maps.googleapis.com/maps/api/staticmap?key={$api_key}&amp;center={$lat},{$long}&amp;zoom={$zoom}&amp;maptype=roadmap&amp;size={$max_width}x{$max_height}";

			if($retrieve == 'html') {
				return "<iframe width=\"{$max_width}\" height=\"{$max_height}\" frameborder=\"0\" style=\"border:0\" src=\"{$embed_url}\"></iframe>";
			} else {
				return $thumbnail_url;
			}
		} else {
			return '<div class="text-danger">' . $Translation['cant retrieve coordinates from url'] . '</div>';
		}
	}

	#########################################################

	function request_cache($request, $force_fetch = false) {
		$max_cache_lifetime = 7 * 86400; /* max cache lifetime in seconds before refreshing from source */

		/* membership_cache table exists? if not, create it */
		static $cache_table_exists = false;
		if(!$cache_table_exists && !$force_fetch) {
			$te = sqlValue("show tables like 'membership_cache'");
			if(!$te) {
				if(!sql("CREATE TABLE `membership_cache` (`request` VARCHAR(100) NOT NULL, `request_ts` INT, `response` TEXT NOT NULL, PRIMARY KEY (`request`))", $eo)) {
					/* table can't be created, so force fetching request */
					return request_cache($request, true);
				}
			}
			$cache_table_exists = true;
		}

		/* retrieve response from cache if exists */
		if(!$force_fetch) {
			$res = sql("select response, request_ts from membership_cache where request='" . md5($request) . "'", $eo);
			if(!$row = db_fetch_array($res)) return request_cache($request, true);

			$response = $row[0];
			$response_ts = $row[1];
			if($response_ts < time() - $max_cache_lifetime) return request_cache($request, true);
		}

		/* if no response in cache, issue a request */
		if(!$response || $force_fetch) {
			$response = @file_get_contents($request);
			if($response === false) {
				$error = error_get_last();
				$error_message = preg_replace('/.*: (.*)/', '$1', $error['message']);
				return $error_message;
			} elseif($cache_table_exists) {
				/* store response in cache */
				$ts = time();
				sql("replace into membership_cache set request='" . md5($request) . "', request_ts='{$ts}', response='" . makeSafe($response, false) . "'", $eo);
			}
		}

		return $response;
	}

	#########################################################

	function check_record_permission($table, $id, $perm = 'view') {
		if($perm != 'edit' && $perm != 'delete') $perm = 'view';

		$perms = getTablePermissions($table);
		if(!$perms[$perm]) return false;

		$safe_id = makeSafe($id);
		$safe_table = makeSafe($table);

		if($perms[$perm] == 1) { // own records only
			$username = getLoggedMemberID();
			$owner = sqlValue("select memberID from membership_userrecords where tableName='{$safe_table}' and pkValue='{$safe_id}'");
			if($owner == $username) return true;
		} elseif($perms[$perm] == 2) { // group records
			$group_id = getLoggedGroupID();
			$owner_group_id = sqlValue("select groupID from membership_userrecords where tableName='{$safe_table}' and pkValue='{$safe_id}'");
			if($owner_group_id == $group_id) return true;
		} elseif($perms[$perm] == 3) { // all records
			return true;
		}

		return false;
	}

	#########################################################

	function NavMenus($options = []) {
		if(!defined('PREPEND_PATH')) define('PREPEND_PATH', '');
		global $Translation;
		$prepend_path = PREPEND_PATH;

		/* default options */
		if(empty($options)) {
			$options = ['tabs' => 7];
		}

		$table_group_name = array_keys(get_table_groups()); /* 0 => group1, 1 => group2 .. */
		/* if only one group named 'None', set to translation of 'select a table' */
		if((count($table_group_name) == 1 && $table_group_name[0] == 'None') || count($table_group_name) < 1) $table_group_name[0] = $Translation['select a table'];
		$table_group_index = array_flip($table_group_name); /* group1 => 0, group2 => 1 .. */
		$menu = array_fill(0, count($table_group_name), '');

		$t = time();
		$arrTables = getTableList();
		if(is_array($arrTables)) {
			foreach($arrTables as $tn => $tc) {
				/* ---- list of tables where hide link in nav menu is set ---- */
				$tChkHL = array_search($tn, []);

				/* ---- list of tables where filter first is set ---- */
				$tChkFF = array_search($tn, []);
				if($tChkFF !== false && $tChkFF !== null) {
					$searchFirst = '&Filter_x=1';
				} else {
					$searchFirst = '';
				}

				/* when no groups defined, $table_group_index['None'] is NULL, so $menu_index is still set to 0 */
				$menu_index = intval($table_group_index[$tc[3]]);
				if(!$tChkHL && $tChkHL !== 0) $menu[$menu_index] .= "<li><a href=\"{$prepend_path}{$tn}_view.php?t={$t}{$searchFirst}\"><img src=\"{$prepend_path}" . ($tc[2] ? $tc[2] : 'blank.gif') . "\" height=\"32\"> {$tc[0]}</a></li>";
			}
		}

		// custom nav links, as defined in "hooks/links-navmenu.php" 
		global $navLinks;
		if(is_array($navLinks)) {
			$memberInfo = getMemberInfo();
			$links_added = [];
			foreach($navLinks as $link) {
				if(!isset($link['url']) || !isset($link['title'])) continue;
				if(getLoggedAdmin() !== false || @in_array($memberInfo['group'], $link['groups']) || @in_array('*', $link['groups'])) {
					$menu_index = intval($link['table_group']);
					if(!$links_added[$menu_index]) $menu[$menu_index] .= '<li class="divider"></li>';

					/* add prepend_path to custom links if they aren't absolute links */
					if(!preg_match('/^(http|\/\/)/i', $link['url'])) $link['url'] = $prepend_path . $link['url'];
					if(!preg_match('/^(http|\/\/)/i', $link['icon']) && $link['icon']) $link['icon'] = $prepend_path . $link['icon'];

					$menu[$menu_index] .= "<li><a href=\"{$link['url']}\"><img src=\"" . ($link['icon'] ? $link['icon'] : "{$prepend_path}blank.gif") . "\" height=\"32\"> {$link['title']}</a></li>";
					$links_added[$menu_index]++;
				}
			}
		}

		$menu_wrapper = '';
		for($i = 0; $i < count($menu); $i++) {
			$menu_wrapper .= <<<EOT
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">{$table_group_name[$i]} <b class="caret"></b></a>
					<ul class="dropdown-menu" role="menu">{$menu[$i]}</ul>
				</li>
EOT;
		}

		return $menu_wrapper;
	}

	#########################################################

	function StyleSheet() {
		if(!defined('PREPEND_PATH')) define('PREPEND_PATH', '');
		$prepend_path = PREPEND_PATH;
		$appVersion = (defined('APP_VERSION') ? APP_VERSION : rand());

		$css_links = <<<EOT

			<link rel="stylesheet" href="{$prepend_path}resources/initializr/css/bootstrap.css">
			<link rel="stylesheet" href="{$prepend_path}resources/lightbox/css/lightbox.css" media="screen">
			<link rel="stylesheet" href="{$prepend_path}resources/select2/select2.css" media="screen">
			<link rel="stylesheet" href="{$prepend_path}resources/timepicker/bootstrap-timepicker.min.css" media="screen">
			<link rel="stylesheet" href="{$prepend_path}dynamic.css?{$appVersion}">
EOT;

		return $css_links;
	}

	#########################################################

	function PrepareUploadedFile($FieldName, $MaxSize, $FileTypes = 'jpg|jpeg|gif|png|webp', $NoRename = false, $dir = '') {
		global $Translation;
		$f = $_FILES[$FieldName];
		if($f['error'] == 4 || !$f['name']) return '';

		$dir = getUploadDir($dir);

		/* get php.ini upload_max_filesize in bytes */
		$php_upload_size_limit = toBytes(ini_get('upload_max_filesize'));
		$MaxSize = min($MaxSize, $php_upload_size_limit);

		if($f['size'] > $MaxSize || $f['error']) {
			echo error_message(str_replace(['<MaxSize>', '{MaxSize}'], intval($MaxSize / 1024), $Translation['file too large']));
			exit;
		}
		if(!preg_match('/\.(' . $FileTypes . ')$/i', $f['name'], $ft)) {
			echo error_message(str_replace(['<FileTypes>', '{FileTypes}'], str_replace('|', ', ', $FileTypes), $Translation['invalid file type']));
			exit;
		}

		$name = str_replace(' ', '_', $f['name']);
		if(!$NoRename) $name = substr(md5(microtime() . rand(0, 100000)), -17) . $ft[0];

		if(!file_exists($dir)) @mkdir($dir, 0777);

		if(!@move_uploaded_file($f['tmp_name'], $dir . $name)) {
			echo error_message("Couldn't save the uploaded file. Try chmoding the upload folder '{$dir}' to 777.");
			exit;
		}

		@chmod($dir . $name, 0666);
		return $name;
	}

	#########################################################

	function get_home_links($homeLinks, $default_classes, $tgroup = '') {
		if(!is_array($homeLinks) || !count($homeLinks)) return '';

		$memberInfo = getMemberInfo();

		ob_start();
		foreach($homeLinks as $link) {
			if(!isset($link['url']) || !isset($link['title'])) continue;
			if($tgroup != $link['table_group'] && $tgroup != '*') continue;

			/* fall-back classes if none defined */
			if(!$link['grid_column_classes']) $link['grid_column_classes'] = $default_classes['grid_column'];
			if(!$link['panel_classes']) $link['panel_classes'] = $default_classes['panel'];
			if(!$link['link_classes']) $link['link_classes'] = $default_classes['link'];

			if(getLoggedAdmin() !== false || @in_array($memberInfo['group'], $link['groups']) || @in_array('*', $link['groups'])) {
				?>
				<div class="col-xs-12 <?php echo $link['grid_column_classes']; ?>">
					<div class="panel <?php echo $link['panel_classes']; ?>">
						<div class="panel-body">
							<a class="btn btn-block btn-lg <?php echo $link['link_classes']; ?>" title="<?php echo preg_replace("/&amp;(#[0-9]+|[a-z]+);/i", "&$1;", html_attr(strip_tags($link['description']))); ?>" href="<?php echo $link['url']; ?>"><?php echo ($link['icon'] ? '<img src="' . $link['icon'] . '">' : ''); ?><strong><?php echo $link['title']; ?></strong></a>
							<div class="panel-body-description"><?php echo $link['description']; ?></div>
						</div>
					</div>
				</div>
				<?php
			}
		}

		return ob_get_clean();
	}

	#########################################################

	function quick_search_html($search_term, $label, $separate_dv = true) {
		global $Translation;

		$safe_search = html_attr($search_term);
		$safe_label = html_attr($label);
		$safe_clear_label = html_attr($Translation['Reset Filters']);

		if($separate_dv) {
			$reset_selection = "document.myform.SelectedID.value = '';";
		} else {
			$reset_selection = "document.myform.writeAttribute('novalidate', 'novalidate');";
		}
		$reset_selection .= ' document.myform.NoDV.value=1; return true;';

		$html = <<<EOT
		<div class="input-group" id="quick-search">
			<input type="text" id="SearchString" name="SearchString" value="{$safe_search}" class="form-control" placeholder="{$safe_label}">
			<span class="input-group-btn">
				<button name="Search_x" value="1" id="Search" type="submit" onClick="{$reset_selection}" class="btn btn-default" title="{$safe_label}"><i class="glyphicon glyphicon-search"></i></button>
				<button name="ClearQuickSearch" value="1" id="ClearQuickSearch" type="submit" onClick="\$j('#SearchString').val(''); {$reset_selection}" class="btn btn-default" title="{$safe_clear_label}"><i class="glyphicon glyphicon-remove-circle"></i></button>
			</span>
		</div>
EOT;
		return $html;
	}

	#########################################################

