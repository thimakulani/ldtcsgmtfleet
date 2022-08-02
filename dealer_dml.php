<?php

// Data functions (insert, update, delete, form) for table dealer

// This script and data application were generated by AppGini 22.13
// Download AppGini for free from https://bigprof.com/appgini/download/

function dealer_insert(&$error_message = '') {
	global $Translation;

	// mm: can member insert record?
	$arrPerm = getTablePermissions('dealer');
	if(!$arrPerm['insert']) return false;

	$data = [
		'dealer_type' => Request::lookup('dealer_type', ''),
		'make_of_vehicle' => Request::val('make_of_vehicle', ''),
		'dealer_name' => Request::val('dealer_name', ''),
		'contact_person' => Request::val('contact_person', ''),
		'contact_details' => Request::val('contact_details', ''),
		'contact_email' => Request::val('contact_email', ''),
	];


	// hook: dealer_before_insert
	if(function_exists('dealer_before_insert')) {
		$args = [];
		if(!dealer_before_insert($data, getMemberInfo(), $args)) {
			if(isset($args['error_message'])) $error_message = $args['error_message'];
			return false;
		}
	}

	$error = '';
	// set empty fields to NULL
	$data = array_map(function($v) { return ($v === '' ? NULL : $v); }, $data);
	insert('dealer', backtick_keys_once($data), $error);
	if($error) {
		$error_message = $error;
		return false;
	}

	$recID = db_insert_id(db_link());

	update_calc_fields('dealer', $recID, calculated_fields()['dealer']);

	// hook: dealer_after_insert
	if(function_exists('dealer_after_insert')) {
		$res = sql("SELECT * FROM `dealer` WHERE `dealer_id`='" . makeSafe($recID, false) . "' LIMIT 1", $eo);
		if($row = db_fetch_assoc($res)) {
			$data = array_map('makeSafe', $row);
		}
		$data['selectedID'] = makeSafe($recID, false);
		$args = [];
		if(!dealer_after_insert($data, getMemberInfo(), $args)) { return $recID; }
	}

	// mm: save ownership data
	set_record_owner('dealer', $recID, getLoggedMemberID());

	// if this record is a copy of another record, copy children if applicable
	if(strlen(Request::val('SelectedID'))) dealer_copy_children($recID, Request::val('SelectedID'));

	return $recID;
}

function dealer_copy_children($destination_id, $source_id) {
	global $Translation;
	$requests = []; // array of curl handlers for launching insert requests
	$eo = ['silentErrors' => true];
	$safe_sid = makeSafe($source_id);

	// launch requests, asynchronously
	curl_batch($requests);
}

