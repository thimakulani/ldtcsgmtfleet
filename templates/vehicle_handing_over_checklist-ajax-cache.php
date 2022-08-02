<?php
	$rdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'vehicle_handing_over_checklist';

		/* data for selected record, or defaults if none is selected */
		var data = {
			vehicle_registration_number: <?php echo json_encode(['id' => $rdata['vehicle_registration_number'], 'value' => $rdata['vehicle_registration_number'], 'text' => $jdata['vehicle_registration_number']]); ?>,
			closing_km: <?php echo json_encode($jdata['closing_km']); ?>,
			make_of_vehicle: <?php echo json_encode($jdata['make_of_vehicle']); ?>,
			model_of_vehicle: <?php echo json_encode($jdata['model_of_vehicle']); ?>,
			authorization_number: <?php echo json_encode(['id' => $rdata['authorization_number'], 'value' => $rdata['authorization_number'], 'text' => $jdata['authorization_number']]); ?>,
			driver_name_and_surname: <?php echo json_encode(['id' => $rdata['driver_name_and_surname'], 'value' => $rdata['driver_name_and_surname'], 'text' => $jdata['driver_name_and_surname']]); ?>,
			driver_persal_number: <?php echo json_encode($jdata['driver_persal_number']); ?>
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
				$j('#closing_km' + d[rnd]).html(data.closing_km);
				$j('#make_of_vehicle' + d[rnd]).html(data.make_of_vehicle);
				$j('#model_of_vehicle' + d[rnd]).html(data.model_of_vehicle);
				return true;
			}

			return false;
		});

		/* saved value for authorization_number */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'authorization_number' && d.id == data.authorization_number.id)
				return { results: [ data.authorization_number ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for driver_name_and_surname */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'driver_name_and_surname' && d.id == data.driver_name_and_surname.id)
				return { results: [ data.driver_name_and_surname ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for driver_name_and_surname autofills */
		cache.addCheck(function(u, d) {
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'driver_name_and_surname' && d.id == data.driver_name_and_surname.id) {
				$j('#driver_persal_number' + d[rnd]).html(data.driver_persal_number);
				return true;
			}

			return false;
		});

		cache.start();
	});
</script>

