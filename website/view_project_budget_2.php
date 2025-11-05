<?php
require "db_connect.php";

// Fetch all project names
$projectNames = $conn->query("SELECT name FROM projects");

$data = [];
$selectedProject = '';
$error = '';

// Handle form submission to load data for a project
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selected_project'])) {
    $selectedProject = preg_replace('/[^a-zA-Z0-9_]/', '', str_replace(' ', '_', $_POST['selected_project']));
    $sql = "SELECT * FROM `$selectedProject`";

    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $data = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $error = "No data found or table doesn't exist.";
    }
}

// Handle saving updated data (add/edit/delete)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'save_data') {
    $selectedProject = preg_replace('/[^a-zA-Z0-9_]/', '', str_replace(' ', '_', $_POST['project_name']));

    // Collect all fields sent
    $projectIds = $_POST['project_id'] ?? [];
    $groupNumbers = $_POST['group_number'] ?? [];
    $quantities = $_POST['quantity'] ?? [];
    $unitCosts = $_POST['unit_cost'] ?? [];
    $totalCosts = $_POST['total_cost'] ?? [];
    $startDates = $_POST['start_date'] ?? [];
    $endDates = $_POST['end_date'] ?? [];

    // Deleted IDs sent from client
    $deletedIds = $_POST['deleted_ids'] ?? [];

    // Delete removed rows
    if (!empty($deletedIds)) {
        $deletedIdsEscaped = array_map(function($id) use ($conn) {
            return intval($id);
        }, $deletedIds);
        $idsStr = implode(',', $deletedIdsEscaped);
        if ($idsStr) {
            $conn->query("DELETE FROM `$selectedProject` WHERE project_id IN ($idsStr)");
        }
    }

    // Insert or update remaining rows
    for ($i = 0; $i < count($groupNumbers); $i++) {
        $id = isset($projectIds[$i]) ? intval($projectIds[$i]) : 0;
        $groupNumber = $conn->real_escape_string($groupNumbers[$i]);
        $quantity = floatval($quantities[$i]);
        $unitCost = floatval($unitCosts[$i]);
        $totalCost = floatval($totalCosts[$i]);
        $startDate = $conn->real_escape_string($startDates[$i]);
        $endDate = $conn->real_escape_string($endDates[$i]);

        if ($id > 0) {
            // Update existing row
            $conn->query("UPDATE `$selectedProject` SET 
                group_number = '$groupNumber',
                quantity = $quantity,
                unit_cost = $unitCost,
                total_cost = $totalCost,
                start_date = '$startDate',
                end_date = '$endDate'
                WHERE project_id = $id
            ");
        } else {
            // Insert new row
            $conn->query("INSERT INTO `$selectedProject` 
                (group_number, quantity, unit_cost, total_cost, start_date, end_date) VALUES
                ('$groupNumber', $quantity, $unitCost, $totalCost, '$startDate', '$endDate')
            ");
        }
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="mn">
<head>
    <meta charset="UTF-8" />
    <title>Төсөв Харах & Засах</title>
    <style>
        /* Your CSS here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
        }
        .main-nav {
    background: white;
    padding: 12px 40px;
    border-bottom: 1px solid #e0e0e0;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.main-nav {
    background: white;
    border-bottom: 1px solid #e0e0e0;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    padding: 12px 0;
}

.nav-container {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    justify-content: center; /* Centers all links */
    gap: 30px;
}

.nav-container a {
    font-weight: 500;
    font-size: 14px;
    color: #2c3e50;
    text-decoration: none;
    padding: 6px 12px;
    border-radius: 4px;
    transition: background-color 0.2s ease, color 0.2s ease;
}

.nav-container a:hover {
    background-color: #3498db;
    color: white;
}
        h2 {
            text-align: center;
            color: #2c3e50;
        }

        form,
        .table-container {
            width: 100%;
            max-width: 100%;
            margin: 0;
            padding: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            height: auto;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            height: 40px;
            font-size: 14px;
            vertical-align: middle;
            padding: 0;
        }

        td {
            padding: 0;
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

        input[type="number"],
        input[type="date"],
        input[type="text"],
        select {
            width: 100%;
            height: 100%;
            border: none;
            padding: 8px;
            box-sizing: border-box;
            background-color: transparent;
            font-size: 11px;
            font-family: Arial, sans-serif;
            text-align: left;
        }
        .select2-dropdown {
            font-family: Arial, sans-serif !important;
            font-size: 11px !important;
            text-align: left !important;
        }
        .select2-container {
            width: 100% !important;
            font-family: Arial, sans-serif !important;
            font-size: 11px !important;
            text-align: left !important;
        }

        .table_buttons {
            margin-top: 20px;
            text-align: right;
        }

        .btn {
            background-color: #3498db;
            color: white;
            padding: 8px 14px;
            font-size: 11px;
            border: none;
            cursor: pointer;
            margin-left: 10px;
            border-radius: 4px;
        }

        .btn:hover {
            background-color: #2980b9;
        }

        /* Responsive first columns */
        table td:first-child,
        table th:first-child {
            width: 45%;
        }

        table td:nth-child(2),
        table th:nth-child(2) {
            width: 100px;
        }

        table td:nth-child(3),
        table th:nth-child(3) { 
            width: 150px;
        }
        /* Tusul songoh */
        .project-select-container {
    display: flex;
    justify-content: center;
    margin: 0; /* Removed margin */
}

.project-select-form {
    display: flex;
    align-items: center;
    gap: 8px;
    background: #ffffff;
    padding: 10px 15px;
    border-radius: 6px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.project-select-form label {
    font-size: 14px;
    font-weight: bold;
    color: #2c3e50;
}

.project-select-form select {
    padding: 6px 8px;
    font-size: 13px;
    border: 1px solid #ccc;
    border-radius: 4px;
    min-width: 200px;
    outline: none;
    background-color: #f9f9f9;
}

.project-select-form select:focus {
    border-color: #3498db;
    background-color: #fff;
}

.project-select-form .btn {
    background-color: #3498db;
    color: white;
    padding: 7px 14px;
    font-size: 13px;
    border: none;
    cursor: pointer;
    border-radius: 4px;
    transition: background-color 0.2s ease;
}

.project-select-form .btn:hover {
    background-color: #2980b9;
}
.navbar-nav .nav-link {
    font-size: 14px; /* adjust to your desired size */
    font-weight: 500; /* optional: make it bold */
}
nav a img {
    height: 80px;
    vertical-align: middle;

}
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-light px-4">
  <a class="navbar-brand" href="#">
    <img src="tuvshin_logo.png" alt="Logo" height="50">
  </a>
  <div class="collapse navbar-collapse">
    <ul class="navbar-nav ms-3">
      <!-- Dropdown -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="view_project.php" id="projectDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Төсөл
        </a>
        <ul class="dropdown-menu" aria-labelledby="projectDropdown">
          <li><a class="dropdown-item" href="view_project_budget_2.php">Жагсаалт</a></li>
          <li><a class="dropdown-item" href="enter_project_name.html">Оруулах</a></li>
        </ul>
      </li>
      <li class="nav-item"><a class="nav-link mx-2" href="new_form_test_1.php">Маягт</a></li>
      <li class="nav-item"><a class="nav-link mx-2" href="view_new_form_test_1.php">Гүйцэтгэл</a></li>
      <li class="nav-item"><a class="nav-link mx-2" href="machine.php">Тоног.т</a></li>
    </ul>

    <!-- Right side (logout) -->
    <ul class="navbar-nav ms-auto">
      <li class="nav-item"><a class="nav-link text-danger" href="login.php">Гарах</a></li>
    </ul>
  </div>
</nav>


<div class="project-select-container">
    <form method="POST" id="projectSelectForm" class="project-select-form">
        <label for="selected_project">Төсөл сонгох:</label>
        <select id="selected_project" name="selected_project" required>
            <option value="">-- Сонгоно уу --</option>
            <?php 
            $projectNames->data_seek(0);
            while ($row = $projectNames->fetch_assoc()): ?>
                <option value="<?= htmlspecialchars($row['name']) ?>" 
                    <?= $selectedProject === preg_replace('/[^a-zA-Z0-9_]/', '', str_replace(' ', '_', $row['name'])) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($row['name']) ?>
                </option>
            <?php endwhile; ?>
        </select>
        <button type="submit" class="btn">Харах</button>
    </form>
</div>

<?php if (!empty($data)): ?>
    <div class="table-container">
        <form method="POST" id="editForm">
            <input type="hidden" name="project_name" value="<?= htmlspecialchars($selectedProject) ?>">
            <input type="hidden" name="action" value="save_data">

            <table>
                <thead>
                    <tr>
                        <th>Бүлэг</th>
                        <th>Тоо хэмжээ</th>
                        <th>Нэгж өртөг</th>
                        <th>Нийт өртөг</th>
                        <th>Эхлэх хугацаа</th>
                        <th>Дуусах хугацаа</th>
                        <th>Устгах</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <?php foreach ($data as $row): ?>
                        <tr data-project-id="<?= $row['project_id'] ?>">

                            

                            <td><input type="text" name="group_number[]" value="<?= htmlspecialchars($row['group_number']) ?>" required></td>
                            <td><input type="number" name="quantity[]" value="<?= htmlspecialchars($row['quantity']) ?>" step="any" required></td>
                            <td><input type="number" name="unit_cost[]" value="<?= htmlspecialchars($row['unit_cost']) ?>" step="any" required></td>
                            <td><input type="number" name="total_cost[]" value="<?= htmlspecialchars($row['total_cost']) ?>" step="any" readonly></td>
                            <td><input type="date" name="start_date[]" value="<?= htmlspecialchars($row['start_date']) ?>" required></td>
                            <td><input type="date" name="end_date[]" value="<?= htmlspecialchars($row['end_date']) ?>" required></td>
                            <td>
                                <button type="button" class="btn btn-delete" onclick="deleteRow(this)">Устгах</button>
                                <input type="hidden" name="project_id[]" value="<?= htmlspecialchars($row['project_id']) ?>">
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="table_buttons">
                <button type="button" class="btn" onclick="addRow()">Мөр нэмэх</button>
                <button type="submit" class="btn">Хадгалах</button>
            </div>
            <input type="hidden" name="deleted_ids" id="deletedIdsInput" value="">
        </form>
    </div>
<?php elseif ($selectedProject): ?>
    <p style="text-align:center; color:red; font-weight:bold;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<script>

    document.getElementById("editForm").addEventListener("submit", function(event) {
        event.preventDefault();
        console.log("Form submitted!");

        let formData = new FormData(this);

        fetch("./save_edited_budget_form.php", {
            method: "POST",
            body: formData
        }).then(response => response.text())
          .then(data => window.location.href = "./new_form_test_1.php")
          .catch(error => console.error("Error:", error));
    });

    function autoFillName(selectElement) {
    let groupId = selectElement.value;
    let nameField = selectElement.closest("tr").querySelector('input[name="name[]"]');

    if (groupId) {
        console.log(groupId);
        fetch(`./get_item_name.php?buleg_id=${groupId}`)
            .then(response => response.json())
            .then(data => {
                console.log(data.utga);
                nameField.value = data.utga || ''; // Fix: Use "utga" instead of "item_name"
            })
            .catch(error => console.error('Error fetching item name:', error));
    } else {
        // nameField.value = '';
    }
}

    function fetchGroups() {
    fetch("./get_groups.php") 
        .then(response => response.json())
        .then(groups => { 
            document.querySelectorAll('select[name="buleg_id[]"]').forEach(select => {
                // Clear previous options
                select.innerHTML = '<option value=""></option>';
                
                // Add new options
                groups.forEach(group => {
                    let option = document.createElement("option");
                    option.value = group.text;
                    option.textContent = group.text;
                    select.appendChild(option);
                });

                // Apply Select2 to enhance UI
                $(select).select2();
            });
        })
        .catch(error => console.error('Error fetching groups:', error));
        }

    const deletedIds = [];

    function deleteRow(button) {
        const tr = button.closest('tr');
        const idInput = tr.querySelector('input[name="project_id[]"]');
        if (idInput && idInput.value) {
            deletedIds.push(idInput.value);
        }
        tr.remove();
        updateDeletedIdsInput();
    }

    function updateDeletedIdsInput() {
        document.getElementById('deletedIdsInput').value = deletedIds.join(',');
    }

    function addRow() {
    let table = document.getElementById("tableBody");
    let newRow = document.createElement("tr");

    newRow.innerHTML = `
        <td>
            <select name="buleg_id[]" class="select2" onchange="autoFillName(this)">
                <option value="">Select Group</option>
            </select>
        </td>
        <td><input type="number" name="quantity[]" oninput="calculateTotal(this)"></td>
        <td><input type="number" name="unit_cost[]" oninput="calculateTotal(this)"></td>
        <td><input type="number" name="total_cost[]" readonly></td>
        <td><input type="date" name="start_date[]"></td>
        <td><input type="date" name="end_date[]"></td>
        <td>
        <button type="button" class="btn btn-delete" onclick="deleteRow(this)">Устгах</button>
        <input type="hidden" name="project_id[]" value="<?= htmlspecialchars($row['project_id']) ?>">
        </td>
    `;

    table.appendChild(newRow);

    fetchGroups(); // Fetch groups and reinitialize Select2
    }

    function calculateTotal(input) {
        const tr = input.closest('tr');
        const quantity = parseFloat(tr.querySelector('input[name="quantity[]"]').value) || 0;
        const unitCost = parseFloat(tr.querySelector('input[name="unit_cost[]"]').value) || 0;
        const totalCostInput = tr.querySelector('input[name="total_cost[]"]');
        totalCostInput.value = (quantity * unitCost).toFixed(2);
    }

    // Automatically recalc totals on page load for existing rows
    window.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('input[name="quantity[]"], input[name="unit_cost[]"]').forEach(input => {
            calculateTotal(input);
            input.addEventListener('input', () => calculateTotal(input));
        });
    });
</script>

</body>
</html>