function dealer_delete($selected_id, $AllowDeleteOfParents = false, $skipChecks = false) {
	// insure referential integrity ...
	global $Translation;
	$selected_id = makeSafe($selected_id);

	// mm: can member delete record?
	if(!check_record_permission('dealer', $selected_id, 'delete')) {
		return $Translation['You don\'t have enough permissions to delete this record'];
	}

	// hook: dealer_before_delete
	if(function_exists('dealer_before_delete')) {
		$args = [];
		if(!dealer_before_delete($selected_id, $skipChecks, getMemberInfo(), $args))
			return $Translation['Couldn\'t delete this record'] . (
				!empty($args['error_message']) ?
					'<div class="text-bold">' . strip_tags($args['error_message']) . '</div>'
					: '' 
			);
	}

	// child table: gmt_fleet_register
	$res = sql("SELECT `dealer_id` FROM `dealer` WHERE `dealer_id`='{$selected_id}'", $eo);
	$dealer_id = db_fetch_row($res);
	$rires = sql("SELECT COUNT(1) FROM `gmt_fleet_register` WHERE `dealer_name`='" . makeSafe($dealer_id[0]) . "'", $eo);
	$rirow = db_fetch_row($rires);
	if($rirow[0] && !$AllowDeleteOfParents && !$skipChecks) {
		$RetMsg = $Translation["couldn't delete"];
		$RetMsg = str_replace('<RelatedRecords>', $rirow[0], $RetMsg);
		$RetMsg = str_replace('<TableName>', 'gmt_fleet_register', $RetMsg);
		return $RetMsg;
	} elseif($rirow[0] && $AllowDeleteOfParents && !$skipChecks) {
		$RetMsg = $Translation['confirm delete'];
		$RetMsg = str_replace('<RelatedRecords>', $rirow[0], $RetMsg);
		$RetMsg = str_replace('<TableName>', 'gmt_fleet_register', $RetMsg);
		$RetMsg = str_replace('<Delete>', '<input type="button" class="btn btn-danger" value="' . html_attr($Translation['yes']) . '" onClick="window.location = \'dealer_view.php?SelectedID=' . urlencode($selected_id) . '&delete_x=1&confirmed=1&csrf_token=' . urlencode(csrf_token(false, true)) . '\';">', $RetMsg);
		$RetMsg = str_replace('<Cancel>', '<input type="button" class="btn btn-success" value="' . html_attr($Translation[ 'no']) . '" onClick="window.location = \'dealer_view.php?SelectedID=' . urlencode($selected_id) . '\';">', $RetMsg);
		return $RetMsg;
	}

	// child table: gmt_fleet_register
	$res = sql("SELECT `dealer_id` FROM `dealer` WHERE `dealer_id`='{$selected_id}'", $eo);
	$dealer_id = db_fetch_row($res);
	$rires = sql("SELECT COUNT(1) FROM `gmt_fleet_register` WHERE `make_of_vehicle`='" . makeSafe($dealer_id[0]) . "'", $eo);
	$rirow = db_fetch_row($rires);
	if($rirow[0] && !$AllowDeleteOfParents && !$skipChecks) {
		$RetMsg = $Translation["couldn't delete"];
		$RetMsg = str_replace('<RelatedRecords>', $rirow[0], $RetMsg);
		$RetMsg = str_replace('<TableName>', 'gmt_fleet_register', $RetMsg);
		return $RetMsg;
	} elseif($rirow[0] && $AllowDeleteOfParents && !$skipChecks) {
		$RetMsg = $Translation['confirm delete'];
		$RetMsg = str_replace('<RelatedRecords>', $rirow[0], $RetMsg);
		$RetMsg = str_replace('<TableName>', 'gmt_fleet_register', $RetMsg);
		$RetMsg = str_replace('<Delete>', '<input type="button" class="btn btn-danger" value="' . html_attr($Translation['yes']) . '" onClick="window.location = \'dealer_view.php?SelectedID=' . urlencode($selected_id) . '&delete_x=1&confirmed=1&csrf_token=' . urlencode(csrf_token(false, true)) . '\';">', $RetMsg);
		$RetMsg = str_replace('<Cancel>', '<input type="button" class="btn btn-success" value="' . html_attr($Translation[ 'no']) . '" onClick="window.location = \'dealer_view.php?SelectedID=' . urlencode($selected_id) . '\';">', $RetMsg);
		return $RetMsg;
	}

	// child table: service
	$res = sql("SELECT `dealer_id` FROM `dealer` WHERE `dealer_id`='{$selected_id}'", $eo);
	$dealer_id = db_fetch_row($res);
	$rires = sql("SELECT COUNT(1) FROM `service` WHERE `dealer_name`='" . makeSafe($dealer_id[0]) . "'", $eo);
	$rirow = db_fetch_row($rires);
	if($rirow[0] && !$AllowDeleteOfParents && !$skipChecks) {
		$RetMsg = $Translation["couldn't delete"];
		$RetMsg = str_replace('<RelatedRecords>', $rirow[0], $RetMsg);
		$RetMsg = str_replace('<TableName>', 'service', $RetMsg);
		return $RetMsg;
	} elseif($rirow[0] && $AllowDeleteOfParents && !$skipChecks) {
		$RetMsg = $Translation['confirm delete'];
		$RetMsg = str_replace('<RelatedRecords>', $rirow[0], $RetMsg);
		$RetMsg = str_replace('<TableName>', 'service', $RetMsg);
		$RetMsg = str_replace('<Delete>', '<input type="button" class="btn btn-danger" value="' . html_attr($Translation['yes']) . '" onClick="window.location = \'dealer_view.php?SelectedID=' . urlencode($selected_id) . '&delete_x=1&confirmed=1&csrf_token=' . urlencode(csrf_token(false, true)) . '\';">', $RetMsg);
		$RetMsg = str_replace('<Cancel>', '<input type="button" class="btn btn-success" value="' . html_attr($Translation[ 'no']) . '" onClick="window.location = \'dealer_view.php?SelectedID=' . urlencode($selected_id) . '\';">', $RetMsg);
		return $RetMsg;
	}

	// child table: parts
	$res = sql("SELECT `dealer_id` FROM `dealer` WHERE `dealer_id`='{$selected_id}'", $eo);
	$dealer_id = db_fetch_row($res);
	$rires = sql("SELECT COUNT(1) FROM `parts` WHERE `dealer`='" . makeSafe($dealer_id[0]) . "'", $eo);
	$rirow = db_fetch_row($rires);
	if($rirow[0] && !$AllowDeleteOfParents && !$skipChecks) {
		$RetMsg = $Translation["couldn't delete"];
		$RetMsg = str_replace('<RelatedRecords>', $rirow[0], $RetMsg);
		$RetMsg = str_replace('<TableName>', 'parts', $RetMsg);
		return $RetMsg;
	} elseif($rirow[0] && $AllowDeleteOfParents && !$skipChecks) {
		$RetMsg = $Translation['confirm delete'];
		$RetMsg = str_replace('<RelatedRecords>', $rirow[0], $RetMsg);
		$RetMsg = str_replace('<TableName>', 'parts', $RetMsg);
		$RetMsg = str_replace('<Delete>', '<input type="button" class="btn btn-danger" value="' . html_attr($Translation['yes']) . '" onClick="window.location = \'dealer_view.php?SelectedID=' . urlencode($selected_id) . '&delete_x=1&confirmed=1&csrf_token=' . urlencode(csrf_token(false, true)) . '\';">', $RetMsg);
		$RetMsg = str_replace('<Cancel>', '<input type="button" class="btn btn-success" value="' . html_attr($Translation[ 'no']) . '" onClick="window.location = \'dealer_view.php?SelectedID=' . urlencode($selected_id) . '\';">', $RetMsg);
		return $RetMsg;
	}

	// child table: internal_repairs_mechanical
	$res = sql("SELECT `dealer_id` FROM `dealer` WHERE `dealer_id`='{$selected_id}'", $eo);
	$dealer_id = db_fetch_row($res);
	$rires = sql("SELECT COUNT(1) FROM `internal_repairs_mechanical` WHERE `make_of_vehicle`='" . makeSafe($dealer_id[0]) . "'", $eo);
	$rirow = db_fetch_row($rires);
	if($rirow[0] && !$AllowDeleteOfParents && !$skipChecks) {
		$RetMsg = $Translation["couldn't delete"];
		$RetMsg = str_replace('<RelatedRecords>', $rirow[0], $RetMsg);
		$RetMsg = str_replace('<TableName>', 'internal_repairs_mechanical', $RetMsg);
		return $RetMsg;
	} elseif($rirow[0] && $AllowDeleteOfParents && !$skipChecks) {
		$RetMsg = $Translation['confirm delete'];
		$RetMsg = str_replace('<RelatedRecords>', $rirow[0], $RetMsg);
		$RetMsg = str_replace('<TableName>', 'internal_repairs_mechanical', $RetMsg);
		$RetMsg = str_replace('<Delete>', '<input type="button" class="btn btn-danger" value="' . html_attr($Translation['yes']) . '" onClick="window.location = \'dealer_view.php?SelectedID=' . urlencode($selected_id) . '&delete_x=1&confirmed=1&csrf_token=' . urlencode(csrf_token(false, true)) . '\';">', $RetMsg);
		$RetMsg = str_replace('<Cancel>', '<input type="button" class="btn btn-success" value="' . html_attr($Translation[ 'no']) . '" onClick="window.location = \'dealer_view.php?SelectedID=' . urlencode($selected_id) . '\';">', $RetMsg);
		return $RetMsg;
	}

	// child table: movement_of_personnel_in_government_garage_and_workshops
	$res = sql("SELECT `dealer_id` FROM `dealer` WHERE `dealer_id`='{$selected_id}'", $eo);
	$dealer_id = db_fetch_row($res);
	$rires = sql("SELECT COUNT(1) FROM `movement_of_personnel_in_government_garage_and_workshops` WHERE `make_of_vehicle`='" . makeSafe($dealer_id[0]) . "'", $eo);
	$rirow = db_fetch_row($rires);
	if($rirow[0] && !$AllowDeleteOfParents && !$skipChecks) {
		$RetMsg = $Translation["couldn't delete"];
		$RetMsg = str_replace('<RelatedRecords>', $rirow[0], $RetMsg);
		$RetMsg = str_replace('<TableName>', 'movement_of_personnel_in_government_garage_and_workshops', $RetMsg);
		return $RetMsg;
	} elseif($rirow[0] && $AllowDeleteOfParents && !$skipChecks) {
		$RetMsg = $Translation['confirm delete'];
		$RetMsg = str_replace('<RelatedRecords>', $rirow[0], $RetMsg);
		$RetMsg = str_replace('<TableName>', 'movement_of_personnel_in_government_garage_and_workshops', $RetMsg);
		$RetMsg = str_replace('<Delete>', '<input type="button" class="btn btn-danger" value="' . html_attr($Translation['yes']) . '" onClick="window.location = \'dealer_view.php?SelectedID=' . urlencode($selected_id) . '&delete_x=1&confirmed=1&csrf_token=' . urlencode(csrf_token(false, true)) . '\';">', $RetMsg);
		$RetMsg = str_replace('<Cancel>', '<input type="button" class="btn btn-success" value="' . html_attr($Translation[ 'no']) . '" onClick="window.location = \'dealer_view.php?SelectedID=' . urlencode($selected_id) . '\';">', $RetMsg);
		return $RetMsg;
	}

	sql("DELETE FROM `dealer` WHERE `dealer_id`='{$selected_id}'", $eo);

	// hook: dealer_after_delete
	if(function_exists('dealer_after_delete')) {
		$args = [];
		dealer_after_delete($selected_id, getMemberInfo(), $args);
	}

	// mm: delete ownership data
	sql("DELETE FROM `membership_userrecords` WHERE `tableName`='dealer' AND `pkValue`='{$selected_id}'", $eo);
}

