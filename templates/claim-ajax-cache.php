<?php
	$rdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'claim';

		/* data for selected record, or defaults if none is selected */
		var data = {
			claim_status: <?php echo json_encode(['id' => $rdata['claim_status'], 'value' => $rdata['claim_status'], 'text' => $jdata['claim_status']]); ?>,
			claim_category: <?php echo json_encode(['id' => $rdata['claim_category'], 'value' => $rdata['claim_category'], 'text' => $jdata['claim_category']]); ?>,
			cost_centre: <?php echo json_encode(['id' => $rdata['cost_centre'], 'value' => $rdata['cost_centre'], 'text' => $jdata['cost_centre']]); ?>,
			department_name: <?php echo json_encode(['id' => $rdata['department_name'], 'value' => $rdata['department_name'], 'text' => $jdata['department_name']]); ?>,
			district: <?php echo json_encode(['id' => $rdata['district'], 'value' => $rdata['district'], 'text' => $jdata['district']]); ?>,
			province: <?php echo json_encode(['id' => $rdata['province'], 'value' => $rdata['province'], 'text' => $jdata['province']]); ?>,
			merchant_name: <?php echo json_encode(['id' => $rdata['merchant_name'], 'value' => $rdata['merchant_name'], 'text' => $jdata['merchant_name']]); ?>,
			vehicle_registration_number: <?php echo json_encode(['id' => $rdata['vehicle_registration_number'], 'value' => $rdata['vehicle_registration_number'], 'text' => $jdata['vehicle_registration_number']]); ?>,
			model: <?php echo json_encode($jdata['model']); ?>,
			closing_km: <?php echo json_encode(['id' => $rdata['closing_km'], 'value' => $rdata['closing_km'], 'text' => $jdata['closing_km']]); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for claim_status */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'claim_status' && d.id == data.claim_status.id)
				return { results: [ data.claim_status ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for claim_category */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'claim_category' && d.id == data.claim_category.id)
				return { results: [ data.claim_category ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for cost_centre */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'cost_centre' && d.id == data.cost_centre.id)
				return { results: [ data.cost_centre ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for department_name */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'department_name' && d.id == data.department_name.id)
				return { results: [ data.department_name ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for district */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'district' && d.id == data.district.id)
				return { results: [ data.district ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for province */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'province' && d.id == data.province.id)
				return { results: [ data.province ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for merchant_name */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'merchant_name' && d.id == data.merchant_name.id)
				return { results: [ data.merchant_name ], more: false, elapsed: 0.01 };
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
				$j('#model' + d[rnd]).html(data.model);
				return true;
			}

			return false;
		});

		/* saved value for closing_km */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'closing_km' && d.id == data.closing_km.id)
				return { results: [ data.closing_km ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

