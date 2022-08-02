<?php
	$rdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'inspection_bay';

		/* data for selected record, or defaults if none is selected */
		var data = {
			job_card_number: <?php echo json_encode(['id' => $rdata['job_card_number'], 'value' => $rdata['job_card_number'], 'text' => $jdata['job_card_number']]); ?>,
			vehicle_registration_number: <?php echo json_encode(['id' => $rdata['vehicle_registration_number'], 'value' => $rdata['vehicle_registration_number'], 'text' => $jdata['vehicle_registration_number']]); ?>,
			engine_number: <?php echo json_encode($jdata['engine_number']); ?>,
			workshop_name: <?php echo json_encode($jdata['workshop_name']); ?>,
			work_allocation_reference_number: <?php echo json_encode(['id' => $rdata['work_allocation_reference_number'], 'value' => $rdata['work_allocation_reference_number'], 'text' => $jdata['work_allocation_reference_number']]); ?>,
			make_of_vehicle: <?php echo json_encode($jdata['make_of_vehicle']); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for job_card_number */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'job_card_number' && d.id == data.job_card_number.id)
				return { results: [ data.job_card_number ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for job_card_number autofills */
		cache.addCheck(function(u, d) {
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'job_card_number' && d.id == data.job_card_number.id) {
				$j('#workshop_name' + d[rnd]).html(data.workshop_name);
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
				$j('#engine_number' + d[rnd]).html(data.engine_number);
				$j('#make_of_vehicle' + d[rnd]).html(data.make_of_vehicle);
				return true;
			}

			return false;
		});

		/* saved value for work_allocation_reference_number */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'work_allocation_reference_number' && d.id == data.work_allocation_reference_number.id)
				return { results: [ data.work_allocation_reference_number ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

