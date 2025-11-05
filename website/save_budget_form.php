<?php
require("db_connect.php");

// echo "<pre>";
// echo "Hello";
// print_r($_POST);
// echo "</pre>";
// exit;

// Loop through data and insert into the database
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $projectName = $_POST["projectName"];
    $group_names_1 = $_POST["buleg_id"];
    // $names = $_POST["name"];
    $quantities = $_POST["quantity"];
    $unit_costs = $_POST["unit_cost"];
    $total_costs = $_POST["total_cost"];
    $start_dates = $_POST["start_date"];
    $end_dates = $_POST["end_date"];
    
    for ($i = 0; $i < count($group_names_1); $i++) {
        $group_name = $conn->real_escape_string($group_names_1[$i]);
        // $name = $conn->real_escape_string($names[$i]);
        $quantity = (int) $quantities[$i];
        $unit_cost = (float) $unit_costs[$i];
        $total_cost = (float) $total_costs[$i];
        $start_date = $conn->real_escape_string($start_dates[$i]);
        $end_date = $conn->real_escape_string($end_dates[$i]);

        $sql = "INSERT INTO $projectName (group_number, quantity, unit_cost, total_cost, start_date, end_date) 
                VALUES ('$group_name', '$quantity', '$unit_cost', '$total_cost', '$start_date', '$end_date')";

        $conn->query($sql);
    }
    
    exit;
}

$conn->close();
?>





  