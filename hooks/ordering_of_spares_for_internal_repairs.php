<?php

	/**
	 * @file
	 * This file contains hook functions that get called when data operations are performed on 'ordering_of_spares_for_internal_repairs' table. 
	 * For example, when a new record is added, when a record is edited, when a record is deleted, … etc.
	*/

	/**
	 * Called before rendering the page. This is a very powerful hook that allows you to control all aspects of how the page is rendered.
	 * 
	 * @param $options
	 * (passed by reference) a DataList object that sets options for rendering the page.
	 * @see https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks/DataList
	 * 
	 * @param $memberInfo
	 * An array containing logged member's info.
	 * @see https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks/memberInfo
	 * 
	 * @param $args
	 * An empty array that is passed by reference. It's currently not used but is reserved for future uses.
	 * 
	 * @return
	 * True to render the page. False to cancel the operation (which could be useful for error handling to display 
	 * an error message to the user and stop displaying any data).
	*/

	function ordering_of_spares_for_internal_repairs_init(&$options, $memberInfo, &$args) {

		return TRUE;
	}

	/**
	 * Called before displaying page content. Can be used to return a customized header template for the table.
	 * 
	 * @param $contentType
	 * specifies the type of view that will be displayed. Takes one the following values: 
	 * 'tableview', 'detailview', 'tableview+detailview', 'print-tableview', 'print-detailview', 'filters'
	 * 
	 * @param $memberInfo
	 * An array containing logged member's info.
	 * @see https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks/memberInfo
	 * 
	 * @param $args
	 * An empty array that is passed by reference. It's currently not used but is reserved for future uses.
	 * 
	 * @return
	 * String containing the HTML header code. If empty, the default 'header.php' is used. If you want to include
	 * the default header besides your customized header, include the <%%HEADER%%> placeholder in the returned string.
	*/

	function ordering_of_spares_for_internal_repairs_header($contentType, $memberInfo, &$args) {
		$header='';

		switch($contentType) {
			case 'tableview':
				$header='';
				break;

			case 'detailview':
				$header='';
				break;

			case 'tableview+detailview':
				$header='';
				break;

			case 'print-tableview':
				$header='';
				break;

			case 'print-detailview':
				$header='';
				break;

			case 'filters':
				$header='';
				break;
		}

		return $header;
	}

	/**
	 * Called after displaying page content. Can be used to return a customized footer template for the table.
	 * 
	 * @param $contentType
	 * specifies the type of view that will be displayed. Takes one the following values: 
	 * 'tableview', 'detailview', 'tableview+detailview', 'print-tableview', 'print-detailview', 'filters'
	 * 
	 * @param $memberInfo
	 * An array containing logged member's info.
	 * @see https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks/memberInfo
	 * 
	 * @param $args
	 * An empty array that is passed by reference. It's currently not used but is reserved for future uses.
	 * 
	 * @return
	 * String containing the HTML footer code. If empty, the default 'footer.php' is used. If you want to include 
	 * the default footer besides your customized footer, include the <%%FOOTER%%> placeholder in the returned string.
	*/

	function ordering_of_spares_for_internal_repairs_footer($contentType, $memberInfo, &$args) {
		$footer='';

		switch($contentType) {
			case 'tableview':
				$footer='';
				break;

			case 'detailview':
				$footer='';
				break;

			case 'tableview+detailview':
				$footer='';
				break;

			case 'print-tableview':
				$footer='';
				break;

			case 'print-detailview':
				$footer='';
				break;

			case 'filters':
				$footer='';
				break;
		}

		return $footer;
	}

	/**
	 * Called before executing the insert query.
	 * 
	 * @param $data
	 * An associative array where the keys are field names and the values are the field data values to be inserted into the new record.
	 * Note: if a field is set as read-only or hidden in detail view, it can't be modified through $data. You should use a direct SQL statement instead.
	 * For this table, the array items are: 
	 *     $data['workshop_name'], $data['job_card_number'], $data['artisan_name_and_surname'], $data['artisan_contacts'], $data['artisan_email_address'], $data['artisan_signature'], $data['internal_requisition_to_stores'], $data['supervisor_name_and_surname'], $data['supervisor_contact_details'], $data['supervisor_email_address'], $data['supervisor_signature'], $data['internal_requisition_to_stores_recommended'], $data['workshop_manager_name_and_surname'], $data['workshop_manager_contact_details'], $data['workshop_manager_email_address'], $data['workshop_manager_signature'], $data['internal_requisition_to_stores_approved'], $data['date_parts_ordered'], $data['vehicle_registration_number'], $data['engine_number'], $data['make_of_vehicle'], $data['part_type_1'], $data['part_name_1'], $data['description_1'], $data['manufacture_1'], $data['quality_1'], $data['unit_price_1'], $data['net_part_price_1'], $data['part_type_2'], $data['part_name_2'], $data['description_2'], $data['manufacture_2'], $data['quality_2'], $data['unit_price_2'], $data['net_part_price_2'], $data['part_type_3'], $data['part_name_3'], $data['description_3'], $data['manufacture_3'], $data['quality_3'], $data['unit_price_3'], $data['net_part_price_3'], $data['part_type_4'], $data['part_name_4'], $data['description_4'], $data['manufacture_4'], $data['quality_4'], $data['unit_price_4'], $data['net_part_price_4'], $data['part_type_5'], $data['part_name_5'], $data['description_5'], $data['manufacture_5'], $data['quality_5'], $data['unit_price_5'], $data['net_part_price_5'], $data['part_type_6'], $data['part_name_6'], $data['description_6'], $data['manufacture_6'], $data['quality_6'], $data['unit_price_6'], $data['net_part_price_6'], $data['part_type_7'], $data['part_name_7'], $data['description_7'], $data['manufacture_7'], $data['quality_7'], $data['unit_price_7'], $data['net_part_price_7'], $data['part_type_8'], $data['part_name_8'], $data['description_8'], $data['manufacture_8'], $data['unit_price_8'], $data['quality_8'], $data['net_part_price_8'], $data['tax'], $data['total_amount'], $data['attached_requisition_form'], $data['work_allocation_reference_number'], $data['date_parts_received']
	 * $data array is passed by reference so that modifications to it apply to the insert query.
	 * 
	 * @param $memberInfo
	 * An array containing logged member's info.
	 * @see https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks/memberInfo
	 * 
	 * @param $args
	 * An empty array that is passed by reference. It's currently not used but is reserved for future uses.
	 * 
	 * @return
	 * A boolean TRUE to perform the insert operation, or FALSE to cancel it.
	*/

	function ordering_of_spares_for_internal_repairs_before_insert(&$data, $memberInfo, &$args) {

		return TRUE;
	}

	/**
	 * Called after executing the insert query (but before executing the ownership insert query).
	 * 
	 * @param $data
	 * An associative array where the keys are field names and the values are the field data values that were inserted into the new record.
	 * For this table, the array items are: 
	 *     $data['workshop_name'], $data['job_card_number'], $data['artisan_name_and_surname'], $data['artisan_contacts'], $data['artisan_email_address'], $data['artisan_signature'], $data['internal_requisition_to_stores'], $data['supervisor_name_and_surname'], $data['supervisor_contact_details'], $data['supervisor_email_address'], $data['supervisor_signature'], $data['internal_requisition_to_stores_recommended'], $data['workshop_manager_name_and_surname'], $data['workshop_manager_contact_details'], $data['workshop_manager_email_address'], $data['workshop_manager_signature'], $data['internal_requisition_to_stores_approved'], $data['date_parts_ordered'], $data['vehicle_registration_number'], $data['engine_number'], $data['make_of_vehicle'], $data['part_type_1'], $data['part_name_1'], $data['description_1'], $data['manufacture_1'], $data['quality_1'], $data['unit_price_1'], $data['net_part_price_1'], $data['part_type_2'], $data['part_name_2'], $data['description_2'], $data['manufacture_2'], $data['quality_2'], $data['unit_price_2'], $data['net_part_price_2'], $data['part_type_3'], $data['part_name_3'], $data['description_3'], $data['manufacture_3'], $data['quality_3'], $data['unit_price_3'], $data['net_part_price_3'], $data['part_type_4'], $data['part_name_4'], $data['description_4'], $data['manufacture_4'], $data['quality_4'], $data['unit_price_4'], $data['net_part_price_4'], $data['part_type_5'], $data['part_name_5'], $data['description_5'], $data['manufacture_5'], $data['quality_5'], $data['unit_price_5'], $data['net_part_price_5'], $data['part_type_6'], $data['part_name_6'], $data['description_6'], $data['manufacture_6'], $data['quality_6'], $data['unit_price_6'], $data['net_part_price_6'], $data['part_type_7'], $data['part_name_7'], $data['description_7'], $data['manufacture_7'], $data['quality_7'], $data['unit_price_7'], $data['net_part_price_7'], $data['part_type_8'], $data['part_name_8'], $data['description_8'], $data['manufacture_8'], $data['unit_price_8'], $data['quality_8'], $data['net_part_price_8'], $data['tax'], $data['total_amount'], $data['attached_requisition_form'], $data['work_allocation_reference_number'], $data['date_parts_received']
	 * Also includes the item $data['selectedID'] which stores the value of the primary key for the new record.
	 * 
	 * @param $memberInfo
	 * An array containing logged member's info.
	 * @see https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks/memberInfo
	 * 
	 * @param $args
	 * An empty array that is passed by reference. It's currently not used but is reserved for future uses.
	 * 
	 * @return
	 * A boolean TRUE to perform the ownership insert operation or FALSE to cancel it.
	 * Warning: if a FALSE is returned, the new record will have no ownership info.
	*/

	function ordering_of_spares_for_internal_repairs_after_insert($data, $memberInfo, &$args) {

		return TRUE;
	}

	/**
	 * Called before executing the update query.
	 * 
	 * @param $data
	 * An associative array where the keys are field names and the values are the field data values.
	 * Note: if a field is set as read-only or hidden in detail view, it can't be modified through $data. You should use a direct SQL statement instead.
	 * For this table, the array items are: 
	 *     $data['spares_id'], $data['workshop_name'], $data['job_card_number'], $data['artisan_name_and_surname'], $data['artisan_contacts'], $data['artisan_email_address'], $data['artisan_signature'], $data['internal_requisition_to_stores'], $data['supervisor_name_and_surname'], $data['supervisor_contact_details'], $data['supervisor_email_address'], $data['supervisor_signature'], $data['internal_requisition_to_stores_recommended'], $data['workshop_manager_name_and_surname'], $data['workshop_manager_contact_details'], $data['workshop_manager_email_address'], $data['workshop_manager_signature'], $data['internal_requisition_to_stores_approved'], $data['date_parts_ordered'], $data['vehicle_registration_number'], $data['engine_number'], $data['make_of_vehicle'], $data['part_type_1'], $data['part_name_1'], $data['description_1'], $data['manufacture_1'], $data['quality_1'], $data['unit_price_1'], $data['net_part_price_1'], $data['part_type_2'], $data['part_name_2'], $data['description_2'], $data['manufacture_2'], $data['quality_2'], $data['unit_price_2'], $data['net_part_price_2'], $data['part_type_3'], $data['part_name_3'], $data['description_3'], $data['manufacture_3'], $data['quality_3'], $data['unit_price_3'], $data['net_part_price_3'], $data['part_type_4'], $data['part_name_4'], $data['description_4'], $data['manufacture_4'], $data['quality_4'], $data['unit_price_4'], $data['net_part_price_4'], $data['part_type_5'], $data['part_name_5'], $data['description_5'], $data['manufacture_5'], $data['quality_5'], $data['unit_price_5'], $data['net_part_price_5'], $data['part_type_6'], $data['part_name_6'], $data['description_6'], $data['manufacture_6'], $data['quality_6'], $data['unit_price_6'], $data['net_part_price_6'], $data['part_type_7'], $data['part_name_7'], $data['description_7'], $data['manufacture_7'], $data['quality_7'], $data['unit_price_7'], $data['net_part_price_7'], $data['part_type_8'], $data['part_name_8'], $data['description_8'], $data['manufacture_8'], $data['unit_price_8'], $data['quality_8'], $data['net_part_price_8'], $data['tax'], $data['total_amount'], $data['attached_requisition_form'], $data['work_allocation_reference_number'], $data['date_parts_received']
	 * Also includes the item $data['selectedID'] which stores the value of the primary key for the record to be updated.
	 * $data array is passed by reference so that modifications to it apply to the update query.
	 * 
	 * @param $memberInfo
	 * An array containing logged member's info.
	 * @see https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks/memberInfo
	 * 
	 * @param $args
	 * An empty array that is passed by reference. It's currently not used but is reserved for future uses.
	 * 
	 * @return
	 * True to perform the update operation or false to cancel it.
	*/

	function ordering_of_spares_for_internal_repairs_before_update(&$data, $memberInfo, &$args) {

		return TRUE;
	}

	/**
	 * Called after executing the update query and before executing the ownership update query.
	 * 
	 * @param $data
	 * An associative array where the keys are field names and the values are the field data values.
	 * For this table, the array items are: 
	 *     $data['spares_id'], $data['workshop_name'], $data['job_card_number'], $data['artisan_name_and_surname'], $data['artisan_contacts'], $data['artisan_email_address'], $data['artisan_signature'], $data['internal_requisition_to_stores'], $data['supervisor_name_and_surname'], $data['supervisor_contact_details'], $data['supervisor_email_address'], $data['supervisor_signature'], $data['internal_requisition_to_stores_recommended'], $data['workshop_manager_name_and_surname'], $data['workshop_manager_contact_details'], $data['workshop_manager_email_address'], $data['workshop_manager_signature'], $data['internal_requisition_to_stores_approved'], $data['date_parts_ordered'], $data['vehicle_registration_number'], $data['engine_number'], $data['make_of_vehicle'], $data['part_type_1'], $data['part_name_1'], $data['description_1'], $data['manufacture_1'], $data['quality_1'], $data['unit_price_1'], $data['net_part_price_1'], $data['part_type_2'], $data['part_name_2'], $data['description_2'], $data['manufacture_2'], $data['quality_2'], $data['unit_price_2'], $data['net_part_price_2'], $data['part_type_3'], $data['part_name_3'], $data['description_3'], $data['manufacture_3'], $data['quality_3'], $data['unit_price_3'], $data['net_part_price_3'], $data['part_type_4'], $data['part_name_4'], $data['description_4'], $data['manufacture_4'], $data['quality_4'], $data['unit_price_4'], $data['net_part_price_4'], $data['part_type_5'], $data['part_name_5'], $data['description_5'], $data['manufacture_5'], $data['quality_5'], $data['unit_price_5'], $data['net_part_price_5'], $data['part_type_6'], $data['part_name_6'], $data['description_6'], $data['manufacture_6'], $data['quality_6'], $data['unit_price_6'], $data['net_part_price_6'], $data['part_type_7'], $data['part_name_7'], $data['description_7'], $data['manufacture_7'], $data['quality_7'], $data['unit_price_7'], $data['net_part_price_7'], $data['part_type_8'], $data['part_name_8'], $data['description_8'], $data['manufacture_8'], $data['unit_price_8'], $data['quality_8'], $data['net_part_price_8'], $data['tax'], $data['total_amount'], $data['attached_requisition_form'], $data['work_allocation_reference_number'], $data['date_parts_received']
	 * Also includes the item $data['selectedID'] which stores the value of the primary key for the record.
	 * 
	 * @param $memberInfo
	 * An array containing logged member's info.
	 * @see https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks/memberInfo
	 * 
	 * @param $args
	 * An empty array that is passed by reference. It's currently not used but is reserved for future uses.
	 * 
	 * @return
	 * True to perform the ownership update operation or false to cancel it. 
	*/

	function ordering_of_spares_for_internal_repairs_after_update($data, $memberInfo, &$args) {

		return TRUE;
	}

	/**
	 * Called before deleting a record (and before performing child records check).
	 * 
	 * @param $selectedID
	 * The primary key value of the record to be deleted.
	 * 
	 * @param $skipChecks
	 * A flag passed by reference that determines whether child records check should be performed or not.
	 * If you set $skipChecks to TRUE, no child records check will be made. If you set it to FALSE, the check will be performed.
	 * 
	 * @param $memberInfo
	 * An array containing logged member's info.
	 * @see https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks/memberInfo
	 * 
	 * @param $args
	 * An empty array that is passed by reference. It's currently not used but is reserved for future uses.
	 * 
	 * @return
	 * True to perform the delete operation or false to cancel it.
	*/

	function ordering_of_spares_for_internal_repairs_before_delete($selectedID, &$skipChecks, $memberInfo, &$args) {

		return TRUE;
	}

	/**
	 * Called after deleting a record.
	 * 
	 * @param $selectedID
	 * The primary key value of the record to be deleted.
	 * 
	 * @param $memberInfo
	 * An array containing logged member's info.
	 * @see https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks/memberInfo
	 * 
	 * @param $args
	 * An empty array that is passed by reference. It's currently not used but is reserved for future uses.
	 * 
	 * @return
	 * None.
	*/

	function ordering_of_spares_for_internal_repairs_after_delete($selectedID, $memberInfo, &$args) {

	}

	/**
	 * Called when a user requests to view the detail view (before displaying the detail view).
	 * 
	 * @param $selectedID
	 * The primary key value of the record selected. False if no record is selected (i.e. the detail view will be 
	 * displayed to enter a new record).
	 * 
	 * @param $memberInfo
	 * An array containing logged member's info.
	 * @see https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks/memberInfo
	 * 
	 * @param $html
	 * (passed by reference) the HTML code of the form ready to be displayed. This could be useful for manipulating 
	 * the code before displaying it using regular expressions, … etc.
	 * 
	 * @param $args
	 * An empty array that is passed by reference. It's currently not used but is reserved for future uses.
	 * 
	 * @return
	 * None.
	*/

	function ordering_of_spares_for_internal_repairs_dv($selectedID, $memberInfo, &$html, &$args) {

	}

	/**
	 * Called when a user requests to download table data as a CSV file (by clicking on the SAVE CSV button)
	 * 
	 * @param $query
	 * Contains the query that will be executed to return the data in the CSV file.
	 * 
	 * @param $memberInfo
	 * An array containing logged member's info.
	 * @see https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks/memberInfo
	 * 
	 * @param $args
	 * An empty array. It's currently not used but is reserved for future uses.
	 * 
	 * @return
	 * A string containing the query to use for fetching the CSV data. If FALSE or empty is returned, the default query is used.
	*/

	function ordering_of_spares_for_internal_repairs_csv($query, $memberInfo, &$args) {

		return $query;
	}
	/**
	 * Called when displaying the table view to retrieve custom record actions
	 * 
	 * @return
	 * A 2D array describing custom record actions. The format of the array is:
	 *   [
	 *      [
	 *         'title' => 'Title', // the title/label of the custom action as displayed to users
	 *         'function' => 'js_function_name', // the name of a javascript function to be executed when user selects this action
	 *         'class' => 'CSS class(es) to apply to the action title', // optional, refer to Bootstrap documentation for CSS classes
	 *         'icon' => 'icon name' // optional, refer to Bootstrap glyphicons for supported names
	 *      ], ...
	 *   ]
	*/

	function ordering_of_spares_for_internal_repairs_batch_actions(&$args) {

		return [];
	}
