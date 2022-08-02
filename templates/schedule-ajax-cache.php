<?php
	$rdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'schedule';

		/* data for selected record, or defaults if none is selected */
		var data = {
			user_name_and_surname: <?php echo json_encode(['id' => $rdata['user_name_and_surname'], 'value' => $rdata['user_name_and_surname'], 'text' => $jdata['user_name_and_surname']]); ?>,
			user_contact_email: <?php echo json_encode($jdata['user_contact_email']); ?>,
			service_item_type: <?php echo json_encode(['id' => $rdata['service_item_type'], 'value' => $rdata['service_item_type'], 'text' => $jdata['service_item_type']]); ?>,
			service_item_type_code: <?php echo json_encode($jdata['service_item_type_code']); ?>,
			vehicle_registration_number: <?php echo json_encode(['id' => $rdata['vehicle_registration_number'], 'value' => $rdata['vehicle_registration_number'], 'text' => $jdata['vehicle_registration_number']]); ?>,
			engine_number: <?php echo json_encode($jdata['engine_number']); ?>,
			closing_km: <?php echo json_encode(['id' => $rdata['closing_km'], 'value' => $rdata['closing_km'], 'text' => $jdata['closing_km']]); ?>,
			workshop_name: <?php echo json_encode(['id' => $rdata['workshop_name'], 'value' => $rdata['workshop_name'], 'text' => $jdata['workshop_name']]); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for user_name_and_surname */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'user_name_and_surname' && d.id == data.user_name_and_surname.id)
				return { results: [ data.user_name_and_surname ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for user_name_and_surname autofills */
		cache.addCheck(function(u, d) {
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'user_name_and_surname' && d.id == data.user_name_and_surname.id) {
				$j('#user_contact_email' + d[rnd]).html(data.user_contact_email);
				$j('#engine_number' + d[rnd]).html(data.engine_number);
				return true;
			}

			return false;
		});

		/* saved value for service_item_type */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'service_item_type' && d.id == data.service_item_type.id)
				return { results: [ data.service_item_type ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for service_item_type autofills */
		cache.addCheck(function(u, d) {
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'service_item_type' && d.id == data.service_item_type.id) {
				$j('#service_item_type_code' + d[rnd]).html(data.service_item_type_code);
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

		/* saved value for closing_km */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'closing_km' && d.id == data.closing_km.id)
				return { results: [ data.closing_km ], more: false, elapsed: 0.01 };
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

