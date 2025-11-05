<?php
require "db_connect.php";
$sql = "SELECT name FROM projects";
$projectNames = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Төсөл харах</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
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
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        th, td {
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
            height: 20px;
            font-size: 11px;
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

        .select2-container {
            width: 100% !important;
            font-family: Arial, sans-serif !important;
            font-size: 11px !important;
            text-align: center !important;
        }

        .select2-container--default .select2-selection--single {
            padding: 0 !important;
            border: none !important;
            background-color: transparent !important;
            box-shadow: none !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            font-family: Arial, sans-serif !important;
            font-size: 11px !important;
        }

        .select2-selection__rendered {
            padding: 0 !important;
            margin: 0 !important;
            width: 100%;
            text-align: center !important;
            line-height: normal !important;
            font-family: Arial, sans-serif !important;
            font-size: 11px !important;
        }

        .select2-results__option,
        .select2-dropdown {
            font-family: Arial, sans-serif !important;
            font-size: 11px !important;
            text-align: center !important;
        }

        .select2-selection__arrow {
            height: 100% !important;
        }

        table td:first-child,
        table th:first-child {
            
        }
        table td:nth-child(2),
        table th:nth-child(2) {
            width: 120px;
        }
        table td:nth-child(3),
        table th:nth-child(3) {
            width: 80px;
        }
        table td:nth-child(4),
        table th:nth-child(4) {
            width: 80px;
        }
    </style>
</head>
<body>

    <h2>Төсөл харах</h2>

    <div class="label_input">
        <label for="project">Төсөл сонгох:</label>
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

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Бүлэг</th>
                    <th>Тоо хэмжээ</th>
                    <th>Эхлэх</th>
                    <th>Дуусах</th>
                </tr>
            </thead>
            <tbody id="projectTableBody">
                <tr><td colspan="4">Төсөл сонгоно уу</td></tr>
            </tbody>
        </table>
    </div>

    <script>
        document.getElementById("project").addEventListener("change", function () {
            const projectName = this.value;
            const tableBody = document.getElementById("projectTableBody");
            tableBody.innerHTML = "<tr><td colspan='4'>Түр хүлээнэ үү...</td></tr>";

            if (projectName !== "") {
                fetch("get_project_table.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: "project_name=" + encodeURIComponent(projectName)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        tableBody.innerHTML = "";
                        data.forEach(row => {
                            const tr = document.createElement("tr");
                            tr.innerHTML = `
                                <td><a href="buleg_zadargaa.php?group=${encodeURIComponent(row.group_number)}">${row.group_number}</a></td>
                                <td>${row.quantity}</td>
                                <td>${row.start_date}</td>
                                <td>${row.end_date}</td>
                            `;
                            tableBody.appendChild(tr);
                        });
                    } else {
                        tableBody.innerHTML = "<tr><td colspan='4'>Хоосон байна</td></tr>";
                    }
                })
                .catch(error => {
                    console.error("Error loading data:", error);
                    tableBody.innerHTML = "<tr><td colspan='4'>Алдаа гарлаа</td></tr>";
                });
            } else {
                tableBody.innerHTML = "<tr><td colspan='4'>Төсөл сонгоно уу</td></tr>";
            }
        });
    </script>

</body>
</html>