function dealer_update(&$selected_id, &$error_message = '') {
	global $Translation;

	// mm: can member edit record?
	if(!check_record_permission('dealer', $selected_id, 'edit')) return false;

	$data = [
		'dealer_type' => Request::lookup('dealer_type', ''),
		'make_of_vehicle' => Request::val('make_of_vehicle', ''),
		'dealer_name' => Request::val('dealer_name', ''),
		'contact_person' => Request::val('contact_person', ''),
		'contact_details' => Request::val('contact_details', ''),
		'contact_email' => Request::val('contact_email', ''),
	];

	// get existing values
	$old_data = getRecord('dealer', $selected_id);
	if(is_array($old_data)) {
		$old_data = array_map('makeSafe', $old_data);
		$old_data['selectedID'] = makeSafe($selected_id);
	}

	$data['selectedID'] = makeSafe($selected_id);

	// hook: dealer_before_update
	if(function_exists('dealer_before_update')) {
		$args = ['old_data' => $old_data];
		if(!dealer_before_update($data, getMemberInfo(), $args)) {
			if(isset($args['error_message'])) $error_message = $args['error_message'];
			return false;
		}
	}

	$set = $data; unset($set['selectedID']);
	foreach ($set as $field => $value) {
		$set[$field] = ($value !== '' && $value !== NULL) ? $value : NULL;
	}

	if(!update(
		'dealer', 
		backtick_keys_once($set), 
		['`dealer_id`' => $selected_id], 
		$error_message
	)) {
		echo $error_message;
		echo '<a href="dealer_view.php?SelectedID=' . urlencode($selected_id) . "\">{$Translation['< back']}</a>";
		exit;
	}


	$eo = ['silentErrors' => true];

	update_calc_fields('dealer', $data['selectedID'], calculated_fields()['dealer']);

	// hook: dealer_after_update
	if(function_exists('dealer_after_update')) {
		$res = sql("SELECT * FROM `dealer` WHERE `dealer_id`='{$data['selectedID']}' LIMIT 1", $eo);
		if($row = db_fetch_assoc($res)) $data = array_map('makeSafe', $row);

		$data['selectedID'] = $data['dealer_id'];
		$args = ['old_data' => $old_data];
		if(!dealer_after_update($data, getMemberInfo(), $args)) return;
	}

	// mm: update ownership data
	sql("UPDATE `membership_userrecords` SET `dateUpdated`='" . time() . "' WHERE `tableName`='dealer' AND `pkValue`='" . makeSafe($selected_id) . "'", $eo);
}

