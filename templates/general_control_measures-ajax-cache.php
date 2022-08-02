<?php
	$rdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'general_control_measures';

		/* data for selected record, or defaults if none is selected */
		var data = {
			district: <?php echo json_encode(['id' => $rdata['district'], 'value' => $rdata['district'], 'text' => $jdata['district']]); ?>,
			cost_centre: <?php echo json_encode(['id' => $rdata['cost_centre'], 'value' => $rdata['cost_centre'], 'text' => $jdata['cost_centre']]); ?>,
			location: <?php echo json_encode($jdata['location']); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for district */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'district' && d.id == data.district.id)
				return { results: [ data.district ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for district autofills */
		cache.addCheck(function(u, d) {
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'district' && d.id == data.district.id) {
				$j('#location' + d[rnd]).html(data.location);
				return true;
			}

			return false;
		});

		/* saved value for cost_centre */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'cost_centre' && d.id == data.cost_centre.id)
				return { results: [ data.cost_centre ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

