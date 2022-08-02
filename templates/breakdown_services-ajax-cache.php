<?php
	$rdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'breakdown_services';

		/* data for selected record, or defaults if none is selected */
		var data = {
			description_of_vehicle_breakdown_notes: <?php echo json_encode(['id' => $rdata['description_of_vehicle_breakdown_notes'], 'value' => $rdata['description_of_vehicle_breakdown_notes'], 'text' => $jdata['description_of_vehicle_breakdown_notes']]); ?>,
			work_allocation_reference_number: <?php echo json_encode(['id' => $rdata['work_allocation_reference_number'], 'value' => $rdata['work_allocation_reference_number'], 'text' => $jdata['work_allocation_reference_number']]); ?>,
			job_card_number: <?php echo json_encode(['id' => $rdata['job_card_number'], 'value' => $rdata['job_card_number'], 'text' => $jdata['job_card_number']]); ?>,
			vehicle_registration_number: <?php echo json_encode(['id' => $rdata['vehicle_registration_number'], 'value' => $rdata['vehicle_registration_number'], 'text' => $jdata['vehicle_registration_number']]); ?>,
			engine_number: <?php echo json_encode($jdata['engine_number']); ?>,
			closing_km: <?php echo json_encode(['id' => $rdata['closing_km'], 'value' => $rdata['closing_km'], 'text' => $jdata['closing_km']]); ?>,
			part_number: <?php echo json_encode(['id' => $rdata['part_number'], 'value' => $rdata['part_number'], 'text' => $jdata['part_number']]); ?>,
			part_name: <?php echo json_encode(['id' => $rdata['part_name'], 'value' => $rdata['part_name'], 'text' => $jdata['part_name']]); ?>,
			part_manufacturer_name: <?php echo json_encode(['id' => $rdata['part_manufacturer_name'], 'value' => $rdata['part_manufacturer_name'], 'text' => $jdata['part_manufacturer_name']]); ?>,
			part_number_1: <?php echo json_encode(['id' => $rdata['part_number_1'], 'value' => $rdata['part_number_1'], 'text' => $jdata['part_number_1']]); ?>,
			part_name_1: <?php echo json_encode(['id' => $rdata['part_name_1'], 'value' => $rdata['part_name_1'], 'text' => $jdata['part_name_1']]); ?>,
			part_manufacturer_name_1: <?php echo json_encode(['id' => $rdata['part_manufacturer_name_1'], 'value' => $rdata['part_manufacturer_name_1'], 'text' => $jdata['part_manufacturer_name_1']]); ?>,
			workshop_name: <?php echo json_encode(['id' => $rdata['workshop_name'], 'value' => $rdata['workshop_name'], 'text' => $jdata['workshop_name']]); ?>,
			receptionist: <?php echo json_encode($jdata['receptionist']); ?>,
			receptionist_contact_email: <?php echo json_encode($jdata['receptionist_contact_email']); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for description_of_vehicle_breakdown_notes */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'description_of_vehicle_breakdown_notes' && d.id == data.description_of_vehicle_breakdown_notes.id)
				return { results: [ data.description_of_vehicle_breakdown_notes ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for description_of_vehicle_breakdown_notes autofills */
		cache.addCheck(function(u, d) {
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'description_of_vehicle_breakdown_notes' && d.id == data.description_of_vehicle_breakdown_notes.id) {
				$j('#receptionist' + d[rnd]).html(data.receptionist);
				$j('#receptionist_contact_email' + d[rnd]).html(data.receptionist_contact_email);
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

		/* saved value for job_card_number */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'job_card_number' && d.id == data.job_card_number.id)
				return { results: [ data.job_card_number ], more: false, elapsed: 0.01 };
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

		/* saved value for part_number */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'part_number' && d.id == data.part_number.id)
				return { results: [ data.part_number ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for part_name */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'part_name' && d.id == data.part_name.id)
				return { results: [ data.part_name ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for part_manufacturer_name */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'part_manufacturer_name' && d.id == data.part_manufacturer_name.id)
				return { results: [ data.part_manufacturer_name ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for part_number_1 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'part_number_1' && d.id == data.part_number_1.id)
				return { results: [ data.part_number_1 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for part_name_1 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'part_name_1' && d.id == data.part_name_1.id)
				return { results: [ data.part_name_1 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for part_manufacturer_name_1 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'part_manufacturer_name_1' && d.id == data.part_manufacturer_name_1.id)
				return { results: [ data.part_manufacturer_name_1 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for workshop_name */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'workshop_name' && d.id == data.workshop_name.id)
				return { results: [ data.workshop_name ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

