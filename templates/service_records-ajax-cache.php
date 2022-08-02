<?php
	$rdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'service_records';

		/* data for selected record, or defaults if none is selected */
		var data = {
			vehicle: <?php echo json_encode(['id' => $rdata['vehicle'], 'value' => $rdata['vehicle'], 'text' => $jdata['vehicle']]); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for vehicle */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'vehicle' && d.id == data.vehicle.id)
				return { results: [ data.vehicle ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

