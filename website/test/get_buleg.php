<?php
require "db_connect.php";

header('Content-Type: application/json'); // Must be at the top before any output

if (isset($_POST['ajliin_turul'])) {
    $ajliin_turul = $conn->real_escape_string($_POST['ajliin_turul']);
    $projectName = $conn->real_escape_string($_POST['projectName']);

    // Optional: Whitelist allowed tables to avoid SQL injection

  

    $sql = "SELECT group_number, quantity, negj FROM `$projectName` WHERE ajliin_turul = '$ajliin_turul'
    and source_buleg = ''";
    $result = $conn->query($sql);




    $data = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = [
                'group_number' => $row['group_number'],
                'quantity' => $row['quantity'],
                'negj' => $row['negj']
            ];
        }
    }
    echo json_encode($data);
}
