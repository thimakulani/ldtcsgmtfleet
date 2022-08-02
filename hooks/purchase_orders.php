<?php

	/**
	 * @file
	 * This file contains hook functions that get called when data operations are performed on 'purchase_orders' table. 
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

	function purchase_orders_init(&$options, $memberInfo, &$args){

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

	function purchase_orders_header($contentType, $memberInfo, &$args){
		$header='';

		switch($contentType){
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

	function purchase_orders_footer($contentType, $memberInfo, &$args){
		$footer='';

		switch($contentType){
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
	 *     $data['purchased_order_number'], $data['purchased_date'], $data['purchaser'], $data['vehicle_registration_number'], $data['type_of_vehicle'], $data['manufacturer'], $data['service_type'], $data['service_category'], $data['service_item'], $data['upload_quotation'], $data['due_date'], $data['merchant_name'], $data['date_of_service'], $data['closing_km'], $data['labour_category_1'], $data['part_number_1'], $data['part_name_1'], $data['part_manufacturer_name_1'], $data['quantity_1'], $data['expense_of_item_1'], $data['labour_category_2'], $data['part_number_2'], $data['part_name_2'], $data['part_manufacturer_name_2'], $data['quantity_2'], $data['expense_of_item_2'], $data['labour_category_3'], $data['part_number_3'], $data['part_name_3'], $data['part_manufacturer_name_3'], $data['quantity_3'], $data['expense_of_item_3'], $data['labour_category_4'], $data['part_number_4'], $data['part_name_4'], $data['part_manufacturer_name_4'], $data['quantity_4'], $data['expense_of_item_4'], $data['labour_category_5'], $data['part_number_5'], $data['part_name_5'], $data['part_manufacturer_name_5'], $data['quantity_5'], $data['expense_of_item_5'], $data['labour_category_6'], $data['part_number_6'], $data['part_name_6'], $data['part_manufacturer_name_6'], $data['quantity_6'], $data['expense_of_item_6'], $data['labour_category_7'], $data['part_number_7'], $data['part_name_7'], $data['part_manufacturer_name_7'], $data['quantity_7'], $data['expense_of_item_7'], $data['labour_category_8'], $data['part_number_8'], $data['part_name_8'], $data['part_manufacturer_name_8'], $data['expense_of_item_8'], $data['material_cost'], $data['average_worktime_hrs'], $data['standard_labour_cost_per_hour'], $data['labour_charges'], $data['vat'], $data['total_amount'], $data['workshop_name'], $data['work_order_id'], $data['completion_date'], $data['comments'], $data['upload_invoice'], $data['date_captured'], $data['data_capturer'], $data['data_capturer_contact_email']
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

	function purchase_orders_before_insert(&$data, $memberInfo, &$args){
	 
	  
	 $q1 = $data['quantity_1']; 
	 $ex1 = $data['expense_of_item_1'];
	 $tex1 = $q1 * $ex1;
	 
	 $q2 = $data['quantity_2']; 
	 $ex2 =$data['expense_of_item_2'];
	 $tex2 = $q2 * $ex2;
	 
	 $q3 = $data['quantity_3']; 
	 $ex3 = $data['expense_of_item_3'];
	 $tex3 = $q3 * $ex3;
	 
	 $q4 = $data['quantity_4']; 
	 $ex4 = $data['expense_of_item_4'];
	 $tex4 = $q4 * $ex4;
	 
	 $q5 = $data['quantity_5']; 
	 $ex5 = $data['expense_of_item_5'];
	 $tex5 = $q5 * $ex5;
	 
	 $q6 = $data['quantity_6']; 
	 $ex6 = $data['expense_of_item_6'];
	 $tex6 = $q6 * $ex6;
	 
	 $q8 = $data['quantity_8']; 
	 $ex8 = $data['expense_of_item_8'];
	 $tex8 = $q8 * $ex8;
	 
	 
	 $lc = $data['labour_charges']; 
	 
	 $v = $data['vat'];
	 
	 $text = $tex1 + $tex2 + $tex3 + $tex4 + $tex5 + $tex6 + $tex7 + $tex8;
	 
	 $textlc = ($lc + $text) * $v; 
	 
	 $ta = $text + $textlc + $lc;
	
	 $data['total_amount'] = $ta;


		return TRUE;
	}

	/**
	 * Called after executing the insert query (but before executing the ownership insert query).
	 * 
	 * @param $data
	 * An associative array where the keys are field names and the values are the field data values that were inserted into the new record.
	 * For this table, the array items are: 
	 *     $data['purchased_order_number'], $data['purchased_date'], $data['purchaser'], $data['vehicle_registration_number'], $data['type_of_vehicle'], $data['manufacturer'], $data['service_type'], $data['service_category'], $data['service_item'], $data['upload_quotation'], $data['due_date'], $data['merchant_name'], $data['date_of_service'], $data['closing_km'], $data['labour_category_1'], $data['part_number_1'], $data['part_name_1'], $data['part_manufacturer_name_1'], $data['quantity_1'], $data['expense_of_item_1'], $data['labour_category_2'], $data['part_number_2'], $data['part_name_2'], $data['part_manufacturer_name_2'], $data['quantity_2'], $data['expense_of_item_2'], $data['labour_category_3'], $data['part_number_3'], $data['part_name_3'], $data['part_manufacturer_name_3'], $data['quantity_3'], $data['expense_of_item_3'], $data['labour_category_4'], $data['part_number_4'], $data['part_name_4'], $data['part_manufacturer_name_4'], $data['quantity_4'], $data['expense_of_item_4'], $data['labour_category_5'], $data['part_number_5'], $data['part_name_5'], $data['part_manufacturer_name_5'], $data['quantity_5'], $data['expense_of_item_5'], $data['labour_category_6'], $data['part_number_6'], $data['part_name_6'], $data['part_manufacturer_name_6'], $data['quantity_6'], $data['expense_of_item_6'], $data['labour_category_7'], $data['part_number_7'], $data['part_name_7'], $data['part_manufacturer_name_7'], $data['quantity_7'], $data['expense_of_item_7'], $data['labour_category_8'], $data['part_number_8'], $data['part_name_8'], $data['part_manufacturer_name_8'], $data['expense_of_item_8'], $data['material_cost'], $data['average_worktime_hrs'], $data['standard_labour_cost_per_hour'], $data['labour_charges'], $data['vat'], $data['total_amount'], $data['workshop_name'], $data['work_order_id'], $data['completion_date'], $data['comments'], $data['upload_invoice'], $data['date_captured'], $data['data_capturer'], $data['data_capturer_contact_email']
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

	function purchase_orders_after_insert($data, $memberInfo, &$args){

		return TRUE;
	}

	/**
	 * Called before executing the update query.
	 * 
	 * @param $data
	 * An associative array where the keys are field names and the values are the field data values.
	 * Note: if a field is set as read-only or hidden in detail view, it can't be modified through $data. You should use a direct SQL statement instead.
	 * For this table, the array items are: 
	 *     $data['purchase_order_id'], $data['purchased_order_number'], $data['purchased_date'], $data['purchaser'], $data['vehicle_registration_number'], $data['type_of_vehicle'], $data['manufacturer'], $data['service_type'], $data['service_category'], $data['service_item'], $data['upload_quotation'], $data['due_date'], $data['merchant_name'], $data['date_of_service'], $data['closing_km'], $data['labour_category_1'], $data['part_number_1'], $data['part_name_1'], $data['part_manufacturer_name_1'], $data['quantity_1'], $data['expense_of_item_1'], $data['labour_category_2'], $data['part_number_2'], $data['part_name_2'], $data['part_manufacturer_name_2'], $data['quantity_2'], $data['expense_of_item_2'], $data['labour_category_3'], $data['part_number_3'], $data['part_name_3'], $data['part_manufacturer_name_3'], $data['quantity_3'], $data['expense_of_item_3'], $data['labour_category_4'], $data['part_number_4'], $data['part_name_4'], $data['part_manufacturer_name_4'], $data['quantity_4'], $data['expense_of_item_4'], $data['labour_category_5'], $data['part_number_5'], $data['part_name_5'], $data['part_manufacturer_name_5'], $data['quantity_5'], $data['expense_of_item_5'], $data['labour_category_6'], $data['part_number_6'], $data['part_name_6'], $data['part_manufacturer_name_6'], $data['quantity_6'], $data['expense_of_item_6'], $data['labour_category_7'], $data['part_number_7'], $data['part_name_7'], $data['part_manufacturer_name_7'], $data['quantity_7'], $data['expense_of_item_7'], $data['labour_category_8'], $data['part_number_8'], $data['part_name_8'], $data['part_manufacturer_name_8'], $data['expense_of_item_8'], $data['material_cost'], $data['average_worktime_hrs'], $data['standard_labour_cost_per_hour'], $data['labour_charges'], $data['vat'], $data['total_amount'], $data['workshop_name'], $data['work_order_id'], $data['completion_date'], $data['comments'], $data['upload_invoice'], $data['date_captured'], $data['data_capturer'], $data['data_capturer_contact_email']
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

	function purchase_orders_before_update(&$data, $memberInfo, &$args){
	  
	  $q1 = $data['quantity_1']; 
	 $ex1 = $data['expense_of_item_1'];
	 $tex1 = $q1 * $ex1;
	 
	 $q2 = $data['quantity_2']; 
	 $ex2 =$data['expense_of_item_2'];
	 $tex2 = $q2 * $ex2;
	 
	 $q3 = $data['quantity_3']; 
	 $ex3 = $data['expense_of_item_3'];
	 $tex3 = $q3 * $ex3;
	 
	 $q4 = $data['quantity_4']; 
	 $ex4 = $data['expense_of_item_4'];
	 $tex4 = $q4 * $ex4;
	 
	 $q5 = $data['quantity_5']; 
	 $ex5 = $data['expense_of_item_5'];
	 $tex5 = $q5 * $ex5;
	 
	 $q6 = $data['quantity_6']; 
	 $ex6 = $data['expense_of_item_6'];
	 $tex6 = $q6 * $ex6;
	 
	 $q7 = $data['quantity_7']; 
	 $ex7 = $data['expense_of_item_7'];
	 $tex7 = $q7 * $ex7;
	 
	 $q8 = $data['quantity_8']; 
	 $ex8 = $data['expense_of_item_8'];
	 $tex8 = $q8 * $ex8;
	 
	 
	 $lc = $data['labour_charges']; 
	 
	 $v = $data['vat'];
	 
	 $text = $tex1 + $tex2 + $tex3 + $tex4 + $tex5 + $tex6 + $tex7 + $tex8;
	 
	 $textlc = ($lc + $text) * $v; 
	 
	 $ta = $text + $textlc + $lc;
	
	 $data['total_amount'] = $ta;


		return TRUE;
	}

	/**
	 * Called after executing the update query and before executing the ownership update query.
	 * 
	 * @param $data
	 * An associative array where the keys are field names and the values are the field data values.
	 * For this table, the array items are: 
	 *     $data['purchase_order_id'], $data['purchased_order_number'], $data['purchased_date'], $data['purchaser'], $data['vehicle_registration_number'], $data['type_of_vehicle'], $data['manufacturer'], $data['service_type'], $data['service_category'], $data['service_item'], $data['upload_quotation'], $data['due_date'], $data['merchant_name'], $data['date_of_service'], $data['closing_km'], $data['labour_category_1'], $data['part_number_1'], $data['part_name_1'], $data['part_manufacturer_name_1'], $data['quantity_1'], $data['expense_of_item_1'], $data['labour_category_2'], $data['part_number_2'], $data['part_name_2'], $data['part_manufacturer_name_2'], $data['quantity_2'], $data['expense_of_item_2'], $data['labour_category_3'], $data['part_number_3'], $data['part_name_3'], $data['part_manufacturer_name_3'], $data['quantity_3'], $data['expense_of_item_3'], $data['labour_category_4'], $data['part_number_4'], $data['part_name_4'], $data['part_manufacturer_name_4'], $data['quantity_4'], $data['expense_of_item_4'], $data['labour_category_5'], $data['part_number_5'], $data['part_name_5'], $data['part_manufacturer_name_5'], $data['quantity_5'], $data['expense_of_item_5'], $data['labour_category_6'], $data['part_number_6'], $data['part_name_6'], $data['part_manufacturer_name_6'], $data['quantity_6'], $data['expense_of_item_6'], $data['labour_category_7'], $data['part_number_7'], $data['part_name_7'], $data['part_manufacturer_name_7'], $data['quantity_7'], $data['expense_of_item_7'], $data['labour_category_8'], $data['part_number_8'], $data['part_name_8'], $data['part_manufacturer_name_8'], $data['expense_of_item_8'], $data['material_cost'], $data['average_worktime_hrs'], $data['standard_labour_cost_per_hour'], $data['labour_charges'], $data['vat'], $data['total_amount'], $data['workshop_name'], $data['work_order_id'], $data['completion_date'], $data['comments'], $data['upload_invoice'], $data['date_captured'], $data['data_capturer'], $data['data_capturer_contact_email']
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

	function purchase_orders_after_update($data, $memberInfo, &$args){

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

	function purchase_orders_before_delete($selectedID, &$skipChecks, $memberInfo, &$args){

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

	function purchase_orders_after_delete($selectedID, $memberInfo, &$args){

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

	function purchase_orders_dv($selectedID, $memberInfo, &$html, &$args){

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

	function purchase_orders_csv($query, $memberInfo, &$args){

		return $query;
	}
	/**
	 * Called when displaying the table view to retrieve custom record actions
	 * 
	 * @return
	 * A 2D array describing custom record actions. The format of the array is:
	 *   array(
	 *      array(
	 *         'title' => 'Title', // the title/label of the custom action as displayed to users
	 *         'function' => 'js_function_name', // the name of a javascript function to be executed when user selects this action
	 *         'class' => 'CSS class(es) to apply to the action title', // optional, refer to Bootstrap documentation for CSS classes
	 *         'icon' => 'icon name' // optional, refer to Bootstrap glyphicons for supported names
	 *      ), ...
	 *   )
	*/

	function purchase_orders_batch_actions(&$args){

		return array();
	}
