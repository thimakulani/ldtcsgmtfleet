<?php
	$rdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'service_provider';

		/* data for selected record, or defaults if none is selected */
		var data = {
			service_provider_type: <?php echo json_encode(['id' => $rdata['service_provider_type'], 'value' => $rdata['service_provider_type'], 'text' => $jdata['service_provider_type']]); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for service_provider_type */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'service_provider_type' && d.id == data.service_provider_type.id)
				return { results: [ data.service_provider_type ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

