<?php
	$rdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'indicates_repair_damages_found_list';

		/* data for selected record, or defaults if none is selected */
		var data = {
			driver_name_and_surname: <?php echo json_encode(['id' => $rdata['driver_name_and_surname'], 'value' => $rdata['driver_name_and_surname'], 'text' => $jdata['driver_name_and_surname']]); ?>,
			driver_persal_number: <?php echo json_encode($jdata['driver_persal_number']); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for driver_name_and_surname */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'driver_name_and_surname' && d.id == data.driver_name_and_surname.id)
				return { results: [ data.driver_name_and_surname ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for driver_name_and_surname autofills */
		cache.addCheck(function(u, d) {
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'driver_name_and_surname' && d.id == data.driver_name_and_surname.id) {
				$j('#driver_persal_number' + d[rnd]).html(data.driver_persal_number);
				return true;
			}

			return false;
		});

		cache.start();
	});
</script>

