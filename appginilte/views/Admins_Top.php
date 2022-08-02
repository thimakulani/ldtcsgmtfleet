<!--Write your Admins group specific dashboard content and logic in here, this could be charts,cards widgets,tables and everything in between. This content will be shown above home links/cards on the dashboard-->


<?php
    include 'include/include_actions.php';
    $months = get_months();
    $months_output = "";
    $districts_output = "";
    $service_output = "";
    $accident_output = "";
    foreach ($months as $mon)
    {
        $selected = "";
        if(isset($_POST['month']))
        {
            if($_POST['month'] == $mon['month']){
                $selected = "selected";
            }
        }
        $months_output .='<option '. $selected .' value="'.$mon['month'].'">'.$mon['month'].'</option>';
    }
    foreach ($months as $mon)
    {
        $selected = "";
        if(isset($_POST['accident_month']))
        {
            if($_POST['accident_month'] == $mon['month']){
                $selected = "selected";
            }
        }
        $months_output .='<option '. $selected .' value="'.$mon['month'].'">'.$mon['month'].'</option>';
    }

    foreach ($months as $mon)
    {
        $selected = "";
        if(isset($_POST['service_month']))
        {
            if($_POST['service_month'] == $mon['month']){
                $selected = "selected";
            }
        }
        $months_output .='<option '. $selected .' value="'.$mon['month'].'">'.$mon['month'].'</option>';
    }

    $districts = get_districts();

    foreach ($districts as $dist)
    {
        $selected = "";
        if(isset($_POST['district']))
        {
            if($_POST['district'] == $dist['district']){
                $selected = "selected";

            }
        }
        $districts_output .='<option '.$selected.' value="'.$dist['district'].'">'.$dist['district'].'</option>';
    }
    foreach ($districts as $dist)
    {
        $selected = "";
        if(isset($_POST['service_district']))
        {
            if($_POST['service_district'] == $dist['district']){
                $selected = "selected";

            }
        }
        $districts_output .='<option '.$selected.' value="'.$dist['district'].'">'.$dist['district'].'</option>';
    }
    foreach ($districts as $dist)
    {
        $selected = "";
        if(isset($_POST['accident_district']))
        {
            if($_POST['accident_district'] == $dist['district']){
                $selected = "selected";

            }
        }
        $districts_output .='<option '.$selected.' value="'.$dist['district'].'">'.$dist['district'].'</option>';
    }

?>





