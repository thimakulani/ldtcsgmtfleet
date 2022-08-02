<?php
	$rdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'ordering_of_spares_for_internal_repairs';

		/* data for selected record, or defaults if none is selected */
		var data = {
			workshop_name: <?php echo json_encode(['id' => $rdata['workshop_name'], 'value' => $rdata['workshop_name'], 'text' => $jdata['workshop_name']]); ?>,
			job_card_number: <?php echo json_encode(['id' => $rdata['job_card_number'], 'value' => $rdata['job_card_number'], 'text' => $jdata['job_card_number']]); ?>,
			vehicle_registration_number: <?php echo json_encode(['id' => $rdata['vehicle_registration_number'], 'value' => $rdata['vehicle_registration_number'], 'text' => $jdata['vehicle_registration_number']]); ?>,
			engine_number: <?php echo json_encode($jdata['engine_number']); ?>,
			make_of_vehicle: <?php echo json_encode($jdata['make_of_vehicle']); ?>,
			part_type_1: <?php echo json_encode(['id' => $rdata['part_type_1'], 'value' => $rdata['part_type_1'], 'text' => $jdata['part_type_1']]); ?>,
			part_name_1: <?php echo json_encode(['id' => $rdata['part_name_1'], 'value' => $rdata['part_name_1'], 'text' => $jdata['part_name_1']]); ?>,
			description_1: <?php echo json_encode(['id' => $rdata['description_1'], 'value' => $rdata['description_1'], 'text' => $jdata['description_1']]); ?>,
			manufacture_1: <?php echo json_encode(['id' => $rdata['manufacture_1'], 'value' => $rdata['manufacture_1'], 'text' => $jdata['manufacture_1']]); ?>,
			part_type_2: <?php echo json_encode(['id' => $rdata['part_type_2'], 'value' => $rdata['part_type_2'], 'text' => $jdata['part_type_2']]); ?>,
			part_name_2: <?php echo json_encode(['id' => $rdata['part_name_2'], 'value' => $rdata['part_name_2'], 'text' => $jdata['part_name_2']]); ?>,
			description_2: <?php echo json_encode(['id' => $rdata['description_2'], 'value' => $rdata['description_2'], 'text' => $jdata['description_2']]); ?>,
			manufacture_2: <?php echo json_encode(['id' => $rdata['manufacture_2'], 'value' => $rdata['manufacture_2'], 'text' => $jdata['manufacture_2']]); ?>,
			part_type_3: <?php echo json_encode(['id' => $rdata['part_type_3'], 'value' => $rdata['part_type_3'], 'text' => $jdata['part_type_3']]); ?>,
			part_name_3: <?php echo json_encode(['id' => $rdata['part_name_3'], 'value' => $rdata['part_name_3'], 'text' => $jdata['part_name_3']]); ?>,
			description_3: <?php echo json_encode(['id' => $rdata['description_3'], 'value' => $rdata['description_3'], 'text' => $jdata['description_3']]); ?>,
			manufacture_3: <?php echo json_encode(['id' => $rdata['manufacture_3'], 'value' => $rdata['manufacture_3'], 'text' => $jdata['manufacture_3']]); ?>,
			part_type_4: <?php echo json_encode(['id' => $rdata['part_type_4'], 'value' => $rdata['part_type_4'], 'text' => $jdata['part_type_4']]); ?>,
			part_name_4: <?php echo json_encode(['id' => $rdata['part_name_4'], 'value' => $rdata['part_name_4'], 'text' => $jdata['part_name_4']]); ?>,
			description_4: <?php echo json_encode(['id' => $rdata['description_4'], 'value' => $rdata['description_4'], 'text' => $jdata['description_4']]); ?>,
			manufacture_4: <?php echo json_encode(['id' => $rdata['manufacture_4'], 'value' => $rdata['manufacture_4'], 'text' => $jdata['manufacture_4']]); ?>,
			part_type_5: <?php echo json_encode(['id' => $rdata['part_type_5'], 'value' => $rdata['part_type_5'], 'text' => $jdata['part_type_5']]); ?>,
			part_name_5: <?php echo json_encode(['id' => $rdata['part_name_5'], 'value' => $rdata['part_name_5'], 'text' => $jdata['part_name_5']]); ?>,
			description_5: <?php echo json_encode(['id' => $rdata['description_5'], 'value' => $rdata['description_5'], 'text' => $jdata['description_5']]); ?>,
			manufacture_5: <?php echo json_encode(['id' => $rdata['manufacture_5'], 'value' => $rdata['manufacture_5'], 'text' => $jdata['manufacture_5']]); ?>,
			part_type_6: <?php echo json_encode(['id' => $rdata['part_type_6'], 'value' => $rdata['part_type_6'], 'text' => $jdata['part_type_6']]); ?>,
			part_name_6: <?php echo json_encode(['id' => $rdata['part_name_6'], 'value' => $rdata['part_name_6'], 'text' => $jdata['part_name_6']]); ?>,
			description_6: <?php echo json_encode(['id' => $rdata['description_6'], 'value' => $rdata['description_6'], 'text' => $jdata['description_6']]); ?>,
			manufacture_6: <?php echo json_encode(['id' => $rdata['manufacture_6'], 'value' => $rdata['manufacture_6'], 'text' => $jdata['manufacture_6']]); ?>,
			part_type_7: <?php echo json_encode(['id' => $rdata['part_type_7'], 'value' => $rdata['part_type_7'], 'text' => $jdata['part_type_7']]); ?>,
			part_name_7: <?php echo json_encode(['id' => $rdata['part_name_7'], 'value' => $rdata['part_name_7'], 'text' => $jdata['part_name_7']]); ?>,
			description_7: <?php echo json_encode(['id' => $rdata['description_7'], 'value' => $rdata['description_7'], 'text' => $jdata['description_7']]); ?>,
			manufacture_7: <?php echo json_encode(['id' => $rdata['manufacture_7'], 'value' => $rdata['manufacture_7'], 'text' => $jdata['manufacture_7']]); ?>,
			part_type_8: <?php echo json_encode(['id' => $rdata['part_type_8'], 'value' => $rdata['part_type_8'], 'text' => $jdata['part_type_8']]); ?>,
			part_name_8: <?php echo json_encode(['id' => $rdata['part_name_8'], 'value' => $rdata['part_name_8'], 'text' => $jdata['part_name_8']]); ?>,
			description_8: <?php echo json_encode(['id' => $rdata['description_8'], 'value' => $rdata['description_8'], 'text' => $jdata['description_8']]); ?>,
			manufacture_8: <?php echo json_encode(['id' => $rdata['manufacture_8'], 'value' => $rdata['manufacture_8'], 'text' => $jdata['manufacture_8']]); ?>,
			work_allocation_reference_number: <?php echo json_encode(['id' => $rdata['work_allocation_reference_number'], 'value' => $rdata['work_allocation_reference_number'], 'text' => $jdata['work_allocation_reference_number']]); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for workshop_name */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'workshop_name' && d.id == data.workshop_name.id)
				return { results: [ data.workshop_name ], more: false, elapsed: 0.01 };
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
				$j('#make_of_vehicle' + d[rnd]).html(data.make_of_vehicle);
				return true;
			}

			return false;
		});

		/* saved value for part_type_1 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'part_type_1' && d.id == data.part_type_1.id)
				return { results: [ data.part_type_1 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for part_name_1 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'part_name_1' && d.id == data.part_name_1.id)
				return { results: [ data.part_name_1 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for description_1 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'description_1' && d.id == data.description_1.id)
				return { results: [ data.description_1 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for manufacture_1 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'manufacture_1' && d.id == data.manufacture_1.id)
				return { results: [ data.manufacture_1 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for part_type_2 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'part_type_2' && d.id == data.part_type_2.id)
				return { results: [ data.part_type_2 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for part_name_2 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'part_name_2' && d.id == data.part_name_2.id)
				return { results: [ data.part_name_2 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for description_2 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'description_2' && d.id == data.description_2.id)
				return { results: [ data.description_2 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for manufacture_2 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'manufacture_2' && d.id == data.manufacture_2.id)
				return { results: [ data.manufacture_2 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for part_type_3 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'part_type_3' && d.id == data.part_type_3.id)
				return { results: [ data.part_type_3 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for part_name_3 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'part_name_3' && d.id == data.part_name_3.id)
				return { results: [ data.part_name_3 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for description_3 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'description_3' && d.id == data.description_3.id)
				return { results: [ data.description_3 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for manufacture_3 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'manufacture_3' && d.id == data.manufacture_3.id)
				return { results: [ data.manufacture_3 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for part_type_4 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'part_type_4' && d.id == data.part_type_4.id)
				return { results: [ data.part_type_4 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for part_name_4 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'part_name_4' && d.id == data.part_name_4.id)
				return { results: [ data.part_name_4 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for description_4 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'description_4' && d.id == data.description_4.id)
				return { results: [ data.description_4 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for manufacture_4 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'manufacture_4' && d.id == data.manufacture_4.id)
				return { results: [ data.manufacture_4 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for part_type_5 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'part_type_5' && d.id == data.part_type_5.id)
				return { results: [ data.part_type_5 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for part_name_5 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'part_name_5' && d.id == data.part_name_5.id)
				return { results: [ data.part_name_5 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for description_5 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'description_5' && d.id == data.description_5.id)
				return { results: [ data.description_5 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for manufacture_5 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'manufacture_5' && d.id == data.manufacture_5.id)
				return { results: [ data.manufacture_5 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for part_type_6 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'part_type_6' && d.id == data.part_type_6.id)
				return { results: [ data.part_type_6 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for part_name_6 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'part_name_6' && d.id == data.part_name_6.id)
				return { results: [ data.part_name_6 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for description_6 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'description_6' && d.id == data.description_6.id)
				return { results: [ data.description_6 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for manufacture_6 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'manufacture_6' && d.id == data.manufacture_6.id)
				return { results: [ data.manufacture_6 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for part_type_7 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'part_type_7' && d.id == data.part_type_7.id)
				return { results: [ data.part_type_7 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for part_name_7 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'part_name_7' && d.id == data.part_name_7.id)
				return { results: [ data.part_name_7 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for description_7 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'description_7' && d.id == data.description_7.id)
				return { results: [ data.description_7 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for manufacture_7 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'manufacture_7' && d.id == data.manufacture_7.id)
				return { results: [ data.manufacture_7 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for part_type_8 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'part_type_8' && d.id == data.part_type_8.id)
				return { results: [ data.part_type_8 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for part_name_8 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'part_name_8' && d.id == data.part_name_8.id)
				return { results: [ data.part_name_8 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for description_8 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'description_8' && d.id == data.description_8.id)
				return { results: [ data.description_8 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for manufacture_8 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'manufacture_8' && d.id == data.manufacture_8.id)
				return { results: [ data.manufacture_8 ], more: false, elapsed: 0.01 };
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

