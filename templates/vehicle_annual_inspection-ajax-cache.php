<?php
	$rdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'vehicle_annual_inspection';

		/* data for selected record, or defaults if none is selected */
		var data = {
			vehicle_registration_number: <?php echo json_encode(['id' => $rdata['vehicle_registration_number'], 'value' => $rdata['vehicle_registration_number'], 'text' => $jdata['vehicle_registration_number']]); ?>,
			register_number: <?php echo json_encode(['id' => $rdata['register_number'], 'value' => $rdata['register_number'], 'text' => $jdata['register_number']]); ?>,
			engine_number: <?php echo json_encode($jdata['engine_number']); ?>,
			chassis_number: <?php echo json_encode($jdata['chassis_number']); ?>,
			make_of_vehicle: <?php echo json_encode($jdata['make_of_vehicle']); ?>,
			model_of_vehicle: <?php echo json_encode($jdata['model_of_vehicle']); ?>,
			year_model_specification: <?php echo json_encode($jdata['year_model_specification']); ?>,
			engine_capacity: <?php echo json_encode($jdata['engine_capacity']); ?>,
			tyre_size: <?php echo json_encode($jdata['tyre_size']); ?>,
			transmission: <?php echo json_encode($jdata['transmission']); ?>,
			fuel_type: <?php echo json_encode($jdata['fuel_type']); ?>,
			type_of_vehicle: <?php echo json_encode($jdata['type_of_vehicle']); ?>,
			colour_of_vehicle: <?php echo json_encode($jdata['colour_of_vehicle']); ?>,
			application_status: <?php echo json_encode($jdata['application_status']); ?>,
			renewal_of_license: <?php echo json_encode($jdata['renewal_of_license']); ?>,
			barcode_number: <?php echo json_encode($jdata['barcode_number']); ?>,
			department_name: <?php echo json_encode(['id' => $rdata['department_name'], 'value' => $rdata['department_name'], 'text' => $jdata['department_name']]); ?>,
			province: <?php echo json_encode(['id' => $rdata['province'], 'value' => $rdata['province'], 'text' => $jdata['province']]); ?>,
			district: <?php echo json_encode(['id' => $rdata['district'], 'value' => $rdata['district'], 'text' => $jdata['district']]); ?>
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
				$j('#year_model_specification' + d[rnd]).html(data.year_model_specification);
				$j('#engine_capacity' + d[rnd]).html(data.engine_capacity);
				$j('#tyre_size' + d[rnd]).html(data.tyre_size);
				$j('#transmission' + d[rnd]).html(data.transmission);
				$j('#fuel_type' + d[rnd]).html(data.fuel_type);
				$j('#type_of_vehicle' + d[rnd]).html(data.type_of_vehicle);
				$j('#colour_of_vehicle' + d[rnd]).html(data.colour_of_vehicle);
				$j('#application_status' + d[rnd]).html(data.application_status);
				$j('#renewal_of_license' + d[rnd]).html(data.renewal_of_license);
				$j('#barcode_number' + d[rnd]).html(data.barcode_number);
				return true;
			}

			return false;
		});

		/* saved value for register_number */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'register_number' && d.id == data.register_number.id)
				return { results: [ data.register_number ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for department_name */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'department_name' && d.id == data.department_name.id)
				return { results: [ data.department_name ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for province */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'province' && d.id == data.province.id)
				return { results: [ data.province ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for district */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'district' && d.id == data.district.id)
				return { results: [ data.district ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

