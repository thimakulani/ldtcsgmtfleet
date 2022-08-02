<?php
function connect()
{
    $servername = "localhost";
    $username = "root";
    $password = "";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=ldtcsgmtfleet2022new", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

}
function get_service($m, $d, $y)
{

    $conn = connect();
    $sql = "SELECT se.service_id, gfr.vehicle_registration_number, sc.date, sc.time, d.district FROM service AS se
            JOIN gmt_fleet_register as gfr ON se.vehicle_registration_number = gfr.fleet_asset_id
            JOIN districts d ON gfr.district = d.district_id
            JOIN schedule AS sc ON se.date_of_service = sc.schedule_id
            WHERE MONTHNAME(sc.date) = :mon  AND d.district = :dist;";
    $stmt = $conn->prepare($sql);
    $stmt ->bindParam(":mon", $m);
    $stmt ->bindParam(":dist", $d);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_BOTH);
}

function get_claims()
{
    $conn = connect();
    $sql = "SELECT * FROM claim";
    $stmt = $conn->prepare($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);

}
function get_districts(){
    $db = connect();
    $stmt = $db->query("SELECT * FROM `districts`");
    return $stmt->fetchAll(PDO::FETCH_BOTH);
}
function get_trips($d, $m, $y)
{

    $conn = connect();
    $sql = "SELECT gfr.vehicle_registration_number, d.district, ls.fuel_log_sheet_id, ls.total_km, ls.total_fuel_quantity
            FROM log_sheet as ls
            JOIN gmt_fleet_register as gfr ON ls.vehicle_registration_number = gfr.fleet_asset_id
            JOIN districts AS d ON gfr.district = d.district_id
            WHERE d.district = :district 
            AND MONTHNAME(`month`) = :mon 
;";





    $stmt = $conn->prepare($sql);
    $stmt ->bindParam(":district", $d);
    $stmt ->bindParam(":mon", $m);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_BOTH);
}
function get_months()
{
    $conn = connect();
    $sql = 'SELECT * FROM month';
    $stmt = $conn->query($sql);
    return $stmt->fetchAll(PDO::FETCH_BOTH);
}
function get_accidents($m, $d, $y)
{
    $sql = "SELECT a.accident_id, gfr.vehicle_registration_number, d.district, a.date_of_accident
            FROM accidents AS a
            JOIN gmt_fleet_register AS gfr ON a.vehicle_registration_number = gfr.fleet_asset_id
            JOIN districts d ON gfr.district = d.district_id
            WHERE MONTHNAME(a.date_of_accident) = :m AND d.district = :d";
    $conn = connect();
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':m', $m);
    $stmt->bindParam(':d', $d);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_BOTH);
}