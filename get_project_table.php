<?php
require "db_connect.php";

header('Content-Type: application/json'); // must be before any output

if (isset($_POST['project_name'])) {
    $name = $conn->real_escape_string($_POST['project_name']);

    // Optional: Whitelist allowed table names (recommended in real apps)
    // if (!in_array($name, $allowedTables)) exit;

    $result = $conn->query("SELECT group_number, quantity, start_date, end_date FROM `$name`");

    if ($result && $result->num_rows > 0) {
        $groupNames = [];

        while ($row = $result->fetch_assoc()) {
            $groupNames[] = $row;
        }

        echo json_encode($groupNames);
    } else {
        echo json_encode([]); // Return empty array if no result
    }
} else {
    echo json_encode(["error" => "project_name not set"]);
}
?>

