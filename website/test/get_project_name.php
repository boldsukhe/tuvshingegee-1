<?php
require "db_connect.php";

header('Content-Type: application/json'); // Must be at the top before any output

if (isset($_POST['project_name'])) {
    $name = $conn->real_escape_string($_POST['project_name']);

    // Optional: Whitelist allowed tables to avoid SQL injection
  

    $result = $conn->query("SELECT group_number FROM `$name`"); //$name ni songoson tusliin ner
    $groupNames = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
           $groupNames[] = $row;
        //    [
        //         // "id" => $row['names'], // or another unique value if needed
        //         // "text" => $row['group_numner'] //. ' - ' . $row['group_name']
        //     ];
        } 
        echo json_encode($groupNames);
    } else {
        echo json_encode([]);
    }
}
