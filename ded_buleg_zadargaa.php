<?php
require "db_connect.php";

// if (isset($_GET['ded_group'])) {
//     echo "<p>The selected group is: " . htmlspecialchars($_GET['ded_group']) . "</p>";
//     echo "<p>The selected ID is: " . htmlspecialchars($_GET['tusuv_id']) . "</p>";
//     echo "<p>The selected ded_buleg is: " . htmlspecialchars($_GET['ded_buleg_id']) . "</p>";
// } else {
//     echo "<p>No group selected.</p>";
// }

$ded_buleg_id = $_GET['ded_buleg_id'];
$tusuv_id = $_GET['tusuv_id'];

$sql = "SELECT * FROM ded_buleg WHERE ded_buleg_id = $ded_buleg_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nonNullValues = array_filter($row, function($value){
        return $value !== "";
    });
} else {
    echo "<p>No matching record found.</p>";
}

$firstTwo = array_slice($nonNullValues, 0, 2);
$rest = array_slice($nonNullValues, 2);

$reindexed = [];
foreach ($rest as $index => $val) {
    $reindexed[$index + 1] = $val;
}
echo '<nav>';
    echo '<a href="./view_project_budget.php">төсөл харах</a>';
echo '<nav>';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Дэд бүлгийн дэлгэрэнгүй</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            padding: 30px;
        }

        h2 {
            text-align: center;
            color: #2c3e50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #3498db;
            color: white;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e1f5fe;
        }

        a {
            color: #2980b9;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
        h3 {
            font-weight: bold;
        }
    </style>
</head>
<body>

    <h2>Дэд бүлгийн дэлгэрэнгүй</h2>

    <?php
    foreach ($firstTwo as $key => $value) {
        echo "<h3>". htmlspecialchars($value) . "</h3>";
    }

    echo "<table>";

    // Header
    echo "<tr>";
    foreach ($reindexed as $key => $value) {
        echo "<th>" . htmlspecialchars($key) . "</th>";
    }
    echo "</tr>";

    // First row: work ID links
    echo "<tr>";
    foreach ($reindexed as $value) {
        echo "<td><a href='ajilbar_form.php?ajliin_dugaar=" . urlencode($value) . 
             "&tusuv_id=" . urlencode($tusuv_id) . 
             "&ded_buleg_id=" . urlencode($ded_buleg_id) . "'>" . htmlspecialchars($value) . "</a></td>";
    }
    echo "</tr>";

    // Second row: “Маягт харах” links
    echo "<tr>";
    foreach ($reindexed as $value) {
        echo "<td><a href='view_ajilbar_form.php?ajliin_dugaar=" . urlencode($value) . 
             "&tusuv_id=" . urlencode($tusuv_id) . 
             "&ded_buleg_id=" . urlencode($ded_buleg_id) . "'>Маягт харах</a></td>";
    }
    echo "</tr>";

    echo "</table>";

    $conn->close();
    ?>

</body>
</html>
