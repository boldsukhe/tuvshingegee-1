<?php
require "db_connect.php";

$query = "SELECT id, project_name, work_date AS start, description FROM work_entries";
$result = $conn->query($query);

$events = [];

while ($row = $result->fetch_assoc()) {
    $events[] = [
        'id' => $row['id'],
        'title' => $row['project_name'],
        'start' => $row['start'], // Must be ISO format: YYYY-MM-DD
        'description' => $row['description']
    ];
}

echo json_encode($events);
?>
