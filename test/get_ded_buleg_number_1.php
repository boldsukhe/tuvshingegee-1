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
   

    if ($result ->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nonNullValues = array_filter($row, function($value){
            return $value !== "";
        });
        $rest = array_slice($nonNullValues, 1);
        $ded_buleg_utgatai = $conn->query("SELECT * FROM buleg WHERE utga = '{$rest['utga']}'");

        $key = $rest['utga'] ?? 'unknown'; // or whatever key you want
        $value = $ded_buleg_utgatai->fetch_assoc(); // get one row (or loop if multiple)

        $final = [
            $key => $value
        ];

echo json_encode($final);
        $final = {"$rest" : "$ded_buleg_utgatai"}
        echo json_encode($final);


        echo json_encode($rest);
        
    } else {
        echo json_encode([]);
    }
}
