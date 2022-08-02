<?php
	$rdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'parts';

		/* data for selected record, or defaults if none is selected */
		var data = {
			part_type: <?php echo json_encode(['id' => $rdata['part_type'], 'value' => $rdata['part_type'], 'text' => $jdata['part_type']]); ?>,
			manufacturer: <?php echo json_encode(['id' => $rdata['manufacturer'], 'value' => $rdata['manufacturer'], 'text' => $jdata['manufacturer']]); ?>,
			dealer: <?php echo json_encode(['id' => $rdata['dealer'], 'value' => $rdata['dealer'], 'text' => $jdata['dealer']]); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for part_type */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'part_type' && d.id == data.part_type.id)
				return { results: [ data.part_type ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for manufacturer */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'manufacturer' && d.id == data.manufacturer.id)
				return { results: [ data.manufacturer ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for dealer */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'dealer' && d.id == data.dealer.id)
				return { results: [ data.dealer ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

