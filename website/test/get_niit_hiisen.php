<?php
require "db_connect.php";

header('Content-Type: application/json'); // Must be at the top before any output

if (isset($_POST['ajliin_turul'])) {
    $ajliin_turul = $conn->real_escape_string($_POST['ajliin_turul']);
    $projectName = $conn->real_escape_string($_POST['projectName']);
    $ded_buleg = $conn->real_escape_string($_POST['ded_buleg']);
    // Optional: Whitelist allowed tables to avoid SQL injection

   $sql = "SELECT niit_ajil 
        FROM new_form 
        WHERE ajliin_turul = '$ajliin_turul' 
          AND project = '$projectName' 
          AND ded_buleg = '$ded_buleg'";

$result = $conn->query($sql);

$total = 0;

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $total += (float)$row['niit_ajil'];
    }
}
echo json_encode(['niit_ajil' => $total]);
}

