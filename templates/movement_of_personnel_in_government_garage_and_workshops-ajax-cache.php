<?php
	$rdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'movement_of_personnel_in_government_garage_and_workshops';

		/* data for selected record, or defaults if none is selected */
		var data = {
			vehicle_inspection: <?php echo json_encode(['id' => $rdata['vehicle_inspection'], 'value' => $rdata['vehicle_inspection'], 'text' => $jdata['vehicle_inspection']]); ?>,
			make_of_vehicle: <?php echo json_encode(['id' => $rdata['make_of_vehicle'], 'value' => $rdata['make_of_vehicle'], 'text' => $jdata['make_of_vehicle']]); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for vehicle_inspection */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'vehicle_inspection' && d.id == data.vehicle_inspection.id)
				return { results: [ data.vehicle_inspection ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for make_of_vehicle */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'make_of_vehicle' && d.id == data.make_of_vehicle.id)
				return { results: [ data.make_of_vehicle ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

