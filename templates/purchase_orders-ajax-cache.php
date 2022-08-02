<?php
	$rdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'purchase_orders';

		/* data for selected record, or defaults if none is selected */
		var data = {
			vehicle_registration_number: <?php echo json_encode(['id' => $rdata['vehicle_registration_number'], 'value' => $rdata['vehicle_registration_number'], 'text' => $jdata['vehicle_registration_number']]); ?>,
			type_of_vehicle: <?php echo json_encode($jdata['type_of_vehicle']); ?>,
			manufacturer: <?php echo json_encode(['id' => $rdata['manufacturer'], 'value' => $rdata['manufacturer'], 'text' => $jdata['manufacturer']]); ?>,
			service_category: <?php echo json_encode(['id' => $rdata['service_category'], 'value' => $rdata['service_category'], 'text' => $jdata['service_category']]); ?>,
			merchant_name: <?php echo json_encode(['id' => $rdata['merchant_name'], 'value' => $rdata['merchant_name'], 'text' => $jdata['merchant_name']]); ?>,
			closing_km: <?php echo json_encode(['id' => $rdata['closing_km'], 'value' => $rdata['closing_km'], 'text' => $jdata['closing_km']]); ?>,
			part_number_1: <?php echo json_encode(['id' => $rdata['part_number_1'], 'value' => $rdata['part_number_1'], 'text' => $jdata['part_number_1']]); ?>,
			part_name_1: <?php echo json_encode(['id' => $rdata['part_name_1'], 'value' => $rdata['part_name_1'], 'text' => $jdata['part_name_1']]); ?>,
			part_manufacturer_name_1: <?php echo json_encode(['id' => $rdata['part_manufacturer_name_1'], 'value' => $rdata['part_manufacturer_name_1'], 'text' => $jdata['part_manufacturer_name_1']]); ?>,
			part_number_2: <?php echo json_encode(['id' => $rdata['part_number_2'], 'value' => $rdata['part_number_2'], 'text' => $jdata['part_number_2']]); ?>,
			part_name_2: <?php echo json_encode(['id' => $rdata['part_name_2'], 'value' => $rdata['part_name_2'], 'text' => $jdata['part_name_2']]); ?>,
			part_manufacturer_name_2: <?php echo json_encode(['id' => $rdata['part_manufacturer_name_2'], 'value' => $rdata['part_manufacturer_name_2'], 'text' => $jdata['part_manufacturer_name_2']]); ?>,
			part_number_3: <?php echo json_encode(['id' => $rdata['part_number_3'], 'value' => $rdata['part_number_3'], 'text' => $jdata['part_number_3']]); ?>,
			part_name_3: <?php echo json_encode($jdata['part_name_3']); ?>,
			part_manufacturer_name_3: <?php echo json_encode(['id' => $rdata['part_manufacturer_name_3'], 'value' => $rdata['part_manufacturer_name_3'], 'text' => $jdata['part_manufacturer_name_3']]); ?>,
			part_number_4: <?php echo json_encode(['id' => $rdata['part_number_4'], 'value' => $rdata['part_number_4'], 'text' => $jdata['part_number_4']]); ?>,
			part_name_4: <?php echo json_encode($jdata['part_name_4']); ?>,
			part_manufacturer_name_4: <?php echo json_encode(['id' => $rdata['part_manufacturer_name_4'], 'value' => $rdata['part_manufacturer_name_4'], 'text' => $jdata['part_manufacturer_name_4']]); ?>,
			part_number_5: <?php echo json_encode(['id' => $rdata['part_number_5'], 'value' => $rdata['part_number_5'], 'text' => $jdata['part_number_5']]); ?>,
			part_name_5: <?php echo json_encode($jdata['part_name_5']); ?>,
			part_manufacturer_name_5: <?php echo json_encode(['id' => $rdata['part_manufacturer_name_5'], 'value' => $rdata['part_manufacturer_name_5'], 'text' => $jdata['part_manufacturer_name_5']]); ?>,
			part_number_6: <?php echo json_encode(['id' => $rdata['part_number_6'], 'value' => $rdata['part_number_6'], 'text' => $jdata['part_number_6']]); ?>,
			part_name_6: <?php echo json_encode(['id' => $rdata['part_name_6'], 'value' => $rdata['part_name_6'], 'text' => $jdata['part_name_6']]); ?>,
			part_manufacturer_name_6: <?php echo json_encode(['id' => $rdata['part_manufacturer_name_6'], 'value' => $rdata['part_manufacturer_name_6'], 'text' => $jdata['part_manufacturer_name_6']]); ?>,
			part_number_7: <?php echo json_encode(['id' => $rdata['part_number_7'], 'value' => $rdata['part_number_7'], 'text' => $jdata['part_number_7']]); ?>,
			part_name_7: <?php echo json_encode(['id' => $rdata['part_name_7'], 'value' => $rdata['part_name_7'], 'text' => $jdata['part_name_7']]); ?>,
			part_manufacturer_name_7: <?php echo json_encode(['id' => $rdata['part_manufacturer_name_7'], 'value' => $rdata['part_manufacturer_name_7'], 'text' => $jdata['part_manufacturer_name_7']]); ?>,
			part_number_8: <?php echo json_encode(['id' => $rdata['part_number_8'], 'value' => $rdata['part_number_8'], 'text' => $jdata['part_number_8']]); ?>,
			part_name_8: <?php echo json_encode(['id' => $rdata['part_name_8'], 'value' => $rdata['part_name_8'], 'text' => $jdata['part_name_8']]); ?>,
			part_manufacturer_name_8: <?php echo json_encode(['id' => $rdata['part_manufacturer_name_8'], 'value' => $rdata['part_manufacturer_name_8'], 'text' => $jdata['part_manufacturer_name_8']]); ?>,
			workshop_name: <?php echo json_encode(['id' => $rdata['workshop_name'], 'value' => $rdata['workshop_name'], 'text' => $jdata['workshop_name']]); ?>,
			work_order_id: <?php echo json_encode(['id' => $rdata['work_order_id'], 'value' => $rdata['work_order_id'], 'text' => $jdata['work_order_id']]); ?>,
			job_card_number: <?php echo json_encode(['id' => $rdata['job_card_number'], 'value' => $rdata['job_card_number'], 'text' => $jdata['job_card_number']]); ?>
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
				$j('#type_of_vehicle' + d[rnd]).html(data.type_of_vehicle);
				return true;
			}

			return false;
		});

		/* saved value for manufacturer */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'manufacturer' && d.id == data.manufacturer.id)
				return { results: [ data.manufacturer ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for service_category */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'service_category' && d.id == data.service_category.id)
				return { results: [ data.service_category ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for merchant_name */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'merchant_name' && d.id == data.merchant_name.id)
				return { results: [ data.merchant_name ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for closing_km */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'closing_km' && d.id == data.closing_km.id)
				return { results: [ data.closing_km ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for part_number_1 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'part_number_1' && d.id == data.part_number_1.id)
				return { results: [ data.part_number_1 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for part_number_1 autofills */
		cache.addCheck(function(u, d) {
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'part_number_1' && d.id == data.part_number_1.id) {
				$j('#part_name_3' + d[rnd]).html(data.part_name_3);
				$j('#part_name_4' + d[rnd]).html(data.part_name_4);
				$j('#part_name_5' + d[rnd]).html(data.part_name_5);
				return true;
			}

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

		/* saved value for part_number_2 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'part_number_2' && d.id == data.part_number_2.id)
				return { results: [ data.part_number_2 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for part_name_2 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'part_name_2' && d.id == data.part_name_2.id)
				return { results: [ data.part_name_2 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for part_manufacturer_name_2 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'part_manufacturer_name_2' && d.id == data.part_manufacturer_name_2.id)
				return { results: [ data.part_manufacturer_name_2 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for part_number_3 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'part_number_3' && d.id == data.part_number_3.id)
				return { results: [ data.part_number_3 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for part_manufacturer_name_3 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'part_manufacturer_name_3' && d.id == data.part_manufacturer_name_3.id)
				return { results: [ data.part_manufacturer_name_3 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for part_number_4 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'part_number_4' && d.id == data.part_number_4.id)
				return { results: [ data.part_number_4 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for part_manufacturer_name_4 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'part_manufacturer_name_4' && d.id == data.part_manufacturer_name_4.id)
				return { results: [ data.part_manufacturer_name_4 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for part_number_5 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'part_number_5' && d.id == data.part_number_5.id)
				return { results: [ data.part_number_5 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for part_manufacturer_name_5 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'part_manufacturer_name_5' && d.id == data.part_manufacturer_name_5.id)
				return { results: [ data.part_manufacturer_name_5 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for part_number_6 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'part_number_6' && d.id == data.part_number_6.id)
				return { results: [ data.part_number_6 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for part_name_6 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'part_name_6' && d.id == data.part_name_6.id)
				return { results: [ data.part_name_6 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for part_manufacturer_name_6 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'part_manufacturer_name_6' && d.id == data.part_manufacturer_name_6.id)
				return { results: [ data.part_manufacturer_name_6 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for part_number_7 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'part_number_7' && d.id == data.part_number_7.id)
				return { results: [ data.part_number_7 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for part_name_7 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'part_name_7' && d.id == data.part_name_7.id)
				return { results: [ data.part_name_7 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for part_manufacturer_name_7 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'part_manufacturer_name_7' && d.id == data.part_manufacturer_name_7.id)
				return { results: [ data.part_manufacturer_name_7 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for part_number_8 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'part_number_8' && d.id == data.part_number_8.id)
				return { results: [ data.part_number_8 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for part_name_8 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'part_name_8' && d.id == data.part_name_8.id)
				return { results: [ data.part_name_8 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for part_manufacturer_name_8 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'part_manufacturer_name_8' && d.id == data.part_manufacturer_name_8.id)
				return { results: [ data.part_manufacturer_name_8 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for workshop_name */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'workshop_name' && d.id == data.workshop_name.id)
				return { results: [ data.workshop_name ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for work_order_id */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'work_order_id' && d.id == data.work_order_id.id)
				return { results: [ data.work_order_id ], more: false, elapsed: 0.01 };
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

