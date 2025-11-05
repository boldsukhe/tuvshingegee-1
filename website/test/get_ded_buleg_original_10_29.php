<?php
require "db_connect.php";

header('Content-Type: application/json'); // Must be at the top before any output

if (isset($_POST['ded_buleg'])) {
    $test_ded = $_POST['ded_buleg'];
    preg_match('/- (\d+)/', $_POST['ded_buleg'], $matches);
    $ded_buleg = $matches[1] ?? '';
    $ded_buleg = $conn->real_escape_string($ded_buleg);


    // Optional: Whitelist allowed tables to avoid SQL injection


    $result = $conn->query("SELECT * FROM ded_buleg WHERE ded_buleg_id = $ded_buleg");
    $ded_buleg = [];

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nonNullValues = array_filter($row, function ($value) {
            return $value !== "";
        });
        $rest = array_slice($nonNullValues, 4);
        echo json_encode($rest);

    } else {
        echo "<p>No matching record found.</p>";
    }

}
