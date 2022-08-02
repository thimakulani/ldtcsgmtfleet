<?php

// Data functions (insert, update, delete, form) for table auditor

// This script and data application were generated by AppGini 22.13
// Download AppGini for free from https://bigprof.com/appgini/download/

function auditor_insert(&$error_message = '') {
	global $Translation;

	// mm: can member insert record?
	$arrPerm = getTablePermissions('auditor');
	if(!$arrPerm['insert']) return false;

	$data = [
		'res_id' => Request::val('res_id', ''),
		'username' => Request::val('username', ''),
		'ipaddr' => Request::val('ipaddr', ''),
		'time_stmp' => Request::val('time_stmp', ''),
		'change_type' => Request::val('change_type', ''),
		'table_name' => Request::val('table_name', ''),
		'fieldName' => Request::val('fieldName', ''),
		'OldValue' => Request::val('OldValue', ''),
		'NewValue' => Request::val('NewValue', ''),
	];


	// hook: auditor_before_insert
	if(function_exists('auditor_before_insert')) {
		$args = [];
		if(!auditor_before_insert($data, getMemberInfo(), $args)) {
			if(isset($args['error_message'])) $error_message = $args['error_message'];
			return false;
		}
	}

	$error = '';
	// set empty fields to NULL
	$data = array_map(function($v) { return ($v === '' ? NULL : $v); }, $data);
	insert('auditor', backtick_keys_once($data), $error);
	if($error) {
		$error_message = $error;
		return false;
	}

	$recID = db_insert_id(db_link());

	update_calc_fields('auditor', $recID, calculated_fields()['auditor']);

	// hook: auditor_after_insert
	if(function_exists('auditor_after_insert')) {
		$res = sql("SELECT * FROM `auditor` WHERE `auditor_id`='" . makeSafe($recID, false) . "' LIMIT 1", $eo);
		if($row = db_fetch_assoc($res)) {
			$data = array_map('makeSafe', $row);
		}
		$data['selectedID'] = makeSafe($recID, false);
		$args = [];
		if(!auditor_after_insert($data, getMemberInfo(), $args)) { return $recID; }
	}

	// mm: save ownership data
	set_record_owner('auditor', $recID, getLoggedMemberID());

	// if this record is a copy of another record, copy children if applicable
	if(strlen(Request::val('SelectedID'))) auditor_copy_children($recID, Request::val('SelectedID'));

	return $recID;
}

function auditor_copy_children($destination_id, $source_id) {
	global $Translation;
	$requests = []; // array of curl handlers for launching insert requests
	$eo = ['silentErrors' => true];
	$safe_sid = makeSafe($source_id);

	// launch requests, asynchronously
	curl_batch($requests);
}

function auditor_delete($selected_id, $AllowDeleteOfParents = false, $skipChecks = false) {
	// insure referential integrity ...
	global $Translation;
	$selected_id = makeSafe($selected_id);

	// mm: can member delete record?
	if(!check_record_permission('auditor', $selected_id, 'delete')) {
		return $Translation['You don\'t have enough permissions to delete this record'];
	}

	// hook: auditor_before_delete
	if(function_exists('auditor_before_delete')) {
		$args = [];
		if(!auditor_before_delete($selected_id, $skipChecks, getMemberInfo(), $args))
			return $Translation['Couldn\'t delete this record'] . (
				!empty($args['error_message']) ?
					'<div class="text-bold">' . strip_tags($args['error_message']) . '</div>'
					: '' 
			);
	}

	sql("DELETE FROM `auditor` WHERE `auditor_id`='{$selected_id}'", $eo);

	// hook: auditor_after_delete
	if(function_exists('auditor_after_delete')) {
		$args = [];
		auditor_after_delete($selected_id, getMemberInfo(), $args);
	}

	// mm: delete ownership data
	sql("DELETE FROM `membership_userrecords` WHERE `tableName`='auditor' AND `pkValue`='{$selected_id}'", $eo);
}

