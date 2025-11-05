<?php
require "db_connect.php";

header('Content-Type: application/json');
error_reporting(0);

if (isset($_POST['ded_buleg'])) {
    $ded_buleg = $conn->real_escape_string($_POST['ded_buleg']);

    $parts = explode(' - ', $ded_buleg);

    $name = trim($parts[0]);   // e.g. "гэр барих"
    $number = trim($parts[1]); // e.g. "250601"

    $result = $conn->query("SELECT * FROM buleg WHERE utga = '$name'");

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Filter out empty values
        $nonNullValues = array_filter($row, function ($value) {
            return $value !== "";
        });

        // Skip the first column (likely 'id' or similar)
        $rest = array_slice($nonNullValues, 1);

        $ded_buleg_utga_dugaar = [];

        // Iterate over each remaining field
        foreach ($rest as $key => $value) {
            // Assume $value is the ded_buleg_id
            $query = $conn->query("SELECT utga FROM ded_buleg WHERE ded_buleg_id = '$value'");
            $ded_buleg_row = $query->fetch_assoc();

            if ($ded_buleg_row) {
                $ded_buleg_utga_dugaar[] = [
                    "id" => $value,
                    "text" => $ded_buleg_row['utga'] . " - " . $value
                ];
            }
        }

        echo json_encode($ded_buleg_utga_dugaar);
    } else {
        echo json_encode([]);
    }
}
?>
