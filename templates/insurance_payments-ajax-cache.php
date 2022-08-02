<?php
	$rdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'insurance_payments';

		/* data for selected record, or defaults if none is selected */
		var data = {
			vehicle_registration_number: <?php echo json_encode(['id' => $rdata['vehicle_registration_number'], 'value' => $rdata['vehicle_registration_number'], 'text' => $jdata['vehicle_registration_number']]); ?>,
			engine_number: <?php echo json_encode($jdata['engine_number']); ?>,
			chassis_number: <?php echo json_encode($jdata['chassis_number']); ?>,
			make_of_vehicle: <?php echo json_encode($jdata['make_of_vehicle']); ?>,
			model_of_vehicle: <?php echo json_encode($jdata['model_of_vehicle']); ?>,
			year_model_of_vehicle: <?php echo json_encode($jdata['year_model_of_vehicle']); ?>,
			type_of_vehicle: <?php echo json_encode($jdata['type_of_vehicle']); ?>,
			application_status: <?php echo json_encode($jdata['application_status']); ?>,
			barcode_number: <?php echo json_encode($jdata['barcode_number']); ?>,
			department: <?php echo json_encode($jdata['department']); ?>,
			merchant_name: <?php echo json_encode(['id' => $rdata['merchant_name'], 'value' => $rdata['merchant_name'], 'text' => $jdata['merchant_name']]); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for vehicle_registration_number */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'vehicle_registration_number' && d.id == data.vehicle_registration_number.id)
				return { results: [ data.vehicle_registration_number ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for vehicle_registration_number autofills */
		cache.addCheck(function(u, d) {
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'vehicle_registration_number' && d.id == data.vehicle_registration_number.id) {
				$j('#engine_number' + d[rnd]).html(data.engine_number);
				$j('#chassis_number' + d[rnd]).html(data.chassis_number);
				$j('#make_of_vehicle' + d[rnd]).html(data.make_of_vehicle);
				$j('#model_of_vehicle' + d[rnd]).html(data.model_of_vehicle);
				$j('#year_model_of_vehicle' + d[rnd]).html(data.year_model_of_vehicle);
				$j('#type_of_vehicle' + d[rnd]).html(data.type_of_vehicle);
				$j('#application_status' + d[rnd]).html(data.application_status);
				$j('#barcode_number' + d[rnd]).html(data.barcode_number);
				$j('#department' + d[rnd]).html(data.department);
				return true;
			}

			return false;
		});

		/* saved value for merchant_name */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'merchant_name' && d.id == data.merchant_name.id)
				return { results: [ data.merchant_name ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