function auditor_update(&$selected_id, &$error_message = '') {
	global $Translation;

	// mm: can member edit record?
	if(!check_record_permission('auditor', $selected_id, 'edit')) return false;

	$data = [
		'res_id' => Request::val('res_id', ''),
		'username' => Request::val('username', ''),
		'ipaddr' => Request::val('ipaddr', ''),
		'time_stmp' => Request::val('time_stmp', ''),
		'change_type' => Request::val('change_type', ''),
		'table_name' => Request::val('table_name', ''),
		'fieldName' => Request::val('fieldName', ''),
		'OldValue' => Request::val('OldValue', ''),
		'NewValue' => Request::val('NewValue', ''),
	];

	// get existing values
	$old_data = getRecord('auditor', $selected_id);
	if(is_array($old_data)) {
		$old_data = array_map('makeSafe', $old_data);
		$old_data['selectedID'] = makeSafe($selected_id);
	}

	$data['selectedID'] = makeSafe($selected_id);

	// hook: auditor_before_update
	if(function_exists('auditor_before_update')) {
		$args = ['old_data' => $old_data];
		if(!auditor_before_update($data, getMemberInfo(), $args)) {
			if(isset($args['error_message'])) $error_message = $args['error_message'];
			return false;
		}
	}

	$set = $data; unset($set['selectedID']);
	foreach ($set as $field => $value) {
		$set[$field] = ($value !== '' && $value !== NULL) ? $value : NULL;
	}

	if(!update(
		'auditor', 
		backtick_keys_once($set), 
		['`auditor_id`' => $selected_id], 
		$error_message
	)) {
		echo $error_message;
		echo '<a href="auditor_view.php?SelectedID=' . urlencode($selected_id) . "\">{$Translation['< back']}</a>";
		exit;
	}


	$eo = ['silentErrors' => true];

	update_calc_fields('auditor', $data['selectedID'], calculated_fields()['auditor']);

	// hook: auditor_after_update
	if(function_exists('auditor_after_update')) {
		$res = sql("SELECT * FROM `auditor` WHERE `auditor_id`='{$data['selectedID']}' LIMIT 1", $eo);
		if($row = db_fetch_assoc($res)) $data = array_map('makeSafe', $row);

		$data['selectedID'] = $data['auditor_id'];
		$args = ['old_data' => $old_data];
		if(!auditor_after_update($data, getMemberInfo(), $args)) return;
	}

	// mm: update ownership data
	sql("UPDATE `membership_userrecords` SET `dateUpdated`='" . time() . "' WHERE `tableName`='auditor' AND `pkValue`='" . makeSafe($selected_id) . "'", $eo);
}

