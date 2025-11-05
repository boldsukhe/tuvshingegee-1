<?php
require("db_connect.php");
$conn->set_charset("utf8mb4");
// Loop through data and insert into the database
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $projectName = $_POST["projectName"];
    //deleting project's data
    $conn->query("TRUNCATE TABLE `$projectName`");
    //
    $group_names_1 = $_POST["buleg_id"];
    $source_bulegs = $_POST["source_buleg"];
    $ajliin_turuls = $_POST["ajliin_turul"];
    $negjs = $_POST["negj"];
    // $names = $_POST["name"];
    $quantities = $_POST["quantity"];
    $unit_costs = $_POST["unit_cost"];
    $total_costs = $_POST["total_cost"];
    $start_dates = $_POST["start_date"];
    $end_dates = $_POST["end_date"];
    
    for ($i = 0; $i < count($group_names_1); $i++) {
        $group_name = $conn->real_escape_string($group_names_1[$i]);
        // $name = $conn->real_escape_string($names[$i]);
        $ajliin_turul = $conn->real_escape_string($ajliin_turuls[$i]);
        $source_buleg = $conn->real_escape_string($source_bulegs[$i]);
        $negj = $conn->real_escape_string($negjs[$i]);
        $quantity = (int) $quantities[$i];
        $unit_cost = (float) $unit_costs[$i];
        $total_cost = (float) $total_costs[$i];
        $start_date = $conn->real_escape_string($start_dates[$i]);
        $end_date = $conn->real_escape_string($end_dates[$i]);

        $sql = "INSERT INTO $projectName (group_number, ajliin_turul, source_buleg, negj, quantity, unit_cost, total_cost, start_date, end_date) 
                VALUES ('$group_name', '$ajliin_turul', '$source_buleg','$negj','$quantity', '$unit_cost', '$total_cost', '$start_date', '$end_date')";

        $conn->query($sql);
    }
    
    exit;
}

$conn->close();
?>





  