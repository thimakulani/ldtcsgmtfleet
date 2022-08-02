<?php
	$rdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'authorizations';

		/* data for selected record, or defaults if none is selected */
		var data = {
			job_code: <?php echo json_encode(['id' => $rdata['job_code'], 'value' => $rdata['job_code'], 'text' => $jdata['job_code']]); ?>,
			job_status: <?php echo json_encode(['id' => $rdata['job_status'], 'value' => $rdata['job_status'], 'text' => $jdata['job_status']]); ?>,
			job_category: <?php echo json_encode(['id' => $rdata['job_category'], 'value' => $rdata['job_category'], 'text' => $jdata['job_category']]); ?>,
			job_odometer: <?php echo json_encode($jdata['job_odometer']); ?>,
			instruction_note: <?php echo json_encode($jdata['instruction_note']); ?>,
			pre_authorisation_date: <?php echo json_encode($jdata['pre_authorisation_date']); ?>,
			vehicle_registration_number: <?php echo json_encode(['id' => $rdata['vehicle_registration_number'], 'value' => $rdata['vehicle_registration_number'], 'text' => $jdata['vehicle_registration_number']]); ?>,
			make_of_vehicle: <?php echo json_encode($jdata['make_of_vehicle']); ?>,
			client: <?php echo json_encode(['id' => $rdata['client'], 'value' => $rdata['client'], 'text' => $jdata['client']]); ?>,
			province_name: <?php echo json_encode(['id' => $rdata['province_name'], 'value' => $rdata['province_name'], 'text' => $jdata['province_name']]); ?>,
			merchant_code: <?php echo json_encode(['id' => $rdata['merchant_code'], 'value' => $rdata['merchant_code'], 'text' => $jdata['merchant_code']]); ?>,
			merchant_name: <?php echo json_encode($jdata['merchant_name']); ?>,
			merchant_contact_email: <?php echo json_encode($jdata['merchant_contact_email']); ?>,
			merchant_street_address: <?php echo json_encode($jdata['merchant_street_address']); ?>,
			merchant_suburb: <?php echo json_encode($jdata['merchant_suburb']); ?>,
			merchant_city: <?php echo json_encode($jdata['merchant_city']); ?>,
			merchant_address_code: <?php echo json_encode($jdata['merchant_address_code']); ?>,
			merchant_contact_details: <?php echo json_encode($jdata['merchant_contact_details']); ?>,
			total_claim: <?php echo json_encode($jdata['total_claim']); ?>,
			total_authorised: <?php echo json_encode($jdata['total_authorised']); ?>,
			authorization_number: <?php echo json_encode($jdata['authorization_number']); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for job_code */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'job_code' && d.id == data.job_code.id)
				return { results: [ data.job_code ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for job_code autofills */
		cache.addCheck(function(u, d) {
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'job_code' && d.id == data.job_code.id) {
				$j('#job_odometer' + d[rnd]).html(data.job_odometer);
				$j('#instruction_note' + d[rnd]).html(data.instruction_note);
				$j('#pre_authorisation_date' + d[rnd]).html(data.pre_authorisation_date);
				$j('#make_of_vehicle' + d[rnd]).html(data.make_of_vehicle);
				$j('#total_claim' + d[rnd]).html(data.total_claim);
				$j('#total_authorised' + d[rnd]).html(data.total_authorised);
				$j('#authorization_number' + d[rnd]).html(data.authorization_number);
				return true;
			}

			return false;
		});

		/* saved value for job_status */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'job_status' && d.id == data.job_status.id)
				return { results: [ data.job_status ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for job_category */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'job_category' && d.id == data.job_category.id)
				return { results: [ data.job_category ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for vehicle_registration_number */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'vehicle_registration_number' && d.id == data.vehicle_registration_number.id)
				return { results: [ data.vehicle_registration_number ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for client */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'client' && d.id == data.client.id)
				return { results: [ data.client ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for province_name */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'province_name' && d.id == data.province_name.id)
				return { results: [ data.province_name ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for merchant_code */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'merchant_code' && d.id == data.merchant_code.id)
				return { results: [ data.merchant_code ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for merchant_code autofills */
		cache.addCheck(function(u, d) {
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'merchant_code' && d.id == data.merchant_code.id) {
				$j('#merchant_name' + d[rnd]).html(data.merchant_name);
				$j('#merchant_contact_email' + d[rnd]).html(data.merchant_contact_email);
				$j('#merchant_street_address' + d[rnd]).html(data.merchant_street_address);
				$j('#merchant_suburb' + d[rnd]).html(data.merchant_suburb);
				$j('#merchant_city' + d[rnd]).html(data.merchant_city);
				$j('#merchant_address_code' + d[rnd]).html(data.merchant_address_code);
				$j('#merchant_contact_details' + d[rnd]).html(data.merchant_contact_details);
				return true;
			}

			return false;
		});

		cache.start();
	});
</script>

