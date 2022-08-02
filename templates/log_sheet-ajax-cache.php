<?php
	$rdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'log_sheet';

		/* data for selected record, or defaults if none is selected */
		var data = {
			vehicle_registration_number: <?php echo json_encode(['id' => $rdata['vehicle_registration_number'], 'value' => $rdata['vehicle_registration_number'], 'text' => $jdata['vehicle_registration_number']]); ?>,
			register_number: <?php echo json_encode(['id' => $rdata['register_number'], 'value' => $rdata['register_number'], 'text' => $jdata['register_number']]); ?>,
			make_of_vehicle: <?php echo json_encode($jdata['make_of_vehicle']); ?>,
			model_of_vehicle: <?php echo json_encode(['id' => $rdata['model_of_vehicle'], 'value' => $rdata['model_of_vehicle'], 'text' => $jdata['model_of_vehicle']]); ?>,
			year_model_specification: <?php echo json_encode($jdata['year_model_specification']); ?>,
			colour_of_vehicle: <?php echo json_encode(['id' => $rdata['colour_of_vehicle'], 'value' => $rdata['colour_of_vehicle'], 'text' => $jdata['colour_of_vehicle']]); ?>,
			engine_capacity: <?php echo json_encode($jdata['engine_capacity']); ?>,
			district: <?php echo json_encode($jdata['district']); ?>,
			drivers_name_and_surname: <?php echo json_encode(['id' => $rdata['drivers_name_and_surname'], 'value' => $rdata['drivers_name_and_surname'], 'text' => $jdata['drivers_name_and_surname']]); ?>,
			drivers_persal_number: <?php echo json_encode($jdata['drivers_persal_number']); ?>,
			fuel_type: <?php echo json_encode(['id' => $rdata['fuel_type'], 'value' => $rdata['fuel_type'], 'text' => $jdata['fuel_type']]); ?>
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
				$j('#make_of_vehicle' + d[rnd]).html(data.make_of_vehicle);
				$j('#year_model_specification' + d[rnd]).html(data.year_model_specification);
				$j('#engine_capacity' + d[rnd]).html(data.engine_capacity);
				$j('#district' + d[rnd]).html(data.district);
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

		/* saved value for model_of_vehicle */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'model_of_vehicle' && d.id == data.model_of_vehicle.id)
				return { results: [ data.model_of_vehicle ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for colour_of_vehicle */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'colour_of_vehicle' && d.id == data.colour_of_vehicle.id)
				return { results: [ data.colour_of_vehicle ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for drivers_name_and_surname */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'drivers_name_and_surname' && d.id == data.drivers_name_and_surname.id)
				return { results: [ data.drivers_name_and_surname ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for drivers_name_and_surname autofills */
		cache.addCheck(function(u, d) {
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'drivers_name_and_surname' && d.id == data.drivers_name_and_surname.id) {
				$j('#drivers_persal_number' + d[rnd]).html(data.drivers_persal_number);
				return true;
			}

			return false;
		});

		/* saved value for fuel_type */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'fuel_type' && d.id == data.fuel_type.id)
				return { results: [ data.fuel_type ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

