<?php
	$rdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'external_repairs_mechanical';

		/* data for selected record, or defaults if none is selected */
		var data = {
			service_provider_name: <?php echo json_encode(['id' => $rdata['service_provider_name'], 'value' => $rdata['service_provider_name'], 'text' => $jdata['service_provider_name']]); ?>,
			service_provider_type: <?php echo json_encode(['id' => $rdata['service_provider_type'], 'value' => $rdata['service_provider_type'], 'text' => $jdata['service_provider_type']]); ?>,
			service_provider_contact_details: <?php echo json_encode(['id' => $rdata['service_provider_contact_details'], 'value' => $rdata['service_provider_contact_details'], 'text' => $jdata['service_provider_contact_details']]); ?>,
			service_provider_address: <?php echo json_encode(['id' => $rdata['service_provider_address'], 'value' => $rdata['service_provider_address'], 'text' => $jdata['service_provider_address']]); ?>,
			merchant_type: <?php echo json_encode(['id' => $rdata['merchant_type'], 'value' => $rdata['merchant_type'], 'text' => $jdata['merchant_type']]); ?>,
			merchant_code: <?php echo json_encode(['id' => $rdata['merchant_code'], 'value' => $rdata['merchant_code'], 'text' => $jdata['merchant_code']]); ?>,
			merchant_name: <?php echo json_encode(['id' => $rdata['merchant_name'], 'value' => $rdata['merchant_name'], 'text' => $jdata['merchant_name']]); ?>,
			merchant_contacts_details: <?php echo json_encode(['id' => $rdata['merchant_contacts_details'], 'value' => $rdata['merchant_contacts_details'], 'text' => $jdata['merchant_contacts_details']]); ?>,
			merchant_email_address: <?php echo json_encode(['id' => $rdata['merchant_email_address'], 'value' => $rdata['merchant_email_address'], 'text' => $jdata['merchant_email_address']]); ?>,
			merchant_address: <?php echo json_encode(['id' => $rdata['merchant_address'], 'value' => $rdata['merchant_address'], 'text' => $jdata['merchant_address']]); ?>,
			merchant_address_code: <?php echo json_encode(['id' => $rdata['merchant_address_code'], 'value' => $rdata['merchant_address_code'], 'text' => $jdata['merchant_address_code']]); ?>,
			authorization_number: <?php echo json_encode(['id' => $rdata['authorization_number'], 'value' => $rdata['authorization_number'], 'text' => $jdata['authorization_number']]); ?>,
			instruction_note: <?php echo json_encode(['id' => $rdata['instruction_note'], 'value' => $rdata['instruction_note'], 'text' => $jdata['instruction_note']]); ?>,
			work_allocation_reference_number: <?php echo json_encode(['id' => $rdata['work_allocation_reference_number'], 'value' => $rdata['work_allocation_reference_number'], 'text' => $jdata['work_allocation_reference_number']]); ?>,
			vehicle_registration_number: <?php echo json_encode(['id' => $rdata['vehicle_registration_number'], 'value' => $rdata['vehicle_registration_number'], 'text' => $jdata['vehicle_registration_number']]); ?>,
			engine_number: <?php echo json_encode($jdata['engine_number']); ?>,
			make_of_vehicle: <?php echo json_encode($jdata['make_of_vehicle']); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for service_provider_name */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'service_provider_name' && d.id == data.service_provider_name.id)
				return { results: [ data.service_provider_name ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for service_provider_type */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'service_provider_type' && d.id == data.service_provider_type.id)
				return { results: [ data.service_provider_type ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for service_provider_contact_details */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'service_provider_contact_details' && d.id == data.service_provider_contact_details.id)
				return { results: [ data.service_provider_contact_details ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for service_provider_address */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'service_provider_address' && d.id == data.service_provider_address.id)
				return { results: [ data.service_provider_address ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for merchant_type */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'merchant_type' && d.id == data.merchant_type.id)
				return { results: [ data.merchant_type ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for merchant_code */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'merchant_code' && d.id == data.merchant_code.id)
				return { results: [ data.merchant_code ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for merchant_name */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'merchant_name' && d.id == data.merchant_name.id)
				return { results: [ data.merchant_name ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for merchant_contacts_details */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'merchant_contacts_details' && d.id == data.merchant_contacts_details.id)
				return { results: [ data.merchant_contacts_details ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for merchant_email_address */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'merchant_email_address' && d.id == data.merchant_email_address.id)
				return { results: [ data.merchant_email_address ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for merchant_address */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'merchant_address' && d.id == data.merchant_address.id)
				return { results: [ data.merchant_address ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for merchant_address_code */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'merchant_address_code' && d.id == data.merchant_address_code.id)
				return { results: [ data.merchant_address_code ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for authorization_number */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'authorization_number' && d.id == data.authorization_number.id)
				return { results: [ data.authorization_number ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for instruction_note */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'instruction_note' && d.id == data.instruction_note.id)
				return { results: [ data.instruction_note ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for work_allocation_reference_number */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'work_allocation_reference_number' && d.id == data.work_allocation_reference_number.id)
				return { results: [ data.work_allocation_reference_number ], more: false, elapsed: 0.01 };
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

		cache.start();
	});
</script>

