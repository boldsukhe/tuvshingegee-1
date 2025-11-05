<?php
require "db_connect.php";

header('Content-Type: application/json'); // Must be at the top before any output

if (isset($_POST['get_ded_buleg_utga'])) {
    $ded_buleg = $conn->real_escape_string($_POST['get_ded_buleg_utga']);

    // Optional: Whitelist allowed tables to avoid SQL injection
  

    $result = $conn->query("SELECT * FROM ded_buleg WHERE ded_buleg_id = $ded_buleg");
    $ded_buleg = [];

    if ($result ->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nonNullValues = array_filter($row, function($value){
            return $value !== "";
        });
        $rest = array_slice($nonNullValues, 1);
        echo json_encode($rest);
        
    } else {
        echo "<p>No matching record found.</p>";
    }

}
