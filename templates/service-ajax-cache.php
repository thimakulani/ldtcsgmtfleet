<?php
	$rdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'service';

		/* data for selected record, or defaults if none is selected */
		var data = {
			service_item_type: <?php echo json_encode(['id' => $rdata['service_item_type'], 'value' => $rdata['service_item_type'], 'text' => $jdata['service_item_type']]); ?>,
			service_category: <?php echo json_encode(['id' => $rdata['service_category'], 'value' => $rdata['service_category'], 'text' => $jdata['service_category']]); ?>,
			merchant_name: <?php echo json_encode(['id' => $rdata['merchant_name'], 'value' => $rdata['merchant_name'], 'text' => $jdata['merchant_name']]); ?>,
			vehicle_registration_number: <?php echo json_encode(['id' => $rdata['vehicle_registration_number'], 'value' => $rdata['vehicle_registration_number'], 'text' => $jdata['vehicle_registration_number']]); ?>,
			engine_number: <?php echo json_encode($jdata['engine_number']); ?>,
			chassis_number: <?php echo json_encode($jdata['chassis_number']); ?>,
			dealer_name: <?php echo json_encode(['id' => $rdata['dealer_name'], 'value' => $rdata['dealer_name'], 'text' => $jdata['dealer_name']]); ?>,
			make_of_vehicle: <?php echo json_encode($jdata['make_of_vehicle']); ?>,
			model_of_vehicle: <?php echo json_encode($jdata['model_of_vehicle']); ?>,
			year_model_of_vehicle: <?php echo json_encode($jdata['year_model_of_vehicle']); ?>,
			type_of_vehicle: <?php echo json_encode($jdata['type_of_vehicle']); ?>,
			closing_km: <?php echo json_encode(['id' => $rdata['closing_km'], 'value' => $rdata['closing_km'], 'text' => $jdata['closing_km']]); ?>,
			application_status: <?php echo json_encode($jdata['application_status']); ?>,
			work_allocation_reference_number: <?php echo json_encode(['id' => $rdata['work_allocation_reference_number'], 'value' => $rdata['work_allocation_reference_number'], 'text' => $jdata['work_allocation_reference_number']]); ?>,
			barcode_number: <?php echo json_encode($jdata['barcode_number']); ?>,
			department: <?php echo json_encode($jdata['department']); ?>,
			date_of_service: <?php echo json_encode(['id' => $rdata['date_of_service'], 'value' => $rdata['date_of_service'], 'text' => $jdata['date_of_service']]); ?>,
			time: <?php echo json_encode($jdata['time']); ?>,
			receptionist: <?php echo json_encode(['id' => $rdata['receptionist'], 'value' => $rdata['receptionist'], 'text' => $jdata['receptionist']]); ?>,
			receptionist_contact_email: <?php echo json_encode($jdata['receptionist_contact_email']); ?>,
			workshop_name: <?php echo json_encode($jdata['workshop_name']); ?>,
			job_card_number: <?php echo json_encode($jdata['job_card_number']); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for service_item_type */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'service_item_type' && d.id == data.service_item_type.id)
				return { results: [ data.service_item_type ], more: false, elapsed: 0.01 };
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
				$j('#model_of_vehicle' + d[rnd]).html(data.model_of_vehicle);
				$j('#year_model_of_vehicle' + d[rnd]).html(data.year_model_of_vehicle);
				$j('#type_of_vehicle' + d[rnd]).html(data.type_of_vehicle);
				$j('#application_status' + d[rnd]).html(data.application_status);
				$j('#barcode_number' + d[rnd]).html(data.barcode_number);
				$j('#department' + d[rnd]).html(data.department);
				return true;
			}

			return false;
		});

		/* saved value for dealer_name */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'dealer_name' && d.id == data.dealer_name.id)
				return { results: [ data.dealer_name ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for dealer_name autofills */
		cache.addCheck(function(u, d) {
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'dealer_name' && d.id == data.dealer_name.id) {
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

		/* saved value for work_allocation_reference_number */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'work_allocation_reference_number' && d.id == data.work_allocation_reference_number.id)
				return { results: [ data.work_allocation_reference_number ], more: false, elapsed: 0.01 };
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
				$j('#time' + d[rnd]).html(data.time);
				return true;
			}

			return false;
		});

		/* saved value for receptionist */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'receptionist' && d.id == data.receptionist.id)
				return { results: [ data.receptionist ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for receptionist autofills */
		cache.addCheck(function(u, d) {
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'receptionist' && d.id == data.receptionist.id) {
				$j('#receptionist_contact_email' + d[rnd]).html(data.receptionist_contact_email);
				$j('#workshop_name' + d[rnd]).html(data.workshop_name);
				$j('#job_card_number' + d[rnd]).html(data.job_card_number);
				return true;
			}

			return false;
		});

		cache.start();
	});
</script>

