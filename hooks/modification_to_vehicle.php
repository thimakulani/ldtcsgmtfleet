<?php

	/**
	 * @file
	 * This file contains hook functions that get called when data operations are performed on 'modification_to_vehicle' table. 
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

	function modification_to_vehicle_init(&$options, $memberInfo, &$args) {

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

	function modification_to_vehicle_header($contentType, $memberInfo, &$args) {
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

	function modification_to_vehicle_footer($contentType, $memberInfo, &$args) {
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
	 *     $data['type_of_vehicle'], $data['directorate'], $data['head_office'], $data['districts'], $data['drivers_name_and_surname'], $data['drivers_persal_number'], $data['drivers_contact_details'], $data['driver_rank'], $data['driver_signature'], $data['vehicle_registration_number'], $data['make_of_vehicle'], $data['model_of_vehicle'], $data['closing_km'], $data['job_card_number'], $data['objective'], $data['fuel_gauge_amount'], $data['keys_ignition'], $data['petrol_cap_with_keys'], $data['padlock_with_keys'], $data['tyre_r_f'], $data['tyre_r_f_1'], $data['tyre_r_r'], $data['tyre_r_r_1'], $data['tyre_l_f'], $data['tyre_l_f_1'], $data['tyer_l_r'], $data['tyer_l_r_1'], $data['tyre_spare'], $data['tyre_spare_1'], $data['wheel_cups'], $data['other'], $data['battery'], $data['battery_voltage'], $data['wheel_spanner'], $data['jack_with_handle'], $data['radio_dvd_combination'], $data['petrol_card'], $data['valid_license_disc'], $data['valid_license_disc_date'], $data['fire_extinguisher'], $data['warning_signs_traingle'], $data['date_checked_in'], $data['testing_officer_name_and_surname'], $data['testing_officer_persal_number'], $data['testing_officer_rank'], $data['testing_officer_signature'], $data['date_received'], $data['supervisor_for_allocation_name_and_surname'], $data['supervisor_for_allocation_persal_number'], $data['supervisor_for_allocation_rank'], $data['supervisor_for_allocation_signature']
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

	function modification_to_vehicle_before_insert(&$data, $memberInfo, &$args) {

		return TRUE;
	}

	/**
	 * Called after executing the insert query (but before executing the ownership insert query).
	 * 
	 * @param $data
	 * An associative array where the keys are field names and the values are the field data values that were inserted into the new record.
	 * For this table, the array items are: 
	 *     $data['type_of_vehicle'], $data['directorate'], $data['head_office'], $data['districts'], $data['drivers_name_and_surname'], $data['drivers_persal_number'], $data['drivers_contact_details'], $data['driver_rank'], $data['driver_signature'], $data['vehicle_registration_number'], $data['make_of_vehicle'], $data['model_of_vehicle'], $data['closing_km'], $data['job_card_number'], $data['objective'], $data['fuel_gauge_amount'], $data['keys_ignition'], $data['petrol_cap_with_keys'], $data['padlock_with_keys'], $data['tyre_r_f'], $data['tyre_r_f_1'], $data['tyre_r_r'], $data['tyre_r_r_1'], $data['tyre_l_f'], $data['tyre_l_f_1'], $data['tyer_l_r'], $data['tyer_l_r_1'], $data['tyre_spare'], $data['tyre_spare_1'], $data['wheel_cups'], $data['other'], $data['battery'], $data['battery_voltage'], $data['wheel_spanner'], $data['jack_with_handle'], $data['radio_dvd_combination'], $data['petrol_card'], $data['valid_license_disc'], $data['valid_license_disc_date'], $data['fire_extinguisher'], $data['warning_signs_traingle'], $data['date_checked_in'], $data['testing_officer_name_and_surname'], $data['testing_officer_persal_number'], $data['testing_officer_rank'], $data['testing_officer_signature'], $data['date_received'], $data['supervisor_for_allocation_name_and_surname'], $data['supervisor_for_allocation_persal_number'], $data['supervisor_for_allocation_rank'], $data['supervisor_for_allocation_signature']
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

	function modification_to_vehicle_after_insert($data, $memberInfo, &$args) {

		return TRUE;
	}

	/**
	 * Called before executing the update query.
	 * 
	 * @param $data
	 * An associative array where the keys are field names and the values are the field data values.
	 * Note: if a field is set as read-only or hidden in detail view, it can't be modified through $data. You should use a direct SQL statement instead.
	 * For this table, the array items are: 
	 *     $data['modification_id'], $data['type_of_vehicle'], $data['directorate'], $data['head_office'], $data['districts'], $data['drivers_name_and_surname'], $data['drivers_persal_number'], $data['drivers_contact_details'], $data['driver_rank'], $data['driver_signature'], $data['vehicle_registration_number'], $data['make_of_vehicle'], $data['model_of_vehicle'], $data['closing_km'], $data['job_card_number'], $data['objective'], $data['fuel_gauge_amount'], $data['keys_ignition'], $data['petrol_cap_with_keys'], $data['padlock_with_keys'], $data['tyre_r_f'], $data['tyre_r_f_1'], $data['tyre_r_r'], $data['tyre_r_r_1'], $data['tyre_l_f'], $data['tyre_l_f_1'], $data['tyer_l_r'], $data['tyer_l_r_1'], $data['tyre_spare'], $data['tyre_spare_1'], $data['wheel_cups'], $data['other'], $data['battery'], $data['battery_voltage'], $data['wheel_spanner'], $data['jack_with_handle'], $data['radio_dvd_combination'], $data['petrol_card'], $data['valid_license_disc'], $data['valid_license_disc_date'], $data['fire_extinguisher'], $data['warning_signs_traingle'], $data['date_checked_in'], $data['testing_officer_name_and_surname'], $data['testing_officer_persal_number'], $data['testing_officer_rank'], $data['testing_officer_signature'], $data['date_received'], $data['supervisor_for_allocation_name_and_surname'], $data['supervisor_for_allocation_persal_number'], $data['supervisor_for_allocation_rank'], $data['supervisor_for_allocation_signature']
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

	function modification_to_vehicle_before_update(&$data, $memberInfo, &$args) {

		return TRUE;
	}

	/**
	 * Called after executing the update query and before executing the ownership update query.
	 * 
	 * @param $data
	 * An associative array where the keys are field names and the values are the field data values.
	 * For this table, the array items are: 
	 *     $data['modification_id'], $data['type_of_vehicle'], $data['directorate'], $data['head_office'], $data['districts'], $data['drivers_name_and_surname'], $data['drivers_persal_number'], $data['drivers_contact_details'], $data['driver_rank'], $data['driver_signature'], $data['vehicle_registration_number'], $data['make_of_vehicle'], $data['model_of_vehicle'], $data['closing_km'], $data['job_card_number'], $data['objective'], $data['fuel_gauge_amount'], $data['keys_ignition'], $data['petrol_cap_with_keys'], $data['padlock_with_keys'], $data['tyre_r_f'], $data['tyre_r_f_1'], $data['tyre_r_r'], $data['tyre_r_r_1'], $data['tyre_l_f'], $data['tyre_l_f_1'], $data['tyer_l_r'], $data['tyer_l_r_1'], $data['tyre_spare'], $data['tyre_spare_1'], $data['wheel_cups'], $data['other'], $data['battery'], $data['battery_voltage'], $data['wheel_spanner'], $data['jack_with_handle'], $data['radio_dvd_combination'], $data['petrol_card'], $data['valid_license_disc'], $data['valid_license_disc_date'], $data['fire_extinguisher'], $data['warning_signs_traingle'], $data['date_checked_in'], $data['testing_officer_name_and_surname'], $data['testing_officer_persal_number'], $data['testing_officer_rank'], $data['testing_officer_signature'], $data['date_received'], $data['supervisor_for_allocation_name_and_surname'], $data['supervisor_for_allocation_persal_number'], $data['supervisor_for_allocation_rank'], $data['supervisor_for_allocation_signature']
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

	function modification_to_vehicle_after_update($data, $memberInfo, &$args) {

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

	function modification_to_vehicle_before_delete($selectedID, &$skipChecks, $memberInfo, &$args) {

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

	function modification_to_vehicle_after_delete($selectedID, $memberInfo, &$args) {

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

	function modification_to_vehicle_dv($selectedID, $memberInfo, &$html, &$args) {

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

	function modification_to_vehicle_csv($query, $memberInfo, &$args) {

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

	function modification_to_vehicle_batch_actions(&$args) {

		return [];
	}