<div class="row">
    <!-- -->
    <div class="col-md-12">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">STATS CRITERIA</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="maximize">
                            <i class="fas fa-expand"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <form id="prospects_form" method="post">


                                <div class="card-header">
                                    <div class="card-tools">

                                        <div class="input-group input-group-sm form-inline">
                                            <div  class="form-inline"  >
                                                <div>
                                                    <select class="form-control m-2" name="report_type">
                                                        <option <?php if($_POST['report_type'] == 'Fuel Log Sheet'){echo 'selected';} ?> value="Fuel Log Sheet" >Fuel Log Sheet</option>
                                                        <option <?php if($_POST['report_type'] == 'Claims'){echo 'selected';} ?> value="Claims">Claims</option>
                                                        <option <?php if($_POST['report_type'] == 'Service Schedule'){echo 'selected';} ?> value="Service Schedule">Service Schedule</option>
                                                        <option <?php if($_POST['report_type'] == 'Accidents'){echo 'selected';} ?> value="Accidents" >Accidents</option>
                                                    </select>
                                                </div>
                                            <div>
                                                <SELECT class="form-control m-2" name="district" id="district">
                                                    <?php echo $districts_output ?>
                                                </SELECT>
                                            </div>
                                            <div>
                                                <SELECT class="form-control m-2" name="month">
                                                    <?php echo $months_output ?>
                                                </SELECT>
                                            </div>
                                                <div>
                                                    <input type="number" placeholder="Year" class="form-control m-2" name="year" value="<?php echo (new DateTime())->format('Y'); ?>" />
                                                </div>
                                            <div>
                                                    <input type="submit" class="btn-sm btn-success m-2" name="fuel_log" value="Query" />

                                            </div>
                                            </d>
                                            <div>
                                                <input type="submit" class="btn-sm btn-success m-2" onclick="printDiv('log_sheet_report')" value="Print" />
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0" style="max-height: 300px;" id="log_sheet_report">



                                        <?php


                                            $header = '<div>
                                                        <div>
                                                        <img style="width: 120px; height: 120px" src="appginilte/dist/img/AdminLTELogo.png" />
                                                        </div>
                                                         <dl class="row">
                                                         
                                                                <dt class ="col-sm-2">
                                                                    DISTRICT
                                                                </dt>
                                                                <dd class="col-sm-10">
                                                                    ' .$_POST['district'].'
                                                                </dd>
                                                                <dt class="col-sm-2">
                                                                    MONTH & YEAR
                                                                </dt>
                                                                <dd class="col-sm-10">
                                                                    '.$_POST['month'].'-'.$_POST['year'].'
                                                                </dd>'
                                                         ;

                                            $raw_output = '<table class="table table-head-fixed text-nowrap">';
                                            if(isset($_POST['fuel_log']))
                                            {
                                                $header .= '<dt class="col-sm-2">
                                                                    REPORT TYPE
                                                                </dt>
                                                                <dd class="col-sm-10">
                                                                    FUEL LOG SHEET
                                                                </dd>';

                                                if ($_POST['report_type'] == 'Fuel Log Sheet')
                                                {
                                                    $raw_output .= '<thead>';
                                                    $raw_output .= '<tr>';
                                                    $raw_output .= '<th>ID</th>';
                                                    $raw_output .= '<th>Registration</th>';
                                                    $raw_output .= '<th>Total KM</th>';
                                                    $raw_output .= '<th>Total Fuel</th>';
                                                    $raw_output .= '</tr>';
                                                    $raw_output .= '</thead>';

                                                    $district = $_POST['district'];
                                                    $month = $_POST['month'];
                                                    $year = $_POST['year'];
                                                    $trips = get_trips($district, $month, $year );

                                                    $raw_output .= '<tbody>';
                                                    foreach ($trips as $t)
                                                    {
                                                        $raw_output .= '<tr>';
                                                        $raw_output .= '<td>'.$t['fuel_log_sheet_id'].'</td>';
                                                        $raw_output .= '<td>'.$t['vehicle_registration_number'].'</td>';
                                                        $raw_output .= '<td>'.$t['total_km'].'</td>';
                                                        $raw_output .= '<td>'.$t['total_fuel_quantity'].'</td>';
                                                        $raw_output .= '</tr>';
                                                    }
                                                    $raw_output .= '</tbody>';
                                                }
                                                elseif ($_POST['report_type'] == 'Claims')
                                                {
                                                    $header .= '<dt class="col-sm-2">
                                                                    REPORT TYPE
                                                                </dt>
                                                                <dd class="col-sm-10">
                                                                   CLAIMS
                                                                </dd>';
                                                    $raw_output .= '<thead>';
                                                    $raw_output .= '<tr>';
                                                    $raw_output .= '<th>ID</th>';
                                                    $raw_output .= '<th>Registration</th>';
                                                    $raw_output .= '<th>Total KM</th>';
                                                    $raw_output .= '<th>Total Fuel</th>';
                                                    $raw_output .= '</tr>';
                                                    $raw_output .= '</thead>';

                                                    $district = $_POST['district'];
                                                    $month = $_POST['month'];
                                                    $year = $_POST['year'];
                                                    $trips = get_trips($district, $month, $year );

                                                    $raw_output .= '<tbody>';
                                                    foreach ($trips as $t)
                                                    {
                                                        $raw_output .= '<tr>';
                                                        $raw_output .= '<td>'.$t['fuel_log_sheet_id'].'</td>';
                                                        $raw_output .= '<td>'.$t['vehicle_registration_number'].'</td>';
                                                        $raw_output .= '<td>'.$t['total_km'].'</td>';
                                                        $raw_output .= '<td>'.$t['total_fuel_quantity'].'</td>';
                                                        $raw_output .= '</tr>';
                                                    }
                                                    $raw_output .= '</tbody>';
                                                }
                                                elseif ($_POST['report_type'] == 'Service Schedule')
                                                {
                                                    $header .= '<dt class="col-sm-2">
                                                                    REPORT TYPE
                                                                </dt>
                                                                <dd class="col-sm-10">
                                                                    SERVICE SCHEDULE
                                                                </dd>';
                                                    $raw_output .= '<thead>';
                                                    $raw_output .= '<tr>';
                                                    $raw_output .= '<th>Id#</th>';
                                                    $raw_output .= '<th>Registration</th>';
                                                    $raw_output .= '<th>Date</th>';
                                                    $raw_output .= '<th>Time</th>';
                                                    $raw_output .= '</tr>';
                                                    $raw_output .= '</thead>';

                                                    $district = $_POST['district'];
                                                    $month = $_POST['month'];
                                                    $year = $_POST['year'];
                                                    $service = get_service($district, $month, $year );

                                                    $raw_output .= '<tbody>';
                                                    foreach ($service as $t)
                                                    {
                                                        $raw_output .= '<tr>';
                                                        $raw_output .= '<td>'.$t['service_id'].'</td>';
                                                        $raw_output .= '<td>'.$t['vehicle_registration_number'].'</td>';
                                                        $raw_output .= '<td>'.$t['date'].'</td>';
                                                        $raw_output .= '<td>'.$t['time'].'</td>';
                                                        $raw_output .= '</tr>';
                                                    }
                                                    $raw_output .= '</tbody>';
                                                }
                                                elseif ($_POST['report_type'] == 'Accidents')
                                                {
                                                    $header .= '<dt class="col-sm-2">
                                                                    REPORT TYPE
                                                                </dt>
                                                                <dd class="col-sm-10">
                                                                    ACCIDENTS
                                                                </dd>';
                                                    $raw_output .= '<thead>';
                                                    $raw_output .= '<tr>';
                                                    $raw_output .= '<th>Id#</th>';
                                                    $raw_output .= '<th>Registration</th>';
                                                    $raw_output .= '<th>Date of Accident</th>';
                                                    $raw_output .= '</tr>';
                                                    $raw_output .= '</thead>';

                                                    $district = $_POST['district'];
                                                    $month = $_POST['month'];
                                                    $year = $_POST['year'];
                                                    $accidents = get_accidents($district, $month, $year );

                                                    $raw_output .= '<tbody>';
                                                    foreach ($accidents as $t)
                                                    {
                                                        $raw_output .= '<tr>';
                                                        $raw_output .= '<td>'.$t['accident_id'].'</td>';
                                                        $raw_output .= '<td>'.$t['vehicle_registration_number'].'</td>';
                                                        $raw_output .= '<td>'.$t['date_of_accident'].'</td>';
                                                        $raw_output .= '</tr>';
                                                    }
                                                    $raw_output .= '</tbody>';
                                                }
                                                $raw_output .='</table>';
                                                echo  $header;
                                                echo '</dl>
                                                      </div>';
                                                echo $raw_output;
                                            }


                                        ?>

                                </div>
                                <!-- /.card-body -->
                            </div>
                                </form>
                            <!-- /.card -->
                        </div>
                    </div>
                    <!-- /.row -->
                    <!-- /.card -->
                </div>
            </div>


    </div>

    <!-- -->
</div>

<script>
    function printDiv(divName)
    {
        const printContents = document.getElementById(divName).innerHTML;
        const originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>
