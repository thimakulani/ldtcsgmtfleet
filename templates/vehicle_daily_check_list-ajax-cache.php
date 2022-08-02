<?php
	$rdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'vehicle_daily_check_list';

		/* data for selected record, or defaults if none is selected */
		var data = {
			vehicle_registration_number: <?php echo json_encode(['id' => $rdata['vehicle_registration_number'], 'value' => $rdata['vehicle_registration_number'], 'text' => $jdata['vehicle_registration_number']]); ?>,
			make_of_vehicle: <?php echo json_encode($jdata['make_of_vehicle']); ?>,
			closing_km: <?php echo json_encode(['id' => $rdata['closing_km'], 'value' => $rdata['closing_km'], 'text' => $jdata['closing_km']]); ?>,
			drivers_surname: <?php echo json_encode(['id' => $rdata['drivers_surname'], 'value' => $rdata['drivers_surname'], 'text' => $jdata['drivers_surname']]); ?>,
			drivers_persal_number: <?php echo json_encode($jdata['drivers_persal_number']); ?>
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
				return true;
			}

			return false;
		});

		/* saved value for closing_km */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'closing_km' && d.id == data.closing_km.id)
				return { results: [ data.closing_km ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for drivers_surname */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'drivers_surname' && d.id == data.drivers_surname.id)
				return { results: [ data.drivers_surname ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for drivers_surname autofills */
		cache.addCheck(function(u, d) {
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'drivers_surname' && d.id == data.drivers_surname.id) {
				$j('#drivers_persal_number' + d[rnd]).html(data.drivers_persal_number);
				return true;
			}

			return false;
		});

		cache.start();
	});
</script>

