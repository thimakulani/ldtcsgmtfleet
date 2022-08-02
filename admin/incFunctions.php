<?php
	########################################################################
	/*
	~~~~~~ LIST OF FUNCTIONS ~~~~~~
		set_headers() -- sets HTTP headers (encoding, same-origin frame policy, .. etc)
		getTableList() -- returns an associative array [tableName => [tableCaption, tableDescription, tableIcon], ...] of tables accessible by current user
		getThumbnailSpecs($tableName, $fieldName, $view) -- returns an associative array specifying the width, height and identifier of the thumbnail file.
		createThumbnail($img, $specs) -- $specs is an array as returned by getThumbnailSpecs(). Returns true on success, false on failure.
		makeSafe($string)
		checkPermissionVal($pvn)
		sql($statement, $o)
		sqlValue($statement)
		getLoggedAdmin()
		logOutUser()
		getPKFieldName($tn)
		getCSVData($tn, $pkValue, $stripTag=true)
		errorMsg($msg)
		redirect($URL, $absolute=FALSE)
		htmlRadioGroup($name, $arrValue, $arrCaption, $selectedValue, $selClass="", $class="", $separator="<br>")
		htmlSelect($name, $arrValue, $arrCaption, $selectedValue, $class="", $selectedClass="")
		htmlSQLSelect($name, $sql, $selectedValue, $class="", $selectedClass="")
		isEmail($email) -- returns $email if valid or false otherwise.
		notifyMemberApproval($memberID) -- send an email to member acknowledging his approval by admin, returns false if no mail is sent
		setupMembership() -- check if membership tables exist or not. If not, create them.
		thisOr($this_val, $or) -- return $this_val if it has a value, or $or if not.
		getUploadedFile($FieldName, $MaxSize=0, $FileTypes='csv|txt', $NoRename=false, $dir='')
		toBytes($val)
		convertLegacyOptions($CSVList)
		getValueGivenCaption($query, $caption)
		time24($t) -- return time in 24h format
		time12($t) -- return time in 12h format
		application_url($page) -- return absolute URL of provided page
		is_ajax() -- return true if this is an ajax request, false otherwise
		is_allowed_username($username, $exception = false) -- returns username if valid and unique, or false otherwise (if exception is provided and same as username, no uniqueness check is performed)
		csrf_token($validate) -- csrf-proof a form
		get_plugins() -- scans for installed plugins and returns them in an array ('name', 'title', 'icon' or 'glyphicon', 'admin_path')
		maintenance_mode($new_status = '') -- retrieves (and optionally sets) maintenance mode status
		html_attr($str) -- prepare $str to be placed inside an HTML attribute
		html_attr_tags_ok($str) -- same as html_attr, but allowing HTML tags
		Notification() -- class for providing a standardized html notifications functionality
		sendmail($mail) -- sends an email using PHPMailer as specified in the assoc array $mail( ['to', 'name', 'subject', 'message', 'debug'] ) and returns true on success or an error message on failure
		safe_html($str, $noBr = false) -- sanitize HTML strings, and apply nl2br() to non-HTML ones (unless optional 2nd param is passed as true)
		get_tables_info($skip_authentication = false) -- retrieves table properties as a 2D assoc array ['table_name' => ['prop1' => 'val', ..], ..]
		getLoggedMemberID() -- returns memberID of logged member. If no login, returns anonymous memberID
		getLoggedGroupID() -- returns groupID of logged member, or anonymous groupID
		getMemberInfo() -- returns an array containing the currently signed-in member's info
		get_group_id($user = '') -- returns groupID of given user, or current one if empty
		prepare_sql_set($set_array, $glue = ', ') -- Prepares data for a SET or WHERE clause, to be used in an INSERT/UPDATE query
		insert($tn, $set_array) -- Inserts a record specified by $set_array to the given table $tn
		update($tn, $set_array, $where_array) -- Updates a record identified by $where_array to date specified by $set_array in the given table $tn
		set_record_owner($tn, $pk, $user) -- Set/update the owner of given record
		app_datetime_format($destination = 'php', $datetime = 'd') -- get date/time format string for use with one of these: 'php' (see date function), 'mysql', 'moment'. $datetime: 'd' = date, 't' = time, 'dt' = both
		mysql_datetime($app_datetime) -- converts $app_datetime to mysql-formatted datetime, 'yyyy-mm-dd H:i:s', or empty string on error
		app_datetime($mysql_datetime, $datetime = 'd') -- converts $mysql_datetime to app-formatted datetime (if 2nd param is 'dt'), or empty string on error
		to_utf8($str) -- converts string from app-configured encoding to utf8
		from_utf8($str) -- converts string from utf8 to app-configured encoding
		membership_table_functions() -- returns a list of update_membership_* functions
		configure_anonymous_group() -- sets up anonymous group and guest user if necessary
		configure_admin_group() -- sets up admins group and super admin user if necessary
		get_table_keys($tn) -- returns keys (indexes) of given table
		get_table_fields($tn) -- returns fields spec for given table
		update_membership_{tn}() -- sets up membership table tn and its indexes if necessary
		test($subject, $test) -- perform a test and return results
		invoke_method($object, $methodName, $param_array) -- invoke a private/protected method of a given object
		invoke_static_method($class, $methodName, $param_array) -- invoke a private/protected method of a given class statically
		get_parent_tables($tn) -- returns parents of given table: ['parent table' => [main lookup fields in child], ..]
		backtick_keys_once($data) -- wraps keys of given array with backticks ` if not already wrapped. Useful for use with fieldnames passed to update() and insert()
		calculated_fields() -- returns calculated fields config array: [table => [field => query, ..], ..]
		update_calc_fields($table, $id, $formulas, $mi = false) -- updates record of given $id in given $table according to given $formulas on behalf of user specified in given info array (or current user if false)
		latest_jquery() -- detects and returns the name of the latest jQuery file found in resources/jquery/js
		existing_value($tn, $fn, $id, $cache = true) -- returns (cached) value of field $fn of record having $id in table $tn. Set $cache to false to bypass caching.
		checkAppRequirements() -- if PHP doesn't meet app requirements, outputs error and exits
		getRecord($table, $id) -- return the record having a PK of $id from $table as an associative array, falsy value on error/not found
		guessMySQLDateTime($dt) -- if $dt is not already a mysql date/datetime, use mysql_datetime() to convert then return mysql date/datetime. Returns false if $dt invalid or couldn't be detected.
		pkGivenLookupText($val, $tn, $lookupField, $falseIfNotFound) -- returns corresponding PK value for given $val which is the textual lookup value for given $lookupField in given $tn table. If $val has no corresponding PK value, $val is returned as-is, unless $falseIfNotFound is set to true, in which case false is returned.
		userCanImport() -- returns true if user (or his group) can import CSV files (through the permission set in the group page in the admin area).
		bgStyleToClass($html) -- replaces bg color 'style' attr with a class to prevent style loss on xss cleanup.
		assocArrFilter($arr, $func) -- filters provided array using provided callback function. The callback receives 2 params ($key, $value) and should return a boolean.
		array_trim($arr) -- deep trim; trim each element in the array and its sub arrays.
		request_outside_admin_folder() -- returns true if currently executing script is outside admin folder, false otherwise.
		breakpoint(__FILE__, __LINE__, $msg) -- if DEBUG_MODE enabled, logs a message to {app_dir}/breakpoint.csv, if $msg is array, it will be converted to str via json_encode
		denyAccess($msg) -- Send a 403 Access Denied header, with an optional message then die
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	*/
	########################################################################
	function set_headers() {
		@header('Content-Type: text/html; charset=' . datalist_db_encoding);
		@header('X-Frame-Options: SAMEORIGIN'); // prevent iframing by other sites to prevent clickjacking
	}
	########################################################################
	function get_tables_info($skip_authentication = false) {
		static $all_tables = [], $accessible_tables = [];

		/* return cached results, if found */
		if(($skip_authentication || getLoggedAdmin()) && count($all_tables)) return $all_tables;
		if(!$skip_authentication && count($accessible_tables)) return $accessible_tables;

		/* table groups */
		$tg = [
			'Vehicle',
			'Logs',
			'Claims',
			'Maintenance',
			'Repairs',
			'Expenses',
			'Location',
			'Merchant',
			'Manufacturer',
			'Forms'
		];

		$all_tables = [
			/* ['table_name' => [table props assoc array] */   
				'gmt_fleet_register' => [
					'Caption' => 'GMT Fleet Register:',
					'Description' => 'Capture the details to the asset register table.',
					'tableIcon' => 'resources/table_icons/Jeep_Red.png',
					'group' => $tg[0],
					'homepageShowCount' => 1
				],
				'log_sheet' => [
					'Caption' => 'Trip & Fuel Log Sheet:',
					'Description' => 'Capture the details to the log sheet table.',
					'tableIcon' => 'resources/table_icons/Lime-Dossier.png',
					'group' => $tg[1],
					'homepageShowCount' => 1
				],
				'vehicle_history' => [
					'Caption' => 'Vehicle General History:',
					'Description' => 'Capture the details to the vehicle history table.',
					'tableIcon' => 'resources/table_icons/Applications-AppleWorks-6.png',
					'group' => $tg[0],
					'homepageShowCount' => 1
				],
				'year_model' => [
					'Caption' => 'Year Model:',
					'Description' => 'Capture the year model info.',
					'tableIcon' => 'resources/table_icons/Numbers-icon.png',
					'group' => $tg[0],
					'homepageShowCount' => 1
				],
				'month' => [
					'Caption' => 'Month:',
					'Description' => 'Capture the month for the vehicle.',
					'tableIcon' => 'resources/table_icons/3D-Calendar-red1.png',
					'group' => $tg[0],
					'homepageShowCount' => 1
				],
				'body_type' => [
					'Caption' => 'Body Type:',
					'Description' => 'Capture the body type of vehicle.',
					'tableIcon' => 'resources/table_icons/run.png',
					'group' => $tg[0],
					'homepageShowCount' => 1
				],
				'vehicle_colour' => [
					'Caption' => 'Vehicle Colour:',
					'Description' => 'Capture the vehicle colour.',
					'tableIcon' => 'resources/table_icons/Colorpencils128.png',
					'group' => $tg[0],
					'homepageShowCount' => 1
				],
				'province' => [
					'Caption' => 'Province:',
					'Description' => 'Capture the prov&#8204;ince.',
					'tableIcon' => 'resources/table_icons/limpopo.png',
					'group' => $tg[6],
					'homepageShowCount' => 1
				],
				'departments' => [
					'Caption' => 'Departments:',
					'Description' => 'Capture the Departments.',
					'tableIcon' => 'resources/table_icons/Contacts White.png',
					'group' => $tg[6],
					'homepageShowCount' => 1
				],
				'districts' => [
					'Caption' => 'Districts and Stations:',
					'Description' => 'Capture the districts and stations.',
					'tableIcon' => 'resources/table_icons/Map-icon (2).png',
					'group' => $tg[6],
					'homepageShowCount' => 1
				],
				'application_status' => [
					'Caption' => 'Application Status:',
					'Description' => 'Capture the application status.',
					'tableIcon' => 'resources/table_icons/daemons.png',
					'group' => $tg[0],
					'homepageShowCount' => 1
				],
				'vehicle_payments' => [
					'Caption' => 'Vehicle Payments:',
					'Description' => 'Monthly installments of particular vehicle.',
					'tableIcon' => 'resources/table_icons/money-icon.png',
					'group' => $tg[5],
					'homepageShowCount' => 1
				],
				'insurance_payments' => [
					'Caption' => 'Insurance Payments:',
					'Description' => 'Monthly installments for insurance.',
					'tableIcon' => 'resources/table_icons/Notepad.png',
					'group' => $tg[5],
					'homepageShowCount' => 1
				],
				'authorizations' => [
					'Caption' => 'Authorization Report:',
					'Description' => 'Authorizations granted to fleet maintenance repairs.',
					'tableIcon' => 'resources/table_icons/lesson_planning_128.png',
					'group' => $tg[4],
					'homepageShowCount' => 1
				],
				'service' => [
					'Caption' => 'Service:',
					'Description' => 'Determine the service schedule of vehicle.',
					'tableIcon' => 'resources/table_icons/autorepair2.png',
					'group' => $tg[3],
					'homepageShowCount' => 1
				],
				'service_type' => [
					'Caption' => 'Service Type:',
					'Description' => 'Define the service for car maintenance.',
					'tableIcon' => 'resources/table_icons/servicetype.png',
					'group' => $tg[3],
					'homepageShowCount' => 1
				],
				'schedule' => [
					'Caption' => 'Schedule:',
					'Description' => 'Schedule reminders of servicing  vehicles.',
					'tableIcon' => 'resources/table_icons/schedule.png',
					'group' => $tg[3],
					'homepageShowCount' => 1
				],
				'service_records' => [
					'Caption' => 'Service Records:',
					'Description' => 'Service history of vehicles.',
					'tableIcon' => 'resources/table_icons/servicelist.png',
					'group' => $tg[3],
					'homepageShowCount' => 1
				],
				'service_categories' => [
					'Caption' => 'Service Categories:',
					'Description' => 'Define the different service categories.',
					'tableIcon' => 'resources/table_icons/maintenance1.png',
					'group' => $tg[3],
					'homepageShowCount' => 1
				],
				'service_item_type' => [
					'Caption' => 'Service Item Type:',
					'Description' => 'Deterimine the service item type.',
					'tableIcon' => 'resources/table_icons/serviceitem.png',
					'group' => $tg[3],
					'homepageShowCount' => 1
				],
				'service_item' => [
					'Caption' => 'Service Item:',
					'Description' => 'Define the service item',
					'tableIcon' => 'resources/table_icons/gaming_steering.png',
					'group' => $tg[3],
					'homepageShowCount' => 1
				],
				'purchase_orders' => [
					'Caption' => 'Purchase Orders:',
					'Description' => 'Purchase order for the service & breakdown of the vehicle.',
					'tableIcon' => 'resources/table_icons/group_data.png',
					'group' => $tg[5],
					'homepageShowCount' => 1
				],
				'transmission' => [
					'Caption' => 'Transmission:',
					'Description' => 'Determine the type of transmission of vehicle.',
					'tableIcon' => 'resources/table_icons/cargear.png',
					'group' => $tg[0],
					'homepageShowCount' => 1
				],
				'fuel_type' => [
					'Caption' => 'Fuel Type:',
					'Description' => 'Determine the fuel type.',
					'tableIcon' => 'resources/table_icons/fuels.png',
					'group' => $tg[0],
					'homepageShowCount' => 1
				],
				'merchant' => [
					'Caption' => 'Merchant :',
					'Description' => 'Determine the particularsof the merchant.',
					'tableIcon' => 'resources/table_icons/vendor.png',
					'group' => $tg[7],
					'homepageShowCount' => 1
				],
				'merchant_type' => [
					'Caption' => 'Merchant  Type:',
					'Description' => 'Specify the merchant type.',
					'tableIcon' => 'resources/table_icons/briefcasetype.png',
					'group' => $tg[7],
					'homepageShowCount' => 1
				],
				'manufacturer' => [
					'Caption' => 'Manufacturer:',
					'Description' => 'Define the manufacturer of different parts for vehicle service.',
					'tableIcon' => 'resources/table_icons/worm-gear-icon.png',
					'group' => $tg[8],
					'homepageShowCount' => 1
				],
				'manufacturer_type' => [
					'Caption' => 'Manufacturer Type:',
					'Description' => 'Specify the manufacturer type.',
					'tableIcon' => 'resources/table_icons/manufacturertype.png',
					'group' => $tg[8],
					'homepageShowCount' => 1
				],
				'driver' => [
					'Caption' => 'Driver:',
					'Description' => 'A person who drives a vehicle.',
					'tableIcon' => 'resources/table_icons/identification.png',
					'group' => $tg[1],
					'homepageShowCount' => 1
				],
				'accidents' => [
					'Caption' => 'Accident:',
					'Description' => 'The unintended collision of one motor vehicle with another or person, resulting in injuries, death and/or loss of property.',
					'tableIcon' => 'resources/table_icons/accident.png',
					'group' => $tg[2],
					'homepageShowCount' => 1
				],
				'accident_type' => [
					'Caption' => 'Accident Type:',
					'Description' => 'Classify the accident type.',
					'tableIcon' => 'resources/table_icons/Ambulance_Red.png',
					'group' => $tg[2],
					'homepageShowCount' => 1
				],
				'claim' => [
					'Caption' => 'Claims:',
					'Description' => 'A demand or request for something considered one/s due.',
					'tableIcon' => 'resources/table_icons/BiologicalHazard_Symbol_Triangle.png',
					'group' => $tg[2],
					'homepageShowCount' => 1
				],
				'claim_status' => [
					'Caption' => 'Claims Status:',
					'Description' => 'The status of a demand or request for something considered one/s due.',
					'tableIcon' => 'resources/table_icons/applications-icon.png',
					'group' => $tg[2],
					'homepageShowCount' => 1
				],
				'claim_category' => [
					'Caption' => 'Claims Category:',
					'Description' => 'Categorize the demand or request for something considered one/s due.',
					'tableIcon' => 'resources/table_icons/Internet-bags-icon.png',
					'group' => $tg[2],
					'homepageShowCount' => 1
				],
				'cost_centre' => [
					'Caption' => 'Cost Centre:',
					'Description' => 'A cost centre is a department within a business to which costs can be allocated.',
					'tableIcon' => 'resources/table_icons/school_128.png',
					'group' => $tg[6],
					'homepageShowCount' => 1
				],
				'dealer' => [
					'Caption' => 'Dealer:',
					'Description' => 'Determine the dealer.',
					'tableIcon' => 'resources/table_icons/GamingWheel.png',
					'group' => $tg[8],
					'homepageShowCount' => 1
				],
				'dealer_type' => [
					'Caption' => 'Dealer Type:',
					'Description' => 'Determine the dealer type.',
					'tableIcon' => 'resources/table_icons/bus_128.png',
					'group' => $tg[8],
					'homepageShowCount' => 1
				],
				'tyre_log_sheet' => [
					'Caption' => 'Tyre Data:',
					'Description' => 'Capture the details of tyre particulars.',
					'tableIcon' => 'resources/table_icons/1350385545_wheel.png',
					'group' => $tg[1],
					'homepageShowCount' => 1
				],
				'vehicle_daily_check_list' => [
					'Caption' => 'Vehicle Daily Check List:',
					'Description' => 'Vehicle Daily Check List and Appraisal Report',
					'tableIcon' => 'resources/table_icons/dispatch_order_128.png',
					'group' => $tg[3],
					'homepageShowCount' => 1
				],
				'auditor' => [
					'Caption' => 'Auditor:',
					'Description' => 'Carefully check the accuracy of business records.',
					'tableIcon' => 'resources/table_icons/graduation.png',
					'group' => $tg[1],
					'homepageShowCount' => 1
				],
				'parts' => [
					'Caption' => 'Parts:',
					'Description' => 'Stock of vehicle parts in mechanical workshop needed',
					'tableIcon' => 'resources/table_icons/tool-box-preferences-icon.png',
					'group' => $tg[3],
					'homepageShowCount' => 1
				],
				'parts_type' => [
					'Caption' => 'Part Type:',
					'Description' => 'Define the part type',
					'tableIcon' => 'resources/table_icons/box-config-icon.png',
					'group' => $tg[3],
					'homepageShowCount' => 1
				],
				'breakdown_services' => [
					'Caption' => 'Breakdown Services:',
					'Description' => 'Breakdown of vehicles.',
					'tableIcon' => 'resources/table_icons/breakdowns.png',
					'group' => $tg[4],
					'homepageShowCount' => 1
				],
				'modification_to_vehicle' => [
					'Caption' => 'Modification to Vehicle:',
					'Description' => 'Service and Repairs to vehicle.',
					'tableIcon' => 'resources/table_icons/dimensions.png',
					'group' => $tg[3],
					'homepageShowCount' => 1
				],
				'vehicle_handing_over_checklist' => [
					'Caption' => 'Vehicle Handing Over Checklist:',
					'Description' => 'Vehicle handing over for service and repairs.',
					'tableIcon' => 'resources/table_icons/CarHeadUnit_Map.png',
					'group' => $tg[3],
					'homepageShowCount' => 1
				],
				'vehicle_return_check_list' => [
					'Caption' => 'Vehicle Return Check List:',
					'Description' => 'Vehicle returned after service and repair.',
					'tableIcon' => 'resources/table_icons/keys.png',
					'group' => $tg[3],
					'homepageShowCount' => 1
				],
				'indicates_repair_damages_found_list' => [
					'Caption' => 'Indicates Repairs & Damages Found List:',
					'Description' => 'Indicates repairs & damages found on vehicle.',
					'tableIcon' => 'resources/table_icons/cut_128.png',
					'group' => $tg[3],
					'homepageShowCount' => 1
				],
				'forms' => [
					'Caption' => 'Forms:',
					'Description' => 'Download forms for GMT Fleet.',
					'tableIcon' => 'resources/table_icons/blacklist.png',
					'group' => $tg[0],
					'homepageShowCount' => 1
				],
				'identification_of_defects' => [
					'Caption' => 'Identification Of Defects:',
					'Description' => 'End-user identify the defects on the vehicle.<br><br><br><br><br><br><br> <br>Defects are reported to the institutional Transport Officer.<br><br><br><br><br><br><br> <br>If the car is drivable, Officer takes the vehicle to nearest government garage.<br><br><br><br><br><br><br><br> <br>If not drivable, Officer report the vehicle to nearest government garage as breakdown.',
					'tableIcon' => 'resources/table_icons/corrugated_fastening_tool_128.png',
					'group' => $tg[4],
					'homepageShowCount' => 1
				],
				'gate_security' => [
					'Caption' => 'Gate Security:',
					'Description' => 'Inspection of vehicle and all accessories. <br><br><br><br><br>Recording of vehicle and all accessories accordingly.',
					'tableIcon' => 'resources/table_icons/architecture_128.png',
					'group' => $tg[4],
					'homepageShowCount' => 1
				],
				'reception' => [
					'Caption' => 'Reception:',
					'Description' => 'In case of breakdown, receptionist open a job card and a note of what might have been the problem as per the reporting officer.<br><br><br><br> <br>The job card is then send directly to the inspection for allocation to the breakdown service.<br><br><br><br>Receptionist carry out the visual inspection with the drive and the driver acknowledges and sign the visual inspection form.<br><br><br><br><br>The vehicle is taken to the workshop inspection bay with the job card and visual inspection form.<br><br><br><br><br>The vehicle is handed over to the receptionist.<br><br><br><br>Receptionist inspect the vehicle with testing officer, if there are any new defects,the vehicle go back to workshop for investigation and make a new damage report.<br><br><br><br><br>The end user/driver is informed for them to collect the vehicle.',
					'tableIcon' => 'resources/table_icons/kate_1.png',
					'group' => $tg[4],
					'homepageShowCount' => 1
				],
				'inspection_bay' => [
					'Caption' => 'Inspection Bay:',
					'Description' => 'Verification of reported defects.<br><br><br> <br>Vehicle is inspected for any other additional defects.<br><br><br> <br>Additional defects are recorded on the job card as part of repairs required.<br><br><br><br>The vehicle is then parked at the waiting bay, marked clearly with the date received and required repairs.<br><br><br><br>Keys and job card are then handed over to the supervisor for allocation.',
					'tableIcon' => 'resources/table_icons/Junior Icon 33.png',
					'group' => $tg[4],
					'homepageShowCount' => 1
				],
				'work_allocation' => [
					'Caption' => 'Work Allocation:',
					'Description' => 'Supervisor for allocation assess whether it is economical or uneconomical to proceed with the &#160;repairs.',
					'tableIcon' => 'resources/table_icons/inventory_clock_128.png',
					'group' => $tg[3],
					'homepageShowCount' => 1
				],
				'internal_repairs_mechanical' => [
					'Caption' => 'Internal Repairs Mechanical:',
					'Description' => 'The artisan note the starting time for the newly allocated job. <br><br><br><br>The artisan conduct the pre-repair inspection.<br><br><br><br><br>If the repairs require dismantling, the artisan will do so, and asses wear and tear on components.<br><br><br><br><br>The artisan then order all the required spares if there is a need on such repairs.<br><br><br><br>Once the spares are received or in case there is no need for spares, the artisan continues with the repairs.<br><br><br><br>The artisan completes the job and park the vehicle on the testing bay.',
					'tableIcon' => 'resources/table_icons/document-prefs-icon.png',
					'group' => $tg[4],
					'homepageShowCount' => 1
				],
				'external_repairs_mechanical' => [
					'Caption' => 'External Repairs Mechanical:',
					'Description' => 'The garage load a turndown to the service provider for the repairs required.<br><br><br> <br>The service provider distributes the work to the merchants in line with the repairs required.<br><br><br><br>If the vehicle is found to have been repaired recently, is directed to the merchant who previously repaired it to be treated as warranty repairs.<br><br><br>The vehicle is send to the merchant for repairs.<br><br><br>The merchant will send the repair quote to the service provider.<br><br><br>The service provider, after scrutinizing the repair quote from the merchant, send it to the department for inspection and approval of the repair.<br><br><br>The department sends the authorization qoute to the service provider.<br><br><br>The service provider then authorizes the merchant for the work to be carried out.<br><br>The department inspectors will carry out inspection of the work to be done during and after repairs.<br><br><br>Immediately the vehicle is repaired, the merchant informs the nearest garage for quality control,signing off the invoices and collection.<br><br><br>The vehicle is collected back to the government garage where it is parked on the testing line/bay&#160;.<br><br><br>Any documentation brought from the merchant is submitted to the inspection supervisor.',
					'tableIcon' => 'resources/table_icons/document-preferences-2-icon.png',
					'group' => $tg[4],
					'homepageShowCount' => 1
				],
				'internal_repairs_body' => [
					'Caption' => 'Internal Repairs Body:',
					'Description' => 'The driver report to reception of the panel beating section with the duly completed accident report form and the job card.<br><br><br><br>The vehicle is taken into the panel beating section of the government garage if it can still move on its own.<br><br><br><br><br>If the vehicle is brought in by the recovery vehicle, it will be off loaded in the parking area for repairs or quotation in the panel beating section.<br><br><br><br><br>The vehicle is assessed for the actual damages, which will be recorded on the accident assessment form&#160;.<br><br><br><br>Head of panel beating arrange for quotation from private panel beaters at least three quotation should be obtained.<br><br><br>Quotation are assessed in relation to the accident assessment form to check completeness or any other damage that might been omitted during assessment.<br><br><br><br>Head of panel beating took a decision whether the repairs are carried out internally or outsourced based on internal capacity & spares available.<br><br><br><br>Work recommended for internal repairs allocated to a panel beater to carry on with the repairs.<br><br><br>Quotations are then send to the service provider for capturing of cost to reflect on the vehicle history.<br><br><br><br>The repairs are carried out and completed.<br><br><br><br>The vehicle is then send to the testing line.<br><br><br><br>Should there be a need for futher repairs, the vehicle is reffered to the relevant section to complete such repairs.<br><br><br><br>Should it be that such repairs are as a result of same accident, costs for such and other related work must combined with the costs for accident repairs and be classified as accident repairs&#160;.<br><br><br><br>Copies of quotation, an invoice for both accident, recovery cost and all other costs related to such an accident are send to the department for further processing on the determination of liabilities on damage&#160;.',
					'tableIcon' => 'resources/table_icons/machine_128 (2).png',
					'group' => $tg[4],
					'homepageShowCount' => 1
				],
				'external_repairs_body' => [
					'Caption' => 'External Repairs Body:',
					'Description' => 'Head of panel beating section send the quotation to the service provider with the indication of the recommended quotation.<br><br><br><br><br><br><br>The service provider load the quotation on their system and confirm the merchant.<br><br><br><br><br><br><br>The vehicle is send to the merchant for repairs.<br><br><br><br><br><br><br>The head of panel beating section shall monitor progress of repairs to ensure that the vehicle is repaired accordingly.<br><br><br><br><br><br><br>Upon completion, head of panel beating shall carry out the final inspection, the vehicle will be collected with the invoice and be brought to garage&#160;.<br><br><br><br><br><br>The vehicle will be parked at the inspection line/bay&#160;.<br><br><br><br><br><br>The vehicle will be inspected and if it pass the inspection, it will be sent to the ready line.<br><br><br><br><br><br>The keys will then be handed over to the reception.<br><br><br><br><br>The head of the panel beating section process the invoice&#160;.',
					'tableIcon' => 'resources/table_icons/package_utilities.png',
					'group' => $tg[4],
					'homepageShowCount' => 1
				],
				'ordering_of_spares_for_internal_repairs' => [
					'Caption' => 'Ordering Of Spares For Internal Repairs:',
					'Description' => 'The responsible artisan makes out an internal requisition.<br><br><br><br>The responsible supervisor confirms and recommends the requisition.<br><br><br><br>The manager approves the requisition.<br><br><br><br>The requisition will be sent to stores for them to supply the available.<br><br><br><br>If the spares are not in stock, the stores officer will request quotation from suppliers to order spares through SCM processes or any means.<br><br><br><br>Once the spares are ready, the supervisor will collect the spare and hand over to the artisan who will resume the repairs process.<br><br><br><br>Once the repairs are completed, the artisan completes the job card and park the vehicle at the testing line for quality control.',
					'tableIcon' => 'resources/table_icons/machine_operator_007.png',
					'group' => $tg[5],
					'homepageShowCount' => 1
				],
				'collection_of_repaired_vehicles' => [
					'Caption' => 'Collection Of Repaired Vehicles:',
					'Description' => 'The receptionist informs the driver/user that their vehicle is complete and ready for collection.<br><br>when the driver arrives at government garage, government garage driver takes the vehicle from the ready line to reception.<br><br><br>The receptionist and the driver carry out a walk around inspection on the vehicle to check the body condition and accessories at the time of collection.<br><br><br>The driver then sign off the vehicle.<br><br>At the gate the security officer inspect the vehicle and record in the register and the driver sign the register.',
					'tableIcon' => 'resources/table_icons/TrafficLights_On.png',
					'group' => $tg[4],
					'homepageShowCount' => 1
				],
				'withdrawal_vehicle_from_operation' => [
					'Caption' => 'Withdrawal Of Vehicle:',
					'Description' => 'The supervisor verifies the life to date of the vehicle.<br><br><br>The supervisor prepares quotation for the identified defects to support the recommendation for withdrawal.<br><br><br>The supervisor compiles the technical report.<br><br><br>The report is referred to the garage manager to sign off.<br><br><br>The report is then submitted to the district office or the owner department.<br><br>The district officer or the owner department notifies the user about the withdrawal.<br><br>The district officer or the owner department refers the technical report to the board of survey for further processing.',
					'tableIcon' => 'resources/table_icons/cabinet_128.png',
					'group' => $tg[4],
					'homepageShowCount' => 1
				],
				'costing' => [
					'Caption' => 'Costing:',
					'Description' => 'The supervisor hand over the job card to the costing officer for reconciliation of the total of labour, spares and outsourced costs incurred.<br><br><br><br>Once all costs are reconciled, an invoice is prepared.<br><br><br>The invoice is then send to the garage manager for signing off.<br>',
					'tableIcon' => 'resources/table_icons/Tachometer.png',
					'group' => $tg[5],
					'homepageShowCount' => 1
				],
				'billing' => [
					'Caption' => 'Billing:',
					'Description' => 'The signed invoice is send to the end user to acknowledge receipt of all services rendered.<br><br><br>The invoice is then send to the service provider for capturing and billing.<br><br><br>The invoice together with the job card is captured in the maintenance file of the relevant vehicle to update the maintenance records.',
					'tableIcon' => 'resources/table_icons/Invoice_Paid_Document.png',
					'group' => $tg[5],
					'homepageShowCount' => 1
				],
				'general_control_measures' => [
					'Caption' => 'General Control Measures:',
					'Description' => 'Government garage workshops must be used for repairs of government vehicle only.<br><br><br>All government garage workshop must be kept clear at all times.<br><br><br>Old spares removed from vehicles shall be placed at a place provided for keeping used spares until they are disposed off.<br><br><br>Used oil must be stored in drums provided and be kept at location provided for storing used oil and other used consumable until they are disposed off.<br><br><br>Workshop equipment like four post lifts, low level lift, test machines, battery testers and chargers should be kept clean and always in serviceable condition.<br><br><br>Any damage or malfunction should be reported immediately to the supervisor of the section.<br><br><br>Workshop equipment shall be serviced periodically by the accredited service provider who will at the end issue the equipment safety certificate by OHS&#160;.<br><br>Workshop personnel shall be trained to use the workshop equipment.<br>Each artisan is responsible for the cleanliness of their work bays, work bay tools and equipment.<br><br>Each artisan must ensure that all tools are always in good working condition.<br><br>All tools, hand tools and equipment must be inspected by the sectional supervisor once a month.',
					'tableIcon' => 'resources/table_icons/EKG.png',
					'group' => $tg[3],
					'homepageShowCount' => 1
				],
				'movement_of_personnel_in_government_garage_and_workshops' => [
					'Caption' => 'Movement Of Personnel In Government Garage And Workshops:',
					'Description' => 'Workshops and administration staff at government garage shall use the main gate to enter and to leave the government garage premises.<br><br><br>Written permission should be produced to security officer when an official including artisan personnel drive a state vehicle out of the government garage.<br><br><br>Security officer shall complete the particulars required in the register.<br><br><br>Unauthorized people will not be allowed in government garage premises except when prior arrangement have been made and control register signed.<br><br><br>Officer coming to enquire about their vehicle shall contact the receptionist and he/she will make all necessary enquiries in the specific workshop.<br><br><br>Unauthorized people are not allowed inside workshops, all enquiries should be done at the reception.',
					'tableIcon' => 'resources/table_icons/responsibility_assignment_005.png',
					'group' => $tg[6],
					'homepageShowCount' => 1
				],
				'service_provider' => [
					'Caption' => 'Service Provider :',
					'Description' => 'Determine the particularsof the service provider.',
					'tableIcon' => 'resources/table_icons/Bank.png',
					'group' => $tg[7],
					'homepageShowCount' => 1
				],
				'service_provider_type' => [
					'Caption' => 'Service Provider Type:',
					'Description' => 'Specify the Service provider type.',
					'tableIcon' => 'resources/table_icons/Bank1.png',
					'group' => $tg[7],
					'homepageShowCount' => 1
				],
				'vehicle_annual_inspection' => [
					'Caption' => 'Vehicle Annual Inspection:',
					'Description' => 'Capture the annual inspection details to the Vehicle Annual Inspection table.',
					'tableIcon' => 'resources/table_icons/nuclear_engineer.png',
					'group' => $tg[3],
					'homepageShowCount' => 1
				],
		];

		if($skip_authentication || getLoggedAdmin()) return $all_tables;

		foreach($all_tables as $tn => $ti) {
			$arrPerm = getTablePermissions($tn);
			if($arrPerm['access']) $accessible_tables[$tn] = $ti;
		}

		return $accessible_tables;
	}
	#########################################################
	function getTableList($skip_authentication = false) {
		$arrAccessTables = [];
		$arrTables = [
			/* 'table_name' => ['table caption', 'homepage description', 'icon', 'table group name'] */   
			'gmt_fleet_register' => ['GMT Fleet Register:', 'Capture the details to the asset register table.', 'resources/table_icons/Jeep_Red.png', 'Vehicle'],
			'log_sheet' => ['Trip & Fuel Log Sheet:', 'Capture the details to the log sheet table.', 'resources/table_icons/Lime-Dossier.png', 'Logs'],
			'vehicle_history' => ['Vehicle General History:', 'Capture the details to the vehicle history table.', 'resources/table_icons/Applications-AppleWorks-6.png', 'Vehicle'],
			'year_model' => ['Year Model:', 'Capture the year model info.', 'resources/table_icons/Numbers-icon.png', 'Vehicle'],
			'month' => ['Month:', 'Capture the month for the vehicle.', 'resources/table_icons/3D-Calendar-red1.png', 'Vehicle'],
			'body_type' => ['Body Type:', 'Capture the body type of vehicle.', 'resources/table_icons/run.png', 'Vehicle'],
			'vehicle_colour' => ['Vehicle Colour:', 'Capture the vehicle colour.', 'resources/table_icons/Colorpencils128.png', 'Vehicle'],
			'province' => ['Province:', 'Capture the prov&#8204;ince.', 'resources/table_icons/limpopo.png', 'Location'],
			'departments' => ['Departments:', 'Capture the Departments.', 'resources/table_icons/Contacts White.png', 'Location'],
			'districts' => ['Districts and Stations:', 'Capture the districts and stations.', 'resources/table_icons/Map-icon (2).png', 'Location'],
			'application_status' => ['Application Status:', 'Capture the application status.', 'resources/table_icons/daemons.png', 'Vehicle'],
			'vehicle_payments' => ['Vehicle Payments:', 'Monthly installments of particular vehicle.', 'resources/table_icons/money-icon.png', 'Expenses'],
			'insurance_payments' => ['Insurance Payments:', 'Monthly installments for insurance.', 'resources/table_icons/Notepad.png', 'Expenses'],
			'authorizations' => ['Authorization Report:', 'Authorizations granted to fleet maintenance repairs.', 'resources/table_icons/lesson_planning_128.png', 'Repairs'],
			'service' => ['Service:', 'Determine the service schedule of vehicle.', 'resources/table_icons/autorepair2.png', 'Maintenance'],
			'service_type' => ['Service Type:', 'Define the service for car maintenance.', 'resources/table_icons/servicetype.png', 'Maintenance'],
			'schedule' => ['Schedule:', 'Schedule reminders of servicing  vehicles.', 'resources/table_icons/schedule.png', 'Maintenance'],
			'service_records' => ['Service Records:', 'Service history of vehicles.', 'resources/table_icons/servicelist.png', 'Maintenance'],
			'service_categories' => ['Service Categories:', 'Define the different service categories.', 'resources/table_icons/maintenance1.png', 'Maintenance'],
			'service_item_type' => ['Service Item Type:', 'Deterimine the service item type.', 'resources/table_icons/serviceitem.png', 'Maintenance'],
			'service_item' => ['Service Item:', 'Define the service item', 'resources/table_icons/gaming_steering.png', 'Maintenance'],
			'purchase_orders' => ['Purchase Orders:', 'Purchase order for the service & breakdown of the vehicle.', 'resources/table_icons/group_data.png', 'Expenses'],
			'transmission' => ['Transmission:', 'Determine the type of transmission of vehicle.', 'resources/table_icons/cargear.png', 'Vehicle'],
			'fuel_type' => ['Fuel Type:', 'Determine the fuel type.', 'resources/table_icons/fuels.png', 'Vehicle'],
			'merchant' => ['Merchant :', 'Determine the particularsof the merchant.', 'resources/table_icons/vendor.png', 'Merchant'],
			'merchant_type' => ['Merchant  Type:', 'Specify the merchant type.', 'resources/table_icons/briefcasetype.png', 'Merchant'],
			'manufacturer' => ['Manufacturer:', 'Define the manufacturer of different parts for vehicle service.', 'resources/table_icons/worm-gear-icon.png', 'Manufacturer'],
			'manufacturer_type' => ['Manufacturer Type:', 'Specify the manufacturer type.', 'resources/table_icons/manufacturertype.png', 'Manufacturer'],
			'driver' => ['Driver:', 'A person who drives a vehicle.', 'resources/table_icons/identification.png', 'Logs'],
			'accidents' => ['Accident:', 'The unintended collision of one motor vehicle with another or person, resulting in injuries, death and/or loss of property.', 'resources/table_icons/accident.png', 'Claims'],
			'accident_type' => ['Accident Type:', 'Classify the accident type.', 'resources/table_icons/Ambulance_Red.png', 'Claims'],
			'claim' => ['Claims:', 'A demand or request for something considered one/s due.', 'resources/table_icons/BiologicalHazard_Symbol_Triangle.png', 'Claims'],
			'claim_status' => ['Claims Status:', 'The status of a demand or request for something considered one/s due.', 'resources/table_icons/applications-icon.png', 'Claims'],
			'claim_category' => ['Claims Category:', 'Categorize the demand or request for something considered one/s due.', 'resources/table_icons/Internet-bags-icon.png', 'Claims'],
			'cost_centre' => ['Cost Centre:', 'A cost centre is a department within a business to which costs can be allocated.', 'resources/table_icons/school_128.png', 'Location'],
			'dealer' => ['Dealer:', 'Determine the dealer.', 'resources/table_icons/GamingWheel.png', 'Manufacturer'],
			'dealer_type' => ['Dealer Type:', 'Determine the dealer type.', 'resources/table_icons/bus_128.png', 'Manufacturer'],
			'tyre_log_sheet' => ['Tyre Data:', 'Capture the details of tyre particulars.', 'resources/table_icons/1350385545_wheel.png', 'Logs'],
			'vehicle_daily_check_list' => ['Vehicle Daily Check List:', 'Vehicle Daily Check List and Appraisal Report', 'resources/table_icons/dispatch_order_128.png', 'Maintenance'],
			'auditor' => ['Auditor:', 'Carefully check the accuracy of business records.', 'resources/table_icons/graduation.png', 'Logs'],
			'parts' => ['Parts:', 'Stock of vehicle parts in mechanical workshop needed', 'resources/table_icons/tool-box-preferences-icon.png', 'Maintenance'],
			'parts_type' => ['Part Type:', 'Define the part type', 'resources/table_icons/box-config-icon.png', 'Maintenance'],
			'breakdown_services' => ['Breakdown Services:', 'Breakdown of vehicles.', 'resources/table_icons/breakdowns.png', 'Repairs'],
			'modification_to_vehicle' => ['Modification to Vehicle:', 'Service and Repairs to vehicle.', 'resources/table_icons/dimensions.png', 'Maintenance'],
			'vehicle_handing_over_checklist' => ['Vehicle Handing Over Checklist:', 'Vehicle handing over for service and repairs.', 'resources/table_icons/CarHeadUnit_Map.png', 'Maintenance'],
			'vehicle_return_check_list' => ['Vehicle Return Check List:', 'Vehicle returned after service and repair.', 'resources/table_icons/keys.png', 'Maintenance'],
			'indicates_repair_damages_found_list' => ['Indicates Repairs & Damages Found List:', 'Indicates repairs & damages found on vehicle.', 'resources/table_icons/cut_128.png', 'Maintenance'],
			'forms' => ['Forms:', 'Download forms for GMT Fleet.', 'resources/table_icons/blacklist.png', 'Vehicle'],
			'identification_of_defects' => ['Identification Of Defects:', 'End-user identify the defects on the vehicle.<br><br><br><br><br><br><br> <br>Defects are reported to the institutional Transport Officer.<br><br><br><br><br><br><br> <br>If the car is drivable, Officer takes the vehicle to nearest government garage.<br><br><br><br><br><br><br><br> <br>If not drivable, Officer report the vehicle to nearest government garage as breakdown.', 'resources/table_icons/corrugated_fastening_tool_128.png', 'Repairs'],
			'gate_security' => ['Gate Security:', 'Inspection of vehicle and all accessories. <br><br><br><br><br>Recording of vehicle and all accessories accordingly.', 'resources/table_icons/architecture_128.png', 'Repairs'],
			'reception' => ['Reception:', 'In case of breakdown, receptionist open a job card and a note of what might have been the problem as per the reporting officer.<br><br><br><br> <br>The job card is then send directly to the inspection for allocation to the breakdown service.<br><br><br><br>Receptionist carry out the visual inspection with the drive and the driver acknowledges and sign the visual inspection form.<br><br><br><br><br>The vehicle is taken to the workshop inspection bay with the job card and visual inspection form.<br><br><br><br><br>The vehicle is handed over to the receptionist.<br><br><br><br>Receptionist inspect the vehicle with testing officer, if there are any new defects,the vehicle go back to workshop for investigation and make a new damage report.<br><br><br><br><br>The end user/driver is informed for them to collect the vehicle.', 'resources/table_icons/kate_1.png', 'Repairs'],
			'inspection_bay' => ['Inspection Bay:', 'Verification of reported defects.<br><br><br> <br>Vehicle is inspected for any other additional defects.<br><br><br> <br>Additional defects are recorded on the job card as part of repairs required.<br><br><br><br>The vehicle is then parked at the waiting bay, marked clearly with the date received and required repairs.<br><br><br><br>Keys and job card are then handed over to the supervisor for allocation.', 'resources/table_icons/Junior Icon 33.png', 'Repairs'],
			'work_allocation' => ['Work Allocation:', 'Supervisor for allocation assess whether it is economical or uneconomical to proceed with the &#160;repairs.', 'resources/table_icons/inventory_clock_128.png', 'Maintenance'],
			'internal_repairs_mechanical' => ['Internal Repairs Mechanical:', 'The artisan note the starting time for the newly allocated job. <br><br><br><br>The artisan conduct the pre-repair inspection.<br><br><br><br><br>If the repairs require dismantling, the artisan will do so, and asses wear and tear on components.<br><br><br><br><br>The artisan then order all the required spares if there is a need on such repairs.<br><br><br><br>Once the spares are received or in case there is no need for spares, the artisan continues with the repairs.<br><br><br><br>The artisan completes the job and park the vehicle on the testing bay.', 'resources/table_icons/document-prefs-icon.png', 'Repairs'],
			'external_repairs_mechanical' => ['External Repairs Mechanical:', 'The garage load a turndown to the service provider for the repairs required.<br><br><br> <br>The service provider distributes the work to the merchants in line with the repairs required.<br><br><br><br>If the vehicle is found to have been repaired recently, is directed to the merchant who previously repaired it to be treated as warranty repairs.<br><br><br>The vehicle is send to the merchant for repairs.<br><br><br>The merchant will send the repair quote to the service provider.<br><br><br>The service provider, after scrutinizing the repair quote from the merchant, send it to the department for inspection and approval of the repair.<br><br><br>The department sends the authorization qoute to the service provider.<br><br><br>The service provider then authorizes the merchant for the work to be carried out.<br><br>The department inspectors will carry out inspection of the work to be done during and after repairs.<br><br><br>Immediately the vehicle is repaired, the merchant informs the nearest garage for quality control,signing off the invoices and collection.<br><br><br>The vehicle is collected back to the government garage where it is parked on the testing line/bay&#160;.<br><br><br>Any documentation brought from the merchant is submitted to the inspection supervisor.', 'resources/table_icons/document-preferences-2-icon.png', 'Repairs'],
			'internal_repairs_body' => ['Internal Repairs Body:', 'The driver report to reception of the panel beating section with the duly completed accident report form and the job card.<br><br><br><br>The vehicle is taken into the panel beating section of the government garage if it can still move on its own.<br><br><br><br><br>If the vehicle is brought in by the recovery vehicle, it will be off loaded in the parking area for repairs or quotation in the panel beating section.<br><br><br><br><br>The vehicle is assessed for the actual damages, which will be recorded on the accident assessment form&#160;.<br><br><br><br>Head of panel beating arrange for quotation from private panel beaters at least three quotation should be obtained.<br><br><br>Quotation are assessed in relation to the accident assessment form to check completeness or any other damage that might been omitted during assessment.<br><br><br><br>Head of panel beating took a decision whether the repairs are carried out internally or outsourced based on internal capacity & spares available.<br><br><br><br>Work recommended for internal repairs allocated to a panel beater to carry on with the repairs.<br><br><br>Quotations are then send to the service provider for capturing of cost to reflect on the vehicle history.<br><br><br><br>The repairs are carried out and completed.<br><br><br><br>The vehicle is then send to the testing line.<br><br><br><br>Should there be a need for futher repairs, the vehicle is reffered to the relevant section to complete such repairs.<br><br><br><br>Should it be that such repairs are as a result of same accident, costs for such and other related work must combined with the costs for accident repairs and be classified as accident repairs&#160;.<br><br><br><br>Copies of quotation, an invoice for both accident, recovery cost and all other costs related to such an accident are send to the department for further processing on the determination of liabilities on damage&#160;.', 'resources/table_icons/machine_128 (2).png', 'Repairs'],
			'external_repairs_body' => ['External Repairs Body:', 'Head of panel beating section send the quotation to the service provider with the indication of the recommended quotation.<br><br><br><br><br><br><br>The service provider load the quotation on their system and confirm the merchant.<br><br><br><br><br><br><br>The vehicle is send to the merchant for repairs.<br><br><br><br><br><br><br>The head of panel beating section shall monitor progress of repairs to ensure that the vehicle is repaired accordingly.<br><br><br><br><br><br><br>Upon completion, head of panel beating shall carry out the final inspection, the vehicle will be collected with the invoice and be brought to garage&#160;.<br><br><br><br><br><br>The vehicle will be parked at the inspection line/bay&#160;.<br><br><br><br><br><br>The vehicle will be inspected and if it pass the inspection, it will be sent to the ready line.<br><br><br><br><br><br>The keys will then be handed over to the reception.<br><br><br><br><br>The head of the panel beating section process the invoice&#160;.', 'resources/table_icons/package_utilities.png', 'Repairs'],
			'ordering_of_spares_for_internal_repairs' => ['Ordering Of Spares For Internal Repairs:', 'The responsible artisan makes out an internal requisition.<br><br><br><br>The responsible supervisor confirms and recommends the requisition.<br><br><br><br>The manager approves the requisition.<br><br><br><br>The requisition will be sent to stores for them to supply the available.<br><br><br><br>If the spares are not in stock, the stores officer will request quotation from suppliers to order spares through SCM processes or any means.<br><br><br><br>Once the spares are ready, the supervisor will collect the spare and hand over to the artisan who will resume the repairs process.<br><br><br><br>Once the repairs are completed, the artisan completes the job card and park the vehicle at the testing line for quality control.', 'resources/table_icons/machine_operator_007.png', 'Expenses'],
			'collection_of_repaired_vehicles' => ['Collection Of Repaired Vehicles:', 'The receptionist informs the driver/user that their vehicle is complete and ready for collection.<br><br>when the driver arrives at government garage, government garage driver takes the vehicle from the ready line to reception.<br><br><br>The receptionist and the driver carry out a walk around inspection on the vehicle to check the body condition and accessories at the time of collection.<br><br><br>The driver then sign off the vehicle.<br><br>At the gate the security officer inspect the vehicle and record in the register and the driver sign the register.', 'resources/table_icons/TrafficLights_On.png', 'Repairs'],
			'withdrawal_vehicle_from_operation' => ['Withdrawal Of Vehicle:', 'The supervisor verifies the life to date of the vehicle.<br><br><br>The supervisor prepares quotation for the identified defects to support the recommendation for withdrawal.<br><br><br>The supervisor compiles the technical report.<br><br><br>The report is referred to the garage manager to sign off.<br><br><br>The report is then submitted to the district office or the owner department.<br><br>The district officer or the owner department notifies the user about the withdrawal.<br><br>The district officer or the owner department refers the technical report to the board of survey for further processing.', 'resources/table_icons/cabinet_128.png', 'Repairs'],
			'costing' => ['Costing:', 'The supervisor hand over the job card to the costing officer for reconciliation of the total of labour, spares and outsourced costs incurred.<br><br><br><br>Once all costs are reconciled, an invoice is prepared.<br><br><br>The invoice is then send to the garage manager for signing off.<br>', 'resources/table_icons/Tachometer.png', 'Expenses'],
			'billing' => ['Billing:', 'The signed invoice is send to the end user to acknowledge receipt of all services rendered.<br><br><br>The invoice is then send to the service provider for capturing and billing.<br><br><br>The invoice together with the job card is captured in the maintenance file of the relevant vehicle to update the maintenance records.', 'resources/table_icons/Invoice_Paid_Document.png', 'Expenses'],
			'general_control_measures' => ['General Control Measures:', 'Government garage workshops must be used for repairs of government vehicle only.<br><br><br>All government garage workshop must be kept clear at all times.<br><br><br>Old spares removed from vehicles shall be placed at a place provided for keeping used spares until they are disposed off.<br><br><br>Used oil must be stored in drums provided and be kept at location provided for storing used oil and other used consumable until they are disposed off.<br><br><br>Workshop equipment like four post lifts, low level lift, test machines, battery testers and chargers should be kept clean and always in serviceable condition.<br><br><br>Any damage or malfunction should be reported immediately to the supervisor of the section.<br><br><br>Workshop equipment shall be serviced periodically by the accredited service provider who will at the end issue the equipment safety certificate by OHS&#160;.<br><br>Workshop personnel shall be trained to use the workshop equipment.<br>Each artisan is responsible for the cleanliness of their work bays, work bay tools and equipment.<br><br>Each artisan must ensure that all tools are always in good working condition.<br><br>All tools, hand tools and equipment must be inspected by the sectional supervisor once a month.', 'resources/table_icons/EKG.png', 'Maintenance'],
			'movement_of_personnel_in_government_garage_and_workshops' => ['Movement Of Personnel In Government Garage And Workshops:', 'Workshops and administration staff at government garage shall use the main gate to enter and to leave the government garage premises.<br><br><br>Written permission should be produced to security officer when an official including artisan personnel drive a state vehicle out of the government garage.<br><br><br>Security officer shall complete the particulars required in the register.<br><br><br>Unauthorized people will not be allowed in government garage premises except when prior arrangement have been made and control register signed.<br><br><br>Officer coming to enquire about their vehicle shall contact the receptionist and he/she will make all necessary enquiries in the specific workshop.<br><br><br>Unauthorized people are not allowed inside workshops, all enquiries should be done at the reception.', 'resources/table_icons/responsibility_assignment_005.png', 'Location'],
			'service_provider' => ['Service Provider :', 'Determine the particularsof the service provider.', 'resources/table_icons/Bank.png', 'Merchant'],
			'service_provider_type' => ['Service Provider Type:', 'Specify the Service provider type.', 'resources/table_icons/Bank1.png', 'Merchant'],
			'vehicle_annual_inspection' => ['Vehicle Annual Inspection:', 'Capture the annual inspection details to the Vehicle Annual Inspection table.', 'resources/table_icons/nuclear_engineer.png', 'Maintenance'],
		];
		if($skip_authentication || getLoggedAdmin()) return $arrTables;

		foreach($arrTables as $tn => $tc) {
			$arrPerm = getTablePermissions($tn);
			if($arrPerm['access']) $arrAccessTables[$tn] = $tc;
		}

		return $arrAccessTables;
	}
	########################################################################
	function getThumbnailSpecs($tableName, $fieldName, $view) {
		if($tableName=='gmt_fleet_register' && $fieldName=='photo_of_vehicle' && $view=='tv')
			return ['width'=>50, 'height'=>50, 'identifier'=>'_tv'];
		elseif($tableName=='gmt_fleet_register' && $fieldName=='photo_of_vehicle' && $view=='dv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_dv'];
		elseif($tableName=='service_records' && $fieldName=='image_1' && $view=='tv')
			return ['width'=>50, 'height'=>50, 'identifier'=>'_tv'];
		elseif($tableName=='service_records' && $fieldName=='image_1' && $view=='dv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_dv'];
		elseif($tableName=='service_records' && $fieldName=='image_2' && $view=='tv')
			return ['width'=>50, 'height'=>50, 'identifier'=>'_tv'];
		elseif($tableName=='service_records' && $fieldName=='image_2' && $view=='dv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_dv'];
		elseif($tableName=='service_records' && $fieldName=='image_3' && $view=='tv')
			return ['width'=>50, 'height'=>50, 'identifier'=>'_tv'];
		elseif($tableName=='service_records' && $fieldName=='image_3' && $view=='dv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_dv'];
		elseif($tableName=='service_records' && $fieldName=='image_4' && $view=='tv')
			return ['width'=>50, 'height'=>50, 'identifier'=>'_tv'];
		elseif($tableName=='service_records' && $fieldName=='image_4' && $view=='dv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_dv'];
		elseif($tableName=='service_records' && $fieldName=='image_5' && $view=='tv')
			return ['width'=>50, 'height'=>50, 'identifier'=>'_tv'];
		elseif($tableName=='service_records' && $fieldName=='image_5' && $view=='dv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_dv'];
		elseif($tableName=='accidents' && $fieldName=='upload_photos_damaged_vehicle' && $view=='tv')
			return ['width'=>50, 'height'=>50, 'identifier'=>'_tv'];
		elseif($tableName=='modification_to_vehicle' && $fieldName=='driver_signature' && $view=='tv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_tv'];
		elseif($tableName=='modification_to_vehicle' && $fieldName=='driver_signature' && $view=='dv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_dv'];
		elseif($tableName=='modification_to_vehicle' && $fieldName=='testing_officer_signature' && $view=='tv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_tv'];
		elseif($tableName=='modification_to_vehicle' && $fieldName=='testing_officer_signature' && $view=='dv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_dv'];
		elseif($tableName=='modification_to_vehicle' && $fieldName=='supervisor_for_allocation_signature' && $view=='tv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_tv'];
		elseif($tableName=='modification_to_vehicle' && $fieldName=='supervisor_for_allocation_signature' && $view=='dv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_dv'];
		elseif($tableName=='vehicle_handing_over_checklist' && $fieldName=='driver_signature' && $view=='tv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_tv'];
		elseif($tableName=='vehicle_handing_over_checklist' && $fieldName=='driver_signature' && $view=='dv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_dv'];
		elseif($tableName=='vehicle_handing_over_checklist' && $fieldName=='testing_officer_signature' && $view=='tv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_tv'];
		elseif($tableName=='vehicle_handing_over_checklist' && $fieldName=='testing_officer_signature' && $view=='dv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_dv'];
		elseif($tableName=='vehicle_handing_over_checklist' && $fieldName=='vehicle_marks_1' && $view=='tv')
			return ['width'=>50, 'height'=>50, 'identifier'=>'_tv'];
		elseif($tableName=='vehicle_handing_over_checklist' && $fieldName=='vehicle_marks_1' && $view=='dv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_dv'];
		elseif($tableName=='vehicle_handing_over_checklist' && $fieldName=='vehicle_marks_2' && $view=='tv')
			return ['width'=>50, 'height'=>50, 'identifier'=>'_tv'];
		elseif($tableName=='vehicle_handing_over_checklist' && $fieldName=='vehicle_marks_2' && $view=='dv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_dv'];
		elseif($tableName=='vehicle_handing_over_checklist' && $fieldName=='vehicle_marks_3' && $view=='tv')
			return ['width'=>50, 'height'=>50, 'identifier'=>'_tv'];
		elseif($tableName=='vehicle_handing_over_checklist' && $fieldName=='vehicle_marks_3' && $view=='dv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_dv'];
		elseif($tableName=='vehicle_handing_over_checklist' && $fieldName=='vehicle_marks_4' && $view=='tv')
			return ['width'=>50, 'height'=>50, 'identifier'=>'_tv'];
		elseif($tableName=='vehicle_handing_over_checklist' && $fieldName=='vehicle_marks_4' && $view=='dv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_dv'];
		elseif($tableName=='vehicle_handing_over_checklist' && $fieldName=='vehicle_marks_5' && $view=='tv')
			return ['width'=>50, 'height'=>50, 'identifier'=>'_tv'];
		elseif($tableName=='vehicle_handing_over_checklist' && $fieldName=='vehicle_marks_5' && $view=='dv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_dv'];
		elseif($tableName=='vehicle_handing_over_checklist' && $fieldName=='vehicle_marks_6' && $view=='tv')
			return ['width'=>50, 'height'=>50, 'identifier'=>'_tv'];
		elseif($tableName=='vehicle_handing_over_checklist' && $fieldName=='vehicle_marks_6' && $view=='dv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_dv'];
		elseif($tableName=='vehicle_handing_over_checklist' && $fieldName=='vehicle_marks_7' && $view=='tv')
			return ['width'=>50, 'height'=>50, 'identifier'=>'_tv'];
		elseif($tableName=='vehicle_handing_over_checklist' && $fieldName=='vehicle_marks_7' && $view=='dv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_dv'];
		elseif($tableName=='vehicle_handing_over_checklist' && $fieldName=='vehicle_marks_8' && $view=='tv')
			return ['width'=>50, 'height'=>50, 'identifier'=>'_tv'];
		elseif($tableName=='vehicle_handing_over_checklist' && $fieldName=='vehicle_marks_8' && $view=='dv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_dv'];
		elseif($tableName=='vehicle_return_check_list' && $fieldName=='driver_signature' && $view=='tv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_tv'];
		elseif($tableName=='vehicle_return_check_list' && $fieldName=='driver_signature' && $view=='dv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_dv'];
		elseif($tableName=='vehicle_return_check_list' && $fieldName=='testing_officer_signature' && $view=='tv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_tv'];
		elseif($tableName=='vehicle_return_check_list' && $fieldName=='testing_officer_signature' && $view=='dv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_dv'];
		elseif($tableName=='vehicle_return_check_list' && $fieldName=='vehicle_marks_1' && $view=='tv')
			return ['width'=>50, 'height'=>50, 'identifier'=>'_tv'];
		elseif($tableName=='vehicle_return_check_list' && $fieldName=='vehicle_marks_1' && $view=='dv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_dv'];
		elseif($tableName=='vehicle_return_check_list' && $fieldName=='vehicle_marks_2' && $view=='tv')
			return ['width'=>50, 'height'=>50, 'identifier'=>'_tv'];
		elseif($tableName=='vehicle_return_check_list' && $fieldName=='vehicle_marks_2' && $view=='dv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_dv'];
		elseif($tableName=='vehicle_return_check_list' && $fieldName=='vehicle_marks_3' && $view=='tv')
			return ['width'=>50, 'height'=>50, 'identifier'=>'_tv'];
		elseif($tableName=='vehicle_return_check_list' && $fieldName=='vehicle_marks_3' && $view=='dv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_dv'];
		elseif($tableName=='vehicle_return_check_list' && $fieldName=='vehicle_marks_4' && $view=='tv')
			return ['width'=>50, 'height'=>50, 'identifier'=>'_tv'];
		elseif($tableName=='vehicle_return_check_list' && $fieldName=='vehicle_marks_4' && $view=='dv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_dv'];
		elseif($tableName=='vehicle_return_check_list' && $fieldName=='vehicle_marks_5' && $view=='tv')
			return ['width'=>50, 'height'=>50, 'identifier'=>'_tv'];
		elseif($tableName=='vehicle_return_check_list' && $fieldName=='vehicle_marks_5' && $view=='dv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_dv'];
		elseif($tableName=='vehicle_return_check_list' && $fieldName=='vehicle_marks_6' && $view=='tv')
			return ['width'=>50, 'height'=>50, 'identifier'=>'_tv'];
		elseif($tableName=='vehicle_return_check_list' && $fieldName=='vehicle_marks_6' && $view=='dv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_dv'];
		elseif($tableName=='vehicle_return_check_list' && $fieldName=='vehicle_marks_7' && $view=='tv')
			return ['width'=>50, 'height'=>50, 'identifier'=>'_tv'];
		elseif($tableName=='vehicle_return_check_list' && $fieldName=='vehicle_marks_7' && $view=='dv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_dv'];
		elseif($tableName=='vehicle_return_check_list' && $fieldName=='vehicle_marks_8' && $view=='tv')
			return ['width'=>50, 'height'=>50, 'identifier'=>'_tv'];
		elseif($tableName=='vehicle_return_check_list' && $fieldName=='vehicle_marks_8' && $view=='dv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_dv'];
		elseif($tableName=='indicates_repair_damages_found_list' && $fieldName=='driver_signature' && $view=='tv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_tv'];
		elseif($tableName=='indicates_repair_damages_found_list' && $fieldName=='driver_signature' && $view=='dv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_dv'];
		elseif($tableName=='indicates_repair_damages_found_list' && $fieldName=='company_repesentative_signature' && $view=='tv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_tv'];
		elseif($tableName=='indicates_repair_damages_found_list' && $fieldName=='company_repesentative_signature' && $view=='dv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_dv'];
		elseif($tableName=='identification_of_defects' && $fieldName=='end_user_signature' && $view=='tv')
			return ['width'=>50, 'height'=>50, 'identifier'=>'_tv'];
		elseif($tableName=='identification_of_defects' && $fieldName=='end_user_signature' && $view=='dv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_dv'];
		elseif($tableName=='identification_of_defects' && $fieldName=='transport_officer_email_address' && $view=='tv')
			return ['width'=>50, 'height'=>50, 'identifier'=>'_tv'];
		elseif($tableName=='identification_of_defects' && $fieldName=='transport_officer_email_address' && $view=='dv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_dv'];
		elseif($tableName=='identification_of_defects' && $fieldName=='government_garage_manager_signature' && $view=='tv')
			return ['width'=>50, 'height'=>50, 'identifier'=>'_tv'];
		elseif($tableName=='identification_of_defects' && $fieldName=='government_garage_manager_signature' && $view=='dv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_dv'];
		elseif($tableName=='reception' && $fieldName=='reception_signature' && $view=='tv')
			return ['width'=>50, 'height'=>50, 'identifier'=>'_tv'];
		elseif($tableName=='reception' && $fieldName=='reception_signature' && $view=='dv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_dv'];
		elseif($tableName=='inspection_bay' && $fieldName=='supervisor_signature' && $view=='tv')
			return ['width'=>50, 'height'=>50, 'identifier'=>'_tv'];
		elseif($tableName=='inspection_bay' && $fieldName=='supervisor_signature' && $view=='dv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_dv'];
		elseif($tableName=='work_allocation' && $fieldName=='supervisor_signature' && $view=='tv')
			return ['width'=>50, 'height'=>50, 'identifier'=>'_tv'];
		elseif($tableName=='work_allocation' && $fieldName=='supervisor_signature' && $view=='dv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_dv'];
		elseif($tableName=='internal_repairs_mechanical' && $fieldName=='artisan_signature' && $view=='tv')
			return ['width'=>50, 'height'=>50, 'identifier'=>'_tv'];
		elseif($tableName=='internal_repairs_mechanical' && $fieldName=='artisan_signature' && $view=='dv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_dv'];
		elseif($tableName=='external_repairs_mechanical' && $fieldName=='department_inspector_signature' && $view=='tv')
			return ['width'=>50, 'height'=>50, 'identifier'=>'_tv'];
		elseif($tableName=='external_repairs_mechanical' && $fieldName=='department_inspector_signature' && $view=='dv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_dv'];
		elseif($tableName=='external_repairs_mechanical' && $fieldName=='service_provider_signature' && $view=='tv')
			return ['width'=>50, 'height'=>50, 'identifier'=>'_tv'];
		elseif($tableName=='external_repairs_mechanical' && $fieldName=='service_provider_signature' && $view=='dv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_dv'];
		elseif($tableName=='external_repairs_mechanical' && $fieldName=='merchant_signature' && $view=='tv')
			return ['width'=>50, 'height'=>50, 'identifier'=>'_tv'];
		elseif($tableName=='external_repairs_mechanical' && $fieldName=='merchant_signature' && $view=='dv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_dv'];
		elseif($tableName=='internal_repairs_body' && $fieldName=='driver_signature' && $view=='tv')
			return ['width'=>50, 'height'=>50, 'identifier'=>'_tv'];
		elseif($tableName=='internal_repairs_body' && $fieldName=='driver_signature' && $view=='dv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_dv'];
		elseif($tableName=='internal_repairs_body' && $fieldName=='upload_of_internal_damages_1' && $view=='tv')
			return ['width'=>50, 'height'=>50, 'identifier'=>'_tv'];
		elseif($tableName=='internal_repairs_body' && $fieldName=='upload_of_internal_damages_1' && $view=='dv')
			return ['width' => 250, 'height' => 250, 'identifier'=>'_dv'];
		elseif($tableName=='internal_repairs_body' && $fieldName=='upload_of_internal_damages_2' && $view=='tv')
			return ['width'=>50, 'height'=>50, 'identifier'=>'_tv'];
		elseif($tableName=='internal_repairs_body' && $fieldName=='upload_of_internal_damages_2' && $view=='dv')
			return ['width' => 250, 'height' => 250, 'identifier'=>'_dv'];
		elseif($tableName=='internal_repairs_body' && $fieldName=='upload_of_internal_damages_3' && $view=='tv')
			return ['width'=>50, 'height'=>50, 'identifier'=>'_tv'];
		elseif($tableName=='internal_repairs_body' && $fieldName=='upload_of_internal_damages_3' && $view=='dv')
			return ['width' => 250, 'height' => 250, 'identifier'=>'_dv'];
		elseif($tableName=='internal_repairs_body' && $fieldName=='upload_of_internal_damages_4' && $view=='tv')
			return ['width'=>50, 'height'=>50, 'identifier'=>'_tv'];
		elseif($tableName=='internal_repairs_body' && $fieldName=='upload_of_internal_damages_4' && $view=='dv')
			return ['width' => 250, 'height' => 250, 'identifier'=>'_dv'];
		elseif($tableName=='internal_repairs_body' && $fieldName=='head_panel_beating_signature' && $view=='tv')
			return ['width'=>50, 'height'=>50, 'identifier'=>'_tv'];
		elseif($tableName=='internal_repairs_body' && $fieldName=='head_panel_beating_signature' && $view=='dv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_dv'];
		elseif($tableName=='external_repairs_body' && $fieldName=='head_panel_beating_signature' && $view=='tv')
			return ['width'=>50, 'height'=>50, 'identifier'=>'_tv'];
		elseif($tableName=='external_repairs_body' && $fieldName=='head_panel_beating_signature' && $view=='dv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_dv'];
		elseif($tableName=='external_repairs_body' && $fieldName=='service_provider_signature' && $view=='tv')
			return ['width'=>50, 'height'=>50, 'identifier'=>'_tv'];
		elseif($tableName=='external_repairs_body' && $fieldName=='service_provider_signature' && $view=='dv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_dv'];
		elseif($tableName=='external_repairs_body' && $fieldName=='merchant_signature' && $view=='tv')
			return ['width'=>50, 'height'=>50, 'identifier'=>'_tv'];
		elseif($tableName=='external_repairs_body' && $fieldName=='merchant_signature' && $view=='dv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_dv'];
		elseif($tableName=='ordering_of_spares_for_internal_repairs' && $fieldName=='artisan_signature' && $view=='tv')
			return ['width'=>50, 'height'=>50, 'identifier'=>'_tv'];
		elseif($tableName=='ordering_of_spares_for_internal_repairs' && $fieldName=='artisan_signature' && $view=='dv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_dv'];
		elseif($tableName=='collection_of_repaired_vehicles' && $fieldName=='reception_signature' && $view=='tv')
			return ['width'=>50, 'height'=>50, 'identifier'=>'_tv'];
		elseif($tableName=='collection_of_repaired_vehicles' && $fieldName=='reception_signature' && $view=='dv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_dv'];
		elseif($tableName=='collection_of_repaired_vehicles' && $fieldName=='driver_signature' && $view=='tv')
			return ['width'=>50, 'height'=>50, 'identifier'=>'_tv'];
		elseif($tableName=='collection_of_repaired_vehicles' && $fieldName=='driver_signature' && $view=='dv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_dv'];
		elseif($tableName=='costing' && $fieldName=='supervisor_signature' && $view=='tv')
			return ['width'=>50, 'height'=>50, 'identifier'=>'_tv'];
		elseif($tableName=='costing' && $fieldName=='supervisor_signature' && $view=='dv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_dv'];
		elseif($tableName=='costing' && $fieldName=='costing_officer_signature' && $view=='tv')
			return ['width'=>50, 'height'=>50, 'identifier'=>'_tv'];
		elseif($tableName=='costing' && $fieldName=='costing_officer_signature' && $view=='dv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_dv'];
		elseif($tableName=='costing' && $fieldName=='workshop_manager_signature' && $view=='tv')
			return ['width'=>50, 'height'=>50, 'identifier'=>'_tv'];
		elseif($tableName=='costing' && $fieldName=='workshop_manager_signature' && $view=='dv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_dv'];
		elseif($tableName=='vehicle_annual_inspection' && $fieldName=='photo_of_vehicle' && $view=='tv')
			return ['width'=>50, 'height'=>50, 'identifier'=>'_tv'];
		elseif($tableName=='vehicle_annual_inspection' && $fieldName=='photo_of_vehicle' && $view=='dv')
			return ['width'=>250, 'height'=>250, 'identifier'=>'_dv'];
		return FALSE;
	}
	########################################################################
	function createThumbnail($img, $specs) {
		$w = $specs['width'];
		$h = $specs['height'];
		$id = $specs['identifier'];
		$path = dirname($img);

		// image doesn't exist or inaccessible?
		// known issue: for webp files, requires PHP 7.1+
		if(!$size = @getimagesize($img)) return false;

		// calculate thumbnail size to maintain aspect ratio
		$ow = $size[0]; // original image width
		$oh = $size[1]; // original image height
		$twbh = $h / $oh * $ow; // calculated thumbnail width based on given height
		$thbw = $w / $ow * $oh; // calculated thumbnail height based on given width
		if($w && $h) {
			if($twbh > $w) $h = $thbw;
			if($thbw > $h) $w = $twbh;
		} elseif($w) {
			$h = $thbw;
		} elseif($h) {
			$w = $twbh;
		} else {
			return false;
		}

		// dir not writeable?
		if(!is_writable($path)) return false;

		// GD lib not loaded?
		if(!function_exists('gd_info')) return false;
		$gd = gd_info();

		// GD lib older than 2.0?
		preg_match('/\d/', $gd['GD Version'], $gdm);
		if($gdm[0] < 2) return false;

		// get file extension
		preg_match('/\.[a-zA-Z]{3,4}$/U', $img, $matches);
		$ext = strtolower($matches[0]);

		// check if supplied image is supported and specify actions based on file type
		if($ext == '.gif') {
			if(!$gd['GIF Create Support']) return false;
			$thumbFunc = 'imagegif';
		} elseif($ext == '.png') {
			if(!$gd['PNG Support'])  return false;
			$thumbFunc = 'imagepng';
		} elseif($ext == '.webp') {
			if(!$gd['WebP Support'] && !$gd['WEBP Support'])  return false;
			$thumbFunc = 'imagewebp';
		} elseif($ext == '.jpg' || $ext == '.jpe' || $ext == '.jpeg') {
			if(!$gd['JPG Support'] && !$gd['JPEG Support'])  return false;
			$thumbFunc = 'imagejpeg';
		} else {
			return false;
		}

		// determine thumbnail file name
		$ext = $matches[0];
		$thumb = substr($img, 0, -5) . str_replace($ext, $id . $ext, substr($img, -5));

		// if the original image smaller than thumb, then just copy it to thumb
		if($h > $oh && $w > $ow) {
			return (@copy($img, $thumb) ? true : false);
		}

		// get image data
		if(
			$thumbFunc == 'imagewebp'
			&& !$imgData = imagecreatefromwebp($img)
		)
			return false;
		elseif(!$imgData = imagecreatefromstring(file_get_contents($img)))
			return false;

		// finally, create thumbnail
		$thumbData = imagecreatetruecolor($w, $h);

		//preserve transparency of png and gif images
		$transIndex = null;
		if($thumbFunc == 'imagepng' || $thumbFunc == 'imagewebp') {
			if(($clr = @imagecolorallocate($thumbData, 0, 0, 0)) != -1) {
				@imagecolortransparent($thumbData, $clr);
				@imagealphablending($thumbData, false);
				@imagesavealpha($thumbData, true);
			}
		} elseif($thumbFunc == 'imagegif') {
			@imagealphablending($thumbData, false);
			$transIndex = imagecolortransparent($imgData);
			if($transIndex >= 0) {
				$transClr = imagecolorsforindex($imgData, $transIndex);
				$transIndex = imagecolorallocatealpha($thumbData, $transClr['red'], $transClr['green'], $transClr['blue'], 127);
				imagefill($thumbData, 0, 0, $transIndex);
			}
		}

		// resize original image into thumbnail
		if(!imagecopyresampled($thumbData, $imgData, 0, 0 , 0, 0, $w, $h, $ow, $oh)) return false;
		unset($imgData);

		// gif transparency
		if($thumbFunc == 'imagegif' && $transIndex >= 0) {
			imagecolortransparent($thumbData, $transIndex);
			for($y = 0; $y < $h; ++$y)
				for($x = 0; $x < $w; ++$x)
					if(((imagecolorat($thumbData, $x, $y) >> 24) & 0x7F) >= 100) imagesetpixel($thumbData, $x, $y, $transIndex);
			imagetruecolortopalette($thumbData, true, 255);
			imagesavealpha($thumbData, false);
		}

		if(!$thumbFunc($thumbData, $thumb)) return false;
		unset($thumbData);

		return true;
	}
	########################################################################
	function makeSafe($string, $is_gpc = true) {
		static $cached = []; /* str => escaped_str */

		if(!strlen($string)) return '';

		if(!db_link()) sql("SELECT 1+1", $eo);

		// if this is a previously escaped string, return from cached
		// checking both keys and values
		if(isset($cached[$string])) return $cached[$string];
		$key = array_search($string, $cached);
		if($key !== false) return $string; // already an escaped string

		$cached[$string] = db_escape($string);
		return $cached[$string];
	}
	########################################################################
	function checkPermissionVal($pvn) {
		// fn to make sure the value in the given POST variable is 0, 1, 2 or 3
		// if the value is invalid, it default to 0
		$pvn = intval(Request::val($pvn));
		if($pvn != 1 && $pvn != 2 && $pvn != 3) {
			return 0;
		} else {
			return $pvn;
		}
	}
	########################################################################
	function dieErrorPage($error) {
		global $Translation;

		$header = (defined('ADMIN_AREA') ? __DIR__ . '/incHeader.php' : __DIR__ . '/../header.php');
		$footer = (defined('ADMIN_AREA') ? __DIR__ . '/incFooter.php' : __DIR__ . '/../footer.php');

		ob_start();

		@include_once($header);
		echo Notification::placeholder();
		echo Notification::show([
			'message' => $error,
			'class' => 'danger',
			'dismiss_seconds' => 7200
		]);
		@include_once($footer);

		echo ob_get_clean();
		exit;
	}
	########################################################################
	function openDBConnection(&$o) {
		static $connected = false, $db_link;

		$dbServer = config('dbServer');
		$dbUsername = config('dbUsername');
		$dbPassword = config('dbPassword');
		$dbDatabase = config('dbDatabase');

		if($connected) return $db_link;

		/****** Check that MySQL module is enabled ******/
		if(!extension_loaded('mysql') && !extension_loaded('mysqli')) {
			$o['error'] = 'PHP is not configured to connect to MySQL on this machine. Please see <a href="https://www.php.net/manual/en/ref.mysql.php">this page</a> for help on how to configure MySQL.';
			if(!empty($o['silentErrors'])) return false;

			dieErrorPage($o['error']);
		}

		/****** Connect to MySQL ******/
		if(!($db_link = @db_connect($dbServer, $dbUsername, $dbPassword))) {
			$o['error'] = db_error($db_link, true);
			if(!empty($o['silentErrors'])) return false;

			dieErrorPage($o['error']);
		}

		/****** Select DB ********/
		if(!db_select_db($dbDatabase, $db_link)) {
			$o['error'] = db_error($db_link);
			if(!empty($o['silentErrors'])) return false;

			dieErrorPage($o['error']);
		}

		$connected = true;
		return $db_link;
	}
	########################################################################
	function sql($statement, &$o) {

		/*
			Supported options that can be passed in $o options array (as array keys):
			'silentErrors': If true, errors will be returned in $o['error'] rather than displaying them on screen and exiting.
			'noSlowQueryLog': don't log slow query if true
			'noErrorQueryLog': don't log error query if true
		*/

		global $Translation;

		$db_link = openDBConnection($o);

		/*
		 if openDBConnection() fails, it would abort execution unless 'silentErrors' is true,
		 in which case, we should return false from sql() without further action since
		 $o['error'] would be already set by openDBConnection()
		*/
		if(!$db_link) return false;

		$t0 = microtime(true);

		if(!$result = @db_query($statement, $db_link)) {
			if(!stristr($statement, "show columns")) {
				// retrieve error codes
				$errorNum = db_errno($db_link);
				$o['error'] = db_error($db_link);

				if(empty($o['noErrorQueryLog']))
					logErrorQuery($statement, $o['error']);

				if(getLoggedAdmin())
					$o['error'] = htmlspecialchars($o['error']) . 
						"<pre class=\"ltr\">{$Translation['query:']}\n" . htmlspecialchars($statement) . '</pre>' .
						"<p><i class=\"text-right\">{$Translation['admin-only info']}</i></p>" .
						"<p>{$Translation['try rebuild fields']}</p>";

				if(!empty($o['silentErrors'])) return false;

				dieErrorPage($o['error']);
			}
		}

		/* log slow queries that take more than 1 sec */
		$t1 = microtime(true);
		if(($t1 - $t0) > 1.0 && empty($o['noSlowQueryLog']))
			logSlowQuery($statement, $t1 - $t0);

		return $result;
	}
	########################################################################
	function logSlowQuery($statement, $duration) {
		if(!createQueryLogTable()) return;

		$o = [
			'silentErrors' => true,
			'noSlowQueryLog' => true,
			'noErrorQueryLog' => true
		];
		$statement = makeSafe(trim(preg_replace('/^\s+/m', ' ', $statement)));
		$duration = floatval($duration);
		$memberID = makeSafe(getLoggedMemberID());
		$uri = makeSafe($_SERVER['REQUEST_URI']);

		sql("INSERT INTO `appgini_query_log` SET
			`statement`='$statement',
			`duration`=$duration,
			`memberID`='$memberID',
			`uri`='$uri'
		", $o);
	}
	########################################################################
	function logErrorQuery($statement, $error) {
		if(!createQueryLogTable()) return;

		$o = [
			'silentErrors' => true,
			'noSlowQueryLog' => true,
			'noErrorQueryLog' => true
		];
		$statement = makeSafe(trim(preg_replace('/^\s+/m', ' ', $statement)));
		$error = makeSafe($error);
		$memberID = makeSafe(getLoggedMemberID());
		$uri = makeSafe($_SERVER['REQUEST_URI']);

		sql("INSERT INTO `appgini_query_log` SET
			`statement`='$statement',
			`error`='$error',
			`memberID`='$memberID',
			`uri`='$uri'
		", $o);
	}

	########################################################################
	function createQueryLogTable() {
		static $created = false;
		if($created) return true;

		$o = [
			'silentErrors' => true,
			'noSlowQueryLog' => true,
			'noErrorQueryLog' => true
		];

		sql("CREATE TABLE IF NOT EXISTS `appgini_query_log` (
			`datetime` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
			`statement` LONGTEXT,
			`duration` DECIMAL(10,2) UNSIGNED DEFAULT 0.0,
			`error` TEXT,
			`memberID` VARCHAR(200),
			`uri` VARCHAR(200)
		) CHARSET " . mysql_charset, $o);

		// check if table created
		//$o2 = $o;
		//$o2['error'] = '';
		//sql("SELECT COUNT(1) FROM 'appgini_query_log'", $o2);

		//$created = empty($o2['error']);

		$created = true;
		return $created;
	}

	########################################################################
	function sqlValue($statement, &$error = NULL) {
		// executes a statement that retreives a single data value and returns the value retrieved
		$eo = ['silentErrors' => true];
		if(!$res = sql($statement, $eo)) { $error = $eo['error']; return false; }
		if(!$row = db_fetch_row($res)) return false;
		return $row[0];
	}
	########################################################################
	function getLoggedAdmin() {
		return Authentication::getAdmin();
	}
	########################################################################
	function initSession() {
		Authentication::initSession();
	}
	########################################################################
	function jwt_key() {
		if(!is_file(configFileName())) return false;
		return md5_file(configFileName());
	}
	########################################################################
	function jwt_token($user = false) {
		if($user === false) {
			$mi = Authentication::getUser();
			if(!$mi) return false;

			$user = $mi['memberId'];
		}

		$key = jwt_key();
		if($key === false) return false;
		return JWT::encode(['user' => $user], $key);
	}
	########################################################################
	function jwt_header() {
		/* adapted from https://stackoverflow.com/a/40582472/1945185 */
		$auth_header = null;
		if(isset($_SERVER['Authorization'])) {
			$auth_header = trim($_SERVER['Authorization']);
		} elseif(isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
			$auth_header = trim($_SERVER['HTTP_AUTHORIZATION']);
		} elseif(isset($_SERVER['HTTP_X_AUTHORIZATION'])) { //hack if all else fails
			$auth_header = trim($_SERVER['HTTP_X_AUTHORIZATION']);
		} elseif(function_exists('apache_request_headers')) {
			$rh = apache_request_headers();
			// Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
			$rh = array_combine(array_map('ucwords', array_keys($rh)), array_values($rh));
			if(isset($rh['Authorization'])) {
				$auth_header = trim($rh['Authorization']);
			} elseif(isset($rh['X-Authorization'])) {
				$auth_header = trim($rh['X-Authorization']);
			}
		}

		if(!empty($auth_header)) {
			if(preg_match('/Bearer\s(\S+)/', $auth_header, $matches)) return $matches[1];
		}

		return null;
	}
	########################################################################
	function jwt_check_login() {
		// do we have an Authorization Bearer header?
		$token = jwt_header();
		if(!$token) return false;

		$key = jwt_key();
		if($key === false) return false;

		$error = '';
		$payload = JWT::decode($token, $key, $error);
		if(empty($payload['user'])) return false;

		Authentication::signInAs($payload['user']);

		// for API calls that just trigger an action and then close connection, 
		// we need to continue running
		@ignore_user_abort(true);
		@set_time_limit(120);

		return true;
	}
	########################################################################
	function curl_insert_handler($table, $data) {
		if(!function_exists('curl_init')) return false;
		$ch = curl_init();

		$payload = $data;
		$payload['insert_x'] = 1;

		$url = (isset($_SERVER['HTTPS']) ? 'https://' : 'http://') . config('host') . '/' . application_uri("{$table}_view.php");
		$token = jwt_token();
		$options = [
			CURLOPT_URL => $url,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => http_build_query($payload),
			CURLOPT_HTTPHEADER => [
				"User-Agent: {$_SERVER['HTTP_USER_AGENT']}",
				"Accept: {$_SERVER['HTTP_ACCEPT']}",
				"Authorization: Bearer $token",
				"X-Authorization: Bearer $token",
			],
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_RETURNTRANSFER => true,

			/* this is a localhost request so need to verify SSL */
			CURLOPT_SSL_VERIFYPEER => false,

			// the following option allows sending request and then 
			// closing the connection without waiting for response
			// see https://stackoverflow.com/a/10895361/1945185
			CURLOPT_TIMEOUT => 8,
		];

		if(defined('CURLOPT_TCP_FASTOPEN')) $options[CURLOPT_TCP_FASTOPEN] = true;
		if(defined('CURLOPT_SAFE_UPLOAD'))
			$options[CURLOPT_SAFE_UPLOAD] = function_exists('curl_file_create');

		// this is safe to use as we're sending a local request
		if(defined('CURLOPT_UNRESTRICTED_AUTH')) $options[CURLOPT_UNRESTRICTED_AUTH] = 1;

		curl_setopt_array($ch, $options);

		return $ch;
	}
	########################################################################
	function curl_batch($handlers) {
		if(!function_exists('curl_init')) return false;
		if(!is_array($handlers)) return false;
		if(!count($handlers)) return false;

		$mh = curl_multi_init();
		if(function_exists('curl_multi_setopt')) {
			curl_multi_setopt($mh, CURLMOPT_PIPELINING, 1);
			curl_multi_setopt($mh, CURLMOPT_MAXCONNECTS, min(20, count($handlers)));
		}

		foreach($handlers as $ch) {
			@curl_multi_add_handle($mh, $ch);
		}

		$active = false;
		do {
			@curl_multi_exec($mh, $active);
			usleep(2000);
		} while($active > 0);
	}
	########################################################################
	function logOutUser() {
		RememberMe::logout();
	}
	########################################################################
	function getPKFieldName($tn) {
		// get pk field name of given table
		static $pk = [];
		if(isset($pk[$tn])) return $pk[$tn];

		$stn = makeSafe($tn, false);
		$eo = ['silentErrors' => true];
		if(!$res = sql("SHOW FIELDS FROM `$stn`", $eo)) return $pk[$tn] = false;

		while($row = db_fetch_assoc($res))
			if($row['Key'] == 'PRI') return $pk[$tn] = $row['Field'];

		return $pk[$tn] = false;
	}
	########################################################################
	function getCSVData($tn, $pkValue, $stripTags = true) {
		// get pk field name for given table
		if(!$pkField = getPKFieldName($tn))
			return '';

		// get a concat string to produce a csv list of field values for given table record
		if(!$res = sql("SHOW FIELDS FROM `$tn`", $eo))
			return '';

		$csvFieldList = '';
		while($row = db_fetch_assoc($res))
			$csvFieldList .= "`{$row['Field']}`,";
		$csvFieldList = substr($csvFieldList, 0, -1);

		$csvData = sqlValue("SELECT CONCAT_WS(', ', $csvFieldList) FROM `$tn` WHERE `$pkField`='" . makeSafe($pkValue, false) . "'");

		return ($stripTags ? strip_tags($csvData) : $csvData);
	}
	########################################################################
	function errorMsg($msg) {
		echo "<div class=\"alert alert-danger\">{$msg}</div>";
	}
	########################################################################
	function redirect($url, $absolute = false) {
		$fullURL = ($absolute ? $url : application_url($url));
		if(!headers_sent()) header("Location: {$fullURL}");

		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;url={$fullURL}\">";
		echo "<br><br><a href=\"{$fullURL}\">Click here</a> if you aren't automatically redirected.";
		exit;
	}
	########################################################################
	function htmlRadioGroup($name, $arrValue, $arrCaption, $selectedValue, $selClass = 'text-primary', $class = '', $separator = '<br>') {
		if(!is_array($arrValue)) return '';

		ob_start();
		?>
		<div class="radio %%CLASS%%"><label>
			<input type="radio" name="%%NAME%%" id="%%ID%%" value="%%VALUE%%" %%CHECKED%%> %%LABEL%%
		</label></div>
		<?php
		$template = ob_get_clean();

		$out = '';
		for($i = 0; $i < count($arrValue); $i++) {
			$replacements = [
				'%%CLASS%%' => html_attr($arrValue[$i] == $selectedValue ? $selClass :$class),
				'%%NAME%%' => html_attr($name),
				'%%ID%%' => html_attr($name . $i),
				'%%VALUE%%' => html_attr($arrValue[$i]),
				'%%LABEL%%' => $arrCaption[$i],
				'%%CHECKED%%' => ($arrValue[$i]==$selectedValue ? " checked" : "")
			];
			$out .= str_replace(array_keys($replacements), array_values($replacements), $template);
		}

		return $out;
	}
	########################################################################
	function htmlSelect($name, $arrValue, $arrCaption, $selectedValue, $class = '', $selectedClass = '') {
		if($selectedClass == '')
			$selectedClass = $class;

		$out = '';
		if(is_array($arrValue)) {
			$out = "<select name=\"$name\" id=\"$name\">";
			for($i = 0; $i < count($arrValue); $i++)
				$out .= '<option value="' . $arrValue[$i] . '"' . ($arrValue[$i] == $selectedValue ? " selected class=\"$class\"" : " class=\"$selectedClass\"") . '>' . $arrCaption[$i] . '</option>';
			$out .= '</select>';
		}
		return $out;
	}
	########################################################################
	function htmlSQLSelect($name, $sql, $selectedValue, $class = '', $selectedClass = '') {
		$arrVal = [''];
		$arrCap = [''];
		if($res = sql($sql, $eo)) {
			while($row = db_fetch_row($res)) {
				$arrVal[] = $row[0];
				$arrCap[] = $row[1];
			}
			return htmlSelect($name, $arrVal, $arrCap, $selectedValue, $class, $selectedClass);
		}

		return '';
	}
	########################################################################
	function bootstrapSelect($name, $arrValue, $arrCaption, $selectedValue, $class = '', $selectedClass = '') {
		if($selectedClass == '') $selectedClass = $class;

		$out = "<select class=\"form-control\" name=\"{$name}\" id=\"{$name}\">";
		if(is_array($arrValue)) {
			for($i = 0; $i < count($arrValue); $i++) {
				$selected = "class=\"{$class}\"";
				if($arrValue[$i] == $selectedValue) $selected = "selected class=\"{$selectedClass}\"";
				$out .= "<option value=\"{$arrValue[$i]}\" {$selected}>{$arrCaption[$i]}</option>";
			}
		}
		$out .= '</select>';

		return $out;
	}
	########################################################################
	function bootstrapSQLSelect($name, $sql, $selectedValue, $class = '', $selectedClass = '') {
		$arrVal = [''];
		$arrCap = [''];
		$eo = ['silentErrors' => true];
		if($res = sql($sql, $eo)) {
			while($row = db_fetch_row($res)) {
				$arrVal[] = $row[0];
				$arrCap[] = $row[1];
			}
			return bootstrapSelect($name, $arrVal, $arrCap, $selectedValue, $class, $selectedClass);
		}

		return '';
	}
	########################################################################
	function isEmail($email){
		if(preg_match('/^([*+!.&#$¦\'\\%\/0-9a-z^_`{}=?~:-]+)@(([0-9a-z-]+\.)+[0-9a-z]{2,30})$/i', $email))
			return $email;

		return false;
	}
	########################################################################
	function notifyMemberApproval($memberID) {
		$adminConfig = config('adminConfig');
		$memberID = strtolower($memberID);

		$email = sqlValue("select email from membership_users where lcase(memberID)='{$memberID}'");

		return sendmail([
			'to' => $email,
			'name' => $memberID,
			'subject' => $adminConfig['approvalSubject'],
			'message' => nl2br($adminConfig['approvalMessage']),
		]);
	}
	########################################################################
	function setupMembership() {
		if(empty($_SESSION) || empty($_SESSION['memberID'])) return;

		// run once per session, but force proceeding if not all mem tables created
		$res = sql("show tables like 'membership_%'", $eo);
		$num_mem_tables = db_num_rows($res);
		$mem_update_fn = membership_table_functions();
		if(isset($_SESSION['setupMembership']) && $num_mem_tables >= count($mem_update_fn)) return;

		/* abort if current page is one of the following exceptions */
		if(in_array(basename($_SERVER['PHP_SELF']), [
			'pageEditMember.php', 
			'membership_passwordReset.php', 
			'membership_profile.php', 
			'membership_signup.php', 
			'pageChangeMemberStatus.php', 
			'pageDeleteGroup.php', 
			'pageDeleteMember.php', 
			'pageEditGroup.php', 
			'pageEditMemberPermissions.php', 
			'pageRebuildFields.php', 
			'pageSettings.php',
			'ajax_check_login.php',
			'ajax-update-calculated-fields.php',
		])) return;

		// call each update_membership function
		foreach($mem_update_fn as $mem_fn) {
			$mem_fn();
		}

		configure_anonymous_group();
		configure_admin_group();

		$_SESSION['setupMembership'] = time();
	}
	########################################################################
	function membership_table_functions() {
		// returns a list of update_membership_* functions
		$arr = get_defined_functions();
		return array_filter($arr['user'], function($f) {
			return (strpos($f, 'update_membership_') !== false);
		});
	}
	########################################################################
	function configure_anonymous_group() {
		$eo = ['silentErrors' => true, 'noErrorQueryLog' => true];

		$adminConfig = config('adminConfig');
		$today = @date('Y-m-d');

		$anon_group_safe = makeSafe($adminConfig['anonymousGroup']);
		$anon_user = strtolower($adminConfig['anonymousMember']);
		$anon_user_safe = makeSafe($anon_user);

		/* create anonymous group if not there and get its ID */
		$same_fields = "`allowSignup`=0, `needsApproval`=0";
		sql("INSERT INTO `membership_groups` SET 
				`name`='{$anon_group_safe}', {$same_fields}, 
				`description`='Anonymous group created automatically on {$today}'
			ON DUPLICATE KEY UPDATE {$same_fields}", 
		$eo);

		$anon_group_id = sqlValue("SELECT `groupID` FROM `membership_groups` WHERE `name`='{$anon_group_safe}'");
		if(!$anon_group_id) return;

		/* create guest user if not there or if guest name in config differs from that in db */
		$anon_user_db = sqlValue("SELECT LCASE(`memberID`) FROM `membership_users` 
			WHERE `groupID`='{$anon_group_id}'");
		if(!$anon_user_db || $anon_user_db != $anon_user) {
			sql("DELETE FROM `membership_users` WHERE `groupID`='{$anon_group_id}'", $eo);
			sql("INSERT INTO `membership_users` SET 
				`memberID`='{$anon_user_safe}', 
				`signUpDate`='{$today}', 
				`groupID`='{$anon_group_id}', 
				`isBanned`=0, 
				`isApproved`=1, 
				`comments`='Anonymous member created automatically on {$today}'", 
			$eo);
		}
	}
	########################################################################
	function configure_admin_group() {
		$eo = ['silentErrors' => true, 'noErrorQueryLog' => true];

		$adminConfig = config('adminConfig');
		$today = @date('Y-m-d');
		$admin_group_safe = 'Admins';
		$admin_user_safe = makeSafe(strtolower($adminConfig['adminUsername']));
		$admin_hash_safe = makeSafe($adminConfig['adminPassword']);
		$admin_email_safe = makeSafe($adminConfig['senderEmail']);

		/* create admin group if not there and get its ID */
		$same_fields = "`allowSignup`=0, `needsApproval`=1";
		sql("INSERT INTO `membership_groups` SET 
				`name`='{$admin_group_safe}', {$same_fields}, 
				`description`='Admin group created automatically on {$today}'
			ON DUPLICATE KEY UPDATE {$same_fields}", 
		$eo);
		$admin_group_id = sqlValue("SELECT `groupID` FROM `membership_groups` WHERE `name`='{$admin_group_safe}'");
		if(!$admin_group_id) return;

		/* create super-admin user if not there (if exists, query would abort with suppressed error) */
		sql("INSERT INTO `membership_users` SET 
			`memberID`='{$admin_user_safe}', 
			`passMD5`='{$admin_hash_safe}', 
			`email`='{$admin_email_safe}', 
			`signUpDate`='{$today}', 
			`groupID`='{$admin_group_id}', 
			`isBanned`=0, 
			`isApproved`=1, 
			`comments`='Admin member created automatically on {$today}'", 
		$eo);

		/* insert/update admin group permissions to allow full access to all tables */
		$tables = getTableList(true);
		foreach($tables as $tn => $ignore) {
			$same_fields = '`allowInsert`=1,`allowView`=3,`allowEdit`=3,`allowDelete`=3';
			sql("INSERT INTO `membership_grouppermissions` SET
					`groupID`='{$admin_group_id}',
					`tableName`='{$tn}',
					{$same_fields}
				ON DUPLICATE KEY UPDATE {$same_fields}",
			$eo);
		}
	}
	########################################################################
	function get_table_keys($tn) {
		$keys = [];
		$res = sql("SHOW KEYS FROM `{$tn}`", $eo);
		while($row = db_fetch_assoc($res))
			$keys[$row['Key_name']][$row['Seq_in_index']] = $row;

		return $keys;
	}
	########################################################################
	function get_table_fields($tn = null) {
		static $schema = null;
		if($schema === null) {
			/* application schema as created in AppGini */
			$schema = [
				'gmt_fleet_register' => [
					'fleet_asset_id' => [
						'appgini' => "INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Asset ID:',
							'description' => '',
						],
					],
					'vehicle_registration_number' => [
						'appgini' => "VARCHAR(25) NOT NULL UNIQUE",
						'info' => [
							'caption' => 'Registration Number:',
							'description' => '',
						],
					],
					'register_number' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Register Number:',
							'description' => '',
						],
					],
					'engine_number' => [
						'appgini' => "VARCHAR(35) NOT NULL UNIQUE",
						'info' => [
							'caption' => 'Engine Number:',
							'description' => '',
						],
					],
					'chassis_number' => [
						'appgini' => "VARCHAR(35) NOT NULL UNIQUE",
						'info' => [
							'caption' => 'Chassis/Vin Number:',
							'description' => '',
						],
					],
					'dealer_name' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Make of Vehicle/Dealer Name:',
							'description' => '',
						],
					],
					'make_of_vehicle' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Make of Vehicle:',
							'description' => '',
						],
					],
					'model_of_vehicle' => [
						'appgini' => "VARCHAR(45) NULL",
						'info' => [
							'caption' => 'Model of Vehicle:',
							'description' => '',
						],
					],
					'year_model_specification' => [
						'appgini' => "INT(11) NOT NULL",
						'info' => [
							'caption' => 'Year Model Specification:',
							'description' => '',
						],
					],
					'engine_capacity' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Engine Capacity (cc):',
							'description' => '',
						],
					],
					'tyre_size' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tyre Size (Radial):',
							'description' => '',
						],
					],
					'transmission' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Transmission:',
							'description' => '',
						],
					],
					'fuel_type' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Fuel Type:',
							'description' => '',
						],
					],
					'type_of_vehicle' => [
						'appgini' => "INT(11) NOT NULL",
						'info' => [
							'caption' => 'Type of Vehicle:',
							'description' => '',
						],
					],
					'colour_of_vehicle' => [
						'appgini' => "INT(11) NOT NULL",
						'info' => [
							'caption' => 'Colour of Vehicle:',
							'description' => '',
						],
					],
					'application_status' => [
						'appgini' => "INT NOT NULL",
						'info' => [
							'caption' => 'Application Status:',
							'description' => '',
						],
					],
					'case_number' => [
						'appgini' => "VARCHAR(40) NULL DEFAULT 'CAS_'",
						'info' => [
							'caption' => 'Case Number (If Vehicle Stolen):',
							'description' => '',
						],
					],
					'barcode_number' => [
						'appgini' => "VARCHAR(35) NULL UNIQUE",
						'info' => [
							'caption' => 'Barcode Number:',
							'description' => '',
						],
					],
					'purchase_price' => [
						'appgini' => "DECIMAL(10,2) NOT NULL",
						'info' => [
							'caption' => 'Purchase Price:',
							'description' => '',
						],
					],
					'depreciation_value' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Depreciation Value:',
							'description' => '',
						],
					],
					'photo_of_vehicle' => [
						'appgini' => "VARCHAR(255) NULL",
						'info' => [
							'caption' => 'Photo of Vehicle:',
							'description' => 'Maximum file size allowed: 1024 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'user_name_and_surname' => [
						'appgini' => "VARCHAR(40) NOT NULL",
						'info' => [
							'caption' => 'Owner of Vehicle Name & Surname:',
							'description' => '',
						],
					],
					'user_contact_email' => [
						'appgini' => "VARCHAR(40) NOT NULL",
						'info' => [
							'caption' => 'User Contact Email:',
							'description' => '',
						],
					],
					'contact_number' => [
						'appgini' => "VARCHAR(16) NOT NULL",
						'info' => [
							'caption' => 'Contact Number:',
							'description' => '',
						],
					],
					'department_name' => [
						'appgini' => "INT(11) NOT NULL",
						'info' => [
							'caption' => 'Department Name:',
							'description' => '',
						],
					],
					'department_address' => [
						'appgini' => "TEXT NOT NULL",
						'info' => [
							'caption' => 'Department Address:',
							'description' => '',
						],
					],
					'province' => [
						'appgini' => "INT(11) NOT NULL",
						'info' => [
							'caption' => 'Province:',
							'description' => '',
						],
					],
					'district' => [
						'appgini' => "INT(11) NOT NULL",
						'info' => [
							'caption' => 'District and Station:',
							'description' => '',
						],
					],
					'drivers_name_and_surname' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Driver\'s Name & Surname:',
							'description' => '',
						],
					],
					'drivers_persal_number' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Driver\'s Persal Number:',
							'description' => '',
						],
					],
					'department_name_of_driver' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Department Name of Driver:',
							'description' => '',
						],
					],
					'drivers_contact_details' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Driver\'s Contact Details:',
							'description' => '',
						],
					],
					'documents' => [
						'appgini' => "VARCHAR(225) NULL",
						'info' => [
							'caption' => 'Documents:',
							'description' => 'Maximum file size allowed: 5120 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'date_auctioned' => [
						'appgini' => "DATE NULL DEFAULT '0000-00-00'",
						'info' => [
							'caption' => 'Date Auctioned:',
							'description' => '',
						],
					],
					'venue' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Venue:',
							'description' => '',
						],
					],
					'comments' => [
						'appgini' => "LONGTEXT NULL",
						'info' => [
							'caption' => 'Comments:',
							'description' => '',
						],
					],
					'renewal_of_license' => [
						'appgini' => "DATE NULL",
						'info' => [
							'caption' => 'License Expiry Date:',
							'description' => '',
						],
					],
					'mm_code' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'MM Code:',
							'description' => '',
						],
					],
				],
				'log_sheet' => [
					'fuel_log_sheet_id' => [
						'appgini' => "INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Fuel Log Sheet ID:',
							'description' => '',
						],
					],
					'vehicle_registration_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Registration Number:',
							'description' => '',
						],
					],
					'register_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Register Number:',
							'description' => '',
						],
					],
					'make_of_vehicle' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Make of Vehicle:',
							'description' => '',
						],
					],
					'model_of_vehicle' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Model of Vehicle:',
							'description' => '',
						],
					],
					'year_model_specification' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Year Model Specification:',
							'description' => '',
						],
					],
					'colour_of_vehicle' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Colour of Vehicle:',
							'description' => '',
						],
					],
					'engine_capacity' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Engine Capacity (cc):',
							'description' => '',
						],
					],
					'renewal_of_license' => [
						'appgini' => "DATE NULL",
						'info' => [
							'caption' => 'License Expiry Date:',
							'description' => '',
						],
					],
					'district' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'District and Station:',
							'description' => '',
						],
					],
					'month' => [
						'appgini' => "DATE NULL",
						'info' => [
							'caption' => 'Log Sheet - Year & Month:',
							'description' => '',
						],
					],
					'drivers_name_and_surname' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Driver\'s Surname:',
							'description' => '',
						],
					],
					'drivers_persal_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Driver\'s Persal Number:',
							'description' => '',
						],
					],
					'opening_km' => [
						'appgini' => "VARCHAR(15) NULL",
						'info' => [
							'caption' => 'Odometer Reading/Opening KM:',
							'description' => '',
						],
					],
					'total_trip_distance' => [
						'appgini' => "VARCHAR(15) NULL",
						'info' => [
							'caption' => 'Total Trip Distance KM:',
							'description' => '',
						],
					],
					'closing_km' => [
						'appgini' => "VARCHAR(15) NULL",
						'info' => [
							'caption' => 'Odometer Reading/Closing KM:',
							'description' => '',
						],
					],
					'fuel_type' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Fuel Type:',
							'description' => '',
						],
					],
					'fuel_tank_capacity' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Fuel Tank Capacity:',
							'description' => '',
						],
					],
					'vendor' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Vendor/Fuel Station/Garage:',
							'description' => '',
						],
					],
					'fuel_cost_litre' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Fuel Cost Litre (R/L):',
							'description' => '',
						],
					],
					'refuel_quantity_1' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Refuel Quantity L [1]:',
							'description' => 'Amount of fuel (L)',
						],
					],
					'refuel_first_time_date' => [
						'appgini' => "DATE NULL",
						'info' => [
							'caption' => 'Refuel Date (First Time ):',
							'description' => '',
						],
					],
					'trip_distance_refuel_1' => [
						'appgini' => "VARCHAR(15) NULL",
						'info' => [
							'caption' => 'Trip Distance After 1st Refuel KM:',
							'description' => '',
						],
					],
					'refuel_quantity_2' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Refuel Quantity  L [2]:',
							'description' => 'Amount of fuel (L)',
						],
					],
					'refuel_second_time_date' => [
						'appgini' => "DATE NULL",
						'info' => [
							'caption' => 'Refuel Date (Second Time ):',
							'description' => '',
						],
					],
					'trip_distance_refuel_2' => [
						'appgini' => "VARCHAR(15) NULL",
						'info' => [
							'caption' => 'Trip Distance After 2nd Refuel KM:',
							'description' => '',
						],
					],
					'refuel_quantity_3' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Refuel Quantity L [3]:',
							'description' => 'Amount of fuel (L)',
						],
					],
					'refuel_third_time_date' => [
						'appgini' => "DATE NULL",
						'info' => [
							'caption' => 'Refuel Date (Third Time ):',
							'description' => '',
						],
					],
					'trip_distance_refuel_3' => [
						'appgini' => "VARCHAR(15) NULL",
						'info' => [
							'caption' => 'Trip Distance After 3rd Refuel KM:',
							'description' => '',
						],
					],
					'refuel_quantity_4' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Refuel Quantity L [4]:',
							'description' => 'Amount of fuel (L)',
						],
					],
					'refuel_fourth_time_date' => [
						'appgini' => "DATE NULL",
						'info' => [
							'caption' => 'Refuel Date (Fouth Time ):',
							'description' => '',
						],
					],
					'trip_distance_refuel_4' => [
						'appgini' => "VARCHAR(15) NULL",
						'info' => [
							'caption' => 'Trip Distance After 4th Refuel KM:',
							'description' => '',
						],
					],
					'refuel_quantity_5' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Refuel Quantity L [5]:',
							'description' => 'Amount of fuel (L)',
						],
					],
					'refuel_fifth_time_date' => [
						'appgini' => "DATE NULL",
						'info' => [
							'caption' => 'Refuel Date (Fifth Time ):',
							'description' => '',
						],
					],
					'trip_distance_refuel_5' => [
						'appgini' => "VARCHAR(15) NULL",
						'info' => [
							'caption' => 'Trip Distance After 5th Refuel KM:',
							'description' => '',
						],
					],
					'refuel_quantity_6' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Refuel Quantity L [6]:',
							'description' => 'Amount of fuel (L)',
						],
					],
					'trip_distance_refuel_6' => [
						'appgini' => "VARCHAR(15) NULL",
						'info' => [
							'caption' => 'Trip Distance After 6th Refuel KM:',
							'description' => '',
						],
					],
					'refuel_sixth_time_date' => [
						'appgini' => "DATE NULL",
						'info' => [
							'caption' => 'Refuel Date (Sixth Time ):',
							'description' => '',
						],
					],
					'times_refuel_current_month' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Times Refuel Current Month:',
							'description' => '',
						],
					],
					'total_fuel_quantity' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Total Fuel Quantity (L):',
							'description' => '',
						],
					],
					'fuel_consumption' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Fuel Consumption (Km/L):',
							'description' => '',
						],
					],
					'fuel_total_cost' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Fuel Total Cost (R):',
							'description' => '',
						],
					],
					'payment_e_fuel_card' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Payment with e-Fuel Card?',
							'description' => '',
						],
					],
					'captured_by' => [
						'appgini' => "VARCHAR(35) NULL",
						'info' => [
							'caption' => 'Captured By:',
							'description' => '',
						],
					],
					'comments' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Comments:',
							'description' => '',
						],
					],
					'date_captured' => [
						'appgini' => "DATE NULL",
						'info' => [
							'caption' => 'Date Captured:',
							'description' => '',
						],
					],
					'complete_fill_up' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Complete Fill Up:',
							'description' => '',
						],
					],
				],
				'vehicle_history' => [
					'history_id' => [
						'appgini' => "INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'History ID:',
							'description' => '',
						],
					],
					'vehicle_registration_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Registration Number:',
							'description' => '',
						],
					],
					'engine_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Engine Number:',
							'description' => '',
						],
					],
					'purchased_price' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Purchase Price (R):',
							'description' => '',
						],
					],
					'old_registration_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Old Registration Number:',
							'description' => '',
						],
					],
					'new_vehicle_registration_number' => [
						'appgini' => "VARCHAR(25) NULL UNIQUE",
						'info' => [
							'caption' => 'New Vehicle Registration Number:',
							'description' => '',
						],
					],
					'date_of_vehicle_transfer' => [
						'appgini' => "DATE NULL",
						'info' => [
							'caption' => 'Date of  Vehicle Transfer:',
							'description' => '',
						],
					],
					'comments' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Comments:',
							'description' => '',
						],
					],
					'renewal_of_license' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Renewal Of License:',
							'description' => '',
						],
					],
					'date_of_service' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Date of Service:',
							'description' => '',
						],
					],
					'date_of_next_service' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Date of Next Service:',
							'description' => '',
						],
					],
					'purchased_order_number' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Purchased Order Number:',
							'description' => '',
						],
					],
					'claim_code' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Claims Code:',
							'description' => '',
						],
					],
					'tyre_inspection_report' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Tyre Inspection Report:',
							'description' => 'Maximum file size allowed: 5120 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'inspection_certification_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Inspection Certification No:',
							'description' => '',
						],
					],
					'document_checklist_report' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Document Check List Report:',
							'description' => 'Maximum file size allowed: 5120 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'next_inspection_date' => [
						'appgini' => "INT(11) NULL DEFAULT '1'",
						'info' => [
							'caption' => 'Next Inspection Date:',
							'description' => '',
						],
					],
					'breakdown_of_vehicle' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Breakdown of Vehicle?:',
							'description' => '',
						],
					],
					'date_of_vehicle_breakdown' => [
						'appgini' => "DATE NULL",
						'info' => [
							'caption' => 'Date of Vehicle Breakdown:',
							'description' => '',
						],
					],
					'description_of_vehicle_breakdown' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Description of Vehicle Breakdown:',
							'description' => '',
						],
					],
					'closing_km' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Closing KM:',
							'description' => '',
						],
					],
					'date_of_vehicle_reactivation' => [
						'appgini' => "DATETIME NULL",
						'info' => [
							'caption' => 'Date of Vehicle Re-activation:',
							'description' => '',
						],
					],
					'total_cost' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Total Repairing Cost (R):',
							'description' => '',
						],
					],
				],
				'year_model' => [
					'year_model_id' => [
						'appgini' => "INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Year Model ID:',
							'description' => '',
						],
					],
					'year_model_specification' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Year Model Specification:',
							'description' => '',
						],
					],
				],
				'month' => [
					'month_id' => [
						'appgini' => "INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Month ID:',
							'description' => '',
						],
					],
					'month' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Month Model:',
							'description' => '',
						],
					],
				],
				'body_type' => [
					'body_type_id' => [
						'appgini' => "INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Body Type ID:',
							'description' => '',
						],
					],
					'type_of_vehicle' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Type of Vehicle:',
							'description' => '',
						],
					],
				],
				'vehicle_colour' => [
					'vehicle_colour_id' => [
						'appgini' => "INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Vehicle Colour ID:',
							'description' => '',
						],
					],
					'colour_of_vehicle' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Colour of Vehicle:',
							'description' => '',
						],
					],
				],
				'province' => [
					'province_id' => [
						'appgini' => "INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Province ID:',
							'description' => '',
						],
					],
					'province' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Province:',
							'description' => '',
						],
					],
				],
				'departments' => [
					'department_id' => [
						'appgini' => "INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Department ID:',
							'description' => '',
						],
					],
					'department_name' => [
						'appgini' => "VARCHAR(75) NULL",
						'info' => [
							'caption' => 'Department Name:',
							'description' => '',
						],
					],
				],
				'districts' => [
					'district_id' => [
						'appgini' => "INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'District ID:',
							'description' => '',
						],
					],
					'district' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'District:',
							'description' => 'Capture the district and stations detail',
						],
					],
					'station' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Government Garage/Station/Unit:',
							'description' => 'Define if it is a Government Garage, Station or Unit',
						],
					],
				],
				'application_status' => [
					'application_id' => [
						'appgini' => "INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Application Status ID:',
							'description' => '',
						],
					],
					'application_status' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Application Status:',
							'description' => '',
						],
					],
				],
				'vehicle_payments' => [
					'vehicle_payment_id' => [
						'appgini' => "INT NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Vehicle Payment ID:',
							'description' => '',
						],
					],
					'vehicle_registration_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Registration Number:',
							'description' => '',
						],
					],
					'engine_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Engine Number:',
							'description' => '',
						],
					],
					'chassis_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Chassis Number:',
							'description' => '',
						],
					],
					'make_of_vehicle' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Make of Vehicle:',
							'description' => '',
						],
					],
					'model_of_vehicle' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Model of Vehicle:',
							'description' => '',
						],
					],
					'year_model_of_vehicle' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Year Model of Vehicle:',
							'description' => '',
						],
					],
					'type_of_vehicle' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Type of Vehicle:',
							'description' => '',
						],
					],
					'application_status' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Application Status:',
							'description' => '',
						],
					],
					'barcode_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Barcode Number:',
							'description' => '',
						],
					],
					'purchase_price' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Purchase Price:',
							'description' => '',
						],
					],
					'depreciation_value' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Depreciation Value:',
							'description' => '',
						],
					],
					'closing_km' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Closing KM:',
							'description' => '',
						],
					],
					'department' => [
						'appgini' => "INT(6) NULL",
						'info' => [
							'caption' => 'Department:',
							'description' => '',
						],
					],
					'acquisition_reference' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Acquisition Reference:',
							'description' => '',
						],
					],
					'date_of_acquisition' => [
						'appgini' => "DATE NULL",
						'info' => [
							'caption' => 'Date Of Acquisition:',
							'description' => '',
						],
					],
					'odometer_at_acquisition' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Odometer At Acquisition (km):',
							'description' => '',
						],
					],
					'merchant_name' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Merchant Name:',
							'description' => '',
						],
					],
					'value_at_acquisition' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Value At Acquisition (R):',
							'description' => '',
						],
					],
					'term' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Term (Months):',
							'description' => '',
						],
					],
					'month_end' => [
						'appgini' => "DATE NULL",
						'info' => [
							'caption' => 'Month End:',
							'description' => '',
						],
					],
					'installment_per_month' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Installment Per Month (R):',
							'description' => '',
						],
					],
					'payment_amount' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Payment Amount (R):',
							'description' => '',
						],
					],
					'payment_frequency' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Payment Frequency: ',
							'description' => '',
						],
					],
					'interest_rate' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Interest Rate:',
							'description' => '',
						],
					],
					'payment_reference' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Payment Reference:',
							'description' => '',
						],
					],
					'paid_so_far' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Paid So Far (R):',
							'description' => '',
						],
					],
					'remaining_balance' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Remaining Balance (R):',
							'description' => '',
						],
					],
					'depreciation_since_purchase' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Depreciation Since Purchase (R) :',
							'description' => '',
						],
					],
					'actual_resale_value' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Actual Resale Value (R):',
							'description' => '',
						],
					],
					'warranty_expires_on' => [
						'appgini' => "DATE NULL",
						'info' => [
							'caption' => 'Warranty Expires On:',
							'description' => '',
						],
					],
					'comments' => [
						'appgini' => "LONGTEXT NULL",
						'info' => [
							'caption' => 'Comments:',
							'description' => '',
						],
					],
					'documents' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Documents:',
							'description' => 'Maximum file size allowed: 5120 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
				],
				'insurance_payments' => [
					'insurance_payment_id' => [
						'appgini' => "INT NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Insurance Payment ID:',
							'description' => '',
						],
					],
					'vehicle_registration_number' => [
						'appgini' => "INT(6) NULL",
						'info' => [
							'caption' => 'Registration Number:',
							'description' => '',
						],
					],
					'engine_number' => [
						'appgini' => "INT(6) NULL",
						'info' => [
							'caption' => 'Engine Number:',
							'description' => '',
						],
					],
					'chassis_number' => [
						'appgini' => "INT(6) NULL",
						'info' => [
							'caption' => 'Chassis Number:',
							'description' => '',
						],
					],
					'make_of_vehicle' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Make of Vehicle:',
							'description' => '',
						],
					],
					'model_of_vehicle' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Model of Vehicle:',
							'description' => '',
						],
					],
					'year_model_of_vehicle' => [
						'appgini' => "INT(6) NULL",
						'info' => [
							'caption' => 'Year Model of Vehicle:',
							'description' => '',
						],
					],
					'type_of_vehicle' => [
						'appgini' => "INT(6) NULL",
						'info' => [
							'caption' => 'Type of Vehicle:',
							'description' => '',
						],
					],
					'application_status' => [
						'appgini' => "INT(6) NULL",
						'info' => [
							'caption' => 'Application Status:',
							'description' => '',
						],
					],
					'barcode_number' => [
						'appgini' => "INT(6) NULL",
						'info' => [
							'caption' => 'Barcode Number:',
							'description' => '',
						],
					],
					'department' => [
						'appgini' => "INT(6) NULL",
						'info' => [
							'caption' => 'Department:',
							'description' => '',
						],
					],
					'insurance_reference' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Insurance Reference(Account Number):',
							'description' => '',
						],
					],
					'insurance_expiration' => [
						'appgini' => "DATE NULL",
						'info' => [
							'caption' => 'Insurance Expiration:',
							'description' => '',
						],
					],
					'transaction_date' => [
						'appgini' => "DATE NULL",
						'info' => [
							'caption' => 'Transaction Date:',
							'description' => '',
						],
					],
					'reference_number' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Reference Number:',
							'description' => '',
						],
					],
					'merchant_name' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Merchant Name (Insurance Company):',
							'description' => '',
						],
					],
					'payment_amount' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Payment Amount - Premium (R):',
							'description' => '',
						],
					],
					'month_end' => [
						'appgini' => "DATE NULL",
						'info' => [
							'caption' => 'Month End (Due):',
							'description' => '',
						],
					],
					'documents' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Documents:',
							'description' => 'Maximum file size allowed: 5120 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'comments' => [
						'appgini' => "LONGTEXT NULL",
						'info' => [
							'caption' => 'Comments:',
							'description' => '',
						],
					],
				],
				'authorizations' => [
					'authorize_id' => [
						'appgini' => "INT NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Authorize ID:',
							'description' => '',
						],
					],
					'job_code' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Job/Claims Code:',
							'description' => '',
						],
					],
					'job_status' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Job/Claims  Status:',
							'description' => '',
						],
					],
					'job_status_date' => [
						'appgini' => "DATE NULL DEFAULT '0000-00-00'",
						'info' => [
							'caption' => 'Job/Claims  Status Date:',
							'description' => '',
						],
					],
					'job_status_age' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Job/Claims  Status Age:',
							'description' => 'Determine the job status age.',
						],
					],
					'job_age' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Job/Claims Age:',
							'description' => 'Determine the job age.',
						],
					],
					'job_category' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Job/Claims  Category:',
							'description' => 'Classified the job category.',
						],
					],
					'job_odometer' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Job/Claims  Odometer (km):',
							'description' => '',
						],
					],
					'instruction_note' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Instruction Note:',
							'description' => 'Briefly describe the instruction.',
						],
					],
					'pre_authorisation_date' => [
						'appgini' => "INT(11) NULL DEFAULT '1'",
						'info' => [
							'caption' => 'Pre Authorisation Date:',
							'description' => '',
						],
					],
					'authorisation_date' => [
						'appgini' => "DATE NULL DEFAULT '0000-00-00'",
						'info' => [
							'caption' => 'Authorisation Date:',
							'description' => '',
						],
					],
					'vehicle_registration_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Vehicle Registration:',
							'description' => '',
						],
					],
					'make_of_vehicle' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Model of Vehicle:',
							'description' => '',
						],
					],
					'client' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Client:',
							'description' => '',
						],
					],
					'province_name' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Province Name:',
							'description' => '',
						],
					],
					'merchant_code' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Merchant Code:',
							'description' => '',
						],
					],
					'merchant_name' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Merchant Name:',
							'description' => '',
						],
					],
					'merchant_contact_email' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Merchant Contact e-Mail:',
							'description' => '',
						],
					],
					'merchant_street_address' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Merchant Street Address:',
							'description' => '',
						],
					],
					'merchant_suburb' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Merchant Suburb:',
							'description' => '',
						],
					],
					'merchant_city' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Merchant City:',
							'description' => '',
						],
					],
					'merchant_address_code' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Merchant Address Code:',
							'description' => '',
						],
					],
					'merchant_contact_details' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Merchant Phone:',
							'description' => '',
						],
					],
					'total_claim' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Total Amount Claim (R):',
							'description' => '',
						],
					],
					'total_authorised' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Total Authorised (R):',
							'description' => '',
						],
					],
					'authorization_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Authorization Number:',
							'description' => '',
						],
					],
					'last_fuel_transaction_date' => [
						'appgini' => "DATE NULL DEFAULT '0000-00-00'",
						'info' => [
							'caption' => 'Last Fuel Transaction Date:',
							'description' => '',
						],
					],
					'external_repairs' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'External Repairs:',
							'description' => '',
						],
					],
				],
				'service' => [
					'service_id' => [
						'appgini' => "INT NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Service ID:',
							'description' => '',
						],
					],
					'breakdown_of_vehicle' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Breakdown of Vehicle?:',
							'description' => '',
						],
					],
					'service_title' => [
						'appgini' => "VARCHAR(75) NULL",
						'info' => [
							'caption' => 'Service Title:',
							'description' => '',
						],
					],
					'service_item_type' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Service Item Type:',
							'description' => '',
						],
					],
					'service_category' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Service Category:',
							'description' => '',
						],
					],
					'merchant_name' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Merchant Name:',
							'description' => '',
						],
					],
					'vehicle_registration_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Registration Number:',
							'description' => '',
						],
					],
					'engine_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Engine Number:',
							'description' => '',
						],
					],
					'chassis_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Chassis Number:',
							'description' => '',
						],
					],
					'dealer_name' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Make of Vehicle/Dealer Name:',
							'description' => '',
						],
					],
					'make_of_vehicle' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Make of Vehicle:',
							'description' => '',
						],
					],
					'model_of_vehicle' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Model of Vehicle:',
							'description' => '',
						],
					],
					'year_model_of_vehicle' => [
						'appgini' => "INT(6) NULL",
						'info' => [
							'caption' => 'Year Model of Vehicle:',
							'description' => '',
						],
					],
					'type_of_vehicle' => [
						'appgini' => "INT(6) NULL",
						'info' => [
							'caption' => 'Type of Vehicle:',
							'description' => '',
						],
					],
					'closing_km' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Odometer Reading (km):',
							'description' => '',
						],
					],
					'application_status' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Application Status:',
							'description' => '',
						],
					],
					'work_allocation_reference_number' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Work Allocation Reference Number:',
							'description' => '',
						],
					],
					'barcode_number' => [
						'appgini' => "INT(6) NULL",
						'info' => [
							'caption' => 'Barcode Number:',
							'description' => '',
						],
					],
					'department' => [
						'appgini' => "INT(6) NULL",
						'info' => [
							'caption' => 'Department:',
							'description' => '',
						],
					],
					'service_item' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Service Item:',
							'description' => '',
						],
					],
					'date_of_service' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Date of Service:',
							'description' => '',
						],
					],
					'time' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Time:',
							'description' => '',
						],
					],
					'upload_quotation' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Documents (Upload Quotation):',
							'description' => 'Maximum file size allowed: 5120 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'date_of_next_service' => [
						'appgini' => "DATE NULL",
						'info' => [
							'caption' => 'Date of Next Service:',
							'description' => '',
						],
					],
					'repeat_service_schedule_every_km' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Repeat Service Schedule Every (km):',
							'description' => '',
						],
					],
					'comments' => [
						'appgini' => "LONGTEXT NULL",
						'info' => [
							'caption' => 'Comments:',
							'description' => '',
						],
					],
					'upload_invoice' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Documents (Upload Invoice):',
							'description' => 'Maximum file size allowed: 5120 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'receptionist' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Information Capture By Receptionist (Name & Surname):',
							'description' => '',
						],
					],
					'receptionist_contact_email' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Receptionist Contact e-Mail:',
							'description' => '',
						],
					],
					'workshop_name' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Workshop Name:',
							'description' => '',
						],
					],
					'workshop_address' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Workshop Address:',
							'description' => '',
						],
					],
					'technician' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Technician:',
							'description' => '',
						],
					],
					'work_order_status' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Work Order Status:',
							'description' => '',
						],
					],
					'job_card_number' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Job Card Number:',
							'description' => '',
						],
					],
					'completion_date' => [
						'appgini' => "DATE NULL",
						'info' => [
							'caption' => 'Actual Completion Date:',
							'description' => '',
						],
					],
					'due_date' => [
						'appgini' => "DATE NULL",
						'info' => [
							'caption' => 'Due Date:',
							'description' => '',
						],
					],
					'filed' => [
						'appgini' => "DATETIME NULL",
						'info' => [
							'caption' => 'Filed',
							'description' => 'This field is automatically populated with the date and time when this record was created.',
						],
					],
					'last_modified' => [
						'appgini' => "DATETIME NULL",
						'info' => [
							'caption' => 'Last modified',
							'description' => 'This field is automatically populated with the date and time when this record was last modified.',
						],
					],
				],
				'service_type' => [
					'service_type_id' => [
						'appgini' => "INT NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Service Type ID:',
							'description' => '',
						],
					],
					'service' => [
						'appgini' => "VARCHAR(200) NULL",
						'info' => [
							'caption' => 'Service:',
							'description' => '',
						],
					],
					'type_of_service' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Type of Service:',
							'description' => '',
						],
					],
					'reference' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Reference:',
							'description' => '',
						],
					],
					'service_item_type' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Service Item Type:',
							'description' => '',
						],
					],
					'service_category' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Service Category:',
							'description' => '',
						],
					],
					'service_item' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Service Item:',
							'description' => '',
						],
					],
					'frequency_time_number' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Frequency Time Number:',
							'description' => '',
						],
					],
					'frequency_time' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Frequency Time Cycle:',
							'description' => '',
						],
					],
					'frequency_odometer' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Frequency Odometer (km):',
							'description' => '',
						],
					],
				],
				'schedule' => [
					'schedule_id' => [
						'appgini' => "INT NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Schedule ID:',
							'description' => '',
						],
					],
					'title' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Appointment Type:',
							'description' => '',
						],
					],
					'user_name_and_surname' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Owner of Vehicle Name & Surname:',
							'description' => '',
						],
					],
					'user_contact_email' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'User contact email',
							'description' => '',
						],
					],
					'service_item_type' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Service Item Type:',
							'description' => '',
						],
					],
					'service_item_type_code' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Service Item Type Code:',
							'description' => '',
						],
					],
					'application_status' => [
						'appgini' => "VARCHAR(40) NOT NULL",
						'info' => [
							'caption' => 'Application Status:',
							'description' => '',
						],
					],
					'vehicle_registration_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Vehicle Registration Number:',
							'description' => '',
						],
					],
					'engine_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Engine Number:',
							'description' => '',
						],
					],
					'closing_km' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Odometer Reading (km):',
							'description' => '',
						],
					],
					'date' => [
						'appgini' => "DATE NULL",
						'info' => [
							'caption' => 'Date:',
							'description' => '',
						],
					],
					'time' => [
						'appgini' => "TIME NULL DEFAULT '12:00:00'",
						'info' => [
							'caption' => 'Time:',
							'description' => '',
						],
					],
					'workshop_name' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Workshop Name:',
							'description' => '',
						],
					],
					'diagnosis' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Diagnosis:',
							'description' => '',
						],
					],
					'prescription' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Solution:',
							'description' => '',
						],
					],
					'comments' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Comments:',
							'description' => '',
						],
					],
				],
				'service_records' => [
					'records_id' => [
						'appgini' => "INT NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Records ID:',
							'description' => '',
						],
					],
					'vehicle' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Vehicle & Engine Number:',
							'description' => '',
						],
					],
					'image_1' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Image 1',
							'description' => 'Maximum file size allowed: 1000 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'image_2' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Image 2',
							'description' => 'Maximum file size allowed: 1000 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'image_3' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Image 3',
							'description' => 'Maximum file size allowed: 1000 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'image_4' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Image 4',
							'description' => 'Maximum file size allowed: 1000 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'image_5' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Image 5',
							'description' => 'Maximum file size allowed: 1000 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'document_1' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Document 1:',
							'description' => 'Maximum file size allowed: 5000 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'document_2' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Document 2:',
							'description' => 'Maximum file size allowed: 5000 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'document_3' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Document 3:',
							'description' => 'Maximum file size allowed: 5000 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'document_4' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Document 4:',
							'description' => 'Maximum file size allowed: 5000 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'document_5' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Document 5:',
							'description' => 'Maximum file size allowed: 5000 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'description' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Description:',
							'description' => '',
						],
					],
				],
				'service_categories' => [
					'service_categories_id' => [
						'appgini' => "INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Service Categories ID:',
							'description' => '',
						],
					],
					'service_category' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Service Category:',
							'description' => '',
						],
					],
				],
				'service_item_type' => [
					'service_item_type_id' => [
						'appgini' => "INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Service Item Type ID:',
							'description' => '',
						],
					],
					'service_item_type' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Service Item Type:',
							'description' => '',
						],
					],
					'service_item_type_code' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Service Item Type Code:',
							'description' => '',
						],
					],
				],
				'service_item' => [
					'service_item_id' => [
						'appgini' => "INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Service Item ID:',
							'description' => '',
						],
					],
					'service_item' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Service Item:',
							'description' => '',
						],
					],
				],
				'purchase_orders' => [
					'purchase_order_id' => [
						'appgini' => "INT NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Purchase Order ID:',
							'description' => '',
						],
					],
					'purchased_order_number' => [
						'appgini' => "VARCHAR(40) NOT NULL",
						'info' => [
							'caption' => 'Purchased Order Number:',
							'description' => '',
						],
					],
					'purchased_date' => [
						'appgini' => "DATE NULL",
						'info' => [
							'caption' => 'Purchased Date:',
							'description' => '',
						],
					],
					'purchaser' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Purchaser:',
							'description' => '',
						],
					],
					'vehicle_registration_number' => [
						'appgini' => "INT(6) NULL",
						'info' => [
							'caption' => 'Registration Number:',
							'description' => '',
						],
					],
					'type_of_vehicle' => [
						'appgini' => "INT(6) NULL",
						'info' => [
							'caption' => 'Type of Vehicle:',
							'description' => '',
						],
					],
					'manufacturer' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Manufacturer:',
							'description' => '',
						],
					],
					'service_type' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Service Type:',
							'description' => '',
						],
					],
					'service_category' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Service Category:',
							'description' => '',
						],
					],
					'service_item' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Service Item:',
							'description' => '',
						],
					],
					'upload_quotation' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Documents (Upload Quotation):',
							'description' => 'Maximum file size allowed: 5120 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'due_date' => [
						'appgini' => "DATE NULL",
						'info' => [
							'caption' => 'Due Date:',
							'description' => '',
						],
					],
					'merchant_name' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Merchant Name:',
							'description' => '',
						],
					],
					'date_of_service' => [
						'appgini' => "DATE NULL",
						'info' => [
							'caption' => 'Date of Service:',
							'description' => '',
						],
					],
					'closing_km' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Odometer Reading (km):',
							'description' => '',
						],
					],
					'labour_category_1' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Labour Category:',
							'description' => '',
						],
					],
					'part_number_1' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Part Number (1):',
							'description' => '',
						],
					],
					'part_name_1' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Part Name (1):',
							'description' => '',
						],
					],
					'part_manufacturer_name_1' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Part Manufacturer Name (1):',
							'description' => '',
						],
					],
					'quantity_1' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Quantity',
							'description' => '',
						],
					],
					'expense_of_item_1' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Expense Of Item 1 (R):',
							'description' => '',
						],
					],
					'labour_category_2' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Labour Category:',
							'description' => '',
						],
					],
					'part_number_2' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Part Number (2):',
							'description' => '',
						],
					],
					'part_name_2' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Part Name (2):',
							'description' => '',
						],
					],
					'part_manufacturer_name_2' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Part Manufacturer Name (2):',
							'description' => '',
						],
					],
					'quantity_2' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Quantity',
							'description' => '',
						],
					],
					'expense_of_item_2' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Expense Of Item 2 (R):',
							'description' => '',
						],
					],
					'labour_category_3' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Labour Category:',
							'description' => '',
						],
					],
					'part_number_3' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Part Number (3):',
							'description' => '',
						],
					],
					'part_name_3' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Part Name (3):',
							'description' => '',
						],
					],
					'part_manufacturer_name_3' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Part Manufacturer Name (3):',
							'description' => '',
						],
					],
					'quantity_3' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Quantity',
							'description' => '',
						],
					],
					'expense_of_item_3' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Expense Of Item 3 (R):',
							'description' => '',
						],
					],
					'labour_category_4' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Labour Category:',
							'description' => '',
						],
					],
					'part_number_4' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Part Number (4):',
							'description' => '',
						],
					],
					'part_name_4' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Part Name (4):',
							'description' => '',
						],
					],
					'part_manufacturer_name_4' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Part Manufacturer Name  (4):',
							'description' => '',
						],
					],
					'quantity_4' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Quantity',
							'description' => '',
						],
					],
					'expense_of_item_4' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Expense Of Item 4 (R):',
							'description' => '',
						],
					],
					'labour_category_5' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Labour Category:',
							'description' => '',
						],
					],
					'part_number_5' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Part Number (5):',
							'description' => '',
						],
					],
					'part_name_5' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Part Name (5):',
							'description' => '',
						],
					],
					'part_manufacturer_name_5' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Part Manufacturer Name (5):',
							'description' => '',
						],
					],
					'quantity_5' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Quantity',
							'description' => '',
						],
					],
					'expense_of_item_5' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Expense Of Item 5 (R):',
							'description' => '',
						],
					],
					'labour_category_6' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Labour Category:',
							'description' => '',
						],
					],
					'part_number_6' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Part Number (6):',
							'description' => '',
						],
					],
					'part_name_6' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Part Name (6):',
							'description' => '',
						],
					],
					'part_manufacturer_name_6' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Part Manufacturer Name (6):',
							'description' => '',
						],
					],
					'quantity_6' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Quantity',
							'description' => '',
						],
					],
					'expense_of_item_6' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Expense Of Item 6 (R):',
							'description' => '',
						],
					],
					'labour_category_7' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Labour Category:',
							'description' => '',
						],
					],
					'part_number_7' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Part Number (7):',
							'description' => '',
						],
					],
					'part_name_7' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Part Name (7):',
							'description' => '',
						],
					],
					'part_manufacturer_name_7' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Part Manufacturer Name (7):',
							'description' => '',
						],
					],
					'quantity_7' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Quantity',
							'description' => '',
						],
					],
					'expense_of_item_7' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Expense Of Item 7 (R):',
							'description' => '',
						],
					],
					'labour_category_8' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Labour Category:',
							'description' => '',
						],
					],
					'part_number_8' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Part Number (8):',
							'description' => '',
						],
					],
					'part_name_8' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Part Name (8):',
							'description' => '',
						],
					],
					'part_manufacturer_name_8' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Part Manufacturer Name (8):',
							'description' => '',
						],
					],
					'expense_of_item_8' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Expense Of Item 8 (R):',
							'description' => '',
						],
					],
					'material_cost' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Material Cost (R);',
							'description' => '',
						],
					],
					'average_worktime_hrs' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Average Worktime Hrs:',
							'description' => '',
						],
					],
					'standard_labour_cost_per_hour' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Standard Labour Cost per Hour:',
							'description' => '',
						],
					],
					'labour_charges' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Labour Charges (R):',
							'description' => '',
						],
					],
					'vat' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Vat 15 % (R):',
							'description' => '',
						],
					],
					'total_amount' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Total Amount (R):',
							'description' => '',
						],
					],
					'workshop_name' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Workshop Name:',
							'description' => '',
						],
					],
					'work_order_id' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Work Order ID:',
							'description' => '',
						],
					],
					'job_card_number' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Job Card Number:',
							'description' => '',
						],
					],
					'completion_date' => [
						'appgini' => "DATE NULL",
						'info' => [
							'caption' => 'Actual Completion Date:',
							'description' => '',
						],
					],
					'comments' => [
						'appgini' => "LONGTEXT NULL",
						'info' => [
							'caption' => 'Comments:',
							'description' => '',
						],
					],
					'upload_invoice' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Documents (Upload Invoice):',
							'description' => 'Maximum file size allowed: 5120 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'date_captured' => [
						'appgini' => "DATE NULL",
						'info' => [
							'caption' => 'Date Captured:',
							'description' => '',
						],
					],
					'data_capturer' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Information Capture By  (Name & Surname):',
							'description' => '',
						],
					],
					'data_capturer_contact_email' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Data Capturer Contact e-Mail:',
							'description' => '',
						],
					],
				],
				'transmission' => [
					'transmission_id' => [
						'appgini' => "INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Transmission ID:',
							'description' => '',
						],
					],
					'transmission' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Transmission:',
							'description' => '',
						],
					],
				],
				'fuel_type' => [
					'fuel_type_id' => [
						'appgini' => "INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Fuel Type ID:',
							'description' => '',
						],
					],
					'fuel_type' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Fuel Type:',
							'description' => '',
						],
					],
				],
				'merchant' => [
					'merchant_id' => [
						'appgini' => "INT NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Vendor ID:',
							'description' => '',
						],
					],
					'merchant_type' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Merchant Type:',
							'description' => '',
						],
					],
					'merchant_code' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Merchant code',
							'description' => '',
						],
					],
					'merchant_name' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Merchant  Name:',
							'description' => '',
						],
					],
					'merchant_contact_email' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Merchant Contact e-Mail:',
							'description' => '',
						],
					],
					'merchant_street_address' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Merchant Street Address:',
							'description' => '',
						],
					],
					'merchant_suburb' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Merchant Suburb:',
							'description' => '',
						],
					],
					'merchant_city' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Merchant City:',
							'description' => '',
						],
					],
					'merchant_address_code' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Merchant Address Code:',
							'description' => '',
						],
					],
					'merchant_contact_details' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Merchant Phone:',
							'description' => '',
						],
					],
				],
				'merchant_type' => [
					'merchant_type_id' => [
						'appgini' => "INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Merchant Type ID:',
							'description' => '',
						],
					],
					'merchant_type' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Merchant Type:',
							'description' => '',
						],
					],
				],
				'manufacturer' => [
					'manufacturer_id' => [
						'appgini' => "INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Manufacturer ID:',
							'description' => '',
						],
					],
					'manufacturer_type' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Manufacturer Type:',
							'description' => '',
						],
					],
					'manufacturer_name' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Manufacturer Name:',
							'description' => '',
						],
					],
					'contact_person' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Contact Person:',
							'description' => '',
						],
					],
					'contact_details' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Contact Details:',
							'description' => '',
						],
					],
					'contact_email' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Contact e-Mail:',
							'description' => '',
						],
					],
				],
				'manufacturer_type' => [
					'manufacturer_type_id' => [
						'appgini' => "INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Manufacturer Type ID:',
							'description' => '',
						],
					],
					'manufacturer_type' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Manufacturer Type:',
							'description' => '',
						],
					],
				],
				'driver' => [
					'driver_id' => [
						'appgini' => "INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Driver ID:',
							'description' => '',
						],
					],
					'drivers_name_and_surname' => [
						'appgini' => "VARCHAR(40) NOT NULL",
						'info' => [
							'caption' => 'Driver\'s  Name & Surname:',
							'description' => '',
						],
					],
					'drivers_persal_number' => [
						'appgini' => "VARCHAR(40) NOT NULL",
						'info' => [
							'caption' => 'Driver\'s Persal Number:',
							'description' => '',
						],
					],
					'drivers_contact_details' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Driver\'s Contact Details:',
							'description' => '',
						],
					],
					'drivers_email_address' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Drivers Email Address:',
							'description' => '',
						],
					],
					'drivers_license' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Driver\'s License:',
							'description' => '',
						],
					],
					'drivers_license_code' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Driver\'s License Code:',
							'description' => '',
						],
					],
					'drivers_license_number' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Driver\'s License Number:',
							'description' => '',
						],
					],
					'drivers_license_upload' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Driver\'s License Upload:',
							'description' => 'Maximum file size allowed: 5120 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'drivers_license_expire_date' => [
						'appgini' => "DATE NULL",
						'info' => [
							'caption' => 'Drivers License Expire Date:',
							'description' => '',
						],
					],
					'drivers_license_renewal_date' => [
						'appgini' => "DATE NULL",
						'info' => [
							'caption' => 'Drivers License Renewal Date:',
							'description' => '',
						],
					],
					'drivers_log_history' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Drivers Log History:',
							'description' => '',
						],
					],
					'drivers_license_penalties' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Driver\'s License Penalties:',
							'description' => '',
						],
					],
					'drivers_license_penalties_date' => [
						'appgini' => "DATE NULL",
						'info' => [
							'caption' => 'Driver\'s License Penalty Date:',
							'description' => '',
						],
					],
					'drivers_license_penalty_details' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Driver\'s License Penalty Details:',
							'description' => '',
						],
					],
					'drivers_license_penalty_details_uploads' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Driver\'s License Penalty Detail Uploads:',
							'description' => 'Maximum file size allowed: 5120 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'involved_in_accident' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Involved in Accident?:',
							'description' => '',
						],
					],
					'accident_report' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Accident Report:',
							'description' => 'Maximum file size allowed: 5120 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
				],
				'accidents' => [
					'accident_id' => [
						'appgini' => "INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Accident ID:',
							'description' => '',
						],
					],
					'vehicle_registration_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Registration Number:',
							'description' => '',
						],
					],
					'closing_km' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Closing KM:',
							'description' => '',
						],
					],
					'drivers_surname' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Driver\'s Surname:',
							'description' => '',
						],
					],
					'drivers_contact_details' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Driver\'s Contact Details:',
							'description' => '',
						],
					],
					'dealer_name' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Make of Vehicle/Dealer Name:',
							'description' => '',
						],
					],
					'model_of_vehicle' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Model of Vehicle:',
							'description' => '',
						],
					],
					'date_of_accident' => [
						'appgini' => "DATE NULL",
						'info' => [
							'caption' => 'Date of Accident:',
							'description' => '',
						],
					],
					'z181_accident_form' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Z181 Accident Form:',
							'description' => '',
						],
					],
					'z181_accident_form_uploaded' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Z181 Accident Form Uploaded:',
							'description' => 'Maximum file size allowed: 5240 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'copy_of_trip_authority' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Copy of Trip Authority:',
							'description' => 'Maximum file size allowed: 5240 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'district' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'District:',
							'description' => 'Capture the district and stations detail',
						],
					],
					'location' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Station:',
							'description' => '',
						],
					],
					'road_or_street' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Road or Street Name:',
							'description' => '',
						],
					],
					'coordinates' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Coordinates:',
							'description' => '',
						],
					],
					'deaths' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Deaths:',
							'description' => '',
						],
					],
					'fatal_amount' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Fatal Amount:',
							'description' => '',
						],
					],
					'injured' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Injured:',
							'description' => '',
						],
					],
					'injured_amount' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Injured Amount:',
							'description' => '',
						],
					],
					'description_of_accident' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Description of Accident:',
							'description' => '',
						],
					],
					'insured' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Insured ?:',
							'description' => '',
						],
					],
					'upload_photos_damaged_vehicle' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Upload Photos of Damaged Vehicle:',
							'description' => 'Maximum file size allowed: 7868 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'copy_of_sketch_plan' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Copy of Sketch Plan:',
							'description' => 'Maximum file size allowed: 7868 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'accident_report_driver' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Driver Accident Report/Statement:',
							'description' => 'Maximum file size allowed: 7868 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'accident_report_supervisior' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Supervisor Accident Report/Statement:',
							'description' => 'Maximum file size allowed: 7868 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'claims_report_accident_committee' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Claims Report by Accident Committee:',
							'description' => 'Maximum file size allowed: 7868 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'insurance_claims_report' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Insurance Claims Report:',
							'description' => 'Maximum file size allowed: 7868 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'amount_paid' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Amount Paid:',
							'description' => '',
						],
					],
					'police_officer' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Police Officer:',
							'description' => '',
						],
					],
					'contact_details' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Contact Details:',
							'description' => '',
						],
					],
					'case_number' => [
						'appgini' => "VARCHAR(40) NULL DEFAULT 'CAS_'",
						'info' => [
							'caption' => 'Case Number:',
							'description' => '',
						],
					],
					'police_report' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Police Report:',
							'description' => 'Maximum file size allowed: 7868 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'accident_report_number' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Accident Report Number:',
							'description' => '',
						],
					],
				],
				'accident_type' => [
					'accident_type_id' => [
						'appgini' => "INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Accident Type ID:',
							'description' => '',
						],
					],
					'accident_type' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Accident Type:',
							'description' => '',
						],
					],
				],
				'claim' => [
					'claim_id' => [
						'appgini' => "INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Claim ID:',
							'description' => '',
						],
					],
					'claim_code' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Claims Code:',
							'description' => '',
						],
					],
					'claim_status' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Claim Status:',
							'description' => '',
						],
					],
					'claim_category' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Claim Category:',
							'description' => '',
						],
					],
					'cost_centre' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Cost Centre',
							'description' => '',
						],
					],
					'client_identification' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Client Identification:',
							'description' => '',
						],
					],
					'department_name' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Department Name:',
							'description' => '',
						],
					],
					'district' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'District:',
							'description' => '',
						],
					],
					'province' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Province Name:',
							'description' => '',
						],
					],
					'merchant_name' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Merchant Name:',
							'description' => '',
						],
					],
					'vehicle_registration_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Vehicle Registration Number:',
							'description' => '',
						],
					],
					'model' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Model:',
							'description' => '',
						],
					],
					'closing_km' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Closing km:',
							'description' => '',
						],
					],
					'pre_authorization_date' => [
						'appgini' => "DATE NULL DEFAULT '0000-00-00'",
						'info' => [
							'caption' => 'Pre Authorization Date:',
							'description' => '',
						],
					],
					'instruction_note' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Instruction Note:',
							'description' => '',
						],
					],
					'invoice_date' => [
						'appgini' => "DATE NULL DEFAULT '0000-00-00'",
						'info' => [
							'caption' => 'Invoice Date:',
							'description' => '',
						],
					],
					'upload_invoice' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Documents (Upload Invoice):',
							'description' => 'Maximum file size allowed: 5120 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'payment_date' => [
						'appgini' => "DATE NULL DEFAULT '0000-00-00'",
						'info' => [
							'caption' => 'Payment Date:',
							'description' => '',
						],
					],
					'authorization_number' => [
						'appgini' => "VARCHAR(40) NOT NULL",
						'info' => [
							'caption' => 'Authorization Number:',
							'description' => '',
						],
					],
					'clearance_number' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Clearance Number:',
							'description' => '',
						],
					],
					'vehicle_collected_date' => [
						'appgini' => "DATE NULL DEFAULT '0000-00-00'",
						'info' => [
							'caption' => 'Vehicle Collected Date:',
							'description' => '',
						],
					],
					'total_claimed' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Total Claimed (R):',
							'description' => '',
						],
					],
					'total_authorized' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Total Authorized (R):',
							'description' => '',
						],
					],
				],
				'claim_status' => [
					'claim_status_id' => [
						'appgini' => "INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Claims Status ID:',
							'description' => '',
						],
					],
					'claim_status' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Claims Status:',
							'description' => '',
						],
					],
				],
				'claim_category' => [
					'claim_category_id' => [
						'appgini' => "INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Claims Category ID:',
							'description' => '',
						],
					],
					'claim_category' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Claims Category:',
							'description' => '',
						],
					],
				],
				'cost_centre' => [
					'cost_centre_id' => [
						'appgini' => "INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Cost Centre ID:',
							'description' => '',
						],
					],
					'cost_centre' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Cost Centre:',
							'description' => '',
						],
					],
				],
				'dealer' => [
					'dealer_id' => [
						'appgini' => "INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Dealer ID:',
							'description' => '',
						],
					],
					'dealer_type' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Dealer Type:',
							'description' => '',
						],
					],
					'make_of_vehicle' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Make of Vehicle:',
							'description' => '',
						],
					],
					'dealer_name' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Dealer Name:',
							'description' => '',
						],
					],
					'contact_person' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Contact Person:',
							'description' => '',
						],
					],
					'contact_details' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Contact Details:',
							'description' => '',
						],
					],
					'contact_email' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Contact E-Mail:',
							'description' => '',
						],
					],
				],
				'dealer_type' => [
					'dealer_type_id' => [
						'appgini' => "INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Dealer Type ID:',
							'description' => '',
						],
					],
					'dealer_type' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Dealer Type:',
							'description' => '',
						],
					],
				],
				'tyre_log_sheet' => [
					'tyre_log_id' => [
						'appgini' => "INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Tyre Log ID:',
							'description' => '',
						],
					],
					'vehicle_registration_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Registration Number:',
							'description' => '',
						],
					],
					'tyre_position' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tyre Position:',
							'description' => '',
						],
					],
					'tyre_tread_condition' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tyre Tread Condition:',
							'description' => '',
						],
					],
					'tyre_brand' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tyre Brand:',
							'description' => '',
						],
					],
					'tyre_model' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tyre Model:',
							'description' => '',
						],
					],
					'tyre_size' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tyre Size (Radial):',
							'description' => '',
						],
					],
					'tyre_pressure' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tyre Pressure (Kpa):',
							'description' => '',
						],
					],
					'action' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Action:',
							'description' => '',
						],
					],
					'warranty' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Warranty:',
							'description' => '',
						],
					],
					'documents' => [
						'appgini' => "VARCHAR(225) NULL",
						'info' => [
							'caption' => 'Document:',
							'description' => 'Maximum file size allowed: 5120 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'tyre_tread' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tyre Tread (mm):',
							'description' => '',
						],
					],
					'tyre_maximum_wear' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tyre Maximum Wear:',
							'description' => '',
						],
					],
					'inspection_date' => [
						'appgini' => "DATE NULL DEFAULT '0000-00-00'",
						'info' => [
							'caption' => 'Inspection Date:',
							'description' => '',
						],
					],
					'tyre_inspection_done_by' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tyre Inspection Done By:',
							'description' => '',
						],
					],
					'tyre_inspection_report' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tyre Inspection Report:',
							'description' => 'Maximum file size allowed: 5120 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'status' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Status',
							'description' => '',
						],
					],
					'opening_km' => [
						'appgini' => "VARCHAR(15) NULL",
						'info' => [
							'caption' => 'Opening KM:',
							'description' => '',
						],
					],
					'closing_km' => [
						'appgini' => "VARCHAR(15) NULL",
						'info' => [
							'caption' => 'Closing KM:',
							'description' => '',
						],
					],
					'total_km' => [
						'appgini' => "VARCHAR(15) NULL",
						'info' => [
							'caption' => 'Trip Distance (Total KM Covered with Tyre):',
							'description' => '',
						],
					],
					'comments' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Comments:',
							'description' => '',
						],
					],
					'tyres_cause_of_accident' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tyres Cause Of Accident:',
							'description' => '',
						],
					],
					'accident_report' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Accident Report:',
							'description' => 'Maximum file size allowed: 5120 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'claims_report' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Claims Report:',
							'description' => 'Maximum file size allowed: 5120 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'insurance_claims_report' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Insurance Claims Report:',
							'description' => 'Maximum file size allowed: 5120 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'reminder_maximum_wear' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Reminder if Maximum Wear is reached?:',
							'description' => '',
						],
					],
				],
				'vehicle_daily_check_list' => [
					'vehicle_daily_check_list_id' => [
						'appgini' => "INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Daily Checked ID:',
							'description' => '',
						],
					],
					'inspection_certification_number' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Inspection Certification No:',
							'description' => '',
						],
					],
					'vehicle_registration_number' => [
						'appgini' => "INT(6) NULL",
						'info' => [
							'caption' => 'Registration Number:',
							'description' => '',
						],
					],
					'make_of_vehicle' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Make of Vehicle:',
							'description' => '',
						],
					],
					'closing_km' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Odometer Reading KM:',
							'description' => '',
						],
					],
					'dashboard' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Dashboard:',
							'description' => '',
						],
					],
					'seats' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Seats:',
							'description' => '',
						],
					],
					'carpets' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Carpets:',
							'description' => '',
						],
					],
					'wipers' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Wipers:',
							'description' => '',
						],
					],
					'head_lights' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Head Lights:',
							'description' => '',
						],
					],
					'tail_lights' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tail lights:',
							'description' => '',
						],
					],
					'brake_lights' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Brake Lights:',
							'description' => '',
						],
					],
					'indicators' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Indicators:',
							'description' => '',
						],
					],
					'windscreen' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Windscreen:',
							'description' => '',
						],
					],
					'windows' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Windows:',
							'description' => '',
						],
					],
					'mirrors' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Mirrors:',
							'description' => '',
						],
					],
					'wheels' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Wheels:',
							'description' => '',
						],
					],
					'hubcaps' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Hubcaps:',
							'description' => '',
						],
					],
					'sparewheel' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Sparewheel:',
							'description' => '',
						],
					],
					'tools' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tools:',
							'description' => '',
						],
					],
					'engine_oil' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Engine Oil:',
							'description' => '',
						],
					],
					'power_steering_oil' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Power Wheel Steering Oil:',
							'description' => '',
						],
					],
					'gearbox_oil' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Gearbox Oil:',
							'description' => '',
						],
					],
					'coolant' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Coolant Level:',
							'description' => '',
						],
					],
					'brake_oil' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Brake oil',
							'description' => '',
						],
					],
					'battery' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Battery:',
							'description' => '',
						],
					],
					'brakes_front' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Brakes Front:',
							'description' => '',
						],
					],
					'brakes_rear' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Brakes Rear:',
							'description' => '',
						],
					],
					'fuel_level' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Fuel Level:',
							'description' => '',
						],
					],
					'vehicle_fluid_leaks' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Vehicle Fluid Leaks',
							'description' => '',
						],
					],
					'note' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Note:',
							'description' => '',
						],
					],
					'document_checklist_report' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Document Check List Report:',
							'description' => 'Maximum file size allowed: 5120 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'next_inspection_date' => [
						'appgini' => "DATE NULL",
						'info' => [
							'caption' => 'Next Inspection Date:',
							'description' => '',
						],
					],
					'drivers_surname' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Driver\'s Surname:',
							'description' => '',
						],
					],
					'drivers_persal_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Driver\'s Persal Number:',
							'description' => '',
						],
					],
				],
				'auditor' => [
					'auditor_id' => [
						'appgini' => "INT(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Auditor_id',
							'description' => '',
						],
					],
					'res_id' => [
						'appgini' => "INT(5) UNSIGNED NULL",
						'info' => [
							'caption' => 'Res ID:',
							'description' => '',
						],
					],
					'username' => [
						'appgini' => "VARCHAR(50) NULL",
						'info' => [
							'caption' => 'Username:',
							'description' => '',
						],
					],
					'ipaddr' => [
						'appgini' => "VARCHAR(25) NULL",
						'info' => [
							'caption' => 'IP Address:',
							'description' => '',
						],
					],
					'time_stmp' => [
						'appgini' => "TIMESTAMP NULL",
						'info' => [
							'caption' => 'Time Stamp:',
							'description' => '',
						],
					],
					'change_type' => [
						'appgini' => "VARCHAR(10) NULL",
						'info' => [
							'caption' => 'Change Type:',
							'description' => '',
						],
					],
					'table_name' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Table Name:',
							'description' => '',
						],
					],
					'fieldName' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Field Name:',
							'description' => '',
						],
					],
					'OldValue' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Old Value:',
							'description' => '',
						],
					],
					'NewValue' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'New Value:',
							'description' => '',
						],
					],
				],
				'parts' => [
					'parts_id' => [
						'appgini' => "INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Parts ID:',
							'description' => '',
						],
					],
					'part_type' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Part Type:',
							'description' => '',
						],
					],
					'part_number' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Part Number:',
							'description' => '',
						],
					],
					'part_name' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Part Name:',
							'description' => '',
						],
					],
					'description' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Description:',
							'description' => '',
						],
					],
					'manufacturer' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Manufacturer:',
							'description' => '',
						],
					],
					'dealer' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Dealer:',
							'description' => '',
						],
					],
					'measure' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Measure',
							'description' => '',
						],
					],
					'unit_price' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Unit Price:',
							'description' => '',
						],
					],
					'quantity' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Quantity:',
							'description' => '',
						],
					],
					'freight' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Freight Cost (R):',
							'description' => '',
						],
					],
					'amount' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Total Repairing Amount (R):',
							'description' => '',
						],
					],
					'tax' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tax:',
							'description' => '',
						],
					],
					'total_amount' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Total Repairing Amount (R):',
							'description' => '',
						],
					],
					'discount_price' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Discount price',
							'description' => '',
						],
					],
					'net_part_price' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Net Part Price (R):',
							'description' => 'A final price after deducting all discounts and rebates.',
						],
					],
				],
				'parts_type' => [
					'part_type_id' => [
						'appgini' => "INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Part Type ID:',
							'description' => '',
						],
					],
					'part_type' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Part Type:',
							'description' => '',
						],
					],
				],
				'breakdown_services' => [
					'breakdown_id' => [
						'appgini' => "INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Breakdown ID:',
							'description' => '',
						],
					],
					'breakdown_of_vehicle' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Breakdown of Vehicle?:',
							'description' => '',
						],
					],
					'breakdown_during_office_hours' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Breakdown During Office Hours:',
							'description' => 'The user report to their Transport Officer/Controller.
<br>The Transport Officer report to the nearest Government garage.
<br>Government garage arrange the suitable means for recovery based on the short description of defect given by the user.',
						],
					],
					'breakdown_within_or_outside_the_province' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Breakdown Within or Outside The Province:',
							'description' => 'The user report to the nearest government garage.<br>The government garage arrange the most suitable means for recovery.<br>The vehicle is recovered to the nearest government garage.',
						],
					],
					'description_of_vehicle_breakdown_notes' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Description of Vehicle Breakdown (Notes):',
							'description' => 'Note a short description as per Reporting Officer.',
						],
					],
					'description_of_vehicle_breakdown' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Description of vehicle breakdown',
							'description' => 'Maximum file size allowed: 5250 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'date_of_vehicle_breakdown' => [
						'appgini' => "DATE NULL",
						'info' => [
							'caption' => 'Date of Vehicle Breakdown:',
							'description' => '',
						],
					],
					'work_allocation_reference_number' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Work Allocation Reference Number:',
							'description' => '',
						],
					],
					'job_card_number' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Job Card Number:',
							'description' => '',
						],
					],
					'vehicle_registration_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Registration Number:',
							'description' => '',
						],
					],
					'engine_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Engine Number:',
							'description' => '',
						],
					],
					'closing_km' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Closing KM:',
							'description' => '',
						],
					],
					'date_of_vehicle_reactivation' => [
						'appgini' => "DATE NULL",
						'info' => [
							'caption' => 'Date of Vehicle Re-activation:',
							'description' => '',
						],
					],
					'type_of_expenditure' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Type of Expenditure:',
							'description' => '',
						],
					],
					'labour_category' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Labour Category (1) :',
							'description' => '',
						],
					],
					'part_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Part Number (1):',
							'description' => '',
						],
					],
					'part_name' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Part Name (1):',
							'description' => '',
						],
					],
					'part_manufacturer_name' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Part Manufacturer Name (1):',
							'description' => '',
						],
					],
					'quantity' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Quantity (1):',
							'description' => '',
						],
					],
					'expense_of_item' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Expense Of Item 1 (R):',
							'description' => '',
						],
					],
					'labour_category_1' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Labour Category (2):',
							'description' => '',
						],
					],
					'part_number_1' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Part Number (2):',
							'description' => '',
						],
					],
					'part_name_1' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Part Name (2):',
							'description' => '',
						],
					],
					'part_manufacturer_name_1' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Part Manufacturer Name (2):',
							'description' => '',
						],
					],
					'quantity_1' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Quantity (2):',
							'description' => '',
						],
					],
					'expense_of_item_1' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Expense Of Item 2 (R):',
							'description' => '',
						],
					],
					'material_cost' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Material Cost (R):',
							'description' => '',
						],
					],
					'average_worktime_hrs' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Average Worktime Hrs:',
							'description' => '',
						],
					],
					'standard_labour_cost_per_hour' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Standard Labour Cost per Hour:',
							'description' => '',
						],
					],
					'labour_charges' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Labour Charges (R):',
							'description' => '',
						],
					],
					'vat' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Vat 15 % (R):',
							'description' => '',
						],
					],
					'total_amount' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Total Amount (R):',
							'description' => '',
						],
					],
					'workshop_name' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Workshop Name:',
							'description' => '',
						],
					],
					'work_order_status' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Work Order Status:',
							'description' => '',
						],
					],
					'comments' => [
						'appgini' => "LONGTEXT NULL",
						'info' => [
							'caption' => 'Comments:',
							'description' => '',
						],
					],
					'upload_invoice' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Documents (Upload Invoice):',
							'description' => 'Maximum file size allowed: 5120 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'receptionist' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Receptionist Name & Surname:',
							'description' => '',
						],
					],
					'receptionist_contact_email' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Receptionist Contact e-Mail:',
							'description' => '',
						],
					],
					'date_captured' => [
						'appgini' => "DATETIME NULL",
						'info' => [
							'caption' => 'Date Captured:',
							'description' => '',
						],
					],
				],
				'modification_to_vehicle' => [
					'modification_id' => [
						'appgini' => "INT NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Modification ID:',
							'description' => '',
						],
					],
					'type_of_vehicle' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Type of Vehicle:',
							'description' => '',
						],
					],
					'directorate' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Directorate:',
							'description' => '',
						],
					],
					'head_office' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Head Office:',
							'description' => '',
						],
					],
					'district' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'District:',
							'description' => 'Capture the district and stations detail',
						],
					],
					'location' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Station:',
							'description' => '',
						],
					],
					'drivers_name_and_surname' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Driver\'s Name & Surname:',
							'description' => '',
						],
					],
					'drivers_persal_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Driver\'s Persal Number:',
							'description' => '',
						],
					],
					'drivers_contact_details' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Driver\'s Contact Details:',
							'description' => '',
						],
					],
					'driver_rank' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Driver Rank/Designation:',
							'description' => '',
						],
					],
					'driver_signature' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Driver Signature:',
							'description' => 'Maximum file size allowed: 500 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'vehicle_registration_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Registration Number:',
							'description' => '',
						],
					],
					'make_of_vehicle' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Make of Vehicle:',
							'description' => '',
						],
					],
					'model_of_vehicle' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Model of Vehicle:',
							'description' => '',
						],
					],
					'closing_km' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Closing KM:',
							'description' => '',
						],
					],
					'job_card_number' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Job Card Number:',
							'description' => '',
						],
					],
					'objective' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Objective:',
							'description' => '',
						],
					],
					'fuel_gauge_amount' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Fuel Gauge Amount:',
							'description' => '',
						],
					],
					'keys_ignition' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Keys/Ignition:',
							'description' => '',
						],
					],
					'petrol_cap_with_keys' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Petrol Cap with Keys:',
							'description' => '',
						],
					],
					'padlock_with_keys' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Padlock with Keys:',
							'description' => '',
						],
					],
					'tyre_r_f' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tyre R/F (Available):',
							'description' => '',
						],
					],
					'tyre_r_f_1' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tyre R/F (Thread Condition):',
							'description' => '',
						],
					],
					'tyre_r_r' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tyre R/R (Available):',
							'description' => '',
						],
					],
					'tyre_r_r_1' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tyre R/R (Thread Condition):',
							'description' => '',
						],
					],
					'tyre_l_f' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tyre L/F (Available):',
							'description' => '',
						],
					],
					'tyre_l_f_1' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tyre L/F (Thread Condition):',
							'description' => '',
						],
					],
					'tyer_l_r' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tyre L/R (Available):',
							'description' => '',
						],
					],
					'tyer_l_r_1' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tyre L/R (Thread Condition):',
							'description' => '',
						],
					],
					'tyre_spare' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tyre Spare (Available):',
							'description' => '',
						],
					],
					'tyre_spare_1' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tyre Spare (Thread Condition):',
							'description' => '',
						],
					],
					'wheel_cups' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Wheel Hub Cups (Available):',
							'description' => '',
						],
					],
					'other' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Other (specify):',
							'description' => '',
						],
					],
					'battery' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Battery (Make):',
							'description' => '',
						],
					],
					'battery_voltage' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Battery (Voltage):',
							'description' => '',
						],
					],
					'wheel_spanner' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Wheel Spanner:',
							'description' => '',
						],
					],
					'jack_with_handle' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Jack with Handle:',
							'description' => '',
						],
					],
					'radio_dvd_combination' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Radio/DVD Combination:',
							'description' => '',
						],
					],
					'petrol_card' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Petrol Card:',
							'description' => '',
						],
					],
					'valid_license_disc' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Valid License Disc:',
							'description' => '',
						],
					],
					'valid_license_disc_date' => [
						'appgini' => "DATE NULL",
						'info' => [
							'caption' => 'Valid License Disc (Expire date):',
							'description' => '',
						],
					],
					'fire_extinguisher' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Fire Extinguisher:',
							'description' => '',
						],
					],
					'warning_signs_traingle' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Warning Signs & Traingle:',
							'description' => '',
						],
					],
					'date_checked_in' => [
						'appgini' => "DATETIME NULL DEFAULT '2020-01-01 00:00:00'",
						'info' => [
							'caption' => 'Declaration Date & Time:',
							'description' => 'Time when driver checked in at the Government Garage with vehicle for modification, repairs or service.',
						],
					],
					'testing_officer_name_and_surname' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Testing Officer/Tradesman Aid Details:',
							'description' => 'Testing Officer/Tradesman Aid declaration that all of above is correctly received when checking in.',
						],
					],
					'testing_officer_persal_number' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Testing Officer/Tradesman Aid Persal Number:',
							'description' => '',
						],
					],
					'testing_officer_rank' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Testing Officer/Tradesman Aid Rank/Designation:',
							'description' => '',
						],
					],
					'testing_officer_signature' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Testing Officer/Tradesman Aid Signature:',
							'description' => 'Maximum file size allowed: 500 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'date_received' => [
						'appgini' => "DATETIME NULL DEFAULT '2020-01-01 00:00:00'",
						'info' => [
							'caption' => 'Declaration Date & Time (Vehicle Received):',
							'description' => 'Time when Testing Officer/Tradesman Aid received the vehicle in inspection bay for modification, repairs or service.',
						],
					],
					'supervisor_for_allocation_name_and_surname' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Supervisor for Allocation Details:',
							'description' => 'Supervisor for Allocation declaration that all of above is correctly received when checking back.',
						],
					],
					'supervisor_for_allocation_persal_number' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Supervisor for Allocation Persal Number:',
							'description' => '',
						],
					],
					'supervisor_for_allocation_rank' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Supervisor for Allocation Rank/Designation:',
							'description' => '',
						],
					],
					'supervisor_for_allocation_signature' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Supervisor for Allocation Signature:',
							'description' => 'Maximum file size allowed: 500 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
				],
				'vehicle_handing_over_checklist' => [
					'vehicle_handing_over_id' => [
						'appgini' => "INT NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Vehicle Handing Over  Check List ID:',
							'description' => '',
						],
					],
					'company_name' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Merchant/Agent/Panel Beater Name:',
							'description' => 'Describe the entity.',
						],
					],
					'company_address' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Merchant/Agent/Panel Beater Address:',
							'description' => '',
						],
					],
					'company_contact_details' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Merchant/Agent/Panel Beater Contact Details:',
							'description' => '',
						],
					],
					'reason_for_handling_over' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Reason for Handing Over of Departmental Vehicle:',
							'description' => '',
						],
					],
					'name_of_department' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Name of Department:',
							'description' => '',
						],
					],
					'name_of_component' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Name of Component:',
							'description' => '',
						],
					],
					'transport_officer_name_and_surname' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Transport Officer Details:',
							'description' => '',
						],
					],
					'transport_officer_email' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Transport Officer e-Mail:',
							'description' => '',
						],
					],
					'job_pre_authorization_number' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Job Pre-Authorization Number:',
							'description' => '',
						],
					],
					'vehicle_registration_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Vehicle Registration Number:',
							'description' => '',
						],
					],
					'closing_km' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Odometer Reading/Closing KM:',
							'description' => '',
						],
					],
					'make_of_vehicle' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Make of Vehicle:',
							'description' => '',
						],
					],
					'model_of_vehicle' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Model of Vehicle:',
							'description' => '',
						],
					],
					'authorization_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Authorization Number:',
							'description' => '',
						],
					],
					'authorization_date' => [
						'appgini' => "DATE NULL DEFAULT '0000-00-00'",
						'info' => [
							'caption' => 'Authorization Date:',
							'description' => '',
						],
					],
					'radio_dvd_combination' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Radio/DVD Combination:',
							'description' => '',
						],
					],
					'number_of_keys_handling_over' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Number of Keys Handling Over:',
							'description' => '',
						],
					],
					'jack_with_handle' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Jack with Handle:',
							'description' => '',
						],
					],
					'tyre_spare' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tyre Spare (Available):',
							'description' => '',
						],
					],
					'tyre_spare_condition' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tyre Spare (Thread Condition):',
							'description' => '',
						],
					],
					'wheel_spanner' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Wheel Spanner:',
							'description' => '',
						],
					],
					'wheel_cups' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Wheel Hub Cups (Available):',
							'description' => '',
						],
					],
					'tri_angles' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tri Angles Available:',
							'description' => '',
						],
					],
					'mats' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Mats:',
							'description' => '',
						],
					],
					'other' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Other (specify):',
							'description' => '',
						],
					],
					'number_of_keys' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Number of Keys Handed Over:',
							'description' => '',
						],
					],
					'tyre_r_f' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tyre R/F (Available):',
							'description' => '',
						],
					],
					'tyre_r_f_1' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tyre R/F (Thread Condition):',
							'description' => '',
						],
					],
					'tyre_r_f_1_1' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tyre R/F Brand:',
							'description' => '',
						],
					],
					'tyre_r_r' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tyre R/R (Available):',
							'description' => '',
						],
					],
					'tyre_r_r_1' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tyre R/R (Available):',
							'description' => '',
						],
					],
					'tyre_r_r_1_1' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tyre R/F Brand:',
							'description' => '',
						],
					],
					'tyre_l_f' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tyre L/F (Available):',
							'description' => '',
						],
					],
					'tyre_l_f_1' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tyre L/F (Thread Condition):',
							'description' => '',
						],
					],
					'tyre_l_f_1_1' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tyre R/F Brand:',
							'description' => '',
						],
					],
					'tyer_l_r' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tyre L/R (Available):',
							'description' => '',
						],
					],
					'tyer_l_r_1' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tyre L/R (Thread Condition):',
							'description' => '',
						],
					],
					'tyre_l_r_1_1' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tyre R/F Brand:',
							'description' => '',
						],
					],
					'driver_name_and_surname' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Driver Name:',
							'description' => 'Driver declaration that all of above is correct.',
						],
					],
					'driver_persal_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Driver Persal Number:',
							'description' => '',
						],
					],
					'driver_signature' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Driver Signature:',
							'description' => 'Maximum file size allowed: 500 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'date_checked_in' => [
						'appgini' => "DATETIME NULL DEFAULT '2020-01-01 00:00:00'",
						'info' => [
							'caption' => 'Declaration Date & Time:',
							'description' => 'Time when driver checked in at the Government Garage with vehicle for modification, repairs or service.',
						],
					],
					'testing_officer_name_and_surname' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Testing Officer/Tradesman Aid Name & Surname:',
							'description' => 'Testing Officer/Tradesman Aid declaration that all of above is correctly received when checking in.',
						],
					],
					'testing_officer_signature' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Testing Officer/Tradesman Aid Signature:',
							'description' => 'Maximum file size allowed: 500 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'fuel_gauge_amount' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Fuel Gauge Amount:',
							'description' => '',
						],
					],
					'vehicle_marks_1' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Vehicle Marks (1):',
							'description' => 'Maximum file size allowed: 5096 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'vehicle_marks_2' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Vehicle Marks(2):',
							'description' => 'Maximum file size allowed: 5096 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'vehicle_marks_3' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Vehicle Marks(3):',
							'description' => 'Maximum file size allowed: 5096 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'vehicle_marks_4' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Vehicle Marks(4):',
							'description' => 'Maximum file size allowed: 5096 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'vehicle_marks_5' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Vehicle Marks(5):',
							'description' => 'Maximum file size allowed: 5096 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'vehicle_marks_6' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Vehicle Marks(6):',
							'description' => 'Maximum file size allowed: 5096 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'vehicle_marks_7' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Vehicle Marks(7):',
							'description' => 'Maximum file size allowed: 5096 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'vehicle_marks_8' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Vehicle Marks (8):',
							'description' => 'Maximum file size allowed: 5096 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'remarks' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Remarks about Vehicle:',
							'description' => '',
						],
					],
					'vehicle_handing_over_ckecklist' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Vehicle Handing Over Ckecklist:',
							'description' => 'Maximum file size allowed: 2048 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
				],
				'vehicle_return_check_list' => [
					'vehicle_return_check_list_id' => [
						'appgini' => "INT NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Vehicle Return  Check List ID:',
							'description' => '',
						],
					],
					'vehicle_return_date' => [
						'appgini' => "DATE NULL DEFAULT '0000-00-00'",
						'info' => [
							'caption' => 'Vehicle Return Date:',
							'description' => '',
						],
					],
					'job_card_number' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Job Card Number:',
							'description' => '',
						],
					],
					'vehicle_registration_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Vehicle Registration Number:',
							'description' => '',
						],
					],
					'make_of_vehicle' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Make of Vehicle:',
							'description' => '',
						],
					],
					'model_of_vehicle' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Model of Vehicle:',
							'description' => '',
						],
					],
					'closing_km' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Odometer Reading/Closing KM:',
							'description' => '',
						],
					],
					'radio_dvd_combination' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Radio/DVD Combination:',
							'description' => '',
						],
					],
					'number_of_keys_handling_over' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Number of Keys Handling Over:',
							'description' => '',
						],
					],
					'jack_with_handle' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Jack with Handle:',
							'description' => '',
						],
					],
					'tyre_spare' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tyre Spare (Available):',
							'description' => '',
						],
					],
					'tyre_spare_condition' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tyre Spare (Thread Condition):',
							'description' => '',
						],
					],
					'wheel_spanner' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Wheel Spanner:',
							'description' => '',
						],
					],
					'wheel_cups' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Wheel Hub Cups (Available):',
							'description' => '',
						],
					],
					'tri_angles' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tri Angles Available:',
							'description' => '',
						],
					],
					'other' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Other (specify):',
							'description' => '',
						],
					],
					'number_of_keys' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Number of Keys Handed Over:',
							'description' => '',
						],
					],
					'vehicle_washed' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Vehicle Washed:',
							'description' => '',
						],
					],
					'tyre_r_f' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tyre R/F (Available):',
							'description' => '',
						],
					],
					'tyre_r_f_1' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tyre R/F (Thread Condition):',
							'description' => '',
						],
					],
					'tyre_r_f_1_1' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tyre R/F Brand:',
							'description' => '',
						],
					],
					'tyre_r_r' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tyre R/R (Available):',
							'description' => '',
						],
					],
					'tyre_r_r_1' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tyre R/R (Available):',
							'description' => '',
						],
					],
					'tyre_r_r_1_1' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tyre R/F Brand:',
							'description' => '',
						],
					],
					'tyre_l_f' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tyre L/F (Available):',
							'description' => '',
						],
					],
					'tyre_l_f_1' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tyre L/F (Thread Condition):',
							'description' => '',
						],
					],
					'tyre_l_f_1_1' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tyre R/F Brand:',
							'description' => '',
						],
					],
					'tyer_l_r' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tyre L/R (Available):',
							'description' => '',
						],
					],
					'tyer_l_r_1' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tyre L/R (Thread Condition):',
							'description' => '',
						],
					],
					'tyre_l_r_1_1' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tyre R/F Brand:',
							'description' => '',
						],
					],
					'fuel_gauge_amount' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Fuel Gauge Amount:',
							'description' => '',
						],
					],
					'driver_name_and_surname' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Driver Name & Surname:',
							'description' => 'Driver declaration that all of above is correct.',
						],
					],
					'driver_persal_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Driver Persal Number:',
							'description' => '',
						],
					],
					'driver_signature' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Driver Signature:',
							'description' => 'Maximum file size allowed: 500 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'vehicle_return_date_signed' => [
						'appgini' => "DATETIME NULL DEFAULT '2020-01-01 00:00:00'",
						'info' => [
							'caption' => 'Declaration Date & Time:',
							'description' => 'Time when driver checked in at the Government Garage with vehicle for modification, repairs or service.',
						],
					],
					'testing_officer_name_and_surname' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Testing Officer/Tradesman Aid Name & Surname:',
							'description' => 'Testing Officer/Tradesman Aid declaration that all of above is correctly received when checking in.',
						],
					],
					'testing_officer_signature' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Testing Officer/Tradesman Aid Signature:',
							'description' => 'Maximum file size allowed: 500 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'vehicle_marks_1' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Vehicle Marks (1):',
							'description' => 'Maximum file size allowed: 5096 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'vehicle_marks_2' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Vehicle Marks(2):',
							'description' => 'Maximum file size allowed: 5096 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'vehicle_marks_3' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Vehicle Marks(3):',
							'description' => 'Maximum file size allowed: 5096 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'vehicle_marks_4' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Vehicle Marks(4):',
							'description' => 'Maximum file size allowed: 5096 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'vehicle_marks_5' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Vehicle Marks(5):',
							'description' => 'Maximum file size allowed: 5096 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'vehicle_marks_6' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Vehicle Marks(6):',
							'description' => 'Maximum file size allowed: 5096 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'vehicle_marks_7' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Vehicle Marks(7):',
							'description' => 'Maximum file size allowed: 5096 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'vehicle_marks_8' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Vehicle Marks (8):',
							'description' => 'Maximum file size allowed: 5096 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'remarks' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Remarks about Vehicle:',
							'description' => '',
						],
					],
					'vehicle_return_list' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Vehicle  Return List:',
							'description' => 'Maximum file size allowed: 2048 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
				],
				'indicates_repair_damages_found_list' => [
					'repair_damages_list_id' => [
						'appgini' => "INT NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Repair & Damages List ID:',
							'description' => '',
						],
					],
					'brought_in_for_repairs' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Brought in for Repairs:',
							'description' => '',
						],
					],
					'after_repairs' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'After Repairs:',
							'description' => '',
						],
					],
					'driver_name_and_surname' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Driver Name & Surname:',
							'description' => 'Driver declaration that all of above is correct.',
						],
					],
					'driver_persal_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Driver Persal Number:',
							'description' => '',
						],
					],
					'driver_signature' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Driver Signature:',
							'description' => 'Maximum file size allowed: 500 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'vehicle_return_date_signed' => [
						'appgini' => "DATETIME NULL DEFAULT '2020-01-01 00:00:00'",
						'info' => [
							'caption' => 'Declaration Date & Time:',
							'description' => 'Time when driver checked in at the Government Garage with vehicle for modification, repairs or service.',
						],
					],
					'company_name_and_surname' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Company Representativer Name & Surname:',
							'description' => 'Describe the entity.',
						],
					],
					'company_repesentative_signature' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Company Representative Signature:',
							'description' => 'Maximum file size allowed: 500 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'vehicle_return_date_signed_by_representative' => [
						'appgini' => "DATETIME NULL DEFAULT '2020-01-01 00:00:00'",
						'info' => [
							'caption' => 'Declaration Date & Time:',
							'description' => 'Time when Company representative signed.',
						],
					],
					'indicates_and_list_details_of_damages_deficiencies' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Indicates and list details of damages deficiencies and lost found:',
							'description' => 'Maximum file size allowed: 2048 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
				],
				'forms' => [
					'forms_id' => [
						'appgini' => "INT NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Forms ID:',
							'description' => 'Download forms for GMT Fleet.',
						],
					],
					'government_motor_transport_handbook' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Government Motor Transport Handbook:',
							'description' => 'Maximum file size allowed: 2048 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'approved_workshop_procedure_manual' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Approved Workshop Procedure Manual:',
							'description' => 'Maximum file size allowed: 2048 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'vehicle_daily_check_list_and_appraisal_report' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Vehicle Check List And Appraisal Report:',
							'description' => 'Maximum file size allowed: 2048 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'z181_report_on_accident' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Z181_Report on Accidentl:',
							'description' => 'Maximum file size allowed: 2048 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'vehicle_handing_over_ckecklist' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Vehicle Handing Over Ckecklist:',
							'description' => 'Maximum file size allowed: 2048 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'vehicle_return_list' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Vehicle  Return List:',
							'description' => 'Maximum file size allowed: 2048 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'indicates_and_list_details_of_damages_deficiencies' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Indicates and list details of damages deficiencies and lost found:',
							'description' => 'Maximum file size allowed: 2048 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
				],
				'identification_of_defects' => [
					'defects_id' => [
						'appgini' => "INT NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Defects ID:',
							'description' => '',
						],
					],
					'vehicle_registration_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Registration Number:',
							'description' => '',
						],
					],
					'engine_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Engine Number:',
							'description' => '',
						],
					],
					'make_of_vehicle' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Make of Vehicle:',
							'description' => '',
						],
					],
					'end_user_name_and_surname' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'End User Name & Surname:',
							'description' => '',
						],
					],
					'end_user_contact_details' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'End User Contact Details:',
							'description' => '',
						],
					],
					'end_user_persal_number' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'End User Persal Number:',
							'description' => '',
						],
					],
					'end_user_email_address' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'End User Email Address:',
							'description' => '',
						],
					],
					'end_user_signature' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'End User Signature:',
							'description' => 'Maximum file size allowed: 500 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'types_of_defects' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Types Of Defects:',
							'description' => '',
						],
					],
					'courses_of_defects' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Courses Of Defects:',
							'description' => '',
						],
					],
					'condition_of_defects' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Condition Of Defects:',
							'description' => '',
						],
					],
					'transport_officer_name_and_surname' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Transport Officer Name & Surname:',
							'description' => '',
						],
					],
					'transport_officer_persal_number' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Transport Officer Persal Number:',
							'description' => '',
						],
					],
					'transport_officer_contact_details' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Transport Officer Contact Details:',
							'description' => '',
						],
					],
					'transport_officer_email_address' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Transport Officer Email Address:',
							'description' => 'Maximum file size allowed: 500 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'government_garage_manager_name_and_surname' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Garage Manager Name & Surname:',
							'description' => '',
						],
					],
					'government_garage_manager_contact_details' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Government Garage Manager Contact Details:',
							'description' => '',
						],
					],
					'government_garage_manager_address' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Government Garage Manager Address:',
							'description' => '',
						],
					],
					'government_garage_manager_email_address' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Government Garage Manager Email Address:',
							'description' => '',
						],
					],
					'government_garage_manager_signature' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Government Garage Manager Signature:',
							'description' => 'Maximum file size allowed: 500 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
				],
				'gate_security' => [
					'gate_security_user_id' => [
						'appgini' => "INT NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Gate Security User ID:',
							'description' => '',
						],
					],
					'gate_security_name_and_surname' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Gate Security Name & Surname:',
							'description' => '',
						],
					],
					'gate_security_contact_details' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Gate security Contact Details:',
							'description' => '',
						],
					],
					'gate_security_signature' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Gate security signature',
							'description' => '',
						],
					],
					'date_of_vehicle_entrance' => [
						'appgini' => "DATETIME NULL",
						'info' => [
							'caption' => 'Date of Vehicle Entrance:',
							'description' => '',
						],
					],
					'vehicle_registration_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Registration Number:',
							'description' => '',
						],
					],
					'engine_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Engine Number:',
							'description' => '',
						],
					],
					'make_of_vehicle' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Make of Vehicle:',
							'description' => '',
						],
					],
					'vehicle_colour' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Vehicle Colour:',
							'description' => '',
						],
					],
					'vehicle_inspection' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Vehicle Inspection:',
							'description' => '',
						],
					],
					'vehicle_tires_size' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Vehicle Tires Size:',
							'description' => '',
						],
					],
					'vehicle_tires_check' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Vehicle Tires Check:',
							'description' => '',
						],
					],
					'vehicle_mirrow_check' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Vehicle Mirrow Check:',
							'description' => '',
						],
					],
					'vehicle_interiour_condition' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Vehicle Interiour Condition:',
							'description' => '',
						],
					],
					'vehicle_exteriour_condition' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Vehicle Exteriour Condition:',
							'description' => '',
						],
					],
					'gate_security_company_name' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Gate Security Company Name:',
							'description' => '',
						],
					],
					'gate_security_company_contact_details' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Gate Security Company Contact Details:',
							'description' => '',
						],
					],
					'gate_security_manager_name_and_surname' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Gate Security Manager  Name and Surname:',
							'description' => '',
						],
					],
					'gate_security_manager_contact_details' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Gate Security Manager Contact Details:',
							'description' => '',
						],
					],
					'gate_security_company_address' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Gate Security Company Address:',
							'description' => '',
						],
					],
					'inspection_of_vehicle_report' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Inspection Of Vehicle Report:',
							'description' => 'Maximum file size allowed: 5204 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'record_of_vehicle' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Record Of Vehicle:',
							'description' => '',
						],
					],
					'date_of_vehicle_exit' => [
						'appgini' => "DATETIME NULL",
						'info' => [
							'caption' => 'Date of Vehicle Exit:',
							'description' => '',
						],
					],
				],
				'reception' => [
					'reception_user_id' => [
						'appgini' => "INT NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Reception User ID:',
							'description' => '',
						],
					],
					'reception_name_and_surname' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Reception Name & Surname:',
							'description' => '',
						],
					],
					'reception_persal_number' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Reception Persal Number:',
							'description' => '',
						],
					],
					'reception_contact_details' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Reception Contact Details:',
							'description' => '',
						],
					],
					'reception_email_address' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Reception Email Address:',
							'description' => '',
						],
					],
					'reception_signature' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Reception Signature:',
							'description' => 'Maximum file size allowed: 500 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'date_of_vehicle_entrance' => [
						'appgini' => "DATETIME NULL",
						'info' => [
							'caption' => 'Date of Vehicle Entrance:',
							'description' => '',
						],
					],
					'service_status' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Service Status:',
							'description' => '',
						],
					],
					'district' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'District:',
							'description' => 'Capture the district and stations detail',
						],
					],
					'location' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Workshop Name/Station:',
							'description' => '',
						],
					],
					'workshop_address' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Workshop Address:',
							'description' => '',
						],
					],
					'vehicle_registration_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Registration Number:',
							'description' => '',
						],
					],
					'engine_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Engine Number:',
							'description' => '',
						],
					],
					'make_of_vehicle' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Make of Vehicle:',
							'description' => '',
						],
					],
					'breakdown_of_vehicle' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Breakdown Of Vehicle:',
							'description' => '',
						],
					],
					'description_of_vehicle_breakdown_notes' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Description of Vehicle Breakdown (Notes):',
							'description' => 'Note a short description as per Reporting Officer.',
						],
					],
					'description_of_vehicle_report' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Description Of Vehicle Report:',
							'description' => 'Maximum file size allowed: 5204 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'upload_of_vehicle_report' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Description Of Vehicle Report:',
							'description' => 'Maximum file size allowed: 5204 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'description_of_vehicle_breakdown' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Description Of Vehicle Breakdown:',
							'description' => '',
						],
					],
					'job_card_number' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Job Card Number:',
							'description' => '',
						],
					],
					'visual_inspection_form' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Visual Inspection Form:',
							'description' => 'Maximum file size allowed: 5120 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'damage_report' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Damage Report:',
							'description' => 'Maximum file size allowed: 5120 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'date_of_vehicle_exit' => [
						'appgini' => "DATETIME NULL",
						'info' => [
							'caption' => 'Date of Vehicle Exit:',
							'description' => '',
						],
					],
					'payment' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Payment:',
							'description' => '',
						],
					],
				],
				'inspection_bay' => [
					'inspection_bay_id' => [
						'appgini' => "INT NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Inspection Bay ID:',
							'description' => '',
						],
					],
					'inspection_bay_supervisor_name_and_surname' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Inspection Bay Supervisor Name & Surname:',
							'description' => '',
						],
					],
					'supervisor_contact_details' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Supervisor Contact Details:',
							'description' => '',
						],
					],
					'supervisor_email_address' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Supervisor Email Address:',
							'description' => '',
						],
					],
					'supervisor_signature' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Supervisor Signature:',
							'description' => 'Maximum file size allowed: 500 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'date_of_vehicle_entrance' => [
						'appgini' => "DATETIME NULL",
						'info' => [
							'caption' => 'Date of Vehicle Entrance:',
							'description' => '',
						],
					],
					'job_card_number' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Job Card Number:',
							'description' => '',
						],
					],
					'vehicle_registration_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Registration Number:',
							'description' => '',
						],
					],
					'engine_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Engine Number:',
							'description' => '',
						],
					],
					'workshop_name' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Workshop Name:',
							'description' => '',
						],
					],
					'work_allocation_reference_number' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Work Allocation Reference Number:',
							'description' => '',
						],
					],
					'make_of_vehicle' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Make of Vehicle:',
							'description' => '',
						],
					],
					'inspection_bay_lane_number' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Inspection Bay Lane Number:',
							'description' => '',
						],
					],
					'inspection_bay_condition' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Inspection Bay Condition:',
							'description' => '',
						],
					],
					'allocation_feedback' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Allocation Feedback:',
							'description' => '',
						],
					],
					'verification_of_defects' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Verification Of Defects:',
							'description' => '',
						],
					],
					'additional_defects' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Additional Defects:',
							'description' => '',
						],
					],
					'additional_defects_record' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Additional Defects Record:',
							'description' => 'Maximum file size allowed: 100 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'repair_requirement_note' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Repair Requirement Note:',
							'description' => '',
						],
					],
					'repair_requirement_report' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Repair Requirement Report:',
							'description' => 'Maximum file size allowed: 5120 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'date_of_vehicle_exit' => [
						'appgini' => "DATETIME NULL",
						'info' => [
							'caption' => 'Date of Vehicle Exit:',
							'description' => '',
						],
					],
				],
				'work_allocation' => [
					'work_allocation_id' => [
						'appgini' => "INT NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Work Allocation ID:',
							'description' => '',
						],
					],
					'district' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'District:',
							'description' => 'Capture the district and stations detail',
						],
					],
					'location' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Workshop Name/Station:',
							'description' => '',
						],
					],
					'cost_centre' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Cost centre',
							'description' => '',
						],
					],
					'supervisor_name_and_surname' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Supervisor Name & Surname:',
							'description' => '',
						],
					],
					'supervisor_contact_details' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Supervisor Contact Details:',
							'description' => '',
						],
					],
					'supervisor_email_address' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Supervisor Email Address:',
							'description' => '',
						],
					],
					'supervisor_signature' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Supervisor Signature:',
							'description' => 'Maximum file size allowed: 500 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'economical_repair' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Economical Repair:',
							'description' => 'Inspection supervisor identifies whether the repairs can be done internally or outsource based on nature of work.<br>Supervisor allocate the vehicle to the relevant section and the sectional supervisor allocate the vehicle to Artisan/Breakdown driver.',
						],
					],
					'uneconomical_repair' => [
						'appgini' => "VARCHAR(40) NULL UNIQUE",
						'info' => [
							'caption' => 'Uneconomical Repair:',
							'description' => 'The vehicle is recommended to be withdrawn from service/operations..<br>The vehicle is then reffered to the withdrawal supervisor for futher processing.<br>',
						],
					],
					'work_allocation_reference_number' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Work Allocation Reference Number:',
							'description' => '',
						],
					],
					'vehicle_registration_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Registration Number:',
							'description' => '',
						],
					],
					'engine_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Engine Number:',
							'description' => '',
						],
					],
					'make_of_vehicle' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Make of Vehicle:',
							'description' => '',
						],
					],
					'date_captured' => [
						'appgini' => "DATETIME NULL",
						'info' => [
							'caption' => 'Date Captured:',
							'description' => '',
						],
					],
				],
				'internal_repairs_mechanical' => [
					'internal_mechanical_id' => [
						'appgini' => "SMALLINT NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Internal Mechanical ID:',
							'description' => '',
						],
					],
					'workshop_name' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Workshop Name:',
							'description' => '',
						],
					],
					'artisan_name_and_surname' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Artisan Name & Surname:',
							'description' => '',
						],
					],
					'artisan_contacts' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Artisan Contacts:',
							'description' => '',
						],
					],
					'artisan_email_address' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Artisan Email Address:',
							'description' => '',
						],
					],
					'artisan_signature' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Artisan Signature:',
							'description' => 'Maximum file size allowed: 500 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'artisan_note_of_starting_time' => [
						'appgini' => "DATETIME NULL",
						'info' => [
							'caption' => 'Artisan Note Of Starting Time:',
							'description' => '',
						],
					],
					'job_card_number' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Job Card Number:',
							'description' => '',
						],
					],
					'work_allocation_reference_number' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Work Allocation Reference Number:',
							'description' => '',
						],
					],
					'vehicle_registration_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Registration Number:',
							'description' => '',
						],
					],
					'engine_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Engine Number:',
							'description' => '',
						],
					],
					'make_of_vehicle' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Make of Vehicle:',
							'description' => '',
						],
					],
					'pre_repair_inspections' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Pre Repairs Inspections:',
							'description' => '',
						],
					],
					'artisan_dismantling_solution' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Artisan Dismantling Solution:',
							'description' => '',
						],
					],
					'spares_order_quotation' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Spares Order Quotation:',
							'description' => 'Maximum file size allowed: 5129 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'spares_order_description' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Spares Order Description:',
							'description' => '',
						],
					],
					'artisan_note_of_completion_time' => [
						'appgini' => "DATETIME NULL",
						'info' => [
							'caption' => 'Artisan Completion Time:',
							'description' => '',
						],
					],
					'inspection_bay_lane_number' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Inspection Bay:',
							'description' => '',
						],
					],
					'inspection_bay_report' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Inspection bay report',
							'description' => 'Maximum file size allowed: 5104 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'total_labour_time' => [
						'appgini' => "TIME NULL",
						'info' => [
							'caption' => 'Total Labour Hours Spend:',
							'description' => '',
						],
					],
				],
				'external_repairs_mechanical' => [
					'external_mechanical_id' => [
						'appgini' => "INT NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Mechanical ID:',
							'description' => '',
						],
					],
					'department_inspector_name_and_surname' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Department Inspector Name & Surname:',
							'description' => '',
						],
					],
					'department_inspector_persal_number' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Inspector Persal Number:',
							'description' => '',
						],
					],
					'department_authorization_quote_note' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Department Authorization Quote Note:',
							'description' => '',
						],
					],
					'department_inspector_signature' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Department Inspector Signature:',
							'description' => 'Maximum file size allowed: 500 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'inspection_approval_repair_note' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Inspection Approval Repair Note:',
							'description' => '',
						],
					],
					'department_authorization_quote' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Department Authorization Quote:',
							'description' => 'Maximum file size allowed: 5104 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'service_provider_name' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Service Provider Name:',
							'description' => '',
						],
					],
					'service_provider_type' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Service Provider Type:',
							'description' => '',
						],
					],
					'service_provider_contact_details' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Service Provider Contacts:',
							'description' => '',
						],
					],
					'service_provider_address' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Service Provider Address:',
							'description' => '',
						],
					],
					'service_provider_signature' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Service Provider Signature:',
							'description' => 'Maximum file size allowed: 500 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'service_provider_repair_quote_upload' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Repair Quote Service Provider:',
							'description' => 'Upload the quoatation of external mechanical repairs',
						],
					],
					'service_provider_repair_quote' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Repair Qoute Service Providers:',
							'description' => '',
						],
					],
					'repair_requirement_note' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Repair Requirement Note:',
							'description' => '',
						],
					],
					'merchant_type' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Merchant Type:',
							'description' => '',
						],
					],
					'merchant_code' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Merchant code',
							'description' => '',
						],
					],
					'merchant_name' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Merchant Name:',
							'description' => '',
						],
					],
					'merchant_contacts_details' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Merchant Contacts Details:',
							'description' => '',
						],
					],
					'merchant_email_address' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Merchant Email Address:',
							'description' => '',
						],
					],
					'merchant_signature' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Merchant Signature:',
							'description' => 'Maximum file size allowed: 500 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'merchant_address' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Merchant Address:',
							'description' => '',
						],
					],
					'merchant_address_code' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Merchant Address Code:',
							'description' => '',
						],
					],
					'date_of_vehicle_send' => [
						'appgini' => "DATETIME NULL",
						'info' => [
							'caption' => 'Date of Vehicle Send:',
							'description' => '',
						],
					],
					'authorization_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Authorization Number:',
							'description' => '',
						],
					],
					'instruction_note' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Instruction Note:',
							'description' => 'Briefly describe the instruction.',
						],
					],
					'work_allocation_reference_number' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Work Allocation Reference Number:',
							'description' => '',
						],
					],
					'vehicle_registration_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Registration Number:',
							'description' => '',
						],
					],
					'engine_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Engine Number:',
							'description' => '',
						],
					],
					'make_of_vehicle' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Make of Vehicle:',
							'description' => '',
						],
					],
					'date_of_vehicle_received' => [
						'appgini' => "DATETIME NULL",
						'info' => [
							'caption' => 'Date of Vehicle Received:',
							'description' => '',
						],
					],
					'mechanical_repair_progress_monitor' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Monitor Progress:',
							'description' => 'Monitor progress of repairs to ensure vehicle is repaired accordingly',
						],
					],
					'mechanical_repair_progress_monitor_quality_of_work_manship' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Monitor the Quality of Workmanship:',
							'description' => 'Monitor workmanship quality of repaired vehicle.',
						],
					],
					'vehicle_inspection_report' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Vehicle Inspection Report:',
							'description' => 'Maximum file size allowed: 5040 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'upload_invoice' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Upload Invoice:',
							'description' => 'Maximum file size allowed: 5240 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
				],
				'internal_repairs_body' => [
					'internal_repairs_body_id' => [
						'appgini' => "INT NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Internal Repair Body ID:',
							'description' => '',
						],
					],
					'driver_name_and_surname' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Driver Name & Surname:',
							'description' => '',
						],
					],
					'driver_persal_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Driver Persal Number:',
							'description' => '',
						],
					],
					'driver_contacts_details' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Driver Contacts Details:',
							'description' => '',
						],
					],
					'driver_email_address' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Driver Email Address:',
							'description' => '',
						],
					],
					'driver_license_code' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Driver License Code:',
							'description' => '',
						],
					],
					'driver_license_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Driver License Number:',
							'description' => '',
						],
					],
					'driver_license_upload' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Driver license Upload:',
							'description' => 'Maximum file size allowed: 2048 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'driver_signature' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Driver Signature:',
							'description' => 'Maximum file size allowed: 500 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'vehicle_registration_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Registration Number:',
							'description' => '',
						],
					],
					'engine_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Engine Number:',
							'description' => '',
						],
					],
					'make_of_vehicle' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Make of Vehicle:',
							'description' => '',
						],
					],
					'z181_accident_form' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Z181 Accident Form Attached:',
							'description' => '',
						],
					],
					'z181_accident_form_uploaded' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Z181 Accident Form Uploaded:',
							'description' => 'Maximum file size allowed: 5240 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'job_card_number' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Job Card Number:',
							'description' => '',
						],
					],
					'work_allocation_reference_number' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Work Allocation Reference Number:',
							'description' => '',
						],
					],
					'artisan_note_of_starting_time' => [
						'appgini' => "DATETIME NULL",
						'info' => [
							'caption' => 'Artisan Note Of Starting Time:',
							'description' => '',
						],
					],
					'government_garage_name' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Government Garage/Workshop Name:',
							'description' => '',
						],
					],
					'government_garage_contact_details' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Government Garage/Workshop Contact Details:',
							'description' => '',
						],
					],
					'government_garage_address' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Government Garage/Workshop Address:',
							'description' => '',
						],
					],
					'government_garage_email_address' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Government Garage/Workshop Email Address:',
							'description' => '',
						],
					],
					'damages_occured' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Damages Occured:',
							'description' => '',
						],
					],
					'upload_of_internal_damages_1' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Upload of Internal Damages 1:',
							'description' => 'Maximum file size allowed: 2048 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'upload_of_internal_damages_2' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Upload of Internal Damages 2:',
							'description' => 'Maximum file size allowed: 2048 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'upload_of_internal_damages_3' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Upload of Internal Damages 3:',
							'description' => 'Maximum file size allowed: 2048 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'upload_of_internal_damages_4' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Upload of Internal Damages 4:',
							'description' => 'Maximum file size allowed: 2048 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'head_panel_beating_quotation' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Head Panel Beating Quotation (R):',
							'description' => '',
						],
					],
					'head_panel_beating_quotation_1' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Head Panel Beating Quotation:',
							'description' => 'Maximum file size allowed: 5120 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'head_panel_beating_name' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Head Panel Beating Name:',
							'description' => '',
						],
					],
					'head_panel_beating_contact_details' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Head Panel Beating Contact Details: ',
							'description' => '',
						],
					],
					'head_panel_beating_address' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Head Panel Beating Address:',
							'description' => '',
						],
					],
					'head_panel_beating_signature' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Head Panel Beating Signature:',
							'description' => 'Maximum file size allowed: 500 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'private_panel_beating_name' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Private Panel Beating Name:',
							'description' => '',
						],
					],
					'private_panel_beating_contact_details' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Private Panel Beating Contact Deatils:',
							'description' => '',
						],
					],
					'private_panel_beating_address' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Private Panel Beating Address:',
							'description' => '',
						],
					],
					'private_panel_beating_quotation' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Private Panel Beating Quotation (R):',
							'description' => '',
						],
					],
					'private_panel_beating_quotation_2' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Private Panel Beating Quotation:',
							'description' => 'Maximum file size allowed: 5120 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'artisan_note_of_completion_time' => [
						'appgini' => "DATETIME NULL",
						'info' => [
							'caption' => 'Artisan Completion Time:',
							'description' => '',
						],
					],
					'total_labour_time' => [
						'appgini' => "TIME NULL",
						'info' => [
							'caption' => 'Total Labour Hours Spend:',
							'description' => '',
						],
					],
				],
				'external_repairs_body' => [
					'external_repair_body_id' => [
						'appgini' => "INT NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'External Repair Body ID:',
							'description' => '',
						],
					],
					'head_panel_beating_name' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Panel Beating Name:',
							'description' => '',
						],
					],
					'head_panel_beating_contact_details' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Panel Beating Contact Details:',
							'description' => '',
						],
					],
					'head_panel_beating_address' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Panel Beating Address:',
							'description' => '',
						],
					],
					'head_panel_beating_signature' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Panel Beating Signature:',
							'description' => 'Maximum file size allowed: 500 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'panel_beating_quotation' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Panel Beating Quotation (R):',
							'description' => '',
						],
					],
					'panel_beating_quotation_approved_by_service_provider' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Panel Beating Quotation (R):',
							'description' => 'Upload of quotation as approved by Service Provider',
						],
					],
					'service_provider_name' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Service Provider Name:',
							'description' => '',
						],
					],
					'service_provider_type' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Service Provider Type:',
							'description' => '',
						],
					],
					'service_provider_contact_details' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Service Provider Contact Details:',
							'description' => '',
						],
					],
					'service_provider_address' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Service Provider Address:',
							'description' => '',
						],
					],
					'service_provider_branch' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Service Provider Branch:',
							'description' => '',
						],
					],
					'service_provider_branch_code' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Service Provider Branch Code:',
							'description' => '',
						],
					],
					'service_provider_signature' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Service Provider Signature:',
							'description' => 'Maximum file size allowed: 500 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'instruction_note' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Instruction Note:',
							'description' => 'Briefly describe the instruction.',
						],
					],
					'authorization_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Authorization Number:',
							'description' => '',
						],
					],
					'vehicle_registration_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Registration Number:',
							'description' => '',
						],
					],
					'engine_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Engine Number:',
							'description' => '',
						],
					],
					'make_of_vehicle' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Make of Vehicle:',
							'description' => '',
						],
					],
					'vehicle_colour' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Vehicle Colour:',
							'description' => '',
						],
					],
					'vehicle_inspection_done' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Vehicle Inspection Done:',
							'description' => '',
						],
					],
					'vehicle_inspection_check_list_form' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Vehicle Inspection Check List Form Upload:',
							'description' => 'Upload check list form.',
						],
					],
					'vehicle_tyre_sizes' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Vehicle Tyre Sizes:',
							'description' => '',
						],
					],
					'vehicle_mirrow_check' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Vehicle Mirrow Check:',
							'description' => '',
						],
					],
					'vehicle_interior_condition' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Vehicle Interior Condition:',
							'description' => '',
						],
					],
					'vehicle_exterior_condition' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Vehicle Exterior Condition:',
							'description' => '',
						],
					],
					'merchant_type' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Merchant Type:',
							'description' => '',
						],
					],
					'merchant_code' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Merchant Code:',
							'description' => '',
						],
					],
					'merchant_name' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Merchant Name:',
							'description' => '',
						],
					],
					'merchant_contacts_details' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Merchant Contacts Details:',
							'description' => '',
						],
					],
					'merchant_email_address' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Merchant Email Address:',
							'description' => '',
						],
					],
					'merchant_signature' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Merchant Signature:',
							'description' => 'Maximum file size allowed: 500 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'merchant_address' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Merchant Address:',
							'description' => '',
						],
					],
					'merchant_address_code' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Merchant Address Code:',
							'description' => '',
						],
					],
					'merchant_city' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Merchant City:',
							'description' => '',
						],
					],
					'head_panel_beating_monitor_progress' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Monitor Progress:',
							'description' => 'Monitor progress of repairs to ensure vehicle is repaired accordingly',
						],
					],
					'head_panel_beating_monitor_quality_of_work_manship' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Monitor Quality of Workmanship:',
							'description' => 'Monitor workmanship quality of repaired vehicle',
						],
					],
					'vehicle_inspection_report' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Vehicle Inspection Report:',
							'description' => 'Maximum file size allowed: 5040 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'upload_invoice' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Upload Invoice:',
							'description' => 'Maximum file size allowed: 5240 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
				],
				'ordering_of_spares_for_internal_repairs' => [
					'spares_id' => [
						'appgini' => "INT NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Spares ID:',
							'description' => '',
						],
					],
					'workshop_name' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Workshop Name:',
							'description' => '',
						],
					],
					'job_card_number' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Job Card Number:',
							'description' => '',
						],
					],
					'artisan_name_and_surname' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Artisan Name & Surname:',
							'description' => '',
						],
					],
					'artisan_contacts' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Artisan Contacts:',
							'description' => '',
						],
					],
					'artisan_email_address' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Artisan Email Address:',
							'description' => '',
						],
					],
					'artisan_signature' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Artisan Signature:',
							'description' => 'Maximum file size allowed: 500 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'internal_requisition_to_stores' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Internal Requisition to Stores:',
							'description' => '',
						],
					],
					'supervisor_name_and_surname' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Supervisor Name & Surname:',
							'description' => '',
						],
					],
					'supervisor_contact_details' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Supervisor Contact Details:',
							'description' => '',
						],
					],
					'supervisor_email_address' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Supervisor Email Address:',
							'description' => '',
						],
					],
					'supervisor_signature' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Supervisor Signature:',
							'description' => 'Maximum file size allowed: 500 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'internal_requisition_to_stores_recommended' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Internal Requisition to Stores Recommended:',
							'description' => '',
						],
					],
					'workshop_manager_name_and_surname' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Workshop Manager Name & Surname:',
							'description' => '',
						],
					],
					'workshop_manager_contact_details' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Workshop Manager Contact Details:',
							'description' => '',
						],
					],
					'workshop_manager_email_address' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Workshop Manager Email Address:',
							'description' => '',
						],
					],
					'workshop_manager_signature' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Workshop Manager Signature:',
							'description' => 'Maximum file size allowed: 500 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'internal_requisition_to_stores_approved' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Internal Requisition to Stores Approved:',
							'description' => '',
						],
					],
					'date_parts_ordered' => [
						'appgini' => "DATETIME NULL",
						'info' => [
							'caption' => 'Date when ordering of Parts:',
							'description' => '',
						],
					],
					'vehicle_registration_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Registration Number:',
							'description' => '',
						],
					],
					'engine_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Engine Number:',
							'description' => '',
						],
					],
					'make_of_vehicle' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Make of Vehicle:',
							'description' => '',
						],
					],
					'part_type_1' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Part Type (1):',
							'description' => '',
						],
					],
					'part_name_1' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Part Name (1):',
							'description' => '',
						],
					],
					'description_1' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Description (1):',
							'description' => '',
						],
					],
					'manufacture_1' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Manufacture (1):',
							'description' => '',
						],
					],
					'quality_1' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Quality (1):',
							'description' => '',
						],
					],
					'unit_price_1' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Unit Price (1):',
							'description' => '',
						],
					],
					'net_part_price_1' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Net Part Price (1):',
							'description' => '',
						],
					],
					'part_type_2' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Part Type (2):',
							'description' => '',
						],
					],
					'part_name_2' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Part Name (2):',
							'description' => '',
						],
					],
					'description_2' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Description (2):',
							'description' => '',
						],
					],
					'manufacture_2' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Manufacture (2):',
							'description' => '',
						],
					],
					'quality_2' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Quality (2):',
							'description' => '',
						],
					],
					'unit_price_2' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Unit Price (2):',
							'description' => '',
						],
					],
					'net_part_price_2' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Net Part Price (2) :',
							'description' => '',
						],
					],
					'part_type_3' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Part Type (3):',
							'description' => '',
						],
					],
					'part_name_3' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Part Name (3):',
							'description' => '',
						],
					],
					'description_3' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Description (3):',
							'description' => '',
						],
					],
					'manufacture_3' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Manufacture (3):',
							'description' => '',
						],
					],
					'quality_3' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Quality (3):',
							'description' => '',
						],
					],
					'unit_price_3' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Unit Price (3):',
							'description' => '',
						],
					],
					'net_part_price_3' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Net Part Price (3):',
							'description' => '',
						],
					],
					'part_type_4' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Part Type (4):',
							'description' => '',
						],
					],
					'part_name_4' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Part Name (4):',
							'description' => '',
						],
					],
					'description_4' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Description (4):',
							'description' => '',
						],
					],
					'manufacture_4' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Manufacture (4):',
							'description' => '',
						],
					],
					'quality_4' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Quality (4):',
							'description' => '',
						],
					],
					'unit_price_4' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Unit Price (4):',
							'description' => '',
						],
					],
					'net_part_price_4' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Net Part Price (4):',
							'description' => '',
						],
					],
					'part_type_5' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Part Type (5):',
							'description' => '',
						],
					],
					'part_name_5' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Part Name (5):',
							'description' => '',
						],
					],
					'description_5' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Description (5):',
							'description' => '',
						],
					],
					'manufacture_5' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Manufacture (5):',
							'description' => '',
						],
					],
					'quality_5' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Quality (5):',
							'description' => '',
						],
					],
					'unit_price_5' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Unit Price (5):',
							'description' => '',
						],
					],
					'net_part_price_5' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Net Part Price (5):',
							'description' => '',
						],
					],
					'part_type_6' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Part Type (6):',
							'description' => '',
						],
					],
					'part_name_6' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Part Name (6):',
							'description' => '',
						],
					],
					'description_6' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Description (6):',
							'description' => '',
						],
					],
					'manufacture_6' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Manufacture (6):',
							'description' => '',
						],
					],
					'quality_6' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Quality (6):',
							'description' => '',
						],
					],
					'unit_price_6' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Unit Price (6):',
							'description' => '',
						],
					],
					'net_part_price_6' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Net Part Price (6):',
							'description' => '',
						],
					],
					'part_type_7' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Part Type (7):',
							'description' => '',
						],
					],
					'part_name_7' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Part Name (7):',
							'description' => '',
						],
					],
					'description_7' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Description (7):',
							'description' => '',
						],
					],
					'manufacture_7' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Manufacture (7):',
							'description' => '',
						],
					],
					'quality_7' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Quality (7):',
							'description' => '',
						],
					],
					'unit_price_7' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Unit Price (7):',
							'description' => '',
						],
					],
					'net_part_price_7' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Net Part Price (7):',
							'description' => '',
						],
					],
					'part_type_8' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Part Type (8):',
							'description' => '',
						],
					],
					'part_name_8' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Part Name (8):',
							'description' => '',
						],
					],
					'description_8' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Description (8):',
							'description' => '',
						],
					],
					'manufacture_8' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Manufacture (8):',
							'description' => '',
						],
					],
					'unit_price_8' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Unit Price (8):',
							'description' => '',
						],
					],
					'quality_8' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Quality (8):',
							'description' => '',
						],
					],
					'net_part_price_8' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Net Part Price (8):',
							'description' => '',
						],
					],
					'tax' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Tax:',
							'description' => '',
						],
					],
					'total_amount' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Total Amount:',
							'description' => '',
						],
					],
					'attached_requisition_form' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Attached requisition form',
							'description' => 'Maximum file size allowed: 5120 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'work_allocation_reference_number' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Work Allocation Reference Number:',
							'description' => '',
						],
					],
					'date_parts_received' => [
						'appgini' => "DATETIME NULL",
						'info' => [
							'caption' => 'Date when Parts Received:',
							'description' => '',
						],
					],
				],
				'collection_of_repaired_vehicles' => [
					'collection_id' => [
						'appgini' => "INT NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Repaired ID:',
							'description' => '',
						],
					],
					'reception_name_and_surname' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Reception Name & Surname:',
							'description' => '',
						],
					],
					'reception_persal_number' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Reception Persal Number:',
							'description' => '',
						],
					],
					'reception_contact_details' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Reception Contact Details:',
							'description' => '',
						],
					],
					'reception_email_address' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Reception Email Address:',
							'description' => '',
						],
					],
					'reception_signature' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Reception Signature:',
							'description' => 'Maximum file size allowed: 500 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'driver_name_and_surname' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Driver Name And Surname:',
							'description' => '',
						],
					],
					'driver_persal_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Driver Persal Number:',
							'description' => '',
						],
					],
					'driver_contacts_details' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Driver Contacts Details:',
							'description' => '',
						],
					],
					'driver_email_address' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Driver Email Address:',
							'description' => '',
						],
					],
					'driver_license_upload' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Driver License Upload:',
							'description' => 'Maximum file size allowed: 2048 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'driver_signature' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Driver Signature:',
							'description' => 'Maximum file size allowed: 500 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'government_garage_name' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Government Garage Name:',
							'description' => '',
						],
					],
					'government_garage_contact_details' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Government Garage Contact Details:',
							'description' => '',
						],
					],
					'government_garage_address' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Government Garage Address:',
							'description' => '',
						],
					],
					'government_garage_email_address' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Government Garage Email Address:',
							'description' => '',
						],
					],
					'vehicle_registration_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Registration Number:',
							'description' => '',
						],
					],
					'engine_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Engine Number:',
							'description' => '',
						],
					],
					'make_of_vehicle' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Make of Vehicle:',
							'description' => '',
						],
					],
					'vehicle_inspection' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Vehicle Inspection Done:',
							'description' => '',
						],
					],
					'vehicle_inspection_form' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Vehicle Inspection Form Uploaded:',
							'description' => 'Maximum file size allowed: 5120 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'vehicle_interiour_condition' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Vehicle Interiour Condition:',
							'description' => '',
						],
					],
					'vehicle_exteriour_condition' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Vehicle Exteriour Condition:',
							'description' => '',
						],
					],
					'vehicle_tyre_check' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Vehicle Tyre Check:',
							'description' => '',
						],
					],
					'sign_off_time' => [
						'appgini' => "TIME NULL",
						'info' => [
							'caption' => 'Sign Off Time:',
							'description' => '',
						],
					],
					'date_of_repaired_vehicle_collection' => [
						'appgini' => "DATETIME NULL",
						'info' => [
							'caption' => 'Date of Vehicle Collection:',
							'description' => '',
						],
					],
				],
				'withdrawal_vehicle_from_operation' => [
					'withdrawal_id' => [
						'appgini' => "INT NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Withdrawal ID:',
							'description' => '',
						],
					],
					'supervisor_name_and_surname' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Supervisor Name & Surname:',
							'description' => '',
						],
					],
					'supervisor_contact_details' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Supervisor Contact Details:',
							'description' => '',
						],
					],
					'supervisor_email_address' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Supervisor Email Address:',
							'description' => '',
						],
					],
					'supervisor_signature' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Supervisor Signature:',
							'description' => 'Maximum file size allowed: 500 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'vehicle_registration_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Vehicle Registration Number:',
							'description' => '',
						],
					],
					'engine_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Engine Number:',
							'description' => '',
						],
					],
					'make_of_vehicle' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Make of Vehicle:',
							'description' => '',
						],
					],
					'purchased_price' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Purchased Price:',
							'description' => '',
						],
					],
					'date_of_service' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Date Of Service:',
							'description' => '',
						],
					],
					'date_of_next_service' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Date Of Next Service:',
							'description' => '',
						],
					],
					'renewal_of_license' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Renewal Of License:',
							'description' => '',
						],
					],
					'date_of_vehicle' => [
						'appgini' => "DATETIME NULL",
						'info' => [
							'caption' => 'Date Of Vehicle Withdrawal:',
							'description' => '',
						],
					],
					'description_of_vehicle_breakdown' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Description Of Vehicle Breakdown:',
							'description' => '',
						],
					],
					'tyre_inspection_report' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tyre Inspection Report:',
							'description' => 'Maximum file size allowed: 5240 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'document_checklist_report' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Document Checklist Report:',
							'description' => 'Maximum file size allowed: 5240 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'compiled_technical_report' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Compiled Technical Report:',
							'description' => 'Maximum file size allowed: 5240 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'district_officer_name_and_surname' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'District Officer Name & Surname:',
							'description' => '',
						],
					],
					'district_officer_persal_number' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'District Officer Persal Number:',
							'description' => '',
						],
					],
					'district_officer_contacts' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'District Officer Contacts:',
							'description' => '',
						],
					],
					'district_officer_signature' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'District Officer Signature:',
							'description' => 'Maximum file size allowed: 500 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'district_officer_email_address' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'District Officer Email Address:',
							'description' => '',
						],
					],
				],
				'costing' => [
					'costing_id' => [
						'appgini' => "INT NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Costing ID:',
							'description' => '',
						],
					],
					'government_garage_name' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Government Garage Name:',
							'description' => '',
						],
					],
					'supervisor_name_and_surname' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Supervisor Name & Surname:',
							'description' => '',
						],
					],
					'supervisor_contact_details' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Supervisor Contact Details:',
							'description' => '',
						],
					],
					'supervisor_email_address' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Supervisor Email Address:',
							'description' => '',
						],
					],
					'supervisor_signature' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Supervisor Signature:',
							'description' => 'Maximum file size allowed: 500 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'job_card_number' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Job Card Number:',
							'description' => '',
						],
					],
					'vehicle_registration_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Registration Number:',
							'description' => '',
						],
					],
					'engine_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Engine Number:',
							'description' => '',
						],
					],
					'make_of_vehicle' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Make of Vehicle:',
							'description' => '',
						],
					],
					'reconciliation_of_total_costs_by_costing_officer' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Reconciliation of Total Cost By Costing Officer:',
							'description' => '',
						],
					],
					'costing_officer_name_and_surname' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Costing Officer Name & Surname:',
							'description' => '',
						],
					],
					'costing_officer_contact_details' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Costing Officer Contact Details:',
							'description' => '',
						],
					],
					'costing_officer_email_address' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Costing Officer Email Address:',
							'description' => '',
						],
					],
					'costing_officer_signature' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Costing Officer Signature:',
							'description' => 'Maximum file size allowed: 500 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'material_cost' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Material Cost (R):',
							'description' => '',
						],
					],
					'spares_orders_quotation' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Spare Orders Quotation (R):',
							'description' => '',
						],
					],
					'spares_orders_quotation_upload' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Spare Orders Quotation Upload:',
							'description' => 'Maximum file size allowed: 4096 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'standard_labour_cost_per_hour' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Standard Labour Cost per Hour:',
							'description' => '',
						],
					],
					'labour_quotation' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Labour Quotation (R):',
							'description' => '',
						],
					],
					'labour_quotation_upload' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Labour Quotation Upload:',
							'description' => 'Maximum file size allowed: 4096 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'vat' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Vat 15 % (R):',
							'description' => '',
						],
					],
					'total_amount' => [
						'appgini' => "DECIMAL(10,2) NULL",
						'info' => [
							'caption' => 'Total Amount (R):',
							'description' => '',
						],
					],
					'workshop_manager_name_and_surname' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Workshop Manager Name & Surname:',
							'description' => '',
						],
					],
					'workshop_manager_contact_details' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Workshop Manager Contact Details:',
							'description' => '',
						],
					],
					'workshop_manager_email_address' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Workshop Manager Email Address:',
							'description' => '',
						],
					],
					'workshop_manager_signature' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Workshop Manager Signature:',
							'description' => 'Maximum file size allowed: 500 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'invoice_approved' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Internal Requisition to Stores Approved:',
							'description' => '',
						],
					],
					'invoice_date' => [
						'appgini' => "DATE NULL DEFAULT '0000-00-00'",
						'info' => [
							'caption' => 'Invoice Date:',
							'description' => '',
						],
					],
					'upload_invoice' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Invoice Upload:',
							'description' => 'Maximum file size allowed: 5240 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
				],
				'billing' => [
					'billing_id' => [
						'appgini' => "INT NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Billing ID:',
							'description' => '',
						],
					],
					'district' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'District:',
							'description' => 'Capture the district and stations detail',
						],
					],
					'location' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Station:',
							'description' => '',
						],
					],
					'upload_invoice' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Invoice Upload:',
							'description' => 'Maximum file size allowed: 5240 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'job_card_number' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Job Card Number:',
							'description' => '',
						],
					],
					'invoice_date' => [
						'appgini' => "DATE NULL DEFAULT '0000-00-00'",
						'info' => [
							'caption' => 'Invoice Date:',
							'description' => '',
						],
					],
					'maintenance_file' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Maintenance File:',
							'description' => '',
						],
					],
					'vehicle_registration_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Registration Number:',
							'description' => '',
						],
					],
					'engine_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Engine Number:',
							'description' => '',
						],
					],
					'make_of_vehicle' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Make of Vehicle:',
							'description' => '',
						],
					],
				],
				'general_control_measures' => [
					'general_control_measures_id' => [
						'appgini' => "INT NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'General Control Measures ID:',
							'description' => '',
						],
					],
					'district' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'District:',
							'description' => 'Capture the district and stations detail',
						],
					],
					'cost_centre' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Cost Centre:',
							'description' => '',
						],
					],
					'location' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Station:',
							'description' => '',
						],
					],
					'government_garage_name' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Government Garage Name:',
							'description' => '',
						],
					],
					'government_garage_section' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Government Garage Section:',
							'description' => '',
						],
					],
					'government_garage_manager_name_and_surname' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Manager Name & Surname:',
							'description' => '',
						],
					],
					'government_garage_manager_contact_details' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Government Garage Manager Contact Details:',
							'description' => '',
						],
					],
					'government_garage_manager_email_address' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Government Garage Manager Email Address:',
							'description' => '',
						],
					],
					'government_garage_manager_signature' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Government Garage Manager Signature:',
							'description' => 'Maximum file size allowed: 500 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'government_garage_address' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Government Garage Address:',
							'description' => '',
						],
					],
					'government_garage_condition' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Government Garage Condition:',
							'description' => '',
						],
					],
					'four_post_lift_condition' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Four Post Lift Condition:',
							'description' => '',
						],
					],
					'low_level_lift_condition' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Low Level Lift Condition:',
							'description' => '',
						],
					],
					'test_machines_conditions' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Test Machines Conditions:',
							'description' => '',
						],
					],
					'battery_testers_conditions' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Battery Testers Conditions:',
							'description' => '',
						],
					],
					'chargers_conditions' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Chargers Conditions:',
							'description' => '',
						],
					],
					'tools_conditions' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Tools Conditions:',
							'description' => '',
						],
					],
					'hand_tools_conditions' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Hand Tools Conditions:',
							'description' => '',
						],
					],
					'equipment_conditions' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Equipment Conditions:',
							'description' => '',
						],
					],
					'sectional_inspection' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Sectional Inspection:',
							'description' => '',
						],
					],
				],
				'movement_of_personnel_in_government_garage_and_workshops' => [
					'movement_id' => [
						'appgini' => "INT NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'User ID:',
							'description' => '',
						],
					],
					'vehicle_inspection' => [
						'appgini' => "INT NULL",
						'info' => [
							'caption' => 'Vehicle Inspection:',
							'description' => '',
						],
					],
					'vehicle_model' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Vehicle Model:',
							'description' => '',
						],
					],
					'vehicle_number_plate' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Vehicle Number Plate:',
							'description' => '',
						],
					],
					'vehicle_tires_check' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Vehicle Tires Check:',
							'description' => '',
						],
					],
					'vehicle_mirrow_check' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Vehicle Mirrow Check:',
							'description' => '',
						],
					],
					'gate_security_signature' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Gate Security Signature:',
							'description' => 'Maximum file size allowed: 500 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'government_garage_protocol' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Government Garage Protocol:',
							'description' => '',
						],
					],
					'government_garage_safety' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Government Garage Safety:',
							'description' => '',
						],
					],
					'vehicle_handing_over_checklist' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Vehicle handing Over Checklist:',
							'description' => 'Maximum file size allowed: 5240 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'vehicle_return_list' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Vehicle Return List:',
							'description' => 'Maximum file size allowed: 5240 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'approved_workshop_procedure_manual' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Approved Workshop Procedure Manual:',
							'description' => 'Maximum file size allowed: 5240 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'vehicle_registration_number' => [
						'appgini' => "VARCHAR(25) NULL",
						'info' => [
							'caption' => 'Registration Number:',
							'description' => '',
						],
					],
					'engine_number' => [
						'appgini' => "VARCHAR(35) NULL",
						'info' => [
							'caption' => 'Engine Number:',
							'description' => '',
						],
					],
					'make_of_vehicle' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Make of Vehicle:',
							'description' => '',
						],
					],
				],
				'service_provider' => [
					'service_provider_id' => [
						'appgini' => "INT NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Vendor ID:',
							'description' => '',
						],
					],
					'service_provider_type' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Service Provider Type:',
							'description' => '',
						],
					],
					'service_provider_name' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Service Provider Name:',
							'description' => '',
						],
					],
					'service_provider_contact_email' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Service Provider Contact e-Mail:',
							'description' => '',
						],
					],
					'service_provider_contact_details' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Service Provider Contact Details:',
							'description' => '',
						],
					],
					'service_provider_street_address' => [
						'appgini' => "TEXT NULL",
						'info' => [
							'caption' => 'Service Provider Street Address:',
							'description' => '',
						],
					],
					'service_provider_branch_code' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Service Provider Branch Code:',
							'description' => '',
						],
					],
					'service_provider_branch' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Service Provider Branch:',
							'description' => '',
						],
					],
					'service_provider_city' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Service Provider City:',
							'description' => '',
						],
					],
					'service_provider_address_code' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Service Provider Address Code:',
							'description' => '',
						],
					],
				],
				'service_provider_type' => [
					'service_provider_type_id' => [
						'appgini' => "INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Service Provider Type ID:',
							'description' => '',
						],
					],
					'service_provider_type' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Service Provider Type:',
							'description' => '',
						],
					],
				],
				'vehicle_annual_inspection' => [
					'fleet_asset_id' => [
						'appgini' => "INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
						'info' => [
							'caption' => 'Asset ID:',
							'description' => '',
						],
					],
					'vehicle_registration_number' => [
						'appgini' => "INT(11) NOT NULL",
						'info' => [
							'caption' => 'Registration Number:',
							'description' => '',
						],
					],
					'register_number' => [
						'appgini' => "INT(11) NOT NULL",
						'info' => [
							'caption' => 'Register Number:',
							'description' => '',
						],
					],
					'engine_number' => [
						'appgini' => "INT(11) NOT NULL",
						'info' => [
							'caption' => 'Engine Number:',
							'description' => '',
						],
					],
					'chassis_number' => [
						'appgini' => "INT(11) NOT NULL",
						'info' => [
							'caption' => 'Chassis/Vin Number:',
							'description' => '',
						],
					],
					'make_of_vehicle' => [
						'appgini' => "INT(11) NOT NULL",
						'info' => [
							'caption' => 'Make of Vehicle:',
							'description' => '',
						],
					],
					'model_of_vehicle' => [
						'appgini' => "INT(11) NOT NULL",
						'info' => [
							'caption' => 'Model of Vehicle:',
							'description' => '',
						],
					],
					'year_model_specification' => [
						'appgini' => "INT(11) NOT NULL",
						'info' => [
							'caption' => 'Year Model Specification:',
							'description' => '',
						],
					],
					'engine_capacity' => [
						'appgini' => "INT(11) NOT NULL",
						'info' => [
							'caption' => 'Engine Capacity (cc):',
							'description' => '',
						],
					],
					'tyre_size' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Tyre Size (Radial):',
							'description' => '',
						],
					],
					'transmission' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Transmission:',
							'description' => '',
						],
					],
					'fuel_type' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Fuel Type:',
							'description' => '',
						],
					],
					'type_of_vehicle' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Type of Vehicle:',
							'description' => '',
						],
					],
					'colour_of_vehicle' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Colour of Vehicle:',
							'description' => '',
						],
					],
					'application_status' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Application Status:',
							'description' => '',
						],
					],
					'renewal_of_license' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'License Expiry Date:',
							'description' => '',
						],
					],
					'barcode_number' => [
						'appgini' => "INT(11) NULL",
						'info' => [
							'caption' => 'Barcode Number:',
							'description' => '',
						],
					],
					'last_entry_logbook' => [
						'appgini' => "DATE NULL",
						'info' => [
							'caption' => 'Last Entry of Figure in Log Book:',
							'description' => '',
						],
					],
					'photo_of_vehicle' => [
						'appgini' => "VARCHAR(255) NULL",
						'info' => [
							'caption' => 'Photo of Vehicle:',
							'description' => 'Maximum file size allowed: 1024 KB.<br>Allowed file types: jpg, jpeg, gif, png',
						],
					],
					'department_name' => [
						'appgini' => "INT(11) NOT NULL",
						'info' => [
							'caption' => 'Department Name:',
							'description' => '',
						],
					],
					'province' => [
						'appgini' => "INT(11) NOT NULL",
						'info' => [
							'caption' => 'Province:',
							'description' => '',
						],
					],
					'district' => [
						'appgini' => "INT(11) NOT NULL",
						'info' => [
							'caption' => 'District and Station:',
							'description' => '',
						],
					],
					'mechanical_inspection' => [
						'appgini' => "LONGTEXT NULL",
						'info' => [
							'caption' => 'Mechanical Inspection:',
							'description' => '',
						],
					],
					'upholstery' => [
						'appgini' => "LONGTEXT NULL",
						'info' => [
							'caption' => 'Upholstery:',
							'description' => '',
						],
					],
					'electrical_inspection' => [
						'appgini' => "LONGTEXT NULL",
						'info' => [
							'caption' => 'Electrical Inspection:',
							'description' => '',
						],
					],
					'wheel_spanner' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Wheel Spanner:',
							'description' => '',
						],
					],
					'spare_wheel' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Spare Wheel:',
							'description' => '',
						],
					],
					'jack' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Jack:',
							'description' => '',
						],
					],
					'radio' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Radio:',
							'description' => '',
						],
					],
					'triangle' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Tri-Angle:',
							'description' => '',
						],
					],
					'log_book' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Log Book:',
							'description' => '',
						],
					],
					'iternary' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Iternary:',
							'description' => '',
						],
					],
					'fuel_card' => [
						'appgini' => "VARCHAR(40) NULL",
						'info' => [
							'caption' => 'Fuel Card:',
							'description' => '',
						],
					],
					'recommendation' => [
						'appgini' => "LONGTEXT NULL",
						'info' => [
							'caption' => 'Remarks / Recommendation:',
							'description' => '',
						],
					],
					'documents' => [
						'appgini' => "VARCHAR(225) NULL",
						'info' => [
							'caption' => 'Documents:',
							'description' => 'Maximum file size allowed: 5120 KB.<br>Allowed file types: txt, doc, docx, docm, odt, pdf, rtf',
						],
					],
					'checking_officer_name_and_surname' => [
						'appgini' => "VARCHAR(40) NOT NULL",
						'info' => [
							'caption' => 'Checking Officer:',
							'description' => '',
						],
					],
					'checking_officer_contact_email' => [
						'appgini' => "VARCHAR(40) NOT NULL",
						'info' => [
							'caption' => 'Checking Officer Contact  Email:',
							'description' => '',
						],
					],
					'date_of_inspection' => [
						'appgini' => "DATE NULL DEFAULT '0000-00-00'",
						'info' => [
							'caption' => 'Date of Inspection:',
							'description' => '',
						],
					],
				],
			];
		}

		if($tn === null) return $schema;

		return isset($schema[$tn]) ? $schema[$tn] : [];
	}
	########################################################################
	function update_membership_groups() {
		$tn = 'membership_groups';
		$eo = ['silentErrors' => true, 'noErrorQueryLog' => true];

		sql(
			"CREATE TABLE IF NOT EXISTS `{$tn}` (
				`groupID` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				`name` varchar(100) NOT NULL,
				`description` TEXT,
				`allowSignup` TINYINT,
				`needsApproval` TINYINT,
				`allowCSVImport` TINYINT NOT NULL DEFAULT '0',
				PRIMARY KEY (`groupID`)
			) CHARSET " . mysql_charset,
		$eo);

		sql("ALTER TABLE `{$tn}` CHANGE COLUMN `name` `name` VARCHAR(100) NOT NULL", $eo);
		sql("ALTER TABLE `{$tn}` ADD UNIQUE INDEX `name` (`name`)", $eo);
		sql("ALTER TABLE `{$tn}` ADD COLUMN `allowCSVImport` TINYINT NOT NULL DEFAULT '0'", $eo);
	}
	########################################################################
	function update_membership_users() {
		$tn = 'membership_users';
		$eo = ['silentErrors' => true, 'noErrorQueryLog' => true];

		sql(
			"CREATE TABLE IF NOT EXISTS `{$tn}` (
				`memberID` VARCHAR(100) NOT NULL, 
				`passMD5` VARCHAR(255), 
				`email` VARCHAR(100), 
				`signupDate` DATE, 
				`groupID` INT UNSIGNED, 
				`isBanned` TINYINT, 
				`isApproved` TINYINT, 
				`custom1` TEXT, 
				`custom2` TEXT, 
				`custom3` TEXT, 
				`custom4` TEXT, 
				`comments` TEXT, 
				`pass_reset_key` VARCHAR(100),
				`pass_reset_expiry` INT UNSIGNED,
				`flags` TEXT,
				`allowCSVImport` TINYINT NOT NULL DEFAULT '0', 
				`data` LONGTEXT,
				PRIMARY KEY (`memberID`),
				INDEX `groupID` (`groupID`)
			) CHARSET " . mysql_charset,
		$eo);

		sql("ALTER TABLE `{$tn}` ADD COLUMN `pass_reset_key` VARCHAR(100)", $eo);
		sql("ALTER TABLE `{$tn}` ADD COLUMN `pass_reset_expiry` INT UNSIGNED", $eo);
		sql("ALTER TABLE `{$tn}` CHANGE COLUMN `passMD5` `passMD5` VARCHAR(255)", $eo);
		sql("ALTER TABLE `{$tn}` CHANGE COLUMN `memberID` `memberID` VARCHAR(100) NOT NULL", $eo);
		sql("ALTER TABLE `{$tn}` ADD INDEX `groupID` (`groupID`)", $eo);
		sql("ALTER TABLE `{$tn}` ADD COLUMN `flags` TEXT", $eo);
		sql("ALTER TABLE `{$tn}` ADD COLUMN `allowCSVImport` TINYINT NOT NULL DEFAULT '0'", $eo);
		sql("ALTER TABLE `{$tn}` ADD COLUMN `data` LONGTEXT", $eo);
	}
	########################################################################
	function update_membership_userrecords() {
		$tn = 'membership_userrecords';
		$eo = ['silentErrors' => true, 'noErrorQueryLog' => true];

		sql(
			"CREATE TABLE IF NOT EXISTS `{$tn}` (
				`recID` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT, 
				`tableName` VARCHAR(100), 
				`pkValue` VARCHAR(255), 
				`memberID` VARCHAR(100), 
				`dateAdded` BIGINT UNSIGNED, 
				`dateUpdated` BIGINT UNSIGNED, 
				`groupID` INT UNSIGNED, 
				PRIMARY KEY (`recID`),
				UNIQUE INDEX `tableName_pkValue` (`tableName`, `pkValue`(150)),
				INDEX `pkValue` (`pkValue`),
				INDEX `tableName` (`tableName`),
				INDEX `memberID` (`memberID`),
				INDEX `groupID` (`groupID`)
			) CHARSET " . mysql_charset,
		$eo);

		sql("ALTER TABLE `{$tn}` ADD UNIQUE INDEX `tableName_pkValue` (`tableName`, `pkValue`(150))", $eo);
		sql("ALTER TABLE `{$tn}` ADD INDEX `pkValue` (`pkValue`)", $eo);
		sql("ALTER TABLE `{$tn}` ADD INDEX `tableName` (`tableName`)", $eo);
		sql("ALTER TABLE `{$tn}` ADD INDEX `memberID` (`memberID`)", $eo);
		sql("ALTER TABLE `{$tn}` ADD INDEX `groupID` (`groupID`)", $eo);
		sql("ALTER TABLE `{$tn}` CHANGE COLUMN `memberID` `memberID` VARCHAR(100)", $eo);
	}
	########################################################################
	function update_membership_grouppermissions() {
		$tn = 'membership_grouppermissions';
		$eo = ['silentErrors' => true, 'noErrorQueryLog' => true];

		sql(
			"CREATE TABLE IF NOT EXISTS `{$tn}` (
				`permissionID` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				`groupID` INT UNSIGNED,
				`tableName` VARCHAR(100),
				`allowInsert` TINYINT NOT NULL DEFAULT '0',
				`allowView` TINYINT NOT NULL DEFAULT '0',
				`allowEdit` TINYINT NOT NULL DEFAULT '0',
				`allowDelete` TINYINT NOT NULL DEFAULT '0',
				PRIMARY KEY (`permissionID`)
			) CHARSET " . mysql_charset,
		$eo);

		sql("ALTER TABLE `{$tn}` ADD UNIQUE INDEX `groupID_tableName` (`groupID`, `tableName`)", $eo);
	}
	########################################################################
	function update_membership_userpermissions() {
		$tn = 'membership_userpermissions';
		$eo = ['silentErrors' => true, 'noErrorQueryLog' => true];

		sql(
			"CREATE TABLE IF NOT EXISTS `{$tn}` (
				`permissionID` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				`memberID` VARCHAR(100) NOT NULL,
				`tableName` VARCHAR(100),
				`allowInsert` TINYINT NOT NULL DEFAULT '0',
				`allowView` TINYINT NOT NULL DEFAULT '0',
				`allowEdit` TINYINT NOT NULL DEFAULT '0',
				`allowDelete` TINYINT NOT NULL DEFAULT '0',
				PRIMARY KEY (`permissionID`)
			) CHARSET " . mysql_charset,
		$eo);

		sql("ALTER TABLE `{$tn}` CHANGE COLUMN `memberID` `memberID` VARCHAR(100) NOT NULL", $eo);
		sql("ALTER TABLE `{$tn}` ADD UNIQUE INDEX `memberID_tableName` (`memberID`, `tableName`)", $eo);
	}
	########################################################################
	function update_membership_usersessions() {
		$tn = 'membership_usersessions';
		$eo = ['silentErrors' => true, 'noErrorQueryLog' => true];

		sql(
			"CREATE TABLE IF NOT EXISTS `membership_usersessions` (
				`memberID` VARCHAR(100) NOT NULL,
				`token` VARCHAR(100) NOT NULL,
				`agent` VARCHAR(100) NOT NULL,
				`expiry_ts` INT(10) UNSIGNED NOT NULL,
				UNIQUE INDEX `memberID_token_agent` (`memberID`, `token`, `agent`),
				INDEX `memberID` (`memberID`),
				INDEX `expiry_ts` (`expiry_ts`)
			) CHARSET " . mysql_charset,
		$eo);
	}
	########################################################################
	function thisOr($this_val, $or = '&nbsp;') {
		return ($this_val != '' ? $this_val : $or);
	}
	########################################################################
	function getUploadedFile($FieldName, $MaxSize = 0, $FileTypes = 'csv|txt', $NoRename = false, $dir = '') {
		if(empty($_FILES) || empty($_FILES[$FieldName]))
			return 'Your php settings don\'t allow file uploads.';

		$f = $_FILES[$FieldName];

		if(!$MaxSize)
			$MaxSize = toBytes(ini_get('upload_max_filesize'));

		@mkdir(__DIR__ . '/csv');

		$dir = (is_dir($dir) && is_writable($dir) ? $dir : __DIR__ . '/csv/');

		if($f['error'] != 4 && $f['name'] != '') {
			if($f['size'] > $MaxSize || $f['error']) {
				return 'File size exceeds maximum allowed of '.intval($MaxSize / 1024).'KB';
			}

			if(!preg_match('/\.('.$FileTypes.')$/i', $f['name'], $ft)) {
				return 'File type not allowed. Only these file types are allowed: '.str_replace('|', ', ', $FileTypes);
			}

			if($NoRename) {
				$n  = str_replace(' ', '_', $f['name']);
			} else {
				$n  = microtime();
				$n  = str_replace(' ', '_', $n);
				$n  = str_replace('0.', '', $n);
				$n .= $ft[0];
			}

			if(!@move_uploaded_file($f['tmp_name'], $dir . $n)) {
				return 'Couldn\'t save the uploaded file. Try chmoding the upload folder "'.$dir.'" to 777.';
			} else {
				@chmod($dir.$n, 0666);
				return $dir.$n;
			}
		}
		return 'An error occurred while uploading the file. Please try again.';
	}
	########################################################################
	function toBytes($val) {
		$val = trim($val);
		$last = strtolower($val[strlen($val) - 1]);

		$val = intval($val);
		switch($last) {
			 case 'g':
					$val *= 1024;
			 case 'm':
					$val *= 1024;
			 case 'k':
					$val *= 1024;
		}

		return $val;
	}
	########################################################################
	function convertLegacyOptions($CSVList) {
		$CSVList=str_replace(';;;', ';||', $CSVList);
		$CSVList=str_replace(';;', '||', $CSVList);
		return trim($CSVList, '|');
	}
	########################################################################
	function getValueGivenCaption($query, $caption) {
		if(!preg_match('/select\s+(.*?)\s*,\s*(.*?)\s+from\s+(.*?)\s+order by.*/i', $query, $m)) {
			if(!preg_match('/select\s+(.*?)\s*,\s*(.*?)\s+from\s+(.*)/i', $query, $m)) {
				return '';
			}
		}

		// get where clause if present
		if(preg_match('/\s+from\s+(.*?)\s+where\s+(.*?)\s+order by.*/i', $query, $mw)) {
			$where = "where ({$mw[2]}) AND";
			$m[3] = $mw[1];
		} else {
			$where = 'where';
		}

		$caption = makeSafe($caption);
		return sqlValue("SELECT {$m[1]} FROM {$m[3]} {$where} {$m[2]}='{$caption}'");
	}
	########################################################################
	function time24($t = false) {
		if($t === false) $t = date('Y-m-d H:i:s'); // time now if $t not passed
		elseif(!$t) return ''; // empty string if $t empty
		return date('H:i:s', strtotime($t));
	}
	########################################################################
	function time12($t = false) {
		if($t === false) $t = date('Y-m-d H:i:s'); // time now if $t not passed
		elseif(!$t) return ''; // empty string if $t empty
		return date('h:i:s A', strtotime($t));
	}
	########################################################################
	function normalize_path($path) {
		// Adapted from https://developer.wordpress.org/reference/functions/wp_normalize_path/

		// Standardise all paths to use /
		$path = str_replace('\\', '/', $path);

		// Replace multiple slashes down to a singular, allowing for network shares having two slashes.
		$path = preg_replace('|(?<=.)/+|', '/', $path);

		// Windows paths should uppercase the drive letter
		if(':' === substr($path, 1, 1)) {
			$path = ucfirst($path);
		}

		return $path;
	}
	########################################################################
	function application_url($page = '', $s = false) {
		if($s === false) $s = $_SERVER;
		$ssl = (!empty($s['HTTPS']) && strtolower($s['HTTPS']) != 'off');
		$http = ($ssl ? 'https:' : 'http:');
		$port = $s['SERVER_PORT'];
		$port = ($port == '80' || $port == '443' || !$port) ? '' : ':' . $port;
		// HTTP_HOST already includes server port if not standard, but SERVER_NAME doesn't
		$host = (isset($s['HTTP_HOST']) ? $s['HTTP_HOST'] : $s['SERVER_NAME'] . $port);

		$uri = config('appURI');
		if(!$uri) $uri = '/';

		// uri must begin and end with /, but not be '//'
		if($uri != '/' && $uri[0] != '/') $uri = "/{$uri}";
		if($uri != '/' && $uri[strlen($uri) - 1] != '/') $uri = "{$uri}/";

		return "{$http}//{$host}{$uri}{$page}";
	}
	########################################################################
	function application_uri($page = '') {
		$url = application_url($page);
		return trim(parse_url($url, PHP_URL_PATH), '/');
	}
	########################################################################
	function is_ajax() {
		return (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
	}
	########################################################################
	function is_allowed_username($username, $exception = false) {
		$username = trim(strtolower($username));
		if(!preg_match('/^[a-z0-9][a-z0-9 _.@]{3,100}$/', $username) || preg_match('/(@@|  |\.\.|___)/', $username)) return false;

		if($username == $exception) return $username;

		if(sqlValue("select count(1) from membership_users where lcase(memberID)='{$username}'")) return false;
		return $username;
	}
	########################################################################
	/*
		if called without parameters, looks for a non-expired token in the user's session (or creates one if
		none found) and returns html code to insert into the form to be protected.

		if set to true, validates token sent in $_REQUEST against that stored in the session
		and returns true if valid or false if invalid, absent or expired.

		usage:
			1. in a new form that needs csrf proofing: echo csrf_token();
			   >> in case of ajax requests and similar, retrieve token directly
			      by calling csrf_token(false, true);
			2. when validating a submitted form: if(!csrf_token(true)) { reject_submission_somehow(); }
	*/
	function csrf_token($validate = false, $token_only = false) {
		// a long token age is better for UX with SPA and browser back/forward buttons
		// and it would expire when the session ends anyway
		$token_age = 86400 * 2;

		/* retrieve token from session */
		$csrf_token = (isset($_SESSION['csrf_token']) ? $_SESSION['csrf_token'] : false);
		$csrf_token_expiry = (isset($_SESSION['csrf_token_expiry']) ? $_SESSION['csrf_token_expiry'] : false);

		if(!$validate) {
			/* create a new token if necessary */
			if($csrf_token_expiry < time() || !$csrf_token) {
				$csrf_token = bin2hex(random_bytes(16));
				$csrf_token_expiry = time() + $token_age;
				$_SESSION['csrf_token'] = $csrf_token;
				$_SESSION['csrf_token_expiry'] = $csrf_token_expiry;
			}

			if($token_only) return $csrf_token;
			return '<input type="hidden" id="csrf_token" name="csrf_token" value="' . $csrf_token . '">';
		}

		/* validate submitted token */
		$user_token = Request::val('csrf_token', false);
		if($csrf_token_expiry < time() || !$user_token || $user_token != $csrf_token) {
			return false;
		}

		return true;
	}
	########################################################################
	function get_plugins() {
		$plugins = [];
		$plugins_path = __DIR__ . '/../plugins/';

		if(!is_dir($plugins_path)) return $plugins;

		$pd = dir($plugins_path);
		while(false !== ($plugin = $pd->read())) {
			if(!is_dir($plugins_path . $plugin) || in_array($plugin, ['projects', 'plugins-resources', '.', '..'])) continue;

			$info_file = "{$plugins_path}{$plugin}/plugin-info.json";
			if(!is_file($info_file)) continue;

			$plugins[] = json_decode(file_get_contents($info_file), true);
			$plugins[count($plugins) - 1]['admin_path'] = "../plugins/{$plugin}";
		}
		$pd->close();

		return $plugins;
	}
	########################################################################
	function maintenance_mode($new_status = '') {
		$maintenance_file = __DIR__ . '/.maintenance';

		if($new_status === true) {
			/* turn on maintenance mode */
			@touch($maintenance_file);
		} elseif($new_status === false) {
			/* turn off maintenance mode */
			@unlink($maintenance_file);
		}

		/* return current maintenance mode status */
		return is_file($maintenance_file);
	}
	########################################################################
	function handle_maintenance($echo = false) {
		if(!maintenance_mode()) return;

		global $Translation;
		$adminConfig = config('adminConfig');

		$admin = getLoggedAdmin();
		if($admin) {
			return ($echo ? '<div class="alert alert-danger" style="margin: 5em auto -5em;"><b>' . $Translation['maintenance mode admin notification'] . '</b></div>' : '');
		}

		if(!$echo) exit;

		exit('<div class="alert alert-danger" style="margin-top: 5em; font-size: 2em;"><i class="glyphicon glyphicon-exclamation-sign"></i> ' . $adminConfig['maintenance_mode_message'] . '</div>');
	}
	#########################################################
	function html_attr($str) {
		if(version_compare(PHP_VERSION, '5.2.3') >= 0) return htmlspecialchars($str, ENT_QUOTES, datalist_db_encoding, false);
		return htmlspecialchars($str, ENT_QUOTES, datalist_db_encoding);
	}
	#########################################################
	function html_attr_tags_ok($str) {
		// use this instead of html_attr() if you don't want html tags to be escaped
		$new_str = html_attr($str);
		return str_replace(['&lt;', '&gt;'], ['<', '>'], $new_str);
	}
	#########################################################
	class Notification{
		/*
			Usage:
			* in the main document, initiate notifications support using this PHP code:
				echo Notification::placeholder();

			* whenever you want to show a notifcation, use this PHP code inside a script tag:
				echo Notification::show([
					'message' => 'Notification text to display',
					'class' => 'danger', // or other bootstrap state cues, 'default' if not provided
					'dismiss_seconds' => 5, // optional auto-dismiss after x seconds
					'dismiss_days' => 7, // optional dismiss for x days if closed by user -- must provide an id
					'id' => 'xyz' // optional string to identify the notification -- must use for 'dismiss_days' to work
				]);
		*/
		protected static $placeholder_id; /* to force a single notifcation placeholder */

		protected function __construct() {} /* to prevent initialization */

		public static function placeholder() {
			if(self::$placeholder_id) return ''; // output placeholder code only once

			self::$placeholder_id = 'notifcation-placeholder-' . rand(10000000, 99999999);

			ob_start();
			?>

			<div class="notifcation-placeholder" id="<?php echo self::$placeholder_id; ?>"></div>
			<script>
				$j(function() {
					if(window.show_notification != undefined) return;

					window.show_notification = function(options) {
						var dismiss_class = '';
						var dismiss_icon = '';
						var cookie_name = 'hide_notification_' + options.id;
						var notif_id = 'notifcation-' + Math.ceil(Math.random() * 1000000);

						/* apply provided notficiation id if unique in page */
						if(options.id != undefined) {
							if(!$j('#' + options.id).length) notif_id = options.id;
						}

						/* notifcation should be hidden? */
						if(localStorage.getItem(cookie_name) != undefined) return;

						/* notification should be dismissable? */
						if(options.dismiss_seconds > 0 || options.dismiss_days > 0) {
							dismiss_class = ' alert-dismissible';
							dismiss_icon = '<button type="button" class="close" data-dismiss="alert">&times;</button>';
						}

						/* remove old dismissed notficiations */
						$j('.alert-dismissible.invisible').remove();

						/* append notification to notifications container */
						$j(
							'<div class="alert alert-' + options['class'] + dismiss_class + '" id="' + notif_id + '">' + 
								dismiss_icon +
								options.message + 
							'</div>'
						).appendTo('#<?php echo self::$placeholder_id; ?>');

						var this_notif = $j('#' + notif_id);

						/* dismiss after x seconds if requested */
						if(options.dismiss_seconds > 0) {
							setTimeout(function() { this_notif.addClass('invisible'); }, options.dismiss_seconds * 1000);
						}

						/* dismiss for x days if requested and user dismisses it */
						if(options.dismiss_days > 0) {
							var ex_days = options.dismiss_days;
							this_notif.on('closed.bs.alert', function() {
								/* set a cookie not to show this alert for ex_days */
								localStorage.setItem(cookie_name, '1');
							});
						}
					}
				})
			</script>

			<?php

			return ob_get_clean();
		}

		protected static function default_options(&$options) {
			if(!isset($options['message'])) $options['message'] = 'Notification::show() called without a message!';

			if(!isset($options['class'])) $options['class'] = 'default';

			if(!isset($options['dismiss_seconds']) || isset($options['dismiss_days'])) $options['dismiss_seconds'] = 0;

			if(!isset($options['dismiss_days'])) $options['dismiss_days'] = 0;
			if(!isset($options['id'])) {
				$options['id'] = 0;
				$options['dismiss_days'] = 0;
			}
		}

		/**
		 *  @brief Notification::show($options) displays a notification
		 *  
		 *  @param $options assoc array
		 *  
		 *  @return html code for displaying the notifcation
		 */
		public static function show($options = []) {
			self::default_options($options);

			ob_start();
			?>
			<script>
				$j(function() {
					show_notification(<?php echo json_encode($options); ?>);
				})
			</script>
			<?php

			return ob_get_clean();
		}
	}
	#########################################################
	function addMailRecipients(&$pm, $recipients, $type = 'to') {
		if(empty($recipients)) return;

		$func = [];

		switch(strtolower($type)) {
			case 'cc':
				$func = [$pm, 'addCC'];
				break;
			case 'bcc':
				$func = [$pm, 'addBCC'];
				break;
			case 'to':
			default:
				$func = [$pm, 'addAddress'];
				break;
		}

		// if recipients is a str, arrayify it!
		if(is_string($recipients)) $recipients = [[$recipients]];
		if(!is_array($recipients)) return;

		// if recipients is an array, loop thru and add emails/names
		foreach ($recipients as $rcpt) {
			// if rcpt is string, add as email
			if(is_string($rcpt) && isEmail($rcpt))
				call_user_func_array($func, [$rcpt]);

			// else if rcpt is array [email, name], or just [email]
			elseif(is_array($rcpt) && isEmail($rcpt[0]))
				call_user_func_array($func, [$rcpt[0], empty($rcpt[1]) ? '' : $rcpt[1]]);
		}
	}
	#########################################################
	function sendmail($mail) {
		if(empty($mail['to'])) return 'No recipient defined';

		// convert legacy 'to' and 'name' to new format [[to, name]]
		if(is_string($mail['to']))
			$mail['to'] = [
				[
					$mail['to'], 
					empty($mail['name']) ? '' : $mail['name']
				]
			];

		if(!isEmail($mail['to'][0][0])) return 'Invalid recipient email';

		$cfg = config('adminConfig');
		$smtp = ($cfg['mail_function'] == 'smtp');

		if(!class_exists('PHPMailer', false)) {
			include_once(__DIR__ . '/../resources/PHPMailer/class.phpmailer.php');
			if($smtp) include_once(__DIR__ . '/../resources/PHPMailer/class.smtp.php');
		}

		$pm = new PHPMailer;
		$pm->CharSet = datalist_db_encoding;

		if($smtp) {
			$pm->isSMTP();
			$pm->SMTPDebug = isset($mail['debug']) ? min(4, max(0, intval($mail['debug']))) : 0;
			$pm->Debugoutput = 'html';
			$pm->Host = $cfg['smtp_server'];
			$pm->Port = $cfg['smtp_port'];
			$pm->SMTPAuth = !empty($cfg['smtp_user']) || !empty($cfg['smtp_pass']);
			$pm->SMTPSecure = $cfg['smtp_encryption'];
			$pm->SMTPAutoTLS = $cfg['smtp_encryption'] ? true : false;
			$pm->Username = $cfg['smtp_user'];
			$pm->Password = $cfg['smtp_pass'];
		}

		$pm->setFrom($cfg['senderEmail'], $cfg['senderName']);
		$pm->Subject = isset($mail['subject']) ? $mail['subject'] : '';

		// handle recipients
		addMailRecipients($pm, $mail['to']);
		if(!empty($mail['cc'])) addMailRecipients($pm, $mail['cc'], 'cc');
		if(!empty($mail['bcc'])) addMailRecipients($pm, $mail['bcc'], 'bcc');

		/* if message already contains html tags, don't apply nl2br */
		$mail['message'] = isset($mail['message']) ? $mail['message'] : '';
		if($mail['message'] == strip_tags($mail['message']))
			$mail['message'] = nl2br($mail['message']);

		$pm->msgHTML($mail['message'], realpath(__DIR__ . '/..'));

		/*
		 * pass 'tag' as-is if provided in $mail .. 
		 * this is useful for passing any desired values to sendmail_handler
		 */
		if(!empty($mail['tag'])) $pm->tag = $mail['tag'];

		/* if sendmail_handler(&$pm) is defined (in hooks/__global.php) */
		if(function_exists('sendmail_handler')) sendmail_handler($pm);

		if(!$pm->send()) return $pm->ErrorInfo;

		return true;
	}
	#########################################################
	function safe_html($str, $noBr = false) {
		/* if $str has no HTML tags, apply nl2br */
		if($str == strip_tags($str)) return $noBr ? $str : nl2br($str);

		$hc = new CI_Input(datalist_db_encoding);
		$str = $hc->xss_clean(bgStyleToClass($str));

		// sandbox iframes if they aren't already
		$str = preg_replace('/(<|&lt;)iframe(\s+sandbox)*(.*?)(>|&gt;)/i', '$1iframe sandbox$3$4', $str);

		return $str;
	}
	#########################################################
	function getLoggedGroupID() {
		return Authentication::getLoggedGroupId();
	}
	#########################################################
	function getLoggedMemberID() {
		$u = Authentication::getUser();
		return $u ? $u['username'] : false;
	}
	#########################################################
	function setAnonymousAccess() {
		return Authentication::setAnonymousAccess();
	}
	#########################################################
	function getMemberInfo($memberID = null) {
		if($memberID === null) {
			$u = Authentication::getUser();
			if(!$u) return [];

			$memberID = $u['username'];
		}

		return Authentication::getMemberInfo($memberID);
	}
	#########################################################
	function get_group_id($user = null) {
		$mi = getMemberInfo($user);
		return $mi['groupID'];
	}
	#########################################################
	/**
	 *  @brief Prepares data for a SET or WHERE clause, to be used in an INSERT/UPDATE query
	 *  
	 *  @param [in] $set_array Assoc array of field names => values
	 *  @param [in] $glue optional glue. Set to ' AND ' or ' OR ' if preparing a WHERE clause
	 *  @return SET string
	 */
	function prepare_sql_set($set_array, $glue = ', ') {
		$fnvs = [];
		foreach($set_array as $fn => $fv) {
			if($fv === null) { $fnvs[] = "{$fn}=NULL"; continue; }

			$sfv = makeSafe($fv);
			$fnvs[] = "{$fn}='{$sfv}'";
		}
		return implode($glue, $fnvs);
	}
	#########################################################
	/**
	 *  @brief Inserts a record to the database
	 *  
	 *  @param [in] $tn table name where the record would be inserted
	 *  @param [in] $set_array Assoc array of field names => values to be inserted
	 *  @param [out] $error optional string containing error message if insert fails
	 *  @return boolean indicating success/failure
	 */
	function insert($tn, $set_array, &$error = '') {
		$set = prepare_sql_set($set_array);
		if(!$set) return false;

		$eo = ['silentErrors' => true];
		$res = sql("INSERT INTO `{$tn}` SET {$set}", $eo);
		if($res) return true;

		$error = $eo['error'];
		return false;
	}
	#########################################################
	/**
	 *  @brief Updates a record in the database
	 *  
	 *  @param [in] $tn table name where the record would be updated
	 *  @param [in] $set_array Assoc array of field names => values to be updated
	 *  @param [in] $where_array Assoc array of field names => values used to build the WHERE clause
	 *  @param [out] $error optional string containing error message if insert fails
	 *  @return boolean indicating success/failure
	 */
	function update($tn, $set_array, $where_array, &$error = '') {
		$set = prepare_sql_set($set_array);
		if(!$set) return false;

		$where = prepare_sql_set($where_array, ' AND ');
		if(!$where) $where = '1=1';

		$eo = ['silentErrors' => true];
		$res = sql("UPDATE `{$tn}` SET {$set} WHERE {$where}", $eo);
		if($res) return true;

		$error = $eo['error'];
		return false;
	}
	#########################################################
	/**
	 *  @brief Set/update the owner of given record
	 *  
	 *  @param [in] $tn name of table
	 *  @param [in] $pk primary key value
	 *  @param [in] $user username to set as owner. If not provided (or false), update dateUpdated only
	 *  @return boolean indicating success/failure
	 */
	function set_record_owner($tn, $pk, $user = false) {
		$fields = [
			'memberID' => strtolower($user),
			'dateUpdated' => time(),
			'groupID' => get_group_id($user)
		];

		// don't update user if false
		if($user === false) unset($fields['memberID'], $fields['groupID']);

		$where_array = ['tableName' => $tn, 'pkValue' => $pk];
		$where = prepare_sql_set($where_array, ' AND ');
		if(!$where) return false;

		/* do we have an existing ownership record? */
		$res = sql("SELECT * FROM `membership_userrecords` WHERE {$where}", $eo);
		if($row = db_fetch_assoc($res)) {
			if($row['memberID'] == $user) return true; // owner already set to $user

			/* update owner and/or dateUpdated */
			$res = update('membership_userrecords', backtick_keys_once($fields), $where_array);
			return ($res ? true : false);
		}

		/* add new ownership record */
		$fields = array_merge($fields, $where_array, ['dateAdded' => time()]);
		$res = insert('membership_userrecords', backtick_keys_once($fields));
		return ($res ? true : false);
	}
	#########################################################
	/**
	 *  @brief get date/time format string for use in different cases.
	 *  
	 *  @param [in] $destination string, one of these: 'php' (see date function), 'mysql', 'moment'
	 *  @param [in] $datetime string, one of these: 'd' = date, 't' = time, 'dt' = both
	 *  @return string
	 */
	function app_datetime_format($destination = 'php', $datetime = 'd') {
		switch(strtolower($destination)) {
			case 'mysql':
				$date = '%d/%m/%Y';
				$time = '%H:%i:%s';
				break;
			case 'moment':
				$date = 'DD/MM/YYYY';
				$time = 'HH:mm:ss';
				break;
			case 'phps': // php short format
				$date = 'j/n/Y';
				$time = 'H:i:s';
				break;
			default: // php
				$date = 'd/m/Y';
				$time = 'H:i:s';
		}

		$datetime = strtolower($datetime);
		if($datetime == 'dt' || $datetime == 'td') return "{$date} {$time}";
		if($datetime == 't') return $time;
		return $date; // default case of 'd'
	}
	#########################################################
	/**
	 *  @brief perform a test and return results
	 *  
	 *  @param [in] $subject string used as title of test
	 *  @param [in] $test callable function containing the test to be performed, should return true on success, false or a log string on error
	 *  @return test result
	 */
	function test($subject, $test) {
		ob_start();
		$result = $test();
		if($result === true) {
			echo "<div class=\"alert alert-success vspacer-sm\" style=\"padding: 0.2em;\"><i class=\"glyphicon glyphicon-ok hspacer-lg\"></i> {$subject}</div>";
			return ob_get_clean();
		}

		$log = '';
		if($result !== false) $log = "<pre style=\"margin-left: 2em; padding: 0.2em;\">{$result}</pre>";
		echo "<div class=\"alert alert-danger vspacer-sm\" style=\"padding: 0.2em;\"><i class=\"glyphicon glyphicon-remove hspacer-lg\"></i> <span class=\"text-bold\">{$subject}</span>{$log}</div>";
		return ob_get_clean();
	}
	#########################################################
	/**
	 *  @brief invoke a method of an object -- useful to call private/protected methods
	 *  
	 *  @param [in] $object instance of object containing the method
	 *  @param [in] $methodName string name of method to invoke
	 *  @param [in] $parameters array of parameters to pass to the method
	 *  @return the returned value from the invoked method
	 */
	function invoke_method(&$object, $methodName, array $parameters = []) {
		$reflection = new ReflectionClass(get_class($object));
		$method = $reflection->getMethod($methodName);
		$method->setAccessible(true);

		return $method->invokeArgs($object, $parameters);
	}
	#########################################################
	/**
	 *  @brief retrieve the value of a property of an object -- useful to retrieve private/protected props
	 *  
	 *  @param [in] $object instance of object containing the method
	 *  @param [in] $propName string name of property to retrieve
	 *  @return the returned value of the given property, or null if property doesn't exist
	 */
	function get_property(&$object, $propName) {
		$reflection = new ReflectionClass(get_class($object));
		try {
			$prop = $reflection->getProperty($propName);
		} catch(Exception $e) {
			return null;
		}

		$prop->setAccessible(true);

		return $prop->getValue($object);
	}

	#########################################################
	/**
	 *  @brief invoke a method of a static class -- useful to call private/protected methods
	 *  
	 *  @param [in] $class string name of the class containing the method
	 *  @param [in] $methodName string name of method to invoke
	 *  @param [in] $parameters array of parameters to pass to the method
	 *  @return the returned value from the invoked method
	 */
	function invoke_static_method($class, $methodName, array $parameters = []) {
		$reflection = new ReflectionClass($class);
		$method = $reflection->getMethod($methodName);
		$method->setAccessible(true);

		return $method->invokeArgs(null, $parameters);
	}
	#########################################################
	/**
	 *  @param [in] $app_datetime string, a datetime formatted in app-specific format
	 *  @return string, mysql-formatted datetime, 'yyyy-mm-dd H:i:s', or empty string on error
	 */
	function mysql_datetime($app_datetime, $date_format = null, $time_format = null) {
		$app_datetime = trim($app_datetime);

		if($date_format === null) $date_format = app_datetime_format('php', 'd');
		$date_separator = $date_format[1];
		if($time_format === null) $time_format = app_datetime_format('php', 't');
		$time24 = (strpos($time_format, 'H') !== false); // true if $time_format is 24hr rather than 12

		$date_regex = str_replace(
			array('Y', 'm', 'd', '/', '.'),
			array('([0-9]{4})', '(1[012]|0?[1-9])', '([12][0-9]|3[01]|0?[1-9])', '\/', '\.'),
			$date_format
		);

		$time_regex = str_replace(
			array('H', 'h', ':i', ':s'),
			array(
				'(1[0-9]|2[0-3]|0?[0-9])', 
				'(1[012]|0?[0-9])', 
				'(:([1-5][0-9]|0?[0-9]))', 
				'(:([1-5][0-9]|0?[0-9]))?'
			),
			$time_format
		);
		if(stripos($time_regex, ' a'))
			$time_regex = str_ireplace(' a', '\s*(am|pm|a|p)?', $time_regex);
		else
			$time_regex = str_ireplace( 'a', '\s*(am|pm|a|p)?', $time_regex);

		// extract date and time
		$time = '';
		$mat = [];
		$regex = "/^({$date_regex})(\s+{$time_regex})?$/i";
		$valid_dt = preg_match($regex, $app_datetime, $mat);
		if(!$valid_dt || count($mat) < 5) return ''; // invlaid datetime
		// if we have a time, get it and change 'a' or 'p' at the end to 'am'/'pm'
		if(count($mat) >= 8) $time = preg_replace('/(a|p)$/i', '$1m', trim($mat[5]));

		// extract date elements from regex match, given 1st 2 items are full string and full date
		$date_order = str_replace($date_separator, '', $date_format);
		$day = $mat[stripos($date_order, 'd') + 2];
		$month = $mat[stripos($date_order, 'm') + 2];
		$year = $mat[stripos($date_order, 'y') + 2];

		// convert time to 24hr format if necessary
		if($time && !$time24) $time = date('H:i:s', strtotime("2000-01-01 {$time}"));

		$mysql_datetime = trim("{$year}-{$month}-{$day} {$time}");

		// strtotime handles dates between 1902 and 2037 only
		// so we need another test date for dates outside this range ...
		$test = $mysql_datetime;
		if($year < 1902 || $year > 2037) $test = str_replace($year, '2000', $mysql_datetime);

		return (strtotime($test) ? $mysql_datetime : '');
	}
	#########################################################
	/**
	 *  @param [in] $mysql_datetime string, Mysql-formatted datetime
	 *  @param [in] $datetime string, one of these: 'd' = date, 't' = time, 'dt' = both
	 *  @return string, app-formatted datetime, or empty string on error
	 *  
	 *  @details works for formatting date, time and datetime, based on 2nd param
	 */  
	function app_datetime($mysql_datetime, $datetime = 'd') {
		$pyear = $myear = substr($mysql_datetime, 0, 4);

		// if date is 0 (0000-00-00) return empty string
		if(!$mysql_datetime || substr($mysql_datetime, 0, 10) == '0000-00-00') return '';

		// strtotime handles dates between 1902 and 2037 only
		// so we need a temp date for dates outside this range ...
		if($myear < 1902 || $myear > 2037) $pyear = 2000;
		$mysql_datetime = str_replace("$myear", "$pyear", $mysql_datetime);

		$ts = strtotime($mysql_datetime);
		if(!$ts) return '';

		$pdate = date(app_datetime_format('php', $datetime), $ts);
		return str_replace("$pyear", "$myear", $pdate);
	}
	#########################################################
	/**
	 *  @brief converts string from app-configured encoding to utf8
	 *  
	 *  @param [in] $str string to convert to utf8
	 *  @return utf8-encoded string
	 *  
	 *  @details if the constant 'datalist_db_encoding' is not defined, original string is returned
	 */
	function to_utf8($str) {
		if(!defined('datalist_db_encoding')) return $str;
		if(datalist_db_encoding == 'UTF-8') return $str;
		return iconv(datalist_db_encoding, 'UTF-8', $str);
	}
	#########################################################
	/**
	 *  @brief converts string from utf8 to app-configured encoding
	 *  
	 *  @param [in] $str string to convert from utf8
	 *  @return utf8-decoded string
	 *  
	 *  @details if the constant 'datalist_db_encoding' is not defined, original string is returned
	 */
	function from_utf8($str) {
		if(!strlen($str)) return $str;
		if(!defined('datalist_db_encoding')) return $str;
		if(datalist_db_encoding == 'UTF-8') return $str;
		return iconv('UTF-8', datalist_db_encoding, $str);
	}
	#########################################################
	/* deep trimmer function */
	function array_trim($arr) {
		if(!is_array($arr)) return trim($arr);
		return array_map('array_trim', $arr);
	}
	#########################################################
	function request_outside_admin_folder() {
		return (realpath(__DIR__) != realpath(dirname($_SERVER['SCRIPT_FILENAME'])));
	}
	#########################################################
	function get_parent_tables($table) {
		/* parents array:
		 * 'child table' => [parents], ...
		 *         where parents array:
		 *             'parent table' => [main lookup fields in child]
		 */
		$parents = [
			'gmt_fleet_register' => [
				'dealer' => ['make_of_vehicle', 'dealer_name'],
				'year_model' => ['year_model_specification'],
				'transmission' => ['transmission'],
				'fuel_type' => ['fuel_type'],
				'body_type' => ['type_of_vehicle'],
				'vehicle_colour' => ['colour_of_vehicle'],
				'application_status' => ['application_status'],
				'departments' => ['department_name_of_driver', 'department_name'],
				'province' => ['province'],
				'districts' => ['district'],
				'driver' => ['drivers_name_and_surname'],
			],
			'log_sheet' => [
				'gmt_fleet_register' => ['model_of_vehicle', 'register_number', 'vehicle_registration_number'],
				'vehicle_colour' => ['colour_of_vehicle'],
				'driver' => ['drivers_name_and_surname'],
				'fuel_type' => ['fuel_type'],
			],
			'vehicle_history' => [
				'gmt_fleet_register' => ['vehicle_registration_number'],
				'service' => ['date_of_service'],
				'purchase_orders' => ['purchased_order_number'],
				'claim' => ['claim_code'],
				'tyre_log_sheet' => ['tyre_inspection_report'],
				'vehicle_daily_check_list' => ['next_inspection_date', 'document_checklist_report', 'inspection_certification_number'],
				'log_sheet' => ['closing_km'],
				'breakdown_services' => ['total_cost'],
			],
			'vehicle_payments' => [
				'gmt_fleet_register' => ['vehicle_registration_number'],
				'log_sheet' => ['closing_km'],
				'merchant' => ['merchant_name'],
			],
			'insurance_payments' => [
				'gmt_fleet_register' => ['vehicle_registration_number'],
				'merchant' => ['merchant_name'],
			],
			'authorizations' => [
				'claim' => ['client', 'vehicle_registration_number', 'job_code'],
				'claim_status' => ['job_status'],
				'claim_category' => ['job_category'],
				'province' => ['province_name'],
				'merchant' => ['merchant_code'],
			],
			'service' => [
				'service_item_type' => ['service_item_type'],
				'service_categories' => ['service_category'],
				'merchant' => ['merchant_name'],
				'gmt_fleet_register' => ['vehicle_registration_number'],
				'dealer' => ['dealer_name'],
				'log_sheet' => ['closing_km'],
				'work_allocation' => ['work_allocation_reference_number'],
				'schedule' => ['date_of_service'],
				'reception' => ['receptionist'],
			],
			'service_type' => [
				'service_item_type' => ['service_item_type'],
				'service_categories' => ['service_category'],
			],
			'schedule' => [
				'gmt_fleet_register' => ['vehicle_registration_number', 'user_name_and_surname'],
				'service_item_type' => ['service_item_type'],
				'log_sheet' => ['closing_km'],
				'districts' => ['workshop_name'],
			],
			'service_records' => [
				'service' => ['vehicle'],
			],
			'purchase_orders' => [
				'gmt_fleet_register' => ['vehicle_registration_number'],
				'manufacturer' => ['part_manufacturer_name_8', 'part_manufacturer_name_7', 'part_manufacturer_name_6', 'part_manufacturer_name_5', 'part_manufacturer_name_4', 'part_manufacturer_name_3', 'part_manufacturer_name_2', 'part_manufacturer_name_1', 'manufacturer'],
				'service_categories' => ['service_category'],
				'merchant' => ['merchant_name'],
				'log_sheet' => ['closing_km'],
				'parts' => ['part_name_8', 'part_number_8', 'part_name_7', 'part_number_7', 'part_name_6', 'part_number_6', 'part_number_5', 'part_number_4', 'part_number_3', 'part_name_2', 'part_number_2', 'part_name_1', 'part_number_1'],
				'service' => ['work_order_id', 'workshop_name'],
				'reception' => ['job_card_number'],
			],
			'merchant' => [
				'merchant_type' => ['merchant_type'],
			],
			'manufacturer' => [
				'manufacturer_type' => ['manufacturer_type'],
			],
			'accidents' => [
				'gmt_fleet_register' => ['vehicle_registration_number'],
				'log_sheet' => ['closing_km'],
				'driver' => ['drivers_surname'],
				'districts' => ['district'],
			],
			'claim' => [
				'claim_status' => ['claim_status'],
				'claim_category' => ['claim_category'],
				'cost_centre' => ['cost_centre'],
				'departments' => ['department_name'],
				'districts' => ['district'],
				'province' => ['province'],
				'merchant' => ['merchant_name'],
				'gmt_fleet_register' => ['vehicle_registration_number'],
				'log_sheet' => ['closing_km'],
			],
			'dealer' => [
				'dealer_type' => ['dealer_type'],
			],
			'tyre_log_sheet' => [
				'gmt_fleet_register' => ['vehicle_registration_number'],
			],
			'vehicle_daily_check_list' => [
				'gmt_fleet_register' => ['vehicle_registration_number'],
				'log_sheet' => ['closing_km'],
				'driver' => ['drivers_surname'],
			],
			'parts' => [
				'parts_type' => ['part_type'],
				'manufacturer' => ['manufacturer'],
				'dealer' => ['dealer'],
			],
			'breakdown_services' => [
				'reception' => ['job_card_number', 'description_of_vehicle_breakdown_notes'],
				'work_allocation' => ['work_allocation_reference_number'],
				'gmt_fleet_register' => ['vehicle_registration_number'],
				'log_sheet' => ['closing_km'],
				'parts' => ['part_name_1', 'part_number_1', 'part_name', 'part_number'],
				'manufacturer' => ['part_manufacturer_name_1', 'part_manufacturer_name'],
				'service' => ['workshop_name'],
			],
			'modification_to_vehicle' => [
				'body_type' => ['type_of_vehicle'],
				'districts' => ['district'],
				'driver' => ['drivers_name_and_surname'],
				'gmt_fleet_register' => ['vehicle_registration_number'],
				'log_sheet' => ['closing_km'],
				'service' => ['job_card_number'],
			],
			'vehicle_handing_over_checklist' => [
				'log_sheet' => ['vehicle_registration_number'],
				'claim' => ['authorization_number'],
				'driver' => ['driver_name_and_surname'],
			],
			'vehicle_return_check_list' => [
				'gmt_fleet_register' => ['vehicle_registration_number'],
				'log_sheet' => ['closing_km'],
				'driver' => ['driver_name_and_surname'],
			],
			'indicates_repair_damages_found_list' => [
				'driver' => ['driver_name_and_surname'],
			],
			'identification_of_defects' => [
				'gmt_fleet_register' => ['vehicle_registration_number'],
			],
			'gate_security' => [
				'gmt_fleet_register' => ['vehicle_registration_number'],
			],
			'reception' => [
				'districts' => ['district'],
				'gmt_fleet_register' => ['vehicle_registration_number'],
			],
			'inspection_bay' => [
				'reception' => ['job_card_number'],
				'gmt_fleet_register' => ['vehicle_registration_number'],
				'work_allocation' => ['work_allocation_reference_number'],
			],
			'work_allocation' => [
				'districts' => ['district'],
				'cost_centre' => ['cost_centre'],
				'gmt_fleet_register' => ['vehicle_registration_number'],
			],
			'internal_repairs_mechanical' => [
				'districts' => ['workshop_name'],
				'reception' => ['job_card_number'],
				'work_allocation' => ['work_allocation_reference_number'],
				'gmt_fleet_register' => ['vehicle_registration_number'],
				'dealer' => ['make_of_vehicle'],
				'inspection_bay' => ['inspection_bay_lane_number'],
			],
			'external_repairs_mechanical' => [
				'service_provider' => ['service_provider_address', 'service_provider_contact_details', 'service_provider_type', 'service_provider_name'],
				'merchant' => ['merchant_address_code', 'merchant_address', 'merchant_email_address', 'merchant_contacts_details', 'merchant_name', 'merchant_code', 'merchant_type'],
				'claim' => ['instruction_note', 'authorization_number'],
				'work_allocation' => ['work_allocation_reference_number'],
				'gmt_fleet_register' => ['vehicle_registration_number'],
			],
			'internal_repairs_body' => [
				'driver' => ['driver_name_and_surname'],
				'gmt_fleet_register' => ['vehicle_registration_number'],
				'reception' => ['job_card_number'],
				'work_allocation' => ['work_allocation_reference_number'],
				'districts' => ['government_garage_name'],
			],
			'external_repairs_body' => [
				'service_provider' => ['service_provider_branch_code', 'service_provider_branch', 'service_provider_address', 'service_provider_contact_details', 'service_provider_type', 'service_provider_name'],
				'claim' => ['instruction_note'],
				'gmt_fleet_register' => ['vehicle_registration_number'],
				'merchant' => ['merchant_city', 'merchant_address_code', 'merchant_address', 'merchant_contacts_details', 'merchant_name', 'merchant_code', 'merchant_type'],
			],
			'ordering_of_spares_for_internal_repairs' => [
				'districts' => ['workshop_name'],
				'reception' => ['job_card_number'],
				'gmt_fleet_register' => ['vehicle_registration_number'],
				'parts_type' => ['part_type_8', 'part_type_7', 'part_type_6', 'part_type_5', 'part_type_4', 'part_type_3', 'part_type_2', 'part_type_1'],
				'parts' => ['manufacture_8', 'description_8', 'part_name_8', 'manufacture_7', 'description_7', 'part_name_7', 'manufacture_6', 'description_6', 'part_name_6', 'manufacture_5', 'description_5', 'part_name_5', 'manufacture_4', 'description_4', 'part_name_4', 'manufacture_3', 'description_3', 'part_name_3', 'manufacture_2', 'description_2', 'part_name_2', 'manufacture_1', 'description_1', 'part_name_1'],
				'work_allocation' => ['work_allocation_reference_number'],
			],
			'collection_of_repaired_vehicles' => [
				'reception' => ['reception_name_and_surname'],
				'driver' => ['driver_name_and_surname'],
				'districts' => ['government_garage_name'],
				'gmt_fleet_register' => ['vehicle_registration_number'],
			],
			'withdrawal_vehicle_from_operation' => [
				'gmt_fleet_register' => ['vehicle_registration_number'],
				'service' => ['date_of_service'],
			],
			'costing' => [
				'districts' => ['government_garage_name'],
				'reception' => ['job_card_number'],
				'gmt_fleet_register' => ['vehicle_registration_number'],
			],
			'billing' => [
				'districts' => ['district'],
				'costing' => ['job_card_number'],
				'gmt_fleet_register' => ['vehicle_registration_number'],
			],
			'general_control_measures' => [
				'districts' => ['district'],
				'cost_centre' => ['cost_centre'],
			],
			'movement_of_personnel_in_government_garage_and_workshops' => [
				'movement_of_personnel_in_government_garage_and_workshops' => ['vehicle_inspection'],
				'dealer' => ['make_of_vehicle'],
			],
			'service_provider' => [
				'service_provider_type' => ['service_provider_type'],
			],
			'vehicle_annual_inspection' => [
				'gmt_fleet_register' => ['register_number', 'vehicle_registration_number'],
				'departments' => ['department_name'],
				'province' => ['province'],
				'districts' => ['district'],
			],
		];

		return isset($parents[$table]) ? $parents[$table] : [];
	}
	#########################################################
	function backtick_keys_once($arr_data) {
		return array_combine(
			/* add backticks to keys */
			array_map(
				function($e) { return '`' . trim($e, '`') . '`'; }, 
				array_keys($arr_data)
			), 
			/* and combine with values */
			array_values($arr_data)
		);
	}
	#########################################################
	function calculated_fields() {
		/*
		 * calculated fields configuration array, $calc:
		 *         table => [calculated fields], ..
		 *         where calculated fields:
		 *             field => query, ...
		 */
		return [
			'gmt_fleet_register' => [
			],
			'log_sheet' => [
			],
			'vehicle_history' => [
			],
			'year_model' => [
			],
			'month' => [
			],
			'body_type' => [
			],
			'vehicle_colour' => [
			],
			'province' => [
			],
			'departments' => [
			],
			'districts' => [
			],
			'application_status' => [
			],
			'vehicle_payments' => [
			],
			'insurance_payments' => [
			],
			'authorizations' => [
			],
			'service' => [
			],
			'service_type' => [
			],
			'schedule' => [
			],
			'service_records' => [
			],
			'service_categories' => [
			],
			'service_item_type' => [
			],
			'service_item' => [
			],
			'purchase_orders' => [
			],
			'transmission' => [
			],
			'fuel_type' => [
			],
			'merchant' => [
			],
			'merchant_type' => [
			],
			'manufacturer' => [
			],
			'manufacturer_type' => [
			],
			'driver' => [
			],
			'accidents' => [
			],
			'accident_type' => [
			],
			'claim' => [
			],
			'claim_status' => [
			],
			'claim_category' => [
			],
			'cost_centre' => [
			],
			'dealer' => [
			],
			'dealer_type' => [
			],
			'tyre_log_sheet' => [
			],
			'vehicle_daily_check_list' => [
			],
			'auditor' => [
			],
			'parts' => [
			],
			'parts_type' => [
			],
			'breakdown_services' => [
			],
			'modification_to_vehicle' => [
			],
			'vehicle_handing_over_checklist' => [
			],
			'vehicle_return_check_list' => [
			],
			'indicates_repair_damages_found_list' => [
			],
			'forms' => [
			],
			'identification_of_defects' => [
			],
			'gate_security' => [
			],
			'reception' => [
			],
			'inspection_bay' => [
			],
			'work_allocation' => [
			],
			'internal_repairs_mechanical' => [
			],
			'external_repairs_mechanical' => [
			],
			'internal_repairs_body' => [
			],
			'external_repairs_body' => [
			],
			'ordering_of_spares_for_internal_repairs' => [
			],
			'collection_of_repaired_vehicles' => [
			],
			'withdrawal_vehicle_from_operation' => [
			],
			'costing' => [
			],
			'billing' => [
			],
			'general_control_measures' => [
			],
			'movement_of_personnel_in_government_garage_and_workshops' => [
			],
			'service_provider' => [
			],
			'service_provider_type' => [
			],
			'vehicle_annual_inspection' => [
			],
		];
	}
	#########################################################
	function update_calc_fields($table, $id, $formulas, $mi = false) {
		if($mi === false) $mi = getMemberInfo();
		$pk = getPKFieldName($table);
		$safe_id = makeSafe($id);
		$eo = ['silentErrors' => true];
		$caluclations_made = [];
		$replace = [
			'%ID%' => $safe_id,
			'%USERNAME%' => makeSafe($mi['username']),
			'%GROUPID%' => makeSafe($mi['groupID']),
			'%GROUP%' => makeSafe($mi['group']),
			'%TABLENAME%' => makeSafe($table),
			'%PKFIELD%' => makeSafe($pk),
		];

		foreach($formulas as $field => $query) {
			// for queries that include unicode entities, replace them with actual unicode characters
			if(preg_match('/&#\d{2,5};/', $query)) $query = entitiesToUTF8($query);

			$query = str_replace(array_keys($replace), array_values($replace), $query);
			$calc_value = sqlValue($query);
			if($calc_value  === false) continue;

			// update calculated field
			$safe_calc_value = makeSafe($calc_value);
			$update_query = "UPDATE `{$table}` SET `{$field}`='{$safe_calc_value}' " .
				"WHERE `{$pk}`='{$safe_id}'";
			$res = sql($update_query, $eo);
			if($res) $caluclations_made[] = [
				'table' => $table,
				'id' => $id,
				'field' => $field,
				'value' => $calc_value,
			];
		}

		return $caluclations_made;
	}
	#########################################################
	function latest_jquery() {
		$jquery_dir = __DIR__ . '/../resources/jquery/js';

		$files = scandir($jquery_dir, SCANDIR_SORT_DESCENDING);
		foreach($files as $entry) {
			if(preg_match('/^jquery[-0-9\.]*\.min\.js$/i', $entry))
				return $entry;
		}

		return '';
	}
	#########################################################
	function existing_value($tn, $fn, $id, $cache = true) {
		/* cache results in records[tablename][id] */
		static $record = [];

		if($cache && !empty($record[$tn][$id])) return $record[$tn][$id][$fn];
		if(!$pk = getPKFieldName($tn)) return false;

		$sid = makeSafe($id);
		$eo = ['silentErrors' => true];
		$res = sql("SELECT * FROM `{$tn}` WHERE `{$pk}`='{$sid}'", $eo);
		$record[$tn][$id] = db_fetch_assoc($res);

		return $record[$tn][$id][$fn];
	}
	#########################################################
	function checkAppRequirements() {
		global $Translation;

		$reqErrors = [];
		$minPHP = '7.0';
		$phpVersion = floatval(phpversion());

		if($phpVersion < $minPHP)
			$reqErrors[] = str_replace(
				['<PHP_VERSION>', '<minPHP>'], 
				[$phpVersion, $minPHP], 
				$Translation['old php version']
			);

		if(!function_exists('mysqli_connect'))
			$reqErrors[] = str_replace('<EXTENSION>', 'mysqli', $Translation['extension not enabled']);

		if(!function_exists('mb_convert_encoding'))
			$reqErrors[] = str_replace('<EXTENSION>', 'mbstring', $Translation['extension not enabled']);

		if(!function_exists('iconv'))
			$reqErrors[] = str_replace('<EXTENSION>', 'iconv', $Translation['extension not enabled']);

		// end of checks

		if(!count($reqErrors)) return;

		exit(
			'<div style="padding: 3em; font-size: 1.5em; color: #A94442; line-height: 150%; font-family: arial; text-rendering: optimizelegibility; text-shadow: 0px 0px 1px;">' .
				'<ul><li>' .
				implode('</li><li>', $reqErrors) .
				'</li><ul>' .
			'</div>'
		);
	}
	#########################################################
	function getRecord($table, $id) {
		// get PK fieldname
		if(!$pk = getPKFieldName($table)) return false;

		$safeId = makeSafe($id);
		$eo = ['silentErrors' => true];
		$res = sql("SELECT * FROM `{$table}` WHERE `{$pk}`='{$safeId}'", $eo);
		return db_fetch_assoc($res);
	}
	#########################################################
	function guessMySQLDateTime($dt) {
		// extract date and time, assuming a space separator
		list($date, $time, $ampm) = preg_split('/\s+/', trim($dt));

		// if date is not already in mysql format, try mysql_datetime
		if(!(preg_match('/^[0-9]{4}-(0?[1-9]|1[0-2])-([1-2][0-9]|30|31|0?[1-9])$/', $date) && strtotime($date)))
			if(!$date = mysql_datetime($date)) return false;

		// if time 
		if($t = time12(trim("$time $ampm")))
			$time = time24($t);
		elseif($t = time24($time))
			$time = $t;
		else
			$time = '';

		return trim("$date $time");
	}
	#########################################################
	function lookupQuery($tn, $lookupField) {
		/* 
			This is the query accessible from the 'Advanced' window under the 'Lookup field' tab in AppGini.
			For auto-fill lookups, this is the same as the query of the main lookup field, except the second
			column is replaced by the caption of the auto-fill lookup field.
		*/
		$lookupQuery = [
			'gmt_fleet_register' => [
				'dealer_name' => 'SELECT `dealer`.`dealer_id`, `dealer`.`dealer_name` FROM `dealer` LEFT JOIN `dealer_type` as dealer_type1 ON `dealer_type1`.`dealer_type_id`=`dealer`.`dealer_type` ORDER BY 2',
				'make_of_vehicle' => 'SELECT `dealer`.`dealer_id`, IF(CHAR_LENGTH(`dealer`.`make_of_vehicle`), CONCAT_WS(\'\', `dealer`.`make_of_vehicle`, \'   \'), \'\') FROM `dealer` LEFT JOIN `dealer_type` as dealer_type1 ON `dealer_type1`.`dealer_type_id`=`dealer`.`dealer_type` ORDER BY 2',
				'year_model_specification' => 'SELECT `year_model`.`year_model_id`, `year_model`.`year_model_specification` FROM `year_model` ORDER BY 2',
				'transmission' => 'SELECT `transmission`.`transmission_id`, `transmission`.`transmission` FROM `transmission` ORDER BY 2',
				'fuel_type' => 'SELECT `fuel_type`.`fuel_type_id`, `fuel_type`.`fuel_type` FROM `fuel_type` ORDER BY 2',
				'type_of_vehicle' => 'SELECT `body_type`.`body_type_id`, `body_type`.`type_of_vehicle` FROM `body_type` ORDER BY 2',
				'colour_of_vehicle' => 'SELECT `vehicle_colour`.`vehicle_colour_id`, `vehicle_colour`.`colour_of_vehicle` FROM `vehicle_colour` ORDER BY 2',
				'application_status' => 'SELECT `application_status`.`application_id`, `application_status`.`application_status` FROM `application_status` ORDER BY 2',
				'department_name' => 'SELECT `departments`.`department_id`, `departments`.`department_name` FROM `departments` ORDER BY 2',
				'province' => 'SELECT `province`.`province_id`, `province`.`province` FROM `province` ORDER BY 2',
				'district' => 'SELECT `districts`.`district_id`, IF(CHAR_LENGTH(`districts`.`district`) || CHAR_LENGTH(`districts`.`station`), CONCAT_WS(\'\', `districts`.`district`, \'     |     and     |     \', `districts`.`station`), \'\') FROM `districts` ORDER BY 2',
				'drivers_name_and_surname' => 'SELECT `driver`.`driver_id`, IF(CHAR_LENGTH(`driver`.`drivers_name_and_surname`) || CHAR_LENGTH(`driver`.`drivers_persal_number`), CONCAT_WS(\'\', `driver`.`drivers_name_and_surname`, \'      |    and    |         \', `driver`.`drivers_persal_number`), \'\') FROM `driver` ORDER BY 2',
				'drivers_persal_number' => 'SELECT `driver`.`driver_id`, `driver`.`drivers_persal_number` FROM `driver` ORDER BY 2',
				'department_name_of_driver' => 'SELECT `departments`.`department_id`, `departments`.`department_name` FROM `departments` ORDER BY 2',
				'drivers_contact_details' => 'SELECT `driver`.`driver_id`, `driver`.`drivers_contact_details` FROM `driver` ORDER BY 2',
			],
			'log_sheet' => [
				'vehicle_registration_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`vehicle_registration_number` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'register_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`register_number` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'make_of_vehicle' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(    CHAR_LENGTH(`dealer2`.`make_of_vehicle`), CONCAT_WS(\'\',   `dealer2`.`make_of_vehicle`, \'   \'), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'model_of_vehicle' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`model_of_vehicle` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'year_model_specification' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(    CHAR_LENGTH(`year_model1`.`year_model_specification`), CONCAT_WS(\'\',   `year_model1`.`year_model_specification`), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'colour_of_vehicle' => 'SELECT `vehicle_colour`.`vehicle_colour_id`, `vehicle_colour`.`colour_of_vehicle` FROM `vehicle_colour` ORDER BY 2',
				'engine_capacity' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`engine_capacity` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'district' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(CHAR_LENGTH(`gmt_fleet_register`.`district`) || CHAR_LENGTH(`gmt_fleet_register`.`province`), CONCAT_WS(\'\', IF(    CHAR_LENGTH(`districts1`.`district`) || CHAR_LENGTH(`districts1`.`station`), CONCAT_WS(\'\',   `districts1`.`district`, \'     |     and     |     \', `districts1`.`station`), \'\'), \'    |  and  |     \', IF(    CHAR_LENGTH(`province1`.`province`), CONCAT_WS(\'\',   `province1`.`province`), \'\')), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'drivers_name_and_surname' => 'SELECT `driver`.`driver_id`, `driver`.`drivers_name_and_surname` FROM `driver` ORDER BY 2',
				'drivers_persal_number' => 'SELECT `driver`.`driver_id`, `driver`.`drivers_persal_number` FROM `driver` ORDER BY 2',
				'fuel_type' => 'SELECT `fuel_type`.`fuel_type_id`, `fuel_type`.`fuel_type` FROM `fuel_type` ORDER BY 2',
			],
			'vehicle_history' => [
				'vehicle_registration_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(CHAR_LENGTH(`gmt_fleet_register`.`vehicle_registration_number`), CONCAT_WS(\'\', `gmt_fleet_register`.`vehicle_registration_number`, \'  \'), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'engine_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(CHAR_LENGTH(`gmt_fleet_register`.`engine_number`), CONCAT_WS(\'\', `gmt_fleet_register`.`engine_number`, \' \'), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'purchased_price' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(CHAR_LENGTH(`gmt_fleet_register`.`purchase_price`), CONCAT_WS(\'\', `gmt_fleet_register`.`purchase_price`, \' \'), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'old_registration_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(CHAR_LENGTH(`gmt_fleet_register`.`vehicle_registration_number`) || CHAR_LENGTH(`gmt_fleet_register`.`engine_number`), CONCAT_WS(\'\', `gmt_fleet_register`.`vehicle_registration_number`, \'   |  and  |   \', `gmt_fleet_register`.`engine_number`), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'renewal_of_license' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, if(`gmt_fleet_register`.`renewal_of_license`,date_format(`gmt_fleet_register`.`renewal_of_license`,\'%d/%m/%Y\'),\'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'date_of_service' => 'SELECT `service`.`service_id`, IF(    CHAR_LENGTH(if(`schedule1`.`date`,date_format(`schedule1`.`date`,\'%d/%m/%Y\'),\'\')), CONCAT_WS(\'\',   if(`schedule1`.`date`,date_format(`schedule1`.`date`,\'%d/%m/%Y\'),\'\')), \'\') FROM `service` LEFT JOIN `service_item_type` as service_item_type1 ON `service_item_type1`.`service_item_type_id`=`service`.`service_item_type` LEFT JOIN `service_categories` as service_categories1 ON `service_categories1`.`service_categories_id`=`service`.`service_category` LEFT JOIN `merchant` as merchant1 ON `merchant1`.`merchant_id`=`service`.`merchant_name` LEFT JOIN `merchant_type` as merchant_type1 ON `merchant_type1`.`merchant_type_id`=`merchant1`.`merchant_type` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`service`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`service`.`dealer_name` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`service`.`closing_km` LEFT JOIN `work_allocation` as work_allocation1 ON `work_allocation1`.`work_allocation_id`=`service`.`work_allocation_reference_number` LEFT JOIN `schedule` as schedule1 ON `schedule1`.`schedule_id`=`service`.`date_of_service` LEFT JOIN `reception` as reception1 ON `reception1`.`reception_user_id`=`service`.`receptionist` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register1`.`year_model_specification` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register1`.`type_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register1`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register1`.`department_name` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`reception1`.`district` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register10 ON `gmt_fleet_register10`.`fleet_asset_id`=`reception1`.`vehicle_registration_number` ORDER BY 2',
				'date_of_next_service' => 'SELECT `service`.`service_id`, if(`service`.`date_of_next_service`,date_format(`service`.`date_of_next_service`,\'%d/%m/%Y\'),\'\') FROM `service` LEFT JOIN `service_item_type` as service_item_type1 ON `service_item_type1`.`service_item_type_id`=`service`.`service_item_type` LEFT JOIN `service_categories` as service_categories1 ON `service_categories1`.`service_categories_id`=`service`.`service_category` LEFT JOIN `merchant` as merchant1 ON `merchant1`.`merchant_id`=`service`.`merchant_name` LEFT JOIN `merchant_type` as merchant_type1 ON `merchant_type1`.`merchant_type_id`=`merchant1`.`merchant_type` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`service`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`service`.`dealer_name` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`service`.`closing_km` LEFT JOIN `work_allocation` as work_allocation1 ON `work_allocation1`.`work_allocation_id`=`service`.`work_allocation_reference_number` LEFT JOIN `schedule` as schedule1 ON `schedule1`.`schedule_id`=`service`.`date_of_service` LEFT JOIN `reception` as reception1 ON `reception1`.`reception_user_id`=`service`.`receptionist` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register1`.`year_model_specification` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register1`.`type_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register1`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register1`.`department_name` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`reception1`.`district` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register10 ON `gmt_fleet_register10`.`fleet_asset_id`=`reception1`.`vehicle_registration_number` ORDER BY 2',
				'purchased_order_number' => 'SELECT `purchase_orders`.`purchase_order_id`, `purchase_orders`.`purchased_order_number` FROM `purchase_orders` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`purchase_orders`.`vehicle_registration_number` LEFT JOIN `manufacturer` as manufacturer1 ON `manufacturer1`.`manufacturer_id`=`purchase_orders`.`manufacturer` LEFT JOIN `service_categories` as service_categories1 ON `service_categories1`.`service_categories_id`=`purchase_orders`.`service_category` LEFT JOIN `merchant` as merchant1 ON `merchant1`.`merchant_id`=`purchase_orders`.`merchant_name` LEFT JOIN `merchant_type` as merchant_type1 ON `merchant_type1`.`merchant_type_id`=`merchant1`.`merchant_type` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`purchase_orders`.`closing_km` LEFT JOIN `parts` as parts1 ON `parts1`.`parts_id`=`purchase_orders`.`part_number_1` LEFT JOIN `parts` as parts2 ON `parts2`.`parts_id`=`purchase_orders`.`part_name_1` LEFT JOIN `manufacturer` as manufacturer2 ON `manufacturer2`.`manufacturer_id`=`purchase_orders`.`part_manufacturer_name_1` LEFT JOIN `parts` as parts3 ON `parts3`.`parts_id`=`purchase_orders`.`part_number_2` LEFT JOIN `parts` as parts4 ON `parts4`.`parts_id`=`purchase_orders`.`part_name_2` LEFT JOIN `manufacturer` as manufacturer3 ON `manufacturer3`.`manufacturer_id`=`purchase_orders`.`part_manufacturer_name_2` LEFT JOIN `parts` as parts5 ON `parts5`.`parts_id`=`purchase_orders`.`part_number_3` LEFT JOIN `manufacturer` as manufacturer4 ON `manufacturer4`.`manufacturer_id`=`purchase_orders`.`part_manufacturer_name_3` LEFT JOIN `parts` as parts6 ON `parts6`.`parts_id`=`purchase_orders`.`part_number_4` LEFT JOIN `manufacturer` as manufacturer5 ON `manufacturer5`.`manufacturer_id`=`purchase_orders`.`part_manufacturer_name_4` LEFT JOIN `parts` as parts7 ON `parts7`.`parts_id`=`purchase_orders`.`part_number_5` LEFT JOIN `manufacturer` as manufacturer6 ON `manufacturer6`.`manufacturer_id`=`purchase_orders`.`part_manufacturer_name_5` LEFT JOIN `parts` as parts8 ON `parts8`.`parts_id`=`purchase_orders`.`part_number_6` LEFT JOIN `parts` as parts9 ON `parts9`.`parts_id`=`purchase_orders`.`part_name_6` LEFT JOIN `manufacturer` as manufacturer7 ON `manufacturer7`.`manufacturer_id`=`purchase_orders`.`part_manufacturer_name_6` LEFT JOIN `parts` as parts10 ON `parts10`.`parts_id`=`purchase_orders`.`part_number_7` LEFT JOIN `parts` as parts11 ON `parts11`.`parts_id`=`purchase_orders`.`part_name_7` LEFT JOIN `manufacturer` as manufacturer8 ON `manufacturer8`.`manufacturer_id`=`purchase_orders`.`part_manufacturer_name_7` LEFT JOIN `parts` as parts12 ON `parts12`.`parts_id`=`purchase_orders`.`part_number_8` LEFT JOIN `parts` as parts13 ON `parts13`.`parts_id`=`purchase_orders`.`part_name_8` LEFT JOIN `manufacturer` as manufacturer9 ON `manufacturer9`.`manufacturer_id`=`purchase_orders`.`part_manufacturer_name_8` LEFT JOIN `service` as service1 ON `service1`.`service_id`=`purchase_orders`.`workshop_name` LEFT JOIN `service` as service2 ON `service2`.`service_id`=`purchase_orders`.`work_order_id` LEFT JOIN `reception` as reception1 ON `reception1`.`reception_user_id`=`purchase_orders`.`job_card_number` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register1`.`type_of_vehicle` ORDER BY 2',
				'claim_code' => 'SELECT `claim`.`claim_id`, `claim`.`claim_code` FROM `claim` LEFT JOIN `claim_status` as claim_status1 ON `claim_status1`.`claim_status_id`=`claim`.`claim_status` LEFT JOIN `claim_category` as claim_category1 ON `claim_category1`.`claim_category_id`=`claim`.`claim_category` LEFT JOIN `cost_centre` as cost_centre1 ON `cost_centre1`.`cost_centre_id`=`claim`.`cost_centre` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`claim`.`department_name` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`claim`.`district` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`claim`.`province` LEFT JOIN `merchant` as merchant1 ON `merchant1`.`merchant_id`=`claim`.`merchant_name` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`claim`.`vehicle_registration_number` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`claim`.`closing_km` ORDER BY 2',
				'tyre_inspection_report' => 'SELECT `tyre_log_sheet`.`tyre_log_id`, `tyre_log_sheet`.`tyre_inspection_report` FROM `tyre_log_sheet` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`tyre_log_sheet`.`vehicle_registration_number` ORDER BY 2',
				'inspection_certification_number' => 'SELECT `vehicle_daily_check_list`.`vehicle_daily_check_list_id`, `vehicle_daily_check_list`.`inspection_certification_number` FROM `vehicle_daily_check_list` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`vehicle_daily_check_list`.`vehicle_registration_number` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`vehicle_daily_check_list`.`closing_km` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`vehicle_daily_check_list`.`drivers_surname` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` ORDER BY 2',
				'document_checklist_report' => 'SELECT `vehicle_daily_check_list`.`vehicle_daily_check_list_id`, `vehicle_daily_check_list`.`document_checklist_report` FROM `vehicle_daily_check_list` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`vehicle_daily_check_list`.`vehicle_registration_number` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`vehicle_daily_check_list`.`closing_km` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`vehicle_daily_check_list`.`drivers_surname` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` ORDER BY 2',
				'next_inspection_date' => 'SELECT `vehicle_daily_check_list`.`vehicle_daily_check_list_id`, if(`vehicle_daily_check_list`.`next_inspection_date`,date_format(`vehicle_daily_check_list`.`next_inspection_date`,\'%d/%m/%Y\'),\'\') FROM `vehicle_daily_check_list` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`vehicle_daily_check_list`.`vehicle_registration_number` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`vehicle_daily_check_list`.`closing_km` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`vehicle_daily_check_list`.`drivers_surname` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` ORDER BY 2',
				'closing_km' => 'SELECT `log_sheet`.`fuel_log_sheet_id`, `log_sheet`.`closing_km` FROM `log_sheet` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`log_sheet`.`vehicle_registration_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register2 ON `gmt_fleet_register2`.`fleet_asset_id`=`log_sheet`.`register_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register3 ON `gmt_fleet_register3`.`fleet_asset_id`=`log_sheet`.`model_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`log_sheet`.`colour_of_vehicle` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`log_sheet`.`drivers_name_and_surname` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`log_sheet`.`fuel_type` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register1`.`year_model_specification` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register1`.`district` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register1`.`province` ORDER BY 2',
				'total_cost' => 'SELECT `breakdown_services`.`breakdown_id`, `breakdown_services`.`total_amount` FROM `breakdown_services` LEFT JOIN `reception` as reception1 ON `reception1`.`reception_user_id`=`breakdown_services`.`description_of_vehicle_breakdown_notes` LEFT JOIN `work_allocation` as work_allocation1 ON `work_allocation1`.`work_allocation_id`=`breakdown_services`.`work_allocation_reference_number` LEFT JOIN `reception` as reception2 ON `reception2`.`reception_user_id`=`breakdown_services`.`job_card_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`breakdown_services`.`vehicle_registration_number` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`breakdown_services`.`closing_km` LEFT JOIN `parts` as parts1 ON `parts1`.`parts_id`=`breakdown_services`.`part_number` LEFT JOIN `parts` as parts2 ON `parts2`.`parts_id`=`breakdown_services`.`part_name` LEFT JOIN `manufacturer` as manufacturer1 ON `manufacturer1`.`manufacturer_id`=`breakdown_services`.`part_manufacturer_name` LEFT JOIN `parts` as parts3 ON `parts3`.`parts_id`=`breakdown_services`.`part_number_1` LEFT JOIN `parts` as parts4 ON `parts4`.`parts_id`=`breakdown_services`.`part_name_1` LEFT JOIN `manufacturer` as manufacturer2 ON `manufacturer2`.`manufacturer_id`=`breakdown_services`.`part_manufacturer_name_1` LEFT JOIN `service` as service1 ON `service1`.`service_id`=`breakdown_services`.`workshop_name` ORDER BY 2',
			],
			'year_model' => [
			],
			'month' => [
			],
			'body_type' => [
			],
			'vehicle_colour' => [
			],
			'province' => [
			],
			'departments' => [
			],
			'districts' => [
			],
			'application_status' => [
			],
			'vehicle_payments' => [
				'vehicle_registration_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`vehicle_registration_number` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'engine_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`engine_number` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'chassis_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`chassis_number` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'make_of_vehicle' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(    CHAR_LENGTH(`dealer2`.`make_of_vehicle`), CONCAT_WS(\'\',   `dealer2`.`make_of_vehicle`, \'   \'), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'model_of_vehicle' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`model_of_vehicle` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'year_model_of_vehicle' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(    CHAR_LENGTH(`year_model1`.`year_model_specification`), CONCAT_WS(\'\',   `year_model1`.`year_model_specification`), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'type_of_vehicle' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(    CHAR_LENGTH(`body_type1`.`type_of_vehicle`), CONCAT_WS(\'\',   `body_type1`.`type_of_vehicle`), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'application_status' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(    CHAR_LENGTH(`application_status1`.`application_status`), CONCAT_WS(\'\',   `application_status1`.`application_status`), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'barcode_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`barcode_number` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'closing_km' => 'SELECT `log_sheet`.`fuel_log_sheet_id`, `log_sheet`.`closing_km` FROM `log_sheet` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`log_sheet`.`vehicle_registration_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register2 ON `gmt_fleet_register2`.`fleet_asset_id`=`log_sheet`.`register_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register3 ON `gmt_fleet_register3`.`fleet_asset_id`=`log_sheet`.`model_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`log_sheet`.`colour_of_vehicle` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`log_sheet`.`drivers_name_and_surname` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`log_sheet`.`fuel_type` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register1`.`year_model_specification` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register1`.`district` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register1`.`province` ORDER BY 2',
				'department' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(    CHAR_LENGTH(`departments1`.`department_name`), CONCAT_WS(\'\',   `departments1`.`department_name`), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'merchant_name' => 'SELECT `merchant`.`merchant_id`, IF(CHAR_LENGTH(`merchant`.`merchant_name`) || CHAR_LENGTH(`merchant`.`merchant_type`), CONCAT_WS(\'\', `merchant`.`merchant_name`, \'    |   and   |    \', IF(    CHAR_LENGTH(`merchant_type1`.`merchant_type`), CONCAT_WS(\'\',   `merchant_type1`.`merchant_type`), \'\')), \'\') FROM `merchant` LEFT JOIN `merchant_type` as merchant_type1 ON `merchant_type1`.`merchant_type_id`=`merchant`.`merchant_type` ORDER BY 2',
			],
			'insurance_payments' => [
				'vehicle_registration_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`vehicle_registration_number` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'engine_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`engine_number` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'chassis_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`chassis_number` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'make_of_vehicle' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(    CHAR_LENGTH(`dealer2`.`make_of_vehicle`), CONCAT_WS(\'\',   `dealer2`.`make_of_vehicle`, \'   \'), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'model_of_vehicle' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`model_of_vehicle` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'year_model_of_vehicle' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(    CHAR_LENGTH(`year_model1`.`year_model_specification`), CONCAT_WS(\'\',   `year_model1`.`year_model_specification`), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'type_of_vehicle' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(    CHAR_LENGTH(`vehicle_colour1`.`colour_of_vehicle`), CONCAT_WS(\'\',   `vehicle_colour1`.`colour_of_vehicle`), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'application_status' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(    CHAR_LENGTH(`application_status1`.`application_status`), CONCAT_WS(\'\',   `application_status1`.`application_status`), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'barcode_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`barcode_number` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'department' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(    CHAR_LENGTH(`departments1`.`department_name`), CONCAT_WS(\'\',   `departments1`.`department_name`), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'merchant_name' => 'SELECT `merchant`.`merchant_id`, IF(CHAR_LENGTH(`merchant`.`merchant_name`) || CHAR_LENGTH(`merchant`.`merchant_type`), CONCAT_WS(\'\', `merchant`.`merchant_name`, \'   |   and   |    \', IF(    CHAR_LENGTH(`merchant_type1`.`merchant_type`), CONCAT_WS(\'\',   `merchant_type1`.`merchant_type`), \'\')), \'\') FROM `merchant` LEFT JOIN `merchant_type` as merchant_type1 ON `merchant_type1`.`merchant_type_id`=`merchant`.`merchant_type` ORDER BY 2',
			],
			'authorizations' => [
				'job_code' => 'SELECT `claim`.`claim_id`, `claim`.`claim_code` FROM `claim` LEFT JOIN `claim_status` as claim_status1 ON `claim_status1`.`claim_status_id`=`claim`.`claim_status` LEFT JOIN `claim_category` as claim_category1 ON `claim_category1`.`claim_category_id`=`claim`.`claim_category` LEFT JOIN `cost_centre` as cost_centre1 ON `cost_centre1`.`cost_centre_id`=`claim`.`cost_centre` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`claim`.`department_name` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`claim`.`district` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`claim`.`province` LEFT JOIN `merchant` as merchant1 ON `merchant1`.`merchant_id`=`claim`.`merchant_name` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`claim`.`vehicle_registration_number` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`claim`.`closing_km` ORDER BY 2',
				'job_status' => 'SELECT `claim_status`.`claim_status_id`, `claim_status`.`claim_status` FROM `claim_status` ORDER BY 2',
				'job_category' => 'SELECT `claim_category`.`claim_category_id`, `claim_category`.`claim_category` FROM `claim_category` ORDER BY 2',
				'job_odometer' => 'SELECT `claim`.`claim_id`, IF(    CHAR_LENGTH(`log_sheet1`.`closing_km`), CONCAT_WS(\'\',   `log_sheet1`.`closing_km`), \'\') FROM `claim` LEFT JOIN `claim_status` as claim_status1 ON `claim_status1`.`claim_status_id`=`claim`.`claim_status` LEFT JOIN `claim_category` as claim_category1 ON `claim_category1`.`claim_category_id`=`claim`.`claim_category` LEFT JOIN `cost_centre` as cost_centre1 ON `cost_centre1`.`cost_centre_id`=`claim`.`cost_centre` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`claim`.`department_name` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`claim`.`district` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`claim`.`province` LEFT JOIN `merchant` as merchant1 ON `merchant1`.`merchant_id`=`claim`.`merchant_name` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`claim`.`vehicle_registration_number` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`claim`.`closing_km` ORDER BY 2',
				'instruction_note' => 'SELECT `claim`.`claim_id`, `claim`.`instruction_note` FROM `claim` LEFT JOIN `claim_status` as claim_status1 ON `claim_status1`.`claim_status_id`=`claim`.`claim_status` LEFT JOIN `claim_category` as claim_category1 ON `claim_category1`.`claim_category_id`=`claim`.`claim_category` LEFT JOIN `cost_centre` as cost_centre1 ON `cost_centre1`.`cost_centre_id`=`claim`.`cost_centre` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`claim`.`department_name` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`claim`.`district` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`claim`.`province` LEFT JOIN `merchant` as merchant1 ON `merchant1`.`merchant_id`=`claim`.`merchant_name` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`claim`.`vehicle_registration_number` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`claim`.`closing_km` ORDER BY 2',
				'pre_authorisation_date' => 'SELECT `claim`.`claim_id`, if(`claim`.`pre_authorization_date`,date_format(`claim`.`pre_authorization_date`,\'%d/%m/%Y\'),\'\') FROM `claim` LEFT JOIN `claim_status` as claim_status1 ON `claim_status1`.`claim_status_id`=`claim`.`claim_status` LEFT JOIN `claim_category` as claim_category1 ON `claim_category1`.`claim_category_id`=`claim`.`claim_category` LEFT JOIN `cost_centre` as cost_centre1 ON `cost_centre1`.`cost_centre_id`=`claim`.`cost_centre` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`claim`.`department_name` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`claim`.`district` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`claim`.`province` LEFT JOIN `merchant` as merchant1 ON `merchant1`.`merchant_id`=`claim`.`merchant_name` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`claim`.`vehicle_registration_number` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`claim`.`closing_km` ORDER BY 2',
				'vehicle_registration_number' => 'SELECT `claim`.`claim_id`, IF(CHAR_LENGTH(`claim`.`vehicle_registration_number`) || CHAR_LENGTH(`claim`.`claim_code`), CONCAT_WS(\'\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`) || CHAR_LENGTH(`gmt_fleet_register1`.`chassis_number`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`vehicle_registration_number`, \'    |   and    |  \', `gmt_fleet_register1`.`chassis_number`), \'\'), \'    |   and   |\', `claim`.`claim_code`), \'\') FROM `claim` LEFT JOIN `claim_status` as claim_status1 ON `claim_status1`.`claim_status_id`=`claim`.`claim_status` LEFT JOIN `claim_category` as claim_category1 ON `claim_category1`.`claim_category_id`=`claim`.`claim_category` LEFT JOIN `cost_centre` as cost_centre1 ON `cost_centre1`.`cost_centre_id`=`claim`.`cost_centre` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`claim`.`department_name` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`claim`.`district` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`claim`.`province` LEFT JOIN `merchant` as merchant1 ON `merchant1`.`merchant_id`=`claim`.`merchant_name` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`claim`.`vehicle_registration_number` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`claim`.`closing_km` ORDER BY 2',
				'make_of_vehicle' => 'SELECT `claim`.`claim_id`, IF(CHAR_LENGTH(`claim`.`model`) || CHAR_LENGTH(`claim`.`vehicle_registration_number`), CONCAT_WS(\'\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`model_of_vehicle`) || CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`model_of_vehicle`, \' |   and    |    \', `gmt_fleet_register1`.`vehicle_registration_number`), \'\'), \'   |    and    |   \', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`) || CHAR_LENGTH(`gmt_fleet_register1`.`chassis_number`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`vehicle_registration_number`, \'    |   and    |  \', `gmt_fleet_register1`.`chassis_number`), \'\')), \'\') FROM `claim` LEFT JOIN `claim_status` as claim_status1 ON `claim_status1`.`claim_status_id`=`claim`.`claim_status` LEFT JOIN `claim_category` as claim_category1 ON `claim_category1`.`claim_category_id`=`claim`.`claim_category` LEFT JOIN `cost_centre` as cost_centre1 ON `cost_centre1`.`cost_centre_id`=`claim`.`cost_centre` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`claim`.`department_name` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`claim`.`district` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`claim`.`province` LEFT JOIN `merchant` as merchant1 ON `merchant1`.`merchant_id`=`claim`.`merchant_name` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`claim`.`vehicle_registration_number` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`claim`.`closing_km` ORDER BY 2',
				'client' => 'SELECT `claim`.`claim_id`, IF(CHAR_LENGTH(`claim`.`department_name`) || CHAR_LENGTH(`claim`.`client_identification`), CONCAT_WS(\'\', IF(    CHAR_LENGTH(`departments1`.`department_name`), CONCAT_WS(\'\',   `departments1`.`department_name`), \'\'), \'   |    and    |   \', `claim`.`client_identification`), \'\') FROM `claim` LEFT JOIN `claim_status` as claim_status1 ON `claim_status1`.`claim_status_id`=`claim`.`claim_status` LEFT JOIN `claim_category` as claim_category1 ON `claim_category1`.`claim_category_id`=`claim`.`claim_category` LEFT JOIN `cost_centre` as cost_centre1 ON `cost_centre1`.`cost_centre_id`=`claim`.`cost_centre` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`claim`.`department_name` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`claim`.`district` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`claim`.`province` LEFT JOIN `merchant` as merchant1 ON `merchant1`.`merchant_id`=`claim`.`merchant_name` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`claim`.`vehicle_registration_number` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`claim`.`closing_km` ORDER BY 2',
				'province_name' => 'SELECT `province`.`province_id`, `province`.`province` FROM `province` ORDER BY 2',
				'merchant_code' => 'SELECT `merchant`.`merchant_id`, `merchant`.`merchant_code` FROM `merchant` LEFT JOIN `merchant_type` as merchant_type1 ON `merchant_type1`.`merchant_type_id`=`merchant`.`merchant_type` ORDER BY 2',
				'merchant_name' => 'SELECT `merchant`.`merchant_id`, IF(CHAR_LENGTH(`merchant`.`merchant_name`) || CHAR_LENGTH(`merchant`.`merchant_code`), CONCAT_WS(\'\', `merchant`.`merchant_name`, \'     |     and      |     \', `merchant`.`merchant_code`), \'\') FROM `merchant` LEFT JOIN `merchant_type` as merchant_type1 ON `merchant_type1`.`merchant_type_id`=`merchant`.`merchant_type` ORDER BY 2',
				'merchant_contact_email' => 'SELECT `merchant`.`merchant_id`, `merchant`.`merchant_contact_email` FROM `merchant` LEFT JOIN `merchant_type` as merchant_type1 ON `merchant_type1`.`merchant_type_id`=`merchant`.`merchant_type` ORDER BY 2',
				'merchant_street_address' => 'SELECT `merchant`.`merchant_id`, `merchant`.`merchant_street_address` FROM `merchant` LEFT JOIN `merchant_type` as merchant_type1 ON `merchant_type1`.`merchant_type_id`=`merchant`.`merchant_type` ORDER BY 2',
				'merchant_suburb' => 'SELECT `merchant`.`merchant_id`, `merchant`.`merchant_suburb` FROM `merchant` LEFT JOIN `merchant_type` as merchant_type1 ON `merchant_type1`.`merchant_type_id`=`merchant`.`merchant_type` ORDER BY 2',
				'merchant_city' => 'SELECT `merchant`.`merchant_id`, `merchant`.`merchant_city` FROM `merchant` LEFT JOIN `merchant_type` as merchant_type1 ON `merchant_type1`.`merchant_type_id`=`merchant`.`merchant_type` ORDER BY 2',
				'merchant_address_code' => 'SELECT `merchant`.`merchant_id`, `merchant`.`merchant_address_code` FROM `merchant` LEFT JOIN `merchant_type` as merchant_type1 ON `merchant_type1`.`merchant_type_id`=`merchant`.`merchant_type` ORDER BY 2',
				'merchant_contact_details' => 'SELECT `merchant`.`merchant_id`, `merchant`.`merchant_contact_details` FROM `merchant` LEFT JOIN `merchant_type` as merchant_type1 ON `merchant_type1`.`merchant_type_id`=`merchant`.`merchant_type` ORDER BY 2',
				'total_claim' => 'SELECT `claim`.`claim_id`, `claim`.`total_claimed` FROM `claim` LEFT JOIN `claim_status` as claim_status1 ON `claim_status1`.`claim_status_id`=`claim`.`claim_status` LEFT JOIN `claim_category` as claim_category1 ON `claim_category1`.`claim_category_id`=`claim`.`claim_category` LEFT JOIN `cost_centre` as cost_centre1 ON `cost_centre1`.`cost_centre_id`=`claim`.`cost_centre` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`claim`.`department_name` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`claim`.`district` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`claim`.`province` LEFT JOIN `merchant` as merchant1 ON `merchant1`.`merchant_id`=`claim`.`merchant_name` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`claim`.`vehicle_registration_number` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`claim`.`closing_km` ORDER BY 2',
				'total_authorised' => 'SELECT `claim`.`claim_id`, `claim`.`total_authorized` FROM `claim` LEFT JOIN `claim_status` as claim_status1 ON `claim_status1`.`claim_status_id`=`claim`.`claim_status` LEFT JOIN `claim_category` as claim_category1 ON `claim_category1`.`claim_category_id`=`claim`.`claim_category` LEFT JOIN `cost_centre` as cost_centre1 ON `cost_centre1`.`cost_centre_id`=`claim`.`cost_centre` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`claim`.`department_name` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`claim`.`district` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`claim`.`province` LEFT JOIN `merchant` as merchant1 ON `merchant1`.`merchant_id`=`claim`.`merchant_name` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`claim`.`vehicle_registration_number` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`claim`.`closing_km` ORDER BY 2',
				'authorization_number' => 'SELECT `claim`.`claim_id`, IF(CHAR_LENGTH(`claim`.`authorization_number`) || CHAR_LENGTH(`claim`.`claim_code`), CONCAT_WS(\'\', `claim`.`authorization_number`, \'     |   and   |     \', `claim`.`claim_code`), \'\') FROM `claim` LEFT JOIN `claim_status` as claim_status1 ON `claim_status1`.`claim_status_id`=`claim`.`claim_status` LEFT JOIN `claim_category` as claim_category1 ON `claim_category1`.`claim_category_id`=`claim`.`claim_category` LEFT JOIN `cost_centre` as cost_centre1 ON `cost_centre1`.`cost_centre_id`=`claim`.`cost_centre` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`claim`.`department_name` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`claim`.`district` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`claim`.`province` LEFT JOIN `merchant` as merchant1 ON `merchant1`.`merchant_id`=`claim`.`merchant_name` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`claim`.`vehicle_registration_number` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`claim`.`closing_km` ORDER BY 2',
			],
			'service' => [
				'service_item_type' => 'SELECT `service_item_type`.`service_item_type_id`, `service_item_type`.`service_item_type` FROM `service_item_type` ORDER BY 2',
				'service_category' => 'SELECT `service_categories`.`service_categories_id`, `service_categories`.`service_category` FROM `service_categories` ORDER BY 2',
				'merchant_name' => 'SELECT `merchant`.`merchant_id`, IF(CHAR_LENGTH(`merchant`.`merchant_name`) || CHAR_LENGTH(`merchant`.`merchant_type`), CONCAT_WS(\'\', `merchant`.`merchant_name`, \'    |   and   |    \', IF(    CHAR_LENGTH(`merchant_type1`.`merchant_type`), CONCAT_WS(\'\',   `merchant_type1`.`merchant_type`), \'\')), \'\') FROM `merchant` LEFT JOIN `merchant_type` as merchant_type1 ON `merchant_type1`.`merchant_type_id`=`merchant`.`merchant_type` ORDER BY 2',
				'vehicle_registration_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`vehicle_registration_number` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'engine_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`engine_number` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'chassis_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(CHAR_LENGTH(`gmt_fleet_register`.`chassis_number`) || CHAR_LENGTH(`gmt_fleet_register`.`vehicle_registration_number`), CONCAT_WS(\'\', `gmt_fleet_register`.`chassis_number`, \' |  and  |     \', `gmt_fleet_register`.`vehicle_registration_number`), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'dealer_name' => 'SELECT `dealer`.`dealer_id`, `dealer`.`dealer_name` FROM `dealer` LEFT JOIN `dealer_type` as dealer_type1 ON `dealer_type1`.`dealer_type_id`=`dealer`.`dealer_type` ORDER BY 2',
				'make_of_vehicle' => 'SELECT `dealer`.`dealer_id`, IF(CHAR_LENGTH(`dealer`.`make_of_vehicle`), CONCAT_WS(\'\', `dealer`.`make_of_vehicle`, \'   \'), \'\') FROM `dealer` LEFT JOIN `dealer_type` as dealer_type1 ON `dealer_type1`.`dealer_type_id`=`dealer`.`dealer_type` ORDER BY 2',
				'model_of_vehicle' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`model_of_vehicle` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'year_model_of_vehicle' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(    CHAR_LENGTH(`year_model1`.`year_model_specification`), CONCAT_WS(\'\',   `year_model1`.`year_model_specification`), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'type_of_vehicle' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(    CHAR_LENGTH(`body_type1`.`type_of_vehicle`), CONCAT_WS(\'\',   `body_type1`.`type_of_vehicle`), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'closing_km' => 'SELECT `log_sheet`.`fuel_log_sheet_id`, IF(CHAR_LENGTH(`log_sheet`.`closing_km`), CONCAT_WS(\'\', `log_sheet`.`closing_km`, \' \'), \'\') FROM `log_sheet` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`log_sheet`.`vehicle_registration_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register2 ON `gmt_fleet_register2`.`fleet_asset_id`=`log_sheet`.`register_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register3 ON `gmt_fleet_register3`.`fleet_asset_id`=`log_sheet`.`model_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`log_sheet`.`colour_of_vehicle` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`log_sheet`.`drivers_name_and_surname` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`log_sheet`.`fuel_type` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register1`.`year_model_specification` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register1`.`district` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register1`.`province` ORDER BY 2',
				'application_status' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(    CHAR_LENGTH(`application_status1`.`application_status`), CONCAT_WS(\'\',   `application_status1`.`application_status`), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'work_allocation_reference_number' => 'SELECT `work_allocation`.`work_allocation_id`, `work_allocation`.`work_allocation_reference_number` FROM `work_allocation` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`work_allocation`.`district` LEFT JOIN `cost_centre` as cost_centre1 ON `cost_centre1`.`cost_centre_id`=`work_allocation`.`cost_centre` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`work_allocation`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` ORDER BY 2',
				'barcode_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`barcode_number` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'department' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(    CHAR_LENGTH(`departments1`.`department_name`), CONCAT_WS(\'\',   `departments1`.`department_name`), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'date_of_service' => 'SELECT `schedule`.`schedule_id`, if(`schedule`.`date`,date_format(`schedule`.`date`,\'%d/%m/%Y\'),\'\') FROM `schedule` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`schedule`.`user_name_and_surname` LEFT JOIN `service_item_type` as service_item_type1 ON `service_item_type1`.`service_item_type_id`=`schedule`.`service_item_type` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register2 ON `gmt_fleet_register2`.`fleet_asset_id`=`schedule`.`vehicle_registration_number` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`schedule`.`closing_km` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`schedule`.`workshop_name` ORDER BY 2',
				'time' => 'SELECT `schedule`.`schedule_id`, `schedule`.`time` FROM `schedule` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`schedule`.`user_name_and_surname` LEFT JOIN `service_item_type` as service_item_type1 ON `service_item_type1`.`service_item_type_id`=`schedule`.`service_item_type` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register2 ON `gmt_fleet_register2`.`fleet_asset_id`=`schedule`.`vehicle_registration_number` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`schedule`.`closing_km` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`schedule`.`workshop_name` ORDER BY 2',
				'receptionist' => 'SELECT `reception`.`reception_user_id`, IF(CHAR_LENGTH(`reception`.`reception_name_and_surname`) || CHAR_LENGTH(`reception`.`reception_persal_number`), CONCAT_WS(\'\', `reception`.`reception_name_and_surname`, \'     |    and     |     \', `reception`.`reception_persal_number`), \'\') FROM `reception` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`reception`.`district` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`reception`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` ORDER BY 2',
				'receptionist_contact_email' => 'SELECT `reception`.`reception_user_id`, IF(CHAR_LENGTH(`reception`.`reception_email_address`) || CHAR_LENGTH(`reception`.`reception_contact_details`), CONCAT_WS(\'\', `reception`.`reception_email_address`, \'     |     and      |    \', `reception`.`reception_contact_details`), \'\') FROM `reception` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`reception`.`district` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`reception`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` ORDER BY 2',
				'workshop_name' => 'SELECT `reception`.`reception_user_id`, IF(CHAR_LENGTH(`reception`.`district`), CONCAT_WS(\'\', IF(    CHAR_LENGTH(`districts1`.`district`), CONCAT_WS(\'\',   `districts1`.`district`), \'\'), \' \'), \'\') FROM `reception` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`reception`.`district` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`reception`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` ORDER BY 2',
				'job_card_number' => 'SELECT `reception`.`reception_user_id`, IF(CHAR_LENGTH(`reception`.`job_card_number`) || CHAR_LENGTH(`reception`.`vehicle_registration_number`), CONCAT_WS(\'\', `reception`.`job_card_number`, IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`vehicle_registration_number`), \'\')), \'\') FROM `reception` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`reception`.`district` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`reception`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` ORDER BY 2',
			],
			'service_type' => [
				'service_item_type' => 'SELECT `service_item_type`.`service_item_type_id`, `service_item_type`.`service_item_type` FROM `service_item_type` ORDER BY 2',
				'service_category' => 'SELECT `service_categories`.`service_categories_id`, `service_categories`.`service_category` FROM `service_categories` ORDER BY 2',
			],
			'schedule' => [
				'user_name_and_surname' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`user_name_and_surname` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'user_contact_email' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`user_contact_email` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'service_item_type' => 'SELECT `service_item_type`.`service_item_type_id`, IF(CHAR_LENGTH(`service_item_type`.`service_item_type`), CONCAT_WS(\'\', `service_item_type`.`service_item_type`, \'  \'), \'\') FROM `service_item_type` ORDER BY 2',
				'service_item_type_code' => 'SELECT `service_item_type`.`service_item_type_id`, `service_item_type`.`service_item_type_code` FROM `service_item_type` ORDER BY 2',
				'vehicle_registration_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`vehicle_registration_number` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'engine_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`engine_number` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'closing_km' => 'SELECT `log_sheet`.`fuel_log_sheet_id`, IF(CHAR_LENGTH(`log_sheet`.`closing_km`), CONCAT_WS(\'\', `log_sheet`.`closing_km`, \' \'), \'\') FROM `log_sheet` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`log_sheet`.`vehicle_registration_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register2 ON `gmt_fleet_register2`.`fleet_asset_id`=`log_sheet`.`register_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register3 ON `gmt_fleet_register3`.`fleet_asset_id`=`log_sheet`.`model_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`log_sheet`.`colour_of_vehicle` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`log_sheet`.`drivers_name_and_surname` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`log_sheet`.`fuel_type` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register1`.`year_model_specification` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register1`.`district` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register1`.`province` ORDER BY 2',
				'workshop_name' => 'SELECT `districts`.`district_id`, IF(CHAR_LENGTH(`districts`.`station`) || CHAR_LENGTH(`districts`.`district`), CONCAT_WS(\'\', `districts`.`station`, \'      |     and      |     \', `districts`.`district`), \'\') FROM `districts` ORDER BY 2',
			],
			'service_records' => [
				'vehicle' => 'SELECT `service`.`service_id`, IF(CHAR_LENGTH(`service`.`vehicle_registration_number`) || CHAR_LENGTH(`service`.`engine_number`), CONCAT_WS(\'\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`vehicle_registration_number`), \'\'), \'  |     and     |     \', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`engine_number`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`engine_number`), \'\')), \'\') FROM `service` LEFT JOIN `service_item_type` as service_item_type1 ON `service_item_type1`.`service_item_type_id`=`service`.`service_item_type` LEFT JOIN `service_categories` as service_categories1 ON `service_categories1`.`service_categories_id`=`service`.`service_category` LEFT JOIN `merchant` as merchant1 ON `merchant1`.`merchant_id`=`service`.`merchant_name` LEFT JOIN `merchant_type` as merchant_type1 ON `merchant_type1`.`merchant_type_id`=`merchant1`.`merchant_type` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`service`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`service`.`dealer_name` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`service`.`closing_km` LEFT JOIN `work_allocation` as work_allocation1 ON `work_allocation1`.`work_allocation_id`=`service`.`work_allocation_reference_number` LEFT JOIN `schedule` as schedule1 ON `schedule1`.`schedule_id`=`service`.`date_of_service` LEFT JOIN `reception` as reception1 ON `reception1`.`reception_user_id`=`service`.`receptionist` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register1`.`year_model_specification` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register1`.`type_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register1`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register1`.`department_name` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`reception1`.`district` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register10 ON `gmt_fleet_register10`.`fleet_asset_id`=`reception1`.`vehicle_registration_number` ORDER BY 2',
			],
			'service_categories' => [
			],
			'service_item_type' => [
			],
			'service_item' => [
			],
			'purchase_orders' => [
				'vehicle_registration_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(CHAR_LENGTH(`gmt_fleet_register`.`vehicle_registration_number`), CONCAT_WS(\'\', `gmt_fleet_register`.`vehicle_registration_number`, \' \'), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'type_of_vehicle' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(    CHAR_LENGTH(`body_type1`.`type_of_vehicle`), CONCAT_WS(\'\',   `body_type1`.`type_of_vehicle`), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'manufacturer' => 'SELECT `manufacturer`.`manufacturer_id`, `manufacturer`.`manufacturer_name` FROM `manufacturer` LEFT JOIN `manufacturer_type` as manufacturer_type1 ON `manufacturer_type1`.`manufacturer_type_id`=`manufacturer`.`manufacturer_type` ORDER BY 2',
				'service_category' => 'SELECT `service_categories`.`service_categories_id`, `service_categories`.`service_category` FROM `service_categories` ORDER BY 2',
				'merchant_name' => 'SELECT `merchant`.`merchant_id`, IF(CHAR_LENGTH(`merchant`.`merchant_name`) || CHAR_LENGTH(`merchant`.`merchant_type`), CONCAT_WS(\'\', `merchant`.`merchant_name`, \'    |   and   |    \', IF(    CHAR_LENGTH(`merchant_type1`.`merchant_type`), CONCAT_WS(\'\',   `merchant_type1`.`merchant_type`), \'\')), \'\') FROM `merchant` LEFT JOIN `merchant_type` as merchant_type1 ON `merchant_type1`.`merchant_type_id`=`merchant`.`merchant_type` ORDER BY 2',
				'closing_km' => 'SELECT `log_sheet`.`fuel_log_sheet_id`, IF(CHAR_LENGTH(`log_sheet`.`closing_km`) || CHAR_LENGTH(`log_sheet`.`fuel_log_sheet_id`), CONCAT_WS(\'\', `log_sheet`.`closing_km`, \'      |    and    |    \', `log_sheet`.`fuel_log_sheet_id`), \'\') FROM `log_sheet` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`log_sheet`.`vehicle_registration_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register2 ON `gmt_fleet_register2`.`fleet_asset_id`=`log_sheet`.`register_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register3 ON `gmt_fleet_register3`.`fleet_asset_id`=`log_sheet`.`model_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`log_sheet`.`colour_of_vehicle` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`log_sheet`.`drivers_name_and_surname` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`log_sheet`.`fuel_type` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register1`.`year_model_specification` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register1`.`district` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register1`.`province` ORDER BY 2',
				'part_number_1' => 'SELECT `parts`.`parts_id`, `parts`.`part_number` FROM `parts` LEFT JOIN `parts_type` as parts_type1 ON `parts_type1`.`part_type_id`=`parts`.`part_type` LEFT JOIN `manufacturer` as manufacturer1 ON `manufacturer1`.`manufacturer_id`=`parts`.`manufacturer` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`parts`.`dealer` ORDER BY 2',
				'part_name_1' => 'SELECT `parts`.`parts_id`, `parts`.`part_name` FROM `parts` LEFT JOIN `parts_type` as parts_type1 ON `parts_type1`.`part_type_id`=`parts`.`part_type` LEFT JOIN `manufacturer` as manufacturer1 ON `manufacturer1`.`manufacturer_id`=`parts`.`manufacturer` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`parts`.`dealer` ORDER BY 2',
				'part_manufacturer_name_1' => 'SELECT `manufacturer`.`manufacturer_id`, `manufacturer`.`manufacturer_name` FROM `manufacturer` LEFT JOIN `manufacturer_type` as manufacturer_type1 ON `manufacturer_type1`.`manufacturer_type_id`=`manufacturer`.`manufacturer_type` ORDER BY 2',
				'part_number_2' => 'SELECT `parts`.`parts_id`, `parts`.`part_number` FROM `parts` LEFT JOIN `parts_type` as parts_type1 ON `parts_type1`.`part_type_id`=`parts`.`part_type` LEFT JOIN `manufacturer` as manufacturer1 ON `manufacturer1`.`manufacturer_id`=`parts`.`manufacturer` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`parts`.`dealer` ORDER BY 2',
				'part_name_2' => 'SELECT `parts`.`parts_id`, `parts`.`part_name` FROM `parts` LEFT JOIN `parts_type` as parts_type1 ON `parts_type1`.`part_type_id`=`parts`.`part_type` LEFT JOIN `manufacturer` as manufacturer1 ON `manufacturer1`.`manufacturer_id`=`parts`.`manufacturer` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`parts`.`dealer` ORDER BY 2',
				'part_manufacturer_name_2' => 'SELECT `manufacturer`.`manufacturer_id`, `manufacturer`.`manufacturer_name` FROM `manufacturer` LEFT JOIN `manufacturer_type` as manufacturer_type1 ON `manufacturer_type1`.`manufacturer_type_id`=`manufacturer`.`manufacturer_type` ORDER BY 2',
				'part_number_3' => 'SELECT `parts`.`parts_id`, `parts`.`part_number` FROM `parts` LEFT JOIN `parts_type` as parts_type1 ON `parts_type1`.`part_type_id`=`parts`.`part_type` LEFT JOIN `manufacturer` as manufacturer1 ON `manufacturer1`.`manufacturer_id`=`parts`.`manufacturer` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`parts`.`dealer` ORDER BY 2',
				'part_name_3' => 'SELECT `parts`.`parts_id`, `parts`.`part_name` FROM `parts` LEFT JOIN `parts_type` as parts_type1 ON `parts_type1`.`part_type_id`=`parts`.`part_type` LEFT JOIN `manufacturer` as manufacturer1 ON `manufacturer1`.`manufacturer_id`=`parts`.`manufacturer` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`parts`.`dealer` ORDER BY 2',
				'part_manufacturer_name_3' => 'SELECT `manufacturer`.`manufacturer_id`, `manufacturer`.`manufacturer_name` FROM `manufacturer` LEFT JOIN `manufacturer_type` as manufacturer_type1 ON `manufacturer_type1`.`manufacturer_type_id`=`manufacturer`.`manufacturer_type` ORDER BY 2',
				'part_number_4' => 'SELECT `parts`.`parts_id`, `parts`.`part_number` FROM `parts` LEFT JOIN `parts_type` as parts_type1 ON `parts_type1`.`part_type_id`=`parts`.`part_type` LEFT JOIN `manufacturer` as manufacturer1 ON `manufacturer1`.`manufacturer_id`=`parts`.`manufacturer` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`parts`.`dealer` ORDER BY 2',
				'part_name_4' => 'SELECT `parts`.`parts_id`, `parts`.`part_name` FROM `parts` LEFT JOIN `parts_type` as parts_type1 ON `parts_type1`.`part_type_id`=`parts`.`part_type` LEFT JOIN `manufacturer` as manufacturer1 ON `manufacturer1`.`manufacturer_id`=`parts`.`manufacturer` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`parts`.`dealer` ORDER BY 2',
				'part_manufacturer_name_4' => 'SELECT `manufacturer`.`manufacturer_id`, `manufacturer`.`manufacturer_name` FROM `manufacturer` LEFT JOIN `manufacturer_type` as manufacturer_type1 ON `manufacturer_type1`.`manufacturer_type_id`=`manufacturer`.`manufacturer_type` ORDER BY 2',
				'part_number_5' => 'SELECT `parts`.`parts_id`, `parts`.`part_number` FROM `parts` LEFT JOIN `parts_type` as parts_type1 ON `parts_type1`.`part_type_id`=`parts`.`part_type` LEFT JOIN `manufacturer` as manufacturer1 ON `manufacturer1`.`manufacturer_id`=`parts`.`manufacturer` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`parts`.`dealer` ORDER BY 2',
				'part_name_5' => 'SELECT `parts`.`parts_id`, `parts`.`part_name` FROM `parts` LEFT JOIN `parts_type` as parts_type1 ON `parts_type1`.`part_type_id`=`parts`.`part_type` LEFT JOIN `manufacturer` as manufacturer1 ON `manufacturer1`.`manufacturer_id`=`parts`.`manufacturer` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`parts`.`dealer` ORDER BY 2',
				'part_manufacturer_name_5' => 'SELECT `manufacturer`.`manufacturer_id`, `manufacturer`.`manufacturer_name` FROM `manufacturer` LEFT JOIN `manufacturer_type` as manufacturer_type1 ON `manufacturer_type1`.`manufacturer_type_id`=`manufacturer`.`manufacturer_type` ORDER BY 2',
				'part_number_6' => 'SELECT `parts`.`parts_id`, `parts`.`part_number` FROM `parts` LEFT JOIN `parts_type` as parts_type1 ON `parts_type1`.`part_type_id`=`parts`.`part_type` LEFT JOIN `manufacturer` as manufacturer1 ON `manufacturer1`.`manufacturer_id`=`parts`.`manufacturer` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`parts`.`dealer` ORDER BY 2',
				'part_name_6' => 'SELECT `parts`.`parts_id`, `parts`.`part_name` FROM `parts` LEFT JOIN `parts_type` as parts_type1 ON `parts_type1`.`part_type_id`=`parts`.`part_type` LEFT JOIN `manufacturer` as manufacturer1 ON `manufacturer1`.`manufacturer_id`=`parts`.`manufacturer` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`parts`.`dealer` ORDER BY 2',
				'part_manufacturer_name_6' => 'SELECT `manufacturer`.`manufacturer_id`, `manufacturer`.`manufacturer_name` FROM `manufacturer` LEFT JOIN `manufacturer_type` as manufacturer_type1 ON `manufacturer_type1`.`manufacturer_type_id`=`manufacturer`.`manufacturer_type` ORDER BY 2',
				'part_number_7' => 'SELECT `parts`.`parts_id`, `parts`.`part_number` FROM `parts` LEFT JOIN `parts_type` as parts_type1 ON `parts_type1`.`part_type_id`=`parts`.`part_type` LEFT JOIN `manufacturer` as manufacturer1 ON `manufacturer1`.`manufacturer_id`=`parts`.`manufacturer` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`parts`.`dealer` ORDER BY 2',
				'part_name_7' => 'SELECT `parts`.`parts_id`, `parts`.`part_name` FROM `parts` LEFT JOIN `parts_type` as parts_type1 ON `parts_type1`.`part_type_id`=`parts`.`part_type` LEFT JOIN `manufacturer` as manufacturer1 ON `manufacturer1`.`manufacturer_id`=`parts`.`manufacturer` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`parts`.`dealer` ORDER BY 2',
				'part_manufacturer_name_7' => 'SELECT `manufacturer`.`manufacturer_id`, `manufacturer`.`manufacturer_name` FROM `manufacturer` LEFT JOIN `manufacturer_type` as manufacturer_type1 ON `manufacturer_type1`.`manufacturer_type_id`=`manufacturer`.`manufacturer_type` ORDER BY 2',
				'part_number_8' => 'SELECT `parts`.`parts_id`, `parts`.`part_number` FROM `parts` LEFT JOIN `parts_type` as parts_type1 ON `parts_type1`.`part_type_id`=`parts`.`part_type` LEFT JOIN `manufacturer` as manufacturer1 ON `manufacturer1`.`manufacturer_id`=`parts`.`manufacturer` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`parts`.`dealer` ORDER BY 2',
				'part_name_8' => 'SELECT `parts`.`parts_id`, `parts`.`part_number` FROM `parts` LEFT JOIN `parts_type` as parts_type1 ON `parts_type1`.`part_type_id`=`parts`.`part_type` LEFT JOIN `manufacturer` as manufacturer1 ON `manufacturer1`.`manufacturer_id`=`parts`.`manufacturer` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`parts`.`dealer` ORDER BY 2',
				'part_manufacturer_name_8' => 'SELECT `manufacturer`.`manufacturer_id`, `manufacturer`.`manufacturer_name` FROM `manufacturer` LEFT JOIN `manufacturer_type` as manufacturer_type1 ON `manufacturer_type1`.`manufacturer_type_id`=`manufacturer`.`manufacturer_type` ORDER BY 2',
				'workshop_name' => 'SELECT `service`.`service_id`, IF(    CHAR_LENGTH(`districts1`.`district`), CONCAT_WS(\'\',   `districts1`.`district`), \'\') FROM `service` LEFT JOIN `service_item_type` as service_item_type1 ON `service_item_type1`.`service_item_type_id`=`service`.`service_item_type` LEFT JOIN `service_categories` as service_categories1 ON `service_categories1`.`service_categories_id`=`service`.`service_category` LEFT JOIN `merchant` as merchant1 ON `merchant1`.`merchant_id`=`service`.`merchant_name` LEFT JOIN `merchant_type` as merchant_type1 ON `merchant_type1`.`merchant_type_id`=`merchant1`.`merchant_type` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`service`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`service`.`dealer_name` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`service`.`closing_km` LEFT JOIN `work_allocation` as work_allocation1 ON `work_allocation1`.`work_allocation_id`=`service`.`work_allocation_reference_number` LEFT JOIN `schedule` as schedule1 ON `schedule1`.`schedule_id`=`service`.`date_of_service` LEFT JOIN `reception` as reception1 ON `reception1`.`reception_user_id`=`service`.`receptionist` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register1`.`year_model_specification` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register1`.`type_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register1`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register1`.`department_name` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`reception1`.`district` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register10 ON `gmt_fleet_register10`.`fleet_asset_id`=`reception1`.`vehicle_registration_number` ORDER BY 2',
				'work_order_id' => 'SELECT `service`.`service_id`, `service`.`service_id` FROM `service` LEFT JOIN `service_item_type` as service_item_type1 ON `service_item_type1`.`service_item_type_id`=`service`.`service_item_type` LEFT JOIN `service_categories` as service_categories1 ON `service_categories1`.`service_categories_id`=`service`.`service_category` LEFT JOIN `merchant` as merchant1 ON `merchant1`.`merchant_id`=`service`.`merchant_name` LEFT JOIN `merchant_type` as merchant_type1 ON `merchant_type1`.`merchant_type_id`=`merchant1`.`merchant_type` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`service`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`service`.`dealer_name` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`service`.`closing_km` LEFT JOIN `work_allocation` as work_allocation1 ON `work_allocation1`.`work_allocation_id`=`service`.`work_allocation_reference_number` LEFT JOIN `schedule` as schedule1 ON `schedule1`.`schedule_id`=`service`.`date_of_service` LEFT JOIN `reception` as reception1 ON `reception1`.`reception_user_id`=`service`.`receptionist` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register1`.`year_model_specification` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register1`.`type_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register1`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register1`.`department_name` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`reception1`.`district` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register10 ON `gmt_fleet_register10`.`fleet_asset_id`=`reception1`.`vehicle_registration_number` ORDER BY 2',
				'job_card_number' => 'SELECT `reception`.`reception_user_id`, `reception`.`job_card_number` FROM `reception` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`reception`.`district` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`reception`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` ORDER BY 2',
			],
			'transmission' => [
			],
			'fuel_type' => [
			],
			'merchant' => [
				'merchant_type' => 'SELECT `merchant_type`.`merchant_type_id`, `merchant_type`.`merchant_type` FROM `merchant_type` ORDER BY 2',
			],
			'merchant_type' => [
			],
			'manufacturer' => [
				'manufacturer_type' => 'SELECT `manufacturer_type`.`manufacturer_type_id`, `manufacturer_type`.`manufacturer_type` FROM `manufacturer_type` ORDER BY 2',
			],
			'manufacturer_type' => [
			],
			'driver' => [
			],
			'accidents' => [
				'vehicle_registration_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(CHAR_LENGTH(`gmt_fleet_register`.`vehicle_registration_number`), CONCAT_WS(\'\', `gmt_fleet_register`.`vehicle_registration_number`, \'   \'), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'closing_km' => 'SELECT `log_sheet`.`fuel_log_sheet_id`, `log_sheet`.`closing_km` FROM `log_sheet` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`log_sheet`.`vehicle_registration_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register2 ON `gmt_fleet_register2`.`fleet_asset_id`=`log_sheet`.`register_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register3 ON `gmt_fleet_register3`.`fleet_asset_id`=`log_sheet`.`model_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`log_sheet`.`colour_of_vehicle` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`log_sheet`.`drivers_name_and_surname` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`log_sheet`.`fuel_type` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register1`.`year_model_specification` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register1`.`district` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register1`.`province` ORDER BY 2',
				'drivers_surname' => 'SELECT `driver`.`driver_id`, IF(CHAR_LENGTH(`driver`.`drivers_name_and_surname`) || CHAR_LENGTH(`driver`.`drivers_persal_number`), CONCAT_WS(\'\', `driver`.`drivers_name_and_surname`, \'    |    and    |   \', `driver`.`drivers_persal_number`), \'\') FROM `driver` ORDER BY 2',
				'drivers_contact_details' => 'SELECT `driver`.`driver_id`, IF(CHAR_LENGTH(`driver`.`drivers_name_and_surname`) || CHAR_LENGTH(`driver`.`drivers_email_address`), CONCAT_WS(\'\', `driver`.`drivers_name_and_surname`, \'     |   and    |   \', `driver`.`drivers_email_address`), \'\') FROM `driver` ORDER BY 2',
				'dealer_name' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(    CHAR_LENGTH(`dealer2`.`make_of_vehicle`), CONCAT_WS(\'\',   `dealer2`.`make_of_vehicle`, \'   \'), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'model_of_vehicle' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`model_of_vehicle` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'district' => 'SELECT `districts`.`district_id`, `districts`.`district` FROM `districts` ORDER BY 2',
				'location' => 'SELECT `districts`.`district_id`, IF(CHAR_LENGTH(`districts`.`station`), CONCAT_WS(\'\', `districts`.`station`, \'   |  and   |   \'), \'\') FROM `districts` ORDER BY 2',
			],
			'accident_type' => [
			],
			'claim' => [
				'claim_status' => 'SELECT `claim_status`.`claim_status_id`, `claim_status`.`claim_status` FROM `claim_status` ORDER BY 2',
				'claim_category' => 'SELECT `claim_category`.`claim_category_id`, `claim_category`.`claim_category` FROM `claim_category` ORDER BY 2',
				'cost_centre' => 'SELECT `cost_centre`.`cost_centre_id`, `cost_centre`.`cost_centre` FROM `cost_centre` ORDER BY 2',
				'department_name' => 'SELECT `departments`.`department_id`, `departments`.`department_name` FROM `departments` ORDER BY 2',
				'district' => 'SELECT `districts`.`district_id`, `districts`.`district` FROM `districts` ORDER BY 2',
				'province' => 'SELECT `province`.`province_id`, `province`.`province` FROM `province` ORDER BY 2',
				'merchant_name' => 'SELECT `merchant`.`merchant_id`, IF(CHAR_LENGTH(`merchant`.`merchant_name`) || CHAR_LENGTH(`merchant`.`merchant_code`), CONCAT_WS(\'\', `merchant`.`merchant_name`, \'     |   and    |   \', `merchant`.`merchant_code`), \'\') FROM `merchant` LEFT JOIN `merchant_type` as merchant_type1 ON `merchant_type1`.`merchant_type_id`=`merchant`.`merchant_type` ORDER BY 2',
				'vehicle_registration_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(CHAR_LENGTH(`gmt_fleet_register`.`vehicle_registration_number`) || CHAR_LENGTH(`gmt_fleet_register`.`chassis_number`), CONCAT_WS(\'\', `gmt_fleet_register`.`vehicle_registration_number`, \'    |   and    |  \', `gmt_fleet_register`.`chassis_number`), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'model' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(CHAR_LENGTH(`gmt_fleet_register`.`model_of_vehicle`) || CHAR_LENGTH(`gmt_fleet_register`.`vehicle_registration_number`), CONCAT_WS(\'\', `gmt_fleet_register`.`model_of_vehicle`, \' |   and    |    \', `gmt_fleet_register`.`vehicle_registration_number`), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'closing_km' => 'SELECT `log_sheet`.`fuel_log_sheet_id`, `log_sheet`.`closing_km` FROM `log_sheet` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`log_sheet`.`vehicle_registration_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register2 ON `gmt_fleet_register2`.`fleet_asset_id`=`log_sheet`.`register_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register3 ON `gmt_fleet_register3`.`fleet_asset_id`=`log_sheet`.`model_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`log_sheet`.`colour_of_vehicle` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`log_sheet`.`drivers_name_and_surname` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`log_sheet`.`fuel_type` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register1`.`year_model_specification` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register1`.`district` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register1`.`province` ORDER BY 2',
			],
			'claim_status' => [
			],
			'claim_category' => [
			],
			'cost_centre' => [
			],
			'dealer' => [
				'dealer_type' => 'SELECT `dealer_type`.`dealer_type_id`, `dealer_type`.`dealer_type` FROM `dealer_type` ORDER BY 2',
			],
			'dealer_type' => [
			],
			'tyre_log_sheet' => [
				'vehicle_registration_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(CHAR_LENGTH(`gmt_fleet_register`.`vehicle_registration_number`) || CHAR_LENGTH(`gmt_fleet_register`.`engine_number`), CONCAT_WS(\'\', `gmt_fleet_register`.`vehicle_registration_number`, \'    |    and    |      \', `gmt_fleet_register`.`engine_number`), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
			],
			'vehicle_daily_check_list' => [
				'vehicle_registration_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(CHAR_LENGTH(`gmt_fleet_register`.`vehicle_registration_number`) || CHAR_LENGTH(`gmt_fleet_register`.`chassis_number`), CONCAT_WS(\'\', `gmt_fleet_register`.`vehicle_registration_number`, \'   |  and  |   \', `gmt_fleet_register`.`chassis_number`), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'make_of_vehicle' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(CHAR_LENGTH(`gmt_fleet_register`.`make_of_vehicle`) || CHAR_LENGTH(`gmt_fleet_register`.`model_of_vehicle`), CONCAT_WS(\'\', IF(    CHAR_LENGTH(`dealer2`.`make_of_vehicle`), CONCAT_WS(\'\',   `dealer2`.`make_of_vehicle`, \'   \'), \'\'), \'   |  and  |   \', `gmt_fleet_register`.`model_of_vehicle`), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'closing_km' => 'SELECT `log_sheet`.`fuel_log_sheet_id`, `log_sheet`.`closing_km` FROM `log_sheet` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`log_sheet`.`vehicle_registration_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register2 ON `gmt_fleet_register2`.`fleet_asset_id`=`log_sheet`.`register_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register3 ON `gmt_fleet_register3`.`fleet_asset_id`=`log_sheet`.`model_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`log_sheet`.`colour_of_vehicle` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`log_sheet`.`drivers_name_and_surname` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`log_sheet`.`fuel_type` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register1`.`year_model_specification` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register1`.`district` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register1`.`province` ORDER BY 2',
				'drivers_surname' => 'SELECT `driver`.`driver_id`, `driver`.`drivers_name_and_surname` FROM `driver` ORDER BY 2',
				'drivers_persal_number' => 'SELECT `driver`.`driver_id`, `driver`.`drivers_persal_number` FROM `driver` ORDER BY 2',
			],
			'auditor' => [
			],
			'parts' => [
				'part_type' => 'SELECT `parts_type`.`part_type_id`, `parts_type`.`part_type` FROM `parts_type` ORDER BY 2',
				'manufacturer' => 'SELECT `manufacturer`.`manufacturer_id`, `manufacturer`.`manufacturer_name` FROM `manufacturer` LEFT JOIN `manufacturer_type` as manufacturer_type1 ON `manufacturer_type1`.`manufacturer_type_id`=`manufacturer`.`manufacturer_type` ORDER BY 2',
				'dealer' => 'SELECT `dealer`.`dealer_id`, `dealer`.`dealer_name` FROM `dealer` LEFT JOIN `dealer_type` as dealer_type1 ON `dealer_type1`.`dealer_type_id`=`dealer`.`dealer_type` ORDER BY 2',
			],
			'parts_type' => [
			],
			'breakdown_services' => [
				'description_of_vehicle_breakdown_notes' => 'SELECT `reception`.`reception_user_id`, `reception`.`description_of_vehicle_breakdown_notes` FROM `reception` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`reception`.`district` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`reception`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` ORDER BY 2',
				'work_allocation_reference_number' => 'SELECT `work_allocation`.`work_allocation_id`, `work_allocation`.`work_allocation_reference_number` FROM `work_allocation` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`work_allocation`.`district` LEFT JOIN `cost_centre` as cost_centre1 ON `cost_centre1`.`cost_centre_id`=`work_allocation`.`cost_centre` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`work_allocation`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` ORDER BY 2',
				'job_card_number' => 'SELECT `reception`.`reception_user_id`, `reception`.`job_card_number` FROM `reception` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`reception`.`district` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`reception`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` ORDER BY 2',
				'vehicle_registration_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(CHAR_LENGTH(`gmt_fleet_register`.`vehicle_registration_number`) || CHAR_LENGTH(`gmt_fleet_register`.`engine_number`), CONCAT_WS(\'\', `gmt_fleet_register`.`vehicle_registration_number`, \'  |   and   |     \', `gmt_fleet_register`.`engine_number`), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'engine_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(CHAR_LENGTH(`gmt_fleet_register`.`engine_number`) || CHAR_LENGTH(`gmt_fleet_register`.`chassis_number`), CONCAT_WS(\'\', `gmt_fleet_register`.`engine_number`, \'   |  and  |   \', `gmt_fleet_register`.`chassis_number`), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'closing_km' => 'SELECT `log_sheet`.`fuel_log_sheet_id`, `log_sheet`.`closing_km` FROM `log_sheet` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`log_sheet`.`vehicle_registration_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register2 ON `gmt_fleet_register2`.`fleet_asset_id`=`log_sheet`.`register_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register3 ON `gmt_fleet_register3`.`fleet_asset_id`=`log_sheet`.`model_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`log_sheet`.`colour_of_vehicle` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`log_sheet`.`drivers_name_and_surname` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`log_sheet`.`fuel_type` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register1`.`year_model_specification` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register1`.`district` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register1`.`province` ORDER BY 2',
				'part_number' => 'SELECT `parts`.`parts_id`, `parts`.`part_number` FROM `parts` LEFT JOIN `parts_type` as parts_type1 ON `parts_type1`.`part_type_id`=`parts`.`part_type` LEFT JOIN `manufacturer` as manufacturer1 ON `manufacturer1`.`manufacturer_id`=`parts`.`manufacturer` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`parts`.`dealer` ORDER BY 2',
				'part_name' => 'SELECT `parts`.`parts_id`, `parts`.`part_name` FROM `parts` LEFT JOIN `parts_type` as parts_type1 ON `parts_type1`.`part_type_id`=`parts`.`part_type` LEFT JOIN `manufacturer` as manufacturer1 ON `manufacturer1`.`manufacturer_id`=`parts`.`manufacturer` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`parts`.`dealer` ORDER BY 2',
				'part_manufacturer_name' => 'SELECT `manufacturer`.`manufacturer_id`, `manufacturer`.`manufacturer_name` FROM `manufacturer` LEFT JOIN `manufacturer_type` as manufacturer_type1 ON `manufacturer_type1`.`manufacturer_type_id`=`manufacturer`.`manufacturer_type` ORDER BY 2',
				'part_number_1' => 'SELECT `parts`.`parts_id`, `parts`.`part_number` FROM `parts` LEFT JOIN `parts_type` as parts_type1 ON `parts_type1`.`part_type_id`=`parts`.`part_type` LEFT JOIN `manufacturer` as manufacturer1 ON `manufacturer1`.`manufacturer_id`=`parts`.`manufacturer` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`parts`.`dealer` ORDER BY 2',
				'part_name_1' => 'SELECT `parts`.`parts_id`, `parts`.`part_name` FROM `parts` LEFT JOIN `parts_type` as parts_type1 ON `parts_type1`.`part_type_id`=`parts`.`part_type` LEFT JOIN `manufacturer` as manufacturer1 ON `manufacturer1`.`manufacturer_id`=`parts`.`manufacturer` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`parts`.`dealer` ORDER BY 2',
				'part_manufacturer_name_1' => 'SELECT `manufacturer`.`manufacturer_id`, `manufacturer`.`manufacturer_name` FROM `manufacturer` LEFT JOIN `manufacturer_type` as manufacturer_type1 ON `manufacturer_type1`.`manufacturer_type_id`=`manufacturer`.`manufacturer_type` ORDER BY 2',
				'workshop_name' => 'SELECT `service`.`service_id`, IF(    CHAR_LENGTH(`districts1`.`district`), CONCAT_WS(\'\',   `districts1`.`district`), \'\') FROM `service` LEFT JOIN `service_item_type` as service_item_type1 ON `service_item_type1`.`service_item_type_id`=`service`.`service_item_type` LEFT JOIN `service_categories` as service_categories1 ON `service_categories1`.`service_categories_id`=`service`.`service_category` LEFT JOIN `merchant` as merchant1 ON `merchant1`.`merchant_id`=`service`.`merchant_name` LEFT JOIN `merchant_type` as merchant_type1 ON `merchant_type1`.`merchant_type_id`=`merchant1`.`merchant_type` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`service`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`service`.`dealer_name` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`service`.`closing_km` LEFT JOIN `work_allocation` as work_allocation1 ON `work_allocation1`.`work_allocation_id`=`service`.`work_allocation_reference_number` LEFT JOIN `schedule` as schedule1 ON `schedule1`.`schedule_id`=`service`.`date_of_service` LEFT JOIN `reception` as reception1 ON `reception1`.`reception_user_id`=`service`.`receptionist` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register1`.`year_model_specification` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register1`.`type_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register1`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register1`.`department_name` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`reception1`.`district` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register10 ON `gmt_fleet_register10`.`fleet_asset_id`=`reception1`.`vehicle_registration_number` ORDER BY 2',
				'receptionist' => 'SELECT `reception`.`reception_user_id`, `reception`.`reception_name_and_surname` FROM `reception` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`reception`.`district` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`reception`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` ORDER BY 2',
				'receptionist_contact_email' => 'SELECT `reception`.`reception_user_id`, `reception`.`reception_email_address` FROM `reception` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`reception`.`district` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`reception`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` ORDER BY 2',
			],
			'modification_to_vehicle' => [
				'type_of_vehicle' => 'SELECT `body_type`.`body_type_id`, `body_type`.`type_of_vehicle` FROM `body_type` ORDER BY 2',
				'district' => 'SELECT `districts`.`district_id`, `districts`.`district` FROM `districts` ORDER BY 2',
				'location' => 'SELECT `districts`.`district_id`, IF(CHAR_LENGTH(`districts`.`station`), CONCAT_WS(\'\', `districts`.`station`, \'   |  and   |   \'), \'\') FROM `districts` ORDER BY 2',
				'drivers_name_and_surname' => 'SELECT `driver`.`driver_id`, IF(CHAR_LENGTH(`driver`.`drivers_name_and_surname`) || CHAR_LENGTH(`driver`.`drivers_email_address`), CONCAT_WS(\'\', `driver`.`drivers_name_and_surname`, \'   |  and   |  \', `driver`.`drivers_email_address`), \'\') FROM `driver` ORDER BY 2',
				'drivers_persal_number' => 'SELECT `driver`.`driver_id`, `driver`.`drivers_persal_number` FROM `driver` ORDER BY 2',
				'drivers_contact_details' => 'SELECT `driver`.`driver_id`, IF(CHAR_LENGTH(`driver`.`drivers_contact_details`) || CHAR_LENGTH(`driver`.`drivers_email_address`), CONCAT_WS(\'\', `driver`.`drivers_contact_details`, \'    |   and    | \', `driver`.`drivers_email_address`), \'\') FROM `driver` ORDER BY 2',
				'vehicle_registration_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(CHAR_LENGTH(`gmt_fleet_register`.`vehicle_registration_number`) || CHAR_LENGTH(`gmt_fleet_register`.`chassis_number`), CONCAT_WS(\'\', `gmt_fleet_register`.`vehicle_registration_number`, \'   |  and  |   \', `gmt_fleet_register`.`chassis_number`), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'make_of_vehicle' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(CHAR_LENGTH(`gmt_fleet_register`.`make_of_vehicle`) || CHAR_LENGTH(`gmt_fleet_register`.`model_of_vehicle`), CONCAT_WS(\'\', IF(    CHAR_LENGTH(`dealer2`.`make_of_vehicle`), CONCAT_WS(\'\',   `dealer2`.`make_of_vehicle`, \'   \'), \'\'), \'   |  and  |   \', `gmt_fleet_register`.`model_of_vehicle`), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'model_of_vehicle' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(CHAR_LENGTH(`gmt_fleet_register`.`model_of_vehicle`) || CHAR_LENGTH(`gmt_fleet_register`.`chassis_number`), CONCAT_WS(\'\', `gmt_fleet_register`.`model_of_vehicle`, \'   |  and  |   \', `gmt_fleet_register`.`chassis_number`), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'closing_km' => 'SELECT `log_sheet`.`fuel_log_sheet_id`, `log_sheet`.`closing_km` FROM `log_sheet` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`log_sheet`.`vehicle_registration_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register2 ON `gmt_fleet_register2`.`fleet_asset_id`=`log_sheet`.`register_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register3 ON `gmt_fleet_register3`.`fleet_asset_id`=`log_sheet`.`model_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`log_sheet`.`colour_of_vehicle` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`log_sheet`.`drivers_name_and_surname` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`log_sheet`.`fuel_type` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register1`.`year_model_specification` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register1`.`district` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register1`.`province` ORDER BY 2',
				'job_card_number' => 'SELECT `service`.`service_id`, IF(    CHAR_LENGTH(`reception1`.`job_card_number`) || CHAR_LENGTH(`gmt_fleet_register10`.`vehicle_registration_number`), CONCAT_WS(\'\',   `reception1`.`job_card_number`, `gmt_fleet_register10`.`vehicle_registration_number`), \'\') FROM `service` LEFT JOIN `service_item_type` as service_item_type1 ON `service_item_type1`.`service_item_type_id`=`service`.`service_item_type` LEFT JOIN `service_categories` as service_categories1 ON `service_categories1`.`service_categories_id`=`service`.`service_category` LEFT JOIN `merchant` as merchant1 ON `merchant1`.`merchant_id`=`service`.`merchant_name` LEFT JOIN `merchant_type` as merchant_type1 ON `merchant_type1`.`merchant_type_id`=`merchant1`.`merchant_type` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`service`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`service`.`dealer_name` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`service`.`closing_km` LEFT JOIN `work_allocation` as work_allocation1 ON `work_allocation1`.`work_allocation_id`=`service`.`work_allocation_reference_number` LEFT JOIN `schedule` as schedule1 ON `schedule1`.`schedule_id`=`service`.`date_of_service` LEFT JOIN `reception` as reception1 ON `reception1`.`reception_user_id`=`service`.`receptionist` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register1`.`year_model_specification` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register1`.`type_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register1`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register1`.`department_name` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`reception1`.`district` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register10 ON `gmt_fleet_register10`.`fleet_asset_id`=`reception1`.`vehicle_registration_number` ORDER BY 2',
			],
			'vehicle_handing_over_checklist' => [
				'vehicle_registration_number' => 'SELECT `log_sheet`.`fuel_log_sheet_id`, IF(CHAR_LENGTH(`log_sheet`.`vehicle_registration_number`), CONCAT_WS(\'\', IF(    CHAR_LENGTH(`gmt_fleet_register1`.`vehicle_registration_number`), CONCAT_WS(\'\',   `gmt_fleet_register1`.`vehicle_registration_number`), \'\'), \'   \'), \'\') FROM `log_sheet` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`log_sheet`.`vehicle_registration_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register2 ON `gmt_fleet_register2`.`fleet_asset_id`=`log_sheet`.`register_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register3 ON `gmt_fleet_register3`.`fleet_asset_id`=`log_sheet`.`model_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`log_sheet`.`colour_of_vehicle` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`log_sheet`.`drivers_name_and_surname` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`log_sheet`.`fuel_type` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register1`.`year_model_specification` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register1`.`district` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register1`.`province` ORDER BY 2',
				'closing_km' => 'SELECT `log_sheet`.`fuel_log_sheet_id`, IF(CHAR_LENGTH(`log_sheet`.`closing_km`), CONCAT_WS(\'\', `log_sheet`.`closing_km`, \'     \'), \'\') FROM `log_sheet` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`log_sheet`.`vehicle_registration_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register2 ON `gmt_fleet_register2`.`fleet_asset_id`=`log_sheet`.`register_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register3 ON `gmt_fleet_register3`.`fleet_asset_id`=`log_sheet`.`model_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`log_sheet`.`colour_of_vehicle` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`log_sheet`.`drivers_name_and_surname` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`log_sheet`.`fuel_type` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register1`.`year_model_specification` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register1`.`district` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register1`.`province` ORDER BY 2',
				'make_of_vehicle' => 'SELECT `log_sheet`.`fuel_log_sheet_id`, IF(    CHAR_LENGTH(`dealer1`.`make_of_vehicle`), CONCAT_WS(\'\',   `dealer1`.`make_of_vehicle`, \'   \'), \'\') FROM `log_sheet` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`log_sheet`.`vehicle_registration_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register2 ON `gmt_fleet_register2`.`fleet_asset_id`=`log_sheet`.`register_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register3 ON `gmt_fleet_register3`.`fleet_asset_id`=`log_sheet`.`model_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`log_sheet`.`colour_of_vehicle` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`log_sheet`.`drivers_name_and_surname` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`log_sheet`.`fuel_type` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register1`.`year_model_specification` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register1`.`district` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register1`.`province` ORDER BY 2',
				'model_of_vehicle' => 'SELECT `log_sheet`.`fuel_log_sheet_id`, IF(CHAR_LENGTH(`log_sheet`.`model_of_vehicle`), CONCAT_WS(\'\', IF(    CHAR_LENGTH(`gmt_fleet_register3`.`model_of_vehicle`), CONCAT_WS(\'\',   `gmt_fleet_register3`.`model_of_vehicle`), \'\'), \' \'), \'\') FROM `log_sheet` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`log_sheet`.`vehicle_registration_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register2 ON `gmt_fleet_register2`.`fleet_asset_id`=`log_sheet`.`register_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register3 ON `gmt_fleet_register3`.`fleet_asset_id`=`log_sheet`.`model_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`log_sheet`.`colour_of_vehicle` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`log_sheet`.`drivers_name_and_surname` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`log_sheet`.`fuel_type` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register1`.`year_model_specification` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register1`.`district` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register1`.`province` ORDER BY 2',
				'authorization_number' => 'SELECT `claim`.`claim_id`, IF(CHAR_LENGTH(`claim`.`authorization_number`) || CHAR_LENGTH(`claim`.`merchant_name`), CONCAT_WS(\'\', `claim`.`authorization_number`, \'  |   and    |    \', IF(    CHAR_LENGTH(`merchant1`.`merchant_name`) || CHAR_LENGTH(`merchant1`.`merchant_code`), CONCAT_WS(\'\',   `merchant1`.`merchant_name`, \'     |   and    |   \', `merchant1`.`merchant_code`), \'\')), \'\') FROM `claim` LEFT JOIN `claim_status` as claim_status1 ON `claim_status1`.`claim_status_id`=`claim`.`claim_status` LEFT JOIN `claim_category` as claim_category1 ON `claim_category1`.`claim_category_id`=`claim`.`claim_category` LEFT JOIN `cost_centre` as cost_centre1 ON `cost_centre1`.`cost_centre_id`=`claim`.`cost_centre` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`claim`.`department_name` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`claim`.`district` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`claim`.`province` LEFT JOIN `merchant` as merchant1 ON `merchant1`.`merchant_id`=`claim`.`merchant_name` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`claim`.`vehicle_registration_number` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`claim`.`closing_km` ORDER BY 2',
				'driver_name_and_surname' => 'SELECT `driver`.`driver_id`, IF(CHAR_LENGTH(`driver`.`drivers_name_and_surname`) || CHAR_LENGTH(`driver`.`drivers_persal_number`), CONCAT_WS(\'\', `driver`.`drivers_name_and_surname`, \'    |    and    |     \', `driver`.`drivers_persal_number`), \'\') FROM `driver` ORDER BY 2',
				'driver_persal_number' => 'SELECT `driver`.`driver_id`, IF(CHAR_LENGTH(`driver`.`drivers_persal_number`) || CHAR_LENGTH(`driver`.`drivers_license_number`), CONCAT_WS(\'\', `driver`.`drivers_persal_number`, \'    |   and    |   \', `driver`.`drivers_license_number`), \'\') FROM `driver` ORDER BY 2',
			],
			'vehicle_return_check_list' => [
				'vehicle_registration_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(CHAR_LENGTH(`gmt_fleet_register`.`vehicle_registration_number`) || CHAR_LENGTH(`gmt_fleet_register`.`chassis_number`), CONCAT_WS(\'\', `gmt_fleet_register`.`vehicle_registration_number`, \'    |   and    |  \', `gmt_fleet_register`.`chassis_number`), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'make_of_vehicle' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(CHAR_LENGTH(`gmt_fleet_register`.`make_of_vehicle`) || CHAR_LENGTH(`gmt_fleet_register`.`model_of_vehicle`), CONCAT_WS(\'\', IF(    CHAR_LENGTH(`dealer2`.`make_of_vehicle`), CONCAT_WS(\'\',   `dealer2`.`make_of_vehicle`, \'   \'), \'\'), \'   |  and  |   \', `gmt_fleet_register`.`model_of_vehicle`), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'model_of_vehicle' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(CHAR_LENGTH(`gmt_fleet_register`.`model_of_vehicle`) || CHAR_LENGTH(`gmt_fleet_register`.`chassis_number`), CONCAT_WS(\'\', `gmt_fleet_register`.`model_of_vehicle`, \'   |  and  |   \', `gmt_fleet_register`.`chassis_number`), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'closing_km' => 'SELECT `log_sheet`.`fuel_log_sheet_id`, IF(CHAR_LENGTH(`log_sheet`.`closing_km`) || CHAR_LENGTH(`log_sheet`.`fuel_log_sheet_id`), CONCAT_WS(\'\', `log_sheet`.`closing_km`, \'  |    and     |     \', `log_sheet`.`fuel_log_sheet_id`), \'\') FROM `log_sheet` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`log_sheet`.`vehicle_registration_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register2 ON `gmt_fleet_register2`.`fleet_asset_id`=`log_sheet`.`register_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register3 ON `gmt_fleet_register3`.`fleet_asset_id`=`log_sheet`.`model_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`log_sheet`.`colour_of_vehicle` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`log_sheet`.`drivers_name_and_surname` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`log_sheet`.`fuel_type` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register1`.`year_model_specification` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register1`.`district` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register1`.`province` ORDER BY 2',
				'driver_name_and_surname' => 'SELECT `driver`.`driver_id`, IF(CHAR_LENGTH(`driver`.`drivers_name_and_surname`) || CHAR_LENGTH(`driver`.`drivers_persal_number`), CONCAT_WS(\'\', `driver`.`drivers_name_and_surname`, \'    |   and    |   \', `driver`.`drivers_persal_number`), \'\') FROM `driver` ORDER BY 2',
				'driver_persal_number' => 'SELECT `driver`.`driver_id`, IF(CHAR_LENGTH(`driver`.`drivers_persal_number`) || CHAR_LENGTH(`driver`.`drivers_license_number`), CONCAT_WS(\'\', `driver`.`drivers_persal_number`, \'      |    and   |   \', `driver`.`drivers_license_number`), \'\') FROM `driver` ORDER BY 2',
			],
			'indicates_repair_damages_found_list' => [
				'driver_name_and_surname' => 'SELECT `driver`.`driver_id`, IF(CHAR_LENGTH(`driver`.`drivers_name_and_surname`) || CHAR_LENGTH(`driver`.`drivers_persal_number`), CONCAT_WS(\'\', `driver`.`drivers_name_and_surname`, \'      |   and    |   \', `driver`.`drivers_persal_number`), \'\') FROM `driver` ORDER BY 2',
				'driver_persal_number' => 'SELECT `driver`.`driver_id`, IF(CHAR_LENGTH(`driver`.`drivers_persal_number`) || CHAR_LENGTH(`driver`.`drivers_license_number`), CONCAT_WS(\'\', `driver`.`drivers_persal_number`, \'      |     and     |   \', `driver`.`drivers_license_number`), \'\') FROM `driver` ORDER BY 2',
			],
			'forms' => [
			],
			'identification_of_defects' => [
				'vehicle_registration_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`vehicle_registration_number` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'engine_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`engine_number` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'make_of_vehicle' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(CHAR_LENGTH(`gmt_fleet_register`.`model_of_vehicle`) || CHAR_LENGTH(`gmt_fleet_register`.`make_of_vehicle`), CONCAT_WS(\'\', `gmt_fleet_register`.`model_of_vehicle`, \'   |    and     |     \', IF(    CHAR_LENGTH(`dealer2`.`make_of_vehicle`), CONCAT_WS(\'\',   `dealer2`.`make_of_vehicle`, \'   \'), \'\')), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
			],
			'gate_security' => [
				'vehicle_registration_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`vehicle_registration_number` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'engine_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`engine_number` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'make_of_vehicle' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(CHAR_LENGTH(`gmt_fleet_register`.`model_of_vehicle`) || CHAR_LENGTH(`gmt_fleet_register`.`make_of_vehicle`), CONCAT_WS(\'\', `gmt_fleet_register`.`model_of_vehicle`, \'   |    and     |     \', IF(    CHAR_LENGTH(`dealer2`.`make_of_vehicle`), CONCAT_WS(\'\',   `dealer2`.`make_of_vehicle`, \'   \'), \'\')), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'vehicle_colour' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(    CHAR_LENGTH(`vehicle_colour1`.`colour_of_vehicle`), CONCAT_WS(\'\',   `vehicle_colour1`.`colour_of_vehicle`), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
			],
			'reception' => [
				'district' => 'SELECT `districts`.`district_id`, `districts`.`district` FROM `districts` ORDER BY 2',
				'location' => 'SELECT `districts`.`district_id`, IF(CHAR_LENGTH(`districts`.`station`), CONCAT_WS(\'\', `districts`.`station`, \'   |  and   |   \'), \'\') FROM `districts` ORDER BY 2',
				'vehicle_registration_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`vehicle_registration_number` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'engine_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`engine_number` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'make_of_vehicle' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(CHAR_LENGTH(`gmt_fleet_register`.`model_of_vehicle`) || CHAR_LENGTH(`gmt_fleet_register`.`make_of_vehicle`), CONCAT_WS(\'\', `gmt_fleet_register`.`model_of_vehicle`, \'   |    and     |     \', IF(    CHAR_LENGTH(`dealer2`.`make_of_vehicle`), CONCAT_WS(\'\',   `dealer2`.`make_of_vehicle`, \'   \'), \'\')), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
			],
			'inspection_bay' => [
				'job_card_number' => 'SELECT `reception`.`reception_user_id`, `reception`.`job_card_number` FROM `reception` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`reception`.`district` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`reception`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` ORDER BY 2',
				'vehicle_registration_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`vehicle_registration_number` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'engine_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`engine_number` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'workshop_name' => 'SELECT `reception`.`reception_user_id`, IF(CHAR_LENGTH(`reception`.`reception_user_id`) || CHAR_LENGTH(`reception`.`job_card_number`), CONCAT_WS(\'\', `reception`.`reception_user_id`, \'      |     and      |     \', `reception`.`job_card_number`), \'\') FROM `reception` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`reception`.`district` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`reception`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` ORDER BY 2',
				'work_allocation_reference_number' => 'SELECT `work_allocation`.`work_allocation_id`, `work_allocation`.`work_allocation_reference_number` FROM `work_allocation` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`work_allocation`.`district` LEFT JOIN `cost_centre` as cost_centre1 ON `cost_centre1`.`cost_centre_id`=`work_allocation`.`cost_centre` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`work_allocation`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` ORDER BY 2',
				'make_of_vehicle' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(CHAR_LENGTH(`gmt_fleet_register`.`model_of_vehicle`) || CHAR_LENGTH(`gmt_fleet_register`.`make_of_vehicle`), CONCAT_WS(\'\', `gmt_fleet_register`.`model_of_vehicle`, \'   |    and     |     \', IF(    CHAR_LENGTH(`dealer2`.`make_of_vehicle`), CONCAT_WS(\'\',   `dealer2`.`make_of_vehicle`, \'   \'), \'\')), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
			],
			'work_allocation' => [
				'district' => 'SELECT `districts`.`district_id`, `districts`.`district` FROM `districts` ORDER BY 2',
				'location' => 'SELECT `districts`.`district_id`, IF(CHAR_LENGTH(`districts`.`station`), CONCAT_WS(\'\', `districts`.`station`, \'   |  and   |   \'), \'\') FROM `districts` ORDER BY 2',
				'cost_centre' => 'SELECT `cost_centre`.`cost_centre_id`, `cost_centre`.`cost_centre` FROM `cost_centre` ORDER BY 2',
				'vehicle_registration_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`vehicle_registration_number` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'engine_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`engine_number` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'make_of_vehicle' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(CHAR_LENGTH(`gmt_fleet_register`.`model_of_vehicle`) || CHAR_LENGTH(`gmt_fleet_register`.`make_of_vehicle`), CONCAT_WS(\'\', `gmt_fleet_register`.`model_of_vehicle`, \'   |    and     |     \', IF(    CHAR_LENGTH(`dealer2`.`make_of_vehicle`), CONCAT_WS(\'\',   `dealer2`.`make_of_vehicle`, \'   \'), \'\')), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
			],
			'internal_repairs_mechanical' => [
				'workshop_name' => 'SELECT `districts`.`district_id`, IF(CHAR_LENGTH(`districts`.`station`) || CHAR_LENGTH(`districts`.`district`), CONCAT_WS(\'\', `districts`.`station`, \'      |     and      |     \', `districts`.`district`), \'\') FROM `districts` ORDER BY 2',
				'job_card_number' => 'SELECT `reception`.`reception_user_id`, `reception`.`job_card_number` FROM `reception` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`reception`.`district` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`reception`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` ORDER BY 2',
				'work_allocation_reference_number' => 'SELECT `work_allocation`.`work_allocation_id`, `work_allocation`.`work_allocation_reference_number` FROM `work_allocation` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`work_allocation`.`district` LEFT JOIN `cost_centre` as cost_centre1 ON `cost_centre1`.`cost_centre_id`=`work_allocation`.`cost_centre` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`work_allocation`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` ORDER BY 2',
				'vehicle_registration_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`vehicle_registration_number` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'engine_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`engine_number` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'make_of_vehicle' => 'SELECT `dealer`.`dealer_id`, IF(CHAR_LENGTH(`dealer`.`make_of_vehicle`) || CHAR_LENGTH(`dealer`.`dealer_type`), CONCAT_WS(\'\', `dealer`.`make_of_vehicle`, \'   |    and     |     \', IF(    CHAR_LENGTH(`dealer_type1`.`dealer_type`), CONCAT_WS(\'\',   `dealer_type1`.`dealer_type`), \'\')), \'\') FROM `dealer` LEFT JOIN `dealer_type` as dealer_type1 ON `dealer_type1`.`dealer_type_id`=`dealer`.`dealer_type` ORDER BY 2',
				'inspection_bay_lane_number' => 'SELECT `inspection_bay`.`inspection_bay_id`, `inspection_bay`.`inspection_bay_lane_number` FROM `inspection_bay` LEFT JOIN `reception` as reception1 ON `reception1`.`reception_user_id`=`inspection_bay`.`job_card_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`inspection_bay`.`vehicle_registration_number` LEFT JOIN `work_allocation` as work_allocation1 ON `work_allocation1`.`work_allocation_id`=`inspection_bay`.`work_allocation_reference_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` ORDER BY 2',
			],
			'external_repairs_mechanical' => [
				'service_provider_name' => 'SELECT `service_provider`.`service_provider_id`, `service_provider`.`service_provider_name` FROM `service_provider` LEFT JOIN `service_provider_type` as service_provider_type1 ON `service_provider_type1`.`service_provider_type_id`=`service_provider`.`service_provider_type` ORDER BY 2',
				'service_provider_type' => 'SELECT `service_provider`.`service_provider_id`, IF(    CHAR_LENGTH(`service_provider_type1`.`service_provider_type`), CONCAT_WS(\'\',   `service_provider_type1`.`service_provider_type`), \'\') FROM `service_provider` LEFT JOIN `service_provider_type` as service_provider_type1 ON `service_provider_type1`.`service_provider_type_id`=`service_provider`.`service_provider_type` ORDER BY 2',
				'service_provider_contact_details' => 'SELECT `service_provider`.`service_provider_id`, `service_provider`.`service_provider_contact_email` FROM `service_provider` LEFT JOIN `service_provider_type` as service_provider_type1 ON `service_provider_type1`.`service_provider_type_id`=`service_provider`.`service_provider_type` ORDER BY 2',
				'service_provider_address' => 'SELECT `service_provider`.`service_provider_id`, `service_provider`.`service_provider_street_address` FROM `service_provider` LEFT JOIN `service_provider_type` as service_provider_type1 ON `service_provider_type1`.`service_provider_type_id`=`service_provider`.`service_provider_type` ORDER BY 2',
				'merchant_type' => 'SELECT `merchant`.`merchant_id`, IF(    CHAR_LENGTH(`merchant_type1`.`merchant_type`), CONCAT_WS(\'\',   `merchant_type1`.`merchant_type`), \'\') FROM `merchant` LEFT JOIN `merchant_type` as merchant_type1 ON `merchant_type1`.`merchant_type_id`=`merchant`.`merchant_type` ORDER BY 2',
				'merchant_code' => 'SELECT `merchant`.`merchant_id`, IF(CHAR_LENGTH(`merchant`.`merchant_code`) || CHAR_LENGTH(`merchant`.`merchant_name`), CONCAT_WS(\'\', `merchant`.`merchant_code`, \'    |    and     |    \', `merchant`.`merchant_name`), \'\') FROM `merchant` LEFT JOIN `merchant_type` as merchant_type1 ON `merchant_type1`.`merchant_type_id`=`merchant`.`merchant_type` ORDER BY 2',
				'merchant_name' => 'SELECT `merchant`.`merchant_id`, `merchant`.`merchant_name` FROM `merchant` LEFT JOIN `merchant_type` as merchant_type1 ON `merchant_type1`.`merchant_type_id`=`merchant`.`merchant_type` ORDER BY 2',
				'merchant_contacts_details' => 'SELECT `merchant`.`merchant_id`, `merchant`.`merchant_contact_details` FROM `merchant` LEFT JOIN `merchant_type` as merchant_type1 ON `merchant_type1`.`merchant_type_id`=`merchant`.`merchant_type` ORDER BY 2',
				'merchant_email_address' => 'SELECT `merchant`.`merchant_id`, `merchant`.`merchant_contact_email` FROM `merchant` LEFT JOIN `merchant_type` as merchant_type1 ON `merchant_type1`.`merchant_type_id`=`merchant`.`merchant_type` ORDER BY 2',
				'merchant_address' => 'SELECT `merchant`.`merchant_id`, `merchant`.`merchant_street_address` FROM `merchant` LEFT JOIN `merchant_type` as merchant_type1 ON `merchant_type1`.`merchant_type_id`=`merchant`.`merchant_type` ORDER BY 2',
				'merchant_address_code' => 'SELECT `merchant`.`merchant_id`, `merchant`.`merchant_address_code` FROM `merchant` LEFT JOIN `merchant_type` as merchant_type1 ON `merchant_type1`.`merchant_type_id`=`merchant`.`merchant_type` ORDER BY 2',
				'authorization_number' => 'SELECT `claim`.`claim_id`, IF(CHAR_LENGTH(`claim`.`authorization_number`) || CHAR_LENGTH(`claim`.`claim_code`), CONCAT_WS(\'\', `claim`.`authorization_number`, \'     |   and   |     \', `claim`.`claim_code`), \'\') FROM `claim` LEFT JOIN `claim_status` as claim_status1 ON `claim_status1`.`claim_status_id`=`claim`.`claim_status` LEFT JOIN `claim_category` as claim_category1 ON `claim_category1`.`claim_category_id`=`claim`.`claim_category` LEFT JOIN `cost_centre` as cost_centre1 ON `cost_centre1`.`cost_centre_id`=`claim`.`cost_centre` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`claim`.`department_name` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`claim`.`district` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`claim`.`province` LEFT JOIN `merchant` as merchant1 ON `merchant1`.`merchant_id`=`claim`.`merchant_name` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`claim`.`vehicle_registration_number` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`claim`.`closing_km` ORDER BY 2',
				'instruction_note' => 'SELECT `claim`.`claim_id`, IF(CHAR_LENGTH(`claim`.`instruction_note`) || CHAR_LENGTH(`claim`.`claim_code`), CONCAT_WS(\'\', `claim`.`instruction_note`, \'    |   and    |     \', `claim`.`claim_code`), \'\') FROM `claim` LEFT JOIN `claim_status` as claim_status1 ON `claim_status1`.`claim_status_id`=`claim`.`claim_status` LEFT JOIN `claim_category` as claim_category1 ON `claim_category1`.`claim_category_id`=`claim`.`claim_category` LEFT JOIN `cost_centre` as cost_centre1 ON `cost_centre1`.`cost_centre_id`=`claim`.`cost_centre` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`claim`.`department_name` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`claim`.`district` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`claim`.`province` LEFT JOIN `merchant` as merchant1 ON `merchant1`.`merchant_id`=`claim`.`merchant_name` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`claim`.`vehicle_registration_number` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`claim`.`closing_km` ORDER BY 2',
				'work_allocation_reference_number' => 'SELECT `work_allocation`.`work_allocation_id`, `work_allocation`.`work_allocation_reference_number` FROM `work_allocation` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`work_allocation`.`district` LEFT JOIN `cost_centre` as cost_centre1 ON `cost_centre1`.`cost_centre_id`=`work_allocation`.`cost_centre` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`work_allocation`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` ORDER BY 2',
				'vehicle_registration_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`vehicle_registration_number` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'engine_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`engine_number` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'make_of_vehicle' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(CHAR_LENGTH(`gmt_fleet_register`.`model_of_vehicle`) || CHAR_LENGTH(`gmt_fleet_register`.`make_of_vehicle`), CONCAT_WS(\'\', `gmt_fleet_register`.`model_of_vehicle`, \'   |    and     |     \', IF(    CHAR_LENGTH(`dealer2`.`make_of_vehicle`), CONCAT_WS(\'\',   `dealer2`.`make_of_vehicle`, \'   \'), \'\')), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
			],
			'internal_repairs_body' => [
				'driver_name_and_surname' => 'SELECT `driver`.`driver_id`, `driver`.`drivers_name_and_surname` FROM `driver` ORDER BY 2',
				'driver_persal_number' => 'SELECT `driver`.`driver_id`, `driver`.`drivers_persal_number` FROM `driver` ORDER BY 2',
				'driver_contacts_details' => 'SELECT `driver`.`driver_id`, `driver`.`drivers_contact_details` FROM `driver` ORDER BY 2',
				'driver_email_address' => 'SELECT `driver`.`driver_id`, `driver`.`drivers_email_address` FROM `driver` ORDER BY 2',
				'driver_license_code' => 'SELECT `driver`.`driver_id`, `driver`.`drivers_license_code` FROM `driver` ORDER BY 2',
				'driver_license_number' => 'SELECT `driver`.`driver_id`, `driver`.`drivers_license_number` FROM `driver` ORDER BY 2',
				'vehicle_registration_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`vehicle_registration_number` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'engine_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`engine_number` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'make_of_vehicle' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(CHAR_LENGTH(`gmt_fleet_register`.`model_of_vehicle`) || CHAR_LENGTH(`gmt_fleet_register`.`make_of_vehicle`), CONCAT_WS(\'\', `gmt_fleet_register`.`model_of_vehicle`, \'   |    and     |     \', IF(    CHAR_LENGTH(`dealer2`.`make_of_vehicle`), CONCAT_WS(\'\',   `dealer2`.`make_of_vehicle`, \'   \'), \'\')), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'job_card_number' => 'SELECT `reception`.`reception_user_id`, `reception`.`job_card_number` FROM `reception` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`reception`.`district` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`reception`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` ORDER BY 2',
				'work_allocation_reference_number' => 'SELECT `work_allocation`.`work_allocation_id`, `work_allocation`.`work_allocation_reference_number` FROM `work_allocation` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`work_allocation`.`district` LEFT JOIN `cost_centre` as cost_centre1 ON `cost_centre1`.`cost_centre_id`=`work_allocation`.`cost_centre` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`work_allocation`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` ORDER BY 2',
				'government_garage_name' => 'SELECT `districts`.`district_id`, IF(CHAR_LENGTH(`districts`.`station`) || CHAR_LENGTH(`districts`.`district`), CONCAT_WS(\'\', `districts`.`station`, \'   |     and     |    \', `districts`.`district`), \'\') FROM `districts` ORDER BY 2',
			],
			'external_repairs_body' => [
				'service_provider_name' => 'SELECT `service_provider`.`service_provider_id`, `service_provider`.`service_provider_name` FROM `service_provider` LEFT JOIN `service_provider_type` as service_provider_type1 ON `service_provider_type1`.`service_provider_type_id`=`service_provider`.`service_provider_type` ORDER BY 2',
				'service_provider_type' => 'SELECT `service_provider`.`service_provider_id`, IF(    CHAR_LENGTH(`service_provider_type1`.`service_provider_type`), CONCAT_WS(\'\',   `service_provider_type1`.`service_provider_type`), \'\') FROM `service_provider` LEFT JOIN `service_provider_type` as service_provider_type1 ON `service_provider_type1`.`service_provider_type_id`=`service_provider`.`service_provider_type` ORDER BY 2',
				'service_provider_contact_details' => 'SELECT `service_provider`.`service_provider_id`, `service_provider`.`service_provider_contact_details` FROM `service_provider` LEFT JOIN `service_provider_type` as service_provider_type1 ON `service_provider_type1`.`service_provider_type_id`=`service_provider`.`service_provider_type` ORDER BY 2',
				'service_provider_address' => 'SELECT `service_provider`.`service_provider_id`, `service_provider`.`service_provider_street_address` FROM `service_provider` LEFT JOIN `service_provider_type` as service_provider_type1 ON `service_provider_type1`.`service_provider_type_id`=`service_provider`.`service_provider_type` ORDER BY 2',
				'service_provider_branch' => 'SELECT `service_provider`.`service_provider_id`, `service_provider`.`service_provider_branch` FROM `service_provider` LEFT JOIN `service_provider_type` as service_provider_type1 ON `service_provider_type1`.`service_provider_type_id`=`service_provider`.`service_provider_type` ORDER BY 2',
				'service_provider_branch_code' => 'SELECT `service_provider`.`service_provider_id`, `service_provider`.`service_provider_branch_code` FROM `service_provider` LEFT JOIN `service_provider_type` as service_provider_type1 ON `service_provider_type1`.`service_provider_type_id`=`service_provider`.`service_provider_type` ORDER BY 2',
				'instruction_note' => 'SELECT `claim`.`claim_id`, IF(CHAR_LENGTH(`claim`.`instruction_note`) || CHAR_LENGTH(`claim`.`claim_code`), CONCAT_WS(\'\', `claim`.`instruction_note`, \'    |   and    |     \', `claim`.`claim_code`), \'\') FROM `claim` LEFT JOIN `claim_status` as claim_status1 ON `claim_status1`.`claim_status_id`=`claim`.`claim_status` LEFT JOIN `claim_category` as claim_category1 ON `claim_category1`.`claim_category_id`=`claim`.`claim_category` LEFT JOIN `cost_centre` as cost_centre1 ON `cost_centre1`.`cost_centre_id`=`claim`.`cost_centre` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`claim`.`department_name` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`claim`.`district` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`claim`.`province` LEFT JOIN `merchant` as merchant1 ON `merchant1`.`merchant_id`=`claim`.`merchant_name` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`claim`.`vehicle_registration_number` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`claim`.`closing_km` ORDER BY 2',
				'authorization_number' => 'SELECT `claim`.`claim_id`, IF(CHAR_LENGTH(`claim`.`authorization_number`) || CHAR_LENGTH(`claim`.`claim_code`), CONCAT_WS(\'\', `claim`.`authorization_number`, \'     |   and   |     \', `claim`.`claim_code`), \'\') FROM `claim` LEFT JOIN `claim_status` as claim_status1 ON `claim_status1`.`claim_status_id`=`claim`.`claim_status` LEFT JOIN `claim_category` as claim_category1 ON `claim_category1`.`claim_category_id`=`claim`.`claim_category` LEFT JOIN `cost_centre` as cost_centre1 ON `cost_centre1`.`cost_centre_id`=`claim`.`cost_centre` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`claim`.`department_name` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`claim`.`district` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`claim`.`province` LEFT JOIN `merchant` as merchant1 ON `merchant1`.`merchant_id`=`claim`.`merchant_name` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`claim`.`vehicle_registration_number` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`claim`.`closing_km` ORDER BY 2',
				'vehicle_registration_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`vehicle_registration_number` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'engine_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`engine_number` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'make_of_vehicle' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(CHAR_LENGTH(`gmt_fleet_register`.`model_of_vehicle`) || CHAR_LENGTH(`gmt_fleet_register`.`make_of_vehicle`), CONCAT_WS(\'\', `gmt_fleet_register`.`model_of_vehicle`, \'   |    and     |     \', IF(    CHAR_LENGTH(`dealer2`.`make_of_vehicle`), CONCAT_WS(\'\',   `dealer2`.`make_of_vehicle`, \'   \'), \'\')), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'vehicle_colour' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(    CHAR_LENGTH(`vehicle_colour1`.`colour_of_vehicle`), CONCAT_WS(\'\',   `vehicle_colour1`.`colour_of_vehicle`), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'merchant_type' => 'SELECT `merchant`.`merchant_id`, IF(    CHAR_LENGTH(`merchant_type1`.`merchant_type`), CONCAT_WS(\'\',   `merchant_type1`.`merchant_type`), \'\') FROM `merchant` LEFT JOIN `merchant_type` as merchant_type1 ON `merchant_type1`.`merchant_type_id`=`merchant`.`merchant_type` ORDER BY 2',
				'merchant_code' => 'SELECT `merchant`.`merchant_id`, `merchant`.`merchant_code` FROM `merchant` LEFT JOIN `merchant_type` as merchant_type1 ON `merchant_type1`.`merchant_type_id`=`merchant`.`merchant_type` ORDER BY 2',
				'merchant_name' => 'SELECT `merchant`.`merchant_id`, `merchant`.`merchant_name` FROM `merchant` LEFT JOIN `merchant_type` as merchant_type1 ON `merchant_type1`.`merchant_type_id`=`merchant`.`merchant_type` ORDER BY 2',
				'merchant_contacts_details' => 'SELECT `merchant`.`merchant_id`, `merchant`.`merchant_contact_details` FROM `merchant` LEFT JOIN `merchant_type` as merchant_type1 ON `merchant_type1`.`merchant_type_id`=`merchant`.`merchant_type` ORDER BY 2',
				'merchant_address' => 'SELECT `merchant`.`merchant_id`, `merchant`.`merchant_street_address` FROM `merchant` LEFT JOIN `merchant_type` as merchant_type1 ON `merchant_type1`.`merchant_type_id`=`merchant`.`merchant_type` ORDER BY 2',
				'merchant_address_code' => 'SELECT `merchant`.`merchant_id`, `merchant`.`merchant_address_code` FROM `merchant` LEFT JOIN `merchant_type` as merchant_type1 ON `merchant_type1`.`merchant_type_id`=`merchant`.`merchant_type` ORDER BY 2',
				'merchant_city' => 'SELECT `merchant`.`merchant_id`, `merchant`.`merchant_city` FROM `merchant` LEFT JOIN `merchant_type` as merchant_type1 ON `merchant_type1`.`merchant_type_id`=`merchant`.`merchant_type` ORDER BY 2',
			],
			'ordering_of_spares_for_internal_repairs' => [
				'workshop_name' => 'SELECT `districts`.`district_id`, IF(CHAR_LENGTH(`districts`.`station`) || CHAR_LENGTH(`districts`.`district`), CONCAT_WS(\'\', `districts`.`station`, \'      |     and      |     \', `districts`.`district`), \'\') FROM `districts` ORDER BY 2',
				'job_card_number' => 'SELECT `reception`.`reception_user_id`, `reception`.`job_card_number` FROM `reception` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`reception`.`district` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`reception`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` ORDER BY 2',
				'vehicle_registration_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`vehicle_registration_number` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'engine_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`engine_number` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'make_of_vehicle' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(CHAR_LENGTH(`gmt_fleet_register`.`model_of_vehicle`) || CHAR_LENGTH(`gmt_fleet_register`.`make_of_vehicle`), CONCAT_WS(\'\', `gmt_fleet_register`.`model_of_vehicle`, \'   |    and     |     \', IF(    CHAR_LENGTH(`dealer2`.`make_of_vehicle`), CONCAT_WS(\'\',   `dealer2`.`make_of_vehicle`, \'   \'), \'\')), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'part_type_1' => 'SELECT `parts_type`.`part_type_id`, `parts_type`.`part_type` FROM `parts_type` ORDER BY 2',
				'part_name_1' => 'SELECT `parts`.`parts_id`, `parts`.`part_name` FROM `parts` LEFT JOIN `parts_type` as parts_type1 ON `parts_type1`.`part_type_id`=`parts`.`part_type` LEFT JOIN `manufacturer` as manufacturer1 ON `manufacturer1`.`manufacturer_id`=`parts`.`manufacturer` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`parts`.`dealer` ORDER BY 2',
				'description_1' => 'SELECT `parts`.`parts_id`, `parts`.`description` FROM `parts` LEFT JOIN `parts_type` as parts_type1 ON `parts_type1`.`part_type_id`=`parts`.`part_type` LEFT JOIN `manufacturer` as manufacturer1 ON `manufacturer1`.`manufacturer_id`=`parts`.`manufacturer` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`parts`.`dealer` ORDER BY 2',
				'manufacture_1' => 'SELECT `parts`.`parts_id`, IF(    CHAR_LENGTH(`manufacturer1`.`manufacturer_name`), CONCAT_WS(\'\',   `manufacturer1`.`manufacturer_name`), \'\') FROM `parts` LEFT JOIN `parts_type` as parts_type1 ON `parts_type1`.`part_type_id`=`parts`.`part_type` LEFT JOIN `manufacturer` as manufacturer1 ON `manufacturer1`.`manufacturer_id`=`parts`.`manufacturer` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`parts`.`dealer` ORDER BY 2',
				'part_type_2' => 'SELECT `parts_type`.`part_type_id`, `parts_type`.`part_type` FROM `parts_type` ORDER BY 2',
				'part_name_2' => 'SELECT `parts`.`parts_id`, `parts`.`part_name` FROM `parts` LEFT JOIN `parts_type` as parts_type1 ON `parts_type1`.`part_type_id`=`parts`.`part_type` LEFT JOIN `manufacturer` as manufacturer1 ON `manufacturer1`.`manufacturer_id`=`parts`.`manufacturer` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`parts`.`dealer` ORDER BY 2',
				'description_2' => 'SELECT `parts`.`parts_id`, `parts`.`description` FROM `parts` LEFT JOIN `parts_type` as parts_type1 ON `parts_type1`.`part_type_id`=`parts`.`part_type` LEFT JOIN `manufacturer` as manufacturer1 ON `manufacturer1`.`manufacturer_id`=`parts`.`manufacturer` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`parts`.`dealer` ORDER BY 2',
				'manufacture_2' => 'SELECT `parts`.`parts_id`, IF(    CHAR_LENGTH(`manufacturer1`.`manufacturer_name`), CONCAT_WS(\'\',   `manufacturer1`.`manufacturer_name`), \'\') FROM `parts` LEFT JOIN `parts_type` as parts_type1 ON `parts_type1`.`part_type_id`=`parts`.`part_type` LEFT JOIN `manufacturer` as manufacturer1 ON `manufacturer1`.`manufacturer_id`=`parts`.`manufacturer` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`parts`.`dealer` ORDER BY 2',
				'part_type_3' => 'SELECT `parts_type`.`part_type_id`, `parts_type`.`part_type` FROM `parts_type` ORDER BY 2',
				'part_name_3' => 'SELECT `parts`.`parts_id`, `parts`.`part_name` FROM `parts` LEFT JOIN `parts_type` as parts_type1 ON `parts_type1`.`part_type_id`=`parts`.`part_type` LEFT JOIN `manufacturer` as manufacturer1 ON `manufacturer1`.`manufacturer_id`=`parts`.`manufacturer` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`parts`.`dealer` ORDER BY 2',
				'description_3' => 'SELECT `parts`.`parts_id`, `parts`.`description` FROM `parts` LEFT JOIN `parts_type` as parts_type1 ON `parts_type1`.`part_type_id`=`parts`.`part_type` LEFT JOIN `manufacturer` as manufacturer1 ON `manufacturer1`.`manufacturer_id`=`parts`.`manufacturer` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`parts`.`dealer` ORDER BY 2',
				'manufacture_3' => 'SELECT `parts`.`parts_id`, IF(    CHAR_LENGTH(`manufacturer1`.`manufacturer_name`), CONCAT_WS(\'\',   `manufacturer1`.`manufacturer_name`), \'\') FROM `parts` LEFT JOIN `parts_type` as parts_type1 ON `parts_type1`.`part_type_id`=`parts`.`part_type` LEFT JOIN `manufacturer` as manufacturer1 ON `manufacturer1`.`manufacturer_id`=`parts`.`manufacturer` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`parts`.`dealer` ORDER BY 2',
				'part_type_4' => 'SELECT `parts_type`.`part_type_id`, `parts_type`.`part_type` FROM `parts_type` ORDER BY 2',
				'part_name_4' => 'SELECT `parts`.`parts_id`, `parts`.`part_name` FROM `parts` LEFT JOIN `parts_type` as parts_type1 ON `parts_type1`.`part_type_id`=`parts`.`part_type` LEFT JOIN `manufacturer` as manufacturer1 ON `manufacturer1`.`manufacturer_id`=`parts`.`manufacturer` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`parts`.`dealer` ORDER BY 2',
				'description_4' => 'SELECT `parts`.`parts_id`, `parts`.`description` FROM `parts` LEFT JOIN `parts_type` as parts_type1 ON `parts_type1`.`part_type_id`=`parts`.`part_type` LEFT JOIN `manufacturer` as manufacturer1 ON `manufacturer1`.`manufacturer_id`=`parts`.`manufacturer` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`parts`.`dealer` ORDER BY 2',
				'manufacture_4' => 'SELECT `parts`.`parts_id`, IF(    CHAR_LENGTH(`manufacturer1`.`manufacturer_name`), CONCAT_WS(\'\',   `manufacturer1`.`manufacturer_name`), \'\') FROM `parts` LEFT JOIN `parts_type` as parts_type1 ON `parts_type1`.`part_type_id`=`parts`.`part_type` LEFT JOIN `manufacturer` as manufacturer1 ON `manufacturer1`.`manufacturer_id`=`parts`.`manufacturer` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`parts`.`dealer` ORDER BY 2',
				'part_type_5' => 'SELECT `parts_type`.`part_type_id`, `parts_type`.`part_type` FROM `parts_type` ORDER BY 2',
				'part_name_5' => 'SELECT `parts`.`parts_id`, `parts`.`part_name` FROM `parts` LEFT JOIN `parts_type` as parts_type1 ON `parts_type1`.`part_type_id`=`parts`.`part_type` LEFT JOIN `manufacturer` as manufacturer1 ON `manufacturer1`.`manufacturer_id`=`parts`.`manufacturer` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`parts`.`dealer` ORDER BY 2',
				'description_5' => 'SELECT `parts`.`parts_id`, `parts`.`description` FROM `parts` LEFT JOIN `parts_type` as parts_type1 ON `parts_type1`.`part_type_id`=`parts`.`part_type` LEFT JOIN `manufacturer` as manufacturer1 ON `manufacturer1`.`manufacturer_id`=`parts`.`manufacturer` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`parts`.`dealer` ORDER BY 2',
				'manufacture_5' => 'SELECT `parts`.`parts_id`, IF(    CHAR_LENGTH(`manufacturer1`.`manufacturer_name`), CONCAT_WS(\'\',   `manufacturer1`.`manufacturer_name`), \'\') FROM `parts` LEFT JOIN `parts_type` as parts_type1 ON `parts_type1`.`part_type_id`=`parts`.`part_type` LEFT JOIN `manufacturer` as manufacturer1 ON `manufacturer1`.`manufacturer_id`=`parts`.`manufacturer` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`parts`.`dealer` ORDER BY 2',
				'part_type_6' => 'SELECT `parts_type`.`part_type_id`, `parts_type`.`part_type` FROM `parts_type` ORDER BY 2',
				'part_name_6' => 'SELECT `parts`.`parts_id`, `parts`.`part_name` FROM `parts` LEFT JOIN `parts_type` as parts_type1 ON `parts_type1`.`part_type_id`=`parts`.`part_type` LEFT JOIN `manufacturer` as manufacturer1 ON `manufacturer1`.`manufacturer_id`=`parts`.`manufacturer` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`parts`.`dealer` ORDER BY 2',
				'description_6' => 'SELECT `parts`.`parts_id`, `parts`.`description` FROM `parts` LEFT JOIN `parts_type` as parts_type1 ON `parts_type1`.`part_type_id`=`parts`.`part_type` LEFT JOIN `manufacturer` as manufacturer1 ON `manufacturer1`.`manufacturer_id`=`parts`.`manufacturer` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`parts`.`dealer` ORDER BY 2',
				'manufacture_6' => 'SELECT `parts`.`parts_id`, IF(    CHAR_LENGTH(`manufacturer1`.`manufacturer_name`), CONCAT_WS(\'\',   `manufacturer1`.`manufacturer_name`), \'\') FROM `parts` LEFT JOIN `parts_type` as parts_type1 ON `parts_type1`.`part_type_id`=`parts`.`part_type` LEFT JOIN `manufacturer` as manufacturer1 ON `manufacturer1`.`manufacturer_id`=`parts`.`manufacturer` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`parts`.`dealer` ORDER BY 2',
				'part_type_7' => 'SELECT `parts_type`.`part_type_id`, `parts_type`.`part_type` FROM `parts_type` ORDER BY 2',
				'part_name_7' => 'SELECT `parts`.`parts_id`, `parts`.`part_name` FROM `parts` LEFT JOIN `parts_type` as parts_type1 ON `parts_type1`.`part_type_id`=`parts`.`part_type` LEFT JOIN `manufacturer` as manufacturer1 ON `manufacturer1`.`manufacturer_id`=`parts`.`manufacturer` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`parts`.`dealer` ORDER BY 2',
				'description_7' => 'SELECT `parts`.`parts_id`, `parts`.`description` FROM `parts` LEFT JOIN `parts_type` as parts_type1 ON `parts_type1`.`part_type_id`=`parts`.`part_type` LEFT JOIN `manufacturer` as manufacturer1 ON `manufacturer1`.`manufacturer_id`=`parts`.`manufacturer` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`parts`.`dealer` ORDER BY 2',
				'manufacture_7' => 'SELECT `parts`.`parts_id`, IF(    CHAR_LENGTH(`manufacturer1`.`manufacturer_name`), CONCAT_WS(\'\',   `manufacturer1`.`manufacturer_name`), \'\') FROM `parts` LEFT JOIN `parts_type` as parts_type1 ON `parts_type1`.`part_type_id`=`parts`.`part_type` LEFT JOIN `manufacturer` as manufacturer1 ON `manufacturer1`.`manufacturer_id`=`parts`.`manufacturer` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`parts`.`dealer` ORDER BY 2',
				'part_type_8' => 'SELECT `parts_type`.`part_type_id`, `parts_type`.`part_type` FROM `parts_type` ORDER BY 2',
				'part_name_8' => 'SELECT `parts`.`parts_id`, `parts`.`part_name` FROM `parts` LEFT JOIN `parts_type` as parts_type1 ON `parts_type1`.`part_type_id`=`parts`.`part_type` LEFT JOIN `manufacturer` as manufacturer1 ON `manufacturer1`.`manufacturer_id`=`parts`.`manufacturer` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`parts`.`dealer` ORDER BY 2',
				'description_8' => 'SELECT `parts`.`parts_id`, `parts`.`description` FROM `parts` LEFT JOIN `parts_type` as parts_type1 ON `parts_type1`.`part_type_id`=`parts`.`part_type` LEFT JOIN `manufacturer` as manufacturer1 ON `manufacturer1`.`manufacturer_id`=`parts`.`manufacturer` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`parts`.`dealer` ORDER BY 2',
				'manufacture_8' => 'SELECT `parts`.`parts_id`, IF(    CHAR_LENGTH(`manufacturer1`.`manufacturer_name`), CONCAT_WS(\'\',   `manufacturer1`.`manufacturer_name`), \'\') FROM `parts` LEFT JOIN `parts_type` as parts_type1 ON `parts_type1`.`part_type_id`=`parts`.`part_type` LEFT JOIN `manufacturer` as manufacturer1 ON `manufacturer1`.`manufacturer_id`=`parts`.`manufacturer` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`parts`.`dealer` ORDER BY 2',
				'work_allocation_reference_number' => 'SELECT `work_allocation`.`work_allocation_id`, `work_allocation`.`work_allocation_reference_number` FROM `work_allocation` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`work_allocation`.`district` LEFT JOIN `cost_centre` as cost_centre1 ON `cost_centre1`.`cost_centre_id`=`work_allocation`.`cost_centre` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`work_allocation`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` ORDER BY 2',
			],
			'collection_of_repaired_vehicles' => [
				'reception_name_and_surname' => 'SELECT `reception`.`reception_user_id`, `reception`.`reception_name_and_surname` FROM `reception` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`reception`.`district` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`reception`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` ORDER BY 2',
				'reception_persal_number' => 'SELECT `reception`.`reception_user_id`, `reception`.`reception_persal_number` FROM `reception` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`reception`.`district` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`reception`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` ORDER BY 2',
				'reception_contact_details' => 'SELECT `reception`.`reception_user_id`, `reception`.`reception_contact_details` FROM `reception` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`reception`.`district` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`reception`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` ORDER BY 2',
				'reception_email_address' => 'SELECT `reception`.`reception_user_id`, `reception`.`reception_email_address` FROM `reception` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`reception`.`district` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`reception`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` ORDER BY 2',
				'driver_name_and_surname' => 'SELECT `driver`.`driver_id`, `driver`.`drivers_name_and_surname` FROM `driver` ORDER BY 2',
				'driver_persal_number' => 'SELECT `driver`.`driver_id`, `driver`.`drivers_persal_number` FROM `driver` ORDER BY 2',
				'driver_contacts_details' => 'SELECT `driver`.`driver_id`, `driver`.`drivers_contact_details` FROM `driver` ORDER BY 2',
				'driver_email_address' => 'SELECT `driver`.`driver_id`, `driver`.`drivers_email_address` FROM `driver` ORDER BY 2',
				'government_garage_name' => 'SELECT `districts`.`district_id`, IF(CHAR_LENGTH(`districts`.`station`) || CHAR_LENGTH(`districts`.`district`), CONCAT_WS(\'\', `districts`.`station`, \'    |    and    |      \', `districts`.`district`), \'\') FROM `districts` ORDER BY 2',
				'vehicle_registration_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`vehicle_registration_number` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'engine_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`engine_number` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'make_of_vehicle' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(CHAR_LENGTH(`gmt_fleet_register`.`model_of_vehicle`) || CHAR_LENGTH(`gmt_fleet_register`.`make_of_vehicle`), CONCAT_WS(\'\', `gmt_fleet_register`.`model_of_vehicle`, \'   |    and     |     \', IF(    CHAR_LENGTH(`dealer2`.`make_of_vehicle`), CONCAT_WS(\'\',   `dealer2`.`make_of_vehicle`, \'   \'), \'\')), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
			],
			'withdrawal_vehicle_from_operation' => [
				'vehicle_registration_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`vehicle_registration_number` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'engine_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`engine_number` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'make_of_vehicle' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(CHAR_LENGTH(`gmt_fleet_register`.`model_of_vehicle`) || CHAR_LENGTH(`gmt_fleet_register`.`make_of_vehicle`), CONCAT_WS(\'\', `gmt_fleet_register`.`model_of_vehicle`, \'   |    and     |     \', IF(    CHAR_LENGTH(`dealer2`.`make_of_vehicle`), CONCAT_WS(\'\',   `dealer2`.`make_of_vehicle`, \'   \'), \'\')), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'purchased_price' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`purchase_price` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'date_of_service' => 'SELECT `service`.`service_id`, IF(    CHAR_LENGTH(if(`schedule1`.`date`,date_format(`schedule1`.`date`,\'%d/%m/%Y\'),\'\')), CONCAT_WS(\'\',   if(`schedule1`.`date`,date_format(`schedule1`.`date`,\'%d/%m/%Y\'),\'\')), \'\') FROM `service` LEFT JOIN `service_item_type` as service_item_type1 ON `service_item_type1`.`service_item_type_id`=`service`.`service_item_type` LEFT JOIN `service_categories` as service_categories1 ON `service_categories1`.`service_categories_id`=`service`.`service_category` LEFT JOIN `merchant` as merchant1 ON `merchant1`.`merchant_id`=`service`.`merchant_name` LEFT JOIN `merchant_type` as merchant_type1 ON `merchant_type1`.`merchant_type_id`=`merchant1`.`merchant_type` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`service`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`service`.`dealer_name` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`service`.`closing_km` LEFT JOIN `work_allocation` as work_allocation1 ON `work_allocation1`.`work_allocation_id`=`service`.`work_allocation_reference_number` LEFT JOIN `schedule` as schedule1 ON `schedule1`.`schedule_id`=`service`.`date_of_service` LEFT JOIN `reception` as reception1 ON `reception1`.`reception_user_id`=`service`.`receptionist` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register1`.`year_model_specification` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register1`.`type_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register1`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register1`.`department_name` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`reception1`.`district` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register10 ON `gmt_fleet_register10`.`fleet_asset_id`=`reception1`.`vehicle_registration_number` ORDER BY 2',
				'date_of_next_service' => 'SELECT `service`.`service_id`, if(`service`.`date_of_next_service`,date_format(`service`.`date_of_next_service`,\'%d/%m/%Y\'),\'\') FROM `service` LEFT JOIN `service_item_type` as service_item_type1 ON `service_item_type1`.`service_item_type_id`=`service`.`service_item_type` LEFT JOIN `service_categories` as service_categories1 ON `service_categories1`.`service_categories_id`=`service`.`service_category` LEFT JOIN `merchant` as merchant1 ON `merchant1`.`merchant_id`=`service`.`merchant_name` LEFT JOIN `merchant_type` as merchant_type1 ON `merchant_type1`.`merchant_type_id`=`merchant1`.`merchant_type` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`service`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`service`.`dealer_name` LEFT JOIN `log_sheet` as log_sheet1 ON `log_sheet1`.`fuel_log_sheet_id`=`service`.`closing_km` LEFT JOIN `work_allocation` as work_allocation1 ON `work_allocation1`.`work_allocation_id`=`service`.`work_allocation_reference_number` LEFT JOIN `schedule` as schedule1 ON `schedule1`.`schedule_id`=`service`.`date_of_service` LEFT JOIN `reception` as reception1 ON `reception1`.`reception_user_id`=`service`.`receptionist` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register1`.`year_model_specification` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register1`.`type_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register1`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register1`.`department_name` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`reception1`.`district` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register10 ON `gmt_fleet_register10`.`fleet_asset_id`=`reception1`.`vehicle_registration_number` ORDER BY 2',
				'renewal_of_license' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, if(`gmt_fleet_register`.`renewal_of_license`,date_format(`gmt_fleet_register`.`renewal_of_license`,\'%d/%m/%Y\'),\'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
			],
			'costing' => [
				'government_garage_name' => 'SELECT `districts`.`district_id`, IF(CHAR_LENGTH(`districts`.`station`) || CHAR_LENGTH(`districts`.`district`), CONCAT_WS(\'\', `districts`.`station`, \'    |    and    |      \', `districts`.`district`), \'\') FROM `districts` ORDER BY 2',
				'job_card_number' => 'SELECT `reception`.`reception_user_id`, `reception`.`job_card_number` FROM `reception` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`reception`.`district` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`reception`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` ORDER BY 2',
				'vehicle_registration_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`vehicle_registration_number` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'engine_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`engine_number` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'make_of_vehicle' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(CHAR_LENGTH(`gmt_fleet_register`.`model_of_vehicle`) || CHAR_LENGTH(`gmt_fleet_register`.`make_of_vehicle`), CONCAT_WS(\'\', `gmt_fleet_register`.`model_of_vehicle`, \'   |    and     |     \', IF(    CHAR_LENGTH(`dealer2`.`make_of_vehicle`), CONCAT_WS(\'\',   `dealer2`.`make_of_vehicle`, \'   \'), \'\')), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
			],
			'billing' => [
				'district' => 'SELECT `districts`.`district_id`, `districts`.`district` FROM `districts` ORDER BY 2',
				'location' => 'SELECT `districts`.`district_id`, IF(CHAR_LENGTH(`districts`.`station`), CONCAT_WS(\'\', `districts`.`station`, \'   |  and   |   \'), \'\') FROM `districts` ORDER BY 2',
				'job_card_number' => 'SELECT `costing`.`costing_id`, IF(    CHAR_LENGTH(`reception1`.`job_card_number`), CONCAT_WS(\'\',   `reception1`.`job_card_number`), \'\') FROM `costing` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`costing`.`government_garage_name` LEFT JOIN `reception` as reception1 ON `reception1`.`reception_user_id`=`costing`.`job_card_number` LEFT JOIN `gmt_fleet_register` as gmt_fleet_register1 ON `gmt_fleet_register1`.`fleet_asset_id`=`costing`.`vehicle_registration_number` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register1`.`make_of_vehicle` ORDER BY 2',
				'vehicle_registration_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`vehicle_registration_number` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'engine_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`engine_number` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'make_of_vehicle' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(CHAR_LENGTH(`gmt_fleet_register`.`model_of_vehicle`) || CHAR_LENGTH(`gmt_fleet_register`.`make_of_vehicle`), CONCAT_WS(\'\', `gmt_fleet_register`.`model_of_vehicle`, \'   |    and     |     \', IF(    CHAR_LENGTH(`dealer2`.`make_of_vehicle`), CONCAT_WS(\'\',   `dealer2`.`make_of_vehicle`, \'   \'), \'\')), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
			],
			'general_control_measures' => [
				'district' => 'SELECT `districts`.`district_id`, `districts`.`district` FROM `districts` ORDER BY 2',
				'cost_centre' => 'SELECT `cost_centre`.`cost_centre_id`, `cost_centre`.`cost_centre` FROM `cost_centre` ORDER BY 2',
				'location' => 'SELECT `districts`.`district_id`, IF(CHAR_LENGTH(`districts`.`station`), CONCAT_WS(\'\', `districts`.`station`, \'   |  and   |   \'), \'\') FROM `districts` ORDER BY 2',
			],
			'movement_of_personnel_in_government_garage_and_workshops' => [
				'vehicle_inspection' => 'SELECT `movement_of_personnel_in_government_garage_and_workshops`.`movement_id`, `movement_of_personnel_in_government_garage_and_workshops`.`vehicle_model` FROM `movement_of_personnel_in_government_garage_and_workshops` LEFT JOIN `movement_of_personnel_in_government_garage_and_workshops` as movement_of_personnel_in_government_garage_and_workshops1 ON `movement_of_personnel_in_government_garage_and_workshops1`.`movement_id`=`movement_of_personnel_in_government_garage_and_workshops`.`vehicle_inspection` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`movement_of_personnel_in_government_garage_and_workshops`.`make_of_vehicle` LEFT JOIN `dealer_type` as dealer_type1 ON `dealer_type1`.`dealer_type_id`=`dealer1`.`dealer_type` ORDER BY 2',
				'make_of_vehicle' => 'SELECT `dealer`.`dealer_id`, IF(CHAR_LENGTH(`dealer`.`make_of_vehicle`) || CHAR_LENGTH(`dealer`.`dealer_type`), CONCAT_WS(\'\', `dealer`.`make_of_vehicle`, \'   |    and     |     \', IF(    CHAR_LENGTH(`dealer_type1`.`dealer_type`), CONCAT_WS(\'\',   `dealer_type1`.`dealer_type`), \'\')), \'\') FROM `dealer` LEFT JOIN `dealer_type` as dealer_type1 ON `dealer_type1`.`dealer_type_id`=`dealer`.`dealer_type` ORDER BY 2',
			],
			'service_provider' => [
				'service_provider_type' => 'SELECT `service_provider_type`.`service_provider_type_id`, `service_provider_type`.`service_provider_type` FROM `service_provider_type` ORDER BY 2',
			],
			'service_provider_type' => [
			],
			'vehicle_annual_inspection' => [
				'vehicle_registration_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`vehicle_registration_number` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'register_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`register_number` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'engine_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`engine_number` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'chassis_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`chassis_number` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'make_of_vehicle' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(CHAR_LENGTH(`gmt_fleet_register`.`make_of_vehicle`), CONCAT_WS(\'\', IF(    CHAR_LENGTH(`dealer2`.`make_of_vehicle`), CONCAT_WS(\'\',   `dealer2`.`make_of_vehicle`, \'   \'), \'\'), \'   \'), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'model_of_vehicle' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`model_of_vehicle` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'year_model_specification' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(    CHAR_LENGTH(`year_model1`.`year_model_specification`), CONCAT_WS(\'\',   `year_model1`.`year_model_specification`), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'engine_capacity' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`engine_capacity` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'tyre_size' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`tyre_size` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'transmission' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(    CHAR_LENGTH(`transmission1`.`transmission`), CONCAT_WS(\'\',   `transmission1`.`transmission`), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'fuel_type' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(    CHAR_LENGTH(`fuel_type1`.`fuel_type`), CONCAT_WS(\'\',   `fuel_type1`.`fuel_type`), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'type_of_vehicle' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(    CHAR_LENGTH(`body_type1`.`type_of_vehicle`), CONCAT_WS(\'\',   `body_type1`.`type_of_vehicle`), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'colour_of_vehicle' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(    CHAR_LENGTH(`vehicle_colour1`.`colour_of_vehicle`), CONCAT_WS(\'\',   `vehicle_colour1`.`colour_of_vehicle`), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'application_status' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, IF(    CHAR_LENGTH(`application_status1`.`application_status`), CONCAT_WS(\'\',   `application_status1`.`application_status`), \'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'renewal_of_license' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, if(`gmt_fleet_register`.`renewal_of_license`,date_format(`gmt_fleet_register`.`renewal_of_license`,\'%d/%m/%Y\'),\'\') FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'barcode_number' => 'SELECT `gmt_fleet_register`.`fleet_asset_id`, `gmt_fleet_register`.`barcode_number` FROM `gmt_fleet_register` LEFT JOIN `dealer` as dealer1 ON `dealer1`.`dealer_id`=`gmt_fleet_register`.`dealer_name` LEFT JOIN `dealer` as dealer2 ON `dealer2`.`dealer_id`=`gmt_fleet_register`.`make_of_vehicle` LEFT JOIN `year_model` as year_model1 ON `year_model1`.`year_model_id`=`gmt_fleet_register`.`year_model_specification` LEFT JOIN `transmission` as transmission1 ON `transmission1`.`transmission_id`=`gmt_fleet_register`.`transmission` LEFT JOIN `fuel_type` as fuel_type1 ON `fuel_type1`.`fuel_type_id`=`gmt_fleet_register`.`fuel_type` LEFT JOIN `body_type` as body_type1 ON `body_type1`.`body_type_id`=`gmt_fleet_register`.`type_of_vehicle` LEFT JOIN `vehicle_colour` as vehicle_colour1 ON `vehicle_colour1`.`vehicle_colour_id`=`gmt_fleet_register`.`colour_of_vehicle` LEFT JOIN `application_status` as application_status1 ON `application_status1`.`application_id`=`gmt_fleet_register`.`application_status` LEFT JOIN `departments` as departments1 ON `departments1`.`department_id`=`gmt_fleet_register`.`department_name` LEFT JOIN `province` as province1 ON `province1`.`province_id`=`gmt_fleet_register`.`province` LEFT JOIN `districts` as districts1 ON `districts1`.`district_id`=`gmt_fleet_register`.`district` LEFT JOIN `driver` as driver1 ON `driver1`.`driver_id`=`gmt_fleet_register`.`drivers_name_and_surname` LEFT JOIN `departments` as departments2 ON `departments2`.`department_id`=`gmt_fleet_register`.`department_name_of_driver` ORDER BY 2',
				'department_name' => 'SELECT `departments`.`department_id`, `departments`.`department_name` FROM `departments` ORDER BY 2',
				'province' => 'SELECT `province`.`province_id`, `province`.`province` FROM `province` ORDER BY 2',
				'district' => 'SELECT `districts`.`district_id`, IF(CHAR_LENGTH(`districts`.`district`) || CHAR_LENGTH(`districts`.`station`), CONCAT_WS(\'\', `districts`.`district`, \'     |     and     |     \', `districts`.`station`), \'\') FROM `districts` ORDER BY 2',
			],
		];

		return $lookupQuery[$tn][$lookupField];
	}

	#########################################################
	function pkGivenLookupText($val, $tn, $lookupField, $falseIfNotFound = false) {
		static $cache = [];
		if(isset($cache[$tn][$lookupField][$val])) return $cache[$tn][$lookupField][$val];

		if(!$lookupQuery = lookupQuery($tn, $lookupField)) {
			$cache[$tn][$lookupField][$val] = false;
			return false;
		}

		$m = [];

		// quit if query can't be parsed
		if(!preg_match('/select\s+(.*?),\s+(.*?)\s+from\s+(.*)/i', $lookupQuery, $m)) {
			$cache[$tn][$lookupField][$val] = false;
			return false;
		}

		list($all, $pkField, $lookupField, $from) = $m;
		$from = preg_replace('/\s+order\s+by.*$/i', '', $from);
		if(!$lookupField || !$from) {
			$cache[$tn][$lookupField][$val] = false;
			return false;
		}

		// append WHERE if not already there
		if(!preg_match('/\s+where\s+/i', $from)) $from .= ' WHERE 1=1 AND';

		$safeVal = makeSafe($val);
		$id = sqlValue("SELECT {$pkField} FROM {$from} {$lookupField}='{$safeVal}'");
		if($id !== false) {
			$cache[$tn][$lookupField][$val] = $id;
			return $id;
		}

		// no corresponding PK value found
		if($falseIfNotFound) {
			$cache[$tn][$lookupField][$val] = false;
			return false;
		} else {
			$cache[$tn][$lookupField][$val] = $val;
			return $val;
		}
	}
	#########################################################
	function userCanImport() {
		$mi = getMemberInfo();
		$safeUser = makeSafe($mi['username']);
		$groupID = intval($mi['groupID']);

		// admins can always import
		if($mi['group'] == 'Admins') return true;

		// anonymous users can never import
		if($mi['group'] == config('adminConfig')['anonymousGroup']) return false;

		// specific user can import?
		if(sqlValue("SELECT COUNT(1) FROM `membership_users` WHERE `memberID`='{$safeUser}' AND `allowCSVImport`='1'")) return true;

		// user's group can import?
		if(sqlValue("SELECT COUNT(1) FROM `membership_groups` WHERE `groupID`='{$groupID}' AND `allowCSVImport`='1'")) return true;

		return false;
	}
	#########################################################
	function parseTemplate($template) {
		if(trim($template) == '') return $template;

		global $Translation;
		foreach($Translation as $symbol => $trans)
			$template = str_replace("<%%TRANSLATION($symbol)%%>", $trans, $template);

		// Correct <MaxSize> and <FileTypes> to prevent invalid HTML
		$template = str_replace(['<MaxSize>', '<FileTypes>'], ['{MaxSize}', '{FileTypes}'], $template);
		$template = str_replace('<%%BASE_UPLOAD_PATH%%>', getUploadDir(''), $template);

		return $template;
	}
	#########################################################
	function getUploadDir($dir = '') {
		if($dir == '') $dir = config('adminConfig')['baseUploadPath'];

		return rtrim($dir, '\\/') . '/';
	}
	#########################################################
	function bgStyleToClass($html) {
		return preg_replace(
			'/ style="background-color: rgb\((\d+), (\d+), (\d+)\);"/',
			' class="nicedit-bg" data-nicedit_r="$1" data-nicedit_g="$2" data-nicedit_b="$3"',
			$html
		);
	}
	#########################################################
	function assocArrFilter($arr, $func) {
		if(!is_array($arr) || !count($arr)) return $arr;
		if(!is_callable($func)) return false;

		$filtered = [];
		foreach ($arr as $key => $value)
			if(call_user_func_array($func, [$key, $value]) === true)
				$filtered[$key] = $value;

		return $filtered;
	}
	#########################################################
	function setUserData($key, $value = null) {
		$data = [];

		$user = makeSafe(getMemberInfo()['username']);
		if(!$user) return false;

		$dataJson = sqlValue("SELECT `data` FROM `membership_users` WHERE `memberID`='$user'");
		if($dataJson) {
			$data = @json_decode($dataJson, true);
			if(!$data) $data = [];
		}

		$data[$key] = $value;

		return update(
			'membership_users', 
			['data' => @json_encode($data, JSON_PARTIAL_OUTPUT_ON_ERROR)], 
			['memberID' => $user]
		);
	}
	#########################################################
	function getUserData($key) {
		$user = makeSafe(getMemberInfo()['username']);
		if(!$user) return null;

		$dataJson = sqlValue("SELECT `data` FROM `membership_users` WHERE `memberID`='$user'");
		if(!$dataJson) return null;

		$data = @json_decode($dataJson, true);
		if(!$data) return null;

		if(!isset($data[$key])) return null;

		return $data[$key];
	}
	#########################################################
	/*
	 Usage:
	 breakpoint(__FILE__, __LINE__, 'message here');
	 */
	function breakpoint($file, $line, $msg) {
		if(!DEBUG_MODE) return;
		if(strpos($_SERVER['PHP_SELF'], 'ajax_check_login.php') !== false) return;
		static $startTs = null;
		static $fp = null;
		if(!$startTs) $startTs = microtime(true);
		if(!$fp) {
			$logFile = __DIR__ . '/breakpoint.csv';
			$isNew = !is_file($logFile);
			$fp = fopen($logFile, 'a');
			if($isNew) fputcsv($fp, [
				'Time offset',
				'Requested script',
				'Running script',
				'Line #',
				'Message',
			]);

			fputcsv($fp, [date('Y-m-d H:i:s'), $_SERVER['REQUEST_URI'], '', '', '']);
		}

		fputcsv($fp, [
			number_format(microtime(true) - $startTs, 3),
			basename($_SERVER['PHP_SELF']),
			str_replace(__DIR__, '', $file),
			$line,
			is_array($msg) ? json_encode($msg) : $msg,
		]);
	}
	#########################################################
	function denyAccess($msg = null) {
		@header($_SERVER['SERVER_PROTOCOL'] . ' 403 Access Denied');
		die($msg);
	}
