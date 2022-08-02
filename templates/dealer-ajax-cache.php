<?php
	$rdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'dealer';

		/* data for selected record, or defaults if none is selected */
		var data = {
			dealer_type: <?php echo json_encode(['id' => $rdata['dealer_type'], 'value' => $rdata['dealer_type'], 'text' => $jdata['dealer_type']]); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for dealer_type */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'dealer_type' && d.id == data.dealer_type.id)
				return { results: [ data.dealer_type ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

