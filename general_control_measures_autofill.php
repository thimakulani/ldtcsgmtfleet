<?php
// This script and data application were generated by AppGini 22.13
// Download AppGini for free from https://bigprof.com/appgini/download/

	include_once(__DIR__ . '/lib.php');

	handle_maintenance();

	header('Content-type: text/javascript; charset=' . datalist_db_encoding);

	$table_perms = getTablePermissions('general_control_measures');
	if(!$table_perms['access']) die('// Access denied!');

	$mfk = Request::val('mfk');
	$id = makeSafe(Request::val('id'));
	$rnd1 = intval(Request::val('rnd1')); if(!$rnd1) $rnd1 = '';

	if(!$mfk) {
		die('// No js code available!');
	}

	switch($mfk) {

		case 'district':
			if(!$id) {
				?>
				$j('#location<?php echo $rnd1; ?>').html('&nbsp;');
				<?php
				break;
			}
			$res = sql("SELECT `districts`.`district_id` as 'district_id', `districts`.`district` as 'district', `districts`.`station` as 'station' FROM `districts`  WHERE `districts`.`district_id`='{$id}' limit 1", $eo);
			$row = db_fetch_assoc($res);
			?>
			$j('#location<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(["\r", "\n"], '', safe_html($row['station']))); ?>&nbsp;');
			<?php
			break;


	}

?>