<?php
/*
 * Get calendar full HTML
 */

function getCalender($year = '', $month = '') {
	$dateYear = ($year != '') ? $year : date("Y");
	$dateMonth = ($month != '') ? $month : date("m");
	$date = $dateYear . '-' . $dateMonth . '-01';
	$currentMonthFirstDay = date("N", strtotime($date));
	$totalDaysOfMonth = cal_days_in_month(CAL_GREGORIAN, $dateMonth, $dateYear);
	$totalDaysOfMonthDisplay = ($currentMonthFirstDay == 7) ? ($totalDaysOfMonth) : ($totalDaysOfMonth + $currentMonthFirstDay);
	$boxDisplay = ($totalDaysOfMonthDisplay <= 35) ? 35 : 42;
	?>



	<div style="margin-top: 20px" > <a href="../index.php" class="btn btn-info" role="button">Back to Dashboard</a></div>



	<div class="container text-center">

		<div class="row">
			<div class="col-lg-8 col-sm-12 col-xs-12" style="margin-right: 0px">
				<div id="calender_section">
					<h2>
						<a href="javascript:void(0);" onclick="getCalendar('calendar_div', '<?php echo date("Y", strtotime($date . ' - 1 Month')); ?>', '<?php echo date("m", strtotime($date . ' - 1 Month')); ?>');">&lt;&lt;</a>
						<select name="month_dropdown" class="month_dropdown dropdown"><?php echo getAllMonths($dateMonth); ?></select>
						<select name="year_dropdown" class="year_dropdown dropdown"><?php echo getYearList($dateYear); ?></select>
						<a href="javascript:void(0);" onclick="getCalendar('calendar_div', '<?php echo date("Y", strtotime($date . ' + 1 Month')); ?>', '<?php echo date("m", strtotime($date . ' + 1 Month')); ?>');">&gt;&gt;</a>
					</h2>

					<div id="calender_section_top">
						<ul>
							<li>Sun</li>
							<li>Mon</li>
							<li>Tue</li>
							<li>Wed</li>
							<li>Thu</li>
							<li>Fri</li>
							<li>Sat</li>
						</ul>
					</div>
					<div id="calender_section_bot">
						<ul>
	<?php
	$dayCount = 1;
	for ($cb = 1; $cb <= $boxDisplay; $cb++) {
		if (($cb >= $currentMonthFirstDay + 1 || $currentMonthFirstDay == 7) && $cb <= ($totalDaysOfMonthDisplay)) {
			//Current date
			$currentDate = $dateYear . '-' . $dateMonth . '-' . $dayCount;
			$eventNum = 0;

			$result = sql("SELECT title FROM schedule WHERE date = '" . $currentDate . "' AND application_status = 'Active'", $e0);
			$eventNum = $result->num_rows;
			//Define date cell color
			if (strtotime($currentDate) == strtotime(date("Y-m-d")) ) {
				
				
				if ($eventNum > 0){
				
			
				
				echo '<li date="' . $currentDate . '" class="grey date_cell">'.'<span>'.$dayCount.'</span>'.'<a href="javascript:;" onclick=" getSchedule(\'' . $currentDate . '\');">Service. (' . $eventNum . ')</a>';
				
				} else {
					echo '<li date="' . $currentDate . '" class="grey date_cell">'.'<span>'.$dayCount.'</span>';
				}
				
				
				
			} elseif ($eventNum > 0) {
				echo  '<li date="' . $currentDate . '" class="light_sky date_cell">'.'<span>'.$dayCount.'</span>'.'<a href="javascript:;" onclick=" getSchedule(\'' . $currentDate . '\');">Service. (' . $eventNum . ')</a>';
			} else {
				echo '<li date="' . $currentDate . '" class="date_cell">'.'<span>'. $dayCount.'</span>';
			}

			echo '</li>';
			$dayCount++;
			?>
								<?php } else { ?>
									<li><span>&nbsp;</span></li>
								<?php }
							}
							?>
						</ul>
					</div>
				</div>
			</div>

			<div class="col-xs-8 col-lg-4">

				<div id="event_list" class="none"></div>
			</div>
		</div>
	</div>
	<script>
		$j(document).ready(function () {
			$j('.date_cell').mouseenter(function () {
				date = $j(this).attr('date');
				$j(".date_popup_wrap").fadeOut();
				$j("#date_popup_" + date).fadeIn();
			});
			$j('.date_cell').mouseleave(function () {
				$j(".date_popup_wrap").fadeOut();
			});
			$j('.month_dropdown').on('change', function () {
				getCalendar('calendar_div', $j('.year_dropdown').val(), $j('.month_dropdown').val());
			});
			$j('.year_dropdown').on('change', function () {
				getCalendar('calendar_div', $j('.year_dropdown').val(), $j('.month_dropdown').val());
			});
			$j(document).click(function () {
				$j('#event_list').show();
			});
		});
	</script>

	<?php
}

