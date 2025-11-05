<?php
require "db_connect.php";

// Fetch all project names
$projectNames = $conn->query("SELECT name FROM projects");

// Handle form submission
$data = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selected_project'])) {
    $selectedProject = preg_replace('/[^a-zA-Z0-9_]/', '', str_replace(' ', '_', $_POST['selected_project']));
    $sql = "SELECT * FROM `$selectedProject`"; // 

    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $data = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $error = "No data found or table doesn't exist.";
    }
}
?>

<!DOCTYPE html>
<html lang="mn">
<head>
    <meta charset="UTF-8">
    <title>Төсөв Харах</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
            background: #f7f7f7;
        }
        form {
            margin-bottom: 20px;
            text-align: center;
        }
        select, button {
            padding: 10px;
            font-size: 16px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ccc;
        }
        th {
            background: #3498db;
            color: white;
        }
         nav {
            background-color: #ffffff;
            padding: 10px 20px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
            
        }
        nav a {
            color: #007bff;
            text-decoration: none;
            margin: 0 15px;
            font-weight: 500;
            font-size: 13px;
            margin-left: 100px;
        }
        nav a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<nav>
    <a href="home_budgetAdmin.html">Төсөл</a>
    <a href="view_project.php">Гүйцэтгэл</a>
    <a href="form_page.php">Маягт</a>
    <a href="logout.php">Гарах</a>
</nav>


<form method="POST">
    <label>Төсөл сонгох:</label>
    <select name="selected_project" required>
        <option value="">-- Сонгоно уу --</option>
        <?php while ($row = $projectNames->fetch_assoc()): ?>
            <option value="<?= htmlspecialchars($row['name']) ?>">
                <?= htmlspecialchars($row['name']) ?>
            </option>
        <?php endwhile; ?>
    </select>
    <button type="submit">Харах</button>
</form>

<div id="dataEditor">
    <?php if (!empty($data)): ?>
        <form method="POST" action="save_edits.php" id="editForm">
            <table>
                <thead>
                    <tr>
                        <th>Бүлэг</th>
                        <th>Хэмжээ</th>
                        <th>Нэгж үнэ</th>
                        <th>Нийт үнэ</th>
                        <th>Эхлэх</th>
                        <th>Дуусах</th>
                        <th>Үйлдэл</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['group_number']) ?></td>
                            <td><?= htmlspecialchars($row['quantity']) ?></td>
                            <td><?= htmlspecialchars($row['unit_cost']) ?></td>
                            <td><?= htmlspecialchars($row['total_cost']) ?></td>
                            <td><?= htmlspecialchars($row['start_date']) ?></td>
                            <td><?= htmlspecialchars($row['end_date']) ?></td>
                            <td>
                                <button type="button" onclick="deleteRow(this)">Устгах</button>
                                <input type="hidden" name="project_id[]" value="<?= htmlspecialchars($row['project_id']) ?>">
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <button type="submit">Өөрчлөлт хадгалах</button>
        </form>
    <?php endif; ?>
</div>

</body>
<script>
    function deleteRow(button) {
    
        // document.querySelectorAll('tr').forEach(row => {
        //     let projectId = row.dataset.projectId; // gets the value from data-project-id
        //     console.log('Project ID:', projectId);
        // });


    const tr = button.closest("tr");
    // const idInput = tr.querySelector('input[name="project_id[]"]');
    // if (idInput && idInput.value) {
    //     deletedIds.push(idInput.value);
    // }
    tr.remove();
}
    // now i have to send this project_id[] to php to delete it. Careful for new rows primary key that adding to mysql


</script>
</html>
