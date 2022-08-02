<?php
	$rdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'internal_repairs_body';

		/* data for selected record, or defaults if none is selected */
		var data = {
			driver_name_and_surname: <?php echo json_encode(['id' => $rdata['driver_name_and_surname'], 'value' => $rdata['driver_name_and_surname'], 'text' => $jdata['driver_name_and_surname']]); ?>,
			driver_persal_number: <?php echo json_encode($jdata['driver_persal_number']); ?>,
			driver_contacts_details: <?php echo json_encode($jdata['driver_contacts_details']); ?>,
			driver_email_address: <?php echo json_encode($jdata['driver_email_address']); ?>,
			driver_license_code: <?php echo json_encode($jdata['driver_license_code']); ?>,
			driver_license_number: <?php echo json_encode($jdata['driver_license_number']); ?>,
			vehicle_registration_number: <?php echo json_encode(['id' => $rdata['vehicle_registration_number'], 'value' => $rdata['vehicle_registration_number'], 'text' => $jdata['vehicle_registration_number']]); ?>,
			engine_number: <?php echo json_encode($jdata['engine_number']); ?>,
			make_of_vehicle: <?php echo json_encode($jdata['make_of_vehicle']); ?>,
			job_card_number: <?php echo json_encode(['id' => $rdata['job_card_number'], 'value' => $rdata['job_card_number'], 'text' => $jdata['job_card_number']]); ?>,
			work_allocation_reference_number: <?php echo json_encode(['id' => $rdata['work_allocation_reference_number'], 'value' => $rdata['work_allocation_reference_number'], 'text' => $jdata['work_allocation_reference_number']]); ?>,
			government_garage_name: <?php echo json_encode(['id' => $rdata['government_garage_name'], 'value' => $rdata['government_garage_name'], 'text' => $jdata['government_garage_name']]); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

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
				$j('#driver_contacts_details' + d[rnd]).html(data.driver_contacts_details);
				$j('#driver_email_address' + d[rnd]).html(data.driver_email_address);
				$j('#driver_license_code' + d[rnd]).html(data.driver_license_code);
				$j('#driver_license_number' + d[rnd]).html(data.driver_license_number);
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

		/* saved value for job_card_number */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'job_card_number' && d.id == data.job_card_number.id)
				return { results: [ data.job_card_number ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for work_allocation_reference_number */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'work_allocation_reference_number' && d.id == data.work_allocation_reference_number.id)
				return { results: [ data.work_allocation_reference_number ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for government_garage_name */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'government_garage_name' && d.id == data.government_garage_name.id)
				return { results: [ data.government_garage_name ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