/*
 * Get months options list.
 */

function getAllMonths($selected = '') {
	$options = '';
	for ($i = 1; $i <= 12; $i++) {
		$value = ($i < 10) ? '0' . $i : $i;
		$selectedOpt = ($value == $selected) ? 'selected' : '';
		$options .= '<option value="' . $value . '" ' . $selectedOpt . ' >' . date("F", mktime(0, 0, 0, $i + 1, 0, 0)) . '</option>';
	}
	return $options;
}

/*
 * Get years options list.
 */

function getYearList($selected = '') {
	$options = '';
	for ($i = 2015; $i <= 2025; $i++) {
		$selectedOpt = ($i == $selected) ? 'selected' : '';
		$options .= '<option value="' . $i . '" ' . $selectedOpt . ' >' . $i . '</option>';
	}
	return $options;
}

/*
 * Get schedule by date
 * select * from event where date="2016-08-08"  AND application_status = "Active" ORDER BY time
 */

function getSchedule($date = '') {
	$eventListHTML = '';
	$date = $date ? $date : date("Y-m-d");
	//Get schedule based on the current date
//include 'dbConfig.php';
	
	$result = sql("SELECT * FROM schedule WHERE date = '" . $date . "' AND application_status = 'Active'  ORDER BY time ", $e0);
	if ($result->num_rows > 0) {
		
		$eventListHTML .= '<h3>' . date("l, d M Y", strtotime($date)) . '</h3>';
		$eventListHTML .= '<ul class="text-left">';

		while ($row = $result->fetch_assoc()) {
			$name = sql("select vehicle_registration_number,engine_number from gmt_fleet_register where fleet_asset_id='" . $row['engine_number'] . "'", $e0);
			if ($row_name = $name->fetch_assoc()) {
				$s = config("adminConfig");
				$rr = sql("SELECT * FROM service_item_type WHERE service_item_type_id = '" . $row['service_item_type'] . "'", $e0);
				$stype = null;
				if ($rr->num_rows > 0)
				{
					$stype = $rr->fetch_assoc();
				}
				$ww = sql("SELECT * FROM districts WHERE district_id = '" . $row['workshop_name'] . "'", $e0);
				$wtype = null;
				if ($ww->num_rows > 0)
				{
					$wtype = $ww->fetch_assoc();
				}
				

				//$eventListHTML .= "<li><b><u>" . $row['title'] . "</u> </b><br><b style='color:#EB1717'> Vehicle Registration Number:</b> " . $row_name['vehicle_registration_number'] . " <br> &  <b style='color:#446FC3'>Engine Number:</b> " . $row_name['engine_number'] . " <br> with  service type: " . $row['service_item_type'] . " <b style='color:##FFAA00'><br>  on: <u>" . date(substr($s['PHPDateTimeFormat'], 7), strtotime($row['time'])) ." </u></b><br> at workshop:<br>" . $row['workshop_name'] . "</li>";
				$eventListHTML .= "<li><b><u>" . $row['title'] . "</u> </b><br><b style='color:#C00000'> Vehicle Registration Number:</b> " . $row_name['vehicle_registration_number'] . " <br> &  <b style='color:#004C6C'>Engine Number:</b> " . $row_name['engine_number'] . " <br><b style='color:#FFA000'> with  service type:</b> " . $stype['service_item_type'] . " <b style='color:##FFAA00'><br> <b style='color:#C00000'> on: </b><u>" . date(substr($s['PHPDateTimeFormat'], 7), strtotime($row['time'])) ." </u></b><br><b style='color:#004C6C''> @ workshop & District:</b> " . $wtype['station'] . " | and | " . $wtype['district'] . "</li><br><p>";
			}
		}
		$eventListHTML .= '</ul>';
	}
	echo $eventListHTML;
}
?>

<?php //include_once("$currDir/footer.php");  ?>
