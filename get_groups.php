<?php
header('Content-Type: application/json'); // Ensure proper JSON response

require_once "db_connect.php";

$sql = "SELECT buleg_id, utga FROM buleg";
$result = $conn->query($sql);

$groups = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
          $groups[] = [
                "id" => $row['buleg_id'], // or another unique value if needed
                "text" => $row['utga'] . ' - ' . $row['buleg_id']
          ];
    }
}

echo json_encode($groups, JSON_UNESCAPED_UNICODE); // Ensures UTF-8 characters work

$conn->close();
?>

