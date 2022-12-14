<?php
// This script and data application were generated by AppGini 22.13
// Download AppGini for free from https://bigprof.com/appgini/download/

	include_once(__DIR__ . '/lib.php');

	handle_maintenance();

	header('Content-type: text/javascript; charset=' . datalist_db_encoding);

	$table_perms = getTablePermissions('external_repairs_body');
	if(!$table_perms['access']) die('// Access denied!');

	$mfk = Request::val('mfk');
	$id = makeSafe(Request::val('id'));
	$rnd1 = intval(Request::val('rnd1')); if(!$rnd1) $rnd1 = '';

	if(!$mfk) {
		die('// No js code available!');
	}

	switch($mfk) {

		case 'instruction_note':
			if(!$id) {
				?>
				$j('#authorization_number<?php echo $rnd1; ?>').html('&nbsp;');
				<?php
				break;
			}
			$res = sql("SELECT `claim`.`claim_id` as 'claim_id', `claim`.`claim_code` as 'claim_code', IF(    CHAR_LENGTH(`claim_status1`.`claim_status`), CONCAT_WS('',   `claim_status1`.`claim_status`), '') as 'claim_status', IF(    CHAR_LENGTH(`claim_category1`.`claim_category`), CONCAT_WS('',   `claim_category1`.`claim_category`), '') as 'claim_category', IF(    CHAR_LENGTH(`cost_centre1`.`cost_centre`), CONCAT_WS('',   `cost_centre1`.`cost_centre`), '') as 'cost_centre', `claim`.`client_identification` as 'client_identification', IF(    CHAR_LENGTH(`departments1`.`department_name`), CONCAT_WS('',   `departments1`.`department_name`), '') as 'department_name', IF(    CHAR_LENGTH(`districts1`.`district`), CONCAT_WS('',   `districts1`.`district`), '') as 'district', IF(    CHAR_LENGTH(`province1`.`province`), CONCAT_WS('',   `province1`.`province`), '') as 'province', IF(    CHAR_LENGTH(`merchant1`.`merchant_name`) || CHAR_LENGTH(`merchant1`.`merchant_code`), CONCAT_WS('',   `merchant1`.`merchant_name`, '     |   and    |   ', `merchant1`.`merchant_code`), '') as 'merchant_name', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`) || CHAR_LENGTH(`gmt_fleet_register1`.`chassis_number`), CONCAT_WS('',   `gmt_fleet_register1`.`vehicle_registration_number`, '    |   and    |  ', `gmt_fleet_register1`.`chassis_number`), '') as 'vehicle_registration_number', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`) || CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS('',   `gmt_fleet_register1`.`model_of_vehicle`, ' |   and    |    ', `gmt_fleet_register1`.`vehicle_registration_number`), '') as 'model', IF(    CHAR_LENGTH(`log_sheet1`.`closing_km`), CONCAT_WS('',   `log_sheet1`.`closing_km`), '') as 'closing_km', DATE_FORMAT(`claim`.`pre_authorization_date`, '%D %b %Y %l:%i%p') as 'pre_authorization_date', `claim`.`instruction_note` as 'instruction_note', DATE_FORMAT(`claim`.`invoice_date`, '%D %b %Y %l:%i%p') as 'invoice_date', `claim`.`upload_invoice` as 'upload_invoice', DATE_FORMAT(`claim`.`payment_date`, '%D %b %Y %l:%i%p') as 'payment_date', `claim`.`authorization_number` as 'authorization_number', `claim`.`clearance_number` as 'clearance_number', DATE_FORMAT(`claim`.`vehicle_collected_date`, '%D %b %Y %l:%i%p') as 'vehicle_collected_date', `claim`.`total_claimed` as 'total_claimed', `claim`.`total_authorized` as 'total_authorized' FROM `claim` LEFT JOIN `claim_status` as claim_status1 ON `claim_status1`.`claim_status_id`=`claim`.`claim_status` LEFT JOIN `claim_category` as claim_category1 ON `claim_category1`.`claim_category_id`=`claim`.`claim_category` LEFT JOIN `cost_centre` as cost_centre1 ON `cost_centre1`.`cost_centre_id`=`claim`.`cost_centre` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`claim`.`department_name` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`claim`.`district` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`claim`.`province` LEFT JOIN `merchant` as merchant1 ON `merchant1`.`merchant_id`=`claim`.`merchant_name` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`claim`.`vehicle_registration_number` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`claim`.`closing_km`  WHERE `claim`.`claim_id`='{$id}' limit 1", $eo);
			$row = db_fetch_assoc($res);
			?>
			$j('#authorization_number<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(["\r", "\n"], '', safe_html($row['authorization_number'].'     |   and   |     '.$row['claim_code']))); ?>&nbsp;');
			<?php
			break;

		case 'vehicle_registration_number':
			if(!$id) {
				?>
				$j('#engine_number<?php echo $rnd1; ?>').html('&nbsp;');
				$j('#make_of_vehicle<?php echo $rnd1; ?>').html('&nbsp;');
				$j('#vehicle_colour<?php echo $rnd1; ?>').html('&nbsp;');
				<?php
				break;
			}
			$res = sql("SELECT `gmt_fleet_register`.`fleet_asset_id` as 'fleet_asset_id', `gmt_fleet_register`.`vehicle_registration_number` as 'vehicle_registration_number', `gmt_fleet_register`.`register_number` as 'register_number', `gmt_fleet_register`.`engine_number` as 'engine_number', `gmt_fleet_register`.`chassis_number` as 'chassis_number', IF(    CHAR_LENGTH(`dealer1`.`dealer_name`), CONCAT_WS('',   `dealer1`.`dealer_name`), '') as 'dealer_name', IF(    CHAR_LENGTH(`dealer2`.`make_of_vehicle`), CONCAT_WS('',   `dealer2`.`make_of_vehicle`, '   '), '') as 'make_of_vehicle', `gmt_fleet_register`.`model_of_vehicle` as 'model_of_vehicle', IF(    CHAR_LENGTH(`year_model1`.`year_model_specification`), CONCAT_WS('',   `year_model1`.`year_model_specification`), '') as 'year_model_specification', `gmt_fleet_register`.`engine_capacity` as 'engine_capacity', `gmt_fleet_register`.`tyre_size` as 'tyre_size', IF(    CHAR_LENGTH(`transmission1`.`transmission`), CONCAT_WS('',   `transmission1`.`transmission`), '') as 'transmission', IF(    CHAR_LENGTH(`fuel_type1`.`fuel_type`), CONCAT_WS('',   `fuel_type1`.`fuel_type`), '') as 'fuel_type', IF(    CHAR_LENGTH(`body_type1`.`type_of_vehicle`), CONCAT_WS('',   `body_type1`.`type_of_vehicle`), '') as 'type_of_vehicle', IF(    CHAR_LENGTH(`vehicle_colour1`.`colour_of_vehicle`), CONCAT_WS('',   `vehicle_colour1`.`colour_of_vehicle`), '') as 'colour_of_vehicle', IF(    CHAR_LENGTH(`application_status1`.`application_status`), CONCAT_WS('',   `application_status1`.`application_status`), '') as 'application_status', `gmt_fleet_register`.`case_number` as 'case_number', `gmt_fleet_register`.`barcode_number` as 'barcode_number', `gmt_fleet_register`.`purchase_price` as 'purchase_price', `gmt_fleet_register`.`depreciation_value` as 'depreciation_value', `gmt_fleet_register`.`photo_of_vehicle` as 'photo_of_vehicle', `gmt_fleet_register`.`user_name_and_surname` as 'user_name_and_surname', `gmt_fleet_register`.`user_contact_email` as 'user_contact_email', `gmt_fleet_register`.`contact_number` as 'contact_number', IF(    CHAR_LENGTH(`departments1`.`department_name`), CONCAT_WS('',   `departments1`.`department_name`), '') as 'department_name', `gmt_fleet_register`.`department_address` as 'department_address', IF(    CHAR_LENGTH(`province1`.`province`), CONCAT_WS('',   `province1`.`province`), '') as 'province', IF(    CHAR_LENGTH(`districts1`.`district`) || CHAR_LENGTH(`districts1`.`station`), CONCAT_WS('',   `districts1`.`district`, '     |     and     |     ', `districts1`.`station`), '') as 'district', IF(    CHAR_LENGTH(`driver1`.`drivers_name_and_surname`) || CHAR_LENGTH(`driver1`.`drivers_persal_number`), CONCAT_WS('',   `driver1`.`drivers_name_and_surname`, '      |    and    |         ', `driver1`.`drivers_persal_number`), '') as 'drivers_name_and_surname', IF(    CHAR_LENGTH(`driver1`.`drivers_persal_number`), CONCAT_WS('',   `driver1`.`drivers_persal_number`), '') as 'drivers_persal_number', IF(    CHAR_LENGTH(`departments2`.`department_name`), CONCAT_WS('',   `departments2`.`department_name`), '') as 'department_name_of_driver', IF(    CHAR_LENGTH(`driver1`.`drivers_contact_details`), CONCAT_WS('',   `driver1`.`drivers_contact_details`), '') as 'drivers_contact_details', `gmt_fleet_register`.`documents` as 'documents', if(`gmt_fleet_register`.`date_auctioned`,date_format(`gmt_fleet_register`.`date_auctioned`,'%d/%m/%Y'),'') as 'date_auctioned', `gmt_fleet_register`.`venue` as 'venue', `gmt_fleet_register`.`comments` as 'comments', DATE_FORMAT(`gmt_fleet_register`.`renewal_of_license`, '%b %D, %Y %l:%i%p') as 'renewal_of_license', `gmt_fleet_register`.`mm_code` as 'mm_code' FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver`  WHERE `gmt_fleet_register`.`fleet_asset_id`='{$id}' limit 1", $eo);
			$row = db_fetch_assoc($res);
			?>
			$j('#engine_number<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(["\r", "\n"], '', safe_html($row['engine_number']))); ?>&nbsp;');
			$j('#make_of_vehicle<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(["\r", "\n"], '', safe_html($row['model_of_vehicle'].'   |    and     |     '.$row['make_of_vehicle']))); ?>&nbsp;');
			$j('#vehicle_colour<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(["\r", "\n"], '', safe_html($row['colour_of_vehicle']))); ?>&nbsp;');
			<?php
			break;


	}

?>