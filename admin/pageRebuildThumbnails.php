<?php
	require(__DIR__ . '/incCommon.php');
	$GLOBALS['page_title'] = $Translation['rebuild thumbnails'];
	include(__DIR__ . '/incHeader.php');

	// image paths
	$p = [
		'gmt_fleet_register' => [
			'photo_of_vehicle' => '../' . getUploadDir(''),
		],
		'service_records' => [
			'image_1' => '../' . getUploadDir(''),
			'image_2' => '../' . getUploadDir(''),
			'image_3' => '../' . getUploadDir(''),
			'image_4' => '../' . getUploadDir(''),
			'image_5' => '../' . getUploadDir(''),
		],
		'accidents' => [
			'upload_photos_damaged_vehicle' => '../' . getUploadDir(''),
		],
		'modification_to_vehicle' => [
			'driver_signature' => '../' . getUploadDir(''),
			'testing_officer_signature' => '../' . getUploadDir(''),
			'supervisor_for_allocation_signature' => '../' . getUploadDir(''),
		],
		'vehicle_handing_over_checklist' => [
			'driver_signature' => '../' . getUploadDir(''),
			'testing_officer_signature' => '../' . getUploadDir(''),
			'vehicle_marks_1' => '../' . getUploadDir(''),
			'vehicle_marks_2' => '../' . getUploadDir(''),
			'vehicle_marks_3' => '../' . getUploadDir(''),
			'vehicle_marks_4' => '../' . getUploadDir(''),
			'vehicle_marks_5' => '../' . getUploadDir(''),
			'vehicle_marks_6' => '../' . getUploadDir(''),
			'vehicle_marks_7' => '../' . getUploadDir(''),
			'vehicle_marks_8' => '../' . getUploadDir(''),
		],
		'vehicle_return_check_list' => [
			'driver_signature' => '../' . getUploadDir(''),
			'testing_officer_signature' => '../' . getUploadDir(''),
			'vehicle_marks_1' => '../' . getUploadDir(''),
			'vehicle_marks_2' => '../' . getUploadDir(''),
			'vehicle_marks_3' => '../' . getUploadDir(''),
			'vehicle_marks_4' => '../' . getUploadDir(''),
			'vehicle_marks_5' => '../' . getUploadDir(''),
			'vehicle_marks_6' => '../' . getUploadDir(''),
			'vehicle_marks_7' => '../' . getUploadDir(''),
			'vehicle_marks_8' => '../' . getUploadDir(''),
		],
		'indicates_repair_damages_found_list' => [
			'driver_signature' => '../' . getUploadDir(''),
			'company_repesentative_signature' => '../' . getUploadDir(''),
		],
		'identification_of_defects' => [
			'end_user_signature' => '../' . getUploadDir(''),
			'transport_officer_email_address' => '../' . getUploadDir(''),
			'government_garage_manager_signature' => '../' . getUploadDir(''),
		],
		'reception' => [
			'reception_signature' => '../' . getUploadDir(''),
		],
		'inspection_bay' => [
			'supervisor_signature' => '../' . getUploadDir(''),
		],
		'work_allocation' => [
			'supervisor_signature' => '../' . getUploadDir(''),
		],
		'internal_repairs_mechanical' => [
			'artisan_signature' => '../' . getUploadDir(''),
		],
		'external_repairs_mechanical' => [
			'department_inspector_signature' => '../' . getUploadDir(''),
			'service_provider_signature' => '../' . getUploadDir(''),
			'merchant_signature' => '../' . getUploadDir(''),
		],
		'internal_repairs_body' => [
			'driver_signature' => '../' . getUploadDir(''),
			'upload_of_internal_damages_1' => '../' . getUploadDir(''),
			'upload_of_internal_damages_2' => '../' . getUploadDir(''),
			'upload_of_internal_damages_3' => '../' . getUploadDir(''),
			'upload_of_internal_damages_4' => '../' . getUploadDir(''),
			'head_panel_beating_signature' => '../' . getUploadDir(''),
		],
		'external_repairs_body' => [
			'head_panel_beating_signature' => '../' . getUploadDir(''),
			'service_provider_signature' => '../' . getUploadDir(''),
			'merchant_signature' => '../' . getUploadDir(''),
		],
		'ordering_of_spares_for_internal_repairs' => [
			'artisan_signature' => '../' . getUploadDir(''),
		],
		'collection_of_repaired_vehicles' => [
			'reception_signature' => '../' . getUploadDir(''),
			'driver_signature' => '../' . getUploadDir(''),
		],
		'costing' => [
			'supervisor_signature' => '../' . getUploadDir(''),
			'costing_officer_signature' => '../' . getUploadDir(''),
			'workshop_manager_signature' => '../' . getUploadDir(''),
		],
		'vehicle_annual_inspection' => [
			'photo_of_vehicle' => '../' . getUploadDir(''),
		],
	];

	if(!count($p)) exit;

	// validate input
	$t = Request::val('table');
	if(!in_array($t, array_keys($p))) {
		?>
		<div class="page-header"><h1><?php echo $Translation['rebuild thumbnails']; ?></h1></div>
		<form method="get" action="pageRebuildThumbnails.php" target="_blank">
			<?php echo $Translation['thumbnails utility']; ?><br><br>

			<b><?php echo $Translation['rebuild thumbnails of table'] ; ?></b> 
			<?php echo htmlSelect('table', array_keys($p), array_keys($p), ''); ?>
			<input type="submit" value="<?php echo $Translation['rebuild'] ; ?>">
		</form>


		<?php
		include(__DIR__ . '/incFooter.php');
		exit;
	}

	?>
	<div class="page-header"><h1><?php echo str_replace ( "<TABLENAME>" , $t , $Translation['rebuild thumbnails of table_name'] ); ?></h1></div>
	<?php echo $Translation['do not close page message'] ; ?><br><br>
	<div style="font-weight: bold; color: red; width:700px;" id="status"><?php echo $Translation['rebuild thumbnails status'] ; ?></div>
	<br>

	<div style="text-align:left; padding: 0 5px; width:700px; height:250px;overflow:auto; border: solid 1px green;">
	<?php
		foreach($p[$t] as $f=>$path) {
			$res=sql("select `$f` from `$t`", $eo);
			echo str_replace ( "<FIELD>" , $f , $Translation['building field thumbnails'] )."<br>";
			$tv = $dv = [];
			while($row=db_fetch_row($res)) {
				if($row[0]!='') {
					$tv[]=$row[0];
					$dv[]=$row[0];
				}
			}
			for($i=0; $i<count($tv); $i++) {
				if($i && !($i%4))  echo '<br style="clear: left;">';
				echo '<img src="../thumbnail.php?t='.$t.'&f='.$f.'&i='.$tv[$i].'&v=tv" align="left" style="margin: 10px 10px;"> ';
			}
			echo '<br style="clear: left;">';

			for($i=0; $i<count($dv); $i++) {
				if($i && !($i%4))  echo '<br style="clear: left;">';
				echo '<img src="../thumbnail.php?t='.$t.'&f='.$f.'&i='.$tv[$i].'&v=dv" align="left" style="margin: 10px 10px;"> ';
			}
			echo "<br style='clear: left;'>{$Translation['done']}<br><br>";
		}
	?>
	</div>

	<script>
		window.onload = function() {
			document.getElementById('status').innerHTML = "<?php echo $Translation['finished status'] ; ?>";
			document.getElementById('status').style.color = 'green';
			document.getElementById('status').style.fontSize = '25px';
			document.getElementById('status').style.backgroundColor = '#fff4cf';
		}
	</script>

<?php include(__DIR__ . '/incFooter.php');