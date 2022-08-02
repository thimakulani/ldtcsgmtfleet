<?php
	$rdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'withdrawal_vehicle_from_operation';

		/* data for selected record, or defaults if none is selected */
		var data = {
			vehicle_registration_number: <?php echo json_encode(['id' => $rdata['vehicle_registration_number'], 'value' => $rdata['vehicle_registration_number'], 'text' => $jdata['vehicle_registration_number']]); ?>,
			engine_number: <?php echo json_encode($jdata['engine_number']); ?>,
			make_of_vehicle: <?php echo json_encode($jdata['make_of_vehicle']); ?>,
			purchased_price: <?php echo json_encode($jdata['purchased_price']); ?>,
			date_of_service: <?php echo json_encode(['id' => $rdata['date_of_service'], 'value' => $rdata['date_of_service'], 'text' => $jdata['date_of_service']]); ?>,
			date_of_next_service: <?php echo json_encode($jdata['date_of_next_service']); ?>,
			renewal_of_license: <?php echo json_encode($jdata['renewal_of_license']); ?>
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
				$j('#make_of_vehicle' + d[rnd]).html(data.make_of_vehicle);
				$j('#purchased_price' + d[rnd]).html(data.purchased_price);
				$j('#renewal_of_license' + d[rnd]).html(data.renewal_of_license);
				return true;
			}

			return false;
		});

		/* saved value for date_of_service */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'date_of_service' && d.id == data.date_of_service.id)
				return { results: [ data.date_of_service ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for date_of_service autofills */
		cache.addCheck(function(u, d) {
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'date_of_service' && d.id == data.date_of_service.id) {
				$j('#date_of_next_service' + d[rnd]).html(data.date_of_next_service);
				return true;
			}

			return false;
		});

		cache.start();
	});
</script>