function dealer_form($selected_id = '', $AllowUpdate = 1, $AllowInsert = 1, $AllowDelete = 1, $separateDV = 0, $TemplateDV = '', $TemplateDVP = '') {
	// function to return an editable form for a table records
	// and fill it with data of record whose ID is $selected_id. If $selected_id
	// is empty, an empty form is shown, with only an 'Add New'
	// button displayed.

	global $Translation;
	$eo = ['silentErrors' => true];
	$noUploads = null;
	$row = $urow = $jsReadOnly = $jsEditable = $lookups = null;

	$noSaveAsCopy = true;

	// mm: get table permissions
	$arrPerm = getTablePermissions('dealer');
	if(!$arrPerm['insert'] && $selected_id == '')
		// no insert permission and no record selected
		// so show access denied error unless TVDV
		return $separateDV ? $Translation['tableAccessDenied'] : '';
	$AllowInsert = ($arrPerm['insert'] ? true : false);
	// print preview?
	$dvprint = false;
	if(strlen($selected_id) && Request::val('dvprint_x') != '') {
		$dvprint = true;
	}

	$filterer_dealer_type = Request::val('filterer_dealer_type');

	// populate filterers, starting from children to grand-parents

	// unique random identifier
	$rnd1 = ($dvprint ? rand(1000000, 9999999) : '');
	// combobox: dealer_type
	$combo_dealer_type = new DataCombo;

	if($selected_id) {
		// mm: check member permissions
		if(!$arrPerm['view']) return $Translation['tableAccessDenied'];

		// mm: who is the owner?
		$ownerGroupID = sqlValue("SELECT `groupID` FROM `membership_userrecords` WHERE `tableName`='dealer' AND `pkValue`='" . makeSafe($selected_id) . "'");
		$ownerMemberID = sqlValue("SELECT LCASE(`memberID`) FROM `membership_userrecords` WHERE `tableName`='dealer' AND `pkValue`='" . makeSafe($selected_id) . "'");

		if($arrPerm['view'] == 1 && getLoggedMemberID() != $ownerMemberID) return $Translation['tableAccessDenied'];
		if($arrPerm['view'] == 2 && getLoggedGroupID() != $ownerGroupID) return $Translation['tableAccessDenied'];

		// can edit?
		$AllowUpdate = 0;
		if(($arrPerm['edit'] == 1 && $ownerMemberID == getLoggedMemberID()) || ($arrPerm['edit'] == 2 && $ownerGroupID == getLoggedGroupID()) || $arrPerm['edit'] == 3) {
			$AllowUpdate = 1;
		}

		$res = sql("SELECT * FROM `dealer` WHERE `dealer_id`='" . makeSafe($selected_id) . "'", $eo);
		if(!($row = db_fetch_array($res))) {
			return error_message($Translation['No records found'], 'dealer_view.php', false);
		}
		$combo_dealer_type->SelectedData = $row['dealer_type'];
		$urow = $row; /* unsanitized data */
		$row = array_map('safe_html', $row);
	} else {
		$filterField = Request::val('FilterField');
		$filterOperator = Request::val('FilterOperator');
		$filterValue = Request::val('FilterValue');
		$combo_dealer_type->SelectedData = $filterer_dealer_type;
	}
	$combo_dealer_type->HTML = '<span id="dealer_type-container' . $rnd1 . '"></span><input type="hidden" name="dealer_type" id="dealer_type' . $rnd1 . '" value="' . html_attr($combo_dealer_type->SelectedData) . '">';
	$combo_dealer_type->MatchText = '<span id="dealer_type-container-readonly' . $rnd1 . '"></span><input type="hidden" name="dealer_type" id="dealer_type' . $rnd1 . '" value="' . html_attr($combo_dealer_type->SelectedData) . '">';

	ob_start();
	?>

	<script>
		// initial lookup values
		AppGini.current_dealer_type__RAND__ = { text: "", value: "<?php echo addslashes($selected_id ? $urow['dealer_type'] : htmlspecialchars($filterer_dealer_type, ENT_QUOTES)); ?>"};

		jQuery(function() {
			setTimeout(function() {
				if(typeof(dealer_type_reload__RAND__) == 'function') dealer_type_reload__RAND__();
			}, 50); /* we need to slightly delay client-side execution of the above code to allow AppGini.ajaxCache to work */
		});
		function dealer_type_reload__RAND__() {
		<?php if(($AllowUpdate || ($arrPerm['insert'] && !$selected_id)) && !$dvprint) { ?>

			$j("#dealer_type-container__RAND__").select2({
				/* initial default value */
				initSelection: function(e, c) {
					$j.ajax({
						url: 'ajax_combo.php',
						dataType: 'json',
						data: { id: AppGini.current_dealer_type__RAND__.value, t: 'dealer', f: 'dealer_type' },
						success: function(resp) {
							c({
								id: resp.results[0].id,
								text: resp.results[0].text
							});
							$j('[name="dealer_type"]').val(resp.results[0].id);
							$j('[id=dealer_type-container-readonly__RAND__]').html('<span class="match-text" id="dealer_type-match-text">' + resp.results[0].text + '</span>');
							if(resp.results[0].id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=dealer_type_view_parent]').hide(); } else { $j('.btn[id=dealer_type_view_parent]').show(); }


							if(typeof(dealer_type_update_autofills__RAND__) == 'function') dealer_type_update_autofills__RAND__();
						}
					});
				},
				width: '100%',
				formatNoMatches: function(term) { return '<?php echo addslashes($Translation['No matches found!']); ?>'; },
				minimumResultsForSearch: 5,
				loadMorePadding: 200,
				ajax: {
					url: 'ajax_combo.php',
					dataType: 'json',
					cache: true,
					data: function(term, page) { return { s: term, p: page, t: 'dealer', f: 'dealer_type' }; },
					results: function(resp, page) { return resp; }
				},
				escapeMarkup: function(str) { return str; }
			}).on('change', function(e) {
				AppGini.current_dealer_type__RAND__.value = e.added.id;
				AppGini.current_dealer_type__RAND__.text = e.added.text;
				$j('[name="dealer_type"]').val(e.added.id);
				if(e.added.id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=dealer_type_view_parent]').hide(); } else { $j('.btn[id=dealer_type_view_parent]').show(); }


				if(typeof(dealer_type_update_autofills__RAND__) == 'function') dealer_type_update_autofills__RAND__();
			});

			if(!$j("#dealer_type-container__RAND__").length) {
				$j.ajax({
					url: 'ajax_combo.php',
					dataType: 'json',
					data: { id: AppGini.current_dealer_type__RAND__.value, t: 'dealer', f: 'dealer_type' },
					success: function(resp) {
						$j('[name="dealer_type"]').val(resp.results[0].id);
						$j('[id=dealer_type-container-readonly__RAND__]').html('<span class="match-text" id="dealer_type-match-text">' + resp.results[0].text + '</span>');
						if(resp.results[0].id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=dealer_type_view_parent]').hide(); } else { $j('.btn[id=dealer_type_view_parent]').show(); }

						if(typeof(dealer_type_update_autofills__RAND__) == 'function') dealer_type_update_autofills__RAND__();
					}
				});
			}

		<?php } else { ?>

			$j.ajax({
				url: 'ajax_combo.php',
				dataType: 'json',
				data: { id: AppGini.current_dealer_type__RAND__.value, t: 'dealer', f: 'dealer_type' },
				success: function(resp) {
					$j('[id=dealer_type-container__RAND__], [id=dealer_type-container-readonly__RAND__]').html('<span class="match-text" id="dealer_type-match-text">' + resp.results[0].text + '</span>');
					if(resp.results[0].id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=dealer_type_view_parent]').hide(); } else { $j('.btn[id=dealer_type_view_parent]').show(); }

					if(typeof(dealer_type_update_autofills__RAND__) == 'function') dealer_type_update_autofills__RAND__();
				}
			});
		<?php } ?>

		}
	</script>
	<?php

	$lookups = str_replace('__RAND__', $rnd1, ob_get_clean());


	// code for template based detail view forms

	// open the detail view template
	if($dvprint) {
		$template_file = is_file("./{$TemplateDVP}") ? "./{$TemplateDVP}" : './templates/dealer_templateDVP.html';
		$templateCode = @file_get_contents($template_file);
	} else {
		$template_file = is_file("./{$TemplateDV}") ? "./{$TemplateDV}" : './templates/dealer_templateDV.html';
		$templateCode = @file_get_contents($template_file);
	}

	// process form title
	$templateCode = str_replace('<%%DETAIL_VIEW_TITLE%%>', 'Dealer Details:', $templateCode);
	$templateCode = str_replace('<%%RND1%%>', $rnd1, $templateCode);
	$templateCode = str_replace('<%%EMBEDDED%%>', (Request::val('Embedded') ? 'Embedded=1' : ''), $templateCode);
	// process buttons
	if($arrPerm['insert'] && !$selected_id) { // allow insert and no record selected?
		if(!$selected_id) $templateCode = str_replace('<%%INSERT_BUTTON%%>', '<button type="submit" class="btn btn-success" id="insert" name="insert_x" value="1" onclick="return dealer_validateData();"><i class="glyphicon glyphicon-plus-sign"></i> ' . $Translation['Save New'] . '</button>', $templateCode);
		$templateCode = str_replace('<%%INSERT_BUTTON%%>', '<button type="submit" class="btn btn-default" id="insert" name="insert_x" value="1" onclick="return dealer_validateData();"><i class="glyphicon glyphicon-plus-sign"></i> ' . $Translation['Save As Copy'] . '</button>', $templateCode);
	} else {
		$templateCode = str_replace('<%%INSERT_BUTTON%%>', '', $templateCode);
	}

	// 'Back' button action
	if(Request::val('Embedded')) {
		$backAction = 'AppGini.closeParentModal(); return false;';
	} else {
		$backAction = '$j(\'form\').eq(0).attr(\'novalidate\', \'novalidate\'); document.myform.reset(); return true;';
	}

	if($selected_id) {
		if(!Request::val('Embedded')) $templateCode = str_replace('<%%DVPRINT_BUTTON%%>', '<button type="submit" class="btn btn-default" id="dvprint" name="dvprint_x" value="1" onclick="$j(\'form\').eq(0).prop(\'novalidate\', true); document.myform.reset(); return true;" title="' . html_attr($Translation['Print Preview']) . '"><i class="glyphicon glyphicon-print"></i> ' . $Translation['Print Preview'] . '</button>', $templateCode);
		if($AllowUpdate) {
			$templateCode = str_replace('<%%UPDATE_BUTTON%%>', '<button type="submit" class="btn btn-success btn-lg" id="update" name="update_x" value="1" onclick="return dealer_validateData();" title="' . html_attr($Translation['Save Changes']) . '"><i class="glyphicon glyphicon-ok"></i> ' . $Translation['Save Changes'] . '</button>', $templateCode);
		} else {
			$templateCode = str_replace('<%%UPDATE_BUTTON%%>', '', $templateCode);
		}
		if(($arrPerm['delete'] == 1 && $ownerMemberID == getLoggedMemberID()) || ($arrPerm['delete'] == 2 && $ownerGroupID == getLoggedGroupID()) || $arrPerm['delete'] == 3) { // allow delete?
			$templateCode = str_replace('<%%DELETE_BUTTON%%>', '<button type="submit" class="btn btn-danger" id="delete" name="delete_x" value="1" onclick="return confirm(\'' . $Translation['are you sure?'] . '\');" title="' . html_attr($Translation['Delete']) . '"><i class="glyphicon glyphicon-trash"></i> ' . $Translation['Delete'] . '</button>', $templateCode);
		} else {
			$templateCode = str_replace('<%%DELETE_BUTTON%%>', '', $templateCode);
		}
		$templateCode = str_replace('<%%DESELECT_BUTTON%%>', '<button type="submit" class="btn btn-default" id="deselect" name="deselect_x" value="1" onclick="' . $backAction . '" title="' . html_attr($Translation['Back']) . '"><i class="glyphicon glyphicon-chevron-left"></i> ' . $Translation['Back'] . '</button>', $templateCode);
	} else {
		$templateCode = str_replace('<%%UPDATE_BUTTON%%>', '', $templateCode);
		$templateCode = str_replace('<%%DELETE_BUTTON%%>', '', $templateCode);

		// if not in embedded mode and user has insert only but no view/update/delete,
		// remove 'back' button
		if(
			$arrPerm['insert']
			&& !$arrPerm['update'] && !$arrPerm['delete'] && !$arrPerm['view']
			&& !Request::val('Embedded')
		)
			$templateCode = str_replace('<%%DESELECT_BUTTON%%>', '', $templateCode);
		elseif($separateDV)
			$templateCode = str_replace(
				'<%%DESELECT_BUTTON%%>', 
				'<button
					type="submit" 
					class="btn btn-default" 
					id="deselect" 
					name="deselect_x" 
					value="1" 
					onclick="' . $backAction . '" 
					title="' . html_attr($Translation['Back']) . '">
						<i class="glyphicon glyphicon-chevron-left"></i> ' .
						$Translation['Back'] .
				'</button>',
				$templateCode
			);
		else
			$templateCode = str_replace('<%%DESELECT_BUTTON%%>', '', $templateCode);
	}

	// set records to read only if user can't insert new records and can't edit current record
	if(($selected_id && !$AllowUpdate) || (!$selected_id && !$AllowInsert)) {
		$jsReadOnly = '';
		$jsReadOnly .= "\tjQuery('#dealer_type').prop('disabled', true).css({ color: '#555', backgroundColor: '#fff' });\n";
		$jsReadOnly .= "\tjQuery('#dealer_type_caption').prop('disabled', true).css({ color: '#555', backgroundColor: 'white' });\n";
		$jsReadOnly .= "\tjQuery('#make_of_vehicle').replaceWith('<div class=\"form-control-static\" id=\"make_of_vehicle\">' + (jQuery('#make_of_vehicle').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#dealer_name').replaceWith('<div class=\"form-control-static\" id=\"dealer_name\">' + (jQuery('#dealer_name').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#contact_person').replaceWith('<div class=\"form-control-static\" id=\"contact_person\">' + (jQuery('#contact_person').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#contact_details').replaceWith('<div class=\"form-control-static\" id=\"contact_details\">' + (jQuery('#contact_details').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#contact_email').replaceWith('<div class=\"form-control-static\" id=\"contact_email\">' + (jQuery('#contact_email').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#contact_email, #contact_email-edit-link').hide();\n";
		$jsReadOnly .= "\tjQuery('.select2-container').hide();\n";

		$noUploads = true;
	} elseif(($AllowInsert && !$selected_id) || ($AllowUpdate && $selected_id)) {
		$jsEditable = "\tjQuery('form').eq(0).data('already_changed', true);"; // temporarily disable form change handler
		$jsEditable .= "\tjQuery('form').eq(0).data('already_changed', false);"; // re-enable form change handler
	}

	// process combos
	$templateCode = str_replace('<%%COMBO(dealer_type)%%>', $combo_dealer_type->HTML, $templateCode);
	$templateCode = str_replace('<%%COMBOTEXT(dealer_type)%%>', $combo_dealer_type->MatchText, $templateCode);
	$templateCode = str_replace('<%%URLCOMBOTEXT(dealer_type)%%>', urlencode($combo_dealer_type->MatchText), $templateCode);

	/* lookup fields array: 'lookup field name' => ['parent table name', 'lookup field caption'] */
	$lookup_fields = ['dealer_type' => ['dealer_type', 'Dealer Type:'], ];
	foreach($lookup_fields as $luf => $ptfc) {
		$pt_perm = getTablePermissions($ptfc[0]);

		// process foreign key links
		if($pt_perm['view'] || $pt_perm['edit']) {
			$templateCode = str_replace("<%%PLINK({$luf})%%>", '<button type="button" class="btn btn-default view_parent" id="' . $ptfc[0] . '_view_parent" title="' . html_attr($Translation['View'] . ' ' . $ptfc[1]) . '"><i class="glyphicon glyphicon-eye-open"></i></button>', $templateCode);
		}

		// if user has insert permission to parent table of a lookup field, put an add new button
		if($pt_perm['insert'] /* && !Request::val('Embedded')*/) {
			$templateCode = str_replace("<%%ADDNEW({$ptfc[0]})%%>", '<button type="button" class="btn btn-default add_new_parent" id="' . $ptfc[0] . '_add_new" title="' . html_attr($Translation['Add New'] . ' ' . $ptfc[1]) . '"><i class="glyphicon glyphicon-plus text-success"></i></button>', $templateCode);
		}
	}

	// process images
	$templateCode = str_replace('<%%UPLOADFILE(dealer_id)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(dealer_type)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(make_of_vehicle)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(dealer_name)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(contact_person)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(contact_details)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(contact_email)%%>', '', $templateCode);

	// process values
	if($selected_id) {
		if( $dvprint) $templateCode = str_replace('<%%VALUE(dealer_id)%%>', safe_html($urow['dealer_id']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(dealer_id)%%>', html_attr($row['dealer_id']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(dealer_id)%%>', urlencode($urow['dealer_id']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(dealer_type)%%>', safe_html($urow['dealer_type']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(dealer_type)%%>', html_attr($row['dealer_type']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(dealer_type)%%>', urlencode($urow['dealer_type']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(make_of_vehicle)%%>', safe_html($urow['make_of_vehicle']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(make_of_vehicle)%%>', html_attr($row['make_of_vehicle']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(make_of_vehicle)%%>', urlencode($urow['make_of_vehicle']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(dealer_name)%%>', safe_html($urow['dealer_name']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(dealer_name)%%>', html_attr($row['dealer_name']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(dealer_name)%%>', urlencode($urow['dealer_name']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(contact_person)%%>', safe_html($urow['contact_person']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(contact_person)%%>', html_attr($row['contact_person']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(contact_person)%%>', urlencode($urow['contact_person']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(contact_details)%%>', safe_html($urow['contact_details']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(contact_details)%%>', html_attr($row['contact_details']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(contact_details)%%>', urlencode($urow['contact_details']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(contact_email)%%>', safe_html($urow['contact_email']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(contact_email)%%>', html_attr($row['contact_email']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(contact_email)%%>', urlencode($urow['contact_email']), $templateCode);
	} else {
		$templateCode = str_replace('<%%VALUE(dealer_id)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(dealer_id)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(dealer_type)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(dealer_type)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(make_of_vehicle)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(make_of_vehicle)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(dealer_name)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(dealer_name)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(contact_person)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(contact_person)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(contact_details)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(contact_details)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(contact_email)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(contact_email)%%>', urlencode(''), $templateCode);
	}

	// process translations
	$templateCode = parseTemplate($templateCode);

	// clear scrap
	$templateCode = str_replace('<%%', '<!-- ', $templateCode);
	$templateCode = str_replace('%%>', ' -->', $templateCode);

	// hide links to inaccessible tables
	if(Request::val('dvprint_x') == '') {
		$templateCode .= "\n\n<script>\$j(function() {\n";
		$arrTables = getTableList();
		foreach($arrTables as $name => $caption) {
			$templateCode .= "\t\$j('#{$name}_link').removeClass('hidden');\n";
			$templateCode .= "\t\$j('#xs_{$name}_link').removeClass('hidden');\n";
		}

		$templateCode .= $jsReadOnly;
		$templateCode .= $jsEditable;

		if(!$selected_id) {
			$templateCode.="\n\tif(document.getElementById('contact_emailEdit')) { document.getElementById('contact_emailEdit').style.display='inline'; }";
			$templateCode.="\n\tif(document.getElementById('contact_emailEditLink')) { document.getElementById('contact_emailEditLink').style.display='none'; }";
		}

		$templateCode.="\n});</script>\n";
	}

	// ajaxed auto-fill fields
	$templateCode .= '<script>';
	$templateCode .= '$j(function() {';


	$templateCode.="});";
	$templateCode.="</script>";
	$templateCode .= $lookups;

	// handle enforced parent values for read-only lookup fields
	$filterField = Request::val('FilterField');
	$filterOperator = Request::val('FilterOperator');
	$filterValue = Request::val('FilterValue');

	// don't include blank images in lightbox gallery
	$templateCode = preg_replace('/blank.gif" data-lightbox=".*?"/', 'blank.gif"', $templateCode);

	// don't display empty email links
	$templateCode=preg_replace('/<a .*?href="mailto:".*?<\/a>/', '', $templateCode);

	/* default field values */
	$rdata = $jdata = get_defaults('dealer');
	if($selected_id) {
		$jdata = get_joined_record('dealer', $selected_id);
		if($jdata === false) $jdata = get_defaults('dealer');
		$rdata = $row;
	}
	$templateCode .= loadView('dealer-ajax-cache', ['rdata' => $rdata, 'jdata' => $jdata]);

	// hook: dealer_dv
	if(function_exists('dealer_dv')) {
		$args = [];
		dealer_dv(($selected_id ? $selected_id : FALSE), getMemberInfo(), $templateCode, $args);
	}

	return $templateCode;
}