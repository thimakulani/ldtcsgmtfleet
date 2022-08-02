<?php
	include_once(__DIR__ . '/lib.php');

	handle_maintenance();

	// image paths
	$p = [
		'gmt_fleet_register' => [
			'photo_of_vehicle' => getUploadDir(''),
		],
		'service_records' => [
			'image_1' => getUploadDir(''),
			'image_2' => getUploadDir(''),
			'image_3' => getUploadDir(''),
			'image_4' => getUploadDir(''),
			'image_5' => getUploadDir(''),
		],
		'accidents' => [
			'upload_photos_damaged_vehicle' => getUploadDir(''),
		],
		'modification_to_vehicle' => [
			'driver_signature' => getUploadDir(''),
			'testing_officer_signature' => getUploadDir(''),
			'supervisor_for_allocation_signature' => getUploadDir(''),
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
		],
		'indicates_repair_damages_found_list' => [
			'driver_signature' => getUploadDir(''),
			'company_repesentative_signature' => getUploadDir(''),
		],
		'identification_of_defects' => [
			'end_user_signature' => getUploadDir(''),
			'transport_officer_email_address' => getUploadDir(''),
			'government_garage_manager_signature' => getUploadDir(''),
		],
		'reception' => [
			'reception_signature' => getUploadDir(''),
		],
		'inspection_bay' => [
			'supervisor_signature' => getUploadDir(''),
		],
		'work_allocation' => [
			'supervisor_signature' => getUploadDir(''),
		],
		'internal_repairs_mechanical' => [
			'artisan_signature' => getUploadDir(''),
		],
		'external_repairs_mechanical' => [
			'department_inspector_signature' => getUploadDir(''),
			'service_provider_signature' => getUploadDir(''),
			'merchant_signature' => getUploadDir(''),
		],
		'internal_repairs_body' => [
			'driver_signature' => getUploadDir(''),
			'upload_of_internal_damages_1' => getUploadDir(''),
			'upload_of_internal_damages_2' => getUploadDir(''),
			'upload_of_internal_damages_3' => getUploadDir(''),
			'upload_of_internal_damages_4' => getUploadDir(''),
			'head_panel_beating_signature' => getUploadDir(''),
		],
		'external_repairs_body' => [
			'head_panel_beating_signature' => getUploadDir(''),
			'service_provider_signature' => getUploadDir(''),
			'merchant_signature' => getUploadDir(''),
		],
		'ordering_of_spares_for_internal_repairs' => [
			'artisan_signature' => getUploadDir(''),
		],
		'collection_of_repaired_vehicles' => [
			'reception_signature' => getUploadDir(''),
			'driver_signature' => getUploadDir(''),
		],
		'costing' => [
			'supervisor_signature' => getUploadDir(''),
			'costing_officer_signature' => getUploadDir(''),
			'workshop_manager_signature' => getUploadDir(''),
		],
		'vehicle_annual_inspection' => [
			'photo_of_vehicle' => getUploadDir(''),
		],
	];

	if(!count($p)) exit;

	// receive user input
	$t = Request::val('t'); // table name
	$f = Request::val('f'); // field name
	$v = Request::val('v'); // thumbnail view type: 'tv' or 'dv'
	$i = Request::val('i'); // original image file name

	// validate input
	if(!in_array($t, array_keys($p)))  getImage();
	if(!in_array($f, array_keys($p[$t])))  getImage();
	if(!preg_match('/^[a-z0-9_-]+\.(jpg|jpeg|gif|png|webp)$/i', $i, $m)) getImage();
	if($v != 'tv' && $v != 'dv')   getImage();
	if($i == 'blank.gif') getImage();

	$img = $p[$t][$f] . $i;
	$thumb = str_replace(".{$m[1]}ffffgggg", "_$v.{$m[1]}", $img . 'ffffgggg');

	// if thumbnail exists and the user is not admin, output it without rebuilding the thumbnail
	if(getImage($thumb) && !getLoggedAdmin())  exit;

	// otherwise, try to create the thumbnail and output it
	if(!createThumbnail($img, getThumbnailSpecs($t, $f, $v)))  getImage();
	if(!getImage($thumb))  getImage();

	function getImage($img = '') {
		if(!$img) { // default image to return
			$img = './photo.gif';
			$exit = true;
		}

		/* force caching */
		$last_modified = @filemtime($img);
		if($last_modified) {
			$last_modified_gmt = gmdate('D, d M Y H:i:s', $last_modified) . ' GMT';
			$expires_gmt = gmdate('D, d M Y H:i:s', $last_modified + 864000) . ' GMT';
			$headers = (function_exists('getallheaders') ? getallheaders() : $_SERVER);
			if(isset($headers['If-Modified-Since']) && (strtotime($headers['If-Modified-Since']) == $last_modified)) {
				@header("Last-Modified: {$last_modified_gmt}", true, 304);
				@header("Cache-Control: private, max-age=864000", true);
				@header("Expires: {$expires_gmt}");
				exit;
			}
		}

		$thumbInfo = @getimagesize($img);
		$fp = @fopen($img, 'rb');
		if($thumbInfo && $fp) {
			$file_size = filesize($img);
			@header("Last-Modified: {$last_modified_gmt}", true, 200);
			@header("Pragma:");
			@header("Cache-Control: private, max-age=864000", true);
			@header("Content-type: {$thumbInfo['mime']}");
			@header("Content-Length: {$file_size}");
			@header("Expires: {$expires_gmt}");
			ob_end_clean();
			@fpassthru($fp);
			if(!$exit) return true; else exit;
		}

		if(!$exit) return false; else exit;
	}
