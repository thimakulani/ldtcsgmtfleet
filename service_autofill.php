<?php
// This script and data application were generated by AppGini 22.13
// Download AppGini for free from https://bigprof.com/appgini/download/

	include_once(__DIR__ . '/lib.php');

	handle_maintenance();

	header('Content-type: text/javascript; charset=' . datalist_db_encoding);

	$table_perms = getTablePermissions('service');
	if(!$table_perms['access']) die('// Access denied!');

	$mfk = Request::val('mfk');
	$id = makeSafe(Request::val('id'));
	$rnd1 = intval(Request::val('rnd1')); if(!$rnd1) $rnd1 = '';

	if(!$mfk) {
		die('// No js code available!');
	}

	switch($mfk) {

		case 'vehicle_registration_number':
			if(!$id) {
				?>
				$j('#engine_number<?php echo $rnd1; ?>').html('&nbsp;');
				$j('#chassis_number<?php echo $rnd1; ?>').html('&nbsp;');
				$j('#model_of_vehicle<?php echo $rnd1; ?>').html('&nbsp;');
				$j('#year_model_of_vehicle<?php echo $rnd1; ?>').html('&nbsp;');
				$j('#type_of_vehicle<?php echo $rnd1; ?>').html('&nbsp;');
				$j('#application_status<?php echo $rnd1; ?>').html('&nbsp;');
				$j('#barcode_number<?php echo $rnd1; ?>').html('&nbsp;');
				$j('#department<?php echo $rnd1; ?>').html('&nbsp;');
				<?php
				break;
			}
			$res = sql("SELECT `gmt_fleet_register`.`fleet_asset_id` as 'fleet_asset_id', `gmt_fleet_register`.`vehicle_registration_number` as 'vehicle_registration_number', `gmt_fleet_register`.`register_number` as 'register_number', `gmt_fleet_register`.`engine_number` as 'engine_number', `gmt_fleet_register`.`chassis_number` as 'chassis_number', IF(    CHAR_LENGTH(`dealer1`.`dealer_name`), CONCAT_WS('',   `dealer1`.`dealer_name`), '') as 'dealer_name', IF(    CHAR_LENGTH(`dealer2`.`make_of_vehicle`), CONCAT_WS('',   `dealer2`.`make_of_vehicle`, '   '), '') as 'make_of_vehicle', `gmt_fleet_register`.`model_of_vehicle` as 'model_of_vehicle', IF(    CHAR_LENGTH(`year_model1`.`year_model_specification`), CONCAT_WS('',   `year_model1`.`year_model_specification`), '') as 'year_model_specification', `gmt_fleet_register`.`engine_capacity` as 'engine_capacity', `gmt_fleet_register`.`tyre_size` as 'tyre_size', IF(    CHAR_LENGTH(`transmission1`.`transmission`), CONCAT_WS('',   `transmission1`.`transmission`), '') as 'transmission', IF(    CHAR_LENGTH(`fuel_type1`.`fuel_type`), CONCAT_WS('',   `fuel_type1`.`fuel_type`), '') as 'fuel_type', IF(    CHAR_LENGTH(`body_type1`.`type_of_vehicle`), CONCAT_WS('',   `body_type1`.`type_of_vehicle`), '') as 'type_of_vehicle', IF(    CHAR_LENGTH(`vehicle_colour1`.`colour_of_vehicle`), CONCAT_WS('',   `vehicle_colour1`.`colour_of_vehicle`), '') as 'colour_of_vehicle', IF(    CHAR_LENGTH(`application_status1`.`application_status`), CONCAT_WS('',   `application_status1`.`application_status`), '') as 'application_status', `gmt_fleet_register`.`case_number` as 'case_number', `gmt_fleet_register`.`barcode_number` as 'barcode_number', `gmt_fleet_register`.`purchase_price` as 'purchase_price', `gmt_fleet_register`.`depreciation_value` as 'depreciation_value', `gmt_fleet_register`.`photo_of_vehicle` as 'photo_of_vehicle', `gmt_fleet_register`.`user_name_and_surname` as 'user_name_and_surname', `gmt_fleet_register`.`user_contact_email` as 'user_contact_email', `gmt_fleet_register`.`contact_number` as 'contact_number', IF(    CHAR_LENGTH(`departments1`.`department_name`), CONCAT_WS('',   `departments1`.`department_name`), '') as 'department_name', `gmt_fleet_register`.`department_address` as 'department_address', IF(    CHAR_LENGTH(`province1`.`province`), CONCAT_WS('',   `province1`.`province`), '') as 'province', IF(    CHAR_LENGTH(`districts1`.`district`) || CHAR_LENGTH(`districts1`.`station`), CONCAT_WS('',   `districts1`.`district`, '     |     and     |     ', `districts1`.`station`), '') as 'district', IF(    CHAR_LENGTH(`driver1`.`drivers_name_and_surname`) || CHAR_LENGTH(`driver1`.`drivers_persal_number`), CONCAT_WS('',   `driver1`.`drivers_name_and_surname`, '      |    and    |         ', `driver1`.`drivers_persal_number`), '') as 'drivers_name_and_surname', IF(    CHAR_LENGTH(`driver1`.`drivers_persal_number`), CONCAT_WS('',   `driver1`.`drivers_persal_number`), '') as 'drivers_persal_number', IF(    CHAR_LENGTH(`departments2`.`department_name`), CONCAT_WS('',   `departments2`.`department_name`), '') as 'department_name_of_driver', IF(    CHAR_LENGTH(`driver1`.`drivers_contact_details`), CONCAT_WS('',   `driver1`.`drivers_contact_details`), '') as 'drivers_contact_details', `gmt_fleet_register`.`documents` as 'documents', if(`gmt_fleet_register`.`date_auctioned`,date_format(`gmt_fleet_register`.`date_auctioned`,'%d/%m/%Y'),'') as 'date_auctioned', `gmt_fleet_register`.`venue` as 'venue', `gmt_fleet_register`.`comments` as 'comments', DATE_FORMAT(`gmt_fleet_register`.`renewal_of_license`, '%b %D, %Y %l:%i%p') as 'renewal_of_license', `gmt_fleet_register`.`mm_code` as 'mm_code' FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver`  WHERE `gmt_fleet_register`.`fleet_asset_id`='{$id}' limit 1", $eo);
			$row = db_fetch_assoc($res);
			?>
			$j('#engine_number<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(["\r", "\n"], '', safe_html($row['engine_number']))); ?>&nbsp;');
			$j('#chassis_number<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(["\r", "\n"], '', safe_html($row['chassis_number'].' |  and  |     '.$row['vehicle_registration_number']))); ?>&nbsp;');
			$j('#model_of_vehicle<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(["\r", "\n"], '', safe_html($row['model_of_vehicle']))); ?>&nbsp;');
			$j('#year_model_of_vehicle<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(["\r", "\n"], '', safe_html($row['year_model_specification']))); ?>&nbsp;');
			$j('#type_of_vehicle<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(["\r", "\n"], '', safe_html($row['type_of_vehicle']))); ?>&nbsp;');
			$j('#application_status<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(["\r", "\n"], '', safe_html($row['application_status']))); ?>&nbsp;');
			$j('#barcode_number<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(["\r", "\n"], '', safe_html($row['barcode_number']))); ?>&nbsp;');
			$j('#department<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(["\r", "\n"], '', safe_html($row['department_name']))); ?>&nbsp;');
			<?php
			break;

		case 'dealer_name':
			if(!$id) {
				?>
				$j('#make_of_vehicle<?php echo $rnd1; ?>').html('&nbsp;');
				<?php
				break;
			}
			$res = sql("SELECT `dealer`.`dealer_id` as 'dealer_id', IF(    CHAR_LENGTH(`dealer_type1`.`dealer_type`), CONCAT_WS('',   `dealer_type1`.`dealer_type`), '') as 'dealer_type', `dealer`.`make_of_vehicle` as 'make_of_vehicle', `dealer`.`dealer_name` as 'dealer_name', `dealer`.`contact_person` as 'contact_person', `dealer`.`contact_details` as 'contact_details', `dealer`.`contact_email` as 'contact_email' FROM `dealer` LEFT JOIN `dealer_type` as dealer_type1 ON `dealer_type1`.`dealer_type_id`=`dealer`.`dealer_type`  WHERE `dealer`.`dealer_id`='{$id}' limit 1", $eo);
			$row = db_fetch_assoc($res);
			?>
			$j('#make_of_vehicle<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(["\r", "\n"], '', safe_html($row['make_of_vehicle']))); ?>&nbsp;');
			<?php
			break;

		case 'date_of_service':
			if(!$id) {
				?>
				$j('#time<?php echo $rnd1; ?>').html('&nbsp;');
				<?php
				break;
			}
			$res = sql("SELECT `schedule`.`schedule_id` as 'schedule_id', `schedule`.`title` as 'title', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`user_name_and_surname`), CONCAT_WS('',   `gmt_fleet_register1`.`user_name_and_surname`), '') as 'user_name_and_surname', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`user_contact_email`), CONCAT_WS('',   `gmt_fleet_register1`.`user_contact_email`), '') as 'user_contact_email', IF(    CHAR_LENGTH(`service_item_type1`.`service_item_type`), CONCAT_WS('',   `service_item_type1`.`service_item_type`, '  '), '') as 'service_item_type', IF(    CHAR_LENGTH(`service_item_type1`.`service_item_type_code`), CONCAT_WS('',   `service_item_type1`.`service_item_type_code`), '') as 'service_item_type_code', `schedule`.`application_status` as 'application_status', IF(    CHAR_LENGTH(`gmt_fleet_register2`.`vehicle_registration_number`), CONCAT_WS('',   `gmt_fleet_register2`.`vehicle_registration_number`), '') as 'vehicle_registration_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS('',   `gmt_fleet_register1`.`engine_number`), '') as 'engine_number', IF(    CHAR_LENGTH(`log_sheet1`.`closing_km`), CONCAT_WS('',   `log_sheet1`.`closing_km`, ' '), '') as 'closing_km', if(`schedule`.`date`,date_format(`schedule`.`date`,'%d/%m/%Y'),'') as 'date', `schedule`.`time` as 'time', IF(    CHAR_LENGTH(`districts1`.`station`) || CHAR_LENGTH(`districts1`.`district`), CONCAT_WS('',   `districts1`.`station`, '      |     and      |     ', `districts1`.`district`), '') as 'workshop_name', `schedule`.`diagnosis` as 'diagnosis', `schedule`.`prescription` as 'prescription', `schedule`.`comments` as 'comments' FROM `schedule` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`schedule`.`user_name_and_surname` LEFT JOIN `service_item_type` as service_item_type1 ON `service_item_type1`.`service_item_type_id`=`schedule`.`service_item_type` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register2 ON `gmt_fleet_register2`.`fleet_asset_id`=`schedule`.`vehicle_registration_number` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`schedule`.`closing_km` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`schedule`.`workshop_name`  WHERE `schedule`.`schedule_id`='{$id}' limit 1", $eo);
			$row = db_fetch_assoc($res);
			?>
			$j('#time<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(["\r", "\n"], '', safe_html($row['time']))); ?>&nbsp;');
			<?php
			break;

		case 'receptionist':
			if(!$id) {
				?>
				$j('#receptionist_contact_email<?php echo $rnd1; ?>').html('&nbsp;');
				$j('#workshop_name<?php echo $rnd1; ?>').html('&nbsp;');
				$j('#job_card_number<?php echo $rnd1; ?>').html('&nbsp;');
				<?php
				break;
			}
			$res = sql("SELECT `reception`.`reception_user_id` as 'reception_user_id', `reception`.`reception_name_and_surname` as 'reception_name_and_surname', `reception`.`reception_persal_number` as 'reception_persal_number', `reception`.`reception_contact_details` as 'reception_contact_details', `reception`.`reception_email_address` as 'reception_email_address', `reception`.`reception_signature` as 'reception_signature', DATE_FORMAT(`reception`.`date_of_vehicle_entrance`, '%e/%c/%Y %l:%i%p') as 'date_of_vehicle_entrance', `reception`.`service_status` as 'service_status', IF(    CHAR_LENGTH(`districts1`.`district`), CONCAT_WS('',   `districts1`.`district`), '') as 'district', IF(    CHAR_LENGTH(`districts1`.`station`), CONCAT_WS('',   `districts1`.`station`, '   |  and   |   '), '') as 'location', `reception`.`workshop_address` as 'workshop_address', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`), '') as 'vehicle_registration_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS('',   `gmt_fleet_register1`.`engine_number`), '') as 'engine_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`) || CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS('',   `gmt_fleet_register1`.`model_of_vehicle`, '   |    and     |     ', `dealer1`.`make_of_vehicle`, '   '), '') as 'make_of_vehicle', `reception`.`breakdown_of_vehicle` as 'breakdown_of_vehicle', `reception`.`description_of_vehicle_breakdown_notes` as 'description_of_vehicle_breakdown_notes', `reception`.`description_of_vehicle_report` as 'description_of_vehicle_report', `reception`.`upload_of_vehicle_report` as 'upload_of_vehicle_report', `reception`.`description_of_vehicle_breakdown` as 'description_of_vehicle_breakdown', `reception`.`job_card_number` as 'job_card_number', `reception`.`visual_inspection_form` as 'visual_inspection_form', `reception`.`damage_report` as 'damage_report', DATE_FORMAT(`reception`.`date_of_vehicle_exit`, '%e/%c/%Y %l:%i%p') as 'date_of_vehicle_exit', `reception`.`payment` as 'payment' FROM `reception` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`reception`.`district` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`reception`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle`  WHERE `reception`.`reception_user_id`='{$id}' limit 1", $eo);
			$row = db_fetch_assoc($res);
			?>
			$j('#receptionist_contact_email<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(["\r", "\n"], '', safe_html($row['reception_email_address'].'     |     and      |    '.$row['reception_contact_details']))); ?>&nbsp;');
			$j('#workshop_name<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(["\r", "\n"], '', safe_html($row['district']))); ?>&nbsp;');
			$j('#job_card_number<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(["\r", "\n"], '', safe_html($row['job_card_number'].''.$row['vehicle_registration_number']))); ?>&nbsp;');
			<?php
			break;


	}

?>