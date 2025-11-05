<?php
header('Content-Type: application/json'); // Ensure proper JSON response

require_once "db_connect.php";

$sql = "SELECT buleg_id, utga, negj FROM buleg";
$result = $conn->query($sql);

$groups = [];
// if ($result->num_rows > 0) {
//     while ($row = $result->fetch_assoc()) {
//           $groups[] = [
//                 "id" => $row['buleg_id'], // or another unique value if needed
//                 "text" => $row['utga'] . ' - ' . $row['buleg_id'],
//                 "negj" => $row['negj']
//           ];
//     }
// }

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        // Extract the unit part (e.g., "м2", "ком", "ш") from $row['negj']
        $unit = '';
        if (preg_match('/([^\d\s]+)$/u', $row['negj'], $matches)) {
            $unit = $matches[1]; // captures only the unit
        }

        $groups[] = [
            "id" => $row['buleg_id'], // unique value
            "text" => $row['utga'] . ' - ' . $row['buleg_id'],
            "negj" => $row['negj']
        ];
    }
}
echo json_encode($groups, JSON_UNESCAPED_UNICODE); // Ensures UTF-8 characters work

$conn->close();
?>



