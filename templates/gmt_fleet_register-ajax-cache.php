<?php
	$rdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'gmt_fleet_register';

		/* data for selected record, or defaults if none is selected */
		var data = {
			dealer_name: <?php echo json_encode(['id' => $rdata['dealer_name'], 'value' => $rdata['dealer_name'], 'text' => $jdata['dealer_name']]); ?>,
			make_of_vehicle: <?php echo json_encode(['id' => $rdata['make_of_vehicle'], 'value' => $rdata['make_of_vehicle'], 'text' => $jdata['make_of_vehicle']]); ?>,
			year_model_specification: <?php echo json_encode(['id' => $rdata['year_model_specification'], 'value' => $rdata['year_model_specification'], 'text' => $jdata['year_model_specification']]); ?>,
			transmission: <?php echo json_encode(['id' => $rdata['transmission'], 'value' => $rdata['transmission'], 'text' => $jdata['transmission']]); ?>,
			fuel_type: <?php echo json_encode(['id' => $rdata['fuel_type'], 'value' => $rdata['fuel_type'], 'text' => $jdata['fuel_type']]); ?>,
			type_of_vehicle: <?php echo json_encode(['id' => $rdata['type_of_vehicle'], 'value' => $rdata['type_of_vehicle'], 'text' => $jdata['type_of_vehicle']]); ?>,
			colour_of_vehicle: <?php echo json_encode(['id' => $rdata['colour_of_vehicle'], 'value' => $rdata['colour_of_vehicle'], 'text' => $jdata['colour_of_vehicle']]); ?>,
			application_status: <?php echo json_encode(['id' => $rdata['application_status'], 'value' => $rdata['application_status'], 'text' => $jdata['application_status']]); ?>,
			department_name: <?php echo json_encode(['id' => $rdata['department_name'], 'value' => $rdata['department_name'], 'text' => $jdata['department_name']]); ?>,
			province: <?php echo json_encode(['id' => $rdata['province'], 'value' => $rdata['province'], 'text' => $jdata['province']]); ?>,
			district: <?php echo json_encode(['id' => $rdata['district'], 'value' => $rdata['district'], 'text' => $jdata['district']]); ?>,
			drivers_name_and_surname: <?php echo json_encode(['id' => $rdata['drivers_name_and_surname'], 'value' => $rdata['drivers_name_and_surname'], 'text' => $jdata['drivers_name_and_surname']]); ?>,
			drivers_persal_number: <?php echo json_encode($jdata['drivers_persal_number']); ?>,
			department_name_of_driver: <?php echo json_encode(['id' => $rdata['department_name_of_driver'], 'value' => $rdata['department_name_of_driver'], 'text' => $jdata['department_name_of_driver']]); ?>,
			drivers_contact_details: <?php echo json_encode($jdata['drivers_contact_details']); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for dealer_name */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'dealer_name' && d.id == data.dealer_name.id)
				return { results: [ data.dealer_name ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for make_of_vehicle */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'make_of_vehicle' && d.id == data.make_of_vehicle.id)
				return { results: [ data.make_of_vehicle ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for year_model_specification */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'year_model_specification' && d.id == data.year_model_specification.id)
				return { results: [ data.year_model_specification ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for transmission */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'transmission' && d.id == data.transmission.id)
				return { results: [ data.transmission ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for fuel_type */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'fuel_type' && d.id == data.fuel_type.id)
				return { results: [ data.fuel_type ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for type_of_vehicle */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'type_of_vehicle' && d.id == data.type_of_vehicle.id)
				return { results: [ data.type_of_vehicle ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for colour_of_vehicle */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'colour_of_vehicle' && d.id == data.colour_of_vehicle.id)
				return { results: [ data.colour_of_vehicle ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for application_status */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'application_status' && d.id == data.application_status.id)
				return { results: [ data.application_status ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for department_name */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'department_name' && d.id == data.department_name.id)
				return { results: [ data.department_name ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for province */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'province' && d.id == data.province.id)
				return { results: [ data.province ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for district */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'district' && d.id == data.district.id)
				return { results: [ data.district ], more: false, elapsed: 0.01 };
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

		/* saved value for department_name_of_driver */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'department_name_of_driver' && d.id == data.department_name_of_driver.id)
				return { results: [ data.department_name_of_driver ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

