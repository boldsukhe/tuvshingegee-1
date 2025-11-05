<?php
require "db_connect.php";
$projectNames = $conn->query("SELECT name FROM projects");
$machine = $conn->query("SELECT name FROM machine");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <title>Тайлан</title>
    <style>
        
    </style>
</head>

<body>
    <?php include 'header.php'; ?>
    <div class = "parent_container">
         <div class="label_input">
            <label for="project">Төсөл сонгох</label>
            <select name="project" id="project">
                <option value="">-- Төсөл сонгох --</option>
                <?php
                if ($projectNames && $projectNames->num_rows > 0) {
                    while ($row = $projectNames->fetch_assoc()) {
                        echo '<option value="' . htmlspecialchars($row['name']) . '">' . htmlspecialchars($row['name']) . '</option>';
                    }
                }
                ?>
            </select>
        </div>
         <div class="label_input">
            <label for="ajliin_turul">Ажлын төрөл</label>
            <select id="ajliin_turul" name="ajliin_turul" style="width:100%;">
                <option value=""></option>
            </select>
        </div>

        <div class="label_input">
            <label for="ded_buleg">Дэд бүлэг</label>
            <select id="ded_buleg" name="ded_buleg">
                <option value="">-- Ажлын төрөл эхлээд сонгоно уу. --</option>
            </select>
        </div>
        <div id = "container_checklist"></div>
    </div>

    <script>
    </script>
</body>

</html>