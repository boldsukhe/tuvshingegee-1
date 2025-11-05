<?php
require "db_connect.php";

$ded_buleg_id = $_GET['ded_buleg_id'];
$tusuv_id = $_GET['tusuv_id'];
$ajliin_dugaar = $_GET['ajliin_dugaar'];
echo '<nav>';
    echo '<a href="./view_project_budget.php">төсөл харах</a>';
echo '<nav>';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Ажлын явц</title>
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
    </style>
</head>

<body>

<h2><?php echo htmlspecialchars($ajliin_dugaar); ?> </h2>

<?php
$stmt = $conn->prepare("SELECT udriin_tuluv, ner, mashin_mechanism_uuriin, mashin_mechanism_uuriin_tsag,material_too_hemjee 
                        FROM ajilbar 
                        WHERE ajliin_dugaar = ?");
$stmt->bind_param("s", $ajliin_dugaar);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $total_tsag = 0;
    $total_material = 0;
    echo "<table>";
    echo "<tr><th>Өдрийн төлөв</th><th>Нэр</th><th>Өөрийн ММ</th><th>Өөрийн ММ цаг</th><th>Материал тоо</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['udriin_tuluv']) . "</td>";
        echo "<td>" . htmlspecialchars($row['ner']) . "</td>";
        echo "<td>" . htmlspecialchars($row['mashin_mechanism_uuriin']) . "</td>";
        echo "<td>" . htmlspecialchars($row['mashin_mechanism_uuriin_tsag']) . "</td>";
        echo "<td>" . htmlspecialchars($row['material_too_hemjee']) . "</td>";
        echo "</tr>";
        $total_tsag += (float)$row['mashin_mechanism_uuriin_tsag'];
        $total_material += (float)$row['material_too_hemjee'];
    }
    echo "<tr style='font-weight: bold; background-color: #dfe6e9;'>";
    echo "<td colspan='3'></td>";
    echo "<td>" . $total_tsag . "</td>";
    echo "<td>" . $total_material . "</td>";
    echo "</tr>";
    echo "</table>";
} else {
    echo "<p>No data found for this ajliin_dugaar.</p>";
}

$conn->close();
?>

</body>
</html>
