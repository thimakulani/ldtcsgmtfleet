<?php
	$rdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'modification_to_vehicle';

		/* data for selected record, or defaults if none is selected */
		var data = {
			type_of_vehicle: <?php echo json_encode(['id' => $rdata['type_of_vehicle'], 'value' => $rdata['type_of_vehicle'], 'text' => $jdata['type_of_vehicle']]); ?>,
			district: <?php echo json_encode(['id' => $rdata['district'], 'value' => $rdata['district'], 'text' => $jdata['district']]); ?>,
			location: <?php echo json_encode($jdata['location']); ?>,
			drivers_name_and_surname: <?php echo json_encode(['id' => $rdata['drivers_name_and_surname'], 'value' => $rdata['drivers_name_and_surname'], 'text' => $jdata['drivers_name_and_surname']]); ?>,
			drivers_persal_number: <?php echo json_encode($jdata['drivers_persal_number']); ?>,
			drivers_contact_details: <?php echo json_encode($jdata['drivers_contact_details']); ?>,
			vehicle_registration_number: <?php echo json_encode(['id' => $rdata['vehicle_registration_number'], 'value' => $rdata['vehicle_registration_number'], 'text' => $jdata['vehicle_registration_number']]); ?>,
			make_of_vehicle: <?php echo json_encode($jdata['make_of_vehicle']); ?>,
			model_of_vehicle: <?php echo json_encode($jdata['model_of_vehicle']); ?>,
			closing_km: <?php echo json_encode(['id' => $rdata['closing_km'], 'value' => $rdata['closing_km'], 'text' => $jdata['closing_km']]); ?>,
			job_card_number: <?php echo json_encode(['id' => $rdata['job_card_number'], 'value' => $rdata['job_card_number'], 'text' => $jdata['job_card_number']]); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for type_of_vehicle */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'type_of_vehicle' && d.id == data.type_of_vehicle.id)
				return { results: [ data.type_of_vehicle ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for district */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'district' && d.id == data.district.id)
				return { results: [ data.district ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for district autofills */
		cache.addCheck(function(u, d) {
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'district' && d.id == data.district.id) {
				$j('#location' + d[rnd]).html(data.location);
				return true;
			}

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
				$j('#drivers_contact_details' + d[rnd]).html(data.drivers_contact_details);
				return true;
			}

			return false;
		});

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
				$j('#model_of_vehicle' + d[rnd]).html(data.model_of_vehicle);
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

		/* saved value for job_card_number */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'job_card_number' && d.id == data.job_card_number.id)
				return { results: [ data.job_card_number ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

