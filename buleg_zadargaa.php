<?php
require "db_connect.php";


// if (isset($_GET['group'])) {
//     echo "The selected group is: " . htmlspecialchars($_GET['group']);
//     echo "The selected id is: " .htmlspecialchars($_GET['id']);
    
// } else {
//     echo "No group selected.";
// }

$buleg_id = $_GET['group'];
$tusuv_id = $_GET['id'];


$sql = "SELECT *  FROM buleg where buleg_id =$buleg_id";
$result = $conn->query($sql);




if($result->num_rows>0) {
    $row = $result->fetch_assoc();

    $nonNullValues = array_filter($row, function($value){
        return $value !== "";
    });
    // echo "its working";
    // print_r($nonNullValues);
} else {
    echo "no matching found";
}


$firstTwo = array_slice($nonNullValues, 0, 2);
$rest = array_slice($nonNullValues, 2);

// print_r($rest);

$reindexed = [];
foreach ($rest as $index => $val) {
    $reindexed[$index + 1] = $val;
}



echo '
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

    .styled-container {
        width: 80%;
        margin: auto;
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
</style>

<div class="styled-container">
<h2>Бүлгийн задаргаа</h2>
';

echo '<nav>';
    echo '<a href="./view_project_budget.php">төсөл харах</a>';
echo '<nav>';

foreach ($firstTwo as $key => $value) {
    echo "<h3>". htmlspecialchars($value) . "</h3>";
}

echo "<table>";

// Table header
echo "<tr>";
foreach ($reindexed as $key => $value) {
    echo "<th>" . htmlspecialchars($key) . "</th>";
}
echo "</tr>";

// Row with clickable IDs
echo "<tr>";
foreach ($reindexed as $value) {
    echo "<td><a href='ded_buleg_zadargaa.php?ded_buleg_id=" . urlencode($value) . 
         "&tusuv_id=" . urlencode($tusuv_id) . "'>" . htmlspecialchars($value) . "</a></td>";
}
echo "</tr>";

// Row with `utga` values
echo "<tr>";
foreach ($reindexed as $value) {
    $value = (int)$value;
    $sql = "SELECT utga FROM ded_buleg WHERE ded_buleg_id = $value";
    $result = $conn->query($sql);
    if ($result && $row = $result->fetch_assoc()) {
        echo "<td>" . htmlspecialchars($row['utga']) . "</td>";
    } else {
        echo "<td>Not Found</td>";
    }
}
echo "</tr>";

echo "</table></div>"; // Close table and styled container



// echo "<table border='1' cellpadding='5' cellspacing='0'>";
    
//     // Table header (dynamic)
//     echo "<tr>";
//     foreach ($reindexed  as $key => $value) {
//         echo "<th>" . htmlspecialchars($key) . "</th>";
//     }
//     echo "</tr>";

//     // Table data (dynamic)
//     echo "<tr>";
//     foreach ($reindexed  as $value) {
//         // echo "<td>" . htmlspecialchars($value) . "</td>";
//         echo "$value";
//         echo "<td><a href='ajilbar.php?ded_buleg_id=" . urlencode($value) . 
//                 "&tusuv_id=" . urlencode($tusuv_id) . "'>" . htmlspecialchars($value) . "</a></td>";

//     }
//     echo "</tr>";

//     echo "<tr>";
//     foreach ($reindexed as $value) {
//         // Ensure value is an integer to prevent SQL injection
//         $value = (int)$value;
    
//         $sql = "SELECT utga FROM ded_buleg WHERE ded_buleg_id = $value";
//         $result = $conn->query($sql);
    
//         if ($result && $row = $result->fetch_assoc()) {
//             echo "<td>" . htmlspecialchars($row['utga']) . "</td>";
//         } else {
//             echo "<td>Not Found</td>";
//         }
//     }
//     echo "</tr>";

//     // $sql = "SELECT utga from ded_buleg = $value";
//     // $sql = "SELECT *  FROM buleg where buleg_id =$buleg_id";

//     echo "</table>";

$conn->close();


?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
        
    
</body>
</html>

