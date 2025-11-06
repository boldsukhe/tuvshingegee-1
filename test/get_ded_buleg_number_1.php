<?php
require "db_connect.php";

header('Content-Type: application/json'); // Must be at the top before any output
error_reporting(0);
if (isset($_POST['ded_buleg'])) {
    $ded_buleg = $conn->real_escape_string($_POST['ded_buleg']);

    $parts = explode(' - ', $ded_buleg);

    $name = trim($parts[0]);   // "excavator 2 unit"
    $number = trim($parts[1]); // "243"

    
    // Optional: Whitelist allowed tables to avoid SQL injection
    $name = $conn->real_escape_string($name);
    $result = $conn->query("SELECT * FROM buleg WHERE utga = '$name'"); // ded_buleg ni groupiin utga baigaa
   

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nonNullValues = array_filter($row, function($value){
        return $value !== "";
    });
    $rest = array_slice($nonNullValues, 1);

    // Determine lookup key: prefer explicit 'utga' key, otherwise first value
    $utga = $rest['utga'] ?? reset($rest) ?? null;

    if ($utga !== null) {
        // Use prepared statement to avoid injection
        $stmt = $conn->prepare("SELECT * FROM buleg WHERE utga = ?");
        $stmt->bind_param('s', $utga);
        $stmt->execute();
        $ded_buleg_utgatai = $stmt->get_result();
        $value = $ded_buleg_utgatai->fetch_assoc();
        $key = $utga;
        $final = [
            $key => $value
        ];
        echo json_encode($final);
        $stmt->close();
    } else {
        // Nothing to lookup; return the sliced data
        echo json_encode(array_values($rest));
    }
} else {
    echo json_encode([]);
}
}
