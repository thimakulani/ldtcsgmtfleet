<?php
	$rdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'vehicle_history';

		/* data for selected record, or defaults if none is selected */
		var data = {
			vehicle_registration_number: <?php echo json_encode(['id' => $rdata['vehicle_registration_number'], 'value' => $rdata['vehicle_registration_number'], 'text' => $jdata['vehicle_registration_number']]); ?>,
			engine_number: <?php echo json_encode($jdata['engine_number']); ?>,
			purchased_price: <?php echo json_encode($jdata['purchased_price']); ?>,
			old_registration_number: <?php echo json_encode($jdata['old_registration_number']); ?>,
			renewal_of_license: <?php echo json_encode($jdata['renewal_of_license']); ?>,
			date_of_service: <?php echo json_encode(['id' => $rdata['date_of_service'], 'value' => $rdata['date_of_service'], 'text' => $jdata['date_of_service']]); ?>,
			date_of_next_service: <?php echo json_encode($jdata['date_of_next_service']); ?>,
			purchased_order_number: <?php echo json_encode(['id' => $rdata['purchased_order_number'], 'value' => $rdata['purchased_order_number'], 'text' => $jdata['purchased_order_number']]); ?>,
			claim_code: <?php echo json_encode(['id' => $rdata['claim_code'], 'value' => $rdata['claim_code'], 'text' => $jdata['claim_code']]); ?>,
			tyre_inspection_report: <?php echo json_encode(['id' => $rdata['tyre_inspection_report'], 'value' => $rdata['tyre_inspection_report'], 'text' => $jdata['tyre_inspection_report']]); ?>,
			inspection_certification_number: <?php echo json_encode(['id' => $rdata['inspection_certification_number'], 'value' => $rdata['inspection_certification_number'], 'text' => $jdata['inspection_certification_number']]); ?>,
			document_checklist_report: <?php echo json_encode(['id' => $rdata['document_checklist_report'], 'value' => $rdata['document_checklist_report'], 'text' => $jdata['document_checklist_report']]); ?>,
			next_inspection_date: <?php echo json_encode(['id' => $rdata['next_inspection_date'], 'value' => $rdata['next_inspection_date'], 'text' => $jdata['next_inspection_date']]); ?>,
			closing_km: <?php echo json_encode(['id' => $rdata['closing_km'], 'value' => $rdata['closing_km'], 'text' => $jdata['closing_km']]); ?>,
			total_cost: <?php echo json_encode(['id' => $rdata['total_cost'], 'value' => $rdata['total_cost'], 'text' => $jdata['total_cost']]); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

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
				$j('#engine_number' + d[rnd]).html(data.engine_number);
				$j('#purchased_price' + d[rnd]).html(data.purchased_price);
				$j('#old_registration_number' + d[rnd]).html(data.old_registration_number);
				$j('#renewal_of_license' + d[rnd]).html(data.renewal_of_license);
				return true;
			}

			return false;
		});

		/* saved value for date_of_service */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'date_of_service' && d.id == data.date_of_service.id)
				return { results: [ data.date_of_service ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for date_of_service autofills */
		cache.addCheck(function(u, d) {
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'date_of_service' && d.id == data.date_of_service.id) {
				$j('#date_of_next_service' + d[rnd]).html(data.date_of_next_service);
				return true;
			}

			return false;
		});

		/* saved value for purchased_order_number */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'purchased_order_number' && d.id == data.purchased_order_number.id)
				return { results: [ data.purchased_order_number ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for claim_code */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'claim_code' && d.id == data.claim_code.id)
				return { results: [ data.claim_code ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for tyre_inspection_report */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'tyre_inspection_report' && d.id == data.tyre_inspection_report.id)
				return { results: [ data.tyre_inspection_report ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for inspection_certification_number */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'inspection_certification_number' && d.id == data.inspection_certification_number.id)
				return { results: [ data.inspection_certification_number ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for document_checklist_report */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'document_checklist_report' && d.id == data.document_checklist_report.id)
				return { results: [ data.document_checklist_report ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for next_inspection_date */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'next_inspection_date' && d.id == data.next_inspection_date.id)
				return { results: [ data.next_inspection_date ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for closing_km */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'closing_km' && d.id == data.closing_km.id)
				return { results: [ data.closing_km ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for total_cost */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'total_cost' && d.id == data.total_cost.id)
				return { results: [ data.total_cost ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