function auditor_form($selected_id = '', $AllowUpdate = 1, $AllowInsert = 1, $AllowDelete = 1, $separateDV = 0, $TemplateDV = '', $TemplateDVP = '') {
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
	$arrPerm = getTablePermissions('auditor');
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


	// populate filterers, starting from children to grand-parents

	// unique random identifier
	$rnd1 = ($dvprint ? rand(1000000, 9999999) : '');

	if($selected_id) {
		// mm: check member permissions
		if(!$arrPerm['view']) return $Translation['tableAccessDenied'];

		// mm: who is the owner?
		$ownerGroupID = sqlValue("SELECT `groupID` FROM `membership_userrecords` WHERE `tableName`='auditor' AND `pkValue`='" . makeSafe($selected_id) . "'");
		$ownerMemberID = sqlValue("SELECT LCASE(`memberID`) FROM `membership_userrecords` WHERE `tableName`='auditor' AND `pkValue`='" . makeSafe($selected_id) . "'");

		if($arrPerm['view'] == 1 && getLoggedMemberID() != $ownerMemberID) return $Translation['tableAccessDenied'];
		if($arrPerm['view'] == 2 && getLoggedGroupID() != $ownerGroupID) return $Translation['tableAccessDenied'];

		// can edit?
		$AllowUpdate = 0;
		if(($arrPerm['edit'] == 1 && $ownerMemberID == getLoggedMemberID()) || ($arrPerm['edit'] == 2 && $ownerGroupID == getLoggedGroupID()) || $arrPerm['edit'] == 3) {
			$AllowUpdate = 1;
		}

		$res = sql("SELECT * FROM `auditor` WHERE `auditor_id`='" . makeSafe($selected_id) . "'", $eo);
		if(!($row = db_fetch_array($res))) {
			return error_message($Translation['No records found'], 'auditor_view.php', false);
		}
		$urow = $row; /* unsanitized data */
		$row = array_map('safe_html', $row);
	} else {
		$filterField = Request::val('FilterField');
		$filterOperator = Request::val('FilterOperator');
		$filterValue = Request::val('FilterValue');
	}

	ob_start();
	?>

	<script>
		// initial lookup values

		jQuery(function() {
			setTimeout(function() {
			}, 50); /* we need to slightly delay client-side execution of the above code to allow AppGini.ajaxCache to work */
		});
	</script>
	<?php

	$lookups = str_replace('__RAND__', $rnd1, ob_get_clean());


	// code for template based detail view forms

	// open the detail view template
	if($dvprint) {
		$template_file = is_file("./{$TemplateDVP}") ? "./{$TemplateDVP}" : './templates/auditor_templateDVP.html';
		$templateCode = @file_get_contents($template_file);
	} else {
		$template_file = is_file("./{$TemplateDV}") ? "./{$TemplateDV}" : './templates/auditor_templateDV.html';
		$templateCode = @file_get_contents($template_file);
	}

	// process form title
	$templateCode = str_replace('<%%DETAIL_VIEW_TITLE%%>', 'Auditor Details:', $templateCode);
	$templateCode = str_replace('<%%RND1%%>', $rnd1, $templateCode);
	$templateCode = str_replace('<%%EMBEDDED%%>', (Request::val('Embedded') ? 'Embedded=1' : ''), $templateCode);
	// process buttons
	if($arrPerm['insert'] && !$selected_id) { // allow insert and no record selected?
		if(!$selected_id) $templateCode = str_replace('<%%INSERT_BUTTON%%>', '<button type="submit" class="btn btn-success" id="insert" name="insert_x" value="1" onclick="return auditor_validateData();"><i class="glyphicon glyphicon-plus-sign"></i> ' . $Translation['Save New'] . '</button>', $templateCode);
		$templateCode = str_replace('<%%INSERT_BUTTON%%>', '<button type="submit" class="btn btn-default" id="insert" name="insert_x" value="1" onclick="return auditor_validateData();"><i class="glyphicon glyphicon-plus-sign"></i> ' . $Translation['Save As Copy'] . '</button>', $templateCode);
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
			$templateCode = str_replace('<%%UPDATE_BUTTON%%>', '<button type="submit" class="btn btn-success btn-lg" id="update" name="update_x" value="1" onclick="return auditor_validateData();" title="' . html_attr($Translation['Save Changes']) . '"><i class="glyphicon glyphicon-ok"></i> ' . $Translation['Save Changes'] . '</button>', $templateCode);
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
		$jsReadOnly .= "\tjQuery('#res_id').replaceWith('<div class=\"form-control-static\" id=\"res_id\">' + (jQuery('#res_id').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#username').replaceWith('<div class=\"form-control-static\" id=\"username\">' + (jQuery('#username').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#ipaddr').replaceWith('<div class=\"form-control-static\" id=\"ipaddr\">' + (jQuery('#ipaddr').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#time_stmp').replaceWith('<div class=\"form-control-static\" id=\"time_stmp\">' + (jQuery('#time_stmp').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#change_type').replaceWith('<div class=\"form-control-static\" id=\"change_type\">' + (jQuery('#change_type').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#table_name').replaceWith('<div class=\"form-control-static\" id=\"table_name\">' + (jQuery('#table_name').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#fieldName').replaceWith('<div class=\"form-control-static\" id=\"fieldName\">' + (jQuery('#fieldName').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#OldValue').replaceWith('<div class=\"form-control-static\" id=\"OldValue\">' + (jQuery('#OldValue').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#NewValue').replaceWith('<div class=\"form-control-static\" id=\"NewValue\">' + (jQuery('#NewValue').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('.select2-container').hide();\n";

		$noUploads = true;
	} elseif(($AllowInsert && !$selected_id) || ($AllowUpdate && $selected_id)) {
		$jsEditable = "\tjQuery('form').eq(0).data('already_changed', true);"; // temporarily disable form change handler
		$jsEditable .= "\tjQuery('form').eq(0).data('already_changed', false);"; // re-enable form change handler
	}

	// process combos

	/* lookup fields array: 'lookup field name' => ['parent table name', 'lookup field caption'] */
	$lookup_fields = [];
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
	$templateCode = str_replace('<%%UPLOADFILE(auditor_id)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(res_id)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(username)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(ipaddr)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(time_stmp)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(change_type)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(table_name)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(fieldName)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(OldValue)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(NewValue)%%>', '', $templateCode);

	// process values
	if($selected_id) {
		if( $dvprint) $templateCode = str_replace('<%%VALUE(auditor_id)%%>', safe_html($urow['auditor_id']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(auditor_id)%%>', html_attr($row['auditor_id']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(auditor_id)%%>', urlencode($urow['auditor_id']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(res_id)%%>', safe_html($urow['res_id']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(res_id)%%>', html_attr($row['res_id']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(res_id)%%>', urlencode($urow['res_id']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(username)%%>', safe_html($urow['username']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(username)%%>', html_attr($row['username']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(username)%%>', urlencode($urow['username']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(ipaddr)%%>', safe_html($urow['ipaddr']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(ipaddr)%%>', html_attr($row['ipaddr']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(ipaddr)%%>', urlencode($urow['ipaddr']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(time_stmp)%%>', safe_html($urow['time_stmp']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(time_stmp)%%>', html_attr($row['time_stmp']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(time_stmp)%%>', urlencode($urow['time_stmp']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(change_type)%%>', safe_html($urow['change_type']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(change_type)%%>', html_attr($row['change_type']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(change_type)%%>', urlencode($urow['change_type']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(table_name)%%>', safe_html($urow['table_name']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(table_name)%%>', html_attr($row['table_name']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(table_name)%%>', urlencode($urow['table_name']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(fieldName)%%>', safe_html($urow['fieldName']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(fieldName)%%>', html_attr($row['fieldName']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(fieldName)%%>', urlencode($urow['fieldName']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(OldValue)%%>', safe_html($urow['OldValue']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(OldValue)%%>', html_attr($row['OldValue']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(OldValue)%%>', urlencode($urow['OldValue']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(NewValue)%%>', safe_html($urow['NewValue']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(NewValue)%%>', html_attr($row['NewValue']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(NewValue)%%>', urlencode($urow['NewValue']), $templateCode);
	} else {
		$templateCode = str_replace('<%%VALUE(auditor_id)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(auditor_id)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(res_id)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(res_id)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(username)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(username)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(ipaddr)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(ipaddr)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(time_stmp)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(time_stmp)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(change_type)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(change_type)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(table_name)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(table_name)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(fieldName)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(fieldName)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(OldValue)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(OldValue)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(NewValue)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(NewValue)%%>', urlencode(''), $templateCode);
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
	$rdata = $jdata = get_defaults('auditor');
	if($selected_id) {
		$jdata = get_joined_record('auditor', $selected_id);
		if($jdata === false) $jdata = get_defaults('auditor');
		$rdata = $row;
	}
	$templateCode .= loadView('auditor-ajax-cache', ['rdata' => $rdata, 'jdata' => $jdata]);

	// hook: auditor_dv
	if(function_exists('auditor_dv')) {
		$args = [];
		auditor_dv(($selected_id ? $selected_id : FALSE), getMemberInfo(), $templateCode, $args);
	}

	return $templateCode;
}