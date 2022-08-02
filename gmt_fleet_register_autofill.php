<?php
// This script and data application were generated by AppGini 22.13
// Download AppGini for free from https://bigprof.com/appgini/download/

	include_once(__DIR__ . '/lib.php');

	handle_maintenance();

	header('Content-type: text/javascript; charset=' . datalist_db_encoding);

	$table_perms = getTablePermissions('gmt_fleet_register');
	if(!$table_perms['access']) die('// Access denied!');

	$mfk = Request::val('mfk');
	$id = makeSafe(Request::val('id'));
	$rnd1 = intval(Request::val('rnd1')); if(!$rnd1) $rnd1 = '';

	if(!$mfk) {
		die('// No js code available!');
	}

	switch($mfk) {

		case 'drivers_name_and_surname':
			if(!$id) {
				?>
				$j('#drivers_persal_number<?php echo $rnd1; ?>').html('&nbsp;');
				$j('#drivers_contact_details<?php echo $rnd1; ?>').html('&nbsp;');
				<?php
				break;
			}
			$res = sql("SELECT `driver`.`driver_id` as 'driver_id', `driver`.`drivers_name_and_surname` as 'drivers_name_and_surname', `driver`.`drivers_persal_number` as 'drivers_persal_number', CONCAT_WS('-', LEFT(`driver`.`drivers_contact_details`,3), MID(`driver`.`drivers_contact_details`,4,3), RIGHT(`driver`.`drivers_contact_details`,4)) as 'drivers_contact_details', `driver`.`drivers_email_address` as 'drivers_email_address', `driver`.`drivers_license` as 'drivers_license', `driver`.`drivers_license_code` as 'drivers_license_code', `driver`.`drivers_license_number` as 'drivers_license_number', `driver`.`drivers_license_upload` as 'drivers_license_upload', if(`driver`.`drivers_license_expire_date`,date_format(`driver`.`drivers_license_expire_date`,'%d/%m/%Y'),'') as 'drivers_license_expire_date', if(`driver`.`drivers_license_renewal_date`,date_format(`driver`.`drivers_license_renewal_date`,'%d/%m/%Y'),'') as 'drivers_license_renewal_date', `driver`.`drivers_log_history` as 'drivers_log_history', `driver`.`drivers_license_penalties` as 'drivers_license_penalties', if(`driver`.`drivers_license_penalties_date`,date_format(`driver`.`drivers_license_penalties_date`,'%d/%m/%Y'),'') as 'drivers_license_penalties_date', `driver`.`drivers_license_penalty_details` as 'drivers_license_penalty_details', `driver`.`drivers_license_penalty_details_uploads` as 'drivers_license_penalty_details_uploads', `driver`.`involved_in_accident` as 'involved_in_accident', `driver`.`accident_report` as 'accident_report' FROM `driver`  WHERE `driver`.`driver_id`='{$id}' limit 1", $eo);
			$row = db_fetch_assoc($res);
			?>
			$j('#drivers_persal_number<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(["\r", "\n"], '', safe_html($row['drivers_persal_number']))); ?>&nbsp;');
			$j('#drivers_contact_details<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(["\r", "\n"], '', safe_html($row['drivers_contact_details']))); ?>&nbsp;');
			<?php
			break;


	}

?>