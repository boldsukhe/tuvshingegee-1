<?php
// ini_set('display_errors', 0);
// ini_set('log_errors', 1);
// error_reporting(E_ALL);

// header('Content-Type: application/json');

// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "tuvshingegee_db";

// $conn = new mysqli($servername, $username, $password, $dbname);

// if ($conn->connect_error) {
//     echo json_encode(["error" => "Database connection failed: " . $conn->connect_error]);
//     exit;
// }

// if (!isset($_GET['buleg_id'])) {
//     echo json_encode(["error" => "Missing buleg_id parameter"]);
//     exit;
// }
require ("db_connect.php");
$buleg_id = $_GET['buleg_id'];

$sql = "SELECT utga FROM buleg WHERE buleg_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $buleg_id);
$stmt->execute();
$result = $stmt->get_result();

$data = $result->fetch_assoc();

if ($data) {
    echo json_encode(["utga" => $data['utga']], JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode(["error" => "No data found for buleg_id: $buleg_id"]);
}

$conn->close();
?>
